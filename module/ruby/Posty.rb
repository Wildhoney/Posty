require 'json'
require 'open-uri'

#
# @class Posty
# @author Adam Timberlake
#
class Posty

  #
  # @constant ZOOPLA_API_URL
  # @type string
  #
  ZOOPLA_API_URL = 'http://api.zoopla.co.uk/api/v1/property_listings.js?postcode=%s&api_key=%s'

  #
  # @constant ZOOPLA_API_KEY
  # @type string
  #
  ZOOPLA_API_KEY = 'nrb28jhb8vydfbf7769fkat3'

  #
  # @constant NOMINATIM_API_URL
  # @type string
  #
  NOMINATIM_API_URL = 'http://nominatim.openstreetmap.org/search?format=json&limit=5&q=%s&addressdetails=1'

  #
  # @property cache
  # @type string
  # @default nil
  #
  @cache = nil

  #
  # @property cache_document
  # @type string
  # @default nil
  #
  @cache_document = nil

  #
  # @method get_lat_lng
  # @param post_code string
  # @return string
  #
  def get_lat_lng(post_code)

  end

  #
  # @method set_cache
  # @param document string
  # @return nil
  #
  def set_cache(document)
    data = File.read document
    @cache = !data.empty? ? JSON.parse(data) : []
    @cache_document = document
  end

end

posty = Posty.new
posty.set_cache('../../cache/posty.json')
postCode = URI::encode 'NG10 4FP'
puts posty.get_lat_lng(postCode).to_json