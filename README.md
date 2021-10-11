<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Установка приложения
- Клонировать репозиторий
- ```shell cp .env.example .env```
- заполнить `.env`
- ```shell php artisan key:generate```
- ```shell php artisan migrate --seed```
- ```shell npm run dev```

Для разворачивания в docker можно использовать инструмент Sail, поставляемый из коробки.

```shell composer require laravel/sail --dev```

Все использованные инструменты из коробки. Кастомные конфиги или переменные отсутствуют. 

## Планировщик
для работы отложенный транзакций требуется планировщик, 
для его работы потребуется запись в Cron

```* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1```

для проверки корректности исполнения транзакций, можно дернуть комадну из консоли,
в нужное время

```shell php artisan transaction:execute```

## Тестирование
сиды заводят 10 пользователей с кредами вида:
`user1@example.org password`

автоматическое тестирование запускается

```shell .\vendor\bin\phpunit```
