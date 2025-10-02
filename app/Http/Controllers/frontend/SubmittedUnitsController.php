<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use App\Models\SubmittedUnit;
use App\Models\Agent;
use App\Models\Unit;
use Auth;

class SubmittedUnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user = Auth::user();

        $orderby = $request->input('orderby','created_at');
        $order = $request->input('order','asc');
        $unitIdsRaw = $request->input('unitIds');
        $unitIds = $unitIdsRaw ? explode("|",$unitIdsRaw) : [];
        $items = $request->input('items', 9);        



        if(empty($unitIds)){
            $units = SubmittedUnit::orderBy($orderby, $order)->where('user_id',$user->id)->paginate($items)->appends($request->all());            
        }
        else{
            $units = SubmittedUnit::orderBy($orderby, $order)->where('user_id',$user->id)->whereIn('id',$unitIds)->paginate($items)->appends($request->all());            
        }

        if($request->ajax()){

            $units_html = view('frontend.renders.user_units',compact('units','order','orderby'))->render();
            $units_pagination_links = $units->links()->render();

            return response()->json([
                'units_html' => $units_html, 
                'units_pagination_links' => $units_pagination_links,
                'order_by'=> $orderby
            ]);
        }
    $recomend = Unit::orderBy('created_at','asc')->where('status','complete')->where('is_sold',0)->limit(4)->get();        

        return view('frontend.pages.user_units',compact('units','order','orderby','recomend'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::all();

        return view('frontend.pages.unit_submit',compact('states'));
    }

    public function city_find($id){

        $cities = City::where('state_id',$id)->get();

        $cities_html = view('frontend.renders.cities',compact('cities'))->render();

        return response()->json(['cities_html' => $cities_html]);
    }

    public function area_find($id){

        $areas = Area::where('city_id',$id)->get();

        $areas_html = view('frontend.renders.areas',compact('areas'))->render();

        return response()->json(['areas_html' => $areas_html]);
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $unit = new SubmittedUnit;
        
        $unit->user_id = Auth::user()->id;
        $unit->state_id = $request->state_id;
        $unit->city_id = $request->city_id;
        $unit->area_id = $request->area_id;

        $photo = $request->file('photo');

        if($photo){

            $path = $photo->store('unit_profile_images' , 'public');

            $unit->user_photo = '/storage/' .$path;
        }

        $unit->number = $request->number;
        $unit->floor = $request->floor;

        $images = array();

        
        if($files=$request->file('image')){
            $i=0;
            foreach($files as $file){
                $name=time().rand(1,99).'.'.$file->extension();
                $fileNameExtract=explode('.',$name);
                $fileName=$fileNameExtract[0];
                $fileName.=$i;
                $fileName.='.';
                $fileName.=$fileNameExtract[1];
                $path = 'frontend/images/submittedunits/';
                $file->move($path,$fileName);
                $image_url = $path.$fileName;
                $images[]=$image_url;
                $i++;
            }
            $unit['image_path'] = implode("|",$images);
        }

        $videos = array_filter($request->video); 
        $videostring = implode(",",$videos);

        $unit->video_path = $videostring;      
        

        $unit->living_room = 1;
        $unit->dining_room = 1;
        $unit->bedrooms = $request->bedrooms;
        $unit->bathrooms = $request->bathrooms;
        $unit->balconies = $request->balconies;
        $unit->features = $request->features ?? [];
        $unit->area_sqft = $request->area_sqft;
        $unit->condition = $request->condition;
        $unit->type = $request->type;
        $unit->price = $request->price;
        $unit->build_date = $request->build_date;
        $unit->description = $request->description;
        $unit->phone = $request->phone;
        $unit->address = $request->address;


        $unit->save();

        return redirect()->route('user.units')->with('success','Property submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $unit = SubmittedUnit::findOrFail($id);
        $agent = Agent::where('designation','Sales Executive')->first();
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

    $features = $unit->features;
       
    $similar_units = Unit::where(function($q) use ($unit) {
        $q->whereHas('floor', function($query) use ($unit) {
            $query->where('floor', $unit->floor);
        })
        ->orWhere('bedrooms', $unit->bedrooms)
        ->orWhere('bathrooms', $unit->bathrooms)
        ->orWhere('balconies', $unit->balconies)
        ->orWhere('area_sqft', $unit->area_sqft)
        ->orWhere('price', $unit->price);
    })
    ->whereHas('project', function($query) use ($features) {
        $query->where(function ($q) use ($features) {
            foreach ($features as $feature) {
                $q->orWhereJsonContains('features', $feature);
            }
        });
    })
    ->limit(4)
    ->get();

        return view('frontend.pages.single_user_unit',compact('unit','agent','min','max','cities','similar_units'));
    }

    public function perpageitems(Request $request)
    {
        $items = $request->query('items', 9);
        $page = $request->query('page', 1);

        $unitIdsRaw = $request->input('unitIds');
        $unitIds = $unitIdsRaw ? explode("|", $unitIdsRaw) : [];

        $query = SubmittedUnit::orderBy('created_at', 'asc');
        if (!empty($unitIds)) {
            $query->whereIn('id', $unitIds);
        }

        $total = $query->count();
        $lastPage = max(1, ceil($total / $items));

        // Correct the page if it exceeds the last page
        $page = min($page, $lastPage);

        $units = $query->paginate($items, ['*'], 'page', $page)
                       ->appends(['items' => $items, 'unitIds' => $unitIdsRaw]);

        $units_html = view('frontend.renders.user_units', compact('units'))->render();
        $units_pagination_links = $units->links()->render();

        return response()->json([
            'units' => $units,
            'units_html' => $units_html,
            'units_pagination_links' => $units_pagination_links,
            'corrected_page' => $page, // send back actual page used
        ]);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unit = SubmittedUnit::findOrFail($id);

        $states = State::all();

        return view('frontend.pages.user_unit_edit',compact('unit','states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $unit = SubmittedUnit::findOrFail($id);
        
        $unit->user_id = Auth::user()->id;
        $unit->state_id = $request->state_id;
        $unit->city_id = $request->city_id;
        $unit->area_id = $request->area_id;

        $photo = $request->file('photo');
        $old_photo = $request->file('old_photo');

        if($photo){

            if($old_photo){

                unlink($old_photo);


            }

            $path = $photo->store('unit_profile_images' , 'public');

            $unit->user_photo = '/storage/' .$path;
        }

        $unit->number = $request->number;
        $unit->floor = $request->floor;

        $images = array();

        $old_images = explode("|",$unit->image_path);

        
        if($files=$request->file('image')){
            
            foreach($old_images as $img){
                unlink($img);
            }
            $i=0;
            foreach($files as $file){
                $name=time().rand(1,99).'.'.$file->extension();
                $fileNameExtract=explode('.',$name);
                $fileName=$fileNameExtract[0];
                $fileName.=$i;
                $fileName.='.';
                $fileName.=$fileNameExtract[1];
                $path = 'frontend/images/submittedunits/';
                $file->move($path,$fileName);
                $image_url = $path.$fileName;
                $images[]=$image_url;
                $i++;
            }
            $unit['image_path'] = implode("|",$images);
        }
        

        $unit->living_room = 1;
        $unit->dining_room = 1;
        $unit->bedrooms = $request->bedrooms;
        $unit->bathrooms = $request->bathrooms;
        $unit->balconies = $request->balconies;
        $unit->features = $request->features ?? [];
        $unit->area_sqft = $request->area_sqft;
        $unit->condition = $request->condition;
        $unit->type = $request->type;
        $unit->price = $request->price;
        $unit->build_date = $request->build_date;
        $unit->description = $request->description;
        $unit->phone = $request->phone;
        $unit->address = $request->address;


        $unit->save();

        return redirect()->route('user.units')->with('success','Property updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {

        $items = $request->input('items', 9);
        $page = $request->input('page', 1);                

        $unit = SubmittedUnit::findOrFail($id);

        $unit->delete();

        $query = SubmittedUnit::orderBy('created_at', 'asc');

        $total = $query->count();
        $lastPage = max(1, ceil($total / $items));

        // Clamp page to last valid page if current exceeds it
        $page = min($page, $lastPage);        

        $units = $query->paginate($items, ['*'], 'page', $page)->appends($request->all())
                ->withPath(url('/myunits/per-page')); // ✅ Use correct path here;
        $units_html = view('frontend.renders.user_units', compact('units'))->render();
        $units_pagination_links = $units->links()->render();

        return response()->json([
            'units_html' => $units_html,
            'units_pagination_links' => $units_pagination_links,
            'corrected_page' => $page, // send back actual page used

        ]);
        //return back()->with('success', 'property removed successfully!');
    }
}
