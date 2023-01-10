<?php
class Userpdo {
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
        $connection = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');
        $sql_req = "INSERT utilisateurs (id, login, password, email, firstname, lastname) VALUE (null, :login, :password, :email, :firstname, :lastname)";
        
        $param = [
            'login' => $login,
            'password' => $password,
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname
        ];

        $exec = $connection->prepare($sql_req);
        $exec->execute($param);
;
        $sel_req = "SELECT * FROM utilisateurs WHERE firstname = '$firstname'";
        $req = $connection->prepare($sel_req);
        $req->execute();

        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $val) {
            print_r($val);
        }  
    }

    public function connect($login, $password) {
        $connection = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', $login, $password);

        $this->id = '';
        $this->login = $login;
        $this->password = $password;
        $this->email = '';
        $this->firstname = '';
        $this->lastname = '';
        print_r($this);
    }

    public function disconnect() {
        $connection = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');
        $connection = null;
    }

    public function delete($obj) {
        unset($obj);
        $this->disconnect();
    }

    public function update($id, $login, $password, $email, $firstname, $lastname) {
        $connection = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');

        $connection->beginTransaction();

        $exec = "UPDATE utilisateurs SET login = '$login' WHERE login = '$this->login'";
        $connection->exec($exec);
        $exec = "UPDATE utilisateurs SET password = '$password' WHERE password = '$this->password'";
        $connection->exec($exec);
        $exec = "UPDATE utilisateurs SET email = '$email' WHERE email = '$this->email'";
        $connection->exec($exec);
        $exec = "UPDATE utilisateurs SET firstname = '$firstname' WHERE firstname = '$this->firstname'";
        $connection->exec($exec);
        $exec = "UPDATE utilisateurs SET lastname = '$lastname' WHERE lastname = '$this->lastname'";
        $connection->exec($exec);

        $connection->commit();

        $this->id = '';
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function isConnected() {      
            
        try{
            $connection = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');            
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connected';
        }               
        catch(PDOException $err){
          echo "Error : " . $err->getMessage();
        }

    }

    public function getAllInfos() {
        $connection = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');
        $sql_req = "SELECT * FROM utilisateurs WHERE login = '$this->login'";
        $req = $connection->prepare($sql_req);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);
    }

    public function getLogin() {
        $connection = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');
        $sql_req = "SELECT login FROM utilisateurs WHERE login = '$this->login'";
        $req = $connection->prepare($sql_req);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);
    }

    public function getEmail() {
        $connection = new PDO('mysql:host=localhost;dbname=classes;charset=utf8', 'root', '');
        $sql_req = "SELECT email FROM utilisateurs WHERE login = '$this->login'";
        $req = $connection->prepare($sql_req);
        $req->execute();
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);
    }

}



$user = new Userpdo(null, 'EvgVakh', '12345', 'evgvakh@gmail.com', 'Evgeny', 'Vakhrushev');

// $user->register(null, 'EvgVakh', '12345', 'evgvakh@gmail.com', 'Evgeny', 'Vakhrushev');
// $user->register(null, 'JackRyan', '000000', 'jack@gmail.com', 'Jack', 'Ryan');

// $user->connect('root', '');

// user->disconnect();

//$user->update(null, '2EvgVakh', '212345', '2evgvakh@gmail.com', '2Evgeny', '2Vakhrushev');

// $user->getAllInfos();

// $user->getEmail();

// $user->getLogin();



