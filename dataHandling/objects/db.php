<?php
// singleton class
class DB
{
	private static $db;

	public static function init()
	{
		if ( self::$db == null )
			self::$db = new mysqli(contract_viewer_db_host, contract_viewer_db_username, contract_viewer_db_password, contract_viewer_db_db);

		return self::$db;
	}
}