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
$la_program_view = new la_program_view();

// Run the page
$la_program_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_program_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$la_program_view->isExport()) { ?>
<script>
var fla_programview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fla_programview = currentForm = new ew.Form("fla_programview", "view");
	loadjs.done("fla_programview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$la_program_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $la_program_view->ExportOptions->render("body") ?>
<?php $la_program_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $la_program_view->showPageHeader(); ?>
<?php
$la_program_view->showMessage();
?>
<?php if (!$la_program_view->IsModal) { ?>
<?php if (!$la_program_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $la_program_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fla_programview" id="fla_programview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_program">
<input type="hidden" name="modal" value="<?php echo (int)$la_program_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($la_program_view->ProgramCode->Visible) { // ProgramCode ?>
	<tr id="r_ProgramCode">
		<td class="<?php echo $la_program_view->TableLeftColumnClass ?>"><span id="elh_la_program_ProgramCode"><?php echo $la_program_view->ProgramCode->caption() ?></span></td>
		<td data-name="ProgramCode" <?php echo $la_program_view->ProgramCode->cellAttributes() ?>>
<span id="el_la_program_ProgramCode">
<span<?php echo $la_program_view->ProgramCode->viewAttributes() ?>><?php echo $la_program_view->ProgramCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($la_program_view->ProgramName->Visible) { // ProgramName ?>
	<tr id="r_ProgramName">
		<td class="<?php echo $la_program_view->TableLeftColumnClass ?>"><span id="elh_la_program_ProgramName"><?php echo $la_program_view->ProgramName->caption() ?></span></td>
		<td data-name="ProgramName" <?php echo $la_program_view->ProgramName->cellAttributes() ?>>
<span id="el_la_program_ProgramName">
<span<?php echo $la_program_view->ProgramName->viewAttributes() ?>><?php echo $la_program_view->ProgramName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($la_program_view->ProgramPurpose->Visible) { // ProgramPurpose ?>
	<tr id="r_ProgramPurpose">
		<td class="<?php echo $la_program_view->TableLeftColumnClass ?>"><span id="elh_la_program_ProgramPurpose"><?php echo $la_program_view->ProgramPurpose->caption() ?></span></td>
		<td data-name="ProgramPurpose" <?php echo $la_program_view->ProgramPurpose->cellAttributes() ?>>
<span id="el_la_program_ProgramPurpose">
<span<?php echo $la_program_view->ProgramPurpose->viewAttributes() ?>><?php echo $la_program_view->ProgramPurpose->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$la_program_view->IsModal) { ?>
<?php if (!$la_program_view->isExport()) { ?>
<?php echo $la_program_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("la_sub_program", explode(",", $la_program->getCurrentDetailTable())) && $la_sub_program->DetailView) {
?>
<?php if ($la_program->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("la_sub_program", "TblCaption") ?>&nbsp;<?php echo str_replace("%c", $la_program_view->la_sub_program_Count, $Language->phrase("DetailCount")) ?></h4>
<?php } ?>
<?php include_once "la_sub_programgrid.php" ?>
<?php } ?>
</form>
<?php
$la_program_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$la_program_view->isExport()) { ?>
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
$la_program_view->terminate();
?>