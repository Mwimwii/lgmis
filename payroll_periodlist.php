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
$payroll_period_list = new payroll_period_list();

// Run the page
$payroll_period_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_period_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payroll_period_list->isExport()) { ?>
<script>
var fpayroll_periodlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpayroll_periodlist = currentForm = new ew.Form("fpayroll_periodlist", "list");
	fpayroll_periodlist.formKeyCountName = '<?php echo $payroll_period_list->FormKeyCountName ?>';

	// Validate form
	fpayroll_periodlist.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($payroll_period_list->PeriodCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_list->PeriodCode->caption(), $payroll_period_list->PeriodCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_period_list->FiscalYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FiscalYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_list->FiscalYear->caption(), $payroll_period_list->FiscalYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FiscalYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payroll_period_list->FiscalYear->errorMessage()) ?>");
			<?php if ($payroll_period_list->RunMonth->Required) { ?>
				elm = this.getElements("x" + infix + "_RunMonth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_list->RunMonth->caption(), $payroll_period_list->RunMonth->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_period_list->RunDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_RunDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_list->RunDescription->caption(), $payroll_period_list->RunDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_period_list->CurrentPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_list->CurrentPeriod->caption(), $payroll_period_list->CurrentPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fpayroll_periodlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayroll_periodlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpayroll_periodlist.lists["x_FiscalYear"] = <?php echo $payroll_period_list->FiscalYear->Lookup->toClientList($payroll_period_list) ?>;
	fpayroll_periodlist.lists["x_FiscalYear"].options = <?php echo JsonEncode($payroll_period_list->FiscalYear->lookupOptions()) ?>;
	fpayroll_periodlist.autoSuggests["x_FiscalYear"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpayroll_periodlist.lists["x_RunMonth"] = <?php echo $payroll_period_list->RunMonth->Lookup->toClientList($payroll_period_list) ?>;
	fpayroll_periodlist.lists["x_RunMonth"].options = <?php echo JsonEncode($payroll_period_list->RunMonth->lookupOptions()) ?>;
	fpayroll_periodlist.lists["x_CurrentPeriod"] = <?php echo $payroll_period_list->CurrentPeriod->Lookup->toClientList($payroll_period_list) ?>;
	fpayroll_periodlist.lists["x_CurrentPeriod"].options = <?php echo JsonEncode($payroll_period_list->CurrentPeriod->lookupOptions()) ?>;
	loadjs.done("fpayroll_periodlist");
});
var fpayroll_periodlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpayroll_periodlistsrch = currentSearchForm = new ew.Form("fpayroll_periodlistsrch");

	// Dynamic selection lists
	// Filters

	fpayroll_periodlistsrch.filterList = <?php echo $payroll_period_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpayroll_periodlistsrch.initSearchPanel = true;
	loadjs.done("fpayroll_periodlistsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$payroll_period_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($payroll_period_list->TotalRecords > 0 && $payroll_period_list->ExportOptions->visible()) { ?>
<?php $payroll_period_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_period_list->ImportOptions->visible()) { ?>
<?php $payroll_period_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_period_list->SearchOptions->visible()) { ?>
<?php $payroll_period_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_period_list->FilterOptions->visible()) { ?>
<?php $payroll_period_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$payroll_period_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$payroll_period_list->isExport() && !$payroll_period->CurrentAction) { ?>
<form name="fpayroll_periodlistsrch" id="fpayroll_periodlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpayroll_periodlistsrch-search-panel" class="<?php echo $payroll_period_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="payroll_period">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $payroll_period_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($payroll_period_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($payroll_period_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $payroll_period_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($payroll_period_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($payroll_period_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($payroll_period_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($payroll_period_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $payroll_period_list->showPageHeader(); ?>
<?php
$payroll_period_list->showMessage();
?>
<?php if ($payroll_period_list->TotalRecords > 0 || $payroll_period->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payroll_period_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payroll_period">
<?php if (!$payroll_period_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$payroll_period_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_period_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_period_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpayroll_periodlist" id="fpayroll_periodlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_period">
<div id="gmp_payroll_period" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($payroll_period_list->TotalRecords > 0 || $payroll_period_list->isAdd() || $payroll_period_list->isCopy() || $payroll_period_list->isGridEdit()) { ?>
<table id="tbl_payroll_periodlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payroll_period->RowType = ROWTYPE_HEADER;

// Render list options
$payroll_period_list->renderListOptions();

// Render list options (header, left)
$payroll_period_list->ListOptions->render("header", "left");
?>
<?php if ($payroll_period_list->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($payroll_period_list->SortUrl($payroll_period_list->PeriodCode) == "") { ?>
		<th data-name="PeriodCode" class="<?php echo $payroll_period_list->PeriodCode->headerCellClass() ?>"><div id="elh_payroll_period_PeriodCode" class="payroll_period_PeriodCode"><div class="ew-table-header-caption"><?php echo $payroll_period_list->PeriodCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodCode" class="<?php echo $payroll_period_list->PeriodCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_period_list->SortUrl($payroll_period_list->PeriodCode) ?>', 1);"><div id="elh_payroll_period_PeriodCode" class="payroll_period_PeriodCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_period_list->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_period_list->PeriodCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_period_list->PeriodCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_period_list->FiscalYear->Visible) { // FiscalYear ?>
	<?php if ($payroll_period_list->SortUrl($payroll_period_list->FiscalYear) == "") { ?>
		<th data-name="FiscalYear" class="<?php echo $payroll_period_list->FiscalYear->headerCellClass() ?>"><div id="elh_payroll_period_FiscalYear" class="payroll_period_FiscalYear"><div class="ew-table-header-caption"><?php echo $payroll_period_list->FiscalYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FiscalYear" class="<?php echo $payroll_period_list->FiscalYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_period_list->SortUrl($payroll_period_list->FiscalYear) ?>', 1);"><div id="elh_payroll_period_FiscalYear" class="payroll_period_FiscalYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_period_list->FiscalYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_period_list->FiscalYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_period_list->FiscalYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_period_list->RunMonth->Visible) { // RunMonth ?>
	<?php if ($payroll_period_list->SortUrl($payroll_period_list->RunMonth) == "") { ?>
		<th data-name="RunMonth" class="<?php echo $payroll_period_list->RunMonth->headerCellClass() ?>"><div id="elh_payroll_period_RunMonth" class="payroll_period_RunMonth"><div class="ew-table-header-caption"><?php echo $payroll_period_list->RunMonth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RunMonth" class="<?php echo $payroll_period_list->RunMonth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_period_list->SortUrl($payroll_period_list->RunMonth) ?>', 1);"><div id="elh_payroll_period_RunMonth" class="payroll_period_RunMonth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_period_list->RunMonth->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_period_list->RunMonth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_period_list->RunMonth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_period_list->RunDescription->Visible) { // RunDescription ?>
	<?php if ($payroll_period_list->SortUrl($payroll_period_list->RunDescription) == "") { ?>
		<th data-name="RunDescription" class="<?php echo $payroll_period_list->RunDescription->headerCellClass() ?>"><div id="elh_payroll_period_RunDescription" class="payroll_period_RunDescription"><div class="ew-table-header-caption"><?php echo $payroll_period_list->RunDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RunDescription" class="<?php echo $payroll_period_list->RunDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_period_list->SortUrl($payroll_period_list->RunDescription) ?>', 1);"><div id="elh_payroll_period_RunDescription" class="payroll_period_RunDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_period_list->RunDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_period_list->RunDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_period_list->RunDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_period_list->CurrentPeriod->Visible) { // CurrentPeriod ?>
	<?php if ($payroll_period_list->SortUrl($payroll_period_list->CurrentPeriod) == "") { ?>
		<th data-name="CurrentPeriod" class="<?php echo $payroll_period_list->CurrentPeriod->headerCellClass() ?>"><div id="elh_payroll_period_CurrentPeriod" class="payroll_period_CurrentPeriod"><div class="ew-table-header-caption"><?php echo $payroll_period_list->CurrentPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentPeriod" class="<?php echo $payroll_period_list->CurrentPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_period_list->SortUrl($payroll_period_list->CurrentPeriod) ?>', 1);"><div id="elh_payroll_period_CurrentPeriod" class="payroll_period_CurrentPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_period_list->CurrentPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_period_list->CurrentPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_period_list->CurrentPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payroll_period_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($payroll_period_list->isAdd() || $payroll_period_list->isCopy()) {
		$payroll_period_list->RowIndex = 0;
		$payroll_period_list->KeyCount = $payroll_period_list->RowIndex;
		if ($payroll_period_list->isCopy() && !$payroll_period_list->loadRow())
			$payroll_period->CurrentAction = "add";
		if ($payroll_period_list->isAdd())
			$payroll_period_list->loadRowValues();
		if ($payroll_period->EventCancelled) // Insert failed
			$payroll_period_list->restoreFormValues(); // Restore form values

		// Set row properties
		$payroll_period->resetAttributes();
		$payroll_period->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_payroll_period", "data-rowtype" => ROWTYPE_ADD]);
		$payroll_period->RowType = ROWTYPE_ADD;

		// Render row
		$payroll_period_list->renderRow();

		// Render list options
		$payroll_period_list->renderListOptions();
		$payroll_period_list->StartRowCount = 0;
?>
	<tr <?php echo $payroll_period->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payroll_period_list->ListOptions->render("body", "left", $payroll_period_list->RowCount);
?>
	<?php if ($payroll_period_list->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode">
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_PeriodCode" class="form-group payroll_period_PeriodCode"></span>
<input type="hidden" data-table="payroll_period" data-field="x_PeriodCode" name="o<?php echo $payroll_period_list->RowIndex ?>_PeriodCode" id="o<?php echo $payroll_period_list->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($payroll_period_list->PeriodCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_period_list->FiscalYear->Visible) { // FiscalYear ?>
		<td data-name="FiscalYear">
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_FiscalYear" class="form-group payroll_period_FiscalYear">
<?php
$onchange = $payroll_period_list->FiscalYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$payroll_period_list->FiscalYear->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $payroll_period_list->RowIndex ?>_FiscalYear">
	<input type="text" class="form-control" name="sv_x<?php echo $payroll_period_list->RowIndex ?>_FiscalYear" id="sv_x<?php echo $payroll_period_list->RowIndex ?>_FiscalYear" value="<?php echo RemoveHtml($payroll_period_list->FiscalYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($payroll_period_list->FiscalYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($payroll_period_list->FiscalYear->getPlaceHolder()) ?>"<?php echo $payroll_period_list->FiscalYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_period" data-field="x_FiscalYear" data-value-separator="<?php echo $payroll_period_list->FiscalYear->displayValueSeparatorAttribute() ?>" name="x<?php echo $payroll_period_list->RowIndex ?>_FiscalYear" id="x<?php echo $payroll_period_list->RowIndex ?>_FiscalYear" value="<?php echo HtmlEncode($payroll_period_list->FiscalYear->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpayroll_periodlist"], function() {
	fpayroll_periodlist.createAutoSuggest({"id":"x<?php echo $payroll_period_list->RowIndex ?>_FiscalYear","forceSelect":false});
});
</script>
<?php echo $payroll_period_list->FiscalYear->Lookup->getParamTag($payroll_period_list, "p_x" . $payroll_period_list->RowIndex . "_FiscalYear") ?>
</span>
<input type="hidden" data-table="payroll_period" data-field="x_FiscalYear" name="o<?php echo $payroll_period_list->RowIndex ?>_FiscalYear" id="o<?php echo $payroll_period_list->RowIndex ?>_FiscalYear" value="<?php echo HtmlEncode($payroll_period_list->FiscalYear->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_period_list->RunMonth->Visible) { // RunMonth ?>
		<td data-name="RunMonth">
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_RunMonth" class="form-group payroll_period_RunMonth">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="payroll_period" data-field="x_RunMonth" data-value-separator="<?php echo $payroll_period_list->RunMonth->displayValueSeparatorAttribute() ?>" id="x<?php echo $payroll_period_list->RowIndex ?>_RunMonth" name="x<?php echo $payroll_period_list->RowIndex ?>_RunMonth"<?php echo $payroll_period_list->RunMonth->editAttributes() ?>>
			<?php echo $payroll_period_list->RunMonth->selectOptionListHtml("x{$payroll_period_list->RowIndex}_RunMonth") ?>
		</select>
</div>
<?php echo $payroll_period_list->RunMonth->Lookup->getParamTag($payroll_period_list, "p_x" . $payroll_period_list->RowIndex . "_RunMonth") ?>
</span>
<input type="hidden" data-table="payroll_period" data-field="x_RunMonth" name="o<?php echo $payroll_period_list->RowIndex ?>_RunMonth" id="o<?php echo $payroll_period_list->RowIndex ?>_RunMonth" value="<?php echo HtmlEncode($payroll_period_list->RunMonth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_period_list->RunDescription->Visible) { // RunDescription ?>
		<td data-name="RunDescription">
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_RunDescription" class="form-group payroll_period_RunDescription">
<textarea data-table="payroll_period" data-field="x_RunDescription" name="x<?php echo $payroll_period_list->RowIndex ?>_RunDescription" id="x<?php echo $payroll_period_list->RowIndex ?>_RunDescription" cols="35" rows="2" placeholder="<?php echo HtmlEncode($payroll_period_list->RunDescription->getPlaceHolder()) ?>"<?php echo $payroll_period_list->RunDescription->editAttributes() ?>><?php echo $payroll_period_list->RunDescription->EditValue ?></textarea>
</span>
<input type="hidden" data-table="payroll_period" data-field="x_RunDescription" name="o<?php echo $payroll_period_list->RowIndex ?>_RunDescription" id="o<?php echo $payroll_period_list->RowIndex ?>_RunDescription" value="<?php echo HtmlEncode($payroll_period_list->RunDescription->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_period_list->CurrentPeriod->Visible) { // CurrentPeriod ?>
		<td data-name="CurrentPeriod">
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_CurrentPeriod" class="form-group payroll_period_CurrentPeriod">
<div id="tp_x<?php echo $payroll_period_list->RowIndex ?>_CurrentPeriod" class="ew-template"><input type="radio" class="custom-control-input" data-table="payroll_period" data-field="x_CurrentPeriod" data-value-separator="<?php echo $payroll_period_list->CurrentPeriod->displayValueSeparatorAttribute() ?>" name="x<?php echo $payroll_period_list->RowIndex ?>_CurrentPeriod" id="x<?php echo $payroll_period_list->RowIndex ?>_CurrentPeriod" value="{value}"<?php echo $payroll_period_list->CurrentPeriod->editAttributes() ?>></div>
<div id="dsl_x<?php echo $payroll_period_list->RowIndex ?>_CurrentPeriod" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $payroll_period_list->CurrentPeriod->radioButtonListHtml(FALSE, "x{$payroll_period_list->RowIndex}_CurrentPeriod") ?>
</div></div>
<?php echo $payroll_period_list->CurrentPeriod->Lookup->getParamTag($payroll_period_list, "p_x" . $payroll_period_list->RowIndex . "_CurrentPeriod") ?>
</span>
<input type="hidden" data-table="payroll_period" data-field="x_CurrentPeriod" name="o<?php echo $payroll_period_list->RowIndex ?>_CurrentPeriod" id="o<?php echo $payroll_period_list->RowIndex ?>_CurrentPeriod" value="<?php echo HtmlEncode($payroll_period_list->CurrentPeriod->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payroll_period_list->ListOptions->render("body", "right", $payroll_period_list->RowCount);
?>
<script>
loadjs.ready(["fpayroll_periodlist", "load"], function() {
	fpayroll_periodlist.updateLists(<?php echo $payroll_period_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($payroll_period_list->ExportAll && $payroll_period_list->isExport()) {
	$payroll_period_list->StopRecord = $payroll_period_list->TotalRecords;
} else {

	// Set the last record to display
	if ($payroll_period_list->TotalRecords > $payroll_period_list->StartRecord + $payroll_period_list->DisplayRecords - 1)
		$payroll_period_list->StopRecord = $payroll_period_list->StartRecord + $payroll_period_list->DisplayRecords - 1;
	else
		$payroll_period_list->StopRecord = $payroll_period_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($payroll_period->isConfirm() || $payroll_period_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($payroll_period_list->FormKeyCountName) && ($payroll_period_list->isGridAdd() || $payroll_period_list->isGridEdit() || $payroll_period->isConfirm())) {
		$payroll_period_list->KeyCount = $CurrentForm->getValue($payroll_period_list->FormKeyCountName);
		$payroll_period_list->StopRecord = $payroll_period_list->StartRecord + $payroll_period_list->KeyCount - 1;
	}
}
$payroll_period_list->RecordCount = $payroll_period_list->StartRecord - 1;
if ($payroll_period_list->Recordset && !$payroll_period_list->Recordset->EOF) {
	$payroll_period_list->Recordset->moveFirst();
	$selectLimit = $payroll_period_list->UseSelectLimit;
	if (!$selectLimit && $payroll_period_list->StartRecord > 1)
		$payroll_period_list->Recordset->move($payroll_period_list->StartRecord - 1);
} elseif (!$payroll_period->AllowAddDeleteRow && $payroll_period_list->StopRecord == 0) {
	$payroll_period_list->StopRecord = $payroll_period->GridAddRowCount;
}

// Initialize aggregate
$payroll_period->RowType = ROWTYPE_AGGREGATEINIT;
$payroll_period->resetAttributes();
$payroll_period_list->renderRow();
$payroll_period_list->EditRowCount = 0;
if ($payroll_period_list->isEdit())
	$payroll_period_list->RowIndex = 1;
while ($payroll_period_list->RecordCount < $payroll_period_list->StopRecord) {
	$payroll_period_list->RecordCount++;
	if ($payroll_period_list->RecordCount >= $payroll_period_list->StartRecord) {
		$payroll_period_list->RowCount++;

		// Set up key count
		$payroll_period_list->KeyCount = $payroll_period_list->RowIndex;

		// Init row class and style
		$payroll_period->resetAttributes();
		$payroll_period->CssClass = "";
		if ($payroll_period_list->isGridAdd()) {
			$payroll_period_list->loadRowValues(); // Load default values
		} else {
			$payroll_period_list->loadRowValues($payroll_period_list->Recordset); // Load row values
		}
		$payroll_period->RowType = ROWTYPE_VIEW; // Render view
		if ($payroll_period_list->isEdit()) {
			if ($payroll_period_list->checkInlineEditKey() && $payroll_period_list->EditRowCount == 0) { // Inline edit
				$payroll_period->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($payroll_period_list->isEdit() && $payroll_period->RowType == ROWTYPE_EDIT && $payroll_period->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$payroll_period_list->restoreFormValues(); // Restore form values
		}
		if ($payroll_period->RowType == ROWTYPE_EDIT) // Edit row
			$payroll_period_list->EditRowCount++;

		// Set up row id / data-rowindex
		$payroll_period->RowAttrs->merge(["data-rowindex" => $payroll_period_list->RowCount, "id" => "r" . $payroll_period_list->RowCount . "_payroll_period", "data-rowtype" => $payroll_period->RowType]);

		// Render row
		$payroll_period_list->renderRow();

		// Render list options
		$payroll_period_list->renderListOptions();
?>
	<tr <?php echo $payroll_period->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payroll_period_list->ListOptions->render("body", "left", $payroll_period_list->RowCount);
?>
	<?php if ($payroll_period_list->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode" <?php echo $payroll_period_list->PeriodCode->cellAttributes() ?>>
<?php if ($payroll_period->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_PeriodCode" class="form-group">
<span<?php echo $payroll_period_list->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_period_list->PeriodCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_period" data-field="x_PeriodCode" name="x<?php echo $payroll_period_list->RowIndex ?>_PeriodCode" id="x<?php echo $payroll_period_list->RowIndex ?>_PeriodCode" value="<?php echo HtmlEncode($payroll_period_list->PeriodCode->CurrentValue) ?>">
<?php } ?>
<?php if ($payroll_period->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_PeriodCode">
<span<?php echo $payroll_period_list->PeriodCode->viewAttributes() ?>><?php echo $payroll_period_list->PeriodCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_period_list->FiscalYear->Visible) { // FiscalYear ?>
		<td data-name="FiscalYear" <?php echo $payroll_period_list->FiscalYear->cellAttributes() ?>>
<?php if ($payroll_period->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_FiscalYear" class="form-group">
<?php
$onchange = $payroll_period_list->FiscalYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$payroll_period_list->FiscalYear->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $payroll_period_list->RowIndex ?>_FiscalYear">
	<input type="text" class="form-control" name="sv_x<?php echo $payroll_period_list->RowIndex ?>_FiscalYear" id="sv_x<?php echo $payroll_period_list->RowIndex ?>_FiscalYear" value="<?php echo RemoveHtml($payroll_period_list->FiscalYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($payroll_period_list->FiscalYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($payroll_period_list->FiscalYear->getPlaceHolder()) ?>"<?php echo $payroll_period_list->FiscalYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_period" data-field="x_FiscalYear" data-value-separator="<?php echo $payroll_period_list->FiscalYear->displayValueSeparatorAttribute() ?>" name="x<?php echo $payroll_period_list->RowIndex ?>_FiscalYear" id="x<?php echo $payroll_period_list->RowIndex ?>_FiscalYear" value="<?php echo HtmlEncode($payroll_period_list->FiscalYear->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpayroll_periodlist"], function() {
	fpayroll_periodlist.createAutoSuggest({"id":"x<?php echo $payroll_period_list->RowIndex ?>_FiscalYear","forceSelect":false});
});
</script>
<?php echo $payroll_period_list->FiscalYear->Lookup->getParamTag($payroll_period_list, "p_x" . $payroll_period_list->RowIndex . "_FiscalYear") ?>
</span>
<?php } ?>
<?php if ($payroll_period->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_FiscalYear">
<span<?php echo $payroll_period_list->FiscalYear->viewAttributes() ?>><?php echo $payroll_period_list->FiscalYear->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_period_list->RunMonth->Visible) { // RunMonth ?>
		<td data-name="RunMonth" <?php echo $payroll_period_list->RunMonth->cellAttributes() ?>>
<?php if ($payroll_period->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_RunMonth" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="payroll_period" data-field="x_RunMonth" data-value-separator="<?php echo $payroll_period_list->RunMonth->displayValueSeparatorAttribute() ?>" id="x<?php echo $payroll_period_list->RowIndex ?>_RunMonth" name="x<?php echo $payroll_period_list->RowIndex ?>_RunMonth"<?php echo $payroll_period_list->RunMonth->editAttributes() ?>>
			<?php echo $payroll_period_list->RunMonth->selectOptionListHtml("x{$payroll_period_list->RowIndex}_RunMonth") ?>
		</select>
</div>
<?php echo $payroll_period_list->RunMonth->Lookup->getParamTag($payroll_period_list, "p_x" . $payroll_period_list->RowIndex . "_RunMonth") ?>
</span>
<?php } ?>
<?php if ($payroll_period->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_RunMonth">
<span<?php echo $payroll_period_list->RunMonth->viewAttributes() ?>><?php echo $payroll_period_list->RunMonth->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_period_list->RunDescription->Visible) { // RunDescription ?>
		<td data-name="RunDescription" <?php echo $payroll_period_list->RunDescription->cellAttributes() ?>>
<?php if ($payroll_period->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_RunDescription" class="form-group">
<textarea data-table="payroll_period" data-field="x_RunDescription" name="x<?php echo $payroll_period_list->RowIndex ?>_RunDescription" id="x<?php echo $payroll_period_list->RowIndex ?>_RunDescription" cols="35" rows="2" placeholder="<?php echo HtmlEncode($payroll_period_list->RunDescription->getPlaceHolder()) ?>"<?php echo $payroll_period_list->RunDescription->editAttributes() ?>><?php echo $payroll_period_list->RunDescription->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($payroll_period->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_RunDescription">
<span<?php echo $payroll_period_list->RunDescription->viewAttributes() ?>><?php echo $payroll_period_list->RunDescription->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_period_list->CurrentPeriod->Visible) { // CurrentPeriod ?>
		<td data-name="CurrentPeriod" <?php echo $payroll_period_list->CurrentPeriod->cellAttributes() ?>>
<?php if ($payroll_period->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_CurrentPeriod" class="form-group">
<div id="tp_x<?php echo $payroll_period_list->RowIndex ?>_CurrentPeriod" class="ew-template"><input type="radio" class="custom-control-input" data-table="payroll_period" data-field="x_CurrentPeriod" data-value-separator="<?php echo $payroll_period_list->CurrentPeriod->displayValueSeparatorAttribute() ?>" name="x<?php echo $payroll_period_list->RowIndex ?>_CurrentPeriod" id="x<?php echo $payroll_period_list->RowIndex ?>_CurrentPeriod" value="{value}"<?php echo $payroll_period_list->CurrentPeriod->editAttributes() ?>></div>
<div id="dsl_x<?php echo $payroll_period_list->RowIndex ?>_CurrentPeriod" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $payroll_period_list->CurrentPeriod->radioButtonListHtml(FALSE, "x{$payroll_period_list->RowIndex}_CurrentPeriod") ?>
</div></div>
<?php echo $payroll_period_list->CurrentPeriod->Lookup->getParamTag($payroll_period_list, "p_x" . $payroll_period_list->RowIndex . "_CurrentPeriod") ?>
</span>
<?php } ?>
<?php if ($payroll_period->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_period_list->RowCount ?>_payroll_period_CurrentPeriod">
<span<?php echo $payroll_period_list->CurrentPeriod->viewAttributes() ?>><?php echo $payroll_period_list->CurrentPeriod->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payroll_period_list->ListOptions->render("body", "right", $payroll_period_list->RowCount);
?>
	</tr>
<?php if ($payroll_period->RowType == ROWTYPE_ADD || $payroll_period->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpayroll_periodlist", "load"], function() {
	fpayroll_periodlist.updateLists(<?php echo $payroll_period_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	if (!$payroll_period_list->isGridAdd())
		$payroll_period_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($payroll_period_list->isAdd() || $payroll_period_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $payroll_period_list->FormKeyCountName ?>" id="<?php echo $payroll_period_list->FormKeyCountName ?>" value="<?php echo $payroll_period_list->KeyCount ?>">
<?php } ?>
<?php if ($payroll_period_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $payroll_period_list->FormKeyCountName ?>" id="<?php echo $payroll_period_list->FormKeyCountName ?>" value="<?php echo $payroll_period_list->KeyCount ?>">
<?php } ?>
<?php if (!$payroll_period->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payroll_period_list->Recordset)
	$payroll_period_list->Recordset->Close();
?>
<?php if (!$payroll_period_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$payroll_period_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_period_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_period_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payroll_period_list->TotalRecords == 0 && !$payroll_period->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payroll_period_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$payroll_period_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payroll_period_list->isExport()) { ?>
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
$payroll_period_list->terminate();
?>