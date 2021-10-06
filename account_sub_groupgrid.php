<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($account_sub_group_grid))
	$account_sub_group_grid = new account_sub_group_grid();

// Run the page
$account_sub_group_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$account_sub_group_grid->Page_Render();
?>
<?php if (!$account_sub_group_grid->isExport()) { ?>
<script>
var faccount_sub_groupgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	faccount_sub_groupgrid = new ew.Form("faccount_sub_groupgrid", "grid");
	faccount_sub_groupgrid.formKeyCountName = '<?php echo $account_sub_group_grid->FormKeyCountName ?>';

	// Validate form
	faccount_sub_groupgrid.validate = function() {
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
			<?php if ($account_sub_group_grid->AccountType->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $account_sub_group_grid->AccountType->caption(), $account_sub_group_grid->AccountType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($account_sub_group_grid->AccountType->errorMessage()) ?>");
			<?php if ($account_sub_group_grid->AccountGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $account_sub_group_grid->AccountGroupCode->caption(), $account_sub_group_grid->AccountGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountGroupCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($account_sub_group_grid->AccountGroupCode->errorMessage()) ?>");
			<?php if ($account_sub_group_grid->AccountSubGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountSubGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $account_sub_group_grid->AccountSubGroupCode->caption(), $account_sub_group_grid->AccountSubGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountSubGroupCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($account_sub_group_grid->AccountSubGroupCode->errorMessage()) ?>");
			<?php if ($account_sub_group_grid->AccountSubGroupName->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountSubGroupName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $account_sub_group_grid->AccountSubGroupName->caption(), $account_sub_group_grid->AccountSubGroupName->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	faccount_sub_groupgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "AccountType", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountGroupCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountSubGroupCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountSubGroupName", false)) return false;
		return true;
	}

	// Form_CustomValidate
	faccount_sub_groupgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	faccount_sub_groupgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	faccount_sub_groupgrid.lists["x_AccountType"] = <?php echo $account_sub_group_grid->AccountType->Lookup->toClientList($account_sub_group_grid) ?>;
	faccount_sub_groupgrid.lists["x_AccountType"].options = <?php echo JsonEncode($account_sub_group_grid->AccountType->lookupOptions()) ?>;
	faccount_sub_groupgrid.autoSuggests["x_AccountType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	faccount_sub_groupgrid.lists["x_AccountGroupCode"] = <?php echo $account_sub_group_grid->AccountGroupCode->Lookup->toClientList($account_sub_group_grid) ?>;
	faccount_sub_groupgrid.lists["x_AccountGroupCode"].options = <?php echo JsonEncode($account_sub_group_grid->AccountGroupCode->lookupOptions()) ?>;
	faccount_sub_groupgrid.autoSuggests["x_AccountGroupCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	faccount_sub_groupgrid.lists["x_AccountSubGroupCode"] = <?php echo $account_sub_group_grid->AccountSubGroupCode->Lookup->toClientList($account_sub_group_grid) ?>;
	faccount_sub_groupgrid.lists["x_AccountSubGroupCode"].options = <?php echo JsonEncode($account_sub_group_grid->AccountSubGroupCode->lookupOptions()) ?>;
	faccount_sub_groupgrid.autoSuggests["x_AccountSubGroupCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("faccount_sub_groupgrid");
});
</script>
<?php } ?>
<?php
$account_sub_group_grid->renderOtherOptions();
?>
<?php if ($account_sub_group_grid->TotalRecords > 0 || $account_sub_group->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($account_sub_group_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> account_sub_group">
<?php if ($account_sub_group_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $account_sub_group_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="faccount_sub_groupgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_account_sub_group" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_account_sub_groupgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$account_sub_group->RowType = ROWTYPE_HEADER;

// Render list options
$account_sub_group_grid->renderListOptions();

// Render list options (header, left)
$account_sub_group_grid->ListOptions->render("header", "left");
?>
<?php if ($account_sub_group_grid->AccountType->Visible) { // AccountType ?>
	<?php if ($account_sub_group_grid->SortUrl($account_sub_group_grid->AccountType) == "") { ?>
		<th data-name="AccountType" class="<?php echo $account_sub_group_grid->AccountType->headerCellClass() ?>"><div id="elh_account_sub_group_AccountType" class="account_sub_group_AccountType"><div class="ew-table-header-caption"><?php echo $account_sub_group_grid->AccountType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountType" class="<?php echo $account_sub_group_grid->AccountType->headerCellClass() ?>"><div><div id="elh_account_sub_group_AccountType" class="account_sub_group_AccountType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_sub_group_grid->AccountType->caption() ?></span><span class="ew-table-header-sort"><?php if ($account_sub_group_grid->AccountType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_sub_group_grid->AccountType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($account_sub_group_grid->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<?php if ($account_sub_group_grid->SortUrl($account_sub_group_grid->AccountGroupCode) == "") { ?>
		<th data-name="AccountGroupCode" class="<?php echo $account_sub_group_grid->AccountGroupCode->headerCellClass() ?>"><div id="elh_account_sub_group_AccountGroupCode" class="account_sub_group_AccountGroupCode"><div class="ew-table-header-caption"><?php echo $account_sub_group_grid->AccountGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountGroupCode" class="<?php echo $account_sub_group_grid->AccountGroupCode->headerCellClass() ?>"><div><div id="elh_account_sub_group_AccountGroupCode" class="account_sub_group_AccountGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_sub_group_grid->AccountGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($account_sub_group_grid->AccountGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_sub_group_grid->AccountGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($account_sub_group_grid->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
	<?php if ($account_sub_group_grid->SortUrl($account_sub_group_grid->AccountSubGroupCode) == "") { ?>
		<th data-name="AccountSubGroupCode" class="<?php echo $account_sub_group_grid->AccountSubGroupCode->headerCellClass() ?>"><div id="elh_account_sub_group_AccountSubGroupCode" class="account_sub_group_AccountSubGroupCode"><div class="ew-table-header-caption"><?php echo $account_sub_group_grid->AccountSubGroupCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountSubGroupCode" class="<?php echo $account_sub_group_grid->AccountSubGroupCode->headerCellClass() ?>"><div><div id="elh_account_sub_group_AccountSubGroupCode" class="account_sub_group_AccountSubGroupCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_sub_group_grid->AccountSubGroupCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($account_sub_group_grid->AccountSubGroupCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_sub_group_grid->AccountSubGroupCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($account_sub_group_grid->AccountSubGroupName->Visible) { // AccountSubGroupName ?>
	<?php if ($account_sub_group_grid->SortUrl($account_sub_group_grid->AccountSubGroupName) == "") { ?>
		<th data-name="AccountSubGroupName" class="<?php echo $account_sub_group_grid->AccountSubGroupName->headerCellClass() ?>"><div id="elh_account_sub_group_AccountSubGroupName" class="account_sub_group_AccountSubGroupName"><div class="ew-table-header-caption"><?php echo $account_sub_group_grid->AccountSubGroupName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountSubGroupName" class="<?php echo $account_sub_group_grid->AccountSubGroupName->headerCellClass() ?>"><div><div id="elh_account_sub_group_AccountSubGroupName" class="account_sub_group_AccountSubGroupName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_sub_group_grid->AccountSubGroupName->caption() ?></span><span class="ew-table-header-sort"><?php if ($account_sub_group_grid->AccountSubGroupName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_sub_group_grid->AccountSubGroupName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$account_sub_group_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$account_sub_group_grid->StartRecord = 1;
$account_sub_group_grid->StopRecord = $account_sub_group_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($account_sub_group->isConfirm() || $account_sub_group_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($account_sub_group_grid->FormKeyCountName) && ($account_sub_group_grid->isGridAdd() || $account_sub_group_grid->isGridEdit() || $account_sub_group->isConfirm())) {
		$account_sub_group_grid->KeyCount = $CurrentForm->getValue($account_sub_group_grid->FormKeyCountName);
		$account_sub_group_grid->StopRecord = $account_sub_group_grid->StartRecord + $account_sub_group_grid->KeyCount - 1;
	}
}
$account_sub_group_grid->RecordCount = $account_sub_group_grid->StartRecord - 1;
if ($account_sub_group_grid->Recordset && !$account_sub_group_grid->Recordset->EOF) {
	$account_sub_group_grid->Recordset->moveFirst();
	$selectLimit = $account_sub_group_grid->UseSelectLimit;
	if (!$selectLimit && $account_sub_group_grid->StartRecord > 1)
		$account_sub_group_grid->Recordset->move($account_sub_group_grid->StartRecord - 1);
} elseif (!$account_sub_group->AllowAddDeleteRow && $account_sub_group_grid->StopRecord == 0) {
	$account_sub_group_grid->StopRecord = $account_sub_group->GridAddRowCount;
}

// Initialize aggregate
$account_sub_group->RowType = ROWTYPE_AGGREGATEINIT;
$account_sub_group->resetAttributes();
$account_sub_group_grid->renderRow();
if ($account_sub_group_grid->isGridAdd())
	$account_sub_group_grid->RowIndex = 0;
if ($account_sub_group_grid->isGridEdit())
	$account_sub_group_grid->RowIndex = 0;
while ($account_sub_group_grid->RecordCount < $account_sub_group_grid->StopRecord) {
	$account_sub_group_grid->RecordCount++;
	if ($account_sub_group_grid->RecordCount >= $account_sub_group_grid->StartRecord) {
		$account_sub_group_grid->RowCount++;
		if ($account_sub_group_grid->isGridAdd() || $account_sub_group_grid->isGridEdit() || $account_sub_group->isConfirm()) {
			$account_sub_group_grid->RowIndex++;
			$CurrentForm->Index = $account_sub_group_grid->RowIndex;
			if ($CurrentForm->hasValue($account_sub_group_grid->FormActionName) && ($account_sub_group->isConfirm() || $account_sub_group_grid->EventCancelled))
				$account_sub_group_grid->RowAction = strval($CurrentForm->getValue($account_sub_group_grid->FormActionName));
			elseif ($account_sub_group_grid->isGridAdd())
				$account_sub_group_grid->RowAction = "insert";
			else
				$account_sub_group_grid->RowAction = "";
		}

		// Set up key count
		$account_sub_group_grid->KeyCount = $account_sub_group_grid->RowIndex;

		// Init row class and style
		$account_sub_group->resetAttributes();
		$account_sub_group->CssClass = "";
		if ($account_sub_group_grid->isGridAdd()) {
			if ($account_sub_group->CurrentMode == "copy") {
				$account_sub_group_grid->loadRowValues($account_sub_group_grid->Recordset); // Load row values
				$account_sub_group_grid->setRecordKey($account_sub_group_grid->RowOldKey, $account_sub_group_grid->Recordset); // Set old record key
			} else {
				$account_sub_group_grid->loadRowValues(); // Load default values
				$account_sub_group_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$account_sub_group_grid->loadRowValues($account_sub_group_grid->Recordset); // Load row values
		}
		$account_sub_group->RowType = ROWTYPE_VIEW; // Render view
		if ($account_sub_group_grid->isGridAdd()) // Grid add
			$account_sub_group->RowType = ROWTYPE_ADD; // Render add
		if ($account_sub_group_grid->isGridAdd() && $account_sub_group->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$account_sub_group_grid->restoreCurrentRowFormValues($account_sub_group_grid->RowIndex); // Restore form values
		if ($account_sub_group_grid->isGridEdit()) { // Grid edit
			if ($account_sub_group->EventCancelled)
				$account_sub_group_grid->restoreCurrentRowFormValues($account_sub_group_grid->RowIndex); // Restore form values
			if ($account_sub_group_grid->RowAction == "insert")
				$account_sub_group->RowType = ROWTYPE_ADD; // Render add
			else
				$account_sub_group->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($account_sub_group_grid->isGridEdit() && ($account_sub_group->RowType == ROWTYPE_EDIT || $account_sub_group->RowType == ROWTYPE_ADD) && $account_sub_group->EventCancelled) // Update failed
			$account_sub_group_grid->restoreCurrentRowFormValues($account_sub_group_grid->RowIndex); // Restore form values
		if ($account_sub_group->RowType == ROWTYPE_EDIT) // Edit row
			$account_sub_group_grid->EditRowCount++;
		if ($account_sub_group->isConfirm()) // Confirm row
			$account_sub_group_grid->restoreCurrentRowFormValues($account_sub_group_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$account_sub_group->RowAttrs->merge(["data-rowindex" => $account_sub_group_grid->RowCount, "id" => "r" . $account_sub_group_grid->RowCount . "_account_sub_group", "data-rowtype" => $account_sub_group->RowType]);

		// Render row
		$account_sub_group_grid->renderRow();

		// Render list options
		$account_sub_group_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($account_sub_group_grid->RowAction != "delete" && $account_sub_group_grid->RowAction != "insertdelete" && !($account_sub_group_grid->RowAction == "insert" && $account_sub_group->isConfirm() && $account_sub_group_grid->emptyRow())) {
?>
	<tr <?php echo $account_sub_group->rowAttributes() ?>>
<?php

// Render list options (body, left)
$account_sub_group_grid->ListOptions->render("body", "left", $account_sub_group_grid->RowCount);
?>
	<?php if ($account_sub_group_grid->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType" <?php echo $account_sub_group_grid->AccountType->cellAttributes() ?>>
<?php if ($account_sub_group->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($account_sub_group_grid->AccountType->getSessionValue() != "") { ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountType" class="form-group">
<span<?php echo $account_sub_group_grid->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($account_sub_group_grid->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountType" class="form-group">
<?php
$onchange = $account_sub_group_grid->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$account_sub_group_grid->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($account_sub_group_grid->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountType->getPlaceHolder()) ?>"<?php echo $account_sub_group_grid->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($account_sub_group_grid->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($account_sub_group_grid->AccountType->ReadOnly || $account_sub_group_grid->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $account_sub_group_grid->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccount_sub_groupgrid"], function() {
	faccount_sub_groupgrid.createAutoSuggest({"id":"x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $account_sub_group_grid->AccountType->Lookup->getParamTag($account_sub_group_grid, "p_x" . $account_sub_group_grid->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountType" name="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->OldValue) ?>">
<?php } ?>
<?php if ($account_sub_group->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($account_sub_group_grid->AccountType->getSessionValue() != "") { ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountType" class="form-group">
<span<?php echo $account_sub_group_grid->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($account_sub_group_grid->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountType" class="form-group">
<?php
$onchange = $account_sub_group_grid->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$account_sub_group_grid->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($account_sub_group_grid->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountType->getPlaceHolder()) ?>"<?php echo $account_sub_group_grid->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($account_sub_group_grid->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($account_sub_group_grid->AccountType->ReadOnly || $account_sub_group_grid->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $account_sub_group_grid->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccount_sub_groupgrid"], function() {
	faccount_sub_groupgrid.createAutoSuggest({"id":"x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $account_sub_group_grid->AccountType->Lookup->getParamTag($account_sub_group_grid, "p_x" . $account_sub_group_grid->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($account_sub_group->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountType">
<span<?php echo $account_sub_group_grid->AccountType->viewAttributes() ?>><?php echo $account_sub_group_grid->AccountType->getViewValue() ?></span>
</span>
<?php if (!$account_sub_group->isConfirm()) { ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountType" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->FormValue) ?>">
<input type="hidden" data-table="account_sub_group" data-field="x_AccountType" name="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountType" name="faccount_sub_groupgrid$x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="faccount_sub_groupgrid$x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->FormValue) ?>">
<input type="hidden" data-table="account_sub_group" data-field="x_AccountType" name="faccount_sub_groupgrid$o<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="faccount_sub_groupgrid$o<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($account_sub_group_grid->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<td data-name="AccountGroupCode" <?php echo $account_sub_group_grid->AccountGroupCode->cellAttributes() ?>>
<?php if ($account_sub_group->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($account_sub_group_grid->AccountGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountGroupCode" class="form-group">
<span<?php echo $account_sub_group_grid->AccountGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($account_sub_group_grid->AccountGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountGroupCode" class="form-group">
<?php
$onchange = $account_sub_group_grid->AccountGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$account_sub_group_grid->AccountGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo RemoveHtml($account_sub_group_grid->AccountGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->getPlaceHolder()) ?>"<?php echo $account_sub_group_grid->AccountGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($account_sub_group_grid->AccountGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($account_sub_group_grid->AccountGroupCode->ReadOnly || $account_sub_group_grid->AccountGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $account_sub_group_grid->AccountGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccount_sub_groupgrid"], function() {
	faccount_sub_groupgrid.createAutoSuggest({"id":"x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode","forceSelect":false});
});
</script>
<?php echo $account_sub_group_grid->AccountGroupCode->Lookup->getParamTag($account_sub_group_grid, "p_x" . $account_sub_group_grid->RowIndex . "_AccountGroupCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountGroupCode" name="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->OldValue) ?>">
<?php } ?>
<?php if ($account_sub_group->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($account_sub_group_grid->AccountGroupCode->getSessionValue() != "") { ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountGroupCode" class="form-group">
<span<?php echo $account_sub_group_grid->AccountGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($account_sub_group_grid->AccountGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountGroupCode" class="form-group">
<?php
$onchange = $account_sub_group_grid->AccountGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$account_sub_group_grid->AccountGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo RemoveHtml($account_sub_group_grid->AccountGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->getPlaceHolder()) ?>"<?php echo $account_sub_group_grid->AccountGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($account_sub_group_grid->AccountGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($account_sub_group_grid->AccountGroupCode->ReadOnly || $account_sub_group_grid->AccountGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $account_sub_group_grid->AccountGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccount_sub_groupgrid"], function() {
	faccount_sub_groupgrid.createAutoSuggest({"id":"x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode","forceSelect":false});
});
</script>
<?php echo $account_sub_group_grid->AccountGroupCode->Lookup->getParamTag($account_sub_group_grid, "p_x" . $account_sub_group_grid->RowIndex . "_AccountGroupCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($account_sub_group->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountGroupCode">
<span<?php echo $account_sub_group_grid->AccountGroupCode->viewAttributes() ?>><?php echo $account_sub_group_grid->AccountGroupCode->getViewValue() ?></span>
</span>
<?php if (!$account_sub_group->isConfirm()) { ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountGroupCode" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->FormValue) ?>">
<input type="hidden" data-table="account_sub_group" data-field="x_AccountGroupCode" name="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountGroupCode" name="faccount_sub_groupgrid$x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="faccount_sub_groupgrid$x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->FormValue) ?>">
<input type="hidden" data-table="account_sub_group" data-field="x_AccountGroupCode" name="faccount_sub_groupgrid$o<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="faccount_sub_groupgrid$o<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($account_sub_group_grid->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
		<td data-name="AccountSubGroupCode" <?php echo $account_sub_group_grid->AccountSubGroupCode->cellAttributes() ?>>
<?php if ($account_sub_group->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountSubGroupCode" class="form-group">
<?php
$onchange = $account_sub_group_grid->AccountSubGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$account_sub_group_grid->AccountSubGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo RemoveHtml($account_sub_group_grid->AccountSubGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->getPlaceHolder()) ?>"<?php echo $account_sub_group_grid->AccountSubGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($account_sub_group_grid->AccountSubGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($account_sub_group_grid->AccountSubGroupCode->ReadOnly || $account_sub_group_grid->AccountSubGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $account_sub_group_grid->AccountSubGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccount_sub_groupgrid"], function() {
	faccount_sub_groupgrid.createAutoSuggest({"id":"x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode","forceSelect":false});
});
</script>
<?php echo $account_sub_group_grid->AccountSubGroupCode->Lookup->getParamTag($account_sub_group_grid, "p_x" . $account_sub_group_grid->RowIndex . "_AccountSubGroupCode") ?>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupCode" name="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->OldValue) ?>">
<?php } ?>
<?php if ($account_sub_group->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountSubGroupCode" class="form-group">
<?php
$onchange = $account_sub_group_grid->AccountSubGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$account_sub_group_grid->AccountSubGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo RemoveHtml($account_sub_group_grid->AccountSubGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->getPlaceHolder()) ?>"<?php echo $account_sub_group_grid->AccountSubGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($account_sub_group_grid->AccountSubGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($account_sub_group_grid->AccountSubGroupCode->ReadOnly || $account_sub_group_grid->AccountSubGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $account_sub_group_grid->AccountSubGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccount_sub_groupgrid"], function() {
	faccount_sub_groupgrid.createAutoSuggest({"id":"x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode","forceSelect":false});
});
</script>
<?php echo $account_sub_group_grid->AccountSubGroupCode->Lookup->getParamTag($account_sub_group_grid, "p_x" . $account_sub_group_grid->RowIndex . "_AccountSubGroupCode") ?>
</span>
<?php } ?>
<?php if ($account_sub_group->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountSubGroupCode">
<span<?php echo $account_sub_group_grid->AccountSubGroupCode->viewAttributes() ?>><?php echo $account_sub_group_grid->AccountSubGroupCode->getViewValue() ?></span>
</span>
<?php if (!$account_sub_group->isConfirm()) { ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupCode" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->FormValue) ?>">
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupCode" name="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupCode" name="faccount_sub_groupgrid$x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="faccount_sub_groupgrid$x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->FormValue) ?>">
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupCode" name="faccount_sub_groupgrid$o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="faccount_sub_groupgrid$o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($account_sub_group_grid->AccountSubGroupName->Visible) { // AccountSubGroupName ?>
		<td data-name="AccountSubGroupName" <?php echo $account_sub_group_grid->AccountSubGroupName->cellAttributes() ?>>
<?php if ($account_sub_group->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountSubGroupName" class="form-group">
<input type="text" data-table="account_sub_group" data-field="x_AccountSubGroupName" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupName->getPlaceHolder()) ?>" value="<?php echo $account_sub_group_grid->AccountSubGroupName->EditValue ?>"<?php echo $account_sub_group_grid->AccountSubGroupName->editAttributes() ?>>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupName" name="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" id="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupName->OldValue) ?>">
<?php } ?>
<?php if ($account_sub_group->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountSubGroupName" class="form-group">
<input type="text" data-table="account_sub_group" data-field="x_AccountSubGroupName" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupName->getPlaceHolder()) ?>" value="<?php echo $account_sub_group_grid->AccountSubGroupName->EditValue ?>"<?php echo $account_sub_group_grid->AccountSubGroupName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($account_sub_group->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $account_sub_group_grid->RowCount ?>_account_sub_group_AccountSubGroupName">
<span<?php echo $account_sub_group_grid->AccountSubGroupName->viewAttributes() ?>><?php echo $account_sub_group_grid->AccountSubGroupName->getViewValue() ?></span>
</span>
<?php if (!$account_sub_group->isConfirm()) { ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupName" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupName->FormValue) ?>">
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupName" name="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" id="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupName" name="faccount_sub_groupgrid$x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" id="faccount_sub_groupgrid$x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupName->FormValue) ?>">
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupName" name="faccount_sub_groupgrid$o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" id="faccount_sub_groupgrid$o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$account_sub_group_grid->ListOptions->render("body", "right", $account_sub_group_grid->RowCount);
?>
	</tr>
<?php if ($account_sub_group->RowType == ROWTYPE_ADD || $account_sub_group->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["faccount_sub_groupgrid", "load"], function() {
	faccount_sub_groupgrid.updateLists(<?php echo $account_sub_group_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$account_sub_group_grid->isGridAdd() || $account_sub_group->CurrentMode == "copy")
		if (!$account_sub_group_grid->Recordset->EOF)
			$account_sub_group_grid->Recordset->moveNext();
}
?>
<?php
	if ($account_sub_group->CurrentMode == "add" || $account_sub_group->CurrentMode == "copy" || $account_sub_group->CurrentMode == "edit") {
		$account_sub_group_grid->RowIndex = '$rowindex$';
		$account_sub_group_grid->loadRowValues();

		// Set row properties
		$account_sub_group->resetAttributes();
		$account_sub_group->RowAttrs->merge(["data-rowindex" => $account_sub_group_grid->RowIndex, "id" => "r0_account_sub_group", "data-rowtype" => ROWTYPE_ADD]);
		$account_sub_group->RowAttrs->appendClass("ew-template");
		$account_sub_group->RowType = ROWTYPE_ADD;

		// Render row
		$account_sub_group_grid->renderRow();

		// Render list options
		$account_sub_group_grid->renderListOptions();
		$account_sub_group_grid->StartRowCount = 0;
?>
	<tr <?php echo $account_sub_group->rowAttributes() ?>>
<?php

// Render list options (body, left)
$account_sub_group_grid->ListOptions->render("body", "left", $account_sub_group_grid->RowIndex);
?>
	<?php if ($account_sub_group_grid->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType">
<?php if (!$account_sub_group->isConfirm()) { ?>
<?php if ($account_sub_group_grid->AccountType->getSessionValue() != "") { ?>
<span id="el$rowindex$_account_sub_group_AccountType" class="form-group account_sub_group_AccountType">
<span<?php echo $account_sub_group_grid->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($account_sub_group_grid->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_account_sub_group_AccountType" class="form-group account_sub_group_AccountType">
<?php
$onchange = $account_sub_group_grid->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$account_sub_group_grid->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo RemoveHtml($account_sub_group_grid->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountType->getPlaceHolder()) ?>"<?php echo $account_sub_group_grid->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($account_sub_group_grid->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($account_sub_group_grid->AccountType->ReadOnly || $account_sub_group_grid->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $account_sub_group_grid->AccountType->displayValueSeparatorAttribute() ?>" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccount_sub_groupgrid"], function() {
	faccount_sub_groupgrid.createAutoSuggest({"id":"x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType","forceSelect":false});
});
</script>
<?php echo $account_sub_group_grid->AccountType->Lookup->getParamTag($account_sub_group_grid, "p_x" . $account_sub_group_grid->RowIndex . "_AccountType") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_account_sub_group_AccountType" class="form-group account_sub_group_AccountType">
<span<?php echo $account_sub_group_grid->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($account_sub_group_grid->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountType" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountType" name="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" id="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_sub_group_grid->AccountType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($account_sub_group_grid->AccountGroupCode->Visible) { // AccountGroupCode ?>
		<td data-name="AccountGroupCode">
<?php if (!$account_sub_group->isConfirm()) { ?>
<?php if ($account_sub_group_grid->AccountGroupCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_account_sub_group_AccountGroupCode" class="form-group account_sub_group_AccountGroupCode">
<span<?php echo $account_sub_group_grid->AccountGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($account_sub_group_grid->AccountGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_account_sub_group_AccountGroupCode" class="form-group account_sub_group_AccountGroupCode">
<?php
$onchange = $account_sub_group_grid->AccountGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$account_sub_group_grid->AccountGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo RemoveHtml($account_sub_group_grid->AccountGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->getPlaceHolder()) ?>"<?php echo $account_sub_group_grid->AccountGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($account_sub_group_grid->AccountGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($account_sub_group_grid->AccountGroupCode->ReadOnly || $account_sub_group_grid->AccountGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $account_sub_group_grid->AccountGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccount_sub_groupgrid"], function() {
	faccount_sub_groupgrid.createAutoSuggest({"id":"x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode","forceSelect":false});
});
</script>
<?php echo $account_sub_group_grid->AccountGroupCode->Lookup->getParamTag($account_sub_group_grid, "p_x" . $account_sub_group_grid->RowIndex . "_AccountGroupCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_account_sub_group_AccountGroupCode" class="form-group account_sub_group_AccountGroupCode">
<span<?php echo $account_sub_group_grid->AccountGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($account_sub_group_grid->AccountGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountGroupCode" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountGroupCode" name="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" id="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountGroupCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($account_sub_group_grid->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
		<td data-name="AccountSubGroupCode">
<?php if (!$account_sub_group->isConfirm()) { ?>
<span id="el$rowindex$_account_sub_group_AccountSubGroupCode" class="form-group account_sub_group_AccountSubGroupCode">
<?php
$onchange = $account_sub_group_grid->AccountSubGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$account_sub_group_grid->AccountSubGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="sv_x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo RemoveHtml($account_sub_group_grid->AccountSubGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->getPlaceHolder()) ?>"<?php echo $account_sub_group_grid->AccountSubGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($account_sub_group_grid->AccountSubGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($account_sub_group_grid->AccountSubGroupCode->ReadOnly || $account_sub_group_grid->AccountSubGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $account_sub_group_grid->AccountSubGroupCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccount_sub_groupgrid"], function() {
	faccount_sub_groupgrid.createAutoSuggest({"id":"x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode","forceSelect":false});
});
</script>
<?php echo $account_sub_group_grid->AccountSubGroupCode->Lookup->getParamTag($account_sub_group_grid, "p_x" . $account_sub_group_grid->RowIndex . "_AccountSubGroupCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_account_sub_group_AccountSubGroupCode" class="form-group account_sub_group_AccountSubGroupCode">
<span<?php echo $account_sub_group_grid->AccountSubGroupCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($account_sub_group_grid->AccountSubGroupCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupCode" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupCode" name="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" id="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupCode" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($account_sub_group_grid->AccountSubGroupName->Visible) { // AccountSubGroupName ?>
		<td data-name="AccountSubGroupName">
<?php if (!$account_sub_group->isConfirm()) { ?>
<span id="el$rowindex$_account_sub_group_AccountSubGroupName" class="form-group account_sub_group_AccountSubGroupName">
<input type="text" data-table="account_sub_group" data-field="x_AccountSubGroupName" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupName->getPlaceHolder()) ?>" value="<?php echo $account_sub_group_grid->AccountSubGroupName->EditValue ?>"<?php echo $account_sub_group_grid->AccountSubGroupName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_account_sub_group_AccountSubGroupName" class="form-group account_sub_group_AccountSubGroupName">
<span<?php echo $account_sub_group_grid->AccountSubGroupName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($account_sub_group_grid->AccountSubGroupName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupName" name="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" id="x<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupName" name="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" id="o<?php echo $account_sub_group_grid->RowIndex ?>_AccountSubGroupName" value="<?php echo HtmlEncode($account_sub_group_grid->AccountSubGroupName->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$account_sub_group_grid->ListOptions->render("body", "right", $account_sub_group_grid->RowIndex);
?>
<script>
loadjs.ready(["faccount_sub_groupgrid", "load"], function() {
	faccount_sub_groupgrid.updateLists(<?php echo $account_sub_group_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($account_sub_group->CurrentMode == "add" || $account_sub_group->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $account_sub_group_grid->FormKeyCountName ?>" id="<?php echo $account_sub_group_grid->FormKeyCountName ?>" value="<?php echo $account_sub_group_grid->KeyCount ?>">
<?php echo $account_sub_group_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($account_sub_group->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $account_sub_group_grid->FormKeyCountName ?>" id="<?php echo $account_sub_group_grid->FormKeyCountName ?>" value="<?php echo $account_sub_group_grid->KeyCount ?>">
<?php echo $account_sub_group_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($account_sub_group->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="faccount_sub_groupgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($account_sub_group_grid->Recordset)
	$account_sub_group_grid->Recordset->Close();
?>
<?php if ($account_sub_group_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $account_sub_group_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($account_sub_group_grid->TotalRecords == 0 && !$account_sub_group->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $account_sub_group_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$account_sub_group_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$account_sub_group_grid->terminate();
?>