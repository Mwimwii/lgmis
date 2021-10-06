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
$Vacancy_Report_summary = new Vacancy_Report_summary();

// Run the page
$Vacancy_Report_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Vacancy_Report_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Vacancy_Report_summary->isExport() && !$Vacancy_Report_summary->DrillDown && !$DashboardReport) { ?>
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
		elm = this.getElements("x" + infix + "_DepartmentCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Vacancy_Report_summary->DepartmentCode->errorMessage()) ?>");

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
	fsummary.lists["x_ProvinceCode"] = <?php echo $Vacancy_Report_summary->ProvinceCode->Lookup->toClientList($Vacancy_Report_summary) ?>;
	fsummary.lists["x_ProvinceCode"].options = <?php echo JsonEncode($Vacancy_Report_summary->ProvinceCode->lookupOptions()) ?>;
	fsummary.lists["x_LACode"] = <?php echo $Vacancy_Report_summary->LACode->Lookup->toClientList($Vacancy_Report_summary) ?>;
	fsummary.lists["x_LACode"].options = <?php echo JsonEncode($Vacancy_Report_summary->LACode->lookupOptions()) ?>;
	fsummary.lists["x_DepartmentCode"] = <?php echo $Vacancy_Report_summary->DepartmentCode->Lookup->toClientList($Vacancy_Report_summary) ?>;
	fsummary.lists["x_DepartmentCode"].options = <?php echo JsonEncode($Vacancy_Report_summary->DepartmentCode->lookupOptions()) ?>;
	fsummary.autoSuggests["x_DepartmentCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fsummary.lists["x_SectionCode"] = <?php echo $Vacancy_Report_summary->SectionCode->Lookup->toClientList($Vacancy_Report_summary) ?>;
	fsummary.lists["x_SectionCode"].options = <?php echo JsonEncode($Vacancy_Report_summary->SectionCode->lookupOptions()) ?>;
	fsummary.lists["x_PositionCode"] = <?php echo $Vacancy_Report_summary->PositionCode->Lookup->toClientList($Vacancy_Report_summary) ?>;
	fsummary.lists["x_PositionCode"].options = <?php echo JsonEncode($Vacancy_Report_summary->PositionCode->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $Vacancy_Report_summary->getFilterList() ?>;

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
<?php if ((!$Vacancy_Report_summary->isExport() || $Vacancy_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Vacancy_Report_summary->ShowCurrentFilter) { ?>
<?php $Vacancy_Report_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Vacancy_Report_summary->DrillDownInPanel) {
	$Vacancy_Report_summary->ExportOptions->render("body");
	$Vacancy_Report_summary->SearchOptions->render("body");
	$Vacancy_Report_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Vacancy_Report_summary->showPageHeader(); ?>
<?php
$Vacancy_Report_summary->showMessage();
?>
<?php if ((!$Vacancy_Report_summary->isExport() || $Vacancy_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Vacancy_Report_summary->isExport() || $Vacancy_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Vacancy_Report_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$Vacancy_Report_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$Vacancy_Report_summary->isExport() && !$Vacancy_Report_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Vacancy_Report_summary->isExport() && !$Vacancy_Report->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Vacancy_Report_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Vacancy_Report">
	<div class="ew-extended-search">
<?php

// Render search row
$Vacancy_Report->RowType = ROWTYPE_SEARCH;
$Vacancy_Report->resetAttributes();
$Vacancy_Report_summary->renderRow();
?>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php
		$Vacancy_Report_summary->SearchColumnCount++;
		if (($Vacancy_Report_summary->SearchColumnCount - 1) % $Vacancy_Report_summary->SearchFieldsPerRow == 0) {
			$Vacancy_Report_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Vacancy_Report_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ProvinceCode" class="ew-cell form-group">
		<label for="x_ProvinceCode" class="ew-search-caption ew-label"><?php echo $Vacancy_Report_summary->ProvinceCode->caption() ?></label>
		<span id="el_Vacancy_Report_ProvinceCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Vacancy_Report" data-field="x_ProvinceCode" data-value-separator="<?php echo $Vacancy_Report_summary->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->editAttributes() ?>>
			<?php echo $Vacancy_Report_summary->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $Vacancy_Report_summary->ProvinceCode->Lookup->getParamTag($Vacancy_Report_summary, "p_x_ProvinceCode") ?>
</span>
	</div>
	<?php if ($Vacancy_Report_summary->SearchColumnCount % $Vacancy_Report_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->LACode->Visible) { // LACode ?>
	<?php
		$Vacancy_Report_summary->SearchColumnCount++;
		if (($Vacancy_Report_summary->SearchColumnCount - 1) % $Vacancy_Report_summary->SearchFieldsPerRow == 0) {
			$Vacancy_Report_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Vacancy_Report_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LACode" class="ew-cell form-group">
		<label for="x_LACode" class="ew-search-caption ew-label"><?php echo $Vacancy_Report_summary->LACode->caption() ?></label>
		<span id="el_Vacancy_Report_LACode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Vacancy_Report" data-field="x_LACode" data-value-separator="<?php echo $Vacancy_Report_summary->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $Vacancy_Report_summary->LACode->editAttributes() ?>>
			<?php echo $Vacancy_Report_summary->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $Vacancy_Report_summary->LACode->Lookup->getParamTag($Vacancy_Report_summary, "p_x_LACode") ?>
</span>
	</div>
	<?php if ($Vacancy_Report_summary->SearchColumnCount % $Vacancy_Report_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php
		$Vacancy_Report_summary->SearchColumnCount++;
		if (($Vacancy_Report_summary->SearchColumnCount - 1) % $Vacancy_Report_summary->SearchFieldsPerRow == 0) {
			$Vacancy_Report_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Vacancy_Report_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_DepartmentCode" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $Vacancy_Report_summary->DepartmentCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		<span id="el_Vacancy_Report_DepartmentCode" class="ew-search-field">
<?php
$onchange = $Vacancy_Report_summary->DepartmentCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Vacancy_Report_summary->DepartmentCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_DepartmentCode">
	<input type="text" class="form-control" name="sv_x_DepartmentCode" id="sv_x_DepartmentCode" value="<?php echo RemoveHtml($Vacancy_Report_summary->DepartmentCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($Vacancy_Report_summary->DepartmentCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($Vacancy_Report_summary->DepartmentCode->getPlaceHolder()) ?>"<?php echo $Vacancy_Report_summary->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="Vacancy_Report" data-field="x_DepartmentCode" data-value-separator="<?php echo $Vacancy_Report_summary->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo HtmlEncode($Vacancy_Report_summary->DepartmentCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fsummary"], function() {
	fsummary.createAutoSuggest({"id":"x_DepartmentCode","forceSelect":false});
});
</script>
<?php echo $Vacancy_Report_summary->DepartmentCode->Lookup->getParamTag($Vacancy_Report_summary, "p_x_DepartmentCode") ?>
</span>
	</div>
	<?php if ($Vacancy_Report_summary->SearchColumnCount % $Vacancy_Report_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionCode->Visible) { // SectionCode ?>
	<?php
		$Vacancy_Report_summary->SearchColumnCount++;
		if (($Vacancy_Report_summary->SearchColumnCount - 1) % $Vacancy_Report_summary->SearchFieldsPerRow == 0) {
			$Vacancy_Report_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Vacancy_Report_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_SectionCode" class="ew-cell form-group">
		<label for="x_SectionCode" class="ew-search-caption ew-label"><?php echo $Vacancy_Report_summary->SectionCode->caption() ?></label>
		<span id="el_Vacancy_Report_SectionCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Vacancy_Report" data-field="x_SectionCode" data-value-separator="<?php echo $Vacancy_Report_summary->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $Vacancy_Report_summary->SectionCode->editAttributes() ?>>
			<?php echo $Vacancy_Report_summary->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $Vacancy_Report_summary->SectionCode->Lookup->getParamTag($Vacancy_Report_summary, "p_x_SectionCode") ?>
</span>
	</div>
	<?php if ($Vacancy_Report_summary->SearchColumnCount % $Vacancy_Report_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionCode->Visible) { // PositionCode ?>
	<?php
		$Vacancy_Report_summary->SearchColumnCount++;
		if (($Vacancy_Report_summary->SearchColumnCount - 1) % $Vacancy_Report_summary->SearchFieldsPerRow == 0) {
			$Vacancy_Report_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Vacancy_Report_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PositionCode" class="ew-cell form-group">
		<label for="x_PositionCode" class="ew-search-caption ew-label"><?php echo $Vacancy_Report_summary->PositionCode->caption() ?></label>
		<span id="el_Vacancy_Report_PositionCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Vacancy_Report" data-field="x_PositionCode" data-value-separator="<?php echo $Vacancy_Report_summary->PositionCode->displayValueSeparatorAttribute() ?>" id="x_PositionCode" name="x_PositionCode"<?php echo $Vacancy_Report_summary->PositionCode->editAttributes() ?>>
			<?php echo $Vacancy_Report_summary->PositionCode->selectOptionListHtml("x_PositionCode") ?>
		</select>
</div>
<?php echo $Vacancy_Report_summary->PositionCode->Lookup->getParamTag($Vacancy_Report_summary, "p_x_PositionCode") ?>
</span>
	</div>
	<?php if ($Vacancy_Report_summary->SearchColumnCount % $Vacancy_Report_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Vacancy_Report_summary->SearchColumnCount % $Vacancy_Report_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Vacancy_Report_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Vacancy_Report_summary->GroupCount <= count($Vacancy_Report_summary->GroupRecords) && $Vacancy_Report_summary->GroupCount <= $Vacancy_Report_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Vacancy_Report_summary->ShowHeader) {
?>
<?php if ($Vacancy_Report_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$Vacancy_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Vacancy_Report_summary->TotalGroups > 0) { ?>
<?php if (!$Vacancy_Report_summary->isExport() && !($Vacancy_Report_summary->DrillDown && $Vacancy_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Vacancy_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Vacancy_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $Vacancy_Report_summary->PageBreakContent ?>
<?php } ?>
<?php if (!$Vacancy_Report_summary->isExport("pdf")) { ?>
<div class="<?php if (!$Vacancy_Report_summary->isExport("word") && !$Vacancy_Report_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Vacancy_Report_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Vacancy_Report_summary->isExport() && !($Vacancy_Report_summary->DrillDown && $Vacancy_Report_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Vacancy_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Vacancy_Report_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Vacancy_Report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Vacancy_Report_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
	<?php if ($Vacancy_Report_summary->ProvinceCode->ShowGroupHeaderAsRow) { ?>
	<th data-name="ProvinceCode">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->ProvinceCode) == "") { ?>
	<th data-name="ProvinceCode" class="<?php echo $Vacancy_Report_summary->ProvinceCode->headerCellClass() ?>"><div class="Vacancy_Report_ProvinceCode"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->ProvinceCode->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="ProvinceCode" class="<?php echo $Vacancy_Report_summary->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->ProvinceCode) ?>', 1);"><div class="Vacancy_Report_ProvinceCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->LACode->Visible) { ?>
	<?php if ($Vacancy_Report_summary->LACode->ShowGroupHeaderAsRow) { ?>
	<th data-name="LACode">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->LACode) == "") { ?>
	<th data-name="LACode" class="<?php echo $Vacancy_Report_summary->LACode->headerCellClass() ?>"><div class="Vacancy_Report_LACode"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->LACode->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="LACode" class="<?php echo $Vacancy_Report_summary->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->LACode) ?>', 1);"><div class="Vacancy_Report_LACode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentCode->Visible) { ?>
	<?php if ($Vacancy_Report_summary->DepartmentCode->ShowGroupHeaderAsRow) { ?>
	<th data-name="DepartmentCode">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->DepartmentCode) == "") { ?>
	<th data-name="DepartmentCode" class="<?php echo $Vacancy_Report_summary->DepartmentCode->headerCellClass() ?>"><div class="Vacancy_Report_DepartmentCode"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->DepartmentCode->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="DepartmentCode" class="<?php echo $Vacancy_Report_summary->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->DepartmentCode) ?>', 1);"><div class="Vacancy_Report_DepartmentCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionCode->Visible) { ?>
	<?php if ($Vacancy_Report_summary->SectionCode->ShowGroupHeaderAsRow) { ?>
	<th data-name="SectionCode">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->SectionCode) == "") { ?>
	<th data-name="SectionCode" class="<?php echo $Vacancy_Report_summary->SectionCode->headerCellClass() ?>"><div class="Vacancy_Report_SectionCode"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->SectionCode->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="SectionCode" class="<?php echo $Vacancy_Report_summary->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->SectionCode) ?>', 1);"><div class="Vacancy_Report_SectionCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionCode->Visible) { ?>
	<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->PositionCode) == "") { ?>
	<th data-name="PositionCode" class="<?php echo $Vacancy_Report_summary->PositionCode->headerCellClass() ?>"><div class="Vacancy_Report_PositionCode"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->PositionCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PositionCode" class="<?php echo $Vacancy_Report_summary->PositionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->PositionCode) ?>', 1);"><div class="Vacancy_Report_PositionCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->PositionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->PositionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->PositionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->SalaryScale->Visible) { ?>
	<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->SalaryScale) == "") { ?>
	<th data-name="SalaryScale" class="<?php echo $Vacancy_Report_summary->SalaryScale->headerCellClass() ?>"><div class="Vacancy_Report_SalaryScale"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="SalaryScale" class="<?php echo $Vacancy_Report_summary->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->SalaryScale) ?>', 1);"><div class="Vacancy_Report_SalaryScale">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionName->Visible) { ?>
	<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->PositionName) == "") { ?>
	<th data-name="PositionName" class="<?php echo $Vacancy_Report_summary->PositionName->headerCellClass() ?>"><div class="Vacancy_Report_PositionName"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PositionName" class="<?php echo $Vacancy_Report_summary->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->PositionName) ?>', 1);"><div class="Vacancy_Report_PositionName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->RequisiteQualification->Visible) { ?>
	<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->RequisiteQualification) == "") { ?>
	<th data-name="RequisiteQualification" class="<?php echo $Vacancy_Report_summary->RequisiteQualification->headerCellClass() ?>"><div class="Vacancy_Report_RequisiteQualification"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->RequisiteQualification->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="RequisiteQualification" class="<?php echo $Vacancy_Report_summary->RequisiteQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->RequisiteQualification) ?>', 1);"><div class="Vacancy_Report_RequisiteQualification">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->RequisiteQualification->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->RequisiteQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->RequisiteQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->FieldQualified->Visible) { ?>
	<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->FieldQualified) == "") { ?>
	<th data-name="FieldQualified" class="<?php echo $Vacancy_Report_summary->FieldQualified->headerCellClass() ?>"><div class="Vacancy_Report_FieldQualified"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->FieldQualified->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FieldQualified" class="<?php echo $Vacancy_Report_summary->FieldQualified->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->FieldQualified) ?>', 1);"><div class="Vacancy_Report_FieldQualified">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->FieldQualified->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->FieldQualified->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->FieldQualified->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentName->Visible) { ?>
	<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->DepartmentName) == "") { ?>
	<th data-name="DepartmentName" class="<?php echo $Vacancy_Report_summary->DepartmentName->headerCellClass() ?>"><div class="Vacancy_Report_DepartmentName"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->DepartmentName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="DepartmentName" class="<?php echo $Vacancy_Report_summary->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->DepartmentName) ?>', 1);"><div class="Vacancy_Report_DepartmentName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->DepartmentName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionName->Visible) { ?>
	<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->SectionName) == "") { ?>
	<th data-name="SectionName" class="<?php echo $Vacancy_Report_summary->SectionName->headerCellClass() ?>"><div class="Vacancy_Report_SectionName"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->SectionName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="SectionName" class="<?php echo $Vacancy_Report_summary->SectionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->SectionName) ?>', 1);"><div class="Vacancy_Report_SectionName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->SectionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->CouncilType->Visible) { ?>
	<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->CouncilType) == "") { ?>
	<th data-name="CouncilType" class="<?php echo $Vacancy_Report_summary->CouncilType->headerCellClass() ?>"><div class="Vacancy_Report_CouncilType"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->CouncilType->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="CouncilType" class="<?php echo $Vacancy_Report_summary->CouncilType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->CouncilType) ?>', 1);"><div class="Vacancy_Report_CouncilType">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->CouncilType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->CouncilType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->EmploymentStatus->Visible) { ?>
	<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->EmploymentStatus) == "") { ?>
	<th data-name="EmploymentStatus" class="<?php echo $Vacancy_Report_summary->EmploymentStatus->headerCellClass() ?>"><div class="Vacancy_Report_EmploymentStatus"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->EmploymentStatus->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="EmploymentStatus" class="<?php echo $Vacancy_Report_summary->EmploymentStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->EmploymentStatus) ?>', 1);"><div class="Vacancy_Report_EmploymentStatus">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->EmploymentStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->EmploymentStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->EmploymentStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->MonthsVacant->Visible) { ?>
	<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->MonthsVacant) == "") { ?>
	<th data-name="MonthsVacant" class="<?php echo $Vacancy_Report_summary->MonthsVacant->headerCellClass() ?>"><div class="Vacancy_Report_MonthsVacant"><div class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->MonthsVacant->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MonthsVacant" class="<?php echo $Vacancy_Report_summary->MonthsVacant->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->MonthsVacant) ?>', 1);"><div class="Vacancy_Report_MonthsVacant">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->MonthsVacant->caption() ?></span><span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->MonthsVacant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->MonthsVacant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Vacancy_Report_summary->TotalGroups == 0)
			break; // Show header only
		$Vacancy_Report_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Vacancy_Report_summary->ProvinceCode, $Vacancy_Report_summary->getSqlFirstGroupField(), $Vacancy_Report_summary->ProvinceCode->groupValue(), $Vacancy_Report_summary->Dbid);
	if ($Vacancy_Report_summary->PageFirstGroupFilter != "") $Vacancy_Report_summary->PageFirstGroupFilter .= " OR ";
	$Vacancy_Report_summary->PageFirstGroupFilter .= $where;
	if ($Vacancy_Report_summary->Filter != "")
		$where = "($Vacancy_Report_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Vacancy_Report_summary->getSqlSelect(), $Vacancy_Report_summary->getSqlWhere(), $Vacancy_Report_summary->getSqlGroupBy(), $Vacancy_Report_summary->getSqlHaving(), $Vacancy_Report_summary->getSqlOrderBy(), $where, $Vacancy_Report_summary->Sort);
	$rs = $Vacancy_Report_summary->getRecordset($sql);
	$Vacancy_Report_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Vacancy_Report_summary->DetailRecordCount = count($Vacancy_Report_summary->DetailRecords);

	// Load detail records
	$Vacancy_Report_summary->ProvinceCode->Records = &$Vacancy_Report_summary->DetailRecords;
	$Vacancy_Report_summary->ProvinceCode->LevelBreak = TRUE; // Set field level break
		$Vacancy_Report_summary->GroupCounter[1] = $Vacancy_Report_summary->GroupCount;
		$Vacancy_Report_summary->ProvinceCode->getCnt($Vacancy_Report_summary->ProvinceCode->Records); // Get record count
?>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible && $Vacancy_Report_summary->ProvinceCode->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Vacancy_Report_summary->resetAttributes();
		$Vacancy_Report_summary->RowType = ROWTYPE_TOTAL;
		$Vacancy_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Vacancy_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Vacancy_Report_summary->RowGroupLevel = 1;
		$Vacancy_Report_summary->renderRow();
?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="ProvinceCode" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>>
<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->ProvinceCode) == "") { ?>
		<span class="ew-summary-caption Vacancy_Report_ProvinceCode"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->ProvinceCode->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Vacancy_Report_ProvinceCode" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->ProvinceCode) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->ProvinceCode->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Vacancy_Report_summary->ProvinceCode->viewAttributes() ?>><?php echo $Vacancy_Report_summary->ProvinceCode->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->ProvinceCode->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Vacancy_Report_summary->LACode->getDistinctValues($Vacancy_Report_summary->ProvinceCode->Records);
	$Vacancy_Report_summary->setGroupCount(count($Vacancy_Report_summary->LACode->DistinctValues), $Vacancy_Report_summary->GroupCounter[1]);
	$Vacancy_Report_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($Vacancy_Report_summary->LACode->DistinctValues as $LACode) { // Load records for this distinct value
		$Vacancy_Report_summary->LACode->setGroupValue($LACode); // Set group value
		$Vacancy_Report_summary->LACode->getDistinctRecords($Vacancy_Report_summary->ProvinceCode->Records, $Vacancy_Report_summary->LACode->groupValue());
		$Vacancy_Report_summary->LACode->LevelBreak = TRUE; // Set field level break
		$Vacancy_Report_summary->GroupCounter[2]++;
		$Vacancy_Report_summary->LACode->getCnt($Vacancy_Report_summary->LACode->Records); // Get record count
?>
<?php if ($Vacancy_Report_summary->LACode->Visible && $Vacancy_Report_summary->LACode->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Vacancy_Report_summary->LACode->setDbValue($LACode); // Set current value for LACode
		$Vacancy_Report_summary->resetAttributes();
		$Vacancy_Report_summary->RowType = ROWTYPE_TOTAL;
		$Vacancy_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Vacancy_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Vacancy_Report_summary->RowGroupLevel = 2;
		$Vacancy_Report_summary->renderRow();
?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->LACode->Visible) { ?>
		<td data-field="LACode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="LACode" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>>
<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->LACode) == "") { ?>
		<span class="ew-summary-caption Vacancy_Report_LACode"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->LACode->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Vacancy_Report_LACode" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->LACode) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->LACode->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Vacancy_Report_summary->LACode->viewAttributes() ?>><?php echo $Vacancy_Report_summary->LACode->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->LACode->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Vacancy_Report_summary->DepartmentCode->getDistinctValues($Vacancy_Report_summary->LACode->Records);
	$Vacancy_Report_summary->setGroupCount(count($Vacancy_Report_summary->DepartmentCode->DistinctValues), $Vacancy_Report_summary->GroupCounter[1], $Vacancy_Report_summary->GroupCounter[2]);
	$Vacancy_Report_summary->GroupCounter[3] = 0; // Init group count index
	foreach ($Vacancy_Report_summary->DepartmentCode->DistinctValues as $DepartmentCode) { // Load records for this distinct value
		$Vacancy_Report_summary->DepartmentCode->setGroupValue($DepartmentCode); // Set group value
		$Vacancy_Report_summary->DepartmentCode->getDistinctRecords($Vacancy_Report_summary->LACode->Records, $Vacancy_Report_summary->DepartmentCode->groupValue());
		$Vacancy_Report_summary->DepartmentCode->LevelBreak = TRUE; // Set field level break
		$Vacancy_Report_summary->GroupCounter[3]++;
		$Vacancy_Report_summary->DepartmentCode->getCnt($Vacancy_Report_summary->DepartmentCode->Records); // Get record count
?>
<?php if ($Vacancy_Report_summary->DepartmentCode->Visible && $Vacancy_Report_summary->DepartmentCode->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Vacancy_Report_summary->DepartmentCode->setDbValue($DepartmentCode); // Set current value for DepartmentCode
		$Vacancy_Report_summary->resetAttributes();
		$Vacancy_Report_summary->RowType = ROWTYPE_TOTAL;
		$Vacancy_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Vacancy_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Vacancy_Report_summary->RowGroupLevel = 3;
		$Vacancy_Report_summary->renderRow();
?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->LACode->Visible) { ?>
		<td data-field="LACode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="DepartmentCode" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 3) ?>"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>>
<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->DepartmentCode) == "") { ?>
		<span class="ew-summary-caption Vacancy_Report_DepartmentCode"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->DepartmentCode->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Vacancy_Report_DepartmentCode" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->DepartmentCode) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->DepartmentCode->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Vacancy_Report_summary->DepartmentCode->viewAttributes() ?>><?php echo $Vacancy_Report_summary->DepartmentCode->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->DepartmentCode->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Vacancy_Report_summary->SectionCode->getDistinctValues($Vacancy_Report_summary->DepartmentCode->Records);
	$Vacancy_Report_summary->setGroupCount(count($Vacancy_Report_summary->SectionCode->DistinctValues), $Vacancy_Report_summary->GroupCounter[1], $Vacancy_Report_summary->GroupCounter[2], $Vacancy_Report_summary->GroupCounter[3]);
	$Vacancy_Report_summary->GroupCounter[4] = 0; // Init group count index
	foreach ($Vacancy_Report_summary->SectionCode->DistinctValues as $SectionCode) { // Load records for this distinct value
		$Vacancy_Report_summary->SectionCode->setGroupValue($SectionCode); // Set group value
		$Vacancy_Report_summary->SectionCode->getDistinctRecords($Vacancy_Report_summary->DepartmentCode->Records, $Vacancy_Report_summary->SectionCode->groupValue());
		$Vacancy_Report_summary->SectionCode->LevelBreak = TRUE; // Set field level break
		$Vacancy_Report_summary->GroupCounter[4]++;
		$Vacancy_Report_summary->SectionCode->getCnt($Vacancy_Report_summary->SectionCode->Records); // Get record count
		$Vacancy_Report_summary->setGroupCount($Vacancy_Report_summary->SectionCode->Count, $Vacancy_Report_summary->GroupCounter[1], $Vacancy_Report_summary->GroupCounter[2], $Vacancy_Report_summary->GroupCounter[3], $Vacancy_Report_summary->GroupCounter[4]);
?>
<?php if ($Vacancy_Report_summary->SectionCode->Visible && $Vacancy_Report_summary->SectionCode->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Vacancy_Report_summary->SectionCode->setDbValue($SectionCode); // Set current value for SectionCode
		$Vacancy_Report_summary->resetAttributes();
		$Vacancy_Report_summary->RowType = ROWTYPE_TOTAL;
		$Vacancy_Report_summary->RowTotalType = ROWTOTAL_GROUP;
		$Vacancy_Report_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Vacancy_Report_summary->RowGroupLevel = 4;
		$Vacancy_Report_summary->renderRow();
?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->LACode->Visible) { ?>
		<td data-field="LACode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="SectionCode" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 4) ?>"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>>
<?php if ($Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->SectionCode) == "") { ?>
		<span class="ew-summary-caption Vacancy_Report_SectionCode"><span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->SectionCode->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Vacancy_Report_SectionCode" onclick="ew.sort(event, '<?php echo $Vacancy_Report_summary->sortUrl($Vacancy_Report_summary->SectionCode) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Vacancy_Report_summary->SectionCode->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Vacancy_Report_summary->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Vacancy_Report_summary->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Vacancy_Report_summary->SectionCode->viewAttributes() ?>><?php echo $Vacancy_Report_summary->SectionCode->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->SectionCode->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Vacancy_Report_summary->RecordCount = 0; // Reset record count
	foreach ($Vacancy_Report_summary->SectionCode->Records as $record) {
		$Vacancy_Report_summary->RecordCount++;
		$Vacancy_Report_summary->RecordIndex++;
		$Vacancy_Report_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Vacancy_Report_summary->resetAttributes();
		$Vacancy_Report_summary->RowType = ROWTYPE_DETAIL;
		$Vacancy_Report_summary->renderRow();
?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
	<?php if ($Vacancy_Report_summary->ProvinceCode->ShowGroupHeaderAsRow) { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes(); ?>><span<?php echo $Vacancy_Report_summary->ProvinceCode->viewAttributes() ?>><?php echo $Vacancy_Report_summary->ProvinceCode->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->LACode->Visible) { ?>
	<?php if ($Vacancy_Report_summary->LACode->ShowGroupHeaderAsRow) { ?>
		<td data-field="LACode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="LACode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes(); ?>><span<?php echo $Vacancy_Report_summary->LACode->viewAttributes() ?>><?php echo $Vacancy_Report_summary->LACode->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentCode->Visible) { ?>
	<?php if ($Vacancy_Report_summary->DepartmentCode->ShowGroupHeaderAsRow) { ?>
		<td data-field="DepartmentCode"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="DepartmentCode"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes(); ?>><span<?php echo $Vacancy_Report_summary->DepartmentCode->viewAttributes() ?>><?php echo $Vacancy_Report_summary->DepartmentCode->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionCode->Visible) { ?>
	<?php if ($Vacancy_Report_summary->SectionCode->ShowGroupHeaderAsRow) { ?>
		<td data-field="SectionCode"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="SectionCode"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes(); ?>><span<?php echo $Vacancy_Report_summary->SectionCode->viewAttributes() ?>><?php echo $Vacancy_Report_summary->SectionCode->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionCode->Visible) { ?>
		<td data-field="PositionCode"<?php echo $Vacancy_Report_summary->PositionCode->cellAttributes() ?>>
<span<?php echo $Vacancy_Report_summary->PositionCode->viewAttributes() ?>><?php echo $Vacancy_Report_summary->PositionCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Vacancy_Report_summary->SalaryScale->cellAttributes() ?>>
<span<?php echo $Vacancy_Report_summary->SalaryScale->viewAttributes() ?>><?php echo $Vacancy_Report_summary->SalaryScale->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Vacancy_Report_summary->PositionName->cellAttributes() ?>>
<span<?php echo $Vacancy_Report_summary->PositionName->viewAttributes() ?>><?php echo $Vacancy_Report_summary->PositionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->RequisiteQualification->Visible) { ?>
		<td data-field="RequisiteQualification"<?php echo $Vacancy_Report_summary->RequisiteQualification->cellAttributes() ?>>
<span<?php echo $Vacancy_Report_summary->RequisiteQualification->viewAttributes() ?>><?php echo $Vacancy_Report_summary->RequisiteQualification->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->FieldQualified->Visible) { ?>
		<td data-field="FieldQualified"<?php echo $Vacancy_Report_summary->FieldQualified->cellAttributes() ?>>
<span<?php echo $Vacancy_Report_summary->FieldQualified->viewAttributes() ?>><?php echo $Vacancy_Report_summary->FieldQualified->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $Vacancy_Report_summary->DepartmentName->cellAttributes() ?>>
<span<?php echo $Vacancy_Report_summary->DepartmentName->viewAttributes() ?>><?php echo $Vacancy_Report_summary->DepartmentName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $Vacancy_Report_summary->SectionName->cellAttributes() ?>>
<span<?php echo $Vacancy_Report_summary->SectionName->viewAttributes() ?>><?php echo $Vacancy_Report_summary->SectionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->CouncilType->Visible) { ?>
		<td data-field="CouncilType"<?php echo $Vacancy_Report_summary->CouncilType->cellAttributes() ?>>
<span<?php echo $Vacancy_Report_summary->CouncilType->viewAttributes() ?>><?php echo $Vacancy_Report_summary->CouncilType->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->EmploymentStatus->Visible) { ?>
		<td data-field="EmploymentStatus"<?php echo $Vacancy_Report_summary->EmploymentStatus->cellAttributes() ?>>
<span<?php echo $Vacancy_Report_summary->EmploymentStatus->viewAttributes() ?>><?php echo $Vacancy_Report_summary->EmploymentStatus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->MonthsVacant->Visible) { ?>
		<td data-field="MonthsVacant"<?php echo $Vacancy_Report_summary->MonthsVacant->cellAttributes() ?>>
<span<?php echo $Vacancy_Report_summary->MonthsVacant->viewAttributes() ?>><?php echo $Vacancy_Report_summary->MonthsVacant->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Vacancy_Report_summary->TotalGroups > 0) { ?>
<?php
	$Vacancy_Report_summary->resetAttributes();
	$Vacancy_Report_summary->RowType = ROWTYPE_TOTAL;
	$Vacancy_Report_summary->RowTotalType = ROWTOTAL_GROUP;
	$Vacancy_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Vacancy_Report_summary->RowGroupLevel = 4;
	$Vacancy_Report_summary->renderRow();
?>
<?php if ($Vacancy_Report_summary->SectionCode->ShowCompactSummaryFooter) { ?>
	<?php if (!$Vacancy_Report_summary->SectionCode->ShowGroupHeaderAsRow) { ?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->ProvinceCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->ProvinceCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->LACode->Visible) { ?>
		<td data-field="LACode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->LACode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->LACode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->DepartmentCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->DepartmentCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->SectionCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 4) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->SectionCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionCode->Visible) { ?>
		<td data-field="PositionCode"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->RequisiteQualification->Visible) { ?>
		<td data-field="RequisiteQualification"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->FieldQualified->Visible) { ?>
		<td data-field="FieldQualified"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->CouncilType->Visible) { ?>
		<td data-field="CouncilType"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->EmploymentStatus->Visible) { ?>
		<td data-field="EmploymentStatus"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->MonthsVacant->Visible) { ?>
		<td data-field="MonthsVacant"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>></td>
<?php } ?>
	</tr>
	<?php } ?>
<?php } else { ?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->LACode->Visible) { ?>
		<td data-field="LACode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SubGroupColumnCount + $Vacancy_Report_summary->DetailColumnCount - 2 > 0) { ?>
		<td colspan="<?php echo ($Vacancy_Report_summary->SubGroupColumnCount + $Vacancy_Report_summary->DetailColumnCount - 2) ?>"<?php echo $Vacancy_Report_summary->SectionCode->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Vacancy_Report_summary->SectionCode->GroupViewValue, $Vacancy_Report_summary->SectionCode->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Vacancy_Report_summary->SectionCode->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	} // End group level 3
?>
<?php if ($Vacancy_Report_summary->TotalGroups > 0) { ?>
<?php
	$Vacancy_Report_summary->resetAttributes();
	$Vacancy_Report_summary->RowType = ROWTYPE_TOTAL;
	$Vacancy_Report_summary->RowTotalType = ROWTOTAL_GROUP;
	$Vacancy_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Vacancy_Report_summary->RowGroupLevel = 3;
	$Vacancy_Report_summary->renderRow();
?>
<?php if ($Vacancy_Report_summary->DepartmentCode->ShowCompactSummaryFooter) { ?>
	<?php if (!$Vacancy_Report_summary->DepartmentCode->ShowGroupHeaderAsRow) { ?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->ProvinceCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->ProvinceCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->LACode->Visible) { ?>
		<td data-field="LACode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->LACode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->LACode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->DepartmentCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->DepartmentCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->SectionCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 4) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->SectionCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionCode->Visible) { ?>
		<td data-field="PositionCode"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->RequisiteQualification->Visible) { ?>
		<td data-field="RequisiteQualification"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->FieldQualified->Visible) { ?>
		<td data-field="FieldQualified"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->CouncilType->Visible) { ?>
		<td data-field="CouncilType"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->EmploymentStatus->Visible) { ?>
		<td data-field="EmploymentStatus"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->MonthsVacant->Visible) { ?>
		<td data-field="MonthsVacant"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>></td>
<?php } ?>
	</tr>
	<?php } ?>
<?php } else { ?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->LACode->Visible) { ?>
		<td data-field="LACode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SubGroupColumnCount + $Vacancy_Report_summary->DetailColumnCount - 1 > 0) { ?>
		<td colspan="<?php echo ($Vacancy_Report_summary->SubGroupColumnCount + $Vacancy_Report_summary->DetailColumnCount - 1) ?>"<?php echo $Vacancy_Report_summary->DepartmentCode->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Vacancy_Report_summary->DepartmentCode->GroupViewValue, $Vacancy_Report_summary->DepartmentCode->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Vacancy_Report_summary->DepartmentCode->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	} // End group level 2
?>
<?php if ($Vacancy_Report_summary->TotalGroups > 0) { ?>
<?php
	$Vacancy_Report_summary->resetAttributes();
	$Vacancy_Report_summary->RowType = ROWTYPE_TOTAL;
	$Vacancy_Report_summary->RowTotalType = ROWTOTAL_GROUP;
	$Vacancy_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Vacancy_Report_summary->RowGroupLevel = 2;
	$Vacancy_Report_summary->renderRow();
?>
<?php if ($Vacancy_Report_summary->LACode->ShowCompactSummaryFooter) { ?>
	<?php if (!$Vacancy_Report_summary->LACode->ShowGroupHeaderAsRow) { ?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->ProvinceCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->ProvinceCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->LACode->Visible) { ?>
		<td data-field="LACode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->LACode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->LACode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->DepartmentCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->DepartmentCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->SectionCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 4) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->SectionCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionCode->Visible) { ?>
		<td data-field="PositionCode"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->RequisiteQualification->Visible) { ?>
		<td data-field="RequisiteQualification"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->FieldQualified->Visible) { ?>
		<td data-field="FieldQualified"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->CouncilType->Visible) { ?>
		<td data-field="CouncilType"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->EmploymentStatus->Visible) { ?>
		<td data-field="EmploymentStatus"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->MonthsVacant->Visible) { ?>
		<td data-field="MonthsVacant"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>></td>
<?php } ?>
	</tr>
	<?php } ?>
<?php } else { ?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SubGroupColumnCount + $Vacancy_Report_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($Vacancy_Report_summary->SubGroupColumnCount + $Vacancy_Report_summary->DetailColumnCount) ?>"<?php echo $Vacancy_Report_summary->LACode->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Vacancy_Report_summary->LACode->GroupViewValue, $Vacancy_Report_summary->LACode->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Vacancy_Report_summary->LACode->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	} // End group level 1
?>
<?php if ($Vacancy_Report_summary->TotalGroups > 0) { ?>
<?php
	$Vacancy_Report_summary->resetAttributes();
	$Vacancy_Report_summary->RowType = ROWTYPE_TOTAL;
	$Vacancy_Report_summary->RowTotalType = ROWTOTAL_GROUP;
	$Vacancy_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Vacancy_Report_summary->RowGroupLevel = 1;
	$Vacancy_Report_summary->renderRow();
?>
<?php if ($Vacancy_Report_summary->ProvinceCode->ShowCompactSummaryFooter) { ?>
	<?php if (!$Vacancy_Report_summary->ProvinceCode->ShowGroupHeaderAsRow) { ?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->ProvinceCode->Visible) { ?>
		<td data-field="ProvinceCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->ProvinceCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->ProvinceCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->LACode->Visible) { ?>
		<td data-field="LACode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->LACode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->LACode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentCode->Visible) { ?>
		<td data-field="DepartmentCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->DepartmentCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->DepartmentCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionCode->Visible) { ?>
		<td data-field="SectionCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>>
	<?php if ($Vacancy_Report_summary->SectionCode->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Vacancy_Report_summary->RowGroupLevel != 4) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->SectionCode->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionCode->Visible) { ?>
		<td data-field="PositionCode"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SalaryScale->Visible) { ?>
		<td data-field="SalaryScale"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->RequisiteQualification->Visible) { ?>
		<td data-field="RequisiteQualification"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->FieldQualified->Visible) { ?>
		<td data-field="FieldQualified"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->DepartmentName->Visible) { ?>
		<td data-field="DepartmentName"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->SectionName->Visible) { ?>
		<td data-field="SectionName"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->CouncilType->Visible) { ?>
		<td data-field="CouncilType"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->EmploymentStatus->Visible) { ?>
		<td data-field="EmploymentStatus"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Vacancy_Report_summary->MonthsVacant->Visible) { ?>
		<td data-field="MonthsVacant"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>></td>
<?php } ?>
	</tr>
	<?php } ?>
<?php } else { ?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes(); ?>>
<?php if ($Vacancy_Report_summary->GroupColumnCount + $Vacancy_Report_summary->DetailColumnCount > 0) { ?>
		<td colspan="<?php echo ($Vacancy_Report_summary->GroupColumnCount + $Vacancy_Report_summary->DetailColumnCount) ?>"<?php echo $Vacancy_Report_summary->ProvinceCode->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Vacancy_Report_summary->ProvinceCode->GroupViewValue, $Vacancy_Report_summary->ProvinceCode->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Vacancy_Report_summary->ProvinceCode->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
?>
<?php

	// Next group
	$Vacancy_Report_summary->loadGroupRowValues();

	// Show header if page break
	if ($Vacancy_Report_summary->isExport())
		$Vacancy_Report_summary->ShowHeader = ($Vacancy_Report_summary->ExportPageBreakCount == 0) ? FALSE : ($Vacancy_Report_summary->GroupCount % $Vacancy_Report_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Vacancy_Report_summary->ShowHeader)
		$Vacancy_Report_summary->Page_Breaking($Vacancy_Report_summary->ShowHeader, $Vacancy_Report_summary->PageBreakContent);
	$Vacancy_Report_summary->GroupCount++;
} // End while
?>
<?php if ($Vacancy_Report_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Vacancy_Report_summary->resetAttributes();
	$Vacancy_Report_summary->RowType = ROWTYPE_TOTAL;
	$Vacancy_Report_summary->RowTotalType = ROWTOTAL_GRAND;
	$Vacancy_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Vacancy_Report_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Vacancy_Report_summary->renderRow();
?>
<?php if ($Vacancy_Report_summary->ProvinceCode->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($Vacancy_Report_summary->GroupColumnCount + $Vacancy_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Vacancy_Report_summary->TotalCount, 0); ?></span>)</span></td></tr>
<?php } else { ?>
	<tr<?php echo $Vacancy_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($Vacancy_Report_summary->GroupColumnCount + $Vacancy_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Vacancy_Report_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$Vacancy_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Vacancy_Report_summary->TotalGroups > 0) { ?>
<?php if (!$Vacancy_Report_summary->isExport() && !($Vacancy_Report_summary->DrillDown && $Vacancy_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Vacancy_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Vacancy_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Vacancy_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Vacancy_Report_summary->isExport() || $Vacancy_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Vacancy_Report_summary->isExport() || $Vacancy_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Vacancy_Report_summary->isExport() || $Vacancy_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Vacancy_Report_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Vacancy_Report_summary->isExport() && !$Vacancy_Report_summary->DrillDown && !$DashboardReport) { ?>
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
$Vacancy_Report_summary->terminate();
?>