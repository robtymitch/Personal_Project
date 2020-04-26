<?php
class Admin {

    public static function isAdmin($session){
        if ($session['Role'] == 'Admin'){
            return True;
        } else {
            return False;
        }
    }

    public static function createAdminWorkOrder($data){
		//1. validate the data
		if(!isset($data['Apt_Id']{0})) return 'The Apartment Id is missing';
		if(!isset($data['type']{0})) return 'The type is missing';
		if(!isset($data['description']{0})) return 'Please add a description';
		//2. connect to the database
		require_once('mySQLDataBase.php');
		$pdo=MySQLDB::connect();
		//3. get the User_Id
		$query=$pdo->prepare('SELECT User_Id FROM users WHERE Apt_Id = ?');
		$query->execute([$data['Apt_Id']]);
		$row = $query->fetch();
		//4. insert the record
		$query=$pdo->prepare('INSERT INTO maintenance_requests (User_Id, Date, Type, Description, Apt_Id) VALUES (?,?,?,?,?)');
		$query->execute([$row['User_Id'], date("Y-m-d"), $data['type'], $data['description'], $data['Apt_Id']]);
		//5. disconnect from the db
		$pdo = "null";
	}

	public function adminUpdateOrder($data){
		//1. validate the data
		if(!isset($data['type']{0})) return 'The type is missing';
		if(!isset($data['description']{0})) return 'Please add a description';
		//2. connect to the database
		require_once('mySQLDataBase.php');
		$pdo=MySQLDB::connect();
		//3. insert the record
		$query=$pdo->prepare('UPDATE maintenance_requests SET Type=?, Description=? WHERE Request_Id = ?');
		$query->execute([$data['type'], $data['description'], $_GET['id']]);
		//4. disconnect from the db
		$pdo = "null";
	}
}

?>