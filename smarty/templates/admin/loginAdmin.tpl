<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Administrator Log</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet"
	href="/deepmusic/resources/css/style.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

	{user->getNickName assign='uName'}

	{include file="navbar.tpl"}
	
	<div class="container text-center">
		<div class="col-sm-3">
		
        </div>
		<div class="col-sm-7 well">
			<h2>Administrator Login</h2>
			<hr>
			{if $error}
			<div class="alert alert-warning">
				<strong>Warning!</strong><br>Wrong combination of user and password. <br>Please retry.
			</div>
			{/if}
			<br>
					<form class="form-horizontal" method="post" action="login">
						
						<div class="form-group row">
      						<label for="user" class="col-sm-2 col-form-label {if !$check.name} text-danger{/if}">User:</label>
      						<div class="col-sm-7">
        						<input type="text" class="form-control is-invalid" id="user" name="name" placeholder="Insert username...">
      						</div>
      						{if ! $check.name}
      						<div class="col-sm-3">
        						<small id="passwordHelp" class="text-danger">
          							Must be 3-20 characters long.
        						</small>      
     						</div>
     						{/if}
    					</div>
    					
    					<div class="form-group row">
      						<label for="inputPassword" class="col-sm-2 col-form-label {if !$check.pwd} text-danger{/if}">Password:</label>
      						<div class="col-sm-7">
        						<input type="password" class="form-control is-invalid" id="inputPassword" name="pwd" placeholder="Password">
      						</div>
      						{if ! $check.pwd}
      						<div class="col-sm-3">
        						<small id="passwordHelp" class="text-danger">
          							Must be 8-20 characters long.
        						</small>      
     						</div>
     						{/if}
    					</div>
    					
						<div class="form-group">

							<button type="submit" class="btn btn-default">Submit</button>
						</div>
					</form>

		</div>
	<div class="col-sm-3">
		
	</div>
	
</body>
</html>

