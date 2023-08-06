<?php

namespace Database\Seeders;

use App\Models\User\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker1 = Factory::create();
        User::insert([
            [
                'customer_id' => '1',
                'user_role_id' => '1',
                'username' => 'manager1',
                'first_name' => 'Manager',
                'last_name' => 'D-Event',
                'email' => 'manager@devent.com.tr',
                'email_verified_at' => now(),
                'phone_country_id' => '223',
                'phone' => '5432109871',
                'phone_verified_at' => now(),
                'password' => bcrypt('manager1'),
                'register_ip' => $faker1->ipv4,
                'register_user_agent' => $faker1->userAgent,
                'last_login_ip' => $faker1->ipv4,
                'last_login_agent' => $faker1->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'status' => 1,
            ],
            [
                'customer_id' => '1',
                'user_role_id' => '2',
                'username' => 'operator1',
                'first_name' => 'Operator',
                'last_name' => 'D-Event',
                'email' => 'operator@devent.com.tr',
                'email_verified_at' => now(),
                'phone_country_id' => '223',
                'phone' => '5432109872',
                'phone_verified_at' => now(),
                'password' => bcrypt('operator1'),
                'register_ip' => $faker1->ipv4,
                'register_user_agent' => $faker1->userAgent,
                'last_login_ip' => $faker1->ipv4,
                'last_login_agent' => $faker1->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'status' => 1,
            ],
            [
                'customer_id' => '1',
                'user_role_id' => '3',
                'username' => 'user1',
                'first_name' => 'User',
                'last_name' => 'D-Event',
                'email' => 'user@devent.com.tr',
                'email_verified_at' => now(),
                'phone_country_id' => '223',
                'phone' => '5432109873',
                'phone_verified_at' => now(),
                'password' => bcrypt('user1'),
                'register_ip' => $faker1->ipv4,
                'register_user_agent' => $faker1->userAgent,
                'last_login_ip' => $faker1->ipv4,
                'last_login_agent' => $faker1->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'status' => 1,
            ],
        ]);

        $faker2 = Factory::create();
        User::insert([
            [
                'customer_id' => '2',
                'user_role_id' => '4',
                'username' => 'manager2',
                'first_name' => 'Manager',
                'last_name' => 'Pi-Event',
                'email' => 'manager@pinet.com.tr',
                'email_verified_at' => now(),
                'phone_country_id' => '223',
                'phone' => '5432109874',
                'phone_verified_at' => now(),
                'password' => bcrypt('manager2'),
                'register_ip' => $faker2->ipv4,
                'register_user_agent' => $faker2->userAgent,
                'last_login_ip' => $faker2->ipv4,
                'last_login_agent' => $faker2->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'status' => 1,
            ],
            [
                'customer_id' => '2',
                'user_role_id' => '5',
                'username' => 'operator2',
                'first_name' => 'Operator',
                'last_name' => 'Pi-Event',
                'email' => 'operator@pinet.com.tr',
                'email_verified_at' => now(),
                'phone_country_id' => '223',
                'phone' => '5432109875',
                'phone_verified_at' => now(),
                'password' => bcrypt('operator2'),
                'register_ip' => $faker2->ipv4,
                'register_user_agent' => $faker2->userAgent,
                'last_login_ip' => $faker2->ipv4,
                'last_login_agent' => $faker2->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'status' => 1,
            ],
            [
                'customer_id' => '2',
                'user_role_id' => '6',
                'username' => 'user2',
                'first_name' => 'User',
                'last_name' => 'Pi-Event',
                'email' => 'user@pinet.com.tr',
                'email_verified_at' => now(),
                'phone_country_id' => '223',
                'phone' => '5432109876',
                'phone_verified_at' => now(),
                'password' => bcrypt('user2'),
                'register_ip' => $faker2->ipv4,
                'register_user_agent' => $faker2->userAgent,
                'last_login_ip' => $faker2->ipv4,
                'last_login_agent' => $faker2->userAgent,
                'last_login_datetime' => date('Y-m-d H:i:s'),
                'status' => 1,
            ],
        ]);
    }
}
