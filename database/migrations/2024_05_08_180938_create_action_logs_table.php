<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionLogsTable extends Migration
{
    public function up()
    {
        Schema::create('action_logs', function (Blueprint $table) {
            $table->id();
            
            $table->string('action');
            $table->ipAddress('ip');
            $table->timestamp('timestamp')->nullable();
            
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('action_logs');
    }
}
