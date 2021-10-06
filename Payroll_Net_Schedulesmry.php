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
$Payroll_Net_Schedule_summary = new Payroll_Net_Schedule_summary();

// Run the page
$Payroll_Net_Schedule_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Payroll_Net_Schedule_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Payroll_Net_Schedule_summary->isExport() && !$Payroll_Net_Schedule_summary->DrillDown && !$DashboardReport) { ?>
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
		elm = this.getElements("x" + infix + "_Division");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Payroll_Net_Schedule_summary->Division->errorMessage()) ?>");

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
	fsummary.lists["x_PayrollPeriod"] = <?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->Lookup->toClientList($Payroll_Net_Schedule_summary) ?>;
	fsummary.lists["x_PayrollPeriod"].options = <?php echo JsonEncode($Payroll_Net_Schedule_summary->PayrollPeriod->lookupOptions()) ?>;
	fsummary.lists["x_PaymentMethod"] = <?php echo $Payroll_Net_Schedule_summary->PaymentMethod->Lookup->toClientList($Payroll_Net_Schedule_summary) ?>;
	fsummary.lists["x_PaymentMethod"].options = <?php echo JsonEncode($Payroll_Net_Schedule_summary->PaymentMethod->lookupOptions()) ?>;
	fsummary.lists["x_BankBranchCode"] = <?php echo $Payroll_Net_Schedule_summary->BankBranchCode->Lookup->toClientList($Payroll_Net_Schedule_summary) ?>;
	fsummary.lists["x_BankBranchCode"].options = <?php echo JsonEncode($Payroll_Net_Schedule_summary->BankBranchCode->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $Payroll_Net_Schedule_summary->getFilterList() ?>;

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
<?php if ((!$Payroll_Net_Schedule_summary->isExport() || $Payroll_Net_Schedule_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->ShowCurrentFilter) { ?>
<?php $Payroll_Net_Schedule_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Payroll_Net_Schedule_summary->DrillDownInPanel) {
	$Payroll_Net_Schedule_summary->ExportOptions->render("body");
	$Payroll_Net_Schedule_summary->SearchOptions->render("body");
	$Payroll_Net_Schedule_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Payroll_Net_Schedule_summary->showPageHeader(); ?>
<?php
$Payroll_Net_Schedule_summary->showMessage();
?>
<?php if ((!$Payroll_Net_Schedule_summary->isExport() || $Payroll_Net_Schedule_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Payroll_Net_Schedule_summary->isExport() || $Payroll_Net_Schedule_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Payroll_Net_Schedule_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$Payroll_Net_Schedule_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$Payroll_Net_Schedule_summary->isExport() && !$Payroll_Net_Schedule_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Payroll_Net_Schedule_summary->isExport() && !$Payroll_Net_Schedule->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Payroll_Net_Schedule_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Payroll_Net_Schedule">
	<div class="ew-extended-search">
<?php

// Render search row
$Payroll_Net_Schedule->RowType = ROWTYPE_SEARCH;
$Payroll_Net_Schedule->resetAttributes();
$Payroll_Net_Schedule_summary->renderRow();
?>
<?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php
		$Payroll_Net_Schedule_summary->SearchColumnCount++;
		if (($Payroll_Net_Schedule_summary->SearchColumnCount - 1) % $Payroll_Net_Schedule_summary->SearchFieldsPerRow == 0) {
			$Payroll_Net_Schedule_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Net_Schedule_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PayrollPeriod" class="ew-cell form-group">
		<label for="x_PayrollPeriod" class="ew-search-caption ew-label"><?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->caption() ?></label>
		<span id="el_Payroll_Net_Schedule_PayrollPeriod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Payroll_Net_Schedule" data-field="x_PayrollPeriod" data-value-separator="<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->displayValueSeparatorAttribute() ?>" id="x_PayrollPeriod" name="x_PayrollPeriod"<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->editAttributes() ?>>
			<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->selectOptionListHtml("x_PayrollPeriod") ?>
		</select>
</div>
<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->Lookup->getParamTag($Payroll_Net_Schedule_summary, "p_x_PayrollPeriod") ?>
</span>
	</div>
	<?php if ($Payroll_Net_Schedule_summary->SearchColumnCount % $Payroll_Net_Schedule_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Division->Visible) { // Division ?>
	<?php
		$Payroll_Net_Schedule_summary->SearchColumnCount++;
		if (($Payroll_Net_Schedule_summary->SearchColumnCount - 1) % $Payroll_Net_Schedule_summary->SearchFieldsPerRow == 0) {
			$Payroll_Net_Schedule_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Net_Schedule_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Division" class="ew-cell form-group">
		<label for="x_Division" class="ew-search-caption ew-label"><?php echo $Payroll_Net_Schedule_summary->Division->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Division" id="z_Division" value="=">
</span>
		<span id="el_Payroll_Net_Schedule_Division" class="ew-search-field">
<input type="text" data-table="Payroll_Net_Schedule" data-field="x_Division" name="x_Division" id="x_Division" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Payroll_Net_Schedule_summary->Division->getPlaceHolder()) ?>" value="<?php echo $Payroll_Net_Schedule_summary->Division->EditValue ?>"<?php echo $Payroll_Net_Schedule_summary->Division->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payroll_Net_Schedule_summary->SearchColumnCount % $Payroll_Net_Schedule_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Surname->Visible) { // Surname ?>
	<?php
		$Payroll_Net_Schedule_summary->SearchColumnCount++;
		if (($Payroll_Net_Schedule_summary->SearchColumnCount - 1) % $Payroll_Net_Schedule_summary->SearchFieldsPerRow == 0) {
			$Payroll_Net_Schedule_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Net_Schedule_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Surname" class="ew-cell form-group">
		<label for="x_Surname" class="ew-search-caption ew-label"><?php echo $Payroll_Net_Schedule_summary->Surname->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		<span id="el_Payroll_Net_Schedule_Surname" class="ew-search-field">
<input type="text" data-table="Payroll_Net_Schedule" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Payroll_Net_Schedule_summary->Surname->getPlaceHolder()) ?>" value="<?php echo $Payroll_Net_Schedule_summary->Surname->EditValue ?>"<?php echo $Payroll_Net_Schedule_summary->Surname->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payroll_Net_Schedule_summary->SearchColumnCount % $Payroll_Net_Schedule_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php
		$Payroll_Net_Schedule_summary->SearchColumnCount++;
		if (($Payroll_Net_Schedule_summary->SearchColumnCount - 1) % $Payroll_Net_Schedule_summary->SearchFieldsPerRow == 0) {
			$Payroll_Net_Schedule_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Net_Schedule_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PaymentMethod" class="ew-cell form-group">
		<label for="x_PaymentMethod" class="ew-search-caption ew-label"><?php echo $Payroll_Net_Schedule_summary->PaymentMethod->caption() ?></label>
		<span id="el_Payroll_Net_Schedule_PaymentMethod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Payroll_Net_Schedule" data-field="x_PaymentMethod" data-value-separator="<?php echo $Payroll_Net_Schedule_summary->PaymentMethod->displayValueSeparatorAttribute() ?>" id="x_PaymentMethod" name="x_PaymentMethod"<?php echo $Payroll_Net_Schedule_summary->PaymentMethod->editAttributes() ?>>
			<?php echo $Payroll_Net_Schedule_summary->PaymentMethod->selectOptionListHtml("x_PaymentMethod") ?>
		</select>
</div>
<?php echo $Payroll_Net_Schedule_summary->PaymentMethod->Lookup->getParamTag($Payroll_Net_Schedule_summary, "p_x_PaymentMethod") ?>
</span>
	</div>
	<?php if ($Payroll_Net_Schedule_summary->SearchColumnCount % $Payroll_Net_Schedule_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankBranchCode->Visible) { // BankBranchCode ?>
	<?php
		$Payroll_Net_Schedule_summary->SearchColumnCount++;
		if (($Payroll_Net_Schedule_summary->SearchColumnCount - 1) % $Payroll_Net_Schedule_summary->SearchFieldsPerRow == 0) {
			$Payroll_Net_Schedule_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payroll_Net_Schedule_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_BankBranchCode" class="ew-cell form-group">
		<label for="x_BankBranchCode" class="ew-search-caption ew-label"><?php echo $Payroll_Net_Schedule_summary->BankBranchCode->caption() ?></label>
		<span id="el_Payroll_Net_Schedule_BankBranchCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Payroll_Net_Schedule" data-field="x_BankBranchCode" data-value-separator="<?php echo $Payroll_Net_Schedule_summary->BankBranchCode->displayValueSeparatorAttribute() ?>" id="x_BankBranchCode" name="x_BankBranchCode"<?php echo $Payroll_Net_Schedule_summary->BankBranchCode->editAttributes() ?>>
			<?php echo $Payroll_Net_Schedule_summary->BankBranchCode->selectOptionListHtml("x_BankBranchCode") ?>
		</select>
</div>
<?php echo $Payroll_Net_Schedule_summary->BankBranchCode->Lookup->getParamTag($Payroll_Net_Schedule_summary, "p_x_BankBranchCode") ?>
</span>
	</div>
	<?php if ($Payroll_Net_Schedule_summary->SearchColumnCount % $Payroll_Net_Schedule_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Payroll_Net_Schedule_summary->SearchColumnCount % $Payroll_Net_Schedule_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Payroll_Net_Schedule_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Payroll_Net_Schedule_summary->GroupCount <= count($Payroll_Net_Schedule_summary->GroupRecords) && $Payroll_Net_Schedule_summary->GroupCount <= $Payroll_Net_Schedule_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Payroll_Net_Schedule_summary->ShowHeader) {
?>
<?php if ($Payroll_Net_Schedule_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$Payroll_Net_Schedule_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->TotalGroups > 0) { ?>
<?php if (!$Payroll_Net_Schedule_summary->isExport() && !($Payroll_Net_Schedule_summary->DrillDown && $Payroll_Net_Schedule_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payroll_Net_Schedule_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Payroll_Net_Schedule_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $Payroll_Net_Schedule_summary->PageBreakContent ?>
<?php } ?>
<?php if (!$Payroll_Net_Schedule_summary->isExport("pdf")) { ?>
<div class="<?php if (!$Payroll_Net_Schedule_summary->isExport("word") && !$Payroll_Net_Schedule_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Payroll_Net_Schedule_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Payroll_Net_Schedule_summary->isExport() && !($Payroll_Net_Schedule_summary->DrillDown && $Payroll_Net_Schedule_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payroll_Net_Schedule_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Payroll_Net_Schedule_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Payroll_Net_Schedule" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Payroll_Net_Schedule_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
	<th data-name="LocalAuthority">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->LocalAuthority) == "") { ?>
	<th data-name="LocalAuthority" class="<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->headerCellClass() ?>"><div class="Payroll_Net_Schedule_LocalAuthority"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->LocalAuthority->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="LocalAuthority" class="<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->LocalAuthority) ?>', 1);"><div class="Payroll_Net_Schedule_LocalAuthority">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
	<th data-name="PayrollPeriod">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->PayrollPeriod) == "") { ?>
	<th data-name="PayrollPeriod" class="<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->headerCellClass() ?>"><div class="Payroll_Net_Schedule_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="PayrollPeriod" class="<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->PayrollPeriod) ?>', 1);"><div class="Payroll_Net_Schedule_PayrollPeriod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Division->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->Division->ShowGroupHeaderAsRow) { ?>
	<th data-name="Division">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->Division) == "") { ?>
	<th data-name="Division" class="<?php echo $Payroll_Net_Schedule_summary->Division->headerCellClass() ?>"><div class="Payroll_Net_Schedule_Division"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->Division->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="Division" class="<?php echo $Payroll_Net_Schedule_summary->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->Division) ?>', 1);"><div class="Payroll_Net_Schedule_Division">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Title->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->Title) == "") { ?>
	<th data-name="Title" class="<?php echo $Payroll_Net_Schedule_summary->Title->headerCellClass() ?>"><div class="Payroll_Net_Schedule_Title"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->Title->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Title" class="<?php echo $Payroll_Net_Schedule_summary->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->Title) ?>', 1);"><div class="Payroll_Net_Schedule_Title">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->Title->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Surname->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->Surname) == "") { ?>
	<th data-name="Surname" class="<?php echo $Payroll_Net_Schedule_summary->Surname->headerCellClass() ?>"><div class="Payroll_Net_Schedule_Surname"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->Surname->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Surname" class="<?php echo $Payroll_Net_Schedule_summary->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->Surname) ?>', 1);"><div class="Payroll_Net_Schedule_Surname">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->FirstName->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->FirstName) == "") { ?>
	<th data-name="FirstName" class="<?php echo $Payroll_Net_Schedule_summary->FirstName->headerCellClass() ?>"><div class="Payroll_Net_Schedule_FirstName"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FirstName" class="<?php echo $Payroll_Net_Schedule_summary->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->FirstName) ?>', 1);"><div class="Payroll_Net_Schedule_FirstName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->MiddleName->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->MiddleName) == "") { ?>
	<th data-name="MiddleName" class="<?php echo $Payroll_Net_Schedule_summary->MiddleName->headerCellClass() ?>"><div class="Payroll_Net_Schedule_MiddleName"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MiddleName" class="<?php echo $Payroll_Net_Schedule_summary->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->MiddleName) ?>', 1);"><div class="Payroll_Net_Schedule_MiddleName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PositionName->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->PositionName) == "") { ?>
	<th data-name="PositionName" class="<?php echo $Payroll_Net_Schedule_summary->PositionName->headerCellClass() ?>"><div class="Payroll_Net_Schedule_PositionName"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PositionName" class="<?php echo $Payroll_Net_Schedule_summary->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->PositionName) ?>', 1);"><div class="Payroll_Net_Schedule_PositionName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Net_Pay->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->Net_Pay) == "") { ?>
	<th data-name="Net_Pay" class="<?php echo $Payroll_Net_Schedule_summary->Net_Pay->headerCellClass() ?>"><div class="Payroll_Net_Schedule_Net_Pay"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->Net_Pay->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Net_Pay" class="<?php echo $Payroll_Net_Schedule_summary->Net_Pay->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->Net_Pay) ?>', 1);"><div class="Payroll_Net_Schedule_Net_Pay">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->Net_Pay->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->Net_Pay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->Net_Pay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->NetPay->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->NetPay) == "") { ?>
	<th data-name="NetPay" class="<?php echo $Payroll_Net_Schedule_summary->NetPay->headerCellClass() ?>"><div class="Payroll_Net_Schedule_NetPay"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->NetPay->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="NetPay" class="<?php echo $Payroll_Net_Schedule_summary->NetPay->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->NetPay) ?>', 1);"><div class="Payroll_Net_Schedule_NetPay">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->NetPay->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->NetPay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->NetPay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PaymentMethod->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->PaymentMethod) == "") { ?>
	<th data-name="PaymentMethod" class="<?php echo $Payroll_Net_Schedule_summary->PaymentMethod->headerCellClass() ?>"><div class="Payroll_Net_Schedule_PaymentMethod"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PaymentMethod" class="<?php echo $Payroll_Net_Schedule_summary->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->PaymentMethod) ?>', 1);"><div class="Payroll_Net_Schedule_PaymentMethod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankBranchCode->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->BankBranchCode) == "") { ?>
	<th data-name="BankBranchCode" class="<?php echo $Payroll_Net_Schedule_summary->BankBranchCode->headerCellClass() ?>"><div class="Payroll_Net_Schedule_BankBranchCode"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->BankBranchCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="BankBranchCode" class="<?php echo $Payroll_Net_Schedule_summary->BankBranchCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->BankBranchCode) ?>', 1);"><div class="Payroll_Net_Schedule_BankBranchCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->BankBranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->BankBranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->BankBranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankAccountNo->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->BankAccountNo) == "") { ?>
	<th data-name="BankAccountNo" class="<?php echo $Payroll_Net_Schedule_summary->BankAccountNo->headerCellClass() ?>"><div class="Payroll_Net_Schedule_BankAccountNo"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="BankAccountNo" class="<?php echo $Payroll_Net_Schedule_summary->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->BankAccountNo) ?>', 1);"><div class="Payroll_Net_Schedule_BankAccountNo">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->BankAccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->EmployeeID->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->EmployeeID) == "") { ?>
	<th data-name="EmployeeID" class="<?php echo $Payroll_Net_Schedule_summary->EmployeeID->headerCellClass() ?>"><div class="Payroll_Net_Schedule_EmployeeID"><div class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="EmployeeID" class="<?php echo $Payroll_Net_Schedule_summary->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->EmployeeID) ?>', 1);"><div class="Payroll_Net_Schedule_EmployeeID">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Payroll_Net_Schedule_summary->TotalGroups == 0)
			break; // Show header only
		$Payroll_Net_Schedule_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Payroll_Net_Schedule_summary->LocalAuthority, $Payroll_Net_Schedule_summary->getSqlFirstGroupField(), $Payroll_Net_Schedule_summary->LocalAuthority->groupValue(), $Payroll_Net_Schedule_summary->Dbid);
	if ($Payroll_Net_Schedule_summary->PageFirstGroupFilter != "") $Payroll_Net_Schedule_summary->PageFirstGroupFilter .= " OR ";
	$Payroll_Net_Schedule_summary->PageFirstGroupFilter .= $where;
	if ($Payroll_Net_Schedule_summary->Filter != "")
		$where = "($Payroll_Net_Schedule_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Payroll_Net_Schedule_summary->getSqlSelect(), $Payroll_Net_Schedule_summary->getSqlWhere(), $Payroll_Net_Schedule_summary->getSqlGroupBy(), $Payroll_Net_Schedule_summary->getSqlHaving(), $Payroll_Net_Schedule_summary->getSqlOrderBy(), $where, $Payroll_Net_Schedule_summary->Sort);
	$rs = $Payroll_Net_Schedule_summary->getRecordset($sql);
	$Payroll_Net_Schedule_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Payroll_Net_Schedule_summary->DetailRecordCount = count($Payroll_Net_Schedule_summary->DetailRecords);

	// Load detail records
	$Payroll_Net_Schedule_summary->LocalAuthority->Records = &$Payroll_Net_Schedule_summary->DetailRecords;
	$Payroll_Net_Schedule_summary->LocalAuthority->LevelBreak = TRUE; // Set field level break
		$Payroll_Net_Schedule_summary->GroupCounter[1] = $Payroll_Net_Schedule_summary->GroupCount;
		$Payroll_Net_Schedule_summary->LocalAuthority->getCnt($Payroll_Net_Schedule_summary->LocalAuthority->Records); // Get record count
?>
<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->Visible && $Payroll_Net_Schedule_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payroll_Net_Schedule_summary->resetAttributes();
		$Payroll_Net_Schedule_summary->RowType = ROWTYPE_TOTAL;
		$Payroll_Net_Schedule_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payroll_Net_Schedule_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payroll_Net_Schedule_summary->RowGroupLevel = 1;
		$Payroll_Net_Schedule_summary->renderRow();
?>
	<tr<?php echo $Payroll_Net_Schedule_summary->rowAttributes(); ?>>
<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="LocalAuthority" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->cellAttributes() ?>>
<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->LocalAuthority) == "") { ?>
		<span class="ew-summary-caption Payroll_Net_Schedule_LocalAuthority"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->LocalAuthority->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payroll_Net_Schedule_LocalAuthority" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->LocalAuthority) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->LocalAuthority->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->LocalAuthority->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Net_Schedule_summary->LocalAuthority->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payroll_Net_Schedule_summary->PayrollPeriod->getDistinctValues($Payroll_Net_Schedule_summary->LocalAuthority->Records);
	$Payroll_Net_Schedule_summary->setGroupCount(count($Payroll_Net_Schedule_summary->PayrollPeriod->DistinctValues), $Payroll_Net_Schedule_summary->GroupCounter[1]);
	$Payroll_Net_Schedule_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($Payroll_Net_Schedule_summary->PayrollPeriod->DistinctValues as $PayrollPeriod) { // Load records for this distinct value
		$Payroll_Net_Schedule_summary->PayrollPeriod->setGroupValue($PayrollPeriod); // Set group value
		$Payroll_Net_Schedule_summary->PayrollPeriod->getDistinctRecords($Payroll_Net_Schedule_summary->LocalAuthority->Records, $Payroll_Net_Schedule_summary->PayrollPeriod->groupValue());
		$Payroll_Net_Schedule_summary->PayrollPeriod->LevelBreak = TRUE; // Set field level break
		$Payroll_Net_Schedule_summary->GroupCounter[2]++;
		$Payroll_Net_Schedule_summary->PayrollPeriod->getCnt($Payroll_Net_Schedule_summary->PayrollPeriod->Records); // Get record count
?>
<?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->Visible && $Payroll_Net_Schedule_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payroll_Net_Schedule_summary->PayrollPeriod->setDbValue($PayrollPeriod); // Set current value for PayrollPeriod
		$Payroll_Net_Schedule_summary->resetAttributes();
		$Payroll_Net_Schedule_summary->RowType = ROWTYPE_TOTAL;
		$Payroll_Net_Schedule_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payroll_Net_Schedule_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payroll_Net_Schedule_summary->RowGroupLevel = 2;
		$Payroll_Net_Schedule_summary->renderRow();
?>
	<tr<?php echo $Payroll_Net_Schedule_summary->rowAttributes(); ?>>
<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="PayrollPeriod" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->cellAttributes() ?>>
<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->PayrollPeriod) == "") { ?>
		<span class="ew-summary-caption Payroll_Net_Schedule_PayrollPeriod"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payroll_Net_Schedule_PayrollPeriod" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->PayrollPeriod) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Net_Schedule_summary->PayrollPeriod->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payroll_Net_Schedule_summary->Division->getDistinctValues($Payroll_Net_Schedule_summary->PayrollPeriod->Records);
	$Payroll_Net_Schedule_summary->setGroupCount(count($Payroll_Net_Schedule_summary->Division->DistinctValues), $Payroll_Net_Schedule_summary->GroupCounter[1], $Payroll_Net_Schedule_summary->GroupCounter[2]);
	$Payroll_Net_Schedule_summary->GroupCounter[3] = 0; // Init group count index
	foreach ($Payroll_Net_Schedule_summary->Division->DistinctValues as $Division) { // Load records for this distinct value
		$Payroll_Net_Schedule_summary->Division->setGroupValue($Division); // Set group value
		$Payroll_Net_Schedule_summary->Division->getDistinctRecords($Payroll_Net_Schedule_summary->PayrollPeriod->Records, $Payroll_Net_Schedule_summary->Division->groupValue());
		$Payroll_Net_Schedule_summary->Division->LevelBreak = TRUE; // Set field level break
		$Payroll_Net_Schedule_summary->GroupCounter[3]++;
		$Payroll_Net_Schedule_summary->Division->getCnt($Payroll_Net_Schedule_summary->Division->Records); // Get record count
		$Payroll_Net_Schedule_summary->setGroupCount($Payroll_Net_Schedule_summary->Division->Count, $Payroll_Net_Schedule_summary->GroupCounter[1], $Payroll_Net_Schedule_summary->GroupCounter[2], $Payroll_Net_Schedule_summary->GroupCounter[3]);
?>
<?php if ($Payroll_Net_Schedule_summary->Division->Visible && $Payroll_Net_Schedule_summary->Division->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payroll_Net_Schedule_summary->Division->setDbValue($Division); // Set current value for Division
		$Payroll_Net_Schedule_summary->resetAttributes();
		$Payroll_Net_Schedule_summary->RowType = ROWTYPE_TOTAL;
		$Payroll_Net_Schedule_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payroll_Net_Schedule_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payroll_Net_Schedule_summary->RowGroupLevel = 3;
		$Payroll_Net_Schedule_summary->renderRow();
?>
	<tr<?php echo $Payroll_Net_Schedule_summary->rowAttributes(); ?>>
<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Division->Visible) { ?>
		<td data-field="Division"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="Division" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 3) ?>"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>>
<?php if ($Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->Division) == "") { ?>
		<span class="ew-summary-caption Payroll_Net_Schedule_Division"><span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->Division->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payroll_Net_Schedule_Division" onclick="ew.sort(event, '<?php echo $Payroll_Net_Schedule_summary->sortUrl($Payroll_Net_Schedule_summary->Division) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payroll_Net_Schedule_summary->Division->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payroll_Net_Schedule_summary->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payroll_Net_Schedule_summary->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payroll_Net_Schedule_summary->Division->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->Division->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Net_Schedule_summary->Division->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payroll_Net_Schedule_summary->RecordCount = 0; // Reset record count
	foreach ($Payroll_Net_Schedule_summary->Division->Records as $record) {
		$Payroll_Net_Schedule_summary->RecordCount++;
		$Payroll_Net_Schedule_summary->RecordIndex++;
		$Payroll_Net_Schedule_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Payroll_Net_Schedule_summary->resetAttributes();
		$Payroll_Net_Schedule_summary->RowType = ROWTYPE_DETAIL;
		$Payroll_Net_Schedule_summary->renderRow();
?>
	<tr<?php echo $Payroll_Net_Schedule_summary->rowAttributes(); ?>>
<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->cellAttributes(); ?>><span<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->LocalAuthority->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->cellAttributes(); ?>><span<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Division->Visible) { ?>
	<?php if ($Payroll_Net_Schedule_summary->Division->ShowGroupHeaderAsRow) { ?>
		<td data-field="Division"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="Division"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes(); ?>><span<?php echo $Payroll_Net_Schedule_summary->Division->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->Division->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Net_Schedule_summary->Title->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->Title->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->Title->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Net_Schedule_summary->Surname->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->Surname->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->Surname->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Net_Schedule_summary->FirstName->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->FirstName->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->FirstName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Net_Schedule_summary->MiddleName->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->MiddleName->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->MiddleName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Net_Schedule_summary->PositionName->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->PositionName->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->PositionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Net_Pay->Visible) { ?>
		<td data-field="Net_Pay"<?php echo $Payroll_Net_Schedule_summary->Net_Pay->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->Net_Pay->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->Net_Pay->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->NetPay->Visible) { ?>
		<td data-field="NetPay"<?php echo $Payroll_Net_Schedule_summary->NetPay->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->NetPay->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->NetPay->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Net_Schedule_summary->PaymentMethod->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->PaymentMethod->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->PaymentMethod->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Net_Schedule_summary->BankBranchCode->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->BankBranchCode->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->BankBranchCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Net_Schedule_summary->BankAccountNo->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->BankAccountNo->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->BankAccountNo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $Payroll_Net_Schedule_summary->EmployeeID->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->EmployeeID->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->EmployeeID->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Payroll_Net_Schedule_summary->TotalGroups > 0) { ?>
<?php
	$Payroll_Net_Schedule_summary->NetPay->getSum($Payroll_Net_Schedule_summary->Division->Records); // Get Sum
	$Payroll_Net_Schedule_summary->resetAttributes();
	$Payroll_Net_Schedule_summary->RowType = ROWTYPE_TOTAL;
	$Payroll_Net_Schedule_summary->RowTotalType = ROWTOTAL_GROUP;
	$Payroll_Net_Schedule_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Payroll_Net_Schedule_summary->RowGroupLevel = 3;
	$Payroll_Net_Schedule_summary->renderRow();
?>
<?php if ($Payroll_Net_Schedule_summary->Division->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Payroll_Net_Schedule_summary->rowAttributes(); ?>>
<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->cellAttributes() ?>>
	<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Net_Schedule_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Net_Schedule_summary->LocalAuthority->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->cellAttributes() ?>>
	<?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Net_Schedule_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Net_Schedule_summary->PayrollPeriod->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Division->Visible) { ?>
		<td data-field="Division"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>>
	<?php if ($Payroll_Net_Schedule_summary->Division->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Payroll_Net_Schedule_summary->RowGroupLevel != 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Net_Schedule_summary->Division->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Net_Pay->Visible) { ?>
		<td data-field="Net_Pay"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->NetPay->Visible) { ?>
		<td data-field="NetPay"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Payroll_Net_Schedule_summary->NetPay->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->NetPay->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Payroll_Net_Schedule_summary->rowAttributes(); ?>>
<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->SubGroupColumnCount + $Payroll_Net_Schedule_summary->DetailColumnCount - 1 > 0) { ?>
		<td colspan="<?php echo ($Payroll_Net_Schedule_summary->SubGroupColumnCount + $Payroll_Net_Schedule_summary->DetailColumnCount - 1) ?>"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Payroll_Net_Schedule_summary->Division->GroupViewValue, $Payroll_Net_Schedule_summary->Division->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Payroll_Net_Schedule_summary->Division->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Payroll_Net_Schedule_summary->rowAttributes(); ?>>
<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payroll_Net_Schedule_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Payroll_Net_Schedule_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Payroll_Net_Schedule_summary->GroupColumnCount - 2) ?>"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Net_Pay->Visible) { ?>
		<td data-field="Net_Pay"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->NetPay->Visible) { ?>
		<td data-field="NetPay"<?php echo $Payroll_Net_Schedule_summary->NetPay->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->NetPay->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->NetPay->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $Payroll_Net_Schedule_summary->Division->cellAttributes() ?>>&nbsp;</td>
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
	$Payroll_Net_Schedule_summary->loadGroupRowValues();

	// Show header if page break
	if ($Payroll_Net_Schedule_summary->isExport())
		$Payroll_Net_Schedule_summary->ShowHeader = ($Payroll_Net_Schedule_summary->ExportPageBreakCount == 0) ? FALSE : ($Payroll_Net_Schedule_summary->GroupCount % $Payroll_Net_Schedule_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Payroll_Net_Schedule_summary->ShowHeader)
		$Payroll_Net_Schedule_summary->Page_Breaking($Payroll_Net_Schedule_summary->ShowHeader, $Payroll_Net_Schedule_summary->PageBreakContent);
	$Payroll_Net_Schedule_summary->GroupCount++;
} // End while
?>
<?php if ($Payroll_Net_Schedule_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Payroll_Net_Schedule_summary->resetAttributes();
	$Payroll_Net_Schedule_summary->RowType = ROWTYPE_TOTAL;
	$Payroll_Net_Schedule_summary->RowTotalType = ROWTOTAL_GRAND;
	$Payroll_Net_Schedule_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Payroll_Net_Schedule_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Payroll_Net_Schedule_summary->renderRow();
?>
<?php if ($Payroll_Net_Schedule_summary->LocalAuthority->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Payroll_Net_Schedule_summary->rowAttributes() ?>><td colspan="<?php echo ($Payroll_Net_Schedule_summary->GroupColumnCount + $Payroll_Net_Schedule_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payroll_Net_Schedule_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Payroll_Net_Schedule_summary->rowAttributes() ?>>
<?php if ($Payroll_Net_Schedule_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Payroll_Net_Schedule_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Net_Schedule_summary->Title->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Net_Schedule_summary->Surname->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Net_Schedule_summary->FirstName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Net_Schedule_summary->MiddleName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Net_Schedule_summary->PositionName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Net_Pay->Visible) { ?>
		<td data-field="Net_Pay"<?php echo $Payroll_Net_Schedule_summary->Net_Pay->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->NetPay->Visible) { ?>
		<td data-field="NetPay"<?php echo $Payroll_Net_Schedule_summary->NetPay->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Payroll_Net_Schedule_summary->NetPay->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->NetPay->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Net_Schedule_summary->PaymentMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Net_Schedule_summary->BankBranchCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Net_Schedule_summary->BankAccountNo->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $Payroll_Net_Schedule_summary->EmployeeID->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Payroll_Net_Schedule_summary->rowAttributes() ?>><td colspan="<?php echo ($Payroll_Net_Schedule_summary->GroupColumnCount + $Payroll_Net_Schedule_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Payroll_Net_Schedule_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Payroll_Net_Schedule_summary->rowAttributes() ?>>
<?php if ($Payroll_Net_Schedule_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Payroll_Net_Schedule_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Payroll_Net_Schedule_summary->Title->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Payroll_Net_Schedule_summary->Surname->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Payroll_Net_Schedule_summary->FirstName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Payroll_Net_Schedule_summary->MiddleName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Payroll_Net_Schedule_summary->PositionName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->Net_Pay->Visible) { ?>
		<td data-field="Net_Pay"<?php echo $Payroll_Net_Schedule_summary->Net_Pay->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->NetPay->Visible) { ?>
		<td data-field="NetPay"<?php echo $Payroll_Net_Schedule_summary->NetPay->cellAttributes() ?>>
<span<?php echo $Payroll_Net_Schedule_summary->NetPay->viewAttributes() ?>><?php echo $Payroll_Net_Schedule_summary->NetPay->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->PaymentMethod->Visible) { ?>
		<td data-field="PaymentMethod"<?php echo $Payroll_Net_Schedule_summary->PaymentMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankBranchCode->Visible) { ?>
		<td data-field="BankBranchCode"<?php echo $Payroll_Net_Schedule_summary->BankBranchCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->BankAccountNo->Visible) { ?>
		<td data-field="BankAccountNo"<?php echo $Payroll_Net_Schedule_summary->BankAccountNo->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->EmployeeID->Visible) { ?>
		<td data-field="EmployeeID"<?php echo $Payroll_Net_Schedule_summary->EmployeeID->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$Payroll_Net_Schedule_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Payroll_Net_Schedule_summary->TotalGroups > 0) { ?>
<?php if (!$Payroll_Net_Schedule_summary->isExport() && !($Payroll_Net_Schedule_summary->DrillDown && $Payroll_Net_Schedule_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payroll_Net_Schedule_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Payroll_Net_Schedule_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Payroll_Net_Schedule_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Payroll_Net_Schedule_summary->isExport() || $Payroll_Net_Schedule_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Payroll_Net_Schedule_summary->isExport() || $Payroll_Net_Schedule_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Payroll_Net_Schedule_summary->isExport() || $Payroll_Net_Schedule_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Payroll_Net_Schedule_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Payroll_Net_Schedule_summary->isExport() && !$Payroll_Net_Schedule_summary->DrillDown && !$DashboardReport) { ?>
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
$Payroll_Net_Schedule_summary->terminate();
?>