<?php
$config = new stdClass;

// optional configuration for monitoring script "mc-info"
$config->serverName = 'blockchains.example.io';
$config->serverOwner = 'Example Ltd.';
$config->externalIP = '11.22.33.44'; 

$chains = array();

// configuration for a Multichain blockchain
$chain = new stdClass;
$chain->name='chain1';                 // name to display in the web interface
$chain->rpchost='192.168.1.23';        // IP address of MultiChain node
$chain->rpcport=1234;                  // default-rpc-port from params.dat
$chain->rpcuser='multichainrpc';       // username for RPC from multichain.conf
$chain->rpcpassword='---password---';  // password for RPC from multichain.conf
$chains[] = $chain;

// you can use define further chains like this
/*
$chain = new stdClass;
$chain->name='chain2';
$chain->rpchost='...';
$chain->rpcport=2345;
$chain->rpcuser='multichainrpc';
$chain->rpcpassword='...';
$chains[] = $chain;
*/

$config->chains = $chains;
?>