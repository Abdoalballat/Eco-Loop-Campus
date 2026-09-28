<?php

namespace App\Http\Controllers;

use App\Models\catalog;
use App\Models\materials;
use Illuminate\Http\Request;

class MaterialsController extends Controller
{
// public function index()
//     {
//         $catalog =catalog::all();
//         $materials = materials::with(['container', 'catalog'])->paginate(20);
//         return view('admin-pages.materials-index', compact('materials','catalog'));
//     }

    public function update(Request $request, materials $material)
    {
        $material->update(['current_weight' => 0]);

        return back()->with('success', 'Container material inventory cleared.');
    }
}
