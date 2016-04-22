<?php

require_once('vendor/autoload.php');

use Simonetti\ACL\Client as SimonettiACL;

$acl = SimonettiACL::getInstance();

if ($acl->isAllowed('simonetti.access.user.create', $token['access_token'])) {
    // executa o que for necessario
}
