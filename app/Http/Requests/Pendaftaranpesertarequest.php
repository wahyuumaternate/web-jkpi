<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PendaftaranPesertaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Data Daerah & Kepala Daerah
            'nama_daerah'                  => ['required', 'string', 'max:100'],
            'nama_kepala_daerah'           => ['required', 'string', 'max:150'],
            'nama_pasangan_kepala_daerah'  => ['nullable', 'string', 'max:150'],

            // Informasi Perjalanan
            'nomor_plat'        => ['nullable', 'string', 'max:20'],
            'info_kedatangan'   => ['required', 'string', 'max:255'],
            'info_kepulangan'   => ['required', 'string', 'max:255'],

            // Data Ajudan
            'nama_ajudan'       => ['nullable', 'string', 'max:150'],
            'telepon_ajudan'    => ['nullable', 'string', 'max:20'],

            // Data Narahubung (array)
            'narahubung'                => ['required', 'array', 'min:1'],
            'narahubung.*.nama'         => ['required', 'string', 'max:150'],
            'narahubung.*.telepon'      => ['required', 'string', 'max:20'],
            'narahubung.*.email'        => ['required', 'email', 'max:150'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_daerah.required'              => 'Nama daerah wajib dipilih.',
            'nama_kepala_daerah.required'       => 'Nama lengkap kepala daerah wajib diisi.',
            'info_kedatangan.required'          => 'Info kedatangan kepala daerah wajib diisi.',
            'info_kepulangan.required'          => 'Info kepulangan kepala daerah wajib diisi.',
            'narahubung.required'               => 'Minimal harus ada satu narahubung.',
            'narahubung.min'                    => 'Minimal harus ada satu narahubung.',
            'narahubung.*.nama.required'        => 'Nama narahubung wajib diisi.',
            'narahubung.*.telepon.required'     => 'Nomor telepon narahubung wajib diisi.',
            'narahubung.*.email.required'       => 'Email narahubung wajib diisi.',
            'narahubung.*.email.email'          => 'Format email narahubung tidak valid.',
        ];
    }
}