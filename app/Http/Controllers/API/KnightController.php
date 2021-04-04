<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Knight;
use App\Http\Controllers\AppBaseController;
use App\Jobs\StartFightJob;
use Carbon\Carbon;
use DB;

class KnightController extends AppBaseController
{
    public function index()
    {
        $knights = Knight::select(DB::raw('id, name, age, courage, justice, mercy, generosity, faith, nobality, hope, (courage + justice + mercy + generosity + faith + nobality + hope)/100 as total'))
            ->orderBy('total','desc')
            ->get()
            ->take(3);
        return $this->sendResponse($knights, 'Knights List Successfully Reterived.');
    }

    public function updateKnights(Request $request)
    {
        $knights = Knight::whereNotIn('id', $request->all())->delete();
        return response()->json('Knight updated!');
    }

    public function startFight()
    {
        $fightJob = (new StartFightJob())->delay(Carbon::now()->addHours(1));
        dispatch($fightJob);
        return $this->sendResponse($fightJob, 'Competition Has Been Started');
    }
}
