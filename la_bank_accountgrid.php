<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($la_bank_account_grid))
	$la_bank_account_grid = new la_bank_account_grid();

// Run the page
$la_bank_account_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_bank_account_grid->Page_Render();
?>
<?php if (!$la_bank_account_grid->isExport()) { ?>
<script>
var fla_bank_accountgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fla_bank_accountgrid = new ew.Form("fla_bank_accountgrid", "grid");
	fla_bank_accountgrid.formKeyCountName = '<?php echo $la_bank_account_grid->FormKeyCountName ?>';

	// Validate form
	fla_bank_accountgrid.validate = function() {
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
			<?php if ($la_bank_account_grid->BankCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_grid->BankCode->caption(), $la_bank_account_grid->BankCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_grid->BranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_grid->BranchCode->caption(), $la_bank_account_grid->BranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_grid->AccountName->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_grid->AccountName->caption(), $la_bank_account_grid->AccountName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_grid->BankAccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BankAccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_grid->BankAccountNo->caption(), $la_bank_account_grid->BankAccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_grid->LACode->caption(), $la_bank_account_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fla_bank_accountgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "BankCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "BranchCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountName", false)) return false;
		if (ew.valueChanged(fobj, infix, "BankAccountNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fla_bank_accountgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fla_bank_accountgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fla_bank_accountgrid.lists["x_BankCode"] = <?php echo $la_bank_account_grid->BankCode->Lookup->toClientList($la_bank_account_grid) ?>;
	fla_bank_accountgrid.lists["x_BankCode"].options = <?php echo JsonEncode($la_bank_account_grid->BankCode->lookupOptions()) ?>;
	fla_bank_accountgrid.autoSuggests["x_BankCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fla_bank_accountgrid.lists["x_BranchCode"] = <?php echo $la_bank_account_grid->BranchCode->Lookup->toClientList($la_bank_account_grid) ?>;
	fla_bank_accountgrid.lists["x_BranchCode"].options = <?php echo JsonEncode($la_bank_account_grid->BranchCode->lookupOptions()) ?>;
	fla_bank_accountgrid.lists["x_LACode"] = <?php echo $la_bank_account_grid->LACode->Lookup->toClientList($la_bank_account_grid) ?>;
	fla_bank_accountgrid.lists["x_LACode"].options = <?php echo JsonEncode($la_bank_account_grid->LACode->lookupOptions()) ?>;
	fla_bank_accountgrid.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fla_bank_accountgrid");
});
</script>
<?php } ?>
<?php
$la_bank_account_grid->renderOtherOptions();
?>
<?php if ($la_bank_account_grid->TotalRecords > 0 || $la_bank_account->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($la_bank_account_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> la_bank_account">
<?php if ($la_bank_account_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $la_bank_account_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fla_bank_accountgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_la_bank_account" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_la_bank_accountgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$la_bank_account->RowType = ROWTYPE_HEADER;

// Render list options
$la_bank_account_grid->renderListOptions();

// Render list options (header, left)
$la_bank_account_grid->ListOptions->render("header", "left");
?>
<?php if ($la_bank_account_grid->BankCode->Visible) { // BankCode ?>
	<?php if ($la_bank_account_grid->SortUrl($la_bank_account_grid->BankCode) == "") { ?>
		<th data-name="BankCode" class="<?php echo $la_bank_account_grid->BankCode->headerCellClass() ?>"><div id="elh_la_bank_account_BankCode" class="la_bank_account_BankCode"><div class="ew-table-header-caption"><?php echo $la_bank_account_grid->BankCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankCode" class="<?php echo $la_bank_account_grid->BankCode->headerCellClass() ?>"><div><div id="elh_la_bank_account_BankCode" class="la_bank_account_BankCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_grid->BankCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_grid->BankCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_grid->BankCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_bank_account_grid->BranchCode->Visible) { // BranchCode ?>
	<?php if ($la_bank_account_grid->SortUrl($la_bank_account_grid->BranchCode) == "") { ?>
		<th data-name="BranchCode" class="<?php echo $la_bank_account_grid->BranchCode->headerCellClass() ?>"><div id="elh_la_bank_account_BranchCode" class="la_bank_account_BranchCode"><div class="ew-table-header-caption"><?php echo $la_bank_account_grid->BranchCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BranchCode" class="<?php echo $la_bank_account_grid->BranchCode->headerCellClass() ?>"><div><div id="elh_la_bank_account_BranchCode" class="la_bank_account_BranchCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_grid->BranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_grid->BranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_grid->BranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_bank_account_grid->AccountName->Visible) { // AccountName ?>
	<?php if ($la_bank_account_grid->SortUrl($la_bank_account_grid->AccountName) == "") { ?>
		<th data-name="AccountName" class="<?php echo $la_bank_account_grid->AccountName->headerCellClass() ?>"><div id="elh_la_bank_account_AccountName" class="la_bank_account_AccountName"><div class="ew-table-header-caption"><?php echo $la_bank_account_grid->AccountName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountName" class="<?php echo $la_bank_account_grid->AccountName->headerCellClass() ?>"><div><div id="elh_la_bank_account_AccountName" class="la_bank_account_AccountName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_grid->AccountName->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_grid->AccountName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_grid->AccountName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_bank_account_grid->BankAccountNo->Visible) { // BankAccountNo ?>
	<?php if ($la_bank_account_grid->SortUrl($la_bank_account_grid->BankAccountNo) == "") { ?>
		<th data-name="BankAccountNo" class="<?php echo $la_bank_account_grid->BankAccountNo->headerCellClass() ?>"><div id="elh_la_bank_account_BankAccountNo" class="la_bank_account_BankAccountNo"><div class="ew-table-header-caption"><?php echo $la_bank_account_grid->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankAccountNo" class="<?php echo $la_bank_account_grid->BankAccountNo->headerCellClass() ?>"><div><div id="elh_la_bank_account_BankAccountNo" class="la_bank_account_BankAccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_grid->BankAccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_grid->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_grid->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_bank_account_grid->LACode->Visible) { // LACode ?>
	<?php if ($la_bank_account_grid->SortUrl($la_bank_account_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $la_bank_account_grid->LACode->headerCellClass() ?>"><div id="elh_la_bank_account_LACode" class="la_bank_account_LACode"><div class="ew-table-header-caption"><?php echo $la_bank_account_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $la_bank_account_grid->LACode->headerCellClass() ?>"><div><div id="elh_la_bank_account_LACode" class="la_bank_account_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_bank_account_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_bank_account_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_bank_account_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$la_bank_account_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$la_bank_account_grid->StartRecord = 1;
$la_bank_account_grid->StopRecord = $la_bank_account_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($la_bank_account->isConfirm() || $la_bank_account_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($la_bank_account_grid->FormKeyCountName) && ($la_bank_account_grid->isGridAdd() || $la_bank_account_grid->isGridEdit() || $la_bank_account->isConfirm())) {
		$la_bank_account_grid->KeyCount = $CurrentForm->getValue($la_bank_account_grid->FormKeyCountName);
		$la_bank_account_grid->StopRecord = $la_bank_account_grid->StartRecord + $la_bank_account_grid->KeyCount - 1;
	}
}
$la_bank_account_grid->RecordCount = $la_bank_account_grid->StartRecord - 1;
if ($la_bank_account_grid->Recordset && !$la_bank_account_grid->Recordset->EOF) {
	$la_bank_account_grid->Recordset->moveFirst();
	$selectLimit = $la_bank_account_grid->UseSelectLimit;
	if (!$selectLimit && $la_bank_account_grid->StartRecord > 1)
		$la_bank_account_grid->Recordset->move($la_bank_account_grid->StartRecord - 1);
} elseif (!$la_bank_account->AllowAddDeleteRow && $la_bank_account_grid->StopRecord == 0) {
	$la_bank_account_grid->StopRecord = $la_bank_account->GridAddRowCount;
}

// Initialize aggregate
$la_bank_account->RowType = ROWTYPE_AGGREGATEINIT;
$la_bank_account->resetAttributes();
$la_bank_account_grid->renderRow();
if ($la_bank_account_grid->isGridAdd())
	$la_bank_account_grid->RowIndex = 0;
if ($la_bank_account_grid->isGridEdit())
	$la_bank_account_grid->RowIndex = 0;
while ($la_bank_account_grid->RecordCount < $la_bank_account_grid->StopRecord) {
	$la_bank_account_grid->RecordCount++;
	if ($la_bank_account_grid->RecordCount >= $la_bank_account_grid->StartRecord) {
		$la_bank_account_grid->RowCount++;
		if ($la_bank_account_grid->isGridAdd() || $la_bank_account_grid->isGridEdit() || $la_bank_account->isConfirm()) {
			$la_bank_account_grid->RowIndex++;
			$CurrentForm->Index = $la_bank_account_grid->RowIndex;
			if ($CurrentForm->hasValue($la_bank_account_grid->FormActionName) && ($la_bank_account->isConfirm() || $la_bank_account_grid->EventCancelled))
				$la_bank_account_grid->RowAction = strval($CurrentForm->getValue($la_bank_account_grid->FormActionName));
			elseif ($la_bank_account_grid->isGridAdd())
				$la_bank_account_grid->RowAction = "insert";
			else
				$la_bank_account_grid->RowAction = "";
		}

		// Set up key count
		$la_bank_account_grid->KeyCount = $la_bank_account_grid->RowIndex;

		// Init row class and style
		$la_bank_account->resetAttributes();
		$la_bank_account->CssClass = "";
		if ($la_bank_account_grid->isGridAdd()) {
			if ($la_bank_account->CurrentMode == "copy") {
				$la_bank_account_grid->loadRowValues($la_bank_account_grid->Recordset); // Load row values
				$la_bank_account_grid->setRecordKey($la_bank_account_grid->RowOldKey, $la_bank_account_grid->Recordset); // Set old record key
			} else {
				$la_bank_account_grid->loadRowValues(); // Load default values
				$la_bank_account_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$la_bank_account_grid->loadRowValues($la_bank_account_grid->Recordset); // Load row values
		}
		$la_bank_account->RowType = ROWTYPE_VIEW; // Render view
		if ($la_bank_account_grid->isGridAdd()) // Grid add
			$la_bank_account->RowType = ROWTYPE_ADD; // Render add
		if ($la_bank_account_grid->isGridAdd() && $la_bank_account->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$la_bank_account_grid->restoreCurrentRowFormValues($la_bank_account_grid->RowIndex); // Restore form values
		if ($la_bank_account_grid->isGridEdit()) { // Grid edit
			if ($la_bank_account->EventCancelled)
				$la_bank_account_grid->restoreCurrentRowFormValues($la_bank_account_grid->RowIndex); // Restore form values
			if ($la_bank_account_grid->RowAction == "insert")
				$la_bank_account->RowType = ROWTYPE_ADD; // Render add
			else
				$la_bank_account->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($la_bank_account_grid->isGridEdit() && ($la_bank_account->RowType == ROWTYPE_EDIT || $la_bank_account->RowType == ROWTYPE_ADD) && $la_bank_account->EventCancelled) // Update failed
			$la_bank_account_grid->restoreCurrentRowFormValues($la_bank_account_grid->RowIndex); // Restore form values
		if ($la_bank_account->RowType == ROWTYPE_EDIT) // Edit row
			$la_bank_account_grid->EditRowCount++;
		if ($la_bank_account->isConfirm()) // Confirm row
			$la_bank_account_grid->restoreCurrentRowFormValues($la_bank_account_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$la_bank_account->RowAttrs->merge(["data-rowindex" => $la_bank_account_grid->RowCount, "id" => "r" . $la_bank_account_grid->RowCount . "_la_bank_account", "data-rowtype" => $la_bank_account->RowType]);

		// Render row
		$la_bank_account_grid->renderRow();

		// Render list options
		$la_bank_account_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($la_bank_account_grid->RowAction != "delete" && $la_bank_account_grid->RowAction != "insertdelete" && !($la_bank_account_grid->RowAction == "insert" && $la_bank_account->isConfirm() && $la_bank_account_grid->emptyRow())) {
?>
	<tr <?php echo $la_bank_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$la_bank_account_grid->ListOptions->render("body", "left", $la_bank_account_grid->RowCount);
?>
	<?php if ($la_bank_account_grid->BankCode->Visible) { // BankCode ?>
		<td data-name="BankCode" <?php echo $la_bank_account_grid->BankCode->cellAttributes() ?>>
<?php if ($la_bank_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_BankCode" class="form-group">
<?php
$onchange = $la_bank_account_grid->BankCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_grid->BankCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="sv_x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo RemoveHtml($la_bank_account_grid->BankCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($la_bank_account_grid->BankCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_grid->BankCode->getPlaceHolder()) ?>"<?php echo $la_bank_account_grid->BankCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_grid->BankCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_grid->BankCode->ReadOnly || $la_bank_account_grid->BankCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_grid->BankCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_grid->BankCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountgrid"], function() {
	fla_bank_accountgrid.createAutoSuggest({"id":"x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode","forceSelect":true});
});
</script>
<?php echo $la_bank_account_grid->BankCode->Lookup->getParamTag($la_bank_account_grid, "p_x" . $la_bank_account_grid->RowIndex . "_BankCode") ?>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" name="o<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="o<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_grid->BankCode->OldValue) ?>">
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_BankCode" class="form-group">
<?php
$onchange = $la_bank_account_grid->BankCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_grid->BankCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="sv_x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo RemoveHtml($la_bank_account_grid->BankCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($la_bank_account_grid->BankCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_grid->BankCode->getPlaceHolder()) ?>"<?php echo $la_bank_account_grid->BankCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_grid->BankCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_grid->BankCode->ReadOnly || $la_bank_account_grid->BankCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_grid->BankCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_grid->BankCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountgrid"], function() {
	fla_bank_accountgrid.createAutoSuggest({"id":"x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode","forceSelect":true});
});
</script>
<?php echo $la_bank_account_grid->BankCode->Lookup->getParamTag($la_bank_account_grid, "p_x" . $la_bank_account_grid->RowIndex . "_BankCode") ?>
</span>
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_BankCode">
<span<?php echo $la_bank_account_grid->BankCode->viewAttributes() ?>><?php echo $la_bank_account_grid->BankCode->getViewValue() ?></span>
</span>
<?php if (!$la_bank_account->isConfirm()) { ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_grid->BankCode->FormValue) ?>">
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" name="o<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="o<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_grid->BankCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" name="fla_bank_accountgrid$x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="fla_bank_accountgrid$x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_grid->BankCode->FormValue) ?>">
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" name="fla_bank_accountgrid$o<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="fla_bank_accountgrid$o<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_grid->BankCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($la_bank_account_grid->BranchCode->Visible) { // BranchCode ?>
		<td data-name="BranchCode" <?php echo $la_bank_account_grid->BranchCode->cellAttributes() ?>>
<?php if ($la_bank_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_BranchCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode"><?php echo EmptyValue(strval($la_bank_account_grid->BranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $la_bank_account_grid->BranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_grid->BranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_grid->BranchCode->ReadOnly || $la_bank_account_grid->BranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $la_bank_account_grid->BranchCode->Lookup->getParamTag($la_bank_account_grid, "p_x" . $la_bank_account_grid->RowIndex . "_BranchCode") ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_grid->BranchCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" value="<?php echo $la_bank_account_grid->BranchCode->CurrentValue ?>"<?php echo $la_bank_account_grid->BranchCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" name="o<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" id="o<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($la_bank_account_grid->BranchCode->OldValue) ?>">
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_BranchCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode"><?php echo EmptyValue(strval($la_bank_account_grid->BranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $la_bank_account_grid->BranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_grid->BranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_grid->BranchCode->ReadOnly || $la_bank_account_grid->BranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $la_bank_account_grid->BranchCode->Lookup->getParamTag($la_bank_account_grid, "p_x" . $la_bank_account_grid->RowIndex . "_BranchCode") ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_grid->BranchCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" value="<?php echo $la_bank_account_grid->BranchCode->CurrentValue ?>"<?php echo $la_bank_account_grid->BranchCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_BranchCode">
<span<?php echo $la_bank_account_grid->BranchCode->viewAttributes() ?>><?php echo $la_bank_account_grid->BranchCode->getViewValue() ?></span>
</span>
<?php if (!$la_bank_account->isConfirm()) { ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($la_bank_account_grid->BranchCode->FormValue) ?>">
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" name="o<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" id="o<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($la_bank_account_grid->BranchCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" name="fla_bank_accountgrid$x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" id="fla_bank_accountgrid$x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($la_bank_account_grid->BranchCode->FormValue) ?>">
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" name="fla_bank_accountgrid$o<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" id="fla_bank_accountgrid$o<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($la_bank_account_grid->BranchCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($la_bank_account_grid->AccountName->Visible) { // AccountName ?>
		<td data-name="AccountName" <?php echo $la_bank_account_grid->AccountName->cellAttributes() ?>>
<?php if ($la_bank_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_AccountName" class="form-group">
<input type="text" data-table="la_bank_account" data-field="x_AccountName" name="x<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" id="x<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_bank_account_grid->AccountName->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_grid->AccountName->EditValue ?>"<?php echo $la_bank_account_grid->AccountName->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_AccountName" name="o<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" id="o<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($la_bank_account_grid->AccountName->OldValue) ?>">
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_AccountName" class="form-group">
<input type="text" data-table="la_bank_account" data-field="x_AccountName" name="x<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" id="x<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_bank_account_grid->AccountName->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_grid->AccountName->EditValue ?>"<?php echo $la_bank_account_grid->AccountName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_AccountName">
<span<?php echo $la_bank_account_grid->AccountName->viewAttributes() ?>><?php echo $la_bank_account_grid->AccountName->getViewValue() ?></span>
</span>
<?php if (!$la_bank_account->isConfirm()) { ?>
<input type="hidden" data-table="la_bank_account" data-field="x_AccountName" name="x<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" id="x<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($la_bank_account_grid->AccountName->FormValue) ?>">
<input type="hidden" data-table="la_bank_account" data-field="x_AccountName" name="o<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" id="o<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($la_bank_account_grid->AccountName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="la_bank_account" data-field="x_AccountName" name="fla_bank_accountgrid$x<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" id="fla_bank_accountgrid$x<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($la_bank_account_grid->AccountName->FormValue) ?>">
<input type="hidden" data-table="la_bank_account" data-field="x_AccountName" name="fla_bank_accountgrid$o<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" id="fla_bank_accountgrid$o<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($la_bank_account_grid->AccountName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($la_bank_account_grid->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo" <?php echo $la_bank_account_grid->BankAccountNo->cellAttributes() ?>>
<?php if ($la_bank_account->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_BankAccountNo" class="form-group">
<input type="text" data-table="la_bank_account" data-field="x_BankAccountNo" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($la_bank_account_grid->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_grid->BankAccountNo->EditValue ?>"<?php echo $la_bank_account_grid->BankAccountNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankAccountNo" name="o<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" id="o<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($la_bank_account_grid->BankAccountNo->OldValue) ?>">
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="la_bank_account" data-field="x_BankAccountNo" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($la_bank_account_grid->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_grid->BankAccountNo->EditValue ?>"<?php echo $la_bank_account_grid->BankAccountNo->editAttributes() ?>>
<input type="hidden" data-table="la_bank_account" data-field="x_BankAccountNo" name="o<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" id="o<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($la_bank_account_grid->BankAccountNo->OldValue != null ? $la_bank_account_grid->BankAccountNo->OldValue : $la_bank_account_grid->BankAccountNo->CurrentValue) ?>">
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_BankAccountNo">
<span<?php echo $la_bank_account_grid->BankAccountNo->viewAttributes() ?>><?php echo $la_bank_account_grid->BankAccountNo->getViewValue() ?></span>
</span>
<?php if (!$la_bank_account->isConfirm()) { ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BankAccountNo" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($la_bank_account_grid->BankAccountNo->FormValue) ?>">
<input type="hidden" data-table="la_bank_account" data-field="x_BankAccountNo" name="o<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" id="o<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($la_bank_account_grid->BankAccountNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BankAccountNo" name="fla_bank_accountgrid$x<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" id="fla_bank_accountgrid$x<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($la_bank_account_grid->BankAccountNo->FormValue) ?>">
<input type="hidden" data-table="la_bank_account" data-field="x_BankAccountNo" name="fla_bank_accountgrid$o<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" id="fla_bank_accountgrid$o<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($la_bank_account_grid->BankAccountNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($la_bank_account_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $la_bank_account_grid->LACode->cellAttributes() ?>>
<?php if ($la_bank_account->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($la_bank_account_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_LACode" class="form-group">
<span<?php echo $la_bank_account_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" name="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_LACode" class="form-group">
<?php
$onchange = $la_bank_account_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_bank_account_grid->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="sv_x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($la_bank_account_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($la_bank_account_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_grid->LACode->getPlaceHolder()) ?>"<?php echo $la_bank_account_grid->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" data-value-separator="<?php echo $la_bank_account_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountgrid"], function() {
	fla_bank_accountgrid.createAutoSuggest({"id":"x<?php echo $la_bank_account_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $la_bank_account_grid->LACode->Lookup->getParamTag($la_bank_account_grid, "p_x" . $la_bank_account_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" name="o<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="o<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($la_bank_account_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_LACode" class="form-group">
<span<?php echo $la_bank_account_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" name="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_LACode" class="form-group">
<?php
$onchange = $la_bank_account_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_bank_account_grid->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="sv_x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($la_bank_account_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($la_bank_account_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_grid->LACode->getPlaceHolder()) ?>"<?php echo $la_bank_account_grid->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" data-value-separator="<?php echo $la_bank_account_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountgrid"], function() {
	fla_bank_accountgrid.createAutoSuggest({"id":"x<?php echo $la_bank_account_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $la_bank_account_grid->LACode->Lookup->getParamTag($la_bank_account_grid, "p_x" . $la_bank_account_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($la_bank_account->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $la_bank_account_grid->RowCount ?>_la_bank_account_LACode">
<span<?php echo $la_bank_account_grid->LACode->viewAttributes() ?>><?php echo $la_bank_account_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$la_bank_account->isConfirm()) { ?>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" name="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" name="o<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="o<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" name="fla_bank_accountgrid$x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="fla_bank_accountgrid$x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" name="fla_bank_accountgrid$o<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="fla_bank_accountgrid$o<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$la_bank_account_grid->ListOptions->render("body", "right", $la_bank_account_grid->RowCount);
?>
	</tr>
<?php if ($la_bank_account->RowType == ROWTYPE_ADD || $la_bank_account->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fla_bank_accountgrid", "load"], function() {
	fla_bank_accountgrid.updateLists(<?php echo $la_bank_account_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$la_bank_account_grid->isGridAdd() || $la_bank_account->CurrentMode == "copy")
		if (!$la_bank_account_grid->Recordset->EOF)
			$la_bank_account_grid->Recordset->moveNext();
}
?>
<?php
	if ($la_bank_account->CurrentMode == "add" || $la_bank_account->CurrentMode == "copy" || $la_bank_account->CurrentMode == "edit") {
		$la_bank_account_grid->RowIndex = '$rowindex$';
		$la_bank_account_grid->loadRowValues();

		// Set row properties
		$la_bank_account->resetAttributes();
		$la_bank_account->RowAttrs->merge(["data-rowindex" => $la_bank_account_grid->RowIndex, "id" => "r0_la_bank_account", "data-rowtype" => ROWTYPE_ADD]);
		$la_bank_account->RowAttrs->appendClass("ew-template");
		$la_bank_account->RowType = ROWTYPE_ADD;

		// Render row
		$la_bank_account_grid->renderRow();

		// Render list options
		$la_bank_account_grid->renderListOptions();
		$la_bank_account_grid->StartRowCount = 0;
?>
	<tr <?php echo $la_bank_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$la_bank_account_grid->ListOptions->render("body", "left", $la_bank_account_grid->RowIndex);
?>
	<?php if ($la_bank_account_grid->BankCode->Visible) { // BankCode ?>
		<td data-name="BankCode">
<?php if (!$la_bank_account->isConfirm()) { ?>
<span id="el$rowindex$_la_bank_account_BankCode" class="form-group la_bank_account_BankCode">
<?php
$onchange = $la_bank_account_grid->BankCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_grid->BankCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="sv_x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo RemoveHtml($la_bank_account_grid->BankCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($la_bank_account_grid->BankCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_grid->BankCode->getPlaceHolder()) ?>"<?php echo $la_bank_account_grid->BankCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_grid->BankCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_grid->BankCode->ReadOnly || $la_bank_account_grid->BankCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_grid->BankCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_grid->BankCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountgrid"], function() {
	fla_bank_accountgrid.createAutoSuggest({"id":"x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode","forceSelect":true});
});
</script>
<?php echo $la_bank_account_grid->BankCode->Lookup->getParamTag($la_bank_account_grid, "p_x" . $la_bank_account_grid->RowIndex . "_BankCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_la_bank_account_BankCode" class="form-group la_bank_account_BankCode">
<span<?php echo $la_bank_account_grid->BankCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_grid->BankCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_grid->BankCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" name="o<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" id="o<?php echo $la_bank_account_grid->RowIndex ?>_BankCode" value="<?php echo HtmlEncode($la_bank_account_grid->BankCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($la_bank_account_grid->BranchCode->Visible) { // BranchCode ?>
		<td data-name="BranchCode">
<?php if (!$la_bank_account->isConfirm()) { ?>
<span id="el$rowindex$_la_bank_account_BranchCode" class="form-group la_bank_account_BranchCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode"><?php echo EmptyValue(strval($la_bank_account_grid->BranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $la_bank_account_grid->BranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_grid->BranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_grid->BranchCode->ReadOnly || $la_bank_account_grid->BranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $la_bank_account_grid->BranchCode->Lookup->getParamTag($la_bank_account_grid, "p_x" . $la_bank_account_grid->RowIndex . "_BranchCode") ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_grid->BranchCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" value="<?php echo $la_bank_account_grid->BranchCode->CurrentValue ?>"<?php echo $la_bank_account_grid->BranchCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_la_bank_account_BranchCode" class="form-group la_bank_account_BranchCode">
<span<?php echo $la_bank_account_grid->BranchCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_grid->BranchCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($la_bank_account_grid->BranchCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" name="o<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" id="o<?php echo $la_bank_account_grid->RowIndex ?>_BranchCode" value="<?php echo HtmlEncode($la_bank_account_grid->BranchCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($la_bank_account_grid->AccountName->Visible) { // AccountName ?>
		<td data-name="AccountName">
<?php if (!$la_bank_account->isConfirm()) { ?>
<span id="el$rowindex$_la_bank_account_AccountName" class="form-group la_bank_account_AccountName">
<input type="text" data-table="la_bank_account" data-field="x_AccountName" name="x<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" id="x<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_bank_account_grid->AccountName->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_grid->AccountName->EditValue ?>"<?php echo $la_bank_account_grid->AccountName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_la_bank_account_AccountName" class="form-group la_bank_account_AccountName">
<span<?php echo $la_bank_account_grid->AccountName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_grid->AccountName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_AccountName" name="x<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" id="x<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($la_bank_account_grid->AccountName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="la_bank_account" data-field="x_AccountName" name="o<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" id="o<?php echo $la_bank_account_grid->RowIndex ?>_AccountName" value="<?php echo HtmlEncode($la_bank_account_grid->AccountName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($la_bank_account_grid->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo">
<?php if (!$la_bank_account->isConfirm()) { ?>
<span id="el$rowindex$_la_bank_account_BankAccountNo" class="form-group la_bank_account_BankAccountNo">
<input type="text" data-table="la_bank_account" data-field="x_BankAccountNo" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($la_bank_account_grid->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_grid->BankAccountNo->EditValue ?>"<?php echo $la_bank_account_grid->BankAccountNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_la_bank_account_BankAccountNo" class="form-group la_bank_account_BankAccountNo">
<span<?php echo $la_bank_account_grid->BankAccountNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_grid->BankAccountNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankAccountNo" name="x<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" id="x<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($la_bank_account_grid->BankAccountNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BankAccountNo" name="o<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" id="o<?php echo $la_bank_account_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($la_bank_account_grid->BankAccountNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($la_bank_account_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$la_bank_account->isConfirm()) { ?>
<?php if ($la_bank_account_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_la_bank_account_LACode" class="form-group la_bank_account_LACode">
<span<?php echo $la_bank_account_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" name="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_la_bank_account_LACode" class="form-group la_bank_account_LACode">
<?php
$onchange = $la_bank_account_grid->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_grid->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $la_bank_account_grid->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="sv_x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo RemoveHtml($la_bank_account_grid->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($la_bank_account_grid->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_grid->LACode->getPlaceHolder()) ?>"<?php echo $la_bank_account_grid->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" data-value-separator="<?php echo $la_bank_account_grid->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountgrid"], function() {
	fla_bank_accountgrid.createAutoSuggest({"id":"x<?php echo $la_bank_account_grid->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $la_bank_account_grid->LACode->Lookup->getParamTag($la_bank_account_grid, "p_x" . $la_bank_account_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_la_bank_account_LACode" class="form-group la_bank_account_LACode">
<span<?php echo $la_bank_account_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" name="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="x<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" name="o<?php echo $la_bank_account_grid->RowIndex ?>_LACode" id="o<?php echo $la_bank_account_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($la_bank_account_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$la_bank_account_grid->ListOptions->render("body", "right", $la_bank_account_grid->RowIndex);
?>
<script>
loadjs.ready(["fla_bank_accountgrid", "load"], function() {
	fla_bank_accountgrid.updateLists(<?php echo $la_bank_account_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($la_bank_account->CurrentMode == "add" || $la_bank_account->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $la_bank_account_grid->FormKeyCountName ?>" id="<?php echo $la_bank_account_grid->FormKeyCountName ?>" value="<?php echo $la_bank_account_grid->KeyCount ?>">
<?php echo $la_bank_account_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($la_bank_account->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $la_bank_account_grid->FormKeyCountName ?>" id="<?php echo $la_bank_account_grid->FormKeyCountName ?>" value="<?php echo $la_bank_account_grid->KeyCount ?>">
<?php echo $la_bank_account_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($la_bank_account->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fla_bank_accountgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($la_bank_account_grid->Recordset)
	$la_bank_account_grid->Recordset->Close();
?>
<?php if ($la_bank_account_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $la_bank_account_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($la_bank_account_grid->TotalRecords == 0 && !$la_bank_account->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $la_bank_account_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$la_bank_account_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$la_bank_account_grid->terminate();
?>