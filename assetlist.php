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
$asset_list = new asset_list();

// Run the page
$asset_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asset_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$asset_list->isExport()) { ?>
<script>
var fassetlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fassetlist = currentForm = new ew.Form("fassetlist", "list");
	fassetlist.formKeyCountName = '<?php echo $asset_list->FormKeyCountName ?>';

	// Validate form
	fassetlist.validate = function() {
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
			<?php if ($asset_list->AssetCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->AssetCode->caption(), $asset_list->AssetCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_list->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->ProvinceCode->caption(), $asset_list->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_list->ProvinceCode->errorMessage()) ?>");
			<?php if ($asset_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->LACode->caption(), $asset_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_list->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->DepartmentCode->caption(), $asset_list->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_list->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->SectionCode->caption(), $asset_list->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_list->AssetTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->AssetTypeCode->caption(), $asset_list->AssetTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_list->Supplier->Required) { ?>
				elm = this.getElements("x" + infix + "_Supplier");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->Supplier->caption(), $asset_list->Supplier->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_list->PurchasePrice->Required) { ?>
				elm = this.getElements("x" + infix + "_PurchasePrice");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->PurchasePrice->caption(), $asset_list->PurchasePrice->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PurchasePrice");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_list->PurchasePrice->errorMessage()) ?>");
			<?php if ($asset_list->CurrencyCode->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrencyCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->CurrencyCode->caption(), $asset_list->CurrencyCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_list->ConditionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ConditionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->ConditionCode->caption(), $asset_list->ConditionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_list->DateOfPurchase->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfPurchase");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->DateOfPurchase->caption(), $asset_list->DateOfPurchase->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfPurchase");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_list->DateOfPurchase->errorMessage()) ?>");
			<?php if ($asset_list->AssetCapacity->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetCapacity");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->AssetCapacity->caption(), $asset_list->AssetCapacity->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AssetCapacity");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_list->AssetCapacity->errorMessage()) ?>");
			<?php if ($asset_list->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->UnitOfMeasure->caption(), $asset_list->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_list->AssetDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->AssetDescription->caption(), $asset_list->AssetDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_list->DateOfLastRevaluation->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfLastRevaluation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->DateOfLastRevaluation->caption(), $asset_list->DateOfLastRevaluation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfLastRevaluation");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_list->DateOfLastRevaluation->errorMessage()) ?>");
			<?php if ($asset_list->NewValue->Required) { ?>
				elm = this.getElements("x" + infix + "_NewValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->NewValue->caption(), $asset_list->NewValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NewValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_list->NewValue->errorMessage()) ?>");
			<?php if ($asset_list->NameOfValuer->Required) { ?>
				elm = this.getElements("x" + infix + "_NameOfValuer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->NameOfValuer->caption(), $asset_list->NameOfValuer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_list->BookValue->Required) { ?>
				elm = this.getElements("x" + infix + "_BookValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->BookValue->caption(), $asset_list->BookValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BookValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_list->BookValue->errorMessage()) ?>");
			<?php if ($asset_list->LastDepreciationDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastDepreciationDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->LastDepreciationDate->caption(), $asset_list->LastDepreciationDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastDepreciationDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_list->LastDepreciationDate->errorMessage()) ?>");
			<?php if ($asset_list->LastDepreciationAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_LastDepreciationAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->LastDepreciationAmount->caption(), $asset_list->LastDepreciationAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastDepreciationAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_list->LastDepreciationAmount->errorMessage()) ?>");
			<?php if ($asset_list->DepreciationRate->Required) { ?>
				elm = this.getElements("x" + infix + "_DepreciationRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->DepreciationRate->caption(), $asset_list->DepreciationRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DepreciationRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_list->DepreciationRate->errorMessage()) ?>");
			<?php if ($asset_list->CumulativeDepreciation->Required) { ?>
				elm = this.getElements("x" + infix + "_CumulativeDepreciation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->CumulativeDepreciation->caption(), $asset_list->CumulativeDepreciation->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CumulativeDepreciation");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_list->CumulativeDepreciation->errorMessage()) ?>");
			<?php if ($asset_list->AssetStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_AssetStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->AssetStatus->caption(), $asset_list->AssetStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($asset_list->ScrapValue->Required) { ?>
				elm = this.getElements("x" + infix + "_ScrapValue");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $asset_list->ScrapValue->caption(), $asset_list->ScrapValue->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ScrapValue");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($asset_list->ScrapValue->errorMessage()) ?>");

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
	fassetlist.emptyRow = function(infix) {
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
	fassetlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fassetlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fassetlist.lists["x_ProvinceCode"] = <?php echo $asset_list->ProvinceCode->Lookup->toClientList($asset_list) ?>;
	fassetlist.lists["x_ProvinceCode"].options = <?php echo JsonEncode($asset_list->ProvinceCode->lookupOptions()) ?>;
	fassetlist.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fassetlist.lists["x_LACode"] = <?php echo $asset_list->LACode->Lookup->toClientList($asset_list) ?>;
	fassetlist.lists["x_LACode"].options = <?php echo JsonEncode($asset_list->LACode->lookupOptions()) ?>;
	fassetlist.lists["x_DepartmentCode"] = <?php echo $asset_list->DepartmentCode->Lookup->toClientList($asset_list) ?>;
	fassetlist.lists["x_DepartmentCode"].options = <?php echo JsonEncode($asset_list->DepartmentCode->lookupOptions()) ?>;
	fassetlist.lists["x_SectionCode"] = <?php echo $asset_list->SectionCode->Lookup->toClientList($asset_list) ?>;
	fassetlist.lists["x_SectionCode"].options = <?php echo JsonEncode($asset_list->SectionCode->lookupOptions()) ?>;
	fassetlist.lists["x_AssetTypeCode"] = <?php echo $asset_list->AssetTypeCode->Lookup->toClientList($asset_list) ?>;
	fassetlist.lists["x_AssetTypeCode"].options = <?php echo JsonEncode($asset_list->AssetTypeCode->lookupOptions()) ?>;
	fassetlist.lists["x_CurrencyCode"] = <?php echo $asset_list->CurrencyCode->Lookup->toClientList($asset_list) ?>;
	fassetlist.lists["x_CurrencyCode"].options = <?php echo JsonEncode($asset_list->CurrencyCode->lookupOptions()) ?>;
	fassetlist.lists["x_ConditionCode"] = <?php echo $asset_list->ConditionCode->Lookup->toClientList($asset_list) ?>;
	fassetlist.lists["x_ConditionCode"].options = <?php echo JsonEncode($asset_list->ConditionCode->lookupOptions()) ?>;
	fassetlist.lists["x_UnitOfMeasure"] = <?php echo $asset_list->UnitOfMeasure->Lookup->toClientList($asset_list) ?>;
	fassetlist.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($asset_list->UnitOfMeasure->lookupOptions()) ?>;
	fassetlist.lists["x_AssetStatus"] = <?php echo $asset_list->AssetStatus->Lookup->toClientList($asset_list) ?>;
	fassetlist.lists["x_AssetStatus"].options = <?php echo JsonEncode($asset_list->AssetStatus->lookupOptions()) ?>;
	loadjs.done("fassetlist");
});
var fassetlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fassetlistsrch = currentSearchForm = new ew.Form("fassetlistsrch");

	// Validate function for search
	fassetlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ProvinceCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($asset_list->ProvinceCode->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fassetlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fassetlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fassetlistsrch.lists["x_ProvinceCode"] = <?php echo $asset_list->ProvinceCode->Lookup->toClientList($asset_list) ?>;
	fassetlistsrch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($asset_list->ProvinceCode->lookupOptions()) ?>;
	fassetlistsrch.autoSuggests["x_ProvinceCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fassetlistsrch.lists["x_LACode"] = <?php echo $asset_list->LACode->Lookup->toClientList($asset_list) ?>;
	fassetlistsrch.lists["x_LACode"].options = <?php echo JsonEncode($asset_list->LACode->lookupOptions()) ?>;
	fassetlistsrch.lists["x_DepartmentCode"] = <?php echo $asset_list->DepartmentCode->Lookup->toClientList($asset_list) ?>;
	fassetlistsrch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($asset_list->DepartmentCode->lookupOptions()) ?>;
	fassetlistsrch.lists["x_SectionCode"] = <?php echo $asset_list->SectionCode->Lookup->toClientList($asset_list) ?>;
	fassetlistsrch.lists["x_SectionCode"].options = <?php echo JsonEncode($asset_list->SectionCode->lookupOptions()) ?>;
	fassetlistsrch.lists["x_AssetTypeCode"] = <?php echo $asset_list->AssetTypeCode->Lookup->toClientList($asset_list) ?>;
	fassetlistsrch.lists["x_AssetTypeCode"].options = <?php echo JsonEncode($asset_list->AssetTypeCode->lookupOptions()) ?>;
	fassetlistsrch.lists["x_ConditionCode"] = <?php echo $asset_list->ConditionCode->Lookup->toClientList($asset_list) ?>;
	fassetlistsrch.lists["x_ConditionCode"].options = <?php echo JsonEncode($asset_list->ConditionCode->lookupOptions()) ?>;

	// Filters
	fassetlistsrch.filterList = <?php echo $asset_list->getFilterList() ?>;

	// Init search panel as collapsed
	fassetlistsrch.initSearchPanel = true;
	loadjs.done("fassetlistsrch");
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
<?php if (!$asset_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($asset_list->TotalRecords > 0 && $asset_list->ExportOptions->visible()) { ?>
<?php $asset_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($asset_list->ImportOptions->visible()) { ?>
<?php $asset_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($asset_list->SearchOptions->visible()) { ?>
<?php $asset_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($asset_list->FilterOptions->visible()) { ?>
<?php $asset_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$asset_list->isExport() || Config("EXPORT_MASTER_RECORD") && $asset_list->isExport("print")) { ?>
<?php
if ($asset_list->DbMasterFilter != "" && $asset->getCurrentMasterTable() == "local_authority") {
	if ($asset_list->MasterRecordExists) {
		include_once "local_authoritymaster.php";
	}
}
?>
<?php } ?>
<?php
$asset_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$asset_list->isExport() && !$asset->CurrentAction) { ?>
<form name="fassetlistsrch" id="fassetlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fassetlistsrch-search-panel" class="<?php echo $asset_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="asset">
	<div class="ew-extended-search">
<?php

// Render search row
$asset->RowType = ROWTYPE_SEARCH;
$asset->resetAttributes();
$asset_list->renderRow();
?>
<?php if ($asset_list->AssetCode->Visible) { // AssetCode ?>
	<?php
		$asset_list->SearchColumnCount++;
		if (($asset_list->SearchColumnCount - 1) % $asset_list->SearchFieldsPerRow == 0) {
			$asset_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $asset_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_AssetCode" class="ew-cell form-group">
		<label for="x_AssetCode" class="ew-search-caption ew-label"><?php echo $asset_list->AssetCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AssetCode" id="z_AssetCode" value="LIKE">
</span>
		<span id="el_asset_AssetCode" class="ew-search-field">
<input type="text" data-table="asset" data-field="x_AssetCode" name="x_AssetCode" id="x_AssetCode" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_list->AssetCode->getPlaceHolder()) ?>" value="<?php echo $asset_list->AssetCode->EditValue ?>"<?php echo $asset_list->AssetCode->editAttributes() ?>>
</span>
	</div>
	<?php if ($asset_list->SearchColumnCount % $asset_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php
		$asset_list->SearchColumnCount++;
		if (($asset_list->SearchColumnCount - 1) % $asset_list->SearchFieldsPerRow == 0) {
			$asset_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $asset_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ProvinceCode" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $asset_list->ProvinceCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		<span id="el_asset_ProvinceCode" class="ew-search-field">
<?php
$onchange = $asset_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$asset_list->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProvinceCode">
	<input type="text" class="form-control" name="sv_x_ProvinceCode" id="sv_x_ProvinceCode" value="<?php echo RemoveHtml($asset_list->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($asset_list->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($asset_list->ProvinceCode->getPlaceHolder()) ?>"<?php echo $asset_list->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" data-value-separator="<?php echo $asset_list->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo HtmlEncode($asset_list->ProvinceCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassetlistsrch"], function() {
	fassetlistsrch.createAutoSuggest({"id":"x_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $asset_list->ProvinceCode->Lookup->getParamTag($asset_list, "p_x_ProvinceCode") ?>
</span>
	</div>
	<?php if ($asset_list->SearchColumnCount % $asset_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->LACode->Visible) { // LACode ?>
	<?php
		$asset_list->SearchColumnCount++;
		if (($asset_list->SearchColumnCount - 1) % $asset_list->SearchFieldsPerRow == 0) {
			$asset_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $asset_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LACode" class="ew-cell form-group">
		<label for="x_LACode" class="ew-search-caption ew-label"><?php echo $asset_list->LACode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="=">
</span>
		<span id="el_asset_LACode" class="ew-search-field">
<?php $asset_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_LACode" data-value-separator="<?php echo $asset_list->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $asset_list->LACode->editAttributes() ?>>
			<?php echo $asset_list->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $asset_list->LACode->Lookup->getParamTag($asset_list, "p_x_LACode") ?>
</span>
	</div>
	<?php if ($asset_list->SearchColumnCount % $asset_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php
		$asset_list->SearchColumnCount++;
		if (($asset_list->SearchColumnCount - 1) % $asset_list->SearchFieldsPerRow == 0) {
			$asset_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $asset_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_DepartmentCode" class="ew-cell form-group">
		<label for="x_DepartmentCode" class="ew-search-caption ew-label"><?php echo $asset_list->DepartmentCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		<span id="el_asset_DepartmentCode" class="ew-search-field">
<?php $asset_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_DepartmentCode" data-value-separator="<?php echo $asset_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $asset_list->DepartmentCode->editAttributes() ?>>
			<?php echo $asset_list->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $asset_list->DepartmentCode->Lookup->getParamTag($asset_list, "p_x_DepartmentCode") ?>
</span>
	</div>
	<?php if ($asset_list->SearchColumnCount % $asset_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->SectionCode->Visible) { // SectionCode ?>
	<?php
		$asset_list->SearchColumnCount++;
		if (($asset_list->SearchColumnCount - 1) % $asset_list->SearchFieldsPerRow == 0) {
			$asset_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $asset_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_SectionCode" class="ew-cell form-group">
		<label for="x_SectionCode" class="ew-search-caption ew-label"><?php echo $asset_list->SectionCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		<span id="el_asset_SectionCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_SectionCode" data-value-separator="<?php echo $asset_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $asset_list->SectionCode->editAttributes() ?>>
			<?php echo $asset_list->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $asset_list->SectionCode->Lookup->getParamTag($asset_list, "p_x_SectionCode") ?>
</span>
	</div>
	<?php if ($asset_list->SearchColumnCount % $asset_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->AssetTypeCode->Visible) { // AssetTypeCode ?>
	<?php
		$asset_list->SearchColumnCount++;
		if (($asset_list->SearchColumnCount - 1) % $asset_list->SearchFieldsPerRow == 0) {
			$asset_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $asset_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_AssetTypeCode" class="ew-cell form-group">
		<label for="x_AssetTypeCode" class="ew-search-caption ew-label"><?php echo $asset_list->AssetTypeCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AssetTypeCode" id="z_AssetTypeCode" value="=">
</span>
		<span id="el_asset_AssetTypeCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetTypeCode" data-value-separator="<?php echo $asset_list->AssetTypeCode->displayValueSeparatorAttribute() ?>" id="x_AssetTypeCode" name="x_AssetTypeCode"<?php echo $asset_list->AssetTypeCode->editAttributes() ?>>
			<?php echo $asset_list->AssetTypeCode->selectOptionListHtml("x_AssetTypeCode") ?>
		</select>
</div>
<?php echo $asset_list->AssetTypeCode->Lookup->getParamTag($asset_list, "p_x_AssetTypeCode") ?>
</span>
	</div>
	<?php if ($asset_list->SearchColumnCount % $asset_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->ConditionCode->Visible) { // ConditionCode ?>
	<?php
		$asset_list->SearchColumnCount++;
		if (($asset_list->SearchColumnCount - 1) % $asset_list->SearchFieldsPerRow == 0) {
			$asset_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $asset_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ConditionCode" class="ew-cell form-group">
		<label for="x_ConditionCode" class="ew-search-caption ew-label"><?php echo $asset_list->ConditionCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ConditionCode" id="z_ConditionCode" value="=">
</span>
		<span id="el_asset_ConditionCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_ConditionCode" data-value-separator="<?php echo $asset_list->ConditionCode->displayValueSeparatorAttribute() ?>" id="x_ConditionCode" name="x_ConditionCode"<?php echo $asset_list->ConditionCode->editAttributes() ?>>
			<?php echo $asset_list->ConditionCode->selectOptionListHtml("x_ConditionCode") ?>
		</select>
</div>
<?php echo $asset_list->ConditionCode->Lookup->getParamTag($asset_list, "p_x_ConditionCode") ?>
</span>
	</div>
	<?php if ($asset_list->SearchColumnCount % $asset_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($asset_list->SearchColumnCount % $asset_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $asset_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($asset_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($asset_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $asset_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($asset_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($asset_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($asset_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($asset_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $asset_list->showPageHeader(); ?>
<?php
$asset_list->showMessage();
?>
<?php if ($asset_list->TotalRecords > 0 || $asset->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($asset_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> asset">
<?php if (!$asset_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$asset_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $asset_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $asset_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fassetlist" id="fassetlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asset">
<?php if ($asset->getCurrentMasterTable() == "local_authority" && $asset->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($asset_list->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($asset_list->LACode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_asset" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($asset_list->TotalRecords > 0 || $asset_list->isGridEdit()) { ?>
<table id="tbl_assetlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$asset->RowType = ROWTYPE_HEADER;

// Render list options
$asset_list->renderListOptions();

// Render list options (header, left)
$asset_list->ListOptions->render("header", "left");
?>
<?php if ($asset_list->AssetCode->Visible) { // AssetCode ?>
	<?php if ($asset_list->SortUrl($asset_list->AssetCode) == "") { ?>
		<th data-name="AssetCode" class="<?php echo $asset_list->AssetCode->headerCellClass() ?>"><div id="elh_asset_AssetCode" class="asset_AssetCode"><div class="ew-table-header-caption"><?php echo $asset_list->AssetCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetCode" class="<?php echo $asset_list->AssetCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->AssetCode) ?>', 1);"><div id="elh_asset_AssetCode" class="asset_AssetCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->AssetCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($asset_list->AssetCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->AssetCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($asset_list->SortUrl($asset_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $asset_list->ProvinceCode->headerCellClass() ?>"><div id="elh_asset_ProvinceCode" class="asset_ProvinceCode"><div class="ew-table-header-caption"><?php echo $asset_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $asset_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->ProvinceCode) ?>', 1);"><div id="elh_asset_ProvinceCode" class="asset_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->LACode->Visible) { // LACode ?>
	<?php if ($asset_list->SortUrl($asset_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $asset_list->LACode->headerCellClass() ?>"><div id="elh_asset_LACode" class="asset_LACode"><div class="ew-table-header-caption"><?php echo $asset_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $asset_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->LACode) ?>', 1);"><div id="elh_asset_LACode" class="asset_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($asset_list->SortUrl($asset_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $asset_list->DepartmentCode->headerCellClass() ?>"><div id="elh_asset_DepartmentCode" class="asset_DepartmentCode"><div class="ew-table-header-caption"><?php echo $asset_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $asset_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->DepartmentCode) ?>', 1);"><div id="elh_asset_DepartmentCode" class="asset_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($asset_list->SortUrl($asset_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $asset_list->SectionCode->headerCellClass() ?>"><div id="elh_asset_SectionCode" class="asset_SectionCode"><div class="ew-table-header-caption"><?php echo $asset_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $asset_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->SectionCode) ?>', 1);"><div id="elh_asset_SectionCode" class="asset_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->AssetTypeCode->Visible) { // AssetTypeCode ?>
	<?php if ($asset_list->SortUrl($asset_list->AssetTypeCode) == "") { ?>
		<th data-name="AssetTypeCode" class="<?php echo $asset_list->AssetTypeCode->headerCellClass() ?>"><div id="elh_asset_AssetTypeCode" class="asset_AssetTypeCode"><div class="ew-table-header-caption"><?php echo $asset_list->AssetTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetTypeCode" class="<?php echo $asset_list->AssetTypeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->AssetTypeCode) ?>', 1);"><div id="elh_asset_AssetTypeCode" class="asset_AssetTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->AssetTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->AssetTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->AssetTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->Supplier->Visible) { // Supplier ?>
	<?php if ($asset_list->SortUrl($asset_list->Supplier) == "") { ?>
		<th data-name="Supplier" class="<?php echo $asset_list->Supplier->headerCellClass() ?>"><div id="elh_asset_Supplier" class="asset_Supplier"><div class="ew-table-header-caption"><?php echo $asset_list->Supplier->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Supplier" class="<?php echo $asset_list->Supplier->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->Supplier) ?>', 1);"><div id="elh_asset_Supplier" class="asset_Supplier">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->Supplier->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($asset_list->Supplier->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->Supplier->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->PurchasePrice->Visible) { // PurchasePrice ?>
	<?php if ($asset_list->SortUrl($asset_list->PurchasePrice) == "") { ?>
		<th data-name="PurchasePrice" class="<?php echo $asset_list->PurchasePrice->headerCellClass() ?>"><div id="elh_asset_PurchasePrice" class="asset_PurchasePrice"><div class="ew-table-header-caption"><?php echo $asset_list->PurchasePrice->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PurchasePrice" class="<?php echo $asset_list->PurchasePrice->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->PurchasePrice) ?>', 1);"><div id="elh_asset_PurchasePrice" class="asset_PurchasePrice">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->PurchasePrice->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->PurchasePrice->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->PurchasePrice->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->CurrencyCode->Visible) { // CurrencyCode ?>
	<?php if ($asset_list->SortUrl($asset_list->CurrencyCode) == "") { ?>
		<th data-name="CurrencyCode" class="<?php echo $asset_list->CurrencyCode->headerCellClass() ?>"><div id="elh_asset_CurrencyCode" class="asset_CurrencyCode"><div class="ew-table-header-caption"><?php echo $asset_list->CurrencyCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrencyCode" class="<?php echo $asset_list->CurrencyCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->CurrencyCode) ?>', 1);"><div id="elh_asset_CurrencyCode" class="asset_CurrencyCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->CurrencyCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->CurrencyCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->CurrencyCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->ConditionCode->Visible) { // ConditionCode ?>
	<?php if ($asset_list->SortUrl($asset_list->ConditionCode) == "") { ?>
		<th data-name="ConditionCode" class="<?php echo $asset_list->ConditionCode->headerCellClass() ?>"><div id="elh_asset_ConditionCode" class="asset_ConditionCode"><div class="ew-table-header-caption"><?php echo $asset_list->ConditionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ConditionCode" class="<?php echo $asset_list->ConditionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->ConditionCode) ?>', 1);"><div id="elh_asset_ConditionCode" class="asset_ConditionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->ConditionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->ConditionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->ConditionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->DateOfPurchase->Visible) { // DateOfPurchase ?>
	<?php if ($asset_list->SortUrl($asset_list->DateOfPurchase) == "") { ?>
		<th data-name="DateOfPurchase" class="<?php echo $asset_list->DateOfPurchase->headerCellClass() ?>"><div id="elh_asset_DateOfPurchase" class="asset_DateOfPurchase"><div class="ew-table-header-caption"><?php echo $asset_list->DateOfPurchase->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfPurchase" class="<?php echo $asset_list->DateOfPurchase->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->DateOfPurchase) ?>', 1);"><div id="elh_asset_DateOfPurchase" class="asset_DateOfPurchase">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->DateOfPurchase->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->DateOfPurchase->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->DateOfPurchase->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->AssetCapacity->Visible) { // AssetCapacity ?>
	<?php if ($asset_list->SortUrl($asset_list->AssetCapacity) == "") { ?>
		<th data-name="AssetCapacity" class="<?php echo $asset_list->AssetCapacity->headerCellClass() ?>"><div id="elh_asset_AssetCapacity" class="asset_AssetCapacity"><div class="ew-table-header-caption"><?php echo $asset_list->AssetCapacity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetCapacity" class="<?php echo $asset_list->AssetCapacity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->AssetCapacity) ?>', 1);"><div id="elh_asset_AssetCapacity" class="asset_AssetCapacity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->AssetCapacity->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->AssetCapacity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->AssetCapacity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($asset_list->SortUrl($asset_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $asset_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_asset_UnitOfMeasure" class="asset_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $asset_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $asset_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->UnitOfMeasure) ?>', 1);"><div id="elh_asset_UnitOfMeasure" class="asset_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->AssetDescription->Visible) { // AssetDescription ?>
	<?php if ($asset_list->SortUrl($asset_list->AssetDescription) == "") { ?>
		<th data-name="AssetDescription" class="<?php echo $asset_list->AssetDescription->headerCellClass() ?>"><div id="elh_asset_AssetDescription" class="asset_AssetDescription"><div class="ew-table-header-caption"><?php echo $asset_list->AssetDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetDescription" class="<?php echo $asset_list->AssetDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->AssetDescription) ?>', 1);"><div id="elh_asset_AssetDescription" class="asset_AssetDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->AssetDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($asset_list->AssetDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->AssetDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
	<?php if ($asset_list->SortUrl($asset_list->DateOfLastRevaluation) == "") { ?>
		<th data-name="DateOfLastRevaluation" class="<?php echo $asset_list->DateOfLastRevaluation->headerCellClass() ?>"><div id="elh_asset_DateOfLastRevaluation" class="asset_DateOfLastRevaluation"><div class="ew-table-header-caption"><?php echo $asset_list->DateOfLastRevaluation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfLastRevaluation" class="<?php echo $asset_list->DateOfLastRevaluation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->DateOfLastRevaluation) ?>', 1);"><div id="elh_asset_DateOfLastRevaluation" class="asset_DateOfLastRevaluation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->DateOfLastRevaluation->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->DateOfLastRevaluation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->DateOfLastRevaluation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->NewValue->Visible) { // NewValue ?>
	<?php if ($asset_list->SortUrl($asset_list->NewValue) == "") { ?>
		<th data-name="NewValue" class="<?php echo $asset_list->NewValue->headerCellClass() ?>"><div id="elh_asset_NewValue" class="asset_NewValue"><div class="ew-table-header-caption"><?php echo $asset_list->NewValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NewValue" class="<?php echo $asset_list->NewValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->NewValue) ?>', 1);"><div id="elh_asset_NewValue" class="asset_NewValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->NewValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->NewValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->NewValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->NameOfValuer->Visible) { // NameOfValuer ?>
	<?php if ($asset_list->SortUrl($asset_list->NameOfValuer) == "") { ?>
		<th data-name="NameOfValuer" class="<?php echo $asset_list->NameOfValuer->headerCellClass() ?>"><div id="elh_asset_NameOfValuer" class="asset_NameOfValuer"><div class="ew-table-header-caption"><?php echo $asset_list->NameOfValuer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NameOfValuer" class="<?php echo $asset_list->NameOfValuer->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->NameOfValuer) ?>', 1);"><div id="elh_asset_NameOfValuer" class="asset_NameOfValuer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->NameOfValuer->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($asset_list->NameOfValuer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->NameOfValuer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->BookValue->Visible) { // BookValue ?>
	<?php if ($asset_list->SortUrl($asset_list->BookValue) == "") { ?>
		<th data-name="BookValue" class="<?php echo $asset_list->BookValue->headerCellClass() ?>"><div id="elh_asset_BookValue" class="asset_BookValue"><div class="ew-table-header-caption"><?php echo $asset_list->BookValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BookValue" class="<?php echo $asset_list->BookValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->BookValue) ?>', 1);"><div id="elh_asset_BookValue" class="asset_BookValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->BookValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->BookValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->BookValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
	<?php if ($asset_list->SortUrl($asset_list->LastDepreciationDate) == "") { ?>
		<th data-name="LastDepreciationDate" class="<?php echo $asset_list->LastDepreciationDate->headerCellClass() ?>"><div id="elh_asset_LastDepreciationDate" class="asset_LastDepreciationDate"><div class="ew-table-header-caption"><?php echo $asset_list->LastDepreciationDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastDepreciationDate" class="<?php echo $asset_list->LastDepreciationDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->LastDepreciationDate) ?>', 1);"><div id="elh_asset_LastDepreciationDate" class="asset_LastDepreciationDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->LastDepreciationDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->LastDepreciationDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->LastDepreciationDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
	<?php if ($asset_list->SortUrl($asset_list->LastDepreciationAmount) == "") { ?>
		<th data-name="LastDepreciationAmount" class="<?php echo $asset_list->LastDepreciationAmount->headerCellClass() ?>"><div id="elh_asset_LastDepreciationAmount" class="asset_LastDepreciationAmount"><div class="ew-table-header-caption"><?php echo $asset_list->LastDepreciationAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastDepreciationAmount" class="<?php echo $asset_list->LastDepreciationAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->LastDepreciationAmount) ?>', 1);"><div id="elh_asset_LastDepreciationAmount" class="asset_LastDepreciationAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->LastDepreciationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->LastDepreciationAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->LastDepreciationAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->DepreciationRate->Visible) { // DepreciationRate ?>
	<?php if ($asset_list->SortUrl($asset_list->DepreciationRate) == "") { ?>
		<th data-name="DepreciationRate" class="<?php echo $asset_list->DepreciationRate->headerCellClass() ?>"><div id="elh_asset_DepreciationRate" class="asset_DepreciationRate"><div class="ew-table-header-caption"><?php echo $asset_list->DepreciationRate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepreciationRate" class="<?php echo $asset_list->DepreciationRate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->DepreciationRate) ?>', 1);"><div id="elh_asset_DepreciationRate" class="asset_DepreciationRate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->DepreciationRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->DepreciationRate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->DepreciationRate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
	<?php if ($asset_list->SortUrl($asset_list->CumulativeDepreciation) == "") { ?>
		<th data-name="CumulativeDepreciation" class="<?php echo $asset_list->CumulativeDepreciation->headerCellClass() ?>"><div id="elh_asset_CumulativeDepreciation" class="asset_CumulativeDepreciation"><div class="ew-table-header-caption"><?php echo $asset_list->CumulativeDepreciation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CumulativeDepreciation" class="<?php echo $asset_list->CumulativeDepreciation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->CumulativeDepreciation) ?>', 1);"><div id="elh_asset_CumulativeDepreciation" class="asset_CumulativeDepreciation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->CumulativeDepreciation->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->CumulativeDepreciation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->CumulativeDepreciation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->AssetStatus->Visible) { // AssetStatus ?>
	<?php if ($asset_list->SortUrl($asset_list->AssetStatus) == "") { ?>
		<th data-name="AssetStatus" class="<?php echo $asset_list->AssetStatus->headerCellClass() ?>"><div id="elh_asset_AssetStatus" class="asset_AssetStatus"><div class="ew-table-header-caption"><?php echo $asset_list->AssetStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AssetStatus" class="<?php echo $asset_list->AssetStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->AssetStatus) ?>', 1);"><div id="elh_asset_AssetStatus" class="asset_AssetStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->AssetStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->AssetStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->AssetStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($asset_list->ScrapValue->Visible) { // ScrapValue ?>
	<?php if ($asset_list->SortUrl($asset_list->ScrapValue) == "") { ?>
		<th data-name="ScrapValue" class="<?php echo $asset_list->ScrapValue->headerCellClass() ?>"><div id="elh_asset_ScrapValue" class="asset_ScrapValue"><div class="ew-table-header-caption"><?php echo $asset_list->ScrapValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ScrapValue" class="<?php echo $asset_list->ScrapValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $asset_list->SortUrl($asset_list->ScrapValue) ?>', 1);"><div id="elh_asset_ScrapValue" class="asset_ScrapValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $asset_list->ScrapValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($asset_list->ScrapValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($asset_list->ScrapValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$asset_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($asset_list->ExportAll && $asset_list->isExport()) {
	$asset_list->StopRecord = $asset_list->TotalRecords;
} else {

	// Set the last record to display
	if ($asset_list->TotalRecords > $asset_list->StartRecord + $asset_list->DisplayRecords - 1)
		$asset_list->StopRecord = $asset_list->StartRecord + $asset_list->DisplayRecords - 1;
	else
		$asset_list->StopRecord = $asset_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($asset->isConfirm() || $asset_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($asset_list->FormKeyCountName) && ($asset_list->isGridAdd() || $asset_list->isGridEdit() || $asset->isConfirm())) {
		$asset_list->KeyCount = $CurrentForm->getValue($asset_list->FormKeyCountName);
		$asset_list->StopRecord = $asset_list->StartRecord + $asset_list->KeyCount - 1;
	}
}
$asset_list->RecordCount = $asset_list->StartRecord - 1;
if ($asset_list->Recordset && !$asset_list->Recordset->EOF) {
	$asset_list->Recordset->moveFirst();
	$selectLimit = $asset_list->UseSelectLimit;
	if (!$selectLimit && $asset_list->StartRecord > 1)
		$asset_list->Recordset->move($asset_list->StartRecord - 1);
} elseif (!$asset->AllowAddDeleteRow && $asset_list->StopRecord == 0) {
	$asset_list->StopRecord = $asset->GridAddRowCount;
}

// Initialize aggregate
$asset->RowType = ROWTYPE_AGGREGATEINIT;
$asset->resetAttributes();
$asset_list->renderRow();
if ($asset_list->isGridAdd())
	$asset_list->RowIndex = 0;
if ($asset_list->isGridEdit())
	$asset_list->RowIndex = 0;
while ($asset_list->RecordCount < $asset_list->StopRecord) {
	$asset_list->RecordCount++;
	if ($asset_list->RecordCount >= $asset_list->StartRecord) {
		$asset_list->RowCount++;
		if ($asset_list->isGridAdd() || $asset_list->isGridEdit() || $asset->isConfirm()) {
			$asset_list->RowIndex++;
			$CurrentForm->Index = $asset_list->RowIndex;
			if ($CurrentForm->hasValue($asset_list->FormActionName) && ($asset->isConfirm() || $asset_list->EventCancelled))
				$asset_list->RowAction = strval($CurrentForm->getValue($asset_list->FormActionName));
			elseif ($asset_list->isGridAdd())
				$asset_list->RowAction = "insert";
			else
				$asset_list->RowAction = "";
		}

		// Set up key count
		$asset_list->KeyCount = $asset_list->RowIndex;

		// Init row class and style
		$asset->resetAttributes();
		$asset->CssClass = "";
		if ($asset_list->isGridAdd()) {
			$asset_list->loadRowValues(); // Load default values
		} else {
			$asset_list->loadRowValues($asset_list->Recordset); // Load row values
		}
		$asset->RowType = ROWTYPE_VIEW; // Render view
		if ($asset_list->isGridAdd()) // Grid add
			$asset->RowType = ROWTYPE_ADD; // Render add
		if ($asset_list->isGridAdd() && $asset->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$asset_list->restoreCurrentRowFormValues($asset_list->RowIndex); // Restore form values
		if ($asset_list->isGridEdit()) { // Grid edit
			if ($asset->EventCancelled)
				$asset_list->restoreCurrentRowFormValues($asset_list->RowIndex); // Restore form values
			if ($asset_list->RowAction == "insert")
				$asset->RowType = ROWTYPE_ADD; // Render add
			else
				$asset->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($asset_list->isGridEdit() && ($asset->RowType == ROWTYPE_EDIT || $asset->RowType == ROWTYPE_ADD) && $asset->EventCancelled) // Update failed
			$asset_list->restoreCurrentRowFormValues($asset_list->RowIndex); // Restore form values
		if ($asset->RowType == ROWTYPE_EDIT) // Edit row
			$asset_list->EditRowCount++;

		// Set up row id / data-rowindex
		$asset->RowAttrs->merge(["data-rowindex" => $asset_list->RowCount, "id" => "r" . $asset_list->RowCount . "_asset", "data-rowtype" => $asset->RowType]);

		// Render row
		$asset_list->renderRow();

		// Render list options
		$asset_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($asset_list->RowAction != "delete" && $asset_list->RowAction != "insertdelete" && !($asset_list->RowAction == "insert" && $asset->isConfirm() && $asset_list->emptyRow())) {
?>
	<tr <?php echo $asset->rowAttributes() ?>>
<?php

// Render list options (body, left)
$asset_list->ListOptions->render("body", "left", $asset_list->RowCount);
?>
	<?php if ($asset_list->AssetCode->Visible) { // AssetCode ?>
		<td data-name="AssetCode" <?php echo $asset_list->AssetCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetCode" class="form-group">
<input type="text" data-table="asset" data-field="x_AssetCode" name="x<?php echo $asset_list->RowIndex ?>_AssetCode" id="x<?php echo $asset_list->RowIndex ?>_AssetCode" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_list->AssetCode->getPlaceHolder()) ?>" value="<?php echo $asset_list->AssetCode->EditValue ?>"<?php echo $asset_list->AssetCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetCode" name="o<?php echo $asset_list->RowIndex ?>_AssetCode" id="o<?php echo $asset_list->RowIndex ?>_AssetCode" value="<?php echo HtmlEncode($asset_list->AssetCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="asset" data-field="x_AssetCode" name="x<?php echo $asset_list->RowIndex ?>_AssetCode" id="x<?php echo $asset_list->RowIndex ?>_AssetCode" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_list->AssetCode->getPlaceHolder()) ?>" value="<?php echo $asset_list->AssetCode->EditValue ?>"<?php echo $asset_list->AssetCode->editAttributes() ?>>
<input type="hidden" data-table="asset" data-field="x_AssetCode" name="o<?php echo $asset_list->RowIndex ?>_AssetCode" id="o<?php echo $asset_list->RowIndex ?>_AssetCode" value="<?php echo HtmlEncode($asset_list->AssetCode->OldValue != null ? $asset_list->AssetCode->OldValue : $asset_list->AssetCode->CurrentValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetCode">
<span<?php echo $asset_list->AssetCode->viewAttributes() ?>><?php echo $asset_list->AssetCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $asset_list->ProvinceCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($asset_list->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_ProvinceCode" class="form-group">
<span<?php echo $asset_list->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_list->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $asset_list->RowIndex ?>_ProvinceCode" name="x<?php echo $asset_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_list->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_ProvinceCode" class="form-group">
<?php
$onchange = $asset_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$asset_list->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $asset_list->RowIndex ?>_ProvinceCode">
	<input type="text" class="form-control" name="sv_x<?php echo $asset_list->RowIndex ?>_ProvinceCode" id="sv_x<?php echo $asset_list->RowIndex ?>_ProvinceCode" value="<?php echo RemoveHtml($asset_list->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($asset_list->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($asset_list->ProvinceCode->getPlaceHolder()) ?>"<?php echo $asset_list->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" data-value-separator="<?php echo $asset_list->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $asset_list->RowIndex ?>_ProvinceCode" id="x<?php echo $asset_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_list->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassetlist"], function() {
	fassetlist.createAutoSuggest({"id":"x<?php echo $asset_list->RowIndex ?>_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $asset_list->ProvinceCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" name="o<?php echo $asset_list->RowIndex ?>_ProvinceCode" id="o<?php echo $asset_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_list->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($asset_list->ProvinceCode->getSessionValue() != "") { ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_ProvinceCode" class="form-group">
<span<?php echo $asset_list->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_list->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $asset_list->RowIndex ?>_ProvinceCode" name="x<?php echo $asset_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_list->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_ProvinceCode" class="form-group">
<?php
$onchange = $asset_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$asset_list->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $asset_list->RowIndex ?>_ProvinceCode">
	<input type="text" class="form-control" name="sv_x<?php echo $asset_list->RowIndex ?>_ProvinceCode" id="sv_x<?php echo $asset_list->RowIndex ?>_ProvinceCode" value="<?php echo RemoveHtml($asset_list->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($asset_list->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($asset_list->ProvinceCode->getPlaceHolder()) ?>"<?php echo $asset_list->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" data-value-separator="<?php echo $asset_list->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $asset_list->RowIndex ?>_ProvinceCode" id="x<?php echo $asset_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_list->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassetlist"], function() {
	fassetlist.createAutoSuggest({"id":"x<?php echo $asset_list->RowIndex ?>_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $asset_list->ProvinceCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_ProvinceCode">
<span<?php echo $asset_list->ProvinceCode->viewAttributes() ?>><?php echo $asset_list->ProvinceCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $asset_list->LACode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($asset_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_LACode" class="form-group">
<span<?php echo $asset_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $asset_list->RowIndex ?>_LACode" name="x<?php echo $asset_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_LACode" class="form-group">
<?php $asset_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_LACode" data-value-separator="<?php echo $asset_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_LACode" name="x<?php echo $asset_list->RowIndex ?>_LACode"<?php echo $asset_list->LACode->editAttributes() ?>>
			<?php echo $asset_list->LACode->selectOptionListHtml("x{$asset_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $asset_list->LACode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_LACode" name="o<?php echo $asset_list->RowIndex ?>_LACode" id="o<?php echo $asset_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($asset_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_LACode" class="form-group">
<span<?php echo $asset_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $asset_list->RowIndex ?>_LACode" name="x<?php echo $asset_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_LACode" class="form-group">
<?php $asset_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_LACode" data-value-separator="<?php echo $asset_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_LACode" name="x<?php echo $asset_list->RowIndex ?>_LACode"<?php echo $asset_list->LACode->editAttributes() ?>>
			<?php echo $asset_list->LACode->selectOptionListHtml("x{$asset_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $asset_list->LACode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_LACode">
<span<?php echo $asset_list->LACode->viewAttributes() ?>><?php echo $asset_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $asset_list->DepartmentCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_DepartmentCode" class="form-group">
<?php $asset_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_DepartmentCode" data-value-separator="<?php echo $asset_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_DepartmentCode" name="x<?php echo $asset_list->RowIndex ?>_DepartmentCode"<?php echo $asset_list->DepartmentCode->editAttributes() ?>>
			<?php echo $asset_list->DepartmentCode->selectOptionListHtml("x{$asset_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $asset_list->DepartmentCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_DepartmentCode" name="o<?php echo $asset_list->RowIndex ?>_DepartmentCode" id="o<?php echo $asset_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($asset_list->DepartmentCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_DepartmentCode" class="form-group">
<?php $asset_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_DepartmentCode" data-value-separator="<?php echo $asset_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_DepartmentCode" name="x<?php echo $asset_list->RowIndex ?>_DepartmentCode"<?php echo $asset_list->DepartmentCode->editAttributes() ?>>
			<?php echo $asset_list->DepartmentCode->selectOptionListHtml("x{$asset_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $asset_list->DepartmentCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_DepartmentCode") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_DepartmentCode">
<span<?php echo $asset_list->DepartmentCode->viewAttributes() ?>><?php echo $asset_list->DepartmentCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $asset_list->SectionCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_SectionCode" data-value-separator="<?php echo $asset_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_SectionCode" name="x<?php echo $asset_list->RowIndex ?>_SectionCode"<?php echo $asset_list->SectionCode->editAttributes() ?>>
			<?php echo $asset_list->SectionCode->selectOptionListHtml("x{$asset_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $asset_list->SectionCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_SectionCode" name="o<?php echo $asset_list->RowIndex ?>_SectionCode" id="o<?php echo $asset_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($asset_list->SectionCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_SectionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_SectionCode" data-value-separator="<?php echo $asset_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_SectionCode" name="x<?php echo $asset_list->RowIndex ?>_SectionCode"<?php echo $asset_list->SectionCode->editAttributes() ?>>
			<?php echo $asset_list->SectionCode->selectOptionListHtml("x{$asset_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $asset_list->SectionCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_SectionCode") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_SectionCode">
<span<?php echo $asset_list->SectionCode->viewAttributes() ?>><?php echo $asset_list->SectionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->AssetTypeCode->Visible) { // AssetTypeCode ?>
		<td data-name="AssetTypeCode" <?php echo $asset_list->AssetTypeCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetTypeCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetTypeCode" data-value-separator="<?php echo $asset_list->AssetTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_AssetTypeCode" name="x<?php echo $asset_list->RowIndex ?>_AssetTypeCode"<?php echo $asset_list->AssetTypeCode->editAttributes() ?>>
			<?php echo $asset_list->AssetTypeCode->selectOptionListHtml("x{$asset_list->RowIndex}_AssetTypeCode") ?>
		</select>
</div>
<?php echo $asset_list->AssetTypeCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_AssetTypeCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetTypeCode" name="o<?php echo $asset_list->RowIndex ?>_AssetTypeCode" id="o<?php echo $asset_list->RowIndex ?>_AssetTypeCode" value="<?php echo HtmlEncode($asset_list->AssetTypeCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetTypeCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetTypeCode" data-value-separator="<?php echo $asset_list->AssetTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_AssetTypeCode" name="x<?php echo $asset_list->RowIndex ?>_AssetTypeCode"<?php echo $asset_list->AssetTypeCode->editAttributes() ?>>
			<?php echo $asset_list->AssetTypeCode->selectOptionListHtml("x{$asset_list->RowIndex}_AssetTypeCode") ?>
		</select>
</div>
<?php echo $asset_list->AssetTypeCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_AssetTypeCode") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetTypeCode">
<span<?php echo $asset_list->AssetTypeCode->viewAttributes() ?>><?php echo $asset_list->AssetTypeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->Supplier->Visible) { // Supplier ?>
		<td data-name="Supplier" <?php echo $asset_list->Supplier->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_Supplier" class="form-group">
<input type="text" data-table="asset" data-field="x_Supplier" name="x<?php echo $asset_list->RowIndex ?>_Supplier" id="x<?php echo $asset_list->RowIndex ?>_Supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($asset_list->Supplier->getPlaceHolder()) ?>" value="<?php echo $asset_list->Supplier->EditValue ?>"<?php echo $asset_list->Supplier->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_Supplier" name="o<?php echo $asset_list->RowIndex ?>_Supplier" id="o<?php echo $asset_list->RowIndex ?>_Supplier" value="<?php echo HtmlEncode($asset_list->Supplier->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_Supplier" class="form-group">
<input type="text" data-table="asset" data-field="x_Supplier" name="x<?php echo $asset_list->RowIndex ?>_Supplier" id="x<?php echo $asset_list->RowIndex ?>_Supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($asset_list->Supplier->getPlaceHolder()) ?>" value="<?php echo $asset_list->Supplier->EditValue ?>"<?php echo $asset_list->Supplier->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_Supplier">
<span<?php echo $asset_list->Supplier->viewAttributes() ?>><?php echo $asset_list->Supplier->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->PurchasePrice->Visible) { // PurchasePrice ?>
		<td data-name="PurchasePrice" <?php echo $asset_list->PurchasePrice->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_PurchasePrice" class="form-group">
<input type="text" data-table="asset" data-field="x_PurchasePrice" name="x<?php echo $asset_list->RowIndex ?>_PurchasePrice" id="x<?php echo $asset_list->RowIndex ?>_PurchasePrice" size="30" placeholder="<?php echo HtmlEncode($asset_list->PurchasePrice->getPlaceHolder()) ?>" value="<?php echo $asset_list->PurchasePrice->EditValue ?>"<?php echo $asset_list->PurchasePrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_PurchasePrice" name="o<?php echo $asset_list->RowIndex ?>_PurchasePrice" id="o<?php echo $asset_list->RowIndex ?>_PurchasePrice" value="<?php echo HtmlEncode($asset_list->PurchasePrice->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_PurchasePrice" class="form-group">
<input type="text" data-table="asset" data-field="x_PurchasePrice" name="x<?php echo $asset_list->RowIndex ?>_PurchasePrice" id="x<?php echo $asset_list->RowIndex ?>_PurchasePrice" size="30" placeholder="<?php echo HtmlEncode($asset_list->PurchasePrice->getPlaceHolder()) ?>" value="<?php echo $asset_list->PurchasePrice->EditValue ?>"<?php echo $asset_list->PurchasePrice->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_PurchasePrice">
<span<?php echo $asset_list->PurchasePrice->viewAttributes() ?>><?php echo $asset_list->PurchasePrice->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->CurrencyCode->Visible) { // CurrencyCode ?>
		<td data-name="CurrencyCode" <?php echo $asset_list->CurrencyCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_CurrencyCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_CurrencyCode" data-value-separator="<?php echo $asset_list->CurrencyCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_CurrencyCode" name="x<?php echo $asset_list->RowIndex ?>_CurrencyCode"<?php echo $asset_list->CurrencyCode->editAttributes() ?>>
			<?php echo $asset_list->CurrencyCode->selectOptionListHtml("x{$asset_list->RowIndex}_CurrencyCode") ?>
		</select>
</div>
<?php echo $asset_list->CurrencyCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_CurrencyCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_CurrencyCode" name="o<?php echo $asset_list->RowIndex ?>_CurrencyCode" id="o<?php echo $asset_list->RowIndex ?>_CurrencyCode" value="<?php echo HtmlEncode($asset_list->CurrencyCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_CurrencyCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_CurrencyCode" data-value-separator="<?php echo $asset_list->CurrencyCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_CurrencyCode" name="x<?php echo $asset_list->RowIndex ?>_CurrencyCode"<?php echo $asset_list->CurrencyCode->editAttributes() ?>>
			<?php echo $asset_list->CurrencyCode->selectOptionListHtml("x{$asset_list->RowIndex}_CurrencyCode") ?>
		</select>
</div>
<?php echo $asset_list->CurrencyCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_CurrencyCode") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_CurrencyCode">
<span<?php echo $asset_list->CurrencyCode->viewAttributes() ?>><?php echo $asset_list->CurrencyCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->ConditionCode->Visible) { // ConditionCode ?>
		<td data-name="ConditionCode" <?php echo $asset_list->ConditionCode->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_ConditionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_ConditionCode" data-value-separator="<?php echo $asset_list->ConditionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_ConditionCode" name="x<?php echo $asset_list->RowIndex ?>_ConditionCode"<?php echo $asset_list->ConditionCode->editAttributes() ?>>
			<?php echo $asset_list->ConditionCode->selectOptionListHtml("x{$asset_list->RowIndex}_ConditionCode") ?>
		</select>
</div>
<?php echo $asset_list->ConditionCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_ConditionCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_ConditionCode" name="o<?php echo $asset_list->RowIndex ?>_ConditionCode" id="o<?php echo $asset_list->RowIndex ?>_ConditionCode" value="<?php echo HtmlEncode($asset_list->ConditionCode->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_ConditionCode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_ConditionCode" data-value-separator="<?php echo $asset_list->ConditionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_ConditionCode" name="x<?php echo $asset_list->RowIndex ?>_ConditionCode"<?php echo $asset_list->ConditionCode->editAttributes() ?>>
			<?php echo $asset_list->ConditionCode->selectOptionListHtml("x{$asset_list->RowIndex}_ConditionCode") ?>
		</select>
</div>
<?php echo $asset_list->ConditionCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_ConditionCode") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_ConditionCode">
<span<?php echo $asset_list->ConditionCode->viewAttributes() ?>><?php echo $asset_list->ConditionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->DateOfPurchase->Visible) { // DateOfPurchase ?>
		<td data-name="DateOfPurchase" <?php echo $asset_list->DateOfPurchase->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_DateOfPurchase" class="form-group">
<input type="text" data-table="asset" data-field="x_DateOfPurchase" name="x<?php echo $asset_list->RowIndex ?>_DateOfPurchase" id="x<?php echo $asset_list->RowIndex ?>_DateOfPurchase" placeholder="<?php echo HtmlEncode($asset_list->DateOfPurchase->getPlaceHolder()) ?>" value="<?php echo $asset_list->DateOfPurchase->EditValue ?>"<?php echo $asset_list->DateOfPurchase->editAttributes() ?>>
<?php if (!$asset_list->DateOfPurchase->ReadOnly && !$asset_list->DateOfPurchase->Disabled && !isset($asset_list->DateOfPurchase->EditAttrs["readonly"]) && !isset($asset_list->DateOfPurchase->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetlist", "x<?php echo $asset_list->RowIndex ?>_DateOfPurchase", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="asset" data-field="x_DateOfPurchase" name="o<?php echo $asset_list->RowIndex ?>_DateOfPurchase" id="o<?php echo $asset_list->RowIndex ?>_DateOfPurchase" value="<?php echo HtmlEncode($asset_list->DateOfPurchase->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_DateOfPurchase" class="form-group">
<input type="text" data-table="asset" data-field="x_DateOfPurchase" name="x<?php echo $asset_list->RowIndex ?>_DateOfPurchase" id="x<?php echo $asset_list->RowIndex ?>_DateOfPurchase" placeholder="<?php echo HtmlEncode($asset_list->DateOfPurchase->getPlaceHolder()) ?>" value="<?php echo $asset_list->DateOfPurchase->EditValue ?>"<?php echo $asset_list->DateOfPurchase->editAttributes() ?>>
<?php if (!$asset_list->DateOfPurchase->ReadOnly && !$asset_list->DateOfPurchase->Disabled && !isset($asset_list->DateOfPurchase->EditAttrs["readonly"]) && !isset($asset_list->DateOfPurchase->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetlist", "x<?php echo $asset_list->RowIndex ?>_DateOfPurchase", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_DateOfPurchase">
<span<?php echo $asset_list->DateOfPurchase->viewAttributes() ?>><?php echo $asset_list->DateOfPurchase->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->AssetCapacity->Visible) { // AssetCapacity ?>
		<td data-name="AssetCapacity" <?php echo $asset_list->AssetCapacity->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetCapacity" class="form-group">
<input type="text" data-table="asset" data-field="x_AssetCapacity" name="x<?php echo $asset_list->RowIndex ?>_AssetCapacity" id="x<?php echo $asset_list->RowIndex ?>_AssetCapacity" size="30" placeholder="<?php echo HtmlEncode($asset_list->AssetCapacity->getPlaceHolder()) ?>" value="<?php echo $asset_list->AssetCapacity->EditValue ?>"<?php echo $asset_list->AssetCapacity->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetCapacity" name="o<?php echo $asset_list->RowIndex ?>_AssetCapacity" id="o<?php echo $asset_list->RowIndex ?>_AssetCapacity" value="<?php echo HtmlEncode($asset_list->AssetCapacity->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetCapacity" class="form-group">
<input type="text" data-table="asset" data-field="x_AssetCapacity" name="x<?php echo $asset_list->RowIndex ?>_AssetCapacity" id="x<?php echo $asset_list->RowIndex ?>_AssetCapacity" size="30" placeholder="<?php echo HtmlEncode($asset_list->AssetCapacity->getPlaceHolder()) ?>" value="<?php echo $asset_list->AssetCapacity->EditValue ?>"<?php echo $asset_list->AssetCapacity->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetCapacity">
<span<?php echo $asset_list->AssetCapacity->viewAttributes() ?>><?php echo $asset_list->AssetCapacity->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $asset_list->UnitOfMeasure->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_UnitOfMeasure" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $asset_list->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_UnitOfMeasure" name="x<?php echo $asset_list->RowIndex ?>_UnitOfMeasure"<?php echo $asset_list->UnitOfMeasure->editAttributes() ?>>
			<?php echo $asset_list->UnitOfMeasure->selectOptionListHtml("x{$asset_list->RowIndex}_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $asset_list->UnitOfMeasure->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_UnitOfMeasure") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_UnitOfMeasure" name="o<?php echo $asset_list->RowIndex ?>_UnitOfMeasure" id="o<?php echo $asset_list->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($asset_list->UnitOfMeasure->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_UnitOfMeasure" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $asset_list->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_UnitOfMeasure" name="x<?php echo $asset_list->RowIndex ?>_UnitOfMeasure"<?php echo $asset_list->UnitOfMeasure->editAttributes() ?>>
			<?php echo $asset_list->UnitOfMeasure->selectOptionListHtml("x{$asset_list->RowIndex}_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $asset_list->UnitOfMeasure->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_UnitOfMeasure") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_UnitOfMeasure">
<span<?php echo $asset_list->UnitOfMeasure->viewAttributes() ?>><?php echo $asset_list->UnitOfMeasure->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->AssetDescription->Visible) { // AssetDescription ?>
		<td data-name="AssetDescription" <?php echo $asset_list->AssetDescription->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetDescription" class="form-group">
<input type="text" data-table="asset" data-field="x_AssetDescription" name="x<?php echo $asset_list->RowIndex ?>_AssetDescription" id="x<?php echo $asset_list->RowIndex ?>_AssetDescription" size="50" maxlength="60" placeholder="<?php echo HtmlEncode($asset_list->AssetDescription->getPlaceHolder()) ?>" value="<?php echo $asset_list->AssetDescription->EditValue ?>"<?php echo $asset_list->AssetDescription->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetDescription" name="o<?php echo $asset_list->RowIndex ?>_AssetDescription" id="o<?php echo $asset_list->RowIndex ?>_AssetDescription" value="<?php echo HtmlEncode($asset_list->AssetDescription->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetDescription" class="form-group">
<input type="text" data-table="asset" data-field="x_AssetDescription" name="x<?php echo $asset_list->RowIndex ?>_AssetDescription" id="x<?php echo $asset_list->RowIndex ?>_AssetDescription" size="50" maxlength="60" placeholder="<?php echo HtmlEncode($asset_list->AssetDescription->getPlaceHolder()) ?>" value="<?php echo $asset_list->AssetDescription->EditValue ?>"<?php echo $asset_list->AssetDescription->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetDescription">
<span<?php echo $asset_list->AssetDescription->viewAttributes() ?>><?php echo $asset_list->AssetDescription->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
		<td data-name="DateOfLastRevaluation" <?php echo $asset_list->DateOfLastRevaluation->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_DateOfLastRevaluation" class="form-group">
<input type="text" data-table="asset" data-field="x_DateOfLastRevaluation" name="x<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation" id="x<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation" placeholder="<?php echo HtmlEncode($asset_list->DateOfLastRevaluation->getPlaceHolder()) ?>" value="<?php echo $asset_list->DateOfLastRevaluation->EditValue ?>"<?php echo $asset_list->DateOfLastRevaluation->editAttributes() ?>>
<?php if (!$asset_list->DateOfLastRevaluation->ReadOnly && !$asset_list->DateOfLastRevaluation->Disabled && !isset($asset_list->DateOfLastRevaluation->EditAttrs["readonly"]) && !isset($asset_list->DateOfLastRevaluation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetlist", "x<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="asset" data-field="x_DateOfLastRevaluation" name="o<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation" id="o<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation" value="<?php echo HtmlEncode($asset_list->DateOfLastRevaluation->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_DateOfLastRevaluation" class="form-group">
<input type="text" data-table="asset" data-field="x_DateOfLastRevaluation" name="x<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation" id="x<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation" placeholder="<?php echo HtmlEncode($asset_list->DateOfLastRevaluation->getPlaceHolder()) ?>" value="<?php echo $asset_list->DateOfLastRevaluation->EditValue ?>"<?php echo $asset_list->DateOfLastRevaluation->editAttributes() ?>>
<?php if (!$asset_list->DateOfLastRevaluation->ReadOnly && !$asset_list->DateOfLastRevaluation->Disabled && !isset($asset_list->DateOfLastRevaluation->EditAttrs["readonly"]) && !isset($asset_list->DateOfLastRevaluation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetlist", "x<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_DateOfLastRevaluation">
<span<?php echo $asset_list->DateOfLastRevaluation->viewAttributes() ?>><?php echo $asset_list->DateOfLastRevaluation->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->NewValue->Visible) { // NewValue ?>
		<td data-name="NewValue" <?php echo $asset_list->NewValue->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_NewValue" class="form-group">
<input type="text" data-table="asset" data-field="x_NewValue" name="x<?php echo $asset_list->RowIndex ?>_NewValue" id="x<?php echo $asset_list->RowIndex ?>_NewValue" size="30" placeholder="<?php echo HtmlEncode($asset_list->NewValue->getPlaceHolder()) ?>" value="<?php echo $asset_list->NewValue->EditValue ?>"<?php echo $asset_list->NewValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_NewValue" name="o<?php echo $asset_list->RowIndex ?>_NewValue" id="o<?php echo $asset_list->RowIndex ?>_NewValue" value="<?php echo HtmlEncode($asset_list->NewValue->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_NewValue" class="form-group">
<input type="text" data-table="asset" data-field="x_NewValue" name="x<?php echo $asset_list->RowIndex ?>_NewValue" id="x<?php echo $asset_list->RowIndex ?>_NewValue" size="30" placeholder="<?php echo HtmlEncode($asset_list->NewValue->getPlaceHolder()) ?>" value="<?php echo $asset_list->NewValue->EditValue ?>"<?php echo $asset_list->NewValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_NewValue">
<span<?php echo $asset_list->NewValue->viewAttributes() ?>><?php echo $asset_list->NewValue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->NameOfValuer->Visible) { // NameOfValuer ?>
		<td data-name="NameOfValuer" <?php echo $asset_list->NameOfValuer->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_NameOfValuer" class="form-group">
<input type="text" data-table="asset" data-field="x_NameOfValuer" name="x<?php echo $asset_list->RowIndex ?>_NameOfValuer" id="x<?php echo $asset_list->RowIndex ?>_NameOfValuer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($asset_list->NameOfValuer->getPlaceHolder()) ?>" value="<?php echo $asset_list->NameOfValuer->EditValue ?>"<?php echo $asset_list->NameOfValuer->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_NameOfValuer" name="o<?php echo $asset_list->RowIndex ?>_NameOfValuer" id="o<?php echo $asset_list->RowIndex ?>_NameOfValuer" value="<?php echo HtmlEncode($asset_list->NameOfValuer->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_NameOfValuer" class="form-group">
<input type="text" data-table="asset" data-field="x_NameOfValuer" name="x<?php echo $asset_list->RowIndex ?>_NameOfValuer" id="x<?php echo $asset_list->RowIndex ?>_NameOfValuer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($asset_list->NameOfValuer->getPlaceHolder()) ?>" value="<?php echo $asset_list->NameOfValuer->EditValue ?>"<?php echo $asset_list->NameOfValuer->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_NameOfValuer">
<span<?php echo $asset_list->NameOfValuer->viewAttributes() ?>><?php echo $asset_list->NameOfValuer->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->BookValue->Visible) { // BookValue ?>
		<td data-name="BookValue" <?php echo $asset_list->BookValue->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_BookValue" class="form-group">
<input type="text" data-table="asset" data-field="x_BookValue" name="x<?php echo $asset_list->RowIndex ?>_BookValue" id="x<?php echo $asset_list->RowIndex ?>_BookValue" size="30" placeholder="<?php echo HtmlEncode($asset_list->BookValue->getPlaceHolder()) ?>" value="<?php echo $asset_list->BookValue->EditValue ?>"<?php echo $asset_list->BookValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_BookValue" name="o<?php echo $asset_list->RowIndex ?>_BookValue" id="o<?php echo $asset_list->RowIndex ?>_BookValue" value="<?php echo HtmlEncode($asset_list->BookValue->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_BookValue" class="form-group">
<input type="text" data-table="asset" data-field="x_BookValue" name="x<?php echo $asset_list->RowIndex ?>_BookValue" id="x<?php echo $asset_list->RowIndex ?>_BookValue" size="30" placeholder="<?php echo HtmlEncode($asset_list->BookValue->getPlaceHolder()) ?>" value="<?php echo $asset_list->BookValue->EditValue ?>"<?php echo $asset_list->BookValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_BookValue">
<span<?php echo $asset_list->BookValue->viewAttributes() ?>><?php echo $asset_list->BookValue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
		<td data-name="LastDepreciationDate" <?php echo $asset_list->LastDepreciationDate->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_LastDepreciationDate" class="form-group">
<input type="text" data-table="asset" data-field="x_LastDepreciationDate" name="x<?php echo $asset_list->RowIndex ?>_LastDepreciationDate" id="x<?php echo $asset_list->RowIndex ?>_LastDepreciationDate" placeholder="<?php echo HtmlEncode($asset_list->LastDepreciationDate->getPlaceHolder()) ?>" value="<?php echo $asset_list->LastDepreciationDate->EditValue ?>"<?php echo $asset_list->LastDepreciationDate->editAttributes() ?>>
<?php if (!$asset_list->LastDepreciationDate->ReadOnly && !$asset_list->LastDepreciationDate->Disabled && !isset($asset_list->LastDepreciationDate->EditAttrs["readonly"]) && !isset($asset_list->LastDepreciationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetlist", "x<?php echo $asset_list->RowIndex ?>_LastDepreciationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationDate" name="o<?php echo $asset_list->RowIndex ?>_LastDepreciationDate" id="o<?php echo $asset_list->RowIndex ?>_LastDepreciationDate" value="<?php echo HtmlEncode($asset_list->LastDepreciationDate->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_LastDepreciationDate" class="form-group">
<input type="text" data-table="asset" data-field="x_LastDepreciationDate" name="x<?php echo $asset_list->RowIndex ?>_LastDepreciationDate" id="x<?php echo $asset_list->RowIndex ?>_LastDepreciationDate" placeholder="<?php echo HtmlEncode($asset_list->LastDepreciationDate->getPlaceHolder()) ?>" value="<?php echo $asset_list->LastDepreciationDate->EditValue ?>"<?php echo $asset_list->LastDepreciationDate->editAttributes() ?>>
<?php if (!$asset_list->LastDepreciationDate->ReadOnly && !$asset_list->LastDepreciationDate->Disabled && !isset($asset_list->LastDepreciationDate->EditAttrs["readonly"]) && !isset($asset_list->LastDepreciationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetlist", "x<?php echo $asset_list->RowIndex ?>_LastDepreciationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_LastDepreciationDate">
<span<?php echo $asset_list->LastDepreciationDate->viewAttributes() ?>><?php echo $asset_list->LastDepreciationDate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
		<td data-name="LastDepreciationAmount" <?php echo $asset_list->LastDepreciationAmount->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_LastDepreciationAmount" class="form-group">
<input type="text" data-table="asset" data-field="x_LastDepreciationAmount" name="x<?php echo $asset_list->RowIndex ?>_LastDepreciationAmount" id="x<?php echo $asset_list->RowIndex ?>_LastDepreciationAmount" size="30" placeholder="<?php echo HtmlEncode($asset_list->LastDepreciationAmount->getPlaceHolder()) ?>" value="<?php echo $asset_list->LastDepreciationAmount->EditValue ?>"<?php echo $asset_list->LastDepreciationAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationAmount" name="o<?php echo $asset_list->RowIndex ?>_LastDepreciationAmount" id="o<?php echo $asset_list->RowIndex ?>_LastDepreciationAmount" value="<?php echo HtmlEncode($asset_list->LastDepreciationAmount->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_LastDepreciationAmount" class="form-group">
<input type="text" data-table="asset" data-field="x_LastDepreciationAmount" name="x<?php echo $asset_list->RowIndex ?>_LastDepreciationAmount" id="x<?php echo $asset_list->RowIndex ?>_LastDepreciationAmount" size="30" placeholder="<?php echo HtmlEncode($asset_list->LastDepreciationAmount->getPlaceHolder()) ?>" value="<?php echo $asset_list->LastDepreciationAmount->EditValue ?>"<?php echo $asset_list->LastDepreciationAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_LastDepreciationAmount">
<span<?php echo $asset_list->LastDepreciationAmount->viewAttributes() ?>><?php echo $asset_list->LastDepreciationAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->DepreciationRate->Visible) { // DepreciationRate ?>
		<td data-name="DepreciationRate" <?php echo $asset_list->DepreciationRate->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_DepreciationRate" class="form-group">
<input type="text" data-table="asset" data-field="x_DepreciationRate" name="x<?php echo $asset_list->RowIndex ?>_DepreciationRate" id="x<?php echo $asset_list->RowIndex ?>_DepreciationRate" size="30" placeholder="<?php echo HtmlEncode($asset_list->DepreciationRate->getPlaceHolder()) ?>" value="<?php echo $asset_list->DepreciationRate->EditValue ?>"<?php echo $asset_list->DepreciationRate->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_DepreciationRate" name="o<?php echo $asset_list->RowIndex ?>_DepreciationRate" id="o<?php echo $asset_list->RowIndex ?>_DepreciationRate" value="<?php echo HtmlEncode($asset_list->DepreciationRate->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_DepreciationRate" class="form-group">
<input type="text" data-table="asset" data-field="x_DepreciationRate" name="x<?php echo $asset_list->RowIndex ?>_DepreciationRate" id="x<?php echo $asset_list->RowIndex ?>_DepreciationRate" size="30" placeholder="<?php echo HtmlEncode($asset_list->DepreciationRate->getPlaceHolder()) ?>" value="<?php echo $asset_list->DepreciationRate->EditValue ?>"<?php echo $asset_list->DepreciationRate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_DepreciationRate">
<span<?php echo $asset_list->DepreciationRate->viewAttributes() ?>><?php echo $asset_list->DepreciationRate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
		<td data-name="CumulativeDepreciation" <?php echo $asset_list->CumulativeDepreciation->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_CumulativeDepreciation" class="form-group">
<input type="text" data-table="asset" data-field="x_CumulativeDepreciation" name="x<?php echo $asset_list->RowIndex ?>_CumulativeDepreciation" id="x<?php echo $asset_list->RowIndex ?>_CumulativeDepreciation" size="30" placeholder="<?php echo HtmlEncode($asset_list->CumulativeDepreciation->getPlaceHolder()) ?>" value="<?php echo $asset_list->CumulativeDepreciation->EditValue ?>"<?php echo $asset_list->CumulativeDepreciation->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_CumulativeDepreciation" name="o<?php echo $asset_list->RowIndex ?>_CumulativeDepreciation" id="o<?php echo $asset_list->RowIndex ?>_CumulativeDepreciation" value="<?php echo HtmlEncode($asset_list->CumulativeDepreciation->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_CumulativeDepreciation" class="form-group">
<input type="text" data-table="asset" data-field="x_CumulativeDepreciation" name="x<?php echo $asset_list->RowIndex ?>_CumulativeDepreciation" id="x<?php echo $asset_list->RowIndex ?>_CumulativeDepreciation" size="30" placeholder="<?php echo HtmlEncode($asset_list->CumulativeDepreciation->getPlaceHolder()) ?>" value="<?php echo $asset_list->CumulativeDepreciation->EditValue ?>"<?php echo $asset_list->CumulativeDepreciation->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_CumulativeDepreciation">
<span<?php echo $asset_list->CumulativeDepreciation->viewAttributes() ?>><?php echo $asset_list->CumulativeDepreciation->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->AssetStatus->Visible) { // AssetStatus ?>
		<td data-name="AssetStatus" <?php echo $asset_list->AssetStatus->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetStatus" data-value-separator="<?php echo $asset_list->AssetStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_AssetStatus" name="x<?php echo $asset_list->RowIndex ?>_AssetStatus"<?php echo $asset_list->AssetStatus->editAttributes() ?>>
			<?php echo $asset_list->AssetStatus->selectOptionListHtml("x{$asset_list->RowIndex}_AssetStatus") ?>
		</select>
</div>
<?php echo $asset_list->AssetStatus->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_AssetStatus") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetStatus" name="o<?php echo $asset_list->RowIndex ?>_AssetStatus" id="o<?php echo $asset_list->RowIndex ?>_AssetStatus" value="<?php echo HtmlEncode($asset_list->AssetStatus->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetStatus" data-value-separator="<?php echo $asset_list->AssetStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_AssetStatus" name="x<?php echo $asset_list->RowIndex ?>_AssetStatus"<?php echo $asset_list->AssetStatus->editAttributes() ?>>
			<?php echo $asset_list->AssetStatus->selectOptionListHtml("x{$asset_list->RowIndex}_AssetStatus") ?>
		</select>
</div>
<?php echo $asset_list->AssetStatus->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_AssetStatus") ?>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_AssetStatus">
<span<?php echo $asset_list->AssetStatus->viewAttributes() ?>><?php echo $asset_list->AssetStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($asset_list->ScrapValue->Visible) { // ScrapValue ?>
		<td data-name="ScrapValue" <?php echo $asset_list->ScrapValue->cellAttributes() ?>>
<?php if ($asset->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_ScrapValue" class="form-group">
<input type="text" data-table="asset" data-field="x_ScrapValue" name="x<?php echo $asset_list->RowIndex ?>_ScrapValue" id="x<?php echo $asset_list->RowIndex ?>_ScrapValue" size="30" placeholder="<?php echo HtmlEncode($asset_list->ScrapValue->getPlaceHolder()) ?>" value="<?php echo $asset_list->ScrapValue->EditValue ?>"<?php echo $asset_list->ScrapValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ScrapValue" name="o<?php echo $asset_list->RowIndex ?>_ScrapValue" id="o<?php echo $asset_list->RowIndex ?>_ScrapValue" value="<?php echo HtmlEncode($asset_list->ScrapValue->OldValue) ?>">
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_ScrapValue" class="form-group">
<input type="text" data-table="asset" data-field="x_ScrapValue" name="x<?php echo $asset_list->RowIndex ?>_ScrapValue" id="x<?php echo $asset_list->RowIndex ?>_ScrapValue" size="30" placeholder="<?php echo HtmlEncode($asset_list->ScrapValue->getPlaceHolder()) ?>" value="<?php echo $asset_list->ScrapValue->EditValue ?>"<?php echo $asset_list->ScrapValue->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($asset->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $asset_list->RowCount ?>_asset_ScrapValue">
<span<?php echo $asset_list->ScrapValue->viewAttributes() ?>><?php echo $asset_list->ScrapValue->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$asset_list->ListOptions->render("body", "right", $asset_list->RowCount);
?>
	</tr>
<?php if ($asset->RowType == ROWTYPE_ADD || $asset->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fassetlist", "load"], function() {
	fassetlist.updateLists(<?php echo $asset_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$asset_list->isGridAdd())
		if (!$asset_list->Recordset->EOF)
			$asset_list->Recordset->moveNext();
}
?>
<?php
	if ($asset_list->isGridAdd() || $asset_list->isGridEdit()) {
		$asset_list->RowIndex = '$rowindex$';
		$asset_list->loadRowValues();

		// Set row properties
		$asset->resetAttributes();
		$asset->RowAttrs->merge(["data-rowindex" => $asset_list->RowIndex, "id" => "r0_asset", "data-rowtype" => ROWTYPE_ADD]);
		$asset->RowAttrs->appendClass("ew-template");
		$asset->RowType = ROWTYPE_ADD;

		// Render row
		$asset_list->renderRow();

		// Render list options
		$asset_list->renderListOptions();
		$asset_list->StartRowCount = 0;
?>
	<tr <?php echo $asset->rowAttributes() ?>>
<?php

// Render list options (body, left)
$asset_list->ListOptions->render("body", "left", $asset_list->RowIndex);
?>
	<?php if ($asset_list->AssetCode->Visible) { // AssetCode ?>
		<td data-name="AssetCode">
<span id="el$rowindex$_asset_AssetCode" class="form-group asset_AssetCode">
<input type="text" data-table="asset" data-field="x_AssetCode" name="x<?php echo $asset_list->RowIndex ?>_AssetCode" id="x<?php echo $asset_list->RowIndex ?>_AssetCode" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($asset_list->AssetCode->getPlaceHolder()) ?>" value="<?php echo $asset_list->AssetCode->EditValue ?>"<?php echo $asset_list->AssetCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetCode" name="o<?php echo $asset_list->RowIndex ?>_AssetCode" id="o<?php echo $asset_list->RowIndex ?>_AssetCode" value="<?php echo HtmlEncode($asset_list->AssetCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<?php if ($asset_list->ProvinceCode->getSessionValue() != "") { ?>
<span id="el$rowindex$_asset_ProvinceCode" class="form-group asset_ProvinceCode">
<span<?php echo $asset_list->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_list->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $asset_list->RowIndex ?>_ProvinceCode" name="x<?php echo $asset_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_list->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_asset_ProvinceCode" class="form-group asset_ProvinceCode">
<?php
$onchange = $asset_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$asset_list->ProvinceCode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $asset_list->RowIndex ?>_ProvinceCode">
	<input type="text" class="form-control" name="sv_x<?php echo $asset_list->RowIndex ?>_ProvinceCode" id="sv_x<?php echo $asset_list->RowIndex ?>_ProvinceCode" value="<?php echo RemoveHtml($asset_list->ProvinceCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($asset_list->ProvinceCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($asset_list->ProvinceCode->getPlaceHolder()) ?>"<?php echo $asset_list->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" data-value-separator="<?php echo $asset_list->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $asset_list->RowIndex ?>_ProvinceCode" id="x<?php echo $asset_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_list->ProvinceCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fassetlist"], function() {
	fassetlist.createAutoSuggest({"id":"x<?php echo $asset_list->RowIndex ?>_ProvinceCode","forceSelect":false});
});
</script>
<?php echo $asset_list->ProvinceCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_ProvinceCode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_ProvinceCode" name="o<?php echo $asset_list->RowIndex ?>_ProvinceCode" id="o<?php echo $asset_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($asset_list->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($asset_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_asset_LACode" class="form-group asset_LACode">
<span<?php echo $asset_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($asset_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $asset_list->RowIndex ?>_LACode" name="x<?php echo $asset_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_asset_LACode" class="form-group asset_LACode">
<?php $asset_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_LACode" data-value-separator="<?php echo $asset_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_LACode" name="x<?php echo $asset_list->RowIndex ?>_LACode"<?php echo $asset_list->LACode->editAttributes() ?>>
			<?php echo $asset_list->LACode->selectOptionListHtml("x{$asset_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $asset_list->LACode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="asset" data-field="x_LACode" name="o<?php echo $asset_list->RowIndex ?>_LACode" id="o<?php echo $asset_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($asset_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode">
<span id="el$rowindex$_asset_DepartmentCode" class="form-group asset_DepartmentCode">
<?php $asset_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_DepartmentCode" data-value-separator="<?php echo $asset_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_DepartmentCode" name="x<?php echo $asset_list->RowIndex ?>_DepartmentCode"<?php echo $asset_list->DepartmentCode->editAttributes() ?>>
			<?php echo $asset_list->DepartmentCode->selectOptionListHtml("x{$asset_list->RowIndex}_DepartmentCode") ?>
		</select>
</div>
<?php echo $asset_list->DepartmentCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_DepartmentCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_DepartmentCode" name="o<?php echo $asset_list->RowIndex ?>_DepartmentCode" id="o<?php echo $asset_list->RowIndex ?>_DepartmentCode" value="<?php echo HtmlEncode($asset_list->DepartmentCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode">
<span id="el$rowindex$_asset_SectionCode" class="form-group asset_SectionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_SectionCode" data-value-separator="<?php echo $asset_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_SectionCode" name="x<?php echo $asset_list->RowIndex ?>_SectionCode"<?php echo $asset_list->SectionCode->editAttributes() ?>>
			<?php echo $asset_list->SectionCode->selectOptionListHtml("x{$asset_list->RowIndex}_SectionCode") ?>
		</select>
</div>
<?php echo $asset_list->SectionCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_SectionCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_SectionCode" name="o<?php echo $asset_list->RowIndex ?>_SectionCode" id="o<?php echo $asset_list->RowIndex ?>_SectionCode" value="<?php echo HtmlEncode($asset_list->SectionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->AssetTypeCode->Visible) { // AssetTypeCode ?>
		<td data-name="AssetTypeCode">
<span id="el$rowindex$_asset_AssetTypeCode" class="form-group asset_AssetTypeCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetTypeCode" data-value-separator="<?php echo $asset_list->AssetTypeCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_AssetTypeCode" name="x<?php echo $asset_list->RowIndex ?>_AssetTypeCode"<?php echo $asset_list->AssetTypeCode->editAttributes() ?>>
			<?php echo $asset_list->AssetTypeCode->selectOptionListHtml("x{$asset_list->RowIndex}_AssetTypeCode") ?>
		</select>
</div>
<?php echo $asset_list->AssetTypeCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_AssetTypeCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetTypeCode" name="o<?php echo $asset_list->RowIndex ?>_AssetTypeCode" id="o<?php echo $asset_list->RowIndex ?>_AssetTypeCode" value="<?php echo HtmlEncode($asset_list->AssetTypeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->Supplier->Visible) { // Supplier ?>
		<td data-name="Supplier">
<span id="el$rowindex$_asset_Supplier" class="form-group asset_Supplier">
<input type="text" data-table="asset" data-field="x_Supplier" name="x<?php echo $asset_list->RowIndex ?>_Supplier" id="x<?php echo $asset_list->RowIndex ?>_Supplier" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($asset_list->Supplier->getPlaceHolder()) ?>" value="<?php echo $asset_list->Supplier->EditValue ?>"<?php echo $asset_list->Supplier->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_Supplier" name="o<?php echo $asset_list->RowIndex ?>_Supplier" id="o<?php echo $asset_list->RowIndex ?>_Supplier" value="<?php echo HtmlEncode($asset_list->Supplier->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->PurchasePrice->Visible) { // PurchasePrice ?>
		<td data-name="PurchasePrice">
<span id="el$rowindex$_asset_PurchasePrice" class="form-group asset_PurchasePrice">
<input type="text" data-table="asset" data-field="x_PurchasePrice" name="x<?php echo $asset_list->RowIndex ?>_PurchasePrice" id="x<?php echo $asset_list->RowIndex ?>_PurchasePrice" size="30" placeholder="<?php echo HtmlEncode($asset_list->PurchasePrice->getPlaceHolder()) ?>" value="<?php echo $asset_list->PurchasePrice->EditValue ?>"<?php echo $asset_list->PurchasePrice->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_PurchasePrice" name="o<?php echo $asset_list->RowIndex ?>_PurchasePrice" id="o<?php echo $asset_list->RowIndex ?>_PurchasePrice" value="<?php echo HtmlEncode($asset_list->PurchasePrice->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->CurrencyCode->Visible) { // CurrencyCode ?>
		<td data-name="CurrencyCode">
<span id="el$rowindex$_asset_CurrencyCode" class="form-group asset_CurrencyCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_CurrencyCode" data-value-separator="<?php echo $asset_list->CurrencyCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_CurrencyCode" name="x<?php echo $asset_list->RowIndex ?>_CurrencyCode"<?php echo $asset_list->CurrencyCode->editAttributes() ?>>
			<?php echo $asset_list->CurrencyCode->selectOptionListHtml("x{$asset_list->RowIndex}_CurrencyCode") ?>
		</select>
</div>
<?php echo $asset_list->CurrencyCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_CurrencyCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_CurrencyCode" name="o<?php echo $asset_list->RowIndex ?>_CurrencyCode" id="o<?php echo $asset_list->RowIndex ?>_CurrencyCode" value="<?php echo HtmlEncode($asset_list->CurrencyCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->ConditionCode->Visible) { // ConditionCode ?>
		<td data-name="ConditionCode">
<span id="el$rowindex$_asset_ConditionCode" class="form-group asset_ConditionCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_ConditionCode" data-value-separator="<?php echo $asset_list->ConditionCode->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_ConditionCode" name="x<?php echo $asset_list->RowIndex ?>_ConditionCode"<?php echo $asset_list->ConditionCode->editAttributes() ?>>
			<?php echo $asset_list->ConditionCode->selectOptionListHtml("x{$asset_list->RowIndex}_ConditionCode") ?>
		</select>
</div>
<?php echo $asset_list->ConditionCode->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_ConditionCode") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_ConditionCode" name="o<?php echo $asset_list->RowIndex ?>_ConditionCode" id="o<?php echo $asset_list->RowIndex ?>_ConditionCode" value="<?php echo HtmlEncode($asset_list->ConditionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->DateOfPurchase->Visible) { // DateOfPurchase ?>
		<td data-name="DateOfPurchase">
<span id="el$rowindex$_asset_DateOfPurchase" class="form-group asset_DateOfPurchase">
<input type="text" data-table="asset" data-field="x_DateOfPurchase" name="x<?php echo $asset_list->RowIndex ?>_DateOfPurchase" id="x<?php echo $asset_list->RowIndex ?>_DateOfPurchase" placeholder="<?php echo HtmlEncode($asset_list->DateOfPurchase->getPlaceHolder()) ?>" value="<?php echo $asset_list->DateOfPurchase->EditValue ?>"<?php echo $asset_list->DateOfPurchase->editAttributes() ?>>
<?php if (!$asset_list->DateOfPurchase->ReadOnly && !$asset_list->DateOfPurchase->Disabled && !isset($asset_list->DateOfPurchase->EditAttrs["readonly"]) && !isset($asset_list->DateOfPurchase->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetlist", "x<?php echo $asset_list->RowIndex ?>_DateOfPurchase", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="asset" data-field="x_DateOfPurchase" name="o<?php echo $asset_list->RowIndex ?>_DateOfPurchase" id="o<?php echo $asset_list->RowIndex ?>_DateOfPurchase" value="<?php echo HtmlEncode($asset_list->DateOfPurchase->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->AssetCapacity->Visible) { // AssetCapacity ?>
		<td data-name="AssetCapacity">
<span id="el$rowindex$_asset_AssetCapacity" class="form-group asset_AssetCapacity">
<input type="text" data-table="asset" data-field="x_AssetCapacity" name="x<?php echo $asset_list->RowIndex ?>_AssetCapacity" id="x<?php echo $asset_list->RowIndex ?>_AssetCapacity" size="30" placeholder="<?php echo HtmlEncode($asset_list->AssetCapacity->getPlaceHolder()) ?>" value="<?php echo $asset_list->AssetCapacity->EditValue ?>"<?php echo $asset_list->AssetCapacity->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetCapacity" name="o<?php echo $asset_list->RowIndex ?>_AssetCapacity" id="o<?php echo $asset_list->RowIndex ?>_AssetCapacity" value="<?php echo HtmlEncode($asset_list->AssetCapacity->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure">
<span id="el$rowindex$_asset_UnitOfMeasure" class="form-group asset_UnitOfMeasure">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $asset_list->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_UnitOfMeasure" name="x<?php echo $asset_list->RowIndex ?>_UnitOfMeasure"<?php echo $asset_list->UnitOfMeasure->editAttributes() ?>>
			<?php echo $asset_list->UnitOfMeasure->selectOptionListHtml("x{$asset_list->RowIndex}_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $asset_list->UnitOfMeasure->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_UnitOfMeasure") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_UnitOfMeasure" name="o<?php echo $asset_list->RowIndex ?>_UnitOfMeasure" id="o<?php echo $asset_list->RowIndex ?>_UnitOfMeasure" value="<?php echo HtmlEncode($asset_list->UnitOfMeasure->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->AssetDescription->Visible) { // AssetDescription ?>
		<td data-name="AssetDescription">
<span id="el$rowindex$_asset_AssetDescription" class="form-group asset_AssetDescription">
<input type="text" data-table="asset" data-field="x_AssetDescription" name="x<?php echo $asset_list->RowIndex ?>_AssetDescription" id="x<?php echo $asset_list->RowIndex ?>_AssetDescription" size="50" maxlength="60" placeholder="<?php echo HtmlEncode($asset_list->AssetDescription->getPlaceHolder()) ?>" value="<?php echo $asset_list->AssetDescription->EditValue ?>"<?php echo $asset_list->AssetDescription->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetDescription" name="o<?php echo $asset_list->RowIndex ?>_AssetDescription" id="o<?php echo $asset_list->RowIndex ?>_AssetDescription" value="<?php echo HtmlEncode($asset_list->AssetDescription->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->DateOfLastRevaluation->Visible) { // DateOfLastRevaluation ?>
		<td data-name="DateOfLastRevaluation">
<span id="el$rowindex$_asset_DateOfLastRevaluation" class="form-group asset_DateOfLastRevaluation">
<input type="text" data-table="asset" data-field="x_DateOfLastRevaluation" name="x<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation" id="x<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation" placeholder="<?php echo HtmlEncode($asset_list->DateOfLastRevaluation->getPlaceHolder()) ?>" value="<?php echo $asset_list->DateOfLastRevaluation->EditValue ?>"<?php echo $asset_list->DateOfLastRevaluation->editAttributes() ?>>
<?php if (!$asset_list->DateOfLastRevaluation->ReadOnly && !$asset_list->DateOfLastRevaluation->Disabled && !isset($asset_list->DateOfLastRevaluation->EditAttrs["readonly"]) && !isset($asset_list->DateOfLastRevaluation->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetlist", "x<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="asset" data-field="x_DateOfLastRevaluation" name="o<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation" id="o<?php echo $asset_list->RowIndex ?>_DateOfLastRevaluation" value="<?php echo HtmlEncode($asset_list->DateOfLastRevaluation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->NewValue->Visible) { // NewValue ?>
		<td data-name="NewValue">
<span id="el$rowindex$_asset_NewValue" class="form-group asset_NewValue">
<input type="text" data-table="asset" data-field="x_NewValue" name="x<?php echo $asset_list->RowIndex ?>_NewValue" id="x<?php echo $asset_list->RowIndex ?>_NewValue" size="30" placeholder="<?php echo HtmlEncode($asset_list->NewValue->getPlaceHolder()) ?>" value="<?php echo $asset_list->NewValue->EditValue ?>"<?php echo $asset_list->NewValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_NewValue" name="o<?php echo $asset_list->RowIndex ?>_NewValue" id="o<?php echo $asset_list->RowIndex ?>_NewValue" value="<?php echo HtmlEncode($asset_list->NewValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->NameOfValuer->Visible) { // NameOfValuer ?>
		<td data-name="NameOfValuer">
<span id="el$rowindex$_asset_NameOfValuer" class="form-group asset_NameOfValuer">
<input type="text" data-table="asset" data-field="x_NameOfValuer" name="x<?php echo $asset_list->RowIndex ?>_NameOfValuer" id="x<?php echo $asset_list->RowIndex ?>_NameOfValuer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($asset_list->NameOfValuer->getPlaceHolder()) ?>" value="<?php echo $asset_list->NameOfValuer->EditValue ?>"<?php echo $asset_list->NameOfValuer->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_NameOfValuer" name="o<?php echo $asset_list->RowIndex ?>_NameOfValuer" id="o<?php echo $asset_list->RowIndex ?>_NameOfValuer" value="<?php echo HtmlEncode($asset_list->NameOfValuer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->BookValue->Visible) { // BookValue ?>
		<td data-name="BookValue">
<span id="el$rowindex$_asset_BookValue" class="form-group asset_BookValue">
<input type="text" data-table="asset" data-field="x_BookValue" name="x<?php echo $asset_list->RowIndex ?>_BookValue" id="x<?php echo $asset_list->RowIndex ?>_BookValue" size="30" placeholder="<?php echo HtmlEncode($asset_list->BookValue->getPlaceHolder()) ?>" value="<?php echo $asset_list->BookValue->EditValue ?>"<?php echo $asset_list->BookValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_BookValue" name="o<?php echo $asset_list->RowIndex ?>_BookValue" id="o<?php echo $asset_list->RowIndex ?>_BookValue" value="<?php echo HtmlEncode($asset_list->BookValue->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->LastDepreciationDate->Visible) { // LastDepreciationDate ?>
		<td data-name="LastDepreciationDate">
<span id="el$rowindex$_asset_LastDepreciationDate" class="form-group asset_LastDepreciationDate">
<input type="text" data-table="asset" data-field="x_LastDepreciationDate" name="x<?php echo $asset_list->RowIndex ?>_LastDepreciationDate" id="x<?php echo $asset_list->RowIndex ?>_LastDepreciationDate" placeholder="<?php echo HtmlEncode($asset_list->LastDepreciationDate->getPlaceHolder()) ?>" value="<?php echo $asset_list->LastDepreciationDate->EditValue ?>"<?php echo $asset_list->LastDepreciationDate->editAttributes() ?>>
<?php if (!$asset_list->LastDepreciationDate->ReadOnly && !$asset_list->LastDepreciationDate->Disabled && !isset($asset_list->LastDepreciationDate->EditAttrs["readonly"]) && !isset($asset_list->LastDepreciationDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fassetlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fassetlist", "x<?php echo $asset_list->RowIndex ?>_LastDepreciationDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationDate" name="o<?php echo $asset_list->RowIndex ?>_LastDepreciationDate" id="o<?php echo $asset_list->RowIndex ?>_LastDepreciationDate" value="<?php echo HtmlEncode($asset_list->LastDepreciationDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->LastDepreciationAmount->Visible) { // LastDepreciationAmount ?>
		<td data-name="LastDepreciationAmount">
<span id="el$rowindex$_asset_LastDepreciationAmount" class="form-group asset_LastDepreciationAmount">
<input type="text" data-table="asset" data-field="x_LastDepreciationAmount" name="x<?php echo $asset_list->RowIndex ?>_LastDepreciationAmount" id="x<?php echo $asset_list->RowIndex ?>_LastDepreciationAmount" size="30" placeholder="<?php echo HtmlEncode($asset_list->LastDepreciationAmount->getPlaceHolder()) ?>" value="<?php echo $asset_list->LastDepreciationAmount->EditValue ?>"<?php echo $asset_list->LastDepreciationAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_LastDepreciationAmount" name="o<?php echo $asset_list->RowIndex ?>_LastDepreciationAmount" id="o<?php echo $asset_list->RowIndex ?>_LastDepreciationAmount" value="<?php echo HtmlEncode($asset_list->LastDepreciationAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->DepreciationRate->Visible) { // DepreciationRate ?>
		<td data-name="DepreciationRate">
<span id="el$rowindex$_asset_DepreciationRate" class="form-group asset_DepreciationRate">
<input type="text" data-table="asset" data-field="x_DepreciationRate" name="x<?php echo $asset_list->RowIndex ?>_DepreciationRate" id="x<?php echo $asset_list->RowIndex ?>_DepreciationRate" size="30" placeholder="<?php echo HtmlEncode($asset_list->DepreciationRate->getPlaceHolder()) ?>" value="<?php echo $asset_list->DepreciationRate->EditValue ?>"<?php echo $asset_list->DepreciationRate->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_DepreciationRate" name="o<?php echo $asset_list->RowIndex ?>_DepreciationRate" id="o<?php echo $asset_list->RowIndex ?>_DepreciationRate" value="<?php echo HtmlEncode($asset_list->DepreciationRate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->CumulativeDepreciation->Visible) { // CumulativeDepreciation ?>
		<td data-name="CumulativeDepreciation">
<span id="el$rowindex$_asset_CumulativeDepreciation" class="form-group asset_CumulativeDepreciation">
<input type="text" data-table="asset" data-field="x_CumulativeDepreciation" name="x<?php echo $asset_list->RowIndex ?>_CumulativeDepreciation" id="x<?php echo $asset_list->RowIndex ?>_CumulativeDepreciation" size="30" placeholder="<?php echo HtmlEncode($asset_list->CumulativeDepreciation->getPlaceHolder()) ?>" value="<?php echo $asset_list->CumulativeDepreciation->EditValue ?>"<?php echo $asset_list->CumulativeDepreciation->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_CumulativeDepreciation" name="o<?php echo $asset_list->RowIndex ?>_CumulativeDepreciation" id="o<?php echo $asset_list->RowIndex ?>_CumulativeDepreciation" value="<?php echo HtmlEncode($asset_list->CumulativeDepreciation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->AssetStatus->Visible) { // AssetStatus ?>
		<td data-name="AssetStatus">
<span id="el$rowindex$_asset_AssetStatus" class="form-group asset_AssetStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="asset" data-field="x_AssetStatus" data-value-separator="<?php echo $asset_list->AssetStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $asset_list->RowIndex ?>_AssetStatus" name="x<?php echo $asset_list->RowIndex ?>_AssetStatus"<?php echo $asset_list->AssetStatus->editAttributes() ?>>
			<?php echo $asset_list->AssetStatus->selectOptionListHtml("x{$asset_list->RowIndex}_AssetStatus") ?>
		</select>
</div>
<?php echo $asset_list->AssetStatus->Lookup->getParamTag($asset_list, "p_x" . $asset_list->RowIndex . "_AssetStatus") ?>
</span>
<input type="hidden" data-table="asset" data-field="x_AssetStatus" name="o<?php echo $asset_list->RowIndex ?>_AssetStatus" id="o<?php echo $asset_list->RowIndex ?>_AssetStatus" value="<?php echo HtmlEncode($asset_list->AssetStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($asset_list->ScrapValue->Visible) { // ScrapValue ?>
		<td data-name="ScrapValue">
<span id="el$rowindex$_asset_ScrapValue" class="form-group asset_ScrapValue">
<input type="text" data-table="asset" data-field="x_ScrapValue" name="x<?php echo $asset_list->RowIndex ?>_ScrapValue" id="x<?php echo $asset_list->RowIndex ?>_ScrapValue" size="30" placeholder="<?php echo HtmlEncode($asset_list->ScrapValue->getPlaceHolder()) ?>" value="<?php echo $asset_list->ScrapValue->EditValue ?>"<?php echo $asset_list->ScrapValue->editAttributes() ?>>
</span>
<input type="hidden" data-table="asset" data-field="x_ScrapValue" name="o<?php echo $asset_list->RowIndex ?>_ScrapValue" id="o<?php echo $asset_list->RowIndex ?>_ScrapValue" value="<?php echo HtmlEncode($asset_list->ScrapValue->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$asset_list->ListOptions->render("body", "right", $asset_list->RowIndex);
?>
<script>
loadjs.ready(["fassetlist", "load"], function() {
	fassetlist.updateLists(<?php echo $asset_list->RowIndex ?>);
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
<?php if ($asset_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $asset_list->FormKeyCountName ?>" id="<?php echo $asset_list->FormKeyCountName ?>" value="<?php echo $asset_list->KeyCount ?>">
<?php echo $asset_list->MultiSelectKey ?>
<?php } ?>
<?php if ($asset_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $asset_list->FormKeyCountName ?>" id="<?php echo $asset_list->FormKeyCountName ?>" value="<?php echo $asset_list->KeyCount ?>">
<?php echo $asset_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$asset->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($asset_list->Recordset)
	$asset_list->Recordset->Close();
?>
<?php if (!$asset_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$asset_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $asset_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $asset_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($asset_list->TotalRecords == 0 && !$asset->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $asset_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$asset_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$asset_list->isExport()) { ?>
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
$asset_list->terminate();
?>