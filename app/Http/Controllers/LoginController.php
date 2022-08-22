<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $headers = ['X-Api-Key' => '9aea45f3-644b-4afc-8f84-dd12a77dc2f0'];
        $client = new Client(['headers' => $headers]);
        $res = $client->request('POST', 'http://api.tfo.k12.tr/t/signin', [
            'form_params' => [
                'username' => $request->email,
                'password' => $request->password,
            ]
        ]);

        $body = json_decode($res->getBody()->getContents());

        if ($body->result == 0) {
            return back()->with('error', 'Your informations are incorrect.');
        } else {
            if (
                DB::table('users')
                    ->select('id', 'name')
                    ->where('id', '=', $body->response->personnelID)
                    ->where('name', '=', $body->response->username)
                    ->exists()
            ) {

                $administrationData = DB::table('users')
                    ->select('is_admin')
                    ->where('id', '=', $body->response->personnelID)
                    ->get();

                $user = new User();
                $user->login = $request->email;
                $user->id = $body->response->personnelID;
                $user->name = $body->response->username;
                $admin = json_decode($administrationData);
                $user->is_admin = $admin[0]->is_admin;
                Auth::setUser($user);

                if (Auth::login($user)) {
                    return redirect()->route('home');
                }

                return redirect()->route('home');

            } else {
                $admin = 0;
                if($body->response->departmentID == 19){
                    $admin = 1;
                }
                DB::table('users')
                    ->insert([
                        'id' => $body->response->personnelID,
                        'username' => $request->email,
                        'name' => $body->response->username,
                        'email' => $body->response->email,
                        'school_id' => $body->response->schoolID,
                        'school_name' => $body->response->schoolName,
                        'job_definition' => $body->response->jobDefinition,
                        'department_id' => $body->response->departmentID,
                        'department_name' => $body->response->departmentName,
                        'is_admin' => $admin,
                    ]);

                $user = new User();
                $user->login = $request->email;
                $user->id = $body->response->personnelID;
                $user->name = $body->response->username;
                $user->school_name = $body->response->schoolName;
                $user->department_name = $body->response->departmentName;
                $user->job = $body->response->jobDefinition;
                $user->email = $request->email;
                $user->is_admin = 0;
                Auth::setUser($user);

                if (Auth::login($user)) {
                    return redirect()->route('home');
                }

                return redirect()->route('home');
            }
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
