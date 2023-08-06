<?php

namespace Database\Seeders;

use App\Models\System\Setting\Variable\Variable;
use Illuminate\Database\Seeder;

class SystemSettingVariableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timezones = [
            'Europe/Amsterdam' => ['value' => 'Europe/Amsterdam', 'title' => 'Europe/Amsterdam'],
            'Europe/Andorra' => ['value' => 'Europe/Andorra', 'title' => 'Europe/Andorra'],
            'Europe/Astrakhan' => ['value' => 'Europe/Astrakhan', 'title' => 'Europe/Astrakhan'],
            'Europe/Athens' => ['value' => 'Europe/Athens', 'title' => 'Europe/Athens'],
            'Europe/Belgrade' => ['value' => 'Europe/Belgrade', 'title' => 'Europe/Belgrade'],
            'Europe/Berlin' => ['value' => 'Europe/Berlin', 'title' => 'Europe/Berlin'],
            'Europe/Bratislava' => ['value' => 'Europe/Bratislava', 'title' => 'Europe/Bratislava'],
            'Europe/Brussels' => ['value' => 'Europe/Brussels', 'title' => 'Europe/Brussels'],
            'Europe/Bucharest' => ['value' => 'Europe/Bucharest', 'title' => 'Europe/Bucharest'],
            'Europe/Budapest' => ['value' => 'Europe/Budapest', 'title' => 'Europe/Budapest'],
            'Europe/Busingen' => ['value' => 'Europe/Busingen', 'title' => 'Europe/Busingen'],
            'Europe/Chisinau' => ['value' => 'Europe/Chisinau', 'title' => 'Europe/Chisinau'],
            'Europe/Copenhagen' => ['value' => 'Europe/Copenhagen', 'title' => 'Europe/Copenhagen'],
            'Europe/Dublin' => ['value' => 'Europe/Copenhagen', 'title' => 'Europe/Dublin'],
            'Europe/Gibraltar' => ['value' => 'Europe/Gibraltar', 'title' => 'Europe/Gibraltar'],
            'Europe/Guernsey' => ['value' => 'Europe/Guernsey', 'title' => 'Europe/Guernsey'],
            'Europe/Helsinki' => ['value' => 'Europe/Helsinki', 'title' => 'Europe/Helsinki'],
            'Europe/Isle_of_Man' => ['value' => 'Europe/Isle_of_Man', 'title' => 'Europe/Isle_of_Man'],
            'Europe/Istanbul' => ['value' => 'Europe/Istanbul', 'title' => 'Europe/Istanbul'],
            'Europe/Jersey' => ['value' => 'Europe/Jersey', 'title' => 'Europe/Jersey'],
            'Europe/Kaliningrad' => ['value' => 'Europe/Kaliningrad', 'title' => 'Europe/Kaliningrad'],
            'Europe/Kirov' => ['value' => 'Europe/Kirov', 'title' => 'Europe/Kirov'],
            'Europe/Kyiv' => ['value' => 'Europe/Kyiv', 'title' => 'Europe/Kyiv'],
            'Europe/Lisbon' => ['value' => 'Europe/Lisbon', 'title' => 'Europe/Lisbon'],
            'Europe/Ljubljana' => ['value' => 'Europe/Ljubljana', 'title' => 'Europe/Ljubljana'],
            'Europe/London' => ['value' => 'Europe/London', 'title' => 'Europe/London'],
            'Europe/Luxembourg' => ['value' => 'Europe/Luxembourg', 'title' => 'Europe/Luxembourg'],
            'Europe/Madrid' => ['value' => 'Europe/Madrid', 'title' => 'Europe/Madrid'],
            'Europe/Malta' => ['value' => 'Europe/Malta', 'title' => 'Europe/Malta'],
            'Europe/Mariehamn' => ['value' => 'Europe/Mariehamn', 'title' => 'Europe/Mariehamn'],
            'Europe/Minsk' => ['value' => 'Europe/Minsk', 'title' => 'Europe/Minsk'],
            'Europe/Monaco' => ['value' => 'Europe/Monaco', 'title' => 'Europe/Monaco'],
            'Europe/Moscow' => ['value' => 'Europe/Moscow', 'title' => 'Europe/Moscow'],
            'Europe/Oslo' => ['value' => 'Europe/Oslo', 'title' => 'Europe/Oslo'],
            'Europe/Paris' => ['value' => 'Europe/Paris', 'title' => 'Europe/Paris'],
            'Europe/Podgorica' => ['value' => 'Europe/Podgorica', 'title' => 'Europe/Podgorica'],
            'Europe/Prague' => ['value' => 'Europe/Prague', 'title' => 'Europe/Prague'],
            'Europe/Riga' => ['value' => 'Europe/Riga', 'title' => 'Europe/Riga'],
            'Europe/Rome' => ['value' => 'Europe/Rome', 'title' => 'Europe/Rome'],
            'Europe/Samara' => ['value' => 'Europe/Samara', 'title' => 'Europe/Samara'],
            'Europe/San_Marino' => ['value' => 'Europe/San_Marino', 'title' => 'Europe/San_Marino'],
            'Europe/Sarajevo' => ['value' => 'Europe/Sarajevo', 'title' => 'Europe/Sarajevo'],
            'Europe/Saratov' => ['value' => 'Europe/Saratov', 'title' => 'Europe/Saratov'],
            'Europe/Simferopol' => ['value' => 'Europe/Simferopol', 'title' => 'Europe/Simferopol'],
            'Europe/Skopje' => ['value' => 'Europe/Skopje', 'title' => 'Europe/Skopje'],
            'Europe/Sofia' => ['value' => 'Europe/Sofia', 'title' => 'Europe/Sofia'],
            'Europe/Stockholm' => ['value' => 'Europe/Stockholm', 'title' => 'Europe/Stockholm'],
            'Europe/Tallinn' => ['value' => 'Europe/Tallinn', 'title' => 'Europe/Tallinn'],
            'Europe/Tirane' => ['value' => 'Europe/Tirane', 'title' => 'Europe/Tirane'],
            'Europe/Ulyanovsk' => ['value' => 'Europe/Ulyanovsk', 'title' => 'Europe/Ulyanovsk'],
            'Europe/Vaduz' => ['value' => 'Europe/Vaduz', 'title' => 'Europe/Vaduz'],
            'Europe/Vatican' => ['value' => 'Europe/Vatican', 'title' => 'Europe/Vatican'],
            'Europe/Vienna' => ['value' => 'Europe/Vienna', 'title' => 'Europe/Vienna'],
            'Europe/Vilnius' => ['value' => 'Europe/Vilnius', 'title' => 'Europe/Vilnius'],
            'Europe/Volgograd' => ['value' => 'Europe/Volgograd', 'title' => 'Europe/Volgograd'],
            'Europe/Warsaw' => ['value' => 'Europe/Warsaw', 'title' => 'Europe/Warsaw'],
            'Europe/Zagreb' => ['value' => 'Europe/Zagreb', 'title' => 'Europe/Zagreb'],
            'Europe/Zurich' => ['value' => 'Europe/Zurich', 'title' => 'Europe/Zurich'],
        ];
        $datetime_formats = [
            'Y/m/d H:i:s' => ['value' => 'Y/m/d H:i:s', 'title' => 'Y/m/d H:i:s'],
            'd/m/Y H:i:s' => ['value' => 'd/m/Y H:i:s', 'title' => 'd/m/Y H:i:s'],
        ];
        $date_formats = [
            'Y/m/d' => ['value' => 'Y/m/d', 'title' => 'Y/m/d'],
            'd/m/Y' => ['value' => 'd/m/Y', 'title' => 'd/m/Y'],
        ];
        $time_formats = [
            'H:i:s' => ['value' => 'H:i:s', 'title' => 'H:i:s'],
        ];
        Variable::insert([
            [
                'group' => 'system',
                'sort_order' => '10',
                'title' => 'web',
                'variable' => 'web',
                'type' => 'text',
                'type_variables' => null,
                'status' => '1',
            ],
            [
                'group' => 'system',
                'sort_order' => '20',
                'title' => 'email',
                'variable' => 'email',
                'type' => 'text',
                'type_variables' => null,
                'status' => '1',
            ],
            [
                'group' => 'system',
                'sort_order' => '30',
                'title' => 'phone',
                'variable' => 'phone',
                'type' => 'text',
                'type_variables' => null,
                'status' => '1',
            ],
            [
                'group' => 'system',
                'sort_order' => '40',
                'title' => 'address',
                'variable' => 'address',
                'type' => 'text',
                'type_variables' => null,
                'status' => '1',
            ],
            [
                'group' => 'localisation',
                'sort_order' => '10',
                'title' => 'timezone',
                'variable' => 'timezone',
                'type' => 'select',
                'type_variables' => json_encode($timezones),
                'status' => '1',
            ],
            [
                'group' => 'localisation',
                'sort_order' => '20',
                'title' => 'date-time-format',
                'variable' => 'date_time_format',
                'type' => 'select',
                'type_variables' => json_encode($datetime_formats),
                'status' => '1',
            ],
            [
                'group' => 'localisation',
                'sort_order' => '30',
                'title' => 'date-format',
                'variable' => 'date_format',
                'type' => 'select',
                'type_variables' => json_encode($date_formats),
                'status' => '1',
            ],
            [
                'group' => 'localisation',
                'sort_order' => '40',
                'title' => 'time-format',
                'variable' => 'time_format',
                'type' => 'select',
                'type_variables' => json_encode($time_formats),
                'status' => '1',
            ],
            [
                'group' => 'social',
                'sort_order' => '10',
                'title' => 'facebook-link',
                'variable' => 'facebook_link',
                'type' => 'text',
                'type_variables' => null,
                'status' => '1',
            ],
            [
                'group' => 'social',
                'sort_order' => '20',
                'title' => 'instagram-link',
                'variable' => 'instagram_link',
                'type' => 'text',
                'type_variables' => null,
                'status' => '1',
            ],
            [
                'group' => 'social',
                'sort_order' => '30',
                'title' => 'twitter-link',
                'variable' => 'twitter_link',
                'type' => 'text',
                'type_variables' => null,
                'status' => '1',
            ],
        ]);
    }
}
