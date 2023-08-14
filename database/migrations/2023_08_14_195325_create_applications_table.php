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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedInteger('number_of_participants');
            $table->text('attachment')->nullable();
            $table->string('conference_services');
            $table->string('name');
            $table->string('from');
            $table->text('purpose');
            $table->string('hours');
            $table->enum('type', ['internal', 'external']); // 'internal' or 'external'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
