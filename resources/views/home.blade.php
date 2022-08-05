@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


    <div class="container mt-5">
        <div>
            <a href="{{route('newTicket')}}" class="btn btn-primary float-right">New Ticket<i
                    class="fas fa-user-plus ml-3"></i></a>
        </div>
        <h2 class="mb-4">Current Tickets</h2>
        <table class="table table-hover yajra-datatable">
            <thead>
            <tr>
                <th>No</th>
                <th>Oluşturan</th>
                <th>Konu</th>
                <th>Durum</th>
                <th>Okul</th>
                <th>Departman</th>
                <th>Ünvan</th>
                <th>Kayıt Oluşturulma Tarihi</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <script type="text/javascript">
                $(function () {

                    var table = $('.yajra-datatable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('home.list') }}",
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'name', name: 'name'},
                            {data: 'title', name: 'title'},
                            {data: 'status', name: 'status'},
                            {data: 'school_name', name: 'school_name'},
                            {data: 'department_name', name: 'department_name'},
                            {data: 'job_definition', name: 'job_definition'},
                            {data: 'created_at', name: 'created_at'},
                            {
                                data: 'action',
                                name: 'action',
                                orderable: true,
                                searchable: true
                            },
                        ]
                    });

                });
            </script>
            </tbody>
        </table>
    </div>
    </body>
