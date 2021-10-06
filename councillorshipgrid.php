<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($councillorship_grid))
	$councillorship_grid = new councillorship_grid();

// Run the page
$councillorship_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_grid->Page_Render();
?>
<?php if (!$councillorship_grid->isExport()) { ?>
<script>
var fcouncillorshipgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fcouncillorshipgrid = new ew.Form("fcouncillorshipgrid", "grid");
	fcouncillorshipgrid.formKeyCountName = '<?php echo $councillorship_grid->FormKeyCountName ?>';

	// Validate form
	fcouncillorshipgrid.validate = function() {
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
			<?php if ($councillorship_grid->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_grid->EmployeeID->caption(), $councillorship_grid->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_grid->EmployeeID->errorMessage()) ?>");
			<?php if ($councillorship_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_grid->LACode->caption(), $councillorship_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_grid->PoliticalParty->Required) { ?>
				elm = this.getElements("x" + infix + "_PoliticalParty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_grid->PoliticalParty->caption(), $councillorship_grid->PoliticalParty->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_grid->Occupation->Required) { ?>
				elm = this.getElements("x" + infix + "_Occupation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_grid->Occupation->caption(), $councillorship_grid->Occupation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_grid->PositionInCouncil->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionInCouncil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_grid->PositionInCouncil->caption(), $councillorship_grid->PositionInCouncil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_grid->Committee->Required) { ?>
				elm = this.getElements("x" + infix + "_Committee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_grid->Committee->caption(), $councillorship_grid->Committee->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_grid->CommitteeRole->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteeRole");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_grid->CommitteeRole->caption(), $councillorship_grid->CommitteeRole->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_grid->CouncilTerm->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilTerm");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_grid->CouncilTerm->caption(), $councillorship_grid->CouncilTerm->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_grid->CouncillorTypeType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorTypeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_grid->CouncillorTypeType->caption(), $councillorship_grid->CouncillorTypeType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_grid->ExitReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_grid->ExitReason->caption(), $councillorship_grid->ExitReason->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fcouncillorshipgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "PoliticalParty", false)) return false;
		if (ew.valueChanged(fobj, infix, "Occupation", false)) return false;
		if (ew.valueChanged(fobj, infix, "PositionInCouncil", false)) return false;
		if (ew.valueChanged(fobj, infix, "Committee", false)) return false;
		if (ew.valueChanged(fobj, infix, "CommitteeRole", false)) return false;
		if (ew.valueChanged(fobj, infix, "CouncilTerm", false)) return false;
		if (ew.valueChanged(fobj, infix, "CouncillorTypeType", false)) return false;
		if (ew.valueChanged(fobj, infix, "ExitReason", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcouncillorshipgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillorshipgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncillorshipgrid.lists["x_EmployeeID"] = <?php echo $councillorship_grid->EmployeeID->Lookup->toClientList($councillorship_grid) ?>;
	fcouncillorshipgrid.lists["x_EmployeeID"].options = <?php echo JsonEncode($councillorship_grid->EmployeeID->lookupOptions()) ?>;
	fcouncillorshipgrid.autoSuggests["x_EmployeeID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncillorshipgrid.lists["x_LACode"] = <?php echo $councillorship_grid->LACode->Lookup->toClientList($councillorship_grid) ?>;
	fcouncillorshipgrid.lists["x_LACode"].options = <?php echo JsonEncode($councillorship_grid->LACode->lookupOptions()) ?>;
	fcouncillorshipgrid.lists["x_PoliticalParty"] = <?php echo $councillorship_grid->PoliticalParty->Lookup->toClientList($councillorship_grid) ?>;
	fcouncillorshipgrid.lists["x_PoliticalParty"].options = <?php echo JsonEncode($councillorship_grid->PoliticalParty->lookupOptions()) ?>;
	fcouncillorshipgrid.lists["x_Occupation"] = <?php echo $councillorship_grid->Occupation->Lookup->toClientList($councillorship_grid) ?>;
	fcouncillorshipgrid.lists["x_Occupation"].options = <?php echo JsonEncode($councillorship_grid->Occupation->lookupOptions()) ?>;
	fcouncillorshipgrid.lists["x_PositionInCouncil"] = <?php echo $councillorship_grid->PositionInCouncil->Lookup->toClientList($councillorship_grid) ?>;
	fcouncillorshipgrid.lists["x_PositionInCouncil"].options = <?php echo JsonEncode($councillorship_grid->PositionInCouncil->lookupOptions()) ?>;
	fcouncillorshipgrid.lists["x_Committee"] = <?php echo $councillorship_grid->Committee->Lookup->toClientList($councillorship_grid) ?>;
	fcouncillorshipgrid.lists["x_Committee"].options = <?php echo JsonEncode($councillorship_grid->Committee->lookupOptions()) ?>;
	fcouncillorshipgrid.lists["x_CommitteeRole"] = <?php echo $councillorship_grid->CommitteeRole->Lookup->toClientList($councillorship_grid) ?>;
	fcouncillorshipgrid.lists["x_CommitteeRole"].options = <?php echo JsonEncode($councillorship_grid->CommitteeRole->lookupOptions()) ?>;
	fcouncillorshipgrid.lists["x_CouncilTerm"] = <?php echo $councillorship_grid->CouncilTerm->Lookup->toClientList($councillorship_grid) ?>;
	fcouncillorshipgrid.lists["x_CouncilTerm"].options = <?php echo JsonEncode($councillorship_grid->CouncilTerm->lookupOptions()) ?>;
	fcouncillorshipgrid.lists["x_CouncillorTypeType"] = <?php echo $councillorship_grid->CouncillorTypeType->Lookup->toClientList($councillorship_grid) ?>;
	fcouncillorshipgrid.lists["x_CouncillorTypeType"].options = <?php echo JsonEncode($councillorship_grid->CouncillorTypeType->lookupOptions()) ?>;
	fcouncillorshipgrid.lists["x_ExitReason"] = <?php echo $councillorship_grid->ExitReason->Lookup->toClientList($councillorship_grid) ?>;
	fcouncillorshipgrid.lists["x_ExitReason"].options = <?php echo JsonEncode($councillorship_grid->ExitReason->lookupOptions()) ?>;
	loadjs.done("fcouncillorshipgrid");
});
</script>
<?php } ?>
<?php
$councillorship_grid->renderOtherOptions();
?>
<?php if ($councillorship_grid->TotalRecords > 0 || $councillorship->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($councillorship_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> councillorship">
<?php if ($councillorship_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $councillorship_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fcouncillorshipgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_councillorship" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_councillorshipgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$councillorship->RowType = ROWTYPE_HEADER;

// Render list options
$councillorship_grid->renderListOptions();

// Render list options (header, left)
$councillorship_grid->ListOptions->render("header", "left");
?>
<?php if ($councillorship_grid->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($councillorship_grid->SortUrl($councillorship_grid->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $councillorship_grid->EmployeeID->headerCellClass() ?>"><div id="elh_councillorship_EmployeeID" class="councillorship_EmployeeID"><div class="ew-table-header-caption"><?php echo $councillorship_grid->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $councillorship_grid->EmployeeID->headerCellClass() ?>"><div><div id="elh_councillorship_EmployeeID" class="councillorship_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_grid->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_grid->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_grid->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_grid->LACode->Visible) { // LACode ?>
	<?php if ($councillorship_grid->SortUrl($councillorship_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $councillorship_grid->LACode->headerCellClass() ?>"><div id="elh_councillorship_LACode" class="councillorship_LACode"><div class="ew-table-header-caption"><?php echo $councillorship_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $councillorship_grid->LACode->headerCellClass() ?>"><div><div id="elh_councillorship_LACode" class="councillorship_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_grid->PoliticalParty->Visible) { // PoliticalParty ?>
	<?php if ($councillorship_grid->SortUrl($councillorship_grid->PoliticalParty) == "") { ?>
		<th data-name="PoliticalParty" class="<?php echo $councillorship_grid->PoliticalParty->headerCellClass() ?>"><div id="elh_councillorship_PoliticalParty" class="councillorship_PoliticalParty"><div class="ew-table-header-caption"><?php echo $councillorship_grid->PoliticalParty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PoliticalParty" class="<?php echo $councillorship_grid->PoliticalParty->headerCellClass() ?>"><div><div id="elh_councillorship_PoliticalParty" class="councillorship_PoliticalParty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_grid->PoliticalParty->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_grid->PoliticalParty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_grid->PoliticalParty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_grid->Occupation->Visible) { // Occupation ?>
	<?php if ($councillorship_grid->SortUrl($councillorship_grid->Occupation) == "") { ?>
		<th data-name="Occupation" class="<?php echo $councillorship_grid->Occupation->headerCellClass() ?>"><div id="elh_councillorship_Occupation" class="councillorship_Occupation"><div class="ew-table-header-caption"><?php echo $councillorship_grid->Occupation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Occupation" class="<?php echo $councillorship_grid->Occupation->headerCellClass() ?>"><div><div id="elh_councillorship_Occupation" class="councillorship_Occupation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_grid->Occupation->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_grid->Occupation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_grid->Occupation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_grid->PositionInCouncil->Visible) { // PositionInCouncil ?>
	<?php if ($councillorship_grid->SortUrl($councillorship_grid->PositionInCouncil) == "") { ?>
		<th data-name="PositionInCouncil" class="<?php echo $councillorship_grid->PositionInCouncil->headerCellClass() ?>"><div id="elh_councillorship_PositionInCouncil" class="councillorship_PositionInCouncil"><div class="ew-table-header-caption"><?php echo $councillorship_grid->PositionInCouncil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionInCouncil" class="<?php echo $councillorship_grid->PositionInCouncil->headerCellClass() ?>"><div><div id="elh_councillorship_PositionInCouncil" class="councillorship_PositionInCouncil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_grid->PositionInCouncil->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_grid->PositionInCouncil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_grid->PositionInCouncil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_grid->Committee->Visible) { // Committee ?>
	<?php if ($councillorship_grid->SortUrl($councillorship_grid->Committee) == "") { ?>
		<th data-name="Committee" class="<?php echo $councillorship_grid->Committee->headerCellClass() ?>"><div id="elh_councillorship_Committee" class="councillorship_Committee"><div class="ew-table-header-caption"><?php echo $councillorship_grid->Committee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Committee" class="<?php echo $councillorship_grid->Committee->headerCellClass() ?>"><div><div id="elh_councillorship_Committee" class="councillorship_Committee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_grid->Committee->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_grid->Committee->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_grid->Committee->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_grid->CommitteeRole->Visible) { // CommitteeRole ?>
	<?php if ($councillorship_grid->SortUrl($councillorship_grid->CommitteeRole) == "") { ?>
		<th data-name="CommitteeRole" class="<?php echo $councillorship_grid->CommitteeRole->headerCellClass() ?>"><div id="elh_councillorship_CommitteeRole" class="councillorship_CommitteeRole"><div class="ew-table-header-caption"><?php echo $councillorship_grid->CommitteeRole->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CommitteeRole" class="<?php echo $councillorship_grid->CommitteeRole->headerCellClass() ?>"><div><div id="elh_councillorship_CommitteeRole" class="councillorship_CommitteeRole">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_grid->CommitteeRole->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_grid->CommitteeRole->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_grid->CommitteeRole->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_grid->CouncilTerm->Visible) { // CouncilTerm ?>
	<?php if ($councillorship_grid->SortUrl($councillorship_grid->CouncilTerm) == "") { ?>
		<th data-name="CouncilTerm" class="<?php echo $councillorship_grid->CouncilTerm->headerCellClass() ?>"><div id="elh_councillorship_CouncilTerm" class="councillorship_CouncilTerm"><div class="ew-table-header-caption"><?php echo $councillorship_grid->CouncilTerm->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilTerm" class="<?php echo $councillorship_grid->CouncilTerm->headerCellClass() ?>"><div><div id="elh_councillorship_CouncilTerm" class="councillorship_CouncilTerm">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_grid->CouncilTerm->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_grid->CouncilTerm->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_grid->CouncilTerm->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_grid->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
	<?php if ($councillorship_grid->SortUrl($councillorship_grid->CouncillorTypeType) == "") { ?>
		<th data-name="CouncillorTypeType" class="<?php echo $councillorship_grid->CouncillorTypeType->headerCellClass() ?>"><div id="elh_councillorship_CouncillorTypeType" class="councillorship_CouncillorTypeType"><div class="ew-table-header-caption"><?php echo $councillorship_grid->CouncillorTypeType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncillorTypeType" class="<?php echo $councillorship_grid->CouncillorTypeType->headerCellClass() ?>"><div><div id="elh_councillorship_CouncillorTypeType" class="councillorship_CouncillorTypeType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_grid->CouncillorTypeType->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_grid->CouncillorTypeType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_grid->CouncillorTypeType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_grid->ExitReason->Visible) { // ExitReason ?>
	<?php if ($councillorship_grid->SortUrl($councillorship_grid->ExitReason) == "") { ?>
		<th data-name="ExitReason" class="<?php echo $councillorship_grid->ExitReason->headerCellClass() ?>"><div id="elh_councillorship_ExitReason" class="councillorship_ExitReason"><div class="ew-table-header-caption"><?php echo $councillorship_grid->ExitReason->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExitReason" class="<?php echo $councillorship_grid->ExitReason->headerCellClass() ?>"><div><div id="elh_councillorship_ExitReason" class="councillorship_ExitReason">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_grid->ExitReason->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_grid->ExitReason->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_grid->ExitReason->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$councillorship_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$councillorship_grid->StartRecord = 1;
$councillorship_grid->StopRecord = $councillorship_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($councillorship->isConfirm() || $councillorship_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($councillorship_grid->FormKeyCountName) && ($councillorship_grid->isGridAdd() || $councillorship_grid->isGridEdit() || $councillorship->isConfirm())) {
		$councillorship_grid->KeyCount = $CurrentForm->getValue($councillorship_grid->FormKeyCountName);
		$councillorship_grid->StopRecord = $councillorship_grid->StartRecord + $councillorship_grid->KeyCount - 1;
	}
}
$councillorship_grid->RecordCount = $councillorship_grid->StartRecord - 1;
if ($councillorship_grid->Recordset && !$councillorship_grid->Recordset->EOF) {
	$councillorship_grid->Recordset->moveFirst();
	$selectLimit = $councillorship_grid->UseSelectLimit;
	if (!$selectLimit && $councillorship_grid->StartRecord > 1)
		$councillorship_grid->Recordset->move($councillorship_grid->StartRecord - 1);
} elseif (!$councillorship->AllowAddDeleteRow && $councillorship_grid->StopRecord == 0) {
	$councillorship_grid->StopRecord = $councillorship->GridAddRowCount;
}

// Initialize aggregate
$councillorship->RowType = ROWTYPE_AGGREGATEINIT;
$councillorship->resetAttributes();
$councillorship_grid->renderRow();
if ($councillorship_grid->isGridAdd())
	$councillorship_grid->RowIndex = 0;
if ($councillorship_grid->isGridEdit())
	$councillorship_grid->RowIndex = 0;
while ($councillorship_grid->RecordCount < $councillorship_grid->StopRecord) {
	$councillorship_grid->RecordCount++;
	if ($councillorship_grid->RecordCount >= $councillorship_grid->StartRecord) {
		$councillorship_grid->RowCount++;
		if ($councillorship_grid->isGridAdd() || $councillorship_grid->isGridEdit() || $councillorship->isConfirm()) {
			$councillorship_grid->RowIndex++;
			$CurrentForm->Index = $councillorship_grid->RowIndex;
			if ($CurrentForm->hasValue($councillorship_grid->FormActionName) && ($councillorship->isConfirm() || $councillorship_grid->EventCancelled))
				$councillorship_grid->RowAction = strval($CurrentForm->getValue($councillorship_grid->FormActionName));
			elseif ($councillorship_grid->isGridAdd())
				$councillorship_grid->RowAction = "insert";
			else
				$councillorship_grid->RowAction = "";
		}

		// Set up key count
		$councillorship_grid->KeyCount = $councillorship_grid->RowIndex;

		// Init row class and style
		$councillorship->resetAttributes();
		$councillorship->CssClass = "";
		if ($councillorship_grid->isGridAdd()) {
			if ($councillorship->CurrentMode == "copy") {
				$councillorship_grid->loadRowValues($councillorship_grid->Recordset); // Load row values
				$councillorship_grid->setRecordKey($councillorship_grid->RowOldKey, $councillorship_grid->Recordset); // Set old record key
			} else {
				$councillorship_grid->loadRowValues(); // Load default values
				$councillorship_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$councillorship_grid->loadRowValues($councillorship_grid->Recordset); // Load row values
		}
		$councillorship->RowType = ROWTYPE_VIEW; // Render view
		if ($councillorship_grid->isGridAdd()) // Grid add
			$councillorship->RowType = ROWTYPE_ADD; // Render add
		if ($councillorship_grid->isGridAdd() && $councillorship->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$councillorship_grid->restoreCurrentRowFormValues($councillorship_grid->RowIndex); // Restore form values
		if ($councillorship_grid->isGridEdit()) { // Grid edit
			if ($councillorship->EventCancelled)
				$councillorship_grid->restoreCurrentRowFormValues($councillorship_grid->RowIndex); // Restore form values
			if ($councillorship_grid->RowAction == "insert")
				$councillorship->RowType = ROWTYPE_ADD; // Render add
			else
				$councillorship->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($councillorship_grid->isGridEdit() && ($councillorship->RowType == ROWTYPE_EDIT || $councillorship->RowType == ROWTYPE_ADD) && $councillorship->EventCancelled) // Update failed
			$councillorship_grid->restoreCurrentRowFormValues($councillorship_grid->RowIndex); // Restore form values
		if ($councillorship->RowType == ROWTYPE_EDIT) // Edit row
			$councillorship_grid->EditRowCount++;
		if ($councillorship->isConfirm()) // Confirm row
			$councillorship_grid->restoreCurrentRowFormValues($councillorship_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$councillorship->RowAttrs->merge(["data-rowindex" => $councillorship_grid->RowCount, "id" => "r" . $councillorship_grid->RowCount . "_councillorship", "data-rowtype" => $councillorship->RowType]);

		// Render row
		$councillorship_grid->renderRow();

		// Render list options
		$councillorship_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($councillorship_grid->RowAction != "delete" && $councillorship_grid->RowAction != "insertdelete" && !($councillorship_grid->RowAction == "insert" && $councillorship->isConfirm() && $councillorship_grid->emptyRow())) {
?>
	<tr <?php echo $councillorship->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillorship_grid->ListOptions->render("body", "left", $councillorship_grid->RowCount);
?>
	<?php if ($councillorship_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $councillorship_grid->EmployeeID->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($councillorship_grid->EmployeeID->getSessionValue() != "") { ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_EmployeeID" class="form-group">
<span<?php echo $councillorship_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" name="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_EmployeeID" class="form-group">
<?php
$onchange = $councillorship_grid->EmployeeID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillorship_grid->EmployeeID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID">
	<input type="text" class="form-control" name="sv_x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="sv_x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo RemoveHtml($councillorship_grid->EmployeeID->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($councillorship_grid->EmployeeID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillorship_grid->EmployeeID->getPlaceHolder()) ?>"<?php echo $councillorship_grid->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" data-value-separator="<?php echo $councillorship_grid->EmployeeID->displayValueSeparatorAttribute() ?>" name="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorshipgrid"], function() {
	fcouncillorshipgrid.createAutoSuggest({"id":"x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID","forceSelect":false});
});
</script>
<?php echo $councillorship_grid->EmployeeID->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_EmployeeID") ?>
</span>
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" name="o<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="o<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($councillorship_grid->EmployeeID->getSessionValue() != "") { ?>

<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_EmployeeID" class="form-group">
<span<?php echo $councillorship_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" name="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<?php
$onchange = $councillorship_grid->EmployeeID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillorship_grid->EmployeeID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID">
	<input type="text" class="form-control" name="sv_x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="sv_x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo RemoveHtml($councillorship_grid->EmployeeID->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($councillorship_grid->EmployeeID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillorship_grid->EmployeeID->getPlaceHolder()) ?>"<?php echo $councillorship_grid->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" data-value-separator="<?php echo $councillorship_grid->EmployeeID->displayValueSeparatorAttribute() ?>" name="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorshipgrid"], function() {
	fcouncillorshipgrid.createAutoSuggest({"id":"x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID","forceSelect":false});
});
</script>
<?php echo $councillorship_grid->EmployeeID->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_EmployeeID") ?>

<?php } ?>

<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" name="o<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="o<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->OldValue != null ? $councillorship_grid->EmployeeID->OldValue : $councillorship_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_EmployeeID">
<span<?php echo $councillorship_grid->EmployeeID->viewAttributes() ?>><?php echo $councillorship_grid->EmployeeID->getViewValue() ?></span>
</span>
<?php if (!$councillorship->isConfirm()) { ?>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" name="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" name="o<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="o<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" name="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" name="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $councillorship_grid->LACode->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($councillorship_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_LACode" class="form-group">
<span<?php echo $councillorship_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $councillorship_grid->RowIndex ?>_LACode" name="x<?php echo $councillorship_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_LACode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_LACode" data-value-separator="<?php echo $councillorship_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_LACode" name="x<?php echo $councillorship_grid->RowIndex ?>_LACode"<?php echo $councillorship_grid->LACode->editAttributes() ?>>
			<?php echo $councillorship_grid->LACode->selectOptionListHtml("x{$councillorship_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $councillorship_grid->LACode->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_LACode" name="o<?php echo $councillorship_grid->RowIndex ?>_LACode" id="o<?php echo $councillorship_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($councillorship_grid->LACode->getSessionValue() != "") { ?>

<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_LACode" class="form-group">
<span<?php echo $councillorship_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->LACode->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $councillorship_grid->RowIndex ?>_LACode" name="x<?php echo $councillorship_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_grid->LACode->CurrentValue) ?>">
<?php } else { ?>

<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_LACode" data-value-separator="<?php echo $councillorship_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_LACode" name="x<?php echo $councillorship_grid->RowIndex ?>_LACode"<?php echo $councillorship_grid->LACode->editAttributes() ?>>
			<?php echo $councillorship_grid->LACode->selectOptionListHtml("x{$councillorship_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $councillorship_grid->LACode->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_LACode") ?>

<?php } ?>

<input type="hidden" data-table="councillorship" data-field="x_LACode" name="o<?php echo $councillorship_grid->RowIndex ?>_LACode" id="o<?php echo $councillorship_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_grid->LACode->OldValue != null ? $councillorship_grid->LACode->OldValue : $councillorship_grid->LACode->CurrentValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_LACode">
<span<?php echo $councillorship_grid->LACode->viewAttributes() ?>><?php echo $councillorship_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$councillorship->isConfirm()) { ?>
<input type="hidden" data-table="councillorship" data-field="x_LACode" name="x<?php echo $councillorship_grid->RowIndex ?>_LACode" id="x<?php echo $councillorship_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_LACode" name="o<?php echo $councillorship_grid->RowIndex ?>_LACode" id="o<?php echo $councillorship_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillorship" data-field="x_LACode" name="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_LACode" id="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_LACode" name="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_LACode" id="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_grid->PoliticalParty->Visible) { // PoliticalParty ?>
		<td data-name="PoliticalParty" <?php echo $councillorship_grid->PoliticalParty->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_PoliticalParty" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PoliticalParty" data-value-separator="<?php echo $councillorship_grid->PoliticalParty->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" name="x<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty"<?php echo $councillorship_grid->PoliticalParty->editAttributes() ?>>
			<?php echo $councillorship_grid->PoliticalParty->selectOptionListHtml("x{$councillorship_grid->RowIndex}_PoliticalParty") ?>
		</select>
</div>
<?php echo $councillorship_grid->PoliticalParty->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_PoliticalParty") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_PoliticalParty" name="o<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" id="o<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" value="<?php echo HtmlEncode($councillorship_grid->PoliticalParty->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_PoliticalParty" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PoliticalParty" data-value-separator="<?php echo $councillorship_grid->PoliticalParty->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" name="x<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty"<?php echo $councillorship_grid->PoliticalParty->editAttributes() ?>>
			<?php echo $councillorship_grid->PoliticalParty->selectOptionListHtml("x{$councillorship_grid->RowIndex}_PoliticalParty") ?>
		</select>
</div>
<?php echo $councillorship_grid->PoliticalParty->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_PoliticalParty") ?>
</span>
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_PoliticalParty">
<span<?php echo $councillorship_grid->PoliticalParty->viewAttributes() ?>><?php echo $councillorship_grid->PoliticalParty->getViewValue() ?></span>
</span>
<?php if (!$councillorship->isConfirm()) { ?>
<input type="hidden" data-table="councillorship" data-field="x_PoliticalParty" name="x<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" id="x<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" value="<?php echo HtmlEncode($councillorship_grid->PoliticalParty->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_PoliticalParty" name="o<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" id="o<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" value="<?php echo HtmlEncode($councillorship_grid->PoliticalParty->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillorship" data-field="x_PoliticalParty" name="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" id="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" value="<?php echo HtmlEncode($councillorship_grid->PoliticalParty->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_PoliticalParty" name="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" id="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" value="<?php echo HtmlEncode($councillorship_grid->PoliticalParty->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_grid->Occupation->Visible) { // Occupation ?>
		<td data-name="Occupation" <?php echo $councillorship_grid->Occupation->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_Occupation" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Occupation" data-value-separator="<?php echo $councillorship_grid->Occupation->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_Occupation" name="x<?php echo $councillorship_grid->RowIndex ?>_Occupation"<?php echo $councillorship_grid->Occupation->editAttributes() ?>>
			<?php echo $councillorship_grid->Occupation->selectOptionListHtml("x{$councillorship_grid->RowIndex}_Occupation") ?>
		</select>
</div>
<?php echo $councillorship_grid->Occupation->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_Occupation") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_Occupation" name="o<?php echo $councillorship_grid->RowIndex ?>_Occupation" id="o<?php echo $councillorship_grid->RowIndex ?>_Occupation" value="<?php echo HtmlEncode($councillorship_grid->Occupation->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_Occupation" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Occupation" data-value-separator="<?php echo $councillorship_grid->Occupation->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_Occupation" name="x<?php echo $councillorship_grid->RowIndex ?>_Occupation"<?php echo $councillorship_grid->Occupation->editAttributes() ?>>
			<?php echo $councillorship_grid->Occupation->selectOptionListHtml("x{$councillorship_grid->RowIndex}_Occupation") ?>
		</select>
</div>
<?php echo $councillorship_grid->Occupation->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_Occupation") ?>
</span>
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_Occupation">
<span<?php echo $councillorship_grid->Occupation->viewAttributes() ?>><?php echo $councillorship_grid->Occupation->getViewValue() ?></span>
</span>
<?php if (!$councillorship->isConfirm()) { ?>
<input type="hidden" data-table="councillorship" data-field="x_Occupation" name="x<?php echo $councillorship_grid->RowIndex ?>_Occupation" id="x<?php echo $councillorship_grid->RowIndex ?>_Occupation" value="<?php echo HtmlEncode($councillorship_grid->Occupation->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_Occupation" name="o<?php echo $councillorship_grid->RowIndex ?>_Occupation" id="o<?php echo $councillorship_grid->RowIndex ?>_Occupation" value="<?php echo HtmlEncode($councillorship_grid->Occupation->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillorship" data-field="x_Occupation" name="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_Occupation" id="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_Occupation" value="<?php echo HtmlEncode($councillorship_grid->Occupation->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_Occupation" name="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_Occupation" id="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_Occupation" value="<?php echo HtmlEncode($councillorship_grid->Occupation->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_grid->PositionInCouncil->Visible) { // PositionInCouncil ?>
		<td data-name="PositionInCouncil" <?php echo $councillorship_grid->PositionInCouncil->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_PositionInCouncil" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PositionInCouncil" data-value-separator="<?php echo $councillorship_grid->PositionInCouncil->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" name="x<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil"<?php echo $councillorship_grid->PositionInCouncil->editAttributes() ?>>
			<?php echo $councillorship_grid->PositionInCouncil->selectOptionListHtml("x{$councillorship_grid->RowIndex}_PositionInCouncil") ?>
		</select>
</div>
<?php echo $councillorship_grid->PositionInCouncil->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_PositionInCouncil") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_PositionInCouncil" name="o<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" id="o<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_grid->PositionInCouncil->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PositionInCouncil" data-value-separator="<?php echo $councillorship_grid->PositionInCouncil->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" name="x<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil"<?php echo $councillorship_grid->PositionInCouncil->editAttributes() ?>>
			<?php echo $councillorship_grid->PositionInCouncil->selectOptionListHtml("x{$councillorship_grid->RowIndex}_PositionInCouncil") ?>
		</select>
</div>
<?php echo $councillorship_grid->PositionInCouncil->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_PositionInCouncil") ?>
<input type="hidden" data-table="councillorship" data-field="x_PositionInCouncil" name="o<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" id="o<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_grid->PositionInCouncil->OldValue != null ? $councillorship_grid->PositionInCouncil->OldValue : $councillorship_grid->PositionInCouncil->CurrentValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_PositionInCouncil">
<span<?php echo $councillorship_grid->PositionInCouncil->viewAttributes() ?>><?php echo $councillorship_grid->PositionInCouncil->getViewValue() ?></span>
</span>
<?php if (!$councillorship->isConfirm()) { ?>
<input type="hidden" data-table="councillorship" data-field="x_PositionInCouncil" name="x<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" id="x<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_grid->PositionInCouncil->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_PositionInCouncil" name="o<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" id="o<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_grid->PositionInCouncil->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillorship" data-field="x_PositionInCouncil" name="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" id="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_grid->PositionInCouncil->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_PositionInCouncil" name="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" id="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_grid->PositionInCouncil->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_grid->Committee->Visible) { // Committee ?>
		<td data-name="Committee" <?php echo $councillorship_grid->Committee->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_Committee" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Committee" data-value-separator="<?php echo $councillorship_grid->Committee->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_Committee" name="x<?php echo $councillorship_grid->RowIndex ?>_Committee"<?php echo $councillorship_grid->Committee->editAttributes() ?>>
			<?php echo $councillorship_grid->Committee->selectOptionListHtml("x{$councillorship_grid->RowIndex}_Committee") ?>
		</select>
</div>
<?php echo $councillorship_grid->Committee->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_Committee") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_Committee" name="o<?php echo $councillorship_grid->RowIndex ?>_Committee" id="o<?php echo $councillorship_grid->RowIndex ?>_Committee" value="<?php echo HtmlEncode($councillorship_grid->Committee->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_Committee" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Committee" data-value-separator="<?php echo $councillorship_grid->Committee->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_Committee" name="x<?php echo $councillorship_grid->RowIndex ?>_Committee"<?php echo $councillorship_grid->Committee->editAttributes() ?>>
			<?php echo $councillorship_grid->Committee->selectOptionListHtml("x{$councillorship_grid->RowIndex}_Committee") ?>
		</select>
</div>
<?php echo $councillorship_grid->Committee->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_Committee") ?>
</span>
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_Committee">
<span<?php echo $councillorship_grid->Committee->viewAttributes() ?>><?php echo $councillorship_grid->Committee->getViewValue() ?></span>
</span>
<?php if (!$councillorship->isConfirm()) { ?>
<input type="hidden" data-table="councillorship" data-field="x_Committee" name="x<?php echo $councillorship_grid->RowIndex ?>_Committee" id="x<?php echo $councillorship_grid->RowIndex ?>_Committee" value="<?php echo HtmlEncode($councillorship_grid->Committee->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_Committee" name="o<?php echo $councillorship_grid->RowIndex ?>_Committee" id="o<?php echo $councillorship_grid->RowIndex ?>_Committee" value="<?php echo HtmlEncode($councillorship_grid->Committee->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillorship" data-field="x_Committee" name="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_Committee" id="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_Committee" value="<?php echo HtmlEncode($councillorship_grid->Committee->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_Committee" name="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_Committee" id="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_Committee" value="<?php echo HtmlEncode($councillorship_grid->Committee->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_grid->CommitteeRole->Visible) { // CommitteeRole ?>
		<td data-name="CommitteeRole" <?php echo $councillorship_grid->CommitteeRole->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_CommitteeRole" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CommitteeRole" data-value-separator="<?php echo $councillorship_grid->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" name="x<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole"<?php echo $councillorship_grid->CommitteeRole->editAttributes() ?>>
			<?php echo $councillorship_grid->CommitteeRole->selectOptionListHtml("x{$councillorship_grid->RowIndex}_CommitteeRole") ?>
		</select>
</div>
<?php echo $councillorship_grid->CommitteeRole->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_CommitteeRole") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_CommitteeRole" name="o<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" id="o<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($councillorship_grid->CommitteeRole->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_CommitteeRole" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CommitteeRole" data-value-separator="<?php echo $councillorship_grid->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" name="x<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole"<?php echo $councillorship_grid->CommitteeRole->editAttributes() ?>>
			<?php echo $councillorship_grid->CommitteeRole->selectOptionListHtml("x{$councillorship_grid->RowIndex}_CommitteeRole") ?>
		</select>
</div>
<?php echo $councillorship_grid->CommitteeRole->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_CommitteeRole") ?>
</span>
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_CommitteeRole">
<span<?php echo $councillorship_grid->CommitteeRole->viewAttributes() ?>><?php echo $councillorship_grid->CommitteeRole->getViewValue() ?></span>
</span>
<?php if (!$councillorship->isConfirm()) { ?>
<input type="hidden" data-table="councillorship" data-field="x_CommitteeRole" name="x<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" id="x<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($councillorship_grid->CommitteeRole->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_CommitteeRole" name="o<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" id="o<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($councillorship_grid->CommitteeRole->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillorship" data-field="x_CommitteeRole" name="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" id="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($councillorship_grid->CommitteeRole->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_CommitteeRole" name="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" id="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($councillorship_grid->CommitteeRole->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_grid->CouncilTerm->Visible) { // CouncilTerm ?>
		<td data-name="CouncilTerm" <?php echo $councillorship_grid->CouncilTerm->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_CouncilTerm" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncilTerm" data-value-separator="<?php echo $councillorship_grid->CouncilTerm->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" name="x<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm"<?php echo $councillorship_grid->CouncilTerm->editAttributes() ?>>
			<?php echo $councillorship_grid->CouncilTerm->selectOptionListHtml("x{$councillorship_grid->RowIndex}_CouncilTerm") ?>
		</select>
</div>
<?php echo $councillorship_grid->CouncilTerm->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_CouncilTerm") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_CouncilTerm" name="o<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" id="o<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" value="<?php echo HtmlEncode($councillorship_grid->CouncilTerm->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncilTerm" data-value-separator="<?php echo $councillorship_grid->CouncilTerm->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" name="x<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm"<?php echo $councillorship_grid->CouncilTerm->editAttributes() ?>>
			<?php echo $councillorship_grid->CouncilTerm->selectOptionListHtml("x{$councillorship_grid->RowIndex}_CouncilTerm") ?>
		</select>
</div>
<?php echo $councillorship_grid->CouncilTerm->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_CouncilTerm") ?>
<input type="hidden" data-table="councillorship" data-field="x_CouncilTerm" name="o<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" id="o<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" value="<?php echo HtmlEncode($councillorship_grid->CouncilTerm->OldValue != null ? $councillorship_grid->CouncilTerm->OldValue : $councillorship_grid->CouncilTerm->CurrentValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_CouncilTerm">
<span<?php echo $councillorship_grid->CouncilTerm->viewAttributes() ?>><?php echo $councillorship_grid->CouncilTerm->getViewValue() ?></span>
</span>
<?php if (!$councillorship->isConfirm()) { ?>
<input type="hidden" data-table="councillorship" data-field="x_CouncilTerm" name="x<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" id="x<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" value="<?php echo HtmlEncode($councillorship_grid->CouncilTerm->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_CouncilTerm" name="o<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" id="o<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" value="<?php echo HtmlEncode($councillorship_grid->CouncilTerm->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillorship" data-field="x_CouncilTerm" name="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" id="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" value="<?php echo HtmlEncode($councillorship_grid->CouncilTerm->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_CouncilTerm" name="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" id="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" value="<?php echo HtmlEncode($councillorship_grid->CouncilTerm->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_grid->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
		<td data-name="CouncillorTypeType" <?php echo $councillorship_grid->CouncillorTypeType->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_CouncillorTypeType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncillorTypeType" data-value-separator="<?php echo $councillorship_grid->CouncillorTypeType->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" name="x<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType"<?php echo $councillorship_grid->CouncillorTypeType->editAttributes() ?>>
			<?php echo $councillorship_grid->CouncillorTypeType->selectOptionListHtml("x{$councillorship_grid->RowIndex}_CouncillorTypeType") ?>
		</select>
</div>
<?php echo $councillorship_grid->CouncillorTypeType->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_CouncillorTypeType") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_CouncillorTypeType" name="o<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" id="o<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" value="<?php echo HtmlEncode($councillorship_grid->CouncillorTypeType->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_CouncillorTypeType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncillorTypeType" data-value-separator="<?php echo $councillorship_grid->CouncillorTypeType->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" name="x<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType"<?php echo $councillorship_grid->CouncillorTypeType->editAttributes() ?>>
			<?php echo $councillorship_grid->CouncillorTypeType->selectOptionListHtml("x{$councillorship_grid->RowIndex}_CouncillorTypeType") ?>
		</select>
</div>
<?php echo $councillorship_grid->CouncillorTypeType->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_CouncillorTypeType") ?>
</span>
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_CouncillorTypeType">
<span<?php echo $councillorship_grid->CouncillorTypeType->viewAttributes() ?>><?php echo $councillorship_grid->CouncillorTypeType->getViewValue() ?></span>
</span>
<?php if (!$councillorship->isConfirm()) { ?>
<input type="hidden" data-table="councillorship" data-field="x_CouncillorTypeType" name="x<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" id="x<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" value="<?php echo HtmlEncode($councillorship_grid->CouncillorTypeType->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_CouncillorTypeType" name="o<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" id="o<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" value="<?php echo HtmlEncode($councillorship_grid->CouncillorTypeType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillorship" data-field="x_CouncillorTypeType" name="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" id="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" value="<?php echo HtmlEncode($councillorship_grid->CouncillorTypeType->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_CouncillorTypeType" name="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" id="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" value="<?php echo HtmlEncode($councillorship_grid->CouncillorTypeType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_grid->ExitReason->Visible) { // ExitReason ?>
		<td data-name="ExitReason" <?php echo $councillorship_grid->ExitReason->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_ExitReason" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_ExitReason" data-value-separator="<?php echo $councillorship_grid->ExitReason->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_ExitReason" name="x<?php echo $councillorship_grid->RowIndex ?>_ExitReason"<?php echo $councillorship_grid->ExitReason->editAttributes() ?>>
			<?php echo $councillorship_grid->ExitReason->selectOptionListHtml("x{$councillorship_grid->RowIndex}_ExitReason") ?>
		</select>
</div>
<?php echo $councillorship_grid->ExitReason->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_ExitReason") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_ExitReason" name="o<?php echo $councillorship_grid->RowIndex ?>_ExitReason" id="o<?php echo $councillorship_grid->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($councillorship_grid->ExitReason->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_ExitReason" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_ExitReason" data-value-separator="<?php echo $councillorship_grid->ExitReason->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_ExitReason" name="x<?php echo $councillorship_grid->RowIndex ?>_ExitReason"<?php echo $councillorship_grid->ExitReason->editAttributes() ?>>
			<?php echo $councillorship_grid->ExitReason->selectOptionListHtml("x{$councillorship_grid->RowIndex}_ExitReason") ?>
		</select>
</div>
<?php echo $councillorship_grid->ExitReason->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_ExitReason") ?>
</span>
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_grid->RowCount ?>_councillorship_ExitReason">
<span<?php echo $councillorship_grid->ExitReason->viewAttributes() ?>><?php echo $councillorship_grid->ExitReason->getViewValue() ?></span>
</span>
<?php if (!$councillorship->isConfirm()) { ?>
<input type="hidden" data-table="councillorship" data-field="x_ExitReason" name="x<?php echo $councillorship_grid->RowIndex ?>_ExitReason" id="x<?php echo $councillorship_grid->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($councillorship_grid->ExitReason->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_ExitReason" name="o<?php echo $councillorship_grid->RowIndex ?>_ExitReason" id="o<?php echo $councillorship_grid->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($councillorship_grid->ExitReason->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="councillorship" data-field="x_ExitReason" name="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_ExitReason" id="fcouncillorshipgrid$x<?php echo $councillorship_grid->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($councillorship_grid->ExitReason->FormValue) ?>">
<input type="hidden" data-table="councillorship" data-field="x_ExitReason" name="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_ExitReason" id="fcouncillorshipgrid$o<?php echo $councillorship_grid->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($councillorship_grid->ExitReason->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$councillorship_grid->ListOptions->render("body", "right", $councillorship_grid->RowCount);
?>
	</tr>
<?php if ($councillorship->RowType == ROWTYPE_ADD || $councillorship->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcouncillorshipgrid", "load"], function() {
	fcouncillorshipgrid.updateLists(<?php echo $councillorship_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$councillorship_grid->isGridAdd() || $councillorship->CurrentMode == "copy")
		if (!$councillorship_grid->Recordset->EOF)
			$councillorship_grid->Recordset->moveNext();
}
?>
<?php
	if ($councillorship->CurrentMode == "add" || $councillorship->CurrentMode == "copy" || $councillorship->CurrentMode == "edit") {
		$councillorship_grid->RowIndex = '$rowindex$';
		$councillorship_grid->loadRowValues();

		// Set row properties
		$councillorship->resetAttributes();
		$councillorship->RowAttrs->merge(["data-rowindex" => $councillorship_grid->RowIndex, "id" => "r0_councillorship", "data-rowtype" => ROWTYPE_ADD]);
		$councillorship->RowAttrs->appendClass("ew-template");
		$councillorship->RowType = ROWTYPE_ADD;

		// Render row
		$councillorship_grid->renderRow();

		// Render list options
		$councillorship_grid->renderListOptions();
		$councillorship_grid->StartRowCount = 0;
?>
	<tr <?php echo $councillorship->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillorship_grid->ListOptions->render("body", "left", $councillorship_grid->RowIndex);
?>
	<?php if ($councillorship_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if (!$councillorship->isConfirm()) { ?>
<?php if ($councillorship_grid->EmployeeID->getSessionValue() != "") { ?>
<span id="el$rowindex$_councillorship_EmployeeID" class="form-group councillorship_EmployeeID">
<span<?php echo $councillorship_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" name="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_councillorship_EmployeeID" class="form-group councillorship_EmployeeID">
<?php
$onchange = $councillorship_grid->EmployeeID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillorship_grid->EmployeeID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID">
	<input type="text" class="form-control" name="sv_x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="sv_x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo RemoveHtml($councillorship_grid->EmployeeID->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($councillorship_grid->EmployeeID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillorship_grid->EmployeeID->getPlaceHolder()) ?>"<?php echo $councillorship_grid->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" data-value-separator="<?php echo $councillorship_grid->EmployeeID->displayValueSeparatorAttribute() ?>" name="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorshipgrid"], function() {
	fcouncillorshipgrid.createAutoSuggest({"id":"x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID","forceSelect":false});
});
</script>
<?php echo $councillorship_grid->EmployeeID->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_EmployeeID") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_councillorship_EmployeeID" class="form-group councillorship_EmployeeID">
<span<?php echo $councillorship_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" name="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="x<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" name="o<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" id="o<?php echo $councillorship_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_grid->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$councillorship->isConfirm()) { ?>
<?php if ($councillorship_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_councillorship_LACode" class="form-group councillorship_LACode">
<span<?php echo $councillorship_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $councillorship_grid->RowIndex ?>_LACode" name="x<?php echo $councillorship_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_councillorship_LACode" class="form-group councillorship_LACode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_LACode" data-value-separator="<?php echo $councillorship_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_LACode" name="x<?php echo $councillorship_grid->RowIndex ?>_LACode"<?php echo $councillorship_grid->LACode->editAttributes() ?>>
			<?php echo $councillorship_grid->LACode->selectOptionListHtml("x{$councillorship_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $councillorship_grid->LACode->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_councillorship_LACode" class="form-group councillorship_LACode">
<span<?php echo $councillorship_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillorship" data-field="x_LACode" name="x<?php echo $councillorship_grid->RowIndex ?>_LACode" id="x<?php echo $councillorship_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_LACode" name="o<?php echo $councillorship_grid->RowIndex ?>_LACode" id="o<?php echo $councillorship_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_grid->PoliticalParty->Visible) { // PoliticalParty ?>
		<td data-name="PoliticalParty">
<?php if (!$councillorship->isConfirm()) { ?>
<span id="el$rowindex$_councillorship_PoliticalParty" class="form-group councillorship_PoliticalParty">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PoliticalParty" data-value-separator="<?php echo $councillorship_grid->PoliticalParty->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" name="x<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty"<?php echo $councillorship_grid->PoliticalParty->editAttributes() ?>>
			<?php echo $councillorship_grid->PoliticalParty->selectOptionListHtml("x{$councillorship_grid->RowIndex}_PoliticalParty") ?>
		</select>
</div>
<?php echo $councillorship_grid->PoliticalParty->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_PoliticalParty") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_councillorship_PoliticalParty" class="form-group councillorship_PoliticalParty">
<span<?php echo $councillorship_grid->PoliticalParty->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->PoliticalParty->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillorship" data-field="x_PoliticalParty" name="x<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" id="x<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" value="<?php echo HtmlEncode($councillorship_grid->PoliticalParty->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_PoliticalParty" name="o<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" id="o<?php echo $councillorship_grid->RowIndex ?>_PoliticalParty" value="<?php echo HtmlEncode($councillorship_grid->PoliticalParty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_grid->Occupation->Visible) { // Occupation ?>
		<td data-name="Occupation">
<?php if (!$councillorship->isConfirm()) { ?>
<span id="el$rowindex$_councillorship_Occupation" class="form-group councillorship_Occupation">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Occupation" data-value-separator="<?php echo $councillorship_grid->Occupation->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_Occupation" name="x<?php echo $councillorship_grid->RowIndex ?>_Occupation"<?php echo $councillorship_grid->Occupation->editAttributes() ?>>
			<?php echo $councillorship_grid->Occupation->selectOptionListHtml("x{$councillorship_grid->RowIndex}_Occupation") ?>
		</select>
</div>
<?php echo $councillorship_grid->Occupation->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_Occupation") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_councillorship_Occupation" class="form-group councillorship_Occupation">
<span<?php echo $councillorship_grid->Occupation->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->Occupation->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillorship" data-field="x_Occupation" name="x<?php echo $councillorship_grid->RowIndex ?>_Occupation" id="x<?php echo $councillorship_grid->RowIndex ?>_Occupation" value="<?php echo HtmlEncode($councillorship_grid->Occupation->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_Occupation" name="o<?php echo $councillorship_grid->RowIndex ?>_Occupation" id="o<?php echo $councillorship_grid->RowIndex ?>_Occupation" value="<?php echo HtmlEncode($councillorship_grid->Occupation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_grid->PositionInCouncil->Visible) { // PositionInCouncil ?>
		<td data-name="PositionInCouncil">
<?php if (!$councillorship->isConfirm()) { ?>
<span id="el$rowindex$_councillorship_PositionInCouncil" class="form-group councillorship_PositionInCouncil">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PositionInCouncil" data-value-separator="<?php echo $councillorship_grid->PositionInCouncil->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" name="x<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil"<?php echo $councillorship_grid->PositionInCouncil->editAttributes() ?>>
			<?php echo $councillorship_grid->PositionInCouncil->selectOptionListHtml("x{$councillorship_grid->RowIndex}_PositionInCouncil") ?>
		</select>
</div>
<?php echo $councillorship_grid->PositionInCouncil->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_PositionInCouncil") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_councillorship_PositionInCouncil" class="form-group councillorship_PositionInCouncil">
<span<?php echo $councillorship_grid->PositionInCouncil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->PositionInCouncil->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillorship" data-field="x_PositionInCouncil" name="x<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" id="x<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_grid->PositionInCouncil->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_PositionInCouncil" name="o<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" id="o<?php echo $councillorship_grid->RowIndex ?>_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_grid->PositionInCouncil->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_grid->Committee->Visible) { // Committee ?>
		<td data-name="Committee">
<?php if (!$councillorship->isConfirm()) { ?>
<span id="el$rowindex$_councillorship_Committee" class="form-group councillorship_Committee">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Committee" data-value-separator="<?php echo $councillorship_grid->Committee->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_Committee" name="x<?php echo $councillorship_grid->RowIndex ?>_Committee"<?php echo $councillorship_grid->Committee->editAttributes() ?>>
			<?php echo $councillorship_grid->Committee->selectOptionListHtml("x{$councillorship_grid->RowIndex}_Committee") ?>
		</select>
</div>
<?php echo $councillorship_grid->Committee->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_Committee") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_councillorship_Committee" class="form-group councillorship_Committee">
<span<?php echo $councillorship_grid->Committee->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->Committee->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillorship" data-field="x_Committee" name="x<?php echo $councillorship_grid->RowIndex ?>_Committee" id="x<?php echo $councillorship_grid->RowIndex ?>_Committee" value="<?php echo HtmlEncode($councillorship_grid->Committee->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_Committee" name="o<?php echo $councillorship_grid->RowIndex ?>_Committee" id="o<?php echo $councillorship_grid->RowIndex ?>_Committee" value="<?php echo HtmlEncode($councillorship_grid->Committee->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_grid->CommitteeRole->Visible) { // CommitteeRole ?>
		<td data-name="CommitteeRole">
<?php if (!$councillorship->isConfirm()) { ?>
<span id="el$rowindex$_councillorship_CommitteeRole" class="form-group councillorship_CommitteeRole">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CommitteeRole" data-value-separator="<?php echo $councillorship_grid->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" name="x<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole"<?php echo $councillorship_grid->CommitteeRole->editAttributes() ?>>
			<?php echo $councillorship_grid->CommitteeRole->selectOptionListHtml("x{$councillorship_grid->RowIndex}_CommitteeRole") ?>
		</select>
</div>
<?php echo $councillorship_grid->CommitteeRole->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_CommitteeRole") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_councillorship_CommitteeRole" class="form-group councillorship_CommitteeRole">
<span<?php echo $councillorship_grid->CommitteeRole->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->CommitteeRole->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillorship" data-field="x_CommitteeRole" name="x<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" id="x<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($councillorship_grid->CommitteeRole->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_CommitteeRole" name="o<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" id="o<?php echo $councillorship_grid->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($councillorship_grid->CommitteeRole->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_grid->CouncilTerm->Visible) { // CouncilTerm ?>
		<td data-name="CouncilTerm">
<?php if (!$councillorship->isConfirm()) { ?>
<span id="el$rowindex$_councillorship_CouncilTerm" class="form-group councillorship_CouncilTerm">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncilTerm" data-value-separator="<?php echo $councillorship_grid->CouncilTerm->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" name="x<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm"<?php echo $councillorship_grid->CouncilTerm->editAttributes() ?>>
			<?php echo $councillorship_grid->CouncilTerm->selectOptionListHtml("x{$councillorship_grid->RowIndex}_CouncilTerm") ?>
		</select>
</div>
<?php echo $councillorship_grid->CouncilTerm->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_CouncilTerm") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_councillorship_CouncilTerm" class="form-group councillorship_CouncilTerm">
<span<?php echo $councillorship_grid->CouncilTerm->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->CouncilTerm->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillorship" data-field="x_CouncilTerm" name="x<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" id="x<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" value="<?php echo HtmlEncode($councillorship_grid->CouncilTerm->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_CouncilTerm" name="o<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" id="o<?php echo $councillorship_grid->RowIndex ?>_CouncilTerm" value="<?php echo HtmlEncode($councillorship_grid->CouncilTerm->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_grid->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
		<td data-name="CouncillorTypeType">
<?php if (!$councillorship->isConfirm()) { ?>
<span id="el$rowindex$_councillorship_CouncillorTypeType" class="form-group councillorship_CouncillorTypeType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncillorTypeType" data-value-separator="<?php echo $councillorship_grid->CouncillorTypeType->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" name="x<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType"<?php echo $councillorship_grid->CouncillorTypeType->editAttributes() ?>>
			<?php echo $councillorship_grid->CouncillorTypeType->selectOptionListHtml("x{$councillorship_grid->RowIndex}_CouncillorTypeType") ?>
		</select>
</div>
<?php echo $councillorship_grid->CouncillorTypeType->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_CouncillorTypeType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_councillorship_CouncillorTypeType" class="form-group councillorship_CouncillorTypeType">
<span<?php echo $councillorship_grid->CouncillorTypeType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->CouncillorTypeType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillorship" data-field="x_CouncillorTypeType" name="x<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" id="x<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" value="<?php echo HtmlEncode($councillorship_grid->CouncillorTypeType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_CouncillorTypeType" name="o<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" id="o<?php echo $councillorship_grid->RowIndex ?>_CouncillorTypeType" value="<?php echo HtmlEncode($councillorship_grid->CouncillorTypeType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_grid->ExitReason->Visible) { // ExitReason ?>
		<td data-name="ExitReason">
<?php if (!$councillorship->isConfirm()) { ?>
<span id="el$rowindex$_councillorship_ExitReason" class="form-group councillorship_ExitReason">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_ExitReason" data-value-separator="<?php echo $councillorship_grid->ExitReason->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_grid->RowIndex ?>_ExitReason" name="x<?php echo $councillorship_grid->RowIndex ?>_ExitReason"<?php echo $councillorship_grid->ExitReason->editAttributes() ?>>
			<?php echo $councillorship_grid->ExitReason->selectOptionListHtml("x{$councillorship_grid->RowIndex}_ExitReason") ?>
		</select>
</div>
<?php echo $councillorship_grid->ExitReason->Lookup->getParamTag($councillorship_grid, "p_x" . $councillorship_grid->RowIndex . "_ExitReason") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_councillorship_ExitReason" class="form-group councillorship_ExitReason">
<span<?php echo $councillorship_grid->ExitReason->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_grid->ExitReason->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillorship" data-field="x_ExitReason" name="x<?php echo $councillorship_grid->RowIndex ?>_ExitReason" id="x<?php echo $councillorship_grid->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($councillorship_grid->ExitReason->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_ExitReason" name="o<?php echo $councillorship_grid->RowIndex ?>_ExitReason" id="o<?php echo $councillorship_grid->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($councillorship_grid->ExitReason->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$councillorship_grid->ListOptions->render("body", "right", $councillorship_grid->RowIndex);
?>
<script>
loadjs.ready(["fcouncillorshipgrid", "load"], function() {
	fcouncillorshipgrid.updateLists(<?php echo $councillorship_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($councillorship->CurrentMode == "add" || $councillorship->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $councillorship_grid->FormKeyCountName ?>" id="<?php echo $councillorship_grid->FormKeyCountName ?>" value="<?php echo $councillorship_grid->KeyCount ?>">
<?php echo $councillorship_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($councillorship->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $councillorship_grid->FormKeyCountName ?>" id="<?php echo $councillorship_grid->FormKeyCountName ?>" value="<?php echo $councillorship_grid->KeyCount ?>">
<?php echo $councillorship_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($councillorship->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcouncillorshipgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($councillorship_grid->Recordset)
	$councillorship_grid->Recordset->Close();
?>
<?php if ($councillorship_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $councillorship_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($councillorship_grid->TotalRecords == 0 && !$councillorship->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $councillorship_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$councillorship_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$councillorship_grid->terminate();
?>