<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($property_grid))
	$property_grid = new property_grid();

// Run the page
$property_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_grid->Page_Render();
?>
<?php if (!$property_grid->isExport()) { ?>
<script>
var fpropertygrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fpropertygrid = new ew.Form("fpropertygrid", "grid");
	fpropertygrid.formKeyCountName = '<?php echo $property_grid->FormKeyCountName ?>';

	// Validate form
	fpropertygrid.validate = function() {
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
			<?php if ($property_grid->PropertyNo->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->PropertyNo->caption(), $property_grid->PropertyNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->ClientSerNo->caption(), $property_grid->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->ClientSerNo->errorMessage()) ?>");
			<?php if ($property_grid->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->ClientID->caption(), $property_grid->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->PropertyGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->PropertyGroup->caption(), $property_grid->PropertyGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->PropertyType->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->PropertyType->caption(), $property_grid->PropertyType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->PropertyType->errorMessage()) ?>");
			<?php if ($property_grid->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->Location->caption(), $property_grid->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->PropertyStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->PropertyStatus->caption(), $property_grid->PropertyStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PropertyStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->PropertyStatus->errorMessage()) ?>");
			<?php if ($property_grid->PropertyUse->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyUse[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->PropertyUse->caption(), $property_grid->PropertyUse->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->LandExtentInHA->Required) { ?>
				elm = this.getElements("x" + infix + "_LandExtentInHA");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->LandExtentInHA->caption(), $property_grid->LandExtentInHA->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LandExtentInHA");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->LandExtentInHA->errorMessage()) ?>");
			<?php if ($property_grid->RateableValue->Required) { ?>
				elm = this.getElements("x" + infix + "_RateableValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->RateableValue->caption(), $property_grid->RateableValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RateableValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->RateableValue->errorMessage()) ?>");
			<?php if ($property_grid->SupplementaryValue->Required) { ?>
				elm = this.getElements("x" + infix + "_SupplementaryValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->SupplementaryValue->caption(), $property_grid->SupplementaryValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SupplementaryValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->SupplementaryValue->errorMessage()) ?>");
			<?php if ($property_grid->ExemptCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->ExemptCode->caption(), $property_grid->ExemptCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->ExemptCode->errorMessage()) ?>");
			<?php if ($property_grid->Improvements->Required) { ?>
				elm = this.getElements("x" + infix + "_Improvements");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->Improvements->caption(), $property_grid->Improvements->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->StreetAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_StreetAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->StreetAddress->caption(), $property_grid->StreetAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->Longitude->caption(), $property_grid->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->Longitude->errorMessage()) ?>");
			<?php if ($property_grid->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->Latitude->caption(), $property_grid->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->Latitude->errorMessage()) ?>");
			<?php if ($property_grid->Incumberance->Required) { ?>
				elm = this.getElements("x" + infix + "_Incumberance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->Incumberance->caption(), $property_grid->Incumberance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->SubDivisionOf->Required) { ?>
				elm = this.getElements("x" + infix + "_SubDivisionOf");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->SubDivisionOf->caption(), $property_grid->SubDivisionOf->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_SubDivisionOf");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->SubDivisionOf->errorMessage()) ?>");
			<?php if ($property_grid->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->LastUpdatedBy->caption(), $property_grid->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->LastUpdateDate->caption(), $property_grid->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->LastUpdateDate->errorMessage()) ?>");
			<?php if ($property_grid->ValuationNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ValuationNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->ValuationNo->caption(), $property_grid->ValuationNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($property_grid->LandValue->Required) { ?>
				elm = this.getElements("x" + infix + "_LandValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->LandValue->caption(), $property_grid->LandValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LandValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->LandValue->errorMessage()) ?>");
			<?php if ($property_grid->ImprovementsValue->Required) { ?>
				elm = this.getElements("x" + infix + "_ImprovementsValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $property_grid->ImprovementsValue->caption(), $property_grid->ImprovementsValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ImprovementsValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($property_grid->ImprovementsValue->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fpropertygrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "PropertyNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClientSerNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ClientID", false)) return false;
		if (ew.valueChanged(fobj, infix, "PropertyGroup", false)) return false;
		if (ew.valueChanged(fobj, infix, "PropertyType", false)) return false;
		if (ew.valueChanged(fobj, infix, "Location[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "PropertyStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "PropertyUse[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "LandExtentInHA", false)) return false;
		if (ew.valueChanged(fobj, infix, "RateableValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "SupplementaryValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "ExemptCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "Improvements", false)) return false;
		if (ew.valueChanged(fobj, infix, "StreetAddress", false)) return false;
		if (ew.valueChanged(fobj, infix, "Longitude", false)) return false;
		if (ew.valueChanged(fobj, infix, "Latitude", false)) return false;
		if (ew.valueChanged(fobj, infix, "Incumberance", false)) return false;
		if (ew.valueChanged(fobj, infix, "SubDivisionOf", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastUpdatedBy", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastUpdateDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "LandValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "ImprovementsValue", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fpropertygrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpropertygrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpropertygrid.lists["x_ClientSerNo"] = <?php echo $property_grid->ClientSerNo->Lookup->toClientList($property_grid) ?>;
	fpropertygrid.lists["x_ClientSerNo"].options = <?php echo JsonEncode($property_grid->ClientSerNo->lookupOptions()) ?>;
	fpropertygrid.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertygrid.lists["x_ClientID"] = <?php echo $property_grid->ClientID->Lookup->toClientList($property_grid) ?>;
	fpropertygrid.lists["x_ClientID"].options = <?php echo JsonEncode($property_grid->ClientID->lookupOptions()) ?>;
	fpropertygrid.autoSuggests["x_ClientID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertygrid.lists["x_PropertyGroup"] = <?php echo $property_grid->PropertyGroup->Lookup->toClientList($property_grid) ?>;
	fpropertygrid.lists["x_PropertyGroup"].options = <?php echo JsonEncode($property_grid->PropertyGroup->lookupOptions()) ?>;
	fpropertygrid.lists["x_PropertyType"] = <?php echo $property_grid->PropertyType->Lookup->toClientList($property_grid) ?>;
	fpropertygrid.lists["x_PropertyType"].options = <?php echo JsonEncode($property_grid->PropertyType->lookupOptions()) ?>;
	fpropertygrid.autoSuggests["x_PropertyType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpropertygrid.lists["x_Location[]"] = <?php echo $property_grid->Location->Lookup->toClientList($property_grid) ?>;
	fpropertygrid.lists["x_Location[]"].options = <?php echo JsonEncode($property_grid->Location->lookupOptions()) ?>;
	fpropertygrid.lists["x_PropertyUse[]"] = <?php echo $property_grid->PropertyUse->Lookup->toClientList($property_grid) ?>;
	fpropertygrid.lists["x_PropertyUse[]"].options = <?php echo JsonEncode($property_grid->PropertyUse->lookupOptions()) ?>;
	loadjs.done("fpropertygrid");
});
</script>
<?php } ?>
<?php
$property_grid->renderOtherOptions();
?>
<?php if ($property_grid->TotalRecords > 0 || $property->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property">
<?php if ($property_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $property_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fpropertygrid" class="ew-form ew-list-form form-inline">
<div id="gmp_property" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_propertygrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property->RowType = ROWTYPE_HEADER;

// Render list options
$property_grid->renderListOptions();

// Render list options (header, left)
$property_grid->ListOptions->render("header", "left");
?>
<?php if ($property_grid->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($property_grid->SortUrl($property_grid->PropertyNo) == "") { ?>
		<th data-name="PropertyNo" class="<?php echo $property_grid->PropertyNo->headerCellClass() ?>"><div id="elh_property_PropertyNo" class="property_PropertyNo"><div class="ew-table-header-caption"><?php echo $property_grid->PropertyNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyNo" class="<?php echo $property_grid->PropertyNo->headerCellClass() ?>"><div><div id="elh_property_PropertyNo" class="property_PropertyNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->PropertyNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->PropertyNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->PropertyNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($property_grid->SortUrl($property_grid->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $property_grid->ClientSerNo->headerCellClass() ?>"><div id="elh_property_ClientSerNo" class="property_ClientSerNo"><div class="ew-table-header-caption"><?php echo $property_grid->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $property_grid->ClientSerNo->headerCellClass() ?>"><div><div id="elh_property_ClientSerNo" class="property_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->ClientID->Visible) { // ClientID ?>
	<?php if ($property_grid->SortUrl($property_grid->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $property_grid->ClientID->headerCellClass() ?>"><div id="elh_property_ClientID" class="property_ClientID"><div class="ew-table-header-caption"><?php echo $property_grid->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $property_grid->ClientID->headerCellClass() ?>"><div><div id="elh_property_ClientID" class="property_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->ClientID->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->PropertyGroup->Visible) { // PropertyGroup ?>
	<?php if ($property_grid->SortUrl($property_grid->PropertyGroup) == "") { ?>
		<th data-name="PropertyGroup" class="<?php echo $property_grid->PropertyGroup->headerCellClass() ?>"><div id="elh_property_PropertyGroup" class="property_PropertyGroup"><div class="ew-table-header-caption"><?php echo $property_grid->PropertyGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyGroup" class="<?php echo $property_grid->PropertyGroup->headerCellClass() ?>"><div><div id="elh_property_PropertyGroup" class="property_PropertyGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->PropertyGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->PropertyGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->PropertyGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->PropertyType->Visible) { // PropertyType ?>
	<?php if ($property_grid->SortUrl($property_grid->PropertyType) == "") { ?>
		<th data-name="PropertyType" class="<?php echo $property_grid->PropertyType->headerCellClass() ?>"><div id="elh_property_PropertyType" class="property_PropertyType"><div class="ew-table-header-caption"><?php echo $property_grid->PropertyType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyType" class="<?php echo $property_grid->PropertyType->headerCellClass() ?>"><div><div id="elh_property_PropertyType" class="property_PropertyType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->PropertyType->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->PropertyType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->PropertyType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->Location->Visible) { // Location ?>
	<?php if ($property_grid->SortUrl($property_grid->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $property_grid->Location->headerCellClass() ?>"><div id="elh_property_Location" class="property_Location"><div class="ew-table-header-caption"><?php echo $property_grid->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $property_grid->Location->headerCellClass() ?>"><div><div id="elh_property_Location" class="property_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->Location->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->PropertyStatus->Visible) { // PropertyStatus ?>
	<?php if ($property_grid->SortUrl($property_grid->PropertyStatus) == "") { ?>
		<th data-name="PropertyStatus" class="<?php echo $property_grid->PropertyStatus->headerCellClass() ?>"><div id="elh_property_PropertyStatus" class="property_PropertyStatus"><div class="ew-table-header-caption"><?php echo $property_grid->PropertyStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyStatus" class="<?php echo $property_grid->PropertyStatus->headerCellClass() ?>"><div><div id="elh_property_PropertyStatus" class="property_PropertyStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->PropertyStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->PropertyStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->PropertyStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_grid->SortUrl($property_grid->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $property_grid->PropertyUse->headerCellClass() ?>"><div id="elh_property_PropertyUse" class="property_PropertyUse"><div class="ew-table-header-caption"><?php echo $property_grid->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $property_grid->PropertyUse->headerCellClass() ?>"><div><div id="elh_property_PropertyUse" class="property_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->PropertyUse->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<?php if ($property_grid->SortUrl($property_grid->LandExtentInHA) == "") { ?>
		<th data-name="LandExtentInHA" class="<?php echo $property_grid->LandExtentInHA->headerCellClass() ?>"><div id="elh_property_LandExtentInHA" class="property_LandExtentInHA"><div class="ew-table-header-caption"><?php echo $property_grid->LandExtentInHA->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LandExtentInHA" class="<?php echo $property_grid->LandExtentInHA->headerCellClass() ?>"><div><div id="elh_property_LandExtentInHA" class="property_LandExtentInHA">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->LandExtentInHA->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->LandExtentInHA->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->LandExtentInHA->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->RateableValue->Visible) { // RateableValue ?>
	<?php if ($property_grid->SortUrl($property_grid->RateableValue) == "") { ?>
		<th data-name="RateableValue" class="<?php echo $property_grid->RateableValue->headerCellClass() ?>"><div id="elh_property_RateableValue" class="property_RateableValue"><div class="ew-table-header-caption"><?php echo $property_grid->RateableValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RateableValue" class="<?php echo $property_grid->RateableValue->headerCellClass() ?>"><div><div id="elh_property_RateableValue" class="property_RateableValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->RateableValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->RateableValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->RateableValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->SupplementaryValue->Visible) { // SupplementaryValue ?>
	<?php if ($property_grid->SortUrl($property_grid->SupplementaryValue) == "") { ?>
		<th data-name="SupplementaryValue" class="<?php echo $property_grid->SupplementaryValue->headerCellClass() ?>"><div id="elh_property_SupplementaryValue" class="property_SupplementaryValue"><div class="ew-table-header-caption"><?php echo $property_grid->SupplementaryValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SupplementaryValue" class="<?php echo $property_grid->SupplementaryValue->headerCellClass() ?>"><div><div id="elh_property_SupplementaryValue" class="property_SupplementaryValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->SupplementaryValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->SupplementaryValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->SupplementaryValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->ExemptCode->Visible) { // ExemptCode ?>
	<?php if ($property_grid->SortUrl($property_grid->ExemptCode) == "") { ?>
		<th data-name="ExemptCode" class="<?php echo $property_grid->ExemptCode->headerCellClass() ?>"><div id="elh_property_ExemptCode" class="property_ExemptCode"><div class="ew-table-header-caption"><?php echo $property_grid->ExemptCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExemptCode" class="<?php echo $property_grid->ExemptCode->headerCellClass() ?>"><div><div id="elh_property_ExemptCode" class="property_ExemptCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->ExemptCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->ExemptCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->ExemptCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->Improvements->Visible) { // Improvements ?>
	<?php if ($property_grid->SortUrl($property_grid->Improvements) == "") { ?>
		<th data-name="Improvements" class="<?php echo $property_grid->Improvements->headerCellClass() ?>"><div id="elh_property_Improvements" class="property_Improvements"><div class="ew-table-header-caption"><?php echo $property_grid->Improvements->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Improvements" class="<?php echo $property_grid->Improvements->headerCellClass() ?>"><div><div id="elh_property_Improvements" class="property_Improvements">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->Improvements->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->Improvements->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->Improvements->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->StreetAddress->Visible) { // StreetAddress ?>
	<?php if ($property_grid->SortUrl($property_grid->StreetAddress) == "") { ?>
		<th data-name="StreetAddress" class="<?php echo $property_grid->StreetAddress->headerCellClass() ?>"><div id="elh_property_StreetAddress" class="property_StreetAddress"><div class="ew-table-header-caption"><?php echo $property_grid->StreetAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StreetAddress" class="<?php echo $property_grid->StreetAddress->headerCellClass() ?>"><div><div id="elh_property_StreetAddress" class="property_StreetAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->StreetAddress->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->StreetAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->StreetAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->Longitude->Visible) { // Longitude ?>
	<?php if ($property_grid->SortUrl($property_grid->Longitude) == "") { ?>
		<th data-name="Longitude" class="<?php echo $property_grid->Longitude->headerCellClass() ?>"><div id="elh_property_Longitude" class="property_Longitude"><div class="ew-table-header-caption"><?php echo $property_grid->Longitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Longitude" class="<?php echo $property_grid->Longitude->headerCellClass() ?>"><div><div id="elh_property_Longitude" class="property_Longitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->Longitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->Longitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->Longitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->Latitude->Visible) { // Latitude ?>
	<?php if ($property_grid->SortUrl($property_grid->Latitude) == "") { ?>
		<th data-name="Latitude" class="<?php echo $property_grid->Latitude->headerCellClass() ?>"><div id="elh_property_Latitude" class="property_Latitude"><div class="ew-table-header-caption"><?php echo $property_grid->Latitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Latitude" class="<?php echo $property_grid->Latitude->headerCellClass() ?>"><div><div id="elh_property_Latitude" class="property_Latitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->Latitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->Latitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->Latitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->Incumberance->Visible) { // Incumberance ?>
	<?php if ($property_grid->SortUrl($property_grid->Incumberance) == "") { ?>
		<th data-name="Incumberance" class="<?php echo $property_grid->Incumberance->headerCellClass() ?>"><div id="elh_property_Incumberance" class="property_Incumberance"><div class="ew-table-header-caption"><?php echo $property_grid->Incumberance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Incumberance" class="<?php echo $property_grid->Incumberance->headerCellClass() ?>"><div><div id="elh_property_Incumberance" class="property_Incumberance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->Incumberance->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->Incumberance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->Incumberance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->SubDivisionOf->Visible) { // SubDivisionOf ?>
	<?php if ($property_grid->SortUrl($property_grid->SubDivisionOf) == "") { ?>
		<th data-name="SubDivisionOf" class="<?php echo $property_grid->SubDivisionOf->headerCellClass() ?>"><div id="elh_property_SubDivisionOf" class="property_SubDivisionOf"><div class="ew-table-header-caption"><?php echo $property_grid->SubDivisionOf->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubDivisionOf" class="<?php echo $property_grid->SubDivisionOf->headerCellClass() ?>"><div><div id="elh_property_SubDivisionOf" class="property_SubDivisionOf">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->SubDivisionOf->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->SubDivisionOf->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->SubDivisionOf->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($property_grid->SortUrl($property_grid->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $property_grid->LastUpdatedBy->headerCellClass() ?>"><div id="elh_property_LastUpdatedBy" class="property_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $property_grid->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $property_grid->LastUpdatedBy->headerCellClass() ?>"><div><div id="elh_property_LastUpdatedBy" class="property_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->LastUpdatedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($property_grid->SortUrl($property_grid->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $property_grid->LastUpdateDate->headerCellClass() ?>"><div id="elh_property_LastUpdateDate" class="property_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $property_grid->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $property_grid->LastUpdateDate->headerCellClass() ?>"><div><div id="elh_property_LastUpdateDate" class="property_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->ValuationNo->Visible) { // ValuationNo ?>
	<?php if ($property_grid->SortUrl($property_grid->ValuationNo) == "") { ?>
		<th data-name="ValuationNo" class="<?php echo $property_grid->ValuationNo->headerCellClass() ?>"><div id="elh_property_ValuationNo" class="property_ValuationNo"><div class="ew-table-header-caption"><?php echo $property_grid->ValuationNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValuationNo" class="<?php echo $property_grid->ValuationNo->headerCellClass() ?>"><div><div id="elh_property_ValuationNo" class="property_ValuationNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->ValuationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->ValuationNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->ValuationNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->LandValue->Visible) { // LandValue ?>
	<?php if ($property_grid->SortUrl($property_grid->LandValue) == "") { ?>
		<th data-name="LandValue" class="<?php echo $property_grid->LandValue->headerCellClass() ?>"><div id="elh_property_LandValue" class="property_LandValue"><div class="ew-table-header-caption"><?php echo $property_grid->LandValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LandValue" class="<?php echo $property_grid->LandValue->headerCellClass() ?>"><div><div id="elh_property_LandValue" class="property_LandValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->LandValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->LandValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->LandValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_grid->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<?php if ($property_grid->SortUrl($property_grid->ImprovementsValue) == "") { ?>
		<th data-name="ImprovementsValue" class="<?php echo $property_grid->ImprovementsValue->headerCellClass() ?>"><div id="elh_property_ImprovementsValue" class="property_ImprovementsValue"><div class="ew-table-header-caption"><?php echo $property_grid->ImprovementsValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ImprovementsValue" class="<?php echo $property_grid->ImprovementsValue->headerCellClass() ?>"><div><div id="elh_property_ImprovementsValue" class="property_ImprovementsValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_grid->ImprovementsValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_grid->ImprovementsValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_grid->ImprovementsValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$property_grid->StartRecord = 1;
$property_grid->StopRecord = $property_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($property->isConfirm() || $property_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($property_grid->FormKeyCountName) && ($property_grid->isGridAdd() || $property_grid->isGridEdit() || $property->isConfirm())) {
		$property_grid->KeyCount = $CurrentForm->getValue($property_grid->FormKeyCountName);
		$property_grid->StopRecord = $property_grid->StartRecord + $property_grid->KeyCount - 1;
	}
}
$property_grid->RecordCount = $property_grid->StartRecord - 1;
if ($property_grid->Recordset && !$property_grid->Recordset->EOF) {
	$property_grid->Recordset->moveFirst();
	$selectLimit = $property_grid->UseSelectLimit;
	if (!$selectLimit && $property_grid->StartRecord > 1)
		$property_grid->Recordset->move($property_grid->StartRecord - 1);
} elseif (!$property->AllowAddDeleteRow && $property_grid->StopRecord == 0) {
	$property_grid->StopRecord = $property->GridAddRowCount;
}

// Initialize aggregate
$property->RowType = ROWTYPE_AGGREGATEINIT;
$property->resetAttributes();
$property_grid->renderRow();
if ($property_grid->isGridAdd())
	$property_grid->RowIndex = 0;
if ($property_grid->isGridEdit())
	$property_grid->RowIndex = 0;
while ($property_grid->RecordCount < $property_grid->StopRecord) {
	$property_grid->RecordCount++;
	if ($property_grid->RecordCount >= $property_grid->StartRecord) {
		$property_grid->RowCount++;
		if ($property_grid->isGridAdd() || $property_grid->isGridEdit() || $property->isConfirm()) {
			$property_grid->RowIndex++;
			$CurrentForm->Index = $property_grid->RowIndex;
			if ($CurrentForm->hasValue($property_grid->FormActionName) && ($property->isConfirm() || $property_grid->EventCancelled))
				$property_grid->RowAction = strval($CurrentForm->getValue($property_grid->FormActionName));
			elseif ($property_grid->isGridAdd())
				$property_grid->RowAction = "insert";
			else
				$property_grid->RowAction = "";
		}

		// Set up key count
		$property_grid->KeyCount = $property_grid->RowIndex;

		// Init row class and style
		$property->resetAttributes();
		$property->CssClass = "";
		if ($property_grid->isGridAdd()) {
			if ($property->CurrentMode == "copy") {
				$property_grid->loadRowValues($property_grid->Recordset); // Load row values
				$property_grid->setRecordKey($property_grid->RowOldKey, $property_grid->Recordset); // Set old record key
			} else {
				$property_grid->loadRowValues(); // Load default values
				$property_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$property_grid->loadRowValues($property_grid->Recordset); // Load row values
		}
		$property->RowType = ROWTYPE_VIEW; // Render view
		if ($property_grid->isGridAdd()) // Grid add
			$property->RowType = ROWTYPE_ADD; // Render add
		if ($property_grid->isGridAdd() && $property->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$property_grid->restoreCurrentRowFormValues($property_grid->RowIndex); // Restore form values
		if ($property_grid->isGridEdit()) { // Grid edit
			if ($property->EventCancelled)
				$property_grid->restoreCurrentRowFormValues($property_grid->RowIndex); // Restore form values
			if ($property_grid->RowAction == "insert")
				$property->RowType = ROWTYPE_ADD; // Render add
			else
				$property->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($property_grid->isGridEdit() && ($property->RowType == ROWTYPE_EDIT || $property->RowType == ROWTYPE_ADD) && $property->EventCancelled) // Update failed
			$property_grid->restoreCurrentRowFormValues($property_grid->RowIndex); // Restore form values
		if ($property->RowType == ROWTYPE_EDIT) // Edit row
			$property_grid->EditRowCount++;
		if ($property->isConfirm()) // Confirm row
			$property_grid->restoreCurrentRowFormValues($property_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$property->RowAttrs->merge(["data-rowindex" => $property_grid->RowCount, "id" => "r" . $property_grid->RowCount . "_property", "data-rowtype" => $property->RowType]);

		// Render row
		$property_grid->renderRow();

		// Render list options
		$property_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($property_grid->RowAction != "delete" && $property_grid->RowAction != "insertdelete" && !($property_grid->RowAction == "insert" && $property->isConfirm() && $property_grid->emptyRow())) {
?>
	<tr <?php echo $property->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_grid->ListOptions->render("body", "left", $property_grid->RowCount);
?>
	<?php if ($property_grid->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo" <?php echo $property_grid->PropertyNo->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyNo" class="form-group">
<input type="text" data-table="property" data-field="x_PropertyNo" name="x<?php echo $property_grid->RowIndex ?>_PropertyNo" id="x<?php echo $property_grid->RowIndex ?>_PropertyNo" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_grid->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_grid->PropertyNo->EditValue ?>"<?php echo $property_grid->PropertyNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyNo" name="o<?php echo $property_grid->RowIndex ?>_PropertyNo" id="o<?php echo $property_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_grid->PropertyNo->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyNo" class="form-group">
<input type="text" data-table="property" data-field="x_PropertyNo" name="x<?php echo $property_grid->RowIndex ?>_PropertyNo" id="x<?php echo $property_grid->RowIndex ?>_PropertyNo" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_grid->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_grid->PropertyNo->EditValue ?>"<?php echo $property_grid->PropertyNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyNo">
<span<?php echo $property_grid->PropertyNo->viewAttributes() ?>><?php echo $property_grid->PropertyNo->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_PropertyNo" name="x<?php echo $property_grid->RowIndex ?>_PropertyNo" id="x<?php echo $property_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_grid->PropertyNo->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyNo" name="o<?php echo $property_grid->RowIndex ?>_PropertyNo" id="o<?php echo $property_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_grid->PropertyNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_PropertyNo" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyNo" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_grid->PropertyNo->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyNo" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyNo" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_grid->PropertyNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $property_grid->ClientSerNo->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($property_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientSerNo" class="form-group">
<span<?php echo $property_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientSerNo" class="form-group">
<?php
$onchange = $property_grid->ClientSerNo->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_grid->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_grid->RowIndex ?>_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="sv_x<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo RemoveHtml($property_grid->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_grid->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_grid->ClientSerNo->getPlaceHolder()) ?>"<?php echo $property_grid->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ClientSerNo',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ClientSerNo->ReadOnly || $property_grid->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertygrid"], function() {
	fpropertygrid.createAutoSuggest({"id":"x<?php echo $property_grid->RowIndex ?>_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $property_grid->ClientSerNo->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ClientSerNo") ?>
</span>
<?php } ?>
<input type="hidden" data-table="property" data-field="x_ClientSerNo" name="o<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($property_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientSerNo" class="form-group">
<span<?php echo $property_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientSerNo" class="form-group">
<?php
$onchange = $property_grid->ClientSerNo->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_grid->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_grid->RowIndex ?>_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="sv_x<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo RemoveHtml($property_grid->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_grid->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_grid->ClientSerNo->getPlaceHolder()) ?>"<?php echo $property_grid->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ClientSerNo',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ClientSerNo->ReadOnly || $property_grid->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertygrid"], function() {
	fpropertygrid.createAutoSuggest({"id":"x<?php echo $property_grid->RowIndex ?>_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $property_grid->ClientSerNo->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ClientSerNo") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientSerNo">
<span<?php echo $property_grid->ClientSerNo->viewAttributes() ?>><?php echo $property_grid->ClientSerNo->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_ClientSerNo" name="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ClientSerNo" name="o<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_ClientSerNo" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ClientSerNo" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $property_grid->ClientID->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientID" class="form-group">
<?php
$onchange = $property_grid->ClientID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_grid->ClientID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_grid->RowIndex ?>_ClientID">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_grid->RowIndex ?>_ClientID" id="sv_x<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo RemoveHtml($property_grid->ClientID->EditValue) ?>" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($property_grid->ClientID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_grid->ClientID->getPlaceHolder()) ?>"<?php echo $property_grid->ClientID->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ClientID->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ClientID',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ClientID->ReadOnly || $property_grid->ClientID->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ClientID->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ClientID" id="x<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($property_grid->ClientID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertygrid"], function() {
	fpropertygrid.createAutoSuggest({"id":"x<?php echo $property_grid->RowIndex ?>_ClientID","forceSelect":false});
});
</script>
<?php echo $property_grid->ClientID->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ClientID") ?>
</span>
<input type="hidden" data-table="property" data-field="x_ClientID" name="o<?php echo $property_grid->RowIndex ?>_ClientID" id="o<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($property_grid->ClientID->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientID" class="form-group">
<?php
$onchange = $property_grid->ClientID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_grid->ClientID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_grid->RowIndex ?>_ClientID">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_grid->RowIndex ?>_ClientID" id="sv_x<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo RemoveHtml($property_grid->ClientID->EditValue) ?>" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($property_grid->ClientID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_grid->ClientID->getPlaceHolder()) ?>"<?php echo $property_grid->ClientID->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ClientID->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ClientID',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ClientID->ReadOnly || $property_grid->ClientID->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ClientID->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ClientID" id="x<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($property_grid->ClientID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertygrid"], function() {
	fpropertygrid.createAutoSuggest({"id":"x<?php echo $property_grid->RowIndex ?>_ClientID","forceSelect":false});
});
</script>
<?php echo $property_grid->ClientID->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ClientID") ?>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ClientID">
<span<?php echo $property_grid->ClientID->viewAttributes() ?>><?php echo $property_grid->ClientID->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_ClientID" name="x<?php echo $property_grid->RowIndex ?>_ClientID" id="x<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($property_grid->ClientID->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ClientID" name="o<?php echo $property_grid->RowIndex ?>_ClientID" id="o<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($property_grid->ClientID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_ClientID" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ClientID" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($property_grid->ClientID->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ClientID" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ClientID" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($property_grid->ClientID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->PropertyGroup->Visible) { // PropertyGroup ?>
		<td data-name="PropertyGroup" <?php echo $property_grid->PropertyGroup->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyGroup" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="property" data-field="x_PropertyGroup" data-value-separator="<?php echo $property_grid->PropertyGroup->displayValueSeparatorAttribute() ?>" id="x<?php echo $property_grid->RowIndex ?>_PropertyGroup" name="x<?php echo $property_grid->RowIndex ?>_PropertyGroup"<?php echo $property_grid->PropertyGroup->editAttributes() ?>>
			<?php echo $property_grid->PropertyGroup->selectOptionListHtml("x{$property_grid->RowIndex}_PropertyGroup") ?>
		</select>
</div>
<?php echo $property_grid->PropertyGroup->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_PropertyGroup") ?>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyGroup" name="o<?php echo $property_grid->RowIndex ?>_PropertyGroup" id="o<?php echo $property_grid->RowIndex ?>_PropertyGroup" value="<?php echo HtmlEncode($property_grid->PropertyGroup->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyGroup" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="property" data-field="x_PropertyGroup" data-value-separator="<?php echo $property_grid->PropertyGroup->displayValueSeparatorAttribute() ?>" id="x<?php echo $property_grid->RowIndex ?>_PropertyGroup" name="x<?php echo $property_grid->RowIndex ?>_PropertyGroup"<?php echo $property_grid->PropertyGroup->editAttributes() ?>>
			<?php echo $property_grid->PropertyGroup->selectOptionListHtml("x{$property_grid->RowIndex}_PropertyGroup") ?>
		</select>
</div>
<?php echo $property_grid->PropertyGroup->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_PropertyGroup") ?>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyGroup">
<span<?php echo $property_grid->PropertyGroup->viewAttributes() ?>><?php echo $property_grid->PropertyGroup->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_PropertyGroup" name="x<?php echo $property_grid->RowIndex ?>_PropertyGroup" id="x<?php echo $property_grid->RowIndex ?>_PropertyGroup" value="<?php echo HtmlEncode($property_grid->PropertyGroup->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyGroup" name="o<?php echo $property_grid->RowIndex ?>_PropertyGroup" id="o<?php echo $property_grid->RowIndex ?>_PropertyGroup" value="<?php echo HtmlEncode($property_grid->PropertyGroup->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_PropertyGroup" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyGroup" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyGroup" value="<?php echo HtmlEncode($property_grid->PropertyGroup->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyGroup" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyGroup" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyGroup" value="<?php echo HtmlEncode($property_grid->PropertyGroup->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->PropertyType->Visible) { // PropertyType ?>
		<td data-name="PropertyType" <?php echo $property_grid->PropertyType->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyType" class="form-group">
<?php
$onchange = $property_grid->PropertyType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_grid->PropertyType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_grid->RowIndex ?>_PropertyType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_grid->RowIndex ?>_PropertyType" id="sv_x<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo RemoveHtml($property_grid->PropertyType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_grid->PropertyType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_grid->PropertyType->getPlaceHolder()) ?>"<?php echo $property_grid->PropertyType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->PropertyType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_PropertyType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->PropertyType->ReadOnly || $property_grid->PropertyType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->PropertyType->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_PropertyType" id="x<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo HtmlEncode($property_grid->PropertyType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertygrid"], function() {
	fpropertygrid.createAutoSuggest({"id":"x<?php echo $property_grid->RowIndex ?>_PropertyType","forceSelect":false});
});
</script>
<?php echo $property_grid->PropertyType->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_PropertyType") ?>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyType" name="o<?php echo $property_grid->RowIndex ?>_PropertyType" id="o<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo HtmlEncode($property_grid->PropertyType->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyType" class="form-group">
<?php
$onchange = $property_grid->PropertyType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_grid->PropertyType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_grid->RowIndex ?>_PropertyType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_grid->RowIndex ?>_PropertyType" id="sv_x<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo RemoveHtml($property_grid->PropertyType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_grid->PropertyType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_grid->PropertyType->getPlaceHolder()) ?>"<?php echo $property_grid->PropertyType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->PropertyType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_PropertyType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->PropertyType->ReadOnly || $property_grid->PropertyType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->PropertyType->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_PropertyType" id="x<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo HtmlEncode($property_grid->PropertyType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertygrid"], function() {
	fpropertygrid.createAutoSuggest({"id":"x<?php echo $property_grid->RowIndex ?>_PropertyType","forceSelect":false});
});
</script>
<?php echo $property_grid->PropertyType->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_PropertyType") ?>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyType">
<span<?php echo $property_grid->PropertyType->viewAttributes() ?>><?php echo $property_grid->PropertyType->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_PropertyType" name="x<?php echo $property_grid->RowIndex ?>_PropertyType" id="x<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo HtmlEncode($property_grid->PropertyType->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyType" name="o<?php echo $property_grid->RowIndex ?>_PropertyType" id="o<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo HtmlEncode($property_grid->PropertyType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_PropertyType" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyType" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo HtmlEncode($property_grid->PropertyType->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyType" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyType" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo HtmlEncode($property_grid->PropertyType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $property_grid->Location->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Location" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_grid->RowIndex ?>_Location"><?php echo EmptyValue(strval($property_grid->Location->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_grid->Location->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->Location->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->Location->ReadOnly || $property_grid->Location->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_Location[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_grid->Location->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_Location") ?>
<input type="hidden" data-table="property" data-field="x_Location" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_grid->Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_Location[]" id="x<?php echo $property_grid->RowIndex ?>_Location[]" value="<?php echo $property_grid->Location->CurrentValue ?>"<?php echo $property_grid->Location->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_Location" name="o<?php echo $property_grid->RowIndex ?>_Location[]" id="o<?php echo $property_grid->RowIndex ?>_Location[]" value="<?php echo HtmlEncode($property_grid->Location->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Location" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_grid->RowIndex ?>_Location"><?php echo EmptyValue(strval($property_grid->Location->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_grid->Location->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->Location->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->Location->ReadOnly || $property_grid->Location->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_Location[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_grid->Location->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_Location") ?>
<input type="hidden" data-table="property" data-field="x_Location" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_grid->Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_Location[]" id="x<?php echo $property_grid->RowIndex ?>_Location[]" value="<?php echo $property_grid->Location->CurrentValue ?>"<?php echo $property_grid->Location->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Location">
<span<?php echo $property_grid->Location->viewAttributes() ?>><?php echo $property_grid->Location->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_Location" name="x<?php echo $property_grid->RowIndex ?>_Location" id="x<?php echo $property_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_grid->Location->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Location" name="o<?php echo $property_grid->RowIndex ?>_Location[]" id="o<?php echo $property_grid->RowIndex ?>_Location[]" value="<?php echo HtmlEncode($property_grid->Location->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_Location" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Location" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_grid->Location->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Location" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Location[]" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Location[]" value="<?php echo HtmlEncode($property_grid->Location->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->PropertyStatus->Visible) { // PropertyStatus ?>
		<td data-name="PropertyStatus" <?php echo $property_grid->PropertyStatus->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyStatus" class="form-group">
<input type="text" data-table="property" data-field="x_PropertyStatus" name="x<?php echo $property_grid->RowIndex ?>_PropertyStatus" id="x<?php echo $property_grid->RowIndex ?>_PropertyStatus" size="30" placeholder="<?php echo HtmlEncode($property_grid->PropertyStatus->getPlaceHolder()) ?>" value="<?php echo $property_grid->PropertyStatus->EditValue ?>"<?php echo $property_grid->PropertyStatus->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyStatus" name="o<?php echo $property_grid->RowIndex ?>_PropertyStatus" id="o<?php echo $property_grid->RowIndex ?>_PropertyStatus" value="<?php echo HtmlEncode($property_grid->PropertyStatus->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyStatus" class="form-group">
<input type="text" data-table="property" data-field="x_PropertyStatus" name="x<?php echo $property_grid->RowIndex ?>_PropertyStatus" id="x<?php echo $property_grid->RowIndex ?>_PropertyStatus" size="30" placeholder="<?php echo HtmlEncode($property_grid->PropertyStatus->getPlaceHolder()) ?>" value="<?php echo $property_grid->PropertyStatus->EditValue ?>"<?php echo $property_grid->PropertyStatus->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyStatus">
<span<?php echo $property_grid->PropertyStatus->viewAttributes() ?>><?php echo $property_grid->PropertyStatus->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_PropertyStatus" name="x<?php echo $property_grid->RowIndex ?>_PropertyStatus" id="x<?php echo $property_grid->RowIndex ?>_PropertyStatus" value="<?php echo HtmlEncode($property_grid->PropertyStatus->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyStatus" name="o<?php echo $property_grid->RowIndex ?>_PropertyStatus" id="o<?php echo $property_grid->RowIndex ?>_PropertyStatus" value="<?php echo HtmlEncode($property_grid->PropertyStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_PropertyStatus" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyStatus" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyStatus" value="<?php echo HtmlEncode($property_grid->PropertyStatus->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyStatus" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyStatus" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyStatus" value="<?php echo HtmlEncode($property_grid->PropertyStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $property_grid->PropertyUse->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyUse" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_grid->RowIndex ?>_PropertyUse"><?php echo EmptyValue(strval($property_grid->PropertyUse->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_grid->PropertyUse->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->PropertyUse->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->PropertyUse->ReadOnly || $property_grid->PropertyUse->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_PropertyUse[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_grid->PropertyUse->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_PropertyUse") ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_grid->PropertyUse->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_PropertyUse[]" id="x<?php echo $property_grid->RowIndex ?>_PropertyUse[]" value="<?php echo $property_grid->PropertyUse->CurrentValue ?>"<?php echo $property_grid->PropertyUse->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="o<?php echo $property_grid->RowIndex ?>_PropertyUse[]" id="o<?php echo $property_grid->RowIndex ?>_PropertyUse[]" value="<?php echo HtmlEncode($property_grid->PropertyUse->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyUse" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_grid->RowIndex ?>_PropertyUse"><?php echo EmptyValue(strval($property_grid->PropertyUse->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_grid->PropertyUse->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->PropertyUse->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->PropertyUse->ReadOnly || $property_grid->PropertyUse->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_PropertyUse[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_grid->PropertyUse->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_PropertyUse") ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_grid->PropertyUse->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_PropertyUse[]" id="x<?php echo $property_grid->RowIndex ?>_PropertyUse[]" value="<?php echo $property_grid->PropertyUse->CurrentValue ?>"<?php echo $property_grid->PropertyUse->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_PropertyUse">
<span<?php echo $property_grid->PropertyUse->viewAttributes() ?>><?php echo $property_grid->PropertyUse->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="x<?php echo $property_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_grid->PropertyUse->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="o<?php echo $property_grid->RowIndex ?>_PropertyUse[]" id="o<?php echo $property_grid->RowIndex ?>_PropertyUse[]" value="<?php echo HtmlEncode($property_grid->PropertyUse->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyUse" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_grid->PropertyUse->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyUse[]" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_PropertyUse[]" value="<?php echo HtmlEncode($property_grid->PropertyUse->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->LandExtentInHA->Visible) { // LandExtentInHA ?>
		<td data-name="LandExtentInHA" <?php echo $property_grid->LandExtentInHA->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_LandExtentInHA" class="form-group">
<input type="text" data-table="property" data-field="x_LandExtentInHA" name="x<?php echo $property_grid->RowIndex ?>_LandExtentInHA" id="x<?php echo $property_grid->RowIndex ?>_LandExtentInHA" size="30" placeholder="<?php echo HtmlEncode($property_grid->LandExtentInHA->getPlaceHolder()) ?>" value="<?php echo $property_grid->LandExtentInHA->EditValue ?>"<?php echo $property_grid->LandExtentInHA->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_LandExtentInHA" name="o<?php echo $property_grid->RowIndex ?>_LandExtentInHA" id="o<?php echo $property_grid->RowIndex ?>_LandExtentInHA" value="<?php echo HtmlEncode($property_grid->LandExtentInHA->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_LandExtentInHA" class="form-group">
<input type="text" data-table="property" data-field="x_LandExtentInHA" name="x<?php echo $property_grid->RowIndex ?>_LandExtentInHA" id="x<?php echo $property_grid->RowIndex ?>_LandExtentInHA" size="30" placeholder="<?php echo HtmlEncode($property_grid->LandExtentInHA->getPlaceHolder()) ?>" value="<?php echo $property_grid->LandExtentInHA->EditValue ?>"<?php echo $property_grid->LandExtentInHA->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_LandExtentInHA">
<span<?php echo $property_grid->LandExtentInHA->viewAttributes() ?>><?php echo $property_grid->LandExtentInHA->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_LandExtentInHA" name="x<?php echo $property_grid->RowIndex ?>_LandExtentInHA" id="x<?php echo $property_grid->RowIndex ?>_LandExtentInHA" value="<?php echo HtmlEncode($property_grid->LandExtentInHA->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_LandExtentInHA" name="o<?php echo $property_grid->RowIndex ?>_LandExtentInHA" id="o<?php echo $property_grid->RowIndex ?>_LandExtentInHA" value="<?php echo HtmlEncode($property_grid->LandExtentInHA->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_LandExtentInHA" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_LandExtentInHA" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_LandExtentInHA" value="<?php echo HtmlEncode($property_grid->LandExtentInHA->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_LandExtentInHA" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_LandExtentInHA" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_LandExtentInHA" value="<?php echo HtmlEncode($property_grid->LandExtentInHA->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->RateableValue->Visible) { // RateableValue ?>
		<td data-name="RateableValue" <?php echo $property_grid->RateableValue->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_RateableValue" class="form-group">
<input type="text" data-table="property" data-field="x_RateableValue" name="x<?php echo $property_grid->RowIndex ?>_RateableValue" id="x<?php echo $property_grid->RowIndex ?>_RateableValue" size="30" placeholder="<?php echo HtmlEncode($property_grid->RateableValue->getPlaceHolder()) ?>" value="<?php echo $property_grid->RateableValue->EditValue ?>"<?php echo $property_grid->RateableValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_RateableValue" name="o<?php echo $property_grid->RowIndex ?>_RateableValue" id="o<?php echo $property_grid->RowIndex ?>_RateableValue" value="<?php echo HtmlEncode($property_grid->RateableValue->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_RateableValue" class="form-group">
<input type="text" data-table="property" data-field="x_RateableValue" name="x<?php echo $property_grid->RowIndex ?>_RateableValue" id="x<?php echo $property_grid->RowIndex ?>_RateableValue" size="30" placeholder="<?php echo HtmlEncode($property_grid->RateableValue->getPlaceHolder()) ?>" value="<?php echo $property_grid->RateableValue->EditValue ?>"<?php echo $property_grid->RateableValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_RateableValue">
<span<?php echo $property_grid->RateableValue->viewAttributes() ?>><?php echo $property_grid->RateableValue->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_RateableValue" name="x<?php echo $property_grid->RowIndex ?>_RateableValue" id="x<?php echo $property_grid->RowIndex ?>_RateableValue" value="<?php echo HtmlEncode($property_grid->RateableValue->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_RateableValue" name="o<?php echo $property_grid->RowIndex ?>_RateableValue" id="o<?php echo $property_grid->RowIndex ?>_RateableValue" value="<?php echo HtmlEncode($property_grid->RateableValue->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_RateableValue" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_RateableValue" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_RateableValue" value="<?php echo HtmlEncode($property_grid->RateableValue->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_RateableValue" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_RateableValue" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_RateableValue" value="<?php echo HtmlEncode($property_grid->RateableValue->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->SupplementaryValue->Visible) { // SupplementaryValue ?>
		<td data-name="SupplementaryValue" <?php echo $property_grid->SupplementaryValue->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_SupplementaryValue" class="form-group">
<input type="text" data-table="property" data-field="x_SupplementaryValue" name="x<?php echo $property_grid->RowIndex ?>_SupplementaryValue" id="x<?php echo $property_grid->RowIndex ?>_SupplementaryValue" size="30" placeholder="<?php echo HtmlEncode($property_grid->SupplementaryValue->getPlaceHolder()) ?>" value="<?php echo $property_grid->SupplementaryValue->EditValue ?>"<?php echo $property_grid->SupplementaryValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_SupplementaryValue" name="o<?php echo $property_grid->RowIndex ?>_SupplementaryValue" id="o<?php echo $property_grid->RowIndex ?>_SupplementaryValue" value="<?php echo HtmlEncode($property_grid->SupplementaryValue->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_SupplementaryValue" class="form-group">
<input type="text" data-table="property" data-field="x_SupplementaryValue" name="x<?php echo $property_grid->RowIndex ?>_SupplementaryValue" id="x<?php echo $property_grid->RowIndex ?>_SupplementaryValue" size="30" placeholder="<?php echo HtmlEncode($property_grid->SupplementaryValue->getPlaceHolder()) ?>" value="<?php echo $property_grid->SupplementaryValue->EditValue ?>"<?php echo $property_grid->SupplementaryValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_SupplementaryValue">
<span<?php echo $property_grid->SupplementaryValue->viewAttributes() ?>><?php echo $property_grid->SupplementaryValue->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_SupplementaryValue" name="x<?php echo $property_grid->RowIndex ?>_SupplementaryValue" id="x<?php echo $property_grid->RowIndex ?>_SupplementaryValue" value="<?php echo HtmlEncode($property_grid->SupplementaryValue->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_SupplementaryValue" name="o<?php echo $property_grid->RowIndex ?>_SupplementaryValue" id="o<?php echo $property_grid->RowIndex ?>_SupplementaryValue" value="<?php echo HtmlEncode($property_grid->SupplementaryValue->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_SupplementaryValue" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_SupplementaryValue" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_SupplementaryValue" value="<?php echo HtmlEncode($property_grid->SupplementaryValue->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_SupplementaryValue" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_SupplementaryValue" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_SupplementaryValue" value="<?php echo HtmlEncode($property_grid->SupplementaryValue->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->ExemptCode->Visible) { // ExemptCode ?>
		<td data-name="ExemptCode" <?php echo $property_grid->ExemptCode->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ExemptCode" class="form-group">
<input type="text" data-table="property" data-field="x_ExemptCode" name="x<?php echo $property_grid->RowIndex ?>_ExemptCode" id="x<?php echo $property_grid->RowIndex ?>_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($property_grid->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $property_grid->ExemptCode->EditValue ?>"<?php echo $property_grid->ExemptCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_ExemptCode" name="o<?php echo $property_grid->RowIndex ?>_ExemptCode" id="o<?php echo $property_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($property_grid->ExemptCode->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ExemptCode" class="form-group">
<input type="text" data-table="property" data-field="x_ExemptCode" name="x<?php echo $property_grid->RowIndex ?>_ExemptCode" id="x<?php echo $property_grid->RowIndex ?>_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($property_grid->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $property_grid->ExemptCode->EditValue ?>"<?php echo $property_grid->ExemptCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ExemptCode">
<span<?php echo $property_grid->ExemptCode->viewAttributes() ?>><?php echo $property_grid->ExemptCode->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_ExemptCode" name="x<?php echo $property_grid->RowIndex ?>_ExemptCode" id="x<?php echo $property_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($property_grid->ExemptCode->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ExemptCode" name="o<?php echo $property_grid->RowIndex ?>_ExemptCode" id="o<?php echo $property_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($property_grid->ExemptCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_ExemptCode" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ExemptCode" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($property_grid->ExemptCode->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ExemptCode" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ExemptCode" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($property_grid->ExemptCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->Improvements->Visible) { // Improvements ?>
		<td data-name="Improvements" <?php echo $property_grid->Improvements->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Improvements" class="form-group">
<textarea data-table="property" data-field="x_Improvements" name="x<?php echo $property_grid->RowIndex ?>_Improvements" id="x<?php echo $property_grid->RowIndex ?>_Improvements" cols="50" rows="2" placeholder="<?php echo HtmlEncode($property_grid->Improvements->getPlaceHolder()) ?>"<?php echo $property_grid->Improvements->editAttributes() ?>><?php echo $property_grid->Improvements->EditValue ?></textarea>
</span>
<input type="hidden" data-table="property" data-field="x_Improvements" name="o<?php echo $property_grid->RowIndex ?>_Improvements" id="o<?php echo $property_grid->RowIndex ?>_Improvements" value="<?php echo HtmlEncode($property_grid->Improvements->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Improvements" class="form-group">
<textarea data-table="property" data-field="x_Improvements" name="x<?php echo $property_grid->RowIndex ?>_Improvements" id="x<?php echo $property_grid->RowIndex ?>_Improvements" cols="50" rows="2" placeholder="<?php echo HtmlEncode($property_grid->Improvements->getPlaceHolder()) ?>"<?php echo $property_grid->Improvements->editAttributes() ?>><?php echo $property_grid->Improvements->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Improvements">
<span<?php echo $property_grid->Improvements->viewAttributes() ?>><?php echo $property_grid->Improvements->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_Improvements" name="x<?php echo $property_grid->RowIndex ?>_Improvements" id="x<?php echo $property_grid->RowIndex ?>_Improvements" value="<?php echo HtmlEncode($property_grid->Improvements->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Improvements" name="o<?php echo $property_grid->RowIndex ?>_Improvements" id="o<?php echo $property_grid->RowIndex ?>_Improvements" value="<?php echo HtmlEncode($property_grid->Improvements->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_Improvements" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Improvements" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Improvements" value="<?php echo HtmlEncode($property_grid->Improvements->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Improvements" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Improvements" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Improvements" value="<?php echo HtmlEncode($property_grid->Improvements->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->StreetAddress->Visible) { // StreetAddress ?>
		<td data-name="StreetAddress" <?php echo $property_grid->StreetAddress->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_StreetAddress" class="form-group">
<textarea data-table="property" data-field="x_StreetAddress" name="x<?php echo $property_grid->RowIndex ?>_StreetAddress" id="x<?php echo $property_grid->RowIndex ?>_StreetAddress" cols="50" rows="2" placeholder="<?php echo HtmlEncode($property_grid->StreetAddress->getPlaceHolder()) ?>"<?php echo $property_grid->StreetAddress->editAttributes() ?>><?php echo $property_grid->StreetAddress->EditValue ?></textarea>
</span>
<input type="hidden" data-table="property" data-field="x_StreetAddress" name="o<?php echo $property_grid->RowIndex ?>_StreetAddress" id="o<?php echo $property_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($property_grid->StreetAddress->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_StreetAddress" class="form-group">
<textarea data-table="property" data-field="x_StreetAddress" name="x<?php echo $property_grid->RowIndex ?>_StreetAddress" id="x<?php echo $property_grid->RowIndex ?>_StreetAddress" cols="50" rows="2" placeholder="<?php echo HtmlEncode($property_grid->StreetAddress->getPlaceHolder()) ?>"<?php echo $property_grid->StreetAddress->editAttributes() ?>><?php echo $property_grid->StreetAddress->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_StreetAddress">
<span<?php echo $property_grid->StreetAddress->viewAttributes() ?>><?php echo $property_grid->StreetAddress->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_StreetAddress" name="x<?php echo $property_grid->RowIndex ?>_StreetAddress" id="x<?php echo $property_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($property_grid->StreetAddress->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_StreetAddress" name="o<?php echo $property_grid->RowIndex ?>_StreetAddress" id="o<?php echo $property_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($property_grid->StreetAddress->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_StreetAddress" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_StreetAddress" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($property_grid->StreetAddress->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_StreetAddress" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_StreetAddress" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($property_grid->StreetAddress->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude" <?php echo $property_grid->Longitude->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Longitude" class="form-group">
<input type="text" data-table="property" data-field="x_Longitude" name="x<?php echo $property_grid->RowIndex ?>_Longitude" id="x<?php echo $property_grid->RowIndex ?>_Longitude" size="30" placeholder="<?php echo HtmlEncode($property_grid->Longitude->getPlaceHolder()) ?>" value="<?php echo $property_grid->Longitude->EditValue ?>"<?php echo $property_grid->Longitude->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_Longitude" name="o<?php echo $property_grid->RowIndex ?>_Longitude" id="o<?php echo $property_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($property_grid->Longitude->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Longitude" class="form-group">
<input type="text" data-table="property" data-field="x_Longitude" name="x<?php echo $property_grid->RowIndex ?>_Longitude" id="x<?php echo $property_grid->RowIndex ?>_Longitude" size="30" placeholder="<?php echo HtmlEncode($property_grid->Longitude->getPlaceHolder()) ?>" value="<?php echo $property_grid->Longitude->EditValue ?>"<?php echo $property_grid->Longitude->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Longitude">
<span<?php echo $property_grid->Longitude->viewAttributes() ?>><?php echo $property_grid->Longitude->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_Longitude" name="x<?php echo $property_grid->RowIndex ?>_Longitude" id="x<?php echo $property_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($property_grid->Longitude->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Longitude" name="o<?php echo $property_grid->RowIndex ?>_Longitude" id="o<?php echo $property_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($property_grid->Longitude->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_Longitude" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Longitude" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($property_grid->Longitude->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Longitude" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Longitude" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($property_grid->Longitude->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude" <?php echo $property_grid->Latitude->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Latitude" class="form-group">
<input type="text" data-table="property" data-field="x_Latitude" name="x<?php echo $property_grid->RowIndex ?>_Latitude" id="x<?php echo $property_grid->RowIndex ?>_Latitude" size="30" placeholder="<?php echo HtmlEncode($property_grid->Latitude->getPlaceHolder()) ?>" value="<?php echo $property_grid->Latitude->EditValue ?>"<?php echo $property_grid->Latitude->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_Latitude" name="o<?php echo $property_grid->RowIndex ?>_Latitude" id="o<?php echo $property_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($property_grid->Latitude->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Latitude" class="form-group">
<input type="text" data-table="property" data-field="x_Latitude" name="x<?php echo $property_grid->RowIndex ?>_Latitude" id="x<?php echo $property_grid->RowIndex ?>_Latitude" size="30" placeholder="<?php echo HtmlEncode($property_grid->Latitude->getPlaceHolder()) ?>" value="<?php echo $property_grid->Latitude->EditValue ?>"<?php echo $property_grid->Latitude->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Latitude">
<span<?php echo $property_grid->Latitude->viewAttributes() ?>><?php echo $property_grid->Latitude->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_Latitude" name="x<?php echo $property_grid->RowIndex ?>_Latitude" id="x<?php echo $property_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($property_grid->Latitude->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Latitude" name="o<?php echo $property_grid->RowIndex ?>_Latitude" id="o<?php echo $property_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($property_grid->Latitude->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_Latitude" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Latitude" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($property_grid->Latitude->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Latitude" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Latitude" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($property_grid->Latitude->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->Incumberance->Visible) { // Incumberance ?>
		<td data-name="Incumberance" <?php echo $property_grid->Incumberance->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Incumberance" class="form-group">
<input type="text" data-table="property" data-field="x_Incumberance" name="x<?php echo $property_grid->RowIndex ?>_Incumberance" id="x<?php echo $property_grid->RowIndex ?>_Incumberance" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($property_grid->Incumberance->getPlaceHolder()) ?>" value="<?php echo $property_grid->Incumberance->EditValue ?>"<?php echo $property_grid->Incumberance->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_Incumberance" name="o<?php echo $property_grid->RowIndex ?>_Incumberance" id="o<?php echo $property_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($property_grid->Incumberance->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Incumberance" class="form-group">
<input type="text" data-table="property" data-field="x_Incumberance" name="x<?php echo $property_grid->RowIndex ?>_Incumberance" id="x<?php echo $property_grid->RowIndex ?>_Incumberance" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($property_grid->Incumberance->getPlaceHolder()) ?>" value="<?php echo $property_grid->Incumberance->EditValue ?>"<?php echo $property_grid->Incumberance->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_Incumberance">
<span<?php echo $property_grid->Incumberance->viewAttributes() ?>><?php echo $property_grid->Incumberance->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_Incumberance" name="x<?php echo $property_grid->RowIndex ?>_Incumberance" id="x<?php echo $property_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($property_grid->Incumberance->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Incumberance" name="o<?php echo $property_grid->RowIndex ?>_Incumberance" id="o<?php echo $property_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($property_grid->Incumberance->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_Incumberance" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Incumberance" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($property_grid->Incumberance->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_Incumberance" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Incumberance" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($property_grid->Incumberance->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->SubDivisionOf->Visible) { // SubDivisionOf ?>
		<td data-name="SubDivisionOf" <?php echo $property_grid->SubDivisionOf->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_SubDivisionOf" class="form-group">
<input type="text" data-table="property" data-field="x_SubDivisionOf" name="x<?php echo $property_grid->RowIndex ?>_SubDivisionOf" id="x<?php echo $property_grid->RowIndex ?>_SubDivisionOf" size="30" placeholder="<?php echo HtmlEncode($property_grid->SubDivisionOf->getPlaceHolder()) ?>" value="<?php echo $property_grid->SubDivisionOf->EditValue ?>"<?php echo $property_grid->SubDivisionOf->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_SubDivisionOf" name="o<?php echo $property_grid->RowIndex ?>_SubDivisionOf" id="o<?php echo $property_grid->RowIndex ?>_SubDivisionOf" value="<?php echo HtmlEncode($property_grid->SubDivisionOf->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_SubDivisionOf" class="form-group">
<input type="text" data-table="property" data-field="x_SubDivisionOf" name="x<?php echo $property_grid->RowIndex ?>_SubDivisionOf" id="x<?php echo $property_grid->RowIndex ?>_SubDivisionOf" size="30" placeholder="<?php echo HtmlEncode($property_grid->SubDivisionOf->getPlaceHolder()) ?>" value="<?php echo $property_grid->SubDivisionOf->EditValue ?>"<?php echo $property_grid->SubDivisionOf->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_SubDivisionOf">
<span<?php echo $property_grid->SubDivisionOf->viewAttributes() ?>><?php echo $property_grid->SubDivisionOf->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_SubDivisionOf" name="x<?php echo $property_grid->RowIndex ?>_SubDivisionOf" id="x<?php echo $property_grid->RowIndex ?>_SubDivisionOf" value="<?php echo HtmlEncode($property_grid->SubDivisionOf->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_SubDivisionOf" name="o<?php echo $property_grid->RowIndex ?>_SubDivisionOf" id="o<?php echo $property_grid->RowIndex ?>_SubDivisionOf" value="<?php echo HtmlEncode($property_grid->SubDivisionOf->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_SubDivisionOf" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_SubDivisionOf" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_SubDivisionOf" value="<?php echo HtmlEncode($property_grid->SubDivisionOf->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_SubDivisionOf" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_SubDivisionOf" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_SubDivisionOf" value="<?php echo HtmlEncode($property_grid->SubDivisionOf->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $property_grid->LastUpdatedBy->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_LastUpdatedBy" class="form-group">
<input type="text" data-table="property" data-field="x_LastUpdatedBy" name="x<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $property_grid->LastUpdatedBy->EditValue ?>"<?php echo $property_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_LastUpdatedBy" name="o<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($property_grid->LastUpdatedBy->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_LastUpdatedBy" class="form-group">
<input type="text" data-table="property" data-field="x_LastUpdatedBy" name="x<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $property_grid->LastUpdatedBy->EditValue ?>"<?php echo $property_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_LastUpdatedBy">
<span<?php echo $property_grid->LastUpdatedBy->viewAttributes() ?>><?php echo $property_grid->LastUpdatedBy->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_LastUpdatedBy" name="x<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($property_grid->LastUpdatedBy->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_LastUpdatedBy" name="o<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($property_grid->LastUpdatedBy->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_LastUpdatedBy" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($property_grid->LastUpdatedBy->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_LastUpdatedBy" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($property_grid->LastUpdatedBy->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $property_grid->LastUpdateDate->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_LastUpdateDate" class="form-group">
<input type="text" data-table="property" data-field="x_LastUpdateDate" name="x<?php echo $property_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $property_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($property_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $property_grid->LastUpdateDate->EditValue ?>"<?php echo $property_grid->LastUpdateDate->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_LastUpdateDate" name="o<?php echo $property_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($property_grid->LastUpdateDate->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_LastUpdateDate" class="form-group">
<input type="text" data-table="property" data-field="x_LastUpdateDate" name="x<?php echo $property_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $property_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($property_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $property_grid->LastUpdateDate->EditValue ?>"<?php echo $property_grid->LastUpdateDate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_LastUpdateDate">
<span<?php echo $property_grid->LastUpdateDate->viewAttributes() ?>><?php echo $property_grid->LastUpdateDate->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_LastUpdateDate" name="x<?php echo $property_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($property_grid->LastUpdateDate->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_LastUpdateDate" name="o<?php echo $property_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($property_grid->LastUpdateDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_LastUpdateDate" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_LastUpdateDate" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($property_grid->LastUpdateDate->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_LastUpdateDate" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_LastUpdateDate" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($property_grid->LastUpdateDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo" <?php echo $property_grid->ValuationNo->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ValuationNo" class="form-group"></span>
<input type="hidden" data-table="property" data-field="x_ValuationNo" name="o<?php echo $property_grid->RowIndex ?>_ValuationNo" id="o<?php echo $property_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_grid->ValuationNo->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ValuationNo" class="form-group">
<span<?php echo $property_grid->ValuationNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ValuationNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ValuationNo" name="x<?php echo $property_grid->RowIndex ?>_ValuationNo" id="x<?php echo $property_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_grid->ValuationNo->CurrentValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ValuationNo">
<span<?php echo $property_grid->ValuationNo->viewAttributes() ?>><?php echo $property_grid->ValuationNo->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_ValuationNo" name="x<?php echo $property_grid->RowIndex ?>_ValuationNo" id="x<?php echo $property_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_grid->ValuationNo->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ValuationNo" name="o<?php echo $property_grid->RowIndex ?>_ValuationNo" id="o<?php echo $property_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_grid->ValuationNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_ValuationNo" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ValuationNo" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_grid->ValuationNo->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ValuationNo" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ValuationNo" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_grid->ValuationNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->LandValue->Visible) { // LandValue ?>
		<td data-name="LandValue" <?php echo $property_grid->LandValue->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_LandValue" class="form-group">
<input type="text" data-table="property" data-field="x_LandValue" name="x<?php echo $property_grid->RowIndex ?>_LandValue" id="x<?php echo $property_grid->RowIndex ?>_LandValue" size="30" placeholder="<?php echo HtmlEncode($property_grid->LandValue->getPlaceHolder()) ?>" value="<?php echo $property_grid->LandValue->EditValue ?>"<?php echo $property_grid->LandValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_LandValue" name="o<?php echo $property_grid->RowIndex ?>_LandValue" id="o<?php echo $property_grid->RowIndex ?>_LandValue" value="<?php echo HtmlEncode($property_grid->LandValue->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_LandValue" class="form-group">
<input type="text" data-table="property" data-field="x_LandValue" name="x<?php echo $property_grid->RowIndex ?>_LandValue" id="x<?php echo $property_grid->RowIndex ?>_LandValue" size="30" placeholder="<?php echo HtmlEncode($property_grid->LandValue->getPlaceHolder()) ?>" value="<?php echo $property_grid->LandValue->EditValue ?>"<?php echo $property_grid->LandValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_LandValue">
<span<?php echo $property_grid->LandValue->viewAttributes() ?>><?php echo $property_grid->LandValue->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_LandValue" name="x<?php echo $property_grid->RowIndex ?>_LandValue" id="x<?php echo $property_grid->RowIndex ?>_LandValue" value="<?php echo HtmlEncode($property_grid->LandValue->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_LandValue" name="o<?php echo $property_grid->RowIndex ?>_LandValue" id="o<?php echo $property_grid->RowIndex ?>_LandValue" value="<?php echo HtmlEncode($property_grid->LandValue->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_LandValue" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_LandValue" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_LandValue" value="<?php echo HtmlEncode($property_grid->LandValue->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_LandValue" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_LandValue" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_LandValue" value="<?php echo HtmlEncode($property_grid->LandValue->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($property_grid->ImprovementsValue->Visible) { // ImprovementsValue ?>
		<td data-name="ImprovementsValue" <?php echo $property_grid->ImprovementsValue->cellAttributes() ?>>
<?php if ($property->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ImprovementsValue" class="form-group">
<input type="text" data-table="property" data-field="x_ImprovementsValue" name="x<?php echo $property_grid->RowIndex ?>_ImprovementsValue" id="x<?php echo $property_grid->RowIndex ?>_ImprovementsValue" size="30" placeholder="<?php echo HtmlEncode($property_grid->ImprovementsValue->getPlaceHolder()) ?>" value="<?php echo $property_grid->ImprovementsValue->EditValue ?>"<?php echo $property_grid->ImprovementsValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="property" data-field="x_ImprovementsValue" name="o<?php echo $property_grid->RowIndex ?>_ImprovementsValue" id="o<?php echo $property_grid->RowIndex ?>_ImprovementsValue" value="<?php echo HtmlEncode($property_grid->ImprovementsValue->OldValue) ?>">
<?php } ?>
<?php if ($property->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ImprovementsValue" class="form-group">
<input type="text" data-table="property" data-field="x_ImprovementsValue" name="x<?php echo $property_grid->RowIndex ?>_ImprovementsValue" id="x<?php echo $property_grid->RowIndex ?>_ImprovementsValue" size="30" placeholder="<?php echo HtmlEncode($property_grid->ImprovementsValue->getPlaceHolder()) ?>" value="<?php echo $property_grid->ImprovementsValue->EditValue ?>"<?php echo $property_grid->ImprovementsValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($property->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $property_grid->RowCount ?>_property_ImprovementsValue">
<span<?php echo $property_grid->ImprovementsValue->viewAttributes() ?>><?php echo $property_grid->ImprovementsValue->getViewValue() ?></span>
</span>
<?php if (!$property->isConfirm()) { ?>
<input type="hidden" data-table="property" data-field="x_ImprovementsValue" name="x<?php echo $property_grid->RowIndex ?>_ImprovementsValue" id="x<?php echo $property_grid->RowIndex ?>_ImprovementsValue" value="<?php echo HtmlEncode($property_grid->ImprovementsValue->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ImprovementsValue" name="o<?php echo $property_grid->RowIndex ?>_ImprovementsValue" id="o<?php echo $property_grid->RowIndex ?>_ImprovementsValue" value="<?php echo HtmlEncode($property_grid->ImprovementsValue->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="property" data-field="x_ImprovementsValue" name="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ImprovementsValue" id="fpropertygrid$x<?php echo $property_grid->RowIndex ?>_ImprovementsValue" value="<?php echo HtmlEncode($property_grid->ImprovementsValue->FormValue) ?>">
<input type="hidden" data-table="property" data-field="x_ImprovementsValue" name="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ImprovementsValue" id="fpropertygrid$o<?php echo $property_grid->RowIndex ?>_ImprovementsValue" value="<?php echo HtmlEncode($property_grid->ImprovementsValue->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_grid->ListOptions->render("body", "right", $property_grid->RowCount);
?>
	</tr>
<?php if ($property->RowType == ROWTYPE_ADD || $property->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpropertygrid", "load"], function() {
	fpropertygrid.updateLists(<?php echo $property_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$property_grid->isGridAdd() || $property->CurrentMode == "copy")
		if (!$property_grid->Recordset->EOF)
			$property_grid->Recordset->moveNext();
}
?>
<?php
	if ($property->CurrentMode == "add" || $property->CurrentMode == "copy" || $property->CurrentMode == "edit") {
		$property_grid->RowIndex = '$rowindex$';
		$property_grid->loadRowValues();

		// Set row properties
		$property->resetAttributes();
		$property->RowAttrs->merge(["data-rowindex" => $property_grid->RowIndex, "id" => "r0_property", "data-rowtype" => ROWTYPE_ADD]);
		$property->RowAttrs->appendClass("ew-template");
		$property->RowType = ROWTYPE_ADD;

		// Render row
		$property_grid->renderRow();

		// Render list options
		$property_grid->renderListOptions();
		$property_grid->StartRowCount = 0;
?>
	<tr <?php echo $property->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_grid->ListOptions->render("body", "left", $property_grid->RowIndex);
?>
	<?php if ($property_grid->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_PropertyNo" class="form-group property_PropertyNo">
<input type="text" data-table="property" data-field="x_PropertyNo" name="x<?php echo $property_grid->RowIndex ?>_PropertyNo" id="x<?php echo $property_grid->RowIndex ?>_PropertyNo" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($property_grid->PropertyNo->getPlaceHolder()) ?>" value="<?php echo $property_grid->PropertyNo->EditValue ?>"<?php echo $property_grid->PropertyNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_PropertyNo" class="form-group property_PropertyNo">
<span<?php echo $property_grid->PropertyNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->PropertyNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyNo" name="x<?php echo $property_grid->RowIndex ?>_PropertyNo" id="x<?php echo $property_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_grid->PropertyNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_PropertyNo" name="o<?php echo $property_grid->RowIndex ?>_PropertyNo" id="o<?php echo $property_grid->RowIndex ?>_PropertyNo" value="<?php echo HtmlEncode($property_grid->PropertyNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo">
<?php if (!$property->isConfirm()) { ?>
<?php if ($property_grid->ClientSerNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_property_ClientSerNo" class="form-group property_ClientSerNo">
<span<?php echo $property_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" name="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_property_ClientSerNo" class="form-group property_ClientSerNo">
<?php
$onchange = $property_grid->ClientSerNo->EditAttrs->prepend("onchange", "ew.autoFill(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_grid->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_grid->RowIndex ?>_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="sv_x<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo RemoveHtml($property_grid->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_grid->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_grid->ClientSerNo->getPlaceHolder()) ?>"<?php echo $property_grid->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ClientSerNo',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ClientSerNo->ReadOnly || $property_grid->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertygrid"], function() {
	fpropertygrid.createAutoSuggest({"id":"x<?php echo $property_grid->RowIndex ?>_ClientSerNo","forceSelect":true});
});
</script>
<?php echo $property_grid->ClientSerNo->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ClientSerNo") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_property_ClientSerNo" class="form-group property_ClientSerNo">
<span<?php echo $property_grid->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ClientSerNo" name="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="x<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_ClientSerNo" name="o<?php echo $property_grid->RowIndex ?>_ClientSerNo" id="o<?php echo $property_grid->RowIndex ?>_ClientSerNo" value="<?php echo HtmlEncode($property_grid->ClientSerNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_ClientID" class="form-group property_ClientID">
<?php
$onchange = $property_grid->ClientID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_grid->ClientID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_grid->RowIndex ?>_ClientID">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_grid->RowIndex ?>_ClientID" id="sv_x<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo RemoveHtml($property_grid->ClientID->EditValue) ?>" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($property_grid->ClientID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_grid->ClientID->getPlaceHolder()) ?>"<?php echo $property_grid->ClientID->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->ClientID->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_ClientID',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->ClientID->ReadOnly || $property_grid->ClientID->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_ClientID" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->ClientID->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_ClientID" id="x<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($property_grid->ClientID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertygrid"], function() {
	fpropertygrid.createAutoSuggest({"id":"x<?php echo $property_grid->RowIndex ?>_ClientID","forceSelect":false});
});
</script>
<?php echo $property_grid->ClientID->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_ClientID") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_ClientID" class="form-group property_ClientID">
<span<?php echo $property_grid->ClientID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ClientID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ClientID" name="x<?php echo $property_grid->RowIndex ?>_ClientID" id="x<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($property_grid->ClientID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_ClientID" name="o<?php echo $property_grid->RowIndex ?>_ClientID" id="o<?php echo $property_grid->RowIndex ?>_ClientID" value="<?php echo HtmlEncode($property_grid->ClientID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->PropertyGroup->Visible) { // PropertyGroup ?>
		<td data-name="PropertyGroup">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_PropertyGroup" class="form-group property_PropertyGroup">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="property" data-field="x_PropertyGroup" data-value-separator="<?php echo $property_grid->PropertyGroup->displayValueSeparatorAttribute() ?>" id="x<?php echo $property_grid->RowIndex ?>_PropertyGroup" name="x<?php echo $property_grid->RowIndex ?>_PropertyGroup"<?php echo $property_grid->PropertyGroup->editAttributes() ?>>
			<?php echo $property_grid->PropertyGroup->selectOptionListHtml("x{$property_grid->RowIndex}_PropertyGroup") ?>
		</select>
</div>
<?php echo $property_grid->PropertyGroup->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_PropertyGroup") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_PropertyGroup" class="form-group property_PropertyGroup">
<span<?php echo $property_grid->PropertyGroup->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->PropertyGroup->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyGroup" name="x<?php echo $property_grid->RowIndex ?>_PropertyGroup" id="x<?php echo $property_grid->RowIndex ?>_PropertyGroup" value="<?php echo HtmlEncode($property_grid->PropertyGroup->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_PropertyGroup" name="o<?php echo $property_grid->RowIndex ?>_PropertyGroup" id="o<?php echo $property_grid->RowIndex ?>_PropertyGroup" value="<?php echo HtmlEncode($property_grid->PropertyGroup->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->PropertyType->Visible) { // PropertyType ?>
		<td data-name="PropertyType">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_PropertyType" class="form-group property_PropertyType">
<?php
$onchange = $property_grid->PropertyType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$property_grid->PropertyType->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $property_grid->RowIndex ?>_PropertyType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $property_grid->RowIndex ?>_PropertyType" id="sv_x<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo RemoveHtml($property_grid->PropertyType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($property_grid->PropertyType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($property_grid->PropertyType->getPlaceHolder()) ?>"<?php echo $property_grid->PropertyType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->PropertyType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_PropertyType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->PropertyType->ReadOnly || $property_grid->PropertyType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $property_grid->PropertyType->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_PropertyType" id="x<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo HtmlEncode($property_grid->PropertyType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpropertygrid"], function() {
	fpropertygrid.createAutoSuggest({"id":"x<?php echo $property_grid->RowIndex ?>_PropertyType","forceSelect":false});
});
</script>
<?php echo $property_grid->PropertyType->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_PropertyType") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_PropertyType" class="form-group property_PropertyType">
<span<?php echo $property_grid->PropertyType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->PropertyType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyType" name="x<?php echo $property_grid->RowIndex ?>_PropertyType" id="x<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo HtmlEncode($property_grid->PropertyType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_PropertyType" name="o<?php echo $property_grid->RowIndex ?>_PropertyType" id="o<?php echo $property_grid->RowIndex ?>_PropertyType" value="<?php echo HtmlEncode($property_grid->PropertyType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->Location->Visible) { // Location ?>
		<td data-name="Location">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_Location" class="form-group property_Location">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_grid->RowIndex ?>_Location"><?php echo EmptyValue(strval($property_grid->Location->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_grid->Location->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->Location->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->Location->ReadOnly || $property_grid->Location->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_Location[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_grid->Location->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_Location") ?>
<input type="hidden" data-table="property" data-field="x_Location" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_grid->Location->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_Location[]" id="x<?php echo $property_grid->RowIndex ?>_Location[]" value="<?php echo $property_grid->Location->CurrentValue ?>"<?php echo $property_grid->Location->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_Location" class="form-group property_Location">
<span<?php echo $property_grid->Location->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->Location->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Location" name="x<?php echo $property_grid->RowIndex ?>_Location" id="x<?php echo $property_grid->RowIndex ?>_Location" value="<?php echo HtmlEncode($property_grid->Location->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_Location" name="o<?php echo $property_grid->RowIndex ?>_Location[]" id="o<?php echo $property_grid->RowIndex ?>_Location[]" value="<?php echo HtmlEncode($property_grid->Location->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->PropertyStatus->Visible) { // PropertyStatus ?>
		<td data-name="PropertyStatus">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_PropertyStatus" class="form-group property_PropertyStatus">
<input type="text" data-table="property" data-field="x_PropertyStatus" name="x<?php echo $property_grid->RowIndex ?>_PropertyStatus" id="x<?php echo $property_grid->RowIndex ?>_PropertyStatus" size="30" placeholder="<?php echo HtmlEncode($property_grid->PropertyStatus->getPlaceHolder()) ?>" value="<?php echo $property_grid->PropertyStatus->EditValue ?>"<?php echo $property_grid->PropertyStatus->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_PropertyStatus" class="form-group property_PropertyStatus">
<span<?php echo $property_grid->PropertyStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->PropertyStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyStatus" name="x<?php echo $property_grid->RowIndex ?>_PropertyStatus" id="x<?php echo $property_grid->RowIndex ?>_PropertyStatus" value="<?php echo HtmlEncode($property_grid->PropertyStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_PropertyStatus" name="o<?php echo $property_grid->RowIndex ?>_PropertyStatus" id="o<?php echo $property_grid->RowIndex ?>_PropertyStatus" value="<?php echo HtmlEncode($property_grid->PropertyStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_PropertyUse" class="form-group property_PropertyUse">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $property_grid->RowIndex ?>_PropertyUse"><?php echo EmptyValue(strval($property_grid->PropertyUse->ViewValue)) ? $Language->phrase("PleaseSelect") : $property_grid->PropertyUse->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($property_grid->PropertyUse->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($property_grid->PropertyUse->ReadOnly || $property_grid->PropertyUse->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $property_grid->RowIndex ?>_PropertyUse[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $property_grid->PropertyUse->Lookup->getParamTag($property_grid, "p_x" . $property_grid->RowIndex . "_PropertyUse") ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $property_grid->PropertyUse->displayValueSeparatorAttribute() ?>" name="x<?php echo $property_grid->RowIndex ?>_PropertyUse[]" id="x<?php echo $property_grid->RowIndex ?>_PropertyUse[]" value="<?php echo $property_grid->PropertyUse->CurrentValue ?>"<?php echo $property_grid->PropertyUse->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_PropertyUse" class="form-group property_PropertyUse">
<span<?php echo $property_grid->PropertyUse->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->PropertyUse->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="x<?php echo $property_grid->RowIndex ?>_PropertyUse" id="x<?php echo $property_grid->RowIndex ?>_PropertyUse" value="<?php echo HtmlEncode($property_grid->PropertyUse->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_PropertyUse" name="o<?php echo $property_grid->RowIndex ?>_PropertyUse[]" id="o<?php echo $property_grid->RowIndex ?>_PropertyUse[]" value="<?php echo HtmlEncode($property_grid->PropertyUse->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->LandExtentInHA->Visible) { // LandExtentInHA ?>
		<td data-name="LandExtentInHA">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_LandExtentInHA" class="form-group property_LandExtentInHA">
<input type="text" data-table="property" data-field="x_LandExtentInHA" name="x<?php echo $property_grid->RowIndex ?>_LandExtentInHA" id="x<?php echo $property_grid->RowIndex ?>_LandExtentInHA" size="30" placeholder="<?php echo HtmlEncode($property_grid->LandExtentInHA->getPlaceHolder()) ?>" value="<?php echo $property_grid->LandExtentInHA->EditValue ?>"<?php echo $property_grid->LandExtentInHA->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_LandExtentInHA" class="form-group property_LandExtentInHA">
<span<?php echo $property_grid->LandExtentInHA->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->LandExtentInHA->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_LandExtentInHA" name="x<?php echo $property_grid->RowIndex ?>_LandExtentInHA" id="x<?php echo $property_grid->RowIndex ?>_LandExtentInHA" value="<?php echo HtmlEncode($property_grid->LandExtentInHA->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_LandExtentInHA" name="o<?php echo $property_grid->RowIndex ?>_LandExtentInHA" id="o<?php echo $property_grid->RowIndex ?>_LandExtentInHA" value="<?php echo HtmlEncode($property_grid->LandExtentInHA->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->RateableValue->Visible) { // RateableValue ?>
		<td data-name="RateableValue">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_RateableValue" class="form-group property_RateableValue">
<input type="text" data-table="property" data-field="x_RateableValue" name="x<?php echo $property_grid->RowIndex ?>_RateableValue" id="x<?php echo $property_grid->RowIndex ?>_RateableValue" size="30" placeholder="<?php echo HtmlEncode($property_grid->RateableValue->getPlaceHolder()) ?>" value="<?php echo $property_grid->RateableValue->EditValue ?>"<?php echo $property_grid->RateableValue->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_RateableValue" class="form-group property_RateableValue">
<span<?php echo $property_grid->RateableValue->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->RateableValue->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_RateableValue" name="x<?php echo $property_grid->RowIndex ?>_RateableValue" id="x<?php echo $property_grid->RowIndex ?>_RateableValue" value="<?php echo HtmlEncode($property_grid->RateableValue->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_RateableValue" name="o<?php echo $property_grid->RowIndex ?>_RateableValue" id="o<?php echo $property_grid->RowIndex ?>_RateableValue" value="<?php echo HtmlEncode($property_grid->RateableValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->SupplementaryValue->Visible) { // SupplementaryValue ?>
		<td data-name="SupplementaryValue">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_SupplementaryValue" class="form-group property_SupplementaryValue">
<input type="text" data-table="property" data-field="x_SupplementaryValue" name="x<?php echo $property_grid->RowIndex ?>_SupplementaryValue" id="x<?php echo $property_grid->RowIndex ?>_SupplementaryValue" size="30" placeholder="<?php echo HtmlEncode($property_grid->SupplementaryValue->getPlaceHolder()) ?>" value="<?php echo $property_grid->SupplementaryValue->EditValue ?>"<?php echo $property_grid->SupplementaryValue->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_SupplementaryValue" class="form-group property_SupplementaryValue">
<span<?php echo $property_grid->SupplementaryValue->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->SupplementaryValue->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_SupplementaryValue" name="x<?php echo $property_grid->RowIndex ?>_SupplementaryValue" id="x<?php echo $property_grid->RowIndex ?>_SupplementaryValue" value="<?php echo HtmlEncode($property_grid->SupplementaryValue->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_SupplementaryValue" name="o<?php echo $property_grid->RowIndex ?>_SupplementaryValue" id="o<?php echo $property_grid->RowIndex ?>_SupplementaryValue" value="<?php echo HtmlEncode($property_grid->SupplementaryValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->ExemptCode->Visible) { // ExemptCode ?>
		<td data-name="ExemptCode">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_ExemptCode" class="form-group property_ExemptCode">
<input type="text" data-table="property" data-field="x_ExemptCode" name="x<?php echo $property_grid->RowIndex ?>_ExemptCode" id="x<?php echo $property_grid->RowIndex ?>_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($property_grid->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $property_grid->ExemptCode->EditValue ?>"<?php echo $property_grid->ExemptCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_ExemptCode" class="form-group property_ExemptCode">
<span<?php echo $property_grid->ExemptCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ExemptCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ExemptCode" name="x<?php echo $property_grid->RowIndex ?>_ExemptCode" id="x<?php echo $property_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($property_grid->ExemptCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_ExemptCode" name="o<?php echo $property_grid->RowIndex ?>_ExemptCode" id="o<?php echo $property_grid->RowIndex ?>_ExemptCode" value="<?php echo HtmlEncode($property_grid->ExemptCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->Improvements->Visible) { // Improvements ?>
		<td data-name="Improvements">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_Improvements" class="form-group property_Improvements">
<textarea data-table="property" data-field="x_Improvements" name="x<?php echo $property_grid->RowIndex ?>_Improvements" id="x<?php echo $property_grid->RowIndex ?>_Improvements" cols="50" rows="2" placeholder="<?php echo HtmlEncode($property_grid->Improvements->getPlaceHolder()) ?>"<?php echo $property_grid->Improvements->editAttributes() ?>><?php echo $property_grid->Improvements->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_Improvements" class="form-group property_Improvements">
<span<?php echo $property_grid->Improvements->viewAttributes() ?>><?php echo $property_grid->Improvements->ViewValue ?></span>
</span>
<input type="hidden" data-table="property" data-field="x_Improvements" name="x<?php echo $property_grid->RowIndex ?>_Improvements" id="x<?php echo $property_grid->RowIndex ?>_Improvements" value="<?php echo HtmlEncode($property_grid->Improvements->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_Improvements" name="o<?php echo $property_grid->RowIndex ?>_Improvements" id="o<?php echo $property_grid->RowIndex ?>_Improvements" value="<?php echo HtmlEncode($property_grid->Improvements->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->StreetAddress->Visible) { // StreetAddress ?>
		<td data-name="StreetAddress">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_StreetAddress" class="form-group property_StreetAddress">
<textarea data-table="property" data-field="x_StreetAddress" name="x<?php echo $property_grid->RowIndex ?>_StreetAddress" id="x<?php echo $property_grid->RowIndex ?>_StreetAddress" cols="50" rows="2" placeholder="<?php echo HtmlEncode($property_grid->StreetAddress->getPlaceHolder()) ?>"<?php echo $property_grid->StreetAddress->editAttributes() ?>><?php echo $property_grid->StreetAddress->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_StreetAddress" class="form-group property_StreetAddress">
<span<?php echo $property_grid->StreetAddress->viewAttributes() ?>><?php echo $property_grid->StreetAddress->ViewValue ?></span>
</span>
<input type="hidden" data-table="property" data-field="x_StreetAddress" name="x<?php echo $property_grid->RowIndex ?>_StreetAddress" id="x<?php echo $property_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($property_grid->StreetAddress->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_StreetAddress" name="o<?php echo $property_grid->RowIndex ?>_StreetAddress" id="o<?php echo $property_grid->RowIndex ?>_StreetAddress" value="<?php echo HtmlEncode($property_grid->StreetAddress->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_Longitude" class="form-group property_Longitude">
<input type="text" data-table="property" data-field="x_Longitude" name="x<?php echo $property_grid->RowIndex ?>_Longitude" id="x<?php echo $property_grid->RowIndex ?>_Longitude" size="30" placeholder="<?php echo HtmlEncode($property_grid->Longitude->getPlaceHolder()) ?>" value="<?php echo $property_grid->Longitude->EditValue ?>"<?php echo $property_grid->Longitude->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_Longitude" class="form-group property_Longitude">
<span<?php echo $property_grid->Longitude->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->Longitude->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Longitude" name="x<?php echo $property_grid->RowIndex ?>_Longitude" id="x<?php echo $property_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($property_grid->Longitude->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_Longitude" name="o<?php echo $property_grid->RowIndex ?>_Longitude" id="o<?php echo $property_grid->RowIndex ?>_Longitude" value="<?php echo HtmlEncode($property_grid->Longitude->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_Latitude" class="form-group property_Latitude">
<input type="text" data-table="property" data-field="x_Latitude" name="x<?php echo $property_grid->RowIndex ?>_Latitude" id="x<?php echo $property_grid->RowIndex ?>_Latitude" size="30" placeholder="<?php echo HtmlEncode($property_grid->Latitude->getPlaceHolder()) ?>" value="<?php echo $property_grid->Latitude->EditValue ?>"<?php echo $property_grid->Latitude->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_Latitude" class="form-group property_Latitude">
<span<?php echo $property_grid->Latitude->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->Latitude->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Latitude" name="x<?php echo $property_grid->RowIndex ?>_Latitude" id="x<?php echo $property_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($property_grid->Latitude->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_Latitude" name="o<?php echo $property_grid->RowIndex ?>_Latitude" id="o<?php echo $property_grid->RowIndex ?>_Latitude" value="<?php echo HtmlEncode($property_grid->Latitude->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->Incumberance->Visible) { // Incumberance ?>
		<td data-name="Incumberance">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_Incumberance" class="form-group property_Incumberance">
<input type="text" data-table="property" data-field="x_Incumberance" name="x<?php echo $property_grid->RowIndex ?>_Incumberance" id="x<?php echo $property_grid->RowIndex ?>_Incumberance" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($property_grid->Incumberance->getPlaceHolder()) ?>" value="<?php echo $property_grid->Incumberance->EditValue ?>"<?php echo $property_grid->Incumberance->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_Incumberance" class="form-group property_Incumberance">
<span<?php echo $property_grid->Incumberance->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->Incumberance->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_Incumberance" name="x<?php echo $property_grid->RowIndex ?>_Incumberance" id="x<?php echo $property_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($property_grid->Incumberance->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_Incumberance" name="o<?php echo $property_grid->RowIndex ?>_Incumberance" id="o<?php echo $property_grid->RowIndex ?>_Incumberance" value="<?php echo HtmlEncode($property_grid->Incumberance->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->SubDivisionOf->Visible) { // SubDivisionOf ?>
		<td data-name="SubDivisionOf">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_SubDivisionOf" class="form-group property_SubDivisionOf">
<input type="text" data-table="property" data-field="x_SubDivisionOf" name="x<?php echo $property_grid->RowIndex ?>_SubDivisionOf" id="x<?php echo $property_grid->RowIndex ?>_SubDivisionOf" size="30" placeholder="<?php echo HtmlEncode($property_grid->SubDivisionOf->getPlaceHolder()) ?>" value="<?php echo $property_grid->SubDivisionOf->EditValue ?>"<?php echo $property_grid->SubDivisionOf->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_SubDivisionOf" class="form-group property_SubDivisionOf">
<span<?php echo $property_grid->SubDivisionOf->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->SubDivisionOf->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_SubDivisionOf" name="x<?php echo $property_grid->RowIndex ?>_SubDivisionOf" id="x<?php echo $property_grid->RowIndex ?>_SubDivisionOf" value="<?php echo HtmlEncode($property_grid->SubDivisionOf->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_SubDivisionOf" name="o<?php echo $property_grid->RowIndex ?>_SubDivisionOf" id="o<?php echo $property_grid->RowIndex ?>_SubDivisionOf" value="<?php echo HtmlEncode($property_grid->SubDivisionOf->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_LastUpdatedBy" class="form-group property_LastUpdatedBy">
<input type="text" data-table="property" data-field="x_LastUpdatedBy" name="x<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($property_grid->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $property_grid->LastUpdatedBy->EditValue ?>"<?php echo $property_grid->LastUpdatedBy->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_LastUpdatedBy" class="form-group property_LastUpdatedBy">
<span<?php echo $property_grid->LastUpdatedBy->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->LastUpdatedBy->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_LastUpdatedBy" name="x<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" id="x<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($property_grid->LastUpdatedBy->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_LastUpdatedBy" name="o<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" id="o<?php echo $property_grid->RowIndex ?>_LastUpdatedBy" value="<?php echo HtmlEncode($property_grid->LastUpdatedBy->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_LastUpdateDate" class="form-group property_LastUpdateDate">
<input type="text" data-table="property" data-field="x_LastUpdateDate" name="x<?php echo $property_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $property_grid->RowIndex ?>_LastUpdateDate" placeholder="<?php echo HtmlEncode($property_grid->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $property_grid->LastUpdateDate->EditValue ?>"<?php echo $property_grid->LastUpdateDate->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_LastUpdateDate" class="form-group property_LastUpdateDate">
<span<?php echo $property_grid->LastUpdateDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->LastUpdateDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_LastUpdateDate" name="x<?php echo $property_grid->RowIndex ?>_LastUpdateDate" id="x<?php echo $property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($property_grid->LastUpdateDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_LastUpdateDate" name="o<?php echo $property_grid->RowIndex ?>_LastUpdateDate" id="o<?php echo $property_grid->RowIndex ?>_LastUpdateDate" value="<?php echo HtmlEncode($property_grid->LastUpdateDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_ValuationNo" class="form-group property_ValuationNo"></span>
<?php } else { ?>
<span id="el$rowindex$_property_ValuationNo" class="form-group property_ValuationNo">
<span<?php echo $property_grid->ValuationNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ValuationNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ValuationNo" name="x<?php echo $property_grid->RowIndex ?>_ValuationNo" id="x<?php echo $property_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_grid->ValuationNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_ValuationNo" name="o<?php echo $property_grid->RowIndex ?>_ValuationNo" id="o<?php echo $property_grid->RowIndex ?>_ValuationNo" value="<?php echo HtmlEncode($property_grid->ValuationNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->LandValue->Visible) { // LandValue ?>
		<td data-name="LandValue">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_LandValue" class="form-group property_LandValue">
<input type="text" data-table="property" data-field="x_LandValue" name="x<?php echo $property_grid->RowIndex ?>_LandValue" id="x<?php echo $property_grid->RowIndex ?>_LandValue" size="30" placeholder="<?php echo HtmlEncode($property_grid->LandValue->getPlaceHolder()) ?>" value="<?php echo $property_grid->LandValue->EditValue ?>"<?php echo $property_grid->LandValue->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_LandValue" class="form-group property_LandValue">
<span<?php echo $property_grid->LandValue->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->LandValue->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_LandValue" name="x<?php echo $property_grid->RowIndex ?>_LandValue" id="x<?php echo $property_grid->RowIndex ?>_LandValue" value="<?php echo HtmlEncode($property_grid->LandValue->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_LandValue" name="o<?php echo $property_grid->RowIndex ?>_LandValue" id="o<?php echo $property_grid->RowIndex ?>_LandValue" value="<?php echo HtmlEncode($property_grid->LandValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($property_grid->ImprovementsValue->Visible) { // ImprovementsValue ?>
		<td data-name="ImprovementsValue">
<?php if (!$property->isConfirm()) { ?>
<span id="el$rowindex$_property_ImprovementsValue" class="form-group property_ImprovementsValue">
<input type="text" data-table="property" data-field="x_ImprovementsValue" name="x<?php echo $property_grid->RowIndex ?>_ImprovementsValue" id="x<?php echo $property_grid->RowIndex ?>_ImprovementsValue" size="30" placeholder="<?php echo HtmlEncode($property_grid->ImprovementsValue->getPlaceHolder()) ?>" value="<?php echo $property_grid->ImprovementsValue->EditValue ?>"<?php echo $property_grid->ImprovementsValue->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_property_ImprovementsValue" class="form-group property_ImprovementsValue">
<span<?php echo $property_grid->ImprovementsValue->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($property_grid->ImprovementsValue->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="property" data-field="x_ImprovementsValue" name="x<?php echo $property_grid->RowIndex ?>_ImprovementsValue" id="x<?php echo $property_grid->RowIndex ?>_ImprovementsValue" value="<?php echo HtmlEncode($property_grid->ImprovementsValue->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="property" data-field="x_ImprovementsValue" name="o<?php echo $property_grid->RowIndex ?>_ImprovementsValue" id="o<?php echo $property_grid->RowIndex ?>_ImprovementsValue" value="<?php echo HtmlEncode($property_grid->ImprovementsValue->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_grid->ListOptions->render("body", "right", $property_grid->RowIndex);
?>
<script>
loadjs.ready(["fpropertygrid", "load"], function() {
	fpropertygrid.updateLists(<?php echo $property_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($property->CurrentMode == "add" || $property->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $property_grid->FormKeyCountName ?>" id="<?php echo $property_grid->FormKeyCountName ?>" value="<?php echo $property_grid->KeyCount ?>">
<?php echo $property_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($property->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $property_grid->FormKeyCountName ?>" id="<?php echo $property_grid->FormKeyCountName ?>" value="<?php echo $property_grid->KeyCount ?>">
<?php echo $property_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($property->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpropertygrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_grid->Recordset)
	$property_grid->Recordset->Close();
?>
<?php if ($property_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $property_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_grid->TotalRecords == 0 && !$property->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$property_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$property_grid->terminate();
?>