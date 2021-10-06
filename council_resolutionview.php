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
$council_resolution_view = new council_resolution_view();

// Run the page
$council_resolution_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_resolution_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$council_resolution_view->isExport()) { ?>
<script>
var fcouncil_resolutionview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcouncil_resolutionview = currentForm = new ew.Form("fcouncil_resolutionview", "view");
	loadjs.done("fcouncil_resolutionview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$council_resolution_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $council_resolution_view->ExportOptions->render("body") ?>
<?php $council_resolution_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $council_resolution_view->showPageHeader(); ?>
<?php
$council_resolution_view->showMessage();
?>
<?php if (!$council_resolution_view->IsModal) { ?>
<?php if (!$council_resolution_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $council_resolution_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcouncil_resolutionview" id="fcouncil_resolutionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_resolution">
<input type="hidden" name="modal" value="<?php echo (int)$council_resolution_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($council_resolution_view->MeetingNo->Visible) { // MeetingNo ?>
	<tr id="r_MeetingNo">
		<td class="<?php echo $council_resolution_view->TableLeftColumnClass ?>"><span id="elh_council_resolution_MeetingNo"><?php echo $council_resolution_view->MeetingNo->caption() ?></span></td>
		<td data-name="MeetingNo" <?php echo $council_resolution_view->MeetingNo->cellAttributes() ?>>
<span id="el_council_resolution_MeetingNo">
<span<?php echo $council_resolution_view->MeetingNo->viewAttributes() ?>><?php echo $council_resolution_view->MeetingNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_resolution_view->MinuteNumber->Visible) { // MinuteNumber ?>
	<tr id="r_MinuteNumber">
		<td class="<?php echo $council_resolution_view->TableLeftColumnClass ?>"><span id="elh_council_resolution_MinuteNumber"><?php echo $council_resolution_view->MinuteNumber->caption() ?></span></td>
		<td data-name="MinuteNumber" <?php echo $council_resolution_view->MinuteNumber->cellAttributes() ?>>
<span id="el_council_resolution_MinuteNumber">
<span<?php echo $council_resolution_view->MinuteNumber->viewAttributes() ?>><?php echo $council_resolution_view->MinuteNumber->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_resolution_view->Subject->Visible) { // Subject ?>
	<tr id="r_Subject">
		<td class="<?php echo $council_resolution_view->TableLeftColumnClass ?>"><span id="elh_council_resolution_Subject"><?php echo $council_resolution_view->Subject->caption() ?></span></td>
		<td data-name="Subject" <?php echo $council_resolution_view->Subject->cellAttributes() ?>>
<span id="el_council_resolution_Subject">
<span<?php echo $council_resolution_view->Subject->viewAttributes() ?>><?php echo $council_resolution_view->Subject->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_resolution_view->Resolutionccategory->Visible) { // Resolutionccategory ?>
	<tr id="r_Resolutionccategory">
		<td class="<?php echo $council_resolution_view->TableLeftColumnClass ?>"><span id="elh_council_resolution_Resolutionccategory"><?php echo $council_resolution_view->Resolutionccategory->caption() ?></span></td>
		<td data-name="Resolutionccategory" <?php echo $council_resolution_view->Resolutionccategory->cellAttributes() ?>>
<span id="el_council_resolution_Resolutionccategory">
<span<?php echo $council_resolution_view->Resolutionccategory->viewAttributes() ?>><?php echo $council_resolution_view->Resolutionccategory->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_resolution_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $council_resolution_view->TableLeftColumnClass ?>"><span id="elh_council_resolution_LACode"><?php echo $council_resolution_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $council_resolution_view->LACode->cellAttributes() ?>>
<span id="el_council_resolution_LACode">
<span<?php echo $council_resolution_view->LACode->viewAttributes() ?>><?php echo $council_resolution_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_resolution_view->ResolutionNo->Visible) { // ResolutionNo ?>
	<tr id="r_ResolutionNo">
		<td class="<?php echo $council_resolution_view->TableLeftColumnClass ?>"><span id="elh_council_resolution_ResolutionNo"><?php echo $council_resolution_view->ResolutionNo->caption() ?></span></td>
		<td data-name="ResolutionNo" <?php echo $council_resolution_view->ResolutionNo->cellAttributes() ?>>
<span id="el_council_resolution_ResolutionNo">
<span<?php echo $council_resolution_view->ResolutionNo->viewAttributes() ?>><?php echo $council_resolution_view->ResolutionNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_resolution_view->Resolution->Visible) { // Resolution ?>
	<tr id="r_Resolution">
		<td class="<?php echo $council_resolution_view->TableLeftColumnClass ?>"><span id="elh_council_resolution_Resolution"><?php echo $council_resolution_view->Resolution->caption() ?></span></td>
		<td data-name="Resolution" <?php echo $council_resolution_view->Resolution->cellAttributes() ?>>
<span id="el_council_resolution_Resolution">
<span<?php echo $council_resolution_view->Resolution->viewAttributes() ?>><?php echo $council_resolution_view->Resolution->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_resolution_view->Responsibility->Visible) { // Responsibility ?>
	<tr id="r_Responsibility">
		<td class="<?php echo $council_resolution_view->TableLeftColumnClass ?>"><span id="elh_council_resolution_Responsibility"><?php echo $council_resolution_view->Responsibility->caption() ?></span></td>
		<td data-name="Responsibility" <?php echo $council_resolution_view->Responsibility->cellAttributes() ?>>
<span id="el_council_resolution_Responsibility">
<span<?php echo $council_resolution_view->Responsibility->viewAttributes() ?>><?php echo $council_resolution_view->Responsibility->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_resolution_view->ActionDate->Visible) { // ActionDate ?>
	<tr id="r_ActionDate">
		<td class="<?php echo $council_resolution_view->TableLeftColumnClass ?>"><span id="elh_council_resolution_ActionDate"><?php echo $council_resolution_view->ActionDate->caption() ?></span></td>
		<td data-name="ActionDate" <?php echo $council_resolution_view->ActionDate->cellAttributes() ?>>
<span id="el_council_resolution_ActionDate">
<span<?php echo $council_resolution_view->ActionDate->viewAttributes() ?>><?php echo $council_resolution_view->ActionDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$council_resolution_view->IsModal) { ?>
<?php if (!$council_resolution_view->isExport()) { ?>
<?php echo $council_resolution_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$council_resolution_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$council_resolution_view->isExport()) { ?>
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
$council_resolution_view->terminate();
?>