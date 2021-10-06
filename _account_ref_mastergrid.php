<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($_account_ref_master_grid))
	$_account_ref_master_grid = new _account_ref_master_grid();

// Run the page
$_account_ref_master_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_account_ref_master_grid->Page_Render();
?>
<?php if (!$_account_ref_master_grid->isExport()) { ?>
<script>
var f_account_ref_mastergrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	f_account_ref_mastergrid = new ew.Form("f_account_ref_mastergrid", "grid");
	f_account_ref_mastergrid.formKeyCountName = '<?php echo $_account_ref_master_grid->FormKeyCountName ?>';

	// Validate form
	f_account_ref_mastergrid.validate = function() {
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
			<?php if ($_account_ref_master_grid->AccountCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_grid->AccountCode->caption(), $_account_ref_master_grid->AccountCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_account_ref_master_grid->AccountName->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_grid->AccountName->caption(), $_account_ref_master_grid->AccountName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_account_ref_master_grid->AccountGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_grid->AccountGroupCode->caption(), $_account_ref_master_grid->AccountGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountGroupCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_account_ref_master_grid->AccountGroupCode->errorMessage()) ?>");
			<?php if ($_account_ref_master_grid->AccountDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_grid->AccountDesc->caption(), $_account_ref_master_grid->AccountDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($_account_ref_master_grid->Amount->Required) { ?>
				elm = this.getElements("x" + infix + "_Amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_grid->Amount->caption(), $_account_ref_master_grid->Amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Amount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_account_ref_master_grid->Amount->errorMessage()) ?>");
			<?php if ($_account_ref_master_grid->AccountType->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_grid->AccountType->caption(), $_account_ref_master_grid->AccountType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_account_ref_master_grid->AccountType->errorMessage()) ?>");
			<?php if ($_account_ref_master_grid->AccountSubGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountSubGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $_account_ref_master_grid->AccountSubGroupCode->caption(), $_account_ref_master_grid->AccountSubGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountSubGroupCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($_account_ref_master_grid->AccountSubGroupCode->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	f_account_ref_mastergrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "AccountCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountName", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountGroupCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountDesc", false)) return false;
		if (ew.valueChanged(fobj, infix, "Amount", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountType", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountSubGroupCode", false)) return false;
		return true;
	}

	// Form_CustomValidate
	f_account_ref_mastergrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_account_ref_mastergrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_account_ref_mastergrid.lists["x_AccountGroupCode"] = <?php echo $_account_ref_master_grid->AccountGroupCode->Lookup->toClientList($_account_ref_master_grid) ?>;
	f_account_ref_mastergrid.lists["x_AccountGroupCode"].options = <?php echo JsonEncode($_account_ref_master_grid->AccountGroupCode->lookupOptions()) ?>;
	f_account_ref_mastergrid.autoSuggests["x_AccountGroupCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_account_ref_mastergrid.lists["x_AccountType"] = <?php echo $_account_ref_master_grid->AccountType->Lookup->toClientList($_account_ref_master_grid) ?>;
	f_account_ref_mastergrid.lists["x_AccountType"].options = <?php echo JsonEncode($_account_ref_master_grid->AccountType->lookupOptions()) ?>;
	f_account_ref_mastergrid.autoSuggests["x_AccountType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_account_ref_mastergrid.lists["x_AccountSubGroupCode"] = <?php echo $_account_ref_master_grid->AccountSubGroupCode->Lookup->toClientList($_account_ref_master_grid) ?>;
	f_account_ref_mastergrid.lists["x_AccountSubGroupCode"].options = <?php echo JsonEncode($_account_ref_master_grid->AccountSubGroupCode->lookupOptions()) ?>;
	f_account_ref_mastergrid.autoSuggests["x_AccountSubGroupCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("f_account_ref_mastergrid");
});
</script>
<?php } ?>
<?php
$_account_ref_master_grid->renderOtherOptions();
?>
<?php if ($_account_ref_master_grid->TotalRecords > 0 || $_account_ref_master->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_account_ref_master_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _account_ref_master">
<?php if ($_account_ref_master_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $_account_ref_master_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="f_account_ref_mastergrid" class="ew-form ew-list-form form-inline">
<div id="gmp__account_ref_master" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl__account_ref_mastergrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_account_ref_master->RowType = ROWTYPE_HEADER;

// Render list options
$_account_ref_master_grid->renderListOptions();

// Render list options (header, left)
$_account_ref_master_grid->ListOptions->render("header", "left");
?>
<?php if ($_account_ref_master_grid->AccountCode->Visible) { // AccountCode ?>
	<?php if ($_account_ref_master_grid->SortUrl($_account_ref_master_grid->AccountCode) == "") { ?>
		<th data-name="AccountCode" class="<?php echo $_account_ref_master_grid->AccountCode->headerCellClass() ?>"><div id="elh__account_ref_master_AccountCode" class="_account_ref_master_AccountCode"><div class="ew-table-header-caption"><?php echo $_account_ref_master_grid->AccountCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountCode" class="<?php echo $_account_ref_master_grid->AccountCode->headerCellClass() ?>"><div><div id="elh__account_ref_master_AccountCode" class="_account_ref_master_AccountCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_grid->AccountCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_grid->AccountCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_grid->AccountCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_grid->AccountName->Visible) { // AccountName ?>
	<?php if ($_account_ref_master_grid->SortUrl($_account_ref_master_grid->AccountName) == "") { ?>
		<th data-name="AccountName" class="<?php echo $_account_ref_master_grid->AccountName->headerCellClass() ?>"><div id="elh__account_ref_master_AccountName" class="_account_ref_master_AccountName"><div class="ew-table-header-caption"><?php echo $_account_ref_master_grid->AccountName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountName" class="<?php echo $_account_ref_master_grid->AccountName->headerCellClass() ?>"><div><div id="elh__account_ref_master_AccountName" class="_account_ref_master_AccountName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_grid->AccountName->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_grid->AccountName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_grid->AccountName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_grid->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<?php if ($_account_ref_master_grid->SortUrl($_account_ref_master_grid->AccountGroupCode) == "") { ?>
		<th data-name="AccountGroupCode" class="<?php echo $_account_ref_master_grid->AccountGroupCode->headerCellClass() ?>"><div id="elh__account_ref_master_AccountGroupCode" class="_account_ref_master_AccountGroupCode"><div class="ew-table-header-caption"><?php echo $_account_ref_master_grid->AccountGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountGroupCode" class="<?php echo $_account_ref_master_grid->AccountGroupCode->headerCellClass() ?>"><div><div id="elh__account_ref_master_AccountGroupCode" class="_account_ref_master_AccountGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_grid->AccountGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_grid->AccountGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_grid->AccountGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_grid->AccountDesc->Visible) { // AccountDesc ?>
	<?php if ($_account_ref_master_grid->SortUrl($_account_ref_master_grid->AccountDesc) == "") { ?>
		<th data-name="AccountDesc" class="<?php echo $_account_ref_master_grid->AccountDesc->headerCellClass() ?>"><div id="elh__account_ref_master_AccountDesc" class="_account_ref_master_AccountDesc"><div class="ew-table-header-caption"><?php echo $_account_ref_master_grid->AccountDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountDesc" class="<?php echo $_account_ref_master_grid->AccountDesc->headerCellClass() ?>"><div><div id="elh__account_ref_master_AccountDesc" class="_account_ref_master_AccountDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_grid->AccountDesc->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_grid->AccountDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_grid->AccountDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_grid->Amount->Visible) { // Amount ?>
	<?php if ($_account_ref_master_grid->SortUrl($_account_ref_master_grid->Amount) == "") { ?>
		<th data-name="Amount" class="<?php echo $_account_ref_master_grid->Amount->headerCellClass() ?>"><div id="elh__account_ref_master_Amount" class="_account_ref_master_Amount"><div class="ew-table-header-caption"><?php echo $_account_ref_master_grid->Amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Amount" class="<?php echo $_account_ref_master_grid->Amount->headerCellClass() ?>"><div><div id="elh__account_ref_master_Amount" class="_account_ref_master_Amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_grid->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_grid->Amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_grid->Amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_grid->AccountType->Visible) { // AccountType ?>
	<?php if ($_account_ref_master_grid->SortUrl($_account_ref_master_grid->AccountType) == "") { ?>
		<th data-name="AccountType" class="<?php echo $_account_ref_master_grid->AccountType->headerCellClass() ?>"><div id="elh__account_ref_master_AccountType" class="_account_ref_master_AccountType"><div class="ew-table-header-caption"><?php echo $_account_ref_master_grid->AccountType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountType" class="<?php echo $_account_ref_master_grid->AccountType->headerCellClass() ?>"><div><div id="elh__account_ref_master_AccountType" class="_account_ref_master_AccountType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_grid->AccountType->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_grid->AccountType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_grid->AccountType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_account_ref_master_grid->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
	<?php if ($_account_ref_master_grid->SortUrl($_account_ref_master_grid->AccountSubGroupCode) == "") { ?>
		<th data-name="AccountSubGroupCode" class="<?php echo $_account_ref_master_grid->AccountSubGroupCode->headerCellClass() ?>"><div id="elh__account_ref_master_AccountSubGroupCode" class="_account_ref_master_AccountSubGroupCode"><div class="ew-table-header-caption"><?php echo $_account_ref_master_grid->AccountSubGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountSubGroupCode" class="<?php echo $_account_ref_master_grid->AccountSubGroupCode->headerCellClass() ?>"><div><div id="elh__account_ref_master_AccountSubGroupCode" class="_account_ref_master_AccountSubGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_account_ref_master_grid->AccountSubGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_account_ref_master_grid->AccountSubGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_account_ref_master_grid->AccountSubGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_account_ref_master_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$_account_ref_master_grid->StartRecord = 1;
$_account_ref_master_grid->StopRecord = $_account_ref_master_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($_account_ref_master->isConfirm() || $_account_ref_master_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($_account_ref_master_grid->FormKeyCountName) && ($_account_ref_master_grid->isGridAdd() || $_account_ref_master_grid->isGridEdit() || $_account_ref_master->isConfirm())) {
		$_account_ref_master_grid->KeyCount = $CurrentForm->getValue($_account_ref_master_grid->FormKeyCountName);
		$_account_ref_master_grid->StopRecord = $_account_ref_master_grid->StartRecord + $_account_ref_master_grid->KeyCount - 1;
	}
}
$_account_ref_master_grid->RecordCount = $_account_ref_master_grid->StartRecord - 1;
if ($_account_ref_master_grid->Recordset && !$_account_ref_master_grid->Recordset->EOF) {
	$_account_ref_master_grid->Recordset->moveFirst();
	$selectLimit = $_account_ref_master_grid->UseSelectLimit;
	if (!$selectLimit && $_account_ref_master_grid->StartRecord > 1)
		$_account_ref_master_grid->Recordset->move($_account_ref_master_grid->StartRecord - 1);
} elseif (!$_account_ref_master->AllowAddDeleteRow && $_account_ref_master_grid->StopRecord == 0) {
	$_account_ref_master_grid->StopRecord = $_account_ref_master->GridAddRowCount;
}

// Initialize aggregate
$_account_ref_master->RowType = ROWTYPE_AGGREGATEINIT;
$_account_ref_master->resetAttributes();
$_account_ref_master_grid->renderRow();
if ($_account_ref_master_grid->isGridAdd())
	$_account_ref_master_grid->RowIndex = 0;
if ($_account_ref_master_grid->isGridEdit())
	$_account_ref_master_grid->RowIndex = 0;
while ($_account_ref_master_grid->RecordCount < $_account_ref_master_grid->StopRecord) {
	$_account_ref_master_grid->RecordCount++;
	if ($_account_ref_master_grid->RecordCount >= $_account_ref_master_grid->StartRecord) {
		$_account_ref_master_grid->RowCount++;
		if ($_account_ref_master_grid->isGridAdd() || $_account_ref_master_grid->isGridEdit() || $_account_ref_master->isConfirm()) {
			$_account_ref_master_grid->RowIndex++;
			$CurrentForm->Index = $_account_ref_master_grid->RowIndex;
			if ($CurrentForm->hasValue($_account_ref_master_grid->FormActionName) && ($_account_ref_master->isConfirm() || $_account_ref_master_grid->EventCancelled))
				$_account_ref_master_grid->RowAction = strval($CurrentForm->getValue($_account_ref_master_grid->FormActionName));
			elseif ($_account_ref_master_grid->isGridAdd())
				$_account_ref_master_grid->RowAction = "insert";
			else
				$_account_ref_master_grid->RowAction = "";
		}

		// Set up key count
		$_account_ref_master_grid->KeyCount = $_account_ref_master_grid->RowIndex;

		// Init row class and style
		$_account_ref_master->resetAttributes();
		$_account_ref_master->CssClass = "";
		if ($_account_ref_master_grid->isGridAdd()) {
			if ($_account_ref_master->CurrentMode == "copy") {
				$_account_ref_master_grid->loadRowValues($_account_ref_master_grid->Recordset); // Load row values
				$_account_ref_master_grid->setRecordKey($_account_ref_master_grid->RowOldKey, $_account_ref_master_grid->Recordset); // Set old record key
			} else {
				$_account_ref_master_grid->loadRowValues(); // Load default values
				$_account_ref_master_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$_account_ref_master_grid->loadRowValues($_account_ref_master_grid->Recordset); // Load row values
		}
		$_account_ref_master->RowType = ROWTYPE_VIEW; // Render view
		if ($_account_ref_master_grid->isGridAdd()) // Grid add
			$_account_ref_master->RowType = ROWTYPE_ADD; // Render add
		if ($_account_ref_master_grid->isGridAdd() && $_account_ref_master->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$_account_ref_master_grid->restoreCurrentRowFormValues($_account_ref_master_grid->RowIndex); // Restore form values
		if ($_account_ref_master_grid->isGridEdit()) { // Grid edit
			if ($_account_ref_master->EventCancelled)
				$_account_ref_master_grid->restoreCurrentRowFormValues($_account_ref_master_grid->RowIndex); // Restore form values
			if ($_account_ref_master_grid->RowAction == "insert")
				$_account_ref_master->RowType = ROWTYPE_ADD; // Render add
			else
				$_account_ref_master->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($_account_ref_master_grid->isGridEdit() && ($_account_ref_master->RowType == ROWTYPE_EDIT || $_account_ref_master->RowType == ROWTYPE_ADD) && $_account_ref_master->EventCancelled) // Update failed
			$_account_ref_master_grid->restoreCurrentRowFormValues($_account_ref_master_grid->RowIndex); // Restore form values
		if ($_account_ref_master->RowType == ROWTYPE_EDIT) // Edit row
			$_account_ref_master_grid->EditRowCount++;
		if ($_account_ref_master->isConfirm()) // Confirm row
			$_account_ref_master_grid->restoreCurrentRowFormValues($_account_ref_master_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$_account_ref_master->RowAttrs->merge(["data-rowindex" => $_account_ref_master_grid->RowCount, "id" => "r" . $_account_ref_master_grid->RowCount . "__account_ref_master", "data-rowtype" => $_account_ref_master->RowType]);

		// Render row
		$_account_ref_master_grid->renderRow();

		// Render list options
		$_account_ref_master_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($_account_ref_master_grid->RowAction != "delete" && $_account_ref_master_grid->RowAction != "insertdelete" && !($_account_ref_master_grid->RowAction == "insert" && $_account_ref_master->isConfirm() && $_account_ref_master_grid->emptyRow())) {
?>
	<tr <?php echo $_account_ref_master->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_account_ref_master_grid->ListOptions->render("body", "left", $_account_ref_master_grid->RowCount);
?>
	<?php if ($_account_ref_master_grid->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode" <?php echo $_account_ref_master_grid->AccountCode->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountCode" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_AccountCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountCode->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_grid->AccountCode->EditValue ?>"<?php echo $_account_ref_master_grid->AccountCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountCode" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountCode->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="_account_ref_master" data-field="x_AccountCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountCode->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_grid->AccountCode->EditValue ?>"<?php echo $_account_ref_master_grid->AccountCode->editAttributes() ?>>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountCode" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountCode->OldValue != null ? $_account_ref_master_grid->AccountCode->OldValue : $_account_ref_master_grid->AccountCode->CurrentValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountCode">
<span<?php echo $_account_ref_master_grid->AccountCode->viewAttributes() ?>><?php echo $_account_ref_master_grid->AccountCode->getViewValue() ?></span>
</span>
<?php if (!$_account_ref_master->isConfirm()) { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountCode->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountCode" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountCode" name="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" id="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountCode->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountCode" name="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" id="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_account_ref_master_grid->AccountName->Visible) { // AccountName ?>
		<td data-name="AccountName" <?php echo $_account_ref_master_grid->AccountName->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountName" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_AccountName" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountName->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_grid->AccountName->EditValue ?>"<?php echo $_account_ref_master_grid->AccountName->editAttributes() ?>>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountName" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountName->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountName" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_AccountName" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountName->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_grid->AccountName->EditValue ?>"<?php echo $_account_ref_master_grid->AccountName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountName">
<span<?php echo $_account_ref_master_grid->AccountName->viewAttributes() ?>><?php echo $_account_ref_master_grid->AccountName->getViewValue() ?></span>
</span>
<?php if (!$_account_ref_master->isConfirm()) { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountName" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountName->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountName" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountName" name="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" id="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountName->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountName" name="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" id="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_account_ref_master_grid->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<td data-name="AccountGroupCode" <?php echo $_account_ref_master_grid->AccountGroupCode->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_account_ref_master_grid->AccountGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountGroupCode" class="form-group">
<span<?php echo $_account_ref_master_grid->AccountGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountGroupCode" class="form-group">
<?php
$onchange = $_account_ref_master_grid->AccountGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_grid->AccountGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo RemoveHtml($_account_ref_master_grid->AccountGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_grid->AccountGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_grid->AccountGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_grid->AccountGroupCode->ReadOnly || $_account_ref_master_grid->AccountGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_grid->AccountGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_mastergrid"], function() {
	f_account_ref_mastergrid.createAutoSuggest({"id":"x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_grid->AccountGroupCode->Lookup->getParamTag($_account_ref_master_grid, "p_x" . $_account_ref_master_grid->RowIndex . "_AccountGroupCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_account_ref_master_grid->AccountGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountGroupCode" class="form-group">
<span<?php echo $_account_ref_master_grid->AccountGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountGroupCode" class="form-group">
<?php
$onchange = $_account_ref_master_grid->AccountGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_grid->AccountGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo RemoveHtml($_account_ref_master_grid->AccountGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_grid->AccountGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_grid->AccountGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_grid->AccountGroupCode->ReadOnly || $_account_ref_master_grid->AccountGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_grid->AccountGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_mastergrid"], function() {
	f_account_ref_mastergrid.createAutoSuggest({"id":"x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_grid->AccountGroupCode->Lookup->getParamTag($_account_ref_master_grid, "p_x" . $_account_ref_master_grid->RowIndex . "_AccountGroupCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountGroupCode">
<span<?php echo $_account_ref_master_grid->AccountGroupCode->viewAttributes() ?>><?php echo $_account_ref_master_grid->AccountGroupCode->getViewValue() ?></span>
</span>
<?php if (!$_account_ref_master->isConfirm()) { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" name="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" name="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_account_ref_master_grid->AccountDesc->Visible) { // AccountDesc ?>
		<td data-name="AccountDesc" <?php echo $_account_ref_master_grid->AccountDesc->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountDesc" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_AccountDesc" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountDesc->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_grid->AccountDesc->EditValue ?>"<?php echo $_account_ref_master_grid->AccountDesc->editAttributes() ?>>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountDesc" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountDesc->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountDesc" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_AccountDesc" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountDesc->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_grid->AccountDesc->EditValue ?>"<?php echo $_account_ref_master_grid->AccountDesc->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountDesc">
<span<?php echo $_account_ref_master_grid->AccountDesc->viewAttributes() ?>><?php echo $_account_ref_master_grid->AccountDesc->getViewValue() ?></span>
</span>
<?php if (!$_account_ref_master->isConfirm()) { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountDesc" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountDesc->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountDesc" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountDesc->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountDesc" name="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" id="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountDesc->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountDesc" name="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" id="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountDesc->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_account_ref_master_grid->Amount->Visible) { // Amount ?>
		<td data-name="Amount" <?php echo $_account_ref_master_grid->Amount->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_Amount" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_Amount" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->Amount->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_grid->Amount->EditValue ?>"<?php echo $_account_ref_master_grid->Amount->editAttributes() ?>>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_Amount" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($_account_ref_master_grid->Amount->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_Amount" class="form-group">
<input type="text" data-table="_account_ref_master" data-field="x_Amount" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->Amount->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_grid->Amount->EditValue ?>"<?php echo $_account_ref_master_grid->Amount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_Amount">
<span<?php echo $_account_ref_master_grid->Amount->viewAttributes() ?>><?php echo $_account_ref_master_grid->Amount->getViewValue() ?></span>
</span>
<?php if (!$_account_ref_master->isConfirm()) { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_Amount" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($_account_ref_master_grid->Amount->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_Amount" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($_account_ref_master_grid->Amount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_Amount" name="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" id="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($_account_ref_master_grid->Amount->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_Amount" name="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" id="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($_account_ref_master_grid->Amount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_account_ref_master_grid->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType" <?php echo $_account_ref_master_grid->AccountType->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_account_ref_master_grid->AccountType->getSessionValue() != "") { ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountType" class="form-group">
<span<?php echo $_account_ref_master_grid->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountType" class="form-group">
<?php
$onchange = $_account_ref_master_grid->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_grid->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($_account_ref_master_grid->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->getPlaceHolder()) ?>"<?php echo $_account_ref_master_grid->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_grid->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_grid->AccountType->ReadOnly || $_account_ref_master_grid->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_grid->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_mastergrid"], function() {
	f_account_ref_mastergrid.createAutoSuggest({"id":"x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_grid->AccountType->Lookup->getParamTag($_account_ref_master_grid, "p_x" . $_account_ref_master_grid->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_account_ref_master_grid->AccountType->getSessionValue() != "") { ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountType" class="form-group">
<span<?php echo $_account_ref_master_grid->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountType" class="form-group">
<?php
$onchange = $_account_ref_master_grid->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_grid->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($_account_ref_master_grid->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->getPlaceHolder()) ?>"<?php echo $_account_ref_master_grid->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_grid->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_grid->AccountType->ReadOnly || $_account_ref_master_grid->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_grid->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_mastergrid"], function() {
	f_account_ref_mastergrid.createAutoSuggest({"id":"x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_grid->AccountType->Lookup->getParamTag($_account_ref_master_grid, "p_x" . $_account_ref_master_grid->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountType">
<span<?php echo $_account_ref_master_grid->AccountType->viewAttributes() ?>><?php echo $_account_ref_master_grid->AccountType->getViewValue() ?></span>
</span>
<?php if (!$_account_ref_master->isConfirm()) { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" name="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" name="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($_account_ref_master_grid->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
		<td data-name="AccountSubGroupCode" <?php echo $_account_ref_master_grid->AccountSubGroupCode->cellAttributes() ?>>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($_account_ref_master_grid->AccountSubGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountSubGroupCode" class="form-group">
<span<?php echo $_account_ref_master_grid->AccountSubGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountSubGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountSubGroupCode" class="form-group">
<?php
$onchange = $_account_ref_master_grid->AccountSubGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_grid->AccountSubGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo RemoveHtml($_account_ref_master_grid->AccountSubGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_grid->AccountSubGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_grid->AccountSubGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_grid->AccountSubGroupCode->ReadOnly || $_account_ref_master_grid->AccountSubGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_grid->AccountSubGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_mastergrid"], function() {
	f_account_ref_mastergrid.createAutoSuggest({"id":"x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_grid->AccountSubGroupCode->Lookup->getParamTag($_account_ref_master_grid, "p_x" . $_account_ref_master_grid->RowIndex . "_AccountSubGroupCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->OldValue) ?>">
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($_account_ref_master_grid->AccountSubGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountSubGroupCode" class="form-group">
<span<?php echo $_account_ref_master_grid->AccountSubGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountSubGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountSubGroupCode" class="form-group">
<?php
$onchange = $_account_ref_master_grid->AccountSubGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_grid->AccountSubGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo RemoveHtml($_account_ref_master_grid->AccountSubGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_grid->AccountSubGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_grid->AccountSubGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_grid->AccountSubGroupCode->ReadOnly || $_account_ref_master_grid->AccountSubGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_grid->AccountSubGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_mastergrid"], function() {
	f_account_ref_mastergrid.createAutoSuggest({"id":"x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_grid->AccountSubGroupCode->Lookup->getParamTag($_account_ref_master_grid, "p_x" . $_account_ref_master_grid->RowIndex . "_AccountSubGroupCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($_account_ref_master->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $_account_ref_master_grid->RowCount ?>__account_ref_master_AccountSubGroupCode">
<span<?php echo $_account_ref_master_grid->AccountSubGroupCode->viewAttributes() ?>><?php echo $_account_ref_master_grid->AccountSubGroupCode->getViewValue() ?></span>
</span>
<?php if (!$_account_ref_master->isConfirm()) { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" name="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="f_account_ref_mastergrid$x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->FormValue) ?>">
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" name="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="f_account_ref_mastergrid$o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_account_ref_master_grid->ListOptions->render("body", "right", $_account_ref_master_grid->RowCount);
?>
	</tr>
<?php if ($_account_ref_master->RowType == ROWTYPE_ADD || $_account_ref_master->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["f_account_ref_mastergrid", "load"], function() {
	f_account_ref_mastergrid.updateLists(<?php echo $_account_ref_master_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$_account_ref_master_grid->isGridAdd() || $_account_ref_master->CurrentMode == "copy")
		if (!$_account_ref_master_grid->Recordset->EOF)
			$_account_ref_master_grid->Recordset->moveNext();
}
?>
<?php
	if ($_account_ref_master->CurrentMode == "add" || $_account_ref_master->CurrentMode == "copy" || $_account_ref_master->CurrentMode == "edit") {
		$_account_ref_master_grid->RowIndex = '$rowindex$';
		$_account_ref_master_grid->loadRowValues();

		// Set row properties
		$_account_ref_master->resetAttributes();
		$_account_ref_master->RowAttrs->merge(["data-rowindex" => $_account_ref_master_grid->RowIndex, "id" => "r0__account_ref_master", "data-rowtype" => ROWTYPE_ADD]);
		$_account_ref_master->RowAttrs->appendClass("ew-template");
		$_account_ref_master->RowType = ROWTYPE_ADD;

		// Render row
		$_account_ref_master_grid->renderRow();

		// Render list options
		$_account_ref_master_grid->renderListOptions();
		$_account_ref_master_grid->StartRowCount = 0;
?>
	<tr <?php echo $_account_ref_master->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_account_ref_master_grid->ListOptions->render("body", "left", $_account_ref_master_grid->RowIndex);
?>
	<?php if ($_account_ref_master_grid->AccountCode->Visible) { // AccountCode ?>
		<td data-name="AccountCode">
<?php if (!$_account_ref_master->isConfirm()) { ?>
<span id="el$rowindex$__account_ref_master_AccountCode" class="form-group _account_ref_master_AccountCode">
<input type="text" data-table="_account_ref_master" data-field="x_AccountCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountCode->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_grid->AccountCode->EditValue ?>"<?php echo $_account_ref_master_grid->AccountCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_AccountCode" class="form-group _account_ref_master_AccountCode">
<span<?php echo $_account_ref_master_grid->AccountCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountCode" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_account_ref_master_grid->AccountName->Visible) { // AccountName ?>
		<td data-name="AccountName">
<?php if (!$_account_ref_master->isConfirm()) { ?>
<span id="el$rowindex$__account_ref_master_AccountName" class="form-group _account_ref_master_AccountName">
<input type="text" data-table="_account_ref_master" data-field="x_AccountName" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountName->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_grid->AccountName->EditValue ?>"<?php echo $_account_ref_master_grid->AccountName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_AccountName" class="form-group _account_ref_master_AccountName">
<span<?php echo $_account_ref_master_grid->AccountName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountName" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountName" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_account_ref_master_grid->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<td data-name="AccountGroupCode">
<?php if (!$_account_ref_master->isConfirm()) { ?>
<?php if ($_account_ref_master_grid->AccountGroupCode->getSessionValue() != "") { ?>
<span id="el$rowindex$__account_ref_master_AccountGroupCode" class="form-group _account_ref_master_AccountGroupCode">
<span<?php echo $_account_ref_master_grid->AccountGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_AccountGroupCode" class="form-group _account_ref_master_AccountGroupCode">
<?php
$onchange = $_account_ref_master_grid->AccountGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_grid->AccountGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo RemoveHtml($_account_ref_master_grid->AccountGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_grid->AccountGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_grid->AccountGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_grid->AccountGroupCode->ReadOnly || $_account_ref_master_grid->AccountGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_grid->AccountGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_mastergrid"], function() {
	f_account_ref_mastergrid.createAutoSuggest({"id":"x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_grid->AccountGroupCode->Lookup->getParamTag($_account_ref_master_grid, "p_x" . $_account_ref_master_grid->RowIndex . "_AccountGroupCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_AccountGroupCode" class="form-group _account_ref_master_AccountGroupCode">
<span<?php echo $_account_ref_master_grid->AccountGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountGroupCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_account_ref_master_grid->AccountDesc->Visible) { // AccountDesc ?>
		<td data-name="AccountDesc">
<?php if (!$_account_ref_master->isConfirm()) { ?>
<span id="el$rowindex$__account_ref_master_AccountDesc" class="form-group _account_ref_master_AccountDesc">
<input type="text" data-table="_account_ref_master" data-field="x_AccountDesc" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountDesc->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_grid->AccountDesc->EditValue ?>"<?php echo $_account_ref_master_grid->AccountDesc->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_AccountDesc" class="form-group _account_ref_master_AccountDesc">
<span<?php echo $_account_ref_master_grid->AccountDesc->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountDesc->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountDesc" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountDesc->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountDesc" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountDesc" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountDesc->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_account_ref_master_grid->Amount->Visible) { // Amount ?>
		<td data-name="Amount">
<?php if (!$_account_ref_master->isConfirm()) { ?>
<span id="el$rowindex$__account_ref_master_Amount" class="form-group _account_ref_master_Amount">
<input type="text" data-table="_account_ref_master" data-field="x_Amount" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->Amount->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_grid->Amount->EditValue ?>"<?php echo $_account_ref_master_grid->Amount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_Amount" class="form-group _account_ref_master_Amount">
<span<?php echo $_account_ref_master_grid->Amount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->Amount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_Amount" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($_account_ref_master_grid->Amount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_Amount" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($_account_ref_master_grid->Amount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_account_ref_master_grid->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType">
<?php if (!$_account_ref_master->isConfirm()) { ?>
<?php if ($_account_ref_master_grid->AccountType->getSessionValue() != "") { ?>
<span id="el$rowindex$__account_ref_master_AccountType" class="form-group _account_ref_master_AccountType">
<span<?php echo $_account_ref_master_grid->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_AccountType" class="form-group _account_ref_master_AccountType">
<?php
$onchange = $_account_ref_master_grid->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_grid->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($_account_ref_master_grid->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->getPlaceHolder()) ?>"<?php echo $_account_ref_master_grid->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_grid->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_grid->AccountType->ReadOnly || $_account_ref_master_grid->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_grid->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_mastergrid"], function() {
	f_account_ref_mastergrid.createAutoSuggest({"id":"x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_grid->AccountType->Lookup->getParamTag($_account_ref_master_grid, "p_x" . $_account_ref_master_grid->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_AccountType" class="form-group _account_ref_master_AccountType">
<span<?php echo $_account_ref_master_grid->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($_account_ref_master_grid->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
		<td data-name="AccountSubGroupCode">
<?php if (!$_account_ref_master->isConfirm()) { ?>
<?php if ($_account_ref_master_grid->AccountSubGroupCode->getSessionValue() != "") { ?>
<span id="el$rowindex$__account_ref_master_AccountSubGroupCode" class="form-group _account_ref_master_AccountSubGroupCode">
<span<?php echo $_account_ref_master_grid->AccountSubGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountSubGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_AccountSubGroupCode" class="form-group _account_ref_master_AccountSubGroupCode">
<?php
$onchange = $_account_ref_master_grid->AccountSubGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_grid->AccountSubGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="sv_x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo RemoveHtml($_account_ref_master_grid->AccountSubGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_grid->AccountSubGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_grid->AccountSubGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_grid->AccountSubGroupCode->ReadOnly || $_account_ref_master_grid->AccountSubGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_grid->AccountSubGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_mastergrid"], function() {
	f_account_ref_mastergrid.createAutoSuggest({"id":"x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_grid->AccountSubGroupCode->Lookup->getParamTag($_account_ref_master_grid, "p_x" . $_account_ref_master_grid->RowIndex . "_AccountSubGroupCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$__account_ref_master_AccountSubGroupCode" class="form-group _account_ref_master_AccountSubGroupCode">
<span<?php echo $_account_ref_master_grid->AccountSubGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($_account_ref_master_grid->AccountSubGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" name="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" name="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" id="o<?php echo $_account_ref_master_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_grid->AccountSubGroupCode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_account_ref_master_grid->ListOptions->render("body", "right", $_account_ref_master_grid->RowIndex);
?>
<script>
loadjs.ready(["f_account_ref_mastergrid", "load"], function() {
	f_account_ref_mastergrid.updateLists(<?php echo $_account_ref_master_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($_account_ref_master->CurrentMode == "add" || $_account_ref_master->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $_account_ref_master_grid->FormKeyCountName ?>" id="<?php echo $_account_ref_master_grid->FormKeyCountName ?>" value="<?php echo $_account_ref_master_grid->KeyCount ?>">
<?php echo $_account_ref_master_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($_account_ref_master->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $_account_ref_master_grid->FormKeyCountName ?>" id="<?php echo $_account_ref_master_grid->FormKeyCountName ?>" value="<?php echo $_account_ref_master_grid->KeyCount ?>">
<?php echo $_account_ref_master_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($_account_ref_master->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="f_account_ref_mastergrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_account_ref_master_grid->Recordset)
	$_account_ref_master_grid->Recordset->Close();
?>
<?php if ($_account_ref_master_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $_account_ref_master_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_account_ref_master_grid->TotalRecords == 0 && !$_account_ref_master->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_account_ref_master_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$_account_ref_master_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$_account_ref_master_grid->terminate();
?>