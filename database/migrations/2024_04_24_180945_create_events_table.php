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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_id');
            $table->string('admin_id');

            $table->string('name');
            $table->text('event_avatar')->nullable();
            $table->text('description',1000);
            $table->string('category');

            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');

            $table->string('location');
            $table->json('members')->nullable();
            $table->string('number_of_members');

            $table->string('price');
            $table->boolean('cancel_event');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
