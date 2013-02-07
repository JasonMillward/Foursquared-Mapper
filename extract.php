<?php
    require_once("FoursquareAPI.class.php");
    $client_key = "MKYBL5BOMLHF2OZXPMNGFBKW4PTIPR3NMFNK2NUJD3TVTDB2";
    $client_secret = "F2BM5D11CAYNWY5OC4V55CPZLAXWPKW0TYQ5RHZTI5G0XZL5";
    $auth_token = "B5QFECTKZK3LLFHRR1UTGXMKEMPNUOE00ZB2SZYLS4NZ4IMC";
    $foursquare = new FoursquareAPI($client_key,$client_secret);
    $foursquare->SetAccessToken($auth_token);
    $params = array("name"=>$name);

    $response = $foursquare->GetPrivate("users/self/checkins");
    $u = json_decode($response);

    $json = array();

    foreach( $u->response->checkins->items as $k => $v )
    {
        $tmp = array();
        $tmp['id']      = $k;
        $tmp['image']   = $v->venue->categories[0]->icon->prefix . "32.png";
        $tmp['name']    = $v->venue->name;
        $tmp['lat']     = $v->venue->location->lat;
        $tmp['lng']     = $v->venue->location->lng;
        $tmp['status']  = $v->shout;

        $json[] = $tmp;
    }

print json_encode($json);
?>
