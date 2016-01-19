<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();

    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // $this->call(UserTableSeeder::class);
        $this->call('MoverTableSeeder');
        $this->call('CrewTableSeeder');
        $this->call('TruckTableSeeder');
        $this->call('UserTableSeeder');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

class MoverTableSeeder extends Seeder
{
	public function run()
	{
		App\Mover::truncate();

		factory(App\Mover::class, 15)->create();
	}
}

class TruckTableSeeder extends Seeder
{
	public function run()
	{
		App\Truck::truncate();

		factory(App\Truck::class, 5)->create();
	}
}

class CrewTableSeeder extends Seeder 
{
	public function run()
	{
		App\Crew::truncate();

		factory(App\Crew::class, 6)->create();
	}
}

class UserTableSeeder extends Seeder 
{
	public function run()
	{
		App\User::truncate();

		App\User::create([
			'name' => 'admin',
			'email' => 'tcf.webdev@gmail.com',
			'password' => bcrypt('password')
		]);

		App\User::create([
			'name' => 'guest',
			'email' => 'guest@guest.com',
			'password' => bcrypt('guest')
		]);
	}
}
