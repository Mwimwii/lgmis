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
$ward_view = new ward_view();

// Run the page
$ward_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ward_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ward_view->isExport()) { ?>
<script>
var fwardview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fwardview = currentForm = new ew.Form("fwardview", "view");
	loadjs.done("fwardview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ward_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ward_view->ExportOptions->render("body") ?>
<?php $ward_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ward_view->showPageHeader(); ?>
<?php
$ward_view->showMessage();
?>
<?php if (!$ward_view->IsModal) { ?>
<?php if (!$ward_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ward_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fwardview" id="fwardview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ward">
<input type="hidden" name="modal" value="<?php echo (int)$ward_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ward_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $ward_view->TableLeftColumnClass ?>"><span id="elh_ward_LACode"><?php echo $ward_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $ward_view->LACode->cellAttributes() ?>>
<span id="el_ward_LACode">
<span<?php echo $ward_view->LACode->viewAttributes() ?>><?php echo $ward_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ward_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $ward_view->TableLeftColumnClass ?>"><span id="elh_ward_ProvinceCode"><?php echo $ward_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $ward_view->ProvinceCode->cellAttributes() ?>>
<span id="el_ward_ProvinceCode">
<span<?php echo $ward_view->ProvinceCode->viewAttributes() ?>><?php echo $ward_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ward_view->WardCode->Visible) { // WardCode ?>
	<tr id="r_WardCode">
		<td class="<?php echo $ward_view->TableLeftColumnClass ?>"><span id="elh_ward_WardCode"><?php echo $ward_view->WardCode->caption() ?></span></td>
		<td data-name="WardCode" <?php echo $ward_view->WardCode->cellAttributes() ?>>
<span id="el_ward_WardCode">
<span<?php echo $ward_view->WardCode->viewAttributes() ?>><?php echo $ward_view->WardCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ward_view->WardName->Visible) { // WardName ?>
	<tr id="r_WardName">
		<td class="<?php echo $ward_view->TableLeftColumnClass ?>"><span id="elh_ward_WardName"><?php echo $ward_view->WardName->caption() ?></span></td>
		<td data-name="WardName" <?php echo $ward_view->WardName->cellAttributes() ?>>
<span id="el_ward_WardName">
<span<?php echo $ward_view->WardName->viewAttributes() ?>><?php echo $ward_view->WardName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ward_view->Population->Visible) { // Population ?>
	<tr id="r_Population">
		<td class="<?php echo $ward_view->TableLeftColumnClass ?>"><span id="elh_ward_Population"><?php echo $ward_view->Population->caption() ?></span></td>
		<td data-name="Population" <?php echo $ward_view->Population->cellAttributes() ?>>
<span id="el_ward_Population">
<span<?php echo $ward_view->Population->viewAttributes() ?>><?php echo $ward_view->Population->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ward_view->Areas->Visible) { // Areas ?>
	<tr id="r_Areas">
		<td class="<?php echo $ward_view->TableLeftColumnClass ?>"><span id="elh_ward_Areas"><?php echo $ward_view->Areas->caption() ?></span></td>
		<td data-name="Areas" <?php echo $ward_view->Areas->cellAttributes() ?>>
<span id="el_ward_Areas">
<span<?php echo $ward_view->Areas->viewAttributes() ?>><?php echo $ward_view->Areas->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ward_view->IsModal) { ?>
<?php if (!$ward_view->isExport()) { ?>
<?php echo $ward_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$ward_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ward_view->isExport()) { ?>
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
$ward_view->terminate();
?>