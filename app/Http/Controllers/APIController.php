<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

// Model Usage
use App\Models\BookingDateTime;

use SoapClient, Log, Input;

class APIController extends Controller
{

    // Get available days
    function GetAvailableDays()
    {
        $id = Input::get('id');
        $year = Input::get('year');
        $month = Input::get('month');

        $client = new SoapClient("http://tangostudio.wicp.net:81/TangoStudio/WebServices/BookService.asmx?WSDL");

        $params = array(
            'year' => $year,
            'month' => $month,
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
                    [10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21],
                    $booked
                );
            }
        }

        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($i = 1; $i <= $days; $i++) {
            $day = sprintf('%d-%02d-%02d', $year, $month, $i);

            if(!array_key_exists($day, $available)){
                $available[$day] = [10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21];
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
