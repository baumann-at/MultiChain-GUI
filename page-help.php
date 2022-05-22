			<div class="row">
				<div class="col-sm-12">
					<h3>Help</h3>
					<pre>
<?php
		$res = no_displayed_error_result($help, multichain('help'));
		echo(print_r($help, true) . "\r\n");
?>	
				</pre>				
				</div>
			</div>