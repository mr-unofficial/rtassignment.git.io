<?php session_start();?>
<?php include("header.php");?>
	
						<div class="module-body">		
						<div class="module">
							<div class="module-head">
								<a href="emadd.php" class="btn btn-info" style="float:right;">Add</a>
								<h2>Employees</h2>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>Id</th>
											<th>First Name</th>
											<th>Last Name</th>											
											<th>E-mail</th>
											<th>Phone</th>
											<th>Company</th>
											<th colspan="2">Opeartions</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$select = "select * from `employees`";
											$query = mysqli_query($con,$select);
											$id = 1;
											while($res=mysqli_fetch_array($query)){
												?>

										<tr>
											<td class="center"><?php echo $id++ ?></td>
											<td class="center"><?php echo $res['firstname'] ?></td>
											<td class="center"><?php echo $res['lastname'] ?></td>
											<td class="center"><?php echo $res['email'] ?></td>
											<td class="center"><?php echo $res['phone'] ?></td>
											<td class="center"><?php echo $res['company'] ?></td>
											<td class="center"><a href="empedit.php?id=<?php echo $res['id'] ?>" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
											<td class="center"><a href="empdelete.php?id=<?php echo $res['id'] ?>" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a></td>
										</tr>

												<?php
											}

										?>
										
									</tbody>
									<tfoot>
										<tr>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div><!--/.module-->

					<br />
						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container"> 
			<p><b class="copyright">&copy; 2014 Edmin - EGrappler.com </b> All rights reserved.</p>
		</div>
	</div>

	<script src="scripts/jquery-1.9.1.min.js"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>