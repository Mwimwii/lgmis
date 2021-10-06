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
$Third_Party_schedules_summary = new Third_Party_schedules_summary();

// Run the page
$Third_Party_schedules_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Third_Party_schedules_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Third_Party_schedules_summary->isExport() && !$Third_Party_schedules_summary->DrillDown && !$DashboardReport) { ?>
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
	fsummary.lists["x_PayrollPeriod"] = <?php echo $Third_Party_schedules_summary->PayrollPeriod->Lookup->toClientList($Third_Party_schedules_summary) ?>;
	fsummary.lists["x_PayrollPeriod"].options = <?php echo JsonEncode($Third_Party_schedules_summary->PayrollPeriod->lookupOptions()) ?>;
	fsummary.lists["x_pCode[]"] = <?php echo $Third_Party_schedules_summary->pCode->Lookup->toClientList($Third_Party_schedules_summary) ?>;
	fsummary.lists["x_pCode[]"].options = <?php echo JsonEncode($Third_Party_schedules_summary->pCode->lookupOptions()) ?>;
	fsummary.lists["x_ThirdPartyPayMethod"] = <?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->Lookup->toClientList($Third_Party_schedules_summary) ?>;
	fsummary.lists["x_ThirdPartyPayMethod"].options = <?php echo JsonEncode($Third_Party_schedules_summary->ThirdPartyPayMethod->lookupOptions()) ?>;
	fsummary.lists["x_ThirdPartyBank"] = <?php echo $Third_Party_schedules_summary->ThirdPartyBank->Lookup->toClientList($Third_Party_schedules_summary) ?>;
	fsummary.lists["x_ThirdPartyBank"].options = <?php echo JsonEncode($Third_Party_schedules_summary->ThirdPartyBank->lookupOptions()) ?>;

	// Filters
	fsummary.filterList = <?php echo $Third_Party_schedules_summary->getFilterList() ?>;

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
<?php if ((!$Third_Party_schedules_summary->isExport() || $Third_Party_schedules_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<?php if ($Third_Party_schedules_summary->ShowCurrentFilter) { ?>
<?php $Third_Party_schedules_summary->showFilterList() ?>
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Third_Party_schedules_summary->DrillDownInPanel) {
	$Third_Party_schedules_summary->ExportOptions->render("body");
	$Third_Party_schedules_summary->SearchOptions->render("body");
	$Third_Party_schedules_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Third_Party_schedules_summary->showPageHeader(); ?>
<?php
$Third_Party_schedules_summary->showMessage();
?>
<?php if ((!$Third_Party_schedules_summary->isExport() || $Third_Party_schedules_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Third_Party_schedules_summary->isExport() || $Third_Party_schedules_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Third_Party_schedules_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$Third_Party_schedules_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$Third_Party_schedules_summary->isExport() && !$Third_Party_schedules_summary->DrillDown && !$DashboardReport) { ?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$Third_Party_schedules_summary->isExport() && !$Third_Party_schedules->CurrentAction) { ?>
<form name="fsummary" id="fsummary" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsummary-search-panel" class="<?php echo $Third_Party_schedules_summary->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Third_Party_schedules">
	<div class="ew-extended-search">
<?php

// Render search row
$Third_Party_schedules->RowType = ROWTYPE_SEARCH;
$Third_Party_schedules->resetAttributes();
$Third_Party_schedules_summary->renderRow();
?>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php
		$Third_Party_schedules_summary->SearchColumnCount++;
		if (($Third_Party_schedules_summary->SearchColumnCount - 1) % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) {
			$Third_Party_schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Third_Party_schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LocalAuthority" class="ew-cell form-group">
		<label for="x_LocalAuthority" class="ew-search-caption ew-label"><?php echo $Third_Party_schedules_summary->LocalAuthority->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		<span id="el_Third_Party_schedules_LocalAuthority" class="ew-search-field">
<input type="text" data-table="Third_Party_schedules" data-field="x_LocalAuthority" name="x_LocalAuthority" id="x_LocalAuthority" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($Third_Party_schedules_summary->LocalAuthority->getPlaceHolder()) ?>" value="<?php echo $Third_Party_schedules_summary->LocalAuthority->EditValue ?>"<?php echo $Third_Party_schedules_summary->LocalAuthority->editAttributes() ?>>
</span>
	</div>
	<?php if ($Third_Party_schedules_summary->SearchColumnCount % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php
		$Third_Party_schedules_summary->SearchColumnCount++;
		if (($Third_Party_schedules_summary->SearchColumnCount - 1) % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) {
			$Third_Party_schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Third_Party_schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PayrollPeriod" class="ew-cell form-group">
		<label for="x_PayrollPeriod" class="ew-search-caption ew-label"><?php echo $Third_Party_schedules_summary->PayrollPeriod->caption() ?></label>
		<span id="el_Third_Party_schedules_PayrollPeriod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Third_Party_schedules" data-field="x_PayrollPeriod" data-value-separator="<?php echo $Third_Party_schedules_summary->PayrollPeriod->displayValueSeparatorAttribute() ?>" id="x_PayrollPeriod" name="x_PayrollPeriod"<?php echo $Third_Party_schedules_summary->PayrollPeriod->editAttributes() ?>>
			<?php echo $Third_Party_schedules_summary->PayrollPeriod->selectOptionListHtml("x_PayrollPeriod") ?>
		</select>
</div>
<?php echo $Third_Party_schedules_summary->PayrollPeriod->Lookup->getParamTag($Third_Party_schedules_summary, "p_x_PayrollPeriod") ?>
</span>
	</div>
	<?php if ($Third_Party_schedules_summary->SearchColumnCount % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Surname->Visible) { // Surname ?>
	<?php
		$Third_Party_schedules_summary->SearchColumnCount++;
		if (($Third_Party_schedules_summary->SearchColumnCount - 1) % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) {
			$Third_Party_schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Third_Party_schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Surname" class="ew-cell form-group">
		<label for="x_Surname" class="ew-search-caption ew-label"><?php echo $Third_Party_schedules_summary->Surname->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		<span id="el_Third_Party_schedules_Surname" class="ew-search-field">
<input type="text" data-table="Third_Party_schedules" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Third_Party_schedules_summary->Surname->getPlaceHolder()) ?>" value="<?php echo $Third_Party_schedules_summary->Surname->EditValue ?>"<?php echo $Third_Party_schedules_summary->Surname->editAttributes() ?>>
</span>
	</div>
	<?php if ($Third_Party_schedules_summary->SearchColumnCount % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->FirstName->Visible) { // FirstName ?>
	<?php
		$Third_Party_schedules_summary->SearchColumnCount++;
		if (($Third_Party_schedules_summary->SearchColumnCount - 1) % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) {
			$Third_Party_schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Third_Party_schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_FirstName" class="ew-cell form-group">
		<label for="x_FirstName" class="ew-search-caption ew-label"><?php echo $Third_Party_schedules_summary->FirstName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		<span id="el_Third_Party_schedules_FirstName" class="ew-search-field">
<input type="text" data-table="Third_Party_schedules" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($Third_Party_schedules_summary->FirstName->getPlaceHolder()) ?>" value="<?php echo $Third_Party_schedules_summary->FirstName->EditValue ?>"<?php echo $Third_Party_schedules_summary->FirstName->editAttributes() ?>>
</span>
	</div>
	<?php if ($Third_Party_schedules_summary->SearchColumnCount % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PositionName->Visible) { // PositionName ?>
	<?php
		$Third_Party_schedules_summary->SearchColumnCount++;
		if (($Third_Party_schedules_summary->SearchColumnCount - 1) % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) {
			$Third_Party_schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Third_Party_schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PositionName" class="ew-cell form-group">
		<label for="x_PositionName" class="ew-search-caption ew-label"><?php echo $Third_Party_schedules_summary->PositionName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PositionName" id="z_PositionName" value="LIKE">
</span>
		<span id="el_Third_Party_schedules_PositionName" class="ew-search-field">
<input type="text" data-table="Third_Party_schedules" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($Third_Party_schedules_summary->PositionName->getPlaceHolder()) ?>" value="<?php echo $Third_Party_schedules_summary->PositionName->EditValue ?>"<?php echo $Third_Party_schedules_summary->PositionName->editAttributes() ?>>
</span>
	</div>
	<?php if ($Third_Party_schedules_summary->SearchColumnCount % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pCode->Visible) { // pCode ?>
	<?php
		$Third_Party_schedules_summary->SearchColumnCount++;
		if (($Third_Party_schedules_summary->SearchColumnCount - 1) % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) {
			$Third_Party_schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Third_Party_schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_pCode" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $Third_Party_schedules_summary->pCode->caption() ?></label>
		<span id="el_Third_Party_schedules_pCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_pCode"><?php echo EmptyValue(strval($Third_Party_schedules_summary->pCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $Third_Party_schedules_summary->pCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($Third_Party_schedules_summary->pCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($Third_Party_schedules_summary->pCode->ReadOnly || $Third_Party_schedules_summary->pCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_pCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $Third_Party_schedules_summary->pCode->Lookup->getParamTag($Third_Party_schedules_summary, "p_x_pCode") ?>
<input type="hidden" data-table="Third_Party_schedules" data-field="x_pCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $Third_Party_schedules_summary->pCode->displayValueSeparatorAttribute() ?>" name="x_pCode[]" id="x_pCode[]" value="<?php echo $Third_Party_schedules_summary->pCode->AdvancedSearch->SearchValue ?>"<?php echo $Third_Party_schedules_summary->pCode->editAttributes() ?>>
</span>
	</div>
	<?php if ($Third_Party_schedules_summary->SearchColumnCount % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->Visible) { // ThirdPartyPayMethod ?>
	<?php
		$Third_Party_schedules_summary->SearchColumnCount++;
		if (($Third_Party_schedules_summary->SearchColumnCount - 1) % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) {
			$Third_Party_schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Third_Party_schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ThirdPartyPayMethod" class="ew-cell form-group">
		<label for="x_ThirdPartyPayMethod" class="ew-search-caption ew-label"><?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->caption() ?></label>
		<span id="el_Third_Party_schedules_ThirdPartyPayMethod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Third_Party_schedules" data-field="x_ThirdPartyPayMethod" data-value-separator="<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->displayValueSeparatorAttribute() ?>" id="x_ThirdPartyPayMethod" name="x_ThirdPartyPayMethod"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->editAttributes() ?>>
			<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->selectOptionListHtml("x_ThirdPartyPayMethod") ?>
		</select>
</div>
<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->Lookup->getParamTag($Third_Party_schedules_summary, "p_x_ThirdPartyPayMethod") ?>
</span>
	</div>
	<?php if ($Third_Party_schedules_summary->SearchColumnCount % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyBank->Visible) { // ThirdPartyBank ?>
	<?php
		$Third_Party_schedules_summary->SearchColumnCount++;
		if (($Third_Party_schedules_summary->SearchColumnCount - 1) % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) {
			$Third_Party_schedules_summary->SearchRowCount++;
	?>
<div id="xsr_<?php echo $Third_Party_schedules_summary->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ThirdPartyBank" class="ew-cell form-group">
		<label for="x_ThirdPartyBank" class="ew-search-caption ew-label"><?php echo $Third_Party_schedules_summary->ThirdPartyBank->caption() ?></label>
		<span id="el_Third_Party_schedules_ThirdPartyBank" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="Third_Party_schedules" data-field="x_ThirdPartyBank" data-value-separator="<?php echo $Third_Party_schedules_summary->ThirdPartyBank->displayValueSeparatorAttribute() ?>" id="x_ThirdPartyBank" name="x_ThirdPartyBank"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->editAttributes() ?>>
			<?php echo $Third_Party_schedules_summary->ThirdPartyBank->selectOptionListHtml("x_ThirdPartyBank") ?>
		</select>
</div>
<?php echo $Third_Party_schedules_summary->ThirdPartyBank->Lookup->getParamTag($Third_Party_schedules_summary, "p_x_ThirdPartyBank") ?>
</span>
	</div>
	<?php if ($Third_Party_schedules_summary->SearchColumnCount % $Third_Party_schedules_summary->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($Third_Party_schedules_summary->SearchColumnCount % $Third_Party_schedules_summary->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $Third_Party_schedules_summary->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php } ?>
<?php
while ($Third_Party_schedules_summary->GroupCount <= count($Third_Party_schedules_summary->GroupRecords) && $Third_Party_schedules_summary->GroupCount <= $Third_Party_schedules_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Third_Party_schedules_summary->ShowHeader) {
?>
<?php if ($Third_Party_schedules_summary->GroupCount > 1) { ?>
</tbody>
</table>
<?php if (!$Third_Party_schedules_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Third_Party_schedules_summary->TotalGroups > 0) { ?>
<?php if (!$Third_Party_schedules_summary->isExport() && !($Third_Party_schedules_summary->DrillDown && $Third_Party_schedules_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Third_Party_schedules_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Third_Party_schedules_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php echo $Third_Party_schedules_summary->PageBreakContent ?>
<?php } ?>
<?php if (!$Third_Party_schedules_summary->isExport("pdf")) { ?>
<div class="<?php if (!$Third_Party_schedules_summary->isExport("word") && !$Third_Party_schedules_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Third_Party_schedules_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Third_Party_schedules_summary->isExport() && !($Third_Party_schedules_summary->DrillDown && $Third_Party_schedules_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Third_Party_schedules_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Third_Party_schedules_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Third_Party_schedules" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Third_Party_schedules_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
	<th data-name="LocalAuthority">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->LocalAuthority) == "") { ?>
	<th data-name="LocalAuthority" class="<?php echo $Third_Party_schedules_summary->LocalAuthority->headerCellClass() ?>"><div class="Third_Party_schedules_LocalAuthority"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->LocalAuthority->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="LocalAuthority" class="<?php echo $Third_Party_schedules_summary->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->LocalAuthority) ?>', 1);"><div class="Third_Party_schedules_LocalAuthority">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
	<th data-name="PayrollPeriod">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->PayrollPeriod) == "") { ?>
	<th data-name="PayrollPeriod" class="<?php echo $Third_Party_schedules_summary->PayrollPeriod->headerCellClass() ?>"><div class="Third_Party_schedules_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->PayrollPeriod->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="PayrollPeriod" class="<?php echo $Third_Party_schedules_summary->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->PayrollPeriod) ?>', 1);"><div class="Third_Party_schedules_PayrollPeriod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->ShowGroupHeaderAsRow) { ?>
	<th data-name="ThirdPartyPayMethod">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->ThirdPartyPayMethod) == "") { ?>
	<th data-name="ThirdPartyPayMethod" class="<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->headerCellClass() ?>"><div class="Third_Party_schedules_ThirdPartyPayMethod"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="ThirdPartyPayMethod" class="<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->ThirdPartyPayMethod) ?>', 1);"><div class="Third_Party_schedules_ThirdPartyPayMethod">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->ThirdPartyPayMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyBank->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->ThirdPartyBank->ShowGroupHeaderAsRow) { ?>
	<th data-name="ThirdPartyBank">&nbsp;</th>
	<?php } else { ?>
		<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->ThirdPartyBank) == "") { ?>
	<th data-name="ThirdPartyBank" class="<?php echo $Third_Party_schedules_summary->ThirdPartyBank->headerCellClass() ?>"><div class="Third_Party_schedules_ThirdPartyBank"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->ThirdPartyBank->caption() ?></div></div></th>
		<?php } else { ?>
	<th data-name="ThirdPartyBank" class="<?php echo $Third_Party_schedules_summary->ThirdPartyBank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->ThirdPartyBank) ?>', 1);"><div class="Third_Party_schedules_ThirdPartyBank">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->ThirdPartyBank->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->ThirdPartyBank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->ThirdPartyBank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Title->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->Title) == "") { ?>
	<th data-name="Title" class="<?php echo $Third_Party_schedules_summary->Title->headerCellClass() ?>"><div class="Third_Party_schedules_Title"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->Title->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Title" class="<?php echo $Third_Party_schedules_summary->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->Title) ?>', 1);"><div class="Third_Party_schedules_Title">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->Title->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Surname->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->Surname) == "") { ?>
	<th data-name="Surname" class="<?php echo $Third_Party_schedules_summary->Surname->headerCellClass() ?>"><div class="Third_Party_schedules_Surname"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->Surname->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Surname" class="<?php echo $Third_Party_schedules_summary->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->Surname) ?>', 1);"><div class="Third_Party_schedules_Surname">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->FirstName->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->FirstName) == "") { ?>
	<th data-name="FirstName" class="<?php echo $Third_Party_schedules_summary->FirstName->headerCellClass() ?>"><div class="Third_Party_schedules_FirstName"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="FirstName" class="<?php echo $Third_Party_schedules_summary->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->FirstName) ?>', 1);"><div class="Third_Party_schedules_FirstName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->MiddleName->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->MiddleName) == "") { ?>
	<th data-name="MiddleName" class="<?php echo $Third_Party_schedules_summary->MiddleName->headerCellClass() ?>"><div class="Third_Party_schedules_MiddleName"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="MiddleName" class="<?php echo $Third_Party_schedules_summary->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->MiddleName) ?>', 1);"><div class="Third_Party_schedules_MiddleName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PositionName->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->PositionName) == "") { ?>
	<th data-name="PositionName" class="<?php echo $Third_Party_schedules_summary->PositionName->headerCellClass() ?>"><div class="Third_Party_schedules_PositionName"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="PositionName" class="<?php echo $Third_Party_schedules_summary->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->PositionName) ?>', 1);"><div class="Third_Party_schedules_PositionName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pCode->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->pCode) == "") { ?>
	<th data-name="pCode" class="<?php echo $Third_Party_schedules_summary->pCode->headerCellClass() ?>"><div class="Third_Party_schedules_pCode"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->pCode->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="pCode" class="<?php echo $Third_Party_schedules_summary->pCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->pCode) ?>', 1);"><div class="Third_Party_schedules_pCode">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->pCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->pCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->pCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pName->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->pName) == "") { ?>
	<th data-name="pName" class="<?php echo $Third_Party_schedules_summary->pName->headerCellClass() ?>"><div class="Third_Party_schedules_pName"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->pName->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="pName" class="<?php echo $Third_Party_schedules_summary->pName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->pName) ?>', 1);"><div class="Third_Party_schedules_pName">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->pName->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->pName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->pName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Amount->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->Amount) == "") { ?>
	<th data-name="Amount" class="<?php echo $Third_Party_schedules_summary->Amount->headerCellClass() ?>"><div class="Third_Party_schedules_Amount"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->Amount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="Amount" class="<?php echo $Third_Party_schedules_summary->Amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->Amount) ?>', 1);"><div class="Third_Party_schedules_Amount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->Amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->Amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyAccount->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->ThirdPartyAccount) == "") { ?>
	<th data-name="ThirdPartyAccount" class="<?php echo $Third_Party_schedules_summary->ThirdPartyAccount->headerCellClass() ?>"><div class="Third_Party_schedules_ThirdPartyAccount"><div class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->ThirdPartyAccount->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="ThirdPartyAccount" class="<?php echo $Third_Party_schedules_summary->ThirdPartyAccount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->ThirdPartyAccount) ?>', 1);"><div class="Third_Party_schedules_ThirdPartyAccount">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->ThirdPartyAccount->caption() ?></span><span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->ThirdPartyAccount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->ThirdPartyAccount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Third_Party_schedules_summary->TotalGroups == 0)
			break; // Show header only
		$Third_Party_schedules_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php

	// Build detail SQL
	$where = DetailFilterSql($Third_Party_schedules_summary->LocalAuthority, $Third_Party_schedules_summary->getSqlFirstGroupField(), $Third_Party_schedules_summary->LocalAuthority->groupValue(), $Third_Party_schedules_summary->Dbid);
	if ($Third_Party_schedules_summary->PageFirstGroupFilter != "") $Third_Party_schedules_summary->PageFirstGroupFilter .= " OR ";
	$Third_Party_schedules_summary->PageFirstGroupFilter .= $where;
	if ($Third_Party_schedules_summary->Filter != "")
		$where = "($Third_Party_schedules_summary->Filter) AND ($where)";
	$sql = BuildReportSql($Third_Party_schedules_summary->getSqlSelect(), $Third_Party_schedules_summary->getSqlWhere(), $Third_Party_schedules_summary->getSqlGroupBy(), $Third_Party_schedules_summary->getSqlHaving(), $Third_Party_schedules_summary->getSqlOrderBy(), $where, $Third_Party_schedules_summary->Sort);
	$rs = $Third_Party_schedules_summary->getRecordset($sql);
	$Third_Party_schedules_summary->DetailRecords = $rs ? $rs->getRows() : [];
	$Third_Party_schedules_summary->DetailRecordCount = count($Third_Party_schedules_summary->DetailRecords);

	// Load detail records
	$Third_Party_schedules_summary->LocalAuthority->Records = &$Third_Party_schedules_summary->DetailRecords;
	$Third_Party_schedules_summary->LocalAuthority->LevelBreak = TRUE; // Set field level break
		$Third_Party_schedules_summary->GroupCounter[1] = $Third_Party_schedules_summary->GroupCount;
		$Third_Party_schedules_summary->LocalAuthority->getCnt($Third_Party_schedules_summary->LocalAuthority->Records); // Get record count
?>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible && $Third_Party_schedules_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Third_Party_schedules_summary->resetAttributes();
		$Third_Party_schedules_summary->RowType = ROWTYPE_TOTAL;
		$Third_Party_schedules_summary->RowTotalType = ROWTOTAL_GROUP;
		$Third_Party_schedules_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Third_Party_schedules_summary->RowGroupLevel = 1;
		$Third_Party_schedules_summary->renderRow();
?>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes(); ?>>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="LocalAuthority" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 1) ?>"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes() ?>>
<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->LocalAuthority) == "") { ?>
		<span class="ew-summary-caption Third_Party_schedules_LocalAuthority"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->LocalAuthority->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Third_Party_schedules_LocalAuthority" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->LocalAuthority) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->LocalAuthority->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Third_Party_schedules_summary->LocalAuthority->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->LocalAuthority->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->LocalAuthority->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Third_Party_schedules_summary->PayrollPeriod->getDistinctValues($Third_Party_schedules_summary->LocalAuthority->Records);
	$Third_Party_schedules_summary->setGroupCount(count($Third_Party_schedules_summary->PayrollPeriod->DistinctValues), $Third_Party_schedules_summary->GroupCounter[1]);
	$Third_Party_schedules_summary->GroupCounter[2] = 0; // Init group count index
	foreach ($Third_Party_schedules_summary->PayrollPeriod->DistinctValues as $PayrollPeriod) { // Load records for this distinct value
		$Third_Party_schedules_summary->PayrollPeriod->setGroupValue($PayrollPeriod); // Set group value
		$Third_Party_schedules_summary->PayrollPeriod->getDistinctRecords($Third_Party_schedules_summary->LocalAuthority->Records, $Third_Party_schedules_summary->PayrollPeriod->groupValue());
		$Third_Party_schedules_summary->PayrollPeriod->LevelBreak = TRUE; // Set field level break
		$Third_Party_schedules_summary->GroupCounter[2]++;
		$Third_Party_schedules_summary->PayrollPeriod->getCnt($Third_Party_schedules_summary->PayrollPeriod->Records); // Get record count
?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible && $Third_Party_schedules_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Third_Party_schedules_summary->PayrollPeriod->setDbValue($PayrollPeriod); // Set current value for PayrollPeriod
		$Third_Party_schedules_summary->resetAttributes();
		$Third_Party_schedules_summary->RowType = ROWTYPE_TOTAL;
		$Third_Party_schedules_summary->RowTotalType = ROWTOTAL_GROUP;
		$Third_Party_schedules_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Third_Party_schedules_summary->RowGroupLevel = 2;
		$Third_Party_schedules_summary->renderRow();
?>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes(); ?>>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Third_Party_schedules_summary->PayrollPeriod->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="PayrollPeriod" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 2) ?>"<?php echo $Third_Party_schedules_summary->PayrollPeriod->cellAttributes() ?>>
<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->PayrollPeriod) == "") { ?>
		<span class="ew-summary-caption Third_Party_schedules_PayrollPeriod"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->PayrollPeriod->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Third_Party_schedules_PayrollPeriod" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->PayrollPeriod) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->PayrollPeriod->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Third_Party_schedules_summary->PayrollPeriod->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->PayrollPeriod->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->PayrollPeriod->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Third_Party_schedules_summary->ThirdPartyPayMethod->getDistinctValues($Third_Party_schedules_summary->PayrollPeriod->Records);
	$Third_Party_schedules_summary->setGroupCount(count($Third_Party_schedules_summary->ThirdPartyPayMethod->DistinctValues), $Third_Party_schedules_summary->GroupCounter[1], $Third_Party_schedules_summary->GroupCounter[2]);
	$Third_Party_schedules_summary->GroupCounter[3] = 0; // Init group count index
	foreach ($Third_Party_schedules_summary->ThirdPartyPayMethod->DistinctValues as $ThirdPartyPayMethod) { // Load records for this distinct value
		$Third_Party_schedules_summary->ThirdPartyPayMethod->setGroupValue($ThirdPartyPayMethod); // Set group value
		$Third_Party_schedules_summary->ThirdPartyPayMethod->getDistinctRecords($Third_Party_schedules_summary->PayrollPeriod->Records, $Third_Party_schedules_summary->ThirdPartyPayMethod->groupValue());
		$Third_Party_schedules_summary->ThirdPartyPayMethod->LevelBreak = TRUE; // Set field level break
		$Third_Party_schedules_summary->GroupCounter[3]++;
		$Third_Party_schedules_summary->ThirdPartyPayMethod->getCnt($Third_Party_schedules_summary->ThirdPartyPayMethod->Records); // Get record count
?>
<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->Visible && $Third_Party_schedules_summary->ThirdPartyPayMethod->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Third_Party_schedules_summary->ThirdPartyPayMethod->setDbValue($ThirdPartyPayMethod); // Set current value for ThirdPartyPayMethod
		$Third_Party_schedules_summary->resetAttributes();
		$Third_Party_schedules_summary->RowType = ROWTYPE_TOTAL;
		$Third_Party_schedules_summary->RowTotalType = ROWTOTAL_GROUP;
		$Third_Party_schedules_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Third_Party_schedules_summary->RowGroupLevel = 3;
		$Third_Party_schedules_summary->renderRow();
?>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes(); ?>>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Third_Party_schedules_summary->PayrollPeriod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="ThirdPartyPayMethod" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 3) ?>"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>
<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->ThirdPartyPayMethod) == "") { ?>
		<span class="ew-summary-caption Third_Party_schedules_ThirdPartyPayMethod"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Third_Party_schedules_ThirdPartyPayMethod" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->ThirdPartyPayMethod) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->ThirdPartyPayMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->ThirdPartyPayMethod->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Third_Party_schedules_summary->ThirdPartyBank->getDistinctValues($Third_Party_schedules_summary->ThirdPartyPayMethod->Records);
	$Third_Party_schedules_summary->setGroupCount(count($Third_Party_schedules_summary->ThirdPartyBank->DistinctValues), $Third_Party_schedules_summary->GroupCounter[1], $Third_Party_schedules_summary->GroupCounter[2], $Third_Party_schedules_summary->GroupCounter[3]);
	$Third_Party_schedules_summary->GroupCounter[4] = 0; // Init group count index
	foreach ($Third_Party_schedules_summary->ThirdPartyBank->DistinctValues as $ThirdPartyBank) { // Load records for this distinct value
		$Third_Party_schedules_summary->ThirdPartyBank->setGroupValue($ThirdPartyBank); // Set group value
		$Third_Party_schedules_summary->ThirdPartyBank->getDistinctRecords($Third_Party_schedules_summary->ThirdPartyPayMethod->Records, $Third_Party_schedules_summary->ThirdPartyBank->groupValue());
		$Third_Party_schedules_summary->ThirdPartyBank->LevelBreak = TRUE; // Set field level break
		$Third_Party_schedules_summary->GroupCounter[4]++;
		$Third_Party_schedules_summary->ThirdPartyBank->getCnt($Third_Party_schedules_summary->ThirdPartyBank->Records); // Get record count
		$Third_Party_schedules_summary->setGroupCount($Third_Party_schedules_summary->ThirdPartyBank->Count, $Third_Party_schedules_summary->GroupCounter[1], $Third_Party_schedules_summary->GroupCounter[2], $Third_Party_schedules_summary->GroupCounter[3], $Third_Party_schedules_summary->GroupCounter[4]);
?>
<?php if ($Third_Party_schedules_summary->ThirdPartyBank->Visible && $Third_Party_schedules_summary->ThirdPartyBank->ShowGroupHeaderAsRow) { ?>
<?php

		// Render header row
		$Third_Party_schedules_summary->ThirdPartyBank->setDbValue($ThirdPartyBank); // Set current value for ThirdPartyBank
		$Third_Party_schedules_summary->resetAttributes();
		$Third_Party_schedules_summary->RowType = ROWTYPE_TOTAL;
		$Third_Party_schedules_summary->RowTotalType = ROWTOTAL_GROUP;
		$Third_Party_schedules_summary->RowTotalSubType = ROWTOTAL_HEADER;
		$Third_Party_schedules_summary->RowGroupLevel = 4;
		$Third_Party_schedules_summary->renderRow();
?>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes(); ?>>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Third_Party_schedules_summary->PayrollPeriod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes(); ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes(); ?>><span class="ew-group-toggle icon-collapse"></span></td>
<?php } ?>
		<td data-field="ThirdPartyBank" colspan="<?php echo ($Page->GroupColumnCount + $Page->DetailColumnCount - 4) ?>"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>>
<?php if ($Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->ThirdPartyBank) == "") { ?>
		<span class="ew-summary-caption Third_Party_schedules_ThirdPartyBank"><span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->ThirdPartyBank->caption() ?></span></span>
<?php } else { ?>
		<span class="ew-table-header-btn ew-pointer ew-summary-caption Third_Party_schedules_ThirdPartyBank" onclick="ew.sort(event, '<?php echo $Third_Party_schedules_summary->sortUrl($Third_Party_schedules_summary->ThirdPartyBank) ?>', 1);">
			<span class="ew-table-header-caption"><?php echo $Third_Party_schedules_summary->ThirdPartyBank->caption() ?></span>
			<span class="ew-table-header-sort"><?php if ($Third_Party_schedules_summary->ThirdPartyBank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Third_Party_schedules_summary->ThirdPartyBank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span>
		</span>
<?php } ?>
		<?php echo $Language->phrase("SummaryColon") ?><span<?php echo $Third_Party_schedules_summary->ThirdPartyBank->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->ThirdPartyBank->GroupViewValue ?></span>
		<span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->ThirdPartyBank->Count, 0); ?></span>)</span>
		</td>
	</tr>
<?php } ?>
<?php
	$Third_Party_schedules_summary->RecordCount = 0; // Reset record count
	foreach ($Third_Party_schedules_summary->ThirdPartyBank->Records as $record) {
		$Third_Party_schedules_summary->RecordCount++;
		$Third_Party_schedules_summary->RecordIndex++;
		$Third_Party_schedules_summary->loadRowValues($record);
?>
<?php

		// Render detail row
		$Third_Party_schedules_summary->resetAttributes();
		$Third_Party_schedules_summary->RowType = ROWTYPE_DETAIL;
		$Third_Party_schedules_summary->renderRow();
?>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes(); ?>>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		<td data-field="LocalAuthority"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="LocalAuthority"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes(); ?>><span<?php echo $Third_Party_schedules_summary->LocalAuthority->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->LocalAuthority->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
		<td data-field="PayrollPeriod"<?php echo $Third_Party_schedules_summary->PayrollPeriod->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="PayrollPeriod"<?php echo $Third_Party_schedules_summary->PayrollPeriod->cellAttributes(); ?>><span<?php echo $Third_Party_schedules_summary->PayrollPeriod->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->PayrollPeriod->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->ShowGroupHeaderAsRow) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes(); ?>><span<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyBank->Visible) { ?>
	<?php if ($Third_Party_schedules_summary->ThirdPartyBank->ShowGroupHeaderAsRow) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes(); ?>>&nbsp;</td>
	<?php } else { ?>
		<td data-field="ThirdPartyBank"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes(); ?>><span<?php echo $Third_Party_schedules_summary->ThirdPartyBank->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->ThirdPartyBank->GroupViewValue ?></span></td>
	<?php } ?>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Third_Party_schedules_summary->Title->cellAttributes() ?>>
<span<?php echo $Third_Party_schedules_summary->Title->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->Title->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Third_Party_schedules_summary->Surname->cellAttributes() ?>>
<span<?php echo $Third_Party_schedules_summary->Surname->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->Surname->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Third_Party_schedules_summary->FirstName->cellAttributes() ?>>
<span<?php echo $Third_Party_schedules_summary->FirstName->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->FirstName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Third_Party_schedules_summary->MiddleName->cellAttributes() ?>>
<span<?php echo $Third_Party_schedules_summary->MiddleName->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->MiddleName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Third_Party_schedules_summary->PositionName->cellAttributes() ?>>
<span<?php echo $Third_Party_schedules_summary->PositionName->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->PositionName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Third_Party_schedules_summary->pCode->cellAttributes() ?>>
<span<?php echo $Third_Party_schedules_summary->pCode->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->pCode->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Third_Party_schedules_summary->pName->cellAttributes() ?>>
<span<?php echo $Third_Party_schedules_summary->pName->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->pName->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Third_Party_schedules_summary->Amount->cellAttributes() ?>>
<span<?php echo $Third_Party_schedules_summary->Amount->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->Amount->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Third_Party_schedules_summary->ThirdPartyAccount->cellAttributes() ?>>
<span<?php echo $Third_Party_schedules_summary->ThirdPartyAccount->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->ThirdPartyAccount->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
	}
?>
<?php if ($Third_Party_schedules_summary->TotalGroups > 0) { ?>
<?php
	$Third_Party_schedules_summary->Amount->getSum($Third_Party_schedules_summary->ThirdPartyBank->Records); // Get Sum
	$Third_Party_schedules_summary->resetAttributes();
	$Third_Party_schedules_summary->RowType = ROWTYPE_TOTAL;
	$Third_Party_schedules_summary->RowTotalType = ROWTOTAL_GROUP;
	$Third_Party_schedules_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Third_Party_schedules_summary->RowGroupLevel = 4;
	$Third_Party_schedules_summary->renderRow();
?>
<?php if ($Third_Party_schedules_summary->ThirdPartyBank->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes(); ?>>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes() ?>>
	<?php if ($Third_Party_schedules_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Third_Party_schedules_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->LocalAuthority->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Third_Party_schedules_summary->PayrollPeriod->cellAttributes() ?>>
	<?php if ($Third_Party_schedules_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Third_Party_schedules_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->PayrollPeriod->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>
	<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Third_Party_schedules_summary->RowGroupLevel != 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->ThirdPartyPayMethod->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>>
	<?php if ($Third_Party_schedules_summary->ThirdPartyBank->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Third_Party_schedules_summary->RowGroupLevel != 4) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->ThirdPartyBank->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Third_Party_schedules_summary->Amount->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->Amount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes(); ?>>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Third_Party_schedules_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->SubGroupColumnCount + $Third_Party_schedules_summary->DetailColumnCount - 2 > 0) { ?>
		<td colspan="<?php echo ($Third_Party_schedules_summary->SubGroupColumnCount + $Third_Party_schedules_summary->DetailColumnCount - 2) ?>"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Third_Party_schedules_summary->ThirdPartyBank->GroupViewValue, $Third_Party_schedules_summary->ThirdPartyBank->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Third_Party_schedules_summary->ThirdPartyBank->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes(); ?>>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Third_Party_schedules_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Third_Party_schedules_summary->GroupColumnCount - 3) ?>"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Third_Party_schedules_summary->Amount->cellAttributes() ?>>
<span<?php echo $Third_Party_schedules_summary->Amount->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->Amount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Third_Party_schedules_summary->ThirdPartyBank->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	} // End group level 3
?>
<?php if ($Third_Party_schedules_summary->TotalGroups > 0) { ?>
<?php
	$Third_Party_schedules_summary->Amount->getSum($Third_Party_schedules_summary->ThirdPartyPayMethod->Records); // Get Sum
	$Third_Party_schedules_summary->resetAttributes();
	$Third_Party_schedules_summary->RowType = ROWTYPE_TOTAL;
	$Third_Party_schedules_summary->RowTotalType = ROWTOTAL_GROUP;
	$Third_Party_schedules_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Third_Party_schedules_summary->RowGroupLevel = 3;
	$Third_Party_schedules_summary->renderRow();
?>
<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes(); ?>>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes() ?>>
	<?php if ($Third_Party_schedules_summary->LocalAuthority->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Third_Party_schedules_summary->RowGroupLevel != 1) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->LocalAuthority->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Third_Party_schedules_summary->PayrollPeriod->cellAttributes() ?>>
	<?php if ($Third_Party_schedules_summary->PayrollPeriod->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Third_Party_schedules_summary->RowGroupLevel != 2) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->PayrollPeriod->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->Visible) { ?>
		<td data-field="ThirdPartyPayMethod"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>
	<?php if ($Third_Party_schedules_summary->ThirdPartyPayMethod->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Third_Party_schedules_summary->RowGroupLevel != 3) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->ThirdPartyPayMethod->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyBank->Visible) { ?>
		<td data-field="ThirdPartyBank"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>
	<?php if ($Third_Party_schedules_summary->ThirdPartyBank->ShowGroupHeaderAsRow) { ?>
		&nbsp;
	<?php } elseif ($Third_Party_schedules_summary->RowGroupLevel != 4) { ?>
		&nbsp;
	<?php } else { ?>
		<span class="ew-summary-count"><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->ThirdPartyBank->Count, 0); ?></span></span>
	<?php } ?>
		</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Third_Party_schedules_summary->Amount->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->Amount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes(); ?>>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Third_Party_schedules_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->SubGroupColumnCount + $Third_Party_schedules_summary->DetailColumnCount - 1 > 0) { ?>
		<td colspan="<?php echo ($Third_Party_schedules_summary->SubGroupColumnCount + $Third_Party_schedules_summary->DetailColumnCount - 1) ?>"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>><?php echo str_replace(["%v", "%c"], [$Third_Party_schedules_summary->ThirdPartyPayMethod->GroupViewValue, $Third_Party_schedules_summary->ThirdPartyPayMethod->caption()], $Language->phrase("RptSumHead")) ?> <span class="ew-dir-ltr">(<?php echo FormatNumber($Third_Party_schedules_summary->ThirdPartyPayMethod->Count, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td>
<?php } ?>
	</tr>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes(); ?>>
<?php if ($Third_Party_schedules_summary->LocalAuthority->Visible) { ?>
		<td data-field="LocalAuthority"<?php echo $Third_Party_schedules_summary->LocalAuthority->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PayrollPeriod->Visible) { ?>
		<td data-field="PayrollPeriod"<?php echo $Third_Party_schedules_summary->PayrollPeriod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo ($Third_Party_schedules_summary->GroupColumnCount - 2) ?>"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Third_Party_schedules_summary->Amount->cellAttributes() ?>>
<span<?php echo $Third_Party_schedules_summary->Amount->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->Amount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Third_Party_schedules_summary->ThirdPartyPayMethod->cellAttributes() ?>>&nbsp;</td>
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
	$Third_Party_schedules_summary->loadGroupRowValues();

	// Show header if page break
	if ($Third_Party_schedules_summary->isExport())
		$Third_Party_schedules_summary->ShowHeader = ($Third_Party_schedules_summary->ExportPageBreakCount == 0) ? FALSE : ($Third_Party_schedules_summary->GroupCount % $Third_Party_schedules_summary->ExportPageBreakCount == 0);

	// Page_Breaking server event
	if ($Third_Party_schedules_summary->ShowHeader)
		$Third_Party_schedules_summary->Page_Breaking($Third_Party_schedules_summary->ShowHeader, $Third_Party_schedules_summary->PageBreakContent);
	$Third_Party_schedules_summary->GroupCount++;
} // End while
?>
<?php if ($Third_Party_schedules_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php
	$Third_Party_schedules_summary->resetAttributes();
	$Third_Party_schedules_summary->RowType = ROWTYPE_TOTAL;
	$Third_Party_schedules_summary->RowTotalType = ROWTOTAL_GRAND;
	$Third_Party_schedules_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Third_Party_schedules_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Third_Party_schedules_summary->renderRow();
?>
<?php if ($Third_Party_schedules_summary->LocalAuthority->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes() ?>><td colspan="<?php echo ($Third_Party_schedules_summary->GroupColumnCount + $Third_Party_schedules_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Third_Party_schedules_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes() ?>>
<?php if ($Third_Party_schedules_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Third_Party_schedules_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Third_Party_schedules_summary->Title->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Third_Party_schedules_summary->Surname->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Third_Party_schedules_summary->FirstName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Third_Party_schedules_summary->MiddleName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Third_Party_schedules_summary->PositionName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Third_Party_schedules_summary->pCode->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Third_Party_schedules_summary->pName->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Third_Party_schedules_summary->Amount->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptSum") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Third_Party_schedules_summary->Amount->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->Amount->SumViewValue ?></span></span></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Third_Party_schedules_summary->ThirdPartyAccount->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes() ?>><td colspan="<?php echo ($Third_Party_schedules_summary->GroupColumnCount + $Third_Party_schedules_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Third_Party_schedules_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Third_Party_schedules_summary->rowAttributes() ?>>
<?php if ($Third_Party_schedules_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Third_Party_schedules_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate"><?php echo $Language->phrase("RptSum") ?></td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Title->Visible) { ?>
		<td data-field="Title"<?php echo $Third_Party_schedules_summary->Title->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Surname->Visible) { ?>
		<td data-field="Surname"<?php echo $Third_Party_schedules_summary->Surname->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->FirstName->Visible) { ?>
		<td data-field="FirstName"<?php echo $Third_Party_schedules_summary->FirstName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->MiddleName->Visible) { ?>
		<td data-field="MiddleName"<?php echo $Third_Party_schedules_summary->MiddleName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->PositionName->Visible) { ?>
		<td data-field="PositionName"<?php echo $Third_Party_schedules_summary->PositionName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pCode->Visible) { ?>
		<td data-field="pCode"<?php echo $Third_Party_schedules_summary->pCode->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->pName->Visible) { ?>
		<td data-field="pName"<?php echo $Third_Party_schedules_summary->pName->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->Amount->Visible) { ?>
		<td data-field="Amount"<?php echo $Third_Party_schedules_summary->Amount->cellAttributes() ?>>
<span<?php echo $Third_Party_schedules_summary->Amount->viewAttributes() ?>><?php echo $Third_Party_schedules_summary->Amount->SumViewValue ?></span>
</td>
<?php } ?>
<?php if ($Third_Party_schedules_summary->ThirdPartyAccount->Visible) { ?>
		<td data-field="ThirdPartyAccount"<?php echo $Third_Party_schedules_summary->ThirdPartyAccount->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$Third_Party_schedules_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Third_Party_schedules_summary->TotalGroups > 0) { ?>
<?php if (!$Third_Party_schedules_summary->isExport() && !($Third_Party_schedules_summary->DrillDown && $Third_Party_schedules_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Third_Party_schedules_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Third_Party_schedules_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Third_Party_schedules_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Third_Party_schedules_summary->isExport() || $Third_Party_schedules_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Third_Party_schedules_summary->isExport() || $Third_Party_schedules_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Third_Party_schedules_summary->isExport() || $Third_Party_schedules_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Third_Party_schedules_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Third_Party_schedules_summary->isExport() && !$Third_Party_schedules_summary->DrillDown && !$DashboardReport) { ?>
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
$Third_Party_schedules_summary->terminate();
?>