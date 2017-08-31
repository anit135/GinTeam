<?php namespace FabricioRabelo\Contact\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateTemplateRecipientsTable extends Migration
{

    public function up()
    {

        // Install templates table
        if ( !Schema::hasTable('fr_contact_templates_recipients') )
        {
            Schema::create('fr_contact_templates_recipients', function($table)
            {
                $table->engine = 'InnoDB';
                $table->integer('template_id')->unsigned();
                $table->integer('recipient_id')->unsigned();
                $table->primary(['template_id', 'recipient_id']);
            });
        }
    }

    public function down()
    {
        // Drop fr_contact_templates_recipients table
        if ( Schema::hasTable('fr_contact_templates_recipients') )
        {
            Schema::drop('fr_contact_templates_recipients');
        }
    }

}
