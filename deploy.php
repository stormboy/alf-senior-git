<?php
	/**
	 * Site Deployment Script
	 *
	 * Will pull latest version of the site from github and rsync to testing server
	 */

	function ip_in_network($ip, $net_addr, $net_mask){ 
	    if($net_mask <= 0){ return false; } 
	        $ip_binary_string = sprintf("%032b",ip2long($ip)); 
	        $net_binary_string = sprintf("%032b",ip2long($net_addr)); 
	        return (substr_compare($ip_binary_string,$net_binary_string,0,$net_mask) === 0); 
	} 

	// 207.97.227.253/32, 50.57.128.197/32, 108.171.174.178/32, 50.57.231.61/32, 204.232.175.64/27, 192.30.252.0/22
	$ip = $_SERVER['REMOTE_ADDR'];
	$ok = ( ip_in_network($ip, "207.97.227.253",32) ||
		 ip_in_network($ip, "50.57.128.197",32) ||
		 ip_in_network($ip, "108.171.174.178",32) ||
		 ip_in_network($ip, "50.57.231.61",32) ||
		 ip_in_network($ip, "204.232.175.64",27) ||
		 ip_in_network($ip, "192.30.252.0",22)  ||
		 ip_in_network($ip, "192.168.236.0",24)  ||		# local network
		 ip_in_network($ip, "127.0.0.1",32) 			# localhost
		);
	$ok = true;
	if ($ok == false) {
		echo "not cool fella";
		return;
	}

	// make sure macports is in the shell path
	$path = getenv("PATH");
	putenv("PATH=/opt/local/bin:$path");
	
	// The commands
	$commands = array(
		'echo $PWD',
		'whoami',
		'git pull',
		'git status',
		'git submodule sync',
		'git submodule update',
		'git submodule status',
		'export SITE=alfred-senior; ~/deploy.sh',
	);

	// Run the commands for output
	$output = '';
	$output = date(DATE_ISO8601) . "\n";
	foreach($commands AS $command){
		// Run it
		$tmp = shell_exec($command);
		// Output
		$output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
		$output .= htmlentities(trim($tmp)) . "\n";
	}

	// write output to log file
	file_put_contents("/tmp/deploy_senior.txt", $output, FILE_APPEND);

	// Make it pretty for manual user access (and why not?)
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>GIT DEPLOYMENT SCRIPT</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<pre>
 .  ____  .    ____________________________
 |/      \|   |                            |
[| <span style="color: #FF0000;">&hearts;    &hearts;</span> |]  | Git Deployment Script v0.1 |
 |___==___|  /              &copy; oodavid 2012 |
              |____________________________|

<?php echo $output; ?>
</pre>
</body>
</html>
