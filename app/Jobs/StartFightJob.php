<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Knight;
use DB;

class StartFightJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $attacks = 4;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->queue = 'fight';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for($i=0; $i<$this->attacks; $i++) {
            $attacker = null;
            $defender = null;
            $knights = Knight::orderBy('battle_strategy', 'DESC')->get();
            if($knights[0]->battle_strategy==$knights[1]->battle_strategy) {
                $knights = Knight::orderBy('strength', 'DESC')->get();
            }
            $attacker = $i%2==0?$knights[0]:$knights[1];
            $defender = $i%2==0?$knights[1]:$knights[0];

            if($attacker->health<=20) {
                Knight::where('id', $defender->id)
                ->update([
                    'is_winner' => true
                ]);
                break;
            } else if($defender->health<=20) {
                Knight::where('id', $attacker->id)
                ->update([
                    'is_winner' => true
                ]);
                break;
            } else {
                $this->calcDamage($attacker, $defender);
                Knight::where('id', $attacker->id)
                ->update([
                    'battle_strategy' => rand(20, 40)
                ]);
            }
        }
    }

    public function calcDamage($attacker, $defender)
    {
        $damage = ($attacker->strength+(($attacker->strength*$attacker->battle_strategy)/100)-$defender->defense);
        Knight::find($defender->id)
                ->increment('damage',$damage);
        Knight::find($defender->id)
                ->decrement('health',$damage);
    }
}
