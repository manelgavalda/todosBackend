<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            //positiu.
            //->nullable() perque no sigui necessari indicar el camp.
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('name');
            $table->boolean('done');
            $table->integer('priority');
            $table->timestamps();
            //$table->dropTimestamps(); //necessari "doctrine/dbal": "~2.3"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
