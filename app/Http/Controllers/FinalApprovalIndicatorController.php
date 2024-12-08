<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Indicator;

class FinalApprovalIndicatorController extends Controller
{
    public function index()
    {
        $indicators = [ ];
        foreach(Indicator::all() as $indicator)
        {
            if($indicator->status == 1 && $indicator->request_approve && $indicator->type > 0)
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

        return view('final-approval',['indicators' => $indicators, 'years' => $years]);
    }

    public function approve(Request $request)
    {
        foreach($request->items as $item)
        {
            $indicator = Indicator::findOrFail($item);
            $indicator->status = 2;
            $indicator->save();
        }

        return redirect(route('final_approval.index'));
    }

    public function reject(Request $request)
    {
        foreach($request->items as $item)
        {
            $indicator = Indicator::findOrFail($item);
            $indicator->status = 0;
            $indicator->type = 0;
            $indicator->request_approve = false;
            $indicator->verdict = true;
            $indicator->save();
        }

        return redirect(route('final_approval.index'));
    }
}
