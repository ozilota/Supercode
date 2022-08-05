<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Ticket</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>

</head>
<body>
<form action="{{route('login')}}" method="post">
    @csrf
    <label>Username</label>
    <input type="text" name="adsoyad" required><br>

    <label>Password</label>
    <input type="password" name="konu" required><br>

    <button type="submit" name="ilet" value="Gönder">Gönder</button>
</form>
<div style="height: 100px;"></div>
<table>
    <tr>
        <th>Destek No</th>
        <th>Durum</th>
        <th>Oluşturulma Tarihi</th>
        <th>Güncelleme Tarihi</th>
        <th>Oluşturan</th>
        <th>Cevaplayan</th>
        <th style="width: 170px;">Konu</th>
    </tr>
    <tr>
        <td>1</td>
        <td>Kapalı</td>
        <td>22.06.2022 13.59</td>
        <td>26.06.2022</td>
        <td>Özgür Turhan</td>
        <td>Oğuzhan Er</td>
        <td>Laravel Öğrenme</td>
    </tr>
</table>

</body>
</html>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Ticket</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body style="height: 100%; background-color: #4a5568">
<div class="h-100 d-flex align-items-center justify-content-center border border-light p-3 mb-4">
    <div style="height: 200px;">
        <form  action="{{route('login')}}" method="post">
            @csrf
            <label>Username</label>
            <input type="text" name="email" required><br>

            <label>Password</label>
            <input type="password" name="password" required><br>

            <button type="submit" name="ilet" value="Gönder">Gönder</button>
        </form>
    </div>
</div>
</body>
</html>
