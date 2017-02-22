<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{

    private $_countEmployee = 2000;
    private $_position = array(
        'position1',
        'position2',
        'position3',
        'position4',
        'position5',
        'position6',
    );


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee')->insert([
            'fullname' => str_random(10),
            'position' => 'chief',
            'employment_date' =>rand(time() - rand(1000, 20000), time()),
            'salary' => rand(1000, 50000),
            'chief' => 0,
        ]);

        for ($i = 1; $i < $this->_countEmployee -1; $i++) {
             DB::table('employee')->insert([
                'fullname' => "user_".str_random(10),
                'position' => str_random(10),
                'employment_date' =>rand(time() - rand(1000, 20000), time()),
                'salary' => rand(1000, 50000),
                'chief' => rand(1, $i),
            ]);
        }

    }
}
