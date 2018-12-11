<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //填充初始管理员 firstOrNew 与save()连用,有就更新没有就创建,且每次填充的时候
        //不会重复填充
        \App\Models\Admin::firstOrNew([
            'username'=>'admin'
        ])->fill(['password'=>bcrypt('admin888')])->save();
    }
}
