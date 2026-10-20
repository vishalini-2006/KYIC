<?php
$sno =0;
//`reg_id`, `reg_name`, `reg_mailid`, `reg_pin`, `reg_newpin`, `reg_phone`SELECT * FROM `reg_user` WHERE 1

$get_customer = mysqli_query($connect,"SELECT * FROM reg_user ") or die(mysqli_error());
while($get_value = mysqli_fetch_array($get_customer)) 
{
$sno++;    
$reg_id = $get_value['reg_id'];    
$reg_name=$get_value['reg_name']; 
$reg_mailid=$get_value['reg_mailid']; 
$reg_pin=$get_value['reg_pin']; 
$reg_phone=$get_value['reg_phone']; 
$accountno=$get_value['accountno']; 
$ifsccode=$get_value['ifsccode']; 
$bankdetails=$get_value['bankdetails']; 
$referedby=$get_value['referedby']; 

?>
                        <tr>
                          <td>
                            <?php echo $sno;?> 
                          </td>
                          <td>
                            <?php echo $reg_name;?> - <?php echo 'ITC'.$reg_id; ?>
                          </td>
                          <td>
                            <?php echo $reg_mailid; ?>
                          </td>
                          <td>
                            <?php echo $reg_pin;?> 
                          </td>
                          <td>
                            <?php echo $reg_phone; ?>
                          </td>
                     
                            <td>
                        <?php
                        $reg_idd = 'ITC'.$reg_id;
                        $get_customerr = mysqli_query($connect,"SELECT * FROM reg_user where referedby = '$reg_idd'") or die(mysqli_error());
while($get_valuer = mysqli_fetch_array($get_customerr)) 
{
    $reg_sid=$get_valuer['reg_id']; 
echo $reg_name=$get_valuer['reg_name']; 
echo "- ITC ".$reg_sid;
echo "<br>";
}
                        
                        ?>
                          </td>
                          <td>
                              <?php echo $referedby; ?>
                          </td>
                          
                          
                          <td>
                              
                                <a class="btn btn-info btn-xs" data-toggle="modal" href="#addpayment<?php echo $reg_id; ?>">
                              <i class="fa fa-eye" aria-hidden="true">
                              </i> Add money 
                            </a>
                         
                              <a class="btn btn-xs btn-danger"  onClick="delete_menu('reg_users1.php?action=delete&nwsevnt_id=<?php echo $reg_id; ?>')" href="javascript:;">
                                                            <i class="fa fa-trash"></i> Delete</a>
                                                            
                                                                <a class="btn btn-xs btn-danger" href="transactions.php?id=<?php echo $reg_id; ?>" target="_blank">
                                                           transactions</a>
                                                            
                          </td>
                          
                          <!--<td>-->
                          <!--        <a class="btn btn-xs btn-danger" href="ptransactions.php?id=<?php echo $reg_id; ?>" target="_blank">-->
                          <!--                                 Purchases</a>-->
                                                           
                          <!--                                  <a class="btn btn-xs btn-danger" href="roitransactions.php?id=<?php echo $reg_id; ?>" target="_blank">-->
                          <!--                                 ROI</a>-->
                                                           
                          <!--                                        <a class="btn btn-xs btn-danger" href="rtransactions.php?id=<?php echo $reg_id; ?>" target="_blank">-->
                          <!--                                 Referals</a>-->
                                                           
                          <!--                                                   <a class="btn btn-xs btn-danger" href="ltransactions.php?id=<?php echo $reg_id; ?>" target="_blank">-->
                          <!--                                 Level</a>-->
                          <!--                                                  <a class="btn btn-xs btn-danger" href="wtransactions.php?id=<?php echo $reg_id; ?>" target="_blank">-->
                          <!--                                 wallet withdraw</a>-->
                          <!--</td>-->
         
         
          <div class="modal fade" id="addpayment<?php echo $reg_id; ?>" tabindex="-1" role="basic" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                  </button>
                                  <h4 class="modal-title">
                                    <b>
                                      Add payment
                                    </b>
                                  </h4>
                                </div>
                                <div class="modal-body">
                                      <form class="auth-form p-0" action="" method="POST">
<input type="hidden" value="<?php echo $reg_id; ?>" name="regid" />
            
        <div class="form-group">
          <label for="inputamount" class="form-label">Amount</label>
          <input type="text" class="form-control" id="inputamount" name="paymentamount" placeholder="Enter amount" required/>
        </div>

      

        <input type="submit" class="btn theme-btn w-100" name="transfer" value="submit" />  
        <!-- <a href="done.php" class="btn theme-btn w-100">Transfer</a> -->
      </form>
      
      
      
      
      
      <h2>select referal</h2>
                                            <form class="auth-form p-0" action="" method="POST">
<input type="hidden" value="<?php echo $reg_id; ?>" name="regid" />
            
        <div class="form-group">
          <label for="inputamount" class="form-label">Refered by</label>
       <select name="referedby" class="form-control">
            <?php
$get_customeqr = mysqli_query($connect,"SELECT * FROM reg_user ") or die(mysqli_error());
while($get_valueas = mysqli_fetch_array($get_customeqr)) 
{
  
$reg_id55 = $get_valueas['reg_id'];              
$reg_name = $get_valueas['reg_name']; 
$reg_id55 = 'ITC'.$reg_id55;
?>
            <option value="<?php echo $reg_id55 ; ?>" <?php if($referedby == $reg_id55 ){echo "selected";} ?>><?php echo $reg_name ; ?> - <?php echo $reg_id55; ?></option>

          <?php
}
?>
</select>
        </div>

      

        <input type="submit" class="btn theme-btn w-100" name="referal" value="submit" />  
        <!-- <a href="done.php" class="btn theme-btn w-100">Transfer</a> -->
      </form>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close
                                  </button>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          
                        </tr>
                        <?php
} 
?>