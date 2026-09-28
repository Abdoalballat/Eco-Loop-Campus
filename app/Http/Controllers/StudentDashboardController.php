<?php
namespace App\Http\Controllers;

use App\Models\catalog;
use App\Models\containers;
use App\Models\login;
use App\Models\materials;
use App\Models\User;
use App\Models\Material;
use App\Models\Activity;
class StudentDashboardController extends Controller
{
public function index()
{
    $student = auth()->user();

    if (!$student) {
        return redirect()->route('login');
    }

    $userPoints = $student->points ?? 0;

    $myRank = login::where('role', 'student')
        ->where('points', '>', $userPoints)
        ->count() + 1;

    $topTen = login::where('role', 'student')
            ->orderByDesc('points')
            ->take(10)
            ->get();

    $materials = catalog::all();

    $deposits = Activity::where('causer_type', 'student') 
        ->where('causer_id', $student->id)
        ->with('container')
        ->latest()
        ->take(10)
        ->get();
    // $location_name =containers::where('serial_number',$deposits->serial_number);
    $totalWeightg = Activity::where('university_id', $student->university_id ?? $student->id)
        ->sum('weight') ?? 0;
    // dd(['student'=>$student, 'myRank'=>$myRank, 'topTen'=>$topTen, 'materials'=>$materials, 'deposits'=>$deposits, 'totalWeightg'=>$totalWeightg]);
    return view('student.dashboard', compact('student', 'myRank', 'topTen', 'materials', 'deposits', 'totalWeightg'));
}
}