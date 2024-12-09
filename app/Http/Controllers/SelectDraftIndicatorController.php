<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Indicator;
use App\Models\User;

class SelectDraftIndicatorController extends Controller
{
    public function index()
    {
        // THE QUERY OF INDICATORS
        $user = User::findOrFail(Auth::id());
        $indicators = Indicator::where('status', 0)
            ->whereDoesntHave('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
        })->get();
        // end

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



        return view('select-draft-indicators',['indicators' => $indicators, 'years' => $years]);
    }

    public function store(Request $request)
    {
        foreach($request->items as $item)
        {
            $request->user()->indicators()->attach($item);
        }

        return redirect(route('select_draft_indicators.index'));
    }
}
