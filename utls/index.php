<?php

    // $url = 'https://jsonplaceholder.typicode.com/posts';

    // $json_string = json_encode($data);

    // $headers = array (
    //     "Access-Control-Allow-Headers: *",
    //     "Content-Type: application/json; charset=utf-8",
    //     "Authorization: Bearer long token here" ,
    //     "Access-Control-Allow-Headers: Accept",
    //     "Access-Control-Allow-Origin: http://localhost"   
    // );

    // $channel = curl_init($url);
    // curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($channel, CURLOPT_CUSTOMREQUEST, "PUT");
    // curl_setopt($channel, CURLOPT_HTTPHEADER, $headers);
    // curl_setopt($channel, CURLOPT_POSTFIELDS, $json);
    // curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($channel, CURLOPT_CONNECTTIMEOUT, 10);

    // $response = curl_exec($channel);
    // $statusCode = curl_getInfo($channel, CURLINFO_HTTP_CODE);
    // curl_close($channel);

    // http_response_code($statusCode);
    // if ( $statusCode != 200 ){
    //    echo "Status code: {$statusCode} \n".curl_error($channel);
    //    echo $statusCode;
    // } else {
    //    echo $response;
    // }


    $curl = curl_init();

    $url = 'https://stackoverflow.com/questions/50381348/extract-urls-anchor-texts-from-links-on-a-webpage-fetched-by-php-or-curl';
    $search_string = "";

    // $payload = json_encode( array( "customer"=> $result ) );
    // curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
    // curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    // $json_string = json_encode( $result , JSON_PRETTY_PRINT);

    curl_setopt($curl, CURLOPT_URL , $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER , false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER , true);

    $result =  curl_exec($curl);

    //echo $result;

    getLink($result);

    function getLink($data){
        // Hide HTML warnings
        libxml_use_internal_errors(true);
        $dom = new DOMDocument;
        if($dom->loadHTML($data, LIBXML_NOWARNING)){
        // echo Links and their anchor text
        echo '<pre>';
        echo "Link\tAnchor\n";
        foreach($dom->getElementsByTagName('a') as $link) {
            $href = $link->getAttribute('href');
            $anchor = $link->nodeValue;
            echo $href,"\t",$anchor,"\n";
        }
            // echo '</pre>';
        }else{
            echo "Failed to load html.";
    
        }
    }


    curl_close($result);
