<?php

    $filename = "/etc/passwd";

    $real = realpath($filename);
    try {
      if (strpos($real, $filename) === 0) {
      echo file_get_contents($real);
      } else {
        throw new Exception('not allowed to access this file');
      }
    } catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }

?>