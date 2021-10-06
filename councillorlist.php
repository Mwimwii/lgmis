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
$councillor_list = new councillor_list();

// Run the page
$councillor_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$councillor_list->isExport()) { ?>
<script>
var fcouncillorlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcouncillorlist = currentForm = new ew.Form("fcouncillorlist", "list");
	fcouncillorlist.formKeyCountName = '<?php echo $councillor_list->FormKeyCountName ?>';

	// Validate form
	fcouncillorlist.validate = function() {
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
			<?php if ($councillor_list->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_list->EmployeeID->caption(), $councillor_list->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_list->LACode->caption(), $councillor_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_list->NRC->Required) { ?>
				elm = this.getElements("x" + infix + "_NRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_list->NRC->caption(), $councillor_list->NRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_list->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_list->Sex->caption(), $councillor_list->Sex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_list->Title->Required) { ?>
				elm = this.getElements("x" + infix + "_Title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_list->Title->caption(), $councillor_list->Title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_list->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_list->Surname->caption(), $councillor_list->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_list->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_list->FirstName->caption(), $councillor_list->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_list->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_list->MiddleName->caption(), $councillor_list->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_list->MaritalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MaritalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_list->MaritalStatus->caption(), $councillor_list->MaritalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_list->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_list->DateOfBirth->caption(), $councillor_list->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_list->DateOfBirth->errorMessage()) ?>");
			<?php if ($councillor_list->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_list->Mobile->caption(), $councillor_list->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_list->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_list->_Email->caption(), $councillor_list->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_list->_Email->errorMessage()) ?>");

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
	fcouncillorlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "NRC", false)) return false;
		if (ew.valueChanged(fobj, infix, "Sex", false)) return false;
		if (ew.valueChanged(fobj, infix, "Title", false)) return false;
		if (ew.valueChanged(fobj, infix, "Surname", false)) return false;
		if (ew.valueChanged(fobj, infix, "FirstName", false)) return false;
		if (ew.valueChanged(fobj, infix, "MiddleName", false)) return false;
		if (ew.valueChanged(fobj, infix, "MaritalStatus", false)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfBirth", false)) return false;
		if (ew.valueChanged(fobj, infix, "Mobile", false)) return false;
		if (ew.valueChanged(fobj, infix, "_Email", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fcouncillorlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillorlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncillorlist.lists["x_LACode"] = <?php echo $councillor_list->LACode->Lookup->toClientList($councillor_list) ?>;
	fcouncillorlist.lists["x_LACode"].options = <?php echo JsonEncode($councillor_list->LACode->lookupOptions()) ?>;
	fcouncillorlist.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncillorlist.lists["x_Sex"] = <?php echo $councillor_list->Sex->Lookup->toClientList($councillor_list) ?>;
	fcouncillorlist.lists["x_Sex"].options = <?php echo JsonEncode($councillor_list->Sex->lookupOptions()) ?>;
	fcouncillorlist.lists["x_Title"] = <?php echo $councillor_list->Title->Lookup->toClientList($councillor_list) ?>;
	fcouncillorlist.lists["x_Title"].options = <?php echo JsonEncode($councillor_list->Title->lookupOptions()) ?>;
	fcouncillorlist.lists["x_MaritalStatus"] = <?php echo $councillor_list->MaritalStatus->Lookup->toClientList($councillor_list) ?>;
	fcouncillorlist.lists["x_MaritalStatus"].options = <?php echo JsonEncode($councillor_list->MaritalStatus->lookupOptions()) ?>;
	loadjs.done("fcouncillorlist");
});
var fcouncillorlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcouncillorlistsrch = currentSearchForm = new ew.Form("fcouncillorlistsrch");

	// Dynamic selection lists
	// Filters

	fcouncillorlistsrch.filterList = <?php echo $councillor_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcouncillorlistsrch.initSearchPanel = true;
	loadjs.done("fcouncillorlistsrch");
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
<?php if (!$councillor_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($councillor_list->TotalRecords > 0 && $councillor_list->ExportOptions->visible()) { ?>
<?php $councillor_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($councillor_list->ImportOptions->visible()) { ?>
<?php $councillor_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($councillor_list->SearchOptions->visible()) { ?>
<?php $councillor_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($councillor_list->FilterOptions->visible()) { ?>
<?php $councillor_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$councillor_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$councillor_list->isExport() && !$councillor->CurrentAction) { ?>
<form name="fcouncillorlistsrch" id="fcouncillorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcouncillorlistsrch-search-panel" class="<?php echo $councillor_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="councillor">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $councillor_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($councillor_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($councillor_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $councillor_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($councillor_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($councillor_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($councillor_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($councillor_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $councillor_list->showPageHeader(); ?>
<?php
$councillor_list->showMessage();
?>
<?php if ($councillor_list->TotalRecords > 0 || $councillor->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($councillor_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> councillor">
<?php if (!$councillor_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$councillor_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillor_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $councillor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcouncillorlist" id="fcouncillorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor">
<div id="gmp_councillor" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($councillor_list->TotalRecords > 0 || $councillor_list->isGridEdit()) { ?>
<table id="tbl_councillorlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$councillor->RowType = ROWTYPE_HEADER;

// Render list options
$councillor_list->renderListOptions();

// Render list options (header, left)
$councillor_list->ListOptions->render("header", "left");
?>
<?php if ($councillor_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($councillor_list->SortUrl($councillor_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $councillor_list->EmployeeID->headerCellClass() ?>"><div id="elh_councillor_EmployeeID" class="councillor_EmployeeID"><div class="ew-table-header-caption"><?php echo $councillor_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $councillor_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_list->SortUrl($councillor_list->EmployeeID) ?>', 1);"><div id="elh_councillor_EmployeeID" class="councillor_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_list->LACode->Visible) { // LACode ?>
	<?php if ($councillor_list->SortUrl($councillor_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $councillor_list->LACode->headerCellClass() ?>"><div id="elh_councillor_LACode" class="councillor_LACode"><div class="ew-table-header-caption"><?php echo $councillor_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $councillor_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_list->SortUrl($councillor_list->LACode) ?>', 1);"><div id="elh_councillor_LACode" class="councillor_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($councillor_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_list->NRC->Visible) { // NRC ?>
	<?php if ($councillor_list->SortUrl($councillor_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $councillor_list->NRC->headerCellClass() ?>"><div id="elh_councillor_NRC" class="councillor_NRC"><div class="ew-table-header-caption"><?php echo $councillor_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $councillor_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_list->SortUrl($councillor_list->NRC) ?>', 1);"><div id="elh_councillor_NRC" class="councillor_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($councillor_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_list->Sex->Visible) { // Sex ?>
	<?php if ($councillor_list->SortUrl($councillor_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $councillor_list->Sex->headerCellClass() ?>"><div id="elh_councillor_Sex" class="councillor_Sex"><div class="ew-table-header-caption"><?php echo $councillor_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $councillor_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_list->SortUrl($councillor_list->Sex) ?>', 1);"><div id="elh_councillor_Sex" class="councillor_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_list->Sex->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_list->Title->Visible) { // Title ?>
	<?php if ($councillor_list->SortUrl($councillor_list->Title) == "") { ?>
		<th data-name="Title" class="<?php echo $councillor_list->Title->headerCellClass() ?>"><div id="elh_councillor_Title" class="councillor_Title"><div class="ew-table-header-caption"><?php echo $councillor_list->Title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Title" class="<?php echo $councillor_list->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_list->SortUrl($councillor_list->Title) ?>', 1);"><div id="elh_councillor_Title" class="councillor_Title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_list->Title->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_list->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_list->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_list->Surname->Visible) { // Surname ?>
	<?php if ($councillor_list->SortUrl($councillor_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $councillor_list->Surname->headerCellClass() ?>"><div id="elh_councillor_Surname" class="councillor_Surname"><div class="ew-table-header-caption"><?php echo $councillor_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $councillor_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_list->SortUrl($councillor_list->Surname) ?>', 1);"><div id="elh_councillor_Surname" class="councillor_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($councillor_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_list->FirstName->Visible) { // FirstName ?>
	<?php if ($councillor_list->SortUrl($councillor_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $councillor_list->FirstName->headerCellClass() ?>"><div id="elh_councillor_FirstName" class="councillor_FirstName"><div class="ew-table-header-caption"><?php echo $councillor_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $councillor_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_list->SortUrl($councillor_list->FirstName) ?>', 1);"><div id="elh_councillor_FirstName" class="councillor_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($councillor_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($councillor_list->SortUrl($councillor_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $councillor_list->MiddleName->headerCellClass() ?>"><div id="elh_councillor_MiddleName" class="councillor_MiddleName"><div class="ew-table-header-caption"><?php echo $councillor_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $councillor_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_list->SortUrl($councillor_list->MiddleName) ?>', 1);"><div id="elh_councillor_MiddleName" class="councillor_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($councillor_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_list->MaritalStatus->Visible) { // MaritalStatus ?>
	<?php if ($councillor_list->SortUrl($councillor_list->MaritalStatus) == "") { ?>
		<th data-name="MaritalStatus" class="<?php echo $councillor_list->MaritalStatus->headerCellClass() ?>"><div id="elh_councillor_MaritalStatus" class="councillor_MaritalStatus"><div class="ew-table-header-caption"><?php echo $councillor_list->MaritalStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaritalStatus" class="<?php echo $councillor_list->MaritalStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_list->SortUrl($councillor_list->MaritalStatus) ?>', 1);"><div id="elh_councillor_MaritalStatus" class="councillor_MaritalStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_list->MaritalStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_list->MaritalStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_list->MaritalStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_list->DateOfBirth->Visible) { // DateOfBirth ?>
	<?php if ($councillor_list->SortUrl($councillor_list->DateOfBirth) == "") { ?>
		<th data-name="DateOfBirth" class="<?php echo $councillor_list->DateOfBirth->headerCellClass() ?>"><div id="elh_councillor_DateOfBirth" class="councillor_DateOfBirth"><div class="ew-table-header-caption"><?php echo $councillor_list->DateOfBirth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfBirth" class="<?php echo $councillor_list->DateOfBirth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_list->SortUrl($councillor_list->DateOfBirth) ?>', 1);"><div id="elh_councillor_DateOfBirth" class="councillor_DateOfBirth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_list->DateOfBirth->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_list->DateOfBirth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_list->DateOfBirth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_list->Mobile->Visible) { // Mobile ?>
	<?php if ($councillor_list->SortUrl($councillor_list->Mobile) == "") { ?>
		<th data-name="Mobile" class="<?php echo $councillor_list->Mobile->headerCellClass() ?>"><div id="elh_councillor_Mobile" class="councillor_Mobile"><div class="ew-table-header-caption"><?php echo $councillor_list->Mobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Mobile" class="<?php echo $councillor_list->Mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_list->SortUrl($councillor_list->Mobile) ?>', 1);"><div id="elh_councillor_Mobile" class="councillor_Mobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_list->Mobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($councillor_list->Mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_list->Mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_list->_Email->Visible) { // Email ?>
	<?php if ($councillor_list->SortUrl($councillor_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $councillor_list->_Email->headerCellClass() ?>"><div id="elh_councillor__Email" class="councillor__Email"><div class="ew-table-header-caption"><?php echo $councillor_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $councillor_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_list->SortUrl($councillor_list->_Email) ?>', 1);"><div id="elh_councillor__Email" class="councillor__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($councillor_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$councillor_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($councillor_list->ExportAll && $councillor_list->isExport()) {
	$councillor_list->StopRecord = $councillor_list->TotalRecords;
} else {

	// Set the last record to display
	if ($councillor_list->TotalRecords > $councillor_list->StartRecord + $councillor_list->DisplayRecords - 1)
		$councillor_list->StopRecord = $councillor_list->StartRecord + $councillor_list->DisplayRecords - 1;
	else
		$councillor_list->StopRecord = $councillor_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($councillor->isConfirm() || $councillor_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($councillor_list->FormKeyCountName) && ($councillor_list->isGridAdd() || $councillor_list->isGridEdit() || $councillor->isConfirm())) {
		$councillor_list->KeyCount = $CurrentForm->getValue($councillor_list->FormKeyCountName);
		$councillor_list->StopRecord = $councillor_list->StartRecord + $councillor_list->KeyCount - 1;
	}
}
$councillor_list->RecordCount = $councillor_list->StartRecord - 1;
if ($councillor_list->Recordset && !$councillor_list->Recordset->EOF) {
	$councillor_list->Recordset->moveFirst();
	$selectLimit = $councillor_list->UseSelectLimit;
	if (!$selectLimit && $councillor_list->StartRecord > 1)
		$councillor_list->Recordset->move($councillor_list->StartRecord - 1);
} elseif (!$councillor->AllowAddDeleteRow && $councillor_list->StopRecord == 0) {
	$councillor_list->StopRecord = $councillor->GridAddRowCount;
}

// Initialize aggregate
$councillor->RowType = ROWTYPE_AGGREGATEINIT;
$councillor->resetAttributes();
$councillor_list->renderRow();
if ($councillor_list->isGridAdd())
	$councillor_list->RowIndex = 0;
if ($councillor_list->isGridEdit())
	$councillor_list->RowIndex = 0;
while ($councillor_list->RecordCount < $councillor_list->StopRecord) {
	$councillor_list->RecordCount++;
	if ($councillor_list->RecordCount >= $councillor_list->StartRecord) {
		$councillor_list->RowCount++;
		if ($councillor_list->isGridAdd() || $councillor_list->isGridEdit() || $councillor->isConfirm()) {
			$councillor_list->RowIndex++;
			$CurrentForm->Index = $councillor_list->RowIndex;
			if ($CurrentForm->hasValue($councillor_list->FormActionName) && ($councillor->isConfirm() || $councillor_list->EventCancelled))
				$councillor_list->RowAction = strval($CurrentForm->getValue($councillor_list->FormActionName));
			elseif ($councillor_list->isGridAdd())
				$councillor_list->RowAction = "insert";
			else
				$councillor_list->RowAction = "";
		}

		// Set up key count
		$councillor_list->KeyCount = $councillor_list->RowIndex;

		// Init row class and style
		$councillor->resetAttributes();
		$councillor->CssClass = "";
		if ($councillor_list->isGridAdd()) {
			$councillor_list->loadRowValues(); // Load default values
		} else {
			$councillor_list->loadRowValues($councillor_list->Recordset); // Load row values
		}
		$councillor->RowType = ROWTYPE_VIEW; // Render view
		if ($councillor_list->isGridAdd()) // Grid add
			$councillor->RowType = ROWTYPE_ADD; // Render add
		if ($councillor_list->isGridAdd() && $councillor->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$councillor_list->restoreCurrentRowFormValues($councillor_list->RowIndex); // Restore form values
		if ($councillor_list->isGridEdit()) { // Grid edit
			if ($councillor->EventCancelled)
				$councillor_list->restoreCurrentRowFormValues($councillor_list->RowIndex); // Restore form values
			if ($councillor_list->RowAction == "insert")
				$councillor->RowType = ROWTYPE_ADD; // Render add
			else
				$councillor->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($councillor_list->isGridEdit() && ($councillor->RowType == ROWTYPE_EDIT || $councillor->RowType == ROWTYPE_ADD) && $councillor->EventCancelled) // Update failed
			$councillor_list->restoreCurrentRowFormValues($councillor_list->RowIndex); // Restore form values
		if ($councillor->RowType == ROWTYPE_EDIT) // Edit row
			$councillor_list->EditRowCount++;

		// Set up row id / data-rowindex
		$councillor->RowAttrs->merge(["data-rowindex" => $councillor_list->RowCount, "id" => "r" . $councillor_list->RowCount . "_councillor", "data-rowtype" => $councillor->RowType]);

		// Render row
		$councillor_list->renderRow();

		// Render list options
		$councillor_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($councillor_list->RowAction != "delete" && $councillor_list->RowAction != "insertdelete" && !($councillor_list->RowAction == "insert" && $councillor->isConfirm() && $councillor_list->emptyRow())) {
?>
	<tr <?php echo $councillor->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillor_list->ListOptions->render("body", "left", $councillor_list->RowCount);
?>
	<?php if ($councillor_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $councillor_list->EmployeeID->cellAttributes() ?>>
<?php if ($councillor->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_EmployeeID" class="form-group"></span>
<input type="hidden" data-table="councillor" data-field="x_EmployeeID" name="o<?php echo $councillor_list->RowIndex ?>_EmployeeID" id="o<?php echo $councillor_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_EmployeeID" class="form-group">
<span<?php echo $councillor_list->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillor_list->EmployeeID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillor" data-field="x_EmployeeID" name="x<?php echo $councillor_list->RowIndex ?>_EmployeeID" id="x<?php echo $councillor_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_list->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_EmployeeID">
<span<?php echo $councillor_list->EmployeeID->viewAttributes() ?>><?php echo $councillor_list->EmployeeID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $councillor_list->LACode->cellAttributes() ?>>
<?php if ($councillor->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_LACode" class="form-group">
<?php
$onchange = $councillor_list->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillor_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $councillor_list->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $councillor_list->RowIndex ?>_LACode" id="sv_x<?php echo $councillor_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($councillor_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillor_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillor_list->LACode->getPlaceHolder()) ?>"<?php echo $councillor_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_LACode" data-value-separator="<?php echo $councillor_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $councillor_list->RowIndex ?>_LACode" id="x<?php echo $councillor_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillor_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorlist"], function() {
	fcouncillorlist.createAutoSuggest({"id":"x<?php echo $councillor_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $councillor_list->LACode->Lookup->getParamTag($councillor_list, "p_x" . $councillor_list->RowIndex . "_LACode") ?>
</span>
<input type="hidden" data-table="councillor" data-field="x_LACode" name="o<?php echo $councillor_list->RowIndex ?>_LACode" id="o<?php echo $councillor_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillor_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_LACode" class="form-group">
<?php
$onchange = $councillor_list->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillor_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $councillor_list->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $councillor_list->RowIndex ?>_LACode" id="sv_x<?php echo $councillor_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($councillor_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillor_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillor_list->LACode->getPlaceHolder()) ?>"<?php echo $councillor_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_LACode" data-value-separator="<?php echo $councillor_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $councillor_list->RowIndex ?>_LACode" id="x<?php echo $councillor_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillor_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorlist"], function() {
	fcouncillorlist.createAutoSuggest({"id":"x<?php echo $councillor_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $councillor_list->LACode->Lookup->getParamTag($councillor_list, "p_x" . $councillor_list->RowIndex . "_LACode") ?>
</span>
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_LACode">
<span<?php echo $councillor_list->LACode->viewAttributes() ?>><?php echo $councillor_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $councillor_list->NRC->cellAttributes() ?>>
<?php if ($councillor->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_NRC" class="form-group">
<input type="text" data-table="councillor" data-field="x_NRC" name="x<?php echo $councillor_list->RowIndex ?>_NRC" id="x<?php echo $councillor_list->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($councillor_list->NRC->getPlaceHolder()) ?>" value="<?php echo $councillor_list->NRC->EditValue ?>"<?php echo $councillor_list->NRC->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_NRC" name="o<?php echo $councillor_list->RowIndex ?>_NRC" id="o<?php echo $councillor_list->RowIndex ?>_NRC" value="<?php echo HtmlEncode($councillor_list->NRC->OldValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_NRC" class="form-group">
<input type="text" data-table="councillor" data-field="x_NRC" name="x<?php echo $councillor_list->RowIndex ?>_NRC" id="x<?php echo $councillor_list->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($councillor_list->NRC->getPlaceHolder()) ?>" value="<?php echo $councillor_list->NRC->EditValue ?>"<?php echo $councillor_list->NRC->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_NRC">
<span<?php echo $councillor_list->NRC->viewAttributes() ?>><?php echo $councillor_list->NRC->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $councillor_list->Sex->cellAttributes() ?>>
<?php if ($councillor->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_Sex" class="form-group">
<?php $councillor_list->Sex->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_Sex" data-value-separator="<?php echo $councillor_list->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillor_list->RowIndex ?>_Sex" name="x<?php echo $councillor_list->RowIndex ?>_Sex"<?php echo $councillor_list->Sex->editAttributes() ?>>
			<?php echo $councillor_list->Sex->selectOptionListHtml("x{$councillor_list->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $councillor_list->Sex->Lookup->getParamTag($councillor_list, "p_x" . $councillor_list->RowIndex . "_Sex") ?>
</span>
<input type="hidden" data-table="councillor" data-field="x_Sex" name="o<?php echo $councillor_list->RowIndex ?>_Sex" id="o<?php echo $councillor_list->RowIndex ?>_Sex" value="<?php echo HtmlEncode($councillor_list->Sex->OldValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_Sex" class="form-group">
<?php $councillor_list->Sex->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_Sex" data-value-separator="<?php echo $councillor_list->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillor_list->RowIndex ?>_Sex" name="x<?php echo $councillor_list->RowIndex ?>_Sex"<?php echo $councillor_list->Sex->editAttributes() ?>>
			<?php echo $councillor_list->Sex->selectOptionListHtml("x{$councillor_list->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $councillor_list->Sex->Lookup->getParamTag($councillor_list, "p_x" . $councillor_list->RowIndex . "_Sex") ?>
</span>
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_Sex">
<span<?php echo $councillor_list->Sex->viewAttributes() ?>><?php echo $councillor_list->Sex->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_list->Title->Visible) { // Title ?>
		<td data-name="Title" <?php echo $councillor_list->Title->cellAttributes() ?>>
<?php if ($councillor->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_Title" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_Title" data-value-separator="<?php echo $councillor_list->Title->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillor_list->RowIndex ?>_Title" name="x<?php echo $councillor_list->RowIndex ?>_Title"<?php echo $councillor_list->Title->editAttributes() ?>>
			<?php echo $councillor_list->Title->selectOptionListHtml("x{$councillor_list->RowIndex}_Title") ?>
		</select>
</div>
<?php echo $councillor_list->Title->Lookup->getParamTag($councillor_list, "p_x" . $councillor_list->RowIndex . "_Title") ?>
</span>
<input type="hidden" data-table="councillor" data-field="x_Title" name="o<?php echo $councillor_list->RowIndex ?>_Title" id="o<?php echo $councillor_list->RowIndex ?>_Title" value="<?php echo HtmlEncode($councillor_list->Title->OldValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_Title" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_Title" data-value-separator="<?php echo $councillor_list->Title->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillor_list->RowIndex ?>_Title" name="x<?php echo $councillor_list->RowIndex ?>_Title"<?php echo $councillor_list->Title->editAttributes() ?>>
			<?php echo $councillor_list->Title->selectOptionListHtml("x{$councillor_list->RowIndex}_Title") ?>
		</select>
</div>
<?php echo $councillor_list->Title->Lookup->getParamTag($councillor_list, "p_x" . $councillor_list->RowIndex . "_Title") ?>
</span>
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_Title">
<span<?php echo $councillor_list->Title->viewAttributes() ?>><?php echo $councillor_list->Title->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $councillor_list->Surname->cellAttributes() ?>>
<?php if ($councillor->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_Surname" class="form-group">
<input type="text" data-table="councillor" data-field="x_Surname" name="x<?php echo $councillor_list->RowIndex ?>_Surname" id="x<?php echo $councillor_list->RowIndex ?>_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_list->Surname->getPlaceHolder()) ?>" value="<?php echo $councillor_list->Surname->EditValue ?>"<?php echo $councillor_list->Surname->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_Surname" name="o<?php echo $councillor_list->RowIndex ?>_Surname" id="o<?php echo $councillor_list->RowIndex ?>_Surname" value="<?php echo HtmlEncode($councillor_list->Surname->OldValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_Surname" class="form-group">
<input type="text" data-table="councillor" data-field="x_Surname" name="x<?php echo $councillor_list->RowIndex ?>_Surname" id="x<?php echo $councillor_list->RowIndex ?>_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_list->Surname->getPlaceHolder()) ?>" value="<?php echo $councillor_list->Surname->EditValue ?>"<?php echo $councillor_list->Surname->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_Surname">
<span<?php echo $councillor_list->Surname->viewAttributes() ?>><?php echo $councillor_list->Surname->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $councillor_list->FirstName->cellAttributes() ?>>
<?php if ($councillor->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_FirstName" class="form-group">
<input type="text" data-table="councillor" data-field="x_FirstName" name="x<?php echo $councillor_list->RowIndex ?>_FirstName" id="x<?php echo $councillor_list->RowIndex ?>_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $councillor_list->FirstName->EditValue ?>"<?php echo $councillor_list->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_FirstName" name="o<?php echo $councillor_list->RowIndex ?>_FirstName" id="o<?php echo $councillor_list->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($councillor_list->FirstName->OldValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_FirstName" class="form-group">
<input type="text" data-table="councillor" data-field="x_FirstName" name="x<?php echo $councillor_list->RowIndex ?>_FirstName" id="x<?php echo $councillor_list->RowIndex ?>_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $councillor_list->FirstName->EditValue ?>"<?php echo $councillor_list->FirstName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_FirstName">
<span<?php echo $councillor_list->FirstName->viewAttributes() ?>><?php echo $councillor_list->FirstName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $councillor_list->MiddleName->cellAttributes() ?>>
<?php if ($councillor->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_MiddleName" class="form-group">
<input type="text" data-table="councillor" data-field="x_MiddleName" name="x<?php echo $councillor_list->RowIndex ?>_MiddleName" id="x<?php echo $councillor_list->RowIndex ?>_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_list->MiddleName->getPlaceHolder()) ?>" value="<?php echo $councillor_list->MiddleName->EditValue ?>"<?php echo $councillor_list->MiddleName->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_MiddleName" name="o<?php echo $councillor_list->RowIndex ?>_MiddleName" id="o<?php echo $councillor_list->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($councillor_list->MiddleName->OldValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_MiddleName" class="form-group">
<input type="text" data-table="councillor" data-field="x_MiddleName" name="x<?php echo $councillor_list->RowIndex ?>_MiddleName" id="x<?php echo $councillor_list->RowIndex ?>_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_list->MiddleName->getPlaceHolder()) ?>" value="<?php echo $councillor_list->MiddleName->EditValue ?>"<?php echo $councillor_list->MiddleName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_MiddleName">
<span<?php echo $councillor_list->MiddleName->viewAttributes() ?>><?php echo $councillor_list->MiddleName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_list->MaritalStatus->Visible) { // MaritalStatus ?>
		<td data-name="MaritalStatus" <?php echo $councillor_list->MaritalStatus->cellAttributes() ?>>
<?php if ($councillor->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_MaritalStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_MaritalStatus" data-value-separator="<?php echo $councillor_list->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillor_list->RowIndex ?>_MaritalStatus" name="x<?php echo $councillor_list->RowIndex ?>_MaritalStatus"<?php echo $councillor_list->MaritalStatus->editAttributes() ?>>
			<?php echo $councillor_list->MaritalStatus->selectOptionListHtml("x{$councillor_list->RowIndex}_MaritalStatus") ?>
		</select>
</div>
<?php echo $councillor_list->MaritalStatus->Lookup->getParamTag($councillor_list, "p_x" . $councillor_list->RowIndex . "_MaritalStatus") ?>
</span>
<input type="hidden" data-table="councillor" data-field="x_MaritalStatus" name="o<?php echo $councillor_list->RowIndex ?>_MaritalStatus" id="o<?php echo $councillor_list->RowIndex ?>_MaritalStatus" value="<?php echo HtmlEncode($councillor_list->MaritalStatus->OldValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_MaritalStatus" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_MaritalStatus" data-value-separator="<?php echo $councillor_list->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillor_list->RowIndex ?>_MaritalStatus" name="x<?php echo $councillor_list->RowIndex ?>_MaritalStatus"<?php echo $councillor_list->MaritalStatus->editAttributes() ?>>
			<?php echo $councillor_list->MaritalStatus->selectOptionListHtml("x{$councillor_list->RowIndex}_MaritalStatus") ?>
		</select>
</div>
<?php echo $councillor_list->MaritalStatus->Lookup->getParamTag($councillor_list, "p_x" . $councillor_list->RowIndex . "_MaritalStatus") ?>
</span>
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_MaritalStatus">
<span<?php echo $councillor_list->MaritalStatus->viewAttributes() ?>><?php echo $councillor_list->MaritalStatus->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth" <?php echo $councillor_list->DateOfBirth->cellAttributes() ?>>
<?php if ($councillor->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_DateOfBirth" class="form-group">
<input type="text" data-table="councillor" data-field="x_DateOfBirth" name="x<?php echo $councillor_list->RowIndex ?>_DateOfBirth" id="x<?php echo $councillor_list->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($councillor_list->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $councillor_list->DateOfBirth->EditValue ?>"<?php echo $councillor_list->DateOfBirth->editAttributes() ?>>
<?php if (!$councillor_list->DateOfBirth->ReadOnly && !$councillor_list->DateOfBirth->Disabled && !isset($councillor_list->DateOfBirth->EditAttrs["readonly"]) && !isset($councillor_list->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncillorlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncillorlist", "x<?php echo $councillor_list->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="councillor" data-field="x_DateOfBirth" name="o<?php echo $councillor_list->RowIndex ?>_DateOfBirth" id="o<?php echo $councillor_list->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($councillor_list->DateOfBirth->OldValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_DateOfBirth" class="form-group">
<input type="text" data-table="councillor" data-field="x_DateOfBirth" name="x<?php echo $councillor_list->RowIndex ?>_DateOfBirth" id="x<?php echo $councillor_list->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($councillor_list->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $councillor_list->DateOfBirth->EditValue ?>"<?php echo $councillor_list->DateOfBirth->editAttributes() ?>>
<?php if (!$councillor_list->DateOfBirth->ReadOnly && !$councillor_list->DateOfBirth->Disabled && !isset($councillor_list->DateOfBirth->EditAttrs["readonly"]) && !isset($councillor_list->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncillorlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncillorlist", "x<?php echo $councillor_list->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_DateOfBirth">
<span<?php echo $councillor_list->DateOfBirth->viewAttributes() ?>><?php echo $councillor_list->DateOfBirth->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile" <?php echo $councillor_list->Mobile->cellAttributes() ?>>
<?php if ($councillor->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_Mobile" class="form-group">
<input type="text" data-table="councillor" data-field="x_Mobile" name="x<?php echo $councillor_list->RowIndex ?>_Mobile" id="x<?php echo $councillor_list->RowIndex ?>_Mobile" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_list->Mobile->getPlaceHolder()) ?>" value="<?php echo $councillor_list->Mobile->EditValue ?>"<?php echo $councillor_list->Mobile->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_Mobile" name="o<?php echo $councillor_list->RowIndex ?>_Mobile" id="o<?php echo $councillor_list->RowIndex ?>_Mobile" value="<?php echo HtmlEncode($councillor_list->Mobile->OldValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_Mobile" class="form-group">
<input type="text" data-table="councillor" data-field="x_Mobile" name="x<?php echo $councillor_list->RowIndex ?>_Mobile" id="x<?php echo $councillor_list->RowIndex ?>_Mobile" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_list->Mobile->getPlaceHolder()) ?>" value="<?php echo $councillor_list->Mobile->EditValue ?>"<?php echo $councillor_list->Mobile->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor_Mobile">
<span<?php echo $councillor_list->Mobile->viewAttributes() ?>><?php echo $councillor_list->Mobile->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($councillor_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $councillor_list->_Email->cellAttributes() ?>>
<?php if ($councillor->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor__Email" class="form-group">
<input type="text" data-table="councillor" data-field="x__Email" name="x<?php echo $councillor_list->RowIndex ?>__Email" id="x<?php echo $councillor_list->RowIndex ?>__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_list->_Email->getPlaceHolder()) ?>" value="<?php echo $councillor_list->_Email->EditValue ?>"<?php echo $councillor_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x__Email" name="o<?php echo $councillor_list->RowIndex ?>__Email" id="o<?php echo $councillor_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($councillor_list->_Email->OldValue) ?>">
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor__Email" class="form-group">
<input type="text" data-table="councillor" data-field="x__Email" name="x<?php echo $councillor_list->RowIndex ?>__Email" id="x<?php echo $councillor_list->RowIndex ?>__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_list->_Email->getPlaceHolder()) ?>" value="<?php echo $councillor_list->_Email->EditValue ?>"<?php echo $councillor_list->_Email->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($councillor->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $councillor_list->RowCount ?>_councillor__Email">
<span<?php echo $councillor_list->_Email->viewAttributes() ?>><?php echo $councillor_list->_Email->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$councillor_list->ListOptions->render("body", "right", $councillor_list->RowCount);
?>
	</tr>
<?php if ($councillor->RowType == ROWTYPE_ADD || $councillor->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fcouncillorlist", "load"], function() {
	fcouncillorlist.updateLists(<?php echo $councillor_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$councillor_list->isGridAdd())
		if (!$councillor_list->Recordset->EOF)
			$councillor_list->Recordset->moveNext();
}
?>
<?php
	if ($councillor_list->isGridAdd() || $councillor_list->isGridEdit()) {
		$councillor_list->RowIndex = '$rowindex$';
		$councillor_list->loadRowValues();

		// Set row properties
		$councillor->resetAttributes();
		$councillor->RowAttrs->merge(["data-rowindex" => $councillor_list->RowIndex, "id" => "r0_councillor", "data-rowtype" => ROWTYPE_ADD]);
		$councillor->RowAttrs->appendClass("ew-template");
		$councillor->RowType = ROWTYPE_ADD;

		// Render row
		$councillor_list->renderRow();

		// Render list options
		$councillor_list->renderListOptions();
		$councillor_list->StartRowCount = 0;
?>
	<tr <?php echo $councillor->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillor_list->ListOptions->render("body", "left", $councillor_list->RowIndex);
?>
	<?php if ($councillor_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<span id="el$rowindex$_councillor_EmployeeID" class="form-group councillor_EmployeeID"></span>
<input type="hidden" data-table="councillor" data-field="x_EmployeeID" name="o<?php echo $councillor_list->RowIndex ?>_EmployeeID" id="o<?php echo $councillor_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($councillor_list->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<span id="el$rowindex$_councillor_LACode" class="form-group councillor_LACode">
<?php
$onchange = $councillor_list->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillor_list->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $councillor_list->RowIndex ?>_LACode">
	<input type="text" class="form-control" name="sv_x<?php echo $councillor_list->RowIndex ?>_LACode" id="sv_x<?php echo $councillor_list->RowIndex ?>_LACode" value="<?php echo RemoveHtml($councillor_list->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillor_list->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillor_list->LACode->getPlaceHolder()) ?>"<?php echo $councillor_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_LACode" data-value-separator="<?php echo $councillor_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $councillor_list->RowIndex ?>_LACode" id="x<?php echo $councillor_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillor_list->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncillorlist"], function() {
	fcouncillorlist.createAutoSuggest({"id":"x<?php echo $councillor_list->RowIndex ?>_LACode","forceSelect":false});
});
</script>
<?php echo $councillor_list->LACode->Lookup->getParamTag($councillor_list, "p_x" . $councillor_list->RowIndex . "_LACode") ?>
</span>
<input type="hidden" data-table="councillor" data-field="x_LACode" name="o<?php echo $councillor_list->RowIndex ?>_LACode" id="o<?php echo $councillor_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($councillor_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC">
<span id="el$rowindex$_councillor_NRC" class="form-group councillor_NRC">
<input type="text" data-table="councillor" data-field="x_NRC" name="x<?php echo $councillor_list->RowIndex ?>_NRC" id="x<?php echo $councillor_list->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($councillor_list->NRC->getPlaceHolder()) ?>" value="<?php echo $councillor_list->NRC->EditValue ?>"<?php echo $councillor_list->NRC->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_NRC" name="o<?php echo $councillor_list->RowIndex ?>_NRC" id="o<?php echo $councillor_list->RowIndex ?>_NRC" value="<?php echo HtmlEncode($councillor_list->NRC->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex">
<span id="el$rowindex$_councillor_Sex" class="form-group councillor_Sex">
<?php $councillor_list->Sex->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_Sex" data-value-separator="<?php echo $councillor_list->Sex->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillor_list->RowIndex ?>_Sex" name="x<?php echo $councillor_list->RowIndex ?>_Sex"<?php echo $councillor_list->Sex->editAttributes() ?>>
			<?php echo $councillor_list->Sex->selectOptionListHtml("x{$councillor_list->RowIndex}_Sex") ?>
		</select>
</div>
<?php echo $councillor_list->Sex->Lookup->getParamTag($councillor_list, "p_x" . $councillor_list->RowIndex . "_Sex") ?>
</span>
<input type="hidden" data-table="councillor" data-field="x_Sex" name="o<?php echo $councillor_list->RowIndex ?>_Sex" id="o<?php echo $councillor_list->RowIndex ?>_Sex" value="<?php echo HtmlEncode($councillor_list->Sex->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_list->Title->Visible) { // Title ?>
		<td data-name="Title">
<span id="el$rowindex$_councillor_Title" class="form-group councillor_Title">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_Title" data-value-separator="<?php echo $councillor_list->Title->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillor_list->RowIndex ?>_Title" name="x<?php echo $councillor_list->RowIndex ?>_Title"<?php echo $councillor_list->Title->editAttributes() ?>>
			<?php echo $councillor_list->Title->selectOptionListHtml("x{$councillor_list->RowIndex}_Title") ?>
		</select>
</div>
<?php echo $councillor_list->Title->Lookup->getParamTag($councillor_list, "p_x" . $councillor_list->RowIndex . "_Title") ?>
</span>
<input type="hidden" data-table="councillor" data-field="x_Title" name="o<?php echo $councillor_list->RowIndex ?>_Title" id="o<?php echo $councillor_list->RowIndex ?>_Title" value="<?php echo HtmlEncode($councillor_list->Title->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname">
<span id="el$rowindex$_councillor_Surname" class="form-group councillor_Surname">
<input type="text" data-table="councillor" data-field="x_Surname" name="x<?php echo $councillor_list->RowIndex ?>_Surname" id="x<?php echo $councillor_list->RowIndex ?>_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_list->Surname->getPlaceHolder()) ?>" value="<?php echo $councillor_list->Surname->EditValue ?>"<?php echo $councillor_list->Surname->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_Surname" name="o<?php echo $councillor_list->RowIndex ?>_Surname" id="o<?php echo $councillor_list->RowIndex ?>_Surname" value="<?php echo HtmlEncode($councillor_list->Surname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<span id="el$rowindex$_councillor_FirstName" class="form-group councillor_FirstName">
<input type="text" data-table="councillor" data-field="x_FirstName" name="x<?php echo $councillor_list->RowIndex ?>_FirstName" id="x<?php echo $councillor_list->RowIndex ?>_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $councillor_list->FirstName->EditValue ?>"<?php echo $councillor_list->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_FirstName" name="o<?php echo $councillor_list->RowIndex ?>_FirstName" id="o<?php echo $councillor_list->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($councillor_list->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName">
<span id="el$rowindex$_councillor_MiddleName" class="form-group councillor_MiddleName">
<input type="text" data-table="councillor" data-field="x_MiddleName" name="x<?php echo $councillor_list->RowIndex ?>_MiddleName" id="x<?php echo $councillor_list->RowIndex ?>_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_list->MiddleName->getPlaceHolder()) ?>" value="<?php echo $councillor_list->MiddleName->EditValue ?>"<?php echo $councillor_list->MiddleName->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_MiddleName" name="o<?php echo $councillor_list->RowIndex ?>_MiddleName" id="o<?php echo $councillor_list->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($councillor_list->MiddleName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_list->MaritalStatus->Visible) { // MaritalStatus ?>
		<td data-name="MaritalStatus">
<span id="el$rowindex$_councillor_MaritalStatus" class="form-group councillor_MaritalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_MaritalStatus" data-value-separator="<?php echo $councillor_list->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x<?php echo $councillor_list->RowIndex ?>_MaritalStatus" name="x<?php echo $councillor_list->RowIndex ?>_MaritalStatus"<?php echo $councillor_list->MaritalStatus->editAttributes() ?>>
			<?php echo $councillor_list->MaritalStatus->selectOptionListHtml("x{$councillor_list->RowIndex}_MaritalStatus") ?>
		</select>
</div>
<?php echo $councillor_list->MaritalStatus->Lookup->getParamTag($councillor_list, "p_x" . $councillor_list->RowIndex . "_MaritalStatus") ?>
</span>
<input type="hidden" data-table="councillor" data-field="x_MaritalStatus" name="o<?php echo $councillor_list->RowIndex ?>_MaritalStatus" id="o<?php echo $councillor_list->RowIndex ?>_MaritalStatus" value="<?php echo HtmlEncode($councillor_list->MaritalStatus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_list->DateOfBirth->Visible) { // DateOfBirth ?>
		<td data-name="DateOfBirth">
<span id="el$rowindex$_councillor_DateOfBirth" class="form-group councillor_DateOfBirth">
<input type="text" data-table="councillor" data-field="x_DateOfBirth" name="x<?php echo $councillor_list->RowIndex ?>_DateOfBirth" id="x<?php echo $councillor_list->RowIndex ?>_DateOfBirth" placeholder="<?php echo HtmlEncode($councillor_list->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $councillor_list->DateOfBirth->EditValue ?>"<?php echo $councillor_list->DateOfBirth->editAttributes() ?>>
<?php if (!$councillor_list->DateOfBirth->ReadOnly && !$councillor_list->DateOfBirth->Disabled && !isset($councillor_list->DateOfBirth->EditAttrs["readonly"]) && !isset($councillor_list->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncillorlist", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncillorlist", "x<?php echo $councillor_list->RowIndex ?>_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="councillor" data-field="x_DateOfBirth" name="o<?php echo $councillor_list->RowIndex ?>_DateOfBirth" id="o<?php echo $councillor_list->RowIndex ?>_DateOfBirth" value="<?php echo HtmlEncode($councillor_list->DateOfBirth->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile">
<span id="el$rowindex$_councillor_Mobile" class="form-group councillor_Mobile">
<input type="text" data-table="councillor" data-field="x_Mobile" name="x<?php echo $councillor_list->RowIndex ?>_Mobile" id="x<?php echo $councillor_list->RowIndex ?>_Mobile" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_list->Mobile->getPlaceHolder()) ?>" value="<?php echo $councillor_list->Mobile->EditValue ?>"<?php echo $councillor_list->Mobile->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_Mobile" name="o<?php echo $councillor_list->RowIndex ?>_Mobile" id="o<?php echo $councillor_list->RowIndex ?>_Mobile" value="<?php echo HtmlEncode($councillor_list->Mobile->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($councillor_list->_Email->Visible) { // Email ?>
		<td data-name="_Email">
<span id="el$rowindex$_councillor__Email" class="form-group councillor__Email">
<input type="text" data-table="councillor" data-field="x__Email" name="x<?php echo $councillor_list->RowIndex ?>__Email" id="x<?php echo $councillor_list->RowIndex ?>__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_list->_Email->getPlaceHolder()) ?>" value="<?php echo $councillor_list->_Email->EditValue ?>"<?php echo $councillor_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x__Email" name="o<?php echo $councillor_list->RowIndex ?>__Email" id="o<?php echo $councillor_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($councillor_list->_Email->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$councillor_list->ListOptions->render("body", "right", $councillor_list->RowIndex);
?>
<script>
loadjs.ready(["fcouncillorlist", "load"], function() {
	fcouncillorlist.updateLists(<?php echo $councillor_list->RowIndex ?>);
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
<?php if ($councillor_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $councillor_list->FormKeyCountName ?>" id="<?php echo $councillor_list->FormKeyCountName ?>" value="<?php echo $councillor_list->KeyCount ?>">
<?php echo $councillor_list->MultiSelectKey ?>
<?php } ?>
<?php if ($councillor_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $councillor_list->FormKeyCountName ?>" id="<?php echo $councillor_list->FormKeyCountName ?>" value="<?php echo $councillor_list->KeyCount ?>">
<?php echo $councillor_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$councillor->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($councillor_list->Recordset)
	$councillor_list->Recordset->Close();
?>
<?php if (!$councillor_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$councillor_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillor_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $councillor_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($councillor_list->TotalRecords == 0 && !$councillor->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $councillor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$councillor_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$councillor_list->isExport()) { ?>
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
$councillor_list->terminate();
?>