<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
//            name (string)
//email (string, unique)
//email_verified_at (timestamp, nullable)
//password (string)
//is_librarian (boolean, default:false)
//remember_token
//timestamps (created_at, updated_at)
            $table->id();
            $table->string('name', 100);
            $table ->string('email', 100);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);
            $table->boolean('is_librarian')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
