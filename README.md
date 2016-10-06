# Yandex Translate API (DevelNext)

> Скачать уже собранный пакет: [yandex](https://yadi.sk/d/0WFXkixfvYpkg)

Установить и подключить пакет "Yandex Translate API".

##### Пример использования:

```php
$yandex = new YandexTranslate('токен');
$yandex->translate("Hello yandex!", "en-ru"); // Вернет переведенный текст или произойдет иключение
```

##### Получить список поддерживаемых языков:

```php
$yandex->getLangs(); 
```

Токен можно получить [тут](https://tech.yandex.ru/keys/get/?service=trnsl)