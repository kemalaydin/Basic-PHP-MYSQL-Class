<?php
error_reporting(0);

class dbClass{


	function dbConnect($dbHost,$dbUser,$dbPass,$dbSelect,$errorMsg)
	{
		if(empty($errorMsg)){
			$errorMsg = "MySQL Connect Error !";
		}
		$Connect = @mysql_connect($dbHost,$dbUser,$dbPass) or die ($errorMsg);
		$selects = @mysql_select_db($dbSelect,$Connect) or die ($errorMsg);
		return $selects;

	}


	function query($com,$req)
	{
		 $tableT = false;
		 $columnT = false;
		 $whereT = false;
		 $ordByT = false;
		 $ordByPT = false;

		foreach($commit as $keys => $value){
			if($keys == "table"){
				$table = $value;
				$tableT = true;
			}else if($keys == "columns"){
				$column = $value;
				$columnT = true;
			}else if($keys == "where"){
				$where = $value;
				$whereT = true;
			}else if($keys == "orderBy"){
				$ordBy = $value;
				$ordByT = true;
			}else if($keys == "orderByP"){
				$ordByP = $value;
				if($value == "-"){
					$ordByP = "ASC";
					$ordByPT = true;
				}else if($value == "+"){
					$ordByP = "DESC";
					$ordByPT = true;
				}else{
					echo "!! Order By komutunda sıralama şeklini yanlış bir karakterle ifade ettiniz !! ";
					break;
				}
			}else{
				echo "!! query Metodunda Geçersiz Değer Ataması Yaptınız !!";
				break;
			}	
		}
		if($tableT != 0 && $columnT != 0){
				if($whereT != 0 && $ordByT != 0){
					$qu = mysql_query('select '.$column.' from '.$table.' where '.$where.' order by '.$ordBy.' '.$ordByP);
				}else if($whereT != 0){
					$qu = mysql_query('select '.$column.' from '.$table.' where '.$where);
				}else if($ordByT != 0){
					$qu = mysql_query('select '.$column.' from '.$table.' order by '.$ordBy.' '.$ordByP);
				}else if($whereT == 0 && $ordByT == 0){
					$qu = mysql_query('select '.$column.' from '.$table);
				}
			}else{
				echo "Zorunlu Parametrelerden En az 1 tanesi boş geçildi ! ( Tablo Adı ( table ), Seçilecek Kolonlar ( columns ) )";
				break;
			}
		$co = 1;
		while($cikar = mysql_fetch_array($qu)){
			$Cikti[$co] = $cikar[$req];
			$co++;
		} 
		return $Cikti;
	}

	function rows($commit){
		 $tableT = false;
		 $columnT = false;
		 $whereT = false;

		foreach($commit as $keys => $value){
			if($keys == "table"){
				$table = $value;
				$tableT = true;
			}else if($keys == "columns"){
				$column = $value;
				$columnT = true;
			}else if($keys == "where"){
				$where = $value;
				$whereT = true;
			}else{
				echo "!! rows Metodunda Geçersiz Değer Ataması Yaptınız !!";
				break;
			}	
		}
		if($tableT != 0 && $columnT != 0){
				if($whereT != 0){
					$qu = mysql_query('select '.$column.' from '.$table.' where '.$where) or die (mysql_error());
				}else if($whereT == 0){
					$qu = mysql_query('select '.$column.' from '.$table) or die (mysql_error());
				}
			}else{
				echo "Zorunlu Parametrelerden En az 1 tanesi boş geçildi ! ( Tablo Adı ( table ), Seçilecek Kolonlar ( columns ) )";
				break;
			}
		$Cikti = mysql_num_rows($qu) or die (mysql_error());
		return $Cikti;
	}

}

?>
