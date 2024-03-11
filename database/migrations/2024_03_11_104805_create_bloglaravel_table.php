<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ARTICLES', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('title');
            $table->text('content');
            $table->dateTime('date_created');
            $table->integer('USERS_id')->index('articles_users');
        });

        Schema::create('COMMENTS', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('content');
            $table->integer('ARTICLES_id')->index('articles_comments');
            $table->integer('USERS_id')->index('users_comments');
        });

        Schema::create('USERS', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('email');
        });

        Schema::create('USERS_USERS', function (Blueprint $table) {
            $table->integer('USERS_id1');
            $table->integer('USERS_id2')->index('users_users_users_2');

            $table->primary(['USERS_id1', 'USERS_id2']);
        });

        Schema::table('ARTICLES', function (Blueprint $table) {
            $table->foreign(['USERS_id'], 'ARTICLES_USERS')->references(['id'])->on('USERS')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('COMMENTS', function (Blueprint $table) {
            $table->foreign(['ARTICLES_id'], 'ARTICLES_COMMENTS')->references(['id'])->on('ARTICLES')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['USERS_id'], 'USERS_COMMENTS')->references(['id'])->on('USERS')->onUpdate('no action')->onDelete('cascade');
        });

        Schema::table('USERS_USERS', function (Blueprint $table) {
            $table->foreign(['USERS_id1'], 'USERS_USERS_USERS')->references(['id'])->on('USERS')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['USERS_id2'], 'USERS_USERS_USERS_2')->references(['id'])->on('USERS')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('USERS_USERS', function (Blueprint $table) {
            $table->dropForeign('USERS_USERS_USERS');
            $table->dropForeign('USERS_USERS_USERS_2');
        });

        Schema::table('COMMENTS', function (Blueprint $table) {
            $table->dropForeign('ARTICLES_COMMENTS');
            $table->dropForeign('USERS_COMMENTS');
        });

        Schema::table('ARTICLES', function (Blueprint $table) {
            $table->dropForeign('ARTICLES_USERS');
        });

        Schema::dropIfExists('USERS_USERS');

        Schema::dropIfExists('USERS');

        Schema::dropIfExists('COMMENTS');

        Schema::dropIfExists('ARTICLES');
    }
};
