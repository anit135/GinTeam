<?php namespace FabricioRabelo\Contact\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateLogsTable extends Migration {

    public function up() {
        if (!Schema::hasTable('fr_contact_logs')) {
            Schema::create('fr_contact_logs', function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->integer('template_id')->unsigned();
                $table->string('sender_agent')->nullable();
                $table->string('sender_ip')->nullable();
                $table->datetime('sent_at'); //timestamp('sent_at');
                $table->longText('data')->nullable();
                $table->timestamps();
                $table->foreign('template_id')->references('id')->on('fr_contact_templates')->onDelete('no action');;
            });
        }
    }

    public function down() {
        if (Schema::hasTable('fr_contact_logs')) {
            Schema::drop('fr_contact_logs');
        }
    }
}
