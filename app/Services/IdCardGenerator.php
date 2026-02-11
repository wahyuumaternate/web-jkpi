<?php

namespace App\Services;

use App\Models\Peserta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IdCardGenerator
{
    /**
     * Generate ID Card untuk peserta
     */
    public function generate(Peserta $peserta): string
    {
        try {
            // Generate QR Code dengan ukuran yang lebih besar
            $qrCode = base64_encode(QrCode::format('png')->size(400)->errorCorrection('H')->margin(0)->generate($peserta->kode_registrasi));

            // Persiapkan data untuk view
            $data = [
                'nama' => $this->formatNama($peserta->nama_lengkap),
                'status' => 'ANGGOTA',
                'foto' => $this->getFotoBase64($peserta),
                'logo' => $this->getLogoBase64(),
                'qrCode' => $qrCode,
                'website' => 'jkpi.ternatetourism.com',
                'phone' => '+123 456 7890',
                'kode_registrasi' => $peserta->kode_registrasi,
            ];

            // Generate PDF dengan konfigurasi yang lebih baik
            $pdf = Pdf::loadView('pdf.id-card', $data)
                ->setPaper([0, 0, 243, 387], 'portrait') // 85.6mm x 136mm in points
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => false,
                    'defaultFont' => 'Arial',
                    'dpi' => 300,
                    'enable_php' => false,
                    'chroot' => public_path(),
                ]);

            // Buat direktori jika belum ada
            $directory = 'id-cards';
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Simpan PDF
            $filename = $directory . '/id-card-' . $peserta->kode_registrasi . '.pdf';
            $pdfContent = $pdf->output();

            Storage::disk('public')->put($filename, $pdfContent);

            // Verifikasi file berhasil dibuat
            if (!Storage::disk('public')->exists($filename)) {
                throw new \Exception('Failed to save PDF file');
            }

            \Log::info('ID Card generated successfully for: ' . $peserta->kode_registrasi);

            return $filename;
        } catch (\Exception $e) {
            \Log::error('Error generating ID Card for peserta ' . $peserta->kode_registrasi . ': ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            throw $e;
        }
    }

    /**
     * Get logo JKPI dalam base64
     */
    private function getLogoBase64(): ?string
    {
        try {
            $logoPath = public_path('logo_jkpi_2026.png');

            if (!file_exists($logoPath)) {
                \Log::warning('Logo JKPI not found at: ' . $logoPath);
                return null;
            }

            $imageData = base64_encode(file_get_contents($logoPath));
            $mimeType = mime_content_type($logoPath);

            return "data:$mimeType;base64,$imageData";
        } catch (\Exception $e) {
            \Log::error('Error loading logo: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Format nama agar sesuai dengan ukuran ID Card
     */
    private function formatNama(string $nama): string
    {
        $nama = strtoupper($nama);

        // Jika nama terlalu panjang, potong
        if (strlen($nama) > 20) {
            // Coba ambil hanya nama depan dan belakang
            $parts = explode(' ', $nama);
            if (count($parts) > 2) {
                $nama = $parts[0] . ' ' . end($parts);
            }

            // Jika masih terlalu panjang
            if (strlen($nama) > 20) {
                $nama = substr($nama, 0, 18) . '..';
            }
        }

        return $nama;
    }

    /**
     * Get foto peserta dalam base64
     */
    private function getFotoBase64(Peserta $peserta): ?string
    {
        if (!$peserta->foto) {
            return null;
        }

        try {
            $path = Storage::disk('public')->path($peserta->foto);

            if (!file_exists($path)) {
                \Log::warning('Photo file not found: ' . $path);
                return null;
            }

            // Resize image untuk menghemat ukuran file
            $imageData = file_get_contents($path);
            $mimeType = mime_content_type($path);

            // Encode ke base64
            $base64 = base64_encode($imageData);

            return "data:$mimeType;base64,$base64";
        } catch (\Exception $e) {
            \Log::error('Error loading photo: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Delete ID Card file
     */
    public function delete(string $filename): bool
    {
        try {
            if (Storage::disk('public')->exists($filename)) {
                return Storage::disk('public')->delete($filename);
            }
            return true;
        } catch (\Exception $e) {
            \Log::error('Error deleting ID Card: ' . $e->getMessage());
            return false;
        }
    }
}
