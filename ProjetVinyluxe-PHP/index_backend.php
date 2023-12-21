<?php


// Utilisation de la classe Database dans un autre fichier
use inc\head;
require_once ('./lib/sess/session.php');
require_once ('./inc/head/header.php');
//use lib\db;
require_once ('./lib/db/Database.php');
// use classes\tbl;
// use classes\cls;

require_once ('./classes/tbl/Users.php');
require_once ('./classes/cls/Client.php');
require_once ('./classes/prd/Produit.php');
require_once ('./classes/com/Commande.php');
require_once ('./classes/pan/Panier.php');

use \classes\tbl\Users as users;
use \classes\cls\Client as clients; 
use \classes\prd\Produit as produits;
use \classes\com\Commande as commandes;
use \classes\pan\Panier as paniers;

$db = new lib\db\Database();
$users = new users($db);
$clients = new clients();
$produits = new produits();
$commandes = new commandes();
$paniers = new paniers();

\lib\sess\Session::CheckSession();

$logMsg = \lib\sess\Session::get('logMsg');
if (isset($logMsg)) {
  echo $logMsg;
}

$msg = \lib\sess\Session::get('msg');
if (isset($msg)) {
  echo $msg;
}
\lib\sess\Session::set("msg", NULL);
\lib\sess\Session::set("logMsg", NULL);
?>

<div class="card">
  <div class="card-header">
    <h3><i class="fas fa-users mr-2"></i>User list
      <span class="float-right">Welcome! <strong>
          <span class="badge badge-lg badge-secondary text-white">
            <?php
            $username = \lib\sess\Session::get('username');
            if (isset($username)) {
              echo $username;
            }
            ?></span>

        </strong></span></h3>
  </div>
  <!-- for user -->
  <div class="card-body pr-2 pl-2">

    <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th class="text-center">SL</th>
          <th class="text-center">Name</th>
          <th class="text-center">Username</th>
          <th class="text-center">Email address</th>
          <th class="text-center">Mobile</th>
          <th class="text-center">Active</th>
          <th width='25%' class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php

      $allUser = $users->selectAllUserData();

      if ($allUser) {
        $i = 0;
        foreach ($allUser as  $value) {
          $i++;
                                // Nouveau code pour les clients
          $allClients = $clients->selectAllClientData();

          // if ($allClients) {
          //   foreach ($allClients as $client) {
          //     // Accédez aux champs "nom" et "prenom" du client
          //     $name = $client->name;
          //     $username = $client->username;

          //     // Affichez les valeurs dans la balise <td> appropriée
          //     echo "<td>$name $username</td>";
          //   }
          // }
          // Fin du nouveau code pour les clients

          // Le reste du code pour les utilisateurs
          // ...
      
                  ?>

                    <tr class="text-center"
                    <?php if (\lib\sess\Session::get("id") == $value->id) {
                      echo "style='background:#d9edf7' ";
                    } ?>
                    >

                      <td><?php echo $i; ?></td>
                      <td><?php echo $value->name; ?></td>
                      <td><?php echo $value->username; ?> <br>
                        <?php if ($value->roleid  == '1'){
                        echo "<span class='badge badge-lg badge-info text-white'>Admin</span>";
                      } elseif ($value->roleid == '2') {
                        echo "<span class='badge badge-lg badge-dark text-white'>Editor</span>";
                      }elseif ($value->roleid == '3') {
                          echo "<span class='badge badge-lg badge-dark text-white'>User Only</span>";
                      } ?></td>
                      <td><?php echo $value->email; ?></td>

                      <!-- <td><?php echo $value->name; ?></td>
                      <td><?php echo $value->username; ?></td>
                      <td><?php echo $value->email; ?></td>
                      <td><?php echo $value->mobile; ?></td>
                      <td><?php echo $value->text; ?></td> -->

                      <td><span class="badge badge-lg badge-secondary text-white"><?php echo $value->mobile; ?></span></td>
                      <td>
                        <?php if ($value->isActive == '0') { ?>
                        <span class="badge badge-lg badge-info text-white">Active</span>
                      <?php }else{ ?>
                  <span class="badge badge-lg badge-danger text-white">Deactive</span>
                      <?php } ?>

                      </td>


                     

                      <td>
                        <?php if ( \lib\sess\Session::get("roleid") == '1') {?>
                          <a class="btn btn-success btn-sm
                          " href="profile.php?id=<?php echo $value->id;?>">View</a>
                          <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                          <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                          <?php if (\lib\sess\Session::get("id") == $value->id) {
                          echo "disabled";
                  } ?>
                            btn-sm " href="?remove=<?php echo $value->id;?>">Remove</a>

                            <?php if ($value->isActive == '0') {  ?>
                              <a onclick="return confirm('Are you sure To Deactive ?')" class="btn btn-warning
                      <?php if (\lib\sess\Session::get("id") == $value->id) {
                        echo "disabled";
                      } ?>
                              btn-sm " href="?deactive=<?php echo $value->id;?>">Disable</a>
                            <?php } elseif($value->isActive == '1'){?>
                              <a onclick="return confirm('Are you sure To Active ?')" class="btn btn-secondary
                      <?php if (\lib\sess\Session::get("id") == $value->id) {
                        echo "disabled";
                      } ?>
                              btn-sm " href="?active=<?php echo $value->id;?>">Active</a>
                            <?php } ?>




                      <?php  }elseif(\lib\sess\Session::get("id") == $value->id  && \lib\sess\Session::get("roleid") == '2'){ ?>
                        <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                        <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                      <?php  }elseif( \lib\sess\Session::get("roleid") == '2'){ ?>
                        <a class="btn btn-success btn-sm
                        <?php if ($value->roleid == '1') {
                          echo "disabled";
                        } ?>
                        " href="profile.php?id=<?php echo $value->id;?>">View</a>
                        <a class="btn btn-info btn-sm
                        <?php if ($value->roleid == '1') {
                          echo "disabled";
                        } ?>
                        " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                      <?php }elseif(\lib\sess\Session::get("id") == $value->id  && \lib\sess\Session::get("roleid") == '3'){ ?>
                        <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                        <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                      <?php }else{ ?>
                        <a class="btn btn-success btn-sm
                        <?php if ($value->roleid == '1') {
                          echo "disabled";
                        } ?>
                        " href="profile.php?id=<?php echo $value->id;?>">View</a>

                      <?php } ?>

                      </td>
                    </tr>
                  
                    
                  <?php
                    }
                     }else{?>
                      <tr class="text-center">
                            <td>No user availabe now !</td>
                      </tr>
                      <?php }?>
                </tbody>

            </table>









      </div>
  </div>

                      <!-- for client -->
  <div class="card-body pr-2 pl-2">
  <div class="card-header">
    <h3><i class="fas fa-users mr-2"></i>Client list</h3>                   
    <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th class="text-center">SL</th>

          <th class="text-center">Name</th>
          <th class="text-center">Username</th>
          <th class="text-center">Email</th>
          <th class="text-center">Address</th>
          <th class="text-center">Text</th>
          <th width='25%' class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php

      $allClient = $clients->selectAllClientData();

      if ($allClient) {
        $i = 0;
        foreach ($allClient as  $value) {
          $i++;
                                // Nouveau code pour les clients
          $allClient = $clients->selectAllClientData();

          // if ($allClients) {
          //   foreach ($allClients as $client) {
          //     // Accédez aux champs "nom" et "prenom" du client
          //     $name = $client->name;
          //     $username = $client->username;

          //     // Affichez les valeurs dans la balise <td> appropriée
          //     echo "<td>$name $username</td>";
          //   }
          // }
          // Fin du nouveau code pour les clients

          // Le reste du code pour les utilisateurs
          // ...
      
                  ?>

                    <tr class="text-center"
                    <?php if (\lib\sess\Session::get("id") == $value->id) {
                      echo "style='background:#d9edf7' ";
                    } ?>
                    

                      <td><?php echo $i; ?></td>
                      <td><?php echo $value->id; ?></td>
                      <td><?php echo $value->name; ?></td>
                      <td><?php echo $value->username; ?></td> 
                      <td><?php echo $value->email; ?></td>
                      <td><?php echo $value->address; ?></td>
                      <td><?php echo $value->text; ?></td>

                      <!-- <td><?php echo $value->name; ?></td>
                      <td><?php echo $value->username; ?></td>
                      <td><?php echo $value->email; ?></td>
                      <td><?php echo $value->mobile; ?></td>
                      <td><?php echo $value->text; ?></td> -->

                      <td>
                        <?php if ( \lib\sess\Session::get("roleid") == '1') {?>
                          <a class="btn btn-success btn-sm
                          " href="profile.php?id=<?php echo $value->id;?>">View</a>
                          <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                          <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                          <?php if (\lib\sess\Session::get("id") == $value->id) {
                          echo "disabled";
                  } ?>
                            btn-sm " href="?remove=<?php echo $value->id;?>">Remove</a>

                            <?php if ($value->isActive == '0') {  ?>
                              <a onclick="return confirm('Are you sure To Deactive ?')" class="btn btn-warning
                      <?php if (\lib\sess\Session::get("id") == $value->id) {
                        echo "disabled";
                      } ?>
                              btn-sm " href="?deactive=<?php echo $value->id;?>">Disable</a>
                            <?php } elseif($value->isActive == '1'){?>
                              <a onclick="return confirm('Are you sure To Active ?')" class="btn btn-secondary
                      <?php if (\lib\sess\Session::get("id") == $value->id) {
                        echo "disabled";
                      } ?>
                              btn-sm " href="?active=<?php echo $value->id;?>">Active</a>
                            <?php } ?>




                      <?php  }elseif(\lib\sess\Session::get("id") == $value->id  && \lib\sess\Session::get("roleid") == '2'){ ?>
                        <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                        <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                      <?php  }elseif( \lib\sess\Session::get("roleid") == '2'){ ?>
                        <a class="btn btn-success btn-sm
                        <?php if ($value->roleid == '1') {
                          echo "disabled";
                        } ?>
                        " href="profile.php?id=<?php echo $value->id;?>">View</a>
                        <a class="btn btn-info btn-sm
                        <?php if ($value->roleid == '1') {
                          echo "disabled";
                        } ?>
                        " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                      <?php }elseif(\lib\sess\Session::get("id") == $value->id  && \lib\sess\Session::get("roleid") == '3'){ ?>
                        <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                        <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                      <?php }else{ ?>
                        <a class="btn btn-success btn-sm
                        <?php if ($value->roleid == '1') {
                          echo "disabled";
                        } ?>
                        " href="profile.php?id=<?php echo $value->id;?>">View</a>

                      <?php } ?>

                      </td>
                    </tr>
                  
                    
                  <?php
                    }
                    }else{?>
                      <tr class="text-center">
                            <td>No user availabe now !</td>
                      </tr>
                      <?php }?>
                </tbody>

            </table>









      </div>
  </div>

                        <!-- for product -->
 <div class="card-body pr-2 pl-2">
  <div class="card-header">
    <h3><i class="fas fa-users mr-2"></i>Product list</h3>                   
    <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th class="text-center">SL</th>
          <th class="text-center">Name</th>
          <th class="text-center">Prix</th>
          <th class="text-center">Categorie</th>
          <th class="text-center">Etat</th>
          <th width='25%' class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php

      $allProduct = $produits->selectAllProductData();

      if ($allProduct) {
        $i = 0;
        foreach ($allProduct as  $value) {
          $i++;
                                // Nouveau code pour les clients
          $allProduct = $produits->selectAllProductData();

                  ?>

                    <tr class="text-center"
                    <?php if (\lib\sess\Session::get("id") == $value->id) {
                      echo "style='background:#d9edf7' ";
                    } ?>
                    

                      <td><?php echo $i; ?></td>
                      <td><?php echo $value->id; ?></td>
                      <td><?php echo $value->Name; ?></td>
                      <td><?php echo $value->Prix; ?></td> 
                      <td><?php echo $value->Categorie; ?></td>
                      <td><?php echo $value->etat; ?></td>

                      <td>
                        <?php if ( \lib\sess\Session::get("roleid") == '1') {?>
                          <a class="btn btn-success btn-sm
                          " href="profile.php?id=<?php echo $value->id;?>">View</a>
                          <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                          <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                          <?php if (\lib\sess\Session::get("id") == $value->id) {
                          echo "disabled";
                  } ?>
                            btn-sm " href="?remove=<?php echo $value->id;?>">Remove</a>

                            <?php if ($value->isActive == '0') {  ?>
                              <a onclick="return confirm('Are you sure To Deactive ?')" class="btn btn-warning
                      <?php if (\lib\sess\Session::get("id") == $value->id) {
                        echo "disabled";
                      } ?>
                              btn-sm " href="?deactive=<?php echo $value->id;?>">Disable</a>
                            <?php } elseif($value->isActive == '1'){?>
                              <a onclick="return confirm('Are you sure To Active ?')" class="btn btn-secondary
                      <?php if (\lib\sess\Session::get("id") == $value->id) {
                        echo "disabled";
                      } ?>
                              btn-sm " href="?active=<?php echo $value->id;?>">Active</a>
                            <?php } ?>




                      <?php  }elseif(\lib\sess\Session::get("id") == $value->id  && \lib\sess\Session::get("roleid") == '2'){ ?>
                        <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                        <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                      <?php  }elseif( \lib\sess\Session::get("roleid") == '2'){ ?>
                        <a class="btn btn-success btn-sm
                        <?php if ($value->roleid == '1') {
                          echo "disabled";
                        } ?>
                        " href="profile.php?id=<?php echo $value->id;?>">View</a>
                        <a class="btn btn-info btn-sm
                        <?php if ($value->roleid == '1') {
                          echo "disabled";
                        } ?>
                        " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                      <?php }elseif(\lib\sess\Session::get("id") == $value->id  && \lib\sess\Session::get("roleid") == '3'){ ?>
                        <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                        <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                      <?php }else{ ?>
                        <a class="btn btn-success btn-sm
                        <?php if ($value->roleid == '1') {
                          echo "disabled";
                        } ?>
                        " href="profile.php?id=<?php echo $value->id;?>">View</a>

                      <?php } ?>

                      </td>
                    </tr>
                  
                    
                  <?php
                    }
                    }else{?>
                      <tr class="text-center">
                            <td>No user availabe now !</td>
                      </tr>
                      <?php }?>
                </tbody>

            </table>


      </div>
  </div>

  <!-- for commande -->
  <div class="card-body pr-2 pl-2">
    <div class="card-header">
    <h3><i class="fas fa-users mr-2"></i>Commande list</h3>                   
    <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead>
        <tr>
          <th class="text-center">SL</th>
          <th class="text-center">Statut_com</th>
          <th class="text-center">Prix_com</th>
          <th width='25%' class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php

      $allCommande = $commandes->selectAllCommandeData();

      if ($allCommande) {
        $i = 0;
        foreach ($allCommande as  $value) {
          $i++;
                                // Nouveau code pour les clients
          $allCommande = $commandes->selectAllCommandeData();

                  ?>

                    <tr class="text-center"
                    <?php if (\lib\sess\Session::get("id") == $value->id) {
                      echo "style='background:#d9edf7' ";
                    } ?>
                    

                      <td><?php echo $i; ?></td>
                      <td><?php echo $value->id; ?></td>
                      <td><?php echo $value->Statut_com; ?></td>
                      <td><?php echo $value->Prix_com; ?></td> 

                      <td>
                        <?php if ( \lib\sess\Session::get("roleid") == '1') {?>
                          <a class="btn btn-success btn-sm
                          " href="profile.php?id=<?php echo $value->id;?>">View</a>
                          <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                          <a onclick="return confirm('Are you sure To Delete ?')" class="btn btn-danger
                          <?php if (\lib\sess\Session::get("id") == $value->id) {
                          echo "disabled";
                  } ?>
                            btn-sm " href="?remove=<?php echo $value->id;?>">Remove</a>

                            <?php if ($value->isActive == '0') {  ?>
                              <a onclick="return confirm('Are you sure To Deactive ?')" class="btn btn-warning
                      <?php if (\lib\sess\Session::get("id") == $value->id) {
                        echo "disabled";
                      } ?>
                              btn-sm " href="?deactive=<?php echo $value->id;?>">Disable</a>
                            <?php } elseif($value->isActive == '1'){?>
                              <a onclick="return confirm('Are you sure To Active ?')" class="btn btn-secondary
                      <?php if (\lib\sess\Session::get("id") == $value->id) {
                        echo "disabled";
                      } ?>
                              btn-sm " href="?active=<?php echo $value->id;?>">Active</a>
                            <?php } ?>




                      <?php  }elseif(\lib\sess\Session::get("id") == $value->id  && \lib\sess\Session::get("roleid") == '2'){ ?>
                        <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                        <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                      <?php  }elseif( \lib\sess\Session::get("roleid") == '2'){ ?>
                        <a class="btn btn-success btn-sm
                        <?php if ($value->roleid == '1') {
                          echo "disabled";
                        } ?>
                        " href="profile.php?id=<?php echo $value->id;?>">View</a>
                        <a class="btn btn-info btn-sm
                        <?php if ($value->roleid == '1') {
                          echo "disabled";
                        } ?>
                        " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                      <?php }elseif(\lib\sess\Session::get("id") == $value->id  && \lib\sess\Session::get("roleid") == '3'){ ?>
                        <a class="btn btn-success btn-sm " href="profile.php?id=<?php echo $value->id;?>">View</a>
                        <a class="btn btn-info btn-sm " href="profile.php?id=<?php echo $value->id;?>">Edit</a>
                      <?php }else{ ?>
                        <a class="btn btn-success btn-sm
                        <?php if ($value->roleid == '1') {
                          echo "disabled";
                        } ?>
                        " href="profile.php?id=<?php echo $value->id;?>">View</a>

                      <?php } ?>

                      </td>
                    </tr>
                  
                    
                  <?php
                    }
                    }else{?>
                      <tr class="text-center">
                            <td>No user availabe now !</td>
                      </tr>
                      <?php }?>
                </tbody>

            </table>









      </div>
  </div>
?>
<?php
  include 'inc/acc/footer.php'; ?>