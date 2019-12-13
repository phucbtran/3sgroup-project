<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCompaniesTable.
 */
class CreateCompaniesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table) {
            $table->increments('id');
            $table->string('logo_dir_path', 1024);
            // contact
            $table->string('address', 500);
            $table->string('email', 500);
            $table->string('phone', 50);
            $table->string('skype', 500)->nullable(true);
            $table->string('facebook', 1024)->nullable(true);
            $table->string('map_api', 1024)->nullable(true);
            // basic introduce
            $table->text('head_description');
            $table->text('detail_description');
            $table->string('img_detail_dir_path', 1024);
            // history
            $table->date('time_event');
            $table->string('img_event_dir_path', 1024);
            $table->string('title_event', 500);
            // mission - vision
            $table->text('vision');
            $table->text('mission');
            $table->text('core_value');

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
		Schema::drop('companies');
	}
}
