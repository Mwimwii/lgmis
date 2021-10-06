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
$ipc_tracking_add = new ipc_tracking_add();

// Run the page
$ipc_tracking_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ipc_tracking_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fipc_trackingadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fipc_trackingadd = currentForm = new ew.Form("fipc_trackingadd", "add");

	// Validate form
	fipc_trackingadd.validate = function() {
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
			<?php if ($ipc_tracking_add->ContractNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->ContractNo->caption(), $ipc_tracking_add->ContractNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->ContractAuthorizedByAG->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractAuthorizedByAG[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->ContractAuthorizedByAG->caption(), $ipc_tracking_add->ContractAuthorizedByAG->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->VATApplied->Required) { ?>
				elm = this.getElements("x" + infix + "_VATApplied[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->VATApplied->caption(), $ipc_tracking_add->VATApplied->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->ArithmeticCheckDone->Required) { ?>
				elm = this.getElements("x" + infix + "_ArithmeticCheckDone[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->ArithmeticCheckDone->caption(), $ipc_tracking_add->ArithmeticCheckDone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->VariationsApproved->Required) { ?>
				elm = this.getElements("x" + infix + "_VariationsApproved[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->VariationsApproved->caption(), $ipc_tracking_add->VariationsApproved->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->PerformanceBondValidUntil->Required) { ?>
				elm = this.getElements("x" + infix + "_PerformanceBondValidUntil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->PerformanceBondValidUntil->caption(), $ipc_tracking_add->PerformanceBondValidUntil->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PerformanceBondValidUntil");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_add->PerformanceBondValidUntil->errorMessage()) ?>");
			<?php if ($ipc_tracking_add->AdvancePaymentBondValidUntil->Required) { ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentBondValidUntil");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->AdvancePaymentBondValidUntil->caption(), $ipc_tracking_add->AdvancePaymentBondValidUntil->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AdvancePaymentBondValidUntil");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_add->AdvancePaymentBondValidUntil->errorMessage()) ?>");
			<?php if ($ipc_tracking_add->RetentionDeductionClause->Required) { ?>
				elm = this.getElements("x" + infix + "_RetentionDeductionClause");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->RetentionDeductionClause->caption(), $ipc_tracking_add->RetentionDeductionClause->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->RetentionDeducted->Required) { ?>
				elm = this.getElements("x" + infix + "_RetentionDeducted[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->RetentionDeducted->caption(), $ipc_tracking_add->RetentionDeducted->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->LiquidatedDamagesDeducted->Required) { ?>
				elm = this.getElements("x" + infix + "_LiquidatedDamagesDeducted[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->LiquidatedDamagesDeducted->caption(), $ipc_tracking_add->LiquidatedDamagesDeducted->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->AdvancedPaymentDeducted->Required) { ?>
				elm = this.getElements("x" + infix + "_AdvancedPaymentDeducted[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->AdvancedPaymentDeducted->caption(), $ipc_tracking_add->AdvancedPaymentDeducted->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->CurrentProgressReportAttached->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentProgressReportAttached[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->CurrentProgressReportAttached->caption(), $ipc_tracking_add->CurrentProgressReportAttached->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->CurrentProgressReport->Required) { ?>
				felm = this.getElements("x" + infix + "_CurrentProgressReport");
				elm = this.getElements("fn_x" + infix + "_CurrentProgressReport");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->CurrentProgressReport->caption(), $ipc_tracking_add->CurrentProgressReport->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->DateOfSiteInspection->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfSiteInspection");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->DateOfSiteInspection->caption(), $ipc_tracking_add->DateOfSiteInspection->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfSiteInspection");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_add->DateOfSiteInspection->errorMessage()) ?>");
			<?php if ($ipc_tracking_add->TimeExtensionAuthorized->Required) { ?>
				elm = this.getElements("x" + infix + "_TimeExtensionAuthorized[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->TimeExtensionAuthorized->caption(), $ipc_tracking_add->TimeExtensionAuthorized->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->LabResultsChecked->Required) { ?>
				elm = this.getElements("x" + infix + "_LabResultsChecked[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->LabResultsChecked->caption(), $ipc_tracking_add->LabResultsChecked->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->LabResults->Required) { ?>
				felm = this.getElements("x" + infix + "_LabResults");
				elm = this.getElements("fn_x" + infix + "_LabResults");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->LabResults->caption(), $ipc_tracking_add->LabResults->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->TerminationNoticeGiven->Required) { ?>
				elm = this.getElements("x" + infix + "_TerminationNoticeGiven[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->TerminationNoticeGiven->caption(), $ipc_tracking_add->TerminationNoticeGiven->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->CopiesEmailedToMLG->Required) { ?>
				elm = this.getElements("x" + infix + "_CopiesEmailedToMLG[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->CopiesEmailedToMLG->caption(), $ipc_tracking_add->CopiesEmailedToMLG->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->ContractStillValid->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractStillValid[]");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->ContractStillValid->caption(), $ipc_tracking_add->ContractStillValid->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->DeskOfficer->Required) { ?>
				elm = this.getElements("x" + infix + "_DeskOfficer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->DeskOfficer->caption(), $ipc_tracking_add->DeskOfficer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->DeskOfficerDate->Required) { ?>
				elm = this.getElements("x" + infix + "_DeskOfficerDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->DeskOfficerDate->caption(), $ipc_tracking_add->DeskOfficerDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DeskOfficerDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_add->DeskOfficerDate->errorMessage()) ?>");
			<?php if ($ipc_tracking_add->SupervisingEngineer->Required) { ?>
				elm = this.getElements("x" + infix + "_SupervisingEngineer");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->SupervisingEngineer->caption(), $ipc_tracking_add->SupervisingEngineer->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->EngineerDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EngineerDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->EngineerDate->caption(), $ipc_tracking_add->EngineerDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EngineerDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_add->EngineerDate->errorMessage()) ?>");
			<?php if ($ipc_tracking_add->CouncilSecretary->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilSecretary");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->CouncilSecretary->caption(), $ipc_tracking_add->CouncilSecretary->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->CSDate->Required) { ?>
				elm = this.getElements("x" + infix + "_CSDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->CSDate->caption(), $ipc_tracking_add->CSDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CSDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_add->CSDate->errorMessage()) ?>");
			<?php if ($ipc_tracking_add->MLGComments->Required) { ?>
				elm = this.getElements("x" + infix + "_MLGComments");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->MLGComments->caption(), $ipc_tracking_add->MLGComments->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ipc_tracking_add->ContractType->Required) { ?>
				elm = this.getElements("x" + infix + "_ContractType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ipc_tracking_add->ContractType->caption(), $ipc_tracking_add->ContractType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ContractType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ipc_tracking_add->ContractType->errorMessage()) ?>");

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
	fipc_trackingadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fipc_trackingadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fipc_trackingadd.lists["x_ContractAuthorizedByAG[]"] = <?php echo $ipc_tracking_add->ContractAuthorizedByAG->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_ContractAuthorizedByAG[]"].options = <?php echo JsonEncode($ipc_tracking_add->ContractAuthorizedByAG->options(FALSE, TRUE)) ?>;
	fipc_trackingadd.lists["x_VATApplied[]"] = <?php echo $ipc_tracking_add->VATApplied->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_VATApplied[]"].options = <?php echo JsonEncode($ipc_tracking_add->VATApplied->options(FALSE, TRUE)) ?>;
	fipc_trackingadd.lists["x_ArithmeticCheckDone[]"] = <?php echo $ipc_tracking_add->ArithmeticCheckDone->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_ArithmeticCheckDone[]"].options = <?php echo JsonEncode($ipc_tracking_add->ArithmeticCheckDone->options(FALSE, TRUE)) ?>;
	fipc_trackingadd.lists["x_VariationsApproved[]"] = <?php echo $ipc_tracking_add->VariationsApproved->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_VariationsApproved[]"].options = <?php echo JsonEncode($ipc_tracking_add->VariationsApproved->options(FALSE, TRUE)) ?>;
	fipc_trackingadd.lists["x_RetentionDeducted[]"] = <?php echo $ipc_tracking_add->RetentionDeducted->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_RetentionDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_add->RetentionDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackingadd.lists["x_LiquidatedDamagesDeducted[]"] = <?php echo $ipc_tracking_add->LiquidatedDamagesDeducted->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_LiquidatedDamagesDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_add->LiquidatedDamagesDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackingadd.lists["x_AdvancedPaymentDeducted[]"] = <?php echo $ipc_tracking_add->AdvancedPaymentDeducted->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_AdvancedPaymentDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_add->AdvancedPaymentDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackingadd.lists["x_CurrentProgressReportAttached[]"] = <?php echo $ipc_tracking_add->CurrentProgressReportAttached->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_CurrentProgressReportAttached[]"].options = <?php echo JsonEncode($ipc_tracking_add->CurrentProgressReportAttached->options(FALSE, TRUE)) ?>;
	fipc_trackingadd.lists["x_TimeExtensionAuthorized[]"] = <?php echo $ipc_tracking_add->TimeExtensionAuthorized->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_TimeExtensionAuthorized[]"].options = <?php echo JsonEncode($ipc_tracking_add->TimeExtensionAuthorized->options(FALSE, TRUE)) ?>;
	fipc_trackingadd.lists["x_LabResultsChecked[]"] = <?php echo $ipc_tracking_add->LabResultsChecked->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_LabResultsChecked[]"].options = <?php echo JsonEncode($ipc_tracking_add->LabResultsChecked->options(FALSE, TRUE)) ?>;
	fipc_trackingadd.lists["x_TerminationNoticeGiven[]"] = <?php echo $ipc_tracking_add->TerminationNoticeGiven->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_TerminationNoticeGiven[]"].options = <?php echo JsonEncode($ipc_tracking_add->TerminationNoticeGiven->options(FALSE, TRUE)) ?>;
	fipc_trackingadd.lists["x_CopiesEmailedToMLG[]"] = <?php echo $ipc_tracking_add->CopiesEmailedToMLG->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_CopiesEmailedToMLG[]"].options = <?php echo JsonEncode($ipc_tracking_add->CopiesEmailedToMLG->options(FALSE, TRUE)) ?>;
	fipc_trackingadd.lists["x_ContractStillValid[]"] = <?php echo $ipc_tracking_add->ContractStillValid->Lookup->toClientList($ipc_tracking_add) ?>;
	fipc_trackingadd.lists["x_ContractStillValid[]"].options = <?php echo JsonEncode($ipc_tracking_add->ContractStillValid->options(FALSE, TRUE)) ?>;
	loadjs.done("fipc_trackingadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ipc_tracking_add->showPageHeader(); ?>
<?php
$ipc_tracking_add->showMessage();
?>
<form name="fipc_trackingadd" id="fipc_trackingadd" class="<?php echo $ipc_tracking_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ipc_tracking">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ipc_tracking_add->IsModal ?>">
<?php if ($ipc_tracking->getCurrentMasterTable() == "contract") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="contract">
<input type="hidden" name="fk_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_add->ContractNo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($ipc_tracking_add->ContractNo->Visible) { // ContractNo ?>
	<div id="r_ContractNo" class="form-group row">
		<label id="elh_ipc_tracking_ContractNo" for="x_ContractNo" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->ContractNo->caption() ?><?php echo $ipc_tracking_add->ContractNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->ContractNo->cellAttributes() ?>>
<?php if ($ipc_tracking_add->ContractNo->getSessionValue() != "") { ?>
<span id="el_ipc_tracking_ContractNo">
<span<?php echo $ipc_tracking_add->ContractNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ipc_tracking_add->ContractNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ContractNo" name="x_ContractNo" value="<?php echo HtmlEncode($ipc_tracking_add->ContractNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ipc_tracking_ContractNo">
<input type="text" data-table="ipc_tracking" data-field="x_ContractNo" name="x_ContractNo" id="x_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($ipc_tracking_add->ContractNo->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_add->ContractNo->EditValue ?>"<?php echo $ipc_tracking_add->ContractNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $ipc_tracking_add->ContractNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
	<div id="r_ContractAuthorizedByAG" class="form-group row">
		<label id="elh_ipc_tracking_ContractAuthorizedByAG" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->ContractAuthorizedByAG->caption() ?><?php echo $ipc_tracking_add->ContractAuthorizedByAG->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->ContractAuthorizedByAG->cellAttributes() ?>>
<span id="el_ipc_tracking_ContractAuthorizedByAG">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->ContractAuthorizedByAG->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="x_ContractAuthorizedByAG[]" id="x_ContractAuthorizedByAG[]_975856" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->ContractAuthorizedByAG->editAttributes() ?>>
	<label class="custom-control-label" for="x_ContractAuthorizedByAG[]_975856"></label>
</div>
</span>
<?php echo $ipc_tracking_add->ContractAuthorizedByAG->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->VATApplied->Visible) { // VATApplied ?>
	<div id="r_VATApplied" class="form-group row">
		<label id="elh_ipc_tracking_VATApplied" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->VATApplied->caption() ?><?php echo $ipc_tracking_add->VATApplied->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->VATApplied->cellAttributes() ?>>
<span id="el_ipc_tracking_VATApplied">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->VATApplied->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_VATApplied" name="x_VATApplied[]" id="x_VATApplied[]_768982" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->VATApplied->editAttributes() ?>>
	<label class="custom-control-label" for="x_VATApplied[]_768982"></label>
</div>
</span>
<?php echo $ipc_tracking_add->VATApplied->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
	<div id="r_ArithmeticCheckDone" class="form-group row">
		<label id="elh_ipc_tracking_ArithmeticCheckDone" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->ArithmeticCheckDone->caption() ?><?php echo $ipc_tracking_add->ArithmeticCheckDone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->ArithmeticCheckDone->cellAttributes() ?>>
<span id="el_ipc_tracking_ArithmeticCheckDone">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->ArithmeticCheckDone->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="x_ArithmeticCheckDone[]" id="x_ArithmeticCheckDone[]_214430" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->ArithmeticCheckDone->editAttributes() ?>>
	<label class="custom-control-label" for="x_ArithmeticCheckDone[]_214430"></label>
</div>
</span>
<?php echo $ipc_tracking_add->ArithmeticCheckDone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->VariationsApproved->Visible) { // VariationsApproved ?>
	<div id="r_VariationsApproved" class="form-group row">
		<label id="elh_ipc_tracking_VariationsApproved" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->VariationsApproved->caption() ?><?php echo $ipc_tracking_add->VariationsApproved->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->VariationsApproved->cellAttributes() ?>>
<span id="el_ipc_tracking_VariationsApproved">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->VariationsApproved->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_VariationsApproved" name="x_VariationsApproved[]" id="x_VariationsApproved[]_523801" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->VariationsApproved->editAttributes() ?>>
	<label class="custom-control-label" for="x_VariationsApproved[]_523801"></label>
</div>
</span>
<?php echo $ipc_tracking_add->VariationsApproved->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
	<div id="r_PerformanceBondValidUntil" class="form-group row">
		<label id="elh_ipc_tracking_PerformanceBondValidUntil" for="x_PerformanceBondValidUntil" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->PerformanceBondValidUntil->caption() ?><?php echo $ipc_tracking_add->PerformanceBondValidUntil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->PerformanceBondValidUntil->cellAttributes() ?>>
<span id="el_ipc_tracking_PerformanceBondValidUntil">
<input type="text" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="x_PerformanceBondValidUntil" id="x_PerformanceBondValidUntil" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_add->PerformanceBondValidUntil->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_add->PerformanceBondValidUntil->EditValue ?>"<?php echo $ipc_tracking_add->PerformanceBondValidUntil->editAttributes() ?>>
<?php if (!$ipc_tracking_add->PerformanceBondValidUntil->ReadOnly && !$ipc_tracking_add->PerformanceBondValidUntil->Disabled && !isset($ipc_tracking_add->PerformanceBondValidUntil->EditAttrs["readonly"]) && !isset($ipc_tracking_add->PerformanceBondValidUntil->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingadd", "x_PerformanceBondValidUntil", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ipc_tracking_add->PerformanceBondValidUntil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
	<div id="r_AdvancePaymentBondValidUntil" class="form-group row">
		<label id="elh_ipc_tracking_AdvancePaymentBondValidUntil" for="x_AdvancePaymentBondValidUntil" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->AdvancePaymentBondValidUntil->caption() ?><?php echo $ipc_tracking_add->AdvancePaymentBondValidUntil->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->AdvancePaymentBondValidUntil->cellAttributes() ?>>
<span id="el_ipc_tracking_AdvancePaymentBondValidUntil">
<input type="text" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="x_AdvancePaymentBondValidUntil" id="x_AdvancePaymentBondValidUntil" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_add->AdvancePaymentBondValidUntil->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_add->AdvancePaymentBondValidUntil->EditValue ?>"<?php echo $ipc_tracking_add->AdvancePaymentBondValidUntil->editAttributes() ?>>
<?php if (!$ipc_tracking_add->AdvancePaymentBondValidUntil->ReadOnly && !$ipc_tracking_add->AdvancePaymentBondValidUntil->Disabled && !isset($ipc_tracking_add->AdvancePaymentBondValidUntil->EditAttrs["readonly"]) && !isset($ipc_tracking_add->AdvancePaymentBondValidUntil->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingadd", "x_AdvancePaymentBondValidUntil", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ipc_tracking_add->AdvancePaymentBondValidUntil->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
	<div id="r_RetentionDeductionClause" class="form-group row">
		<label id="elh_ipc_tracking_RetentionDeductionClause" for="x_RetentionDeductionClause" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->RetentionDeductionClause->caption() ?><?php echo $ipc_tracking_add->RetentionDeductionClause->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->RetentionDeductionClause->cellAttributes() ?>>
<span id="el_ipc_tracking_RetentionDeductionClause">
<input type="text" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="x_RetentionDeductionClause" id="x_RetentionDeductionClause" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_add->RetentionDeductionClause->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_add->RetentionDeductionClause->EditValue ?>"<?php echo $ipc_tracking_add->RetentionDeductionClause->editAttributes() ?>>
</span>
<?php echo $ipc_tracking_add->RetentionDeductionClause->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->RetentionDeducted->Visible) { // RetentionDeducted ?>
	<div id="r_RetentionDeducted" class="form-group row">
		<label id="elh_ipc_tracking_RetentionDeducted" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->RetentionDeducted->caption() ?><?php echo $ipc_tracking_add->RetentionDeducted->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->RetentionDeducted->cellAttributes() ?>>
<span id="el_ipc_tracking_RetentionDeducted">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->RetentionDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="x_RetentionDeducted[]" id="x_RetentionDeducted[]_686486" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->RetentionDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x_RetentionDeducted[]_686486"></label>
</div>
</span>
<?php echo $ipc_tracking_add->RetentionDeducted->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
	<div id="r_LiquidatedDamagesDeducted" class="form-group row">
		<label id="elh_ipc_tracking_LiquidatedDamagesDeducted" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->LiquidatedDamagesDeducted->caption() ?><?php echo $ipc_tracking_add->LiquidatedDamagesDeducted->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->LiquidatedDamagesDeducted->cellAttributes() ?>>
<span id="el_ipc_tracking_LiquidatedDamagesDeducted">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->LiquidatedDamagesDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="x_LiquidatedDamagesDeducted[]" id="x_LiquidatedDamagesDeducted[]_828465" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->LiquidatedDamagesDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x_LiquidatedDamagesDeducted[]_828465"></label>
</div>
</span>
<?php echo $ipc_tracking_add->LiquidatedDamagesDeducted->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
	<div id="r_AdvancedPaymentDeducted" class="form-group row">
		<label id="elh_ipc_tracking_AdvancedPaymentDeducted" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->AdvancedPaymentDeducted->caption() ?><?php echo $ipc_tracking_add->AdvancedPaymentDeducted->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->AdvancedPaymentDeducted->cellAttributes() ?>>
<span id="el_ipc_tracking_AdvancedPaymentDeducted">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->AdvancedPaymentDeducted->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="x_AdvancedPaymentDeducted[]" id="x_AdvancedPaymentDeducted[]_394490" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->AdvancedPaymentDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x_AdvancedPaymentDeducted[]_394490"></label>
</div>
</span>
<?php echo $ipc_tracking_add->AdvancedPaymentDeducted->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
	<div id="r_CurrentProgressReportAttached" class="form-group row">
		<label id="elh_ipc_tracking_CurrentProgressReportAttached" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->CurrentProgressReportAttached->caption() ?><?php echo $ipc_tracking_add->CurrentProgressReportAttached->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->CurrentProgressReportAttached->cellAttributes() ?>>
<span id="el_ipc_tracking_CurrentProgressReportAttached">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->CurrentProgressReportAttached->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="x_CurrentProgressReportAttached[]" id="x_CurrentProgressReportAttached[]_776793" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->CurrentProgressReportAttached->editAttributes() ?>>
	<label class="custom-control-label" for="x_CurrentProgressReportAttached[]_776793"></label>
</div>
</span>
<?php echo $ipc_tracking_add->CurrentProgressReportAttached->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->CurrentProgressReport->Visible) { // CurrentProgressReport ?>
	<div id="r_CurrentProgressReport" class="form-group row">
		<label id="elh_ipc_tracking_CurrentProgressReport" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->CurrentProgressReport->caption() ?><?php echo $ipc_tracking_add->CurrentProgressReport->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->CurrentProgressReport->cellAttributes() ?>>
<span id="el_ipc_tracking_CurrentProgressReport">
<div id="fd_x_CurrentProgressReport">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $ipc_tracking_add->CurrentProgressReport->title() ?>" data-table="ipc_tracking" data-field="x_CurrentProgressReport" name="x_CurrentProgressReport" id="x_CurrentProgressReport" lang="<?php echo CurrentLanguageID() ?>"<?php echo $ipc_tracking_add->CurrentProgressReport->editAttributes() ?><?php if ($ipc_tracking_add->CurrentProgressReport->ReadOnly || $ipc_tracking_add->CurrentProgressReport->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_CurrentProgressReport"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_CurrentProgressReport" id= "fn_x_CurrentProgressReport" value="<?php echo $ipc_tracking_add->CurrentProgressReport->Upload->FileName ?>">
<input type="hidden" name="fa_x_CurrentProgressReport" id= "fa_x_CurrentProgressReport" value="0">
<input type="hidden" name="fs_x_CurrentProgressReport" id= "fs_x_CurrentProgressReport" value="0">
<input type="hidden" name="fx_x_CurrentProgressReport" id= "fx_x_CurrentProgressReport" value="<?php echo $ipc_tracking_add->CurrentProgressReport->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_CurrentProgressReport" id= "fm_x_CurrentProgressReport" value="<?php echo $ipc_tracking_add->CurrentProgressReport->UploadMaxFileSize ?>">
</div>
<table id="ft_x_CurrentProgressReport" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $ipc_tracking_add->CurrentProgressReport->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
	<div id="r_DateOfSiteInspection" class="form-group row">
		<label id="elh_ipc_tracking_DateOfSiteInspection" for="x_DateOfSiteInspection" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->DateOfSiteInspection->caption() ?><?php echo $ipc_tracking_add->DateOfSiteInspection->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->DateOfSiteInspection->cellAttributes() ?>>
<span id="el_ipc_tracking_DateOfSiteInspection">
<input type="text" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="x_DateOfSiteInspection" id="x_DateOfSiteInspection" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_add->DateOfSiteInspection->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_add->DateOfSiteInspection->EditValue ?>"<?php echo $ipc_tracking_add->DateOfSiteInspection->editAttributes() ?>>
<?php if (!$ipc_tracking_add->DateOfSiteInspection->ReadOnly && !$ipc_tracking_add->DateOfSiteInspection->Disabled && !isset($ipc_tracking_add->DateOfSiteInspection->EditAttrs["readonly"]) && !isset($ipc_tracking_add->DateOfSiteInspection->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingadd", "x_DateOfSiteInspection", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ipc_tracking_add->DateOfSiteInspection->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
	<div id="r_TimeExtensionAuthorized" class="form-group row">
		<label id="elh_ipc_tracking_TimeExtensionAuthorized" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->TimeExtensionAuthorized->caption() ?><?php echo $ipc_tracking_add->TimeExtensionAuthorized->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->TimeExtensionAuthorized->cellAttributes() ?>>
<span id="el_ipc_tracking_TimeExtensionAuthorized">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->TimeExtensionAuthorized->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="x_TimeExtensionAuthorized[]" id="x_TimeExtensionAuthorized[]_650692" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->TimeExtensionAuthorized->editAttributes() ?>>
	<label class="custom-control-label" for="x_TimeExtensionAuthorized[]_650692"></label>
</div>
</span>
<?php echo $ipc_tracking_add->TimeExtensionAuthorized->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->LabResultsChecked->Visible) { // LabResultsChecked ?>
	<div id="r_LabResultsChecked" class="form-group row">
		<label id="elh_ipc_tracking_LabResultsChecked" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->LabResultsChecked->caption() ?><?php echo $ipc_tracking_add->LabResultsChecked->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->LabResultsChecked->cellAttributes() ?>>
<span id="el_ipc_tracking_LabResultsChecked">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->LabResultsChecked->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="x_LabResultsChecked[]" id="x_LabResultsChecked[]_649723" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->LabResultsChecked->editAttributes() ?>>
	<label class="custom-control-label" for="x_LabResultsChecked[]_649723"></label>
</div>
</span>
<?php echo $ipc_tracking_add->LabResultsChecked->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->LabResults->Visible) { // LabResults ?>
	<div id="r_LabResults" class="form-group row">
		<label id="elh_ipc_tracking_LabResults" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->LabResults->caption() ?><?php echo $ipc_tracking_add->LabResults->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->LabResults->cellAttributes() ?>>
<span id="el_ipc_tracking_LabResults">
<div id="fd_x_LabResults">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $ipc_tracking_add->LabResults->title() ?>" data-table="ipc_tracking" data-field="x_LabResults" name="x_LabResults" id="x_LabResults" lang="<?php echo CurrentLanguageID() ?>"<?php echo $ipc_tracking_add->LabResults->editAttributes() ?><?php if ($ipc_tracking_add->LabResults->ReadOnly || $ipc_tracking_add->LabResults->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_LabResults"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_LabResults" id= "fn_x_LabResults" value="<?php echo $ipc_tracking_add->LabResults->Upload->FileName ?>">
<input type="hidden" name="fa_x_LabResults" id= "fa_x_LabResults" value="0">
<input type="hidden" name="fs_x_LabResults" id= "fs_x_LabResults" value="0">
<input type="hidden" name="fx_x_LabResults" id= "fx_x_LabResults" value="<?php echo $ipc_tracking_add->LabResults->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_LabResults" id= "fm_x_LabResults" value="<?php echo $ipc_tracking_add->LabResults->UploadMaxFileSize ?>">
</div>
<table id="ft_x_LabResults" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $ipc_tracking_add->LabResults->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
	<div id="r_TerminationNoticeGiven" class="form-group row">
		<label id="elh_ipc_tracking_TerminationNoticeGiven" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->TerminationNoticeGiven->caption() ?><?php echo $ipc_tracking_add->TerminationNoticeGiven->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->TerminationNoticeGiven->cellAttributes() ?>>
<span id="el_ipc_tracking_TerminationNoticeGiven">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->TerminationNoticeGiven->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="x_TerminationNoticeGiven[]" id="x_TerminationNoticeGiven[]_938173" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->TerminationNoticeGiven->editAttributes() ?>>
	<label class="custom-control-label" for="x_TerminationNoticeGiven[]_938173"></label>
</div>
</span>
<?php echo $ipc_tracking_add->TerminationNoticeGiven->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
	<div id="r_CopiesEmailedToMLG" class="form-group row">
		<label id="elh_ipc_tracking_CopiesEmailedToMLG" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->CopiesEmailedToMLG->caption() ?><?php echo $ipc_tracking_add->CopiesEmailedToMLG->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->CopiesEmailedToMLG->cellAttributes() ?>>
<span id="el_ipc_tracking_CopiesEmailedToMLG">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->CopiesEmailedToMLG->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="x_CopiesEmailedToMLG[]" id="x_CopiesEmailedToMLG[]_870945" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->CopiesEmailedToMLG->editAttributes() ?>>
	<label class="custom-control-label" for="x_CopiesEmailedToMLG[]_870945"></label>
</div>
</span>
<?php echo $ipc_tracking_add->CopiesEmailedToMLG->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->ContractStillValid->Visible) { // ContractStillValid ?>
	<div id="r_ContractStillValid" class="form-group row">
		<label id="elh_ipc_tracking_ContractStillValid" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->ContractStillValid->caption() ?><?php echo $ipc_tracking_add->ContractStillValid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->ContractStillValid->cellAttributes() ?>>
<span id="el_ipc_tracking_ContractStillValid">
<?php
$selwrk = ConvertToBool($ipc_tracking_add->ContractStillValid->CurrentValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ContractStillValid" name="x_ContractStillValid[]" id="x_ContractStillValid[]_412038" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_add->ContractStillValid->editAttributes() ?>>
	<label class="custom-control-label" for="x_ContractStillValid[]_412038"></label>
</div>
</span>
<?php echo $ipc_tracking_add->ContractStillValid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->DeskOfficer->Visible) { // DeskOfficer ?>
	<div id="r_DeskOfficer" class="form-group row">
		<label id="elh_ipc_tracking_DeskOfficer" for="x_DeskOfficer" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->DeskOfficer->caption() ?><?php echo $ipc_tracking_add->DeskOfficer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->DeskOfficer->cellAttributes() ?>>
<span id="el_ipc_tracking_DeskOfficer">
<input type="text" data-table="ipc_tracking" data-field="x_DeskOfficer" name="x_DeskOfficer" id="x_DeskOfficer" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_add->DeskOfficer->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_add->DeskOfficer->EditValue ?>"<?php echo $ipc_tracking_add->DeskOfficer->editAttributes() ?>>
</span>
<?php echo $ipc_tracking_add->DeskOfficer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
	<div id="r_DeskOfficerDate" class="form-group row">
		<label id="elh_ipc_tracking_DeskOfficerDate" for="x_DeskOfficerDate" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->DeskOfficerDate->caption() ?><?php echo $ipc_tracking_add->DeskOfficerDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->DeskOfficerDate->cellAttributes() ?>>
<span id="el_ipc_tracking_DeskOfficerDate">
<input type="text" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="x_DeskOfficerDate" id="x_DeskOfficerDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_add->DeskOfficerDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_add->DeskOfficerDate->EditValue ?>"<?php echo $ipc_tracking_add->DeskOfficerDate->editAttributes() ?>>
<?php if (!$ipc_tracking_add->DeskOfficerDate->ReadOnly && !$ipc_tracking_add->DeskOfficerDate->Disabled && !isset($ipc_tracking_add->DeskOfficerDate->EditAttrs["readonly"]) && !isset($ipc_tracking_add->DeskOfficerDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingadd", "x_DeskOfficerDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ipc_tracking_add->DeskOfficerDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
	<div id="r_SupervisingEngineer" class="form-group row">
		<label id="elh_ipc_tracking_SupervisingEngineer" for="x_SupervisingEngineer" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->SupervisingEngineer->caption() ?><?php echo $ipc_tracking_add->SupervisingEngineer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->SupervisingEngineer->cellAttributes() ?>>
<span id="el_ipc_tracking_SupervisingEngineer">
<input type="text" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="x_SupervisingEngineer" id="x_SupervisingEngineer" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_add->SupervisingEngineer->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_add->SupervisingEngineer->EditValue ?>"<?php echo $ipc_tracking_add->SupervisingEngineer->editAttributes() ?>>
</span>
<?php echo $ipc_tracking_add->SupervisingEngineer->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->EngineerDate->Visible) { // EngineerDate ?>
	<div id="r_EngineerDate" class="form-group row">
		<label id="elh_ipc_tracking_EngineerDate" for="x_EngineerDate" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->EngineerDate->caption() ?><?php echo $ipc_tracking_add->EngineerDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->EngineerDate->cellAttributes() ?>>
<span id="el_ipc_tracking_EngineerDate">
<input type="text" data-table="ipc_tracking" data-field="x_EngineerDate" name="x_EngineerDate" id="x_EngineerDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_add->EngineerDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_add->EngineerDate->EditValue ?>"<?php echo $ipc_tracking_add->EngineerDate->editAttributes() ?>>
<?php if (!$ipc_tracking_add->EngineerDate->ReadOnly && !$ipc_tracking_add->EngineerDate->Disabled && !isset($ipc_tracking_add->EngineerDate->EditAttrs["readonly"]) && !isset($ipc_tracking_add->EngineerDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingadd", "x_EngineerDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ipc_tracking_add->EngineerDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->CouncilSecretary->Visible) { // CouncilSecretary ?>
	<div id="r_CouncilSecretary" class="form-group row">
		<label id="elh_ipc_tracking_CouncilSecretary" for="x_CouncilSecretary" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->CouncilSecretary->caption() ?><?php echo $ipc_tracking_add->CouncilSecretary->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->CouncilSecretary->cellAttributes() ?>>
<span id="el_ipc_tracking_CouncilSecretary">
<input type="text" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="x_CouncilSecretary" id="x_CouncilSecretary" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_add->CouncilSecretary->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_add->CouncilSecretary->EditValue ?>"<?php echo $ipc_tracking_add->CouncilSecretary->editAttributes() ?>>
</span>
<?php echo $ipc_tracking_add->CouncilSecretary->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->CSDate->Visible) { // CSDate ?>
	<div id="r_CSDate" class="form-group row">
		<label id="elh_ipc_tracking_CSDate" for="x_CSDate" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->CSDate->caption() ?><?php echo $ipc_tracking_add->CSDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->CSDate->cellAttributes() ?>>
<span id="el_ipc_tracking_CSDate">
<input type="text" data-table="ipc_tracking" data-field="x_CSDate" name="x_CSDate" id="x_CSDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_add->CSDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_add->CSDate->EditValue ?>"<?php echo $ipc_tracking_add->CSDate->editAttributes() ?>>
<?php if (!$ipc_tracking_add->CSDate->ReadOnly && !$ipc_tracking_add->CSDate->Disabled && !isset($ipc_tracking_add->CSDate->EditAttrs["readonly"]) && !isset($ipc_tracking_add->CSDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingadd", "x_CSDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ipc_tracking_add->CSDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->MLGComments->Visible) { // MLGComments ?>
	<div id="r_MLGComments" class="form-group row">
		<label id="elh_ipc_tracking_MLGComments" for="x_MLGComments" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->MLGComments->caption() ?><?php echo $ipc_tracking_add->MLGComments->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->MLGComments->cellAttributes() ?>>
<span id="el_ipc_tracking_MLGComments">
<textarea data-table="ipc_tracking" data-field="x_MLGComments" name="x_MLGComments" id="x_MLGComments" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ipc_tracking_add->MLGComments->getPlaceHolder()) ?>"<?php echo $ipc_tracking_add->MLGComments->editAttributes() ?>><?php echo $ipc_tracking_add->MLGComments->EditValue ?></textarea>
</span>
<?php echo $ipc_tracking_add->MLGComments->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_add->ContractType->Visible) { // ContractType ?>
	<div id="r_ContractType" class="form-group row">
		<label id="elh_ipc_tracking_ContractType" for="x_ContractType" class="<?php echo $ipc_tracking_add->LeftColumnClass ?>"><?php echo $ipc_tracking_add->ContractType->caption() ?><?php echo $ipc_tracking_add->ContractType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ipc_tracking_add->RightColumnClass ?>"><div <?php echo $ipc_tracking_add->ContractType->cellAttributes() ?>>
<span id="el_ipc_tracking_ContractType">
<input type="text" data-table="ipc_tracking" data-field="x_ContractType" name="x_ContractType" id="x_ContractType" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($ipc_tracking_add->ContractType->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_add->ContractType->EditValue ?>"<?php echo $ipc_tracking_add->ContractType->editAttributes() ?>>
</span>
<?php echo $ipc_tracking_add->ContractType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ipc_tracking_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ipc_tracking_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ipc_tracking_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ipc_tracking_add->showPageFooter();
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
$ipc_tracking_add->terminate();
?>