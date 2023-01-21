<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Type;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APITypeController extends Controller

{
    use HelperTrait;

    public function index()
    {
        if ($type = Type::paginate(10)) {
            return $this->GetDataWithArray($type);
        }
        else
        {
            return $this->ReturnError();
        }
    }

    public function show(Request $request)
    {
        $id = $request->id;
        if ($type = Type::find($id)) {
            return $this->GetDataWithArray($type);
        } else {
            return $this->ReturnError();
        }
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name_en' => 'required',
            'name_ar' => 'required',
        ]);

        $data = $request->only('name_en', 'name_ar', 'type_id');
        Type::create($data);
        return $this->GetDataWithArray($data);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $type = Type::find($id);
        $this->validate($request, [
            'name_en' => 'required',
            'name_ar' => 'required',
        ]);

        $type->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'type_id' => $request->type_id,
        ]);
        return $this->GetDataWithArray($type);
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        if ($type = Type::find($id)) {
            $type->delete();
            $post = Post::where('type_id', $id);
            $post->delete();
            return $this->GetDataWithArray($type);
        } else {
            return $this->ReturnError();
        }
    }
}
