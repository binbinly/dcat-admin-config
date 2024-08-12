<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

 class CreateConfigTable extends Migration
{
    public function getConnection()
    {
        return config('admin.database.connection') ?: config('database.default');
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('admin_config_group')) {
            Schema::create('admin_config_group', function (Blueprint $table) {
                $table->bigIncrements('id')->unsigned();
                $table->integer('pid')->comment('上级id');
                $table->string('name')->comment('分组名');
                $table->string('key', 30)->comment('键');
                $table->string('desc')->comment('描述');
                $table->tinyInteger('is_open')->comment('是否开启');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('admin_config')) {
            Schema::create('admin_config', function (Blueprint $table) {
                $table->bigIncrements('id')->unsigned();
                $table->integer('group_id')->comment('所属分组id');
                $table->string('name')->comment('配置名');
                $table->string('key', 30)->comment('键');
                $table->tinyInteger('type')->comment('类型');
                $table->string('rules')->comment('值规则');
                $table->string('desc')->comment('描述');
                $table->smallInteger('sort')->comment('排序');
                $table->tinyInteger('is_open')->comment('是否开启');
                $table->tinyInteger('is_required')->comment('是否必填');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('admin_config_value')) {
            Schema::create('admin_config_value', function (Blueprint $table) {
                $table->bigIncrements('id')->unsigned();
                $table->string('key', 30)->unique()->comment('键');
                $table->string('value', 5000)->comment('值');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_config_group');
        Schema::dropIfExists('admin_config');
        Schema::dropIfExists('admin_config_value');
    }
};
