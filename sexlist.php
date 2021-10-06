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
$sex_list = new sex_list();

// Run the page
$sex_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sex_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sex_list->isExport()) { ?>
<script>
var fsexlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsexlist = currentForm = new ew.Form("fsexlist", "list");
	fsexlist.formKeyCountName = '<?php echo $sex_list->FormKeyCountName ?>';

	// Validate form
	fsexlist.validate = function() {
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
			<?php if ($sex_list->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $sex_list->Sex->caption(), $sex_list->Sex->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fsexlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fsexlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fsexlist");
});
var fsexlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsexlistsrch = currentSearchForm = new ew.Form("fsexlistsrch");

	// Dynamic selection lists
	// Filters

	fsexlistsrch.filterList = <?php echo $sex_list->getFilterList() ?>;

	// Init search panel as collapsed
	fsexlistsrch.initSearchPanel = true;
	loadjs.done("fsexlistsrch");
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
<?php if (!$sex_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sex_list->TotalRecords > 0 && $sex_list->ExportOptions->visible()) { ?>
<?php $sex_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sex_list->ImportOptions->visible()) { ?>
<?php $sex_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($sex_list->SearchOptions->visible()) { ?>
<?php $sex_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($sex_list->FilterOptions->visible()) { ?>
<?php $sex_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sex_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$sex_list->isExport() && !$sex->CurrentAction) { ?>
<form name="fsexlistsrch" id="fsexlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsexlistsrch-search-panel" class="<?php echo $sex_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="sex">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $sex_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($sex_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($sex_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $sex_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($sex_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($sex_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($sex_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($sex_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $sex_list->showPageHeader(); ?>
<?php
$sex_list->showMessage();
?>
<?php if ($sex_list->TotalRecords > 0 || $sex->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($sex_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sex">
<?php if (!$sex_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$sex_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sex_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sex_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsexlist" id="fsexlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sex">
<div id="gmp_sex" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($sex_list->TotalRecords > 0 || $sex_list->isAdd() || $sex_list->isCopy() || $sex_list->isGridEdit()) { ?>
<table id="tbl_sexlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$sex->RowType = ROWTYPE_HEADER;

// Render list options
$sex_list->renderListOptions();

// Render list options (header, left)
$sex_list->ListOptions->render("header", "left");
?>
<?php if ($sex_list->Sex->Visible) { // Sex ?>
	<?php if ($sex_list->SortUrl($sex_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $sex_list->Sex->headerCellClass() ?>"><div id="elh_sex_Sex" class="sex_Sex"><div class="ew-table-header-caption"><?php echo $sex_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $sex_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sex_list->SortUrl($sex_list->Sex) ?>', 1);"><div id="elh_sex_Sex" class="sex_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sex_list->Sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sex_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sex_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$sex_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($sex_list->isAdd() || $sex_list->isCopy()) {
		$sex_list->RowIndex = 0;
		$sex_list->KeyCount = $sex_list->RowIndex;
		if ($sex_list->isAdd())
			$sex_list->loadRowValues();
		if ($sex->EventCancelled) // Insert failed
			$sex_list->restoreFormValues(); // Restore form values

		// Set row properties
		$sex->resetAttributes();
		$sex->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_sex", "data-rowtype" => ROWTYPE_ADD]);
		$sex->RowType = ROWTYPE_ADD;

		// Render row
		$sex_list->renderRow();

		// Render list options
		$sex_list->renderListOptions();
		$sex_list->StartRowCount = 0;
?>
	<tr <?php echo $sex->rowAttributes() ?>>
<?php

// Render list options (body, left)
$sex_list->ListOptions->render("body", "left", $sex_list->RowCount);
?>
	<?php if ($sex_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex">
<span id="el<?php echo $sex_list->RowCount ?>_sex_Sex" class="form-group sex_Sex">
<input type="text" data-table="sex" data-field="x_Sex" name="x<?php echo $sex_list->RowIndex ?>_Sex" id="x<?php echo $sex_list->RowIndex ?>_Sex" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($sex_list->Sex->getPlaceHolder()) ?>" value="<?php echo $sex_list->Sex->EditValue ?>"<?php echo $sex_list->Sex->editAttributes() ?>>
</span>
<input type="hidden" data-table="sex" data-field="x_Sex" name="o<?php echo $sex_list->RowIndex ?>_Sex" id="o<?php echo $sex_list->RowIndex ?>_Sex" value="<?php echo HtmlEncode($sex_list->Sex->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sex_list->ListOptions->render("body", "right", $sex_list->RowCount);
?>
<script>
loadjs.ready(["fsexlist", "load"], function() {
	fsexlist.updateLists(<?php echo $sex_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($sex_list->ExportAll && $sex_list->isExport()) {
	$sex_list->StopRecord = $sex_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sex_list->TotalRecords > $sex_list->StartRecord + $sex_list->DisplayRecords - 1)
		$sex_list->StopRecord = $sex_list->StartRecord + $sex_list->DisplayRecords - 1;
	else
		$sex_list->StopRecord = $sex_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($sex->isConfirm() || $sex_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($sex_list->FormKeyCountName) && ($sex_list->isGridAdd() || $sex_list->isGridEdit() || $sex->isConfirm())) {
		$sex_list->KeyCount = $CurrentForm->getValue($sex_list->FormKeyCountName);
		$sex_list->StopRecord = $sex_list->StartRecord + $sex_list->KeyCount - 1;
	}
}
$sex_list->RecordCount = $sex_list->StartRecord - 1;
if ($sex_list->Recordset && !$sex_list->Recordset->EOF) {
	$sex_list->Recordset->moveFirst();
	$selectLimit = $sex_list->UseSelectLimit;
	if (!$selectLimit && $sex_list->StartRecord > 1)
		$sex_list->Recordset->move($sex_list->StartRecord - 1);
} elseif (!$sex->AllowAddDeleteRow && $sex_list->StopRecord == 0) {
	$sex_list->StopRecord = $sex->GridAddRowCount;
}

// Initialize aggregate
$sex->RowType = ROWTYPE_AGGREGATEINIT;
$sex->resetAttributes();
$sex_list->renderRow();
$sex_list->EditRowCount = 0;
if ($sex_list->isEdit())
	$sex_list->RowIndex = 1;
while ($sex_list->RecordCount < $sex_list->StopRecord) {
	$sex_list->RecordCount++;
	if ($sex_list->RecordCount >= $sex_list->StartRecord) {
		$sex_list->RowCount++;

		// Set up key count
		$sex_list->KeyCount = $sex_list->RowIndex;

		// Init row class and style
		$sex->resetAttributes();
		$sex->CssClass = "";
		if ($sex_list->isGridAdd()) {
			$sex_list->loadRowValues(); // Load default values
		} else {
			$sex_list->loadRowValues($sex_list->Recordset); // Load row values
		}
		$sex->RowType = ROWTYPE_VIEW; // Render view
		if ($sex_list->isEdit()) {
			if ($sex_list->checkInlineEditKey() && $sex_list->EditRowCount == 0) { // Inline edit
				$sex->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($sex_list->isEdit() && $sex->RowType == ROWTYPE_EDIT && $sex->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$sex_list->restoreFormValues(); // Restore form values
		}
		if ($sex->RowType == ROWTYPE_EDIT) // Edit row
			$sex_list->EditRowCount++;

		// Set up row id / data-rowindex
		$sex->RowAttrs->merge(["data-rowindex" => $sex_list->RowCount, "id" => "r" . $sex_list->RowCount . "_sex", "data-rowtype" => $sex->RowType]);

		// Render row
		$sex_list->renderRow();

		// Render list options
		$sex_list->renderListOptions();
?>
	<tr <?php echo $sex->rowAttributes() ?>>
<?php

// Render list options (body, left)
$sex_list->ListOptions->render("body", "left", $sex_list->RowCount);
?>
	<?php if ($sex_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $sex_list->Sex->cellAttributes() ?>>
<?php if ($sex->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="sex" data-field="x_Sex" name="x<?php echo $sex_list->RowIndex ?>_Sex" id="x<?php echo $sex_list->RowIndex ?>_Sex" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($sex_list->Sex->getPlaceHolder()) ?>" value="<?php echo $sex_list->Sex->EditValue ?>"<?php echo $sex_list->Sex->editAttributes() ?>>
<input type="hidden" data-table="sex" data-field="x_Sex" name="o<?php echo $sex_list->RowIndex ?>_Sex" id="o<?php echo $sex_list->RowIndex ?>_Sex" value="<?php echo HtmlEncode($sex_list->Sex->OldValue != null ? $sex_list->Sex->OldValue : $sex_list->Sex->CurrentValue) ?>">
<?php } ?>
<?php if ($sex->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $sex_list->RowCount ?>_sex_Sex">
<span<?php echo $sex_list->Sex->viewAttributes() ?>><?php echo $sex_list->Sex->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sex_list->ListOptions->render("body", "right", $sex_list->RowCount);
?>
	</tr>
<?php if ($sex->RowType == ROWTYPE_ADD || $sex->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fsexlist", "load"], function() {
	fsexlist.updateLists(<?php echo $sex_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	if (!$sex_list->isGridAdd())
		$sex_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($sex_list->isAdd() || $sex_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $sex_list->FormKeyCountName ?>" id="<?php echo $sex_list->FormKeyCountName ?>" value="<?php echo $sex_list->KeyCount ?>">
<?php } ?>
<?php if ($sex_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $sex_list->FormKeyCountName ?>" id="<?php echo $sex_list->FormKeyCountName ?>" value="<?php echo $sex_list->KeyCount ?>">
<?php } ?>
<?php if (!$sex->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sex_list->Recordset)
	$sex_list->Recordset->Close();
?>
<?php if (!$sex_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$sex_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sex_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sex_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($sex_list->TotalRecords == 0 && !$sex->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sex_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sex_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sex_list->isExport()) { ?>
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
$sex_list->terminate();
?>