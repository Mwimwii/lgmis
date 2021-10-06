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
$income_type_view = new income_type_view();

// Run the page
$income_type_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$income_type_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$income_type_view->isExport()) { ?>
<script>
var fincome_typeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fincome_typeview = currentForm = new ew.Form("fincome_typeview", "view");
	loadjs.done("fincome_typeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$income_type_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $income_type_view->ExportOptions->render("body") ?>
<?php $income_type_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $income_type_view->showPageHeader(); ?>
<?php
$income_type_view->showMessage();
?>
<?php if (!$income_type_view->IsModal) { ?>
<?php if (!$income_type_view->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $income_type_view->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fincome_typeview" id="fincome_typeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="income_type">
<input type="hidden" name="modal" value="<?php echo (int)$income_type_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($income_type_view->IncomeCode->Visible) { // IncomeCode ?>
	<tr id="r_IncomeCode">
		<td class="<?php echo $income_type_view->TableLeftColumnClass ?>"><span id="elh_income_type_IncomeCode"><?php echo $income_type_view->IncomeCode->caption() ?></span></td>
		<td data-name="IncomeCode" <?php echo $income_type_view->IncomeCode->cellAttributes() ?>>
<span id="el_income_type_IncomeCode">
<span<?php echo $income_type_view->IncomeCode->viewAttributes() ?>><?php echo $income_type_view->IncomeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($income_type_view->IncomeName->Visible) { // IncomeName ?>
	<tr id="r_IncomeName">
		<td class="<?php echo $income_type_view->TableLeftColumnClass ?>"><span id="elh_income_type_IncomeName"><?php echo $income_type_view->IncomeName->caption() ?></span></td>
		<td data-name="IncomeName" <?php echo $income_type_view->IncomeName->cellAttributes() ?>>
<span id="el_income_type_IncomeName">
<span<?php echo $income_type_view->IncomeName->viewAttributes() ?>><?php echo $income_type_view->IncomeName->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($income_type_view->IncomeDescription->Visible) { // IncomeDescription ?>
	<tr id="r_IncomeDescription">
		<td class="<?php echo $income_type_view->TableLeftColumnClass ?>"><span id="elh_income_type_IncomeDescription"><?php echo $income_type_view->IncomeDescription->caption() ?></span></td>
		<td data-name="IncomeDescription" <?php echo $income_type_view->IncomeDescription->cellAttributes() ?>>
<span id="el_income_type_IncomeDescription">
<span<?php echo $income_type_view->IncomeDescription->viewAttributes() ?>><?php echo $income_type_view->IncomeDescription->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($income_type_view->Division->Visible) { // Division ?>
	<tr id="r_Division">
		<td class="<?php echo $income_type_view->TableLeftColumnClass ?>"><span id="elh_income_type_Division"><?php echo $income_type_view->Division->caption() ?></span></td>
		<td data-name="Division" <?php echo $income_type_view->Division->cellAttributes() ?>>
<span id="el_income_type_Division">
<span<?php echo $income_type_view->Division->viewAttributes() ?>><?php echo $income_type_view->Division->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($income_type_view->IncomeAmount->Visible) { // IncomeAmount ?>
	<tr id="r_IncomeAmount">
		<td class="<?php echo $income_type_view->TableLeftColumnClass ?>"><span id="elh_income_type_IncomeAmount"><?php echo $income_type_view->IncomeAmount->caption() ?></span></td>
		<td data-name="IncomeAmount" <?php echo $income_type_view->IncomeAmount->cellAttributes() ?>>
<span id="el_income_type_IncomeAmount">
<span<?php echo $income_type_view->IncomeAmount->viewAttributes() ?>><?php echo $income_type_view->IncomeAmount->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($income_type_view->IncomeBasicRate->Visible) { // IncomeBasicRate ?>
	<tr id="r_IncomeBasicRate">
		<td class="<?php echo $income_type_view->TableLeftColumnClass ?>"><span id="elh_income_type_IncomeBasicRate"><?php echo $income_type_view->IncomeBasicRate->caption() ?></span></td>
		<td data-name="IncomeBasicRate" <?php echo $income_type_view->IncomeBasicRate->cellAttributes() ?>>
<span id="el_income_type_IncomeBasicRate">
<span<?php echo $income_type_view->IncomeBasicRate->viewAttributes() ?>><?php echo $income_type_view->IncomeBasicRate->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($income_type_view->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
	<tr id="r_BaseIncomeCode">
		<td class="<?php echo $income_type_view->TableLeftColumnClass ?>"><span id="elh_income_type_BaseIncomeCode"><?php echo $income_type_view->BaseIncomeCode->caption() ?></span></td>
		<td data-name="BaseIncomeCode" <?php echo $income_type_view->BaseIncomeCode->cellAttributes() ?>>
<span id="el_income_type_BaseIncomeCode">
<span<?php echo $income_type_view->BaseIncomeCode->viewAttributes() ?>><?php echo $income_type_view->BaseIncomeCode->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($income_type_view->Taxable->Visible) { // Taxable ?>
	<tr id="r_Taxable">
		<td class="<?php echo $income_type_view->TableLeftColumnClass ?>"><span id="elh_income_type_Taxable"><?php echo $income_type_view->Taxable->caption() ?></span></td>
		<td data-name="Taxable" <?php echo $income_type_view->Taxable->cellAttributes() ?>>
<span id="el_income_type_Taxable">
<span<?php echo $income_type_view->Taxable->viewAttributes() ?>><?php echo $income_type_view->Taxable->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($income_type_view->AccountNo->Visible) { // AccountNo ?>
	<tr id="r_AccountNo">
		<td class="<?php echo $income_type_view->TableLeftColumnClass ?>"><span id="elh_income_type_AccountNo"><?php echo $income_type_view->AccountNo->caption() ?></span></td>
		<td data-name="AccountNo" <?php echo $income_type_view->AccountNo->cellAttributes() ?>>
<span id="el_income_type_AccountNo">
<span<?php echo $income_type_view->AccountNo->viewAttributes() ?>><?php echo $income_type_view->AccountNo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($income_type_view->JobIncluded->Visible) { // JobIncluded ?>
	<tr id="r_JobIncluded">
		<td class="<?php echo $income_type_view->TableLeftColumnClass ?>"><span id="elh_income_type_JobIncluded"><?php echo $income_type_view->JobIncluded->caption() ?></span></td>
		<td data-name="JobIncluded" <?php echo $income_type_view->JobIncluded->cellAttributes() ?>>
<span id="el_income_type_JobIncluded">
<span<?php echo $income_type_view->JobIncluded->viewAttributes() ?>><?php echo $income_type_view->JobIncluded->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($income_type_view->Application->Visible) { // Application ?>
	<tr id="r_Application">
		<td class="<?php echo $income_type_view->TableLeftColumnClass ?>"><span id="elh_income_type_Application"><?php echo $income_type_view->Application->caption() ?></span></td>
		<td data-name="Application" <?php echo $income_type_view->Application->cellAttributes() ?>>
<span id="el_income_type_Application">
<span<?php echo $income_type_view->Application->viewAttributes() ?>><?php echo $income_type_view->Application->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($income_type_view->JobExcluded->Visible) { // JobExcluded ?>
	<tr id="r_JobExcluded">
		<td class="<?php echo $income_type_view->TableLeftColumnClass ?>"><span id="elh_income_type_JobExcluded"><?php echo $income_type_view->JobExcluded->caption() ?></span></td>
		<td data-name="JobExcluded" <?php echo $income_type_view->JobExcluded->cellAttributes() ?>>
<span id="el_income_type_JobExcluded">
<span<?php echo $income_type_view->JobExcluded->viewAttributes() ?>><?php echo $income_type_view->JobExcluded->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php if (!$income_type_view->IsModal) { ?>
<?php if (!$income_type_view->isExport()) { ?>
<?php echo $income_type_view->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$income_type_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$income_type_view->isExport()) { ?>
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
$income_type_view->terminate();
?>