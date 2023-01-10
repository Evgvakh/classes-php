<?php

class User {
    private $id;
    private $login;
    private $password; 
    private $email; 
    private $firstname;
    private $lastname;

    public function __construct($id, $login, $password, $email, $firstname, $lastname) {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function register($id, $login, $password, $email, $firstname, $lastname) {
        $mysqli = new mysqli('localhost', 'root', '', 'classes');
        $query = "INSERT INTO utilisateurs VALUES('$id', '$login', '$password', '$email', '$firstname', '$lastname')";
        $mysqli->query($query);
        $result = $mysqli->query("SELECT * FROM utilisateurs WHERE utilisateurs.firstname = '$firstname'");
        $row = mysqli_fetch_assoc($result);
        foreach ($row as $key=>$val) {
            echo "<strong>" .$key . "</strong>" . ": " .$val . "<br>";
        }            
    }

    public function connect($login, $password) {
        $mysqli = new mysqli('localhost', $login, $password, 'classes');
        if (mysqli_connect_errno()) {
            printf('Connection is not established', mysqli_connect_error());
            exit();
        }
        $this->id = '';
        $this->login = $login;
        $this->password = $password;
        $this->email = '';
        $this->firstname = '';
        $this->lastname = '';
        print_r($this);
    }

    public function disconnect() {
        $mysqli = new mysqli('localhost', 'root', '', 'classes');
        $mysqli->close();
    }

    public function delete($obj) {
        unset($obj);
        $this->disconnect();
    }

    public function update($id, $login, $password, $email, $firstname, $lastname) {
        $mysqli = new mysqli('localhost', 'root', '', 'classes');
        $query = "UPDATE utilisateurs SET login = '$login' WHERE login = '$this->login'";
        $mysqli->query($query);
        $query = "UPDATE utilisateurs SET password = '$password' WHERE password = '$this->password'";
        $mysqli->query($query);
        $query = "UPDATE utilisateurs SET email = '$email' WHERE email = '$this->email'";
        $mysqli->query($query);
        $query = "UPDATE utilisateurs SET firstname = '$firstname' WHERE firstname = '$this->firstname'";
        $mysqli->query($query);
        $query = "UPDATE utilisateurs SET lastname = '$lastname' WHERE lastname = '$this->lastname'";
        $mysqli->query($query);
        $this->id = '';
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function isConnected() {
        $connect = mysqli_connect('localhost', 'root', '', 'classes');
        if ($connect) {
            echo 'Connected'; } else {
            echo 'Not connected';
            }
    }

    public function getAllInfos() {
        $mysqli = new mysqli('localhost', 'root', '', 'classes');
        $query = $mysqli->query("SELECT * FROM utilisateurs WHERE utilisateurs.firstname = 'Jack'");
        $row = mysqli_fetch_assoc($query);
        foreach ($row as $key=>$val) {
            echo $key . ": " . $val . "<br>";
        }
    }

    public function getLogin() {
        $mysqli = new mysqli('localhost', 'root', '', 'classes');
        $query = $mysqli->query("SELECT login FROM utilisateurs WHERE utilisateurs.firstname = 'Jack'");
        $row = mysqli_fetch_assoc($query);
        foreach ($row as $key=>$val) {
            echo $key . ": " . $val . "<br>";
        }
    }

    public function getEmail() {
        $mysqli = new mysqli('localhost', 'root', '', 'classes');
        $query = $mysqli->query("SELECT email FROM utilisateurs WHERE utilisateurs.firstname = 'Jack'");
        $row = mysqli_fetch_assoc($query);
        foreach ($row as $key=>$val) {
            echo $key . ": " . $val . "<br>";
        }
    }

}


$user = new User(null, 'EvgVakh', '12345', 'evgvakh@gmail.com', 'Evgeny', 'Vakhrushev');

// $user->register(null, 'JackRyan', '000000', 'jack@gmail.com', 'Jack', 'Ryan');
// $user->register(null, 'EvgVakh', '12345', 'evgvakh@gmail.com', 'Evgeny', 'Vakhrushev');


// $user->connect('root', '');

// $user->disconnect();

// $user->update(null, 'zzz', '1sdddd', 'asdasdasdh@gmail.com', 'qwe', 'dffds');

// $user->isConnected();

// $user->getAllInfos();

// $user->getLogin();

// $user->getEmail();
