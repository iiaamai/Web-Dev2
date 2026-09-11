@extends('layouts.app')

@section('title', 'Student Records')

@section('content')
    <div class="card">
        <div class="page-header">
            <h1>Student Records</h1>
            <a class="btn btn-blue" href="{{ route('students.create') }}">Add New Student</a>
        </div>

        <div class="table-wrap">
            <table class="data">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Lastname</th>
                        <th>Firstname</th>
                        <th>Program</th>
                        <th>Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->lastname }}</td>
                            <td>{{ $student->firstname }}</td>
                            <td>{{ $student->program }}</td>
                            <td>{{ $student->year }}</td>
                            <td>
                                <div class="actions-cell">
                                    <a class="btn btn-blue btn-sm" href="{{ route('students.show', $student) }}">View</a>
                                    <a class="btn btn-green btn-sm" href="{{ route('students.edit', $student) }}">Edit</a>
                                    <form
                                        class="inline-delete"
                                        method="POST"
                                        action="{{ route('students.destroy', $student) }}"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="button"
                                            class="btn btn-red btn-sm btn-delete-open"
                                            data-student-name="{{ $student->lastname }}, {{ $student->firstname }}"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No student records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
