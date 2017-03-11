<?php
namespace bundle\yandextranslate;

use
    bundle\http\HttpResponse,
    bundle\http\HttpClient;

/**
 * Class YandexTranslate
 * @package bundle\yandextranslate
 */
class YandexTranslate
{
    const
        HOST = "https://translate.yandex.net/api/v1.5/tr.json/",
        SUCCESS = 200;

    /**
     * @var string
     */
    protected $apiKey = null;

    /**
     * @var HttpClient
     */
    protected $http = null;


    /**
     * YandexTranslate constructor.
     * @param string $apiKey
     * @throws YandexTranslateException
     */
    public function __construct($apiKey)
    {
        $this->setApiKey($apiKey);
        $this->http = new HttpClient();
    }


    /**
     * @param string $apiKey
     * @throws YandexTranslateException
     */
    public function setApiKey($apiKey)
    {
        $apiKey = trim($apiKey);

        if (isset($apiKey) && !empty($apiKey)) {
            $this->apiKey = $apiKey;
        } else {
            Throw new YandexTranslateException(YandexTranslateException::EMPTY_API_KEY);
        }

    }


    /**
     * Перевод текста
     * @param string $translateString
     * @param string $lang
     * @return string
     * @throws YandexTranslateException
     */
    public function translate($translateString, $lang = "en-ru")
    {

        $url = sprintf('translate?key=%s&lang=%s&format=plain', $this->apiKey, $lang);

        $response = $this->httpPost($url, ["text" => $translateString]);

        if (is_array($response) && $response['code'] == self::SUCCESS) {
            return $response['text'][0];
        }

        Throw new YandexTranslateException($response['code']);
    }

    /**
     * Возвращает список поддерживаемых языков
     * Return a list supported langs
     * @param string $ui
     * @return array
     * @throws YandexTranslateException
     */
    public function getLangs($ui = "ru")
    {
        $url = sprintf('getLangs?key=%s&ui=%s', $this->apiKey, $ui);
        $response = $this->httpPost($url);

        if (is_array($response) && isset($response['langs'])) {
            return $response['langs'];
        }

        Throw new YandexTranslateException($response['code']);
    }


    /**
     * Отправка POST запроса
     * @param $url
     * @param array $postData
     * @return array
     */
    final private function httpPost($url, $postData = [])
    {

        $httpResponse = $this->http->post(self::HOST . $url, $postData);
        return json_decode($httpResponse->body(), true);

    }
}