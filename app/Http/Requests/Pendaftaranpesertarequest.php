<?php

namespace App\Http\Requests;

use App\Models\Kegiatan;
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
            // ===== Data Daerah & Kepala Daerah =====
            'nama_daerah' => ['required', 'string', 'max:255'],
            'nama_kepala_daerah' => ['required', 'string', 'max:255'],
            'nama_pasangan_kepala_daerah' => ['nullable', 'string', 'max:255'],

            // ===== Informasi Tambahan (BARU) =====
            'ukuran_baju' => ['required', 'in:S,M,L,XL,XXL,XXXL'],
            'jumlah_rombongan' => ['required', 'integer', 'min:1', 'max:200'],

            // ===== Kegiatan (BARU) =====
            'kegiatan' => ['required', 'array', 'min:1'],
            'kegiatan.*' => ['string', 'in:' . implode(',', Kegiatan::KEGIATAN_VALID)],

            // ===== Informasi Perjalanan =====
            'nomor_plat' => ['nullable', 'string', 'max:20'],
            'info_kedatangan' => ['required', 'string', 'max:255'],
            'info_kepulangan' => ['required', 'string', 'max:255'],

            // ===== Data Ajudan / ADC =====
            'nama_ajudan' => ['nullable', 'string', 'max:255'],
            'telepon_ajudan' => ['nullable', 'string', 'max:20'],

            // ===== Narahubung =====
            'narahubung' => ['required', 'array', 'min:1'],
            'narahubung.*.nama' => ['required', 'string', 'max:255'],
            'narahubung.*.telepon' => ['required', 'string', 'max:20'],
            'narahubung.*.email' => ['required', 'email', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_daerah.required' => 'Nama daerah wajib dipilih.',
            'nama_kepala_daerah.required' => 'Nama kepala daerah wajib diisi.',

            'ukuran_baju.required' => 'Ukuran baju wajib dipilih.',
            'ukuran_baju.in' => 'Ukuran baju tidak valid.',

            'jumlah_rombongan.required' => 'Jumlah rombongan wajib diisi.',
            'jumlah_rombongan.integer' => 'Jumlah rombongan harus berupa angka.',
            'jumlah_rombongan.min' => 'Jumlah rombongan minimal 1 orang.',

            'kegiatan.required' => 'Mohon pilih minimal satu kegiatan yang akan diikuti.',
            'kegiatan.min' => 'Mohon pilih minimal satu kegiatan yang akan diikuti.',
            'kegiatan.*.in' => 'Salah satu kegiatan yang dipilih tidak valid.',

            'info_kedatangan.required' => 'Info kedatangan wajib diisi.',
            'info_kepulangan.required' => 'Info kepulangan wajib diisi.',

            'narahubung.required' => 'Mohon isi minimal satu data narahubung.',
            'narahubung.min' => 'Mohon isi minimal satu data narahubung.',
            'narahubung.*.nama.required' => 'Nama narahubung wajib diisi.',
            'narahubung.*.telepon.required' => 'Nomor telepon narahubung wajib diisi.',
            'narahubung.*.email.required' => 'Email narahubung wajib diisi.',
            'narahubung.*.email.email' => 'Format email narahubung tidak valid.',
        ];
    }
}