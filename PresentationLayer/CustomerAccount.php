<?php 
	require_once("LogicLayer/CustomerManager.php");
	require_once("LogicLayer/AccountManager.php");
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
        <title>Accounts</title>
		<link rel="stylesheet" type="text/css" href="style/site.css">
	</head>
	<body> 
		<?php
			if(isset($activeUser)) {
				
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
							
							<td>
							<input type="submit" name="logout" id="logout" value="Log Out"/>
							</td>
						</tr>
						<tr>
							<th>Account Number</th>
							<th>Balance</th>
							<th>Branch</th>
						</tr>
						<?php 
							$AccountList = AccountManager::getAllAccountbyCustomer($activeUser->getCustomer_ID());
							
							for($i = 0; $i< count($AccountList); $i++) {
							?>
							<tr>
								<td><?php echo $AccountList[$i]->getAccount_Number(); ?></td>
								<td><?php echo $AccountList[$i]->getBalance(); ?></td>
								<td><?php echo $AccountList[$i]->getBranch(); ?></td>
								
							</tr>
							<?php
							}
						    ?>
							<tr>
								<td>
								<input type="submit" name="back" value="Back Main Panel" />
								</td>
								<td></td>
								<td></td>
								<?php 
									if(isset($_POST["back"])) {
										header("location: PersonalUIExternal.php");
									}
									if(isset($_POST["logout"])) {
										header("location: PersonalLoginPanel.php");
									}
								?>
							</tr>
						
					</tbody>
					
				</table>
				
				
						
				
						
				
			</form>
		</div>
		<?php
			}
			else {
					echo "<a href='PersonaLoginPanel.php'>Giri� yap�n�z!</a>";
				}
		?>
	</body> 
</html>