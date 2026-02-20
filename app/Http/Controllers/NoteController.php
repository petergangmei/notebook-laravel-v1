<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * List all notes (home).
     */
    public function index()
    {
        $notes = Note::latest()->get();
        return view('notes.index', compact('notes'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a new note.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->route('notes.create')->withErrors($validator)->withInput();
        }
        Note::create($request->only('title', 'content'));
        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    /**
     * Show single note.
     */
    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    /**
     * Show edit form.
     */
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the note.
     */
    public function update(Request $request, Note $note)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->route('notes.edit', $note)->withErrors($validator)->withInput();
        }
        $note->update($request->only('title', 'content'));
        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }

    /**
     * Delete the note.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
    }
}
