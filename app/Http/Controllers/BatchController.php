<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Http\RedirectResponse;
use illuminate\Http\Response;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\View\View;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $batches = Batch::all(); 
        return view('batches.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        $courses = Course::pluck('name','id');
        return view('batches.create', compact('courses'));
    }

    
    public function store(Request $request):RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required|string|max:255',
            'start_date' => 'required|string|max:15',
        ]);

        Batch::create($validatedData);

        return redirect()->route('batches.index')->with('flash_message', 'Batch Added!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id):View
    {
        $batches = Batch::findOrFail($id);
        return view('batches.show', compact('batches'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $batches = Batch::findOrFail($id);
        return view('batches.edit', compact('batches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $batches = Batch::findOrFail($id); 
        $batches->update($request->all());

        return redirect()->route('batches.index')->with('flash_message', 'Batch Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Batch::destroy($id);
        return redirect()->route('batches.index')->with('flash_message', 'Batch deleted!');
    }
}
