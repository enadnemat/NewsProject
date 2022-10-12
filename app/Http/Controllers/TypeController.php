<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function addtype()
    {
        $types = Type::select('id', 'name_ar', 'name_en', 'type_id')->get();
        return view('Types.addtype', compact('types'));
    }

    public function store(Request $request)
    {
        Type::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'type_id' => $request->type_id,
        ]);
        return redirect('types/add');
    }
}
