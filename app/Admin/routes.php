<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

     $router->get('/', 'HomeController@index')->name('home');
     $router->get('/position', 'HomeController@position')->name('position');

     $router->get('/map', 'HomeController@getLocalisation')->name('map');



     //impression des données
     $router->get('/printList_malade', 'HomeController@pdfData')->name('print_data');
     $router->get('/printList_infirmier', 'HomeController@pdfListe_infirmier');
     //impression des données



     //resources
     $router->resource('users', UserController::class);
     $router->resource('articles', ArticleController::class);
     $router->resource('article-types', ArticleTypeController::class);

     $router->resource('infirmiers', Alpha\InfiermierController::class);
     $router->resource('malades', Alpha\MaladeController::class);
     $router->resource('consultations', Alpha\ConsultationController::class);
     $router->resource('seances', Alpha\SeanceController::class);
     $router->resource('traitements', Alpha\TraitementController::class);

     $router->resource('utilisateurs', Alpha\UtilisateurController::class);

     $router->resource('localisations', Alpha\LocalisationController::class);

});



