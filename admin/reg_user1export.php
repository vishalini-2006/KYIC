<?php
session_start();
include_once 'function.php';
?>



<?php
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
	$searchQuery = " and ( 
        reg_id like '%".$searchValue."%' or 
        reg_name like'%".$searchValue."%'
       ) ";
}

## Total number of records without filtering
$sel = mysqli_query($connect,"select count(*) as allcount from reg_user");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
// echo "select count(*) as allcount from reg_user WHERE 1 ".$searchQuery;
$sel = mysqli_query($connect,"select count(*) as allcount from reg_user WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records.
 $sno=0;
                                                   
                                                     $reg_id="";
                                                     $reg_name="";
                                                     $walletbalanmcenow="";
                                                    //  echo $empQuery = "select * from reg_user WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
 $empQuery = "select * from reg_user WHERE 1 ".$searchQuery." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($connect, $empQuery);
$data = array();

while ($row1 = mysqli_fetch_assoc($empRecords)) {
$sno++; 
 $reg_id = $row1['reg_id'];    
$reg_name=$row1['reg_name']; 
$reg_mailid=$row1['reg_mailid']; 
$reg_pin=$row1['reg_pin']; 
$reg_phone=$row1['reg_phone']; 


$accountno=$row1['accountno']; 
$ifsccode=$row1['ifsccode']; 
$bankdetails=$row1['bankdetails']; 
$referedby=$row1['referedby'];
$status=$row1['status'];
if($status == 0){
    $status = "Äctive";
}else{
    $status = "In-Äctive";
}
// $walletbalanmcenow = 0;
$itcno =  $reg_name.'- ITC'.$reg_id;

// $modify = "100";
                        $reg_idd = 'ITC'.$reg_id;
                        $get_customerr = mysqli_query($connect,"SELECT * FROM reg_user where referedby = '$reg_idd'") or die(mysqli_error());
while($get_valuer = mysqli_fetch_array($get_customerr)) 
{
    $reg_sid=$get_valuer['reg_id']; 
 $reg_namer=$get_valuer['reg_name']; 
 $reg_nameref[] = $reg_namer. " - ITC ".$reg_sid."<br>";
 
//  $combine

}


//   $modify =  "<a class='btn btn-info btn-xs' data-toggle='modal' href='#addpayment$reg_id'>
//                               <i class='fa fa-eye' aria-hidden='true'>
//                               </i> Add money 
//                             </a>";
                            
//   $modify .=  "<a class='btn btn-xs btn-danger'  onClick='delete_menu('reg_users1.php?action=delete&nwsevnt_id=$reg_id')' href='javascript:;'>
//                                                             <i class='fa fa-trash'></i> Delete</a>";
                                                            
                    
  $modify .=  "<a class='btn btn-xs btn-danger' href='transactions.php?id=$reg_id' target='_blank'>
                                                           transactions</a>";
                                                           
                       $modify .= "<a class='btn btn-xs btn-danger' href='ptransactions.php?id=$reg_id' target='_blank'>
                                                       Purchases</a>";
                                                           
   $modify .= "<a class='btn btn-xs btn-danger' href='roitransactions.php?id=$reg_id;' target='_blank'>ROI</a>";
   
                                                           
    $modify .= "<a class='btn btn-xs btn-danger' href='rtransactions.php?id=$reg_id;' target='_blank'>Referals</a>";
                                                           
    $modify .= "<a class='btn btn-xs btn-danger' href='ltransactions.php?id=$reg_id;' target='_blank'>Level</a>";
    $modify .= "<a class='btn btn-xs btn-danger' href='wtransactions.php?id=$reg_id;' target='_blank'>wallet withdraw</a>";
                                                            
        
                          
                              

    $data[] = array(
    		"sno"=>$sno,
    		"username"=>$itcno,
            "mail"=>$reg_mailid,
            "pin"=>$reg_pin,
            "phone"=>$reg_phone,
            "referals"=>$reg_nameref,
            "referedby"=>$referedby,
            "modify"=>$modify,
            "status"=>$status,
            
    	);

}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

?>

<?php

echo json_encode($response);

?>