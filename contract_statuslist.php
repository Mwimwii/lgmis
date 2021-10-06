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
$contract_status_list = new contract_status_list();

// Run the page
$contract_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contract_status_list->isExport()) { ?>
<script>
var fcontract_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcontract_statuslist = currentForm = new ew.Form("fcontract_statuslist", "list");
	fcontract_statuslist.formKeyCountName = '<?php echo $contract_status_list->FormKeyCountName ?>';

	// Validate form
	fcontract_statuslist.validate = function() {
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
			<?php if ($contract_status_list->ContractStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_status_list->ContractStatus->caption(), $contract_status_list->ContractStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ContractStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_status_list->ContractStatus->errorMessage()) ?>");
			<?php if ($contract_status_list->ContractStatusDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractStatusDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_status_list->ContractStatusDesc->caption(), $contract_status_list->ContractStatusDesc->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	fcontract_statuslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ContractStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "ContractStatusDesc", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcontract_statuslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontract_statuslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcontract_statuslist");
});
var fcontract_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcontract_statuslistsrch = currentSearchForm = new ew.Form("fcontract_statuslistsrch");

	// Dynamic selection lists
	// Filters

	fcontract_statuslistsrch.filterList = <?php echo $contract_status_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcontract_statuslistsrch.initSearchPanel = true;
	loadjs.done("fcontract_statuslistsrch");
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
<?php if (!$contract_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contract_status_list->TotalRecords > 0 && $contract_status_list->ExportOptions->visible()) { ?>
<?php $contract_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contract_status_list->ImportOptions->visible()) { ?>
<?php $contract_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($contract_status_list->SearchOptions->visible()) { ?>
<?php $contract_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($contract_status_list->FilterOptions->visible()) { ?>
<?php $contract_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$contract_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$contract_status_list->isExport() && !$contract_status->CurrentAction) { ?>
<form name="fcontract_statuslistsrch" id="fcontract_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcontract_statuslistsrch-search-panel" class="<?php echo $contract_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="contract_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $contract_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($contract_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($contract_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $contract_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($contract_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($contract_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($contract_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($contract_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $contract_status_list->showPageHeader(); ?>
<?php
$contract_status_list->showMessage();
?>
<?php if ($contract_status_list->TotalRecords > 0 || $contract_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contract_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contract_status">
<?php if (!$contract_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$contract_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contract_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcontract_statuslist" id="fcontract_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_status">
<div id="gmp_contract_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($contract_status_list->TotalRecords > 0 || $contract_status_list->isGridEdit()) { ?>
<table id="tbl_contract_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contract_status->RowType = ROWTYPE_HEADER;

// Render list options
$contract_status_list->renderListOptions();

// Render list options (header, left)
$contract_status_list->ListOptions->render("header", "left");
?>
<?php if ($contract_status_list->ContractStatus->Visible) { // ContractStatus ?>
	<?php if ($contract_status_list->SortUrl($contract_status_list->ContractStatus) == "") { ?>
		<th data-name="ContractStatus" class="<?php echo $contract_status_list->ContractStatus->headerCellClass() ?>"><div id="elh_contract_status_ContractStatus" class="contract_status_ContractStatus"><div class="ew-table-header-caption"><?php echo $contract_status_list->ContractStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractStatus" class="<?php echo $contract_status_list->ContractStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_status_list->SortUrl($contract_status_list->ContractStatus) ?>', 1);"><div id="elh_contract_status_ContractStatus" class="contract_status_ContractStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_status_list->ContractStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_status_list->ContractStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_status_list->ContractStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_status_list->ContractStatusDesc->Visible) { // ContractStatusDesc ?>
	<?php if ($contract_status_list->SortUrl($contract_status_list->ContractStatusDesc) == "") { ?>
		<th data-name="ContractStatusDesc" class="<?php echo $contract_status_list->ContractStatusDesc->headerCellClass() ?>"><div id="elh_contract_status_ContractStatusDesc" class="contract_status_ContractStatusDesc"><div class="ew-table-header-caption"><?php echo $contract_status_list->ContractStatusDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractStatusDesc" class="<?php echo $contract_status_list->ContractStatusDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_status_list->SortUrl($contract_status_list->ContractStatusDesc) ?>', 1);"><div id="elh_contract_status_ContractStatusDesc" class="contract_status_ContractStatusDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_status_list->ContractStatusDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contract_status_list->ContractStatusDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_status_list->ContractStatusDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contract_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contract_status_list->ExportAll && $contract_status_list->isExport()) {
	$contract_status_list->StopRecord = $contract_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($contract_status_list->TotalRecords > $contract_status_list->StartRecord + $contract_status_list->DisplayRecords - 1)
		$contract_status_list->StopRecord = $contract_status_list->StartRecord + $contract_status_list->DisplayRecords - 1;
	else
		$contract_status_list->StopRecord = $contract_status_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($contract_status->isConfirm() || $contract_status_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($contract_status_list->FormKeyCountName) && ($contract_status_list->isGridAdd() || $contract_status_list->isGridEdit() || $contract_status->isConfirm())) {
		$contract_status_list->KeyCount = $CurrentForm->getValue($contract_status_list->FormKeyCountName);
		$contract_status_list->StopRecord = $contract_status_list->StartRecord + $contract_status_list->KeyCount - 1;
	}
}
$contract_status_list->RecordCount = $contract_status_list->StartRecord - 1;
if ($contract_status_list->Recordset && !$contract_status_list->Recordset->EOF) {
	$contract_status_list->Recordset->moveFirst();
	$selectLimit = $contract_status_list->UseSelectLimit;
	if (!$selectLimit && $contract_status_list->StartRecord > 1)
		$contract_status_list->Recordset->move($contract_status_list->StartRecord - 1);
} elseif (!$contract_status->AllowAddDeleteRow && $contract_status_list->StopRecord == 0) {
	$contract_status_list->StopRecord = $contract_status->GridAddRowCount;
}

// Initialize aggregate
$contract_status->RowType = ROWTYPE_AGGREGATEINIT;
$contract_status->resetAttributes();
$contract_status_list->renderRow();
if ($contract_status_list->isGridAdd())
	$contract_status_list->RowIndex = 0;
if ($contract_status_list->isGridEdit())
	$contract_status_list->RowIndex = 0;
while ($contract_status_list->RecordCount < $contract_status_list->StopRecord) {
	$contract_status_list->RecordCount++;
	if ($contract_status_list->RecordCount >= $contract_status_list->StartRecord) {
		$contract_status_list->RowCount++;
		if ($contract_status_list->isGridAdd() || $contract_status_list->isGridEdit() || $contract_status->isConfirm()) {
			$contract_status_list->RowIndex++;
			$CurrentForm->Index = $contract_status_list->RowIndex;
			if ($CurrentForm->hasValue($contract_status_list->FormActionName) && ($contract_status->isConfirm() || $contract_status_list->EventCancelled))
				$contract_status_list->RowAction = strval($CurrentForm->getValue($contract_status_list->FormActionName));
			elseif ($contract_status_list->isGridAdd())
				$contract_status_list->RowAction = "insert";
			else
				$contract_status_list->RowAction = "";
		}

		// Set up key count
		$contract_status_list->KeyCount = $contract_status_list->RowIndex;

		// Init row class and style
		$contract_status->resetAttributes();
		$contract_status->CssClass = "";
		if ($contract_status_list->isGridAdd()) {
			$contract_status_list->loadRowValues(); // Load default values
		} else {
			$contract_status_list->loadRowValues($contract_status_list->Recordset); // Load row values
		}
		$contract_status->RowType = ROWTYPE_VIEW; // Render view
		if ($contract_status_list->isGridAdd()) // Grid add
			$contract_status->RowType = ROWTYPE_ADD; // Render add
		if ($contract_status_list->isGridAdd() && $contract_status->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$contract_status_list->restoreCurrentRowFormValues($contract_status_list->RowIndex); // Restore form values
		if ($contract_status_list->isGridEdit()) { // Grid edit
			if ($contract_status->EventCancelled)
				$contract_status_list->restoreCurrentRowFormValues($contract_status_list->RowIndex); // Restore form values
			if ($contract_status_list->RowAction == "insert")
				$contract_status->RowType = ROWTYPE_ADD; // Render add
			else
				$contract_status->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($contract_status_list->isGridEdit() && ($contract_status->RowType == ROWTYPE_EDIT || $contract_status->RowType == ROWTYPE_ADD) && $contract_status->EventCancelled) // Update failed
			$contract_status_list->restoreCurrentRowFormValues($contract_status_list->RowIndex); // Restore form values
		if ($contract_status->RowType == ROWTYPE_EDIT) // Edit row
			$contract_status_list->EditRowCount++;

		// Set up row id / data-rowindex
		$contract_status->RowAttrs->merge(["data-rowindex" => $contract_status_list->RowCount, "id" => "r" . $contract_status_list->RowCount . "_contract_status", "data-rowtype" => $contract_status->RowType]);

		// Render row
		$contract_status_list->renderRow();

		// Render list options
		$contract_status_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($contract_status_list->RowAction != "delete" && $contract_status_list->RowAction != "insertdelete" && !($contract_status_list->RowAction == "insert" && $contract_status->isConfirm() && $contract_status_list->emptyRow())) {
?>
	<tr <?php echo $contract_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contract_status_list->ListOptions->render("body", "left", $contract_status_list->RowCount);
?>
	<?php if ($contract_status_list->ContractStatus->Visible) { // ContractStatus ?>
		<td data-name="ContractStatus" <?php echo $contract_status_list->ContractStatus->cellAttributes() ?>>
<?php if ($contract_status->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $contract_status_list->RowCount ?>_contract_status_ContractStatus" class="form-group">
<input type="text" data-table="contract_status" data-field="x_ContractStatus" name="x<?php echo $contract_status_list->RowIndex ?>_ContractStatus" id="x<?php echo $contract_status_list->RowIndex ?>_ContractStatus" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($contract_status_list->ContractStatus->getPlaceHolder()) ?>" value="<?php echo $contract_status_list->ContractStatus->EditValue ?>"<?php echo $contract_status_list->ContractStatus->editAttributes() ?>>
</span>
<input type="hidden" data-table="contract_status" data-field="x_ContractStatus" name="o<?php echo $contract_status_list->RowIndex ?>_ContractStatus" id="o<?php echo $contract_status_list->RowIndex ?>_ContractStatus" value="<?php echo HtmlEncode($contract_status_list->ContractStatus->OldValue) ?>">
<?php } ?>
<?php if ($contract_status->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="contract_status" data-field="x_ContractStatus" name="x<?php echo $contract_status_list->RowIndex ?>_ContractStatus" id="x<?php echo $contract_status_list->RowIndex ?>_ContractStatus" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($contract_status_list->ContractStatus->getPlaceHolder()) ?>" value="<?php echo $contract_status_list->ContractStatus->EditValue ?>"<?php echo $contract_status_list->ContractStatus->editAttributes() ?>>
<input type="hidden" data-table="contract_status" data-field="x_ContractStatus" name="o<?php echo $contract_status_list->RowIndex ?>_ContractStatus" id="o<?php echo $contract_status_list->RowIndex ?>_ContractStatus" value="<?php echo HtmlEncode($contract_status_list->ContractStatus->OldValue != null ? $contract_status_list->ContractStatus->OldValue : $contract_status_list->ContractStatus->CurrentValue) ?>">
<?php } ?>
<?php if ($contract_status->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $contract_status_list->RowCount ?>_contract_status_ContractStatus">
<span<?php echo $contract_status_list->ContractStatus->viewAttributes() ?>><?php echo $contract_status_list->ContractStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contract_status_list->ContractStatusDesc->Visible) { // ContractStatusDesc ?>
		<td data-name="ContractStatusDesc" <?php echo $contract_status_list->ContractStatusDesc->cellAttributes() ?>>
<?php if ($contract_status->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $contract_status_list->RowCount ?>_contract_status_ContractStatusDesc" class="form-group">
<input type="text" data-table="contract_status" data-field="x_ContractStatusDesc" name="x<?php echo $contract_status_list->RowIndex ?>_ContractStatusDesc" id="x<?php echo $contract_status_list->RowIndex ?>_ContractStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contract_status_list->ContractStatusDesc->getPlaceHolder()) ?>" value="<?php echo $contract_status_list->ContractStatusDesc->EditValue ?>"<?php echo $contract_status_list->ContractStatusDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="contract_status" data-field="x_ContractStatusDesc" name="o<?php echo $contract_status_list->RowIndex ?>_ContractStatusDesc" id="o<?php echo $contract_status_list->RowIndex ?>_ContractStatusDesc" value="<?php echo HtmlEncode($contract_status_list->ContractStatusDesc->OldValue) ?>">
<?php } ?>
<?php if ($contract_status->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $contract_status_list->RowCount ?>_contract_status_ContractStatusDesc" class="form-group">
<input type="text" data-table="contract_status" data-field="x_ContractStatusDesc" name="x<?php echo $contract_status_list->RowIndex ?>_ContractStatusDesc" id="x<?php echo $contract_status_list->RowIndex ?>_ContractStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contract_status_list->ContractStatusDesc->getPlaceHolder()) ?>" value="<?php echo $contract_status_list->ContractStatusDesc->EditValue ?>"<?php echo $contract_status_list->ContractStatusDesc->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($contract_status->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $contract_status_list->RowCount ?>_contract_status_ContractStatusDesc">
<span<?php echo $contract_status_list->ContractStatusDesc->viewAttributes() ?>><?php echo $contract_status_list->ContractStatusDesc->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contract_status_list->ListOptions->render("body", "right", $contract_status_list->RowCount);
?>
	</tr>
<?php if ($contract_status->RowType == ROWTYPE_ADD || $contract_status->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcontract_statuslist", "load"], function() {
	fcontract_statuslist.updateLists(<?php echo $contract_status_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$contract_status_list->isGridAdd())
		if (!$contract_status_list->Recordset->EOF)
			$contract_status_list->Recordset->moveNext();
}
?>
<?php
	if ($contract_status_list->isGridAdd() || $contract_status_list->isGridEdit()) {
		$contract_status_list->RowIndex = '$rowindex$';
		$contract_status_list->loadRowValues();

		// Set row properties
		$contract_status->resetAttributes();
		$contract_status->RowAttrs->merge(["data-rowindex" => $contract_status_list->RowIndex, "id" => "r0_contract_status", "data-rowtype" => ROWTYPE_ADD]);
		$contract_status->RowAttrs->appendClass("ew-template");
		$contract_status->RowType = ROWTYPE_ADD;

		// Render row
		$contract_status_list->renderRow();

		// Render list options
		$contract_status_list->renderListOptions();
		$contract_status_list->StartRowCount = 0;
?>
	<tr <?php echo $contract_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contract_status_list->ListOptions->render("body", "left", $contract_status_list->RowIndex);
?>
	<?php if ($contract_status_list->ContractStatus->Visible) { // ContractStatus ?>
		<td data-name="ContractStatus">
<span id="el$rowindex$_contract_status_ContractStatus" class="form-group contract_status_ContractStatus">
<input type="text" data-table="contract_status" data-field="x_ContractStatus" name="x<?php echo $contract_status_list->RowIndex ?>_ContractStatus" id="x<?php echo $contract_status_list->RowIndex ?>_ContractStatus" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($contract_status_list->ContractStatus->getPlaceHolder()) ?>" value="<?php echo $contract_status_list->ContractStatus->EditValue ?>"<?php echo $contract_status_list->ContractStatus->editAttributes() ?>>
</span>
<input type="hidden" data-table="contract_status" data-field="x_ContractStatus" name="o<?php echo $contract_status_list->RowIndex ?>_ContractStatus" id="o<?php echo $contract_status_list->RowIndex ?>_ContractStatus" value="<?php echo HtmlEncode($contract_status_list->ContractStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($contract_status_list->ContractStatusDesc->Visible) { // ContractStatusDesc ?>
		<td data-name="ContractStatusDesc">
<span id="el$rowindex$_contract_status_ContractStatusDesc" class="form-group contract_status_ContractStatusDesc">
<input type="text" data-table="contract_status" data-field="x_ContractStatusDesc" name="x<?php echo $contract_status_list->RowIndex ?>_ContractStatusDesc" id="x<?php echo $contract_status_list->RowIndex ?>_ContractStatusDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contract_status_list->ContractStatusDesc->getPlaceHolder()) ?>" value="<?php echo $contract_status_list->ContractStatusDesc->EditValue ?>"<?php echo $contract_status_list->ContractStatusDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="contract_status" data-field="x_ContractStatusDesc" name="o<?php echo $contract_status_list->RowIndex ?>_ContractStatusDesc" id="o<?php echo $contract_status_list->RowIndex ?>_ContractStatusDesc" value="<?php echo HtmlEncode($contract_status_list->ContractStatusDesc->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contract_status_list->ListOptions->render("body", "right", $contract_status_list->RowIndex);
?>
<script>
loadjs.ready(["fcontract_statuslist", "load"], function() {
	fcontract_statuslist.updateLists(<?php echo $contract_status_list->RowIndex ?>);
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
<?php if ($contract_status_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $contract_status_list->FormKeyCountName ?>" id="<?php echo $contract_status_list->FormKeyCountName ?>" value="<?php echo $contract_status_list->KeyCount ?>">
<?php echo $contract_status_list->MultiSelectKey ?>
<?php } ?>
<?php if ($contract_status_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $contract_status_list->FormKeyCountName ?>" id="<?php echo $contract_status_list->FormKeyCountName ?>" value="<?php echo $contract_status_list->KeyCount ?>">
<?php echo $contract_status_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$contract_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contract_status_list->Recordset)
	$contract_status_list->Recordset->Close();
?>
<?php if (!$contract_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contract_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contract_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contract_status_list->TotalRecords == 0 && !$contract_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contract_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contract_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contract_status_list->isExport()) { ?>
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
$contract_status_list->terminate();
?>