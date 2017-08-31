<?php namespace FabricioRabelo\Contact\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateStreamsTables extends Migration {

    public function up() {
        // Install fr_streams table
        if (!Schema::hasTable('fr_streams')) {
            Schema::create('fr_streams', function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('vendor')->index();
                $table->string('package')->index()->unique();
                $table->timestamps();
            });
        }
    }

    public function down() {
    }
}
