<?php
  class Message
  {
    private $_red;
	private $_green;
	
	public function setRed($red)
	{
		$this->_red = "<div class = \"messageRed\"><p class = \"red center px15\">$red</p></div>" ;
	}
	public function setGreen($green)
	{
		$this->_green = "<div class = \"messageGreen\">
		  <p class = \"px20 center green bold\">$green</p></div>";
	}
	public function red()
	{
		return $this->_red;
	}
	public function green()
	{
		return $this->_green;
	}
  }