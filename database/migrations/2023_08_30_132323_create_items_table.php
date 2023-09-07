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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('stock');
            $table->char('name');
            $table->string('serial_n')->nullable();
            $table->integer('price')->nullable();
            $table->date('calibration_date')->nullable();
            $table->string('part_number')->nullable();
            $table->string('comment')->nullable()->default(null);
            $table->string('image')->nullable()->default('http://www.onlylondon.properties/application/modules/themes/views/default/assets/images/image-placeholder.png');
            $table->timestamps();
            $table->unsignedBigInteger('system_id')->nullable();
            $table->foreign('system_id')->references('id')->on('systems');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items'); //drop table if exists
    }
};
