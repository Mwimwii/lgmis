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
$medical_condition_view = new medical_condition_view();

// Run the page
$medical_condition_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$medical_condition_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$medical_condition_view->isExport()) { ?>
<script>
var fmedical_conditionview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmedical_conditionview = currentForm = new ew.Form("fmedical_conditionview", "view");
	loadjs.done("fmedical_conditionview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$medical_condition_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $medical_condition_view->ExportOptions->render("body") ?>
<?php $medical_condition_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $medical_condition_view->showPageHeader(); ?>
<?php
$medical_condition_view->showMessage();
?>
<?php if (!$medical_condition_view->IsModal) { ?>
<?php if (!$medical_condition_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $medical_condition_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmedical_conditionview" id="fmedical_conditionview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="medical_condition">
<input type="hidden" name="modal" value="<?php echo (int)$medical_condition_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($medical_condition_view->MedicalCondition->Visible) { // MedicalCondition ?>
	<tr id="r_MedicalCondition">
		<td class="<?php echo $medical_condition_view->TableLeftColumnClass ?>"><span id="elh_medical_condition_MedicalCondition"><?php echo $medical_condition_view->MedicalCondition->caption() ?></span></td>
		<td data-name="MedicalCondition" <?php echo $medical_condition_view->MedicalCondition->cellAttributes() ?>>
<span id="el_medical_condition_MedicalCondition">
<span<?php echo $medical_condition_view->MedicalCondition->viewAttributes() ?>><?php echo $medical_condition_view->MedicalCondition->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$medical_condition_view->IsModal) { ?>
<?php if (!$medical_condition_view->isExport()) { ?>
<?php echo $medical_condition_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$medical_condition_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$medical_condition_view->isExport()) { ?>
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
$medical_condition_view->terminate();
?>