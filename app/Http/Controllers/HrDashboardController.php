<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Officer;

class HrDashboardController extends Controller
{
    public function index()
    {
      $user = \Illuminate\Support\Facades\Auth::user();

        abort_unless($user && in_array($user->role, ['hr', 'admin']), 403);

        $totalOfficers = Officer::count();
        $totalDepartments = Department::count();

        $departments = Department::withCount('officers')->get();

        $recentOfficers = Officer::with('department')
            ->latest()
            ->take(5)
            ->get();

        return view('hr.dashboard', compact(
            'totalOfficers',
            'totalDepartments',
            'departments',
            'recentOfficers'
        ));
    }
}