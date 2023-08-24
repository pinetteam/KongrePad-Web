<?php

namespace Database\Seeders;

use App\Models\Meeting\Hall\Screen\Screen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ScreenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Screen::insert([
            [
                'hall_id' => '5',
                'code' => Str::uuid()->toString(),
                'title' => 'Chair 1 Screen',
                'description' => 'Chair 1 Screen',
                'type' => 'chair',
                'status' => 1,
            ],
            [
                'hall_id' => '5',
                'code' => Str::uuid()->toString(),
                'title' => 'Chair 2 Screen',
                'description' => 'Chair 2 Screen',
                'type' => 'chair',
                'status' => 1,
            ],
            [
                'hall_id' => '5',
                'code' => Str::uuid()->toString(),
                'title' => 'Chair 3 Screen',
                'description' => 'Chair 3 Screen',
                'type' => 'chair',
                'status' => 1,
            ],
            [
                'hall_id' => '5',
                'code' => Str::uuid()->toString(),
                'title' => 'Document Screen',
                'description' => 'Document Screen',
                'type' => 'document',
                'status' => 1,
            ],
            [
                'hall_id' => '5',
                'code' => Str::uuid()->toString(),
                'title' => 'Questions Screen',
                'description' => 'Questions Screen',
                'type' => 'questions',
                'status' => 1,
            ],
            [
                'hall_id' => '5',
                'code' => Str::uuid()->toString(),
                'title' => 'Speaker Screen',
                'description' => 'Speaker Screen',
                'type' => 'speaker',
                'status' => 1,
            ],
        ]);
    }
}