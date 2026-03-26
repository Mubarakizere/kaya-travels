<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\ImageHelper;

class CompressExistingImages extends Command
{
    protected $signature = 'images:compress-existing
                            {--max-width=1920 : Maximum width in pixels}
                            {--quality=80 : JPEG quality (1-100)}
                            {--dry-run : Show what would be compressed without actually doing it}';

    protected $description = 'Compress all existing images in the public/images directory';

    public function handle()
    {
        $maxWidth = (int) $this->option('max-width');
        $quality = (int) $this->option('quality');
        $dryRun = $this->option('dry-run');

        $directory = public_path('images');

        if (!is_dir($directory)) {
            $this->error('Directory not found: ' . $directory);
            return 1;
        }

        $files = glob($directory . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);

        if (empty($files)) {
            $this->info('No image files found in ' . $directory);
            return 0;
        }

        $this->info('Found ' . count($files) . ' images in ' . $directory);
        $this->newLine();

        $totalBefore = 0;
        $totalAfter = 0;
        $compressed = 0;

        foreach ($files as $file) {
            $filename = basename($file);
            $sizeBefore = filesize($file);
            $totalBefore += $sizeBefore;

            // Determine max width based on filename
            $fileMaxWidth = $maxWidth;
            if (str_starts_with($filename, 'ig')) {
                $fileMaxWidth = 800; // Instagram footer images
            } elseif ($filename === 'logo.png') {
                $this->line("  ⏭  Skipping {$filename} (logo, keep original)");
                $totalAfter += $sizeBefore;
                continue;
            }

            if ($dryRun) {
                $this->line("  📋 Would compress: {$filename} (" . $this->formatSize($sizeBefore) . ")");
                $totalAfter += $sizeBefore; // Estimate
                continue;
            }

            $this->line("  🔄 Compressing: {$filename} (" . $this->formatSize($sizeBefore) . ")...");

            $result = ImageHelper::compressExistingFile($file, $fileMaxWidth, $quality);

            if ($result) {
                // Check if PNG was converted to JPG
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                $checkFile = $extension === 'png'
                    ? preg_replace('/\.png$/i', '.jpg', $file)
                    : $file;

                $sizeAfter = file_exists($checkFile) ? filesize($checkFile) : $sizeBefore;
                $totalAfter += $sizeAfter;
                $savings = $sizeBefore - $sizeAfter;
                $percent = $sizeBefore > 0 ? round(($savings / $sizeBefore) * 100) : 0;

                $this->info("  ✅ {$filename}: " . $this->formatSize($sizeBefore) . " → " . $this->formatSize($sizeAfter) . " (saved {$percent}%)");
                $compressed++;
            } else {
                $this->warn("  ⚠️  Failed to compress: {$filename}");
                $totalAfter += $sizeBefore;
            }
        }

        $this->newLine();
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info("  Total before: " . $this->formatSize($totalBefore));
        $this->info("  Total after:  " . $this->formatSize($totalAfter));

        $totalSaved = $totalBefore - $totalAfter;
        $totalPercent = $totalBefore > 0 ? round(($totalSaved / $totalBefore) * 100) : 0;
        $this->info("  Saved:        " . $this->formatSize($totalSaved) . " ({$totalPercent}%)");
        $this->info("  Compressed:   {$compressed} of " . count($files) . " files");
        $this->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');

        return 0;
    }

    private function formatSize(int $bytes): string
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 1) . ' MB';
        }
        return round($bytes / 1024, 1) . ' KB';
    }
}
