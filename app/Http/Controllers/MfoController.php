<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Indicator;
use Illuminate\Http\Request;
use App\Models\Mfo;

class MfoController extends Controller
{
    public function store($indicatorID, Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        $majorFinalOutput = Indicator::findOrFail($indicatorID)->majorFinalOutputs()->create([
            'title' => $request->title,
        ]);

         // THE CURRENT ADMINISTRATION TERM
        $endYear = date('Y');
        $years = array();
        while($endYear % 6 != 0){
            $endYear++;
        }

        for($i = $endYear - 5; $i <= $endYear; $i++)
        {
            array_push($years, $i);
        }
        // end

        foreach($years as $year)
        {
            $majorFinalOutput->successIndicators()->create([
                'year' => $year,
                'target' => $request->$year,
            ]);
        }

        /*
        Indicator::findOrFail($indicatorID)->majorFinalOutputs()->create([
            'title' => $request->title,
        ]);
        */

        return redirect(route('draft_indicators.index'));
    }
}
