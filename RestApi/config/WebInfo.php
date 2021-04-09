<?php

/**
 * this is the place that all api calles are done
 * all the communication is done using JSON data format
 * all the REST API concept layes here
 * @author Abrham Kefyalew <abrekefe22@gmail.com>
 * @copyright
 * @license
 */
 

	/**
	 *Containes All information about the site
	 *@param Domain Name
	 *@param Site Address
	**/

	class WebInfo{
		private $URL = "";
		private $baseURL = "RestApi";
		private $DomainName = NULL;

		public function getUrl(){
			return $this->URL;
		}

		public function getBaseUrl(){
			return $this->baseURL;
		}

		public function getDomainName(){
			return $this->DomainName;
		}
	}

?>
