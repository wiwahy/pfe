<?php
    $serveur = "localhost"; $dbname = "pfe"; $user = "root"; $pass = "";
    
    $nom = valid_donnees($_POST["nom"]);
    $prenom = valid_donnees($_POST["prenom"]);
    $email = valid_donnees($_POST["email"]);
    $password = valid_donnees($_POST["password"]);
    
    function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }
    
    /*Si les champs prenom et mail ne sont pas vides et si les donnees ont
     *bien la forme attendue...*/
    if (!empty($prenom)
        &&!empty($nom)
        &&!empty($email)
        && !empty($password)){
    
        try{
            //On se connecte à la BDD
            $dbco = new PDO("mysql:host=$serveur;dbname=$dbname",$user,$pass);
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //On insère les données reçues
            $sth = $dbco->prepare("
                INSERT INTO utilisateur(nom,prenom, email, mdp )
                VALUES(:nom, :prenom, :email, :password)");
            $sth->bindParam(':nom',$nom);
            $sth->bindParam(':prenom',$prenom);
            $sth->bindParam(':email',$email);
            $sth->bindParam(':password',$password);
            $sth->execute();
            //On renvoie l'utilisateur vers la page de remerciement
            header("Location:acceuil_utilisateur.php.html");
        }
        catch(PDOException $e){
            echo 'Erreur : '.$e->getMessage();
        }
    }else{
        header("Location:connexion_utilisateur.php");
    }
?>