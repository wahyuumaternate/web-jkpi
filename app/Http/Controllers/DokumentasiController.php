<?php

namespace App\Http\Controllers;

use App\Services\GoogleDriveService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DokumentasiController extends Controller
{
    /**
     * ID folder Google Drive paling atas (root) untuk dokumentasi.
     */
    protected string $rootFolderId = '15DnoyY-kjM-46OAxZxLvPb3t6Aj11hLc';

    public function index(GoogleDriveService $googleDrive, ?string $folderId = null)
    {
        $folderId = $folderId ?: $this->rootFolderId;
        $isRoot = $folderId === $this->rootFolderId;

        $files = $googleDrive->getFiles($folderId);

        $folderName = null;
        $parentFolderId = null;

        if (!$isRoot) {
            $currentFolder = $googleDrive->getFolderInfo($folderId);
            $folderName = $currentFolder['name'];
            $parentFolderId = $currentFolder['parents'][0] ?? null;
        }

        return view('dokumentasi', [
            'files' => $files,
            'folderName' => $folderName,
            'parentFolderId' => $parentFolderId,
            'isRoot' => $isRoot,
            'currentFolderId' => $folderId,
        ]);
    }

    public function download(string $fileId, GoogleDriveService $googleDrive)
    {
        $file = $googleDrive->downloadFile($fileId);

        return response($file['content'], 200)
            ->header('Content-Type', $file['mimeType'])
            ->header('Content-Disposition', 'attachment; filename="' . $file['name'] . '"')
            ->header('Content-Length', strlen($file['content']));
    }

    /**
     * Download beberapa file terpilih (dari checkbox) sebagai satu file ZIP.
     * Menerima JSON body: { "ids": ["id1", "id2", ...] }
     */
    public function downloadZip(Request $request, GoogleDriveService $googleDrive)
    {
        $fileIds = $request->input('ids', []);

        if (is_string($fileIds)) {
            $fileIds = explode(',', $fileIds);
        }

        $fileIds = array_values(array_filter(array_unique($fileIds)));

        if (empty($fileIds)) {
            abort(400, 'Tidak ada file yang dipilih.');
        }

        // Batas wajar supaya tidak menghabiskan resource server.
        if (count($fileIds) > 200) {
            abort(400, 'Terlalu banyak file dipilih (maksimal 200).');
        }

        $zipName = 'dokumentasi-terpilih-' . now()->format('Ymd-His') . '.zip';

        return $this->buildZipResponse($fileIds, $googleDrive, $zipName);
    }

    /**
     * Bangun file ZIP dari daftar fileId Google Drive, lalu kirim sebagai response download.
     */
    protected function buildZipResponse(array $fileIds, GoogleDriveService $googleDrive, string $zipName)
    {
        $tmpDir = storage_path('app/tmp');
        if (!is_dir($tmpDir)) {
            mkdir($tmpDir, 0755, true);
        }

        $tmpPath = $tmpDir . '/' . $zipName;

        $zip = new ZipArchive();
        if ($zip->open($tmpPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            abort(500, 'Gagal membuat file ZIP.');
        }

        $usedNames = [];
        $added = 0;

        foreach ($fileIds as $fileId) {
            try {
                $file = $googleDrive->downloadFile($fileId);
            } catch (\Throwable $e) {
                Log::warning("Gagal unduh file Drive untuk ZIP: {$fileId} - {$e->getMessage()}");
                continue;
            }

            $name = $this->uniqueZipName($file['name'], $usedNames);
            $usedNames[$name] = true;

            $zip->addFromString($name, $file['content']);
            $added++;
        }

        $zip->close();

        if ($added === 0) {
            @unlink($tmpPath);
            abort(500, 'Semua file gagal diunduh dari Google Drive.');
        }

        return response()->download($tmpPath, $zipName)->deleteFileAfterSend(true);
    }

    /**
     * Hindari nama file bentrok di dalam ZIP (mis. dua file bernama sama di folder berbeda).
     */
    protected function uniqueZipName(string $name, array $usedNames): string
    {
        if (!isset($usedNames[$name])) {
            return $name;
        }

        $ext = pathinfo($name, PATHINFO_EXTENSION);
        $stem = pathinfo($name, PATHINFO_FILENAME);

        $i = 1;
        do {
            $candidate = $ext ? "{$stem} ({$i}).{$ext}" : "{$stem} ({$i})";
            $i++;
        } while (isset($usedNames[$candidate]));

        return $candidate;
    }
}
