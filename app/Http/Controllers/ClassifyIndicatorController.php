<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Indicator;

class ClassifyIndicatorController extends Controller
{
    public function index()
    {
        $indicators = [ ];
        foreach(Indicator::all() as $indicator)
        {
            if($indicator->status == 1 && $indicator->request_approve && $indicator->type == 0)
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

        return view('classify-indicators',['indicators' => $indicators, 'years' => $years]);
    }

    public function primary(Request $request)
    {
        foreach($request->items as $item)
        {
            $indicator = Indicator::findOrFail($item);
            $indicator->type = 1;
            $indicator->save();
        }

        return redirect(route('classify_indicators.index'));
    }


    public function secondary(Request $request)
    {
        foreach($request->items as $item)
        {
            $indicator = Indicator::findOrFail($item);
            $indicator->type = 2;
            $indicator->save();
        }

        return redirect(route('classify_indicators.index'));
    }
}
