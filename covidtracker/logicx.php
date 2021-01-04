<?php 
    $dataJson = file_get_contents('https://pomber.github.io/covid19/timeseries.json');
 
    $data = json_decode($dataJson, true);
    $day = count($data["Afghanistan"])-1;
    $confirmed = 0;
    $active = 0;
    $recovered = 0;
    $deceased = 0;
    foreach($data as $key=>$value){
        $confirmed += $value[$day]["confirmed"];
        $recovered += $value[$day]["recovered"];
        $deceased += $value[$day]["deaths"];
    }
    $active = number_format($confirmed - $deceased - $recovered);
    $confirmed = number_format($confirmed);
    $recovered = number_format($recovered);
    $deceased = number_format($deceased);

    
    
?>
