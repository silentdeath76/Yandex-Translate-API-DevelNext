<?php
    namespace bundle\yandextranslate;

    /**
     * Class YandexTranslateException
     * @package bundle\yandextranslate
     */
    class YandexTranslateException extends \Exception
    {

        const
            UNDEFINED_ERROR = 0,
            EMPTY_API_KEY = 1;

        /**
         * @var array
         */
        private $_message = [
            '401' => "Неправильный API-ключ",
            '402' => "API-ключ заблокирован",
            '404' => "Превышено суточное ограничение на объем переведенного текста",
            '413' => "Превышен максимально допустимый размер текста",
            '422' => "Текст не может быть переведен",
            '501' => "Заданное направление перевода не поддерживается",
            '0' => "Неизвестная ошибка",
            '1' => "API ключ пустой",
        ];


        /**
         * YandexTranslateException constructor.
         * @param int|string $errorCode
         */
        final public function __construct($errorCode = YandexTranslate::SUCCESS)
        {

            if (array_key_exists($errorCode, $this->_message)) {
                parent::__construct($this->_message[$errorCode], $errorCode);
            } else {
                parent::__construct($this->_message[self::UNDEFINED_ERROR], $errorCode);
            }

        }
    }