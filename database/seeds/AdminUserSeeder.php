<?php

use App\AdminUser;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminUser::create([
            'name' => 'yanik',
            'email' => 'yanik@believemaster.com',
            'password' => '$2y$10$r.tAOPRPBa4drOZ5IsVjoeMB/rENV5yZBe/gj7eFuyR9LkQUnFxmK',    // bcrpyt('yanikkumar')
        ]);
    }
}
