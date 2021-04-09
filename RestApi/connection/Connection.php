<?php

  /**
   * @author Abrham Kefyalew <abrekefe22@gmail.com>
   * @copyright
   * @license
   */


	//Acquring web information
 	require_once(__DIR__ . "/../config/WebInfo.php");

	//Creating Connection with the server database
	class Connection{
		/**
		 * @var array string holds all setups for configring database
		 */
		private $database_collection = NULL;

		/**
		 * @var string loading the user selected default database engine
		 */
		private $database_default_driver = NULL;

		/**
		 * @var array string retrives all information that is nedded to connect to the datbase like host, port, databasename, password
		 */
		private $database_connection_config = NULL;

		/**
		 * @var Holds the opend connection with prefered database engine
		 */
		public $CONN = NULL;

		public function __construct(){

		}

    /**
     * @return Database connection string
     */
		public function connect(){
				$web = new WebInfo();
				$database_collection = require_once(__DIR__ . "/../config/dbInfo.php");
				$database_default_driver = $database_collection['database_default'];
			  $database_connection_config = $database_collection['connections'][$database_default_driver];
				$CONN = mysqli_connect($database_connection_config['host'],
							   $database_connection_config['username'],
							   $database_connection_config['password'],
							   $database_connection_config['database']);
				if(!$CONN)
					header("location:../resources/views/" . $web->getUrl() . "error.php?code=server");
				else
					return $CONN;
		}
	}


?>
