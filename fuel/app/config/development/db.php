<?php
/**
 * The development database settings.
 */

return array(
	'default' => array(
		'connection'  => array(
//			'dsn'        => 'mysql:host=localhost;dbname=fuel_dc_blog',
			'dsn'        => 'pgsql:host=localhost;dbname=dc_deploy',
			'username'   => 'dev',
			'password'   => 'dev',
		),
	),
);
