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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('name', 5000)->nullable();
            $table->string('last_name');
            $table->string('url')->nullable();
            $table->string('company')->nullable();
            $table->string('postCode')->nullable();
            $table->string('country')->nullable();
            $table->string('website')->nullable();
            $table->string('birthday')->nullable();
            $table->string('profileImage')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->string('roles')->default('user');
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('location')->nullable();
            $table->string('sub_location')->nullable();
            $table->string('key')->nullable();
            $table->string('status')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('active_status')->default(false);
            $table->string('avatar')->default('avatar.png');
            $table->boolean('dark_mode')->default(false);
            $table->string('messenger_color')->nullable();
            $table->integer('electronics')->default(0);
            $table->integer('vehicles')->default(0);
            $table->integer('property')->default(0);
            $table->integer('home-garden')->default(0);
            $table->integer('animals')->default(0);
            $table->integer('services')->default(0);
            $table->integer('business-and-industry')->default(0);
            $table->integer('hobby-sports-and-kids')->default(0);
            $table->integer('fashion-and-beauty')->default(0);
            $table->integer('essentials')->default(0);
            $table->integer('education')->default(0);
            $table->integer('agriculture')->default(0);
            $table->integer('jobs')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
