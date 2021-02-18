<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PostCommentLikeUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('text',500);
            $table->timestamps();
            $table->foreignId('user_id')->constrained();
            $table->binary('image');

        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('text',240);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('post_id')->constrained();
            $table->timestamps();
        });


        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('post_id')->constrained();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->binary('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('likes');
        Schema::dropIfExists('comments');
        Schema::dropIfExists('posts');
        if (Schema::hasColumn('users','image')){
             Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('image');
            });
        }
       
       
        

    }
}
