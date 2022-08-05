<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Ticket</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    </head>
    <body>
    <form action="{{route('openTicket')}}" method="post">
        @csrf
        <label>Ad Soyad</label>
        <input type="text" name="adsoyad" required><br>

        <label>Konu</label>
        <input type="text" name="konu" required><br>

        <textarea name="metin" style="height:300px; width:400px;"></textarea><br>
        <input type="submit" name="ilet" value="Gönder" required>
    </form>

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
