<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($accountgroup_grid))
	$accountgroup_grid = new accountgroup_grid();

// Run the page
$accountgroup_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$accountgroup_grid->Page_Render();
?>
<?php if (!$accountgroup_grid->isExport()) { ?>
<script>
var faccountgroupgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	faccountgroupgrid = new ew.Form("faccountgroupgrid", "grid");
	faccountgroupgrid.formKeyCountName = '<?php echo $accountgroup_grid->FormKeyCountName ?>';

	// Validate form
	faccountgroupgrid.validate = function() {
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
			<?php if ($accountgroup_grid->AccountGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accountgroup_grid->AccountGroupCode->caption(), $accountgroup_grid->AccountGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountGroupCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accountgroup_grid->AccountGroupCode->errorMessage()) ?>");
			<?php if ($accountgroup_grid->AccountGroupName->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountGroupName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accountgroup_grid->AccountGroupName->caption(), $accountgroup_grid->AccountGroupName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($accountgroup_grid->AccountType->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accountgroup_grid->AccountType->caption(), $accountgroup_grid->AccountType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accountgroup_grid->AccountType->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	faccountgroupgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "AccountGroupCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountGroupName", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountType", false)) return false;
		return true;
	}

	// Form_CustomValidate
	faccountgroupgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	faccountgroupgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	faccountgroupgrid.lists["x_AccountType"] = <?php echo $accountgroup_grid->AccountType->Lookup->toClientList($accountgroup_grid) ?>;
	faccountgroupgrid.lists["x_AccountType"].options = <?php echo JsonEncode($accountgroup_grid->AccountType->lookupOptions()) ?>;
	faccountgroupgrid.autoSuggests["x_AccountType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("faccountgroupgrid");
});
</script>
<?php } ?>
<?php
$accountgroup_grid->renderOtherOptions();
?>
<?php if ($accountgroup_grid->TotalRecords > 0 || $accountgroup->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($accountgroup_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> accountgroup">
<?php if ($accountgroup_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $accountgroup_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="faccountgroupgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_accountgroup" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_accountgroupgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$accountgroup->RowType = ROWTYPE_HEADER;

// Render list options
$accountgroup_grid->renderListOptions();

// Render list options (header, left)
$accountgroup_grid->ListOptions->render("header", "left");
?>
<?php if ($accountgroup_grid->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<?php if ($accountgroup_grid->SortUrl($accountgroup_grid->AccountGroupCode) == "") { ?>
		<th data-name="AccountGroupCode" class="<?php echo $accountgroup_grid->AccountGroupCode->headerCellClass() ?>"><div id="elh_accountgroup_AccountGroupCode" class="accountgroup_AccountGroupCode"><div class="ew-table-header-caption"><?php echo $accountgroup_grid->AccountGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountGroupCode" class="<?php echo $accountgroup_grid->AccountGroupCode->headerCellClass() ?>"><div><div id="elh_accountgroup_AccountGroupCode" class="accountgroup_AccountGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accountgroup_grid->AccountGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($accountgroup_grid->AccountGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accountgroup_grid->AccountGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accountgroup_grid->AccountGroupName->Visible) { // AccountGroupName ?>
	<?php if ($accountgroup_grid->SortUrl($accountgroup_grid->AccountGroupName) == "") { ?>
		<th data-name="AccountGroupName" class="<?php echo $accountgroup_grid->AccountGroupName->headerCellClass() ?>"><div id="elh_accountgroup_AccountGroupName" class="accountgroup_AccountGroupName"><div class="ew-table-header-caption"><?php echo $accountgroup_grid->AccountGroupName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountGroupName" class="<?php echo $accountgroup_grid->AccountGroupName->headerCellClass() ?>"><div><div id="elh_accountgroup_AccountGroupName" class="accountgroup_AccountGroupName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accountgroup_grid->AccountGroupName->caption() ?></span><span class="ew-table-header-sort"><?php if ($accountgroup_grid->AccountGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accountgroup_grid->AccountGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($accountgroup_grid->AccountType->Visible) { // AccountType ?>
	<?php if ($accountgroup_grid->SortUrl($accountgroup_grid->AccountType) == "") { ?>
		<th data-name="AccountType" class="<?php echo $accountgroup_grid->AccountType->headerCellClass() ?>"><div id="elh_accountgroup_AccountType" class="accountgroup_AccountType"><div class="ew-table-header-caption"><?php echo $accountgroup_grid->AccountType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountType" class="<?php echo $accountgroup_grid->AccountType->headerCellClass() ?>"><div><div id="elh_accountgroup_AccountType" class="accountgroup_AccountType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $accountgroup_grid->AccountType->caption() ?></span><span class="ew-table-header-sort"><?php if ($accountgroup_grid->AccountType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($accountgroup_grid->AccountType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$accountgroup_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$accountgroup_grid->StartRecord = 1;
$accountgroup_grid->StopRecord = $accountgroup_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($accountgroup->isConfirm() || $accountgroup_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($accountgroup_grid->FormKeyCountName) && ($accountgroup_grid->isGridAdd() || $accountgroup_grid->isGridEdit() || $accountgroup->isConfirm())) {
		$accountgroup_grid->KeyCount = $CurrentForm->getValue($accountgroup_grid->FormKeyCountName);
		$accountgroup_grid->StopRecord = $accountgroup_grid->StartRecord + $accountgroup_grid->KeyCount - 1;
	}
}
$accountgroup_grid->RecordCount = $accountgroup_grid->StartRecord - 1;
if ($accountgroup_grid->Recordset && !$accountgroup_grid->Recordset->EOF) {
	$accountgroup_grid->Recordset->moveFirst();
	$selectLimit = $accountgroup_grid->UseSelectLimit;
	if (!$selectLimit && $accountgroup_grid->StartRecord > 1)
		$accountgroup_grid->Recordset->move($accountgroup_grid->StartRecord - 1);
} elseif (!$accountgroup->AllowAddDeleteRow && $accountgroup_grid->StopRecord == 0) {
	$accountgroup_grid->StopRecord = $accountgroup->GridAddRowCount;
}

// Initialize aggregate
$accountgroup->RowType = ROWTYPE_AGGREGATEINIT;
$accountgroup->resetAttributes();
$accountgroup_grid->renderRow();
if ($accountgroup_grid->isGridAdd())
	$accountgroup_grid->RowIndex = 0;
if ($accountgroup_grid->isGridEdit())
	$accountgroup_grid->RowIndex = 0;
while ($accountgroup_grid->RecordCount < $accountgroup_grid->StopRecord) {
	$accountgroup_grid->RecordCount++;
	if ($accountgroup_grid->RecordCount >= $accountgroup_grid->StartRecord) {
		$accountgroup_grid->RowCount++;
		if ($accountgroup_grid->isGridAdd() || $accountgroup_grid->isGridEdit() || $accountgroup->isConfirm()) {
			$accountgroup_grid->RowIndex++;
			$CurrentForm->Index = $accountgroup_grid->RowIndex;
			if ($CurrentForm->hasValue($accountgroup_grid->FormActionName) && ($accountgroup->isConfirm() || $accountgroup_grid->EventCancelled))
				$accountgroup_grid->RowAction = strval($CurrentForm->getValue($accountgroup_grid->FormActionName));
			elseif ($accountgroup_grid->isGridAdd())
				$accountgroup_grid->RowAction = "insert";
			else
				$accountgroup_grid->RowAction = "";
		}

		// Set up key count
		$accountgroup_grid->KeyCount = $accountgroup_grid->RowIndex;

		// Init row class and style
		$accountgroup->resetAttributes();
		$accountgroup->CssClass = "";
		if ($accountgroup_grid->isGridAdd()) {
			if ($accountgroup->CurrentMode == "copy") {
				$accountgroup_grid->loadRowValues($accountgroup_grid->Recordset); // Load row values
				$accountgroup_grid->setRecordKey($accountgroup_grid->RowOldKey, $accountgroup_grid->Recordset); // Set old record key
			} else {
				$accountgroup_grid->loadRowValues(); // Load default values
				$accountgroup_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$accountgroup_grid->loadRowValues($accountgroup_grid->Recordset); // Load row values
		}
		$accountgroup->RowType = ROWTYPE_VIEW; // Render view
		if ($accountgroup_grid->isGridAdd()) // Grid add
			$accountgroup->RowType = ROWTYPE_ADD; // Render add
		if ($accountgroup_grid->isGridAdd() && $accountgroup->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$accountgroup_grid->restoreCurrentRowFormValues($accountgroup_grid->RowIndex); // Restore form values
		if ($accountgroup_grid->isGridEdit()) { // Grid edit
			if ($accountgroup->EventCancelled)
				$accountgroup_grid->restoreCurrentRowFormValues($accountgroup_grid->RowIndex); // Restore form values
			if ($accountgroup_grid->RowAction == "insert")
				$accountgroup->RowType = ROWTYPE_ADD; // Render add
			else
				$accountgroup->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($accountgroup_grid->isGridEdit() && ($accountgroup->RowType == ROWTYPE_EDIT || $accountgroup->RowType == ROWTYPE_ADD) && $accountgroup->EventCancelled) // Update failed
			$accountgroup_grid->restoreCurrentRowFormValues($accountgroup_grid->RowIndex); // Restore form values
		if ($accountgroup->RowType == ROWTYPE_EDIT) // Edit row
			$accountgroup_grid->EditRowCount++;
		if ($accountgroup->isConfirm()) // Confirm row
			$accountgroup_grid->restoreCurrentRowFormValues($accountgroup_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$accountgroup->RowAttrs->merge(["data-rowindex" => $accountgroup_grid->RowCount, "id" => "r" . $accountgroup_grid->RowCount . "_accountgroup", "data-rowtype" => $accountgroup->RowType]);

		// Render row
		$accountgroup_grid->renderRow();

		// Render list options
		$accountgroup_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($accountgroup_grid->RowAction != "delete" && $accountgroup_grid->RowAction != "insertdelete" && !($accountgroup_grid->RowAction == "insert" && $accountgroup->isConfirm() && $accountgroup_grid->emptyRow())) {
?>
	<tr <?php echo $accountgroup->rowAttributes() ?>>
<?php

// Render list options (body, left)
$accountgroup_grid->ListOptions->render("body", "left", $accountgroup_grid->RowCount);
?>
	<?php if ($accountgroup_grid->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<td data-name="AccountGroupCode" <?php echo $accountgroup_grid->AccountGroupCode->cellAttributes() ?>>
<?php if ($accountgroup->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $accountgroup_grid->RowCount ?>_accountgroup_AccountGroupCode" class="form-group">
<input type="text" data-table="accountgroup" data-field="x_AccountGroupCode" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" size="30" placeholder="<?php echo HtmlEncode($accountgroup_grid->AccountGroupCode->getPlaceHolder()) ?>" value="<?php echo $accountgroup_grid->AccountGroupCode->EditValue ?>"<?php echo $accountgroup_grid->AccountGroupCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupCode" name="o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" id="o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupCode->OldValue) ?>">
<?php } ?>
<?php if ($accountgroup->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $accountgroup_grid->RowCount ?>_accountgroup_AccountGroupCode" class="form-group">
<input type="text" data-table="accountgroup" data-field="x_AccountGroupCode" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" size="30" placeholder="<?php echo HtmlEncode($accountgroup_grid->AccountGroupCode->getPlaceHolder()) ?>" value="<?php echo $accountgroup_grid->AccountGroupCode->EditValue ?>"<?php echo $accountgroup_grid->AccountGroupCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($accountgroup->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $accountgroup_grid->RowCount ?>_accountgroup_AccountGroupCode">
<span<?php echo $accountgroup_grid->AccountGroupCode->viewAttributes() ?>><?php echo $accountgroup_grid->AccountGroupCode->getViewValue() ?></span>
</span>
<?php if (!$accountgroup->isConfirm()) { ?>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupCode" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupCode->FormValue) ?>">
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupCode" name="o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" id="o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupCode" name="faccountgroupgrid$x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" id="faccountgroupgrid$x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupCode->FormValue) ?>">
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupCode" name="faccountgroupgrid$o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" id="faccountgroupgrid$o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($accountgroup_grid->AccountGroupName->Visible) { // AccountGroupName ?>
		<td data-name="AccountGroupName" <?php echo $accountgroup_grid->AccountGroupName->cellAttributes() ?>>
<?php if ($accountgroup->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $accountgroup_grid->RowCount ?>_accountgroup_AccountGroupName" class="form-group">
<input type="text" data-table="accountgroup" data-field="x_AccountGroupName" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($accountgroup_grid->AccountGroupName->getPlaceHolder()) ?>" value="<?php echo $accountgroup_grid->AccountGroupName->EditValue ?>"<?php echo $accountgroup_grid->AccountGroupName->editAttributes() ?>>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupName" name="o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" id="o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupName->OldValue) ?>">
<?php } ?>
<?php if ($accountgroup->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $accountgroup_grid->RowCount ?>_accountgroup_AccountGroupName" class="form-group">
<input type="text" data-table="accountgroup" data-field="x_AccountGroupName" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($accountgroup_grid->AccountGroupName->getPlaceHolder()) ?>" value="<?php echo $accountgroup_grid->AccountGroupName->EditValue ?>"<?php echo $accountgroup_grid->AccountGroupName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($accountgroup->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $accountgroup_grid->RowCount ?>_accountgroup_AccountGroupName">
<span<?php echo $accountgroup_grid->AccountGroupName->viewAttributes() ?>><?php echo $accountgroup_grid->AccountGroupName->getViewValue() ?></span>
</span>
<?php if (!$accountgroup->isConfirm()) { ?>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupName" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupName->FormValue) ?>">
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupName" name="o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" id="o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupName" name="faccountgroupgrid$x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" id="faccountgroupgrid$x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupName->FormValue) ?>">
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupName" name="faccountgroupgrid$o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" id="faccountgroupgrid$o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($accountgroup_grid->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType" <?php echo $accountgroup_grid->AccountType->cellAttributes() ?>>
<?php if ($accountgroup->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($accountgroup_grid->AccountType->getSessionValue() != "") { ?>
<span id="el<?php echo $accountgroup_grid->RowCount ?>_accountgroup_AccountType" class="form-group">
<span<?php echo $accountgroup_grid->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($accountgroup_grid->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $accountgroup_grid->RowCount ?>_accountgroup_AccountType" class="form-group">
<?php
$onchange = $accountgroup_grid->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$accountgroup_grid->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $accountgroup_grid->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="sv_x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($accountgroup_grid->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($accountgroup_grid->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($accountgroup_grid->AccountType->getPlaceHolder()) ?>"<?php echo $accountgroup_grid->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($accountgroup_grid->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $accountgroup_grid->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($accountgroup_grid->AccountType->ReadOnly || $accountgroup_grid->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $accountgroup_grid->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccountgroupgrid"], function() {
	faccountgroupgrid.createAutoSuggest({"id":"x<?php echo $accountgroup_grid->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $accountgroup_grid->AccountType->Lookup->getParamTag($accountgroup_grid, "p_x" . $accountgroup_grid->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" name="o<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="o<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->OldValue) ?>">
<?php } ?>
<?php if ($accountgroup->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($accountgroup_grid->AccountType->getSessionValue() != "") { ?>
<span id="el<?php echo $accountgroup_grid->RowCount ?>_accountgroup_AccountType" class="form-group">
<span<?php echo $accountgroup_grid->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($accountgroup_grid->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $accountgroup_grid->RowCount ?>_accountgroup_AccountType" class="form-group">
<?php
$onchange = $accountgroup_grid->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$accountgroup_grid->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $accountgroup_grid->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="sv_x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($accountgroup_grid->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($accountgroup_grid->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($accountgroup_grid->AccountType->getPlaceHolder()) ?>"<?php echo $accountgroup_grid->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($accountgroup_grid->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $accountgroup_grid->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($accountgroup_grid->AccountType->ReadOnly || $accountgroup_grid->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $accountgroup_grid->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccountgroupgrid"], function() {
	faccountgroupgrid.createAutoSuggest({"id":"x<?php echo $accountgroup_grid->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $accountgroup_grid->AccountType->Lookup->getParamTag($accountgroup_grid, "p_x" . $accountgroup_grid->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($accountgroup->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $accountgroup_grid->RowCount ?>_accountgroup_AccountType">
<span<?php echo $accountgroup_grid->AccountType->viewAttributes() ?>><?php echo $accountgroup_grid->AccountType->getViewValue() ?></span>
</span>
<?php if (!$accountgroup->isConfirm()) { ?>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->FormValue) ?>">
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" name="o<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="o<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" name="faccountgroupgrid$x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="faccountgroupgrid$x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->FormValue) ?>">
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" name="faccountgroupgrid$o<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="faccountgroupgrid$o<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$accountgroup_grid->ListOptions->render("body", "right", $accountgroup_grid->RowCount);
?>
	</tr>
<?php if ($accountgroup->RowType == ROWTYPE_ADD || $accountgroup->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["faccountgroupgrid", "load"], function() {
	faccountgroupgrid.updateLists(<?php echo $accountgroup_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$accountgroup_grid->isGridAdd() || $accountgroup->CurrentMode == "copy")
		if (!$accountgroup_grid->Recordset->EOF)
			$accountgroup_grid->Recordset->moveNext();
}
?>
<?php
	if ($accountgroup->CurrentMode == "add" || $accountgroup->CurrentMode == "copy" || $accountgroup->CurrentMode == "edit") {
		$accountgroup_grid->RowIndex = '$rowindex$';
		$accountgroup_grid->loadRowValues();

		// Set row properties
		$accountgroup->resetAttributes();
		$accountgroup->RowAttrs->merge(["data-rowindex" => $accountgroup_grid->RowIndex, "id" => "r0_accountgroup", "data-rowtype" => ROWTYPE_ADD]);
		$accountgroup->RowAttrs->appendClass("ew-template");
		$accountgroup->RowType = ROWTYPE_ADD;

		// Render row
		$accountgroup_grid->renderRow();

		// Render list options
		$accountgroup_grid->renderListOptions();
		$accountgroup_grid->StartRowCount = 0;
?>
	<tr <?php echo $accountgroup->rowAttributes() ?>>
<?php

// Render list options (body, left)
$accountgroup_grid->ListOptions->render("body", "left", $accountgroup_grid->RowIndex);
?>
	<?php if ($accountgroup_grid->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<td data-name="AccountGroupCode">
<?php if (!$accountgroup->isConfirm()) { ?>
<span id="el$rowindex$_accountgroup_AccountGroupCode" class="form-group accountgroup_AccountGroupCode">
<input type="text" data-table="accountgroup" data-field="x_AccountGroupCode" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" size="30" placeholder="<?php echo HtmlEncode($accountgroup_grid->AccountGroupCode->getPlaceHolder()) ?>" value="<?php echo $accountgroup_grid->AccountGroupCode->EditValue ?>"<?php echo $accountgroup_grid->AccountGroupCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_accountgroup_AccountGroupCode" class="form-group accountgroup_AccountGroupCode">
<span<?php echo $accountgroup_grid->AccountGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($accountgroup_grid->AccountGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupCode" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupCode" name="o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" id="o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($accountgroup_grid->AccountGroupName->Visible) { // AccountGroupName ?>
		<td data-name="AccountGroupName">
<?php if (!$accountgroup->isConfirm()) { ?>
<span id="el$rowindex$_accountgroup_AccountGroupName" class="form-group accountgroup_AccountGroupName">
<input type="text" data-table="accountgroup" data-field="x_AccountGroupName" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($accountgroup_grid->AccountGroupName->getPlaceHolder()) ?>" value="<?php echo $accountgroup_grid->AccountGroupName->EditValue ?>"<?php echo $accountgroup_grid->AccountGroupName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_accountgroup_AccountGroupName" class="form-group accountgroup_AccountGroupName">
<span<?php echo $accountgroup_grid->AccountGroupName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($accountgroup_grid->AccountGroupName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupName" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="accountgroup" data-field="x_AccountGroupName" name="o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" id="o<?php echo $accountgroup_grid->RowIndex ?>_AccountGroupName" value="<?php echo HtmlEncode($accountgroup_grid->AccountGroupName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($accountgroup_grid->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType">
<?php if (!$accountgroup->isConfirm()) { ?>
<?php if ($accountgroup_grid->AccountType->getSessionValue() != "") { ?>
<span id="el$rowindex$_accountgroup_AccountType" class="form-group accountgroup_AccountType">
<span<?php echo $accountgroup_grid->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($accountgroup_grid->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_accountgroup_AccountType" class="form-group accountgroup_AccountType">
<?php
$onchange = $accountgroup_grid->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$accountgroup_grid->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $accountgroup_grid->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="sv_x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($accountgroup_grid->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($accountgroup_grid->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($accountgroup_grid->AccountType->getPlaceHolder()) ?>"<?php echo $accountgroup_grid->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($accountgroup_grid->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $accountgroup_grid->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($accountgroup_grid->AccountType->ReadOnly || $accountgroup_grid->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $accountgroup_grid->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccountgroupgrid"], function() {
	faccountgroupgrid.createAutoSuggest({"id":"x<?php echo $accountgroup_grid->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $accountgroup_grid->AccountType->Lookup->getParamTag($accountgroup_grid, "p_x" . $accountgroup_grid->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_accountgroup_AccountType" class="form-group accountgroup_AccountType">
<span<?php echo $accountgroup_grid->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($accountgroup_grid->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" name="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="x<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" name="o<?php echo $accountgroup_grid->RowIndex ?>_AccountType" id="o<?php echo $accountgroup_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($accountgroup_grid->AccountType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$accountgroup_grid->ListOptions->render("body", "right", $accountgroup_grid->RowIndex);
?>
<script>
loadjs.ready(["faccountgroupgrid", "load"], function() {
	faccountgroupgrid.updateLists(<?php echo $accountgroup_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($accountgroup->CurrentMode == "add" || $accountgroup->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $accountgroup_grid->FormKeyCountName ?>" id="<?php echo $accountgroup_grid->FormKeyCountName ?>" value="<?php echo $accountgroup_grid->KeyCount ?>">
<?php echo $accountgroup_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($accountgroup->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $accountgroup_grid->FormKeyCountName ?>" id="<?php echo $accountgroup_grid->FormKeyCountName ?>" value="<?php echo $accountgroup_grid->KeyCount ?>">
<?php echo $accountgroup_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($accountgroup->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="faccountgroupgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($accountgroup_grid->Recordset)
	$accountgroup_grid->Recordset->Close();
?>
<?php if ($accountgroup_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $accountgroup_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($accountgroup_grid->TotalRecords == 0 && !$accountgroup->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $accountgroup_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$accountgroup_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$accountgroup_grid->terminate();
?>