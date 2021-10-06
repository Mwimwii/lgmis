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
$account_type_list = new account_type_list();

// Run the page
$account_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$account_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$account_type_list->isExport()) { ?>
<script>
var faccount_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	faccount_typelist = currentForm = new ew.Form("faccount_typelist", "list");
	faccount_typelist.formKeyCountName = '<?php echo $account_type_list->FormKeyCountName ?>';

	// Validate form
	faccount_typelist.validate = function() {
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
			<?php if ($account_type_list->AccountTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $account_type_list->AccountTypeCode->caption(), $account_type_list->AccountTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountTypeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($account_type_list->AccountTypeCode->errorMessage()) ?>");
			<?php if ($account_type_list->AccountType->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $account_type_list->AccountType->caption(), $account_type_list->AccountType->RequiredErrorMessage)) ?>");
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
	faccount_typelist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "AccountTypeCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "AccountType", false)) return false;
		return true;
	}

	// Form_CustomValidate
	faccount_typelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	faccount_typelist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("faccount_typelist");
});
var faccount_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	faccount_typelistsrch = currentSearchForm = new ew.Form("faccount_typelistsrch");

	// Dynamic selection lists
	// Filters

	faccount_typelistsrch.filterList = <?php echo $account_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	faccount_typelistsrch.initSearchPanel = true;
	loadjs.done("faccount_typelistsrch");
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
<?php if (!$account_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($account_type_list->TotalRecords > 0 && $account_type_list->ExportOptions->visible()) { ?>
<?php $account_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($account_type_list->ImportOptions->visible()) { ?>
<?php $account_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($account_type_list->SearchOptions->visible()) { ?>
<?php $account_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($account_type_list->FilterOptions->visible()) { ?>
<?php $account_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$account_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$account_type_list->isExport() && !$account_type->CurrentAction) { ?>
<form name="faccount_typelistsrch" id="faccount_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="faccount_typelistsrch-search-panel" class="<?php echo $account_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="account_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $account_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($account_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($account_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $account_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($account_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($account_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($account_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($account_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $account_type_list->showPageHeader(); ?>
<?php
$account_type_list->showMessage();
?>
<?php if ($account_type_list->TotalRecords > 0 || $account_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($account_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> account_type">
<?php if (!$account_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$account_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $account_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $account_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="faccount_typelist" id="faccount_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="account_type">
<div id="gmp_account_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($account_type_list->TotalRecords > 0 || $account_type_list->isGridEdit()) { ?>
<table id="tbl_account_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$account_type->RowType = ROWTYPE_HEADER;

// Render list options
$account_type_list->renderListOptions();

// Render list options (header, left)
$account_type_list->ListOptions->render("header", "left");
?>
<?php if ($account_type_list->AccountTypeCode->Visible) { // AccountTypeCode ?>
	<?php if ($account_type_list->SortUrl($account_type_list->AccountTypeCode) == "") { ?>
		<th data-name="AccountTypeCode" class="<?php echo $account_type_list->AccountTypeCode->headerCellClass() ?>"><div id="elh_account_type_AccountTypeCode" class="account_type_AccountTypeCode"><div class="ew-table-header-caption"><?php echo $account_type_list->AccountTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountTypeCode" class="<?php echo $account_type_list->AccountTypeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $account_type_list->SortUrl($account_type_list->AccountTypeCode) ?>', 1);"><div id="elh_account_type_AccountTypeCode" class="account_type_AccountTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_type_list->AccountTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($account_type_list->AccountTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_type_list->AccountTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($account_type_list->AccountType->Visible) { // AccountType ?>
	<?php if ($account_type_list->SortUrl($account_type_list->AccountType) == "") { ?>
		<th data-name="AccountType" class="<?php echo $account_type_list->AccountType->headerCellClass() ?>"><div id="elh_account_type_AccountType" class="account_type_AccountType"><div class="ew-table-header-caption"><?php echo $account_type_list->AccountType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AccountType" class="<?php echo $account_type_list->AccountType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $account_type_list->SortUrl($account_type_list->AccountType) ?>', 1);"><div id="elh_account_type_AccountType" class="account_type_AccountType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $account_type_list->AccountType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($account_type_list->AccountType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($account_type_list->AccountType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$account_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($account_type_list->ExportAll && $account_type_list->isExport()) {
	$account_type_list->StopRecord = $account_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($account_type_list->TotalRecords > $account_type_list->StartRecord + $account_type_list->DisplayRecords - 1)
		$account_type_list->StopRecord = $account_type_list->StartRecord + $account_type_list->DisplayRecords - 1;
	else
		$account_type_list->StopRecord = $account_type_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($account_type->isConfirm() || $account_type_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($account_type_list->FormKeyCountName) && ($account_type_list->isGridAdd() || $account_type_list->isGridEdit() || $account_type->isConfirm())) {
		$account_type_list->KeyCount = $CurrentForm->getValue($account_type_list->FormKeyCountName);
		$account_type_list->StopRecord = $account_type_list->StartRecord + $account_type_list->KeyCount - 1;
	}
}
$account_type_list->RecordCount = $account_type_list->StartRecord - 1;
if ($account_type_list->Recordset && !$account_type_list->Recordset->EOF) {
	$account_type_list->Recordset->moveFirst();
	$selectLimit = $account_type_list->UseSelectLimit;
	if (!$selectLimit && $account_type_list->StartRecord > 1)
		$account_type_list->Recordset->move($account_type_list->StartRecord - 1);
} elseif (!$account_type->AllowAddDeleteRow && $account_type_list->StopRecord == 0) {
	$account_type_list->StopRecord = $account_type->GridAddRowCount;
}

// Initialize aggregate
$account_type->RowType = ROWTYPE_AGGREGATEINIT;
$account_type->resetAttributes();
$account_type_list->renderRow();
if ($account_type_list->isGridAdd())
	$account_type_list->RowIndex = 0;
while ($account_type_list->RecordCount < $account_type_list->StopRecord) {
	$account_type_list->RecordCount++;
	if ($account_type_list->RecordCount >= $account_type_list->StartRecord) {
		$account_type_list->RowCount++;
		if ($account_type_list->isGridAdd() || $account_type_list->isGridEdit() || $account_type->isConfirm()) {
			$account_type_list->RowIndex++;
			$CurrentForm->Index = $account_type_list->RowIndex;
			if ($CurrentForm->hasValue($account_type_list->FormActionName) && ($account_type->isConfirm() || $account_type_list->EventCancelled))
				$account_type_list->RowAction = strval($CurrentForm->getValue($account_type_list->FormActionName));
			elseif ($account_type_list->isGridAdd())
				$account_type_list->RowAction = "insert";
			else
				$account_type_list->RowAction = "";
		}

		// Set up key count
		$account_type_list->KeyCount = $account_type_list->RowIndex;

		// Init row class and style
		$account_type->resetAttributes();
		$account_type->CssClass = "";
		if ($account_type_list->isGridAdd()) {
			$account_type_list->loadRowValues(); // Load default values
		} else {
			$account_type_list->loadRowValues($account_type_list->Recordset); // Load row values
		}
		$account_type->RowType = ROWTYPE_VIEW; // Render view
		if ($account_type_list->isGridAdd()) // Grid add
			$account_type->RowType = ROWTYPE_ADD; // Render add
		if ($account_type_list->isGridAdd() && $account_type->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$account_type_list->restoreCurrentRowFormValues($account_type_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$account_type->RowAttrs->merge(["data-rowindex" => $account_type_list->RowCount, "id" => "r" . $account_type_list->RowCount . "_account_type", "data-rowtype" => $account_type->RowType]);

		// Render row
		$account_type_list->renderRow();

		// Render list options
		$account_type_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($account_type_list->RowAction != "delete" && $account_type_list->RowAction != "insertdelete" && !($account_type_list->RowAction == "insert" && $account_type->isConfirm() && $account_type_list->emptyRow())) {
?>
	<tr <?php echo $account_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$account_type_list->ListOptions->render("body", "left", $account_type_list->RowCount);
?>
	<?php if ($account_type_list->AccountTypeCode->Visible) { // AccountTypeCode ?>
		<td data-name="AccountTypeCode" <?php echo $account_type_list->AccountTypeCode->cellAttributes() ?>>
<?php if ($account_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $account_type_list->RowCount ?>_account_type_AccountTypeCode" class="form-group">
<input type="text" data-table="account_type" data-field="x_AccountTypeCode" name="x<?php echo $account_type_list->RowIndex ?>_AccountTypeCode" id="x<?php echo $account_type_list->RowIndex ?>_AccountTypeCode" placeholder="<?php echo HtmlEncode($account_type_list->AccountTypeCode->getPlaceHolder()) ?>" value="<?php echo $account_type_list->AccountTypeCode->EditValue ?>"<?php echo $account_type_list->AccountTypeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="account_type" data-field="x_AccountTypeCode" name="o<?php echo $account_type_list->RowIndex ?>_AccountTypeCode" id="o<?php echo $account_type_list->RowIndex ?>_AccountTypeCode" value="<?php echo HtmlEncode($account_type_list->AccountTypeCode->OldValue) ?>">
<?php } ?>
<?php if ($account_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $account_type_list->RowCount ?>_account_type_AccountTypeCode">
<span<?php echo $account_type_list->AccountTypeCode->viewAttributes() ?>><?php echo $account_type_list->AccountTypeCode->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($account_type_list->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType" <?php echo $account_type_list->AccountType->cellAttributes() ?>>
<?php if ($account_type->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $account_type_list->RowCount ?>_account_type_AccountType" class="form-group">
<input type="text" data-table="account_type" data-field="x_AccountType" name="x<?php echo $account_type_list->RowIndex ?>_AccountType" id="x<?php echo $account_type_list->RowIndex ?>_AccountType" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($account_type_list->AccountType->getPlaceHolder()) ?>" value="<?php echo $account_type_list->AccountType->EditValue ?>"<?php echo $account_type_list->AccountType->editAttributes() ?>>
</span>
<input type="hidden" data-table="account_type" data-field="x_AccountType" name="o<?php echo $account_type_list->RowIndex ?>_AccountType" id="o<?php echo $account_type_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_type_list->AccountType->OldValue) ?>">
<?php } ?>
<?php if ($account_type->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $account_type_list->RowCount ?>_account_type_AccountType">
<span<?php echo $account_type_list->AccountType->viewAttributes() ?>><?php echo $account_type_list->AccountType->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$account_type_list->ListOptions->render("body", "right", $account_type_list->RowCount);
?>
	</tr>
<?php if ($account_type->RowType == ROWTYPE_ADD || $account_type->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["faccount_typelist", "load"], function() {
	faccount_typelist.updateLists(<?php echo $account_type_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$account_type_list->isGridAdd())
		if (!$account_type_list->Recordset->EOF)
			$account_type_list->Recordset->moveNext();
}
?>
<?php
	if ($account_type_list->isGridAdd() || $account_type_list->isGridEdit()) {
		$account_type_list->RowIndex = '$rowindex$';
		$account_type_list->loadRowValues();

		// Set row properties
		$account_type->resetAttributes();
		$account_type->RowAttrs->merge(["data-rowindex" => $account_type_list->RowIndex, "id" => "r0_account_type", "data-rowtype" => ROWTYPE_ADD]);
		$account_type->RowAttrs->appendClass("ew-template");
		$account_type->RowType = ROWTYPE_ADD;

		// Render row
		$account_type_list->renderRow();

		// Render list options
		$account_type_list->renderListOptions();
		$account_type_list->StartRowCount = 0;
?>
	<tr <?php echo $account_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$account_type_list->ListOptions->render("body", "left", $account_type_list->RowIndex);
?>
	<?php if ($account_type_list->AccountTypeCode->Visible) { // AccountTypeCode ?>
		<td data-name="AccountTypeCode">
<span id="el$rowindex$_account_type_AccountTypeCode" class="form-group account_type_AccountTypeCode">
<input type="text" data-table="account_type" data-field="x_AccountTypeCode" name="x<?php echo $account_type_list->RowIndex ?>_AccountTypeCode" id="x<?php echo $account_type_list->RowIndex ?>_AccountTypeCode" placeholder="<?php echo HtmlEncode($account_type_list->AccountTypeCode->getPlaceHolder()) ?>" value="<?php echo $account_type_list->AccountTypeCode->EditValue ?>"<?php echo $account_type_list->AccountTypeCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="account_type" data-field="x_AccountTypeCode" name="o<?php echo $account_type_list->RowIndex ?>_AccountTypeCode" id="o<?php echo $account_type_list->RowIndex ?>_AccountTypeCode" value="<?php echo HtmlEncode($account_type_list->AccountTypeCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($account_type_list->AccountType->Visible) { // AccountType ?>
		<td data-name="AccountType">
<span id="el$rowindex$_account_type_AccountType" class="form-group account_type_AccountType">
<input type="text" data-table="account_type" data-field="x_AccountType" name="x<?php echo $account_type_list->RowIndex ?>_AccountType" id="x<?php echo $account_type_list->RowIndex ?>_AccountType" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($account_type_list->AccountType->getPlaceHolder()) ?>" value="<?php echo $account_type_list->AccountType->EditValue ?>"<?php echo $account_type_list->AccountType->editAttributes() ?>>
</span>
<input type="hidden" data-table="account_type" data-field="x_AccountType" name="o<?php echo $account_type_list->RowIndex ?>_AccountType" id="o<?php echo $account_type_list->RowIndex ?>_AccountType" value="<?php echo HtmlEncode($account_type_list->AccountType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$account_type_list->ListOptions->render("body", "right", $account_type_list->RowIndex);
?>
<script>
loadjs.ready(["faccount_typelist", "load"], function() {
	faccount_typelist.updateLists(<?php echo $account_type_list->RowIndex ?>);
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
<?php if ($account_type_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $account_type_list->FormKeyCountName ?>" id="<?php echo $account_type_list->FormKeyCountName ?>" value="<?php echo $account_type_list->KeyCount ?>">
<?php echo $account_type_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$account_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($account_type_list->Recordset)
	$account_type_list->Recordset->Close();
?>
<?php if (!$account_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$account_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $account_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $account_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($account_type_list->TotalRecords == 0 && !$account_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $account_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$account_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$account_type_list->isExport()) { ?>
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
$account_type_list->terminate();
?>