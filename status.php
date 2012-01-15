<?php
class StatusScreen
{
	public function __construct()
	{
	}
	
	public function Render()
	{
		if(!$_SESSION['logged_in'])
		{
			echo '<p>You are not logged in.</p>';
			return;
		}
		
		echo '<p>TODO: Display status information here!</p>';
	}
}
?>