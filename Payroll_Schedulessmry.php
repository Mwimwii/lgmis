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
$Payroll_Schedules_summary = new Payroll_Schedules_summary();

// Run the page
$Payroll_Schedules_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Payroll_Schedules_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Payroll_Schedules_summary->isExport() && !$Payroll_Schedules_summary->DrillDown && !$DashboardReport) { ?>
<script>
var fsummary, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	fsummary = currentForm = new ew.Form("fsummary", "summary");
	currentPageID = ew.PAGE_ID = "summary";

	// Validate function for search
	fsummary.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fsummary.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsummary.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fsummary.lists["x_PayrollPeriod"] = <?php echo $Payroll_Schedules_summary->PayrollPeriod->Lookup->toClientList($Payroll_Schedules_summary) ?>;
	fsummary.lists["x_PayrollPeriod"].options = <?php echo JsonEncode($Payroll_Schedules_summary->PayrollPeriod->lookupOptions()) ?>;
	fsummary.lists["x_pCode[]"] = <?php echo $Payroll_Schedules_summary->pCode->Lookup->toClientList($Payroll_Schedules_summary) ?>;
	fsummary.lists["x_pCode[]"].options = <?php echo JsonEncode($Payroll_Schedules_summary->pCode->lookupOptions()) ?>;
	fsummary.lists["x_PaymentMethod"] = <?php echo $Payroll_Schedules_summary->PaymentMethod->Lookup->toClientList($Payroll_Schedules_summary) ?>;
	fsummary.lists["x_PaymentMethod"].options = <?php echo JsonEncode($Payroll_Schedules_summary->PaymentMethod->lookupOptions()) ?>;
	fsummary.lists["x_BankBranchCode"] = <?php echo $Payroll_Schedules_summary->BankBranchCode->Lookup->toClientList($Payroll_Schedules_summary) ?>;
	fsummary.lists["x_BankBranchCode"].options = <?php echo JsonEncode($Payroll_Schedules_summary->BankBranchCode->lookupOptions()) ?>;
	fsummary.lists["x_ThirdPartyPayMethod"] = <?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->Lookup->toClientList($Payroll_Schedules_summary) ?>;
	fsummary.lists["x_ThirdPartyPayMethod"].options = <?php echo JsonEncode($Payroll_Schedules_summary->ThirdPartyPayMethod->lookupOptions()) ?>;
	fsummary.lists["x_ThirdPartyBank"] = <?php echo $Payroll_Schedules_summary->ThirdPartyBank->Lookup->toClientList($Payroll_Schedules_summary) ?>;
	fsummary.lists["x_ThirdPartyBank"].options = <?php echo JsonEncode($Payroll_Schedules_summary->ThirdPartyBank->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $Payroll_Schedules_summary->getFilterList() ?>;

	// Init search panel as collapsed
	fsummary.initSearchPanel = true;
	loadjs.done("fsummary");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Payroll_Schedules_summary->isExport() || $Payroll_Schedules_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Payroll_Schedules_summary->ShowCurrentFilter) { ?>
<?php $Payroll_Schedules_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Payroll_Schedules_summary->DrillDownInPanel) {
	$Payroll_Schedules_summary->ExportOptions->render("body");
	$Payroll_Schedules_summary->SearchOptions->render("body");
	$Payroll_Schedules_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Payroll_Schedules_summary->showPageHeader(); ?>
<?php
$Payroll_Schedules_summary->showMessage();
?>
<?php if ((!$Payroll_Schedules_summary->isExport() || $Payroll_Schedules_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Payroll_Schedules_summary->isExport() || $Payroll_Schedules_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Payroll_Schedules_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$Payroll_Schedules_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$Payroll_Schedules_summary->isExport() && !$Payroll_Schedules_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Payroll_Schedules_summary->isExport() && !$Payroll_Schedules->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Payroll_Schedules_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Payroll_Schedules">
	<div class="ew-extended-search">
<?php

// Render search row
$Payroll_Schedules->RowType = ROWTYPE_SEARCH;
$Payroll_Schedules->resetAttributes();
$Payroll_Schedules_summary->renderRow();
?>
<?php if ($Payroll_Schedules_summary->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php
		$Payroll_Schedules_summary->SearchColumnCount++;
		if (($Payroll_Schedules_summary->SearchColumnCount - 1) % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) {
			$Payroll_Schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LocalAuthority" class="ew-cell form-group">
		<label for="x_LocalAuthority" class="ew-search-caption ew-label"><?php echo $Payroll_Schedules_summary->LocalAuthority->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		<span id="el_Payroll_Schedules_LocalAuthority" class="ew-search-field">
<input type="text" data-table="Payroll_Schedules" data-field="x_LocalAuthority" name="x_LocalAuthority" id="x_LocalAuthority" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($Payroll_Schedules_summary->LocalAuthority->getPlaceHolder()) ?>" value="<?php echo $Payroll_Schedules_summary->LocalAuthority->EditValue ?>"<?php echo $Payroll_Schedules_summary->LocalAuthority->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payroll_Schedules_summary->SearchColumnCount % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php
		$Payroll_Schedules_summary->SearchColumnCount++;
		if (($Payroll_Schedules_summary->SearchColumnCount - 1) % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) {
			$Payroll_Schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PayrollPeriod" class="ew-cell form-group">
		<label for="x_PayrollPeriod" class="ew-search-caption ew-label"><?php echo $Payroll_Schedules_summary->PayrollPeriod->caption() ?></label>
		<span id="el_Payroll_Schedules_PayrollPeriod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Payroll_Schedules" data-field="x_PayrollPeriod" data-value-separator="<?php echo $Payroll_Schedules_summary->PayrollPeriod->displayValueSeparatorAttribute() ?>" id="x_PayrollPeriod" name="x_PayrollPeriod"<?php echo $Payroll_Schedules_summary->PayrollPeriod->editAttributes() ?>>
			<?php echo $Payroll_Schedules_summary->PayrollPeriod->selectOptionListHtml("x_PayrollPeriod") ?>
		</select>
</div>
<?php echo $Payroll_Schedules_summary->PayrollPeriod->Lookup->getParamTag($Payroll_Schedules_summary, "p_x_PayrollPeriod") ?>
</span>
	</div>
	<?php if ($Payroll_Schedules_summary->SearchColumnCount % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Surname->Visible) { // Surname ?>
	<?php
		$Payroll_Schedules_summary->SearchColumnCount++;
		if (($Payroll_Schedules_summary->SearchColumnCount - 1) % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) {
			$Payroll_Schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Surname" class="ew-cell form-group">
		<label for="x_Surname" class="ew-search-caption ew-label"><?php echo $Payroll_Schedules_summary->Surname->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		<span id="el_Payroll_Schedules_Surname" class="ew-search-field">
<input type="text" data-table="Payroll_Schedules" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Payroll_Schedules_summary->Surname->getPlaceHolder()) ?>" value="<?php echo $Payroll_Schedules_summary->Surname->EditValue ?>"<?php echo $Payroll_Schedules_summary->Surname->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payroll_Schedules_summary->SearchColumnCount % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PositionName->Visible) { // PositionName ?>
	<?php
		$Payroll_Schedules_summary->SearchColumnCount++;
		if (($Payroll_Schedules_summary->SearchColumnCount - 1) % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) {
			$Payroll_Schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PositionName" class="ew-cell form-group">
		<label for="x_PositionName" class="ew-search-caption ew-label"><?php echo $Payroll_Schedules_summary->PositionName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PositionName" id="z_PositionName" value="LIKE">
</span>
		<span id="el_Payroll_Schedules_PositionName" class="ew-search-field">
<input type="text" data-table="Payroll_Schedules" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Payroll_Schedules_summary->PositionName->getPlaceHolder()) ?>" value="<?php echo $Payroll_Schedules_summary->PositionName->EditValue ?>"<?php echo $Payroll_Schedules_summary->PositionName->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payroll_Schedules_summary->SearchColumnCount % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->pCode->Visible) { // pCode ?>
	<?php
		$Payroll_Schedules_summary->SearchColumnCount++;
		if (($Payroll_Schedules_summary->SearchColumnCount - 1) % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) {
			$Payroll_Schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_pCode" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $Payroll_Schedules_summary->pCode->caption() ?></label>
		<span id="el_Payroll_Schedules_pCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pCode"><?php echo EmptyValue(strval($Payroll_Schedules_summary->pCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Payroll_Schedules_summary->pCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($Payroll_Schedules_summary->pCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($Payroll_Schedules_summary->pCode->ReadOnly || $Payroll_Schedules_summary->pCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $Payroll_Schedules_summary->pCode->Lookup->getParamTag($Payroll_Schedules_summary, "p_x_pCode") ?>
<input type="hidden" data-table="Payroll_Schedules" data-field="x_pCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $Payroll_Schedules_summary->pCode->displayValueSeparatorAttribute() ?>" name="x_pCode[]" id="x_pCode[]" value="<?php echo $Payroll_Schedules_summary->pCode->AdvancedSearch->SearchValue ?>"<?php echo $Payroll_Schedules_summary->pCode->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payroll_Schedules_summary->SearchColumnCount % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->pName->Visible) { // pName ?>
	<?php
		$Payroll_Schedules_summary->SearchColumnCount++;
		if (($Payroll_Schedules_summary->SearchColumnCount - 1) % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) {
			$Payroll_Schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_pName" class="ew-cell form-group">
		<label for="x_pName" class="ew-search-caption ew-label"><?php echo $Payroll_Schedules_summary->pName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pName" id="z_pName" value="LIKE">
</span>
		<span id="el_Payroll_Schedules_pName" class="ew-search-field">
<input type="text" data-table="Payroll_Schedules" data-field="x_pName" name="x_pName" id="x_pName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Payroll_Schedules_summary->pName->getPlaceHolder()) ?>" value="<?php echo $Payroll_Schedules_summary->pName->EditValue ?>"<?php echo $Payroll_Schedules_summary->pName->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payroll_Schedules_summary->SearchColumnCount % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php
		$Payroll_Schedules_summary->SearchColumnCount++;
		if (($Payroll_Schedules_summary->SearchColumnCount - 1) % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) {
			$Payroll_Schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PaymentMethod" class="ew-cell form-group">
		<label for="x_PaymentMethod" class="ew-search-caption ew-label"><?php echo $Payroll_Schedules_summary->PaymentMethod->caption() ?></label>
		<span id="el_Payroll_Schedules_PaymentMethod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Payroll_Schedules" data-field="x_PaymentMethod" data-value-separator="<?php echo $Payroll_Schedules_summary->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x_PaymentMethod" name="x_PaymentMethod"<?php echo $Payroll_Schedules_summary->PaymentMethod->editAttributes() ?>>
			<?php echo $Payroll_Schedules_summary->PaymentMethod->selectOptionListHtml("x_PaymentMethod") ?>
		</select>
</div>
<?php echo $Payroll_Schedules_summary->PaymentMethod->Lookup->getParamTag($Payroll_Schedules_summary, "p_x_PaymentMethod") ?>
</span>
	</div>
	<?php if ($Payroll_Schedules_summary->SearchColumnCount % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankBranchCode->Visible) { // BankBranchCode ?>
	<?php
		$Payroll_Schedules_summary->SearchColumnCount++;
		if (($Payroll_Schedules_summary->SearchColumnCount - 1) % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) {
			$Payroll_Schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_BankBranchCode" class="ew-cell form-group">
		<label for="x_BankBranchCode" class="ew-search-caption ew-label"><?php echo $Payroll_Schedules_summary->BankBranchCode->caption() ?></label>
		<span id="el_Payroll_Schedules_BankBranchCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Payroll_Schedules" data-field="x_BankBranchCode" data-value-separator="<?php echo $Payroll_Schedules_summary->BankBranchCode->displayValueSeparatorAttribute() ?>" id="x_BankBranchCode" name="x_BankBranchCode"<?php echo $Payroll_Schedules_summary->BankBranchCode->editAttributes() ?>>
			<?php echo $Payroll_Schedules_summary->BankBranchCode->selectOptionListHtml("x_BankBranchCode") ?>
		</select>
</div>
<?php echo $Payroll_Schedules_summary->BankBranchCode->Lookup->getParamTag($Payroll_Schedules_summary, "p_x_BankBranchCode") ?>
</span>
	</div>
	<?php if ($Payroll_Schedules_summary->SearchColumnCount % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyPayMethod->Visible) { // ThirdPartyPayMethod ?>
	<?php
		$Payroll_Schedules_summary->SearchColumnCount++;
		if (($Payroll_Schedules_summary->SearchColumnCount - 1) % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) {
			$Payroll_Schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ThirdPartyPayMethod" class="ew-cell form-group">
		<label for="x_ThirdPartyPayMethod" class="ew-search-caption ew-label"><?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->caption() ?></label>
		<span id="el_Payroll_Schedules_ThirdPartyPayMethod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Payroll_Schedules" data-field="x_ThirdPartyPayMethod" data-value-separator="<?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->displayValueSeparatorAttribute() ?>" id="x_ThirdPartyPayMethod" name="x_ThirdPartyPayMethod"<?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->editAttributes() ?>>
			<?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->selectOptionListHtml("x_ThirdPartyPayMethod") ?>
		</select>
</div>
<?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->Lookup->getParamTag($Payroll_Schedules_summary, "p_x_ThirdPartyPayMethod") ?>
</span>
	</div>
	<?php if ($Payroll_Schedules_summary->SearchColumnCount % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyBank->Visible) { // ThirdPartyBank ?>
	<?php
		$Payroll_Schedules_summary->SearchColumnCount++;
		if (($Payroll_Schedules_summary->SearchColumnCount - 1) % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) {
			$Payroll_Schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ThirdPartyBank" class="ew-cell form-group">
		<label for="x_ThirdPartyBank" class="ew-search-caption ew-label"><?php echo $Payroll_Schedules_summary->ThirdPartyBank->caption() ?></label>
		<span id="el_Payroll_Schedules_ThirdPartyBank" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Payroll_Schedules" data-field="x_ThirdPartyBank" data-value-separator="<?php echo $Payroll_Schedules_summary->ThirdPartyBank->displayValueSeparatorAttribute() ?>" id="x_ThirdPartyBank" name="x_ThirdPartyBank"<?php echo $Payroll_Schedules_summary->ThirdPartyBank->editAttributes() ?>>
			<?php echo $Payroll_Schedules_summary->ThirdPartyBank->selectOptionListHtml("x_ThirdPartyBank") ?>
		</select>
</div>
<?php echo $Payroll_Schedules_summary->ThirdPartyBank->Lookup->getParamTag($Payroll_Schedules_summary, "p_x_ThirdPartyBank") ?>
</span>
	</div>
	<?php if ($Payroll_Schedules_summary->SearchColumnCount % $Payroll_Schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Payroll_Schedules_summary->SearchColumnCount % $Payroll_Schedules_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Payroll_Schedules_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Payroll_Schedules_summary->GroupCount <= count($Payroll_Schedules_summary->GroupRecords) && $Payroll_Schedules_summary->GroupCount <= $Payroll_Schedules_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Payroll_Schedules_summary->ShowHeader) {
?>
<?php if ($Payroll_Schedules_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$Payroll_Schedules_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Payroll_Schedules_summary->TotalGroups > 0) { ?>
<?php if (!$Payroll_Schedules_summary->isExport() && !($Payroll_Schedules_summary->DrillDown && $Payroll_Schedules_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payroll_Schedules_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Payroll_Schedules_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $Payroll_Schedules_summary->PageBreakContent ?>
<?php } ?>
<?php if (!$Payroll_Schedules_summary->isExport("pdf")) { ?>
<div class="<?php if (!$Payroll_Schedules_summary->isExport("word") && !$Payroll_Schedules_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Payroll_Schedules_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Payroll_Schedules_summary->isExport() && !($Payroll_Schedules_summary->DrillDown && $Payroll_Schedules_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payroll_Schedules_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Payroll_Schedules_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Payroll_Schedules" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Payroll_Schedules_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Payroll_Schedules_summary->LocalAuthority->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
	<th data-name="LocalAuthority">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->LocalAuthority) == "") { ?>
	<th data-name="LocalAuthority" class="<?php echo $Payroll_Schedules_summary->LocalAuthority->headerCellClass() ?>"><div class="Payroll_Schedules_LocalAuthority"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->LocalAuthority->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="LocalAuthority" class="<?php echo $Payroll_Schedules_summary->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->LocalAuthority) ?>', 1);"><div class="Payroll_Schedules_LocalAuthority">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PayrollPeriod->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
	<th data-name="PayrollPeriod">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->PayrollPeriod) == "") { ?>
	<th data-name="PayrollPeriod" class="<?php echo $Payroll_Schedules_summary->PayrollPeriod->headerCellClass() ?>"><div class="Payroll_Schedules_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->PayrollPeriod->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="PayrollPeriod" class="<?php echo $Payroll_Schedules_summary->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->PayrollPeriod) ?>', 1);"><div class="Payroll_Schedules_PayrollPeriod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->pName->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->pName->ShowGroupHeaderAsRow) { ?>
	<th data-name="pName">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->pName) == "") { ?>
	<th data-name="pName" class="<?php echo $Payroll_Schedules_summary->pName->headerCellClass() ?>"><div class="Payroll_Schedules_pName"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->pName->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="pName" class="<?php echo $Payroll_Schedules_summary->pName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->pName) ?>', 1);"><div class="Payroll_Schedules_pName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->pName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->pName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->pName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Title->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->Title) == "") { ?>
	<th data-name="Title" class="<?php echo $Payroll_Schedules_summary->Title->headerCellClass() ?>"><div class="Payroll_Schedules_Title"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->Title->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Title" class="<?php echo $Payroll_Schedules_summary->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->Title) ?>', 1);"><div class="Payroll_Schedules_Title">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->Title->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Surname->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->Surname) == "") { ?>
	<th data-name="Surname" class="<?php echo $Payroll_Schedules_summary->Surname->headerCellClass() ?>"><div class="Payroll_Schedules_Surname"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->Surname->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Surname" class="<?php echo $Payroll_Schedules_summary->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->Surname) ?>', 1);"><div class="Payroll_Schedules_Surname">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->FirstName->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->FirstName) == "") { ?>
	<th data-name="FirstName" class="<?php echo $Payroll_Schedules_summary->FirstName->headerCellClass() ?>"><div class="Payroll_Schedules_FirstName"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FirstName" class="<?php echo $Payroll_Schedules_summary->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->FirstName) ?>', 1);"><div class="Payroll_Schedules_FirstName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->MiddleName->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->MiddleName) == "") { ?>
	<th data-name="MiddleName" class="<?php echo $Payroll_Schedules_summary->MiddleName->headerCellClass() ?>"><div class="Payroll_Schedules_MiddleName"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MiddleName" class="<?php echo $Payroll_Schedules_summary->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->MiddleName) ?>', 1);"><div class="Payroll_Schedules_MiddleName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PositionName->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->PositionName) == "") { ?>
	<th data-name="PositionName" class="<?php echo $Payroll_Schedules_summary->PositionName->headerCellClass() ?>"><div class="Payroll_Schedules_PositionName"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PositionName" class="<?php echo $Payroll_Schedules_summary->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->PositionName) ?>', 1);"><div class="Payroll_Schedules_PositionName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->pCode->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->pCode) == "") { ?>
	<th data-name="pCode" class="<?php echo $Payroll_Schedules_summary->pCode->headerCellClass() ?>"><div class="Payroll_Schedules_pCode"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->pCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="pCode" class="<?php echo $Payroll_Schedules_summary->pCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->pCode) ?>', 1);"><div class="Payroll_Schedules_pCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->pCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->pCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->pCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Amount->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->Amount) == "") { ?>
	<th data-name="Amount" class="<?php echo $Payroll_Schedules_summary->Amount->headerCellClass() ?>"><div class="Payroll_Schedules_Amount"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->Amount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Amount" class="<?php echo $Payroll_Schedules_summary->Amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->Amount) ?>', 1);"><div class="Payroll_Schedules_Amount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->Amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->Amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PaymentMethod->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->PaymentMethod) == "") { ?>
	<th data-name="PaymentMethod" class="<?php echo $Payroll_Schedules_summary->PaymentMethod->headerCellClass() ?>"><div class="Payroll_Schedules_PaymentMethod"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PaymentMethod" class="<?php echo $Payroll_Schedules_summary->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->PaymentMethod) ?>', 1);"><div class="Payroll_Schedules_PaymentMethod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankBranchCode->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->BankBranchCode) == "") { ?>
	<th data-name="BankBranchCode" class="<?php echo $Payroll_Schedules_summary->BankBranchCode->headerCellClass() ?>"><div class="Payroll_Schedules_BankBranchCode"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->BankBranchCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="BankBranchCode" class="<?php echo $Payroll_Schedules_summary->BankBranchCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->BankBranchCode) ?>', 1);"><div class="Payroll_Schedules_BankBranchCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->BankBranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->BankBranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->BankBranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankAccountNo->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->BankAccountNo) == "") { ?>
	<th data-name="BankAccountNo" class="<?php echo $Payroll_Schedules_summary->BankAccountNo->headerCellClass() ?>"><div class="Payroll_Schedules_BankAccountNo"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="BankAccountNo" class="<?php echo $Payroll_Schedules_summary->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->BankAccountNo) ?>', 1);"><div class="Payroll_Schedules_BankAccountNo">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->BankAccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyPayMethod->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->ThirdPartyPayMethod) == "") { ?>
	<th data-name="ThirdPartyPayMethod" class="<?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->headerCellClass() ?>"><div class="Payroll_Schedules_ThirdPartyPayMethod"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ThirdPartyPayMethod" class="<?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->ThirdPartyPayMethod) ?>', 1);"><div class="Payroll_Schedules_ThirdPartyPayMethod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->ThirdPartyPayMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->ThirdPartyPayMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyBank->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->ThirdPartyBank) == "") { ?>
	<th data-name="ThirdPartyBank" class="<?php echo $Payroll_Schedules_summary->ThirdPartyBank->headerCellClass() ?>"><div class="Payroll_Schedules_ThirdPartyBank"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->ThirdPartyBank->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ThirdPartyBank" class="<?php echo $Payroll_Schedules_summary->ThirdPartyBank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->ThirdPartyBank) ?>', 1);"><div class="Payroll_Schedules_ThirdPartyBank">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->ThirdPartyBank->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->ThirdPartyBank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->ThirdPartyBank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyAccount->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->ThirdPartyAccount) == "") { ?>
	<th data-name="ThirdPartyAccount" class="<?php echo $Payroll_Schedules_summary->ThirdPartyAccount->headerCellClass() ?>"><div class="Payroll_Schedules_ThirdPartyAccount"><div class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->ThirdPartyAccount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ThirdPartyAccount" class="<?php echo $Payroll_Schedules_summary->ThirdPartyAccount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->ThirdPartyAccount) ?>', 1);"><div class="Payroll_Schedules_ThirdPartyAccount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->ThirdPartyAccount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->ThirdPartyAccount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->ThirdPartyAccount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Payroll_Schedules_summary->TotalGroups == 0)
			break; // Show header only
		$Payroll_Schedules_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Payroll_Schedules_summary->LocalAuthority, $Payroll_Schedules_summary->getSqlFirstGroupField(), $Payroll_Schedules_summary->LocalAuthority->groupValue(), $Payroll_Schedules_summary->Dbid);
	if ($Payroll_Schedules_summary->PageFirstGroupFilter != "") $Payroll_Schedules_summary->PageFirstGroupFilter .= " OR ";
	$Payroll_Schedules_summary->PageFirstGroupFilter .= $where;
	if ($Payroll_Schedules_summary->Filter != "")
		$where = "($Payroll_Schedules_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Payroll_Schedules_summary->getSqlSelect(), $Payroll_Schedules_summary->getSqlWhere(), $Payroll_Schedules_summary->getSqlGroupBy(), $Payroll_Schedules_summary->getSqlHaving(), $Payroll_Schedules_summary->getSqlOrderBy(), $where, $Payroll_Schedules_summary->Sort);
	$rs = $Payroll_Schedules_summary->getRecordset($sql);
	$Payroll_Schedules_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Payroll_Schedules_summary->DetailRecordCount = count($Payroll_Schedules_summary->DetailRecords);

	// Load detail records
	$Payroll_Schedules_summary->LocalAuthority->Records = &$Payroll_Schedules_summary->DetailRecords;
	$Payroll_Schedules_summary->LocalAuthority->LevelBreak = TRUE; // Set field level break
		$Payroll_Schedules_summary->GroupCounter[1] = $Payroll_Schedules_summary->GroupCount;
		$Payroll_Schedules_summary->LocalAuthority->getCnt($Payroll_Schedules_summary->LocalAuthority->Records); // Get record count
?>
<?php if ($Payroll_Schedules_summary->LocalAuthority->Visible && $Payroll_Schedules_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payroll_Schedules_summary->resetAttributes();
		$Payroll_Schedules_summary->RowType = ROWTYPE_TOTAL;
		$Payroll_Schedules_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payroll_Schedules_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payroll_Schedules_summary->RowGroupLevel = 1;
		$Payroll_Schedules_summary->renderRow();
?>
	<tr<?php echo $Payroll_Schedules_summary->rowAttributes(); ?>>
<?php if ($Payroll_Schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Schedules_summary->LocalAuthority->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="LocalAuthority" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Payroll_Schedules_summary->LocalAuthority->cellAttributes() ?>>
<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->LocalAuthority) == "") { ?>
		<span class="ew-summary-caption Payroll_Schedules_LocalAuthority"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->LocalAuthority->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payroll_Schedules_LocalAuthority" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->LocalAuthority) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->LocalAuthority->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payroll_Schedules_summary->LocalAuthority->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->LocalAuthority->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Schedules_summary->LocalAuthority->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payroll_Schedules_summary->PayrollPeriod->getDistinctValues($Payroll_Schedules_summary->LocalAuthority->Records);
	$Payroll_Schedules_summary->setGroupCount(count($Payroll_Schedules_summary->PayrollPeriod->DistinctValues), $Payroll_Schedules_summary->GroupCounter[1]);
	$Payroll_Schedules_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($Payroll_Schedules_summary->PayrollPeriod->DistinctValues as $PayrollPeriod) { // Load records for this distinct value
		$Payroll_Schedules_summary->PayrollPeriod->setGroupValue($PayrollPeriod); // Set group value
		$Payroll_Schedules_summary->PayrollPeriod->getDistinctRecords($Payroll_Schedules_summary->LocalAuthority->Records, $Payroll_Schedules_summary->PayrollPeriod->groupValue());
		$Payroll_Schedules_summary->PayrollPeriod->LevelBreak = TRUE; // Set field level break
		$Payroll_Schedules_summary->GroupCounter[2]++;
		$Payroll_Schedules_summary->PayrollPeriod->getCnt($Payroll_Schedules_summary->PayrollPeriod->Records); // Get record count
?>
<?php if ($Payroll_Schedules_summary->PayrollPeriod->Visible && $Payroll_Schedules_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payroll_Schedules_summary->PayrollPeriod->setDbValue($PayrollPeriod); // Set current value for PayrollPeriod
		$Payroll_Schedules_summary->resetAttributes();
		$Payroll_Schedules_summary->RowType = ROWTYPE_TOTAL;
		$Payroll_Schedules_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payroll_Schedules_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payroll_Schedules_summary->RowGroupLevel = 2;
		$Payroll_Schedules_summary->renderRow();
?>
	<tr<?php echo $Payroll_Schedules_summary->rowAttributes(); ?>>
<?php if ($Payroll_Schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Schedules_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Schedules_summary->PayrollPeriod->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="PayrollPeriod" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $Payroll_Schedules_summary->PayrollPeriod->cellAttributes() ?>>
<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->PayrollPeriod) == "") { ?>
		<span class="ew-summary-caption Payroll_Schedules_PayrollPeriod"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->PayrollPeriod->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payroll_Schedules_PayrollPeriod" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->PayrollPeriod) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->PayrollPeriod->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payroll_Schedules_summary->PayrollPeriod->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->PayrollPeriod->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Schedules_summary->PayrollPeriod->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payroll_Schedules_summary->pName->getDistinctValues($Payroll_Schedules_summary->PayrollPeriod->Records);
	$Payroll_Schedules_summary->setGroupCount(count($Payroll_Schedules_summary->pName->DistinctValues), $Payroll_Schedules_summary->GroupCounter[1], $Payroll_Schedules_summary->GroupCounter[2]);
	$Payroll_Schedules_summary->GroupCounter[3] = 0; // Init group count index
	foreach ($Payroll_Schedules_summary->pName->DistinctValues as $pName) { // Load records for this distinct value
		$Payroll_Schedules_summary->pName->setGroupValue($pName); // Set group value
		$Payroll_Schedules_summary->pName->getDistinctRecords($Payroll_Schedules_summary->PayrollPeriod->Records, $Payroll_Schedules_summary->pName->groupValue());
		$Payroll_Schedules_summary->pName->LevelBreak = TRUE; // Set field level break
		$Payroll_Schedules_summary->GroupCounter[3]++;
		$Payroll_Schedules_summary->pName->getCnt($Payroll_Schedules_summary->pName->Records); // Get record count
		$Payroll_Schedules_summary->setGroupCount($Payroll_Schedules_summary->pName->Count, $Payroll_Schedules_summary->GroupCounter[1], $Payroll_Schedules_summary->GroupCounter[2], $Payroll_Schedules_summary->GroupCounter[3]);
?>
<?php if ($Payroll_Schedules_summary->pName->Visible && $Payroll_Schedules_summary->pName->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payroll_Schedules_summary->pName->setDbValue($pName); // Set current value for pName
		$Payroll_Schedules_summary->resetAttributes();
		$Payroll_Schedules_summary->RowType = ROWTYPE_TOTAL;
		$Payroll_Schedules_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payroll_Schedules_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payroll_Schedules_summary->RowGroupLevel = 3;
		$Payroll_Schedules_summary->renderRow();
?>
	<tr<?php echo $Payroll_Schedules_summary->rowAttributes(); ?>>
<?php if ($Payroll_Schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Schedules_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Schedules_summary->PayrollPeriod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payroll_Schedules_summary->pName->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="pName" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 3) ?>"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>
<?php if ($Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->pName) == "") { ?>
		<span class="ew-summary-caption Payroll_Schedules_pName"><span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->pName->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payroll_Schedules_pName" onclick="ew.sort(event, '<?php echo $Payroll_Schedules_summary->sortUrl($Payroll_Schedules_summary->pName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payroll_Schedules_summary->pName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payroll_Schedules_summary->pName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Schedules_summary->pName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payroll_Schedules_summary->pName->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->pName->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Schedules_summary->pName->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payroll_Schedules_summary->RecordCount = 0; // Reset record count
	foreach ($Payroll_Schedules_summary->pName->Records as $record) {
		$Payroll_Schedules_summary->RecordCount++;
		$Payroll_Schedules_summary->RecordIndex++;
		$Payroll_Schedules_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Payroll_Schedules_summary->resetAttributes();
		$Payroll_Schedules_summary->RowType = ROWTYPE_DETAIL;
		$Payroll_Schedules_summary->renderRow();
?>
	<tr<?php echo $Payroll_Schedules_summary->rowAttributes(); ?>>
<?php if ($Payroll_Schedules_summary->LocalAuthority->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Schedules_summary->LocalAuthority->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Schedules_summary->LocalAuthority->cellAttributes(); ?>><span<?php echo $Payroll_Schedules_summary->LocalAuthority->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->LocalAuthority->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PayrollPeriod->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Schedules_summary->PayrollPeriod->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Schedules_summary->PayrollPeriod->cellAttributes(); ?>><span<?php echo $Payroll_Schedules_summary->PayrollPeriod->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->PayrollPeriod->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->pName->Visible) { ?>
	<?php if ($Payroll_Schedules_summary->pName->ShowGroupHeaderAsRow) { ?>
		<td data-field="pName"<?php echo $Payroll_Schedules_summary->pName->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="pName"<?php echo $Payroll_Schedules_summary->pName->cellAttributes(); ?>><span<?php echo $Payroll_Schedules_summary->pName->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->pName->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Schedules_summary->Title->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->Title->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->Title->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Schedules_summary->Surname->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->Surname->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->Surname->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Schedules_summary->FirstName->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->FirstName->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->FirstName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Schedules_summary->MiddleName->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->MiddleName->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->MiddleName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Schedules_summary->PositionName->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->PositionName->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->PositionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payroll_Schedules_summary->pCode->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->pCode->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->pCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payroll_Schedules_summary->Amount->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->Amount->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->Amount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Schedules_summary->PaymentMethod->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->PaymentMethod->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->PaymentMethod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Schedules_summary->BankBranchCode->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->BankBranchCode->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->BankBranchCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Schedules_summary->BankAccountNo->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->BankAccountNo->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->BankAccountNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Payroll_Schedules_summary->ThirdPartyBank->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->ThirdPartyBank->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->ThirdPartyBank->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Payroll_Schedules_summary->ThirdPartyAccount->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->ThirdPartyAccount->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->ThirdPartyAccount->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Payroll_Schedules_summary->TotalGroups > 0) { ?>
<?php
	$Payroll_Schedules_summary->Amount->getSum($Payroll_Schedules_summary->pName->Records); // Get Sum
	$Payroll_Schedules_summary->resetAttributes();
	$Payroll_Schedules_summary->RowType = ROWTYPE_TOTAL;
	$Payroll_Schedules_summary->RowTotalType = ROWTOTAL_GROUP;
	$Payroll_Schedules_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Payroll_Schedules_summary->RowGroupLevel = 3;
	$Payroll_Schedules_summary->renderRow();
?>
<?php if ($Payroll_Schedules_summary->pName->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Payroll_Schedules_summary->rowAttributes(); ?>>
<?php if ($Payroll_Schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Schedules_summary->LocalAuthority->cellAttributes() ?>>
	<?php if ($Payroll_Schedules_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Schedules_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Schedules_summary->LocalAuthority->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Schedules_summary->PayrollPeriod->cellAttributes() ?>>
	<?php if ($Payroll_Schedules_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Schedules_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Schedules_summary->PayrollPeriod->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>
	<?php if ($Payroll_Schedules_summary->pName->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Schedules_summary->RowGroupLevel != 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Schedules_summary->pName->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Payroll_Schedules_summary->Amount->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->Amount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Payroll_Schedules_summary->rowAttributes(); ?>>
<?php if ($Payroll_Schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Schedules_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Schedules_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->SubGroupColumnCount + $Payroll_Schedules_summary->DetailColumnCount - 1 > 0) { ?>
		<td colspan="<?php echo ($Payroll_Schedules_summary->SubGroupColumnCount + $Payroll_Schedules_summary->DetailColumnCount - 1) ?>"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Payroll_Schedules_summary->pName->GroupViewValue, $Payroll_Schedules_summary->pName->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Payroll_Schedules_summary->pName->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Payroll_Schedules_summary->rowAttributes(); ?>>
<?php if ($Payroll_Schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Schedules_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Schedules_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Payroll_Schedules_summary->GroupColumnCount - 2) ?>"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payroll_Schedules_summary->Amount->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->Amount->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->Amount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Payroll_Schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	} // End group level 2
	} // End group level 1
?>
<?php

	// Next group
	$Payroll_Schedules_summary->loadGroupRowValues();

	// Show header if page break
	if ($Payroll_Schedules_summary->isExport())
		$Payroll_Schedules_summary->ShowHeader = ($Payroll_Schedules_summary->ExportPageBreakCount == 0) ? FALSE : ($Payroll_Schedules_summary->GroupCount % $Payroll_Schedules_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Payroll_Schedules_summary->ShowHeader)
		$Payroll_Schedules_summary->Page_Breaking($Payroll_Schedules_summary->ShowHeader, $Payroll_Schedules_summary->PageBreakContent);
	$Payroll_Schedules_summary->GroupCount++;
} // End while
?>
<?php if ($Payroll_Schedules_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Payroll_Schedules_summary->resetAttributes();
	$Payroll_Schedules_summary->RowType = ROWTYPE_TOTAL;
	$Payroll_Schedules_summary->RowTotalType = ROWTOTAL_GRAND;
	$Payroll_Schedules_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Payroll_Schedules_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Payroll_Schedules_summary->renderRow();
?>
<?php if ($Payroll_Schedules_summary->LocalAuthority->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Payroll_Schedules_summary->rowAttributes() ?>><td colspan="<?php echo ($Payroll_Schedules_summary->GroupColumnCount + $Payroll_Schedules_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Schedules_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Payroll_Schedules_summary->rowAttributes() ?>>
<?php if ($Payroll_Schedules_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Payroll_Schedules_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Schedules_summary->Title->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Schedules_summary->Surname->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Schedules_summary->FirstName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Schedules_summary->MiddleName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Schedules_summary->PositionName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payroll_Schedules_summary->pCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payroll_Schedules_summary->Amount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Payroll_Schedules_summary->Amount->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->Amount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Schedules_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Schedules_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Schedules_summary->BankAccountNo->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Payroll_Schedules_summary->ThirdPartyBank->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Payroll_Schedules_summary->ThirdPartyAccount->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Payroll_Schedules_summary->rowAttributes() ?>><td colspan="<?php echo ($Payroll_Schedules_summary->GroupColumnCount + $Payroll_Schedules_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Payroll_Schedules_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Payroll_Schedules_summary->rowAttributes() ?>>
<?php if ($Payroll_Schedules_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Payroll_Schedules_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Schedules_summary->Title->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Schedules_summary->Surname->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Schedules_summary->FirstName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Schedules_summary->MiddleName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Schedules_summary->PositionName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payroll_Schedules_summary->pCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payroll_Schedules_summary->Amount->cellAttributes() ?>>
<span<?php echo $Payroll_Schedules_summary->Amount->viewAttributes() ?>><?php echo $Payroll_Schedules_summary->Amount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Schedules_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Schedules_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Schedules_summary->BankAccountNo->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Payroll_Schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Payroll_Schedules_summary->ThirdPartyBank->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Schedules_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Payroll_Schedules_summary->ThirdPartyAccount->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$Payroll_Schedules_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Payroll_Schedules_summary->TotalGroups > 0) { ?>
<?php if (!$Payroll_Schedules_summary->isExport() && !($Payroll_Schedules_summary->DrillDown && $Payroll_Schedules_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payroll_Schedules_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Payroll_Schedules_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Payroll_Schedules_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Payroll_Schedules_summary->isExport() || $Payroll_Schedules_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Payroll_Schedules_summary->isExport() || $Payroll_Schedules_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Payroll_Schedules_summary->isExport() || $Payroll_Schedules_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Payroll_Schedules_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Payroll_Schedules_summary->isExport() && !$Payroll_Schedules_summary->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "footer.php"; ?>
<?php } ?>
<?php
$Payroll_Schedules_summary->terminate();
?>