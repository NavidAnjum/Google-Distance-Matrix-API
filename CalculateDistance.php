<?php

function calculateDistance($origin, $destination) {
    $apiKey = 'YOUR_API_KEY'; // Replace with your Google Maps API key
    $origin = urlencode($origin);
    $destination = urlencode($destination);
    
    // API URL
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$origin&destinations=$destination&key=$apiKey";
    
    // Initialize cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Decode the response
    $data = json_decode($response, true);
    
    if ($data['status'] == 'OK') {
        $distance = $data['rows'][0]['elements'][0]['distance']['text'];
        $duration = $data['rows'][0]['elements'][0]['duration']['text'];
        echo "Distance from $origin to $destination is $distance and will take approximately $duration.";
    } else {
        echo "Unable to calculate the distance.";
    }
}

// Example usage:
$origin = "New York, NY";
$destination = "Los Angeles, CA";
calculateDistance($origin, $destination);

?>
