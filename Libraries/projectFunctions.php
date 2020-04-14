<?php

class DataManipulation
{

	// date, type, photo, discription, techid, apartmentid
	public function updateOrder($data){
		//1. validate the data
		if(!isset($data['type']{0})) return 'The type is missing';
		if(!isset($data['description']{0})) return 'Please add a description';
		//2. connect to the database
		require_once('mySQLDataBase.php');
		$pdo=MySQLDB::connect();
		//3. insert the record
		$query=$pdo->prepare('UPDATE maintenance_requests SET Type=?, Photo=?, Description=? WHERE Request_Id = ?');
		$query->execute([$data['type'], $data['Photo'], $data['description'], $_GET['id']]);
		//4. disconnect from the db
		$pdo = "null";
	}

	public function delete($Request_Id){
		// delete a work order;
		require_once('mySQLDataBase.php');
		$pdo=MySQLDB::connect();
		$query=$pdo->prepare('DELETE from maintenance_requests WHERE Request_Id=?');
		$query->execute([$Request_Id]);
		//4. disconnect from the db
		$pdo = "null";
	}

	public static function createWorkOrder($data){
		//1. validate the data
		if(!isset($data['type']{0})) return 'The type is missing';
		if(!isset($data['description']{0})) return 'Please add a description';
		//2. connect to the database
		require_once('mySQLDataBase.php');
		$pdo=MySQLDB::connect();
		//3. insert the record
		$query=$pdo->prepare('INSERT INTO maintenance_requests (User_Id, Date, Type, Photo, Description, Apt_Id) VALUES (?,?,?,?,?,?)');
		$query->execute([$_SESSION['User_Id'], date("Y-m-d"), $data['type'], $data['Photo'], $data['description'], $data['Apt_Id']]);
		//4. disconnect from the db
		$pdo = "null";
	}
}

