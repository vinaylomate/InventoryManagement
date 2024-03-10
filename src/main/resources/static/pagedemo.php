<?php

 // enter your connection variable
// current page number
function current_page(){
  if (isset($_GET['page']) && $_GET['page']!="") {
      $currentPage = validate($_GET['page']);
  } else {
      $currentPage = 1;
  }
 return $currentPage;
}
// validate current page number
function validate($value) {
  $value = trim($value);
  $value = stripslashes($value);
  $value = htmlspecialchars($value);
  return $value;
}
// fetching padination data
function pagination_records($totalRecordsPerPage,$qry){   
   //echo $qry."<Br>";
   include('mysql.connect.php');	
   $currentPage=current_page();
   $totalPreviousRecords = ($currentPage-1) * $totalRecordsPerPage;
   $qq=$qry." LIMIT ".$totalPreviousRecords.",".$totalRecordsPerPage."";
   //echo $qq."<Br>";
   $query = $mysql->prepare($qq);   
   $query->execute();
   //echo $query->rowCount()."<Br>";
   //$result=$query->get_result();
   if($query->rowCount()>0){
    $row= $query->fetchAll();
	$mysql=null;
	//print_r($row);
    return $row;  
        
    }else{
	$mysql=null;
    return $row=[];
   }
}
// serial number of pagination content
function pagination_records_counter($totalRecordsPerPage){
 
    $currentPage=current_page();
    $totalPreviousRecords=($currentPage-1)*$totalRecordsPerPage;
    $dataCounter=$totalPreviousRecords + 1;
    return $dataCounter;
}
// back to previous page
function previous_page(){
 $currentPage=current_page();
 $previousPage = $currentPage - 1;
 if($currentPage > 1){
   $previous="<a href='?page=".$previousPage."'>Previous</a>";
   return $previous;
 }  
}
// go to next page
function next_page($totalPages){
 $currentPage=current_page();
 $nextPage = $currentPage + 1;
 if($currentPage < $totalPages) {
  $next="<a href='?page=".$nextPage."'
>Next</a>";
  return $next;
}}
// diplaying total pagination numbers
function pagination_numbers($totalPages){
    
$currentPage=current_page();
    $adjacents = "2";
$second_last = $totalPages - 1; // total pages minus 1
 $pagelink='';
 if ($totalPages <= 5){   
 for ($counter = 1; $counter <= $totalPages; $counter++){
 if ($counter == $currentPage) {
  $pagelink.= "<a class='active'>".$counter."</a>"; 
 }else{
  $pagelink.= "<a href='?page=".$counter."'>".$counter."</a>";
  }
 }
}elseif ($totalPages > 5){
   if($currentPage <= 4) { 
    for ($counter = 1; $counter < 8; $counter++){ 
     if ($counter == $currentPage) {
        $pagelink.= "<a class='active' href='?page=".$counter."'>".$counter."</a>";
      }else{
           $pagelink.= "<a href='?page=".$counter."'>".$counter."</a>";
      }
    }
 $pagelink.= "<a>...</a>";
 $pagelink.= "<a href='?page=".$second_last."'>".$second_last."</a>";
 $pagelink.= "<a href='?page=".$totalPages."'>".$totalPages."</a>";
}elseif($currentPage > 4 && $currentPage < $totalPages - 4) { 
 $pagelink.= "<a href='?=1'>1</a>";
 $pagelink.= "<a href='?page=2'>2</a>";
 $pagelink.= "<a>...</a>";
for (
     $counter = $currentPage - $adjacents;
     $counter <= $currentPage + $adjacents;
     $counter++
     ) { 
     if ($counter == $currentPage) {
       $pagelink.= "<a class='active'>".$counter."</a>"; 
     }else{
        $pagelink.= "<a href='?page=".$counter."'>".$counter."</a>";
     }                  
}
 $pagelink.= "<a>...</a>";
 $pagelink.= "<a href='?page=".$second_last."'>".$second_last."</a>";
 $pagelink.= "<a href='?page=".$totalPages."'>".$totalPages."</a>";
}else {
 $pagelink.= "<a href='?page=1'>1</a>";
 $pagelink.= "<a href='?page=2'>2</a>";
 $pagelink.= "<a>...</a>";
for (
     $counter = $totalPages - 6;
     $counter <= $totalPages;
     $counter++
     ) {
     if ($counter == $currentPage) {
       $pagelink.= "<a class='active'>".$counter."</a>"; 
       }else{
        $pagelink.= "<a href='?page=".$counter."'>".$counter."</a>";
       }                   
}}}
return $pagelink;
}
// final script to create pagination
function pagination($totalRecordsPerPage,$qry){
 include('mysql.connect.php');	
 $currentPage=current_page();
 $query =$qry;
 $result=$mysql->prepare($query); 
 $result->execute();
 $totalRecords=$result->rowCount();
 //echo $totalRecords."<Br>";
 $mysql=null;
 $totalPages = ceil($totalRecords / $totalRecordsPerPage);
 $pagination='';
 $pagination.=previous_page();
 $pagination.=pagination_numbers($totalPages);
 $pagination.=next_page($totalPages);
  return $pagination;
}
?>