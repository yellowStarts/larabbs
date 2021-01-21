<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name' => '分享',
                'description' => '分享创作，分享发现',
            ],
            [
                'name' => '教程',
                'description' => '开发技巧、开发笔记',
            ],
            [
                'name' => '随想',
                'description' => '因上努力，果上随缘',
            ],
            [
                'name'        => '问答',
                'description' => '保持友善，互帮互助',
            ],
            [
                'name'        => '公告',
                'description' => '站点通知，奔走相告',
            ],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
