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
$staffchildren_list = new staffchildren_list();

// Run the page
$staffchildren_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffchildren_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffchildren_list->isExport()) { ?>
<script>
var fstaffchildrenlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstaffchildrenlist = currentForm = new ew.Form("fstaffchildrenlist", "list");
	fstaffchildrenlist.formKeyCountName = '<?php echo $staffchildren_list->FormKeyCountName ?>';

	// Validate form
	fstaffchildrenlist.validate = function() {
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
			<?php if ($staffchildren_list->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_list->FirstName->caption(), $staffchildren_list->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffchildren_list->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_list->MiddleName->caption(), $staffchildren_list->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffchildren_list->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_list->Surname->caption(), $staffchildren_list->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffchildren_list->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_list->DateOfBirth->caption(), $staffchildren_list->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffchildren_list->DateOfBirth->errorMessage()) ?>");
			<?php if ($staffchildren_list->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_list->Sex->caption(), $staffchildren_list->Sex->RequiredErrorMessage)) ?>");
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
	fstaffchildrenlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "FirstName", false)) return false;
		if (ew.valueChanged(fobj, infix, "MiddleName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Surname", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfBirth", false)) return false;
		if (ew.valueChanged(fobj, infix, "Sex", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstaffchildrenlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffchildrenlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffchildrenlist.lists["x_Sex"] = <?php echo $staffchildren_list->Sex->Lookup->toClientList($staffchildren_list) ?>;
	fstaffchildrenlist.lists["x_Sex"].options = <?php echo JsonEncode($staffchildren_list->Sex->lookupOptions()) ?>;
	loadjs.done("fstaffchildrenlist");
});
var fstaffchildrenlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fstaffchildrenlistsrch = currentSearchForm = new ew.Form("fstaffchildrenlistsrch");

	// Dynamic selection lists
	// Filters

	fstaffchildrenlistsrch.filterList = <?php echo $staffchildren_list->getFilterList() ?>;

	// Init search panel as collapsed
	fstaffchildrenlistsrch.initSearchPanel = true;
	loadjs.done("fstaffchildrenlistsrch");
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
<?php if (!$staffchildren_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($staffchildren_list->TotalRecords > 0 && $staffchildren_list->ExportOptions->visible()) { ?>
<?php $staffchildren_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($staffchildren_list->ImportOptions->visible()) { ?>
<?php $staffchildren_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($staffchildren_list->SearchOptions->visible()) { ?>
<?php $staffchildren_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($staffchildren_list->FilterOptions->visible()) { ?>
<?php $staffchildren_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$staffchildren_list->isExport() || Config("EXPORT_MASTER_RECORD") && $staffchildren_list->isExport("print")) { ?>
<?php
if ($staffchildren_list->DbMasterFilter != "" && $staffchildren->getCurrentMasterTable() == "staff") {
	if ($staffchildren_list->MasterRecordExists) {
		include_once "staffmaster.php";
	}
}
?>
<?php } ?>
<?php
$staffchildren_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$staffchildren_list->isExport() && !$staffchildren->CurrentAction) { ?>
<form name="fstaffchildrenlistsrch" id="fstaffchildrenlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fstaffchildrenlistsrch-search-panel" class="<?php echo $staffchildren_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="staffchildren">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $staffchildren_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($staffchildren_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($staffchildren_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $staffchildren_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($staffchildren_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($staffchildren_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($staffchildren_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($staffchildren_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $staffchildren_list->showPageHeader(); ?>
<?php
$staffchildren_list->showMessage();
?>
<?php if ($staffchildren_list->TotalRecords > 0 || $staffchildren->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffchildren_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffchildren">
<?php if (!$staffchildren_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$staffchildren_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffchildren_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffchildren_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstaffchildrenlist" id="fstaffchildrenlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffchildren">
<?php if ($staffchildren->getCurrentMasterTable() == "staff" && $staffchildren->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffchildren_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_staffchildren" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($staffchildren_list->TotalRecords > 0 || $staffchildren_list->isAdd() || $staffchildren_list->isCopy() || $staffchildren_list->isGridEdit()) { ?>
<table id="tbl_staffchildrenlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffchildren->RowType = ROWTYPE_HEADER;

// Render list options
$staffchildren_list->renderListOptions();

// Render list options (header, left)
$staffchildren_list->ListOptions->render("header", "left");
?>
<?php if ($staffchildren_list->FirstName->Visible) { // FirstName ?>
	<?php if ($staffchildren_list->SortUrl($staffchildren_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $staffchildren_list->FirstName->headerCellClass() ?>"><div id="elh_staffchildren_FirstName" class="staffchildren_FirstName"><div class="ew-table-header-caption"><?php echo $staffchildren_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $staffchildren_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffchildren_list->SortUrl($staffchildren_list->FirstName) ?>', 1);"><div id="elh_staffchildren_FirstName" class="staffchildren_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffchildren_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($staffchildren_list->SortUrl($staffchildren_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $staffchildren_list->MiddleName->headerCellClass() ?>"><div id="elh_staffchildren_MiddleName" class="staffchildren_MiddleName"><div class="ew-table-header-caption"><?php echo $staffchildren_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $staffchildren_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffchildren_list->SortUrl($staffchildren_list->MiddleName) ?>', 1);"><div id="elh_staffchildren_MiddleName" class="staffchildren_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffchildren_list->Surname->Visible) { // Surname ?>
	<?php if ($staffchildren_list->SortUrl($staffchildren_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $staffchildren_list->Surname->headerCellClass() ?>"><div id="elh_staffchildren_Surname" class="staffchildren_Surname"><div class="ew-table-header-caption"><?php echo $staffchildren_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $staffchildren_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffchildren_list->SortUrl($staffchildren_list->Surname) ?>', 1);"><div id="elh_staffchildren_Surname" class="staffchildren_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffchildren_list->DateOfBirth->Visible) { // DateOfBirth ?>
	<?php if ($staffchildren_list->SortUrl($staffchildren_list->DateOfBirth) == "") { ?>
		<th data-name="DateOfBirth" class="<?php echo $staffchildren_list->DateOfBirth->headerCellClass() ?>"><div id="elh_staffchildren_DateOfBirth" class="staffchildren_DateOfBirth"><div class="ew-table-header-caption"><?php echo $staffchildren_list->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfBirth" class="<?php echo $staffchildren_list->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffchildren_list->SortUrl($staffchildren_list->DateOfBirth) ?>', 1);"><div id="elh_staffchildren_DateOfBirth" class="staffchildren_DateOfBirth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_list->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_list->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_list->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffchildren_list->Sex->Visible) { // Sex ?>
	<?php if ($staffchildren_list->SortUrl($staffchildren_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $staffchildren_list->Sex->headerCellClass() ?>"><div id="elh_staffchildren_Sex" class="staffchildren_Sex"><div class="ew-table-header-caption"><?php echo $staffchildren_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $staffchildren_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffchildren_list->SortUrl($staffchildren_list->Sex) ?>', 1);"><div id="elh_staffchildren_Sex" class="staffchildren_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffchildren_list->Sex->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffchildren_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffchildren_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffchildren_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($staffchildren_list->isAdd() || $staffchildren_list->isCopy()) {
		$staffchildren_list->RowIndex = 0;
		$staffchildren_list->KeyCount = $staffchildren_list->RowIndex;
		if ($staffchildren_list->isAdd())
			$staffchildren_list->loadRowValues();
		if ($staffchildren->EventCancelled) // Insert failed
			$staffchildren_list->restoreFormValues(); // Restore form values

		// Set row properties
		$staffchildren->resetAttributes();
		$staffchildren->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_staffchildren", "data-rowtype" => ROWTYPE_ADD]);
		$staffchildren->RowType = ROWTYPE_ADD;

		// Render row
		$staffchildren_list->renderRow();

		// Render list options
		$staffchildren_list->renderListOptions();
		$staffchildren_list->StartRowCount = 0;
?>
	<tr <?php echo $staffchildren->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffchildren_list->ListOptions->render("body", "left", $staffchildren_list->RowCount);
?>
	<?php if ($staffchildren_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_FirstName" class="form-group staffchildren_FirstName">
<input type="text" data-table="staffchildren" data-field="x_FirstName" name="x<?php echo $staffchildren_list->RowIndex ?>_FirstName" id="x<?php echo $staffchildren_list->RowIndex ?>_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->FirstName->EditValue ?>"<?php echo $staffchildren_list->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_FirstName" name="o<?php echo $staffchildren_list->RowIndex ?>_FirstName" id="o<?php echo $staffchildren_list->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($staffchildren_list->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffchildren_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName">
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_MiddleName" class="form-group staffchildren_MiddleName">
<input type="text" data-table="staffchildren" data-field="x_MiddleName" name="x<?php echo $staffchildren_list->RowIndex ?>_MiddleName" id="x<?php echo $staffchildren_list->RowIndex ?>_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_list->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->MiddleName->EditValue ?>"<?php echo $staffchildren_list->MiddleName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_MiddleName" name="o<?php echo $staffchildren_list->RowIndex ?>_MiddleName" id="o<?php echo $staffchildren_list->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($staffchildren_list->MiddleName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffchildren_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname">
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_Surname" class="form-group staffchildren_Surname">
<input type="text" data-table="staffchildren" data-field="x_Surname" name="x<?php echo $staffchildren_list->RowIndex ?>_Surname" id="x<?php echo $staffchildren_list->RowIndex ?>_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_list->Surname->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->Surname->EditValue ?>"<?php echo $staffchildren_list->Surname->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_Surname" name="o<?php echo $staffchildren_list->RowIndex ?>_Surname" id="o<?php echo $staffchildren_list->RowIndex ?>_Surname" value="<?php echo HtmlEncode($staffchildren_list->Surname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffchildren_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth">
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_DateOfBirth" class="form-group staffchildren_DateOfBirth">
<input type="text" data-table="staffchildren" data-field="x_DateOfBirth" name="x<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" id="x<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($staffchildren_list->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->DateOfBirth->EditValue ?>"<?php echo $staffchildren_list->DateOfBirth->editAttributes() ?>>
<?php if (!$staffchildren_list->DateOfBirth->ReadOnly && !$staffchildren_list->DateOfBirth->Disabled && !isset($staffchildren_list->DateOfBirth->EditAttrs["readonly"]) && !isset($staffchildren_list->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffchildrenlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffchildrenlist", "x<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_DateOfBirth" name="o<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" id="o<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($staffchildren_list->DateOfBirth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffchildren_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex">
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_Sex" class="form-group staffchildren_Sex">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffchildren" data-field="x_Sex" data-value-separator="<?php echo $staffchildren_list->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffchildren_list->RowIndex ?>_Sex" name="x<?php echo $staffchildren_list->RowIndex ?>_Sex"<?php echo $staffchildren_list->Sex->editAttributes() ?>>
			<?php echo $staffchildren_list->Sex->selectOptionListHtml("x{$staffchildren_list->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $staffchildren_list->Sex->Lookup->getParamTag($staffchildren_list, "p_x" . $staffchildren_list->RowIndex . "_Sex") ?>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_Sex" name="o<?php echo $staffchildren_list->RowIndex ?>_Sex" id="o<?php echo $staffchildren_list->RowIndex ?>_Sex" value="<?php echo HtmlEncode($staffchildren_list->Sex->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffchildren_list->ListOptions->render("body", "right", $staffchildren_list->RowCount);
?>
<script>
loadjs.ready(["fstaffchildrenlist", "load"], function() {
	fstaffchildrenlist.updateLists(<?php echo $staffchildren_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($staffchildren_list->ExportAll && $staffchildren_list->isExport()) {
	$staffchildren_list->StopRecord = $staffchildren_list->TotalRecords;
} else {

	// Set the last record to display
	if ($staffchildren_list->TotalRecords > $staffchildren_list->StartRecord + $staffchildren_list->DisplayRecords - 1)
		$staffchildren_list->StopRecord = $staffchildren_list->StartRecord + $staffchildren_list->DisplayRecords - 1;
	else
		$staffchildren_list->StopRecord = $staffchildren_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($staffchildren->isConfirm() || $staffchildren_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffchildren_list->FormKeyCountName) && ($staffchildren_list->isGridAdd() || $staffchildren_list->isGridEdit() || $staffchildren->isConfirm())) {
		$staffchildren_list->KeyCount = $CurrentForm->getValue($staffchildren_list->FormKeyCountName);
		$staffchildren_list->StopRecord = $staffchildren_list->StartRecord + $staffchildren_list->KeyCount - 1;
	}
}
$staffchildren_list->RecordCount = $staffchildren_list->StartRecord - 1;
if ($staffchildren_list->Recordset && !$staffchildren_list->Recordset->EOF) {
	$staffchildren_list->Recordset->moveFirst();
	$selectLimit = $staffchildren_list->UseSelectLimit;
	if (!$selectLimit && $staffchildren_list->StartRecord > 1)
		$staffchildren_list->Recordset->move($staffchildren_list->StartRecord - 1);
} elseif (!$staffchildren->AllowAddDeleteRow && $staffchildren_list->StopRecord == 0) {
	$staffchildren_list->StopRecord = $staffchildren->GridAddRowCount;
}

// Initialize aggregate
$staffchildren->RowType = ROWTYPE_AGGREGATEINIT;
$staffchildren->resetAttributes();
$staffchildren_list->renderRow();
$staffchildren_list->EditRowCount = 0;
if ($staffchildren_list->isEdit())
	$staffchildren_list->RowIndex = 1;
if ($staffchildren_list->isGridAdd())
	$staffchildren_list->RowIndex = 0;
if ($staffchildren_list->isGridEdit())
	$staffchildren_list->RowIndex = 0;
while ($staffchildren_list->RecordCount < $staffchildren_list->StopRecord) {
	$staffchildren_list->RecordCount++;
	if ($staffchildren_list->RecordCount >= $staffchildren_list->StartRecord) {
		$staffchildren_list->RowCount++;
		if ($staffchildren_list->isGridAdd() || $staffchildren_list->isGridEdit() || $staffchildren->isConfirm()) {
			$staffchildren_list->RowIndex++;
			$CurrentForm->Index = $staffchildren_list->RowIndex;
			if ($CurrentForm->hasValue($staffchildren_list->FormActionName) && ($staffchildren->isConfirm() || $staffchildren_list->EventCancelled))
				$staffchildren_list->RowAction = strval($CurrentForm->getValue($staffchildren_list->FormActionName));
			elseif ($staffchildren_list->isGridAdd())
				$staffchildren_list->RowAction = "insert";
			else
				$staffchildren_list->RowAction = "";
		}

		// Set up key count
		$staffchildren_list->KeyCount = $staffchildren_list->RowIndex;

		// Init row class and style
		$staffchildren->resetAttributes();
		$staffchildren->CssClass = "";
		if ($staffchildren_list->isGridAdd()) {
			$staffchildren_list->loadRowValues(); // Load default values
		} else {
			$staffchildren_list->loadRowValues($staffchildren_list->Recordset); // Load row values
		}
		$staffchildren->RowType = ROWTYPE_VIEW; // Render view
		if ($staffchildren_list->isGridAdd()) // Grid add
			$staffchildren->RowType = ROWTYPE_ADD; // Render add
		if ($staffchildren_list->isGridAdd() && $staffchildren->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffchildren_list->restoreCurrentRowFormValues($staffchildren_list->RowIndex); // Restore form values
		if ($staffchildren_list->isEdit()) {
			if ($staffchildren_list->checkInlineEditKey() && $staffchildren_list->EditRowCount == 0) { // Inline edit
				$staffchildren->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($staffchildren_list->isGridEdit()) { // Grid edit
			if ($staffchildren->EventCancelled)
				$staffchildren_list->restoreCurrentRowFormValues($staffchildren_list->RowIndex); // Restore form values
			if ($staffchildren_list->RowAction == "insert")
				$staffchildren->RowType = ROWTYPE_ADD; // Render add
			else
				$staffchildren->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffchildren_list->isEdit() && $staffchildren->RowType == ROWTYPE_EDIT && $staffchildren->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$staffchildren_list->restoreFormValues(); // Restore form values
		}
		if ($staffchildren_list->isGridEdit() && ($staffchildren->RowType == ROWTYPE_EDIT || $staffchildren->RowType == ROWTYPE_ADD) && $staffchildren->EventCancelled) // Update failed
			$staffchildren_list->restoreCurrentRowFormValues($staffchildren_list->RowIndex); // Restore form values
		if ($staffchildren->RowType == ROWTYPE_EDIT) // Edit row
			$staffchildren_list->EditRowCount++;

		// Set up row id / data-rowindex
		$staffchildren->RowAttrs->merge(["data-rowindex" => $staffchildren_list->RowCount, "id" => "r" . $staffchildren_list->RowCount . "_staffchildren", "data-rowtype" => $staffchildren->RowType]);

		// Render row
		$staffchildren_list->renderRow();

		// Render list options
		$staffchildren_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffchildren_list->RowAction != "delete" && $staffchildren_list->RowAction != "insertdelete" && !($staffchildren_list->RowAction == "insert" && $staffchildren->isConfirm() && $staffchildren_list->emptyRow())) {
?>
	<tr <?php echo $staffchildren->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffchildren_list->ListOptions->render("body", "left", $staffchildren_list->RowCount);
?>
	<?php if ($staffchildren_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $staffchildren_list->FirstName->cellAttributes() ?>>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_FirstName" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_FirstName" name="x<?php echo $staffchildren_list->RowIndex ?>_FirstName" id="x<?php echo $staffchildren_list->RowIndex ?>_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->FirstName->EditValue ?>"<?php echo $staffchildren_list->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_FirstName" name="o<?php echo $staffchildren_list->RowIndex ?>_FirstName" id="o<?php echo $staffchildren_list->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($staffchildren_list->FirstName->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_FirstName" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_FirstName" name="x<?php echo $staffchildren_list->RowIndex ?>_FirstName" id="x<?php echo $staffchildren_list->RowIndex ?>_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->FirstName->EditValue ?>"<?php echo $staffchildren_list->FirstName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_FirstName">
<span<?php echo $staffchildren_list->FirstName->viewAttributes() ?>><?php echo $staffchildren_list->FirstName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffchildren" data-field="x_EmployeeID" name="x<?php echo $staffchildren_list->RowIndex ?>_EmployeeID" id="x<?php echo $staffchildren_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffchildren_list->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_EmployeeID" name="o<?php echo $staffchildren_list->RowIndex ?>_EmployeeID" id="o<?php echo $staffchildren_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffchildren_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT || $staffchildren->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffchildren" data-field="x_EmployeeID" name="x<?php echo $staffchildren_list->RowIndex ?>_EmployeeID" id="x<?php echo $staffchildren_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffchildren_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffchildren" data-field="x_ChildNo" name="x<?php echo $staffchildren_list->RowIndex ?>_ChildNo" id="x<?php echo $staffchildren_list->RowIndex ?>_ChildNo" value="<?php echo HtmlEncode($staffchildren_list->ChildNo->CurrentValue) ?>">
<input type="hidden" data-table="staffchildren" data-field="x_ChildNo" name="o<?php echo $staffchildren_list->RowIndex ?>_ChildNo" id="o<?php echo $staffchildren_list->RowIndex ?>_ChildNo" value="<?php echo HtmlEncode($staffchildren_list->ChildNo->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT || $staffchildren->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffchildren" data-field="x_ChildNo" name="x<?php echo $staffchildren_list->RowIndex ?>_ChildNo" id="x<?php echo $staffchildren_list->RowIndex ?>_ChildNo" value="<?php echo HtmlEncode($staffchildren_list->ChildNo->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffchildren_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $staffchildren_list->MiddleName->cellAttributes() ?>>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_MiddleName" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_MiddleName" name="x<?php echo $staffchildren_list->RowIndex ?>_MiddleName" id="x<?php echo $staffchildren_list->RowIndex ?>_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_list->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->MiddleName->EditValue ?>"<?php echo $staffchildren_list->MiddleName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_MiddleName" name="o<?php echo $staffchildren_list->RowIndex ?>_MiddleName" id="o<?php echo $staffchildren_list->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($staffchildren_list->MiddleName->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_MiddleName" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_MiddleName" name="x<?php echo $staffchildren_list->RowIndex ?>_MiddleName" id="x<?php echo $staffchildren_list->RowIndex ?>_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_list->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->MiddleName->EditValue ?>"<?php echo $staffchildren_list->MiddleName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_MiddleName">
<span<?php echo $staffchildren_list->MiddleName->viewAttributes() ?>><?php echo $staffchildren_list->MiddleName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffchildren_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $staffchildren_list->Surname->cellAttributes() ?>>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_Surname" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_Surname" name="x<?php echo $staffchildren_list->RowIndex ?>_Surname" id="x<?php echo $staffchildren_list->RowIndex ?>_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_list->Surname->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->Surname->EditValue ?>"<?php echo $staffchildren_list->Surname->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_Surname" name="o<?php echo $staffchildren_list->RowIndex ?>_Surname" id="o<?php echo $staffchildren_list->RowIndex ?>_Surname" value="<?php echo HtmlEncode($staffchildren_list->Surname->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_Surname" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_Surname" name="x<?php echo $staffchildren_list->RowIndex ?>_Surname" id="x<?php echo $staffchildren_list->RowIndex ?>_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_list->Surname->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->Surname->EditValue ?>"<?php echo $staffchildren_list->Surname->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_Surname">
<span<?php echo $staffchildren_list->Surname->viewAttributes() ?>><?php echo $staffchildren_list->Surname->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffchildren_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth" <?php echo $staffchildren_list->DateOfBirth->cellAttributes() ?>>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_DateOfBirth" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_DateOfBirth" name="x<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" id="x<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($staffchildren_list->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->DateOfBirth->EditValue ?>"<?php echo $staffchildren_list->DateOfBirth->editAttributes() ?>>
<?php if (!$staffchildren_list->DateOfBirth->ReadOnly && !$staffchildren_list->DateOfBirth->Disabled && !isset($staffchildren_list->DateOfBirth->EditAttrs["readonly"]) && !isset($staffchildren_list->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffchildrenlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffchildrenlist", "x<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_DateOfBirth" name="o<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" id="o<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($staffchildren_list->DateOfBirth->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_DateOfBirth" class="form-group">
<input type="text" data-table="staffchildren" data-field="x_DateOfBirth" name="x<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" id="x<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($staffchildren_list->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->DateOfBirth->EditValue ?>"<?php echo $staffchildren_list->DateOfBirth->editAttributes() ?>>
<?php if (!$staffchildren_list->DateOfBirth->ReadOnly && !$staffchildren_list->DateOfBirth->Disabled && !isset($staffchildren_list->DateOfBirth->EditAttrs["readonly"]) && !isset($staffchildren_list->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffchildrenlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffchildrenlist", "x<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_DateOfBirth">
<span<?php echo $staffchildren_list->DateOfBirth->viewAttributes() ?>><?php echo $staffchildren_list->DateOfBirth->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffchildren_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $staffchildren_list->Sex->cellAttributes() ?>>
<?php if ($staffchildren->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_Sex" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffchildren" data-field="x_Sex" data-value-separator="<?php echo $staffchildren_list->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffchildren_list->RowIndex ?>_Sex" name="x<?php echo $staffchildren_list->RowIndex ?>_Sex"<?php echo $staffchildren_list->Sex->editAttributes() ?>>
			<?php echo $staffchildren_list->Sex->selectOptionListHtml("x{$staffchildren_list->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $staffchildren_list->Sex->Lookup->getParamTag($staffchildren_list, "p_x" . $staffchildren_list->RowIndex . "_Sex") ?>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_Sex" name="o<?php echo $staffchildren_list->RowIndex ?>_Sex" id="o<?php echo $staffchildren_list->RowIndex ?>_Sex" value="<?php echo HtmlEncode($staffchildren_list->Sex->OldValue) ?>">
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_Sex" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffchildren" data-field="x_Sex" data-value-separator="<?php echo $staffchildren_list->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffchildren_list->RowIndex ?>_Sex" name="x<?php echo $staffchildren_list->RowIndex ?>_Sex"<?php echo $staffchildren_list->Sex->editAttributes() ?>>
			<?php echo $staffchildren_list->Sex->selectOptionListHtml("x{$staffchildren_list->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $staffchildren_list->Sex->Lookup->getParamTag($staffchildren_list, "p_x" . $staffchildren_list->RowIndex . "_Sex") ?>
</span>
<?php } ?>
<?php if ($staffchildren->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffchildren_list->RowCount ?>_staffchildren_Sex">
<span<?php echo $staffchildren_list->Sex->viewAttributes() ?>><?php echo $staffchildren_list->Sex->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffchildren_list->ListOptions->render("body", "right", $staffchildren_list->RowCount);
?>
	</tr>
<?php if ($staffchildren->RowType == ROWTYPE_ADD || $staffchildren->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffchildrenlist", "load"], function() {
	fstaffchildrenlist.updateLists(<?php echo $staffchildren_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffchildren_list->isGridAdd())
		if (!$staffchildren_list->Recordset->EOF)
			$staffchildren_list->Recordset->moveNext();
}
?>
<?php
	if ($staffchildren_list->isGridAdd() || $staffchildren_list->isGridEdit()) {
		$staffchildren_list->RowIndex = '$rowindex$';
		$staffchildren_list->loadRowValues();

		// Set row properties
		$staffchildren->resetAttributes();
		$staffchildren->RowAttrs->merge(["data-rowindex" => $staffchildren_list->RowIndex, "id" => "r0_staffchildren", "data-rowtype" => ROWTYPE_ADD]);
		$staffchildren->RowAttrs->appendClass("ew-template");
		$staffchildren->RowType = ROWTYPE_ADD;

		// Render row
		$staffchildren_list->renderRow();

		// Render list options
		$staffchildren_list->renderListOptions();
		$staffchildren_list->StartRowCount = 0;
?>
	<tr <?php echo $staffchildren->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffchildren_list->ListOptions->render("body", "left", $staffchildren_list->RowIndex);
?>
	<?php if ($staffchildren_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<span id="el$rowindex$_staffchildren_FirstName" class="form-group staffchildren_FirstName">
<input type="text" data-table="staffchildren" data-field="x_FirstName" name="x<?php echo $staffchildren_list->RowIndex ?>_FirstName" id="x<?php echo $staffchildren_list->RowIndex ?>_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->FirstName->EditValue ?>"<?php echo $staffchildren_list->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_FirstName" name="o<?php echo $staffchildren_list->RowIndex ?>_FirstName" id="o<?php echo $staffchildren_list->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($staffchildren_list->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffchildren_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName">
<span id="el$rowindex$_staffchildren_MiddleName" class="form-group staffchildren_MiddleName">
<input type="text" data-table="staffchildren" data-field="x_MiddleName" name="x<?php echo $staffchildren_list->RowIndex ?>_MiddleName" id="x<?php echo $staffchildren_list->RowIndex ?>_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_list->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->MiddleName->EditValue ?>"<?php echo $staffchildren_list->MiddleName->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_MiddleName" name="o<?php echo $staffchildren_list->RowIndex ?>_MiddleName" id="o<?php echo $staffchildren_list->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($staffchildren_list->MiddleName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffchildren_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname">
<span id="el$rowindex$_staffchildren_Surname" class="form-group staffchildren_Surname">
<input type="text" data-table="staffchildren" data-field="x_Surname" name="x<?php echo $staffchildren_list->RowIndex ?>_Surname" id="x<?php echo $staffchildren_list->RowIndex ?>_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_list->Surname->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->Surname->EditValue ?>"<?php echo $staffchildren_list->Surname->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_Surname" name="o<?php echo $staffchildren_list->RowIndex ?>_Surname" id="o<?php echo $staffchildren_list->RowIndex ?>_Surname" value="<?php echo HtmlEncode($staffchildren_list->Surname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffchildren_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth">
<span id="el$rowindex$_staffchildren_DateOfBirth" class="form-group staffchildren_DateOfBirth">
<input type="text" data-table="staffchildren" data-field="x_DateOfBirth" name="x<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" id="x<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($staffchildren_list->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staffchildren_list->DateOfBirth->EditValue ?>"<?php echo $staffchildren_list->DateOfBirth->editAttributes() ?>>
<?php if (!$staffchildren_list->DateOfBirth->ReadOnly && !$staffchildren_list->DateOfBirth->Disabled && !isset($staffchildren_list->DateOfBirth->EditAttrs["readonly"]) && !isset($staffchildren_list->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffchildrenlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffchildrenlist", "x<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_DateOfBirth" name="o<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" id="o<?php echo $staffchildren_list->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($staffchildren_list->DateOfBirth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffchildren_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex">
<span id="el$rowindex$_staffchildren_Sex" class="form-group staffchildren_Sex">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffchildren" data-field="x_Sex" data-value-separator="<?php echo $staffchildren_list->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffchildren_list->RowIndex ?>_Sex" name="x<?php echo $staffchildren_list->RowIndex ?>_Sex"<?php echo $staffchildren_list->Sex->editAttributes() ?>>
			<?php echo $staffchildren_list->Sex->selectOptionListHtml("x{$staffchildren_list->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $staffchildren_list->Sex->Lookup->getParamTag($staffchildren_list, "p_x" . $staffchildren_list->RowIndex . "_Sex") ?>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_Sex" name="o<?php echo $staffchildren_list->RowIndex ?>_Sex" id="o<?php echo $staffchildren_list->RowIndex ?>_Sex" value="<?php echo HtmlEncode($staffchildren_list->Sex->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffchildren_list->ListOptions->render("body", "right", $staffchildren_list->RowIndex);
?>
<script>
loadjs.ready(["fstaffchildrenlist", "load"], function() {
	fstaffchildrenlist.updateLists(<?php echo $staffchildren_list->RowIndex ?>);
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
<?php if ($staffchildren_list->isAdd() || $staffchildren_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $staffchildren_list->FormKeyCountName ?>" id="<?php echo $staffchildren_list->FormKeyCountName ?>" value="<?php echo $staffchildren_list->KeyCount ?>">
<?php } ?>
<?php if ($staffchildren_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $staffchildren_list->FormKeyCountName ?>" id="<?php echo $staffchildren_list->FormKeyCountName ?>" value="<?php echo $staffchildren_list->KeyCount ?>">
<?php echo $staffchildren_list->MultiSelectKey ?>
<?php } ?>
<?php if ($staffchildren_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $staffchildren_list->FormKeyCountName ?>" id="<?php echo $staffchildren_list->FormKeyCountName ?>" value="<?php echo $staffchildren_list->KeyCount ?>">
<?php } ?>
<?php if ($staffchildren_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $staffchildren_list->FormKeyCountName ?>" id="<?php echo $staffchildren_list->FormKeyCountName ?>" value="<?php echo $staffchildren_list->KeyCount ?>">
<?php echo $staffchildren_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$staffchildren->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffchildren_list->Recordset)
	$staffchildren_list->Recordset->Close();
?>
<?php if (!$staffchildren_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$staffchildren_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffchildren_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffchildren_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffchildren_list->TotalRecords == 0 && !$staffchildren->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffchildren_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$staffchildren_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffchildren_list->isExport()) { ?>
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
$staffchildren_list->terminate();
?>