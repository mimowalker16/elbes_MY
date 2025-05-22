<?php  

namespace Database\Seeders;  

use Illuminate\Database\Console\Seeds\WithoutModelEvents;  
use Illuminate\Database\Seeder;  
use App\Models\Product;  

class ProductSeeder extends Seeder  
{  
    /**  
         * Run the database seeds.  
         */  
        public function run(): void  
        {  
            // Get the unique products array from the factory
            $factory = new \Database\Factories\ProductFactory();
            $reflection = new \ReflectionClass($factory);
            $method = $reflection->getMethod('definition');
            $method->setAccessible(true);
            $products = $reflection->getDefaultProperties()['products'] ?? null;
            if (!$products) {
                // fallback: call definition() repeatedly to collect all unique products
                $seen = [];
                $products = [];
                for ($i = 0; $i < 20; $i++) {
                    $prod = $factory->definition();
                    if (!in_array($prod['name'], $seen)) {
                        $products[] = $prod;
                        $seen[] = $prod['name'];
                    }
                }
            }
            foreach ($products as $product) {
                Product::create($product);
            }
        }  
    }