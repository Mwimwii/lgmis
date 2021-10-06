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
$staffdisciplinary_appeal_view = new staffdisciplinary_appeal_view();

// Run the page
$staffdisciplinary_appeal_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffdisciplinary_appeal_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffdisciplinary_appeal_view->isExport()) { ?>
<script>
var fstaffdisciplinary_appealview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fstaffdisciplinary_appealview = currentForm = new ew.Form("fstaffdisciplinary_appealview", "view");
	loadjs.done("fstaffdisciplinary_appealview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$staffdisciplinary_appeal_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $staffdisciplinary_appeal_view->ExportOptions->render("body") ?>
<?php $staffdisciplinary_appeal_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $staffdisciplinary_appeal_view->showPageHeader(); ?>
<?php
$staffdisciplinary_appeal_view->showMessage();
?>
<?php if (!$staffdisciplinary_appeal_view->IsModal) { ?>
<?php if (!$staffdisciplinary_appeal_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffdisciplinary_appeal_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fstaffdisciplinary_appealview" id="fstaffdisciplinary_appealview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffdisciplinary_appeal">
<input type="hidden" name="modal" value="<?php echo (int)$staffdisciplinary_appeal_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($staffdisciplinary_appeal_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $staffdisciplinary_appeal_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_appeal_EmployeeID"><?php echo $staffdisciplinary_appeal_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $staffdisciplinary_appeal_view->EmployeeID->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_EmployeeID">
<span<?php echo $staffdisciplinary_appeal_view->EmployeeID->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_appeal_view->CaseNo->Visible) { // CaseNo ?>
	<tr id="r_CaseNo">
		<td class="<?php echo $staffdisciplinary_appeal_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_appeal_CaseNo"><?php echo $staffdisciplinary_appeal_view->CaseNo->caption() ?></span></td>
		<td data-name="CaseNo" <?php echo $staffdisciplinary_appeal_view->CaseNo->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_CaseNo">
<span<?php echo $staffdisciplinary_appeal_view->CaseNo->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_view->CaseNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_appeal_view->OffenseCode->Visible) { // OffenseCode ?>
	<tr id="r_OffenseCode">
		<td class="<?php echo $staffdisciplinary_appeal_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_appeal_OffenseCode"><?php echo $staffdisciplinary_appeal_view->OffenseCode->caption() ?></span></td>
		<td data-name="OffenseCode" <?php echo $staffdisciplinary_appeal_view->OffenseCode->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_OffenseCode">
<span<?php echo $staffdisciplinary_appeal_view->OffenseCode->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_view->OffenseCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_appeal_view->AppealNo->Visible) { // AppealNo ?>
	<tr id="r_AppealNo">
		<td class="<?php echo $staffdisciplinary_appeal_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_appeal_AppealNo"><?php echo $staffdisciplinary_appeal_view->AppealNo->caption() ?></span></td>
		<td data-name="AppealNo" <?php echo $staffdisciplinary_appeal_view->AppealNo->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_AppealNo">
<span<?php echo $staffdisciplinary_appeal_view->AppealNo->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_view->AppealNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_appeal_view->DateOfAppealLetter->Visible) { // DateOfAppealLetter ?>
	<tr id="r_DateOfAppealLetter">
		<td class="<?php echo $staffdisciplinary_appeal_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_appeal_DateOfAppealLetter"><?php echo $staffdisciplinary_appeal_view->DateOfAppealLetter->caption() ?></span></td>
		<td data-name="DateOfAppealLetter" <?php echo $staffdisciplinary_appeal_view->DateOfAppealLetter->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_DateOfAppealLetter">
<span<?php echo $staffdisciplinary_appeal_view->DateOfAppealLetter->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_view->DateOfAppealLetter->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_appeal_view->DateAppealReceived->Visible) { // DateAppealReceived ?>
	<tr id="r_DateAppealReceived">
		<td class="<?php echo $staffdisciplinary_appeal_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_appeal_DateAppealReceived"><?php echo $staffdisciplinary_appeal_view->DateAppealReceived->caption() ?></span></td>
		<td data-name="DateAppealReceived" <?php echo $staffdisciplinary_appeal_view->DateAppealReceived->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_DateAppealReceived">
<span<?php echo $staffdisciplinary_appeal_view->DateAppealReceived->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_view->DateAppealReceived->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_appeal_view->DateConcluded->Visible) { // DateConcluded ?>
	<tr id="r_DateConcluded">
		<td class="<?php echo $staffdisciplinary_appeal_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_appeal_DateConcluded"><?php echo $staffdisciplinary_appeal_view->DateConcluded->caption() ?></span></td>
		<td data-name="DateConcluded" <?php echo $staffdisciplinary_appeal_view->DateConcluded->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_DateConcluded">
<span<?php echo $staffdisciplinary_appeal_view->DateConcluded->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_view->DateConcluded->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_appeal_view->AppealStatus->Visible) { // AppealStatus ?>
	<tr id="r_AppealStatus">
		<td class="<?php echo $staffdisciplinary_appeal_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_appeal_AppealStatus"><?php echo $staffdisciplinary_appeal_view->AppealStatus->caption() ?></span></td>
		<td data-name="AppealStatus" <?php echo $staffdisciplinary_appeal_view->AppealStatus->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_AppealStatus">
<span<?php echo $staffdisciplinary_appeal_view->AppealStatus->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_view->AppealStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_appeal_view->LastUpdate->Visible) { // LastUpdate ?>
	<tr id="r_LastUpdate">
		<td class="<?php echo $staffdisciplinary_appeal_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_appeal_LastUpdate"><?php echo $staffdisciplinary_appeal_view->LastUpdate->caption() ?></span></td>
		<td data-name="LastUpdate" <?php echo $staffdisciplinary_appeal_view->LastUpdate->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_LastUpdate">
<span<?php echo $staffdisciplinary_appeal_view->LastUpdate->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_view->LastUpdate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffdisciplinary_appeal_view->AppealNotes->Visible) { // AppealNotes ?>
	<tr id="r_AppealNotes">
		<td class="<?php echo $staffdisciplinary_appeal_view->TableLeftColumnClass ?>"><span id="elh_staffdisciplinary_appeal_AppealNotes"><?php echo $staffdisciplinary_appeal_view->AppealNotes->caption() ?></span></td>
		<td data-name="AppealNotes" <?php echo $staffdisciplinary_appeal_view->AppealNotes->cellAttributes() ?>>
<span id="el_staffdisciplinary_appeal_AppealNotes">
<span<?php echo $staffdisciplinary_appeal_view->AppealNotes->viewAttributes() ?>><?php echo $staffdisciplinary_appeal_view->AppealNotes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$staffdisciplinary_appeal_view->IsModal) { ?>
<?php if (!$staffdisciplinary_appeal_view->isExport()) { ?>
<?php echo $staffdisciplinary_appeal_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$staffdisciplinary_appeal_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffdisciplinary_appeal_view->isExport()) { ?>
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
$staffdisciplinary_appeal_view->terminate();
?>