<!doctype html>

<?php
	session_start();
	if(!isset($_SESSION['logged_in'])) $_SESSION['logged_in']=false;	
	if(!isset($_SESSION['current_action'])) $_SESSION['current_action']='login';
	
	include 'config.inc.php';
	
	include 'header.php';
	include 'sidebar.php';
	include 'login.php';
	include 'status.php';
	include 'config.php';
	include 'footer.php';
	$header = new Header();
	$sidebar = new Sidebar();
	$login = new LoginScreen();
	$status = new StatusScreen();
	$footer = new Footer();
	
	ConfigurationScreen::$db = $db;
	new ConfigurationScreen('command');
	new ConfigurationScreen('bot');
	new ConfigurationScreen('filter');
	new ConfigurationScreen('muc');
	new ConfigurationScreen('server');
	new ConfigurationScreen('logs');
	
	if(isset($_POST['action']))
	{
		switch ($_POST['action'])
		{
			case 'login':
				if($_POST['username']===$C_ADMIN_USER)
					if(md5($_POST['password'])===md5($C_ADMIN_PASS))
					{
						$_SESSION['logged_in']=true;
						$_SESSION['username']=$_POST['username'];
						$_SESSION['current_action']='status';
					}
			break;
			default:
			break;
		}
	}
	
	if(isset($_GET['action']))
	{
		switch ($_GET['action'])
		{
			case 'logout':
				$_SESSION['logged_in']=false;
				$_SESSION['username']='';
				$_SESSION['current_action']='login';
				session_destroy();
				break;
			case 'login':
				$_SESSION['current_action']='login';
				break;
			case 'show':
				if(isset($_GET['value']))
				{
					$val = $_GET['value'];
					switch ($val)
					{
						case 'status':
							$_SESSION['current_action']='status';
							break;
						case 'config':
							$_SESSION['current_action']='config';
							break;
						default:
							die ('Error: This should not happen. (Unknown "value"="'.$val.'")');
							break;
					}
				}
				else
					die ('Error: This should not happen. (action="show" but "value" not set)...');
				break;
			default:
			break;
		}
	}
	
?>

<html>
	<head>
		<title>XMPPBot-Web</title>
		<link rel="stylesheet" type="text/css" href="style/style.css" />
	</head>
	<body>
		<div id="site-container">
			<div id="site-header">
				<?php $header->Render(); ?>
			</div>
			<div id="site-center-wrap">
				<table>
				<tr><td>
					<?php //Sidebar Area
						$sidebar->Render();
					?>
				</td><td>
					<div id="site-content">
					<?php //Content Area
					switch ($_SESSION['current_action'])
					{
						case 'login':
							$login->Render();
							break;
						case 'status':
							$status->Render();
							break;
						case 'config':
							ConfigurationScreen::Get($_GET['detail'])->Render();
						default:
							break;
					}
					?>
					</div>
				</td></tr>
				</table>
			</div>
			<div id="site-footer">
				<?php $footer->Render(); ?>
			</div>
		</div>
	</body>
</html>