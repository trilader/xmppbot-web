<?php
class Footer{

	private $urls = array("XmppBot"=>"http://projectna.me/xmppbot",
						 "XmppBot at GitHub"=>"http://github.com/trilader/xmppbot",
						 "XmppBot-Web"=>"http://github.com/trilader/xmppbot-web"
    );

	public function __construct()
	{
	}
	
	public function Render()
	{
		echo '<ul>';
		foreach($this->urls as $name => $url)
		{
			echo '<li class="spacing-medium"><a href="'.$url.'">'.$name.'</a></li>';
		}
		echo '</ul>';
		echo '<div id="footer-text">XmppBot-Web is &copy;2012 Daniel Schulte</div>';
	}
}
?>