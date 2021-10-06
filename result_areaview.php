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
$result_area_view = new result_area_view();

// Run the page
$result_area_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$result_area_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$result_area_view->isExport()) { ?>
<script>
var fresult_areaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fresult_areaview = currentForm = new ew.Form("fresult_areaview", "view");
	loadjs.done("fresult_areaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$result_area_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $result_area_view->ExportOptions->render("body") ?>
<?php $result_area_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $result_area_view->showPageHeader(); ?>
<?php
$result_area_view->showMessage();
?>
<?php if (!$result_area_view->IsModal) { ?>
<?php if (!$result_area_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $result_area_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fresult_areaview" id="fresult_areaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="result_area">
<input type="hidden" name="modal" value="<?php echo (int)$result_area_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($result_area_view->ResultAreaCode->Visible) { // ResultAreaCode ?>
	<tr id="r_ResultAreaCode">
		<td class="<?php echo $result_area_view->TableLeftColumnClass ?>"><span id="elh_result_area_ResultAreaCode"><?php echo $result_area_view->ResultAreaCode->caption() ?></span></td>
		<td data-name="ResultAreaCode" <?php echo $result_area_view->ResultAreaCode->cellAttributes() ?>>
<span id="el_result_area_ResultAreaCode">
<span<?php echo $result_area_view->ResultAreaCode->viewAttributes() ?>><?php echo $result_area_view->ResultAreaCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($result_area_view->ResultAreaName->Visible) { // ResultAreaName ?>
	<tr id="r_ResultAreaName">
		<td class="<?php echo $result_area_view->TableLeftColumnClass ?>"><span id="elh_result_area_ResultAreaName"><?php echo $result_area_view->ResultAreaName->caption() ?></span></td>
		<td data-name="ResultAreaName" <?php echo $result_area_view->ResultAreaName->cellAttributes() ?>>
<span id="el_result_area_ResultAreaName">
<span<?php echo $result_area_view->ResultAreaName->viewAttributes() ?>><?php echo $result_area_view->ResultAreaName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($result_area_view->ResultAreaStatus->Visible) { // ResultAreaStatus ?>
	<tr id="r_ResultAreaStatus">
		<td class="<?php echo $result_area_view->TableLeftColumnClass ?>"><span id="elh_result_area_ResultAreaStatus"><?php echo $result_area_view->ResultAreaStatus->caption() ?></span></td>
		<td data-name="ResultAreaStatus" <?php echo $result_area_view->ResultAreaStatus->cellAttributes() ?>>
<span id="el_result_area_ResultAreaStatus">
<span<?php echo $result_area_view->ResultAreaStatus->viewAttributes() ?>><?php echo $result_area_view->ResultAreaStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($result_area_view->ProgressStatus->Visible) { // ProgressStatus ?>
	<tr id="r_ProgressStatus">
		<td class="<?php echo $result_area_view->TableLeftColumnClass ?>"><span id="elh_result_area_ProgressStatus"><?php echo $result_area_view->ProgressStatus->caption() ?></span></td>
		<td data-name="ProgressStatus" <?php echo $result_area_view->ProgressStatus->cellAttributes() ?>>
<span id="el_result_area_ProgressStatus">
<span<?php echo $result_area_view->ProgressStatus->viewAttributes() ?>><?php echo $result_area_view->ProgressStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$result_area_view->IsModal) { ?>
<?php if (!$result_area_view->isExport()) { ?>
<?php echo $result_area_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$result_area_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$result_area_view->isExport()) { ?>
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
$result_area_view->terminate();
?>