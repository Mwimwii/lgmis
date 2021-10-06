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
$staffprofbodies_list = new staffprofbodies_list();

// Run the page
$staffprofbodies_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffprofbodies_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$staffprofbodies_list->isExport()) { ?>
<script>
var fstaffprofbodieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstaffprofbodieslist = currentForm = new ew.Form("fstaffprofbodieslist", "list");
	fstaffprofbodieslist.formKeyCountName = '<?php echo $staffprofbodies_list->FormKeyCountName ?>';

	// Validate form
	fstaffprofbodieslist.validate = function() {
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
			<?php if ($staffprofbodies_list->ProfessionalBody->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalBody");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_list->ProfessionalBody->caption(), $staffprofbodies_list->ProfessionalBody->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffprofbodies_list->MembershipNo->Required) { ?>
				elm = this.getElements("x" + infix + "_MembershipNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_list->MembershipNo->caption(), $staffprofbodies_list->MembershipNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffprofbodies_list->DateJoined->Required) { ?>
				elm = this.getElements("x" + infix + "_DateJoined");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_list->DateJoined->caption(), $staffprofbodies_list->DateJoined->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateJoined");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_list->DateJoined->errorMessage()) ?>");
			<?php if ($staffprofbodies_list->DateRenewed->Required) { ?>
				elm = this.getElements("x" + infix + "_DateRenewed");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_list->DateRenewed->caption(), $staffprofbodies_list->DateRenewed->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateRenewed");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_list->DateRenewed->errorMessage()) ?>");
			<?php if ($staffprofbodies_list->ValidTo->Required) { ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_list->ValidTo->caption(), $staffprofbodies_list->ValidTo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ValidTo");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffprofbodies_list->ValidTo->errorMessage()) ?>");
			<?php if ($staffprofbodies_list->MemberStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MemberStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffprofbodies_list->MemberStatus->caption(), $staffprofbodies_list->MemberStatus->RequiredErrorMessage)) ?>");
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
	fstaffprofbodieslist.emptyRow = function(infix) {
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
	fstaffprofbodieslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffprofbodieslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffprofbodieslist.lists["x_ProfessionalBody"] = <?php echo $staffprofbodies_list->ProfessionalBody->Lookup->toClientList($staffprofbodies_list) ?>;
	fstaffprofbodieslist.lists["x_ProfessionalBody"].options = <?php echo JsonEncode($staffprofbodies_list->ProfessionalBody->lookupOptions()) ?>;
	fstaffprofbodieslist.lists["x_MemberStatus"] = <?php echo $staffprofbodies_list->MemberStatus->Lookup->toClientList($staffprofbodies_list) ?>;
	fstaffprofbodieslist.lists["x_MemberStatus"].options = <?php echo JsonEncode($staffprofbodies_list->MemberStatus->lookupOptions()) ?>;
	loadjs.done("fstaffprofbodieslist");
});
var fstaffprofbodieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fstaffprofbodieslistsrch = currentSearchForm = new ew.Form("fstaffprofbodieslistsrch");

	// Dynamic selection lists
	// Filters

	fstaffprofbodieslistsrch.filterList = <?php echo $staffprofbodies_list->getFilterList() ?>;

	// Init search panel as collapsed
	fstaffprofbodieslistsrch.initSearchPanel = true;
	loadjs.done("fstaffprofbodieslistsrch");
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
<?php if (!$staffprofbodies_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($staffprofbodies_list->TotalRecords > 0 && $staffprofbodies_list->ExportOptions->visible()) { ?>
<?php $staffprofbodies_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($staffprofbodies_list->ImportOptions->visible()) { ?>
<?php $staffprofbodies_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($staffprofbodies_list->SearchOptions->visible()) { ?>
<?php $staffprofbodies_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($staffprofbodies_list->FilterOptions->visible()) { ?>
<?php $staffprofbodies_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$staffprofbodies_list->isExport() || Config("EXPORT_MASTER_RECORD") && $staffprofbodies_list->isExport("print")) { ?>
<?php
if ($staffprofbodies_list->DbMasterFilter != "" && $staffprofbodies->getCurrentMasterTable() == "staff") {
	if ($staffprofbodies_list->MasterRecordExists) {
		include_once "staffmaster.php";
	}
}
?>
<?php } ?>
<?php
$staffprofbodies_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$staffprofbodies_list->isExport() && !$staffprofbodies->CurrentAction) { ?>
<form name="fstaffprofbodieslistsrch" id="fstaffprofbodieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fstaffprofbodieslistsrch-search-panel" class="<?php echo $staffprofbodies_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="staffprofbodies">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $staffprofbodies_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($staffprofbodies_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($staffprofbodies_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $staffprofbodies_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($staffprofbodies_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($staffprofbodies_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($staffprofbodies_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($staffprofbodies_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $staffprofbodies_list->showPageHeader(); ?>
<?php
$staffprofbodies_list->showMessage();
?>
<?php if ($staffprofbodies_list->TotalRecords > 0 || $staffprofbodies->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($staffprofbodies_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> staffprofbodies">
<?php if (!$staffprofbodies_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$staffprofbodies_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffprofbodies_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffprofbodies_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstaffprofbodieslist" id="fstaffprofbodieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffprofbodies">
<?php if ($staffprofbodies->getCurrentMasterTable() == "staff" && $staffprofbodies->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffprofbodies_list->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_staffprofbodies" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($staffprofbodies_list->TotalRecords > 0 || $staffprofbodies_list->isGridEdit()) { ?>
<table id="tbl_staffprofbodieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$staffprofbodies->RowType = ROWTYPE_HEADER;

// Render list options
$staffprofbodies_list->renderListOptions();

// Render list options (header, left)
$staffprofbodies_list->ListOptions->render("header", "left");
?>
<?php if ($staffprofbodies_list->ProfessionalBody->Visible) { // ProfessionalBody ?>
	<?php if ($staffprofbodies_list->SortUrl($staffprofbodies_list->ProfessionalBody) == "") { ?>
		<th data-name="ProfessionalBody" class="<?php echo $staffprofbodies_list->ProfessionalBody->headerCellClass() ?>"><div id="elh_staffprofbodies_ProfessionalBody" class="staffprofbodies_ProfessionalBody"><div class="ew-table-header-caption"><?php echo $staffprofbodies_list->ProfessionalBody->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfessionalBody" class="<?php echo $staffprofbodies_list->ProfessionalBody->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffprofbodies_list->SortUrl($staffprofbodies_list->ProfessionalBody) ?>', 1);"><div id="elh_staffprofbodies_ProfessionalBody" class="staffprofbodies_ProfessionalBody">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_list->ProfessionalBody->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_list->ProfessionalBody->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_list->ProfessionalBody->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_list->MembershipNo->Visible) { // MembershipNo ?>
	<?php if ($staffprofbodies_list->SortUrl($staffprofbodies_list->MembershipNo) == "") { ?>
		<th data-name="MembershipNo" class="<?php echo $staffprofbodies_list->MembershipNo->headerCellClass() ?>"><div id="elh_staffprofbodies_MembershipNo" class="staffprofbodies_MembershipNo"><div class="ew-table-header-caption"><?php echo $staffprofbodies_list->MembershipNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MembershipNo" class="<?php echo $staffprofbodies_list->MembershipNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffprofbodies_list->SortUrl($staffprofbodies_list->MembershipNo) ?>', 1);"><div id="elh_staffprofbodies_MembershipNo" class="staffprofbodies_MembershipNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_list->MembershipNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_list->MembershipNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_list->MembershipNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_list->DateJoined->Visible) { // DateJoined ?>
	<?php if ($staffprofbodies_list->SortUrl($staffprofbodies_list->DateJoined) == "") { ?>
		<th data-name="DateJoined" class="<?php echo $staffprofbodies_list->DateJoined->headerCellClass() ?>"><div id="elh_staffprofbodies_DateJoined" class="staffprofbodies_DateJoined"><div class="ew-table-header-caption"><?php echo $staffprofbodies_list->DateJoined->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateJoined" class="<?php echo $staffprofbodies_list->DateJoined->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffprofbodies_list->SortUrl($staffprofbodies_list->DateJoined) ?>', 1);"><div id="elh_staffprofbodies_DateJoined" class="staffprofbodies_DateJoined">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_list->DateJoined->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_list->DateJoined->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_list->DateJoined->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_list->DateRenewed->Visible) { // DateRenewed ?>
	<?php if ($staffprofbodies_list->SortUrl($staffprofbodies_list->DateRenewed) == "") { ?>
		<th data-name="DateRenewed" class="<?php echo $staffprofbodies_list->DateRenewed->headerCellClass() ?>"><div id="elh_staffprofbodies_DateRenewed" class="staffprofbodies_DateRenewed"><div class="ew-table-header-caption"><?php echo $staffprofbodies_list->DateRenewed->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateRenewed" class="<?php echo $staffprofbodies_list->DateRenewed->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffprofbodies_list->SortUrl($staffprofbodies_list->DateRenewed) ?>', 1);"><div id="elh_staffprofbodies_DateRenewed" class="staffprofbodies_DateRenewed">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_list->DateRenewed->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_list->DateRenewed->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_list->DateRenewed->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_list->ValidTo->Visible) { // ValidTo ?>
	<?php if ($staffprofbodies_list->SortUrl($staffprofbodies_list->ValidTo) == "") { ?>
		<th data-name="ValidTo" class="<?php echo $staffprofbodies_list->ValidTo->headerCellClass() ?>"><div id="elh_staffprofbodies_ValidTo" class="staffprofbodies_ValidTo"><div class="ew-table-header-caption"><?php echo $staffprofbodies_list->ValidTo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValidTo" class="<?php echo $staffprofbodies_list->ValidTo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffprofbodies_list->SortUrl($staffprofbodies_list->ValidTo) ?>', 1);"><div id="elh_staffprofbodies_ValidTo" class="staffprofbodies_ValidTo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_list->ValidTo->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_list->ValidTo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_list->ValidTo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($staffprofbodies_list->MemberStatus->Visible) { // MemberStatus ?>
	<?php if ($staffprofbodies_list->SortUrl($staffprofbodies_list->MemberStatus) == "") { ?>
		<th data-name="MemberStatus" class="<?php echo $staffprofbodies_list->MemberStatus->headerCellClass() ?>"><div id="elh_staffprofbodies_MemberStatus" class="staffprofbodies_MemberStatus"><div class="ew-table-header-caption"><?php echo $staffprofbodies_list->MemberStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MemberStatus" class="<?php echo $staffprofbodies_list->MemberStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $staffprofbodies_list->SortUrl($staffprofbodies_list->MemberStatus) ?>', 1);"><div id="elh_staffprofbodies_MemberStatus" class="staffprofbodies_MemberStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $staffprofbodies_list->MemberStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($staffprofbodies_list->MemberStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($staffprofbodies_list->MemberStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$staffprofbodies_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($staffprofbodies_list->ExportAll && $staffprofbodies_list->isExport()) {
	$staffprofbodies_list->StopRecord = $staffprofbodies_list->TotalRecords;
} else {

	// Set the last record to display
	if ($staffprofbodies_list->TotalRecords > $staffprofbodies_list->StartRecord + $staffprofbodies_list->DisplayRecords - 1)
		$staffprofbodies_list->StopRecord = $staffprofbodies_list->StartRecord + $staffprofbodies_list->DisplayRecords - 1;
	else
		$staffprofbodies_list->StopRecord = $staffprofbodies_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($staffprofbodies->isConfirm() || $staffprofbodies_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($staffprofbodies_list->FormKeyCountName) && ($staffprofbodies_list->isGridAdd() || $staffprofbodies_list->isGridEdit() || $staffprofbodies->isConfirm())) {
		$staffprofbodies_list->KeyCount = $CurrentForm->getValue($staffprofbodies_list->FormKeyCountName);
		$staffprofbodies_list->StopRecord = $staffprofbodies_list->StartRecord + $staffprofbodies_list->KeyCount - 1;
	}
}
$staffprofbodies_list->RecordCount = $staffprofbodies_list->StartRecord - 1;
if ($staffprofbodies_list->Recordset && !$staffprofbodies_list->Recordset->EOF) {
	$staffprofbodies_list->Recordset->moveFirst();
	$selectLimit = $staffprofbodies_list->UseSelectLimit;
	if (!$selectLimit && $staffprofbodies_list->StartRecord > 1)
		$staffprofbodies_list->Recordset->move($staffprofbodies_list->StartRecord - 1);
} elseif (!$staffprofbodies->AllowAddDeleteRow && $staffprofbodies_list->StopRecord == 0) {
	$staffprofbodies_list->StopRecord = $staffprofbodies->GridAddRowCount;
}

// Initialize aggregate
$staffprofbodies->RowType = ROWTYPE_AGGREGATEINIT;
$staffprofbodies->resetAttributes();
$staffprofbodies_list->renderRow();
if ($staffprofbodies_list->isGridAdd())
	$staffprofbodies_list->RowIndex = 0;
if ($staffprofbodies_list->isGridEdit())
	$staffprofbodies_list->RowIndex = 0;
while ($staffprofbodies_list->RecordCount < $staffprofbodies_list->StopRecord) {
	$staffprofbodies_list->RecordCount++;
	if ($staffprofbodies_list->RecordCount >= $staffprofbodies_list->StartRecord) {
		$staffprofbodies_list->RowCount++;
		if ($staffprofbodies_list->isGridAdd() || $staffprofbodies_list->isGridEdit() || $staffprofbodies->isConfirm()) {
			$staffprofbodies_list->RowIndex++;
			$CurrentForm->Index = $staffprofbodies_list->RowIndex;
			if ($CurrentForm->hasValue($staffprofbodies_list->FormActionName) && ($staffprofbodies->isConfirm() || $staffprofbodies_list->EventCancelled))
				$staffprofbodies_list->RowAction = strval($CurrentForm->getValue($staffprofbodies_list->FormActionName));
			elseif ($staffprofbodies_list->isGridAdd())
				$staffprofbodies_list->RowAction = "insert";
			else
				$staffprofbodies_list->RowAction = "";
		}

		// Set up key count
		$staffprofbodies_list->KeyCount = $staffprofbodies_list->RowIndex;

		// Init row class and style
		$staffprofbodies->resetAttributes();
		$staffprofbodies->CssClass = "";
		if ($staffprofbodies_list->isGridAdd()) {
			$staffprofbodies_list->loadRowValues(); // Load default values
		} else {
			$staffprofbodies_list->loadRowValues($staffprofbodies_list->Recordset); // Load row values
		}
		$staffprofbodies->RowType = ROWTYPE_VIEW; // Render view
		if ($staffprofbodies_list->isGridAdd()) // Grid add
			$staffprofbodies->RowType = ROWTYPE_ADD; // Render add
		if ($staffprofbodies_list->isGridAdd() && $staffprofbodies->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$staffprofbodies_list->restoreCurrentRowFormValues($staffprofbodies_list->RowIndex); // Restore form values
		if ($staffprofbodies_list->isGridEdit()) { // Grid edit
			if ($staffprofbodies->EventCancelled)
				$staffprofbodies_list->restoreCurrentRowFormValues($staffprofbodies_list->RowIndex); // Restore form values
			if ($staffprofbodies_list->RowAction == "insert")
				$staffprofbodies->RowType = ROWTYPE_ADD; // Render add
			else
				$staffprofbodies->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($staffprofbodies_list->isGridEdit() && ($staffprofbodies->RowType == ROWTYPE_EDIT || $staffprofbodies->RowType == ROWTYPE_ADD) && $staffprofbodies->EventCancelled) // Update failed
			$staffprofbodies_list->restoreCurrentRowFormValues($staffprofbodies_list->RowIndex); // Restore form values
		if ($staffprofbodies->RowType == ROWTYPE_EDIT) // Edit row
			$staffprofbodies_list->EditRowCount++;

		// Set up row id / data-rowindex
		$staffprofbodies->RowAttrs->merge(["data-rowindex" => $staffprofbodies_list->RowCount, "id" => "r" . $staffprofbodies_list->RowCount . "_staffprofbodies", "data-rowtype" => $staffprofbodies->RowType]);

		// Render row
		$staffprofbodies_list->renderRow();

		// Render list options
		$staffprofbodies_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($staffprofbodies_list->RowAction != "delete" && $staffprofbodies_list->RowAction != "insertdelete" && !($staffprofbodies_list->RowAction == "insert" && $staffprofbodies->isConfirm() && $staffprofbodies_list->emptyRow())) {
?>
	<tr <?php echo $staffprofbodies->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffprofbodies_list->ListOptions->render("body", "left", $staffprofbodies_list->RowCount);
?>
	<?php if ($staffprofbodies_list->ProfessionalBody->Visible) { // ProfessionalBody ?>
		<td data-name="ProfessionalBody" <?php echo $staffprofbodies_list->ProfessionalBody->cellAttributes() ?>>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_ProfessionalBody" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody"><?php echo EmptyValue(strval($staffprofbodies_list->ProfessionalBody->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffprofbodies_list->ProfessionalBody->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffprofbodies_list->ProfessionalBody->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffprofbodies_list->ProfessionalBody->ReadOnly || $staffprofbodies_list->ProfessionalBody->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffprofbodies_list->ProfessionalBody->Lookup->getParamTag($staffprofbodies_list, "p_x" . $staffprofbodies_list->RowIndex . "_ProfessionalBody") ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffprofbodies_list->ProfessionalBody->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody" id="x<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody" value="<?php echo $staffprofbodies_list->ProfessionalBody->CurrentValue ?>"<?php echo $staffprofbodies_list->ProfessionalBody->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" name="o<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody" id="o<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody" value="<?php echo HtmlEncode($staffprofbodies_list->ProfessionalBody->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT) { // Edit record ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody"><?php echo EmptyValue(strval($staffprofbodies_list->ProfessionalBody->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffprofbodies_list->ProfessionalBody->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffprofbodies_list->ProfessionalBody->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffprofbodies_list->ProfessionalBody->ReadOnly || $staffprofbodies_list->ProfessionalBody->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffprofbodies_list->ProfessionalBody->Lookup->getParamTag($staffprofbodies_list, "p_x" . $staffprofbodies_list->RowIndex . "_ProfessionalBody") ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffprofbodies_list->ProfessionalBody->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody" id="x<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody" value="<?php echo $staffprofbodies_list->ProfessionalBody->CurrentValue ?>"<?php echo $staffprofbodies_list->ProfessionalBody->editAttributes() ?>>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" name="o<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody" id="o<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody" value="<?php echo HtmlEncode($staffprofbodies_list->ProfessionalBody->OldValue != null ? $staffprofbodies_list->ProfessionalBody->OldValue : $staffprofbodies_list->ProfessionalBody->CurrentValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_ProfessionalBody">
<span<?php echo $staffprofbodies_list->ProfessionalBody->viewAttributes() ?>><?php echo $staffprofbodies_list->ProfessionalBody->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_EmployeeID" name="x<?php echo $staffprofbodies_list->RowIndex ?>_EmployeeID" id="x<?php echo $staffprofbodies_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffprofbodies_list->EmployeeID->CurrentValue) ?>">
<input type="hidden" data-table="staffprofbodies" data-field="x_EmployeeID" name="o<?php echo $staffprofbodies_list->RowIndex ?>_EmployeeID" id="o<?php echo $staffprofbodies_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffprofbodies_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT || $staffprofbodies->CurrentMode == "edit") { ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_EmployeeID" name="x<?php echo $staffprofbodies_list->RowIndex ?>_EmployeeID" id="x<?php echo $staffprofbodies_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($staffprofbodies_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
	<?php if ($staffprofbodies_list->MembershipNo->Visible) { // MembershipNo ?>
		<td data-name="MembershipNo" <?php echo $staffprofbodies_list->MembershipNo->cellAttributes() ?>>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_MembershipNo" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_MembershipNo" name="x<?php echo $staffprofbodies_list->RowIndex ?>_MembershipNo" id="x<?php echo $staffprofbodies_list->RowIndex ?>_MembershipNo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($staffprofbodies_list->MembershipNo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_list->MembershipNo->EditValue ?>"<?php echo $staffprofbodies_list->MembershipNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_MembershipNo" name="o<?php echo $staffprofbodies_list->RowIndex ?>_MembershipNo" id="o<?php echo $staffprofbodies_list->RowIndex ?>_MembershipNo" value="<?php echo HtmlEncode($staffprofbodies_list->MembershipNo->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_MembershipNo" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_MembershipNo" name="x<?php echo $staffprofbodies_list->RowIndex ?>_MembershipNo" id="x<?php echo $staffprofbodies_list->RowIndex ?>_MembershipNo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($staffprofbodies_list->MembershipNo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_list->MembershipNo->EditValue ?>"<?php echo $staffprofbodies_list->MembershipNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_MembershipNo">
<span<?php echo $staffprofbodies_list->MembershipNo->viewAttributes() ?>><?php echo $staffprofbodies_list->MembershipNo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffprofbodies_list->DateJoined->Visible) { // DateJoined ?>
		<td data-name="DateJoined" <?php echo $staffprofbodies_list->DateJoined->cellAttributes() ?>>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_DateJoined" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_DateJoined" name="x<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined" id="x<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined" placeholder="<?php echo HtmlEncode($staffprofbodies_list->DateJoined->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_list->DateJoined->EditValue ?>"<?php echo $staffprofbodies_list->DateJoined->editAttributes() ?>>
<?php if (!$staffprofbodies_list->DateJoined->ReadOnly && !$staffprofbodies_list->DateJoined->Disabled && !isset($staffprofbodies_list->DateJoined->EditAttrs["readonly"]) && !isset($staffprofbodies_list->DateJoined->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodieslist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodieslist", "x<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateJoined" name="o<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined" id="o<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined" value="<?php echo HtmlEncode($staffprofbodies_list->DateJoined->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_DateJoined" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_DateJoined" name="x<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined" id="x<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined" placeholder="<?php echo HtmlEncode($staffprofbodies_list->DateJoined->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_list->DateJoined->EditValue ?>"<?php echo $staffprofbodies_list->DateJoined->editAttributes() ?>>
<?php if (!$staffprofbodies_list->DateJoined->ReadOnly && !$staffprofbodies_list->DateJoined->Disabled && !isset($staffprofbodies_list->DateJoined->EditAttrs["readonly"]) && !isset($staffprofbodies_list->DateJoined->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodieslist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodieslist", "x<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_DateJoined">
<span<?php echo $staffprofbodies_list->DateJoined->viewAttributes() ?>><?php echo $staffprofbodies_list->DateJoined->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffprofbodies_list->DateRenewed->Visible) { // DateRenewed ?>
		<td data-name="DateRenewed" <?php echo $staffprofbodies_list->DateRenewed->cellAttributes() ?>>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_DateRenewed" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_DateRenewed" name="x<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed" id="x<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed" placeholder="<?php echo HtmlEncode($staffprofbodies_list->DateRenewed->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_list->DateRenewed->EditValue ?>"<?php echo $staffprofbodies_list->DateRenewed->editAttributes() ?>>
<?php if (!$staffprofbodies_list->DateRenewed->ReadOnly && !$staffprofbodies_list->DateRenewed->Disabled && !isset($staffprofbodies_list->DateRenewed->EditAttrs["readonly"]) && !isset($staffprofbodies_list->DateRenewed->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodieslist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodieslist", "x<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateRenewed" name="o<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed" id="o<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed" value="<?php echo HtmlEncode($staffprofbodies_list->DateRenewed->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_DateRenewed" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_DateRenewed" name="x<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed" id="x<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed" placeholder="<?php echo HtmlEncode($staffprofbodies_list->DateRenewed->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_list->DateRenewed->EditValue ?>"<?php echo $staffprofbodies_list->DateRenewed->editAttributes() ?>>
<?php if (!$staffprofbodies_list->DateRenewed->ReadOnly && !$staffprofbodies_list->DateRenewed->Disabled && !isset($staffprofbodies_list->DateRenewed->EditAttrs["readonly"]) && !isset($staffprofbodies_list->DateRenewed->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodieslist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodieslist", "x<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_DateRenewed">
<span<?php echo $staffprofbodies_list->DateRenewed->viewAttributes() ?>><?php echo $staffprofbodies_list->DateRenewed->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffprofbodies_list->ValidTo->Visible) { // ValidTo ?>
		<td data-name="ValidTo" <?php echo $staffprofbodies_list->ValidTo->cellAttributes() ?>>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_ValidTo" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_ValidTo" name="x<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo" id="x<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo" placeholder="<?php echo HtmlEncode($staffprofbodies_list->ValidTo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_list->ValidTo->EditValue ?>"<?php echo $staffprofbodies_list->ValidTo->editAttributes() ?>>
<?php if (!$staffprofbodies_list->ValidTo->ReadOnly && !$staffprofbodies_list->ValidTo->Disabled && !isset($staffprofbodies_list->ValidTo->EditAttrs["readonly"]) && !isset($staffprofbodies_list->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodieslist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodieslist", "x<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_ValidTo" name="o<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo" id="o<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($staffprofbodies_list->ValidTo->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_ValidTo" class="form-group">
<input type="text" data-table="staffprofbodies" data-field="x_ValidTo" name="x<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo" id="x<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo" placeholder="<?php echo HtmlEncode($staffprofbodies_list->ValidTo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_list->ValidTo->EditValue ?>"<?php echo $staffprofbodies_list->ValidTo->editAttributes() ?>>
<?php if (!$staffprofbodies_list->ValidTo->ReadOnly && !$staffprofbodies_list->ValidTo->Disabled && !isset($staffprofbodies_list->ValidTo->EditAttrs["readonly"]) && !isset($staffprofbodies_list->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodieslist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodieslist", "x<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_ValidTo">
<span<?php echo $staffprofbodies_list->ValidTo->viewAttributes() ?>><?php echo $staffprofbodies_list->ValidTo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($staffprofbodies_list->MemberStatus->Visible) { // MemberStatus ?>
		<td data-name="MemberStatus" <?php echo $staffprofbodies_list->MemberStatus->cellAttributes() ?>>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_MemberStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffprofbodies" data-field="x_MemberStatus" data-value-separator="<?php echo $staffprofbodies_list->MemberStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffprofbodies_list->RowIndex ?>_MemberStatus" name="x<?php echo $staffprofbodies_list->RowIndex ?>_MemberStatus"<?php echo $staffprofbodies_list->MemberStatus->editAttributes() ?>>
			<?php echo $staffprofbodies_list->MemberStatus->selectOptionListHtml("x{$staffprofbodies_list->RowIndex}_MemberStatus") ?>
		</select>
</div>
<?php echo $staffprofbodies_list->MemberStatus->Lookup->getParamTag($staffprofbodies_list, "p_x" . $staffprofbodies_list->RowIndex . "_MemberStatus") ?>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_MemberStatus" name="o<?php echo $staffprofbodies_list->RowIndex ?>_MemberStatus" id="o<?php echo $staffprofbodies_list->RowIndex ?>_MemberStatus" value="<?php echo HtmlEncode($staffprofbodies_list->MemberStatus->OldValue) ?>">
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_MemberStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffprofbodies" data-field="x_MemberStatus" data-value-separator="<?php echo $staffprofbodies_list->MemberStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffprofbodies_list->RowIndex ?>_MemberStatus" name="x<?php echo $staffprofbodies_list->RowIndex ?>_MemberStatus"<?php echo $staffprofbodies_list->MemberStatus->editAttributes() ?>>
			<?php echo $staffprofbodies_list->MemberStatus->selectOptionListHtml("x{$staffprofbodies_list->RowIndex}_MemberStatus") ?>
		</select>
</div>
<?php echo $staffprofbodies_list->MemberStatus->Lookup->getParamTag($staffprofbodies_list, "p_x" . $staffprofbodies_list->RowIndex . "_MemberStatus") ?>
</span>
<?php } ?>
<?php if ($staffprofbodies->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $staffprofbodies_list->RowCount ?>_staffprofbodies_MemberStatus">
<span<?php echo $staffprofbodies_list->MemberStatus->viewAttributes() ?>><?php echo $staffprofbodies_list->MemberStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffprofbodies_list->ListOptions->render("body", "right", $staffprofbodies_list->RowCount);
?>
	</tr>
<?php if ($staffprofbodies->RowType == ROWTYPE_ADD || $staffprofbodies->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fstaffprofbodieslist", "load"], function() {
	fstaffprofbodieslist.updateLists(<?php echo $staffprofbodies_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$staffprofbodies_list->isGridAdd())
		if (!$staffprofbodies_list->Recordset->EOF)
			$staffprofbodies_list->Recordset->moveNext();
}
?>
<?php
	if ($staffprofbodies_list->isGridAdd() || $staffprofbodies_list->isGridEdit()) {
		$staffprofbodies_list->RowIndex = '$rowindex$';
		$staffprofbodies_list->loadRowValues();

		// Set row properties
		$staffprofbodies->resetAttributes();
		$staffprofbodies->RowAttrs->merge(["data-rowindex" => $staffprofbodies_list->RowIndex, "id" => "r0_staffprofbodies", "data-rowtype" => ROWTYPE_ADD]);
		$staffprofbodies->RowAttrs->appendClass("ew-template");
		$staffprofbodies->RowType = ROWTYPE_ADD;

		// Render row
		$staffprofbodies_list->renderRow();

		// Render list options
		$staffprofbodies_list->renderListOptions();
		$staffprofbodies_list->StartRowCount = 0;
?>
	<tr <?php echo $staffprofbodies->rowAttributes() ?>>
<?php

// Render list options (body, left)
$staffprofbodies_list->ListOptions->render("body", "left", $staffprofbodies_list->RowIndex);
?>
	<?php if ($staffprofbodies_list->ProfessionalBody->Visible) { // ProfessionalBody ?>
		<td data-name="ProfessionalBody">
<span id="el$rowindex$_staffprofbodies_ProfessionalBody" class="form-group staffprofbodies_ProfessionalBody">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody"><?php echo EmptyValue(strval($staffprofbodies_list->ProfessionalBody->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffprofbodies_list->ProfessionalBody->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffprofbodies_list->ProfessionalBody->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffprofbodies_list->ProfessionalBody->ReadOnly || $staffprofbodies_list->ProfessionalBody->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffprofbodies_list->ProfessionalBody->Lookup->getParamTag($staffprofbodies_list, "p_x" . $staffprofbodies_list->RowIndex . "_ProfessionalBody") ?>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffprofbodies_list->ProfessionalBody->displayValueSeparatorAttribute() ?>" name="x<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody" id="x<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody" value="<?php echo $staffprofbodies_list->ProfessionalBody->CurrentValue ?>"<?php echo $staffprofbodies_list->ProfessionalBody->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_ProfessionalBody" name="o<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody" id="o<?php echo $staffprofbodies_list->RowIndex ?>_ProfessionalBody" value="<?php echo HtmlEncode($staffprofbodies_list->ProfessionalBody->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffprofbodies_list->MembershipNo->Visible) { // MembershipNo ?>
		<td data-name="MembershipNo">
<span id="el$rowindex$_staffprofbodies_MembershipNo" class="form-group staffprofbodies_MembershipNo">
<input type="text" data-table="staffprofbodies" data-field="x_MembershipNo" name="x<?php echo $staffprofbodies_list->RowIndex ?>_MembershipNo" id="x<?php echo $staffprofbodies_list->RowIndex ?>_MembershipNo" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($staffprofbodies_list->MembershipNo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_list->MembershipNo->EditValue ?>"<?php echo $staffprofbodies_list->MembershipNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_MembershipNo" name="o<?php echo $staffprofbodies_list->RowIndex ?>_MembershipNo" id="o<?php echo $staffprofbodies_list->RowIndex ?>_MembershipNo" value="<?php echo HtmlEncode($staffprofbodies_list->MembershipNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffprofbodies_list->DateJoined->Visible) { // DateJoined ?>
		<td data-name="DateJoined">
<span id="el$rowindex$_staffprofbodies_DateJoined" class="form-group staffprofbodies_DateJoined">
<input type="text" data-table="staffprofbodies" data-field="x_DateJoined" name="x<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined" id="x<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined" placeholder="<?php echo HtmlEncode($staffprofbodies_list->DateJoined->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_list->DateJoined->EditValue ?>"<?php echo $staffprofbodies_list->DateJoined->editAttributes() ?>>
<?php if (!$staffprofbodies_list->DateJoined->ReadOnly && !$staffprofbodies_list->DateJoined->Disabled && !isset($staffprofbodies_list->DateJoined->EditAttrs["readonly"]) && !isset($staffprofbodies_list->DateJoined->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodieslist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodieslist", "x<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateJoined" name="o<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined" id="o<?php echo $staffprofbodies_list->RowIndex ?>_DateJoined" value="<?php echo HtmlEncode($staffprofbodies_list->DateJoined->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffprofbodies_list->DateRenewed->Visible) { // DateRenewed ?>
		<td data-name="DateRenewed">
<span id="el$rowindex$_staffprofbodies_DateRenewed" class="form-group staffprofbodies_DateRenewed">
<input type="text" data-table="staffprofbodies" data-field="x_DateRenewed" name="x<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed" id="x<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed" placeholder="<?php echo HtmlEncode($staffprofbodies_list->DateRenewed->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_list->DateRenewed->EditValue ?>"<?php echo $staffprofbodies_list->DateRenewed->editAttributes() ?>>
<?php if (!$staffprofbodies_list->DateRenewed->ReadOnly && !$staffprofbodies_list->DateRenewed->Disabled && !isset($staffprofbodies_list->DateRenewed->EditAttrs["readonly"]) && !isset($staffprofbodies_list->DateRenewed->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodieslist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodieslist", "x<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_DateRenewed" name="o<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed" id="o<?php echo $staffprofbodies_list->RowIndex ?>_DateRenewed" value="<?php echo HtmlEncode($staffprofbodies_list->DateRenewed->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffprofbodies_list->ValidTo->Visible) { // ValidTo ?>
		<td data-name="ValidTo">
<span id="el$rowindex$_staffprofbodies_ValidTo" class="form-group staffprofbodies_ValidTo">
<input type="text" data-table="staffprofbodies" data-field="x_ValidTo" name="x<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo" id="x<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo" placeholder="<?php echo HtmlEncode($staffprofbodies_list->ValidTo->getPlaceHolder()) ?>" value="<?php echo $staffprofbodies_list->ValidTo->EditValue ?>"<?php echo $staffprofbodies_list->ValidTo->editAttributes() ?>>
<?php if (!$staffprofbodies_list->ValidTo->ReadOnly && !$staffprofbodies_list->ValidTo->Disabled && !isset($staffprofbodies_list->ValidTo->EditAttrs["readonly"]) && !isset($staffprofbodies_list->ValidTo->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffprofbodieslist", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffprofbodieslist", "x<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_ValidTo" name="o<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo" id="o<?php echo $staffprofbodies_list->RowIndex ?>_ValidTo" value="<?php echo HtmlEncode($staffprofbodies_list->ValidTo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($staffprofbodies_list->MemberStatus->Visible) { // MemberStatus ?>
		<td data-name="MemberStatus">
<span id="el$rowindex$_staffprofbodies_MemberStatus" class="form-group staffprofbodies_MemberStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffprofbodies" data-field="x_MemberStatus" data-value-separator="<?php echo $staffprofbodies_list->MemberStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $staffprofbodies_list->RowIndex ?>_MemberStatus" name="x<?php echo $staffprofbodies_list->RowIndex ?>_MemberStatus"<?php echo $staffprofbodies_list->MemberStatus->editAttributes() ?>>
			<?php echo $staffprofbodies_list->MemberStatus->selectOptionListHtml("x{$staffprofbodies_list->RowIndex}_MemberStatus") ?>
		</select>
</div>
<?php echo $staffprofbodies_list->MemberStatus->Lookup->getParamTag($staffprofbodies_list, "p_x" . $staffprofbodies_list->RowIndex . "_MemberStatus") ?>
</span>
<input type="hidden" data-table="staffprofbodies" data-field="x_MemberStatus" name="o<?php echo $staffprofbodies_list->RowIndex ?>_MemberStatus" id="o<?php echo $staffprofbodies_list->RowIndex ?>_MemberStatus" value="<?php echo HtmlEncode($staffprofbodies_list->MemberStatus->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$staffprofbodies_list->ListOptions->render("body", "right", $staffprofbodies_list->RowIndex);
?>
<script>
loadjs.ready(["fstaffprofbodieslist", "load"], function() {
	fstaffprofbodieslist.updateLists(<?php echo $staffprofbodies_list->RowIndex ?>);
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
<?php if ($staffprofbodies_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $staffprofbodies_list->FormKeyCountName ?>" id="<?php echo $staffprofbodies_list->FormKeyCountName ?>" value="<?php echo $staffprofbodies_list->KeyCount ?>">
<?php echo $staffprofbodies_list->MultiSelectKey ?>
<?php } ?>
<?php if ($staffprofbodies_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $staffprofbodies_list->FormKeyCountName ?>" id="<?php echo $staffprofbodies_list->FormKeyCountName ?>" value="<?php echo $staffprofbodies_list->KeyCount ?>">
<?php echo $staffprofbodies_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$staffprofbodies->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($staffprofbodies_list->Recordset)
	$staffprofbodies_list->Recordset->Close();
?>
<?php if (!$staffprofbodies_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$staffprofbodies_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffprofbodies_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $staffprofbodies_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($staffprofbodies_list->TotalRecords == 0 && !$staffprofbodies->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $staffprofbodies_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$staffprofbodies_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$staffprofbodies_list->isExport()) { ?>
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
$staffprofbodies_list->terminate();
?>