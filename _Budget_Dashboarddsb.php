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
$_Budget_Dashboard_dashboard = new _Budget_Dashboard_dashboard();

// Run the page
$_Budget_Dashboard_dashboard->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_Budget_Dashboard_dashboard->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdashboard, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "dashboard";
	fdashboard = currentForm = new ew.Form("fdashboard", "dashboard");
	loadjs.done("fdashboard");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<!-- Content Container -->
<div id="ew-report" class="ew-report">
<div class="btn-toolbar ew-toolbar"></div>
<?php $_Budget_Dashboard_dashboard->showPageHeader(); ?>
<?php
$_Budget_Dashboard_dashboard->showMessage();
?>
<!-- Dashboard Container -->
<div id="ew-dashboard" class="container-fluid ew-dashboard ew-vertical">
<div class="row">
<div class="<?php echo $_Budget_Dashboard_dashboard->ItemClassNames[0] ?>">
<div id="Item1" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->tablePhrase("Budget_Allocation_By_Programme", "TblCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php include_once "Budget_Allocation_By_Programmectb.php"; ?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="<?php echo $_Budget_Dashboard_dashboard->ItemClassNames[1] ?>">
<div id="Item2" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->chartPhrase("Budget_Allocation_By_Programme", "Budget_By_Programme", "ChartCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$Budget_Allocation_By_Programme->Budget_By_Programme->Width = 0;
$Budget_Allocation_By_Programme->Budget_By_Programme->Height = 0;
$Budget_Allocation_By_Programme->loadColumnValues($Budget_Allocation_By_Programme->CurrentFilter);
$Budget_Allocation_By_Programme->Budget_By_Programme->setParameter("clickurl", "Budget_Allocation_By_Programmectb.php"); // Add click URL
$Budget_Allocation_By_Programme->Budget_By_Programme->DrillDownUrl = ""; // No drill down for dashboard
$Budget_Allocation_By_Programme->Budget_By_Programme->render("ew-chart-top");
?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="<?php echo $_Budget_Dashboard_dashboard->ItemClassNames[2] ?>">
<div id="Item3" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->tablePhrase("Budget_Allocation_by_Economic_Classification_Summary", "TblCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php include_once "Budget_Allocation_by_Economic_Classification_Summaryctb.php"; ?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="<?php echo $_Budget_Dashboard_dashboard->ItemClassNames[3] ?>">
<div id="Item4" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->chartPhrase("Budget_Allocation_by_Economic_Classification_Summary", "Budget_Allocation_By_Economic_Allocation", "ChartCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php
$Budget_Allocation_by_Economic_Classification_Summary->Budget_Allocation_By_Economic_Allocation->Width = 0;
$Budget_Allocation_by_Economic_Classification_Summary->Budget_Allocation_By_Economic_Allocation->Height = 0;
$Budget_Allocation_by_Economic_Classification_Summary->loadColumnValues($Budget_Allocation_by_Economic_Classification_Summary->CurrentFilter);
$Budget_Allocation_by_Economic_Classification_Summary->Budget_Allocation_By_Economic_Allocation->setParameter("clickurl", "Budget_Allocation_by_Economic_Classification_Summaryctb.php"); // Add click URL
$Budget_Allocation_by_Economic_Classification_Summary->Budget_Allocation_By_Economic_Allocation->DrillDownUrl = ""; // No drill down for dashboard
$Budget_Allocation_by_Economic_Classification_Summary->Budget_Allocation_By_Economic_Allocation->render("ew-chart-top");
?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="<?php echo $_Budget_Dashboard_dashboard->ItemClassNames[4] ?>">
<div id="Item5" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->tablePhrase("Program_Budget_By_Economic_Classification", "TblCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php include_once "Program_Budget_By_Economic_Classificationctb.php"; ?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="<?php echo $_Budget_Dashboard_dashboard->ItemClassNames[5] ?>">
<div id="Item6" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->tablePhrase("Program_Outputs", "TblCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php include_once "Program_Outputsctb.php"; ?>
</div>
</div>
</div>
</div>
<div class="row">
<div class="<?php echo $_Budget_Dashboard_dashboard->ItemClassNames[6] ?>">
<div id="Item7" class="card">
<div class="card-header">
	<h3 class="card-title"><?php echo $Language->tablePhrase("Program_Budget_Allocation", "TblCaption") ?></h3>
	<div class="card-tools"><button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button></div>
</div>
<div class="card-body">
<?php include_once "Program_Budget_Allocationsmry.php"; ?>
</div>
</div>
</div>
</div>
</div>
<!-- /.ew-dashboard -->
</div>
<!-- /.ew-report -->
<?php
$_Budget_Dashboard_dashboard->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$_Budget_Dashboard_dashboard->terminate();
?>