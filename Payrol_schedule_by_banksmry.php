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
$Payrol_schedule_by_bank_summary = new Payrol_schedule_by_bank_summary();

// Run the page
$Payrol_schedule_by_bank_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Payrol_schedule_by_bank_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Payrol_schedule_by_bank_summary->isExport() && !$Payrol_schedule_by_bank_summary->DrillDown && !$DashboardReport) { ?>
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
	fsummary.lists["x_PayrollPeriod"] = <?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->Lookup->toClientList($Payrol_schedule_by_bank_summary) ?>;
	fsummary.lists["x_PayrollPeriod"].options = <?php echo JsonEncode($Payrol_schedule_by_bank_summary->PayrollPeriod->lookupOptions()) ?>;
	fsummary.lists["x_pCode[]"] = <?php echo $Payrol_schedule_by_bank_summary->pCode->Lookup->toClientList($Payrol_schedule_by_bank_summary) ?>;
	fsummary.lists["x_pCode[]"].options = <?php echo JsonEncode($Payrol_schedule_by_bank_summary->pCode->lookupOptions()) ?>;
	fsummary.lists["x_PaymentMethod"] = <?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->Lookup->toClientList($Payrol_schedule_by_bank_summary) ?>;
	fsummary.lists["x_PaymentMethod"].options = <?php echo JsonEncode($Payrol_schedule_by_bank_summary->PaymentMethod->lookupOptions()) ?>;
	fsummary.lists["x_BankBranchCode"] = <?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->Lookup->toClientList($Payrol_schedule_by_bank_summary) ?>;
	fsummary.lists["x_BankBranchCode"].options = <?php echo JsonEncode($Payrol_schedule_by_bank_summary->BankBranchCode->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $Payrol_schedule_by_bank_summary->getFilterList() ?>;

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
<?php if ((!$Payrol_schedule_by_bank_summary->isExport() || $Payrol_schedule_by_bank_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ShowCurrentFilter) { ?>
<?php $Payrol_schedule_by_bank_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Payrol_schedule_by_bank_summary->DrillDownInPanel) {
	$Payrol_schedule_by_bank_summary->ExportOptions->render("body");
	$Payrol_schedule_by_bank_summary->SearchOptions->render("body");
	$Payrol_schedule_by_bank_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Payrol_schedule_by_bank_summary->showPageHeader(); ?>
<?php
$Payrol_schedule_by_bank_summary->showMessage();
?>
<?php if ((!$Payrol_schedule_by_bank_summary->isExport() || $Payrol_schedule_by_bank_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Payrol_schedule_by_bank_summary->isExport() || $Payrol_schedule_by_bank_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Payrol_schedule_by_bank_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$Payrol_schedule_by_bank_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$Payrol_schedule_by_bank_summary->isExport() && !$Payrol_schedule_by_bank_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Payrol_schedule_by_bank_summary->isExport() && !$Payrol_schedule_by_bank->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Payrol_schedule_by_bank_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Payrol_schedule_by_bank">
	<div class="ew-extended-search">
<?php

// Render search row
$Payrol_schedule_by_bank->RowType = ROWTYPE_SEARCH;
$Payrol_schedule_by_bank->resetAttributes();
$Payrol_schedule_by_bank_summary->renderRow();
?>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php
		$Payrol_schedule_by_bank_summary->SearchColumnCount++;
		if (($Payrol_schedule_by_bank_summary->SearchColumnCount - 1) % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) {
			$Payrol_schedule_by_bank_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payrol_schedule_by_bank_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LocalAuthority" class="ew-cell form-group">
		<label for="x_LocalAuthority" class="ew-search-caption ew-label"><?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		<span id="el_Payrol_schedule_by_bank_LocalAuthority" class="ew-search-field">
<input type="text" data-table="Payrol_schedule_by_bank" data-field="x_LocalAuthority" name="x_LocalAuthority" id="x_LocalAuthority" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($Payrol_schedule_by_bank_summary->LocalAuthority->getPlaceHolder()) ?>" value="<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->EditValue ?>"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payrol_schedule_by_bank_summary->SearchColumnCount % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php
		$Payrol_schedule_by_bank_summary->SearchColumnCount++;
		if (($Payrol_schedule_by_bank_summary->SearchColumnCount - 1) % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) {
			$Payrol_schedule_by_bank_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payrol_schedule_by_bank_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PayrollPeriod" class="ew-cell form-group">
		<label for="x_PayrollPeriod" class="ew-search-caption ew-label"><?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->caption() ?></label>
		<span id="el_Payrol_schedule_by_bank_PayrollPeriod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Payrol_schedule_by_bank" data-field="x_PayrollPeriod" data-value-separator="<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->displayValueSeparatorAttribute() ?>" id="x_PayrollPeriod" name="x_PayrollPeriod"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->editAttributes() ?>>
			<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->selectOptionListHtml("x_PayrollPeriod") ?>
		</select>
</div>
<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->Lookup->getParamTag($Payrol_schedule_by_bank_summary, "p_x_PayrollPeriod") ?>
</span>
	</div>
	<?php if ($Payrol_schedule_by_bank_summary->SearchColumnCount % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Surname->Visible) { // Surname ?>
	<?php
		$Payrol_schedule_by_bank_summary->SearchColumnCount++;
		if (($Payrol_schedule_by_bank_summary->SearchColumnCount - 1) % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) {
			$Payrol_schedule_by_bank_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payrol_schedule_by_bank_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Surname" class="ew-cell form-group">
		<label for="x_Surname" class="ew-search-caption ew-label"><?php echo $Payrol_schedule_by_bank_summary->Surname->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		<span id="el_Payrol_schedule_by_bank_Surname" class="ew-search-field">
<input type="text" data-table="Payrol_schedule_by_bank" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Payrol_schedule_by_bank_summary->Surname->getPlaceHolder()) ?>" value="<?php echo $Payrol_schedule_by_bank_summary->Surname->EditValue ?>"<?php echo $Payrol_schedule_by_bank_summary->Surname->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payrol_schedule_by_bank_summary->SearchColumnCount % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->FirstName->Visible) { // FirstName ?>
	<?php
		$Payrol_schedule_by_bank_summary->SearchColumnCount++;
		if (($Payrol_schedule_by_bank_summary->SearchColumnCount - 1) % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) {
			$Payrol_schedule_by_bank_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payrol_schedule_by_bank_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_FirstName" class="ew-cell form-group">
		<label for="x_FirstName" class="ew-search-caption ew-label"><?php echo $Payrol_schedule_by_bank_summary->FirstName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		<span id="el_Payrol_schedule_by_bank_FirstName" class="ew-search-field">
<input type="text" data-table="Payrol_schedule_by_bank" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Payrol_schedule_by_bank_summary->FirstName->getPlaceHolder()) ?>" value="<?php echo $Payrol_schedule_by_bank_summary->FirstName->EditValue ?>"<?php echo $Payrol_schedule_by_bank_summary->FirstName->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payrol_schedule_by_bank_summary->SearchColumnCount % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PositionName->Visible) { // PositionName ?>
	<?php
		$Payrol_schedule_by_bank_summary->SearchColumnCount++;
		if (($Payrol_schedule_by_bank_summary->SearchColumnCount - 1) % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) {
			$Payrol_schedule_by_bank_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payrol_schedule_by_bank_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PositionName" class="ew-cell form-group">
		<label for="x_PositionName" class="ew-search-caption ew-label"><?php echo $Payrol_schedule_by_bank_summary->PositionName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PositionName" id="z_PositionName" value="LIKE">
</span>
		<span id="el_Payrol_schedule_by_bank_PositionName" class="ew-search-field">
<input type="text" data-table="Payrol_schedule_by_bank" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Payrol_schedule_by_bank_summary->PositionName->getPlaceHolder()) ?>" value="<?php echo $Payrol_schedule_by_bank_summary->PositionName->EditValue ?>"<?php echo $Payrol_schedule_by_bank_summary->PositionName->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payrol_schedule_by_bank_summary->SearchColumnCount % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pCode->Visible) { // pCode ?>
	<?php
		$Payrol_schedule_by_bank_summary->SearchColumnCount++;
		if (($Payrol_schedule_by_bank_summary->SearchColumnCount - 1) % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) {
			$Payrol_schedule_by_bank_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payrol_schedule_by_bank_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_pCode" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $Payrol_schedule_by_bank_summary->pCode->caption() ?></label>
		<span id="el_Payrol_schedule_by_bank_pCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pCode"><?php echo EmptyValue(strval($Payrol_schedule_by_bank_summary->pCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Payrol_schedule_by_bank_summary->pCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($Payrol_schedule_by_bank_summary->pCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($Payrol_schedule_by_bank_summary->pCode->ReadOnly || $Payrol_schedule_by_bank_summary->pCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $Payrol_schedule_by_bank_summary->pCode->Lookup->getParamTag($Payrol_schedule_by_bank_summary, "p_x_pCode") ?>
<input type="hidden" data-table="Payrol_schedule_by_bank" data-field="x_pCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $Payrol_schedule_by_bank_summary->pCode->displayValueSeparatorAttribute() ?>" name="x_pCode[]" id="x_pCode[]" value="<?php echo $Payrol_schedule_by_bank_summary->pCode->AdvancedSearch->SearchValue ?>"<?php echo $Payrol_schedule_by_bank_summary->pCode->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payrol_schedule_by_bank_summary->SearchColumnCount % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php
		$Payrol_schedule_by_bank_summary->SearchColumnCount++;
		if (($Payrol_schedule_by_bank_summary->SearchColumnCount - 1) % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) {
			$Payrol_schedule_by_bank_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payrol_schedule_by_bank_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PaymentMethod" class="ew-cell form-group">
		<label for="x_PaymentMethod" class="ew-search-caption ew-label"><?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->caption() ?></label>
		<span id="el_Payrol_schedule_by_bank_PaymentMethod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Payrol_schedule_by_bank" data-field="x_PaymentMethod" data-value-separator="<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x_PaymentMethod" name="x_PaymentMethod"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->editAttributes() ?>>
			<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->selectOptionListHtml("x_PaymentMethod") ?>
		</select>
</div>
<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->Lookup->getParamTag($Payrol_schedule_by_bank_summary, "p_x_PaymentMethod") ?>
</span>
	</div>
	<?php if ($Payrol_schedule_by_bank_summary->SearchColumnCount % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->Visible) { // BankBranchCode ?>
	<?php
		$Payrol_schedule_by_bank_summary->SearchColumnCount++;
		if (($Payrol_schedule_by_bank_summary->SearchColumnCount - 1) % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) {
			$Payrol_schedule_by_bank_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payrol_schedule_by_bank_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_BankBranchCode" class="ew-cell form-group">
		<label for="x_BankBranchCode" class="ew-search-caption ew-label"><?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->caption() ?></label>
		<span id="el_Payrol_schedule_by_bank_BankBranchCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Payrol_schedule_by_bank" data-field="x_BankBranchCode" data-value-separator="<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->displayValueSeparatorAttribute() ?>" id="x_BankBranchCode" name="x_BankBranchCode"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->editAttributes() ?>>
			<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->selectOptionListHtml("x_BankBranchCode") ?>
		</select>
</div>
<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->Lookup->getParamTag($Payrol_schedule_by_bank_summary, "p_x_BankBranchCode") ?>
</span>
	</div>
	<?php if ($Payrol_schedule_by_bank_summary->SearchColumnCount % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Payrol_schedule_by_bank_summary->SearchColumnCount % $Payrol_schedule_by_bank_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Payrol_schedule_by_bank_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Payrol_schedule_by_bank_summary->GroupCount <= count($Payrol_schedule_by_bank_summary->GroupRecords) && $Payrol_schedule_by_bank_summary->GroupCount <= $Payrol_schedule_by_bank_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Payrol_schedule_by_bank_summary->ShowHeader) {
?>
<?php if ($Payrol_schedule_by_bank_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$Payrol_schedule_by_bank_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->TotalGroups > 0) { ?>
<?php if (!$Payrol_schedule_by_bank_summary->isExport() && !($Payrol_schedule_by_bank_summary->DrillDown && $Payrol_schedule_by_bank_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payrol_schedule_by_bank_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Payrol_schedule_by_bank_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $Payrol_schedule_by_bank_summary->PageBreakContent ?>
<?php } ?>
<?php if (!$Payrol_schedule_by_bank_summary->isExport("pdf")) { ?>
<div class="<?php if (!$Payrol_schedule_by_bank_summary->isExport("word") && !$Payrol_schedule_by_bank_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Payrol_schedule_by_bank_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Payrol_schedule_by_bank_summary->isExport() && !($Payrol_schedule_by_bank_summary->DrillDown && $Payrol_schedule_by_bank_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payrol_schedule_by_bank_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Payrol_schedule_by_bank_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Payrol_schedule_by_bank" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Payrol_schedule_by_bank_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
	<th data-name="LocalAuthority">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->LocalAuthority) == "") { ?>
	<th data-name="LocalAuthority" class="<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_LocalAuthority"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="LocalAuthority" class="<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->LocalAuthority) ?>', 1);"><div class="Payrol_schedule_by_bank_LocalAuthority">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
	<th data-name="PayrollPeriod">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->PayrollPeriod) == "") { ?>
	<th data-name="PayrollPeriod" class="<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="PayrollPeriod" class="<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->PayrollPeriod) ?>', 1);"><div class="Payrol_schedule_by_bank_PayrollPeriod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->ShowGroupHeaderAsRow) { ?>
	<th data-name="PaymentMethod">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->PaymentMethod) == "") { ?>
	<th data-name="PaymentMethod" class="<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_PaymentMethod"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="PaymentMethod" class="<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->PaymentMethod) ?>', 1);"><div class="Payrol_schedule_by_bank_PaymentMethod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->ShowGroupHeaderAsRow) { ?>
	<th data-name="BankBranchCode">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->BankBranchCode) == "") { ?>
	<th data-name="BankBranchCode" class="<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_BankBranchCode"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="BankBranchCode" class="<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->BankBranchCode) ?>', 1);"><div class="Payrol_schedule_by_bank_BankBranchCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->BankBranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Title->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->Title) == "") { ?>
	<th data-name="Title" class="<?php echo $Payrol_schedule_by_bank_summary->Title->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_Title"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->Title->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Title" class="<?php echo $Payrol_schedule_by_bank_summary->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->Title) ?>', 1);"><div class="Payrol_schedule_by_bank_Title">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->Title->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Surname->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->Surname) == "") { ?>
	<th data-name="Surname" class="<?php echo $Payrol_schedule_by_bank_summary->Surname->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_Surname"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->Surname->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Surname" class="<?php echo $Payrol_schedule_by_bank_summary->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->Surname) ?>', 1);"><div class="Payrol_schedule_by_bank_Surname">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->FirstName->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->FirstName) == "") { ?>
	<th data-name="FirstName" class="<?php echo $Payrol_schedule_by_bank_summary->FirstName->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_FirstName"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FirstName" class="<?php echo $Payrol_schedule_by_bank_summary->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->FirstName) ?>', 1);"><div class="Payrol_schedule_by_bank_FirstName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->MiddleName->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->MiddleName) == "") { ?>
	<th data-name="MiddleName" class="<?php echo $Payrol_schedule_by_bank_summary->MiddleName->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_MiddleName"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MiddleName" class="<?php echo $Payrol_schedule_by_bank_summary->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->MiddleName) ?>', 1);"><div class="Payrol_schedule_by_bank_MiddleName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PositionName->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->PositionName) == "") { ?>
	<th data-name="PositionName" class="<?php echo $Payrol_schedule_by_bank_summary->PositionName->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_PositionName"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PositionName" class="<?php echo $Payrol_schedule_by_bank_summary->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->PositionName) ?>', 1);"><div class="Payrol_schedule_by_bank_PositionName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pCode->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->pCode) == "") { ?>
	<th data-name="pCode" class="<?php echo $Payrol_schedule_by_bank_summary->pCode->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_pCode"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->pCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="pCode" class="<?php echo $Payrol_schedule_by_bank_summary->pCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->pCode) ?>', 1);"><div class="Payrol_schedule_by_bank_pCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->pCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->pCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->pCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pName->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->pName) == "") { ?>
	<th data-name="pName" class="<?php echo $Payrol_schedule_by_bank_summary->pName->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_pName"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->pName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="pName" class="<?php echo $Payrol_schedule_by_bank_summary->pName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->pName) ?>', 1);"><div class="Payrol_schedule_by_bank_pName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->pName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->pName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->pName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Amount->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->Amount) == "") { ?>
	<th data-name="Amount" class="<?php echo $Payrol_schedule_by_bank_summary->Amount->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_Amount"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->Amount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Amount" class="<?php echo $Payrol_schedule_by_bank_summary->Amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->Amount) ?>', 1);"><div class="Payrol_schedule_by_bank_Amount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->Amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->Amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankAccountNo->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->BankAccountNo) == "") { ?>
	<th data-name="BankAccountNo" class="<?php echo $Payrol_schedule_by_bank_summary->BankAccountNo->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_BankAccountNo"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="BankAccountNo" class="<?php echo $Payrol_schedule_by_bank_summary->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->BankAccountNo) ?>', 1);"><div class="Payrol_schedule_by_bank_BankAccountNo">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->BankAccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->ThirdPartyPayMethod) == "") { ?>
	<th data-name="ThirdPartyPayMethod" class="<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_ThirdPartyPayMethod"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ThirdPartyPayMethod" class="<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->ThirdPartyPayMethod) ?>', 1);"><div class="Payrol_schedule_by_bank_ThirdPartyPayMethod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyBank->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->ThirdPartyBank) == "") { ?>
	<th data-name="ThirdPartyBank" class="<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyBank->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_ThirdPartyBank"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->ThirdPartyBank->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ThirdPartyBank" class="<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyBank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->ThirdPartyBank) ?>', 1);"><div class="Payrol_schedule_by_bank_ThirdPartyBank">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->ThirdPartyBank->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->ThirdPartyBank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->ThirdPartyBank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyAccount->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->ThirdPartyAccount) == "") { ?>
	<th data-name="ThirdPartyAccount" class="<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyAccount->headerCellClass() ?>"><div class="Payrol_schedule_by_bank_ThirdPartyAccount"><div class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->ThirdPartyAccount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ThirdPartyAccount" class="<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyAccount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->ThirdPartyAccount) ?>', 1);"><div class="Payrol_schedule_by_bank_ThirdPartyAccount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->ThirdPartyAccount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->ThirdPartyAccount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->ThirdPartyAccount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Payrol_schedule_by_bank_summary->TotalGroups == 0)
			break; // Show header only
		$Payrol_schedule_by_bank_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Payrol_schedule_by_bank_summary->LocalAuthority, $Payrol_schedule_by_bank_summary->getSqlFirstGroupField(), $Payrol_schedule_by_bank_summary->LocalAuthority->groupValue(), $Payrol_schedule_by_bank_summary->Dbid);
	if ($Payrol_schedule_by_bank_summary->PageFirstGroupFilter != "") $Payrol_schedule_by_bank_summary->PageFirstGroupFilter .= " OR ";
	$Payrol_schedule_by_bank_summary->PageFirstGroupFilter .= $where;
	if ($Payrol_schedule_by_bank_summary->Filter != "")
		$where = "($Payrol_schedule_by_bank_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Payrol_schedule_by_bank_summary->getSqlSelect(), $Payrol_schedule_by_bank_summary->getSqlWhere(), $Payrol_schedule_by_bank_summary->getSqlGroupBy(), $Payrol_schedule_by_bank_summary->getSqlHaving(), $Payrol_schedule_by_bank_summary->getSqlOrderBy(), $where, $Payrol_schedule_by_bank_summary->Sort);
	$rs = $Payrol_schedule_by_bank_summary->getRecordset($sql);
	$Payrol_schedule_by_bank_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Payrol_schedule_by_bank_summary->DetailRecordCount = count($Payrol_schedule_by_bank_summary->DetailRecords);

	// Load detail records
	$Payrol_schedule_by_bank_summary->LocalAuthority->Records = &$Payrol_schedule_by_bank_summary->DetailRecords;
	$Payrol_schedule_by_bank_summary->LocalAuthority->LevelBreak = TRUE; // Set field level break
		$Payrol_schedule_by_bank_summary->GroupCounter[1] = $Payrol_schedule_by_bank_summary->GroupCount;
		$Payrol_schedule_by_bank_summary->LocalAuthority->getCnt($Payrol_schedule_by_bank_summary->LocalAuthority->Records); // Get record count
?>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible && $Payrol_schedule_by_bank_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payrol_schedule_by_bank_summary->resetAttributes();
		$Payrol_schedule_by_bank_summary->RowType = ROWTYPE_TOTAL;
		$Payrol_schedule_by_bank_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payrol_schedule_by_bank_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payrol_schedule_by_bank_summary->RowGroupLevel = 1;
		$Payrol_schedule_by_bank_summary->renderRow();
?>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes(); ?>>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="LocalAuthority" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes() ?>>
<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->LocalAuthority) == "") { ?>
		<span class="ew-summary-caption Payrol_schedule_by_bank_LocalAuthority"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payrol_schedule_by_bank_LocalAuthority" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->LocalAuthority) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->LocalAuthority->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payrol_schedule_by_bank_summary->PayrollPeriod->getDistinctValues($Payrol_schedule_by_bank_summary->LocalAuthority->Records);
	$Payrol_schedule_by_bank_summary->setGroupCount(count($Payrol_schedule_by_bank_summary->PayrollPeriod->DistinctValues), $Payrol_schedule_by_bank_summary->GroupCounter[1]);
	$Payrol_schedule_by_bank_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($Payrol_schedule_by_bank_summary->PayrollPeriod->DistinctValues as $PayrollPeriod) { // Load records for this distinct value
		$Payrol_schedule_by_bank_summary->PayrollPeriod->setGroupValue($PayrollPeriod); // Set group value
		$Payrol_schedule_by_bank_summary->PayrollPeriod->getDistinctRecords($Payrol_schedule_by_bank_summary->LocalAuthority->Records, $Payrol_schedule_by_bank_summary->PayrollPeriod->groupValue());
		$Payrol_schedule_by_bank_summary->PayrollPeriod->LevelBreak = TRUE; // Set field level break
		$Payrol_schedule_by_bank_summary->GroupCounter[2]++;
		$Payrol_schedule_by_bank_summary->PayrollPeriod->getCnt($Payrol_schedule_by_bank_summary->PayrollPeriod->Records); // Get record count
?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible && $Payrol_schedule_by_bank_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payrol_schedule_by_bank_summary->PayrollPeriod->setDbValue($PayrollPeriod); // Set current value for PayrollPeriod
		$Payrol_schedule_by_bank_summary->resetAttributes();
		$Payrol_schedule_by_bank_summary->RowType = ROWTYPE_TOTAL;
		$Payrol_schedule_by_bank_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payrol_schedule_by_bank_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payrol_schedule_by_bank_summary->RowGroupLevel = 2;
		$Payrol_schedule_by_bank_summary->renderRow();
?>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes(); ?>>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="PayrollPeriod" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->cellAttributes() ?>>
<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->PayrollPeriod) == "") { ?>
		<span class="ew-summary-caption Payrol_schedule_by_bank_PayrollPeriod"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payrol_schedule_by_bank_PayrollPeriod" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->PayrollPeriod) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->PayrollPeriod->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payrol_schedule_by_bank_summary->PaymentMethod->getDistinctValues($Payrol_schedule_by_bank_summary->PayrollPeriod->Records);
	$Payrol_schedule_by_bank_summary->setGroupCount(count($Payrol_schedule_by_bank_summary->PaymentMethod->DistinctValues), $Payrol_schedule_by_bank_summary->GroupCounter[1], $Payrol_schedule_by_bank_summary->GroupCounter[2]);
	$Payrol_schedule_by_bank_summary->GroupCounter[3] = 0; // Init group count index
	foreach ($Payrol_schedule_by_bank_summary->PaymentMethod->DistinctValues as $PaymentMethod) { // Load records for this distinct value
		$Payrol_schedule_by_bank_summary->PaymentMethod->setGroupValue($PaymentMethod); // Set group value
		$Payrol_schedule_by_bank_summary->PaymentMethod->getDistinctRecords($Payrol_schedule_by_bank_summary->PayrollPeriod->Records, $Payrol_schedule_by_bank_summary->PaymentMethod->groupValue());
		$Payrol_schedule_by_bank_summary->PaymentMethod->LevelBreak = TRUE; // Set field level break
		$Payrol_schedule_by_bank_summary->GroupCounter[3]++;
		$Payrol_schedule_by_bank_summary->PaymentMethod->getCnt($Payrol_schedule_by_bank_summary->PaymentMethod->Records); // Get record count
?>
<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->Visible && $Payrol_schedule_by_bank_summary->PaymentMethod->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payrol_schedule_by_bank_summary->PaymentMethod->setDbValue($PaymentMethod); // Set current value for PaymentMethod
		$Payrol_schedule_by_bank_summary->resetAttributes();
		$Payrol_schedule_by_bank_summary->RowType = ROWTYPE_TOTAL;
		$Payrol_schedule_by_bank_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payrol_schedule_by_bank_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payrol_schedule_by_bank_summary->RowGroupLevel = 3;
		$Payrol_schedule_by_bank_summary->renderRow();
?>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes(); ?>>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="PaymentMethod" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 3) ?>"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>
<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->PaymentMethod) == "") { ?>
		<span class="ew-summary-caption Payrol_schedule_by_bank_PaymentMethod"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payrol_schedule_by_bank_PaymentMethod" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->PaymentMethod) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->PaymentMethod->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payrol_schedule_by_bank_summary->BankBranchCode->getDistinctValues($Payrol_schedule_by_bank_summary->PaymentMethod->Records);
	$Payrol_schedule_by_bank_summary->setGroupCount(count($Payrol_schedule_by_bank_summary->BankBranchCode->DistinctValues), $Payrol_schedule_by_bank_summary->GroupCounter[1], $Payrol_schedule_by_bank_summary->GroupCounter[2], $Payrol_schedule_by_bank_summary->GroupCounter[3]);
	$Payrol_schedule_by_bank_summary->GroupCounter[4] = 0; // Init group count index
	foreach ($Payrol_schedule_by_bank_summary->BankBranchCode->DistinctValues as $BankBranchCode) { // Load records for this distinct value
		$Payrol_schedule_by_bank_summary->BankBranchCode->setGroupValue($BankBranchCode); // Set group value
		$Payrol_schedule_by_bank_summary->BankBranchCode->getDistinctRecords($Payrol_schedule_by_bank_summary->PaymentMethod->Records, $Payrol_schedule_by_bank_summary->BankBranchCode->groupValue());
		$Payrol_schedule_by_bank_summary->BankBranchCode->LevelBreak = TRUE; // Set field level break
		$Payrol_schedule_by_bank_summary->GroupCounter[4]++;
		$Payrol_schedule_by_bank_summary->BankBranchCode->getCnt($Payrol_schedule_by_bank_summary->BankBranchCode->Records); // Get record count
		$Payrol_schedule_by_bank_summary->setGroupCount($Payrol_schedule_by_bank_summary->BankBranchCode->Count, $Payrol_schedule_by_bank_summary->GroupCounter[1], $Payrol_schedule_by_bank_summary->GroupCounter[2], $Payrol_schedule_by_bank_summary->GroupCounter[3], $Payrol_schedule_by_bank_summary->GroupCounter[4]);
?>
<?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->Visible && $Payrol_schedule_by_bank_summary->BankBranchCode->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payrol_schedule_by_bank_summary->BankBranchCode->setDbValue($BankBranchCode); // Set current value for BankBranchCode
		$Payrol_schedule_by_bank_summary->resetAttributes();
		$Payrol_schedule_by_bank_summary->RowType = ROWTYPE_TOTAL;
		$Payrol_schedule_by_bank_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payrol_schedule_by_bank_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payrol_schedule_by_bank_summary->RowGroupLevel = 4;
		$Payrol_schedule_by_bank_summary->renderRow();
?>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes(); ?>>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="BankBranchCode" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 4) ?>"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>
<?php if ($Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->BankBranchCode) == "") { ?>
		<span class="ew-summary-caption Payrol_schedule_by_bank_BankBranchCode"><span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payrol_schedule_by_bank_BankBranchCode" onclick="ew.sort(event, '<?php echo $Payrol_schedule_by_bank_summary->sortUrl($Payrol_schedule_by_bank_summary->BankBranchCode) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payrol_schedule_by_bank_summary->BankBranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->BankBranchCode->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payrol_schedule_by_bank_summary->RecordCount = 0; // Reset record count
	foreach ($Payrol_schedule_by_bank_summary->BankBranchCode->Records as $record) {
		$Payrol_schedule_by_bank_summary->RecordCount++;
		$Payrol_schedule_by_bank_summary->RecordIndex++;
		$Payrol_schedule_by_bank_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Payrol_schedule_by_bank_summary->resetAttributes();
		$Payrol_schedule_by_bank_summary->RowType = ROWTYPE_DETAIL;
		$Payrol_schedule_by_bank_summary->renderRow();
?>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes(); ?>>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		<td data-field="LocalAuthority"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="LocalAuthority"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes(); ?>><span<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="PayrollPeriod"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->cellAttributes(); ?>><span<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->ShowGroupHeaderAsRow) { ?>
		<td data-field="PaymentMethod"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="PaymentMethod"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes(); ?>><span<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->Visible) { ?>
	<?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->ShowGroupHeaderAsRow) { ?>
		<td data-field="BankBranchCode"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="BankBranchCode"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes(); ?>><span<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payrol_schedule_by_bank_summary->Title->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->Title->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->Title->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payrol_schedule_by_bank_summary->Surname->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->Surname->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->Surname->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payrol_schedule_by_bank_summary->FirstName->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->FirstName->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->FirstName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payrol_schedule_by_bank_summary->MiddleName->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->MiddleName->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->MiddleName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payrol_schedule_by_bank_summary->PositionName->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->PositionName->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->PositionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payrol_schedule_by_bank_summary->pCode->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->pCode->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->pCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payrol_schedule_by_bank_summary->pName->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->pName->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->pName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payrol_schedule_by_bank_summary->Amount->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->Amount->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->Amount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payrol_schedule_by_bank_summary->BankAccountNo->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->BankAccountNo->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->BankAccountNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyBank->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyBank->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->ThirdPartyBank->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyAccount->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyAccount->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->ThirdPartyAccount->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Payrol_schedule_by_bank_summary->TotalGroups > 0) { ?>
<?php
	$Payrol_schedule_by_bank_summary->Amount->getSum($Payrol_schedule_by_bank_summary->BankBranchCode->Records); // Get Sum
	$Payrol_schedule_by_bank_summary->resetAttributes();
	$Payrol_schedule_by_bank_summary->RowType = ROWTYPE_TOTAL;
	$Payrol_schedule_by_bank_summary->RowTotalType = ROWTOTAL_GROUP;
	$Payrol_schedule_by_bank_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Payrol_schedule_by_bank_summary->RowGroupLevel = 4;
	$Payrol_schedule_by_bank_summary->renderRow();
?>
<?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes(); ?>>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes() ?>>
	<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payrol_schedule_by_bank_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->LocalAuthority->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->cellAttributes() ?>>
	<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payrol_schedule_by_bank_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->PayrollPeriod->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>
	<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payrol_schedule_by_bank_summary->RowGroupLevel != 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->PaymentMethod->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>
	<?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payrol_schedule_by_bank_summary->RowGroupLevel != 4) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->BankBranchCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Payrol_schedule_by_bank_summary->Amount->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->Amount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes(); ?>>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->SubGroupColumnCount + $Payrol_schedule_by_bank_summary->DetailColumnCount - 2 > 0) { ?>
		<td colspan="<?php echo ($Payrol_schedule_by_bank_summary->SubGroupColumnCount + $Payrol_schedule_by_bank_summary->DetailColumnCount - 2) ?>"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Payrol_schedule_by_bank_summary->BankBranchCode->GroupViewValue, $Payrol_schedule_by_bank_summary->BankBranchCode->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Payrol_schedule_by_bank_summary->BankBranchCode->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes(); ?>>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Payrol_schedule_by_bank_summary->GroupColumnCount - 3) ?>"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payrol_schedule_by_bank_summary->Amount->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->Amount->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->Amount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Payrol_schedule_by_bank_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	} // End group level 3
?>
<?php if ($Payrol_schedule_by_bank_summary->TotalGroups > 0) { ?>
<?php
	$Payrol_schedule_by_bank_summary->Amount->getSum($Payrol_schedule_by_bank_summary->PaymentMethod->Records); // Get Sum
	$Payrol_schedule_by_bank_summary->resetAttributes();
	$Payrol_schedule_by_bank_summary->RowType = ROWTYPE_TOTAL;
	$Payrol_schedule_by_bank_summary->RowTotalType = ROWTOTAL_GROUP;
	$Payrol_schedule_by_bank_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Payrol_schedule_by_bank_summary->RowGroupLevel = 3;
	$Payrol_schedule_by_bank_summary->renderRow();
?>
<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes(); ?>>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes() ?>>
	<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payrol_schedule_by_bank_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->LocalAuthority->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->cellAttributes() ?>>
	<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payrol_schedule_by_bank_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->PayrollPeriod->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>
	<?php if ($Payrol_schedule_by_bank_summary->PaymentMethod->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payrol_schedule_by_bank_summary->RowGroupLevel != 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->PaymentMethod->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>
	<?php if ($Payrol_schedule_by_bank_summary->BankBranchCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payrol_schedule_by_bank_summary->RowGroupLevel != 4) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->BankBranchCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Payrol_schedule_by_bank_summary->Amount->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->Amount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes(); ?>>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->SubGroupColumnCount + $Payrol_schedule_by_bank_summary->DetailColumnCount - 1 > 0) { ?>
		<td colspan="<?php echo ($Payrol_schedule_by_bank_summary->SubGroupColumnCount + $Payrol_schedule_by_bank_summary->DetailColumnCount - 1) ?>"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Payrol_schedule_by_bank_summary->PaymentMethod->GroupViewValue, $Payrol_schedule_by_bank_summary->PaymentMethod->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Payrol_schedule_by_bank_summary->PaymentMethod->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes(); ?>>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payrol_schedule_by_bank_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payrol_schedule_by_bank_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Payrol_schedule_by_bank_summary->GroupColumnCount - 2) ?>"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payrol_schedule_by_bank_summary->Amount->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->Amount->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->Amount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Payrol_schedule_by_bank_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
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
	$Payrol_schedule_by_bank_summary->loadGroupRowValues();

	// Show header if page break
	if ($Payrol_schedule_by_bank_summary->isExport())
		$Payrol_schedule_by_bank_summary->ShowHeader = ($Payrol_schedule_by_bank_summary->ExportPageBreakCount == 0) ? FALSE : ($Payrol_schedule_by_bank_summary->GroupCount % $Payrol_schedule_by_bank_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Payrol_schedule_by_bank_summary->ShowHeader)
		$Payrol_schedule_by_bank_summary->Page_Breaking($Payrol_schedule_by_bank_summary->ShowHeader, $Payrol_schedule_by_bank_summary->PageBreakContent);
	$Payrol_schedule_by_bank_summary->GroupCount++;
} // End while
?>
<?php if ($Payrol_schedule_by_bank_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Payrol_schedule_by_bank_summary->resetAttributes();
	$Payrol_schedule_by_bank_summary->RowType = ROWTYPE_TOTAL;
	$Payrol_schedule_by_bank_summary->RowTotalType = ROWTOTAL_GRAND;
	$Payrol_schedule_by_bank_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Payrol_schedule_by_bank_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Payrol_schedule_by_bank_summary->renderRow();
?>
<?php if ($Payrol_schedule_by_bank_summary->LocalAuthority->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes() ?>><td colspan="<?php echo ($Payrol_schedule_by_bank_summary->GroupColumnCount + $Payrol_schedule_by_bank_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payrol_schedule_by_bank_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes() ?>>
<?php if ($Payrol_schedule_by_bank_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Payrol_schedule_by_bank_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payrol_schedule_by_bank_summary->Title->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payrol_schedule_by_bank_summary->Surname->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payrol_schedule_by_bank_summary->FirstName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payrol_schedule_by_bank_summary->MiddleName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payrol_schedule_by_bank_summary->PositionName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payrol_schedule_by_bank_summary->pCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payrol_schedule_by_bank_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payrol_schedule_by_bank_summary->Amount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Payrol_schedule_by_bank_summary->Amount->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->Amount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payrol_schedule_by_bank_summary->BankAccountNo->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyBank->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyAccount->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes() ?>><td colspan="<?php echo ($Payrol_schedule_by_bank_summary->GroupColumnCount + $Payrol_schedule_by_bank_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Payrol_schedule_by_bank_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Payrol_schedule_by_bank_summary->rowAttributes() ?>>
<?php if ($Payrol_schedule_by_bank_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Payrol_schedule_by_bank_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payrol_schedule_by_bank_summary->Title->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payrol_schedule_by_bank_summary->Surname->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payrol_schedule_by_bank_summary->FirstName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payrol_schedule_by_bank_summary->MiddleName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payrol_schedule_by_bank_summary->PositionName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Payrol_schedule_by_bank_summary->pCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Payrol_schedule_by_bank_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Payrol_schedule_by_bank_summary->Amount->cellAttributes() ?>>
<span<?php echo $Payrol_schedule_by_bank_summary->Amount->viewAttributes() ?>><?php echo $Payrol_schedule_by_bank_summary->Amount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payrol_schedule_by_bank_summary->BankAccountNo->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyPayMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyBank->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Payrol_schedule_by_bank_summary->ThirdPartyAccount->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$Payrol_schedule_by_bank_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Payrol_schedule_by_bank_summary->TotalGroups > 0) { ?>
<?php if (!$Payrol_schedule_by_bank_summary->isExport() && !($Payrol_schedule_by_bank_summary->DrillDown && $Payrol_schedule_by_bank_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payrol_schedule_by_bank_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Payrol_schedule_by_bank_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Payrol_schedule_by_bank_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Payrol_schedule_by_bank_summary->isExport() || $Payrol_schedule_by_bank_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Payrol_schedule_by_bank_summary->isExport() || $Payrol_schedule_by_bank_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Payrol_schedule_by_bank_summary->isExport() || $Payrol_schedule_by_bank_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Payrol_schedule_by_bank_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Payrol_schedule_by_bank_summary->isExport() && !$Payrol_schedule_by_bank_summary->DrillDown && !$DashboardReport) { ?>
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
$Payrol_schedule_by_bank_summary->terminate();
?>