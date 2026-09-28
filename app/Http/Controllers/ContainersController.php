<?php

namespace App\Http\Controllers;

use App\Models\containers;
use Illuminate\Http\Request;

class ContainersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $containers =containers::latest()->paginate(10);
        return view('admin-pages.containers-index',compact('containers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin-pages.create-container');

    }
public function edit($id)
{
    $container = containers::findOrFail($id);

    return view('admin-pages.containers-edit', compact('container'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data=$request->validate([
        'serial_number' =>'required|string|unique:containers,serial_number',
        'location_name' =>'required|string',
        'status' =>'required|string',
        'fill_level' =>'required|numeric',
        'latitude' =>'required|numeric',
        'longitude' =>'required|numeric',
        ]);
        // dd($validated_data);
        $data = containers::create($validated_data);
        return redirect()->route('containers.index')->with(['success'=>'Container has been added']);
    }

    public function update(Request $request, containers $containers)
    {
        $validated_data=$request->validate([
            'serial_number' =>'string',
            'location_name' =>'string',
            'status'=>'string',
            'latitude' =>'numeric',
            'longitude' =>'numeric',
            'fill_level'=>'numeric',
            ]);
            // dd($validated_data);
        
        $containers->update($validated_data);
        return redirect()->route('containers.index')->with('success','container has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(containers $containers)
    {
        // $container = containers::findOrFail($containers);
        $containers->delete();
        return redirect()->route('containers.index')->with('success','container has been Deleted');
    }
}
