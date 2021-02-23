<?php

/* ================== Homepage ================== */
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');
	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');
	
	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', 'LA\DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'LA\DepartmentsController@dtajax');
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'LA\EmployeesController@change_password');
	
	/* ================== Organizations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organizations', 'LA\OrganizationsController');
	Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'LA\OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');

	/* ================== ASF_AUDITORIAS ================== */
	Route::resource(config('laraadmin.adminRoute') . '/asf_auditorias', 'LA\ASF_AUDITORIASController');
	Route::get(config('laraadmin.adminRoute') . '/asf_auditoria_dt_ajax', 'LA\ASF_AUDITORIASController@dtajax');



	/* ================== Oficio_de_solicituds ================== */
	Route::resource(config('laraadmin.adminRoute') . '/oficio_de_solicituds', 'LA\Oficio_de_solicitudsController');
	Route::get(config('laraadmin.adminRoute') . '/oficio_de_solicitud_dt_ajax', 'LA\Oficio_de_solicitudsController@dtajax');

	/* ================== Emitidos_Rectorias ================== */
	Route::resource(config('laraadmin.adminRoute') . '/emitidos_rectorias', 'LA\Emitidos_RectoriasController');
	Route::get(config('laraadmin.adminRoute') . '/emitidos_rectoria_dt_ajax', 'LA\Emitidos_RectoriasController@dtajax');

	/* ================== Emitidos_Direcciones ================== */
	Route::resource(config('laraadmin.adminRoute') . '/emitidos_direcciones', 'LA\Emitidos_DireccionesController');
	Route::get(config('laraadmin.adminRoute') . '/emitidos_direccione_dt_ajax', 'LA\Emitidos_DireccionesController@dtajax');

	/* ================== Ofc_orden_auditorias ================== */
	Route::resource(config('laraadmin.adminRoute') . '/ofc_orden_auditorias', 'LA\Ofc_orden_auditoriasController');
	Route::get(config('laraadmin.adminRoute') . '/ofc_orden_auditoria_dt_ajax', 'LA\Ofc_orden_auditoriasController@dtajax');

	/* ================== Directorio_auditores ================== */
	Route::resource(config('laraadmin.adminRoute') . '/directorio_auditores', 'LA\Directorio_auditoresController');
	Route::get(config('laraadmin.adminRoute') . '/directorio_auditore_dt_ajax', 'LA\Directorio_auditoresController@dtajax');

	/* ================== Solicitudes_infos ================== */
	Route::resource(config('laraadmin.adminRoute') . '/solicitudes_infos', 'LA\Solicitudes_infosController');
	Route::get(config('laraadmin.adminRoute') . '/solicitudes_info_dt_ajax', 'LA\Solicitudes_infosController@dtajax');

	/* ================== Dir_seguimientos ================== */
	Route::resource(config('laraadmin.adminRoute') . '/dir_seguimientos', 'LA\Dir_seguimientosController');
	Route::get(config('laraadmin.adminRoute') . '/dir_seguimiento_dt_ajax', 'LA\Dir_seguimientosController@dtajax');

	/* ================== Dir_universidads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/dir_universidads', 'LA\Dir_universidadsController');
	Route::get(config('laraadmin.adminRoute') . '/dir_universidad_dt_ajax', 'LA\Dir_universidadsController@dtajax');

	/* ================== Mail_recibidos ================== */
	Route::resource(config('laraadmin.adminRoute') . '/mail_recibidos', 'LA\Mail_recibidosController');
	Route::get(config('laraadmin.adminRoute') . '/mail_recibido_dt_ajax', 'LA\Mail_recibidosController@dtajax');



	/* ================== Cedulas_de_resultados ================== */
	Route::resource(config('laraadmin.adminRoute') . '/cedulas_de_resultados', 'LA\Cedulas_de_resultadosController');
	Route::get(config('laraadmin.adminRoute') . '/cedulas_de_resultado_dt_ajax', 'LA\Cedulas_de_resultadosController@dtajax');

	/* ================== Resultado_Observaciones ================== */
	Route::resource(config('laraadmin.adminRoute') . '/resultado_observaciones', 'LA\Resultado_ObservacionesController');
	Route::get(config('laraadmin.adminRoute') . '/resultado_observacione_dt_ajax', 'LA\Resultado_ObservacionesController@dtajax');

	/* ================== Oficios_Recibidos ================== */
	Route::resource(config('laraadmin.adminRoute') . '/oficios_recibidos', 'LA\Oficios_RecibidosController');
	Route::get(config('laraadmin.adminRoute') . '/oficios_recibido_dt_ajax', 'LA\Oficios_RecibidosController@dtajax');

	/* ================== Oficios_Respuestas ================== */
	Route::resource(config('laraadmin.adminRoute') . '/oficios_respuestas', 'LA\Oficios_RespuestasController');
	Route::get(config('laraadmin.adminRoute') . '/oficios_respuesta_dt_ajax', 'LA\Oficios_RespuestasController@dtajax');

	/* ================== Cedulas_de_resultados_fs ================== */
	Route::resource(config('laraadmin.adminRoute') . '/cedulas_de_resultados_fs', 'LA\Cedulas_de_resultados_fsController');
	Route::get(config('laraadmin.adminRoute') . '/cedulas_de_resultados_f_dt_ajax', 'LA\Cedulas_de_resultados_fsController@dtajax');

	/* ================== Resultado_Observaciones_fs ================== */
	Route::resource(config('laraadmin.adminRoute') . '/resultado_observaciones_fs', 'LA\Resultado_Observaciones_fsController');
	Route::get(config('laraadmin.adminRoute') . '/resultado_observaciones_f_dt_ajax', 'LA\Resultado_Observaciones_fsController@dtajax');

	/* ================== Oficios_Recibidos_fs ================== */
	Route::resource(config('laraadmin.adminRoute') . '/oficios_recibidos_fs', 'LA\Oficios_Recibidos_fsController');
	Route::get(config('laraadmin.adminRoute') . '/oficios_recibidos_f_dt_ajax', 'LA\Oficios_Recibidos_fsController@dtajax');

	/* ================== Oficios_Respuesta_fs ================== */
	Route::resource(config('laraadmin.adminRoute') . '/oficios_respuesta_fs', 'LA\Oficios_Respuesta_fsController');
	Route::get(config('laraadmin.adminRoute') . '/oficios_respuesta_f_dt_ajax', 'LA\Oficios_Respuesta_fsController@dtajax');

	/* ================== InformeCuentaPublicas ================== */
	Route::resource(config('laraadmin.adminRoute') . '/informecuentapublicas', 'LA\InformeCuentaPublicasController');
	Route::get(config('laraadmin.adminRoute') . '/informecuentapublica_dt_ajax', 'LA\InformeCuentaPublicasController@dtajax');

	/* ================== Lista_de_nombres ================== */
	Route::resource(config('laraadmin.adminRoute') . '/lista_de_nombres', 'LA\Lista_de_nombresController');
	Route::get(config('laraadmin.adminRoute') . '/lista_de_nombre_dt_ajax', 'LA\Lista_de_nombresController@dtajax');
});
