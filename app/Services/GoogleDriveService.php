<?php

namespace App\Services;

use Google\Client as GoogleClient;
use Google\Service\Drive as GoogleDrive;
use Google\Service\Drive\DriveFile;

class GoogleDriveService
{
    protected GoogleDrive $service;

    public function __construct()
    {
        $client = new GoogleClient();
        $client->setAuthConfig(storage_path('app/google/service-account.json'));
        $client->addScope(GoogleDrive::DRIVE_READONLY);

        $this->service = new GoogleDrive($client);
    }

    /**
     * Ambil daftar isi sebuah folder Google Drive (folder & file).
     * Folder ditampilkan lebih dulu, lalu file, masing-masing diurutkan berdasarkan nama.
     *
     * @return DriveFile[]
     */
    public function getFiles(string $folderId): array
    {
        $result = $this->service->files->listFiles([
            'q' => "'{$folderId}' in parents and trashed = false",
            'fields' => 'files(id, name, mimeType, thumbnailLink, webViewLink)',
            'orderBy' => 'folder,name',
            'pageSize' => 1000,
        ]);

        return $result->getFiles();
    }

    /**
     * Ambil nama & parent dari sebuah folder (untuk breadcrumb / tombol kembali).
     *
     * @return array{name: string, parents: array}
     */
    public function getFolderInfo(string $folderId): array
    {
        $meta = $this->service->files->get($folderId, [
            'fields' => 'name,parents',
        ]);

        return [
            'name' => $meta->getName(),
            'parents' => $meta->getParents() ?? [],
        ];
    }

    /**
     * Ambil metadata + isi konten satu file, untuk diunduh lewat server sendiri.
     *
     * @return array{name: string, mimeType: string, content: string}
     */
    public function downloadFile(string $fileId): array
    {
        $meta = $this->service->files->get($fileId, [
            'fields' => 'name,mimeType',
        ]);

        $response = $this->service->files->get($fileId, [
            'alt' => 'media',
        ]);

        return [
            'name' => $meta->getName(),
            'mimeType' => $meta->getMimeType(),
            'content' => $response->getBody()->getContents(),
        ];
    }
}