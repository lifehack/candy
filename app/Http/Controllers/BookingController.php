<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input, Response, View, Log;
use Session;
use DB;
use DateTime;
use SoapClient;

// Declare Models to be used
use App\Models\Shop;
use App\Models\Customer;
use App\Models\Appointment;
use App\Models\BookingDateTime;


class BookingController extends Controller
{

    /**
     * Function to retrieve the index page
     * User selects package to continue
     *
     **/
    public function getIndex()
    {
        $shops = Shop::all();

        return view('showPackages', ['shops' => $shops]);
    }

    /**
     * Function to retrieve datepicker
     *
     * User selects date + time to continue
     **/
    public function getCalendar($pid)
    {

        //Add package to the session data
        Session::put('packageID', $pid);
        $package = Package::find($pid);

        // This groups all booking times by date so we can give a list of all days available.
        $data = [
            'packageName' => $package->package_name,
            'days' => BookingDateTime::all()
        ];

        return view('BookAppointment', $data);
    }

    /**
     * Function to get customer details after Date & Time pick
     *
     **/
    public function getDetails($aptID)
    {

        // Put the passed date time ID into the session
        Session::put('aptID', $aptID);
        $package = Package::find(Session::get('packageID'));

        // Get row of date id
        $dateRow = BookingDateTime::find($aptID);
        $dateFormat = new DateTime($dateRow->booking_datetime);
        $dateFormat = $dateFormat->format('g:i a \o\n l, jS \o\f F Y');
        Session::put('selection', $dateRow->booking_datetime);

        $data = [
            'pid' => Session::get('packageID'),
            'package_name' => $package->package_name,
            'dateRow' => $dateRow,
            'dateFormat' => $dateFormat,
            'aptID' => $aptID,
        ];

        return view('customerInfo', $data);
    }

    /**
     * Function to post customer info and present confirmation view
     * User Confirms appointment details to continue
     **/
    public function anyConfirm()
    {

        $input = Input::all();
        $package = Package::find(Session::get('packageID'));

        $appointmentInfo = [
            "package_id" => Session::get('packageID'),
            "package_name" => $package->package_name,
            "package_time" => $package->package_time,
            "datetime" => Session::get('selection'),
            "fname" => $input['fname'],
            "lname" => $input['lname'],
            "number" => $input['number'],
            "email" => $input['email'],
            "updates" => isset($input['newsletterBox']) ? 'Yes' : 'No'
        ];

        Session::put('appointmentInfo', $appointmentInfo);

        //Check if newsletterbox is checked, then add shit to database
        if (isset($input['newsletterBox'])) {
            Session::put('updates', '1');
        } else {
            Session::put('updates', '0');
        }

        $packageName = Package::where('id', $input['pid'])->pluck('package_name');
        return View::make('confirm')->with('appointmentInfo', $appointmentInfo);
    }

    /**
     * Function to create the appointment, scrub the database, and send out an email confirmation
     *
     * User interaction is complete
     *
     **/
    public function anyConfirmed()
    {

        // When this boolean is set to True, instead of deleting all appointment times for the package duration
        // It will instead remove all times up to the end of the day, and continue to the next day until the package
        // time is done.
        $overlapDays = FALSE;
        $info = Session::get('appointmentInfo');
        $startTime = new DateTime($info['datetime']);
        $endTime = new DateTime($info['datetime']);
        date_add($endTime, date_interval_create_from_date_string($info['package_time'] . ' hours'));
        $newCustomer = Customer::addCustomer();
        $startTime = $startTime->format('Y-m-d H:i');
        $endTime = $endTime->format('Y-m-d H:i');

        // Create the appointment with this new customer id
        Appointment::addAppointment($newCustomer);

        if ($overlapDays) {
            // Remove hours up to the last hour of the day, then continue to the next day
            // If necessary

            // PSEUDO CODE
            // We will get the last appointment of the day and see if it's smaller than the package time

            // If the last appointment occurs beyond the package duration, we delete like normal

            // If the last appointment occurs before the package duration
            // We subtract the hours we remove from the package duration to get remaining time
            // Then we go to the next day with appointment times and remove enough appointments
            // To make clearance for the package duration.

        } else {
            // Remove all dates conflicting with the appointment duration
            BookingDateTime::timeBetween($startTime, $endTime)->delete();
        }

        return View::make('success');
    }

    /**
     * Function to retrieve times available for a given date
     *
     * View is returned in JSON format
     *
     **/
    public function getTimes()
    {
        $selectedDay = Input::get('selectedDay');
        $id = Input::get('id');

        $client = new SoapClient("http://tangostudio.wicp.net:81/TangoStudio/WebServices/BookService.asmx?WSDL");

        $params = array(
            'year' => '2016',
            'month' => '03',
            'studioNum' => $id . '店'
        );

        $result = $client->GetBooksOfMonth($params)->GetBooksOfMonthResult;
        $booked_json = json_decode($result, true);

        $available = array();
        foreach ($booked_json as $booking) {
            $start = getdate(strtotime($booking['StartTime']));

            $end = getdate(strtotime($booking['FinishTime']));

            $day = date("Y-m-d", strtotime($booking['StartTime']));

            $count = $end['hours'] - $start['hours'];

            $booked = array();
            for ($i = 0; $i < $count; $i++) {
                array_push($booked, $start['hours'] + $i);
            }

            if (array_key_exists($day, $available)) {
                $available[$day] = array_diff($available[$day], $booked);
            } else {
                $available[$day] = array_diff(
                    [9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
                    $booked
                );
            }
        }

        $json = array();
        $id = 1;
        foreach ($available as $key => $data) {
            foreach ($data as $hour) {

                if ($key == $selectedDay) {
                    $book = sprintf('%s %d:00:00', $key, $hour);

                    $available_record = array(
                        'id' => $id++,
                        'booking_datetime' => $book,
                        'created_at' => $book,
                        'updated_at' => $book
                    );

                    array_push($json, $available_record);
                }
            }
        }

        return response()->json($json);
    }
}

