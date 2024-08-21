<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str;

use App\Models\Data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use File;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 100); 
        $key = $request->get('key', '');
        
        $query = Data::query();

        if ($key) {
            $query->where('Bin', 'like', '%' . $key . '%');
        }

        $Datas = $query->paginate($perPage);

        return view('admin.data.index', compact('Datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Data = Data::where('sort_by', 'Product')->get();
        return view('admin.Data.create', compact('Data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'txt_file' => 'required|file|mimes:txt',
        ]);

        $file = $request->file('txt_file');

        $fileContent = file($file->getRealPath(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($fileContent as $line) {
            $data = explode('"', $line);
            // input data
            DB::table('data')->insert([
                'Bin' => $data[0],
                'Brand' => $data[1],
                'Type' => $data[2],
                'Level' => $data[3],
                'Bank' => $data[4],
                'Countries' => $data[5],
            ]);
            // input bank
            // DB::table('bank')->insert([
            //     'name' => $data[0],
            // ]);
            // input country
            // DB::table('country')->insert([
            //     'name' => $data[0],
            // ]);
        }

        return back()->with('success', 'success.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Data::find($id);
        $Data = Data::where('sort_by', $data->sort_by)->get();
        return view('admin.Data.edit', compact('data', 'Data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect('admin/Data')->with('success','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Data::find($id)->delete();
        return redirect()->back();
    }

    public function dellall()
    {
        $datas = Data::take(20000)->get();
        foreach($datas as $val){
            Data::find($val->id)->delete();
        }
        return redirect()->back();
    }
}
