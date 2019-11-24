<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCategoriesTable.
 */
class CreateCategoriesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 500);
            $table->string('slug', 1024);
            $table->string('img_dir_path', 1024);
            $table->unsignedInteger('cat_parent_id');
            $table->foreign('cat_parent_id')->references('id')->on('categories');
            $table->integer('num_sort');
            $table->string('status', 1)->comment('0:Active | 1:Inactive');

            $table->softDeletes();
            $table->timestamps();
            $table->unsignedInteger('user_id')->nullable(true);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}
}
