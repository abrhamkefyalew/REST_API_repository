<?php
/**
 * this is a place to select database engine and
 * database connection string values are decelared here
 * @author Abrham Kefyalew <abrekefe22@gmail.com>
 * @copyright
 * @license
 */

	return [
		/**
		 * Holds Databse configration and database used
		 * To change the database engine modify the _default varable and the corsponding databases enginge configration
		 */

		'database_default' => 'mysql',

		'connections' =>[

			//Mysql Database engine connection String
			'mysql' => [
				'driver' => 'mysql',
				'host' => 'localhost',
				'port' => '',
				'database' => 'restapiusers',
				'username' => 'root',
				'password' => ''
			],

			//Oracle Database engine connection string
			'orasql' =>[],
			//Sqlserver Database engine connection string
			'sqlserver' =>[]

		]
	];

?>
