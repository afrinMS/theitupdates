document.addEventListener('DOMContentLoaded', function () {
	'use strict';

	var currentPage    = 1;
	var currentPerPage = 10;
	var currentSort    = 'created_at';
	var currentOrder   = 'DESC';
	var currentSearch  = '';

	var $table              = $('#ptnr-admin-table-body');
	var $searchForm         = $('#ptnr-admin-search-form');
	var $searchInput        = $('#ptnr-admin-search');
	var $refreshBtn         = $('#ptnr-admin-refresh');
	var $perPageSelect      = $('#ptnr-admin-per-page');
	var $paginationSummary  = $('#ptnr-admin-pagination-summary');
	var $paginationContainer = $('#ptnr-admin-pagination');

	loadData();

	$searchForm.on('submit', function (e) {
		e.preventDefault();
		currentSearch = $searchInput.val().trim();
		currentPage   = 1;
		loadData();
	});

	$refreshBtn.on('click', function () {
		$searchInput.val('');
		currentSearch = '';
		currentPage   = 1;
		loadData();
	});

	$perPageSelect.on('change', function () {
		currentPerPage = parseInt($(this).val());
		currentPage    = 1;
		loadData();
	});

	$('th.ptnr-sortable').on('click', function () {
		var field = $(this).data('sort');
		if (currentSort === field) {
			currentOrder = currentOrder === 'ASC' ? 'DESC' : 'ASC';
		} else {
			currentSort  = field;
			currentOrder = 'ASC';
		}
		$('th.ptnr-sortable').removeClass('sort-asc sort-desc');
		$(this).addClass(currentOrder === 'ASC' ? 'sort-asc' : 'sort-desc');
		currentPage = 1;
		loadData();
	});

	$(document).on('click', '#ptnr-admin-pagination .page-link', function (e) {
		e.preventDefault();
		var page = $(this).data('page');
		if (page) {
			currentPage = page;
			loadData();
		}
	});

	function loadData() {
		var listUrl = (typeof PTNR_ADMIN_LIST_URL !== 'undefined' ? PTNR_ADMIN_LIST_URL : '/admin/partnering/list');

		$table.html('<tr><td colspan="9" class="text-center text-muted py-4"><i class="fas fa-spinner fa-spin me-2"></i>Loading...</td></tr>');

		$.ajax({
			url: listUrl,
			type: 'GET',
			dataType: 'json',
			data: {
				page:     currentPage,
				per_page: currentPerPage,
				search:   currentSearch,
				sort:     currentSort,
				order:    currentOrder
			},
			success: function (response) {
				if (response.success) {
					renderTable(response.data);
					updatePagination(response.page, response.total_pages, response.total);
				} else {
					showError('Failed to load partnering data.');
				}
			},
			error: function () {
				showError('An error occurred while loading data.');
			}
		});
	}

	function renderTable(data) {
		$table.empty();

		if (!data || data.length === 0) {
			$table.html('<tr><td colspan="9" class="text-center text-muted py-4">No partnering requests found.</td></tr>');
			return;
		}

		data.forEach(function (row) {
			var msg = (row.message && row.message.trim() !== '') ?
				'<span title="' + escapeHtml(row.message) + '" style="cursor:pointer;white-space:nowrap;overflow:hidden;display:inline-block;max-width:140px;vertical-align:middle;text-overflow:ellipsis;">' + escapeHtml(row.message) + '</span>' :
				'<span class="text-muted">—</span>';

			var tr = '<tr>' +
				'<td><strong>' + escapeHtml(row.name) + '</strong></td>' +
				'<td>' + escapeHtml(row.job_title) + '</td>' +
				'<td><a href="mailto:' + escapeHtml(row.email) + '">' + escapeHtml(row.email) + '</a></td>' +
				'<td>' + escapeHtml(row.company_name) + '</td>' +
				'<td>' + escapeHtml(row.industry) + '</td>' +
				'<td>' + (row.phone ? escapeHtml(row.phone) : '<span class="text-muted">—</span>') + '</td>' +
				'<td>' + escapeHtml(row.country) + '</td>' +
				'<td>' + msg + '</td>' +
				'<td><small class="text-muted">' + formatDate(row.created_at) + '</small></td>' +
				'</tr>';
			$table.append(tr);
		});
	}

	function updatePagination(page, totalPages, total) {
		var start = total > 0 ? (page - 1) * currentPerPage + 1 : 0;
		var end   = Math.min(page * currentPerPage, total);
		$paginationSummary.text('Showing ' + start + ' to ' + end + ' of ' + total + ' results');

		$paginationContainer.empty();

		if (totalPages <= 1) { return; }

		var cur = page, win = 2;
		$paginationContainer.append('<li class="page-item' + (cur <= 1 ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="' + Math.max(1, cur - 1) + '">&lsaquo;</a></li>');

		var startPage = Math.max(1, cur - win);
		var endPage   = Math.min(totalPages, cur + win);

		if (startPage > 1) {
			$paginationContainer.append('<li class="page-item"><a class="page-link" href="#" data-page="1">1</a></li>');
			if (startPage > 2) {
				$paginationContainer.append('<li class="page-item disabled"><span class="page-link">&hellip;</span></li>');
			}
		}

		for (var i = startPage; i <= endPage; i++) {
			var activeClass = i === cur ? ' active' : '';
			$paginationContainer.append('<li class="page-item' + activeClass + '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
		}

		if (endPage < totalPages) {
			if (endPage < totalPages - 1) {
				$paginationContainer.append('<li class="page-item disabled"><span class="page-link">&hellip;</span></li>');
			}
			$paginationContainer.append('<li class="page-item"><a class="page-link" href="#" data-page="' + totalPages + '">' + totalPages + '</a></li>');
		}

		$paginationContainer.append('<li class="page-item' + (cur >= totalPages ? ' disabled' : '') + '"><a class="page-link" href="#" data-page="' + Math.min(totalPages, cur + 1) + '">&rsaquo;</a></li>');
	}

	function showError(msg) {
		$table.html('<tr><td colspan="9" class="text-center text-danger py-4">' + escapeHtml(msg) + '</td></tr>');
	}

	function escapeHtml(str) {
		if (str === null || str === undefined) { return ''; }
		return String(str)
			.replace(/&/g, '&amp;')
			.replace(/</g, '&lt;')
			.replace(/>/g, '&gt;')
			.replace(/"/g, '&quot;')
			.replace(/'/g, '&#039;');
	}

	function formatDate(dateStr) {
		if (!dateStr) { return '—'; }
		var d = new Date(dateStr);
		if (isNaN(d.getTime())) { return dateStr; }
		var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
		return months[d.getMonth()] + ' ' + d.getDate() + ', ' + d.getFullYear();
	}
});
