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
$charges_list = new charges_list();

// Run the page
$charges_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charges_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$charges_list->isExport()) { ?>
<script>
var fchargeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fchargeslist = currentForm = new ew.Form("fchargeslist", "list");
	fchargeslist.formKeyCountName = '<?php echo $charges_list->FormKeyCountName ?>';

	// Validate form
	fchargeslist.validate = function() {
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
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($charges_list->ChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->ChargeCode->caption(), $charges_list->ChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_list->ChargeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->ChargeDesc->caption(), $charges_list->ChargeDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_list->Fee->Required) { ?>
				elm = this.getElements("x" + infix + "_Fee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->Fee->caption(), $charges_list->Fee->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Fee");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_list->Fee->errorMessage()) ?>");
			<?php if ($charges_list->ChargeType->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->ChargeType->caption(), $charges_list->ChargeType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_list->Frequency->Required) { ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->Frequency->caption(), $charges_list->Frequency->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Frequency");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_list->Frequency->errorMessage()) ?>");
			<?php if ($charges_list->Installment->Required) { ?>
				elm = this.getElements("x" + infix + "_Installment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->Installment->caption(), $charges_list->Installment->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->DepartmentCode->caption(), $charges_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_list->GLAccount->Required) { ?>
				elm = this.getElements("x" + infix + "_GLAccount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->GLAccount->caption(), $charges_list->GLAccount->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_list->ChargeGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_ChargeGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->ChargeGroup->caption(), $charges_list->ChargeGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_list->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->UnitOfMeasure->caption(), $charges_list->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_list->Factor->Required) { ?>
				elm = this.getElements("x" + infix + "_Factor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->Factor->caption(), $charges_list->Factor->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Factor");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($charges_list->Factor->errorMessage()) ?>");
			<?php if ($charges_list->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->PeriodType->caption(), $charges_list->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_list->ClearedChargeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ClearedChargeCode[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->ClearedChargeCode->caption(), $charges_list->ClearedChargeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($charges_list->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $charges_list->PropertyUse->caption(), $charges_list->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	fchargeslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ChargeDesc", false)) return false;
		if (ew.valueChanged(fobj, infix, "Fee", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeType", false)) return false;
		if (ew.valueChanged(fobj, infix, "Frequency", false)) return false;
		if (ew.valueChanged(fobj, infix, "Installment", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "GLAccount", false)) return false;
		if (ew.valueChanged(fobj, infix, "ChargeGroup", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitOfMeasure", false)) return false;
		if (ew.valueChanged(fobj, infix, "Factor", false)) return false;
		if (ew.valueChanged(fobj, infix, "PeriodType", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClearedChargeCode[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "PropertyUse", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fchargeslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fchargeslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fchargeslist.lists["x_ChargeType"] = <?php echo $charges_list->ChargeType->Lookup->toClientList($charges_list) ?>;
	fchargeslist.lists["x_ChargeType"].options = <?php echo JsonEncode($charges_list->ChargeType->lookupOptions()) ?>;
	fchargeslist.lists["x_Installment"] = <?php echo $charges_list->Installment->Lookup->toClientList($charges_list) ?>;
	fchargeslist.lists["x_Installment"].options = <?php echo JsonEncode($charges_list->Installment->lookupOptions()) ?>;
	fchargeslist.lists["x_DepartmentCode"] = <?php echo $charges_list->DepartmentCode->Lookup->toClientList($charges_list) ?>;
	fchargeslist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($charges_list->DepartmentCode->lookupOptions()) ?>;
	fchargeslist.lists["x_GLAccount"] = <?php echo $charges_list->GLAccount->Lookup->toClientList($charges_list) ?>;
	fchargeslist.lists["x_GLAccount"].options = <?php echo JsonEncode($charges_list->GLAccount->lookupOptions()) ?>;
	fchargeslist.lists["x_ChargeGroup"] = <?php echo $charges_list->ChargeGroup->Lookup->toClientList($charges_list) ?>;
	fchargeslist.lists["x_ChargeGroup"].options = <?php echo JsonEncode($charges_list->ChargeGroup->lookupOptions()) ?>;
	fchargeslist.lists["x_UnitOfMeasure"] = <?php echo $charges_list->UnitOfMeasure->Lookup->toClientList($charges_list) ?>;
	fchargeslist.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($charges_list->UnitOfMeasure->lookupOptions()) ?>;
	fchargeslist.lists["x_PeriodType"] = <?php echo $charges_list->PeriodType->Lookup->toClientList($charges_list) ?>;
	fchargeslist.lists["x_PeriodType"].options = <?php echo JsonEncode($charges_list->PeriodType->lookupOptions()) ?>;
	fchargeslist.lists["x_ClearedChargeCode[]"] = <?php echo $charges_list->ClearedChargeCode->Lookup->toClientList($charges_list) ?>;
	fchargeslist.lists["x_ClearedChargeCode[]"].options = <?php echo JsonEncode($charges_list->ClearedChargeCode->lookupOptions()) ?>;
	fchargeslist.lists["x_PropertyUse"] = <?php echo $charges_list->PropertyUse->Lookup->toClientList($charges_list) ?>;
	fchargeslist.lists["x_PropertyUse"].options = <?php echo JsonEncode($charges_list->PropertyUse->lookupOptions()) ?>;
	loadjs.done("fchargeslist");
});
var fchargeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fchargeslistsrch = currentSearchForm = new ew.Form("fchargeslistsrch");

	// Dynamic selection lists
	// Filters

	fchargeslistsrch.filterList = <?php echo $charges_list->getFilterList() ?>;

	// Init search panel as collapsed
	fchargeslistsrch.initSearchPanel = true;
	loadjs.done("fchargeslistsrch");
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
<?php if (!$charges_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($charges_list->TotalRecords > 0 && $charges_list->ExportOptions->visible()) { ?>
<?php $charges_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($charges_list->ImportOptions->visible()) { ?>
<?php $charges_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($charges_list->SearchOptions->visible()) { ?>
<?php $charges_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($charges_list->FilterOptions->visible()) { ?>
<?php $charges_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$charges_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$charges_list->isExport() && !$charges->CurrentAction) { ?>
<form name="fchargeslistsrch" id="fchargeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fchargeslistsrch-search-panel" class="<?php echo $charges_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="charges">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $charges_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($charges_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($charges_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $charges_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($charges_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($charges_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($charges_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($charges_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $charges_list->showPageHeader(); ?>
<?php
$charges_list->showMessage();
?>
<?php if ($charges_list->TotalRecords > 0 || $charges->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($charges_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> charges">
<?php if (!$charges_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$charges_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charges_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $charges_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fchargeslist" id="fchargeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charges">
<div id="gmp_charges" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($charges_list->TotalRecords > 0 || $charges_list->isGridEdit()) { ?>
<table id="tbl_chargeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$charges->RowType = ROWTYPE_HEADER;

// Render list options
$charges_list->renderListOptions();

// Render list options (header, left)
$charges_list->ListOptions->render("header", "left");
?>
<?php if ($charges_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($charges_list->SortUrl($charges_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $charges_list->ChargeCode->headerCellClass() ?>"><div id="elh_charges_ChargeCode" class="charges_ChargeCode"><div class="ew-table-header-caption"><?php echo $charges_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $charges_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->ChargeCode) ?>', 1);"><div id="elh_charges_ChargeCode" class="charges_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->ChargeDesc->Visible) { // ChargeDesc ?>
	<?php if ($charges_list->SortUrl($charges_list->ChargeDesc) == "") { ?>
		<th data-name="ChargeDesc" class="<?php echo $charges_list->ChargeDesc->headerCellClass() ?>"><div id="elh_charges_ChargeDesc" class="charges_ChargeDesc"><div class="ew-table-header-caption"><?php echo $charges_list->ChargeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeDesc" class="<?php echo $charges_list->ChargeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->ChargeDesc) ?>', 1);"><div id="elh_charges_ChargeDesc" class="charges_ChargeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->ChargeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($charges_list->ChargeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->ChargeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->Fee->Visible) { // Fee ?>
	<?php if ($charges_list->SortUrl($charges_list->Fee) == "") { ?>
		<th data-name="Fee" class="<?php echo $charges_list->Fee->headerCellClass() ?>"><div id="elh_charges_Fee" class="charges_Fee"><div class="ew-table-header-caption"><?php echo $charges_list->Fee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fee" class="<?php echo $charges_list->Fee->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->Fee) ?>', 1);"><div id="elh_charges_Fee" class="charges_Fee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->Fee->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->Fee->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->Fee->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->ChargeType->Visible) { // ChargeType ?>
	<?php if ($charges_list->SortUrl($charges_list->ChargeType) == "") { ?>
		<th data-name="ChargeType" class="<?php echo $charges_list->ChargeType->headerCellClass() ?>"><div id="elh_charges_ChargeType" class="charges_ChargeType"><div class="ew-table-header-caption"><?php echo $charges_list->ChargeType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeType" class="<?php echo $charges_list->ChargeType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->ChargeType) ?>', 1);"><div id="elh_charges_ChargeType" class="charges_ChargeType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->ChargeType->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->ChargeType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->ChargeType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->Frequency->Visible) { // Frequency ?>
	<?php if ($charges_list->SortUrl($charges_list->Frequency) == "") { ?>
		<th data-name="Frequency" class="<?php echo $charges_list->Frequency->headerCellClass() ?>"><div id="elh_charges_Frequency" class="charges_Frequency"><div class="ew-table-header-caption"><?php echo $charges_list->Frequency->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Frequency" class="<?php echo $charges_list->Frequency->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->Frequency) ?>', 1);"><div id="elh_charges_Frequency" class="charges_Frequency">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->Frequency->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->Frequency->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->Frequency->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->Installment->Visible) { // Installment ?>
	<?php if ($charges_list->SortUrl($charges_list->Installment) == "") { ?>
		<th data-name="Installment" class="<?php echo $charges_list->Installment->headerCellClass() ?>"><div id="elh_charges_Installment" class="charges_Installment"><div class="ew-table-header-caption"><?php echo $charges_list->Installment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Installment" class="<?php echo $charges_list->Installment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->Installment) ?>', 1);"><div id="elh_charges_Installment" class="charges_Installment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->Installment->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->Installment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->Installment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($charges_list->SortUrl($charges_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $charges_list->DepartmentCode->headerCellClass() ?>"><div id="elh_charges_DepartmentCode" class="charges_DepartmentCode"><div class="ew-table-header-caption"><?php echo $charges_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $charges_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->DepartmentCode) ?>', 1);"><div id="elh_charges_DepartmentCode" class="charges_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->GLAccount->Visible) { // GLAccount ?>
	<?php if ($charges_list->SortUrl($charges_list->GLAccount) == "") { ?>
		<th data-name="GLAccount" class="<?php echo $charges_list->GLAccount->headerCellClass() ?>"><div id="elh_charges_GLAccount" class="charges_GLAccount"><div class="ew-table-header-caption"><?php echo $charges_list->GLAccount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GLAccount" class="<?php echo $charges_list->GLAccount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->GLAccount) ?>', 1);"><div id="elh_charges_GLAccount" class="charges_GLAccount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->GLAccount->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->GLAccount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->GLAccount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($charges_list->SortUrl($charges_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $charges_list->ChargeGroup->headerCellClass() ?>"><div id="elh_charges_ChargeGroup" class="charges_ChargeGroup"><div class="ew-table-header-caption"><?php echo $charges_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $charges_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->ChargeGroup) ?>', 1);"><div id="elh_charges_ChargeGroup" class="charges_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($charges_list->SortUrl($charges_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $charges_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_charges_UnitOfMeasure" class="charges_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $charges_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $charges_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->UnitOfMeasure) ?>', 1);"><div id="elh_charges_UnitOfMeasure" class="charges_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->Factor->Visible) { // Factor ?>
	<?php if ($charges_list->SortUrl($charges_list->Factor) == "") { ?>
		<th data-name="Factor" class="<?php echo $charges_list->Factor->headerCellClass() ?>"><div id="elh_charges_Factor" class="charges_Factor"><div class="ew-table-header-caption"><?php echo $charges_list->Factor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Factor" class="<?php echo $charges_list->Factor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->Factor) ?>', 1);"><div id="elh_charges_Factor" class="charges_Factor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->Factor->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->Factor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->Factor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->PeriodType->Visible) { // PeriodType ?>
	<?php if ($charges_list->SortUrl($charges_list->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $charges_list->PeriodType->headerCellClass() ?>"><div id="elh_charges_PeriodType" class="charges_PeriodType"><div class="ew-table-header-caption"><?php echo $charges_list->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $charges_list->PeriodType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->PeriodType) ?>', 1);"><div id="elh_charges_PeriodType" class="charges_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->PeriodType->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->ClearedChargeCode->Visible) { // ClearedChargeCode ?>
	<?php if ($charges_list->SortUrl($charges_list->ClearedChargeCode) == "") { ?>
		<th data-name="ClearedChargeCode" class="<?php echo $charges_list->ClearedChargeCode->headerCellClass() ?>"><div id="elh_charges_ClearedChargeCode" class="charges_ClearedChargeCode"><div class="ew-table-header-caption"><?php echo $charges_list->ClearedChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClearedChargeCode" class="<?php echo $charges_list->ClearedChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->ClearedChargeCode) ?>', 1);"><div id="elh_charges_ClearedChargeCode" class="charges_ClearedChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->ClearedChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->ClearedChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->ClearedChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charges_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($charges_list->SortUrl($charges_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $charges_list->PropertyUse->headerCellClass() ?>"><div id="elh_charges_PropertyUse" class="charges_PropertyUse"><div class="ew-table-header-caption"><?php echo $charges_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $charges_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charges_list->SortUrl($charges_list->PropertyUse) ?>', 1);"><div id="elh_charges_PropertyUse" class="charges_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charges_list->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($charges_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charges_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$charges_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($charges_list->ExportAll && $charges_list->isExport()) {
	$charges_list->StopRecord = $charges_list->TotalRecords;
} else {

	// Set the last record to display
	if ($charges_list->TotalRecords > $charges_list->StartRecord + $charges_list->DisplayRecords - 1)
		$charges_list->StopRecord = $charges_list->StartRecord + $charges_list->DisplayRecords - 1;
	else
		$charges_list->StopRecord = $charges_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($charges->isConfirm() || $charges_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($charges_list->FormKeyCountName) && ($charges_list->isGridAdd() || $charges_list->isGridEdit() || $charges->isConfirm())) {
		$charges_list->KeyCount = $CurrentForm->getValue($charges_list->FormKeyCountName);
		$charges_list->StopRecord = $charges_list->StartRecord + $charges_list->KeyCount - 1;
	}
}
$charges_list->RecordCount = $charges_list->StartRecord - 1;
if ($charges_list->Recordset && !$charges_list->Recordset->EOF) {
	$charges_list->Recordset->moveFirst();
	$selectLimit = $charges_list->UseSelectLimit;
	if (!$selectLimit && $charges_list->StartRecord > 1)
		$charges_list->Recordset->move($charges_list->StartRecord - 1);
} elseif (!$charges->AllowAddDeleteRow && $charges_list->StopRecord == 0) {
	$charges_list->StopRecord = $charges->GridAddRowCount;
}

// Initialize aggregate
$charges->RowType = ROWTYPE_AGGREGATEINIT;
$charges->resetAttributes();
$charges_list->renderRow();
if ($charges_list->isGridAdd())
	$charges_list->RowIndex = 0;
if ($charges_list->isGridEdit())
	$charges_list->RowIndex = 0;
while ($charges_list->RecordCount < $charges_list->StopRecord) {
	$charges_list->RecordCount++;
	if ($charges_list->RecordCount >= $charges_list->StartRecord) {
		$charges_list->RowCount++;
		if ($charges_list->isGridAdd() || $charges_list->isGridEdit() || $charges->isConfirm()) {
			$charges_list->RowIndex++;
			$CurrentForm->Index = $charges_list->RowIndex;
			if ($CurrentForm->hasValue($charges_list->FormActionName) && ($charges->isConfirm() || $charges_list->EventCancelled))
				$charges_list->RowAction = strval($CurrentForm->getValue($charges_list->FormActionName));
			elseif ($charges_list->isGridAdd())
				$charges_list->RowAction = "insert";
			else
				$charges_list->RowAction = "";
		}

		// Set up key count
		$charges_list->KeyCount = $charges_list->RowIndex;

		// Init row class and style
		$charges->resetAttributes();
		$charges->CssClass = "";
		if ($charges_list->isGridAdd()) {
			$charges_list->loadRowValues(); // Load default values
		} else {
			$charges_list->loadRowValues($charges_list->Recordset); // Load row values
		}
		$charges->RowType = ROWTYPE_VIEW; // Render view
		if ($charges_list->isGridAdd()) // Grid add
			$charges->RowType = ROWTYPE_ADD; // Render add
		if ($charges_list->isGridAdd() && $charges->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$charges_list->restoreCurrentRowFormValues($charges_list->RowIndex); // Restore form values
		if ($charges_list->isGridEdit()) { // Grid edit
			if ($charges->EventCancelled)
				$charges_list->restoreCurrentRowFormValues($charges_list->RowIndex); // Restore form values
			if ($charges_list->RowAction == "insert")
				$charges->RowType = ROWTYPE_ADD; // Render add
			else
				$charges->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($charges_list->isGridEdit() && ($charges->RowType == ROWTYPE_EDIT || $charges->RowType == ROWTYPE_ADD) && $charges->EventCancelled) // Update failed
			$charges_list->restoreCurrentRowFormValues($charges_list->RowIndex); // Restore form values
		if ($charges->RowType == ROWTYPE_EDIT) // Edit row
			$charges_list->EditRowCount++;

		// Set up row id / data-rowindex
		$charges->RowAttrs->merge(["data-rowindex" => $charges_list->RowCount, "id" => "r" . $charges_list->RowCount . "_charges", "data-rowtype" => $charges->RowType]);

		// Render row
		$charges_list->renderRow();

		// Render list options
		$charges_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($charges_list->RowAction != "delete" && $charges_list->RowAction != "insertdelete" && !($charges_list->RowAction == "insert" && $charges->isConfirm() && $charges_list->emptyRow())) {
?>
	<tr <?php echo $charges->rowAttributes() ?>>
<?php

// Render list options (body, left)
$charges_list->ListOptions->render("body", "left", $charges_list->RowCount);
?>
	<?php if ($charges_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $charges_list->ChargeCode->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeCode" class="form-group"></span>
<input type="hidden" data-table="charges" data-field="x_ChargeCode" name="o<?php echo $charges_list->RowIndex ?>_ChargeCode" id="o<?php echo $charges_list->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($charges_list->ChargeCode->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeCode" class="form-group">
<span<?php echo $charges_list->ChargeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($charges_list->ChargeCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeCode" name="x<?php echo $charges_list->RowIndex ?>_ChargeCode" id="x<?php echo $charges_list->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($charges_list->ChargeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeCode">
<span<?php echo $charges_list->ChargeCode->viewAttributes() ?>><?php echo $charges_list->ChargeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->ChargeDesc->Visible) { // ChargeDesc ?>
		<td data-name="ChargeDesc" <?php echo $charges_list->ChargeDesc->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeDesc" class="form-group">
<input type="text" data-table="charges" data-field="x_ChargeDesc" name="x<?php echo $charges_list->RowIndex ?>_ChargeDesc" id="x<?php echo $charges_list->RowIndex ?>_ChargeDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($charges_list->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $charges_list->ChargeDesc->EditValue ?>"<?php echo $charges_list->ChargeDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeDesc" name="o<?php echo $charges_list->RowIndex ?>_ChargeDesc" id="o<?php echo $charges_list->RowIndex ?>_ChargeDesc" value="<?php echo HtmlEncode($charges_list->ChargeDesc->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeDesc" class="form-group">
<input type="text" data-table="charges" data-field="x_ChargeDesc" name="x<?php echo $charges_list->RowIndex ?>_ChargeDesc" id="x<?php echo $charges_list->RowIndex ?>_ChargeDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($charges_list->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $charges_list->ChargeDesc->EditValue ?>"<?php echo $charges_list->ChargeDesc->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeDesc">
<span<?php echo $charges_list->ChargeDesc->viewAttributes() ?>><?php echo $charges_list->ChargeDesc->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->Fee->Visible) { // Fee ?>
		<td data-name="Fee" <?php echo $charges_list->Fee->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Fee" class="form-group">
<input type="text" data-table="charges" data-field="x_Fee" name="x<?php echo $charges_list->RowIndex ?>_Fee" id="x<?php echo $charges_list->RowIndex ?>_Fee" size="30" placeholder="<?php echo HtmlEncode($charges_list->Fee->getPlaceHolder()) ?>" value="<?php echo $charges_list->Fee->EditValue ?>"<?php echo $charges_list->Fee->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_Fee" name="o<?php echo $charges_list->RowIndex ?>_Fee" id="o<?php echo $charges_list->RowIndex ?>_Fee" value="<?php echo HtmlEncode($charges_list->Fee->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Fee" class="form-group">
<input type="text" data-table="charges" data-field="x_Fee" name="x<?php echo $charges_list->RowIndex ?>_Fee" id="x<?php echo $charges_list->RowIndex ?>_Fee" size="30" placeholder="<?php echo HtmlEncode($charges_list->Fee->getPlaceHolder()) ?>" value="<?php echo $charges_list->Fee->EditValue ?>"<?php echo $charges_list->Fee->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Fee">
<span<?php echo $charges_list->Fee->viewAttributes() ?>><?php echo $charges_list->Fee->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->ChargeType->Visible) { // ChargeType ?>
		<td data-name="ChargeType" <?php echo $charges_list->ChargeType->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeType" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_ChargeType"><?php echo EmptyValue(strval($charges_list->ChargeType->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->ChargeType->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->ChargeType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->ChargeType->ReadOnly || $charges_list->ChargeType->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_ChargeType',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->ChargeType->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_ChargeType") ?>
<input type="hidden" data-table="charges" data-field="x_ChargeType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_list->ChargeType->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_ChargeType" id="x<?php echo $charges_list->RowIndex ?>_ChargeType" value="<?php echo $charges_list->ChargeType->CurrentValue ?>"<?php echo $charges_list->ChargeType->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeType" name="o<?php echo $charges_list->RowIndex ?>_ChargeType" id="o<?php echo $charges_list->RowIndex ?>_ChargeType" value="<?php echo HtmlEncode($charges_list->ChargeType->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeType" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_ChargeType"><?php echo EmptyValue(strval($charges_list->ChargeType->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->ChargeType->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->ChargeType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->ChargeType->ReadOnly || $charges_list->ChargeType->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_ChargeType',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->ChargeType->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_ChargeType") ?>
<input type="hidden" data-table="charges" data-field="x_ChargeType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_list->ChargeType->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_ChargeType" id="x<?php echo $charges_list->RowIndex ?>_ChargeType" value="<?php echo $charges_list->ChargeType->CurrentValue ?>"<?php echo $charges_list->ChargeType->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeType">
<span<?php echo $charges_list->ChargeType->viewAttributes() ?>><?php echo $charges_list->ChargeType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->Frequency->Visible) { // Frequency ?>
		<td data-name="Frequency" <?php echo $charges_list->Frequency->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Frequency" class="form-group">
<input type="text" data-table="charges" data-field="x_Frequency" name="x<?php echo $charges_list->RowIndex ?>_Frequency" id="x<?php echo $charges_list->RowIndex ?>_Frequency" size="30" placeholder="<?php echo HtmlEncode($charges_list->Frequency->getPlaceHolder()) ?>" value="<?php echo $charges_list->Frequency->EditValue ?>"<?php echo $charges_list->Frequency->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_Frequency" name="o<?php echo $charges_list->RowIndex ?>_Frequency" id="o<?php echo $charges_list->RowIndex ?>_Frequency" value="<?php echo HtmlEncode($charges_list->Frequency->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Frequency" class="form-group">
<input type="text" data-table="charges" data-field="x_Frequency" name="x<?php echo $charges_list->RowIndex ?>_Frequency" id="x<?php echo $charges_list->RowIndex ?>_Frequency" size="30" placeholder="<?php echo HtmlEncode($charges_list->Frequency->getPlaceHolder()) ?>" value="<?php echo $charges_list->Frequency->EditValue ?>"<?php echo $charges_list->Frequency->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Frequency">
<span<?php echo $charges_list->Frequency->viewAttributes() ?>><?php echo $charges_list->Frequency->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->Installment->Visible) { // Installment ?>
		<td data-name="Installment" <?php echo $charges_list->Installment->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Installment" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_Installment" data-value-separator="<?php echo $charges_list->Installment->displayValueSeparatorAttribute() ?>" id="x<?php echo $charges_list->RowIndex ?>_Installment" name="x<?php echo $charges_list->RowIndex ?>_Installment"<?php echo $charges_list->Installment->editAttributes() ?>>
			<?php echo $charges_list->Installment->selectOptionListHtml("x{$charges_list->RowIndex}_Installment") ?>
		</select>
</div>
<?php echo $charges_list->Installment->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_Installment") ?>
</span>
<input type="hidden" data-table="charges" data-field="x_Installment" name="o<?php echo $charges_list->RowIndex ?>_Installment" id="o<?php echo $charges_list->RowIndex ?>_Installment" value="<?php echo HtmlEncode($charges_list->Installment->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Installment" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_Installment" data-value-separator="<?php echo $charges_list->Installment->displayValueSeparatorAttribute() ?>" id="x<?php echo $charges_list->RowIndex ?>_Installment" name="x<?php echo $charges_list->RowIndex ?>_Installment"<?php echo $charges_list->Installment->editAttributes() ?>>
			<?php echo $charges_list->Installment->selectOptionListHtml("x{$charges_list->RowIndex}_Installment") ?>
		</select>
</div>
<?php echo $charges_list->Installment->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_Installment") ?>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Installment">
<span<?php echo $charges_list->Installment->viewAttributes() ?>><?php echo $charges_list->Installment->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $charges_list->DepartmentCode->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_DepartmentCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($charges_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->DepartmentCode->ReadOnly || $charges_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->DepartmentCode->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="charges" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_DepartmentCode" id="x<?php echo $charges_list->RowIndex ?>_DepartmentCode" value="<?php echo $charges_list->DepartmentCode->CurrentValue ?>"<?php echo $charges_list->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_DepartmentCode" name="o<?php echo $charges_list->RowIndex ?>_DepartmentCode" id="o<?php echo $charges_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($charges_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_DepartmentCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($charges_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->DepartmentCode->ReadOnly || $charges_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->DepartmentCode->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="charges" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_DepartmentCode" id="x<?php echo $charges_list->RowIndex ?>_DepartmentCode" value="<?php echo $charges_list->DepartmentCode->CurrentValue ?>"<?php echo $charges_list->DepartmentCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_DepartmentCode">
<span<?php echo $charges_list->DepartmentCode->viewAttributes() ?>><?php echo $charges_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->GLAccount->Visible) { // GLAccount ?>
		<td data-name="GLAccount" <?php echo $charges_list->GLAccount->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_GLAccount" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_GLAccount"><?php echo EmptyValue(strval($charges_list->GLAccount->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->GLAccount->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->GLAccount->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->GLAccount->ReadOnly || $charges_list->GLAccount->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_GLAccount',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->GLAccount->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_GLAccount") ?>
<input type="hidden" data-table="charges" data-field="x_GLAccount" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_list->GLAccount->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_GLAccount" id="x<?php echo $charges_list->RowIndex ?>_GLAccount" value="<?php echo $charges_list->GLAccount->CurrentValue ?>"<?php echo $charges_list->GLAccount->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_GLAccount" name="o<?php echo $charges_list->RowIndex ?>_GLAccount" id="o<?php echo $charges_list->RowIndex ?>_GLAccount" value="<?php echo HtmlEncode($charges_list->GLAccount->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_GLAccount" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_GLAccount"><?php echo EmptyValue(strval($charges_list->GLAccount->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->GLAccount->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->GLAccount->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->GLAccount->ReadOnly || $charges_list->GLAccount->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_GLAccount',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->GLAccount->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_GLAccount") ?>
<input type="hidden" data-table="charges" data-field="x_GLAccount" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_list->GLAccount->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_GLAccount" id="x<?php echo $charges_list->RowIndex ?>_GLAccount" value="<?php echo $charges_list->GLAccount->CurrentValue ?>"<?php echo $charges_list->GLAccount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_GLAccount">
<span<?php echo $charges_list->GLAccount->viewAttributes() ?>><?php echo $charges_list->GLAccount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $charges_list->ChargeGroup->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeGroup" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_ChargeGroup" data-value-separator="<?php echo $charges_list->ChargeGroup->displayValueSeparatorAttribute() ?>" id="x<?php echo $charges_list->RowIndex ?>_ChargeGroup" name="x<?php echo $charges_list->RowIndex ?>_ChargeGroup"<?php echo $charges_list->ChargeGroup->editAttributes() ?>>
			<?php echo $charges_list->ChargeGroup->selectOptionListHtml("x{$charges_list->RowIndex}_ChargeGroup") ?>
		</select>
</div>
<?php echo $charges_list->ChargeGroup->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_ChargeGroup") ?>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeGroup" name="o<?php echo $charges_list->RowIndex ?>_ChargeGroup" id="o<?php echo $charges_list->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($charges_list->ChargeGroup->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeGroup" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_ChargeGroup" data-value-separator="<?php echo $charges_list->ChargeGroup->displayValueSeparatorAttribute() ?>" id="x<?php echo $charges_list->RowIndex ?>_ChargeGroup" name="x<?php echo $charges_list->RowIndex ?>_ChargeGroup"<?php echo $charges_list->ChargeGroup->editAttributes() ?>>
			<?php echo $charges_list->ChargeGroup->selectOptionListHtml("x{$charges_list->RowIndex}_ChargeGroup") ?>
		</select>
</div>
<?php echo $charges_list->ChargeGroup->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_ChargeGroup") ?>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ChargeGroup">
<span<?php echo $charges_list->ChargeGroup->viewAttributes() ?>><?php echo $charges_list->ChargeGroup->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $charges_list->UnitOfMeasure->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_UnitOfMeasure" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_UnitOfMeasure"><?php echo EmptyValue(strval($charges_list->UnitOfMeasure->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->UnitOfMeasure->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->UnitOfMeasure->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->UnitOfMeasure->ReadOnly || $charges_list->UnitOfMeasure->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_UnitOfMeasure',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->UnitOfMeasure->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_UnitOfMeasure") ?>
<input type="hidden" data-table="charges" data-field="x_UnitOfMeasure" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_list->UnitOfMeasure->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_UnitOfMeasure" id="x<?php echo $charges_list->RowIndex ?>_UnitOfMeasure" value="<?php echo $charges_list->UnitOfMeasure->CurrentValue ?>"<?php echo $charges_list->UnitOfMeasure->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_UnitOfMeasure" name="o<?php echo $charges_list->RowIndex ?>_UnitOfMeasure" id="o<?php echo $charges_list->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($charges_list->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_UnitOfMeasure" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_UnitOfMeasure"><?php echo EmptyValue(strval($charges_list->UnitOfMeasure->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->UnitOfMeasure->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->UnitOfMeasure->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->UnitOfMeasure->ReadOnly || $charges_list->UnitOfMeasure->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_UnitOfMeasure',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->UnitOfMeasure->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_UnitOfMeasure") ?>
<input type="hidden" data-table="charges" data-field="x_UnitOfMeasure" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_list->UnitOfMeasure->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_UnitOfMeasure" id="x<?php echo $charges_list->RowIndex ?>_UnitOfMeasure" value="<?php echo $charges_list->UnitOfMeasure->CurrentValue ?>"<?php echo $charges_list->UnitOfMeasure->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_UnitOfMeasure">
<span<?php echo $charges_list->UnitOfMeasure->viewAttributes() ?>><?php echo $charges_list->UnitOfMeasure->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->Factor->Visible) { // Factor ?>
		<td data-name="Factor" <?php echo $charges_list->Factor->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Factor" class="form-group">
<input type="text" data-table="charges" data-field="x_Factor" name="x<?php echo $charges_list->RowIndex ?>_Factor" id="x<?php echo $charges_list->RowIndex ?>_Factor" size="30" placeholder="<?php echo HtmlEncode($charges_list->Factor->getPlaceHolder()) ?>" value="<?php echo $charges_list->Factor->EditValue ?>"<?php echo $charges_list->Factor->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_Factor" name="o<?php echo $charges_list->RowIndex ?>_Factor" id="o<?php echo $charges_list->RowIndex ?>_Factor" value="<?php echo HtmlEncode($charges_list->Factor->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Factor" class="form-group">
<input type="text" data-table="charges" data-field="x_Factor" name="x<?php echo $charges_list->RowIndex ?>_Factor" id="x<?php echo $charges_list->RowIndex ?>_Factor" size="30" placeholder="<?php echo HtmlEncode($charges_list->Factor->getPlaceHolder()) ?>" value="<?php echo $charges_list->Factor->EditValue ?>"<?php echo $charges_list->Factor->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_Factor">
<span<?php echo $charges_list->Factor->viewAttributes() ?>><?php echo $charges_list->Factor->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $charges_list->PeriodType->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_PeriodType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_PeriodType" data-value-separator="<?php echo $charges_list->PeriodType->displayValueSeparatorAttribute() ?>" id="x<?php echo $charges_list->RowIndex ?>_PeriodType" name="x<?php echo $charges_list->RowIndex ?>_PeriodType"<?php echo $charges_list->PeriodType->editAttributes() ?>>
			<?php echo $charges_list->PeriodType->selectOptionListHtml("x{$charges_list->RowIndex}_PeriodType") ?>
		</select>
</div>
<?php echo $charges_list->PeriodType->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_PeriodType") ?>
</span>
<input type="hidden" data-table="charges" data-field="x_PeriodType" name="o<?php echo $charges_list->RowIndex ?>_PeriodType" id="o<?php echo $charges_list->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($charges_list->PeriodType->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_PeriodType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_PeriodType" data-value-separator="<?php echo $charges_list->PeriodType->displayValueSeparatorAttribute() ?>" id="x<?php echo $charges_list->RowIndex ?>_PeriodType" name="x<?php echo $charges_list->RowIndex ?>_PeriodType"<?php echo $charges_list->PeriodType->editAttributes() ?>>
			<?php echo $charges_list->PeriodType->selectOptionListHtml("x{$charges_list->RowIndex}_PeriodType") ?>
		</select>
</div>
<?php echo $charges_list->PeriodType->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_PeriodType") ?>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_PeriodType">
<span<?php echo $charges_list->PeriodType->viewAttributes() ?>><?php echo $charges_list->PeriodType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->ClearedChargeCode->Visible) { // ClearedChargeCode ?>
		<td data-name="ClearedChargeCode" <?php echo $charges_list->ClearedChargeCode->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ClearedChargeCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_ClearedChargeCode"><?php echo EmptyValue(strval($charges_list->ClearedChargeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->ClearedChargeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->ClearedChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->ClearedChargeCode->ReadOnly || $charges_list->ClearedChargeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->ClearedChargeCode->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_ClearedChargeCode") ?>
<input type="hidden" data-table="charges" data-field="x_ClearedChargeCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $charges_list->ClearedChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]" id="x<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]" value="<?php echo $charges_list->ClearedChargeCode->CurrentValue ?>"<?php echo $charges_list->ClearedChargeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_ClearedChargeCode" name="o<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]" id="o<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]" value="<?php echo HtmlEncode($charges_list->ClearedChargeCode->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ClearedChargeCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_ClearedChargeCode"><?php echo EmptyValue(strval($charges_list->ClearedChargeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->ClearedChargeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->ClearedChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->ClearedChargeCode->ReadOnly || $charges_list->ClearedChargeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->ClearedChargeCode->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_ClearedChargeCode") ?>
<input type="hidden" data-table="charges" data-field="x_ClearedChargeCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $charges_list->ClearedChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]" id="x<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]" value="<?php echo $charges_list->ClearedChargeCode->CurrentValue ?>"<?php echo $charges_list->ClearedChargeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_ClearedChargeCode">
<span<?php echo $charges_list->ClearedChargeCode->viewAttributes() ?>><?php echo $charges_list->ClearedChargeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($charges_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $charges_list->PropertyUse->cellAttributes() ?>>
<?php if ($charges->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_PropertyUse" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_PropertyUse" data-value-separator="<?php echo $charges_list->PropertyUse->displayValueSeparatorAttribute() ?>" id="x<?php echo $charges_list->RowIndex ?>_PropertyUse" name="x<?php echo $charges_list->RowIndex ?>_PropertyUse"<?php echo $charges_list->PropertyUse->editAttributes() ?>>
			<?php echo $charges_list->PropertyUse->selectOptionListHtml("x{$charges_list->RowIndex}_PropertyUse") ?>
		</select>
</div>
<?php echo $charges_list->PropertyUse->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_PropertyUse") ?>
</span>
<input type="hidden" data-table="charges" data-field="x_PropertyUse" name="o<?php echo $charges_list->RowIndex ?>_PropertyUse" id="o<?php echo $charges_list->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($charges_list->PropertyUse->OldValue) ?>">
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_PropertyUse" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_PropertyUse" data-value-separator="<?php echo $charges_list->PropertyUse->displayValueSeparatorAttribute() ?>" id="x<?php echo $charges_list->RowIndex ?>_PropertyUse" name="x<?php echo $charges_list->RowIndex ?>_PropertyUse"<?php echo $charges_list->PropertyUse->editAttributes() ?>>
			<?php echo $charges_list->PropertyUse->selectOptionListHtml("x{$charges_list->RowIndex}_PropertyUse") ?>
		</select>
</div>
<?php echo $charges_list->PropertyUse->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_PropertyUse") ?>
</span>
<?php } ?>
<?php if ($charges->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $charges_list->RowCount ?>_charges_PropertyUse">
<span<?php echo $charges_list->PropertyUse->viewAttributes() ?>><?php echo $charges_list->PropertyUse->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$charges_list->ListOptions->render("body", "right", $charges_list->RowCount);
?>
	</tr>
<?php if ($charges->RowType == ROWTYPE_ADD || $charges->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fchargeslist", "load"], function() {
	fchargeslist.updateLists(<?php echo $charges_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$charges_list->isGridAdd())
		if (!$charges_list->Recordset->EOF)
			$charges_list->Recordset->moveNext();
}
?>
<?php
	if ($charges_list->isGridAdd() || $charges_list->isGridEdit()) {
		$charges_list->RowIndex = '$rowindex$';
		$charges_list->loadRowValues();

		// Set row properties
		$charges->resetAttributes();
		$charges->RowAttrs->merge(["data-rowindex" => $charges_list->RowIndex, "id" => "r0_charges", "data-rowtype" => ROWTYPE_ADD]);
		$charges->RowAttrs->appendClass("ew-template");
		$charges->RowType = ROWTYPE_ADD;

		// Render row
		$charges_list->renderRow();

		// Render list options
		$charges_list->renderListOptions();
		$charges_list->StartRowCount = 0;
?>
	<tr <?php echo $charges->rowAttributes() ?>>
<?php

// Render list options (body, left)
$charges_list->ListOptions->render("body", "left", $charges_list->RowIndex);
?>
	<?php if ($charges_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode">
<span id="el$rowindex$_charges_ChargeCode" class="form-group charges_ChargeCode"></span>
<input type="hidden" data-table="charges" data-field="x_ChargeCode" name="o<?php echo $charges_list->RowIndex ?>_ChargeCode" id="o<?php echo $charges_list->RowIndex ?>_ChargeCode" value="<?php echo HtmlEncode($charges_list->ChargeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->ChargeDesc->Visible) { // ChargeDesc ?>
		<td data-name="ChargeDesc">
<span id="el$rowindex$_charges_ChargeDesc" class="form-group charges_ChargeDesc">
<input type="text" data-table="charges" data-field="x_ChargeDesc" name="x<?php echo $charges_list->RowIndex ?>_ChargeDesc" id="x<?php echo $charges_list->RowIndex ?>_ChargeDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($charges_list->ChargeDesc->getPlaceHolder()) ?>" value="<?php echo $charges_list->ChargeDesc->EditValue ?>"<?php echo $charges_list->ChargeDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeDesc" name="o<?php echo $charges_list->RowIndex ?>_ChargeDesc" id="o<?php echo $charges_list->RowIndex ?>_ChargeDesc" value="<?php echo HtmlEncode($charges_list->ChargeDesc->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->Fee->Visible) { // Fee ?>
		<td data-name="Fee">
<span id="el$rowindex$_charges_Fee" class="form-group charges_Fee">
<input type="text" data-table="charges" data-field="x_Fee" name="x<?php echo $charges_list->RowIndex ?>_Fee" id="x<?php echo $charges_list->RowIndex ?>_Fee" size="30" placeholder="<?php echo HtmlEncode($charges_list->Fee->getPlaceHolder()) ?>" value="<?php echo $charges_list->Fee->EditValue ?>"<?php echo $charges_list->Fee->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_Fee" name="o<?php echo $charges_list->RowIndex ?>_Fee" id="o<?php echo $charges_list->RowIndex ?>_Fee" value="<?php echo HtmlEncode($charges_list->Fee->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->ChargeType->Visible) { // ChargeType ?>
		<td data-name="ChargeType">
<span id="el$rowindex$_charges_ChargeType" class="form-group charges_ChargeType">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_ChargeType"><?php echo EmptyValue(strval($charges_list->ChargeType->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->ChargeType->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->ChargeType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->ChargeType->ReadOnly || $charges_list->ChargeType->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_ChargeType',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->ChargeType->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_ChargeType") ?>
<input type="hidden" data-table="charges" data-field="x_ChargeType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_list->ChargeType->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_ChargeType" id="x<?php echo $charges_list->RowIndex ?>_ChargeType" value="<?php echo $charges_list->ChargeType->CurrentValue ?>"<?php echo $charges_list->ChargeType->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeType" name="o<?php echo $charges_list->RowIndex ?>_ChargeType" id="o<?php echo $charges_list->RowIndex ?>_ChargeType" value="<?php echo HtmlEncode($charges_list->ChargeType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->Frequency->Visible) { // Frequency ?>
		<td data-name="Frequency">
<span id="el$rowindex$_charges_Frequency" class="form-group charges_Frequency">
<input type="text" data-table="charges" data-field="x_Frequency" name="x<?php echo $charges_list->RowIndex ?>_Frequency" id="x<?php echo $charges_list->RowIndex ?>_Frequency" size="30" placeholder="<?php echo HtmlEncode($charges_list->Frequency->getPlaceHolder()) ?>" value="<?php echo $charges_list->Frequency->EditValue ?>"<?php echo $charges_list->Frequency->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_Frequency" name="o<?php echo $charges_list->RowIndex ?>_Frequency" id="o<?php echo $charges_list->RowIndex ?>_Frequency" value="<?php echo HtmlEncode($charges_list->Frequency->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->Installment->Visible) { // Installment ?>
		<td data-name="Installment">
<span id="el$rowindex$_charges_Installment" class="form-group charges_Installment">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_Installment" data-value-separator="<?php echo $charges_list->Installment->displayValueSeparatorAttribute() ?>" id="x<?php echo $charges_list->RowIndex ?>_Installment" name="x<?php echo $charges_list->RowIndex ?>_Installment"<?php echo $charges_list->Installment->editAttributes() ?>>
			<?php echo $charges_list->Installment->selectOptionListHtml("x{$charges_list->RowIndex}_Installment") ?>
		</select>
</div>
<?php echo $charges_list->Installment->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_Installment") ?>
</span>
<input type="hidden" data-table="charges" data-field="x_Installment" name="o<?php echo $charges_list->RowIndex ?>_Installment" id="o<?php echo $charges_list->RowIndex ?>_Installment" value="<?php echo HtmlEncode($charges_list->Installment->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<span id="el$rowindex$_charges_DepartmentCode" class="form-group charges_DepartmentCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_DepartmentCode"><?php echo EmptyValue(strval($charges_list->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->DepartmentCode->ReadOnly || $charges_list->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->DepartmentCode->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_DepartmentCode") ?>
<input type="hidden" data-table="charges" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_list->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_DepartmentCode" id="x<?php echo $charges_list->RowIndex ?>_DepartmentCode" value="<?php echo $charges_list->DepartmentCode->CurrentValue ?>"<?php echo $charges_list->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_DepartmentCode" name="o<?php echo $charges_list->RowIndex ?>_DepartmentCode" id="o<?php echo $charges_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($charges_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->GLAccount->Visible) { // GLAccount ?>
		<td data-name="GLAccount">
<span id="el$rowindex$_charges_GLAccount" class="form-group charges_GLAccount">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_GLAccount"><?php echo EmptyValue(strval($charges_list->GLAccount->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->GLAccount->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->GLAccount->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->GLAccount->ReadOnly || $charges_list->GLAccount->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_GLAccount',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->GLAccount->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_GLAccount") ?>
<input type="hidden" data-table="charges" data-field="x_GLAccount" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_list->GLAccount->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_GLAccount" id="x<?php echo $charges_list->RowIndex ?>_GLAccount" value="<?php echo $charges_list->GLAccount->CurrentValue ?>"<?php echo $charges_list->GLAccount->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_GLAccount" name="o<?php echo $charges_list->RowIndex ?>_GLAccount" id="o<?php echo $charges_list->RowIndex ?>_GLAccount" value="<?php echo HtmlEncode($charges_list->GLAccount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup">
<span id="el$rowindex$_charges_ChargeGroup" class="form-group charges_ChargeGroup">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_ChargeGroup" data-value-separator="<?php echo $charges_list->ChargeGroup->displayValueSeparatorAttribute() ?>" id="x<?php echo $charges_list->RowIndex ?>_ChargeGroup" name="x<?php echo $charges_list->RowIndex ?>_ChargeGroup"<?php echo $charges_list->ChargeGroup->editAttributes() ?>>
			<?php echo $charges_list->ChargeGroup->selectOptionListHtml("x{$charges_list->RowIndex}_ChargeGroup") ?>
		</select>
</div>
<?php echo $charges_list->ChargeGroup->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_ChargeGroup") ?>
</span>
<input type="hidden" data-table="charges" data-field="x_ChargeGroup" name="o<?php echo $charges_list->RowIndex ?>_ChargeGroup" id="o<?php echo $charges_list->RowIndex ?>_ChargeGroup" value="<?php echo HtmlEncode($charges_list->ChargeGroup->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure">
<span id="el$rowindex$_charges_UnitOfMeasure" class="form-group charges_UnitOfMeasure">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_UnitOfMeasure"><?php echo EmptyValue(strval($charges_list->UnitOfMeasure->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->UnitOfMeasure->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->UnitOfMeasure->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->UnitOfMeasure->ReadOnly || $charges_list->UnitOfMeasure->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_UnitOfMeasure',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->UnitOfMeasure->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_UnitOfMeasure") ?>
<input type="hidden" data-table="charges" data-field="x_UnitOfMeasure" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $charges_list->UnitOfMeasure->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_UnitOfMeasure" id="x<?php echo $charges_list->RowIndex ?>_UnitOfMeasure" value="<?php echo $charges_list->UnitOfMeasure->CurrentValue ?>"<?php echo $charges_list->UnitOfMeasure->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_UnitOfMeasure" name="o<?php echo $charges_list->RowIndex ?>_UnitOfMeasure" id="o<?php echo $charges_list->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($charges_list->UnitOfMeasure->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->Factor->Visible) { // Factor ?>
		<td data-name="Factor">
<span id="el$rowindex$_charges_Factor" class="form-group charges_Factor">
<input type="text" data-table="charges" data-field="x_Factor" name="x<?php echo $charges_list->RowIndex ?>_Factor" id="x<?php echo $charges_list->RowIndex ?>_Factor" size="30" placeholder="<?php echo HtmlEncode($charges_list->Factor->getPlaceHolder()) ?>" value="<?php echo $charges_list->Factor->EditValue ?>"<?php echo $charges_list->Factor->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_Factor" name="o<?php echo $charges_list->RowIndex ?>_Factor" id="o<?php echo $charges_list->RowIndex ?>_Factor" value="<?php echo HtmlEncode($charges_list->Factor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType">
<span id="el$rowindex$_charges_PeriodType" class="form-group charges_PeriodType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_PeriodType" data-value-separator="<?php echo $charges_list->PeriodType->displayValueSeparatorAttribute() ?>" id="x<?php echo $charges_list->RowIndex ?>_PeriodType" name="x<?php echo $charges_list->RowIndex ?>_PeriodType"<?php echo $charges_list->PeriodType->editAttributes() ?>>
			<?php echo $charges_list->PeriodType->selectOptionListHtml("x{$charges_list->RowIndex}_PeriodType") ?>
		</select>
</div>
<?php echo $charges_list->PeriodType->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_PeriodType") ?>
</span>
<input type="hidden" data-table="charges" data-field="x_PeriodType" name="o<?php echo $charges_list->RowIndex ?>_PeriodType" id="o<?php echo $charges_list->RowIndex ?>_PeriodType" value="<?php echo HtmlEncode($charges_list->PeriodType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->ClearedChargeCode->Visible) { // ClearedChargeCode ?>
		<td data-name="ClearedChargeCode">
<span id="el$rowindex$_charges_ClearedChargeCode" class="form-group charges_ClearedChargeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $charges_list->RowIndex ?>_ClearedChargeCode"><?php echo EmptyValue(strval($charges_list->ClearedChargeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $charges_list->ClearedChargeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($charges_list->ClearedChargeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($charges_list->ClearedChargeCode->ReadOnly || $charges_list->ClearedChargeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $charges_list->ClearedChargeCode->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_ClearedChargeCode") ?>
<input type="hidden" data-table="charges" data-field="x_ClearedChargeCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $charges_list->ClearedChargeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]" id="x<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]" value="<?php echo $charges_list->ClearedChargeCode->CurrentValue ?>"<?php echo $charges_list->ClearedChargeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="charges" data-field="x_ClearedChargeCode" name="o<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]" id="o<?php echo $charges_list->RowIndex ?>_ClearedChargeCode[]" value="<?php echo HtmlEncode($charges_list->ClearedChargeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($charges_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse">
<span id="el$rowindex$_charges_PropertyUse" class="form-group charges_PropertyUse">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="charges" data-field="x_PropertyUse" data-value-separator="<?php echo $charges_list->PropertyUse->displayValueSeparatorAttribute() ?>" id="x<?php echo $charges_list->RowIndex ?>_PropertyUse" name="x<?php echo $charges_list->RowIndex ?>_PropertyUse"<?php echo $charges_list->PropertyUse->editAttributes() ?>>
			<?php echo $charges_list->PropertyUse->selectOptionListHtml("x{$charges_list->RowIndex}_PropertyUse") ?>
		</select>
</div>
<?php echo $charges_list->PropertyUse->Lookup->getParamTag($charges_list, "p_x" . $charges_list->RowIndex . "_PropertyUse") ?>
</span>
<input type="hidden" data-table="charges" data-field="x_PropertyUse" name="o<?php echo $charges_list->RowIndex ?>_PropertyUse" id="o<?php echo $charges_list->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($charges_list->PropertyUse->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$charges_list->ListOptions->render("body", "right", $charges_list->RowIndex);
?>
<script>
loadjs.ready(["fchargeslist", "load"], function() {
	fchargeslist.updateLists(<?php echo $charges_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($charges_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $charges_list->FormKeyCountName ?>" id="<?php echo $charges_list->FormKeyCountName ?>" value="<?php echo $charges_list->KeyCount ?>">
<?php echo $charges_list->MultiSelectKey ?>
<?php } ?>
<?php if ($charges_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $charges_list->FormKeyCountName ?>" id="<?php echo $charges_list->FormKeyCountName ?>" value="<?php echo $charges_list->KeyCount ?>">
<?php echo $charges_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$charges->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($charges_list->Recordset)
	$charges_list->Recordset->Close();
?>
<?php if (!$charges_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$charges_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charges_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $charges_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($charges_list->TotalRecords == 0 && !$charges->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $charges_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$charges_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$charges_list->isExport()) { ?>
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
$charges_list->terminate();
?>