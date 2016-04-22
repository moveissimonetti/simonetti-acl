<?php

require_once('vendor/autoload.php');

use Simonetti\ACL\Client as SimonettiACL;

$acl = SimonettiACL::getInstance();

$token = $acl->auth('seu usuario', 'sua senha');

/*
 * Retorna um array com os dados do token
 *
 * Exemplo:
 *
 * Array
 * (
 *     [access_token] => 74858820f66a6e154a0b6888b8a3a2f17f35de3c
 *     [expires_in] => 28800
 *     [token_type] => Bearer
 *     [scope] =>
 *     [refresh_token] => d799aa680496414e883dea82249fdff12fc19b73
 * )
 *
 */

