<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TourRequest;
use App\Tour;
use App\TourDate;


class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tours = Tour::all();
        return view('tour.index')->with(compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tour.add_tour');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tour= Tour::find($id);
        $tour->tour_dates;
        return view('tour.edit_tour')->with(compact('tour')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add(TourRequest $request)
    {

       // echo $request['name'];
        if(!empty($request->all()))
        {
            $new_tour = new Tour();
            $new_tour->name = $request['name'];
            $new_tour->itinerary = $request['itinerary'];   
            $new_tour->save();
        
        $the_tour = Tour::where(['name'=>$request['name'],
                                'itinerary'=>$request['itinerary']])->firstOrFail();

        if(!empty($request->input('new_dates')))
        {
            $new_dates = $request->input('new_dates');
            $added = $this->add_dates($the_tour['id'],$new_dates); 
        }

                    return redirect()->action('TourController@index');
        }
    }

    public function save(TourRequest $request)
    {
        //return count($request->get('new_dates'));


        //$new_dates='';
        $tour =  $request->all();

        $curr_tour = Tour::find($tour['id']);
        $curr_tour->name = $tour['name'];
        $curr_tour->itinerary = $tour['itinerary'];
        $curr_tour->save();

       if(!empty($tour['tour_dates']))
       {
        $update_dates = $tour['tour_dates'];
        $dates = $curr_tour->tour_dates;
        foreach($dates as $date)
        {
            $date->status = $update_dates[$date->id]['status'];
            $date->save();
        }
        }

        if(!empty($tour['new_dates']))
        {
            $added = $this->add_dates($tour['id'], $tour['new_dates']); 
        }

            return redirect()->action('TourController@index');

    }


    private function add_dates($id,$dates)
    {
        if($id)
            foreach($dates as $date)
            {
                $new_date = new TourDate();
                $new_date->tour_id = $id;
                $new_date->date =  $date;
                $new_date->save();
            }

            return true;
        }
    }
