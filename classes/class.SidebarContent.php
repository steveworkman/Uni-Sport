<?php
// This class generates an object for displaying in either sidebar. It creates a header and a list of links
class SidebarContent {
	public $title, $hidden, $data;
	public $error, $nohide, $id;
	
	function __construct($t)
	{
		$this->title = $t;
		$this->hidden = 0;
		$this->data = '';
		$this->error = '';
		$this->nohide = 0;
		$this->id = '';
	}
	
	function toString()
	{
		return 'title: '.$this->title.' hidden: '.$this->hidden.' data: '.print_r($this->data).' error: '.$this->error;
	}
}
?>