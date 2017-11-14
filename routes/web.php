<?php
use Illuminate\Support\Facades\Mail;
use App\Mail\PassengerDetails;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tour','TourController@index')->name('tour');
Route::get('/tour/edit/{id}','TourController@edit')->name('tour.edit');
Route::get('/tour/create','TourController@create')->name('tour.create');
Route::post('/tour/save','TourController@save')->name('tour.save');
Route::post('/tour/add','TourController@add')->name('tour.add');

Route::get('/booking','BookingController@index')->name('booking');
Route::get('/booking/create/{t_id}','BookingController@create')->name('booking.create');
Route::post('/booking/add','BookingController@add')->name('booking.add');
Route::get('/booking/edit/{id}','BookingController@edit')->name('booking.edit');
Route::post('/booking/save','BookingController@save')->name('booking.save');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/send', function(){
	$data =[
		'title' =>'hi,',
		'content' => 'this is it',

	];

	Mail::send('emails.email',$data,function($m){

		$m->to('joesitu123@gmail.com','')->subject('Hello test');
		$m->from('bookings@webjetexclusives.com.au','Webjet Exclusives');
		//Webjet Exclusives <bookings@webjetexclusives.com.au>
	});

	//Mail::to('batman@batcave.io')->send(new KryptoniteFound);
	// ini_set("SMTP","ssl://smtp.gmail.com");
	// ini_set("smtp_port","465");
	// ini_set("username","joetomatotech@gmail.com");
	// ini_set("password","Tomato1234");

	// $to = "joesitu123@gmail.com";
	// $subject = "[Tomato Travel] Booking Notification - November 14, 2017";
	// $txt = "Hello world!";
	// $headers = "From: bookings@webjetexclusives.com.au";

	// mail($to,$subject,$txt,$headers);

});
