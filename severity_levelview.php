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
$severity_level_view = new severity_level_view();

// Run the page
$severity_level_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$severity_level_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$severity_level_view->isExport()) { ?>
<script>
var fseverity_levelview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fseverity_levelview = currentForm = new ew.Form("fseverity_levelview", "view");
	loadjs.done("fseverity_levelview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$severity_level_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $severity_level_view->ExportOptions->render("body") ?>
<?php $severity_level_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $severity_level_view->showPageHeader(); ?>
<?php
$severity_level_view->showMessage();
?>
<?php if (!$severity_level_view->IsModal) { ?>
<?php if (!$severity_level_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $severity_level_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fseverity_levelview" id="fseverity_levelview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="severity_level">
<input type="hidden" name="modal" value="<?php echo (int)$severity_level_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($severity_level_view->SeverityLevelCode->Visible) { // SeverityLevelCode ?>
	<tr id="r_SeverityLevelCode">
		<td class="<?php echo $severity_level_view->TableLeftColumnClass ?>"><span id="elh_severity_level_SeverityLevelCode"><?php echo $severity_level_view->SeverityLevelCode->caption() ?></span></td>
		<td data-name="SeverityLevelCode" <?php echo $severity_level_view->SeverityLevelCode->cellAttributes() ?>>
<span id="el_severity_level_SeverityLevelCode">
<span<?php echo $severity_level_view->SeverityLevelCode->viewAttributes() ?>><?php echo $severity_level_view->SeverityLevelCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($severity_level_view->SeverityLevel->Visible) { // SeverityLevel ?>
	<tr id="r_SeverityLevel">
		<td class="<?php echo $severity_level_view->TableLeftColumnClass ?>"><span id="elh_severity_level_SeverityLevel"><?php echo $severity_level_view->SeverityLevel->caption() ?></span></td>
		<td data-name="SeverityLevel" <?php echo $severity_level_view->SeverityLevel->cellAttributes() ?>>
<span id="el_severity_level_SeverityLevel">
<span<?php echo $severity_level_view->SeverityLevel->viewAttributes() ?>><?php echo $severity_level_view->SeverityLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($severity_level_view->SeverityDescription->Visible) { // SeverityDescription ?>
	<tr id="r_SeverityDescription">
		<td class="<?php echo $severity_level_view->TableLeftColumnClass ?>"><span id="elh_severity_level_SeverityDescription"><?php echo $severity_level_view->SeverityDescription->caption() ?></span></td>
		<td data-name="SeverityDescription" <?php echo $severity_level_view->SeverityDescription->cellAttributes() ?>>
<span id="el_severity_level_SeverityDescription">
<span<?php echo $severity_level_view->SeverityDescription->viewAttributes() ?>><?php echo $severity_level_view->SeverityDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($severity_level_view->ResponseTime->Visible) { // ResponseTime ?>
	<tr id="r_ResponseTime">
		<td class="<?php echo $severity_level_view->TableLeftColumnClass ?>"><span id="elh_severity_level_ResponseTime"><?php echo $severity_level_view->ResponseTime->caption() ?></span></td>
		<td data-name="ResponseTime" <?php echo $severity_level_view->ResponseTime->cellAttributes() ?>>
<span id="el_severity_level_ResponseTime">
<span<?php echo $severity_level_view->ResponseTime->viewAttributes() ?>><?php echo $severity_level_view->ResponseTime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$severity_level_view->IsModal) { ?>
<?php if (!$severity_level_view->isExport()) { ?>
<?php echo $severity_level_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$severity_level_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$severity_level_view->isExport()) { ?>
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
$severity_level_view->terminate();
?>