<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($asset_grid))
	$asset_grid = new asset_grid();

// Run the page
$asset_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_grid->Page_Render();
?>
<?php if (!$asset_grid->isExport()) { ?>
<script>
var fassetgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fassetgrid = new ew.Form("fassetgrid", "grid");
	fassetgrid.formKeyCountName = '<?php echo $asset_grid->FormKeyCountName ?>';

	// Validate form
	fassetgrid.validate = function() {
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
			<?php if ($asset_grid->AssetCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->AssetCode->caption(), $asset_grid->AssetCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_grid->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->ProvinceCode->caption(), $asset_grid->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_grid->ProvinceCode->errorMessage()) ?>");
			<?php if ($asset_grid->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->LACode->caption(), $asset_grid->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_grid->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->DepartmentCode->caption(), $asset_grid->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_grid->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->SectionCode->caption(), $asset_grid->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_grid->AssetTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->AssetTypeCode->caption(), $asset_grid->AssetTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_grid->Supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_Supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->Supplier->caption(), $asset_grid->Supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_grid->PurchasePrice->Required) { ?>
				elm = this.getElements("x" + infix + "_PurchasePrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->PurchasePrice->caption(), $asset_grid->PurchasePrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PurchasePrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_grid->PurchasePrice->errorMessage()) ?>");
			<?php if ($asset_grid->CurrencyCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrencyCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->CurrencyCode->caption(), $asset_grid->CurrencyCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_grid->ConditionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ConditionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->ConditionCode->caption(), $asset_grid->ConditionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_grid->DateOfPurchase->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfPurchase");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->DateOfPurchase->caption(), $asset_grid->DateOfPurchase->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfPurchase");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_grid->DateOfPurchase->errorMessage()) ?>");
			<?php if ($asset_grid->AssetCapacity->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetCapacity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->AssetCapacity->caption(), $asset_grid->AssetCapacity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AssetCapacity");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_grid->AssetCapacity->errorMessage()) ?>");
			<?php if ($asset_grid->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->UnitOfMeasure->caption(), $asset_grid->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_grid->AssetDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->AssetDescription->caption(), $asset_grid->AssetDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_grid->DateOfLastRevaluation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfLastRevaluation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->DateOfLastRevaluation->caption(), $asset_grid->DateOfLastRevaluation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfLastRevaluation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_grid->DateOfLastRevaluation->errorMessage()) ?>");
			<?php if ($asset_grid->NewValue->Required) { ?>
				elm = this.getElements("x" + infix + "_NewValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->NewValue->caption(), $asset_grid->NewValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NewValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_grid->NewValue->errorMessage()) ?>");
			<?php if ($asset_grid->NameOfValuer->Required) { ?>
				elm = this.getElements("x" + infix + "_NameOfValuer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->NameOfValuer->caption(), $asset_grid->NameOfValuer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_grid->BookValue->Required) { ?>
				elm = this.getElements("x" + infix + "_BookValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->BookValue->caption(), $asset_grid->BookValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BookValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_grid->BookValue->errorMessage()) ?>");
			<?php if ($asset_grid->LastDepreciationDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastDepreciationDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->LastDepreciationDate->caption(), $asset_grid->LastDepreciationDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastDepreciationDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_grid->LastDepreciationDate->errorMessage()) ?>");
			<?php if ($asset_grid->LastDepreciationAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_LastDepreciationAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->LastDepreciationAmount->caption(), $asset_grid->LastDepreciationAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastDepreciationAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_grid->LastDepreciationAmount->errorMessage()) ?>");
			<?php if ($asset_grid->DepreciationRate->Required) { ?>
				elm = this.getElements("x" + infix + "_DepreciationRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->DepreciationRate->caption(), $asset_grid->DepreciationRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DepreciationRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_grid->DepreciationRate->errorMessage()) ?>");
			<?php if ($asset_grid->CumulativeDepreciation->Required) { ?>
				elm = this.getElements("x" + infix + "_CumulativeDepreciation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->CumulativeDepreciation->caption(), $asset_grid->CumulativeDepreciation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CumulativeDepreciation");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_grid->CumulativeDepreciation->errorMessage()) ?>");
			<?php if ($asset_grid->AssetStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->AssetStatus->caption(), $asset_grid->AssetStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_grid->ScrapValue->Required) { ?>
				elm = this.getElements("x" + infix + "_ScrapValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_grid->ScrapValue->caption(), $asset_grid->ScrapValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ScrapValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_grid->ScrapValue->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fassetgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "AssetCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AssetTypeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "Supplier", false)) return false;
		if (ew.valueChanged(fobj, infix, "PurchasePrice", false)) return false;
		if (ew.valueChanged(fobj, infix, "CurrencyCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "ConditionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfPurchase", false)) return false;
		if (ew.valueChanged(fobj, infix, "AssetCapacity", false)) return false;
		if (ew.valueChanged(fobj, infix, "UnitOfMeasure", false)) return false;
		if (ew.valueChanged(fobj, infix, "AssetDescription", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfLastRevaluation", false)) return false;
		if (ew.valueChanged(fobj, infix, "NewValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "NameOfValuer", false)) return false;
		if (ew.valueChanged(fobj, infix, "BookValue", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastDepreciationDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastDepreciationAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepreciationRate", false)) return false;
		if (ew.valueChanged(fobj, infix, "CumulativeDepreciation", false)) return false;
		if (ew.valueChanged(fobj, infix, "AssetStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "ScrapValue", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fassetgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fassetgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fassetgrid.lists["x_ProvinceCode"] = <?php echo $asset_grid->ProvinceCode->Lookup->toClientList($asset_grid) ?>;
	fassetgrid.lists["x_ProvinceCode"].options = <?php echo JsonEncode($asset_grid->ProvinceCode->lookupOptions()) ?>;
	fassetgrid.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fassetgrid.lists["x_LACode"] = <?php echo $asset_grid->LACode->Lookup->toClientList($asset_grid) ?>;
	fassetgrid.lists["x_LACode"].options = <?php echo JsonEncode($asset_grid->LACode->lookupOptions()) ?>;
	fassetgrid.lists["x_DepartmentCode"] = <?php echo $asset_grid->DepartmentCode->Lookup->toClientList($asset_grid) ?>;
	fassetgrid.lists["x_DepartmentCode"].options = <?php echo JsonEncode($asset_grid->DepartmentCode->lookupOptions()) ?>;
	fassetgrid.lists["x_SectionCode"] = <?php echo $asset_grid->SectionCode->Lookup->toClientList($asset_grid) ?>;
	fassetgrid.lists["x_SectionCode"].options = <?php echo JsonEncode($asset_grid->SectionCode->lookupOptions()) ?>;
	fassetgrid.lists["x_AssetTypeCode"] = <?php echo $asset_grid->AssetTypeCode->Lookup->toClientList($asset_grid) ?>;
	fassetgrid.lists["x_AssetTypeCode"].options = <?php echo JsonEncode($asset_grid->AssetTypeCode->lookupOptions()) ?>;
	fassetgrid.lists["x_CurrencyCode"] = <?php echo $asset_grid->CurrencyCode->Lookup->toClientList($asset_grid) ?>;
	fassetgrid.lists["x_CurrencyCode"].options = <?php echo JsonEncode($asset_grid->CurrencyCode->lookupOptions()) ?>;
	fassetgrid.lists["x_ConditionCode"] = <?php echo $asset_grid->ConditionCode->Lookup->toClientList($asset_grid) ?>;
	fassetgrid.lists["x_ConditionCode"].options = <?php echo JsonEncode($asset_grid->ConditionCode->lookupOptions()) ?>;
	fassetgrid.lists["x_UnitOfMeasure"] = <?php echo $asset_grid->UnitOfMeasure->Lookup->toClientList($asset_grid) ?>;
	fassetgrid.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($asset_grid->UnitOfMeasure->lookupOptions()) ?>;
	fassetgrid.lists["x_AssetStatus"] = <?php echo $asset_grid->AssetStatus->Lookup->toClientList($asset_grid) ?>;
	fassetgrid.lists["x_AssetStatus"].options = <?php echo JsonEncode($asset_grid->AssetStatus->lookupOptions()) ?>;
	loadjs.done("fassetgrid");
});
</script>
<?php } ?>
<?php
$asset_grid->renderOtherOptions();
?>
<?php if ($asset_grid->TotalRecords > 0 || $asset->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($asset_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> asset">
<?php if ($asset_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $asset_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fassetgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_asset" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_assetgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$asset->RowType = ROWTYPE_HEADER;

// Render list options
$asset_grid->renderListOptions();

// Render list options (header, left)
$asset_grid->ListOptions->render("header", "left");
?>
<?php if ($asset_grid->AssetCode->Visible) { // AssetCode ?>
	<?php if ($asset_grid->SortUrl($asset_grid->AssetCode) == "") { ?>
		<th data-name="AssetCode" class="<?php echo $asset_grid->AssetCode->headerCellClass() ?>"><div id="elh_asset_AssetCode" class="asset_AssetCode"><div class="ew-table-header-caption"><?php echo $asset_grid->AssetCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetCode" class="<?php echo $asset_grid->AssetCode->headerCellClass() ?>"><div><div id="elh_asset_AssetCode" class="asset_AssetCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->AssetCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->AssetCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->AssetCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($asset_grid->SortUrl($asset_grid->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $asset_grid->ProvinceCode->headerCellClass() ?>"><div id="elh_asset_ProvinceCode" class="asset_ProvinceCode"><div class="ew-table-header-caption"><?php echo $asset_grid->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $asset_grid->ProvinceCode->headerCellClass() ?>"><div><div id="elh_asset_ProvinceCode" class="asset_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->LACode->Visible) { // LACode ?>
	<?php if ($asset_grid->SortUrl($asset_grid->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $asset_grid->LACode->headerCellClass() ?>"><div id="elh_asset_LACode" class="asset_LACode"><div class="ew-table-header-caption"><?php echo $asset_grid->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $asset_grid->LACode->headerCellClass() ?>"><div><div id="elh_asset_LACode" class="asset_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($asset_grid->SortUrl($asset_grid->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $asset_grid->DepartmentCode->headerCellClass() ?>"><div id="elh_asset_DepartmentCode" class="asset_DepartmentCode"><div class="ew-table-header-caption"><?php echo $asset_grid->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $asset_grid->DepartmentCode->headerCellClass() ?>"><div><div id="elh_asset_DepartmentCode" class="asset_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->SectionCode->Visible) { // SectionCode ?>
	<?php if ($asset_grid->SortUrl($asset_grid->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $asset_grid->SectionCode->headerCellClass() ?>"><div id="elh_asset_SectionCode" class="asset_SectionCode"><div class="ew-table-header-caption"><?php echo $asset_grid->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $asset_grid->SectionCode->headerCellClass() ?>"><div><div id="elh_asset_SectionCode" class="asset_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->AssetTypeCode->Visible) { // AssetTypeCode ?>
	<?php if ($asset_grid->SortUrl($asset_grid->AssetTypeCode) == "") { ?>
		<th data-name="AssetTypeCode" class="<?php echo $asset_grid->AssetTypeCode->headerCellClass() ?>"><div id="elh_asset_AssetTypeCode" class="asset_AssetTypeCode"><div class="ew-table-header-caption"><?php echo $asset_grid->AssetTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetTypeCode" class="<?php echo $asset_grid->AssetTypeCode->headerCellClass() ?>"><div><div id="elh_asset_AssetTypeCode" class="asset_AssetTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->AssetTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->AssetTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->AssetTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->Supplier->Visible) { // Supplier ?>
	<?php if ($asset_grid->SortUrl($asset_grid->Supplier) == "") { ?>
		<th data-name="Supplier" class="<?php echo $asset_grid->Supplier->headerCellClass() ?>"><div id="elh_asset_Supplier" class="asset_Supplier"><div class="ew-table-header-caption"><?php echo $asset_grid->Supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Supplier" class="<?php echo $asset_grid->Supplier->headerCellClass() ?>"><div><div id="elh_asset_Supplier" class="asset_Supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->Supplier->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->Supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->Supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->PurchasePrice->Visible) { // PurchasePrice ?>
	<?php if ($asset_grid->SortUrl($asset_grid->PurchasePrice) == "") { ?>
		<th data-name="PurchasePrice" class="<?php echo $asset_grid->PurchasePrice->headerCellClass() ?>"><div id="elh_asset_PurchasePrice" class="asset_PurchasePrice"><div class="ew-table-header-caption"><?php echo $asset_grid->PurchasePrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PurchasePrice" class="<?php echo $asset_grid->PurchasePrice->headerCellClass() ?>"><div><div id="elh_asset_PurchasePrice" class="asset_PurchasePrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->PurchasePrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->PurchasePrice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->PurchasePrice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->CurrencyCode->Visible) { // CurrencyCode ?>
	<?php if ($asset_grid->SortUrl($asset_grid->CurrencyCode) == "") { ?>
		<th data-name="CurrencyCode" class="<?php echo $asset_grid->CurrencyCode->headerCellClass() ?>"><div id="elh_asset_CurrencyCode" class="asset_CurrencyCode"><div class="ew-table-header-caption"><?php echo $asset_grid->CurrencyCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrencyCode" class="<?php echo $asset_grid->CurrencyCode->headerCellClass() ?>"><div><div id="elh_asset_CurrencyCode" class="asset_CurrencyCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->CurrencyCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->CurrencyCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->CurrencyCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->ConditionCode->Visible) { // ConditionCode ?>
	<?php if ($asset_grid->SortUrl($asset_grid->ConditionCode) == "") { ?>
		<th data-name="ConditionCode" class="<?php echo $asset_grid->ConditionCode->headerCellClass() ?>"><div id="elh_asset_ConditionCode" class="asset_ConditionCode"><div class="ew-table-header-caption"><?php echo $asset_grid->ConditionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ConditionCode" class="<?php echo $asset_grid->ConditionCode->headerCellClass() ?>"><div><div id="elh_asset_ConditionCode" class="asset_ConditionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->ConditionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->ConditionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->ConditionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->DateOfPurchase->Visible) { // DateOfPurchase ?>
	<?php if ($asset_grid->SortUrl($asset_grid->DateOfPurchase) == "") { ?>
		<th data-name="DateOfPurchase" class="<?php echo $asset_grid->DateOfPurchase->headerCellClass() ?>"><div id="elh_asset_DateOfPurchase" class="asset_DateOfPurchase"><div class="ew-table-header-caption"><?php echo $asset_grid->DateOfPurchase->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfPurchase" class="<?php echo $asset_grid->DateOfPurchase->headerCellClass() ?>"><div><div id="elh_asset_DateOfPurchase" class="asset_DateOfPurchase">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->DateOfPurchase->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->DateOfPurchase->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->DateOfPurchase->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->AssetCapacity->Visible) { // AssetCapacity ?>
	<?php if ($asset_grid->SortUrl($asset_grid->AssetCapacity) == "") { ?>
		<th data-name="AssetCapacity" class="<?php echo $asset_grid->AssetCapacity->headerCellClass() ?>"><div id="elh_asset_AssetCapacity" class="asset_AssetCapacity"><div class="ew-table-header-caption"><?php echo $asset_grid->AssetCapacity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetCapacity" class="<?php echo $asset_grid->AssetCapacity->headerCellClass() ?>"><div><div id="elh_asset_AssetCapacity" class="asset_AssetCapacity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->AssetCapacity->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->AssetCapacity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->AssetCapacity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($asset_grid->SortUrl($asset_grid->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $asset_grid->UnitOfMeasure->headerCellClass() ?>"><div id="elh_asset_UnitOfMeasure" class="asset_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $asset_grid->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $asset_grid->UnitOfMeasure->headerCellClass() ?>"><div><div id="elh_asset_UnitOfMeasure" class="asset_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->AssetDescription->Visible) { // AssetDescription ?>
	<?php if ($asset_grid->SortUrl($asset_grid->AssetDescription) == "") { ?>
		<th data-name="AssetDescription" class="<?php echo $asset_grid->AssetDescription->headerCellClass() ?>"><div id="elh_asset_AssetDescription" class="asset_AssetDescription"><div class="ew-table-header-caption"><?php echo $asset_grid->AssetDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetDescription" class="<?php echo $asset_grid->AssetDescription->headerCellClass() ?>"><div><div id="elh_asset_AssetDescription" class="asset_AssetDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->AssetDescription->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->AssetDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->AssetDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
	<?php if ($asset_grid->SortUrl($asset_grid->DateOfLastRevaluation) == "") { ?>
		<th data-name="DateOfLastRevaluation" class="<?php echo $asset_grid->DateOfLastRevaluation->headerCellClass() ?>"><div id="elh_asset_DateOfLastRevaluation" class="asset_DateOfLastRevaluation"><div class="ew-table-header-caption"><?php echo $asset_grid->DateOfLastRevaluation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfLastRevaluation" class="<?php echo $asset_grid->DateOfLastRevaluation->headerCellClass() ?>"><div><div id="elh_asset_DateOfLastRevaluation" class="asset_DateOfLastRevaluation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->DateOfLastRevaluation->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->DateOfLastRevaluation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->DateOfLastRevaluation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->NewValue->Visible) { // NewValue ?>
	<?php if ($asset_grid->SortUrl($asset_grid->NewValue) == "") { ?>
		<th data-name="NewValue" class="<?php echo $asset_grid->NewValue->headerCellClass() ?>"><div id="elh_asset_NewValue" class="asset_NewValue"><div class="ew-table-header-caption"><?php echo $asset_grid->NewValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NewValue" class="<?php echo $asset_grid->NewValue->headerCellClass() ?>"><div><div id="elh_asset_NewValue" class="asset_NewValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->NewValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->NewValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->NewValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->NameOfValuer->Visible) { // NameOfValuer ?>
	<?php if ($asset_grid->SortUrl($asset_grid->NameOfValuer) == "") { ?>
		<th data-name="NameOfValuer" class="<?php echo $asset_grid->NameOfValuer->headerCellClass() ?>"><div id="elh_asset_NameOfValuer" class="asset_NameOfValuer"><div class="ew-table-header-caption"><?php echo $asset_grid->NameOfValuer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NameOfValuer" class="<?php echo $asset_grid->NameOfValuer->headerCellClass() ?>"><div><div id="elh_asset_NameOfValuer" class="asset_NameOfValuer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->NameOfValuer->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->NameOfValuer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->NameOfValuer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->BookValue->Visible) { // BookValue ?>
	<?php if ($asset_grid->SortUrl($asset_grid->BookValue) == "") { ?>
		<th data-name="BookValue" class="<?php echo $asset_grid->BookValue->headerCellClass() ?>"><div id="elh_asset_BookValue" class="asset_BookValue"><div class="ew-table-header-caption"><?php echo $asset_grid->BookValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BookValue" class="<?php echo $asset_grid->BookValue->headerCellClass() ?>"><div><div id="elh_asset_BookValue" class="asset_BookValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->BookValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->BookValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->BookValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
	<?php if ($asset_grid->SortUrl($asset_grid->LastDepreciationDate) == "") { ?>
		<th data-name="LastDepreciationDate" class="<?php echo $asset_grid->LastDepreciationDate->headerCellClass() ?>"><div id="elh_asset_LastDepreciationDate" class="asset_LastDepreciationDate"><div class="ew-table-header-caption"><?php echo $asset_grid->LastDepreciationDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastDepreciationDate" class="<?php echo $asset_grid->LastDepreciationDate->headerCellClass() ?>"><div><div id="elh_asset_LastDepreciationDate" class="asset_LastDepreciationDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->LastDepreciationDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->LastDepreciationDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->LastDepreciationDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
	<?php if ($asset_grid->SortUrl($asset_grid->LastDepreciationAmount) == "") { ?>
		<th data-name="LastDepreciationAmount" class="<?php echo $asset_grid->LastDepreciationAmount->headerCellClass() ?>"><div id="elh_asset_LastDepreciationAmount" class="asset_LastDepreciationAmount"><div class="ew-table-header-caption"><?php echo $asset_grid->LastDepreciationAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastDepreciationAmount" class="<?php echo $asset_grid->LastDepreciationAmount->headerCellClass() ?>"><div><div id="elh_asset_LastDepreciationAmount" class="asset_LastDepreciationAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->LastDepreciationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->LastDepreciationAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->LastDepreciationAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->DepreciationRate->Visible) { // DepreciationRate ?>
	<?php if ($asset_grid->SortUrl($asset_grid->DepreciationRate) == "") { ?>
		<th data-name="DepreciationRate" class="<?php echo $asset_grid->DepreciationRate->headerCellClass() ?>"><div id="elh_asset_DepreciationRate" class="asset_DepreciationRate"><div class="ew-table-header-caption"><?php echo $asset_grid->DepreciationRate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepreciationRate" class="<?php echo $asset_grid->DepreciationRate->headerCellClass() ?>"><div><div id="elh_asset_DepreciationRate" class="asset_DepreciationRate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->DepreciationRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->DepreciationRate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->DepreciationRate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
	<?php if ($asset_grid->SortUrl($asset_grid->CumulativeDepreciation) == "") { ?>
		<th data-name="CumulativeDepreciation" class="<?php echo $asset_grid->CumulativeDepreciation->headerCellClass() ?>"><div id="elh_asset_CumulativeDepreciation" class="asset_CumulativeDepreciation"><div class="ew-table-header-caption"><?php echo $asset_grid->CumulativeDepreciation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CumulativeDepreciation" class="<?php echo $asset_grid->CumulativeDepreciation->headerCellClass() ?>"><div><div id="elh_asset_CumulativeDepreciation" class="asset_CumulativeDepreciation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->CumulativeDepreciation->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->CumulativeDepreciation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->CumulativeDepreciation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->AssetStatus->Visible) { // AssetStatus ?>
	<?php if ($asset_grid->SortUrl($asset_grid->AssetStatus) == "") { ?>
		<th data-name="AssetStatus" class="<?php echo $asset_grid->AssetStatus->headerCellClass() ?>"><div id="elh_asset_AssetStatus" class="asset_AssetStatus"><div class="ew-table-header-caption"><?php echo $asset_grid->AssetStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetStatus" class="<?php echo $asset_grid->AssetStatus->headerCellClass() ?>"><div><div id="elh_asset_AssetStatus" class="asset_AssetStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->AssetStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->AssetStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->AssetStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_grid->ScrapValue->Visible) { // ScrapValue ?>
	<?php if ($asset_grid->SortUrl($asset_grid->ScrapValue) == "") { ?>
		<th data-name="ScrapValue" class="<?php echo $asset_grid->ScrapValue->headerCellClass() ?>"><div id="elh_asset_ScrapValue" class="asset_ScrapValue"><div class="ew-table-header-caption"><?php echo $asset_grid->ScrapValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ScrapValue" class="<?php echo $asset_grid->ScrapValue->headerCellClass() ?>"><div><div id="elh_asset_ScrapValue" class="asset_ScrapValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_grid->ScrapValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_grid->ScrapValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_grid->ScrapValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$asset_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$asset_grid->StartRecord = 1;
$asset_grid->StopRecord = $asset_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($asset->isConfirm() || $asset_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($asset_grid->FormKeyCountName) && ($asset_grid->isGridAdd() || $asset_grid->isGridEdit() || $asset->isConfirm())) {
		$asset_grid->KeyCount = $CurrentForm->getValue($asset_grid->FormKeyCountName);
		$asset_grid->StopRecord = $asset_grid->StartRecord + $asset_grid->KeyCount - 1;
	}
}
$asset_grid->RecordCount = $asset_grid->StartRecord - 1;
if ($asset_grid->Recordset && !$asset_grid->Recordset->EOF) {
	$asset_grid->Recordset->moveFirst();
	$selectLimit = $asset_grid->UseSelectLimit;
	if (!$selectLimit && $asset_grid->StartRecord > 1)
		$asset_grid->Recordset->move($asset_grid->StartRecord - 1);
} elseif (!$asset->AllowAddDeleteRow && $asset_grid->StopRecord == 0) {
	$asset_grid->StopRecord = $asset->GridAddRowCount;
}

// Initialize aggregate
$asset->RowType = ROWTYPE_AGGREGATEINIT;
$asset->resetAttributes();
$asset_grid->renderRow();
if ($asset_grid->isGridAdd())
	$asset_grid->RowIndex = 0;
if ($asset_grid->isGridEdit())
	$asset_grid->RowIndex = 0;
while ($asset_grid->RecordCount < $asset_grid->StopRecord) {
	$asset_grid->RecordCount++;
	if ($asset_grid->RecordCount >= $asset_grid->StartRecord) {
		$asset_grid->RowCount++;
		if ($asset_grid->isGridAdd() || $asset_grid->isGridEdit() || $asset->isConfirm()) {
			$asset_grid->RowIndex++;
			$CurrentForm->Index = $asset_grid->RowIndex;
			if ($CurrentForm->hasValue($asset_grid->FormActionName) && ($asset->isConfirm() || $asset_grid->EventCancelled))
				$asset_grid->RowAction = strval($CurrentForm->getValue($asset_grid->FormActionName));
			elseif ($asset_grid->isGridAdd())
				$asset_grid->RowAction = "insert";
			else
				$asset_grid->RowAction = "";
		}

		// Set up key count
		$asset_grid->KeyCount = $asset_grid->RowIndex;

		// Init row class and style
		$asset->resetAttributes();
		$asset->CssClass = "";
		if ($asset_grid->isGridAdd()) {
			if ($asset->CurrentMode == "copy") {
				$asset_grid->loadRowValues($asset_grid->Recordset); // Load row values
				$asset_grid->setRecordKey($asset_grid->RowOldKey, $asset_grid->Recordset); // Set old record key
			} else {
				$asset_grid->loadRowValues(); // Load default values
				$asset_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$asset_grid->loadRowValues($asset_grid->Recordset); // Load row values
		}
		$asset->RowType = ROWTYPE_VIEW; // Render view
		if ($asset_grid->isGridAdd()) // Grid add
			$asset->RowType = ROWTYPE_ADD; // Render add
		if ($asset_grid->isGridAdd() && $asset->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$asset_grid->restoreCurrentRowFormValues($asset_grid->RowIndex); // Restore form values
		if ($asset_grid->isGridEdit()) { // Grid edit
			if ($asset->EventCancelled)
				$asset_grid->restoreCurrentRowFormValues($asset_grid->RowIndex); // Restore form values
			if ($asset_grid->RowAction == "insert")
				$asset->RowType = ROWTYPE_ADD; // Render add
			else
				$asset->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($asset_grid->isGridEdit() && ($asset->RowType == ROWTYPE_EDIT || $asset->RowType == ROWTYPE_ADD) && $asset->EventCancelled) // Update failed
			$asset_grid->restoreCurrentRowFormValues($asset_grid->RowIndex); // Restore form values
		if ($asset->RowType == ROWTYPE_EDIT) // Edit row
			$asset_grid->EditRowCount++;
		if ($asset->isConfirm()) // Confirm row
			$asset_grid->restoreCurrentRowFormValues($asset_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$asset->RowAttrs->merge(["data-rowindex" => $asset_grid->RowCount, "id" => "r" . $asset_grid->RowCount . "_asset", "data-rowtype" => $asset->RowType]);

		// Render row
		$asset_grid->renderRow();

		// Render list options
		$asset_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($asset_grid->RowAction != "delete" && $asset_grid->RowAction != "insertdelete" && !($asset_grid->RowAction == "insert" && $asset->isConfirm() && $asset_grid->emptyRow())) {
?>
	<tr <?php echo $asset->rowAttributes() ?>>
<?php

// Render list options (body, left)
$asset_grid->ListOptions->render("body", "left", $asset_grid->RowCount);
?>
	<?php if ($asset_grid->AssetCode->Visible) { // AssetCode ?>
		<td data-name="AssetCode" <?php echo $asset_grid->AssetCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetCode" class="form-group">
<input type="text" data-table="asset" data-field="x_AssetCode" name="x<?php echo $asset_grid->RowIndex ?>_AssetCode" id="x<?php echo $asset_grid->RowIndex ?>_AssetCode" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_grid->AssetCode->getPlaceHolder()) ?>" value="<?php echo $asset_grid->AssetCode->EditValue ?>"<?php echo $asset_grid->AssetCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetCode" name="o<?php echo $asset_grid->RowIndex ?>_AssetCode" id="o<?php echo $asset_grid->RowIndex ?>_AssetCode" value="<?php echo HtmlEncode($asset_grid->AssetCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="asset" data-field="x_AssetCode" name="x<?php echo $asset_grid->RowIndex ?>_AssetCode" id="x<?php echo $asset_grid->RowIndex ?>_AssetCode" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_grid->AssetCode->getPlaceHolder()) ?>" value="<?php echo $asset_grid->AssetCode->EditValue ?>"<?php echo $asset_grid->AssetCode->editAttributes() ?>>
<input type="hidden" data-table="asset" data-field="x_AssetCode" name="o<?php echo $asset_grid->RowIndex ?>_AssetCode" id="o<?php echo $asset_grid->RowIndex ?>_AssetCode" value="<?php echo HtmlEncode($asset_grid->AssetCode->OldValue != null ? $asset_grid->AssetCode->OldValue : $asset_grid->AssetCode->CurrentValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetCode">
<span<?php echo $asset_grid->AssetCode->viewAttributes() ?>><?php echo $asset_grid->AssetCode->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_AssetCode" name="x<?php echo $asset_grid->RowIndex ?>_AssetCode" id="x<?php echo $asset_grid->RowIndex ?>_AssetCode" value="<?php echo HtmlEncode($asset_grid->AssetCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_AssetCode" name="o<?php echo $asset_grid->RowIndex ?>_AssetCode" id="o<?php echo $asset_grid->RowIndex ?>_AssetCode" value="<?php echo HtmlEncode($asset_grid->AssetCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_AssetCode" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_AssetCode" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_AssetCode" value="<?php echo HtmlEncode($asset_grid->AssetCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_AssetCode" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_AssetCode" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_AssetCode" value="<?php echo HtmlEncode($asset_grid->AssetCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $asset_grid->ProvinceCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($asset_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_ProvinceCode" class="form-group">
<span<?php echo $asset_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_ProvinceCode" class="form-group">
<?php
$onchange = $asset_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$asset_grid->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $asset_grid->RowIndex ?>_ProvinceCode">
	<input type="text" class="form-control" name="sv_x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="sv_x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo RemoveHtml($asset_grid->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($asset_grid->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($asset_grid->ProvinceCode->getPlaceHolder()) ?>"<?php echo $asset_grid->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" data-value-separator="<?php echo $asset_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassetgrid"], function() {
	fassetgrid.createAutoSuggest({"id":"x<?php echo $asset_grid->RowIndex ?>_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $asset_grid->ProvinceCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" name="o<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($asset_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_ProvinceCode" class="form-group">
<span<?php echo $asset_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_ProvinceCode" class="form-group">
<?php
$onchange = $asset_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$asset_grid->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $asset_grid->RowIndex ?>_ProvinceCode">
	<input type="text" class="form-control" name="sv_x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="sv_x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo RemoveHtml($asset_grid->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($asset_grid->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($asset_grid->ProvinceCode->getPlaceHolder()) ?>"<?php echo $asset_grid->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" data-value-separator="<?php echo $asset_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassetgrid"], function() {
	fassetgrid.createAutoSuggest({"id":"x<?php echo $asset_grid->RowIndex ?>_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $asset_grid->ProvinceCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_ProvinceCode">
<span<?php echo $asset_grid->ProvinceCode->viewAttributes() ?>><?php echo $asset_grid->ProvinceCode->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" name="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" name="o<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $asset_grid->LACode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($asset_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_LACode" class="form-group">
<span<?php echo $asset_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $asset_grid->RowIndex ?>_LACode" name="x<?php echo $asset_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_LACode" class="form-group">
<?php $asset_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_LACode" data-value-separator="<?php echo $asset_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_LACode" name="x<?php echo $asset_grid->RowIndex ?>_LACode"<?php echo $asset_grid->LACode->editAttributes() ?>>
			<?php echo $asset_grid->LACode->selectOptionListHtml("x{$asset_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $asset_grid->LACode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_LACode" name="o<?php echo $asset_grid->RowIndex ?>_LACode" id="o<?php echo $asset_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_grid->LACode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($asset_grid->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_LACode" class="form-group">
<span<?php echo $asset_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $asset_grid->RowIndex ?>_LACode" name="x<?php echo $asset_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_LACode" class="form-group">
<?php $asset_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_LACode" data-value-separator="<?php echo $asset_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_LACode" name="x<?php echo $asset_grid->RowIndex ?>_LACode"<?php echo $asset_grid->LACode->editAttributes() ?>>
			<?php echo $asset_grid->LACode->selectOptionListHtml("x{$asset_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $asset_grid->LACode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_LACode">
<span<?php echo $asset_grid->LACode->viewAttributes() ?>><?php echo $asset_grid->LACode->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_LACode" name="x<?php echo $asset_grid->RowIndex ?>_LACode" id="x<?php echo $asset_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_LACode" name="o<?php echo $asset_grid->RowIndex ?>_LACode" id="o<?php echo $asset_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_grid->LACode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_LACode" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_LACode" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_grid->LACode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_LACode" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_LACode" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_grid->LACode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $asset_grid->DepartmentCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_DepartmentCode" class="form-group">
<?php $asset_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_DepartmentCode" data-value-separator="<?php echo $asset_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $asset_grid->RowIndex ?>_DepartmentCode"<?php echo $asset_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $asset_grid->DepartmentCode->selectOptionListHtml("x{$asset_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $asset_grid->DepartmentCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_DepartmentCode" name="o<?php echo $asset_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $asset_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($asset_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_DepartmentCode" class="form-group">
<?php $asset_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_DepartmentCode" data-value-separator="<?php echo $asset_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $asset_grid->RowIndex ?>_DepartmentCode"<?php echo $asset_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $asset_grid->DepartmentCode->selectOptionListHtml("x{$asset_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $asset_grid->DepartmentCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_DepartmentCode">
<span<?php echo $asset_grid->DepartmentCode->viewAttributes() ?>><?php echo $asset_grid->DepartmentCode->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_DepartmentCode" name="x<?php echo $asset_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $asset_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($asset_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_DepartmentCode" name="o<?php echo $asset_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $asset_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($asset_grid->DepartmentCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_DepartmentCode" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_DepartmentCode" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($asset_grid->DepartmentCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_DepartmentCode" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_DepartmentCode" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($asset_grid->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $asset_grid->SectionCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_SectionCode" data-value-separator="<?php echo $asset_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_SectionCode" name="x<?php echo $asset_grid->RowIndex ?>_SectionCode"<?php echo $asset_grid->SectionCode->editAttributes() ?>>
			<?php echo $asset_grid->SectionCode->selectOptionListHtml("x{$asset_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $asset_grid->SectionCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_SectionCode" name="o<?php echo $asset_grid->RowIndex ?>_SectionCode" id="o<?php echo $asset_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($asset_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_SectionCode" data-value-separator="<?php echo $asset_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_SectionCode" name="x<?php echo $asset_grid->RowIndex ?>_SectionCode"<?php echo $asset_grid->SectionCode->editAttributes() ?>>
			<?php echo $asset_grid->SectionCode->selectOptionListHtml("x{$asset_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $asset_grid->SectionCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_SectionCode">
<span<?php echo $asset_grid->SectionCode->viewAttributes() ?>><?php echo $asset_grid->SectionCode->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_SectionCode" name="x<?php echo $asset_grid->RowIndex ?>_SectionCode" id="x<?php echo $asset_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($asset_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_SectionCode" name="o<?php echo $asset_grid->RowIndex ?>_SectionCode" id="o<?php echo $asset_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($asset_grid->SectionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_SectionCode" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_SectionCode" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($asset_grid->SectionCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_SectionCode" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_SectionCode" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($asset_grid->SectionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->AssetTypeCode->Visible) { // AssetTypeCode ?>
		<td data-name="AssetTypeCode" <?php echo $asset_grid->AssetTypeCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetTypeCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetTypeCode" data-value-separator="<?php echo $asset_grid->AssetTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" name="x<?php echo $asset_grid->RowIndex ?>_AssetTypeCode"<?php echo $asset_grid->AssetTypeCode->editAttributes() ?>>
			<?php echo $asset_grid->AssetTypeCode->selectOptionListHtml("x{$asset_grid->RowIndex}_AssetTypeCode") ?>
		</select>
</div>
<?php echo $asset_grid->AssetTypeCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_AssetTypeCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetTypeCode" name="o<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" id="o<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" value="<?php echo HtmlEncode($asset_grid->AssetTypeCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetTypeCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetTypeCode" data-value-separator="<?php echo $asset_grid->AssetTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" name="x<?php echo $asset_grid->RowIndex ?>_AssetTypeCode"<?php echo $asset_grid->AssetTypeCode->editAttributes() ?>>
			<?php echo $asset_grid->AssetTypeCode->selectOptionListHtml("x{$asset_grid->RowIndex}_AssetTypeCode") ?>
		</select>
</div>
<?php echo $asset_grid->AssetTypeCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_AssetTypeCode") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetTypeCode">
<span<?php echo $asset_grid->AssetTypeCode->viewAttributes() ?>><?php echo $asset_grid->AssetTypeCode->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_AssetTypeCode" name="x<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" id="x<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" value="<?php echo HtmlEncode($asset_grid->AssetTypeCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_AssetTypeCode" name="o<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" id="o<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" value="<?php echo HtmlEncode($asset_grid->AssetTypeCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_AssetTypeCode" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" value="<?php echo HtmlEncode($asset_grid->AssetTypeCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_AssetTypeCode" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" value="<?php echo HtmlEncode($asset_grid->AssetTypeCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->Supplier->Visible) { // Supplier ?>
		<td data-name="Supplier" <?php echo $asset_grid->Supplier->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_Supplier" class="form-group">
<input type="text" data-table="asset" data-field="x_Supplier" name="x<?php echo $asset_grid->RowIndex ?>_Supplier" id="x<?php echo $asset_grid->RowIndex ?>_Supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($asset_grid->Supplier->getPlaceHolder()) ?>" value="<?php echo $asset_grid->Supplier->EditValue ?>"<?php echo $asset_grid->Supplier->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_Supplier" name="o<?php echo $asset_grid->RowIndex ?>_Supplier" id="o<?php echo $asset_grid->RowIndex ?>_Supplier" value="<?php echo HtmlEncode($asset_grid->Supplier->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_Supplier" class="form-group">
<input type="text" data-table="asset" data-field="x_Supplier" name="x<?php echo $asset_grid->RowIndex ?>_Supplier" id="x<?php echo $asset_grid->RowIndex ?>_Supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($asset_grid->Supplier->getPlaceHolder()) ?>" value="<?php echo $asset_grid->Supplier->EditValue ?>"<?php echo $asset_grid->Supplier->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_Supplier">
<span<?php echo $asset_grid->Supplier->viewAttributes() ?>><?php echo $asset_grid->Supplier->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_Supplier" name="x<?php echo $asset_grid->RowIndex ?>_Supplier" id="x<?php echo $asset_grid->RowIndex ?>_Supplier" value="<?php echo HtmlEncode($asset_grid->Supplier->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_Supplier" name="o<?php echo $asset_grid->RowIndex ?>_Supplier" id="o<?php echo $asset_grid->RowIndex ?>_Supplier" value="<?php echo HtmlEncode($asset_grid->Supplier->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_Supplier" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_Supplier" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_Supplier" value="<?php echo HtmlEncode($asset_grid->Supplier->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_Supplier" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_Supplier" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_Supplier" value="<?php echo HtmlEncode($asset_grid->Supplier->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->PurchasePrice->Visible) { // PurchasePrice ?>
		<td data-name="PurchasePrice" <?php echo $asset_grid->PurchasePrice->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_PurchasePrice" class="form-group">
<input type="text" data-table="asset" data-field="x_PurchasePrice" name="x<?php echo $asset_grid->RowIndex ?>_PurchasePrice" id="x<?php echo $asset_grid->RowIndex ?>_PurchasePrice" size="30" placeholder="<?php echo HtmlEncode($asset_grid->PurchasePrice->getPlaceHolder()) ?>" value="<?php echo $asset_grid->PurchasePrice->EditValue ?>"<?php echo $asset_grid->PurchasePrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_PurchasePrice" name="o<?php echo $asset_grid->RowIndex ?>_PurchasePrice" id="o<?php echo $asset_grid->RowIndex ?>_PurchasePrice" value="<?php echo HtmlEncode($asset_grid->PurchasePrice->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_PurchasePrice" class="form-group">
<input type="text" data-table="asset" data-field="x_PurchasePrice" name="x<?php echo $asset_grid->RowIndex ?>_PurchasePrice" id="x<?php echo $asset_grid->RowIndex ?>_PurchasePrice" size="30" placeholder="<?php echo HtmlEncode($asset_grid->PurchasePrice->getPlaceHolder()) ?>" value="<?php echo $asset_grid->PurchasePrice->EditValue ?>"<?php echo $asset_grid->PurchasePrice->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_PurchasePrice">
<span<?php echo $asset_grid->PurchasePrice->viewAttributes() ?>><?php echo $asset_grid->PurchasePrice->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_PurchasePrice" name="x<?php echo $asset_grid->RowIndex ?>_PurchasePrice" id="x<?php echo $asset_grid->RowIndex ?>_PurchasePrice" value="<?php echo HtmlEncode($asset_grid->PurchasePrice->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_PurchasePrice" name="o<?php echo $asset_grid->RowIndex ?>_PurchasePrice" id="o<?php echo $asset_grid->RowIndex ?>_PurchasePrice" value="<?php echo HtmlEncode($asset_grid->PurchasePrice->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_PurchasePrice" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_PurchasePrice" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_PurchasePrice" value="<?php echo HtmlEncode($asset_grid->PurchasePrice->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_PurchasePrice" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_PurchasePrice" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_PurchasePrice" value="<?php echo HtmlEncode($asset_grid->PurchasePrice->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->CurrencyCode->Visible) { // CurrencyCode ?>
		<td data-name="CurrencyCode" <?php echo $asset_grid->CurrencyCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_CurrencyCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_CurrencyCode" data-value-separator="<?php echo $asset_grid->CurrencyCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_CurrencyCode" name="x<?php echo $asset_grid->RowIndex ?>_CurrencyCode"<?php echo $asset_grid->CurrencyCode->editAttributes() ?>>
			<?php echo $asset_grid->CurrencyCode->selectOptionListHtml("x{$asset_grid->RowIndex}_CurrencyCode") ?>
		</select>
</div>
<?php echo $asset_grid->CurrencyCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_CurrencyCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_CurrencyCode" name="o<?php echo $asset_grid->RowIndex ?>_CurrencyCode" id="o<?php echo $asset_grid->RowIndex ?>_CurrencyCode" value="<?php echo HtmlEncode($asset_grid->CurrencyCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_CurrencyCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_CurrencyCode" data-value-separator="<?php echo $asset_grid->CurrencyCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_CurrencyCode" name="x<?php echo $asset_grid->RowIndex ?>_CurrencyCode"<?php echo $asset_grid->CurrencyCode->editAttributes() ?>>
			<?php echo $asset_grid->CurrencyCode->selectOptionListHtml("x{$asset_grid->RowIndex}_CurrencyCode") ?>
		</select>
</div>
<?php echo $asset_grid->CurrencyCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_CurrencyCode") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_CurrencyCode">
<span<?php echo $asset_grid->CurrencyCode->viewAttributes() ?>><?php echo $asset_grid->CurrencyCode->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_CurrencyCode" name="x<?php echo $asset_grid->RowIndex ?>_CurrencyCode" id="x<?php echo $asset_grid->RowIndex ?>_CurrencyCode" value="<?php echo HtmlEncode($asset_grid->CurrencyCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_CurrencyCode" name="o<?php echo $asset_grid->RowIndex ?>_CurrencyCode" id="o<?php echo $asset_grid->RowIndex ?>_CurrencyCode" value="<?php echo HtmlEncode($asset_grid->CurrencyCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_CurrencyCode" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_CurrencyCode" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_CurrencyCode" value="<?php echo HtmlEncode($asset_grid->CurrencyCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_CurrencyCode" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_CurrencyCode" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_CurrencyCode" value="<?php echo HtmlEncode($asset_grid->CurrencyCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->ConditionCode->Visible) { // ConditionCode ?>
		<td data-name="ConditionCode" <?php echo $asset_grid->ConditionCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_ConditionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_ConditionCode" data-value-separator="<?php echo $asset_grid->ConditionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_ConditionCode" name="x<?php echo $asset_grid->RowIndex ?>_ConditionCode"<?php echo $asset_grid->ConditionCode->editAttributes() ?>>
			<?php echo $asset_grid->ConditionCode->selectOptionListHtml("x{$asset_grid->RowIndex}_ConditionCode") ?>
		</select>
</div>
<?php echo $asset_grid->ConditionCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_ConditionCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_ConditionCode" name="o<?php echo $asset_grid->RowIndex ?>_ConditionCode" id="o<?php echo $asset_grid->RowIndex ?>_ConditionCode" value="<?php echo HtmlEncode($asset_grid->ConditionCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_ConditionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_ConditionCode" data-value-separator="<?php echo $asset_grid->ConditionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_ConditionCode" name="x<?php echo $asset_grid->RowIndex ?>_ConditionCode"<?php echo $asset_grid->ConditionCode->editAttributes() ?>>
			<?php echo $asset_grid->ConditionCode->selectOptionListHtml("x{$asset_grid->RowIndex}_ConditionCode") ?>
		</select>
</div>
<?php echo $asset_grid->ConditionCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_ConditionCode") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_ConditionCode">
<span<?php echo $asset_grid->ConditionCode->viewAttributes() ?>><?php echo $asset_grid->ConditionCode->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_ConditionCode" name="x<?php echo $asset_grid->RowIndex ?>_ConditionCode" id="x<?php echo $asset_grid->RowIndex ?>_ConditionCode" value="<?php echo HtmlEncode($asset_grid->ConditionCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_ConditionCode" name="o<?php echo $asset_grid->RowIndex ?>_ConditionCode" id="o<?php echo $asset_grid->RowIndex ?>_ConditionCode" value="<?php echo HtmlEncode($asset_grid->ConditionCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_ConditionCode" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_ConditionCode" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_ConditionCode" value="<?php echo HtmlEncode($asset_grid->ConditionCode->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_ConditionCode" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_ConditionCode" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_ConditionCode" value="<?php echo HtmlEncode($asset_grid->ConditionCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->DateOfPurchase->Visible) { // DateOfPurchase ?>
		<td data-name="DateOfPurchase" <?php echo $asset_grid->DateOfPurchase->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_DateOfPurchase" class="form-group">
<input type="text" data-table="asset" data-field="x_DateOfPurchase" name="x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" id="x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" placeholder="<?php echo HtmlEncode($asset_grid->DateOfPurchase->getPlaceHolder()) ?>" value="<?php echo $asset_grid->DateOfPurchase->EditValue ?>"<?php echo $asset_grid->DateOfPurchase->editAttributes() ?>>
<?php if (!$asset_grid->DateOfPurchase->ReadOnly && !$asset_grid->DateOfPurchase->Disabled && !isset($asset_grid->DateOfPurchase->EditAttrs["readonly"]) && !isset($asset_grid->DateOfPurchase->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetgrid", "x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="asset" data-field="x_DateOfPurchase" name="o<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" id="o<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" value="<?php echo HtmlEncode($asset_grid->DateOfPurchase->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_DateOfPurchase" class="form-group">
<input type="text" data-table="asset" data-field="x_DateOfPurchase" name="x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" id="x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" placeholder="<?php echo HtmlEncode($asset_grid->DateOfPurchase->getPlaceHolder()) ?>" value="<?php echo $asset_grid->DateOfPurchase->EditValue ?>"<?php echo $asset_grid->DateOfPurchase->editAttributes() ?>>
<?php if (!$asset_grid->DateOfPurchase->ReadOnly && !$asset_grid->DateOfPurchase->Disabled && !isset($asset_grid->DateOfPurchase->EditAttrs["readonly"]) && !isset($asset_grid->DateOfPurchase->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetgrid", "x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_DateOfPurchase">
<span<?php echo $asset_grid->DateOfPurchase->viewAttributes() ?>><?php echo $asset_grid->DateOfPurchase->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_DateOfPurchase" name="x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" id="x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" value="<?php echo HtmlEncode($asset_grid->DateOfPurchase->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_DateOfPurchase" name="o<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" id="o<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" value="<?php echo HtmlEncode($asset_grid->DateOfPurchase->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_DateOfPurchase" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" value="<?php echo HtmlEncode($asset_grid->DateOfPurchase->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_DateOfPurchase" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" value="<?php echo HtmlEncode($asset_grid->DateOfPurchase->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->AssetCapacity->Visible) { // AssetCapacity ?>
		<td data-name="AssetCapacity" <?php echo $asset_grid->AssetCapacity->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetCapacity" class="form-group">
<input type="text" data-table="asset" data-field="x_AssetCapacity" name="x<?php echo $asset_grid->RowIndex ?>_AssetCapacity" id="x<?php echo $asset_grid->RowIndex ?>_AssetCapacity" size="30" placeholder="<?php echo HtmlEncode($asset_grid->AssetCapacity->getPlaceHolder()) ?>" value="<?php echo $asset_grid->AssetCapacity->EditValue ?>"<?php echo $asset_grid->AssetCapacity->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetCapacity" name="o<?php echo $asset_grid->RowIndex ?>_AssetCapacity" id="o<?php echo $asset_grid->RowIndex ?>_AssetCapacity" value="<?php echo HtmlEncode($asset_grid->AssetCapacity->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetCapacity" class="form-group">
<input type="text" data-table="asset" data-field="x_AssetCapacity" name="x<?php echo $asset_grid->RowIndex ?>_AssetCapacity" id="x<?php echo $asset_grid->RowIndex ?>_AssetCapacity" size="30" placeholder="<?php echo HtmlEncode($asset_grid->AssetCapacity->getPlaceHolder()) ?>" value="<?php echo $asset_grid->AssetCapacity->EditValue ?>"<?php echo $asset_grid->AssetCapacity->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetCapacity">
<span<?php echo $asset_grid->AssetCapacity->viewAttributes() ?>><?php echo $asset_grid->AssetCapacity->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_AssetCapacity" name="x<?php echo $asset_grid->RowIndex ?>_AssetCapacity" id="x<?php echo $asset_grid->RowIndex ?>_AssetCapacity" value="<?php echo HtmlEncode($asset_grid->AssetCapacity->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_AssetCapacity" name="o<?php echo $asset_grid->RowIndex ?>_AssetCapacity" id="o<?php echo $asset_grid->RowIndex ?>_AssetCapacity" value="<?php echo HtmlEncode($asset_grid->AssetCapacity->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_AssetCapacity" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_AssetCapacity" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_AssetCapacity" value="<?php echo HtmlEncode($asset_grid->AssetCapacity->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_AssetCapacity" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_AssetCapacity" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_AssetCapacity" value="<?php echo HtmlEncode($asset_grid->AssetCapacity->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $asset_grid->UnitOfMeasure->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_UnitOfMeasure" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $asset_grid->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" name="x<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure"<?php echo $asset_grid->UnitOfMeasure->editAttributes() ?>>
			<?php echo $asset_grid->UnitOfMeasure->selectOptionListHtml("x{$asset_grid->RowIndex}_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $asset_grid->UnitOfMeasure->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_UnitOfMeasure") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_UnitOfMeasure" name="o<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($asset_grid->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_UnitOfMeasure" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $asset_grid->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" name="x<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure"<?php echo $asset_grid->UnitOfMeasure->editAttributes() ?>>
			<?php echo $asset_grid->UnitOfMeasure->selectOptionListHtml("x{$asset_grid->RowIndex}_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $asset_grid->UnitOfMeasure->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_UnitOfMeasure") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_UnitOfMeasure">
<span<?php echo $asset_grid->UnitOfMeasure->viewAttributes() ?>><?php echo $asset_grid->UnitOfMeasure->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_UnitOfMeasure" name="x<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($asset_grid->UnitOfMeasure->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_UnitOfMeasure" name="o<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($asset_grid->UnitOfMeasure->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_UnitOfMeasure" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($asset_grid->UnitOfMeasure->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_UnitOfMeasure" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($asset_grid->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->AssetDescription->Visible) { // AssetDescription ?>
		<td data-name="AssetDescription" <?php echo $asset_grid->AssetDescription->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetDescription" class="form-group">
<input type="text" data-table="asset" data-field="x_AssetDescription" name="x<?php echo $asset_grid->RowIndex ?>_AssetDescription" id="x<?php echo $asset_grid->RowIndex ?>_AssetDescription" size="50" maxlength="60" placeholder="<?php echo HtmlEncode($asset_grid->AssetDescription->getPlaceHolder()) ?>" value="<?php echo $asset_grid->AssetDescription->EditValue ?>"<?php echo $asset_grid->AssetDescription->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetDescription" name="o<?php echo $asset_grid->RowIndex ?>_AssetDescription" id="o<?php echo $asset_grid->RowIndex ?>_AssetDescription" value="<?php echo HtmlEncode($asset_grid->AssetDescription->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetDescription" class="form-group">
<input type="text" data-table="asset" data-field="x_AssetDescription" name="x<?php echo $asset_grid->RowIndex ?>_AssetDescription" id="x<?php echo $asset_grid->RowIndex ?>_AssetDescription" size="50" maxlength="60" placeholder="<?php echo HtmlEncode($asset_grid->AssetDescription->getPlaceHolder()) ?>" value="<?php echo $asset_grid->AssetDescription->EditValue ?>"<?php echo $asset_grid->AssetDescription->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetDescription">
<span<?php echo $asset_grid->AssetDescription->viewAttributes() ?>><?php echo $asset_grid->AssetDescription->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_AssetDescription" name="x<?php echo $asset_grid->RowIndex ?>_AssetDescription" id="x<?php echo $asset_grid->RowIndex ?>_AssetDescription" value="<?php echo HtmlEncode($asset_grid->AssetDescription->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_AssetDescription" name="o<?php echo $asset_grid->RowIndex ?>_AssetDescription" id="o<?php echo $asset_grid->RowIndex ?>_AssetDescription" value="<?php echo HtmlEncode($asset_grid->AssetDescription->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_AssetDescription" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_AssetDescription" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_AssetDescription" value="<?php echo HtmlEncode($asset_grid->AssetDescription->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_AssetDescription" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_AssetDescription" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_AssetDescription" value="<?php echo HtmlEncode($asset_grid->AssetDescription->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
		<td data-name="DateOfLastRevaluation" <?php echo $asset_grid->DateOfLastRevaluation->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_DateOfLastRevaluation" class="form-group">
<input type="text" data-table="asset" data-field="x_DateOfLastRevaluation" name="x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" id="x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" placeholder="<?php echo HtmlEncode($asset_grid->DateOfLastRevaluation->getPlaceHolder()) ?>" value="<?php echo $asset_grid->DateOfLastRevaluation->EditValue ?>"<?php echo $asset_grid->DateOfLastRevaluation->editAttributes() ?>>
<?php if (!$asset_grid->DateOfLastRevaluation->ReadOnly && !$asset_grid->DateOfLastRevaluation->Disabled && !isset($asset_grid->DateOfLastRevaluation->EditAttrs["readonly"]) && !isset($asset_grid->DateOfLastRevaluation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetgrid", "x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="asset" data-field="x_DateOfLastRevaluation" name="o<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" id="o<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" value="<?php echo HtmlEncode($asset_grid->DateOfLastRevaluation->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_DateOfLastRevaluation" class="form-group">
<input type="text" data-table="asset" data-field="x_DateOfLastRevaluation" name="x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" id="x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" placeholder="<?php echo HtmlEncode($asset_grid->DateOfLastRevaluation->getPlaceHolder()) ?>" value="<?php echo $asset_grid->DateOfLastRevaluation->EditValue ?>"<?php echo $asset_grid->DateOfLastRevaluation->editAttributes() ?>>
<?php if (!$asset_grid->DateOfLastRevaluation->ReadOnly && !$asset_grid->DateOfLastRevaluation->Disabled && !isset($asset_grid->DateOfLastRevaluation->EditAttrs["readonly"]) && !isset($asset_grid->DateOfLastRevaluation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetgrid", "x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_DateOfLastRevaluation">
<span<?php echo $asset_grid->DateOfLastRevaluation->viewAttributes() ?>><?php echo $asset_grid->DateOfLastRevaluation->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_DateOfLastRevaluation" name="x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" id="x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" value="<?php echo HtmlEncode($asset_grid->DateOfLastRevaluation->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_DateOfLastRevaluation" name="o<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" id="o<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" value="<?php echo HtmlEncode($asset_grid->DateOfLastRevaluation->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_DateOfLastRevaluation" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" value="<?php echo HtmlEncode($asset_grid->DateOfLastRevaluation->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_DateOfLastRevaluation" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" value="<?php echo HtmlEncode($asset_grid->DateOfLastRevaluation->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->NewValue->Visible) { // NewValue ?>
		<td data-name="NewValue" <?php echo $asset_grid->NewValue->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_NewValue" class="form-group">
<input type="text" data-table="asset" data-field="x_NewValue" name="x<?php echo $asset_grid->RowIndex ?>_NewValue" id="x<?php echo $asset_grid->RowIndex ?>_NewValue" size="30" placeholder="<?php echo HtmlEncode($asset_grid->NewValue->getPlaceHolder()) ?>" value="<?php echo $asset_grid->NewValue->EditValue ?>"<?php echo $asset_grid->NewValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_NewValue" name="o<?php echo $asset_grid->RowIndex ?>_NewValue" id="o<?php echo $asset_grid->RowIndex ?>_NewValue" value="<?php echo HtmlEncode($asset_grid->NewValue->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_NewValue" class="form-group">
<input type="text" data-table="asset" data-field="x_NewValue" name="x<?php echo $asset_grid->RowIndex ?>_NewValue" id="x<?php echo $asset_grid->RowIndex ?>_NewValue" size="30" placeholder="<?php echo HtmlEncode($asset_grid->NewValue->getPlaceHolder()) ?>" value="<?php echo $asset_grid->NewValue->EditValue ?>"<?php echo $asset_grid->NewValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_NewValue">
<span<?php echo $asset_grid->NewValue->viewAttributes() ?>><?php echo $asset_grid->NewValue->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_NewValue" name="x<?php echo $asset_grid->RowIndex ?>_NewValue" id="x<?php echo $asset_grid->RowIndex ?>_NewValue" value="<?php echo HtmlEncode($asset_grid->NewValue->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_NewValue" name="o<?php echo $asset_grid->RowIndex ?>_NewValue" id="o<?php echo $asset_grid->RowIndex ?>_NewValue" value="<?php echo HtmlEncode($asset_grid->NewValue->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_NewValue" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_NewValue" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_NewValue" value="<?php echo HtmlEncode($asset_grid->NewValue->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_NewValue" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_NewValue" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_NewValue" value="<?php echo HtmlEncode($asset_grid->NewValue->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->NameOfValuer->Visible) { // NameOfValuer ?>
		<td data-name="NameOfValuer" <?php echo $asset_grid->NameOfValuer->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_NameOfValuer" class="form-group">
<input type="text" data-table="asset" data-field="x_NameOfValuer" name="x<?php echo $asset_grid->RowIndex ?>_NameOfValuer" id="x<?php echo $asset_grid->RowIndex ?>_NameOfValuer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($asset_grid->NameOfValuer->getPlaceHolder()) ?>" value="<?php echo $asset_grid->NameOfValuer->EditValue ?>"<?php echo $asset_grid->NameOfValuer->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_NameOfValuer" name="o<?php echo $asset_grid->RowIndex ?>_NameOfValuer" id="o<?php echo $asset_grid->RowIndex ?>_NameOfValuer" value="<?php echo HtmlEncode($asset_grid->NameOfValuer->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_NameOfValuer" class="form-group">
<input type="text" data-table="asset" data-field="x_NameOfValuer" name="x<?php echo $asset_grid->RowIndex ?>_NameOfValuer" id="x<?php echo $asset_grid->RowIndex ?>_NameOfValuer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($asset_grid->NameOfValuer->getPlaceHolder()) ?>" value="<?php echo $asset_grid->NameOfValuer->EditValue ?>"<?php echo $asset_grid->NameOfValuer->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_NameOfValuer">
<span<?php echo $asset_grid->NameOfValuer->viewAttributes() ?>><?php echo $asset_grid->NameOfValuer->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_NameOfValuer" name="x<?php echo $asset_grid->RowIndex ?>_NameOfValuer" id="x<?php echo $asset_grid->RowIndex ?>_NameOfValuer" value="<?php echo HtmlEncode($asset_grid->NameOfValuer->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_NameOfValuer" name="o<?php echo $asset_grid->RowIndex ?>_NameOfValuer" id="o<?php echo $asset_grid->RowIndex ?>_NameOfValuer" value="<?php echo HtmlEncode($asset_grid->NameOfValuer->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_NameOfValuer" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_NameOfValuer" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_NameOfValuer" value="<?php echo HtmlEncode($asset_grid->NameOfValuer->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_NameOfValuer" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_NameOfValuer" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_NameOfValuer" value="<?php echo HtmlEncode($asset_grid->NameOfValuer->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->BookValue->Visible) { // BookValue ?>
		<td data-name="BookValue" <?php echo $asset_grid->BookValue->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_BookValue" class="form-group">
<input type="text" data-table="asset" data-field="x_BookValue" name="x<?php echo $asset_grid->RowIndex ?>_BookValue" id="x<?php echo $asset_grid->RowIndex ?>_BookValue" size="30" placeholder="<?php echo HtmlEncode($asset_grid->BookValue->getPlaceHolder()) ?>" value="<?php echo $asset_grid->BookValue->EditValue ?>"<?php echo $asset_grid->BookValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_BookValue" name="o<?php echo $asset_grid->RowIndex ?>_BookValue" id="o<?php echo $asset_grid->RowIndex ?>_BookValue" value="<?php echo HtmlEncode($asset_grid->BookValue->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_BookValue" class="form-group">
<input type="text" data-table="asset" data-field="x_BookValue" name="x<?php echo $asset_grid->RowIndex ?>_BookValue" id="x<?php echo $asset_grid->RowIndex ?>_BookValue" size="30" placeholder="<?php echo HtmlEncode($asset_grid->BookValue->getPlaceHolder()) ?>" value="<?php echo $asset_grid->BookValue->EditValue ?>"<?php echo $asset_grid->BookValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_BookValue">
<span<?php echo $asset_grid->BookValue->viewAttributes() ?>><?php echo $asset_grid->BookValue->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_BookValue" name="x<?php echo $asset_grid->RowIndex ?>_BookValue" id="x<?php echo $asset_grid->RowIndex ?>_BookValue" value="<?php echo HtmlEncode($asset_grid->BookValue->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_BookValue" name="o<?php echo $asset_grid->RowIndex ?>_BookValue" id="o<?php echo $asset_grid->RowIndex ?>_BookValue" value="<?php echo HtmlEncode($asset_grid->BookValue->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_BookValue" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_BookValue" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_BookValue" value="<?php echo HtmlEncode($asset_grid->BookValue->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_BookValue" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_BookValue" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_BookValue" value="<?php echo HtmlEncode($asset_grid->BookValue->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
		<td data-name="LastDepreciationDate" <?php echo $asset_grid->LastDepreciationDate->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_LastDepreciationDate" class="form-group">
<input type="text" data-table="asset" data-field="x_LastDepreciationDate" name="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" id="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" placeholder="<?php echo HtmlEncode($asset_grid->LastDepreciationDate->getPlaceHolder()) ?>" value="<?php echo $asset_grid->LastDepreciationDate->EditValue ?>"<?php echo $asset_grid->LastDepreciationDate->editAttributes() ?>>
<?php if (!$asset_grid->LastDepreciationDate->ReadOnly && !$asset_grid->LastDepreciationDate->Disabled && !isset($asset_grid->LastDepreciationDate->EditAttrs["readonly"]) && !isset($asset_grid->LastDepreciationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetgrid", "x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationDate" name="o<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" id="o<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" value="<?php echo HtmlEncode($asset_grid->LastDepreciationDate->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_LastDepreciationDate" class="form-group">
<input type="text" data-table="asset" data-field="x_LastDepreciationDate" name="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" id="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" placeholder="<?php echo HtmlEncode($asset_grid->LastDepreciationDate->getPlaceHolder()) ?>" value="<?php echo $asset_grid->LastDepreciationDate->EditValue ?>"<?php echo $asset_grid->LastDepreciationDate->editAttributes() ?>>
<?php if (!$asset_grid->LastDepreciationDate->ReadOnly && !$asset_grid->LastDepreciationDate->Disabled && !isset($asset_grid->LastDepreciationDate->EditAttrs["readonly"]) && !isset($asset_grid->LastDepreciationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetgrid", "x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_LastDepreciationDate">
<span<?php echo $asset_grid->LastDepreciationDate->viewAttributes() ?>><?php echo $asset_grid->LastDepreciationDate->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationDate" name="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" id="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" value="<?php echo HtmlEncode($asset_grid->LastDepreciationDate->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_LastDepreciationDate" name="o<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" id="o<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" value="<?php echo HtmlEncode($asset_grid->LastDepreciationDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationDate" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" value="<?php echo HtmlEncode($asset_grid->LastDepreciationDate->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_LastDepreciationDate" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" value="<?php echo HtmlEncode($asset_grid->LastDepreciationDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
		<td data-name="LastDepreciationAmount" <?php echo $asset_grid->LastDepreciationAmount->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_LastDepreciationAmount" class="form-group">
<input type="text" data-table="asset" data-field="x_LastDepreciationAmount" name="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" id="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" size="30" placeholder="<?php echo HtmlEncode($asset_grid->LastDepreciationAmount->getPlaceHolder()) ?>" value="<?php echo $asset_grid->LastDepreciationAmount->EditValue ?>"<?php echo $asset_grid->LastDepreciationAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationAmount" name="o<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" id="o<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" value="<?php echo HtmlEncode($asset_grid->LastDepreciationAmount->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_LastDepreciationAmount" class="form-group">
<input type="text" data-table="asset" data-field="x_LastDepreciationAmount" name="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" id="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" size="30" placeholder="<?php echo HtmlEncode($asset_grid->LastDepreciationAmount->getPlaceHolder()) ?>" value="<?php echo $asset_grid->LastDepreciationAmount->EditValue ?>"<?php echo $asset_grid->LastDepreciationAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_LastDepreciationAmount">
<span<?php echo $asset_grid->LastDepreciationAmount->viewAttributes() ?>><?php echo $asset_grid->LastDepreciationAmount->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationAmount" name="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" id="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" value="<?php echo HtmlEncode($asset_grid->LastDepreciationAmount->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_LastDepreciationAmount" name="o<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" id="o<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" value="<?php echo HtmlEncode($asset_grid->LastDepreciationAmount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationAmount" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" value="<?php echo HtmlEncode($asset_grid->LastDepreciationAmount->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_LastDepreciationAmount" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" value="<?php echo HtmlEncode($asset_grid->LastDepreciationAmount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->DepreciationRate->Visible) { // DepreciationRate ?>
		<td data-name="DepreciationRate" <?php echo $asset_grid->DepreciationRate->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_DepreciationRate" class="form-group">
<input type="text" data-table="asset" data-field="x_DepreciationRate" name="x<?php echo $asset_grid->RowIndex ?>_DepreciationRate" id="x<?php echo $asset_grid->RowIndex ?>_DepreciationRate" size="30" placeholder="<?php echo HtmlEncode($asset_grid->DepreciationRate->getPlaceHolder()) ?>" value="<?php echo $asset_grid->DepreciationRate->EditValue ?>"<?php echo $asset_grid->DepreciationRate->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_DepreciationRate" name="o<?php echo $asset_grid->RowIndex ?>_DepreciationRate" id="o<?php echo $asset_grid->RowIndex ?>_DepreciationRate" value="<?php echo HtmlEncode($asset_grid->DepreciationRate->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_DepreciationRate" class="form-group">
<input type="text" data-table="asset" data-field="x_DepreciationRate" name="x<?php echo $asset_grid->RowIndex ?>_DepreciationRate" id="x<?php echo $asset_grid->RowIndex ?>_DepreciationRate" size="30" placeholder="<?php echo HtmlEncode($asset_grid->DepreciationRate->getPlaceHolder()) ?>" value="<?php echo $asset_grid->DepreciationRate->EditValue ?>"<?php echo $asset_grid->DepreciationRate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_DepreciationRate">
<span<?php echo $asset_grid->DepreciationRate->viewAttributes() ?>><?php echo $asset_grid->DepreciationRate->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_DepreciationRate" name="x<?php echo $asset_grid->RowIndex ?>_DepreciationRate" id="x<?php echo $asset_grid->RowIndex ?>_DepreciationRate" value="<?php echo HtmlEncode($asset_grid->DepreciationRate->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_DepreciationRate" name="o<?php echo $asset_grid->RowIndex ?>_DepreciationRate" id="o<?php echo $asset_grid->RowIndex ?>_DepreciationRate" value="<?php echo HtmlEncode($asset_grid->DepreciationRate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_DepreciationRate" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_DepreciationRate" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_DepreciationRate" value="<?php echo HtmlEncode($asset_grid->DepreciationRate->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_DepreciationRate" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_DepreciationRate" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_DepreciationRate" value="<?php echo HtmlEncode($asset_grid->DepreciationRate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
		<td data-name="CumulativeDepreciation" <?php echo $asset_grid->CumulativeDepreciation->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_CumulativeDepreciation" class="form-group">
<input type="text" data-table="asset" data-field="x_CumulativeDepreciation" name="x<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" id="x<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" size="30" placeholder="<?php echo HtmlEncode($asset_grid->CumulativeDepreciation->getPlaceHolder()) ?>" value="<?php echo $asset_grid->CumulativeDepreciation->EditValue ?>"<?php echo $asset_grid->CumulativeDepreciation->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_CumulativeDepreciation" name="o<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" id="o<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" value="<?php echo HtmlEncode($asset_grid->CumulativeDepreciation->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_CumulativeDepreciation" class="form-group">
<input type="text" data-table="asset" data-field="x_CumulativeDepreciation" name="x<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" id="x<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" size="30" placeholder="<?php echo HtmlEncode($asset_grid->CumulativeDepreciation->getPlaceHolder()) ?>" value="<?php echo $asset_grid->CumulativeDepreciation->EditValue ?>"<?php echo $asset_grid->CumulativeDepreciation->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_CumulativeDepreciation">
<span<?php echo $asset_grid->CumulativeDepreciation->viewAttributes() ?>><?php echo $asset_grid->CumulativeDepreciation->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_CumulativeDepreciation" name="x<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" id="x<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" value="<?php echo HtmlEncode($asset_grid->CumulativeDepreciation->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_CumulativeDepreciation" name="o<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" id="o<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" value="<?php echo HtmlEncode($asset_grid->CumulativeDepreciation->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_CumulativeDepreciation" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" value="<?php echo HtmlEncode($asset_grid->CumulativeDepreciation->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_CumulativeDepreciation" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" value="<?php echo HtmlEncode($asset_grid->CumulativeDepreciation->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->AssetStatus->Visible) { // AssetStatus ?>
		<td data-name="AssetStatus" <?php echo $asset_grid->AssetStatus->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetStatus" data-value-separator="<?php echo $asset_grid->AssetStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_AssetStatus" name="x<?php echo $asset_grid->RowIndex ?>_AssetStatus"<?php echo $asset_grid->AssetStatus->editAttributes() ?>>
			<?php echo $asset_grid->AssetStatus->selectOptionListHtml("x{$asset_grid->RowIndex}_AssetStatus") ?>
		</select>
</div>
<?php echo $asset_grid->AssetStatus->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_AssetStatus") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetStatus" name="o<?php echo $asset_grid->RowIndex ?>_AssetStatus" id="o<?php echo $asset_grid->RowIndex ?>_AssetStatus" value="<?php echo HtmlEncode($asset_grid->AssetStatus->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetStatus" data-value-separator="<?php echo $asset_grid->AssetStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_AssetStatus" name="x<?php echo $asset_grid->RowIndex ?>_AssetStatus"<?php echo $asset_grid->AssetStatus->editAttributes() ?>>
			<?php echo $asset_grid->AssetStatus->selectOptionListHtml("x{$asset_grid->RowIndex}_AssetStatus") ?>
		</select>
</div>
<?php echo $asset_grid->AssetStatus->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_AssetStatus") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_AssetStatus">
<span<?php echo $asset_grid->AssetStatus->viewAttributes() ?>><?php echo $asset_grid->AssetStatus->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_AssetStatus" name="x<?php echo $asset_grid->RowIndex ?>_AssetStatus" id="x<?php echo $asset_grid->RowIndex ?>_AssetStatus" value="<?php echo HtmlEncode($asset_grid->AssetStatus->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_AssetStatus" name="o<?php echo $asset_grid->RowIndex ?>_AssetStatus" id="o<?php echo $asset_grid->RowIndex ?>_AssetStatus" value="<?php echo HtmlEncode($asset_grid->AssetStatus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_AssetStatus" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_AssetStatus" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_AssetStatus" value="<?php echo HtmlEncode($asset_grid->AssetStatus->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_AssetStatus" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_AssetStatus" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_AssetStatus" value="<?php echo HtmlEncode($asset_grid->AssetStatus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_grid->ScrapValue->Visible) { // ScrapValue ?>
		<td data-name="ScrapValue" <?php echo $asset_grid->ScrapValue->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_ScrapValue" class="form-group">
<input type="text" data-table="asset" data-field="x_ScrapValue" name="x<?php echo $asset_grid->RowIndex ?>_ScrapValue" id="x<?php echo $asset_grid->RowIndex ?>_ScrapValue" size="30" placeholder="<?php echo HtmlEncode($asset_grid->ScrapValue->getPlaceHolder()) ?>" value="<?php echo $asset_grid->ScrapValue->EditValue ?>"<?php echo $asset_grid->ScrapValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ScrapValue" name="o<?php echo $asset_grid->RowIndex ?>_ScrapValue" id="o<?php echo $asset_grid->RowIndex ?>_ScrapValue" value="<?php echo HtmlEncode($asset_grid->ScrapValue->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_ScrapValue" class="form-group">
<input type="text" data-table="asset" data-field="x_ScrapValue" name="x<?php echo $asset_grid->RowIndex ?>_ScrapValue" id="x<?php echo $asset_grid->RowIndex ?>_ScrapValue" size="30" placeholder="<?php echo HtmlEncode($asset_grid->ScrapValue->getPlaceHolder()) ?>" value="<?php echo $asset_grid->ScrapValue->EditValue ?>"<?php echo $asset_grid->ScrapValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_grid->RowCount ?>_asset_ScrapValue">
<span<?php echo $asset_grid->ScrapValue->viewAttributes() ?>><?php echo $asset_grid->ScrapValue->getViewValue() ?></span>
</span>
<?php if (!$asset->isConfirm()) { ?>
<input type="hidden" data-table="asset" data-field="x_ScrapValue" name="x<?php echo $asset_grid->RowIndex ?>_ScrapValue" id="x<?php echo $asset_grid->RowIndex ?>_ScrapValue" value="<?php echo HtmlEncode($asset_grid->ScrapValue->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_ScrapValue" name="o<?php echo $asset_grid->RowIndex ?>_ScrapValue" id="o<?php echo $asset_grid->RowIndex ?>_ScrapValue" value="<?php echo HtmlEncode($asset_grid->ScrapValue->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="asset" data-field="x_ScrapValue" name="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_ScrapValue" id="fassetgrid$x<?php echo $asset_grid->RowIndex ?>_ScrapValue" value="<?php echo HtmlEncode($asset_grid->ScrapValue->FormValue) ?>">
<input type="hidden" data-table="asset" data-field="x_ScrapValue" name="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_ScrapValue" id="fassetgrid$o<?php echo $asset_grid->RowIndex ?>_ScrapValue" value="<?php echo HtmlEncode($asset_grid->ScrapValue->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$asset_grid->ListOptions->render("body", "right", $asset_grid->RowCount);
?>
	</tr>
<?php if ($asset->RowType == ROWTYPE_ADD || $asset->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fassetgrid", "load"], function() {
	fassetgrid.updateLists(<?php echo $asset_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$asset_grid->isGridAdd() || $asset->CurrentMode == "copy")
		if (!$asset_grid->Recordset->EOF)
			$asset_grid->Recordset->moveNext();
}
?>
<?php
	if ($asset->CurrentMode == "add" || $asset->CurrentMode == "copy" || $asset->CurrentMode == "edit") {
		$asset_grid->RowIndex = '$rowindex$';
		$asset_grid->loadRowValues();

		// Set row properties
		$asset->resetAttributes();
		$asset->RowAttrs->merge(["data-rowindex" => $asset_grid->RowIndex, "id" => "r0_asset", "data-rowtype" => ROWTYPE_ADD]);
		$asset->RowAttrs->appendClass("ew-template");
		$asset->RowType = ROWTYPE_ADD;

		// Render row
		$asset_grid->renderRow();

		// Render list options
		$asset_grid->renderListOptions();
		$asset_grid->StartRowCount = 0;
?>
	<tr <?php echo $asset->rowAttributes() ?>>
<?php

// Render list options (body, left)
$asset_grid->ListOptions->render("body", "left", $asset_grid->RowIndex);
?>
	<?php if ($asset_grid->AssetCode->Visible) { // AssetCode ?>
		<td data-name="AssetCode">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_AssetCode" class="form-group asset_AssetCode">
<input type="text" data-table="asset" data-field="x_AssetCode" name="x<?php echo $asset_grid->RowIndex ?>_AssetCode" id="x<?php echo $asset_grid->RowIndex ?>_AssetCode" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_grid->AssetCode->getPlaceHolder()) ?>" value="<?php echo $asset_grid->AssetCode->EditValue ?>"<?php echo $asset_grid->AssetCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_AssetCode" class="form-group asset_AssetCode">
<span<?php echo $asset_grid->AssetCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->AssetCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetCode" name="x<?php echo $asset_grid->RowIndex ?>_AssetCode" id="x<?php echo $asset_grid->RowIndex ?>_AssetCode" value="<?php echo HtmlEncode($asset_grid->AssetCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_AssetCode" name="o<?php echo $asset_grid->RowIndex ?>_AssetCode" id="o<?php echo $asset_grid->RowIndex ?>_AssetCode" value="<?php echo HtmlEncode($asset_grid->AssetCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if (!$asset->isConfirm()) { ?>
<?php if ($asset_grid->ProvinceCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_asset_ProvinceCode" class="form-group asset_ProvinceCode">
<span<?php echo $asset_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" name="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_asset_ProvinceCode" class="form-group asset_ProvinceCode">
<?php
$onchange = $asset_grid->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$asset_grid->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $asset_grid->RowIndex ?>_ProvinceCode">
	<input type="text" class="form-control" name="sv_x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="sv_x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo RemoveHtml($asset_grid->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($asset_grid->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($asset_grid->ProvinceCode->getPlaceHolder()) ?>"<?php echo $asset_grid->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" data-value-separator="<?php echo $asset_grid->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassetgrid"], function() {
	fassetgrid.createAutoSuggest({"id":"x<?php echo $asset_grid->RowIndex ?>_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $asset_grid->ProvinceCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_asset_ProvinceCode" class="form-group asset_ProvinceCode">
<span<?php echo $asset_grid->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" name="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="x<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" name="o<?php echo $asset_grid->RowIndex ?>_ProvinceCode" id="o<?php echo $asset_grid->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_grid->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if (!$asset->isConfirm()) { ?>
<?php if ($asset_grid->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_asset_LACode" class="form-group asset_LACode">
<span<?php echo $asset_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $asset_grid->RowIndex ?>_LACode" name="x<?php echo $asset_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_grid->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_asset_LACode" class="form-group asset_LACode">
<?php $asset_grid->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_LACode" data-value-separator="<?php echo $asset_grid->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_LACode" name="x<?php echo $asset_grid->RowIndex ?>_LACode"<?php echo $asset_grid->LACode->editAttributes() ?>>
			<?php echo $asset_grid->LACode->selectOptionListHtml("x{$asset_grid->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $asset_grid->LACode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_asset_LACode" class="form-group asset_LACode">
<span<?php echo $asset_grid->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_LACode" name="x<?php echo $asset_grid->RowIndex ?>_LACode" id="x<?php echo $asset_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_grid->LACode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_LACode" name="o<?php echo $asset_grid->RowIndex ?>_LACode" id="o<?php echo $asset_grid->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_grid->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_DepartmentCode" class="form-group asset_DepartmentCode">
<?php $asset_grid->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_DepartmentCode" data-value-separator="<?php echo $asset_grid->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_DepartmentCode" name="x<?php echo $asset_grid->RowIndex ?>_DepartmentCode"<?php echo $asset_grid->DepartmentCode->editAttributes() ?>>
			<?php echo $asset_grid->DepartmentCode->selectOptionListHtml("x{$asset_grid->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $asset_grid->DepartmentCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_DepartmentCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_DepartmentCode" class="form-group asset_DepartmentCode">
<span<?php echo $asset_grid->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_DepartmentCode" name="x<?php echo $asset_grid->RowIndex ?>_DepartmentCode" id="x<?php echo $asset_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($asset_grid->DepartmentCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_DepartmentCode" name="o<?php echo $asset_grid->RowIndex ?>_DepartmentCode" id="o<?php echo $asset_grid->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($asset_grid->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_SectionCode" class="form-group asset_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_SectionCode" data-value-separator="<?php echo $asset_grid->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_SectionCode" name="x<?php echo $asset_grid->RowIndex ?>_SectionCode"<?php echo $asset_grid->SectionCode->editAttributes() ?>>
			<?php echo $asset_grid->SectionCode->selectOptionListHtml("x{$asset_grid->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $asset_grid->SectionCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_SectionCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_SectionCode" class="form-group asset_SectionCode">
<span<?php echo $asset_grid->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->SectionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_SectionCode" name="x<?php echo $asset_grid->RowIndex ?>_SectionCode" id="x<?php echo $asset_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($asset_grid->SectionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_SectionCode" name="o<?php echo $asset_grid->RowIndex ?>_SectionCode" id="o<?php echo $asset_grid->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($asset_grid->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->AssetTypeCode->Visible) { // AssetTypeCode ?>
		<td data-name="AssetTypeCode">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_AssetTypeCode" class="form-group asset_AssetTypeCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetTypeCode" data-value-separator="<?php echo $asset_grid->AssetTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" name="x<?php echo $asset_grid->RowIndex ?>_AssetTypeCode"<?php echo $asset_grid->AssetTypeCode->editAttributes() ?>>
			<?php echo $asset_grid->AssetTypeCode->selectOptionListHtml("x{$asset_grid->RowIndex}_AssetTypeCode") ?>
		</select>
</div>
<?php echo $asset_grid->AssetTypeCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_AssetTypeCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_AssetTypeCode" class="form-group asset_AssetTypeCode">
<span<?php echo $asset_grid->AssetTypeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->AssetTypeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetTypeCode" name="x<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" id="x<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" value="<?php echo HtmlEncode($asset_grid->AssetTypeCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_AssetTypeCode" name="o<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" id="o<?php echo $asset_grid->RowIndex ?>_AssetTypeCode" value="<?php echo HtmlEncode($asset_grid->AssetTypeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->Supplier->Visible) { // Supplier ?>
		<td data-name="Supplier">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_Supplier" class="form-group asset_Supplier">
<input type="text" data-table="asset" data-field="x_Supplier" name="x<?php echo $asset_grid->RowIndex ?>_Supplier" id="x<?php echo $asset_grid->RowIndex ?>_Supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($asset_grid->Supplier->getPlaceHolder()) ?>" value="<?php echo $asset_grid->Supplier->EditValue ?>"<?php echo $asset_grid->Supplier->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_Supplier" class="form-group asset_Supplier">
<span<?php echo $asset_grid->Supplier->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->Supplier->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_Supplier" name="x<?php echo $asset_grid->RowIndex ?>_Supplier" id="x<?php echo $asset_grid->RowIndex ?>_Supplier" value="<?php echo HtmlEncode($asset_grid->Supplier->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_Supplier" name="o<?php echo $asset_grid->RowIndex ?>_Supplier" id="o<?php echo $asset_grid->RowIndex ?>_Supplier" value="<?php echo HtmlEncode($asset_grid->Supplier->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->PurchasePrice->Visible) { // PurchasePrice ?>
		<td data-name="PurchasePrice">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_PurchasePrice" class="form-group asset_PurchasePrice">
<input type="text" data-table="asset" data-field="x_PurchasePrice" name="x<?php echo $asset_grid->RowIndex ?>_PurchasePrice" id="x<?php echo $asset_grid->RowIndex ?>_PurchasePrice" size="30" placeholder="<?php echo HtmlEncode($asset_grid->PurchasePrice->getPlaceHolder()) ?>" value="<?php echo $asset_grid->PurchasePrice->EditValue ?>"<?php echo $asset_grid->PurchasePrice->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_PurchasePrice" class="form-group asset_PurchasePrice">
<span<?php echo $asset_grid->PurchasePrice->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->PurchasePrice->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_PurchasePrice" name="x<?php echo $asset_grid->RowIndex ?>_PurchasePrice" id="x<?php echo $asset_grid->RowIndex ?>_PurchasePrice" value="<?php echo HtmlEncode($asset_grid->PurchasePrice->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_PurchasePrice" name="o<?php echo $asset_grid->RowIndex ?>_PurchasePrice" id="o<?php echo $asset_grid->RowIndex ?>_PurchasePrice" value="<?php echo HtmlEncode($asset_grid->PurchasePrice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->CurrencyCode->Visible) { // CurrencyCode ?>
		<td data-name="CurrencyCode">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_CurrencyCode" class="form-group asset_CurrencyCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_CurrencyCode" data-value-separator="<?php echo $asset_grid->CurrencyCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_CurrencyCode" name="x<?php echo $asset_grid->RowIndex ?>_CurrencyCode"<?php echo $asset_grid->CurrencyCode->editAttributes() ?>>
			<?php echo $asset_grid->CurrencyCode->selectOptionListHtml("x{$asset_grid->RowIndex}_CurrencyCode") ?>
		</select>
</div>
<?php echo $asset_grid->CurrencyCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_CurrencyCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_CurrencyCode" class="form-group asset_CurrencyCode">
<span<?php echo $asset_grid->CurrencyCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->CurrencyCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_CurrencyCode" name="x<?php echo $asset_grid->RowIndex ?>_CurrencyCode" id="x<?php echo $asset_grid->RowIndex ?>_CurrencyCode" value="<?php echo HtmlEncode($asset_grid->CurrencyCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_CurrencyCode" name="o<?php echo $asset_grid->RowIndex ?>_CurrencyCode" id="o<?php echo $asset_grid->RowIndex ?>_CurrencyCode" value="<?php echo HtmlEncode($asset_grid->CurrencyCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->ConditionCode->Visible) { // ConditionCode ?>
		<td data-name="ConditionCode">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_ConditionCode" class="form-group asset_ConditionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_ConditionCode" data-value-separator="<?php echo $asset_grid->ConditionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_ConditionCode" name="x<?php echo $asset_grid->RowIndex ?>_ConditionCode"<?php echo $asset_grid->ConditionCode->editAttributes() ?>>
			<?php echo $asset_grid->ConditionCode->selectOptionListHtml("x{$asset_grid->RowIndex}_ConditionCode") ?>
		</select>
</div>
<?php echo $asset_grid->ConditionCode->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_ConditionCode") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_ConditionCode" class="form-group asset_ConditionCode">
<span<?php echo $asset_grid->ConditionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->ConditionCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_ConditionCode" name="x<?php echo $asset_grid->RowIndex ?>_ConditionCode" id="x<?php echo $asset_grid->RowIndex ?>_ConditionCode" value="<?php echo HtmlEncode($asset_grid->ConditionCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_ConditionCode" name="o<?php echo $asset_grid->RowIndex ?>_ConditionCode" id="o<?php echo $asset_grid->RowIndex ?>_ConditionCode" value="<?php echo HtmlEncode($asset_grid->ConditionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->DateOfPurchase->Visible) { // DateOfPurchase ?>
		<td data-name="DateOfPurchase">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_DateOfPurchase" class="form-group asset_DateOfPurchase">
<input type="text" data-table="asset" data-field="x_DateOfPurchase" name="x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" id="x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" placeholder="<?php echo HtmlEncode($asset_grid->DateOfPurchase->getPlaceHolder()) ?>" value="<?php echo $asset_grid->DateOfPurchase->EditValue ?>"<?php echo $asset_grid->DateOfPurchase->editAttributes() ?>>
<?php if (!$asset_grid->DateOfPurchase->ReadOnly && !$asset_grid->DateOfPurchase->Disabled && !isset($asset_grid->DateOfPurchase->EditAttrs["readonly"]) && !isset($asset_grid->DateOfPurchase->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetgrid", "x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_DateOfPurchase" class="form-group asset_DateOfPurchase">
<span<?php echo $asset_grid->DateOfPurchase->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->DateOfPurchase->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_DateOfPurchase" name="x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" id="x<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" value="<?php echo HtmlEncode($asset_grid->DateOfPurchase->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_DateOfPurchase" name="o<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" id="o<?php echo $asset_grid->RowIndex ?>_DateOfPurchase" value="<?php echo HtmlEncode($asset_grid->DateOfPurchase->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->AssetCapacity->Visible) { // AssetCapacity ?>
		<td data-name="AssetCapacity">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_AssetCapacity" class="form-group asset_AssetCapacity">
<input type="text" data-table="asset" data-field="x_AssetCapacity" name="x<?php echo $asset_grid->RowIndex ?>_AssetCapacity" id="x<?php echo $asset_grid->RowIndex ?>_AssetCapacity" size="30" placeholder="<?php echo HtmlEncode($asset_grid->AssetCapacity->getPlaceHolder()) ?>" value="<?php echo $asset_grid->AssetCapacity->EditValue ?>"<?php echo $asset_grid->AssetCapacity->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_AssetCapacity" class="form-group asset_AssetCapacity">
<span<?php echo $asset_grid->AssetCapacity->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->AssetCapacity->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetCapacity" name="x<?php echo $asset_grid->RowIndex ?>_AssetCapacity" id="x<?php echo $asset_grid->RowIndex ?>_AssetCapacity" value="<?php echo HtmlEncode($asset_grid->AssetCapacity->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_AssetCapacity" name="o<?php echo $asset_grid->RowIndex ?>_AssetCapacity" id="o<?php echo $asset_grid->RowIndex ?>_AssetCapacity" value="<?php echo HtmlEncode($asset_grid->AssetCapacity->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_UnitOfMeasure" class="form-group asset_UnitOfMeasure">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $asset_grid->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" name="x<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure"<?php echo $asset_grid->UnitOfMeasure->editAttributes() ?>>
			<?php echo $asset_grid->UnitOfMeasure->selectOptionListHtml("x{$asset_grid->RowIndex}_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $asset_grid->UnitOfMeasure->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_UnitOfMeasure") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_UnitOfMeasure" class="form-group asset_UnitOfMeasure">
<span<?php echo $asset_grid->UnitOfMeasure->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->UnitOfMeasure->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_UnitOfMeasure" name="x<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" id="x<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($asset_grid->UnitOfMeasure->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_UnitOfMeasure" name="o<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" id="o<?php echo $asset_grid->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($asset_grid->UnitOfMeasure->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->AssetDescription->Visible) { // AssetDescription ?>
		<td data-name="AssetDescription">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_AssetDescription" class="form-group asset_AssetDescription">
<input type="text" data-table="asset" data-field="x_AssetDescription" name="x<?php echo $asset_grid->RowIndex ?>_AssetDescription" id="x<?php echo $asset_grid->RowIndex ?>_AssetDescription" size="50" maxlength="60" placeholder="<?php echo HtmlEncode($asset_grid->AssetDescription->getPlaceHolder()) ?>" value="<?php echo $asset_grid->AssetDescription->EditValue ?>"<?php echo $asset_grid->AssetDescription->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_AssetDescription" class="form-group asset_AssetDescription">
<span<?php echo $asset_grid->AssetDescription->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->AssetDescription->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetDescription" name="x<?php echo $asset_grid->RowIndex ?>_AssetDescription" id="x<?php echo $asset_grid->RowIndex ?>_AssetDescription" value="<?php echo HtmlEncode($asset_grid->AssetDescription->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_AssetDescription" name="o<?php echo $asset_grid->RowIndex ?>_AssetDescription" id="o<?php echo $asset_grid->RowIndex ?>_AssetDescription" value="<?php echo HtmlEncode($asset_grid->AssetDescription->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
		<td data-name="DateOfLastRevaluation">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_DateOfLastRevaluation" class="form-group asset_DateOfLastRevaluation">
<input type="text" data-table="asset" data-field="x_DateOfLastRevaluation" name="x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" id="x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" placeholder="<?php echo HtmlEncode($asset_grid->DateOfLastRevaluation->getPlaceHolder()) ?>" value="<?php echo $asset_grid->DateOfLastRevaluation->EditValue ?>"<?php echo $asset_grid->DateOfLastRevaluation->editAttributes() ?>>
<?php if (!$asset_grid->DateOfLastRevaluation->ReadOnly && !$asset_grid->DateOfLastRevaluation->Disabled && !isset($asset_grid->DateOfLastRevaluation->EditAttrs["readonly"]) && !isset($asset_grid->DateOfLastRevaluation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetgrid", "x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_DateOfLastRevaluation" class="form-group asset_DateOfLastRevaluation">
<span<?php echo $asset_grid->DateOfLastRevaluation->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->DateOfLastRevaluation->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_DateOfLastRevaluation" name="x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" id="x<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" value="<?php echo HtmlEncode($asset_grid->DateOfLastRevaluation->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_DateOfLastRevaluation" name="o<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" id="o<?php echo $asset_grid->RowIndex ?>_DateOfLastRevaluation" value="<?php echo HtmlEncode($asset_grid->DateOfLastRevaluation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->NewValue->Visible) { // NewValue ?>
		<td data-name="NewValue">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_NewValue" class="form-group asset_NewValue">
<input type="text" data-table="asset" data-field="x_NewValue" name="x<?php echo $asset_grid->RowIndex ?>_NewValue" id="x<?php echo $asset_grid->RowIndex ?>_NewValue" size="30" placeholder="<?php echo HtmlEncode($asset_grid->NewValue->getPlaceHolder()) ?>" value="<?php echo $asset_grid->NewValue->EditValue ?>"<?php echo $asset_grid->NewValue->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_NewValue" class="form-group asset_NewValue">
<span<?php echo $asset_grid->NewValue->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->NewValue->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_NewValue" name="x<?php echo $asset_grid->RowIndex ?>_NewValue" id="x<?php echo $asset_grid->RowIndex ?>_NewValue" value="<?php echo HtmlEncode($asset_grid->NewValue->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_NewValue" name="o<?php echo $asset_grid->RowIndex ?>_NewValue" id="o<?php echo $asset_grid->RowIndex ?>_NewValue" value="<?php echo HtmlEncode($asset_grid->NewValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->NameOfValuer->Visible) { // NameOfValuer ?>
		<td data-name="NameOfValuer">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_NameOfValuer" class="form-group asset_NameOfValuer">
<input type="text" data-table="asset" data-field="x_NameOfValuer" name="x<?php echo $asset_grid->RowIndex ?>_NameOfValuer" id="x<?php echo $asset_grid->RowIndex ?>_NameOfValuer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($asset_grid->NameOfValuer->getPlaceHolder()) ?>" value="<?php echo $asset_grid->NameOfValuer->EditValue ?>"<?php echo $asset_grid->NameOfValuer->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_NameOfValuer" class="form-group asset_NameOfValuer">
<span<?php echo $asset_grid->NameOfValuer->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->NameOfValuer->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_NameOfValuer" name="x<?php echo $asset_grid->RowIndex ?>_NameOfValuer" id="x<?php echo $asset_grid->RowIndex ?>_NameOfValuer" value="<?php echo HtmlEncode($asset_grid->NameOfValuer->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_NameOfValuer" name="o<?php echo $asset_grid->RowIndex ?>_NameOfValuer" id="o<?php echo $asset_grid->RowIndex ?>_NameOfValuer" value="<?php echo HtmlEncode($asset_grid->NameOfValuer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->BookValue->Visible) { // BookValue ?>
		<td data-name="BookValue">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_BookValue" class="form-group asset_BookValue">
<input type="text" data-table="asset" data-field="x_BookValue" name="x<?php echo $asset_grid->RowIndex ?>_BookValue" id="x<?php echo $asset_grid->RowIndex ?>_BookValue" size="30" placeholder="<?php echo HtmlEncode($asset_grid->BookValue->getPlaceHolder()) ?>" value="<?php echo $asset_grid->BookValue->EditValue ?>"<?php echo $asset_grid->BookValue->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_BookValue" class="form-group asset_BookValue">
<span<?php echo $asset_grid->BookValue->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->BookValue->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_BookValue" name="x<?php echo $asset_grid->RowIndex ?>_BookValue" id="x<?php echo $asset_grid->RowIndex ?>_BookValue" value="<?php echo HtmlEncode($asset_grid->BookValue->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_BookValue" name="o<?php echo $asset_grid->RowIndex ?>_BookValue" id="o<?php echo $asset_grid->RowIndex ?>_BookValue" value="<?php echo HtmlEncode($asset_grid->BookValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
		<td data-name="LastDepreciationDate">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_LastDepreciationDate" class="form-group asset_LastDepreciationDate">
<input type="text" data-table="asset" data-field="x_LastDepreciationDate" name="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" id="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" placeholder="<?php echo HtmlEncode($asset_grid->LastDepreciationDate->getPlaceHolder()) ?>" value="<?php echo $asset_grid->LastDepreciationDate->EditValue ?>"<?php echo $asset_grid->LastDepreciationDate->editAttributes() ?>>
<?php if (!$asset_grid->LastDepreciationDate->ReadOnly && !$asset_grid->LastDepreciationDate->Disabled && !isset($asset_grid->LastDepreciationDate->EditAttrs["readonly"]) && !isset($asset_grid->LastDepreciationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetgrid", "x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_LastDepreciationDate" class="form-group asset_LastDepreciationDate">
<span<?php echo $asset_grid->LastDepreciationDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->LastDepreciationDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationDate" name="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" id="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" value="<?php echo HtmlEncode($asset_grid->LastDepreciationDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationDate" name="o<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" id="o<?php echo $asset_grid->RowIndex ?>_LastDepreciationDate" value="<?php echo HtmlEncode($asset_grid->LastDepreciationDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
		<td data-name="LastDepreciationAmount">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_LastDepreciationAmount" class="form-group asset_LastDepreciationAmount">
<input type="text" data-table="asset" data-field="x_LastDepreciationAmount" name="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" id="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" size="30" placeholder="<?php echo HtmlEncode($asset_grid->LastDepreciationAmount->getPlaceHolder()) ?>" value="<?php echo $asset_grid->LastDepreciationAmount->EditValue ?>"<?php echo $asset_grid->LastDepreciationAmount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_LastDepreciationAmount" class="form-group asset_LastDepreciationAmount">
<span<?php echo $asset_grid->LastDepreciationAmount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->LastDepreciationAmount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationAmount" name="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" id="x<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" value="<?php echo HtmlEncode($asset_grid->LastDepreciationAmount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationAmount" name="o<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" id="o<?php echo $asset_grid->RowIndex ?>_LastDepreciationAmount" value="<?php echo HtmlEncode($asset_grid->LastDepreciationAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->DepreciationRate->Visible) { // DepreciationRate ?>
		<td data-name="DepreciationRate">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_DepreciationRate" class="form-group asset_DepreciationRate">
<input type="text" data-table="asset" data-field="x_DepreciationRate" name="x<?php echo $asset_grid->RowIndex ?>_DepreciationRate" id="x<?php echo $asset_grid->RowIndex ?>_DepreciationRate" size="30" placeholder="<?php echo HtmlEncode($asset_grid->DepreciationRate->getPlaceHolder()) ?>" value="<?php echo $asset_grid->DepreciationRate->EditValue ?>"<?php echo $asset_grid->DepreciationRate->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_DepreciationRate" class="form-group asset_DepreciationRate">
<span<?php echo $asset_grid->DepreciationRate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->DepreciationRate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_DepreciationRate" name="x<?php echo $asset_grid->RowIndex ?>_DepreciationRate" id="x<?php echo $asset_grid->RowIndex ?>_DepreciationRate" value="<?php echo HtmlEncode($asset_grid->DepreciationRate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_DepreciationRate" name="o<?php echo $asset_grid->RowIndex ?>_DepreciationRate" id="o<?php echo $asset_grid->RowIndex ?>_DepreciationRate" value="<?php echo HtmlEncode($asset_grid->DepreciationRate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
		<td data-name="CumulativeDepreciation">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_CumulativeDepreciation" class="form-group asset_CumulativeDepreciation">
<input type="text" data-table="asset" data-field="x_CumulativeDepreciation" name="x<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" id="x<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" size="30" placeholder="<?php echo HtmlEncode($asset_grid->CumulativeDepreciation->getPlaceHolder()) ?>" value="<?php echo $asset_grid->CumulativeDepreciation->EditValue ?>"<?php echo $asset_grid->CumulativeDepreciation->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_CumulativeDepreciation" class="form-group asset_CumulativeDepreciation">
<span<?php echo $asset_grid->CumulativeDepreciation->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->CumulativeDepreciation->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_CumulativeDepreciation" name="x<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" id="x<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" value="<?php echo HtmlEncode($asset_grid->CumulativeDepreciation->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_CumulativeDepreciation" name="o<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" id="o<?php echo $asset_grid->RowIndex ?>_CumulativeDepreciation" value="<?php echo HtmlEncode($asset_grid->CumulativeDepreciation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->AssetStatus->Visible) { // AssetStatus ?>
		<td data-name="AssetStatus">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_AssetStatus" class="form-group asset_AssetStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetStatus" data-value-separator="<?php echo $asset_grid->AssetStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_grid->RowIndex ?>_AssetStatus" name="x<?php echo $asset_grid->RowIndex ?>_AssetStatus"<?php echo $asset_grid->AssetStatus->editAttributes() ?>>
			<?php echo $asset_grid->AssetStatus->selectOptionListHtml("x{$asset_grid->RowIndex}_AssetStatus") ?>
		</select>
</div>
<?php echo $asset_grid->AssetStatus->Lookup->getParamTag($asset_grid, "p_x" . $asset_grid->RowIndex . "_AssetStatus") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_AssetStatus" class="form-group asset_AssetStatus">
<span<?php echo $asset_grid->AssetStatus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->AssetStatus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetStatus" name="x<?php echo $asset_grid->RowIndex ?>_AssetStatus" id="x<?php echo $asset_grid->RowIndex ?>_AssetStatus" value="<?php echo HtmlEncode($asset_grid->AssetStatus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_AssetStatus" name="o<?php echo $asset_grid->RowIndex ?>_AssetStatus" id="o<?php echo $asset_grid->RowIndex ?>_AssetStatus" value="<?php echo HtmlEncode($asset_grid->AssetStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_grid->ScrapValue->Visible) { // ScrapValue ?>
		<td data-name="ScrapValue">
<?php if (!$asset->isConfirm()) { ?>
<span id="el$rowindex$_asset_ScrapValue" class="form-group asset_ScrapValue">
<input type="text" data-table="asset" data-field="x_ScrapValue" name="x<?php echo $asset_grid->RowIndex ?>_ScrapValue" id="x<?php echo $asset_grid->RowIndex ?>_ScrapValue" size="30" placeholder="<?php echo HtmlEncode($asset_grid->ScrapValue->getPlaceHolder()) ?>" value="<?php echo $asset_grid->ScrapValue->EditValue ?>"<?php echo $asset_grid->ScrapValue->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_asset_ScrapValue" class="form-group asset_ScrapValue">
<span<?php echo $asset_grid->ScrapValue->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_grid->ScrapValue->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="asset" data-field="x_ScrapValue" name="x<?php echo $asset_grid->RowIndex ?>_ScrapValue" id="x<?php echo $asset_grid->RowIndex ?>_ScrapValue" value="<?php echo HtmlEncode($asset_grid->ScrapValue->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_ScrapValue" name="o<?php echo $asset_grid->RowIndex ?>_ScrapValue" id="o<?php echo $asset_grid->RowIndex ?>_ScrapValue" value="<?php echo HtmlEncode($asset_grid->ScrapValue->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$asset_grid->ListOptions->render("body", "right", $asset_grid->RowIndex);
?>
<script>
loadjs.ready(["fassetgrid", "load"], function() {
	fassetgrid.updateLists(<?php echo $asset_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($asset->CurrentMode == "add" || $asset->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $asset_grid->FormKeyCountName ?>" id="<?php echo $asset_grid->FormKeyCountName ?>" value="<?php echo $asset_grid->KeyCount ?>">
<?php echo $asset_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($asset->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $asset_grid->FormKeyCountName ?>" id="<?php echo $asset_grid->FormKeyCountName ?>" value="<?php echo $asset_grid->KeyCount ?>">
<?php echo $asset_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($asset->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fassetgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($asset_grid->Recordset)
	$asset_grid->Recordset->Close();
?>
<?php if ($asset_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $asset_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($asset_grid->TotalRecords == 0 && !$asset->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $asset_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$asset_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$asset_grid->terminate();
?>