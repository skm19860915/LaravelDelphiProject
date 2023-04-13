<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XeRequestController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\TrackingReportController;
use App\Http\Controllers\TrackingGeneralController;
use App\Http\Controllers\ManifestController;

Route::get('/', 'AuthController@index');
Route::post('auth/login', 'AuthController@login');
Route::get('dashboard', 'DashboardController@index');
Route::get('auth/logout', 'AuthController@logout');
Route::get('user/admin', 'UserController@getManagers');
Route::post('user/newUser', 'UserController@createUser');
Route::post('user/removeUser', 'UserController@removeUser');
Route::get('user/customer', 'UserController@getCustomers');
Route::post('user/newCustomer', 'UserController@createCustomer');
Route::post('user/editCustomer', 'UserController@editCustomer');
Route::post('user/removeCustomer', 'UserController@removeCustomer');

Route::get('order/all', 'OrderController@getAllOrderDetails');
Route::post('order/save', 'OrderController@save');
Route::get('order/detail/{id}', 'OrderController@getOrder');
Route::post('order/getTransporterOrder', 'OrderController@getTransporterOrder');

Route::get('client/all', 'ClientController@getAllClients');
Route::post('client/add', 'ClientController@add');
Route::post('client/create', 'ClientController@create');
Route::post('client/edit', 'ClientController@edit');
Route::post('client/delete', 'ClientController@delete');
Route::get('client/list', 'ClientController@getClientList');
Route::post('client/remove', 'ClientController@remove');

Route::get('transporter/all', 'TransporterController@getAllTransporters');
Route::post('transporter/add', 'TransporterController@add');
Route::post('transporter/create', 'TransporterController@create');
Route::post('transporter/edit', 'TransporterController@edit');
Route::post('transporter/delete', 'TransporterController@delete');
Route::get('transporter/detail/{id}', 'TransporterController@getOrderTransporterDetails');
Route::get('transporter/list', 'TransporterController@getTransporterList');
Route::post('transporter/remove', 'TransporterController@remove');
Route::post('transporter/previewConfirmData', 'TransporterController@previewConfirmationData');
Route::get('transporter/previewPdf', 'TransporterController@previewPdf');
Route::post('transporter/change', 'TransporterController@change');
Route::post('transporter/saveConfirmData', 'TransporterController@saveConfirmData');
Route::get('transporter/downloadPdf/{id}/{ext}', 'TransporterController@downloadPdf');
Route::post('transporter/saveExtension', 'TransporterController@saveExtension');
Route::post('transporter/getExitingTransporterDetails', 'TransporterController@getExitingTransporterDetails');
Route::post('transporter/changeTransporter', 'TransporterController@changeTransporter');

Route::get('vehicleType/get', 'VehicleTypeController@get');
Route::post('vehicleType/create', 'VehicleTypeController@create');
Route::post('vehicleType/update', 'VehicleTypeController@update');
Route::delete('vehicleType/delete/{id}', 'VehicleTypeController@delete');

Route::get('loadAddrs', 'LoadAddressController@index');
Route::post('loadAddrs/create', 'LoadAddressController@create');
Route::post('loadAddrs/edit', 'LoadAddressController@edit');
Route::post('loadAddrs/remove', 'LoadAddressController@remove');

Route::get('offloadAddrs', 'OffLoadAddressController@index');
Route::post('offloadAddrs/create', 'OffLoadAddressController@create');
Route::post('offloadAddrs/edit', 'OffLoadAddressController@edit');
Route::post('offloadAddrs/remove', 'OffLoadAddressController@remove');

Route::get('xe-request', [XeRequestController::class, 'index'])->name('xerequest.index');
Route::get('xe-request/export', [XeRequestController::class, 'export'])->name('xerequest.export');
Route::post('xe-request/filter', [XeRequestController::class, 'filter'])->name('xerequest.filter');

Route::post('container/create', 'ContainerController@create');
Route::post('container/edit', 'ContainerController@edit');
Route::post('container/remove', 'ContainerController@remove');
Route::get('containers', [ContainerController::class, 'index'])->name('container.index');
Route::get('container/export', [ContainerController::class, 'export'])->name('container.export');

Route::get('equipment/get', 'EquipmentController@get');
Route::post('equipment/create', 'EquipmentController@create');
Route::post('equipment/update', 'EquipmentController@update');
Route::delete('equipment/delete/{id}', 'EquipmentController@delete');

Route::get('tracking-report', [TrackingReportController::class, 'index'])->name('tracking-report.index');
Route::get('tracking-report/export', [TrackingReportController::class, 'export'])->name('tracking-report.export');
Route::post('tracking-report/filter', [TrackingReportController::class, 'filter'])->name('tracking-report.filter');

Route::get('tracking-general', [TrackingGeneralController::class, 'index'])->name('tracking-general.index');
Route::get('tracking-general/export', [TrackingGeneralController::class, 'export'])->name('tracking-general.export');

Route::get('manifest', [ManifestController::class, 'index'])->name('manifest.index');
Route::get('manifest/export', [ManifestController::class, 'export'])->name('manifest.export');
Route::post('manifest/filter', [ManifestController::class, 'filter'])->name('manifest.filter');
