<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Enrollment;
use App\Models\Batch;
use App\Models\Student;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    
    public function index(): View
    {
        $enrollments = Enrollment::all(); 
        return view('enrollments.index', compact('enrollments'));
    }

    public function create(): View
    {
        $batches=Batch::pluck('name','id');
        $students=Student::pluck('name','id');
        return view('enrollments.create',compact('batches','students'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'enroll_no' => 'required|string',
            'batch_id' => 'required|exists:batches,id',
            'student_id' => 'required|exists:students,id',
            'join_date' => 'required|date',
            'fee' => 'required|numeric',]);
        

        Enrollment::create($request->all());

        return redirect()->route('enrollments.index')->with('flash_message', 'enrollment Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $enrollment = Enrollment::findOrFail($id);
        return view('enrollments.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $enrollments = Enrollment::findOrFail($id);
        return view('enrollments.edit', compact('enrollments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $enrollments = Enrollment::findOrFail($id); 
        $enrollments->update($request->all());

        return redirect()->route('enrollments.index')->with('flash_message', 'enrollment Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):RedirectResponse
    {
        Enrollment::destroy($id);
        return redirect()->route('enrollments.index')->with('flash_message', 'enrollment deleted!');
    }
}
