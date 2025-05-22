<?php  

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  

return new class extends Migration  
{  
    public function up(): void  
    {  
        Schema::create('elb_purchase_items', function (Blueprint $table) {  
            $table->id();  
            $table->foreignId('order_id')->constrained('elb_purchases')->onDelete('cascade'); // Delete item if order is deleted  
            $table->foreignId('product_id')->constrained('elb_items')->onDelete('cascade'); // Or set null/restrict depending on requirements  
            $table->integer('quantity');  
            $table->decimal('price', 10, 2); // Price per unit at the time of order  
            $table->timestamps();  

            // Optional: Prevent adding the same product twice to the same order  
            // $table->unique(['order_id', 'product_id']);  
        });  
    }  

    public function down(): void  
    {  
        Schema::dropIfExists('elb_purchase_items');  
    }  
};