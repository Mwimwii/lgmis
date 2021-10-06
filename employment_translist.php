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
$employment_trans_list = new employment_trans_list();

// Run the page
$employment_trans_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_trans_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employment_trans_list->isExport()) { ?>
<script>
var femployment_translist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployment_translist = currentForm = new ew.Form("femployment_translist", "list");
	femployment_translist.formKeyCountName = '<?php echo $employment_trans_list->FormKeyCountName ?>';

	// Validate form
	femployment_translist.validate = function() {
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
			<?php if ($employment_trans_list->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->EmployeeID->caption(), $employment_trans_list->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_list->EmployeeID->errorMessage()) ?>");
			<?php if ($employment_trans_list->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->ProvinceCode->caption(), $employment_trans_list->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_list->ProvinceCode->errorMessage()) ?>");
			<?php if ($employment_trans_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->LACode->caption(), $employment_trans_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_trans_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->DepartmentCode->caption(), $employment_trans_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_list->DepartmentCode->errorMessage()) ?>");
			<?php if ($employment_trans_list->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->SectionCode->caption(), $employment_trans_list->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_list->SectionCode->errorMessage()) ?>");
			<?php if ($employment_trans_list->ToLACode->Required) { ?>
				elm = this.getElements("x" + infix + "_ToLACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->ToLACode->caption(), $employment_trans_list->ToLACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_trans_list->ToDept->Required) { ?>
				elm = this.getElements("x" + infix + "_ToDept");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->ToDept->caption(), $employment_trans_list->ToDept->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ToDept");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_list->ToDept->errorMessage()) ?>");
			<?php if ($employment_trans_list->ToSection->Required) { ?>
				elm = this.getElements("x" + infix + "_ToSection");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->ToSection->caption(), $employment_trans_list->ToSection->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ToSection");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_list->ToSection->errorMessage()) ?>");
			<?php if ($employment_trans_list->ActingPosition->Required) { ?>
				elm = this.getElements("x" + infix + "_ActingPosition");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->ActingPosition->caption(), $employment_trans_list->ActingPosition->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ActingPosition");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_list->ActingPosition->errorMessage()) ?>");
			<?php if ($employment_trans_list->DateOfTransaction->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfTransaction");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->DateOfTransaction->caption(), $employment_trans_list->DateOfTransaction->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfTransaction");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_list->DateOfTransaction->errorMessage()) ?>");
			<?php if ($employment_trans_list->TransactionType->Required) { ?>
				elm = this.getElements("x" + infix + "_TransactionType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->TransactionType->caption(), $employment_trans_list->TransactionType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TransactionType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_list->TransactionType->errorMessage()) ?>");
			<?php if ($employment_trans_list->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->SalaryScale->caption(), $employment_trans_list->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_trans_list->TransStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_TransStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->TransStatus->caption(), $employment_trans_list->TransStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TransStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_trans_list->TransStatus->errorMessage()) ?>");
			<?php if ($employment_trans_list->TransReason->Required) { ?>
				elm = this.getElements("x" + infix + "_TransReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_trans_list->TransReason->caption(), $employment_trans_list->TransReason->RequiredErrorMessage)) ?>");
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
	femployment_translist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ToLACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ToDept", false)) return false;
		if (ew.valueChanged(fobj, infix, "ToSection", false)) return false;
		if (ew.valueChanged(fobj, infix, "ActingPosition", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfTransaction", false)) return false;
		if (ew.valueChanged(fobj, infix, "TransactionType", false)) return false;
		if (ew.valueChanged(fobj, infix, "SalaryScale", false)) return false;
		if (ew.valueChanged(fobj, infix, "TransStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "TransReason", false)) return false;
		return true;
	}

	// Form_CustomValidate
	femployment_translist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_translist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("femployment_translist");
});
var femployment_translistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployment_translistsrch = currentSearchForm = new ew.Form("femployment_translistsrch");

	// Dynamic selection lists
	// Filters

	femployment_translistsrch.filterList = <?php echo $employment_trans_list->getFilterList() ?>;

	// Init search panel as collapsed
	femployment_translistsrch.initSearchPanel = true;
	loadjs.done("femployment_translistsrch");
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
<?php if (!$employment_trans_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employment_trans_list->TotalRecords > 0 && $employment_trans_list->ExportOptions->visible()) { ?>
<?php $employment_trans_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employment_trans_list->ImportOptions->visible()) { ?>
<?php $employment_trans_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employment_trans_list->SearchOptions->visible()) { ?>
<?php $employment_trans_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employment_trans_list->FilterOptions->visible()) { ?>
<?php $employment_trans_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employment_trans_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employment_trans_list->isExport() && !$employment_trans->CurrentAction) { ?>
<form name="femployment_translistsrch" id="femployment_translistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployment_translistsrch-search-panel" class="<?php echo $employment_trans_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employment_trans">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $employment_trans_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employment_trans_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employment_trans_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employment_trans_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employment_trans_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employment_trans_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employment_trans_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employment_trans_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employment_trans_list->showPageHeader(); ?>
<?php
$employment_trans_list->showMessage();
?>
<?php if ($employment_trans_list->TotalRecords > 0 || $employment_trans->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employment_trans_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employment_trans">
<?php if (!$employment_trans_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employment_trans_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_trans_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employment_trans_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployment_translist" id="femployment_translist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_trans">
<div id="gmp_employment_trans" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employment_trans_list->TotalRecords > 0 || $employment_trans_list->isGridEdit()) { ?>
<table id="tbl_employment_translist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employment_trans->RowType = ROWTYPE_HEADER;

// Render list options
$employment_trans_list->renderListOptions();

// Render list options (header, left)
$employment_trans_list->ListOptions->render("header", "left");
?>
<?php if ($employment_trans_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $employment_trans_list->EmployeeID->headerCellClass() ?>"><div id="elh_employment_trans_EmployeeID" class="employment_trans_EmployeeID"><div class="ew-table-header-caption"><?php echo $employment_trans_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $employment_trans_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->EmployeeID) ?>', 1);"><div id="elh_employment_trans_EmployeeID" class="employment_trans_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $employment_trans_list->ProvinceCode->headerCellClass() ?>"><div id="elh_employment_trans_ProvinceCode" class="employment_trans_ProvinceCode"><div class="ew-table-header-caption"><?php echo $employment_trans_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $employment_trans_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->ProvinceCode) ?>', 1);"><div id="elh_employment_trans_ProvinceCode" class="employment_trans_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->LACode->Visible) { // LACode ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $employment_trans_list->LACode->headerCellClass() ?>"><div id="elh_employment_trans_LACode" class="employment_trans_LACode"><div class="ew-table-header-caption"><?php echo $employment_trans_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $employment_trans_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->LACode) ?>', 1);"><div id="elh_employment_trans_LACode" class="employment_trans_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $employment_trans_list->DepartmentCode->headerCellClass() ?>"><div id="elh_employment_trans_DepartmentCode" class="employment_trans_DepartmentCode"><div class="ew-table-header-caption"><?php echo $employment_trans_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $employment_trans_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->DepartmentCode) ?>', 1);"><div id="elh_employment_trans_DepartmentCode" class="employment_trans_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $employment_trans_list->SectionCode->headerCellClass() ?>"><div id="elh_employment_trans_SectionCode" class="employment_trans_SectionCode"><div class="ew-table-header-caption"><?php echo $employment_trans_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $employment_trans_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->SectionCode) ?>', 1);"><div id="elh_employment_trans_SectionCode" class="employment_trans_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->ToLACode->Visible) { // ToLACode ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->ToLACode) == "") { ?>
		<th data-name="ToLACode" class="<?php echo $employment_trans_list->ToLACode->headerCellClass() ?>"><div id="elh_employment_trans_ToLACode" class="employment_trans_ToLACode"><div class="ew-table-header-caption"><?php echo $employment_trans_list->ToLACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ToLACode" class="<?php echo $employment_trans_list->ToLACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->ToLACode) ?>', 1);"><div id="elh_employment_trans_ToLACode" class="employment_trans_ToLACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->ToLACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->ToLACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->ToLACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->ToDept->Visible) { // ToDept ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->ToDept) == "") { ?>
		<th data-name="ToDept" class="<?php echo $employment_trans_list->ToDept->headerCellClass() ?>"><div id="elh_employment_trans_ToDept" class="employment_trans_ToDept"><div class="ew-table-header-caption"><?php echo $employment_trans_list->ToDept->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ToDept" class="<?php echo $employment_trans_list->ToDept->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->ToDept) ?>', 1);"><div id="elh_employment_trans_ToDept" class="employment_trans_ToDept">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->ToDept->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->ToDept->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->ToDept->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->ToSection->Visible) { // ToSection ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->ToSection) == "") { ?>
		<th data-name="ToSection" class="<?php echo $employment_trans_list->ToSection->headerCellClass() ?>"><div id="elh_employment_trans_ToSection" class="employment_trans_ToSection"><div class="ew-table-header-caption"><?php echo $employment_trans_list->ToSection->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ToSection" class="<?php echo $employment_trans_list->ToSection->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->ToSection) ?>', 1);"><div id="elh_employment_trans_ToSection" class="employment_trans_ToSection">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->ToSection->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->ToSection->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->ToSection->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->ActingPosition->Visible) { // ActingPosition ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->ActingPosition) == "") { ?>
		<th data-name="ActingPosition" class="<?php echo $employment_trans_list->ActingPosition->headerCellClass() ?>"><div id="elh_employment_trans_ActingPosition" class="employment_trans_ActingPosition"><div class="ew-table-header-caption"><?php echo $employment_trans_list->ActingPosition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActingPosition" class="<?php echo $employment_trans_list->ActingPosition->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->ActingPosition) ?>', 1);"><div id="elh_employment_trans_ActingPosition" class="employment_trans_ActingPosition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->ActingPosition->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->ActingPosition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->ActingPosition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->DateOfTransaction->Visible) { // DateOfTransaction ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->DateOfTransaction) == "") { ?>
		<th data-name="DateOfTransaction" class="<?php echo $employment_trans_list->DateOfTransaction->headerCellClass() ?>"><div id="elh_employment_trans_DateOfTransaction" class="employment_trans_DateOfTransaction"><div class="ew-table-header-caption"><?php echo $employment_trans_list->DateOfTransaction->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfTransaction" class="<?php echo $employment_trans_list->DateOfTransaction->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->DateOfTransaction) ?>', 1);"><div id="elh_employment_trans_DateOfTransaction" class="employment_trans_DateOfTransaction">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->DateOfTransaction->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->DateOfTransaction->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->DateOfTransaction->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->TransactionType->Visible) { // TransactionType ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->TransactionType) == "") { ?>
		<th data-name="TransactionType" class="<?php echo $employment_trans_list->TransactionType->headerCellClass() ?>"><div id="elh_employment_trans_TransactionType" class="employment_trans_TransactionType"><div class="ew-table-header-caption"><?php echo $employment_trans_list->TransactionType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransactionType" class="<?php echo $employment_trans_list->TransactionType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->TransactionType) ?>', 1);"><div id="elh_employment_trans_TransactionType" class="employment_trans_TransactionType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->TransactionType->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->TransactionType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->TransactionType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $employment_trans_list->SalaryScale->headerCellClass() ?>"><div id="elh_employment_trans_SalaryScale" class="employment_trans_SalaryScale"><div class="ew-table-header-caption"><?php echo $employment_trans_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $employment_trans_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->SalaryScale) ?>', 1);"><div id="elh_employment_trans_SalaryScale" class="employment_trans_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->SalaryScale->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->TransStatus->Visible) { // TransStatus ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->TransStatus) == "") { ?>
		<th data-name="TransStatus" class="<?php echo $employment_trans_list->TransStatus->headerCellClass() ?>"><div id="elh_employment_trans_TransStatus" class="employment_trans_TransStatus"><div class="ew-table-header-caption"><?php echo $employment_trans_list->TransStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransStatus" class="<?php echo $employment_trans_list->TransStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->TransStatus) ?>', 1);"><div id="elh_employment_trans_TransStatus" class="employment_trans_TransStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->TransStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->TransStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->TransStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_trans_list->TransReason->Visible) { // TransReason ?>
	<?php if ($employment_trans_list->SortUrl($employment_trans_list->TransReason) == "") { ?>
		<th data-name="TransReason" class="<?php echo $employment_trans_list->TransReason->headerCellClass() ?>"><div id="elh_employment_trans_TransReason" class="employment_trans_TransReason"><div class="ew-table-header-caption"><?php echo $employment_trans_list->TransReason->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransReason" class="<?php echo $employment_trans_list->TransReason->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_trans_list->SortUrl($employment_trans_list->TransReason) ?>', 1);"><div id="elh_employment_trans_TransReason" class="employment_trans_TransReason">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_trans_list->TransReason->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employment_trans_list->TransReason->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_trans_list->TransReason->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employment_trans_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employment_trans_list->ExportAll && $employment_trans_list->isExport()) {
	$employment_trans_list->StopRecord = $employment_trans_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employment_trans_list->TotalRecords > $employment_trans_list->StartRecord + $employment_trans_list->DisplayRecords - 1)
		$employment_trans_list->StopRecord = $employment_trans_list->StartRecord + $employment_trans_list->DisplayRecords - 1;
	else
		$employment_trans_list->StopRecord = $employment_trans_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($employment_trans->isConfirm() || $employment_trans_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($employment_trans_list->FormKeyCountName) && ($employment_trans_list->isGridAdd() || $employment_trans_list->isGridEdit() || $employment_trans->isConfirm())) {
		$employment_trans_list->KeyCount = $CurrentForm->getValue($employment_trans_list->FormKeyCountName);
		$employment_trans_list->StopRecord = $employment_trans_list->StartRecord + $employment_trans_list->KeyCount - 1;
	}
}
$employment_trans_list->RecordCount = $employment_trans_list->StartRecord - 1;
if ($employment_trans_list->Recordset && !$employment_trans_list->Recordset->EOF) {
	$employment_trans_list->Recordset->moveFirst();
	$selectLimit = $employment_trans_list->UseSelectLimit;
	if (!$selectLimit && $employment_trans_list->StartRecord > 1)
		$employment_trans_list->Recordset->move($employment_trans_list->StartRecord - 1);
} elseif (!$employment_trans->AllowAddDeleteRow && $employment_trans_list->StopRecord == 0) {
	$employment_trans_list->StopRecord = $employment_trans->GridAddRowCount;
}

// Initialize aggregate
$employment_trans->RowType = ROWTYPE_AGGREGATEINIT;
$employment_trans->resetAttributes();
$employment_trans_list->renderRow();
if ($employment_trans_list->isGridAdd())
	$employment_trans_list->RowIndex = 0;
while ($employment_trans_list->RecordCount < $employment_trans_list->StopRecord) {
	$employment_trans_list->RecordCount++;
	if ($employment_trans_list->RecordCount >= $employment_trans_list->StartRecord) {
		$employment_trans_list->RowCount++;
		if ($employment_trans_list->isGridAdd() || $employment_trans_list->isGridEdit() || $employment_trans->isConfirm()) {
			$employment_trans_list->RowIndex++;
			$CurrentForm->Index = $employment_trans_list->RowIndex;
			if ($CurrentForm->hasValue($employment_trans_list->FormActionName) && ($employment_trans->isConfirm() || $employment_trans_list->EventCancelled))
				$employment_trans_list->RowAction = strval($CurrentForm->getValue($employment_trans_list->FormActionName));
			elseif ($employment_trans_list->isGridAdd())
				$employment_trans_list->RowAction = "insert";
			else
				$employment_trans_list->RowAction = "";
		}

		// Set up key count
		$employment_trans_list->KeyCount = $employment_trans_list->RowIndex;

		// Init row class and style
		$employment_trans->resetAttributes();
		$employment_trans->CssClass = "";
		if ($employment_trans_list->isGridAdd()) {
			$employment_trans_list->loadRowValues(); // Load default values
		} else {
			$employment_trans_list->loadRowValues($employment_trans_list->Recordset); // Load row values
		}
		$employment_trans->RowType = ROWTYPE_VIEW; // Render view
		if ($employment_trans_list->isGridAdd()) // Grid add
			$employment_trans->RowType = ROWTYPE_ADD; // Render add
		if ($employment_trans_list->isGridAdd() && $employment_trans->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$employment_trans_list->restoreCurrentRowFormValues($employment_trans_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$employment_trans->RowAttrs->merge(["data-rowindex" => $employment_trans_list->RowCount, "id" => "r" . $employment_trans_list->RowCount . "_employment_trans", "data-rowtype" => $employment_trans->RowType]);

		// Render row
		$employment_trans_list->renderRow();

		// Render list options
		$employment_trans_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($employment_trans_list->RowAction != "delete" && $employment_trans_list->RowAction != "insertdelete" && !($employment_trans_list->RowAction == "insert" && $employment_trans->isConfirm() && $employment_trans_list->emptyRow())) {
?>
	<tr <?php echo $employment_trans->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_trans_list->ListOptions->render("body", "left", $employment_trans_list->RowCount);
?>
	<?php if ($employment_trans_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $employment_trans_list->EmployeeID->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_EmployeeID" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_EmployeeID" name="x<?php echo $employment_trans_list->RowIndex ?>_EmployeeID" id="x<?php echo $employment_trans_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->EmployeeID->EditValue ?>"<?php echo $employment_trans_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_EmployeeID" name="o<?php echo $employment_trans_list->RowIndex ?>_EmployeeID" id="o<?php echo $employment_trans_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_trans_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_EmployeeID">
<span<?php echo $employment_trans_list->EmployeeID->viewAttributes() ?>><?php echo $employment_trans_list->EmployeeID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $employment_trans_list->ProvinceCode->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_ProvinceCode" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_ProvinceCode" name="x<?php echo $employment_trans_list->RowIndex ?>_ProvinceCode" id="x<?php echo $employment_trans_list->RowIndex ?>_ProvinceCode" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->ProvinceCode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->ProvinceCode->EditValue ?>"<?php echo $employment_trans_list->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_ProvinceCode" name="o<?php echo $employment_trans_list->RowIndex ?>_ProvinceCode" id="o<?php echo $employment_trans_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_trans_list->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_ProvinceCode">
<span<?php echo $employment_trans_list->ProvinceCode->viewAttributes() ?>><?php echo $employment_trans_list->ProvinceCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $employment_trans_list->LACode->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_LACode" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_LACode" name="x<?php echo $employment_trans_list->RowIndex ?>_LACode" id="x<?php echo $employment_trans_list->RowIndex ?>_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_trans_list->LACode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->LACode->EditValue ?>"<?php echo $employment_trans_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_LACode" name="o<?php echo $employment_trans_list->RowIndex ?>_LACode" id="o<?php echo $employment_trans_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_trans_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_LACode">
<span<?php echo $employment_trans_list->LACode->viewAttributes() ?>><?php echo $employment_trans_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $employment_trans_list->DepartmentCode->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_DepartmentCode" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_DepartmentCode" name="x<?php echo $employment_trans_list->RowIndex ?>_DepartmentCode" id="x<?php echo $employment_trans_list->RowIndex ?>_DepartmentCode" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->DepartmentCode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->DepartmentCode->EditValue ?>"<?php echo $employment_trans_list->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_DepartmentCode" name="o<?php echo $employment_trans_list->RowIndex ?>_DepartmentCode" id="o<?php echo $employment_trans_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_trans_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_DepartmentCode">
<span<?php echo $employment_trans_list->DepartmentCode->viewAttributes() ?>><?php echo $employment_trans_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $employment_trans_list->SectionCode->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_SectionCode" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_SectionCode" name="x<?php echo $employment_trans_list->RowIndex ?>_SectionCode" id="x<?php echo $employment_trans_list->RowIndex ?>_SectionCode" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->SectionCode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->SectionCode->EditValue ?>"<?php echo $employment_trans_list->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_SectionCode" name="o<?php echo $employment_trans_list->RowIndex ?>_SectionCode" id="o<?php echo $employment_trans_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_trans_list->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_SectionCode">
<span<?php echo $employment_trans_list->SectionCode->viewAttributes() ?>><?php echo $employment_trans_list->SectionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->ToLACode->Visible) { // ToLACode ?>
		<td data-name="ToLACode" <?php echo $employment_trans_list->ToLACode->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_ToLACode" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_ToLACode" name="x<?php echo $employment_trans_list->RowIndex ?>_ToLACode" id="x<?php echo $employment_trans_list->RowIndex ?>_ToLACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_trans_list->ToLACode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->ToLACode->EditValue ?>"<?php echo $employment_trans_list->ToLACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_ToLACode" name="o<?php echo $employment_trans_list->RowIndex ?>_ToLACode" id="o<?php echo $employment_trans_list->RowIndex ?>_ToLACode" value="<?php echo HtmlEncode($employment_trans_list->ToLACode->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_ToLACode">
<span<?php echo $employment_trans_list->ToLACode->viewAttributes() ?>><?php echo $employment_trans_list->ToLACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->ToDept->Visible) { // ToDept ?>
		<td data-name="ToDept" <?php echo $employment_trans_list->ToDept->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_ToDept" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_ToDept" name="x<?php echo $employment_trans_list->RowIndex ?>_ToDept" id="x<?php echo $employment_trans_list->RowIndex ?>_ToDept" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->ToDept->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->ToDept->EditValue ?>"<?php echo $employment_trans_list->ToDept->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_ToDept" name="o<?php echo $employment_trans_list->RowIndex ?>_ToDept" id="o<?php echo $employment_trans_list->RowIndex ?>_ToDept" value="<?php echo HtmlEncode($employment_trans_list->ToDept->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_ToDept">
<span<?php echo $employment_trans_list->ToDept->viewAttributes() ?>><?php echo $employment_trans_list->ToDept->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->ToSection->Visible) { // ToSection ?>
		<td data-name="ToSection" <?php echo $employment_trans_list->ToSection->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_ToSection" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_ToSection" name="x<?php echo $employment_trans_list->RowIndex ?>_ToSection" id="x<?php echo $employment_trans_list->RowIndex ?>_ToSection" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->ToSection->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->ToSection->EditValue ?>"<?php echo $employment_trans_list->ToSection->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_ToSection" name="o<?php echo $employment_trans_list->RowIndex ?>_ToSection" id="o<?php echo $employment_trans_list->RowIndex ?>_ToSection" value="<?php echo HtmlEncode($employment_trans_list->ToSection->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_ToSection">
<span<?php echo $employment_trans_list->ToSection->viewAttributes() ?>><?php echo $employment_trans_list->ToSection->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->ActingPosition->Visible) { // ActingPosition ?>
		<td data-name="ActingPosition" <?php echo $employment_trans_list->ActingPosition->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_ActingPosition" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_ActingPosition" name="x<?php echo $employment_trans_list->RowIndex ?>_ActingPosition" id="x<?php echo $employment_trans_list->RowIndex ?>_ActingPosition" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->ActingPosition->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->ActingPosition->EditValue ?>"<?php echo $employment_trans_list->ActingPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_ActingPosition" name="o<?php echo $employment_trans_list->RowIndex ?>_ActingPosition" id="o<?php echo $employment_trans_list->RowIndex ?>_ActingPosition" value="<?php echo HtmlEncode($employment_trans_list->ActingPosition->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_ActingPosition">
<span<?php echo $employment_trans_list->ActingPosition->viewAttributes() ?>><?php echo $employment_trans_list->ActingPosition->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->DateOfTransaction->Visible) { // DateOfTransaction ?>
		<td data-name="DateOfTransaction" <?php echo $employment_trans_list->DateOfTransaction->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_DateOfTransaction" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_DateOfTransaction" name="x<?php echo $employment_trans_list->RowIndex ?>_DateOfTransaction" id="x<?php echo $employment_trans_list->RowIndex ?>_DateOfTransaction" placeholder="<?php echo HtmlEncode($employment_trans_list->DateOfTransaction->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->DateOfTransaction->EditValue ?>"<?php echo $employment_trans_list->DateOfTransaction->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_DateOfTransaction" name="o<?php echo $employment_trans_list->RowIndex ?>_DateOfTransaction" id="o<?php echo $employment_trans_list->RowIndex ?>_DateOfTransaction" value="<?php echo HtmlEncode($employment_trans_list->DateOfTransaction->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_DateOfTransaction">
<span<?php echo $employment_trans_list->DateOfTransaction->viewAttributes() ?>><?php echo $employment_trans_list->DateOfTransaction->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->TransactionType->Visible) { // TransactionType ?>
		<td data-name="TransactionType" <?php echo $employment_trans_list->TransactionType->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_TransactionType" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_TransactionType" name="x<?php echo $employment_trans_list->RowIndex ?>_TransactionType" id="x<?php echo $employment_trans_list->RowIndex ?>_TransactionType" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->TransactionType->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->TransactionType->EditValue ?>"<?php echo $employment_trans_list->TransactionType->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_TransactionType" name="o<?php echo $employment_trans_list->RowIndex ?>_TransactionType" id="o<?php echo $employment_trans_list->RowIndex ?>_TransactionType" value="<?php echo HtmlEncode($employment_trans_list->TransactionType->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_TransactionType">
<span<?php echo $employment_trans_list->TransactionType->viewAttributes() ?>><?php echo $employment_trans_list->TransactionType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $employment_trans_list->SalaryScale->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_SalaryScale" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_SalaryScale" name="x<?php echo $employment_trans_list->RowIndex ?>_SalaryScale" id="x<?php echo $employment_trans_list->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_trans_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->SalaryScale->EditValue ?>"<?php echo $employment_trans_list->SalaryScale->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_SalaryScale" name="o<?php echo $employment_trans_list->RowIndex ?>_SalaryScale" id="o<?php echo $employment_trans_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($employment_trans_list->SalaryScale->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_SalaryScale">
<span<?php echo $employment_trans_list->SalaryScale->viewAttributes() ?>><?php echo $employment_trans_list->SalaryScale->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->TransStatus->Visible) { // TransStatus ?>
		<td data-name="TransStatus" <?php echo $employment_trans_list->TransStatus->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_TransStatus" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_TransStatus" name="x<?php echo $employment_trans_list->RowIndex ?>_TransStatus" id="x<?php echo $employment_trans_list->RowIndex ?>_TransStatus" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->TransStatus->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->TransStatus->EditValue ?>"<?php echo $employment_trans_list->TransStatus->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_TransStatus" name="o<?php echo $employment_trans_list->RowIndex ?>_TransStatus" id="o<?php echo $employment_trans_list->RowIndex ?>_TransStatus" value="<?php echo HtmlEncode($employment_trans_list->TransStatus->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_TransStatus">
<span<?php echo $employment_trans_list->TransStatus->viewAttributes() ?>><?php echo $employment_trans_list->TransStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_trans_list->TransReason->Visible) { // TransReason ?>
		<td data-name="TransReason" <?php echo $employment_trans_list->TransReason->cellAttributes() ?>>
<?php if ($employment_trans->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_TransReason" class="form-group">
<input type="text" data-table="employment_trans" data-field="x_TransReason" name="x<?php echo $employment_trans_list->RowIndex ?>_TransReason" id="x<?php echo $employment_trans_list->RowIndex ?>_TransReason" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employment_trans_list->TransReason->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->TransReason->EditValue ?>"<?php echo $employment_trans_list->TransReason->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_TransReason" name="o<?php echo $employment_trans_list->RowIndex ?>_TransReason" id="o<?php echo $employment_trans_list->RowIndex ?>_TransReason" value="<?php echo HtmlEncode($employment_trans_list->TransReason->OldValue) ?>">
<?php } ?>
<?php if ($employment_trans->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_trans_list->RowCount ?>_employment_trans_TransReason">
<span<?php echo $employment_trans_list->TransReason->viewAttributes() ?>><?php echo $employment_trans_list->TransReason->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_trans_list->ListOptions->render("body", "right", $employment_trans_list->RowCount);
?>
	</tr>
<?php if ($employment_trans->RowType == ROWTYPE_ADD || $employment_trans->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["femployment_translist", "load"], function() {
	femployment_translist.updateLists(<?php echo $employment_trans_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$employment_trans_list->isGridAdd())
		if (!$employment_trans_list->Recordset->EOF)
			$employment_trans_list->Recordset->moveNext();
}
?>
<?php
	if ($employment_trans_list->isGridAdd() || $employment_trans_list->isGridEdit()) {
		$employment_trans_list->RowIndex = '$rowindex$';
		$employment_trans_list->loadRowValues();

		// Set row properties
		$employment_trans->resetAttributes();
		$employment_trans->RowAttrs->merge(["data-rowindex" => $employment_trans_list->RowIndex, "id" => "r0_employment_trans", "data-rowtype" => ROWTYPE_ADD]);
		$employment_trans->RowAttrs->appendClass("ew-template");
		$employment_trans->RowType = ROWTYPE_ADD;

		// Render row
		$employment_trans_list->renderRow();

		// Render list options
		$employment_trans_list->renderListOptions();
		$employment_trans_list->StartRowCount = 0;
?>
	<tr <?php echo $employment_trans->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_trans_list->ListOptions->render("body", "left", $employment_trans_list->RowIndex);
?>
	<?php if ($employment_trans_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<span id="el$rowindex$_employment_trans_EmployeeID" class="form-group employment_trans_EmployeeID">
<input type="text" data-table="employment_trans" data-field="x_EmployeeID" name="x<?php echo $employment_trans_list->RowIndex ?>_EmployeeID" id="x<?php echo $employment_trans_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->EmployeeID->EditValue ?>"<?php echo $employment_trans_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_EmployeeID" name="o<?php echo $employment_trans_list->RowIndex ?>_EmployeeID" id="o<?php echo $employment_trans_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_trans_list->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<span id="el$rowindex$_employment_trans_ProvinceCode" class="form-group employment_trans_ProvinceCode">
<input type="text" data-table="employment_trans" data-field="x_ProvinceCode" name="x<?php echo $employment_trans_list->RowIndex ?>_ProvinceCode" id="x<?php echo $employment_trans_list->RowIndex ?>_ProvinceCode" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->ProvinceCode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->ProvinceCode->EditValue ?>"<?php echo $employment_trans_list->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_ProvinceCode" name="o<?php echo $employment_trans_list->RowIndex ?>_ProvinceCode" id="o<?php echo $employment_trans_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($employment_trans_list->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<span id="el$rowindex$_employment_trans_LACode" class="form-group employment_trans_LACode">
<input type="text" data-table="employment_trans" data-field="x_LACode" name="x<?php echo $employment_trans_list->RowIndex ?>_LACode" id="x<?php echo $employment_trans_list->RowIndex ?>_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_trans_list->LACode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->LACode->EditValue ?>"<?php echo $employment_trans_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_LACode" name="o<?php echo $employment_trans_list->RowIndex ?>_LACode" id="o<?php echo $employment_trans_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($employment_trans_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<span id="el$rowindex$_employment_trans_DepartmentCode" class="form-group employment_trans_DepartmentCode">
<input type="text" data-table="employment_trans" data-field="x_DepartmentCode" name="x<?php echo $employment_trans_list->RowIndex ?>_DepartmentCode" id="x<?php echo $employment_trans_list->RowIndex ?>_DepartmentCode" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->DepartmentCode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->DepartmentCode->EditValue ?>"<?php echo $employment_trans_list->DepartmentCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_DepartmentCode" name="o<?php echo $employment_trans_list->RowIndex ?>_DepartmentCode" id="o<?php echo $employment_trans_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($employment_trans_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<span id="el$rowindex$_employment_trans_SectionCode" class="form-group employment_trans_SectionCode">
<input type="text" data-table="employment_trans" data-field="x_SectionCode" name="x<?php echo $employment_trans_list->RowIndex ?>_SectionCode" id="x<?php echo $employment_trans_list->RowIndex ?>_SectionCode" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->SectionCode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->SectionCode->EditValue ?>"<?php echo $employment_trans_list->SectionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_SectionCode" name="o<?php echo $employment_trans_list->RowIndex ?>_SectionCode" id="o<?php echo $employment_trans_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($employment_trans_list->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->ToLACode->Visible) { // ToLACode ?>
		<td data-name="ToLACode">
<span id="el$rowindex$_employment_trans_ToLACode" class="form-group employment_trans_ToLACode">
<input type="text" data-table="employment_trans" data-field="x_ToLACode" name="x<?php echo $employment_trans_list->RowIndex ?>_ToLACode" id="x<?php echo $employment_trans_list->RowIndex ?>_ToLACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_trans_list->ToLACode->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->ToLACode->EditValue ?>"<?php echo $employment_trans_list->ToLACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_ToLACode" name="o<?php echo $employment_trans_list->RowIndex ?>_ToLACode" id="o<?php echo $employment_trans_list->RowIndex ?>_ToLACode" value="<?php echo HtmlEncode($employment_trans_list->ToLACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->ToDept->Visible) { // ToDept ?>
		<td data-name="ToDept">
<span id="el$rowindex$_employment_trans_ToDept" class="form-group employment_trans_ToDept">
<input type="text" data-table="employment_trans" data-field="x_ToDept" name="x<?php echo $employment_trans_list->RowIndex ?>_ToDept" id="x<?php echo $employment_trans_list->RowIndex ?>_ToDept" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->ToDept->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->ToDept->EditValue ?>"<?php echo $employment_trans_list->ToDept->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_ToDept" name="o<?php echo $employment_trans_list->RowIndex ?>_ToDept" id="o<?php echo $employment_trans_list->RowIndex ?>_ToDept" value="<?php echo HtmlEncode($employment_trans_list->ToDept->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->ToSection->Visible) { // ToSection ?>
		<td data-name="ToSection">
<span id="el$rowindex$_employment_trans_ToSection" class="form-group employment_trans_ToSection">
<input type="text" data-table="employment_trans" data-field="x_ToSection" name="x<?php echo $employment_trans_list->RowIndex ?>_ToSection" id="x<?php echo $employment_trans_list->RowIndex ?>_ToSection" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->ToSection->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->ToSection->EditValue ?>"<?php echo $employment_trans_list->ToSection->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_ToSection" name="o<?php echo $employment_trans_list->RowIndex ?>_ToSection" id="o<?php echo $employment_trans_list->RowIndex ?>_ToSection" value="<?php echo HtmlEncode($employment_trans_list->ToSection->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->ActingPosition->Visible) { // ActingPosition ?>
		<td data-name="ActingPosition">
<span id="el$rowindex$_employment_trans_ActingPosition" class="form-group employment_trans_ActingPosition">
<input type="text" data-table="employment_trans" data-field="x_ActingPosition" name="x<?php echo $employment_trans_list->RowIndex ?>_ActingPosition" id="x<?php echo $employment_trans_list->RowIndex ?>_ActingPosition" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->ActingPosition->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->ActingPosition->EditValue ?>"<?php echo $employment_trans_list->ActingPosition->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_ActingPosition" name="o<?php echo $employment_trans_list->RowIndex ?>_ActingPosition" id="o<?php echo $employment_trans_list->RowIndex ?>_ActingPosition" value="<?php echo HtmlEncode($employment_trans_list->ActingPosition->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->DateOfTransaction->Visible) { // DateOfTransaction ?>
		<td data-name="DateOfTransaction">
<span id="el$rowindex$_employment_trans_DateOfTransaction" class="form-group employment_trans_DateOfTransaction">
<input type="text" data-table="employment_trans" data-field="x_DateOfTransaction" name="x<?php echo $employment_trans_list->RowIndex ?>_DateOfTransaction" id="x<?php echo $employment_trans_list->RowIndex ?>_DateOfTransaction" placeholder="<?php echo HtmlEncode($employment_trans_list->DateOfTransaction->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->DateOfTransaction->EditValue ?>"<?php echo $employment_trans_list->DateOfTransaction->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_DateOfTransaction" name="o<?php echo $employment_trans_list->RowIndex ?>_DateOfTransaction" id="o<?php echo $employment_trans_list->RowIndex ?>_DateOfTransaction" value="<?php echo HtmlEncode($employment_trans_list->DateOfTransaction->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->TransactionType->Visible) { // TransactionType ?>
		<td data-name="TransactionType">
<span id="el$rowindex$_employment_trans_TransactionType" class="form-group employment_trans_TransactionType">
<input type="text" data-table="employment_trans" data-field="x_TransactionType" name="x<?php echo $employment_trans_list->RowIndex ?>_TransactionType" id="x<?php echo $employment_trans_list->RowIndex ?>_TransactionType" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->TransactionType->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->TransactionType->EditValue ?>"<?php echo $employment_trans_list->TransactionType->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_TransactionType" name="o<?php echo $employment_trans_list->RowIndex ?>_TransactionType" id="o<?php echo $employment_trans_list->RowIndex ?>_TransactionType" value="<?php echo HtmlEncode($employment_trans_list->TransactionType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<span id="el$rowindex$_employment_trans_SalaryScale" class="form-group employment_trans_SalaryScale">
<input type="text" data-table="employment_trans" data-field="x_SalaryScale" name="x<?php echo $employment_trans_list->RowIndex ?>_SalaryScale" id="x<?php echo $employment_trans_list->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_trans_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->SalaryScale->EditValue ?>"<?php echo $employment_trans_list->SalaryScale->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_SalaryScale" name="o<?php echo $employment_trans_list->RowIndex ?>_SalaryScale" id="o<?php echo $employment_trans_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($employment_trans_list->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->TransStatus->Visible) { // TransStatus ?>
		<td data-name="TransStatus">
<span id="el$rowindex$_employment_trans_TransStatus" class="form-group employment_trans_TransStatus">
<input type="text" data-table="employment_trans" data-field="x_TransStatus" name="x<?php echo $employment_trans_list->RowIndex ?>_TransStatus" id="x<?php echo $employment_trans_list->RowIndex ?>_TransStatus" size="30" placeholder="<?php echo HtmlEncode($employment_trans_list->TransStatus->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->TransStatus->EditValue ?>"<?php echo $employment_trans_list->TransStatus->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_TransStatus" name="o<?php echo $employment_trans_list->RowIndex ?>_TransStatus" id="o<?php echo $employment_trans_list->RowIndex ?>_TransStatus" value="<?php echo HtmlEncode($employment_trans_list->TransStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_trans_list->TransReason->Visible) { // TransReason ?>
		<td data-name="TransReason">
<span id="el$rowindex$_employment_trans_TransReason" class="form-group employment_trans_TransReason">
<input type="text" data-table="employment_trans" data-field="x_TransReason" name="x<?php echo $employment_trans_list->RowIndex ?>_TransReason" id="x<?php echo $employment_trans_list->RowIndex ?>_TransReason" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($employment_trans_list->TransReason->getPlaceHolder()) ?>" value="<?php echo $employment_trans_list->TransReason->EditValue ?>"<?php echo $employment_trans_list->TransReason->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_trans" data-field="x_TransReason" name="o<?php echo $employment_trans_list->RowIndex ?>_TransReason" id="o<?php echo $employment_trans_list->RowIndex ?>_TransReason" value="<?php echo HtmlEncode($employment_trans_list->TransReason->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_trans_list->ListOptions->render("body", "right", $employment_trans_list->RowIndex);
?>
<script>
loadjs.ready(["femployment_translist", "load"], function() {
	femployment_translist.updateLists(<?php echo $employment_trans_list->RowIndex ?>);
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
<?php if ($employment_trans_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $employment_trans_list->FormKeyCountName ?>" id="<?php echo $employment_trans_list->FormKeyCountName ?>" value="<?php echo $employment_trans_list->KeyCount ?>">
<?php echo $employment_trans_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$employment_trans->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employment_trans_list->Recordset)
	$employment_trans_list->Recordset->Close();
?>
<?php if (!$employment_trans_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employment_trans_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_trans_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employment_trans_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employment_trans_list->TotalRecords == 0 && !$employment_trans->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employment_trans_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employment_trans_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employment_trans_list->isExport()) { ?>
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
$employment_trans_list->terminate();
?>