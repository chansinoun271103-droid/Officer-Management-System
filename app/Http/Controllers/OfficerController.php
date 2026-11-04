<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Officer;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    private function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'gender'      => 'required|in:male,female',
            'dob'         => 'nullable|date',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email|max:255',
            'position'    => 'required|string|max:255',
            'dept_id'     => 'required|exists:departments,dept_id',
            'hire_date'   => 'nullable|date',
            'description' => 'nullable|string',
        ];
    }

    public function index(Request $request)
    {
        $officers = Officer::with('department')
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->when($request->dept_id, fn ($q, $d) => $q->where('dept_id', $d))
            ->orderBy('id')
            ->paginate(10)
            ->withQueryString();

        $departments = Department::all();

        return view('officers.index', compact('officers', 'departments'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('officers.create', compact('departments'));
    }

    public function store(Request $request)
    {
        Officer::create($request->validate($this->rules()));

        return redirect()->route('officers.index')
            ->with('success', 'Add Officer Successfully');
    }

    public function edit(Officer $officer)
    {
        $departments = Department::all();
        return view('officers.edit', compact('officer', 'departments'));
    }

    public function update(Request $request, Officer $officer)
    {
        $officer->update($request->validate($this->rules()));

        return redirect()->route('officers.index')
            ->with('success', 'Update Officer Successfully');
    }

    public function destroy(Officer $officer)
    {
        abort_unless(request()->user()?->role === 'admin', 403);

        $officer->delete();

        return redirect()->route('officers.index')
            ->with('success', 'Delete Officer Successfully');
    }
}