<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($local_authority_grid))
	$local_authority_grid = new local_authority_grid();

// Run the page
$local_authority_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$local_authority_grid->Page_Render();
?>
<?php if (!$local_authority_grid->isExport()) { ?>
<script>
var flocal_authoritygrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	flocal_authoritygrid = new ew.Form("flocal_authoritygrid", "grid");
	flocal_authoritygrid.formKeyCountName = '<?php echo $local_authority_grid->FormKeyCountName ?>';

	// Validate form
	flocal_authoritygrid.validate = function() {
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
			<?php if ($local_authority_grid->LAName->Required) { ?>
				elm = this.getElements("x" + infix + "_LAName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_grid->LAName->caption(), $local_authority_grid->LAName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_grid->CouncilType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_grid->CouncilType->caption(), $local_authority_grid->CouncilType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_grid->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_grid->ProvinceCode->caption(), $local_authority_grid->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_grid->Clients->Required) { ?>
				elm = this.getElements("x" + infix + "_Clients");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_grid->Clients->caption(), $local_authority_grid->Clients->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_grid->Beneficiaries->Required) { ?>
				elm = this.getElements("x" + infix + "_Beneficiaries");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_grid->Beneficiaries->caption(), $local_authority_grid->Beneficiaries->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_grid->ExecutiveAuthority->Required) { ?>
				elm = this.getElements("x" + infix + "_ExecutiveAuthority");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_grid->ExecutiveAuthority->caption(), $local_authority_grid->ExecutiveAuthority->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_grid->ControllingOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_ControllingOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_grid->ControllingOfficer->caption(), $local_authority_grid->ControllingOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($local_authority_grid->Comment->Required) { ?>
				elm = this.getElements("x" + infix + "_Comment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $local_authority_grid->Comment->caption(), $local_authority_grid->Comment->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	flocal_authoritygrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LAName", false)) return false;
		if (ew.valueChanged(fobj, infix, "CouncilType", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "Clients", false)) return false;
		if (ew.valueChanged(fobj, infix, "Beneficiaries", false)) return false;
		if (ew.valueChanged(fobj, infix, "ExecutiveAuthority", false)) return false;
		if (ew.valueChanged(fobj, infix, "ControllingOfficer", false)) return false;
		if (ew.valueChanged(fobj, infix, "Comment", false)) return false;
		return true;
	}

	// Form_CustomValidate
	flocal_authoritygrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flocal_authoritygrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	flocal_authoritygrid.lists["x_CouncilType"] = <?php echo $local_authority_grid->CouncilType->Lookup->toClientList($local_authority_grid) ?>;
	flocal_authoritygrid.lists["x_CouncilType"].options = <?php echo JsonEncode($local_authority_grid->CouncilType->lookupOptions()) ?>;
	flocal_authoritygrid.lists["x_ProvinceCode"] = <?php echo $local_authority_grid->ProvinceCode->Lookup->toClientList($local_authority_grid) ?>;
	flocal_authoritygrid.lists["x_ProvinceCode"].options = <?php echo JsonEncode($local_authority_grid->ProvinceCode->lookupOptions()) ?>;
	loadjs.done("flocal_authoritygrid");
});
</script>
<?php } ?>
<?php
$local_authority_grid->renderOtherOptions();
?>
<?php if ($local_authority_grid->TotalRecords > 0 || $local_authority->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($local_authority_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> local_authority">
<?php if ($local_authority_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $local_authority_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="flocal_authoritygrid" class="ew-form ew-list-form form-inline">
<div id="gmp_local_authority" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_local_authoritygrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$local_authority->RowType = ROWTYPE_HEADER;

// Render list options
$local_authority_grid->renderListOptions();

// Render list options (header, left)
$local_authority_grid->ListOptions->render("header", "left");
?>
<?php if ($local_authority_grid->LAName->Visible) { // LAName ?>
	<?php if ($local_authority_grid->SortUrl($local_authority_grid->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $local_authority_grid->LAName->headerCellClass() ?>"><div id="elh_local_authority_LAName" class="local_authority_LAName"><div class="ew-table-header-caption"><?php echo $local_authority_grid->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $local_authority_grid->LAName->headerCellClass() ?>"><div><div id="elh_local_authority_LAName" class="local_authority_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_grid->LAName->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_grid->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_grid->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_grid->CouncilType->Visible) { // CouncilType ?>
	<?php if ($local_authority_grid->SortUrl($local_authority_grid->CouncilType) == "") { ?>
		<th data-name="CouncilType" class="<?php echo $local_authority_grid->CouncilType->headerCellClass() ?>"><div id="elh_local_authority_CouncilType" class="local_authority_CouncilType"><div class="ew-table-header-caption"><?php echo $local_authority_grid->CouncilType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilType" class="<?php echo $local_authority_grid->CouncilType->headerCellClass() ?>"><div><div id="elh_local_authority_CouncilType" class="local_authority_CouncilType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_grid->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_grid->CouncilType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_grid->CouncilType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_grid->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($local_authority_grid->SortUrl($local_authority_grid->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $local_authority_grid->ProvinceCode->headerCellClass() ?>"><div id="elh_local_authority_ProvinceCode" class="local_authority_ProvinceCode"><div class="ew-table-header-caption"><?php echo $local_authority_grid->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $local_authority_grid->ProvinceCode->headerCellClass() ?>"><div><div id="elh_local_authority_ProvinceCode" class="local_authority_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_grid->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_grid->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_grid->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_grid->Clients->Visible) { // Clients ?>
	<?php if ($local_authority_grid->SortUrl($local_authority_grid->Clients) == "") { ?>
		<th data-name="Clients" class="<?php echo $local_authority_grid->Clients->headerCellClass() ?>"><div id="elh_local_authority_Clients" class="local_authority_Clients"><div class="ew-table-header-caption"><?php echo $local_authority_grid->Clients->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Clients" class="<?php echo $local_authority_grid->Clients->headerCellClass() ?>"><div><div id="elh_local_authority_Clients" class="local_authority_Clients">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_grid->Clients->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_grid->Clients->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_grid->Clients->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_grid->Beneficiaries->Visible) { // Beneficiaries ?>
	<?php if ($local_authority_grid->SortUrl($local_authority_grid->Beneficiaries) == "") { ?>
		<th data-name="Beneficiaries" class="<?php echo $local_authority_grid->Beneficiaries->headerCellClass() ?>"><div id="elh_local_authority_Beneficiaries" class="local_authority_Beneficiaries"><div class="ew-table-header-caption"><?php echo $local_authority_grid->Beneficiaries->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Beneficiaries" class="<?php echo $local_authority_grid->Beneficiaries->headerCellClass() ?>"><div><div id="elh_local_authority_Beneficiaries" class="local_authority_Beneficiaries">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_grid->Beneficiaries->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_grid->Beneficiaries->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_grid->Beneficiaries->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_grid->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
	<?php if ($local_authority_grid->SortUrl($local_authority_grid->ExecutiveAuthority) == "") { ?>
		<th data-name="ExecutiveAuthority" class="<?php echo $local_authority_grid->ExecutiveAuthority->headerCellClass() ?>"><div id="elh_local_authority_ExecutiveAuthority" class="local_authority_ExecutiveAuthority"><div class="ew-table-header-caption"><?php echo $local_authority_grid->ExecutiveAuthority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExecutiveAuthority" class="<?php echo $local_authority_grid->ExecutiveAuthority->headerCellClass() ?>"><div><div id="elh_local_authority_ExecutiveAuthority" class="local_authority_ExecutiveAuthority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_grid->ExecutiveAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_grid->ExecutiveAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_grid->ExecutiveAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_grid->ControllingOfficer->Visible) { // ControllingOfficer ?>
	<?php if ($local_authority_grid->SortUrl($local_authority_grid->ControllingOfficer) == "") { ?>
		<th data-name="ControllingOfficer" class="<?php echo $local_authority_grid->ControllingOfficer->headerCellClass() ?>"><div id="elh_local_authority_ControllingOfficer" class="local_authority_ControllingOfficer"><div class="ew-table-header-caption"><?php echo $local_authority_grid->ControllingOfficer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ControllingOfficer" class="<?php echo $local_authority_grid->ControllingOfficer->headerCellClass() ?>"><div><div id="elh_local_authority_ControllingOfficer" class="local_authority_ControllingOfficer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_grid->ControllingOfficer->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_grid->ControllingOfficer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_grid->ControllingOfficer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_grid->Comment->Visible) { // Comment ?>
	<?php if ($local_authority_grid->SortUrl($local_authority_grid->Comment) == "") { ?>
		<th data-name="Comment" class="<?php echo $local_authority_grid->Comment->headerCellClass() ?>"><div id="elh_local_authority_Comment" class="local_authority_Comment"><div class="ew-table-header-caption"><?php echo $local_authority_grid->Comment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Comment" class="<?php echo $local_authority_grid->Comment->headerCellClass() ?>"><div><div id="elh_local_authority_Comment" class="local_authority_Comment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_grid->Comment->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_grid->Comment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_grid->Comment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$local_authority_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$local_authority_grid->StartRecord = 1;
$local_authority_grid->StopRecord = $local_authority_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($local_authority->isConfirm() || $local_authority_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($local_authority_grid->FormKeyCountName) && ($local_authority_grid->isGridAdd() || $local_authority_grid->isGridEdit() || $local_authority->isConfirm())) {
		$local_authority_grid->KeyCount = $CurrentForm->getValue($local_authority_grid->FormKeyCountName);
		$local_authority_grid->StopRecord = $local_authority_grid->StartRecord + $local_authority_grid->KeyCount - 1;
	}
}
$local_authority_grid->RecordCount = $local_authority_grid->StartRecord - 1;
if ($local_authority_grid->Recordset && !$local_authority_grid->Recordset->EOF) {
	$local_authority_grid->Recordset->moveFirst();
	$selectLimit = $local_authority_grid->UseSelectLimit;
	if (!$selectLimit && $local_authority_grid->StartRecord > 1)
		$local_authority_grid->Recordset->move($local_authority_grid->StartRecord - 1);
} elseif (!$local_authority->AllowAddDeleteRow && $local_authority_grid->StopRecord == 0) {
	$local_authority_grid->StopRecord = $local_authority->GridAddRowCount;
}

// Initialize aggregate
$local_authority->RowType = ROWTYPE_AGGREGATEINIT;
$local_authority->resetAttributes();
$local_authority_grid->renderRow();
if ($local_authority_grid->isGridAdd())
	$local_authority_grid->RowIndex = 0;
if ($local_authority_grid->isGridEdit())
	$local_authority_grid->RowIndex = 0;
while ($local_authority_grid->RecordCount < $local_authority_grid->StopRecord) {
	$local_authority_grid->RecordCount++;
	if ($local_authority_grid->RecordCount >= $local_authority_grid->StartRecord) {
		$local_authority_grid->RowCount++;
		if ($local_authority_grid->isGridAdd() || $local_authority_grid->isGridEdit() || $local_authority->isConfirm()) {
			$local_authority_grid->RowIndex++;
			$CurrentForm->Index = $local_authority_grid->RowIndex;
			if ($CurrentForm->hasValue($local_authority_grid->FormActionName) && ($local_authority->isConfirm() || $local_authority_grid->EventCancelled))
				$local_authority_grid->RowAction = strval($CurrentForm->getValue($local_authority_grid->FormActionName));
			elseif ($local_authority_grid->isGridAdd())
				$local_authority_grid->RowAction = "insert";
			else
				$local_authority_grid->RowAction = "";
		}

		// Set up key count
		$local_authority_grid->KeyCount = $local_authority_grid->RowIndex;

		// Init row class and style
		$local_authority->resetAttributes();
		$local_authority->CssClass = "";
		if ($local_authority_grid->isGridAdd()) {
			if ($local_authority->CurrentMode == "copy") {
				$local_authority_grid->loadRowValues($local_authority_grid->Recordset); // Load row values
				$local_authority_grid->setRecordKey($local_authority_grid->RowOldKey, $local_authority_grid->Recordset); // Set old record key
			} else {
				$local_authority_grid->loadRowValues(); // Load default values
				$local_authority_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$local_authority_grid->loadRowValues($local_authority_grid->Recordset); // Load row values
		}
		$local_authority->RowType = ROWTYPE_VIEW; // Render view
		if ($local_authority_grid->isGridAdd()) // Grid add
			$local_authority->RowType = ROWTYPE_ADD; // Render add
		if ($local_authority_grid->isGridAdd() && $local_authority->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$local_authority_grid->restoreCurrentRowFormValues($local_authority_grid->RowIndex); // Restore form values
		if ($local_authority_grid->isGridEdit()) { // Grid edit
			if ($local_authority->EventCancelled)
				$local_authority_grid->restoreCurrentRowFormValues($local_authority_grid->RowIndex); // Restore form values
			if ($local_authority_grid->RowAction == "insert")
				$local_authority->RowType = ROWTYPE_ADD; // Render add
			else
				$local_authority->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($local_authority_grid->isGridEdit() && ($local_authority->RowType == ROWTYPE_EDIT || $local_authority->RowType == ROWTYPE_ADD) && $local_authority->EventCancelled) // Update failed
			$local_authority_grid->restoreCurrentRowFormValues($local_authority_grid->RowIndex); // Restore form values
		if ($local_authority->RowType == ROWTYPE_EDIT) // Edit row
			$local_authority_grid->EditRowCount++;
		if ($local_authority->isConfirm()) // Confirm row
			$local_authority_grid->restoreCurrentRowFormValues($local_authority_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$local_authority->RowAttrs->merge(["data-rowindex" => $local_authority_grid->RowCount, "id" => "r" . $local_authority_grid->RowCount . "_local_authority", "data-rowtype" => $local_authority->RowType]);

		// Render row
		$local_authority_grid->renderRow();

		// Render list options
		$local_authority_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($local_authority_grid->RowAction != "delete" && $local_authority_grid->RowAction != "insertdelete" && !($local_authority_grid->RowAction == "insert" && $local_authority->isConfirm() && $local_authority_grid->emptyRow())) {
?>
	<tr <?php echo $local_authority->rowAttributes() ?>>
<?php

// Render list options (body, left)
$local_authority_grid->ListOptions->render("body", "left", $local_authority_grid->RowCount);
?>
	<?php if ($local_authority_grid->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $local_authority_grid->LAName->cellAttributes() ?>>
<?php if ($local_authority->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_LAName" class="form-group">
<input type="text" data-table="local_authority" data-field="x_LAName" name="x<?php echo $local_authority_grid->RowIndex ?>_LAName" id="x<?php echo $local_authority_grid->RowIndex ?>_LAName" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($local_authority_grid->LAName->getPlaceHolder()) ?>" value="<?php echo $local_authority_grid->LAName->EditValue ?>"<?php echo $local_authority_grid->LAName->editAttributes() ?>>
</span>
<input type="hidden" data-table="local_authority" data-field="x_LAName" name="o<?php echo $local_authority_grid->RowIndex ?>_LAName" id="o<?php echo $local_authority_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($local_authority_grid->LAName->OldValue) ?>">
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_LAName" class="form-group">
<input type="text" data-table="local_authority" data-field="x_LAName" name="x<?php echo $local_authority_grid->RowIndex ?>_LAName" id="x<?php echo $local_authority_grid->RowIndex ?>_LAName" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($local_authority_grid->LAName->getPlaceHolder()) ?>" value="<?php echo $local_authority_grid->LAName->EditValue ?>"<?php echo $local_authority_grid->LAName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_LAName">
<span<?php echo $local_authority_grid->LAName->viewAttributes() ?>><?php echo $local_authority_grid->LAName->getViewValue() ?></span>
</span>
<?php if (!$local_authority->isConfirm()) { ?>
<input type="hidden" data-table="local_authority" data-field="x_LAName" name="x<?php echo $local_authority_grid->RowIndex ?>_LAName" id="x<?php echo $local_authority_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($local_authority_grid->LAName->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_LAName" name="o<?php echo $local_authority_grid->RowIndex ?>_LAName" id="o<?php echo $local_authority_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($local_authority_grid->LAName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="local_authority" data-field="x_LAName" name="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_LAName" id="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($local_authority_grid->LAName->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_LAName" name="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_LAName" id="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($local_authority_grid->LAName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="local_authority" data-field="x_LACode" name="x<?php echo $local_authority_grid->RowIndex ?>_LACode" id="x<?php echo $local_authority_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($local_authority_grid->LACode->CurrentValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_LACode" name="o<?php echo $local_authority_grid->RowIndex ?>_LACode" id="o<?php echo $local_authority_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($local_authority_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_EDIT || $local_authority->CurrentMode == "edit") { ?>
<input type="hidden" data-table="local_authority" data-field="x_LACode" name="x<?php echo $local_authority_grid->RowIndex ?>_LACode" id="x<?php echo $local_authority_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($local_authority_grid->LACode->CurrentValue) ?>">
<?php } ?>
	<?php if ($local_authority_grid->CouncilType->Visible) { // CouncilType ?>
		<td data-name="CouncilType" <?php echo $local_authority_grid->CouncilType->cellAttributes() ?>>
<?php if ($local_authority->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_CouncilType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="local_authority" data-field="x_CouncilType" data-value-separator="<?php echo $local_authority_grid->CouncilType->displayValueSeparatorAttribute() ?>" id="x<?php echo $local_authority_grid->RowIndex ?>_CouncilType" name="x<?php echo $local_authority_grid->RowIndex ?>_CouncilType"<?php echo $local_authority_grid->CouncilType->editAttributes() ?>>
			<?php echo $local_authority_grid->CouncilType->selectOptionListHtml("x{$local_authority_grid->RowIndex}_CouncilType") ?>
		</select>
</div>
<?php echo $local_authority_grid->CouncilType->Lookup->getParamTag($local_authority_grid, "p_x" . $local_authority_grid->RowIndex . "_CouncilType") ?>
</span>
<input type="hidden" data-table="local_authority" data-field="x_CouncilType" name="o<?php echo $local_authority_grid->RowIndex ?>_CouncilType" id="o<?php echo $local_authority_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($local_authority_grid->CouncilType->OldValue) ?>">
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_CouncilType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="local_authority" data-field="x_CouncilType" data-value-separator="<?php echo $local_authority_grid->CouncilType->displayValueSeparatorAttribute() ?>" id="x<?php echo $local_authority_grid->RowIndex ?>_CouncilType" name="x<?php echo $local_authority_grid->RowIndex ?>_CouncilType"<?php echo $local_authority_grid->CouncilType->editAttributes() ?>>
			<?php echo $local_authority_grid->CouncilType->selectOptionListHtml("x{$local_authority_grid->RowIndex}_CouncilType") ?>
		</select>
</div>
<?php echo $local_authority_grid->CouncilType->Lookup->getParamTag($local_authority_grid, "p_x" . $local_authority_grid->RowIndex . "_CouncilType") ?>
</span>
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_CouncilType">
<span<?php echo $local_authority_grid->CouncilType->viewAttributes() ?>><?php echo $local_authority_grid->CouncilType->getViewValue() ?></span>
</span>
<?php if (!$local_authority->isConfirm()) { ?>
<input type="hidden" data-table="local_authority" data-field="x_CouncilType" name="x<?php echo $local_authority_grid->RowIndex ?>_CouncilType" id="x<?php echo $local_authority_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($local_authority_grid->CouncilType->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_CouncilType" name="o<?php echo $local_authority_grid->RowIndex ?>_CouncilType" id="o<?php echo $local_authority_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($local_authority_grid->CouncilType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="local_authority" data-field="x_CouncilType" name="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_CouncilType" id="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($local_authority_grid->CouncilType->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_CouncilType" name="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_CouncilType" id="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($local_authority_grid->CouncilType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($local_authority_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $local_authority_grid->ProvinceCode->cellAttributes() ?>>
<?php if ($local_authority->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($local_authority_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_ProvinceCode" class="form-group">
<span<?php echo $local_authority_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($local_authority_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($local_authority_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_ProvinceCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="local_authority" data-field="x_ProvinceCode" data-value-separator="<?php echo $local_authority_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode"<?php echo $local_authority_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $local_authority_grid->ProvinceCode->selectOptionListHtml("x{$local_authority_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $local_authority_grid->ProvinceCode->Lookup->getParamTag($local_authority_grid, "p_x" . $local_authority_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="local_authority" data-field="x_ProvinceCode" name="o<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($local_authority_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($local_authority_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_ProvinceCode" class="form-group">
<span<?php echo $local_authority_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($local_authority_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($local_authority_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_ProvinceCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="local_authority" data-field="x_ProvinceCode" data-value-separator="<?php echo $local_authority_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode"<?php echo $local_authority_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $local_authority_grid->ProvinceCode->selectOptionListHtml("x{$local_authority_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $local_authority_grid->ProvinceCode->Lookup->getParamTag($local_authority_grid, "p_x" . $local_authority_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_ProvinceCode">
<span<?php echo $local_authority_grid->ProvinceCode->viewAttributes() ?>><?php echo $local_authority_grid->ProvinceCode->getViewValue() ?></span>
</span>
<?php if (!$local_authority->isConfirm()) { ?>
<input type="hidden" data-table="local_authority" data-field="x_ProvinceCode" name="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($local_authority_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_ProvinceCode" name="o<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($local_authority_grid->ProvinceCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="local_authority" data-field="x_ProvinceCode" name="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" id="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($local_authority_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_ProvinceCode" name="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" id="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($local_authority_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($local_authority_grid->Clients->Visible) { // Clients ?>
		<td data-name="Clients" <?php echo $local_authority_grid->Clients->cellAttributes() ?>>
<?php if ($local_authority->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_Clients" class="form-group">
<textarea data-table="local_authority" data-field="x_Clients" name="x<?php echo $local_authority_grid->RowIndex ?>_Clients" id="x<?php echo $local_authority_grid->RowIndex ?>_Clients" cols="35" rows="2" placeholder="<?php echo HtmlEncode($local_authority_grid->Clients->getPlaceHolder()) ?>"<?php echo $local_authority_grid->Clients->editAttributes() ?>><?php echo $local_authority_grid->Clients->EditValue ?></textarea>
</span>
<input type="hidden" data-table="local_authority" data-field="x_Clients" name="o<?php echo $local_authority_grid->RowIndex ?>_Clients" id="o<?php echo $local_authority_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($local_authority_grid->Clients->OldValue) ?>">
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_Clients" class="form-group">
<textarea data-table="local_authority" data-field="x_Clients" name="x<?php echo $local_authority_grid->RowIndex ?>_Clients" id="x<?php echo $local_authority_grid->RowIndex ?>_Clients" cols="35" rows="2" placeholder="<?php echo HtmlEncode($local_authority_grid->Clients->getPlaceHolder()) ?>"<?php echo $local_authority_grid->Clients->editAttributes() ?>><?php echo $local_authority_grid->Clients->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_Clients">
<span<?php echo $local_authority_grid->Clients->viewAttributes() ?>><?php echo $local_authority_grid->Clients->getViewValue() ?></span>
</span>
<?php if (!$local_authority->isConfirm()) { ?>
<input type="hidden" data-table="local_authority" data-field="x_Clients" name="x<?php echo $local_authority_grid->RowIndex ?>_Clients" id="x<?php echo $local_authority_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($local_authority_grid->Clients->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_Clients" name="o<?php echo $local_authority_grid->RowIndex ?>_Clients" id="o<?php echo $local_authority_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($local_authority_grid->Clients->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="local_authority" data-field="x_Clients" name="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_Clients" id="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($local_authority_grid->Clients->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_Clients" name="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_Clients" id="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($local_authority_grid->Clients->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($local_authority_grid->Beneficiaries->Visible) { // Beneficiaries ?>
		<td data-name="Beneficiaries" <?php echo $local_authority_grid->Beneficiaries->cellAttributes() ?>>
<?php if ($local_authority->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_Beneficiaries" class="form-group">
<textarea data-table="local_authority" data-field="x_Beneficiaries" name="x<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" id="x<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" cols="35" rows="2" placeholder="<?php echo HtmlEncode($local_authority_grid->Beneficiaries->getPlaceHolder()) ?>"<?php echo $local_authority_grid->Beneficiaries->editAttributes() ?>><?php echo $local_authority_grid->Beneficiaries->EditValue ?></textarea>
</span>
<input type="hidden" data-table="local_authority" data-field="x_Beneficiaries" name="o<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" id="o<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($local_authority_grid->Beneficiaries->OldValue) ?>">
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_Beneficiaries" class="form-group">
<textarea data-table="local_authority" data-field="x_Beneficiaries" name="x<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" id="x<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" cols="35" rows="2" placeholder="<?php echo HtmlEncode($local_authority_grid->Beneficiaries->getPlaceHolder()) ?>"<?php echo $local_authority_grid->Beneficiaries->editAttributes() ?>><?php echo $local_authority_grid->Beneficiaries->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_Beneficiaries">
<span<?php echo $local_authority_grid->Beneficiaries->viewAttributes() ?>><?php echo $local_authority_grid->Beneficiaries->getViewValue() ?></span>
</span>
<?php if (!$local_authority->isConfirm()) { ?>
<input type="hidden" data-table="local_authority" data-field="x_Beneficiaries" name="x<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" id="x<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($local_authority_grid->Beneficiaries->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_Beneficiaries" name="o<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" id="o<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($local_authority_grid->Beneficiaries->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="local_authority" data-field="x_Beneficiaries" name="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" id="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($local_authority_grid->Beneficiaries->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_Beneficiaries" name="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" id="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($local_authority_grid->Beneficiaries->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($local_authority_grid->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
		<td data-name="ExecutiveAuthority" <?php echo $local_authority_grid->ExecutiveAuthority->cellAttributes() ?>>
<?php if ($local_authority->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_ExecutiveAuthority" class="form-group">
<input type="text" data-table="local_authority" data-field="x_ExecutiveAuthority" name="x<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" id="x<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_grid->ExecutiveAuthority->getPlaceHolder()) ?>" value="<?php echo $local_authority_grid->ExecutiveAuthority->EditValue ?>"<?php echo $local_authority_grid->ExecutiveAuthority->editAttributes() ?>>
</span>
<input type="hidden" data-table="local_authority" data-field="x_ExecutiveAuthority" name="o<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" id="o<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" value="<?php echo HtmlEncode($local_authority_grid->ExecutiveAuthority->OldValue) ?>">
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_ExecutiveAuthority" class="form-group">
<input type="text" data-table="local_authority" data-field="x_ExecutiveAuthority" name="x<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" id="x<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_grid->ExecutiveAuthority->getPlaceHolder()) ?>" value="<?php echo $local_authority_grid->ExecutiveAuthority->EditValue ?>"<?php echo $local_authority_grid->ExecutiveAuthority->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_ExecutiveAuthority">
<span<?php echo $local_authority_grid->ExecutiveAuthority->viewAttributes() ?>><?php echo $local_authority_grid->ExecutiveAuthority->getViewValue() ?></span>
</span>
<?php if (!$local_authority->isConfirm()) { ?>
<input type="hidden" data-table="local_authority" data-field="x_ExecutiveAuthority" name="x<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" id="x<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" value="<?php echo HtmlEncode($local_authority_grid->ExecutiveAuthority->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_ExecutiveAuthority" name="o<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" id="o<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" value="<?php echo HtmlEncode($local_authority_grid->ExecutiveAuthority->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="local_authority" data-field="x_ExecutiveAuthority" name="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" id="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" value="<?php echo HtmlEncode($local_authority_grid->ExecutiveAuthority->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_ExecutiveAuthority" name="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" id="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" value="<?php echo HtmlEncode($local_authority_grid->ExecutiveAuthority->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($local_authority_grid->ControllingOfficer->Visible) { // ControllingOfficer ?>
		<td data-name="ControllingOfficer" <?php echo $local_authority_grid->ControllingOfficer->cellAttributes() ?>>
<?php if ($local_authority->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_ControllingOfficer" class="form-group">
<input type="text" data-table="local_authority" data-field="x_ControllingOfficer" name="x<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" id="x<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_grid->ControllingOfficer->getPlaceHolder()) ?>" value="<?php echo $local_authority_grid->ControllingOfficer->EditValue ?>"<?php echo $local_authority_grid->ControllingOfficer->editAttributes() ?>>
</span>
<input type="hidden" data-table="local_authority" data-field="x_ControllingOfficer" name="o<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" id="o<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" value="<?php echo HtmlEncode($local_authority_grid->ControllingOfficer->OldValue) ?>">
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_ControllingOfficer" class="form-group">
<input type="text" data-table="local_authority" data-field="x_ControllingOfficer" name="x<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" id="x<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_grid->ControllingOfficer->getPlaceHolder()) ?>" value="<?php echo $local_authority_grid->ControllingOfficer->EditValue ?>"<?php echo $local_authority_grid->ControllingOfficer->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_ControllingOfficer">
<span<?php echo $local_authority_grid->ControllingOfficer->viewAttributes() ?>><?php echo $local_authority_grid->ControllingOfficer->getViewValue() ?></span>
</span>
<?php if (!$local_authority->isConfirm()) { ?>
<input type="hidden" data-table="local_authority" data-field="x_ControllingOfficer" name="x<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" id="x<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" value="<?php echo HtmlEncode($local_authority_grid->ControllingOfficer->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_ControllingOfficer" name="o<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" id="o<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" value="<?php echo HtmlEncode($local_authority_grid->ControllingOfficer->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="local_authority" data-field="x_ControllingOfficer" name="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" id="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" value="<?php echo HtmlEncode($local_authority_grid->ControllingOfficer->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_ControllingOfficer" name="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" id="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" value="<?php echo HtmlEncode($local_authority_grid->ControllingOfficer->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($local_authority_grid->Comment->Visible) { // Comment ?>
		<td data-name="Comment" <?php echo $local_authority_grid->Comment->cellAttributes() ?>>
<?php if ($local_authority->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_Comment" class="form-group">
<textarea data-table="local_authority" data-field="x_Comment" name="x<?php echo $local_authority_grid->RowIndex ?>_Comment" id="x<?php echo $local_authority_grid->RowIndex ?>_Comment" cols="50" rows="4" placeholder="<?php echo HtmlEncode($local_authority_grid->Comment->getPlaceHolder()) ?>"<?php echo $local_authority_grid->Comment->editAttributes() ?>><?php echo $local_authority_grid->Comment->EditValue ?></textarea>
</span>
<input type="hidden" data-table="local_authority" data-field="x_Comment" name="o<?php echo $local_authority_grid->RowIndex ?>_Comment" id="o<?php echo $local_authority_grid->RowIndex ?>_Comment" value="<?php echo HtmlEncode($local_authority_grid->Comment->OldValue) ?>">
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_Comment" class="form-group">
<textarea data-table="local_authority" data-field="x_Comment" name="x<?php echo $local_authority_grid->RowIndex ?>_Comment" id="x<?php echo $local_authority_grid->RowIndex ?>_Comment" cols="50" rows="4" placeholder="<?php echo HtmlEncode($local_authority_grid->Comment->getPlaceHolder()) ?>"<?php echo $local_authority_grid->Comment->editAttributes() ?>><?php echo $local_authority_grid->Comment->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($local_authority->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $local_authority_grid->RowCount ?>_local_authority_Comment">
<span<?php echo $local_authority_grid->Comment->viewAttributes() ?>><?php echo $local_authority_grid->Comment->getViewValue() ?></span>
</span>
<?php if (!$local_authority->isConfirm()) { ?>
<input type="hidden" data-table="local_authority" data-field="x_Comment" name="x<?php echo $local_authority_grid->RowIndex ?>_Comment" id="x<?php echo $local_authority_grid->RowIndex ?>_Comment" value="<?php echo HtmlEncode($local_authority_grid->Comment->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_Comment" name="o<?php echo $local_authority_grid->RowIndex ?>_Comment" id="o<?php echo $local_authority_grid->RowIndex ?>_Comment" value="<?php echo HtmlEncode($local_authority_grid->Comment->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="local_authority" data-field="x_Comment" name="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_Comment" id="flocal_authoritygrid$x<?php echo $local_authority_grid->RowIndex ?>_Comment" value="<?php echo HtmlEncode($local_authority_grid->Comment->FormValue) ?>">
<input type="hidden" data-table="local_authority" data-field="x_Comment" name="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_Comment" id="flocal_authoritygrid$o<?php echo $local_authority_grid->RowIndex ?>_Comment" value="<?php echo HtmlEncode($local_authority_grid->Comment->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$local_authority_grid->ListOptions->render("body", "right", $local_authority_grid->RowCount);
?>
	</tr>
<?php if ($local_authority->RowType == ROWTYPE_ADD || $local_authority->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["flocal_authoritygrid", "load"], function() {
	flocal_authoritygrid.updateLists(<?php echo $local_authority_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$local_authority_grid->isGridAdd() || $local_authority->CurrentMode == "copy")
		if (!$local_authority_grid->Recordset->EOF)
			$local_authority_grid->Recordset->moveNext();
}
?>
<?php
	if ($local_authority->CurrentMode == "add" || $local_authority->CurrentMode == "copy" || $local_authority->CurrentMode == "edit") {
		$local_authority_grid->RowIndex = '$rowindex$';
		$local_authority_grid->loadRowValues();

		// Set row properties
		$local_authority->resetAttributes();
		$local_authority->RowAttrs->merge(["data-rowindex" => $local_authority_grid->RowIndex, "id" => "r0_local_authority", "data-rowtype" => ROWTYPE_ADD]);
		$local_authority->RowAttrs->appendClass("ew-template");
		$local_authority->RowType = ROWTYPE_ADD;

		// Render row
		$local_authority_grid->renderRow();

		// Render list options
		$local_authority_grid->renderListOptions();
		$local_authority_grid->StartRowCount = 0;
?>
	<tr <?php echo $local_authority->rowAttributes() ?>>
<?php

// Render list options (body, left)
$local_authority_grid->ListOptions->render("body", "left", $local_authority_grid->RowIndex);
?>
	<?php if ($local_authority_grid->LAName->Visible) { // LAName ?>
		<td data-name="LAName">
<?php if (!$local_authority->isConfirm()) { ?>
<span id="el$rowindex$_local_authority_LAName" class="form-group local_authority_LAName">
<input type="text" data-table="local_authority" data-field="x_LAName" name="x<?php echo $local_authority_grid->RowIndex ?>_LAName" id="x<?php echo $local_authority_grid->RowIndex ?>_LAName" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($local_authority_grid->LAName->getPlaceHolder()) ?>" value="<?php echo $local_authority_grid->LAName->EditValue ?>"<?php echo $local_authority_grid->LAName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_local_authority_LAName" class="form-group local_authority_LAName">
<span<?php echo $local_authority_grid->LAName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($local_authority_grid->LAName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="local_authority" data-field="x_LAName" name="x<?php echo $local_authority_grid->RowIndex ?>_LAName" id="x<?php echo $local_authority_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($local_authority_grid->LAName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="local_authority" data-field="x_LAName" name="o<?php echo $local_authority_grid->RowIndex ?>_LAName" id="o<?php echo $local_authority_grid->RowIndex ?>_LAName" value="<?php echo HtmlEncode($local_authority_grid->LAName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($local_authority_grid->CouncilType->Visible) { // CouncilType ?>
		<td data-name="CouncilType">
<?php if (!$local_authority->isConfirm()) { ?>
<span id="el$rowindex$_local_authority_CouncilType" class="form-group local_authority_CouncilType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="local_authority" data-field="x_CouncilType" data-value-separator="<?php echo $local_authority_grid->CouncilType->displayValueSeparatorAttribute() ?>" id="x<?php echo $local_authority_grid->RowIndex ?>_CouncilType" name="x<?php echo $local_authority_grid->RowIndex ?>_CouncilType"<?php echo $local_authority_grid->CouncilType->editAttributes() ?>>
			<?php echo $local_authority_grid->CouncilType->selectOptionListHtml("x{$local_authority_grid->RowIndex}_CouncilType") ?>
		</select>
</div>
<?php echo $local_authority_grid->CouncilType->Lookup->getParamTag($local_authority_grid, "p_x" . $local_authority_grid->RowIndex . "_CouncilType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_local_authority_CouncilType" class="form-group local_authority_CouncilType">
<span<?php echo $local_authority_grid->CouncilType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($local_authority_grid->CouncilType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="local_authority" data-field="x_CouncilType" name="x<?php echo $local_authority_grid->RowIndex ?>_CouncilType" id="x<?php echo $local_authority_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($local_authority_grid->CouncilType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="local_authority" data-field="x_CouncilType" name="o<?php echo $local_authority_grid->RowIndex ?>_CouncilType" id="o<?php echo $local_authority_grid->RowIndex ?>_CouncilType" value="<?php echo HtmlEncode($local_authority_grid->CouncilType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($local_authority_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if (!$local_authority->isConfirm()) { ?>
<?php if ($local_authority_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_local_authority_ProvinceCode" class="form-group local_authority_ProvinceCode">
<span<?php echo $local_authority_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($local_authority_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($local_authority_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_local_authority_ProvinceCode" class="form-group local_authority_ProvinceCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="local_authority" data-field="x_ProvinceCode" data-value-separator="<?php echo $local_authority_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode"<?php echo $local_authority_grid->ProvinceCode->editAttributes() ?>>
			<?php echo $local_authority_grid->ProvinceCode->selectOptionListHtml("x{$local_authority_grid->RowIndex}_ProvinceCode") ?>
		</select>
</div>
<?php echo $local_authority_grid->ProvinceCode->Lookup->getParamTag($local_authority_grid, "p_x" . $local_authority_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_local_authority_ProvinceCode" class="form-group local_authority_ProvinceCode">
<span<?php echo $local_authority_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($local_authority_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="local_authority" data-field="x_ProvinceCode" name="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($local_authority_grid->ProvinceCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="local_authority" data-field="x_ProvinceCode" name="o<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $local_authority_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($local_authority_grid->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($local_authority_grid->Clients->Visible) { // Clients ?>
		<td data-name="Clients">
<?php if (!$local_authority->isConfirm()) { ?>
<span id="el$rowindex$_local_authority_Clients" class="form-group local_authority_Clients">
<textarea data-table="local_authority" data-field="x_Clients" name="x<?php echo $local_authority_grid->RowIndex ?>_Clients" id="x<?php echo $local_authority_grid->RowIndex ?>_Clients" cols="35" rows="2" placeholder="<?php echo HtmlEncode($local_authority_grid->Clients->getPlaceHolder()) ?>"<?php echo $local_authority_grid->Clients->editAttributes() ?>><?php echo $local_authority_grid->Clients->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_local_authority_Clients" class="form-group local_authority_Clients">
<span<?php echo $local_authority_grid->Clients->viewAttributes() ?>><?php echo $local_authority_grid->Clients->ViewValue ?></span>
</span>
<input type="hidden" data-table="local_authority" data-field="x_Clients" name="x<?php echo $local_authority_grid->RowIndex ?>_Clients" id="x<?php echo $local_authority_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($local_authority_grid->Clients->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="local_authority" data-field="x_Clients" name="o<?php echo $local_authority_grid->RowIndex ?>_Clients" id="o<?php echo $local_authority_grid->RowIndex ?>_Clients" value="<?php echo HtmlEncode($local_authority_grid->Clients->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($local_authority_grid->Beneficiaries->Visible) { // Beneficiaries ?>
		<td data-name="Beneficiaries">
<?php if (!$local_authority->isConfirm()) { ?>
<span id="el$rowindex$_local_authority_Beneficiaries" class="form-group local_authority_Beneficiaries">
<textarea data-table="local_authority" data-field="x_Beneficiaries" name="x<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" id="x<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" cols="35" rows="2" placeholder="<?php echo HtmlEncode($local_authority_grid->Beneficiaries->getPlaceHolder()) ?>"<?php echo $local_authority_grid->Beneficiaries->editAttributes() ?>><?php echo $local_authority_grid->Beneficiaries->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_local_authority_Beneficiaries" class="form-group local_authority_Beneficiaries">
<span<?php echo $local_authority_grid->Beneficiaries->viewAttributes() ?>><?php echo $local_authority_grid->Beneficiaries->ViewValue ?></span>
</span>
<input type="hidden" data-table="local_authority" data-field="x_Beneficiaries" name="x<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" id="x<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($local_authority_grid->Beneficiaries->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="local_authority" data-field="x_Beneficiaries" name="o<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" id="o<?php echo $local_authority_grid->RowIndex ?>_Beneficiaries" value="<?php echo HtmlEncode($local_authority_grid->Beneficiaries->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($local_authority_grid->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
		<td data-name="ExecutiveAuthority">
<?php if (!$local_authority->isConfirm()) { ?>
<span id="el$rowindex$_local_authority_ExecutiveAuthority" class="form-group local_authority_ExecutiveAuthority">
<input type="text" data-table="local_authority" data-field="x_ExecutiveAuthority" name="x<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" id="x<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_grid->ExecutiveAuthority->getPlaceHolder()) ?>" value="<?php echo $local_authority_grid->ExecutiveAuthority->EditValue ?>"<?php echo $local_authority_grid->ExecutiveAuthority->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_local_authority_ExecutiveAuthority" class="form-group local_authority_ExecutiveAuthority">
<span<?php echo $local_authority_grid->ExecutiveAuthority->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($local_authority_grid->ExecutiveAuthority->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="local_authority" data-field="x_ExecutiveAuthority" name="x<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" id="x<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" value="<?php echo HtmlEncode($local_authority_grid->ExecutiveAuthority->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="local_authority" data-field="x_ExecutiveAuthority" name="o<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" id="o<?php echo $local_authority_grid->RowIndex ?>_ExecutiveAuthority" value="<?php echo HtmlEncode($local_authority_grid->ExecutiveAuthority->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($local_authority_grid->ControllingOfficer->Visible) { // ControllingOfficer ?>
		<td data-name="ControllingOfficer">
<?php if (!$local_authority->isConfirm()) { ?>
<span id="el$rowindex$_local_authority_ControllingOfficer" class="form-group local_authority_ControllingOfficer">
<input type="text" data-table="local_authority" data-field="x_ControllingOfficer" name="x<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" id="x<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_grid->ControllingOfficer->getPlaceHolder()) ?>" value="<?php echo $local_authority_grid->ControllingOfficer->EditValue ?>"<?php echo $local_authority_grid->ControllingOfficer->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_local_authority_ControllingOfficer" class="form-group local_authority_ControllingOfficer">
<span<?php echo $local_authority_grid->ControllingOfficer->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($local_authority_grid->ControllingOfficer->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="local_authority" data-field="x_ControllingOfficer" name="x<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" id="x<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" value="<?php echo HtmlEncode($local_authority_grid->ControllingOfficer->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="local_authority" data-field="x_ControllingOfficer" name="o<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" id="o<?php echo $local_authority_grid->RowIndex ?>_ControllingOfficer" value="<?php echo HtmlEncode($local_authority_grid->ControllingOfficer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($local_authority_grid->Comment->Visible) { // Comment ?>
		<td data-name="Comment">
<?php if (!$local_authority->isConfirm()) { ?>
<span id="el$rowindex$_local_authority_Comment" class="form-group local_authority_Comment">
<textarea data-table="local_authority" data-field="x_Comment" name="x<?php echo $local_authority_grid->RowIndex ?>_Comment" id="x<?php echo $local_authority_grid->RowIndex ?>_Comment" cols="50" rows="4" placeholder="<?php echo HtmlEncode($local_authority_grid->Comment->getPlaceHolder()) ?>"<?php echo $local_authority_grid->Comment->editAttributes() ?>><?php echo $local_authority_grid->Comment->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_local_authority_Comment" class="form-group local_authority_Comment">
<span<?php echo $local_authority_grid->Comment->viewAttributes() ?>><?php echo $local_authority_grid->Comment->ViewValue ?></span>
</span>
<input type="hidden" data-table="local_authority" data-field="x_Comment" name="x<?php echo $local_authority_grid->RowIndex ?>_Comment" id="x<?php echo $local_authority_grid->RowIndex ?>_Comment" value="<?php echo HtmlEncode($local_authority_grid->Comment->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="local_authority" data-field="x_Comment" name="o<?php echo $local_authority_grid->RowIndex ?>_Comment" id="o<?php echo $local_authority_grid->RowIndex ?>_Comment" value="<?php echo HtmlEncode($local_authority_grid->Comment->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$local_authority_grid->ListOptions->render("body", "right", $local_authority_grid->RowIndex);
?>
<script>
loadjs.ready(["flocal_authoritygrid", "load"], function() {
	flocal_authoritygrid.updateLists(<?php echo $local_authority_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($local_authority->CurrentMode == "add" || $local_authority->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $local_authority_grid->FormKeyCountName ?>" id="<?php echo $local_authority_grid->FormKeyCountName ?>" value="<?php echo $local_authority_grid->KeyCount ?>">
<?php echo $local_authority_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($local_authority->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $local_authority_grid->FormKeyCountName ?>" id="<?php echo $local_authority_grid->FormKeyCountName ?>" value="<?php echo $local_authority_grid->KeyCount ?>">
<?php echo $local_authority_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($local_authority->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="flocal_authoritygrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($local_authority_grid->Recordset)
	$local_authority_grid->Recordset->Close();
?>
<?php if ($local_authority_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $local_authority_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($local_authority_grid->TotalRecords == 0 && !$local_authority->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $local_authority_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$local_authority_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$local_authority_grid->terminate();
?>