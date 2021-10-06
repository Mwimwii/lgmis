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
$payroll_summary_view_list = new payroll_summary_view_list();

// Run the page
$payroll_summary_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_summary_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payroll_summary_view_list->isExport()) { ?>
<script>
var fpayroll_summary_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpayroll_summary_viewlist = currentForm = new ew.Form("fpayroll_summary_viewlist", "list");
	fpayroll_summary_viewlist.formKeyCountName = '<?php echo $payroll_summary_view_list->FormKeyCountName ?>';
	loadjs.done("fpayroll_summary_viewlist");
});
var fpayroll_summary_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpayroll_summary_viewlistsrch = currentSearchForm = new ew.Form("fpayroll_summary_viewlistsrch");

	// Validate function for search
	fpayroll_summary_viewlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payroll_summary_view_list->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Division");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($payroll_summary_view_list->Division->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpayroll_summary_viewlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayroll_summary_viewlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpayroll_summary_viewlistsrch.lists["x_LocalAuthority"] = <?php echo $payroll_summary_view_list->LocalAuthority->Lookup->toClientList($payroll_summary_view_list) ?>;
	fpayroll_summary_viewlistsrch.lists["x_LocalAuthority"].options = <?php echo JsonEncode($payroll_summary_view_list->LocalAuthority->lookupOptions()) ?>;
	fpayroll_summary_viewlistsrch.lists["x_PayrollPeriod"] = <?php echo $payroll_summary_view_list->PayrollPeriod->Lookup->toClientList($payroll_summary_view_list) ?>;
	fpayroll_summary_viewlistsrch.lists["x_PayrollPeriod"].options = <?php echo JsonEncode($payroll_summary_view_list->PayrollPeriod->lookupOptions()) ?>;

	// Filters
	fpayroll_summary_viewlistsrch.filterList = <?php echo $payroll_summary_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpayroll_summary_viewlistsrch.initSearchPanel = true;
	loadjs.done("fpayroll_summary_viewlistsrch");
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
<?php if (!$payroll_summary_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($payroll_summary_view_list->TotalRecords > 0 && $payroll_summary_view_list->ExportOptions->visible()) { ?>
<?php $payroll_summary_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_summary_view_list->ImportOptions->visible()) { ?>
<?php $payroll_summary_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_summary_view_list->SearchOptions->visible()) { ?>
<?php $payroll_summary_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_summary_view_list->FilterOptions->visible()) { ?>
<?php $payroll_summary_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$payroll_summary_view_list->isExport() || Config("EXPORT_MASTER_RECORD") && $payroll_summary_view_list->isExport("print")) { ?>
<?php
if ($payroll_summary_view_list->DbMasterFilter != "" && $payroll_summary_view->getCurrentMasterTable() == "payroll_period") {
	if ($payroll_summary_view_list->MasterRecordExists) {
		include_once "payroll_periodmaster.php";
	}
}
?>
<?php } ?>
<?php
$payroll_summary_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$payroll_summary_view_list->isExport() && !$payroll_summary_view->CurrentAction) { ?>
<form name="fpayroll_summary_viewlistsrch" id="fpayroll_summary_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpayroll_summary_viewlistsrch-search-panel" class="<?php echo $payroll_summary_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="payroll_summary_view">
	<div class="ew-extended-search">
<?php

// Render search row
$payroll_summary_view->RowType = ROWTYPE_SEARCH;
$payroll_summary_view->resetAttributes();
$payroll_summary_view_list->renderRow();
?>
<?php if ($payroll_summary_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php
		$payroll_summary_view_list->SearchColumnCount++;
		if (($payroll_summary_view_list->SearchColumnCount - 1) % $payroll_summary_view_list->SearchFieldsPerRow == 0) {
			$payroll_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_LocalAuthority" class="ew-cell form-group">
		<label for="x_LocalAuthority" class="ew-search-caption ew-label"><?php echo $payroll_summary_view_list->LocalAuthority->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LocalAuthority" id="z_LocalAuthority" value="LIKE">
</span>
		<span id="el_payroll_summary_view_LocalAuthority" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LocalAuthority"><?php echo EmptyValue(strval($payroll_summary_view_list->LocalAuthority->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $payroll_summary_view_list->LocalAuthority->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($payroll_summary_view_list->LocalAuthority->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($payroll_summary_view_list->LocalAuthority->ReadOnly || $payroll_summary_view_list->LocalAuthority->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LocalAuthority',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $payroll_summary_view_list->LocalAuthority->Lookup->getParamTag($payroll_summary_view_list, "p_x_LocalAuthority") ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_LocalAuthority" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $payroll_summary_view_list->LocalAuthority->displayValueSeparatorAttribute() ?>" name="x_LocalAuthority" id="x_LocalAuthority" value="<?php echo $payroll_summary_view_list->LocalAuthority->AdvancedSearch->SearchValue ?>"<?php echo $payroll_summary_view_list->LocalAuthority->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->DepartmentName->Visible) { // DepartmentName ?>
	<?php
		$payroll_summary_view_list->SearchColumnCount++;
		if (($payroll_summary_view_list->SearchColumnCount - 1) % $payroll_summary_view_list->SearchFieldsPerRow == 0) {
			$payroll_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_DepartmentName" class="ew-cell form-group">
		<label for="x_DepartmentName" class="ew-search-caption ew-label"><?php echo $payroll_summary_view_list->DepartmentName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DepartmentName" id="z_DepartmentName" value="LIKE">
</span>
		<span id="el_payroll_summary_view_DepartmentName" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_DepartmentName" name="x_DepartmentName" id="x_DepartmentName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_list->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_list->DepartmentName->EditValue ?>"<?php echo $payroll_summary_view_list->DepartmentName->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->SectionName->Visible) { // SectionName ?>
	<?php
		$payroll_summary_view_list->SearchColumnCount++;
		if (($payroll_summary_view_list->SearchColumnCount - 1) % $payroll_summary_view_list->SearchFieldsPerRow == 0) {
			$payroll_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_SectionName" class="ew-cell form-group">
		<label for="x_SectionName" class="ew-search-caption ew-label"><?php echo $payroll_summary_view_list->SectionName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SectionName" id="z_SectionName" value="LIKE">
</span>
		<span id="el_payroll_summary_view_SectionName" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_SectionName" name="x_SectionName" id="x_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_list->SectionName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_list->SectionName->EditValue ?>"<?php echo $payroll_summary_view_list->SectionName->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php
		$payroll_summary_view_list->SearchColumnCount++;
		if (($payroll_summary_view_list->SearchColumnCount - 1) % $payroll_summary_view_list->SearchFieldsPerRow == 0) {
			$payroll_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_EmployeeID" class="ew-cell form-group">
		<label for="x_EmployeeID" class="ew-search-caption ew-label"><?php echo $payroll_summary_view_list->EmployeeID->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		<span id="el_payroll_summary_view_EmployeeID" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($payroll_summary_view_list->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_list->EmployeeID->EditValue ?>"<?php echo $payroll_summary_view_list->EmployeeID->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->Surname->Visible) { // Surname ?>
	<?php
		$payroll_summary_view_list->SearchColumnCount++;
		if (($payroll_summary_view_list->SearchColumnCount - 1) % $payroll_summary_view_list->SearchFieldsPerRow == 0) {
			$payroll_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Surname" class="ew-cell form-group">
		<label for="x_Surname" class="ew-search-caption ew-label"><?php echo $payroll_summary_view_list->Surname->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		<span id="el_payroll_summary_view_Surname" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_Surname" name="x_Surname" id="x_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_list->Surname->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_list->Surname->EditValue ?>"<?php echo $payroll_summary_view_list->Surname->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->NRC->Visible) { // NRC ?>
	<?php
		$payroll_summary_view_list->SearchColumnCount++;
		if (($payroll_summary_view_list->SearchColumnCount - 1) % $payroll_summary_view_list->SearchFieldsPerRow == 0) {
			$payroll_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_NRC" class="ew-cell form-group">
		<label for="x_NRC" class="ew-search-caption ew-label"><?php echo $payroll_summary_view_list->NRC->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NRC" id="z_NRC" value="LIKE">
</span>
		<span id="el_payroll_summary_view_NRC" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($payroll_summary_view_list->NRC->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_list->NRC->EditValue ?>"<?php echo $payroll_summary_view_list->NRC->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->PositionName->Visible) { // PositionName ?>
	<?php
		$payroll_summary_view_list->SearchColumnCount++;
		if (($payroll_summary_view_list->SearchColumnCount - 1) % $payroll_summary_view_list->SearchFieldsPerRow == 0) {
			$payroll_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PositionName" class="ew-cell form-group">
		<label for="x_PositionName" class="ew-search-caption ew-label"><?php echo $payroll_summary_view_list->PositionName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PositionName" id="z_PositionName" value="LIKE">
</span>
		<span id="el_payroll_summary_view_PositionName" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_PositionName" name="x_PositionName" id="x_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_list->PositionName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_list->PositionName->EditValue ?>"<?php echo $payroll_summary_view_list->PositionName->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php
		$payroll_summary_view_list->SearchColumnCount++;
		if (($payroll_summary_view_list->SearchColumnCount - 1) % $payroll_summary_view_list->SearchFieldsPerRow == 0) {
			$payroll_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_PayrollPeriod" class="ew-cell form-group">
		<label for="x_PayrollPeriod" class="ew-search-caption ew-label"><?php echo $payroll_summary_view_list->PayrollPeriod->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PayrollPeriod" id="z_PayrollPeriod" value="=">
</span>
		<span id="el_payroll_summary_view_PayrollPeriod" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="payroll_summary_view" data-field="x_PayrollPeriod" data-value-separator="<?php echo $payroll_summary_view_list->PayrollPeriod->displayValueSeparatorAttribute() ?>" id="x_PayrollPeriod" name="x_PayrollPeriod"<?php echo $payroll_summary_view_list->PayrollPeriod->editAttributes() ?>>
			<?php echo $payroll_summary_view_list->PayrollPeriod->selectOptionListHtml("x_PayrollPeriod") ?>
		</select>
</div>
<?php echo $payroll_summary_view_list->PayrollPeriod->Lookup->getParamTag($payroll_summary_view_list, "p_x_PayrollPeriod") ?>
</span>
	</div>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->pCode->Visible) { // pCode ?>
	<?php
		$payroll_summary_view_list->SearchColumnCount++;
		if (($payroll_summary_view_list->SearchColumnCount - 1) % $payroll_summary_view_list->SearchFieldsPerRow == 0) {
			$payroll_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_pCode" class="ew-cell form-group">
		<label for="x_pCode" class="ew-search-caption ew-label"><?php echo $payroll_summary_view_list->pCode->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pCode" id="z_pCode" value="LIKE">
</span>
		<span id="el_payroll_summary_view_pCode" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_pCode" name="x_pCode" id="x_pCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($payroll_summary_view_list->pCode->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_list->pCode->EditValue ?>"<?php echo $payroll_summary_view_list->pCode->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->pName->Visible) { // pName ?>
	<?php
		$payroll_summary_view_list->SearchColumnCount++;
		if (($payroll_summary_view_list->SearchColumnCount - 1) % $payroll_summary_view_list->SearchFieldsPerRow == 0) {
			$payroll_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_pName" class="ew-cell form-group">
		<label for="x_pName" class="ew-search-caption ew-label"><?php echo $payroll_summary_view_list->pName->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pName" id="z_pName" value="LIKE">
</span>
		<span id="el_payroll_summary_view_pName" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_pName" name="x_pName" id="x_pName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_list->pName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_list->pName->EditValue ?>"<?php echo $payroll_summary_view_list->pName->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php
		$payroll_summary_view_list->SearchColumnCount++;
		if (($payroll_summary_view_list->SearchColumnCount - 1) % $payroll_summary_view_list->SearchFieldsPerRow == 0) {
			$payroll_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_SalaryScale" class="ew-cell form-group">
		<label for="x_SalaryScale" class="ew-search-caption ew-label"><?php echo $payroll_summary_view_list->SalaryScale->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SalaryScale" id="z_SalaryScale" value="LIKE">
</span>
		<span id="el_payroll_summary_view_SalaryScale" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_SalaryScale" name="x_SalaryScale" id="x_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($payroll_summary_view_list->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_list->SalaryScale->EditValue ?>"<?php echo $payroll_summary_view_list->SalaryScale->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->Division->Visible) { // Division ?>
	<?php
		$payroll_summary_view_list->SearchColumnCount++;
		if (($payroll_summary_view_list->SearchColumnCount - 1) % $payroll_summary_view_list->SearchFieldsPerRow == 0) {
			$payroll_summary_view_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_Division" class="ew-cell form-group">
		<label for="x_Division" class="ew-search-caption ew-label"><?php echo $payroll_summary_view_list->Division->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Division" id="z_Division" value="=">
</span>
		<span id="el_payroll_summary_view_Division" class="ew-search-field">
<input type="text" data-table="payroll_summary_view" data-field="x_Division" name="x_Division" id="x_Division" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($payroll_summary_view_list->Division->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_list->Division->EditValue ?>"<?php echo $payroll_summary_view_list->Division->editAttributes() ?>>
</span>
	</div>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($payroll_summary_view_list->SearchColumnCount % $payroll_summary_view_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $payroll_summary_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($payroll_summary_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($payroll_summary_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $payroll_summary_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($payroll_summary_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($payroll_summary_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($payroll_summary_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($payroll_summary_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $payroll_summary_view_list->showPageHeader(); ?>
<?php
$payroll_summary_view_list->showMessage();
?>
<?php if ($payroll_summary_view_list->TotalRecords > 0 || $payroll_summary_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payroll_summary_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payroll_summary_view">
<?php if (!$payroll_summary_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$payroll_summary_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_summary_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_summary_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpayroll_summary_viewlist" id="fpayroll_summary_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_summary_view">
<?php if ($payroll_summary_view->getCurrentMasterTable() == "payroll_period" && $payroll_summary_view->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="payroll_period">
<input type="hidden" name="fk_PeriodCode" value="<?php echo HtmlEncode($payroll_summary_view_list->PayrollPeriod->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_payroll_summary_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($payroll_summary_view_list->TotalRecords > 0 || $payroll_summary_view_list->isGridEdit()) { ?>
<table id="tbl_payroll_summary_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payroll_summary_view->RowType = ROWTYPE_HEADER;

// Render list options
$payroll_summary_view_list->renderListOptions();

// Render list options (header, left)
$payroll_summary_view_list->ListOptions->render("header", "left");
?>
<?php if ($payroll_summary_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->LocalAuthority) == "") { ?>
		<th data-name="LocalAuthority" class="<?php echo $payroll_summary_view_list->LocalAuthority->headerCellClass() ?>"><div id="elh_payroll_summary_view_LocalAuthority" class="payroll_summary_view_LocalAuthority"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->LocalAuthority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LocalAuthority" class="<?php echo $payroll_summary_view_list->LocalAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->LocalAuthority) ?>', 1);"><div id="elh_payroll_summary_view_LocalAuthority" class="payroll_summary_view_LocalAuthority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->DepartmentName) == "") { ?>
		<th data-name="DepartmentName" class="<?php echo $payroll_summary_view_list->DepartmentName->headerCellClass() ?>"><div id="elh_payroll_summary_view_DepartmentName" class="payroll_summary_view_DepartmentName"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->DepartmentName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentName" class="<?php echo $payroll_summary_view_list->DepartmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->DepartmentName) ?>', 1);"><div id="elh_payroll_summary_view_DepartmentName" class="payroll_summary_view_DepartmentName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->DepartmentName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->SectionName->Visible) { // SectionName ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->SectionName) == "") { ?>
		<th data-name="SectionName" class="<?php echo $payroll_summary_view_list->SectionName->headerCellClass() ?>"><div id="elh_payroll_summary_view_SectionName" class="payroll_summary_view_SectionName"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->SectionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionName" class="<?php echo $payroll_summary_view_list->SectionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->SectionName) ?>', 1);"><div id="elh_payroll_summary_view_SectionName" class="payroll_summary_view_SectionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->SectionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $payroll_summary_view_list->EmployeeID->headerCellClass() ?>"><div id="elh_payroll_summary_view_EmployeeID" class="payroll_summary_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $payroll_summary_view_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->EmployeeID) ?>', 1);"><div id="elh_payroll_summary_view_EmployeeID" class="payroll_summary_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->Title->Visible) { // Title ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->Title) == "") { ?>
		<th data-name="Title" class="<?php echo $payroll_summary_view_list->Title->headerCellClass() ?>"><div id="elh_payroll_summary_view_Title" class="payroll_summary_view_Title"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->Title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Title" class="<?php echo $payroll_summary_view_list->Title->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->Title) ?>', 1);"><div id="elh_payroll_summary_view_Title" class="payroll_summary_view_Title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->Title->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->Surname->Visible) { // Surname ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $payroll_summary_view_list->Surname->headerCellClass() ?>"><div id="elh_payroll_summary_view_Surname" class="payroll_summary_view_Surname"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $payroll_summary_view_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->Surname) ?>', 1);"><div id="elh_payroll_summary_view_Surname" class="payroll_summary_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->FirstName->Visible) { // FirstName ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $payroll_summary_view_list->FirstName->headerCellClass() ?>"><div id="elh_payroll_summary_view_FirstName" class="payroll_summary_view_FirstName"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $payroll_summary_view_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->FirstName) ?>', 1);"><div id="elh_payroll_summary_view_FirstName" class="payroll_summary_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $payroll_summary_view_list->MiddleName->headerCellClass() ?>"><div id="elh_payroll_summary_view_MiddleName" class="payroll_summary_view_MiddleName"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $payroll_summary_view_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->MiddleName) ?>', 1);"><div id="elh_payroll_summary_view_MiddleName" class="payroll_summary_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->Sex->Visible) { // Sex ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $payroll_summary_view_list->Sex->headerCellClass() ?>"><div id="elh_payroll_summary_view_Sex" class="payroll_summary_view_Sex"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $payroll_summary_view_list->Sex->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->Sex) ?>', 1);"><div id="elh_payroll_summary_view_Sex" class="payroll_summary_view_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->Sex->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->NRC->Visible) { // NRC ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $payroll_summary_view_list->NRC->headerCellClass() ?>"><div id="elh_payroll_summary_view_NRC" class="payroll_summary_view_NRC"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $payroll_summary_view_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->NRC) ?>', 1);"><div id="elh_payroll_summary_view_NRC" class="payroll_summary_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->PositionName->Visible) { // PositionName ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $payroll_summary_view_list->PositionName->headerCellClass() ?>"><div id="elh_payroll_summary_view_PositionName" class="payroll_summary_view_PositionName"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $payroll_summary_view_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->PositionName) ?>', 1);"><div id="elh_payroll_summary_view_PositionName" class="payroll_summary_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $payroll_summary_view_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_payroll_summary_view_PayrollPeriod" class="payroll_summary_view_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $payroll_summary_view_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->PayrollPeriod) ?>', 1);"><div id="elh_payroll_summary_view_PayrollPeriod" class="payroll_summary_view_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->pCode->Visible) { // pCode ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->pCode) == "") { ?>
		<th data-name="pCode" class="<?php echo $payroll_summary_view_list->pCode->headerCellClass() ?>"><div id="elh_payroll_summary_view_pCode" class="payroll_summary_view_pCode"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->pCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pCode" class="<?php echo $payroll_summary_view_list->pCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->pCode) ?>', 1);"><div id="elh_payroll_summary_view_pCode" class="payroll_summary_view_pCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->pCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->pCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->pCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->pName->Visible) { // pName ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->pName) == "") { ?>
		<th data-name="pName" class="<?php echo $payroll_summary_view_list->pName->headerCellClass() ?>"><div id="elh_payroll_summary_view_pName" class="payroll_summary_view_pName"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->pName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pName" class="<?php echo $payroll_summary_view_list->pName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->pName) ?>', 1);"><div id="elh_payroll_summary_view_pName" class="payroll_summary_view_pName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->pName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->pName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->pName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->Amount->Visible) { // Amount ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->Amount) == "") { ?>
		<th data-name="Amount" class="<?php echo $payroll_summary_view_list->Amount->headerCellClass() ?>"><div id="elh_payroll_summary_view_Amount" class="payroll_summary_view_Amount"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->Amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Amount" class="<?php echo $payroll_summary_view_list->Amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->Amount) ?>', 1);"><div id="elh_payroll_summary_view_Amount" class="payroll_summary_view_Amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->Amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->Amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->PayPeriod->Visible) { // PayPeriod ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->PayPeriod) == "") { ?>
		<th data-name="PayPeriod" class="<?php echo $payroll_summary_view_list->PayPeriod->headerCellClass() ?>"><div id="elh_payroll_summary_view_PayPeriod" class="payroll_summary_view_PayPeriod"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->PayPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayPeriod" class="<?php echo $payroll_summary_view_list->PayPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->PayPeriod) ?>', 1);"><div id="elh_payroll_summary_view_PayPeriod" class="payroll_summary_view_PayPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->PayPeriod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->PayPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->PayPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $payroll_summary_view_list->SalaryScale->headerCellClass() ?>"><div id="elh_payroll_summary_view_SalaryScale" class="payroll_summary_view_SalaryScale"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $payroll_summary_view_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->SalaryScale) ?>', 1);"><div id="elh_payroll_summary_view_SalaryScale" class="payroll_summary_view_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->SalaryScale->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->Division->Visible) { // Division ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $payroll_summary_view_list->Division->headerCellClass() ?>"><div id="elh_payroll_summary_view_Division" class="payroll_summary_view_Division"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $payroll_summary_view_list->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->Division) ?>', 1);"><div id="elh_payroll_summary_view_Division" class="payroll_summary_view_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $payroll_summary_view_list->PaymentMethod->headerCellClass() ?>"><div id="elh_payroll_summary_view_PaymentMethod" class="payroll_summary_view_PaymentMethod"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $payroll_summary_view_list->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->PaymentMethod) ?>', 1);"><div id="elh_payroll_summary_view_PaymentMethod" class="payroll_summary_view_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->PaymentMethod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->BankBranchCode->Visible) { // BankBranchCode ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->BankBranchCode) == "") { ?>
		<th data-name="BankBranchCode" class="<?php echo $payroll_summary_view_list->BankBranchCode->headerCellClass() ?>"><div id="elh_payroll_summary_view_BankBranchCode" class="payroll_summary_view_BankBranchCode"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->BankBranchCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankBranchCode" class="<?php echo $payroll_summary_view_list->BankBranchCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->BankBranchCode) ?>', 1);"><div id="elh_payroll_summary_view_BankBranchCode" class="payroll_summary_view_BankBranchCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->BankBranchCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->BankBranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->BankBranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_list->BankAccountNo->Visible) { // BankAccountNo ?>
	<?php if ($payroll_summary_view_list->SortUrl($payroll_summary_view_list->BankAccountNo) == "") { ?>
		<th data-name="BankAccountNo" class="<?php echo $payroll_summary_view_list->BankAccountNo->headerCellClass() ?>"><div id="elh_payroll_summary_view_BankAccountNo" class="payroll_summary_view_BankAccountNo"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_list->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankAccountNo" class="<?php echo $payroll_summary_view_list->BankAccountNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_summary_view_list->SortUrl($payroll_summary_view_list->BankAccountNo) ?>', 1);"><div id="elh_payroll_summary_view_BankAccountNo" class="payroll_summary_view_BankAccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_list->BankAccountNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_list->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_list->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payroll_summary_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($payroll_summary_view_list->ExportAll && $payroll_summary_view_list->isExport()) {
	$payroll_summary_view_list->StopRecord = $payroll_summary_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($payroll_summary_view_list->TotalRecords > $payroll_summary_view_list->StartRecord + $payroll_summary_view_list->DisplayRecords - 1)
		$payroll_summary_view_list->StopRecord = $payroll_summary_view_list->StartRecord + $payroll_summary_view_list->DisplayRecords - 1;
	else
		$payroll_summary_view_list->StopRecord = $payroll_summary_view_list->TotalRecords;
}
$payroll_summary_view_list->RecordCount = $payroll_summary_view_list->StartRecord - 1;
if ($payroll_summary_view_list->Recordset && !$payroll_summary_view_list->Recordset->EOF) {
	$payroll_summary_view_list->Recordset->moveFirst();
	$selectLimit = $payroll_summary_view_list->UseSelectLimit;
	if (!$selectLimit && $payroll_summary_view_list->StartRecord > 1)
		$payroll_summary_view_list->Recordset->move($payroll_summary_view_list->StartRecord - 1);
} elseif (!$payroll_summary_view->AllowAddDeleteRow && $payroll_summary_view_list->StopRecord == 0) {
	$payroll_summary_view_list->StopRecord = $payroll_summary_view->GridAddRowCount;
}

// Initialize aggregate
$payroll_summary_view->RowType = ROWTYPE_AGGREGATEINIT;
$payroll_summary_view->resetAttributes();
$payroll_summary_view_list->renderRow();
while ($payroll_summary_view_list->RecordCount < $payroll_summary_view_list->StopRecord) {
	$payroll_summary_view_list->RecordCount++;
	if ($payroll_summary_view_list->RecordCount >= $payroll_summary_view_list->StartRecord) {
		$payroll_summary_view_list->RowCount++;

		// Set up key count
		$payroll_summary_view_list->KeyCount = $payroll_summary_view_list->RowIndex;

		// Init row class and style
		$payroll_summary_view->resetAttributes();
		$payroll_summary_view->CssClass = "";
		if ($payroll_summary_view_list->isGridAdd()) {
		} else {
			$payroll_summary_view_list->loadRowValues($payroll_summary_view_list->Recordset); // Load row values
		}
		$payroll_summary_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$payroll_summary_view->RowAttrs->merge(["data-rowindex" => $payroll_summary_view_list->RowCount, "id" => "r" . $payroll_summary_view_list->RowCount . "_payroll_summary_view", "data-rowtype" => $payroll_summary_view->RowType]);

		// Render row
		$payroll_summary_view_list->renderRow();

		// Render list options
		$payroll_summary_view_list->renderListOptions();
?>
	<tr <?php echo $payroll_summary_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payroll_summary_view_list->ListOptions->render("body", "left", $payroll_summary_view_list->RowCount);
?>
	<?php if ($payroll_summary_view_list->LocalAuthority->Visible) { // LocalAuthority ?>
		<td data-name="LocalAuthority" <?php echo $payroll_summary_view_list->LocalAuthority->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_LocalAuthority">
<span<?php echo $payroll_summary_view_list->LocalAuthority->viewAttributes() ?>><?php echo $payroll_summary_view_list->LocalAuthority->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->DepartmentName->Visible) { // DepartmentName ?>
		<td data-name="DepartmentName" <?php echo $payroll_summary_view_list->DepartmentName->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_DepartmentName">
<span<?php echo $payroll_summary_view_list->DepartmentName->viewAttributes() ?>><?php echo $payroll_summary_view_list->DepartmentName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->SectionName->Visible) { // SectionName ?>
		<td data-name="SectionName" <?php echo $payroll_summary_view_list->SectionName->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_SectionName">
<span<?php echo $payroll_summary_view_list->SectionName->viewAttributes() ?>><?php echo $payroll_summary_view_list->SectionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $payroll_summary_view_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_EmployeeID">
<span<?php echo $payroll_summary_view_list->EmployeeID->viewAttributes() ?>><?php echo $payroll_summary_view_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->Title->Visible) { // Title ?>
		<td data-name="Title" <?php echo $payroll_summary_view_list->Title->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_Title">
<span<?php echo $payroll_summary_view_list->Title->viewAttributes() ?>><?php echo $payroll_summary_view_list->Title->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $payroll_summary_view_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_Surname">
<span<?php echo $payroll_summary_view_list->Surname->viewAttributes() ?>><?php echo $payroll_summary_view_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $payroll_summary_view_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_FirstName">
<span<?php echo $payroll_summary_view_list->FirstName->viewAttributes() ?>><?php echo $payroll_summary_view_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $payroll_summary_view_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_MiddleName">
<span<?php echo $payroll_summary_view_list->MiddleName->viewAttributes() ?>><?php echo $payroll_summary_view_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $payroll_summary_view_list->Sex->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_Sex">
<span<?php echo $payroll_summary_view_list->Sex->viewAttributes() ?>><?php echo $payroll_summary_view_list->Sex->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $payroll_summary_view_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_NRC">
<span<?php echo $payroll_summary_view_list->NRC->viewAttributes() ?>><?php echo $payroll_summary_view_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $payroll_summary_view_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_PositionName">
<span<?php echo $payroll_summary_view_list->PositionName->viewAttributes() ?>><?php echo $payroll_summary_view_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $payroll_summary_view_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_PayrollPeriod">
<span<?php echo $payroll_summary_view_list->PayrollPeriod->viewAttributes() ?>><?php echo $payroll_summary_view_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->pCode->Visible) { // pCode ?>
		<td data-name="pCode" <?php echo $payroll_summary_view_list->pCode->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_pCode">
<span<?php echo $payroll_summary_view_list->pCode->viewAttributes() ?>><?php echo $payroll_summary_view_list->pCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->pName->Visible) { // pName ?>
		<td data-name="pName" <?php echo $payroll_summary_view_list->pName->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_pName">
<span<?php echo $payroll_summary_view_list->pName->viewAttributes() ?>><?php echo $payroll_summary_view_list->pName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->Amount->Visible) { // Amount ?>
		<td data-name="Amount" <?php echo $payroll_summary_view_list->Amount->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_Amount">
<span<?php echo $payroll_summary_view_list->Amount->viewAttributes() ?>><?php echo $payroll_summary_view_list->Amount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->PayPeriod->Visible) { // PayPeriod ?>
		<td data-name="PayPeriod" <?php echo $payroll_summary_view_list->PayPeriod->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_PayPeriod">
<span<?php echo $payroll_summary_view_list->PayPeriod->viewAttributes() ?>><?php echo $payroll_summary_view_list->PayPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $payroll_summary_view_list->SalaryScale->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_SalaryScale">
<span<?php echo $payroll_summary_view_list->SalaryScale->viewAttributes() ?>><?php echo $payroll_summary_view_list->SalaryScale->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $payroll_summary_view_list->Division->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_Division">
<span<?php echo $payroll_summary_view_list->Division->viewAttributes() ?>><?php echo $payroll_summary_view_list->Division->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $payroll_summary_view_list->PaymentMethod->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_PaymentMethod">
<span<?php echo $payroll_summary_view_list->PaymentMethod->viewAttributes() ?>><?php echo $payroll_summary_view_list->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->BankBranchCode->Visible) { // BankBranchCode ?>
		<td data-name="BankBranchCode" <?php echo $payroll_summary_view_list->BankBranchCode->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_BankBranchCode">
<span<?php echo $payroll_summary_view_list->BankBranchCode->viewAttributes() ?>><?php echo $payroll_summary_view_list->BankBranchCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_list->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo" <?php echo $payroll_summary_view_list->BankAccountNo->cellAttributes() ?>>
<span id="el<?php echo $payroll_summary_view_list->RowCount ?>_payroll_summary_view_BankAccountNo">
<span<?php echo $payroll_summary_view_list->BankAccountNo->viewAttributes() ?>><?php echo $payroll_summary_view_list->BankAccountNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payroll_summary_view_list->ListOptions->render("body", "right", $payroll_summary_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$payroll_summary_view_list->isGridAdd())
		$payroll_summary_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$payroll_summary_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payroll_summary_view_list->Recordset)
	$payroll_summary_view_list->Recordset->Close();
?>
<?php if (!$payroll_summary_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$payroll_summary_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_summary_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_summary_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payroll_summary_view_list->TotalRecords == 0 && !$payroll_summary_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payroll_summary_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$payroll_summary_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payroll_summary_view_list->isExport()) { ?>
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
$payroll_summary_view_list->terminate();
?>