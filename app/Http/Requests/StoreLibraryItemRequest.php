<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLibraryItemRequest extends FormRequest
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
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'isbn' => 'nullable|string|max:20',
            'publisher' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'type' => 'required|in:digital,print',
            'category' => 'nullable|string|max:100',
            'language' => 'required|string|max:50',
            'pages' => 'nullable|integer|min:1',
            'digital_url' => 'nullable|url|required_if:type,digital',
            'total_copies' => 'required_if:type,print|integer|min:1',
            'available_copies' => 'required_if:type,print|integer|min:1|lte:total_copies',
            'location' => 'nullable|string|max:255',
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
            'title.required' => 'Title is required.',
            'author.required' => 'Author is required.',
            'type.required' => 'Type is required.',
            'type.in' => 'Type must be either digital or print.',
            'language.required' => 'Language is required.',
            'digital_url.required_if' => 'Digital URL is required for digital items.',
            'digital_url.url' => 'Digital URL must be a valid URL.',
            'total_copies.required_if' => 'Total copies is required for print items.',
            'available_copies.required_if' => 'Available copies is required for print items.',
            'available_copies.lte' => 'Available copies cannot be more than total copies.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->type === 'digital') {
            $this->merge([
                'total_copies' => 1,
                'available_copies' => 1,
            ]);
        }

        $this->merge([
            'language' => $this->language ?? 'Indonesian',
        ]);
    }
}