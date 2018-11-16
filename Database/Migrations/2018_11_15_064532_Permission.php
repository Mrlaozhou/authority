<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Permission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  权限表
        Schema::create( 'permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 300)->default('')->comment('便签');
            $table->string('operate', 300)->default('')->comment('操作');
            $table->string('guard', 30)->default('')->index()->comment('守卫');
            $table->string('type', 30)->default('')->comment('类型');
            $table->unsignedInteger('pid')->default(0)->comment('父级ID');

            $table->timestamps();
        } );
        //  部门权限-关联表
        Schema::create('department_has_permissions', function (Blueprint $table) {
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('permission_id');

            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments')
                  ->onDelete('cascade');

            $table->foreign('permission_id')
                  ->references('id')
                  ->on('permissions')
                  ->onDelete('cascade');

            $table->primary(['department_id', 'permission_id']);
        });
        //  成员-权限 关联表
        Schema::create('member_has_permissions', function (Blueprint $table) {
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('permission_id');

            $table->foreign('member_id')
                  ->references('id')
                  ->on('members')
                  ->onDelete('cascade');

            $table->foreign('permission_id')
                  ->references('id')
                  ->on('permissions')
                  ->onDelete('cascade');

            $table->primary(['member_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('department_has_permissions');
        //
        Schema::dropIfExists('member_has_permissions');
        //
        Schema::dropIfExists('permissions');
    }
}
