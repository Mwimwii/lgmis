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
$staffchildren_view = new staffchildren_view();

// Run the page
$staffchildren_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffchildren_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffchildren_view->isExport()) { ?>
<script>
var fstaffchildrenview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fstaffchildrenview = currentForm = new ew.Form("fstaffchildrenview", "view");
	loadjs.done("fstaffchildrenview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$staffchildren_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $staffchildren_view->ExportOptions->render("body") ?>
<?php $staffchildren_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $staffchildren_view->showPageHeader(); ?>
<?php
$staffchildren_view->showMessage();
?>
<?php if (!$staffchildren_view->IsModal) { ?>
<?php if (!$staffchildren_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffchildren_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fstaffchildrenview" id="fstaffchildrenview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffchildren">
<input type="hidden" name="modal" value="<?php echo (int)$staffchildren_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($staffchildren_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $staffchildren_view->TableLeftColumnClass ?>"><span id="elh_staffchildren_EmployeeID"><?php echo $staffchildren_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $staffchildren_view->EmployeeID->cellAttributes() ?>>
<span id="el_staffchildren_EmployeeID">
<span<?php echo $staffchildren_view->EmployeeID->viewAttributes() ?>><?php echo $staffchildren_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffchildren_view->ChildNo->Visible) { // ChildNo ?>
	<tr id="r_ChildNo">
		<td class="<?php echo $staffchildren_view->TableLeftColumnClass ?>"><span id="elh_staffchildren_ChildNo"><?php echo $staffchildren_view->ChildNo->caption() ?></span></td>
		<td data-name="ChildNo" <?php echo $staffchildren_view->ChildNo->cellAttributes() ?>>
<span id="el_staffchildren_ChildNo">
<span<?php echo $staffchildren_view->ChildNo->viewAttributes() ?>><?php echo $staffchildren_view->ChildNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffchildren_view->FirstName->Visible) { // FirstName ?>
	<tr id="r_FirstName">
		<td class="<?php echo $staffchildren_view->TableLeftColumnClass ?>"><span id="elh_staffchildren_FirstName"><?php echo $staffchildren_view->FirstName->caption() ?></span></td>
		<td data-name="FirstName" <?php echo $staffchildren_view->FirstName->cellAttributes() ?>>
<span id="el_staffchildren_FirstName">
<span<?php echo $staffchildren_view->FirstName->viewAttributes() ?>><?php echo $staffchildren_view->FirstName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffchildren_view->MiddleName->Visible) { // MiddleName ?>
	<tr id="r_MiddleName">
		<td class="<?php echo $staffchildren_view->TableLeftColumnClass ?>"><span id="elh_staffchildren_MiddleName"><?php echo $staffchildren_view->MiddleName->caption() ?></span></td>
		<td data-name="MiddleName" <?php echo $staffchildren_view->MiddleName->cellAttributes() ?>>
<span id="el_staffchildren_MiddleName">
<span<?php echo $staffchildren_view->MiddleName->viewAttributes() ?>><?php echo $staffchildren_view->MiddleName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffchildren_view->Surname->Visible) { // Surname ?>
	<tr id="r_Surname">
		<td class="<?php echo $staffchildren_view->TableLeftColumnClass ?>"><span id="elh_staffchildren_Surname"><?php echo $staffchildren_view->Surname->caption() ?></span></td>
		<td data-name="Surname" <?php echo $staffchildren_view->Surname->cellAttributes() ?>>
<span id="el_staffchildren_Surname">
<span<?php echo $staffchildren_view->Surname->viewAttributes() ?>><?php echo $staffchildren_view->Surname->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffchildren_view->DateOfBirth->Visible) { // DateOfBirth ?>
	<tr id="r_DateOfBirth">
		<td class="<?php echo $staffchildren_view->TableLeftColumnClass ?>"><span id="elh_staffchildren_DateOfBirth"><?php echo $staffchildren_view->DateOfBirth->caption() ?></span></td>
		<td data-name="DateOfBirth" <?php echo $staffchildren_view->DateOfBirth->cellAttributes() ?>>
<span id="el_staffchildren_DateOfBirth">
<span<?php echo $staffchildren_view->DateOfBirth->viewAttributes() ?>><?php echo $staffchildren_view->DateOfBirth->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($staffchildren_view->Sex->Visible) { // Sex ?>
	<tr id="r_Sex">
		<td class="<?php echo $staffchildren_view->TableLeftColumnClass ?>"><span id="elh_staffchildren_Sex"><?php echo $staffchildren_view->Sex->caption() ?></span></td>
		<td data-name="Sex" <?php echo $staffchildren_view->Sex->cellAttributes() ?>>
<span id="el_staffchildren_Sex">
<span<?php echo $staffchildren_view->Sex->viewAttributes() ?>><?php echo $staffchildren_view->Sex->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$staffchildren_view->IsModal) { ?>
<?php if (!$staffchildren_view->isExport()) { ?>
<?php echo $staffchildren_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$staffchildren_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffchildren_view->isExport()) { ?>
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
$staffchildren_view->terminate();
?>