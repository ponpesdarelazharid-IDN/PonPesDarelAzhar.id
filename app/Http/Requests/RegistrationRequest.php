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
                'photo' => 'nullable|max:5120',
                'birth_cert' => 'nullable|max:5120',
                'ijazah' => 'nullable|max:5120',
                'skhu' => 'nullable|max:5120',
                'photo_compressed' => 'nullable|string',
                'birth_cert_compressed' => 'nullable|string',
                'ijazah_compressed' => 'nullable|string',
                'skhu_compressed' => 'nullable|string',
            ]);
        } elseif ($this->step == 4) {
            $rules = array_merge($rules, [
                'confirmation' => 'required|accepted',
            ]);
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'full_name.required' => 'Mohon masukkan Nama Lengkap sesuai Akta Kelahiran.',
            'birth_date.required' => 'Tanggal Lahir wajib diisi.',
            'gender.required' => 'Silakan pilih Jenis Kelamin.',
            'father_name.required' => 'Nama Ayah wajib diisi.',
            'mother_name.required' => 'Nama Ibu wajib diisi.',
            'parent_phone.required' => 'Nomor WhatsApp aktif wajib diisi untuk koordinasi.',
            'origin_school.required' => 'Asal Sekolah wajib diisi.',
            'confirmation.accepted' => 'Anda harus menyetujui pernyataan kebenaran data.',
            'photo.max' => 'Ukuran file foto maksimal 5MB.',
        ];
    }
}
