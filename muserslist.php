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
$musers_list = new musers_list();

// Run the page
$musers_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$musers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$musers_list->isExport()) { ?>
<script>
var fmuserslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmuserslist = currentForm = new ew.Form("fmuserslist", "list");
	fmuserslist.formKeyCountName = '<?php echo $musers_list->FormKeyCountName ?>';

	// Validate form
	fmuserslist.validate = function() {
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
			<?php if ($musers_list->UserCode->Required) { ?>
				elm = this.getElements("x" + infix + "_UserCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->UserCode->caption(), $musers_list->UserCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->UserName->Required) { ?>
				elm = this.getElements("x" + infix + "_UserName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->UserName->caption(), $musers_list->UserName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->Password->caption(), $musers_list->Password->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && $(elm).hasClass("ew-password-strength") && !$(elm).data("validated"))
					return this.onError(elm, ew.language.phrase("PasswordTooSimple"));
			<?php if ($musers_list->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->EmployeeID->caption(), $musers_list->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($musers_list->EmployeeID->errorMessage()) ?>");
			<?php if ($musers_list->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->FirstName->caption(), $musers_list->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->LastName->Required) { ?>
				elm = this.getElements("x" + infix + "_LastName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->LastName->caption(), $musers_list->LastName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->ProvinceCode->caption(), $musers_list->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->LACode->caption(), $musers_list->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->Level->Required) { ?>
				elm = this.getElements("x" + infix + "_Level");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->Level->caption(), $musers_list->Level->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->Role->Required) { ?>
				elm = this.getElements("x" + infix + "_Role");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->Role->caption(), $musers_list->Role->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->Clearance->Required) { ?>
				elm = this.getElements("x" + infix + "_Clearance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->Clearance->caption(), $musers_list->Clearance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->OrganisationLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_OrganisationLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->OrganisationLevel->caption(), $musers_list->OrganisationLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OrganisationLevel");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($musers_list->OrganisationLevel->errorMessage()) ?>");
			<?php if ($musers_list->Active->Required) { ?>
				elm = this.getElements("x" + infix + "_Active");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->Active->caption(), $musers_list->Active->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->_Email->caption(), $musers_list->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->Telephone->caption(), $musers_list->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->Mobile->caption(), $musers_list->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->Position->Required) { ?>
				elm = this.getElements("x" + infix + "_Position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->Position->caption(), $musers_list->Position->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_list->ReportsTo->Required) { ?>
				elm = this.getElements("x" + infix + "_ReportsTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_list->ReportsTo->caption(), $musers_list->ReportsTo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReportsTo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($musers_list->ReportsTo->errorMessage()) ?>");

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
	fmuserslist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "UserName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Password", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "FirstName", false)) return false;
		if (ew.valueChanged(fobj, infix, "LastName", false)) return false;
		if (ew.valueChanged(fobj, infix, "ProvinceCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "LACode", false)) return false;
		if (ew.valueChanged(fobj, infix, "Level", false)) return false;
		if (ew.valueChanged(fobj, infix, "Role", false)) return false;
		if (ew.valueChanged(fobj, infix, "Clearance", false)) return false;
		if (ew.valueChanged(fobj, infix, "OrganisationLevel", false)) return false;
		if (ew.valueChanged(fobj, infix, "Active", false)) return false;
		if (ew.valueChanged(fobj, infix, "_Email", false)) return false;
		if (ew.valueChanged(fobj, infix, "Telephone", false)) return false;
		if (ew.valueChanged(fobj, infix, "Mobile", false)) return false;
		if (ew.valueChanged(fobj, infix, "Position", false)) return false;
		if (ew.valueChanged(fobj, infix, "ReportsTo", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fmuserslist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmuserslist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmuserslist.lists["x_ProvinceCode"] = <?php echo $musers_list->ProvinceCode->Lookup->toClientList($musers_list) ?>;
	fmuserslist.lists["x_ProvinceCode"].options = <?php echo JsonEncode($musers_list->ProvinceCode->lookupOptions()) ?>;
	fmuserslist.lists["x_LACode"] = <?php echo $musers_list->LACode->Lookup->toClientList($musers_list) ?>;
	fmuserslist.lists["x_LACode"].options = <?php echo JsonEncode($musers_list->LACode->lookupOptions()) ?>;
	fmuserslist.lists["x_Level"] = <?php echo $musers_list->Level->Lookup->toClientList($musers_list) ?>;
	fmuserslist.lists["x_Level"].options = <?php echo JsonEncode($musers_list->Level->lookupOptions()) ?>;
	fmuserslist.lists["x_Role"] = <?php echo $musers_list->Role->Lookup->toClientList($musers_list) ?>;
	fmuserslist.lists["x_Role"].options = <?php echo JsonEncode($musers_list->Role->lookupOptions()) ?>;
	fmuserslist.lists["x_Clearance"] = <?php echo $musers_list->Clearance->Lookup->toClientList($musers_list) ?>;
	fmuserslist.lists["x_Clearance"].options = <?php echo JsonEncode($musers_list->Clearance->lookupOptions()) ?>;
	fmuserslist.lists["x_Active"] = <?php echo $musers_list->Active->Lookup->toClientList($musers_list) ?>;
	fmuserslist.lists["x_Active"].options = <?php echo JsonEncode($musers_list->Active->lookupOptions()) ?>;
	loadjs.done("fmuserslist");
});
var fmuserslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmuserslistsrch = currentSearchForm = new ew.Form("fmuserslistsrch");

	// Validate function for search
	fmuserslistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fmuserslistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmuserslistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmuserslistsrch.lists["x_Level"] = <?php echo $musers_list->Level->Lookup->toClientList($musers_list) ?>;
	fmuserslistsrch.lists["x_Level"].options = <?php echo JsonEncode($musers_list->Level->lookupOptions()) ?>;

	// Filters
	fmuserslistsrch.filterList = <?php echo $musers_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmuserslistsrch.initSearchPanel = true;
	loadjs.done("fmuserslistsrch");
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
<?php if (!$musers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($musers_list->TotalRecords > 0 && $musers_list->ExportOptions->visible()) { ?>
<?php $musers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($musers_list->ImportOptions->visible()) { ?>
<?php $musers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($musers_list->SearchOptions->visible()) { ?>
<?php $musers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($musers_list->FilterOptions->visible()) { ?>
<?php $musers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$musers_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$musers_list->isExport() && !$musers->CurrentAction) { ?>
<form name="fmuserslistsrch" id="fmuserslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmuserslistsrch-search-panel" class="<?php echo $musers_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="musers">
	<div class="ew-extended-search">
<?php

// Render search row
$musers->RowType = ROWTYPE_SEARCH;
$musers->resetAttributes();
$musers_list->renderRow();
?>
<?php if ($musers_list->Level->Visible) { // Level ?>
	<?php
		$musers_list->SearchColumnCount++;
		if (($musers_list->SearchColumnCount - 1) % $musers_list->SearchFieldsPerRow == 0) {
			$musers_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $musers_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Level" class="ew-cell form-group">
		<label for="x_Level" class="ew-search-caption ew-label"><?php echo $musers_list->Level->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Level" id="z_Level" value="=">
</span>
		<span id="el_musers_Level" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Level" data-value-separator="<?php echo $musers_list->Level->displayValueSeparatorAttribute() ?>" id="x_Level" name="x_Level"<?php echo $musers_list->Level->editAttributes() ?>>
			<?php echo $musers_list->Level->selectOptionListHtml("x_Level") ?>
		</select>
</div>
<?php echo $musers_list->Level->Lookup->getParamTag($musers_list, "p_x_Level") ?>
</span>
	</div>
	<?php if ($musers_list->SearchColumnCount % $musers_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($musers_list->SearchColumnCount % $musers_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $musers_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($musers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($musers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $musers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($musers_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($musers_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($musers_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($musers_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $musers_list->showPageHeader(); ?>
<?php
$musers_list->showMessage();
?>
<?php if ($musers_list->TotalRecords > 0 || $musers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($musers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> musers">
<?php if (!$musers_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$musers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $musers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $musers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmuserslist" id="fmuserslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="musers">
<div id="gmp_musers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($musers_list->TotalRecords > 0 || $musers_list->isGridEdit()) { ?>
<table id="tbl_muserslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$musers->RowType = ROWTYPE_HEADER;

// Render list options
$musers_list->renderListOptions();

// Render list options (header, left)
$musers_list->ListOptions->render("header", "left");
?>
<?php if ($musers_list->UserCode->Visible) { // UserCode ?>
	<?php if ($musers_list->SortUrl($musers_list->UserCode) == "") { ?>
		<th data-name="UserCode" class="<?php echo $musers_list->UserCode->headerCellClass() ?>"><div id="elh_musers_UserCode" class="musers_UserCode"><div class="ew-table-header-caption"><?php echo $musers_list->UserCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserCode" class="<?php echo $musers_list->UserCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->UserCode) ?>', 1);"><div id="elh_musers_UserCode" class="musers_UserCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->UserCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($musers_list->UserCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->UserCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->UserName->Visible) { // UserName ?>
	<?php if ($musers_list->SortUrl($musers_list->UserName) == "") { ?>
		<th data-name="UserName" class="<?php echo $musers_list->UserName->headerCellClass() ?>"><div id="elh_musers_UserName" class="musers_UserName"><div class="ew-table-header-caption"><?php echo $musers_list->UserName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UserName" class="<?php echo $musers_list->UserName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->UserName) ?>', 1);"><div id="elh_musers_UserName" class="musers_UserName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->UserName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($musers_list->UserName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->UserName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->Password->Visible) { // Password ?>
	<?php if ($musers_list->SortUrl($musers_list->Password) == "") { ?>
		<th data-name="Password" class="<?php echo $musers_list->Password->headerCellClass() ?>"><div id="elh_musers_Password" class="musers_Password"><div class="ew-table-header-caption"><?php echo $musers_list->Password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Password" class="<?php echo $musers_list->Password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->Password) ?>', 1);"><div id="elh_musers_Password" class="musers_Password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->Password->caption() ?></span><span class="ew-table-header-sort"><?php if ($musers_list->Password->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->Password->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($musers_list->SortUrl($musers_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $musers_list->EmployeeID->headerCellClass() ?>"><div id="elh_musers_EmployeeID" class="musers_EmployeeID"><div class="ew-table-header-caption"><?php echo $musers_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $musers_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->EmployeeID) ?>', 1);"><div id="elh_musers_EmployeeID" class="musers_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($musers_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->FirstName->Visible) { // FirstName ?>
	<?php if ($musers_list->SortUrl($musers_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $musers_list->FirstName->headerCellClass() ?>"><div id="elh_musers_FirstName" class="musers_FirstName"><div class="ew-table-header-caption"><?php echo $musers_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $musers_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->FirstName) ?>', 1);"><div id="elh_musers_FirstName" class="musers_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($musers_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->LastName->Visible) { // LastName ?>
	<?php if ($musers_list->SortUrl($musers_list->LastName) == "") { ?>
		<th data-name="LastName" class="<?php echo $musers_list->LastName->headerCellClass() ?>"><div id="elh_musers_LastName" class="musers_LastName"><div class="ew-table-header-caption"><?php echo $musers_list->LastName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastName" class="<?php echo $musers_list->LastName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->LastName) ?>', 1);"><div id="elh_musers_LastName" class="musers_LastName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->LastName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($musers_list->LastName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->LastName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($musers_list->SortUrl($musers_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $musers_list->ProvinceCode->headerCellClass() ?>"><div id="elh_musers_ProvinceCode" class="musers_ProvinceCode"><div class="ew-table-header-caption"><?php echo $musers_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $musers_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->ProvinceCode) ?>', 1);"><div id="elh_musers_ProvinceCode" class="musers_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($musers_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->LACode->Visible) { // LACode ?>
	<?php if ($musers_list->SortUrl($musers_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $musers_list->LACode->headerCellClass() ?>"><div id="elh_musers_LACode" class="musers_LACode"><div class="ew-table-header-caption"><?php echo $musers_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $musers_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->LACode) ?>', 1);"><div id="elh_musers_LACode" class="musers_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($musers_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->Level->Visible) { // Level ?>
	<?php if ($musers_list->SortUrl($musers_list->Level) == "") { ?>
		<th data-name="Level" class="<?php echo $musers_list->Level->headerCellClass() ?>"><div id="elh_musers_Level" class="musers_Level"><div class="ew-table-header-caption"><?php echo $musers_list->Level->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Level" class="<?php echo $musers_list->Level->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->Level) ?>', 1);"><div id="elh_musers_Level" class="musers_Level">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->Level->caption() ?></span><span class="ew-table-header-sort"><?php if ($musers_list->Level->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->Level->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->Role->Visible) { // Role ?>
	<?php if ($musers_list->SortUrl($musers_list->Role) == "") { ?>
		<th data-name="Role" class="<?php echo $musers_list->Role->headerCellClass() ?>"><div id="elh_musers_Role" class="musers_Role"><div class="ew-table-header-caption"><?php echo $musers_list->Role->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Role" class="<?php echo $musers_list->Role->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->Role) ?>', 1);"><div id="elh_musers_Role" class="musers_Role">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->Role->caption() ?></span><span class="ew-table-header-sort"><?php if ($musers_list->Role->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->Role->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->Clearance->Visible) { // Clearance ?>
	<?php if ($musers_list->SortUrl($musers_list->Clearance) == "") { ?>
		<th data-name="Clearance" class="<?php echo $musers_list->Clearance->headerCellClass() ?>"><div id="elh_musers_Clearance" class="musers_Clearance"><div class="ew-table-header-caption"><?php echo $musers_list->Clearance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Clearance" class="<?php echo $musers_list->Clearance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->Clearance) ?>', 1);"><div id="elh_musers_Clearance" class="musers_Clearance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->Clearance->caption() ?></span><span class="ew-table-header-sort"><?php if ($musers_list->Clearance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->Clearance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->OrganisationLevel->Visible) { // OrganisationLevel ?>
	<?php if ($musers_list->SortUrl($musers_list->OrganisationLevel) == "") { ?>
		<th data-name="OrganisationLevel" class="<?php echo $musers_list->OrganisationLevel->headerCellClass() ?>"><div id="elh_musers_OrganisationLevel" class="musers_OrganisationLevel"><div class="ew-table-header-caption"><?php echo $musers_list->OrganisationLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OrganisationLevel" class="<?php echo $musers_list->OrganisationLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->OrganisationLevel) ?>', 1);"><div id="elh_musers_OrganisationLevel" class="musers_OrganisationLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->OrganisationLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($musers_list->OrganisationLevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->OrganisationLevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->Active->Visible) { // Active ?>
	<?php if ($musers_list->SortUrl($musers_list->Active) == "") { ?>
		<th data-name="Active" class="<?php echo $musers_list->Active->headerCellClass() ?>"><div id="elh_musers_Active" class="musers_Active"><div class="ew-table-header-caption"><?php echo $musers_list->Active->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Active" class="<?php echo $musers_list->Active->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->Active) ?>', 1);"><div id="elh_musers_Active" class="musers_Active">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->Active->caption() ?></span><span class="ew-table-header-sort"><?php if ($musers_list->Active->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->Active->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->_Email->Visible) { // Email ?>
	<?php if ($musers_list->SortUrl($musers_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $musers_list->_Email->headerCellClass() ?>"><div id="elh_musers__Email" class="musers__Email"><div class="ew-table-header-caption"><?php echo $musers_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $musers_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->_Email) ?>', 1);"><div id="elh_musers__Email" class="musers__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($musers_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->Telephone->Visible) { // Telephone ?>
	<?php if ($musers_list->SortUrl($musers_list->Telephone) == "") { ?>
		<th data-name="Telephone" class="<?php echo $musers_list->Telephone->headerCellClass() ?>"><div id="elh_musers_Telephone" class="musers_Telephone"><div class="ew-table-header-caption"><?php echo $musers_list->Telephone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Telephone" class="<?php echo $musers_list->Telephone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->Telephone) ?>', 1);"><div id="elh_musers_Telephone" class="musers_Telephone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->Telephone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($musers_list->Telephone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->Telephone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->Mobile->Visible) { // Mobile ?>
	<?php if ($musers_list->SortUrl($musers_list->Mobile) == "") { ?>
		<th data-name="Mobile" class="<?php echo $musers_list->Mobile->headerCellClass() ?>"><div id="elh_musers_Mobile" class="musers_Mobile"><div class="ew-table-header-caption"><?php echo $musers_list->Mobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Mobile" class="<?php echo $musers_list->Mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->Mobile) ?>', 1);"><div id="elh_musers_Mobile" class="musers_Mobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->Mobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($musers_list->Mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->Mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->Position->Visible) { // Position ?>
	<?php if ($musers_list->SortUrl($musers_list->Position) == "") { ?>
		<th data-name="Position" class="<?php echo $musers_list->Position->headerCellClass() ?>"><div id="elh_musers_Position" class="musers_Position"><div class="ew-table-header-caption"><?php echo $musers_list->Position->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Position" class="<?php echo $musers_list->Position->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->Position) ?>', 1);"><div id="elh_musers_Position" class="musers_Position">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->Position->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($musers_list->Position->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->Position->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($musers_list->ReportsTo->Visible) { // ReportsTo ?>
	<?php if ($musers_list->SortUrl($musers_list->ReportsTo) == "") { ?>
		<th data-name="ReportsTo" class="<?php echo $musers_list->ReportsTo->headerCellClass() ?>"><div id="elh_musers_ReportsTo" class="musers_ReportsTo"><div class="ew-table-header-caption"><?php echo $musers_list->ReportsTo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReportsTo" class="<?php echo $musers_list->ReportsTo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $musers_list->SortUrl($musers_list->ReportsTo) ?>', 1);"><div id="elh_musers_ReportsTo" class="musers_ReportsTo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $musers_list->ReportsTo->caption() ?></span><span class="ew-table-header-sort"><?php if ($musers_list->ReportsTo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($musers_list->ReportsTo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$musers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($musers_list->ExportAll && $musers_list->isExport()) {
	$musers_list->StopRecord = $musers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($musers_list->TotalRecords > $musers_list->StartRecord + $musers_list->DisplayRecords - 1)
		$musers_list->StopRecord = $musers_list->StartRecord + $musers_list->DisplayRecords - 1;
	else
		$musers_list->StopRecord = $musers_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($musers->isConfirm() || $musers_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($musers_list->FormKeyCountName) && ($musers_list->isGridAdd() || $musers_list->isGridEdit() || $musers->isConfirm())) {
		$musers_list->KeyCount = $CurrentForm->getValue($musers_list->FormKeyCountName);
		$musers_list->StopRecord = $musers_list->StartRecord + $musers_list->KeyCount - 1;
	}
}
$musers_list->RecordCount = $musers_list->StartRecord - 1;
if ($musers_list->Recordset && !$musers_list->Recordset->EOF) {
	$musers_list->Recordset->moveFirst();
	$selectLimit = $musers_list->UseSelectLimit;
	if (!$selectLimit && $musers_list->StartRecord > 1)
		$musers_list->Recordset->move($musers_list->StartRecord - 1);
} elseif (!$musers->AllowAddDeleteRow && $musers_list->StopRecord == 0) {
	$musers_list->StopRecord = $musers->GridAddRowCount;
}

// Initialize aggregate
$musers->RowType = ROWTYPE_AGGREGATEINIT;
$musers->resetAttributes();
$musers_list->renderRow();
if ($musers_list->isGridAdd())
	$musers_list->RowIndex = 0;
if ($musers_list->isGridEdit())
	$musers_list->RowIndex = 0;
while ($musers_list->RecordCount < $musers_list->StopRecord) {
	$musers_list->RecordCount++;
	if ($musers_list->RecordCount >= $musers_list->StartRecord) {
		$musers_list->RowCount++;
		if ($musers_list->isGridAdd() || $musers_list->isGridEdit() || $musers->isConfirm()) {
			$musers_list->RowIndex++;
			$CurrentForm->Index = $musers_list->RowIndex;
			if ($CurrentForm->hasValue($musers_list->FormActionName) && ($musers->isConfirm() || $musers_list->EventCancelled))
				$musers_list->RowAction = strval($CurrentForm->getValue($musers_list->FormActionName));
			elseif ($musers_list->isGridAdd())
				$musers_list->RowAction = "insert";
			else
				$musers_list->RowAction = "";
		}

		// Set up key count
		$musers_list->KeyCount = $musers_list->RowIndex;

		// Init row class and style
		$musers->resetAttributes();
		$musers->CssClass = "";
		if ($musers_list->isGridAdd()) {
			$musers_list->loadRowValues(); // Load default values
		} else {
			$musers_list->loadRowValues($musers_list->Recordset); // Load row values
		}
		$musers->RowType = ROWTYPE_VIEW; // Render view
		if ($musers_list->isGridAdd()) // Grid add
			$musers->RowType = ROWTYPE_ADD; // Render add
		if ($musers_list->isGridAdd() && $musers->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$musers_list->restoreCurrentRowFormValues($musers_list->RowIndex); // Restore form values
		if ($musers_list->isGridEdit()) { // Grid edit
			if ($musers->EventCancelled)
				$musers_list->restoreCurrentRowFormValues($musers_list->RowIndex); // Restore form values
			if ($musers_list->RowAction == "insert")
				$musers->RowType = ROWTYPE_ADD; // Render add
			else
				$musers->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($musers_list->isGridEdit() && ($musers->RowType == ROWTYPE_EDIT || $musers->RowType == ROWTYPE_ADD) && $musers->EventCancelled) // Update failed
			$musers_list->restoreCurrentRowFormValues($musers_list->RowIndex); // Restore form values
		if ($musers->RowType == ROWTYPE_EDIT) // Edit row
			$musers_list->EditRowCount++;

		// Set up row id / data-rowindex
		$musers->RowAttrs->merge(["data-rowindex" => $musers_list->RowCount, "id" => "r" . $musers_list->RowCount . "_musers", "data-rowtype" => $musers->RowType]);

		// Render row
		$musers_list->renderRow();

		// Render list options
		$musers_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($musers_list->RowAction != "delete" && $musers_list->RowAction != "insertdelete" && !($musers_list->RowAction == "insert" && $musers->isConfirm() && $musers_list->emptyRow())) {
?>
	<tr <?php echo $musers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$musers_list->ListOptions->render("body", "left", $musers_list->RowCount);
?>
	<?php if ($musers_list->UserCode->Visible) { // UserCode ?>
		<td data-name="UserCode" <?php echo $musers_list->UserCode->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_UserCode" class="form-group"></span>
<input type="hidden" data-table="musers" data-field="x_UserCode" name="o<?php echo $musers_list->RowIndex ?>_UserCode" id="o<?php echo $musers_list->RowIndex ?>_UserCode" value="<?php echo HtmlEncode($musers_list->UserCode->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_UserCode" class="form-group">
<input type="text" data-table="musers" data-field="x_UserCode" name="x<?php echo $musers_list->RowIndex ?>_UserCode" id="x<?php echo $musers_list->RowIndex ?>_UserCode" placeholder="<?php echo HtmlEncode($musers_list->UserCode->getPlaceHolder()) ?>" value="<?php echo $musers_list->UserCode->EditValue ?>"<?php echo $musers_list->UserCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_UserCode">
<span<?php echo $musers_list->UserCode->viewAttributes() ?>><?php echo $musers_list->UserCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->UserName->Visible) { // UserName ?>
		<td data-name="UserName" <?php echo $musers_list->UserName->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_UserName" class="form-group">
<input type="text" data-table="musers" data-field="x_UserName" name="x<?php echo $musers_list->RowIndex ?>_UserName" id="x<?php echo $musers_list->RowIndex ?>_UserName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->UserName->getPlaceHolder()) ?>" value="<?php echo $musers_list->UserName->EditValue ?>"<?php echo $musers_list->UserName->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_UserName" name="o<?php echo $musers_list->RowIndex ?>_UserName" id="o<?php echo $musers_list->RowIndex ?>_UserName" value="<?php echo HtmlEncode($musers_list->UserName->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="musers" data-field="x_UserName" name="x<?php echo $musers_list->RowIndex ?>_UserName" id="x<?php echo $musers_list->RowIndex ?>_UserName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->UserName->getPlaceHolder()) ?>" value="<?php echo $musers_list->UserName->EditValue ?>"<?php echo $musers_list->UserName->editAttributes() ?>>
<input type="hidden" data-table="musers" data-field="x_UserName" name="o<?php echo $musers_list->RowIndex ?>_UserName" id="o<?php echo $musers_list->RowIndex ?>_UserName" value="<?php echo HtmlEncode($musers_list->UserName->OldValue != null ? $musers_list->UserName->OldValue : $musers_list->UserName->CurrentValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_UserName">
<span<?php echo $musers_list->UserName->viewAttributes() ?>><?php echo $musers_list->UserName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->Password->Visible) { // Password ?>
		<td data-name="Password" <?php echo $musers_list->Password->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Password" class="form-group">
<div class="input-group" id="ig<?php echo $musers_list->RowIndex ?>_Password">
<input type="password" autocomplete="new-password" data-password-strength="pst<?php echo $musers_list->RowIndex ?>_Password" data-table="musers" data-field="x_Password" name="x<?php echo $musers_list->RowIndex ?>_Password" id="x<?php echo $musers_list->RowIndex ?>_Password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->Password->getPlaceHolder()) ?>"<?php echo $musers_list->Password->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x<?php echo $musers_list->RowIndex ?>_Password" data-password-confirm="c<?php echo $musers_list->RowIndex ?>_Password" data-password-strength="pst<?php echo $musers_list->RowIndex ?>_Password"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst<?php echo $musers_list->RowIndex ?>_Password">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<input type="hidden" data-table="musers" data-field="x_Password" name="o<?php echo $musers_list->RowIndex ?>_Password" id="o<?php echo $musers_list->RowIndex ?>_Password" value="<?php echo HtmlEncode($musers_list->Password->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Password" class="form-group">
<div class="input-group" id="ig<?php echo $musers_list->RowIndex ?>_Password">
<input type="password" autocomplete="new-password" data-password-strength="pst<?php echo $musers_list->RowIndex ?>_Password" data-table="musers" data-field="x_Password" name="x<?php echo $musers_list->RowIndex ?>_Password" id="x<?php echo $musers_list->RowIndex ?>_Password" value="<?php echo $musers_list->Password->EditValue ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->Password->getPlaceHolder()) ?>"<?php echo $musers_list->Password->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x<?php echo $musers_list->RowIndex ?>_Password" data-password-confirm="c<?php echo $musers_list->RowIndex ?>_Password" data-password-strength="pst<?php echo $musers_list->RowIndex ?>_Password"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst<?php echo $musers_list->RowIndex ?>_Password">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Password">
<span<?php echo $musers_list->Password->viewAttributes() ?>><?php echo $musers_list->Password->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $musers_list->EmployeeID->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_EmployeeID" class="form-group">
<input type="text" data-table="musers" data-field="x_EmployeeID" name="x<?php echo $musers_list->RowIndex ?>_EmployeeID" id="x<?php echo $musers_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($musers_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $musers_list->EmployeeID->EditValue ?>"<?php echo $musers_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_EmployeeID" name="o<?php echo $musers_list->RowIndex ?>_EmployeeID" id="o<?php echo $musers_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($musers_list->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_EmployeeID" class="form-group">
<input type="text" data-table="musers" data-field="x_EmployeeID" name="x<?php echo $musers_list->RowIndex ?>_EmployeeID" id="x<?php echo $musers_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($musers_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $musers_list->EmployeeID->EditValue ?>"<?php echo $musers_list->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_EmployeeID">
<span<?php echo $musers_list->EmployeeID->viewAttributes() ?>><?php echo $musers_list->EmployeeID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $musers_list->FirstName->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_FirstName" class="form-group">
<input type="text" data-table="musers" data-field="x_FirstName" name="x<?php echo $musers_list->RowIndex ?>_FirstName" id="x<?php echo $musers_list->RowIndex ?>_FirstName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $musers_list->FirstName->EditValue ?>"<?php echo $musers_list->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_FirstName" name="o<?php echo $musers_list->RowIndex ?>_FirstName" id="o<?php echo $musers_list->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($musers_list->FirstName->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_FirstName" class="form-group">
<input type="text" data-table="musers" data-field="x_FirstName" name="x<?php echo $musers_list->RowIndex ?>_FirstName" id="x<?php echo $musers_list->RowIndex ?>_FirstName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $musers_list->FirstName->EditValue ?>"<?php echo $musers_list->FirstName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_FirstName">
<span<?php echo $musers_list->FirstName->viewAttributes() ?>><?php echo $musers_list->FirstName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->LastName->Visible) { // LastName ?>
		<td data-name="LastName" <?php echo $musers_list->LastName->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_LastName" class="form-group">
<input type="text" data-table="musers" data-field="x_LastName" name="x<?php echo $musers_list->RowIndex ?>_LastName" id="x<?php echo $musers_list->RowIndex ?>_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->LastName->getPlaceHolder()) ?>" value="<?php echo $musers_list->LastName->EditValue ?>"<?php echo $musers_list->LastName->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_LastName" name="o<?php echo $musers_list->RowIndex ?>_LastName" id="o<?php echo $musers_list->RowIndex ?>_LastName" value="<?php echo HtmlEncode($musers_list->LastName->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_LastName" class="form-group">
<input type="text" data-table="musers" data-field="x_LastName" name="x<?php echo $musers_list->RowIndex ?>_LastName" id="x<?php echo $musers_list->RowIndex ?>_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->LastName->getPlaceHolder()) ?>" value="<?php echo $musers_list->LastName->EditValue ?>"<?php echo $musers_list->LastName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_LastName">
<span<?php echo $musers_list->LastName->viewAttributes() ?>><?php echo $musers_list->LastName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $musers_list->ProvinceCode->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_ProvinceCode" class="form-group">
<?php $musers_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $musers_list->RowIndex ?>_ProvinceCode"><?php echo EmptyValue(strval($musers_list->ProvinceCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $musers_list->ProvinceCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($musers_list->ProvinceCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($musers_list->ProvinceCode->ReadOnly || $musers_list->ProvinceCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $musers_list->RowIndex ?>_ProvinceCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $musers_list->ProvinceCode->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_ProvinceCode") ?>
<input type="hidden" data-table="musers" data-field="x_ProvinceCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $musers_list->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $musers_list->RowIndex ?>_ProvinceCode" id="x<?php echo $musers_list->RowIndex ?>_ProvinceCode" value="<?php echo $musers_list->ProvinceCode->CurrentValue ?>"<?php echo $musers_list->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_ProvinceCode" name="o<?php echo $musers_list->RowIndex ?>_ProvinceCode" id="o<?php echo $musers_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($musers_list->ProvinceCode->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_ProvinceCode" class="form-group">
<?php $musers_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $musers_list->RowIndex ?>_ProvinceCode"><?php echo EmptyValue(strval($musers_list->ProvinceCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $musers_list->ProvinceCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($musers_list->ProvinceCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($musers_list->ProvinceCode->ReadOnly || $musers_list->ProvinceCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $musers_list->RowIndex ?>_ProvinceCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $musers_list->ProvinceCode->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_ProvinceCode") ?>
<input type="hidden" data-table="musers" data-field="x_ProvinceCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $musers_list->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $musers_list->RowIndex ?>_ProvinceCode" id="x<?php echo $musers_list->RowIndex ?>_ProvinceCode" value="<?php echo $musers_list->ProvinceCode->CurrentValue ?>"<?php echo $musers_list->ProvinceCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_ProvinceCode">
<span<?php echo $musers_list->ProvinceCode->viewAttributes() ?>><?php echo $musers_list->ProvinceCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $musers_list->LACode->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_LACode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $musers_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($musers_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $musers_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($musers_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($musers_list->LACode->ReadOnly || $musers_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $musers_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $musers_list->LACode->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="musers" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $musers_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $musers_list->RowIndex ?>_LACode" id="x<?php echo $musers_list->RowIndex ?>_LACode" value="<?php echo $musers_list->LACode->CurrentValue ?>"<?php echo $musers_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_LACode" name="o<?php echo $musers_list->RowIndex ?>_LACode" id="o<?php echo $musers_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($musers_list->LACode->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_LACode" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $musers_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($musers_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $musers_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($musers_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($musers_list->LACode->ReadOnly || $musers_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $musers_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $musers_list->LACode->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="musers" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $musers_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $musers_list->RowIndex ?>_LACode" id="x<?php echo $musers_list->RowIndex ?>_LACode" value="<?php echo $musers_list->LACode->CurrentValue ?>"<?php echo $musers_list->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_LACode">
<span<?php echo $musers_list->LACode->viewAttributes() ?>><?php echo $musers_list->LACode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->Level->Visible) { // Level ?>
		<td data-name="Level" <?php echo $musers_list->Level->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Level" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Level" data-value-separator="<?php echo $musers_list->Level->displayValueSeparatorAttribute() ?>" id="x<?php echo $musers_list->RowIndex ?>_Level" name="x<?php echo $musers_list->RowIndex ?>_Level"<?php echo $musers_list->Level->editAttributes() ?>>
			<?php echo $musers_list->Level->selectOptionListHtml("x{$musers_list->RowIndex}_Level") ?>
		</select>
</div>
<?php echo $musers_list->Level->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_Level") ?>
</span>
<input type="hidden" data-table="musers" data-field="x_Level" name="o<?php echo $musers_list->RowIndex ?>_Level" id="o<?php echo $musers_list->RowIndex ?>_Level" value="<?php echo HtmlEncode($musers_list->Level->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Level" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Level" data-value-separator="<?php echo $musers_list->Level->displayValueSeparatorAttribute() ?>" id="x<?php echo $musers_list->RowIndex ?>_Level" name="x<?php echo $musers_list->RowIndex ?>_Level"<?php echo $musers_list->Level->editAttributes() ?>>
			<?php echo $musers_list->Level->selectOptionListHtml("x{$musers_list->RowIndex}_Level") ?>
		</select>
</div>
<?php echo $musers_list->Level->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_Level") ?>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Level">
<span<?php echo $musers_list->Level->viewAttributes() ?>><?php echo $musers_list->Level->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->Role->Visible) { // Role ?>
		<td data-name="Role" <?php echo $musers_list->Role->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Role" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Role" data-value-separator="<?php echo $musers_list->Role->displayValueSeparatorAttribute() ?>" id="x<?php echo $musers_list->RowIndex ?>_Role" name="x<?php echo $musers_list->RowIndex ?>_Role"<?php echo $musers_list->Role->editAttributes() ?>>
			<?php echo $musers_list->Role->selectOptionListHtml("x{$musers_list->RowIndex}_Role") ?>
		</select>
</div>
<?php echo $musers_list->Role->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_Role") ?>
</span>
<input type="hidden" data-table="musers" data-field="x_Role" name="o<?php echo $musers_list->RowIndex ?>_Role" id="o<?php echo $musers_list->RowIndex ?>_Role" value="<?php echo HtmlEncode($musers_list->Role->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Role" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Role" data-value-separator="<?php echo $musers_list->Role->displayValueSeparatorAttribute() ?>" id="x<?php echo $musers_list->RowIndex ?>_Role" name="x<?php echo $musers_list->RowIndex ?>_Role"<?php echo $musers_list->Role->editAttributes() ?>>
			<?php echo $musers_list->Role->selectOptionListHtml("x{$musers_list->RowIndex}_Role") ?>
		</select>
</div>
<?php echo $musers_list->Role->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_Role") ?>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Role">
<span<?php echo $musers_list->Role->viewAttributes() ?>><?php echo $musers_list->Role->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->Clearance->Visible) { // Clearance ?>
		<td data-name="Clearance" <?php echo $musers_list->Clearance->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Clearance" class="form-group">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($musers_list->Clearance->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Clearance" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Clearance" data-value-separator="<?php echo $musers_list->Clearance->displayValueSeparatorAttribute() ?>" id="x<?php echo $musers_list->RowIndex ?>_Clearance" name="x<?php echo $musers_list->RowIndex ?>_Clearance"<?php echo $musers_list->Clearance->editAttributes() ?>>
			<?php echo $musers_list->Clearance->selectOptionListHtml("x{$musers_list->RowIndex}_Clearance") ?>
		</select>
</div>
<?php echo $musers_list->Clearance->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_Clearance") ?>
</span>
<?php } ?>
<input type="hidden" data-table="musers" data-field="x_Clearance" name="o<?php echo $musers_list->RowIndex ?>_Clearance" id="o<?php echo $musers_list->RowIndex ?>_Clearance" value="<?php echo HtmlEncode($musers_list->Clearance->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Clearance" class="form-group">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($musers_list->Clearance->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Clearance" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Clearance" data-value-separator="<?php echo $musers_list->Clearance->displayValueSeparatorAttribute() ?>" id="x<?php echo $musers_list->RowIndex ?>_Clearance" name="x<?php echo $musers_list->RowIndex ?>_Clearance"<?php echo $musers_list->Clearance->editAttributes() ?>>
			<?php echo $musers_list->Clearance->selectOptionListHtml("x{$musers_list->RowIndex}_Clearance") ?>
		</select>
</div>
<?php echo $musers_list->Clearance->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_Clearance") ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Clearance">
<span<?php echo $musers_list->Clearance->viewAttributes() ?>><?php echo $musers_list->Clearance->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->OrganisationLevel->Visible) { // OrganisationLevel ?>
		<td data-name="OrganisationLevel" <?php echo $musers_list->OrganisationLevel->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_OrganisationLevel" class="form-group">
<input type="text" data-table="musers" data-field="x_OrganisationLevel" name="x<?php echo $musers_list->RowIndex ?>_OrganisationLevel" id="x<?php echo $musers_list->RowIndex ?>_OrganisationLevel" size="30" placeholder="<?php echo HtmlEncode($musers_list->OrganisationLevel->getPlaceHolder()) ?>" value="<?php echo $musers_list->OrganisationLevel->EditValue ?>"<?php echo $musers_list->OrganisationLevel->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_OrganisationLevel" name="o<?php echo $musers_list->RowIndex ?>_OrganisationLevel" id="o<?php echo $musers_list->RowIndex ?>_OrganisationLevel" value="<?php echo HtmlEncode($musers_list->OrganisationLevel->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_OrganisationLevel" class="form-group">
<input type="text" data-table="musers" data-field="x_OrganisationLevel" name="x<?php echo $musers_list->RowIndex ?>_OrganisationLevel" id="x<?php echo $musers_list->RowIndex ?>_OrganisationLevel" size="30" placeholder="<?php echo HtmlEncode($musers_list->OrganisationLevel->getPlaceHolder()) ?>" value="<?php echo $musers_list->OrganisationLevel->EditValue ?>"<?php echo $musers_list->OrganisationLevel->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_OrganisationLevel">
<span<?php echo $musers_list->OrganisationLevel->viewAttributes() ?>><?php echo $musers_list->OrganisationLevel->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->Active->Visible) { // Active ?>
		<td data-name="Active" <?php echo $musers_list->Active->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Active" class="form-group">
<div id="tp_x<?php echo $musers_list->RowIndex ?>_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="musers" data-field="x_Active" data-value-separator="<?php echo $musers_list->Active->displayValueSeparatorAttribute() ?>" name="x<?php echo $musers_list->RowIndex ?>_Active" id="x<?php echo $musers_list->RowIndex ?>_Active" value="{value}"<?php echo $musers_list->Active->editAttributes() ?>></div>
<div id="dsl_x<?php echo $musers_list->RowIndex ?>_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $musers_list->Active->radioButtonListHtml(FALSE, "x{$musers_list->RowIndex}_Active") ?>
</div></div>
<?php echo $musers_list->Active->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_Active") ?>
</span>
<input type="hidden" data-table="musers" data-field="x_Active" name="o<?php echo $musers_list->RowIndex ?>_Active" id="o<?php echo $musers_list->RowIndex ?>_Active" value="<?php echo HtmlEncode($musers_list->Active->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Active" class="form-group">
<div id="tp_x<?php echo $musers_list->RowIndex ?>_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="musers" data-field="x_Active" data-value-separator="<?php echo $musers_list->Active->displayValueSeparatorAttribute() ?>" name="x<?php echo $musers_list->RowIndex ?>_Active" id="x<?php echo $musers_list->RowIndex ?>_Active" value="{value}"<?php echo $musers_list->Active->editAttributes() ?>></div>
<div id="dsl_x<?php echo $musers_list->RowIndex ?>_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $musers_list->Active->radioButtonListHtml(FALSE, "x{$musers_list->RowIndex}_Active") ?>
</div></div>
<?php echo $musers_list->Active->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_Active") ?>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Active">
<span<?php echo $musers_list->Active->viewAttributes() ?>><?php echo $musers_list->Active->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $musers_list->_Email->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers__Email" class="form-group">
<input type="text" data-table="musers" data-field="x__Email" name="x<?php echo $musers_list->RowIndex ?>__Email" id="x<?php echo $musers_list->RowIndex ?>__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->_Email->getPlaceHolder()) ?>" value="<?php echo $musers_list->_Email->EditValue ?>"<?php echo $musers_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x__Email" name="o<?php echo $musers_list->RowIndex ?>__Email" id="o<?php echo $musers_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($musers_list->_Email->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers__Email" class="form-group">
<input type="text" data-table="musers" data-field="x__Email" name="x<?php echo $musers_list->RowIndex ?>__Email" id="x<?php echo $musers_list->RowIndex ?>__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->_Email->getPlaceHolder()) ?>" value="<?php echo $musers_list->_Email->EditValue ?>"<?php echo $musers_list->_Email->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers__Email">
<span<?php echo $musers_list->_Email->viewAttributes() ?>><?php echo $musers_list->_Email->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone" <?php echo $musers_list->Telephone->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Telephone" class="form-group">
<input type="text" data-table="musers" data-field="x_Telephone" name="x<?php echo $musers_list->RowIndex ?>_Telephone" id="x<?php echo $musers_list->RowIndex ?>_Telephone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->Telephone->getPlaceHolder()) ?>" value="<?php echo $musers_list->Telephone->EditValue ?>"<?php echo $musers_list->Telephone->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_Telephone" name="o<?php echo $musers_list->RowIndex ?>_Telephone" id="o<?php echo $musers_list->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($musers_list->Telephone->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Telephone" class="form-group">
<input type="text" data-table="musers" data-field="x_Telephone" name="x<?php echo $musers_list->RowIndex ?>_Telephone" id="x<?php echo $musers_list->RowIndex ?>_Telephone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->Telephone->getPlaceHolder()) ?>" value="<?php echo $musers_list->Telephone->EditValue ?>"<?php echo $musers_list->Telephone->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Telephone">
<span<?php echo $musers_list->Telephone->viewAttributes() ?>><?php echo $musers_list->Telephone->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile" <?php echo $musers_list->Mobile->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Mobile" class="form-group">
<input type="text" data-table="musers" data-field="x_Mobile" name="x<?php echo $musers_list->RowIndex ?>_Mobile" id="x<?php echo $musers_list->RowIndex ?>_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($musers_list->Mobile->getPlaceHolder()) ?>" value="<?php echo $musers_list->Mobile->EditValue ?>"<?php echo $musers_list->Mobile->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_Mobile" name="o<?php echo $musers_list->RowIndex ?>_Mobile" id="o<?php echo $musers_list->RowIndex ?>_Mobile" value="<?php echo HtmlEncode($musers_list->Mobile->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Mobile" class="form-group">
<input type="text" data-table="musers" data-field="x_Mobile" name="x<?php echo $musers_list->RowIndex ?>_Mobile" id="x<?php echo $musers_list->RowIndex ?>_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($musers_list->Mobile->getPlaceHolder()) ?>" value="<?php echo $musers_list->Mobile->EditValue ?>"<?php echo $musers_list->Mobile->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Mobile">
<span<?php echo $musers_list->Mobile->viewAttributes() ?>><?php echo $musers_list->Mobile->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->Position->Visible) { // Position ?>
		<td data-name="Position" <?php echo $musers_list->Position->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Position" class="form-group">
<input type="text" data-table="musers" data-field="x_Position" name="x<?php echo $musers_list->RowIndex ?>_Position" id="x<?php echo $musers_list->RowIndex ?>_Position" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($musers_list->Position->getPlaceHolder()) ?>" value="<?php echo $musers_list->Position->EditValue ?>"<?php echo $musers_list->Position->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_Position" name="o<?php echo $musers_list->RowIndex ?>_Position" id="o<?php echo $musers_list->RowIndex ?>_Position" value="<?php echo HtmlEncode($musers_list->Position->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Position" class="form-group">
<input type="text" data-table="musers" data-field="x_Position" name="x<?php echo $musers_list->RowIndex ?>_Position" id="x<?php echo $musers_list->RowIndex ?>_Position" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($musers_list->Position->getPlaceHolder()) ?>" value="<?php echo $musers_list->Position->EditValue ?>"<?php echo $musers_list->Position->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_Position">
<span<?php echo $musers_list->Position->viewAttributes() ?>><?php echo $musers_list->Position->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($musers_list->ReportsTo->Visible) { // ReportsTo ?>
		<td data-name="ReportsTo" <?php echo $musers_list->ReportsTo->cellAttributes() ?>>
<?php if ($musers->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_ReportsTo" class="form-group">
<input type="text" data-table="musers" data-field="x_ReportsTo" name="x<?php echo $musers_list->RowIndex ?>_ReportsTo" id="x<?php echo $musers_list->RowIndex ?>_ReportsTo" size="30" placeholder="<?php echo HtmlEncode($musers_list->ReportsTo->getPlaceHolder()) ?>" value="<?php echo $musers_list->ReportsTo->EditValue ?>"<?php echo $musers_list->ReportsTo->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_ReportsTo" name="o<?php echo $musers_list->RowIndex ?>_ReportsTo" id="o<?php echo $musers_list->RowIndex ?>_ReportsTo" value="<?php echo HtmlEncode($musers_list->ReportsTo->OldValue) ?>">
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_ReportsTo" class="form-group">
<input type="text" data-table="musers" data-field="x_ReportsTo" name="x<?php echo $musers_list->RowIndex ?>_ReportsTo" id="x<?php echo $musers_list->RowIndex ?>_ReportsTo" size="30" placeholder="<?php echo HtmlEncode($musers_list->ReportsTo->getPlaceHolder()) ?>" value="<?php echo $musers_list->ReportsTo->EditValue ?>"<?php echo $musers_list->ReportsTo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($musers->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $musers_list->RowCount ?>_musers_ReportsTo">
<span<?php echo $musers_list->ReportsTo->viewAttributes() ?>><?php echo $musers_list->ReportsTo->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$musers_list->ListOptions->render("body", "right", $musers_list->RowCount);
?>
	</tr>
<?php if ($musers->RowType == ROWTYPE_ADD || $musers->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fmuserslist", "load"], function() {
	fmuserslist.updateLists(<?php echo $musers_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$musers_list->isGridAdd())
		if (!$musers_list->Recordset->EOF)
			$musers_list->Recordset->moveNext();
}
?>
<?php
	if ($musers_list->isGridAdd() || $musers_list->isGridEdit()) {
		$musers_list->RowIndex = '$rowindex$';
		$musers_list->loadRowValues();

		// Set row properties
		$musers->resetAttributes();
		$musers->RowAttrs->merge(["data-rowindex" => $musers_list->RowIndex, "id" => "r0_musers", "data-rowtype" => ROWTYPE_ADD]);
		$musers->RowAttrs->appendClass("ew-template");
		$musers->RowType = ROWTYPE_ADD;

		// Render row
		$musers_list->renderRow();

		// Render list options
		$musers_list->renderListOptions();
		$musers_list->StartRowCount = 0;
?>
	<tr <?php echo $musers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$musers_list->ListOptions->render("body", "left", $musers_list->RowIndex);
?>
	<?php if ($musers_list->UserCode->Visible) { // UserCode ?>
		<td data-name="UserCode">
<span id="el$rowindex$_musers_UserCode" class="form-group musers_UserCode"></span>
<input type="hidden" data-table="musers" data-field="x_UserCode" name="o<?php echo $musers_list->RowIndex ?>_UserCode" id="o<?php echo $musers_list->RowIndex ?>_UserCode" value="<?php echo HtmlEncode($musers_list->UserCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->UserName->Visible) { // UserName ?>
		<td data-name="UserName">
<span id="el$rowindex$_musers_UserName" class="form-group musers_UserName">
<input type="text" data-table="musers" data-field="x_UserName" name="x<?php echo $musers_list->RowIndex ?>_UserName" id="x<?php echo $musers_list->RowIndex ?>_UserName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->UserName->getPlaceHolder()) ?>" value="<?php echo $musers_list->UserName->EditValue ?>"<?php echo $musers_list->UserName->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_UserName" name="o<?php echo $musers_list->RowIndex ?>_UserName" id="o<?php echo $musers_list->RowIndex ?>_UserName" value="<?php echo HtmlEncode($musers_list->UserName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->Password->Visible) { // Password ?>
		<td data-name="Password">
<span id="el$rowindex$_musers_Password" class="form-group musers_Password">
<div class="input-group" id="ig<?php echo $musers_list->RowIndex ?>_Password">
<input type="password" autocomplete="new-password" data-password-strength="pst<?php echo $musers_list->RowIndex ?>_Password" data-table="musers" data-field="x_Password" name="x<?php echo $musers_list->RowIndex ?>_Password" id="x<?php echo $musers_list->RowIndex ?>_Password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->Password->getPlaceHolder()) ?>"<?php echo $musers_list->Password->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x<?php echo $musers_list->RowIndex ?>_Password" data-password-confirm="c<?php echo $musers_list->RowIndex ?>_Password" data-password-strength="pst<?php echo $musers_list->RowIndex ?>_Password"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst<?php echo $musers_list->RowIndex ?>_Password">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<input type="hidden" data-table="musers" data-field="x_Password" name="o<?php echo $musers_list->RowIndex ?>_Password" id="o<?php echo $musers_list->RowIndex ?>_Password" value="<?php echo HtmlEncode($musers_list->Password->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<span id="el$rowindex$_musers_EmployeeID" class="form-group musers_EmployeeID">
<input type="text" data-table="musers" data-field="x_EmployeeID" name="x<?php echo $musers_list->RowIndex ?>_EmployeeID" id="x<?php echo $musers_list->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($musers_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $musers_list->EmployeeID->EditValue ?>"<?php echo $musers_list->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_EmployeeID" name="o<?php echo $musers_list->RowIndex ?>_EmployeeID" id="o<?php echo $musers_list->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($musers_list->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<span id="el$rowindex$_musers_FirstName" class="form-group musers_FirstName">
<input type="text" data-table="musers" data-field="x_FirstName" name="x<?php echo $musers_list->RowIndex ?>_FirstName" id="x<?php echo $musers_list->RowIndex ?>_FirstName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->FirstName->getPlaceHolder()) ?>" value="<?php echo $musers_list->FirstName->EditValue ?>"<?php echo $musers_list->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_FirstName" name="o<?php echo $musers_list->RowIndex ?>_FirstName" id="o<?php echo $musers_list->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($musers_list->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->LastName->Visible) { // LastName ?>
		<td data-name="LastName">
<span id="el$rowindex$_musers_LastName" class="form-group musers_LastName">
<input type="text" data-table="musers" data-field="x_LastName" name="x<?php echo $musers_list->RowIndex ?>_LastName" id="x<?php echo $musers_list->RowIndex ?>_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->LastName->getPlaceHolder()) ?>" value="<?php echo $musers_list->LastName->EditValue ?>"<?php echo $musers_list->LastName->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_LastName" name="o<?php echo $musers_list->RowIndex ?>_LastName" id="o<?php echo $musers_list->RowIndex ?>_LastName" value="<?php echo HtmlEncode($musers_list->LastName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode">
<span id="el$rowindex$_musers_ProvinceCode" class="form-group musers_ProvinceCode">
<?php $musers_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $musers_list->RowIndex ?>_ProvinceCode"><?php echo EmptyValue(strval($musers_list->ProvinceCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $musers_list->ProvinceCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($musers_list->ProvinceCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($musers_list->ProvinceCode->ReadOnly || $musers_list->ProvinceCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $musers_list->RowIndex ?>_ProvinceCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $musers_list->ProvinceCode->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_ProvinceCode") ?>
<input type="hidden" data-table="musers" data-field="x_ProvinceCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $musers_list->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x<?php echo $musers_list->RowIndex ?>_ProvinceCode" id="x<?php echo $musers_list->RowIndex ?>_ProvinceCode" value="<?php echo $musers_list->ProvinceCode->CurrentValue ?>"<?php echo $musers_list->ProvinceCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_ProvinceCode" name="o<?php echo $musers_list->RowIndex ?>_ProvinceCode" id="o<?php echo $musers_list->RowIndex ?>_ProvinceCode" value="<?php echo HtmlEncode($musers_list->ProvinceCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode">
<span id="el$rowindex$_musers_LACode" class="form-group musers_LACode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $musers_list->RowIndex ?>_LACode"><?php echo EmptyValue(strval($musers_list->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $musers_list->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($musers_list->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($musers_list->LACode->ReadOnly || $musers_list->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $musers_list->RowIndex ?>_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $musers_list->LACode->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_LACode") ?>
<input type="hidden" data-table="musers" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $musers_list->LACode->displayValueSeparatorAttribute() ?>" name="x<?php echo $musers_list->RowIndex ?>_LACode" id="x<?php echo $musers_list->RowIndex ?>_LACode" value="<?php echo $musers_list->LACode->CurrentValue ?>"<?php echo $musers_list->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_LACode" name="o<?php echo $musers_list->RowIndex ?>_LACode" id="o<?php echo $musers_list->RowIndex ?>_LACode" value="<?php echo HtmlEncode($musers_list->LACode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->Level->Visible) { // Level ?>
		<td data-name="Level">
<span id="el$rowindex$_musers_Level" class="form-group musers_Level">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Level" data-value-separator="<?php echo $musers_list->Level->displayValueSeparatorAttribute() ?>" id="x<?php echo $musers_list->RowIndex ?>_Level" name="x<?php echo $musers_list->RowIndex ?>_Level"<?php echo $musers_list->Level->editAttributes() ?>>
			<?php echo $musers_list->Level->selectOptionListHtml("x{$musers_list->RowIndex}_Level") ?>
		</select>
</div>
<?php echo $musers_list->Level->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_Level") ?>
</span>
<input type="hidden" data-table="musers" data-field="x_Level" name="o<?php echo $musers_list->RowIndex ?>_Level" id="o<?php echo $musers_list->RowIndex ?>_Level" value="<?php echo HtmlEncode($musers_list->Level->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->Role->Visible) { // Role ?>
		<td data-name="Role">
<span id="el$rowindex$_musers_Role" class="form-group musers_Role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Role" data-value-separator="<?php echo $musers_list->Role->displayValueSeparatorAttribute() ?>" id="x<?php echo $musers_list->RowIndex ?>_Role" name="x<?php echo $musers_list->RowIndex ?>_Role"<?php echo $musers_list->Role->editAttributes() ?>>
			<?php echo $musers_list->Role->selectOptionListHtml("x{$musers_list->RowIndex}_Role") ?>
		</select>
</div>
<?php echo $musers_list->Role->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_Role") ?>
</span>
<input type="hidden" data-table="musers" data-field="x_Role" name="o<?php echo $musers_list->RowIndex ?>_Role" id="o<?php echo $musers_list->RowIndex ?>_Role" value="<?php echo HtmlEncode($musers_list->Role->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->Clearance->Visible) { // Clearance ?>
		<td data-name="Clearance">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el$rowindex$_musers_Clearance" class="form-group musers_Clearance">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($musers_list->Clearance->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_musers_Clearance" class="form-group musers_Clearance">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Clearance" data-value-separator="<?php echo $musers_list->Clearance->displayValueSeparatorAttribute() ?>" id="x<?php echo $musers_list->RowIndex ?>_Clearance" name="x<?php echo $musers_list->RowIndex ?>_Clearance"<?php echo $musers_list->Clearance->editAttributes() ?>>
			<?php echo $musers_list->Clearance->selectOptionListHtml("x{$musers_list->RowIndex}_Clearance") ?>
		</select>
</div>
<?php echo $musers_list->Clearance->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_Clearance") ?>
</span>
<?php } ?>
<input type="hidden" data-table="musers" data-field="x_Clearance" name="o<?php echo $musers_list->RowIndex ?>_Clearance" id="o<?php echo $musers_list->RowIndex ?>_Clearance" value="<?php echo HtmlEncode($musers_list->Clearance->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->OrganisationLevel->Visible) { // OrganisationLevel ?>
		<td data-name="OrganisationLevel">
<span id="el$rowindex$_musers_OrganisationLevel" class="form-group musers_OrganisationLevel">
<input type="text" data-table="musers" data-field="x_OrganisationLevel" name="x<?php echo $musers_list->RowIndex ?>_OrganisationLevel" id="x<?php echo $musers_list->RowIndex ?>_OrganisationLevel" size="30" placeholder="<?php echo HtmlEncode($musers_list->OrganisationLevel->getPlaceHolder()) ?>" value="<?php echo $musers_list->OrganisationLevel->EditValue ?>"<?php echo $musers_list->OrganisationLevel->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_OrganisationLevel" name="o<?php echo $musers_list->RowIndex ?>_OrganisationLevel" id="o<?php echo $musers_list->RowIndex ?>_OrganisationLevel" value="<?php echo HtmlEncode($musers_list->OrganisationLevel->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->Active->Visible) { // Active ?>
		<td data-name="Active">
<span id="el$rowindex$_musers_Active" class="form-group musers_Active">
<div id="tp_x<?php echo $musers_list->RowIndex ?>_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="musers" data-field="x_Active" data-value-separator="<?php echo $musers_list->Active->displayValueSeparatorAttribute() ?>" name="x<?php echo $musers_list->RowIndex ?>_Active" id="x<?php echo $musers_list->RowIndex ?>_Active" value="{value}"<?php echo $musers_list->Active->editAttributes() ?>></div>
<div id="dsl_x<?php echo $musers_list->RowIndex ?>_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $musers_list->Active->radioButtonListHtml(FALSE, "x{$musers_list->RowIndex}_Active") ?>
</div></div>
<?php echo $musers_list->Active->Lookup->getParamTag($musers_list, "p_x" . $musers_list->RowIndex . "_Active") ?>
</span>
<input type="hidden" data-table="musers" data-field="x_Active" name="o<?php echo $musers_list->RowIndex ?>_Active" id="o<?php echo $musers_list->RowIndex ?>_Active" value="<?php echo HtmlEncode($musers_list->Active->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->_Email->Visible) { // Email ?>
		<td data-name="_Email">
<span id="el$rowindex$_musers__Email" class="form-group musers__Email">
<input type="text" data-table="musers" data-field="x__Email" name="x<?php echo $musers_list->RowIndex ?>__Email" id="x<?php echo $musers_list->RowIndex ?>__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->_Email->getPlaceHolder()) ?>" value="<?php echo $musers_list->_Email->EditValue ?>"<?php echo $musers_list->_Email->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x__Email" name="o<?php echo $musers_list->RowIndex ?>__Email" id="o<?php echo $musers_list->RowIndex ?>__Email" value="<?php echo HtmlEncode($musers_list->_Email->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone">
<span id="el$rowindex$_musers_Telephone" class="form-group musers_Telephone">
<input type="text" data-table="musers" data-field="x_Telephone" name="x<?php echo $musers_list->RowIndex ?>_Telephone" id="x<?php echo $musers_list->RowIndex ?>_Telephone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_list->Telephone->getPlaceHolder()) ?>" value="<?php echo $musers_list->Telephone->EditValue ?>"<?php echo $musers_list->Telephone->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_Telephone" name="o<?php echo $musers_list->RowIndex ?>_Telephone" id="o<?php echo $musers_list->RowIndex ?>_Telephone" value="<?php echo HtmlEncode($musers_list->Telephone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile">
<span id="el$rowindex$_musers_Mobile" class="form-group musers_Mobile">
<input type="text" data-table="musers" data-field="x_Mobile" name="x<?php echo $musers_list->RowIndex ?>_Mobile" id="x<?php echo $musers_list->RowIndex ?>_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($musers_list->Mobile->getPlaceHolder()) ?>" value="<?php echo $musers_list->Mobile->EditValue ?>"<?php echo $musers_list->Mobile->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_Mobile" name="o<?php echo $musers_list->RowIndex ?>_Mobile" id="o<?php echo $musers_list->RowIndex ?>_Mobile" value="<?php echo HtmlEncode($musers_list->Mobile->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->Position->Visible) { // Position ?>
		<td data-name="Position">
<span id="el$rowindex$_musers_Position" class="form-group musers_Position">
<input type="text" data-table="musers" data-field="x_Position" name="x<?php echo $musers_list->RowIndex ?>_Position" id="x<?php echo $musers_list->RowIndex ?>_Position" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($musers_list->Position->getPlaceHolder()) ?>" value="<?php echo $musers_list->Position->EditValue ?>"<?php echo $musers_list->Position->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_Position" name="o<?php echo $musers_list->RowIndex ?>_Position" id="o<?php echo $musers_list->RowIndex ?>_Position" value="<?php echo HtmlEncode($musers_list->Position->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($musers_list->ReportsTo->Visible) { // ReportsTo ?>
		<td data-name="ReportsTo">
<span id="el$rowindex$_musers_ReportsTo" class="form-group musers_ReportsTo">
<input type="text" data-table="musers" data-field="x_ReportsTo" name="x<?php echo $musers_list->RowIndex ?>_ReportsTo" id="x<?php echo $musers_list->RowIndex ?>_ReportsTo" size="30" placeholder="<?php echo HtmlEncode($musers_list->ReportsTo->getPlaceHolder()) ?>" value="<?php echo $musers_list->ReportsTo->EditValue ?>"<?php echo $musers_list->ReportsTo->editAttributes() ?>>
</span>
<input type="hidden" data-table="musers" data-field="x_ReportsTo" name="o<?php echo $musers_list->RowIndex ?>_ReportsTo" id="o<?php echo $musers_list->RowIndex ?>_ReportsTo" value="<?php echo HtmlEncode($musers_list->ReportsTo->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$musers_list->ListOptions->render("body", "right", $musers_list->RowIndex);
?>
<script>
loadjs.ready(["fmuserslist", "load"], function() {
	fmuserslist.updateLists(<?php echo $musers_list->RowIndex ?>);
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
<?php if ($musers_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $musers_list->FormKeyCountName ?>" id="<?php echo $musers_list->FormKeyCountName ?>" value="<?php echo $musers_list->KeyCount ?>">
<?php echo $musers_list->MultiSelectKey ?>
<?php } ?>
<?php if ($musers_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $musers_list->FormKeyCountName ?>" id="<?php echo $musers_list->FormKeyCountName ?>" value="<?php echo $musers_list->KeyCount ?>">
<?php echo $musers_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$musers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($musers_list->Recordset)
	$musers_list->Recordset->Close();
?>
<?php if (!$musers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$musers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $musers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $musers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($musers_list->TotalRecords == 0 && !$musers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $musers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$musers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$musers_list->isExport()) { ?>
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
$musers_list->terminate();
?>