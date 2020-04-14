<?php

class AccountManagement 
{

    // Checks if the user is logged in 
    function isLogged(){
        if (isset($_SESSION['User_Id'])){
            return isset($_SESSION['User_Id']);
        } else {
            return FALSE;
        }
    }

    // Signs out the user that is logged in
    function signout(){
        session_start();
        session_destroy();
        $_SESSION=[];
        header('location: ../index.php');
    }

    public function signin($data){
        if (count($data) > 0){
            // filter data
            if(!isset($data['email']{0}) || !isset($data['password']{0})) return 'Please fill out both fields';
            if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) return 'The email address is not valid';
            // check if password is valid and check if password meets requirements
            $data['password'] = trim($data['password']);
            if (strlen($data['password']) < 8) {
                return 'The password must be at least 8 characters';
            }
            // check if user is in the database
            require_once('mySQLDataBase.php');
            $pdo=MySQLDB::connect();
            $query=$pdo->prepare('SELECT User_Id, User_Email, Password FROM users WHERE User_Email=?');
            $query->execute([$data['email']]);

            if($query->rowCount() < 1) return 'The user is not registered';
            // check if password is correct
            $row = $query->fetch();
            if (!password_verify($data['password'], $row['Password'])) return 'Incorrect password';
            $_SESSION['User_Id'] = $row['User_Id'];
            return '';
            $pdo = "null";
        }
    }

    public function signup($data){
		// filter data
		if(!isset($data['email']{0}) || !isset($data['password']{0}) || !isset($data['first_name']{0}) || !isset($data['last_name']{0})) return 'Some fields are missing';
        if(!filter_var($data['email'],FILTER_VALIDATE_EMAIL)) return 'The email address is not valid';
        // check if password is valid and check if password meets requirements
        $data['password'] = trim($data['password']);
        if (strlen($data['password']) < 8) {
            return 'The password must be at least 8 characters';
        }
        // check if user is already there
		require_once('mySQLDataBase.php');
		$pdo=MySQLDB::connect();
		$query=$pdo->prepare('SELECT User_Email FROM users WHERE User_Email=?');
		$query->execute([$data['email']]);
		if($query->rowCount()>0) return 'The user is already registered';
		// encrypt password
		$data['password']=password_hash($data['password'],PASSWORD_DEFAULT);
		// save the user
		$query=$pdo->prepare('INSERT INTO users(User_Email,Password,First_Name,Last_Name) VALUES(?,?,?,?)');
		$query->execute([$data['email'],$data['password'],$data['first_name'],$data['last_name']]);
        return '';
        $pdo = "null";
    }
}