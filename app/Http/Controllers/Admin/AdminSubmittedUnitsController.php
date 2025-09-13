<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubmittedUnit;

class AdminSubmittedUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = SubmittedUnit::paginate(5);

        return view('backend.admin.pages.submittedunits.index',compact('units'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unit = SubmittedUnit::findOrFail($id);

        $unit->delete();

        return back()->with('success','Unit removed successfully!');
    }

    public function destroyall(){

        $units = SubmittedUnit::all();

        $units->each->delete();

        return back()->with('success','Entire User units table cleared successfully!');
    }
}
