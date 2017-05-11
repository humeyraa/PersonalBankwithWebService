<?php 
	require_once("LogicLayer/CustomerManager.php");
	session_start();
	$activeUser = null;
	
	if(isset($_SESSION['activeUser'])) {
		$activeUser =  $_SESSION['activeUser'];
	}
?>
<!DOCTYPE html>
<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>Personal Interface</title>
		<link rel="stylesheet" type="text/css" href="style/site.css">
	</head>
	<body> 
		<?php
			if(isset($activeUser)) {
				$customer = CustomerManager::getCustomerbyID($activeUser->getCustomer_ID());
		?>
		<div id="dvMain">
			<form method="POST" action="<?php $_PHP_SELF ?>">
				<table id="tblUsers">
					<tbody>
						<tr>
							<?php 
								if(isset($activeUser)) {
							?> 
							<th><?php echo "Welcome " . $activeUser->getCustomer_Name(); ?> </th>
							<?php
							}
							?>
							<td></td>
							<td></td>
							<td>
							<input type="submit" name="logout" id="logout" value="Log Out"/>
							</td>
						</tr>
						
						<tr>
							<td><a>TC No:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_TC() ?> <a/></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><a>Customer Number:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_Number() ?> <a/></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
						
							<td><a>Password:<a/></td>
							<td><label><?php echo $customer[0]->getCustomer_Password() ?></label></td>
							<td><input type="text" name="pass" /></td>
							<td><input type="submit" name="updatepass" id="updatepass" value="Update"/></td>
						</tr>
						<tr>
							<td><a>Birth Date:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_BirthDate() ?> <a/></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><a>Phone No:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_Phone() ?> <a/></td>
							<td><input type="text" name="phone" /></td>
							<td><input type="submit" name="updatephone" id="updatephone" value="Update"/></td>
						</tr>
						<tr>
							<td><a>E-Mail Address:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_Email() ?> <a/></td>
							<td><input type="text" name="email" /></td>
							<td><input type="submit" name="updateemail" id="updateemail" value="Update"/></td>
						</tr>
						<tr>
							<td><a>Home Address:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_Address() ?> <a/></td>
							<td><input type="text" name="address" /></td>
							<td><input type="submit" name="updateaddress" id="updateaddress" value="Update"/></td>
						</tr>
						<tr>
							<td><a>Loan Point:<a/></td>
							<td><a><?php echo $customer[0]->getCustomer_LoanPoint() ?> <a/></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td><input type="submit" name="showAccount" id="showAccount" value="Show My Accounts"/></td>
							<td><input type="submit" name="moneyTransfer" id="moneyTransfer" value="Money Transfer on Account"/></td>
							<td></td>
							<td></td>
						</tr>
						
						
						
						<?php
					
							if(isset($_POST["updatepass"])) {
								
								$cus_pass = trim($_POST["pass"]);
								
								if($cus_pass != '' && strlen($cus_pass) ==6){
									
										$result = CustomerManager::UpdatePassword($activeUser->getCustomer_ID(),$cus_pass);
										
								}
							}
							
							if(isset($_POST["updatephone"])) {
								
								$cus_phone = trim($_POST["phone"]);
								
								if($cus_phone != '' && strlen($cus_phone) ==11){
									
										$result = CustomerManager::UpdatePhone($activeUser->getCustomer_ID(),$cus_phone);
										
								}
							}
							if(isset($_POST["updateemail"])) {
								
								$cus_email = trim($_POST["email"]);
								
								if($cus_email != ''){
									
										$result = CustomerManager::UpdateEmail($activeUser->getCustomer_ID(),$cus_email);
										
								}
							}
							
							if(isset($_POST["updateaddress"])) {
								
								$cus_address = trim($_POST["address"]);
								
								if($cus_address != '' ){
									
										$result = CustomerManager::UpdateAddress($activeUser->getCustomer_ID(),$cus_address);
										
								}
							}
							if(isset($_POST["showAccount"])) {
								header("location: CustomerAccountExternal.php");
							}
							if(isset($_POST["moneyTransfer"])) {
								header("location: CustomerMoneyTransferExternal.php");
							}
							if(isset($_POST["logout"])) {
								header("location: PersonalLoginPanel.php");
							}
							
						
						?>
						
						
					</tbody>
					
				</table>
				
				
						
				
						
				
			</form>
		</div>
		<?php
			}
			else {
					echo "<a href='PersonaLoginPanel.php'>Giriþ yapýnýz!</a>";
				}
		?>
	</body> 
</html>