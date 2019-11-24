<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCommentsTable.
 */
class CreateCommentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
            $table->increments('id');
            $table->string('full_name', 500);
            $table->string('email', 500);
            $table->string('phone', 15)->nullable(true);
            $table->unsignedInteger('post_id');
            $table->string('type_cmt_flg');
            $table->string('content', 2000);
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
		Schema::drop('comments');
	}
}
