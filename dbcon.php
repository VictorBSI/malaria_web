<?php
    require __DIR__.'/vendor/autoload.php';

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\Auth;

    $factory = (new Factory)
        ->withServiceAccount(__DIR__.'/malaria-b6c23-firebase-adminsdk-nrxuc-d1e4cc5092.json')
        ->withDatabaseUri('https://malaria-b6c23-default-rtdb.firebaseio.com/'); 
    $database = $factory->createDatabase();
    $auth = $factory->createAuth();

?>