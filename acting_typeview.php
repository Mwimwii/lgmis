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
$acting_type_view = new acting_type_view();

// Run the page
$acting_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acting_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acting_type_view->isExport()) { ?>
<script>
var facting_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	facting_typeview = currentForm = new ew.Form("facting_typeview", "view");
	loadjs.done("facting_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$acting_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $acting_type_view->ExportOptions->render("body") ?>
<?php $acting_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $acting_type_view->showPageHeader(); ?>
<?php
$acting_type_view->showMessage();
?>
<?php if (!$acting_type_view->IsModal) { ?>
<?php if (!$acting_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acting_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="facting_typeview" id="facting_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acting_type">
<input type="hidden" name="modal" value="<?php echo (int)$acting_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($acting_type_view->ActingType->Visible) { // ActingType ?>
	<tr id="r_ActingType">
		<td class="<?php echo $acting_type_view->TableLeftColumnClass ?>"><span id="elh_acting_type_ActingType"><?php echo $acting_type_view->ActingType->caption() ?></span></td>
		<td data-name="ActingType" <?php echo $acting_type_view->ActingType->cellAttributes() ?>>
<span id="el_acting_type_ActingType">
<span<?php echo $acting_type_view->ActingType->viewAttributes() ?>><?php echo $acting_type_view->ActingType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($acting_type_view->ActingTypeDesc->Visible) { // ActingTypeDesc ?>
	<tr id="r_ActingTypeDesc">
		<td class="<?php echo $acting_type_view->TableLeftColumnClass ?>"><span id="elh_acting_type_ActingTypeDesc"><?php echo $acting_type_view->ActingTypeDesc->caption() ?></span></td>
		<td data-name="ActingTypeDesc" <?php echo $acting_type_view->ActingTypeDesc->cellAttributes() ?>>
<span id="el_acting_type_ActingTypeDesc">
<span<?php echo $acting_type_view->ActingTypeDesc->viewAttributes() ?>><?php echo $acting_type_view->ActingTypeDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$acting_type_view->IsModal) { ?>
<?php if (!$acting_type_view->isExport()) { ?>
<?php echo $acting_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$acting_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acting_type_view->isExport()) { ?>
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
$acting_type_view->terminate();
?>