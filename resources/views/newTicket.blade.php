@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <div class="container">
        <form action="{{route('openTicket')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="text-center">
                        <h4 class="modal-title text-center w-100 font-weight-bold">New Ticket</h4>
                        <h6  class="modal-title text-center w-100 font-weight-bold">{{Auth::user()->name}}</h6>
                    </div>

                    <div class="modal-body mx-3">
                        <div class="mb-5">
                            <div class="d-flex justify-content-start">
                            <h5>Current State:</h5>
                            <select class="form-select form-select-lg mb-3 ml-3" aria-label="Disabled select example"
                                    disabled>
                                <option value="1">Yanıt Bekliyor</option>
                                <option value="2">İşlemde</option>
                                <option value="1">Kapalı</option>
                            </select>
                            </div>
                            <div class="border border-dark text-center">
                            <label>Create Time:</label>
                            <i class="fas fa-envelope prefix grey-text"><?php use Carbon\Carbon;
                                echo Carbon::now(+3);?></i>
                            </div>
                        </div>

                        <div class="md-form mb-5">
                            <label>Subject</label>
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <input type="text" class="form-control validate" name="konu">
                        </div>
                        <label for="floatingTextarea2">Description</label>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Explain Your Problem Here" name="metin"
                                      style="height: 100px"></textarea>
                        </div>

                        <div class="md-form mb-5">
                            <label>Dosya Ekle</label>
                            <i class="fas fa-envelope prefix grey-text"></i>
                            <input type="file" class="form-control validate" name="file[]" multiple>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Open ticket</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
