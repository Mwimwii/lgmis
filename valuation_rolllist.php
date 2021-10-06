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
$valuation_roll_list = new valuation_roll_list();

// Run the page
$valuation_roll_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$valuation_roll_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$valuation_roll_list->isExport()) { ?>
<script>
var fvaluation_rolllist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fvaluation_rolllist = currentForm = new ew.Form("fvaluation_rolllist", "list");
	fvaluation_rolllist.formKeyCountName = '<?php echo $valuation_roll_list->FormKeyCountName ?>';

	// Validate form
	fvaluation_rolllist.validate = function() {
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
			<?php if ($valuation_roll_list->PropertyNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $valuation_roll_list->PropertyNo->caption(), $valuation_roll_list->PropertyNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($valuation_roll_list->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $valuation_roll_list->Description->caption(), $valuation_roll_list->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($valuation_roll_list->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $valuation_roll_list->Location->caption(), $valuation_roll_list->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($valuation_roll_list->Leaseholder->Required) { ?>
				elm = this.getElements("x" + infix + "_Leaseholder");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $valuation_roll_list->Leaseholder->caption(), $valuation_roll_list->Leaseholder->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($valuation_roll_list->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $valuation_roll_list->PropertyUse->caption(), $valuation_roll_list->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($valuation_roll_list->LandExtent->Required) { ?>
				elm = this.getElements("x" + infix + "_LandExtent");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $valuation_roll_list->LandExtent->caption(), $valuation_roll_list->LandExtent->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LandExtent");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($valuation_roll_list->LandExtent->errorMessage()) ?>");
			<?php if ($valuation_roll_list->LandValue->Required) { ?>
				elm = this.getElements("x" + infix + "_LandValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $valuation_roll_list->LandValue->caption(), $valuation_roll_list->LandValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LandValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($valuation_roll_list->LandValue->errorMessage()) ?>");
			<?php if ($valuation_roll_list->ImprovementsValue->Required) { ?>
				elm = this.getElements("x" + infix + "_ImprovementsValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $valuation_roll_list->ImprovementsValue->caption(), $valuation_roll_list->ImprovementsValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ImprovementsValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($valuation_roll_list->ImprovementsValue->errorMessage()) ?>");
			<?php if ($valuation_roll_list->RateableValue->Required) { ?>
				elm = this.getElements("x" + infix + "_RateableValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $valuation_roll_list->RateableValue->caption(), $valuation_roll_list->RateableValue->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($valuation_roll_list->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $valuation_roll_list->Remarks->caption(), $valuation_roll_list->Remarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($valuation_roll_list->ValuationDate->Required) { ?>
				elm = this.getElements("x" + infix + "_ValuationDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $valuation_roll_list->ValuationDate->caption(), $valuation_roll_list->ValuationDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ValuationDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($valuation_roll_list->ValuationDate->errorMessage()) ?>");
			<?php if ($valuation_roll_list->ValuationReference->Required) { ?>
				elm = this.getElements("x" + infix + "_ValuationReference");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $valuation_roll_list->ValuationReference->caption(), $valuation_roll_list->ValuationReference->RequiredErrorMessage)) ?>");
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
	fvaluation_rolllist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "PropertyNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "Description", false)) return false;
		if (ew.valueChanged(fobj, infix, "Location", false)) return false;
		if (ew.valueChanged(fobj, infix, "Leaseholder", false)) return false;
		if (ew.valueChanged(fobj, infix, "PropertyUse", false)) return false;
		if (ew.valueChanged(fobj, infix, "LandExtent", false)) return false;
		if (ew.valueChanged(fobj, infix, "LandValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "ImprovementsValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "RateableValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "Remarks", false)) return false;
		if (ew.valueChanged(fobj, infix, "ValuationDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ValuationReference", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fvaluation_rolllist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fvaluation_rolllist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fvaluation_rolllist");
});
var fvaluation_rolllistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fvaluation_rolllistsrch = currentSearchForm = new ew.Form("fvaluation_rolllistsrch");

	// Dynamic selection lists
	// Filters

	fvaluation_rolllistsrch.filterList = <?php echo $valuation_roll_list->getFilterList() ?>;

	// Init search panel as collapsed
	fvaluation_rolllistsrch.initSearchPanel = true;
	loadjs.done("fvaluation_rolllistsrch");
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
<?php if (!$valuation_roll_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($valuation_roll_list->TotalRecords > 0 && $valuation_roll_list->ExportOptions->visible()) { ?>
<?php $valuation_roll_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($valuation_roll_list->ImportOptions->visible()) { ?>
<?php $valuation_roll_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($valuation_roll_list->SearchOptions->visible()) { ?>
<?php $valuation_roll_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($valuation_roll_list->FilterOptions->visible()) { ?>
<?php $valuation_roll_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$valuation_roll_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$valuation_roll_list->isExport() && !$valuation_roll->CurrentAction) { ?>
<form name="fvaluation_rolllistsrch" id="fvaluation_rolllistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fvaluation_rolllistsrch-search-panel" class="<?php echo $valuation_roll_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="valuation_roll">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $valuation_roll_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($valuation_roll_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($valuation_roll_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $valuation_roll_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($valuation_roll_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($valuation_roll_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($valuation_roll_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($valuation_roll_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $valuation_roll_list->showPageHeader(); ?>
<?php
$valuation_roll_list->showMessage();
?>
<?php if ($valuation_roll_list->TotalRecords > 0 || $valuation_roll->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($valuation_roll_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> valuation_roll">
<?php if (!$valuation_roll_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$valuation_roll_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $valuation_roll_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $valuation_roll_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvaluation_rolllist" id="fvaluation_rolllist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="valuation_roll">
<div id="gmp_valuation_roll" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($valuation_roll_list->TotalRecords > 0 || $valuation_roll_list->isGridEdit()) { ?>
<table id="tbl_valuation_rolllist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$valuation_roll->RowType = ROWTYPE_HEADER;

// Render list options
$valuation_roll_list->renderListOptions();

// Render list options (header, left)
$valuation_roll_list->ListOptions->render("header", "left");
?>
<?php if ($valuation_roll_list->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($valuation_roll_list->SortUrl($valuation_roll_list->PropertyNo) == "") { ?>
		<th data-name="PropertyNo" class="<?php echo $valuation_roll_list->PropertyNo->headerCellClass() ?>"><div id="elh_valuation_roll_PropertyNo" class="valuation_roll_PropertyNo"><div class="ew-table-header-caption"><?php echo $valuation_roll_list->PropertyNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyNo" class="<?php echo $valuation_roll_list->PropertyNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valuation_roll_list->SortUrl($valuation_roll_list->PropertyNo) ?>', 1);"><div id="elh_valuation_roll_PropertyNo" class="valuation_roll_PropertyNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valuation_roll_list->PropertyNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($valuation_roll_list->PropertyNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valuation_roll_list->PropertyNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valuation_roll_list->Description->Visible) { // Description ?>
	<?php if ($valuation_roll_list->SortUrl($valuation_roll_list->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $valuation_roll_list->Description->headerCellClass() ?>"><div id="elh_valuation_roll_Description" class="valuation_roll_Description"><div class="ew-table-header-caption"><?php echo $valuation_roll_list->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $valuation_roll_list->Description->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valuation_roll_list->SortUrl($valuation_roll_list->Description) ?>', 1);"><div id="elh_valuation_roll_Description" class="valuation_roll_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valuation_roll_list->Description->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($valuation_roll_list->Description->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valuation_roll_list->Description->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valuation_roll_list->Location->Visible) { // Location ?>
	<?php if ($valuation_roll_list->SortUrl($valuation_roll_list->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $valuation_roll_list->Location->headerCellClass() ?>"><div id="elh_valuation_roll_Location" class="valuation_roll_Location"><div class="ew-table-header-caption"><?php echo $valuation_roll_list->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $valuation_roll_list->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valuation_roll_list->SortUrl($valuation_roll_list->Location) ?>', 1);"><div id="elh_valuation_roll_Location" class="valuation_roll_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valuation_roll_list->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($valuation_roll_list->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valuation_roll_list->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valuation_roll_list->Leaseholder->Visible) { // Leaseholder ?>
	<?php if ($valuation_roll_list->SortUrl($valuation_roll_list->Leaseholder) == "") { ?>
		<th data-name="Leaseholder" class="<?php echo $valuation_roll_list->Leaseholder->headerCellClass() ?>"><div id="elh_valuation_roll_Leaseholder" class="valuation_roll_Leaseholder"><div class="ew-table-header-caption"><?php echo $valuation_roll_list->Leaseholder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Leaseholder" class="<?php echo $valuation_roll_list->Leaseholder->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valuation_roll_list->SortUrl($valuation_roll_list->Leaseholder) ?>', 1);"><div id="elh_valuation_roll_Leaseholder" class="valuation_roll_Leaseholder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valuation_roll_list->Leaseholder->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($valuation_roll_list->Leaseholder->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valuation_roll_list->Leaseholder->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valuation_roll_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($valuation_roll_list->SortUrl($valuation_roll_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $valuation_roll_list->PropertyUse->headerCellClass() ?>"><div id="elh_valuation_roll_PropertyUse" class="valuation_roll_PropertyUse"><div class="ew-table-header-caption"><?php echo $valuation_roll_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $valuation_roll_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valuation_roll_list->SortUrl($valuation_roll_list->PropertyUse) ?>', 1);"><div id="elh_valuation_roll_PropertyUse" class="valuation_roll_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valuation_roll_list->PropertyUse->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($valuation_roll_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valuation_roll_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valuation_roll_list->LandExtent->Visible) { // LandExtent ?>
	<?php if ($valuation_roll_list->SortUrl($valuation_roll_list->LandExtent) == "") { ?>
		<th data-name="LandExtent" class="<?php echo $valuation_roll_list->LandExtent->headerCellClass() ?>"><div id="elh_valuation_roll_LandExtent" class="valuation_roll_LandExtent"><div class="ew-table-header-caption"><?php echo $valuation_roll_list->LandExtent->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LandExtent" class="<?php echo $valuation_roll_list->LandExtent->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valuation_roll_list->SortUrl($valuation_roll_list->LandExtent) ?>', 1);"><div id="elh_valuation_roll_LandExtent" class="valuation_roll_LandExtent">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valuation_roll_list->LandExtent->caption() ?></span><span class="ew-table-header-sort"><?php if ($valuation_roll_list->LandExtent->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valuation_roll_list->LandExtent->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valuation_roll_list->LandValue->Visible) { // LandValue ?>
	<?php if ($valuation_roll_list->SortUrl($valuation_roll_list->LandValue) == "") { ?>
		<th data-name="LandValue" class="<?php echo $valuation_roll_list->LandValue->headerCellClass() ?>"><div id="elh_valuation_roll_LandValue" class="valuation_roll_LandValue"><div class="ew-table-header-caption"><?php echo $valuation_roll_list->LandValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LandValue" class="<?php echo $valuation_roll_list->LandValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valuation_roll_list->SortUrl($valuation_roll_list->LandValue) ?>', 1);"><div id="elh_valuation_roll_LandValue" class="valuation_roll_LandValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valuation_roll_list->LandValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($valuation_roll_list->LandValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valuation_roll_list->LandValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valuation_roll_list->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<?php if ($valuation_roll_list->SortUrl($valuation_roll_list->ImprovementsValue) == "") { ?>
		<th data-name="ImprovementsValue" class="<?php echo $valuation_roll_list->ImprovementsValue->headerCellClass() ?>"><div id="elh_valuation_roll_ImprovementsValue" class="valuation_roll_ImprovementsValue"><div class="ew-table-header-caption"><?php echo $valuation_roll_list->ImprovementsValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ImprovementsValue" class="<?php echo $valuation_roll_list->ImprovementsValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valuation_roll_list->SortUrl($valuation_roll_list->ImprovementsValue) ?>', 1);"><div id="elh_valuation_roll_ImprovementsValue" class="valuation_roll_ImprovementsValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valuation_roll_list->ImprovementsValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($valuation_roll_list->ImprovementsValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valuation_roll_list->ImprovementsValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valuation_roll_list->RateableValue->Visible) { // RateableValue ?>
	<?php if ($valuation_roll_list->SortUrl($valuation_roll_list->RateableValue) == "") { ?>
		<th data-name="RateableValue" class="<?php echo $valuation_roll_list->RateableValue->headerCellClass() ?>"><div id="elh_valuation_roll_RateableValue" class="valuation_roll_RateableValue"><div class="ew-table-header-caption"><?php echo $valuation_roll_list->RateableValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RateableValue" class="<?php echo $valuation_roll_list->RateableValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valuation_roll_list->SortUrl($valuation_roll_list->RateableValue) ?>', 1);"><div id="elh_valuation_roll_RateableValue" class="valuation_roll_RateableValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valuation_roll_list->RateableValue->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($valuation_roll_list->RateableValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valuation_roll_list->RateableValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valuation_roll_list->Remarks->Visible) { // Remarks ?>
	<?php if ($valuation_roll_list->SortUrl($valuation_roll_list->Remarks) == "") { ?>
		<th data-name="Remarks" class="<?php echo $valuation_roll_list->Remarks->headerCellClass() ?>"><div id="elh_valuation_roll_Remarks" class="valuation_roll_Remarks"><div class="ew-table-header-caption"><?php echo $valuation_roll_list->Remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Remarks" class="<?php echo $valuation_roll_list->Remarks->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valuation_roll_list->SortUrl($valuation_roll_list->Remarks) ?>', 1);"><div id="elh_valuation_roll_Remarks" class="valuation_roll_Remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valuation_roll_list->Remarks->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($valuation_roll_list->Remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valuation_roll_list->Remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valuation_roll_list->ValuationDate->Visible) { // ValuationDate ?>
	<?php if ($valuation_roll_list->SortUrl($valuation_roll_list->ValuationDate) == "") { ?>
		<th data-name="ValuationDate" class="<?php echo $valuation_roll_list->ValuationDate->headerCellClass() ?>"><div id="elh_valuation_roll_ValuationDate" class="valuation_roll_ValuationDate"><div class="ew-table-header-caption"><?php echo $valuation_roll_list->ValuationDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValuationDate" class="<?php echo $valuation_roll_list->ValuationDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valuation_roll_list->SortUrl($valuation_roll_list->ValuationDate) ?>', 1);"><div id="elh_valuation_roll_ValuationDate" class="valuation_roll_ValuationDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valuation_roll_list->ValuationDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($valuation_roll_list->ValuationDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valuation_roll_list->ValuationDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($valuation_roll_list->ValuationReference->Visible) { // ValuationReference ?>
	<?php if ($valuation_roll_list->SortUrl($valuation_roll_list->ValuationReference) == "") { ?>
		<th data-name="ValuationReference" class="<?php echo $valuation_roll_list->ValuationReference->headerCellClass() ?>"><div id="elh_valuation_roll_ValuationReference" class="valuation_roll_ValuationReference"><div class="ew-table-header-caption"><?php echo $valuation_roll_list->ValuationReference->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValuationReference" class="<?php echo $valuation_roll_list->ValuationReference->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $valuation_roll_list->SortUrl($valuation_roll_list->ValuationReference) ?>', 1);"><div id="elh_valuation_roll_ValuationReference" class="valuation_roll_ValuationReference">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $valuation_roll_list->ValuationReference->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($valuation_roll_list->ValuationReference->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($valuation_roll_list->ValuationReference->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$valuation_roll_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($valuation_roll_list->ExportAll && $valuation_roll_list->isExport()) {
	$valuation_roll_list->StopRecord = $valuation_roll_list->TotalRecords;
} else {

	// Set the last record to display
	if ($valuation_roll_list->TotalRecords > $valuation_roll_list->StartRecord + $valuation_roll_list->DisplayRecords - 1)
		$valuation_roll_list->StopRecord = $valuation_roll_list->StartRecord + $valuation_roll_list->DisplayRecords - 1;
	else
		$valuation_roll_list->StopRecord = $valuation_roll_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($valuation_roll->isConfirm() || $valuation_roll_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($valuation_roll_list->FormKeyCountName) && ($valuation_roll_list->isGridAdd() || $valuation_roll_list->isGridEdit() || $valuation_roll->isConfirm())) {
		$valuation_roll_list->KeyCount = $CurrentForm->getValue($valuation_roll_list->FormKeyCountName);
		$valuation_roll_list->StopRecord = $valuation_roll_list->StartRecord + $valuation_roll_list->KeyCount - 1;
	}
}
$valuation_roll_list->RecordCount = $valuation_roll_list->StartRecord - 1;
if ($valuation_roll_list->Recordset && !$valuation_roll_list->Recordset->EOF) {
	$valuation_roll_list->Recordset->moveFirst();
	$selectLimit = $valuation_roll_list->UseSelectLimit;
	if (!$selectLimit && $valuation_roll_list->StartRecord > 1)
		$valuation_roll_list->Recordset->move($valuation_roll_list->StartRecord - 1);
} elseif (!$valuation_roll->AllowAddDeleteRow && $valuation_roll_list->StopRecord == 0) {
	$valuation_roll_list->StopRecord = $valuation_roll->GridAddRowCount;
}

// Initialize aggregate
$valuation_roll->RowType = ROWTYPE_AGGREGATEINIT;
$valuation_roll->resetAttributes();
$valuation_roll_list->renderRow();
if ($valuation_roll_list->isGridAdd())
	$valuation_roll_list->RowIndex = 0;
while ($valuation_roll_list->RecordCount < $valuation_roll_list->StopRecord) {
	$valuation_roll_list->RecordCount++;
	if ($valuation_roll_list->RecordCount >= $valuation_roll_list->StartRecord) {
		$valuation_roll_list->RowCount++;
		if ($valuation_roll_list->isGridAdd() || $valuation_roll_list->isGridEdit() || $valuation_roll->isConfirm()) {
			$valuation_roll_list->RowIndex++;
			$CurrentForm->Index = $valuation_roll_list->RowIndex;
			if ($CurrentForm->hasValue($valuation_roll_list->FormActionName) && ($valuation_roll->isConfirm() || $valuation_roll_list->EventCancelled))
				$valuation_roll_list->RowAction = strval($CurrentForm->getValue($valuation_roll_list->FormActionName));
			elseif ($valuation_roll_list->isGridAdd())
				$valuation_roll_list->RowAction = "insert";
			else
				$valuation_roll_list->RowAction = "";
		}

		// Set up key count
		$valuation_roll_list->KeyCount = $valuation_roll_list->RowIndex;

		// Init row class and style
		$valuation_roll->resetAttributes();
		$valuation_roll->CssClass = "";
		if ($valuation_roll_list->isGridAdd()) {
			$valuation_roll_list->loadRowValues(); // Load default values
		} else {
			$valuation_roll_list->loadRowValues($valuation_roll_list->Recordset); // Load row values
		}
		$valuation_roll->RowType = ROWTYPE_VIEW; // Render view
		if ($valuation_roll_list->isGridAdd()) // Grid add
			$valuation_roll->RowType = ROWTYPE_ADD; // Render add
		if ($valuation_roll_list->isGridAdd() && $valuation_roll->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$valuation_roll_list->restoreCurrentRowFormValues($valuation_roll_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$valuation_roll->RowAttrs->merge(["data-rowindex" => $valuation_roll_list->RowCount, "id" => "r" . $valuation_roll_list->RowCount . "_valuation_roll", "data-rowtype" => $valuation_roll->RowType]);

		// Render row
		$valuation_roll_list->renderRow();

		// Render list options
		$valuation_roll_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($valuation_roll_list->RowAction != "delete" && $valuation_roll_list->RowAction != "insertdelete" && !($valuation_roll_list->RowAction == "insert" && $valuation_roll->isConfirm() && $valuation_roll_list->emptyRow())) {
?>
	<tr <?php echo $valuation_roll->rowAttributes() ?>>
<?php

// Render list options (body, left)
$valuation_roll_list->ListOptions->render("body", "left", $valuation_roll_list->RowCount);
?>
	<?php if ($valuation_roll_list->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo" <?php echo $valuation_roll_list->PropertyNo->cellAttributes() ?>>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_PropertyNo" class="form-group">
<input type="text" data-table="valuation_roll" data-field="x_PropertyNo" name="x<?php echo $valuation_roll_list->RowIndex ?>_PropertyNo" id="x<?php echo $valuation_roll_list->RowIndex ?>_PropertyNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->PropertyNo->EditValue ?>"<?php echo $valuation_roll_list->PropertyNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_PropertyNo" name="o<?php echo $valuation_roll_list->RowIndex ?>_PropertyNo" id="o<?php echo $valuation_roll_list->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($valuation_roll_list->PropertyNo->OldValue) ?>">
<?php } ?>
<?php if ($valuation_roll->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_PropertyNo">
<span<?php echo $valuation_roll_list->PropertyNo->viewAttributes() ?>><?php echo $valuation_roll_list->PropertyNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->Description->Visible) { // Description ?>
		<td data-name="Description" <?php echo $valuation_roll_list->Description->cellAttributes() ?>>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_Description" class="form-group">
<input type="text" data-table="valuation_roll" data-field="x_Description" name="x<?php echo $valuation_roll_list->RowIndex ?>_Description" id="x<?php echo $valuation_roll_list->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->Description->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->Description->EditValue ?>"<?php echo $valuation_roll_list->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_Description" name="o<?php echo $valuation_roll_list->RowIndex ?>_Description" id="o<?php echo $valuation_roll_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($valuation_roll_list->Description->OldValue) ?>">
<?php } ?>
<?php if ($valuation_roll->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_Description">
<span<?php echo $valuation_roll_list->Description->viewAttributes() ?>><?php echo $valuation_roll_list->Description->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $valuation_roll_list->Location->cellAttributes() ?>>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_Location" class="form-group">
<input type="text" data-table="valuation_roll" data-field="x_Location" name="x<?php echo $valuation_roll_list->RowIndex ?>_Location" id="x<?php echo $valuation_roll_list->RowIndex ?>_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->Location->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->Location->EditValue ?>"<?php echo $valuation_roll_list->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_Location" name="o<?php echo $valuation_roll_list->RowIndex ?>_Location" id="o<?php echo $valuation_roll_list->RowIndex ?>_Location" value="<?php echo HtmlEncode($valuation_roll_list->Location->OldValue) ?>">
<?php } ?>
<?php if ($valuation_roll->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_Location">
<span<?php echo $valuation_roll_list->Location->viewAttributes() ?>><?php echo $valuation_roll_list->Location->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->Leaseholder->Visible) { // Leaseholder ?>
		<td data-name="Leaseholder" <?php echo $valuation_roll_list->Leaseholder->cellAttributes() ?>>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_Leaseholder" class="form-group">
<input type="text" data-table="valuation_roll" data-field="x_Leaseholder" name="x<?php echo $valuation_roll_list->RowIndex ?>_Leaseholder" id="x<?php echo $valuation_roll_list->RowIndex ?>_Leaseholder" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->Leaseholder->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->Leaseholder->EditValue ?>"<?php echo $valuation_roll_list->Leaseholder->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_Leaseholder" name="o<?php echo $valuation_roll_list->RowIndex ?>_Leaseholder" id="o<?php echo $valuation_roll_list->RowIndex ?>_Leaseholder" value="<?php echo HtmlEncode($valuation_roll_list->Leaseholder->OldValue) ?>">
<?php } ?>
<?php if ($valuation_roll->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_Leaseholder">
<span<?php echo $valuation_roll_list->Leaseholder->viewAttributes() ?>><?php echo $valuation_roll_list->Leaseholder->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $valuation_roll_list->PropertyUse->cellAttributes() ?>>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_PropertyUse" class="form-group">
<input type="text" data-table="valuation_roll" data-field="x_PropertyUse" name="x<?php echo $valuation_roll_list->RowIndex ?>_PropertyUse" id="x<?php echo $valuation_roll_list->RowIndex ?>_PropertyUse" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->PropertyUse->EditValue ?>"<?php echo $valuation_roll_list->PropertyUse->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_PropertyUse" name="o<?php echo $valuation_roll_list->RowIndex ?>_PropertyUse" id="o<?php echo $valuation_roll_list->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($valuation_roll_list->PropertyUse->OldValue) ?>">
<?php } ?>
<?php if ($valuation_roll->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_PropertyUse">
<span<?php echo $valuation_roll_list->PropertyUse->viewAttributes() ?>><?php echo $valuation_roll_list->PropertyUse->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->LandExtent->Visible) { // LandExtent ?>
		<td data-name="LandExtent" <?php echo $valuation_roll_list->LandExtent->cellAttributes() ?>>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_LandExtent" class="form-group">
<input type="text" data-table="valuation_roll" data-field="x_LandExtent" name="x<?php echo $valuation_roll_list->RowIndex ?>_LandExtent" id="x<?php echo $valuation_roll_list->RowIndex ?>_LandExtent" size="30" placeholder="<?php echo HtmlEncode($valuation_roll_list->LandExtent->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->LandExtent->EditValue ?>"<?php echo $valuation_roll_list->LandExtent->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_LandExtent" name="o<?php echo $valuation_roll_list->RowIndex ?>_LandExtent" id="o<?php echo $valuation_roll_list->RowIndex ?>_LandExtent" value="<?php echo HtmlEncode($valuation_roll_list->LandExtent->OldValue) ?>">
<?php } ?>
<?php if ($valuation_roll->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_LandExtent">
<span<?php echo $valuation_roll_list->LandExtent->viewAttributes() ?>><?php echo $valuation_roll_list->LandExtent->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->LandValue->Visible) { // LandValue ?>
		<td data-name="LandValue" <?php echo $valuation_roll_list->LandValue->cellAttributes() ?>>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_LandValue" class="form-group">
<input type="text" data-table="valuation_roll" data-field="x_LandValue" name="x<?php echo $valuation_roll_list->RowIndex ?>_LandValue" id="x<?php echo $valuation_roll_list->RowIndex ?>_LandValue" size="30" placeholder="<?php echo HtmlEncode($valuation_roll_list->LandValue->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->LandValue->EditValue ?>"<?php echo $valuation_roll_list->LandValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_LandValue" name="o<?php echo $valuation_roll_list->RowIndex ?>_LandValue" id="o<?php echo $valuation_roll_list->RowIndex ?>_LandValue" value="<?php echo HtmlEncode($valuation_roll_list->LandValue->OldValue) ?>">
<?php } ?>
<?php if ($valuation_roll->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_LandValue">
<span<?php echo $valuation_roll_list->LandValue->viewAttributes() ?>><?php echo $valuation_roll_list->LandValue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->ImprovementsValue->Visible) { // ImprovementsValue ?>
		<td data-name="ImprovementsValue" <?php echo $valuation_roll_list->ImprovementsValue->cellAttributes() ?>>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_ImprovementsValue" class="form-group">
<input type="text" data-table="valuation_roll" data-field="x_ImprovementsValue" name="x<?php echo $valuation_roll_list->RowIndex ?>_ImprovementsValue" id="x<?php echo $valuation_roll_list->RowIndex ?>_ImprovementsValue" size="30" placeholder="<?php echo HtmlEncode($valuation_roll_list->ImprovementsValue->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->ImprovementsValue->EditValue ?>"<?php echo $valuation_roll_list->ImprovementsValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_ImprovementsValue" name="o<?php echo $valuation_roll_list->RowIndex ?>_ImprovementsValue" id="o<?php echo $valuation_roll_list->RowIndex ?>_ImprovementsValue" value="<?php echo HtmlEncode($valuation_roll_list->ImprovementsValue->OldValue) ?>">
<?php } ?>
<?php if ($valuation_roll->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_ImprovementsValue">
<span<?php echo $valuation_roll_list->ImprovementsValue->viewAttributes() ?>><?php echo $valuation_roll_list->ImprovementsValue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->RateableValue->Visible) { // RateableValue ?>
		<td data-name="RateableValue" <?php echo $valuation_roll_list->RateableValue->cellAttributes() ?>>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_RateableValue" class="form-group">
<input type="text" data-table="valuation_roll" data-field="x_RateableValue" name="x<?php echo $valuation_roll_list->RowIndex ?>_RateableValue" id="x<?php echo $valuation_roll_list->RowIndex ?>_RateableValue" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->RateableValue->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->RateableValue->EditValue ?>"<?php echo $valuation_roll_list->RateableValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_RateableValue" name="o<?php echo $valuation_roll_list->RowIndex ?>_RateableValue" id="o<?php echo $valuation_roll_list->RowIndex ?>_RateableValue" value="<?php echo HtmlEncode($valuation_roll_list->RateableValue->OldValue) ?>">
<?php } ?>
<?php if ($valuation_roll->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_RateableValue">
<span<?php echo $valuation_roll_list->RateableValue->viewAttributes() ?>><?php echo $valuation_roll_list->RateableValue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks" <?php echo $valuation_roll_list->Remarks->cellAttributes() ?>>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_Remarks" class="form-group">
<input type="text" data-table="valuation_roll" data-field="x_Remarks" name="x<?php echo $valuation_roll_list->RowIndex ?>_Remarks" id="x<?php echo $valuation_roll_list->RowIndex ?>_Remarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->Remarks->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->Remarks->EditValue ?>"<?php echo $valuation_roll_list->Remarks->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_Remarks" name="o<?php echo $valuation_roll_list->RowIndex ?>_Remarks" id="o<?php echo $valuation_roll_list->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($valuation_roll_list->Remarks->OldValue) ?>">
<?php } ?>
<?php if ($valuation_roll->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_Remarks">
<span<?php echo $valuation_roll_list->Remarks->viewAttributes() ?>><?php echo $valuation_roll_list->Remarks->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->ValuationDate->Visible) { // ValuationDate ?>
		<td data-name="ValuationDate" <?php echo $valuation_roll_list->ValuationDate->cellAttributes() ?>>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_ValuationDate" class="form-group">
<input type="text" data-table="valuation_roll" data-field="x_ValuationDate" name="x<?php echo $valuation_roll_list->RowIndex ?>_ValuationDate" id="x<?php echo $valuation_roll_list->RowIndex ?>_ValuationDate" placeholder="<?php echo HtmlEncode($valuation_roll_list->ValuationDate->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->ValuationDate->EditValue ?>"<?php echo $valuation_roll_list->ValuationDate->editAttributes() ?>>
<?php if (!$valuation_roll_list->ValuationDate->ReadOnly && !$valuation_roll_list->ValuationDate->Disabled && !isset($valuation_roll_list->ValuationDate->EditAttrs["readonly"]) && !isset($valuation_roll_list->ValuationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fvaluation_rolllist", "datetimepicker"], function() {
	ew.createDateTimePicker("fvaluation_rolllist", "x<?php echo $valuation_roll_list->RowIndex ?>_ValuationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_ValuationDate" name="o<?php echo $valuation_roll_list->RowIndex ?>_ValuationDate" id="o<?php echo $valuation_roll_list->RowIndex ?>_ValuationDate" value="<?php echo HtmlEncode($valuation_roll_list->ValuationDate->OldValue) ?>">
<?php } ?>
<?php if ($valuation_roll->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_ValuationDate">
<span<?php echo $valuation_roll_list->ValuationDate->viewAttributes() ?>><?php echo $valuation_roll_list->ValuationDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->ValuationReference->Visible) { // ValuationReference ?>
		<td data-name="ValuationReference" <?php echo $valuation_roll_list->ValuationReference->cellAttributes() ?>>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_ValuationReference" class="form-group">
<input type="text" data-table="valuation_roll" data-field="x_ValuationReference" name="x<?php echo $valuation_roll_list->RowIndex ?>_ValuationReference" id="x<?php echo $valuation_roll_list->RowIndex ?>_ValuationReference" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->ValuationReference->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->ValuationReference->EditValue ?>"<?php echo $valuation_roll_list->ValuationReference->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_ValuationReference" name="o<?php echo $valuation_roll_list->RowIndex ?>_ValuationReference" id="o<?php echo $valuation_roll_list->RowIndex ?>_ValuationReference" value="<?php echo HtmlEncode($valuation_roll_list->ValuationReference->OldValue) ?>">
<?php } ?>
<?php if ($valuation_roll->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $valuation_roll_list->RowCount ?>_valuation_roll_ValuationReference">
<span<?php echo $valuation_roll_list->ValuationReference->viewAttributes() ?>><?php echo $valuation_roll_list->ValuationReference->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$valuation_roll_list->ListOptions->render("body", "right", $valuation_roll_list->RowCount);
?>
	</tr>
<?php if ($valuation_roll->RowType == ROWTYPE_ADD || $valuation_roll->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fvaluation_rolllist", "load"], function() {
	fvaluation_rolllist.updateLists(<?php echo $valuation_roll_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$valuation_roll_list->isGridAdd())
		if (!$valuation_roll_list->Recordset->EOF)
			$valuation_roll_list->Recordset->moveNext();
}
?>
<?php
	if ($valuation_roll_list->isGridAdd() || $valuation_roll_list->isGridEdit()) {
		$valuation_roll_list->RowIndex = '$rowindex$';
		$valuation_roll_list->loadRowValues();

		// Set row properties
		$valuation_roll->resetAttributes();
		$valuation_roll->RowAttrs->merge(["data-rowindex" => $valuation_roll_list->RowIndex, "id" => "r0_valuation_roll", "data-rowtype" => ROWTYPE_ADD]);
		$valuation_roll->RowAttrs->appendClass("ew-template");
		$valuation_roll->RowType = ROWTYPE_ADD;

		// Render row
		$valuation_roll_list->renderRow();

		// Render list options
		$valuation_roll_list->renderListOptions();
		$valuation_roll_list->StartRowCount = 0;
?>
	<tr <?php echo $valuation_roll->rowAttributes() ?>>
<?php

// Render list options (body, left)
$valuation_roll_list->ListOptions->render("body", "left", $valuation_roll_list->RowIndex);
?>
	<?php if ($valuation_roll_list->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo">
<span id="el$rowindex$_valuation_roll_PropertyNo" class="form-group valuation_roll_PropertyNo">
<input type="text" data-table="valuation_roll" data-field="x_PropertyNo" name="x<?php echo $valuation_roll_list->RowIndex ?>_PropertyNo" id="x<?php echo $valuation_roll_list->RowIndex ?>_PropertyNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->PropertyNo->EditValue ?>"<?php echo $valuation_roll_list->PropertyNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_PropertyNo" name="o<?php echo $valuation_roll_list->RowIndex ?>_PropertyNo" id="o<?php echo $valuation_roll_list->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($valuation_roll_list->PropertyNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->Description->Visible) { // Description ?>
		<td data-name="Description">
<span id="el$rowindex$_valuation_roll_Description" class="form-group valuation_roll_Description">
<input type="text" data-table="valuation_roll" data-field="x_Description" name="x<?php echo $valuation_roll_list->RowIndex ?>_Description" id="x<?php echo $valuation_roll_list->RowIndex ?>_Description" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->Description->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->Description->EditValue ?>"<?php echo $valuation_roll_list->Description->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_Description" name="o<?php echo $valuation_roll_list->RowIndex ?>_Description" id="o<?php echo $valuation_roll_list->RowIndex ?>_Description" value="<?php echo HtmlEncode($valuation_roll_list->Description->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->Location->Visible) { // Location ?>
		<td data-name="Location">
<span id="el$rowindex$_valuation_roll_Location" class="form-group valuation_roll_Location">
<input type="text" data-table="valuation_roll" data-field="x_Location" name="x<?php echo $valuation_roll_list->RowIndex ?>_Location" id="x<?php echo $valuation_roll_list->RowIndex ?>_Location" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->Location->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->Location->EditValue ?>"<?php echo $valuation_roll_list->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_Location" name="o<?php echo $valuation_roll_list->RowIndex ?>_Location" id="o<?php echo $valuation_roll_list->RowIndex ?>_Location" value="<?php echo HtmlEncode($valuation_roll_list->Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->Leaseholder->Visible) { // Leaseholder ?>
		<td data-name="Leaseholder">
<span id="el$rowindex$_valuation_roll_Leaseholder" class="form-group valuation_roll_Leaseholder">
<input type="text" data-table="valuation_roll" data-field="x_Leaseholder" name="x<?php echo $valuation_roll_list->RowIndex ?>_Leaseholder" id="x<?php echo $valuation_roll_list->RowIndex ?>_Leaseholder" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->Leaseholder->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->Leaseholder->EditValue ?>"<?php echo $valuation_roll_list->Leaseholder->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_Leaseholder" name="o<?php echo $valuation_roll_list->RowIndex ?>_Leaseholder" id="o<?php echo $valuation_roll_list->RowIndex ?>_Leaseholder" value="<?php echo HtmlEncode($valuation_roll_list->Leaseholder->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse">
<span id="el$rowindex$_valuation_roll_PropertyUse" class="form-group valuation_roll_PropertyUse">
<input type="text" data-table="valuation_roll" data-field="x_PropertyUse" name="x<?php echo $valuation_roll_list->RowIndex ?>_PropertyUse" id="x<?php echo $valuation_roll_list->RowIndex ?>_PropertyUse" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->PropertyUse->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->PropertyUse->EditValue ?>"<?php echo $valuation_roll_list->PropertyUse->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_PropertyUse" name="o<?php echo $valuation_roll_list->RowIndex ?>_PropertyUse" id="o<?php echo $valuation_roll_list->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($valuation_roll_list->PropertyUse->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->LandExtent->Visible) { // LandExtent ?>
		<td data-name="LandExtent">
<span id="el$rowindex$_valuation_roll_LandExtent" class="form-group valuation_roll_LandExtent">
<input type="text" data-table="valuation_roll" data-field="x_LandExtent" name="x<?php echo $valuation_roll_list->RowIndex ?>_LandExtent" id="x<?php echo $valuation_roll_list->RowIndex ?>_LandExtent" size="30" placeholder="<?php echo HtmlEncode($valuation_roll_list->LandExtent->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->LandExtent->EditValue ?>"<?php echo $valuation_roll_list->LandExtent->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_LandExtent" name="o<?php echo $valuation_roll_list->RowIndex ?>_LandExtent" id="o<?php echo $valuation_roll_list->RowIndex ?>_LandExtent" value="<?php echo HtmlEncode($valuation_roll_list->LandExtent->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->LandValue->Visible) { // LandValue ?>
		<td data-name="LandValue">
<span id="el$rowindex$_valuation_roll_LandValue" class="form-group valuation_roll_LandValue">
<input type="text" data-table="valuation_roll" data-field="x_LandValue" name="x<?php echo $valuation_roll_list->RowIndex ?>_LandValue" id="x<?php echo $valuation_roll_list->RowIndex ?>_LandValue" size="30" placeholder="<?php echo HtmlEncode($valuation_roll_list->LandValue->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->LandValue->EditValue ?>"<?php echo $valuation_roll_list->LandValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_LandValue" name="o<?php echo $valuation_roll_list->RowIndex ?>_LandValue" id="o<?php echo $valuation_roll_list->RowIndex ?>_LandValue" value="<?php echo HtmlEncode($valuation_roll_list->LandValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->ImprovementsValue->Visible) { // ImprovementsValue ?>
		<td data-name="ImprovementsValue">
<span id="el$rowindex$_valuation_roll_ImprovementsValue" class="form-group valuation_roll_ImprovementsValue">
<input type="text" data-table="valuation_roll" data-field="x_ImprovementsValue" name="x<?php echo $valuation_roll_list->RowIndex ?>_ImprovementsValue" id="x<?php echo $valuation_roll_list->RowIndex ?>_ImprovementsValue" size="30" placeholder="<?php echo HtmlEncode($valuation_roll_list->ImprovementsValue->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->ImprovementsValue->EditValue ?>"<?php echo $valuation_roll_list->ImprovementsValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_ImprovementsValue" name="o<?php echo $valuation_roll_list->RowIndex ?>_ImprovementsValue" id="o<?php echo $valuation_roll_list->RowIndex ?>_ImprovementsValue" value="<?php echo HtmlEncode($valuation_roll_list->ImprovementsValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->RateableValue->Visible) { // RateableValue ?>
		<td data-name="RateableValue">
<span id="el$rowindex$_valuation_roll_RateableValue" class="form-group valuation_roll_RateableValue">
<input type="text" data-table="valuation_roll" data-field="x_RateableValue" name="x<?php echo $valuation_roll_list->RowIndex ?>_RateableValue" id="x<?php echo $valuation_roll_list->RowIndex ?>_RateableValue" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->RateableValue->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->RateableValue->EditValue ?>"<?php echo $valuation_roll_list->RateableValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_RateableValue" name="o<?php echo $valuation_roll_list->RowIndex ?>_RateableValue" id="o<?php echo $valuation_roll_list->RowIndex ?>_RateableValue" value="<?php echo HtmlEncode($valuation_roll_list->RateableValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks">
<span id="el$rowindex$_valuation_roll_Remarks" class="form-group valuation_roll_Remarks">
<input type="text" data-table="valuation_roll" data-field="x_Remarks" name="x<?php echo $valuation_roll_list->RowIndex ?>_Remarks" id="x<?php echo $valuation_roll_list->RowIndex ?>_Remarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->Remarks->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->Remarks->EditValue ?>"<?php echo $valuation_roll_list->Remarks->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_Remarks" name="o<?php echo $valuation_roll_list->RowIndex ?>_Remarks" id="o<?php echo $valuation_roll_list->RowIndex ?>_Remarks" value="<?php echo HtmlEncode($valuation_roll_list->Remarks->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->ValuationDate->Visible) { // ValuationDate ?>
		<td data-name="ValuationDate">
<span id="el$rowindex$_valuation_roll_ValuationDate" class="form-group valuation_roll_ValuationDate">
<input type="text" data-table="valuation_roll" data-field="x_ValuationDate" name="x<?php echo $valuation_roll_list->RowIndex ?>_ValuationDate" id="x<?php echo $valuation_roll_list->RowIndex ?>_ValuationDate" placeholder="<?php echo HtmlEncode($valuation_roll_list->ValuationDate->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->ValuationDate->EditValue ?>"<?php echo $valuation_roll_list->ValuationDate->editAttributes() ?>>
<?php if (!$valuation_roll_list->ValuationDate->ReadOnly && !$valuation_roll_list->ValuationDate->Disabled && !isset($valuation_roll_list->ValuationDate->EditAttrs["readonly"]) && !isset($valuation_roll_list->ValuationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fvaluation_rolllist", "datetimepicker"], function() {
	ew.createDateTimePicker("fvaluation_rolllist", "x<?php echo $valuation_roll_list->RowIndex ?>_ValuationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_ValuationDate" name="o<?php echo $valuation_roll_list->RowIndex ?>_ValuationDate" id="o<?php echo $valuation_roll_list->RowIndex ?>_ValuationDate" value="<?php echo HtmlEncode($valuation_roll_list->ValuationDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($valuation_roll_list->ValuationReference->Visible) { // ValuationReference ?>
		<td data-name="ValuationReference">
<span id="el$rowindex$_valuation_roll_ValuationReference" class="form-group valuation_roll_ValuationReference">
<input type="text" data-table="valuation_roll" data-field="x_ValuationReference" name="x<?php echo $valuation_roll_list->RowIndex ?>_ValuationReference" id="x<?php echo $valuation_roll_list->RowIndex ?>_ValuationReference" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($valuation_roll_list->ValuationReference->getPlaceHolder()) ?>" value="<?php echo $valuation_roll_list->ValuationReference->EditValue ?>"<?php echo $valuation_roll_list->ValuationReference->editAttributes() ?>>
</span>
<input type="hidden" data-table="valuation_roll" data-field="x_ValuationReference" name="o<?php echo $valuation_roll_list->RowIndex ?>_ValuationReference" id="o<?php echo $valuation_roll_list->RowIndex ?>_ValuationReference" value="<?php echo HtmlEncode($valuation_roll_list->ValuationReference->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$valuation_roll_list->ListOptions->render("body", "right", $valuation_roll_list->RowIndex);
?>
<script>
loadjs.ready(["fvaluation_rolllist", "load"], function() {
	fvaluation_rolllist.updateLists(<?php echo $valuation_roll_list->RowIndex ?>);
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
<?php if ($valuation_roll_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $valuation_roll_list->FormKeyCountName ?>" id="<?php echo $valuation_roll_list->FormKeyCountName ?>" value="<?php echo $valuation_roll_list->KeyCount ?>">
<?php echo $valuation_roll_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$valuation_roll->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($valuation_roll_list->Recordset)
	$valuation_roll_list->Recordset->Close();
?>
<?php if (!$valuation_roll_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$valuation_roll_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $valuation_roll_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $valuation_roll_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($valuation_roll_list->TotalRecords == 0 && !$valuation_roll->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $valuation_roll_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$valuation_roll_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$valuation_roll_list->isExport()) { ?>
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
$valuation_roll_list->terminate();
?>