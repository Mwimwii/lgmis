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
$province_list = new province_list();

// Run the page
$province_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$province_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$province_list->isExport()) { ?>
<script>
var fprovincelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprovincelist = currentForm = new ew.Form("fprovincelist", "list");
	fprovincelist.formKeyCountName = '<?php echo $province_list->FormKeyCountName ?>';

	// Validate form
	fprovincelist.validate = function() {
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
			<?php if ($province_list->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $province_list->ProvinceCode->caption(), $province_list->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($province_list->ProvinceCode->errorMessage()) ?>");
			<?php if ($province_list->ProvinceName->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $province_list->ProvinceName->caption(), $province_list->ProvinceName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($province_list->Comment->Required) { ?>
				elm = this.getElements("x" + infix + "_Comment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $province_list->Comment->caption(), $province_list->Comment->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fprovincelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprovincelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fprovincelist");
});
var fprovincelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprovincelistsrch = currentSearchForm = new ew.Form("fprovincelistsrch");

	// Dynamic selection lists
	// Filters

	fprovincelistsrch.filterList = <?php echo $province_list->getFilterList() ?>;

	// Init search panel as collapsed
	fprovincelistsrch.initSearchPanel = true;
	loadjs.done("fprovincelistsrch");
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
<?php if (!$province_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($province_list->TotalRecords > 0 && $province_list->ExportOptions->visible()) { ?>
<?php $province_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($province_list->ImportOptions->visible()) { ?>
<?php $province_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($province_list->SearchOptions->visible()) { ?>
<?php $province_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($province_list->FilterOptions->visible()) { ?>
<?php $province_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$province_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$province_list->isExport() && !$province->CurrentAction) { ?>
<form name="fprovincelistsrch" id="fprovincelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprovincelistsrch-search-panel" class="<?php echo $province_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="province">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $province_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($province_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($province_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $province_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($province_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($province_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($province_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($province_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $province_list->showPageHeader(); ?>
<?php
$province_list->showMessage();
?>
<?php if ($province_list->TotalRecords > 0 || $province->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($province_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> province">
<?php if (!$province_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$province_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $province_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $province_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprovincelist" id="fprovincelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="province">
<div id="gmp_province" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($province_list->TotalRecords > 0 || $province_list->isAdd() || $province_list->isCopy() || $province_list->isGridEdit()) { ?>
<table id="tbl_provincelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$province->RowType = ROWTYPE_HEADER;

// Render list options
$province_list->renderListOptions();

// Render list options (header, left)
$province_list->ListOptions->render("header", "left");
?>
<?php if ($province_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($province_list->SortUrl($province_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $province_list->ProvinceCode->headerCellClass() ?>"><div id="elh_province_ProvinceCode" class="province_ProvinceCode"><div class="ew-table-header-caption"><?php echo $province_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $province_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $province_list->SortUrl($province_list->ProvinceCode) ?>', 1);"><div id="elh_province_ProvinceCode" class="province_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $province_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($province_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($province_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($province_list->ProvinceName->Visible) { // ProvinceName ?>
	<?php if ($province_list->SortUrl($province_list->ProvinceName) == "") { ?>
		<th data-name="ProvinceName" class="<?php echo $province_list->ProvinceName->headerCellClass() ?>"><div id="elh_province_ProvinceName" class="province_ProvinceName"><div class="ew-table-header-caption"><?php echo $province_list->ProvinceName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceName" class="<?php echo $province_list->ProvinceName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $province_list->SortUrl($province_list->ProvinceName) ?>', 1);"><div id="elh_province_ProvinceName" class="province_ProvinceName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $province_list->ProvinceName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($province_list->ProvinceName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($province_list->ProvinceName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($province_list->Comment->Visible) { // Comment ?>
	<?php if ($province_list->SortUrl($province_list->Comment) == "") { ?>
		<th data-name="Comment" class="<?php echo $province_list->Comment->headerCellClass() ?>"><div id="elh_province_Comment" class="province_Comment"><div class="ew-table-header-caption"><?php echo $province_list->Comment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Comment" class="<?php echo $province_list->Comment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $province_list->SortUrl($province_list->Comment) ?>', 1);"><div id="elh_province_Comment" class="province_Comment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $province_list->Comment->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($province_list->Comment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($province_list->Comment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$province_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($province_list->isAdd() || $province_list->isCopy()) {
		$province_list->RowIndex = 0;
		$province_list->KeyCount = $province_list->RowIndex;
		if ($province_list->isAdd())
			$province_list->loadRowValues();
		if ($province->EventCancelled) // Insert failed
			$province_list->restoreFormValues(); // Restore form values

		// Set row properties
		$province->resetAttributes();
		$province->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_province", "data-rowtype" => ROWTYPE_ADD]);
		$province->RowType = ROWTYPE_ADD;

		// Render row
		$province_list->renderRow();

		// Render list options
		$province_list->renderListOptions();
		$province_list->StartRowCount = 0;
?>
	<tr <?php echo $province->rowAttributes() ?>>
<?php

// Render list options (body, left)
$province_list->ListOptions->render("body", "left", $province_list->RowCount);
?>
	<?php if ($province_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<span id="el<?php echo $province_list->RowCount ?>_province_ProvinceCode" class="form-group province_ProvinceCode">
<input type="text" data-table="province" data-field="x_ProvinceCode" name="x<?php echo $province_list->RowIndex ?>_ProvinceCode" id="x<?php echo $province_list->RowIndex ?>_ProvinceCode" size="30" placeholder="<?php echo HtmlEncode($province_list->ProvinceCode->getPlaceHolder()) ?>" value="<?php echo $province_list->ProvinceCode->EditValue ?>"<?php echo $province_list->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="province" data-field="x_ProvinceCode" name="o<?php echo $province_list->RowIndex ?>_ProvinceCode" id="o<?php echo $province_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($province_list->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($province_list->ProvinceName->Visible) { // ProvinceName ?>
		<td data-name="ProvinceName">
<span id="el<?php echo $province_list->RowCount ?>_province_ProvinceName" class="form-group province_ProvinceName">
<input type="text" data-table="province" data-field="x_ProvinceName" name="x<?php echo $province_list->RowIndex ?>_ProvinceName" id="x<?php echo $province_list->RowIndex ?>_ProvinceName" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($province_list->ProvinceName->getPlaceHolder()) ?>" value="<?php echo $province_list->ProvinceName->EditValue ?>"<?php echo $province_list->ProvinceName->editAttributes() ?>>
</span>
<input type="hidden" data-table="province" data-field="x_ProvinceName" name="o<?php echo $province_list->RowIndex ?>_ProvinceName" id="o<?php echo $province_list->RowIndex ?>_ProvinceName" value="<?php echo HtmlEncode($province_list->ProvinceName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($province_list->Comment->Visible) { // Comment ?>
		<td data-name="Comment">
<span id="el<?php echo $province_list->RowCount ?>_province_Comment" class="form-group province_Comment">
<textarea data-table="province" data-field="x_Comment" name="x<?php echo $province_list->RowIndex ?>_Comment" id="x<?php echo $province_list->RowIndex ?>_Comment" cols="50" rows="4" placeholder="<?php echo HtmlEncode($province_list->Comment->getPlaceHolder()) ?>"<?php echo $province_list->Comment->editAttributes() ?>><?php echo $province_list->Comment->EditValue ?></textarea>
</span>
<input type="hidden" data-table="province" data-field="x_Comment" name="o<?php echo $province_list->RowIndex ?>_Comment" id="o<?php echo $province_list->RowIndex ?>_Comment" value="<?php echo HtmlEncode($province_list->Comment->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$province_list->ListOptions->render("body", "right", $province_list->RowCount);
?>
<script>
loadjs.ready(["fprovincelist", "load"], function() {
	fprovincelist.updateLists(<?php echo $province_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($province_list->ExportAll && $province_list->isExport()) {
	$province_list->StopRecord = $province_list->TotalRecords;
} else {

	// Set the last record to display
	if ($province_list->TotalRecords > $province_list->StartRecord + $province_list->DisplayRecords - 1)
		$province_list->StopRecord = $province_list->StartRecord + $province_list->DisplayRecords - 1;
	else
		$province_list->StopRecord = $province_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($province->isConfirm() || $province_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($province_list->FormKeyCountName) && ($province_list->isGridAdd() || $province_list->isGridEdit() || $province->isConfirm())) {
		$province_list->KeyCount = $CurrentForm->getValue($province_list->FormKeyCountName);
		$province_list->StopRecord = $province_list->StartRecord + $province_list->KeyCount - 1;
	}
}
$province_list->RecordCount = $province_list->StartRecord - 1;
if ($province_list->Recordset && !$province_list->Recordset->EOF) {
	$province_list->Recordset->moveFirst();
	$selectLimit = $province_list->UseSelectLimit;
	if (!$selectLimit && $province_list->StartRecord > 1)
		$province_list->Recordset->move($province_list->StartRecord - 1);
} elseif (!$province->AllowAddDeleteRow && $province_list->StopRecord == 0) {
	$province_list->StopRecord = $province->GridAddRowCount;
}

// Initialize aggregate
$province->RowType = ROWTYPE_AGGREGATEINIT;
$province->resetAttributes();
$province_list->renderRow();
$province_list->EditRowCount = 0;
if ($province_list->isEdit())
	$province_list->RowIndex = 1;
while ($province_list->RecordCount < $province_list->StopRecord) {
	$province_list->RecordCount++;
	if ($province_list->RecordCount >= $province_list->StartRecord) {
		$province_list->RowCount++;

		// Set up key count
		$province_list->KeyCount = $province_list->RowIndex;

		// Init row class and style
		$province->resetAttributes();
		$province->CssClass = "";
		if ($province_list->isGridAdd()) {
			$province_list->loadRowValues(); // Load default values
		} else {
			$province_list->loadRowValues($province_list->Recordset); // Load row values
		}
		$province->RowType = ROWTYPE_VIEW; // Render view
		if ($province_list->isEdit()) {
			if ($province_list->checkInlineEditKey() && $province_list->EditRowCount == 0) { // Inline edit
				$province->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($province_list->isEdit() && $province->RowType == ROWTYPE_EDIT && $province->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$province_list->restoreFormValues(); // Restore form values
		}
		if ($province->RowType == ROWTYPE_EDIT) // Edit row
			$province_list->EditRowCount++;

		// Set up row id / data-rowindex
		$province->RowAttrs->merge(["data-rowindex" => $province_list->RowCount, "id" => "r" . $province_list->RowCount . "_province", "data-rowtype" => $province->RowType]);

		// Render row
		$province_list->renderRow();

		// Render list options
		$province_list->renderListOptions();
?>
	<tr <?php echo $province->rowAttributes() ?>>
<?php

// Render list options (body, left)
$province_list->ListOptions->render("body", "left", $province_list->RowCount);
?>
	<?php if ($province_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $province_list->ProvinceCode->cellAttributes() ?>>
<?php if ($province->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="province" data-field="x_ProvinceCode" name="x<?php echo $province_list->RowIndex ?>_ProvinceCode" id="x<?php echo $province_list->RowIndex ?>_ProvinceCode" size="30" placeholder="<?php echo HtmlEncode($province_list->ProvinceCode->getPlaceHolder()) ?>" value="<?php echo $province_list->ProvinceCode->EditValue ?>"<?php echo $province_list->ProvinceCode->editAttributes() ?>>
<input type="hidden" data-table="province" data-field="x_ProvinceCode" name="o<?php echo $province_list->RowIndex ?>_ProvinceCode" id="o<?php echo $province_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($province_list->ProvinceCode->OldValue != null ? $province_list->ProvinceCode->OldValue : $province_list->ProvinceCode->CurrentValue) ?>">
<?php } ?>
<?php if ($province->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $province_list->RowCount ?>_province_ProvinceCode">
<span<?php echo $province_list->ProvinceCode->viewAttributes() ?>><?php echo $province_list->ProvinceCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($province_list->ProvinceName->Visible) { // ProvinceName ?>
		<td data-name="ProvinceName" <?php echo $province_list->ProvinceName->cellAttributes() ?>>
<?php if ($province->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $province_list->RowCount ?>_province_ProvinceName" class="form-group">
<input type="text" data-table="province" data-field="x_ProvinceName" name="x<?php echo $province_list->RowIndex ?>_ProvinceName" id="x<?php echo $province_list->RowIndex ?>_ProvinceName" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($province_list->ProvinceName->getPlaceHolder()) ?>" value="<?php echo $province_list->ProvinceName->EditValue ?>"<?php echo $province_list->ProvinceName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($province->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $province_list->RowCount ?>_province_ProvinceName">
<span<?php echo $province_list->ProvinceName->viewAttributes() ?>><?php echo $province_list->ProvinceName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($province_list->Comment->Visible) { // Comment ?>
		<td data-name="Comment" <?php echo $province_list->Comment->cellAttributes() ?>>
<?php if ($province->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $province_list->RowCount ?>_province_Comment" class="form-group">
<textarea data-table="province" data-field="x_Comment" name="x<?php echo $province_list->RowIndex ?>_Comment" id="x<?php echo $province_list->RowIndex ?>_Comment" cols="50" rows="4" placeholder="<?php echo HtmlEncode($province_list->Comment->getPlaceHolder()) ?>"<?php echo $province_list->Comment->editAttributes() ?>><?php echo $province_list->Comment->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($province->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $province_list->RowCount ?>_province_Comment">
<span<?php echo $province_list->Comment->viewAttributes() ?>><?php echo $province_list->Comment->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$province_list->ListOptions->render("body", "right", $province_list->RowCount);
?>
	</tr>
<?php if ($province->RowType == ROWTYPE_ADD || $province->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fprovincelist", "load"], function() {
	fprovincelist.updateLists(<?php echo $province_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	if (!$province_list->isGridAdd())
		$province_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($province_list->isAdd() || $province_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $province_list->FormKeyCountName ?>" id="<?php echo $province_list->FormKeyCountName ?>" value="<?php echo $province_list->KeyCount ?>">
<?php } ?>
<?php if ($province_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $province_list->FormKeyCountName ?>" id="<?php echo $province_list->FormKeyCountName ?>" value="<?php echo $province_list->KeyCount ?>">
<?php } ?>
<?php if (!$province->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($province_list->Recordset)
	$province_list->Recordset->Close();
?>
<?php if (!$province_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$province_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $province_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $province_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($province_list->TotalRecords == 0 && !$province->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $province_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$province_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$province_list->isExport()) { ?>
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
$province_list->terminate();
?>