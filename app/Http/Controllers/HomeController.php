<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // public function index()
    // {
    //     $data = array(
    //         'title' => 'Home page'
    //     );

    //     return view('index',$data);
    //     // return view('home',$data);
    // }

    function admin(){
        if(Auth::user()->role != 'admin'){
            return redirect()->route('login')->with('failed', 'Akses ditolak, hanya admin yang bisa masuk.');
        }
        return view('halaman/dashboard1');
    }
    
    function kasir(){
        if(Auth::user()->role != 'kasir'){
            return redirect()->route('login')->with('failed', 'Akses ditolak, hanya kasir yang bisa masuk.');
        }
        return view('halaman/dashboard2');
    }
    

}
