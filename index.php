<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

echo $twig->render('index.html.twig', array('name' => 'Fabien'));