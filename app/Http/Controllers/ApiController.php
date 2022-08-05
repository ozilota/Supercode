<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function login(){
        $products_data = [
            'username' => 'merve.sariyer',
            'password' => '112358*asd',
        ];

        $php_curl = curl_init();

        curl_setopt_array($php_curl, array(
            CURLOPT_URL => "http://api.tfo.k12.tr/m/giris",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($products_data),
            CURLOPT_HTTPHEADER => array(
                // Set POST here requred headers
                'X-Api-Key' => '9aea45f3-644b-4afc-8f84-dd12a77dc2f0',
                "content-type: application/json",
            ),
        ));

        $final_results = curl_exec($php_curl);
        $err = curl_error($php_curl);

        print_r($final_results);
        curl_close($php_curl);

        if ($err) {
            echo "Laravel cURL Error #:" . $err;
        } else {
            print_r($final_results);
        }
    }

    public function index(){
        return view('api');
    }
}
