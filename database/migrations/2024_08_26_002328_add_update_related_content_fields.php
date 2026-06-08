<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */

    function getTables(): array
    {
        return [
            'hero_featured_contents',
            'hero_featured_content_revisions',
            'linked_contents',
        ];
    }
    private $dropColumns = [
        'related_content_id',
        'related_content_type',
    ];
    private $addColumns = [
        'related_page_id',
        'related_page_type',
        'related_story_id',
        'related_story_type',
        'related_genre_id',
        'related_genre_type',
        'related_notablePerformer_id',
        'related_notablePerformer_type',
        'external_link',
        'destination',

    ];
    public function up()
    {

        $tables = $this->getTables();
        foreach ($tables as $table) {
            foreach ($this->dropColumns as $column) {
                if (Schema::hasColumn($table, $column)) {
                    Schema::table($table, function (Blueprint $table) use ($column) {
                        $table->dropColumn($column);
                    });
                }
            }
            foreach ($this->addColumns as $column) {
                if (Schema::hasColumn($table, $column) == false) {
                    Schema::table($table, function (Blueprint $table) use ($column) {
                        if (str_contains($column, "id")) {
                            $table->bigInteger($column)->nullable();
                        } else {
                            $table->string($column)->nullable();
                        }

                    });
                }
            }

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = $this->getTables();
        foreach ($tables as $table) {

            foreach ($this->dropColumns as $column) {
                if (Schema::hasColumn($table, $column)) {
                    Schema::table($table, function (Blueprint $table) use ($column) {
                        if (str_contains($column, "id")) {
                            $table->bigInteger($column)->nullable();
                        } else {
                            $table->string($column)->nullable();
                        }
                    });
                }
            }
            foreach ($this->addColumns as $column) {
                if (Schema::hasColumn($table, $column)) {
                    Schema::table($table, function (Blueprint $table) use ($column) {
                        $table->dropColumn($column);
                    });
                }
            }

        }

    }
};
