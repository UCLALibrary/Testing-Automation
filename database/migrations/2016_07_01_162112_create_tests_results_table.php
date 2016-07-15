<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsResultsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests_results', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('test_id');
            $table->text('result');
            $table->integer('success');
            $table->text('comment')->nullable();
            $table->integer('comment_complete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tests_results');
    }

}
