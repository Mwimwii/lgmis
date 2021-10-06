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
$yesno_list = new yesno_list();

// Run the page
$yesno_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$yesno_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$yesno_list->isExport()) { ?>
<script>
var fyesnolist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fyesnolist = currentForm = new ew.Form("fyesnolist", "list");
	fyesnolist.formKeyCountName = '<?php echo $yesno_list->FormKeyCountName ?>';

	// Validate form
	fyesnolist.validate = function() {
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
			<?php if ($yesno_list->ChoiceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ChoiceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $yesno_list->ChoiceCode->caption(), $yesno_list->ChoiceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChoiceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($yesno_list->ChoiceCode->errorMessage()) ?>");
			<?php if ($yesno_list->YesNo->Required) { ?>
				elm = this.getElements("x" + infix + "_YesNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $yesno_list->YesNo->caption(), $yesno_list->YesNo->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fyesnolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fyesnolist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fyesnolist");
});
var fyesnolistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fyesnolistsrch = currentSearchForm = new ew.Form("fyesnolistsrch");

	// Dynamic selection lists
	// Filters

	fyesnolistsrch.filterList = <?php echo $yesno_list->getFilterList() ?>;

	// Init search panel as collapsed
	fyesnolistsrch.initSearchPanel = true;
	loadjs.done("fyesnolistsrch");
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
<?php if (!$yesno_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($yesno_list->TotalRecords > 0 && $yesno_list->ExportOptions->visible()) { ?>
<?php $yesno_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($yesno_list->ImportOptions->visible()) { ?>
<?php $yesno_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($yesno_list->SearchOptions->visible()) { ?>
<?php $yesno_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($yesno_list->FilterOptions->visible()) { ?>
<?php $yesno_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$yesno_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$yesno_list->isExport() && !$yesno->CurrentAction) { ?>
<form name="fyesnolistsrch" id="fyesnolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fyesnolistsrch-search-panel" class="<?php echo $yesno_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="yesno">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $yesno_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($yesno_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($yesno_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $yesno_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($yesno_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($yesno_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($yesno_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($yesno_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $yesno_list->showPageHeader(); ?>
<?php
$yesno_list->showMessage();
?>
<?php if ($yesno_list->TotalRecords > 0 || $yesno->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($yesno_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> yesno">
<?php if (!$yesno_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$yesno_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $yesno_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $yesno_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fyesnolist" id="fyesnolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="yesno">
<div id="gmp_yesno" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($yesno_list->TotalRecords > 0 || $yesno_list->isAdd() || $yesno_list->isCopy() || $yesno_list->isGridEdit()) { ?>
<table id="tbl_yesnolist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$yesno->RowType = ROWTYPE_HEADER;

// Render list options
$yesno_list->renderListOptions();

// Render list options (header, left)
$yesno_list->ListOptions->render("header", "left");
?>
<?php if ($yesno_list->ChoiceCode->Visible) { // ChoiceCode ?>
	<?php if ($yesno_list->SortUrl($yesno_list->ChoiceCode) == "") { ?>
		<th data-name="ChoiceCode" class="<?php echo $yesno_list->ChoiceCode->headerCellClass() ?>"><div id="elh_yesno_ChoiceCode" class="yesno_ChoiceCode"><div class="ew-table-header-caption"><?php echo $yesno_list->ChoiceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChoiceCode" class="<?php echo $yesno_list->ChoiceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $yesno_list->SortUrl($yesno_list->ChoiceCode) ?>', 1);"><div id="elh_yesno_ChoiceCode" class="yesno_ChoiceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $yesno_list->ChoiceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($yesno_list->ChoiceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($yesno_list->ChoiceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($yesno_list->YesNo->Visible) { // YesNo ?>
	<?php if ($yesno_list->SortUrl($yesno_list->YesNo) == "") { ?>
		<th data-name="YesNo" class="<?php echo $yesno_list->YesNo->headerCellClass() ?>"><div id="elh_yesno_YesNo" class="yesno_YesNo"><div class="ew-table-header-caption"><?php echo $yesno_list->YesNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="YesNo" class="<?php echo $yesno_list->YesNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $yesno_list->SortUrl($yesno_list->YesNo) ?>', 1);"><div id="elh_yesno_YesNo" class="yesno_YesNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $yesno_list->YesNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($yesno_list->YesNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($yesno_list->YesNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$yesno_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($yesno_list->isAdd() || $yesno_list->isCopy()) {
		$yesno_list->RowIndex = 0;
		$yesno_list->KeyCount = $yesno_list->RowIndex;
		if ($yesno_list->isCopy() && !$yesno_list->loadRow())
			$yesno->CurrentAction = "add";
		if ($yesno_list->isAdd())
			$yesno_list->loadRowValues();
		if ($yesno->EventCancelled) // Insert failed
			$yesno_list->restoreFormValues(); // Restore form values

		// Set row properties
		$yesno->resetAttributes();
		$yesno->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_yesno", "data-rowtype" => ROWTYPE_ADD]);
		$yesno->RowType = ROWTYPE_ADD;

		// Render row
		$yesno_list->renderRow();

		// Render list options
		$yesno_list->renderListOptions();
		$yesno_list->StartRowCount = 0;
?>
	<tr <?php echo $yesno->rowAttributes() ?>>
<?php

// Render list options (body, left)
$yesno_list->ListOptions->render("body", "left", $yesno_list->RowCount);
?>
	<?php if ($yesno_list->ChoiceCode->Visible) { // ChoiceCode ?>
		<td data-name="ChoiceCode">
<span id="el<?php echo $yesno_list->RowCount ?>_yesno_ChoiceCode" class="form-group yesno_ChoiceCode">
<input type="text" data-table="yesno" data-field="x_ChoiceCode" name="x<?php echo $yesno_list->RowIndex ?>_ChoiceCode" id="x<?php echo $yesno_list->RowIndex ?>_ChoiceCode" size="30" placeholder="<?php echo HtmlEncode($yesno_list->ChoiceCode->getPlaceHolder()) ?>" value="<?php echo $yesno_list->ChoiceCode->EditValue ?>"<?php echo $yesno_list->ChoiceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="yesno" data-field="x_ChoiceCode" name="o<?php echo $yesno_list->RowIndex ?>_ChoiceCode" id="o<?php echo $yesno_list->RowIndex ?>_ChoiceCode" value="<?php echo HtmlEncode($yesno_list->ChoiceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($yesno_list->YesNo->Visible) { // YesNo ?>
		<td data-name="YesNo">
<span id="el<?php echo $yesno_list->RowCount ?>_yesno_YesNo" class="form-group yesno_YesNo">
<input type="text" data-table="yesno" data-field="x_YesNo" name="x<?php echo $yesno_list->RowIndex ?>_YesNo" id="x<?php echo $yesno_list->RowIndex ?>_YesNo" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($yesno_list->YesNo->getPlaceHolder()) ?>" value="<?php echo $yesno_list->YesNo->EditValue ?>"<?php echo $yesno_list->YesNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="yesno" data-field="x_YesNo" name="o<?php echo $yesno_list->RowIndex ?>_YesNo" id="o<?php echo $yesno_list->RowIndex ?>_YesNo" value="<?php echo HtmlEncode($yesno_list->YesNo->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$yesno_list->ListOptions->render("body", "right", $yesno_list->RowCount);
?>
<script>
loadjs.ready(["fyesnolist", "load"], function() {
	fyesnolist.updateLists(<?php echo $yesno_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($yesno_list->ExportAll && $yesno_list->isExport()) {
	$yesno_list->StopRecord = $yesno_list->TotalRecords;
} else {

	// Set the last record to display
	if ($yesno_list->TotalRecords > $yesno_list->StartRecord + $yesno_list->DisplayRecords - 1)
		$yesno_list->StopRecord = $yesno_list->StartRecord + $yesno_list->DisplayRecords - 1;
	else
		$yesno_list->StopRecord = $yesno_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($yesno->isConfirm() || $yesno_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($yesno_list->FormKeyCountName) && ($yesno_list->isGridAdd() || $yesno_list->isGridEdit() || $yesno->isConfirm())) {
		$yesno_list->KeyCount = $CurrentForm->getValue($yesno_list->FormKeyCountName);
		$yesno_list->StopRecord = $yesno_list->StartRecord + $yesno_list->KeyCount - 1;
	}
}
$yesno_list->RecordCount = $yesno_list->StartRecord - 1;
if ($yesno_list->Recordset && !$yesno_list->Recordset->EOF) {
	$yesno_list->Recordset->moveFirst();
	$selectLimit = $yesno_list->UseSelectLimit;
	if (!$selectLimit && $yesno_list->StartRecord > 1)
		$yesno_list->Recordset->move($yesno_list->StartRecord - 1);
} elseif (!$yesno->AllowAddDeleteRow && $yesno_list->StopRecord == 0) {
	$yesno_list->StopRecord = $yesno->GridAddRowCount;
}

// Initialize aggregate
$yesno->RowType = ROWTYPE_AGGREGATEINIT;
$yesno->resetAttributes();
$yesno_list->renderRow();
$yesno_list->EditRowCount = 0;
if ($yesno_list->isEdit())
	$yesno_list->RowIndex = 1;
while ($yesno_list->RecordCount < $yesno_list->StopRecord) {
	$yesno_list->RecordCount++;
	if ($yesno_list->RecordCount >= $yesno_list->StartRecord) {
		$yesno_list->RowCount++;

		// Set up key count
		$yesno_list->KeyCount = $yesno_list->RowIndex;

		// Init row class and style
		$yesno->resetAttributes();
		$yesno->CssClass = "";
		if ($yesno_list->isGridAdd()) {
			$yesno_list->loadRowValues(); // Load default values
		} else {
			$yesno_list->loadRowValues($yesno_list->Recordset); // Load row values
		}
		$yesno->RowType = ROWTYPE_VIEW; // Render view
		if ($yesno_list->isEdit()) {
			if ($yesno_list->checkInlineEditKey() && $yesno_list->EditRowCount == 0) { // Inline edit
				$yesno->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($yesno_list->isEdit() && $yesno->RowType == ROWTYPE_EDIT && $yesno->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$yesno_list->restoreFormValues(); // Restore form values
		}
		if ($yesno->RowType == ROWTYPE_EDIT) // Edit row
			$yesno_list->EditRowCount++;

		// Set up row id / data-rowindex
		$yesno->RowAttrs->merge(["data-rowindex" => $yesno_list->RowCount, "id" => "r" . $yesno_list->RowCount . "_yesno", "data-rowtype" => $yesno->RowType]);

		// Render row
		$yesno_list->renderRow();

		// Render list options
		$yesno_list->renderListOptions();
?>
	<tr <?php echo $yesno->rowAttributes() ?>>
<?php

// Render list options (body, left)
$yesno_list->ListOptions->render("body", "left", $yesno_list->RowCount);
?>
	<?php if ($yesno_list->ChoiceCode->Visible) { // ChoiceCode ?>
		<td data-name="ChoiceCode" <?php echo $yesno_list->ChoiceCode->cellAttributes() ?>>
<?php if ($yesno->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="yesno" data-field="x_ChoiceCode" name="x<?php echo $yesno_list->RowIndex ?>_ChoiceCode" id="x<?php echo $yesno_list->RowIndex ?>_ChoiceCode" size="30" placeholder="<?php echo HtmlEncode($yesno_list->ChoiceCode->getPlaceHolder()) ?>" value="<?php echo $yesno_list->ChoiceCode->EditValue ?>"<?php echo $yesno_list->ChoiceCode->editAttributes() ?>>
<input type="hidden" data-table="yesno" data-field="x_ChoiceCode" name="o<?php echo $yesno_list->RowIndex ?>_ChoiceCode" id="o<?php echo $yesno_list->RowIndex ?>_ChoiceCode" value="<?php echo HtmlEncode($yesno_list->ChoiceCode->OldValue != null ? $yesno_list->ChoiceCode->OldValue : $yesno_list->ChoiceCode->CurrentValue) ?>">
<?php } ?>
<?php if ($yesno->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $yesno_list->RowCount ?>_yesno_ChoiceCode">
<span<?php echo $yesno_list->ChoiceCode->viewAttributes() ?>><?php echo $yesno_list->ChoiceCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($yesno_list->YesNo->Visible) { // YesNo ?>
		<td data-name="YesNo" <?php echo $yesno_list->YesNo->cellAttributes() ?>>
<?php if ($yesno->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="yesno" data-field="x_YesNo" name="x<?php echo $yesno_list->RowIndex ?>_YesNo" id="x<?php echo $yesno_list->RowIndex ?>_YesNo" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($yesno_list->YesNo->getPlaceHolder()) ?>" value="<?php echo $yesno_list->YesNo->EditValue ?>"<?php echo $yesno_list->YesNo->editAttributes() ?>>
<input type="hidden" data-table="yesno" data-field="x_YesNo" name="o<?php echo $yesno_list->RowIndex ?>_YesNo" id="o<?php echo $yesno_list->RowIndex ?>_YesNo" value="<?php echo HtmlEncode($yesno_list->YesNo->OldValue != null ? $yesno_list->YesNo->OldValue : $yesno_list->YesNo->CurrentValue) ?>">
<?php } ?>
<?php if ($yesno->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $yesno_list->RowCount ?>_yesno_YesNo">
<span<?php echo $yesno_list->YesNo->viewAttributes() ?>><?php echo $yesno_list->YesNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$yesno_list->ListOptions->render("body", "right", $yesno_list->RowCount);
?>
	</tr>
<?php if ($yesno->RowType == ROWTYPE_ADD || $yesno->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fyesnolist", "load"], function() {
	fyesnolist.updateLists(<?php echo $yesno_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	if (!$yesno_list->isGridAdd())
		$yesno_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($yesno_list->isAdd() || $yesno_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $yesno_list->FormKeyCountName ?>" id="<?php echo $yesno_list->FormKeyCountName ?>" value="<?php echo $yesno_list->KeyCount ?>">
<?php } ?>
<?php if ($yesno_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $yesno_list->FormKeyCountName ?>" id="<?php echo $yesno_list->FormKeyCountName ?>" value="<?php echo $yesno_list->KeyCount ?>">
<?php } ?>
<?php if (!$yesno->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($yesno_list->Recordset)
	$yesno_list->Recordset->Close();
?>
<?php if (!$yesno_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$yesno_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $yesno_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $yesno_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($yesno_list->TotalRecords == 0 && !$yesno->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $yesno_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$yesno_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$yesno_list->isExport()) { ?>
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
$yesno_list->terminate();
?>