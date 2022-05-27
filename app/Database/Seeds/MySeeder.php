<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MySeeder extends Seeder
{
	public function run()
	{
		$users = model('UsersModel');

		$users->insert([
			'nama'      => "Riyan Risky W S",
			'username'  => "admin",
			'password'  => \password_hash("admin", PASSWORD_DEFAULT),
			'role'  		=> "admin",
			'create_at' => time(),
		]);

		$setting_notif = model('SettingNotifModel');

		$setting_notif->insert([
			'user'      => 1,
		]);
	}
}
