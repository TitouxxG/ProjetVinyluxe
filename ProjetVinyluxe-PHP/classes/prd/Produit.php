<?php

namespace classes\prd;

require_once ('./lib/db/Database.php');
require_once ('./lib/sess/Session.php');


class Produit{


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


  public function ProductRegistration($data){
    $name = $data['name'];
    $prix = $data['prix'];
    $categorie = $data['categorie'];
    $etat = $data['etat'];

    $checkEmail = $this->checkExistEmail($email);

    if ($name == "" || $prix == "" || $categorie == "" || $etat == "") {
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
        $sql = "INSERT INTO tbl_product(name, prix, categorie, etat) VALUES(:name, :prix, :categorie, :etat)";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':prix', $prix);
        $stmt->bindValue(':categorie', $categorie);
        $stmt->bindValue(':etat', $etat);
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

public function addNewProduct($data){
  $name = $data['name'];
  $prix = $data['prix'];
  $categorie = $data['categorie'];
  $etat = $data['etat'];

//   $checkEmail = $this->checkExistEmail($email);

  if ($name == "" || $prix == "" || $categorie == "" || $etat == "" ) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Input fields must not be empty!</div>';
      return $msg;
  } elseif (strlen($categorie) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Username is too short, at least 3 characters!</div>';
      return $msg;
  
  } else {
      $sql = "INSERT INTO tbl_product(name, prix, categorie, etat) 
              VALUES(:name, :prix, :categorie, :etat)";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':prix', $prix);
      $stmt->bindValue(':categorie', $categorie);
      $stmt->bindValue(':prix', $prix);
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

public function selectAllProductData(){
  $sql = "SELECT * FROM tbl_product ORDER BY id DESC";
  $stmt = $this->db->pdo->prepare($sql);
  $stmt->execute();
  return $stmt->fetchAll(\PDO::FETCH_OBJ);
}


public function getProductInfoById($productid){
  $sql = "SELECT * FROM tbl_product WHERE id = :id LIMIT 1";
  $stmt = $this->db->pdo->prepare($sql);
  $stmt->bindValue(':id', $productid);
  $stmt->execute();
  $result = $stmt->fetch(\PDO::FETCH_OBJ);
  if ($result) {
      return $result;
  } else {
      return false;
  }
}

public function updateProductByIdInfo($productid, $data){
  $name = $data['name'];
  $prix = $data['prix'];
  $categorie = $data['categorie'];
  $etat = $data['etat'];

  if ($name == "" || $prix == "" || $categorie == "" || $etat == "") {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Input Fields must not be Empty!</div>';
      return $msg;
  } elseif (strlen($categorie) < 3) {
      $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error!</strong> Username is too short, at least 3 Characters!</div>';
      return $msg;
  } else {
      $sql = "UPDATE tbl_product SET
          name = :name,
          prix = :prix,
          categorie = :categorie,
          etat = :etat
          WHERE id = :id";
      $stmt = $this->db->pdo->prepare($sql);
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':prix', $prix);
      $stmt->bindValue(':categorie', $categorie);
      $stmt->bindValue(':etat', $etat);
      $stmt->bindValue(':id', $productid);
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

public function deleteProductById($remove){
  $sql = "DELETE FROM tbl_product WHERE id = :id ";
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


