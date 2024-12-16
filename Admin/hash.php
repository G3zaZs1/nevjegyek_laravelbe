<?php

    $jelszo = "Juliska";

    print "Jelszó: $jelszo <br>";
    print "md5(): " . md5($jelszo) . "<br>";

    print "sha1(): " . sha1($jelszo). "<br>";

    print "sha3-256(): " . hash('sha3-256', $jelszo). "<br>";

    print "sha3-512(): " . hash('sha3-512', $jelszo). "<br>";

?>