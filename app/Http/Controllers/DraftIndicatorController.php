<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Indicator;
use Illuminate\Support\Facades\Auth;

class DraftIndicatorController extends Controller
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

        return view('draft-indicators',['indicators' => $indicators, 'years' => $years]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'end_year' => ['required', 'integer', 'digits:4'],
            'operational_definition' => ['nullable', 'string', 'max:255'],
        ]);

        $indicator = Indicator::create([
            'title' => $request->title,
            'end_year' => $request->end_year,
            'operational_definition' => $request->operational_definition,
        ]);

        $request->user()->indicators()->attach($indicator->id);
        return redirect(route('draft_indicators.index'));
    }

    public function update($indicatorID, Request $request)
    {
        $indicator = Indicator::findOrFail($indicatorID);
        $indicator->update([
            'title' => $request->title,
            'end_year' => $request->end_year,
            'operational_definition' => $request->operational_definition,
            'type' => $request->type,
            'request_approve' => $request->request_approve,
            'status' => $request->status,
        ]);

        return redirect(route('draft_indicators.index'));
    }

    public function destroy($indicatorID)
    {
        $indicator = Indicator::findOrFail($indicatorID);
        $indicator->delete();

        return redirect(route('draft_indicators.index'));
    }
}
