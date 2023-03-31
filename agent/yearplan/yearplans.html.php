<?php include_once $_SERVER['DOCUMENT_ROOT'] .'/ngcares/includes/helpers.inc.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Manage Year plans: Search Results</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Manage Year Plans</h1>  

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 ">
                            <div class="row">
                                <div class="col-10">
                                    <h6 class="m-0 font-weight-bold">Year plans information</h6> 

                                </div>
                                <div class="col-2 d-flex flex-row justify-content-end">
                                    <a href="./?add" class="btn btn-sm btn-primary">Add new Plan</a>
                                </div>
                            </div>
                        </div>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <?php if (isset($yearplans)): ?>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>S/No</th>
                                            <th>Rcc</th>
                                            <th>Group Name</th>
                                            <th>Startweek</th>
                                            <th>Share Value Year</th>
                                            <th>Welfare</th>
                                            <th>Start Year</th>
                                            <th>End Year</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                        <?php $xy=1; foreach ($yearplans as $yearplan):  ?>
                                        <tr valign="top">
                                            <td><?php htmlout($yearplan->plan_id); ?></td>
                                            <td><?php htmlout($yearplan->rcc_name); ?></td>
                                            <td><?php htmlout($yearplan->group_name); ?></td>
                                            <td><?php htmlout($yearplan->start_week); ?></td>
                                            <td><?php htmlout($yearplan->share_value); ?></td>
                                            <td><?php htmlout($yearplan->welfare_value); ?></td>
                                            <td><?php htmlout(''); ?></td>
                                            <td><?php htmlout(''); ?></td>
                                            <td><?php htmlout($yearplan->status); ?></td>
                                            <td>
                                                <form action="" method="post">
                                                    <div>
                                                        <input type="hidden" name="sno" value="<?php htmlout($yearplan->plan_id); ?>"/>
                                                        <input type="submit" name="action" value="Edit"/>
                                                        <input type="submit" name="action" value="Delete"/>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $xy++; endforeach; ?>
                                        
                                    </tbody>
                                </table>
                                <?php endif; ?>
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