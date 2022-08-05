@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <div class="container">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Current Tickets2</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <a href="{{route('newTicket')}}" class="btn btn-primary">New Ticket<i
                            class="fas fa-user-plus ml-3"></i></a>
                </div>

                <div class="x_content">

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Destek2 No</th>
                            <th>Durum</th>
                            <th>Oluşturan</th>
                            <th>Konu</th>
                            <th>Son Cevap</th>
                            <th>Kayıt Tarihi</th>
                            <th>Detay Görüntüle</th>
                        </tr>
                        </thead>

                    </table>


                    <script type="text/javascript">
                        $(function () {

                            var table = $('.yajra-datatable').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: "{{ route('deneme') }}",
                                columns: [
                                    {data: 'id', name: 'id'},
                                    {data: 'name', name: 'name'},
                                    {data: 'title', name: 'title'},
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

                </div>
            </div>
        </div>
    </div>
@endsection
