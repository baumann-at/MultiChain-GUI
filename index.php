<?php
	
	require_once 'functions.php';
	
	$mcInfoConfig = new stdClass;
	$config=read_config();
	$chain=@$_GET['chain'];
	
	if (strlen($chain))
		$name=@$config[$chain]['name'];
	else
		$name='';

	set_multichain_chain($config[$chain]);
		
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>MultiChain GUI</title>
		<link rel="stylesheet" href="bootstrap.min.css">
		<link rel="stylesheet" href="styles.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
			<h1><a href="./">MultiChain</a><?php if (strlen($name)) { ?> &ndash; <?php echo html($name)?><?php } ?></h1>
<?php
	if (strlen($chain)) {
		$name=@$config[$chain]['name'];
?>
			
			<nav class="navbar navbar-default">
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="./?chain=<?php echo html($chain)?>">Node</a></li>
						<li><a href="./?chain=<?php echo html($chain)?>&page=permissions">Permissions</a></li>

						<li><a href="./?chain=<?php echo html($chain)?>&page=issue" class="pair-first">Assets: Issue</a></li>
						<li><a href="./?chain=<?php echo html($chain)?>&page=update" class="pair-second">| Update</a></li>
						<li><a href="./?chain=<?php echo html($chain)?>&page=send" class="pair-second">| Send</a></li>
<!--						
						<li><a href="./?chain=<?php echo html($chain)?>&page=offer" class="pair-first">Offer: Create</a></li>
						<li><a href="./?chain=<?php echo html($chain)?>&page=accept" class="pair-second">| Accept</a></li>
-->						
						<li><a href="./?chain=<?php echo html($chain)?>&page=create" class="pair-first">Streams: Create</a></li>
						<li><a href="./?chain=<?php echo html($chain)?>&page=publish" class="pair-second">| Publish</a></li>
						<li><a href="./?chain=<?php echo html($chain)?>&page=view" class="pair-second">| View</a></li>
						<li><a href="./?chain=<?php echo html($chain)?>&page=blocks">Blocks</a></li>

<?php
	if (false and multichain_has_smart_filters()) {
?>						

						<li><a href="./?chain=<?php echo html($chain)?>&page=txfilter" class="pair-first">Filters: Transaction</a></li>
						<li><a href="./?chain=<?php echo html($chain)?>&page=streamfilter" class="pair-second">| Stream</a></li>

<?php
	}
?>

					</ul>
				</div>
			</nav>

<?php
		switch (@$_GET['page']) {
			case 'label':
			case 'permissions':
			case 'issue':
			case 'update':
			case 'send':
			case 'offer':
			case 'accept':
			case 'create':
			case 'publish':
			case 'view':
			case 'txfilter':
			case 'streamfilter':
			case 'approve':
			case 'asset-file':
			case 'blocks':
			case 'block':

				require_once 'page-'.$_GET['page'].'.php';
				break;
				
			default:
				require_once 'page-default.php';
				break;
		}
		
	} else {
?>
			<p class="lead"><br/>Choose an available node to get started:</p>
		
			<p>
<?php
		foreach ($config as $chain => $rpc)
			if (isset($rpc['rpchost']))
				echo '<p class="lead"><a href="./?chain='.html($chain).'">'.html($rpc['name']).'</a><br/>';
?>
			</p>
<?php
	}
?>
		</div>
	</body>
</html>