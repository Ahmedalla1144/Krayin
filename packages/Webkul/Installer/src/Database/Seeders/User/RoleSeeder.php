<?php

namespace Webkul\Installer\Database\Seeders\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @param  array  $parameters
     * @return void
     */
    public function run($parameters = [])
    {
        DB::table('users')->delete();

        DB::table('roles')->delete();

        $defaultLocale = $parameters['locale'] ?? config('app.locale');

        DB::table('roles')->insert([
            'id'              => 1,
            'name'            => trans('installer::app.seeders.user.role.administrator', [], $defaultLocale),
            'description'     => trans('installer::app.seeders.user.role.administrator-role', [], $defaultLocale),
            'permission_type' => 'all',
        ]);
        DB::table('roles')->insert([
            'id'              => 2,
            'name'            => trans('installer::app.seeders.user.role.sales', [], $defaultLocale),
            'description'     => trans('installer::app.seeders.user.role.sales-role', [], $defaultLocale),
            'permission_type' => 'custom',
            'permissions' => json_encode(
                ["dashboard", "leads", "leads.view", "quotes", "quotes.edit"]
            )
        ]);
        DB::table('roles')->insert([
            'id'              => 3,
            'name'            => trans('installer::app.seeders.user.role.customer', [], $defaultLocale),
            'description'     => trans('installer::app.seeders.user.role.customer-role', [], $defaultLocale),
            'permission_type' => 'custom',
            'permissions' => json_encode(
                ["dashboard"]
            )
        ]);
    }
}
