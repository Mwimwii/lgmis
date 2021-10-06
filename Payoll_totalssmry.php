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
$Payoll_totals_summary = new Payoll_totals_summary();

// Run the page
$Payoll_totals_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Payoll_totals_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Payoll_totals_summary->isExport() && !$Payoll_totals_summary->DrillDown && !$DashboardReport) { ?>
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
	fsummary.lists["x_PayrollPeriod"] = <?php echo $Payoll_totals_summary->PayrollPeriod->Lookup->toClientList($Payoll_totals_summary) ?>;
	fsummary.lists["x_PayrollPeriod"].options = <?php echo JsonEncode($Payoll_totals_summary->PayrollPeriod->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $Payoll_totals_summary->getFilterList() ?>;

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
<?php if ((!$Payoll_totals_summary->isExport() || $Payoll_totals_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Payoll_totals_summary->ShowCurrentFilter) { ?>
<?php $Payoll_totals_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Payoll_totals_summary->DrillDownInPanel) {
	$Payoll_totals_summary->ExportOptions->render("body");
	$Payoll_totals_summary->SearchOptions->render("body");
	$Payoll_totals_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Payoll_totals_summary->showPageHeader(); ?>
<?php
$Payoll_totals_summary->showMessage();
?>
<?php if ((!$Payoll_totals_summary->isExport() || $Payoll_totals_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Payoll_totals_summary->isExport() || $Payoll_totals_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Payoll_totals_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<div id="report_summary">
<?php if (!$Payoll_totals_summary->isExport() && !$Payoll_totals_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Payoll_totals_summary->isExport() && !$Payoll_totals->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Payoll_totals_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Payoll_totals">
	<div class="ew-extended-search">
<?php

// Render search row
$Payoll_totals->RowType = ROWTYPE_SEARCH;
$Payoll_totals->resetAttributes();
$Payoll_totals_summary->renderRow();
?>
<?php if ($Payoll_totals_summary->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php
		$Payoll_totals_summary->SearchColumnCount++;
		if (($Payoll_totals_summary->SearchColumnCount - 1) % $Payoll_totals_summary->SearchFieldsPerRow == 0) {
			$Payoll_totals_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payoll_totals_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LocalAuthority" class="ew-cell form-group">
		<label for="x_LocalAuthority" class="ew-search-caption ew-label"><?php echo $Payoll_totals_summary->LocalAuthority->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		<span id="el_Payoll_totals_LocalAuthority" class="ew-search-field">
<input type="text" data-table="Payoll_totals" data-field="x_LocalAuthority" name="x_LocalAuthority" id="x_LocalAuthority" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($Payoll_totals_summary->LocalAuthority->getPlaceHolder()) ?>" value="<?php echo $Payoll_totals_summary->LocalAuthority->EditValue ?>"<?php echo $Payoll_totals_summary->LocalAuthority->editAttributes() ?>>
</span>
	</div>
	<?php if ($Payoll_totals_summary->SearchColumnCount % $Payoll_totals_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Payoll_totals_summary->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php
		$Payoll_totals_summary->SearchColumnCount++;
		if (($Payoll_totals_summary->SearchColumnCount - 1) % $Payoll_totals_summary->SearchFieldsPerRow == 0) {
			$Payoll_totals_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Payoll_totals_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PayrollPeriod" class="ew-cell form-group">
		<label for="x_PayrollPeriod" class="ew-search-caption ew-label"><?php echo $Payoll_totals_summary->PayrollPeriod->caption() ?></label>
		<span id="el_Payoll_totals_PayrollPeriod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Payoll_totals" data-field="x_PayrollPeriod" data-value-separator="<?php echo $Payoll_totals_summary->PayrollPeriod->displayValueSeparatorAttribute() ?>" id="x_PayrollPeriod" name="x_PayrollPeriod"<?php echo $Payoll_totals_summary->PayrollPeriod->editAttributes() ?>>
			<?php echo $Payoll_totals_summary->PayrollPeriod->selectOptionListHtml("x_PayrollPeriod") ?>
		</select>
</div>
<?php echo $Payoll_totals_summary->PayrollPeriod->Lookup->getParamTag($Payoll_totals_summary, "p_x_PayrollPeriod") ?>
</span>
	</div>
	<?php if ($Payoll_totals_summary->SearchColumnCount % $Payoll_totals_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Payoll_totals_summary->SearchColumnCount % $Payoll_totals_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Payoll_totals_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Payoll_totals_summary->GroupCount <= count($Payoll_totals_summary->GroupRecords) && $Payoll_totals_summary->GroupCount <= $Payoll_totals_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Payoll_totals_summary->ShowHeader) {
?>
<?php if ($Payoll_totals_summary->GroupCount > 1) { ?>
</tbody>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Payoll_totals_summary->TotalGroups > 0) { ?>
<?php if (!$Payoll_totals_summary->isExport() && !($Payoll_totals_summary->DrillDown && $Payoll_totals_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payoll_totals_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php echo $Payoll_totals_summary->PageBreakContent ?>
<?php } ?>
<div class="<?php if (!$Payoll_totals_summary->isExport("word") && !$Payoll_totals_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Payoll_totals_summary->ReportTableStyle ?>>
<?php if (!$Payoll_totals_summary->isExport() && !($Payoll_totals_summary->DrillDown && $Payoll_totals_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payoll_totals_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<!-- Report grid (begin) -->
<div id="gmp_Payoll_totals" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="<?php echo $Payoll_totals_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Payoll_totals_summary->LocalAuthority->Visible) { ?>
	<?php if ($Payoll_totals_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
	<th data-name="LocalAuthority">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payoll_totals_summary->sortUrl($Payoll_totals_summary->LocalAuthority) == "") { ?>
	<th data-name="LocalAuthority" class="<?php echo $Payoll_totals_summary->LocalAuthority->headerCellClass() ?>"><div class="Payoll_totals_LocalAuthority"><div class="ew-table-header-caption"><?php echo $Payoll_totals_summary->LocalAuthority->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="LocalAuthority" class="<?php echo $Payoll_totals_summary->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payoll_totals_summary->sortUrl($Payoll_totals_summary->LocalAuthority) ?>', 1);"><div class="Payoll_totals_LocalAuthority">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payoll_totals_summary->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payoll_totals_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payoll_totals_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payoll_totals_summary->PayPeriod->Visible) { ?>
	<?php if ($Payoll_totals_summary->PayPeriod->ShowGroupHeaderAsRow) { ?>
	<th data-name="PayPeriod">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payoll_totals_summary->sortUrl($Payoll_totals_summary->PayPeriod) == "") { ?>
	<th data-name="PayPeriod" class="<?php echo $Payoll_totals_summary->PayPeriod->headerCellClass() ?>"><div class="Payoll_totals_PayPeriod"><div class="ew-table-header-caption"><?php echo $Payoll_totals_summary->PayPeriod->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="PayPeriod" class="<?php echo $Payoll_totals_summary->PayPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payoll_totals_summary->sortUrl($Payoll_totals_summary->PayPeriod) ?>', 1);"><div class="Payoll_totals_PayPeriod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payoll_totals_summary->PayPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payoll_totals_summary->PayPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payoll_totals_summary->PayPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payoll_totals_summary->Item->Visible) { ?>
	<?php if ($Payoll_totals_summary->Item->ShowGroupHeaderAsRow) { ?>
	<th data-name="Item">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Payoll_totals_summary->sortUrl($Payoll_totals_summary->Item) == "") { ?>
	<th data-name="Item" class="<?php echo $Payoll_totals_summary->Item->headerCellClass() ?>"><div class="Payoll_totals_Item"><div class="ew-table-header-caption"><?php echo $Payoll_totals_summary->Item->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="Item" class="<?php echo $Payoll_totals_summary->Item->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Payoll_totals_summary->sortUrl($Payoll_totals_summary->Item) ?>', 1);"><div class="Payoll_totals_Item">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Payoll_totals_summary->Item->caption() ?></span><span class="ew-table-header-sort"><?php if ($Payoll_totals_summary->Item->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payoll_totals_summary->Item->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Payoll_totals_summary->Income->Visible) { ?>
	<th data-name="Income" class="<?php echo $Payoll_totals_summary->Income->headerCellClass() ?>"><div class="ew-table-header-btn"><div class="ew-table-header-caption"><?php echo $Payoll_totals_summary->Income->caption() ?> (<?php echo $Language->phrase("RptSum") ?>)</div></div></th>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Payoll_totals_summary->TotalGroups == 0)
			break; // Show header only
		$Payoll_totals_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Payoll_totals_summary->LocalAuthority, $Payoll_totals_summary->getSqlFirstGroupField(), $Payoll_totals_summary->LocalAuthority->groupValue(), $Payoll_totals_summary->Dbid);
	if ($Payoll_totals_summary->PageFirstGroupFilter != "") $Payoll_totals_summary->PageFirstGroupFilter .= " OR ";
	$Payoll_totals_summary->PageFirstGroupFilter .= $where;
	if ($Payoll_totals_summary->Filter != "")
		$where = "($Payoll_totals_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Payoll_totals_summary->getSqlSelect(), $Payoll_totals_summary->getSqlWhere(), $Payoll_totals_summary->getSqlGroupBy(), $Payoll_totals_summary->getSqlHaving(), $Payoll_totals_summary->getSqlOrderBy(), $where, $Payoll_totals_summary->Sort);
	$rs = $Payoll_totals_summary->getRecordset($sql);
	$Payoll_totals_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Payoll_totals_summary->DetailRecordCount = count($Payoll_totals_summary->DetailRecords);

	// Load detail records
	$Payoll_totals_summary->LocalAuthority->Records = &$Payoll_totals_summary->DetailRecords;
	$Payoll_totals_summary->LocalAuthority->LevelBreak = TRUE; // Set field level break
		$Payoll_totals_summary->GroupCounter[1] = $Payoll_totals_summary->GroupCount;
		$Payoll_totals_summary->LocalAuthority->getCnt($Payoll_totals_summary->LocalAuthority->Records); // Get record count
?>
<?php if ($Payoll_totals_summary->LocalAuthority->Visible && $Payoll_totals_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payoll_totals_summary->resetAttributes();
		$Payoll_totals_summary->RowType = ROWTYPE_TOTAL;
		$Payoll_totals_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payoll_totals_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payoll_totals_summary->RowGroupLevel = 1;
		$Payoll_totals_summary->renderRow();
?>
	<tr<?php echo $Payoll_totals_summary->rowAttributes(); ?>>
<?php if ($Payoll_totals_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payoll_totals_summary->LocalAuthority->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="LocalAuthority" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Payoll_totals_summary->LocalAuthority->cellAttributes() ?>>
<?php if ($Payoll_totals_summary->sortUrl($Payoll_totals_summary->LocalAuthority) == "") { ?>
		<span class="ew-summary-caption Payoll_totals_LocalAuthority"><span class="ew-table-header-caption"><?php echo $Payoll_totals_summary->LocalAuthority->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payoll_totals_LocalAuthority" onclick="ew.sort(event, '<?php echo $Payoll_totals_summary->sortUrl($Payoll_totals_summary->LocalAuthority) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payoll_totals_summary->LocalAuthority->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payoll_totals_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payoll_totals_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payoll_totals_summary->LocalAuthority->viewAttributes() ?>><?php echo $Payoll_totals_summary->LocalAuthority->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payoll_totals_summary->LocalAuthority->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payoll_totals_summary->PayPeriod->getDistinctValues($Payoll_totals_summary->LocalAuthority->Records);
	$Payoll_totals_summary->setGroupCount(count($Payoll_totals_summary->PayPeriod->DistinctValues), $Payoll_totals_summary->GroupCounter[1]);
	$Payoll_totals_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($Payoll_totals_summary->PayPeriod->DistinctValues as $PayPeriod) { // Load records for this distinct value
		$Payoll_totals_summary->PayPeriod->setGroupValue($PayPeriod); // Set group value
		$Payoll_totals_summary->PayPeriod->getDistinctRecords($Payoll_totals_summary->LocalAuthority->Records, $Payoll_totals_summary->PayPeriod->groupValue());
		$Payoll_totals_summary->PayPeriod->LevelBreak = TRUE; // Set field level break
		$Payoll_totals_summary->GroupCounter[2]++;
		$Payoll_totals_summary->PayPeriod->getCnt($Payoll_totals_summary->PayPeriod->Records); // Get record count
?>
<?php if ($Payoll_totals_summary->PayPeriod->Visible && $Payoll_totals_summary->PayPeriod->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payoll_totals_summary->PayPeriod->setDbValue($PayPeriod); // Set current value for PayPeriod
		$Payoll_totals_summary->resetAttributes();
		$Payoll_totals_summary->RowType = ROWTYPE_TOTAL;
		$Payoll_totals_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payoll_totals_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payoll_totals_summary->RowGroupLevel = 2;
		$Payoll_totals_summary->renderRow();
?>
	<tr<?php echo $Payoll_totals_summary->rowAttributes(); ?>>
<?php if ($Payoll_totals_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payoll_totals_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payoll_totals_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payoll_totals_summary->PayPeriod->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="PayPeriod" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $Payoll_totals_summary->PayPeriod->cellAttributes() ?>>
<?php if ($Payoll_totals_summary->sortUrl($Payoll_totals_summary->PayPeriod) == "") { ?>
		<span class="ew-summary-caption Payoll_totals_PayPeriod"><span class="ew-table-header-caption"><?php echo $Payoll_totals_summary->PayPeriod->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payoll_totals_PayPeriod" onclick="ew.sort(event, '<?php echo $Payoll_totals_summary->sortUrl($Payoll_totals_summary->PayPeriod) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payoll_totals_summary->PayPeriod->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payoll_totals_summary->PayPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payoll_totals_summary->PayPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payoll_totals_summary->PayPeriod->viewAttributes() ?>><?php echo $Payoll_totals_summary->PayPeriod->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payoll_totals_summary->PayPeriod->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payoll_totals_summary->Item->getDistinctValues($Payoll_totals_summary->PayPeriod->Records);
	$Payoll_totals_summary->setGroupCount(count($Payoll_totals_summary->Item->DistinctValues), $Payoll_totals_summary->GroupCounter[1], $Payoll_totals_summary->GroupCounter[2]);
	$Payoll_totals_summary->GroupCounter[3] = 0; // Init group count index
	foreach ($Payoll_totals_summary->Item->DistinctValues as $Item) { // Load records for this distinct value
		$Payoll_totals_summary->Item->setGroupValue($Item); // Set group value
		$Payoll_totals_summary->Item->getDistinctRecords($Payoll_totals_summary->PayPeriod->Records, $Payoll_totals_summary->Item->groupValue());
		$Payoll_totals_summary->Item->LevelBreak = TRUE; // Set field level break
		$Payoll_totals_summary->GroupCounter[3]++;
		$Payoll_totals_summary->Item->getCnt($Payoll_totals_summary->Item->Records); // Get record count
		$Payoll_totals_summary->setGroupCount($Payoll_totals_summary->Item->Count, $Payoll_totals_summary->GroupCounter[1], $Payoll_totals_summary->GroupCounter[2], $Payoll_totals_summary->GroupCounter[3]);
?>
<?php if ($Payoll_totals_summary->Item->Visible && $Payoll_totals_summary->Item->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Payoll_totals_summary->Item->setDbValue($Item); // Set current value for Item
		$Payoll_totals_summary->resetAttributes();
		$Payoll_totals_summary->RowType = ROWTYPE_TOTAL;
		$Payoll_totals_summary->RowTotalType = ROWTOTAL_GROUP;
		$Payoll_totals_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Payoll_totals_summary->RowGroupLevel = 3;
		$Payoll_totals_summary->renderRow();
?>
	<tr<?php echo $Payoll_totals_summary->rowAttributes(); ?>>
<?php if ($Payoll_totals_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payoll_totals_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payoll_totals_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payoll_totals_summary->PayPeriod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Payoll_totals_summary->Item->Visible) { ?>
		<td data-field="Item"<?php echo $Payoll_totals_summary->Item->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="Item" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 3) ?>"<?php echo $Payoll_totals_summary->Item->cellAttributes() ?>>
<?php if ($Payoll_totals_summary->sortUrl($Payoll_totals_summary->Item) == "") { ?>
		<span class="ew-summary-caption Payoll_totals_Item"><span class="ew-table-header-caption"><?php echo $Payoll_totals_summary->Item->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Payoll_totals_Item" onclick="ew.sort(event, '<?php echo $Payoll_totals_summary->sortUrl($Payoll_totals_summary->Item) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Payoll_totals_summary->Item->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Payoll_totals_summary->Item->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Payoll_totals_summary->Item->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Payoll_totals_summary->Item->viewAttributes() ?>><?php echo $Payoll_totals_summary->Item->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Payoll_totals_summary->Item->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Payoll_totals_summary->RecordCount = 0; // Reset record count
	foreach ($Payoll_totals_summary->Item->Records as $record) {
		$Payoll_totals_summary->RecordCount++;
		$Payoll_totals_summary->RecordIndex++;
		$Payoll_totals_summary->loadRowValues($record);
?>
<?php
	}
?>
<?php if ($Payoll_totals_summary->TotalGroups > 0) { ?>
<?php
	$Payoll_totals_summary->Income->getSum($Payoll_totals_summary->Item->Records); // Get Sum
	$Payoll_totals_summary->resetAttributes();
	$Payoll_totals_summary->RowType = ROWTYPE_TOTAL;
	$Payoll_totals_summary->RowTotalType = ROWTOTAL_GROUP;
	$Payoll_totals_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Payoll_totals_summary->RowGroupLevel = 3;
	$Payoll_totals_summary->renderRow();
?>
	<tr<?php echo $Payoll_totals_summary->rowAttributes(); ?>>
<?php if ($Payoll_totals_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Payoll_totals_summary->LocalAuthority->cellAttributes() ?>>
<span<?php echo $Payoll_totals_summary->LocalAuthority->viewAttributes() ?>><?php echo $Payoll_totals_summary->LocalAuthority->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Payoll_totals_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod"<?php echo $Payoll_totals_summary->PayPeriod->cellAttributes() ?>>
<span<?php echo $Payoll_totals_summary->PayPeriod->viewAttributes() ?>><?php echo $Payoll_totals_summary->PayPeriod->GroupViewValue ?></span></td>
<?php } ?>
<?php if ($Payoll_totals_summary->Item->Visible) { ?>
		<td data-field="Item"<?php echo $Payoll_totals_summary->Item->cellAttributes() ?>><span<?php echo $Payoll_totals_summary->Item->viewAttributes() ?>><?php echo $Payoll_totals_summary->Item->GroupViewValue ?></span>&nbsp;<span class="ew-detail-count">(<?php echo FormatNumber($Payoll_totals_summary->Item->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
<?php if ($Payoll_totals_summary->Income->Visible) { ?>
		<td data-field="Income"<?php echo $Payoll_totals_summary->Income->cellAttributes() ?>>
<span<?php echo $Payoll_totals_summary->Income->viewAttributes() ?>><?php echo $Payoll_totals_summary->Income->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
<?php } ?>
<?php
	} // End group level 2
	} // End group level 1
?>
<?php

	// Next group
	$Payoll_totals_summary->loadGroupRowValues();

	// Show header if page break
	if ($Payoll_totals_summary->isExport())
		$Payoll_totals_summary->ShowHeader = ($Payoll_totals_summary->ExportPageBreakCount == 0) ? FALSE : ($Payoll_totals_summary->GroupCount % $Payoll_totals_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Payoll_totals_summary->ShowHeader)
		$Payoll_totals_summary->Page_Breaking($Payoll_totals_summary->ShowHeader, $Payoll_totals_summary->PageBreakContent);
	$Payoll_totals_summary->GroupCount++;
} // End while
?>
<?php if ($Payoll_totals_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Payoll_totals_summary->resetAttributes();
	$Payoll_totals_summary->RowType = ROWTYPE_TOTAL;
	$Payoll_totals_summary->RowTotalType = ROWTOTAL_GRAND;
	$Payoll_totals_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Payoll_totals_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Payoll_totals_summary->renderRow();
?>
	<tr<?php echo $Payoll_totals_summary->rowAttributes(); ?>>
		<td><?php echo $Language->phrase("RptGrandSummary") ?>&nbsp;<span class="ew-detail-count">(<?php echo FormatNumber($Payoll_totals_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php if ($Payoll_totals_summary->PayPeriod->Visible) { ?>
		<td data-field="PayPeriod">&nbsp;</td>
<?php } ?>
<?php if ($Payoll_totals_summary->Item->Visible) { ?>
		<td data-field="Item">&nbsp;</td>
<?php } ?>
<?php if ($Payoll_totals_summary->Income->Visible) { ?>
		<td data-field="Income"<?php echo $Payoll_totals_summary->Income->cellAttributes() ?>>
<span<?php echo $Payoll_totals_summary->Income->viewAttributes() ?>><?php echo $Payoll_totals_summary->Income->SumViewValue ?></span>
</td>
<?php } ?>
	</tr>
</tfoot>
</table>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php if ($Payoll_totals_summary->TotalGroups > 0) { ?>
<?php if (!$Payoll_totals_summary->isExport() && !($Payoll_totals_summary->DrillDown && $Payoll_totals_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Payoll_totals_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
</div>
<!-- /#report-summary -->
<!-- Summary report (end) -->
<?php if ((!$Payoll_totals_summary->isExport() || $Payoll_totals_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Payoll_totals_summary->isExport() || $Payoll_totals_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Payoll_totals_summary->isExport() || $Payoll_totals_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Payoll_totals_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Payoll_totals_summary->isExport() && !$Payoll_totals_summary->DrillDown && !$DashboardReport) { ?>
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
$Payoll_totals_summary->terminate();
?>