<?php 
	require_once("LogicLayer/CustomerManager.php");
	require_once("LogicLayer/AccountManager.php");
	session_start();
	$activeUser = null;
	
	if(isset($_SESSION['activeUser'])) {
		$activeUser =  $_SESSION['activeUser'];
	}
	$msg ="";
?>
<!DOCTYPE html>
<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>Money Transfer</title>
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
						
							<td>
								<select name = "Account">
								<option>Select Your Account</option>
								<?php 
									$AccountList = AccountManager::getAllAccountbyCustomer($activeUser->getCustomer_ID());
							
									for($i = 0; $i < count($AccountList); $i++) {
									?>
										<option value="<?php echo $AccountList[$i]->getAccount_ID(); ?>"><?php echo $AccountList[$i]->getAccount_Number(); ?></option>
									
									<?php
									}
								?>
								</select>
							</td>								
							<td>  
								<a>Enter Amount :</a>							
							</td>	
							<td>  
								<input type="text" name="amount" />							
							</td>
							
							
						</tr>
						<tr>
							<td>
								
							</td>
							<td>
								<a>Enter Receiver Account Number :</a>
							</td>
							<td>
								<input type="text" name="receiveraccount" />
							</td>
								
						</tr>
						<tr>
							<td>
								
							</td>
							<td>
								
							</td>
							<td>
								<input type="submit" name="transfer" value="Make Transfer" />
							</td>
								
						</tr>
						<?php 
									if(isset($_POST["transfer"])) {
										if(isset($_POST["amount"]) && isset($_POST["receiveraccount"])) {
		
											$transferamount = trim($_POST["amount"]);
											$account = trim($_POST["receiveraccount"]);
											
											
											if($transferamount != '' && $account!= '' && strlen($account) == 16){
												$selectedaccount = $_POST['Account'];
												$controlbalance = AccountManager::getAccountbyID($selectedaccount);
												
												if($controlbalance[0]->getBalance() >= $transferamount){
													$controlaccount = AccountManager::getAccountbyNumber($account);
													
													
													if($controlaccount[0]->getAccount_Number() !=null){
														
														$decreasebalance = $controlbalance[0]->getBalance()-$transferamount;
														
														$decreaseaccount = AccountManager::UpdateBalance($decreasebalance,$controlbalance[0]->getAccount_ID());
														$increasebalance = $controlaccount[0]->getBalance()+$transferamount;
														
														$increaseaccount = AccountManager::UpdateBalance($increasebalance,$controlaccount[0]->getAccount_ID());
														$msg="Money Transfer is Succesfull!!";
													}
													
												
												
												}
											}
											
				
	}
									}
								?>
						<tr>
							<td>
								<input type="submit" name="back" value="Back Main Panel" />
							</td>
							<td><?php echo $msg ?></td>
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
					echo "<a href='PersonaLoginPanel.php'>Giriþ yapýnýz!</a>";
				}
		?>
	</body> 
</html>