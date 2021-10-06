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
$payroll_view = new payroll_view();

// Run the page
$payroll_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payroll_view->isExport()) { ?>
<script>
var fpayrollview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpayrollview = currentForm = new ew.Form("fpayrollview", "view");
	loadjs.done("fpayrollview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$payroll_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $payroll_view->ExportOptions->render("body") ?>
<?php $payroll_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $payroll_view->showPageHeader(); ?>
<?php
$payroll_view->showMessage();
?>
<?php if (!$payroll_view->IsModal) { ?>
<?php if (!$payroll_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpayrollview" id="fpayrollview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll">
<input type="hidden" name="modal" value="<?php echo (int)$payroll_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($payroll_view->PayrollCode->Visible) { // PayrollCode ?>
	<tr id="r_PayrollCode">
		<td class="<?php echo $payroll_view->TableLeftColumnClass ?>"><span id="elh_payroll_PayrollCode"><?php echo $payroll_view->PayrollCode->caption() ?></span></td>
		<td data-name="PayrollCode" <?php echo $payroll_view->PayrollCode->cellAttributes() ?>>
<span id="el_payroll_PayrollCode">
<span<?php echo $payroll_view->PayrollCode->viewAttributes() ?>><?php echo $payroll_view->PayrollCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payroll_view->PayrollName->Visible) { // PayrollName ?>
	<tr id="r_PayrollName">
		<td class="<?php echo $payroll_view->TableLeftColumnClass ?>"><span id="elh_payroll_PayrollName"><?php echo $payroll_view->PayrollName->caption() ?></span></td>
		<td data-name="PayrollName" <?php echo $payroll_view->PayrollName->cellAttributes() ?>>
<span id="el_payroll_PayrollName">
<span<?php echo $payroll_view->PayrollName->viewAttributes() ?>><?php echo $payroll_view->PayrollName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payroll_view->PayrollDescription->Visible) { // PayrollDescription ?>
	<tr id="r_PayrollDescription">
		<td class="<?php echo $payroll_view->TableLeftColumnClass ?>"><span id="elh_payroll_PayrollDescription"><?php echo $payroll_view->PayrollDescription->caption() ?></span></td>
		<td data-name="PayrollDescription" <?php echo $payroll_view->PayrollDescription->cellAttributes() ?>>
<span id="el_payroll_PayrollDescription">
<span<?php echo $payroll_view->PayrollDescription->viewAttributes() ?>><?php echo $payroll_view->PayrollDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payroll_view->Division->Visible) { // Division ?>
	<tr id="r_Division">
		<td class="<?php echo $payroll_view->TableLeftColumnClass ?>"><span id="elh_payroll_Division"><?php echo $payroll_view->Division->caption() ?></span></td>
		<td data-name="Division" <?php echo $payroll_view->Division->cellAttributes() ?>>
<span id="el_payroll_Division">
<span<?php echo $payroll_view->Division->viewAttributes() ?>><?php echo $payroll_view->Division->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($payroll_view->LAcode->Visible) { // LAcode ?>
	<tr id="r_LAcode">
		<td class="<?php echo $payroll_view->TableLeftColumnClass ?>"><span id="elh_payroll_LAcode"><?php echo $payroll_view->LAcode->caption() ?></span></td>
		<td data-name="LAcode" <?php echo $payroll_view->LAcode->cellAttributes() ?>>
<span id="el_payroll_LAcode">
<span<?php echo $payroll_view->LAcode->viewAttributes() ?>><?php echo $payroll_view->LAcode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$payroll_view->IsModal) { ?>
<?php if (!$payroll_view->isExport()) { ?>
<?php echo $payroll_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$payroll_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payroll_view->isExport()) { ?>
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
$payroll_view->terminate();
?>