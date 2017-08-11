<?php namespace ArrizalAmin\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateArrizalaminPortfolioItems extends Migration
{
    public function up()
    {
        Schema::table('arrizalamin_portfolio_items', function($table)
        {
            $table->string('short_description', 100)->nullable();
            $table->timestamp('published_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('arrizalamin_portfolio_items', function($table)
        {
            $table->dropColumn('short_description');
            $table->dropColumn('published_at');
        });
    }
}
