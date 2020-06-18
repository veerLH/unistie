<?php

use Illuminate\Support\Str;
use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use App\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $created = AdminUser::firstOrCreate([
            'email' => 'admin@' . Str::slug(Str::lower(config('app.name')), '') . '.com',
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('password')
        ]);

        $created->syncRoles([collect(Role::where('guard_name', config('custom_guards.default.admin'))->pluck('name')->toArray())->random()]);
    }
}
