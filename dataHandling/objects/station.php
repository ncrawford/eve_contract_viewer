<?php
require_once('dataHandling/objects/db.php');

class Station extends DB
{
	private $db; // database connection
	private $stmt_getSolarSystemID; // statements
	private $stationID; // referenced in prepared statements as the arbitrary value
	private $stationToSolarSystem = array(); // will cache the data

	function __construct()
	{
		$this->db = DB::init();

		// todo: move this prepared statement to a singleton instance so it is only loaded on first fetch
		$this->stmt_getSolarSystemID = $this->db->prepare('SELECT solarSystemID FROM staStations WHERE stationID=?');
			$this->stmt_getSolarSystemID->bind_param('i', $this->stationID);
	}

	public function getSolarSystemID($stationID)
	{
		if ( isset($this->stationToSolarSystem[$stationID]) )
			return $this->stationToSolarSystem[$stationID];

		$this->stationID = $stationID; // assign stationID to arbitrary value placeholder
		$this->stmt_getSolarSystemID->execute(); // execute the prepared statement
		$result = $this->stmt_getSolarSystemID->get_result(); // fetch the result
		$row = $result->fetch_assoc();  // get the first row of the result

		$this->stationToSolarSystem[$stationID] = $row['solarSystemID'];  // assign to cache

		$result->free_result(); // clear result from memory

		return $this->stationToSolarSystem[$stationID];
	}

}