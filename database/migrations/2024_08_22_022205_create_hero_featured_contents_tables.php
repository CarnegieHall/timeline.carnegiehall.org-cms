<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('hero_featured_contents', function (Blueprint $table) {
            // this will create an id, a "published" column, and soft delete and timestamps columns
            createDefaultTableFields($table);

            // feel free to modify the name of this column, but title is supported by default (you would need to specify the name of the column Twill should consider as your "title" column in your module controller if you change it)
            $table->string('title', 200)->nullable();
            $table->string('subtitle', 200)->nullable();
            $table->bigInteger('related_content_id')->nullable();
            $table->string('related_content_type')->nullable();
            $table->string('main_color', 10)->nullable();
            $table->integer('position')->unsigned()->nullable();
            // link to homepage
            $table->foreignId('homepage_id')
                ->unsigned()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // add those 2 columns to enable publication timeframe fields (you can use publish_start_date only if you don't need to provide the ability to specify an end date)
            // $table->timestamp('publish_start_date')->nullable();
            // $table->timestamp('publish_end_date')->nullable();
        });

        Schema::create('hero_featured_content_revisions', function (Blueprint $table) {
            createDefaultRevisionsTableFields($table, 'hero_featured_content');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hero_featured_content_revisions');
        Schema::dropIfExists('hero_featured_contents');
    }
};
