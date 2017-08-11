<?php namespace ArrizalAmin\Portfolio\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateArrizalaminPortfolioItems2 extends Migration
{
    public function up()
    {
        Schema::table('arrizalamin_portfolio_items', function($table)
        {
            $table->integer('category_id')->default(1)->change();
        });
    }
    
    public function down()
    {
        Schema::table('arrizalamin_portfolio_items', function($table)
        {
            $table->integer('category_id')->default(null)->change();
        });
    }
}
