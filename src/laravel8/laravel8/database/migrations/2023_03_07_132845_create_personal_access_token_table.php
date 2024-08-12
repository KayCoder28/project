<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalAccessTokenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_access_token', function (Blueprint $table) {
            // `name`, `token`, `abilities`, `tokenable_id`, `tokenable_type`, `updated_at`, `created_at`)


            $table->id();
            $table->string('name');
            $table->string('token');
            $table->string('abilities');
            $table->string('tokenable_id');
            $table->string('tokenable_type');
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
        Schema::dropIfExists('personal_access_token');
    }
}
