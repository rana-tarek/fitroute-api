<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return redirect('admin');
    }
    public function admin()
    {
        return view('admin.home');
    }
    public function login()
    {
        return view('admin.login');
    }
}
