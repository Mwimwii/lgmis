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
$income_type_list = new income_type_list();

// Run the page
$income_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$income_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$income_type_list->isExport()) { ?>
<script>
var fincome_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fincome_typelist = currentForm = new ew.Form("fincome_typelist", "list");
	fincome_typelist.formKeyCountName = '<?php echo $income_type_list->FormKeyCountName ?>';

	// Validate form
	fincome_typelist.validate = function() {
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
			<?php if ($income_type_list->IncomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_list->IncomeCode->caption(), $income_type_list->IncomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_list->IncomeName->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_list->IncomeName->caption(), $income_type_list->IncomeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_list->IncomeDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_list->IncomeDescription->caption(), $income_type_list->IncomeDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_list->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_list->Division->caption(), $income_type_list->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_list->IncomeAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_list->IncomeAmount->caption(), $income_type_list->IncomeAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IncomeAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($income_type_list->IncomeAmount->errorMessage()) ?>");
			<?php if ($income_type_list->IncomeBasicRate->Required) { ?>
				elm = this.getElements("x" + infix + "_IncomeBasicRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_list->IncomeBasicRate->caption(), $income_type_list->IncomeBasicRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IncomeBasicRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($income_type_list->IncomeBasicRate->errorMessage()) ?>");
			<?php if ($income_type_list->BaseIncomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BaseIncomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_list->BaseIncomeCode->caption(), $income_type_list->BaseIncomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_list->Taxable->Required) { ?>
				elm = this.getElements("x" + infix + "_Taxable");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_list->Taxable->caption(), $income_type_list->Taxable->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_list->AccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_list->AccountNo->caption(), $income_type_list->AccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_list->JobIncluded->Required) { ?>
				elm = this.getElements("x" + infix + "_JobIncluded[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_list->JobIncluded->caption(), $income_type_list->JobIncluded->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_list->Application->Required) { ?>
				elm = this.getElements("x" + infix + "_Application");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_list->Application->caption(), $income_type_list->Application->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($income_type_list->JobExcluded->Required) { ?>
				elm = this.getElements("x" + infix + "_JobExcluded[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $income_type_list->JobExcluded->caption(), $income_type_list->JobExcluded->RequiredErrorMessage)) ?>");
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
	fincome_typelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "IncomeName", false)) return false;
		if (ew.valueChanged(fobj, infix, "IncomeDescription", false)) return false;
		if (ew.valueChanged(fobj, infix, "Division[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "IncomeAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "IncomeBasicRate", false)) return false;
		if (ew.valueChanged(fobj, infix, "BaseIncomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "Taxable", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "JobIncluded[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "Application", false)) return false;
		if (ew.valueChanged(fobj, infix, "JobExcluded[]", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fincome_typelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fincome_typelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fincome_typelist.lists["x_Division[]"] = <?php echo $income_type_list->Division->Lookup->toClientList($income_type_list) ?>;
	fincome_typelist.lists["x_Division[]"].options = <?php echo JsonEncode($income_type_list->Division->lookupOptions()) ?>;
	fincome_typelist.lists["x_BaseIncomeCode"] = <?php echo $income_type_list->BaseIncomeCode->Lookup->toClientList($income_type_list) ?>;
	fincome_typelist.lists["x_BaseIncomeCode"].options = <?php echo JsonEncode($income_type_list->BaseIncomeCode->lookupOptions()) ?>;
	fincome_typelist.lists["x_Taxable"] = <?php echo $income_type_list->Taxable->Lookup->toClientList($income_type_list) ?>;
	fincome_typelist.lists["x_Taxable"].options = <?php echo JsonEncode($income_type_list->Taxable->lookupOptions()) ?>;
	fincome_typelist.lists["x_AccountNo"] = <?php echo $income_type_list->AccountNo->Lookup->toClientList($income_type_list) ?>;
	fincome_typelist.lists["x_AccountNo"].options = <?php echo JsonEncode($income_type_list->AccountNo->lookupOptions()) ?>;
	fincome_typelist.lists["x_JobIncluded[]"] = <?php echo $income_type_list->JobIncluded->Lookup->toClientList($income_type_list) ?>;
	fincome_typelist.lists["x_JobIncluded[]"].options = <?php echo JsonEncode($income_type_list->JobIncluded->lookupOptions()) ?>;
	fincome_typelist.lists["x_Application"] = <?php echo $income_type_list->Application->Lookup->toClientList($income_type_list) ?>;
	fincome_typelist.lists["x_Application"].options = <?php echo JsonEncode($income_type_list->Application->lookupOptions()) ?>;
	fincome_typelist.lists["x_JobExcluded[]"] = <?php echo $income_type_list->JobExcluded->Lookup->toClientList($income_type_list) ?>;
	fincome_typelist.lists["x_JobExcluded[]"].options = <?php echo JsonEncode($income_type_list->JobExcluded->lookupOptions()) ?>;
	loadjs.done("fincome_typelist");
});
var fincome_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fincome_typelistsrch = currentSearchForm = new ew.Form("fincome_typelistsrch");

	// Dynamic selection lists
	// Filters

	fincome_typelistsrch.filterList = <?php echo $income_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fincome_typelistsrch.initSearchPanel = true;
	loadjs.done("fincome_typelistsrch");
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
<?php if (!$income_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($income_type_list->TotalRecords > 0 && $income_type_list->ExportOptions->visible()) { ?>
<?php $income_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($income_type_list->ImportOptions->visible()) { ?>
<?php $income_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($income_type_list->SearchOptions->visible()) { ?>
<?php $income_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($income_type_list->FilterOptions->visible()) { ?>
<?php $income_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$income_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$income_type_list->isExport() && !$income_type->CurrentAction) { ?>
<form name="fincome_typelistsrch" id="fincome_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fincome_typelistsrch-search-panel" class="<?php echo $income_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="income_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $income_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($income_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($income_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $income_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($income_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($income_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($income_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($income_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $income_type_list->showPageHeader(); ?>
<?php
$income_type_list->showMessage();
?>
<?php if ($income_type_list->TotalRecords > 0 || $income_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($income_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> income_type">
<?php if (!$income_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$income_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $income_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $income_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fincome_typelist" id="fincome_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="income_type">
<div id="gmp_income_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($income_type_list->TotalRecords > 0 || $income_type_list->isGridEdit()) { ?>
<table id="tbl_income_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$income_type->RowType = ROWTYPE_HEADER;

// Render list options
$income_type_list->renderListOptions();

// Render list options (header, left)
$income_type_list->ListOptions->render("header", "left");
?>
<?php if ($income_type_list->IncomeCode->Visible) { // IncomeCode ?>
	<?php if ($income_type_list->SortUrl($income_type_list->IncomeCode) == "") { ?>
		<th data-name="IncomeCode" class="<?php echo $income_type_list->IncomeCode->headerCellClass() ?>"><div id="elh_income_type_IncomeCode" class="income_type_IncomeCode"><div class="ew-table-header-caption"><?php echo $income_type_list->IncomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeCode" class="<?php echo $income_type_list->IncomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_type_list->SortUrl($income_type_list->IncomeCode) ?>', 1);"><div id="elh_income_type_IncomeCode" class="income_type_IncomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_type_list->IncomeCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($income_type_list->IncomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_type_list->IncomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_type_list->IncomeName->Visible) { // IncomeName ?>
	<?php if ($income_type_list->SortUrl($income_type_list->IncomeName) == "") { ?>
		<th data-name="IncomeName" class="<?php echo $income_type_list->IncomeName->headerCellClass() ?>"><div id="elh_income_type_IncomeName" class="income_type_IncomeName"><div class="ew-table-header-caption"><?php echo $income_type_list->IncomeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeName" class="<?php echo $income_type_list->IncomeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_type_list->SortUrl($income_type_list->IncomeName) ?>', 1);"><div id="elh_income_type_IncomeName" class="income_type_IncomeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_type_list->IncomeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($income_type_list->IncomeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_type_list->IncomeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_type_list->IncomeDescription->Visible) { // IncomeDescription ?>
	<?php if ($income_type_list->SortUrl($income_type_list->IncomeDescription) == "") { ?>
		<th data-name="IncomeDescription" class="<?php echo $income_type_list->IncomeDescription->headerCellClass() ?>"><div id="elh_income_type_IncomeDescription" class="income_type_IncomeDescription"><div class="ew-table-header-caption"><?php echo $income_type_list->IncomeDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeDescription" class="<?php echo $income_type_list->IncomeDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_type_list->SortUrl($income_type_list->IncomeDescription) ?>', 1);"><div id="elh_income_type_IncomeDescription" class="income_type_IncomeDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_type_list->IncomeDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($income_type_list->IncomeDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_type_list->IncomeDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_type_list->Division->Visible) { // Division ?>
	<?php if ($income_type_list->SortUrl($income_type_list->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $income_type_list->Division->headerCellClass() ?>"><div id="elh_income_type_Division" class="income_type_Division"><div class="ew-table-header-caption"><?php echo $income_type_list->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $income_type_list->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_type_list->SortUrl($income_type_list->Division) ?>', 1);"><div id="elh_income_type_Division" class="income_type_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_type_list->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_type_list->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_type_list->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_type_list->IncomeAmount->Visible) { // IncomeAmount ?>
	<?php if ($income_type_list->SortUrl($income_type_list->IncomeAmount) == "") { ?>
		<th data-name="IncomeAmount" class="<?php echo $income_type_list->IncomeAmount->headerCellClass() ?>"><div id="elh_income_type_IncomeAmount" class="income_type_IncomeAmount"><div class="ew-table-header-caption"><?php echo $income_type_list->IncomeAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeAmount" class="<?php echo $income_type_list->IncomeAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_type_list->SortUrl($income_type_list->IncomeAmount) ?>', 1);"><div id="elh_income_type_IncomeAmount" class="income_type_IncomeAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_type_list->IncomeAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_type_list->IncomeAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_type_list->IncomeAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_type_list->IncomeBasicRate->Visible) { // IncomeBasicRate ?>
	<?php if ($income_type_list->SortUrl($income_type_list->IncomeBasicRate) == "") { ?>
		<th data-name="IncomeBasicRate" class="<?php echo $income_type_list->IncomeBasicRate->headerCellClass() ?>"><div id="elh_income_type_IncomeBasicRate" class="income_type_IncomeBasicRate"><div class="ew-table-header-caption"><?php echo $income_type_list->IncomeBasicRate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeBasicRate" class="<?php echo $income_type_list->IncomeBasicRate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_type_list->SortUrl($income_type_list->IncomeBasicRate) ?>', 1);"><div id="elh_income_type_IncomeBasicRate" class="income_type_IncomeBasicRate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_type_list->IncomeBasicRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_type_list->IncomeBasicRate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_type_list->IncomeBasicRate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_type_list->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
	<?php if ($income_type_list->SortUrl($income_type_list->BaseIncomeCode) == "") { ?>
		<th data-name="BaseIncomeCode" class="<?php echo $income_type_list->BaseIncomeCode->headerCellClass() ?>"><div id="elh_income_type_BaseIncomeCode" class="income_type_BaseIncomeCode"><div class="ew-table-header-caption"><?php echo $income_type_list->BaseIncomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BaseIncomeCode" class="<?php echo $income_type_list->BaseIncomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_type_list->SortUrl($income_type_list->BaseIncomeCode) ?>', 1);"><div id="elh_income_type_BaseIncomeCode" class="income_type_BaseIncomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_type_list->BaseIncomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_type_list->BaseIncomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_type_list->BaseIncomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_type_list->Taxable->Visible) { // Taxable ?>
	<?php if ($income_type_list->SortUrl($income_type_list->Taxable) == "") { ?>
		<th data-name="Taxable" class="<?php echo $income_type_list->Taxable->headerCellClass() ?>"><div id="elh_income_type_Taxable" class="income_type_Taxable"><div class="ew-table-header-caption"><?php echo $income_type_list->Taxable->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Taxable" class="<?php echo $income_type_list->Taxable->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_type_list->SortUrl($income_type_list->Taxable) ?>', 1);"><div id="elh_income_type_Taxable" class="income_type_Taxable">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_type_list->Taxable->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_type_list->Taxable->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_type_list->Taxable->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_type_list->AccountNo->Visible) { // AccountNo ?>
	<?php if ($income_type_list->SortUrl($income_type_list->AccountNo) == "") { ?>
		<th data-name="AccountNo" class="<?php echo $income_type_list->AccountNo->headerCellClass() ?>"><div id="elh_income_type_AccountNo" class="income_type_AccountNo"><div class="ew-table-header-caption"><?php echo $income_type_list->AccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountNo" class="<?php echo $income_type_list->AccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_type_list->SortUrl($income_type_list->AccountNo) ?>', 1);"><div id="elh_income_type_AccountNo" class="income_type_AccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_type_list->AccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_type_list->AccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_type_list->AccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_type_list->JobIncluded->Visible) { // JobIncluded ?>
	<?php if ($income_type_list->SortUrl($income_type_list->JobIncluded) == "") { ?>
		<th data-name="JobIncluded" class="<?php echo $income_type_list->JobIncluded->headerCellClass() ?>"><div id="elh_income_type_JobIncluded" class="income_type_JobIncluded"><div class="ew-table-header-caption"><?php echo $income_type_list->JobIncluded->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobIncluded" class="<?php echo $income_type_list->JobIncluded->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_type_list->SortUrl($income_type_list->JobIncluded) ?>', 1);"><div id="elh_income_type_JobIncluded" class="income_type_JobIncluded">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_type_list->JobIncluded->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_type_list->JobIncluded->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_type_list->JobIncluded->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_type_list->Application->Visible) { // Application ?>
	<?php if ($income_type_list->SortUrl($income_type_list->Application) == "") { ?>
		<th data-name="Application" class="<?php echo $income_type_list->Application->headerCellClass() ?>"><div id="elh_income_type_Application" class="income_type_Application"><div class="ew-table-header-caption"><?php echo $income_type_list->Application->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Application" class="<?php echo $income_type_list->Application->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_type_list->SortUrl($income_type_list->Application) ?>', 1);"><div id="elh_income_type_Application" class="income_type_Application">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_type_list->Application->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_type_list->Application->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_type_list->Application->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($income_type_list->JobExcluded->Visible) { // JobExcluded ?>
	<?php if ($income_type_list->SortUrl($income_type_list->JobExcluded) == "") { ?>
		<th data-name="JobExcluded" class="<?php echo $income_type_list->JobExcluded->headerCellClass() ?>"><div id="elh_income_type_JobExcluded" class="income_type_JobExcluded"><div class="ew-table-header-caption"><?php echo $income_type_list->JobExcluded->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobExcluded" class="<?php echo $income_type_list->JobExcluded->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $income_type_list->SortUrl($income_type_list->JobExcluded) ?>', 1);"><div id="elh_income_type_JobExcluded" class="income_type_JobExcluded">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $income_type_list->JobExcluded->caption() ?></span><span class="ew-table-header-sort"><?php if ($income_type_list->JobExcluded->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($income_type_list->JobExcluded->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$income_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($income_type_list->ExportAll && $income_type_list->isExport()) {
	$income_type_list->StopRecord = $income_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($income_type_list->TotalRecords > $income_type_list->StartRecord + $income_type_list->DisplayRecords - 1)
		$income_type_list->StopRecord = $income_type_list->StartRecord + $income_type_list->DisplayRecords - 1;
	else
		$income_type_list->StopRecord = $income_type_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($income_type->isConfirm() || $income_type_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($income_type_list->FormKeyCountName) && ($income_type_list->isGridAdd() || $income_type_list->isGridEdit() || $income_type->isConfirm())) {
		$income_type_list->KeyCount = $CurrentForm->getValue($income_type_list->FormKeyCountName);
		$income_type_list->StopRecord = $income_type_list->StartRecord + $income_type_list->KeyCount - 1;
	}
}
$income_type_list->RecordCount = $income_type_list->StartRecord - 1;
if ($income_type_list->Recordset && !$income_type_list->Recordset->EOF) {
	$income_type_list->Recordset->moveFirst();
	$selectLimit = $income_type_list->UseSelectLimit;
	if (!$selectLimit && $income_type_list->StartRecord > 1)
		$income_type_list->Recordset->move($income_type_list->StartRecord - 1);
} elseif (!$income_type->AllowAddDeleteRow && $income_type_list->StopRecord == 0) {
	$income_type_list->StopRecord = $income_type->GridAddRowCount;
}

// Initialize aggregate
$income_type->RowType = ROWTYPE_AGGREGATEINIT;
$income_type->resetAttributes();
$income_type_list->renderRow();
if ($income_type_list->isGridAdd())
	$income_type_list->RowIndex = 0;
if ($income_type_list->isGridEdit())
	$income_type_list->RowIndex = 0;
while ($income_type_list->RecordCount < $income_type_list->StopRecord) {
	$income_type_list->RecordCount++;
	if ($income_type_list->RecordCount >= $income_type_list->StartRecord) {
		$income_type_list->RowCount++;
		if ($income_type_list->isGridAdd() || $income_type_list->isGridEdit() || $income_type->isConfirm()) {
			$income_type_list->RowIndex++;
			$CurrentForm->Index = $income_type_list->RowIndex;
			if ($CurrentForm->hasValue($income_type_list->FormActionName) && ($income_type->isConfirm() || $income_type_list->EventCancelled))
				$income_type_list->RowAction = strval($CurrentForm->getValue($income_type_list->FormActionName));
			elseif ($income_type_list->isGridAdd())
				$income_type_list->RowAction = "insert";
			else
				$income_type_list->RowAction = "";
		}

		// Set up key count
		$income_type_list->KeyCount = $income_type_list->RowIndex;

		// Init row class and style
		$income_type->resetAttributes();
		$income_type->CssClass = "";
		if ($income_type_list->isGridAdd()) {
			$income_type_list->loadRowValues(); // Load default values
		} else {
			$income_type_list->loadRowValues($income_type_list->Recordset); // Load row values
		}
		$income_type->RowType = ROWTYPE_VIEW; // Render view
		if ($income_type_list->isGridAdd()) // Grid add
			$income_type->RowType = ROWTYPE_ADD; // Render add
		if ($income_type_list->isGridAdd() && $income_type->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$income_type_list->restoreCurrentRowFormValues($income_type_list->RowIndex); // Restore form values
		if ($income_type_list->isGridEdit()) { // Grid edit
			if ($income_type->EventCancelled)
				$income_type_list->restoreCurrentRowFormValues($income_type_list->RowIndex); // Restore form values
			if ($income_type_list->RowAction == "insert")
				$income_type->RowType = ROWTYPE_ADD; // Render add
			else
				$income_type->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($income_type_list->isGridEdit() && ($income_type->RowType == ROWTYPE_EDIT || $income_type->RowType == ROWTYPE_ADD) && $income_type->EventCancelled) // Update failed
			$income_type_list->restoreCurrentRowFormValues($income_type_list->RowIndex); // Restore form values
		if ($income_type->RowType == ROWTYPE_EDIT) // Edit row
			$income_type_list->EditRowCount++;

		// Set up row id / data-rowindex
		$income_type->RowAttrs->merge(["data-rowindex" => $income_type_list->RowCount, "id" => "r" . $income_type_list->RowCount . "_income_type", "data-rowtype" => $income_type->RowType]);

		// Render row
		$income_type_list->renderRow();

		// Render list options
		$income_type_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($income_type_list->RowAction != "delete" && $income_type_list->RowAction != "insertdelete" && !($income_type_list->RowAction == "insert" && $income_type->isConfirm() && $income_type_list->emptyRow())) {
?>
	<tr <?php echo $income_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$income_type_list->ListOptions->render("body", "left", $income_type_list->RowCount);
?>
	<?php if ($income_type_list->IncomeCode->Visible) { // IncomeCode ?>
		<td data-name="IncomeCode" <?php echo $income_type_list->IncomeCode->cellAttributes() ?>>
<?php if ($income_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeCode" class="form-group"></span>
<input type="hidden" data-table="income_type" data-field="x_IncomeCode" name="o<?php echo $income_type_list->RowIndex ?>_IncomeCode" id="o<?php echo $income_type_list->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($income_type_list->IncomeCode->OldValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeCode" class="form-group">
<span<?php echo $income_type_list->IncomeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($income_type_list->IncomeCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="income_type" data-field="x_IncomeCode" name="x<?php echo $income_type_list->RowIndex ?>_IncomeCode" id="x<?php echo $income_type_list->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($income_type_list->IncomeCode->CurrentValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeCode">
<span<?php echo $income_type_list->IncomeCode->viewAttributes() ?>><?php echo $income_type_list->IncomeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_type_list->IncomeName->Visible) { // IncomeName ?>
		<td data-name="IncomeName" <?php echo $income_type_list->IncomeName->cellAttributes() ?>>
<?php if ($income_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeName" class="form-group">
<input type="text" data-table="income_type" data-field="x_IncomeName" name="x<?php echo $income_type_list->RowIndex ?>_IncomeName" id="x<?php echo $income_type_list->RowIndex ?>_IncomeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_type_list->IncomeName->getPlaceHolder()) ?>" value="<?php echo $income_type_list->IncomeName->EditValue ?>"<?php echo $income_type_list->IncomeName->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_IncomeName" name="o<?php echo $income_type_list->RowIndex ?>_IncomeName" id="o<?php echo $income_type_list->RowIndex ?>_IncomeName" value="<?php echo HtmlEncode($income_type_list->IncomeName->OldValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeName" class="form-group">
<input type="text" data-table="income_type" data-field="x_IncomeName" name="x<?php echo $income_type_list->RowIndex ?>_IncomeName" id="x<?php echo $income_type_list->RowIndex ?>_IncomeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_type_list->IncomeName->getPlaceHolder()) ?>" value="<?php echo $income_type_list->IncomeName->EditValue ?>"<?php echo $income_type_list->IncomeName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeName">
<span<?php echo $income_type_list->IncomeName->viewAttributes() ?>><?php echo $income_type_list->IncomeName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_type_list->IncomeDescription->Visible) { // IncomeDescription ?>
		<td data-name="IncomeDescription" <?php echo $income_type_list->IncomeDescription->cellAttributes() ?>>
<?php if ($income_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeDescription" class="form-group">
<input type="text" data-table="income_type" data-field="x_IncomeDescription" name="x<?php echo $income_type_list->RowIndex ?>_IncomeDescription" id="x<?php echo $income_type_list->RowIndex ?>_IncomeDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_type_list->IncomeDescription->getPlaceHolder()) ?>" value="<?php echo $income_type_list->IncomeDescription->EditValue ?>"<?php echo $income_type_list->IncomeDescription->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_IncomeDescription" name="o<?php echo $income_type_list->RowIndex ?>_IncomeDescription" id="o<?php echo $income_type_list->RowIndex ?>_IncomeDescription" value="<?php echo HtmlEncode($income_type_list->IncomeDescription->OldValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeDescription" class="form-group">
<input type="text" data-table="income_type" data-field="x_IncomeDescription" name="x<?php echo $income_type_list->RowIndex ?>_IncomeDescription" id="x<?php echo $income_type_list->RowIndex ?>_IncomeDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_type_list->IncomeDescription->getPlaceHolder()) ?>" value="<?php echo $income_type_list->IncomeDescription->EditValue ?>"<?php echo $income_type_list->IncomeDescription->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeDescription">
<span<?php echo $income_type_list->IncomeDescription->viewAttributes() ?>><?php echo $income_type_list->IncomeDescription->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_type_list->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $income_type_list->Division->cellAttributes() ?>>
<?php if ($income_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_Division" class="form-group">
<div id="tp_x<?php echo $income_type_list->RowIndex ?>_Division" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="income_type" data-field="x_Division" data-value-separator="<?php echo $income_type_list->Division->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_Division[]" id="x<?php echo $income_type_list->RowIndex ?>_Division[]" value="{value}"<?php echo $income_type_list->Division->editAttributes() ?>></div>
<div id="dsl_x<?php echo $income_type_list->RowIndex ?>_Division" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $income_type_list->Division->checkBoxListHtml(FALSE, "x{$income_type_list->RowIndex}_Division[]") ?>
</div></div>
<?php echo $income_type_list->Division->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_Division") ?>
</span>
<input type="hidden" data-table="income_type" data-field="x_Division" name="o<?php echo $income_type_list->RowIndex ?>_Division[]" id="o<?php echo $income_type_list->RowIndex ?>_Division[]" value="<?php echo HtmlEncode($income_type_list->Division->OldValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_Division" class="form-group">
<div id="tp_x<?php echo $income_type_list->RowIndex ?>_Division" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="income_type" data-field="x_Division" data-value-separator="<?php echo $income_type_list->Division->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_Division[]" id="x<?php echo $income_type_list->RowIndex ?>_Division[]" value="{value}"<?php echo $income_type_list->Division->editAttributes() ?>></div>
<div id="dsl_x<?php echo $income_type_list->RowIndex ?>_Division" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $income_type_list->Division->checkBoxListHtml(FALSE, "x{$income_type_list->RowIndex}_Division[]") ?>
</div></div>
<?php echo $income_type_list->Division->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_Division") ?>
</span>
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_Division">
<span<?php echo $income_type_list->Division->viewAttributes() ?>><?php echo $income_type_list->Division->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_type_list->IncomeAmount->Visible) { // IncomeAmount ?>
		<td data-name="IncomeAmount" <?php echo $income_type_list->IncomeAmount->cellAttributes() ?>>
<?php if ($income_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeAmount" class="form-group">
<input type="text" data-table="income_type" data-field="x_IncomeAmount" name="x<?php echo $income_type_list->RowIndex ?>_IncomeAmount" id="x<?php echo $income_type_list->RowIndex ?>_IncomeAmount" size="30" placeholder="<?php echo HtmlEncode($income_type_list->IncomeAmount->getPlaceHolder()) ?>" value="<?php echo $income_type_list->IncomeAmount->EditValue ?>"<?php echo $income_type_list->IncomeAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_IncomeAmount" name="o<?php echo $income_type_list->RowIndex ?>_IncomeAmount" id="o<?php echo $income_type_list->RowIndex ?>_IncomeAmount" value="<?php echo HtmlEncode($income_type_list->IncomeAmount->OldValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeAmount" class="form-group">
<input type="text" data-table="income_type" data-field="x_IncomeAmount" name="x<?php echo $income_type_list->RowIndex ?>_IncomeAmount" id="x<?php echo $income_type_list->RowIndex ?>_IncomeAmount" size="30" placeholder="<?php echo HtmlEncode($income_type_list->IncomeAmount->getPlaceHolder()) ?>" value="<?php echo $income_type_list->IncomeAmount->EditValue ?>"<?php echo $income_type_list->IncomeAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeAmount">
<span<?php echo $income_type_list->IncomeAmount->viewAttributes() ?>><?php echo $income_type_list->IncomeAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_type_list->IncomeBasicRate->Visible) { // IncomeBasicRate ?>
		<td data-name="IncomeBasicRate" <?php echo $income_type_list->IncomeBasicRate->cellAttributes() ?>>
<?php if ($income_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeBasicRate" class="form-group">
<input type="text" data-table="income_type" data-field="x_IncomeBasicRate" name="x<?php echo $income_type_list->RowIndex ?>_IncomeBasicRate" id="x<?php echo $income_type_list->RowIndex ?>_IncomeBasicRate" size="30" placeholder="<?php echo HtmlEncode($income_type_list->IncomeBasicRate->getPlaceHolder()) ?>" value="<?php echo $income_type_list->IncomeBasicRate->EditValue ?>"<?php echo $income_type_list->IncomeBasicRate->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_IncomeBasicRate" name="o<?php echo $income_type_list->RowIndex ?>_IncomeBasicRate" id="o<?php echo $income_type_list->RowIndex ?>_IncomeBasicRate" value="<?php echo HtmlEncode($income_type_list->IncomeBasicRate->OldValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeBasicRate" class="form-group">
<input type="text" data-table="income_type" data-field="x_IncomeBasicRate" name="x<?php echo $income_type_list->RowIndex ?>_IncomeBasicRate" id="x<?php echo $income_type_list->RowIndex ?>_IncomeBasicRate" size="30" placeholder="<?php echo HtmlEncode($income_type_list->IncomeBasicRate->getPlaceHolder()) ?>" value="<?php echo $income_type_list->IncomeBasicRate->EditValue ?>"<?php echo $income_type_list->IncomeBasicRate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_IncomeBasicRate">
<span<?php echo $income_type_list->IncomeBasicRate->viewAttributes() ?>><?php echo $income_type_list->IncomeBasicRate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_type_list->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
		<td data-name="BaseIncomeCode" <?php echo $income_type_list->BaseIncomeCode->cellAttributes() ?>>
<?php if ($income_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_BaseIncomeCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode"><?php echo EmptyValue(strval($income_type_list->BaseIncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_list->BaseIncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_list->BaseIncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_list->BaseIncomeCode->ReadOnly || $income_type_list->BaseIncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_list->BaseIncomeCode->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_BaseIncomeCode") ?>
<input type="hidden" data-table="income_type" data-field="x_BaseIncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $income_type_list->BaseIncomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode" id="x<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode" value="<?php echo $income_type_list->BaseIncomeCode->CurrentValue ?>"<?php echo $income_type_list->BaseIncomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_BaseIncomeCode" name="o<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode" id="o<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode" value="<?php echo HtmlEncode($income_type_list->BaseIncomeCode->OldValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_BaseIncomeCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode"><?php echo EmptyValue(strval($income_type_list->BaseIncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_list->BaseIncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_list->BaseIncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_list->BaseIncomeCode->ReadOnly || $income_type_list->BaseIncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_list->BaseIncomeCode->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_BaseIncomeCode") ?>
<input type="hidden" data-table="income_type" data-field="x_BaseIncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $income_type_list->BaseIncomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode" id="x<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode" value="<?php echo $income_type_list->BaseIncomeCode->CurrentValue ?>"<?php echo $income_type_list->BaseIncomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_BaseIncomeCode">
<span<?php echo $income_type_list->BaseIncomeCode->viewAttributes() ?>><?php echo $income_type_list->BaseIncomeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_type_list->Taxable->Visible) { // Taxable ?>
		<td data-name="Taxable" <?php echo $income_type_list->Taxable->cellAttributes() ?>>
<?php if ($income_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_Taxable" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_type" data-field="x_Taxable" data-value-separator="<?php echo $income_type_list->Taxable->displayValueSeparatorAttribute() ?>" id="x<?php echo $income_type_list->RowIndex ?>_Taxable" name="x<?php echo $income_type_list->RowIndex ?>_Taxable"<?php echo $income_type_list->Taxable->editAttributes() ?>>
			<?php echo $income_type_list->Taxable->selectOptionListHtml("x{$income_type_list->RowIndex}_Taxable") ?>
		</select>
</div>
<?php echo $income_type_list->Taxable->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_Taxable") ?>
</span>
<input type="hidden" data-table="income_type" data-field="x_Taxable" name="o<?php echo $income_type_list->RowIndex ?>_Taxable" id="o<?php echo $income_type_list->RowIndex ?>_Taxable" value="<?php echo HtmlEncode($income_type_list->Taxable->OldValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_Taxable" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_type" data-field="x_Taxable" data-value-separator="<?php echo $income_type_list->Taxable->displayValueSeparatorAttribute() ?>" id="x<?php echo $income_type_list->RowIndex ?>_Taxable" name="x<?php echo $income_type_list->RowIndex ?>_Taxable"<?php echo $income_type_list->Taxable->editAttributes() ?>>
			<?php echo $income_type_list->Taxable->selectOptionListHtml("x{$income_type_list->RowIndex}_Taxable") ?>
		</select>
</div>
<?php echo $income_type_list->Taxable->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_Taxable") ?>
</span>
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_Taxable">
<span<?php echo $income_type_list->Taxable->viewAttributes() ?>><?php echo $income_type_list->Taxable->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_type_list->AccountNo->Visible) { // AccountNo ?>
		<td data-name="AccountNo" <?php echo $income_type_list->AccountNo->cellAttributes() ?>>
<?php if ($income_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_AccountNo" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $income_type_list->RowIndex ?>_AccountNo"><?php echo EmptyValue(strval($income_type_list->AccountNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_list->AccountNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_list->AccountNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_list->AccountNo->ReadOnly || $income_type_list->AccountNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $income_type_list->RowIndex ?>_AccountNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_list->AccountNo->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_AccountNo") ?>
<input type="hidden" data-table="income_type" data-field="x_AccountNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $income_type_list->AccountNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_AccountNo" id="x<?php echo $income_type_list->RowIndex ?>_AccountNo" value="<?php echo $income_type_list->AccountNo->CurrentValue ?>"<?php echo $income_type_list->AccountNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_AccountNo" name="o<?php echo $income_type_list->RowIndex ?>_AccountNo" id="o<?php echo $income_type_list->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($income_type_list->AccountNo->OldValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_AccountNo" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $income_type_list->RowIndex ?>_AccountNo"><?php echo EmptyValue(strval($income_type_list->AccountNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_list->AccountNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_list->AccountNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_list->AccountNo->ReadOnly || $income_type_list->AccountNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $income_type_list->RowIndex ?>_AccountNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_list->AccountNo->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_AccountNo") ?>
<input type="hidden" data-table="income_type" data-field="x_AccountNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $income_type_list->AccountNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_AccountNo" id="x<?php echo $income_type_list->RowIndex ?>_AccountNo" value="<?php echo $income_type_list->AccountNo->CurrentValue ?>"<?php echo $income_type_list->AccountNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_AccountNo">
<span<?php echo $income_type_list->AccountNo->viewAttributes() ?>><?php echo $income_type_list->AccountNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_type_list->JobIncluded->Visible) { // JobIncluded ?>
		<td data-name="JobIncluded" <?php echo $income_type_list->JobIncluded->cellAttributes() ?>>
<?php if ($income_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_JobIncluded" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $income_type_list->RowIndex ?>_JobIncluded"><?php echo EmptyValue(strval($income_type_list->JobIncluded->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_list->JobIncluded->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_list->JobIncluded->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_list->JobIncluded->ReadOnly || $income_type_list->JobIncluded->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $income_type_list->RowIndex ?>_JobIncluded[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_list->JobIncluded->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_JobIncluded") ?>
<input type="hidden" data-table="income_type" data-field="x_JobIncluded" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $income_type_list->JobIncluded->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_JobIncluded[]" id="x<?php echo $income_type_list->RowIndex ?>_JobIncluded[]" value="<?php echo $income_type_list->JobIncluded->CurrentValue ?>"<?php echo $income_type_list->JobIncluded->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_JobIncluded" name="o<?php echo $income_type_list->RowIndex ?>_JobIncluded[]" id="o<?php echo $income_type_list->RowIndex ?>_JobIncluded[]" value="<?php echo HtmlEncode($income_type_list->JobIncluded->OldValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_JobIncluded" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $income_type_list->RowIndex ?>_JobIncluded"><?php echo EmptyValue(strval($income_type_list->JobIncluded->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_list->JobIncluded->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_list->JobIncluded->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_list->JobIncluded->ReadOnly || $income_type_list->JobIncluded->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $income_type_list->RowIndex ?>_JobIncluded[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_list->JobIncluded->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_JobIncluded") ?>
<input type="hidden" data-table="income_type" data-field="x_JobIncluded" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $income_type_list->JobIncluded->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_JobIncluded[]" id="x<?php echo $income_type_list->RowIndex ?>_JobIncluded[]" value="<?php echo $income_type_list->JobIncluded->CurrentValue ?>"<?php echo $income_type_list->JobIncluded->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_JobIncluded">
<span<?php echo $income_type_list->JobIncluded->viewAttributes() ?>><?php echo $income_type_list->JobIncluded->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_type_list->Application->Visible) { // Application ?>
		<td data-name="Application" <?php echo $income_type_list->Application->cellAttributes() ?>>
<?php if ($income_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_Application" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_type" data-field="x_Application" data-value-separator="<?php echo $income_type_list->Application->displayValueSeparatorAttribute() ?>" id="x<?php echo $income_type_list->RowIndex ?>_Application" name="x<?php echo $income_type_list->RowIndex ?>_Application"<?php echo $income_type_list->Application->editAttributes() ?>>
			<?php echo $income_type_list->Application->selectOptionListHtml("x{$income_type_list->RowIndex}_Application") ?>
		</select>
</div>
<?php echo $income_type_list->Application->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_Application") ?>
</span>
<input type="hidden" data-table="income_type" data-field="x_Application" name="o<?php echo $income_type_list->RowIndex ?>_Application" id="o<?php echo $income_type_list->RowIndex ?>_Application" value="<?php echo HtmlEncode($income_type_list->Application->OldValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_Application" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_type" data-field="x_Application" data-value-separator="<?php echo $income_type_list->Application->displayValueSeparatorAttribute() ?>" id="x<?php echo $income_type_list->RowIndex ?>_Application" name="x<?php echo $income_type_list->RowIndex ?>_Application"<?php echo $income_type_list->Application->editAttributes() ?>>
			<?php echo $income_type_list->Application->selectOptionListHtml("x{$income_type_list->RowIndex}_Application") ?>
		</select>
</div>
<?php echo $income_type_list->Application->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_Application") ?>
</span>
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_Application">
<span<?php echo $income_type_list->Application->viewAttributes() ?>><?php echo $income_type_list->Application->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($income_type_list->JobExcluded->Visible) { // JobExcluded ?>
		<td data-name="JobExcluded" <?php echo $income_type_list->JobExcluded->cellAttributes() ?>>
<?php if ($income_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_JobExcluded" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $income_type_list->RowIndex ?>_JobExcluded"><?php echo EmptyValue(strval($income_type_list->JobExcluded->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_list->JobExcluded->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_list->JobExcluded->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_list->JobExcluded->ReadOnly || $income_type_list->JobExcluded->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $income_type_list->RowIndex ?>_JobExcluded[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_list->JobExcluded->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_JobExcluded") ?>
<input type="hidden" data-table="income_type" data-field="x_JobExcluded" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $income_type_list->JobExcluded->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_JobExcluded[]" id="x<?php echo $income_type_list->RowIndex ?>_JobExcluded[]" value="<?php echo $income_type_list->JobExcluded->CurrentValue ?>"<?php echo $income_type_list->JobExcluded->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_JobExcluded" name="o<?php echo $income_type_list->RowIndex ?>_JobExcluded[]" id="o<?php echo $income_type_list->RowIndex ?>_JobExcluded[]" value="<?php echo HtmlEncode($income_type_list->JobExcluded->OldValue) ?>">
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_JobExcluded" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $income_type_list->RowIndex ?>_JobExcluded"><?php echo EmptyValue(strval($income_type_list->JobExcluded->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_list->JobExcluded->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_list->JobExcluded->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_list->JobExcluded->ReadOnly || $income_type_list->JobExcluded->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $income_type_list->RowIndex ?>_JobExcluded[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_list->JobExcluded->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_JobExcluded") ?>
<input type="hidden" data-table="income_type" data-field="x_JobExcluded" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $income_type_list->JobExcluded->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_JobExcluded[]" id="x<?php echo $income_type_list->RowIndex ?>_JobExcluded[]" value="<?php echo $income_type_list->JobExcluded->CurrentValue ?>"<?php echo $income_type_list->JobExcluded->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($income_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $income_type_list->RowCount ?>_income_type_JobExcluded">
<span<?php echo $income_type_list->JobExcluded->viewAttributes() ?>><?php echo $income_type_list->JobExcluded->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$income_type_list->ListOptions->render("body", "right", $income_type_list->RowCount);
?>
	</tr>
<?php if ($income_type->RowType == ROWTYPE_ADD || $income_type->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fincome_typelist", "load"], function() {
	fincome_typelist.updateLists(<?php echo $income_type_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$income_type_list->isGridAdd())
		if (!$income_type_list->Recordset->EOF)
			$income_type_list->Recordset->moveNext();
}
?>
<?php
	if ($income_type_list->isGridAdd() || $income_type_list->isGridEdit()) {
		$income_type_list->RowIndex = '$rowindex$';
		$income_type_list->loadRowValues();

		// Set row properties
		$income_type->resetAttributes();
		$income_type->RowAttrs->merge(["data-rowindex" => $income_type_list->RowIndex, "id" => "r0_income_type", "data-rowtype" => ROWTYPE_ADD]);
		$income_type->RowAttrs->appendClass("ew-template");
		$income_type->RowType = ROWTYPE_ADD;

		// Render row
		$income_type_list->renderRow();

		// Render list options
		$income_type_list->renderListOptions();
		$income_type_list->StartRowCount = 0;
?>
	<tr <?php echo $income_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$income_type_list->ListOptions->render("body", "left", $income_type_list->RowIndex);
?>
	<?php if ($income_type_list->IncomeCode->Visible) { // IncomeCode ?>
		<td data-name="IncomeCode">
<span id="el$rowindex$_income_type_IncomeCode" class="form-group income_type_IncomeCode"></span>
<input type="hidden" data-table="income_type" data-field="x_IncomeCode" name="o<?php echo $income_type_list->RowIndex ?>_IncomeCode" id="o<?php echo $income_type_list->RowIndex ?>_IncomeCode" value="<?php echo HtmlEncode($income_type_list->IncomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_type_list->IncomeName->Visible) { // IncomeName ?>
		<td data-name="IncomeName">
<span id="el$rowindex$_income_type_IncomeName" class="form-group income_type_IncomeName">
<input type="text" data-table="income_type" data-field="x_IncomeName" name="x<?php echo $income_type_list->RowIndex ?>_IncomeName" id="x<?php echo $income_type_list->RowIndex ?>_IncomeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_type_list->IncomeName->getPlaceHolder()) ?>" value="<?php echo $income_type_list->IncomeName->EditValue ?>"<?php echo $income_type_list->IncomeName->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_IncomeName" name="o<?php echo $income_type_list->RowIndex ?>_IncomeName" id="o<?php echo $income_type_list->RowIndex ?>_IncomeName" value="<?php echo HtmlEncode($income_type_list->IncomeName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_type_list->IncomeDescription->Visible) { // IncomeDescription ?>
		<td data-name="IncomeDescription">
<span id="el$rowindex$_income_type_IncomeDescription" class="form-group income_type_IncomeDescription">
<input type="text" data-table="income_type" data-field="x_IncomeDescription" name="x<?php echo $income_type_list->RowIndex ?>_IncomeDescription" id="x<?php echo $income_type_list->RowIndex ?>_IncomeDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($income_type_list->IncomeDescription->getPlaceHolder()) ?>" value="<?php echo $income_type_list->IncomeDescription->EditValue ?>"<?php echo $income_type_list->IncomeDescription->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_IncomeDescription" name="o<?php echo $income_type_list->RowIndex ?>_IncomeDescription" id="o<?php echo $income_type_list->RowIndex ?>_IncomeDescription" value="<?php echo HtmlEncode($income_type_list->IncomeDescription->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_type_list->Division->Visible) { // Division ?>
		<td data-name="Division">
<span id="el$rowindex$_income_type_Division" class="form-group income_type_Division">
<div id="tp_x<?php echo $income_type_list->RowIndex ?>_Division" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="income_type" data-field="x_Division" data-value-separator="<?php echo $income_type_list->Division->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_Division[]" id="x<?php echo $income_type_list->RowIndex ?>_Division[]" value="{value}"<?php echo $income_type_list->Division->editAttributes() ?>></div>
<div id="dsl_x<?php echo $income_type_list->RowIndex ?>_Division" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $income_type_list->Division->checkBoxListHtml(FALSE, "x{$income_type_list->RowIndex}_Division[]") ?>
</div></div>
<?php echo $income_type_list->Division->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_Division") ?>
</span>
<input type="hidden" data-table="income_type" data-field="x_Division" name="o<?php echo $income_type_list->RowIndex ?>_Division[]" id="o<?php echo $income_type_list->RowIndex ?>_Division[]" value="<?php echo HtmlEncode($income_type_list->Division->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_type_list->IncomeAmount->Visible) { // IncomeAmount ?>
		<td data-name="IncomeAmount">
<span id="el$rowindex$_income_type_IncomeAmount" class="form-group income_type_IncomeAmount">
<input type="text" data-table="income_type" data-field="x_IncomeAmount" name="x<?php echo $income_type_list->RowIndex ?>_IncomeAmount" id="x<?php echo $income_type_list->RowIndex ?>_IncomeAmount" size="30" placeholder="<?php echo HtmlEncode($income_type_list->IncomeAmount->getPlaceHolder()) ?>" value="<?php echo $income_type_list->IncomeAmount->EditValue ?>"<?php echo $income_type_list->IncomeAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_IncomeAmount" name="o<?php echo $income_type_list->RowIndex ?>_IncomeAmount" id="o<?php echo $income_type_list->RowIndex ?>_IncomeAmount" value="<?php echo HtmlEncode($income_type_list->IncomeAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_type_list->IncomeBasicRate->Visible) { // IncomeBasicRate ?>
		<td data-name="IncomeBasicRate">
<span id="el$rowindex$_income_type_IncomeBasicRate" class="form-group income_type_IncomeBasicRate">
<input type="text" data-table="income_type" data-field="x_IncomeBasicRate" name="x<?php echo $income_type_list->RowIndex ?>_IncomeBasicRate" id="x<?php echo $income_type_list->RowIndex ?>_IncomeBasicRate" size="30" placeholder="<?php echo HtmlEncode($income_type_list->IncomeBasicRate->getPlaceHolder()) ?>" value="<?php echo $income_type_list->IncomeBasicRate->EditValue ?>"<?php echo $income_type_list->IncomeBasicRate->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_IncomeBasicRate" name="o<?php echo $income_type_list->RowIndex ?>_IncomeBasicRate" id="o<?php echo $income_type_list->RowIndex ?>_IncomeBasicRate" value="<?php echo HtmlEncode($income_type_list->IncomeBasicRate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_type_list->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
		<td data-name="BaseIncomeCode">
<span id="el$rowindex$_income_type_BaseIncomeCode" class="form-group income_type_BaseIncomeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode"><?php echo EmptyValue(strval($income_type_list->BaseIncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_list->BaseIncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_list->BaseIncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_list->BaseIncomeCode->ReadOnly || $income_type_list->BaseIncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_list->BaseIncomeCode->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_BaseIncomeCode") ?>
<input type="hidden" data-table="income_type" data-field="x_BaseIncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $income_type_list->BaseIncomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode" id="x<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode" value="<?php echo $income_type_list->BaseIncomeCode->CurrentValue ?>"<?php echo $income_type_list->BaseIncomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_BaseIncomeCode" name="o<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode" id="o<?php echo $income_type_list->RowIndex ?>_BaseIncomeCode" value="<?php echo HtmlEncode($income_type_list->BaseIncomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_type_list->Taxable->Visible) { // Taxable ?>
		<td data-name="Taxable">
<span id="el$rowindex$_income_type_Taxable" class="form-group income_type_Taxable">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_type" data-field="x_Taxable" data-value-separator="<?php echo $income_type_list->Taxable->displayValueSeparatorAttribute() ?>" id="x<?php echo $income_type_list->RowIndex ?>_Taxable" name="x<?php echo $income_type_list->RowIndex ?>_Taxable"<?php echo $income_type_list->Taxable->editAttributes() ?>>
			<?php echo $income_type_list->Taxable->selectOptionListHtml("x{$income_type_list->RowIndex}_Taxable") ?>
		</select>
</div>
<?php echo $income_type_list->Taxable->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_Taxable") ?>
</span>
<input type="hidden" data-table="income_type" data-field="x_Taxable" name="o<?php echo $income_type_list->RowIndex ?>_Taxable" id="o<?php echo $income_type_list->RowIndex ?>_Taxable" value="<?php echo HtmlEncode($income_type_list->Taxable->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_type_list->AccountNo->Visible) { // AccountNo ?>
		<td data-name="AccountNo">
<span id="el$rowindex$_income_type_AccountNo" class="form-group income_type_AccountNo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $income_type_list->RowIndex ?>_AccountNo"><?php echo EmptyValue(strval($income_type_list->AccountNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_list->AccountNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_list->AccountNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_list->AccountNo->ReadOnly || $income_type_list->AccountNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $income_type_list->RowIndex ?>_AccountNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_list->AccountNo->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_AccountNo") ?>
<input type="hidden" data-table="income_type" data-field="x_AccountNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $income_type_list->AccountNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_AccountNo" id="x<?php echo $income_type_list->RowIndex ?>_AccountNo" value="<?php echo $income_type_list->AccountNo->CurrentValue ?>"<?php echo $income_type_list->AccountNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_AccountNo" name="o<?php echo $income_type_list->RowIndex ?>_AccountNo" id="o<?php echo $income_type_list->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($income_type_list->AccountNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_type_list->JobIncluded->Visible) { // JobIncluded ?>
		<td data-name="JobIncluded">
<span id="el$rowindex$_income_type_JobIncluded" class="form-group income_type_JobIncluded">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $income_type_list->RowIndex ?>_JobIncluded"><?php echo EmptyValue(strval($income_type_list->JobIncluded->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_list->JobIncluded->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_list->JobIncluded->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_list->JobIncluded->ReadOnly || $income_type_list->JobIncluded->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $income_type_list->RowIndex ?>_JobIncluded[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_list->JobIncluded->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_JobIncluded") ?>
<input type="hidden" data-table="income_type" data-field="x_JobIncluded" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $income_type_list->JobIncluded->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_JobIncluded[]" id="x<?php echo $income_type_list->RowIndex ?>_JobIncluded[]" value="<?php echo $income_type_list->JobIncluded->CurrentValue ?>"<?php echo $income_type_list->JobIncluded->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_JobIncluded" name="o<?php echo $income_type_list->RowIndex ?>_JobIncluded[]" id="o<?php echo $income_type_list->RowIndex ?>_JobIncluded[]" value="<?php echo HtmlEncode($income_type_list->JobIncluded->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_type_list->Application->Visible) { // Application ?>
		<td data-name="Application">
<span id="el$rowindex$_income_type_Application" class="form-group income_type_Application">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="income_type" data-field="x_Application" data-value-separator="<?php echo $income_type_list->Application->displayValueSeparatorAttribute() ?>" id="x<?php echo $income_type_list->RowIndex ?>_Application" name="x<?php echo $income_type_list->RowIndex ?>_Application"<?php echo $income_type_list->Application->editAttributes() ?>>
			<?php echo $income_type_list->Application->selectOptionListHtml("x{$income_type_list->RowIndex}_Application") ?>
		</select>
</div>
<?php echo $income_type_list->Application->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_Application") ?>
</span>
<input type="hidden" data-table="income_type" data-field="x_Application" name="o<?php echo $income_type_list->RowIndex ?>_Application" id="o<?php echo $income_type_list->RowIndex ?>_Application" value="<?php echo HtmlEncode($income_type_list->Application->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($income_type_list->JobExcluded->Visible) { // JobExcluded ?>
		<td data-name="JobExcluded">
<span id="el$rowindex$_income_type_JobExcluded" class="form-group income_type_JobExcluded">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $income_type_list->RowIndex ?>_JobExcluded"><?php echo EmptyValue(strval($income_type_list->JobExcluded->ViewValue)) ? $Language->phrase("PleaseSelect") : $income_type_list->JobExcluded->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($income_type_list->JobExcluded->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($income_type_list->JobExcluded->ReadOnly || $income_type_list->JobExcluded->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $income_type_list->RowIndex ?>_JobExcluded[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $income_type_list->JobExcluded->Lookup->getParamTag($income_type_list, "p_x" . $income_type_list->RowIndex . "_JobExcluded") ?>
<input type="hidden" data-table="income_type" data-field="x_JobExcluded" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $income_type_list->JobExcluded->displayValueSeparatorAttribute() ?>" name="x<?php echo $income_type_list->RowIndex ?>_JobExcluded[]" id="x<?php echo $income_type_list->RowIndex ?>_JobExcluded[]" value="<?php echo $income_type_list->JobExcluded->CurrentValue ?>"<?php echo $income_type_list->JobExcluded->editAttributes() ?>>
</span>
<input type="hidden" data-table="income_type" data-field="x_JobExcluded" name="o<?php echo $income_type_list->RowIndex ?>_JobExcluded[]" id="o<?php echo $income_type_list->RowIndex ?>_JobExcluded[]" value="<?php echo HtmlEncode($income_type_list->JobExcluded->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$income_type_list->ListOptions->render("body", "right", $income_type_list->RowIndex);
?>
<script>
loadjs.ready(["fincome_typelist", "load"], function() {
	fincome_typelist.updateLists(<?php echo $income_type_list->RowIndex ?>);
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
<?php if ($income_type_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $income_type_list->FormKeyCountName ?>" id="<?php echo $income_type_list->FormKeyCountName ?>" value="<?php echo $income_type_list->KeyCount ?>">
<?php echo $income_type_list->MultiSelectKey ?>
<?php } ?>
<?php if ($income_type_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $income_type_list->FormKeyCountName ?>" id="<?php echo $income_type_list->FormKeyCountName ?>" value="<?php echo $income_type_list->KeyCount ?>">
<?php echo $income_type_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$income_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($income_type_list->Recordset)
	$income_type_list->Recordset->Close();
?>
<?php if (!$income_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$income_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $income_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $income_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($income_type_list->TotalRecords == 0 && !$income_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $income_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$income_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$income_type_list->isExport()) { ?>
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
$income_type_list->terminate();
?>