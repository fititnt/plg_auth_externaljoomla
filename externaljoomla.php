<?php

/**
 * @package     External Joomla Authentication Plugin
 * @author      Emerson Rocha Luiz - emerson at webdesign.eng.br - @fititnt
 * @copyright   opyright (C) 2005 - 2011 Webdesign Assessoria em Tecnologia da Informacao
 * @license     GNU General Public License version 3. See license.txt
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

/**
 * 
 */
class plgAuthenticationExternaljoomla extends JPlugin {

    /**
     *
     * @param String $credentials
     * @param String $options
     * @param Object $response
     */
    function onUserAuthenticate($credentials, $options, &$response) {

        jimport('joomla.user.helper');

        $response->type = 'externaljoomla';
        if (empty($credentials['password'])) {
            $response->status = JAUTHENTICATE_STATUS_FAILURE;
            $response->error_message = JText::_('JGLOBAL_AUTH_EMPTY_PASS_NOT_ALLOWED');
            return false;
        }

        $extj->set('url', $url);

        $content = $extj->getRemoteContent( array('POST' =>
                                                    array('email' => $credentials['username'],
                                                    'password' => $credentials['password'] )
                                                    )
                                            );

        if ($content == null) {
            $response->status = JAUTHENTICATE_STATUS_FAILURE;
            return;
        }

        $result = $extj->decodeJson($content);

        //print_r($result);
        //die();

        if (isset($result->error)) {
            $response->status = JAUTHENTICATE_STATUS_FAILURE;
            return;
        }

        if (isset($result->username)) {
            $response->username = $result->username;
        }

        if (isset($result->email)) {
            $response->email = $result->email;
        }

        if (isset($result->name)) {
            $response->fullname = $result->name;
        } else {
            $response->fullname = $credentials['username'];
        }

        // Success!
        $response->status = JAUTHENTICATE_STATUS_SUCCESS;
        $response->error_message = '';

        $response->status = JAUTHENTICATE_STATUS_SUCCESS;
        $response->error_message = '';
    }

}
