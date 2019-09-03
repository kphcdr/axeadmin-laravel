<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAxeAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('axe_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->integer('group_id');
            $table->boolean('is_use')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('axe_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url')->nullable();
            $table->unsignedTinyInteger('type')->comment('1 目录 2 链接 3 外部链接');
            $table->boolean('is_use');
            $table->tinyInteger('sort');
            $table->string('icon')->nullable();
            $table->unsignedInteger('parent_id')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('axe_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('code', 60);
            $table->text('rules');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('axe_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->string('desc', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('axe_group_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id');
            $table->integer('role_id');
            $table->timestamps();
        });

        Schema::create('axe_operation_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id');
            $table->string('method');
            $table->string('url');
            $table->text('extra_data')->nullable();
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
        Schema::dropIfExists('axe_admins');
        Schema::dropIfExists('axe_menus');
        Schema::dropIfExists('axe_roles');
        Schema::dropIfExists('axe_groups');
        Schema::dropIfExists('axe_group_roles');
        Schema::dropIfExists('axe_operation_logs');
    }
}
