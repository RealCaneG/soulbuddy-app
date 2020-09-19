<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounsellingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counselling_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('maker_id');
            $table->unsignedInteger('solver_id')->nullable();
            $table->integer('category_id');
            $table->date('expiry_date');
            $table->string('subject');
            $table->text('description');
            $table->boolean('is_closed')->default(false);
            $table->timestamp('time_solved')->nullable();
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
        Schema::dropIfExists('counselling_requests');
    }
}
