<?php



$db = new mysqli('127.0.0.1', 'root', null, 'inventory_forms', 3306, null);

$result = $db->query('SELECT * FROM vendors');

/*$vendors = $result->fetch_assoc();*/

/*print_r($vendors); exit;*/

	/*$form = "
		<h2>Updating Vendor ID Number ".$vendor['id']."</h2>
		<label for=''></label><br>
		<input type='hidden' name='id' value='".$vendor['id']."'/>
		<br><br>
		<label for=''>(LOCKED) Vendor Name is ".$vendor['name']."</label><br>
		<input type='text' name='' value='".$vendor['name']."' readonly />
		<br><br>
		<label for='addr1'>*Address 1</label><br>
		<input type='text' name='addr1' value='".$vendor['addr1']."' required/>
		<br><br>		
		<label for='addr2'>Address 2 (opt)</label><br>
		<input type='text' name='addr2' value='".$vendor['addr2']."'/>
		<br><br>
		<label for='city'>*City</label><br>
		<input type='text' name='city' value='".$vendor['city']."' required/>
		<br><br>
		<label for='region'>*State</label><br>
		<input type='text' name='region' value='".$vendor['region']."' required/>
		<br><br>
		<label for='zip'>Zip Code</label><br>
		<input type='text' name='zip' value='".$vendor['zip']."'/>
		<br><br>
		<label for='phone'>Phone</label><br>
		<input type='text' name='phone' value='".$vendor['phone']."'/>
		<br><br>
		<label for='fax'>FAX</label><br>
		<input type='text' name='fax' value='".$vendor['fax']."'/>
		<br><br>
	";*/


if(!isset($_POST['submit']))
	{
	//build a new user form for them to update vendor record.
	$i=0;
	while($vendor = $result->fetch_assoc()){
		if($vendor['city'] === 'city needed'){
			
			$form = "<h2>Updating Vendor ID Number ".$vendor['id']."</h2>
			<label for=''></label><br>
			<input type='hidden' name='id' value='".$vendor['id']."'/>
			<br><br>
			<label for=''>(LOCKED) Vendor Name is ".$vendor['name']."</label><br>
			<input type='text' name='' value='".$vendor['name']."' readonly />
			<br><br>
			<label for='addr1'>*Address 1</label><br>
			<input type='text' name='addr1' value='".$vendor['addr1']."' required/>
			<br><br>		
			<label for='addr2'>Address 2 (opt)</label><br>
			<input type='text' name='addr2' value='".$vendor['addr2']."'/>
			<br><br>
			<label for='city'>*City</label><br>
			<input type='text' name='city' value='".$vendor['city']."' required/>
			<br><br>
			<label for='region'>*State</label><br>
			<input type='text' name='region' value='".$vendor['region']."' required/>
			<br><br>
			<label for='zip'>Zip Code</label><br>
			<input type='text' name='zip' value='".$vendor['zip']."'/>
			<br><br>
			<label for='phone'>Phone</label><br>
			<input type='text' name='phone' value='".$vendor['phone']."'/>
			<br><br>
			<label for='fax'>FAX</label><br>
			<input type='text' name='fax' value='".$vendor['fax']."'/>
			<br><br>";		

			echo '<!doctype HTML>
			<html>
				<head>
				</head>
				<body>
					<form action="'.$_SERVER["PHP_SELF"].'" method="post">
						'.$form.'
						<input type="submit" name="submit" label="submit"/>
					</form>
				</body>
			</html>';
			exit;
		}
		$i++;
	}
}
else
{
	//form has been submitted:
	$db = null; 
	$db = new mysqli('127.0.0.1', 'root', null, 'inventory_forms', 3306, null);

	$result = $db->query('SELECT * FROM vendors');
}

?>
