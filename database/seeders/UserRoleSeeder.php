<?php

namespace Database\Seeders;

use App\Models\User\Role\Role;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = [
            'portal.dashboard.index',
            'portal.meeting.index',
            'portal.user.index',
            'portal.setting.index',
        ];

        Role::insert([
            [
                'customer_id' => 1,
                'title' => 'Manager',
                'routes' => json_encode($routes),
                'status' => 1,
            ],
            [
                'customer_id' => 1,
                'title' => 'Operator',
                'routes' => json_encode($routes),
                'status' => 1,
            ],
            [
                'customer_id' => 1,
                'title' => 'User',
                'routes' => json_encode($routes),
                'status' => 1,
            ],
        ]);

        Role::insert([
            [
                'customer_id' => 2,
                'title' => 'Manager',
                'routes' => json_encode($routes),
                'status' => 1,
            ],
            [
                'customer_id' => 2,
                'title' => 'Operator',
                'routes' => json_encode($routes),
                'status' => 1,
            ],
            [
                'customer_id' => 2,
                'title' => 'User',
                'routes' => json_encode($routes),
                'status' => 1,
            ],
        ]);
    }
}
