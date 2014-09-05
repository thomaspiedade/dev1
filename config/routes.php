<?php
use Respect\Rest\Router;
$Router  = new Router();
#Home
$Router->get('/', function() {
        return 'Home';
});

#User Routes
$Router->any('/user/*', 'App\\Controllers\\UserController', array( $Storage ));
