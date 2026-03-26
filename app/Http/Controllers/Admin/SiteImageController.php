<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;

class SiteImageController extends Controller
{
    /**
     * The manageable site images with their display names and paths.
     */
    private function getSiteImages(): array
    {
        return [
            // Hero Slides
            [
                'key' => 'slide1',
                'label' => 'Hero Slide 1',
                'filename' => 'slide1.jpg',
                'group' => 'Hero Slides',
            ],
            [
                'key' => 'slide2',
                'label' => 'Hero Slide 2',
                'filename' => 'slide2.jpg',
                'group' => 'Hero Slides',
            ],

            // Footer Instagram Images
            [
                'key' => 'ig1',
                'label' => 'Instagram 1',
                'filename' => 'ig1.jpg',
                'group' => 'Footer Instagram',
            ],
            [
                'key' => 'ig2',
                'label' => 'Instagram 2',
                'filename' => 'ig2.jpg',
                'group' => 'Footer Instagram',
            ],
            [
                'key' => 'ig3',
                'label' => 'Instagram 3',
                'filename' => 'ig3.jpg',
                'group' => 'Footer Instagram',
            ],
            [
                'key' => 'ig4',
                'label' => 'Instagram 4',
                'filename' => 'ig4.jpg',
                'group' => 'Footer Instagram',
            ],
            [
                'key' => 'ig5',
                'label' => 'Instagram 5',
                'filename' => 'ig5.jpg',
                'group' => 'Footer Instagram',
            ],
            [
                'key' => 'ig6',
                'label' => 'Instagram 6',
                'filename' => 'ig6.jpg',
                'group' => 'Footer Instagram',
            ],

            // Page Heroes
            [
                'key' => 'about-intro',
                'label' => 'About Intro',
                'filename' => 'about-intro.jpg',
                'group' => 'Page Backgrounds',
            ],
            [
                'key' => 'services-hero',
                'label' => 'Services Hero',
                'filename' => 'services-hero.jpg',
                'group' => 'Page Backgrounds',
            ],
            [
                'key' => 'contact-hero',
                'label' => 'Contact Hero',
                'filename' => 'contact-hero.jpg',
                'group' => 'Page Backgrounds',
            ],

            // Logo
            [
                'key' => 'logo',
                'label' => 'Site Logo',
                'filename' => 'logo.png',
                'group' => 'Branding',
            ],
        ];
    }

    /**
     * Show the site images management page.
     */
    public function index()
    {
        $images = $this->getSiteImages();

        // Group images by category
        $groups = [];
        foreach ($images as $image) {
            $groups[$image['group']][] = $image;
        }

        // Calculate sizes
        foreach ($images as &$image) {
            $path = public_path('images/' . $image['filename']);
            $image['exists'] = file_exists($path);
            $image['size'] = $image['exists'] ? $this->formatFileSize(filesize($path)) : '—';
        }

        // Re-group with sizes
        $groups = [];
        foreach ($images as $image) {
            $groups[$image['group']][] = $image;
        }

        return view('admin.site-images.index', compact('groups'));
    }

    /**
     * Handle image uploads.
     */
    public function update(Request $request)
    {
        $siteImages = $this->getSiteImages();
        $validKeys = array_column($siteImages, 'key');
        $keyToFilename = array_column($siteImages, 'filename', 'key');

        $uploadedCount = 0;

        foreach ($validKeys as $key) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);

                if (!$file->isValid()) {
                    continue;
                }

                $targetFilename = $keyToFilename[$key];
                $targetPath = public_path('images/' . $targetFilename);

                // Determine max width based on type
                $maxWidth = 1920;
                if (str_starts_with($key, 'ig')) {
                    $maxWidth = 800; // Instagram images are small in footer
                } elseif ($key === 'logo') {
                    $maxWidth = 400; // Logo doesn't need to be huge
                }

                $quality = ($key === 'logo') ? 90 : 80;

                try {
                    $extension = strtolower($file->getClientOriginalExtension());

                    // Create image from upload
                    $source = match ($extension) {
                        'jpg', 'jpeg' => @imagecreatefromjpeg($file->getPathname()),
                        'png' => @imagecreatefrompng($file->getPathname()),
                        'webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($file->getPathname()) : false,
                        default => false,
                    };

                    if (!$source) {
                        // Fallback: just copy the file
                        $file->move(public_path('images'), $targetFilename);
                        $uploadedCount++;
                        continue;
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

                    // For PNG logos, preserve transparency
                    if ($key === 'logo' && $extension === 'png') {
                        imagealphablending($resized, false);
                        imagesavealpha($resized, true);
                        $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
                        imagefill($resized, 0, 0, $transparent);
                    } else {
                        $white = imagecolorallocate($resized, 255, 255, 255);
                        imagefill($resized, 0, 0, $white);
                    }

                    imagecopyresampled(
                        $resized, $source,
                        0, 0, 0, 0,
                        $newWidth, $newHeight,
                        $origWidth, $origHeight
                    );

                    // Save as correct format
                    if ($key === 'logo' && str_ends_with($targetFilename, '.png')) {
                        imagepng($resized, $targetPath, 8);
                    } else {
                        // Save as JPEG
                        $jpegPath = preg_replace('/\.(png|webp)$/i', '.jpg', $targetPath);
                        imagejpeg($resized, $jpegPath, $quality);
                    }

                    imagedestroy($source);
                    imagedestroy($resized);
                    $uploadedCount++;

                } catch (\Exception $e) {
                    \Log::warning('Site image upload failed', [
                        'key' => $key,
                        'error' => $e->getMessage(),
                    ]);
                    // Fallback: just copy
                    $file->move(public_path('images'), $targetFilename);
                    $uploadedCount++;
                }
            }
        }

        if ($uploadedCount > 0) {
            return back()->with('success', $uploadedCount . ' image(s) uploaded and compressed successfully!');
        }

        return back()->with('info', 'No images were selected for upload.');
    }

    private function formatFileSize(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 1) . ' MB';
        }
        return round($bytes / 1024, 1) . ' KB';
    }
}
