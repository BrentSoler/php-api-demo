<?php

    include './route/Route.php';

    include './api/read.php';
    include './api/post.php';
    include './api/update.php';
    include './api/read-single.php';

    $route = new Route();

    $route->add('/','Read'); //Read
    $route->add('/post','Post'); //Read
    $route->add('/update','Update'); //Read
    $route->add('/read-id','ReadSingle'); //Read

    $route->submit();