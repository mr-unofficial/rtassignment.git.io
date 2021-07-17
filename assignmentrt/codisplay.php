<?php session_start();?>
<?php include("header.php");?>
	
							<div class="module-body">
							
						<div class="module">
							<div class="module-head">	
								<a href="cotable.php" style="float:right;" class="btn btn-info">Add</a>
								<h2 >Companies</h2>	
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>Id</th>
											<th>Name</th>
											<th>Email</th>
											<th>Website URL</th>
											<th>Logo</th>
											<th colspan="2">Operations</th>
										</tr>
									</thead>
									<tbody>

										<?php
											$selectquery = "select * from companies";
											$query = mysqli_query($con,$selectquery);
											$id = 1;
											while($res=mysqli_fetch_array($query)){
												?>
											<tr class="odd gradeX">
												<td class="center"><?php echo $id++;?></td>
												<td class="center"> <?php echo $res['name'];?></td>
												<td class="center"> <?php echo $res['email'];?></td>
												<td class="center"> <?php echo $res['website url'];?></td>
												<td class="center"><img src="<?php echo $res['logo']; ?>" width="100" height="100"></td>
												<td class="center"><a href="coedit.php?id=<?php echo $res['id']; ?>" class="btn btn-info"><i class="fa fa-edit"></i></a></td>
												<td class="center"><a href="codelete.php?id=<?php echo $res['id']; ?>" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a></td>
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