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
$la_type_list = new la_type_list();

// Run the page
$la_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$la_type_list->isExport()) { ?>
<script>
var fla_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fla_typelist = currentForm = new ew.Form("fla_typelist", "list");
	fla_typelist.formKeyCountName = '<?php echo $la_type_list->FormKeyCountName ?>';

	// Validate form
	fla_typelist.validate = function() {
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
			<?php if ($la_type_list->LAType->Required) { ?>
				elm = this.getElements("x" + infix + "_LAType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_type_list->LAType->caption(), $la_type_list->LAType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LAType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($la_type_list->LAType->errorMessage()) ?>");
			<?php if ($la_type_list->LATypeName->Required) { ?>
				elm = this.getElements("x" + infix + "_LATypeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_type_list->LATypeName->caption(), $la_type_list->LATypeName->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fla_typelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fla_typelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fla_typelist");
});
var fla_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fla_typelistsrch = currentSearchForm = new ew.Form("fla_typelistsrch");

	// Dynamic selection lists
	// Filters

	fla_typelistsrch.filterList = <?php echo $la_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fla_typelistsrch.initSearchPanel = true;
	loadjs.done("fla_typelistsrch");
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
<?php if (!$la_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($la_type_list->TotalRecords > 0 && $la_type_list->ExportOptions->visible()) { ?>
<?php $la_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($la_type_list->ImportOptions->visible()) { ?>
<?php $la_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($la_type_list->SearchOptions->visible()) { ?>
<?php $la_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($la_type_list->FilterOptions->visible()) { ?>
<?php $la_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$la_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$la_type_list->isExport() && !$la_type->CurrentAction) { ?>
<form name="fla_typelistsrch" id="fla_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fla_typelistsrch-search-panel" class="<?php echo $la_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="la_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $la_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($la_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($la_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $la_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($la_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($la_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($la_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($la_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $la_type_list->showPageHeader(); ?>
<?php
$la_type_list->showMessage();
?>
<?php if ($la_type_list->TotalRecords > 0 || $la_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($la_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> la_type">
<?php if (!$la_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$la_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $la_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $la_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fla_typelist" id="fla_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_type">
<div id="gmp_la_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($la_type_list->TotalRecords > 0 || $la_type_list->isAdd() || $la_type_list->isCopy() || $la_type_list->isGridEdit()) { ?>
<table id="tbl_la_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$la_type->RowType = ROWTYPE_HEADER;

// Render list options
$la_type_list->renderListOptions();

// Render list options (header, left)
$la_type_list->ListOptions->render("header", "left");
?>
<?php if ($la_type_list->LAType->Visible) { // LAType ?>
	<?php if ($la_type_list->SortUrl($la_type_list->LAType) == "") { ?>
		<th data-name="LAType" class="<?php echo $la_type_list->LAType->headerCellClass() ?>"><div id="elh_la_type_LAType" class="la_type_LAType"><div class="ew-table-header-caption"><?php echo $la_type_list->LAType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAType" class="<?php echo $la_type_list->LAType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $la_type_list->SortUrl($la_type_list->LAType) ?>', 1);"><div id="elh_la_type_LAType" class="la_type_LAType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_type_list->LAType->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_type_list->LAType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_type_list->LAType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_type_list->LATypeName->Visible) { // LATypeName ?>
	<?php if ($la_type_list->SortUrl($la_type_list->LATypeName) == "") { ?>
		<th data-name="LATypeName" class="<?php echo $la_type_list->LATypeName->headerCellClass() ?>"><div id="elh_la_type_LATypeName" class="la_type_LATypeName"><div class="ew-table-header-caption"><?php echo $la_type_list->LATypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LATypeName" class="<?php echo $la_type_list->LATypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $la_type_list->SortUrl($la_type_list->LATypeName) ?>', 1);"><div id="elh_la_type_LATypeName" class="la_type_LATypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_type_list->LATypeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($la_type_list->LATypeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_type_list->LATypeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$la_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($la_type_list->isAdd() || $la_type_list->isCopy()) {
		$la_type_list->RowIndex = 0;
		$la_type_list->KeyCount = $la_type_list->RowIndex;
		if ($la_type_list->isAdd())
			$la_type_list->loadRowValues();
		if ($la_type->EventCancelled) // Insert failed
			$la_type_list->restoreFormValues(); // Restore form values

		// Set row properties
		$la_type->resetAttributes();
		$la_type->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_la_type", "data-rowtype" => ROWTYPE_ADD]);
		$la_type->RowType = ROWTYPE_ADD;

		// Render row
		$la_type_list->renderRow();

		// Render list options
		$la_type_list->renderListOptions();
		$la_type_list->StartRowCount = 0;
?>
	<tr <?php echo $la_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$la_type_list->ListOptions->render("body", "left", $la_type_list->RowCount);
?>
	<?php if ($la_type_list->LAType->Visible) { // LAType ?>
		<td data-name="LAType">
<span id="el<?php echo $la_type_list->RowCount ?>_la_type_LAType" class="form-group la_type_LAType">
<input type="text" data-table="la_type" data-field="x_LAType" name="x<?php echo $la_type_list->RowIndex ?>_LAType" id="x<?php echo $la_type_list->RowIndex ?>_LAType" size="30" placeholder="<?php echo HtmlEncode($la_type_list->LAType->getPlaceHolder()) ?>" value="<?php echo $la_type_list->LAType->EditValue ?>"<?php echo $la_type_list->LAType->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_type" data-field="x_LAType" name="o<?php echo $la_type_list->RowIndex ?>_LAType" id="o<?php echo $la_type_list->RowIndex ?>_LAType" value="<?php echo HtmlEncode($la_type_list->LAType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($la_type_list->LATypeName->Visible) { // LATypeName ?>
		<td data-name="LATypeName">
<span id="el<?php echo $la_type_list->RowCount ?>_la_type_LATypeName" class="form-group la_type_LATypeName">
<input type="text" data-table="la_type" data-field="x_LATypeName" name="x<?php echo $la_type_list->RowIndex ?>_LATypeName" id="x<?php echo $la_type_list->RowIndex ?>_LATypeName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($la_type_list->LATypeName->getPlaceHolder()) ?>" value="<?php echo $la_type_list->LATypeName->EditValue ?>"<?php echo $la_type_list->LATypeName->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_type" data-field="x_LATypeName" name="o<?php echo $la_type_list->RowIndex ?>_LATypeName" id="o<?php echo $la_type_list->RowIndex ?>_LATypeName" value="<?php echo HtmlEncode($la_type_list->LATypeName->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$la_type_list->ListOptions->render("body", "right", $la_type_list->RowCount);
?>
<script>
loadjs.ready(["fla_typelist", "load"], function() {
	fla_typelist.updateLists(<?php echo $la_type_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($la_type_list->ExportAll && $la_type_list->isExport()) {
	$la_type_list->StopRecord = $la_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($la_type_list->TotalRecords > $la_type_list->StartRecord + $la_type_list->DisplayRecords - 1)
		$la_type_list->StopRecord = $la_type_list->StartRecord + $la_type_list->DisplayRecords - 1;
	else
		$la_type_list->StopRecord = $la_type_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($la_type->isConfirm() || $la_type_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($la_type_list->FormKeyCountName) && ($la_type_list->isGridAdd() || $la_type_list->isGridEdit() || $la_type->isConfirm())) {
		$la_type_list->KeyCount = $CurrentForm->getValue($la_type_list->FormKeyCountName);
		$la_type_list->StopRecord = $la_type_list->StartRecord + $la_type_list->KeyCount - 1;
	}
}
$la_type_list->RecordCount = $la_type_list->StartRecord - 1;
if ($la_type_list->Recordset && !$la_type_list->Recordset->EOF) {
	$la_type_list->Recordset->moveFirst();
	$selectLimit = $la_type_list->UseSelectLimit;
	if (!$selectLimit && $la_type_list->StartRecord > 1)
		$la_type_list->Recordset->move($la_type_list->StartRecord - 1);
} elseif (!$la_type->AllowAddDeleteRow && $la_type_list->StopRecord == 0) {
	$la_type_list->StopRecord = $la_type->GridAddRowCount;
}

// Initialize aggregate
$la_type->RowType = ROWTYPE_AGGREGATEINIT;
$la_type->resetAttributes();
$la_type_list->renderRow();
$la_type_list->EditRowCount = 0;
if ($la_type_list->isEdit())
	$la_type_list->RowIndex = 1;
while ($la_type_list->RecordCount < $la_type_list->StopRecord) {
	$la_type_list->RecordCount++;
	if ($la_type_list->RecordCount >= $la_type_list->StartRecord) {
		$la_type_list->RowCount++;

		// Set up key count
		$la_type_list->KeyCount = $la_type_list->RowIndex;

		// Init row class and style
		$la_type->resetAttributes();
		$la_type->CssClass = "";
		if ($la_type_list->isGridAdd()) {
			$la_type_list->loadRowValues(); // Load default values
		} else {
			$la_type_list->loadRowValues($la_type_list->Recordset); // Load row values
		}
		$la_type->RowType = ROWTYPE_VIEW; // Render view
		if ($la_type_list->isEdit()) {
			if ($la_type_list->checkInlineEditKey() && $la_type_list->EditRowCount == 0) { // Inline edit
				$la_type->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($la_type_list->isEdit() && $la_type->RowType == ROWTYPE_EDIT && $la_type->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$la_type_list->restoreFormValues(); // Restore form values
		}
		if ($la_type->RowType == ROWTYPE_EDIT) // Edit row
			$la_type_list->EditRowCount++;

		// Set up row id / data-rowindex
		$la_type->RowAttrs->merge(["data-rowindex" => $la_type_list->RowCount, "id" => "r" . $la_type_list->RowCount . "_la_type", "data-rowtype" => $la_type->RowType]);

		// Render row
		$la_type_list->renderRow();

		// Render list options
		$la_type_list->renderListOptions();
?>
	<tr <?php echo $la_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$la_type_list->ListOptions->render("body", "left", $la_type_list->RowCount);
?>
	<?php if ($la_type_list->LAType->Visible) { // LAType ?>
		<td data-name="LAType" <?php echo $la_type_list->LAType->cellAttributes() ?>>
<?php if ($la_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="la_type" data-field="x_LAType" name="x<?php echo $la_type_list->RowIndex ?>_LAType" id="x<?php echo $la_type_list->RowIndex ?>_LAType" size="30" placeholder="<?php echo HtmlEncode($la_type_list->LAType->getPlaceHolder()) ?>" value="<?php echo $la_type_list->LAType->EditValue ?>"<?php echo $la_type_list->LAType->editAttributes() ?>>
<input type="hidden" data-table="la_type" data-field="x_LAType" name="o<?php echo $la_type_list->RowIndex ?>_LAType" id="o<?php echo $la_type_list->RowIndex ?>_LAType" value="<?php echo HtmlEncode($la_type_list->LAType->OldValue != null ? $la_type_list->LAType->OldValue : $la_type_list->LAType->CurrentValue) ?>">
<?php } ?>
<?php if ($la_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_type_list->RowCount ?>_la_type_LAType">
<span<?php echo $la_type_list->LAType->viewAttributes() ?>><?php echo $la_type_list->LAType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($la_type_list->LATypeName->Visible) { // LATypeName ?>
		<td data-name="LATypeName" <?php echo $la_type_list->LATypeName->cellAttributes() ?>>
<?php if ($la_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $la_type_list->RowCount ?>_la_type_LATypeName" class="form-group">
<input type="text" data-table="la_type" data-field="x_LATypeName" name="x<?php echo $la_type_list->RowIndex ?>_LATypeName" id="x<?php echo $la_type_list->RowIndex ?>_LATypeName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($la_type_list->LATypeName->getPlaceHolder()) ?>" value="<?php echo $la_type_list->LATypeName->EditValue ?>"<?php echo $la_type_list->LATypeName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($la_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_type_list->RowCount ?>_la_type_LATypeName">
<span<?php echo $la_type_list->LATypeName->viewAttributes() ?>><?php echo $la_type_list->LATypeName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$la_type_list->ListOptions->render("body", "right", $la_type_list->RowCount);
?>
	</tr>
<?php if ($la_type->RowType == ROWTYPE_ADD || $la_type->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fla_typelist", "load"], function() {
	fla_typelist.updateLists(<?php echo $la_type_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	if (!$la_type_list->isGridAdd())
		$la_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($la_type_list->isAdd() || $la_type_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $la_type_list->FormKeyCountName ?>" id="<?php echo $la_type_list->FormKeyCountName ?>" value="<?php echo $la_type_list->KeyCount ?>">
<?php } ?>
<?php if ($la_type_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $la_type_list->FormKeyCountName ?>" id="<?php echo $la_type_list->FormKeyCountName ?>" value="<?php echo $la_type_list->KeyCount ?>">
<?php } ?>
<?php if (!$la_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($la_type_list->Recordset)
	$la_type_list->Recordset->Close();
?>
<?php if (!$la_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$la_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $la_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $la_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($la_type_list->TotalRecords == 0 && !$la_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $la_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$la_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$la_type_list->isExport()) { ?>
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
$la_type_list->terminate();
?>