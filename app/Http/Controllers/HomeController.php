<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::id()) {
            $role = Auth()->user()->role;

            if ($role == 'user') {
                return view('dashboard');
            } else if ($role == 'admin') {
                $query = User::where('role', 'user')->with('department');
               
            // Search
            $search = $request->input('search');
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('username', 'like', '%' . $search . '%');
                    
                });
            }

            // Filter
            $filterDepartment = $request->input('filter_department');
            if ($filterDepartment) {
                $query->where('department_id', $filterDepartment);
            }

            //Ordering
            $sortField = $request->input('sort_field', 'name');
            $sortOrder = $request->input('sort_order', 'asc');
            $query->orderBy($sortField, $sortOrder);

            $users = $query->paginate(10);
            // Pagination
            $departments = Department::all();
                
            return view('admin.adminhome', ['users' => $users, 'departments' => $departments]);
            } else {
                return redirect()->back();
            }
        }
    }
    public function createUser(Request $request): RedirectResponse
    {

       // New user validation
       $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:8',
        'department_id' => 'required|exists:departments,department_id', // Ensure the selected department exists
    ]);

       // Create a new user
       User::create([
        'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'department_id' => $request->input('department_id'),
       ]);

       return redirect()->route('home')->with('status', 'User created successfully.');
    }

    public function showCreateUserForm()
    {
       $departments = Department::all();
       return view('admin.create-user', ['departments' => $departments]);
    }

    public function editUser(User $user): View
    {
        $departments = Department::all();
        return view('admin.edit_user', ['user' => $user, 'departments' => $departments]);
    }

 
   public function updateUser(Request $request, User $user): RedirectResponse
   {
       // Validation for updating
       $request->validate([
           'name' => 'required|string|max:255',
           'username' => 'required|string|max:255|unique:users,username,' . $user->id,
           'email' => 'required|email|max:255|unique:users,email,' . $user->id,
           'department_id' => 'required|exists:departments,department_id',
       ]);

       // Update user details
       $user->update([
           'name' => $request->input('name'),
           'username' => $request->input('username'),
           'email' => $request->input('email'),
           'department_id' => $request->input('department_id'),
       ]);

       return redirect()->route('home', ['user' => $user])->with('status', 'User updated successfully.');
   }


   public function destroyUser(User $user): RedirectResponse
{

    $user->delete();

    return redirect()->route('home')->with('status', 'User deleted successfully.');
}

}
