<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/helpers.inc.php'; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Manage Groups: Search Results</title>
    <meta http-equiv="content-type"
    content="text/html; charset=utf-8"/>
      <!-- Custom fonts for this template-->
      <link href="../../includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../includes/css/sb-admin-2.min.css" rel="stylesheet">

     <!-- Custom styles for this page -->
     <link href="../../includes/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


</head>

 

<body>

	<!-- Page Wrapper -->
    <div id="wrapper">
        <?php include "components/sidebar.html";  ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include "components/topbar.html";  ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?php htmlout($pagetitle); ?></h1>            

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 bg-gradient-primary " style="opacity:0.25">
                            <h6 class="m-0 font-weight-bold text-gray-400 ">Groups information</h6>
                        </div>
                        <div class="card-body">
							<div class="row">
                                <div class="col-lg-4">
                                    <form action="?<?php htmlout($action); ?>" method="POST">

                                        <div class="form-group">
                                            <label for="rcc">RCC:</label>
                                            <select class="form-control" required name="rcc" id="rcc">
                                                <option value="">Select one</option>
                                                <?php foreach ($rccs as $rcc): ?>
                                                <option value="<?php htmlout($rcc->rcc_id); ?>"
                                                <?php
                                                if ($rcc->rcc_id == $rccid)
                                                echo ' selected="selected"';?>>
                                                <?php htmlout($rcc->rcc_name); ?></option>
                                                <?php endforeach; ?>
                                                </select>

                                                <?php if(isset($error)){
                                                    echo $error;
                                                } ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="groupname" >Group Name:</label>
                                            <input class="form-control" type="text" id="groupname" name="groupname" value= '<?php htmlout($groupname);?>'>
                                        </div>

                                        <div class="form-group">
                                            <label for="lccname"> Name of LCC:</label>
                                            <input class="form-control" type="text" id="lccname" name="lccname" value='<?php htmlout($lccname);?>'>
                                        </div>

                                        <div class="form-group">
                                            <input type="hidden" name="group_id" value="<?php htmlout($groupid); ?>"/>
                                            <input type="submit" value="<?php htmlout($button); ?>"/>
                                        </div>

                                    </form>
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    </div>
                    <!-- /.container-fluid -->

                

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- end of page wrapper -->


	<!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="../" method="post">
                        <div>
                            <input type="hidden" name="action" value="logout" />
                            <input type="hidden" name="goto" value="." />
                            <input type="submit" class="btn btn-danger text-light" value="Log out" />
                        </div>
                    </form>
                    <!-- <a class="btn btn-primary" href="login.html">Logout</a> -->
                </div>
            </div>
        </div>
    </div>

	<script>
		$(document).ready(function(){
			const queryString = window.location.search;
				url = "http://localhost/adashe_api/api/rccs/read.php";
				$.ajax({
					method: "GET",
					url: url,
					
				}).done(function(data) {
					status = data['status']
					message = data['message']
					// alert(message)	
					let i = 0;			
					
					if(status == 0){
						data = JSON.stringify(data['data'])
						data = JSON.parse(data)
						for(i=0; i<data.length; i++){
							$('<option value="' + data[i]['rcc_id'] + '">' + data[i]['rcc_name'] + '</option>').appendTo('#rcc');
							console.log(data[i])
						}
					}else if(status == 1){
						// alert(status)
						$('<option value="">' + message + '</option>').appendTo('#rcc');
					}
					
					console.log(data[0]['rcc-name'])
					
				}).fail(function(){
					alert("failure")
				})

			
			
			
		})
				
		
	</script>

	<!-- Bootstrap core JavaScript-->
	<script src="../../includes/vendor/jquery/jquery.min.js"></script>
    <script src="../../includes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../includes/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../includes/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../includes/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../includes/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../includes/js/demo/datatables-demo.js"></script>
		
	

</body>
</html>