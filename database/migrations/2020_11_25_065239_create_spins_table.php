<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        Schema::create($tableNames['category_datas'], function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable();
            $table->timestamps();
        });
        Schema::create($tableNames['group_of_words'], function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('id_category')->nullable();
            $table->timestamps();
        });
        Schema::create($tableNames['spins'], function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable();
            $table->integer('id_category')->nullable();
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
        $tableNames = config('permission.table_names');
        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }
        
        Schema::drop($tableNames['spins']);
        Schema::drop($tableNames['category_datas']);
        Schema::drop($tableNames['group_of_words']);
    }
}
