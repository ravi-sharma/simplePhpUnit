<?php

// including file
require_once 'UserHierarchy.php';

$userHierarchy = new UserHierarchy();

// setting data
$userHierarchy->setRoles('fixtures/roles.json');
$userHierarchy->setUsers('fixtures/users.json');

// calling
echo $userHierarchy->getSubOrdinates(intval($argv[1]));