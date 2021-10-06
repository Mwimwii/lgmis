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
$service_provider_list = new service_provider_list();

// Run the page
$service_provider_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$service_provider_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$service_provider_list->isExport()) { ?>
<script>
var fservice_providerlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fservice_providerlist = currentForm = new ew.Form("fservice_providerlist", "list");
	fservice_providerlist.formKeyCountName = '<?php echo $service_provider_list->FormKeyCountName ?>';

	// Validate form
	fservice_providerlist.validate = function() {
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
			<?php if ($service_provider_list->ServiceProviderID->Required) { ?>
				elm = this.getElements("x" + infix + "_ServiceProviderID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $service_provider_list->ServiceProviderID->caption(), $service_provider_list->ServiceProviderID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ServiceProviderID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($service_provider_list->ServiceProviderID->errorMessage()) ?>");
			<?php if ($service_provider_list->SPName->Required) { ?>
				elm = this.getElements("x" + infix + "_SPName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $service_provider_list->SPName->caption(), $service_provider_list->SPName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($service_provider_list->SPType->Required) { ?>
				elm = this.getElements("x" + infix + "_SPType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $service_provider_list->SPType->caption(), $service_provider_list->SPType->RequiredErrorMessage)) ?>");
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
	fservice_providerlist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ServiceProviderID", false)) return false;
		if (ew.valueChanged(fobj, infix, "SPName", false)) return false;
		if (ew.valueChanged(fobj, infix, "SPType", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fservice_providerlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fservice_providerlist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fservice_providerlist.lists["x_SPType"] = <?php echo $service_provider_list->SPType->Lookup->toClientList($service_provider_list) ?>;
	fservice_providerlist.lists["x_SPType"].options = <?php echo JsonEncode($service_provider_list->SPType->lookupOptions()) ?>;
	loadjs.done("fservice_providerlist");
});
var fservice_providerlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fservice_providerlistsrch = currentSearchForm = new ew.Form("fservice_providerlistsrch");

	// Dynamic selection lists
	// Filters

	fservice_providerlistsrch.filterList = <?php echo $service_provider_list->getFilterList() ?>;

	// Init search panel as collapsed
	fservice_providerlistsrch.initSearchPanel = true;
	loadjs.done("fservice_providerlistsrch");
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
<?php if (!$service_provider_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($service_provider_list->TotalRecords > 0 && $service_provider_list->ExportOptions->visible()) { ?>
<?php $service_provider_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($service_provider_list->ImportOptions->visible()) { ?>
<?php $service_provider_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($service_provider_list->SearchOptions->visible()) { ?>
<?php $service_provider_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($service_provider_list->FilterOptions->visible()) { ?>
<?php $service_provider_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$service_provider_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$service_provider_list->isExport() && !$service_provider->CurrentAction) { ?>
<form name="fservice_providerlistsrch" id="fservice_providerlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fservice_providerlistsrch-search-panel" class="<?php echo $service_provider_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="service_provider">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $service_provider_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($service_provider_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($service_provider_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $service_provider_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($service_provider_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($service_provider_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($service_provider_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($service_provider_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $service_provider_list->showPageHeader(); ?>
<?php
$service_provider_list->showMessage();
?>
<?php if ($service_provider_list->TotalRecords > 0 || $service_provider->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($service_provider_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> service_provider">
<?php if (!$service_provider_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$service_provider_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $service_provider_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $service_provider_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fservice_providerlist" id="fservice_providerlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="service_provider">
<div id="gmp_service_provider" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($service_provider_list->TotalRecords > 0 || $service_provider_list->isGridEdit()) { ?>
<table id="tbl_service_providerlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$service_provider->RowType = ROWTYPE_HEADER;

// Render list options
$service_provider_list->renderListOptions();

// Render list options (header, left)
$service_provider_list->ListOptions->render("header", "left");
?>
<?php if ($service_provider_list->ServiceProviderID->Visible) { // ServiceProviderID ?>
	<?php if ($service_provider_list->SortUrl($service_provider_list->ServiceProviderID) == "") { ?>
		<th data-name="ServiceProviderID" class="<?php echo $service_provider_list->ServiceProviderID->headerCellClass() ?>"><div id="elh_service_provider_ServiceProviderID" class="service_provider_ServiceProviderID"><div class="ew-table-header-caption"><?php echo $service_provider_list->ServiceProviderID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ServiceProviderID" class="<?php echo $service_provider_list->ServiceProviderID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $service_provider_list->SortUrl($service_provider_list->ServiceProviderID) ?>', 1);"><div id="elh_service_provider_ServiceProviderID" class="service_provider_ServiceProviderID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $service_provider_list->ServiceProviderID->caption() ?></span><span class="ew-table-header-sort"><?php if ($service_provider_list->ServiceProviderID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($service_provider_list->ServiceProviderID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($service_provider_list->SPName->Visible) { // SPName ?>
	<?php if ($service_provider_list->SortUrl($service_provider_list->SPName) == "") { ?>
		<th data-name="SPName" class="<?php echo $service_provider_list->SPName->headerCellClass() ?>"><div id="elh_service_provider_SPName" class="service_provider_SPName"><div class="ew-table-header-caption"><?php echo $service_provider_list->SPName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SPName" class="<?php echo $service_provider_list->SPName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $service_provider_list->SortUrl($service_provider_list->SPName) ?>', 1);"><div id="elh_service_provider_SPName" class="service_provider_SPName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $service_provider_list->SPName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($service_provider_list->SPName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($service_provider_list->SPName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($service_provider_list->SPType->Visible) { // SPType ?>
	<?php if ($service_provider_list->SortUrl($service_provider_list->SPType) == "") { ?>
		<th data-name="SPType" class="<?php echo $service_provider_list->SPType->headerCellClass() ?>"><div id="elh_service_provider_SPType" class="service_provider_SPType"><div class="ew-table-header-caption"><?php echo $service_provider_list->SPType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SPType" class="<?php echo $service_provider_list->SPType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $service_provider_list->SortUrl($service_provider_list->SPType) ?>', 1);"><div id="elh_service_provider_SPType" class="service_provider_SPType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $service_provider_list->SPType->caption() ?></span><span class="ew-table-header-sort"><?php if ($service_provider_list->SPType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($service_provider_list->SPType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$service_provider_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($service_provider_list->ExportAll && $service_provider_list->isExport()) {
	$service_provider_list->StopRecord = $service_provider_list->TotalRecords;
} else {

	// Set the last record to display
	if ($service_provider_list->TotalRecords > $service_provider_list->StartRecord + $service_provider_list->DisplayRecords - 1)
		$service_provider_list->StopRecord = $service_provider_list->StartRecord + $service_provider_list->DisplayRecords - 1;
	else
		$service_provider_list->StopRecord = $service_provider_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($service_provider->isConfirm() || $service_provider_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($service_provider_list->FormKeyCountName) && ($service_provider_list->isGridAdd() || $service_provider_list->isGridEdit() || $service_provider->isConfirm())) {
		$service_provider_list->KeyCount = $CurrentForm->getValue($service_provider_list->FormKeyCountName);
		$service_provider_list->StopRecord = $service_provider_list->StartRecord + $service_provider_list->KeyCount - 1;
	}
}
$service_provider_list->RecordCount = $service_provider_list->StartRecord - 1;
if ($service_provider_list->Recordset && !$service_provider_list->Recordset->EOF) {
	$service_provider_list->Recordset->moveFirst();
	$selectLimit = $service_provider_list->UseSelectLimit;
	if (!$selectLimit && $service_provider_list->StartRecord > 1)
		$service_provider_list->Recordset->move($service_provider_list->StartRecord - 1);
} elseif (!$service_provider->AllowAddDeleteRow && $service_provider_list->StopRecord == 0) {
	$service_provider_list->StopRecord = $service_provider->GridAddRowCount;
}

// Initialize aggregate
$service_provider->RowType = ROWTYPE_AGGREGATEINIT;
$service_provider->resetAttributes();
$service_provider_list->renderRow();
if ($service_provider_list->isGridAdd())
	$service_provider_list->RowIndex = 0;
if ($service_provider_list->isGridEdit())
	$service_provider_list->RowIndex = 0;
while ($service_provider_list->RecordCount < $service_provider_list->StopRecord) {
	$service_provider_list->RecordCount++;
	if ($service_provider_list->RecordCount >= $service_provider_list->StartRecord) {
		$service_provider_list->RowCount++;
		if ($service_provider_list->isGridAdd() || $service_provider_list->isGridEdit() || $service_provider->isConfirm()) {
			$service_provider_list->RowIndex++;
			$CurrentForm->Index = $service_provider_list->RowIndex;
			if ($CurrentForm->hasValue($service_provider_list->FormActionName) && ($service_provider->isConfirm() || $service_provider_list->EventCancelled))
				$service_provider_list->RowAction = strval($CurrentForm->getValue($service_provider_list->FormActionName));
			elseif ($service_provider_list->isGridAdd())
				$service_provider_list->RowAction = "insert";
			else
				$service_provider_list->RowAction = "";
		}

		// Set up key count
		$service_provider_list->KeyCount = $service_provider_list->RowIndex;

		// Init row class and style
		$service_provider->resetAttributes();
		$service_provider->CssClass = "";
		if ($service_provider_list->isGridAdd()) {
			$service_provider_list->loadRowValues(); // Load default values
		} else {
			$service_provider_list->loadRowValues($service_provider_list->Recordset); // Load row values
		}
		$service_provider->RowType = ROWTYPE_VIEW; // Render view
		if ($service_provider_list->isGridAdd()) // Grid add
			$service_provider->RowType = ROWTYPE_ADD; // Render add
		if ($service_provider_list->isGridAdd() && $service_provider->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$service_provider_list->restoreCurrentRowFormValues($service_provider_list->RowIndex); // Restore form values
		if ($service_provider_list->isGridEdit()) { // Grid edit
			if ($service_provider->EventCancelled)
				$service_provider_list->restoreCurrentRowFormValues($service_provider_list->RowIndex); // Restore form values
			if ($service_provider_list->RowAction == "insert")
				$service_provider->RowType = ROWTYPE_ADD; // Render add
			else
				$service_provider->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($service_provider_list->isGridEdit() && ($service_provider->RowType == ROWTYPE_EDIT || $service_provider->RowType == ROWTYPE_ADD) && $service_provider->EventCancelled) // Update failed
			$service_provider_list->restoreCurrentRowFormValues($service_provider_list->RowIndex); // Restore form values
		if ($service_provider->RowType == ROWTYPE_EDIT) // Edit row
			$service_provider_list->EditRowCount++;

		// Set up row id / data-rowindex
		$service_provider->RowAttrs->merge(["data-rowindex" => $service_provider_list->RowCount, "id" => "r" . $service_provider_list->RowCount . "_service_provider", "data-rowtype" => $service_provider->RowType]);

		// Render row
		$service_provider_list->renderRow();

		// Render list options
		$service_provider_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($service_provider_list->RowAction != "delete" && $service_provider_list->RowAction != "insertdelete" && !($service_provider_list->RowAction == "insert" && $service_provider->isConfirm() && $service_provider_list->emptyRow())) {
?>
	<tr <?php echo $service_provider->rowAttributes() ?>>
<?php

// Render list options (body, left)
$service_provider_list->ListOptions->render("body", "left", $service_provider_list->RowCount);
?>
	<?php if ($service_provider_list->ServiceProviderID->Visible) { // ServiceProviderID ?>
		<td data-name="ServiceProviderID" <?php echo $service_provider_list->ServiceProviderID->cellAttributes() ?>>
<?php if ($service_provider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $service_provider_list->RowCount ?>_service_provider_ServiceProviderID" class="form-group">
<input type="text" data-table="service_provider" data-field="x_ServiceProviderID" name="x<?php echo $service_provider_list->RowIndex ?>_ServiceProviderID" id="x<?php echo $service_provider_list->RowIndex ?>_ServiceProviderID" size="30" placeholder="<?php echo HtmlEncode($service_provider_list->ServiceProviderID->getPlaceHolder()) ?>" value="<?php echo $service_provider_list->ServiceProviderID->EditValue ?>"<?php echo $service_provider_list->ServiceProviderID->editAttributes() ?>>
</span>
<input type="hidden" data-table="service_provider" data-field="x_ServiceProviderID" name="o<?php echo $service_provider_list->RowIndex ?>_ServiceProviderID" id="o<?php echo $service_provider_list->RowIndex ?>_ServiceProviderID" value="<?php echo HtmlEncode($service_provider_list->ServiceProviderID->OldValue) ?>">
<?php } ?>
<?php if ($service_provider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="service_provider" data-field="x_ServiceProviderID" name="x<?php echo $service_provider_list->RowIndex ?>_ServiceProviderID" id="x<?php echo $service_provider_list->RowIndex ?>_ServiceProviderID" size="30" placeholder="<?php echo HtmlEncode($service_provider_list->ServiceProviderID->getPlaceHolder()) ?>" value="<?php echo $service_provider_list->ServiceProviderID->EditValue ?>"<?php echo $service_provider_list->ServiceProviderID->editAttributes() ?>>
<input type="hidden" data-table="service_provider" data-field="x_ServiceProviderID" name="o<?php echo $service_provider_list->RowIndex ?>_ServiceProviderID" id="o<?php echo $service_provider_list->RowIndex ?>_ServiceProviderID" value="<?php echo HtmlEncode($service_provider_list->ServiceProviderID->OldValue != null ? $service_provider_list->ServiceProviderID->OldValue : $service_provider_list->ServiceProviderID->CurrentValue) ?>">
<?php } ?>
<?php if ($service_provider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $service_provider_list->RowCount ?>_service_provider_ServiceProviderID">
<span<?php echo $service_provider_list->ServiceProviderID->viewAttributes() ?>><?php echo $service_provider_list->ServiceProviderID->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($service_provider_list->SPName->Visible) { // SPName ?>
		<td data-name="SPName" <?php echo $service_provider_list->SPName->cellAttributes() ?>>
<?php if ($service_provider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $service_provider_list->RowCount ?>_service_provider_SPName" class="form-group">
<input type="text" data-table="service_provider" data-field="x_SPName" name="x<?php echo $service_provider_list->RowIndex ?>_SPName" id="x<?php echo $service_provider_list->RowIndex ?>_SPName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($service_provider_list->SPName->getPlaceHolder()) ?>" value="<?php echo $service_provider_list->SPName->EditValue ?>"<?php echo $service_provider_list->SPName->editAttributes() ?>>
</span>
<input type="hidden" data-table="service_provider" data-field="x_SPName" name="o<?php echo $service_provider_list->RowIndex ?>_SPName" id="o<?php echo $service_provider_list->RowIndex ?>_SPName" value="<?php echo HtmlEncode($service_provider_list->SPName->OldValue) ?>">
<?php } ?>
<?php if ($service_provider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $service_provider_list->RowCount ?>_service_provider_SPName" class="form-group">
<input type="text" data-table="service_provider" data-field="x_SPName" name="x<?php echo $service_provider_list->RowIndex ?>_SPName" id="x<?php echo $service_provider_list->RowIndex ?>_SPName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($service_provider_list->SPName->getPlaceHolder()) ?>" value="<?php echo $service_provider_list->SPName->EditValue ?>"<?php echo $service_provider_list->SPName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($service_provider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $service_provider_list->RowCount ?>_service_provider_SPName">
<span<?php echo $service_provider_list->SPName->viewAttributes() ?>><?php echo $service_provider_list->SPName->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($service_provider_list->SPType->Visible) { // SPType ?>
		<td data-name="SPType" <?php echo $service_provider_list->SPType->cellAttributes() ?>>
<?php if ($service_provider->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $service_provider_list->RowCount ?>_service_provider_SPType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="service_provider" data-field="x_SPType" data-value-separator="<?php echo $service_provider_list->SPType->displayValueSeparatorAttribute() ?>" id="x<?php echo $service_provider_list->RowIndex ?>_SPType" name="x<?php echo $service_provider_list->RowIndex ?>_SPType"<?php echo $service_provider_list->SPType->editAttributes() ?>>
			<?php echo $service_provider_list->SPType->selectOptionListHtml("x{$service_provider_list->RowIndex}_SPType") ?>
		</select>
</div>
<?php echo $service_provider_list->SPType->Lookup->getParamTag($service_provider_list, "p_x" . $service_provider_list->RowIndex . "_SPType") ?>
</span>
<input type="hidden" data-table="service_provider" data-field="x_SPType" name="o<?php echo $service_provider_list->RowIndex ?>_SPType" id="o<?php echo $service_provider_list->RowIndex ?>_SPType" value="<?php echo HtmlEncode($service_provider_list->SPType->OldValue) ?>">
<?php } ?>
<?php if ($service_provider->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $service_provider_list->RowCount ?>_service_provider_SPType" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="service_provider" data-field="x_SPType" data-value-separator="<?php echo $service_provider_list->SPType->displayValueSeparatorAttribute() ?>" id="x<?php echo $service_provider_list->RowIndex ?>_SPType" name="x<?php echo $service_provider_list->RowIndex ?>_SPType"<?php echo $service_provider_list->SPType->editAttributes() ?>>
			<?php echo $service_provider_list->SPType->selectOptionListHtml("x{$service_provider_list->RowIndex}_SPType") ?>
		</select>
</div>
<?php echo $service_provider_list->SPType->Lookup->getParamTag($service_provider_list, "p_x" . $service_provider_list->RowIndex . "_SPType") ?>
</span>
<?php } ?>
<?php if ($service_provider->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $service_provider_list->RowCount ?>_service_provider_SPType">
<span<?php echo $service_provider_list->SPType->viewAttributes() ?>><?php echo $service_provider_list->SPType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$service_provider_list->ListOptions->render("body", "right", $service_provider_list->RowCount);
?>
	</tr>
<?php if ($service_provider->RowType == ROWTYPE_ADD || $service_provider->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fservice_providerlist", "load"], function() {
	fservice_providerlist.updateLists(<?php echo $service_provider_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$service_provider_list->isGridAdd())
		if (!$service_provider_list->Recordset->EOF)
			$service_provider_list->Recordset->moveNext();
}
?>
<?php
	if ($service_provider_list->isGridAdd() || $service_provider_list->isGridEdit()) {
		$service_provider_list->RowIndex = '$rowindex$';
		$service_provider_list->loadRowValues();

		// Set row properties
		$service_provider->resetAttributes();
		$service_provider->RowAttrs->merge(["data-rowindex" => $service_provider_list->RowIndex, "id" => "r0_service_provider", "data-rowtype" => ROWTYPE_ADD]);
		$service_provider->RowAttrs->appendClass("ew-template");
		$service_provider->RowType = ROWTYPE_ADD;

		// Render row
		$service_provider_list->renderRow();

		// Render list options
		$service_provider_list->renderListOptions();
		$service_provider_list->StartRowCount = 0;
?>
	<tr <?php echo $service_provider->rowAttributes() ?>>
<?php

// Render list options (body, left)
$service_provider_list->ListOptions->render("body", "left", $service_provider_list->RowIndex);
?>
	<?php if ($service_provider_list->ServiceProviderID->Visible) { // ServiceProviderID ?>
		<td data-name="ServiceProviderID">
<span id="el$rowindex$_service_provider_ServiceProviderID" class="form-group service_provider_ServiceProviderID">
<input type="text" data-table="service_provider" data-field="x_ServiceProviderID" name="x<?php echo $service_provider_list->RowIndex ?>_ServiceProviderID" id="x<?php echo $service_provider_list->RowIndex ?>_ServiceProviderID" size="30" placeholder="<?php echo HtmlEncode($service_provider_list->ServiceProviderID->getPlaceHolder()) ?>" value="<?php echo $service_provider_list->ServiceProviderID->EditValue ?>"<?php echo $service_provider_list->ServiceProviderID->editAttributes() ?>>
</span>
<input type="hidden" data-table="service_provider" data-field="x_ServiceProviderID" name="o<?php echo $service_provider_list->RowIndex ?>_ServiceProviderID" id="o<?php echo $service_provider_list->RowIndex ?>_ServiceProviderID" value="<?php echo HtmlEncode($service_provider_list->ServiceProviderID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($service_provider_list->SPName->Visible) { // SPName ?>
		<td data-name="SPName">
<span id="el$rowindex$_service_provider_SPName" class="form-group service_provider_SPName">
<input type="text" data-table="service_provider" data-field="x_SPName" name="x<?php echo $service_provider_list->RowIndex ?>_SPName" id="x<?php echo $service_provider_list->RowIndex ?>_SPName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($service_provider_list->SPName->getPlaceHolder()) ?>" value="<?php echo $service_provider_list->SPName->EditValue ?>"<?php echo $service_provider_list->SPName->editAttributes() ?>>
</span>
<input type="hidden" data-table="service_provider" data-field="x_SPName" name="o<?php echo $service_provider_list->RowIndex ?>_SPName" id="o<?php echo $service_provider_list->RowIndex ?>_SPName" value="<?php echo HtmlEncode($service_provider_list->SPName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($service_provider_list->SPType->Visible) { // SPType ?>
		<td data-name="SPType">
<span id="el$rowindex$_service_provider_SPType" class="form-group service_provider_SPType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="service_provider" data-field="x_SPType" data-value-separator="<?php echo $service_provider_list->SPType->displayValueSeparatorAttribute() ?>" id="x<?php echo $service_provider_list->RowIndex ?>_SPType" name="x<?php echo $service_provider_list->RowIndex ?>_SPType"<?php echo $service_provider_list->SPType->editAttributes() ?>>
			<?php echo $service_provider_list->SPType->selectOptionListHtml("x{$service_provider_list->RowIndex}_SPType") ?>
		</select>
</div>
<?php echo $service_provider_list->SPType->Lookup->getParamTag($service_provider_list, "p_x" . $service_provider_list->RowIndex . "_SPType") ?>
</span>
<input type="hidden" data-table="service_provider" data-field="x_SPType" name="o<?php echo $service_provider_list->RowIndex ?>_SPType" id="o<?php echo $service_provider_list->RowIndex ?>_SPType" value="<?php echo HtmlEncode($service_provider_list->SPType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$service_provider_list->ListOptions->render("body", "right", $service_provider_list->RowIndex);
?>
<script>
loadjs.ready(["fservice_providerlist", "load"], function() {
	fservice_providerlist.updateLists(<?php echo $service_provider_list->RowIndex ?>);
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
<?php if ($service_provider_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $service_provider_list->FormKeyCountName ?>" id="<?php echo $service_provider_list->FormKeyCountName ?>" value="<?php echo $service_provider_list->KeyCount ?>">
<?php echo $service_provider_list->MultiSelectKey ?>
<?php } ?>
<?php if ($service_provider_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $service_provider_list->FormKeyCountName ?>" id="<?php echo $service_provider_list->FormKeyCountName ?>" value="<?php echo $service_provider_list->KeyCount ?>">
<?php echo $service_provider_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$service_provider->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($service_provider_list->Recordset)
	$service_provider_list->Recordset->Close();
?>
<?php if (!$service_provider_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$service_provider_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $service_provider_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $service_provider_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($service_provider_list->TotalRecords == 0 && !$service_provider->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $service_provider_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$service_provider_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$service_provider_list->isExport()) { ?>
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
$service_provider_list->terminate();
?>