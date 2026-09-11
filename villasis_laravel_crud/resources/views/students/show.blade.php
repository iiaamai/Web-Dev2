@extends('layouts.app')

@section('title', 'Viewing of Student Record')

@section('content')
    <div class="card">
        <div class="page-header">
            <h1>Viewing of Student Record</h1>
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

        <div class="actions-row">
            <a class="btn btn-outline" href="{{ route('students.index') }}">Back</a>
        </div>
    </div>
@endsection
