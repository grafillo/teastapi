docker-compose up -d

docker exec -it task_app bash дальше внутри контейнера запускаем:

    composer update

    php artisan migrate

    php artisan db:seed


Зарегистрированный пользователь:
'password' => '12345678',
'email' => 'test@example.com'

php artisan test - запуск тестов делать внутри контейнера docker exec -it task_app bash

передача даты осуществляется в формате даты completion_date=2015-10-04 17:24:43


Примеры запросов:

GET http://localhost:8876/api/tasks?order=asc

GET http://localhost:8876/api/task/2

POST http://localhost:8876/api/task?tile=rename

PATCH http://localhost:8876/api/update/31?description=rename&completion_date=2015-10-04 17:24:43

DELETE http://localhost:8876/api/delete/2

POST http://localhost:8876/api/auth/login?email=test@example.com&password=12345678

