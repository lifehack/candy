<?php

header('Access-Control-Allow-Origin: *');

if (isset($_GET['from']) && isset($_GET['to'])) {
    $date = getdate($_GET['from']/1000);

    $year = $date['year'];
    $month = $date['mon'];

    $client = new SoapClient("http://tangostudio.wicp.net:81/TangoStudio/WebServices/BookService.asmx?wsdl");
    if (isset($_GET['studioNum'])) {
        $params = array('year' => $year, 'month' => $month, 'studioNum' => $_GET['studioNum']);
    } else {
        $params = array('year' => $year, 'month' => $month);
    }
    $result = $client->GetBooksOfMonth($params)->GetBooksOfMonthResult;

    $result_json = json_decode($result);

    $results_array = array();
    foreach ($result_json as $event) {
        $start_time = strtotime($event->StartTime) * 1000;
        $end_time = strtotime($event->FinishTime) * 1000;

        $result_array = array(
            'id' => $id++,
            'title' => $event->StartTime,
            'url' => '',
            "class" => "event-important",
            'start' => $start_time,
            'end' => $end_time
        );

        $results_array[] = $result_array;
    }

    echo json_encode(array('success' => 1, 'result' => $results_array));
} else {
    echo 'error';
}