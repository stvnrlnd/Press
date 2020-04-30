<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('identifier')->index();
            $table->string('slug')->unique()->index();
            $table->string('title');
            // $table->text('description');
            $table->text('body');
            $table->text('extra');
            $table->timestamps();

            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
