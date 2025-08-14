<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdministrator() || auth()->user()->isManagement();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'activity_type' => 'nullable|string|max:100',
            'field' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'event_date' => 'required|date|after:now',
            'registration_start' => 'required|date|before:event_date',
            'registration_end' => 'required|date|after:registration_start|before_or_equal:event_date',
            'location' => 'nullable|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'is_mandatory' => 'boolean',
            'target_audience' => 'required|in:all,active_cadres,specific_komisariat,management',
            'target_komisariat' => 'nullable|string|max:255|required_if:target_audience,specific_komisariat',
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
            'title.required' => 'Event title is required.',
            'event_date.required' => 'Event date is required.',
            'event_date.after' => 'Event date must be in the future.',
            'registration_start.required' => 'Registration start date is required.',
            'registration_start.before' => 'Registration start must be before event date.',
            'registration_end.required' => 'Registration end date is required.',
            'registration_end.after' => 'Registration end must be after registration start.',
            'registration_end.before_or_equal' => 'Registration end must be before or equal to event date.',
            'target_audience.required' => 'Target audience is required.',
            'target_audience.in' => 'Invalid target audience selected.',
            'target_komisariat.required_if' => 'Target komisariat is required when targeting specific komisariat.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_mandatory' => $this->boolean('is_mandatory'),
        ]);
    }
}