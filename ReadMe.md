Этот проект предоставляет API для управления заказами и исполнителями с использованием Laravel 8/11 и Laravel Passport для аутентификации.

## Установка

### 1. Клонирование репозитория

Сначала клонируйте репозиторий на ваш локальный компьютер:

2. Установка зависимостей
Перейдите в директорию проекта и установите все зависимости с помощью Composer:

cd project-name
composer install

3. Настройка окружения
Скопируйте файл .env.example в .env и отредактируйте его:
cp .env.example .env
Задайте ваши значения для базы данных и других параметров окружения, таких как ключи OAuth и т.д.:

env
Копировать
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:yourbase64key
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=имя бд
DB_USERNAME=имя user
DB_PASSWORD=пароль бд

PASSPORT_PASSWORD_GRANT_CLIENT_ID=your_client_id
PASSPORT_PASSWORD_GRANT_CLIENT_SECRET=your_client_secret

4. Генерация ключа приложения
Для того чтобы приложение могло работать, вам нужно будет сгенерировать ключ для вашего приложения:
php artisan key:generate

5. Миграции и сиды
Выполните миграции для создания таблиц в базе данных:
php artisan migrate
Если необходимо, вы можете создать тестовые данные с помощью сидов:
php artisan db:seed

6. Установка Passport
Для использования аутентификации через Laravel Passport выполните команду:
php artisan passport:install


API Эндпоинты
Аутентификация (Laravel Passport)
Все маршруты с префиксом /api/passport

Метод	URI	Описание
POST	/api/passport/token	Получить токен

POST	/api/passport/token/refresh	Обновить токен

GET	/api/passport/tokens	Получить все токены пользователя

DELETE	/api/passport/tokens/{token_id}	Отозвать токен

POST	/api/passport/logout	Выйти из системы

GET	/api/passport/clients	Получить список клиентов
PUT	/api/passport/clients/{client_id}	Обновить клиента
DELETE	/api/passport/clients/{client_id}	Удалить клиента
GET	/api/passport/scopes	Получить список доступных scopes
GET	/api/passport/personal-access-tokens	Получить список личных токенов
POST	/api/passport/personal-access-tokens	Создать личный токен
DELETE	/api/passport/personal-access-tokens/{token_id}	Удалить личный токен

Управление сессиями
Метод	URI	Описание
GET	/api/sessions	Получить все активные сессии
DELETE	/api/sessions/{token_id}	Завершить сессию по ID токена

Работа с заказами
Метод	URI	Описание
POST	/api/orders	Создать заказ

Назначение исполнителя
Метод	URI	Описание
POST	/api/orders/{orderId}/assign-worker	Назначить исполнителя на заказ

Фильтрация исполнителей
Метод	URI	Описание
GET	/api/workers/filter	Получить исполнителей, которые не отказались хотя бы от одного из переданных типов заказов

