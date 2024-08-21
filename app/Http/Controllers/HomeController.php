<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\User;
use App\Models\Data;
use App\Models\Bank;
use App\Models\Country;
use Mail;
use Image;
use File;

class HomeController extends Controller
{
    function __construct()
    {
        // $post_news = Post::orderBy('id', 'desc')->take(5)->get();
        view()->share( [
            // 'post_news'=>$post_news,
        ]);
    }

    public function index()
    {
        $banks = Bank::orderBy('name', 'asc')->get();
        $countrys = Country::orderBy('name', 'asc')->get();

        return view('pages.home', compact(
            'banks',
            'countrys',
        ));
    }

    public function search(Request $request)
    {
        $banks = Bank::orderBy('name', 'asc')->get();
        $countrys = Country::orderBy('name', 'asc')->get();

        $datas = Data::orderBy('id', 'DESC');
        if($key = request()->key){
            $datas->where('Bin', $key);
        }
        if($country = request()->country){
            $datas->where('Countries', $country);
        }
        $datas = $datas->take(1000);

        return view('pages.home', compact(
            'banks',
            'countrys',

            'datas',
            'key',
        ));
    }

    
    

   
}
