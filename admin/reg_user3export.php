<?php
session_start();
include_once 'function.php';



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
// $walletbalanmcenow = 0;

     
                         $thisdate = date('Y-m-d');     
              //`trans_id`, `cus_id`, `trans_date`, `trans_des`, `amt_credit`, `amt_debit`, `status`SELECT * FROM `transaction` WHERE 1
$walletadmincedit = mysqli_query($connect, "SELECT SUM(amt_credit) as creditnow from transaction where cus_id ='$reg_id' and status = '1'and trans_des LIKE '%Income%'  and `trans_date` BETWEEN '2024-01-01' AND '$thisdate'") or die(mysqli_error());
while ($FETCH_adminbalancec = mysqli_fetch_array($walletadmincedit))
{
$creditnow = $FETCH_adminbalancec['creditnow'];


}

              //`trans_id`, `cus_id`, `trans_date`, `trans_des`, `amt_credit`, `amt_debit`, `status`SELECT * FROM `transaction` WHERE 1
$walletadmincedit2 = mysqli_query($connect, "SELECT SUM(amt_credit) as creditnow2 from transaction where cus_id ='$reg_id' and status = '1'and trans_des LIKE '%Wallet payment%'  and `trans_date` BETWEEN '2024-01-01' AND '$thisdate'") or die(mysqli_error());
while ($FETCH_adminbalancec2 = mysqli_fetch_array($walletadmincedit2))
{
$creditnow2 = $FETCH_adminbalancec2['creditnow2'];


}
// echo "SELECT SUM(amt_debit) as debitnow from transaction where cus_id ='$registered_users_id' and status = '1'and trans_des LIKE '%product%'  and `trans_date` BETWEEN '2024-01-01' AND '$thisdate'";

              //`trans_id`, `cus_id`, `trans_date`, `trans_des`, `amt_credit`, `amt_debit`, `status`SELECT * FROM `transaction` WHERE 1
$walletadmincedit = mysqli_query($connect, "SELECT SUM(amt_debit) as debitnow from transaction where cus_id ='$reg_id' and status = '1'and trans_des LIKE '%product%'  and `trans_date` BETWEEN '2024-01-01' AND '$thisdate'") or die(mysqli_error());
while ($FETCH_adminbalancec = mysqli_fetch_array($walletadmincedit))
{
$debitnow = $FETCH_adminbalancec['debitnow'];


}

              //`trans_id`, `cus_id`, `trans_date`, `trans_des`, `amt_credit`, `amt_debit`, `status`SELECT * FROM `transaction` WHERE 1 and status = '1'
$walletadmincedit22 = mysqli_query($connect, "SELECT SUM(amt_debit) as debitnow2 from transaction where cus_id ='$reg_id'   and trans_des LIKE '%Wallet withdraw%'  and `trans_date` BETWEEN '2024-01-01' AND '$thisdate'") or die(mysqli_error());
while ($FETCH_adminbalancec22 = mysqli_fetch_array($walletadmincedit22))
{
$debitnow2 = $FETCH_adminbalancec22['debitnow2'];
$debitnow2 = ($debitnow2 * 100) / 95;

}

              //`trans_id`, `cus_id`, `trans_date`, `trans_des`, `amt_credit`, `amt_debit`, `status`SELECT * FROM `transaction` WHERE 1
$walletadmincedit22w = mysqli_query($connect, "SELECT SUM(amt_debit) as debitnow2 from transaction where cus_id ='$reg_id' and status = '0' and trans_des LIKE '%Wallet withdraw%'  and `trans_date` BETWEEN '2024-01-01' AND '$thisdate'") or die(mysqli_error());
while ($FETCH_adminbalancec22w = mysqli_fetch_array($walletadmincedit22w))
{
$debitnow2w = $FETCH_adminbalancec22w['debitnow2'];
$debitnow2w = ($debitnow2w * 100) / 95;

}

              //`trans_id`, `cus_id`, `trans_date`, `trans_des`, `amt_credit`, `amt_debit`, `status`SELECT * FROM `transaction` WHERE 1
$walletadmincedit23 = mysqli_query($connect, "SELECT SUM(amt_debit) as debitnow3 from transaction where cus_id ='$reg_id' and status = '1'and trans_des LIKE '%Income%'  and `trans_date` BETWEEN '2024-01-01' AND '$thisdate'") or die(mysqli_error());
while ($FETCH_adminbalancec23 = mysqli_fetch_array($walletadmincedit23))
{
$debitnow3 = $FETCH_adminbalancec23['debitnow3'];


}

$walletadmintoday = mysqli_query($connect, "SELECT  SUM(amt_debit) AS msum FROM `transaction` WHERE `trans_date` BETWEEN '2024-02-04' AND '2024-02-06' AND `trans_des` = 'Wallet withdraw' AND cus_id = '$reg_id'") or die(mysqli_error($connect));
while ($FETCH_adminbalancec2 = mysqli_fetch_array($walletadmintoday))
{
  $creditnow2day = $FETCH_adminbalancec2['msum'];
}

$walletbalanmcenow =  $creditnow + $creditnow2 + $debitnow3 - $debitnow  - $debitnow2 + $creditnow2day;
                              

    $data[] = array(
    		"sno"=>$sno,
    		"customername"=>$reg_phone,
            "walletbalance"=>$walletbalanmcenow,
    	);

}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);