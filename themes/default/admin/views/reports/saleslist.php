<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
</head>

<body>

<div class="container mt-4">

    <h3 class="mb-4 text-center"><?= $page_title ?></h3>

    <!-- FILTER FORM -->
    <form id="filterForm" class="row g-3">

        <div class="col-md-3">
            <input type="text" id="item_id" class="form-control" placeholder="Item ID">
        </div>

        <div class="col-md-3">
            <input type="text" id="item_name" class="form-control" placeholder="Item Name">
        </div>

        <div class="col-md-3">
            <input type="date" id="start_date" class="form-control">
        </div>

        <div class="col-md-3">
            <input type="date" id="end_date" class="form-control">
        </div>

        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>

    </form>

    <hr>

    <!-- TABLE -->
    <table id="salesTable" class="table table-bordered table-striped w-100">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Reference</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Unit Cost</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Created By</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

</div>


<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script id="view_full_002">
$(document).ready(function () {

    var table = $('#salesTable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        ajax: {
            url: "<?= admin_url('reports/getSalesList') ?>",
            type: "GET",
            data: function (d) {
                d.item_id   = $('#item_id').val();
                d.item_name = $('#item_name').val();
                d.start_date = $('#start_date').val();
                d.end_date   = $('#end_date').val();
            }
        }
    });

    // Filter submit
    $('#filterForm').on('submit', function (e) {
        e.preventDefault();
        table.ajax.reload();
    });

});
</script>

</body>
</html>