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
$marital_status_list = new marital_status_list();

// Run the page
$marital_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$marital_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$marital_status_list->isExport()) { ?>
<script>
var fmarital_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmarital_statuslist = currentForm = new ew.Form("fmarital_statuslist", "list");
	fmarital_statuslist.formKeyCountName = '<?php echo $marital_status_list->FormKeyCountName ?>';

	// Validate form
	fmarital_statuslist.validate = function() {
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
			<?php if ($marital_status_list->MaritalStatusCode->Required) { ?>
				elm = this.getElements("x" + infix + "_MaritalStatusCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $marital_status_list->MaritalStatusCode->caption(), $marital_status_list->MaritalStatusCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($marital_status_list->MaritalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MaritalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $marital_status_list->MaritalStatus->caption(), $marital_status_list->MaritalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fmarital_statuslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmarital_statuslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmarital_statuslist");
});
var fmarital_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmarital_statuslistsrch = currentSearchForm = new ew.Form("fmarital_statuslistsrch");

	// Dynamic selection lists
	// Filters

	fmarital_statuslistsrch.filterList = <?php echo $marital_status_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmarital_statuslistsrch.initSearchPanel = true;
	loadjs.done("fmarital_statuslistsrch");
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
<?php if (!$marital_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($marital_status_list->TotalRecords > 0 && $marital_status_list->ExportOptions->visible()) { ?>
<?php $marital_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($marital_status_list->ImportOptions->visible()) { ?>
<?php $marital_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($marital_status_list->SearchOptions->visible()) { ?>
<?php $marital_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($marital_status_list->FilterOptions->visible()) { ?>
<?php $marital_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$marital_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$marital_status_list->isExport() && !$marital_status->CurrentAction) { ?>
<form name="fmarital_statuslistsrch" id="fmarital_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmarital_statuslistsrch-search-panel" class="<?php echo $marital_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="marital_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $marital_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($marital_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($marital_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $marital_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($marital_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($marital_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($marital_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($marital_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $marital_status_list->showPageHeader(); ?>
<?php
$marital_status_list->showMessage();
?>
<?php if ($marital_status_list->TotalRecords > 0 || $marital_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($marital_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> marital_status">
<?php if (!$marital_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$marital_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $marital_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $marital_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmarital_statuslist" id="fmarital_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="marital_status">
<div id="gmp_marital_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($marital_status_list->TotalRecords > 0 || $marital_status_list->isAdd() || $marital_status_list->isCopy() || $marital_status_list->isGridEdit()) { ?>
<table id="tbl_marital_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$marital_status->RowType = ROWTYPE_HEADER;

// Render list options
$marital_status_list->renderListOptions();

// Render list options (header, left)
$marital_status_list->ListOptions->render("header", "left");
?>
<?php if ($marital_status_list->MaritalStatusCode->Visible) { // MaritalStatusCode ?>
	<?php if ($marital_status_list->SortUrl($marital_status_list->MaritalStatusCode) == "") { ?>
		<th data-name="MaritalStatusCode" class="<?php echo $marital_status_list->MaritalStatusCode->headerCellClass() ?>"><div id="elh_marital_status_MaritalStatusCode" class="marital_status_MaritalStatusCode"><div class="ew-table-header-caption"><?php echo $marital_status_list->MaritalStatusCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaritalStatusCode" class="<?php echo $marital_status_list->MaritalStatusCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $marital_status_list->SortUrl($marital_status_list->MaritalStatusCode) ?>', 1);"><div id="elh_marital_status_MaritalStatusCode" class="marital_status_MaritalStatusCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $marital_status_list->MaritalStatusCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($marital_status_list->MaritalStatusCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($marital_status_list->MaritalStatusCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($marital_status_list->MaritalStatus->Visible) { // MaritalStatus ?>
	<?php if ($marital_status_list->SortUrl($marital_status_list->MaritalStatus) == "") { ?>
		<th data-name="MaritalStatus" class="<?php echo $marital_status_list->MaritalStatus->headerCellClass() ?>"><div id="elh_marital_status_MaritalStatus" class="marital_status_MaritalStatus"><div class="ew-table-header-caption"><?php echo $marital_status_list->MaritalStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaritalStatus" class="<?php echo $marital_status_list->MaritalStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $marital_status_list->SortUrl($marital_status_list->MaritalStatus) ?>', 1);"><div id="elh_marital_status_MaritalStatus" class="marital_status_MaritalStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $marital_status_list->MaritalStatus->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($marital_status_list->MaritalStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($marital_status_list->MaritalStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$marital_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($marital_status_list->isAdd() || $marital_status_list->isCopy()) {
		$marital_status_list->RowIndex = 0;
		$marital_status_list->KeyCount = $marital_status_list->RowIndex;
		if ($marital_status_list->isAdd())
			$marital_status_list->loadRowValues();
		if ($marital_status->EventCancelled) // Insert failed
			$marital_status_list->restoreFormValues(); // Restore form values

		// Set row properties
		$marital_status->resetAttributes();
		$marital_status->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_marital_status", "data-rowtype" => ROWTYPE_ADD]);
		$marital_status->RowType = ROWTYPE_ADD;

		// Render row
		$marital_status_list->renderRow();

		// Render list options
		$marital_status_list->renderListOptions();
		$marital_status_list->StartRowCount = 0;
?>
	<tr <?php echo $marital_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$marital_status_list->ListOptions->render("body", "left", $marital_status_list->RowCount);
?>
	<?php if ($marital_status_list->MaritalStatusCode->Visible) { // MaritalStatusCode ?>
		<td data-name="MaritalStatusCode">
<span id="el<?php echo $marital_status_list->RowCount ?>_marital_status_MaritalStatusCode" class="form-group marital_status_MaritalStatusCode"></span>
<input type="hidden" data-table="marital_status" data-field="x_MaritalStatusCode" name="o<?php echo $marital_status_list->RowIndex ?>_MaritalStatusCode" id="o<?php echo $marital_status_list->RowIndex ?>_MaritalStatusCode" value="<?php echo HtmlEncode($marital_status_list->MaritalStatusCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($marital_status_list->MaritalStatus->Visible) { // MaritalStatus ?>
		<td data-name="MaritalStatus">
<span id="el<?php echo $marital_status_list->RowCount ?>_marital_status_MaritalStatus" class="form-group marital_status_MaritalStatus">
<input type="text" data-table="marital_status" data-field="x_MaritalStatus" name="x<?php echo $marital_status_list->RowIndex ?>_MaritalStatus" id="x<?php echo $marital_status_list->RowIndex ?>_MaritalStatus" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($marital_status_list->MaritalStatus->getPlaceHolder()) ?>" value="<?php echo $marital_status_list->MaritalStatus->EditValue ?>"<?php echo $marital_status_list->MaritalStatus->editAttributes() ?>>
</span>
<input type="hidden" data-table="marital_status" data-field="x_MaritalStatus" name="o<?php echo $marital_status_list->RowIndex ?>_MaritalStatus" id="o<?php echo $marital_status_list->RowIndex ?>_MaritalStatus" value="<?php echo HtmlEncode($marital_status_list->MaritalStatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$marital_status_list->ListOptions->render("body", "right", $marital_status_list->RowCount);
?>
<script>
loadjs.ready(["fmarital_statuslist", "load"], function() {
	fmarital_statuslist.updateLists(<?php echo $marital_status_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($marital_status_list->ExportAll && $marital_status_list->isExport()) {
	$marital_status_list->StopRecord = $marital_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($marital_status_list->TotalRecords > $marital_status_list->StartRecord + $marital_status_list->DisplayRecords - 1)
		$marital_status_list->StopRecord = $marital_status_list->StartRecord + $marital_status_list->DisplayRecords - 1;
	else
		$marital_status_list->StopRecord = $marital_status_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($marital_status->isConfirm() || $marital_status_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($marital_status_list->FormKeyCountName) && ($marital_status_list->isGridAdd() || $marital_status_list->isGridEdit() || $marital_status->isConfirm())) {
		$marital_status_list->KeyCount = $CurrentForm->getValue($marital_status_list->FormKeyCountName);
		$marital_status_list->StopRecord = $marital_status_list->StartRecord + $marital_status_list->KeyCount - 1;
	}
}
$marital_status_list->RecordCount = $marital_status_list->StartRecord - 1;
if ($marital_status_list->Recordset && !$marital_status_list->Recordset->EOF) {
	$marital_status_list->Recordset->moveFirst();
	$selectLimit = $marital_status_list->UseSelectLimit;
	if (!$selectLimit && $marital_status_list->StartRecord > 1)
		$marital_status_list->Recordset->move($marital_status_list->StartRecord - 1);
} elseif (!$marital_status->AllowAddDeleteRow && $marital_status_list->StopRecord == 0) {
	$marital_status_list->StopRecord = $marital_status->GridAddRowCount;
}

// Initialize aggregate
$marital_status->RowType = ROWTYPE_AGGREGATEINIT;
$marital_status->resetAttributes();
$marital_status_list->renderRow();
$marital_status_list->EditRowCount = 0;
if ($marital_status_list->isEdit())
	$marital_status_list->RowIndex = 1;
while ($marital_status_list->RecordCount < $marital_status_list->StopRecord) {
	$marital_status_list->RecordCount++;
	if ($marital_status_list->RecordCount >= $marital_status_list->StartRecord) {
		$marital_status_list->RowCount++;

		// Set up key count
		$marital_status_list->KeyCount = $marital_status_list->RowIndex;

		// Init row class and style
		$marital_status->resetAttributes();
		$marital_status->CssClass = "";
		if ($marital_status_list->isGridAdd()) {
			$marital_status_list->loadRowValues(); // Load default values
		} else {
			$marital_status_list->loadRowValues($marital_status_list->Recordset); // Load row values
		}
		$marital_status->RowType = ROWTYPE_VIEW; // Render view
		if ($marital_status_list->isEdit()) {
			if ($marital_status_list->checkInlineEditKey() && $marital_status_list->EditRowCount == 0) { // Inline edit
				$marital_status->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($marital_status_list->isEdit() && $marital_status->RowType == ROWTYPE_EDIT && $marital_status->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$marital_status_list->restoreFormValues(); // Restore form values
		}
		if ($marital_status->RowType == ROWTYPE_EDIT) // Edit row
			$marital_status_list->EditRowCount++;

		// Set up row id / data-rowindex
		$marital_status->RowAttrs->merge(["data-rowindex" => $marital_status_list->RowCount, "id" => "r" . $marital_status_list->RowCount . "_marital_status", "data-rowtype" => $marital_status->RowType]);

		// Render row
		$marital_status_list->renderRow();

		// Render list options
		$marital_status_list->renderListOptions();
?>
	<tr <?php echo $marital_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$marital_status_list->ListOptions->render("body", "left", $marital_status_list->RowCount);
?>
	<?php if ($marital_status_list->MaritalStatusCode->Visible) { // MaritalStatusCode ?>
		<td data-name="MaritalStatusCode" <?php echo $marital_status_list->MaritalStatusCode->cellAttributes() ?>>
<?php if ($marital_status->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $marital_status_list->RowCount ?>_marital_status_MaritalStatusCode" class="form-group">
<span<?php echo $marital_status_list->MaritalStatusCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($marital_status_list->MaritalStatusCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="marital_status" data-field="x_MaritalStatusCode" name="x<?php echo $marital_status_list->RowIndex ?>_MaritalStatusCode" id="x<?php echo $marital_status_list->RowIndex ?>_MaritalStatusCode" value="<?php echo HtmlEncode($marital_status_list->MaritalStatusCode->CurrentValue) ?>">
<?php } ?>
<?php if ($marital_status->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $marital_status_list->RowCount ?>_marital_status_MaritalStatusCode">
<span<?php echo $marital_status_list->MaritalStatusCode->viewAttributes() ?>><?php echo $marital_status_list->MaritalStatusCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($marital_status_list->MaritalStatus->Visible) { // MaritalStatus ?>
		<td data-name="MaritalStatus" <?php echo $marital_status_list->MaritalStatus->cellAttributes() ?>>
<?php if ($marital_status->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $marital_status_list->RowCount ?>_marital_status_MaritalStatus" class="form-group">
<input type="text" data-table="marital_status" data-field="x_MaritalStatus" name="x<?php echo $marital_status_list->RowIndex ?>_MaritalStatus" id="x<?php echo $marital_status_list->RowIndex ?>_MaritalStatus" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($marital_status_list->MaritalStatus->getPlaceHolder()) ?>" value="<?php echo $marital_status_list->MaritalStatus->EditValue ?>"<?php echo $marital_status_list->MaritalStatus->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($marital_status->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $marital_status_list->RowCount ?>_marital_status_MaritalStatus">
<span<?php echo $marital_status_list->MaritalStatus->viewAttributes() ?>><?php echo $marital_status_list->MaritalStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$marital_status_list->ListOptions->render("body", "right", $marital_status_list->RowCount);
?>
	</tr>
<?php if ($marital_status->RowType == ROWTYPE_ADD || $marital_status->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fmarital_statuslist", "load"], function() {
	fmarital_statuslist.updateLists(<?php echo $marital_status_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	if (!$marital_status_list->isGridAdd())
		$marital_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($marital_status_list->isAdd() || $marital_status_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $marital_status_list->FormKeyCountName ?>" id="<?php echo $marital_status_list->FormKeyCountName ?>" value="<?php echo $marital_status_list->KeyCount ?>">
<?php } ?>
<?php if ($marital_status_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $marital_status_list->FormKeyCountName ?>" id="<?php echo $marital_status_list->FormKeyCountName ?>" value="<?php echo $marital_status_list->KeyCount ?>">
<?php } ?>
<?php if (!$marital_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($marital_status_list->Recordset)
	$marital_status_list->Recordset->Close();
?>
<?php if (!$marital_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$marital_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $marital_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $marital_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($marital_status_list->TotalRecords == 0 && !$marital_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $marital_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$marital_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$marital_status_list->isExport()) { ?>
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
$marital_status_list->terminate();
?>