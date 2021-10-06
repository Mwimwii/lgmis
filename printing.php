<?php
namespace PHPMaker2020\lgmis20;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$printing = new printing();

// Run the page
$printing->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<div class="col-md-6 offset-md-3">
		<span class="anchor" id="formLogin"></span>

		<!-- form card login with validation feedback -->
		<div class="card card-outline-secondary">
			<div class="card-header">
				<h3 class="mb-0">Process Bills</h3>
			</div>
			<div class="card-body">
				<form class="form" role="form" action="ntc/bill/reports/Reports/rptBill.php" autocomplete="off" id="loginForm" novalidate="" method="POST" target="_blank">
					<div class="form-group row">
						<div class="col-lg-9">
							<label>Location</label>
							<select name="Area" class="form-control" required style="width: 100% !important">
   							<option value='%' selected>-----------------------------ALL-----------------------</option>
   							<?php

   							$sql="select Location from property group by Location order by Location";
   							$rows = ExecuteRows($sql);
   							foreach ($rows as $row){
					
							?>
							<option value="<?php echo $row['Location']; ?>"> <?php echo $row['Location']; ?> </option>
							<?php
							}
							?>
								</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-9">
							<label for="uname1">Client</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<select name="ClientID" class="form-control" required style="width: 100% !important">
								<option value='%' selected>-----------------------------ALL-----------------------</option>
							<?php

							$sql="select ClientSerNo,ClientName from client order by ClientName";		
							$rows = ExecuteRows($sql);
							foreach ($rows as $row){
							?>
							<option value="<?php echo $row['ClientSerNo']; ?>"> <?php echo $row['ClientName']; ?> </option>
							<?php
							}
							?>
								</select>
						</div>
					</div>
			  
					<input type="submit" name="submit" value="Process" class="btn btn-success btn-lg float-right">
				</form>
			</div>
			<!--/card-body-->
		</div>
		<!-- /form card login -->
	</div>


<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$printing->terminate();
?>