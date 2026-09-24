@extends('layouts.app')

@section('title', 'Viewing of Student Record')

@section('content')
    <div class="card">
        <div class="page-header">
            <h1>Viewing of Student Record</h1>
        </div>

        <div class="student-detail-layout">
            <div class="student-photo-panel">
                @if ($student->photo_path)
                    <img
                        class="student-photo"
                        src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($student->photo_path) }}"
                        alt="Photo of {{ $student->firstname }} {{ $student->lastname }}"
                    >
                @else
                    <div class="student-photo-placeholder">No photo uploaded</div>
                @endif
                <a class="btn btn-outline btn-sm" href="{{ route('students.photo.create', $student) }}">Upload Image</a>
            </div>

            <table class="detail">
                <tr>
                    <th>ID</th>
                    <td>{{ $student->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $student->lastname }}, {{ $student->firstname }}</td>
                </tr>
                <tr>
                    <th>Province</th>
                    <td>{{ $student->province }}</td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>{{ $student->country }}</td>
                </tr>
                <tr>
                    <th>School</th>
                    <td>{{ $student->school }}</td>
                </tr>
                <tr>
                    <th>Program</th>
                    <td>{{ $student->program }}</td>
                </tr>
                <tr>
                    <th>Program Major</th>
                    <td>{{ $student->program_major }}</td>
                </tr>
                <tr>
                    <th>Year</th>
                    <td>{{ $student->year }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($student->status) }}</td>
                </tr>
                <tr>
                    <th>Birthday</th>
                    <td>{{ $student->birthday->format('F j, Y') }}</td>
                </tr>
                <tr>
                    <th>Subjects</th>
                    <td>
                        <div class="subject-chips">
                            @foreach ($student->subjects ?? [] as $subject)
                                <span class="chip">{{ $subject }}</span>
                            @endforeach
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="actions-row">
            <a class="btn btn-outline" href="{{ route('students.index') }}">Back</a>
        </div>
    </div>
@endsection
