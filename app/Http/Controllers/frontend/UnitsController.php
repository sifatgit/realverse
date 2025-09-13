<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\City;
use App\Models\Agent;
use App\Models\Rate;
use Auth;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orderby = $request->input('orderby', 'created_at'); // default column
        $order = $request->input('order', 'asc');    // default order
        $unitIdsRaw = $request->input('unitIds');
        $unitIds = $unitIdsRaw ? explode("|",$unitIdsRaw) : [];
        $items = $request->input('items', 9);
        $min = [

            'price' => Unit::min('price'),
            'area_sqft' => Unit::min('area_sqft'),
            'bathrooms' => Unit::min('bathrooms'),
            'bedrooms' => Unit::min('bedrooms'),


        ];


        $max = [

            'price' => Unit::max('price'),
            'area_sqft' => Unit::max('area_sqft'),
            'bathrooms' => Unit::max('bathrooms'),
            'bedrooms' => Unit::max('bedrooms'),


        ];        

        // Security: allow only specific columns to be sortable

        if(empty($unitIds)){
            $units = Unit::orderBy($orderby, $order)->paginate($items)->appends($request->all());            
        }
        else{
            $units = Unit::orderBy($orderby, $order)->whereIn('id',$unitIds)->paginate($items)->appends($request->all());            
        }
        

        $cities = City::all();

        if($request->ajax()){
            $units_html = view('frontend.renders.units',compact('units','orderby','order'))->render();
            $units_pagination_links = $units->links()->render();

            return response()->json([
                'units_html' => $units_html,
                'units_pagination_links' => $units_pagination_links,
                'order_by' => $orderby
            ]);
        }

        $recomend = Unit::orderBy('created_at','asc')->where('status','complete')->where('is_sold',0)->limit(4)->get();


        return view('frontend.pages.units',compact('units','cities','orderby','order','min','max', 'recomend'));
    }

    public function perpageitems(Request $request)
    {
        $items = $request->query('items', 9); // default to 9
        $page = $request->query('page', 1);   // default to 1

        $unitIdsRaw = $request->input('unitIds');
        $unitIds = $unitIdsRaw ? explode("|", $unitIdsRaw) : [];

        $query = Unit::orderBy('created_at', 'asc');
        if (!empty($unitIds)) {
            $query->whereIn('id', $unitIds);
        }

        // Count total items and determine last valid page
        $total = $query->count();
        $lastPage = max(1, ceil($total / $items));

        // Clamp page to last valid page if current exceeds it
        $page = min($page, $lastPage);

        $units = $query->paginate($items, ['*'], 'page', $page)
                       ->appends(['items' => $items, 'unitIds' => $unitIdsRaw]);

        $units_html = view('frontend.renders.units', compact('units'))->render();
        $units_pagination_links = $units->links()->render();

        return response()->json([
            'units' => $units, 
            'units_html' => $units_html, 
            'units_pagination_links' => $units_pagination_links,
            'corrected_page' => $page // send corrected page to frontend
        ]);
    }



public function smart_search(Request $request)
{
    // Always wrap for safe JSON decoding
    $wrap = fn($s) => is_array($s) ? $s : json_decode(str_starts_with($s, '[') ? $s : "[$s]");

    $items = $request->input('per_page', 9);

    // Safely decode all filters regardless of AJAX or not
    $price = $wrap($request->input('price', []));
    $area_sqft = $wrap($request->input('area_sqft', []));
    $bathrooms = $wrap($request->input('bathrooms', []));
    $bedrooms = $wrap($request->input('bedrooms', []));


    // Min/Max for sliders or stats
    $min = [
        'price' => Unit::min('price'),
        'area_sqft' => Unit::min('area_sqft'),
        'bathrooms' => Unit::min('bathrooms'),
        'bedrooms' => Unit::min('bedrooms'),
    ];

    $max = [
        'price' => Unit::max('price'),
        'area_sqft' => Unit::max('area_sqft'),
        'bathrooms' => Unit::max('bathrooms'),
        'bedrooms' => Unit::max('bedrooms'),
    ];

    // Query
    $query = Unit::query();

    if ($request->filled('name')) {
        $query->whereHas('project', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->name . '%');
        });
    }

    if ($request->filled('city_id')) {
        $query->whereHas('project', function ($q) use ($request) {
            $q->where('city_id', $request->city_id);
        });
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if (!empty($price)) $query->whereBetween('price', $price);
    if (!empty($area_sqft)) $query->whereBetween('area_sqft', $area_sqft);
    if (!empty($bathrooms)) $query->whereBetween('bathrooms', $bathrooms);
    if (!empty($bedrooms)) $query->whereBetween('bedrooms', $bedrooms);

    if ($request->has('features') && is_array($request->features)) {
        $query->whereHas('project', function ($q) use ($request) {
            foreach ($request->features as $feature) {
                $q->whereJsonContains('features', $feature);
            }
        });
    }

    // Actual results
    $actual_units = (clone $query)->get();
    $units = $query->paginate($items)->appends($request->query());

    $units_html = view('frontend.renders.units', compact('units'))->render();
    $units_pagination_links = $units->links()->render();
    $allrequest = $request->all();

    // AJAX response
    if ($request->ajax()) {
        return response()->json([
            'units_html' => $units_html,
            'units' => $units,
            'actual_units' => $actual_units,
            'allrequest' => $allrequest,
            'units_pagination_links' => $units_pagination_links
        ]);
    }

    // Normal page load
    $cities = City::all();
    $recomend = Unit::where('status', 'complete')
        ->where('is_sold', 0)
        ->orderBy('created_at', 'asc')
        ->limit(4)->get();

    $order = 'asc';
    $orderby = 'created_at';

    return view('frontend.pages.units', compact(
        'units', 'allrequest', 'cities', 'min', 'max', 'recomend', 'order', 'orderby'
    ));
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $unit = Unit::findOrFail($id);
        $cities = City::all();

        $min = [

            'price' => Unit::min('price'),
            'area_sqft' => Unit::min('area_sqft'),
            'bathrooms' => Unit::min('bathrooms'),
            'bedrooms' => Unit::min('bedrooms'),


        ];


        $max = [

            'price' => Unit::max('price'),
            'area_sqft' => Unit::max('area_sqft'),
            'bathrooms' => Unit::max('bathrooms'),
            'bedrooms' => Unit::max('bedrooms'),


        ];

        $similar_units = Unit::where(function($q) use ($unit) {
            $q->whereHas('floor', function($query) use ($unit) {
                $query->where('floor', $unit->floor->floor);
            })
            ->orWhere('bedrooms', $unit->bedrooms)
            ->orWhere('bathrooms', $unit->bathrooms)
            ->orWhere('balconies', $unit->balconies)
            ->orWhere('area_sqft', $unit->area_sqft)
            ->orWhere('status', $unit->status)
            ->orWhere('price', $unit->price)
            ->orWhere('direction', $unit->direction);
        })
        ->whereHas('project', function($query) use ($unit) {
            foreach ($unit->project->features as $feature) {
                $query->whereJsonContains('features', $feature);
            }
        })->limit(4)
        ->get();

        $agent = Agent::where('designation','Sales Executive')->first();
        return view('frontend.pages.single_unit',compact('unit','cities','min', 'max','similar_units','agent'));
    }

    public function rate($id){

        $old_rate = Rate::where('unit_id',$id)->where('user_id',Auth::user()->id)->where('rated',true)->first();

        if($old_rate){

            $old_rate->delete();

            return response()->json(['success' => false]);
        }

        else{
            
            $rate = new Rate;

            $rate->user_id = Auth::user()->id;
            $rate->unit_id = $id;
            $rate->rated = true;

            $rate->save();

            return response()->json(['success' => true]);

        }



    }    

}
