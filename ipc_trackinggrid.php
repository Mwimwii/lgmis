<?php
namespace PHPMaker2020\lgmis20;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($ipc_tracking_grid))
	$ipc_tracking_grid = new ipc_tracking_grid();

// Run the page
$ipc_tracking_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ipc_tracking_grid->Page_Render();
?>
<?php if (!$ipc_tracking_grid->isExport()) { ?>
<script>
var fipc_trackinggrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fipc_trackinggrid = new ew.Form("fipc_trackinggrid", "grid");
	fipc_trackinggrid.formKeyCountName = '<?php echo $ipc_tracking_grid->FormKeyCountName ?>';

	// Validate form
	fipc_trackinggrid.validate = function() {
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
			<?php if ($ipc_tracking_grid->IPCNo->Required) { ?>
				elm = this.getElements("x" + infix + "_IPCNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->IPCNo->caption(), $ipc_tracking_grid->IPCNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->ContractNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->ContractNo->caption(), $ipc_tracking_grid->ContractNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->ContractAuthorizedByAG->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractAuthorizedByAG[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->ContractAuthorizedByAG->caption(), $ipc_tracking_grid->ContractAuthorizedByAG->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->VATApplied->Required) { ?>
				elm = this.getElements("x" + infix + "_VATApplied[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->VATApplied->caption(), $ipc_tracking_grid->VATApplied->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->ArithmeticCheckDone->Required) { ?>
				elm = this.getElements("x" + infix + "_ArithmeticCheckDone[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->ArithmeticCheckDone->caption(), $ipc_tracking_grid->ArithmeticCheckDone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->VariationsApproved->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationsApproved[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->VariationsApproved->caption(), $ipc_tracking_grid->VariationsApproved->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->PerformanceBondValidUntil->Required) { ?>
				elm = this.getElements("x" + infix + "_PerformanceBondValidUntil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->PerformanceBondValidUntil->caption(), $ipc_tracking_grid->PerformanceBondValidUntil->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PerformanceBondValidUntil");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_grid->PerformanceBondValidUntil->errorMessage()) ?>");
			<?php if ($ipc_tracking_grid->AdvancePaymentBondValidUntil->Required) { ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentBondValidUntil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->AdvancePaymentBondValidUntil->caption(), $ipc_tracking_grid->AdvancePaymentBondValidUntil->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentBondValidUntil");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_grid->AdvancePaymentBondValidUntil->errorMessage()) ?>");
			<?php if ($ipc_tracking_grid->RetentionDeductionClause->Required) { ?>
				elm = this.getElements("x" + infix + "_RetentionDeductionClause");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->RetentionDeductionClause->caption(), $ipc_tracking_grid->RetentionDeductionClause->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->RetentionDeducted->Required) { ?>
				elm = this.getElements("x" + infix + "_RetentionDeducted[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->RetentionDeducted->caption(), $ipc_tracking_grid->RetentionDeducted->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->LiquidatedDamagesDeducted->Required) { ?>
				elm = this.getElements("x" + infix + "_LiquidatedDamagesDeducted[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->LiquidatedDamagesDeducted->caption(), $ipc_tracking_grid->LiquidatedDamagesDeducted->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->AdvancedPaymentDeducted->Required) { ?>
				elm = this.getElements("x" + infix + "_AdvancedPaymentDeducted[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->AdvancedPaymentDeducted->caption(), $ipc_tracking_grid->AdvancedPaymentDeducted->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->CurrentProgressReportAttached->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentProgressReportAttached[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->CurrentProgressReportAttached->caption(), $ipc_tracking_grid->CurrentProgressReportAttached->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->DateOfSiteInspection->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfSiteInspection");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->DateOfSiteInspection->caption(), $ipc_tracking_grid->DateOfSiteInspection->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfSiteInspection");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_grid->DateOfSiteInspection->errorMessage()) ?>");
			<?php if ($ipc_tracking_grid->TimeExtensionAuthorized->Required) { ?>
				elm = this.getElements("x" + infix + "_TimeExtensionAuthorized[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->TimeExtensionAuthorized->caption(), $ipc_tracking_grid->TimeExtensionAuthorized->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->LabResultsChecked->Required) { ?>
				elm = this.getElements("x" + infix + "_LabResultsChecked[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->LabResultsChecked->caption(), $ipc_tracking_grid->LabResultsChecked->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->TerminationNoticeGiven->Required) { ?>
				elm = this.getElements("x" + infix + "_TerminationNoticeGiven[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->TerminationNoticeGiven->caption(), $ipc_tracking_grid->TerminationNoticeGiven->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->CopiesEmailedToMLG->Required) { ?>
				elm = this.getElements("x" + infix + "_CopiesEmailedToMLG[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->CopiesEmailedToMLG->caption(), $ipc_tracking_grid->CopiesEmailedToMLG->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->ContractStillValid->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractStillValid[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->ContractStillValid->caption(), $ipc_tracking_grid->ContractStillValid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->DeskOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_DeskOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->DeskOfficer->caption(), $ipc_tracking_grid->DeskOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->DeskOfficerDate->Required) { ?>
				elm = this.getElements("x" + infix + "_DeskOfficerDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->DeskOfficerDate->caption(), $ipc_tracking_grid->DeskOfficerDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeskOfficerDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_grid->DeskOfficerDate->errorMessage()) ?>");
			<?php if ($ipc_tracking_grid->SupervisingEngineer->Required) { ?>
				elm = this.getElements("x" + infix + "_SupervisingEngineer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->SupervisingEngineer->caption(), $ipc_tracking_grid->SupervisingEngineer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->EngineerDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EngineerDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->EngineerDate->caption(), $ipc_tracking_grid->EngineerDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EngineerDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_grid->EngineerDate->errorMessage()) ?>");
			<?php if ($ipc_tracking_grid->CouncilSecretary->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilSecretary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->CouncilSecretary->caption(), $ipc_tracking_grid->CouncilSecretary->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_grid->CSDate->Required) { ?>
				elm = this.getElements("x" + infix + "_CSDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->CSDate->caption(), $ipc_tracking_grid->CSDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CSDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_grid->CSDate->errorMessage()) ?>");
			<?php if ($ipc_tracking_grid->ContractType->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_grid->ContractType->caption(), $ipc_tracking_grid->ContractType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ContractType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_grid->ContractType->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fipc_trackinggrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "ContractNo", false)) return false;
		if (ew.valueChanged(fobj, infix, "ContractAuthorizedByAG[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "VATApplied[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ArithmeticCheckDone[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "VariationsApproved[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "PerformanceBondValidUntil", false)) return false;
		if (ew.valueChanged(fobj, infix, "AdvancePaymentBondValidUntil", false)) return false;
		if (ew.valueChanged(fobj, infix, "RetentionDeductionClause", false)) return false;
		if (ew.valueChanged(fobj, infix, "RetentionDeducted[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "LiquidatedDamagesDeducted[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "AdvancedPaymentDeducted[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "CurrentProgressReportAttached[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "DateOfSiteInspection", false)) return false;
		if (ew.valueChanged(fobj, infix, "TimeExtensionAuthorized[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "LabResultsChecked[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "TerminationNoticeGiven[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "CopiesEmailedToMLG[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "ContractStillValid[]", true)) return false;
		if (ew.valueChanged(fobj, infix, "DeskOfficer", false)) return false;
		if (ew.valueChanged(fobj, infix, "DeskOfficerDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "SupervisingEngineer", false)) return false;
		if (ew.valueChanged(fobj, infix, "EngineerDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "CouncilSecretary", false)) return false;
		if (ew.valueChanged(fobj, infix, "CSDate", false)) return false;
		if (ew.valueChanged(fobj, infix, "ContractType", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fipc_trackinggrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fipc_trackinggrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fipc_trackinggrid.lists["x_ContractAuthorizedByAG[]"] = <?php echo $ipc_tracking_grid->ContractAuthorizedByAG->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_ContractAuthorizedByAG[]"].options = <?php echo JsonEncode($ipc_tracking_grid->ContractAuthorizedByAG->options(FALSE, TRUE)) ?>;
	fipc_trackinggrid.lists["x_VATApplied[]"] = <?php echo $ipc_tracking_grid->VATApplied->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_VATApplied[]"].options = <?php echo JsonEncode($ipc_tracking_grid->VATApplied->options(FALSE, TRUE)) ?>;
	fipc_trackinggrid.lists["x_ArithmeticCheckDone[]"] = <?php echo $ipc_tracking_grid->ArithmeticCheckDone->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_ArithmeticCheckDone[]"].options = <?php echo JsonEncode($ipc_tracking_grid->ArithmeticCheckDone->options(FALSE, TRUE)) ?>;
	fipc_trackinggrid.lists["x_VariationsApproved[]"] = <?php echo $ipc_tracking_grid->VariationsApproved->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_VariationsApproved[]"].options = <?php echo JsonEncode($ipc_tracking_grid->VariationsApproved->options(FALSE, TRUE)) ?>;
	fipc_trackinggrid.lists["x_RetentionDeducted[]"] = <?php echo $ipc_tracking_grid->RetentionDeducted->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_RetentionDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_grid->RetentionDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackinggrid.lists["x_LiquidatedDamagesDeducted[]"] = <?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_LiquidatedDamagesDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_grid->LiquidatedDamagesDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackinggrid.lists["x_AdvancedPaymentDeducted[]"] = <?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_AdvancedPaymentDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_grid->AdvancedPaymentDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackinggrid.lists["x_CurrentProgressReportAttached[]"] = <?php echo $ipc_tracking_grid->CurrentProgressReportAttached->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_CurrentProgressReportAttached[]"].options = <?php echo JsonEncode($ipc_tracking_grid->CurrentProgressReportAttached->options(FALSE, TRUE)) ?>;
	fipc_trackinggrid.lists["x_TimeExtensionAuthorized[]"] = <?php echo $ipc_tracking_grid->TimeExtensionAuthorized->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_TimeExtensionAuthorized[]"].options = <?php echo JsonEncode($ipc_tracking_grid->TimeExtensionAuthorized->options(FALSE, TRUE)) ?>;
	fipc_trackinggrid.lists["x_LabResultsChecked[]"] = <?php echo $ipc_tracking_grid->LabResultsChecked->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_LabResultsChecked[]"].options = <?php echo JsonEncode($ipc_tracking_grid->LabResultsChecked->options(FALSE, TRUE)) ?>;
	fipc_trackinggrid.lists["x_TerminationNoticeGiven[]"] = <?php echo $ipc_tracking_grid->TerminationNoticeGiven->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_TerminationNoticeGiven[]"].options = <?php echo JsonEncode($ipc_tracking_grid->TerminationNoticeGiven->options(FALSE, TRUE)) ?>;
	fipc_trackinggrid.lists["x_CopiesEmailedToMLG[]"] = <?php echo $ipc_tracking_grid->CopiesEmailedToMLG->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_CopiesEmailedToMLG[]"].options = <?php echo JsonEncode($ipc_tracking_grid->CopiesEmailedToMLG->options(FALSE, TRUE)) ?>;
	fipc_trackinggrid.lists["x_ContractStillValid[]"] = <?php echo $ipc_tracking_grid->ContractStillValid->Lookup->toClientList($ipc_tracking_grid) ?>;
	fipc_trackinggrid.lists["x_ContractStillValid[]"].options = <?php echo JsonEncode($ipc_tracking_grid->ContractStillValid->options(FALSE, TRUE)) ?>;
	loadjs.done("fipc_trackinggrid");
});
</script>
<?php } ?>
<?php
$ipc_tracking_grid->renderOtherOptions();
?>
<?php if ($ipc_tracking_grid->TotalRecords > 0 || $ipc_tracking->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ipc_tracking_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ipc_tracking">
<?php if ($ipc_tracking_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $ipc_tracking_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fipc_trackinggrid" class="ew-form ew-list-form form-inline">
<div id="gmp_ipc_tracking" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_ipc_trackinggrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ipc_tracking->RowType = ROWTYPE_HEADER;

// Render list options
$ipc_tracking_grid->renderListOptions();

// Render list options (header, left)
$ipc_tracking_grid->ListOptions->render("header", "left");
?>
<?php if ($ipc_tracking_grid->IPCNo->Visible) { // IPCNo ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->IPCNo) == "") { ?>
		<th data-name="IPCNo" class="<?php echo $ipc_tracking_grid->IPCNo->headerCellClass() ?>"><div id="elh_ipc_tracking_IPCNo" class="ipc_tracking_IPCNo"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->IPCNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IPCNo" class="<?php echo $ipc_tracking_grid->IPCNo->headerCellClass() ?>"><div><div id="elh_ipc_tracking_IPCNo" class="ipc_tracking_IPCNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->IPCNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->IPCNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->IPCNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->ContractNo->Visible) { // ContractNo ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->ContractNo) == "") { ?>
		<th data-name="ContractNo" class="<?php echo $ipc_tracking_grid->ContractNo->headerCellClass() ?>"><div id="elh_ipc_tracking_ContractNo" class="ipc_tracking_ContractNo"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->ContractNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractNo" class="<?php echo $ipc_tracking_grid->ContractNo->headerCellClass() ?>"><div><div id="elh_ipc_tracking_ContractNo" class="ipc_tracking_ContractNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->ContractNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->ContractNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->ContractNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->ContractAuthorizedByAG) == "") { ?>
		<th data-name="ContractAuthorizedByAG" class="<?php echo $ipc_tracking_grid->ContractAuthorizedByAG->headerCellClass() ?>"><div id="elh_ipc_tracking_ContractAuthorizedByAG" class="ipc_tracking_ContractAuthorizedByAG"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->ContractAuthorizedByAG->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractAuthorizedByAG" class="<?php echo $ipc_tracking_grid->ContractAuthorizedByAG->headerCellClass() ?>"><div><div id="elh_ipc_tracking_ContractAuthorizedByAG" class="ipc_tracking_ContractAuthorizedByAG">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->ContractAuthorizedByAG->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->ContractAuthorizedByAG->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->ContractAuthorizedByAG->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->VATApplied->Visible) { // VATApplied ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->VATApplied) == "") { ?>
		<th data-name="VATApplied" class="<?php echo $ipc_tracking_grid->VATApplied->headerCellClass() ?>"><div id="elh_ipc_tracking_VATApplied" class="ipc_tracking_VATApplied"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->VATApplied->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VATApplied" class="<?php echo $ipc_tracking_grid->VATApplied->headerCellClass() ?>"><div><div id="elh_ipc_tracking_VATApplied" class="ipc_tracking_VATApplied">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->VATApplied->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->VATApplied->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->VATApplied->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->ArithmeticCheckDone) == "") { ?>
		<th data-name="ArithmeticCheckDone" class="<?php echo $ipc_tracking_grid->ArithmeticCheckDone->headerCellClass() ?>"><div id="elh_ipc_tracking_ArithmeticCheckDone" class="ipc_tracking_ArithmeticCheckDone"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->ArithmeticCheckDone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ArithmeticCheckDone" class="<?php echo $ipc_tracking_grid->ArithmeticCheckDone->headerCellClass() ?>"><div><div id="elh_ipc_tracking_ArithmeticCheckDone" class="ipc_tracking_ArithmeticCheckDone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->ArithmeticCheckDone->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->ArithmeticCheckDone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->ArithmeticCheckDone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->VariationsApproved->Visible) { // VariationsApproved ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->VariationsApproved) == "") { ?>
		<th data-name="VariationsApproved" class="<?php echo $ipc_tracking_grid->VariationsApproved->headerCellClass() ?>"><div id="elh_ipc_tracking_VariationsApproved" class="ipc_tracking_VariationsApproved"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->VariationsApproved->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VariationsApproved" class="<?php echo $ipc_tracking_grid->VariationsApproved->headerCellClass() ?>"><div><div id="elh_ipc_tracking_VariationsApproved" class="ipc_tracking_VariationsApproved">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->VariationsApproved->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->VariationsApproved->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->VariationsApproved->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->PerformanceBondValidUntil) == "") { ?>
		<th data-name="PerformanceBondValidUntil" class="<?php echo $ipc_tracking_grid->PerformanceBondValidUntil->headerCellClass() ?>"><div id="elh_ipc_tracking_PerformanceBondValidUntil" class="ipc_tracking_PerformanceBondValidUntil"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->PerformanceBondValidUntil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PerformanceBondValidUntil" class="<?php echo $ipc_tracking_grid->PerformanceBondValidUntil->headerCellClass() ?>"><div><div id="elh_ipc_tracking_PerformanceBondValidUntil" class="ipc_tracking_PerformanceBondValidUntil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->PerformanceBondValidUntil->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->PerformanceBondValidUntil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->PerformanceBondValidUntil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->AdvancePaymentBondValidUntil) == "") { ?>
		<th data-name="AdvancePaymentBondValidUntil" class="<?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->headerCellClass() ?>"><div id="elh_ipc_tracking_AdvancePaymentBondValidUntil" class="ipc_tracking_AdvancePaymentBondValidUntil"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdvancePaymentBondValidUntil" class="<?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->headerCellClass() ?>"><div><div id="elh_ipc_tracking_AdvancePaymentBondValidUntil" class="ipc_tracking_AdvancePaymentBondValidUntil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->AdvancePaymentBondValidUntil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->AdvancePaymentBondValidUntil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->RetentionDeductionClause) == "") { ?>
		<th data-name="RetentionDeductionClause" class="<?php echo $ipc_tracking_grid->RetentionDeductionClause->headerCellClass() ?>"><div id="elh_ipc_tracking_RetentionDeductionClause" class="ipc_tracking_RetentionDeductionClause"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->RetentionDeductionClause->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RetentionDeductionClause" class="<?php echo $ipc_tracking_grid->RetentionDeductionClause->headerCellClass() ?>"><div><div id="elh_ipc_tracking_RetentionDeductionClause" class="ipc_tracking_RetentionDeductionClause">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->RetentionDeductionClause->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->RetentionDeductionClause->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->RetentionDeductionClause->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->RetentionDeducted->Visible) { // RetentionDeducted ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->RetentionDeducted) == "") { ?>
		<th data-name="RetentionDeducted" class="<?php echo $ipc_tracking_grid->RetentionDeducted->headerCellClass() ?>"><div id="elh_ipc_tracking_RetentionDeducted" class="ipc_tracking_RetentionDeducted"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->RetentionDeducted->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RetentionDeducted" class="<?php echo $ipc_tracking_grid->RetentionDeducted->headerCellClass() ?>"><div><div id="elh_ipc_tracking_RetentionDeducted" class="ipc_tracking_RetentionDeducted">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->RetentionDeducted->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->RetentionDeducted->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->RetentionDeducted->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->LiquidatedDamagesDeducted) == "") { ?>
		<th data-name="LiquidatedDamagesDeducted" class="<?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->headerCellClass() ?>"><div id="elh_ipc_tracking_LiquidatedDamagesDeducted" class="ipc_tracking_LiquidatedDamagesDeducted"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LiquidatedDamagesDeducted" class="<?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->headerCellClass() ?>"><div><div id="elh_ipc_tracking_LiquidatedDamagesDeducted" class="ipc_tracking_LiquidatedDamagesDeducted">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->LiquidatedDamagesDeducted->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->LiquidatedDamagesDeducted->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->AdvancedPaymentDeducted) == "") { ?>
		<th data-name="AdvancedPaymentDeducted" class="<?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->headerCellClass() ?>"><div id="elh_ipc_tracking_AdvancedPaymentDeducted" class="ipc_tracking_AdvancedPaymentDeducted"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdvancedPaymentDeducted" class="<?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->headerCellClass() ?>"><div><div id="elh_ipc_tracking_AdvancedPaymentDeducted" class="ipc_tracking_AdvancedPaymentDeducted">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->AdvancedPaymentDeducted->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->AdvancedPaymentDeducted->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->CurrentProgressReportAttached) == "") { ?>
		<th data-name="CurrentProgressReportAttached" class="<?php echo $ipc_tracking_grid->CurrentProgressReportAttached->headerCellClass() ?>"><div id="elh_ipc_tracking_CurrentProgressReportAttached" class="ipc_tracking_CurrentProgressReportAttached"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->CurrentProgressReportAttached->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentProgressReportAttached" class="<?php echo $ipc_tracking_grid->CurrentProgressReportAttached->headerCellClass() ?>"><div><div id="elh_ipc_tracking_CurrentProgressReportAttached" class="ipc_tracking_CurrentProgressReportAttached">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->CurrentProgressReportAttached->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->CurrentProgressReportAttached->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->CurrentProgressReportAttached->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->DateOfSiteInspection) == "") { ?>
		<th data-name="DateOfSiteInspection" class="<?php echo $ipc_tracking_grid->DateOfSiteInspection->headerCellClass() ?>"><div id="elh_ipc_tracking_DateOfSiteInspection" class="ipc_tracking_DateOfSiteInspection"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->DateOfSiteInspection->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfSiteInspection" class="<?php echo $ipc_tracking_grid->DateOfSiteInspection->headerCellClass() ?>"><div><div id="elh_ipc_tracking_DateOfSiteInspection" class="ipc_tracking_DateOfSiteInspection">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->DateOfSiteInspection->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->DateOfSiteInspection->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->DateOfSiteInspection->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->TimeExtensionAuthorized) == "") { ?>
		<th data-name="TimeExtensionAuthorized" class="<?php echo $ipc_tracking_grid->TimeExtensionAuthorized->headerCellClass() ?>"><div id="elh_ipc_tracking_TimeExtensionAuthorized" class="ipc_tracking_TimeExtensionAuthorized"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->TimeExtensionAuthorized->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TimeExtensionAuthorized" class="<?php echo $ipc_tracking_grid->TimeExtensionAuthorized->headerCellClass() ?>"><div><div id="elh_ipc_tracking_TimeExtensionAuthorized" class="ipc_tracking_TimeExtensionAuthorized">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->TimeExtensionAuthorized->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->TimeExtensionAuthorized->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->TimeExtensionAuthorized->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->LabResultsChecked->Visible) { // LabResultsChecked ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->LabResultsChecked) == "") { ?>
		<th data-name="LabResultsChecked" class="<?php echo $ipc_tracking_grid->LabResultsChecked->headerCellClass() ?>"><div id="elh_ipc_tracking_LabResultsChecked" class="ipc_tracking_LabResultsChecked"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->LabResultsChecked->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LabResultsChecked" class="<?php echo $ipc_tracking_grid->LabResultsChecked->headerCellClass() ?>"><div><div id="elh_ipc_tracking_LabResultsChecked" class="ipc_tracking_LabResultsChecked">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->LabResultsChecked->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->LabResultsChecked->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->LabResultsChecked->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->TerminationNoticeGiven) == "") { ?>
		<th data-name="TerminationNoticeGiven" class="<?php echo $ipc_tracking_grid->TerminationNoticeGiven->headerCellClass() ?>"><div id="elh_ipc_tracking_TerminationNoticeGiven" class="ipc_tracking_TerminationNoticeGiven"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->TerminationNoticeGiven->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TerminationNoticeGiven" class="<?php echo $ipc_tracking_grid->TerminationNoticeGiven->headerCellClass() ?>"><div><div id="elh_ipc_tracking_TerminationNoticeGiven" class="ipc_tracking_TerminationNoticeGiven">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->TerminationNoticeGiven->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->TerminationNoticeGiven->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->TerminationNoticeGiven->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->CopiesEmailedToMLG) == "") { ?>
		<th data-name="CopiesEmailedToMLG" class="<?php echo $ipc_tracking_grid->CopiesEmailedToMLG->headerCellClass() ?>"><div id="elh_ipc_tracking_CopiesEmailedToMLG" class="ipc_tracking_CopiesEmailedToMLG"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->CopiesEmailedToMLG->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CopiesEmailedToMLG" class="<?php echo $ipc_tracking_grid->CopiesEmailedToMLG->headerCellClass() ?>"><div><div id="elh_ipc_tracking_CopiesEmailedToMLG" class="ipc_tracking_CopiesEmailedToMLG">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->CopiesEmailedToMLG->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->CopiesEmailedToMLG->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->CopiesEmailedToMLG->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->ContractStillValid->Visible) { // ContractStillValid ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->ContractStillValid) == "") { ?>
		<th data-name="ContractStillValid" class="<?php echo $ipc_tracking_grid->ContractStillValid->headerCellClass() ?>"><div id="elh_ipc_tracking_ContractStillValid" class="ipc_tracking_ContractStillValid"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->ContractStillValid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractStillValid" class="<?php echo $ipc_tracking_grid->ContractStillValid->headerCellClass() ?>"><div><div id="elh_ipc_tracking_ContractStillValid" class="ipc_tracking_ContractStillValid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->ContractStillValid->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->ContractStillValid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->ContractStillValid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->DeskOfficer->Visible) { // DeskOfficer ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->DeskOfficer) == "") { ?>
		<th data-name="DeskOfficer" class="<?php echo $ipc_tracking_grid->DeskOfficer->headerCellClass() ?>"><div id="elh_ipc_tracking_DeskOfficer" class="ipc_tracking_DeskOfficer"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->DeskOfficer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeskOfficer" class="<?php echo $ipc_tracking_grid->DeskOfficer->headerCellClass() ?>"><div><div id="elh_ipc_tracking_DeskOfficer" class="ipc_tracking_DeskOfficer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->DeskOfficer->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->DeskOfficer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->DeskOfficer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->DeskOfficerDate) == "") { ?>
		<th data-name="DeskOfficerDate" class="<?php echo $ipc_tracking_grid->DeskOfficerDate->headerCellClass() ?>"><div id="elh_ipc_tracking_DeskOfficerDate" class="ipc_tracking_DeskOfficerDate"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->DeskOfficerDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeskOfficerDate" class="<?php echo $ipc_tracking_grid->DeskOfficerDate->headerCellClass() ?>"><div><div id="elh_ipc_tracking_DeskOfficerDate" class="ipc_tracking_DeskOfficerDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->DeskOfficerDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->DeskOfficerDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->DeskOfficerDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->SupervisingEngineer) == "") { ?>
		<th data-name="SupervisingEngineer" class="<?php echo $ipc_tracking_grid->SupervisingEngineer->headerCellClass() ?>"><div id="elh_ipc_tracking_SupervisingEngineer" class="ipc_tracking_SupervisingEngineer"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->SupervisingEngineer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SupervisingEngineer" class="<?php echo $ipc_tracking_grid->SupervisingEngineer->headerCellClass() ?>"><div><div id="elh_ipc_tracking_SupervisingEngineer" class="ipc_tracking_SupervisingEngineer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->SupervisingEngineer->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->SupervisingEngineer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->SupervisingEngineer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->EngineerDate->Visible) { // EngineerDate ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->EngineerDate) == "") { ?>
		<th data-name="EngineerDate" class="<?php echo $ipc_tracking_grid->EngineerDate->headerCellClass() ?>"><div id="elh_ipc_tracking_EngineerDate" class="ipc_tracking_EngineerDate"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->EngineerDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EngineerDate" class="<?php echo $ipc_tracking_grid->EngineerDate->headerCellClass() ?>"><div><div id="elh_ipc_tracking_EngineerDate" class="ipc_tracking_EngineerDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->EngineerDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->EngineerDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->EngineerDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->CouncilSecretary->Visible) { // CouncilSecretary ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->CouncilSecretary) == "") { ?>
		<th data-name="CouncilSecretary" class="<?php echo $ipc_tracking_grid->CouncilSecretary->headerCellClass() ?>"><div id="elh_ipc_tracking_CouncilSecretary" class="ipc_tracking_CouncilSecretary"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->CouncilSecretary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilSecretary" class="<?php echo $ipc_tracking_grid->CouncilSecretary->headerCellClass() ?>"><div><div id="elh_ipc_tracking_CouncilSecretary" class="ipc_tracking_CouncilSecretary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->CouncilSecretary->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->CouncilSecretary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->CouncilSecretary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->CSDate->Visible) { // CSDate ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->CSDate) == "") { ?>
		<th data-name="CSDate" class="<?php echo $ipc_tracking_grid->CSDate->headerCellClass() ?>"><div id="elh_ipc_tracking_CSDate" class="ipc_tracking_CSDate"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->CSDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CSDate" class="<?php echo $ipc_tracking_grid->CSDate->headerCellClass() ?>"><div><div id="elh_ipc_tracking_CSDate" class="ipc_tracking_CSDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->CSDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->CSDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->CSDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ipc_tracking_grid->ContractType->Visible) { // ContractType ?>
	<?php if ($ipc_tracking_grid->SortUrl($ipc_tracking_grid->ContractType) == "") { ?>
		<th data-name="ContractType" class="<?php echo $ipc_tracking_grid->ContractType->headerCellClass() ?>"><div id="elh_ipc_tracking_ContractType" class="ipc_tracking_ContractType"><div class="ew-table-header-caption"><?php echo $ipc_tracking_grid->ContractType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractType" class="<?php echo $ipc_tracking_grid->ContractType->headerCellClass() ?>"><div><div id="elh_ipc_tracking_ContractType" class="ipc_tracking_ContractType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ipc_tracking_grid->ContractType->caption() ?></span><span class="ew-table-header-sort"><?php if ($ipc_tracking_grid->ContractType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ipc_tracking_grid->ContractType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ipc_tracking_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$ipc_tracking_grid->StartRecord = 1;
$ipc_tracking_grid->StopRecord = $ipc_tracking_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($ipc_tracking->isConfirm() || $ipc_tracking_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($ipc_tracking_grid->FormKeyCountName) && ($ipc_tracking_grid->isGridAdd() || $ipc_tracking_grid->isGridEdit() || $ipc_tracking->isConfirm())) {
		$ipc_tracking_grid->KeyCount = $CurrentForm->getValue($ipc_tracking_grid->FormKeyCountName);
		$ipc_tracking_grid->StopRecord = $ipc_tracking_grid->StartRecord + $ipc_tracking_grid->KeyCount - 1;
	}
}
$ipc_tracking_grid->RecordCount = $ipc_tracking_grid->StartRecord - 1;
if ($ipc_tracking_grid->Recordset && !$ipc_tracking_grid->Recordset->EOF) {
	$ipc_tracking_grid->Recordset->moveFirst();
	$selectLimit = $ipc_tracking_grid->UseSelectLimit;
	if (!$selectLimit && $ipc_tracking_grid->StartRecord > 1)
		$ipc_tracking_grid->Recordset->move($ipc_tracking_grid->StartRecord - 1);
} elseif (!$ipc_tracking->AllowAddDeleteRow && $ipc_tracking_grid->StopRecord == 0) {
	$ipc_tracking_grid->StopRecord = $ipc_tracking->GridAddRowCount;
}

// Initialize aggregate
$ipc_tracking->RowType = ROWTYPE_AGGREGATEINIT;
$ipc_tracking->resetAttributes();
$ipc_tracking_grid->renderRow();
if ($ipc_tracking_grid->isGridAdd())
	$ipc_tracking_grid->RowIndex = 0;
if ($ipc_tracking_grid->isGridEdit())
	$ipc_tracking_grid->RowIndex = 0;
while ($ipc_tracking_grid->RecordCount < $ipc_tracking_grid->StopRecord) {
	$ipc_tracking_grid->RecordCount++;
	if ($ipc_tracking_grid->RecordCount >= $ipc_tracking_grid->StartRecord) {
		$ipc_tracking_grid->RowCount++;
		if ($ipc_tracking_grid->isGridAdd() || $ipc_tracking_grid->isGridEdit() || $ipc_tracking->isConfirm()) {
			$ipc_tracking_grid->RowIndex++;
			$CurrentForm->Index = $ipc_tracking_grid->RowIndex;
			if ($CurrentForm->hasValue($ipc_tracking_grid->FormActionName) && ($ipc_tracking->isConfirm() || $ipc_tracking_grid->EventCancelled))
				$ipc_tracking_grid->RowAction = strval($CurrentForm->getValue($ipc_tracking_grid->FormActionName));
			elseif ($ipc_tracking_grid->isGridAdd())
				$ipc_tracking_grid->RowAction = "insert";
			else
				$ipc_tracking_grid->RowAction = "";
		}

		// Set up key count
		$ipc_tracking_grid->KeyCount = $ipc_tracking_grid->RowIndex;

		// Init row class and style
		$ipc_tracking->resetAttributes();
		$ipc_tracking->CssClass = "";
		if ($ipc_tracking_grid->isGridAdd()) {
			if ($ipc_tracking->CurrentMode == "copy") {
				$ipc_tracking_grid->loadRowValues($ipc_tracking_grid->Recordset); // Load row values
				$ipc_tracking_grid->setRecordKey($ipc_tracking_grid->RowOldKey, $ipc_tracking_grid->Recordset); // Set old record key
			} else {
				$ipc_tracking_grid->loadRowValues(); // Load default values
				$ipc_tracking_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$ipc_tracking_grid->loadRowValues($ipc_tracking_grid->Recordset); // Load row values
		}
		$ipc_tracking->RowType = ROWTYPE_VIEW; // Render view
		if ($ipc_tracking_grid->isGridAdd()) // Grid add
			$ipc_tracking->RowType = ROWTYPE_ADD; // Render add
		if ($ipc_tracking_grid->isGridAdd() && $ipc_tracking->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$ipc_tracking_grid->restoreCurrentRowFormValues($ipc_tracking_grid->RowIndex); // Restore form values
		if ($ipc_tracking_grid->isGridEdit()) { // Grid edit
			if ($ipc_tracking->EventCancelled)
				$ipc_tracking_grid->restoreCurrentRowFormValues($ipc_tracking_grid->RowIndex); // Restore form values
			if ($ipc_tracking_grid->RowAction == "insert")
				$ipc_tracking->RowType = ROWTYPE_ADD; // Render add
			else
				$ipc_tracking->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($ipc_tracking_grid->isGridEdit() && ($ipc_tracking->RowType == ROWTYPE_EDIT || $ipc_tracking->RowType == ROWTYPE_ADD) && $ipc_tracking->EventCancelled) // Update failed
			$ipc_tracking_grid->restoreCurrentRowFormValues($ipc_tracking_grid->RowIndex); // Restore form values
		if ($ipc_tracking->RowType == ROWTYPE_EDIT) // Edit row
			$ipc_tracking_grid->EditRowCount++;
		if ($ipc_tracking->isConfirm()) // Confirm row
			$ipc_tracking_grid->restoreCurrentRowFormValues($ipc_tracking_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$ipc_tracking->RowAttrs->merge(["data-rowindex" => $ipc_tracking_grid->RowCount, "id" => "r" . $ipc_tracking_grid->RowCount . "_ipc_tracking", "data-rowtype" => $ipc_tracking->RowType]);

		// Render row
		$ipc_tracking_grid->renderRow();

		// Render list options
		$ipc_tracking_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($ipc_tracking_grid->RowAction != "delete" && $ipc_tracking_grid->RowAction != "insertdelete" && !($ipc_tracking_grid->RowAction == "insert" && $ipc_tracking->isConfirm() && $ipc_tracking_grid->emptyRow())) {
?>
	<tr <?php echo $ipc_tracking->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ipc_tracking_grid->ListOptions->render("body", "left", $ipc_tracking_grid->RowCount);
?>
	<?php if ($ipc_tracking_grid->IPCNo->Visible) { // IPCNo ?>
		<td data-name="IPCNo" <?php echo $ipc_tracking_grid->IPCNo->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_IPCNo" class="form-group"></span>
<input type="hidden" data-table="ipc_tracking" data-field="x_IPCNo" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" value="<?php echo HtmlEncode($ipc_tracking_grid->IPCNo->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_IPCNo" class="form-group">
<span<?php echo $ipc_tracking_grid->IPCNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->IPCNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_IPCNo" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" value="<?php echo HtmlEncode($ipc_tracking_grid->IPCNo->CurrentValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_IPCNo">
<span<?php echo $ipc_tracking_grid->IPCNo->viewAttributes() ?>><?php echo $ipc_tracking_grid->IPCNo->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_IPCNo" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" value="<?php echo HtmlEncode($ipc_tracking_grid->IPCNo->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_IPCNo" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" value="<?php echo HtmlEncode($ipc_tracking_grid->IPCNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_IPCNo" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" value="<?php echo HtmlEncode($ipc_tracking_grid->IPCNo->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_IPCNo" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" value="<?php echo HtmlEncode($ipc_tracking_grid->IPCNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->ContractNo->Visible) { // ContractNo ?>
		<td data-name="ContractNo" <?php echo $ipc_tracking_grid->ContractNo->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($ipc_tracking_grid->ContractNo->getSessionValue() != "") { ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractNo" class="form-group">
<span<?php echo $ipc_tracking_grid->ContractNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->ContractNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractNo" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_ContractNo" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->ContractNo->EditValue ?>"<?php echo $ipc_tracking_grid->ContractNo->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractNo" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($ipc_tracking_grid->ContractNo->getSessionValue() != "") { ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractNo" class="form-group">
<span<?php echo $ipc_tracking_grid->ContractNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->ContractNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractNo" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_ContractNo" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->ContractNo->EditValue ?>"<?php echo $ipc_tracking_grid->ContractNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractNo">
<span<?php echo $ipc_tracking_grid->ContractNo->viewAttributes() ?>><?php echo $ipc_tracking_grid->ContractNo->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractNo" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractNo" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractNo" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractNo" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
		<td data-name="ContractAuthorizedByAG" <?php echo $ipc_tracking_grid->ContractAuthorizedByAG->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractAuthorizedByAG" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->ContractAuthorizedByAG->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]_640387" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->ContractAuthorizedByAG->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]_640387"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractAuthorizedByAG->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractAuthorizedByAG" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->ContractAuthorizedByAG->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]_348984" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->ContractAuthorizedByAG->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]_348984"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractAuthorizedByAG">
<span<?php echo $ipc_tracking_grid->ContractAuthorizedByAG->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ContractAuthorizedByAG" class="custom-control-input" value="<?php echo $ipc_tracking_grid->ContractAuthorizedByAG->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->ContractAuthorizedByAG->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ContractAuthorizedByAG"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractAuthorizedByAG->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractAuthorizedByAG->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractAuthorizedByAG->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractAuthorizedByAG->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->VATApplied->Visible) { // VATApplied ?>
		<td data-name="VATApplied" <?php echo $ipc_tracking_grid->VATApplied->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_VATApplied" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->VATApplied->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_VATApplied" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]_234327" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->VATApplied->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]_234327"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_VATApplied" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]" value="<?php echo HtmlEncode($ipc_tracking_grid->VATApplied->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_VATApplied" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->VATApplied->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_VATApplied" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]_660028" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->VATApplied->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]_660028"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_VATApplied">
<span<?php echo $ipc_tracking_grid->VATApplied->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_VATApplied" class="custom-control-input" value="<?php echo $ipc_tracking_grid->VATApplied->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->VATApplied->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_VATApplied"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_VATApplied" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied" value="<?php echo HtmlEncode($ipc_tracking_grid->VATApplied->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_VATApplied" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]" value="<?php echo HtmlEncode($ipc_tracking_grid->VATApplied->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_VATApplied" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied" value="<?php echo HtmlEncode($ipc_tracking_grid->VATApplied->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_VATApplied" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]" value="<?php echo HtmlEncode($ipc_tracking_grid->VATApplied->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
		<td data-name="ArithmeticCheckDone" <?php echo $ipc_tracking_grid->ArithmeticCheckDone->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ArithmeticCheckDone" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->ArithmeticCheckDone->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]_577954" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->ArithmeticCheckDone->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]_577954"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]" value="<?php echo HtmlEncode($ipc_tracking_grid->ArithmeticCheckDone->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ArithmeticCheckDone" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->ArithmeticCheckDone->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]_585677" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->ArithmeticCheckDone->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]_585677"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ArithmeticCheckDone">
<span<?php echo $ipc_tracking_grid->ArithmeticCheckDone->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ArithmeticCheckDone" class="custom-control-input" value="<?php echo $ipc_tracking_grid->ArithmeticCheckDone->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->ArithmeticCheckDone->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ArithmeticCheckDone"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone" value="<?php echo HtmlEncode($ipc_tracking_grid->ArithmeticCheckDone->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]" value="<?php echo HtmlEncode($ipc_tracking_grid->ArithmeticCheckDone->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone" value="<?php echo HtmlEncode($ipc_tracking_grid->ArithmeticCheckDone->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]" value="<?php echo HtmlEncode($ipc_tracking_grid->ArithmeticCheckDone->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->VariationsApproved->Visible) { // VariationsApproved ?>
		<td data-name="VariationsApproved" <?php echo $ipc_tracking_grid->VariationsApproved->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_VariationsApproved" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->VariationsApproved->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_VariationsApproved" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]_199225" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->VariationsApproved->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]_199225"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_VariationsApproved" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]" value="<?php echo HtmlEncode($ipc_tracking_grid->VariationsApproved->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_VariationsApproved" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->VariationsApproved->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_VariationsApproved" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]_966879" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->VariationsApproved->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]_966879"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_VariationsApproved">
<span<?php echo $ipc_tracking_grid->VariationsApproved->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_VariationsApproved" class="custom-control-input" value="<?php echo $ipc_tracking_grid->VariationsApproved->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->VariationsApproved->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_VariationsApproved"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_VariationsApproved" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved" value="<?php echo HtmlEncode($ipc_tracking_grid->VariationsApproved->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_VariationsApproved" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]" value="<?php echo HtmlEncode($ipc_tracking_grid->VariationsApproved->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_VariationsApproved" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved" value="<?php echo HtmlEncode($ipc_tracking_grid->VariationsApproved->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_VariationsApproved" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]" value="<?php echo HtmlEncode($ipc_tracking_grid->VariationsApproved->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
		<td data-name="PerformanceBondValidUntil" <?php echo $ipc_tracking_grid->PerformanceBondValidUntil->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_PerformanceBondValidUntil" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->PerformanceBondValidUntil->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->PerformanceBondValidUntil->EditValue ?>"<?php echo $ipc_tracking_grid->PerformanceBondValidUntil->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->PerformanceBondValidUntil->ReadOnly && !$ipc_tracking_grid->PerformanceBondValidUntil->Disabled && !isset($ipc_tracking_grid->PerformanceBondValidUntil->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->PerformanceBondValidUntil->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->PerformanceBondValidUntil->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_PerformanceBondValidUntil" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->PerformanceBondValidUntil->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->PerformanceBondValidUntil->EditValue ?>"<?php echo $ipc_tracking_grid->PerformanceBondValidUntil->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->PerformanceBondValidUntil->ReadOnly && !$ipc_tracking_grid->PerformanceBondValidUntil->Disabled && !isset($ipc_tracking_grid->PerformanceBondValidUntil->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->PerformanceBondValidUntil->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_PerformanceBondValidUntil">
<span<?php echo $ipc_tracking_grid->PerformanceBondValidUntil->viewAttributes() ?>><?php echo $ipc_tracking_grid->PerformanceBondValidUntil->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->PerformanceBondValidUntil->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->PerformanceBondValidUntil->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->PerformanceBondValidUntil->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->PerformanceBondValidUntil->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
		<td data-name="AdvancePaymentBondValidUntil" <?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_AdvancePaymentBondValidUntil" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->AdvancePaymentBondValidUntil->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->EditValue ?>"<?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->AdvancePaymentBondValidUntil->ReadOnly && !$ipc_tracking_grid->AdvancePaymentBondValidUntil->Disabled && !isset($ipc_tracking_grid->AdvancePaymentBondValidUntil->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->AdvancePaymentBondValidUntil->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancePaymentBondValidUntil->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_AdvancePaymentBondValidUntil" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->AdvancePaymentBondValidUntil->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->EditValue ?>"<?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->AdvancePaymentBondValidUntil->ReadOnly && !$ipc_tracking_grid->AdvancePaymentBondValidUntil->Disabled && !isset($ipc_tracking_grid->AdvancePaymentBondValidUntil->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->AdvancePaymentBondValidUntil->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_AdvancePaymentBondValidUntil">
<span<?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->viewAttributes() ?>><?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancePaymentBondValidUntil->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancePaymentBondValidUntil->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancePaymentBondValidUntil->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancePaymentBondValidUntil->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
		<td data-name="RetentionDeductionClause" <?php echo $ipc_tracking_grid->RetentionDeductionClause->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_RetentionDeductionClause" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeductionClause->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->RetentionDeductionClause->EditValue ?>"<?php echo $ipc_tracking_grid->RetentionDeductionClause->editAttributes() ?>>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeductionClause->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_RetentionDeductionClause" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeductionClause->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->RetentionDeductionClause->EditValue ?>"<?php echo $ipc_tracking_grid->RetentionDeductionClause->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_RetentionDeductionClause">
<span<?php echo $ipc_tracking_grid->RetentionDeductionClause->viewAttributes() ?>><?php echo $ipc_tracking_grid->RetentionDeductionClause->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeductionClause->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeductionClause->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeductionClause->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeductionClause->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->RetentionDeducted->Visible) { // RetentionDeducted ?>
		<td data-name="RetentionDeducted" <?php echo $ipc_tracking_grid->RetentionDeducted->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_RetentionDeducted" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->RetentionDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]_676770" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->RetentionDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]_676770"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeducted->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_RetentionDeducted" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->RetentionDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]_736013" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->RetentionDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]_736013"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_RetentionDeducted">
<span<?php echo $ipc_tracking_grid->RetentionDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_RetentionDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_grid->RetentionDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->RetentionDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_RetentionDeducted"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeducted->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeducted->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeducted->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeducted->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
		<td data-name="LiquidatedDamagesDeducted" <?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_LiquidatedDamagesDeducted" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->LiquidatedDamagesDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]_704045" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]_704045"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]" value="<?php echo HtmlEncode($ipc_tracking_grid->LiquidatedDamagesDeducted->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_LiquidatedDamagesDeducted" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->LiquidatedDamagesDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]_681727" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]_681727"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_LiquidatedDamagesDeducted">
<span<?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LiquidatedDamagesDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->LiquidatedDamagesDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LiquidatedDamagesDeducted"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted" value="<?php echo HtmlEncode($ipc_tracking_grid->LiquidatedDamagesDeducted->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]" value="<?php echo HtmlEncode($ipc_tracking_grid->LiquidatedDamagesDeducted->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted" value="<?php echo HtmlEncode($ipc_tracking_grid->LiquidatedDamagesDeducted->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]" value="<?php echo HtmlEncode($ipc_tracking_grid->LiquidatedDamagesDeducted->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
		<td data-name="AdvancedPaymentDeducted" <?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_AdvancedPaymentDeducted" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->AdvancedPaymentDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]_785252" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]_785252"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancedPaymentDeducted->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_AdvancedPaymentDeducted" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->AdvancedPaymentDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]_686795" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]_686795"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_AdvancedPaymentDeducted">
<span<?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AdvancedPaymentDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->AdvancedPaymentDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AdvancedPaymentDeducted"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancedPaymentDeducted->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancedPaymentDeducted->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancedPaymentDeducted->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancedPaymentDeducted->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
		<td data-name="CurrentProgressReportAttached" <?php echo $ipc_tracking_grid->CurrentProgressReportAttached->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_CurrentProgressReportAttached" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->CurrentProgressReportAttached->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]_430271" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->CurrentProgressReportAttached->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]_430271"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]" value="<?php echo HtmlEncode($ipc_tracking_grid->CurrentProgressReportAttached->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_CurrentProgressReportAttached" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->CurrentProgressReportAttached->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]_337612" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->CurrentProgressReportAttached->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]_337612"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_CurrentProgressReportAttached">
<span<?php echo $ipc_tracking_grid->CurrentProgressReportAttached->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CurrentProgressReportAttached" class="custom-control-input" value="<?php echo $ipc_tracking_grid->CurrentProgressReportAttached->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->CurrentProgressReportAttached->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CurrentProgressReportAttached"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached" value="<?php echo HtmlEncode($ipc_tracking_grid->CurrentProgressReportAttached->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]" value="<?php echo HtmlEncode($ipc_tracking_grid->CurrentProgressReportAttached->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached" value="<?php echo HtmlEncode($ipc_tracking_grid->CurrentProgressReportAttached->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]" value="<?php echo HtmlEncode($ipc_tracking_grid->CurrentProgressReportAttached->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
		<td data-name="DateOfSiteInspection" <?php echo $ipc_tracking_grid->DateOfSiteInspection->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_DateOfSiteInspection" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->DateOfSiteInspection->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->DateOfSiteInspection->EditValue ?>"<?php echo $ipc_tracking_grid->DateOfSiteInspection->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->DateOfSiteInspection->ReadOnly && !$ipc_tracking_grid->DateOfSiteInspection->Disabled && !isset($ipc_tracking_grid->DateOfSiteInspection->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->DateOfSiteInspection->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" value="<?php echo HtmlEncode($ipc_tracking_grid->DateOfSiteInspection->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_DateOfSiteInspection" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->DateOfSiteInspection->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->DateOfSiteInspection->EditValue ?>"<?php echo $ipc_tracking_grid->DateOfSiteInspection->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->DateOfSiteInspection->ReadOnly && !$ipc_tracking_grid->DateOfSiteInspection->Disabled && !isset($ipc_tracking_grid->DateOfSiteInspection->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->DateOfSiteInspection->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_DateOfSiteInspection">
<span<?php echo $ipc_tracking_grid->DateOfSiteInspection->viewAttributes() ?>><?php echo $ipc_tracking_grid->DateOfSiteInspection->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" value="<?php echo HtmlEncode($ipc_tracking_grid->DateOfSiteInspection->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" value="<?php echo HtmlEncode($ipc_tracking_grid->DateOfSiteInspection->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" value="<?php echo HtmlEncode($ipc_tracking_grid->DateOfSiteInspection->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" value="<?php echo HtmlEncode($ipc_tracking_grid->DateOfSiteInspection->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
		<td data-name="TimeExtensionAuthorized" <?php echo $ipc_tracking_grid->TimeExtensionAuthorized->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_TimeExtensionAuthorized" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->TimeExtensionAuthorized->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]_130388" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->TimeExtensionAuthorized->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]_130388"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]" value="<?php echo HtmlEncode($ipc_tracking_grid->TimeExtensionAuthorized->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_TimeExtensionAuthorized" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->TimeExtensionAuthorized->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]_206844" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->TimeExtensionAuthorized->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]_206844"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_TimeExtensionAuthorized">
<span<?php echo $ipc_tracking_grid->TimeExtensionAuthorized->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TimeExtensionAuthorized" class="custom-control-input" value="<?php echo $ipc_tracking_grid->TimeExtensionAuthorized->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->TimeExtensionAuthorized->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TimeExtensionAuthorized"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized" value="<?php echo HtmlEncode($ipc_tracking_grid->TimeExtensionAuthorized->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]" value="<?php echo HtmlEncode($ipc_tracking_grid->TimeExtensionAuthorized->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized" value="<?php echo HtmlEncode($ipc_tracking_grid->TimeExtensionAuthorized->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]" value="<?php echo HtmlEncode($ipc_tracking_grid->TimeExtensionAuthorized->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->LabResultsChecked->Visible) { // LabResultsChecked ?>
		<td data-name="LabResultsChecked" <?php echo $ipc_tracking_grid->LabResultsChecked->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_LabResultsChecked" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->LabResultsChecked->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]_789674" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->LabResultsChecked->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]_789674"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]" value="<?php echo HtmlEncode($ipc_tracking_grid->LabResultsChecked->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_LabResultsChecked" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->LabResultsChecked->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]_642045" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->LabResultsChecked->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]_642045"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_LabResultsChecked">
<span<?php echo $ipc_tracking_grid->LabResultsChecked->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LabResultsChecked" class="custom-control-input" value="<?php echo $ipc_tracking_grid->LabResultsChecked->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->LabResultsChecked->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LabResultsChecked"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked" value="<?php echo HtmlEncode($ipc_tracking_grid->LabResultsChecked->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]" value="<?php echo HtmlEncode($ipc_tracking_grid->LabResultsChecked->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked" value="<?php echo HtmlEncode($ipc_tracking_grid->LabResultsChecked->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]" value="<?php echo HtmlEncode($ipc_tracking_grid->LabResultsChecked->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
		<td data-name="TerminationNoticeGiven" <?php echo $ipc_tracking_grid->TerminationNoticeGiven->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_TerminationNoticeGiven" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->TerminationNoticeGiven->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]_579262" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->TerminationNoticeGiven->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]_579262"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]" value="<?php echo HtmlEncode($ipc_tracking_grid->TerminationNoticeGiven->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_TerminationNoticeGiven" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->TerminationNoticeGiven->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]_326691" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->TerminationNoticeGiven->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]_326691"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_TerminationNoticeGiven">
<span<?php echo $ipc_tracking_grid->TerminationNoticeGiven->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TerminationNoticeGiven" class="custom-control-input" value="<?php echo $ipc_tracking_grid->TerminationNoticeGiven->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->TerminationNoticeGiven->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TerminationNoticeGiven"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven" value="<?php echo HtmlEncode($ipc_tracking_grid->TerminationNoticeGiven->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]" value="<?php echo HtmlEncode($ipc_tracking_grid->TerminationNoticeGiven->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven" value="<?php echo HtmlEncode($ipc_tracking_grid->TerminationNoticeGiven->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]" value="<?php echo HtmlEncode($ipc_tracking_grid->TerminationNoticeGiven->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
		<td data-name="CopiesEmailedToMLG" <?php echo $ipc_tracking_grid->CopiesEmailedToMLG->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_CopiesEmailedToMLG" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->CopiesEmailedToMLG->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]_518001" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->CopiesEmailedToMLG->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]_518001"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]" value="<?php echo HtmlEncode($ipc_tracking_grid->CopiesEmailedToMLG->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_CopiesEmailedToMLG" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->CopiesEmailedToMLG->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]_996028" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->CopiesEmailedToMLG->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]_996028"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_CopiesEmailedToMLG">
<span<?php echo $ipc_tracking_grid->CopiesEmailedToMLG->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CopiesEmailedToMLG" class="custom-control-input" value="<?php echo $ipc_tracking_grid->CopiesEmailedToMLG->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->CopiesEmailedToMLG->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CopiesEmailedToMLG"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG" value="<?php echo HtmlEncode($ipc_tracking_grid->CopiesEmailedToMLG->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]" value="<?php echo HtmlEncode($ipc_tracking_grid->CopiesEmailedToMLG->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG" value="<?php echo HtmlEncode($ipc_tracking_grid->CopiesEmailedToMLG->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]" value="<?php echo HtmlEncode($ipc_tracking_grid->CopiesEmailedToMLG->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->ContractStillValid->Visible) { // ContractStillValid ?>
		<td data-name="ContractStillValid" <?php echo $ipc_tracking_grid->ContractStillValid->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractStillValid" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->ContractStillValid->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ContractStillValid" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]_890303" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->ContractStillValid->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]_890303"></label>
</div>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractStillValid" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractStillValid->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractStillValid" class="form-group">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->ContractStillValid->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ContractStillValid" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]_932549" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->ContractStillValid->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]_932549"></label>
</div>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractStillValid">
<span<?php echo $ipc_tracking_grid->ContractStillValid->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ContractStillValid" class="custom-control-input" value="<?php echo $ipc_tracking_grid->ContractStillValid->getViewValue() ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->ContractStillValid->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ContractStillValid"></label></div></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractStillValid" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractStillValid->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractStillValid" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractStillValid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractStillValid" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractStillValid->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractStillValid" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractStillValid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->DeskOfficer->Visible) { // DeskOfficer ?>
		<td data-name="DeskOfficer" <?php echo $ipc_tracking_grid->DeskOfficer->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_DeskOfficer" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_DeskOfficer" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficer->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->DeskOfficer->EditValue ?>"<?php echo $ipc_tracking_grid->DeskOfficer->editAttributes() ?>>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficer" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficer->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_DeskOfficer" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_DeskOfficer" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficer->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->DeskOfficer->EditValue ?>"<?php echo $ipc_tracking_grid->DeskOfficer->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_DeskOfficer">
<span<?php echo $ipc_tracking_grid->DeskOfficer->viewAttributes() ?>><?php echo $ipc_tracking_grid->DeskOfficer->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficer" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficer->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficer" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficer->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficer" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficer->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficer" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficer->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
		<td data-name="DeskOfficerDate" <?php echo $ipc_tracking_grid->DeskOfficerDate->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_DeskOfficerDate" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficerDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->DeskOfficerDate->EditValue ?>"<?php echo $ipc_tracking_grid->DeskOfficerDate->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->DeskOfficerDate->ReadOnly && !$ipc_tracking_grid->DeskOfficerDate->Disabled && !isset($ipc_tracking_grid->DeskOfficerDate->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->DeskOfficerDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficerDate->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_DeskOfficerDate" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficerDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->DeskOfficerDate->EditValue ?>"<?php echo $ipc_tracking_grid->DeskOfficerDate->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->DeskOfficerDate->ReadOnly && !$ipc_tracking_grid->DeskOfficerDate->Disabled && !isset($ipc_tracking_grid->DeskOfficerDate->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->DeskOfficerDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_DeskOfficerDate">
<span<?php echo $ipc_tracking_grid->DeskOfficerDate->viewAttributes() ?>><?php echo $ipc_tracking_grid->DeskOfficerDate->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficerDate->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficerDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficerDate->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficerDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
		<td data-name="SupervisingEngineer" <?php echo $ipc_tracking_grid->SupervisingEngineer->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_SupervisingEngineer" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->SupervisingEngineer->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->SupervisingEngineer->EditValue ?>"<?php echo $ipc_tracking_grid->SupervisingEngineer->editAttributes() ?>>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" value="<?php echo HtmlEncode($ipc_tracking_grid->SupervisingEngineer->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_SupervisingEngineer" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->SupervisingEngineer->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->SupervisingEngineer->EditValue ?>"<?php echo $ipc_tracking_grid->SupervisingEngineer->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_SupervisingEngineer">
<span<?php echo $ipc_tracking_grid->SupervisingEngineer->viewAttributes() ?>><?php echo $ipc_tracking_grid->SupervisingEngineer->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" value="<?php echo HtmlEncode($ipc_tracking_grid->SupervisingEngineer->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" value="<?php echo HtmlEncode($ipc_tracking_grid->SupervisingEngineer->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" value="<?php echo HtmlEncode($ipc_tracking_grid->SupervisingEngineer->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" value="<?php echo HtmlEncode($ipc_tracking_grid->SupervisingEngineer->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->EngineerDate->Visible) { // EngineerDate ?>
		<td data-name="EngineerDate" <?php echo $ipc_tracking_grid->EngineerDate->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_EngineerDate" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_EngineerDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->EngineerDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->EngineerDate->EditValue ?>"<?php echo $ipc_tracking_grid->EngineerDate->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->EngineerDate->ReadOnly && !$ipc_tracking_grid->EngineerDate->Disabled && !isset($ipc_tracking_grid->EngineerDate->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->EngineerDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_EngineerDate" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->EngineerDate->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_EngineerDate" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_EngineerDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->EngineerDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->EngineerDate->EditValue ?>"<?php echo $ipc_tracking_grid->EngineerDate->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->EngineerDate->ReadOnly && !$ipc_tracking_grid->EngineerDate->Disabled && !isset($ipc_tracking_grid->EngineerDate->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->EngineerDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_EngineerDate">
<span<?php echo $ipc_tracking_grid->EngineerDate->viewAttributes() ?>><?php echo $ipc_tracking_grid->EngineerDate->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_EngineerDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->EngineerDate->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_EngineerDate" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->EngineerDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_EngineerDate" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->EngineerDate->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_EngineerDate" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->EngineerDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->CouncilSecretary->Visible) { // CouncilSecretary ?>
		<td data-name="CouncilSecretary" <?php echo $ipc_tracking_grid->CouncilSecretary->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_CouncilSecretary" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->CouncilSecretary->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->CouncilSecretary->EditValue ?>"<?php echo $ipc_tracking_grid->CouncilSecretary->editAttributes() ?>>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" value="<?php echo HtmlEncode($ipc_tracking_grid->CouncilSecretary->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_CouncilSecretary" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->CouncilSecretary->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->CouncilSecretary->EditValue ?>"<?php echo $ipc_tracking_grid->CouncilSecretary->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_CouncilSecretary">
<span<?php echo $ipc_tracking_grid->CouncilSecretary->viewAttributes() ?>><?php echo $ipc_tracking_grid->CouncilSecretary->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" value="<?php echo HtmlEncode($ipc_tracking_grid->CouncilSecretary->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" value="<?php echo HtmlEncode($ipc_tracking_grid->CouncilSecretary->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" value="<?php echo HtmlEncode($ipc_tracking_grid->CouncilSecretary->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" value="<?php echo HtmlEncode($ipc_tracking_grid->CouncilSecretary->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->CSDate->Visible) { // CSDate ?>
		<td data-name="CSDate" <?php echo $ipc_tracking_grid->CSDate->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_CSDate" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_CSDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->CSDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->CSDate->EditValue ?>"<?php echo $ipc_tracking_grid->CSDate->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->CSDate->ReadOnly && !$ipc_tracking_grid->CSDate->Disabled && !isset($ipc_tracking_grid->CSDate->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->CSDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_CSDate" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" value="<?php echo HtmlEncode($ipc_tracking_grid->CSDate->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_CSDate" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_CSDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->CSDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->CSDate->EditValue ?>"<?php echo $ipc_tracking_grid->CSDate->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->CSDate->ReadOnly && !$ipc_tracking_grid->CSDate->Disabled && !isset($ipc_tracking_grid->CSDate->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->CSDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_CSDate">
<span<?php echo $ipc_tracking_grid->CSDate->viewAttributes() ?>><?php echo $ipc_tracking_grid->CSDate->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_CSDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" value="<?php echo HtmlEncode($ipc_tracking_grid->CSDate->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_CSDate" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" value="<?php echo HtmlEncode($ipc_tracking_grid->CSDate->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_CSDate" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" value="<?php echo HtmlEncode($ipc_tracking_grid->CSDate->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_CSDate" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" value="<?php echo HtmlEncode($ipc_tracking_grid->CSDate->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->ContractType->Visible) { // ContractType ?>
		<td data-name="ContractType" <?php echo $ipc_tracking_grid->ContractType->cellAttributes() ?>>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractType" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_ContractType" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->ContractType->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->ContractType->EditValue ?>"<?php echo $ipc_tracking_grid->ContractType->editAttributes() ?>>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractType" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractType->OldValue) ?>">
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractType" class="form-group">
<input type="text" data-table="ipc_tracking" data-field="x_ContractType" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->ContractType->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->ContractType->EditValue ?>"<?php echo $ipc_tracking_grid->ContractType->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($ipc_tracking->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $ipc_tracking_grid->RowCount ?>_ipc_tracking_ContractType">
<span<?php echo $ipc_tracking_grid->ContractType->viewAttributes() ?>><?php echo $ipc_tracking_grid->ContractType->getViewValue() ?></span>
</span>
<?php if (!$ipc_tracking->isConfirm()) { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractType" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractType->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractType" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractType->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractType" name="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" id="fipc_trackinggrid$x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractType->FormValue) ?>">
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractType" name="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" id="fipc_trackinggrid$o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractType->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ipc_tracking_grid->ListOptions->render("body", "right", $ipc_tracking_grid->RowCount);
?>
	</tr>
<?php if ($ipc_tracking->RowType == ROWTYPE_ADD || $ipc_tracking->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "load"], function() {
	fipc_trackinggrid.updateLists(<?php echo $ipc_tracking_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$ipc_tracking_grid->isGridAdd() || $ipc_tracking->CurrentMode == "copy")
		if (!$ipc_tracking_grid->Recordset->EOF)
			$ipc_tracking_grid->Recordset->moveNext();
}
?>
<?php
	if ($ipc_tracking->CurrentMode == "add" || $ipc_tracking->CurrentMode == "copy" || $ipc_tracking->CurrentMode == "edit") {
		$ipc_tracking_grid->RowIndex = '$rowindex$';
		$ipc_tracking_grid->loadRowValues();

		// Set row properties
		$ipc_tracking->resetAttributes();
		$ipc_tracking->RowAttrs->merge(["data-rowindex" => $ipc_tracking_grid->RowIndex, "id" => "r0_ipc_tracking", "data-rowtype" => ROWTYPE_ADD]);
		$ipc_tracking->RowAttrs->appendClass("ew-template");
		$ipc_tracking->RowType = ROWTYPE_ADD;

		// Render row
		$ipc_tracking_grid->renderRow();

		// Render list options
		$ipc_tracking_grid->renderListOptions();
		$ipc_tracking_grid->StartRowCount = 0;
?>
	<tr <?php echo $ipc_tracking->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ipc_tracking_grid->ListOptions->render("body", "left", $ipc_tracking_grid->RowIndex);
?>
	<?php if ($ipc_tracking_grid->IPCNo->Visible) { // IPCNo ?>
		<td data-name="IPCNo">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_IPCNo" class="form-group ipc_tracking_IPCNo"></span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_IPCNo" class="form-group ipc_tracking_IPCNo">
<span<?php echo $ipc_tracking_grid->IPCNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->IPCNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_IPCNo" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" value="<?php echo HtmlEncode($ipc_tracking_grid->IPCNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_IPCNo" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_IPCNo" value="<?php echo HtmlEncode($ipc_tracking_grid->IPCNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->ContractNo->Visible) { // ContractNo ?>
		<td data-name="ContractNo">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<?php if ($ipc_tracking_grid->ContractNo->getSessionValue() != "") { ?>
<span id="el$rowindex$_ipc_tracking_ContractNo" class="form-group ipc_tracking_ContractNo">
<span<?php echo $ipc_tracking_grid->ContractNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->ContractNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_ContractNo" class="form-group ipc_tracking_ContractNo">
<input type="text" data-table="ipc_tracking" data-field="x_ContractNo" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->ContractNo->EditValue ?>"<?php echo $ipc_tracking_grid->ContractNo->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_ContractNo" class="form-group ipc_tracking_ContractNo">
<span<?php echo $ipc_tracking_grid->ContractNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->ContractNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractNo" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractNo" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractNo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
		<td data-name="ContractAuthorizedByAG">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_ContractAuthorizedByAG" class="form-group ipc_tracking_ContractAuthorizedByAG">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->ContractAuthorizedByAG->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]_635989" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->ContractAuthorizedByAG->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]_635989"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_ContractAuthorizedByAG" class="form-group ipc_tracking_ContractAuthorizedByAG">
<span<?php echo $ipc_tracking_grid->ContractAuthorizedByAG->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ContractAuthorizedByAG" class="custom-control-input" value="<?php echo $ipc_tracking_grid->ContractAuthorizedByAG->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->ContractAuthorizedByAG->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ContractAuthorizedByAG"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractAuthorizedByAG->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractAuthorizedByAG[]" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractAuthorizedByAG->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->VATApplied->Visible) { // VATApplied ?>
		<td data-name="VATApplied">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_VATApplied" class="form-group ipc_tracking_VATApplied">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->VATApplied->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_VATApplied" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]_156442" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->VATApplied->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]_156442"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_VATApplied" class="form-group ipc_tracking_VATApplied">
<span<?php echo $ipc_tracking_grid->VATApplied->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_VATApplied" class="custom-control-input" value="<?php echo $ipc_tracking_grid->VATApplied->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->VATApplied->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_VATApplied"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_VATApplied" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied" value="<?php echo HtmlEncode($ipc_tracking_grid->VATApplied->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_VATApplied" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_VATApplied[]" value="<?php echo HtmlEncode($ipc_tracking_grid->VATApplied->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
		<td data-name="ArithmeticCheckDone">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_ArithmeticCheckDone" class="form-group ipc_tracking_ArithmeticCheckDone">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->ArithmeticCheckDone->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]_242299" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->ArithmeticCheckDone->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]_242299"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_ArithmeticCheckDone" class="form-group ipc_tracking_ArithmeticCheckDone">
<span<?php echo $ipc_tracking_grid->ArithmeticCheckDone->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ArithmeticCheckDone" class="custom-control-input" value="<?php echo $ipc_tracking_grid->ArithmeticCheckDone->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->ArithmeticCheckDone->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ArithmeticCheckDone"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone" value="<?php echo HtmlEncode($ipc_tracking_grid->ArithmeticCheckDone->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ArithmeticCheckDone[]" value="<?php echo HtmlEncode($ipc_tracking_grid->ArithmeticCheckDone->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->VariationsApproved->Visible) { // VariationsApproved ?>
		<td data-name="VariationsApproved">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_VariationsApproved" class="form-group ipc_tracking_VariationsApproved">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->VariationsApproved->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_VariationsApproved" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]_950961" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->VariationsApproved->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]_950961"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_VariationsApproved" class="form-group ipc_tracking_VariationsApproved">
<span<?php echo $ipc_tracking_grid->VariationsApproved->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_VariationsApproved" class="custom-control-input" value="<?php echo $ipc_tracking_grid->VariationsApproved->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->VariationsApproved->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_VariationsApproved"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_VariationsApproved" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved" value="<?php echo HtmlEncode($ipc_tracking_grid->VariationsApproved->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_VariationsApproved" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_VariationsApproved[]" value="<?php echo HtmlEncode($ipc_tracking_grid->VariationsApproved->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
		<td data-name="PerformanceBondValidUntil">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_PerformanceBondValidUntil" class="form-group ipc_tracking_PerformanceBondValidUntil">
<input type="text" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->PerformanceBondValidUntil->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->PerformanceBondValidUntil->EditValue ?>"<?php echo $ipc_tracking_grid->PerformanceBondValidUntil->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->PerformanceBondValidUntil->ReadOnly && !$ipc_tracking_grid->PerformanceBondValidUntil->Disabled && !isset($ipc_tracking_grid->PerformanceBondValidUntil->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->PerformanceBondValidUntil->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_PerformanceBondValidUntil" class="form-group ipc_tracking_PerformanceBondValidUntil">
<span<?php echo $ipc_tracking_grid->PerformanceBondValidUntil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->PerformanceBondValidUntil->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->PerformanceBondValidUntil->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_PerformanceBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->PerformanceBondValidUntil->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
		<td data-name="AdvancePaymentBondValidUntil">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_AdvancePaymentBondValidUntil" class="form-group ipc_tracking_AdvancePaymentBondValidUntil">
<input type="text" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->AdvancePaymentBondValidUntil->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->EditValue ?>"<?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->AdvancePaymentBondValidUntil->ReadOnly && !$ipc_tracking_grid->AdvancePaymentBondValidUntil->Disabled && !isset($ipc_tracking_grid->AdvancePaymentBondValidUntil->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->AdvancePaymentBondValidUntil->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_AdvancePaymentBondValidUntil" class="form-group ipc_tracking_AdvancePaymentBondValidUntil">
<span<?php echo $ipc_tracking_grid->AdvancePaymentBondValidUntil->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->AdvancePaymentBondValidUntil->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancePaymentBondValidUntil->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancePaymentBondValidUntil" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancePaymentBondValidUntil->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
		<td data-name="RetentionDeductionClause">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_RetentionDeductionClause" class="form-group ipc_tracking_RetentionDeductionClause">
<input type="text" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeductionClause->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->RetentionDeductionClause->EditValue ?>"<?php echo $ipc_tracking_grid->RetentionDeductionClause->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_RetentionDeductionClause" class="form-group ipc_tracking_RetentionDeductionClause">
<span<?php echo $ipc_tracking_grid->RetentionDeductionClause->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->RetentionDeductionClause->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeductionClause->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeductionClause" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeductionClause->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->RetentionDeducted->Visible) { // RetentionDeducted ?>
		<td data-name="RetentionDeducted">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_RetentionDeducted" class="form-group ipc_tracking_RetentionDeducted">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->RetentionDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]_744482" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->RetentionDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]_744482"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_RetentionDeducted" class="form-group ipc_tracking_RetentionDeducted">
<span<?php echo $ipc_tracking_grid->RetentionDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_RetentionDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_grid->RetentionDeducted->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->RetentionDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_RetentionDeducted"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeducted->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_RetentionDeducted[]" value="<?php echo HtmlEncode($ipc_tracking_grid->RetentionDeducted->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
		<td data-name="LiquidatedDamagesDeducted">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_LiquidatedDamagesDeducted" class="form-group ipc_tracking_LiquidatedDamagesDeducted">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->LiquidatedDamagesDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]_206234" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]_206234"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_LiquidatedDamagesDeducted" class="form-group ipc_tracking_LiquidatedDamagesDeducted">
<span<?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LiquidatedDamagesDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_grid->LiquidatedDamagesDeducted->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->LiquidatedDamagesDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LiquidatedDamagesDeducted"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted" value="<?php echo HtmlEncode($ipc_tracking_grid->LiquidatedDamagesDeducted->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_LiquidatedDamagesDeducted[]" value="<?php echo HtmlEncode($ipc_tracking_grid->LiquidatedDamagesDeducted->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
		<td data-name="AdvancedPaymentDeducted">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_AdvancedPaymentDeducted" class="form-group ipc_tracking_AdvancedPaymentDeducted">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->AdvancedPaymentDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]_607235" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]_607235"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_AdvancedPaymentDeducted" class="form-group ipc_tracking_AdvancedPaymentDeducted">
<span<?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_AdvancedPaymentDeducted" class="custom-control-input" value="<?php echo $ipc_tracking_grid->AdvancedPaymentDeducted->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->AdvancedPaymentDeducted->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_AdvancedPaymentDeducted"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancedPaymentDeducted->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_AdvancedPaymentDeducted[]" value="<?php echo HtmlEncode($ipc_tracking_grid->AdvancedPaymentDeducted->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
		<td data-name="CurrentProgressReportAttached">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_CurrentProgressReportAttached" class="form-group ipc_tracking_CurrentProgressReportAttached">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->CurrentProgressReportAttached->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]_321270" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->CurrentProgressReportAttached->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]_321270"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_CurrentProgressReportAttached" class="form-group ipc_tracking_CurrentProgressReportAttached">
<span<?php echo $ipc_tracking_grid->CurrentProgressReportAttached->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CurrentProgressReportAttached" class="custom-control-input" value="<?php echo $ipc_tracking_grid->CurrentProgressReportAttached->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->CurrentProgressReportAttached->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CurrentProgressReportAttached"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached" value="<?php echo HtmlEncode($ipc_tracking_grid->CurrentProgressReportAttached->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_CurrentProgressReportAttached[]" value="<?php echo HtmlEncode($ipc_tracking_grid->CurrentProgressReportAttached->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
		<td data-name="DateOfSiteInspection">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_DateOfSiteInspection" class="form-group ipc_tracking_DateOfSiteInspection">
<input type="text" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->DateOfSiteInspection->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->DateOfSiteInspection->EditValue ?>"<?php echo $ipc_tracking_grid->DateOfSiteInspection->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->DateOfSiteInspection->ReadOnly && !$ipc_tracking_grid->DateOfSiteInspection->Disabled && !isset($ipc_tracking_grid->DateOfSiteInspection->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->DateOfSiteInspection->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_DateOfSiteInspection" class="form-group ipc_tracking_DateOfSiteInspection">
<span<?php echo $ipc_tracking_grid->DateOfSiteInspection->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->DateOfSiteInspection->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" value="<?php echo HtmlEncode($ipc_tracking_grid->DateOfSiteInspection->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_DateOfSiteInspection" value="<?php echo HtmlEncode($ipc_tracking_grid->DateOfSiteInspection->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
		<td data-name="TimeExtensionAuthorized">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_TimeExtensionAuthorized" class="form-group ipc_tracking_TimeExtensionAuthorized">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->TimeExtensionAuthorized->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]_623854" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->TimeExtensionAuthorized->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]_623854"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_TimeExtensionAuthorized" class="form-group ipc_tracking_TimeExtensionAuthorized">
<span<?php echo $ipc_tracking_grid->TimeExtensionAuthorized->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TimeExtensionAuthorized" class="custom-control-input" value="<?php echo $ipc_tracking_grid->TimeExtensionAuthorized->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->TimeExtensionAuthorized->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TimeExtensionAuthorized"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized" value="<?php echo HtmlEncode($ipc_tracking_grid->TimeExtensionAuthorized->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_TimeExtensionAuthorized[]" value="<?php echo HtmlEncode($ipc_tracking_grid->TimeExtensionAuthorized->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->LabResultsChecked->Visible) { // LabResultsChecked ?>
		<td data-name="LabResultsChecked">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_LabResultsChecked" class="form-group ipc_tracking_LabResultsChecked">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->LabResultsChecked->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]_398994" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->LabResultsChecked->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]_398994"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_LabResultsChecked" class="form-group ipc_tracking_LabResultsChecked">
<span<?php echo $ipc_tracking_grid->LabResultsChecked->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_LabResultsChecked" class="custom-control-input" value="<?php echo $ipc_tracking_grid->LabResultsChecked->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->LabResultsChecked->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_LabResultsChecked"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked" value="<?php echo HtmlEncode($ipc_tracking_grid->LabResultsChecked->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_LabResultsChecked[]" value="<?php echo HtmlEncode($ipc_tracking_grid->LabResultsChecked->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
		<td data-name="TerminationNoticeGiven">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_TerminationNoticeGiven" class="form-group ipc_tracking_TerminationNoticeGiven">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->TerminationNoticeGiven->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]_607933" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->TerminationNoticeGiven->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]_607933"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_TerminationNoticeGiven" class="form-group ipc_tracking_TerminationNoticeGiven">
<span<?php echo $ipc_tracking_grid->TerminationNoticeGiven->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_TerminationNoticeGiven" class="custom-control-input" value="<?php echo $ipc_tracking_grid->TerminationNoticeGiven->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->TerminationNoticeGiven->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_TerminationNoticeGiven"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven" value="<?php echo HtmlEncode($ipc_tracking_grid->TerminationNoticeGiven->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_TerminationNoticeGiven[]" value="<?php echo HtmlEncode($ipc_tracking_grid->TerminationNoticeGiven->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
		<td data-name="CopiesEmailedToMLG">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_CopiesEmailedToMLG" class="form-group ipc_tracking_CopiesEmailedToMLG">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->CopiesEmailedToMLG->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]_458092" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->CopiesEmailedToMLG->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]_458092"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_CopiesEmailedToMLG" class="form-group ipc_tracking_CopiesEmailedToMLG">
<span<?php echo $ipc_tracking_grid->CopiesEmailedToMLG->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_CopiesEmailedToMLG" class="custom-control-input" value="<?php echo $ipc_tracking_grid->CopiesEmailedToMLG->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->CopiesEmailedToMLG->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_CopiesEmailedToMLG"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG" value="<?php echo HtmlEncode($ipc_tracking_grid->CopiesEmailedToMLG->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_CopiesEmailedToMLG[]" value="<?php echo HtmlEncode($ipc_tracking_grid->CopiesEmailedToMLG->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->ContractStillValid->Visible) { // ContractStillValid ?>
		<td data-name="ContractStillValid">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_ContractStillValid" class="form-group ipc_tracking_ContractStillValid">
<?php
$selwrk = ConvertToBool($ipc_tracking_grid->ContractStillValid->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ContractStillValid" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]_246216" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_grid->ContractStillValid->editAttributes() ?>>
	<label class="custom-control-label" for="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]_246216"></label>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_ContractStillValid" class="form-group ipc_tracking_ContractStillValid">
<span<?php echo $ipc_tracking_grid->ContractStillValid->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ContractStillValid" class="custom-control-input" value="<?php echo $ipc_tracking_grid->ContractStillValid->ViewValue ?>" disabled<?php if (ConvertToBool($ipc_tracking_grid->ContractStillValid->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ContractStillValid"></label></div></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractStillValid" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractStillValid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractStillValid" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractStillValid[]" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractStillValid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->DeskOfficer->Visible) { // DeskOfficer ?>
		<td data-name="DeskOfficer">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_DeskOfficer" class="form-group ipc_tracking_DeskOfficer">
<input type="text" data-table="ipc_tracking" data-field="x_DeskOfficer" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficer->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->DeskOfficer->EditValue ?>"<?php echo $ipc_tracking_grid->DeskOfficer->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_DeskOfficer" class="form-group ipc_tracking_DeskOfficer">
<span<?php echo $ipc_tracking_grid->DeskOfficer->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->DeskOfficer->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficer" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficer->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficer" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficer" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
		<td data-name="DeskOfficerDate">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_DeskOfficerDate" class="form-group ipc_tracking_DeskOfficerDate">
<input type="text" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficerDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->DeskOfficerDate->EditValue ?>"<?php echo $ipc_tracking_grid->DeskOfficerDate->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->DeskOfficerDate->ReadOnly && !$ipc_tracking_grid->DeskOfficerDate->Disabled && !isset($ipc_tracking_grid->DeskOfficerDate->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->DeskOfficerDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_DeskOfficerDate" class="form-group ipc_tracking_DeskOfficerDate">
<span<?php echo $ipc_tracking_grid->DeskOfficerDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->DeskOfficerDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficerDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_DeskOfficerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->DeskOfficerDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
		<td data-name="SupervisingEngineer">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_SupervisingEngineer" class="form-group ipc_tracking_SupervisingEngineer">
<input type="text" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->SupervisingEngineer->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->SupervisingEngineer->EditValue ?>"<?php echo $ipc_tracking_grid->SupervisingEngineer->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_SupervisingEngineer" class="form-group ipc_tracking_SupervisingEngineer">
<span<?php echo $ipc_tracking_grid->SupervisingEngineer->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->SupervisingEngineer->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" value="<?php echo HtmlEncode($ipc_tracking_grid->SupervisingEngineer->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_SupervisingEngineer" value="<?php echo HtmlEncode($ipc_tracking_grid->SupervisingEngineer->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->EngineerDate->Visible) { // EngineerDate ?>
		<td data-name="EngineerDate">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_EngineerDate" class="form-group ipc_tracking_EngineerDate">
<input type="text" data-table="ipc_tracking" data-field="x_EngineerDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->EngineerDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->EngineerDate->EditValue ?>"<?php echo $ipc_tracking_grid->EngineerDate->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->EngineerDate->ReadOnly && !$ipc_tracking_grid->EngineerDate->Disabled && !isset($ipc_tracking_grid->EngineerDate->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->EngineerDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_EngineerDate" class="form-group ipc_tracking_EngineerDate">
<span<?php echo $ipc_tracking_grid->EngineerDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->EngineerDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_EngineerDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->EngineerDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_EngineerDate" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_EngineerDate" value="<?php echo HtmlEncode($ipc_tracking_grid->EngineerDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->CouncilSecretary->Visible) { // CouncilSecretary ?>
		<td data-name="CouncilSecretary">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_CouncilSecretary" class="form-group ipc_tracking_CouncilSecretary">
<input type="text" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->CouncilSecretary->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->CouncilSecretary->EditValue ?>"<?php echo $ipc_tracking_grid->CouncilSecretary->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_CouncilSecretary" class="form-group ipc_tracking_CouncilSecretary">
<span<?php echo $ipc_tracking_grid->CouncilSecretary->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->CouncilSecretary->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" value="<?php echo HtmlEncode($ipc_tracking_grid->CouncilSecretary->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_CouncilSecretary" value="<?php echo HtmlEncode($ipc_tracking_grid->CouncilSecretary->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->CSDate->Visible) { // CSDate ?>
		<td data-name="CSDate">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_CSDate" class="form-group ipc_tracking_CSDate">
<input type="text" data-table="ipc_tracking" data-field="x_CSDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->CSDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->CSDate->EditValue ?>"<?php echo $ipc_tracking_grid->CSDate->editAttributes() ?>>
<?php if (!$ipc_tracking_grid->CSDate->ReadOnly && !$ipc_tracking_grid->CSDate->Disabled && !isset($ipc_tracking_grid->CSDate->EditAttrs["readonly"]) && !isset($ipc_tracking_grid->CSDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackinggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackinggrid", "x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_CSDate" class="form-group ipc_tracking_CSDate">
<span<?php echo $ipc_tracking_grid->CSDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->CSDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_CSDate" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" value="<?php echo HtmlEncode($ipc_tracking_grid->CSDate->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_CSDate" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_CSDate" value="<?php echo HtmlEncode($ipc_tracking_grid->CSDate->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($ipc_tracking_grid->ContractType->Visible) { // ContractType ?>
		<td data-name="ContractType">
<?php if (!$ipc_tracking->isConfirm()) { ?>
<span id="el$rowindex$_ipc_tracking_ContractType" class="form-group ipc_tracking_ContractType">
<input type="text" data-table="ipc_tracking" data-field="x_ContractType" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($ipc_tracking_grid->ContractType->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_grid->ContractType->EditValue ?>"<?php echo $ipc_tracking_grid->ContractType->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_ipc_tracking_ContractType" class="form-group ipc_tracking_ContractType">
<span<?php echo $ipc_tracking_grid->ContractType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_grid->ContractType->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractType" name="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" id="x<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractType->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="ipc_tracking" data-field="x_ContractType" name="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" id="o<?php echo $ipc_tracking_grid->RowIndex ?>_ContractType" value="<?php echo HtmlEncode($ipc_tracking_grid->ContractType->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ipc_tracking_grid->ListOptions->render("body", "right", $ipc_tracking_grid->RowIndex);
?>
<script>
loadjs.ready(["fipc_trackinggrid", "load"], function() {
	fipc_trackinggrid.updateLists(<?php echo $ipc_tracking_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($ipc_tracking->CurrentMode == "add" || $ipc_tracking->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $ipc_tracking_grid->FormKeyCountName ?>" id="<?php echo $ipc_tracking_grid->FormKeyCountName ?>" value="<?php echo $ipc_tracking_grid->KeyCount ?>">
<?php echo $ipc_tracking_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ipc_tracking->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $ipc_tracking_grid->FormKeyCountName ?>" id="<?php echo $ipc_tracking_grid->FormKeyCountName ?>" value="<?php echo $ipc_tracking_grid->KeyCount ?>">
<?php echo $ipc_tracking_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($ipc_tracking->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fipc_trackinggrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ipc_tracking_grid->Recordset)
	$ipc_tracking_grid->Recordset->Close();
?>
<?php if ($ipc_tracking_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $ipc_tracking_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ipc_tracking_grid->TotalRecords == 0 && !$ipc_tracking->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ipc_tracking_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$ipc_tracking_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$ipc_tracking_grid->terminate();
?>