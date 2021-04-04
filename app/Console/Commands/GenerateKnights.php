<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class GenerateKnights extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:knights';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create everytime new 5 Knights for queen';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('knights')->delete();
        DB::statement('alter table knights AUTO_INCREMENT = 1');
        for($i=0; $i<5; $i++) {
            $userObj = getRandomName();
            $randomAge = rand(20, 25);
            if($randomAge>=20&&$randomAge<=23) {
                $this->knightIsYoung($userObj->name, $randomAge);
            } else if($randomAge>=24&&$randomAge<=25) {
                $this->knightIsOld($userObj->name, $randomAge);
            }
        }
        return 'Knights Has Been Created!!';
    }

    public function knightIsYoung($name,$age)
    {
        $defense = rand(20, 60); // 20-60

        $generosity = rand(0, 100);
        $mercy = rand(0, 100);
        $hope = rand(0, 100);
        $arr = [ $generosity,$mercy,$hope ];

        DB::table('knights')->insert([
            'name' => $name,
            'age' => $age,

            'generosity' => $generosity,
            'mercy' => $mercy,
            'hope' => $hope,

            'nobality' => rand(0, 100),

            'courage' => rand(0,min($arr)),
            'justice' => rand(0,min($arr)),
            'faith' => rand(0,min($arr)),

            //part-3
            'strength' => rand(60, ($defense-1)), //60-100
            'defense'  => $defense,
            'battle_strategy' =>  rand(20, 40)
        ]);
    }

    public function knightIsOld($name,$age)
    {
        $strenght = rand(60, 100); // 60-100

        $courage = rand(0, 100);
        $justice = rand(0, 100);
        $faith = rand(0, 100);
        $arr = [ $courage,$justice,$faith ];

        DB::table('knights')->insert([
            'name' => $name,
            'age' => $age,

            'courage' => $courage,
            'justice' => $justice,
            'faith' => $faith,

            'mercy' => rand(0,min($arr)),
            'generosity' => rand(0,min($arr)),
            'hope' => rand(0,min($arr)),

            'nobality' => rand(0, 100),

            //part-3
            'strength' => $strenght,
            'defense'  => rand(20, ($strenght-1)),
            'battle_strategy' =>   rand(20, 40)
        ]);

    }

}
