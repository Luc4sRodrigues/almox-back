<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// User::factory(2)->create();

		// 	\App\Models\User::factory()->create([
		// 		'name' => 'Admin',
		// 		'email' => 'admin@admin.com',
		// 	]);

		$this->faker = Faker::create('pt_BR');

		// Reset cached roles and permissions
		app()[PermissionRegistrar::class]->forgetCachedPermissions();

		// create permissions
		// Permission::create(['name' => 'SettingsIndex']);
		// Permission::create(['name' => 'SettingsCreate']);
		// Permission::create(['name' => 'SettingsDelete']);

		Permission::create(['name' => 'EquipmentsIndex']);
		Permission::create(['name' => 'EquipmentsCreate']);
		Permission::create(['name' => 'EquipmentsDelete']);

		// create roles and assign existing permissions
		$role1 = Role::create(['name' => 'admin']);
		$role1->givePermissionTo('EquipmentsIndex', 'EquipmentsCreate', 'EquipmentsDelete');

		$role2 = Role::create(['name' => 'user']);
		$role2->givePermissionTo('EquipmentsIndex');

		$userAdmin = \App\Models\User::factory()->create([
			'id' => 1,
			'name' => 'Admin',
			'email' => 'admin@admin.com',
			'email_verified_at' => now(),
			'password' => '1234',
			'remember_token' => '',
		]);
		$userAdmin->assignRole($role1);

		$user = \App\Models\User::factory()->create([
			'id' => 2,
			'name' => 'User',
			'email' => 'user@user.com',
			'email_verified_at' => now(),
			'password' => '1234',
			'remember_token' => '',
		]);
		$user->assignRole($role2);
	}
}
