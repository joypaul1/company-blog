<?php
/**
 * format class
 */
class format{
	public function formatDate($dite){
		return date ('F j, Y, g:i  a',strtotime($dite));
	}

	public function textShorten ($text, $limit=300){
		$text = substr($text,0,$limit);  //start letter counting from 0 to 300//
		$text = substr($text,0,strrpos($text, ' ')); //full word have to complet;
		$text = $text."...";
		return $text;
	}
	public function validation ($data){
		$data = trim ($data);
		$data = stripcslashes($data);   //for this blackslshes(//)
		$data = htmlspecialchars($data);   //for this blackslshes(//)
		return $data;
	}

	public function title(){
		$path = $_SERVER['SCRIPT_FILENAME'];
		$title = basename($path,'.php');
			if ($title == 'index') {
				$title = "home";
			}elseif ($title == 'contact') {
				$title = "contact";
			}
		return $title =ucwords($title);
	}

}


?>