<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCadreProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date|before:today',
            'birth_place' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'student_id' => 'nullable|string|max:50',
            'institution' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'komisariat' => 'required|string|max:255',
            'study_program' => 'nullable|string|max:255',
            'entry_year' => 'nullable|integer|min:1990|max:' . (date('Y') + 1),
            'membership_status' => 'required|in:active,inactive,alumni',
            'join_date' => 'nullable|date|before_or_equal:today',
            'position' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name is required.',
            'birth_date.required' => 'Birth date is required.',
            'birth_date.before' => 'Birth date must be before today.',
            'birth_place.required' => 'Birth place is required.',
            'gender.required' => 'Gender is required.',
            'gender.in' => 'Gender must be either male or female.',
            'institution.required' => 'Institution is required.',
            'faculty.required' => 'Faculty is required.',
            'komisariat.required' => 'Komisariat is required.',
            'membership_status.required' => 'Membership status is required.',
            'membership_status.in' => 'Invalid membership status.',
        ];
    }
}