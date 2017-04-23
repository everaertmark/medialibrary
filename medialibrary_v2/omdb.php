$eventsOutput = [];

// OMDB API
$omdbUrl = "http://www.omdbapi.com/?t=inception";

$curl = curl_init($omdbUrl);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_HTTPGET, true);

$output =  json_decode(curl_exec($curl));

var_dump($output);
//if($output->pagination->object_count > 0)
//{
//    foreach ($output->events as $eventOutput)
//    {
//        $start_time = $eventOutput->start->local;
//        $new_start_time = explode('T', $start_time);
//        $start_time = $new_start_time[0] . ' ' . $new_start_time[1];
//        $event =
//            [
//                "name" => $eventOutput->name->text,
//                "description" => $eventOutput->description->text,
//                "start_time" => $start_time,
//                "url" => $eventOutput->url
//            ];
//
//        $eventsOutput[] = $event;
//    }
//}

curl_close($curl);