<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Post;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;

class APIPostController extends Controller
{
    use HelperTrait;

    public function index()
    {
        if ($post = Post::simplePaginate(10)) {
            return $this->GetDataWithArray($post);
        }
    }

    public function show(Request $request)
    {
        $id = $request->id;
        if ($post = Post::find($id)) {
            return $this->GetDataWithArray($post);
        } else {
            return $this->ReturnError();

        }
    }

    public function create(Request $request)
    {

        $this->validate($request, [
            'title_en' => 'required',
            'title_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'type_id' => 'required',
        ]);

        $data = $request->only('title_en', 'title_ar', 'description_en', 'description_ar', 'type_id');

        Post::create($data);

        return $this->GetDataWithArray($data);
    }

    public function update(Request $request)
    {

        $id = $request->id;

        $post = Post::find($id);

        $this->validate($request, [
            'title_en' => 'required',
            'title_ar' => 'required',
            'description_en' => 'required',
            'description_ar' => 'required',
            'type_id' => 'required',
        ]);

        $post->update([
            'title_en' => $request->title_en,
            'title_ar' => $request->title_ar,
            'description_en' => $request->description_en,
            'description_ar' => $request->description_ar,
            'type_id' => $request->type_id
        ]);

        return $this->GetDataWithArray($post);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        if ($post = Post::find($id)) {
            $photo = Photo::where('post_id', $request->id);
            $post->delete();
            $photo->delete();
            return $this->GetDataWithArray($post);
        } else {
            return $this->ReturnError();
        }


    }
}
