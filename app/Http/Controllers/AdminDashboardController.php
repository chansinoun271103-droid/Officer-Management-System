<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Officer;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $totalOfficers     = Officer::count();
        $totalDepartments  = Department::count();
        $totalUsers        = User::count();
        $thisMonth         = Officer::whereYear('created_at', now()->year)
                                    ->whereMonth('created_at', now()->month)
                                    ->count();

        // Officers per department
        $byDepartment = Department::withCount('officers')
                                  ->orderByDesc('officers_count')
                                  ->get();

        $maxCount = max(1, $byDepartment->max('officers_count'));

        // 3 newest officers
        $recent = Officer::with('department')->latest()->take(3)->get();

        return view('Admin.admin_dashboard', compact(
    'totalOfficers', 'totalDepartments', 'totalUsers',
    'thisMonth', 'byDepartment', 'maxCount', 'recent'
));
    }
}   