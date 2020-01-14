<?php

	$getinfo = multichain_getinfo();
	$highestBlock = $getinfo['blocks'];

 	if (isset($_GET['hash'])) {
 		$hash = $_GET['hash'];
 	} else {
 		$hash = '';
 	}

//CB das auch noch "sauber" implementieren. Wie ??? :-(
	$chain = $_GET['chain'];

?>

			<div class="row">
				<div class="col-sm-12">
					<h3>Block</h3>
<?php
    $res = no_displayed_error_result($block, multichain('getblock', $hash));
		//CB if not $res ...

//		echo("<pre>");
//		var_dump($block);
//		echo("</pre>");
		
		echo('<table class="table table-bordered table-condensed table-break-words table-striped">');
		
		$urlStart = "?chain=" . $chain . "&page=blocks&block=";
		$url = '<a href="' . $urlStart . $block['height'] . '">' . $block['height'] . '</a>';
		echo(tableRow('Height', $url));
		
    $time = gmdate('Y-m-d H:i:s', $block['time']) . " GMT";
		echo(tableRow('Time', $time));

		echo(tableRow('Hash', $block['hash']));
		echo(tableRow('Miner', $block['miner']));
		echo(tableRow('Confirmations', $block['confirmations']));
		echo(tableRow('Version', $block['version']));
		echo(tableRow('Size', $block['size']));

		echo(tableRow('Merkleroot', $block['merkleroot']));
    
		
		echo(tableRow('Nonce', $block['nonce']));
		echo(tableRow('Bits', $block['bits']));
		echo(tableRow('Difficulty', $block['difficulty']));
		echo(tableRow('Chainwork', $block['chainwork']));

// http://test.baumann.at/multichain2/?chain=default&page=block&hash=00287a4d93086c0c15deb1ca9c9b9e65970295b5d325392f4ed983032c370fa3
		$urlStart = "?chain=" . $chain . "&page=block&hash=";
		if (isset($block['previousblockhash'])) {
			$url = '<a href="' . $urlStart . $block['previousblockhash'] . '">' . $block['previousblockhash'] . '</a>';
			echo(tableRow('Previous', $url));
		}	
		if (isset($block['nextblockhash'])) {
			$url = '<a href="' . $urlStart . $block['nextblockhash'] . '">' . $block['nextblockhash'] . '</a>';
			echo(tableRow('Next', $url));
		}	
		
    $txCount = count($block['tx']);
		echo(tableRow('Transactions', $txCount));

    $txIndex = 1;
    foreach($block['tx'] as $txid)
    {
			$res = no_displayed_error_result($tx, multichain('getrawtransaction', $txid, 1));
			//var_dump($tx);
			echo(tableRowTrans('Tx ' . $txIndex, $tx));
			$txIndex++;
    }
		
		echo('</table>');
?>					
				</div>
			</div>
			
<?php
function tableRow($name, $data) {
	return <<<HEREDOC
<tr>
	<th style="width:15%;">$name</th>
	<td>$data</td>
</tr>	
HEREDOC;
}

function tableRowTrans($name, $trans) {
	$pre = print_r($trans, true);
	return <<<HEREDOC
<tr>
	<th style="width:15%;">$name</th>
	<td><pre>$pre</pre></td>
</tr>	
HEREDOC;
}


?>
