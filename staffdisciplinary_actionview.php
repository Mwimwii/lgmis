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
$staffdisciplinary_action_view = new staffdisciplinary_action_view();

// Run the page
$staffdisciplinary_action_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_action_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffdisciplinary_action_view->isExport()) { ?>
<script>
var fstaffdisciplinary_actionview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fstaffdisciplinary_actionview = currentForm = new ew.Form("fstaffdisciplinary_actionview", "view");
	loadjs.done("fstaffdisciplinary_actionview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$staffdisciplinary_action_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $staffdisciplinary_action_view->ExportOptions->render("body") ?>
<?php $staffdisciplinary_action_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $staffdisciplinary_action_view->showPageHeader(); ?>
<?php
$staffdisciplinary_action_view->showMessage();
?>
<?php if (!$staffdisciplinary_action_view->IsModal) { ?>
<?php if (!$staffdisciplinary_action_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffdisciplinary_action_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fstaffdisciplinary_actionview" id="fstaffdisciplinary_actionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_action">
<input type="hidden" name="modal" value="<?php echo (int)$staffdisciplinary_action_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($staffdisciplinary_action_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $staffdisciplinary_action_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_action_EmployeeID"><?php echo $staffdisciplinary_action_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $staffdisciplinary_action_view->EmployeeID->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_EmployeeID">
<span<?php echo $staffdisciplinary_action_view->EmployeeID->viewAttributes() ?>><?php echo $staffdisciplinary_action_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_action_view->CaseNo->Visible) { // CaseNo ?>
	<tr id="r_CaseNo">
		<td class="<?php echo $staffdisciplinary_action_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_action_CaseNo"><?php echo $staffdisciplinary_action_view->CaseNo->caption() ?></span></td>
		<td data-name="CaseNo" <?php echo $staffdisciplinary_action_view->CaseNo->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_CaseNo">
<span<?php echo $staffdisciplinary_action_view->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_action_view->CaseNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_action_view->OffenseCode->Visible) { // OffenseCode ?>
	<tr id="r_OffenseCode">
		<td class="<?php echo $staffdisciplinary_action_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_action_OffenseCode"><?php echo $staffdisciplinary_action_view->OffenseCode->caption() ?></span></td>
		<td data-name="OffenseCode" <?php echo $staffdisciplinary_action_view->OffenseCode->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_OffenseCode">
<span<?php echo $staffdisciplinary_action_view->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_action_view->OffenseCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_action_view->ActionTaken->Visible) { // ActionTaken ?>
	<tr id="r_ActionTaken">
		<td class="<?php echo $staffdisciplinary_action_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_action_ActionTaken"><?php echo $staffdisciplinary_action_view->ActionTaken->caption() ?></span></td>
		<td data-name="ActionTaken" <?php echo $staffdisciplinary_action_view->ActionTaken->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_ActionTaken">
<span<?php echo $staffdisciplinary_action_view->ActionTaken->viewAttributes() ?>><?php echo $staffdisciplinary_action_view->ActionTaken->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_action_view->ActionDescription->Visible) { // ActionDescription ?>
	<tr id="r_ActionDescription">
		<td class="<?php echo $staffdisciplinary_action_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_action_ActionDescription"><?php echo $staffdisciplinary_action_view->ActionDescription->caption() ?></span></td>
		<td data-name="ActionDescription" <?php echo $staffdisciplinary_action_view->ActionDescription->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_ActionDescription">
<span<?php echo $staffdisciplinary_action_view->ActionDescription->viewAttributes() ?>><?php echo $staffdisciplinary_action_view->ActionDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_action_view->ActionDate->Visible) { // ActionDate ?>
	<tr id="r_ActionDate">
		<td class="<?php echo $staffdisciplinary_action_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_action_ActionDate"><?php echo $staffdisciplinary_action_view->ActionDate->caption() ?></span></td>
		<td data-name="ActionDate" <?php echo $staffdisciplinary_action_view->ActionDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_ActionDate">
<span<?php echo $staffdisciplinary_action_view->ActionDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_view->ActionDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_action_view->FromDate->Visible) { // FromDate ?>
	<tr id="r_FromDate">
		<td class="<?php echo $staffdisciplinary_action_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_action_FromDate"><?php echo $staffdisciplinary_action_view->FromDate->caption() ?></span></td>
		<td data-name="FromDate" <?php echo $staffdisciplinary_action_view->FromDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_FromDate">
<span<?php echo $staffdisciplinary_action_view->FromDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_view->FromDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_action_view->ToDate->Visible) { // ToDate ?>
	<tr id="r_ToDate">
		<td class="<?php echo $staffdisciplinary_action_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_action_ToDate"><?php echo $staffdisciplinary_action_view->ToDate->caption() ?></span></td>
		<td data-name="ToDate" <?php echo $staffdisciplinary_action_view->ToDate->cellAttributes() ?>>
<span id="el_staffdisciplinary_action_ToDate">
<span<?php echo $staffdisciplinary_action_view->ToDate->viewAttributes() ?>><?php echo $staffdisciplinary_action_view->ToDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$staffdisciplinary_action_view->IsModal) { ?>
<?php if (!$staffdisciplinary_action_view->isExport()) { ?>
<?php echo $staffdisciplinary_action_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$staffdisciplinary_action_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffdisciplinary_action_view->isExport()) { ?>
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
$staffdisciplinary_action_view->terminate();
?>