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
$qualification_type_list = new qualification_type_list();

// Run the page
$qualification_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualification_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$qualification_type_list->isExport()) { ?>
<script>
var fqualification_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fqualification_typelist = currentForm = new ew.Form("fqualification_typelist", "list");
	fqualification_typelist.formKeyCountName = '<?php echo $qualification_type_list->FormKeyCountName ?>';

	// Validate form
	fqualification_typelist.validate = function() {
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
			<?php if ($qualification_type_list->QualificationType->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $qualification_type_list->QualificationType->caption(), $qualification_type_list->QualificationType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_QualificationType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($qualification_type_list->QualificationType->errorMessage()) ?>");
			<?php if ($qualification_type_list->QualificationTYpeName->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationTYpeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $qualification_type_list->QualificationTYpeName->caption(), $qualification_type_list->QualificationTYpeName->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fqualification_typelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fqualification_typelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fqualification_typelist");
});
var fqualification_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fqualification_typelistsrch = currentSearchForm = new ew.Form("fqualification_typelistsrch");

	// Dynamic selection lists
	// Filters

	fqualification_typelistsrch.filterList = <?php echo $qualification_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fqualification_typelistsrch.initSearchPanel = true;
	loadjs.done("fqualification_typelistsrch");
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
<?php if (!$qualification_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($qualification_type_list->TotalRecords > 0 && $qualification_type_list->ExportOptions->visible()) { ?>
<?php $qualification_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($qualification_type_list->ImportOptions->visible()) { ?>
<?php $qualification_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($qualification_type_list->SearchOptions->visible()) { ?>
<?php $qualification_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($qualification_type_list->FilterOptions->visible()) { ?>
<?php $qualification_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$qualification_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$qualification_type_list->isExport() && !$qualification_type->CurrentAction) { ?>
<form name="fqualification_typelistsrch" id="fqualification_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fqualification_typelistsrch-search-panel" class="<?php echo $qualification_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="qualification_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $qualification_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($qualification_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($qualification_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $qualification_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($qualification_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($qualification_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($qualification_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($qualification_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $qualification_type_list->showPageHeader(); ?>
<?php
$qualification_type_list->showMessage();
?>
<?php if ($qualification_type_list->TotalRecords > 0 || $qualification_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($qualification_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> qualification_type">
<?php if (!$qualification_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$qualification_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $qualification_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $qualification_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fqualification_typelist" id="fqualification_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualification_type">
<div id="gmp_qualification_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($qualification_type_list->TotalRecords > 0 || $qualification_type_list->isAdd() || $qualification_type_list->isCopy() || $qualification_type_list->isGridEdit()) { ?>
<table id="tbl_qualification_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$qualification_type->RowType = ROWTYPE_HEADER;

// Render list options
$qualification_type_list->renderListOptions();

// Render list options (header, left)
$qualification_type_list->ListOptions->render("header", "left");
?>
<?php if ($qualification_type_list->QualificationType->Visible) { // QualificationType ?>
	<?php if ($qualification_type_list->SortUrl($qualification_type_list->QualificationType) == "") { ?>
		<th data-name="QualificationType" class="<?php echo $qualification_type_list->QualificationType->headerCellClass() ?>"><div id="elh_qualification_type_QualificationType" class="qualification_type_QualificationType"><div class="ew-table-header-caption"><?php echo $qualification_type_list->QualificationType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationType" class="<?php echo $qualification_type_list->QualificationType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $qualification_type_list->SortUrl($qualification_type_list->QualificationType) ?>', 1);"><div id="elh_qualification_type_QualificationType" class="qualification_type_QualificationType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualification_type_list->QualificationType->caption() ?></span><span class="ew-table-header-sort"><?php if ($qualification_type_list->QualificationType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualification_type_list->QualificationType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($qualification_type_list->QualificationTYpeName->Visible) { // QualificationTYpeName ?>
	<?php if ($qualification_type_list->SortUrl($qualification_type_list->QualificationTYpeName) == "") { ?>
		<th data-name="QualificationTYpeName" class="<?php echo $qualification_type_list->QualificationTYpeName->headerCellClass() ?>"><div id="elh_qualification_type_QualificationTYpeName" class="qualification_type_QualificationTYpeName"><div class="ew-table-header-caption"><?php echo $qualification_type_list->QualificationTYpeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="QualificationTYpeName" class="<?php echo $qualification_type_list->QualificationTYpeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $qualification_type_list->SortUrl($qualification_type_list->QualificationTYpeName) ?>', 1);"><div id="elh_qualification_type_QualificationTYpeName" class="qualification_type_QualificationTYpeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualification_type_list->QualificationTYpeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($qualification_type_list->QualificationTYpeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualification_type_list->QualificationTYpeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$qualification_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($qualification_type_list->isAdd() || $qualification_type_list->isCopy()) {
		$qualification_type_list->RowIndex = 0;
		$qualification_type_list->KeyCount = $qualification_type_list->RowIndex;
		if ($qualification_type_list->isAdd())
			$qualification_type_list->loadRowValues();
		if ($qualification_type->EventCancelled) // Insert failed
			$qualification_type_list->restoreFormValues(); // Restore form values

		// Set row properties
		$qualification_type->resetAttributes();
		$qualification_type->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_qualification_type", "data-rowtype" => ROWTYPE_ADD]);
		$qualification_type->RowType = ROWTYPE_ADD;

		// Render row
		$qualification_type_list->renderRow();

		// Render list options
		$qualification_type_list->renderListOptions();
		$qualification_type_list->StartRowCount = 0;
?>
	<tr <?php echo $qualification_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$qualification_type_list->ListOptions->render("body", "left", $qualification_type_list->RowCount);
?>
	<?php if ($qualification_type_list->QualificationType->Visible) { // QualificationType ?>
		<td data-name="QualificationType">
<span id="el<?php echo $qualification_type_list->RowCount ?>_qualification_type_QualificationType" class="form-group qualification_type_QualificationType">
<input type="text" data-table="qualification_type" data-field="x_QualificationType" name="x<?php echo $qualification_type_list->RowIndex ?>_QualificationType" id="x<?php echo $qualification_type_list->RowIndex ?>_QualificationType" size="30" placeholder="<?php echo HtmlEncode($qualification_type_list->QualificationType->getPlaceHolder()) ?>" value="<?php echo $qualification_type_list->QualificationType->EditValue ?>"<?php echo $qualification_type_list->QualificationType->editAttributes() ?>>
</span>
<input type="hidden" data-table="qualification_type" data-field="x_QualificationType" name="o<?php echo $qualification_type_list->RowIndex ?>_QualificationType" id="o<?php echo $qualification_type_list->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_type_list->QualificationType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($qualification_type_list->QualificationTYpeName->Visible) { // QualificationTYpeName ?>
		<td data-name="QualificationTYpeName">
<span id="el<?php echo $qualification_type_list->RowCount ?>_qualification_type_QualificationTYpeName" class="form-group qualification_type_QualificationTYpeName">
<input type="text" data-table="qualification_type" data-field="x_QualificationTYpeName" name="x<?php echo $qualification_type_list->RowIndex ?>_QualificationTYpeName" id="x<?php echo $qualification_type_list->RowIndex ?>_QualificationTYpeName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($qualification_type_list->QualificationTYpeName->getPlaceHolder()) ?>" value="<?php echo $qualification_type_list->QualificationTYpeName->EditValue ?>"<?php echo $qualification_type_list->QualificationTYpeName->editAttributes() ?>>
</span>
<input type="hidden" data-table="qualification_type" data-field="x_QualificationTYpeName" name="o<?php echo $qualification_type_list->RowIndex ?>_QualificationTYpeName" id="o<?php echo $qualification_type_list->RowIndex ?>_QualificationTYpeName" value="<?php echo HtmlEncode($qualification_type_list->QualificationTYpeName->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$qualification_type_list->ListOptions->render("body", "right", $qualification_type_list->RowCount);
?>
<script>
loadjs.ready(["fqualification_typelist", "load"], function() {
	fqualification_typelist.updateLists(<?php echo $qualification_type_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($qualification_type_list->ExportAll && $qualification_type_list->isExport()) {
	$qualification_type_list->StopRecord = $qualification_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($qualification_type_list->TotalRecords > $qualification_type_list->StartRecord + $qualification_type_list->DisplayRecords - 1)
		$qualification_type_list->StopRecord = $qualification_type_list->StartRecord + $qualification_type_list->DisplayRecords - 1;
	else
		$qualification_type_list->StopRecord = $qualification_type_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($qualification_type->isConfirm() || $qualification_type_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($qualification_type_list->FormKeyCountName) && ($qualification_type_list->isGridAdd() || $qualification_type_list->isGridEdit() || $qualification_type->isConfirm())) {
		$qualification_type_list->KeyCount = $CurrentForm->getValue($qualification_type_list->FormKeyCountName);
		$qualification_type_list->StopRecord = $qualification_type_list->StartRecord + $qualification_type_list->KeyCount - 1;
	}
}
$qualification_type_list->RecordCount = $qualification_type_list->StartRecord - 1;
if ($qualification_type_list->Recordset && !$qualification_type_list->Recordset->EOF) {
	$qualification_type_list->Recordset->moveFirst();
	$selectLimit = $qualification_type_list->UseSelectLimit;
	if (!$selectLimit && $qualification_type_list->StartRecord > 1)
		$qualification_type_list->Recordset->move($qualification_type_list->StartRecord - 1);
} elseif (!$qualification_type->AllowAddDeleteRow && $qualification_type_list->StopRecord == 0) {
	$qualification_type_list->StopRecord = $qualification_type->GridAddRowCount;
}

// Initialize aggregate
$qualification_type->RowType = ROWTYPE_AGGREGATEINIT;
$qualification_type->resetAttributes();
$qualification_type_list->renderRow();
$qualification_type_list->EditRowCount = 0;
if ($qualification_type_list->isEdit())
	$qualification_type_list->RowIndex = 1;
while ($qualification_type_list->RecordCount < $qualification_type_list->StopRecord) {
	$qualification_type_list->RecordCount++;
	if ($qualification_type_list->RecordCount >= $qualification_type_list->StartRecord) {
		$qualification_type_list->RowCount++;

		// Set up key count
		$qualification_type_list->KeyCount = $qualification_type_list->RowIndex;

		// Init row class and style
		$qualification_type->resetAttributes();
		$qualification_type->CssClass = "";
		if ($qualification_type_list->isGridAdd()) {
			$qualification_type_list->loadRowValues(); // Load default values
		} else {
			$qualification_type_list->loadRowValues($qualification_type_list->Recordset); // Load row values
		}
		$qualification_type->RowType = ROWTYPE_VIEW; // Render view
		if ($qualification_type_list->isEdit()) {
			if ($qualification_type_list->checkInlineEditKey() && $qualification_type_list->EditRowCount == 0) { // Inline edit
				$qualification_type->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($qualification_type_list->isEdit() && $qualification_type->RowType == ROWTYPE_EDIT && $qualification_type->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$qualification_type_list->restoreFormValues(); // Restore form values
		}
		if ($qualification_type->RowType == ROWTYPE_EDIT) // Edit row
			$qualification_type_list->EditRowCount++;

		// Set up row id / data-rowindex
		$qualification_type->RowAttrs->merge(["data-rowindex" => $qualification_type_list->RowCount, "id" => "r" . $qualification_type_list->RowCount . "_qualification_type", "data-rowtype" => $qualification_type->RowType]);

		// Render row
		$qualification_type_list->renderRow();

		// Render list options
		$qualification_type_list->renderListOptions();
?>
	<tr <?php echo $qualification_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$qualification_type_list->ListOptions->render("body", "left", $qualification_type_list->RowCount);
?>
	<?php if ($qualification_type_list->QualificationType->Visible) { // QualificationType ?>
		<td data-name="QualificationType" <?php echo $qualification_type_list->QualificationType->cellAttributes() ?>>
<?php if ($qualification_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="qualification_type" data-field="x_QualificationType" name="x<?php echo $qualification_type_list->RowIndex ?>_QualificationType" id="x<?php echo $qualification_type_list->RowIndex ?>_QualificationType" size="30" placeholder="<?php echo HtmlEncode($qualification_type_list->QualificationType->getPlaceHolder()) ?>" value="<?php echo $qualification_type_list->QualificationType->EditValue ?>"<?php echo $qualification_type_list->QualificationType->editAttributes() ?>>
<input type="hidden" data-table="qualification_type" data-field="x_QualificationType" name="o<?php echo $qualification_type_list->RowIndex ?>_QualificationType" id="o<?php echo $qualification_type_list->RowIndex ?>_QualificationType" value="<?php echo HtmlEncode($qualification_type_list->QualificationType->OldValue != null ? $qualification_type_list->QualificationType->OldValue : $qualification_type_list->QualificationType->CurrentValue) ?>">
<?php } ?>
<?php if ($qualification_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $qualification_type_list->RowCount ?>_qualification_type_QualificationType">
<span<?php echo $qualification_type_list->QualificationType->viewAttributes() ?>><?php echo $qualification_type_list->QualificationType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($qualification_type_list->QualificationTYpeName->Visible) { // QualificationTYpeName ?>
		<td data-name="QualificationTYpeName" <?php echo $qualification_type_list->QualificationTYpeName->cellAttributes() ?>>
<?php if ($qualification_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $qualification_type_list->RowCount ?>_qualification_type_QualificationTYpeName" class="form-group">
<input type="text" data-table="qualification_type" data-field="x_QualificationTYpeName" name="x<?php echo $qualification_type_list->RowIndex ?>_QualificationTYpeName" id="x<?php echo $qualification_type_list->RowIndex ?>_QualificationTYpeName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($qualification_type_list->QualificationTYpeName->getPlaceHolder()) ?>" value="<?php echo $qualification_type_list->QualificationTYpeName->EditValue ?>"<?php echo $qualification_type_list->QualificationTYpeName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($qualification_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $qualification_type_list->RowCount ?>_qualification_type_QualificationTYpeName">
<span<?php echo $qualification_type_list->QualificationTYpeName->viewAttributes() ?>><?php echo $qualification_type_list->QualificationTYpeName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$qualification_type_list->ListOptions->render("body", "right", $qualification_type_list->RowCount);
?>
	</tr>
<?php if ($qualification_type->RowType == ROWTYPE_ADD || $qualification_type->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fqualification_typelist", "load"], function() {
	fqualification_typelist.updateLists(<?php echo $qualification_type_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	if (!$qualification_type_list->isGridAdd())
		$qualification_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($qualification_type_list->isAdd() || $qualification_type_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $qualification_type_list->FormKeyCountName ?>" id="<?php echo $qualification_type_list->FormKeyCountName ?>" value="<?php echo $qualification_type_list->KeyCount ?>">
<?php } ?>
<?php if ($qualification_type_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $qualification_type_list->FormKeyCountName ?>" id="<?php echo $qualification_type_list->FormKeyCountName ?>" value="<?php echo $qualification_type_list->KeyCount ?>">
<?php } ?>
<?php if (!$qualification_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($qualification_type_list->Recordset)
	$qualification_type_list->Recordset->Close();
?>
<?php if (!$qualification_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$qualification_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $qualification_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $qualification_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($qualification_type_list->TotalRecords == 0 && !$qualification_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $qualification_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$qualification_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$qualification_type_list->isExport()) { ?>
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
$qualification_type_list->terminate();
?>