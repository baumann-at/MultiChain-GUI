<?php
// new configuration format (26.4.2022)

// configuration for username/password for MC-GUI 
$userConfig = new stdClass;
$userConfig->user = 'mc-gui';
$userConfig->pwd_hash = '64e94dbebe0e255fc853f101ea2ad17e44b82acac4ca0f51f2a57a478ba471f8'; // sha256 hash of password (lowercase)

// optional configuration for monitoring script "mc-info"
$mcInfoConfig = new stdClass;
$mcInfoConfig->serverName = 'blockchains.example.io';
$mcInfoConfig->serverOwner = 'Example Ltd.';
$mcInfoConfig->externalIP = '11.22.33.44'; 
$mcInfoConfig->user = 'mc-info'; 
$mcInfoConfig->pwd_hash = 'ae36b2bcb85fa4a67cd4201582e296960bcec56f2c99bbf94ef52e636100d06b'; // sha256 hash of password (lowercase)


// configuration for chains
$chains = array();

// configuration for a Multichain blockchain
$chain = new stdClass;
$chain->name='chain1';                 // name to display in the web interface
$chain->rpchost='192.168.1.23';        // IP address of MultiChain node
$chain->rpcport=1234;                  // default-rpc-port from params.dat
$chain->rpcsecure=0;                   // set to 1 to access RPC via https (e.g. for MultiChain on Azure)
$chain->rpcuser='multichainrpc';       // username for RPC from multichain.conf
$chain->rpcpassword='---password---';  // password for RPC from multichain.conf
$chains[] = $chain;

// you can use define further chains like this
/*
$chain = new stdClass;
$chain->name='chain2';
$chain->rpchost='...';
$chain->rpcport=2345;
$chain->rpcsecure=0;
$chain->rpcuser='multichainrpc';
$chain->rpcpassword='...';
$chains[] = $chain;
*/

$config = new stdClass;
$config->chains = $chains;

?>