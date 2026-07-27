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
            'nama_daerah' => ['required', 'string', 'max:100'],
            'nama_daerah_lainnya' => ['nullable', 'string', 'max:100',
                           'required_if:nama_daerah,__lainnya__'],
            'nama_kepala_daerah' => ['nullable', 'string', 'max:150', 'required_without:nama_wakil_kepala_daerah'],
            'nama_pasangan_kepala_daerah' => ['nullable', 'string', 'max:150'],
            'ukuran_baju' => ['nullable', 'required_with:nama_kepala_daerah', Rule::in(['S', 'M', 'L', 'XL', 'XXL', 'XXXL'])],
            'ukuran_peci' => ['nullable', 'required_with:nama_kepala_daerah', 'string', 'max:10'],
            'ukuran_baju_pasangan' => ['nullable', 'required_with:nama_pasangan_kepala_daerah', Rule::in(['S', 'M', 'L', 'XL', 'XXL', 'XXXL'])],

            // ── Data Wakil Kepala Daerah ───────────────────────────────
            'nama_wakil_kepala_daerah' => ['nullable', 'string', 'max:150', 'required_without:nama_kepala_daerah'],
            'ukuran_baju_wakil' => ['nullable', 'required_with:nama_wakil_kepala_daerah', Rule::in(['S', 'M', 'L', 'XL', 'XXL', 'XXXL'])],
            'ukuran_peci_wakil' => ['nullable', 'string', 'max:10'],
            'nama_pasangan_wakil_kepala_daerah' => ['nullable', 'string', 'max:150'],
            'ukuran_baju_pasangan_wakil' => ['nullable', 'required_with:nama_pasangan_wakil_kepala_daerah', Rule::in(['S', 'M', 'L', 'XL', 'XXL', 'XXXL'])],

            'jumlah_rombongan' => ['required', 'integer', 'min:1', 'max:999'],

            // ── Kegiatan (opsional, tapi tiap item harus valid) ───────
            'kegiatan' => ['nullable', 'array'],
            'kegiatan.*' => ['string', Rule::in(Kegiatan::KEGIATAN_VALID)],

            // ── Informasi Perjalanan ──────────────────────────────────
            'nomor_plat' => ['nullable', 'string', 'max:20'],
            'info_kedatangan' => ['required', 'string', 'max:255'],
            'info_kepulangan' => ['required', 'string', 'max:255'],

            // ── Data Ajudan / ADC ─────────────────────────────────────
            'nama_ajudan' => ['nullable', 'string', 'max:150'],
            'telepon_ajudan' => ['nullable', 'string', 'max:20'],

            // ── Narahubung (minimal 1, maks bebas) ───────────────────
            'narahubung' => ['required', 'array', 'min:1'],
            'narahubung.*.nama' => ['required', 'string', 'max:150'],
            'narahubung.*.telepon' => ['required', 'string', 'max:20'],
            'narahubung.*.email' => ['required', 'email', 'max:150'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_daerah.required' => 'Nama daerah wajib dipilih.',
'nama_daerah_lainnya.required_if' => 'Nama daerah wajib diisi jika memilih opsi "Lainnya".',
            'nama_kepala_daerah.required_without' => 'Nama Kepala Daerah atau Wakil Kepala Daerah harus diisi.',
            'nama_wakil_kepala_daerah.required_without' => 'Nama Kepala Daerah atau Wakil Kepala Daerah harus diisi.',
            'ukuran_baju.required' => 'Ukuran baju kepala daerah wajib dipilih jika nama kepala daerah diisi.',
            'ukuran_baju.in' => 'Ukuran baju tidak valid.',
            'ukuran_peci.required_with' => 'Ukuran peci kepala daerah wajib diisi jika nama kepala daerah diisi.',
            'ukuran_baju_pasangan.in' => 'Ukuran baju pasangan tidak valid.',
            'ukuran_baju_pasangan.required_with' => 'Ukuran baju pasangan wajib dipilih jika nama pasangan diisi.',
            'ukuran_peci.max' => 'Ukuran peci tidak valid.',

            'ukuran_baju_wakil.required_with' => 'Ukuran baju wakil kepala daerah wajib dipilih jika nama wakil kepala daerah diisi.',
            'ukuran_baju_wakil.in' => 'Ukuran baju wakil kepala daerah tidak valid.',
            'ukuran_baju_pasangan_wakil.required_with' => 'Ukuran baju pasangan wakil kepala daerah wajib dipilih jika nama pasangan wakil diisi.',
            'ukuran_baju_pasangan_wakil.in' => 'Ukuran baju pasangan wakil kepala daerah tidak valid.',
            'ukuran_peci_wakil.max' => 'Ukuran peci wakil kepala daerah tidak valid.',

            'jumlah_rombongan.required' => 'Jumlah rombongan wajib diisi.',
            'jumlah_rombongan.integer' => 'Jumlah rombongan harus berupa angka.',
            'jumlah_rombongan.min' => 'Jumlah rombongan minimal 1.',
            'kegiatan.*.in' => 'Salah satu kegiatan yang dipilih tidak valid.',
            'info_kedatangan.required' => 'Info kedatangan wajib diisi.',
            'info_kepulangan.required' => 'Info kepulangan wajib diisi.',
            'narahubung.required' => 'Minimal satu narahubung wajib diisi.',
            'narahubung.min' => 'Minimal satu narahubung wajib diisi.',
            'narahubung.*.nama.required' => 'Nama narahubung wajib diisi.',
            'narahubung.*.telepon.required' => 'Nomor telepon narahubung wajib diisi.',
            'narahubung.*.email.required' => 'Email narahubung wajib diisi.',
            'narahubung.*.email.email' => 'Format email narahubung tidak valid.',
        ];
    }
}