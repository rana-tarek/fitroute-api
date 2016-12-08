<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Place;
use App\Bookmark;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use DB;

class PlaceController extends Controller
{

    public function getPopularPlaces()
    {
         $places = Place::orderBy('rate', 'desc')->with('subcategory', 'facilities', 'gallery')->take(10)->get()->toArray();
         return $this->response->array($places);
    }
    public function getPlaces(Request $request)
    {
        $inputs = $request->all();
        $limit = 500 / $inputs['zoom_level'];

        if($inputs['lng1'] >= 0 && $inputs['lng2'] < 0)
        {
            $places = Place::where(function($query) use ($inputs) {
                $query->whereBetween('longitude', [$inputs['lng1'], 180])
                    ->orWhereBetween('longitude', [180, $inputs['lng2']]);
            })->whereBetween('latitude', [$inputs['lat1'], $inputs['lat2']])->whereBetween('longitude', [$inputs['lng1'], $inputs['lng2']])->where('subcategory_id', $inputs['subcategory_id'])->orderBy('created_at', 'desc')->take($limit)->with('facilities')->with('gallery')->with('subcategory');
        }
        else{
            if($inputs['lng2'] < $inputs['lng1']) {
                $latitude = [$inputs['lat2'], $inputs['lat1']];
                $longitude = [$inputs['lng2'], $inputs['lng1']];
            }
            else {
                $latitude = [$inputs['lat1'], $inputs['lat2']];
                $longitude = [$inputs['lng1'], $inputs['lng2']];
            }
            
            $places = Place::whereBetween('latitude', $latitude)->whereBetween('longitude', $longitude);
            if($inputs['subcategory_id'] !=0)
            	$places = $places->where('subcategory_id', $inputs['subcategory_id']);
            $places = $places->orderBy('created_at', 'desc')->take($limit)->with('facilities')->with('gallery')->with('subcategory');
        }
        $places = $places->get()->toArray();
        if(count($places) > 0)
            return $this->response->array($places);
        else
            return response()->json(['success' => 'No places available in this area.'], 200);
    }

    public function search(Request $request)
    {
        $inputs = $request->all();
        $places = Place::select('places.*');

            if(isset($inputs['keyword']))
                $places = $places->where('name', 'LIKE', '%'.$inputs['keyword'].'%')->orWhere('address', 'LIKE', '%'.$inputs['keyword'].'%');

            if(isset($inputs['min_rate']) && isset($inputs['max_rate']))
                $places = $places->whereBetween('rate', [$inputs['min_rate'], $inputs['max_rate']]);

            if(isset($inputs['facilities']))
                $places = $places->join('place_facility', 'place_facility.place_id', '=', 'places.id')->whereIn('place_facility.facility_id', $inputs['facilities']);

            if(isset($inputs['min_distance']) && isset($inputs['max_distance']) && isset($inputs['lat']) && isset($inputs['lng']))
            {
                //$midpoints = $this->midpoint($inputs['lat1'], $inputs['lng1'], $inputs['lat2'], $inputs['lng2']);

                $nearest_places = $this->nearby($inputs['lat'], $inputs['lng'], $inputs['min_distance'], $inputs['max_distance']);
                if(count($nearest_places) > 0)
                {
                    $places_ids = [];
                    foreach ($nearest_places as $place) {
                        $places_ids[] = $place->id;
                    }

                    $places_ids = array_values($places_ids);
                    $places = $places->whereIn('places.id', $places_ids);
                }
                
            }
            $places = $places->with('subcategory', 'gallery', 'facilities')->distinct()->get()->toArray();
            if(count($places) > 0)
                return $this->response->array($places);
            else
                return response()->json(['success' => 'No places available'], 200);
    }

    public function getBookmarks(Request $request)
    {
        $bookmarks = Place::select('places.*')->with('subcategory', 'facilities', 'gallery')->join('bookmarks', 'bookmarks.place_id', '=', 'places.id')->where('bookmarks.user_id', '=', $request->get('user_id'))->get();
        if(count($bookmarks) > 0)
            return $this->response->array($bookmarks);
        else
            return response()->json(['error' => 'No bookmarks available'], 200);
    }

    public function addBookmark(Request $request)
    {
        $inputs = $request->all();
        if($inputs['user_id'] && $inputs['place_id'])
        {
            $user = Bookmark::firstOrCreate([
                'user_id'  => $inputs['user_id'],
                'place_id' => $inputs['place_id']
                ]);
        }
        return response()->json(['status' => 'success'], 200);
    }

    public function deleteBookmark(Request $request, $user_id, $place_id)
    {
        $inputs = $request->all();
        if($user_id && $place_id)
        {
            $user = Bookmark::where('bookmarks.user_id', '=', $user_id)->where('bookmarks.place_id', '=', $place_id)->delete();
        }
        return response()->json(['status' => 'success'], 200);
    }

    public function distance($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return ($miles * 1.609344);
    }

    public function nearby($lat, $lng, $min_distance, $max_distance)
    {
        return DB::select( DB::raw('SELECT id, latitude, longitude, ( 6371 * acos( cos( radians(:latitude) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(:longitude) ) + sin( radians(:latitude_2) ) * sin( radians( latitude ) ) ) ) AS distance FROM places HAVING distance BETWEEN :min_distance AND :max_distance ORDER BY distance'), 
            array(
                'latitude' => $lat,
                'latitude_2' => $lat,
                'longitude' => $lng,
                'min_distance' => $min_distance,
                'max_distance' => $max_distance
            )
        );
    }

    public function midpoint ($lat1, $lng1, $lat2, $lng2) {

        $lat1= deg2rad($lat1);
        $lng1= deg2rad($lng1);
        $lat2= deg2rad($lat2);
        $lng2= deg2rad($lng2);

        $dlng = $lng2 - $lng1;
        $Bx = cos($lat2) * cos($dlng);
        $By = cos($lat2) * sin($dlng);
        $lat3 = atan2( sin($lat1)+sin($lat2),
        sqrt((cos($lat1)+$Bx)*(cos($lat1)+$Bx) + $By*$By ));
        $lng3 = $lng1 + atan2($By, (cos($lat1) + $Bx));
        $pi = pi();
        $lat = ($lat3*180)/$pi;
        $lng = ($lng3*180)/$pi;
        return ['lat' => $lat,'lng' => $lng];
    }
    
}
