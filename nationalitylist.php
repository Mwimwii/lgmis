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
$nationality_list = new nationality_list();

// Run the page
$nationality_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$nationality_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$nationality_list->isExport()) { ?>
<script>
var fnationalitylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fnationalitylist = currentForm = new ew.Form("fnationalitylist", "list");
	fnationalitylist.formKeyCountName = '<?php echo $nationality_list->FormKeyCountName ?>';

	// Validate form
	fnationalitylist.validate = function() {
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
			<?php if ($nationality_list->NationalID->Required) { ?>
				elm = this.getElements("x" + infix + "_NationalID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nationality_list->NationalID->caption(), $nationality_list->NationalID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($nationality_list->Nationality->Required) { ?>
				elm = this.getElements("x" + infix + "_Nationality");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $nationality_list->Nationality->caption(), $nationality_list->Nationality->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fnationalitylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fnationalitylist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fnationalitylist");
});
var fnationalitylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fnationalitylistsrch = currentSearchForm = new ew.Form("fnationalitylistsrch");

	// Dynamic selection lists
	// Filters

	fnationalitylistsrch.filterList = <?php echo $nationality_list->getFilterList() ?>;

	// Init search panel as collapsed
	fnationalitylistsrch.initSearchPanel = true;
	loadjs.done("fnationalitylistsrch");
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
<?php if (!$nationality_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($nationality_list->TotalRecords > 0 && $nationality_list->ExportOptions->visible()) { ?>
<?php $nationality_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($nationality_list->ImportOptions->visible()) { ?>
<?php $nationality_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($nationality_list->SearchOptions->visible()) { ?>
<?php $nationality_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($nationality_list->FilterOptions->visible()) { ?>
<?php $nationality_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$nationality_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$nationality_list->isExport() && !$nationality->CurrentAction) { ?>
<form name="fnationalitylistsrch" id="fnationalitylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fnationalitylistsrch-search-panel" class="<?php echo $nationality_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="nationality">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $nationality_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($nationality_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($nationality_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $nationality_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($nationality_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($nationality_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($nationality_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($nationality_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $nationality_list->showPageHeader(); ?>
<?php
$nationality_list->showMessage();
?>
<?php if ($nationality_list->TotalRecords > 0 || $nationality->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($nationality_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> nationality">
<?php if (!$nationality_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$nationality_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $nationality_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $nationality_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fnationalitylist" id="fnationalitylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="nationality">
<div id="gmp_nationality" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($nationality_list->TotalRecords > 0 || $nationality_list->isAdd() || $nationality_list->isCopy() || $nationality_list->isGridEdit()) { ?>
<table id="tbl_nationalitylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$nationality->RowType = ROWTYPE_HEADER;

// Render list options
$nationality_list->renderListOptions();

// Render list options (header, left)
$nationality_list->ListOptions->render("header", "left");
?>
<?php if ($nationality_list->NationalID->Visible) { // NationalID ?>
	<?php if ($nationality_list->SortUrl($nationality_list->NationalID) == "") { ?>
		<th data-name="NationalID" class="<?php echo $nationality_list->NationalID->headerCellClass() ?>"><div id="elh_nationality_NationalID" class="nationality_NationalID"><div class="ew-table-header-caption"><?php echo $nationality_list->NationalID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NationalID" class="<?php echo $nationality_list->NationalID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nationality_list->SortUrl($nationality_list->NationalID) ?>', 1);"><div id="elh_nationality_NationalID" class="nationality_NationalID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nationality_list->NationalID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nationality_list->NationalID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nationality_list->NationalID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($nationality_list->Nationality->Visible) { // Nationality ?>
	<?php if ($nationality_list->SortUrl($nationality_list->Nationality) == "") { ?>
		<th data-name="Nationality" class="<?php echo $nationality_list->Nationality->headerCellClass() ?>"><div id="elh_nationality_Nationality" class="nationality_Nationality"><div class="ew-table-header-caption"><?php echo $nationality_list->Nationality->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nationality" class="<?php echo $nationality_list->Nationality->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $nationality_list->SortUrl($nationality_list->Nationality) ?>', 1);"><div id="elh_nationality_Nationality" class="nationality_Nationality">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $nationality_list->Nationality->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($nationality_list->Nationality->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($nationality_list->Nationality->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$nationality_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($nationality_list->isAdd() || $nationality_list->isCopy()) {
		$nationality_list->RowIndex = 0;
		$nationality_list->KeyCount = $nationality_list->RowIndex;
		if ($nationality_list->isAdd())
			$nationality_list->loadRowValues();
		if ($nationality->EventCancelled) // Insert failed
			$nationality_list->restoreFormValues(); // Restore form values

		// Set row properties
		$nationality->resetAttributes();
		$nationality->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_nationality", "data-rowtype" => ROWTYPE_ADD]);
		$nationality->RowType = ROWTYPE_ADD;

		// Render row
		$nationality_list->renderRow();

		// Render list options
		$nationality_list->renderListOptions();
		$nationality_list->StartRowCount = 0;
?>
	<tr <?php echo $nationality->rowAttributes() ?>>
<?php

// Render list options (body, left)
$nationality_list->ListOptions->render("body", "left", $nationality_list->RowCount);
?>
	<?php if ($nationality_list->NationalID->Visible) { // NationalID ?>
		<td data-name="NationalID">
<span id="el<?php echo $nationality_list->RowCount ?>_nationality_NationalID" class="form-group nationality_NationalID">
<input type="text" data-table="nationality" data-field="x_NationalID" name="x<?php echo $nationality_list->RowIndex ?>_NationalID" id="x<?php echo $nationality_list->RowIndex ?>_NationalID" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($nationality_list->NationalID->getPlaceHolder()) ?>" value="<?php echo $nationality_list->NationalID->EditValue ?>"<?php echo $nationality_list->NationalID->editAttributes() ?>>
</span>
<input type="hidden" data-table="nationality" data-field="x_NationalID" name="o<?php echo $nationality_list->RowIndex ?>_NationalID" id="o<?php echo $nationality_list->RowIndex ?>_NationalID" value="<?php echo HtmlEncode($nationality_list->NationalID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($nationality_list->Nationality->Visible) { // Nationality ?>
		<td data-name="Nationality">
<span id="el<?php echo $nationality_list->RowCount ?>_nationality_Nationality" class="form-group nationality_Nationality">
<input type="text" data-table="nationality" data-field="x_Nationality" name="x<?php echo $nationality_list->RowIndex ?>_Nationality" id="x<?php echo $nationality_list->RowIndex ?>_Nationality" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($nationality_list->Nationality->getPlaceHolder()) ?>" value="<?php echo $nationality_list->Nationality->EditValue ?>"<?php echo $nationality_list->Nationality->editAttributes() ?>>
</span>
<input type="hidden" data-table="nationality" data-field="x_Nationality" name="o<?php echo $nationality_list->RowIndex ?>_Nationality" id="o<?php echo $nationality_list->RowIndex ?>_Nationality" value="<?php echo HtmlEncode($nationality_list->Nationality->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$nationality_list->ListOptions->render("body", "right", $nationality_list->RowCount);
?>
<script>
loadjs.ready(["fnationalitylist", "load"], function() {
	fnationalitylist.updateLists(<?php echo $nationality_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($nationality_list->ExportAll && $nationality_list->isExport()) {
	$nationality_list->StopRecord = $nationality_list->TotalRecords;
} else {

	// Set the last record to display
	if ($nationality_list->TotalRecords > $nationality_list->StartRecord + $nationality_list->DisplayRecords - 1)
		$nationality_list->StopRecord = $nationality_list->StartRecord + $nationality_list->DisplayRecords - 1;
	else
		$nationality_list->StopRecord = $nationality_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($nationality->isConfirm() || $nationality_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($nationality_list->FormKeyCountName) && ($nationality_list->isGridAdd() || $nationality_list->isGridEdit() || $nationality->isConfirm())) {
		$nationality_list->KeyCount = $CurrentForm->getValue($nationality_list->FormKeyCountName);
		$nationality_list->StopRecord = $nationality_list->StartRecord + $nationality_list->KeyCount - 1;
	}
}
$nationality_list->RecordCount = $nationality_list->StartRecord - 1;
if ($nationality_list->Recordset && !$nationality_list->Recordset->EOF) {
	$nationality_list->Recordset->moveFirst();
	$selectLimit = $nationality_list->UseSelectLimit;
	if (!$selectLimit && $nationality_list->StartRecord > 1)
		$nationality_list->Recordset->move($nationality_list->StartRecord - 1);
} elseif (!$nationality->AllowAddDeleteRow && $nationality_list->StopRecord == 0) {
	$nationality_list->StopRecord = $nationality->GridAddRowCount;
}

// Initialize aggregate
$nationality->RowType = ROWTYPE_AGGREGATEINIT;
$nationality->resetAttributes();
$nationality_list->renderRow();
$nationality_list->EditRowCount = 0;
if ($nationality_list->isEdit())
	$nationality_list->RowIndex = 1;
while ($nationality_list->RecordCount < $nationality_list->StopRecord) {
	$nationality_list->RecordCount++;
	if ($nationality_list->RecordCount >= $nationality_list->StartRecord) {
		$nationality_list->RowCount++;

		// Set up key count
		$nationality_list->KeyCount = $nationality_list->RowIndex;

		// Init row class and style
		$nationality->resetAttributes();
		$nationality->CssClass = "";
		if ($nationality_list->isGridAdd()) {
			$nationality_list->loadRowValues(); // Load default values
		} else {
			$nationality_list->loadRowValues($nationality_list->Recordset); // Load row values
		}
		$nationality->RowType = ROWTYPE_VIEW; // Render view
		if ($nationality_list->isEdit()) {
			if ($nationality_list->checkInlineEditKey() && $nationality_list->EditRowCount == 0) { // Inline edit
				$nationality->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($nationality_list->isEdit() && $nationality->RowType == ROWTYPE_EDIT && $nationality->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$nationality_list->restoreFormValues(); // Restore form values
		}
		if ($nationality->RowType == ROWTYPE_EDIT) // Edit row
			$nationality_list->EditRowCount++;

		// Set up row id / data-rowindex
		$nationality->RowAttrs->merge(["data-rowindex" => $nationality_list->RowCount, "id" => "r" . $nationality_list->RowCount . "_nationality", "data-rowtype" => $nationality->RowType]);

		// Render row
		$nationality_list->renderRow();

		// Render list options
		$nationality_list->renderListOptions();
?>
	<tr <?php echo $nationality->rowAttributes() ?>>
<?php

// Render list options (body, left)
$nationality_list->ListOptions->render("body", "left", $nationality_list->RowCount);
?>
	<?php if ($nationality_list->NationalID->Visible) { // NationalID ?>
		<td data-name="NationalID" <?php echo $nationality_list->NationalID->cellAttributes() ?>>
<?php if ($nationality->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="nationality" data-field="x_NationalID" name="x<?php echo $nationality_list->RowIndex ?>_NationalID" id="x<?php echo $nationality_list->RowIndex ?>_NationalID" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($nationality_list->NationalID->getPlaceHolder()) ?>" value="<?php echo $nationality_list->NationalID->EditValue ?>"<?php echo $nationality_list->NationalID->editAttributes() ?>>
<input type="hidden" data-table="nationality" data-field="x_NationalID" name="o<?php echo $nationality_list->RowIndex ?>_NationalID" id="o<?php echo $nationality_list->RowIndex ?>_NationalID" value="<?php echo HtmlEncode($nationality_list->NationalID->OldValue != null ? $nationality_list->NationalID->OldValue : $nationality_list->NationalID->CurrentValue) ?>">
<?php } ?>
<?php if ($nationality->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $nationality_list->RowCount ?>_nationality_NationalID">
<span<?php echo $nationality_list->NationalID->viewAttributes() ?>><?php echo $nationality_list->NationalID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($nationality_list->Nationality->Visible) { // Nationality ?>
		<td data-name="Nationality" <?php echo $nationality_list->Nationality->cellAttributes() ?>>
<?php if ($nationality->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $nationality_list->RowCount ?>_nationality_Nationality" class="form-group">
<input type="text" data-table="nationality" data-field="x_Nationality" name="x<?php echo $nationality_list->RowIndex ?>_Nationality" id="x<?php echo $nationality_list->RowIndex ?>_Nationality" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($nationality_list->Nationality->getPlaceHolder()) ?>" value="<?php echo $nationality_list->Nationality->EditValue ?>"<?php echo $nationality_list->Nationality->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($nationality->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $nationality_list->RowCount ?>_nationality_Nationality">
<span<?php echo $nationality_list->Nationality->viewAttributes() ?>><?php echo $nationality_list->Nationality->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$nationality_list->ListOptions->render("body", "right", $nationality_list->RowCount);
?>
	</tr>
<?php if ($nationality->RowType == ROWTYPE_ADD || $nationality->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fnationalitylist", "load"], function() {
	fnationalitylist.updateLists(<?php echo $nationality_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	if (!$nationality_list->isGridAdd())
		$nationality_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($nationality_list->isAdd() || $nationality_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $nationality_list->FormKeyCountName ?>" id="<?php echo $nationality_list->FormKeyCountName ?>" value="<?php echo $nationality_list->KeyCount ?>">
<?php } ?>
<?php if ($nationality_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $nationality_list->FormKeyCountName ?>" id="<?php echo $nationality_list->FormKeyCountName ?>" value="<?php echo $nationality_list->KeyCount ?>">
<?php } ?>
<?php if (!$nationality->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($nationality_list->Recordset)
	$nationality_list->Recordset->Close();
?>
<?php if (!$nationality_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$nationality_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $nationality_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $nationality_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($nationality_list->TotalRecords == 0 && !$nationality->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $nationality_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$nationality_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$nationality_list->isExport()) { ?>
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
$nationality_list->terminate();
?>