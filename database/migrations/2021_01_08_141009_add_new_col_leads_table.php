<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leads', function (Blueprint $table) {
        
            $table->string('op_client_first_name')->nullable()->after('last_name');
            $table->string('op_client_last_name')->nullable()->after('op_client_first_name');
            $table->string('dealer_name')->nullable()->after('email');
            $table->string('trans_type')->nullable()->after('trans_status');
            $table->longText('trans_status_extra')->nullable()->after('trans_type');
            $table->text('payment_type_extra')->nullable()->after('payment_type');
            $table->dropColumn(['trans_issue']);
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
            $table->dropColumn([
                'op_client_first_name',
                'op_client_last_name',
                'dealer_name',
                'payment_type_extra',
                'trans_status_extra',
                'trans_type'
            ]);
            $table->text('trans_issue')->nullable()->after('special_note');
        });
    }
}
