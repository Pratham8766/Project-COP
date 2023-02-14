<?PHP
function sendMessage() {
    $content      = array(
        "en" => "There's some important Notification on site!!"
    );
    
    
    // $hashes_array = array();
    // array_push($hashes_array, array(
    //     "id" => "visit-button",
    //     // "text" => "Like",
    //     // "icon" => "http://i.imgur.com/N8SN8ZS.png",
    //     "url" => "https://cmcop.000webhostapp.com/"
    // ));
    
    $headings      = array(
        "en" => "COP"
    );
    $fields = array(
        'app_id' => "e70e36b4-d07d-4173-86c1-15a7a56ab053",
        'included_segments' => array(
            'Subscribed Users'
        ),
        'data' => array(
            "foo" => "bar"
        ),
        'contents' => $content,
        'headings' => $headings,
        // 'web_buttons' => $hashes_array
    );
    
    $fields = json_encode($fields);
    // print("\nJSON sent:\n");
    // print($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic MWQ0NWQzYWUtODBiZi00NTY3LTkzYTMtY2E4ZWEzOWQ5NDJj'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}

// $response = sendMessage();
// $return["allresponses"] = $response;
// $return = json_encode($return);

// $data = json_decode($response, true);
// print_r($data);
// $id = $data['id'];
// print_r($id);

// print("\n\nJSON received:\n");
// print($return);
// print("\n");
