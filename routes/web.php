<?php

use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\TimelineController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['get.menu']], function () {
    Route::get('/', 'WelcomeController@welcome')->name('welcome');
    Route::get('/demo', function () {
        return view('demo.homepage');
    });
    Route::get('/contact', function () {
        return view('contato');
    });
    Route::get('/updates', function () {
        return view('updates');
    });


    Route::group(['middleware' => ['role:user']], function () {
        Route::get('/reports', function () {
            return view('dashboard.reports.index');
        });
        Route::get('/colors', function () {
            return view('dashboard.colors');
        });
        Route::get('/typography', function () {
            return view('dashboard.typography');
        });
        Route::get('/charts', function () {
            return view('dashboard.charts');
        });
        Route::get('/widgets', function () {
            return view('dashboard.widgets');
        });
        Route::get('/404', function () {
            return view('error.404');
        });
        Route::get('/500', function () {
            return view('error.500');
        });
        Route::prefix('base')->group(function () {
            Route::get('/breadcrumb', function () {
                return view('dashboard.base.breadcrumb');
            });
            Route::get('/cards', function () {
                return view('dashboard.base.cards');
            });
            Route::get('/carousel', function () {
                return view('dashboard.base.carousel');
            });
            Route::get('/collapse', function () {
                return view('dashboard.base.collapse');
            });

            Route::get('/forms', function () {
                return view('dashboard.base.forms');
            });
            Route::get('/jumbotron', function () {
                return view('dashboard.base.jumbotron');
            });
            Route::get('/list-group', function () {
                return view('dashboard.base.list-group');
            });
            Route::get('/navs', function () {
                return view('dashboard.base.navs');
            });

            Route::get('/pagination', function () {
                return view('dashboard.base.pagination');
            });
            Route::get('/popovers', function () {
                return view('dashboard.base.popovers');
            });
            Route::get('/progress', function () {
                return view('dashboard.base.progress');
            });
            Route::get('/scrollspy', function () {
                return view('dashboard.base.scrollspy');
            });

            Route::get('/switches', function () {
                return view('dashboard.base.switches');
            });
            Route::get('/tables', function () {
                return view('dashboard.base.tables');
            });
            Route::get('/tabs', function () {
                return view('dashboard.base.tabs');
            });
            Route::get('/tooltips', function () {
                return view('dashboard.base.tooltips');
            });
        });
        Route::prefix('buttons')->group(function () {
            Route::get('/buttons', function () {
                return view('dashboard.buttons.buttons');
            });
            Route::get('/button-group', function () {
                return view('dashboard.buttons.button-group');
            });
            Route::get('/dropdowns', function () {
                return view('dashboard.buttons.dropdowns');
            });
            Route::get('/brand-buttons', function () {
                return view('dashboard.buttons.brand-buttons');
            });
        });
        Route::prefix('icon')->group(function () {  // word: "icons" - not working as part of adress
            Route::get('/coreui-icons', function () {
                return view('dashboard.icons.coreui-icons');
            });
            Route::get('/flags', function () {
                return view('dashboard.icons.flags');
            });
            Route::get('/brands', function () {
                return view('dashboard.icons.brands');
            });
        });
        Route::prefix('notifications')->group(function () {
            Route::get('/alerts', function () {
                return view('dashboard.notifications.alerts');
            });
            Route::get('/badge', function () {
                return view('dashboard.notifications.badge');
            });
            Route::get('/modals', function () {
                return view('dashboard.notifications.modals');
            });
        });
        Route::resource('message', 'NotesController');

        // account e tenant
        Route::post('/tenant/{id}', 'InstitutionsController@tenant')->name('tenant');
        Route::resources([
            'account' => InstitutionsController::class,
        ]);

        //profile
        Route::get('/profile', 'ProfileController@index')->name('profile');
        Route::get('profile/change', 'ProfileController@change')->name('changeLang');
        Route::post('/profile/update', 'ProfileController@updateProfile')->name('profile.update');

        // settings
        Route::get('settings', 'ConfigSystemController@index')->name('settings');
        Route::get('settings/system', 'ConfigSystemController@indexSystem')->name('indexSystem');
        Route::post('settings/updatesystem', 'ConfigSystemController@updateSystem')->name('settings.updateSystem');
        Route::get('settings/meta', 'ConfigSystemController@indexMeta')->name('indexMeta');
        Route::post('settings/updatemeta', 'ConfigSystemController@updateMeta')->name('settings.updateMeta');
        Route::get('settings/email', 'ConfigSystemController@indexEmail')->name('indexEmail');
        Route::post('settings/updateemail', 'ConfigSystemController@updateEmail')->name('settings.updateEmail');
        Route::get('settings/social', 'ConfigSystemController@indexSocial')->name('indexSocial');
        Route::post('settings/updatesocial', 'ConfigSystemController@updateSocial')->name('settings.updateSocial');
        Route::resource('settings/roles',        'RolesController');
        Route::resource('settings/mail',        'MailController');

        //dash
        Route::resource('dashboard',        'DashController');
        Route::resource('home',        'HomeController');

        //importar e exportar pessoas
        Route::resource('settings/backup', 'BackupController');
        Route::get('export',        'BackupController@export')->name('export');
        Route::post('import',        'BackupController@import')->name('import');

        //calendar
        Route::get('/calender', [FullCalenderController::class, 'index']);
        Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);

        //tema para consulta
        Route::get('/thema', function () {
            return view('dashboard.buttons.them');
        });

        //sistema financeiro
        Route::any('historic-search', 'BalanceController@searchHistoric')->name('historic.search');
        Route::get('historic', 'BalanceController@historic')->name('admin.historic');

        Route::post('withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');
        Route::get('withdraw', 'BalanceController@withdraw')->name('balance.withdraw');

        Route::get('depositar', 'BalanceController@depositar')->name('balance.depositar');
        Route::post('deposit', 'BalanceController@depositStore')->name('deposit.store');

        Route::get('/select2-autocomplete-people', 'BalanceController@dataAjax');
        Route::get('financial', 'BalanceController@index')->name('deposit.balance');
        Route::get('financial/{id}', 'BalanceController@show')->name('financial.show');

        //post e timeline em testes
        Route::get('posts', 'PostController@posts')->name('posts');
        Route::post('ajaxRequest', 'PostController@ajaxRequest')->name('ajaxRequest');
        Route::get('timeline/', 'TimelineController@index')->name('timeline.index');
        Route::get('timeline/{post}', [TimelineController::class, 'show'])->name('timeline.show');
        Route::post('timeline/{post}/reaction', [ReactionsController::class, 'toggle'])->middleware('auth');
    });

    Auth::routes();

    //pessoas
    Route::get('people', 'PeoplesController@index')->name('people.index');
    Route::get('people/create', 'PeoplesController@create')->name('people.create');
    Route::post('peoples', 'PeoplesController@store')->name('people.store');
    Route::get('people/{id}/edit', 'PeoplesController@edit')->name('people.edit');
    Route::put('people/{id}', 'PeoplesController@update')->name('people.update');
    Route::any('people-search', 'PeoplesController@searchHistoric')->name('people.search');
    Route::delete('people/{id}/{user_id}', 'PeoplesController@destroy')->name('people.destroy');

    //pessoas_precadastro
    Route::get('peopleList', 'Peoples_PrecadastroController@index')->name('peopleList.index');
    Route::any('peoplesList/{id}', 'Peoples_PrecadastroController@update')->name('peopleList.update');
    Route::get('peopleList/{id}/edit', 'Peoples_PrecadastroController@edit')->name('peopleList.edit');
    Route::any('peopleList-search', 'Peoples_PrecadastroController@searchHistoric')->name('peopleList.search');
    Route::delete('peopleList/{id}', 'Peoples_PrecadastroController@reprovar')->name('peopleList.reprovar');

    //grupos
    Route::get('group', 'GroupsController@index')->name('group.index');
    Route::get('group/create', 'GroupsController@create')->name('group.create');
    Route::post('group', 'GroupsController@store')->name('group.store');
    Route::post('grouppessoa', 'GroupsController@storepeoplegroup')->name('group.storepeoplegroup');
    Route::get('group/{id}/edit', 'GroupsController@edit')->name('group.edit');
    Route::get('group/{id}', 'GroupsController@show')->name('group.show');
    Route::put('group/{id}', 'GroupsController@update')->name('group.update');
    Route::any('group-search', 'GroupsController@searchHistoric')->name('group.search');
    Route::delete('group/{id}', 'GroupsController@destroy')->name('group.destroy');
    Route::delete('group/{id}/delete', 'GroupsController@destroygroup')->name('group.destroygroup');
    
    //pre-cadastro - wizard
    Route::get('wizard', 'WizardController@create')->name('wizard.create');
    Route::post('wizard', 'WizardController@store')->name('wizard.store');
    Route::any('wizard-search', 'WizardController@searchAccount')->name('wizard.search');

    //reports
    Route::any('report/financial/search', 'ReportController@searchFinancial')->name('financial.search');
    Route::get('report/financial', 'ReportController@Financial')->name('financial.Financial');
    Route::any('report/people/search', 'ReportController@searchPeople')->name('people.search');
    Route::get('report/people', 'ReportController@People')->name('people.Financial');
    Route::any('report/group/search', 'ReportController@searchGroup')->name('group.search');
    Route::get('report/group', 'ReportController@Group')->name('group.Financial');

    //logs
    Route::get('logs', 'LogsController@index')->name('logs.index');



    Route::resource('resource/{table}/resource', 'ResourceController')->names([
        'index'     => 'resource.index',
        'create'    => 'resource.create',
        'store'     => 'resource.store',
        'show'      => 'resource.show',
        'edit'      => 'resource.edit',
        'update'    => 'resource.update',
        'destroy'   => 'resource.destroy'
    ]);

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/thema', function () {
            return view('dashboard.buttons.them');
        });
        Route::get('/license', 'InstitutionsController@license_index')->name('license_index');
        Route::resource('bread',  'BreadController');   //create BREAD (resource)
        Route::resource('users',        'UsersController')->except(['create', 'store']);
        Route::get('prepareSend/{id}',        'MailController@prepareSend')->name('prepareSend');
        Route::post('mailSend/{id}',        'MailController@send')->name('mailSend');
        Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');
        Route::prefix('menu/element')->group(function () {
            Route::get('/',             'MenuElementController@index')->name('menu.index');
            Route::get('/move-up',      'MenuElementController@moveUp')->name('menu.up');
            Route::get('/move-down',    'MenuElementController@moveDown')->name('menu.down');
            Route::get('/create',       'MenuElementController@create')->name('menu.create');
            Route::post('/store',       'MenuElementController@store')->name('menu.store');
            Route::get('/get-parents',  'MenuElementController@getParents');
            Route::get('/edit',         'MenuElementController@edit')->name('menu.edit');
            Route::post('/update',      'MenuElementController@update')->name('menu.update');
            Route::get('/show',         'MenuElementController@show')->name('menu.show');
            Route::get('/delete',       'MenuElementController@delete')->name('menu.delete');
        });
        Route::prefix('menu/menu')->group(function () {
            Route::get('/',         'MenuController@index')->name('menu.menu.index');
            Route::get('/create',   'MenuController@create')->name('menu.menu.create');
            Route::post('/store',   'MenuController@store')->name('menu.menu.store');
            Route::get('/edit',     'MenuController@edit')->name('menu.menu.edit');
            Route::post('/update',  'MenuController@update')->name('menu.menu.update');
            Route::get('/delete',   'MenuController@delete')->name('menu.menu.delete');
        });
        Route::prefix('media')->group(function () {
            Route::get('/',                 'MediaController@index')->name('media.folder.index');
            Route::get('/folder/store',     'MediaController@folderAdd')->name('media.folder.add');
            Route::post('/folder/update',   'MediaController@folderUpdate')->name('media.folder.update');
            Route::get('/folder',           'MediaController@folder')->name('media.folder');
            Route::post('/folder/move',     'MediaController@folderMove')->name('media.folder.move');
            Route::post('/folder/delete',   'MediaController@folderDelete')->name('media.folder.delete');;

            Route::post('/file/store',      'MediaController@fileAdd')->name('media.file.add');
            Route::get('/file',             'MediaController@file');
            Route::post('/file/delete',     'MediaController@fileDelete')->name('media.file.delete');
            Route::post('/file/update',     'MediaController@fileUpdate')->name('media.file.update');
            Route::post('/file/move',       'MediaController@fileMove')->name('media.file.move');
            Route::post('/file/cropp',      'MediaController@cropp');
            Route::get('/file/copy',        'MediaController@fileCopy')->name('media.file.copy');
        });
    });
    Route::group(['middleware' =>  ['role:admin']], function () {
        Route::get('log', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    });
});
