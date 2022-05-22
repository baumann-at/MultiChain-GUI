<?php
 	if (isset($_GET['block'])) {
 		$block = $_GET['block'];
 	} else {
	 	if (isset($getinfo['blocks'])) {
	 		$block = $getinfo['blocks'];
	 	} else {
	 		$block = 0;
	 	}
 	}	
?>

			<div class="row">
				<div class="col-sm-12">
					<h3>Infos</h3>
					<pre>
<?php
		echo("<h3>getinfo</h3>\r\n");
		$res = no_displayed_error_result($res2, multichain('getinfo'));
		echo(print_r($res2, true) . "\r\n");

		echo("<h3>getblockchaininfo</h3>\r\n");
		$res = no_displayed_error_result($res2, multichain('getblockchaininfo'));
		echo(print_r($res2, true) . "\r\n");
	
		echo("<h3>getblockchainparams</h3>\r\n");
	    $res = no_displayed_error_result($blockchainparams, multichain('getblockchainparams'), false);
		echo(print_r($blockchainparams, true) . "\r\n");

		echo("<h3>getruntimeparams</h3>\r\n");
		$res = no_displayed_error_result($runtimeparams, multichain('getruntimeparams'));
		echo(print_r($runtimeparams, true) . "\r\n");

// Network
		echo("<h3>getchunkqueueinfo</h3>\r\n");
		$res = no_displayed_error_result($res2, multichain('getchunkqueueinfo'));
		echo(print_r($res2, true) . "\r\n");

		echo("<h3>getchunkqueuetotals</h3>\r\n");
		$res = no_displayed_error_result($res2, multichain('getchunkqueuetotals'));
		echo(print_r($res2, true) . "\r\n");

		echo("<h3>getconnectioncount</h3>\r\n");
		$res = no_displayed_error_result($res2, multichain('getconnectioncount'));
		echo(print_r($res2, true) . "\r\n");

		echo("<h3>getnettotals</h3>\r\n");
		$res = no_displayed_error_result($res2, multichain('getnettotals'));
		echo(print_r($res2, true) . "\r\n");

	  	echo("<h3>getnetworkinfo</h3>\r\n");
		$res = no_displayed_error_result($networkinfo, multichain('getnetworkinfo'));
		echo(print_r($networkinfo, true) . "\r\n");

		echo("<h3>getpeerinfo</h3>\r\n");
		$res = no_displayed_error_result($peerinfo, multichain('getpeerinfo'));
		echo(print_r($peerinfo, true) . "\r\n");

// Wallet

		echo("<h3>getaddresses</h3>\r\n");
		$res = no_displayed_error_result($peerinfo, multichain('getaddresses'));
		echo(print_r($peerinfo, true) . "\r\n");

		echo("<h3>getwalletinfo</h3>\r\n");
		$res = no_displayed_error_result($peerinfo, multichain('getwalletinfo'));
		echo(print_r($peerinfo, true) . "\r\n");
?>	
				</pre>				
				</div>
			</div>