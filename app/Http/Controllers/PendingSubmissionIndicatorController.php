<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Indicator;
use App\Models\Agency;
use Illuminate\Support\Facades\Auth;

class PendingSubmissionIndicatorController extends Controller
{
    public function index()
    {
        $indicators = [ ];
        foreach(Agency::findOrFail(Auth::user()->agency_id)->indicators as $indicator)
        {
            if($indicator->status == 0 && $indicator->request_approve)
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

        return view('pending-submission',['indicators' => $indicators, 'years' => $years]);
    }

    public function approve(Request $request)
    {
        foreach($request->items as $item)
        {
            $indicator = Indicator::findOrFail($item);
            $indicator->agencies()->updateExistingPivot(Auth::user()->agency_id, [ 'verdict' => true ]);

            $approved = true;
            foreach($indicator->agencies as $agency){
                $approved = ($approved && $agency->pivot->verdict);
            }

            if($approved)
            {
                $indicator->request_approve = false;
                $indicator->status = 1;
                $indicator->save();
            }
        }

        return redirect(route('pending_submission.index'));
    }

    public function reject(Request $request)
    {
        foreach($request->items as $item)
        {
            $indicator = Indicator::findOrFail($item);
            $indicator->request_approve = false;
            $indicator->save();

            foreach($indicator->agencies as $agency){
                $indicator->agencies()->updateExistingPivot($agency->id, [ 'request_approve' => false ]);
            }
        }

        return redirect(route('pending_submission.index'));
    }
}
