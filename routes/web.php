<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('employee/get_juniors','Admin\EmployeeController@getJunoiorEmployee')->name('employee.get_juniors');
Route::get('employee/get_juniors','Admin\EmployeeController@getJunoiorEmployee')->name('employee.get_juniors');
Route::get('reporter/get_reporter','Admin\Employeecontroller@getPrimaryReport')->name('reporter.get_reporter');

Route::get('employee/index1','Admin\EmployeeController@index1')->name('employee.index1');
/*********************************************************************************
 *                                  LARASNAP
 *********************************************************************************/
Route::group(['namespace' => '\LaraSnap\LaravelAdmin\Controllers', 'middleware' => ['ManyRoles:1|2|3', 'web', 'auth', 'check-userstatus'], 'roles' => '' ], function(){
    Route::group(['middleware' => ['check-roles'] ], function(){

        /** DASHBOARD ROUTES **/
        /*Route::get('/', 'DashboardController')->name('dashboard');*/
        /** DASHBOARD ROUTES **/

        /** USER ROUTES **/
        Route::group(['prefix' => 'users', 'exculde' => ['users.filter', 'users.store', 'users.update', 'users.bulkdestroy', 'users.assignrole_store','users.change_password']], function(){
            /*Route::get('/','UserController@index')->name('users.index');
            Route::post('/','UserController@index')->name('users.filter');
            Route::get('create','UserController@create')->name('users.create');
            Route::post('create','UserController@store')->name('users.store');
            Route::get('{user}/edit','UserController@edit')->name('users.edit');
            Route::put('{user}','UserController@update')->name('users.update');*/
            Route::get('{user}','UserController@show')->name('users.show');
            Route::delete('{user}','UserController@destroy')->name('users.destroy');
            Route::delete('/','UserController@bulkdestroy')->name('users.bulkdestroy');
            Route::get('{user}/roles','UserController@assignRoleCreate')->name('users.assignrole_create');
            Route::post('{user}/roles','UserController@assignRoleStore')->name('users.assignrole_store');
        });
        /** USER ROUTES **/

        /** PROFILE ROUTES **/
        /* Route::group(['prefix' => 'profile', 'exculde' => ['profile.edit', 'profile.update']], function(){
             Route::get('/', 'ProfileController@edit')->name('profile.edit');
             Route::put('{user}', 'ProfileController@update')->name('profile.update');
         });*/
        /** PROFILE ROUTES **/

        /** ROLE ROUTES **/
        Route::group(['prefix' => 'roles', 'exculde' => ['roles.filter', 'roles.store', 'roles.update', 'roles.assignpermission_store', 'roles.assignscreen_store']], function(){
            Route::get('/','RoleController@index')->name('roles.index');
            Route::post('/','RoleController@index')->name('roles.filter');
            Route::get('create','RoleController@create')->name('roles.create');
            Route::post('create','RoleController@store')->name('roles.store');
            Route::get('{role}/edit','RoleController@edit')->name('roles.edit');
            Route::put('{role}','RoleController@update')->name('roles.update');
            Route::delete('{role}','RoleController@destroy')->name('roles.destroy');
            Route::get('{role}/permissions','RoleController@assignPermissionCreate')->name('roles.assignpermission_create');
            Route::post('{role}/permissions','RoleController@assignPermissionStore')->name('roles.assignpermission_store');
            Route::get('{role}/screens','RoleController@assignScreenCreate')->name('roles.assignscreen_create');
            Route::post('{role}/screens','RoleController@assignScreenStore')->name('roles.assignscreen_store');
        });
        /** ROLE ROUTES **/

        /** PERMISSION ROUTES **/
        Route::group(['prefix' => 'permissions', 'exculde' => ['permissions.filter', 'permissions.store', 'permissions.update']], function(){
            Route::get('/','PermissionController@index')->name('permissions.index');
            Route::post('/','PermissionController@index')->name('permissions.filter');
            Route::get('create','PermissionController@create')->name('permissions.create');
            Route::post('create','PermissionController@store')->name('permissions.store');
            Route::get('{permission}/edit','PermissionController@edit')->name('permissions.edit');
            Route::put('{permission}','PermissionController@update')->name('permissions.update');
            Route::delete('{permission}','PermissionController@destroy')->name('permissions.destroy');
        });
        /** PERMISSION ROUTES **/

        /** SCREEN ROUTES **/
        Route::group(['prefix' => 'screens', 'exculde' => ['screens.filter', 'screens.store', 'screens.update', 'screens.assignrole_store', 'screens.modules', 'screens.modules_store', 'screens.modules_destroy']], function(){
            Route::get('/','ScreenController@index')->name('screens.index');
            Route::post('/','ScreenController@index')->name('screens.filter');
            Route::get('create','ScreenController@create')->name('screens.create');
            Route::post('create','ScreenController@store')->name('screens.store');
            Route::get('{screen}/edit','ScreenController@edit')->name('screens.edit');
            Route::put('{screen}','ScreenController@update')->name('screens.update');
            Route::delete('{screen}','ScreenController@destroy')->name('screens.destroy');
            Route::get('{screen}/roles','ScreenController@assignRoleCreate')->name('screens.assignrole_create');
            Route::post('{screen}/roles','ScreenController@assignRoleStore')->name('screens.assignrole_store');
            Route::get('modules','ScreenController@getModules')->name('screens.modules');
            Route::post('modules','ScreenController@storeModule')->name('screens.modules_store');
            Route::delete('modules/{module}','ScreenController@destroyModule')->name('screens.modules_destroy');
        });
        /** SCREEN ROUTES **/

        /** MODULE ROUTES **/
        Route::group(['prefix' => 'modules', 'exculde' => ['modules.filter', 'modules.store', 'modules.update']], function(){
            Route::get('/','ModuleController@index')->name('modules.index');
            Route::post('/','ModuleController@index')->name('modules.filter');
            Route::get('create','ModuleController@create')->name('modules.create');
            Route::post('create','ModuleController@store')->name('modules.store');
            Route::get('{module}/edit','ModuleController@edit')->name('modules.edit');
            Route::put('{module}','ModuleController@update')->name('modules.update');
            Route::delete('{module}','ModuleController@destroy')->name('modules.destroy');
        });
        /** MODULE ROUTES **/

        /** MENU ROUTES **/
        Route::group(['prefix' => 'menus', 'exculde' => ['menus.filter', 'menus.store', 'menus.update', 'menus.order', 'menus.item_store', 'menus.item_update', 'menus.item.destory']], function(){
            Route::get('/','MenuController@index')->name('menus.index');
            Route::post('/','MenuController@index')->name('menus.filter');
            Route::get('create','MenuController@create')->name('menus.create');
            Route::post('create','MenuController@store')->name('menus.store');
            Route::get('{menu}/edit','MenuController@edit')->name('menus.edit');
            Route::put('{menu}','MenuController@update')->name('menus.update');
            Route::delete('{menu}','MenuController@destroy')->name('menus.destroy');
            Route::get('{menu}/builder','MenuController@builder')->name('menus.builder');
            Route::post('{menu}/order','MenuController@orderItem')->name('menus.order');
            Route::post('{menu}/item','MenuController@itemStore')->name('menus.item_store');
            Route::put('{menu}/item','MenuController@itemUpdate')->name('menus.item_update');
            Route::delete('{menu}/item', 'MenuController@itemDestroy')->name('menus.item.destory');
        });
        /** MENU ROUTES **/

        /** CATEGORY ROUTES **/
        Route::group(['prefix' => 'categories', 'exculde' => ['p_categories.filter', 'p_categories.store', 'p_categories.update', 'categories.filter', 'categories.store', 'categories.update']], function(){
            Route::get('/','CategoryParentController@index')->name('p_categories.index');
            Route::post('/','CategoryParentController@index')->name('p_categories.filter');
            Route::get('create','CategoryParentController@create')->name('p_categories.create');
            Route::post('create','CategoryParentController@store')->name('p_categories.store');
            Route::get('{p_category}/edit','CategoryParentController@edit')->name('p_categories.edit');
            Route::put('{p_category}','CategoryParentController@update')->name('p_categories.update');
            Route::delete('{p_category}','CategoryParentController@destroy')->name('p_categories.destroy');

            Route::get('{p_category}','CategoryController@index')->name('categories.index');
            Route::post('{p_category}','CategoryController@index')->name('categories.filter');
            Route::get('{p_category}/create','CategoryController@create')->name('categories.create');
            Route::post('{p_category}/create','CategoryController@store')->name('categories.store');
            Route::get('/{p_category}/{category}/edit','CategoryController@edit')->name('categories.edit');
            Route::put('{p_category}/{category}','CategoryController@update')->name('categories.update');
            Route::delete('{p_category}/{category}','CategoryController@destroy')->name('categories.destroy');
        });
        /** CATEGORY ROUTES **/

        /** SETTING ROUTES **/
        // Route::group(['prefix' => 'settings', 'exculde' => ['settings.store']], function(){
        //     Route::get('/','SettingController@create')->name('settings.create');
        //     Route::post('/','SettingController@store')->name('settings.store');
        // });
        /** SETTING ROUTES **/

        /** DOCUMENT ROUTES **/
        Route::get('guide','DocsController@index')->name('docs.index');
        Route::get('/icons','DocsController@icons')->name('docs.icons');

    });

    /** ERROR ROUTES **/
    Route::group(['prefix' => 'error'], function(){
        Route::get('/401','ErrorController@noPermission')->name('errors.401');
    });
    /** ERROR ROUTES **/

});
/**** LARASNAP ROUTES END ****/

/*********************************************************************************
 *                                  ADMIN
 *********************************************************************************/
//Route::group(['namespace' => 'App\Http\Controllers','prefix' => 'admin'], function () {
Route::group(['middleware' => ['ManyRoles:1|2|3', 'web', 'auth', 'check-userstatus'], 'roles' => ''], function () {
    Route::group(['middleware' => ['check-roles'] ], function(){
        /**** PROFILE ****/
        Route::group(['prefix' => 'profile', 'exculde' => ['profile.edit', 'profile.update']], function(){
            Route::get('/', 'Admin\ProfileController@edit')->name('profile.edit');
            Route::put('emp/{user}', 'Admin\ProfileController@update')->name('profile.update');
        });

        /**** USER MANAGEMENT ****/
        Route::group(['prefix' => 'admin','exculde' => ['users.filter', 'users.store', 'users.update','users.change_password','users.update_password']], function(){
            Route::get('/','Admin\UserController@index')->name('users.index');
            Route::post('/','Admin\UserController@index')->name('users.filter');
            Route::get('create','Admin\UserController@create')->name('users.create');
            Route::post('store','Admin\UserController@store')->name('users.store');
            Route::get('{user}/edit','Admin\UserController@edit')->name('users.edit');
            Route::put('{user}','Admin\UserController@update')->name('users.update');
            Route::get('{user}','Admin\UserController@show')->name('users.show');
            Route::delete('{user}','Admin\UserController@destroy')->name('users.destroy');
            Route::delete('/','Admin\UserController@bulkdestroy')->name('users.bulkdestroy');
            Route::get('user/change_password','Admin\UserController@createPassword')->name('users.change_password');
            Route::put('{user}/update_password','Admin\UserController@updatePassword')->name('users.update_password');

        });

        /** PROFILE ROUTES **/

        /**** EMPLOYEE ****/
        Route::group(['prefix' => 'employee', 'exculde' => ['employee.filter', 'employee.update', 'employee.bulkdestroy','employee.store','employee.getemployee']], function(){
            Route::get('/','Admin\EmployeeController@index')->name('employee.index');
            Route::post('/','Admin\EmployeeController@index')->name('employee.filter');
            Route::get('create','Admin\EmployeeController@create')->name('employee.create');
            Route::post('store','Admin\EmployeeController@store')->name('employee.store');
            Route::get('{user}/edit','Admin\EmployeeController@edit')->name('employee.edit');
            Route::put('{user}','Admin\EmployeeController@update')->name('employee.update');
            Route::get('{user}','Admin\EmployeeController@show')->name('employee.show');
            Route::delete('{user}','Admin\EmployeeController@destroy')->name('employee.destroy');
            Route::delete('/','Admin\EmployeeController@bulkdestroy')->name('employee.bulkdestroy');
            Route::get('employee/getemployee','Admin\EmployeeController@getemployee')->name('employee.getemployee');
            Route::get('{user}/edit','Admin\EmployeeController@EmployeeEdit')->name('admin.employee_edit');
            Route::put('{user}','Admin\EmployeeController@EmployeeUpdate')->name('admin.employee_update');

        });

        /** DASHBOARD ROUTES **/
        Route::get('/', 'Admin\DashboardController')->name('dashboard');
        /** DASHBOARD ROUTES **/

        Route::group(['prefix' => 'leave', 'exculde' => ['leave.filter', 'leave.update', 'leave.bulkdestroy','leave.store']], function() {
            Route::get('/', 'Admin\LeaveController@index')->name('leave.index');
            Route::post('/', 'Admin\LeaveController@index')->name('leave.filter');
            Route::get('create', 'Admin\LeaveController@create')->name('leave.create');
            Route::post('store', 'Admin\LeaveController@store')->name('leave.store');
            Route::get('{user}/edit', 'Admin\LeaveController@edit')->name('leave.edit');
            Route::put('{user}', 'Admin\LeaveController@update')->name('leave.update');
            Route::get('{user}', 'Admin\LeaveController@show')->name('leave.show');
            Route::delete('{user}', 'Admin\LeaveController@destroy')->name('leave.destroy');
            Route::post('{user}/statusupdate', 'Admin\LeaveController@statusChange')->name('leave.status_update');
        });
        Route::group(['prefix' => 'leave_policy', 'exculde' => []], function() {
            Route::get('/', 'Admin\LeavePolicyController@index')->name('leave_policy.index');
            Route::post('/', 'Admin\LeavePolicyController@index')->name('leave_policy.filter');
            Route::get('create', 'Admin\LeavePolicyController@create')->name('leave_policy.create');
            Route::post('store', 'Admin\LeavePolicyController@store')->name('leave_policy.store');
            Route::get('{user}/edit', 'Admin\LeavePolicyController@edit')->name('leave_policy.edit');
            Route::put('{user}', 'Admin\LeavePolicyController@update')->name('leave_policy.update');
            Route::get('{user}', 'Admin\LeavePolicyController@show')->name('leave_policy.show');
            Route::delete('{user}', 'Admin\LeavePolicyController@destroy')->name('leave_policy.destroy');

            
        });

            /** Announcement Route **/
        Route::group(['prefix' => 'announcement','exculde' => ['announcement.filter', 'announcement.store', 'announcement.update','announcement.bulkdestroy','announcement.show']], function(){
            Route::get('/','Admin\AnnouncementController@index')->name('announcement.index');
            Route::post('/','Admin\AnnouncementController@index')->name('announcement.filter');
            Route::get('create','Admin\AnnouncementController@create')->name('announcement.create');
            Route::post('store','Admin\AnnouncementController@store')->name('announcement.store');
            Route::get('{user}/edit','Admin\AnnouncementController@edit')->name('announcement.edit');
            Route::put('{user}','Admin\AnnouncementController@update')->name('announcement.update');
            Route::get('{user}','Admin\AnnouncementController@show')->name('announcement.show');
            Route::delete('{user}','Admin\AnnouncementController@destroy')->name('announcement.destroy');
            Route::delete('/','Admin\AnnouncementController@bulkdestroy')->name('announcement.bulkdestroy');
        });


        

        /** Policy & Documents Route **/
        Route::group(['prefix' => 'policyanddocuments','exculde' => ['policyanddocuments.filter', 'policyanddocuments.store', 'policyanddocuments.update','policyanddocuments.show','policyanddocuments.bulkdestroy']], function(){
            Route::get('/','Admin\PolicyAndDocumentsController@index')->name('policyanddocuments.index');
            Route::post('/','Admin\PolicyAndDocumentsController@index')->name('policyanddocuments.filter');
            Route::get('create','Admin\PolicyAndDocumentsController@create')->name('policyanddocuments.create');
            Route::post('store','Admin\PolicyAndDocumentsController@store')->name('policyanddocuments.store');
            Route::get('{user}/edit','Admin\PolicyAndDocumentsController@edit')->name('policyanddocuments.edit');
            Route::put('{user}','Admin\PolicyAndDocumentsController@update')->name('policyanddocuments.update');
            Route::get('{user}','Admin\PolicyAndDocumentsController@show')->name('policyanddocuments.show');
            Route::delete('{user}','Admin\PolicyAndDocumentsController@destroy')->name('policyanddocuments.destroy');
            Route::delete('/','Admin\PolicyAndDocumentsController@bulkdestroy')->name('policyanddocuments.bulkdestroy');
        });
        /** Holidays Route **/
        Route::group(['prefix' => 'holidays','exculde' => ['holidays.filter', 'holidays.store', 'holidays.update','holidays.show','holidays.bulkdestroy']], function(){
            Route::get('/','Admin\HolidaysController@index')->name('holidays.index');
            Route::post('/','Admin\HolidaysController@index')->name('holidays.filter');
            Route::get('create','Admin\HolidaysController@create')->name('holidays.create');
            Route::post('store','Admin\HolidaysController@store')->name('holidays.store');
            Route::get('{user}/edit','Admin\HolidaysController@edit')->name('holidays.edit');
            Route::put('{user}','Admin\HolidaysController@update')->name('holidays.update');
            Route::get('{user}','Admin\HolidaysController@show')->name('holidays.show');
            Route::delete('{user}','Admin\HolidaysController@destroy')->name('holidays.destroy');
            Route::delete('/','Admin\HolidaysController@bulkdestroy')->name('holidays.bulkdestroy');
        });
        /** Help Desk Route **/
        Route::group(['prefix' => 'helpdesks','exculde' => ['helpdesks.filter', 'helpdesks.store', 'helpdesks.update','helpdesks.show','helpdesks.bulkdestroy','helpdesks.updateticketstatus','helpdesks.payroll','helpdesks.downloadslip']], function(){
            Route::get('/','Admin\HelpdeskController@index')->name('helpdesks.index');
            Route::post('/','Admin\HelpdeskController@index')->name('helpdesks.filter');
            Route::get('create','Admin\HelpdeskController@create')->name('helpdesks.create');
            Route::post('store','Admin\HelpdeskController@store')->name('helpdesks.store');
            Route::get('{user}/edit','Admin\HelpdeskController@edit')->name('helpdesks.edit');
            Route::put('{user}','Admin\HelpdeskController@update')->name('helpdesks.update');
            Route::get('{user}','Admin\HelpdeskController@show')->name('helpdesks.show');
            Route::delete('{user}','Admin\HelpdeskController@destroy')->name('helpdesks.destroy');
            Route::delete('/','Admin\HelpdeskController@bulkdestroy')->name('helpdesks.bulkdestroy');
            Route::post('{id}','Admin\HelpdeskController@updateticketstatus')->name('helpdesks.updateticketstatus');
            Route::get('searchajax','Admin\HelpdeskController@getSearch')->name('helpdesks.searchajax');
            Route::get('payroll/sample','Admin\HelpdeskController@PaySlipView')->name('helpdesks.payroll');
            Route::get('payroll/download','Admin\HelpdeskController@PaySlip')->name('helpdesks.downloadslip');

        });

        /** Payroll Route **/
        /** Payroll Route **/
        Route::group(['prefix' => 'payrolls','exculde' =>['payrolls.create']], function(){
            Route::get('/','Admin\PayrollController@index')->name('payrolls.index');
            Route::get('/{id}','Admin\PayrollController@create')->name('payrolls.create');
            Route::post('/generatepayslip','Admin\PayrollController@payslipgenerate')->name('payrolls.generate');
            Route::post('/paysliplist','Admin\PayrollController@getpayslip')->name('payrolls.getpayslip');
            //  Route::post('download/{id}','Admin\PayrollController@genereatepdf')->name('payrolls.download');

        });

        /** Project Route **/
        Route::group(['prefix' => 'project', 'exculde' => ['project.filter', 'project.update', 'project.bulkdestroy','project.archive_index_filter','project.archive','project.store', 'project.daily_report_store','project.search', 'project.daily_report_update','project.permanent_destroy']], function() {
            Route::any('projectreport', 'Admin\ProjectController@projectReport')->name('project.project_report');
            Route::get('/', 'ProjectController@index')->name('project.index');
            Route::post('/', 'ProjectController@index')->name('project.filter');
            Route::get('create', 'ProjectController@create')->name('project.create');
            Route::post('store', 'ProjectController@store')->name('project.store');
            Route::get('{user}/edit', 'ProjectController@edit')->name('project.edit');
            Route::put('{user}', 'ProjectController@update')->name('project.update');
            // Route::get('{user}', 'ProjectController@show')->name('project.show');
            Route::delete('{user}', 'ProjectController@destroy')->name('project.destroy');
            /*Daily Report*/
            Route::any('{user}/dailyreport', 'ProjectController@dailyReport')->name('project.daily_report');
            Route::get('/dailyreport/create', 'ProjectController@reportCreate')->name('daily_report.create');
            Route::post('/dailyreport/store', 'ProjectController@reportStore')->name('project.daily_report_store');
            Route::get('/dailyreport/index', 'ProjectController@reportIndex')->name('project.daily_report_index');
            Route::post('/report/list','ProjectController@reportIndex')->name('project.daily_report_index_filter');
            Route::get('/report/list','ProjectController@reportIndex')->name('project.daily_report_index_filter');
            Route::post('{id}/report/show','ProjectController@show')->name('project.daily_report_show_filter');
            Route::get('{user}/{report}/dailyreport/edit', 'ProjectController@dailyReportEdit')->name('project.daily_report_edit');
            Route::post('{user}/{report}/dailyreport/update', 'ProjectController@dailyReportUpdate')->name('project.daily_report_update');
            Route::get('{id}', 'ProjectController@show')->name('project.daily_report_show');
            Route::get('project/auto_search','ProjectController@autoSearch')->name('project.search');
            Route::get('/bench/index', 'ProjectController@benchIndex')->name('daily_report.bench');
            Route::post('/bench/list','ProjectController@benchIndex')->name('report.bench_index_filter');
            Route::get('restore/{id}', 'ProjectController@UnArchive')->name('project.unarchive');
            Route::get('/archive/index', 'ProjectController@archiveIndex')->name('project.archive_index');
            Route::delete('delete/{user}', 'ProjectController@PermanentDestroy')->name('project.permanent_destroy');
            Route::post('/archive/index','ProjectController@archiveIndex')->name('project.archive_index_filter');

        });

        Route::group(['prefix' => 'email_cadences','exculde' =>['email_cadences.direct_client','email_cadences.white_labelled','email_cadences.technology']], function(){
            Route::get('/','EmailCadencesController@index')->name('email_cadences.index');
            Route::get('/direct_clients','EmailCadencesController@directClient')->name('email_cadences.direct_client');
            Route::get('/white-labelled_partners','EmailCadencesController@whiteLabelled')->name('email_cadences.white_labelled');
            Route::get('/technology_partners','EmailCadencesController@technology')->name('email_cadences.technology');

        });

        Route::group(['prefix' => 'playbook','exculde' =>['document.backup','document.qa_process','document.saas_tech']], function(){
            Route::get('/coding_best_practices','DocumentController@index')->name('document.index');
            Route::get('/backup_process','DocumentController@back_up_list')->name('document.backup');
            Route::get('/qa_process','DocumentController@qa_list')->name('document.qa_process');
            Route::get('/saas_tech_stack','DocumentController@saas_list')->name('document.saas_tech');
        });

        Route::group(['prefix' => 'settings', 'exculde' => ['settings.store']], function(){
            Route::get('/','SettingController@create')->name('settings.create');
            Route::post('/','SettingController@store')->name('settings.store');
        });
        /** IT declaration Route **/
        Route::group(['prefix' => 'itdeclaration','exculde' => ['itdeclaration.filter', 'itdeclaration.store', 'itdeclaration.update','itdeclaration.show','itdeclaration.bulkdestroy','itdeclaration.deletedocument','itdeclaration.getcategory','itdeclaration.listdata','itdeclaration.viewdetails']], function(){
            Route::get('/','Admin\ItdeclarationController@index')->name('itdeclaration.index');
            Route::post('/','Admin\ItdeclarationController@index')->name('itdeclaration.filter');
            Route::get('create','Admin\ItdeclarationController@create')->name('itdeclaration.create');
            Route::post('store','Admin\ItdeclarationController@store')->name('itdeclaration.store');
            Route::get('{user}/edit','Admin\ItdeclarationController@edit')->name('itdeclaration.edit');
            Route::put('{user}','Admin\ItdeclarationController@update')->name('itdeclaration.update');
            Route::get('{user}','Admin\ItdeclarationController@show')->name('itdeclaration.show');
            Route::delete('{user}','Admin\ItdeclarationController@destroy')->name('itdeclaration.destroy');
            Route::delete('/','Admin\ItdeclarationController@bulkdestroy')->name('itdeclaration.bulkdestroy');
            Route::get('delete/{document}','Admin\ItdeclarationController@deletedocument')->name('itdeclaration.deletedocument');
            Route::get('categoru/getcategory','Admin\ItdeclarationController@getcategory')->name('itdeclaration.getcategory'); Route::get('declaration/listdata','Admin\ItdeclarationController@listalldata')->name('itdeclaration.listdata');
            Route::post('declaration/viewdetails','Admin\ItdeclarationController@viewDetails')->name('itdeclaration.viewdetails');
        });
    });
});
/** Education **/
Route::get('/education/{id}','Admin\ProfileController@education')->name('education');
Route::post('/education_detail','Admin\ProfileController@educationDetail')->name('education_detail');

Route::get('leaveExport', 'Admin\LeaveController@leaveExport')->name('leaveExport');
Route::get('employeeExport', 'Admin\EmployeeController@employeeExport')->name('employeeExport');
Route::get('dailyTaskExport', 'Admin\ProjectController@dailyTaskExport')->name('dailyTaskExport');
Route::get('dailyReportTaskExport', 'Admin\ProjectController@dailyReportTaskExport')->name('dailyReportTaskExport');
Route::get('dailyReportExport', 'ProjectController@exportReport')->name('DailyReportExport');
Route::get('BenchReportExport', 'ProjectController@benchExportReport')->name('BenchReportExport');


/** Experience **/
Route::get('/experience/{id}','Admin\ProfileController@experience')->name('experience');
Route::post('/experience_detail','Admin\ProfileController@experienceDetail')->name('experience_detail');
Route::get('/update','Admin\ProfileController@updateProfile')->name('profie.update_profile');

