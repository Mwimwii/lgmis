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
$retirement_type_view = new retirement_type_view();

// Run the page
$retirement_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$retirement_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$retirement_type_view->isExport()) { ?>
<script>
var fretirement_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fretirement_typeview = currentForm = new ew.Form("fretirement_typeview", "view");
	loadjs.done("fretirement_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$retirement_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $retirement_type_view->ExportOptions->render("body") ?>
<?php $retirement_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $retirement_type_view->showPageHeader(); ?>
<?php
$retirement_type_view->showMessage();
?>
<?php if (!$retirement_type_view->IsModal) { ?>
<?php if (!$retirement_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $retirement_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fretirement_typeview" id="fretirement_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="retirement_type">
<input type="hidden" name="modal" value="<?php echo (int)$retirement_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($retirement_type_view->RetirementCode->Visible) { // RetirementCode ?>
	<tr id="r_RetirementCode">
		<td class="<?php echo $retirement_type_view->TableLeftColumnClass ?>"><span id="elh_retirement_type_RetirementCode"><?php echo $retirement_type_view->RetirementCode->caption() ?></span></td>
		<td data-name="RetirementCode" <?php echo $retirement_type_view->RetirementCode->cellAttributes() ?>>
<span id="el_retirement_type_RetirementCode">
<span<?php echo $retirement_type_view->RetirementCode->viewAttributes() ?>><?php echo $retirement_type_view->RetirementCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($retirement_type_view->RetirementType->Visible) { // RetirementType ?>
	<tr id="r_RetirementType">
		<td class="<?php echo $retirement_type_view->TableLeftColumnClass ?>"><span id="elh_retirement_type_RetirementType"><?php echo $retirement_type_view->RetirementType->caption() ?></span></td>
		<td data-name="RetirementType" <?php echo $retirement_type_view->RetirementType->cellAttributes() ?>>
<span id="el_retirement_type_RetirementType">
<span<?php echo $retirement_type_view->RetirementType->viewAttributes() ?>><?php echo $retirement_type_view->RetirementType->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($retirement_type_view->ExitCode->Visible) { // ExitCode ?>
	<tr id="r_ExitCode">
		<td class="<?php echo $retirement_type_view->TableLeftColumnClass ?>"><span id="elh_retirement_type_ExitCode"><?php echo $retirement_type_view->ExitCode->caption() ?></span></td>
		<td data-name="ExitCode" <?php echo $retirement_type_view->ExitCode->cellAttributes() ?>>
<span id="el_retirement_type_ExitCode">
<span<?php echo $retirement_type_view->ExitCode->viewAttributes() ?>><?php echo $retirement_type_view->ExitCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$retirement_type_view->IsModal) { ?>
<?php if (!$retirement_type_view->isExport()) { ?>
<?php echo $retirement_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$retirement_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$retirement_type_view->isExport()) { ?>
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
$retirement_type_view->terminate();
?>