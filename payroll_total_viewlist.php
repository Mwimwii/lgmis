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
$payroll_total_view_list = new payroll_total_view_list();

// Run the page
$payroll_total_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_total_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payroll_total_view_list->isExport()) { ?>
<script>
var fpayroll_total_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpayroll_total_viewlist = currentForm = new ew.Form("fpayroll_total_viewlist", "list");
	fpayroll_total_viewlist.formKeyCountName = '<?php echo $payroll_total_view_list->FormKeyCountName ?>';
	loadjs.done("fpayroll_total_viewlist");
});
var fpayroll_total_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpayroll_total_viewlistsrch = currentSearchForm = new ew.Form("fpayroll_total_viewlistsrch");

	// Validate function for search
	fpayroll_total_viewlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_PayrollPeriod");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payroll_total_view_list->PayrollPeriod->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpayroll_total_viewlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayroll_total_viewlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	// Filters

	fpayroll_total_viewlistsrch.filterList = <?php echo $payroll_total_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpayroll_total_viewlistsrch.initSearchPanel = true;
	loadjs.done("fpayroll_total_viewlistsrch");
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
<?php if (!$payroll_total_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($payroll_total_view_list->TotalRecords > 0 && $payroll_total_view_list->ExportOptions->visible()) { ?>
<?php $payroll_total_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_total_view_list->ImportOptions->visible()) { ?>
<?php $payroll_total_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_total_view_list->SearchOptions->visible()) { ?>
<?php $payroll_total_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_total_view_list->FilterOptions->visible()) { ?>
<?php $payroll_total_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$payroll_total_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$payroll_total_view_list->isExport() && !$payroll_total_view->CurrentAction) { ?>
<form name="fpayroll_total_viewlistsrch" id="fpayroll_total_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpayroll_total_viewlistsrch-search-panel" class="<?php echo $payroll_total_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="payroll_total_view">
	<div class="ew-extended-search">
<?php

// Render search row
$payroll_total_view->RowType = ROWTYPE_SEARCH;
$payroll_total_view->resetAttributes();
$payroll_total_view_list->renderRow();
?>
<?php if ($payroll_total_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php
		$payroll_total_view_list->SearchColumnCount++;
		if (($payroll_total_view_list->SearchColumnCount - 1) % $payroll_total_view_list->SearchFieldsPerRow == 0) {
			$payroll_total_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_total_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PayrollPeriod" class="ew-cell form-group">
		<label for="x_PayrollPeriod" class="ew-search-caption ew-label"><?php echo $payroll_total_view_list->PayrollPeriod->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollPeriod" id="z_PayrollPeriod" value="=">
</span>
		<span id="el_payroll_total_view_PayrollPeriod" class="ew-search-field">
<input type="text" data-table="payroll_total_view" data-field="x_PayrollPeriod" name="x_PayrollPeriod" id="x_PayrollPeriod" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($payroll_total_view_list->PayrollPeriod->getPlaceHolder()) ?>" value="<?php echo $payroll_total_view_list->PayrollPeriod->EditValue ?>"<?php echo $payroll_total_view_list->PayrollPeriod->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_total_view_list->SearchColumnCount % $payroll_total_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payroll_total_view_list->Item->Visible) { // Item ?>
	<?php
		$payroll_total_view_list->SearchColumnCount++;
		if (($payroll_total_view_list->SearchColumnCount - 1) % $payroll_total_view_list->SearchFieldsPerRow == 0) {
			$payroll_total_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_total_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Item" class="ew-cell form-group">
		<label for="x_Item" class="ew-search-caption ew-label"><?php echo $payroll_total_view_list->Item->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Item" id="z_Item" value="LIKE">
</span>
		<span id="el_payroll_total_view_Item" class="ew-search-field">
<input type="text" data-table="payroll_total_view" data-field="x_Item" name="x_Item" id="x_Item" size="30" maxlength="9" placeholder="<?php echo HtmlEncode($payroll_total_view_list->Item->getPlaceHolder()) ?>" value="<?php echo $payroll_total_view_list->Item->EditValue ?>"<?php echo $payroll_total_view_list->Item->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_total_view_list->SearchColumnCount % $payroll_total_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($payroll_total_view_list->SearchColumnCount % $payroll_total_view_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $payroll_total_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($payroll_total_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($payroll_total_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $payroll_total_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($payroll_total_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($payroll_total_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($payroll_total_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($payroll_total_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $payroll_total_view_list->showPageHeader(); ?>
<?php
$payroll_total_view_list->showMessage();
?>
<?php if ($payroll_total_view_list->TotalRecords > 0 || $payroll_total_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payroll_total_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payroll_total_view">
<?php if (!$payroll_total_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$payroll_total_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_total_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_total_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpayroll_total_viewlist" id="fpayroll_total_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_total_view">
<div id="gmp_payroll_total_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($payroll_total_view_list->TotalRecords > 0 || $payroll_total_view_list->isGridEdit()) { ?>
<table id="tbl_payroll_total_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payroll_total_view->RowType = ROWTYPE_HEADER;

// Render list options
$payroll_total_view_list->renderListOptions();

// Render list options (header, left)
$payroll_total_view_list->ListOptions->render("header", "left");
?>
<?php if ($payroll_total_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php if ($payroll_total_view_list->SortUrl($payroll_total_view_list->LocalAuthority) == "") { ?>
		<th data-name="LocalAuthority" class="<?php echo $payroll_total_view_list->LocalAuthority->headerCellClass() ?>"><div id="elh_payroll_total_view_LocalAuthority" class="payroll_total_view_LocalAuthority"><div class="ew-table-header-caption"><?php echo $payroll_total_view_list->LocalAuthority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LocalAuthority" class="<?php echo $payroll_total_view_list->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_total_view_list->SortUrl($payroll_total_view_list->LocalAuthority) ?>', 1);"><div id="elh_payroll_total_view_LocalAuthority" class="payroll_total_view_LocalAuthority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_total_view_list->LocalAuthority->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_total_view_list->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_total_view_list->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_total_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($payroll_total_view_list->SortUrl($payroll_total_view_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $payroll_total_view_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_payroll_total_view_PayrollPeriod" class="payroll_total_view_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $payroll_total_view_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $payroll_total_view_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_total_view_list->SortUrl($payroll_total_view_list->PayrollPeriod) ?>', 1);"><div id="elh_payroll_total_view_PayrollPeriod" class="payroll_total_view_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_total_view_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_total_view_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_total_view_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_total_view_list->PayPeriod->Visible) { // PayPeriod ?>
	<?php if ($payroll_total_view_list->SortUrl($payroll_total_view_list->PayPeriod) == "") { ?>
		<th data-name="PayPeriod" class="<?php echo $payroll_total_view_list->PayPeriod->headerCellClass() ?>"><div id="elh_payroll_total_view_PayPeriod" class="payroll_total_view_PayPeriod"><div class="ew-table-header-caption"><?php echo $payroll_total_view_list->PayPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayPeriod" class="<?php echo $payroll_total_view_list->PayPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_total_view_list->SortUrl($payroll_total_view_list->PayPeriod) ?>', 1);"><div id="elh_payroll_total_view_PayPeriod" class="payroll_total_view_PayPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_total_view_list->PayPeriod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_total_view_list->PayPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_total_view_list->PayPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_total_view_list->Income->Visible) { // Income ?>
	<?php if ($payroll_total_view_list->SortUrl($payroll_total_view_list->Income) == "") { ?>
		<th data-name="Income" class="<?php echo $payroll_total_view_list->Income->headerCellClass() ?>"><div id="elh_payroll_total_view_Income" class="payroll_total_view_Income"><div class="ew-table-header-caption"><?php echo $payroll_total_view_list->Income->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Income" class="<?php echo $payroll_total_view_list->Income->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_total_view_list->SortUrl($payroll_total_view_list->Income) ?>', 1);"><div id="elh_payroll_total_view_Income" class="payroll_total_view_Income">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_total_view_list->Income->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_total_view_list->Income->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_total_view_list->Income->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_total_view_list->Item->Visible) { // Item ?>
	<?php if ($payroll_total_view_list->SortUrl($payroll_total_view_list->Item) == "") { ?>
		<th data-name="Item" class="<?php echo $payroll_total_view_list->Item->headerCellClass() ?>"><div id="elh_payroll_total_view_Item" class="payroll_total_view_Item"><div class="ew-table-header-caption"><?php echo $payroll_total_view_list->Item->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Item" class="<?php echo $payroll_total_view_list->Item->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_total_view_list->SortUrl($payroll_total_view_list->Item) ?>', 1);"><div id="elh_payroll_total_view_Item" class="payroll_total_view_Item">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_total_view_list->Item->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_total_view_list->Item->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_total_view_list->Item->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payroll_total_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($payroll_total_view_list->ExportAll && $payroll_total_view_list->isExport()) {
	$payroll_total_view_list->StopRecord = $payroll_total_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($payroll_total_view_list->TotalRecords > $payroll_total_view_list->StartRecord + $payroll_total_view_list->DisplayRecords - 1)
		$payroll_total_view_list->StopRecord = $payroll_total_view_list->StartRecord + $payroll_total_view_list->DisplayRecords - 1;
	else
		$payroll_total_view_list->StopRecord = $payroll_total_view_list->TotalRecords;
}
$payroll_total_view_list->RecordCount = $payroll_total_view_list->StartRecord - 1;
if ($payroll_total_view_list->Recordset && !$payroll_total_view_list->Recordset->EOF) {
	$payroll_total_view_list->Recordset->moveFirst();
	$selectLimit = $payroll_total_view_list->UseSelectLimit;
	if (!$selectLimit && $payroll_total_view_list->StartRecord > 1)
		$payroll_total_view_list->Recordset->move($payroll_total_view_list->StartRecord - 1);
} elseif (!$payroll_total_view->AllowAddDeleteRow && $payroll_total_view_list->StopRecord == 0) {
	$payroll_total_view_list->StopRecord = $payroll_total_view->GridAddRowCount;
}

// Initialize aggregate
$payroll_total_view->RowType = ROWTYPE_AGGREGATEINIT;
$payroll_total_view->resetAttributes();
$payroll_total_view_list->renderRow();
while ($payroll_total_view_list->RecordCount < $payroll_total_view_list->StopRecord) {
	$payroll_total_view_list->RecordCount++;
	if ($payroll_total_view_list->RecordCount >= $payroll_total_view_list->StartRecord) {
		$payroll_total_view_list->RowCount++;

		// Set up key count
		$payroll_total_view_list->KeyCount = $payroll_total_view_list->RowIndex;

		// Init row class and style
		$payroll_total_view->resetAttributes();
		$payroll_total_view->CssClass = "";
		if ($payroll_total_view_list->isGridAdd()) {
		} else {
			$payroll_total_view_list->loadRowValues($payroll_total_view_list->Recordset); // Load row values
		}
		$payroll_total_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$payroll_total_view->RowAttrs->merge(["data-rowindex" => $payroll_total_view_list->RowCount, "id" => "r" . $payroll_total_view_list->RowCount . "_payroll_total_view", "data-rowtype" => $payroll_total_view->RowType]);

		// Render row
		$payroll_total_view_list->renderRow();

		// Render list options
		$payroll_total_view_list->renderListOptions();
?>
	<tr <?php echo $payroll_total_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payroll_total_view_list->ListOptions->render("body", "left", $payroll_total_view_list->RowCount);
?>
	<?php if ($payroll_total_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
		<td data-name="LocalAuthority" <?php echo $payroll_total_view_list->LocalAuthority->cellAttributes() ?>>
<span id="el<?php echo $payroll_total_view_list->RowCount ?>_payroll_total_view_LocalAuthority">
<span<?php echo $payroll_total_view_list->LocalAuthority->viewAttributes() ?>><?php echo $payroll_total_view_list->LocalAuthority->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_total_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $payroll_total_view_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $payroll_total_view_list->RowCount ?>_payroll_total_view_PayrollPeriod">
<span<?php echo $payroll_total_view_list->PayrollPeriod->viewAttributes() ?>><?php echo $payroll_total_view_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_total_view_list->PayPeriod->Visible) { // PayPeriod ?>
		<td data-name="PayPeriod" <?php echo $payroll_total_view_list->PayPeriod->cellAttributes() ?>>
<span id="el<?php echo $payroll_total_view_list->RowCount ?>_payroll_total_view_PayPeriod">
<span<?php echo $payroll_total_view_list->PayPeriod->viewAttributes() ?>><?php echo $payroll_total_view_list->PayPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_total_view_list->Income->Visible) { // Income ?>
		<td data-name="Income" <?php echo $payroll_total_view_list->Income->cellAttributes() ?>>
<span id="el<?php echo $payroll_total_view_list->RowCount ?>_payroll_total_view_Income">
<span<?php echo $payroll_total_view_list->Income->viewAttributes() ?>><?php echo $payroll_total_view_list->Income->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_total_view_list->Item->Visible) { // Item ?>
		<td data-name="Item" <?php echo $payroll_total_view_list->Item->cellAttributes() ?>>
<span id="el<?php echo $payroll_total_view_list->RowCount ?>_payroll_total_view_Item">
<span<?php echo $payroll_total_view_list->Item->viewAttributes() ?>><?php echo $payroll_total_view_list->Item->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payroll_total_view_list->ListOptions->render("body", "right", $payroll_total_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$payroll_total_view_list->isGridAdd())
		$payroll_total_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$payroll_total_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payroll_total_view_list->Recordset)
	$payroll_total_view_list->Recordset->Close();
?>
<?php if (!$payroll_total_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$payroll_total_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_total_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_total_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payroll_total_view_list->TotalRecords == 0 && !$payroll_total_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payroll_total_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$payroll_total_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payroll_total_view_list->isExport()) { ?>
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
$payroll_total_view_list->terminate();
?>