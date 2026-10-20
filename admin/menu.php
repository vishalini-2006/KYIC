<?php
// echo $Admin_level;
if($Admin_level == '1'){
?>


<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            
          <li class="nav-item start <?php echo $home;?>">
                <a href="home.php" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
        
           
            
            <!--.....................................................................................................-->
            
             <li class="nav-item start <?php echo $news; ?>">
                <a href="caselogin.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Case login </span>
                    <span class="selected"></span>
                </a>
            </li>
            
            <!--       <li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="qde.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">QDE</span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
            
            <!-- <li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="pde.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">PDE </span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
            
             <li class="nav-item start <?php echo $news; ?>">
                <a href="creditappraisal.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Credit appraisal </span>
                    <span class="selected"></span>
                </a>
            </li>
            
            <!--   <li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="financial.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">Financial sanction </span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
            
             <li class="nav-item start <?php echo $news; ?>">
                <a href="final.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Final sanction </span>
                    <span class="selected"></span>
                </a>
            </li>
            
            <li class="nav-item start <?php echo $news; ?>">
                <a href="legal.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Legal/Tech clearance </span>
                    <span class="selected"></span>
                </a>
            </li>
            
            <!--   <li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="local.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">Loan docket creation </span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
            
            <li class="nav-item start <?php echo $news; ?>">
                <a href="disbursement.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Disbursement </span>
                    <span class="selected"></span>
                </a>
            </li>
            
            <!--   <li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="loannumber.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">Loan Account Number Generation </span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
            
             <li class="nav-item start <?php echo $news; ?>">
                <a href="cancelledloans.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Cancelled Loans</span>
                    <span class="selected"></span>
                </a>
            </li>
            
            
            <!--    <li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="cibilcheck.php" class="nav-link" target="_blank">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">Check cibil</span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->


            
            <!--                <li class="nav-item start <?php echo $references_menuupload; ?>">-->
            <!--    <a href="uploaddocument.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">Upload documents</span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
    
          
            
            <li class="nav-item start">
                <a href="logout.php?logout" class="nav-link">
                    <i class="icon-logout"></i>
                    <span class="title">Logout</span>
                    <span class="selected"></span>
                </a>
            </li>


            <!-- <li class="heading">
                <h3 class="uppercase">Layouts</h3>
            </li> -->
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>

<?php
}else{
?>

<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            
            <li class="nav-item start <?php echo $home;?>">
                <a href="home.php" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?php echo $news; ?>">
                <a href="new_product.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title"> Application Form</span>
                    <span class="selected"></span>
                </a>


            <!--<li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="product.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">Service Applications</span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
            
               <li class="nav-item start <?php echo $news; ?>">
                <a href="productpending.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Pending Applications</span>
                    <span class="selected"></span>
                </a>
            </li>
            
               <li class="nav-item start <?php echo $news; ?>">
                <a href="bank_details.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Bank Details</span>
                    <span class="selected"></span>
                </a>
            </li>
            
            
            <!--.....................................................................................................-->
            
             <li class="nav-item start <?php echo $news; ?>">
                <a href="caselogin.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Case login </span>
                    <span class="selected"></span>
                </a>
            </li>
            
            <!--       <li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="qde.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">QDE</span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
            
            <!-- <li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="pde.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">PDE </span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
            
            <!-- <li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="creditappraisal.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">Credit appraisal </span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
            
            <!--   <li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="financial.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">Financial sanction </span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
            
             <li class="nav-item start <?php echo $news; ?>">
                <a href="final.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Process</span>
                    <span class="selected"></span>
                </a>
            </li>
            
            <li class="nav-item start <?php echo $news; ?>">
                <a href="legal.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Legal/Tech clearance </span>
                    <span class="selected"></span>
                </a>
            </li>
            
            <!--   <li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="local.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">Loan docket creation </span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
            
            <li class="nav-item start <?php echo $news; ?>">
                <a href="disbursement.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Disbursement </span>
                    <span class="selected"></span>
                </a>
            </li>
            
            <!--   <li class="nav-item start <?php echo $news; ?>">-->
            <!--    <a href="loannumber.php" class="nav-link">-->
            <!--        <i class="icon-tag" aria-hidden="true"></i>-->
            <!--        <span class="title">Loan Account Number Generation </span>-->
            <!--        <span class="selected"></span>-->
            <!--    </a>-->
            <!--</li>-->
            
             <li class="nav-item start <?php echo $news; ?>">
                <a href="cancelledloans.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Cancelled Loans</span>
                    <span class="selected"></span>
                </a>
            </li>


            
       
    
            <li class="nav-item start <?php echo $organic_menu; ?>">
                <a href="reg_users1.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Contact Enq</span>
                    <span class="selected"></span>
                </a>
            </li>
            
               <li class="nav-item start <?php echo $references_menu; ?>">
                <a href="references.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Sales Executive / Vendor</span>
                    <span class="selected"></span>
                </a>
            </li>
            
              <li class="nav-item start <?php echo $referencesreport_menu; ?>">
                <a href="referencesreport.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Sales Executive Report / &nbsp;&nbsp;&nbsp;&nbsp;Vendor</span>
                    <span class="selected"></span>
                </a>
            </li>
            
              <li class="nav-item start <?php echo $referencesreport_menu; ?>">
                <a href="disbursereport.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Disbursement Report</span>
                    <span class="selected"></span>
                </a>
            </li>
            
            
            <li class="nav-item start <?php echo $references_menu; ?>">
                <a href="upload.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Upload</span>
                    <span class="selected"></span>
                </a>
            </li>
            
                                 <li class="nav-item start <?php echo $references_menuupload; ?>">
                <a href="uploaddocument.php" class="nav-link">
                    <i class="icon-tag" aria-hidden="true"></i>
                    <span class="title">Upload documents</span>
                    <span class="selected"></span>
                </a>
            </li>
   
          
          
            
            <li class="nav-item start">
                <a href="logout.php?logout" class="nav-link">
                    <i class="icon-logout"></i>
                    <span class="title">Logout</span>
                    <span class="selected"></span>
                </a>
            </li>


            <!-- <li class="heading">
                <h3 class="uppercase">Layouts</h3>
            </li> -->
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<?php
}
?>