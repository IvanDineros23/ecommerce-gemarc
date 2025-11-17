<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'unit_price', 'stock', 'description', 'is_active'];


    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Relationship to order items for dashboard analytics
    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

    public function firstImagePath()
    {
        $img = $this->images()->orderBy('sort_order')->first();
        return $img ? $img->path : null;
    }

    /**
     * Attempt to discover a brochure / specsheet PDF for this product without a DB column.
     * Priority naming patterns:
     *  1. public/product-pdfs/{slug}.pdf
     *  2. public/product-pdfs/{id}.pdf
     *  3. public/product-pdfs/{sanitized-name}.pdf (spaces -> dashes, lowercase)
     * Returns full asset() URL if found, else null.
     */
    public function brochurePdfUrl(): ?string
    {
        $candidates = [];
        $slug = $this->slug ?? null;
        if ($slug) $candidates[] = public_path("product-pdfs/{$slug}.pdf");
        if ($this->id) $candidates[] = public_path("product-pdfs/{$this->id}.pdf");
        $sanitized = strtolower(preg_replace('/[^a-zA-Z0-9]+/','-', $this->name ?? '')); // collapse to dashes
        $sanitized = trim($sanitized,'-');
        if ($sanitized) $candidates[] = public_path("product-pdfs/{$sanitized}.pdf");

        foreach ($candidates as $path) {
            if (is_file($path)) {
                // Convert absolute path back to relative from public
                $rel = str_replace(public_path().'\\', '', $path); // Windows backslashes
                $rel = str_replace(public_path().'/', '', $rel); // *nix
                return asset($rel);
            }
        }
        return null;
    }
}
