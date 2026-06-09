<?php

// app/Http/Requests/PendaftaranPesertaRequest.php

namespace App\Http\Requests;

use App\Models\Kegiatan;
use App\Models\PendaftaranKegiatan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PendaftaranPesertaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // ── Data Daerah & Kepala Daerah ──────────────────────────
            'nama_daerah'                   => ['required', 'string', 'max:100'],
            'nama_kepala_daerah'            => ['required', 'string', 'max:150'],
            'nama_pasangan_kepala_daerah'   => ['nullable', 'string', 'max:150'],

            // ── Informasi Tambahan ────────────────────────────────────
            'ukuran_baju'                   => ['required', Rule::in(['S', 'M', 'L', 'XL', 'XXL', 'XXXL'])],
            'ukuran_baju_pasangan'          => ['nullable', Rule::in(['S', 'M', 'L', 'XL', 'XXL', 'XXXL'])],
            'jumlah_rombongan'              => ['required', 'integer', 'min:1', 'max:999'],

            // ── Kegiatan (opsional, tapi tiap item harus valid) ───────
            'kegiatan'                      => ['nullable', 'array'],
            'kegiatan.*'                    => ['string', Rule::in(Kegiatan::KEGIATAN_VALID)],

            // ── Informasi Perjalanan ──────────────────────────────────
            'nomor_plat'                    => ['nullable', 'string', 'max:20'],
            'info_kedatangan'               => ['required', 'string', 'max:255'],
            'info_kepulangan'               => ['required', 'string', 'max:255'],

            // ── Data Ajudan / ADC ─────────────────────────────────────
            'nama_ajudan'                   => ['nullable', 'string', 'max:150'],
            'telepon_ajudan'                => ['nullable', 'string', 'max:20'],

            // ── Narahubung (minimal 1, maks bebas) ───────────────────
            'narahubung'                    => ['required', 'array', 'min:1'],
            'narahubung.*.nama'             => ['required', 'string', 'max:150'],
            'narahubung.*.telepon'          => ['required', 'string', 'max:20'],
            'narahubung.*.email'            => ['required', 'email', 'max:150'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_daerah.required'          => 'Nama daerah wajib dipilih.',
            'nama_kepala_daerah.required'   => 'Nama kepala daerah wajib diisi.',
            'ukuran_baju.required'          => 'Ukuran baju kepala daerah wajib dipilih.',
            'ukuran_baju.in'                => 'Ukuran baju tidak valid.',
            'ukuran_baju_pasangan.in'       => 'Ukuran baju pasangan tidak valid.',
            'jumlah_rombongan.required'     => 'Jumlah rombongan wajib diisi.',
            'jumlah_rombongan.integer'      => 'Jumlah rombongan harus berupa angka.',
            'jumlah_rombongan.min'          => 'Jumlah rombongan minimal 1.',
            'kegiatan.*.in'                 => 'Salah satu kegiatan yang dipilih tidak valid.',
            'info_kedatangan.required'      => 'Info kedatangan wajib diisi.',
            'info_kepulangan.required'      => 'Info kepulangan wajib diisi.',
            'narahubung.required'           => 'Minimal satu narahubung wajib diisi.',
            'narahubung.min'                => 'Minimal satu narahubung wajib diisi.',
            'narahubung.*.nama.required'    => 'Nama narahubung wajib diisi.',
            'narahubung.*.telepon.required' => 'Nomor telepon narahubung wajib diisi.',
            'narahubung.*.email.required'   => 'Email narahubung wajib diisi.',
            'narahubung.*.email.email'      => 'Format email narahubung tidak valid.',
        ];
    }
}