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
$id_type_view = new id_type_view();

// Run the page
$id_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$id_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$id_type_view->isExport()) { ?>
<script>
var fid_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fid_typeview = currentForm = new ew.Form("fid_typeview", "view");
	loadjs.done("fid_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$id_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $id_type_view->ExportOptions->render("body") ?>
<?php $id_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $id_type_view->showPageHeader(); ?>
<?php
$id_type_view->showMessage();
?>
<?php if (!$id_type_view->IsModal) { ?>
<?php if (!$id_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $id_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fid_typeview" id="fid_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="id_type">
<input type="hidden" name="modal" value="<?php echo (int)$id_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($id_type_view->IDType->Visible) { // IDType ?>
	<tr id="r_IDType">
		<td class="<?php echo $id_type_view->TableLeftColumnClass ?>"><span id="elh_id_type_IDType"><?php echo $id_type_view->IDType->caption() ?></span></td>
		<td data-name="IDType" <?php echo $id_type_view->IDType->cellAttributes() ?>>
<span id="el_id_type_IDType">
<span<?php echo $id_type_view->IDType->viewAttributes() ?>><?php echo $id_type_view->IDType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($id_type_view->IDTypeName->Visible) { // IDTypeName ?>
	<tr id="r_IDTypeName">
		<td class="<?php echo $id_type_view->TableLeftColumnClass ?>"><span id="elh_id_type_IDTypeName"><?php echo $id_type_view->IDTypeName->caption() ?></span></td>
		<td data-name="IDTypeName" <?php echo $id_type_view->IDTypeName->cellAttributes() ?>>
<span id="el_id_type_IDTypeName">
<span<?php echo $id_type_view->IDTypeName->viewAttributes() ?>><?php echo $id_type_view->IDTypeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$id_type_view->IsModal) { ?>
<?php if (!$id_type_view->isExport()) { ?>
<?php echo $id_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$id_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$id_type_view->isExport()) { ?>
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
$id_type_view->terminate();
?>