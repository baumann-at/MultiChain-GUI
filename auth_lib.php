<?php
/**
 * Library to enable authentication (http Basic auth) based on
 * one set of credentials
 *
 * @author    Chris Baumann <c.baumann@baumann.at>
 * @copyright 2020 baumann.at - concepts & solutions
 * @version   v0.2 - 29.9.2020: switch to sha256 hash for password
 *
 */

/*
example usage:
if authOK('someUser', hash('sha256', 's3cr3tPA55')) { ... }
*/

/**
 * Checks if http connection is authenticated correctly.
 * if not, responds with usual http 401 headers and exists.
 * Checking is only done, if requiredUser is set.
 *
 * @param string requiredUser (username)
 * @param string requiredPassHash (sha256 hash of password)
 * @return boolean (true) on successful authentication
 */
function authOK($requiredUser, $requiredPassHash, $realm = 'default realm') {
    if (!isset($requiredUser)) {
        return (true);
    }
    if (isset($_SERVER['PHP_AUTH_USER']) and isset($_SERVER['PHP_AUTH_PW'])) {
        if (($_SERVER['PHP_AUTH_USER'] == $requiredUser) and (hash('sha256', $_SERVER['PHP_AUTH_PW']) == $requiredPassHash)) {
            return (true);
        }
    }
    header('WWW-Authenticate: Basic realm="' . $realm . '"');
    header('HTTP/1.0 401 Unauthorized', true, 401);
    echo($realm);
    exit;
}

?>
