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
$councillor_view = new councillor_view();

// Run the page
$councillor_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$councillor_view->isExport()) { ?>
<script>
var fcouncillorview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcouncillorview = currentForm = new ew.Form("fcouncillorview", "view");
	loadjs.done("fcouncillorview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$councillor_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $councillor_view->ExportOptions->render("body") ?>
<?php $councillor_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $councillor_view->showPageHeader(); ?>
<?php
$councillor_view->showMessage();
?>
<?php if (!$councillor_view->IsModal) { ?>
<?php if (!$councillor_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillor_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fcouncillorview" id="fcouncillorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor">
<input type="hidden" name="modal" value="<?php echo (int)$councillor_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($councillor_view->EmployeeID->Visible) { // EmployeeID ?>
	<tr id="r_EmployeeID">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_EmployeeID"><?php echo $councillor_view->EmployeeID->caption() ?></span></td>
		<td data-name="EmployeeID" <?php echo $councillor_view->EmployeeID->cellAttributes() ?>>
<span id="el_councillor_EmployeeID">
<span<?php echo $councillor_view->EmployeeID->viewAttributes() ?>><?php echo $councillor_view->EmployeeID->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->LACode->Visible) { // LACode ?>
	<tr id="r_LACode">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_LACode"><?php echo $councillor_view->LACode->caption() ?></span></td>
		<td data-name="LACode" <?php echo $councillor_view->LACode->cellAttributes() ?>>
<span id="el_councillor_LACode">
<span<?php echo $councillor_view->LACode->viewAttributes() ?>><?php echo $councillor_view->LACode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->NRC->Visible) { // NRC ?>
	<tr id="r_NRC">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_NRC"><?php echo $councillor_view->NRC->caption() ?></span></td>
		<td data-name="NRC" <?php echo $councillor_view->NRC->cellAttributes() ?>>
<span id="el_councillor_NRC">
<span<?php echo $councillor_view->NRC->viewAttributes() ?>><?php echo $councillor_view->NRC->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->Sex->Visible) { // Sex ?>
	<tr id="r_Sex">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_Sex"><?php echo $councillor_view->Sex->caption() ?></span></td>
		<td data-name="Sex" <?php echo $councillor_view->Sex->cellAttributes() ?>>
<span id="el_councillor_Sex">
<span<?php echo $councillor_view->Sex->viewAttributes() ?>><?php echo $councillor_view->Sex->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->Title->Visible) { // Title ?>
	<tr id="r_Title">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_Title"><?php echo $councillor_view->Title->caption() ?></span></td>
		<td data-name="Title" <?php echo $councillor_view->Title->cellAttributes() ?>>
<span id="el_councillor_Title">
<span<?php echo $councillor_view->Title->viewAttributes() ?>><?php echo $councillor_view->Title->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->Surname->Visible) { // Surname ?>
	<tr id="r_Surname">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_Surname"><?php echo $councillor_view->Surname->caption() ?></span></td>
		<td data-name="Surname" <?php echo $councillor_view->Surname->cellAttributes() ?>>
<span id="el_councillor_Surname">
<span<?php echo $councillor_view->Surname->viewAttributes() ?>><?php echo $councillor_view->Surname->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->FirstName->Visible) { // FirstName ?>
	<tr id="r_FirstName">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_FirstName"><?php echo $councillor_view->FirstName->caption() ?></span></td>
		<td data-name="FirstName" <?php echo $councillor_view->FirstName->cellAttributes() ?>>
<span id="el_councillor_FirstName">
<span<?php echo $councillor_view->FirstName->viewAttributes() ?>><?php echo $councillor_view->FirstName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->MiddleName->Visible) { // MiddleName ?>
	<tr id="r_MiddleName">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_MiddleName"><?php echo $councillor_view->MiddleName->caption() ?></span></td>
		<td data-name="MiddleName" <?php echo $councillor_view->MiddleName->cellAttributes() ?>>
<span id="el_councillor_MiddleName">
<span<?php echo $councillor_view->MiddleName->viewAttributes() ?>><?php echo $councillor_view->MiddleName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->MaritalStatus->Visible) { // MaritalStatus ?>
	<tr id="r_MaritalStatus">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_MaritalStatus"><?php echo $councillor_view->MaritalStatus->caption() ?></span></td>
		<td data-name="MaritalStatus" <?php echo $councillor_view->MaritalStatus->cellAttributes() ?>>
<span id="el_councillor_MaritalStatus">
<span<?php echo $councillor_view->MaritalStatus->viewAttributes() ?>><?php echo $councillor_view->MaritalStatus->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->DateOfBirth->Visible) { // DateOfBirth ?>
	<tr id="r_DateOfBirth">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_DateOfBirth"><?php echo $councillor_view->DateOfBirth->caption() ?></span></td>
		<td data-name="DateOfBirth" <?php echo $councillor_view->DateOfBirth->cellAttributes() ?>>
<span id="el_councillor_DateOfBirth">
<span<?php echo $councillor_view->DateOfBirth->viewAttributes() ?>><?php echo $councillor_view->DateOfBirth->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->CouncillorPhoto->Visible) { // CouncillorPhoto ?>
	<tr id="r_CouncillorPhoto">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_CouncillorPhoto"><?php echo $councillor_view->CouncillorPhoto->caption() ?></span></td>
		<td data-name="CouncillorPhoto" <?php echo $councillor_view->CouncillorPhoto->cellAttributes() ?>>
<span id="el_councillor_CouncillorPhoto">
<span<?php echo $councillor_view->CouncillorPhoto->viewAttributes() ?>><?php echo GetFileViewTag($councillor_view->CouncillorPhoto, $councillor_view->CouncillorPhoto->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->AcademicQualification->Visible) { // AcademicQualification ?>
	<tr id="r_AcademicQualification">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_AcademicQualification"><?php echo $councillor_view->AcademicQualification->caption() ?></span></td>
		<td data-name="AcademicQualification" <?php echo $councillor_view->AcademicQualification->cellAttributes() ?>>
<span id="el_councillor_AcademicQualification">
<span<?php echo $councillor_view->AcademicQualification->viewAttributes() ?>><?php echo $councillor_view->AcademicQualification->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
	<tr id="r_ProfessionalQualification">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_ProfessionalQualification"><?php echo $councillor_view->ProfessionalQualification->caption() ?></span></td>
		<td data-name="ProfessionalQualification" <?php echo $councillor_view->ProfessionalQualification->cellAttributes() ?>>
<span id="el_councillor_ProfessionalQualification">
<span<?php echo $councillor_view->ProfessionalQualification->viewAttributes() ?>><?php echo $councillor_view->ProfessionalQualification->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->PostalAddress->Visible) { // PostalAddress ?>
	<tr id="r_PostalAddress">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_PostalAddress"><?php echo $councillor_view->PostalAddress->caption() ?></span></td>
		<td data-name="PostalAddress" <?php echo $councillor_view->PostalAddress->cellAttributes() ?>>
<span id="el_councillor_PostalAddress">
<span<?php echo $councillor_view->PostalAddress->viewAttributes() ?>><?php echo $councillor_view->PostalAddress->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->TownOrVillage->Visible) { // TownOrVillage ?>
	<tr id="r_TownOrVillage">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_TownOrVillage"><?php echo $councillor_view->TownOrVillage->caption() ?></span></td>
		<td data-name="TownOrVillage" <?php echo $councillor_view->TownOrVillage->cellAttributes() ?>>
<span id="el_councillor_TownOrVillage">
<span<?php echo $councillor_view->TownOrVillage->viewAttributes() ?>><?php echo $councillor_view->TownOrVillage->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->Telephone->Visible) { // Telephone ?>
	<tr id="r_Telephone">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_Telephone"><?php echo $councillor_view->Telephone->caption() ?></span></td>
		<td data-name="Telephone" <?php echo $councillor_view->Telephone->cellAttributes() ?>>
<span id="el_councillor_Telephone">
<span<?php echo $councillor_view->Telephone->viewAttributes() ?>><?php echo $councillor_view->Telephone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->Mobile->Visible) { // Mobile ?>
	<tr id="r_Mobile">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_Mobile"><?php echo $councillor_view->Mobile->caption() ?></span></td>
		<td data-name="Mobile" <?php echo $councillor_view->Mobile->cellAttributes() ?>>
<span id="el_councillor_Mobile">
<span<?php echo $councillor_view->Mobile->viewAttributes() ?>><?php echo $councillor_view->Mobile->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->Fax->Visible) { // Fax ?>
	<tr id="r_Fax">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor_Fax"><?php echo $councillor_view->Fax->caption() ?></span></td>
		<td data-name="Fax" <?php echo $councillor_view->Fax->cellAttributes() ?>>
<span id="el_councillor_Fax">
<span<?php echo $councillor_view->Fax->viewAttributes() ?>><?php echo $councillor_view->Fax->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($councillor_view->_Email->Visible) { // Email ?>
	<tr id="r__Email">
		<td class="<?php echo $councillor_view->TableLeftColumnClass ?>"><span id="elh_councillor__Email"><?php echo $councillor_view->_Email->caption() ?></span></td>
		<td data-name="_Email" <?php echo $councillor_view->_Email->cellAttributes() ?>>
<span id="el_councillor__Email">
<span<?php echo $councillor_view->_Email->viewAttributes() ?>><?php echo $councillor_view->_Email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$councillor_view->IsModal) { ?>
<?php if (!$councillor_view->isExport()) { ?>
<?php echo $councillor_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
<?php
	if (in_array("councillorship", explode(",", $councillor->getCurrentDetailTable())) && $councillorship->DetailView) {
?>
<?php if ($councillor->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("councillorship", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "councillorshipgrid.php" ?>
<?php } ?>
</form>
<?php
$councillor_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$councillor_view->isExport()) { ?>
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
$councillor_view->terminate();
?>