<?php

require_once 'inc.php';

$mp3 = FPersistantManager::getInstance()->load('Mp3', $_GET['id']);

 header('Content-Description: File Transfer');
 header('Content-Lenght: '.$mp3->getSize() );
 header('Content-Type: '.$mp3->getType());
 header('Content-Disposition: attachment; filename= song.mp3');
 header('Expires: 0');
 header('Cache-Control: must-revalidate');
 header('Pragma: public');
 
 ob_clean();
 flush();
 echo $mp3->getMp3();
 exit;

?>
