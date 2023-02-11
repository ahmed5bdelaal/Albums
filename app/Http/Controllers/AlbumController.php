<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function index()
     {
        $albums=Album::select('id','name')->get();
        $label= [];
        $photoCount=[];
        foreach ($albums as $album){
            $label[]=$album->name;
            $photoCount[]=$album->photos->count();
        }
         return view('albums.index',compact('label','photoCount'));
     }

    public function getUserDatatable()
    {
        $data = Album::select('*');
        return DataTables::of($data)
        ->addIndexColumn()
        ->addcolumn('action',function($row){
            return $btn ='
            <a href="'.route('albums.show',$row->id).'" class="btn btn-primary btn-sm">show</a>';
            
        })
        ->rawColumns(['action'])
        ->make(true);
        
    }


    public function create()
    {
        return view('albums.create');
    }


    public function show(Album $album)
    {
        $album = Album::findOrFail($album->id);

        return view('albums.show', compact('album'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        // Create album
        $album = new Album;
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->save();

        return redirect('/albums')->with('success', 'Album created');
    }

    public function edit($id)
    {
        $album = Album::findOrFail($id);

        return view('albums.edit', compact('album'));
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        // Create album
        $album = Album::where('id',$id)->first();
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->update();

        return redirect('/albums')->with('success', 'Album updated');
    }
    
    public function trans($id){
        $albums = Album::where('id','!=',$id)->get();
        return view('albums.trans',compact('id','albums'));
    }

    public function transfer($album,$id){
        $photos=Image::where('album_id',$id)->get();
        
        foreach ($photos as $photo){
            $photo->album_id = $album;
            $photo->update();
        }

        $album = Album::findOrFail($id);
        $album->delete();

        return redirect('/albums')->with('success', 'photos transfered successfuly');
    }

    public function destroy($id)
    {   
        $photos = Image::where('album_id',$id)->get();
        foreach($photos as $photo){
            Storage::delete('/public/albums/'.$photo->slug);
        }
        $album = Album::findOrFail($id);
        $album->delete();
        return redirect('/albums')->with('success', 'Album deleted');
    }

}
