<?php
    namespace bundle\yandextranslate;
    
    /**
     * Абстрактный класс помошник
     */
    abstract class Y_API {
        /**
         * response code
         * @var int success
         */
        const SUCCESS = 200;

        /**
         * @var string
         */
        protected $apiKey = null;

        /**
         * @var HttpClient
         */
        protected $http = null;





        /**
         * Заменяет значения в строке key(replace) value(replacement)
         * @param array $replace
         * @return string
         */
        final protected function urlReplacer ($replace) {

            $keys = array_map('strtoupper', array_keys($replace));
            return str_replace($keys, $replace, static::BASE_URL);

        }

        /**
         * Отправка POST запроса
         * @param $url
         * @param $translateString
         * @return array
         */
        final protected function httpPost ($url, $postData = []) {

            $httpResponse = $this->http->post($url, $postData);
            return json_decode($httpResponse->body(), true);

        }




    }