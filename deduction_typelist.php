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
$deduction_type_list = new deduction_type_list();

// Run the page
$deduction_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$deduction_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$deduction_type_list->isExport()) { ?>
<script>
var fdeduction_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdeduction_typelist = currentForm = new ew.Form("fdeduction_typelist", "list");
	fdeduction_typelist.formKeyCountName = '<?php echo $deduction_type_list->FormKeyCountName ?>';

	// Validate form
	fdeduction_typelist.validate = function() {
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
			<?php if ($deduction_type_list->DeductionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->DeductionCode->caption(), $deduction_type_list->DeductionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_list->DeductionName->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->DeductionName->caption(), $deduction_type_list->DeductionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_list->DeductionDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->DeductionDescription->caption(), $deduction_type_list->DeductionDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_list->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->Division->caption(), $deduction_type_list->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_list->DeductionAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->DeductionAmount->caption(), $deduction_type_list->DeductionAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_list->DeductionAmount->errorMessage()) ?>");
			<?php if ($deduction_type_list->DeductionBasicRate->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionBasicRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->DeductionBasicRate->caption(), $deduction_type_list->DeductionBasicRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionBasicRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_list->DeductionBasicRate->errorMessage()) ?>");
			<?php if ($deduction_type_list->RemittedTo->Required) { ?>
				elm = this.getElements("x" + infix + "_RemittedTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->RemittedTo->caption(), $deduction_type_list->RemittedTo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_list->AccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->AccountNo->caption(), $deduction_type_list->AccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_list->BaseIncomeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BaseIncomeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->BaseIncomeCode->caption(), $deduction_type_list->BaseIncomeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_list->BaseDeductionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BaseDeductionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->BaseDeductionCode->caption(), $deduction_type_list->BaseDeductionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_list->TaxExempt->Required) { ?>
				elm = this.getElements("x" + infix + "_TaxExempt");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->TaxExempt->caption(), $deduction_type_list->TaxExempt->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_list->JobCode->Required) { ?>
				elm = this.getElements("x" + infix + "_JobCode[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->JobCode->caption(), $deduction_type_list->JobCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($deduction_type_list->MinimumAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_MinimumAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->MinimumAmount->caption(), $deduction_type_list->MinimumAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MinimumAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_list->MinimumAmount->errorMessage()) ?>");
			<?php if ($deduction_type_list->MaximumAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_MaximumAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->MaximumAmount->caption(), $deduction_type_list->MaximumAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MaximumAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_list->MaximumAmount->errorMessage()) ?>");
			<?php if ($deduction_type_list->EmployerContributionRate->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployerContributionRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->EmployerContributionRate->caption(), $deduction_type_list->EmployerContributionRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployerContributionRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_list->EmployerContributionRate->errorMessage()) ?>");
			<?php if ($deduction_type_list->EmployerContributionAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployerContributionAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->EmployerContributionAmount->caption(), $deduction_type_list->EmployerContributionAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployerContributionAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($deduction_type_list->EmployerContributionAmount->errorMessage()) ?>");
			<?php if ($deduction_type_list->Application->Required) { ?>
				elm = this.getElements("x" + infix + "_Application");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $deduction_type_list->Application->caption(), $deduction_type_list->Application->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	fdeduction_typelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "DeductionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeductionDescription", false)) return false;
		if (ew.valueChanged(fobj, infix, "Division[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeductionAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeductionBasicRate", false)) return false;
		if (ew.valueChanged(fobj, infix, "RemittedTo", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "BaseIncomeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "BaseDeductionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "TaxExempt", false)) return false;
		if (ew.valueChanged(fobj, infix, "JobCode[]", false)) return false;
		if (ew.valueChanged(fobj, infix, "MinimumAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "MaximumAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmployerContributionRate", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmployerContributionAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "Application", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fdeduction_typelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdeduction_typelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdeduction_typelist.lists["x_Division[]"] = <?php echo $deduction_type_list->Division->Lookup->toClientList($deduction_type_list) ?>;
	fdeduction_typelist.lists["x_Division[]"].options = <?php echo JsonEncode($deduction_type_list->Division->lookupOptions()) ?>;
	fdeduction_typelist.lists["x_AccountNo"] = <?php echo $deduction_type_list->AccountNo->Lookup->toClientList($deduction_type_list) ?>;
	fdeduction_typelist.lists["x_AccountNo"].options = <?php echo JsonEncode($deduction_type_list->AccountNo->lookupOptions()) ?>;
	fdeduction_typelist.lists["x_BaseIncomeCode"] = <?php echo $deduction_type_list->BaseIncomeCode->Lookup->toClientList($deduction_type_list) ?>;
	fdeduction_typelist.lists["x_BaseIncomeCode"].options = <?php echo JsonEncode($deduction_type_list->BaseIncomeCode->lookupOptions()) ?>;
	fdeduction_typelist.lists["x_BaseDeductionCode"] = <?php echo $deduction_type_list->BaseDeductionCode->Lookup->toClientList($deduction_type_list) ?>;
	fdeduction_typelist.lists["x_BaseDeductionCode"].options = <?php echo JsonEncode($deduction_type_list->BaseDeductionCode->lookupOptions()) ?>;
	fdeduction_typelist.lists["x_TaxExempt"] = <?php echo $deduction_type_list->TaxExempt->Lookup->toClientList($deduction_type_list) ?>;
	fdeduction_typelist.lists["x_TaxExempt"].options = <?php echo JsonEncode($deduction_type_list->TaxExempt->lookupOptions()) ?>;
	fdeduction_typelist.lists["x_JobCode[]"] = <?php echo $deduction_type_list->JobCode->Lookup->toClientList($deduction_type_list) ?>;
	fdeduction_typelist.lists["x_JobCode[]"].options = <?php echo JsonEncode($deduction_type_list->JobCode->lookupOptions()) ?>;
	fdeduction_typelist.lists["x_Application"] = <?php echo $deduction_type_list->Application->Lookup->toClientList($deduction_type_list) ?>;
	fdeduction_typelist.lists["x_Application"].options = <?php echo JsonEncode($deduction_type_list->Application->lookupOptions()) ?>;
	loadjs.done("fdeduction_typelist");
});
var fdeduction_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdeduction_typelistsrch = currentSearchForm = new ew.Form("fdeduction_typelistsrch");

	// Dynamic selection lists
	// Filters

	fdeduction_typelistsrch.filterList = <?php echo $deduction_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdeduction_typelistsrch.initSearchPanel = true;
	loadjs.done("fdeduction_typelistsrch");
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
<?php if (!$deduction_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($deduction_type_list->TotalRecords > 0 && $deduction_type_list->ExportOptions->visible()) { ?>
<?php $deduction_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($deduction_type_list->ImportOptions->visible()) { ?>
<?php $deduction_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($deduction_type_list->SearchOptions->visible()) { ?>
<?php $deduction_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($deduction_type_list->FilterOptions->visible()) { ?>
<?php $deduction_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$deduction_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$deduction_type_list->isExport() && !$deduction_type->CurrentAction) { ?>
<form name="fdeduction_typelistsrch" id="fdeduction_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdeduction_typelistsrch-search-panel" class="<?php echo $deduction_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="deduction_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $deduction_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($deduction_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($deduction_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $deduction_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($deduction_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($deduction_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($deduction_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($deduction_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $deduction_type_list->showPageHeader(); ?>
<?php
$deduction_type_list->showMessage();
?>
<?php if ($deduction_type_list->TotalRecords > 0 || $deduction_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($deduction_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> deduction_type">
<?php if (!$deduction_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$deduction_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $deduction_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $deduction_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdeduction_typelist" id="fdeduction_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="deduction_type">
<div id="gmp_deduction_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($deduction_type_list->TotalRecords > 0 || $deduction_type_list->isGridEdit()) { ?>
<table id="tbl_deduction_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$deduction_type->RowType = ROWTYPE_HEADER;

// Render list options
$deduction_type_list->renderListOptions();

// Render list options (header, left)
$deduction_type_list->ListOptions->render("header", "left");
?>
<?php if ($deduction_type_list->DeductionCode->Visible) { // DeductionCode ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->DeductionCode) == "") { ?>
		<th data-name="DeductionCode" class="<?php echo $deduction_type_list->DeductionCode->headerCellClass() ?>"><div id="elh_deduction_type_DeductionCode" class="deduction_type_DeductionCode"><div class="ew-table-header-caption"><?php echo $deduction_type_list->DeductionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionCode" class="<?php echo $deduction_type_list->DeductionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->DeductionCode) ?>', 1);"><div id="elh_deduction_type_DeductionCode" class="deduction_type_DeductionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->DeductionCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->DeductionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->DeductionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->DeductionName->Visible) { // DeductionName ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $deduction_type_list->DeductionName->headerCellClass() ?>"><div id="elh_deduction_type_DeductionName" class="deduction_type_DeductionName"><div class="ew-table-header-caption"><?php echo $deduction_type_list->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $deduction_type_list->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->DeductionName) ?>', 1);"><div id="elh_deduction_type_DeductionName" class="deduction_type_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->DeductionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->DeductionDescription->Visible) { // DeductionDescription ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->DeductionDescription) == "") { ?>
		<th data-name="DeductionDescription" class="<?php echo $deduction_type_list->DeductionDescription->headerCellClass() ?>"><div id="elh_deduction_type_DeductionDescription" class="deduction_type_DeductionDescription"><div class="ew-table-header-caption"><?php echo $deduction_type_list->DeductionDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionDescription" class="<?php echo $deduction_type_list->DeductionDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->DeductionDescription) ?>', 1);"><div id="elh_deduction_type_DeductionDescription" class="deduction_type_DeductionDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->DeductionDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->DeductionDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->DeductionDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->Division->Visible) { // Division ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $deduction_type_list->Division->headerCellClass() ?>"><div id="elh_deduction_type_Division" class="deduction_type_Division"><div class="ew-table-header-caption"><?php echo $deduction_type_list->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $deduction_type_list->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->Division) ?>', 1);"><div id="elh_deduction_type_Division" class="deduction_type_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->DeductionAmount->Visible) { // DeductionAmount ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->DeductionAmount) == "") { ?>
		<th data-name="DeductionAmount" class="<?php echo $deduction_type_list->DeductionAmount->headerCellClass() ?>"><div id="elh_deduction_type_DeductionAmount" class="deduction_type_DeductionAmount"><div class="ew-table-header-caption"><?php echo $deduction_type_list->DeductionAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionAmount" class="<?php echo $deduction_type_list->DeductionAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->DeductionAmount) ?>', 1);"><div id="elh_deduction_type_DeductionAmount" class="deduction_type_DeductionAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->DeductionAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->DeductionAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->DeductionAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->DeductionBasicRate->Visible) { // DeductionBasicRate ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->DeductionBasicRate) == "") { ?>
		<th data-name="DeductionBasicRate" class="<?php echo $deduction_type_list->DeductionBasicRate->headerCellClass() ?>"><div id="elh_deduction_type_DeductionBasicRate" class="deduction_type_DeductionBasicRate"><div class="ew-table-header-caption"><?php echo $deduction_type_list->DeductionBasicRate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionBasicRate" class="<?php echo $deduction_type_list->DeductionBasicRate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->DeductionBasicRate) ?>', 1);"><div id="elh_deduction_type_DeductionBasicRate" class="deduction_type_DeductionBasicRate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->DeductionBasicRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->DeductionBasicRate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->DeductionBasicRate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->RemittedTo->Visible) { // RemittedTo ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->RemittedTo) == "") { ?>
		<th data-name="RemittedTo" class="<?php echo $deduction_type_list->RemittedTo->headerCellClass() ?>"><div id="elh_deduction_type_RemittedTo" class="deduction_type_RemittedTo"><div class="ew-table-header-caption"><?php echo $deduction_type_list->RemittedTo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RemittedTo" class="<?php echo $deduction_type_list->RemittedTo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->RemittedTo) ?>', 1);"><div id="elh_deduction_type_RemittedTo" class="deduction_type_RemittedTo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->RemittedTo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->RemittedTo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->RemittedTo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->AccountNo->Visible) { // AccountNo ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->AccountNo) == "") { ?>
		<th data-name="AccountNo" class="<?php echo $deduction_type_list->AccountNo->headerCellClass() ?>"><div id="elh_deduction_type_AccountNo" class="deduction_type_AccountNo"><div class="ew-table-header-caption"><?php echo $deduction_type_list->AccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountNo" class="<?php echo $deduction_type_list->AccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->AccountNo) ?>', 1);"><div id="elh_deduction_type_AccountNo" class="deduction_type_AccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->AccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->AccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->AccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->BaseIncomeCode) == "") { ?>
		<th data-name="BaseIncomeCode" class="<?php echo $deduction_type_list->BaseIncomeCode->headerCellClass() ?>"><div id="elh_deduction_type_BaseIncomeCode" class="deduction_type_BaseIncomeCode"><div class="ew-table-header-caption"><?php echo $deduction_type_list->BaseIncomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BaseIncomeCode" class="<?php echo $deduction_type_list->BaseIncomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->BaseIncomeCode) ?>', 1);"><div id="elh_deduction_type_BaseIncomeCode" class="deduction_type_BaseIncomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->BaseIncomeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->BaseIncomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->BaseIncomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->BaseDeductionCode->Visible) { // BaseDeductionCode ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->BaseDeductionCode) == "") { ?>
		<th data-name="BaseDeductionCode" class="<?php echo $deduction_type_list->BaseDeductionCode->headerCellClass() ?>"><div id="elh_deduction_type_BaseDeductionCode" class="deduction_type_BaseDeductionCode"><div class="ew-table-header-caption"><?php echo $deduction_type_list->BaseDeductionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BaseDeductionCode" class="<?php echo $deduction_type_list->BaseDeductionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->BaseDeductionCode) ?>', 1);"><div id="elh_deduction_type_BaseDeductionCode" class="deduction_type_BaseDeductionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->BaseDeductionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->BaseDeductionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->BaseDeductionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->TaxExempt->Visible) { // TaxExempt ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->TaxExempt) == "") { ?>
		<th data-name="TaxExempt" class="<?php echo $deduction_type_list->TaxExempt->headerCellClass() ?>"><div id="elh_deduction_type_TaxExempt" class="deduction_type_TaxExempt"><div class="ew-table-header-caption"><?php echo $deduction_type_list->TaxExempt->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TaxExempt" class="<?php echo $deduction_type_list->TaxExempt->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->TaxExempt) ?>', 1);"><div id="elh_deduction_type_TaxExempt" class="deduction_type_TaxExempt">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->TaxExempt->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->TaxExempt->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->TaxExempt->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->JobCode->Visible) { // JobCode ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->JobCode) == "") { ?>
		<th data-name="JobCode" class="<?php echo $deduction_type_list->JobCode->headerCellClass() ?>"><div id="elh_deduction_type_JobCode" class="deduction_type_JobCode"><div class="ew-table-header-caption"><?php echo $deduction_type_list->JobCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="JobCode" class="<?php echo $deduction_type_list->JobCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->JobCode) ?>', 1);"><div id="elh_deduction_type_JobCode" class="deduction_type_JobCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->JobCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->JobCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->JobCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->MinimumAmount->Visible) { // MinimumAmount ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->MinimumAmount) == "") { ?>
		<th data-name="MinimumAmount" class="<?php echo $deduction_type_list->MinimumAmount->headerCellClass() ?>"><div id="elh_deduction_type_MinimumAmount" class="deduction_type_MinimumAmount"><div class="ew-table-header-caption"><?php echo $deduction_type_list->MinimumAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MinimumAmount" class="<?php echo $deduction_type_list->MinimumAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->MinimumAmount) ?>', 1);"><div id="elh_deduction_type_MinimumAmount" class="deduction_type_MinimumAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->MinimumAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->MinimumAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->MinimumAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->MaximumAmount->Visible) { // MaximumAmount ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->MaximumAmount) == "") { ?>
		<th data-name="MaximumAmount" class="<?php echo $deduction_type_list->MaximumAmount->headerCellClass() ?>"><div id="elh_deduction_type_MaximumAmount" class="deduction_type_MaximumAmount"><div class="ew-table-header-caption"><?php echo $deduction_type_list->MaximumAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaximumAmount" class="<?php echo $deduction_type_list->MaximumAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->MaximumAmount) ?>', 1);"><div id="elh_deduction_type_MaximumAmount" class="deduction_type_MaximumAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->MaximumAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->MaximumAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->MaximumAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->EmployerContributionRate->Visible) { // EmployerContributionRate ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->EmployerContributionRate) == "") { ?>
		<th data-name="EmployerContributionRate" class="<?php echo $deduction_type_list->EmployerContributionRate->headerCellClass() ?>"><div id="elh_deduction_type_EmployerContributionRate" class="deduction_type_EmployerContributionRate"><div class="ew-table-header-caption"><?php echo $deduction_type_list->EmployerContributionRate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployerContributionRate" class="<?php echo $deduction_type_list->EmployerContributionRate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->EmployerContributionRate) ?>', 1);"><div id="elh_deduction_type_EmployerContributionRate" class="deduction_type_EmployerContributionRate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->EmployerContributionRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->EmployerContributionRate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->EmployerContributionRate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->EmployerContributionAmount->Visible) { // EmployerContributionAmount ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->EmployerContributionAmount) == "") { ?>
		<th data-name="EmployerContributionAmount" class="<?php echo $deduction_type_list->EmployerContributionAmount->headerCellClass() ?>"><div id="elh_deduction_type_EmployerContributionAmount" class="deduction_type_EmployerContributionAmount"><div class="ew-table-header-caption"><?php echo $deduction_type_list->EmployerContributionAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployerContributionAmount" class="<?php echo $deduction_type_list->EmployerContributionAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->EmployerContributionAmount) ?>', 1);"><div id="elh_deduction_type_EmployerContributionAmount" class="deduction_type_EmployerContributionAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->EmployerContributionAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->EmployerContributionAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->EmployerContributionAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deduction_type_list->Application->Visible) { // Application ?>
	<?php if ($deduction_type_list->SortUrl($deduction_type_list->Application) == "") { ?>
		<th data-name="Application" class="<?php echo $deduction_type_list->Application->headerCellClass() ?>"><div id="elh_deduction_type_Application" class="deduction_type_Application"><div class="ew-table-header-caption"><?php echo $deduction_type_list->Application->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Application" class="<?php echo $deduction_type_list->Application->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deduction_type_list->SortUrl($deduction_type_list->Application) ?>', 1);"><div id="elh_deduction_type_Application" class="deduction_type_Application">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deduction_type_list->Application->caption() ?></span><span class="ew-table-header-sort"><?php if ($deduction_type_list->Application->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deduction_type_list->Application->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$deduction_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($deduction_type_list->ExportAll && $deduction_type_list->isExport()) {
	$deduction_type_list->StopRecord = $deduction_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($deduction_type_list->TotalRecords > $deduction_type_list->StartRecord + $deduction_type_list->DisplayRecords - 1)
		$deduction_type_list->StopRecord = $deduction_type_list->StartRecord + $deduction_type_list->DisplayRecords - 1;
	else
		$deduction_type_list->StopRecord = $deduction_type_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($deduction_type->isConfirm() || $deduction_type_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($deduction_type_list->FormKeyCountName) && ($deduction_type_list->isGridAdd() || $deduction_type_list->isGridEdit() || $deduction_type->isConfirm())) {
		$deduction_type_list->KeyCount = $CurrentForm->getValue($deduction_type_list->FormKeyCountName);
		$deduction_type_list->StopRecord = $deduction_type_list->StartRecord + $deduction_type_list->KeyCount - 1;
	}
}
$deduction_type_list->RecordCount = $deduction_type_list->StartRecord - 1;
if ($deduction_type_list->Recordset && !$deduction_type_list->Recordset->EOF) {
	$deduction_type_list->Recordset->moveFirst();
	$selectLimit = $deduction_type_list->UseSelectLimit;
	if (!$selectLimit && $deduction_type_list->StartRecord > 1)
		$deduction_type_list->Recordset->move($deduction_type_list->StartRecord - 1);
} elseif (!$deduction_type->AllowAddDeleteRow && $deduction_type_list->StopRecord == 0) {
	$deduction_type_list->StopRecord = $deduction_type->GridAddRowCount;
}

// Initialize aggregate
$deduction_type->RowType = ROWTYPE_AGGREGATEINIT;
$deduction_type->resetAttributes();
$deduction_type_list->renderRow();
if ($deduction_type_list->isGridAdd())
	$deduction_type_list->RowIndex = 0;
if ($deduction_type_list->isGridEdit())
	$deduction_type_list->RowIndex = 0;
while ($deduction_type_list->RecordCount < $deduction_type_list->StopRecord) {
	$deduction_type_list->RecordCount++;
	if ($deduction_type_list->RecordCount >= $deduction_type_list->StartRecord) {
		$deduction_type_list->RowCount++;
		if ($deduction_type_list->isGridAdd() || $deduction_type_list->isGridEdit() || $deduction_type->isConfirm()) {
			$deduction_type_list->RowIndex++;
			$CurrentForm->Index = $deduction_type_list->RowIndex;
			if ($CurrentForm->hasValue($deduction_type_list->FormActionName) && ($deduction_type->isConfirm() || $deduction_type_list->EventCancelled))
				$deduction_type_list->RowAction = strval($CurrentForm->getValue($deduction_type_list->FormActionName));
			elseif ($deduction_type_list->isGridAdd())
				$deduction_type_list->RowAction = "insert";
			else
				$deduction_type_list->RowAction = "";
		}

		// Set up key count
		$deduction_type_list->KeyCount = $deduction_type_list->RowIndex;

		// Init row class and style
		$deduction_type->resetAttributes();
		$deduction_type->CssClass = "";
		if ($deduction_type_list->isGridAdd()) {
			$deduction_type_list->loadRowValues(); // Load default values
		} else {
			$deduction_type_list->loadRowValues($deduction_type_list->Recordset); // Load row values
		}
		$deduction_type->RowType = ROWTYPE_VIEW; // Render view
		if ($deduction_type_list->isGridAdd()) // Grid add
			$deduction_type->RowType = ROWTYPE_ADD; // Render add
		if ($deduction_type_list->isGridAdd() && $deduction_type->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$deduction_type_list->restoreCurrentRowFormValues($deduction_type_list->RowIndex); // Restore form values
		if ($deduction_type_list->isGridEdit()) { // Grid edit
			if ($deduction_type->EventCancelled)
				$deduction_type_list->restoreCurrentRowFormValues($deduction_type_list->RowIndex); // Restore form values
			if ($deduction_type_list->RowAction == "insert")
				$deduction_type->RowType = ROWTYPE_ADD; // Render add
			else
				$deduction_type->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($deduction_type_list->isGridEdit() && ($deduction_type->RowType == ROWTYPE_EDIT || $deduction_type->RowType == ROWTYPE_ADD) && $deduction_type->EventCancelled) // Update failed
			$deduction_type_list->restoreCurrentRowFormValues($deduction_type_list->RowIndex); // Restore form values
		if ($deduction_type->RowType == ROWTYPE_EDIT) // Edit row
			$deduction_type_list->EditRowCount++;

		// Set up row id / data-rowindex
		$deduction_type->RowAttrs->merge(["data-rowindex" => $deduction_type_list->RowCount, "id" => "r" . $deduction_type_list->RowCount . "_deduction_type", "data-rowtype" => $deduction_type->RowType]);

		// Render row
		$deduction_type_list->renderRow();

		// Render list options
		$deduction_type_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($deduction_type_list->RowAction != "delete" && $deduction_type_list->RowAction != "insertdelete" && !($deduction_type_list->RowAction == "insert" && $deduction_type->isConfirm() && $deduction_type_list->emptyRow())) {
?>
	<tr <?php echo $deduction_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$deduction_type_list->ListOptions->render("body", "left", $deduction_type_list->RowCount);
?>
	<?php if ($deduction_type_list->DeductionCode->Visible) { // DeductionCode ?>
		<td data-name="DeductionCode" <?php echo $deduction_type_list->DeductionCode->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionCode" class="form-group"></span>
<input type="hidden" data-table="deduction_type" data-field="x_DeductionCode" name="o<?php echo $deduction_type_list->RowIndex ?>_DeductionCode" id="o<?php echo $deduction_type_list->RowIndex ?>_DeductionCode" value="<?php echo HtmlEncode($deduction_type_list->DeductionCode->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionCode" class="form-group">
<span<?php echo $deduction_type_list->DeductionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($deduction_type_list->DeductionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_DeductionCode" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionCode" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionCode" value="<?php echo HtmlEncode($deduction_type_list->DeductionCode->CurrentValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionCode">
<span<?php echo $deduction_type_list->DeductionCode->viewAttributes() ?>><?php echo $deduction_type_list->DeductionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $deduction_type_list->DeductionName->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionName" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_DeductionName" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionName" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_list->DeductionName->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->DeductionName->EditValue ?>"<?php echo $deduction_type_list->DeductionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_DeductionName" name="o<?php echo $deduction_type_list->RowIndex ?>_DeductionName" id="o<?php echo $deduction_type_list->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($deduction_type_list->DeductionName->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionName" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_DeductionName" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionName" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_list->DeductionName->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->DeductionName->EditValue ?>"<?php echo $deduction_type_list->DeductionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionName">
<span<?php echo $deduction_type_list->DeductionName->viewAttributes() ?>><?php echo $deduction_type_list->DeductionName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->DeductionDescription->Visible) { // DeductionDescription ?>
		<td data-name="DeductionDescription" <?php echo $deduction_type_list->DeductionDescription->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionDescription" class="form-group">
<textarea data-table="deduction_type" data-field="x_DeductionDescription" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionDescription" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionDescription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($deduction_type_list->DeductionDescription->getPlaceHolder()) ?>"<?php echo $deduction_type_list->DeductionDescription->editAttributes() ?>><?php echo $deduction_type_list->DeductionDescription->EditValue ?></textarea>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_DeductionDescription" name="o<?php echo $deduction_type_list->RowIndex ?>_DeductionDescription" id="o<?php echo $deduction_type_list->RowIndex ?>_DeductionDescription" value="<?php echo HtmlEncode($deduction_type_list->DeductionDescription->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionDescription" class="form-group">
<textarea data-table="deduction_type" data-field="x_DeductionDescription" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionDescription" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionDescription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($deduction_type_list->DeductionDescription->getPlaceHolder()) ?>"<?php echo $deduction_type_list->DeductionDescription->editAttributes() ?>><?php echo $deduction_type_list->DeductionDescription->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionDescription">
<span<?php echo $deduction_type_list->DeductionDescription->viewAttributes() ?>><?php echo $deduction_type_list->DeductionDescription->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $deduction_type_list->Division->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_Division" class="form-group">
<div id="tp_x<?php echo $deduction_type_list->RowIndex ?>_Division" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="deduction_type" data-field="x_Division" data-value-separator="<?php echo $deduction_type_list->Division->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_Division[]" id="x<?php echo $deduction_type_list->RowIndex ?>_Division[]" value="{value}"<?php echo $deduction_type_list->Division->editAttributes() ?>></div>
<div id="dsl_x<?php echo $deduction_type_list->RowIndex ?>_Division" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $deduction_type_list->Division->checkBoxListHtml(FALSE, "x{$deduction_type_list->RowIndex}_Division[]") ?>
</div></div>
<?php echo $deduction_type_list->Division->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_Division") ?>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_Division" name="o<?php echo $deduction_type_list->RowIndex ?>_Division[]" id="o<?php echo $deduction_type_list->RowIndex ?>_Division[]" value="<?php echo HtmlEncode($deduction_type_list->Division->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_Division" class="form-group">
<div id="tp_x<?php echo $deduction_type_list->RowIndex ?>_Division" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="deduction_type" data-field="x_Division" data-value-separator="<?php echo $deduction_type_list->Division->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_Division[]" id="x<?php echo $deduction_type_list->RowIndex ?>_Division[]" value="{value}"<?php echo $deduction_type_list->Division->editAttributes() ?>></div>
<div id="dsl_x<?php echo $deduction_type_list->RowIndex ?>_Division" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $deduction_type_list->Division->checkBoxListHtml(FALSE, "x{$deduction_type_list->RowIndex}_Division[]") ?>
</div></div>
<?php echo $deduction_type_list->Division->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_Division") ?>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_Division">
<span<?php echo $deduction_type_list->Division->viewAttributes() ?>><?php echo $deduction_type_list->Division->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->DeductionAmount->Visible) { // DeductionAmount ?>
		<td data-name="DeductionAmount" <?php echo $deduction_type_list->DeductionAmount->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionAmount" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_DeductionAmount" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionAmount" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->DeductionAmount->EditValue ?>"<?php echo $deduction_type_list->DeductionAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_DeductionAmount" name="o<?php echo $deduction_type_list->RowIndex ?>_DeductionAmount" id="o<?php echo $deduction_type_list->RowIndex ?>_DeductionAmount" value="<?php echo HtmlEncode($deduction_type_list->DeductionAmount->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionAmount" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_DeductionAmount" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionAmount" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->DeductionAmount->EditValue ?>"<?php echo $deduction_type_list->DeductionAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionAmount">
<span<?php echo $deduction_type_list->DeductionAmount->viewAttributes() ?>><?php echo $deduction_type_list->DeductionAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->DeductionBasicRate->Visible) { // DeductionBasicRate ?>
		<td data-name="DeductionBasicRate" <?php echo $deduction_type_list->DeductionBasicRate->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionBasicRate" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_DeductionBasicRate" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionBasicRate" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionBasicRate" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->DeductionBasicRate->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->DeductionBasicRate->EditValue ?>"<?php echo $deduction_type_list->DeductionBasicRate->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_DeductionBasicRate" name="o<?php echo $deduction_type_list->RowIndex ?>_DeductionBasicRate" id="o<?php echo $deduction_type_list->RowIndex ?>_DeductionBasicRate" value="<?php echo HtmlEncode($deduction_type_list->DeductionBasicRate->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionBasicRate" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_DeductionBasicRate" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionBasicRate" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionBasicRate" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->DeductionBasicRate->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->DeductionBasicRate->EditValue ?>"<?php echo $deduction_type_list->DeductionBasicRate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_DeductionBasicRate">
<span<?php echo $deduction_type_list->DeductionBasicRate->viewAttributes() ?>><?php echo $deduction_type_list->DeductionBasicRate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->RemittedTo->Visible) { // RemittedTo ?>
		<td data-name="RemittedTo" <?php echo $deduction_type_list->RemittedTo->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_RemittedTo" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_RemittedTo" name="x<?php echo $deduction_type_list->RowIndex ?>_RemittedTo" id="x<?php echo $deduction_type_list->RowIndex ?>_RemittedTo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_list->RemittedTo->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->RemittedTo->EditValue ?>"<?php echo $deduction_type_list->RemittedTo->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_RemittedTo" name="o<?php echo $deduction_type_list->RowIndex ?>_RemittedTo" id="o<?php echo $deduction_type_list->RowIndex ?>_RemittedTo" value="<?php echo HtmlEncode($deduction_type_list->RemittedTo->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_RemittedTo" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_RemittedTo" name="x<?php echo $deduction_type_list->RowIndex ?>_RemittedTo" id="x<?php echo $deduction_type_list->RowIndex ?>_RemittedTo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_list->RemittedTo->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->RemittedTo->EditValue ?>"<?php echo $deduction_type_list->RemittedTo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_RemittedTo">
<span<?php echo $deduction_type_list->RemittedTo->viewAttributes() ?>><?php echo $deduction_type_list->RemittedTo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->AccountNo->Visible) { // AccountNo ?>
		<td data-name="AccountNo" <?php echo $deduction_type_list->AccountNo->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_AccountNo" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $deduction_type_list->RowIndex ?>_AccountNo"><?php echo EmptyValue(strval($deduction_type_list->AccountNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_list->AccountNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_list->AccountNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_list->AccountNo->ReadOnly || $deduction_type_list->AccountNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $deduction_type_list->RowIndex ?>_AccountNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_list->AccountNo->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_AccountNo") ?>
<input type="hidden" data-table="deduction_type" data-field="x_AccountNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_list->AccountNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_AccountNo" id="x<?php echo $deduction_type_list->RowIndex ?>_AccountNo" value="<?php echo $deduction_type_list->AccountNo->CurrentValue ?>"<?php echo $deduction_type_list->AccountNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_AccountNo" name="o<?php echo $deduction_type_list->RowIndex ?>_AccountNo" id="o<?php echo $deduction_type_list->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($deduction_type_list->AccountNo->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_AccountNo" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $deduction_type_list->RowIndex ?>_AccountNo"><?php echo EmptyValue(strval($deduction_type_list->AccountNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_list->AccountNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_list->AccountNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_list->AccountNo->ReadOnly || $deduction_type_list->AccountNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $deduction_type_list->RowIndex ?>_AccountNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_list->AccountNo->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_AccountNo") ?>
<input type="hidden" data-table="deduction_type" data-field="x_AccountNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_list->AccountNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_AccountNo" id="x<?php echo $deduction_type_list->RowIndex ?>_AccountNo" value="<?php echo $deduction_type_list->AccountNo->CurrentValue ?>"<?php echo $deduction_type_list->AccountNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_AccountNo">
<span<?php echo $deduction_type_list->AccountNo->viewAttributes() ?>><?php echo $deduction_type_list->AccountNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
		<td data-name="BaseIncomeCode" <?php echo $deduction_type_list->BaseIncomeCode->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_BaseIncomeCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode"><?php echo EmptyValue(strval($deduction_type_list->BaseIncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_list->BaseIncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_list->BaseIncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_list->BaseIncomeCode->ReadOnly || $deduction_type_list->BaseIncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_list->BaseIncomeCode->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_BaseIncomeCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_BaseIncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_list->BaseIncomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode" id="x<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode" value="<?php echo $deduction_type_list->BaseIncomeCode->CurrentValue ?>"<?php echo $deduction_type_list->BaseIncomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_BaseIncomeCode" name="o<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode" id="o<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode" value="<?php echo HtmlEncode($deduction_type_list->BaseIncomeCode->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_BaseIncomeCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode"><?php echo EmptyValue(strval($deduction_type_list->BaseIncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_list->BaseIncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_list->BaseIncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_list->BaseIncomeCode->ReadOnly || $deduction_type_list->BaseIncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_list->BaseIncomeCode->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_BaseIncomeCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_BaseIncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_list->BaseIncomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode" id="x<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode" value="<?php echo $deduction_type_list->BaseIncomeCode->CurrentValue ?>"<?php echo $deduction_type_list->BaseIncomeCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_BaseIncomeCode">
<span<?php echo $deduction_type_list->BaseIncomeCode->viewAttributes() ?>><?php echo $deduction_type_list->BaseIncomeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->BaseDeductionCode->Visible) { // BaseDeductionCode ?>
		<td data-name="BaseDeductionCode" <?php echo $deduction_type_list->BaseDeductionCode->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_BaseDeductionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode"><?php echo EmptyValue(strval($deduction_type_list->BaseDeductionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_list->BaseDeductionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_list->BaseDeductionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_list->BaseDeductionCode->ReadOnly || $deduction_type_list->BaseDeductionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_list->BaseDeductionCode->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_BaseDeductionCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_BaseDeductionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_list->BaseDeductionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode" id="x<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode" value="<?php echo $deduction_type_list->BaseDeductionCode->CurrentValue ?>"<?php echo $deduction_type_list->BaseDeductionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_BaseDeductionCode" name="o<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode" id="o<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode" value="<?php echo HtmlEncode($deduction_type_list->BaseDeductionCode->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_BaseDeductionCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode"><?php echo EmptyValue(strval($deduction_type_list->BaseDeductionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_list->BaseDeductionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_list->BaseDeductionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_list->BaseDeductionCode->ReadOnly || $deduction_type_list->BaseDeductionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_list->BaseDeductionCode->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_BaseDeductionCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_BaseDeductionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_list->BaseDeductionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode" id="x<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode" value="<?php echo $deduction_type_list->BaseDeductionCode->CurrentValue ?>"<?php echo $deduction_type_list->BaseDeductionCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_BaseDeductionCode">
<span<?php echo $deduction_type_list->BaseDeductionCode->viewAttributes() ?>><?php echo $deduction_type_list->BaseDeductionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->TaxExempt->Visible) { // TaxExempt ?>
		<td data-name="TaxExempt" <?php echo $deduction_type_list->TaxExempt->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_TaxExempt" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_type" data-field="x_TaxExempt" data-value-separator="<?php echo $deduction_type_list->TaxExempt->displayValueSeparatorAttribute() ?>" id="x<?php echo $deduction_type_list->RowIndex ?>_TaxExempt" name="x<?php echo $deduction_type_list->RowIndex ?>_TaxExempt"<?php echo $deduction_type_list->TaxExempt->editAttributes() ?>>
			<?php echo $deduction_type_list->TaxExempt->selectOptionListHtml("x{$deduction_type_list->RowIndex}_TaxExempt") ?>
		</select>
</div>
<?php echo $deduction_type_list->TaxExempt->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_TaxExempt") ?>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_TaxExempt" name="o<?php echo $deduction_type_list->RowIndex ?>_TaxExempt" id="o<?php echo $deduction_type_list->RowIndex ?>_TaxExempt" value="<?php echo HtmlEncode($deduction_type_list->TaxExempt->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_TaxExempt" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_type" data-field="x_TaxExempt" data-value-separator="<?php echo $deduction_type_list->TaxExempt->displayValueSeparatorAttribute() ?>" id="x<?php echo $deduction_type_list->RowIndex ?>_TaxExempt" name="x<?php echo $deduction_type_list->RowIndex ?>_TaxExempt"<?php echo $deduction_type_list->TaxExempt->editAttributes() ?>>
			<?php echo $deduction_type_list->TaxExempt->selectOptionListHtml("x{$deduction_type_list->RowIndex}_TaxExempt") ?>
		</select>
</div>
<?php echo $deduction_type_list->TaxExempt->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_TaxExempt") ?>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_TaxExempt">
<span<?php echo $deduction_type_list->TaxExempt->viewAttributes() ?>><?php echo $deduction_type_list->TaxExempt->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->JobCode->Visible) { // JobCode ?>
		<td data-name="JobCode" <?php echo $deduction_type_list->JobCode->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_JobCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $deduction_type_list->RowIndex ?>_JobCode"><?php echo EmptyValue(strval($deduction_type_list->JobCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_list->JobCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_list->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_list->JobCode->ReadOnly || $deduction_type_list->JobCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $deduction_type_list->RowIndex ?>_JobCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_list->JobCode->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_JobCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_JobCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $deduction_type_list->JobCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_JobCode[]" id="x<?php echo $deduction_type_list->RowIndex ?>_JobCode[]" value="<?php echo $deduction_type_list->JobCode->CurrentValue ?>"<?php echo $deduction_type_list->JobCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_JobCode" name="o<?php echo $deduction_type_list->RowIndex ?>_JobCode[]" id="o<?php echo $deduction_type_list->RowIndex ?>_JobCode[]" value="<?php echo HtmlEncode($deduction_type_list->JobCode->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_JobCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $deduction_type_list->RowIndex ?>_JobCode"><?php echo EmptyValue(strval($deduction_type_list->JobCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_list->JobCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_list->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_list->JobCode->ReadOnly || $deduction_type_list->JobCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $deduction_type_list->RowIndex ?>_JobCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_list->JobCode->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_JobCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_JobCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $deduction_type_list->JobCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_JobCode[]" id="x<?php echo $deduction_type_list->RowIndex ?>_JobCode[]" value="<?php echo $deduction_type_list->JobCode->CurrentValue ?>"<?php echo $deduction_type_list->JobCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_JobCode">
<span<?php echo $deduction_type_list->JobCode->viewAttributes() ?>><?php echo $deduction_type_list->JobCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->MinimumAmount->Visible) { // MinimumAmount ?>
		<td data-name="MinimumAmount" <?php echo $deduction_type_list->MinimumAmount->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_MinimumAmount" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_MinimumAmount" name="x<?php echo $deduction_type_list->RowIndex ?>_MinimumAmount" id="x<?php echo $deduction_type_list->RowIndex ?>_MinimumAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->MinimumAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->MinimumAmount->EditValue ?>"<?php echo $deduction_type_list->MinimumAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_MinimumAmount" name="o<?php echo $deduction_type_list->RowIndex ?>_MinimumAmount" id="o<?php echo $deduction_type_list->RowIndex ?>_MinimumAmount" value="<?php echo HtmlEncode($deduction_type_list->MinimumAmount->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_MinimumAmount" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_MinimumAmount" name="x<?php echo $deduction_type_list->RowIndex ?>_MinimumAmount" id="x<?php echo $deduction_type_list->RowIndex ?>_MinimumAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->MinimumAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->MinimumAmount->EditValue ?>"<?php echo $deduction_type_list->MinimumAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_MinimumAmount">
<span<?php echo $deduction_type_list->MinimumAmount->viewAttributes() ?>><?php echo $deduction_type_list->MinimumAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->MaximumAmount->Visible) { // MaximumAmount ?>
		<td data-name="MaximumAmount" <?php echo $deduction_type_list->MaximumAmount->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_MaximumAmount" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_MaximumAmount" name="x<?php echo $deduction_type_list->RowIndex ?>_MaximumAmount" id="x<?php echo $deduction_type_list->RowIndex ?>_MaximumAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->MaximumAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->MaximumAmount->EditValue ?>"<?php echo $deduction_type_list->MaximumAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_MaximumAmount" name="o<?php echo $deduction_type_list->RowIndex ?>_MaximumAmount" id="o<?php echo $deduction_type_list->RowIndex ?>_MaximumAmount" value="<?php echo HtmlEncode($deduction_type_list->MaximumAmount->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_MaximumAmount" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_MaximumAmount" name="x<?php echo $deduction_type_list->RowIndex ?>_MaximumAmount" id="x<?php echo $deduction_type_list->RowIndex ?>_MaximumAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->MaximumAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->MaximumAmount->EditValue ?>"<?php echo $deduction_type_list->MaximumAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_MaximumAmount">
<span<?php echo $deduction_type_list->MaximumAmount->viewAttributes() ?>><?php echo $deduction_type_list->MaximumAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->EmployerContributionRate->Visible) { // EmployerContributionRate ?>
		<td data-name="EmployerContributionRate" <?php echo $deduction_type_list->EmployerContributionRate->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_EmployerContributionRate" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_EmployerContributionRate" name="x<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionRate" id="x<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionRate" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->EmployerContributionRate->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->EmployerContributionRate->EditValue ?>"<?php echo $deduction_type_list->EmployerContributionRate->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_EmployerContributionRate" name="o<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionRate" id="o<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionRate" value="<?php echo HtmlEncode($deduction_type_list->EmployerContributionRate->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_EmployerContributionRate" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_EmployerContributionRate" name="x<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionRate" id="x<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionRate" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->EmployerContributionRate->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->EmployerContributionRate->EditValue ?>"<?php echo $deduction_type_list->EmployerContributionRate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_EmployerContributionRate">
<span<?php echo $deduction_type_list->EmployerContributionRate->viewAttributes() ?>><?php echo $deduction_type_list->EmployerContributionRate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->EmployerContributionAmount->Visible) { // EmployerContributionAmount ?>
		<td data-name="EmployerContributionAmount" <?php echo $deduction_type_list->EmployerContributionAmount->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_EmployerContributionAmount" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_EmployerContributionAmount" name="x<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionAmount" id="x<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->EmployerContributionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->EmployerContributionAmount->EditValue ?>"<?php echo $deduction_type_list->EmployerContributionAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_EmployerContributionAmount" name="o<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionAmount" id="o<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionAmount" value="<?php echo HtmlEncode($deduction_type_list->EmployerContributionAmount->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_EmployerContributionAmount" class="form-group">
<input type="text" data-table="deduction_type" data-field="x_EmployerContributionAmount" name="x<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionAmount" id="x<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->EmployerContributionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->EmployerContributionAmount->EditValue ?>"<?php echo $deduction_type_list->EmployerContributionAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_EmployerContributionAmount">
<span<?php echo $deduction_type_list->EmployerContributionAmount->viewAttributes() ?>><?php echo $deduction_type_list->EmployerContributionAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($deduction_type_list->Application->Visible) { // Application ?>
		<td data-name="Application" <?php echo $deduction_type_list->Application->cellAttributes() ?>>
<?php if ($deduction_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_Application" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_type" data-field="x_Application" data-value-separator="<?php echo $deduction_type_list->Application->displayValueSeparatorAttribute() ?>" id="x<?php echo $deduction_type_list->RowIndex ?>_Application" name="x<?php echo $deduction_type_list->RowIndex ?>_Application"<?php echo $deduction_type_list->Application->editAttributes() ?>>
			<?php echo $deduction_type_list->Application->selectOptionListHtml("x{$deduction_type_list->RowIndex}_Application") ?>
		</select>
</div>
<?php echo $deduction_type_list->Application->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_Application") ?>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_Application" name="o<?php echo $deduction_type_list->RowIndex ?>_Application" id="o<?php echo $deduction_type_list->RowIndex ?>_Application" value="<?php echo HtmlEncode($deduction_type_list->Application->OldValue) ?>">
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_Application" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_type" data-field="x_Application" data-value-separator="<?php echo $deduction_type_list->Application->displayValueSeparatorAttribute() ?>" id="x<?php echo $deduction_type_list->RowIndex ?>_Application" name="x<?php echo $deduction_type_list->RowIndex ?>_Application"<?php echo $deduction_type_list->Application->editAttributes() ?>>
			<?php echo $deduction_type_list->Application->selectOptionListHtml("x{$deduction_type_list->RowIndex}_Application") ?>
		</select>
</div>
<?php echo $deduction_type_list->Application->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_Application") ?>
</span>
<?php } ?>
<?php if ($deduction_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $deduction_type_list->RowCount ?>_deduction_type_Application">
<span<?php echo $deduction_type_list->Application->viewAttributes() ?>><?php echo $deduction_type_list->Application->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$deduction_type_list->ListOptions->render("body", "right", $deduction_type_list->RowCount);
?>
	</tr>
<?php if ($deduction_type->RowType == ROWTYPE_ADD || $deduction_type->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fdeduction_typelist", "load"], function() {
	fdeduction_typelist.updateLists(<?php echo $deduction_type_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$deduction_type_list->isGridAdd())
		if (!$deduction_type_list->Recordset->EOF)
			$deduction_type_list->Recordset->moveNext();
}
?>
<?php
	if ($deduction_type_list->isGridAdd() || $deduction_type_list->isGridEdit()) {
		$deduction_type_list->RowIndex = '$rowindex$';
		$deduction_type_list->loadRowValues();

		// Set row properties
		$deduction_type->resetAttributes();
		$deduction_type->RowAttrs->merge(["data-rowindex" => $deduction_type_list->RowIndex, "id" => "r0_deduction_type", "data-rowtype" => ROWTYPE_ADD]);
		$deduction_type->RowAttrs->appendClass("ew-template");
		$deduction_type->RowType = ROWTYPE_ADD;

		// Render row
		$deduction_type_list->renderRow();

		// Render list options
		$deduction_type_list->renderListOptions();
		$deduction_type_list->StartRowCount = 0;
?>
	<tr <?php echo $deduction_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$deduction_type_list->ListOptions->render("body", "left", $deduction_type_list->RowIndex);
?>
	<?php if ($deduction_type_list->DeductionCode->Visible) { // DeductionCode ?>
		<td data-name="DeductionCode">
<span id="el$rowindex$_deduction_type_DeductionCode" class="form-group deduction_type_DeductionCode"></span>
<input type="hidden" data-table="deduction_type" data-field="x_DeductionCode" name="o<?php echo $deduction_type_list->RowIndex ?>_DeductionCode" id="o<?php echo $deduction_type_list->RowIndex ?>_DeductionCode" value="<?php echo HtmlEncode($deduction_type_list->DeductionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName">
<span id="el$rowindex$_deduction_type_DeductionName" class="form-group deduction_type_DeductionName">
<input type="text" data-table="deduction_type" data-field="x_DeductionName" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionName" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_list->DeductionName->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->DeductionName->EditValue ?>"<?php echo $deduction_type_list->DeductionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_DeductionName" name="o<?php echo $deduction_type_list->RowIndex ?>_DeductionName" id="o<?php echo $deduction_type_list->RowIndex ?>_DeductionName" value="<?php echo HtmlEncode($deduction_type_list->DeductionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->DeductionDescription->Visible) { // DeductionDescription ?>
		<td data-name="DeductionDescription">
<span id="el$rowindex$_deduction_type_DeductionDescription" class="form-group deduction_type_DeductionDescription">
<textarea data-table="deduction_type" data-field="x_DeductionDescription" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionDescription" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionDescription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($deduction_type_list->DeductionDescription->getPlaceHolder()) ?>"<?php echo $deduction_type_list->DeductionDescription->editAttributes() ?>><?php echo $deduction_type_list->DeductionDescription->EditValue ?></textarea>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_DeductionDescription" name="o<?php echo $deduction_type_list->RowIndex ?>_DeductionDescription" id="o<?php echo $deduction_type_list->RowIndex ?>_DeductionDescription" value="<?php echo HtmlEncode($deduction_type_list->DeductionDescription->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->Division->Visible) { // Division ?>
		<td data-name="Division">
<span id="el$rowindex$_deduction_type_Division" class="form-group deduction_type_Division">
<div id="tp_x<?php echo $deduction_type_list->RowIndex ?>_Division" class="ew-template"><input type="checkbox" class="custom-control-input" data-table="deduction_type" data-field="x_Division" data-value-separator="<?php echo $deduction_type_list->Division->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_Division[]" id="x<?php echo $deduction_type_list->RowIndex ?>_Division[]" value="{value}"<?php echo $deduction_type_list->Division->editAttributes() ?>></div>
<div id="dsl_x<?php echo $deduction_type_list->RowIndex ?>_Division" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $deduction_type_list->Division->checkBoxListHtml(FALSE, "x{$deduction_type_list->RowIndex}_Division[]") ?>
</div></div>
<?php echo $deduction_type_list->Division->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_Division") ?>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_Division" name="o<?php echo $deduction_type_list->RowIndex ?>_Division[]" id="o<?php echo $deduction_type_list->RowIndex ?>_Division[]" value="<?php echo HtmlEncode($deduction_type_list->Division->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->DeductionAmount->Visible) { // DeductionAmount ?>
		<td data-name="DeductionAmount">
<span id="el$rowindex$_deduction_type_DeductionAmount" class="form-group deduction_type_DeductionAmount">
<input type="text" data-table="deduction_type" data-field="x_DeductionAmount" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionAmount" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->DeductionAmount->EditValue ?>"<?php echo $deduction_type_list->DeductionAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_DeductionAmount" name="o<?php echo $deduction_type_list->RowIndex ?>_DeductionAmount" id="o<?php echo $deduction_type_list->RowIndex ?>_DeductionAmount" value="<?php echo HtmlEncode($deduction_type_list->DeductionAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->DeductionBasicRate->Visible) { // DeductionBasicRate ?>
		<td data-name="DeductionBasicRate">
<span id="el$rowindex$_deduction_type_DeductionBasicRate" class="form-group deduction_type_DeductionBasicRate">
<input type="text" data-table="deduction_type" data-field="x_DeductionBasicRate" name="x<?php echo $deduction_type_list->RowIndex ?>_DeductionBasicRate" id="x<?php echo $deduction_type_list->RowIndex ?>_DeductionBasicRate" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->DeductionBasicRate->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->DeductionBasicRate->EditValue ?>"<?php echo $deduction_type_list->DeductionBasicRate->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_DeductionBasicRate" name="o<?php echo $deduction_type_list->RowIndex ?>_DeductionBasicRate" id="o<?php echo $deduction_type_list->RowIndex ?>_DeductionBasicRate" value="<?php echo HtmlEncode($deduction_type_list->DeductionBasicRate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->RemittedTo->Visible) { // RemittedTo ?>
		<td data-name="RemittedTo">
<span id="el$rowindex$_deduction_type_RemittedTo" class="form-group deduction_type_RemittedTo">
<input type="text" data-table="deduction_type" data-field="x_RemittedTo" name="x<?php echo $deduction_type_list->RowIndex ?>_RemittedTo" id="x<?php echo $deduction_type_list->RowIndex ?>_RemittedTo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($deduction_type_list->RemittedTo->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->RemittedTo->EditValue ?>"<?php echo $deduction_type_list->RemittedTo->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_RemittedTo" name="o<?php echo $deduction_type_list->RowIndex ?>_RemittedTo" id="o<?php echo $deduction_type_list->RowIndex ?>_RemittedTo" value="<?php echo HtmlEncode($deduction_type_list->RemittedTo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->AccountNo->Visible) { // AccountNo ?>
		<td data-name="AccountNo">
<span id="el$rowindex$_deduction_type_AccountNo" class="form-group deduction_type_AccountNo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $deduction_type_list->RowIndex ?>_AccountNo"><?php echo EmptyValue(strval($deduction_type_list->AccountNo->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_list->AccountNo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_list->AccountNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_list->AccountNo->ReadOnly || $deduction_type_list->AccountNo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $deduction_type_list->RowIndex ?>_AccountNo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_list->AccountNo->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_AccountNo") ?>
<input type="hidden" data-table="deduction_type" data-field="x_AccountNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_list->AccountNo->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_AccountNo" id="x<?php echo $deduction_type_list->RowIndex ?>_AccountNo" value="<?php echo $deduction_type_list->AccountNo->CurrentValue ?>"<?php echo $deduction_type_list->AccountNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_AccountNo" name="o<?php echo $deduction_type_list->RowIndex ?>_AccountNo" id="o<?php echo $deduction_type_list->RowIndex ?>_AccountNo" value="<?php echo HtmlEncode($deduction_type_list->AccountNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->BaseIncomeCode->Visible) { // BaseIncomeCode ?>
		<td data-name="BaseIncomeCode">
<span id="el$rowindex$_deduction_type_BaseIncomeCode" class="form-group deduction_type_BaseIncomeCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode"><?php echo EmptyValue(strval($deduction_type_list->BaseIncomeCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_list->BaseIncomeCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_list->BaseIncomeCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_list->BaseIncomeCode->ReadOnly || $deduction_type_list->BaseIncomeCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_list->BaseIncomeCode->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_BaseIncomeCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_BaseIncomeCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_list->BaseIncomeCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode" id="x<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode" value="<?php echo $deduction_type_list->BaseIncomeCode->CurrentValue ?>"<?php echo $deduction_type_list->BaseIncomeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_BaseIncomeCode" name="o<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode" id="o<?php echo $deduction_type_list->RowIndex ?>_BaseIncomeCode" value="<?php echo HtmlEncode($deduction_type_list->BaseIncomeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->BaseDeductionCode->Visible) { // BaseDeductionCode ?>
		<td data-name="BaseDeductionCode">
<span id="el$rowindex$_deduction_type_BaseDeductionCode" class="form-group deduction_type_BaseDeductionCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode"><?php echo EmptyValue(strval($deduction_type_list->BaseDeductionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_list->BaseDeductionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_list->BaseDeductionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_list->BaseDeductionCode->ReadOnly || $deduction_type_list->BaseDeductionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_list->BaseDeductionCode->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_BaseDeductionCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_BaseDeductionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $deduction_type_list->BaseDeductionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode" id="x<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode" value="<?php echo $deduction_type_list->BaseDeductionCode->CurrentValue ?>"<?php echo $deduction_type_list->BaseDeductionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_BaseDeductionCode" name="o<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode" id="o<?php echo $deduction_type_list->RowIndex ?>_BaseDeductionCode" value="<?php echo HtmlEncode($deduction_type_list->BaseDeductionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->TaxExempt->Visible) { // TaxExempt ?>
		<td data-name="TaxExempt">
<span id="el$rowindex$_deduction_type_TaxExempt" class="form-group deduction_type_TaxExempt">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_type" data-field="x_TaxExempt" data-value-separator="<?php echo $deduction_type_list->TaxExempt->displayValueSeparatorAttribute() ?>" id="x<?php echo $deduction_type_list->RowIndex ?>_TaxExempt" name="x<?php echo $deduction_type_list->RowIndex ?>_TaxExempt"<?php echo $deduction_type_list->TaxExempt->editAttributes() ?>>
			<?php echo $deduction_type_list->TaxExempt->selectOptionListHtml("x{$deduction_type_list->RowIndex}_TaxExempt") ?>
		</select>
</div>
<?php echo $deduction_type_list->TaxExempt->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_TaxExempt") ?>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_TaxExempt" name="o<?php echo $deduction_type_list->RowIndex ?>_TaxExempt" id="o<?php echo $deduction_type_list->RowIndex ?>_TaxExempt" value="<?php echo HtmlEncode($deduction_type_list->TaxExempt->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->JobCode->Visible) { // JobCode ?>
		<td data-name="JobCode">
<span id="el$rowindex$_deduction_type_JobCode" class="form-group deduction_type_JobCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $deduction_type_list->RowIndex ?>_JobCode"><?php echo EmptyValue(strval($deduction_type_list->JobCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $deduction_type_list->JobCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($deduction_type_list->JobCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($deduction_type_list->JobCode->ReadOnly || $deduction_type_list->JobCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $deduction_type_list->RowIndex ?>_JobCode[]',m:1,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $deduction_type_list->JobCode->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_JobCode") ?>
<input type="hidden" data-table="deduction_type" data-field="x_JobCode" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $deduction_type_list->JobCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $deduction_type_list->RowIndex ?>_JobCode[]" id="x<?php echo $deduction_type_list->RowIndex ?>_JobCode[]" value="<?php echo $deduction_type_list->JobCode->CurrentValue ?>"<?php echo $deduction_type_list->JobCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_JobCode" name="o<?php echo $deduction_type_list->RowIndex ?>_JobCode[]" id="o<?php echo $deduction_type_list->RowIndex ?>_JobCode[]" value="<?php echo HtmlEncode($deduction_type_list->JobCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->MinimumAmount->Visible) { // MinimumAmount ?>
		<td data-name="MinimumAmount">
<span id="el$rowindex$_deduction_type_MinimumAmount" class="form-group deduction_type_MinimumAmount">
<input type="text" data-table="deduction_type" data-field="x_MinimumAmount" name="x<?php echo $deduction_type_list->RowIndex ?>_MinimumAmount" id="x<?php echo $deduction_type_list->RowIndex ?>_MinimumAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->MinimumAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->MinimumAmount->EditValue ?>"<?php echo $deduction_type_list->MinimumAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_MinimumAmount" name="o<?php echo $deduction_type_list->RowIndex ?>_MinimumAmount" id="o<?php echo $deduction_type_list->RowIndex ?>_MinimumAmount" value="<?php echo HtmlEncode($deduction_type_list->MinimumAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->MaximumAmount->Visible) { // MaximumAmount ?>
		<td data-name="MaximumAmount">
<span id="el$rowindex$_deduction_type_MaximumAmount" class="form-group deduction_type_MaximumAmount">
<input type="text" data-table="deduction_type" data-field="x_MaximumAmount" name="x<?php echo $deduction_type_list->RowIndex ?>_MaximumAmount" id="x<?php echo $deduction_type_list->RowIndex ?>_MaximumAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->MaximumAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->MaximumAmount->EditValue ?>"<?php echo $deduction_type_list->MaximumAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_MaximumAmount" name="o<?php echo $deduction_type_list->RowIndex ?>_MaximumAmount" id="o<?php echo $deduction_type_list->RowIndex ?>_MaximumAmount" value="<?php echo HtmlEncode($deduction_type_list->MaximumAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->EmployerContributionRate->Visible) { // EmployerContributionRate ?>
		<td data-name="EmployerContributionRate">
<span id="el$rowindex$_deduction_type_EmployerContributionRate" class="form-group deduction_type_EmployerContributionRate">
<input type="text" data-table="deduction_type" data-field="x_EmployerContributionRate" name="x<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionRate" id="x<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionRate" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->EmployerContributionRate->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->EmployerContributionRate->EditValue ?>"<?php echo $deduction_type_list->EmployerContributionRate->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_EmployerContributionRate" name="o<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionRate" id="o<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionRate" value="<?php echo HtmlEncode($deduction_type_list->EmployerContributionRate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->EmployerContributionAmount->Visible) { // EmployerContributionAmount ?>
		<td data-name="EmployerContributionAmount">
<span id="el$rowindex$_deduction_type_EmployerContributionAmount" class="form-group deduction_type_EmployerContributionAmount">
<input type="text" data-table="deduction_type" data-field="x_EmployerContributionAmount" name="x<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionAmount" id="x<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionAmount" size="30" placeholder="<?php echo HtmlEncode($deduction_type_list->EmployerContributionAmount->getPlaceHolder()) ?>" value="<?php echo $deduction_type_list->EmployerContributionAmount->EditValue ?>"<?php echo $deduction_type_list->EmployerContributionAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_EmployerContributionAmount" name="o<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionAmount" id="o<?php echo $deduction_type_list->RowIndex ?>_EmployerContributionAmount" value="<?php echo HtmlEncode($deduction_type_list->EmployerContributionAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($deduction_type_list->Application->Visible) { // Application ?>
		<td data-name="Application">
<span id="el$rowindex$_deduction_type_Application" class="form-group deduction_type_Application">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="deduction_type" data-field="x_Application" data-value-separator="<?php echo $deduction_type_list->Application->displayValueSeparatorAttribute() ?>" id="x<?php echo $deduction_type_list->RowIndex ?>_Application" name="x<?php echo $deduction_type_list->RowIndex ?>_Application"<?php echo $deduction_type_list->Application->editAttributes() ?>>
			<?php echo $deduction_type_list->Application->selectOptionListHtml("x{$deduction_type_list->RowIndex}_Application") ?>
		</select>
</div>
<?php echo $deduction_type_list->Application->Lookup->getParamTag($deduction_type_list, "p_x" . $deduction_type_list->RowIndex . "_Application") ?>
</span>
<input type="hidden" data-table="deduction_type" data-field="x_Application" name="o<?php echo $deduction_type_list->RowIndex ?>_Application" id="o<?php echo $deduction_type_list->RowIndex ?>_Application" value="<?php echo HtmlEncode($deduction_type_list->Application->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$deduction_type_list->ListOptions->render("body", "right", $deduction_type_list->RowIndex);
?>
<script>
loadjs.ready(["fdeduction_typelist", "load"], function() {
	fdeduction_typelist.updateLists(<?php echo $deduction_type_list->RowIndex ?>);
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
<?php if ($deduction_type_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $deduction_type_list->FormKeyCountName ?>" id="<?php echo $deduction_type_list->FormKeyCountName ?>" value="<?php echo $deduction_type_list->KeyCount ?>">
<?php echo $deduction_type_list->MultiSelectKey ?>
<?php } ?>
<?php if ($deduction_type_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $deduction_type_list->FormKeyCountName ?>" id="<?php echo $deduction_type_list->FormKeyCountName ?>" value="<?php echo $deduction_type_list->KeyCount ?>">
<?php echo $deduction_type_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$deduction_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($deduction_type_list->Recordset)
	$deduction_type_list->Recordset->Close();
?>
<?php if (!$deduction_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$deduction_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $deduction_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $deduction_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($deduction_type_list->TotalRecords == 0 && !$deduction_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $deduction_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$deduction_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$deduction_type_list->isExport()) { ?>
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
$deduction_type_list->terminate();
?>