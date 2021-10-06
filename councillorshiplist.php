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
$councillorship_list = new councillorship_list();

// Run the page
$councillorship_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$councillorship_list->isExport()) { ?>
<script>
var fcouncillorshiplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcouncillorshiplist = currentForm = new ew.Form("fcouncillorshiplist", "list");
	fcouncillorshiplist.formKeyCountName = '<?php echo $councillorship_list->FormKeyCountName ?>';

	// Validate form
	fcouncillorshiplist.validate = function() {
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
			<?php if ($councillorship_list->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_list->EmployeeID->caption(), $councillorship_list->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillorship_list->EmployeeID->errorMessage()) ?>");
			<?php if ($councillorship_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_list->LACode->caption(), $councillorship_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_list->PoliticalParty->Required) { ?>
				elm = this.getElements("x" + infix + "_PoliticalParty");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_list->PoliticalParty->caption(), $councillorship_list->PoliticalParty->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_list->Occupation->Required) { ?>
				elm = this.getElements("x" + infix + "_Occupation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_list->Occupation->caption(), $councillorship_list->Occupation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_list->PositionInCouncil->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionInCouncil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_list->PositionInCouncil->caption(), $councillorship_list->PositionInCouncil->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_list->Committee->Required) { ?>
				elm = this.getElements("x" + infix + "_Committee");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_list->Committee->caption(), $councillorship_list->Committee->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_list->CommitteeRole->Required) { ?>
				elm = this.getElements("x" + infix + "_CommitteeRole");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_list->CommitteeRole->caption(), $councillorship_list->CommitteeRole->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_list->CouncilTerm->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilTerm");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_list->CouncilTerm->caption(), $councillorship_list->CouncilTerm->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_list->CouncillorTypeType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorTypeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_list->CouncillorTypeType->caption(), $councillorship_list->CouncillorTypeType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillorship_list->ExitReason->Required) { ?>
				elm = this.getElements("x" + infix + "_ExitReason");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillorship_list->ExitReason->caption(), $councillorship_list->ExitReason->RequiredErrorMessage)) ?>");
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
	fcouncillorshiplist.emptyRow = function(infix) {
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
	fcouncillorshiplist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillorshiplist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncillorshiplist.lists["x_EmployeeID"] = <?php echo $councillorship_list->EmployeeID->Lookup->toClientList($councillorship_list) ?>;
	fcouncillorshiplist.lists["x_EmployeeID"].options = <?php echo JsonEncode($councillorship_list->EmployeeID->lookupOptions()) ?>;
	fcouncillorshiplist.autoSuggests["x_EmployeeID"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncillorshiplist.lists["x_LACode"] = <?php echo $councillorship_list->LACode->Lookup->toClientList($councillorship_list) ?>;
	fcouncillorshiplist.lists["x_LACode"].options = <?php echo JsonEncode($councillorship_list->LACode->lookupOptions()) ?>;
	fcouncillorshiplist.lists["x_PoliticalParty"] = <?php echo $councillorship_list->PoliticalParty->Lookup->toClientList($councillorship_list) ?>;
	fcouncillorshiplist.lists["x_PoliticalParty"].options = <?php echo JsonEncode($councillorship_list->PoliticalParty->lookupOptions()) ?>;
	fcouncillorshiplist.lists["x_Occupation"] = <?php echo $councillorship_list->Occupation->Lookup->toClientList($councillorship_list) ?>;
	fcouncillorshiplist.lists["x_Occupation"].options = <?php echo JsonEncode($councillorship_list->Occupation->lookupOptions()) ?>;
	fcouncillorshiplist.lists["x_PositionInCouncil"] = <?php echo $councillorship_list->PositionInCouncil->Lookup->toClientList($councillorship_list) ?>;
	fcouncillorshiplist.lists["x_PositionInCouncil"].options = <?php echo JsonEncode($councillorship_list->PositionInCouncil->lookupOptions()) ?>;
	fcouncillorshiplist.lists["x_Committee"] = <?php echo $councillorship_list->Committee->Lookup->toClientList($councillorship_list) ?>;
	fcouncillorshiplist.lists["x_Committee"].options = <?php echo JsonEncode($councillorship_list->Committee->lookupOptions()) ?>;
	fcouncillorshiplist.lists["x_CommitteeRole"] = <?php echo $councillorship_list->CommitteeRole->Lookup->toClientList($councillorship_list) ?>;
	fcouncillorshiplist.lists["x_CommitteeRole"].options = <?php echo JsonEncode($councillorship_list->CommitteeRole->lookupOptions()) ?>;
	fcouncillorshiplist.lists["x_CouncilTerm"] = <?php echo $councillorship_list->CouncilTerm->Lookup->toClientList($councillorship_list) ?>;
	fcouncillorshiplist.lists["x_CouncilTerm"].options = <?php echo JsonEncode($councillorship_list->CouncilTerm->lookupOptions()) ?>;
	fcouncillorshiplist.lists["x_CouncillorTypeType"] = <?php echo $councillorship_list->CouncillorTypeType->Lookup->toClientList($councillorship_list) ?>;
	fcouncillorshiplist.lists["x_CouncillorTypeType"].options = <?php echo JsonEncode($councillorship_list->CouncillorTypeType->lookupOptions()) ?>;
	fcouncillorshiplist.lists["x_ExitReason"] = <?php echo $councillorship_list->ExitReason->Lookup->toClientList($councillorship_list) ?>;
	fcouncillorshiplist.lists["x_ExitReason"].options = <?php echo JsonEncode($councillorship_list->ExitReason->lookupOptions()) ?>;
	loadjs.done("fcouncillorshiplist");
});
var fcouncillorshiplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcouncillorshiplistsrch = currentSearchForm = new ew.Form("fcouncillorshiplistsrch");

	// Dynamic selection lists
	// Filters

	fcouncillorshiplistsrch.filterList = <?php echo $councillorship_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcouncillorshiplistsrch.initSearchPanel = true;
	loadjs.done("fcouncillorshiplistsrch");
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
<?php if (!$councillorship_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($councillorship_list->TotalRecords > 0 && $councillorship_list->ExportOptions->visible()) { ?>
<?php $councillorship_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($councillorship_list->ImportOptions->visible()) { ?>
<?php $councillorship_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($councillorship_list->SearchOptions->visible()) { ?>
<?php $councillorship_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($councillorship_list->FilterOptions->visible()) { ?>
<?php $councillorship_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$councillorship_list->isExport() || Config("EXPORT_MASTER_RECORD") && $councillorship_list->isExport("print")) { ?>
<?php
if ($councillorship_list->DbMasterFilter != "" && $councillorship->getCurrentMasterTable() == "councillor") {
	if ($councillorship_list->MasterRecordExists) {
		include_once "councillormaster.php";
	}
}
?>
<?php
if ($councillorship_list->DbMasterFilter != "" && $councillorship->getCurrentMasterTable() == "local_authority") {
	if ($councillorship_list->MasterRecordExists) {
		include_once "local_authoritymaster.php";
	}
}
?>
<?php } ?>
<?php
$councillorship_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$councillorship_list->isExport() && !$councillorship->CurrentAction) { ?>
<form name="fcouncillorshiplistsrch" id="fcouncillorshiplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcouncillorshiplistsrch-search-panel" class="<?php echo $councillorship_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="councillorship">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $councillorship_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($councillorship_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($councillorship_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $councillorship_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($councillorship_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($councillorship_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($councillorship_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($councillorship_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $councillorship_list->showPageHeader(); ?>
<?php
$councillorship_list->showMessage();
?>
<?php if ($councillorship_list->TotalRecords > 0 || $councillorship->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($councillorship_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> councillorship">
<?php if (!$councillorship_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$councillorship_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillorship_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $councillorship_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcouncillorshiplist" id="fcouncillorshiplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship">
<?php if ($councillorship->getCurrentMasterTable() == "councillor" && $councillorship->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="councillor">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($councillorship_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<?php if ($councillorship->getCurrentMasterTable() == "local_authority" && $councillorship->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($councillorship_list->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($councillorship_list->ProvinceCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_councillorship" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($councillorship_list->TotalRecords > 0 || $councillorship_list->isGridEdit()) { ?>
<table id="tbl_councillorshiplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$councillorship->RowType = ROWTYPE_HEADER;

// Render list options
$councillorship_list->renderListOptions();

// Render list options (header, left)
$councillorship_list->ListOptions->render("header", "left");
?>
<?php if ($councillorship_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($councillorship_list->SortUrl($councillorship_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $councillorship_list->EmployeeID->headerCellClass() ?>"><div id="elh_councillorship_EmployeeID" class="councillorship_EmployeeID"><div class="ew-table-header-caption"><?php echo $councillorship_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $councillorship_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_list->SortUrl($councillorship_list->EmployeeID) ?>', 1);"><div id="elh_councillorship_EmployeeID" class="councillorship_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_list->LACode->Visible) { // LACode ?>
	<?php if ($councillorship_list->SortUrl($councillorship_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $councillorship_list->LACode->headerCellClass() ?>"><div id="elh_councillorship_LACode" class="councillorship_LACode"><div class="ew-table-header-caption"><?php echo $councillorship_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $councillorship_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_list->SortUrl($councillorship_list->LACode) ?>', 1);"><div id="elh_councillorship_LACode" class="councillorship_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_list->PoliticalParty->Visible) { // PoliticalParty ?>
	<?php if ($councillorship_list->SortUrl($councillorship_list->PoliticalParty) == "") { ?>
		<th data-name="PoliticalParty" class="<?php echo $councillorship_list->PoliticalParty->headerCellClass() ?>"><div id="elh_councillorship_PoliticalParty" class="councillorship_PoliticalParty"><div class="ew-table-header-caption"><?php echo $councillorship_list->PoliticalParty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PoliticalParty" class="<?php echo $councillorship_list->PoliticalParty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_list->SortUrl($councillorship_list->PoliticalParty) ?>', 1);"><div id="elh_councillorship_PoliticalParty" class="councillorship_PoliticalParty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_list->PoliticalParty->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_list->PoliticalParty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_list->PoliticalParty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_list->Occupation->Visible) { // Occupation ?>
	<?php if ($councillorship_list->SortUrl($councillorship_list->Occupation) == "") { ?>
		<th data-name="Occupation" class="<?php echo $councillorship_list->Occupation->headerCellClass() ?>"><div id="elh_councillorship_Occupation" class="councillorship_Occupation"><div class="ew-table-header-caption"><?php echo $councillorship_list->Occupation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Occupation" class="<?php echo $councillorship_list->Occupation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_list->SortUrl($councillorship_list->Occupation) ?>', 1);"><div id="elh_councillorship_Occupation" class="councillorship_Occupation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_list->Occupation->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_list->Occupation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_list->Occupation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_list->PositionInCouncil->Visible) { // PositionInCouncil ?>
	<?php if ($councillorship_list->SortUrl($councillorship_list->PositionInCouncil) == "") { ?>
		<th data-name="PositionInCouncil" class="<?php echo $councillorship_list->PositionInCouncil->headerCellClass() ?>"><div id="elh_councillorship_PositionInCouncil" class="councillorship_PositionInCouncil"><div class="ew-table-header-caption"><?php echo $councillorship_list->PositionInCouncil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionInCouncil" class="<?php echo $councillorship_list->PositionInCouncil->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_list->SortUrl($councillorship_list->PositionInCouncil) ?>', 1);"><div id="elh_councillorship_PositionInCouncil" class="councillorship_PositionInCouncil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_list->PositionInCouncil->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_list->PositionInCouncil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_list->PositionInCouncil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_list->Committee->Visible) { // Committee ?>
	<?php if ($councillorship_list->SortUrl($councillorship_list->Committee) == "") { ?>
		<th data-name="Committee" class="<?php echo $councillorship_list->Committee->headerCellClass() ?>"><div id="elh_councillorship_Committee" class="councillorship_Committee"><div class="ew-table-header-caption"><?php echo $councillorship_list->Committee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Committee" class="<?php echo $councillorship_list->Committee->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_list->SortUrl($councillorship_list->Committee) ?>', 1);"><div id="elh_councillorship_Committee" class="councillorship_Committee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_list->Committee->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_list->Committee->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_list->Committee->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_list->CommitteeRole->Visible) { // CommitteeRole ?>
	<?php if ($councillorship_list->SortUrl($councillorship_list->CommitteeRole) == "") { ?>
		<th data-name="CommitteeRole" class="<?php echo $councillorship_list->CommitteeRole->headerCellClass() ?>"><div id="elh_councillorship_CommitteeRole" class="councillorship_CommitteeRole"><div class="ew-table-header-caption"><?php echo $councillorship_list->CommitteeRole->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CommitteeRole" class="<?php echo $councillorship_list->CommitteeRole->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_list->SortUrl($councillorship_list->CommitteeRole) ?>', 1);"><div id="elh_councillorship_CommitteeRole" class="councillorship_CommitteeRole">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_list->CommitteeRole->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_list->CommitteeRole->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_list->CommitteeRole->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_list->CouncilTerm->Visible) { // CouncilTerm ?>
	<?php if ($councillorship_list->SortUrl($councillorship_list->CouncilTerm) == "") { ?>
		<th data-name="CouncilTerm" class="<?php echo $councillorship_list->CouncilTerm->headerCellClass() ?>"><div id="elh_councillorship_CouncilTerm" class="councillorship_CouncilTerm"><div class="ew-table-header-caption"><?php echo $councillorship_list->CouncilTerm->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilTerm" class="<?php echo $councillorship_list->CouncilTerm->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_list->SortUrl($councillorship_list->CouncilTerm) ?>', 1);"><div id="elh_councillorship_CouncilTerm" class="councillorship_CouncilTerm">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_list->CouncilTerm->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_list->CouncilTerm->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_list->CouncilTerm->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_list->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
	<?php if ($councillorship_list->SortUrl($councillorship_list->CouncillorTypeType) == "") { ?>
		<th data-name="CouncillorTypeType" class="<?php echo $councillorship_list->CouncillorTypeType->headerCellClass() ?>"><div id="elh_councillorship_CouncillorTypeType" class="councillorship_CouncillorTypeType"><div class="ew-table-header-caption"><?php echo $councillorship_list->CouncillorTypeType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncillorTypeType" class="<?php echo $councillorship_list->CouncillorTypeType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_list->SortUrl($councillorship_list->CouncillorTypeType) ?>', 1);"><div id="elh_councillorship_CouncillorTypeType" class="councillorship_CouncillorTypeType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_list->CouncillorTypeType->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_list->CouncillorTypeType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_list->CouncillorTypeType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_list->ExitReason->Visible) { // ExitReason ?>
	<?php if ($councillorship_list->SortUrl($councillorship_list->ExitReason) == "") { ?>
		<th data-name="ExitReason" class="<?php echo $councillorship_list->ExitReason->headerCellClass() ?>"><div id="elh_councillorship_ExitReason" class="councillorship_ExitReason"><div class="ew-table-header-caption"><?php echo $councillorship_list->ExitReason->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExitReason" class="<?php echo $councillorship_list->ExitReason->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_list->SortUrl($councillorship_list->ExitReason) ?>', 1);"><div id="elh_councillorship_ExitReason" class="councillorship_ExitReason">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_list->ExitReason->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_list->ExitReason->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_list->ExitReason->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$councillorship_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($councillorship_list->ExportAll && $councillorship_list->isExport()) {
	$councillorship_list->StopRecord = $councillorship_list->TotalRecords;
} else {

	// Set the last record to display
	if ($councillorship_list->TotalRecords > $councillorship_list->StartRecord + $councillorship_list->DisplayRecords - 1)
		$councillorship_list->StopRecord = $councillorship_list->StartRecord + $councillorship_list->DisplayRecords - 1;
	else
		$councillorship_list->StopRecord = $councillorship_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($councillorship->isConfirm() || $councillorship_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($councillorship_list->FormKeyCountName) && ($councillorship_list->isGridAdd() || $councillorship_list->isGridEdit() || $councillorship->isConfirm())) {
		$councillorship_list->KeyCount = $CurrentForm->getValue($councillorship_list->FormKeyCountName);
		$councillorship_list->StopRecord = $councillorship_list->StartRecord + $councillorship_list->KeyCount - 1;
	}
}
$councillorship_list->RecordCount = $councillorship_list->StartRecord - 1;
if ($councillorship_list->Recordset && !$councillorship_list->Recordset->EOF) {
	$councillorship_list->Recordset->moveFirst();
	$selectLimit = $councillorship_list->UseSelectLimit;
	if (!$selectLimit && $councillorship_list->StartRecord > 1)
		$councillorship_list->Recordset->move($councillorship_list->StartRecord - 1);
} elseif (!$councillorship->AllowAddDeleteRow && $councillorship_list->StopRecord == 0) {
	$councillorship_list->StopRecord = $councillorship->GridAddRowCount;
}

// Initialize aggregate
$councillorship->RowType = ROWTYPE_AGGREGATEINIT;
$councillorship->resetAttributes();
$councillorship_list->renderRow();
if ($councillorship_list->isGridAdd())
	$councillorship_list->RowIndex = 0;
if ($councillorship_list->isGridEdit())
	$councillorship_list->RowIndex = 0;
while ($councillorship_list->RecordCount < $councillorship_list->StopRecord) {
	$councillorship_list->RecordCount++;
	if ($councillorship_list->RecordCount >= $councillorship_list->StartRecord) {
		$councillorship_list->RowCount++;
		if ($councillorship_list->isGridAdd() || $councillorship_list->isGridEdit() || $councillorship->isConfirm()) {
			$councillorship_list->RowIndex++;
			$CurrentForm->Index = $councillorship_list->RowIndex;
			if ($CurrentForm->hasValue($councillorship_list->FormActionName) && ($councillorship->isConfirm() || $councillorship_list->EventCancelled))
				$councillorship_list->RowAction = strval($CurrentForm->getValue($councillorship_list->FormActionName));
			elseif ($councillorship_list->isGridAdd())
				$councillorship_list->RowAction = "insert";
			else
				$councillorship_list->RowAction = "";
		}

		// Set up key count
		$councillorship_list->KeyCount = $councillorship_list->RowIndex;

		// Init row class and style
		$councillorship->resetAttributes();
		$councillorship->CssClass = "";
		if ($councillorship_list->isGridAdd()) {
			$councillorship_list->loadRowValues(); // Load default values
		} else {
			$councillorship_list->loadRowValues($councillorship_list->Recordset); // Load row values
		}
		$councillorship->RowType = ROWTYPE_VIEW; // Render view
		if ($councillorship_list->isGridAdd()) // Grid add
			$councillorship->RowType = ROWTYPE_ADD; // Render add
		if ($councillorship_list->isGridAdd() && $councillorship->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$councillorship_list->restoreCurrentRowFormValues($councillorship_list->RowIndex); // Restore form values
		if ($councillorship_list->isGridEdit()) { // Grid edit
			if ($councillorship->EventCancelled)
				$councillorship_list->restoreCurrentRowFormValues($councillorship_list->RowIndex); // Restore form values
			if ($councillorship_list->RowAction == "insert")
				$councillorship->RowType = ROWTYPE_ADD; // Render add
			else
				$councillorship->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($councillorship_list->isGridEdit() && ($councillorship->RowType == ROWTYPE_EDIT || $councillorship->RowType == ROWTYPE_ADD) && $councillorship->EventCancelled) // Update failed
			$councillorship_list->restoreCurrentRowFormValues($councillorship_list->RowIndex); // Restore form values
		if ($councillorship->RowType == ROWTYPE_EDIT) // Edit row
			$councillorship_list->EditRowCount++;

		// Set up row id / data-rowindex
		$councillorship->RowAttrs->merge(["data-rowindex" => $councillorship_list->RowCount, "id" => "r" . $councillorship_list->RowCount . "_councillorship", "data-rowtype" => $councillorship->RowType]);

		// Render row
		$councillorship_list->renderRow();

		// Render list options
		$councillorship_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($councillorship_list->RowAction != "delete" && $councillorship_list->RowAction != "insertdelete" && !($councillorship_list->RowAction == "insert" && $councillorship->isConfirm() && $councillorship_list->emptyRow())) {
?>
	<tr <?php echo $councillorship->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillorship_list->ListOptions->render("body", "left", $councillorship_list->RowCount);
?>
	<?php if ($councillorship_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $councillorship_list->EmployeeID->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($councillorship_list->EmployeeID->getSessionValue() != "") { ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_EmployeeID" class="form-group">
<span<?php echo $councillorship_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_list->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" name="x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_EmployeeID" class="form-group">
<?php
$onchange = $councillorship_list->EmployeeID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillorship_list->EmployeeID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $councillorship_list->RowIndex ?>_EmployeeID">
	<input type="text" class="form-control" name="sv_x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" id="sv_x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" value="<?php echo RemoveHtml($councillorship_list->EmployeeID->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($councillorship_list->EmployeeID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillorship_list->EmployeeID->getPlaceHolder()) ?>"<?php echo $councillorship_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" data-value-separator="<?php echo $councillorship_list->EmployeeID->displayValueSeparatorAttribute() ?>" name="x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" id="x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_list->EmployeeID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorshiplist"], function() {
	fcouncillorshiplist.createAutoSuggest({"id":"x<?php echo $councillorship_list->RowIndex ?>_EmployeeID","forceSelect":false});
});
</script>
<?php echo $councillorship_list->EmployeeID->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_EmployeeID") ?>
</span>
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" name="o<?php echo $councillorship_list->RowIndex ?>_EmployeeID" id="o<?php echo $councillorship_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($councillorship_list->EmployeeID->getSessionValue() != "") { ?>

<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_EmployeeID" class="form-group">
<span<?php echo $councillorship_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_list->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" name="x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<?php
$onchange = $councillorship_list->EmployeeID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillorship_list->EmployeeID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $councillorship_list->RowIndex ?>_EmployeeID">
	<input type="text" class="form-control" name="sv_x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" id="sv_x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" value="<?php echo RemoveHtml($councillorship_list->EmployeeID->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($councillorship_list->EmployeeID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillorship_list->EmployeeID->getPlaceHolder()) ?>"<?php echo $councillorship_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" data-value-separator="<?php echo $councillorship_list->EmployeeID->displayValueSeparatorAttribute() ?>" name="x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" id="x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_list->EmployeeID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorshiplist"], function() {
	fcouncillorshiplist.createAutoSuggest({"id":"x<?php echo $councillorship_list->RowIndex ?>_EmployeeID","forceSelect":false});
});
</script>
<?php echo $councillorship_list->EmployeeID->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_EmployeeID") ?>

<?php } ?>

<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" name="o<?php echo $councillorship_list->RowIndex ?>_EmployeeID" id="o<?php echo $councillorship_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_list->EmployeeID->OldValue != null ? $councillorship_list->EmployeeID->OldValue : $councillorship_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_EmployeeID">
<span<?php echo $councillorship_list->EmployeeID->viewAttributes() ?>><?php echo $councillorship_list->EmployeeID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $councillorship_list->LACode->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($councillorship_list->LACode->getSessionValue() != "") { ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_LACode" class="form-group">
<span<?php echo $councillorship_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $councillorship_list->RowIndex ?>_LACode" name="x<?php echo $councillorship_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_LACode" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_LACode" data-value-separator="<?php echo $councillorship_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_LACode" name="x<?php echo $councillorship_list->RowIndex ?>_LACode"<?php echo $councillorship_list->LACode->editAttributes() ?>>
			<?php echo $councillorship_list->LACode->selectOptionListHtml("x{$councillorship_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $councillorship_list->LACode->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_LACode" name="o<?php echo $councillorship_list->RowIndex ?>_LACode" id="o<?php echo $councillorship_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($councillorship_list->LACode->getSessionValue() != "") { ?>

<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_LACode" class="form-group">
<span<?php echo $councillorship_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_list->LACode->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $councillorship_list->RowIndex ?>_LACode" name="x<?php echo $councillorship_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_list->LACode->CurrentValue) ?>">
<?php } else { ?>

<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_LACode" data-value-separator="<?php echo $councillorship_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_LACode" name="x<?php echo $councillorship_list->RowIndex ?>_LACode"<?php echo $councillorship_list->LACode->editAttributes() ?>>
			<?php echo $councillorship_list->LACode->selectOptionListHtml("x{$councillorship_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $councillorship_list->LACode->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_LACode") ?>

<?php } ?>

<input type="hidden" data-table="councillorship" data-field="x_LACode" name="o<?php echo $councillorship_list->RowIndex ?>_LACode" id="o<?php echo $councillorship_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_list->LACode->OldValue != null ? $councillorship_list->LACode->OldValue : $councillorship_list->LACode->CurrentValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_LACode">
<span<?php echo $councillorship_list->LACode->viewAttributes() ?>><?php echo $councillorship_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_list->PoliticalParty->Visible) { // PoliticalParty ?>
		<td data-name="PoliticalParty" <?php echo $councillorship_list->PoliticalParty->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_PoliticalParty" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PoliticalParty" data-value-separator="<?php echo $councillorship_list->PoliticalParty->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_PoliticalParty" name="x<?php echo $councillorship_list->RowIndex ?>_PoliticalParty"<?php echo $councillorship_list->PoliticalParty->editAttributes() ?>>
			<?php echo $councillorship_list->PoliticalParty->selectOptionListHtml("x{$councillorship_list->RowIndex}_PoliticalParty") ?>
		</select>
</div>
<?php echo $councillorship_list->PoliticalParty->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_PoliticalParty") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_PoliticalParty" name="o<?php echo $councillorship_list->RowIndex ?>_PoliticalParty" id="o<?php echo $councillorship_list->RowIndex ?>_PoliticalParty" value="<?php echo HtmlEncode($councillorship_list->PoliticalParty->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_PoliticalParty" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PoliticalParty" data-value-separator="<?php echo $councillorship_list->PoliticalParty->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_PoliticalParty" name="x<?php echo $councillorship_list->RowIndex ?>_PoliticalParty"<?php echo $councillorship_list->PoliticalParty->editAttributes() ?>>
			<?php echo $councillorship_list->PoliticalParty->selectOptionListHtml("x{$councillorship_list->RowIndex}_PoliticalParty") ?>
		</select>
</div>
<?php echo $councillorship_list->PoliticalParty->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_PoliticalParty") ?>
</span>
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_PoliticalParty">
<span<?php echo $councillorship_list->PoliticalParty->viewAttributes() ?>><?php echo $councillorship_list->PoliticalParty->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_list->Occupation->Visible) { // Occupation ?>
		<td data-name="Occupation" <?php echo $councillorship_list->Occupation->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_Occupation" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Occupation" data-value-separator="<?php echo $councillorship_list->Occupation->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_Occupation" name="x<?php echo $councillorship_list->RowIndex ?>_Occupation"<?php echo $councillorship_list->Occupation->editAttributes() ?>>
			<?php echo $councillorship_list->Occupation->selectOptionListHtml("x{$councillorship_list->RowIndex}_Occupation") ?>
		</select>
</div>
<?php echo $councillorship_list->Occupation->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_Occupation") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_Occupation" name="o<?php echo $councillorship_list->RowIndex ?>_Occupation" id="o<?php echo $councillorship_list->RowIndex ?>_Occupation" value="<?php echo HtmlEncode($councillorship_list->Occupation->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_Occupation" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Occupation" data-value-separator="<?php echo $councillorship_list->Occupation->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_Occupation" name="x<?php echo $councillorship_list->RowIndex ?>_Occupation"<?php echo $councillorship_list->Occupation->editAttributes() ?>>
			<?php echo $councillorship_list->Occupation->selectOptionListHtml("x{$councillorship_list->RowIndex}_Occupation") ?>
		</select>
</div>
<?php echo $councillorship_list->Occupation->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_Occupation") ?>
</span>
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_Occupation">
<span<?php echo $councillorship_list->Occupation->viewAttributes() ?>><?php echo $councillorship_list->Occupation->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_list->PositionInCouncil->Visible) { // PositionInCouncil ?>
		<td data-name="PositionInCouncil" <?php echo $councillorship_list->PositionInCouncil->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_PositionInCouncil" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PositionInCouncil" data-value-separator="<?php echo $councillorship_list->PositionInCouncil->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_PositionInCouncil" name="x<?php echo $councillorship_list->RowIndex ?>_PositionInCouncil"<?php echo $councillorship_list->PositionInCouncil->editAttributes() ?>>
			<?php echo $councillorship_list->PositionInCouncil->selectOptionListHtml("x{$councillorship_list->RowIndex}_PositionInCouncil") ?>
		</select>
</div>
<?php echo $councillorship_list->PositionInCouncil->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_PositionInCouncil") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_PositionInCouncil" name="o<?php echo $councillorship_list->RowIndex ?>_PositionInCouncil" id="o<?php echo $councillorship_list->RowIndex ?>_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_list->PositionInCouncil->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PositionInCouncil" data-value-separator="<?php echo $councillorship_list->PositionInCouncil->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_PositionInCouncil" name="x<?php echo $councillorship_list->RowIndex ?>_PositionInCouncil"<?php echo $councillorship_list->PositionInCouncil->editAttributes() ?>>
			<?php echo $councillorship_list->PositionInCouncil->selectOptionListHtml("x{$councillorship_list->RowIndex}_PositionInCouncil") ?>
		</select>
</div>
<?php echo $councillorship_list->PositionInCouncil->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_PositionInCouncil") ?>
<input type="hidden" data-table="councillorship" data-field="x_PositionInCouncil" name="o<?php echo $councillorship_list->RowIndex ?>_PositionInCouncil" id="o<?php echo $councillorship_list->RowIndex ?>_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_list->PositionInCouncil->OldValue != null ? $councillorship_list->PositionInCouncil->OldValue : $councillorship_list->PositionInCouncil->CurrentValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_PositionInCouncil">
<span<?php echo $councillorship_list->PositionInCouncil->viewAttributes() ?>><?php echo $councillorship_list->PositionInCouncil->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_list->Committee->Visible) { // Committee ?>
		<td data-name="Committee" <?php echo $councillorship_list->Committee->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_Committee" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Committee" data-value-separator="<?php echo $councillorship_list->Committee->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_Committee" name="x<?php echo $councillorship_list->RowIndex ?>_Committee"<?php echo $councillorship_list->Committee->editAttributes() ?>>
			<?php echo $councillorship_list->Committee->selectOptionListHtml("x{$councillorship_list->RowIndex}_Committee") ?>
		</select>
</div>
<?php echo $councillorship_list->Committee->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_Committee") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_Committee" name="o<?php echo $councillorship_list->RowIndex ?>_Committee" id="o<?php echo $councillorship_list->RowIndex ?>_Committee" value="<?php echo HtmlEncode($councillorship_list->Committee->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_Committee" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Committee" data-value-separator="<?php echo $councillorship_list->Committee->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_Committee" name="x<?php echo $councillorship_list->RowIndex ?>_Committee"<?php echo $councillorship_list->Committee->editAttributes() ?>>
			<?php echo $councillorship_list->Committee->selectOptionListHtml("x{$councillorship_list->RowIndex}_Committee") ?>
		</select>
</div>
<?php echo $councillorship_list->Committee->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_Committee") ?>
</span>
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_Committee">
<span<?php echo $councillorship_list->Committee->viewAttributes() ?>><?php echo $councillorship_list->Committee->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_list->CommitteeRole->Visible) { // CommitteeRole ?>
		<td data-name="CommitteeRole" <?php echo $councillorship_list->CommitteeRole->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_CommitteeRole" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CommitteeRole" data-value-separator="<?php echo $councillorship_list->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_CommitteeRole" name="x<?php echo $councillorship_list->RowIndex ?>_CommitteeRole"<?php echo $councillorship_list->CommitteeRole->editAttributes() ?>>
			<?php echo $councillorship_list->CommitteeRole->selectOptionListHtml("x{$councillorship_list->RowIndex}_CommitteeRole") ?>
		</select>
</div>
<?php echo $councillorship_list->CommitteeRole->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_CommitteeRole") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_CommitteeRole" name="o<?php echo $councillorship_list->RowIndex ?>_CommitteeRole" id="o<?php echo $councillorship_list->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($councillorship_list->CommitteeRole->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_CommitteeRole" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CommitteeRole" data-value-separator="<?php echo $councillorship_list->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_CommitteeRole" name="x<?php echo $councillorship_list->RowIndex ?>_CommitteeRole"<?php echo $councillorship_list->CommitteeRole->editAttributes() ?>>
			<?php echo $councillorship_list->CommitteeRole->selectOptionListHtml("x{$councillorship_list->RowIndex}_CommitteeRole") ?>
		</select>
</div>
<?php echo $councillorship_list->CommitteeRole->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_CommitteeRole") ?>
</span>
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_CommitteeRole">
<span<?php echo $councillorship_list->CommitteeRole->viewAttributes() ?>><?php echo $councillorship_list->CommitteeRole->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_list->CouncilTerm->Visible) { // CouncilTerm ?>
		<td data-name="CouncilTerm" <?php echo $councillorship_list->CouncilTerm->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_CouncilTerm" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncilTerm" data-value-separator="<?php echo $councillorship_list->CouncilTerm->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_CouncilTerm" name="x<?php echo $councillorship_list->RowIndex ?>_CouncilTerm"<?php echo $councillorship_list->CouncilTerm->editAttributes() ?>>
			<?php echo $councillorship_list->CouncilTerm->selectOptionListHtml("x{$councillorship_list->RowIndex}_CouncilTerm") ?>
		</select>
</div>
<?php echo $councillorship_list->CouncilTerm->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_CouncilTerm") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_CouncilTerm" name="o<?php echo $councillorship_list->RowIndex ?>_CouncilTerm" id="o<?php echo $councillorship_list->RowIndex ?>_CouncilTerm" value="<?php echo HtmlEncode($councillorship_list->CouncilTerm->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncilTerm" data-value-separator="<?php echo $councillorship_list->CouncilTerm->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_CouncilTerm" name="x<?php echo $councillorship_list->RowIndex ?>_CouncilTerm"<?php echo $councillorship_list->CouncilTerm->editAttributes() ?>>
			<?php echo $councillorship_list->CouncilTerm->selectOptionListHtml("x{$councillorship_list->RowIndex}_CouncilTerm") ?>
		</select>
</div>
<?php echo $councillorship_list->CouncilTerm->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_CouncilTerm") ?>
<input type="hidden" data-table="councillorship" data-field="x_CouncilTerm" name="o<?php echo $councillorship_list->RowIndex ?>_CouncilTerm" id="o<?php echo $councillorship_list->RowIndex ?>_CouncilTerm" value="<?php echo HtmlEncode($councillorship_list->CouncilTerm->OldValue != null ? $councillorship_list->CouncilTerm->OldValue : $councillorship_list->CouncilTerm->CurrentValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_CouncilTerm">
<span<?php echo $councillorship_list->CouncilTerm->viewAttributes() ?>><?php echo $councillorship_list->CouncilTerm->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_list->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
		<td data-name="CouncillorTypeType" <?php echo $councillorship_list->CouncillorTypeType->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_CouncillorTypeType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncillorTypeType" data-value-separator="<?php echo $councillorship_list->CouncillorTypeType->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_CouncillorTypeType" name="x<?php echo $councillorship_list->RowIndex ?>_CouncillorTypeType"<?php echo $councillorship_list->CouncillorTypeType->editAttributes() ?>>
			<?php echo $councillorship_list->CouncillorTypeType->selectOptionListHtml("x{$councillorship_list->RowIndex}_CouncillorTypeType") ?>
		</select>
</div>
<?php echo $councillorship_list->CouncillorTypeType->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_CouncillorTypeType") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_CouncillorTypeType" name="o<?php echo $councillorship_list->RowIndex ?>_CouncillorTypeType" id="o<?php echo $councillorship_list->RowIndex ?>_CouncillorTypeType" value="<?php echo HtmlEncode($councillorship_list->CouncillorTypeType->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_CouncillorTypeType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncillorTypeType" data-value-separator="<?php echo $councillorship_list->CouncillorTypeType->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_CouncillorTypeType" name="x<?php echo $councillorship_list->RowIndex ?>_CouncillorTypeType"<?php echo $councillorship_list->CouncillorTypeType->editAttributes() ?>>
			<?php echo $councillorship_list->CouncillorTypeType->selectOptionListHtml("x{$councillorship_list->RowIndex}_CouncillorTypeType") ?>
		</select>
</div>
<?php echo $councillorship_list->CouncillorTypeType->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_CouncillorTypeType") ?>
</span>
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_CouncillorTypeType">
<span<?php echo $councillorship_list->CouncillorTypeType->viewAttributes() ?>><?php echo $councillorship_list->CouncillorTypeType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillorship_list->ExitReason->Visible) { // ExitReason ?>
		<td data-name="ExitReason" <?php echo $councillorship_list->ExitReason->cellAttributes() ?>>
<?php if ($councillorship->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_ExitReason" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_ExitReason" data-value-separator="<?php echo $councillorship_list->ExitReason->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_ExitReason" name="x<?php echo $councillorship_list->RowIndex ?>_ExitReason"<?php echo $councillorship_list->ExitReason->editAttributes() ?>>
			<?php echo $councillorship_list->ExitReason->selectOptionListHtml("x{$councillorship_list->RowIndex}_ExitReason") ?>
		</select>
</div>
<?php echo $councillorship_list->ExitReason->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_ExitReason") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_ExitReason" name="o<?php echo $councillorship_list->RowIndex ?>_ExitReason" id="o<?php echo $councillorship_list->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($councillorship_list->ExitReason->OldValue) ?>">
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_ExitReason" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_ExitReason" data-value-separator="<?php echo $councillorship_list->ExitReason->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_ExitReason" name="x<?php echo $councillorship_list->RowIndex ?>_ExitReason"<?php echo $councillorship_list->ExitReason->editAttributes() ?>>
			<?php echo $councillorship_list->ExitReason->selectOptionListHtml("x{$councillorship_list->RowIndex}_ExitReason") ?>
		</select>
</div>
<?php echo $councillorship_list->ExitReason->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_ExitReason") ?>
</span>
<?php } ?>
<?php if ($councillorship->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillorship_list->RowCount ?>_councillorship_ExitReason">
<span<?php echo $councillorship_list->ExitReason->viewAttributes() ?>><?php echo $councillorship_list->ExitReason->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$councillorship_list->ListOptions->render("body", "right", $councillorship_list->RowCount);
?>
	</tr>
<?php if ($councillorship->RowType == ROWTYPE_ADD || $councillorship->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcouncillorshiplist", "load"], function() {
	fcouncillorshiplist.updateLists(<?php echo $councillorship_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$councillorship_list->isGridAdd())
		if (!$councillorship_list->Recordset->EOF)
			$councillorship_list->Recordset->moveNext();
}
?>
<?php
	if ($councillorship_list->isGridAdd() || $councillorship_list->isGridEdit()) {
		$councillorship_list->RowIndex = '$rowindex$';
		$councillorship_list->loadRowValues();

		// Set row properties
		$councillorship->resetAttributes();
		$councillorship->RowAttrs->merge(["data-rowindex" => $councillorship_list->RowIndex, "id" => "r0_councillorship", "data-rowtype" => ROWTYPE_ADD]);
		$councillorship->RowAttrs->appendClass("ew-template");
		$councillorship->RowType = ROWTYPE_ADD;

		// Render row
		$councillorship_list->renderRow();

		// Render list options
		$councillorship_list->renderListOptions();
		$councillorship_list->StartRowCount = 0;
?>
	<tr <?php echo $councillorship->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillorship_list->ListOptions->render("body", "left", $councillorship_list->RowIndex);
?>
	<?php if ($councillorship_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if ($councillorship_list->EmployeeID->getSessionValue() != "") { ?>
<span id="el$rowindex$_councillorship_EmployeeID" class="form-group councillorship_EmployeeID">
<span<?php echo $councillorship_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_list->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" name="x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_list->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_councillorship_EmployeeID" class="form-group councillorship_EmployeeID">
<?php
$onchange = $councillorship_list->EmployeeID->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillorship_list->EmployeeID->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $councillorship_list->RowIndex ?>_EmployeeID">
	<input type="text" class="form-control" name="sv_x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" id="sv_x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" value="<?php echo RemoveHtml($councillorship_list->EmployeeID->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($councillorship_list->EmployeeID->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillorship_list->EmployeeID->getPlaceHolder()) ?>"<?php echo $councillorship_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" data-value-separator="<?php echo $councillorship_list->EmployeeID->displayValueSeparatorAttribute() ?>" name="x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" id="x<?php echo $councillorship_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_list->EmployeeID->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorshiplist"], function() {
	fcouncillorshiplist.createAutoSuggest({"id":"x<?php echo $councillorship_list->RowIndex ?>_EmployeeID","forceSelect":false});
});
</script>
<?php echo $councillorship_list->EmployeeID->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_EmployeeID") ?>
</span>
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_EmployeeID" name="o<?php echo $councillorship_list->RowIndex ?>_EmployeeID" id="o<?php echo $councillorship_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillorship_list->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<?php if ($councillorship_list->LACode->getSessionValue() != "") { ?>
<span id="el$rowindex$_councillorship_LACode" class="form-group councillorship_LACode">
<span<?php echo $councillorship_list->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillorship_list->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $councillorship_list->RowIndex ?>_LACode" name="x<?php echo $councillorship_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_list->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_councillorship_LACode" class="form-group councillorship_LACode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_LACode" data-value-separator="<?php echo $councillorship_list->LACode->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_LACode" name="x<?php echo $councillorship_list->RowIndex ?>_LACode"<?php echo $councillorship_list->LACode->editAttributes() ?>>
			<?php echo $councillorship_list->LACode->selectOptionListHtml("x{$councillorship_list->RowIndex}_LACode") ?>
		</select>
</div>
<?php echo $councillorship_list->LACode->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<input type="hidden" data-table="councillorship" data-field="x_LACode" name="o<?php echo $councillorship_list->RowIndex ?>_LACode" id="o<?php echo $councillorship_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillorship_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_list->PoliticalParty->Visible) { // PoliticalParty ?>
		<td data-name="PoliticalParty">
<span id="el$rowindex$_councillorship_PoliticalParty" class="form-group councillorship_PoliticalParty">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PoliticalParty" data-value-separator="<?php echo $councillorship_list->PoliticalParty->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_PoliticalParty" name="x<?php echo $councillorship_list->RowIndex ?>_PoliticalParty"<?php echo $councillorship_list->PoliticalParty->editAttributes() ?>>
			<?php echo $councillorship_list->PoliticalParty->selectOptionListHtml("x{$councillorship_list->RowIndex}_PoliticalParty") ?>
		</select>
</div>
<?php echo $councillorship_list->PoliticalParty->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_PoliticalParty") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_PoliticalParty" name="o<?php echo $councillorship_list->RowIndex ?>_PoliticalParty" id="o<?php echo $councillorship_list->RowIndex ?>_PoliticalParty" value="<?php echo HtmlEncode($councillorship_list->PoliticalParty->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_list->Occupation->Visible) { // Occupation ?>
		<td data-name="Occupation">
<span id="el$rowindex$_councillorship_Occupation" class="form-group councillorship_Occupation">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Occupation" data-value-separator="<?php echo $councillorship_list->Occupation->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_Occupation" name="x<?php echo $councillorship_list->RowIndex ?>_Occupation"<?php echo $councillorship_list->Occupation->editAttributes() ?>>
			<?php echo $councillorship_list->Occupation->selectOptionListHtml("x{$councillorship_list->RowIndex}_Occupation") ?>
		</select>
</div>
<?php echo $councillorship_list->Occupation->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_Occupation") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_Occupation" name="o<?php echo $councillorship_list->RowIndex ?>_Occupation" id="o<?php echo $councillorship_list->RowIndex ?>_Occupation" value="<?php echo HtmlEncode($councillorship_list->Occupation->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_list->PositionInCouncil->Visible) { // PositionInCouncil ?>
		<td data-name="PositionInCouncil">
<span id="el$rowindex$_councillorship_PositionInCouncil" class="form-group councillorship_PositionInCouncil">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_PositionInCouncil" data-value-separator="<?php echo $councillorship_list->PositionInCouncil->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_PositionInCouncil" name="x<?php echo $councillorship_list->RowIndex ?>_PositionInCouncil"<?php echo $councillorship_list->PositionInCouncil->editAttributes() ?>>
			<?php echo $councillorship_list->PositionInCouncil->selectOptionListHtml("x{$councillorship_list->RowIndex}_PositionInCouncil") ?>
		</select>
</div>
<?php echo $councillorship_list->PositionInCouncil->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_PositionInCouncil") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_PositionInCouncil" name="o<?php echo $councillorship_list->RowIndex ?>_PositionInCouncil" id="o<?php echo $councillorship_list->RowIndex ?>_PositionInCouncil" value="<?php echo HtmlEncode($councillorship_list->PositionInCouncil->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_list->Committee->Visible) { // Committee ?>
		<td data-name="Committee">
<span id="el$rowindex$_councillorship_Committee" class="form-group councillorship_Committee">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_Committee" data-value-separator="<?php echo $councillorship_list->Committee->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_Committee" name="x<?php echo $councillorship_list->RowIndex ?>_Committee"<?php echo $councillorship_list->Committee->editAttributes() ?>>
			<?php echo $councillorship_list->Committee->selectOptionListHtml("x{$councillorship_list->RowIndex}_Committee") ?>
		</select>
</div>
<?php echo $councillorship_list->Committee->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_Committee") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_Committee" name="o<?php echo $councillorship_list->RowIndex ?>_Committee" id="o<?php echo $councillorship_list->RowIndex ?>_Committee" value="<?php echo HtmlEncode($councillorship_list->Committee->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_list->CommitteeRole->Visible) { // CommitteeRole ?>
		<td data-name="CommitteeRole">
<span id="el$rowindex$_councillorship_CommitteeRole" class="form-group councillorship_CommitteeRole">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CommitteeRole" data-value-separator="<?php echo $councillorship_list->CommitteeRole->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_CommitteeRole" name="x<?php echo $councillorship_list->RowIndex ?>_CommitteeRole"<?php echo $councillorship_list->CommitteeRole->editAttributes() ?>>
			<?php echo $councillorship_list->CommitteeRole->selectOptionListHtml("x{$councillorship_list->RowIndex}_CommitteeRole") ?>
		</select>
</div>
<?php echo $councillorship_list->CommitteeRole->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_CommitteeRole") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_CommitteeRole" name="o<?php echo $councillorship_list->RowIndex ?>_CommitteeRole" id="o<?php echo $councillorship_list->RowIndex ?>_CommitteeRole" value="<?php echo HtmlEncode($councillorship_list->CommitteeRole->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_list->CouncilTerm->Visible) { // CouncilTerm ?>
		<td data-name="CouncilTerm">
<span id="el$rowindex$_councillorship_CouncilTerm" class="form-group councillorship_CouncilTerm">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncilTerm" data-value-separator="<?php echo $councillorship_list->CouncilTerm->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_CouncilTerm" name="x<?php echo $councillorship_list->RowIndex ?>_CouncilTerm"<?php echo $councillorship_list->CouncilTerm->editAttributes() ?>>
			<?php echo $councillorship_list->CouncilTerm->selectOptionListHtml("x{$councillorship_list->RowIndex}_CouncilTerm") ?>
		</select>
</div>
<?php echo $councillorship_list->CouncilTerm->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_CouncilTerm") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_CouncilTerm" name="o<?php echo $councillorship_list->RowIndex ?>_CouncilTerm" id="o<?php echo $councillorship_list->RowIndex ?>_CouncilTerm" value="<?php echo HtmlEncode($councillorship_list->CouncilTerm->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_list->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
		<td data-name="CouncillorTypeType">
<span id="el$rowindex$_councillorship_CouncillorTypeType" class="form-group councillorship_CouncillorTypeType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_CouncillorTypeType" data-value-separator="<?php echo $councillorship_list->CouncillorTypeType->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_CouncillorTypeType" name="x<?php echo $councillorship_list->RowIndex ?>_CouncillorTypeType"<?php echo $councillorship_list->CouncillorTypeType->editAttributes() ?>>
			<?php echo $councillorship_list->CouncillorTypeType->selectOptionListHtml("x{$councillorship_list->RowIndex}_CouncillorTypeType") ?>
		</select>
</div>
<?php echo $councillorship_list->CouncillorTypeType->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_CouncillorTypeType") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_CouncillorTypeType" name="o<?php echo $councillorship_list->RowIndex ?>_CouncillorTypeType" id="o<?php echo $councillorship_list->RowIndex ?>_CouncillorTypeType" value="<?php echo HtmlEncode($councillorship_list->CouncillorTypeType->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillorship_list->ExitReason->Visible) { // ExitReason ?>
		<td data-name="ExitReason">
<span id="el$rowindex$_councillorship_ExitReason" class="form-group councillorship_ExitReason">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillorship" data-field="x_ExitReason" data-value-separator="<?php echo $councillorship_list->ExitReason->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillorship_list->RowIndex ?>_ExitReason" name="x<?php echo $councillorship_list->RowIndex ?>_ExitReason"<?php echo $councillorship_list->ExitReason->editAttributes() ?>>
			<?php echo $councillorship_list->ExitReason->selectOptionListHtml("x{$councillorship_list->RowIndex}_ExitReason") ?>
		</select>
</div>
<?php echo $councillorship_list->ExitReason->Lookup->getParamTag($councillorship_list, "p_x" . $councillorship_list->RowIndex . "_ExitReason") ?>
</span>
<input type="hidden" data-table="councillorship" data-field="x_ExitReason" name="o<?php echo $councillorship_list->RowIndex ?>_ExitReason" id="o<?php echo $councillorship_list->RowIndex ?>_ExitReason" value="<?php echo HtmlEncode($councillorship_list->ExitReason->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$councillorship_list->ListOptions->render("body", "right", $councillorship_list->RowIndex);
?>
<script>
loadjs.ready(["fcouncillorshiplist", "load"], function() {
	fcouncillorshiplist.updateLists(<?php echo $councillorship_list->RowIndex ?>);
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
<?php if ($councillorship_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $councillorship_list->FormKeyCountName ?>" id="<?php echo $councillorship_list->FormKeyCountName ?>" value="<?php echo $councillorship_list->KeyCount ?>">
<?php echo $councillorship_list->MultiSelectKey ?>
<?php } ?>
<?php if ($councillorship_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $councillorship_list->FormKeyCountName ?>" id="<?php echo $councillorship_list->FormKeyCountName ?>" value="<?php echo $councillorship_list->KeyCount ?>">
<?php echo $councillorship_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$councillorship->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($councillorship_list->Recordset)
	$councillorship_list->Recordset->Close();
?>
<?php if (!$councillorship_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$councillorship_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillorship_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $councillorship_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($councillorship_list->TotalRecords == 0 && !$councillorship->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $councillorship_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$councillorship_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$councillorship_list->isExport()) { ?>
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
$councillorship_list->terminate();
?>