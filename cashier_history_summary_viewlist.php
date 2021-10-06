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
$cashier_history_summary_view_list = new cashier_history_summary_view_list();

// Run the page
$cashier_history_summary_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cashier_history_summary_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cashier_history_summary_view_list->isExport()) { ?>
<script>
var fcashier_history_summary_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcashier_history_summary_viewlist = currentForm = new ew.Form("fcashier_history_summary_viewlist", "list");
	fcashier_history_summary_viewlist.formKeyCountName = '<?php echo $cashier_history_summary_view_list->FormKeyCountName ?>';
	loadjs.done("fcashier_history_summary_viewlist");
});
var fcashier_history_summary_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcashier_history_summary_viewlistsrch = currentSearchForm = new ew.Form("fcashier_history_summary_viewlistsrch");

	// Validate function for search
	fcashier_history_summary_viewlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ReceiptDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($cashier_history_summary_view_list->ReceiptDate->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcashier_history_summary_viewlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcashier_history_summary_viewlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcashier_history_summary_viewlistsrch.lists["x_ChargeDesc[]"] = <?php echo $cashier_history_summary_view_list->ChargeDesc->Lookup->toClientList($cashier_history_summary_view_list) ?>;
	fcashier_history_summary_viewlistsrch.lists["x_ChargeDesc[]"].options = <?php echo JsonEncode($cashier_history_summary_view_list->ChargeDesc->lookupOptions()) ?>;

	// Filters
	fcashier_history_summary_viewlistsrch.filterList = <?php echo $cashier_history_summary_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcashier_history_summary_viewlistsrch.initSearchPanel = true;
	loadjs.done("fcashier_history_summary_viewlistsrch");
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
<?php if (!$cashier_history_summary_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cashier_history_summary_view_list->TotalRecords > 0 && $cashier_history_summary_view_list->ExportOptions->visible()) { ?>
<?php $cashier_history_summary_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cashier_history_summary_view_list->ImportOptions->visible()) { ?>
<?php $cashier_history_summary_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cashier_history_summary_view_list->SearchOptions->visible()) { ?>
<?php $cashier_history_summary_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cashier_history_summary_view_list->FilterOptions->visible()) { ?>
<?php $cashier_history_summary_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cashier_history_summary_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cashier_history_summary_view_list->isExport() && !$cashier_history_summary_view->CurrentAction) { ?>
<form name="fcashier_history_summary_viewlistsrch" id="fcashier_history_summary_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcashier_history_summary_viewlistsrch-search-panel" class="<?php echo $cashier_history_summary_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cashier_history_summary_view">
	<div class="ew-extended-search">
<?php

// Render search row
$cashier_history_summary_view->RowType = ROWTYPE_SEARCH;
$cashier_history_summary_view->resetAttributes();
$cashier_history_summary_view_list->renderRow();
?>
<?php if ($cashier_history_summary_view_list->ChargeDesc->Visible) { // ChargeDesc ?>
	<?php
		$cashier_history_summary_view_list->SearchColumnCount++;
		if (($cashier_history_summary_view_list->SearchColumnCount - 1) % $cashier_history_summary_view_list->SearchFieldsPerRow == 0) {
			$cashier_history_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cashier_history_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ChargeDesc" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $cashier_history_summary_view_list->ChargeDesc->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeDesc" id="z_ChargeDesc" value="LIKE">
</span>
		<span id="el_cashier_history_summary_view_ChargeDesc" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ChargeDesc"><?php echo EmptyValue(strval($cashier_history_summary_view_list->ChargeDesc->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $cashier_history_summary_view_list->ChargeDesc->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($cashier_history_summary_view_list->ChargeDesc->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($cashier_history_summary_view_list->ChargeDesc->ReadOnly || $cashier_history_summary_view_list->ChargeDesc->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ChargeDesc[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $cashier_history_summary_view_list->ChargeDesc->Lookup->getParamTag($cashier_history_summary_view_list, "p_x_ChargeDesc") ?>
<input type="hidden" data-table="cashier_history_summary_view" data-field="x_ChargeDesc" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $cashier_history_summary_view_list->ChargeDesc->displayValueSeparatorAttribute() ?>" name="x_ChargeDesc[]" id="x_ChargeDesc[]" value="<?php echo $cashier_history_summary_view_list->ChargeDesc->AdvancedSearch->SearchValue ?>"<?php echo $cashier_history_summary_view_list->ChargeDesc->editAttributes() ?>>
</span>
	</div>
	<?php if ($cashier_history_summary_view_list->SearchColumnCount % $cashier_history_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($cashier_history_summary_view_list->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php
		$cashier_history_summary_view_list->SearchColumnCount++;
		if (($cashier_history_summary_view_list->SearchColumnCount - 1) % $cashier_history_summary_view_list->SearchFieldsPerRow == 0) {
			$cashier_history_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cashier_history_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ReceiptDate" class="ew-cell form-group">
		<label for="x_ReceiptDate" class="ew-search-caption ew-label"><?php echo $cashier_history_summary_view_list->ReceiptDate->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReceiptDate" id="z_ReceiptDate" value="=">
</span>
		<span id="el_cashier_history_summary_view_ReceiptDate" class="ew-search-field">
<input type="text" data-table="cashier_history_summary_view" data-field="x_ReceiptDate" name="x_ReceiptDate" id="x_ReceiptDate" maxlength="19" placeholder="<?php echo HtmlEncode($cashier_history_summary_view_list->ReceiptDate->getPlaceHolder()) ?>" value="<?php echo $cashier_history_summary_view_list->ReceiptDate->EditValue ?>"<?php echo $cashier_history_summary_view_list->ReceiptDate->editAttributes() ?>>
<?php if (!$cashier_history_summary_view_list->ReceiptDate->ReadOnly && !$cashier_history_summary_view_list->ReceiptDate->Disabled && !isset($cashier_history_summary_view_list->ReceiptDate->EditAttrs["readonly"]) && !isset($cashier_history_summary_view_list->ReceiptDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcashier_history_summary_viewlistsrch", "datetimepicker"], function() {
	ew.createDateTimePicker("fcashier_history_summary_viewlistsrch", "x_ReceiptDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
	</div>
	<?php if ($cashier_history_summary_view_list->SearchColumnCount % $cashier_history_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($cashier_history_summary_view_list->CashierNo->Visible) { // CashierNo ?>
	<?php
		$cashier_history_summary_view_list->SearchColumnCount++;
		if (($cashier_history_summary_view_list->SearchColumnCount - 1) % $cashier_history_summary_view_list->SearchFieldsPerRow == 0) {
			$cashier_history_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $cashier_history_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_CashierNo" class="ew-cell form-group">
		<label for="x_CashierNo" class="ew-search-caption ew-label"><?php echo $cashier_history_summary_view_list->CashierNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_CashierNo" id="z_CashierNo" value="LIKE">
</span>
		<span id="el_cashier_history_summary_view_CashierNo" class="ew-search-field">
<input type="text" data-table="cashier_history_summary_view" data-field="x_CashierNo" name="x_CashierNo" id="x_CashierNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($cashier_history_summary_view_list->CashierNo->getPlaceHolder()) ?>" value="<?php echo $cashier_history_summary_view_list->CashierNo->EditValue ?>"<?php echo $cashier_history_summary_view_list->CashierNo->editAttributes() ?>>
</span>
	</div>
	<?php if ($cashier_history_summary_view_list->SearchColumnCount % $cashier_history_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($cashier_history_summary_view_list->SearchColumnCount % $cashier_history_summary_view_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $cashier_history_summary_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($cashier_history_summary_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($cashier_history_summary_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cashier_history_summary_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cashier_history_summary_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cashier_history_summary_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cashier_history_summary_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cashier_history_summary_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $cashier_history_summary_view_list->showPageHeader(); ?>
<?php
$cashier_history_summary_view_list->showMessage();
?>
<?php if ($cashier_history_summary_view_list->TotalRecords > 0 || $cashier_history_summary_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cashier_history_summary_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cashier_history_summary_view">
<?php if (!$cashier_history_summary_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cashier_history_summary_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cashier_history_summary_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cashier_history_summary_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcashier_history_summary_viewlist" id="fcashier_history_summary_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cashier_history_summary_view">
<div id="gmp_cashier_history_summary_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cashier_history_summary_view_list->TotalRecords > 0 || $cashier_history_summary_view_list->isGridEdit()) { ?>
<table id="tbl_cashier_history_summary_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cashier_history_summary_view->RowType = ROWTYPE_HEADER;

// Render list options
$cashier_history_summary_view_list->renderListOptions();

// Render list options (header, left)
$cashier_history_summary_view_list->ListOptions->render("header", "left");
?>
<?php if ($cashier_history_summary_view_list->ReceiptedTotalAmount->Visible) { // ReceiptedTotalAmount ?>
	<?php if ($cashier_history_summary_view_list->SortUrl($cashier_history_summary_view_list->ReceiptedTotalAmount) == "") { ?>
		<th data-name="ReceiptedTotalAmount" class="<?php echo $cashier_history_summary_view_list->ReceiptedTotalAmount->headerCellClass() ?>"><div id="elh_cashier_history_summary_view_ReceiptedTotalAmount" class="cashier_history_summary_view_ReceiptedTotalAmount"><div class="ew-table-header-caption"><?php echo $cashier_history_summary_view_list->ReceiptedTotalAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptedTotalAmount" class="<?php echo $cashier_history_summary_view_list->ReceiptedTotalAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cashier_history_summary_view_list->SortUrl($cashier_history_summary_view_list->ReceiptedTotalAmount) ?>', 1);"><div id="elh_cashier_history_summary_view_ReceiptedTotalAmount" class="cashier_history_summary_view_ReceiptedTotalAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cashier_history_summary_view_list->ReceiptedTotalAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($cashier_history_summary_view_list->ReceiptedTotalAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cashier_history_summary_view_list->ReceiptedTotalAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cashier_history_summary_view_list->NoOfReceipts->Visible) { // NoOfReceipts ?>
	<?php if ($cashier_history_summary_view_list->SortUrl($cashier_history_summary_view_list->NoOfReceipts) == "") { ?>
		<th data-name="NoOfReceipts" class="<?php echo $cashier_history_summary_view_list->NoOfReceipts->headerCellClass() ?>"><div id="elh_cashier_history_summary_view_NoOfReceipts" class="cashier_history_summary_view_NoOfReceipts"><div class="ew-table-header-caption"><?php echo $cashier_history_summary_view_list->NoOfReceipts->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NoOfReceipts" class="<?php echo $cashier_history_summary_view_list->NoOfReceipts->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cashier_history_summary_view_list->SortUrl($cashier_history_summary_view_list->NoOfReceipts) ?>', 1);"><div id="elh_cashier_history_summary_view_NoOfReceipts" class="cashier_history_summary_view_NoOfReceipts">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cashier_history_summary_view_list->NoOfReceipts->caption() ?></span><span class="ew-table-header-sort"><?php if ($cashier_history_summary_view_list->NoOfReceipts->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cashier_history_summary_view_list->NoOfReceipts->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cashier_history_summary_view_list->ChargeDesc->Visible) { // ChargeDesc ?>
	<?php if ($cashier_history_summary_view_list->SortUrl($cashier_history_summary_view_list->ChargeDesc) == "") { ?>
		<th data-name="ChargeDesc" class="<?php echo $cashier_history_summary_view_list->ChargeDesc->headerCellClass() ?>"><div id="elh_cashier_history_summary_view_ChargeDesc" class="cashier_history_summary_view_ChargeDesc"><div class="ew-table-header-caption"><?php echo $cashier_history_summary_view_list->ChargeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeDesc" class="<?php echo $cashier_history_summary_view_list->ChargeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cashier_history_summary_view_list->SortUrl($cashier_history_summary_view_list->ChargeDesc) ?>', 1);"><div id="elh_cashier_history_summary_view_ChargeDesc" class="cashier_history_summary_view_ChargeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cashier_history_summary_view_list->ChargeDesc->caption() ?></span><span class="ew-table-header-sort"><?php if ($cashier_history_summary_view_list->ChargeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cashier_history_summary_view_list->ChargeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cashier_history_summary_view_list->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php if ($cashier_history_summary_view_list->SortUrl($cashier_history_summary_view_list->ReceiptDate) == "") { ?>
		<th data-name="ReceiptDate" class="<?php echo $cashier_history_summary_view_list->ReceiptDate->headerCellClass() ?>"><div id="elh_cashier_history_summary_view_ReceiptDate" class="cashier_history_summary_view_ReceiptDate"><div class="ew-table-header-caption"><?php echo $cashier_history_summary_view_list->ReceiptDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptDate" class="<?php echo $cashier_history_summary_view_list->ReceiptDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cashier_history_summary_view_list->SortUrl($cashier_history_summary_view_list->ReceiptDate) ?>', 1);"><div id="elh_cashier_history_summary_view_ReceiptDate" class="cashier_history_summary_view_ReceiptDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cashier_history_summary_view_list->ReceiptDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($cashier_history_summary_view_list->ReceiptDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cashier_history_summary_view_list->ReceiptDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cashier_history_summary_view_list->CashierNo->Visible) { // CashierNo ?>
	<?php if ($cashier_history_summary_view_list->SortUrl($cashier_history_summary_view_list->CashierNo) == "") { ?>
		<th data-name="CashierNo" class="<?php echo $cashier_history_summary_view_list->CashierNo->headerCellClass() ?>"><div id="elh_cashier_history_summary_view_CashierNo" class="cashier_history_summary_view_CashierNo"><div class="ew-table-header-caption"><?php echo $cashier_history_summary_view_list->CashierNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CashierNo" class="<?php echo $cashier_history_summary_view_list->CashierNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cashier_history_summary_view_list->SortUrl($cashier_history_summary_view_list->CashierNo) ?>', 1);"><div id="elh_cashier_history_summary_view_CashierNo" class="cashier_history_summary_view_CashierNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cashier_history_summary_view_list->CashierNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cashier_history_summary_view_list->CashierNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cashier_history_summary_view_list->CashierNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cashier_history_summary_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cashier_history_summary_view_list->ExportAll && $cashier_history_summary_view_list->isExport()) {
	$cashier_history_summary_view_list->StopRecord = $cashier_history_summary_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cashier_history_summary_view_list->TotalRecords > $cashier_history_summary_view_list->StartRecord + $cashier_history_summary_view_list->DisplayRecords - 1)
		$cashier_history_summary_view_list->StopRecord = $cashier_history_summary_view_list->StartRecord + $cashier_history_summary_view_list->DisplayRecords - 1;
	else
		$cashier_history_summary_view_list->StopRecord = $cashier_history_summary_view_list->TotalRecords;
}
$cashier_history_summary_view_list->RecordCount = $cashier_history_summary_view_list->StartRecord - 1;
if ($cashier_history_summary_view_list->Recordset && !$cashier_history_summary_view_list->Recordset->EOF) {
	$cashier_history_summary_view_list->Recordset->moveFirst();
	$selectLimit = $cashier_history_summary_view_list->UseSelectLimit;
	if (!$selectLimit && $cashier_history_summary_view_list->StartRecord > 1)
		$cashier_history_summary_view_list->Recordset->move($cashier_history_summary_view_list->StartRecord - 1);
} elseif (!$cashier_history_summary_view->AllowAddDeleteRow && $cashier_history_summary_view_list->StopRecord == 0) {
	$cashier_history_summary_view_list->StopRecord = $cashier_history_summary_view->GridAddRowCount;
}

// Initialize aggregate
$cashier_history_summary_view->RowType = ROWTYPE_AGGREGATEINIT;
$cashier_history_summary_view->resetAttributes();
$cashier_history_summary_view_list->renderRow();
while ($cashier_history_summary_view_list->RecordCount < $cashier_history_summary_view_list->StopRecord) {
	$cashier_history_summary_view_list->RecordCount++;
	if ($cashier_history_summary_view_list->RecordCount >= $cashier_history_summary_view_list->StartRecord) {
		$cashier_history_summary_view_list->RowCount++;

		// Set up key count
		$cashier_history_summary_view_list->KeyCount = $cashier_history_summary_view_list->RowIndex;

		// Init row class and style
		$cashier_history_summary_view->resetAttributes();
		$cashier_history_summary_view->CssClass = "";
		if ($cashier_history_summary_view_list->isGridAdd()) {
		} else {
			$cashier_history_summary_view_list->loadRowValues($cashier_history_summary_view_list->Recordset); // Load row values
		}
		$cashier_history_summary_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cashier_history_summary_view->RowAttrs->merge(["data-rowindex" => $cashier_history_summary_view_list->RowCount, "id" => "r" . $cashier_history_summary_view_list->RowCount . "_cashier_history_summary_view", "data-rowtype" => $cashier_history_summary_view->RowType]);

		// Render row
		$cashier_history_summary_view_list->renderRow();

		// Render list options
		$cashier_history_summary_view_list->renderListOptions();
?>
	<tr <?php echo $cashier_history_summary_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cashier_history_summary_view_list->ListOptions->render("body", "left", $cashier_history_summary_view_list->RowCount);
?>
	<?php if ($cashier_history_summary_view_list->ReceiptedTotalAmount->Visible) { // ReceiptedTotalAmount ?>
		<td data-name="ReceiptedTotalAmount" <?php echo $cashier_history_summary_view_list->ReceiptedTotalAmount->cellAttributes() ?>>
<span id="el<?php echo $cashier_history_summary_view_list->RowCount ?>_cashier_history_summary_view_ReceiptedTotalAmount">
<span<?php echo $cashier_history_summary_view_list->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $cashier_history_summary_view_list->ReceiptedTotalAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cashier_history_summary_view_list->NoOfReceipts->Visible) { // NoOfReceipts ?>
		<td data-name="NoOfReceipts" <?php echo $cashier_history_summary_view_list->NoOfReceipts->cellAttributes() ?>>
<span id="el<?php echo $cashier_history_summary_view_list->RowCount ?>_cashier_history_summary_view_NoOfReceipts">
<span<?php echo $cashier_history_summary_view_list->NoOfReceipts->viewAttributes() ?>><?php echo $cashier_history_summary_view_list->NoOfReceipts->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cashier_history_summary_view_list->ChargeDesc->Visible) { // ChargeDesc ?>
		<td data-name="ChargeDesc" <?php echo $cashier_history_summary_view_list->ChargeDesc->cellAttributes() ?>>
<span id="el<?php echo $cashier_history_summary_view_list->RowCount ?>_cashier_history_summary_view_ChargeDesc">
<span<?php echo $cashier_history_summary_view_list->ChargeDesc->viewAttributes() ?>><?php echo $cashier_history_summary_view_list->ChargeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cashier_history_summary_view_list->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" <?php echo $cashier_history_summary_view_list->ReceiptDate->cellAttributes() ?>>
<span id="el<?php echo $cashier_history_summary_view_list->RowCount ?>_cashier_history_summary_view_ReceiptDate">
<span<?php echo $cashier_history_summary_view_list->ReceiptDate->viewAttributes() ?>><?php echo $cashier_history_summary_view_list->ReceiptDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cashier_history_summary_view_list->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo" <?php echo $cashier_history_summary_view_list->CashierNo->cellAttributes() ?>>
<span id="el<?php echo $cashier_history_summary_view_list->RowCount ?>_cashier_history_summary_view_CashierNo">
<span<?php echo $cashier_history_summary_view_list->CashierNo->viewAttributes() ?>><?php echo $cashier_history_summary_view_list->CashierNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cashier_history_summary_view_list->ListOptions->render("body", "right", $cashier_history_summary_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cashier_history_summary_view_list->isGridAdd())
		$cashier_history_summary_view_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$cashier_history_summary_view->RowType = ROWTYPE_AGGREGATE;
$cashier_history_summary_view->resetAttributes();
$cashier_history_summary_view_list->renderRow();
?>
<?php if ($cashier_history_summary_view_list->TotalRecords > 0 && !$cashier_history_summary_view_list->isGridAdd() && !$cashier_history_summary_view_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$cashier_history_summary_view_list->renderListOptions();

// Render list options (footer, left)
$cashier_history_summary_view_list->ListOptions->render("footer", "left");
?>
	<?php if ($cashier_history_summary_view_list->ReceiptedTotalAmount->Visible) { // ReceiptedTotalAmount ?>
		<td data-name="ReceiptedTotalAmount" class="<?php echo $cashier_history_summary_view_list->ReceiptedTotalAmount->footerCellClass() ?>"><span id="elf_cashier_history_summary_view_ReceiptedTotalAmount" class="cashier_history_summary_view_ReceiptedTotalAmount">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $cashier_history_summary_view_list->ReceiptedTotalAmount->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($cashier_history_summary_view_list->NoOfReceipts->Visible) { // NoOfReceipts ?>
		<td data-name="NoOfReceipts" class="<?php echo $cashier_history_summary_view_list->NoOfReceipts->footerCellClass() ?>"><span id="elf_cashier_history_summary_view_NoOfReceipts" class="cashier_history_summary_view_NoOfReceipts">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($cashier_history_summary_view_list->ChargeDesc->Visible) { // ChargeDesc ?>
		<td data-name="ChargeDesc" class="<?php echo $cashier_history_summary_view_list->ChargeDesc->footerCellClass() ?>"><span id="elf_cashier_history_summary_view_ChargeDesc" class="cashier_history_summary_view_ChargeDesc">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($cashier_history_summary_view_list->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" class="<?php echo $cashier_history_summary_view_list->ReceiptDate->footerCellClass() ?>"><span id="elf_cashier_history_summary_view_ReceiptDate" class="cashier_history_summary_view_ReceiptDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($cashier_history_summary_view_list->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo" class="<?php echo $cashier_history_summary_view_list->CashierNo->footerCellClass() ?>"><span id="elf_cashier_history_summary_view_CashierNo" class="cashier_history_summary_view_CashierNo">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$cashier_history_summary_view_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cashier_history_summary_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cashier_history_summary_view_list->Recordset)
	$cashier_history_summary_view_list->Recordset->Close();
?>
<?php if (!$cashier_history_summary_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cashier_history_summary_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cashier_history_summary_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cashier_history_summary_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cashier_history_summary_view_list->TotalRecords == 0 && !$cashier_history_summary_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cashier_history_summary_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cashier_history_summary_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cashier_history_summary_view_list->isExport()) { ?>
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
$cashier_history_summary_view_list->terminate();
?>