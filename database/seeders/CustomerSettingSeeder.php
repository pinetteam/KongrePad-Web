<?php

namespace Database\Seeders;

use App\Models\Customer\Setting\Setting;
use Illuminate\Database\Seeder;

class CustomerSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::insert([
            [
                'customer_id' => '1',
                'variable_id' => '1',
                'value' => 'https://www.devent.com.tr/',
            ],
            [
                'customer_id' => '1',
                'variable_id' => '2',
                'value' => 'info@devent.com.tr',
            ],
            [
                'customer_id' => '1',
                'variable_id' => '3',
                'value' => '+90 (312) 438 1039',
            ],
            [
                'customer_id' => '1',
                'variable_id' => '4',
                'value' => 'Güzeltepe, Özvatan Sokağı No: 38/3, 06690 Çankaya/Ankara',
            ],

            [
                'customer_id' => '1',
                'variable_id' => '5',
                'value' => 'Europe/Istanbul',
            ],
            [
                'customer_id' => '1',
                'variable_id' => '6',
                'value' => 'Y-m-d',
            ],
            [
                'customer_id' => '1',
                'variable_id' => '7',
                'value' => '24H',
            ],

            [
                'customer_id' => '1',
                'variable_id' => '8',
                'value' => 'https://www.facebook.com/deventsocial/',
            ],
            [
                'customer_id' => '1',
                'variable_id' => '9',
                'value' => 'https://www.instagram.com/deventsocial/',
            ],
            [
                'customer_id' => '1',
                'variable_id' => '10',
                'value' => 'https://twitter.com/deventsocial/',
            ],
            [
                'customer_id' => '3',
                'variable_id' => '1',
                'value' => 'https://www.educcon.com.tr/',
            ],
            [
                'customer_id' => '3',
                'variable_id' => '2',
                'value' => 'info@educcon.com.tr',
            ],
            [
                'customer_id' => '3',
                'variable_id' => '3',
                'value' => '+90 (555) 555 5555',
            ],
            [
                'customer_id' => '3',
                'variable_id' => '4',
                'value' => '',
            ],

            [
                'customer_id' => '3',
                'variable_id' => '5',
                'value' => 'Europe/Istanbul',
            ],
            [
                'customer_id' => '3',
                'variable_id' => '6',
                'value' => 'Y-m-d',
            ],
            [
                'customer_id' => '3',
                'variable_id' => '7',
                'value' => '24-h',
            ],

            [
                'customer_id' => '3',
                'variable_id' => '8',
                'value' => '',
            ],
            [
                'customer_id' => '3',
                'variable_id' => '9',
                'value' => '',
            ],
            [
                'customer_id' => '3',
                'variable_id' => '10',
                'value' => '',
            ],
            [
                'customer_id' => '4',
                'variable_id' => '1',
                'value' => 'https://www.test.com.tr/',
            ],
            [
                'customer_id' => '4',
                'variable_id' => '2',
                'value' => 'info@test.com.tr',
            ],
            [
                'customer_id' => '4',
                'variable_id' => '3',
                'value' => '+90 (555) 555 5555',
            ],
            [
                'customer_id' => '4',
                'variable_id' => '4',
                'value' => '',
            ],

            [
                'customer_id' => '4',
                'variable_id' => '5',
                'value' => 'Europe/Istanbul',
            ],
            [
                'customer_id' => '4',
                'variable_id' => '6',
                'value' => 'Y-m-d',
            ],
            [
                'customer_id' => '4',
                'variable_id' => '7',
                'value' => '24-h',
            ],

            [
                'customer_id' => '4',
                'variable_id' => '8',
                'value' => '',
            ],
            [
                'customer_id' => '4',
                'variable_id' => '9',
                'value' => '',
            ],
            [
                'customer_id' => '4',
                'variable_id' => '10',
                'value' => '',
            ],
        ]);
    }
}
