<?php

/**
 * @package     External Joomla Authentication Plugin
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - @fititnt
 * @copyright   opyright (C) 2005 - 2011 Webdesign Assessoria em Tecnologia da Informacao
 * @license     GNU General Public License version 3. See license.txt
 */
include_once '../libraries/WebDig/WebDig.php';

$wd = new WebDig(); 
echo $wd->setDebug('plg_auth_joomlaexternal.log', TRUE)
    ->setTarget('http://fititnt.dev/bancada30/index.php?option=com_users&view=login')
    //->setTarget('http://fititnt.dev/bancada31/plugins/authentication/externaljoomla/test/dump-vars.php')
    ->setCookie()
    ->post( array(
            'username' => 'test',
            'password' => 'test'
             )
           )
    ->get('content');
$wd->debug();
