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
$musers_view = new musers_view();

// Run the page
$musers_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$musers_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$musers_view->isExport()) { ?>
<script>
var fmusersview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmusersview = currentForm = new ew.Form("fmusersview", "view");
	loadjs.done("fmusersview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$musers_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $musers_view->ExportOptions->render("body") ?>
<?php $musers_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $musers_view->showPageHeader(); ?>
<?php
$musers_view->showMessage();
?>
<?php if (!$musers_view->IsModal) { ?>
<?php if (!$musers_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $musers_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fmusersview" id="fmusersview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="musers">
<input type="hidden" name="modal" value="<?php echo (int)$musers_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($musers_view->UserCode->Visible) { // UserCode ?>
	<tr id="r_UserCode">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_UserCode"><?php echo $musers_view->UserCode->caption() ?></span></td>
		<td data-name="UserCode" <?php echo $musers_view->UserCode->cellAttributes() ?>>
<span id="el_musers_UserCode">
<span<?php echo $musers_view->UserCode->viewAttributes() ?>><?php echo $musers_view->UserCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->UserName->Visible) { // UserName ?>
	<tr id="r_UserName">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_UserName"><?php echo $musers_view->UserName->caption() ?></span></td>
		<td data-name="UserName" <?php echo $musers_view->UserName->cellAttributes() ?>>
<span id="el_musers_UserName">
<span<?php echo $musers_view->UserName->viewAttributes() ?>><?php echo $musers_view->UserName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->Password->Visible) { // Password ?>
	<tr id="r_Password">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_Password"><?php echo $musers_view->Password->caption() ?></span></td>
		<td data-name="Password" <?php echo $musers_view->Password->cellAttributes() ?>>
<span id="el_musers_Password">
<span<?php echo $musers_view->Password->viewAttributes() ?>><?php echo $musers_view->Password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_EmployeeID"><?php echo $musers_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $musers_view->EmployeeID->cellAttributes() ?>>
<span id="el_musers_EmployeeID">
<span<?php echo $musers_view->EmployeeID->viewAttributes() ?>><?php echo $musers_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->FirstName->Visible) { // FirstName ?>
	<tr id="r_FirstName">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_FirstName"><?php echo $musers_view->FirstName->caption() ?></span></td>
		<td data-name="FirstName" <?php echo $musers_view->FirstName->cellAttributes() ?>>
<span id="el_musers_FirstName">
<span<?php echo $musers_view->FirstName->viewAttributes() ?>><?php echo $musers_view->FirstName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->LastName->Visible) { // LastName ?>
	<tr id="r_LastName">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_LastName"><?php echo $musers_view->LastName->caption() ?></span></td>
		<td data-name="LastName" <?php echo $musers_view->LastName->cellAttributes() ?>>
<span id="el_musers_LastName">
<span<?php echo $musers_view->LastName->viewAttributes() ?>><?php echo $musers_view->LastName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->ProvinceCode->Visible) { // ProvinceCode ?>
	<tr id="r_ProvinceCode">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_ProvinceCode"><?php echo $musers_view->ProvinceCode->caption() ?></span></td>
		<td data-name="ProvinceCode" <?php echo $musers_view->ProvinceCode->cellAttributes() ?>>
<span id="el_musers_ProvinceCode">
<span<?php echo $musers_view->ProvinceCode->viewAttributes() ?>><?php echo $musers_view->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_LACode"><?php echo $musers_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $musers_view->LACode->cellAttributes() ?>>
<span id="el_musers_LACode">
<span<?php echo $musers_view->LACode->viewAttributes() ?>><?php echo $musers_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->Level->Visible) { // Level ?>
	<tr id="r_Level">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_Level"><?php echo $musers_view->Level->caption() ?></span></td>
		<td data-name="Level" <?php echo $musers_view->Level->cellAttributes() ?>>
<span id="el_musers_Level">
<span<?php echo $musers_view->Level->viewAttributes() ?>><?php echo $musers_view->Level->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->Role->Visible) { // Role ?>
	<tr id="r_Role">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_Role"><?php echo $musers_view->Role->caption() ?></span></td>
		<td data-name="Role" <?php echo $musers_view->Role->cellAttributes() ?>>
<span id="el_musers_Role">
<span<?php echo $musers_view->Role->viewAttributes() ?>><?php echo $musers_view->Role->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->Clearance->Visible) { // Clearance ?>
	<tr id="r_Clearance">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_Clearance"><?php echo $musers_view->Clearance->caption() ?></span></td>
		<td data-name="Clearance" <?php echo $musers_view->Clearance->cellAttributes() ?>>
<span id="el_musers_Clearance">
<span<?php echo $musers_view->Clearance->viewAttributes() ?>><?php echo $musers_view->Clearance->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->OrganisationLevel->Visible) { // OrganisationLevel ?>
	<tr id="r_OrganisationLevel">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_OrganisationLevel"><?php echo $musers_view->OrganisationLevel->caption() ?></span></td>
		<td data-name="OrganisationLevel" <?php echo $musers_view->OrganisationLevel->cellAttributes() ?>>
<span id="el_musers_OrganisationLevel">
<span<?php echo $musers_view->OrganisationLevel->viewAttributes() ?>><?php echo $musers_view->OrganisationLevel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->Active->Visible) { // Active ?>
	<tr id="r_Active">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_Active"><?php echo $musers_view->Active->caption() ?></span></td>
		<td data-name="Active" <?php echo $musers_view->Active->cellAttributes() ?>>
<span id="el_musers_Active">
<span<?php echo $musers_view->Active->viewAttributes() ?>><?php echo $musers_view->Active->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers__Email"><?php echo $musers_view->_Email->caption() ?></span></td>
		<td data-name="_Email" <?php echo $musers_view->_Email->cellAttributes() ?>>
<span id="el_musers__Email">
<span<?php echo $musers_view->_Email->viewAttributes() ?>><?php echo $musers_view->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->Telephone->Visible) { // Telephone ?>
	<tr id="r_Telephone">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_Telephone"><?php echo $musers_view->Telephone->caption() ?></span></td>
		<td data-name="Telephone" <?php echo $musers_view->Telephone->cellAttributes() ?>>
<span id="el_musers_Telephone">
<span<?php echo $musers_view->Telephone->viewAttributes() ?>><?php echo $musers_view->Telephone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->Mobile->Visible) { // Mobile ?>
	<tr id="r_Mobile">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_Mobile"><?php echo $musers_view->Mobile->caption() ?></span></td>
		<td data-name="Mobile" <?php echo $musers_view->Mobile->cellAttributes() ?>>
<span id="el_musers_Mobile">
<span<?php echo $musers_view->Mobile->viewAttributes() ?>><?php echo $musers_view->Mobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->Position->Visible) { // Position ?>
	<tr id="r_Position">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_Position"><?php echo $musers_view->Position->caption() ?></span></td>
		<td data-name="Position" <?php echo $musers_view->Position->cellAttributes() ?>>
<span id="el_musers_Position">
<span<?php echo $musers_view->Position->viewAttributes() ?>><?php echo $musers_view->Position->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->ReportsTo->Visible) { // ReportsTo ?>
	<tr id="r_ReportsTo">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_ReportsTo"><?php echo $musers_view->ReportsTo->caption() ?></span></td>
		<td data-name="ReportsTo" <?php echo $musers_view->ReportsTo->cellAttributes() ?>>
<span id="el_musers_ReportsTo">
<span<?php echo $musers_view->ReportsTo->viewAttributes() ?>><?php echo $musers_view->ReportsTo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($musers_view->Profile->Visible) { // Profile ?>
	<tr id="r_Profile">
		<td class="<?php echo $musers_view->TableLeftColumnClass ?>"><span id="elh_musers_Profile"><?php echo $musers_view->Profile->caption() ?></span></td>
		<td data-name="Profile" <?php echo $musers_view->Profile->cellAttributes() ?>>
<span id="el_musers_Profile">
<span<?php echo $musers_view->Profile->viewAttributes() ?>><?php echo $musers_view->Profile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$musers_view->IsModal) { ?>
<?php if (!$musers_view->isExport()) { ?>
<?php echo $musers_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("security_matrix", explode(",", $musers->getCurrentDetailTable())) && $security_matrix->DetailView) {
?>
<?php if ($musers->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("security_matrix", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "security_matrixgrid.php" ?>
<?php } ?>
</form>
<?php
$musers_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$musers_view->isExport()) { ?>
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
$musers_view->terminate();
?>