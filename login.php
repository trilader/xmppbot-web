<?php
class LoginScreen
{
	public function __construct()
	{
	}
	
	public function Render()
	{
		echo '<div id="login-container"/>';
		echo '<form action="index.php" method="post">
				<br />
				<input type="hidden" name="action" value="login" />
				<label for="">Username:</label><br />
				<input type="text" name="username" id="input-username" /><br />
				<label for="">Password:</label><br />
				<input type="password" name="password" id="input-password" /><br />
				<input type="submit" value="Login"/>				
			</form><br />';
		echo '</div>';
	}
}
?>