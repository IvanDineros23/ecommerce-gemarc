<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CleanUnusedProductImages extends Command
{
    protected $signature = 'products:clean-unused-images';
    protected $description = 'Delete product images in storage/products/ not referenced in the product_images table.';

    public function handle()
    {
        $this->info('Scanning for unused product images...');
        $disk = Storage::disk('public');
        $folder = 'products';
        $allFiles = $disk->files($folder);
        $referenced = DB::table('product_images')->pluck('filename')->toArray();
        $deleted = 0;
        foreach ($allFiles as $file) {
            $basename = basename($file);
            if (!in_array($basename, $referenced)) {
                $disk->delete($file);
                $this->line("Deleted: $file");
                $deleted++;
            }
        }
        $this->info("Cleanup complete. $deleted unused images deleted.");
        return 0;
    }
}
