<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCooperationsTable.
 */
class CreateCooperationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cooperations', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title_name', 500);
            $table->string('slug', 1024);
            $table->string('img_dir_path', 1024);
            $table->string('meta_title', 500);
            $table->text('content');
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
		Schema::drop('cooperations');
	}
}
