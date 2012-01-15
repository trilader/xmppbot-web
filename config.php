<?php
class ConfigurationScreen {

	public static $db;

	private static $screens = array();
	private static $prefix = 'xmppbot__';
	private static $postfix ='_config';	
	private static $db_fields = array (
		'command' => array('config_id','name','option','value'),
		'bot' => array('config_id','name','value'),
		'filter' => array('config_id','name','option','value'),
		'muc' => array('config_id','name','room','server'),
		'server' => array('config_id','user','password','address','resource'),
		'logs' => array('config_id','name','type','fileformat','entryformat','enabled','keepopen')
	);	
	
	private $section ='';

	public function __construct($section)
	{
		$this->section=$section;
		self::$screens[$section]=$this;
	}
	
	public static function Get($name)
	{
		if(isset(self::$screens[$name]))
			return self::$screens[$name];
		else
			die ('Invalid Screen: "'.$name.'"');
	}
	
	public function Render()
	{
		if(!$_SESSION['logged_in'])
		{
			echo '<p>You are not logged in.</p>';
			return;
		}	
	
		$fields = self::$db_fields[$this->section];
		$table = self::$prefix.$this->section.self::$postfix;
		$query = 'SELECT * from '.$table;
		$result = self::$db->query($query);
		
		echo '<div id="display-container"/>';
		echo '<table>';
		
		echo '<tr>';		
		for($c=0; $c<$result->numColumns(); $c++)
			echo '<th>'.$result->columnName($c).'</th>';
		echo '</tr>';
		
		while ($row = $result->fetchArray())
		{
			$i=0;
			if($i%2==0)
				echo '<tr class="alt-row">';
			else
				echo '<tr>';
			foreach ($fields as $field)
			{
				echo '<td>'.$row[$this->section.'_'.$field].'</td>';
				$i++;
			}		
			echo '</tr>';
		}
			
		echo '</table>';
		echo '</div>';
	}
}