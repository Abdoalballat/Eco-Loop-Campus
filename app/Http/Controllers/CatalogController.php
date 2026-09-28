<?php

namespace App\Http\Controllers;

use App\Models\catalog;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogs =catalog::all();
        // dd(['cat'=>$catalogs]);
        return view('admin-pages.catalog-index',compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request )
    {
        $validated_data =$request->validate([
        'points'=>'integer|required',
        'type'  =>'string|required',
        ]);
        $validated_data['points']=$validated_data['points']/100;
        catalog::create($validated_data);
        return redirect()->back()->with('success', 'Material added successfully');
        }
        
        public function update(Request $request, catalog $catalog)
    {
        $validated_data =$request->validate([
        'points'=>'integer|min:1',
        'type'  =>'string',
        ]);
        $validated_data['points']=$validated_data['points']/100;
        $catalog->update($validated_data);
        if($request->wantsJson())
            {
                return response()->json(['status' => 'success','message'=>'updated']);  
            }
        return redirect()->back()->with('success', 'Material updated successfully');
        
        }
        
        /**
         * Remove the specified resource from storage.
        */
        public function destroy(catalog $catalog)
    {
        $catalog->delete();
        return redirect()->back()->with('success', 'Material Deleted successfully');

    }
}
