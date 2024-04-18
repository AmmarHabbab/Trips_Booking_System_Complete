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
    
        <table id="trips-table" class="table table-bordered">
          <thead>
            <tr>
              <th class="px-4 py-2">id</th>
              <th class="px-4 py-2">name</th>
              <th class="px-4 py-2">info</th>
              <th class="px-4 py-2">area</th>
              <th class="px-4 py-2">type</th>
              <th class="px-4 py-2">seats</th>
              <th class="px-4 py-2">seats_taken</th>
              <th class="px-4 py-2">status</th>
              <th class="px-4 py-2">price</th>
              <th class="px-4 py-2">start_date</th>
              <th class="px-4 py-2">expiry_date</th>
              <th class="px-4 py-2">action</th>
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
$('#trips-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('dashboard.trips.all') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'info', name: 'info',orderable:false,searchable:false },
             { data: 'area', name: 'area' },
             { data: 'type', name: 'type' },
             { data: 'seats', name: 'seats',orderable:false,searchable:false },
             { data: 'seats_taken', name: 'seats_taken',orderable:false,searchable:false },
             { data: 'status', name: 'status' },
             { data: 'price', name: 'price' },
             { data: 'start_date', name: 'start_date',orderable:false,searchable:false },
             { data: 'expiry_date', name: 'expiry_date',orderable:false,searchable:false },
             { data: 'action', name: 'action',orderable:false,searchable:false },
        ]
});
});
</script>

{{-- // $(function() {
//     $('#posts-table').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: '{{ route("dashboard.posts.all") }}',
//         columns: [
//             { data: 'title', name: 'title' },
//             { data: 'content', name: 'content' },
//             { data: 'created_at', name: 'created_at' },
//             { data: 'updated_at', name: 'updated_at' },
//         ]
//     });
// });

{{-- @endpush --}}
{{-- </body>
</html> --}}
{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Bootstrap Datatable</title>
</head>
<body>
  <table class="table table-hover table-bordered"> 
    <thead class="table-dark" id="trips-table">
    <tr>
      <th scope=""></th>
      <th scope="">Item Name</th>
      <th scope="">Category</th>
      <th scope="">Price</th>
      <th scope="">Action</th>
      <th scope=""></th>
      <th scope="">Item Name</th>
      <th scope="">Category</th>
      <th scope="">Price</th>
      <th scope="">Action</th>
    </tr>
  </thead>
</table>
</body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script src="/js/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

  <script>
    $(document).ready(function(){
    $('#trips-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('dashboard.trips.all') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'info', name: 'info',orderable:false,searchable:false },
                 { data: 'area', name: 'area' },
                 { data: 'seats', name: 'seats' },
                 { data: 'seats_taken', name: 'seats_taken' },
                 { data: 'status', name: 'status' },
                 { data: 'price', name: 'price' },
                 { data: 'start_date', name: 'start_date' },
                 { data: 'expiry_date', name: 'expiry_date' },
                 { data: 'action', name: 'action' },
            ]
    });
    });
  </script>
</html> --}}