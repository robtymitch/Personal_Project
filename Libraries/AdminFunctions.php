<?php
class Admin {

    public static function isAdmin($session){
        if ($session['Role'] == 'Admin'){
            return True;
        } else {
            return False;
        }
	}
	
	public static function createTenant($data){
		//1. validate the data
		if(!isset($data['User_Email']{0})) return 'The email is missing';
		if(!isset($data['First_Name']{0})) return 'The first name is missing';
		if(!isset($data['Last_Name']{0})) return 'The last name is missing';
		if(!isset($data['Password']{0})) return 'The password is missing';
		if(!isset($data['Role']{0})) return 'The role is missing';
		if(!isset($data['Apt_Id']{0})) return 'The apartment id is missing';

		if(!filter_var($data['User_Email'],FILTER_VALIDATE_EMAIL)) return 'The email address is not valid';

		require_once('mySQLDataBase.php');
		$pdo=MySQLDB::connect();
		$query=$pdo->prepare('SELECT User_Email FROM users WHERE User_Email=?');
		$query->execute([$data['User_Email']]);
		if($query->rowCount()>0) return 'The user is already registered';

        // check if password is valid and check if password meets requirements
        $data['Password'] = trim($data['Password']);
        if (strlen($data['Password']) < 8) {
            return 'The password must be at least 8 characters';
		}

		// encrypt password
		$data['Password']=password_hash($data['Password'],PASSWORD_DEFAULT);

		//3. insert into users
		$query=$pdo->prepare('INSERT INTO users (User_Email, First_Name, Last_Name, Password, Role, Apt_Id) VALUES (?,?,?,?,?,?)');
		$query->execute([$data['User_Email'], $data['First_Name'], $data['Last_Name'], $data['Password'], $data['Role'], $data['Apt_Id']]);

		//update the apartments
		$query=$pdo->prepare('SELECT User_Id from users WHERE Apt_Id=?');
		$query->execute([$data['Apt_Id']]);
		$row = $query->fetch();
		$query=$pdo->prepare('UPDATE apartments set User_Id=? WHERE Apt_Id=?');
		$query->execute([$row['User_Id'], $data['Apt_Id']]);

		//insert the bill
		$query=$pdo->prepare('SELECT User_Id, Cost_Of_Rent from apartments WHERE User_Id=?');
		$query->execute([$row['User_Id']]);
		$row=$query->fetch();
		$query=$pdo->prepare('INSERT INTO billing (User_Id, Amount_Due, Due_Date, Past_Due, Apt_Id) values (?,?,?,?,?)');
		$query->execute([$row['User_Id'], $row['Cost_Of_Rent'], date("Y-m-d"), 0, $data['Apt_Id']]);
		//4. disconnect from the db
		$pdo = "null";
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