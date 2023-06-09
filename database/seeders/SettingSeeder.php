<?php

namespace Database\Seeders;

use App\Models\Customer\Setting\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            [
                'customer_id' => '1',
                'variable_id' => '1',
                'value' => 'Y-m-d',
            ],
            [
                'customer_id' => '1',
                'variable_id' => '2',
                'value' => 'H:i',
            ],
            [
                'customer_id' => '1',
                'variable_id' => '3',
                'value' => 'Turkey (UTC+02:00)',
            ],
            [
                'customer_id' => '1',
                'variable_id' => '4',
                'value' => 'İçerenköy Mah. Çayır Cad. No:5 Bay Plaza Kat:12 Ataşehir İstanbul',
            ],
            [
                'customer_id' => '1',
                'variable_id' => '5',
                'value' => 'deneme',
            ],
            [
                'customer_id' => '1',
                'variable_id' => '6',
                'value' => 'deneme2',
            ],
            [
                'customer_id' => '2',
                'variable_id' => '1',
                'value' => 'Y-m-d',
            ],
            [
                'customer_id' => '2',
                'variable_id' => '2',
                'value' => 'H:i',
            ],
            [
                'customer_id' => '2',
                'variable_id' => '3',
                'value' => 'Turkey (UTC+02:00)',
            ],
            [
                'customer_id' => '2',
                'variable_id' => '4',
                'value' => 'İçerenköy Mah. Çayır Cad. No:5 Bay Plaza Kat:12 Ataşehir İstanbul',
            ],
            [
                'customer_id' => '2',
                'variable_id' => '5',
                'value' => 'deneme',
            ],
            [
                'customer_id' => '2',
                'variable_id' => '6',
                'value' => 'deneme2',
            ]
        ]);

    }
}
