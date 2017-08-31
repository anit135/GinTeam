<?php namespace FabricioRabelo\Contact\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateCustomFieldsTables extends Migration
{

    public function up()
    {
        // Install fr_custom_fields table
        if ( !Schema::hasTable('fr_custom_fields') )
        {
            Schema::create('fr_custom_fields', function($table)
            {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('field_name')->index();
                $table->string('field_slug')->index()->unique();
                $table->string('field_type');
                $table->longText('field_data')->nullable();
                $table->boolean('is_locked')->default(0);
                $table->timestamps();
            });
        }
    }

    public function down()
    {
    }
}
