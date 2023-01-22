<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Post;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::select('id', 'name_ar', 'name_en', 'type_id')->get();
        return view('Types.addtype', compact('types'));
    }


    public function store(Request $request)
    {
        $data = $request->only('name_en', 'name_ar', 'type_id');
        Type::create($data);
        return redirect('types/add');
    }

    public function delete($id)
    {
        $type = Type::where('id', $id);

        $post = Post::where('type_id', $id);
        $type->delete();
        $post->delete();
        $types = Type::select('id', 'name_ar', 'name_en', 'type_id')->get();
        return redirect()->back()->with(compact('types'));
    }

    public function view()
    {
        #####-----IMPORTANT!-----#####
        //$types = Type::withCount('posts')->get();
        return view('Types.viewtypes');
    }

    public function getTypes(Request $request)
    {
        //$type = Type::all();
        //return response()->json($types);
        if ($request->ajax()) {
            $types = Type::withCount('posts');
            return Datatables($types)
                ->setRowId('id')
                ->addIndexColumn()
                ->addColumn('delete', function ($row) {
                    return '<a href="' . url('types/delete/' . $row->id) . '" id="delete" class="btn btn-sm btn-danger">Delete</a>';
                })
                ->addColumn('edit', function ($row) {
                    return '<a href="' . url('types/edit/' . $row->id) . '" id="edit" class="btn btn-sm btn-primary">edit</a>';
                })
                ->rawColumns(['delete', 'edit'])
                ->make(true);

        } else {
            return view('Types.viewtypes');
        }
    }

    public function edit($id)
    {
        $ttype = Type::find($id)->first();
        $types = Type::select('id', 'name_ar', 'name_en', 'type_id')->get();
        return view('Types.edit', compact('types', 'ttype'));
    }

    public function update(Request $request, $id)
    {
        //update
        $type = Type::find($id);

        $type->update([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'type_id' => $request->type_id,
        ]);
        return redirect()->back();
    }
}
