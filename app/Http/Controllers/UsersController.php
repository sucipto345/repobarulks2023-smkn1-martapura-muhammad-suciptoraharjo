<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index()
    {
        // mengambil data dari table users
        $users = DB::table('users')->get();

        // mengirim data users ke view index
        return view('index', ['users' => $users]);
    }
}
