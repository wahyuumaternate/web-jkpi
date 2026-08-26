<?php

namespace App\Http\Controllers;

use App\Services\GoogleDriveService;

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

        if (! $isRoot) {
            $currentFolder = $googleDrive->getFolderInfo($folderId);
            $folderName = $currentFolder['name'];
            // Kalau parent-nya bukan root, arahkan tombol "kembali" ke parent itu.
            // Kalau parent-nya root (atau tidak diketahui), kembali ke halaman utama dokumentasi.
            $parentFolderId = $currentFolder['parents'][0] ?? null;
        }

        return view('dokumentasi', [
            'files' => $files,
            'folderName' => $folderName,
            'parentFolderId' => $parentFolderId,
            'isRoot' => $isRoot,
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
}