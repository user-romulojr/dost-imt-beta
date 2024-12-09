<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Indicator;
use Illuminate\Http\Request;
use App\Models\Mfo;
use Illuminate\Support\Facades\Auth;

class MfoController extends Controller
{
    public function index()
    {
        $indicators = [ ];
        foreach(Auth::user()->indicators as $indicator)
        {
            if($indicator->status == 0 && !$indicator->request_approve)
            array_push($indicators, $indicator);
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

        return view('manage-mfo',['indicators' => $indicators, 'years' => $years]);
    }

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

        return redirect(route('mfos.index'));
    }
}
