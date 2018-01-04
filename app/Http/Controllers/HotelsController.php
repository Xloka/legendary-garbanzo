<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;


class HotelsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request){
        $client = new Client();
        $res = $client->get('http://api.myjson.com/bins/tl0bp');
        $hotels = \GuzzleHttp\json_decode($res->getBody(), true)['hotels'];
        if($request->has('q')){
            $hotels = $this->search($hotels, $request->get('q'));
        }
        if($request->has('sortby')){
            $hotels = $this->sortHotels($hotels, explode(',',$request->get('sortby')));
        } else {
            //default sort by name
            usort($hotels,array($this, 'sortByName'));
        }
        return ['hotels'=>$hotels];
    }


    /**
     * @param $hotels
     * @param $query
     * @return mixed
     */
    private function search($hotels, $query){
        return array_filter($hotels, function ($hotel) use ($query) {
                        $minPrice = count(explode(':$',$query)) > 1 ? floatval(explode(':$',$query)[0]) : null;
                        $maxPrice = count(explode(':$',$query)) > 1 ? floatval(explode(':$',$query)[1]) : null;
                        $dateStart = (count(explode(':',$query)) > 1 && strtotime(explode(':',$query)[0])) ? strtotime(explode(':',$query)[0]) : null;
                        $dateEnd = (count(explode(':',$query)) > 1 && strtotime(explode(':',$query)[1])) ? strtotime(explode(':',$query)[1]) : null;
                        if (stripos($hotel['name'], $query) !== false || stripos($hotel['city'], $query) !== false || ($hotel['price'] >= $minPrice && $hotel['price'] <= $maxPrice)) {
                            return true;
                        }
                        foreach ($hotel['availability'] as $dates){
                            if ( strtotime($dates['from']) >= $dateStart && strtotime($dates['to']) <= $dateEnd ){
                                return true;
                            }
                        }
                        return false;
                });
    }


    /**
     * @param $hotels
     * @param $sortBy
     * @return mixed
     */
    private function sortHotels($hotels, $sortBy){
        foreach ( $sortBy as $value ){
            usort($hotels,array($this, 'sortBy'.$value));
        }
        return $hotels;
    }

    private function sortByName($a,$b){
        return $a['name']>$b['name'];
    }
    private function sortByPrice($a,$b){
        return $a['price']>$b['price'];
    }

}