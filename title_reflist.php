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
$title_ref_list = new title_ref_list();

// Run the page
$title_ref_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$title_ref_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$title_ref_list->isExport()) { ?>
<script>
var ftitle_reflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftitle_reflist = currentForm = new ew.Form("ftitle_reflist", "list");
	ftitle_reflist.formKeyCountName = '<?php echo $title_ref_list->FormKeyCountName ?>';

	// Validate form
	ftitle_reflist.validate = function() {
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
			<?php if ($title_ref_list->Title->Required) { ?>
				elm = this.getElements("x" + infix + "_Title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $title_ref_list->Title->caption(), $title_ref_list->Title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($title_ref_list->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $title_ref_list->Sex->caption(), $title_ref_list->Sex->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	ftitle_reflist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftitle_reflist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftitle_reflist");
});
var ftitle_reflistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftitle_reflistsrch = currentSearchForm = new ew.Form("ftitle_reflistsrch");

	// Dynamic selection lists
	// Filters

	ftitle_reflistsrch.filterList = <?php echo $title_ref_list->getFilterList() ?>;

	// Init search panel as collapsed
	ftitle_reflistsrch.initSearchPanel = true;
	loadjs.done("ftitle_reflistsrch");
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
<?php if (!$title_ref_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($title_ref_list->TotalRecords > 0 && $title_ref_list->ExportOptions->visible()) { ?>
<?php $title_ref_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($title_ref_list->ImportOptions->visible()) { ?>
<?php $title_ref_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($title_ref_list->SearchOptions->visible()) { ?>
<?php $title_ref_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($title_ref_list->FilterOptions->visible()) { ?>
<?php $title_ref_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$title_ref_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$title_ref_list->isExport() && !$title_ref->CurrentAction) { ?>
<form name="ftitle_reflistsrch" id="ftitle_reflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftitle_reflistsrch-search-panel" class="<?php echo $title_ref_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="title_ref">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $title_ref_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($title_ref_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($title_ref_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $title_ref_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($title_ref_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($title_ref_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($title_ref_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($title_ref_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $title_ref_list->showPageHeader(); ?>
<?php
$title_ref_list->showMessage();
?>
<?php if ($title_ref_list->TotalRecords > 0 || $title_ref->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($title_ref_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> title_ref">
<?php if (!$title_ref_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$title_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $title_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $title_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftitle_reflist" id="ftitle_reflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="title_ref">
<div id="gmp_title_ref" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($title_ref_list->TotalRecords > 0 || $title_ref_list->isAdd() || $title_ref_list->isCopy() || $title_ref_list->isGridEdit()) { ?>
<table id="tbl_title_reflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$title_ref->RowType = ROWTYPE_HEADER;

// Render list options
$title_ref_list->renderListOptions();

// Render list options (header, left)
$title_ref_list->ListOptions->render("header", "left");
?>
<?php if ($title_ref_list->Title->Visible) { // Title ?>
	<?php if ($title_ref_list->SortUrl($title_ref_list->Title) == "") { ?>
		<th data-name="Title" class="<?php echo $title_ref_list->Title->headerCellClass() ?>"><div id="elh_title_ref_Title" class="title_ref_Title"><div class="ew-table-header-caption"><?php echo $title_ref_list->Title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Title" class="<?php echo $title_ref_list->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $title_ref_list->SortUrl($title_ref_list->Title) ?>', 1);"><div id="elh_title_ref_Title" class="title_ref_Title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $title_ref_list->Title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($title_ref_list->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($title_ref_list->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($title_ref_list->Sex->Visible) { // Sex ?>
	<?php if ($title_ref_list->SortUrl($title_ref_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $title_ref_list->Sex->headerCellClass() ?>"><div id="elh_title_ref_Sex" class="title_ref_Sex"><div class="ew-table-header-caption"><?php echo $title_ref_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $title_ref_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $title_ref_list->SortUrl($title_ref_list->Sex) ?>', 1);"><div id="elh_title_ref_Sex" class="title_ref_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $title_ref_list->Sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($title_ref_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($title_ref_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$title_ref_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($title_ref_list->isAdd() || $title_ref_list->isCopy()) {
		$title_ref_list->RowIndex = 0;
		$title_ref_list->KeyCount = $title_ref_list->RowIndex;
		if ($title_ref_list->isAdd())
			$title_ref_list->loadRowValues();
		if ($title_ref->EventCancelled) // Insert failed
			$title_ref_list->restoreFormValues(); // Restore form values

		// Set row properties
		$title_ref->resetAttributes();
		$title_ref->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_title_ref", "data-rowtype" => ROWTYPE_ADD]);
		$title_ref->RowType = ROWTYPE_ADD;

		// Render row
		$title_ref_list->renderRow();

		// Render list options
		$title_ref_list->renderListOptions();
		$title_ref_list->StartRowCount = 0;
?>
	<tr <?php echo $title_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$title_ref_list->ListOptions->render("body", "left", $title_ref_list->RowCount);
?>
	<?php if ($title_ref_list->Title->Visible) { // Title ?>
		<td data-name="Title">
<span id="el<?php echo $title_ref_list->RowCount ?>_title_ref_Title" class="form-group title_ref_Title">
<input type="text" data-table="title_ref" data-field="x_Title" name="x<?php echo $title_ref_list->RowIndex ?>_Title" id="x<?php echo $title_ref_list->RowIndex ?>_Title" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($title_ref_list->Title->getPlaceHolder()) ?>" value="<?php echo $title_ref_list->Title->EditValue ?>"<?php echo $title_ref_list->Title->editAttributes() ?>>
</span>
<input type="hidden" data-table="title_ref" data-field="x_Title" name="o<?php echo $title_ref_list->RowIndex ?>_Title" id="o<?php echo $title_ref_list->RowIndex ?>_Title" value="<?php echo HtmlEncode($title_ref_list->Title->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($title_ref_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex">
<span id="el<?php echo $title_ref_list->RowCount ?>_title_ref_Sex" class="form-group title_ref_Sex">
<input type="text" data-table="title_ref" data-field="x_Sex" name="x<?php echo $title_ref_list->RowIndex ?>_Sex" id="x<?php echo $title_ref_list->RowIndex ?>_Sex" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($title_ref_list->Sex->getPlaceHolder()) ?>" value="<?php echo $title_ref_list->Sex->EditValue ?>"<?php echo $title_ref_list->Sex->editAttributes() ?>>
</span>
<input type="hidden" data-table="title_ref" data-field="x_Sex" name="o<?php echo $title_ref_list->RowIndex ?>_Sex" id="o<?php echo $title_ref_list->RowIndex ?>_Sex" value="<?php echo HtmlEncode($title_ref_list->Sex->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$title_ref_list->ListOptions->render("body", "right", $title_ref_list->RowCount);
?>
<script>
loadjs.ready(["ftitle_reflist", "load"], function() {
	ftitle_reflist.updateLists(<?php echo $title_ref_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($title_ref_list->ExportAll && $title_ref_list->isExport()) {
	$title_ref_list->StopRecord = $title_ref_list->TotalRecords;
} else {

	// Set the last record to display
	if ($title_ref_list->TotalRecords > $title_ref_list->StartRecord + $title_ref_list->DisplayRecords - 1)
		$title_ref_list->StopRecord = $title_ref_list->StartRecord + $title_ref_list->DisplayRecords - 1;
	else
		$title_ref_list->StopRecord = $title_ref_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($title_ref->isConfirm() || $title_ref_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($title_ref_list->FormKeyCountName) && ($title_ref_list->isGridAdd() || $title_ref_list->isGridEdit() || $title_ref->isConfirm())) {
		$title_ref_list->KeyCount = $CurrentForm->getValue($title_ref_list->FormKeyCountName);
		$title_ref_list->StopRecord = $title_ref_list->StartRecord + $title_ref_list->KeyCount - 1;
	}
}
$title_ref_list->RecordCount = $title_ref_list->StartRecord - 1;
if ($title_ref_list->Recordset && !$title_ref_list->Recordset->EOF) {
	$title_ref_list->Recordset->moveFirst();
	$selectLimit = $title_ref_list->UseSelectLimit;
	if (!$selectLimit && $title_ref_list->StartRecord > 1)
		$title_ref_list->Recordset->move($title_ref_list->StartRecord - 1);
} elseif (!$title_ref->AllowAddDeleteRow && $title_ref_list->StopRecord == 0) {
	$title_ref_list->StopRecord = $title_ref->GridAddRowCount;
}

// Initialize aggregate
$title_ref->RowType = ROWTYPE_AGGREGATEINIT;
$title_ref->resetAttributes();
$title_ref_list->renderRow();
$title_ref_list->EditRowCount = 0;
if ($title_ref_list->isEdit())
	$title_ref_list->RowIndex = 1;
while ($title_ref_list->RecordCount < $title_ref_list->StopRecord) {
	$title_ref_list->RecordCount++;
	if ($title_ref_list->RecordCount >= $title_ref_list->StartRecord) {
		$title_ref_list->RowCount++;

		// Set up key count
		$title_ref_list->KeyCount = $title_ref_list->RowIndex;

		// Init row class and style
		$title_ref->resetAttributes();
		$title_ref->CssClass = "";
		if ($title_ref_list->isGridAdd()) {
			$title_ref_list->loadRowValues(); // Load default values
		} else {
			$title_ref_list->loadRowValues($title_ref_list->Recordset); // Load row values
		}
		$title_ref->RowType = ROWTYPE_VIEW; // Render view
		if ($title_ref_list->isEdit()) {
			if ($title_ref_list->checkInlineEditKey() && $title_ref_list->EditRowCount == 0) { // Inline edit
				$title_ref->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($title_ref_list->isEdit() && $title_ref->RowType == ROWTYPE_EDIT && $title_ref->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$title_ref_list->restoreFormValues(); // Restore form values
		}
		if ($title_ref->RowType == ROWTYPE_EDIT) // Edit row
			$title_ref_list->EditRowCount++;

		// Set up row id / data-rowindex
		$title_ref->RowAttrs->merge(["data-rowindex" => $title_ref_list->RowCount, "id" => "r" . $title_ref_list->RowCount . "_title_ref", "data-rowtype" => $title_ref->RowType]);

		// Render row
		$title_ref_list->renderRow();

		// Render list options
		$title_ref_list->renderListOptions();
?>
	<tr <?php echo $title_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$title_ref_list->ListOptions->render("body", "left", $title_ref_list->RowCount);
?>
	<?php if ($title_ref_list->Title->Visible) { // Title ?>
		<td data-name="Title" <?php echo $title_ref_list->Title->cellAttributes() ?>>
<?php if ($title_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="title_ref" data-field="x_Title" name="x<?php echo $title_ref_list->RowIndex ?>_Title" id="x<?php echo $title_ref_list->RowIndex ?>_Title" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($title_ref_list->Title->getPlaceHolder()) ?>" value="<?php echo $title_ref_list->Title->EditValue ?>"<?php echo $title_ref_list->Title->editAttributes() ?>>
<input type="hidden" data-table="title_ref" data-field="x_Title" name="o<?php echo $title_ref_list->RowIndex ?>_Title" id="o<?php echo $title_ref_list->RowIndex ?>_Title" value="<?php echo HtmlEncode($title_ref_list->Title->OldValue != null ? $title_ref_list->Title->OldValue : $title_ref_list->Title->CurrentValue) ?>">
<?php } ?>
<?php if ($title_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $title_ref_list->RowCount ?>_title_ref_Title">
<span<?php echo $title_ref_list->Title->viewAttributes() ?>><?php echo $title_ref_list->Title->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($title_ref_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $title_ref_list->Sex->cellAttributes() ?>>
<?php if ($title_ref->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="title_ref" data-field="x_Sex" name="x<?php echo $title_ref_list->RowIndex ?>_Sex" id="x<?php echo $title_ref_list->RowIndex ?>_Sex" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($title_ref_list->Sex->getPlaceHolder()) ?>" value="<?php echo $title_ref_list->Sex->EditValue ?>"<?php echo $title_ref_list->Sex->editAttributes() ?>>
<input type="hidden" data-table="title_ref" data-field="x_Sex" name="o<?php echo $title_ref_list->RowIndex ?>_Sex" id="o<?php echo $title_ref_list->RowIndex ?>_Sex" value="<?php echo HtmlEncode($title_ref_list->Sex->OldValue != null ? $title_ref_list->Sex->OldValue : $title_ref_list->Sex->CurrentValue) ?>">
<?php } ?>
<?php if ($title_ref->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $title_ref_list->RowCount ?>_title_ref_Sex">
<span<?php echo $title_ref_list->Sex->viewAttributes() ?>><?php echo $title_ref_list->Sex->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$title_ref_list->ListOptions->render("body", "right", $title_ref_list->RowCount);
?>
	</tr>
<?php if ($title_ref->RowType == ROWTYPE_ADD || $title_ref->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ftitle_reflist", "load"], function() {
	ftitle_reflist.updateLists(<?php echo $title_ref_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	if (!$title_ref_list->isGridAdd())
		$title_ref_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($title_ref_list->isAdd() || $title_ref_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $title_ref_list->FormKeyCountName ?>" id="<?php echo $title_ref_list->FormKeyCountName ?>" value="<?php echo $title_ref_list->KeyCount ?>">
<?php } ?>
<?php if ($title_ref_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $title_ref_list->FormKeyCountName ?>" id="<?php echo $title_ref_list->FormKeyCountName ?>" value="<?php echo $title_ref_list->KeyCount ?>">
<?php } ?>
<?php if (!$title_ref->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($title_ref_list->Recordset)
	$title_ref_list->Recordset->Close();
?>
<?php if (!$title_ref_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$title_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $title_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $title_ref_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($title_ref_list->TotalRecords == 0 && !$title_ref->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $title_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$title_ref_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$title_ref_list->isExport()) { ?>
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
$title_ref_list->terminate();
?>