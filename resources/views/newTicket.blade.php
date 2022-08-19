@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

{{--    <div class="container">--}}
{{--        <form action="{{route('openTicket')}}" method="post" enctype="multipart/form-data">--}}
{{--            @csrf--}}
{{--            <div class="modal-dialog">--}}
{{--                <div class="modal-content">--}}
{{--                    <div class="text-center">--}}
{{--                        <h4 class="modal-title text-center w-100 font-weight-bold">New Ticket</h4>--}}
{{--                        <h6 class="modal-title text-center w-100 font-weight-bold">{{Auth::user()->name}}</h6>--}}
{{--                    </div>--}}

{{--                    <div class="modal-body mx-3">--}}
{{--                        <div class="mb-5">--}}
{{--                            <div class="d-flex justify-content-start">--}}
{{--                                <h5>Current State:</h5>--}}
{{--                                <select class="form-select form-select-lg mb-3 ml-3"--}}
{{--                                        aria-label="Disabled select example"--}}
{{--                                        disabled>--}}
{{--                                    <option value="1">Yanıt Bekliyor</option>--}}
{{--                                    <option value="2">İşlemde</option>--}}
{{--                                    <option value="1">Kapalı</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="border border-dark text-center">--}}
{{--                                <label>Oluşturulma Tarihi:</label>--}}
{{--                                <i class="fas fa-envelope prefix grey-text"><?php use Carbon\Carbon;--}}
{{--                                    echo Carbon::now(+3);?></i>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="md-form mb-5">--}}
{{--                            <label>Subject</label>--}}
{{--                            <i class="fas fa-envelope prefix grey-text"></i>--}}
{{--                            <input type="text" class="form-control validate" name="konu">--}}
{{--                        </div>--}}
{{--                        <label for="floatingTextarea2">Description</label>--}}
{{--                        <div class="form-floating">--}}
{{--                            <textarea class="form-control" placeholder="Explain Your Problem Here" name="metin"--}}
{{--                                      style="height: 100px"></textarea>--}}
{{--                        </div>--}}

{{--                        <div class="md-form mb-5">--}}
{{--                            <label>Dosya Ekle</label>--}}
{{--                            <i class="fas fa-envelope prefix grey-text"></i>--}}
{{--                            <input type="file" class="form-control validate" name="file[]" multiple>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="modal-footer d-flex justify-content-center">--}}
{{--                        <button type="submit" class="btn btn-primary">Open ticket</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}



    <div class="x_content p-5 d-flex justify-content-center">
        <form action="{{route('openTicket')}}" method="post" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group ">
                </div>

            </div>

            <div class="form-row">
                <div class="form-group ">
                    <label>Tarih</label>
                    <input type="text" class="form-control"
                           placeholder="@php echo Illuminate\Support\Carbon::now(+3); @endphp" readonly>
                </div>

                <div class="form-group ">
                    <label>Konu</label>
                    <input type="text" class="form-control" name="title">
                </div>
            </div>

            <br>

            <div class="form-group">
                <label>Açıklama</label>
                <br>
                <textarea class="form-control" name="ticket_content" required></textarea>
            </div>

            <br>

            <div class="form-group ">
                <label>Dosya Ekle</label>
                <i class="fas fa-envelope prefix grey-text"></i>
                <input type="file" class="form-control validate" name="file[]" multiple>
            </div>

            <br>

            <div class="form-group ">
                <button type="submit" class="btn btn-dark float-left">Gönder</button>
            </div>

        </form>
    </div>
@endsection
