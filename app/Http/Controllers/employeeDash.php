<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\containers; 
use Illuminate\Support\Facades\Auth;

class employeeDash extends Controller
{
public function index()
    {
        $user = Auth::user();

        // جلب الحاويات (إذا أردت تصفيتها حسب زون الموظف يمكنك إضافة: ->where('location_name', 'like', "%{$user->zone}%"))
        $containers = containers::orderByDesc('fill_level')->get();

        return view('employee.employee', compact('containers'));
    }


    public function markEmptied(Request $request, $id)
    {
$container = containers::findOrFail($id);

    // تحديث وتصفير مباشر
    $container->fill_level = 0;
    $container->status = 'active';
    $container->save(); // save() تضمن الحفظ المباشر حتى لو كان هناك مشكلة في Mass Assignment

    return redirect()->back()->with('success', "Container #{$container->serial_number} has been emptied successfully.");    }
}
