<?php

/**
 * @class Posty
 * @author Adam Timberlake
 */
class Posty {

    /**
     * @constant ZOOPLA_API_URL
     * @type string
     */
    const ZOOPLA_API_URL = 'http://api.zoopla.co.uk/api/v1/property_listings.js?postcode=%s&api_key=%s';

    /**
     * @constant ZOOPLA_API_KEY
     * @type string
     */
    const ZOOPLA_API_KEY = 'nrb28jhb8vydfbf7769fkat3';

    /**
     * @constant NOMINATIM_API_URL
     * @type string
     */
    const NOMINATIM_API_URL = 'http://nominatim.openstreetmap.org/search?format=json&limit=5&q=%s&addressdetails=1';

    /**
     * @method getLatLng
     * @param string $postCode
     * @return string
     */
    public function getLatLng($postCode) {

        // Remove all of the whitespace, and limit to 7 characters.
        $postCode = str_replace(' ', '', $postCode);
        $postCode = substr($postCode, 0, 7);
        $latLng = null;

        if (strlen($postCode) <= 4) {
            // Use Zoopla if we only have a partial post code.
            $latLng = $this->_fromZoopla($postCode);
        }

        if (!$latLng) {
            // Otherwise we'll use Nominatim.
            $latLng = $this->_fromNominatim($postCode);
        }

        return $latLng;

    }

    /**
     * @method _fromZoopla
     * @param string $postCode
     * @return array
     * @private
     */
    private function _fromZoopla($postCode) {

        // Fetch the data and then decode the JSON.
        $url  = sprintf(self::ZOOPLA_API_URL, $postCode, self::ZOOPLA_API_KEY);
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

    /**
     * @method _fromNominatim
     * @param string $postCode
     * @return array
     * @private
     */
    private function _fromNominatim($postCode) {

        // Fetch the JSON data from Nominatim.
        $url  = sprintf(self::NOMINATIM_API_URL, $this->_addSpaces($postCode));
        $data = file_get_contents($url);
        $data = json_decode($data);

        return array('latitude' => (float) $data[0]->lat, 'longitude' => (float) $data[0]->lon);

    }

    /**
     * @method _addSpaces
     * @param string $postCode
     * @return string
     */
    private function _addSpaces($postCode) {
        $splitFrom = (strlen($postCode) === 7) ? 4 : 3;
        return trim(chunk_split($postCode, $splitFrom, ' '));
    }

}

$posty = new Posty();
$postCode = urlencode($_GET['postCode']);
echo json_encode($posty->getLatLng($postCode));