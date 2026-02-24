<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Http;
use Exception;

trait HasMediaUpload
{
    /**
     * Upload media to any model.
     *
     * @param  mixed  $file  UploadedFile, Base64 string, or URL
     * @param  string $collection
     * @param  string $disk
     * @param  \Illuminate\Database\Eloquent\Model|null $model
     * @param  int|null $userId  <-- هنا بنضيف ID المستخدم
     * @return \Spatie\MediaLibrary\MediaCollections\Models\Media
     * @throws \Exception
     */
    public function uploadMedia($file, string $collection = 'default', string $disk = 'public', $model = null, $userId = null): Media
    {
        if (!$model) {
            throw new Exception('Model instance is required to upload media.');
        }

        // تحديد مسار خاص لكل مستخدم داخل public/media
        $userFolder = $userId ? "users/{$userId}" : "users/general";

        // رفع ملف UploadedFile
        if ($file instanceof UploadedFile) {
            return $model->addMedia($file)
                ->usingFileName(uniqid() . '.' . $file->getClientOriginalExtension())
                ->storingConversionsOnDisk($disk)
                ->withCustomProperties(['path' => $userFolder])
                ->toMediaCollection($collection, $disk);
        }

        // رفع Base64
        if (is_string($file) && preg_match('/^data:image/', $file)) {
            return $model->addMediaFromBase64($file)
                ->storingConversionsOnDisk($disk)
                ->withCustomProperties(['path' => $userFolder])
                ->toMediaCollection($collection, $disk);
        }

        // رفع من رابط URL
        if (is_string($file) && filter_var($file, FILTER_VALIDATE_URL)) {
            $response = Http::get($file);

            if ($response->ok()) {
                $tempFile = tempnam(sys_get_temp_dir(), 'media_');
                file_put_contents($tempFile, $response->body());

                $media = $model->addMedia($tempFile)
                    ->withCustomProperties(['path' => $userFolder])
                    ->toMediaCollection($collection, $disk);

                @unlink($tempFile);
                return $media;
            }

            throw new Exception('Unable to fetch file from URL.');
        }

        throw new Exception('File must be an UploadedFile, Base64 string, or valid URL.');
    }


    /**
     * Clear all media from a specific collection safely.
     *
     * @param string $collection
     */
    public function clearMediaFromCollection(string $collection = 'default')
    {
        $this->clearMediaCollection($collection);
    }
}
