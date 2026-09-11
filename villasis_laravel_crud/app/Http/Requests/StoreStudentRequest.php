<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $subjects = $this->subjects;

        // Support old textarea text OR array of individual inputs
        if (is_string($subjects)) {
            $subjects = preg_split('/[\r\n,]+/', $subjects) ?: [];
        }

        if (is_array($subjects)) {
            $subjects = array_values(array_filter(array_map('trim', $subjects), function ($subject) {
                return $subject !== '';
            }));
            $this->merge(['subjects' => $subjects]);
        }
    }

    public function rules(): array
    {
        return [
            'lastname' => ['required', 'string', 'max:50'],
            'firstname' => ['required', 'string', 'max:50'],
            'province' => ['required', 'string', 'max:50'],
            'country' => ['required', 'string', 'max:50'],
            'school' => ['required', 'string', 'max:50'],
            'program' => ['required', 'string', 'max:10'],
            'program_major' => ['required', 'string', 'max:50'],
            'year' => ['required', 'integer', 'min:1', 'max:10'],
            'status' => ['required', 'string', Rule::in(Student::STATUSES)],
            'birthday' => ['required', 'date'],
            'subjects' => ['required', 'array', 'min:1'],
            'subjects.*' => ['required', 'string', 'max:100'],
        ];
    }
}
