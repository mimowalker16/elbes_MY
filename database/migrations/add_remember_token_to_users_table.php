<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('elb_accounts')) {
            Schema::table('elb_accounts', function (Blueprint $table) {
                $table->rememberToken()->after('password')->nullable();
            });
        }
    }
    public function down(): void
    {
        if (Schema::hasTable('elb_accounts')) {
            Schema::table('elb_accounts', function (Blueprint $table) {
                $table->dropColumn('remember_token');
            });
        }
    }
};
