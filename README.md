# Todo List Backend
* 使用Redis List push & pop up 嘗試解決race condition & 避免票卷超賣問題
## Environment
* Laravel 8.83.2
* PHP 7.4.28
* MariaDB 10.6.5

## Include
* [JWT](https://github.com/tymondesigns/jwt-auth) for authentication

## Initial

* `composer install`
* `cp .env.example .env` (if need it)
* `php artisan key:generate` (if need it)
* `php artisan jwt:secret`

## Test


## Seeder

* 建立admin帳號 `php artisan db:seed`

## Command

* 補票 `php artisan ticket:add {amount}`

## API & document

* [POST]   /api/accounts        新增帳戶
* [POST]   /api/login           登入取得jwt Token
* [POST]   /api/logout          登出 使Token失效

* [POST]   /api/tickets/          取票

* Document: https://documenter.getpostman.com/view/11440549/UVkqrEiF

## Logic

* 將Controller 邏輯拆分出Service & Repo
* Service      負責寫業務邏輯
* Repo         負責資料邏輯（Orm 查詢）
* Controller   負責接收參數與驗證




