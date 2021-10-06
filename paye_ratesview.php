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
$paye_rates_view = new paye_rates_view();

// Run the page
$paye_rates_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paye_rates_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$paye_rates_view->isExport()) { ?>
<script>
var fpaye_ratesview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpaye_ratesview = currentForm = new ew.Form("fpaye_ratesview", "view");
	loadjs.done("fpaye_ratesview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$paye_rates_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $paye_rates_view->ExportOptions->render("body") ?>
<?php $paye_rates_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $paye_rates_view->showPageHeader(); ?>
<?php
$paye_rates_view->showMessage();
?>
<?php if (!$paye_rates_view->IsModal) { ?>
<?php if (!$paye_rates_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_rates_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fpaye_ratesview" id="fpaye_ratesview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paye_rates">
<input type="hidden" name="modal" value="<?php echo (int)$paye_rates_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($paye_rates_view->band->Visible) { // band ?>
	<tr id="r_band">
		<td class="<?php echo $paye_rates_view->TableLeftColumnClass ?>"><span id="elh_paye_rates_band"><?php echo $paye_rates_view->band->caption() ?></span></td>
		<td data-name="band" <?php echo $paye_rates_view->band->cellAttributes() ?>>
<span id="el_paye_rates_band">
<span<?php echo $paye_rates_view->band->viewAttributes() ?>><?php echo $paye_rates_view->band->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($paye_rates_view->MinimumIncome->Visible) { // MinimumIncome ?>
	<tr id="r_MinimumIncome">
		<td class="<?php echo $paye_rates_view->TableLeftColumnClass ?>"><span id="elh_paye_rates_MinimumIncome"><?php echo $paye_rates_view->MinimumIncome->caption() ?></span></td>
		<td data-name="MinimumIncome" <?php echo $paye_rates_view->MinimumIncome->cellAttributes() ?>>
<span id="el_paye_rates_MinimumIncome">
<span<?php echo $paye_rates_view->MinimumIncome->viewAttributes() ?>><?php echo $paye_rates_view->MinimumIncome->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($paye_rates_view->MaximumIncome->Visible) { // MaximumIncome ?>
	<tr id="r_MaximumIncome">
		<td class="<?php echo $paye_rates_view->TableLeftColumnClass ?>"><span id="elh_paye_rates_MaximumIncome"><?php echo $paye_rates_view->MaximumIncome->caption() ?></span></td>
		<td data-name="MaximumIncome" <?php echo $paye_rates_view->MaximumIncome->cellAttributes() ?>>
<span id="el_paye_rates_MaximumIncome">
<span<?php echo $paye_rates_view->MaximumIncome->viewAttributes() ?>><?php echo $paye_rates_view->MaximumIncome->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($paye_rates_view->PAYERate->Visible) { // PAYERate ?>
	<tr id="r_PAYERate">
		<td class="<?php echo $paye_rates_view->TableLeftColumnClass ?>"><span id="elh_paye_rates_PAYERate"><?php echo $paye_rates_view->PAYERate->caption() ?></span></td>
		<td data-name="PAYERate" <?php echo $paye_rates_view->PAYERate->cellAttributes() ?>>
<span id="el_paye_rates_PAYERate">
<span<?php echo $paye_rates_view->PAYERate->viewAttributes() ?>><?php echo $paye_rates_view->PAYERate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$paye_rates_view->IsModal) { ?>
<?php if (!$paye_rates_view->isExport()) { ?>
<?php echo $paye_rates_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$paye_rates_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$paye_rates_view->isExport()) { ?>
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
$paye_rates_view->terminate();
?>