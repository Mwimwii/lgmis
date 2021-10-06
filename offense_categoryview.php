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
$offense_category_view = new offense_category_view();

// Run the page
$offense_category_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$offense_category_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$offense_category_view->isExport()) { ?>
<script>
var foffense_categoryview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	foffense_categoryview = currentForm = new ew.Form("foffense_categoryview", "view");
	loadjs.done("foffense_categoryview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$offense_category_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $offense_category_view->ExportOptions->render("body") ?>
<?php $offense_category_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $offense_category_view->showPageHeader(); ?>
<?php
$offense_category_view->showMessage();
?>
<?php if (!$offense_category_view->IsModal) { ?>
<?php if (!$offense_category_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $offense_category_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="foffense_categoryview" id="foffense_categoryview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="offense_category">
<input type="hidden" name="modal" value="<?php echo (int)$offense_category_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($offense_category_view->OffenseCategory->Visible) { // OffenseCategory ?>
	<tr id="r_OffenseCategory">
		<td class="<?php echo $offense_category_view->TableLeftColumnClass ?>"><span id="elh_offense_category_OffenseCategory"><?php echo $offense_category_view->OffenseCategory->caption() ?></span></td>
		<td data-name="OffenseCategory" <?php echo $offense_category_view->OffenseCategory->cellAttributes() ?>>
<span id="el_offense_category_OffenseCategory">
<span<?php echo $offense_category_view->OffenseCategory->viewAttributes() ?>><?php echo $offense_category_view->OffenseCategory->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($offense_category_view->OffenseCategoryName->Visible) { // OffenseCategoryName ?>
	<tr id="r_OffenseCategoryName">
		<td class="<?php echo $offense_category_view->TableLeftColumnClass ?>"><span id="elh_offense_category_OffenseCategoryName"><?php echo $offense_category_view->OffenseCategoryName->caption() ?></span></td>
		<td data-name="OffenseCategoryName" <?php echo $offense_category_view->OffenseCategoryName->cellAttributes() ?>>
<span id="el_offense_category_OffenseCategoryName">
<span<?php echo $offense_category_view->OffenseCategoryName->viewAttributes() ?>><?php echo $offense_category_view->OffenseCategoryName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$offense_category_view->IsModal) { ?>
<?php if (!$offense_category_view->isExport()) { ?>
<?php echo $offense_category_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$offense_category_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$offense_category_view->isExport()) { ?>
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
$offense_category_view->terminate();
?>