<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{

    public function index($id)
    {
        $photo =Photo::all()->where('post_id',$id);
        return view('viewphoto',compact('photo' ,'id'));
    }

    public function getPhotos($id)
    {
        $images = Photo::all()->where('post_id',$id);
        foreach ($images as $image) {
            $tableImages[] = $image['filename'];
        }
        $file_path = public_path('photos/posts');
        $files = scandir($file_path);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && in_array($file, $tableImages)) {
                $obj['name'] = $file;
                $file_path = public_path('photos/posts/') . $file;
                $obj['size'] = filesize($file_path);
                $obj['path'] = url('photos/posts/' . $file);
                $data[] = $obj;
            }
        }

        //$photo = json_decode($data);
        //return view('addphoto' );
        //dd($data);
       return response()->json($data);
    }

    public function store(Request $request , $id)
    {
        $image = $request->file('file');
        $fileInfo = $image->getClientOriginalName();

        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name = $filename . '-' . time() . '.' . $extension;
        $post_id =$id;
        $image->move(public_path('photos/posts'), $file_name);

        $imageUpload = new Photo;
        $imageUpload->post_id =$post_id;
        $imageUpload->original_filename = $fileInfo;
        $imageUpload->filename = $file_name;
        //$imageUpload->save();
        return response()->json(['success' => $file_name]);
    }

    public function destroy(Request $request)
    {
        $filename = $request->get('filename');
        Photo::where('filename', $filename)->delete();
        $path = public_path('photos/posts') . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success' => $filename]);
    }

}
