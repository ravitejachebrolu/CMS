<?php 
function confirm_query($result_set)
{
	if(!$result_set){
		die("database query failed");
	}
}
function find_all_subjects(){
	global $connection;
	$query = "select * from subjects where visible = 1
	 order by position ASC";

     $subject_set = mysqli_query($connection,$query);
     confirm_query($subject_set);
     return $subject_set;
}
function find_pages_for_subject($subject_id){
	 global $connection;
	 $query = "select * from pages where subject_id = {$subject_id}";
		   $page_set = mysqli_query($connection, $query);
		   confirm_query($page_set);
		   return $page_set;
}

function navigation($subject_id , $page_id){
	$output = "<ul class = \"subjects\">";
	$subject_set = find_all_subjects();
	while($subjects = mysqli_fetch_assoc($subject_set))
      {
      $output .= "<li";
      if($subjects["id"] == $subject_id){
        $output .= " class=\"selected\"";
      }
      $output .= ">";     
      $output .="<a href=\"manage_content.php?subject=";
	  $output .= urlencode($subjects["id"]);
	  $output .="\">";
	  $output .= $subjects['menu_name'];
	  $output .= "</a>"; 

	  $page_set = find_pages_for_subject($subjects["id"]); 
      $output .="<ul class = \"pages\">";
      while($pages = mysqli_fetch_assoc($page_set)){ 
       $output .= "<li";
       if($pages["id"] == $page_id){
       $output .= " class=\"selected\"";
      }
  		$output .= ">";
     $output .="<a href = \"manage_content.php?page=";
      $output .= urlencode($pages["id"]);
      $output .="\">";
      $output .= $pages['menu_name'];
      $output .="</a> </li>"; 
      }  	
      mysqli_free_result($page_set);

    $output .= "</ul></li>";
}
    mysqli_free_result($subject_set); 
    $output .= "</ul>"; 
    return $output;
}

?>
