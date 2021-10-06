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
$funding_source_list = new funding_source_list();

// Run the page
$funding_source_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$funding_source_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$funding_source_list->isExport()) { ?>
<script>
var ffunding_sourcelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ffunding_sourcelist = currentForm = new ew.Form("ffunding_sourcelist", "list");
	ffunding_sourcelist.formKeyCountName = '<?php echo $funding_source_list->FormKeyCountName ?>';

	// Validate form
	ffunding_sourcelist.validate = function() {
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
			<?php if ($funding_source_list->FundingSource->Required) { ?>
				elm = this.getElements("x" + infix + "_FundingSource");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $funding_source_list->FundingSource->caption(), $funding_source_list->FundingSource->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	ffunding_sourcelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ffunding_sourcelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ffunding_sourcelist");
});
var ffunding_sourcelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ffunding_sourcelistsrch = currentSearchForm = new ew.Form("ffunding_sourcelistsrch");

	// Dynamic selection lists
	// Filters

	ffunding_sourcelistsrch.filterList = <?php echo $funding_source_list->getFilterList() ?>;

	// Init search panel as collapsed
	ffunding_sourcelistsrch.initSearchPanel = true;
	loadjs.done("ffunding_sourcelistsrch");
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
<?php if (!$funding_source_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($funding_source_list->TotalRecords > 0 && $funding_source_list->ExportOptions->visible()) { ?>
<?php $funding_source_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($funding_source_list->ImportOptions->visible()) { ?>
<?php $funding_source_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($funding_source_list->SearchOptions->visible()) { ?>
<?php $funding_source_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($funding_source_list->FilterOptions->visible()) { ?>
<?php $funding_source_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$funding_source_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$funding_source_list->isExport() && !$funding_source->CurrentAction) { ?>
<form name="ffunding_sourcelistsrch" id="ffunding_sourcelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ffunding_sourcelistsrch-search-panel" class="<?php echo $funding_source_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="funding_source">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $funding_source_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($funding_source_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($funding_source_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $funding_source_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($funding_source_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($funding_source_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($funding_source_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($funding_source_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $funding_source_list->showPageHeader(); ?>
<?php
$funding_source_list->showMessage();
?>
<?php if ($funding_source_list->TotalRecords > 0 || $funding_source->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($funding_source_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> funding_source">
<?php if (!$funding_source_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$funding_source_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $funding_source_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $funding_source_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ffunding_sourcelist" id="ffunding_sourcelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="funding_source">
<div id="gmp_funding_source" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($funding_source_list->TotalRecords > 0 || $funding_source_list->isAdd() || $funding_source_list->isCopy() || $funding_source_list->isGridEdit()) { ?>
<table id="tbl_funding_sourcelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$funding_source->RowType = ROWTYPE_HEADER;

// Render list options
$funding_source_list->renderListOptions();

// Render list options (header, left)
$funding_source_list->ListOptions->render("header", "left");
?>
<?php if ($funding_source_list->FundingSource->Visible) { // FundingSource ?>
	<?php if ($funding_source_list->SortUrl($funding_source_list->FundingSource) == "") { ?>
		<th data-name="FundingSource" class="<?php echo $funding_source_list->FundingSource->headerCellClass() ?>"><div id="elh_funding_source_FundingSource" class="funding_source_FundingSource"><div class="ew-table-header-caption"><?php echo $funding_source_list->FundingSource->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FundingSource" class="<?php echo $funding_source_list->FundingSource->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $funding_source_list->SortUrl($funding_source_list->FundingSource) ?>', 1);"><div id="elh_funding_source_FundingSource" class="funding_source_FundingSource">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $funding_source_list->FundingSource->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($funding_source_list->FundingSource->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($funding_source_list->FundingSource->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$funding_source_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($funding_source_list->isAdd() || $funding_source_list->isCopy()) {
		$funding_source_list->RowIndex = 0;
		$funding_source_list->KeyCount = $funding_source_list->RowIndex;
		if ($funding_source_list->isAdd())
			$funding_source_list->loadRowValues();
		if ($funding_source->EventCancelled) // Insert failed
			$funding_source_list->restoreFormValues(); // Restore form values

		// Set row properties
		$funding_source->resetAttributes();
		$funding_source->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_funding_source", "data-rowtype" => ROWTYPE_ADD]);
		$funding_source->RowType = ROWTYPE_ADD;

		// Render row
		$funding_source_list->renderRow();

		// Render list options
		$funding_source_list->renderListOptions();
		$funding_source_list->StartRowCount = 0;
?>
	<tr <?php echo $funding_source->rowAttributes() ?>>
<?php

// Render list options (body, left)
$funding_source_list->ListOptions->render("body", "left", $funding_source_list->RowCount);
?>
	<?php if ($funding_source_list->FundingSource->Visible) { // FundingSource ?>
		<td data-name="FundingSource">
<span id="el<?php echo $funding_source_list->RowCount ?>_funding_source_FundingSource" class="form-group funding_source_FundingSource">
<input type="text" data-table="funding_source" data-field="x_FundingSource" name="x<?php echo $funding_source_list->RowIndex ?>_FundingSource" id="x<?php echo $funding_source_list->RowIndex ?>_FundingSource" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($funding_source_list->FundingSource->getPlaceHolder()) ?>" value="<?php echo $funding_source_list->FundingSource->EditValue ?>"<?php echo $funding_source_list->FundingSource->editAttributes() ?>>
</span>
<input type="hidden" data-table="funding_source" data-field="x_FundingSource" name="o<?php echo $funding_source_list->RowIndex ?>_FundingSource" id="o<?php echo $funding_source_list->RowIndex ?>_FundingSource" value="<?php echo HtmlEncode($funding_source_list->FundingSource->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$funding_source_list->ListOptions->render("body", "right", $funding_source_list->RowCount);
?>
<script>
loadjs.ready(["ffunding_sourcelist", "load"], function() {
	ffunding_sourcelist.updateLists(<?php echo $funding_source_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($funding_source_list->ExportAll && $funding_source_list->isExport()) {
	$funding_source_list->StopRecord = $funding_source_list->TotalRecords;
} else {

	// Set the last record to display
	if ($funding_source_list->TotalRecords > $funding_source_list->StartRecord + $funding_source_list->DisplayRecords - 1)
		$funding_source_list->StopRecord = $funding_source_list->StartRecord + $funding_source_list->DisplayRecords - 1;
	else
		$funding_source_list->StopRecord = $funding_source_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($funding_source->isConfirm() || $funding_source_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($funding_source_list->FormKeyCountName) && ($funding_source_list->isGridAdd() || $funding_source_list->isGridEdit() || $funding_source->isConfirm())) {
		$funding_source_list->KeyCount = $CurrentForm->getValue($funding_source_list->FormKeyCountName);
		$funding_source_list->StopRecord = $funding_source_list->StartRecord + $funding_source_list->KeyCount - 1;
	}
}
$funding_source_list->RecordCount = $funding_source_list->StartRecord - 1;
if ($funding_source_list->Recordset && !$funding_source_list->Recordset->EOF) {
	$funding_source_list->Recordset->moveFirst();
	$selectLimit = $funding_source_list->UseSelectLimit;
	if (!$selectLimit && $funding_source_list->StartRecord > 1)
		$funding_source_list->Recordset->move($funding_source_list->StartRecord - 1);
} elseif (!$funding_source->AllowAddDeleteRow && $funding_source_list->StopRecord == 0) {
	$funding_source_list->StopRecord = $funding_source->GridAddRowCount;
}

// Initialize aggregate
$funding_source->RowType = ROWTYPE_AGGREGATEINIT;
$funding_source->resetAttributes();
$funding_source_list->renderRow();
$funding_source_list->EditRowCount = 0;
if ($funding_source_list->isEdit())
	$funding_source_list->RowIndex = 1;
while ($funding_source_list->RecordCount < $funding_source_list->StopRecord) {
	$funding_source_list->RecordCount++;
	if ($funding_source_list->RecordCount >= $funding_source_list->StartRecord) {
		$funding_source_list->RowCount++;

		// Set up key count
		$funding_source_list->KeyCount = $funding_source_list->RowIndex;

		// Init row class and style
		$funding_source->resetAttributes();
		$funding_source->CssClass = "";
		if ($funding_source_list->isGridAdd()) {
			$funding_source_list->loadRowValues(); // Load default values
		} else {
			$funding_source_list->loadRowValues($funding_source_list->Recordset); // Load row values
		}
		$funding_source->RowType = ROWTYPE_VIEW; // Render view
		if ($funding_source_list->isEdit()) {
			if ($funding_source_list->checkInlineEditKey() && $funding_source_list->EditRowCount == 0) { // Inline edit
				$funding_source->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($funding_source_list->isEdit() && $funding_source->RowType == ROWTYPE_EDIT && $funding_source->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$funding_source_list->restoreFormValues(); // Restore form values
		}
		if ($funding_source->RowType == ROWTYPE_EDIT) // Edit row
			$funding_source_list->EditRowCount++;

		// Set up row id / data-rowindex
		$funding_source->RowAttrs->merge(["data-rowindex" => $funding_source_list->RowCount, "id" => "r" . $funding_source_list->RowCount . "_funding_source", "data-rowtype" => $funding_source->RowType]);

		// Render row
		$funding_source_list->renderRow();

		// Render list options
		$funding_source_list->renderListOptions();
?>
	<tr <?php echo $funding_source->rowAttributes() ?>>
<?php

// Render list options (body, left)
$funding_source_list->ListOptions->render("body", "left", $funding_source_list->RowCount);
?>
	<?php if ($funding_source_list->FundingSource->Visible) { // FundingSource ?>
		<td data-name="FundingSource" <?php echo $funding_source_list->FundingSource->cellAttributes() ?>>
<?php if ($funding_source->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="funding_source" data-field="x_FundingSource" name="x<?php echo $funding_source_list->RowIndex ?>_FundingSource" id="x<?php echo $funding_source_list->RowIndex ?>_FundingSource" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($funding_source_list->FundingSource->getPlaceHolder()) ?>" value="<?php echo $funding_source_list->FundingSource->EditValue ?>"<?php echo $funding_source_list->FundingSource->editAttributes() ?>>
<input type="hidden" data-table="funding_source" data-field="x_FundingSource" name="o<?php echo $funding_source_list->RowIndex ?>_FundingSource" id="o<?php echo $funding_source_list->RowIndex ?>_FundingSource" value="<?php echo HtmlEncode($funding_source_list->FundingSource->OldValue != null ? $funding_source_list->FundingSource->OldValue : $funding_source_list->FundingSource->CurrentValue) ?>">
<?php } ?>
<?php if ($funding_source->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $funding_source_list->RowCount ?>_funding_source_FundingSource">
<span<?php echo $funding_source_list->FundingSource->viewAttributes() ?>><?php echo $funding_source_list->FundingSource->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$funding_source_list->ListOptions->render("body", "right", $funding_source_list->RowCount);
?>
	</tr>
<?php if ($funding_source->RowType == ROWTYPE_ADD || $funding_source->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["ffunding_sourcelist", "load"], function() {
	ffunding_sourcelist.updateLists(<?php echo $funding_source_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	if (!$funding_source_list->isGridAdd())
		$funding_source_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($funding_source_list->isAdd() || $funding_source_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $funding_source_list->FormKeyCountName ?>" id="<?php echo $funding_source_list->FormKeyCountName ?>" value="<?php echo $funding_source_list->KeyCount ?>">
<?php } ?>
<?php if ($funding_source_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $funding_source_list->FormKeyCountName ?>" id="<?php echo $funding_source_list->FormKeyCountName ?>" value="<?php echo $funding_source_list->KeyCount ?>">
<?php } ?>
<?php if (!$funding_source->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($funding_source_list->Recordset)
	$funding_source_list->Recordset->Close();
?>
<?php if (!$funding_source_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$funding_source_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $funding_source_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $funding_source_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($funding_source_list->TotalRecords == 0 && !$funding_source->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $funding_source_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$funding_source_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$funding_source_list->isExport()) { ?>
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
$funding_source_list->terminate();
?>