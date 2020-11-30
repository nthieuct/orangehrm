<?php
class Conf {

	var $smtphost;
	var $dbhost;
	var $dbport;
	var $dbname;
	var $dbuser;
	var $version;

	function __construct() {

		$this->dbhost	= '45.117.169.145';
		$this->dbport 	= '3306';
		if(defined('ENVIRNOMENT') && ENVIRNOMENT == 'test'){
		$this->dbname    = 'test_hondamient_hrm';		
		}else {
		$this->dbname    = 'hondamient_hrm';
		}
		$this->dbuser    = 'hondamient_hrm';
		$this->dbpass	= 'Cmu#2015';
		$this->version = '4.6';

		$this->emailConfiguration = dirname(__FILE__).'/mailConf.php';
		$this->errorLog =  realpath(dirname(__FILE__).'/../logs/').'/';
	}
}
?>