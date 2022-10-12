<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Type;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function addpost()
    {
        $types = Type::select('id', 'name_ar', 'name_en')->get();
        return view('addpost', compact('types'));
    }

    public function store(Request $request)
    {

        // save image in folder
        $file_name = time() . '.' . $request->photo->extension();
        $path = 'images/posts';
        $request->photo->move(public_path($path), $file_name);


        //insert to database
        Post::create([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'photo' => $file_name,
            'type_id' => $request->type_id
        ]);
        return redirect('posts/add');
    }


    public function viewpost()
    {
        $types = Type::select('id','name_en','name_ar')->get();
        $posts = Post::select('id', 'title_en', 'title_ar', 'description_en', 'description_ar', 'photo', 'type_id')->get();
        return view('viewpost', compact('posts' , 'types'));
    }

    public function delete($id)
    {
        $post = Post::where('id', $id)->first();
        $post->delete();
        $posts = Post::select('id', 'title_en', 'title_ar', 'description_en', 'description_ar', 'photo', 'type_id')->get();
        return view('viewpost', compact('posts'));

    }

    public function edit($id)
    {
        $post = Post::find($id);
        $post = Post::select('id','title_en', 'title_ar', 'description_en', 'description_ar', 'photo', 'type_id')->find($id);
        $types = Type::select('id', 'name_ar', 'name_en')->get();
        return view('edit', compact('post', 'types'));
    }

    public function update(Request $request, $id)
    {
        //update
        $post = Post::find($id);
//
//        $post->title_en = $request->get('title_en');
//        $post->title_ar = $request->get('title_ar');
//        $post->description_en = $request->get('description_en');
//        $post->description_ar = $request->get('description_ar');

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
