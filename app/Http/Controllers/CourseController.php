<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Http\RedirectResponse;
use illuminate\Http\Response;
use App\Models\Course;
use Illuminate\View\View;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Courses = Course::all(); 
        return view('Courses.index', compact('Courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'syllabus' => 'required|string|max:255',
            'duration' => 'required|string|max:15',
        ]);

        Course::create($validatedData);

        return redirect()->route('courses.index')->with('flash_message', 'courses Added!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $courses = Course::findOrFail($id);
        return view('courses.show', compact('courses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $courses = Course::findOrFail($id);
        return view('courses.edit', compact('courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Courses = Course::findOrFail($id); 
        $Courses->update($request->all());

        return redirect()->route('courses.index')->with('flash_message', 'courses Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Course::destroy($id);
        return redirect()->route('courses.index')->with('flash_message', 'courses deleted!');
    }
}
