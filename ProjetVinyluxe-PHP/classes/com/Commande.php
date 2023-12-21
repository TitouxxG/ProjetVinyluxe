<?php

namespace classes\com;

require_once ('./lib/db/Database.php');
require_once ('./lib/sess/Session.php');


class Commande{


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

//   public function checkExistEmail($email){
//     $sql = "SELECT email from  tbl_product WHERE email = :email";
//     $stmt = $this->db->pdo->prepare($sql);
//     $stmt->bindValue(':email', $email);
//      $stmt->execute();
//     if ($stmt->rowCount()> 0) {
//       return true;
//     }else{
//       return false;
//     }
//   }


  public function CommandeRegistration($data){
    $statut_com = $data['statut_com'];
    $prix_com = $data['prix_com'];

    $checkEmail = $this->checkExistEmail($email);

    if ($statut_com == "" || $prix_com == "") {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Please, User Registration field must not be Empty !</div>';
        return $msg;
    } elseif (strlen($categorie) < 3) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
        return $msg;
    } else {
        $sql = "INSERT INTO tbl_commande(statut_com, prix_com) VALUES(:statut_com, :prix_com)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':statut_com', $statut_com);
        $stmt->bindValue(':prix_com', $prix_com);
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

public function addNewCommande($data){
    $statut_com = $data['statut_com'];
    $prix_com = $data['prix_com'];

//   $checkEmail = $this->checkExistEmail($email);

  if ($statut_com == "" || $prix_com == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Input fields must not be empty!</div>';
      return $msg;
  } elseif (strlen($statut_com) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Username is too short, at least 3 characters!</div>';
      return $msg;
  
  } else {
      $sql = "INSERT INTO tbl_commande(statut_com, prix_com) 
              VALUES(:statut_com, :prix_com)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':statut_com', $statut_com);
      $stmt->bindValue(':prix_com', $prix_com);
      $result = $stmt->execute();
      if ($result) {
          $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> Commande registered successfully!</div>';
          return $msg;
      } else {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Error!</strong> Something went wrong!</div>';
          return $msg;
      }
  }
}

public function selectAllCommandeData(){
  $sql = "SELECT * FROM tbl_commande ORDER BY id DESC";
  $stmt = $this->db->pdo->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(\PDO::FETCH_OBJ);
}


public function getCommandeInfoById($commandeid){
  $sql = "SELECT * FROM tbl_commande WHERE id = :id LIMIT 1";
  $stmt = $this->db->pdo->prepare($sql);
  $stmt->bindValue(':id', $commandeid);
  $stmt->execute();
  $result = $stmt->fetch(\PDO::FETCH_OBJ);
  if ($result) {
      return $result;
  } else {
      return false;
  }
}

public function updateCommandeByIdInfo($commandeid, $data){
    $statut_com = $data['statut_com'];
    $prix_com = $data['prix_com'];

  if ($statut_com == "" || $prix_com == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Input Fields must not be Empty!</div>';
      return $msg;
  } elseif (strlen($statut_com) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Username is too short, at least 3 Characters</div>';
      return $msg;
  } else {
      $sql = "UPDATE tbl_commande SET
          statut_com = :statut_com,
          prix_com = :prix_com
          WHERE id = :id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':statut_com', $statut_com);
      $stmt->bindValue(':prix_com', $prix_com);
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

public function deleteCommandeById($remove){
  $sql = "DELETE FROM tbl_commande WHERE id = :id ";
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


