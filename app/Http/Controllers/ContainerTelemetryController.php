<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use App\Models\login;
use App\Models\materials;
use App\Models\containers;
use App\Models\catalog;
use App\Events\wasteDeposited;
use Illuminate\Support\Facades\DB;

class ContainerTelemetryController extends Controller
{
    public function store(Request $request)
    {
        
        $validated_data =$request->validate([
        'serial_number'=>'required|string',
        'university_id'=>'integer|required',
        'material_type'=>'string|required',
        'weight'=>'required|numeric|gt:0',
        'fill_level'=>'required|min:0|max:100|integer',
        ]);
        $continar =containers::where('serial_number',$validated_data['serial_number'])->firstOrFail();
        $student =login::where('university_id',$validated_data['university_id'])->firstOrFail();
        //----------------------------------------

        $total_of_points =0;
        $catalogItem = catalog::where('type',$validated_data['material_type'])->firstOrFail();
        $earnedPoints =round($validated_data['weight']* $catalogItem->points);
        // $weight =materials::where('type_id',$catalogItem->id)->firstOrFail();

        //-----------------------------------------
        DB::transaction(function ()  use ($continar,$student,$catalogItem,$earnedPoints,$validated_data)
        {
            $student->increment('points',$earnedPoints);
            $catalogItem->increment('total_weight',$validated_data['weight']);
            // -----------------------------------------------------------
            $containerMaterial = materials::firstOrCreate(
            [
                'container_id' => $continar->id,
                'type_id'      => $catalogItem->id,
            ],
            ['current_weight' => 0]
        );
            $containerMaterial->increment('current_weight',$validated_data['weight']);
        // -------------------------------------------------------------  
            $continar->update([
            'fill_level'=>$validated_data['fill_level']
            ]);
        });
        wasteDeposited::dispatch(
        $student,
        $continar,
        $validated_data['material_type'],
        $validated_data['weight'],
        $earnedPoints
        );
        return response()->json([
            'status'=>'success',
            'points_earned'=>$earnedPoints,
            'new_fill_level'=>$continar->fill_level
        ],200);
    }
}
