<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/adashenew/agent/includes/helpers.inc.php'; ?>
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

	 <script src="../../includes/vendor/jquery/jquery.min.js"></script>
	 <style>
		table, th, td {
			border: 1px solid black;
		}
	 </style>


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
                            <h6 class="m-0 font-weight-bold text-gray-400 ">Add members to the year plan</h6>
                        </div>
                        <div class="card-body">
							
						<div class="row">
							<div class="col-lg-4 border border-dark p-3">
								
								<form action="" method="post" ">
									<div class="form-group">
										<label for="membername">Member Name:</label>
										<input class="form-control" type="text" name="membername" id="membername" value="<?php htmlout($membername); ?>" />
									</div>

									<div class="form-group">
										<label for="email">Email:</label>
										<input class="form-control" type="text" name="email" id="email" value="<?php htmlout($email); ?>" />
									</div>
									<div class="row">
										<div class="form-grop col-lg-6">
											<label for="phone">Phone Number:</label>
											<input class="form-control" type="text" name="phone" id="phone" value="<?php htmlout($phone); ?>" />
										</div>
										<div class="form-group col-lg-6">
											<label for="role">Member Role:</label>
											<select class="form-control" name="role" id="role" >
												<option value="">Select One</option>
																
											</select>
										</div>

									</div>
									
									<div class="form-group">
										<label for="address">Address:</label>
										<input class="form-control" type="text" name="address" id="address" value="<?php htmlout($address); ?>" />
									</div>

									
									
									
									<div class="form-group">
										<label for="password">Password:</label>
										<input class="form-control" type="text" name="password" id="password" />
									</div>
									<div class="form-group">
										<input class="btn btn-primary form-control" type="submit" name ="action" value="Add Member"/>
									</div>
									
									
								</form>
								
							</div>
							
							<div class="col-lg-8 border border-dark p-2">
							<?php if (isset($_SESSION['cart'])): ?>
								<table cellspacing="0" width="100%">
									<h3>Members list</h3>
									<tr>
										<th>SN</th>
										<th>Name</th>
										<th>Email</th>
										<th>Phone Number</th> 
										<th>Address</th>             
										<th>Role</th>
										
										<th>Action</th></tr>
										<?php $sn = 1; foreach ($_SESSION['cart'] as $member): ?>
									<tr valign="top">
										<td><?php htmlout($sn); ?></td>
										<td><?php htmlout($member['member_name']); ?></td>
										<td><?php htmlout($member['email']); ?></td>
										<td><?php htmlout($member['phone_no']); ?></td>
										<td><?php htmlout($member['contact_address']); ?></td>
										<td><?php
										 switch($member['position']){
											case 1: 
												htmlout("Chairman");
												break;
											case 2:
												htmlout("Record Keeper");
												break;
											case 3:
												htmlout("Bos Keeper");
												break;
											case 4:
												htmlout("Member");
												break;
										 }
										
										 ?></td>
										
										<td>
										<form action="" method="POST">
										
										<div>										
										<a data-toggle="tooltip" title="Delete member" href=""><span class="d-flex justify-content-center text-danger"><i class="fas fa-trash"></i></span></a>                
										</div>

										</form>
										</td>
									</tr>
									<?php $sn++;   endforeach;    ?>
								</table>
								<div class="row d-flex justify-content-end p-3">
									<a class="btn btn-primary col-6" href="#" data-toggle="modal" data-target="#yearPlanModal">
										<i class="fas fa-calender fa-sm fa-fw mr-2"></i>
										Add Year Plan
									</a>

								</div>
								
							<?php endif; ?>

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

	<!-- Logout Modal-->
    <div class="modal fade" id="yearPlanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Year Plan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
				<form action="?<?php htmlout($action); ?>" method="post">
					<div class="modal-body">
						

							<div class="form-group">
								<label for="rcc">RCC:</label>
								<select class="form-control" name="rcc" id="rcc" onchange="FetchGroups(this.value)">
									<option value="">Select One</option>
									<?php foreach ($rccs as $rcc): ?>
									<option value="<?php htmlout($rcc->rcc_id); ?>"   
									<?php
									if ($rcc->rcc_id == $rccid)
									echo ' selected="selected"';?>>
									<?php htmlout($rcc->rcc_name); ?></option>
									<?php endforeach; ?>
								</select>
							</div>

									
							<div class="form-group">
								<label for="group">Group:</label>
								<select class="form-control" name="group" id="group">
								<?php 
								print_r($groups);
								foreach ($groups as $group): ?>
									<option value="<?php htmlout($group->group_id); ?>"<?php
									if ($group->group_id == $group)
									echo ' selected="selected"';?>>
									<?php htmlout($group->group_name); ?></option>
									<?php endforeach; ?>
								
								</select>
							</div>

							<div class="form-group">
								<label for="ddate">Date:</label>
								<input class="form-control" type="date" name="ddate" id="ddate" value="<?php htmlout($startweek); ?>" />
							</div>


							<div class="form-group">
								<label for="sharevalue">Share Value:</label>
								<input class="form-control" type="text"  id="sharevalue" name="sharevalue" value ="<?php htmlout($sharevalue);?>" />
							</div>

									
							<div class="form-group">
								<label for="welfare">Welfare:</label>
								<input class="form-control" type="text" name="welfare" id="welfare" value="<?php htmlout($welfare); ?>" />
							</div>
							<div>
								
							</div>

						
					</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<input type="hidden" name="sno" value="<?php htmlout($sno); ?>"/>
						<input type="submit" class="btn btn-primary text-light" value="<?php htmlout($button); ?>"/>							
						
						<!-- <a class="btn btn-primary" href="login.html">Logout</a> -->
					</div>
				</form>
            </div>
        </div>
    </div>


	<script>

		$(document).ready(function(){
			url = "http://localhost/adashe_api/api/year_plan/get_role.php";
			$.ajax({
				method: "GET",
				url: url,
				
			}).done(function(data) {					
				let i = 0;				
				if(status == 0){
					data = JSON.stringify(data['data'])
					data = JSON.parse(data)
					for(i=0; i<data.length; i++){
						$('<option value="' + data[i]['role_id'] + '">' + data[i]['position'] + '</option>').appendTo('#role');
						console.log(data[i])
					}
				}else if(status == 1){
					// alert(status)
					$("#role").html("");
					$('<option value="">' + message + '</option>').appendTo('#role');
				}
			
				
			}).fail(function(){
				alert("failure")
			})	
			
		})
				
		function FetchGroups(id) {
			$("#group").html("");
			url = "http://localhost/adashe_api/api/groups/read_single.php?column=rcc_id&value=";
			$.ajax({
				method: "GET",
				url: url.concat(id),
				
			}).done(function(data) {
				status = data['status']
				message = data['message']
				// alert(message)	
				let i = 0;			
				
				if(status == 0){
					data = JSON.stringify(data['data'])
					data = JSON.parse(data)
					for(i=0; i<data.length; i++){
						$('<option value="' + data[i]['group_id'] + '">' + data[i]['group_name'] + '</option>').appendTo('#group');
					}
				}else if(status == 1){
					// alert(status)
					$('<option value="">' + message + '</option>').appendTo('#group');
				}
				
				console.log(data[0]['group_name'])
				
			}).fail(function(){
				alert("failure")
			})
		}

		
	</script>

	<!-- Bootstrap core JavaScript-->
	
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