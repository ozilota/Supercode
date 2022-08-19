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

    @if(Auth::user()->is_admin)
    <div>
        <button class="btn btn-dark d-flex justify-content-end"><a data-target="#editStatus" role="button"
                                                                   data-toggle="modal"> Çözümle </a></button>
    </div>

    <div id="editStatus" class="modal fade">
        <div class="modal-dialog modal-lg modal-dialog-centered ">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Çözümleme Merkezi</h4>
                    <button type="button" class="btn-close" aria-label="Close" data-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('resolveTicket') }}" method="post">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-5">
                                <p class="font-bold">Çözüm Tarihi: @php echo Illuminate\Support\Carbon::now(+3); @endphp</p>
                            </div>
                            <div class="col-2">
                                <label>Çözüm süresi(saat)</label>
                                <select class="form-select" name="spent_time" aria-label="Default select example">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                </select>
                            </div>

                            <div class="form-group col-5" >
                                <label>Çözüm tipi</label>
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option value="Yanıt Bekliyor">Yanıt Bekliyor</option>
                                    <option value="İşlemde">İşlemde</option>
                                    <option value="Kapalı">Kapalı</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <input type="hidden" class="form-control" placeholder="{{$ticketID}}" name="ticket_id"
                                   value="{{$ticketID}}" readonly>
                        </div>
                        <br>

                        <label>Çözüm metni</label>
                        <div class="form-floating">
                            <textarea class="form-control"></textarea>
                        </div>
                        <br/>
                        <button type="submit" class="btn btn-dark">Güncelle</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @endif

    <div class="x_content p-5">

        <form action="{{route('newAnswer')}}" method="post" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                @foreach($ticketData as $t)
                    <div class="form-group col-sm-4">
                        <label>Destek No</label>
                        <input type="text" class="form-control" placeholder="{{$t['id']}}" name="ticket_id"
                               value="{{$t['id']}}" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Durum</label>
                        <input type="text" class="form-control" placeholder="{{$t['status']}}" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label>Tarih</label>
                        <input type="text" class="form-control" placeholder="{{$t['created_at']}}" readonly>
                    </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-6">
                    <label>Konu</label>
                    <input type="text" class="form-control" placeholder="{{ $t['title'] }}" readonly>
                </div>
                <div class="form-group col-sm-6 rounded-left">
                    <label>Dosyalar</label>
                    <div>@foreach($ticket_files as $tf)<a href="{{asset('storage/'. $tf['file'])}}" download>Dosya eki
                            | </a>@endforeach</div>
                </div>
            </div>
            <div class="form-group">
                <label>Açıklama</label>
                <span class="form-text">{{$t['content']}}</span>
            </div>
            @endforeach
            <hr>
            <br>

            <div class="form-group mb-4">
                <label>Cevap</label>
                <textarea name="ticket_content" id="summernote" required></textarea>
                <script>
                    $('#summernote').summernote();
                </script>
                <div class="form-group">
                    <label>Dosya Ekle</label>
                    <i class="fas fa-envelope prefix grey-text"></i>
                    <input type="file" class="form-control validate" name="file[]" multiple>
                </div>
                <button type="submit" class="btn btn-dark float-right">Gönder</button>
            </div>
        </form>
    </div>

    <hr>
    <br>

    <div class="x_content">
        <table class="table table-dark table-hover">
            <ul class="list-unstyled">
                @foreach($ticketDetail as $tA)
                    <li class="d-flex
                    @if($tA['name']==Auth::user()->name){
                        justify-content-end
                    }@else{
                        justify-content-start
                    }
                    @endif
                        mb-4 m-4">
                        <div class="card w-50 ml-3 mr-3">
                            <div class="card-header d-flex justify-content-between p-3">
                                <p class="fw-bold mb-0">{{$tA['name']}}</p>
                                <p class="text-muted small mb-0"><i class="far fa-clock"></i>{{$tA['created_at']}}</p>
                            </div>

                            <div class="card-body">
                                <p class="mb-0">{!!$tA['content']!!}</p>
                            </div>

                            <div class="card-body">
                                <label class="d-flex justify-content-end">Dosya Ekleri</label>
                                <p class="d-flex justify-content-end"><a href="#" download>Dosya eki </a></p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </table>
    </div>
@endsection
