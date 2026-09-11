@extends('layouts.app')

@section('title', 'Edit Student Record')

@section('content')
    <div class="card">
        <div class="page-header">
            <h1>Edit Student Record</h1>
        </div>

        <form method="POST" action="{{ route('students.update', $student) }}">
            @csrf
            @method('PUT')

            <table class="detail">
                <tr>
                    <th>ID</th>
                    <td>{{ $student->id }}</td>
                </tr>
                <tr>
                    <th>Lastname</th>
                    <td>
                        <input type="text" name="lastname" value="{{ old('lastname', $student->lastname) }}" maxlength="50" required>
                    </td>
                </tr>
                <tr>
                    <th>Firstname</th>
                    <td>
                        <input type="text" name="firstname" value="{{ old('firstname', $student->firstname) }}" maxlength="50" required>
                    </td>
                </tr>
                <tr>
                    <th>Province</th>
                    <td>
                        <input type="text" name="province" value="{{ old('province', $student->province) }}" maxlength="50" required>
                    </td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>
                        <input type="text" name="country" value="{{ old('country', $student->country) }}" maxlength="50" required>
                    </td>
                </tr>
                <tr>
                    <th>School</th>
                    <td>
                        <input type="text" name="school" value="{{ old('school', $student->school) }}" maxlength="50" required>
                    </td>
                </tr>
                <tr>
                    <th>Program</th>
                    <td>
                        <input type="text" name="program" value="{{ old('program', $student->program) }}" maxlength="10" required>
                    </td>
                </tr>
                <tr>
                    <th>Program Major</th>
                    <td>
                        <input type="text" name="program_major" value="{{ old('program_major', $student->program_major) }}" maxlength="50" required>
                    </td>
                </tr>
                <tr>
                    <th>Year</th>
                    <td>
                        <input type="number" name="year" value="{{ old('year', $student->year) }}" min="1" max="10" required>
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <select name="status" required>
                            <option value="regular" @selected(old('status', $student->status) === 'regular')>Regular</option>
                            <option value="irregular" @selected(old('status', $student->status) === 'irregular')>Irregular</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Birthday</th>
                    <td>
                        <input type="date" name="birthday" value="{{ old('birthday', $student->birthday->format('Y-m-d')) }}" required>
                    </td>
                </tr>
                <tr>
                    <th>Subjects</th>
                    <td>
                        @php
                            $oldSubjects = old('subjects', $student->subjects ?? ['']);
                            if (! is_array($oldSubjects) || count($oldSubjects) === 0) {
                                $oldSubjects = [''];
                            }
                        @endphp

                        <div class="subjects-box">
                            <div id="subjects-list">
                                @foreach ($oldSubjects as $subject)
                                    <div class="subject-row">
                                        <input
                                            type="text"
                                            name="subjects[]"
                                            value="{{ $subject }}"
                                            maxlength="100"
                                            placeholder="Subject name"
                                        >
                                        <button type="button" class="btn btn-red btn-sm remove-subject-btn">
                                            Remove
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" id="add-subject-btn" class="btn btn-blue btn-sm">
                                Add subject
                            </button>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="actions-row">
                <a class="btn btn-outline" href="{{ route('students.index') }}">Back</a>
                <button class="btn btn-blue" type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection
