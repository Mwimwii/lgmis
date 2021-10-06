<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($staffprofbodies_grid))
	$staffprofbodies_grid = new staffprofbodies_grid();

// Run the page
$staffprofbodies_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffprofbodies_grid->Page_Render();
?>
<?php if (!$staffprofbodies_grid->isExport()) { ?>
<script>
var fstaffprofbodiesgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fstaffprofbodiesgrid = new ew.Form("fstaffprofbodiesgrid", "grid");
	fstaffprofbodiesgrid.formKeyCountName = '<?php echo $staffprofbodies_grid->FormKeyCountName ?>';

	// Validate form
	fstaffprofbodiesgrid.validate = function() {
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
			<?php if ($staffprofbodies_grid->ProfessionalBody->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalBody");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_grid->ProfessionalBody->caption(), $staffprofbodies_grid->ProfessionalBody->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffprofbodies_grid->MembershipNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MembershipNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_grid->MembershipNo->caption(), $staffprofbodies_grid->MembershipNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffprofbodies_grid->DateJoined->Required) { ?>
				elm = this.getElements("x" + infix + "_DateJoined");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_grid->DateJoined->caption(), $staffprofbodies_grid->DateJoined->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateJoined");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_grid->DateJoined->errorMessage()) ?>");
			<?php if ($staffprofbodies_grid->DateRenewed->Required) { ?>
				elm = this.getElements("x" + infix + "_DateRenewed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_grid->DateRenewed->caption(), $staffprofbodies_grid->DateRenewed->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateRenewed");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_grid->DateRenewed->errorMessage()) ?>");
			<?php if ($staffprofbodies_grid->ValidTo->Required) { ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_grid->ValidTo->caption(), $staffprofbodies_grid->ValidTo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_grid->ValidTo->errorMessage()) ?>");
			<?php if ($staffprofbodies_grid->MemberStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MemberStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_grid->MemberStatus->caption(), $staffprofbodies_grid->MemberStatus->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fstaffprofbodiesgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ProfessionalBody", false)) return false;
		if (ew.valueChanged(fobj, infix, "MembershipNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateJoined", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateRenewed", false)) return false;
		if (ew.valueChanged(fobj, infix, "ValidTo", false)) return false;
		if (ew.valueChanged(fobj, infix, "MemberStatus", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fstaffprofbodiesgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffprofbodiesgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffprofbodiesgrid.lists["x_ProfessionalBody"] = <?php echo $staffprofbodies_grid->ProfessionalBody->Lookup->toClientList($staffprofbodies_grid) ?>;
	fstaffprofbodiesgrid.lists["x_ProfessionalBody"].options = <?php echo JsonEncode($staffprofbodies_grid->ProfessionalBody->lookupOptions()) ?>;
	fstaffprofbodiesgrid.lists["x_MemberStatus"] = <?php echo $staffprofbodies_grid->MemberStatus->Lookup->toClientList($staffprofbodies_grid) ?>;
	fstaffprofbodiesgrid.lists["x_MemberStatus"].options = <?php echo JsonEncode($staffprofbodies_grid->MemberStatus->lookupOptions()) ?>;
	loadjs.done("fstaffprofbodiesgrid");
});
</script>
<?php } ?>
<?php
$staffprofbodies_grid->renderOtherOptions();
?>
<?php if ($staffprofbodies_grid->TotalRecords > 0 || $staffprofbodies->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffprofbodies_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffprofbodies">
<?php if ($staffprofbodies_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $staffprofbodies_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fstaffprofbodiesgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_staffprofbodies" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_staffprofbodiesgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffprofbodies->RowType = ROWTYPE_HEADER;

// Render list options
$staffprofbodies_grid->renderListOptions();

// Render list options (header, left)
$staffprofbodies_grid->ListOptions->render("header", "left");
?>
<?php if ($staffprofbodies_grid->ProfessionalBody->Visible) { // ProfessionalBody ?>
	<?php if ($staffprofbodies_grid->SortUrl($staffprofbodies_grid->ProfessionalBody) == "") { ?>
		<th data-name="ProfessionalBody" class="<?php echo $staffprofbodies_grid->ProfessionalBody->headerCellClass() ?>"><div id="elh_staffprofbodies_ProfessionalBody" class="staffprofbodies_ProfessionalBody"><div class="ew-table-header-caption"><?php echo $staffprofbodies_grid->ProfessionalBody->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfessionalBody" class="<?php echo $staffprofbodies_grid->ProfessionalBody->headerCellClass() ?>"><div><div id="elh_staffprofbodies_ProfessionalBody" class="staffprofbodies_ProfessionalBody">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_grid->ProfessionalBody->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_grid->ProfessionalBody->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_grid->ProfessionalBody->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_grid->MembershipNo->Visible) { // MembershipNo ?>
	<?php if ($staffprofbodies_grid->SortUrl($staffprofbodies_grid->MembershipNo) == "") { ?>
		<th data-name="MembershipNo" class="<?php echo $staffprofbodies_grid->MembershipNo->headerCellClass() ?>"><div id="elh_staffprofbodies_MembershipNo" class="staffprofbodies_MembershipNo"><div class="ew-table-header-caption"><?php echo $staffprofbodies_grid->MembershipNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MembershipNo" class="<?php echo $staffprofbodies_grid->MembershipNo->headerCellClass() ?>"><div><div id="elh_staffprofbodies_MembershipNo" class="staffprofbodies_MembershipNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_grid->MembershipNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_grid->MembershipNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_grid->MembershipNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_grid->DateJoined->Visible) { // DateJoined ?>
	<?php if ($staffprofbodies_grid->SortUrl($staffprofbodies_grid->DateJoined) == "") { ?>
		<th data-name="DateJoined" class="<?php echo $staffprofbodies_grid->DateJoined->headerCellClass() ?>"><div id="elh_staffprofbodies_DateJoined" class="staffprofbodies_DateJoined"><div class="ew-table-header-caption"><?php echo $staffprofbodies_grid->DateJoined->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateJoined" class="<?php echo $staffprofbodies_grid->DateJoined->headerCellClass() ?>"><div><div id="elh_staffprofbodies_DateJoined" class="staffprofbodies_DateJoined">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_grid->DateJoined->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_grid->DateJoined->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_grid->DateJoined->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_grid->DateRenewed->Visible) { // DateRenewed ?>
	<?php if ($staffprofbodies_grid->SortUrl($staffprofbodies_grid->DateRenewed) == "") { ?>
		<th data-name="DateRenewed" class="<?php echo $staffprofbodies_grid->DateRenewed->headerCellClass() ?>"><div id="elh_staffprofbodies_DateRenewed" class="staffprofbodies_DateRenewed"><div class="ew-table-header-caption"><?php echo $staffprofbodies_grid->DateRenewed->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateRenewed" class="<?php echo $staffprofbodies_grid->DateRenewed->headerCellClass() ?>"><div><div id="elh_staffprofbodies_DateRenewed" class="staffprofbodies_DateRenewed">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_grid->DateRenewed->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_grid->DateRenewed->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_grid->DateRenewed->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_grid->ValidTo->Visible) { // ValidTo ?>
	<?php if ($staffprofbodies_grid->SortUrl($staffprofbodies_grid->ValidTo) == "") { ?>
		<th data-name="ValidTo" class="<?php echo $staffprofbodies_grid->ValidTo->headerCellClass() ?>"><div id="elh_staffprofbodies_ValidTo" class="staffprofbodies_ValidTo"><div class="ew-table-header-caption"><?php echo $staffprofbodies_grid->ValidTo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValidTo" class="<?php echo $staffprofbodies_grid->ValidTo->headerCellClass() ?>"><div><div id="elh_staffprofbodies_ValidTo" class="staffprofbodies_ValidTo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_grid->ValidTo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_grid->ValidTo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_grid->ValidTo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_grid->MemberStatus->Visible) { // MemberStatus ?>
	<?php if ($staffprofbodies_grid->SortUrl($staffprofbodies_grid->MemberStatus) == "") { ?>
		<th data-name="MemberStatus" class="<?php echo $staffprofbodies_grid->MemberStatus->headerCellClass() ?>"><div id="elh_staffprofbodies_MemberStatus" class="staffprofbodies_MemberStatus"><div class="ew-table-header-caption"><?php echo $staffprofbodies_grid->MemberStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MemberStatus" class="<?php echo $staffprofbodies_grid->MemberStatus->headerCellClass() ?>"><div><div id="elh_staffprofbodies_MemberStatus" class="staffprofbodies_MemberStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_grid->MemberStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_grid->MemberStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_grid->MemberStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffprofbodies_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$staffprofbodies_grid->StartRecord = 1;
$staffprofbodies_grid->StopRecord = $staffprofbodies_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($staffprofbodies->isConfirm() || $staffprofbodies_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffprofbodies_grid->FormKeyCountName) && ($staffprofbodies_grid->isGridAdd() || $staffprofbodies_grid->isGridEdit() || $staffprofbodies->isConfirm())) {
		$staffprofbodies_grid->KeyCount = $CurrentForm->getValue($staffprofbodies_grid->FormKeyCountName);
		$staffprofbodies_grid->StopRecord = $staffprofbodies_grid->StartRecord + $staffprofbodies_grid->KeyCount - 1;
	}
}
$staffprofbodies_grid->RecordCount = $staffprofbodies_grid->StartRecord - 1;
if ($staffprofbodies_grid->Recordset && !$staffprofbodies_grid->Recordset->EOF) {
	$staffprofbodies_grid->Recordset->moveFirst();
	$selectLimit = $staffprofbodies_grid->UseSelectLimit;
	if (!$selectLimit && $staffprofbodies_grid->StartRecord > 1)
		$staffprofbodies_grid->Recordset->move($staffprofbodies_grid->StartRecord - 1);
} elseif (!$staffprofbodies->AllowAddDeleteRow && $staffprofbodies_grid->StopRecord == 0) {
	$staffprofbodies_grid->StopRecord = $staffprofbodies->GridAddRowCount;
}

// Initialize aggregate
$staffprofbodies->RowType = ROWTYPE_AGGREGATEINIT;
$staffprofbodies->resetAttributes();
$staffprofbodies_grid->renderRow();
if ($staffprofbodies_grid->isGridAdd())
	$staffprofbodies_grid->RowIndex = 0;
if ($staffprofbodies_grid->isGridEdit())
	$staffprofbodies_grid->RowIndex = 0;
while ($staffprofbodies_grid->RecordCount < $staffprofbodies_grid->StopRecord) {
	$staffprofbodies_grid->RecordCount++;
	if ($staffprofbodies_grid->RecordCount >= $staffprofbodies_grid->StartRecord) {
		$staffprofbodies_grid->RowCount++;
		if ($staffprofbodies_grid->isGridAdd() || $staffprofbodies_grid->isGridEdit() || $staffprofbodies->isConfirm()) {
			$staffprofbodies_grid->RowIndex++;
			$CurrentForm->Index = $staffprofbodies_grid->RowIndex;
			if ($CurrentForm->hasValue($staffprofbodies_grid->FormActionName) && ($staffprofbodies->isConfirm() || $staffprofbodies_grid->EventCancelled))
				$staffprofbodies_grid->RowAction = strval($CurrentForm->getValue($staffprofbodies_grid->FormActionName));
			elseif ($staffprofbodies_grid->isGridAdd())
				$staffprofbodies_grid->RowAction = "insert";
			else
				$staffprofbodies_grid->RowAction = "";
		}

		// Set up key count
		$staffprofbodies_grid->KeyCount = $staffprofbodies_grid->RowIndex;

		// Init row class and style
		$staffprofbodies->resetAttributes();
		$staffprofbodies->CssClass = "";
		if ($staffprofbodies_grid->isGridAdd()) {
			if ($staffprofbodies->CurrentMode == "copy") {
				$staffprofbodies_grid->loadRowValues($staffprofbodies_grid->Recordset); // Load row values
				$staffprofbodies_grid->setRecordKey($staffprofbodies_grid->RowOldKey, $staffprofbodies_grid->Recordset); // Set old record key
			} else {
				$staffprofbodies_grid->loadRowValues(); // Load default values
				$staffprofbodies_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$staffprofbodies_grid->loadRowValues($staffprofbodies_grid->Recordset); // Load row values
		}
		$staffprofbodies->RowType = ROWTYPE_VIEW; // Render view
		if ($staffprofbodies_grid->isGridAdd()) // Grid add
			$staffprofbodies->RowType = ROWTYPE_ADD; // Render add
		if ($staffprofbodies_grid->isGridAdd() && $staffprofbodies->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffprofbodies_grid->restoreCurrentRowFormValues($staffprofbodies_grid->RowIndex); // Restore form values
		if ($staffprofbodies_grid->isGridEdit()) { // Grid edit
			if ($staffprofbodies->EventCancelled)
				$staffprofbodies_grid->restoreCurrentRowFormValues($staffprofbodies_grid->RowIndex); // Restore form values
			if ($staffprofbodies_grid->RowAction == "insert")
				$staffprofbodies->RowType = ROWTYPE_ADD; // Render add
			else
				$staffprofbodies->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffprofbodies_grid->isGridEdit() && ($staffprofbodies->RowType == ROWTYPE_EDIT || $staffprofbodies->RowType == ROWTYPE_ADD) && $staffprofbodies->EventCancelled) // Update failed
			$staffprofbodies_grid->restoreCurrentRowFormValues($staffprofbodies_grid->RowIndex); // Restore form values
		if ($staffprofbodies->RowType == ROWTYPE_EDIT) // Edit row
			$staffprofbodies_grid->EditRowCount++;
		if ($staffprofbodies->isConfirm()) // Confirm row
			$staffprofbodies_grid->restoreCurrentRowFormValues($staffprofbodies_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$staffprofbodies->RowAttrs->merge(["data-rowindex" => $staffprofbodies_grid->RowCount, "id" => "r" . $staffprofbodies_grid->RowCount . "_staffprofbodies", "data-rowtype" => $staffprofbodies->RowType]);

		// Render row
		$staffprofbodies_grid->renderRow();

		// Render list options
		$staffprofbodies_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffprofbodies_grid->RowAction != "delete" && $staffprofbodies_grid->RowAction != "insertdelete" && !($staffprofbodies_grid->RowAction == "insert" && $staffprofbodies->isConfirm() && $staffprofbodies_grid->emptyRow())) {
?>
	<tr <?php echo $staffprofbodies->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffprofbodies_grid->ListOptions->render("body", "left", $staffprofbodies_grid->RowCount);
?>
	<?php if ($staffprofbodies_grid->ProfessionalBody->Visible) { // ProfessionalBody ?>
		<td data-name="ProfessionalBody" <?php echo $staffprofbodies_grid->ProfessionalBody->cellAttributes() ?>>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_ProfessionalBody" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody"><?php echo EmptyValue(strval($staffprofbodies_grid->ProfessionalBody->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffprofbodies_grid->ProfessionalBody->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffprofbodies_grid->ProfessionalBody->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffprofbodies_grid->ProfessionalBody->ReadOnly || $staffprofbodies_grid->ProfessionalBody->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffprofbodies_grid->ProfessionalBody->Lookup->getParamTag($staffprofbodies_grid, "p_x" . $staffprofbodies_grid->RowIndex . "_ProfessionalBody") ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffprofbodies_grid->ProfessionalBody->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" value="<?php echo $staffprofbodies_grid->ProfessionalBody->CurrentValue ?>"<?php echo $staffprofbodies_grid->ProfessionalBody->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" value="<?php echo HtmlEncode($staffprofbodies_grid->ProfessionalBody->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody"><?php echo EmptyValue(strval($staffprofbodies_grid->ProfessionalBody->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffprofbodies_grid->ProfessionalBody->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffprofbodies_grid->ProfessionalBody->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffprofbodies_grid->ProfessionalBody->ReadOnly || $staffprofbodies_grid->ProfessionalBody->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffprofbodies_grid->ProfessionalBody->Lookup->getParamTag($staffprofbodies_grid, "p_x" . $staffprofbodies_grid->RowIndex . "_ProfessionalBody") ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffprofbodies_grid->ProfessionalBody->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" value="<?php echo $staffprofbodies_grid->ProfessionalBody->CurrentValue ?>"<?php echo $staffprofbodies_grid->ProfessionalBody->editAttributes() ?>>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" value="<?php echo HtmlEncode($staffprofbodies_grid->ProfessionalBody->OldValue != null ? $staffprofbodies_grid->ProfessionalBody->OldValue : $staffprofbodies_grid->ProfessionalBody->CurrentValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_ProfessionalBody">
<span<?php echo $staffprofbodies_grid->ProfessionalBody->viewAttributes() ?>><?php echo $staffprofbodies_grid->ProfessionalBody->getViewValue() ?></span>
</span>
<?php if (!$staffprofbodies->isConfirm()) { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" value="<?php echo HtmlEncode($staffprofbodies_grid->ProfessionalBody->FormValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" value="<?php echo HtmlEncode($staffprofbodies_grid->ProfessionalBody->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" name="fstaffprofbodiesgrid$x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" id="fstaffprofbodiesgrid$x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" value="<?php echo HtmlEncode($staffprofbodies_grid->ProfessionalBody->FormValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" name="fstaffprofbodiesgrid$o<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" id="fstaffprofbodiesgrid$o<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" value="<?php echo HtmlEncode($staffprofbodies_grid->ProfessionalBody->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_EmployeeID" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffprofbodies_grid->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_EmployeeID" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_EmployeeID" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffprofbodies_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT || $staffprofbodies->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_EmployeeID" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_EmployeeID" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffprofbodies_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffprofbodies_grid->MembershipNo->Visible) { // MembershipNo ?>
		<td data-name="MembershipNo" <?php echo $staffprofbodies_grid->MembershipNo->cellAttributes() ?>>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_MembershipNo" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_MembershipNo" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($staffprofbodies_grid->MembershipNo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_grid->MembershipNo->EditValue ?>"<?php echo $staffprofbodies_grid->MembershipNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_MembershipNo" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" value="<?php echo HtmlEncode($staffprofbodies_grid->MembershipNo->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_MembershipNo" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_MembershipNo" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($staffprofbodies_grid->MembershipNo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_grid->MembershipNo->EditValue ?>"<?php echo $staffprofbodies_grid->MembershipNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_MembershipNo">
<span<?php echo $staffprofbodies_grid->MembershipNo->viewAttributes() ?>><?php echo $staffprofbodies_grid->MembershipNo->getViewValue() ?></span>
</span>
<?php if (!$staffprofbodies->isConfirm()) { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_MembershipNo" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" value="<?php echo HtmlEncode($staffprofbodies_grid->MembershipNo->FormValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_MembershipNo" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" value="<?php echo HtmlEncode($staffprofbodies_grid->MembershipNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_MembershipNo" name="fstaffprofbodiesgrid$x<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" id="fstaffprofbodiesgrid$x<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" value="<?php echo HtmlEncode($staffprofbodies_grid->MembershipNo->FormValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_MembershipNo" name="fstaffprofbodiesgrid$o<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" id="fstaffprofbodiesgrid$o<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" value="<?php echo HtmlEncode($staffprofbodies_grid->MembershipNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffprofbodies_grid->DateJoined->Visible) { // DateJoined ?>
		<td data-name="DateJoined" <?php echo $staffprofbodies_grid->DateJoined->cellAttributes() ?>>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_DateJoined" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_DateJoined" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" placeholder="<?php echo HtmlEncode($staffprofbodies_grid->DateJoined->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_grid->DateJoined->EditValue ?>"<?php echo $staffprofbodies_grid->DateJoined->editAttributes() ?>>
<?php if (!$staffprofbodies_grid->DateJoined->ReadOnly && !$staffprofbodies_grid->DateJoined->Disabled && !isset($staffprofbodies_grid->DateJoined->EditAttrs["readonly"]) && !isset($staffprofbodies_grid->DateJoined->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesgrid", "x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateJoined" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" value="<?php echo HtmlEncode($staffprofbodies_grid->DateJoined->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_DateJoined" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_DateJoined" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" placeholder="<?php echo HtmlEncode($staffprofbodies_grid->DateJoined->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_grid->DateJoined->EditValue ?>"<?php echo $staffprofbodies_grid->DateJoined->editAttributes() ?>>
<?php if (!$staffprofbodies_grid->DateJoined->ReadOnly && !$staffprofbodies_grid->DateJoined->Disabled && !isset($staffprofbodies_grid->DateJoined->EditAttrs["readonly"]) && !isset($staffprofbodies_grid->DateJoined->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesgrid", "x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_DateJoined">
<span<?php echo $staffprofbodies_grid->DateJoined->viewAttributes() ?>><?php echo $staffprofbodies_grid->DateJoined->getViewValue() ?></span>
</span>
<?php if (!$staffprofbodies->isConfirm()) { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateJoined" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" value="<?php echo HtmlEncode($staffprofbodies_grid->DateJoined->FormValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_DateJoined" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" value="<?php echo HtmlEncode($staffprofbodies_grid->DateJoined->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateJoined" name="fstaffprofbodiesgrid$x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" id="fstaffprofbodiesgrid$x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" value="<?php echo HtmlEncode($staffprofbodies_grid->DateJoined->FormValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_DateJoined" name="fstaffprofbodiesgrid$o<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" id="fstaffprofbodiesgrid$o<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" value="<?php echo HtmlEncode($staffprofbodies_grid->DateJoined->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffprofbodies_grid->DateRenewed->Visible) { // DateRenewed ?>
		<td data-name="DateRenewed" <?php echo $staffprofbodies_grid->DateRenewed->cellAttributes() ?>>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_DateRenewed" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_DateRenewed" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" placeholder="<?php echo HtmlEncode($staffprofbodies_grid->DateRenewed->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_grid->DateRenewed->EditValue ?>"<?php echo $staffprofbodies_grid->DateRenewed->editAttributes() ?>>
<?php if (!$staffprofbodies_grid->DateRenewed->ReadOnly && !$staffprofbodies_grid->DateRenewed->Disabled && !isset($staffprofbodies_grid->DateRenewed->EditAttrs["readonly"]) && !isset($staffprofbodies_grid->DateRenewed->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesgrid", "x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateRenewed" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" value="<?php echo HtmlEncode($staffprofbodies_grid->DateRenewed->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_DateRenewed" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_DateRenewed" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" placeholder="<?php echo HtmlEncode($staffprofbodies_grid->DateRenewed->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_grid->DateRenewed->EditValue ?>"<?php echo $staffprofbodies_grid->DateRenewed->editAttributes() ?>>
<?php if (!$staffprofbodies_grid->DateRenewed->ReadOnly && !$staffprofbodies_grid->DateRenewed->Disabled && !isset($staffprofbodies_grid->DateRenewed->EditAttrs["readonly"]) && !isset($staffprofbodies_grid->DateRenewed->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesgrid", "x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_DateRenewed">
<span<?php echo $staffprofbodies_grid->DateRenewed->viewAttributes() ?>><?php echo $staffprofbodies_grid->DateRenewed->getViewValue() ?></span>
</span>
<?php if (!$staffprofbodies->isConfirm()) { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateRenewed" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" value="<?php echo HtmlEncode($staffprofbodies_grid->DateRenewed->FormValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_DateRenewed" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" value="<?php echo HtmlEncode($staffprofbodies_grid->DateRenewed->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateRenewed" name="fstaffprofbodiesgrid$x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" id="fstaffprofbodiesgrid$x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" value="<?php echo HtmlEncode($staffprofbodies_grid->DateRenewed->FormValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_DateRenewed" name="fstaffprofbodiesgrid$o<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" id="fstaffprofbodiesgrid$o<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" value="<?php echo HtmlEncode($staffprofbodies_grid->DateRenewed->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffprofbodies_grid->ValidTo->Visible) { // ValidTo ?>
		<td data-name="ValidTo" <?php echo $staffprofbodies_grid->ValidTo->cellAttributes() ?>>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_ValidTo" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_ValidTo" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" placeholder="<?php echo HtmlEncode($staffprofbodies_grid->ValidTo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_grid->ValidTo->EditValue ?>"<?php echo $staffprofbodies_grid->ValidTo->editAttributes() ?>>
<?php if (!$staffprofbodies_grid->ValidTo->ReadOnly && !$staffprofbodies_grid->ValidTo->Disabled && !isset($staffprofbodies_grid->ValidTo->EditAttrs["readonly"]) && !isset($staffprofbodies_grid->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesgrid", "x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_ValidTo" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($staffprofbodies_grid->ValidTo->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_ValidTo" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_ValidTo" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" placeholder="<?php echo HtmlEncode($staffprofbodies_grid->ValidTo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_grid->ValidTo->EditValue ?>"<?php echo $staffprofbodies_grid->ValidTo->editAttributes() ?>>
<?php if (!$staffprofbodies_grid->ValidTo->ReadOnly && !$staffprofbodies_grid->ValidTo->Disabled && !isset($staffprofbodies_grid->ValidTo->EditAttrs["readonly"]) && !isset($staffprofbodies_grid->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesgrid", "x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_ValidTo">
<span<?php echo $staffprofbodies_grid->ValidTo->viewAttributes() ?>><?php echo $staffprofbodies_grid->ValidTo->getViewValue() ?></span>
</span>
<?php if (!$staffprofbodies->isConfirm()) { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ValidTo" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($staffprofbodies_grid->ValidTo->FormValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_ValidTo" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($staffprofbodies_grid->ValidTo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ValidTo" name="fstaffprofbodiesgrid$x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" id="fstaffprofbodiesgrid$x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($staffprofbodies_grid->ValidTo->FormValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_ValidTo" name="fstaffprofbodiesgrid$o<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" id="fstaffprofbodiesgrid$o<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($staffprofbodies_grid->ValidTo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffprofbodies_grid->MemberStatus->Visible) { // MemberStatus ?>
		<td data-name="MemberStatus" <?php echo $staffprofbodies_grid->MemberStatus->cellAttributes() ?>>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_MemberStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffprofbodies" data-field="x_MemberStatus" data-value-separator="<?php echo $staffprofbodies_grid->MemberStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus"<?php echo $staffprofbodies_grid->MemberStatus->editAttributes() ?>>
			<?php echo $staffprofbodies_grid->MemberStatus->selectOptionListHtml("x{$staffprofbodies_grid->RowIndex}_MemberStatus") ?>
		</select>
</div>
<?php echo $staffprofbodies_grid->MemberStatus->Lookup->getParamTag($staffprofbodies_grid, "p_x" . $staffprofbodies_grid->RowIndex . "_MemberStatus") ?>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_MemberStatus" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" value="<?php echo HtmlEncode($staffprofbodies_grid->MemberStatus->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_MemberStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffprofbodies" data-field="x_MemberStatus" data-value-separator="<?php echo $staffprofbodies_grid->MemberStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus"<?php echo $staffprofbodies_grid->MemberStatus->editAttributes() ?>>
			<?php echo $staffprofbodies_grid->MemberStatus->selectOptionListHtml("x{$staffprofbodies_grid->RowIndex}_MemberStatus") ?>
		</select>
</div>
<?php echo $staffprofbodies_grid->MemberStatus->Lookup->getParamTag($staffprofbodies_grid, "p_x" . $staffprofbodies_grid->RowIndex . "_MemberStatus") ?>
</span>
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffprofbodies_grid->RowCount ?>_staffprofbodies_MemberStatus">
<span<?php echo $staffprofbodies_grid->MemberStatus->viewAttributes() ?>><?php echo $staffprofbodies_grid->MemberStatus->getViewValue() ?></span>
</span>
<?php if (!$staffprofbodies->isConfirm()) { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_MemberStatus" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" value="<?php echo HtmlEncode($staffprofbodies_grid->MemberStatus->FormValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_MemberStatus" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" value="<?php echo HtmlEncode($staffprofbodies_grid->MemberStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_MemberStatus" name="fstaffprofbodiesgrid$x<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" id="fstaffprofbodiesgrid$x<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" value="<?php echo HtmlEncode($staffprofbodies_grid->MemberStatus->FormValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_MemberStatus" name="fstaffprofbodiesgrid$o<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" id="fstaffprofbodiesgrid$o<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" value="<?php echo HtmlEncode($staffprofbodies_grid->MemberStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffprofbodies_grid->ListOptions->render("body", "right", $staffprofbodies_grid->RowCount);
?>
	</tr>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD || $staffprofbodies->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffprofbodiesgrid", "load"], function() {
	fstaffprofbodiesgrid.updateLists(<?php echo $staffprofbodies_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffprofbodies_grid->isGridAdd() || $staffprofbodies->CurrentMode == "copy")
		if (!$staffprofbodies_grid->Recordset->EOF)
			$staffprofbodies_grid->Recordset->moveNext();
}
?>
<?php
	if ($staffprofbodies->CurrentMode == "add" || $staffprofbodies->CurrentMode == "copy" || $staffprofbodies->CurrentMode == "edit") {
		$staffprofbodies_grid->RowIndex = '$rowindex$';
		$staffprofbodies_grid->loadRowValues();

		// Set row properties
		$staffprofbodies->resetAttributes();
		$staffprofbodies->RowAttrs->merge(["data-rowindex" => $staffprofbodies_grid->RowIndex, "id" => "r0_staffprofbodies", "data-rowtype" => ROWTYPE_ADD]);
		$staffprofbodies->RowAttrs->appendClass("ew-template");
		$staffprofbodies->RowType = ROWTYPE_ADD;

		// Render row
		$staffprofbodies_grid->renderRow();

		// Render list options
		$staffprofbodies_grid->renderListOptions();
		$staffprofbodies_grid->StartRowCount = 0;
?>
	<tr <?php echo $staffprofbodies->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffprofbodies_grid->ListOptions->render("body", "left", $staffprofbodies_grid->RowIndex);
?>
	<?php if ($staffprofbodies_grid->ProfessionalBody->Visible) { // ProfessionalBody ?>
		<td data-name="ProfessionalBody">
<?php if (!$staffprofbodies->isConfirm()) { ?>
<span id="el$rowindex$_staffprofbodies_ProfessionalBody" class="form-group staffprofbodies_ProfessionalBody">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody"><?php echo EmptyValue(strval($staffprofbodies_grid->ProfessionalBody->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffprofbodies_grid->ProfessionalBody->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffprofbodies_grid->ProfessionalBody->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffprofbodies_grid->ProfessionalBody->ReadOnly || $staffprofbodies_grid->ProfessionalBody->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffprofbodies_grid->ProfessionalBody->Lookup->getParamTag($staffprofbodies_grid, "p_x" . $staffprofbodies_grid->RowIndex . "_ProfessionalBody") ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffprofbodies_grid->ProfessionalBody->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" value="<?php echo $staffprofbodies_grid->ProfessionalBody->CurrentValue ?>"<?php echo $staffprofbodies_grid->ProfessionalBody->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffprofbodies_ProfessionalBody" class="form-group staffprofbodies_ProfessionalBody">
<span<?php echo $staffprofbodies_grid->ProfessionalBody->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffprofbodies_grid->ProfessionalBody->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" value="<?php echo HtmlEncode($staffprofbodies_grid->ProfessionalBody->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_ProfessionalBody" value="<?php echo HtmlEncode($staffprofbodies_grid->ProfessionalBody->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffprofbodies_grid->MembershipNo->Visible) { // MembershipNo ?>
		<td data-name="MembershipNo">
<?php if (!$staffprofbodies->isConfirm()) { ?>
<span id="el$rowindex$_staffprofbodies_MembershipNo" class="form-group staffprofbodies_MembershipNo">
<input type="text" data-table="staffprofbodies" data-field="x_MembershipNo" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($staffprofbodies_grid->MembershipNo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_grid->MembershipNo->EditValue ?>"<?php echo $staffprofbodies_grid->MembershipNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffprofbodies_MembershipNo" class="form-group staffprofbodies_MembershipNo">
<span<?php echo $staffprofbodies_grid->MembershipNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffprofbodies_grid->MembershipNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_MembershipNo" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" value="<?php echo HtmlEncode($staffprofbodies_grid->MembershipNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_MembershipNo" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_MembershipNo" value="<?php echo HtmlEncode($staffprofbodies_grid->MembershipNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffprofbodies_grid->DateJoined->Visible) { // DateJoined ?>
		<td data-name="DateJoined">
<?php if (!$staffprofbodies->isConfirm()) { ?>
<span id="el$rowindex$_staffprofbodies_DateJoined" class="form-group staffprofbodies_DateJoined">
<input type="text" data-table="staffprofbodies" data-field="x_DateJoined" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" placeholder="<?php echo HtmlEncode($staffprofbodies_grid->DateJoined->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_grid->DateJoined->EditValue ?>"<?php echo $staffprofbodies_grid->DateJoined->editAttributes() ?>>
<?php if (!$staffprofbodies_grid->DateJoined->ReadOnly && !$staffprofbodies_grid->DateJoined->Disabled && !isset($staffprofbodies_grid->DateJoined->EditAttrs["readonly"]) && !isset($staffprofbodies_grid->DateJoined->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesgrid", "x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffprofbodies_DateJoined" class="form-group staffprofbodies_DateJoined">
<span<?php echo $staffprofbodies_grid->DateJoined->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffprofbodies_grid->DateJoined->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateJoined" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" value="<?php echo HtmlEncode($staffprofbodies_grid->DateJoined->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateJoined" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_DateJoined" value="<?php echo HtmlEncode($staffprofbodies_grid->DateJoined->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffprofbodies_grid->DateRenewed->Visible) { // DateRenewed ?>
		<td data-name="DateRenewed">
<?php if (!$staffprofbodies->isConfirm()) { ?>
<span id="el$rowindex$_staffprofbodies_DateRenewed" class="form-group staffprofbodies_DateRenewed">
<input type="text" data-table="staffprofbodies" data-field="x_DateRenewed" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" placeholder="<?php echo HtmlEncode($staffprofbodies_grid->DateRenewed->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_grid->DateRenewed->EditValue ?>"<?php echo $staffprofbodies_grid->DateRenewed->editAttributes() ?>>
<?php if (!$staffprofbodies_grid->DateRenewed->ReadOnly && !$staffprofbodies_grid->DateRenewed->Disabled && !isset($staffprofbodies_grid->DateRenewed->EditAttrs["readonly"]) && !isset($staffprofbodies_grid->DateRenewed->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesgrid", "x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffprofbodies_DateRenewed" class="form-group staffprofbodies_DateRenewed">
<span<?php echo $staffprofbodies_grid->DateRenewed->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffprofbodies_grid->DateRenewed->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateRenewed" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" value="<?php echo HtmlEncode($staffprofbodies_grid->DateRenewed->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateRenewed" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_DateRenewed" value="<?php echo HtmlEncode($staffprofbodies_grid->DateRenewed->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffprofbodies_grid->ValidTo->Visible) { // ValidTo ?>
		<td data-name="ValidTo">
<?php if (!$staffprofbodies->isConfirm()) { ?>
<span id="el$rowindex$_staffprofbodies_ValidTo" class="form-group staffprofbodies_ValidTo">
<input type="text" data-table="staffprofbodies" data-field="x_ValidTo" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" placeholder="<?php echo HtmlEncode($staffprofbodies_grid->ValidTo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_grid->ValidTo->EditValue ?>"<?php echo $staffprofbodies_grid->ValidTo->editAttributes() ?>>
<?php if (!$staffprofbodies_grid->ValidTo->ReadOnly && !$staffprofbodies_grid->ValidTo->Disabled && !isset($staffprofbodies_grid->ValidTo->EditAttrs["readonly"]) && !isset($staffprofbodies_grid->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodiesgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodiesgrid", "x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffprofbodies_ValidTo" class="form-group staffprofbodies_ValidTo">
<span<?php echo $staffprofbodies_grid->ValidTo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffprofbodies_grid->ValidTo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_ValidTo" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($staffprofbodies_grid->ValidTo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ValidTo" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($staffprofbodies_grid->ValidTo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffprofbodies_grid->MemberStatus->Visible) { // MemberStatus ?>
		<td data-name="MemberStatus">
<?php if (!$staffprofbodies->isConfirm()) { ?>
<span id="el$rowindex$_staffprofbodies_MemberStatus" class="form-group staffprofbodies_MemberStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffprofbodies" data-field="x_MemberStatus" data-value-separator="<?php echo $staffprofbodies_grid->MemberStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus"<?php echo $staffprofbodies_grid->MemberStatus->editAttributes() ?>>
			<?php echo $staffprofbodies_grid->MemberStatus->selectOptionListHtml("x{$staffprofbodies_grid->RowIndex}_MemberStatus") ?>
		</select>
</div>
<?php echo $staffprofbodies_grid->MemberStatus->Lookup->getParamTag($staffprofbodies_grid, "p_x" . $staffprofbodies_grid->RowIndex . "_MemberStatus") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_staffprofbodies_MemberStatus" class="form-group staffprofbodies_MemberStatus">
<span<?php echo $staffprofbodies_grid->MemberStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffprofbodies_grid->MemberStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_MemberStatus" name="x<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" id="x<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" value="<?php echo HtmlEncode($staffprofbodies_grid->MemberStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_MemberStatus" name="o<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" id="o<?php echo $staffprofbodies_grid->RowIndex ?>_MemberStatus" value="<?php echo HtmlEncode($staffprofbodies_grid->MemberStatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffprofbodies_grid->ListOptions->render("body", "right", $staffprofbodies_grid->RowIndex);
?>
<script>
loadjs.ready(["fstaffprofbodiesgrid", "load"], function() {
	fstaffprofbodiesgrid.updateLists(<?php echo $staffprofbodies_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($staffprofbodies->CurrentMode == "add" || $staffprofbodies->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $staffprofbodies_grid->FormKeyCountName ?>" id="<?php echo $staffprofbodies_grid->FormKeyCountName ?>" value="<?php echo $staffprofbodies_grid->KeyCount ?>">
<?php echo $staffprofbodies_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffprofbodies->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $staffprofbodies_grid->FormKeyCountName ?>" id="<?php echo $staffprofbodies_grid->FormKeyCountName ?>" value="<?php echo $staffprofbodies_grid->KeyCount ?>">
<?php echo $staffprofbodies_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($staffprofbodies->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fstaffprofbodiesgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffprofbodies_grid->Recordset)
	$staffprofbodies_grid->Recordset->Close();
?>
<?php if ($staffprofbodies_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $staffprofbodies_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffprofbodies_grid->TotalRecords == 0 && !$staffprofbodies->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffprofbodies_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$staffprofbodies_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$staffprofbodies_grid->terminate();
?>