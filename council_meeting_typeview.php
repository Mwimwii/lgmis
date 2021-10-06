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
$council_meeting_type_view = new council_meeting_type_view();

// Run the page
$council_meeting_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_meeting_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$council_meeting_type_view->isExport()) { ?>
<script>
var fcouncil_meeting_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcouncil_meeting_typeview = currentForm = new ew.Form("fcouncil_meeting_typeview", "view");
	loadjs.done("fcouncil_meeting_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$council_meeting_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $council_meeting_type_view->ExportOptions->render("body") ?>
<?php $council_meeting_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $council_meeting_type_view->showPageHeader(); ?>
<?php
$council_meeting_type_view->showMessage();
?>
<?php if (!$council_meeting_type_view->IsModal) { ?>
<?php if (!$council_meeting_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $council_meeting_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcouncil_meeting_typeview" id="fcouncil_meeting_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_meeting_type">
<input type="hidden" name="modal" value="<?php echo (int)$council_meeting_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($council_meeting_type_view->MeetingType->Visible) { // MeetingType ?>
	<tr id="r_MeetingType">
		<td class="<?php echo $council_meeting_type_view->TableLeftColumnClass ?>"><span id="elh_council_meeting_type_MeetingType"><?php echo $council_meeting_type_view->MeetingType->caption() ?></span></td>
		<td data-name="MeetingType" <?php echo $council_meeting_type_view->MeetingType->cellAttributes() ?>>
<span id="el_council_meeting_type_MeetingType">
<span<?php echo $council_meeting_type_view->MeetingType->viewAttributes() ?>><?php echo $council_meeting_type_view->MeetingType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($council_meeting_type_view->MeetingTypeName->Visible) { // MeetingTypeName ?>
	<tr id="r_MeetingTypeName">
		<td class="<?php echo $council_meeting_type_view->TableLeftColumnClass ?>"><span id="elh_council_meeting_type_MeetingTypeName"><?php echo $council_meeting_type_view->MeetingTypeName->caption() ?></span></td>
		<td data-name="MeetingTypeName" <?php echo $council_meeting_type_view->MeetingTypeName->cellAttributes() ?>>
<span id="el_council_meeting_type_MeetingTypeName">
<span<?php echo $council_meeting_type_view->MeetingTypeName->viewAttributes() ?>><?php echo $council_meeting_type_view->MeetingTypeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$council_meeting_type_view->IsModal) { ?>
<?php if (!$council_meeting_type_view->isExport()) { ?>
<?php echo $council_meeting_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$council_meeting_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$council_meeting_type_view->isExport()) { ?>
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
$council_meeting_type_view->terminate();
?>