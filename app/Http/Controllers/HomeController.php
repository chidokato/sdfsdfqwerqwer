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
use App\Models\Advertise;
use App\Models\Images;
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
        $advertise = Advertise::find(1);
        $images = Images::get();

        return view('pages.home', compact(
            'banks',
            'countrys',
            'advertise',
            'images',
        ));
    }

    public function search(Request $request)
    {
        $advertise = Advertise::find(1);
        $banks = Bank::orderBy('name', 'asc')->get();
        $countrys = Country::orderBy('name', 'asc')->get();

        $bins = array_filter(preg_split('/\r\n|\r|\n/', $request->bin));

        $datas = Data::orderBy('Bin', 'ASC');
        if (!empty($bins)) {
            $datas->whereIn('Bin', $bins);
        }
        if ($vendors = $request->vendor) {
            $datas->whereIn('Brand', $vendors);
        }
        if ($Level = $request->Level) {
            $datas->whereIn('Level', $Level);
        }
        if($country = request()->country){
            $datas->where('Countries', $country);
        }
        if($bank = request()->bank){
            $datas->where('Bank', $bank);
        }
        if($Type = request()->Type){
            $datas->where('Type', $Type);
        }
        $datas = $datas->take(3000)->get();

        return view('pages.home', compact(
            'banks',
            'countrys',

            'datas',
            'advertise',
        ));
    }

    
    

   
}
