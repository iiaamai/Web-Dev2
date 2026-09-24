@extends('layouts.app')

@section('title', 'Upload Student Image')

@section('content')
    <div class="card upload-card">
        <div class="page-header">
            <h1>Upload Student Image</h1>
        </div>

        <p class="form-intro">
            Upload an image for {{ $student->firstname }} {{ $student->lastname }}.
        </p>

        @if ($student->photo_path)
            <div class="current-photo">
                <img
                    class="student-photo"
                    src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($student->photo_path) }}"
                    alt="Current photo of {{ $student->firstname }} {{ $student->lastname }}"
                >
            </div>
        @endif

        <form method="POST" action="{{ route('students.photo.store', $student) }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="photo">Image</label>
                <input id="photo" name="photo" type="file" accept="image/jpeg,image/png,image/webp" required>
                @error('photo')
                    <p class="field-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="actions-row">
                <button class="btn btn-blue" type="submit">Save Image</button>
                <a class="btn btn-outline" href="{{ route('students.show', $student) }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
