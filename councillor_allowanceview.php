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
$councillor_allowance_view = new councillor_allowance_view();

// Run the page
$councillor_allowance_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_allowance_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$councillor_allowance_view->isExport()) { ?>
<script>
var fcouncillor_allowanceview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcouncillor_allowanceview = currentForm = new ew.Form("fcouncillor_allowanceview", "view");
	loadjs.done("fcouncillor_allowanceview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$councillor_allowance_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $councillor_allowance_view->ExportOptions->render("body") ?>
<?php $councillor_allowance_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $councillor_allowance_view->showPageHeader(); ?>
<?php
$councillor_allowance_view->showMessage();
?>
<?php if (!$councillor_allowance_view->IsModal) { ?>
<?php if (!$councillor_allowance_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillor_allowance_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcouncillor_allowanceview" id="fcouncillor_allowanceview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor_allowance">
<input type="hidden" name="modal" value="<?php echo (int)$councillor_allowance_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($councillor_allowance_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $councillor_allowance_view->TableLeftColumnClass ?>"><span id="elh_councillor_allowance_EmployeeID"><?php echo $councillor_allowance_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $councillor_allowance_view->EmployeeID->cellAttributes() ?>>
<span id="el_councillor_allowance_EmployeeID">
<span<?php echo $councillor_allowance_view->EmployeeID->viewAttributes() ?>><?php echo $councillor_allowance_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_allowance_view->AllowanceCode->Visible) { // AllowanceCode ?>
	<tr id="r_AllowanceCode">
		<td class="<?php echo $councillor_allowance_view->TableLeftColumnClass ?>"><span id="elh_councillor_allowance_AllowanceCode"><?php echo $councillor_allowance_view->AllowanceCode->caption() ?></span></td>
		<td data-name="AllowanceCode" <?php echo $councillor_allowance_view->AllowanceCode->cellAttributes() ?>>
<span id="el_councillor_allowance_AllowanceCode">
<span<?php echo $councillor_allowance_view->AllowanceCode->viewAttributes() ?>><?php echo $councillor_allowance_view->AllowanceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_allowance_view->AllowanceAmount->Visible) { // AllowanceAmount ?>
	<tr id="r_AllowanceAmount">
		<td class="<?php echo $councillor_allowance_view->TableLeftColumnClass ?>"><span id="elh_councillor_allowance_AllowanceAmount"><?php echo $councillor_allowance_view->AllowanceAmount->caption() ?></span></td>
		<td data-name="AllowanceAmount" <?php echo $councillor_allowance_view->AllowanceAmount->cellAttributes() ?>>
<span id="el_councillor_allowance_AllowanceAmount">
<span<?php echo $councillor_allowance_view->AllowanceAmount->viewAttributes() ?>><?php echo $councillor_allowance_view->AllowanceAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$councillor_allowance_view->IsModal) { ?>
<?php if (!$councillor_allowance_view->isExport()) { ?>
<?php echo $councillor_allowance_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$councillor_allowance_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$councillor_allowance_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$councillor_allowance_view->terminate();
?>