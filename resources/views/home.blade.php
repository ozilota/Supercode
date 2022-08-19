@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <div class="container mt-5">

        <h2 class="mb-4">DESTEK PORTALI</h2>

        <div class="float-end mb-3">
            <a href="{{route('newTicket')}}" class="btn btn-primary float-right">New Ticket<i
                    class="fas fa-user-plus ml-3"></i></a>
        </div>

        <table class="table table-striped yajra-datatable">
            <thead>
            <tr>
                <th>No</th>
                <th>Konu</th>
                @if(Auth::user()->is_admin)
                    <th>Oluşturan</th>
                    <th>Departman</th>
                    <th>Ünvan</th>
                    <th>Okul</th>
                @endif
                <th>Durum</th>
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
                            {data: 'title', name: 'title'},

                                @if(Auth::user()->is_admin)
                                    {data: 'name', name: 'name'},
                                    {data: 'department_name', name: 'department_name'},
                                    {data: 'job_definition', name: 'job_definition'},
                                    {data: 'school_name', name: 'school_name'},
                                @endif

                            {data: 'status', name: 'status'},
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
