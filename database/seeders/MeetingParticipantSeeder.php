<?php

namespace Database\Seeders;

use App\Models\Meeting\Participant\Participant;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MeetingParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker1 = Factory::create();
        $faker2 = Factory::create();
        $faker3 = Factory::create();
        $faker4 = Factory::create();
        $faker5 = Factory::create();
        $faker6 = Factory::create();
        $faker7 = Factory::create();
        $faker8 = Factory::create();
        $faker9 = Factory::create();
        $username1 = Str::uuid()->toString();
        $username2 = Str::uuid()->toString();
        $username3 = Str::uuid()->toString();
        $username4 = Str::uuid()->toString();
        $username5 = Str::uuid()->toString();
        $username6 = Str::uuid()->toString();
        $username7 = Str::uuid()->toString();
        $username8 = Str::uuid()->toString();
        $username9 = Str::uuid()->toString();
        Participant::insert([
            [
                'meeting_id' => '3',
                'username' => $username1,
                'title' => null,
                'first_name' => $faker1->firstName,
                'last_name' => $faker1->lastName,
                'identification_number' => null,
                'organisation' => $faker1->company,
                'email' => $faker1->companyEmail,
                'phone_country_id' => '223',
                'phone' => $faker1->phoneNumber,
                'password' => $faker1->password,
                'last_login_ip' => $faker1->ipv4,
                'last_login_agent' => $faker1->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'last_activity' => now(),
                'type' => 'agent',
                'gdpr_consent' => 0,
                'status' => 1,
            ],
            [
                'meeting_id' => '3',
                'username' => $username2,
                'title' => null,
                'first_name' => $faker2->firstName,
                'last_name' => $faker2->lastName,
                'identification_number' => null,
                'organisation' => $faker2->company,
                'email' => $faker2->companyEmail,
                'phone_country_id' => '223',
                'phone' => $faker2->phoneNumber,
                'password' => $faker2->password,
                'last_login_ip' => $faker2->ipv4,
                'last_login_agent' => $faker2->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'last_activity' => now(),
                'type' => 'agent',
                'gdpr_consent' => 0,
                'status' => 1,
            ],
            [
                'meeting_id' => '3',
                'username' => $username3,
                'title' => null,
                'first_name' => $faker3->firstName,
                'last_name' => $faker3->lastName,
                'identification_number' => null,
                'organisation' => $faker3->company,
                'email' => $faker3->companyEmail,
                'phone_country_id' => '223',
                'phone' => $faker3->phoneNumber,
                'password' => $faker3->password,
                'last_login_ip' => $faker3->ipv4,
                'last_login_agent' => $faker3->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'last_activity' => now(),
                'type' => 'attendee',
                'gdpr_consent' => 0,
                'status' => 1,
            ],
            [
                'meeting_id' => '3',
                'username' => $username4,
                'title' => null,
                'first_name' => $faker4->firstName,
                'last_name' => $faker4->lastName,
                'identification_number' => null,
                'organisation' => $faker4->company,
                'email' => $faker4->companyEmail,
                'phone_country_id' => '223',
                'phone' => $faker4->phoneNumber,
                'password' => $faker4->password,
                'last_login_ip' => $faker4->ipv4,
                'last_login_agent' => $faker4->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'last_activity' => now(),
                'type' => 'attendee',
                'gdpr_consent' => 0,
                'status' => 1,
            ],
            [
                'meeting_id' => '3',
                'username' => $username5,
                'title' => null,
                'first_name' => $faker5->firstName,
                'last_name' => $faker5->lastName,
                'identification_number' => null,
                'organisation' => $faker5->company,
                'email' => $faker5->companyEmail,
                'phone_country_id' => '223',
                'phone' => $faker5->phoneNumber,
                'password' => $faker5->password,
                'last_login_ip' => $faker5->ipv4,
                'last_login_agent' => $faker5->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'last_activity' => now(),
                'type' => 'attendee',
                'gdpr_consent' => 0,
                'status' => 1,
            ],
            [
                'meeting_id' => '3',
                'username' => $username6,
                'title' => null,
                'first_name' => $faker6->firstName,
                'last_name' => $faker6->lastName,
                'identification_number' => null,
                'organisation' => $faker6->company,
                'email' => $faker6->companyEmail,
                'phone_country_id' => '223',
                'phone' => $faker6->phoneNumber,
                'password' => $faker6->password,
                'last_login_ip' => $faker6->ipv4,
                'last_login_agent' => $faker6->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'last_activity' => now(),
                'type' => 'attendee',
                'gdpr_consent' => 0,
                'status' => 1,
            ],
            [
                'meeting_id' => '3',
                'username' => $username7,
                'title' => null,
                'first_name' => $faker7->firstName,
                'last_name' => $faker7->lastName,
                'identification_number' => null,
                'organisation' => $faker7->company,
                'email' => $faker7->companyEmail,
                'phone_country_id' => '223',
                'phone' => $faker7->phoneNumber,
                'password' => $faker7->password,
                'last_login_ip' => $faker7->ipv4,
                'last_login_agent' => $faker7->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'last_activity' => now(),
                'type' => 'attendee',
                'gdpr_consent' => 0,
                'status' => 1,
            ],
            [
                'meeting_id' => '3',
                'username' => $username8,
                'title' => null,
                'first_name' => $faker8->firstName,
                'last_name' => $faker8->lastName,
                'identification_number' => null,
                'organisation' => $faker8->company,
                'email' => $faker8->companyEmail,
                'phone_country_id' => '223',
                'phone' => $faker8->phoneNumber,
                'password' => $faker8->password,
                'last_login_ip' => $faker8->ipv4,
                'last_login_agent' => $faker8->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'last_activity' => now(),
                'type' => 'team',
                'gdpr_consent' => 0,
                'status' => 1,
            ],
            [
                'meeting_id' => '3',
                'username' => $username9,
                'title' => null,
                'first_name' => $faker9->firstName,
                'last_name' => $faker9->lastName,
                'identification_number' => null,
                'organisation' => $faker9->company,
                'email' => $faker9->companyEmail,
                'phone_country_id' => '223',
                'phone' => $faker9->phoneNumber,
                'password' => $faker9->password,
                'last_login_ip' => $faker9->ipv4,
                'last_login_agent' => $faker9->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'last_activity' => now(),
                'type' => 'team',
                'gdpr_consent' => 0,
                'status' => 1,
            ],
        ]);

    }
}
