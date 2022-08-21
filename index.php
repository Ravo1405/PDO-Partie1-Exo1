<?php
try {
    /** @var PDO $pdo  
     * Instance de l'objet PDO
     */
    $pdo = new PDO('mysql:host=localhost;dbname=colyseum;charset=utf8', 'root');
    /**
     * PDO::ATTR_ERRMODE et PDO::ERRMODE_EXCEPTION permettent de spécifier à PDO que l'on veux des Exceptions à la place des erreurs PHP. Cela va permettre de les attraper dans le catch.
     */
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    /**
     * Création de la requête SQL
     */
    $query = 'SELECT `id`, `lastName`, `firstName`, `birthDate`, `card`, `cardNumber` FROM `clients`';
    /**
     * $queryResult devient une instance de l'objet PCOStatement
     * $pdo->query() execute la requête SQL
     */
    $queryResult = $pdo->query($query);
    /**
     * Le fetchAll permet de récupérer un tableau avec les valeurs de la BDD
     * Le paramètre PDO::FETCH_OBJ permet de spécifier que le tableau de retour doit contenir un objet avec des attributs correspondant aux champs de la BDD.
     */
    $clientList = $queryResult->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $error) {
    die('Erreur : ' . $error->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 1</title>
</head>

<body>
    <h1>Liste des clients</h1>
    <?php
    /**
     * On vérifie d'abord que la requête SQL s'est bien déroulée. 
     * Si la requête s'est mal faite $clientList sera un false. Dans le cas contraire il sera un tableau
     */
    if (is_array($clientList)) { ?>
        <table>
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Carte</th>
                    <th>Numéro de carte</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                /**
                 * On parcours la liste des clients.
                 */
                foreach ($clientList as $client) { ?>
                    <tr>
                        <td><?= $client->id ?></td>
                        <td><?= $client->lastName ?></td>
                        <td><?= $client->firstName ?></td>
                        <td><?= $client->birthDate ?></td>
                        <td><?= $client->card ?></td>
                        <td><?= $client->cardNumber ?></td>
                    </tr>
                <?php   } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Une erreur est survenue veuillez contacter le service informatique</p>
    <?php }
    ?>
</body>

</html> 