<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Validator;


class NoteController extends Controller
{
    /**
     * List all notes (POST notes/list).
     */
    public function list(Request $request)
    {
        $notes = Note::all();
        $notes = $notes->makeHidden(['created_at', 'updated_at']);
        return api_response(success: true, httpStatus: 200, data: $notes, message: 'Notes fetched successfully');
    }

    /**
     * Create a note (POST notes/create).
     */
    public function create(Request $request)
    {
        // validate input
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            // return validation errors in the same API response format
            return api_response(
                success: false,
                httpStatus: 422,
                data: $validator->errors(),
                message: 'Missing required fields'
            );
        }
    
        //receve title and content from request
        $title = $request->input('title');
        $content = $request->input('content');

        //create a new note
        $note = Note::create([
            'title' => $title,
            'content' => $content
        ]);

        $note = $note->makeHidden(['created_at', 'updated_at']);
        return api_response(success: true, httpStatus: 201, data: $note, message: 'Note created successfully');
    }

    /**
     * Get single note detail (POST note/detail). Body: id.
     */
    public function detail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:notes,id',
        ]);
        if ($validator->fails()) {
            return api_response(success: false, httpStatus: 422, data: $validator->errors(), message: 'Validation failed');
        }
        $note = Note::find($request->input('id'));
        $note = $note->makeHidden(['created_at', 'updated_at']);
        return api_response(success: true, httpStatus: 200, data: $note, message: 'Note fetched successfully');
    }

    /**
     * Update a note (POST notes/update). Body: id, title, content.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:notes,id',
            'title' => 'required|string',
            'content' => 'required|string',
        ]);
        if ($validator->fails()) {
            return api_response(success: false, httpStatus: 422, data: $validator->errors(), message: 'Validation failed');
        }
        $note = Note::find($request->input('id'));
        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();
        $note = $note->makeHidden(['created_at', 'updated_at']);
        return api_response(success: true, httpStatus: 200, data: $note, message: 'Note updated successfully');
    }

    /**
     * Delete a note (POST notes/delete). Body: id.
     */
    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:notes,id',
        ]);
        if ($validator->fails()) {
            return api_response(success: false, httpStatus: 422, data: $validator->errors(), message: 'Validation failed');
        }
        $note = Note::find($request->input('id'));
        $note->delete();
        return api_response(success: true, httpStatus: 200, data: null, message: 'Note deleted successfully');
    }
}


