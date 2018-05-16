<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Deep Music (Worst name ever)</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
/* Set black background image, to be moved in .css file */
body {
	background-color: black;
	background:
		url(http://s1.bwallpapers.com/wallpapers/2014/02/11/white-full-hd-desktop-wallpaper_0924518.jpg)
		no-repeat center center fixed;
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
}

container {
	background-color: #f0f0f0;
}
</style>
</head>
<body>
	{user->getType assign='output'}
	<nav class="navbar navbar-inverse-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#myNavbar">
					<span class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.html">Deep Music</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					{if $output == "guest"}
					<li><a href="login.html"><span
							class="glyphicon glyphicon-log-in"></span> Log In</a></li> 
					{else}
					<li><a href="profile.html"><span
							class="glyphicon glyphicon-user"></span> My Account </a></li> 
				    {/if} 
				    {if $output == "musician"}
					<li><a href="load.html"><span
							class="glyphicon glyphicon-cd"></span> Add Song </a></li> 
					{/if}
				</ul>
				<form class="navbar-form navbar-right" method="post"
					action="search.php" role="search">
					<div class="form-group input-group">

						<input type="text" class="form-control" placeholder="Search..">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</span>
					</div>
				</form>

			</div>
		</div>
	</nav>

	<div class="container text-center well">
		<h3>The next generation of musicians!</h3>
		<p>Are you tired of the same old songs? Do you want something new?
		</p>
		<h3>This is the place where music lives again.</h3>
		<br>
		<div class="row">
			<div class="col-sm-4">
				<p class="text-center">
					<strong>Create your Music!</strong>
				</p>
				<br> <img
					src="http://www.chrismcintyre.ca/wp-content/uploads/2015/06/Chris-McIntyre-5930.jpg"
					class="img-circle person" alt="Random Name" width="255"
					height="255">

			</div>
			<div class="col-sm-4">
				<p class="text-center">
					<strong>Share it!</strong>
				</p>
				<br> <img
					src="https://s3.amazonaws.com/musicindustryhowtoimages/wp-content/uploads/2014/04/12072723/How-To-Get-People-To-Listen-To-Your-Music.jpg"
					class="img-circle person" alt="Random Name" width="255"
					height="255">


			</div>
			<div class="col-sm-4">
				<p class="text-center">
					<strong>Be a Star!</strong>
				</p>
				<br> <img
					src="https://thumbs.dreamstime.com/t/silhouettes-people-music-festival-beach-41699585.jpg"
					class="img-circle person" alt="Random Name" width="255"
					height="255">


			</div>
		</div>
	</div>

</body>
</html>
