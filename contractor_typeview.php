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
$contractor_type_view = new contractor_type_view();

// Run the page
$contractor_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contractor_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contractor_type_view->isExport()) { ?>
<script>
var fcontractor_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcontractor_typeview = currentForm = new ew.Form("fcontractor_typeview", "view");
	loadjs.done("fcontractor_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$contractor_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $contractor_type_view->ExportOptions->render("body") ?>
<?php $contractor_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $contractor_type_view->showPageHeader(); ?>
<?php
$contractor_type_view->showMessage();
?>
<?php if (!$contractor_type_view->IsModal) { ?>
<?php if (!$contractor_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contractor_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcontractor_typeview" id="fcontractor_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contractor_type">
<input type="hidden" name="modal" value="<?php echo (int)$contractor_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($contractor_type_view->ContractorTypeCode->Visible) { // ContractorTypeCode ?>
	<tr id="r_ContractorTypeCode">
		<td class="<?php echo $contractor_type_view->TableLeftColumnClass ?>"><span id="elh_contractor_type_ContractorTypeCode"><?php echo $contractor_type_view->ContractorTypeCode->caption() ?></span></td>
		<td data-name="ContractorTypeCode" <?php echo $contractor_type_view->ContractorTypeCode->cellAttributes() ?>>
<span id="el_contractor_type_ContractorTypeCode">
<span<?php echo $contractor_type_view->ContractorTypeCode->viewAttributes() ?>><?php echo $contractor_type_view->ContractorTypeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_type_view->ContractortypeName->Visible) { // ContractortypeName ?>
	<tr id="r_ContractortypeName">
		<td class="<?php echo $contractor_type_view->TableLeftColumnClass ?>"><span id="elh_contractor_type_ContractortypeName"><?php echo $contractor_type_view->ContractortypeName->caption() ?></span></td>
		<td data-name="ContractortypeName" <?php echo $contractor_type_view->ContractortypeName->cellAttributes() ?>>
<span id="el_contractor_type_ContractortypeName">
<span<?php echo $contractor_type_view->ContractortypeName->viewAttributes() ?>><?php echo $contractor_type_view->ContractortypeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($contractor_type_view->ContractorTypeDesc->Visible) { // ContractorTypeDesc ?>
	<tr id="r_ContractorTypeDesc">
		<td class="<?php echo $contractor_type_view->TableLeftColumnClass ?>"><span id="elh_contractor_type_ContractorTypeDesc"><?php echo $contractor_type_view->ContractorTypeDesc->caption() ?></span></td>
		<td data-name="ContractorTypeDesc" <?php echo $contractor_type_view->ContractorTypeDesc->cellAttributes() ?>>
<span id="el_contractor_type_ContractorTypeDesc">
<span<?php echo $contractor_type_view->ContractorTypeDesc->viewAttributes() ?>><?php echo $contractor_type_view->ContractorTypeDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$contractor_type_view->IsModal) { ?>
<?php if (!$contractor_type_view->isExport()) { ?>
<?php echo $contractor_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$contractor_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contractor_type_view->isExport()) { ?>
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
$contractor_type_view->terminate();
?>