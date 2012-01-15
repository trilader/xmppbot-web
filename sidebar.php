<?php
class Sidebar {

	private $options_name = 'Bot Configuration:';
	private $options = array (
		"General" => "index.php?action=show&value=config&detail=bot",
		"Commands" => "index.php?action=show&value=config&detail=command",
		"Filters" => "index.php?action=show&value=config&detail=filter",
		"Logging" => "index.php?action=show&value=config&detail=logs",
		"MUC" => "index.php?action=show&value=config&detail=muc",
		"Server" => "index.php?action=show&value=config&detail=server"
	);
	
	private $actions = array (
		"Status" => "index.php?action=show&value=status"
	);
	
	public function __construct()
	{
	}
	
	private function render_user($logged_in,$username)
	{
		echo '<div class="sidebar-section">';
				echo '<div class="sidebar-section-header">Welcome '.$username.'</div>';
			echo '<ul id="user-info-sidebar">';
				if($logged_in)
				{
					echo '<li><a href="index.php?action=logout" class="link-style-default">Logout</a></li>';
					foreach ($this->actions as $item => $link)
						echo '<li><a href="'.$link.'" class="link-style-default">'.$item.'</a></li>';
				}
				else
				{
					echo '<li><a href="index.php?action=login" class="link-style-default">Login</a></li>';
				}				
			echo '</ul>';
		echo '</div>';
	}
	
	private function render_options()
	{
		echo '<div class="sidebar-section">';
			echo '<div class="sidebar-section-header">'.$this->options_name.'</div>';
				echo '<ul>';
					foreach ($this->options as $item => $link)
						echo '<li><a href="'.$link.'" class="link-style-default">'.$item.'</a></li>';
				echo '</ul>';
		echo '</div>';
	}
	
	public function Render()
	{
		$logged_in = $_SESSION['logged_in'];
		$username = '';
		
		if($logged_in && isset($_SESSION['username']))
			$username = $_SESSION['username'];
	
		echo '<div id="site-sidebar">';
			$this->render_user($logged_in, $username);
			if($_SESSION['logged_in']==true) {
				$this->render_options();
			}
		echo '</div>';
	}
}
?>