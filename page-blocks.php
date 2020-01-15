<?php
$getinfo = multichain_getinfo();
$highestBlock = $getinfo['blocks'];
$offset = isset($_GET['block']) ? (int)$_GET['block'] : $highestBlock;
if ($offset > $highestBlock) {
    $offset = $highestBlock;
}
$chain = $_GET['chain'];
?>
			<div class="row">
				<div class="col-sm-12">
					<h3>Blocks</h3>
<?php
echo <<<HEREDOC
    <table class="table table-bordered table-condensed table-break-words table-striped">
    <tr><th>Block</th>
    <th>Hash</th>
    <th>Miner</th>
    <th>Time (UTC)</th>
    <th>Size</th>
    <th>Transactions</th>
    </tr>
HEREDOC;


$numBlocksPerPage = 16;
$n = $numBlocksPerPage;
$i = $offset;
while ($i >= 0 && $n--) {
    $res = no_displayed_error_result($hash, multichain('getblockhash', $i));
    $hashShort = substr($hash, 0, 16);
    $res = no_displayed_error_result($block, multichain('getblock', $hash));
    $time = gmdate('Y-m-d H:i:s', $block['time']) . " GMT";
    $minerShort = substr($block['miner'], 0, 16);
    $confirmations = $block['confirmations'];
    $size = $block['size'];
    $txCount = 0;
    foreach ($block['tx'] as $txid) {
        $txCount++;
    }

    $hashUrl = "?chain=" . $chain . "&page=block&hash=" . $hash;
    echo "<tr><td>$i</td><td><a href=\"$hashUrl\">$hashShort ...</a></td><td>$minerShort ...</td><td><a title=\"{$block['time']}\">$time</a></td><td>$size</td><td>$txCount</td></tr>";
    $i--;
}
$urlStart = "?chain=" . $chain . "&page=blocks&block=";
$newer = $offset < $highestBlock ? '<a href="' . $urlStart . ($offset + $numBlocksPerPage) . '">&lt; Newer</a>' : '&lt; Newer';
$older = $i != - 1 ? '<a href="' . $urlStart . ($offset - $numBlocksPerPage) . '">Older &gt;</a>' : 'Older &gt;';
$i++;
$first = '';
if ($offset >= $numBlocksPerPage) {
    $first = '- <a href="' . $urlStart . ($numBlocksPerPage - 1) . '">First</a>';
}
echo "<tr><td colspan='6'>$newer - $older $first</td></tr></table>";
?>					
				</div>
			</div>
