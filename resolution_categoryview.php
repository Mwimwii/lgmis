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
$resolution_category_view = new resolution_category_view();

// Run the page
$resolution_category_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$resolution_category_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$resolution_category_view->isExport()) { ?>
<script>
var fresolution_categoryview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fresolution_categoryview = currentForm = new ew.Form("fresolution_categoryview", "view");
	loadjs.done("fresolution_categoryview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$resolution_category_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $resolution_category_view->ExportOptions->render("body") ?>
<?php $resolution_category_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $resolution_category_view->showPageHeader(); ?>
<?php
$resolution_category_view->showMessage();
?>
<?php if (!$resolution_category_view->IsModal) { ?>
<?php if (!$resolution_category_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $resolution_category_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fresolution_categoryview" id="fresolution_categoryview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="resolution_category">
<input type="hidden" name="modal" value="<?php echo (int)$resolution_category_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($resolution_category_view->ResolutionCategoryCode->Visible) { // ResolutionCategoryCode ?>
	<tr id="r_ResolutionCategoryCode">
		<td class="<?php echo $resolution_category_view->TableLeftColumnClass ?>"><span id="elh_resolution_category_ResolutionCategoryCode"><?php echo $resolution_category_view->ResolutionCategoryCode->caption() ?></span></td>
		<td data-name="ResolutionCategoryCode" <?php echo $resolution_category_view->ResolutionCategoryCode->cellAttributes() ?>>
<span id="el_resolution_category_ResolutionCategoryCode">
<span<?php echo $resolution_category_view->ResolutionCategoryCode->viewAttributes() ?>><?php echo $resolution_category_view->ResolutionCategoryCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($resolution_category_view->ResolutionCategoryName->Visible) { // ResolutionCategoryName ?>
	<tr id="r_ResolutionCategoryName">
		<td class="<?php echo $resolution_category_view->TableLeftColumnClass ?>"><span id="elh_resolution_category_ResolutionCategoryName"><?php echo $resolution_category_view->ResolutionCategoryName->caption() ?></span></td>
		<td data-name="ResolutionCategoryName" <?php echo $resolution_category_view->ResolutionCategoryName->cellAttributes() ?>>
<span id="el_resolution_category_ResolutionCategoryName">
<span<?php echo $resolution_category_view->ResolutionCategoryName->viewAttributes() ?>><?php echo $resolution_category_view->ResolutionCategoryName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$resolution_category_view->IsModal) { ?>
<?php if (!$resolution_category_view->isExport()) { ?>
<?php echo $resolution_category_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$resolution_category_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$resolution_category_view->isExport()) { ?>
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
$resolution_category_view->terminate();
?>