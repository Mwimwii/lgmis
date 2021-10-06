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
$payslips = new payslips();

// Run the page
$payslips->run();

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
				<h3 class="mb-0">Generate Payslips</h3>
			</div>
			<div class="card-body">
				<form class="form" role="form" action="ntc/payslip/generate/PayslipMain.php" autocomplete="off" id="loginForm" novalidate="" method="POST" target="_blank">
					<div class="form-group row">
						<div class="col-lg-12">
							<label>Employee Name</label>
							<select name="EmployeeID" class="form-control" required style="width: 56% !important">
			  				<option value='%' selected>-----------------------------ALL-----------------------</option>
		   	  				<?php
  
			  				$sql="select EmployeeID,CONCAT( CONCAT(UCASE(MID(FirstName,1,1)),LCASE(MID(FirstName,2))),' ',COALESCE(CONCAT(UCASE(MID(MiddleName,1,1)),LCASE(MID(MiddleName,2))),''),' ', CONCAT(UCASE(MID(Surname,1,1)),LCASE(MID(Surname,2))) ) AS FullName from staff";
		  
			  				$rows = ExecuteRows($sql);
			  				foreach ($rows as $row){
				
			  				?>
			  				<option value="<?php echo $row['EmployeeID']; ?>"> <?php echo $row['FullName']; ?> </option>
							<?php
			  				}
			  				?>	  
	  		 				</select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-lg-9">
							<label>Payroll Period</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<select name="PayrollPeriod" class="form-control" required style="width: 75% !important">
							<?php
					
							$sql='select h.PeriodCode, concat((case 
							when h.RunMonth = "1" then "Jan" 
							when h.RunMonth = "2" then "Feb" 
							when h.RunMonth = "3" then "Mar"
							when h.RunMonth = "4" then "Apr"
							when h.RunMonth = "5" then "May"
							when h.RunMonth = "6" then "Jun"
							when h.RunMonth = "7" then "Jul"
							when h.RunMonth = "8" then "Aug"
							when h.RunMonth = "9" then "Sept"
							when h.RunMonth = "10" then "Oct"
							when h.RunMonth = "11" then "Nov"
							when h.RunMonth = "12" then "Dec" 
							 end)," ",h.FiscalYear) as PayMonth
							 from payroll_period as h
							  order by h.PeriodCode desc';
									  
							$rows = ExecuteRows($sql);
							foreach ($rows as $row){
								
							?>
							<option value="<?php echo $row['PeriodCode']; ?>"> <?php echo $row['PayMonth']; ?> </option>
							<?php
							  }
							?>
							</select>
						</div>
					</div>
			  
					<input type="submit" name="submit" value="Generate" class="btn btn-success btn-lg float-right">
				</form>
			</div>
			<!--/card-body-->
		</div>
		<!-- /form card login -->
	</div>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$payslips->terminate();
?>