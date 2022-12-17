<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('plays', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('number');
            $table->boolean('is_win')->default(false);
            $table->integer('price')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('plays');
    }
};
