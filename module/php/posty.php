<?php

/**
 * @class Posty
 * @author Adam Timberlake
 */
class Posty {

    /**
     * @constant API_URL
     * @type string
     */
    const API_URL = 'http://api.zoopla.co.uk/api/v1/property_listings.js?postcode=%s&api_key=%s';

    /**
     * @constant API_KEY
     * @type string
     */
    const API_KEY = 'nrb28jhb8vydfbf7769fkat3';

    /**
     * @method getLatLng
     * @param string $postCode
     * @return array
     */
    public function getLatLng($postCode) {

        // Fetch the data and then decode the JSON.
        $url  = sprintf(self::API_URL, $postCode, self::API_KEY);
        $data = file_get_contents($url);
        $data = (object) json_decode($data);

        // Calculate the latitude/longitude from the bounding box.
        $boundingBox   = $data->bounding_box;
        $longitudeDiff = $boundingBox->longitude_max - $boundingBox->longitude_min;
        $longitude     = $boundingBox->longitude_max - $longitudeDiff;
        $latitudeDiff  = $boundingBox->latitude_max - $boundingBox->latitude_min;
        $latitude      = $boundingBox->latitude_max - $latitudeDiff;

        return array('latitude' => $latitude, 'longitude' => $longitude);

    }

}

$posty    = new Posty();
$postCode = urlencode($_GET['postCode']);
echo json_encode($posty->getLatLng($postCode));