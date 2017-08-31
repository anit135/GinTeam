<?php namespace FabricioRabelo\Contact\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateTables extends Migration {

    public function up() {
        // Install templates table
        if (!Schema::hasTable('fr_contact_templates')) {
            Schema::create('fr_contact_templates', function ($table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('title')->unique();
                $table->string('slug')->index()->unique();
                $table->string('subject')->nullable();
                $table->string('filename')->index()->unique();
                $table->boolean('autoresponse')->default(1);
                $table->text('content')->nullable();
                $table->text('content_html')->nullable();
                $table->text('fields')->nullable();
                $table->string('sender_name')->nullable();
                $table->string('sender_email')->nullable();
                $table->string('recipient_name')->nullable();
                $table->string('recipient_email')->nullable();
                $table->text('confirmation_text')->nullable();
                $table->boolean('multiple_recipients')->nullable()->default(0);
                $table->boolean('spam')->nullable()->default(0);
                $table->string('recaptcha_publickey')->nullable();
                $table->string('recaptcha_secretkey')->nullable();
                $table->string('recaptcha_lang')->nullable()->default('en');
                $table->string('recaptcha_theme')->nullable()->default('light');
                $table->timestamps();
            });
        }
    }

    public function down() {
        // Drop templates table
        if (Schema::hasTable('fr_contact_templates')) {
            Schema::drop('fr_contact_templates');
        }
    }
}
