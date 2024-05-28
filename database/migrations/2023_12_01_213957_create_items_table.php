<?php

use App\Models\Beer;
use App\Models\Container;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Beer::class)
                ->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Container::class)
                ->nullable()->constrained()->nullOnDelete();
            $table->timestamp('consumed_at')->nullable();
            $table->timestamp('expiration_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
