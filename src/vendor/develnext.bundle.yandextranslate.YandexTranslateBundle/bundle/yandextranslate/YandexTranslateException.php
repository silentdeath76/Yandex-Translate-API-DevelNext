<?php
    namespace bundle\yandextranslate;

    /**
     * Class YandexTranslateException
     */
    class YandexTranslateException extends \Exception {

        const
            UNDEFINED_ERROR                 = 0,
            EMPTY_API_KEY                   = 1;

        private $_message = [
            '401' => "Неправильный API-ключ",
            '402' => "API-ключ заблокирован",
            '404' => "Превышено суточное ограничение на объем переведенного текста",
            '413' => "Превышен максимально допустимый размер текста",
            '422' => "Текст не может быть переведен",
            '501' => "Заданное направление перевода не поддерживается",
            '0'   => "Неизвестная ошибка",
            '1'   => "API ключ пустой",
        ];




        final public function __construct($errorCode = Y_API::SUCCESS) {

            if(array_key_exists($errorCode, $this->_message)) {
                parent::__construct($this->_message[$errorCode], $errorCode);
            } else {
                parent::__construct(self::UNDEFINED_ERROR, $errorCode);
            }

        }
    }