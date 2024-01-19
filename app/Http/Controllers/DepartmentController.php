<?php
// app/Http/Controllers/DepartmentController.php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Department;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DepartmentController extends Controller
{
    public function showTree()
    {
        $departments = Department::all();
        return view('departments.tree', compact('departments'));
    }

    public function store(Request $request)
{
    $request->validate([
        'department_name' => 'required|string|max:255',
        'parent_department_id' => 'nullable|exists:departments,department_id',
        'company_id' => 'required|exists:companies,company_id', // Add validation for company_id
    ]);

    Department::create([
        'company_id' => $request->input('company_id'), // Use the selected company_id from the form
        'department_name' => $request->input('department_name'),
        'parent_department_id' => $request->input('parent_department_id'),
    ]);

    $departments = Department::all(); // Fetch list of departments
    $companies = Company::all();
    
    return redirect()->route('departments.tree')->with('status', 'Department added successfully.');

}

public function showAddForm()
{
    $departments = Department::all();
    $companies = Company::all();

    return view('departments.add', compact('departments', 'companies'));

}
}