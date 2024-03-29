Multichain GUI
==================
Multichain GUI is a simple Web GUI for MultiChain Blockchains, it is forked and strongly based on [MultiChain Web Demo](https://github.com/MultiChain/multichain-web-demo) - Details see below.

    Powered by baumann.at
    License: GNU Affero General Public License, see the file LICENSE.txt.

Changes / extensions to the original version:

* Changed configuration method to eliminate security risks: Configuration is now a php file.
* More details displayed for the connected nodes.
* Menubar optimized.
* Integration of a (simple) Block Explorer.
* Integrated mc-info (query infos for monitoring using /mc-info.php).
* New (26.4.2022): Added access control: user/password can be defined for the Web-GUI and the mc-info function.
* New (22.5.2022): Added "info" and "help" pages.


MultiChain Web Demo
===================

MultiChain Web Demo is a simple web interface for [MultiChain](http://www.multichain.com/) blockchains, written in PHP.

https://github.com/MultiChain/multichain-web-demo

    Copyright(C) Coin Sciences Ltd.
    License: GNU Affero General Public License, see the file LICENSE.txt.


Welcome to MultiChain Web Demo
==============================

This software uses PHP to provide a web front-end for a [MultiChain](http://www.multichain.com/) blockchain node.

It currently supports the following features:

* Viewing the node's overall status.
* Creating addresses and giving them real names (names are visible to all nodes).
* Changing global permissions for addresses.
* Issuing assets, including custom fields and uploading a file.
* Updating assets, including issuing more units and updating custom fields and file.
* Viewing issued assets, including the full history of fields and files.
* Sending assets from one address to another.
* (Creating, decoding and accepting offers for exchanges of assets. <= disabled in this fork)
* Creating streams.
* Publishing items to streams, as JSON or text or an uploaded file.
* Viewing stream items, including listing by key or publisher and downloading files.
* (Writing, testing and approving Smart Filters (both transaction and stream filters).  <= disabled in this fork)
* A (simple) block explorer to display a list of blocks and details (transactions ...) of each block. <= NEW in this fork

System Requirements
-------------------

* A computer running web server software such as Apache.
* PHP 5.x or later with the `curl` and `JSON` extensions.
* MultiChain 2.0 or later.


Create and launch a MultiChain Blockchain
-----------------------------------------

If you do not yet have a chain to work with, [Download MultiChain](http://www.multichain.com/download-install/) to install MultiChain and create a chain named `chain1` as follows:

    multichain-util create chain1
    multichaind chain1 -daemon
    
If your web server is running on the same computer as `multichaind`, you can skip the rest of this section. Otherwise:

    multichain-cli chain1 stop

Then add this to `~/.multichain/chain1/multichain.conf`:

    rpcallowip=[IP address of your web server]
  
Then start MultiChain again:
  
    multichaind chain1 -daemon



Configure the Web GUI
---------------------

_This section assumes your blockchain is named `chain1` and you are running the node and web server on a Unix variant such as Linux. If not, please substitute accordingly._

Make your life easy for the next step by running these on the node's server:

    cat ~/.multichain/chain1/multichain.conf
    grep rpc-port ~/.multichain/chain1/params.dat
    
In the web gui directory, copy the `config-example.php` file to `config.php`:

	cp config-example.php config.php
  
Enter optional configuration and details for one (or more) chains in `config.php` e.g.:

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


Launch the Web GUI
-------------------

No additional configuration or setup is required. Based on where you installed the web gui, open the appropriate address in your web browser, and you are ready to go!


Using data output for monitoring
--------------------------------

The script "mc-info.php" collects different information about the configured nodes and builds a JSON response, which can be used e.g. for monitoring purposes.


