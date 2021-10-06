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
$ndp_view = new ndp_view();

// Run the page
$ndp_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ndp_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ndp_view->isExport()) { ?>
<script>
var fndpview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fndpview = currentForm = new ew.Form("fndpview", "view");
	loadjs.done("fndpview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ndp_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ndp_view->ExportOptions->render("body") ?>
<?php $ndp_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ndp_view->showPageHeader(); ?>
<?php
$ndp_view->showMessage();
?>
<?php if (!$ndp_view->IsModal) { ?>
<?php if (!$ndp_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ndp_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fndpview" id="fndpview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ndp">
<input type="hidden" name="modal" value="<?php echo (int)$ndp_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ndp_view->NDP->Visible) { // NDP ?>
	<tr id="r_NDP">
		<td class="<?php echo $ndp_view->TableLeftColumnClass ?>"><span id="elh_ndp_NDP"><?php echo $ndp_view->NDP->caption() ?></span></td>
		<td data-name="NDP" <?php echo $ndp_view->NDP->cellAttributes() ?>>
<span id="el_ndp_NDP">
<span<?php echo $ndp_view->NDP->viewAttributes() ?>><?php echo $ndp_view->NDP->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ndp_view->NDPShortName->Visible) { // NDPShortName ?>
	<tr id="r_NDPShortName">
		<td class="<?php echo $ndp_view->TableLeftColumnClass ?>"><span id="elh_ndp_NDPShortName"><?php echo $ndp_view->NDPShortName->caption() ?></span></td>
		<td data-name="NDPShortName" <?php echo $ndp_view->NDPShortName->cellAttributes() ?>>
<span id="el_ndp_NDPShortName">
<span<?php echo $ndp_view->NDPShortName->viewAttributes() ?>><?php echo $ndp_view->NDPShortName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ndp_view->FromYear->Visible) { // FromYear ?>
	<tr id="r_FromYear">
		<td class="<?php echo $ndp_view->TableLeftColumnClass ?>"><span id="elh_ndp_FromYear"><?php echo $ndp_view->FromYear->caption() ?></span></td>
		<td data-name="FromYear" <?php echo $ndp_view->FromYear->cellAttributes() ?>>
<span id="el_ndp_FromYear">
<span<?php echo $ndp_view->FromYear->viewAttributes() ?>><?php echo $ndp_view->FromYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ndp_view->ToYear->Visible) { // ToYear ?>
	<tr id="r_ToYear">
		<td class="<?php echo $ndp_view->TableLeftColumnClass ?>"><span id="elh_ndp_ToYear"><?php echo $ndp_view->ToYear->caption() ?></span></td>
		<td data-name="ToYear" <?php echo $ndp_view->ToYear->cellAttributes() ?>>
<span id="el_ndp_ToYear">
<span<?php echo $ndp_view->ToYear->viewAttributes() ?>><?php echo $ndp_view->ToYear->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ndp_view->NDPDeascription->Visible) { // NDPDeascription ?>
	<tr id="r_NDPDeascription">
		<td class="<?php echo $ndp_view->TableLeftColumnClass ?>"><span id="elh_ndp_NDPDeascription"><?php echo $ndp_view->NDPDeascription->caption() ?></span></td>
		<td data-name="NDPDeascription" <?php echo $ndp_view->NDPDeascription->cellAttributes() ?>>
<span id="el_ndp_NDPDeascription">
<span<?php echo $ndp_view->NDPDeascription->viewAttributes() ?>><?php echo $ndp_view->NDPDeascription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ndp_view->NDPObjectives->Visible) { // NDPObjectives ?>
	<tr id="r_NDPObjectives">
		<td class="<?php echo $ndp_view->TableLeftColumnClass ?>"><span id="elh_ndp_NDPObjectives"><?php echo $ndp_view->NDPObjectives->caption() ?></span></td>
		<td data-name="NDPObjectives" <?php echo $ndp_view->NDPObjectives->cellAttributes() ?>>
<span id="el_ndp_NDPObjectives">
<span<?php echo $ndp_view->NDPObjectives->viewAttributes() ?>><?php echo $ndp_view->NDPObjectives->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ndp_view->EffectiveDate->Visible) { // EffectiveDate ?>
	<tr id="r_EffectiveDate">
		<td class="<?php echo $ndp_view->TableLeftColumnClass ?>"><span id="elh_ndp_EffectiveDate"><?php echo $ndp_view->EffectiveDate->caption() ?></span></td>
		<td data-name="EffectiveDate" <?php echo $ndp_view->EffectiveDate->cellAttributes() ?>>
<span id="el_ndp_EffectiveDate">
<span<?php echo $ndp_view->EffectiveDate->viewAttributes() ?>><?php echo $ndp_view->EffectiveDate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ndp_view->NDPURL->Visible) { // NDPURL ?>
	<tr id="r_NDPURL">
		<td class="<?php echo $ndp_view->TableLeftColumnClass ?>"><span id="elh_ndp_NDPURL"><?php echo $ndp_view->NDPURL->caption() ?></span></td>
		<td data-name="NDPURL" <?php echo $ndp_view->NDPURL->cellAttributes() ?>>
<span id="el_ndp_NDPURL">
<span<?php echo $ndp_view->NDPURL->viewAttributes() ?>><?php echo $ndp_view->NDPURL->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$ndp_view->IsModal) { ?>
<?php if (!$ndp_view->isExport()) { ?>
<?php echo $ndp_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("pillars", explode(",", $ndp->getCurrentDetailTable())) && $pillars->DetailView) {
?>
<?php if ($ndp->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("pillars", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $ndp_view->pillars_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "pillarsgrid.php" ?>
<?php } ?>
</form>
<?php
$ndp_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ndp_view->isExport()) { ?>
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
$ndp_view->terminate();
?>