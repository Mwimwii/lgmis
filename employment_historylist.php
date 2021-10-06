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
$employment_history_list = new employment_history_list();

// Run the page
$employment_history_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employment_history_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employment_history_list->isExport()) { ?>
<script>
var femployment_historylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployment_historylist = currentForm = new ew.Form("femployment_historylist", "list");
	femployment_historylist.formKeyCountName = '<?php echo $employment_history_list->FormKeyCountName ?>';

	// Validate form
	femployment_historylist.validate = function() {
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
			<?php if ($employment_history_list->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_list->EmployeeID->caption(), $employment_history_list->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_list->EmployeeID->errorMessage()) ?>");
			<?php if ($employment_history_list->Position->Required) { ?>
				elm = this.getElements("x" + infix + "_Position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_list->Position->caption(), $employment_history_list->Position->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Position");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_list->Position->errorMessage()) ?>");
			<?php if ($employment_history_list->DateOfAppointment->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfAppointment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_list->DateOfAppointment->caption(), $employment_history_list->DateOfAppointment->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfAppointment");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_list->DateOfAppointment->errorMessage()) ?>");
			<?php if ($employment_history_list->DateOfExit->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_list->DateOfExit->caption(), $employment_history_list->DateOfExit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfExit");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_list->DateOfExit->errorMessage()) ?>");
			<?php if ($employment_history_list->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_list->SalaryScale->caption(), $employment_history_list->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($employment_history_list->EmploymentType->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_list->EmploymentType->caption(), $employment_history_list->EmploymentType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmploymentType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_list->EmploymentType->errorMessage()) ?>");
			<?php if ($employment_history_list->EmploymentStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_EmploymentStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_list->EmploymentStatus->caption(), $employment_history_list->EmploymentStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmploymentStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_list->EmploymentStatus->errorMessage()) ?>");
			<?php if ($employment_history_list->ExitReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_list->ExitReason->caption(), $employment_history_list->ExitReason->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_list->ExitReason->errorMessage()) ?>");
			<?php if ($employment_history_list->RetirementType->Required) { ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $employment_history_list->RetirementType->caption(), $employment_history_list->RetirementType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RetirementType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($employment_history_list->RetirementType->errorMessage()) ?>");

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
	femployment_historylist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "Position", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfAppointment", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfExit", false)) return false;
		if (ew.valueChanged(fobj, infix, "SalaryScale", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmploymentType", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmploymentStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "ExitReason", false)) return false;
		if (ew.valueChanged(fobj, infix, "RetirementType", false)) return false;
		return true;
	}

	// Form_CustomValidate
	femployment_historylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	femployment_historylist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("femployment_historylist");
});
var femployment_historylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployment_historylistsrch = currentSearchForm = new ew.Form("femployment_historylistsrch");

	// Dynamic selection lists
	// Filters

	femployment_historylistsrch.filterList = <?php echo $employment_history_list->getFilterList() ?>;

	// Init search panel as collapsed
	femployment_historylistsrch.initSearchPanel = true;
	loadjs.done("femployment_historylistsrch");
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
<?php if (!$employment_history_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employment_history_list->TotalRecords > 0 && $employment_history_list->ExportOptions->visible()) { ?>
<?php $employment_history_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employment_history_list->ImportOptions->visible()) { ?>
<?php $employment_history_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employment_history_list->SearchOptions->visible()) { ?>
<?php $employment_history_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employment_history_list->FilterOptions->visible()) { ?>
<?php $employment_history_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employment_history_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employment_history_list->isExport() && !$employment_history->CurrentAction) { ?>
<form name="femployment_historylistsrch" id="femployment_historylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployment_historylistsrch-search-panel" class="<?php echo $employment_history_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employment_history">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $employment_history_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employment_history_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employment_history_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employment_history_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employment_history_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employment_history_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employment_history_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employment_history_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employment_history_list->showPageHeader(); ?>
<?php
$employment_history_list->showMessage();
?>
<?php if ($employment_history_list->TotalRecords > 0 || $employment_history->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employment_history_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employment_history">
<?php if (!$employment_history_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employment_history_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_history_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employment_history_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployment_historylist" id="femployment_historylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employment_history">
<div id="gmp_employment_history" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employment_history_list->TotalRecords > 0 || $employment_history_list->isGridEdit()) { ?>
<table id="tbl_employment_historylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employment_history->RowType = ROWTYPE_HEADER;

// Render list options
$employment_history_list->renderListOptions();

// Render list options (header, left)
$employment_history_list->ListOptions->render("header", "left");
?>
<?php if ($employment_history_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($employment_history_list->SortUrl($employment_history_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $employment_history_list->EmployeeID->headerCellClass() ?>"><div id="elh_employment_history_EmployeeID" class="employment_history_EmployeeID"><div class="ew-table-header-caption"><?php echo $employment_history_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $employment_history_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_history_list->SortUrl($employment_history_list->EmployeeID) ?>', 1);"><div id="elh_employment_history_EmployeeID" class="employment_history_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_history_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_history_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_history_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_history_list->Position->Visible) { // Position ?>
	<?php if ($employment_history_list->SortUrl($employment_history_list->Position) == "") { ?>
		<th data-name="Position" class="<?php echo $employment_history_list->Position->headerCellClass() ?>"><div id="elh_employment_history_Position" class="employment_history_Position"><div class="ew-table-header-caption"><?php echo $employment_history_list->Position->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Position" class="<?php echo $employment_history_list->Position->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_history_list->SortUrl($employment_history_list->Position) ?>', 1);"><div id="elh_employment_history_Position" class="employment_history_Position">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_history_list->Position->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_history_list->Position->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_history_list->Position->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_history_list->DateOfAppointment->Visible) { // DateOfAppointment ?>
	<?php if ($employment_history_list->SortUrl($employment_history_list->DateOfAppointment) == "") { ?>
		<th data-name="DateOfAppointment" class="<?php echo $employment_history_list->DateOfAppointment->headerCellClass() ?>"><div id="elh_employment_history_DateOfAppointment" class="employment_history_DateOfAppointment"><div class="ew-table-header-caption"><?php echo $employment_history_list->DateOfAppointment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfAppointment" class="<?php echo $employment_history_list->DateOfAppointment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_history_list->SortUrl($employment_history_list->DateOfAppointment) ?>', 1);"><div id="elh_employment_history_DateOfAppointment" class="employment_history_DateOfAppointment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_history_list->DateOfAppointment->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_history_list->DateOfAppointment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_history_list->DateOfAppointment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_history_list->DateOfExit->Visible) { // DateOfExit ?>
	<?php if ($employment_history_list->SortUrl($employment_history_list->DateOfExit) == "") { ?>
		<th data-name="DateOfExit" class="<?php echo $employment_history_list->DateOfExit->headerCellClass() ?>"><div id="elh_employment_history_DateOfExit" class="employment_history_DateOfExit"><div class="ew-table-header-caption"><?php echo $employment_history_list->DateOfExit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfExit" class="<?php echo $employment_history_list->DateOfExit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_history_list->SortUrl($employment_history_list->DateOfExit) ?>', 1);"><div id="elh_employment_history_DateOfExit" class="employment_history_DateOfExit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_history_list->DateOfExit->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_history_list->DateOfExit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_history_list->DateOfExit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_history_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($employment_history_list->SortUrl($employment_history_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $employment_history_list->SalaryScale->headerCellClass() ?>"><div id="elh_employment_history_SalaryScale" class="employment_history_SalaryScale"><div class="ew-table-header-caption"><?php echo $employment_history_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $employment_history_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_history_list->SortUrl($employment_history_list->SalaryScale) ?>', 1);"><div id="elh_employment_history_SalaryScale" class="employment_history_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_history_list->SalaryScale->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employment_history_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_history_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_history_list->EmploymentType->Visible) { // EmploymentType ?>
	<?php if ($employment_history_list->SortUrl($employment_history_list->EmploymentType) == "") { ?>
		<th data-name="EmploymentType" class="<?php echo $employment_history_list->EmploymentType->headerCellClass() ?>"><div id="elh_employment_history_EmploymentType" class="employment_history_EmploymentType"><div class="ew-table-header-caption"><?php echo $employment_history_list->EmploymentType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentType" class="<?php echo $employment_history_list->EmploymentType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_history_list->SortUrl($employment_history_list->EmploymentType) ?>', 1);"><div id="elh_employment_history_EmploymentType" class="employment_history_EmploymentType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_history_list->EmploymentType->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_history_list->EmploymentType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_history_list->EmploymentType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_history_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<?php if ($employment_history_list->SortUrl($employment_history_list->EmploymentStatus) == "") { ?>
		<th data-name="EmploymentStatus" class="<?php echo $employment_history_list->EmploymentStatus->headerCellClass() ?>"><div id="elh_employment_history_EmploymentStatus" class="employment_history_EmploymentStatus"><div class="ew-table-header-caption"><?php echo $employment_history_list->EmploymentStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentStatus" class="<?php echo $employment_history_list->EmploymentStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_history_list->SortUrl($employment_history_list->EmploymentStatus) ?>', 1);"><div id="elh_employment_history_EmploymentStatus" class="employment_history_EmploymentStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_history_list->EmploymentStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_history_list->EmploymentStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_history_list->EmploymentStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_history_list->ExitReason->Visible) { // ExitReason ?>
	<?php if ($employment_history_list->SortUrl($employment_history_list->ExitReason) == "") { ?>
		<th data-name="ExitReason" class="<?php echo $employment_history_list->ExitReason->headerCellClass() ?>"><div id="elh_employment_history_ExitReason" class="employment_history_ExitReason"><div class="ew-table-header-caption"><?php echo $employment_history_list->ExitReason->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExitReason" class="<?php echo $employment_history_list->ExitReason->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_history_list->SortUrl($employment_history_list->ExitReason) ?>', 1);"><div id="elh_employment_history_ExitReason" class="employment_history_ExitReason">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_history_list->ExitReason->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_history_list->ExitReason->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_history_list->ExitReason->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employment_history_list->RetirementType->Visible) { // RetirementType ?>
	<?php if ($employment_history_list->SortUrl($employment_history_list->RetirementType) == "") { ?>
		<th data-name="RetirementType" class="<?php echo $employment_history_list->RetirementType->headerCellClass() ?>"><div id="elh_employment_history_RetirementType" class="employment_history_RetirementType"><div class="ew-table-header-caption"><?php echo $employment_history_list->RetirementType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RetirementType" class="<?php echo $employment_history_list->RetirementType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employment_history_list->SortUrl($employment_history_list->RetirementType) ?>', 1);"><div id="elh_employment_history_RetirementType" class="employment_history_RetirementType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employment_history_list->RetirementType->caption() ?></span><span class="ew-table-header-sort"><?php if ($employment_history_list->RetirementType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employment_history_list->RetirementType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employment_history_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employment_history_list->ExportAll && $employment_history_list->isExport()) {
	$employment_history_list->StopRecord = $employment_history_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employment_history_list->TotalRecords > $employment_history_list->StartRecord + $employment_history_list->DisplayRecords - 1)
		$employment_history_list->StopRecord = $employment_history_list->StartRecord + $employment_history_list->DisplayRecords - 1;
	else
		$employment_history_list->StopRecord = $employment_history_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($employment_history->isConfirm() || $employment_history_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($employment_history_list->FormKeyCountName) && ($employment_history_list->isGridAdd() || $employment_history_list->isGridEdit() || $employment_history->isConfirm())) {
		$employment_history_list->KeyCount = $CurrentForm->getValue($employment_history_list->FormKeyCountName);
		$employment_history_list->StopRecord = $employment_history_list->StartRecord + $employment_history_list->KeyCount - 1;
	}
}
$employment_history_list->RecordCount = $employment_history_list->StartRecord - 1;
if ($employment_history_list->Recordset && !$employment_history_list->Recordset->EOF) {
	$employment_history_list->Recordset->moveFirst();
	$selectLimit = $employment_history_list->UseSelectLimit;
	if (!$selectLimit && $employment_history_list->StartRecord > 1)
		$employment_history_list->Recordset->move($employment_history_list->StartRecord - 1);
} elseif (!$employment_history->AllowAddDeleteRow && $employment_history_list->StopRecord == 0) {
	$employment_history_list->StopRecord = $employment_history->GridAddRowCount;
}

// Initialize aggregate
$employment_history->RowType = ROWTYPE_AGGREGATEINIT;
$employment_history->resetAttributes();
$employment_history_list->renderRow();
if ($employment_history_list->isGridAdd())
	$employment_history_list->RowIndex = 0;
if ($employment_history_list->isGridEdit())
	$employment_history_list->RowIndex = 0;
while ($employment_history_list->RecordCount < $employment_history_list->StopRecord) {
	$employment_history_list->RecordCount++;
	if ($employment_history_list->RecordCount >= $employment_history_list->StartRecord) {
		$employment_history_list->RowCount++;
		if ($employment_history_list->isGridAdd() || $employment_history_list->isGridEdit() || $employment_history->isConfirm()) {
			$employment_history_list->RowIndex++;
			$CurrentForm->Index = $employment_history_list->RowIndex;
			if ($CurrentForm->hasValue($employment_history_list->FormActionName) && ($employment_history->isConfirm() || $employment_history_list->EventCancelled))
				$employment_history_list->RowAction = strval($CurrentForm->getValue($employment_history_list->FormActionName));
			elseif ($employment_history_list->isGridAdd())
				$employment_history_list->RowAction = "insert";
			else
				$employment_history_list->RowAction = "";
		}

		// Set up key count
		$employment_history_list->KeyCount = $employment_history_list->RowIndex;

		// Init row class and style
		$employment_history->resetAttributes();
		$employment_history->CssClass = "";
		if ($employment_history_list->isGridAdd()) {
			$employment_history_list->loadRowValues(); // Load default values
		} else {
			$employment_history_list->loadRowValues($employment_history_list->Recordset); // Load row values
		}
		$employment_history->RowType = ROWTYPE_VIEW; // Render view
		if ($employment_history_list->isGridAdd()) // Grid add
			$employment_history->RowType = ROWTYPE_ADD; // Render add
		if ($employment_history_list->isGridAdd() && $employment_history->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$employment_history_list->restoreCurrentRowFormValues($employment_history_list->RowIndex); // Restore form values
		if ($employment_history_list->isGridEdit()) { // Grid edit
			if ($employment_history->EventCancelled)
				$employment_history_list->restoreCurrentRowFormValues($employment_history_list->RowIndex); // Restore form values
			if ($employment_history_list->RowAction == "insert")
				$employment_history->RowType = ROWTYPE_ADD; // Render add
			else
				$employment_history->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($employment_history_list->isGridEdit() && ($employment_history->RowType == ROWTYPE_EDIT || $employment_history->RowType == ROWTYPE_ADD) && $employment_history->EventCancelled) // Update failed
			$employment_history_list->restoreCurrentRowFormValues($employment_history_list->RowIndex); // Restore form values
		if ($employment_history->RowType == ROWTYPE_EDIT) // Edit row
			$employment_history_list->EditRowCount++;

		// Set up row id / data-rowindex
		$employment_history->RowAttrs->merge(["data-rowindex" => $employment_history_list->RowCount, "id" => "r" . $employment_history_list->RowCount . "_employment_history", "data-rowtype" => $employment_history->RowType]);

		// Render row
		$employment_history_list->renderRow();

		// Render list options
		$employment_history_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($employment_history_list->RowAction != "delete" && $employment_history_list->RowAction != "insertdelete" && !($employment_history_list->RowAction == "insert" && $employment_history->isConfirm() && $employment_history_list->emptyRow())) {
?>
	<tr <?php echo $employment_history->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_history_list->ListOptions->render("body", "left", $employment_history_list->RowCount);
?>
	<?php if ($employment_history_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $employment_history_list->EmployeeID->cellAttributes() ?>>
<?php if ($employment_history->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_EmployeeID" class="form-group">
<input type="text" data-table="employment_history" data-field="x_EmployeeID" name="x<?php echo $employment_history_list->RowIndex ?>_EmployeeID" id="x<?php echo $employment_history_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->EmployeeID->EditValue ?>"<?php echo $employment_history_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_EmployeeID" name="o<?php echo $employment_history_list->RowIndex ?>_EmployeeID" id="o<?php echo $employment_history_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_history_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="employment_history" data-field="x_EmployeeID" name="x<?php echo $employment_history_list->RowIndex ?>_EmployeeID" id="x<?php echo $employment_history_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->EmployeeID->EditValue ?>"<?php echo $employment_history_list->EmployeeID->editAttributes() ?>>
<input type="hidden" data-table="employment_history" data-field="x_EmployeeID" name="o<?php echo $employment_history_list->RowIndex ?>_EmployeeID" id="o<?php echo $employment_history_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_history_list->EmployeeID->OldValue != null ? $employment_history_list->EmployeeID->OldValue : $employment_history_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_EmployeeID">
<span<?php echo $employment_history_list->EmployeeID->viewAttributes() ?>><?php echo $employment_history_list->EmployeeID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_history_list->Position->Visible) { // Position ?>
		<td data-name="Position" <?php echo $employment_history_list->Position->cellAttributes() ?>>
<?php if ($employment_history->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_Position" class="form-group">
<input type="text" data-table="employment_history" data-field="x_Position" name="x<?php echo $employment_history_list->RowIndex ?>_Position" id="x<?php echo $employment_history_list->RowIndex ?>_Position" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->Position->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->Position->EditValue ?>"<?php echo $employment_history_list->Position->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_Position" name="o<?php echo $employment_history_list->RowIndex ?>_Position" id="o<?php echo $employment_history_list->RowIndex ?>_Position" value="<?php echo HtmlEncode($employment_history_list->Position->OldValue) ?>">
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="employment_history" data-field="x_Position" name="x<?php echo $employment_history_list->RowIndex ?>_Position" id="x<?php echo $employment_history_list->RowIndex ?>_Position" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->Position->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->Position->EditValue ?>"<?php echo $employment_history_list->Position->editAttributes() ?>>
<input type="hidden" data-table="employment_history" data-field="x_Position" name="o<?php echo $employment_history_list->RowIndex ?>_Position" id="o<?php echo $employment_history_list->RowIndex ?>_Position" value="<?php echo HtmlEncode($employment_history_list->Position->OldValue != null ? $employment_history_list->Position->OldValue : $employment_history_list->Position->CurrentValue) ?>">
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_Position">
<span<?php echo $employment_history_list->Position->viewAttributes() ?>><?php echo $employment_history_list->Position->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_history_list->DateOfAppointment->Visible) { // DateOfAppointment ?>
		<td data-name="DateOfAppointment" <?php echo $employment_history_list->DateOfAppointment->cellAttributes() ?>>
<?php if ($employment_history->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_DateOfAppointment" class="form-group">
<input type="text" data-table="employment_history" data-field="x_DateOfAppointment" name="x<?php echo $employment_history_list->RowIndex ?>_DateOfAppointment" id="x<?php echo $employment_history_list->RowIndex ?>_DateOfAppointment" placeholder="<?php echo HtmlEncode($employment_history_list->DateOfAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->DateOfAppointment->EditValue ?>"<?php echo $employment_history_list->DateOfAppointment->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_DateOfAppointment" name="o<?php echo $employment_history_list->RowIndex ?>_DateOfAppointment" id="o<?php echo $employment_history_list->RowIndex ?>_DateOfAppointment" value="<?php echo HtmlEncode($employment_history_list->DateOfAppointment->OldValue) ?>">
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="employment_history" data-field="x_DateOfAppointment" name="x<?php echo $employment_history_list->RowIndex ?>_DateOfAppointment" id="x<?php echo $employment_history_list->RowIndex ?>_DateOfAppointment" placeholder="<?php echo HtmlEncode($employment_history_list->DateOfAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->DateOfAppointment->EditValue ?>"<?php echo $employment_history_list->DateOfAppointment->editAttributes() ?>>
<input type="hidden" data-table="employment_history" data-field="x_DateOfAppointment" name="o<?php echo $employment_history_list->RowIndex ?>_DateOfAppointment" id="o<?php echo $employment_history_list->RowIndex ?>_DateOfAppointment" value="<?php echo HtmlEncode($employment_history_list->DateOfAppointment->OldValue != null ? $employment_history_list->DateOfAppointment->OldValue : $employment_history_list->DateOfAppointment->CurrentValue) ?>">
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_DateOfAppointment">
<span<?php echo $employment_history_list->DateOfAppointment->viewAttributes() ?>><?php echo $employment_history_list->DateOfAppointment->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_history_list->DateOfExit->Visible) { // DateOfExit ?>
		<td data-name="DateOfExit" <?php echo $employment_history_list->DateOfExit->cellAttributes() ?>>
<?php if ($employment_history->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_DateOfExit" class="form-group">
<input type="text" data-table="employment_history" data-field="x_DateOfExit" name="x<?php echo $employment_history_list->RowIndex ?>_DateOfExit" id="x<?php echo $employment_history_list->RowIndex ?>_DateOfExit" placeholder="<?php echo HtmlEncode($employment_history_list->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->DateOfExit->EditValue ?>"<?php echo $employment_history_list->DateOfExit->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_DateOfExit" name="o<?php echo $employment_history_list->RowIndex ?>_DateOfExit" id="o<?php echo $employment_history_list->RowIndex ?>_DateOfExit" value="<?php echo HtmlEncode($employment_history_list->DateOfExit->OldValue) ?>">
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_DateOfExit" class="form-group">
<input type="text" data-table="employment_history" data-field="x_DateOfExit" name="x<?php echo $employment_history_list->RowIndex ?>_DateOfExit" id="x<?php echo $employment_history_list->RowIndex ?>_DateOfExit" placeholder="<?php echo HtmlEncode($employment_history_list->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->DateOfExit->EditValue ?>"<?php echo $employment_history_list->DateOfExit->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_DateOfExit">
<span<?php echo $employment_history_list->DateOfExit->viewAttributes() ?>><?php echo $employment_history_list->DateOfExit->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_history_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $employment_history_list->SalaryScale->cellAttributes() ?>>
<?php if ($employment_history->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_SalaryScale" class="form-group">
<input type="text" data-table="employment_history" data-field="x_SalaryScale" name="x<?php echo $employment_history_list->RowIndex ?>_SalaryScale" id="x<?php echo $employment_history_list->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_history_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->SalaryScale->EditValue ?>"<?php echo $employment_history_list->SalaryScale->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_SalaryScale" name="o<?php echo $employment_history_list->RowIndex ?>_SalaryScale" id="o<?php echo $employment_history_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($employment_history_list->SalaryScale->OldValue) ?>">
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_SalaryScale" class="form-group">
<input type="text" data-table="employment_history" data-field="x_SalaryScale" name="x<?php echo $employment_history_list->RowIndex ?>_SalaryScale" id="x<?php echo $employment_history_list->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_history_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->SalaryScale->EditValue ?>"<?php echo $employment_history_list->SalaryScale->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_SalaryScale">
<span<?php echo $employment_history_list->SalaryScale->viewAttributes() ?>><?php echo $employment_history_list->SalaryScale->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_history_list->EmploymentType->Visible) { // EmploymentType ?>
		<td data-name="EmploymentType" <?php echo $employment_history_list->EmploymentType->cellAttributes() ?>>
<?php if ($employment_history->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_EmploymentType" class="form-group">
<input type="text" data-table="employment_history" data-field="x_EmploymentType" name="x<?php echo $employment_history_list->RowIndex ?>_EmploymentType" id="x<?php echo $employment_history_list->RowIndex ?>_EmploymentType" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->EmploymentType->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->EmploymentType->EditValue ?>"<?php echo $employment_history_list->EmploymentType->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_EmploymentType" name="o<?php echo $employment_history_list->RowIndex ?>_EmploymentType" id="o<?php echo $employment_history_list->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_history_list->EmploymentType->OldValue) ?>">
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_EmploymentType" class="form-group">
<input type="text" data-table="employment_history" data-field="x_EmploymentType" name="x<?php echo $employment_history_list->RowIndex ?>_EmploymentType" id="x<?php echo $employment_history_list->RowIndex ?>_EmploymentType" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->EmploymentType->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->EmploymentType->EditValue ?>"<?php echo $employment_history_list->EmploymentType->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_EmploymentType">
<span<?php echo $employment_history_list->EmploymentType->viewAttributes() ?>><?php echo $employment_history_list->EmploymentType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_history_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus" <?php echo $employment_history_list->EmploymentStatus->cellAttributes() ?>>
<?php if ($employment_history->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_EmploymentStatus" class="form-group">
<input type="text" data-table="employment_history" data-field="x_EmploymentStatus" name="x<?php echo $employment_history_list->RowIndex ?>_EmploymentStatus" id="x<?php echo $employment_history_list->RowIndex ?>_EmploymentStatus" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->EmploymentStatus->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->EmploymentStatus->EditValue ?>"<?php echo $employment_history_list->EmploymentStatus->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_EmploymentStatus" name="o<?php echo $employment_history_list->RowIndex ?>_EmploymentStatus" id="o<?php echo $employment_history_list->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_history_list->EmploymentStatus->OldValue) ?>">
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_EmploymentStatus" class="form-group">
<input type="text" data-table="employment_history" data-field="x_EmploymentStatus" name="x<?php echo $employment_history_list->RowIndex ?>_EmploymentStatus" id="x<?php echo $employment_history_list->RowIndex ?>_EmploymentStatus" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->EmploymentStatus->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->EmploymentStatus->EditValue ?>"<?php echo $employment_history_list->EmploymentStatus->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_EmploymentStatus">
<span<?php echo $employment_history_list->EmploymentStatus->viewAttributes() ?>><?php echo $employment_history_list->EmploymentStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_history_list->ExitReason->Visible) { // ExitReason ?>
		<td data-name="ExitReason" <?php echo $employment_history_list->ExitReason->cellAttributes() ?>>
<?php if ($employment_history->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_ExitReason" class="form-group">
<input type="text" data-table="employment_history" data-field="x_ExitReason" name="x<?php echo $employment_history_list->RowIndex ?>_ExitReason" id="x<?php echo $employment_history_list->RowIndex ?>_ExitReason" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->ExitReason->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->ExitReason->EditValue ?>"<?php echo $employment_history_list->ExitReason->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_ExitReason" name="o<?php echo $employment_history_list->RowIndex ?>_ExitReason" id="o<?php echo $employment_history_list->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($employment_history_list->ExitReason->OldValue) ?>">
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_ExitReason" class="form-group">
<input type="text" data-table="employment_history" data-field="x_ExitReason" name="x<?php echo $employment_history_list->RowIndex ?>_ExitReason" id="x<?php echo $employment_history_list->RowIndex ?>_ExitReason" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->ExitReason->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->ExitReason->EditValue ?>"<?php echo $employment_history_list->ExitReason->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_ExitReason">
<span<?php echo $employment_history_list->ExitReason->viewAttributes() ?>><?php echo $employment_history_list->ExitReason->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($employment_history_list->RetirementType->Visible) { // RetirementType ?>
		<td data-name="RetirementType" <?php echo $employment_history_list->RetirementType->cellAttributes() ?>>
<?php if ($employment_history->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_RetirementType" class="form-group">
<input type="text" data-table="employment_history" data-field="x_RetirementType" name="x<?php echo $employment_history_list->RowIndex ?>_RetirementType" id="x<?php echo $employment_history_list->RowIndex ?>_RetirementType" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->RetirementType->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->RetirementType->EditValue ?>"<?php echo $employment_history_list->RetirementType->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_RetirementType" name="o<?php echo $employment_history_list->RowIndex ?>_RetirementType" id="o<?php echo $employment_history_list->RowIndex ?>_RetirementType" value="<?php echo HtmlEncode($employment_history_list->RetirementType->OldValue) ?>">
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_RetirementType" class="form-group">
<input type="text" data-table="employment_history" data-field="x_RetirementType" name="x<?php echo $employment_history_list->RowIndex ?>_RetirementType" id="x<?php echo $employment_history_list->RowIndex ?>_RetirementType" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->RetirementType->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->RetirementType->EditValue ?>"<?php echo $employment_history_list->RetirementType->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($employment_history->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $employment_history_list->RowCount ?>_employment_history_RetirementType">
<span<?php echo $employment_history_list->RetirementType->viewAttributes() ?>><?php echo $employment_history_list->RetirementType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_history_list->ListOptions->render("body", "right", $employment_history_list->RowCount);
?>
	</tr>
<?php if ($employment_history->RowType == ROWTYPE_ADD || $employment_history->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["femployment_historylist", "load"], function() {
	femployment_historylist.updateLists(<?php echo $employment_history_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$employment_history_list->isGridAdd())
		if (!$employment_history_list->Recordset->EOF)
			$employment_history_list->Recordset->moveNext();
}
?>
<?php
	if ($employment_history_list->isGridAdd() || $employment_history_list->isGridEdit()) {
		$employment_history_list->RowIndex = '$rowindex$';
		$employment_history_list->loadRowValues();

		// Set row properties
		$employment_history->resetAttributes();
		$employment_history->RowAttrs->merge(["data-rowindex" => $employment_history_list->RowIndex, "id" => "r0_employment_history", "data-rowtype" => ROWTYPE_ADD]);
		$employment_history->RowAttrs->appendClass("ew-template");
		$employment_history->RowType = ROWTYPE_ADD;

		// Render row
		$employment_history_list->renderRow();

		// Render list options
		$employment_history_list->renderListOptions();
		$employment_history_list->StartRowCount = 0;
?>
	<tr <?php echo $employment_history->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employment_history_list->ListOptions->render("body", "left", $employment_history_list->RowIndex);
?>
	<?php if ($employment_history_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<span id="el$rowindex$_employment_history_EmployeeID" class="form-group employment_history_EmployeeID">
<input type="text" data-table="employment_history" data-field="x_EmployeeID" name="x<?php echo $employment_history_list->RowIndex ?>_EmployeeID" id="x<?php echo $employment_history_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->EmployeeID->EditValue ?>"<?php echo $employment_history_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_EmployeeID" name="o<?php echo $employment_history_list->RowIndex ?>_EmployeeID" id="o<?php echo $employment_history_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($employment_history_list->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_history_list->Position->Visible) { // Position ?>
		<td data-name="Position">
<span id="el$rowindex$_employment_history_Position" class="form-group employment_history_Position">
<input type="text" data-table="employment_history" data-field="x_Position" name="x<?php echo $employment_history_list->RowIndex ?>_Position" id="x<?php echo $employment_history_list->RowIndex ?>_Position" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->Position->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->Position->EditValue ?>"<?php echo $employment_history_list->Position->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_Position" name="o<?php echo $employment_history_list->RowIndex ?>_Position" id="o<?php echo $employment_history_list->RowIndex ?>_Position" value="<?php echo HtmlEncode($employment_history_list->Position->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_history_list->DateOfAppointment->Visible) { // DateOfAppointment ?>
		<td data-name="DateOfAppointment">
<span id="el$rowindex$_employment_history_DateOfAppointment" class="form-group employment_history_DateOfAppointment">
<input type="text" data-table="employment_history" data-field="x_DateOfAppointment" name="x<?php echo $employment_history_list->RowIndex ?>_DateOfAppointment" id="x<?php echo $employment_history_list->RowIndex ?>_DateOfAppointment" placeholder="<?php echo HtmlEncode($employment_history_list->DateOfAppointment->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->DateOfAppointment->EditValue ?>"<?php echo $employment_history_list->DateOfAppointment->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_DateOfAppointment" name="o<?php echo $employment_history_list->RowIndex ?>_DateOfAppointment" id="o<?php echo $employment_history_list->RowIndex ?>_DateOfAppointment" value="<?php echo HtmlEncode($employment_history_list->DateOfAppointment->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_history_list->DateOfExit->Visible) { // DateOfExit ?>
		<td data-name="DateOfExit">
<span id="el$rowindex$_employment_history_DateOfExit" class="form-group employment_history_DateOfExit">
<input type="text" data-table="employment_history" data-field="x_DateOfExit" name="x<?php echo $employment_history_list->RowIndex ?>_DateOfExit" id="x<?php echo $employment_history_list->RowIndex ?>_DateOfExit" placeholder="<?php echo HtmlEncode($employment_history_list->DateOfExit->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->DateOfExit->EditValue ?>"<?php echo $employment_history_list->DateOfExit->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_DateOfExit" name="o<?php echo $employment_history_list->RowIndex ?>_DateOfExit" id="o<?php echo $employment_history_list->RowIndex ?>_DateOfExit" value="<?php echo HtmlEncode($employment_history_list->DateOfExit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_history_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<span id="el$rowindex$_employment_history_SalaryScale" class="form-group employment_history_SalaryScale">
<input type="text" data-table="employment_history" data-field="x_SalaryScale" name="x<?php echo $employment_history_list->RowIndex ?>_SalaryScale" id="x<?php echo $employment_history_list->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($employment_history_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->SalaryScale->EditValue ?>"<?php echo $employment_history_list->SalaryScale->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_SalaryScale" name="o<?php echo $employment_history_list->RowIndex ?>_SalaryScale" id="o<?php echo $employment_history_list->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($employment_history_list->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_history_list->EmploymentType->Visible) { // EmploymentType ?>
		<td data-name="EmploymentType">
<span id="el$rowindex$_employment_history_EmploymentType" class="form-group employment_history_EmploymentType">
<input type="text" data-table="employment_history" data-field="x_EmploymentType" name="x<?php echo $employment_history_list->RowIndex ?>_EmploymentType" id="x<?php echo $employment_history_list->RowIndex ?>_EmploymentType" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->EmploymentType->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->EmploymentType->EditValue ?>"<?php echo $employment_history_list->EmploymentType->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_EmploymentType" name="o<?php echo $employment_history_list->RowIndex ?>_EmploymentType" id="o<?php echo $employment_history_list->RowIndex ?>_EmploymentType" value="<?php echo HtmlEncode($employment_history_list->EmploymentType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_history_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus">
<span id="el$rowindex$_employment_history_EmploymentStatus" class="form-group employment_history_EmploymentStatus">
<input type="text" data-table="employment_history" data-field="x_EmploymentStatus" name="x<?php echo $employment_history_list->RowIndex ?>_EmploymentStatus" id="x<?php echo $employment_history_list->RowIndex ?>_EmploymentStatus" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->EmploymentStatus->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->EmploymentStatus->EditValue ?>"<?php echo $employment_history_list->EmploymentStatus->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_EmploymentStatus" name="o<?php echo $employment_history_list->RowIndex ?>_EmploymentStatus" id="o<?php echo $employment_history_list->RowIndex ?>_EmploymentStatus" value="<?php echo HtmlEncode($employment_history_list->EmploymentStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_history_list->ExitReason->Visible) { // ExitReason ?>
		<td data-name="ExitReason">
<span id="el$rowindex$_employment_history_ExitReason" class="form-group employment_history_ExitReason">
<input type="text" data-table="employment_history" data-field="x_ExitReason" name="x<?php echo $employment_history_list->RowIndex ?>_ExitReason" id="x<?php echo $employment_history_list->RowIndex ?>_ExitReason" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->ExitReason->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->ExitReason->EditValue ?>"<?php echo $employment_history_list->ExitReason->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_ExitReason" name="o<?php echo $employment_history_list->RowIndex ?>_ExitReason" id="o<?php echo $employment_history_list->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($employment_history_list->ExitReason->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($employment_history_list->RetirementType->Visible) { // RetirementType ?>
		<td data-name="RetirementType">
<span id="el$rowindex$_employment_history_RetirementType" class="form-group employment_history_RetirementType">
<input type="text" data-table="employment_history" data-field="x_RetirementType" name="x<?php echo $employment_history_list->RowIndex ?>_RetirementType" id="x<?php echo $employment_history_list->RowIndex ?>_RetirementType" size="30" placeholder="<?php echo HtmlEncode($employment_history_list->RetirementType->getPlaceHolder()) ?>" value="<?php echo $employment_history_list->RetirementType->EditValue ?>"<?php echo $employment_history_list->RetirementType->editAttributes() ?>>
</span>
<input type="hidden" data-table="employment_history" data-field="x_RetirementType" name="o<?php echo $employment_history_list->RowIndex ?>_RetirementType" id="o<?php echo $employment_history_list->RowIndex ?>_RetirementType" value="<?php echo HtmlEncode($employment_history_list->RetirementType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employment_history_list->ListOptions->render("body", "right", $employment_history_list->RowIndex);
?>
<script>
loadjs.ready(["femployment_historylist", "load"], function() {
	femployment_historylist.updateLists(<?php echo $employment_history_list->RowIndex ?>);
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
<?php if ($employment_history_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $employment_history_list->FormKeyCountName ?>" id="<?php echo $employment_history_list->FormKeyCountName ?>" value="<?php echo $employment_history_list->KeyCount ?>">
<?php echo $employment_history_list->MultiSelectKey ?>
<?php } ?>
<?php if ($employment_history_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $employment_history_list->FormKeyCountName ?>" id="<?php echo $employment_history_list->FormKeyCountName ?>" value="<?php echo $employment_history_list->KeyCount ?>">
<?php echo $employment_history_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$employment_history->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employment_history_list->Recordset)
	$employment_history_list->Recordset->Close();
?>
<?php if (!$employment_history_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employment_history_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employment_history_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employment_history_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employment_history_list->TotalRecords == 0 && !$employment_history->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employment_history_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employment_history_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employment_history_list->isExport()) { ?>
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
$employment_history_list->terminate();
?>