<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agency;


class AgencyController extends Controller
{
    public function index()
    {
        $query = Agency::query();
        $agencies = $query->get();

        return view('agencies',['agencies' => $agencies]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'acronym' => 'required',
            'agency_group' => 'nullable',
            'contact' => 'nullable',
            'website' => 'nullable',
        ]);

        Agency::create([
            'name' => $request->name,
            'acronym' => $request->acronym,
            'agency_group' => $request->agency_group,
            'contact' => $request->contact,
            'website' => $request->website,
        ]);

        return redirect(route('agencies.index'));
    }

    public function update($agencyID, Request $request)
    {
        $agency = Agency::findOrFail($agencyID);

        $request->validate([
            'name' => 'required',
            'acronym' => 'required',
            'agency_group' => 'nullable',
            'contact' => 'nullable',
            'website' => 'nullable',
        ]);

        $agency->update([
            'name' => $request->name,
            'acronym' => $request->acronym,
            'agency_group' => $request->agency_group,
            'contact' => $request->contact,
            'website' => $request->website,
        ]);

        return redirect(route('agencies.index'));
    }

    public function destroy($agencyID)
    {
        $agency = Agency::findOrFail($agencyID);
        $agency->delete();

        return redirect(route('agencies.index'));
    }
}


