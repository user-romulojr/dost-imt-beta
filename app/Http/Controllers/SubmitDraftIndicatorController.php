<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Indicator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmitDraftIndicatorController extends Controller
{
    public function index()
    {
        $indicators = [ ];
        foreach(Auth::user()->indicators as $indicator)
        {
            if($indicator->status == 0 && !$indicator->request_approve)
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

        return view('submit-draft-indicators',['indicators' => $indicators, 'years' => $years]);
    }


    public function store(Request $request)
    {
        foreach($request->items as $item)
        {
            $indicator = Indicator::findOrFail($item);
            $indicator->request_approve = true;
            $indicator->save();

            $agencies = [ ];
            foreach($indicator->users as $user)
            {
                $agencies[$user->agency_id] = true;
            }

            $indicator->agencies()->sync(array_keys($agencies));
        }

        return redirect(route('submit_draft_indicators.index'));
    }

}
