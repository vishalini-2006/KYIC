<?php
session_start();
include_once 'function.php'; // must provide $connect and $site_title

// --- CONFIG ---
$upload_dir = "blog/";           // keep your original folder
if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

// --- HELPERS ---
function e($conn, $s){ return mysqli_real_escape_string($conn, trim($s)); }
function column_exists($conn, $table, $col){
    $table = e($conn, $table); $col = e($conn, $col);
    $q = "SELECT COUNT(*) as cnt FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = '{$table}' AND COLUMN_NAME = '{$col}'";
    $r = mysqli_query($conn, $q);
    if(!$r) return false;
    $row = mysqli_fetch_assoc($r);
    return ($row['cnt'] > 0);
}

// Session role assumptions (adjust if your keys differ)
$session_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'admin';
$session_referenceid = isset($_SESSION['referenceid']) ? (int)$_SESSION['referenceid'] : 0;

// --- CREATE ---
if (isset($_POST['add']) && $_POST['add'] === 'Create') {
    $documentname = e($connect, $_POST['documentname']);
    $referenceid  = (int)$_POST['referenceid'];
    $idd          = (int)$_POST['idd'];

    $uploaded_file = "";
    if (!empty($_FILES['document']['name'])) {
        $rnd = rand(10000000,99999999);
        $basename = basename($_FILES['document']['name']);
        $uploaded_file = $rnd . "_" . $basename;
        move_uploaded_file($_FILES['document']['tmp_name'], $upload_dir . $uploaded_file);
    }

    $sql = "INSERT INTO uploaddocuments (documentname, document, referenceid, idd)
            VALUES ('{$documentname}','{$uploaded_file}','{$referenceid}','{$idd}')";
    mysqli_query($connect, $sql) or die(mysqli_error($connect));
    header("Location: uploaddocument.php?msg=added&action=list");
    exit;
}

// --- UPDATE ---
if (isset($_POST['update_page']) && $_POST['update_page'] === 'Update') {
    $docid        = (int)$_POST['docid'];
    $documentname = e($connect, $_POST['documentname']);
    $referenceid  = (int)$_POST['referenceid_select'];
    $idd          = (int)$_POST['idd_select'];
    $old_file     = e($connect, $_POST['old_file']);

    if (!empty($_FILES['document']['name'])) {
        $rnd = rand(10000000,99999999);
        $basename = basename($_FILES['document']['name']);
        $uploaded_file = $rnd . "_" . $basename;
        move_uploaded_file($_FILES['document']['tmp_name'], $upload_dir . $uploaded_file);
        if ($old_file && file_exists($upload_dir . $old_file)) unlink($upload_dir . $old_file);
    } else {
        $uploaded_file = $old_file;
    }

    $sql = "UPDATE uploaddocuments
            SET documentname = '{$documentname}', document = '{$uploaded_file}', referenceid = '{$referenceid}', idd = '{$idd}'
            WHERE id = {$docid}";
    mysqli_query($connect, $sql) or die(mysqli_error($connect));
    header("Location: uploaddocument.php?msg=updated&action=list");
    exit;
}

// --- DELETE ---
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['doc_id'])) {
    $id = (int)$_GET['doc_id'];
    $res = mysqli_query($connect, "SELECT document FROM uploaddocuments WHERE id = {$id}");
    if ($res && mysqli_num_rows($res)) {
        $row = mysqli_fetch_assoc($res);
        if (!empty($row['document']) && file_exists($upload_dir . $row['document'])) unlink($upload_dir . $row['document']);
    }
    mysqli_query($connect, "DELETE FROM uploaddocuments WHERE id = {$id}") or die(mysqli_error($connect));
    header("Location: uploaddocument.php?msg=deleted&action=list");
    exit;
}

// --- Build WHERE for reference-role users (for documents & references) ---
$where_docs = "1";
if ($session_role === 'reference' && $session_referenceid) {
    $where_docs = "u.referenceid = {$session_referenceid}";
}

// --- Determine whether apply_from has a referenceid column so we can filter clients by reference if possible ---
$apply_from_has_referenceid = column_exists($connect, 'apply_from', 'referenceid');

?>
<!DOCTYPE html>
<html lang="en">
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
  <meta charset="UTF-8">
  <head>
    <meta charset="utf-8" />
    <title>Upload Documents | <?php echo isset($site_title)?htmlspecialchars($site_title):''; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <!-- styles (kept same as your sample) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
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
    <style type="text/css"> .dt-buttons { display: none; } </style>

    <script type="text/javascript">
      function delete_menu(idurl) {
        if(confirm("Are you sure ? ")) { document.location.href = idurl; }
      }
      // If you want clients to filter by reference on the Add form (if apply_from has referenceid), JS will update later.
    </script>
  </head>
  <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
      <?php include("header.php");?>
      <div class="clearfix"></div>
      <div class="page-container">
        <?php include("menu.php");?>
        <div class="page-content-wrapper">
          <div class="page-content">
            <div class="page-bar">
              <ul class="page-breadcrumb">
                <li><a href="index.php">Home</a><i class="fa fa-circle"></i></li>
                <li><span>Upload Documents</span></li>
              </ul>
            </div>

<?php
// ---------- LIST ----------
if (!isset($_GET['action']) || $_GET['action'] == 'list') {
?>
            <br>
            <div class="row">
              <div class="col-md-12">
                <div class="portlet box red">
                  <div class="portlet-title">
                    <div class="caption"><i class="fa fa-globe"></i>Upload Documents</div>
                    <div class="actions"><a href="?action=add" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Add </a></div>
                  </div>
                  <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_2">
                      <thead>
                        <tr>
                          <th> S.NO </th>
                          <th> Document Name </th>
                          <th> Reference (name / phone) </th>
                          <th> Client (full name / date) </th>
                          <th> Upload </th>
                          <th> Modify </th>
                        </tr>
                      </thead>
                      <tbody>
<?php
$sno = 0;
$q = "SELECT u.*,
             r.reference_name, r.name AS ref_contact_name, r.phone AS ref_phone,
             a.full_name AS client_name, a.adate AS client_date
      FROM uploaddocuments u
      LEFT JOIN `reference` r ON r.referenceid = u.referenceid
      LEFT JOIN `apply_from` a ON a.idd = u.idd
      WHERE {$where_docs}
      ORDER BY u.id DESC";
$get_document = mysqli_query($connect, $q) or die(mysqli_error($connect));
while($row = mysqli_fetch_assoc($get_document)) {
    $sno++;
    $documentid = $row['id'];
    $documentname = $row['documentname'];
    $upload = $row['document'];
    $ref_display = trim($row['reference_name'].' / '.$row['ref_phone']);
    $client_display = trim($row['client_name'].' / '.$row['client_date']);
?>
                        <tr>
                          <td><?php echo $sno;?></td>
                          <td><?php echo htmlspecialchars($documentname);?></td>
                          <td><?php echo htmlspecialchars($ref_display);?></td>
                          <td><?php echo htmlspecialchars($client_display);?></td>
                          <td>
                            <?php if($upload): ?>
                              <a class="btn btn-info btn-xs" href="<?php echo $upload_dir . rawurlencode($upload); ?>" target="_blank" download="<?php echo rawurlencode($upload); ?>">
                                <i class="fa fa-download" aria-hidden="true"></i> Download
                              </a>
                            <?php endif; ?>
                          </td>
                          <td>
                            <a class="btn btn-warning btn-xs" href="uploaddocument.php?action=edit&doc_id=<?php echo $documentid; ?>"><i class="fa fa-pencil"></i> Edit</a>
                            <a class="btn btn-xs red" onClick="delete_menu('uploaddocument.php?action=delete&doc_id=<?php echo $documentid; ?>')" href="javascript:;"><i class="icon-trash"></i> Delete</a>
                          </td>
                        </tr>
<?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
<?php } // end list ?>


<?php
// ---------- ADD FORM ----------
if (isset($_GET['action']) && $_GET['action'] == 'add') {
    // references: restrict if user is reference
    if ($session_role === 'reference' && $session_referenceid) {
        $refs = mysqli_query($connect, "SELECT * FROM `reference` WHERE referenceid = ".(int)$session_referenceid) or die(mysqli_error($connect));
    } else {
        $refs = mysqli_query($connect, "SELECT * FROM `reference`") or die(mysqli_error($connect));
    }

    // clients: try to filter by referenceid only if apply_from has referenceid column
    if ($apply_from_has_referenceid && $session_role === 'reference' && $session_referenceid) {
        $custs = mysqli_query($connect, "SELECT * FROM apply_from WHERE referenceid = ".(int)$session_referenceid) or die(mysqli_error($connect));
    } else {
        $custs = mysqli_query($connect, "SELECT * FROM apply_from") or die(mysqli_error($connect));
    }
?>
            <div class="row">
              <div class="col-md-12">
                <div class="portlet light portlet-fit portlet-form bordered">
                  <div class="portlet-title">
                    <div class="caption"><i class="fa fa-list font-red"></i><span class="caption-subject font-red sbold uppercase">ADD</span></div>
                  </div>
                  <div class="portlet-body">
                    <form action="uploaddocument.php" id="form_sample_1" method="post" class="form-horizontal" enctype="multipart/form-data" onsubmit="return CheckFormData();">
                      <div class="form-body">

                        <div class="form-group">
                          <label class="control-label col-md-3">Document Name <span class="required"> * </span></label>
                          <div class="col-md-4"><input type="text" name="documentname" id="name" class="form-control" required></div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3">Reference <span class="required"> * </span></label>
                          <div class="col-md-4">
                            <select name="referenceid" id="reference_select" class="form-control" required>
                              <option value="">-- Select Reference --</option>
<?php while($r = mysqli_fetch_assoc($refs)) { ?>
                              <option value="<?php echo (int)$r['referenceid']; ?>"><?php echo htmlspecialchars($r['reference_name'].' ('.$r['username'].')'); ?></option>
<?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3">Client <span class="required"> * </span></label>
                          <div class="col-md-4">
                            <select name="idd" id="client_select" class="form-control" required>
                              <option value="">-- Select Client --</option>
<?php while($c = mysqli_fetch_assoc($custs)) { ?>
                              <option value="<?php echo (int)$c['idd']; ?>"><?php echo htmlspecialchars($c['full_name'].' ('.$c['adate'].')'); ?></option>
<?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group last">
                          <label class="control-label col-md-3">Upload</label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width:200px;height:150px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+document" alt="">
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:200px;max-height:150px;"></div>
                              <div>
                                <span class="btn default btn-file"><span class="fileinput-new"> Select document </span><span class="fileinput-exists"> Change </span><input type="file" name="document" id="image"></span>
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green" name="add" value="Create">Submit</button>
                            <button type="reset" value="Reset" class="btn grey-salsa btn-outline">Reset</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

<?php } // end add ?>


<?php
// ---------- EDIT FORM ----------
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['doc_id'])) {
    $docid = (int)$_GET['doc_id'];
    $res = mysqli_query($connect, "SELECT * FROM uploaddocuments WHERE id = {$docid}") or die(mysqli_error($connect));
    $d = mysqli_fetch_assoc($res);

    // references
    if ($session_role === 'reference' && $session_referenceid) {
        $refs = mysqli_query($connect, "SELECT * FROM `reference` WHERE referenceid = ".(int)$session_referenceid) or die(mysqli_error($connect));
    } else {
        $refs = mysqli_query($connect, "SELECT * FROM `reference`") or die(mysqli_error($connect));
    }

    // clients (try to filter by apply_from.referenceid if present)
    if ($apply_from_has_referenceid && $session_role === 'reference' && $session_referenceid) {
        $custs = mysqli_query($connect, "SELECT * FROM apply_from WHERE referenceid = ".(int)$session_referenceid) or die(mysqli_error($connect));
    } else {
        $custs = mysqli_query($connect, "SELECT * FROM apply_from") or die(mysqli_error($connect));
    }
?>
            <div class="row">
              <div class="col-md-12">
                <div class="portlet light portlet-fit portlet-form bordered">
                  <div class="portlet-title">
                    <div class="caption"><i class="fa fa-pencil font-red"></i><span class="caption-subject font-red sbold uppercase">Edit</span></div>
                  </div>
                  <div class="portlet-body">
                    <form action="uploaddocument.php" id="form_sample_1" method="post" class="form-horizontal" enctype="multipart/form-data">
                      <div class="form-body">

                        <div class="form-group">
                          <label class="control-label col-md-3">Document Name <span class="required"> * </span></label>
                          <div class="col-md-4"><input type="text" name="documentname" id="name" class="form-control" value="<?php echo htmlspecialchars($d['documentname']); ?>" required></div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3">Reference <span class="required"> * </span></label>
                          <div class="col-md-4">
                            <select name="referenceid_select" class="form-control" required>
                              <option value="">-- Select Reference --</option>
<?php while($r = mysqli_fetch_assoc($refs)) { $sel = ($r['referenceid'] == $d['referenceid']) ? 'selected' : ''; ?>
                              <option value="<?php echo (int)$r['referenceid']; ?>" <?php echo $sel; ?>><?php echo htmlspecialchars($r['reference_name'].' - '.$r['phone']); ?></option>
<?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3">Client <span class="required"> * </span></label>
                          <div class="col-md-4">
                            <select name="idd_select" class="form-control" required>
                              <option value="">-- Select Client --</option>
<?php while($c = mysqli_fetch_assoc($custs)) { $cs = ($c['idd'] == $d['idd']) ? 'selected' : ''; ?>
                              <option value="<?php echo (int)$c['idd']; ?>" <?php echo $cs; ?>><?php echo htmlspecialchars($c['full_name'].' ('.$c['adate'].')'); ?></option>
<?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="form-group last">
                          <label class="control-label col-md-3">Upload</label>
                          <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                              <div class="fileinput-new thumbnail" style="width:200px;height:150px;">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+document" alt="">
                              </div>
                              <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:200px;max-height:150px;"></div>
                              <div>
                                <span class="btn default btn-file"><span class="fileinput-new"> Select document </span><span class="fileinput-exists"> Change </span><input type="file" name="document" id="image"></span>
                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                              </div>
                            </div>
                            <?php if (!empty($d['document'])): ?>
                              <p>Current file: <a href="<?php echo $upload_dir . rawurlencode($d['document']); ?>" target="_blank"><?php echo htmlspecialchars($d['document']); ?></a></p>
                            <?php endif; ?>
                          </div>
                        </div>

                      </div>
                      <div class="form-actions">
                        <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                            <input type="hidden" name="docid" value="<?php echo (int)$d['id']; ?>">
                            <input type="hidden" name="old_file" value="<?php echo htmlspecialchars($d['document']); ?>">
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
<?php } // end edit ?>


            <div class="clearfix"></div>
          </div>
        </div>
      </div>

      <?php include("footer.php");?>
    </div>

    <!-- SCRIPTS (kept your sample includes) -->
    <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
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
    <script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

    <script>
      // Optional: if apply_from has referenceid, auto-filter clients when reference changes
      <?php if ($apply_from_has_referenceid): ?>
      $('#reference_select').on('change', function(){
        var ref = $(this).val();
        // naive AJAX fetch (create a small endpoint inline)
        $.ajax({
          url: 'uploaddocument.php',
          type: 'GET',
          data: { fetch_clients_for_ref: ref },
          success: function(html){
            if(html){
              $('#client_select').html(html);
            }
          }
        });
      });
      <?php endif; ?>

      function CheckFormData(){ return true; }
    </script>

<?php
// Small AJAX endpoint to return client <option> list when apply_from.referenceid exists
if (isset($_GET['fetch_clients_for_ref']) && $apply_from_has_referenceid) {
    $ref = (int)$_GET['fetch_clients_for_ref'];
    $res = mysqli_query($connect, "SELECT * FROM apply_from WHERE referenceid = {$ref}");
    $out = '<option value="">-- Select Client --</option>';
    while($c = mysqli_fetch_assoc($res)){
        $out .= '<option value="'.(int)$c['idd'].'">'.htmlspecialchars($c['full_name'].' ('.$c['adate'].')').'</option>';
    }
    echo $out;
    exit;
}
?>

  </body>
</html>
