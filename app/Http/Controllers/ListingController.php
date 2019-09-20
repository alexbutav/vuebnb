<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;

// https://vuejsdevelopers.com/2017/08/06/vue-js-laravel-full-stack-ajax/
class ListingController extends Controller
{
    private function add_meta_data($collection, $request) {
        return $collection->merge([ 'path' => $request->getPathInfo() ]);
    }

    private function get_listing(Listing $listing) {
        $model = $listing->toArray();
        for($i = 1; $i < 5; $i++) {
            $model['image_' . $i] = asset("images/$listing->id/Image_$i.jpg");
        }
        // collect - Laravel Collection 
        // array-like wrapper
        return collect(['listing' => $model]);
    }

    //
    public function get_listing_api(Listing $listing) {
        $data = $this->get_listing($listing);
        return response()->json($data);
    }

    public function get_listing_web(Listing $listing, Request $request) {
        $data = $this->get_listing($listing);
        $data = $this->add_meta_data($data, $request);
        return view('app', ['data' => $data]);
    }

    public function get_listing_summaries() {
        $collection = Listing::all([ 'id', 'address', 'title', 'price_per_night' ]);
        $collection->transform(function($listing) {
            $listing->thumb = asset("images/$listing->id/Image_1_thumb.jpg");
            return $listing;
        });
        return collect(['listings' => $collection->toArray()]);
    }

    public function get_home_api() {
        $data = $this->get_listing_summaries();
        return response()->json($data);
    }

    public function get_home_web(Request $request) {
        $data = $this->get_listing_summaries();
        $data = $this->add_meta_data($data, $request);
        return view('app', ['data' => $data]);
    }
}
