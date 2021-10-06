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
$contract_type_list = new contract_type_list();

// Run the page
$contract_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contract_type_list->isExport()) { ?>
<script>
var fcontract_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcontract_typelist = currentForm = new ew.Form("fcontract_typelist", "list");
	fcontract_typelist.formKeyCountName = '<?php echo $contract_type_list->FormKeyCountName ?>';

	// Validate form
	fcontract_typelist.validate = function() {
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
			<?php if ($contract_type_list->ContractType->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_type_list->ContractType->caption(), $contract_type_list->ContractType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ContractType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($contract_type_list->ContractType->errorMessage()) ?>");
			<?php if ($contract_type_list->ContractTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $contract_type_list->ContractTypeDesc->caption(), $contract_type_list->ContractTypeDesc->RequiredErrorMessage)) ?>");
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
	fcontract_typelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ContractType", false)) return false;
		if (ew.valueChanged(fobj, infix, "ContractTypeDesc", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcontract_typelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcontract_typelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcontract_typelist");
});
var fcontract_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcontract_typelistsrch = currentSearchForm = new ew.Form("fcontract_typelistsrch");

	// Dynamic selection lists
	// Filters

	fcontract_typelistsrch.filterList = <?php echo $contract_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcontract_typelistsrch.initSearchPanel = true;
	loadjs.done("fcontract_typelistsrch");
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
<?php if (!$contract_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contract_type_list->TotalRecords > 0 && $contract_type_list->ExportOptions->visible()) { ?>
<?php $contract_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contract_type_list->ImportOptions->visible()) { ?>
<?php $contract_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($contract_type_list->SearchOptions->visible()) { ?>
<?php $contract_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($contract_type_list->FilterOptions->visible()) { ?>
<?php $contract_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$contract_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$contract_type_list->isExport() && !$contract_type->CurrentAction) { ?>
<form name="fcontract_typelistsrch" id="fcontract_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcontract_typelistsrch-search-panel" class="<?php echo $contract_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="contract_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $contract_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($contract_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($contract_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $contract_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($contract_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($contract_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($contract_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($contract_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $contract_type_list->showPageHeader(); ?>
<?php
$contract_type_list->showMessage();
?>
<?php if ($contract_type_list->TotalRecords > 0 || $contract_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contract_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contract_type">
<?php if (!$contract_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$contract_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contract_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcontract_typelist" id="fcontract_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_type">
<div id="gmp_contract_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($contract_type_list->TotalRecords > 0 || $contract_type_list->isGridEdit()) { ?>
<table id="tbl_contract_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contract_type->RowType = ROWTYPE_HEADER;

// Render list options
$contract_type_list->renderListOptions();

// Render list options (header, left)
$contract_type_list->ListOptions->render("header", "left");
?>
<?php if ($contract_type_list->ContractType->Visible) { // ContractType ?>
	<?php if ($contract_type_list->SortUrl($contract_type_list->ContractType) == "") { ?>
		<th data-name="ContractType" class="<?php echo $contract_type_list->ContractType->headerCellClass() ?>"><div id="elh_contract_type_ContractType" class="contract_type_ContractType"><div class="ew-table-header-caption"><?php echo $contract_type_list->ContractType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractType" class="<?php echo $contract_type_list->ContractType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_type_list->SortUrl($contract_type_list->ContractType) ?>', 1);"><div id="elh_contract_type_ContractType" class="contract_type_ContractType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_type_list->ContractType->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_type_list->ContractType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_type_list->ContractType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_type_list->ContractTypeDesc->Visible) { // ContractTypeDesc ?>
	<?php if ($contract_type_list->SortUrl($contract_type_list->ContractTypeDesc) == "") { ?>
		<th data-name="ContractTypeDesc" class="<?php echo $contract_type_list->ContractTypeDesc->headerCellClass() ?>"><div id="elh_contract_type_ContractTypeDesc" class="contract_type_ContractTypeDesc"><div class="ew-table-header-caption"><?php echo $contract_type_list->ContractTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractTypeDesc" class="<?php echo $contract_type_list->ContractTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_type_list->SortUrl($contract_type_list->ContractTypeDesc) ?>', 1);"><div id="elh_contract_type_ContractTypeDesc" class="contract_type_ContractTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_type_list->ContractTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contract_type_list->ContractTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_type_list->ContractTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contract_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contract_type_list->ExportAll && $contract_type_list->isExport()) {
	$contract_type_list->StopRecord = $contract_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($contract_type_list->TotalRecords > $contract_type_list->StartRecord + $contract_type_list->DisplayRecords - 1)
		$contract_type_list->StopRecord = $contract_type_list->StartRecord + $contract_type_list->DisplayRecords - 1;
	else
		$contract_type_list->StopRecord = $contract_type_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($contract_type->isConfirm() || $contract_type_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($contract_type_list->FormKeyCountName) && ($contract_type_list->isGridAdd() || $contract_type_list->isGridEdit() || $contract_type->isConfirm())) {
		$contract_type_list->KeyCount = $CurrentForm->getValue($contract_type_list->FormKeyCountName);
		$contract_type_list->StopRecord = $contract_type_list->StartRecord + $contract_type_list->KeyCount - 1;
	}
}
$contract_type_list->RecordCount = $contract_type_list->StartRecord - 1;
if ($contract_type_list->Recordset && !$contract_type_list->Recordset->EOF) {
	$contract_type_list->Recordset->moveFirst();
	$selectLimit = $contract_type_list->UseSelectLimit;
	if (!$selectLimit && $contract_type_list->StartRecord > 1)
		$contract_type_list->Recordset->move($contract_type_list->StartRecord - 1);
} elseif (!$contract_type->AllowAddDeleteRow && $contract_type_list->StopRecord == 0) {
	$contract_type_list->StopRecord = $contract_type->GridAddRowCount;
}

// Initialize aggregate
$contract_type->RowType = ROWTYPE_AGGREGATEINIT;
$contract_type->resetAttributes();
$contract_type_list->renderRow();
if ($contract_type_list->isGridAdd())
	$contract_type_list->RowIndex = 0;
if ($contract_type_list->isGridEdit())
	$contract_type_list->RowIndex = 0;
while ($contract_type_list->RecordCount < $contract_type_list->StopRecord) {
	$contract_type_list->RecordCount++;
	if ($contract_type_list->RecordCount >= $contract_type_list->StartRecord) {
		$contract_type_list->RowCount++;
		if ($contract_type_list->isGridAdd() || $contract_type_list->isGridEdit() || $contract_type->isConfirm()) {
			$contract_type_list->RowIndex++;
			$CurrentForm->Index = $contract_type_list->RowIndex;
			if ($CurrentForm->hasValue($contract_type_list->FormActionName) && ($contract_type->isConfirm() || $contract_type_list->EventCancelled))
				$contract_type_list->RowAction = strval($CurrentForm->getValue($contract_type_list->FormActionName));
			elseif ($contract_type_list->isGridAdd())
				$contract_type_list->RowAction = "insert";
			else
				$contract_type_list->RowAction = "";
		}

		// Set up key count
		$contract_type_list->KeyCount = $contract_type_list->RowIndex;

		// Init row class and style
		$contract_type->resetAttributes();
		$contract_type->CssClass = "";
		if ($contract_type_list->isGridAdd()) {
			$contract_type_list->loadRowValues(); // Load default values
		} else {
			$contract_type_list->loadRowValues($contract_type_list->Recordset); // Load row values
		}
		$contract_type->RowType = ROWTYPE_VIEW; // Render view
		if ($contract_type_list->isGridAdd()) // Grid add
			$contract_type->RowType = ROWTYPE_ADD; // Render add
		if ($contract_type_list->isGridAdd() && $contract_type->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$contract_type_list->restoreCurrentRowFormValues($contract_type_list->RowIndex); // Restore form values
		if ($contract_type_list->isGridEdit()) { // Grid edit
			if ($contract_type->EventCancelled)
				$contract_type_list->restoreCurrentRowFormValues($contract_type_list->RowIndex); // Restore form values
			if ($contract_type_list->RowAction == "insert")
				$contract_type->RowType = ROWTYPE_ADD; // Render add
			else
				$contract_type->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($contract_type_list->isGridEdit() && ($contract_type->RowType == ROWTYPE_EDIT || $contract_type->RowType == ROWTYPE_ADD) && $contract_type->EventCancelled) // Update failed
			$contract_type_list->restoreCurrentRowFormValues($contract_type_list->RowIndex); // Restore form values
		if ($contract_type->RowType == ROWTYPE_EDIT) // Edit row
			$contract_type_list->EditRowCount++;

		// Set up row id / data-rowindex
		$contract_type->RowAttrs->merge(["data-rowindex" => $contract_type_list->RowCount, "id" => "r" . $contract_type_list->RowCount . "_contract_type", "data-rowtype" => $contract_type->RowType]);

		// Render row
		$contract_type_list->renderRow();

		// Render list options
		$contract_type_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($contract_type_list->RowAction != "delete" && $contract_type_list->RowAction != "insertdelete" && !($contract_type_list->RowAction == "insert" && $contract_type->isConfirm() && $contract_type_list->emptyRow())) {
?>
	<tr <?php echo $contract_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contract_type_list->ListOptions->render("body", "left", $contract_type_list->RowCount);
?>
	<?php if ($contract_type_list->ContractType->Visible) { // ContractType ?>
		<td data-name="ContractType" <?php echo $contract_type_list->ContractType->cellAttributes() ?>>
<?php if ($contract_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $contract_type_list->RowCount ?>_contract_type_ContractType" class="form-group">
<input type="text" data-table="contract_type" data-field="x_ContractType" name="x<?php echo $contract_type_list->RowIndex ?>_ContractType" id="x<?php echo $contract_type_list->RowIndex ?>_ContractType" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($contract_type_list->ContractType->getPlaceHolder()) ?>" value="<?php echo $contract_type_list->ContractType->EditValue ?>"<?php echo $contract_type_list->ContractType->editAttributes() ?>>
</span>
<input type="hidden" data-table="contract_type" data-field="x_ContractType" name="o<?php echo $contract_type_list->RowIndex ?>_ContractType" id="o<?php echo $contract_type_list->RowIndex ?>_ContractType" value="<?php echo HtmlEncode($contract_type_list->ContractType->OldValue) ?>">
<?php } ?>
<?php if ($contract_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="contract_type" data-field="x_ContractType" name="x<?php echo $contract_type_list->RowIndex ?>_ContractType" id="x<?php echo $contract_type_list->RowIndex ?>_ContractType" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($contract_type_list->ContractType->getPlaceHolder()) ?>" value="<?php echo $contract_type_list->ContractType->EditValue ?>"<?php echo $contract_type_list->ContractType->editAttributes() ?>>
<input type="hidden" data-table="contract_type" data-field="x_ContractType" name="o<?php echo $contract_type_list->RowIndex ?>_ContractType" id="o<?php echo $contract_type_list->RowIndex ?>_ContractType" value="<?php echo HtmlEncode($contract_type_list->ContractType->OldValue != null ? $contract_type_list->ContractType->OldValue : $contract_type_list->ContractType->CurrentValue) ?>">
<?php } ?>
<?php if ($contract_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $contract_type_list->RowCount ?>_contract_type_ContractType">
<span<?php echo $contract_type_list->ContractType->viewAttributes() ?>><?php echo $contract_type_list->ContractType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($contract_type_list->ContractTypeDesc->Visible) { // ContractTypeDesc ?>
		<td data-name="ContractTypeDesc" <?php echo $contract_type_list->ContractTypeDesc->cellAttributes() ?>>
<?php if ($contract_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $contract_type_list->RowCount ?>_contract_type_ContractTypeDesc" class="form-group">
<input type="text" data-table="contract_type" data-field="x_ContractTypeDesc" name="x<?php echo $contract_type_list->RowIndex ?>_ContractTypeDesc" id="x<?php echo $contract_type_list->RowIndex ?>_ContractTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contract_type_list->ContractTypeDesc->getPlaceHolder()) ?>" value="<?php echo $contract_type_list->ContractTypeDesc->EditValue ?>"<?php echo $contract_type_list->ContractTypeDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="contract_type" data-field="x_ContractTypeDesc" name="o<?php echo $contract_type_list->RowIndex ?>_ContractTypeDesc" id="o<?php echo $contract_type_list->RowIndex ?>_ContractTypeDesc" value="<?php echo HtmlEncode($contract_type_list->ContractTypeDesc->OldValue) ?>">
<?php } ?>
<?php if ($contract_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $contract_type_list->RowCount ?>_contract_type_ContractTypeDesc" class="form-group">
<input type="text" data-table="contract_type" data-field="x_ContractTypeDesc" name="x<?php echo $contract_type_list->RowIndex ?>_ContractTypeDesc" id="x<?php echo $contract_type_list->RowIndex ?>_ContractTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contract_type_list->ContractTypeDesc->getPlaceHolder()) ?>" value="<?php echo $contract_type_list->ContractTypeDesc->EditValue ?>"<?php echo $contract_type_list->ContractTypeDesc->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($contract_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $contract_type_list->RowCount ?>_contract_type_ContractTypeDesc">
<span<?php echo $contract_type_list->ContractTypeDesc->viewAttributes() ?>><?php echo $contract_type_list->ContractTypeDesc->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contract_type_list->ListOptions->render("body", "right", $contract_type_list->RowCount);
?>
	</tr>
<?php if ($contract_type->RowType == ROWTYPE_ADD || $contract_type->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcontract_typelist", "load"], function() {
	fcontract_typelist.updateLists(<?php echo $contract_type_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$contract_type_list->isGridAdd())
		if (!$contract_type_list->Recordset->EOF)
			$contract_type_list->Recordset->moveNext();
}
?>
<?php
	if ($contract_type_list->isGridAdd() || $contract_type_list->isGridEdit()) {
		$contract_type_list->RowIndex = '$rowindex$';
		$contract_type_list->loadRowValues();

		// Set row properties
		$contract_type->resetAttributes();
		$contract_type->RowAttrs->merge(["data-rowindex" => $contract_type_list->RowIndex, "id" => "r0_contract_type", "data-rowtype" => ROWTYPE_ADD]);
		$contract_type->RowAttrs->appendClass("ew-template");
		$contract_type->RowType = ROWTYPE_ADD;

		// Render row
		$contract_type_list->renderRow();

		// Render list options
		$contract_type_list->renderListOptions();
		$contract_type_list->StartRowCount = 0;
?>
	<tr <?php echo $contract_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contract_type_list->ListOptions->render("body", "left", $contract_type_list->RowIndex);
?>
	<?php if ($contract_type_list->ContractType->Visible) { // ContractType ?>
		<td data-name="ContractType">
<span id="el$rowindex$_contract_type_ContractType" class="form-group contract_type_ContractType">
<input type="text" data-table="contract_type" data-field="x_ContractType" name="x<?php echo $contract_type_list->RowIndex ?>_ContractType" id="x<?php echo $contract_type_list->RowIndex ?>_ContractType" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($contract_type_list->ContractType->getPlaceHolder()) ?>" value="<?php echo $contract_type_list->ContractType->EditValue ?>"<?php echo $contract_type_list->ContractType->editAttributes() ?>>
</span>
<input type="hidden" data-table="contract_type" data-field="x_ContractType" name="o<?php echo $contract_type_list->RowIndex ?>_ContractType" id="o<?php echo $contract_type_list->RowIndex ?>_ContractType" value="<?php echo HtmlEncode($contract_type_list->ContractType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($contract_type_list->ContractTypeDesc->Visible) { // ContractTypeDesc ?>
		<td data-name="ContractTypeDesc">
<span id="el$rowindex$_contract_type_ContractTypeDesc" class="form-group contract_type_ContractTypeDesc">
<input type="text" data-table="contract_type" data-field="x_ContractTypeDesc" name="x<?php echo $contract_type_list->RowIndex ?>_ContractTypeDesc" id="x<?php echo $contract_type_list->RowIndex ?>_ContractTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($contract_type_list->ContractTypeDesc->getPlaceHolder()) ?>" value="<?php echo $contract_type_list->ContractTypeDesc->EditValue ?>"<?php echo $contract_type_list->ContractTypeDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="contract_type" data-field="x_ContractTypeDesc" name="o<?php echo $contract_type_list->RowIndex ?>_ContractTypeDesc" id="o<?php echo $contract_type_list->RowIndex ?>_ContractTypeDesc" value="<?php echo HtmlEncode($contract_type_list->ContractTypeDesc->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contract_type_list->ListOptions->render("body", "right", $contract_type_list->RowIndex);
?>
<script>
loadjs.ready(["fcontract_typelist", "load"], function() {
	fcontract_typelist.updateLists(<?php echo $contract_type_list->RowIndex ?>);
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
<?php if ($contract_type_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $contract_type_list->FormKeyCountName ?>" id="<?php echo $contract_type_list->FormKeyCountName ?>" value="<?php echo $contract_type_list->KeyCount ?>">
<?php echo $contract_type_list->MultiSelectKey ?>
<?php } ?>
<?php if ($contract_type_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $contract_type_list->FormKeyCountName ?>" id="<?php echo $contract_type_list->FormKeyCountName ?>" value="<?php echo $contract_type_list->KeyCount ?>">
<?php echo $contract_type_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$contract_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contract_type_list->Recordset)
	$contract_type_list->Recordset->Close();
?>
<?php if (!$contract_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contract_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contract_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contract_type_list->TotalRecords == 0 && !$contract_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contract_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contract_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contract_type_list->isExport()) { ?>
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
$contract_type_list->terminate();
?>