<?php
class Tools{
	public function PaginationSetpage($perpage,$current_page){
		if (isset($current_page)) {
			$page = $current_page;
		} else {
			$page = 1;
		}
		$start = ($page - 1) * $perpage;
		return $start;
	}
}
?>