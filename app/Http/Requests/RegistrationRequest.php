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
                'kecamatan' => 'required|string|max:255',
                'kabupaten_kota' => 'required|string|max:255',
                'provinsi' => 'required|string|max:255',
                'address' => 'required|string',
                'nisn' => 'required|string|max:20',
                'nik_kk' => 'required|string|max:25',
                'blood_type' => 'required|in:A,B,AB,O',
                'height' => 'required|integer|min:50|max:250',
                'weight' => 'required|integer|min:15|max:200',
                'sibling_count' => 'required|integer|min:0',
                'ambition' => 'required|string|max:255',
                'student_phone' => 'required|string|max:20',
                'education_level' => 'required|in:MTs,MA,SMA',
                'origin_school' => 'required|string|max:255',
                'origin_school_address' => 'required|string',
                'graduation_year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            ]);
        } elseif ($this->step == 2) {
            $rules = array_merge($rules, [
                'father_name' => 'nullable|string|max:255',
                'father_phone' => 'nullable|string|max:20',
                'mother_name' => 'nullable|string|max:255',
                'mother_phone' => 'nullable|string|max:20',
                'guardian_name' => 'nullable|string|max:255',
                'guardian_phone' => 'nullable|string|max:20',
            ]);
        } elseif ($this->step == 3) {
            $rules = array_merge($rules, [
                'photo' => 'sometimes|required_without:photo_compressed|max:1024',
                'ijazah' => 'sometimes|required_without:ijazah_compressed|max:1024',
                'family_card' => 'nullable|max:1024',
                'birth_cert' => 'nullable|max:1024',
                'ktp_parent' => 'nullable|max:1024',
                'photo_compressed' => 'nullable|string',
                'ijazah_compressed' => 'nullable|string',
                'family_card_compressed' => 'nullable|string',
                'birth_cert_compressed' => 'nullable|string',
                'ktp_parent_compressed' => 'nullable|string',
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
            'photo.required_without' => 'Pas Foto wajib diupload untuk Kartu Pelajar.',
            'ijazah.required_without' => 'Ijazah Terakhir wajib diupload sebagai syarat utama.',
            'photo.max' => 'Ukuran file foto tidak boleh lebih dari 1MB.',
            'ijazah.max' => 'Ukuran file ijazah tidak boleh lebih dari 1MB.',
            'family_card.max' => 'Ukuran file KK tidak boleh lebih dari 1MB.',
            'birth_cert.max' => 'Ukuran file Akta Kelahiran tidak boleh lebih dari 1MB.',
            'ktp_parent.max' => 'Ukuran file KTP tidak boleh lebih dari 1MB.',
        ];
    }
}
