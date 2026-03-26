<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    /**
     * Compress and store an uploaded image.
     *
     * @param UploadedFile $file      The uploaded file
     * @param string       $directory Storage directory (e.g. 'trips', 'posts')
     * @param string       $disk      Storage disk (default: 'public')
     * @param int          $maxWidth  Max width in pixels (default: 1920)
     * @param int          $quality   JPEG quality 1-100 (default: 80)
     * @return string|false           Stored path or false on failure
     */
    public static function compressAndStore(
        UploadedFile $file,
        string $directory,
        string $disk = 'public',
        int $maxWidth = 1920,
        int $quality = 80
    ): string|false {
        try {
            $extension = strtolower($file->getClientOriginalExtension());
            $filename = Str::random(30) . '.jpg'; // Always save as JPEG for best compression
            $path = $directory . '/' . $filename;

            // Create image resource from uploaded file
            $source = self::createImageFromFile($file->getPathname(), $extension);

            if (!$source) {
                // Fallback: store as-is if GD can't handle it
                return $file->store($directory, $disk);
            }

            // Get original dimensions
            $origWidth = imagesx($source);
            $origHeight = imagesy($source);

            // Calculate new dimensions (only resize if larger than maxWidth)
            if ($origWidth > $maxWidth) {
                $ratio = $maxWidth / $origWidth;
                $newWidth = $maxWidth;
                $newHeight = (int) round($origHeight * $ratio);
            } else {
                $newWidth = $origWidth;
                $newHeight = $origHeight;
            }

            // Create resized image
            $resized = imagecreatetruecolor($newWidth, $newHeight);

            // Preserve transparency for PNGs (convert to white background)
            $white = imagecolorallocate($resized, 255, 255, 255);
            imagefill($resized, 0, 0, $white);

            imagecopyresampled(
                $resized, $source,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $origWidth, $origHeight
            );

            // Capture compressed image to a temp file
            $tempPath = tempnam(sys_get_temp_dir(), 'img_');
            imagejpeg($resized, $tempPath, $quality);

            // Clean up GD resources
            imagedestroy($source);
            imagedestroy($resized);

            // Store to disk
            Storage::disk($disk)->put($path, file_get_contents($tempPath));

            // Clean up temp file
            @unlink($tempPath);

            return $path;

        } catch (\Exception $e) {
            \Log::warning('ImageHelper compression failed, storing original', [
                'error' => $e->getMessage(),
            ]);
            // Fallback: store as-is
            return $file->store($directory, $disk);
        }
    }

    /**
     * Compress an existing file on disk (for the artisan command).
     *
     * @param string $absolutePath Full path to the image file
     * @param int    $maxWidth     Max width in pixels
     * @param int    $quality      JPEG quality 1-100
     * @return bool
     */
    public static function compressExistingFile(
        string $absolutePath,
        int $maxWidth = 1920,
        int $quality = 80
    ): bool {
        try {
            $extension = strtolower(pathinfo($absolutePath, PATHINFO_EXTENSION));

            if (!in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                return false;
            }

            $source = self::createImageFromFile($absolutePath, $extension);
            if (!$source) {
                return false;
            }

            $origWidth = imagesx($source);
            $origHeight = imagesy($source);

            if ($origWidth > $maxWidth) {
                $ratio = $maxWidth / $origWidth;
                $newWidth = $maxWidth;
                $newHeight = (int) round($origHeight * $ratio);
            } else {
                $newWidth = $origWidth;
                $newHeight = $origHeight;
            }

            $resized = imagecreatetruecolor($newWidth, $newHeight);
            $white = imagecolorallocate($resized, 255, 255, 255);
            imagefill($resized, 0, 0, $white);

            imagecopyresampled(
                $resized, $source,
                0, 0, 0, 0,
                $newWidth, $newHeight,
                $origWidth, $origHeight
            );

            // Save back to the same path as JPEG
            if ($extension === 'png') {
                // For PNGs, save as JPEG with a new extension
                $newPath = preg_replace('/\.png$/i', '.jpg', $absolutePath);
                imagejpeg($resized, $newPath, $quality);
                if ($newPath !== $absolutePath) {
                    @unlink($absolutePath); // Remove old PNG
                }
            } else {
                imagejpeg($resized, $absolutePath, $quality);
            }

            imagedestroy($source);
            imagedestroy($resized);

            return true;

        } catch (\Exception $e) {
            \Log::warning('ImageHelper compress existing failed', [
                'file' => $absolutePath,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Create a GD image resource from a file.
     */
    private static function createImageFromFile(string $path, string $extension)
    {
        return match ($extension) {
            'jpg', 'jpeg' => @imagecreatefromjpeg($path),
            'png' => @imagecreatefrompng($path),
            'webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : false,
            default => false,
        };
    }
}
