<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\catalog;
use App\Models\containers;
use App\Models\login; // أو login حسب اسم الموديل عندك
use App\Models\materials;
// use App\Models\Activity;
use App\Models\Activity;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function student(Request $request)
    {
        $query = login::where('role', 'student')
            ->orderByDesc('points');
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('university_id', 'like', "%{$search}%");
            });
        }
        $students = $query->paginate(15);
        $topStudent = login::where('role', 'student')
        ->orderByDesc('points')
        ->first();
        $totalPointsAwarded = login::where('role', 'student')->sum('points');

        return view('admin-pages.students', compact('students','topStudent', 'totalPointsAwarded',));
    }

    public function index()
    {
        $totalStudents = login::where('role', 'student')->count();
        $totalContainers = containers::count();
        $totalRecycledWeight = catalog::sum('total_weight') ?? 0;
        $totalPointsAwarded = login::where('role', 'student')->sum('points') ?? 0;

        $criticalContainers = containers::
            latest()
            ->take(5)
            ->get();

        $topStudents = login::where('role', 'student')
            ->orderByDesc('points')
            ->take(10)
            ->get();

$recentActivities = \Spatie\Activitylog\Models\Activity::whereNotNull('weight')
->latest()
    ->take(10)
    ->get();
        $materials = materials::with('catalog')->get();
        // dd(['totalStudents'=> $totalStudents,
        //    'totalContainers'=> $totalContainers,
        //    'totalRecycledWeight'=> $totalRecycledWeight,
        //    'totalPointsAwarded'=> $totalPointsAwarded,
        //    'criticalContainers'=> $criticalContainers,
        //    'topStudents'=> $topStudents,
        //    'recentActivities'=> $recentActivities,
        //    'materials'=> $materials]);

        return view('admin-pages.dashboard', compact(
            'totalStudents',
            'totalContainers',
            'totalRecycledWeight',
            'totalPointsAwarded',
            'criticalContainers',
            'topStudents',
            'recentActivities',
            'materials'
        ));
    }
}