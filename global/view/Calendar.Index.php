<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?php echo $this->title;?></title>
		<script src="global/ext-3.2.1/adapter/ext/ext-base.js"></script>
		<script src="global/ext-3.2.1/ext-all.js"></script>
		<script src="global/view/Calendar.js"></script>
		<style>
			@import url("global/ext-3.2.1/resources/css/ext-all.css");
			body {
				margin:0px auto;
				background:url(/images/bg.gif);
				font-family:Arial,simsun;
				font-size:12px;
				text-align:center;
			}
			#body{
				margin: 0px auto;
				width: 994px;
				font-size: 14px;
			}
			#main{
				float: left;
				padding: 5px;
				width: 99%;
				background: white;
			}
			p{
				padding:5px 20px;
				line-height:20px;
				text-align:left;
			}
			#topheader{
				background-color: #990000;
				height: 70px;
				padding-top: 23px;
			}
			.navitem
			{
				background-color: #003300;
				padding: 5px;
				text-decoration:none;
				font-weight:bold;
				text-align:center;
				color: #fff;
				width: 169px;
				margin-top:1px;
				margin-right:1px;
				float:left;
			}
			.navitem a {text-decoration: none; color: #fff;}
			.navitem a:hover {text-decoration: underline; color: #fff;}
			.picture {
				float:left;
				width:100px;
			}
		</style>
	</head>
	<body>
		<div id="body">
			<div id="header"><?php require("Header.php") ?></div>
			<div id="main">
				<div id="Calendar"></div>
				<div id="test"></div>
			</div>
		<div id="Footer"><img src="images/Footer.jpg" /></div>
		</div>
	</body>
</html>
