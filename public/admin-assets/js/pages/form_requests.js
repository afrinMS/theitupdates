document.addEventListener('DOMContentLoaded', function () {
    'use strict';
    var config = window.FORM_REQUESTS_CONFIG || {};
    var page = 1, perPage = 10, sort = 'created_at', order = 'DESC', search = '';
    var $body = $('#request-table-body'), $pagination = $('#request-pagination');
    var columnCount = (config.columns || []).length;

    function escapeHtml(value) {
        return String(value === null || value === undefined ? '' : value)
            .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;').replace(/'/g, '&#039;');
    }
    function formatDate(value) {
        if (!value) return '-';
        var date = new Date(String(value).replace(' ', 'T'));
        return isNaN(date.getTime()) ? escapeHtml(value) : date.toLocaleString();
    }
    function renderValue(row, column) {
        var value = row[column.field];
        if (column.type === 'email') return '<a href="mailto:' + escapeHtml(value) + '">' + escapeHtml(value) + '</a>';
        if (column.type === 'date') return '<small class="text-muted">' + formatDate(value) + '</small>';
        if (column.type === 'status') return Number(value) === 1
            ? '<span class="badge bg-success">Sent</span>'
            : '<span class="badge bg-warning text-dark">Not sent</span>';
        if (column.type === 'message') return value
            ? '<div style="min-width:240px;max-width:420px;white-space:normal;">' + escapeHtml(value) + '</div>'
            : '<span class="text-muted">-</span>';
        return value ? escapeHtml(value) : '<span class="text-muted">-</span>';
    }
    function loadData() {
        $body.html('<tr><td colspan="' + columnCount + '" class="text-center text-muted py-4"><i class="fas fa-spinner fa-spin me-2"></i>Loading...</td></tr>');
        $.ajax({url: config.listUrl, type: 'GET', dataType: 'json', data: {page: page, per_page: perPage, search: search, sort: sort, order: order},
            success: function (response) {
                if (!response.success) return showError('Failed to load requests.');
                $body.empty();
                if (!response.data || !response.data.length) {
                    $body.html('<tr><td colspan="' + columnCount + '" class="text-center text-muted py-4">' + escapeHtml(config.emptyText) + '</td></tr>');
                } else {
                    response.data.forEach(function (row) {
                        var cells = config.columns.map(function (column) { return '<td>' + renderValue(row, column) + '</td>'; }).join('');
                        $body.append('<tr>' + cells + '</tr>');
                    });
                }
                renderPagination(response.page, response.total_pages, response.total);
            },
            error: function () { showError('An error occurred while loading requests.'); }
        });
    }
    function showError(message) { $body.html('<tr><td colspan="' + columnCount + '" class="text-center text-danger py-4">' + escapeHtml(message) + '</td></tr>'); }
    function renderPagination(current, totalPages, total) {
        var start = total ? (current - 1) * perPage + 1 : 0, end = Math.min(current * perPage, total);
        $('#request-summary').text('Showing ' + start + ' to ' + end + ' of ' + total + ' results');
        $pagination.empty();
        if (totalPages <= 1) return;
        $pagination.append(link(current - 1, '&lsaquo;', current <= 1, false));
        for (var i = Math.max(1, current - 2); i <= Math.min(totalPages, current + 2); i++) $pagination.append(link(i, i, false, i === current));
        $pagination.append(link(current + 1, '&rsaquo;', current >= totalPages, false));
    }
    function link(target, label, disabled, active) {
        return '<li class="page-item' + (disabled ? ' disabled' : '') + (active ? ' active' : '') + '"><a class="page-link" href="#" data-page="' + target + '">' + label + '</a></li>';
    }
    $('#request-search-form').on('submit', function (event) { event.preventDefault(); search = $('#request-search').val().trim(); page = 1; loadData(); });
    $('#request-refresh').on('click', function () { $('#request-search').val(''); search = ''; page = 1; loadData(); });
    $('#request-per-page').on('change', function () { perPage = parseInt(this.value, 10); page = 1; loadData(); });
    $('.request-sortable').on('click', function () { var field = $(this).data('sort'); order = sort === field && order === 'ASC' ? 'DESC' : 'ASC'; sort = field; page = 1; loadData(); });
    $pagination.on('click', '.page-link', function (event) { event.preventDefault(); var target = parseInt($(this).data('page'), 10); if (target > 0) { page = target; loadData(); } });
    loadData();
});
