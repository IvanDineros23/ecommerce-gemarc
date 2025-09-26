<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CleanUnusedProductImages extends Command
{
    protected $signature = 'products:clean-images';
    protected $description = 'Delete product images in storage/products/ not referenced in the product_images table.';

    public function handle()
    {
        $this->info('Scanning for unused product images...');
        $disk = Storage::disk('public');
        $folder = 'products';
        $allFiles = collect($disk->files($folder));
        $referenced = DB::table('product_images')->pluck('path')->map(function($p) use ($folder) {
            return ltrim($p, '/');
        });
        $unused = $allFiles->filter(function($file) use ($referenced) {
            return !$referenced->contains($file);
        });
        if ($unused->isEmpty()) {
            $this->info('No unused images found.');
            return 0;
        }
        foreach ($unused as $file) {
            $disk->delete($file);
            $this->line("Deleted: $file");
        }
        $this->info('Cleanup complete.');
        return 0;
    }
}
