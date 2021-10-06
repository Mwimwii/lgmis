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
$vacancy_view_list = new vacancy_view_list();

// Run the page
$vacancy_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vacancy_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$vacancy_view_list->isExport()) { ?>
<script>
var fvacancy_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fvacancy_viewlist = currentForm = new ew.Form("fvacancy_viewlist", "list");
	fvacancy_viewlist.formKeyCountName = '<?php echo $vacancy_view_list->FormKeyCountName ?>';
	loadjs.done("fvacancy_viewlist");
});
var fvacancy_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fvacancy_viewlistsrch = currentSearchForm = new ew.Form("fvacancy_viewlistsrch");

	// Validate function for search
	fvacancy_viewlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_MonthsVacant");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($vacancy_view_list->MonthsVacant->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fvacancy_viewlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fvacancy_viewlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fvacancy_viewlistsrch.lists["x_ProvinceCode"] = <?php echo $vacancy_view_list->ProvinceCode->Lookup->toClientList($vacancy_view_list) ?>;
	fvacancy_viewlistsrch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($vacancy_view_list->ProvinceCode->lookupOptions()) ?>;
	fvacancy_viewlistsrch.lists["x_LACode"] = <?php echo $vacancy_view_list->LACode->Lookup->toClientList($vacancy_view_list) ?>;
	fvacancy_viewlistsrch.lists["x_LACode"].options = <?php echo JsonEncode($vacancy_view_list->LACode->lookupOptions()) ?>;
	fvacancy_viewlistsrch.lists["x_DepartmentCode"] = <?php echo $vacancy_view_list->DepartmentCode->Lookup->toClientList($vacancy_view_list) ?>;
	fvacancy_viewlistsrch.lists["x_DepartmentCode"].options = <?php echo JsonEncode($vacancy_view_list->DepartmentCode->lookupOptions()) ?>;
	fvacancy_viewlistsrch.lists["x_SectionCode"] = <?php echo $vacancy_view_list->SectionCode->Lookup->toClientList($vacancy_view_list) ?>;
	fvacancy_viewlistsrch.lists["x_SectionCode"].options = <?php echo JsonEncode($vacancy_view_list->SectionCode->lookupOptions()) ?>;
	fvacancy_viewlistsrch.lists["x_CouncilType"] = <?php echo $vacancy_view_list->CouncilType->Lookup->toClientList($vacancy_view_list) ?>;
	fvacancy_viewlistsrch.lists["x_CouncilType"].options = <?php echo JsonEncode($vacancy_view_list->CouncilType->lookupOptions()) ?>;

	// Filters
	fvacancy_viewlistsrch.filterList = <?php echo $vacancy_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fvacancy_viewlistsrch.initSearchPanel = true;
	loadjs.done("fvacancy_viewlistsrch");
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
<?php if (!$vacancy_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vacancy_view_list->TotalRecords > 0 && $vacancy_view_list->ExportOptions->visible()) { ?>
<?php $vacancy_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vacancy_view_list->ImportOptions->visible()) { ?>
<?php $vacancy_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vacancy_view_list->SearchOptions->visible()) { ?>
<?php $vacancy_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vacancy_view_list->FilterOptions->visible()) { ?>
<?php $vacancy_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vacancy_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vacancy_view_list->isExport() && !$vacancy_view->CurrentAction) { ?>
<form name="fvacancy_viewlistsrch" id="fvacancy_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fvacancy_viewlistsrch-search-panel" class="<?php echo $vacancy_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vacancy_view">
	<div class="ew-extended-search">
<?php

// Render search row
$vacancy_view->RowType = ROWTYPE_SEARCH;
$vacancy_view->resetAttributes();
$vacancy_view_list->renderRow();
?>
<?php if ($vacancy_view_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php
		$vacancy_view_list->SearchColumnCount++;
		if (($vacancy_view_list->SearchColumnCount - 1) % $vacancy_view_list->SearchFieldsPerRow == 0) {
			$vacancy_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $vacancy_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_ProvinceCode" class="ew-cell form-group">
		<label for="x_ProvinceCode" class="ew-search-caption ew-label"><?php echo $vacancy_view_list->ProvinceCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		<span id="el_vacancy_view_ProvinceCode" class="ew-search-field">
<?php $vacancy_view_list->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vacancy_view" data-field="x_ProvinceCode" data-value-separator="<?php echo $vacancy_view_list->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $vacancy_view_list->ProvinceCode->editAttributes() ?>>
			<?php echo $vacancy_view_list->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $vacancy_view_list->ProvinceCode->Lookup->getParamTag($vacancy_view_list, "p_x_ProvinceCode") ?>
</span>
	</div>
	<?php if ($vacancy_view_list->SearchColumnCount % $vacancy_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->LACode->Visible) { // LACode ?>
	<?php
		$vacancy_view_list->SearchColumnCount++;
		if (($vacancy_view_list->SearchColumnCount - 1) % $vacancy_view_list->SearchFieldsPerRow == 0) {
			$vacancy_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $vacancy_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LACode" class="ew-cell form-group">
		<label for="x_LACode" class="ew-search-caption ew-label"><?php echo $vacancy_view_list->LACode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		<span id="el_vacancy_view_LACode" class="ew-search-field">
<?php $vacancy_view_list->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vacancy_view" data-field="x_LACode" data-value-separator="<?php echo $vacancy_view_list->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $vacancy_view_list->LACode->editAttributes() ?>>
			<?php echo $vacancy_view_list->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $vacancy_view_list->LACode->Lookup->getParamTag($vacancy_view_list, "p_x_LACode") ?>
</span>
	</div>
	<?php if ($vacancy_view_list->SearchColumnCount % $vacancy_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php
		$vacancy_view_list->SearchColumnCount++;
		if (($vacancy_view_list->SearchColumnCount - 1) % $vacancy_view_list->SearchFieldsPerRow == 0) {
			$vacancy_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $vacancy_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_DepartmentCode" class="ew-cell form-group">
		<label for="x_DepartmentCode" class="ew-search-caption ew-label"><?php echo $vacancy_view_list->DepartmentCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DepartmentCode" id="z_DepartmentCode" value="=">
</span>
		<span id="el_vacancy_view_DepartmentCode" class="ew-search-field">
<?php $vacancy_view_list->DepartmentCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vacancy_view" data-field="x_DepartmentCode" data-value-separator="<?php echo $vacancy_view_list->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $vacancy_view_list->DepartmentCode->editAttributes() ?>>
			<?php echo $vacancy_view_list->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $vacancy_view_list->DepartmentCode->Lookup->getParamTag($vacancy_view_list, "p_x_DepartmentCode") ?>
</span>
	</div>
	<?php if ($vacancy_view_list->SearchColumnCount % $vacancy_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->SectionCode->Visible) { // SectionCode ?>
	<?php
		$vacancy_view_list->SearchColumnCount++;
		if (($vacancy_view_list->SearchColumnCount - 1) % $vacancy_view_list->SearchFieldsPerRow == 0) {
			$vacancy_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $vacancy_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_SectionCode" class="ew-cell form-group">
		<label for="x_SectionCode" class="ew-search-caption ew-label"><?php echo $vacancy_view_list->SectionCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SectionCode" id="z_SectionCode" value="=">
</span>
		<span id="el_vacancy_view_SectionCode" class="ew-search-field">
<?php $vacancy_view_list->SectionCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vacancy_view" data-field="x_SectionCode" data-value-separator="<?php echo $vacancy_view_list->SectionCode->displayValueSeparatorAttribute() ?>" id="x_SectionCode" name="x_SectionCode"<?php echo $vacancy_view_list->SectionCode->editAttributes() ?>>
			<?php echo $vacancy_view_list->SectionCode->selectOptionListHtml("x_SectionCode") ?>
		</select>
</div>
<?php echo $vacancy_view_list->SectionCode->Lookup->getParamTag($vacancy_view_list, "p_x_SectionCode") ?>
</span>
	</div>
	<?php if ($vacancy_view_list->SearchColumnCount % $vacancy_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->PositionName->Visible) { // PositionName ?>
	<?php
		$vacancy_view_list->SearchColumnCount++;
		if (($vacancy_view_list->SearchColumnCount - 1) % $vacancy_view_list->SearchFieldsPerRow == 0) {
			$vacancy_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $vacancy_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PositionName" class="ew-cell form-group">
		<label for="x_PositionName" class="ew-search-caption ew-label"><?php echo $vacancy_view_list->PositionName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PositionName" id="z_PositionName" value="LIKE">
</span>
		<span id="el_vacancy_view_PositionName" class="ew-search-field">
<input type="text" data-table="vacancy_view" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vacancy_view_list->PositionName->getPlaceHolder()) ?>" value="<?php echo $vacancy_view_list->PositionName->EditValue ?>"<?php echo $vacancy_view_list->PositionName->editAttributes() ?>>
</span>
	</div>
	<?php if ($vacancy_view_list->SearchColumnCount % $vacancy_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->DepartmentName->Visible) { // DepartmentName ?>
	<?php
		$vacancy_view_list->SearchColumnCount++;
		if (($vacancy_view_list->SearchColumnCount - 1) % $vacancy_view_list->SearchFieldsPerRow == 0) {
			$vacancy_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $vacancy_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_DepartmentName" class="ew-cell form-group">
		<label for="x_DepartmentName" class="ew-search-caption ew-label"><?php echo $vacancy_view_list->DepartmentName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DepartmentName" id="z_DepartmentName" value="LIKE">
</span>
		<span id="el_vacancy_view_DepartmentName" class="ew-search-field">
<input type="text" data-table="vacancy_view" data-field="x_DepartmentName" name="x_DepartmentName" id="x_DepartmentName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vacancy_view_list->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $vacancy_view_list->DepartmentName->EditValue ?>"<?php echo $vacancy_view_list->DepartmentName->editAttributes() ?>>
</span>
	</div>
	<?php if ($vacancy_view_list->SearchColumnCount % $vacancy_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->SectionName->Visible) { // SectionName ?>
	<?php
		$vacancy_view_list->SearchColumnCount++;
		if (($vacancy_view_list->SearchColumnCount - 1) % $vacancy_view_list->SearchFieldsPerRow == 0) {
			$vacancy_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $vacancy_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_SectionName" class="ew-cell form-group">
		<label for="x_SectionName" class="ew-search-caption ew-label"><?php echo $vacancy_view_list->SectionName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SectionName" id="z_SectionName" value="LIKE">
</span>
		<span id="el_vacancy_view_SectionName" class="ew-search-field">
<input type="text" data-table="vacancy_view" data-field="x_SectionName" name="x_SectionName" id="x_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($vacancy_view_list->SectionName->getPlaceHolder()) ?>" value="<?php echo $vacancy_view_list->SectionName->EditValue ?>"<?php echo $vacancy_view_list->SectionName->editAttributes() ?>>
</span>
	</div>
	<?php if ($vacancy_view_list->SearchColumnCount % $vacancy_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->CouncilType->Visible) { // CouncilType ?>
	<?php
		$vacancy_view_list->SearchColumnCount++;
		if (($vacancy_view_list->SearchColumnCount - 1) % $vacancy_view_list->SearchFieldsPerRow == 0) {
			$vacancy_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $vacancy_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_CouncilType" class="ew-cell form-group">
		<label for="x_CouncilType" class="ew-search-caption ew-label"><?php echo $vacancy_view_list->CouncilType->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CouncilType" id="z_CouncilType" value="=">
</span>
		<span id="el_vacancy_view_CouncilType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="vacancy_view" data-field="x_CouncilType" data-value-separator="<?php echo $vacancy_view_list->CouncilType->displayValueSeparatorAttribute() ?>" id="x_CouncilType" name="x_CouncilType"<?php echo $vacancy_view_list->CouncilType->editAttributes() ?>>
			<?php echo $vacancy_view_list->CouncilType->selectOptionListHtml("x_CouncilType") ?>
		</select>
</div>
<?php echo $vacancy_view_list->CouncilType->Lookup->getParamTag($vacancy_view_list, "p_x_CouncilType") ?>
</span>
	</div>
	<?php if ($vacancy_view_list->SearchColumnCount % $vacancy_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->MonthsVacant->Visible) { // MonthsVacant ?>
	<?php
		$vacancy_view_list->SearchColumnCount++;
		if (($vacancy_view_list->SearchColumnCount - 1) % $vacancy_view_list->SearchFieldsPerRow == 0) {
			$vacancy_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $vacancy_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_MonthsVacant" class="ew-cell form-group">
		<label for="x_MonthsVacant" class="ew-search-caption ew-label"><?php echo $vacancy_view_list->MonthsVacant->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MonthsVacant" id="z_MonthsVacant" value="=">
</span>
		<span id="el_vacancy_view_MonthsVacant" class="ew-search-field">
<input type="text" data-table="vacancy_view" data-field="x_MonthsVacant" name="x_MonthsVacant" id="x_MonthsVacant" size="30" placeholder="<?php echo HtmlEncode($vacancy_view_list->MonthsVacant->getPlaceHolder()) ?>" value="<?php echo $vacancy_view_list->MonthsVacant->EditValue ?>"<?php echo $vacancy_view_list->MonthsVacant->editAttributes() ?>>
</span>
		<span class="ew-search-cond">
<div class="custom-control custom-radio custom-control-inline"><input class="custom-control-input" type="radio" id="v_MonthsVacant_1" name="v_MonthsVacant" value="AND"<?php if ($vacancy_view_list->MonthsVacant->AdvancedSearch->SearchCondition != "OR") echo " checked" ?>><label class="custom-control-label" for="v_MonthsVacant_1"><?php echo $Language->phrase("AND") ?></label></div>
<div class="custom-control custom-radio custom-control-inline"><input class="custom-control-input" type="radio" id="v_MonthsVacant_2" name="v_MonthsVacant" value="OR"<?php if ($vacancy_view_list->MonthsVacant->AdvancedSearch->SearchCondition == "OR") echo " checked" ?>><label class="custom-control-label" for="v_MonthsVacant_2"><?php echo $Language->phrase("OR") ?></label></div></span>
		<span class="ew-search-operator2">
<select name="w_MonthsVacant" id="w_MonthsVacant" class="custom-select" onchange="ew.searchOperatorChanged(this);">
<option value="="<?php echo $vacancy_view_list->MonthsVacant->AdvancedSearch->SearchOperator2 == "=" ? " selected" : "" ?>><?php echo $Language->phrase("EQUAL") ?></option>
<option value="<>"<?php echo $vacancy_view_list->MonthsVacant->AdvancedSearch->SearchOperator2 == "<>" ? " selected" : "" ?>><?php echo $Language->phrase("<>") ?></option>
<option value="<"<?php echo $vacancy_view_list->MonthsVacant->AdvancedSearch->SearchOperator2 == "<" ? " selected" : "" ?>><?php echo $Language->phrase("<") ?></option>
<option value="<="<?php echo $vacancy_view_list->MonthsVacant->AdvancedSearch->SearchOperator2 == "<=" ? " selected" : "" ?>><?php echo $Language->phrase("<=") ?></option>
<option value=">"<?php echo $vacancy_view_list->MonthsVacant->AdvancedSearch->SearchOperator2 == ">" ? " selected" : "" ?>><?php echo $Language->phrase(">") ?></option>
<option value=">="<?php echo $vacancy_view_list->MonthsVacant->AdvancedSearch->SearchOperator2 == ">=" ? " selected" : "" ?>><?php echo $Language->phrase(">=") ?></option>
<option value="IS NULL"<?php echo $vacancy_view_list->MonthsVacant->AdvancedSearch->SearchOperator2 == "IS NULL" ? " selected" : "" ?>><?php echo $Language->phrase("IS NULL") ?></option>
<option value="IS NOT NULL"<?php echo $vacancy_view_list->MonthsVacant->AdvancedSearch->SearchOperator2 == "IS NOT NULL" ? " selected" : "" ?>><?php echo $Language->phrase("IS NOT NULL") ?></option>
</select>
</span>
		<span id="el2_vacancy_view_MonthsVacant" class="ew-search-field2">
<input type="text" data-table="vacancy_view" data-field="x_MonthsVacant" name="y_MonthsVacant" id="y_MonthsVacant" size="30" placeholder="<?php echo HtmlEncode($vacancy_view_list->MonthsVacant->getPlaceHolder()) ?>" value="<?php echo $vacancy_view_list->MonthsVacant->EditValue2 ?>"<?php echo $vacancy_view_list->MonthsVacant->editAttributes() ?>>
</span>
	</div>
	<?php if ($vacancy_view_list->SearchColumnCount % $vacancy_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($vacancy_view_list->SearchColumnCount % $vacancy_view_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $vacancy_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($vacancy_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($vacancy_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vacancy_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vacancy_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vacancy_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vacancy_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vacancy_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $vacancy_view_list->showPageHeader(); ?>
<?php
$vacancy_view_list->showMessage();
?>
<?php if ($vacancy_view_list->TotalRecords > 0 || $vacancy_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vacancy_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vacancy_view">
<?php if (!$vacancy_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vacancy_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $vacancy_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vacancy_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvacancy_viewlist" id="fvacancy_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vacancy_view">
<div id="gmp_vacancy_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($vacancy_view_list->TotalRecords > 0 || $vacancy_view_list->isGridEdit()) { ?>
<table id="tbl_vacancy_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vacancy_view->RowType = ROWTYPE_HEADER;

// Render list options
$vacancy_view_list->renderListOptions();

// Render list options (header, left)
$vacancy_view_list->ListOptions->render("header", "left");
?>
<?php if ($vacancy_view_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($vacancy_view_list->SortUrl($vacancy_view_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $vacancy_view_list->ProvinceCode->headerCellClass() ?>"><div id="elh_vacancy_view_ProvinceCode" class="vacancy_view_ProvinceCode"><div class="ew-table-header-caption"><?php echo $vacancy_view_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $vacancy_view_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancy_view_list->SortUrl($vacancy_view_list->ProvinceCode) ?>', 1);"><div id="elh_vacancy_view_ProvinceCode" class="vacancy_view_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancy_view_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($vacancy_view_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancy_view_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->LACode->Visible) { // LACode ?>
	<?php if ($vacancy_view_list->SortUrl($vacancy_view_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $vacancy_view_list->LACode->headerCellClass() ?>"><div id="elh_vacancy_view_LACode" class="vacancy_view_LACode"><div class="ew-table-header-caption"><?php echo $vacancy_view_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $vacancy_view_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancy_view_list->SortUrl($vacancy_view_list->LACode) ?>', 1);"><div id="elh_vacancy_view_LACode" class="vacancy_view_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancy_view_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($vacancy_view_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancy_view_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($vacancy_view_list->SortUrl($vacancy_view_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $vacancy_view_list->DepartmentCode->headerCellClass() ?>"><div id="elh_vacancy_view_DepartmentCode" class="vacancy_view_DepartmentCode"><div class="ew-table-header-caption"><?php echo $vacancy_view_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $vacancy_view_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancy_view_list->SortUrl($vacancy_view_list->DepartmentCode) ?>', 1);"><div id="elh_vacancy_view_DepartmentCode" class="vacancy_view_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancy_view_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($vacancy_view_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancy_view_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($vacancy_view_list->SortUrl($vacancy_view_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $vacancy_view_list->SectionCode->headerCellClass() ?>"><div id="elh_vacancy_view_SectionCode" class="vacancy_view_SectionCode"><div class="ew-table-header-caption"><?php echo $vacancy_view_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $vacancy_view_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancy_view_list->SortUrl($vacancy_view_list->SectionCode) ?>', 1);"><div id="elh_vacancy_view_SectionCode" class="vacancy_view_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancy_view_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($vacancy_view_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancy_view_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->PositionName->Visible) { // PositionName ?>
	<?php if ($vacancy_view_list->SortUrl($vacancy_view_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $vacancy_view_list->PositionName->headerCellClass() ?>"><div id="elh_vacancy_view_PositionName" class="vacancy_view_PositionName"><div class="ew-table-header-caption"><?php echo $vacancy_view_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $vacancy_view_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancy_view_list->SortUrl($vacancy_view_list->PositionName) ?>', 1);"><div id="elh_vacancy_view_PositionName" class="vacancy_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancy_view_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vacancy_view_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancy_view_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($vacancy_view_list->SortUrl($vacancy_view_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $vacancy_view_list->SalaryScale->headerCellClass() ?>"><div id="elh_vacancy_view_SalaryScale" class="vacancy_view_SalaryScale"><div class="ew-table-header-caption"><?php echo $vacancy_view_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $vacancy_view_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancy_view_list->SortUrl($vacancy_view_list->SalaryScale) ?>', 1);"><div id="elh_vacancy_view_SalaryScale" class="vacancy_view_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancy_view_list->SalaryScale->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vacancy_view_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancy_view_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->RequisiteQualification->Visible) { // RequisiteQualification ?>
	<?php if ($vacancy_view_list->SortUrl($vacancy_view_list->RequisiteQualification) == "") { ?>
		<th data-name="RequisiteQualification" class="<?php echo $vacancy_view_list->RequisiteQualification->headerCellClass() ?>"><div id="elh_vacancy_view_RequisiteQualification" class="vacancy_view_RequisiteQualification"><div class="ew-table-header-caption"><?php echo $vacancy_view_list->RequisiteQualification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RequisiteQualification" class="<?php echo $vacancy_view_list->RequisiteQualification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancy_view_list->SortUrl($vacancy_view_list->RequisiteQualification) ?>', 1);"><div id="elh_vacancy_view_RequisiteQualification" class="vacancy_view_RequisiteQualification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancy_view_list->RequisiteQualification->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vacancy_view_list->RequisiteQualification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancy_view_list->RequisiteQualification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($vacancy_view_list->SortUrl($vacancy_view_list->DepartmentName) == "") { ?>
		<th data-name="DepartmentName" class="<?php echo $vacancy_view_list->DepartmentName->headerCellClass() ?>"><div id="elh_vacancy_view_DepartmentName" class="vacancy_view_DepartmentName"><div class="ew-table-header-caption"><?php echo $vacancy_view_list->DepartmentName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentName" class="<?php echo $vacancy_view_list->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancy_view_list->SortUrl($vacancy_view_list->DepartmentName) ?>', 1);"><div id="elh_vacancy_view_DepartmentName" class="vacancy_view_DepartmentName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancy_view_list->DepartmentName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vacancy_view_list->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancy_view_list->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->SectionName->Visible) { // SectionName ?>
	<?php if ($vacancy_view_list->SortUrl($vacancy_view_list->SectionName) == "") { ?>
		<th data-name="SectionName" class="<?php echo $vacancy_view_list->SectionName->headerCellClass() ?>"><div id="elh_vacancy_view_SectionName" class="vacancy_view_SectionName"><div class="ew-table-header-caption"><?php echo $vacancy_view_list->SectionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionName" class="<?php echo $vacancy_view_list->SectionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancy_view_list->SortUrl($vacancy_view_list->SectionName) ?>', 1);"><div id="elh_vacancy_view_SectionName" class="vacancy_view_SectionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancy_view_list->SectionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vacancy_view_list->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancy_view_list->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->CouncilType->Visible) { // CouncilType ?>
	<?php if ($vacancy_view_list->SortUrl($vacancy_view_list->CouncilType) == "") { ?>
		<th data-name="CouncilType" class="<?php echo $vacancy_view_list->CouncilType->headerCellClass() ?>"><div id="elh_vacancy_view_CouncilType" class="vacancy_view_CouncilType"><div class="ew-table-header-caption"><?php echo $vacancy_view_list->CouncilType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilType" class="<?php echo $vacancy_view_list->CouncilType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancy_view_list->SortUrl($vacancy_view_list->CouncilType) ?>', 1);"><div id="elh_vacancy_view_CouncilType" class="vacancy_view_CouncilType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancy_view_list->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($vacancy_view_list->CouncilType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancy_view_list->CouncilType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
	<?php if ($vacancy_view_list->SortUrl($vacancy_view_list->EmploymentStatus) == "") { ?>
		<th data-name="EmploymentStatus" class="<?php echo $vacancy_view_list->EmploymentStatus->headerCellClass() ?>"><div id="elh_vacancy_view_EmploymentStatus" class="vacancy_view_EmploymentStatus"><div class="ew-table-header-caption"><?php echo $vacancy_view_list->EmploymentStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmploymentStatus" class="<?php echo $vacancy_view_list->EmploymentStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancy_view_list->SortUrl($vacancy_view_list->EmploymentStatus) ?>', 1);"><div id="elh_vacancy_view_EmploymentStatus" class="vacancy_view_EmploymentStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancy_view_list->EmploymentStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($vacancy_view_list->EmploymentStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancy_view_list->EmploymentStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancy_view_list->MonthsVacant->Visible) { // MonthsVacant ?>
	<?php if ($vacancy_view_list->SortUrl($vacancy_view_list->MonthsVacant) == "") { ?>
		<th data-name="MonthsVacant" class="<?php echo $vacancy_view_list->MonthsVacant->headerCellClass() ?>"><div id="elh_vacancy_view_MonthsVacant" class="vacancy_view_MonthsVacant"><div class="ew-table-header-caption"><?php echo $vacancy_view_list->MonthsVacant->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MonthsVacant" class="<?php echo $vacancy_view_list->MonthsVacant->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancy_view_list->SortUrl($vacancy_view_list->MonthsVacant) ?>', 1);"><div id="elh_vacancy_view_MonthsVacant" class="vacancy_view_MonthsVacant">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancy_view_list->MonthsVacant->caption() ?></span><span class="ew-table-header-sort"><?php if ($vacancy_view_list->MonthsVacant->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancy_view_list->MonthsVacant->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vacancy_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vacancy_view_list->ExportAll && $vacancy_view_list->isExport()) {
	$vacancy_view_list->StopRecord = $vacancy_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($vacancy_view_list->TotalRecords > $vacancy_view_list->StartRecord + $vacancy_view_list->DisplayRecords - 1)
		$vacancy_view_list->StopRecord = $vacancy_view_list->StartRecord + $vacancy_view_list->DisplayRecords - 1;
	else
		$vacancy_view_list->StopRecord = $vacancy_view_list->TotalRecords;
}
$vacancy_view_list->RecordCount = $vacancy_view_list->StartRecord - 1;
if ($vacancy_view_list->Recordset && !$vacancy_view_list->Recordset->EOF) {
	$vacancy_view_list->Recordset->moveFirst();
	$selectLimit = $vacancy_view_list->UseSelectLimit;
	if (!$selectLimit && $vacancy_view_list->StartRecord > 1)
		$vacancy_view_list->Recordset->move($vacancy_view_list->StartRecord - 1);
} elseif (!$vacancy_view->AllowAddDeleteRow && $vacancy_view_list->StopRecord == 0) {
	$vacancy_view_list->StopRecord = $vacancy_view->GridAddRowCount;
}

// Initialize aggregate
$vacancy_view->RowType = ROWTYPE_AGGREGATEINIT;
$vacancy_view->resetAttributes();
$vacancy_view_list->renderRow();
while ($vacancy_view_list->RecordCount < $vacancy_view_list->StopRecord) {
	$vacancy_view_list->RecordCount++;
	if ($vacancy_view_list->RecordCount >= $vacancy_view_list->StartRecord) {
		$vacancy_view_list->RowCount++;

		// Set up key count
		$vacancy_view_list->KeyCount = $vacancy_view_list->RowIndex;

		// Init row class and style
		$vacancy_view->resetAttributes();
		$vacancy_view->CssClass = "";
		if ($vacancy_view_list->isGridAdd()) {
		} else {
			$vacancy_view_list->loadRowValues($vacancy_view_list->Recordset); // Load row values
		}
		$vacancy_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vacancy_view->RowAttrs->merge(["data-rowindex" => $vacancy_view_list->RowCount, "id" => "r" . $vacancy_view_list->RowCount . "_vacancy_view", "data-rowtype" => $vacancy_view->RowType]);

		// Render row
		$vacancy_view_list->renderRow();

		// Render list options
		$vacancy_view_list->renderListOptions();
?>
	<tr <?php echo $vacancy_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vacancy_view_list->ListOptions->render("body", "left", $vacancy_view_list->RowCount);
?>
	<?php if ($vacancy_view_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $vacancy_view_list->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $vacancy_view_list->RowCount ?>_vacancy_view_ProvinceCode">
<span<?php echo $vacancy_view_list->ProvinceCode->viewAttributes() ?>><?php echo $vacancy_view_list->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancy_view_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $vacancy_view_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $vacancy_view_list->RowCount ?>_vacancy_view_LACode">
<span<?php echo $vacancy_view_list->LACode->viewAttributes() ?>><?php echo $vacancy_view_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancy_view_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $vacancy_view_list->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $vacancy_view_list->RowCount ?>_vacancy_view_DepartmentCode">
<span<?php echo $vacancy_view_list->DepartmentCode->viewAttributes() ?>><?php echo $vacancy_view_list->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancy_view_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $vacancy_view_list->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $vacancy_view_list->RowCount ?>_vacancy_view_SectionCode">
<span<?php echo $vacancy_view_list->SectionCode->viewAttributes() ?>><?php echo $vacancy_view_list->SectionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancy_view_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $vacancy_view_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $vacancy_view_list->RowCount ?>_vacancy_view_PositionName">
<span<?php echo $vacancy_view_list->PositionName->viewAttributes() ?>><?php echo $vacancy_view_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancy_view_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $vacancy_view_list->SalaryScale->cellAttributes() ?>>
<span id="el<?php echo $vacancy_view_list->RowCount ?>_vacancy_view_SalaryScale">
<span<?php echo $vacancy_view_list->SalaryScale->viewAttributes() ?>><?php echo $vacancy_view_list->SalaryScale->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancy_view_list->RequisiteQualification->Visible) { // RequisiteQualification ?>
		<td data-name="RequisiteQualification" <?php echo $vacancy_view_list->RequisiteQualification->cellAttributes() ?>>
<span id="el<?php echo $vacancy_view_list->RowCount ?>_vacancy_view_RequisiteQualification">
<span<?php echo $vacancy_view_list->RequisiteQualification->viewAttributes() ?>><?php echo $vacancy_view_list->RequisiteQualification->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancy_view_list->DepartmentName->Visible) { // DepartmentName ?>
		<td data-name="DepartmentName" <?php echo $vacancy_view_list->DepartmentName->cellAttributes() ?>>
<span id="el<?php echo $vacancy_view_list->RowCount ?>_vacancy_view_DepartmentName">
<span<?php echo $vacancy_view_list->DepartmentName->viewAttributes() ?>><?php echo $vacancy_view_list->DepartmentName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancy_view_list->SectionName->Visible) { // SectionName ?>
		<td data-name="SectionName" <?php echo $vacancy_view_list->SectionName->cellAttributes() ?>>
<span id="el<?php echo $vacancy_view_list->RowCount ?>_vacancy_view_SectionName">
<span<?php echo $vacancy_view_list->SectionName->viewAttributes() ?>><?php echo $vacancy_view_list->SectionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancy_view_list->CouncilType->Visible) { // CouncilType ?>
		<td data-name="CouncilType" <?php echo $vacancy_view_list->CouncilType->cellAttributes() ?>>
<span id="el<?php echo $vacancy_view_list->RowCount ?>_vacancy_view_CouncilType">
<span<?php echo $vacancy_view_list->CouncilType->viewAttributes() ?>><?php echo $vacancy_view_list->CouncilType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancy_view_list->EmploymentStatus->Visible) { // EmploymentStatus ?>
		<td data-name="EmploymentStatus" <?php echo $vacancy_view_list->EmploymentStatus->cellAttributes() ?>>
<span id="el<?php echo $vacancy_view_list->RowCount ?>_vacancy_view_EmploymentStatus">
<span<?php echo $vacancy_view_list->EmploymentStatus->viewAttributes() ?>><?php echo $vacancy_view_list->EmploymentStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancy_view_list->MonthsVacant->Visible) { // MonthsVacant ?>
		<td data-name="MonthsVacant" <?php echo $vacancy_view_list->MonthsVacant->cellAttributes() ?>>
<span id="el<?php echo $vacancy_view_list->RowCount ?>_vacancy_view_MonthsVacant">
<span<?php echo $vacancy_view_list->MonthsVacant->viewAttributes() ?>><?php echo $vacancy_view_list->MonthsVacant->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vacancy_view_list->ListOptions->render("body", "right", $vacancy_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$vacancy_view_list->isGridAdd())
		$vacancy_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$vacancy_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vacancy_view_list->Recordset)
	$vacancy_view_list->Recordset->Close();
?>
<?php if (!$vacancy_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vacancy_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $vacancy_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vacancy_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vacancy_view_list->TotalRecords == 0 && !$vacancy_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vacancy_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vacancy_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$vacancy_view_list->isExport()) { ?>
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
$vacancy_view_list->terminate();
?>