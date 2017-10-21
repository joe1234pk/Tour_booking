<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookingRequest;
use App\Booking;
use App\Passenger;
use App\Tour;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bookings = Booking::withCount('passengers')->get();
        foreach($bookings as $booking)
        {
            $booking->tour;
        }
        return view('booking.index')->with(compact('bookings'));
        //return $bookings;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($t_id)
    {
        //
        $tour = Tour::find($t_id);
        $tour['available_dates'] = $tour->tour_dates->where('status',1);

        //return $tour;
        return view('booking.add_booking')->with((compact('tour')));
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
        $booking = Booking::findOrFail($id);
        $booking->passengers;
        $booking['available_dates'] = $booking->tour->tour_dates->where('status',1);
        //return $booking;

        return view('booking.edit_booking')->with(compact('booking'));    
    }
    public function save(BookingRequest $request)
    {
         //return $request->all();
        $booking = Booking::findOrFail($request->id);
        $booking->tour_date = $request->tour_date;
        $booking->status = $request->status;
        if(!empty($request->passengers))
        {         
            $update_passengers = $request->passengers;
            $sync_ids = array();
            foreach($update_passengers as $key=>$passenger)
            {

               $sync_ids[] = $passenger['id'];
               $booking->passengers[$key]->update([
                'given_name' => $update_passengers[$key]['given_name'],
                'surname' => $update_passengers[$key]['surname'],
                'email' => $update_passengers[$key]['email'],
                'mobile' => $update_passengers[$key]['mobile'],
                'passport' => $update_passengers[$key]['passport'],
                'birth_date' => $update_passengers[$key]['birth_date'],
            ]);

               if($update_passengers[$key]['special_request'])
               {
                $booking->passengers()->save($passenger,['special_request'=>$update_passengers[$key]['special_request']]);
            }
        }
    }
    else
    {
        $booking->passengers()->detach();
    }
    if(!empty($request->new_passengers))

    {
        $new_passengers = $request->new_passengers;
        $this->add_new_passenger_to_booking($booking,$new_passengers);

    }

    return redirect()->action('BookingController@index');

}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }

    public function add (BookingRequest $request){

        //return $request->all();
        $tour = Tour::findOrFail($request->tour_id);

        if(isset($tour))
        {
            $new_booking =  new Booking;
            $new_booking->tour_id = $tour->id;
            $new_booking->tour_date = $request->tour_date;
            $new_booking->save();
        }

        if($request->new_passengers)
        {
           $this->add_new_passenger_to_booking($new_booking,$request->new_passengers);
       }

       return redirect()->action('BookingController@index');

   }

   private function add_new_passenger_to_booking($booking,$new_passengers){

       //var_dump($booking, $new_passengers);

     for($i=0;$i<count($new_passengers['given_name']);$i++) {
         $booking->passengers()->save(new Passenger(
            ['given_name' => $new_passengers['given_name'][$i],
            'surname' => $new_passengers['surname'][$i],
            'email' => $new_passengers['email'][$i],
            'mobile' => $new_passengers['mobile'][$i],
            'passport' => $new_passengers['passport'][$i],
            'birth_date' => $new_passengers['birth_date'][$i]
        ]));
              // ;
     }

 }

}
