<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StudentCrudTest extends TestCase
{
    use RefreshDatabase;

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'lastname' => 'Dela Cruz',
            'firstname' => 'Juan',
            'province' => 'Cavite',
            'country' => 'Philippines',
            'school' => 'ACLC College',
            'program' => 'BSIS',
            'program_major' => 'Information Systems',
            'year' => 2,
            'status' => 'regular',
            'birthday' => '2000-01-15',
            'subjects' => ['IS Project Design', 'Web Development 1', 'PHP'],
        ], $overrides);
    }

    public function test_index_lists_students(): void
    {
        Student::query()->create([
            ...collect($this->validPayload())->except('subjects')->all(),
            'subjects' => ['IS Project Design', 'Web Development 1', 'PHP'],
        ]);

        $this->get(route('students.index'))
            ->assertOk()
            ->assertSee('Student Records')
            ->assertSee('Dela Cruz')
            ->assertSee('Juan')
            ->assertSee('BSIS');
    }

    public function test_student_photo_can_be_uploaded_and_displayed(): void
    {
        Storage::fake('public');
        $student = Student::query()->create([
            ...collect($this->validPayload())->except('subjects')->all(),
            'subjects' => ['PHP'],
        ]);

        $this->get(route('students.photo.create', $student))
            ->assertOk()
            ->assertSee('Upload Student Image');

        $this->post(route('students.photo.store', $student), [
            'photo' => UploadedFile::fake()->image('student.jpg'),
        ])->assertRedirect(route('students.show', $student));

        $student->refresh();

        $this->assertNotNull($student->photo_path);
        Storage::disk('public')->assertExists($student->photo_path);
        $this->get(route('students.show', $student))
            ->assertOk()
            ->assertSee('student-photo');
    }

    public function test_student_photo_upload_rejects_non_images(): void
    {
        Storage::fake('public');
        $student = Student::query()->create([
            ...collect($this->validPayload())->except('subjects')->all(),
            'subjects' => ['PHP'],
        ]);

        $this->post(route('students.photo.store', $student), [
            'photo' => UploadedFile::fake()->create('notes.pdf', 100, 'application/pdf'),
        ])->assertSessionHasErrors('photo');

        $this->assertNull($student->fresh()->photo_path);
    }

    public function test_replacing_a_student_photo_removes_the_old_file(): void
    {
        Storage::fake('public');
        $student = Student::query()->create([
            ...collect($this->validPayload())->except('subjects')->all(),
            'subjects' => ['PHP'],
        ]);

        $this->post(route('students.photo.store', $student), [
            'photo' => UploadedFile::fake()->image('first.jpg'),
        ]);
        $oldPath = $student->fresh()->photo_path;

        $this->post(route('students.photo.store', $student), [
            'photo' => UploadedFile::fake()->image('second.jpg'),
        ]);
        $newPath = $student->fresh()->photo_path;

        Storage::disk('public')->assertMissing($oldPath);
        Storage::disk('public')->assertExists($newPath);
    }

    public function test_can_create_student(): void
    {
        $this->post(route('students.store'), $this->validPayload())
            ->assertRedirect(route('students.index'));

        $this->assertDatabaseHas('students', [
            'lastname' => 'Dela Cruz',
            'firstname' => 'Juan',
            'program' => 'BSIS',
            'program_major' => 'Information Systems',
            'status' => 'regular',
        ]);
    }

    public function test_can_create_student_with_a_photo_from_the_add_form(): void
    {
        Storage::fake('public');

        $this->post(route('students.store'), [
            ...$this->validPayload(),
            'photo' => UploadedFile::fake()->image('student.jpg'),
        ])->assertRedirect(route('students.index'));

        $student = Student::query()->firstOrFail();

        $this->assertNotNull($student->photo_path);
        Storage::disk('public')->assertExists($student->photo_path);
    }

    public function test_validation_rejects_invalid_year_and_long_program(): void
    {
        $this->post(route('students.store'), $this->validPayload([
            'year' => 11,
            'program' => 'TOOLONGPROG',
            'status' => 'unknown',
        ]))->assertSessionHasErrors(['year', 'program', 'status']);

        $this->assertDatabaseCount('students', 0);
    }

    public function test_cannot_create_more_than_max_students(): void
    {
        $max = Student::MAX_STUDENTS;

        for ($i = 1; $i <= $max; $i++) {
            Student::query()->create([
                ...collect($this->validPayload())->except('subjects')->all(),
                'lastname' => "Last{$i}",
                'firstname' => "First{$i}",
                'subjects' => ['PHP'],
            ]);
        }

        $this->from(route('students.create'))
            ->post(route('students.store'), $this->validPayload())
            ->assertRedirect(route('students.create'))
            ->assertSessionHasErrors('limit');

        $this->assertDatabaseCount('students', $max);
    }

    public function test_can_update_and_delete_student(): void
    {
        $student = Student::query()->create([
            ...collect($this->validPayload())->except('subjects')->all(),
            'subjects' => ['PHP'],
        ]);

        $this->put(route('students.update', $student), $this->validPayload([
            'lastname' => 'Santos',
            'year' => 3,
            'status' => 'irregular',
            'subjects' => ['Math', 'Science'],
        ]))->assertRedirect(route('students.index'));

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'lastname' => 'Santos',
            'year' => 3,
            'status' => 'irregular',
        ]);

        $this->delete(route('students.destroy', $student))
            ->assertRedirect(route('students.index'));

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    public function test_can_update_student_with_a_photo_from_the_edit_form(): void
    {
        Storage::fake('public');
        $student = Student::query()->create([
            ...collect($this->validPayload())->except('subjects')->all(),
            'subjects' => ['PHP'],
        ]);

        $this->put(route('students.update', $student), [
            ...$this->validPayload(),
            'photo' => UploadedFile::fake()->image('updated-student.jpg'),
        ])->assertRedirect(route('students.index'));

        $student->refresh();

        $this->assertNotNull($student->photo_path);
        Storage::disk('public')->assertExists($student->photo_path);
    }

    public function test_deleting_a_student_removes_their_photo(): void
    {
        Storage::fake('public');
        $student = Student::query()->create([
            ...collect($this->validPayload())->except('subjects')->all(),
            'subjects' => ['PHP'],
        ]);

        $this->post(route('students.photo.store', $student), [
            'photo' => UploadedFile::fake()->image('student.jpg'),
        ]);
        $path = $student->fresh()->photo_path;

        $this->delete(route('students.destroy', $student));

        Storage::disk('public')->assertMissing($path);
    }
}
