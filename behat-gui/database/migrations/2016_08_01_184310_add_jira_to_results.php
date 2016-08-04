<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJiraToResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tests_results', function (Blueprint $table) {
            $table->string('jira_id')->nullable();
            $table->string('jira_key')->nullable();
            $table->string('jira_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tests_results', function (Blueprint $table) {
            $table->dropColumn(['jira_id', 'jira_key', 'jira_url']);
        });
    }
}
