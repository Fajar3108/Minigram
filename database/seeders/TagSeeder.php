<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            'Games', 'Web Development', 'Game Development', 'Programming', 'Design', 'Movie', '3D Modelling'
        ];

        $tags = [];
        foreach($datas as $data){
            $tags[] = [
                'name' => $data,
                'slug' => Str::slug($data),
            ];
        }

        DB::table('tags')->insert($tags);
    }
}
