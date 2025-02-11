<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(with(new \App\Models\User)->getTable(), function (Blueprint $table) {
            $table->dropColumn('department');
            $table->unsignedBigInteger('department_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(with(new \App\Models\User)->getTable(), function (Blueprint $table) {
            $table->dropColumn('department_id');
            $table->string('department')->nullable();
        });
    }
};
