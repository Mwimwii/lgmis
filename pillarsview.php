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
$pillars_view = new pillars_view();

// Run the page
$pillars_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pillars_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pillars_view->isExport()) { ?>
<script>
var fpillarsview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpillarsview = currentForm = new ew.Form("fpillarsview", "view");
	loadjs.done("fpillarsview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$pillars_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $pillars_view->ExportOptions->render("body") ?>
<?php $pillars_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pillars_view->showPageHeader(); ?>
<?php
$pillars_view->showMessage();
?>
<?php if (!$pillars_view->IsModal) { ?>
<?php if (!$pillars_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pillars_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpillarsview" id="fpillarsview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pillars">
<input type="hidden" name="modal" value="<?php echo (int)$pillars_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($pillars_view->NDP->Visible) { // NDP ?>
	<tr id="r_NDP">
		<td class="<?php echo $pillars_view->TableLeftColumnClass ?>"><span id="elh_pillars_NDP"><?php echo $pillars_view->NDP->caption() ?></span></td>
		<td data-name="NDP" <?php echo $pillars_view->NDP->cellAttributes() ?>>
<span id="el_pillars_NDP">
<span<?php echo $pillars_view->NDP->viewAttributes() ?>><?php echo $pillars_view->NDP->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pillars_view->PillarNo->Visible) { // PillarNo ?>
	<tr id="r_PillarNo">
		<td class="<?php echo $pillars_view->TableLeftColumnClass ?>"><span id="elh_pillars_PillarNo"><?php echo $pillars_view->PillarNo->caption() ?></span></td>
		<td data-name="PillarNo" <?php echo $pillars_view->PillarNo->cellAttributes() ?>>
<span id="el_pillars_PillarNo">
<span<?php echo $pillars_view->PillarNo->viewAttributes() ?>><?php echo $pillars_view->PillarNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pillars_view->PillarName->Visible) { // PillarName ?>
	<tr id="r_PillarName">
		<td class="<?php echo $pillars_view->TableLeftColumnClass ?>"><span id="elh_pillars_PillarName"><?php echo $pillars_view->PillarName->caption() ?></span></td>
		<td data-name="PillarName" <?php echo $pillars_view->PillarName->cellAttributes() ?>>
<span id="el_pillars_PillarName">
<span<?php echo $pillars_view->PillarName->viewAttributes() ?>><?php echo $pillars_view->PillarName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pillars_view->PillarObjective->Visible) { // PillarObjective ?>
	<tr id="r_PillarObjective">
		<td class="<?php echo $pillars_view->TableLeftColumnClass ?>"><span id="elh_pillars_PillarObjective"><?php echo $pillars_view->PillarObjective->caption() ?></span></td>
		<td data-name="PillarObjective" <?php echo $pillars_view->PillarObjective->cellAttributes() ?>>
<span id="el_pillars_PillarObjective">
<span<?php echo $pillars_view->PillarObjective->viewAttributes() ?>><?php echo $pillars_view->PillarObjective->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$pillars_view->IsModal) { ?>
<?php if (!$pillars_view->isExport()) { ?>
<?php echo $pillars_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$pillars_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pillars_view->isExport()) { ?>
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
$pillars_view->terminate();
?>