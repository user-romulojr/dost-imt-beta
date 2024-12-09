<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Indicator;

class InitialApprovalIndicatorController extends Controller
{
    public function index()
    {
        $indicators = [ ];
        foreach(Indicator::all() as $indicator)
        {
            if($indicator->status == 1 && !$indicator->request_approve)
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

        return view('initial-approval',['indicators' => $indicators, 'years' => $years]);
    }

    public function approve(Request $request)
    {

        if($request->input('action') == 'accept'){
            $this->accept($request);
        } else {
            $this->reject($request);
        }

        return redirect(route('initial_approval.index'));
    }

    public function accept(Request $request)
    {
        foreach($request->items as $item)
        {
            $indicator = Indicator::findOrFail($item);
            $indicator->request_approve = true;
            $indicator->verdict = true;
            $indicator->save();
        }
    }

    public function reject(Request $request)
    {
        foreach($request->items as $item)
        {
            $indicator = Indicator::findOrFail($item);
            $indicator->request_approve = true;
            $indicator->verdict = false;
            $indicator->save();
        }
    }
}
