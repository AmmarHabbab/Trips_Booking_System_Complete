<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            margin: 20px;
        }
    </style>
    <title>Document</title>
</head>
<body>
    @if (session('message'))
    <h4 align="center">{{ session('message') }}</h4>
  @endif
    <table id="coupons-table" class="table table-bordered">
        <thead>
            <tr>
                <th>coupon_code</th>
                <th>discount_percentage</th>
                <th>expiry_date</th>
                <th>status</th>
                <th>created_at</th>
            </tr>
        </thead>
    </table>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="/js/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    {{-- @push('scripts') --}}
<script>
$(document).ready(function(){
$('#coupons-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('dashboard.coupons.user') !!}',
        columns: [
            { data: 'coupon_code', name: 'coupon_code' },
            { data: 'discount_percentage', name: 'discount_percentage' },
            { data: 'expiry_date', name: 'expiry_date' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
        ]
});
});


</script>

</body>
</html>

