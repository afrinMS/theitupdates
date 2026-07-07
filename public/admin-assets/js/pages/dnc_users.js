document.addEventListener('DOMContentLoaded', function () {
	'use strict';

	var currentPage = 1;
	var currentPerPage = 10;
	var currentSort = 'created_at';
	var currentOrder = 'DESC';
	var currentSearch = '';

	var $table = $('#dnc-users-table-body');
	var $searchForm = $('#dnc-users-search-form');
	var $searchInput = $('#dnc-users-search');
	var $refreshBtn = $('#dnc-users-refresh');
	var $perPageSelect = $('#dnc-users-per-page');
	var $paginationSummary = $('#dnc-users-pagination-summary');
	var $paginationContainer = $('#dnc-users-pagination');

	// Initialize
	loadDncUsers();

	// Event listeners
	$searchForm.on('submit', function (e) {
		e.preventDefault();
		currentSearch = $searchInput.val().trim();
		currentPage = 1;
		loadDncUsers();
	});

	$refreshBtn.on('click', function () {
		$searchInput.val('');
		currentSearch = '';
		currentPage = 1;
		loadDncUsers();
	});

	$perPageSelect.on('change', function () {
		currentPerPage = parseInt($(this).val());
		currentPage = 1;
		loadDncUsers();
	});

	$('th.sortable').on('click', function () {
		var field = $(this).data('sort');
		if (currentSort === field) {
			currentOrder = currentOrder === 'ASC' ? 'DESC' : 'ASC';
		} else {
			currentSort = field;
			currentOrder = 'ASC';
		}
		currentPage = 1;
		loadDncUsers();
	});

	// Pagination
	$paginationContainer.on('click', 'a.page-link', function (e) {
		e.preventDefault();
		var page = $(this).data('page');
		if (page) {
			currentPage = page;
			loadDncUsers();
		}
	});

	function loadDncUsers() {
		$.ajax({
			url: (typeof DNC_LIST_URL !== 'undefined' ? DNC_LIST_URL : '/admin/dnc-users/list'),
			type: 'GET',
			dataType: 'json',
			data: {
				page: currentPage,
				per_page: currentPerPage,
				search: currentSearch,
				sort: currentSort,
				order: currentOrder
			},
			success: function (response) {
				if (response.success) {
					renderTable(response.data);
					updatePagination(response.page, response.total_pages, response.total);
				} else {
					showError('Failed to load DNC users');
				}
			},
			error: function () {
				showError('An error occurred while loading data');
			}
		});
	}

	function renderTable(data) {
		$table.empty();

		if (data.length === 0) {
			$table.html('<tr><td colspan="8" class="text-center text-muted py-4">No DNC users found</td></tr>');
			return;
		}

		data.forEach(function (user) {
			var submissionDate = formatDate(user.created_at);
			var row = `
				<tr>
					<td><strong>${escapeHtml(user.first_name)}</strong></td>
					<td>${escapeHtml(user.last_name)}</td>
					<td><a href="mailto:${escapeHtml(user.email)}">${escapeHtml(user.email)}</a></td>
					<td>${escapeHtml(user.company_name)}</td>
					<td>${escapeHtml(user.job_title)}</td>
					<td>${escapeHtml(user.country)}</td>
					<td>
						<span class="badge ${user.communication_opt_in === 'Yes' ? 'bg-success' : 'bg-danger'}">
							${user.communication_opt_in}
						</span>
					</td>
					<td><small class="text-muted">${submissionDate}</small></td>
				</tr>
			`;
			$table.append(row);
		});
	}

	function updatePagination(page, totalPages, total) {
		// Update summary
		var start = (page - 1) * currentPerPage + 1;
		var end = Math.min(page * currentPerPage, total);
		$paginationSummary.text(`Showing ${start} to ${end} of ${total} results`);

		// Update pagination buttons
		$paginationContainer.empty();

		if (totalPages <= 1) {
			return;
		}

		var cur = page, win = 2;
		$paginationContainer.append(`<li class="page-item${cur <= 1 ? ' disabled' : ''}"><a class="page-link" href="#" data-page="${Math.max(1, cur - 1)}">&lsaquo;</a></li>`);

		var startPage = Math.max(1, cur - win);
		var endPage = Math.min(totalPages, cur + win);

		if (startPage > 1) {
			$paginationContainer.append(`<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>`);
			if (startPage > 2) {
				$paginationContainer.append(`<li class="page-item disabled"><span class="page-link">&hellip;</span></li>`);
			}
		}

		for (var i = startPage; i <= endPage; i++) {
			var activeClass = i === cur ? ' active' : '';
			$paginationContainer.append(`<li class="page-item${activeClass}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`);
		}

		if (endPage < totalPages) {
			if (endPage < totalPages - 1) {
				$paginationContainer.append(`<li class="page-item disabled"><span class="page-link">&hellip;</span></li>`);
			}
			$paginationContainer.append(`<li class="page-item"><a class="page-link" href="#" data-page="${totalPages}">${totalPages}</a></li>`);
		}

		$paginationContainer.append(`<li class="page-item${cur >= totalPages ? ' disabled' : ''}"><a class="page-link" href="#" data-page="${Math.min(totalPages, cur + 1)}">&rsaquo;</a></li>`);
	}

	function formatDate(dateString) {
		var date = new Date(dateString);
		if (isNaN(date.getTime())) {
			return 'N/A';
		}
		return date.toLocaleDateString('en-US', {
			year: 'numeric',
			month: 'short',
			day: 'numeric',
			hour: '2-digit',
			minute: '2-digit'
		});
	}

	function escapeHtml(text) {
		if (!text) return '';
		var map = {
			'&': '&amp;',
			'<': '&lt;',
			'>': '&gt;',
			'"': '&quot;',
			"'": '&#039;'
		};
		return text.replace(/[&<>"']/g, function (m) { return map[m]; });
	}

	function showError(message) {
		console.error(message);
		$table.html(`<tr><td colspan="8" class="text-center text-danger py-4">${message}</td></tr>`);
	}
});
