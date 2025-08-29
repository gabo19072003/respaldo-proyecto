<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index', ['filter' => 'fire']);
$routes->get('login', 'Login::index', ['filter' => 'fire']);
$routes->post('auth', 'Login::auth', ['filter' => 'fire']);
$routes->get('logout', 'Login::logout', ['filter' => 'fire']);

$routes->get('register', 'Users::index', ['filter' => 'fire']);
$routes->post('register', 'Users::create', ['filter' => 'fire']);

$routes->get('activate-user/(:any)', 'Users::activateUser/$1', ['filter' => 'fire']);

$routes->get('password-request', 'Users::linkRequestForm', ['filter' => 'fire']);
$routes->post('password-email', 'Users::sendResetLinkEmail', ['filter' => 'fire']);

$routes->get('password-reset/(:any)', 'Users::resetForm/$1', ['filter' => 'fire']);
$routes->post('password-reset', 'Users::resetPassword', ['filter' => 'fire']);

//$routes->get('inicio', 'Inicio::index', ['filter' => 'auth']);

$routes->group('/', ['filter' => 'auth'], function ($routes){
	
	$routes->get('inicio', 'Inicio::index');

	$routes->get('persona', 'Personas::index');
	$routes->get('interno', 'Personas::interno');
	$routes->get('externo', 'Personas::externo');
	$routes->get('persona/crear', 'Personas::crear');
	$routes->post('persona/guardar', 'Personas::guardar');
	$routes->delete('persona/borrar/(:num)', 'Personas::borrar/$1');
	$routes->get('persona/editar/(:num)', 'Personas::editar/$1');
	$routes->post('persona/actualizar', 'Personas::actualizar');
	
	$routes->post('persona/cambiar', 'Perfil::cambiar');

	$routes->get('libro', 'Libros::index');
	$routes->get('libro/crear', 'Libros::crear');
	$routes->post('libro/guardar', 'Libros::guardar');
	$routes->get('libro/borrar/(:num)', 'Libros::borrar/$1');
	$routes->get('libro/editar/(:num)', 'Libros::editar/$1');
	$routes->post('libro/actualizar', 'Libros::actualizar');

	$routes->get('sesion', 'Sesiones::index');
	$routes->get('sesion/crear', 'Sesiones::crear');
	$routes->post('sesion/guardar', 'Sesiones::guardar');
	$routes->get('sesion/cancelar/(:num)', 'Sesiones::cancelar/$1');

	$routes->get('usuario', 'Usuarios::index');
	$routes->get('usuario/crear', 'Usuarios::crear');
	$routes->post('usuario/guardar', 'Usuarios::guardar');
	$routes->get('usuario/borrar/(:num)', 'Usuarios::borrar/$1');
	$routes->get('usuario/editar/(:num)', 'Usuarios::editar/$1');
	$routes->post('usuario/actualizar', 'Usuarios::actualizar');

	$routes->get('cubiculo', 'Cubiculos::index');
	$routes->get('cubiculo/crear', 'Cubiculos::crear');
	$routes->post('cubiculo/guardar', 'Cubiculos::guardar');
	$routes->get('cubiculo/borrar/(:num)', 'Cubiculos::borrar/$1');
	$routes->get('cubiculo/editar/(:num)', 'Cubiculos::editar/$1');
	$routes->post('cubiculo/actualizar', 'Cubiculos::actualizar');

	$routes->get('casillero', 'Casilleros::index');
	$routes->get('casillero/crear', 'Casilleros::crear');
	$routes->post('casillero/guardar', 'Casilleros::guardar');
	$routes->get('casillero/borrar/(:num)', 'Casilleros::borrar/$1');
	$routes->get('casillero/editar/(:num)', 'Casilleros::editar/$1');
	$routes->post('casillero/actualizar', 'Casilleros::actualizar');

	$routes->get('recurso', 'Recursos::index');
	$routes->get('recurso/crear', 'Recursos::crear');
	$routes->post('recurso/guardar', 'Recursos::guardar');
	$routes->get('recurso/borrar/(:num)', 'Recursos::borrar/$1');
	$routes->get('recurso/editar/(:num)', 'Recursos::editar/$1');
	$routes->post('recurso/actualizar', 'Recursos::actualizar');

	$routes->get('servicio', 'Servicios::index');
	$routes->get('servicio/crear', 'Servicios::crear');
	$routes->post('servicio/guardar', 'Servicios::guardar');
	$routes->get('servicio/borrar/(:num)', 'Servicios::borrar/$1');
	$routes->get('servicio/editar/(:num)', 'Servicios::editar/$1');
	$routes->post('servicio/actualizar', 'Servicios::actualizar');

	$routes->get('servicio/agregar/(:num)', 'Modalidades::index/$1');
	$routes->get('modalidad/crear/(:num)', 'Modalidades::crear/$1');
	$routes->post('modalidad/guardar/(:num)', 'Modalidades::guardar/$1');
	$routes->get('modalidad/borrar/(:num)', 'Modalidades::borrar/$1');
	$routes->get('modalidad/editar/(:num)', 'Modalidades::editar/$1');
	$routes->post('modalidad/actualizar', 'Modalidades::actualizar');

	

	$routes->get('evento', 'Eventos::index');
	$routes->get('evento/agenda', 'Eventos::agenda');
	$routes->get('evento/lista', 'Eventos::listar');
	$routes->get('evento/listarexit', 'Eventos::listarexit');
	$routes->get('evento/crear', 'Eventos::crear');
	$routes->post('evento/guardar', 'Eventos::guardar');
	$routes->get('evento/suspender/(:num)', 'Eventos::suspender/$1');
	$routes->get('evento/restaurar/(:num)', 'Eventos::restaurar/$1');
	$routes->get('evento/borrar/(:num)', 'Eventos::borrar/$1');
	$routes->get('evento/editar/(:num)', 'Eventos::editar/$1');
	$routes->post('evento/actualizar', 'Eventos::actualizar');

	$routes->get('perfil', 'Perfil::index');
	$routes->post('perfil/actualizar', 'Perfil::actualizar');

	$routes->get('bitacora', 'Bitacora::index');
	
});


