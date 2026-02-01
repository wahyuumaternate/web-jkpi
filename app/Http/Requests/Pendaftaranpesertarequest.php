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
            'nik' => 'required|string|size:16|unique:pendaftaran_peserta,nik',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before:today',
            'alamat' => 'required|string',
            'provinsi' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|size:5',

            // Kontak
            'nomor_telepon' => 'nullable|string|max:15',
            'email' => 'required|email|unique:pendaftaran_peserta,email',
            'nomor_wa' => 'required|string|max:15',

            // Instansi/Pekerjaan
            'instansi' => 'nullable|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'bidang_pekerjaan' => 'nullable|string|max:255',

            // Data Kepesertaan
            'is_anggota_jkpi' => 'nullable|boolean',

            // Kebutuhan Khusus
            'butuh_akomodasi' => 'nullable|boolean',
            'kebutuhan_khusus' => 'nullable|string',

            // Upload Dokumen
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'ktp' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus terdiri dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'alamat.required' => 'Alamat wajib diisi.',
            'provinsi.required' => 'Provinsi wajib dipilih.',
            'kabupaten_kota.required' => 'Kabupaten/Kota wajib dipilih.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'nomor_wa.required' => 'Nomor WhatsApp wajib diisi.',
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPEG, JPG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
            'ktp.image' => 'File KTP harus berupa gambar.',
            'ktp.mimes' => 'KTP harus berformat JPEG, JPG, atau PNG.',
            'ktp.max' => 'Ukuran KTP maksimal 2MB.',
        ];
    }
}
