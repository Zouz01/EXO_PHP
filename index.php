<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html ; charset=UTF-8">
<title>Page de test PHP</title>
<link rel="stylesheet" type="text/css" href="style.css" />   

</head>
<body>
<h1>Page de test</h1>


<!-- *************************************************************************** -->
<!----------------------------- CREER UNE TO-LIST EN PHP -------------------------->
<!-- *************************************************************************** -->

<!-- Création du fichier PHP TO-LIST -->
<?php

$erreurs = "";
$host = "localhost"; // nom du serveur MySQL 
$dbname = "tache";   // Nom de la table
$username = "root"; // nom d'utilisateur MySQL 
$password = "root"; // mot de passe MySQL 

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

if (isset($_POST['creer_tache'])) {   //  On vérifie que la variable POST existe
    $tache = trim($_POST['creer_tache']);
    if (empty($tache)) {
        $erreurs = 'Vous devez indiquer la valeur de la tache';
    } else {
        $stmt = $db->prepare("INSERT INTO tache (tache) VALUES (:tache)");
        $stmt->bindParam(':tache', $tache);
        $stmt->execute();
    }
}
?>

<!-- Création de la base du document HTML TO-LIST -->
<div class="header">
    <p class="header_titre">Ma super Todo List !</p>
</div>

<form class="taches_input" method="post" action="index.php">  <!-- adresse servant à la TO-List-->
   
    <input id="inserer" type="text" name="creer_tache"/>
    <button id="envoyer">Créer</button>
</form>
<?php if (isset($erreurs)): ?>
        <p><?php echo $erreurs ?></p>
    <?php endif ?>

  
<!-- création de la partie (N, NOM, ACTION) du tableau TO-LIST -->
<?php echo "Hello World !<br>Bonjour à tous !" ;
 ?>
<table class="taches">
    <tr>
        <th>
            N
        </th>
        <th>
            Nom
        </th>
        <th>
            Action
        </th>
    </tr>

   
<!-- Création de la partie du tableau TO-List où récuperer les tâches -->

<?php
    $reponse = $db->query('Select * from tache'); // On exécute une requête visant à récupérer les tâches
    while ($taches = $reponse->fetch()) { // On initialise une boucle
        ?>
        <tr>
            <td><?php echo $taches['id'] ?></td> <!-- valeur GET récupérée  -->
             <td><?php echo $taches['tache'] ?></td> <!-- donne à la requête SQL la variable GET  -->
            <td><a class="suppr" href="index.php?supprimer_tache=<?php echo $taches['id'] ?>"> X</a></td>  <!--corresponds à l’id de la ligne que l’on souhaite supprimer-->
        </tr> 

        <?php
        }
    

// gérer la suppression des tâches.
    if(isset($_GET['supprimer_tache'])) {
      $id = $_GET['supprimer_tache'];
      $db->exec("DELETE FROM tache WHERE id=$id");
  }
    ?>

</table>
<!-- ****************************************************************************************** -->
<!--------------------------------------------- EXO 1 à  17---------------------------->
<!-- ****************************************************************************************** -->

<!-- /*Définir une variable et l’afficher*/ -->
<?php
echo "je m'appelle"
.$name = " Aziz<br>";

?>

<!-- // Afficher la concaténation d’une chaine de caractère et d’une variable  -->
<?php
$name = "Aziz<br>";
echo "Bonjour " . $name;
?>

<!-- Afficher un texte différent selon qu'une condition est vraie ou fausse  -->
<?php
$age = 51 ;
echo "j'ai ".$age; echo " ans. <br>";
if ($age >= 18) {
  echo "Vous êtes majeur <br><br>";
} else {
  echo "Vous êtes mineur <br><br>";
}
?>


<!-- **************************************  LES BOUCLES ************************************ -->
 **************************************  <u>LES BOUCLES</u> ************************************<br><br>;
<?php
echo "***** les boucles for ******<br>";
?>
<!--Afficher les nombres de 1 à 10 en ordre croissant, puis dans un ordre décroissant avec une boucle for.  -->
<!-- // Ordre croissant -->
<?php  
 for ($i = 1; $i <= 10; $i++) {  //boucle "for" en initialisant la variable $"i" à 1, en fixant la condition d'arrêt à 10 (inclus) et en incrémentant $"i" à chaque itération
    echo $i . "\n"; //utilise ensuite la fonction "echo" pour afficher la valeur de $"i", suivie d'un espace entre les lettres ("\n").
}
echo $i . "<br>";
// Ordre décroissant -->
for ($i = 10; $i >= 1; $i--) { //cette fois-ci on initialise $i à 10, on fixe la condition d'arrêt à 1 (inclus)
    echo $i . "\n";
}
echo $i . "<br><br>";
?>
<!-- Même chose avec une boucle while. -->
<?php
echo "***** les boucles while *****<br>";
?>
<?php
// Ordre croissant
$i = 1; //initialise la variable $i à 1 en dehors de la boucle, 
while ($i <= 10) {//puis on utilise une boucle while avec une condition d'arrêt de $i inférieur ou égal à 10.
    echo $i . "\n";
    $i++;
}
echo $i . "<br>";

// Ordre décroissant
$i = 10; //on initialise $i à 10 en dehors de la boucle,,
while ($i >= 1) {// on fixe une condition d'arrêt de $i supérieur ou égal à 1
    echo $i . "\n"; // et on décrémente $i dans la boucle.
    $i--;
}
echo $i . "<br><br>";

?>
<!-- Même chose avec la boucle foreach -->
<?php
 // Tableau des nombres de 1 à 10 en ordre croissant -->
$nombres_croissants = range(1, 10); //fonction range() pour créer un tableau contenant les nombres de 1 à 10
                                    //tableau est assigné à la variable $nombres_croissants.

// Boucle foreach pour afficher les nombres en ordre croissant -->
echo "**** Les Boucles foreach ****<br>";
foreach ($nombres_croissants as $nombre) { // assigne la valeur de l'élément à la variable $nombre
    echo $nombre . " ";                   //affiche cette valeur à l'aide de la fonction echo
} 

echo $i . "<br>";


 // Tableau des nombres de 1 à 10 en ordre décroissant -->
$nombres_decroissants = array_reverse(range(1, 10)); //array_reverse() pour créer un deuxième tableau contenant les mêmes nombres que $nombres_croissants, mais dans l'ordre décroissant

 // Boucle foreach pour afficher les nombres en ordre décroissant -->
foreach ($nombres_decroissants as $nombre) {
    echo $nombre . " ";                     //(" ") pour séparer les nombres affichés
}
?>

<!-- ******************************************** LES FONCTIONS ********************************************** -->
<br><br>************************************* <u>LES FONCTIONS</u> *************************************<br>
<?php

echo "<ul>Enumérer les nombres pairs compris entre 0 et 20 et afficher le résultat : ";
// fonction permettant d’énumérer les nombres pairs compris entre 0 et 20 et afficher le résultat.
function enumeratePairs() { // enumeratePairs() utilise une boucle for pour parcourir les nombres de 0 à 20 inclus
    for($i = 0; $i <= 20; $i += 2) { // avec un pas de 2 (pour ne sélectionner que les nombres pairs)
      echo $i . " ";        // la fonction affiche la valeur de la variable $i (qui correspond à un nombre pair) 
    }
  }
  // Appel de la fonction
  enumeratePairs();     //Pour utiliser cette fonction, il suffit d'appeler `enumeratePairs`().

?><br>
<?php
echo "<br>Nombre pairs compris entre 0 et n'importe quel entier : ";
// fonction permettant d’énumérer les nombres pairs compris entre 0 et n’importe quel entier et afficher le résultat
function enumeratePairsUpTo($n) {
    for($i = 0; $i <= $n; $i += 2) {
      echo $i . " ";
    }
  }?>
  <?php
  // Appel de la fonction avec un entier en argument
  enumeratePairsUpTo(30); // enumeratePairsUpTo(30) pour afficher tous les nombres pairs jusqu'à 30).
  

// une boucle qui produit une ligne horizontale de 8 étoiles
echo"<br><br>une boucle qui produit une ligne horizontale de 8 étoiles : <br>";
for($i = 1; $i <= 8; $i++) {
    echo "*";
  }
  ?>
<?php
echo"<br>produire un carré de 8 lignes horizontales, chacune contenant 8 étoiles * : <br>";
// produire un carré de 8 lignes horizontales, chacune contenant 8 étoiles *
for($i = 1; $i <= 8; $i++) {  // La première boucle for parcourt les 8 lignes du carré
  for($j = 1; $j <= 8; $j++) {   // La deuxième boucle for parcourt les 8 étoiles de chaque ligne.
    echo "*";  //À chaque itération de la boucle intérieure, la fonction echo affiche une étoile (*).
  }
  echo "<br>"; // revenir à la ligne après chaque ligne horizontale
}

echo"<br>Réaliser le même carré mais vide seuls les bords du carré sont apparents : <br>";
for($i = 1; $i <= 8; $i++) {  // La première boucle for parcourt les 8 lignes du carré
    for($j = 1; $j <= 8; $j++) { // La deuxième boucle for parcourt les 1 étoiles de chaque ligne.
        if($i== 1 || $i== 8 || $j== 1 || $j== 8){ // si "i" est égale à 1(8) mettre des étoiles
            echo"*";                              // de meme pour "j"
        }
        else {echo" &nbsp";                        // sinon espace
        }
    }
    echo "<br>"; // revenir à la ligne après chaque ligne horizontale
}
?>
<!-- ******************************************** LES TABLEAUX ********************************************** -->

<br><br>************************************* <u>LES TABLEAUX</u> *************************************<br>
<?php

echo"<br><u>Calcul de la somme de tous les nombres contenus dans ce tableau :</u> <br><br><ul> ";

// les éléments du tableau et le résultat du calcul 

$nombres = [4, 5.5, 6.8, 1, 2, 3];  // entrée des valeurs dans le tableau avec comme nom de variable "nombres"
$somme = 0;                         // variable "somme

foreach ($nombres as $nombre) {     // calcul
    echo $nombre . ", ";
    $somme += $nombre;
}

echo "**********************La somme de tous les nombres est: " . $somme ;


// Affiche le minimum et le maximum
echo"<br>";
echo"</ul><br><u>Affiche le minimum et le maximum du tableau sans utiliser les fonctions min() et max()
ainsi que les indices respectifs de ces valeurs. :</u> <br><br>";

$tableau = array(4, 5.5, 6.8, 1, 2, 3);

  $somme = 0;
  $valeur_la_plus_petite  = $tableau[0];
  $valeur_la_plus_grande = $tableau[0];

  foreach ($tableau as $valeur) {
   echo $valeur . "&nbsp;&nbsp;&nbsp;";

      $somme += $valeur;

/// Afficher la valeur min et max du tableau ( sans min() et max() )
      if ($valeur < $valeur_la_plus_petite) {
          $valeur_la_plus_petite  = $valeur;
      }
      if ($valeur > $valeur_la_plus_grande) {
          $valeur_la_plus_grande = $valeur;
      }
  }

  echo "<br>";

  echo "<ul>La plus petite valeur est : " . $valeur_la_plus_petite . "<br>";
  echo "La plus grande valeur est : " . $valeur_la_plus_grande;
echo "<br><br>";

// un nombre quelconque est dans ce tableau sans utiliser la fonction in_array()

echo "<u></ul>Ecrire une fonction qui dit si un nombre quelconque est dans ce tableau sans utiliser la fonction in_array() :</u> <br><br>";

function nombre_present($tableau, $nombre) {
    foreach ($tableau as $valeur) {
      if ($valeur == $nombre) {
        return true;
      }
    }
    return false;
  }
  $tableau = [4, 5.5, 6.8, 1, 2, 3];
  $nombre1 = 5.5; 
  $nombre2 = 7;         // vérifie si les nombres 5.5 et 7 sont présents dans le tableau
 
  if (nombre_present($tableau, $nombre1)) {
    echo "<ul>$nombre1 est présent dans le tableau";
  } else {
    echo "$nombre1 n'est pas présent dans le tableau ";  
  }
  echo "<br>"; 
  if (nombre_present($tableau, $nombre2)) {
    echo "$nombre2 est présent dans le tableau";
  } else {
    echo "$nombre2 n'est pas présent dans le tableau</ul>";  // le deuxième test renvoie "7 n'est pas présent dans le tableau".
  }

  echo "<br><br>";
//classer les éléments de ce tableau par ordre croissant sur utiliser les fonctions array_sort().
echo "<u>fonction qui permet de classer les éléments de ce tableau par ordre croissant sur utiliser les fonctions array_sort() : </u> <br>";
// une fonction de tri  est utiliser pour cela : 

function triCroissant($tableau) {
    $taille = count($tableau);                       //méthode de tri à bulles pour trier les éléments du tableau
    for ($i = 0; $i < $taille; $i++) {
        for ($j = $i + 1; $j < $taille; $j++) {      // renvoie un tableau trié par ordre croissant
            if ($tableau[$i] > $tableau[$j]) {
                $temp = $tableau[$i];
                $tableau[$i] = $tableau[$j];
                $tableau[$j] = $temp;
            }
        }
    }
    return $tableau;
}
// fonction pour trier le tableau :
$tableau = [4, 5.5, 6.8, 1, 2, 3];
$tableauTrié = triCroissant($tableau);
echo "<br>";
print_r($tableauTrié);                  // affiche le resultat

// Reécrire les fonctions 13 à 16 avec les fonctions natives de PHP
echo "<br><br><u>Les fonctions natives :</u><br><ul>";

// Tableau de 6 nombres
$numbers = [4, 5.5, 6.8, 1, 2, 3];

echo "<br>";

// 13. Calculer la somme de tous les nombres contenus dans ce tableau.
$sum = array_sum($numbers);
echo "Tableau : " . implode(", ", $numbers) . "\n";
echo "Somme : $sum \n";

echo "<br>";

// 14. Afficher le minimum et le maximum du tableau.
$min = $max = $numbers[0];
foreach ($numbers as $number) {
    if ($number < $min) {
        $min = $number;
    }
    if ($number > $max) {
        $max = $number;
    }
}
echo "Minimum : $min \n";

echo "<br>";

echo "Maximum : $max \n";

echo "<br>";

// 15. Vérifier si un nombre est dans le tableau.
function in_array_custom($number, $array) {
    foreach ($array as $value) {
        if ($number === $value) {
            return true;
        }
    }
    return false;
}
$search_number = 6.8;
if (in_array_custom($search_number, $numbers)) {
    echo "$search_number est dans le tableau \n";
} else {
    echo "$search_number n'est pas dans le tableau \n";
}

echo "<br>";

// 16. Trier le tableau par ordre croissant.
sort($numbers);
echo "Tableau trié : " . implode(", ", $numbers) . "\n";


//  ******************************************** FORMULAIRES ********************************************** -->
echo "<br><br>************************************* <u>FORMULAIRES</u> *************************************<br>";

// Créer un formulaire simple

echo "<br><br><u>Créer un formulaire simple : </u><br><br><ul>";
?>
 <form action="test.php" method="POST">       <!-- méthode POST pour l'envoi des données et pointe vers un fichier appelé "test.php"-->
<label for="monTexte">Entrez votre texte :</label>
 <input type="text" id="monTexte" name="monTexte">  <!--champ texte -->
 <button type="submit">Envoyer</button>       <!--bouton d'envoi -->
</form>

<?php
// Test sur le contenu du tableau global $_POST

if (isset($_POST['monTexte'])) {
  $texte = $_POST['monTexte'];   //tableau global $_POST Pour récupérer les données du formulaire dans le fichier "test.php"
  echo "Le texte que vous avez entré est : " . $texte;  //affiche le texte en utilisant la fonction echo, puis stocke le contenu du champ dans une variable $texte. 
}


//  ************************************ CONNEXION A LA BASE DE DONNEE ********************************************** 

// ******************* Création de la connexion Mysqli avec une base de données*************
echo "</ul><br><br><u>Connexion Mysqli avec une base de données : <br></u><ul> ";
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("<br>Erreur de connexion : " . $conn->connect_error);
}
echo "Connexion réussie";

// ******************* Création de la connexion PDO avec une base de données *************
echo "</ul><br><br><u>Connexion PDO avec une base de données : <br></u><ul> ";
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";

try {
  // Créer une connexion
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   
} catch(PDOException $e) {
    // Gestion des erreurs 
    echo "Erreur : " . $e->getMessage();
}
// Vérifier la connexion
if ($conn->connect_error) {
  die("<br>Erreur de connexion : " . $conn->connect_error);
}
echo "Connexion réussie";
?>

</body>
</html>


