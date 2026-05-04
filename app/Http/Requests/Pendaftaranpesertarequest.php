<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranPesertaRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            // Data Pribadi
            'nama_lengkap' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'instansi_organisasi' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15|regex:/^[0-9+\-\s()]*$/',
            'email' => 'required|email|max:255',

            // Perwakilan Daerah
            'kota_kabupaten' => 'required|string|max:255',

            // Upload Foto
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            // Pilihan Kegiatan
            'kegiatan' => 'required|array|min:1',
            'kegiatan.*' => ['string', 'max:255'],

            // Perjalanan dan Akomodasi
            'tanggal_kedatangan' => 'required|date|after_or_equal:today',
            'tanggal_kepulangan' => 'required|date|after:tanggal_kedatangan',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            // Data Pribadi
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'instansi_organisasi.required' => 'Instansi/Organisasi wajib diisi.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.regex' => 'Format nomor telepon tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'kota_kabupaten.required' => 'Kota/Kabupaten wajib diisi.',

            // Foto
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Format foto harus jpeg, png, atau jpg.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',

            // Kegiatan
            'kegiatan.required' => 'Pilih minimal satu kegiatan yang akan diikuti.',
            'kegiatan.array' => 'Format pilihan kegiatan tidak valid.',
            'kegiatan.min' => 'Pilih minimal satu kegiatan yang akan diikuti.',
            'kegiatan.*.in' => 'Terdapat pilihan kegiatan yang tidak valid.',

            // Perjalanan
            'tanggal_kedatangan.required' => 'Tanggal kedatangan wajib diisi.',
            'tanggal_kedatangan.after_or_equal' => 'Tanggal kedatangan tidak boleh kurang dari hari ini.',
            'tanggal_kepulangan.required' => 'Tanggal kepulangan wajib diisi.',
            'tanggal_kepulangan.after' => 'Tanggal kepulangan harus setelah tanggal kedatangan.',
        ];
    }
}
