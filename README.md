docker-compose up -d

docker exec -it task_app bash

composer update

php artisan migrate

php artisan db:seed


Зарегистрированный пользователь:
'password' => '12345678',
'email' => 'test@example.com'

php artisan test - запуск тестов

передача даты осуществляется в формате даты completion_date=2015-10-04 17:24:43


Роуты

Route::get('/tasks', [ApiController::class, 'getTasks']);

Route::get('/task/{task}', [ApiController::class, 'showTask']);

Route::group([

    'middleware' => 'auth',
    
], function ($router) {

    Route::post('/task', [ApiController::class, 'createTask']);
    
    Route::patch('/update/{task}', [ApiController::class, 'updateTask']);
    
    Route::delete('/delete/{task}', [ApiController::class, 'deleteTask']);
