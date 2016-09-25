<?php
    namespace bundle\yandextranslate;

    use 
        bundle\http\HttpResponse,
        bundle\http\HttpClient;

    /**
     * Class YandexTranslate
     */
    class YandexTranslate extends Y_API {
        const HOST = "https://translate.yandex.net/api/v1.5/tr.json/";
        const BASE_URL = 'translate?key={API_KEY}&lang={LANG}&format=plain';


        /**
         * YandexTranslate constructor.
         * @param string $apiKey
         * @throws YandexTranslateException
         */
        public function __construct ($apiKey) {
            $this->setApiKey($apiKey);
            $this->http = new HttpClient();
        }


        /**
         * @param string $apiKey
         * @throws YandexTranslateException
         */
        public function setApiKey($apiKey) {
            $apiKey = trim($apiKey);

            if(isset($apiKey) && !empty($apiKey)) {
                $this->apiKey = $apiKey;
            } else {
                Throw new YandexTranslateException( YandexTranslateException::EMPTY_API_KEY );
            }

        }


        /**
         * Перевод текста
         * @param string $translateString
         * @param string $lang
         * @return string
         * @throws YandexTranslateException
         */
        public function translate ($translateString, $lang = "en-ru") {
            $url = self::HOST . $this->urlReplacer([
                        '{API_KEY}' => $this->apiKey,
                        '{LANG}' => $lang
                    ]);

            $response = $this->httpPost($url, ["text" => trim($translateString)]);

            if(is_array($response) && $response['code'] == self::SUCCESS) {
                return $response['text'][0];
            }

            Throw new YandexTranslateException( $response['code'] );
        }


        /**
         * Возвращает список поддерживаемых языков
         * @param string $ui
         * @return array
         * @throws YandexTranslateException
         */
        public function getLangs ($ui = "ru") {
            $url = self::HOST . 'getLangs?key=' . $this->apiKey . '&ui=' . $ui;
            $response = $this->httpPost($url);

            if(is_array($response) && isset($response['langs'])) {
                return $response['langs'];
            }

            Throw new YandexTranslateException( $response['code'] );
        }
    }