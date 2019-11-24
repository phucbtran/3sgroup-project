<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSlidesTable.
 */
class CreateSlidesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('slides', function(Blueprint $table) {
            $table->increments('id');
            $table->string('alt_description', 500)->nullable(true);
            $table->string('img_dir_path', 1024);
            $table->integer('sort_num');
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
		Schema::drop('slides');
	}
}
