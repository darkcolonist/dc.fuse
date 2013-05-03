<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
	'default' => array(
		'connection'  => array(
			'dsn'        => 'pgsql:host=localhost;dbname=dc_deploy',
			'username'   => 'dev',
			'password'   => 'dev',
		),
    'profiling' => true
	),
);
