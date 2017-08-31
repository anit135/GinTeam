<?php namespace FabricioRabelo\Contact\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateRecipientsTable extends Migration {

    public function up() {
        // Install fr_contact_recipients table
        if (!Schema::hasTable('fr_contact_recipients')) {
            Schema::create('fr_contact_recipients', function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('name');
                $table->string('email');
                $table->timestamps();
            });
        }
    }

    public function down() {
        // Drop fr_contact_recipients table
        if (Schema::hasTable('fr_contact_recipients')) {
            Schema::drop('fr_contact_recipients');
        }
    }

}
