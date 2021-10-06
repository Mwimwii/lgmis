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
$professional_level_view = new professional_level_view();

// Run the page
$professional_level_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professional_level_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$professional_level_view->isExport()) { ?>
<script>
var fprofessional_levelview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fprofessional_levelview = currentForm = new ew.Form("fprofessional_levelview", "view");
	loadjs.done("fprofessional_levelview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$professional_level_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $professional_level_view->ExportOptions->render("body") ?>
<?php $professional_level_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $professional_level_view->showPageHeader(); ?>
<?php
$professional_level_view->showMessage();
?>
<?php if (!$professional_level_view->IsModal) { ?>
<?php if (!$professional_level_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $professional_level_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fprofessional_levelview" id="fprofessional_levelview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professional_level">
<input type="hidden" name="modal" value="<?php echo (int)$professional_level_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($professional_level_view->ProfessionalLevel->Visible) { // ProfessionalLevel ?>
	<tr id="r_ProfessionalLevel">
		<td class="<?php echo $professional_level_view->TableLeftColumnClass ?>"><span id="elh_professional_level_ProfessionalLevel"><?php echo $professional_level_view->ProfessionalLevel->caption() ?></span></td>
		<td data-name="ProfessionalLevel" <?php echo $professional_level_view->ProfessionalLevel->cellAttributes() ?>>
<span id="el_professional_level_ProfessionalLevel">
<span<?php echo $professional_level_view->ProfessionalLevel->viewAttributes() ?>><?php echo $professional_level_view->ProfessionalLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($professional_level_view->ProfessionalName->Visible) { // ProfessionalName ?>
	<tr id="r_ProfessionalName">
		<td class="<?php echo $professional_level_view->TableLeftColumnClass ?>"><span id="elh_professional_level_ProfessionalName"><?php echo $professional_level_view->ProfessionalName->caption() ?></span></td>
		<td data-name="ProfessionalName" <?php echo $professional_level_view->ProfessionalName->cellAttributes() ?>>
<span id="el_professional_level_ProfessionalName">
<span<?php echo $professional_level_view->ProfessionalName->viewAttributes() ?>><?php echo $professional_level_view->ProfessionalName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($professional_level_view->ProfessionalDesc->Visible) { // ProfessionalDesc ?>
	<tr id="r_ProfessionalDesc">
		<td class="<?php echo $professional_level_view->TableLeftColumnClass ?>"><span id="elh_professional_level_ProfessionalDesc"><?php echo $professional_level_view->ProfessionalDesc->caption() ?></span></td>
		<td data-name="ProfessionalDesc" <?php echo $professional_level_view->ProfessionalDesc->cellAttributes() ?>>
<span id="el_professional_level_ProfessionalDesc">
<span<?php echo $professional_level_view->ProfessionalDesc->viewAttributes() ?>><?php echo $professional_level_view->ProfessionalDesc->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($professional_level_view->LastUserID->Visible) { // LastUserID ?>
	<tr id="r_LastUserID">
		<td class="<?php echo $professional_level_view->TableLeftColumnClass ?>"><span id="elh_professional_level_LastUserID"><?php echo $professional_level_view->LastUserID->caption() ?></span></td>
		<td data-name="LastUserID" <?php echo $professional_level_view->LastUserID->cellAttributes() ?>>
<span id="el_professional_level_LastUserID">
<span<?php echo $professional_level_view->LastUserID->viewAttributes() ?>><?php echo $professional_level_view->LastUserID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($professional_level_view->LastUpdated->Visible) { // LastUpdated ?>
	<tr id="r_LastUpdated">
		<td class="<?php echo $professional_level_view->TableLeftColumnClass ?>"><span id="elh_professional_level_LastUpdated"><?php echo $professional_level_view->LastUpdated->caption() ?></span></td>
		<td data-name="LastUpdated" <?php echo $professional_level_view->LastUpdated->cellAttributes() ?>>
<span id="el_professional_level_LastUpdated">
<span<?php echo $professional_level_view->LastUpdated->viewAttributes() ?>><?php echo $professional_level_view->LastUpdated->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$professional_level_view->IsModal) { ?>
<?php if (!$professional_level_view->isExport()) { ?>
<?php echo $professional_level_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$professional_level_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$professional_level_view->isExport()) { ?>
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
$professional_level_view->terminate();
?>