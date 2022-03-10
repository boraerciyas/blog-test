<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('parent_comment_id')->nullable();
            $table->unsignedInteger('level')->default(0);
            $table->integer('commentable_id')->unsigned();
            $table->string('commentable_type');
            $table->string('user_name');
            $table->string('user_email')->nullable();
            $table->text('content');
            $table->timestamps();
            $table->boolean('status')->default(true);

            // $table->foreign('post_id')->on('posts')->references('id');
            // $table->foreign('parent_comment_id')->on('comments')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
}
