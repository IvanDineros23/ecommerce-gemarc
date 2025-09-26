<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CreateDemoProductsSeeder extends Seeder
{
    public function run()
    {
        // Demo products for Gemarc MVP
        $products = [
            [
                'name' => 'Gemarc Ballpen',
                'sku' => 'GEM-BP-001',
                'slug' => 'gemarc-ballpen',
                'description' => 'A high-quality ballpen from Gemarc.',
                'stock_qty' => 100,
                'unit_price' => 25.00,
                'is_active' => 1,
            ],
            [
                'name' => 'Gemarc Notebook',
                'sku' => 'GEM-NB-001',
                'slug' => 'gemarc-notebook',
                'description' => 'A durable notebook for everyday use.',
                'stock_qty' => 50,
                'unit_price' => 80.00,
                'is_active' => 1,
            ],
        ];

        foreach ($products as $product) {
            $p = DB::table('products')->updateOrInsert(
                ['sku' => $product['sku']],
                array_merge($product, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ])
            );
        }

        // Attach demo images
        $productIds = DB::table('products')->pluck('id', 'sku');
        $images = [
            [
                'product_sku' => 'GEM-BP-001',
                'path' => 'images/products/ballpen.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
            ],
            [
                'product_sku' => 'GEM-NB-001',
                'path' => 'images/products/notebook.jpg',
                'is_primary' => 1,
                'sort_order' => 1,
            ],
        ];
        foreach ($images as $img) {
            $productId = $productIds[$img['product_sku']] ?? null;
            if ($productId) {
                DB::table('product_images')->updateOrInsert(
                    [
                        'product_id' => $productId,
                        'path' => $img['path'],
                    ],
                    [
                        'is_primary' => $img['is_primary'],
                        'sort_order' => $img['sort_order'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]
                );
            }
        }
        echo "Demo products and images seeded!\n";
    }
}
