//<?php
//echo "truncateSong.php per svuotare la table loadSong.php per fare il download di un brano dal db storeSong.php per l'upload";

<?php
$dbname = 'musicwebapp';

if (!mysql_connect('localhost', 'gruppo2', 'lautz97')) {
    echo 'Could not connect to mysql';
    exit;
}

$sql = "SHOW TABLES FROM $dbname";
$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
    echo "Table: {$row[0]}\n";
}

mysql_free_result($result);
?>

//?>
