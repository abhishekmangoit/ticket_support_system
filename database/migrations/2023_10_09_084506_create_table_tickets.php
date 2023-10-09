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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('priority')->default('0');
            $table->text('details');
            $table->bigInteger('category_id');
            $table->bigInteger('user_id');
            $table->bigInteger('agent_id');
            $table->bigInteger('awaited_from');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
