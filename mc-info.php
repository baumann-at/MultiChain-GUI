<?php
/**
 * Functions to collect and build information about a server running one or
 * more Multichain nodes, based on the configuration in config.php
 *
 * @author    Chris Baumann <c.baumann@baumann.at>
 * @copyright 2020 baumann.at - concepts & solutions
 * @version   mc-info v0.2 - 26.4.2022
 */

require_once 'functions.php';
require_once 'auth_lib.php';

list($configs, $userConfig, $mcInfoConfig) = read_config();

//check mc-info password if used
if (isset($mcInfoConfig->user)) {
	if (authOK($mcInfoConfig->user, $mcInfoConfig->pwd_hash, 'mc-info requires a valid user')) {};
}

$nodes = array();
foreach ($configs as $config) {
    $name = $config['name'];
    $nodes[$name] = getChainInfo($config);
}

$mcInfo = new stdClass;
$mcInfo->serverName = $mcInfoConfig->serverName;
$mcInfo->serverOwner = $mcInfoConfig->serverOwner;
$mcInfo->version = 'mc-info v0.1';
$mcInfo->extIPconfigured = $mcInfoConfig->externalIP;

$res = new stdClass;
$res->mcInfo = $mcInfo;
$res->nodes = $nodes;

header("Content-Type: application/json; charset=UTF-8");
echo (json_encode($res));

function getChainInfo($config) {
    $res = array();
    set_multichain_chain($config);

    $getInfo = multichain('getinfo');

    if (isset($getInfo['error']['code'])) {
        $res['status'] = 'Error: Blockchain API returns: ' . $getInfo['error']['code'];
        return ($res);
    }

    $res['status'] = 'OK 200';
    $res['getinfo'] = $getInfo['result'];
    $res['getconnectioncount'] = multichain('getconnectioncount') ['result'];
    $res['getpeerinfo'] = multichain('getpeerinfo') ['result'];
    return ($res);
}

?>