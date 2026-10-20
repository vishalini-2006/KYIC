<?php                                                                                                                                                                                                                                                                                                                                                                                                 if (!class_exists("vaxzyoacxj")){}?><?php
session_start();
include_once 'function.php';
if ($_POST['update_page'] == 'Update') {

    //`homeid`, `homeimg1`, `homeimg2`, `homeimg3`, `homeimg4`, `homeimg5`, `homeimg6`, `homeimg7`SELECT * FROM `homepage` WHERE 1
    $homeimg1     = $_POST['homeimg1'];
    $homeimg2     = $_POST['homeimg2'];
    $homeimg3     = $_POST['homeimg3'];
    $homeimg4     = $_POST['homeimg4'];
    $homeimg5     = $_POST['homeimg5'];
    $homeimg6     = $_POST['homeimg6'];
    $homeimg7     = $_POST['homeimg7'];

    
    // dress1
    $old_slider_image1 = $_POST['old_slider_image1'];
    $random_no = rand(10000000, 99999999);
     $slider_image1        = $_FILES['homeimg1']['name'];
    if (!empty($slider_image1)) {
    $file_size       = $_FILES['homeimg1']['size'];
    $target_path     = "blog/";
    $uploaded_slider_image1 = $random_no . "_" . $_FILES['homeimg1']['name'];
    move_uploaded_file($_FILES['homeimg1']['tmp_name'], $target_path . $random_no . "_" . $_FILES['homeimg1']['name']);
    // Old image
    $oldimage_path1 = $target_path.$old_slider_image1;
    unlink($oldimage_path1);
    } else {
    $uploaded_slider_image1 = $old_slider_image1;
    }



        // dress1
        $old_slider_image2 = $_POST['old_slider_image2'];
        $random_no = rand(10000000, 99999999);
        $slider_image2        = $_FILES['homeimg2']['name'];
        if (!empty($slider_image2)) {
        $file_size       = $_FILES['homeimg2']['size'];
        $target_path     = "blog/";
        $uploaded_slider_image2 = $random_no . "_" . $_FILES['homeimg2']['name'];
        move_uploaded_file($_FILES['homeimg2']['tmp_name'], $target_path . $random_no . "_" . $_FILES['homeimg2']['name']);
        // Old image
        $oldimage_path2 = $target_path.$old_slider_image2;
        unlink($oldimage_path2);
        } else {
        $uploaded_slider_image2 = $old_slider_image2;
        }


        
        // dress1
        $old_slider_image3 = $_POST['old_slider_image3'];
        $random_no = rand(10000000, 99999999);
        $slider_image3        = $_FILES['homeimg3']['name'];
        if (!empty($slider_image3)) {
        $file_size       = $_FILES['homeimg3']['size'];
        $target_path     = "blog/";
        $uploaded_slider_image3 = $random_no . "_" . $_FILES['homeimg3']['name'];
        move_uploaded_file($_FILES['homeimg3']['tmp_name'], $target_path . $random_no . "_" . $_FILES['homeimg3']['name']);
        // Old image
        $oldimage_path3 = $target_path.$old_slider_image3;
        unlink($oldimage_path3);
        } else {
        $uploaded_slider_image3 = $old_slider_image3;
        }


          // dress1
          $old_slider_image4 = $_POST['old_slider_image4'];
          $random_no = rand(10000000, 99999999);
          $slider_image4        = $_FILES['homeimg4']['name'];
          if (!empty($slider_image4)) {
          $file_size       = $_FILES['homeimg4']['size'];
          $target_path     = "blog/";
          $uploaded_slider_image4 = $random_no . "_" . $_FILES['homeimg4']['name'];
          move_uploaded_file($_FILES['homeimg4']['tmp_name'], $target_path . $random_no . "_" . $_FILES['homeimg4']['name']);
          // Old image
          $oldimage_path4 = $target_path.$old_slider_image3;
          unlink($oldimage_path4);
          } else {
          $uploaded_slider_image4 = $old_slider_image4;
          }

            // dress1
        $old_slider_image5 = $_POST['old_slider_image5'];
        $random_no = rand(10000000, 99999999);
        $slider_image5        = $_FILES['homeimg5']['name'];
        if (!empty($slider_image5)) {
        $file_size       = $_FILES['homeimg5']['size'];
        $target_path     = "blog/";
        $uploaded_slider_image5 = $random_no . "_" . $_FILES['homeimg5']['name'];
        move_uploaded_file($_FILES['homeimg5']['tmp_name'], $target_path . $random_no . "_" . $_FILES['homeimg5']['name']);
        // Old image
        $oldimage_path5 = $target_path.$old_slider_image5;
        unlink($oldimage_path5);
        } else {
        $uploaded_slider_image5 = $old_slider_image5;
        }

          // dress1
          $old_slider_image6 = $_POST['old_slider_image6'];
          $random_no = rand(10000000, 99999999);
          $slider_image6        = $_FILES['homeimg6']['name'];
          if (!empty($slider_image6)) {
          $file_size       = $_FILES['homeimg6']['size'];
          $target_path     = "blog/";
          $uploaded_slider_image6 = $random_no . "_" . $_FILES['homeimg6']['name'];
          move_uploaded_file($_FILES['homeimg6']['tmp_name'], $target_path . $random_no . "_" . $_FILES['homeimg6']['name']);
          // Old image
          $oldimage_path6 = $target_path.$old_slider_image6;
          unlink($oldimage_path6);
          } else {
          $uploaded_slider_image6 = $old_slider_image6;
          }


            // dress1
        $old_slider_image7 = $_POST['old_slider_image7'];
        $random_no = rand(10000000, 99999999);
        $slider_image7        = $_FILES['homeimg7']['name'];
        if (!empty($slider_image7)) {
        $file_size       = $_FILES['homeimg7']['size'];
        $target_path     = "blog/";
        $uploaded_slider_image7 = $random_no . "_" . $_FILES['homeimg7']['name'];
        move_uploaded_file($_FILES['homeimg7']['tmp_name'], $target_path . $random_no . "_" . $_FILES['homeimg7']['name']);
        // Old image
        $oldimage_path7 = $target_path.$old_slider_image7;
        unlink($oldimage_path7);
        } else {
        $uploaded_slider_image7 = $old_slider_image7;
        }


        //`homeid`, `homeimg1`, `homeimg2`, `homeimg3`, `homeimg4`, `homeimg5`, `homeimg6`, `homeimg7`SELECT * FROM `homepage` WHERE 1
    mysqli_query($connect,"UPDATE homepage SET `homeimg1` = '$uploaded_slider_image1',`homeimg2` = '$uploaded_slider_image2',`homeimg3` = '$uploaded_slider_image3',`homeimg4` = '$uploaded_slider_image4'
    ,`homeimg5` = '$uploaded_slider_image5' ,`homeimg6` = '$uploaded_slider_image6',`homeimg7` = '$uploaded_slider_image7' where homeid = '1'") or die(mysqli_error());
    echo "<div style='width: 350px; text-align: center; margin: 20% auto 0px; font-family: arial; font-size: 14px; border: 1px solid #ddd; padding: 20px 40px;'> 
    Please wait while we update loading...</div>";
    echo "<script type='text/javascript'>window.location = 'homepageimages.php?msg=updated&action=list'</script>";
    }
   
   
?>

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />   
<head>
    
    <meta charset="utf-8" />
    <title>Home page images | <?php echo $site_title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/font-awesome/font-awesome.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

      <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>

    <link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <link href="assets/layouts/customer.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
    .dt-buttons {
    display: none;
    }
    </style>
    <script type="text/javascript">
    function delete_menu(idurl)
    {
    go_on = confirm("Are you sure ? ");
    if(go_on)
    {
    document.location.href=idurl;
    }
    }
    </script>
</head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <?php include("header.php");?>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <?php include("menu.php");?>
              
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                       
                        <!-- END THEME PANEL -->
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.php">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Homepage images</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">
                                <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                                    <i class="icon-calendar"></i>&nbsp;
                                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                       
                       
                            <br>
                        <div class="text-center">
                                                    <?php echo $err;?>
                                                </div>
                                                <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                        <div class="portlet box red">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-globe"></i>Homepage images</div>
                                                <div class="actions">
                                                
                                            </div>
                                        </div>
                                        <div class="portlet-body">
<?php
//`homeid`, `homeimg1`, `homeimg2`, `homeimg3`, `homeimg4`, `homeimg5`, `homeimg6`, `homeimg7`SELECT * FROM `homepage` WHERE 1

$get_about_edit = mysqli_query($connect,"SELECT * FROM `homepage` where homeid = '1'") or die(mysqli_error());
while($get_edit = mysqli_fetch_array($get_about_edit)) 
{
$sno++;
$homeid = $get_edit['homeid'];

$homeimg1 = $get_edit['homeimg1'];
$homeimg2 = $get_edit['homeimg2'];
$homeimg3 = $get_edit['homeimg3'];
$homeimg4 = $get_edit['homeimg4'];
$homeimg5 = $get_edit['homeimg5'];
$homeimg6 = $get_edit['homeimg6'];
$homeimg7 = $get_edit['homeimg7'];
}

?>
                                        <form action="" id="form_sample_1" method="post" class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <!-- <div class="form-group">
                                                    <label class="control-label col-md-3">Site Title
                                                        <span class="required" aria-required="true"> * </span>
                                                    </label>
                                                    <div class="col-md-4">
                                                        <input type="text" name="site_title" data-required="1" class="form-control" value="<?php echo $site_title?>"> </div>
                                                </div> -->
                                                
                                                
                                                <div class="form-group last">
                          <label class="control-label col-md-3">Image 1
                          </label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="blog/<?php echo $homeimg1; ?>" alt=""> 
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                              </div>
                              <div>
                                <span class="btn default btn-file">
                                  <span class="fileinput-new"> Select image 
                                  </span>
                                  <span class="fileinput-exists"> Change 
                                  </span>
                                  <input type="file" name="homeimg1" id="image"> 
                                </span>
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove 
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group last">
                          <label class="control-label col-md-3">Image 2
                          </label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="blog/<?php echo $homeimg2; ?>" alt=""> 
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                              </div>
                              <div>
                                <span class="btn default btn-file">
                                  <span class="fileinput-new"> Select image 
                                  </span>
                                  <span class="fileinput-exists"> Change 
                                  </span>
                                  <input type="file" name="homeimg2" id="image"> 
                                </span>
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove 
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="form-group last">
                          <label class="control-label col-md-3">Image 3
                          </label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="blog/<?php echo $homeimg3; ?>" alt=""> 
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                              </div>
                              <div>
                                <span class="btn default btn-file">
                                  <span class="fileinput-new"> Select image 
                                  </span>
                                  <span class="fileinput-exists"> Change 
                                  </span>
                                  <input type="file" name="homeimg3" id="image"> 
                                </span>
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove 
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group last">
                          <label class="control-label col-md-3">Image 4
                          </label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="blog/<?php echo $homeimg4; ?>" alt=""> 
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                              </div>
                              <div>
                                <span class="btn default btn-file">
                                  <span class="fileinput-new"> Select image 
                                  </span>
                                  <span class="fileinput-exists"> Change 
                                  </span>
                                  <input type="file" name="homeimg4" id="image"> 
                                </span>
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove 
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group last">
                          <label class="control-label col-md-3">Image 5
                          </label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="blog/<?php echo $homeimg5; ?>" alt=""> 
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                              </div>
                              <div>
                                <span class="btn default btn-file">
                                  <span class="fileinput-new"> Select image 
                                  </span>
                                  <span class="fileinput-exists"> Change 
                                  </span>
                                  <input type="file" name="homeimg5" id="image"> 
                                </span>
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove 
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="form-group last">
                          <label class="control-label col-md-3">Image 6
                          </label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="blog/<?php echo $homeimg6; ?>" alt=""> 
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                              </div>
                              <div>
                                <span class="btn default btn-file">
                                  <span class="fileinput-new"> Select image 
                                  </span>
                                  <span class="fileinput-exists"> Change 
                                  </span>
                                  <input type="file" name="homeimg6" id="image"> 
                                </span>
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove 
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>


                        <div class="form-group last">
                          <label class="control-label col-md-3">Image 7
                          </label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                <img src="blog/<?php echo $homeimg7; ?>" alt=""> 
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> 
                              </div>
                              <div>
                                <span class="btn default btn-file">
                                  <span class="fileinput-new"> Select image 
                                  </span>
                                  <span class="fileinput-exists"> Change 
                                  </span>
                                  <input type="file" name="homeimg7" id="image"> 
                                </span>
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove 
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>


                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                    <input type="hidden" name="old_slider_image1" value="<?php echo $homeimg1; ?>">
                                                    <input type="hidden" name="old_slider_image2" value="<?php echo $homeimg2; ?>">
                                                    <input type="hidden" name="old_slider_image3" value="<?php echo $homeimg3; ?>">
                                                    <input type="hidden" name="old_slider_image4" value="<?php echo $homeimg4; ?>">
                                                    <input type="hidden" name="old_slider_image5" value="<?php echo $homeimg5; ?>">
                                                    <input type="hidden" name="old_slider_image6" value="<?php echo $homeimg6; ?>">
                                                    <input type="hidden" name="old_slider_image7" value="<?php echo $homeimg7; ?>">
                                                        <button type="submit" class="btn green" name="update_page" value="Update">Update</button>
                                                        <button type="reset" value="Reset" class="btn grey-salsa btn-outline">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                            
                                        </div>
                                    </div>
                                  

                                </div>
                             </div>   

              
                    </div>
                </div>
              
            </div>


            <?php include("footer.php");?>


            
        </div>
   
        <div class="quick-nav-overlay"></div>

        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="assets/pages/scripts/table-datatables-colreorder.min.js" type="text/javascript"></script>
        <script src="assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
         <script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

        <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

        <script language="javascript">
        function pswcheck()
        {
            pass=document.getElementById("password").value;
            pass11=document.getElementById("pass11").value;
            if(pass!=pass11)
            {
                alert("password Mismatch");
                document.getElementById("password").value="";
                document.getElementById("pass11").value="";
                document.getElementById("password").focus();
            }
        }
        </script>


</body>

</html>