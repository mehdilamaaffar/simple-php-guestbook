<?php

require_once './autoloader.php';

class pagination {

	private $_DB;

	public $page;
	public $records_per_page = 4;
	public $filename;

	public function __construct()
	{
		$this->_DB = DB::getInstance();
	}

	public function init()
	{
		$this->page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$this->start = ($this->page - 1) * $this->records_per_page;
	}

	public function createLinks()
	{
		$results = $this->_DB->handler()->query("SELECT * FROM guestbook");
		$total_records  = $results->rowCount();

		$pages = ceil($total_records/$this->records_per_page);

		for ($i=1; $i < $pages; $i++) {
			if ($this->page == $i)
			 	echo $this->page;
			else
				echo "<a href='$this->filename?page=$i'>$i</a>";
		}
	}
}

?>