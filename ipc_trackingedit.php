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
$ipc_tracking_edit = new ipc_tracking_edit();

// Run the page
$ipc_tracking_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ipc_tracking_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fipc_trackingedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fipc_trackingedit = currentForm = new ew.Form("fipc_trackingedit", "edit");

	// Validate form
	fipc_trackingedit.validate = function() {
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
			<?php if ($ipc_tracking_edit->IPCNo->Required) { ?>
				elm = this.getElements("x" + infix + "_IPCNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->IPCNo->caption(), $ipc_tracking_edit->IPCNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->ContractNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->ContractNo->caption(), $ipc_tracking_edit->ContractNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->ContractAuthorizedByAG->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractAuthorizedByAG[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->ContractAuthorizedByAG->caption(), $ipc_tracking_edit->ContractAuthorizedByAG->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->VATApplied->Required) { ?>
				elm = this.getElements("x" + infix + "_VATApplied[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->VATApplied->caption(), $ipc_tracking_edit->VATApplied->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->ArithmeticCheckDone->Required) { ?>
				elm = this.getElements("x" + infix + "_ArithmeticCheckDone[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->ArithmeticCheckDone->caption(), $ipc_tracking_edit->ArithmeticCheckDone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->VariationsApproved->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationsApproved[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->VariationsApproved->caption(), $ipc_tracking_edit->VariationsApproved->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->PerformanceBondValidUntil->Required) { ?>
				elm = this.getElements("x" + infix + "_PerformanceBondValidUntil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->PerformanceBondValidUntil->caption(), $ipc_tracking_edit->PerformanceBondValidUntil->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PerformanceBondValidUntil");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_edit->PerformanceBondValidUntil->errorMessage()) ?>");
			<?php if ($ipc_tracking_edit->AdvancePaymentBondValidUntil->Required) { ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentBondValidUntil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->AdvancePaymentBondValidUntil->caption(), $ipc_tracking_edit->AdvancePaymentBondValidUntil->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentBondValidUntil");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_edit->AdvancePaymentBondValidUntil->errorMessage()) ?>");
			<?php if ($ipc_tracking_edit->RetentionDeductionClause->Required) { ?>
				elm = this.getElements("x" + infix + "_RetentionDeductionClause");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->RetentionDeductionClause->caption(), $ipc_tracking_edit->RetentionDeductionClause->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->RetentionDeducted->Required) { ?>
				elm = this.getElements("x" + infix + "_RetentionDeducted[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->RetentionDeducted->caption(), $ipc_tracking_edit->RetentionDeducted->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->LiquidatedDamagesDeducted->Required) { ?>
				elm = this.getElements("x" + infix + "_LiquidatedDamagesDeducted[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->LiquidatedDamagesDeducted->caption(), $ipc_tracking_edit->LiquidatedDamagesDeducted->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->LiquidatedPenaltiesDeducted->Required) { ?>
				elm = this.getElements("x" + infix + "_LiquidatedPenaltiesDeducted[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->LiquidatedPenaltiesDeducted->caption(), $ipc_tracking_edit->LiquidatedPenaltiesDeducted->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->AdvancedPaymentDeducted->Required) { ?>
				elm = this.getElements("x" + infix + "_AdvancedPaymentDeducted[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->AdvancedPaymentDeducted->caption(), $ipc_tracking_edit->AdvancedPaymentDeducted->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->CurrentProgressReportAttached->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentProgressReportAttached[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->CurrentProgressReportAttached->caption(), $ipc_tracking_edit->CurrentProgressReportAttached->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->CurrentProgressReport->Required) { ?>
				felm = this.getElements("x" + infix + "_CurrentProgressReport");
				elm = this.getElements("fn_x" + infix + "_CurrentProgressReport");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->CurrentProgressReport->caption(), $ipc_tracking_edit->CurrentProgressReport->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->DateOfSiteInspection->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfSiteInspection");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->DateOfSiteInspection->caption(), $ipc_tracking_edit->DateOfSiteInspection->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfSiteInspection");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_edit->DateOfSiteInspection->errorMessage()) ?>");
			<?php if ($ipc_tracking_edit->TimeExtensionAuthorized->Required) { ?>
				elm = this.getElements("x" + infix + "_TimeExtensionAuthorized[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->TimeExtensionAuthorized->caption(), $ipc_tracking_edit->TimeExtensionAuthorized->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->LabResultsChecked->Required) { ?>
				elm = this.getElements("x" + infix + "_LabResultsChecked[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->LabResultsChecked->caption(), $ipc_tracking_edit->LabResultsChecked->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->LabResults->Required) { ?>
				felm = this.getElements("x" + infix + "_LabResults");
				elm = this.getElements("fn_x" + infix + "_LabResults");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->LabResults->caption(), $ipc_tracking_edit->LabResults->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->TerminationNoticeGiven->Required) { ?>
				elm = this.getElements("x" + infix + "_TerminationNoticeGiven[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->TerminationNoticeGiven->caption(), $ipc_tracking_edit->TerminationNoticeGiven->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->CopiesEmailedToMLG->Required) { ?>
				elm = this.getElements("x" + infix + "_CopiesEmailedToMLG[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->CopiesEmailedToMLG->caption(), $ipc_tracking_edit->CopiesEmailedToMLG->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->ContractStillValid->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractStillValid[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->ContractStillValid->caption(), $ipc_tracking_edit->ContractStillValid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->DeskOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_DeskOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->DeskOfficer->caption(), $ipc_tracking_edit->DeskOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->DeskOfficerDate->Required) { ?>
				elm = this.getElements("x" + infix + "_DeskOfficerDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->DeskOfficerDate->caption(), $ipc_tracking_edit->DeskOfficerDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeskOfficerDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_edit->DeskOfficerDate->errorMessage()) ?>");
			<?php if ($ipc_tracking_edit->SupervisingEngineer->Required) { ?>
				elm = this.getElements("x" + infix + "_SupervisingEngineer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->SupervisingEngineer->caption(), $ipc_tracking_edit->SupervisingEngineer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->EngineerDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EngineerDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->EngineerDate->caption(), $ipc_tracking_edit->EngineerDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EngineerDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_edit->EngineerDate->errorMessage()) ?>");
			<?php if ($ipc_tracking_edit->CouncilSecretary->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilSecretary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->CouncilSecretary->caption(), $ipc_tracking_edit->CouncilSecretary->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->CSDate->Required) { ?>
				elm = this.getElements("x" + infix + "_CSDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->CSDate->caption(), $ipc_tracking_edit->CSDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CSDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_edit->CSDate->errorMessage()) ?>");
			<?php if ($ipc_tracking_edit->MLGComments->Required) { ?>
				elm = this.getElements("x" + infix + "_MLGComments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->MLGComments->caption(), $ipc_tracking_edit->MLGComments->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_edit->ContractType->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_edit->ContractType->caption(), $ipc_tracking_edit->ContractType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ContractType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_edit->ContractType->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fipc_trackingedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fipc_trackingedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fipc_trackingedit.lists["x_ContractAuthorizedByAG[]"] = <?php echo $ipc_tracking_edit->ContractAuthorizedByAG->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_ContractAuthorizedByAG[]"].options = <?php echo JsonEncode($ipc_tracking_edit->ContractAuthorizedByAG->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_VATApplied[]"] = <?php echo $ipc_tracking_edit->VATApplied->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_VATApplied[]"].options = <?php echo JsonEncode($ipc_tracking_edit->VATApplied->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_ArithmeticCheckDone[]"] = <?php echo $ipc_tracking_edit->ArithmeticCheckDone->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_ArithmeticCheckDone[]"].options = <?php echo JsonEncode($ipc_tracking_edit->ArithmeticCheckDone->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_VariationsApproved[]"] = <?php echo $ipc_tracking_edit->VariationsApproved->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_VariationsApproved[]"].options = <?php echo JsonEncode($ipc_tracking_edit->VariationsApproved->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_RetentionDeducted[]"] = <?php echo $ipc_tracking_edit->RetentionDeducted->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_RetentionDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_edit->RetentionDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_LiquidatedDamagesDeducted[]"] = <?php echo $ipc_tracking_edit->LiquidatedDamagesDeducted->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_LiquidatedDamagesDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_edit->LiquidatedDamagesDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_LiquidatedPenaltiesDeducted[]"] = <?php echo $ipc_tracking_edit->LiquidatedPenaltiesDeducted->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_LiquidatedPenaltiesDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_edit->LiquidatedPenaltiesDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_AdvancedPaymentDeducted[]"] = <?php echo $ipc_tracking_edit->AdvancedPaymentDeducted->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_AdvancedPaymentDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_edit->AdvancedPaymentDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_CurrentProgressReportAttached[]"] = <?php echo $ipc_tracking_edit->CurrentProgressReportAttached->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_CurrentProgressReportAttached[]"].options = <?php echo JsonEncode($ipc_tracking_edit->CurrentProgressReportAttached->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_TimeExtensionAuthorized[]"] = <?php echo $ipc_tracking_edit->TimeExtensionAuthorized->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_TimeExtensionAuthorized[]"].options = <?php echo JsonEncode($ipc_tracking_edit->TimeExtensionAuthorized->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_LabResultsChecked[]"] = <?php echo $ipc_tracking_edit->LabResultsChecked->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_LabResultsChecked[]"].options = <?php echo JsonEncode($ipc_tracking_edit->LabResultsChecked->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_TerminationNoticeGiven[]"] = <?php echo $ipc_tracking_edit->TerminationNoticeGiven->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_TerminationNoticeGiven[]"].options = <?php echo JsonEncode($ipc_tracking_edit->TerminationNoticeGiven->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_CopiesEmailedToMLG[]"] = <?php echo $ipc_tracking_edit->CopiesEmailedToMLG->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_CopiesEmailedToMLG[]"].options = <?php echo JsonEncode($ipc_tracking_edit->CopiesEmailedToMLG->options(FALSE, TRUE)) ?>;
	fipc_trackingedit.lists["x_ContractStillValid[]"] = <?php echo $ipc_tracking_edit->ContractStillValid->Lookup->toClientList($ipc_tracking_edit) ?>;
	fipc_trackingedit.lists["x_ContractStillValid[]"].options = <?php echo JsonEncode($ipc_tracking_edit->ContractStillValid->options(FALSE, TRUE)) ?>;
	loadjs.done("fipc_trackingedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ipc_tracking_edit->showPageHeader(); ?>
<?php
$ipc_tracking_edit->showMessage();
?>
<?php if (!$ipc_tracking_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ipc_tracking_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fipc_trackingedit" id="fipc_trackingedit" class="<?php echo $ipc_tracking_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ipc_tracking">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ipc_tracking_edit->IsModal ?>">
<?php if ($ipc_tracking->getCurrentMasterTable() == "contract") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="contract">
<input type="hidden" name="fk_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_edit->ContractNo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($ipc_tracking_edit->IPCNo->Visible) { // IPCNo ?>
	<div id="r_IPCNo" class="form-group row">
		<label id="elh_ipc_tracking_IPCNo" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->IPCNo->caption() ?><?php echo $ipc_tracking_edit->IPCNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->IPCNo->cellAttributes() ?>>
<span id="el_ipc_tracking_IPCNo">
<span<?php echo $ipc_tracking_edit->IPCNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_edit->IPCNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ipc_tracking" data-field="x_IPCNo" name="x_IPCNo" id="x_IPCNo" value="<?php echo HtmlEncode($ipc_tracking_edit->IPCNo->CurrentValue) ?>">
<?php echo $ipc_tracking_edit->IPCNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->ContractNo->Visible) { // ContractNo ?>
	<div id="r_ContractNo" class="form-group row">
		<label id="elh_ipc_tracking_ContractNo" for="x_ContractNo" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->ContractNo->caption() ?><?php echo $ipc_tracking_edit->ContractNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->ContractNo->cellAttributes() ?>>
<?php if ($ipc_tracking_edit->ContractNo->getSessionValue() != "") { ?>
<span id="el_ipc_tracking_ContractNo">
<span<?php echo $ipc_tracking_edit->ContractNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_edit->ContractNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ContractNo" name="x_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_edit->ContractNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ipc_tracking_ContractNo">
<input type="text" data-table="ipc_tracking" data-field="x_ContractNo" name="x_ContractNo" id="x_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->ContractNo->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_edit->ContractNo->EditValue ?>"<?php echo $ipc_tracking_edit->ContractNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $ipc_tracking_edit->ContractNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
	<div id="r_ContractAuthorizedByAG" class="form-group row">
		<label id="elh_ipc_tracking_ContractAuthorizedByAG" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->ContractAuthorizedByAG->caption() ?><?php echo $ipc_tracking_edit->ContractAuthorizedByAG->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->ContractAuthorizedByAG->cellAttributes() ?>>
<span id="el_ipc_tracking_ContractAuthorizedByAG">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->ContractAuthorizedByAG->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="x_ContractAuthorizedByAG[]" id="x_ContractAuthorizedByAG[]_210589" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->ContractAuthorizedByAG->editAttributes() ?>>
	<label class="custom-control-label" for="x_ContractAuthorizedByAG[]_210589"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->ContractAuthorizedByAG->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->VATApplied->Visible) { // VATApplied ?>
	<div id="r_VATApplied" class="form-group row">
		<label id="elh_ipc_tracking_VATApplied" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->VATApplied->caption() ?><?php echo $ipc_tracking_edit->VATApplied->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->VATApplied->cellAttributes() ?>>
<span id="el_ipc_tracking_VATApplied">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->VATApplied->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_VATApplied" name="x_VATApplied[]" id="x_VATApplied[]_144547" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->VATApplied->editAttributes() ?>>
	<label class="custom-control-label" for="x_VATApplied[]_144547"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->VATApplied->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
	<div id="r_ArithmeticCheckDone" class="form-group row">
		<label id="elh_ipc_tracking_ArithmeticCheckDone" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->ArithmeticCheckDone->caption() ?><?php echo $ipc_tracking_edit->ArithmeticCheckDone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->ArithmeticCheckDone->cellAttributes() ?>>
<span id="el_ipc_tracking_ArithmeticCheckDone">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->ArithmeticCheckDone->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="x_ArithmeticCheckDone[]" id="x_ArithmeticCheckDone[]_619535" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->ArithmeticCheckDone->editAttributes() ?>>
	<label class="custom-control-label" for="x_ArithmeticCheckDone[]_619535"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->ArithmeticCheckDone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->VariationsApproved->Visible) { // VariationsApproved ?>
	<div id="r_VariationsApproved" class="form-group row">
		<label id="elh_ipc_tracking_VariationsApproved" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->VariationsApproved->caption() ?><?php echo $ipc_tracking_edit->VariationsApproved->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->VariationsApproved->cellAttributes() ?>>
<span id="el_ipc_tracking_VariationsApproved">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->VariationsApproved->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_VariationsApproved" name="x_VariationsApproved[]" id="x_VariationsApproved[]_589002" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->VariationsApproved->editAttributes() ?>>
	<label class="custom-control-label" for="x_VariationsApproved[]_589002"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->VariationsApproved->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
	<div id="r_PerformanceBondValidUntil" class="form-group row">
		<label id="elh_ipc_tracking_PerformanceBondValidUntil" for="x_PerformanceBondValidUntil" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->PerformanceBondValidUntil->caption() ?><?php echo $ipc_tracking_edit->PerformanceBondValidUntil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->PerformanceBondValidUntil->cellAttributes() ?>>
<span id="el_ipc_tracking_PerformanceBondValidUntil">
<input type="text" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="x_PerformanceBondValidUntil" id="x_PerformanceBondValidUntil" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->PerformanceBondValidUntil->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_edit->PerformanceBondValidUntil->EditValue ?>"<?php echo $ipc_tracking_edit->PerformanceBondValidUntil->editAttributes() ?>>
<?php if (!$ipc_tracking_edit->PerformanceBondValidUntil->ReadOnly && !$ipc_tracking_edit->PerformanceBondValidUntil->Disabled && !isset($ipc_tracking_edit->PerformanceBondValidUntil->EditAttrs["readonly"]) && !isset($ipc_tracking_edit->PerformanceBondValidUntil->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingedit", "x_PerformanceBondValidUntil", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ipc_tracking_edit->PerformanceBondValidUntil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
	<div id="r_AdvancePaymentBondValidUntil" class="form-group row">
		<label id="elh_ipc_tracking_AdvancePaymentBondValidUntil" for="x_AdvancePaymentBondValidUntil" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->AdvancePaymentBondValidUntil->caption() ?><?php echo $ipc_tracking_edit->AdvancePaymentBondValidUntil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->AdvancePaymentBondValidUntil->cellAttributes() ?>>
<span id="el_ipc_tracking_AdvancePaymentBondValidUntil">
<input type="text" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="x_AdvancePaymentBondValidUntil" id="x_AdvancePaymentBondValidUntil" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->AdvancePaymentBondValidUntil->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_edit->AdvancePaymentBondValidUntil->EditValue ?>"<?php echo $ipc_tracking_edit->AdvancePaymentBondValidUntil->editAttributes() ?>>
<?php if (!$ipc_tracking_edit->AdvancePaymentBondValidUntil->ReadOnly && !$ipc_tracking_edit->AdvancePaymentBondValidUntil->Disabled && !isset($ipc_tracking_edit->AdvancePaymentBondValidUntil->EditAttrs["readonly"]) && !isset($ipc_tracking_edit->AdvancePaymentBondValidUntil->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingedit", "x_AdvancePaymentBondValidUntil", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ipc_tracking_edit->AdvancePaymentBondValidUntil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
	<div id="r_RetentionDeductionClause" class="form-group row">
		<label id="elh_ipc_tracking_RetentionDeductionClause" for="x_RetentionDeductionClause" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->RetentionDeductionClause->caption() ?><?php echo $ipc_tracking_edit->RetentionDeductionClause->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->RetentionDeductionClause->cellAttributes() ?>>
<span id="el_ipc_tracking_RetentionDeductionClause">
<input type="text" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="x_RetentionDeductionClause" id="x_RetentionDeductionClause" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->RetentionDeductionClause->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_edit->RetentionDeductionClause->EditValue ?>"<?php echo $ipc_tracking_edit->RetentionDeductionClause->editAttributes() ?>>
</span>
<?php echo $ipc_tracking_edit->RetentionDeductionClause->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->RetentionDeducted->Visible) { // RetentionDeducted ?>
	<div id="r_RetentionDeducted" class="form-group row">
		<label id="elh_ipc_tracking_RetentionDeducted" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->RetentionDeducted->caption() ?><?php echo $ipc_tracking_edit->RetentionDeducted->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->RetentionDeducted->cellAttributes() ?>>
<span id="el_ipc_tracking_RetentionDeducted">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->RetentionDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="x_RetentionDeducted[]" id="x_RetentionDeducted[]_590169" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->RetentionDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x_RetentionDeducted[]_590169"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->RetentionDeducted->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
	<div id="r_LiquidatedDamagesDeducted" class="form-group row">
		<label id="elh_ipc_tracking_LiquidatedDamagesDeducted" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->LiquidatedDamagesDeducted->caption() ?><?php echo $ipc_tracking_edit->LiquidatedDamagesDeducted->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->LiquidatedDamagesDeducted->cellAttributes() ?>>
<span id="el_ipc_tracking_LiquidatedDamagesDeducted">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->LiquidatedDamagesDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="x_LiquidatedDamagesDeducted[]" id="x_LiquidatedDamagesDeducted[]_396285" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->LiquidatedDamagesDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x_LiquidatedDamagesDeducted[]_396285"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->LiquidatedDamagesDeducted->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->LiquidatedPenaltiesDeducted->Visible) { // LiquidatedPenaltiesDeducted ?>
	<div id="r_LiquidatedPenaltiesDeducted" class="form-group row">
		<label id="elh_ipc_tracking_LiquidatedPenaltiesDeducted" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->LiquidatedPenaltiesDeducted->caption() ?><?php echo $ipc_tracking_edit->LiquidatedPenaltiesDeducted->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->LiquidatedPenaltiesDeducted->cellAttributes() ?>>
<span id="el_ipc_tracking_LiquidatedPenaltiesDeducted">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->LiquidatedPenaltiesDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LiquidatedPenaltiesDeducted" name="x_LiquidatedPenaltiesDeducted[]" id="x_LiquidatedPenaltiesDeducted[]_620477" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->LiquidatedPenaltiesDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x_LiquidatedPenaltiesDeducted[]_620477"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->LiquidatedPenaltiesDeducted->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
	<div id="r_AdvancedPaymentDeducted" class="form-group row">
		<label id="elh_ipc_tracking_AdvancedPaymentDeducted" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->AdvancedPaymentDeducted->caption() ?><?php echo $ipc_tracking_edit->AdvancedPaymentDeducted->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->AdvancedPaymentDeducted->cellAttributes() ?>>
<span id="el_ipc_tracking_AdvancedPaymentDeducted">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->AdvancedPaymentDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="x_AdvancedPaymentDeducted[]" id="x_AdvancedPaymentDeducted[]_367050" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->AdvancedPaymentDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x_AdvancedPaymentDeducted[]_367050"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->AdvancedPaymentDeducted->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
	<div id="r_CurrentProgressReportAttached" class="form-group row">
		<label id="elh_ipc_tracking_CurrentProgressReportAttached" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->CurrentProgressReportAttached->caption() ?><?php echo $ipc_tracking_edit->CurrentProgressReportAttached->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->CurrentProgressReportAttached->cellAttributes() ?>>
<span id="el_ipc_tracking_CurrentProgressReportAttached">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->CurrentProgressReportAttached->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="x_CurrentProgressReportAttached[]" id="x_CurrentProgressReportAttached[]_657262" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->CurrentProgressReportAttached->editAttributes() ?>>
	<label class="custom-control-label" for="x_CurrentProgressReportAttached[]_657262"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->CurrentProgressReportAttached->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->CurrentProgressReport->Visible) { // CurrentProgressReport ?>
	<div id="r_CurrentProgressReport" class="form-group row">
		<label id="elh_ipc_tracking_CurrentProgressReport" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->CurrentProgressReport->caption() ?><?php echo $ipc_tracking_edit->CurrentProgressReport->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->CurrentProgressReport->cellAttributes() ?>>
<span id="el_ipc_tracking_CurrentProgressReport">
<div id="fd_x_CurrentProgressReport">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $ipc_tracking_edit->CurrentProgressReport->title() ?>" data-table="ipc_tracking" data-field="x_CurrentProgressReport" name="x_CurrentProgressReport" id="x_CurrentProgressReport" lang="<?php echo CurrentLanguageID() ?>"<?php echo $ipc_tracking_edit->CurrentProgressReport->editAttributes() ?><?php if ($ipc_tracking_edit->CurrentProgressReport->ReadOnly || $ipc_tracking_edit->CurrentProgressReport->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_CurrentProgressReport"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_CurrentProgressReport" id= "fn_x_CurrentProgressReport" value="<?php echo $ipc_tracking_edit->CurrentProgressReport->Upload->FileName ?>">
<input type="hidden" name="fa_x_CurrentProgressReport" id= "fa_x_CurrentProgressReport" value="<?php echo (Post("fa_x_CurrentProgressReport") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_CurrentProgressReport" id= "fs_x_CurrentProgressReport" value="0">
<input type="hidden" name="fx_x_CurrentProgressReport" id= "fx_x_CurrentProgressReport" value="<?php echo $ipc_tracking_edit->CurrentProgressReport->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_CurrentProgressReport" id= "fm_x_CurrentProgressReport" value="<?php echo $ipc_tracking_edit->CurrentProgressReport->UploadMaxFileSize ?>">
</div>
<table id="ft_x_CurrentProgressReport" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $ipc_tracking_edit->CurrentProgressReport->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
	<div id="r_DateOfSiteInspection" class="form-group row">
		<label id="elh_ipc_tracking_DateOfSiteInspection" for="x_DateOfSiteInspection" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->DateOfSiteInspection->caption() ?><?php echo $ipc_tracking_edit->DateOfSiteInspection->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->DateOfSiteInspection->cellAttributes() ?>>
<span id="el_ipc_tracking_DateOfSiteInspection">
<input type="text" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="x_DateOfSiteInspection" id="x_DateOfSiteInspection" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->DateOfSiteInspection->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_edit->DateOfSiteInspection->EditValue ?>"<?php echo $ipc_tracking_edit->DateOfSiteInspection->editAttributes() ?>>
<?php if (!$ipc_tracking_edit->DateOfSiteInspection->ReadOnly && !$ipc_tracking_edit->DateOfSiteInspection->Disabled && !isset($ipc_tracking_edit->DateOfSiteInspection->EditAttrs["readonly"]) && !isset($ipc_tracking_edit->DateOfSiteInspection->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingedit", "x_DateOfSiteInspection", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ipc_tracking_edit->DateOfSiteInspection->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
	<div id="r_TimeExtensionAuthorized" class="form-group row">
		<label id="elh_ipc_tracking_TimeExtensionAuthorized" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->TimeExtensionAuthorized->caption() ?><?php echo $ipc_tracking_edit->TimeExtensionAuthorized->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->TimeExtensionAuthorized->cellAttributes() ?>>
<span id="el_ipc_tracking_TimeExtensionAuthorized">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->TimeExtensionAuthorized->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="x_TimeExtensionAuthorized[]" id="x_TimeExtensionAuthorized[]_839223" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->TimeExtensionAuthorized->editAttributes() ?>>
	<label class="custom-control-label" for="x_TimeExtensionAuthorized[]_839223"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->TimeExtensionAuthorized->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->LabResultsChecked->Visible) { // LabResultsChecked ?>
	<div id="r_LabResultsChecked" class="form-group row">
		<label id="elh_ipc_tracking_LabResultsChecked" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->LabResultsChecked->caption() ?><?php echo $ipc_tracking_edit->LabResultsChecked->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->LabResultsChecked->cellAttributes() ?>>
<span id="el_ipc_tracking_LabResultsChecked">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->LabResultsChecked->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="x_LabResultsChecked[]" id="x_LabResultsChecked[]_607370" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->LabResultsChecked->editAttributes() ?>>
	<label class="custom-control-label" for="x_LabResultsChecked[]_607370"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->LabResultsChecked->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->LabResults->Visible) { // LabResults ?>
	<div id="r_LabResults" class="form-group row">
		<label id="elh_ipc_tracking_LabResults" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->LabResults->caption() ?><?php echo $ipc_tracking_edit->LabResults->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->LabResults->cellAttributes() ?>>
<span id="el_ipc_tracking_LabResults">
<div id="fd_x_LabResults">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $ipc_tracking_edit->LabResults->title() ?>" data-table="ipc_tracking" data-field="x_LabResults" name="x_LabResults" id="x_LabResults" lang="<?php echo CurrentLanguageID() ?>"<?php echo $ipc_tracking_edit->LabResults->editAttributes() ?><?php if ($ipc_tracking_edit->LabResults->ReadOnly || $ipc_tracking_edit->LabResults->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_LabResults"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_LabResults" id= "fn_x_LabResults" value="<?php echo $ipc_tracking_edit->LabResults->Upload->FileName ?>">
<input type="hidden" name="fa_x_LabResults" id= "fa_x_LabResults" value="<?php echo (Post("fa_x_LabResults") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_LabResults" id= "fs_x_LabResults" value="0">
<input type="hidden" name="fx_x_LabResults" id= "fx_x_LabResults" value="<?php echo $ipc_tracking_edit->LabResults->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_LabResults" id= "fm_x_LabResults" value="<?php echo $ipc_tracking_edit->LabResults->UploadMaxFileSize ?>">
</div>
<table id="ft_x_LabResults" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $ipc_tracking_edit->LabResults->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
	<div id="r_TerminationNoticeGiven" class="form-group row">
		<label id="elh_ipc_tracking_TerminationNoticeGiven" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->TerminationNoticeGiven->caption() ?><?php echo $ipc_tracking_edit->TerminationNoticeGiven->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->TerminationNoticeGiven->cellAttributes() ?>>
<span id="el_ipc_tracking_TerminationNoticeGiven">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->TerminationNoticeGiven->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="x_TerminationNoticeGiven[]" id="x_TerminationNoticeGiven[]_870394" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->TerminationNoticeGiven->editAttributes() ?>>
	<label class="custom-control-label" for="x_TerminationNoticeGiven[]_870394"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->TerminationNoticeGiven->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
	<div id="r_CopiesEmailedToMLG" class="form-group row">
		<label id="elh_ipc_tracking_CopiesEmailedToMLG" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->CopiesEmailedToMLG->caption() ?><?php echo $ipc_tracking_edit->CopiesEmailedToMLG->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->CopiesEmailedToMLG->cellAttributes() ?>>
<span id="el_ipc_tracking_CopiesEmailedToMLG">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->CopiesEmailedToMLG->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="x_CopiesEmailedToMLG[]" id="x_CopiesEmailedToMLG[]_207382" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->CopiesEmailedToMLG->editAttributes() ?>>
	<label class="custom-control-label" for="x_CopiesEmailedToMLG[]_207382"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->CopiesEmailedToMLG->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->ContractStillValid->Visible) { // ContractStillValid ?>
	<div id="r_ContractStillValid" class="form-group row">
		<label id="elh_ipc_tracking_ContractStillValid" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->ContractStillValid->caption() ?><?php echo $ipc_tracking_edit->ContractStillValid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->ContractStillValid->cellAttributes() ?>>
<span id="el_ipc_tracking_ContractStillValid">
<?php
$selwrk = ConvertToBool($ipc_tracking_edit->ContractStillValid->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ContractStillValid" name="x_ContractStillValid[]" id="x_ContractStillValid[]_684197" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_edit->ContractStillValid->editAttributes() ?>>
	<label class="custom-control-label" for="x_ContractStillValid[]_684197"></label>
</div>
</span>
<?php echo $ipc_tracking_edit->ContractStillValid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->DeskOfficer->Visible) { // DeskOfficer ?>
	<div id="r_DeskOfficer" class="form-group row">
		<label id="elh_ipc_tracking_DeskOfficer" for="x_DeskOfficer" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->DeskOfficer->caption() ?><?php echo $ipc_tracking_edit->DeskOfficer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->DeskOfficer->cellAttributes() ?>>
<span id="el_ipc_tracking_DeskOfficer">
<input type="text" data-table="ipc_tracking" data-field="x_DeskOfficer" name="x_DeskOfficer" id="x_DeskOfficer" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->DeskOfficer->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_edit->DeskOfficer->EditValue ?>"<?php echo $ipc_tracking_edit->DeskOfficer->editAttributes() ?>>
</span>
<?php echo $ipc_tracking_edit->DeskOfficer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
	<div id="r_DeskOfficerDate" class="form-group row">
		<label id="elh_ipc_tracking_DeskOfficerDate" for="x_DeskOfficerDate" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->DeskOfficerDate->caption() ?><?php echo $ipc_tracking_edit->DeskOfficerDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->DeskOfficerDate->cellAttributes() ?>>
<span id="el_ipc_tracking_DeskOfficerDate">
<input type="text" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="x_DeskOfficerDate" id="x_DeskOfficerDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->DeskOfficerDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_edit->DeskOfficerDate->EditValue ?>"<?php echo $ipc_tracking_edit->DeskOfficerDate->editAttributes() ?>>
<?php if (!$ipc_tracking_edit->DeskOfficerDate->ReadOnly && !$ipc_tracking_edit->DeskOfficerDate->Disabled && !isset($ipc_tracking_edit->DeskOfficerDate->EditAttrs["readonly"]) && !isset($ipc_tracking_edit->DeskOfficerDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingedit", "x_DeskOfficerDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ipc_tracking_edit->DeskOfficerDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
	<div id="r_SupervisingEngineer" class="form-group row">
		<label id="elh_ipc_tracking_SupervisingEngineer" for="x_SupervisingEngineer" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->SupervisingEngineer->caption() ?><?php echo $ipc_tracking_edit->SupervisingEngineer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->SupervisingEngineer->cellAttributes() ?>>
<span id="el_ipc_tracking_SupervisingEngineer">
<input type="text" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="x_SupervisingEngineer" id="x_SupervisingEngineer" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->SupervisingEngineer->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_edit->SupervisingEngineer->EditValue ?>"<?php echo $ipc_tracking_edit->SupervisingEngineer->editAttributes() ?>>
</span>
<?php echo $ipc_tracking_edit->SupervisingEngineer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->EngineerDate->Visible) { // EngineerDate ?>
	<div id="r_EngineerDate" class="form-group row">
		<label id="elh_ipc_tracking_EngineerDate" for="x_EngineerDate" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->EngineerDate->caption() ?><?php echo $ipc_tracking_edit->EngineerDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->EngineerDate->cellAttributes() ?>>
<span id="el_ipc_tracking_EngineerDate">
<input type="text" data-table="ipc_tracking" data-field="x_EngineerDate" name="x_EngineerDate" id="x_EngineerDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->EngineerDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_edit->EngineerDate->EditValue ?>"<?php echo $ipc_tracking_edit->EngineerDate->editAttributes() ?>>
<?php if (!$ipc_tracking_edit->EngineerDate->ReadOnly && !$ipc_tracking_edit->EngineerDate->Disabled && !isset($ipc_tracking_edit->EngineerDate->EditAttrs["readonly"]) && !isset($ipc_tracking_edit->EngineerDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingedit", "x_EngineerDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ipc_tracking_edit->EngineerDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->CouncilSecretary->Visible) { // CouncilSecretary ?>
	<div id="r_CouncilSecretary" class="form-group row">
		<label id="elh_ipc_tracking_CouncilSecretary" for="x_CouncilSecretary" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->CouncilSecretary->caption() ?><?php echo $ipc_tracking_edit->CouncilSecretary->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->CouncilSecretary->cellAttributes() ?>>
<span id="el_ipc_tracking_CouncilSecretary">
<input type="text" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="x_CouncilSecretary" id="x_CouncilSecretary" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->CouncilSecretary->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_edit->CouncilSecretary->EditValue ?>"<?php echo $ipc_tracking_edit->CouncilSecretary->editAttributes() ?>>
</span>
<?php echo $ipc_tracking_edit->CouncilSecretary->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->CSDate->Visible) { // CSDate ?>
	<div id="r_CSDate" class="form-group row">
		<label id="elh_ipc_tracking_CSDate" for="x_CSDate" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->CSDate->caption() ?><?php echo $ipc_tracking_edit->CSDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->CSDate->cellAttributes() ?>>
<span id="el_ipc_tracking_CSDate">
<input type="text" data-table="ipc_tracking" data-field="x_CSDate" name="x_CSDate" id="x_CSDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->CSDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_edit->CSDate->EditValue ?>"<?php echo $ipc_tracking_edit->CSDate->editAttributes() ?>>
<?php if (!$ipc_tracking_edit->CSDate->ReadOnly && !$ipc_tracking_edit->CSDate->Disabled && !isset($ipc_tracking_edit->CSDate->EditAttrs["readonly"]) && !isset($ipc_tracking_edit->CSDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingedit", "x_CSDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ipc_tracking_edit->CSDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->MLGComments->Visible) { // MLGComments ?>
	<div id="r_MLGComments" class="form-group row">
		<label id="elh_ipc_tracking_MLGComments" for="x_MLGComments" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->MLGComments->caption() ?><?php echo $ipc_tracking_edit->MLGComments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->MLGComments->cellAttributes() ?>>
<span id="el_ipc_tracking_MLGComments">
<textarea data-table="ipc_tracking" data-field="x_MLGComments" name="x_MLGComments" id="x_MLGComments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->MLGComments->getPlaceHolder()) ?>"<?php echo $ipc_tracking_edit->MLGComments->editAttributes() ?>><?php echo $ipc_tracking_edit->MLGComments->EditValue ?></textarea>
</span>
<?php echo $ipc_tracking_edit->MLGComments->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_edit->ContractType->Visible) { // ContractType ?>
	<div id="r_ContractType" class="form-group row">
		<label id="elh_ipc_tracking_ContractType" for="x_ContractType" class="<?php echo $ipc_tracking_edit->LeftColumnClass ?>"><?php echo $ipc_tracking_edit->ContractType->caption() ?><?php echo $ipc_tracking_edit->ContractType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_edit->RightColumnClass ?>"><div <?php echo $ipc_tracking_edit->ContractType->cellAttributes() ?>>
<span id="el_ipc_tracking_ContractType">
<input type="text" data-table="ipc_tracking" data-field="x_ContractType" name="x_ContractType" id="x_ContractType" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($ipc_tracking_edit->ContractType->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_edit->ContractType->EditValue ?>"<?php echo $ipc_tracking_edit->ContractType->editAttributes() ?>>
</span>
<?php echo $ipc_tracking_edit->ContractType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ipc_tracking_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ipc_tracking_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ipc_tracking_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ipc_tracking_edit->IsModal) { ?>
<?php echo $ipc_tracking_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$ipc_tracking_edit->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$ipc_tracking_edit->terminate();
?>