<!DOCTYPE html>
<html> 
	<head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <title>Web Services</title>
		<style type="text/css">
			#dvMain {
			width: 500px;
			margin-left: auto;
			margin-right: auto;
			padding: 15px;
			background-color: #FAFAFA;
			}
			.dvInner {
			border: 1px solid #ddd;
			padding: 10px;
			margin-bottom: 10px;
			}
			td {
			padding: 4px;
			}
			#divCallResult {
			border: 1px solid #ddd;
			padding: 10px;
			}
		</style>
	</head>
	<body> 
		<div id="dvMain">
			<div class="dvInner">
				<h2>Synchronous POST</h2>
				<form action="countries.php" method="POST"> 
					<table>
						<tr>
							<td>
								Customer Name : 
							</td>
							<td>
								<input type="text" name="code" id="txtCode" title="Örn: TU" required />
							</td>
						</tr>
						<tr>
							<td>
								Format : 
							</td>
							<td>
								<input type="radio" name="format" value="json" id="radioJson" checked>
								<label for="radioJson">JSON</label>
								<br>
								<input type="radio" name="format" value="xml" id="radioXml">
								<label for="radioXml">XML</label>
							</td>
						</tr>
						
						<tr>
							<td>
								<input type="submit" value="Submit Form!" />
							</td>
							<td>
								<input type="button" id="btnCallSrvc" value="Call Service Asynchronously" />
							</td>
						</tr>
					</table>
				</form> 
			</div>
			
			<div class="dvInner">
				
				<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
				
				<h2>Async POST</h2>
				<h3>Result:</h3>
				<div id="divCallResult">
					Please call the service
				</div>
			</div>
			
		</div>
		<script>
			// JQuery 
			$(document).ready(function() { // when DOM is ready, this will be executed
			
			$("#btnCallSrvc").click(function(e) { // click event for "btnCallSrvc"
				
				var cntrCode = $("#txtCode").val(); // get country code
				if(cntrCode == "") {
					alert("Enter country code!");
					$("#txtCode").focus();
					return;
				}
				
				var retType = $("#radioJson").is(":checked") ? "json" : "xml"; // get reply format
				var count = $("#txtNum").val(); // get desired country count
				
				$.ajax({ // start an ajax POST 
					type	: "post",
					url		: "countries.php",
					data	:  { 
						"code"	: cntrCode, 
						"format": retType, 
						"num"	: count 
					},
					success : function(reply) { // when ajax executed successfully
						console.log(reply);
						if(retType == "json") {
							$("#divCallResult").html( JSON.stringify(reply) );
						}
						else {
							$("#divCallResult").html( new XMLSerializer().serializeToString(reply) );
						}
						
					},
					error   : function(err) { // some unknown error happened
						console.log(err);
						alert(" There is an error! Please try again. " + err); 
					}
				});
				
			});
			
		});
		</script>
	</body> 
</html>
