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

    public function index(Request $request)
    {
        // $banks = Bank::orderBy('name', 'asc')->get();
        // $countrys = Country::orderBy('name', 'asc')->get();

        $perPage = $request->get('per_page', 1000);

        if (!$request->hasAny(['bin', 'bank', 'country'])) {
            $Datas = new LengthAwarePaginator([], 0, $perPage, 1, [
                'path' => LengthAwarePaginator::resolveCurrentPath()
            ]);
        } else {
            $bins = array_filter(preg_split('/\r\n|\r|\n/', $request->get('bin', '')));
            $vendors = (array) $request->get('vendor', []);
            $Types = (array) $request->get('Type', []);
            $Levels = (array) $request->get('Level', []);

            $query = Data::query();
            if (!empty($bins)) {
                $query->whereIn('Bin', $bins);
            }
            if (!empty($vendors)) {
                $query->whereIn('Brand', $vendors);
            }
            if (!empty($Types)) {
                $query->whereIn('Type', $Types);
            }
            if (!empty($Levels)) {
                $query->whereIn('Level', $Levels);
            }
            if ($request->get('bank', '')) {
                $query->where('bank', $request->get('bank', ''));
            }
            if ($request->get('country', '')) {
                $query->where('Countries', $request->get('country', ''));
            }
            $Datas = $query->paginate($perPage);
        }

        return view('pages.home', compact(
            'request',
            'banks',
            'countrys',
            'Datas',
        ));
    }

    // public function search(Request $request)
    // {
    //     $banks = Bank::orderBy('name', 'asc')->get();
    //     $countrys = Country::orderBy('name', 'asc')->get();

    //     $datas = Data::orderBy('id', 'DESC');
    //     if($key = request()->key){
    //         $datas->where('Bin', $key);
    //     }
    //     if($country = request()->country){
    //         $datas->where('Countries', $country);
    //     }
    //     $datas = $datas->take(1000);

    //     return view('pages.home', compact(
    //         'banks',
    //         'countrys',

    //         'datas',
    //         'key',
    //     ));
    // }

    
    

   
}
