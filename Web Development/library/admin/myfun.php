<?
include "common_db.inc";
error_reporting(0);
$link_id = db_connect();
if(!$link_id) die(sql_error());

function randomkeys($length)
{
	$pattern = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	for($i=0;$i<$length;$i++) {
		$key .= $pattern{rand(0,35)};
	}
	return $key;
}


function getFileExt($file)
{
    $ext;
    $baseName = basename( $file );
    $dot = strrpos($baseName, '.');
    
    if($dot===false)
    {
       echo "no extension found. ";
       $dot = NULL;
    }
    else
    {
        if(strlen($file)>3)
        {
            $ext = substr($baseName,$dot+1);
        }
    }
    return $ext;
}


function upload_file($dir,$file_att)
{


$types = array("image/png","image/x-png","image/gif","image/jpeg","image/pjpeg","audio/rm","audio/ram","audio/mp3","application/swf");
$fullpath = "$dir/";

//echo "fullpath : ".$fullpath."<br>" ; 

if (!empty($_FILES['file_att']['name'])) {
//echo "file_ext :  ". getFileExt($_FILES["file_att"]["name"]);

$file_type = getFileExt($_FILES["file_att"]["name"]);  

	/*if ($_FILES['file_att']['size'] == 0) {
		$message  = '<b>Error:</b> File (0 byte) <p>&laquo; <a href="javascript:history.go(-1)">Go back!</a></p>';
		die($message);
	} */
	$file_att_tmp_name = $_FILES['file_att']['tmp_name']; 
	$file_att_new_name = $_FILES['file_att']['name']; 
	$file_att_clean_name = substr($file_att_new_name, -4);
	$file_att_date = randomkeys(10);
	$file_att = $file_att_date . $file_att_clean_name;
	
		if(move_uploaded_file($file_att_tmp_name, $fullpath . $file_att))
		{
		
		$file_type = $file_type ; 
		return $file_att ; 
		}
	 else {
		$message  = '<b>Error:</b> ';
		die($message);
		return null ; 
	}
}

}







function upload_img($dir,$pic)
{



$types = array("image/png","image/x-png","image/gif","image/jpeg","image/pjpeg","audio/rm","audio/ram","audio/mp3","application/swf","swf","SWF");
$fullpath = "$dir/";

//echo "fullpath : ".$fullpath."<br>" ; 

if (!empty($_FILES['pic']['name'])) {
//echo "pic : ok  " ; 

	if ($_FILES['pic']['size'] == 0) {
		$message  = '<b>Error:</b> Image (0 byte) <p>&laquo; <a href="javascript:history.go(-1)">Go back!</a></p>';
		die($message);
	} elseif ($_FILES['pic']['size'] > 524288) {
		$message  = '<b>Error:</b> Image (Max.: 512 k.byte)<p>&laquo; <a href="javascript:history.go(-1)">Go back!</a></p>';
		die($message);
	}
	$pic_tmp_name = $_FILES['pic']['tmp_name']; 
	$pic_new_name = $_FILES['pic']['name']; 
	$pic_clean_name = substr($pic_new_name, -4);
	$pic_date = randomkeys(10);
	$pic = $pic_date . $pic_clean_name;
	/*if (in_array($_FILES['pic']['type'], $types)) 
	{*/
		move_uploaded_file($pic_tmp_name, $fullpath . $pic);
		return $pic ; 
		
	/*} else {
		$message  = '<b>Error:</b> Extension fail for Image!';
		die($message);
		return null ; 
	}*/
}

}

function upload_img1($dir,$pic1)
{



$types = array("image/png","image/x-png","image/gif","image/jpeg","image/pjpeg");
$fullpath = "$dir/";

//echo "fullpath : ".$fullpath."<br>" ; 

if (!empty($_FILES['pic1']['name'])) {
//echo "pic1 : ok  " ; 

	if ($_FILES['pic1']['size'] == 0) {
		$message  = '<b>Error:</b> Image (0 byte) <p>&laquo; <a href="javascript:history.go(-1)">Go back!</a></p>';
		die($message);
	} elseif ($_FILES['pic1']['size'] > 524288) {
		$message  = '<b>Error:</b> Image (Max.: 512 k.byte)<p>&laquo; <a href="javascript:history.go(-1)">Go back!</a></p>';
		die($message);
	}
	$pic1_tmp_name = $_FILES['pic1']['tmp_name']; 
	$pic1_new_name = $_FILES['pic1']['name']; 
	$pic1_clean_name = substr($pic1_new_name, -4);
	$pic1_date = randomkeys(10);
	$pic1 = $pic1_date . $pic1_clean_name;
	if (in_array($_FILES['pic1']['type'], $types)) 
	{
		move_uploaded_file($pic1_tmp_name, $fullpath . $pic1);
		return $pic1 ; 
		
	} else {
		$message  = '<b>Error:</b> Extension fail for Image!';
		die($message);
		return null ; 
	}
}

}



function get_by_id($id,$f,$val , $t)
{
	
	$sql = "SELECT `$f` 
FROM `$t` 
WHERE 1 AND $id = $val " ; 
	$result = mysql_query("$sql");
   	$q = mysql_fetch_array($result) ;
	
	return $q[$f] ;
	

}




//**********************************************************

function myselect ($selectname,$myfiled,$mytable,$fid , $val)
{

echo "<select name='$selectname' class='form-control'> " ; 
         ?> <option>--Select--</option>
          <?
			 $sql = " SELECT $fid , $myfiled  from $mytable"  ;
    			
			 $result = mysql_query("$sql");
   			
			 $num_of_rows= mysql_num_rows($result);
			$a = 0 ;


	while ($a<$num_of_rows){
	$query_data = mysql_fetch_row($result);
   	
	 ?> <option value = "<?=$query_data[0]?>" <? if($val== $query_data[0]) echo "selected" ; ?>>
	 <?
	 		echo  $query_data[1]; 
	 echo" </option>";
	 $a++ ;
	 }
	 ?>
        </select>
<?
}

//*********************************
function myselect_cond ($selectname,$myfiled,$cond,$mytable)
{

echo "<select name='$selectname'> " ; 
         ?> <option></option>
          <?
			 $sql = " SELECT id , $myfiled  from $mytable where $cond "  ;
    			
			 $result = mysql_query("$sql");
   			
			 $num_of_rows= mysql_num_rows($result);
			$a = 0 ;


	while ($a<$num_of_rows){
	$query_data = mysql_fetch_row($result);
   	
	 echo" <option value = '$query_data[0]'>" ;
	 		echo  $query_data[1]; 
	 echo" </option>";
	 $a++ ;
	 }
	 ?>
        </select>
<?
}


	
?>