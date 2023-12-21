<?php

namespace classes\pan;

require_once ('./lib/db/Database.php');
require_once ('./lib/sess/Session.php');


class Panier{


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


  public function PanierRegistration($data){
    $quantite = $data['quantite'];
    $prix_panier = $data['prix_panier'];

    $checkEmail = $this->checkExistEmail($email);

    if ($quantite == "" || $prix_panier == "") {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Please, User Registration field must not be Empty !</div>';
        return $msg;
    } elseif (strlen($prix_panier) < 3) {
        $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<strong>Error !</strong> Username is too short, at least 3 Characters !</div>';
        return $msg;
    } else {
        $sql = "INSERT INTO tbl_panier(quantite, prix_panier) VALUES(:quantite, :prix_panier)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':statut_com', $quantite);
        $stmt->bindValue(':prix_com', $prix_panier);
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

public function addNewPanier($data){
    $quantite = $data['quantite'];
    $prix_panier = $data['prix_panier'];

//   $checkEmail = $this->checkExistEmail($email);

  if ($quantite == "" || $prix_panier == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Input fields must not be empty!</div>';
      return $msg;
  } elseif (strlen($prix_panier) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Username is too short, at least 3 characters!</div>';
      return $msg;
  
  } else {
      $sql = "INSERT INTO tbl_panier(quantite, prix_panier) 
              VALUES(:quantite, :prix_panier)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':quantite', $quantite);
      $stmt->bindValue(':prix_panier', $prix_panier);
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

public function selectAllPanierData(){
  $sql = "SELECT * FROM tbl_panier ORDER BY id DESC";
  $stmt = $this->db->pdo->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(\PDO::FETCH_OBJ);
}


public function getPanierInfoById($panierid){
  $sql = "SELECT * FROM tbl_panier WHERE id = :id LIMIT 1";
  $stmt = $this->db->pdo->prepare($sql);
  $stmt->bindValue(':id', $panierid);
  $stmt->execute();
  $result = $stmt->fetch(\PDO::FETCH_OBJ);
  if ($result) {
      return $result;
  } else {
      return false;
  }
}

public function updatePanierByIdInfo($panierid, $data){
    $quantite = $data['quantite'];
    $prix_panier = $data['prix_panier'];

  if ($quantite == "" || $prix_panier == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Input Fields must not be Empty!</div>';
      return $msg;
  } elseif (strlen($prix_panier) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Username is too short, at least 3 Characters</div>';
      return $msg;
  } else {
      $sql = "UPDATE tbl_panier SET
          quantite = :quantite,
          prix_panier = :prix_panier
          WHERE id = :id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':quantite', $quantite);
      $stmt->bindValue(':prix_panier', $prix_panier);
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

public function deletePanierById($remove){
  $sql = "DELETE FROM tbl_panier WHERE id = :id ";
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


