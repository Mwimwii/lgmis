<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($payroll_summary_view_grid))
	$payroll_summary_view_grid = new payroll_summary_view_grid();

// Run the page
$payroll_summary_view_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_summary_view_grid->Page_Render();
?>
<?php if (!$payroll_summary_view_grid->isExport()) { ?>
<script>
var fpayroll_summary_viewgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fpayroll_summary_viewgrid = new ew.Form("fpayroll_summary_viewgrid", "grid");
	fpayroll_summary_viewgrid.formKeyCountName = '<?php echo $payroll_summary_view_grid->FormKeyCountName ?>';

	// Validate form
	fpayroll_summary_viewgrid.validate = function() {
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
			<?php if ($payroll_summary_view_grid->LocalAuthority->Required) { ?>
				elm = this.getElements("x" + infix + "_LocalAuthority");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->LocalAuthority->caption(), $payroll_summary_view_grid->LocalAuthority->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->DepartmentName->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->DepartmentName->caption(), $payroll_summary_view_grid->DepartmentName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->SectionName->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->SectionName->caption(), $payroll_summary_view_grid->SectionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->EmployeeID->caption(), $payroll_summary_view_grid->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payroll_summary_view_grid->EmployeeID->errorMessage()) ?>");
			<?php if ($payroll_summary_view_grid->Title->Required) { ?>
				elm = this.getElements("x" + infix + "_Title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->Title->caption(), $payroll_summary_view_grid->Title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->Surname->caption(), $payroll_summary_view_grid->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->FirstName->caption(), $payroll_summary_view_grid->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->MiddleName->caption(), $payroll_summary_view_grid->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->Sex->caption(), $payroll_summary_view_grid->Sex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->NRC->Required) { ?>
				elm = this.getElements("x" + infix + "_NRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->NRC->caption(), $payroll_summary_view_grid->NRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->PositionName->Required) { ?>
				elm = this.getElements("x" + infix + "_PositionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->PositionName->caption(), $payroll_summary_view_grid->PositionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->PayrollPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->PayrollPeriod->caption(), $payroll_summary_view_grid->PayrollPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->pCode->Required) { ?>
				elm = this.getElements("x" + infix + "_pCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->pCode->caption(), $payroll_summary_view_grid->pCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->pName->Required) { ?>
				elm = this.getElements("x" + infix + "_pName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->pName->caption(), $payroll_summary_view_grid->pName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->Amount->Required) { ?>
				elm = this.getElements("x" + infix + "_Amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->Amount->caption(), $payroll_summary_view_grid->Amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Amount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payroll_summary_view_grid->Amount->errorMessage()) ?>");
			<?php if ($payroll_summary_view_grid->PayPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_PayPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->PayPeriod->caption(), $payroll_summary_view_grid->PayPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->SalaryScale->Required) { ?>
				elm = this.getElements("x" + infix + "_SalaryScale");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->SalaryScale->caption(), $payroll_summary_view_grid->SalaryScale->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->Division->caption(), $payroll_summary_view_grid->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payroll_summary_view_grid->Division->errorMessage()) ?>");
			<?php if ($payroll_summary_view_grid->PaymentMethod->Required) { ?>
				elm = this.getElements("x" + infix + "_PaymentMethod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->PaymentMethod->caption(), $payroll_summary_view_grid->PaymentMethod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->BankBranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankBranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->BankBranchCode->caption(), $payroll_summary_view_grid->BankBranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_summary_view_grid->BankAccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BankAccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_summary_view_grid->BankAccountNo->caption(), $payroll_summary_view_grid->BankAccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fpayroll_summary_viewgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "LocalAuthority", false)) return false;
		if (ew.valueChanged(fobj, infix, "DepartmentName", false)) return false;
		if (ew.valueChanged(fobj, infix, "SectionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "EmployeeID", false)) return false;
		if (ew.valueChanged(fobj, infix, "Title", false)) return false;
		if (ew.valueChanged(fobj, infix, "Surname", false)) return false;
		if (ew.valueChanged(fobj, infix, "FirstName", false)) return false;
		if (ew.valueChanged(fobj, infix, "MiddleName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Sex", false)) return false;
		if (ew.valueChanged(fobj, infix, "NRC", false)) return false;
		if (ew.valueChanged(fobj, infix, "PositionName", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayrollPeriod", false)) return false;
		if (ew.valueChanged(fobj, infix, "pCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "pName", false)) return false;
		if (ew.valueChanged(fobj, infix, "Amount", false)) return false;
		if (ew.valueChanged(fobj, infix, "PayPeriod", false)) return false;
		if (ew.valueChanged(fobj, infix, "SalaryScale", false)) return false;
		if (ew.valueChanged(fobj, infix, "Division", false)) return false;
		if (ew.valueChanged(fobj, infix, "PaymentMethod", false)) return false;
		if (ew.valueChanged(fobj, infix, "BankBranchCode", false)) return false;
		if (ew.valueChanged(fobj, infix, "BankAccountNo", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fpayroll_summary_viewgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayroll_summary_viewgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpayroll_summary_viewgrid.lists["x_LocalAuthority"] = <?php echo $payroll_summary_view_grid->LocalAuthority->Lookup->toClientList($payroll_summary_view_grid) ?>;
	fpayroll_summary_viewgrid.lists["x_LocalAuthority"].options = <?php echo JsonEncode($payroll_summary_view_grid->LocalAuthority->lookupOptions()) ?>;
	fpayroll_summary_viewgrid.lists["x_PayrollPeriod"] = <?php echo $payroll_summary_view_grid->PayrollPeriod->Lookup->toClientList($payroll_summary_view_grid) ?>;
	fpayroll_summary_viewgrid.lists["x_PayrollPeriod"].options = <?php echo JsonEncode($payroll_summary_view_grid->PayrollPeriod->lookupOptions()) ?>;
	loadjs.done("fpayroll_summary_viewgrid");
});
</script>
<?php } ?>
<?php
$payroll_summary_view_grid->renderOtherOptions();
?>
<?php if ($payroll_summary_view_grid->TotalRecords > 0 || $payroll_summary_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payroll_summary_view_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payroll_summary_view">
<?php if ($payroll_summary_view_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $payroll_summary_view_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fpayroll_summary_viewgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_payroll_summary_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_payroll_summary_viewgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payroll_summary_view->RowType = ROWTYPE_HEADER;

// Render list options
$payroll_summary_view_grid->renderListOptions();

// Render list options (header, left)
$payroll_summary_view_grid->ListOptions->render("header", "left");
?>
<?php if ($payroll_summary_view_grid->LocalAuthority->Visible) { // LocalAuthority ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->LocalAuthority) == "") { ?>
		<th data-name="LocalAuthority" class="<?php echo $payroll_summary_view_grid->LocalAuthority->headerCellClass() ?>"><div id="elh_payroll_summary_view_LocalAuthority" class="payroll_summary_view_LocalAuthority"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->LocalAuthority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LocalAuthority" class="<?php echo $payroll_summary_view_grid->LocalAuthority->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_LocalAuthority" class="payroll_summary_view_LocalAuthority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->LocalAuthority->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->LocalAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->LocalAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->DepartmentName->Visible) { // DepartmentName ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->DepartmentName) == "") { ?>
		<th data-name="DepartmentName" class="<?php echo $payroll_summary_view_grid->DepartmentName->headerCellClass() ?>"><div id="elh_payroll_summary_view_DepartmentName" class="payroll_summary_view_DepartmentName"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->DepartmentName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentName" class="<?php echo $payroll_summary_view_grid->DepartmentName->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_DepartmentName" class="payroll_summary_view_DepartmentName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->DepartmentName->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->DepartmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->DepartmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->SectionName->Visible) { // SectionName ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->SectionName) == "") { ?>
		<th data-name="SectionName" class="<?php echo $payroll_summary_view_grid->SectionName->headerCellClass() ?>"><div id="elh_payroll_summary_view_SectionName" class="payroll_summary_view_SectionName"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->SectionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionName" class="<?php echo $payroll_summary_view_grid->SectionName->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_SectionName" class="payroll_summary_view_SectionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->SectionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->SectionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->SectionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $payroll_summary_view_grid->EmployeeID->headerCellClass() ?>"><div id="elh_payroll_summary_view_EmployeeID" class="payroll_summary_view_EmployeeID"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $payroll_summary_view_grid->EmployeeID->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_EmployeeID" class="payroll_summary_view_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->Title->Visible) { // Title ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->Title) == "") { ?>
		<th data-name="Title" class="<?php echo $payroll_summary_view_grid->Title->headerCellClass() ?>"><div id="elh_payroll_summary_view_Title" class="payroll_summary_view_Title"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->Title->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Title" class="<?php echo $payroll_summary_view_grid->Title->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_Title" class="payroll_summary_view_Title">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->Title->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->Title->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->Title->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->Surname->Visible) { // Surname ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $payroll_summary_view_grid->Surname->headerCellClass() ?>"><div id="elh_payroll_summary_view_Surname" class="payroll_summary_view_Surname"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $payroll_summary_view_grid->Surname->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_Surname" class="payroll_summary_view_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->Surname->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->FirstName->Visible) { // FirstName ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $payroll_summary_view_grid->FirstName->headerCellClass() ?>"><div id="elh_payroll_summary_view_FirstName" class="payroll_summary_view_FirstName"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $payroll_summary_view_grid->FirstName->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_FirstName" class="payroll_summary_view_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->FirstName->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->MiddleName->Visible) { // MiddleName ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $payroll_summary_view_grid->MiddleName->headerCellClass() ?>"><div id="elh_payroll_summary_view_MiddleName" class="payroll_summary_view_MiddleName"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $payroll_summary_view_grid->MiddleName->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_MiddleName" class="payroll_summary_view_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->MiddleName->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->Sex->Visible) { // Sex ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->Sex) == "") { ?>
		<th data-name="Sex" class="<?php echo $payroll_summary_view_grid->Sex->headerCellClass() ?>"><div id="elh_payroll_summary_view_Sex" class="payroll_summary_view_Sex"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->Sex->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sex" class="<?php echo $payroll_summary_view_grid->Sex->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_Sex" class="payroll_summary_view_Sex">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->Sex->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->Sex->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->Sex->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->NRC->Visible) { // NRC ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $payroll_summary_view_grid->NRC->headerCellClass() ?>"><div id="elh_payroll_summary_view_NRC" class="payroll_summary_view_NRC"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $payroll_summary_view_grid->NRC->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_NRC" class="payroll_summary_view_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->NRC->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->PositionName->Visible) { // PositionName ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $payroll_summary_view_grid->PositionName->headerCellClass() ?>"><div id="elh_payroll_summary_view_PositionName" class="payroll_summary_view_PositionName"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $payroll_summary_view_grid->PositionName->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_PositionName" class="payroll_summary_view_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->PositionName->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $payroll_summary_view_grid->PayrollPeriod->headerCellClass() ?>"><div id="elh_payroll_summary_view_PayrollPeriod" class="payroll_summary_view_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $payroll_summary_view_grid->PayrollPeriod->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_PayrollPeriod" class="payroll_summary_view_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->pCode->Visible) { // pCode ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->pCode) == "") { ?>
		<th data-name="pCode" class="<?php echo $payroll_summary_view_grid->pCode->headerCellClass() ?>"><div id="elh_payroll_summary_view_pCode" class="payroll_summary_view_pCode"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->pCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pCode" class="<?php echo $payroll_summary_view_grid->pCode->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_pCode" class="payroll_summary_view_pCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->pCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->pCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->pCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->pName->Visible) { // pName ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->pName) == "") { ?>
		<th data-name="pName" class="<?php echo $payroll_summary_view_grid->pName->headerCellClass() ?>"><div id="elh_payroll_summary_view_pName" class="payroll_summary_view_pName"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->pName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pName" class="<?php echo $payroll_summary_view_grid->pName->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_pName" class="payroll_summary_view_pName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->pName->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->pName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->pName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->Amount->Visible) { // Amount ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->Amount) == "") { ?>
		<th data-name="Amount" class="<?php echo $payroll_summary_view_grid->Amount->headerCellClass() ?>"><div id="elh_payroll_summary_view_Amount" class="payroll_summary_view_Amount"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->Amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Amount" class="<?php echo $payroll_summary_view_grid->Amount->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_Amount" class="payroll_summary_view_Amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->Amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->Amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->Amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->PayPeriod->Visible) { // PayPeriod ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->PayPeriod) == "") { ?>
		<th data-name="PayPeriod" class="<?php echo $payroll_summary_view_grid->PayPeriod->headerCellClass() ?>"><div id="elh_payroll_summary_view_PayPeriod" class="payroll_summary_view_PayPeriod"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->PayPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayPeriod" class="<?php echo $payroll_summary_view_grid->PayPeriod->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_PayPeriod" class="payroll_summary_view_PayPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->PayPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->PayPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->PayPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $payroll_summary_view_grid->SalaryScale->headerCellClass() ?>"><div id="elh_payroll_summary_view_SalaryScale" class="payroll_summary_view_SalaryScale"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $payroll_summary_view_grid->SalaryScale->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_SalaryScale" class="payroll_summary_view_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->SalaryScale->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->Division->Visible) { // Division ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $payroll_summary_view_grid->Division->headerCellClass() ?>"><div id="elh_payroll_summary_view_Division" class="payroll_summary_view_Division"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $payroll_summary_view_grid->Division->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_Division" class="payroll_summary_view_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $payroll_summary_view_grid->PaymentMethod->headerCellClass() ?>"><div id="elh_payroll_summary_view_PaymentMethod" class="payroll_summary_view_PaymentMethod"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $payroll_summary_view_grid->PaymentMethod->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_PaymentMethod" class="payroll_summary_view_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->PaymentMethod->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->BankBranchCode->Visible) { // BankBranchCode ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->BankBranchCode) == "") { ?>
		<th data-name="BankBranchCode" class="<?php echo $payroll_summary_view_grid->BankBranchCode->headerCellClass() ?>"><div id="elh_payroll_summary_view_BankBranchCode" class="payroll_summary_view_BankBranchCode"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->BankBranchCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankBranchCode" class="<?php echo $payroll_summary_view_grid->BankBranchCode->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_BankBranchCode" class="payroll_summary_view_BankBranchCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->BankBranchCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->BankBranchCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->BankBranchCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_summary_view_grid->BankAccountNo->Visible) { // BankAccountNo ?>
	<?php if ($payroll_summary_view_grid->SortUrl($payroll_summary_view_grid->BankAccountNo) == "") { ?>
		<th data-name="BankAccountNo" class="<?php echo $payroll_summary_view_grid->BankAccountNo->headerCellClass() ?>"><div id="elh_payroll_summary_view_BankAccountNo" class="payroll_summary_view_BankAccountNo"><div class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->BankAccountNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankAccountNo" class="<?php echo $payroll_summary_view_grid->BankAccountNo->headerCellClass() ?>"><div><div id="elh_payroll_summary_view_BankAccountNo" class="payroll_summary_view_BankAccountNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_summary_view_grid->BankAccountNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_summary_view_grid->BankAccountNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_summary_view_grid->BankAccountNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payroll_summary_view_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$payroll_summary_view_grid->StartRecord = 1;
$payroll_summary_view_grid->StopRecord = $payroll_summary_view_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($payroll_summary_view->isConfirm() || $payroll_summary_view_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($payroll_summary_view_grid->FormKeyCountName) && ($payroll_summary_view_grid->isGridAdd() || $payroll_summary_view_grid->isGridEdit() || $payroll_summary_view->isConfirm())) {
		$payroll_summary_view_grid->KeyCount = $CurrentForm->getValue($payroll_summary_view_grid->FormKeyCountName);
		$payroll_summary_view_grid->StopRecord = $payroll_summary_view_grid->StartRecord + $payroll_summary_view_grid->KeyCount - 1;
	}
}
$payroll_summary_view_grid->RecordCount = $payroll_summary_view_grid->StartRecord - 1;
if ($payroll_summary_view_grid->Recordset && !$payroll_summary_view_grid->Recordset->EOF) {
	$payroll_summary_view_grid->Recordset->moveFirst();
	$selectLimit = $payroll_summary_view_grid->UseSelectLimit;
	if (!$selectLimit && $payroll_summary_view_grid->StartRecord > 1)
		$payroll_summary_view_grid->Recordset->move($payroll_summary_view_grid->StartRecord - 1);
} elseif (!$payroll_summary_view->AllowAddDeleteRow && $payroll_summary_view_grid->StopRecord == 0) {
	$payroll_summary_view_grid->StopRecord = $payroll_summary_view->GridAddRowCount;
}

// Initialize aggregate
$payroll_summary_view->RowType = ROWTYPE_AGGREGATEINIT;
$payroll_summary_view->resetAttributes();
$payroll_summary_view_grid->renderRow();
if ($payroll_summary_view_grid->isGridAdd())
	$payroll_summary_view_grid->RowIndex = 0;
if ($payroll_summary_view_grid->isGridEdit())
	$payroll_summary_view_grid->RowIndex = 0;
while ($payroll_summary_view_grid->RecordCount < $payroll_summary_view_grid->StopRecord) {
	$payroll_summary_view_grid->RecordCount++;
	if ($payroll_summary_view_grid->RecordCount >= $payroll_summary_view_grid->StartRecord) {
		$payroll_summary_view_grid->RowCount++;
		if ($payroll_summary_view_grid->isGridAdd() || $payroll_summary_view_grid->isGridEdit() || $payroll_summary_view->isConfirm()) {
			$payroll_summary_view_grid->RowIndex++;
			$CurrentForm->Index = $payroll_summary_view_grid->RowIndex;
			if ($CurrentForm->hasValue($payroll_summary_view_grid->FormActionName) && ($payroll_summary_view->isConfirm() || $payroll_summary_view_grid->EventCancelled))
				$payroll_summary_view_grid->RowAction = strval($CurrentForm->getValue($payroll_summary_view_grid->FormActionName));
			elseif ($payroll_summary_view_grid->isGridAdd())
				$payroll_summary_view_grid->RowAction = "insert";
			else
				$payroll_summary_view_grid->RowAction = "";
		}

		// Set up key count
		$payroll_summary_view_grid->KeyCount = $payroll_summary_view_grid->RowIndex;

		// Init row class and style
		$payroll_summary_view->resetAttributes();
		$payroll_summary_view->CssClass = "";
		if ($payroll_summary_view_grid->isGridAdd()) {
			if ($payroll_summary_view->CurrentMode == "copy") {
				$payroll_summary_view_grid->loadRowValues($payroll_summary_view_grid->Recordset); // Load row values
				$payroll_summary_view_grid->setRecordKey($payroll_summary_view_grid->RowOldKey, $payroll_summary_view_grid->Recordset); // Set old record key
			} else {
				$payroll_summary_view_grid->loadRowValues(); // Load default values
				$payroll_summary_view_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$payroll_summary_view_grid->loadRowValues($payroll_summary_view_grid->Recordset); // Load row values
		}
		$payroll_summary_view->RowType = ROWTYPE_VIEW; // Render view
		if ($payroll_summary_view_grid->isGridAdd()) // Grid add
			$payroll_summary_view->RowType = ROWTYPE_ADD; // Render add
		if ($payroll_summary_view_grid->isGridAdd() && $payroll_summary_view->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$payroll_summary_view_grid->restoreCurrentRowFormValues($payroll_summary_view_grid->RowIndex); // Restore form values
		if ($payroll_summary_view_grid->isGridEdit()) { // Grid edit
			if ($payroll_summary_view->EventCancelled)
				$payroll_summary_view_grid->restoreCurrentRowFormValues($payroll_summary_view_grid->RowIndex); // Restore form values
			if ($payroll_summary_view_grid->RowAction == "insert")
				$payroll_summary_view->RowType = ROWTYPE_ADD; // Render add
			else
				$payroll_summary_view->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($payroll_summary_view_grid->isGridEdit() && ($payroll_summary_view->RowType == ROWTYPE_EDIT || $payroll_summary_view->RowType == ROWTYPE_ADD) && $payroll_summary_view->EventCancelled) // Update failed
			$payroll_summary_view_grid->restoreCurrentRowFormValues($payroll_summary_view_grid->RowIndex); // Restore form values
		if ($payroll_summary_view->RowType == ROWTYPE_EDIT) // Edit row
			$payroll_summary_view_grid->EditRowCount++;
		if ($payroll_summary_view->isConfirm()) // Confirm row
			$payroll_summary_view_grid->restoreCurrentRowFormValues($payroll_summary_view_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$payroll_summary_view->RowAttrs->merge(["data-rowindex" => $payroll_summary_view_grid->RowCount, "id" => "r" . $payroll_summary_view_grid->RowCount . "_payroll_summary_view", "data-rowtype" => $payroll_summary_view->RowType]);

		// Render row
		$payroll_summary_view_grid->renderRow();

		// Render list options
		$payroll_summary_view_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($payroll_summary_view_grid->RowAction != "delete" && $payroll_summary_view_grid->RowAction != "insertdelete" && !($payroll_summary_view_grid->RowAction == "insert" && $payroll_summary_view->isConfirm() && $payroll_summary_view_grid->emptyRow())) {
?>
	<tr <?php echo $payroll_summary_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payroll_summary_view_grid->ListOptions->render("body", "left", $payroll_summary_view_grid->RowCount);
?>
	<?php if ($payroll_summary_view_grid->LocalAuthority->Visible) { // LocalAuthority ?>
		<td data-name="LocalAuthority" <?php echo $payroll_summary_view_grid->LocalAuthority->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_LocalAuthority" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority"><?php echo EmptyValue(strval($payroll_summary_view_grid->LocalAuthority->ViewValue)) ? $Language->phrase("PleaseSelect") : $payroll_summary_view_grid->LocalAuthority->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($payroll_summary_view_grid->LocalAuthority->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($payroll_summary_view_grid->LocalAuthority->ReadOnly || $payroll_summary_view_grid->LocalAuthority->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $payroll_summary_view_grid->LocalAuthority->Lookup->getParamTag($payroll_summary_view_grid, "p_x" . $payroll_summary_view_grid->RowIndex . "_LocalAuthority") ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_LocalAuthority" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $payroll_summary_view_grid->LocalAuthority->displayValueSeparatorAttribute() ?>" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" value="<?php echo $payroll_summary_view_grid->LocalAuthority->CurrentValue ?>"<?php echo $payroll_summary_view_grid->LocalAuthority->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_LocalAuthority" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" value="<?php echo HtmlEncode($payroll_summary_view_grid->LocalAuthority->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_LocalAuthority" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority"><?php echo EmptyValue(strval($payroll_summary_view_grid->LocalAuthority->ViewValue)) ? $Language->phrase("PleaseSelect") : $payroll_summary_view_grid->LocalAuthority->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($payroll_summary_view_grid->LocalAuthority->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($payroll_summary_view_grid->LocalAuthority->ReadOnly || $payroll_summary_view_grid->LocalAuthority->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $payroll_summary_view_grid->LocalAuthority->Lookup->getParamTag($payroll_summary_view_grid, "p_x" . $payroll_summary_view_grid->RowIndex . "_LocalAuthority") ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_LocalAuthority" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $payroll_summary_view_grid->LocalAuthority->displayValueSeparatorAttribute() ?>" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" value="<?php echo $payroll_summary_view_grid->LocalAuthority->CurrentValue ?>"<?php echo $payroll_summary_view_grid->LocalAuthority->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_LocalAuthority">
<span<?php echo $payroll_summary_view_grid->LocalAuthority->viewAttributes() ?>><?php echo $payroll_summary_view_grid->LocalAuthority->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_LocalAuthority" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" value="<?php echo HtmlEncode($payroll_summary_view_grid->LocalAuthority->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_LocalAuthority" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" value="<?php echo HtmlEncode($payroll_summary_view_grid->LocalAuthority->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_LocalAuthority" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" value="<?php echo HtmlEncode($payroll_summary_view_grid->LocalAuthority->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_LocalAuthority" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" value="<?php echo HtmlEncode($payroll_summary_view_grid->LocalAuthority->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->DepartmentName->Visible) { // DepartmentName ?>
		<td data-name="DepartmentName" <?php echo $payroll_summary_view_grid->DepartmentName->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_DepartmentName" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_DepartmentName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->DepartmentName->EditValue ?>"<?php echo $payroll_summary_view_grid->DepartmentName->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_DepartmentName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($payroll_summary_view_grid->DepartmentName->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_DepartmentName" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_DepartmentName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->DepartmentName->EditValue ?>"<?php echo $payroll_summary_view_grid->DepartmentName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_DepartmentName">
<span<?php echo $payroll_summary_view_grid->DepartmentName->viewAttributes() ?>><?php echo $payroll_summary_view_grid->DepartmentName->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_DepartmentName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($payroll_summary_view_grid->DepartmentName->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_DepartmentName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($payroll_summary_view_grid->DepartmentName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_DepartmentName" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($payroll_summary_view_grid->DepartmentName->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_DepartmentName" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($payroll_summary_view_grid->DepartmentName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->SectionName->Visible) { // SectionName ?>
		<td data-name="SectionName" <?php echo $payroll_summary_view_grid->SectionName->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_SectionName" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_SectionName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->SectionName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->SectionName->EditValue ?>"<?php echo $payroll_summary_view_grid->SectionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_SectionName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->SectionName->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_SectionName" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_SectionName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->SectionName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->SectionName->EditValue ?>"<?php echo $payroll_summary_view_grid->SectionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_SectionName">
<span<?php echo $payroll_summary_view_grid->SectionName->viewAttributes() ?>><?php echo $payroll_summary_view_grid->SectionName->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_SectionName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->SectionName->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_SectionName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->SectionName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_SectionName" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->SectionName->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_SectionName" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->SectionName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $payroll_summary_view_grid->EmployeeID->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_EmployeeID" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_EmployeeID" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->EmployeeID->EditValue ?>"<?php echo $payroll_summary_view_grid->EmployeeID->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_EmployeeID" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($payroll_summary_view_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="payroll_summary_view" data-field="x_EmployeeID" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->EmployeeID->EditValue ?>"<?php echo $payroll_summary_view_grid->EmployeeID->editAttributes() ?>>
<input type="hidden" data-table="payroll_summary_view" data-field="x_EmployeeID" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($payroll_summary_view_grid->EmployeeID->OldValue != null ? $payroll_summary_view_grid->EmployeeID->OldValue : $payroll_summary_view_grid->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_EmployeeID">
<span<?php echo $payroll_summary_view_grid->EmployeeID->viewAttributes() ?>><?php echo $payroll_summary_view_grid->EmployeeID->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_EmployeeID" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($payroll_summary_view_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_EmployeeID" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($payroll_summary_view_grid->EmployeeID->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_EmployeeID" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($payroll_summary_view_grid->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_EmployeeID" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($payroll_summary_view_grid->EmployeeID->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->Title->Visible) { // Title ?>
		<td data-name="Title" <?php echo $payroll_summary_view_grid->Title->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Title" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_Title" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Title->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Title->EditValue ?>"<?php echo $payroll_summary_view_grid->Title->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Title" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" value="<?php echo HtmlEncode($payroll_summary_view_grid->Title->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Title" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_Title" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Title->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Title->EditValue ?>"<?php echo $payroll_summary_view_grid->Title->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Title">
<span<?php echo $payroll_summary_view_grid->Title->viewAttributes() ?>><?php echo $payroll_summary_view_grid->Title->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Title" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" value="<?php echo HtmlEncode($payroll_summary_view_grid->Title->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_Title" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" value="<?php echo HtmlEncode($payroll_summary_view_grid->Title->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Title" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" value="<?php echo HtmlEncode($payroll_summary_view_grid->Title->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_Title" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" value="<?php echo HtmlEncode($payroll_summary_view_grid->Title->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $payroll_summary_view_grid->Surname->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Surname" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_Surname" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Surname->EditValue ?>"<?php echo $payroll_summary_view_grid->Surname->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Surname" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($payroll_summary_view_grid->Surname->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Surname" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_Surname" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Surname->EditValue ?>"<?php echo $payroll_summary_view_grid->Surname->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Surname">
<span<?php echo $payroll_summary_view_grid->Surname->viewAttributes() ?>><?php echo $payroll_summary_view_grid->Surname->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Surname" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($payroll_summary_view_grid->Surname->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_Surname" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($payroll_summary_view_grid->Surname->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Surname" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($payroll_summary_view_grid->Surname->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_Surname" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($payroll_summary_view_grid->Surname->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $payroll_summary_view_grid->FirstName->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_FirstName" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_FirstName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->FirstName->EditValue ?>"<?php echo $payroll_summary_view_grid->FirstName->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_FirstName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($payroll_summary_view_grid->FirstName->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_FirstName" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_FirstName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->FirstName->EditValue ?>"<?php echo $payroll_summary_view_grid->FirstName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_FirstName">
<span<?php echo $payroll_summary_view_grid->FirstName->viewAttributes() ?>><?php echo $payroll_summary_view_grid->FirstName->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_FirstName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($payroll_summary_view_grid->FirstName->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_FirstName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($payroll_summary_view_grid->FirstName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_FirstName" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($payroll_summary_view_grid->FirstName->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_FirstName" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($payroll_summary_view_grid->FirstName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $payroll_summary_view_grid->MiddleName->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_MiddleName" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_MiddleName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->MiddleName->EditValue ?>"<?php echo $payroll_summary_view_grid->MiddleName->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_MiddleName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($payroll_summary_view_grid->MiddleName->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_MiddleName" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_MiddleName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->MiddleName->EditValue ?>"<?php echo $payroll_summary_view_grid->MiddleName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_MiddleName">
<span<?php echo $payroll_summary_view_grid->MiddleName->viewAttributes() ?>><?php echo $payroll_summary_view_grid->MiddleName->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_MiddleName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($payroll_summary_view_grid->MiddleName->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_MiddleName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($payroll_summary_view_grid->MiddleName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_MiddleName" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($payroll_summary_view_grid->MiddleName->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_MiddleName" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($payroll_summary_view_grid->MiddleName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->Sex->Visible) { // Sex ?>
		<td data-name="Sex" <?php echo $payroll_summary_view_grid->Sex->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Sex" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_Sex" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Sex->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Sex->EditValue ?>"<?php echo $payroll_summary_view_grid->Sex->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Sex" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($payroll_summary_view_grid->Sex->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Sex" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_Sex" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Sex->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Sex->EditValue ?>"<?php echo $payroll_summary_view_grid->Sex->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Sex">
<span<?php echo $payroll_summary_view_grid->Sex->viewAttributes() ?>><?php echo $payroll_summary_view_grid->Sex->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Sex" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($payroll_summary_view_grid->Sex->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_Sex" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($payroll_summary_view_grid->Sex->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Sex" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($payroll_summary_view_grid->Sex->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_Sex" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($payroll_summary_view_grid->Sex->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $payroll_summary_view_grid->NRC->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_NRC" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_NRC" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->NRC->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->NRC->EditValue ?>"<?php echo $payroll_summary_view_grid->NRC->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_NRC" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($payroll_summary_view_grid->NRC->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_NRC" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_NRC" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->NRC->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->NRC->EditValue ?>"<?php echo $payroll_summary_view_grid->NRC->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_NRC">
<span<?php echo $payroll_summary_view_grid->NRC->viewAttributes() ?>><?php echo $payroll_summary_view_grid->NRC->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_NRC" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($payroll_summary_view_grid->NRC->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_NRC" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($payroll_summary_view_grid->NRC->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_NRC" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($payroll_summary_view_grid->NRC->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_NRC" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($payroll_summary_view_grid->NRC->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $payroll_summary_view_grid->PositionName->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PositionName" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_PositionName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->PositionName->EditValue ?>"<?php echo $payroll_summary_view_grid->PositionName->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PositionName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->PositionName->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PositionName" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_PositionName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->PositionName->EditValue ?>"<?php echo $payroll_summary_view_grid->PositionName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PositionName">
<span<?php echo $payroll_summary_view_grid->PositionName->viewAttributes() ?>><?php echo $payroll_summary_view_grid->PositionName->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PositionName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->PositionName->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_PositionName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->PositionName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PositionName" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->PositionName->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_PositionName" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->PositionName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $payroll_summary_view_grid->PayrollPeriod->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($payroll_summary_view_grid->PayrollPeriod->getSessionValue() != "") { ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PayrollPeriod" class="form-group">
<span<?php echo $payroll_summary_view_grid->PayrollPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->PayrollPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayrollPeriod->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PayrollPeriod" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="payroll_summary_view" data-field="x_PayrollPeriod" data-value-separator="<?php echo $payroll_summary_view_grid->PayrollPeriod->displayValueSeparatorAttribute() ?>" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod"<?php echo $payroll_summary_view_grid->PayrollPeriod->editAttributes() ?>>
			<?php echo $payroll_summary_view_grid->PayrollPeriod->selectOptionListHtml("x{$payroll_summary_view_grid->RowIndex}_PayrollPeriod") ?>
		</select>
</div>
<?php echo $payroll_summary_view_grid->PayrollPeriod->Lookup->getParamTag($payroll_summary_view_grid, "p_x" . $payroll_summary_view_grid->RowIndex . "_PayrollPeriod") ?>
</span>
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayrollPeriod" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayrollPeriod->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($payroll_summary_view_grid->PayrollPeriod->getSessionValue() != "") { ?>

<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PayrollPeriod" class="form-group">
<span<?php echo $payroll_summary_view_grid->PayrollPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->PayrollPeriod->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayrollPeriod->CurrentValue) ?>">
<?php } else { ?>

<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="payroll_summary_view" data-field="x_PayrollPeriod" data-value-separator="<?php echo $payroll_summary_view_grid->PayrollPeriod->displayValueSeparatorAttribute() ?>" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod"<?php echo $payroll_summary_view_grid->PayrollPeriod->editAttributes() ?>>
			<?php echo $payroll_summary_view_grid->PayrollPeriod->selectOptionListHtml("x{$payroll_summary_view_grid->RowIndex}_PayrollPeriod") ?>
		</select>
</div>
<?php echo $payroll_summary_view_grid->PayrollPeriod->Lookup->getParamTag($payroll_summary_view_grid, "p_x" . $payroll_summary_view_grid->RowIndex . "_PayrollPeriod") ?>

<?php } ?>

<input type="hidden" data-table="payroll_summary_view" data-field="x_PayrollPeriod" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayrollPeriod->OldValue != null ? $payroll_summary_view_grid->PayrollPeriod->OldValue : $payroll_summary_view_grid->PayrollPeriod->CurrentValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PayrollPeriod">
<span<?php echo $payroll_summary_view_grid->PayrollPeriod->viewAttributes() ?>><?php echo $payroll_summary_view_grid->PayrollPeriod->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayrollPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayrollPeriod->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayrollPeriod" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayrollPeriod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayrollPeriod" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayrollPeriod->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayrollPeriod" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayrollPeriod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->pCode->Visible) { // pCode ?>
		<td data-name="pCode" <?php echo $payroll_summary_view_grid->pCode->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_pCode" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_pCode" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->pCode->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->pCode->EditValue ?>"<?php echo $payroll_summary_view_grid->pCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_pCode" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->pCode->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<input type="text" data-table="payroll_summary_view" data-field="x_pCode" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->pCode->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->pCode->EditValue ?>"<?php echo $payroll_summary_view_grid->pCode->editAttributes() ?>>
<input type="hidden" data-table="payroll_summary_view" data-field="x_pCode" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->pCode->OldValue != null ? $payroll_summary_view_grid->pCode->OldValue : $payroll_summary_view_grid->pCode->CurrentValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_pCode">
<span<?php echo $payroll_summary_view_grid->pCode->viewAttributes() ?>><?php echo $payroll_summary_view_grid->pCode->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_pCode" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->pCode->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_pCode" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->pCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_pCode" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->pCode->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_pCode" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->pCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->pName->Visible) { // pName ?>
		<td data-name="pName" <?php echo $payroll_summary_view_grid->pName->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_pName" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_pName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->pName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->pName->EditValue ?>"<?php echo $payroll_summary_view_grid->pName->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_pName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" value="<?php echo HtmlEncode($payroll_summary_view_grid->pName->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_pName" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_pName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->pName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->pName->EditValue ?>"<?php echo $payroll_summary_view_grid->pName->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_pName">
<span<?php echo $payroll_summary_view_grid->pName->viewAttributes() ?>><?php echo $payroll_summary_view_grid->pName->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_pName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" value="<?php echo HtmlEncode($payroll_summary_view_grid->pName->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_pName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" value="<?php echo HtmlEncode($payroll_summary_view_grid->pName->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_pName" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" value="<?php echo HtmlEncode($payroll_summary_view_grid->pName->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_pName" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" value="<?php echo HtmlEncode($payroll_summary_view_grid->pName->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->Amount->Visible) { // Amount ?>
		<td data-name="Amount" <?php echo $payroll_summary_view_grid->Amount->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Amount" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_Amount" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" size="30" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Amount->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Amount->EditValue ?>"<?php echo $payroll_summary_view_grid->Amount->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Amount" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($payroll_summary_view_grid->Amount->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Amount" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_Amount" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" size="30" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Amount->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Amount->EditValue ?>"<?php echo $payroll_summary_view_grid->Amount->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Amount">
<span<?php echo $payroll_summary_view_grid->Amount->viewAttributes() ?>><?php echo $payroll_summary_view_grid->Amount->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Amount" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($payroll_summary_view_grid->Amount->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_Amount" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($payroll_summary_view_grid->Amount->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Amount" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($payroll_summary_view_grid->Amount->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_Amount" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($payroll_summary_view_grid->Amount->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->PayPeriod->Visible) { // PayPeriod ?>
		<td data-name="PayPeriod" <?php echo $payroll_summary_view_grid->PayPeriod->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PayPeriod" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_PayPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->PayPeriod->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->PayPeriod->EditValue ?>"<?php echo $payroll_summary_view_grid->PayPeriod->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayPeriod" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayPeriod->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PayPeriod" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_PayPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->PayPeriod->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->PayPeriod->EditValue ?>"<?php echo $payroll_summary_view_grid->PayPeriod->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PayPeriod">
<span<?php echo $payroll_summary_view_grid->PayPeriod->viewAttributes() ?>><?php echo $payroll_summary_view_grid->PayPeriod->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayPeriod->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayPeriod" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayPeriod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayPeriod" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayPeriod->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayPeriod" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayPeriod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $payroll_summary_view_grid->SalaryScale->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_SalaryScale" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_SalaryScale" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->SalaryScale->EditValue ?>"<?php echo $payroll_summary_view_grid->SalaryScale->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_SalaryScale" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($payroll_summary_view_grid->SalaryScale->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_SalaryScale" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_SalaryScale" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->SalaryScale->EditValue ?>"<?php echo $payroll_summary_view_grid->SalaryScale->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_SalaryScale">
<span<?php echo $payroll_summary_view_grid->SalaryScale->viewAttributes() ?>><?php echo $payroll_summary_view_grid->SalaryScale->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_SalaryScale" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($payroll_summary_view_grid->SalaryScale->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_SalaryScale" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($payroll_summary_view_grid->SalaryScale->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_SalaryScale" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($payroll_summary_view_grid->SalaryScale->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_SalaryScale" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($payroll_summary_view_grid->SalaryScale->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $payroll_summary_view_grid->Division->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Division" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_Division" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Division->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Division->EditValue ?>"<?php echo $payroll_summary_view_grid->Division->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Division" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($payroll_summary_view_grid->Division->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Division" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_Division" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Division->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Division->EditValue ?>"<?php echo $payroll_summary_view_grid->Division->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_Division">
<span<?php echo $payroll_summary_view_grid->Division->viewAttributes() ?>><?php echo $payroll_summary_view_grid->Division->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Division" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($payroll_summary_view_grid->Division->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_Division" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($payroll_summary_view_grid->Division->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Division" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($payroll_summary_view_grid->Division->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_Division" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($payroll_summary_view_grid->Division->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $payroll_summary_view_grid->PaymentMethod->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PaymentMethod" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_PaymentMethod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->PaymentMethod->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->PaymentMethod->EditValue ?>"<?php echo $payroll_summary_view_grid->PaymentMethod->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PaymentMethod" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PaymentMethod->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PaymentMethod" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_PaymentMethod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->PaymentMethod->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->PaymentMethod->EditValue ?>"<?php echo $payroll_summary_view_grid->PaymentMethod->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_PaymentMethod">
<span<?php echo $payroll_summary_view_grid->PaymentMethod->viewAttributes() ?>><?php echo $payroll_summary_view_grid->PaymentMethod->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PaymentMethod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PaymentMethod->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_PaymentMethod" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PaymentMethod->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PaymentMethod" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PaymentMethod->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_PaymentMethod" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PaymentMethod->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->BankBranchCode->Visible) { // BankBranchCode ?>
		<td data-name="BankBranchCode" <?php echo $payroll_summary_view_grid->BankBranchCode->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_BankBranchCode" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_BankBranchCode" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->BankBranchCode->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->BankBranchCode->EditValue ?>"<?php echo $payroll_summary_view_grid->BankBranchCode->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankBranchCode" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankBranchCode->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_BankBranchCode" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_BankBranchCode" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->BankBranchCode->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->BankBranchCode->EditValue ?>"<?php echo $payroll_summary_view_grid->BankBranchCode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_BankBranchCode">
<span<?php echo $payroll_summary_view_grid->BankBranchCode->viewAttributes() ?>><?php echo $payroll_summary_view_grid->BankBranchCode->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankBranchCode" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankBranchCode->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankBranchCode" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankBranchCode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankBranchCode" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankBranchCode->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankBranchCode" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankBranchCode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo" <?php echo $payroll_summary_view_grid->BankAccountNo->cellAttributes() ?>>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_BankAccountNo" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_BankAccountNo" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->BankAccountNo->EditValue ?>"<?php echo $payroll_summary_view_grid->BankAccountNo->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankAccountNo" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankAccountNo->OldValue) ?>">
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_BankAccountNo" class="form-group">
<input type="text" data-table="payroll_summary_view" data-field="x_BankAccountNo" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->BankAccountNo->EditValue ?>"<?php echo $payroll_summary_view_grid->BankAccountNo->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($payroll_summary_view->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $payroll_summary_view_grid->RowCount ?>_payroll_summary_view_BankAccountNo">
<span<?php echo $payroll_summary_view_grid->BankAccountNo->viewAttributes() ?>><?php echo $payroll_summary_view_grid->BankAccountNo->getViewValue() ?></span>
</span>
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankAccountNo" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankAccountNo->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankAccountNo" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankAccountNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankAccountNo" name="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" id="fpayroll_summary_viewgrid$x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankAccountNo->FormValue) ?>">
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankAccountNo" name="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" id="fpayroll_summary_viewgrid$o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankAccountNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payroll_summary_view_grid->ListOptions->render("body", "right", $payroll_summary_view_grid->RowCount);
?>
	</tr>
<?php if ($payroll_summary_view->RowType == ROWTYPE_ADD || $payroll_summary_view->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpayroll_summary_viewgrid", "load"], function() {
	fpayroll_summary_viewgrid.updateLists(<?php echo $payroll_summary_view_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$payroll_summary_view_grid->isGridAdd() || $payroll_summary_view->CurrentMode == "copy")
		if (!$payroll_summary_view_grid->Recordset->EOF)
			$payroll_summary_view_grid->Recordset->moveNext();
}
?>
<?php
	if ($payroll_summary_view->CurrentMode == "add" || $payroll_summary_view->CurrentMode == "copy" || $payroll_summary_view->CurrentMode == "edit") {
		$payroll_summary_view_grid->RowIndex = '$rowindex$';
		$payroll_summary_view_grid->loadRowValues();

		// Set row properties
		$payroll_summary_view->resetAttributes();
		$payroll_summary_view->RowAttrs->merge(["data-rowindex" => $payroll_summary_view_grid->RowIndex, "id" => "r0_payroll_summary_view", "data-rowtype" => ROWTYPE_ADD]);
		$payroll_summary_view->RowAttrs->appendClass("ew-template");
		$payroll_summary_view->RowType = ROWTYPE_ADD;

		// Render row
		$payroll_summary_view_grid->renderRow();

		// Render list options
		$payroll_summary_view_grid->renderListOptions();
		$payroll_summary_view_grid->StartRowCount = 0;
?>
	<tr <?php echo $payroll_summary_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payroll_summary_view_grid->ListOptions->render("body", "left", $payroll_summary_view_grid->RowIndex);
?>
	<?php if ($payroll_summary_view_grid->LocalAuthority->Visible) { // LocalAuthority ?>
		<td data-name="LocalAuthority">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_LocalAuthority" class="form-group payroll_summary_view_LocalAuthority">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority"><?php echo EmptyValue(strval($payroll_summary_view_grid->LocalAuthority->ViewValue)) ? $Language->phrase("PleaseSelect") : $payroll_summary_view_grid->LocalAuthority->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($payroll_summary_view_grid->LocalAuthority->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($payroll_summary_view_grid->LocalAuthority->ReadOnly || $payroll_summary_view_grid->LocalAuthority->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $payroll_summary_view_grid->LocalAuthority->Lookup->getParamTag($payroll_summary_view_grid, "p_x" . $payroll_summary_view_grid->RowIndex . "_LocalAuthority") ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_LocalAuthority" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $payroll_summary_view_grid->LocalAuthority->displayValueSeparatorAttribute() ?>" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" value="<?php echo $payroll_summary_view_grid->LocalAuthority->CurrentValue ?>"<?php echo $payroll_summary_view_grid->LocalAuthority->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_LocalAuthority" class="form-group payroll_summary_view_LocalAuthority">
<span<?php echo $payroll_summary_view_grid->LocalAuthority->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->LocalAuthority->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_LocalAuthority" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" value="<?php echo HtmlEncode($payroll_summary_view_grid->LocalAuthority->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_LocalAuthority" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_LocalAuthority" value="<?php echo HtmlEncode($payroll_summary_view_grid->LocalAuthority->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->DepartmentName->Visible) { // DepartmentName ?>
		<td data-name="DepartmentName">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_DepartmentName" class="form-group payroll_summary_view_DepartmentName">
<input type="text" data-table="payroll_summary_view" data-field="x_DepartmentName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->DepartmentName->EditValue ?>"<?php echo $payroll_summary_view_grid->DepartmentName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_DepartmentName" class="form-group payroll_summary_view_DepartmentName">
<span<?php echo $payroll_summary_view_grid->DepartmentName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->DepartmentName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_DepartmentName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($payroll_summary_view_grid->DepartmentName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_DepartmentName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_DepartmentName" value="<?php echo HtmlEncode($payroll_summary_view_grid->DepartmentName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->SectionName->Visible) { // SectionName ?>
		<td data-name="SectionName">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_SectionName" class="form-group payroll_summary_view_SectionName">
<input type="text" data-table="payroll_summary_view" data-field="x_SectionName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->SectionName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->SectionName->EditValue ?>"<?php echo $payroll_summary_view_grid->SectionName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_SectionName" class="form-group payroll_summary_view_SectionName">
<span<?php echo $payroll_summary_view_grid->SectionName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->SectionName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_SectionName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->SectionName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_SectionName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_SectionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->SectionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_EmployeeID" class="form-group payroll_summary_view_EmployeeID">
<input type="text" data-table="payroll_summary_view" data-field="x_EmployeeID" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->EmployeeID->EditValue ?>"<?php echo $payroll_summary_view_grid->EmployeeID->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_EmployeeID" class="form-group payroll_summary_view_EmployeeID">
<span<?php echo $payroll_summary_view_grid->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_EmployeeID" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($payroll_summary_view_grid->EmployeeID->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_EmployeeID" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_EmployeeID" value="<?php echo HtmlEncode($payroll_summary_view_grid->EmployeeID->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->Title->Visible) { // Title ?>
		<td data-name="Title">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_Title" class="form-group payroll_summary_view_Title">
<input type="text" data-table="payroll_summary_view" data-field="x_Title" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Title->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Title->EditValue ?>"<?php echo $payroll_summary_view_grid->Title->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_Title" class="form-group payroll_summary_view_Title">
<span<?php echo $payroll_summary_view_grid->Title->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->Title->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Title" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" value="<?php echo HtmlEncode($payroll_summary_view_grid->Title->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Title" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Title" value="<?php echo HtmlEncode($payroll_summary_view_grid->Title->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->Surname->Visible) { // Surname ?>
		<td data-name="Surname">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_Surname" class="form-group payroll_summary_view_Surname">
<input type="text" data-table="payroll_summary_view" data-field="x_Surname" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Surname->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Surname->EditValue ?>"<?php echo $payroll_summary_view_grid->Surname->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_Surname" class="form-group payroll_summary_view_Surname">
<span<?php echo $payroll_summary_view_grid->Surname->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->Surname->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Surname" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($payroll_summary_view_grid->Surname->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Surname" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Surname" value="<?php echo HtmlEncode($payroll_summary_view_grid->Surname->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_FirstName" class="form-group payroll_summary_view_FirstName">
<input type="text" data-table="payroll_summary_view" data-field="x_FirstName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->FirstName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->FirstName->EditValue ?>"<?php echo $payroll_summary_view_grid->FirstName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_FirstName" class="form-group payroll_summary_view_FirstName">
<span<?php echo $payroll_summary_view_grid->FirstName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->FirstName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_FirstName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($payroll_summary_view_grid->FirstName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_FirstName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_FirstName" value="<?php echo HtmlEncode($payroll_summary_view_grid->FirstName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_MiddleName" class="form-group payroll_summary_view_MiddleName">
<input type="text" data-table="payroll_summary_view" data-field="x_MiddleName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->MiddleName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->MiddleName->EditValue ?>"<?php echo $payroll_summary_view_grid->MiddleName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_MiddleName" class="form-group payroll_summary_view_MiddleName">
<span<?php echo $payroll_summary_view_grid->MiddleName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->MiddleName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_MiddleName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($payroll_summary_view_grid->MiddleName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_MiddleName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_MiddleName" value="<?php echo HtmlEncode($payroll_summary_view_grid->MiddleName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->Sex->Visible) { // Sex ?>
		<td data-name="Sex">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_Sex" class="form-group payroll_summary_view_Sex">
<input type="text" data-table="payroll_summary_view" data-field="x_Sex" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Sex->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Sex->EditValue ?>"<?php echo $payroll_summary_view_grid->Sex->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_Sex" class="form-group payroll_summary_view_Sex">
<span<?php echo $payroll_summary_view_grid->Sex->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->Sex->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Sex" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($payroll_summary_view_grid->Sex->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Sex" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Sex" value="<?php echo HtmlEncode($payroll_summary_view_grid->Sex->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->NRC->Visible) { // NRC ?>
		<td data-name="NRC">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_NRC" class="form-group payroll_summary_view_NRC">
<input type="text" data-table="payroll_summary_view" data-field="x_NRC" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->NRC->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->NRC->EditValue ?>"<?php echo $payroll_summary_view_grid->NRC->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_NRC" class="form-group payroll_summary_view_NRC">
<span<?php echo $payroll_summary_view_grid->NRC->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->NRC->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_NRC" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($payroll_summary_view_grid->NRC->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_NRC" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_NRC" value="<?php echo HtmlEncode($payroll_summary_view_grid->NRC->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_PositionName" class="form-group payroll_summary_view_PositionName">
<input type="text" data-table="payroll_summary_view" data-field="x_PositionName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->PositionName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->PositionName->EditValue ?>"<?php echo $payroll_summary_view_grid->PositionName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_PositionName" class="form-group payroll_summary_view_PositionName">
<span<?php echo $payroll_summary_view_grid->PositionName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->PositionName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PositionName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->PositionName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PositionName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PositionName" value="<?php echo HtmlEncode($payroll_summary_view_grid->PositionName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<?php if ($payroll_summary_view_grid->PayrollPeriod->getSessionValue() != "") { ?>
<span id="el$rowindex$_payroll_summary_view_PayrollPeriod" class="form-group payroll_summary_view_PayrollPeriod">
<span<?php echo $payroll_summary_view_grid->PayrollPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->PayrollPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayrollPeriod->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_PayrollPeriod" class="form-group payroll_summary_view_PayrollPeriod">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="payroll_summary_view" data-field="x_PayrollPeriod" data-value-separator="<?php echo $payroll_summary_view_grid->PayrollPeriod->displayValueSeparatorAttribute() ?>" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod"<?php echo $payroll_summary_view_grid->PayrollPeriod->editAttributes() ?>>
			<?php echo $payroll_summary_view_grid->PayrollPeriod->selectOptionListHtml("x{$payroll_summary_view_grid->RowIndex}_PayrollPeriod") ?>
		</select>
</div>
<?php echo $payroll_summary_view_grid->PayrollPeriod->Lookup->getParamTag($payroll_summary_view_grid, "p_x" . $payroll_summary_view_grid->RowIndex . "_PayrollPeriod") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_PayrollPeriod" class="form-group payroll_summary_view_PayrollPeriod">
<span<?php echo $payroll_summary_view_grid->PayrollPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->PayrollPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayrollPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayrollPeriod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayrollPeriod" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayrollPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayrollPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->pCode->Visible) { // pCode ?>
		<td data-name="pCode">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_pCode" class="form-group payroll_summary_view_pCode">
<input type="text" data-table="payroll_summary_view" data-field="x_pCode" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->pCode->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->pCode->EditValue ?>"<?php echo $payroll_summary_view_grid->pCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_pCode" class="form-group payroll_summary_view_pCode">
<span<?php echo $payroll_summary_view_grid->pCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->pCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_pCode" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->pCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_pCode" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->pCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->pName->Visible) { // pName ?>
		<td data-name="pName">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_pName" class="form-group payroll_summary_view_pName">
<input type="text" data-table="payroll_summary_view" data-field="x_pName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->pName->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->pName->EditValue ?>"<?php echo $payroll_summary_view_grid->pName->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_pName" class="form-group payroll_summary_view_pName">
<span<?php echo $payroll_summary_view_grid->pName->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->pName->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_pName" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" value="<?php echo HtmlEncode($payroll_summary_view_grid->pName->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_pName" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_pName" value="<?php echo HtmlEncode($payroll_summary_view_grid->pName->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->Amount->Visible) { // Amount ?>
		<td data-name="Amount">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_Amount" class="form-group payroll_summary_view_Amount">
<input type="text" data-table="payroll_summary_view" data-field="x_Amount" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" size="30" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Amount->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Amount->EditValue ?>"<?php echo $payroll_summary_view_grid->Amount->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_Amount" class="form-group payroll_summary_view_Amount">
<span<?php echo $payroll_summary_view_grid->Amount->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->Amount->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Amount" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($payroll_summary_view_grid->Amount->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Amount" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Amount" value="<?php echo HtmlEncode($payroll_summary_view_grid->Amount->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->PayPeriod->Visible) { // PayPeriod ?>
		<td data-name="PayPeriod">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_PayPeriod" class="form-group payroll_summary_view_PayPeriod">
<input type="text" data-table="payroll_summary_view" data-field="x_PayPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->PayPeriod->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->PayPeriod->EditValue ?>"<?php echo $payroll_summary_view_grid->PayPeriod->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_PayPeriod" class="form-group payroll_summary_view_PayPeriod">
<span<?php echo $payroll_summary_view_grid->PayPeriod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->PayPeriod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayPeriod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayPeriod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PayPeriod" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PayPeriod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PayPeriod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_SalaryScale" class="form-group payroll_summary_view_SalaryScale">
<input type="text" data-table="payroll_summary_view" data-field="x_SalaryScale" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->SalaryScale->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->SalaryScale->EditValue ?>"<?php echo $payroll_summary_view_grid->SalaryScale->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_SalaryScale" class="form-group payroll_summary_view_SalaryScale">
<span<?php echo $payroll_summary_view_grid->SalaryScale->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->SalaryScale->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_SalaryScale" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($payroll_summary_view_grid->SalaryScale->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_SalaryScale" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_SalaryScale" value="<?php echo HtmlEncode($payroll_summary_view_grid->SalaryScale->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->Division->Visible) { // Division ?>
		<td data-name="Division">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_Division" class="form-group payroll_summary_view_Division">
<input type="text" data-table="payroll_summary_view" data-field="x_Division" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->Division->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->Division->EditValue ?>"<?php echo $payroll_summary_view_grid->Division->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_Division" class="form-group payroll_summary_view_Division">
<span<?php echo $payroll_summary_view_grid->Division->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->Division->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Division" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($payroll_summary_view_grid->Division->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_Division" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_Division" value="<?php echo HtmlEncode($payroll_summary_view_grid->Division->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_PaymentMethod" class="form-group payroll_summary_view_PaymentMethod">
<input type="text" data-table="payroll_summary_view" data-field="x_PaymentMethod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->PaymentMethod->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->PaymentMethod->EditValue ?>"<?php echo $payroll_summary_view_grid->PaymentMethod->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_PaymentMethod" class="form-group payroll_summary_view_PaymentMethod">
<span<?php echo $payroll_summary_view_grid->PaymentMethod->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->PaymentMethod->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PaymentMethod" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PaymentMethod->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_PaymentMethod" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_PaymentMethod" value="<?php echo HtmlEncode($payroll_summary_view_grid->PaymentMethod->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->BankBranchCode->Visible) { // BankBranchCode ?>
		<td data-name="BankBranchCode">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_BankBranchCode" class="form-group payroll_summary_view_BankBranchCode">
<input type="text" data-table="payroll_summary_view" data-field="x_BankBranchCode" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" size="30" maxlength="8" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->BankBranchCode->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->BankBranchCode->EditValue ?>"<?php echo $payroll_summary_view_grid->BankBranchCode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_BankBranchCode" class="form-group payroll_summary_view_BankBranchCode">
<span<?php echo $payroll_summary_view_grid->BankBranchCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->BankBranchCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankBranchCode" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankBranchCode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankBranchCode" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankBranchCode" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankBranchCode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($payroll_summary_view_grid->BankAccountNo->Visible) { // BankAccountNo ?>
		<td data-name="BankAccountNo">
<?php if (!$payroll_summary_view->isConfirm()) { ?>
<span id="el$rowindex$_payroll_summary_view_BankAccountNo" class="form-group payroll_summary_view_BankAccountNo">
<input type="text" data-table="payroll_summary_view" data-field="x_BankAccountNo" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($payroll_summary_view_grid->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $payroll_summary_view_grid->BankAccountNo->EditValue ?>"<?php echo $payroll_summary_view_grid->BankAccountNo->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_payroll_summary_view_BankAccountNo" class="form-group payroll_summary_view_BankAccountNo">
<span<?php echo $payroll_summary_view_grid->BankAccountNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_summary_view_grid->BankAccountNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankAccountNo" name="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" id="x<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankAccountNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="payroll_summary_view" data-field="x_BankAccountNo" name="o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" id="o<?php echo $payroll_summary_view_grid->RowIndex ?>_BankAccountNo" value="<?php echo HtmlEncode($payroll_summary_view_grid->BankAccountNo->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payroll_summary_view_grid->ListOptions->render("body", "right", $payroll_summary_view_grid->RowIndex);
?>
<script>
loadjs.ready(["fpayroll_summary_viewgrid", "load"], function() {
	fpayroll_summary_viewgrid.updateLists(<?php echo $payroll_summary_view_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($payroll_summary_view->CurrentMode == "add" || $payroll_summary_view->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $payroll_summary_view_grid->FormKeyCountName ?>" id="<?php echo $payroll_summary_view_grid->FormKeyCountName ?>" value="<?php echo $payroll_summary_view_grid->KeyCount ?>">
<?php echo $payroll_summary_view_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($payroll_summary_view->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $payroll_summary_view_grid->FormKeyCountName ?>" id="<?php echo $payroll_summary_view_grid->FormKeyCountName ?>" value="<?php echo $payroll_summary_view_grid->KeyCount ?>">
<?php echo $payroll_summary_view_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($payroll_summary_view->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpayroll_summary_viewgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payroll_summary_view_grid->Recordset)
	$payroll_summary_view_grid->Recordset->Close();
?>
<?php if ($payroll_summary_view_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $payroll_summary_view_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payroll_summary_view_grid->TotalRecords == 0 && !$payroll_summary_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payroll_summary_view_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$payroll_summary_view_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$payroll_summary_view_grid->terminate();
?>