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
$Budget_Allocation_by_Economic_Classification_Summary_crosstab = new Budget_Allocation_by_Economic_Classification_Summary_crosstab();

// Run the page
$Budget_Allocation_by_Economic_Classification_Summary_crosstab->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Budget_Allocation_by_Economic_Classification_Summary_crosstab->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() && !$Budget_Allocation_by_Economic_Classification_Summary_crosstab->DrillDown && !$DashboardReport) { ?>
<script>
var fcrosstab, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	fcrosstab = currentForm = new ew.Form("fcrosstab", "crosstab");
	currentPageID = ew.PAGE_ID = "crosstab";

	// Validate function for search
	fcrosstab.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_FinancialYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($Budget_Allocation_by_Economic_Classification_Summary_crosstab->FinancialYear->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcrosstab.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcrosstab.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcrosstab.lists["x_LAName"] = <?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->Lookup->toClientList($Budget_Allocation_by_Economic_Classification_Summary_crosstab) ?>;
	fcrosstab.lists["x_LAName"].options = <?php echo JsonEncode($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->lookupOptions()) ?>;

	// Filters
	fcrosstab.filterList = <?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->getFilterList() ?>;

	// Init search panel as collapsed
	fcrosstab.initSearchPanel = true;
	loadjs.done("fcrosstab");
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
<?php if ((!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->ShowCurrentFilter) { ?>
<?php $Budget_Allocation_by_Economic_Classification_Summary_crosstab->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->DrillDownInPanel) {
	$Budget_Allocation_by_Economic_Classification_Summary_crosstab->ExportOptions->render("body");
	$Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchOptions->render("body");
	$Budget_Allocation_by_Economic_Classification_Summary_crosstab->FilterOptions->render("body");
}
?>
</div>
<?php $Budget_Allocation_by_Economic_Classification_Summary_crosstab->showPageHeader(); ?>
<?php
$Budget_Allocation_by_Economic_Classification_Summary_crosstab->showMessage();
?>
<?php if ((!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->CenterContentClass ?>">
<?php } ?>
<!-- Crosstab report (begin) -->
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("pdf")) { ?>
<div id="report_crosstab">
<?php } ?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() && !$Budget_Allocation_by_Economic_Classification_Summary_crosstab->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() && !$Budget_Allocation_by_Economic_Classification_Summary->CurrentAction) { ?>
<form name="fcrosstab" id="fcrosstab" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcrosstab-search-panel" class="<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Budget_Allocation_by_Economic_Classification_Summary">
	<div class="ew-extended-search">
<?php

// Render search row
$Budget_Allocation_by_Economic_Classification_Summary->RowType = ROWTYPE_SEARCH;
$Budget_Allocation_by_Economic_Classification_Summary->resetAttributes();
$Budget_Allocation_by_Economic_Classification_Summary_crosstab->renderRow();
?>
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->Visible) { // LAName ?>
	<?php
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount++;
		if (($Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount - 1) % $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchFieldsPerRow == 0) {
			$Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LAName" class="ew-cell form-group">
		<label for="x_LAName" class="ew-search-caption ew-label"><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->caption() ?></label>
		<span id="el_Budget_Allocation_by_Economic_Classification_Summary_LAName" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LAName"><?php echo EmptyValue(strval($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->ReadOnly || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LAName',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->Lookup->getParamTag($Budget_Allocation_by_Economic_Classification_Summary_crosstab, "p_x_LAName") ?>
<input type="hidden" data-table="Budget_Allocation_by_Economic_Classification_Summary" data-field="x_LAName" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->displayValueSeparatorAttribute() ?>" name="x_LAName" id="x_LAName" value="<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->AdvancedSearch->SearchValue ?>"<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->editAttributes() ?>>
</span>
	</div>
	<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount % $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->Visible) { // AccountGroupName ?>
	<?php
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount++;
		if (($Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount - 1) % $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchFieldsPerRow == 0) {
			$Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_AccountGroupName" class="ew-cell form-group">
		<label for="x_AccountGroupName" class="ew-search-caption ew-label"><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AccountGroupName" id="z_AccountGroupName" value="LIKE">
</span>
		<span id="el_Budget_Allocation_by_Economic_Classification_Summary_AccountGroupName" class="ew-search-field">
<input type="text" data-table="Budget_Allocation_by_Economic_Classification_Summary" data-field="x_AccountGroupName" name="x_AccountGroupName" id="x_AccountGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->getPlaceHolder()) ?>" value="<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->EditValue ?>"<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->editAttributes() ?>>
</span>
	</div>
	<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount % $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountName->Visible) { // AccountName ?>
	<?php
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount++;
		if (($Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount - 1) % $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchFieldsPerRow == 0) {
			$Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_AccountName" class="ew-cell form-group">
		<label for="x_AccountName" class="ew-search-caption ew-label"><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AccountName" id="z_AccountName" value="LIKE">
</span>
		<span id="el_Budget_Allocation_by_Economic_Classification_Summary_AccountName" class="ew-search-field">
<input type="text" data-table="Budget_Allocation_by_Economic_Classification_Summary" data-field="x_AccountName" name="x_AccountName" id="x_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountName->getPlaceHolder()) ?>" value="<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountName->EditValue ?>"<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountName->editAttributes() ?>>
</span>
	</div>
	<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount % $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->FinancialYear->Visible) { // FinancialYear ?>
	<?php
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount++;
		if (($Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount - 1) % $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchFieldsPerRow == 0) {
			$Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_FinancialYear" class="ew-cell form-group">
		<label for="x_FinancialYear" class="ew-search-caption ew-label"><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->FinancialYear->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_FinancialYear" id="z_FinancialYear" value="=">
</span>
		<span id="el_Budget_Allocation_by_Economic_Classification_Summary_FinancialYear" class="ew-search-field">
<input type="text" data-table="Budget_Allocation_by_Economic_Classification_Summary" data-field="x_FinancialYear" name="x_FinancialYear" id="x_FinancialYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($Budget_Allocation_by_Economic_Classification_Summary_crosstab->FinancialYear->getPlaceHolder()) ?>" value="<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->FinancialYear->EditValue ?>"<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->FinancialYear->editAttributes() ?>>
</span>
	</div>
	<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount % $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchColumnCount % $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->GroupCount <= count($Budget_Allocation_by_Economic_Classification_Summary_crosstab->GroupRecords) && $Budget_Allocation_by_Economic_Classification_Summary_crosstab->GroupCount <= $Budget_Allocation_by_Economic_Classification_Summary_crosstab->DisplayGroups) {
?>
<?php

	// Show header
	if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->ShowHeader) {
?>
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->TotalGroups > 0) { ?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() && !($Budget_Allocation_by_Economic_Classification_Summary_crosstab->DrillDown && $Budget_Allocation_by_Economic_Classification_Summary_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->PageBreakContent ?>
<?php } ?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("pdf")) { ?>
<div class="<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("word") && !$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() && !($Budget_Allocation_by_Economic_Classification_Summary_crosstab->DrillDown && $Budget_Allocation_by_Economic_Classification_Summary_crosstab->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Budget_Allocation_by_Economic_Classification_Summary" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->GroupColumnCount > 0) { ?>
		<td class="ew-rpt-col-summary" colspan="<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->GroupColumnCount ?>"><div><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->renderSummaryCaptions() ?></div></td>
<?php } ?>
		<td class="ew-rpt-col-header" colspan="<?php echo @$Budget_Allocation_by_Economic_Classification_Summary_crosstab->ColumnSpan ?>">
			<div class="ew-table-header-btn">
				<span class="ew-table-header-caption"><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->FinancialYear->caption() ?></span>
			</div>
		</td>
	</tr>
	<tr class="ew-table-header">
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->Visible) { ?>
	<td data-field="LAName">
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->sortUrl($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName) == "") { ?>
		<div class="ew-table-header-btn Budget_Allocation_by_Economic_Classification_Summary_LAName">
			<span class="ew-table-header-caption"><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Budget_Allocation_by_Economic_Classification_Summary_LAName" onclick="ew.sort(event, '<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->sortUrl($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->Visible) { ?>
	<td data-field="AccountGroupName">
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->sortUrl($Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName) == "") { ?>
		<div class="ew-table-header-btn Budget_Allocation_by_Economic_Classification_Summary_AccountGroupName">
			<span class="ew-table-header-caption"><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->caption() ?></span>			
		</div>
<?php } else { ?>
		<div class="ew-table-header-btn ew-pointer Budget_Allocation_by_Economic_Classification_Summary_AccountGroupName" onclick="ew.sort(event, '<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->sortUrl($Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</div>
<?php } ?>
	</td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
	$cntval = count($Budget_Allocation_by_Economic_Classification_Summary_crosstab->Columns);
	for ($iy = 1; $iy < $cntval; $iy++) {
		if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->Columns[$iy]->Visible) {
			$Budget_Allocation_by_Economic_Classification_Summary_crosstab->SummaryCurrentValues[$iy-1] = $Budget_Allocation_by_Economic_Classification_Summary_crosstab->Columns[$iy]->Caption;
			$Budget_Allocation_by_Economic_Classification_Summary_crosstab->SummaryViewValues[$iy-1] = $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SummaryCurrentValues[$iy-1];
?>
		<td class="ew-table-header"<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->FinancialYear->cellAttributes() ?>><div<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->FinancialYear->viewAttributes() ?>><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->SummaryViewValues[$iy-1]; ?></div></td>
<?php
		}
	}
?>
<!-- Dynamic columns end -->
		<td class="ew-table-header"<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->FinancialYear->cellAttributes() ?>><div<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->FinancialYear->viewAttributes() ?>><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->renderSummaryCaptions() ?></div></td>
	</tr>
</thead>
<tbody>
<?php
		if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->TotalGroups == 0)
			break; // Show header only
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName, $Budget_Allocation_by_Economic_Classification_Summary_crosstab->getSqlFirstGroupField(), $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->groupValue(), $Budget_Allocation_by_Economic_Classification_Summary_crosstab->Dbid);
	if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->PageFirstGroupFilter != "") $Budget_Allocation_by_Economic_Classification_Summary_crosstab->PageFirstGroupFilter .= " OR ";
	$Budget_Allocation_by_Economic_Classification_Summary_crosstab->PageFirstGroupFilter .= $where;
	if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->Filter != "")
		$where = "($Budget_Allocation_by_Economic_Classification_Summary_crosstab->Filter) AND ($where)";
	$sql = BuildReportSql(str_replace("{DistinctColumnFields}", $Budget_Allocation_by_Economic_Classification_Summary_crosstab->DistinctColumnFields, $Budget_Allocation_by_Economic_Classification_Summary_crosstab->getSqlSelect()), $Budget_Allocation_by_Economic_Classification_Summary_crosstab->getSqlWhere(), $Budget_Allocation_by_Economic_Classification_Summary_crosstab->getSqlGroupBy(), "", $Budget_Allocation_by_Economic_Classification_Summary_crosstab->getSqlOrderBy(), $where, $Budget_Allocation_by_Economic_Classification_Summary_crosstab->Sort);
	$rs = $Budget_Allocation_by_Economic_Classification_Summary_crosstab->getRecordset($sql);
	$Budget_Allocation_by_Economic_Classification_Summary_crosstab->DetailRecords = $rs ? $rs->getRows() : [];
	$Budget_Allocation_by_Economic_Classification_Summary_crosstab->DetailRecordCount = count($Budget_Allocation_by_Economic_Classification_Summary_crosstab->DetailRecords);

	// Load detail records
	$Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->Records = &$Budget_Allocation_by_Economic_Classification_Summary_crosstab->DetailRecords;
	$Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->LevelBreak = TRUE; // Set field level break
	$Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->getDistinctValues($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->Records);
	foreach ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->DistinctValues as $AccountGroupName) { // Load records for this distinct value
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->setGroupValue($AccountGroupName); // Set group value
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->getDistinctRecords($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->Records, $Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->groupValue());
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->LevelBreak = TRUE; // Set field level break
	foreach ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->Records as $record) {
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->RecordCount++;
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->RecordIndex++;
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->loadRowValues($record);

		// Render row
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->resetAttributes();
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->RowType = ROWTYPE_DETAIL;
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->renderRow();
?>
	<tr<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->rowAttributes(); ?>>
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->Visible) { ?>
		<!-- LAName -->
		<td data-field="LAName"<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->cellAttributes(); ?>><span<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->viewAttributes() ?>><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->LAName->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->Visible) { ?>
		<!-- AccountGroupName -->
		<td data-field="AccountGroupName"<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->cellAttributes(); ?>><span<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->viewAttributes() ?>><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->AccountGroupName->GroupViewValue ?></span></td>
<?php } ?>
<!-- Dynamic columns begin -->
<?php
		$cntcol = count($Budget_Allocation_by_Economic_Classification_Summary_crosstab->SummaryViewValues);
		for ($iy = 1; $iy <= $cntcol; $iy++) {
			$colShow = ($iy <= $Budget_Allocation_by_Economic_Classification_Summary_crosstab->ColumnCount) ? $Budget_Allocation_by_Economic_Classification_Summary_crosstab->Columns[$iy]->Visible : TRUE;
			$colDesc = ($iy <= $Budget_Allocation_by_Economic_Classification_Summary_crosstab->ColumnCount) ? $Budget_Allocation_by_Economic_Classification_Summary_crosstab->Columns[$iy]->Caption : $Language->phrase("Summary");
			if ($colShow) {
?>
		<!-- <?php echo $colDesc; ?> -->
		<td<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->summaryCellAttributes($iy-1) ?>><?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->renderSummaryFields($iy-1) ?></td>
<?php
			}
		}
?>
<!-- Dynamic columns end -->
	</tr>
<?php
	}
	} // End group level 1
?>
<?php

	// Next group
	$Budget_Allocation_by_Economic_Classification_Summary_crosstab->loadGroupRowValues();

	// Show header if page break
	if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport())
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->ShowHeader = ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->ExportPageBreakCount == 0) ? FALSE : ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->GroupCount % $Budget_Allocation_by_Economic_Classification_Summary_crosstab->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->ShowHeader)
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->Page_Breaking($Budget_Allocation_by_Economic_Classification_Summary_crosstab->ShowHeader, $Budget_Allocation_by_Economic_Classification_Summary_crosstab->PageBreakContent);
	$Budget_Allocation_by_Economic_Classification_Summary_crosstab->GroupCount++;
} // End while
?>
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->TotalGroups > 0) { ?>
</tbody>
<tfoot>
</tfoot>
</table>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Budget_Allocation_by_Economic_Classification_Summary_crosstab->TotalGroups > 0) { ?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() && !($Budget_Allocation_by_Economic_Classification_Summary_crosstab->DrillDown && $Budget_Allocation_by_Economic_Classification_Summary_crosstab->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("pdf")) { ?>
</div>
<!-- /#report-crosstab -->
<?php } ?>
<!-- Crosstab report (end) -->
<?php if ((!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("print")) && !$DashboardReport) { ?>
<!-- Bottom Container -->
<div class="row">
	<div id="ew-bottom" class="<?php echo $Budget_Allocation_by_Economic_Classification_Summary_crosstab->BottomContentClass ?>">
<?php } ?>
<?php
if (!$DashboardReport) {

	// Set up page break
	if (($Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("print") || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("pdf") || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("email") || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("excel") && Config("USE_PHPEXCEL") || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("word") && Config("USE_PHPWORD")) && $Budget_Allocation_by_Economic_Classification_Summary_crosstab->ExportChartPageBreak) {

		// Page_Breaking server event
		$Budget_Allocation_by_Economic_Classification_Summary_crosstab->Page_Breaking($Budget_Allocation_by_Economic_Classification_Summary_crosstab->ExportChartPageBreak, $Budget_Allocation_by_Economic_Classification_Summary_crosstab->PageBreakContent);
		$Budget_Allocation_by_Economic_Classification_Summary->Budget_Allocation_By_Economic_Allocation->PageBreakType = "before"; // Page break type
		$Budget_Allocation_by_Economic_Classification_Summary->Budget_Allocation_By_Economic_Allocation->PageBreak = $Budget_Allocation_by_Economic_Classification_Summary_crosstab->ExportChartPageBreak;
		$Budget_Allocation_by_Economic_Classification_Summary->Budget_Allocation_By_Economic_Allocation->PageBreakContent = $Budget_Allocation_by_Economic_Classification_Summary_crosstab->PageBreakContent;
	}

	// Set up chart drilldown
	$Budget_Allocation_by_Economic_Classification_Summary->Budget_Allocation_By_Economic_Allocation->DrillDownInPanel = $Budget_Allocation_by_Economic_Classification_Summary_crosstab->DrillDownInPanel;
	$Budget_Allocation_by_Economic_Classification_Summary->Budget_Allocation_By_Economic_Allocation->render("ew-chart-bottom");
}
?>
<?php if (!$DashboardReport && !$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("email") && !$Budget_Allocation_by_Economic_Classification_Summary_crosstab->DrillDown && $Budget_Allocation_by_Economic_Classification_Summary->Budget_Allocation_By_Economic_Allocation->hasData()) { ?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport()) { ?>
<div class="mb-3"><a href="#" class="ew-top-link" onclick="$(document).scrollTop($('#top').offset().top); return false;"><?php echo $Language->phrase("Top") ?></a></div>
<?php } ?>
<?php } ?>
<?php if ((!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("print")) && !$DashboardReport) { ?>
	</div>
</div>
<!-- /#ew-bottom -->
<?php } ?>
<?php if ((!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() || $Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Budget_Allocation_by_Economic_Classification_Summary_crosstab->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Budget_Allocation_by_Economic_Classification_Summary_crosstab->isExport() && !$Budget_Allocation_by_Economic_Classification_Summary_crosstab->DrillDown && !$DashboardReport) { ?>
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
$Budget_Allocation_by_Economic_Classification_Summary_crosstab->terminate();
?>