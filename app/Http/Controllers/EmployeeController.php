<?php 

namespace App\Http\Controllers;

use App\Models\Employee; // Make sure to import your Employee model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    // Display the employee management view
    public function index()
    {
        $employees = Employee::all(); // Retrieve all employees from the database
        return view('admin.users', compact('employees')); // Pass employees to the view
    }

    // Store a new employee
    public function store(Request $request)
    {
        $request->validate([
            'employee_number' => 'required|unique:employees',
            'username' => 'required|unique:employees',
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        // Create a new employee
        Employee::create([
            'employee_number' => $request->employee_number,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Hash the password
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'status' => 'active', // Default status
        ]);

        return redirect()->route('admin.manageUser')->with('success', 'Employee added successfully.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'employee_number' => 'required',
            'password' => 'required',
        ]);

        // Attempt to log the employee in using the 'employee' guard
        if (Auth::guard('employee')->attempt(['employee_number' => $request->employee_number, 'password' => $request->password])) {
            session(['employee_id' => Auth::guard('employee')->user()->id]); 
            return redirect()->route('cashier.cart');
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('employee')->logout(); // Log out the employee

        // Optionally, you can remove specific session data
        session()->forget('employee_id'); // Remove employee ID from session

        // Redirect to the login page or any other page
        return redirect()->route('employee.login.form')->with('success', 'You have been logged out successfully.');
    }
}