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
$third_party_list = new third_party_list();

// Run the page
$third_party_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$third_party_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$third_party_list->isExport()) { ?>
<script>
var fthird_partylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fthird_partylist = currentForm = new ew.Form("fthird_partylist", "list");
	fthird_partylist.formKeyCountName = '<?php echo $third_party_list->FormKeyCountName ?>';

	// Validate form
	fthird_partylist.validate = function() {
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
			<?php if ($third_party_list->ThirdPartyName->Required) { ?>
				elm = this.getElements("x" + infix + "_ThirdPartyName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->ThirdPartyName->caption(), $third_party_list->ThirdPartyName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_list->DateOfEngagement->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfEngagement");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->DateOfEngagement->caption(), $third_party_list->DateOfEngagement->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfEngagement");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($third_party_list->DateOfEngagement->errorMessage()) ?>");
			<?php if ($third_party_list->DeductionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->DeductionCode->caption(), $third_party_list->DeductionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_list->DeductionRate->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionRate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->DeductionRate->caption(), $third_party_list->DeductionRate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionRate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($third_party_list->DeductionRate->errorMessage()) ?>");
			<?php if ($third_party_list->DeductionAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->DeductionAmount->caption(), $third_party_list->DeductionAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($third_party_list->DeductionAmount->errorMessage()) ?>");
			<?php if ($third_party_list->DeductionLimit->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionLimit");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->DeductionLimit->caption(), $third_party_list->DeductionLimit->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeductionLimit");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($third_party_list->DeductionLimit->errorMessage()) ?>");
			<?php if ($third_party_list->EmployerContribution->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployerContribution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->EmployerContribution->caption(), $third_party_list->EmployerContribution->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployerContribution");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($third_party_list->EmployerContribution->errorMessage()) ?>");
			<?php if ($third_party_list->DeductionDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_DeductionDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->DeductionDescription->caption(), $third_party_list->DeductionDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_list->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->PostalAddress->caption(), $third_party_list->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_list->PhysicalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->PhysicalAddress->caption(), $third_party_list->PhysicalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_list->TownOrVillage->Required) { ?>
				elm = this.getElements("x" + infix + "_TownOrVillage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->TownOrVillage->caption(), $third_party_list->TownOrVillage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_list->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->Telephone->caption(), $third_party_list->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_list->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->Mobile->caption(), $third_party_list->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_list->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->Fax->caption(), $third_party_list->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_list->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->_Email->caption(), $third_party_list->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_list->BankBranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankBranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->BankBranchCode->caption(), $third_party_list->BankBranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_list->BankAccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BankAccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->BankAccountNo->caption(), $third_party_list->BankAccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($third_party_list->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $third_party_list->PaymentMethod->caption(), $third_party_list->PaymentMethod->RequiredErrorMessage)) ?>");
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
	fthird_partylist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ThirdPartyName", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfEngagement", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeductionCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeductionRate", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeductionAmount", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeductionLimit", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmployerContribution", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeductionDescription", false)) return false;
		if (ew.valueChanged(fobj, infix, "PostalAddress", false)) return false;
		if (ew.valueChanged(fobj, infix, "PhysicalAddress", false)) return false;
		if (ew.valueChanged(fobj, infix, "TownOrVillage", false)) return false;
		if (ew.valueChanged(fobj, infix, "Telephone", false)) return false;
		if (ew.valueChanged(fobj, infix, "Mobile", false)) return false;
		if (ew.valueChanged(fobj, infix, "Fax", false)) return false;
		if (ew.valueChanged(fobj, infix, "_Email", false)) return false;
		if (ew.valueChanged(fobj, infix, "BankBranchCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "BankAccountNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaymentMethod", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fthird_partylist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fthird_partylist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fthird_partylist.lists["x_DeductionCode"] = <?php echo $third_party_list->DeductionCode->Lookup->toClientList($third_party_list) ?>;
	fthird_partylist.lists["x_DeductionCode"].options = <?php echo JsonEncode($third_party_list->DeductionCode->lookupOptions()) ?>;
	fthird_partylist.lists["x_BankBranchCode"] = <?php echo $third_party_list->BankBranchCode->Lookup->toClientList($third_party_list) ?>;
	fthird_partylist.lists["x_BankBranchCode"].options = <?php echo JsonEncode($third_party_list->BankBranchCode->lookupOptions()) ?>;
	fthird_partylist.lists["x_PaymentMethod"] = <?php echo $third_party_list->PaymentMethod->Lookup->toClientList($third_party_list) ?>;
	fthird_partylist.lists["x_PaymentMethod"].options = <?php echo JsonEncode($third_party_list->PaymentMethod->lookupOptions()) ?>;
	fthird_partylist.autoSuggests["x_PaymentMethod"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fthird_partylist");
});
var fthird_partylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fthird_partylistsrch = currentSearchForm = new ew.Form("fthird_partylistsrch");

	// Dynamic selection lists
	// Filters

	fthird_partylistsrch.filterList = <?php echo $third_party_list->getFilterList() ?>;

	// Init search panel as collapsed
	fthird_partylistsrch.initSearchPanel = true;
	loadjs.done("fthird_partylistsrch");
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
<?php if (!$third_party_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($third_party_list->TotalRecords > 0 && $third_party_list->ExportOptions->visible()) { ?>
<?php $third_party_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($third_party_list->ImportOptions->visible()) { ?>
<?php $third_party_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($third_party_list->SearchOptions->visible()) { ?>
<?php $third_party_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($third_party_list->FilterOptions->visible()) { ?>
<?php $third_party_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$third_party_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$third_party_list->isExport() && !$third_party->CurrentAction) { ?>
<form name="fthird_partylistsrch" id="fthird_partylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fthird_partylistsrch-search-panel" class="<?php echo $third_party_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="third_party">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $third_party_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($third_party_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($third_party_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $third_party_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($third_party_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($third_party_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($third_party_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($third_party_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $third_party_list->showPageHeader(); ?>
<?php
$third_party_list->showMessage();
?>
<?php if ($third_party_list->TotalRecords > 0 || $third_party->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($third_party_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> third_party">
<?php if (!$third_party_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$third_party_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $third_party_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $third_party_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fthird_partylist" id="fthird_partylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="third_party">
<div id="gmp_third_party" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($third_party_list->TotalRecords > 0 || $third_party_list->isGridEdit()) { ?>
<table id="tbl_third_partylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$third_party->RowType = ROWTYPE_HEADER;

// Render list options
$third_party_list->renderListOptions();

// Render list options (header, left)
$third_party_list->ListOptions->render("header", "left");
?>
<?php if ($third_party_list->ThirdPartyName->Visible) { // ThirdPartyName ?>
	<?php if ($third_party_list->SortUrl($third_party_list->ThirdPartyName) == "") { ?>
		<th data-name="ThirdPartyName" class="<?php echo $third_party_list->ThirdPartyName->headerCellClass() ?>"><div id="elh_third_party_ThirdPartyName" class="third_party_ThirdPartyName"><div class="ew-table-header-caption"><?php echo $third_party_list->ThirdPartyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ThirdPartyName" class="<?php echo $third_party_list->ThirdPartyName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->ThirdPartyName) ?>', 1);"><div id="elh_third_party_ThirdPartyName" class="third_party_ThirdPartyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->ThirdPartyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->ThirdPartyName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->ThirdPartyName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->DateOfEngagement->Visible) { // DateOfEngagement ?>
	<?php if ($third_party_list->SortUrl($third_party_list->DateOfEngagement) == "") { ?>
		<th data-name="DateOfEngagement" class="<?php echo $third_party_list->DateOfEngagement->headerCellClass() ?>"><div id="elh_third_party_DateOfEngagement" class="third_party_DateOfEngagement"><div class="ew-table-header-caption"><?php echo $third_party_list->DateOfEngagement->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfEngagement" class="<?php echo $third_party_list->DateOfEngagement->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->DateOfEngagement) ?>', 1);"><div id="elh_third_party_DateOfEngagement" class="third_party_DateOfEngagement">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->DateOfEngagement->caption() ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->DateOfEngagement->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->DateOfEngagement->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->DeductionCode->Visible) { // DeductionCode ?>
	<?php if ($third_party_list->SortUrl($third_party_list->DeductionCode) == "") { ?>
		<th data-name="DeductionCode" class="<?php echo $third_party_list->DeductionCode->headerCellClass() ?>"><div id="elh_third_party_DeductionCode" class="third_party_DeductionCode"><div class="ew-table-header-caption"><?php echo $third_party_list->DeductionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionCode" class="<?php echo $third_party_list->DeductionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->DeductionCode) ?>', 1);"><div id="elh_third_party_DeductionCode" class="third_party_DeductionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->DeductionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->DeductionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->DeductionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->DeductionRate->Visible) { // DeductionRate ?>
	<?php if ($third_party_list->SortUrl($third_party_list->DeductionRate) == "") { ?>
		<th data-name="DeductionRate" class="<?php echo $third_party_list->DeductionRate->headerCellClass() ?>"><div id="elh_third_party_DeductionRate" class="third_party_DeductionRate"><div class="ew-table-header-caption"><?php echo $third_party_list->DeductionRate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionRate" class="<?php echo $third_party_list->DeductionRate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->DeductionRate) ?>', 1);"><div id="elh_third_party_DeductionRate" class="third_party_DeductionRate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->DeductionRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->DeductionRate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->DeductionRate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->DeductionAmount->Visible) { // DeductionAmount ?>
	<?php if ($third_party_list->SortUrl($third_party_list->DeductionAmount) == "") { ?>
		<th data-name="DeductionAmount" class="<?php echo $third_party_list->DeductionAmount->headerCellClass() ?>"><div id="elh_third_party_DeductionAmount" class="third_party_DeductionAmount"><div class="ew-table-header-caption"><?php echo $third_party_list->DeductionAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionAmount" class="<?php echo $third_party_list->DeductionAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->DeductionAmount) ?>', 1);"><div id="elh_third_party_DeductionAmount" class="third_party_DeductionAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->DeductionAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->DeductionAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->DeductionAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->DeductionLimit->Visible) { // DeductionLimit ?>
	<?php if ($third_party_list->SortUrl($third_party_list->DeductionLimit) == "") { ?>
		<th data-name="DeductionLimit" class="<?php echo $third_party_list->DeductionLimit->headerCellClass() ?>"><div id="elh_third_party_DeductionLimit" class="third_party_DeductionLimit"><div class="ew-table-header-caption"><?php echo $third_party_list->DeductionLimit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionLimit" class="<?php echo $third_party_list->DeductionLimit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->DeductionLimit) ?>', 1);"><div id="elh_third_party_DeductionLimit" class="third_party_DeductionLimit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->DeductionLimit->caption() ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->DeductionLimit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->DeductionLimit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->EmployerContribution->Visible) { // EmployerContribution ?>
	<?php if ($third_party_list->SortUrl($third_party_list->EmployerContribution) == "") { ?>
		<th data-name="EmployerContribution" class="<?php echo $third_party_list->EmployerContribution->headerCellClass() ?>"><div id="elh_third_party_EmployerContribution" class="third_party_EmployerContribution"><div class="ew-table-header-caption"><?php echo $third_party_list->EmployerContribution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployerContribution" class="<?php echo $third_party_list->EmployerContribution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->EmployerContribution) ?>', 1);"><div id="elh_third_party_EmployerContribution" class="third_party_EmployerContribution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->EmployerContribution->caption() ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->EmployerContribution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->EmployerContribution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->DeductionDescription->Visible) { // DeductionDescription ?>
	<?php if ($third_party_list->SortUrl($third_party_list->DeductionDescription) == "") { ?>
		<th data-name="DeductionDescription" class="<?php echo $third_party_list->DeductionDescription->headerCellClass() ?>"><div id="elh_third_party_DeductionDescription" class="third_party_DeductionDescription"><div class="ew-table-header-caption"><?php echo $third_party_list->DeductionDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionDescription" class="<?php echo $third_party_list->DeductionDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->DeductionDescription) ?>', 1);"><div id="elh_third_party_DeductionDescription" class="third_party_DeductionDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->DeductionDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->DeductionDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->DeductionDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->PostalAddress->Visible) { // PostalAddress ?>
	<?php if ($third_party_list->SortUrl($third_party_list->PostalAddress) == "") { ?>
		<th data-name="PostalAddress" class="<?php echo $third_party_list->PostalAddress->headerCellClass() ?>"><div id="elh_third_party_PostalAddress" class="third_party_PostalAddress"><div class="ew-table-header-caption"><?php echo $third_party_list->PostalAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostalAddress" class="<?php echo $third_party_list->PostalAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->PostalAddress) ?>', 1);"><div id="elh_third_party_PostalAddress" class="third_party_PostalAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->PostalAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->PostalAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->PostalAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<?php if ($third_party_list->SortUrl($third_party_list->PhysicalAddress) == "") { ?>
		<th data-name="PhysicalAddress" class="<?php echo $third_party_list->PhysicalAddress->headerCellClass() ?>"><div id="elh_third_party_PhysicalAddress" class="third_party_PhysicalAddress"><div class="ew-table-header-caption"><?php echo $third_party_list->PhysicalAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PhysicalAddress" class="<?php echo $third_party_list->PhysicalAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->PhysicalAddress) ?>', 1);"><div id="elh_third_party_PhysicalAddress" class="third_party_PhysicalAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->PhysicalAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->PhysicalAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->PhysicalAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->TownOrVillage->Visible) { // TownOrVillage ?>
	<?php if ($third_party_list->SortUrl($third_party_list->TownOrVillage) == "") { ?>
		<th data-name="TownOrVillage" class="<?php echo $third_party_list->TownOrVillage->headerCellClass() ?>"><div id="elh_third_party_TownOrVillage" class="third_party_TownOrVillage"><div class="ew-table-header-caption"><?php echo $third_party_list->TownOrVillage->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TownOrVillage" class="<?php echo $third_party_list->TownOrVillage->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->TownOrVillage) ?>', 1);"><div id="elh_third_party_TownOrVillage" class="third_party_TownOrVillage">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->TownOrVillage->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->TownOrVillage->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->TownOrVillage->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->Telephone->Visible) { // Telephone ?>
	<?php if ($third_party_list->SortUrl($third_party_list->Telephone) == "") { ?>
		<th data-name="Telephone" class="<?php echo $third_party_list->Telephone->headerCellClass() ?>"><div id="elh_third_party_Telephone" class="third_party_Telephone"><div class="ew-table-header-caption"><?php echo $third_party_list->Telephone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Telephone" class="<?php echo $third_party_list->Telephone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->Telephone) ?>', 1);"><div id="elh_third_party_Telephone" class="third_party_Telephone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->Telephone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->Telephone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->Telephone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->Mobile->Visible) { // Mobile ?>
	<?php if ($third_party_list->SortUrl($third_party_list->Mobile) == "") { ?>
		<th data-name="Mobile" class="<?php echo $third_party_list->Mobile->headerCellClass() ?>"><div id="elh_third_party_Mobile" class="third_party_Mobile"><div class="ew-table-header-caption"><?php echo $third_party_list->Mobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Mobile" class="<?php echo $third_party_list->Mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->Mobile) ?>', 1);"><div id="elh_third_party_Mobile" class="third_party_Mobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->Mobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->Mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->Mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->Fax->Visible) { // Fax ?>
	<?php if ($third_party_list->SortUrl($third_party_list->Fax) == "") { ?>
		<th data-name="Fax" class="<?php echo $third_party_list->Fax->headerCellClass() ?>"><div id="elh_third_party_Fax" class="third_party_Fax"><div class="ew-table-header-caption"><?php echo $third_party_list->Fax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fax" class="<?php echo $third_party_list->Fax->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->Fax) ?>', 1);"><div id="elh_third_party_Fax" class="third_party_Fax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->Fax->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->Fax->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->Fax->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->_Email->Visible) { // Email ?>
	<?php if ($third_party_list->SortUrl($third_party_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $third_party_list->_Email->headerCellClass() ?>"><div id="elh_third_party__Email" class="third_party__Email"><div class="ew-table-header-caption"><?php echo $third_party_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $third_party_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->_Email) ?>', 1);"><div id="elh_third_party__Email" class="third_party__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->BankBranchCode->Visible) { // BankBranchCode ?>
	<?php if ($third_party_list->SortUrl($third_party_list->BankBranchCode) == "") { ?>
		<th data-name="BankBranchCode" class="<?php echo $third_party_list->BankBranchCode->headerCellClass() ?>"><div id="elh_third_party_BankBranchCode" class="third_party_BankBranchCode"><div class="ew-table-header-caption"><?php echo $third_party_list->BankBranchCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankBranchCode" class="<?php echo $third_party_list->BankBranchCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->BankBranchCode) ?>', 1);"><div id="elh_third_party_BankBranchCode" class="third_party_BankBranchCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->BankBranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->BankBranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->BankBranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->BankAccountNo->Visible) { // BankAccountNo ?>
	<?php if ($third_party_list->SortUrl($third_party_list->BankAccountNo) == "") { ?>
		<th data-name="BankAccountNo" class="<?php echo $third_party_list->BankAccountNo->headerCellClass() ?>"><div id="elh_third_party_BankAccountNo" class="third_party_BankAccountNo"><div class="ew-table-header-caption"><?php echo $third_party_list->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankAccountNo" class="<?php echo $third_party_list->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->BankAccountNo) ?>', 1);"><div id="elh_third_party_BankAccountNo" class="third_party_BankAccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->BankAccountNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($third_party_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($third_party_list->SortUrl($third_party_list->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $third_party_list->PaymentMethod->headerCellClass() ?>"><div id="elh_third_party_PaymentMethod" class="third_party_PaymentMethod"><div class="ew-table-header-caption"><?php echo $third_party_list->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $third_party_list->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $third_party_list->SortUrl($third_party_list->PaymentMethod) ?>', 1);"><div id="elh_third_party_PaymentMethod" class="third_party_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $third_party_list->PaymentMethod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($third_party_list->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($third_party_list->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$third_party_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($third_party_list->ExportAll && $third_party_list->isExport()) {
	$third_party_list->StopRecord = $third_party_list->TotalRecords;
} else {

	// Set the last record to display
	if ($third_party_list->TotalRecords > $third_party_list->StartRecord + $third_party_list->DisplayRecords - 1)
		$third_party_list->StopRecord = $third_party_list->StartRecord + $third_party_list->DisplayRecords - 1;
	else
		$third_party_list->StopRecord = $third_party_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($third_party->isConfirm() || $third_party_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($third_party_list->FormKeyCountName) && ($third_party_list->isGridAdd() || $third_party_list->isGridEdit() || $third_party->isConfirm())) {
		$third_party_list->KeyCount = $CurrentForm->getValue($third_party_list->FormKeyCountName);
		$third_party_list->StopRecord = $third_party_list->StartRecord + $third_party_list->KeyCount - 1;
	}
}
$third_party_list->RecordCount = $third_party_list->StartRecord - 1;
if ($third_party_list->Recordset && !$third_party_list->Recordset->EOF) {
	$third_party_list->Recordset->moveFirst();
	$selectLimit = $third_party_list->UseSelectLimit;
	if (!$selectLimit && $third_party_list->StartRecord > 1)
		$third_party_list->Recordset->move($third_party_list->StartRecord - 1);
} elseif (!$third_party->AllowAddDeleteRow && $third_party_list->StopRecord == 0) {
	$third_party_list->StopRecord = $third_party->GridAddRowCount;
}

// Initialize aggregate
$third_party->RowType = ROWTYPE_AGGREGATEINIT;
$third_party->resetAttributes();
$third_party_list->renderRow();
if ($third_party_list->isGridAdd())
	$third_party_list->RowIndex = 0;
if ($third_party_list->isGridEdit())
	$third_party_list->RowIndex = 0;
while ($third_party_list->RecordCount < $third_party_list->StopRecord) {
	$third_party_list->RecordCount++;
	if ($third_party_list->RecordCount >= $third_party_list->StartRecord) {
		$third_party_list->RowCount++;
		if ($third_party_list->isGridAdd() || $third_party_list->isGridEdit() || $third_party->isConfirm()) {
			$third_party_list->RowIndex++;
			$CurrentForm->Index = $third_party_list->RowIndex;
			if ($CurrentForm->hasValue($third_party_list->FormActionName) && ($third_party->isConfirm() || $third_party_list->EventCancelled))
				$third_party_list->RowAction = strval($CurrentForm->getValue($third_party_list->FormActionName));
			elseif ($third_party_list->isGridAdd())
				$third_party_list->RowAction = "insert";
			else
				$third_party_list->RowAction = "";
		}

		// Set up key count
		$third_party_list->KeyCount = $third_party_list->RowIndex;

		// Init row class and style
		$third_party->resetAttributes();
		$third_party->CssClass = "";
		if ($third_party_list->isGridAdd()) {
			$third_party_list->loadRowValues(); // Load default values
		} else {
			$third_party_list->loadRowValues($third_party_list->Recordset); // Load row values
		}
		$third_party->RowType = ROWTYPE_VIEW; // Render view
		if ($third_party_list->isGridAdd()) // Grid add
			$third_party->RowType = ROWTYPE_ADD; // Render add
		if ($third_party_list->isGridAdd() && $third_party->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$third_party_list->restoreCurrentRowFormValues($third_party_list->RowIndex); // Restore form values
		if ($third_party_list->isGridEdit()) { // Grid edit
			if ($third_party->EventCancelled)
				$third_party_list->restoreCurrentRowFormValues($third_party_list->RowIndex); // Restore form values
			if ($third_party_list->RowAction == "insert")
				$third_party->RowType = ROWTYPE_ADD; // Render add
			else
				$third_party->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($third_party_list->isGridEdit() && ($third_party->RowType == ROWTYPE_EDIT || $third_party->RowType == ROWTYPE_ADD) && $third_party->EventCancelled) // Update failed
			$third_party_list->restoreCurrentRowFormValues($third_party_list->RowIndex); // Restore form values
		if ($third_party->RowType == ROWTYPE_EDIT) // Edit row
			$third_party_list->EditRowCount++;

		// Set up row id / data-rowindex
		$third_party->RowAttrs->merge(["data-rowindex" => $third_party_list->RowCount, "id" => "r" . $third_party_list->RowCount . "_third_party", "data-rowtype" => $third_party->RowType]);

		// Render row
		$third_party_list->renderRow();

		// Render list options
		$third_party_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($third_party_list->RowAction != "delete" && $third_party_list->RowAction != "insertdelete" && !($third_party_list->RowAction == "insert" && $third_party->isConfirm() && $third_party_list->emptyRow())) {
?>
	<tr <?php echo $third_party->rowAttributes() ?>>
<?php

// Render list options (body, left)
$third_party_list->ListOptions->render("body", "left", $third_party_list->RowCount);
?>
	<?php if ($third_party_list->ThirdPartyName->Visible) { // ThirdPartyName ?>
		<td data-name="ThirdPartyName" <?php echo $third_party_list->ThirdPartyName->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_ThirdPartyName" class="form-group">
<input type="text" data-table="third_party" data-field="x_ThirdPartyName" name="x<?php echo $third_party_list->RowIndex ?>_ThirdPartyName" id="x<?php echo $third_party_list->RowIndex ?>_ThirdPartyName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($third_party_list->ThirdPartyName->getPlaceHolder()) ?>" value="<?php echo $third_party_list->ThirdPartyName->EditValue ?>"<?php echo $third_party_list->ThirdPartyName->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_ThirdPartyName" name="o<?php echo $third_party_list->RowIndex ?>_ThirdPartyName" id="o<?php echo $third_party_list->RowIndex ?>_ThirdPartyName" value="<?php echo HtmlEncode($third_party_list->ThirdPartyName->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_ThirdPartyName" class="form-group">
<input type="text" data-table="third_party" data-field="x_ThirdPartyName" name="x<?php echo $third_party_list->RowIndex ?>_ThirdPartyName" id="x<?php echo $third_party_list->RowIndex ?>_ThirdPartyName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($third_party_list->ThirdPartyName->getPlaceHolder()) ?>" value="<?php echo $third_party_list->ThirdPartyName->EditValue ?>"<?php echo $third_party_list->ThirdPartyName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_ThirdPartyName">
<span<?php echo $third_party_list->ThirdPartyName->viewAttributes() ?>><?php echo $third_party_list->ThirdPartyName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->DateOfEngagement->Visible) { // DateOfEngagement ?>
		<td data-name="DateOfEngagement" <?php echo $third_party_list->DateOfEngagement->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DateOfEngagement" class="form-group">
<input type="text" data-table="third_party" data-field="x_DateOfEngagement" name="x<?php echo $third_party_list->RowIndex ?>_DateOfEngagement" id="x<?php echo $third_party_list->RowIndex ?>_DateOfEngagement" placeholder="<?php echo HtmlEncode($third_party_list->DateOfEngagement->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DateOfEngagement->EditValue ?>"<?php echo $third_party_list->DateOfEngagement->editAttributes() ?>>
<?php if (!$third_party_list->DateOfEngagement->ReadOnly && !$third_party_list->DateOfEngagement->Disabled && !isset($third_party_list->DateOfEngagement->EditAttrs["readonly"]) && !isset($third_party_list->DateOfEngagement->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fthird_partylist", "datetimepicker"], function() {
	ew.createDateTimePicker("fthird_partylist", "x<?php echo $third_party_list->RowIndex ?>_DateOfEngagement", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="third_party" data-field="x_DateOfEngagement" name="o<?php echo $third_party_list->RowIndex ?>_DateOfEngagement" id="o<?php echo $third_party_list->RowIndex ?>_DateOfEngagement" value="<?php echo HtmlEncode($third_party_list->DateOfEngagement->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DateOfEngagement" class="form-group">
<input type="text" data-table="third_party" data-field="x_DateOfEngagement" name="x<?php echo $third_party_list->RowIndex ?>_DateOfEngagement" id="x<?php echo $third_party_list->RowIndex ?>_DateOfEngagement" placeholder="<?php echo HtmlEncode($third_party_list->DateOfEngagement->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DateOfEngagement->EditValue ?>"<?php echo $third_party_list->DateOfEngagement->editAttributes() ?>>
<?php if (!$third_party_list->DateOfEngagement->ReadOnly && !$third_party_list->DateOfEngagement->Disabled && !isset($third_party_list->DateOfEngagement->EditAttrs["readonly"]) && !isset($third_party_list->DateOfEngagement->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fthird_partylist", "datetimepicker"], function() {
	ew.createDateTimePicker("fthird_partylist", "x<?php echo $third_party_list->RowIndex ?>_DateOfEngagement", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DateOfEngagement">
<span<?php echo $third_party_list->DateOfEngagement->viewAttributes() ?>><?php echo $third_party_list->DateOfEngagement->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->DeductionCode->Visible) { // DeductionCode ?>
		<td data-name="DeductionCode" <?php echo $third_party_list->DeductionCode->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionCode" class="form-group">
<?php $third_party_list->DeductionCode->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $third_party_list->RowIndex ?>_DeductionCode"><?php echo EmptyValue(strval($third_party_list->DeductionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $third_party_list->DeductionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($third_party_list->DeductionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($third_party_list->DeductionCode->ReadOnly || $third_party_list->DeductionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $third_party_list->RowIndex ?>_DeductionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $third_party_list->DeductionCode->Lookup->getParamTag($third_party_list, "p_x" . $third_party_list->RowIndex . "_DeductionCode") ?>
<input type="hidden" data-table="third_party" data-field="x_DeductionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $third_party_list->DeductionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $third_party_list->RowIndex ?>_DeductionCode" id="x<?php echo $third_party_list->RowIndex ?>_DeductionCode" value="<?php echo $third_party_list->DeductionCode->CurrentValue ?>"<?php echo $third_party_list->DeductionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_DeductionCode" name="o<?php echo $third_party_list->RowIndex ?>_DeductionCode" id="o<?php echo $third_party_list->RowIndex ?>_DeductionCode" value="<?php echo HtmlEncode($third_party_list->DeductionCode->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php $third_party_list->DeductionCode->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $third_party_list->RowIndex ?>_DeductionCode"><?php echo EmptyValue(strval($third_party_list->DeductionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $third_party_list->DeductionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($third_party_list->DeductionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($third_party_list->DeductionCode->ReadOnly || $third_party_list->DeductionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $third_party_list->RowIndex ?>_DeductionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $third_party_list->DeductionCode->Lookup->getParamTag($third_party_list, "p_x" . $third_party_list->RowIndex . "_DeductionCode") ?>
<input type="hidden" data-table="third_party" data-field="x_DeductionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $third_party_list->DeductionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $third_party_list->RowIndex ?>_DeductionCode" id="x<?php echo $third_party_list->RowIndex ?>_DeductionCode" value="<?php echo $third_party_list->DeductionCode->CurrentValue ?>"<?php echo $third_party_list->DeductionCode->editAttributes() ?>>
<input type="hidden" data-table="third_party" data-field="x_DeductionCode" name="o<?php echo $third_party_list->RowIndex ?>_DeductionCode" id="o<?php echo $third_party_list->RowIndex ?>_DeductionCode" value="<?php echo HtmlEncode($third_party_list->DeductionCode->OldValue != null ? $third_party_list->DeductionCode->OldValue : $third_party_list->DeductionCode->CurrentValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionCode">
<span<?php echo $third_party_list->DeductionCode->viewAttributes() ?>><?php echo $third_party_list->DeductionCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->DeductionRate->Visible) { // DeductionRate ?>
		<td data-name="DeductionRate" <?php echo $third_party_list->DeductionRate->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionRate" class="form-group">
<input type="text" data-table="third_party" data-field="x_DeductionRate" name="x<?php echo $third_party_list->RowIndex ?>_DeductionRate" id="x<?php echo $third_party_list->RowIndex ?>_DeductionRate" size="30" placeholder="<?php echo HtmlEncode($third_party_list->DeductionRate->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DeductionRate->EditValue ?>"<?php echo $third_party_list->DeductionRate->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_DeductionRate" name="o<?php echo $third_party_list->RowIndex ?>_DeductionRate" id="o<?php echo $third_party_list->RowIndex ?>_DeductionRate" value="<?php echo HtmlEncode($third_party_list->DeductionRate->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionRate" class="form-group">
<input type="text" data-table="third_party" data-field="x_DeductionRate" name="x<?php echo $third_party_list->RowIndex ?>_DeductionRate" id="x<?php echo $third_party_list->RowIndex ?>_DeductionRate" size="30" placeholder="<?php echo HtmlEncode($third_party_list->DeductionRate->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DeductionRate->EditValue ?>"<?php echo $third_party_list->DeductionRate->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionRate">
<span<?php echo $third_party_list->DeductionRate->viewAttributes() ?>><?php echo $third_party_list->DeductionRate->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->DeductionAmount->Visible) { // DeductionAmount ?>
		<td data-name="DeductionAmount" <?php echo $third_party_list->DeductionAmount->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionAmount" class="form-group">
<input type="text" data-table="third_party" data-field="x_DeductionAmount" name="x<?php echo $third_party_list->RowIndex ?>_DeductionAmount" id="x<?php echo $third_party_list->RowIndex ?>_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($third_party_list->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DeductionAmount->EditValue ?>"<?php echo $third_party_list->DeductionAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_DeductionAmount" name="o<?php echo $third_party_list->RowIndex ?>_DeductionAmount" id="o<?php echo $third_party_list->RowIndex ?>_DeductionAmount" value="<?php echo HtmlEncode($third_party_list->DeductionAmount->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionAmount" class="form-group">
<input type="text" data-table="third_party" data-field="x_DeductionAmount" name="x<?php echo $third_party_list->RowIndex ?>_DeductionAmount" id="x<?php echo $third_party_list->RowIndex ?>_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($third_party_list->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DeductionAmount->EditValue ?>"<?php echo $third_party_list->DeductionAmount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionAmount">
<span<?php echo $third_party_list->DeductionAmount->viewAttributes() ?>><?php echo $third_party_list->DeductionAmount->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->DeductionLimit->Visible) { // DeductionLimit ?>
		<td data-name="DeductionLimit" <?php echo $third_party_list->DeductionLimit->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionLimit" class="form-group">
<input type="text" data-table="third_party" data-field="x_DeductionLimit" name="x<?php echo $third_party_list->RowIndex ?>_DeductionLimit" id="x<?php echo $third_party_list->RowIndex ?>_DeductionLimit" size="30" placeholder="<?php echo HtmlEncode($third_party_list->DeductionLimit->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DeductionLimit->EditValue ?>"<?php echo $third_party_list->DeductionLimit->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_DeductionLimit" name="o<?php echo $third_party_list->RowIndex ?>_DeductionLimit" id="o<?php echo $third_party_list->RowIndex ?>_DeductionLimit" value="<?php echo HtmlEncode($third_party_list->DeductionLimit->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionLimit" class="form-group">
<input type="text" data-table="third_party" data-field="x_DeductionLimit" name="x<?php echo $third_party_list->RowIndex ?>_DeductionLimit" id="x<?php echo $third_party_list->RowIndex ?>_DeductionLimit" size="30" placeholder="<?php echo HtmlEncode($third_party_list->DeductionLimit->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DeductionLimit->EditValue ?>"<?php echo $third_party_list->DeductionLimit->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionLimit">
<span<?php echo $third_party_list->DeductionLimit->viewAttributes() ?>><?php echo $third_party_list->DeductionLimit->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->EmployerContribution->Visible) { // EmployerContribution ?>
		<td data-name="EmployerContribution" <?php echo $third_party_list->EmployerContribution->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_EmployerContribution" class="form-group">
<input type="text" data-table="third_party" data-field="x_EmployerContribution" name="x<?php echo $third_party_list->RowIndex ?>_EmployerContribution" id="x<?php echo $third_party_list->RowIndex ?>_EmployerContribution" size="30" placeholder="<?php echo HtmlEncode($third_party_list->EmployerContribution->getPlaceHolder()) ?>" value="<?php echo $third_party_list->EmployerContribution->EditValue ?>"<?php echo $third_party_list->EmployerContribution->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_EmployerContribution" name="o<?php echo $third_party_list->RowIndex ?>_EmployerContribution" id="o<?php echo $third_party_list->RowIndex ?>_EmployerContribution" value="<?php echo HtmlEncode($third_party_list->EmployerContribution->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_EmployerContribution" class="form-group">
<input type="text" data-table="third_party" data-field="x_EmployerContribution" name="x<?php echo $third_party_list->RowIndex ?>_EmployerContribution" id="x<?php echo $third_party_list->RowIndex ?>_EmployerContribution" size="30" placeholder="<?php echo HtmlEncode($third_party_list->EmployerContribution->getPlaceHolder()) ?>" value="<?php echo $third_party_list->EmployerContribution->EditValue ?>"<?php echo $third_party_list->EmployerContribution->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_EmployerContribution">
<span<?php echo $third_party_list->EmployerContribution->viewAttributes() ?>><?php echo $third_party_list->EmployerContribution->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->DeductionDescription->Visible) { // DeductionDescription ?>
		<td data-name="DeductionDescription" <?php echo $third_party_list->DeductionDescription->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionDescription" class="form-group">
<input type="text" data-table="third_party" data-field="x_DeductionDescription" name="x<?php echo $third_party_list->RowIndex ?>_DeductionDescription" id="x<?php echo $third_party_list->RowIndex ?>_DeductionDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->DeductionDescription->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DeductionDescription->EditValue ?>"<?php echo $third_party_list->DeductionDescription->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_DeductionDescription" name="o<?php echo $third_party_list->RowIndex ?>_DeductionDescription" id="o<?php echo $third_party_list->RowIndex ?>_DeductionDescription" value="<?php echo HtmlEncode($third_party_list->DeductionDescription->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionDescription" class="form-group">
<input type="text" data-table="third_party" data-field="x_DeductionDescription" name="x<?php echo $third_party_list->RowIndex ?>_DeductionDescription" id="x<?php echo $third_party_list->RowIndex ?>_DeductionDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->DeductionDescription->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DeductionDescription->EditValue ?>"<?php echo $third_party_list->DeductionDescription->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_DeductionDescription">
<span<?php echo $third_party_list->DeductionDescription->viewAttributes() ?>><?php echo $third_party_list->DeductionDescription->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->PostalAddress->Visible) { // PostalAddress ?>
		<td data-name="PostalAddress" <?php echo $third_party_list->PostalAddress->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_PostalAddress" class="form-group">
<input type="text" data-table="third_party" data-field="x_PostalAddress" name="x<?php echo $third_party_list->RowIndex ?>_PostalAddress" id="x<?php echo $third_party_list->RowIndex ?>_PostalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $third_party_list->PostalAddress->EditValue ?>"<?php echo $third_party_list->PostalAddress->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_PostalAddress" name="o<?php echo $third_party_list->RowIndex ?>_PostalAddress" id="o<?php echo $third_party_list->RowIndex ?>_PostalAddress" value="<?php echo HtmlEncode($third_party_list->PostalAddress->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_PostalAddress" class="form-group">
<input type="text" data-table="third_party" data-field="x_PostalAddress" name="x<?php echo $third_party_list->RowIndex ?>_PostalAddress" id="x<?php echo $third_party_list->RowIndex ?>_PostalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $third_party_list->PostalAddress->EditValue ?>"<?php echo $third_party_list->PostalAddress->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_PostalAddress">
<span<?php echo $third_party_list->PostalAddress->viewAttributes() ?>><?php echo $third_party_list->PostalAddress->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<td data-name="PhysicalAddress" <?php echo $third_party_list->PhysicalAddress->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_PhysicalAddress" class="form-group">
<input type="text" data-table="third_party" data-field="x_PhysicalAddress" name="x<?php echo $third_party_list->RowIndex ?>_PhysicalAddress" id="x<?php echo $third_party_list->RowIndex ?>_PhysicalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $third_party_list->PhysicalAddress->EditValue ?>"<?php echo $third_party_list->PhysicalAddress->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_PhysicalAddress" name="o<?php echo $third_party_list->RowIndex ?>_PhysicalAddress" id="o<?php echo $third_party_list->RowIndex ?>_PhysicalAddress" value="<?php echo HtmlEncode($third_party_list->PhysicalAddress->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_PhysicalAddress" class="form-group">
<input type="text" data-table="third_party" data-field="x_PhysicalAddress" name="x<?php echo $third_party_list->RowIndex ?>_PhysicalAddress" id="x<?php echo $third_party_list->RowIndex ?>_PhysicalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $third_party_list->PhysicalAddress->EditValue ?>"<?php echo $third_party_list->PhysicalAddress->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_PhysicalAddress">
<span<?php echo $third_party_list->PhysicalAddress->viewAttributes() ?>><?php echo $third_party_list->PhysicalAddress->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->TownOrVillage->Visible) { // TownOrVillage ?>
		<td data-name="TownOrVillage" <?php echo $third_party_list->TownOrVillage->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_TownOrVillage" class="form-group">
<input type="text" data-table="third_party" data-field="x_TownOrVillage" name="x<?php echo $third_party_list->RowIndex ?>_TownOrVillage" id="x<?php echo $third_party_list->RowIndex ?>_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $third_party_list->TownOrVillage->EditValue ?>"<?php echo $third_party_list->TownOrVillage->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_TownOrVillage" name="o<?php echo $third_party_list->RowIndex ?>_TownOrVillage" id="o<?php echo $third_party_list->RowIndex ?>_TownOrVillage" value="<?php echo HtmlEncode($third_party_list->TownOrVillage->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_TownOrVillage" class="form-group">
<input type="text" data-table="third_party" data-field="x_TownOrVillage" name="x<?php echo $third_party_list->RowIndex ?>_TownOrVillage" id="x<?php echo $third_party_list->RowIndex ?>_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $third_party_list->TownOrVillage->EditValue ?>"<?php echo $third_party_list->TownOrVillage->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_TownOrVillage">
<span<?php echo $third_party_list->TownOrVillage->viewAttributes() ?>><?php echo $third_party_list->TownOrVillage->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone" <?php echo $third_party_list->Telephone->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_Telephone" class="form-group">
<input type="text" data-table="third_party" data-field="x_Telephone" name="x<?php echo $third_party_list->RowIndex ?>_Telephone" id="x<?php echo $third_party_list->RowIndex ?>_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->Telephone->getPlaceHolder()) ?>" value="<?php echo $third_party_list->Telephone->EditValue ?>"<?php echo $third_party_list->Telephone->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_Telephone" name="o<?php echo $third_party_list->RowIndex ?>_Telephone" id="o<?php echo $third_party_list->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($third_party_list->Telephone->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_Telephone" class="form-group">
<input type="text" data-table="third_party" data-field="x_Telephone" name="x<?php echo $third_party_list->RowIndex ?>_Telephone" id="x<?php echo $third_party_list->RowIndex ?>_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->Telephone->getPlaceHolder()) ?>" value="<?php echo $third_party_list->Telephone->EditValue ?>"<?php echo $third_party_list->Telephone->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_Telephone">
<span<?php echo $third_party_list->Telephone->viewAttributes() ?>><?php echo $third_party_list->Telephone->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile" <?php echo $third_party_list->Mobile->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_Mobile" class="form-group">
<input type="text" data-table="third_party" data-field="x_Mobile" name="x<?php echo $third_party_list->RowIndex ?>_Mobile" id="x<?php echo $third_party_list->RowIndex ?>_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->Mobile->getPlaceHolder()) ?>" value="<?php echo $third_party_list->Mobile->EditValue ?>"<?php echo $third_party_list->Mobile->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_Mobile" name="o<?php echo $third_party_list->RowIndex ?>_Mobile" id="o<?php echo $third_party_list->RowIndex ?>_Mobile" value="<?php echo HtmlEncode($third_party_list->Mobile->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_Mobile" class="form-group">
<input type="text" data-table="third_party" data-field="x_Mobile" name="x<?php echo $third_party_list->RowIndex ?>_Mobile" id="x<?php echo $third_party_list->RowIndex ?>_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->Mobile->getPlaceHolder()) ?>" value="<?php echo $third_party_list->Mobile->EditValue ?>"<?php echo $third_party_list->Mobile->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_Mobile">
<span<?php echo $third_party_list->Mobile->viewAttributes() ?>><?php echo $third_party_list->Mobile->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->Fax->Visible) { // Fax ?>
		<td data-name="Fax" <?php echo $third_party_list->Fax->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_Fax" class="form-group">
<input type="text" data-table="third_party" data-field="x_Fax" name="x<?php echo $third_party_list->RowIndex ?>_Fax" id="x<?php echo $third_party_list->RowIndex ?>_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($third_party_list->Fax->getPlaceHolder()) ?>" value="<?php echo $third_party_list->Fax->EditValue ?>"<?php echo $third_party_list->Fax->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_Fax" name="o<?php echo $third_party_list->RowIndex ?>_Fax" id="o<?php echo $third_party_list->RowIndex ?>_Fax" value="<?php echo HtmlEncode($third_party_list->Fax->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_Fax" class="form-group">
<input type="text" data-table="third_party" data-field="x_Fax" name="x<?php echo $third_party_list->RowIndex ?>_Fax" id="x<?php echo $third_party_list->RowIndex ?>_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($third_party_list->Fax->getPlaceHolder()) ?>" value="<?php echo $third_party_list->Fax->EditValue ?>"<?php echo $third_party_list->Fax->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_Fax">
<span<?php echo $third_party_list->Fax->viewAttributes() ?>><?php echo $third_party_list->Fax->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $third_party_list->_Email->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party__Email" class="form-group">
<input type="text" data-table="third_party" data-field="x__Email" name="x<?php echo $third_party_list->RowIndex ?>__Email" id="x<?php echo $third_party_list->RowIndex ?>__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->_Email->getPlaceHolder()) ?>" value="<?php echo $third_party_list->_Email->EditValue ?>"<?php echo $third_party_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x__Email" name="o<?php echo $third_party_list->RowIndex ?>__Email" id="o<?php echo $third_party_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($third_party_list->_Email->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party__Email" class="form-group">
<input type="text" data-table="third_party" data-field="x__Email" name="x<?php echo $third_party_list->RowIndex ?>__Email" id="x<?php echo $third_party_list->RowIndex ?>__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->_Email->getPlaceHolder()) ?>" value="<?php echo $third_party_list->_Email->EditValue ?>"<?php echo $third_party_list->_Email->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party__Email">
<span<?php echo $third_party_list->_Email->viewAttributes() ?>><?php echo $third_party_list->_Email->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->BankBranchCode->Visible) { // BankBranchCode ?>
		<td data-name="BankBranchCode" <?php echo $third_party_list->BankBranchCode->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_BankBranchCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $third_party_list->RowIndex ?>_BankBranchCode"><?php echo EmptyValue(strval($third_party_list->BankBranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $third_party_list->BankBranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($third_party_list->BankBranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($third_party_list->BankBranchCode->ReadOnly || $third_party_list->BankBranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $third_party_list->RowIndex ?>_BankBranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $third_party_list->BankBranchCode->Lookup->getParamTag($third_party_list, "p_x" . $third_party_list->RowIndex . "_BankBranchCode") ?>
<input type="hidden" data-table="third_party" data-field="x_BankBranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $third_party_list->BankBranchCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $third_party_list->RowIndex ?>_BankBranchCode" id="x<?php echo $third_party_list->RowIndex ?>_BankBranchCode" value="<?php echo $third_party_list->BankBranchCode->CurrentValue ?>"<?php echo $third_party_list->BankBranchCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_BankBranchCode" name="o<?php echo $third_party_list->RowIndex ?>_BankBranchCode" id="o<?php echo $third_party_list->RowIndex ?>_BankBranchCode" value="<?php echo HtmlEncode($third_party_list->BankBranchCode->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_BankBranchCode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $third_party_list->RowIndex ?>_BankBranchCode"><?php echo EmptyValue(strval($third_party_list->BankBranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $third_party_list->BankBranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($third_party_list->BankBranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($third_party_list->BankBranchCode->ReadOnly || $third_party_list->BankBranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $third_party_list->RowIndex ?>_BankBranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $third_party_list->BankBranchCode->Lookup->getParamTag($third_party_list, "p_x" . $third_party_list->RowIndex . "_BankBranchCode") ?>
<input type="hidden" data-table="third_party" data-field="x_BankBranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $third_party_list->BankBranchCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $third_party_list->RowIndex ?>_BankBranchCode" id="x<?php echo $third_party_list->RowIndex ?>_BankBranchCode" value="<?php echo $third_party_list->BankBranchCode->CurrentValue ?>"<?php echo $third_party_list->BankBranchCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_BankBranchCode">
<span<?php echo $third_party_list->BankBranchCode->viewAttributes() ?>><?php echo $third_party_list->BankBranchCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo" <?php echo $third_party_list->BankAccountNo->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_BankAccountNo" class="form-group">
<input type="text" data-table="third_party" data-field="x_BankAccountNo" name="x<?php echo $third_party_list->RowIndex ?>_BankAccountNo" id="x<?php echo $third_party_list->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($third_party_list->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $third_party_list->BankAccountNo->EditValue ?>"<?php echo $third_party_list->BankAccountNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_BankAccountNo" name="o<?php echo $third_party_list->RowIndex ?>_BankAccountNo" id="o<?php echo $third_party_list->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($third_party_list->BankAccountNo->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_BankAccountNo" class="form-group">
<input type="text" data-table="third_party" data-field="x_BankAccountNo" name="x<?php echo $third_party_list->RowIndex ?>_BankAccountNo" id="x<?php echo $third_party_list->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($third_party_list->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $third_party_list->BankAccountNo->EditValue ?>"<?php echo $third_party_list->BankAccountNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_BankAccountNo">
<span<?php echo $third_party_list->BankAccountNo->viewAttributes() ?>><?php echo $third_party_list->BankAccountNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($third_party_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $third_party_list->PaymentMethod->cellAttributes() ?>>
<?php if ($third_party->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_PaymentMethod" class="form-group">
<?php
$onchange = $third_party_list->PaymentMethod->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$third_party_list->PaymentMethod->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $third_party_list->RowIndex ?>_PaymentMethod">
	<input type="text" class="form-control" name="sv_x<?php echo $third_party_list->RowIndex ?>_PaymentMethod" id="sv_x<?php echo $third_party_list->RowIndex ?>_PaymentMethod" value="<?php echo RemoveHtml($third_party_list->PaymentMethod->EditValue) ?>" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($third_party_list->PaymentMethod->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($third_party_list->PaymentMethod->getPlaceHolder()) ?>"<?php echo $third_party_list->PaymentMethod->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_PaymentMethod" data-value-separator="<?php echo $third_party_list->PaymentMethod->displayValueSeparatorAttribute() ?>" name="x<?php echo $third_party_list->RowIndex ?>_PaymentMethod" id="x<?php echo $third_party_list->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($third_party_list->PaymentMethod->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fthird_partylist"], function() {
	fthird_partylist.createAutoSuggest({"id":"x<?php echo $third_party_list->RowIndex ?>_PaymentMethod","forceSelect":false});
});
</script>
<?php echo $third_party_list->PaymentMethod->Lookup->getParamTag($third_party_list, "p_x" . $third_party_list->RowIndex . "_PaymentMethod") ?>
</span>
<input type="hidden" data-table="third_party" data-field="x_PaymentMethod" name="o<?php echo $third_party_list->RowIndex ?>_PaymentMethod" id="o<?php echo $third_party_list->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($third_party_list->PaymentMethod->OldValue) ?>">
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_PaymentMethod" class="form-group">
<?php
$onchange = $third_party_list->PaymentMethod->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$third_party_list->PaymentMethod->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $third_party_list->RowIndex ?>_PaymentMethod">
	<input type="text" class="form-control" name="sv_x<?php echo $third_party_list->RowIndex ?>_PaymentMethod" id="sv_x<?php echo $third_party_list->RowIndex ?>_PaymentMethod" value="<?php echo RemoveHtml($third_party_list->PaymentMethod->EditValue) ?>" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($third_party_list->PaymentMethod->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($third_party_list->PaymentMethod->getPlaceHolder()) ?>"<?php echo $third_party_list->PaymentMethod->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_PaymentMethod" data-value-separator="<?php echo $third_party_list->PaymentMethod->displayValueSeparatorAttribute() ?>" name="x<?php echo $third_party_list->RowIndex ?>_PaymentMethod" id="x<?php echo $third_party_list->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($third_party_list->PaymentMethod->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fthird_partylist"], function() {
	fthird_partylist.createAutoSuggest({"id":"x<?php echo $third_party_list->RowIndex ?>_PaymentMethod","forceSelect":false});
});
</script>
<?php echo $third_party_list->PaymentMethod->Lookup->getParamTag($third_party_list, "p_x" . $third_party_list->RowIndex . "_PaymentMethod") ?>
</span>
<?php } ?>
<?php if ($third_party->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $third_party_list->RowCount ?>_third_party_PaymentMethod">
<span<?php echo $third_party_list->PaymentMethod->viewAttributes() ?>><?php echo $third_party_list->PaymentMethod->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$third_party_list->ListOptions->render("body", "right", $third_party_list->RowCount);
?>
	</tr>
<?php if ($third_party->RowType == ROWTYPE_ADD || $third_party->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fthird_partylist", "load"], function() {
	fthird_partylist.updateLists(<?php echo $third_party_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$third_party_list->isGridAdd())
		if (!$third_party_list->Recordset->EOF)
			$third_party_list->Recordset->moveNext();
}
?>
<?php
	if ($third_party_list->isGridAdd() || $third_party_list->isGridEdit()) {
		$third_party_list->RowIndex = '$rowindex$';
		$third_party_list->loadRowValues();

		// Set row properties
		$third_party->resetAttributes();
		$third_party->RowAttrs->merge(["data-rowindex" => $third_party_list->RowIndex, "id" => "r0_third_party", "data-rowtype" => ROWTYPE_ADD]);
		$third_party->RowAttrs->appendClass("ew-template");
		$third_party->RowType = ROWTYPE_ADD;

		// Render row
		$third_party_list->renderRow();

		// Render list options
		$third_party_list->renderListOptions();
		$third_party_list->StartRowCount = 0;
?>
	<tr <?php echo $third_party->rowAttributes() ?>>
<?php

// Render list options (body, left)
$third_party_list->ListOptions->render("body", "left", $third_party_list->RowIndex);
?>
	<?php if ($third_party_list->ThirdPartyName->Visible) { // ThirdPartyName ?>
		<td data-name="ThirdPartyName">
<span id="el$rowindex$_third_party_ThirdPartyName" class="form-group third_party_ThirdPartyName">
<input type="text" data-table="third_party" data-field="x_ThirdPartyName" name="x<?php echo $third_party_list->RowIndex ?>_ThirdPartyName" id="x<?php echo $third_party_list->RowIndex ?>_ThirdPartyName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($third_party_list->ThirdPartyName->getPlaceHolder()) ?>" value="<?php echo $third_party_list->ThirdPartyName->EditValue ?>"<?php echo $third_party_list->ThirdPartyName->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_ThirdPartyName" name="o<?php echo $third_party_list->RowIndex ?>_ThirdPartyName" id="o<?php echo $third_party_list->RowIndex ?>_ThirdPartyName" value="<?php echo HtmlEncode($third_party_list->ThirdPartyName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->DateOfEngagement->Visible) { // DateOfEngagement ?>
		<td data-name="DateOfEngagement">
<span id="el$rowindex$_third_party_DateOfEngagement" class="form-group third_party_DateOfEngagement">
<input type="text" data-table="third_party" data-field="x_DateOfEngagement" name="x<?php echo $third_party_list->RowIndex ?>_DateOfEngagement" id="x<?php echo $third_party_list->RowIndex ?>_DateOfEngagement" placeholder="<?php echo HtmlEncode($third_party_list->DateOfEngagement->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DateOfEngagement->EditValue ?>"<?php echo $third_party_list->DateOfEngagement->editAttributes() ?>>
<?php if (!$third_party_list->DateOfEngagement->ReadOnly && !$third_party_list->DateOfEngagement->Disabled && !isset($third_party_list->DateOfEngagement->EditAttrs["readonly"]) && !isset($third_party_list->DateOfEngagement->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fthird_partylist", "datetimepicker"], function() {
	ew.createDateTimePicker("fthird_partylist", "x<?php echo $third_party_list->RowIndex ?>_DateOfEngagement", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="third_party" data-field="x_DateOfEngagement" name="o<?php echo $third_party_list->RowIndex ?>_DateOfEngagement" id="o<?php echo $third_party_list->RowIndex ?>_DateOfEngagement" value="<?php echo HtmlEncode($third_party_list->DateOfEngagement->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->DeductionCode->Visible) { // DeductionCode ?>
		<td data-name="DeductionCode">
<span id="el$rowindex$_third_party_DeductionCode" class="form-group third_party_DeductionCode">
<?php $third_party_list->DeductionCode->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $third_party_list->RowIndex ?>_DeductionCode"><?php echo EmptyValue(strval($third_party_list->DeductionCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $third_party_list->DeductionCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($third_party_list->DeductionCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($third_party_list->DeductionCode->ReadOnly || $third_party_list->DeductionCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $third_party_list->RowIndex ?>_DeductionCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $third_party_list->DeductionCode->Lookup->getParamTag($third_party_list, "p_x" . $third_party_list->RowIndex . "_DeductionCode") ?>
<input type="hidden" data-table="third_party" data-field="x_DeductionCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $third_party_list->DeductionCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $third_party_list->RowIndex ?>_DeductionCode" id="x<?php echo $third_party_list->RowIndex ?>_DeductionCode" value="<?php echo $third_party_list->DeductionCode->CurrentValue ?>"<?php echo $third_party_list->DeductionCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_DeductionCode" name="o<?php echo $third_party_list->RowIndex ?>_DeductionCode" id="o<?php echo $third_party_list->RowIndex ?>_DeductionCode" value="<?php echo HtmlEncode($third_party_list->DeductionCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->DeductionRate->Visible) { // DeductionRate ?>
		<td data-name="DeductionRate">
<span id="el$rowindex$_third_party_DeductionRate" class="form-group third_party_DeductionRate">
<input type="text" data-table="third_party" data-field="x_DeductionRate" name="x<?php echo $third_party_list->RowIndex ?>_DeductionRate" id="x<?php echo $third_party_list->RowIndex ?>_DeductionRate" size="30" placeholder="<?php echo HtmlEncode($third_party_list->DeductionRate->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DeductionRate->EditValue ?>"<?php echo $third_party_list->DeductionRate->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_DeductionRate" name="o<?php echo $third_party_list->RowIndex ?>_DeductionRate" id="o<?php echo $third_party_list->RowIndex ?>_DeductionRate" value="<?php echo HtmlEncode($third_party_list->DeductionRate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->DeductionAmount->Visible) { // DeductionAmount ?>
		<td data-name="DeductionAmount">
<span id="el$rowindex$_third_party_DeductionAmount" class="form-group third_party_DeductionAmount">
<input type="text" data-table="third_party" data-field="x_DeductionAmount" name="x<?php echo $third_party_list->RowIndex ?>_DeductionAmount" id="x<?php echo $third_party_list->RowIndex ?>_DeductionAmount" size="30" placeholder="<?php echo HtmlEncode($third_party_list->DeductionAmount->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DeductionAmount->EditValue ?>"<?php echo $third_party_list->DeductionAmount->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_DeductionAmount" name="o<?php echo $third_party_list->RowIndex ?>_DeductionAmount" id="o<?php echo $third_party_list->RowIndex ?>_DeductionAmount" value="<?php echo HtmlEncode($third_party_list->DeductionAmount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->DeductionLimit->Visible) { // DeductionLimit ?>
		<td data-name="DeductionLimit">
<span id="el$rowindex$_third_party_DeductionLimit" class="form-group third_party_DeductionLimit">
<input type="text" data-table="third_party" data-field="x_DeductionLimit" name="x<?php echo $third_party_list->RowIndex ?>_DeductionLimit" id="x<?php echo $third_party_list->RowIndex ?>_DeductionLimit" size="30" placeholder="<?php echo HtmlEncode($third_party_list->DeductionLimit->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DeductionLimit->EditValue ?>"<?php echo $third_party_list->DeductionLimit->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_DeductionLimit" name="o<?php echo $third_party_list->RowIndex ?>_DeductionLimit" id="o<?php echo $third_party_list->RowIndex ?>_DeductionLimit" value="<?php echo HtmlEncode($third_party_list->DeductionLimit->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->EmployerContribution->Visible) { // EmployerContribution ?>
		<td data-name="EmployerContribution">
<span id="el$rowindex$_third_party_EmployerContribution" class="form-group third_party_EmployerContribution">
<input type="text" data-table="third_party" data-field="x_EmployerContribution" name="x<?php echo $third_party_list->RowIndex ?>_EmployerContribution" id="x<?php echo $third_party_list->RowIndex ?>_EmployerContribution" size="30" placeholder="<?php echo HtmlEncode($third_party_list->EmployerContribution->getPlaceHolder()) ?>" value="<?php echo $third_party_list->EmployerContribution->EditValue ?>"<?php echo $third_party_list->EmployerContribution->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_EmployerContribution" name="o<?php echo $third_party_list->RowIndex ?>_EmployerContribution" id="o<?php echo $third_party_list->RowIndex ?>_EmployerContribution" value="<?php echo HtmlEncode($third_party_list->EmployerContribution->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->DeductionDescription->Visible) { // DeductionDescription ?>
		<td data-name="DeductionDescription">
<span id="el$rowindex$_third_party_DeductionDescription" class="form-group third_party_DeductionDescription">
<input type="text" data-table="third_party" data-field="x_DeductionDescription" name="x<?php echo $third_party_list->RowIndex ?>_DeductionDescription" id="x<?php echo $third_party_list->RowIndex ?>_DeductionDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->DeductionDescription->getPlaceHolder()) ?>" value="<?php echo $third_party_list->DeductionDescription->EditValue ?>"<?php echo $third_party_list->DeductionDescription->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_DeductionDescription" name="o<?php echo $third_party_list->RowIndex ?>_DeductionDescription" id="o<?php echo $third_party_list->RowIndex ?>_DeductionDescription" value="<?php echo HtmlEncode($third_party_list->DeductionDescription->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->PostalAddress->Visible) { // PostalAddress ?>
		<td data-name="PostalAddress">
<span id="el$rowindex$_third_party_PostalAddress" class="form-group third_party_PostalAddress">
<input type="text" data-table="third_party" data-field="x_PostalAddress" name="x<?php echo $third_party_list->RowIndex ?>_PostalAddress" id="x<?php echo $third_party_list->RowIndex ?>_PostalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $third_party_list->PostalAddress->EditValue ?>"<?php echo $third_party_list->PostalAddress->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_PostalAddress" name="o<?php echo $third_party_list->RowIndex ?>_PostalAddress" id="o<?php echo $third_party_list->RowIndex ?>_PostalAddress" value="<?php echo HtmlEncode($third_party_list->PostalAddress->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<td data-name="PhysicalAddress">
<span id="el$rowindex$_third_party_PhysicalAddress" class="form-group third_party_PhysicalAddress">
<input type="text" data-table="third_party" data-field="x_PhysicalAddress" name="x<?php echo $third_party_list->RowIndex ?>_PhysicalAddress" id="x<?php echo $third_party_list->RowIndex ?>_PhysicalAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $third_party_list->PhysicalAddress->EditValue ?>"<?php echo $third_party_list->PhysicalAddress->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_PhysicalAddress" name="o<?php echo $third_party_list->RowIndex ?>_PhysicalAddress" id="o<?php echo $third_party_list->RowIndex ?>_PhysicalAddress" value="<?php echo HtmlEncode($third_party_list->PhysicalAddress->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->TownOrVillage->Visible) { // TownOrVillage ?>
		<td data-name="TownOrVillage">
<span id="el$rowindex$_third_party_TownOrVillage" class="form-group third_party_TownOrVillage">
<input type="text" data-table="third_party" data-field="x_TownOrVillage" name="x<?php echo $third_party_list->RowIndex ?>_TownOrVillage" id="x<?php echo $third_party_list->RowIndex ?>_TownOrVillage" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $third_party_list->TownOrVillage->EditValue ?>"<?php echo $third_party_list->TownOrVillage->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_TownOrVillage" name="o<?php echo $third_party_list->RowIndex ?>_TownOrVillage" id="o<?php echo $third_party_list->RowIndex ?>_TownOrVillage" value="<?php echo HtmlEncode($third_party_list->TownOrVillage->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone">
<span id="el$rowindex$_third_party_Telephone" class="form-group third_party_Telephone">
<input type="text" data-table="third_party" data-field="x_Telephone" name="x<?php echo $third_party_list->RowIndex ?>_Telephone" id="x<?php echo $third_party_list->RowIndex ?>_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->Telephone->getPlaceHolder()) ?>" value="<?php echo $third_party_list->Telephone->EditValue ?>"<?php echo $third_party_list->Telephone->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_Telephone" name="o<?php echo $third_party_list->RowIndex ?>_Telephone" id="o<?php echo $third_party_list->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($third_party_list->Telephone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile">
<span id="el$rowindex$_third_party_Mobile" class="form-group third_party_Mobile">
<input type="text" data-table="third_party" data-field="x_Mobile" name="x<?php echo $third_party_list->RowIndex ?>_Mobile" id="x<?php echo $third_party_list->RowIndex ?>_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->Mobile->getPlaceHolder()) ?>" value="<?php echo $third_party_list->Mobile->EditValue ?>"<?php echo $third_party_list->Mobile->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_Mobile" name="o<?php echo $third_party_list->RowIndex ?>_Mobile" id="o<?php echo $third_party_list->RowIndex ?>_Mobile" value="<?php echo HtmlEncode($third_party_list->Mobile->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->Fax->Visible) { // Fax ?>
		<td data-name="Fax">
<span id="el$rowindex$_third_party_Fax" class="form-group third_party_Fax">
<input type="text" data-table="third_party" data-field="x_Fax" name="x<?php echo $third_party_list->RowIndex ?>_Fax" id="x<?php echo $third_party_list->RowIndex ?>_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($third_party_list->Fax->getPlaceHolder()) ?>" value="<?php echo $third_party_list->Fax->EditValue ?>"<?php echo $third_party_list->Fax->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_Fax" name="o<?php echo $third_party_list->RowIndex ?>_Fax" id="o<?php echo $third_party_list->RowIndex ?>_Fax" value="<?php echo HtmlEncode($third_party_list->Fax->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->_Email->Visible) { // Email ?>
		<td data-name="_Email">
<span id="el$rowindex$_third_party__Email" class="form-group third_party__Email">
<input type="text" data-table="third_party" data-field="x__Email" name="x<?php echo $third_party_list->RowIndex ?>__Email" id="x<?php echo $third_party_list->RowIndex ?>__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($third_party_list->_Email->getPlaceHolder()) ?>" value="<?php echo $third_party_list->_Email->EditValue ?>"<?php echo $third_party_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x__Email" name="o<?php echo $third_party_list->RowIndex ?>__Email" id="o<?php echo $third_party_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($third_party_list->_Email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->BankBranchCode->Visible) { // BankBranchCode ?>
		<td data-name="BankBranchCode">
<span id="el$rowindex$_third_party_BankBranchCode" class="form-group third_party_BankBranchCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $third_party_list->RowIndex ?>_BankBranchCode"><?php echo EmptyValue(strval($third_party_list->BankBranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $third_party_list->BankBranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($third_party_list->BankBranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($third_party_list->BankBranchCode->ReadOnly || $third_party_list->BankBranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $third_party_list->RowIndex ?>_BankBranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $third_party_list->BankBranchCode->Lookup->getParamTag($third_party_list, "p_x" . $third_party_list->RowIndex . "_BankBranchCode") ?>
<input type="hidden" data-table="third_party" data-field="x_BankBranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $third_party_list->BankBranchCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $third_party_list->RowIndex ?>_BankBranchCode" id="x<?php echo $third_party_list->RowIndex ?>_BankBranchCode" value="<?php echo $third_party_list->BankBranchCode->CurrentValue ?>"<?php echo $third_party_list->BankBranchCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_BankBranchCode" name="o<?php echo $third_party_list->RowIndex ?>_BankBranchCode" id="o<?php echo $third_party_list->RowIndex ?>_BankBranchCode" value="<?php echo HtmlEncode($third_party_list->BankBranchCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo">
<span id="el$rowindex$_third_party_BankAccountNo" class="form-group third_party_BankAccountNo">
<input type="text" data-table="third_party" data-field="x_BankAccountNo" name="x<?php echo $third_party_list->RowIndex ?>_BankAccountNo" id="x<?php echo $third_party_list->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($third_party_list->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $third_party_list->BankAccountNo->EditValue ?>"<?php echo $third_party_list->BankAccountNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_BankAccountNo" name="o<?php echo $third_party_list->RowIndex ?>_BankAccountNo" id="o<?php echo $third_party_list->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($third_party_list->BankAccountNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($third_party_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod">
<span id="el$rowindex$_third_party_PaymentMethod" class="form-group third_party_PaymentMethod">
<?php
$onchange = $third_party_list->PaymentMethod->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$third_party_list->PaymentMethod->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $third_party_list->RowIndex ?>_PaymentMethod">
	<input type="text" class="form-control" name="sv_x<?php echo $third_party_list->RowIndex ?>_PaymentMethod" id="sv_x<?php echo $third_party_list->RowIndex ?>_PaymentMethod" value="<?php echo RemoveHtml($third_party_list->PaymentMethod->EditValue) ?>" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($third_party_list->PaymentMethod->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($third_party_list->PaymentMethod->getPlaceHolder()) ?>"<?php echo $third_party_list->PaymentMethod->editAttributes() ?>>
</span>
<input type="hidden" data-table="third_party" data-field="x_PaymentMethod" data-value-separator="<?php echo $third_party_list->PaymentMethod->displayValueSeparatorAttribute() ?>" name="x<?php echo $third_party_list->RowIndex ?>_PaymentMethod" id="x<?php echo $third_party_list->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($third_party_list->PaymentMethod->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fthird_partylist"], function() {
	fthird_partylist.createAutoSuggest({"id":"x<?php echo $third_party_list->RowIndex ?>_PaymentMethod","forceSelect":false});
});
</script>
<?php echo $third_party_list->PaymentMethod->Lookup->getParamTag($third_party_list, "p_x" . $third_party_list->RowIndex . "_PaymentMethod") ?>
</span>
<input type="hidden" data-table="third_party" data-field="x_PaymentMethod" name="o<?php echo $third_party_list->RowIndex ?>_PaymentMethod" id="o<?php echo $third_party_list->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($third_party_list->PaymentMethod->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$third_party_list->ListOptions->render("body", "right", $third_party_list->RowIndex);
?>
<script>
loadjs.ready(["fthird_partylist", "load"], function() {
	fthird_partylist.updateLists(<?php echo $third_party_list->RowIndex ?>);
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
<?php if ($third_party_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $third_party_list->FormKeyCountName ?>" id="<?php echo $third_party_list->FormKeyCountName ?>" value="<?php echo $third_party_list->KeyCount ?>">
<?php echo $third_party_list->MultiSelectKey ?>
<?php } ?>
<?php if ($third_party_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $third_party_list->FormKeyCountName ?>" id="<?php echo $third_party_list->FormKeyCountName ?>" value="<?php echo $third_party_list->KeyCount ?>">
<?php echo $third_party_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$third_party->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($third_party_list->Recordset)
	$third_party_list->Recordset->Close();
?>
<?php if (!$third_party_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$third_party_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $third_party_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $third_party_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($third_party_list->TotalRecords == 0 && !$third_party->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $third_party_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$third_party_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$third_party_list->isExport()) { ?>
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
$third_party_list->terminate();
?>