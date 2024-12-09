<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Indicator;

class ArchivedIndicatorController extends Controller
{
    public function index()
    {
        $indicators = [ ];
        $endYear = date('Y');
        foreach(Indicator::all() as $indicator)
        {
            if($indicator->status == 2 && $indicator->end_year < $endYear)
            {
                array_push($indicators, $indicator);
            }
        }

        // THE CURRENT ADMINISTRATION TERM
        $years = array();
        while($endYear % 6 != 0){
            $endYear++;
        }

        for($i = $endYear - 5; $i <= $endYear; $i++)
        {
            array_push($years, $i);
        }
        // end

        return view('archived-indicators',['indicators' => $indicators, 'years' => $years]);
    }

    public function update($indicatorID, Request $request)
    {
        $request->validate([
            'end_year' => ['required', 'string', 'max:255'],
        ]);

        $indicator = Indicator::findOrFail($indicatorID);
        $indicator->end_year = $request->end_year;
        $indicator->save();

        return redirect(route('archived_indicators.index'));
    }
}
