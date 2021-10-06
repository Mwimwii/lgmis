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
$job_group_list = new job_group_list();

// Run the page
$job_group_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$job_group_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$job_group_list->isExport()) { ?>
<script>
var fjob_grouplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fjob_grouplist = currentForm = new ew.Form("fjob_grouplist", "list");
	fjob_grouplist.formKeyCountName = '<?php echo $job_group_list->FormKeyCountName ?>';

	// Validate form
	fjob_grouplist.validate = function() {
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
			<?php if ($job_group_list->JobGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_JobGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_group_list->JobGroupCode->caption(), $job_group_list->JobGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($job_group_list->JobGroupName->Required) { ?>
				elm = this.getElements("x" + infix + "_JobGroupName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_group_list->JobGroupName->caption(), $job_group_list->JobGroupName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($job_group_list->JobGroupDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_JobGroupDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_group_list->JobGroupDesc->caption(), $job_group_list->JobGroupDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($job_group_list->LastUserID->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUserID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_group_list->LastUserID->caption(), $job_group_list->LastUserID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($job_group_list->LastUpdated->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $job_group_list->LastUpdated->caption(), $job_group_list->LastUpdated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdated");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($job_group_list->LastUpdated->errorMessage()) ?>");

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
	fjob_grouplist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "JobGroupCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "JobGroupName", false)) return false;
		if (ew.valueChanged(fobj, infix, "JobGroupDesc", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastUserID", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastUpdated", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fjob_grouplist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fjob_grouplist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fjob_grouplist");
});
var fjob_grouplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fjob_grouplistsrch = currentSearchForm = new ew.Form("fjob_grouplistsrch");

	// Dynamic selection lists
	// Filters

	fjob_grouplistsrch.filterList = <?php echo $job_group_list->getFilterList() ?>;

	// Init search panel as collapsed
	fjob_grouplistsrch.initSearchPanel = true;
	loadjs.done("fjob_grouplistsrch");
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
<?php if (!$job_group_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($job_group_list->TotalRecords > 0 && $job_group_list->ExportOptions->visible()) { ?>
<?php $job_group_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($job_group_list->ImportOptions->visible()) { ?>
<?php $job_group_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($job_group_list->SearchOptions->visible()) { ?>
<?php $job_group_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($job_group_list->FilterOptions->visible()) { ?>
<?php $job_group_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$job_group_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$job_group_list->isExport() && !$job_group->CurrentAction) { ?>
<form name="fjob_grouplistsrch" id="fjob_grouplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fjob_grouplistsrch-search-panel" class="<?php echo $job_group_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="job_group">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $job_group_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($job_group_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($job_group_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $job_group_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($job_group_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($job_group_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($job_group_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($job_group_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $job_group_list->showPageHeader(); ?>
<?php
$job_group_list->showMessage();
?>
<?php if ($job_group_list->TotalRecords > 0 || $job_group->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($job_group_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> job_group">
<?php if (!$job_group_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$job_group_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $job_group_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $job_group_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fjob_grouplist" id="fjob_grouplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="job_group">
<div id="gmp_job_group" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($job_group_list->TotalRecords > 0 || $job_group_list->isGridEdit()) { ?>
<table id="tbl_job_grouplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$job_group->RowType = ROWTYPE_HEADER;

// Render list options
$job_group_list->renderListOptions();

// Render list options (header, left)
$job_group_list->ListOptions->render("header", "left");
?>
<?php if ($job_group_list->JobGroupCode->Visible) { // JobGroupCode ?>
	<?php if ($job_group_list->SortUrl($job_group_list->JobGroupCode) == "") { ?>
		<th data-name="JobGroupCode" class="<?php echo $job_group_list->JobGroupCode->headerCellClass() ?>"><div id="elh_job_group_JobGroupCode" class="job_group_JobGroupCode"><div class="ew-table-header-caption"><?php echo $job_group_list->JobGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobGroupCode" class="<?php echo $job_group_list->JobGroupCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $job_group_list->SortUrl($job_group_list->JobGroupCode) ?>', 1);"><div id="elh_job_group_JobGroupCode" class="job_group_JobGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_group_list->JobGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_group_list->JobGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_group_list->JobGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_group_list->JobGroupName->Visible) { // JobGroupName ?>
	<?php if ($job_group_list->SortUrl($job_group_list->JobGroupName) == "") { ?>
		<th data-name="JobGroupName" class="<?php echo $job_group_list->JobGroupName->headerCellClass() ?>"><div id="elh_job_group_JobGroupName" class="job_group_JobGroupName"><div class="ew-table-header-caption"><?php echo $job_group_list->JobGroupName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobGroupName" class="<?php echo $job_group_list->JobGroupName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $job_group_list->SortUrl($job_group_list->JobGroupName) ?>', 1);"><div id="elh_job_group_JobGroupName" class="job_group_JobGroupName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_group_list->JobGroupName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($job_group_list->JobGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_group_list->JobGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_group_list->JobGroupDesc->Visible) { // JobGroupDesc ?>
	<?php if ($job_group_list->SortUrl($job_group_list->JobGroupDesc) == "") { ?>
		<th data-name="JobGroupDesc" class="<?php echo $job_group_list->JobGroupDesc->headerCellClass() ?>"><div id="elh_job_group_JobGroupDesc" class="job_group_JobGroupDesc"><div class="ew-table-header-caption"><?php echo $job_group_list->JobGroupDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobGroupDesc" class="<?php echo $job_group_list->JobGroupDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $job_group_list->SortUrl($job_group_list->JobGroupDesc) ?>', 1);"><div id="elh_job_group_JobGroupDesc" class="job_group_JobGroupDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_group_list->JobGroupDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($job_group_list->JobGroupDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_group_list->JobGroupDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_group_list->LastUserID->Visible) { // LastUserID ?>
	<?php if ($job_group_list->SortUrl($job_group_list->LastUserID) == "") { ?>
		<th data-name="LastUserID" class="<?php echo $job_group_list->LastUserID->headerCellClass() ?>"><div id="elh_job_group_LastUserID" class="job_group_LastUserID"><div class="ew-table-header-caption"><?php echo $job_group_list->LastUserID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUserID" class="<?php echo $job_group_list->LastUserID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $job_group_list->SortUrl($job_group_list->LastUserID) ?>', 1);"><div id="elh_job_group_LastUserID" class="job_group_LastUserID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_group_list->LastUserID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($job_group_list->LastUserID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_group_list->LastUserID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($job_group_list->LastUpdated->Visible) { // LastUpdated ?>
	<?php if ($job_group_list->SortUrl($job_group_list->LastUpdated) == "") { ?>
		<th data-name="LastUpdated" class="<?php echo $job_group_list->LastUpdated->headerCellClass() ?>"><div id="elh_job_group_LastUpdated" class="job_group_LastUpdated"><div class="ew-table-header-caption"><?php echo $job_group_list->LastUpdated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdated" class="<?php echo $job_group_list->LastUpdated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $job_group_list->SortUrl($job_group_list->LastUpdated) ?>', 1);"><div id="elh_job_group_LastUpdated" class="job_group_LastUpdated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $job_group_list->LastUpdated->caption() ?></span><span class="ew-table-header-sort"><?php if ($job_group_list->LastUpdated->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($job_group_list->LastUpdated->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$job_group_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($job_group_list->ExportAll && $job_group_list->isExport()) {
	$job_group_list->StopRecord = $job_group_list->TotalRecords;
} else {

	// Set the last record to display
	if ($job_group_list->TotalRecords > $job_group_list->StartRecord + $job_group_list->DisplayRecords - 1)
		$job_group_list->StopRecord = $job_group_list->StartRecord + $job_group_list->DisplayRecords - 1;
	else
		$job_group_list->StopRecord = $job_group_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($job_group->isConfirm() || $job_group_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($job_group_list->FormKeyCountName) && ($job_group_list->isGridAdd() || $job_group_list->isGridEdit() || $job_group->isConfirm())) {
		$job_group_list->KeyCount = $CurrentForm->getValue($job_group_list->FormKeyCountName);
		$job_group_list->StopRecord = $job_group_list->StartRecord + $job_group_list->KeyCount - 1;
	}
}
$job_group_list->RecordCount = $job_group_list->StartRecord - 1;
if ($job_group_list->Recordset && !$job_group_list->Recordset->EOF) {
	$job_group_list->Recordset->moveFirst();
	$selectLimit = $job_group_list->UseSelectLimit;
	if (!$selectLimit && $job_group_list->StartRecord > 1)
		$job_group_list->Recordset->move($job_group_list->StartRecord - 1);
} elseif (!$job_group->AllowAddDeleteRow && $job_group_list->StopRecord == 0) {
	$job_group_list->StopRecord = $job_group->GridAddRowCount;
}

// Initialize aggregate
$job_group->RowType = ROWTYPE_AGGREGATEINIT;
$job_group->resetAttributes();
$job_group_list->renderRow();
if ($job_group_list->isGridAdd())
	$job_group_list->RowIndex = 0;
if ($job_group_list->isGridEdit())
	$job_group_list->RowIndex = 0;
while ($job_group_list->RecordCount < $job_group_list->StopRecord) {
	$job_group_list->RecordCount++;
	if ($job_group_list->RecordCount >= $job_group_list->StartRecord) {
		$job_group_list->RowCount++;
		if ($job_group_list->isGridAdd() || $job_group_list->isGridEdit() || $job_group->isConfirm()) {
			$job_group_list->RowIndex++;
			$CurrentForm->Index = $job_group_list->RowIndex;
			if ($CurrentForm->hasValue($job_group_list->FormActionName) && ($job_group->isConfirm() || $job_group_list->EventCancelled))
				$job_group_list->RowAction = strval($CurrentForm->getValue($job_group_list->FormActionName));
			elseif ($job_group_list->isGridAdd())
				$job_group_list->RowAction = "insert";
			else
				$job_group_list->RowAction = "";
		}

		// Set up key count
		$job_group_list->KeyCount = $job_group_list->RowIndex;

		// Init row class and style
		$job_group->resetAttributes();
		$job_group->CssClass = "";
		if ($job_group_list->isGridAdd()) {
			$job_group_list->loadRowValues(); // Load default values
		} else {
			$job_group_list->loadRowValues($job_group_list->Recordset); // Load row values
		}
		$job_group->RowType = ROWTYPE_VIEW; // Render view
		if ($job_group_list->isGridAdd()) // Grid add
			$job_group->RowType = ROWTYPE_ADD; // Render add
		if ($job_group_list->isGridAdd() && $job_group->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$job_group_list->restoreCurrentRowFormValues($job_group_list->RowIndex); // Restore form values
		if ($job_group_list->isGridEdit()) { // Grid edit
			if ($job_group->EventCancelled)
				$job_group_list->restoreCurrentRowFormValues($job_group_list->RowIndex); // Restore form values
			if ($job_group_list->RowAction == "insert")
				$job_group->RowType = ROWTYPE_ADD; // Render add
			else
				$job_group->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($job_group_list->isGridEdit() && ($job_group->RowType == ROWTYPE_EDIT || $job_group->RowType == ROWTYPE_ADD) && $job_group->EventCancelled) // Update failed
			$job_group_list->restoreCurrentRowFormValues($job_group_list->RowIndex); // Restore form values
		if ($job_group->RowType == ROWTYPE_EDIT) // Edit row
			$job_group_list->EditRowCount++;

		// Set up row id / data-rowindex
		$job_group->RowAttrs->merge(["data-rowindex" => $job_group_list->RowCount, "id" => "r" . $job_group_list->RowCount . "_job_group", "data-rowtype" => $job_group->RowType]);

		// Render row
		$job_group_list->renderRow();

		// Render list options
		$job_group_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($job_group_list->RowAction != "delete" && $job_group_list->RowAction != "insertdelete" && !($job_group_list->RowAction == "insert" && $job_group->isConfirm() && $job_group_list->emptyRow())) {
?>
	<tr <?php echo $job_group->rowAttributes() ?>>
<?php

// Render list options (body, left)
$job_group_list->ListOptions->render("body", "left", $job_group_list->RowCount);
?>
	<?php if ($job_group_list->JobGroupCode->Visible) { // JobGroupCode ?>
		<td data-name="JobGroupCode" <?php echo $job_group_list->JobGroupCode->cellAttributes() ?>>
<?php if ($job_group->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_JobGroupCode" class="form-group">
<input type="text" data-table="job_group" data-field="x_JobGroupCode" name="x<?php echo $job_group_list->RowIndex ?>_JobGroupCode" id="x<?php echo $job_group_list->RowIndex ?>_JobGroupCode" placeholder="<?php echo HtmlEncode($job_group_list->JobGroupCode->getPlaceHolder()) ?>" value="<?php echo $job_group_list->JobGroupCode->EditValue ?>"<?php echo $job_group_list->JobGroupCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="job_group" data-field="x_JobGroupCode" name="o<?php echo $job_group_list->RowIndex ?>_JobGroupCode" id="o<?php echo $job_group_list->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_group_list->JobGroupCode->OldValue) ?>">
<?php } ?>
<?php if ($job_group->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="job_group" data-field="x_JobGroupCode" name="x<?php echo $job_group_list->RowIndex ?>_JobGroupCode" id="x<?php echo $job_group_list->RowIndex ?>_JobGroupCode" placeholder="<?php echo HtmlEncode($job_group_list->JobGroupCode->getPlaceHolder()) ?>" value="<?php echo $job_group_list->JobGroupCode->EditValue ?>"<?php echo $job_group_list->JobGroupCode->editAttributes() ?>>
<input type="hidden" data-table="job_group" data-field="x_JobGroupCode" name="o<?php echo $job_group_list->RowIndex ?>_JobGroupCode" id="o<?php echo $job_group_list->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_group_list->JobGroupCode->OldValue != null ? $job_group_list->JobGroupCode->OldValue : $job_group_list->JobGroupCode->CurrentValue) ?>">
<?php } ?>
<?php if ($job_group->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_JobGroupCode">
<span<?php echo $job_group_list->JobGroupCode->viewAttributes() ?>><?php echo $job_group_list->JobGroupCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_group_list->JobGroupName->Visible) { // JobGroupName ?>
		<td data-name="JobGroupName" <?php echo $job_group_list->JobGroupName->cellAttributes() ?>>
<?php if ($job_group->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_JobGroupName" class="form-group">
<input type="text" data-table="job_group" data-field="x_JobGroupName" name="x<?php echo $job_group_list->RowIndex ?>_JobGroupName" id="x<?php echo $job_group_list->RowIndex ?>_JobGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_group_list->JobGroupName->getPlaceHolder()) ?>" value="<?php echo $job_group_list->JobGroupName->EditValue ?>"<?php echo $job_group_list->JobGroupName->editAttributes() ?>>
</span>
<input type="hidden" data-table="job_group" data-field="x_JobGroupName" name="o<?php echo $job_group_list->RowIndex ?>_JobGroupName" id="o<?php echo $job_group_list->RowIndex ?>_JobGroupName" value="<?php echo HtmlEncode($job_group_list->JobGroupName->OldValue) ?>">
<?php } ?>
<?php if ($job_group->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_JobGroupName" class="form-group">
<input type="text" data-table="job_group" data-field="x_JobGroupName" name="x<?php echo $job_group_list->RowIndex ?>_JobGroupName" id="x<?php echo $job_group_list->RowIndex ?>_JobGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_group_list->JobGroupName->getPlaceHolder()) ?>" value="<?php echo $job_group_list->JobGroupName->EditValue ?>"<?php echo $job_group_list->JobGroupName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($job_group->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_JobGroupName">
<span<?php echo $job_group_list->JobGroupName->viewAttributes() ?>><?php echo $job_group_list->JobGroupName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_group_list->JobGroupDesc->Visible) { // JobGroupDesc ?>
		<td data-name="JobGroupDesc" <?php echo $job_group_list->JobGroupDesc->cellAttributes() ?>>
<?php if ($job_group->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_JobGroupDesc" class="form-group">
<input type="text" data-table="job_group" data-field="x_JobGroupDesc" name="x<?php echo $job_group_list->RowIndex ?>_JobGroupDesc" id="x<?php echo $job_group_list->RowIndex ?>_JobGroupDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_group_list->JobGroupDesc->getPlaceHolder()) ?>" value="<?php echo $job_group_list->JobGroupDesc->EditValue ?>"<?php echo $job_group_list->JobGroupDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="job_group" data-field="x_JobGroupDesc" name="o<?php echo $job_group_list->RowIndex ?>_JobGroupDesc" id="o<?php echo $job_group_list->RowIndex ?>_JobGroupDesc" value="<?php echo HtmlEncode($job_group_list->JobGroupDesc->OldValue) ?>">
<?php } ?>
<?php if ($job_group->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_JobGroupDesc" class="form-group">
<input type="text" data-table="job_group" data-field="x_JobGroupDesc" name="x<?php echo $job_group_list->RowIndex ?>_JobGroupDesc" id="x<?php echo $job_group_list->RowIndex ?>_JobGroupDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_group_list->JobGroupDesc->getPlaceHolder()) ?>" value="<?php echo $job_group_list->JobGroupDesc->EditValue ?>"<?php echo $job_group_list->JobGroupDesc->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($job_group->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_JobGroupDesc">
<span<?php echo $job_group_list->JobGroupDesc->viewAttributes() ?>><?php echo $job_group_list->JobGroupDesc->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_group_list->LastUserID->Visible) { // LastUserID ?>
		<td data-name="LastUserID" <?php echo $job_group_list->LastUserID->cellAttributes() ?>>
<?php if ($job_group->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_LastUserID" class="form-group">
<input type="text" data-table="job_group" data-field="x_LastUserID" name="x<?php echo $job_group_list->RowIndex ?>_LastUserID" id="x<?php echo $job_group_list->RowIndex ?>_LastUserID" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($job_group_list->LastUserID->getPlaceHolder()) ?>" value="<?php echo $job_group_list->LastUserID->EditValue ?>"<?php echo $job_group_list->LastUserID->editAttributes() ?>>
</span>
<input type="hidden" data-table="job_group" data-field="x_LastUserID" name="o<?php echo $job_group_list->RowIndex ?>_LastUserID" id="o<?php echo $job_group_list->RowIndex ?>_LastUserID" value="<?php echo HtmlEncode($job_group_list->LastUserID->OldValue) ?>">
<?php } ?>
<?php if ($job_group->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_LastUserID" class="form-group">
<input type="text" data-table="job_group" data-field="x_LastUserID" name="x<?php echo $job_group_list->RowIndex ?>_LastUserID" id="x<?php echo $job_group_list->RowIndex ?>_LastUserID" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($job_group_list->LastUserID->getPlaceHolder()) ?>" value="<?php echo $job_group_list->LastUserID->EditValue ?>"<?php echo $job_group_list->LastUserID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($job_group->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_LastUserID">
<span<?php echo $job_group_list->LastUserID->viewAttributes() ?>><?php echo $job_group_list->LastUserID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($job_group_list->LastUpdated->Visible) { // LastUpdated ?>
		<td data-name="LastUpdated" <?php echo $job_group_list->LastUpdated->cellAttributes() ?>>
<?php if ($job_group->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_LastUpdated" class="form-group">
<input type="text" data-table="job_group" data-field="x_LastUpdated" name="x<?php echo $job_group_list->RowIndex ?>_LastUpdated" id="x<?php echo $job_group_list->RowIndex ?>_LastUpdated" placeholder="<?php echo HtmlEncode($job_group_list->LastUpdated->getPlaceHolder()) ?>" value="<?php echo $job_group_list->LastUpdated->EditValue ?>"<?php echo $job_group_list->LastUpdated->editAttributes() ?>>
</span>
<input type="hidden" data-table="job_group" data-field="x_LastUpdated" name="o<?php echo $job_group_list->RowIndex ?>_LastUpdated" id="o<?php echo $job_group_list->RowIndex ?>_LastUpdated" value="<?php echo HtmlEncode($job_group_list->LastUpdated->OldValue) ?>">
<?php } ?>
<?php if ($job_group->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_LastUpdated" class="form-group">
<input type="text" data-table="job_group" data-field="x_LastUpdated" name="x<?php echo $job_group_list->RowIndex ?>_LastUpdated" id="x<?php echo $job_group_list->RowIndex ?>_LastUpdated" placeholder="<?php echo HtmlEncode($job_group_list->LastUpdated->getPlaceHolder()) ?>" value="<?php echo $job_group_list->LastUpdated->EditValue ?>"<?php echo $job_group_list->LastUpdated->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($job_group->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $job_group_list->RowCount ?>_job_group_LastUpdated">
<span<?php echo $job_group_list->LastUpdated->viewAttributes() ?>><?php echo $job_group_list->LastUpdated->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$job_group_list->ListOptions->render("body", "right", $job_group_list->RowCount);
?>
	</tr>
<?php if ($job_group->RowType == ROWTYPE_ADD || $job_group->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fjob_grouplist", "load"], function() {
	fjob_grouplist.updateLists(<?php echo $job_group_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$job_group_list->isGridAdd())
		if (!$job_group_list->Recordset->EOF)
			$job_group_list->Recordset->moveNext();
}
?>
<?php
	if ($job_group_list->isGridAdd() || $job_group_list->isGridEdit()) {
		$job_group_list->RowIndex = '$rowindex$';
		$job_group_list->loadRowValues();

		// Set row properties
		$job_group->resetAttributes();
		$job_group->RowAttrs->merge(["data-rowindex" => $job_group_list->RowIndex, "id" => "r0_job_group", "data-rowtype" => ROWTYPE_ADD]);
		$job_group->RowAttrs->appendClass("ew-template");
		$job_group->RowType = ROWTYPE_ADD;

		// Render row
		$job_group_list->renderRow();

		// Render list options
		$job_group_list->renderListOptions();
		$job_group_list->StartRowCount = 0;
?>
	<tr <?php echo $job_group->rowAttributes() ?>>
<?php

// Render list options (body, left)
$job_group_list->ListOptions->render("body", "left", $job_group_list->RowIndex);
?>
	<?php if ($job_group_list->JobGroupCode->Visible) { // JobGroupCode ?>
		<td data-name="JobGroupCode">
<span id="el$rowindex$_job_group_JobGroupCode" class="form-group job_group_JobGroupCode">
<input type="text" data-table="job_group" data-field="x_JobGroupCode" name="x<?php echo $job_group_list->RowIndex ?>_JobGroupCode" id="x<?php echo $job_group_list->RowIndex ?>_JobGroupCode" placeholder="<?php echo HtmlEncode($job_group_list->JobGroupCode->getPlaceHolder()) ?>" value="<?php echo $job_group_list->JobGroupCode->EditValue ?>"<?php echo $job_group_list->JobGroupCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="job_group" data-field="x_JobGroupCode" name="o<?php echo $job_group_list->RowIndex ?>_JobGroupCode" id="o<?php echo $job_group_list->RowIndex ?>_JobGroupCode" value="<?php echo HtmlEncode($job_group_list->JobGroupCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_group_list->JobGroupName->Visible) { // JobGroupName ?>
		<td data-name="JobGroupName">
<span id="el$rowindex$_job_group_JobGroupName" class="form-group job_group_JobGroupName">
<input type="text" data-table="job_group" data-field="x_JobGroupName" name="x<?php echo $job_group_list->RowIndex ?>_JobGroupName" id="x<?php echo $job_group_list->RowIndex ?>_JobGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_group_list->JobGroupName->getPlaceHolder()) ?>" value="<?php echo $job_group_list->JobGroupName->EditValue ?>"<?php echo $job_group_list->JobGroupName->editAttributes() ?>>
</span>
<input type="hidden" data-table="job_group" data-field="x_JobGroupName" name="o<?php echo $job_group_list->RowIndex ?>_JobGroupName" id="o<?php echo $job_group_list->RowIndex ?>_JobGroupName" value="<?php echo HtmlEncode($job_group_list->JobGroupName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_group_list->JobGroupDesc->Visible) { // JobGroupDesc ?>
		<td data-name="JobGroupDesc">
<span id="el$rowindex$_job_group_JobGroupDesc" class="form-group job_group_JobGroupDesc">
<input type="text" data-table="job_group" data-field="x_JobGroupDesc" name="x<?php echo $job_group_list->RowIndex ?>_JobGroupDesc" id="x<?php echo $job_group_list->RowIndex ?>_JobGroupDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($job_group_list->JobGroupDesc->getPlaceHolder()) ?>" value="<?php echo $job_group_list->JobGroupDesc->EditValue ?>"<?php echo $job_group_list->JobGroupDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="job_group" data-field="x_JobGroupDesc" name="o<?php echo $job_group_list->RowIndex ?>_JobGroupDesc" id="o<?php echo $job_group_list->RowIndex ?>_JobGroupDesc" value="<?php echo HtmlEncode($job_group_list->JobGroupDesc->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_group_list->LastUserID->Visible) { // LastUserID ?>
		<td data-name="LastUserID">
<span id="el$rowindex$_job_group_LastUserID" class="form-group job_group_LastUserID">
<input type="text" data-table="job_group" data-field="x_LastUserID" name="x<?php echo $job_group_list->RowIndex ?>_LastUserID" id="x<?php echo $job_group_list->RowIndex ?>_LastUserID" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($job_group_list->LastUserID->getPlaceHolder()) ?>" value="<?php echo $job_group_list->LastUserID->EditValue ?>"<?php echo $job_group_list->LastUserID->editAttributes() ?>>
</span>
<input type="hidden" data-table="job_group" data-field="x_LastUserID" name="o<?php echo $job_group_list->RowIndex ?>_LastUserID" id="o<?php echo $job_group_list->RowIndex ?>_LastUserID" value="<?php echo HtmlEncode($job_group_list->LastUserID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($job_group_list->LastUpdated->Visible) { // LastUpdated ?>
		<td data-name="LastUpdated">
<span id="el$rowindex$_job_group_LastUpdated" class="form-group job_group_LastUpdated">
<input type="text" data-table="job_group" data-field="x_LastUpdated" name="x<?php echo $job_group_list->RowIndex ?>_LastUpdated" id="x<?php echo $job_group_list->RowIndex ?>_LastUpdated" placeholder="<?php echo HtmlEncode($job_group_list->LastUpdated->getPlaceHolder()) ?>" value="<?php echo $job_group_list->LastUpdated->EditValue ?>"<?php echo $job_group_list->LastUpdated->editAttributes() ?>>
</span>
<input type="hidden" data-table="job_group" data-field="x_LastUpdated" name="o<?php echo $job_group_list->RowIndex ?>_LastUpdated" id="o<?php echo $job_group_list->RowIndex ?>_LastUpdated" value="<?php echo HtmlEncode($job_group_list->LastUpdated->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$job_group_list->ListOptions->render("body", "right", $job_group_list->RowIndex);
?>
<script>
loadjs.ready(["fjob_grouplist", "load"], function() {
	fjob_grouplist.updateLists(<?php echo $job_group_list->RowIndex ?>);
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
<?php if ($job_group_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $job_group_list->FormKeyCountName ?>" id="<?php echo $job_group_list->FormKeyCountName ?>" value="<?php echo $job_group_list->KeyCount ?>">
<?php echo $job_group_list->MultiSelectKey ?>
<?php } ?>
<?php if ($job_group_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $job_group_list->FormKeyCountName ?>" id="<?php echo $job_group_list->FormKeyCountName ?>" value="<?php echo $job_group_list->KeyCount ?>">
<?php echo $job_group_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$job_group->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($job_group_list->Recordset)
	$job_group_list->Recordset->Close();
?>
<?php if (!$job_group_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$job_group_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $job_group_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $job_group_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($job_group_list->TotalRecords == 0 && !$job_group->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $job_group_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$job_group_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$job_group_list->isExport()) { ?>
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
$job_group_list->terminate();
?>