@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <div align="center">
        <button class="btn btn-dark"><a data-target="#editStatus" role="button" data-toggle="modal">Düzenle</a></button>
    </div>
    <div id="editStatus" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Ticket Durumu Güncelle</h4>
                    <button type="button" class="btn-close" aria-label="Close" data-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('updateTicket') }}" method="post">
                        @csrf
                        <div class="border border-dark">
                            <label class="align-content-md-end">Güncelleme Tarihi: <?php use Carbon\Carbon;
                                echo Carbon::now(+3);?></label>
                        </div>
                        <br/>
                        <div>
                            <label>Ticket ID: </label>
                            <input type="text" class="form-control" placeholder="{{$ticketID}}" name="ticket_id"
                                   value="{{$ticketID}}" readonly>
                        </div>
                        <br/>
                        <label>Status</label>
                        <select class="form-select" name="status" aria-label="Default select example">
                            <option value="1">Yanıt Bekliyor</option>
                            <option value="2">İşlemde</option>
                            <option value="3">Kapalı</option>
                        </select>
                        <br/>
                        <div class="form-floating">
                            <textarea class="form-control" name="metin" id="floatingTextarea"></textarea>
                            <label for="floatingTextarea"></label>
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-dark">Güncelle</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="x_content p-5">

        <form action="#" method="POST" class="mb-5">
        <div class="form-row">
                @csrf
            @foreach($ticketData as $t)
            <div class="form-group col-sm-4">
                <label for="inputEmail4">Destek No</label>
                <input type="email" class="form-control" placeholder="{{$t['id']}}" readonly>
            </div>
            <div class="form-group col-sm-4">
                <label for="inputPassword4">Durum</label>
                <input type="password" class="form-control" placeholder="{{$t['status']}}" readonly>
            </div>
            <div class="form-group col-sm-4">
                <label for="inputPassword4">Tarih</label>
                <input type="password" class="form-control" placeholder="{{$t['created_at']}}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label for="inputAddress">Konu</label>
            <input type="text" class="form-control" placeholder="{{ $t['title'] }}" readonly>
        </div>
        <div class="form-group mb-4">
            <label>Açıklama</label>
            <textarea name="metin" id="summernote" placeholder="Cevabınızı buraya yazınız.." required></textarea>
            <script>
                $('#summernote').summernote();
            </script>
            <div class="form-group">
                <label>Dosya Ekle</label>
                <input type="file" class="form-control validate" name="file">
            </div>
            <button type="submit" class="btn btn-dark float-right">Gönder</button>
            @endforeach
            </form>
        </div>
    </div>



        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Destek No</th>
                <th>Durum</th>
                <th>Oluşturan</th>
                <th>Konu</th>
                <th>Dosya Eki</th>
                <th>Kayıt Tarihi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ticketData as $t)
                <tr>
                    <td>{{$ticket_id = $t['id']}}</td>
                    <td>{{$t['status']}}</td>
                    <td>{{$t['name']}}</td>
                    <td>{{$t['title']}}</td>
                    <td><a href="{{asset('storage/' . $ticketFile)}}" download>Dosya Ekini İndirmek İçin Tıklayınız.</a>
                    </td>
                    <td>{{$t['created_at']}}</td>
                </tr>
                <tr>
                    <td class="align-self-center border border-dark" colspan="6">
                        {{$t['content']}}</td>
                    @endforeach
                </tr>
            <tr>

                <td colspan="6">@foreach($ticket_files as $tf)<a href="{{asset('storage/'. $tf['file'])}}" download>Dosya eki, </a>@endforeach</td>

            </tr>

            <tbody>
        </table>
    </div>
    <div style="margin: 30px;">
        <form action="{{route('newAnswer')}}" method="post" class="h-100">
            @csrf
            <div class="form-row">
                <div class="col-1">
                    <input type="text" class="form-control" placeholder="{{$ticket_id}}" name="ticket_id"
                           value="{{$ticket_id}}" readonly>
                </div>
                <div class="col-lg">
                    <textarea name="metin" id="summernote" placeholder="Cevabınızı buraya yazınız.."
                              required></textarea>
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-dark float-right align-self-end">Gönder</button>
                </div>
                <script>
                    $('#summernote').summernote();
                </script>
            </div>
        </form>
    </div>

    <div class="x_content">
        <table class="table table-dark table-hover">
            <thead>
            <tr>
                <th>Cevaplayan</th>
                <th>Mesaj</th>
                <th>Cevap Tarihi</th>
            </tr>
            </thead>
            <ul class="list-unstyled">
                @foreach($ticketDetail as $tA)
                    <li class="d-flex
                    @if($tA['name']==Auth::user()->name){
                        justify-content-end
                    }@else{
                        justify-content-start
                    }
                    @endif
                     mb-4">
                        <div class="card w-50">
                            <div class="card-header d-flex justify-content-between p-3">
                                <p class="fw-bold mb-0">{{$tA['name']}}</p>
                                <p class="text-muted small mb-0"><i class="far fa-clock"></i>{{$tA['created_at']}}</p>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">{!!$tA['reply']!!}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>


            {{--            @foreach($ticketDetail as $tA)--}}
            {{--                <tr>--}}
            {{--                    <td>{{$tA['name']}}</td>--}}
            {{--                    <td>{!!$tA['reply']!!}</td>--}}
            {{--                    <td>{{$tA['created_at']}}</td>--}}
            {{--                </tr>--}}
            {{--            @endforeach--}}

        </table>
    </div>
@endsection
