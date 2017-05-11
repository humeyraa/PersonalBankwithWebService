<?php 
	require_once("LogicLayer/AccountManager.php");
	session_start();
	$activeUser = null;
	
	if(isset($_SESSION['activeUser'])) {
		$activeUser =  $_SESSION['activeUser'];
	}
	
	
	
?>

<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>Account List and Delete Panel </title>
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
							<th><?php echo "Welcome Admin " . $activeUser; ?> </th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th><input type="submit" name="logout" id="logout" value="Log Out"/></th>
							<?php
							}
							?>
						</tr>
						<tr>
							
							<th><?php echo "Customer List and Delete " ?> </th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
							
						</tr>
						<tr>
							
							<th>Account Number</th>
							<th>Balance</th>
							<th>Branch</th>
							
						</tr>
							
							<?php 
							$AccountList = AccountManager::getAllAccount();
							
							for($i = 0; $i< count($AccountList ); $i++) {
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
								<a>Enter Account Number:</a>
							</td>
							<td>
								<input type="text" name="account_no"/>
							</td>
								
							<td>
							<form id="form1" name="form1" method="post" action="">
								<input type="submit" name="del" value="Delete" />
							</form>
							<?php
							$check=0;
								if(isset($_POST["del"])) {
									$account_number = trim($_POST["account_no"]);
									if($account_number != '' && strlen($account_number) ==16){
										$result = AccountManager::DeleteAccount($account_number);
										
										if(!$result){
											echo '<script language="javascript">';
											echo 'alert("Account is not deleted please check boxes!")';
											echo '</script>';
											
										}
										else{
											echo '<script language="javascript">';
											echo 'alert("Account is deleted Successfully!")';
											echo '</script>';
											
										}
										
									}
									
									else{
										echo '<script language="javascript">';
										echo 'alert("Account is not deleted please check boxes!")';
										echo '</script>';
									}
									
								}
							?>
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
						
							<tr>
							
							<td>
							<form id="form1" name="form1" method="post" action="">
								<input type="submit" name="back" value="Back Admin Panel" />
								</form>
								<?php 
									if(isset($_POST["back"])) {
										header("location: AdminUI.php");
									}
									if(isset($_POST["logout"])) {
										header("location: AdminLoginPanel.php");
									}
								?>
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<?php
			}
			else {
					echo "<a href='AdminLoginPanel.php'>Giriþ yapýnýz!</a>";
				}
		?>
	</body> 
</html>