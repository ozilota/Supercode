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

    <div class="p-5">
        <form class="mb-5">
            <div class="form-row">
                <div class="form-group col-sm-4">
                    <label for="inputEmail4">Destek No</label>
                    <input type="email" class="form-control" placeholder="22" readonly>
                </div>
                <div class="form-group col-sm-4">
                    <label for="inputPassword4">Durum</label>
                    <input type="password" class="form-control" placeholder="Yanıt Bekliyor" readonly>
                </div>
                <div class="form-group col-sm-4">
                    <label for="inputPassword4">Tarih</label>
                    <input type="password" class="form-control" placeholder="gg/aa/yy saat" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="inputAddress">Konu</label>
                <input type="text" class="form-control" placeholder="Printer Bozuk" readonly>
            </div>
            <div class="form-group mb-4">
                <label>Açıklama</label>
                <textarea name="metin" id="summernote" placeholder="Cevabınızı buraya yazınız.." required></textarea>
                <script>
                    $('#summernote').summernote();
                </script>
            </div>
            <div class="form-group">
                <label>Dosya Ekle</label>
                <input type="file" class="form-control validate" name="file">
            </div>
            <button type="submit" class="btn btn-dark float-right">Gönder</button>
        </form>
    </div>
    <div class="mt-5">
        <hr class="bg-dark border-2 border-top border-danger">
    </div>

    <div class="col-md-6 col-lg-7 col-xl-8">

        <ul class="list-unstyled">
{{--            @foreach($ticketDetail as $tA)--}}
{{--            <li class="d-flex justify-content-between mb-4">--}}
{{--                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"--}}
{{--                     class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header d-flex justify-content-between p-3">--}}
{{--                        <p class="fw-bold mb-0">{{$tA['name']}}</p>--}}
{{--                        <p class="text-muted small mb-0"><i class="far fa-clock"></i>{{$tA['created_at']}}</p>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <p class="mb-0">{!!$tA['reply']!!}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </li>--}}
{{--            @endforeach--}}


            <li class="d-flex justify-content-between mb-4">
                <div class="card w-100">
                    <div class="card-header d-flex justify-content-between p-3">
                        <p class="fw-bold mb-0">Lara Croft</p>
                        <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">
                            Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                            laudantium.
                        </p>
                    </div>
                </div>
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-5.webp" alt="avatar"
                     class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
            </li>
            <li class="d-flex justify-content-between mb-4">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
                     class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                        <p class="fw-bold mb-0">Brad Pitt</p>
                        <p class="text-muted small mb-0"><i class="far fa-clock"></i> 10 mins ago</p>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.
                        </p>
                    </div>
                </div>
            </li>
            <li class="bg-white mb-3">
                <div class="form-outline">
                    <textarea class="form-control" id="textAreaExample2" rows="4"></textarea>
                    <label class="form-label" for="textAreaExample2">Message</label>
                </div>
            </li>
            <button type="button" class="btn btn-info btn-rounded float-end">Send</button>
        </ul>

    </div>

    </div>

@endsection
