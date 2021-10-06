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
$offense_penalty_view = new offense_penalty_view();

// Run the page
$offense_penalty_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$offense_penalty_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$offense_penalty_view->isExport()) { ?>
<script>
var foffense_penaltyview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	foffense_penaltyview = currentForm = new ew.Form("foffense_penaltyview", "view");
	loadjs.done("foffense_penaltyview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$offense_penalty_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $offense_penalty_view->ExportOptions->render("body") ?>
<?php $offense_penalty_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $offense_penalty_view->showPageHeader(); ?>
<?php
$offense_penalty_view->showMessage();
?>
<?php if (!$offense_penalty_view->IsModal) { ?>
<?php if (!$offense_penalty_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $offense_penalty_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="foffense_penaltyview" id="foffense_penaltyview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="offense_penalty">
<input type="hidden" name="modal" value="<?php echo (int)$offense_penalty_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($offense_penalty_view->OffenseCode->Visible) { // OffenseCode ?>
	<tr id="r_OffenseCode">
		<td class="<?php echo $offense_penalty_view->TableLeftColumnClass ?>"><span id="elh_offense_penalty_OffenseCode"><?php echo $offense_penalty_view->OffenseCode->caption() ?></span></td>
		<td data-name="OffenseCode" <?php echo $offense_penalty_view->OffenseCode->cellAttributes() ?>>
<span id="el_offense_penalty_OffenseCode">
<span<?php echo $offense_penalty_view->OffenseCode->viewAttributes() ?>><?php echo $offense_penalty_view->OffenseCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($offense_penalty_view->OffenseCategory->Visible) { // OffenseCategory ?>
	<tr id="r_OffenseCategory">
		<td class="<?php echo $offense_penalty_view->TableLeftColumnClass ?>"><span id="elh_offense_penalty_OffenseCategory"><?php echo $offense_penalty_view->OffenseCategory->caption() ?></span></td>
		<td data-name="OffenseCategory" <?php echo $offense_penalty_view->OffenseCategory->cellAttributes() ?>>
<span id="el_offense_penalty_OffenseCategory">
<span<?php echo $offense_penalty_view->OffenseCategory->viewAttributes() ?>><?php echo $offense_penalty_view->OffenseCategory->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($offense_penalty_view->OffenseName->Visible) { // OffenseName ?>
	<tr id="r_OffenseName">
		<td class="<?php echo $offense_penalty_view->TableLeftColumnClass ?>"><span id="elh_offense_penalty_OffenseName"><?php echo $offense_penalty_view->OffenseName->caption() ?></span></td>
		<td data-name="OffenseName" <?php echo $offense_penalty_view->OffenseName->cellAttributes() ?>>
<span id="el_offense_penalty_OffenseName">
<span<?php echo $offense_penalty_view->OffenseName->viewAttributes() ?>><?php echo $offense_penalty_view->OffenseName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($offense_penalty_view->Frequency->Visible) { // Frequency ?>
	<tr id="r_Frequency">
		<td class="<?php echo $offense_penalty_view->TableLeftColumnClass ?>"><span id="elh_offense_penalty_Frequency"><?php echo $offense_penalty_view->Frequency->caption() ?></span></td>
		<td data-name="Frequency" <?php echo $offense_penalty_view->Frequency->cellAttributes() ?>>
<span id="el_offense_penalty_Frequency">
<span<?php echo $offense_penalty_view->Frequency->viewAttributes() ?>><?php echo $offense_penalty_view->Frequency->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($offense_penalty_view->AppropriateAction->Visible) { // AppropriateAction ?>
	<tr id="r_AppropriateAction">
		<td class="<?php echo $offense_penalty_view->TableLeftColumnClass ?>"><span id="elh_offense_penalty_AppropriateAction"><?php echo $offense_penalty_view->AppropriateAction->caption() ?></span></td>
		<td data-name="AppropriateAction" <?php echo $offense_penalty_view->AppropriateAction->cellAttributes() ?>>
<span id="el_offense_penalty_AppropriateAction">
<span<?php echo $offense_penalty_view->AppropriateAction->viewAttributes() ?>><?php echo $offense_penalty_view->AppropriateAction->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($offense_penalty_view->Authority->Visible) { // Authority ?>
	<tr id="r_Authority">
		<td class="<?php echo $offense_penalty_view->TableLeftColumnClass ?>"><span id="elh_offense_penalty_Authority"><?php echo $offense_penalty_view->Authority->caption() ?></span></td>
		<td data-name="Authority" <?php echo $offense_penalty_view->Authority->cellAttributes() ?>>
<span id="el_offense_penalty_Authority">
<span<?php echo $offense_penalty_view->Authority->viewAttributes() ?>><?php echo $offense_penalty_view->Authority->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$offense_penalty_view->IsModal) { ?>
<?php if (!$offense_penalty_view->isExport()) { ?>
<?php echo $offense_penalty_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$offense_penalty_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$offense_penalty_view->isExport()) { ?>
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
$offense_penalty_view->terminate();
?>