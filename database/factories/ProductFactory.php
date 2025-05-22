<?php  

namespace Database\Factories;  

use Illuminate\Database\Eloquent\Factories\Factory;  

/**  
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>  
     */  
    class ProductFactory extends Factory  
    {  
        /**  
         * Define the model's default state.  
         *  
         * @return array<string, mixed>  
         */  
        public function definition(): array  
        {  
            // Clothing products for each category
            $products = [
                // Men's Clothing
                [
                    'name' => 'Classic White T-Shirt',
                    'description' => 'A timeless crew neck t-shirt made from 100% organic cotton. Soft, breathable, and perfect for everyday wear.',
                    'price' => 19.99,
                    'stock_quantity' => 120,
                    'category' => "Men's Clothing",
                    'image_url' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'Slim Fit Jeans',
                    'description' => 'Modern slim-fit jeans with a hint of stretch for comfort. Medium wash, 5-pocket style.',
                    'price' => 49.99,
                    'stock_quantity' => 80,
                    'category' => "Men's Clothing",
                    'image_url' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'Lightweight Hoodie',
                    'description' => 'A lightweight pullover hoodie, perfect for layering in any season.',
                    'price' => 34.99,
                    'stock_quantity' => 60,
                    'category' => "Men's Clothing",
                    'image_url' => 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=400&q=80',
                ],
                // Women's Clothing
                [
                    'name' => 'Floral Summer Dress',
                    'description' => 'A breezy, knee-length dress with a vibrant floral print. Features a fitted waist and flowy skirt.',
                    'price' => 39.99,
                    'stock_quantity' => 70,
                    'category' => "Women's Clothing",
                    'image_url' => 'https://images.unsplash.com/photo-1514995669114-d1c1b7a83a48?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'High-Waisted Leggings',
                    'description' => 'Ultra-soft, high-waisted leggings for yoga, workouts, or lounging.',
                    'price' => 24.99,
                    'stock_quantity' => 100,
                    'category' => "Women's Clothing",
                    'image_url' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'Denim Jacket',
                    'description' => 'A classic denim jacket with a relaxed fit and button-front closure.',
                    'price' => 59.99,
                    'stock_quantity' => 40,
                    'category' => "Women's Clothing",
                    'image_url' => 'https://images.unsplash.com/photo-1469398715555-76331a6c7c9b?auto=format&fit=crop&w=400&q=80',
                ],
                // Kids' Clothing
                [
                    'name' => 'Kids Graphic Tee',
                    'description' => 'Fun and colorful graphic t-shirt for kids, made from soft cotton.',
                    'price' => 14.99,
                    'stock_quantity' => 90,
                    'category' => "Kids' Clothing",
                    'image_url' => 'https://images.unsplash.com/photo-1503457574465-494bba506e52?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'Boys Cargo Shorts',
                    'description' => 'Durable cargo shorts with multiple pockets, perfect for playtime.',
                    'price' => 21.99,
                    'stock_quantity' => 60,
                    'category' => "Kids' Clothing",
                    'image_url' => 'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'Girls Ruffle Dress',
                    'description' => 'Adorable ruffle dress for girls, made from lightweight, breathable fabric.',
                    'price' => 27.99,
                    'stock_quantity' => 50,
                    'category' => "Kids' Clothing",
                    'image_url' => 'https://images.unsplash.com/photo-1519864600265-abb23847ef2c?auto=format&fit=crop&w=400&q=80',
                ],
                // Accessories
                [
                    'name' => 'Unisex Baseball Cap',
                    'description' => 'Adjustable cotton baseball cap, available in multiple colors.',
                    'price' => 12.99,
                    'stock_quantity' => 110,
                    'category' => 'Accessories',
                    'image_url' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'Wool Scarf',
                    'description' => 'Soft wool scarf to keep you warm and stylish in colder months.',
                    'price' => 22.99,
                    'stock_quantity' => 75,
                    'category' => 'Accessories',
                    'image_url' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'Leather Belt',
                    'description' => 'Genuine leather belt with a classic buckle, suitable for any outfit.',
                    'price' => 29.99,
                    'stock_quantity' => 65,
                    'category' => 'Accessories',
                    'image_url' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=400&q=80',
                ],
                // Sportswear
                [
                    'name' => 'Performance Running Shorts',
                    'description' => 'Lightweight, moisture-wicking shorts designed for running and training.',
                    'price' => 27.99,
                    'stock_quantity' => 70,
                    'category' => 'Sportswear',
                    'image_url' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'Moisture-Wick Gym Tee',
                    'description' => 'Breathable athletic t-shirt for high-intensity workouts.',
                    'price' => 21.99,
                    'stock_quantity' => 90,
                    'category' => 'Sportswear',
                    'image_url' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=400&q=80',
                ],
                // Footwear
                [
                    'name' => 'Classic White Sneakers',
                    'description' => 'Versatile white sneakers that pair with any outfit.',
                    'price' => 54.99,
                    'stock_quantity' => 100,
                    'category' => 'Footwear',
                    'image_url' => 'https://images.unsplash.com/photo-1519864600265-abb23847ef2c?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'Leather Chelsea Boots',
                    'description' => 'Premium leather boots with elastic side panels for easy wear.',
                    'price' => 89.99,
                    'stock_quantity' => 40,
                    'category' => 'Footwear',
                    'image_url' => 'https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=400&q=80',
                ],
                // Outerwear
                [
                    'name' => 'Puffer Jacket',
                    'description' => 'Warm, insulated puffer jacket for cold weather.',
                    'price' => 79.99,
                    'stock_quantity' => 35,
                    'category' => 'Outerwear',
                    'image_url' => 'https://images.unsplash.com/photo-1469398715555-76331a6c7c9b?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'Raincoat',
                    'description' => 'Waterproof raincoat with adjustable hood and pockets.',
                    'price' => 49.99,
                    'stock_quantity' => 50,
                    'category' => 'Outerwear',
                    'image_url' => 'https://images.unsplash.com/photo-1503342217505-b0a15ec3261c?auto=format&fit=crop&w=400&q=80',
                ],
                // Loungewear
                [
                    'name' => 'Fleece Joggers',
                    'description' => 'Super-soft fleece joggers for relaxing at home or casual outings.',
                    'price' => 29.99,
                    'stock_quantity' => 60,
                    'category' => 'Loungewear',
                    'image_url' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'Cotton Lounge Set',
                    'description' => 'Matching cotton lounge top and pants for ultimate comfort.',
                    'price' => 39.99,
                    'stock_quantity' => 45,
                    'category' => 'Loungewear',
                    'image_url' => 'https://images.unsplash.com/photo-1514995669114-d1c1b7a83a48?auto=format&fit=crop&w=400&q=80',
                ],
                // Formalwear
                [
                    'name' => 'Slim Fit Blazer',
                    'description' => 'Tailored slim-fit blazer for business or formal occasions.',
                    'price' => 119.99,
                    'stock_quantity' => 25,
                    'category' => 'Formalwear',
                    'image_url' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80',
                ],
                [
                    'name' => 'Pleated Midi Skirt',
                    'description' => 'Elegant pleated skirt, perfect for office or evening wear.',
                    'price' => 44.99,
                    'stock_quantity' => 30,
                    'category' => 'Formalwear',
                    'image_url' => 'https://images.unsplash.com/photo-1503457574465-494bba506e52?auto=format&fit=crop&w=400&q=80',
                ],
            ];
            return fake()->randomElement($products);
        }  
    }