<?php

/**
 * Reprenez le code de l'exercice précédent et transformez vos requêtes pour utiliser les requêtes préparées
 * la méthode de bind du paramètre et du choix du marqueur de données est à votre convenance.
 */

$server = "localhost";
$db = "table_test_php";
$user = "root";
$password = "";


try {
    $pdo = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $password);

    $sql1 = $pdo->prepare("
        INSERT INTO utilisateur VALUES (:id, :nom, :prenom, :email, :mdp, :adresse, :cp, :pays, :date_join)
    ");

    $id = null;
    $nom = "Ardoise";
    $prenom = "Chloé";
    $email = "chlochlo.bonjour@mail.com";
    $mdp = "manger123";
    $adresse = "4 BIS Ruelle vitou, Anor";
    $cp = 59186;
    $pays = "France";
    $date = '2021-02-26';

    $sql1->bindParam(':id', $id, PDO::PARAM_NULL);
    $sql1->bindParam(':nom', $nom);
    $sql1->bindParam(':prenom', $prenom);
    $sql1->bindParam(':email', $email);
    $sql1->bindParam(':mdp', $mdp);
    $sql1->bindParam(':adresse', $adresse);
    $sql1->bindParam(':cp', $cp, PDO::PARAM_INT);
    $sql1->bindParam(':pays', $pays);
    $sql1->bindParam(':date_join', $date);

    $sql1->execute();

    echo "1. Utilisateur ajouté <br>";

    $sql2 = $pdo->prepare( "
        INSERT INTO produit VALUES (?, ?, ?, ?, ?)
    ");

    $titre = "Tablette Milka";
    $prix = 2;
    $description_courte = "Une tablette de chocolat au lait de la marque Milka";
    $description_longue = "descriptioooooooon loooooooooooooooooooooooooooooonnnnnnnnnnguuuuuuuuuuuueeeeee";

    $sql2->bindParam(1, $id);
    $sql2->bindParam(2, $titre);
    $sql2->bindParam(3, $prix, PDO::PARAM_INT);
    $sql2->bindParam(4, $description_courte);
    $sql2->bindParam(5, $description_longue);

    $sql2->execute();

    echo "2. utilisateur ajouté <br>";

    $sql3 = $pdo->prepare("
        INSERT INTO utilisateur VALUES (:id, :nom, :prenom, :email, :mdp, :adresse, :cp, :pays, :date_join)
    ");

    $nom = "Peter";
    $prenom = "Parker";
    $email = "peter.parker@mail.com";
    $mdp = "spiderMan123";
    $adresse = "2 state Spider, New York";
    $cp = 65258;
    $pays = "USA";
    $date = '2021-02-26';

    $sql3->bindValue(":id", $id);
    $sql3->bindValue(":nom", $nom);
    $sql3->bindValue(":prenom", $prenom);
    $sql3->bindValue(":email", $email);
    $sql3->bindValue(":mdp", $mdp);
    $sql3->bindValue(":adresse", $adresse);
    $sql3->bindValue(":cp", $cp, PDO::PARAM_INT);
    $sql3->bindValue(":pays", $pays);
    $sql3->bindValue(":date_join", $date);

    $sql3->execute();

    $sql4 = $pdo->prepare( "
        INSERT INTO produit VALUES (?, ?, ?, ?, ?)
    ");

    $titre = "M&M's";
    $prix = 2;
    $description_courte = "une description courte";
    $description_longue = "descriptioooooooon loooooooooooooooooooooooooooooonnnnnnnnnnguuuuuuuuuuuueeeeee";

    $sql4->bindValue(1, $id);
    $sql4->bindValue(2, $titre);
    $sql4->bindValue(3, $prix, PDO::PARAM_INT);
    $sql4->bindValue(4, $description_courte);
    $sql4->bindValue(5, $description_longue);

    $sql4->execute();

}
catch (PDOException $e) {
    echo "Une erreur est survenue: ".$e->getMessage()."<br>";
    $pdo->rollBack();
}
