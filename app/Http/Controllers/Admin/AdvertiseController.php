<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Str;

use App\Models\Advertise;
use App\Models\Images;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;
use File;

class AdvertiseController extends Controller
{
    function saveImage($file, $path = 'uploads/', $maxWidth = 1500, $maxHeight = 500) {
        $originalFilename = $file->getClientOriginalName();
        $filenameWithoutExtension = Str::slug(pathinfo($originalFilename, PATHINFO_FILENAME), '-');
        $extension = $file->getClientOriginalExtension();
        $filename = $filenameWithoutExtension . '.' . $extension;

        // Handle duplicate filenames
        while (file_exists(public_path($path . $filename))) {
            $filename = $filenameWithoutExtension . '_' . rand(0, 99) . '.' . $extension;
        }

        // Check if the file is a GIF
        if (strtolower($extension) === 'gif') {
            // No resizing for GIFs, just save them as they are
            $file->move(public_path($path), $filename);
        } else {
            // Resize non-GIFs
            $img = Image::make($file);
            $img->resize($maxWidth, $maxHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save(public_path($path . $filename));
        }

        return $filename;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Advertise::find(1);
        $images = Images::get();
        return view('admin.advertise.index', compact('data', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
        $data = $request->all();
        $Advertise = Advertise::find($id);
        $Advertise->name = $data['name'];
        $Advertise->content = $data['content'];
        $Advertise->save();

        if(isset($data['id_edit'])){
            foreach ($data['id_edit'] as $key => $id_edit) {
                $image = Images::find($id_edit);
                $image->link = $data['link_edit'][$key];
                if($request->hasFile("img_edit.$key")){
                    if(File::exists('uploads/'.$image->img)) { File::delete('uploads/'.$image->img);}
                    $file = $request->file("img_edit.$key");
                    $filename = $this->saveImage($file);
                    $image->img = $filename;
                }
                $image->save();
            }
        }

        if($request->hasFile('img')){
            foreach ($request->file('img') as $key => $file) {
                if(isset($file)){
                    $images = new Images();
                    $filename = $this->saveImage($file);
                    $images->img = $filename;
                    $images->link = $data['link'][$key];
                    $images->save();
                }
            }
        }

        return redirect()->back()->with('success','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function delimg($id)
    {
        $image = Images::find($id);
        if(File::exists('uploads/'.$image->img)) { File::delete('uploads/'.$image->img);}
        $image->delete();
        return response()->json(['success' => true]);
    }

}
