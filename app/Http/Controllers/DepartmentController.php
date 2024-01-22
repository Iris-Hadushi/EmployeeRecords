<?php
// app/Http/Controllers/DepartmentController.php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DepartmentController extends Controller
{
    public function showTree()
    {
        $departments = Department::with('childDepartments')->get();
    
        $usersByDepartment = DB::table('users')
            ->join('departments', 'users.department_id', '=', 'departments.department_id')
            ->select('users.*', 'departments.department_id as department_id')
            ->where('users.role', '!=', 'admin') //not the 'admin' role
            ->get()
            ->groupBy('department_id');
    
        return view('departments.tree', compact('departments', 'usersByDepartment'));
    }
    public function store(Request $request)
{
    $request->validate([
        'department_name' => 'required|string|max:255',
        'parent_department_id' => 'nullable|exists:departments,department_id',
        'company_id' => 'required|exists:companies,company_id',
    ]);

    Department::create([
        'company_id' => $request->input('company_id'),
        'department_name' => $request->input('department_name'),
        'parent_department_id' => $request->input('parent_department_id'),
    ]);

    $departments = Department::all(); 
    $companies = Company::all();
    
    return redirect()->route('departments.tree')->with('status', 'Department added successfully.');

}

public function showAddForm()
{
    $departments = Department::all();
    $companies = Company::all();

    return view('departments.add', compact('departments', 'companies'));

}
public function delete(Request $request)
{
    $request->validate([
        'department_id' => 'required|exists:departments,department_id',
    ]);

    $departmentId = $request->input('department_id');

    // delete ch departments
    Department::where('parent_department_id', $departmentId)->delete();

    // delete p department
    Department::findOrFail($departmentId)->delete();

    return redirect()->route('departments.tree')->with('status', 'Department and its child departments deleted successfully.');
}

public function edit($departmentId)
{
    $department = Department::findOrFail($departmentId);
    $departments = Department::all();
    $companies = Company::all();

    return view('departments.edit', compact('department', 'departments', 'companies'));
}

public function update(Request $request, $departmentId)
{
    $request->validate([
        'department_name' => 'required|string|max:255',
        'parent_department_id' => 'nullable|exists:departments,department_id',
        'company_id' => 'required|exists:companies,company_id',
    ]);

    $department = Department::findOrFail($departmentId);

    $department->update([
        'company_id' => $request->input('company_id'),
        'department_name' => $request->input('department_name'),
        'parent_department_id' => $request->input('parent_department_id'),
    ]);

    return redirect()->route('departments.tree')->with('status', 'Department updated successfully.');
}


}