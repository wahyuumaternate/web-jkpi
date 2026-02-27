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
    public function generate(Peserta $peserta, bool $skipVerificationCheck = false): string
    {
        \Log::info('=== START ID CARD GENERATION ===', [
            'peserta_id' => $peserta->id,
            'kode_registrasi' => $peserta->kode_registrasi,
            'nama' => $peserta->nama_lengkap,
            'status' => $peserta->status,
            'skip_verification' => $skipVerificationCheck,
        ]);

        try {
            // Cek status verified
            if (!$skipVerificationCheck && $peserta->status !== 'verified') {
                \Log::warning('Peserta belum verified', [
                    'kode_registrasi' => $peserta->kode_registrasi,
                    'status' => $peserta->status,
                ]);
                throw new \Exception('Peserta belum terverifikasi. ID Card hanya bisa dibuat untuk peserta yang sudah verified.');
            }

            \Log::info('Step 1: Generating QR Code');
            // Generate QR Code
            $qrCode = base64_encode(QrCode::format('png')->size(300)->errorCorrection('H')->margin(0)->generate($peserta->kode_registrasi));
            \Log::info('QR Code generated', ['length' => strlen($qrCode)]);

            \Log::info('Step 2: Getting foto base64');
            $foto = $this->getFotoBase64($peserta);
            \Log::info('Foto processed', ['has_foto' => !is_null($foto)]);

            \Log::info('Step 3: Getting logo base64');
            $logo = $this->getLogoBase64();
            \Log::info('Logo processed', ['has_logo' => !is_null($logo)]);

            // Persiapkan data untuk view
            $data = [
                'nama' => $peserta->nama_lengkap,
                'instansi' => $peserta->instansi_organisasi,
                'status' => $peserta->jabatan,
                'kota' => $peserta->kota_kabupaten,
                'foto' => $foto,
                'logo' => $logo,
                'qrCode' => $qrCode,
                'nomor_id' => $peserta->kode_registrasi,
                'initial' => strtoupper(substr($peserta->nama_lengkap, 0, 1)),
            ];

            \Log::info('Step 4: Data prepared for PDF', $data);

            \Log::info('Step 5: Generating PDF');
            $pdf = Pdf::loadView('pdf.id-card', $data)
                ->setPaper([0, 0, 269.287, 357.1596], 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => false,
                    'defaultFont' => 'sans-serif',
                    'dpi' => 96,
                    'enable_php' => false,
                    'chroot' => public_path(),
                ]);
            \Log::info('PDF object created');

            // Buat direktori jika belum ada
            $directory = 'id-cards';
            \Log::info('Step 6: Checking directory', ['directory' => $directory]);

            if (!Storage::disk('public')->exists($directory)) {
                \Log::info('Creating directory');
                Storage::disk('public')->makeDirectory($directory);
            }

            $directoryPath = Storage::disk('public')->path($directory);
            \Log::info('Directory info', [
                'path' => $directoryPath,
                'exists' => file_exists($directoryPath),
                'writable' => is_writable($directoryPath),
            ]);

            // Simpan PDF
            $filename = $directory . '/id-card-' . $peserta->kode_registrasi . '.pdf';
            \Log::info('Step 7: Generating PDF output', ['filename' => $filename]);

            $pdfContent = $pdf->output();
            \Log::info('PDF content generated', ['size' => strlen($pdfContent)]);

            \Log::info('Step 8: Saving to storage');
            Storage::disk('public')->put($filename, $pdfContent);

            $fullPath = Storage::disk('public')->path($filename);
            \Log::info('PDF saved', [
                'filename' => $filename,
                'full_path' => $fullPath,
                'file_exists' => file_exists($fullPath),
                'file_size' => file_exists($fullPath) ? filesize($fullPath) : 0,
            ]);

            // Verifikasi file berhasil dibuat
            if (!Storage::disk('public')->exists($filename)) {
                throw new \Exception('Failed to save PDF file - file does not exist after save');
            }

            \Log::info('=== ID CARD GENERATED SUCCESSFULLY ===', [
                'kode_registrasi' => $peserta->kode_registrasi,
                'filename' => $filename,
                'url' => asset('storage/' . $filename),
            ]);

            return $filename;
        } catch (\Exception $e) {
            \Log::error('=== ID CARD GENERATION FAILED ===', [
                'kode_registrasi' => $peserta->kode_registrasi ?? 'unknown',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
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

            \Log::info('Getting logo', [
                'path' => $logoPath,
                'exists' => file_exists($logoPath),
            ]);

            if (!file_exists($logoPath)) {
                \Log::warning('Logo JKPI not found at: ' . $logoPath);
                return null;
            }

            $imageData = base64_encode(file_get_contents($logoPath));
            $mimeType = mime_content_type($logoPath);

            \Log::info('Logo loaded', [
                'mime_type' => $mimeType,
                'size' => strlen($imageData),
            ]);

            return "data:$mimeType;base64,$imageData";
        } catch (\Exception $e) {
            \Log::error('Error loading logo: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Get foto peserta dalam base64
     */
    private function getFotoBase64(Peserta $peserta): ?string
    {
        if (!$peserta->foto) {
            \Log::info('No photo for peserta', ['kode_registrasi' => $peserta->kode_registrasi]);
            return null;
        }

        try {
            $path = Storage::disk('public')->path($peserta->foto);

            \Log::info('Getting photo', [
                'peserta' => $peserta->kode_registrasi,
                'foto_field' => $peserta->foto,
                'path' => $path,
                'exists' => file_exists($path),
            ]);

            if (!file_exists($path)) {
                \Log::warning('Photo file not found', [
                    'path' => $path,
                    'peserta' => $peserta->kode_registrasi,
                ]);
                return null;
            }

            $imageData = file_get_contents($path);
            $mimeType = mime_content_type($path);
            $base64 = base64_encode($imageData);

            \Log::info('Photo loaded', [
                'mime_type' => $mimeType,
                'size' => strlen($base64),
            ]);

            return "data:$mimeType;base64,$base64";
        } catch (\Exception $e) {
            \Log::error('Error loading photo', [
                'peserta' => $peserta->kode_registrasi,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Generate ID Card dan return sebagai stream
     */
    public function generateStream(Peserta $peserta, bool $skipVerificationCheck = false)
    {
        try {
            if (!$skipVerificationCheck && $peserta->status !== 'verified') {
                throw new \Exception('Peserta belum terverifikasi.');
            }

            $qrCode = base64_encode(QrCode::format('png')->size(300)->errorCorrection('H')->margin(0)->generate($peserta->kode_registrasi));

            $data = [
                'nama' => $peserta->nama_lengkap,
                'instansi' => $peserta->instansi_organisasi,
                'status' => $peserta->jabatan,
                'kota' => $peserta->kota_kabupaten,
                'foto' => $this->getFotoBase64($peserta),
                'logo' => $this->getLogoBase64(),
                'qrCode' => $qrCode,
                'nomor_id' => $peserta->kode_registrasi,
                'initial' => strtoupper(substr($peserta->nama_lengkap, 0, 1)),
            ];

            return Pdf::loadView('pdf.id-card', $data)
                ->setPaper([0, 0, 269.287, 357.1596], 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => false,
                    'defaultFont' => 'sans-serif',
                    'dpi' => 96,
                    'enable_php' => false,
                    'chroot' => public_path(),
                ]);
        } catch (\Exception $e) {
            \Log::error('Error generating ID Card stream', [
                'kode_registrasi' => $peserta->kode_registrasi ?? 'unknown',
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Generate ID Cards untuk multiple peserta
     */
    public function generateBulk(array $pesertaIds, bool $skipVerificationCheck = false): array
    {
        $results = [
            'success' => [],
            'failed' => [],
        ];

        foreach ($pesertaIds as $pesertaId) {
            try {
                $peserta = Peserta::findOrFail($pesertaId);
                $filename = $this->generate($peserta, $skipVerificationCheck);

                $results['success'][] = [
                    'id' => $peserta->id,
                    'kode_registrasi' => $peserta->kode_registrasi,
                    'nama' => $peserta->nama_lengkap,
                    'file' => $filename,
                ];
            } catch (\Exception $e) {
                $results['failed'][] = [
                    'id' => $pesertaId,
                    'error' => $e->getMessage(),
                ];
            }
        }

        return $results;
    }

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

    public function exists(Peserta $peserta): bool
    {
        $filename = 'id-cards/id-card-' . $peserta->kode_registrasi . '.pdf';
        return Storage::disk('public')->exists($filename);
    }

    public function getPath(Peserta $peserta): ?string
    {
        $filename = 'id-cards/id-card-' . $peserta->kode_registrasi . '.pdf';

        if ($this->exists($peserta)) {
            return $filename;
        }

        return null;
    }

    public function getUrl(Peserta $peserta): ?string
    {
        $path = $this->getPath($peserta);

        if ($path) {
            return asset('storage/' . $path);
        }

        return null;
    }
}
