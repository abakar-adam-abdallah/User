<?php
session_start();

class Connection {
    public $host = "localhost";
    public $user = "root";
    public $password = "root";
    public $db_name = "oop_reglog";
    public $conn;
 
    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}

$conn = new Connection();

class Register extends Connection {
    public function registration($name, $username, $email, $password, $confirmpassword) {
        $duplicate = $this->conn->prepare("SELECT * FROM db_user WHERE username = :username OR email = :email");
        $duplicate->execute(array(':username' => $username, ':email' => $email));

        if ($duplicate->rowCount() > 0) {
            return 10; // Username or email has already been taken
        } else {
            if ($password == $confirmpassword) {
                $query = "INSERT INTO db_user (name, username, email, password) VALUES (:name, :username, :email, :password)";
                $statement = $this->conn->prepare($query);
                $statement->execute(array(':name' => $name, ':username' => $username, ':email' => $email, ':password' => $password));
                return 1; // Successful registration
            } else {
                return 100; // Password does not match
            }
        }
    }
}

class Login extends Connection {
    public $id;

    public function login($usernameemail, $password) {
        $result = $this->conn->prepare("SELECT * FROM db_user WHERE username = :username OR email = :email");
        $result->execute(array(':username' => $usernameemail, ':email' => $usernameemail));
        $row = $result->fetch(PDO::FETCH_ASSOC);

        if ($result->rowCount() > 0) {
            if ($password == $row["password"]) {
                $this->id = $row["id"];
                return 1; // Login Successful
            } else {
                return 10; // Wrong password
            }
        } else {
            return 100; // User not registered
        } 
    }

    public function idUser() {
        return $this->id;
    }
}

class Select extends Connection {
    public function selectUserById($id) {
        $result = $this->conn->prepare("SELECT * FROM db_user WHERE id = :id");
        $result->execute(array(':id' => $id));
        return $result->fetch(PDO::FETCH_ASSOC);
    }
}
