<?php

namespace classes\cls;

require_once ('./lib/db/Database.php');
require_once ('./lib/sess/Session.php');


class Client{


    // Db Property
    private $db;
  
    // Db __construct Method
    public function __construct(){
      $this->db = new \lib\db\Database();
    }

    // Date formate Method
   public function formatDate($date){
    // date_default_timezone_set('Asia/Dhaka');
     $strtime = strtotime($date);
   return date('Y-m-d H:i:s', $strtime);
  }

  public function checkExistEmail($email){
    $sql = "SELECT email from  tbl_clients WHERE email = :email";
    $stmt = $this->db->pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
     $stmt->execute();
    if ($stmt->rowCount()> 0) {
      return true;
    }else{
      return false;
    }
  }


  public function userRegistration($data){
    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];
    $address = $data['address'];
    $text = $data['text'];
    $password = $data['password'];

    $checkEmail = $this->checkExistEmail($email);

    if ($name == "" || $username == "" || $email == "" || $address == "" || $text == "" || $password == "") {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Please, User Registration field must not be Empty !</div>';
        return $msg;
    } elseif (strlen($username) < 3) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
        return $msg;
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Invalid email address !</div>';
        return $msg;
    } elseif ($checkEmail == TRUE) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Email already Exists, please try another Email... !</div>';
        return $msg;
    } elseif (strlen($password) < 6 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-z]+#", $password)) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Your Password must be at least 6 Characters long and contain at least 1 Number and 1 Letter!</div>';
        return $msg;
    } else {
        $sql = "INSERT INTO tbl_client(name, username, email, password, address, text) VALUES(:name, :username, :email, :password, :address, :text)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', SHA1($password));
        $stmt->bindValue(':address', $address);
        $stmt->bindValue(':text', $text);
        $result = $stmt->execute();
        if ($result) {
            $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Success !</strong> Wow, you have Registered Successfully !</div>';
            return $msg;
        } else {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Something went Wrong !</div>';
            return $msg;
        }
    }
}

public function addNewClient($data){
  $name = $data['name'];
  $username = $data['username'];
  $email = $data['email'];
  $address = $data['address'];
  $text = $data['text'];

  $checkEmail = $this->checkExistEmail($email);

  if ($name == "" || $username == "" || $email == "" || $address == "" || $text == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Input fields must not be empty!</div>';
      return $msg;
  } elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Username is too short, at least 3 characters!</div>';
      return $msg;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Invalid email address!</div>';
      return $msg;
  } elseif ($checkEmail) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Email already exists, please try another email!</div>';
      return $msg;
  } else {
      $sql = "INSERT INTO tbl_clients(id, name, username, email, address, text) 
              VALUES(:id, :name, :username, :email, :address, :text)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $id);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':address', $address);
      $stmt->bindValue(':text', $text);
      $result = $stmt->execute();
      if ($result) {
          $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> Client registered successfully!</div>';
          return $msg;
      } else {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Error!</strong> Something went wrong!</div>';
          return $msg;
      }
  }
}

public function selectAllClientData(){
  $sql = "SELECT * FROM tbl_clients ORDER BY id DESC";
  $stmt = $this->db->pdo->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(\PDO::FETCH_OBJ);
}


public function getUserInfoById($clientid){
  $sql = "SELECT * FROM tbl_clients WHERE id = :id LIMIT 1";
  $stmt = $this->db->pdo->prepare($sql);
  $stmt->bindValue(':id', $clientid);
  $stmt->execute();
  $result = $stmt->fetch(\PDO::FETCH_OBJ);
  if ($result) {
      return $result;
  } else {
      return false;
  }
}

public function updateUserByIdInfo($clientid, $data){
  $name = $data['name'];
  $username = $data['username'];
  $email = $data['email'];
  $adresse = $data['adresse'];
  $text = $data['text'];

  if ($name == "" || $username == "" || $email == "" || $adresse == "" || $text == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Input Fields must not be Empty!</div>';
      return $msg;
  } elseif (strlen($username) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Username is too short, at least 3 Characters!</div>';
      return $msg;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Invalid email address!</div>';
      return $msg;
  } else {
      $sql = "UPDATE tbl_clients SET
          name = :name,
          username = :username,
          email = :email,
          adresse = :adresse,
          text = :text
          WHERE id = :id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':id', $id);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':username', $username);
      $stmt->bindValue(':email', $email);
      $stmt->bindValue(':adresse', $adresse);
      $stmt->bindValue(':text', $text);
      $stmt->bindValue(':id', $clientid);
      $result = $stmt->execute();

      if ($result) {
          echo "<script>location.href='index_backend.php';</script>";
          \lib\sess\Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> Wow, Your Information updated Successfully!</div>');
      } else {
          echo "<script>location.href='index_backend.php';</script>";
          \lib\sess\Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Error!</strong> Data not updated!</div>');
      }
  }
}

public function deleteClientById($remove){
  $sql = "DELETE FROM tbl_clients WHERE id = :id ";
  $stmt = $this->db->pdo->prepare($sql);
  $stmt->bindValue(':id', $remove);
    $result =$stmt->execute();
    if ($result) {
      $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Success !</strong> User account Deleted Successfully !</div>';
        return $msg;
    }else{
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Data not Deleted !</div>';
        return $msg;
    }
}

}


