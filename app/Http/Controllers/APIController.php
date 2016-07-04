<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

// Model Usage
use App\Models\BookingDateTime;
use App\Models\OABooks;

use SoapClient, Log, Input;

class APIController extends Controller
{

    // Get available days
    function GetAvailableDays()
    {
        $id = Input::get('id');
        $year = Input::get('year');
        $month = Input::get('month');

        $startDay = date('Y-m-d', strtotime('first day of '.$year.'-'.$month));
        $endDay = date('Y-m-d', strtotime('last day of '.$year.'-'.$month));
        $shop = $id.'店';

        $books = OABooks::select('BookStartTime', 'BookFinishTime')
        ->where('隶属店号', $shop)
        ->where('BookStartTime', '>=', $startDay)
        ->where('BookFinishTime', '<=', $endDay)
        ->get();

        $available = array();
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($i = 1; $i <= $days; $i++) {
            $day = sprintf('%d-%02d-%02d', $year, $month, $i);

            $available[$day] = [10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21];
        }
        foreach ($books as $book) {
            $start = getdate(strtotime($book['BookStartTime']));
            $end = getdate(strtotime($book['BookFinishTime']));

            $day = date("Y-m-d", strtotime($book['BookStartTime']));

            $count = $end['hours'] - $start['hours'];

            $booked = array();
            for ($i = 0; $i < $count; $i++) {
                array_push($booked, $start['hours'] + $i);
            }

            $available[$day] = array_diff($available[$day], $booked);
            if (empty($available[$day]) || count($available[$day]) == 0) {
                unset($available[$day]);
            }
        }

        $json = array();
        $id = 1; 
        foreach ($available as $key => $data) {
            foreach ($data as $hour) {
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

        return response()->json($json);
    }

}
