<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use App\Models\Type;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create()
    {
        $types = Type::select('id', 'name_ar', 'name_en', 'type_id')->get();
        return view('addpost', compact('types',));
    }

    public function store(Request $request)
    {
//        //save image in folder
//        $file_name = time() . '.' . $request->photo->extension();
//        $path = 'posts/posts';
//        $request->photo->move(public_path($path), $file_name);

        //insert to database
        $post = Post::create([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'type_id' => $request->type_id,
            'sub_type' => $request->sub_type,
        ]);

        //$image = $request->file('file');
        foreach ($request->photos as $photo) {

            $post_id = $post->id;/////

            $fileInfo = $photo->getClientOriginalName();/////

            $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
            $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);

            $file_name = $filename . '-' . time() . '.' . $extension;/////

            $photo->move(public_path('photos/posts'), $file_name);

            $imageUpload = new Photo;
            $imageUpload->post_id = $post_id;
            $imageUpload->original_filename = $fileInfo;
            $imageUpload->filename = $file_name;
            $imageUpload->save();
        }
    }

    public function fetchType(Request $request)
    {
        $data['types'] = Type::where("type_id", $request->type_id)
            ->get(['id', 'name_en', 'name_ar',]);
        return response()->json($data);
    }

    public function viewpost(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::withCount('photos')->with('type')->whereRelation('type', 'type_id');
            return Datatables($posts)
                ->setRowId('id')
                ->addColumn('viewPhoto', function ($row) {
                    return '<a href="' . url('posts/photos/' . $row->id) . '" id="photo" class="btn btn-sm btn-warning">View Photos</a>';
                })
                ->addColumn('delete', function ($row) {
                    return '<a href=""  post_id="' . $row->id . '" class="delete_btn btn btn-sm btn-danger">Delete</a>';
                })
                ->addColumn('edit', function ($row) {
                    return '<a href="' . url('posts/edit/' . $row->id) . '" id="edit" class="btn btn-sm btn-primary">Edit</a>';
                })
                ->rawColumns(['viewPhoto', 'delete', 'edit'])
                ->make(true);
        } else {
            return view('viewpost');
        }
        //$types = Type::select('id', 'name_en', 'name_ar')->get();
        //$posts = Post::select('id', 'title_en', 'title_ar', 'description_en', 'description_ar', 'photo', 'type_id','sub_type')->get();
        //$post = Post::with('type')->whereRelation('type','type_id')->get();
        //return view('viewpost', compact('post'));
    }

    public function delete(Request $request)
    {
        $posts = Post::find($request->id);
        $photo = Photo::where('post_id', $request->id);
        $posts->delete();
        $photo->delete();
        return response()->json();
    }

    public function edit($id)
    {
        $post = Post::select('id', 'title_en', 'title_ar', 'description_en', 'description_ar', 'photo', 'type_id')->find($id);
        $types = Type::select('id', 'name_ar', 'name_en')->get();
        return view('edit', compact('post', 'types'));
    }

    public function update(Request $request, $id)
    {
        //update
        $post = Post::find($id);

        $post->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_en,
            'type_id' => $request->type_id,
        ]);
        return redirect()->back();
    }
}
