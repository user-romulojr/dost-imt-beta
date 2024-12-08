<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Indicator;
use App\Models\Mfo;

class EvaluateIndicatorController extends Controller
{
    public function index()
    {
        $indicators = [ ];
        $endYear = date('Y');
        foreach(Indicator::all() as $indicator)
        {
            if($indicator->status == 2 && $indicator->end_year >= $endYear)
            {
                array_push($indicators, $indicator);
            }
        }

        // THE CURRENT ADMINISTRATION TERM
        $years = array();
        $endYear = date('Y');
        while($endYear % 6 != 0){
            $endYear++;
        }

        for($i = $endYear - 5; $i <= $endYear; $i++)
        {
            array_push($years, $i);
        }
        // end

        return view('evaluate-indicators',['indicators' => $indicators, 'years' => $years]);
    }

    public function store($mfoID, Request $request)
    {
        $majorFinalOutput = Mfo::findOrFail($mfoID);

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

        foreach($majorFinalOutput->successIndicators as $successIndicator)
        {
            $year = $successIndicator->year;
            if($year <= $endYear)
            {
                $successIndicator->accomplished = $request->$year;
                $successIndicator->save();
            }
        }

        /*
        Indicator::findOrFail($indicatorID)->majorFinalOutputs()->create([
            'title' => $request->title,
        ]);
        */

        return redirect(route('evaluate_indicators.index'));
    }
}
