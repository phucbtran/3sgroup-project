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
            $table->string('address', 500);
            $table->string('email', 500);
            $table->string('phone', 15);
            $table->string('skype', 500)->nullable(true);
            $table->string('facebook', 1024)->nullable(true);
            $table->string('map_api', 500)->nullable(true);

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
