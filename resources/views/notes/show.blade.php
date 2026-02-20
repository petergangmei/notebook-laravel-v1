@extends('layouts.app')

@section('title', $note->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="d-flex justify-content-between align-items-start mb-3">
            <h1 class="h2 mb-0">{{ $note->title }}</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('notes.edit', $note) }}" class="btn btn-outline-primary btn-sm">Edit</a>
                <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this note?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="text-muted small mb-2">Updated {{ $note->updated_at->diffForHumans() }}</div>
                <div class="whitespace-pre-wrap">{{ $note->content }}</div>
            </div>
        </div>
        <a href="{{ route('notes.index') }}" class="btn btn-link mt-2 px-0">← Back to notes</a>
    </div>
</div>
@endsection
