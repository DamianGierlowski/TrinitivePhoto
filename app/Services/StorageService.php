<?php

namespace App\Services;

use App\Enum\FileCatalog;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Storage;

class StorageService
{
    public function uploadFile(UploadedFile $file, string $key, FileCatalog $catalog): File
    {
        $fileGuid =  Str::uuid()->toString();
        $path = $key . '/' . $catalog->value . '/' . $fileGuid . $file->getClientOriginalExtension();
        $uploadedPath = Storage::disk('s3')->put($path, $file);

        $file = File::create([
             'name' => $file->getClientOriginalName(),
             'path' => $uploadedPath,
             'size' => $file->getSize(),
             'mime_type'=> $file->getMimeType(),
            'guid' => $fileGuid
         ]);

        return $file;
    }

    public function deleteFile()
    {
        //TODO
    }

    public function formatBytes($bytes, $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function uploadThumbnail(UploadedFile $file, string $key): File
    {
        $manager = new ImageManager(new Driver()); // Domyślnie używa GD
        $image = $manager->read($file->getRealPath())
            ->resize(800, 600);

        $catalog = FileCatalog::THUMBNAIL;
        $fileGuid =  Str::uuid()->toString();
        $path = $key . '/' . $catalog->value . '/' . $fileGuid . $file->getClientOriginalExtension();
        $uploadedPath = Storage::disk('s3')->put($path, (string) $image->toJpeg(80));

        $file = File::create([
            'name' => $file->getClientOriginalName(),
            'path' => $uploadedPath,
            'size' => $file->getSize(),
            'mime_type'=> $file->getMimeType(),
            'guid' => $fileGuid
        ]);

        return $file;
    }

}
