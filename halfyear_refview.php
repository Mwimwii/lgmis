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
$halfyear_ref_view = new halfyear_ref_view();

// Run the page
$halfyear_ref_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$halfyear_ref_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$halfyear_ref_view->isExport()) { ?>
<script>
var fhalfyear_refview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fhalfyear_refview = currentForm = new ew.Form("fhalfyear_refview", "view");
	loadjs.done("fhalfyear_refview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$halfyear_ref_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $halfyear_ref_view->ExportOptions->render("body") ?>
<?php $halfyear_ref_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $halfyear_ref_view->showPageHeader(); ?>
<?php
$halfyear_ref_view->showMessage();
?>
<?php if (!$halfyear_ref_view->IsModal) { ?>
<?php if (!$halfyear_ref_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $halfyear_ref_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fhalfyear_refview" id="fhalfyear_refview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="halfyear_ref">
<input type="hidden" name="modal" value="<?php echo (int)$halfyear_ref_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($halfyear_ref_view->HalfYear->Visible) { // HalfYear ?>
	<tr id="r_HalfYear">
		<td class="<?php echo $halfyear_ref_view->TableLeftColumnClass ?>"><span id="elh_halfyear_ref_HalfYear"><?php echo $halfyear_ref_view->HalfYear->caption() ?></span></td>
		<td data-name="HalfYear" <?php echo $halfyear_ref_view->HalfYear->cellAttributes() ?>>
<span id="el_halfyear_ref_HalfYear">
<span<?php echo $halfyear_ref_view->HalfYear->viewAttributes() ?>><?php echo $halfyear_ref_view->HalfYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($halfyear_ref_view->BillYear->Visible) { // BillYear ?>
	<tr id="r_BillYear">
		<td class="<?php echo $halfyear_ref_view->TableLeftColumnClass ?>"><span id="elh_halfyear_ref_BillYear"><?php echo $halfyear_ref_view->BillYear->caption() ?></span></td>
		<td data-name="BillYear" <?php echo $halfyear_ref_view->BillYear->cellAttributes() ?>>
<span id="el_halfyear_ref_BillYear">
<span<?php echo $halfyear_ref_view->BillYear->viewAttributes() ?>><?php echo $halfyear_ref_view->BillYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($halfyear_ref_view->PropertyGroup->Visible) { // PropertyGroup ?>
	<tr id="r_PropertyGroup">
		<td class="<?php echo $halfyear_ref_view->TableLeftColumnClass ?>"><span id="elh_halfyear_ref_PropertyGroup"><?php echo $halfyear_ref_view->PropertyGroup->caption() ?></span></td>
		<td data-name="PropertyGroup" <?php echo $halfyear_ref_view->PropertyGroup->cellAttributes() ?>>
<span id="el_halfyear_ref_PropertyGroup">
<span<?php echo $halfyear_ref_view->PropertyGroup->viewAttributes() ?>><?php echo $halfyear_ref_view->PropertyGroup->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($halfyear_ref_view->StartDate->Visible) { // StartDate ?>
	<tr id="r_StartDate">
		<td class="<?php echo $halfyear_ref_view->TableLeftColumnClass ?>"><span id="elh_halfyear_ref_StartDate"><?php echo $halfyear_ref_view->StartDate->caption() ?></span></td>
		<td data-name="StartDate" <?php echo $halfyear_ref_view->StartDate->cellAttributes() ?>>
<span id="el_halfyear_ref_StartDate">
<span<?php echo $halfyear_ref_view->StartDate->viewAttributes() ?>><?php echo $halfyear_ref_view->StartDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($halfyear_ref_view->Enddate->Visible) { // Enddate ?>
	<tr id="r_Enddate">
		<td class="<?php echo $halfyear_ref_view->TableLeftColumnClass ?>"><span id="elh_halfyear_ref_Enddate"><?php echo $halfyear_ref_view->Enddate->caption() ?></span></td>
		<td data-name="Enddate" <?php echo $halfyear_ref_view->Enddate->cellAttributes() ?>>
<span id="el_halfyear_ref_Enddate">
<span<?php echo $halfyear_ref_view->Enddate->viewAttributes() ?>><?php echo $halfyear_ref_view->Enddate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($halfyear_ref_view->ID->Visible) { // ID ?>
	<tr id="r_ID">
		<td class="<?php echo $halfyear_ref_view->TableLeftColumnClass ?>"><span id="elh_halfyear_ref_ID"><?php echo $halfyear_ref_view->ID->caption() ?></span></td>
		<td data-name="ID" <?php echo $halfyear_ref_view->ID->cellAttributes() ?>>
<span id="el_halfyear_ref_ID">
<span<?php echo $halfyear_ref_view->ID->viewAttributes() ?>><?php echo $halfyear_ref_view->ID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$halfyear_ref_view->IsModal) { ?>
<?php if (!$halfyear_ref_view->isExport()) { ?>
<?php echo $halfyear_ref_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$halfyear_ref_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$halfyear_ref_view->isExport()) { ?>
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
$halfyear_ref_view->terminate();
?>