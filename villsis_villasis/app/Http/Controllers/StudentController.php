<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class StudentController extends Controller
{
    private const STUDENTS = [
        ['id' => 101, 'name' => 'Alice Smith', 'subjects' => ['Mathematics', 'Physics', 'Computer Science']],
        ['id' => 102, 'name' => 'Bob Jones', 'subjects' => ['Chemistry', 'Biology', 'English']],
        ['id' => 103, 'name' => 'Charlie Brown', 'subjects' => ['History', 'Geography', 'Art']],
        ['id' => 104, 'name' => 'Diana Prince', 'subjects' => ['Mathematics', 'Physics', 'Economics']],
        ['id' => 105, 'name' => 'Evan Wright', 'subjects' => ['Literature', 'Spanish', 'History']],
        ['id' => 106, 'name' => 'Fiona Gallagher', 'subjects' => ['Biology', 'Chemistry', 'Psychology']],
        ['id' => 107, 'name' => 'George Clark', 'subjects' => ['Computer Science', 'Mathematics', 'Physics']],
        ['id' => 108, 'name' => 'Hannah Abbott', 'subjects' => ['Art', 'Music', 'English']],
        ['id' => 109, 'name' => 'Ian Malcolm', 'subjects' => ['Physics', 'Mathematics', 'Philosophy']],
        ['id' => 110, 'name' => 'Julia Roberts', 'subjects' => ['Drama', 'English', 'History']],
        ['id' => 111, 'name' => 'Kevin Hart', 'subjects' => ['Mathematics', 'Physics', 'Computer Science']],
        ['id' => 112, 'name' => 'Shaina Villasis', 'subjects' => ['IS Project Design', 'Web Development 1', 'PHP']],
    ];

    public function index(): View
    {
        return view('list', ['students' => self::STUDENTS]);
    }

    public function show(int $id): View
    {
        $student = collect(self::STUDENTS)->firstWhere('id', $id);

        abort_if($student === null, 404);

        return view('student', ['student' => $student]);
    }
}
