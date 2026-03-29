<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'step' => 'required|integer|in:1,2,3',
        ];

        if ($this->step == 1) {
            $rules = array_merge($rules, [
                'full_name' => 'required|string|max:255',
                'birth_place' => 'required|string|max:255',
                'birth_date' => 'required|date',
                'gender' => 'required|in:L,P',
                'religion' => 'required|string|max:255',
                'address' => 'required|string',
            ]);
        } elseif ($this->step == 2) {
            $rules = array_merge($rules, [
                'father_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
                'parent_phone' => 'required|string|max:20',
                'parent_job' => 'required|string|max:255',
                'origin_school' => 'required|string|max:255',
                'origin_school_address' => 'required|string',
                'graduation_year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            ]);
        } elseif ($this->step == 3) {
            $rules = array_merge($rules, [
                'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'birth_cert' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'skhu' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
        }

        return $rules;
    }
}
