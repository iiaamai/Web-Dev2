<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UploadStudentPhotoRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(): View
    {
        $students = Student::query()->orderBy('id')->get();

        return view('students.index', compact('students'));
    }

    public function create(): View
    {
        return view('students.create');
    }

    public function store(StoreStudentRequest $request): RedirectResponse
    {
        if (Student::query()->count() >= Student::MAX_STUDENTS) {
            return back()
                ->withInput()
                ->withErrors([
                    'limit' => 'Maximum of '.Student::MAX_STUDENTS.' students reached. Cannot add more.',
                ]);
        }

        $data = $request->validated();
        $photo = $data['photo'] ?? null;
        unset($data['photo']);

        $student = Student::query()->create($data);

        if ($photo) {
            $student->update([
                'photo_path' => $photo->store('students/'.$student->id.'/photos', 'public'),
            ]);
        }

        return redirect()
            ->route('students.index')
            ->with('success', 'Student record created successfully.');
    }

    public function show(Student $student): View
    {
        return view('students.show', compact('student'));
    }

    public function createPhoto(Student $student): View
    {
        return view('students.upload', compact('student'));
    }

    public function storePhoto(UploadStudentPhotoRequest $request, Student $student): RedirectResponse
    {
        $path = $request->file('photo')->store('students/'.$student->id.'/photos', 'public');

        if ($student->photo_path) {
            Storage::disk('public')->delete($student->photo_path);
        }

        $student->update(['photo_path' => $path]);

        return redirect()
            ->route('students.show', $student)
            ->with('success', 'Student photo uploaded successfully.');
    }

    public function edit(Student $student): View
    {
        return view('students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        $data = $request->validated();
        $photo = $data['photo'] ?? null;
        unset($data['photo']);

        if ($photo) {
            $newPhotoPath = $photo->store('students/'.$student->id.'/photos', 'public');

            if ($student->photo_path) {
                Storage::disk('public')->delete($student->photo_path);
            }

            $data['photo_path'] = $newPhotoPath;
        }

        $student->update($data);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student record updated successfully.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        if ($student->photo_path) {
            Storage::disk('public')->delete($student->photo_path);
        }

        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student record deleted successfully.');
    }
}
