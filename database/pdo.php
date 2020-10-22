<?php
$pdo = new PDO(
   'mysql:host=localhost;port=3306;dbname=people',
   'root'
);
// See the "errors" folder for details...
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



/*
 *
 *   $stmt = $pdo->query("SELECT id, alias, password, alta FROM personas");

   echo '<table border="1">'."\n";
   while($row = $stmt->fetch((PDO::FETCH_ASSOC))){
    echo "<tr><td>";
    
    echo($row['id']);
    echo "</td><td>";
    echo($row['alias']);
    echo "</td><td>";
    echo($row['password']);
    echo "</td><td>";
    echo($row['alta']);
    echo "</td><td>";

    echo "</td></tr>\n";
   }
   echo "</table>\n"; 
 * 
 * 
 * 
 * 
 */