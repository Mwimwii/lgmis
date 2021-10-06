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
$professional_body_view = new professional_body_view();

// Run the page
$professional_body_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professional_body_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$professional_body_view->isExport()) { ?>
<script>
var fprofessional_bodyview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fprofessional_bodyview = currentForm = new ew.Form("fprofessional_bodyview", "view");
	loadjs.done("fprofessional_bodyview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$professional_body_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $professional_body_view->ExportOptions->render("body") ?>
<?php $professional_body_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $professional_body_view->showPageHeader(); ?>
<?php
$professional_body_view->showMessage();
?>
<?php if (!$professional_body_view->IsModal) { ?>
<?php if (!$professional_body_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $professional_body_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fprofessional_bodyview" id="fprofessional_bodyview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professional_body">
<input type="hidden" name="modal" value="<?php echo (int)$professional_body_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($professional_body_view->ProfessionalBody->Visible) { // ProfessionalBody ?>
	<tr id="r_ProfessionalBody">
		<td class="<?php echo $professional_body_view->TableLeftColumnClass ?>"><span id="elh_professional_body_ProfessionalBody"><?php echo $professional_body_view->ProfessionalBody->caption() ?></span></td>
		<td data-name="ProfessionalBody" <?php echo $professional_body_view->ProfessionalBody->cellAttributes() ?>>
<span id="el_professional_body_ProfessionalBody">
<span<?php echo $professional_body_view->ProfessionalBody->viewAttributes() ?>><?php echo $professional_body_view->ProfessionalBody->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($professional_body_view->ProfessionalField->Visible) { // ProfessionalField ?>
	<tr id="r_ProfessionalField">
		<td class="<?php echo $professional_body_view->TableLeftColumnClass ?>"><span id="elh_professional_body_ProfessionalField"><?php echo $professional_body_view->ProfessionalField->caption() ?></span></td>
		<td data-name="ProfessionalField" <?php echo $professional_body_view->ProfessionalField->cellAttributes() ?>>
<span id="el_professional_body_ProfessionalField">
<span<?php echo $professional_body_view->ProfessionalField->viewAttributes() ?>><?php echo $professional_body_view->ProfessionalField->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$professional_body_view->IsModal) { ?>
<?php if (!$professional_body_view->isExport()) { ?>
<?php echo $professional_body_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$professional_body_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$professional_body_view->isExport()) { ?>
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
$professional_body_view->terminate();
?>