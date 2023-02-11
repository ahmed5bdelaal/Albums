<?php

namespace App\Http\Controllers;

use App\Models\image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $photos = Image::all();
        return view('photos.index',compact('photos'));
    }

    public function create(int $album_id)
    {
        return view('photos.create', compact('album_id'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'photo' => 'required|image|max:1999',
            'description' => 'required'

        ]);

        $filenameWithExt = $request->file('photo')->getClientOriginalName();

        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        $extension = $request->file('photo')->getClientOriginalExtension();

        $fileNameToStore = $filename . '_' . time() . '.' . $extension;

        $path = $request->file('photo')->storeAs('public/albums/',$fileNameToStore);

        $photo = new image;
        $photo->name = $request->input('title');
        $photo->album_id = $request->input('album_id');
        $photo->slug = $fileNameToStore;
        $photo->save();

        return redirect('/albums/' . $request->input('album_id'))->with('success', 'Photo created');
    }

    public function show(Image $photo)
    {
        $photo = Image::findOrFail($photo->id);
        return view('photos.show', compact('photo'));
    }

    public function destroy($id)
    {
        $photo = Image::findOrFail($id);
        if(Storage::exists('/public/albums/'.$photo->album_id.'/'.$photo->slug)){
            Storage::delete('/public/albums/'.$photo->album_id.'/'.$photo->slug);
        }
        $photo->delete();
        return redirect('/albums/' . $photo->album_id)->with('success', 'Photo deleted');
    }
}
