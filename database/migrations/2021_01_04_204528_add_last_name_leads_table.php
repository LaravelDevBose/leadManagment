<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLastNameLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->renameColumn('full_name', 'first_name');
            $table->string('last_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->renameColumn('first_name', 'full_name');
            $table->string('last_name')->nullable();
        });
    }
}
