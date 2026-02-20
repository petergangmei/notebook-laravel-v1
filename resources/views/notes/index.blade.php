@extends('layouts.app')

@section('title', 'Notes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h2 mb-0">Notes</h1>
    <a href="{{ route('notes.create') }}" class="btn btn-primary">New note</a>
</div>

@if ($notes->isEmpty())
    <div class="card">
        <div class="card-body text-center py-5 text-muted">
            <p class="mb-0">No notes yet. <a href="{{ route('notes.create') }}">Create one</a>.</p>
        </div>
    </div>
@else
    <div class="list-group">
        @foreach ($notes as $note)
            <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <a href="{{ route('notes.show', $note) }}" class="text-decoration-none text-dark fw-semibold">{{ $note->title }}</a>
                    @if (\Illuminate\Support\Str::length($note->content) > 80)
                        <p class="mb-0 small text-muted">{{ \Illuminate\Support\Str::limit($note->content, 80) }}</p>
                    @else
                        <p class="mb-0 small text-muted">{{ $note->content }}</p>
                    @endif
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('notes.edit', $note) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                    <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this note?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
