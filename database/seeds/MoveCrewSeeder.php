<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MoveCrewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Model::unguard();

    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // $this->call(UserTableSeeder::class);
        $this->call('MoveTableSeeder');
        $this->call('MoveCrewPivotSeeder');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}


class MoveTableSeeder extends Seeder 
{
	public function run()
	{
		App\Move::truncate();

		factory(App\Move::class, 50)->create();
	}
}

class MoveCrewPivotSeeder extends Seeder 
{
	public function run()
	{

		DB::table('crew_mover')->truncate();
		for ($i=0; $i < 24 ; $i++) { 
			# code...
			$crew = App\Crew::all()->random(1)->id;
			$mover = App\Mover::all()->random(1)->id;

			if(DB::table('crew_mover')->where('crew_id', '=', $crew)->where('mover_id', '=', $mover)->get()) {
				$i--;
			} else {
				DB::table('crew_mover')->insert(
					['crew_id' => $crew, 'mover_id' => $mover]
				);
			}
		}
	}
}
