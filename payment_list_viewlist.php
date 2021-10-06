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
$payment_list_view_list = new payment_list_view_list();

// Run the page
$payment_list_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payment_list_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payment_list_view_list->isExport()) { ?>
<script>
var fpayment_list_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpayment_list_viewlist = currentForm = new ew.Form("fpayment_list_viewlist", "list");
	fpayment_list_viewlist.formKeyCountName = '<?php echo $payment_list_view_list->FormKeyCountName ?>';
	loadjs.done("fpayment_list_viewlist");
});
var fpayment_list_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpayment_list_viewlistsrch = currentSearchForm = new ew.Form("fpayment_list_viewlistsrch");

	// Validate function for search
	fpayment_list_viewlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ChargeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_list->ChargeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillPeriod");
		if (elm && !ew.checkByRegEx(elm.value, /^[10]+$/))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_list->BillPeriod->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_BillYear");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payment_list_view_list->BillYear->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpayment_list_viewlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayment_list_viewlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	// Filters

	fpayment_list_viewlistsrch.filterList = <?php echo $payment_list_view_list->getFilterList() ?>;
	loadjs.done("fpayment_list_viewlistsrch");
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
<?php if (!$payment_list_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($payment_list_view_list->TotalRecords > 0 && $payment_list_view_list->ExportOptions->visible()) { ?>
<?php $payment_list_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($payment_list_view_list->ImportOptions->visible()) { ?>
<?php $payment_list_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($payment_list_view_list->SearchOptions->visible()) { ?>
<?php $payment_list_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($payment_list_view_list->FilterOptions->visible()) { ?>
<?php $payment_list_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$payment_list_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$payment_list_view_list->isExport() && !$payment_list_view->CurrentAction) { ?>
<form name="fpayment_list_viewlistsrch" id="fpayment_list_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpayment_list_viewlistsrch-search-panel" class="<?php echo $payment_list_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="payment_list_view">
	<div class="ew-extended-search">
<?php

// Render search row
$payment_list_view->RowType = ROWTYPE_SEARCH;
$payment_list_view->resetAttributes();
$payment_list_view_list->renderRow();
?>
<?php if ($payment_list_view_list->PropertyNo->Visible) { // PropertyNo ?>
	<?php
		$payment_list_view_list->SearchColumnCount++;
		if (($payment_list_view_list->SearchColumnCount - 1) % $payment_list_view_list->SearchFieldsPerRow == 0) {
			$payment_list_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payment_list_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PropertyNo" class="ew-cell form-group">
		<label for="x_PropertyNo" class="ew-search-caption ew-label"><?php echo $payment_list_view_list->PropertyNo->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyNo" id="z_PropertyNo" value="LIKE">
</span>
		<span id="el_payment_list_view_PropertyNo" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_PropertyNo" name="x_PropertyNo" id="x_PropertyNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payment_list_view_list->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_list->PropertyNo->EditValue ?>"<?php echo $payment_list_view_list->PropertyNo->editAttributes() ?>>
</span>
	</div>
	<?php if ($payment_list_view_list->SearchColumnCount % $payment_list_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->ClientName->Visible) { // ClientName ?>
	<?php
		$payment_list_view_list->SearchColumnCount++;
		if (($payment_list_view_list->SearchColumnCount - 1) % $payment_list_view_list->SearchFieldsPerRow == 0) {
			$payment_list_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payment_list_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ClientName" class="ew-cell form-group">
		<label for="x_ClientName" class="ew-search-caption ew-label"><?php echo $payment_list_view_list->ClientName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientName" id="z_ClientName" value="LIKE">
</span>
		<span id="el_payment_list_view_ClientName" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_ClientName" name="x_ClientName" id="x_ClientName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payment_list_view_list->ClientName->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_list->ClientName->EditValue ?>"<?php echo $payment_list_view_list->ClientName->editAttributes() ?>>
</span>
	</div>
	<?php if ($payment_list_view_list->SearchColumnCount % $payment_list_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php
		$payment_list_view_list->SearchColumnCount++;
		if (($payment_list_view_list->SearchColumnCount - 1) % $payment_list_view_list->SearchFieldsPerRow == 0) {
			$payment_list_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payment_list_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PropertyUse" class="ew-cell form-group">
		<label for="x_PropertyUse" class="ew-search-caption ew-label"><?php echo $payment_list_view_list->PropertyUse->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PropertyUse" id="z_PropertyUse" value="LIKE">
</span>
		<span id="el_payment_list_view_PropertyUse" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_PropertyUse" name="x_PropertyUse" id="x_PropertyUse" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($payment_list_view_list->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_list->PropertyUse->EditValue ?>"<?php echo $payment_list_view_list->PropertyUse->editAttributes() ?>>
</span>
	</div>
	<?php if ($payment_list_view_list->SearchColumnCount % $payment_list_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php
		$payment_list_view_list->SearchColumnCount++;
		if (($payment_list_view_list->SearchColumnCount - 1) % $payment_list_view_list->SearchFieldsPerRow == 0) {
			$payment_list_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payment_list_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ChargeCode" class="ew-cell form-group">
		<label for="x_ChargeCode" class="ew-search-caption ew-label"><?php echo $payment_list_view_list->ChargeCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChargeCode" id="z_ChargeCode" value="=">
</span>
		<span id="el_payment_list_view_ChargeCode" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_ChargeCode" name="x_ChargeCode" id="x_ChargeCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($payment_list_view_list->ChargeCode->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_list->ChargeCode->EditValue ?>"<?php echo $payment_list_view_list->ChargeCode->editAttributes() ?>>
</span>
	</div>
	<?php if ($payment_list_view_list->SearchColumnCount % $payment_list_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php
		$payment_list_view_list->SearchColumnCount++;
		if (($payment_list_view_list->SearchColumnCount - 1) % $payment_list_view_list->SearchFieldsPerRow == 0) {
			$payment_list_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payment_list_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_BillPeriod" class="ew-cell form-group">
		<label for="x_BillPeriod" class="ew-search-caption ew-label"><?php echo $payment_list_view_list->BillPeriod->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillPeriod" id="z_BillPeriod" value="=">
</span>
		<span id="el_payment_list_view_BillPeriod" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" maxlength="1" placeholder="<?php echo HtmlEncode($payment_list_view_list->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_list->BillPeriod->EditValue ?>"<?php echo $payment_list_view_list->BillPeriod->editAttributes() ?>>
</span>
	</div>
	<?php if ($payment_list_view_list->SearchColumnCount % $payment_list_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->BillYear->Visible) { // BillYear ?>
	<?php
		$payment_list_view_list->SearchColumnCount++;
		if (($payment_list_view_list->SearchColumnCount - 1) % $payment_list_view_list->SearchFieldsPerRow == 0) {
			$payment_list_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payment_list_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_BillYear" class="ew-cell form-group">
		<label for="x_BillYear" class="ew-search-caption ew-label"><?php echo $payment_list_view_list->BillYear->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_BillYear" id="z_BillYear" value="=">
</span>
		<span id="el_payment_list_view_BillYear" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($payment_list_view_list->BillYear->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_list->BillYear->EditValue ?>"<?php echo $payment_list_view_list->BillYear->editAttributes() ?>>
</span>
	</div>
	<?php if ($payment_list_view_list->SearchColumnCount % $payment_list_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->ChargeDesc->Visible) { // ChargeDesc ?>
	<?php
		$payment_list_view_list->SearchColumnCount++;
		if (($payment_list_view_list->SearchColumnCount - 1) % $payment_list_view_list->SearchFieldsPerRow == 0) {
			$payment_list_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payment_list_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ChargeDesc" class="ew-cell form-group">
		<label for="x_ChargeDesc" class="ew-search-caption ew-label"><?php echo $payment_list_view_list->ChargeDesc->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ChargeDesc" id="z_ChargeDesc" value="LIKE">
</span>
		<span id="el_payment_list_view_ChargeDesc" class="ew-search-field">
<input type="text" data-table="payment_list_view" data-field="x_ChargeDesc" name="x_ChargeDesc" id="x_ChargeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payment_list_view_list->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $payment_list_view_list->ChargeDesc->EditValue ?>"<?php echo $payment_list_view_list->ChargeDesc->editAttributes() ?>>
</span>
	</div>
	<?php if ($payment_list_view_list->SearchColumnCount % $payment_list_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($payment_list_view_list->SearchColumnCount % $payment_list_view_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $payment_list_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($payment_list_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($payment_list_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $payment_list_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($payment_list_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($payment_list_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($payment_list_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($payment_list_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $payment_list_view_list->showPageHeader(); ?>
<?php
$payment_list_view_list->showMessage();
?>
<?php if ($payment_list_view_list->TotalRecords > 0 || $payment_list_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payment_list_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payment_list_view">
<?php if (!$payment_list_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$payment_list_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payment_list_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payment_list_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpayment_list_viewlist" id="fpayment_list_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payment_list_view">
<div id="gmp_payment_list_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($payment_list_view_list->TotalRecords > 0 || $payment_list_view_list->isGridEdit()) { ?>
<table id="tbl_payment_list_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payment_list_view->RowType = ROWTYPE_HEADER;

// Render list options
$payment_list_view_list->renderListOptions();

// Render list options (header, left)
$payment_list_view_list->ListOptions->render("header", "left");
?>
<?php if ($payment_list_view_list->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->PropertyNo) == "") { ?>
		<th data-name="PropertyNo" class="<?php echo $payment_list_view_list->PropertyNo->headerCellClass() ?>"><div id="elh_payment_list_view_PropertyNo" class="payment_list_view_PropertyNo"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->PropertyNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyNo" class="<?php echo $payment_list_view_list->PropertyNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->PropertyNo) ?>', 1);"><div id="elh_payment_list_view_PropertyNo" class="payment_list_view_PropertyNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->PropertyNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->PropertyNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->PropertyNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->ClientName->Visible) { // ClientName ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->ClientName) == "") { ?>
		<th data-name="ClientName" class="<?php echo $payment_list_view_list->ClientName->headerCellClass() ?>"><div id="elh_payment_list_view_ClientName" class="payment_list_view_ClientName"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->ClientName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientName" class="<?php echo $payment_list_view_list->ClientName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->ClientName) ?>', 1);"><div id="elh_payment_list_view_ClientName" class="payment_list_view_ClientName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->ClientName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->ClientName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->ClientName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $payment_list_view_list->PropertyUse->headerCellClass() ?>"><div id="elh_payment_list_view_PropertyUse" class="payment_list_view_PropertyUse"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $payment_list_view_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->PropertyUse) ?>', 1);"><div id="elh_payment_list_view_PropertyUse" class="payment_list_view_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->PropertyUse->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->LandExtentInHA) == "") { ?>
		<th data-name="LandExtentInHA" class="<?php echo $payment_list_view_list->LandExtentInHA->headerCellClass() ?>"><div id="elh_payment_list_view_LandExtentInHA" class="payment_list_view_LandExtentInHA"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->LandExtentInHA->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LandExtentInHA" class="<?php echo $payment_list_view_list->LandExtentInHA->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->LandExtentInHA) ?>', 1);"><div id="elh_payment_list_view_LandExtentInHA" class="payment_list_view_LandExtentInHA">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->LandExtentInHA->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->LandExtentInHA->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->LandExtentInHA->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->LandValue->Visible) { // LandValue ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->LandValue) == "") { ?>
		<th data-name="LandValue" class="<?php echo $payment_list_view_list->LandValue->headerCellClass() ?>"><div id="elh_payment_list_view_LandValue" class="payment_list_view_LandValue"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->LandValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LandValue" class="<?php echo $payment_list_view_list->LandValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->LandValue) ?>', 1);"><div id="elh_payment_list_view_LandValue" class="payment_list_view_LandValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->LandValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->LandValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->LandValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->ImprovementsValue) == "") { ?>
		<th data-name="ImprovementsValue" class="<?php echo $payment_list_view_list->ImprovementsValue->headerCellClass() ?>"><div id="elh_payment_list_view_ImprovementsValue" class="payment_list_view_ImprovementsValue"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->ImprovementsValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ImprovementsValue" class="<?php echo $payment_list_view_list->ImprovementsValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->ImprovementsValue) ?>', 1);"><div id="elh_payment_list_view_ImprovementsValue" class="payment_list_view_ImprovementsValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->ImprovementsValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->ImprovementsValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->ImprovementsValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->RateableValue->Visible) { // RateableValue ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->RateableValue) == "") { ?>
		<th data-name="RateableValue" class="<?php echo $payment_list_view_list->RateableValue->headerCellClass() ?>"><div id="elh_payment_list_view_RateableValue" class="payment_list_view_RateableValue"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->RateableValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RateableValue" class="<?php echo $payment_list_view_list->RateableValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->RateableValue) ?>', 1);"><div id="elh_payment_list_view_RateableValue" class="payment_list_view_RateableValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->RateableValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->RateableValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->RateableValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $payment_list_view_list->ChargeCode->headerCellClass() ?>"><div id="elh_payment_list_view_ChargeCode" class="payment_list_view_ChargeCode"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $payment_list_view_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->ChargeCode) ?>', 1);"><div id="elh_payment_list_view_ChargeCode" class="payment_list_view_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $payment_list_view_list->ChargeGroup->headerCellClass() ?>"><div id="elh_payment_list_view_ChargeGroup" class="payment_list_view_ChargeGroup"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $payment_list_view_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->ChargeGroup) ?>', 1);"><div id="elh_payment_list_view_ChargeGroup" class="payment_list_view_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $payment_list_view_list->BalanceBF->headerCellClass() ?>"><div id="elh_payment_list_view_BalanceBF" class="payment_list_view_BalanceBF"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $payment_list_view_list->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->BalanceBF) ?>', 1);"><div id="elh_payment_list_view_BalanceBF" class="payment_list_view_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->CurrentDemand) == "") { ?>
		<th data-name="CurrentDemand" class="<?php echo $payment_list_view_list->CurrentDemand->headerCellClass() ?>"><div id="elh_payment_list_view_CurrentDemand" class="payment_list_view_CurrentDemand"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->CurrentDemand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentDemand" class="<?php echo $payment_list_view_list->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->CurrentDemand) ?>', 1);"><div id="elh_payment_list_view_CurrentDemand" class="payment_list_view_CurrentDemand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->CurrentDemand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->CurrentDemand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->VAT->Visible) { // VAT ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $payment_list_view_list->VAT->headerCellClass() ?>"><div id="elh_payment_list_view_VAT" class="payment_list_view_VAT"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $payment_list_view_list->VAT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->VAT) ?>', 1);"><div id="elh_payment_list_view_VAT" class="payment_list_view_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $payment_list_view_list->AmountPaid->headerCellClass() ?>"><div id="elh_payment_list_view_AmountPaid" class="payment_list_view_AmountPaid"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $payment_list_view_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->AmountPaid) ?>', 1);"><div id="elh_payment_list_view_AmountPaid" class="payment_list_view_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $payment_list_view_list->BillPeriod->headerCellClass() ?>"><div id="elh_payment_list_view_BillPeriod" class="payment_list_view_BillPeriod"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $payment_list_view_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->BillPeriod) ?>', 1);"><div id="elh_payment_list_view_BillPeriod" class="payment_list_view_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->BillYear->Visible) { // BillYear ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $payment_list_view_list->BillYear->headerCellClass() ?>"><div id="elh_payment_list_view_BillYear" class="payment_list_view_BillYear"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $payment_list_view_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->BillYear) ?>', 1);"><div id="elh_payment_list_view_BillYear" class="payment_list_view_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->StartDate->Visible) { // StartDate ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $payment_list_view_list->StartDate->headerCellClass() ?>"><div id="elh_payment_list_view_StartDate" class="payment_list_view_StartDate"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $payment_list_view_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->StartDate) ?>', 1);"><div id="elh_payment_list_view_StartDate" class="payment_list_view_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->EndDate->Visible) { // EndDate ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $payment_list_view_list->EndDate->headerCellClass() ?>"><div id="elh_payment_list_view_EndDate" class="payment_list_view_EndDate"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $payment_list_view_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->EndDate) ?>', 1);"><div id="elh_payment_list_view_EndDate" class="payment_list_view_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_list_view_list->ChargeDesc->Visible) { // ChargeDesc ?>
	<?php if ($payment_list_view_list->SortUrl($payment_list_view_list->ChargeDesc) == "") { ?>
		<th data-name="ChargeDesc" class="<?php echo $payment_list_view_list->ChargeDesc->headerCellClass() ?>"><div id="elh_payment_list_view_ChargeDesc" class="payment_list_view_ChargeDesc"><div class="ew-table-header-caption"><?php echo $payment_list_view_list->ChargeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeDesc" class="<?php echo $payment_list_view_list->ChargeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_list_view_list->SortUrl($payment_list_view_list->ChargeDesc) ?>', 1);"><div id="elh_payment_list_view_ChargeDesc" class="payment_list_view_ChargeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_list_view_list->ChargeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_list_view_list->ChargeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_list_view_list->ChargeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payment_list_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($payment_list_view_list->ExportAll && $payment_list_view_list->isExport()) {
	$payment_list_view_list->StopRecord = $payment_list_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($payment_list_view_list->TotalRecords > $payment_list_view_list->StartRecord + $payment_list_view_list->DisplayRecords - 1)
		$payment_list_view_list->StopRecord = $payment_list_view_list->StartRecord + $payment_list_view_list->DisplayRecords - 1;
	else
		$payment_list_view_list->StopRecord = $payment_list_view_list->TotalRecords;
}
$payment_list_view_list->RecordCount = $payment_list_view_list->StartRecord - 1;
if ($payment_list_view_list->Recordset && !$payment_list_view_list->Recordset->EOF) {
	$payment_list_view_list->Recordset->moveFirst();
	$selectLimit = $payment_list_view_list->UseSelectLimit;
	if (!$selectLimit && $payment_list_view_list->StartRecord > 1)
		$payment_list_view_list->Recordset->move($payment_list_view_list->StartRecord - 1);
} elseif (!$payment_list_view->AllowAddDeleteRow && $payment_list_view_list->StopRecord == 0) {
	$payment_list_view_list->StopRecord = $payment_list_view->GridAddRowCount;
}

// Initialize aggregate
$payment_list_view->RowType = ROWTYPE_AGGREGATEINIT;
$payment_list_view->resetAttributes();
$payment_list_view_list->renderRow();
while ($payment_list_view_list->RecordCount < $payment_list_view_list->StopRecord) {
	$payment_list_view_list->RecordCount++;
	if ($payment_list_view_list->RecordCount >= $payment_list_view_list->StartRecord) {
		$payment_list_view_list->RowCount++;

		// Set up key count
		$payment_list_view_list->KeyCount = $payment_list_view_list->RowIndex;

		// Init row class and style
		$payment_list_view->resetAttributes();
		$payment_list_view->CssClass = "";
		if ($payment_list_view_list->isGridAdd()) {
		} else {
			$payment_list_view_list->loadRowValues($payment_list_view_list->Recordset); // Load row values
		}
		$payment_list_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$payment_list_view->RowAttrs->merge(["data-rowindex" => $payment_list_view_list->RowCount, "id" => "r" . $payment_list_view_list->RowCount . "_payment_list_view", "data-rowtype" => $payment_list_view->RowType]);

		// Render row
		$payment_list_view_list->renderRow();

		// Render list options
		$payment_list_view_list->renderListOptions();
?>
	<tr <?php echo $payment_list_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payment_list_view_list->ListOptions->render("body", "left", $payment_list_view_list->RowCount);
?>
	<?php if ($payment_list_view_list->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo" <?php echo $payment_list_view_list->PropertyNo->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_PropertyNo">
<span<?php echo $payment_list_view_list->PropertyNo->viewAttributes() ?>><?php echo $payment_list_view_list->PropertyNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->ClientName->Visible) { // ClientName ?>
		<td data-name="ClientName" <?php echo $payment_list_view_list->ClientName->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_ClientName">
<span<?php echo $payment_list_view_list->ClientName->viewAttributes() ?>><?php echo $payment_list_view_list->ClientName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $payment_list_view_list->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_PropertyUse">
<span<?php echo $payment_list_view_list->PropertyUse->viewAttributes() ?>><?php echo $payment_list_view_list->PropertyUse->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->LandExtentInHA->Visible) { // LandExtentInHA ?>
		<td data-name="LandExtentInHA" <?php echo $payment_list_view_list->LandExtentInHA->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_LandExtentInHA">
<span<?php echo $payment_list_view_list->LandExtentInHA->viewAttributes() ?>><?php echo $payment_list_view_list->LandExtentInHA->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->LandValue->Visible) { // LandValue ?>
		<td data-name="LandValue" <?php echo $payment_list_view_list->LandValue->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_LandValue">
<span<?php echo $payment_list_view_list->LandValue->viewAttributes() ?>><?php echo $payment_list_view_list->LandValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->ImprovementsValue->Visible) { // ImprovementsValue ?>
		<td data-name="ImprovementsValue" <?php echo $payment_list_view_list->ImprovementsValue->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_ImprovementsValue">
<span<?php echo $payment_list_view_list->ImprovementsValue->viewAttributes() ?>><?php echo $payment_list_view_list->ImprovementsValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->RateableValue->Visible) { // RateableValue ?>
		<td data-name="RateableValue" <?php echo $payment_list_view_list->RateableValue->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_RateableValue">
<span<?php echo $payment_list_view_list->RateableValue->viewAttributes() ?>><?php echo $payment_list_view_list->RateableValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $payment_list_view_list->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_ChargeCode">
<span<?php echo $payment_list_view_list->ChargeCode->viewAttributes() ?>><?php echo $payment_list_view_list->ChargeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $payment_list_view_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_ChargeGroup">
<span<?php echo $payment_list_view_list->ChargeGroup->viewAttributes() ?>><?php echo $payment_list_view_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $payment_list_view_list->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_BalanceBF">
<span<?php echo $payment_list_view_list->BalanceBF->viewAttributes() ?>><?php echo $payment_list_view_list->BalanceBF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" <?php echo $payment_list_view_list->CurrentDemand->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_CurrentDemand">
<span<?php echo $payment_list_view_list->CurrentDemand->viewAttributes() ?>><?php echo $payment_list_view_list->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $payment_list_view_list->VAT->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_VAT">
<span<?php echo $payment_list_view_list->VAT->viewAttributes() ?>><?php echo $payment_list_view_list->VAT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $payment_list_view_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_AmountPaid">
<span<?php echo $payment_list_view_list->AmountPaid->viewAttributes() ?>><?php echo $payment_list_view_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $payment_list_view_list->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_BillPeriod">
<span<?php echo $payment_list_view_list->BillPeriod->viewAttributes() ?>><?php echo $payment_list_view_list->BillPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $payment_list_view_list->BillYear->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_BillYear">
<span<?php echo $payment_list_view_list->BillYear->viewAttributes() ?>><?php echo $payment_list_view_list->BillYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $payment_list_view_list->StartDate->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_StartDate">
<span<?php echo $payment_list_view_list->StartDate->viewAttributes() ?>><?php echo $payment_list_view_list->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $payment_list_view_list->EndDate->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_EndDate">
<span<?php echo $payment_list_view_list->EndDate->viewAttributes() ?>><?php echo $payment_list_view_list->EndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_list_view_list->ChargeDesc->Visible) { // ChargeDesc ?>
		<td data-name="ChargeDesc" <?php echo $payment_list_view_list->ChargeDesc->cellAttributes() ?>>
<span id="el<?php echo $payment_list_view_list->RowCount ?>_payment_list_view_ChargeDesc">
<span<?php echo $payment_list_view_list->ChargeDesc->viewAttributes() ?>><?php echo $payment_list_view_list->ChargeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payment_list_view_list->ListOptions->render("body", "right", $payment_list_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$payment_list_view_list->isGridAdd())
		$payment_list_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$payment_list_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payment_list_view_list->Recordset)
	$payment_list_view_list->Recordset->Close();
?>
<?php if (!$payment_list_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$payment_list_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payment_list_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payment_list_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payment_list_view_list->TotalRecords == 0 && !$payment_list_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payment_list_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$payment_list_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payment_list_view_list->isExport()) { ?>
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
$payment_list_view_list->terminate();
?>