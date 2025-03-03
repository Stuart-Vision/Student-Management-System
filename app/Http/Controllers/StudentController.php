<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Student;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $students = Student::all(); 
        return view('students.index', compact('students'));
    }

    
    public function create(): View
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')->with('flash_message', 'Student Added!');
    }

   
    public function show(string $id): View
    {
        $student = Student::findOrFail($id);
        return view('students.show', compact('student'));
    }

  
    public function edit(string $id): View
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    
    public function update(Request $request, string $id): RedirectResponse
    {
        $student = Student::findOrFail($id); 
        $student->update($request->all());

        return redirect()->route('students.index')->with('flash_message', 'Student Updated!');
    }

   
    public function destroy(string $id): RedirectResponse
    {
        Student::destroy($id);
        return redirect()->route('students.index')->with('flash_message', 'Student deleted!');
    }
}
