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
$ipc_tracking_search = new ipc_tracking_search();

// Run the page
$ipc_tracking_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ipc_tracking_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fipc_trackingsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($ipc_tracking_search->IsModal) { ?>
	fipc_trackingsearch = currentAdvancedSearchForm = new ew.Form("fipc_trackingsearch", "search");
	<?php } else { ?>
	fipc_trackingsearch = currentForm = new ew.Form("fipc_trackingsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fipc_trackingsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_IPCNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ipc_tracking_search->IPCNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PerformanceBondValidUntil");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ipc_tracking_search->PerformanceBondValidUntil->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AdvancePaymentBondValidUntil");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ipc_tracking_search->AdvancePaymentBondValidUntil->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfSiteInspection");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ipc_tracking_search->DateOfSiteInspection->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DeskOfficerDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ipc_tracking_search->DeskOfficerDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EngineerDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ipc_tracking_search->EngineerDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_CSDate");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ipc_tracking_search->CSDate->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ContractType");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($ipc_tracking_search->ContractType->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fipc_trackingsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fipc_trackingsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fipc_trackingsearch.lists["x_ContractAuthorizedByAG[]"] = <?php echo $ipc_tracking_search->ContractAuthorizedByAG->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_ContractAuthorizedByAG[]"].options = <?php echo JsonEncode($ipc_tracking_search->ContractAuthorizedByAG->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_VATApplied[]"] = <?php echo $ipc_tracking_search->VATApplied->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_VATApplied[]"].options = <?php echo JsonEncode($ipc_tracking_search->VATApplied->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_ArithmeticCheckDone[]"] = <?php echo $ipc_tracking_search->ArithmeticCheckDone->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_ArithmeticCheckDone[]"].options = <?php echo JsonEncode($ipc_tracking_search->ArithmeticCheckDone->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_VariationsApproved[]"] = <?php echo $ipc_tracking_search->VariationsApproved->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_VariationsApproved[]"].options = <?php echo JsonEncode($ipc_tracking_search->VariationsApproved->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_RetentionDeducted[]"] = <?php echo $ipc_tracking_search->RetentionDeducted->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_RetentionDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_search->RetentionDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_LiquidatedDamagesDeducted[]"] = <?php echo $ipc_tracking_search->LiquidatedDamagesDeducted->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_LiquidatedDamagesDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_search->LiquidatedDamagesDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_LiquidatedPenaltiesDeducted[]"] = <?php echo $ipc_tracking_search->LiquidatedPenaltiesDeducted->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_LiquidatedPenaltiesDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_search->LiquidatedPenaltiesDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_AdvancedPaymentDeducted[]"] = <?php echo $ipc_tracking_search->AdvancedPaymentDeducted->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_AdvancedPaymentDeducted[]"].options = <?php echo JsonEncode($ipc_tracking_search->AdvancedPaymentDeducted->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_CurrentProgressReportAttached[]"] = <?php echo $ipc_tracking_search->CurrentProgressReportAttached->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_CurrentProgressReportAttached[]"].options = <?php echo JsonEncode($ipc_tracking_search->CurrentProgressReportAttached->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_TimeExtensionAuthorized[]"] = <?php echo $ipc_tracking_search->TimeExtensionAuthorized->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_TimeExtensionAuthorized[]"].options = <?php echo JsonEncode($ipc_tracking_search->TimeExtensionAuthorized->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_LabResultsChecked[]"] = <?php echo $ipc_tracking_search->LabResultsChecked->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_LabResultsChecked[]"].options = <?php echo JsonEncode($ipc_tracking_search->LabResultsChecked->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_TerminationNoticeGiven[]"] = <?php echo $ipc_tracking_search->TerminationNoticeGiven->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_TerminationNoticeGiven[]"].options = <?php echo JsonEncode($ipc_tracking_search->TerminationNoticeGiven->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_CopiesEmailedToMLG[]"] = <?php echo $ipc_tracking_search->CopiesEmailedToMLG->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_CopiesEmailedToMLG[]"].options = <?php echo JsonEncode($ipc_tracking_search->CopiesEmailedToMLG->options(FALSE, TRUE)) ?>;
	fipc_trackingsearch.lists["x_ContractStillValid[]"] = <?php echo $ipc_tracking_search->ContractStillValid->Lookup->toClientList($ipc_tracking_search) ?>;
	fipc_trackingsearch.lists["x_ContractStillValid[]"].options = <?php echo JsonEncode($ipc_tracking_search->ContractStillValid->options(FALSE, TRUE)) ?>;
	loadjs.done("fipc_trackingsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ipc_tracking_search->showPageHeader(); ?>
<?php
$ipc_tracking_search->showMessage();
?>
<form name="fipc_trackingsearch" id="fipc_trackingsearch" class="<?php echo $ipc_tracking_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ipc_tracking">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$ipc_tracking_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($ipc_tracking_search->IPCNo->Visible) { // IPCNo ?>
	<div id="r_IPCNo" class="form-group row">
		<label for="x_IPCNo" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_IPCNo"><?php echo $ipc_tracking_search->IPCNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_IPCNo" id="z_IPCNo" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->IPCNo->cellAttributes() ?>>
			<span id="el_ipc_tracking_IPCNo" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_IPCNo" name="x_IPCNo" id="x_IPCNo" maxlength="11" placeholder="<?php echo HtmlEncode($ipc_tracking_search->IPCNo->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->IPCNo->EditValue ?>"<?php echo $ipc_tracking_search->IPCNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->ContractNo->Visible) { // ContractNo ?>
	<div id="r_ContractNo" class="form-group row">
		<label for="x_ContractNo" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_ContractNo"><?php echo $ipc_tracking_search->ContractNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ContractNo" id="z_ContractNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->ContractNo->cellAttributes() ?>>
			<span id="el_ipc_tracking_ContractNo" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_ContractNo" name="x_ContractNo" id="x_ContractNo" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($ipc_tracking_search->ContractNo->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->ContractNo->EditValue ?>"<?php echo $ipc_tracking_search->ContractNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->ContractAuthorizedByAG->Visible) { // ContractAuthorizedByAG ?>
	<div id="r_ContractAuthorizedByAG" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_ContractAuthorizedByAG"><?php echo $ipc_tracking_search->ContractAuthorizedByAG->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ContractAuthorizedByAG" id="z_ContractAuthorizedByAG" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->ContractAuthorizedByAG->cellAttributes() ?>>
			<span id="el_ipc_tracking_ContractAuthorizedByAG" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->ContractAuthorizedByAG->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ContractAuthorizedByAG" name="x_ContractAuthorizedByAG[]" id="x_ContractAuthorizedByAG[]_806718" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->ContractAuthorizedByAG->editAttributes() ?>>
	<label class="custom-control-label" for="x_ContractAuthorizedByAG[]_806718"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->VATApplied->Visible) { // VATApplied ?>
	<div id="r_VATApplied" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_VATApplied"><?php echo $ipc_tracking_search->VATApplied->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_VATApplied" id="z_VATApplied" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->VATApplied->cellAttributes() ?>>
			<span id="el_ipc_tracking_VATApplied" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->VATApplied->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_VATApplied" name="x_VATApplied[]" id="x_VATApplied[]_571252" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->VATApplied->editAttributes() ?>>
	<label class="custom-control-label" for="x_VATApplied[]_571252"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->ArithmeticCheckDone->Visible) { // ArithmeticCheckDone ?>
	<div id="r_ArithmeticCheckDone" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_ArithmeticCheckDone"><?php echo $ipc_tracking_search->ArithmeticCheckDone->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ArithmeticCheckDone" id="z_ArithmeticCheckDone" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->ArithmeticCheckDone->cellAttributes() ?>>
			<span id="el_ipc_tracking_ArithmeticCheckDone" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->ArithmeticCheckDone->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ArithmeticCheckDone" name="x_ArithmeticCheckDone[]" id="x_ArithmeticCheckDone[]_421009" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->ArithmeticCheckDone->editAttributes() ?>>
	<label class="custom-control-label" for="x_ArithmeticCheckDone[]_421009"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->VariationsApproved->Visible) { // VariationsApproved ?>
	<div id="r_VariationsApproved" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_VariationsApproved"><?php echo $ipc_tracking_search->VariationsApproved->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_VariationsApproved" id="z_VariationsApproved" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->VariationsApproved->cellAttributes() ?>>
			<span id="el_ipc_tracking_VariationsApproved" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->VariationsApproved->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_VariationsApproved" name="x_VariationsApproved[]" id="x_VariationsApproved[]_217631" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->VariationsApproved->editAttributes() ?>>
	<label class="custom-control-label" for="x_VariationsApproved[]_217631"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->PerformanceBondValidUntil->Visible) { // PerformanceBondValidUntil ?>
	<div id="r_PerformanceBondValidUntil" class="form-group row">
		<label for="x_PerformanceBondValidUntil" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_PerformanceBondValidUntil"><?php echo $ipc_tracking_search->PerformanceBondValidUntil->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PerformanceBondValidUntil" id="z_PerformanceBondValidUntil" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->PerformanceBondValidUntil->cellAttributes() ?>>
			<span id="el_ipc_tracking_PerformanceBondValidUntil" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_PerformanceBondValidUntil" name="x_PerformanceBondValidUntil" id="x_PerformanceBondValidUntil" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_search->PerformanceBondValidUntil->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->PerformanceBondValidUntil->EditValue ?>"<?php echo $ipc_tracking_search->PerformanceBondValidUntil->editAttributes() ?>>
<?php if (!$ipc_tracking_search->PerformanceBondValidUntil->ReadOnly && !$ipc_tracking_search->PerformanceBondValidUntil->Disabled && !isset($ipc_tracking_search->PerformanceBondValidUntil->EditAttrs["readonly"]) && !isset($ipc_tracking_search->PerformanceBondValidUntil->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingsearch", "x_PerformanceBondValidUntil", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->AdvancePaymentBondValidUntil->Visible) { // AdvancePaymentBondValidUntil ?>
	<div id="r_AdvancePaymentBondValidUntil" class="form-group row">
		<label for="x_AdvancePaymentBondValidUntil" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_AdvancePaymentBondValidUntil"><?php echo $ipc_tracking_search->AdvancePaymentBondValidUntil->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AdvancePaymentBondValidUntil" id="z_AdvancePaymentBondValidUntil" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->AdvancePaymentBondValidUntil->cellAttributes() ?>>
			<span id="el_ipc_tracking_AdvancePaymentBondValidUntil" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_AdvancePaymentBondValidUntil" name="x_AdvancePaymentBondValidUntil" id="x_AdvancePaymentBondValidUntil" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_search->AdvancePaymentBondValidUntil->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->AdvancePaymentBondValidUntil->EditValue ?>"<?php echo $ipc_tracking_search->AdvancePaymentBondValidUntil->editAttributes() ?>>
<?php if (!$ipc_tracking_search->AdvancePaymentBondValidUntil->ReadOnly && !$ipc_tracking_search->AdvancePaymentBondValidUntil->Disabled && !isset($ipc_tracking_search->AdvancePaymentBondValidUntil->EditAttrs["readonly"]) && !isset($ipc_tracking_search->AdvancePaymentBondValidUntil->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingsearch", "x_AdvancePaymentBondValidUntil", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->RetentionDeductionClause->Visible) { // RetentionDeductionClause ?>
	<div id="r_RetentionDeductionClause" class="form-group row">
		<label for="x_RetentionDeductionClause" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_RetentionDeductionClause"><?php echo $ipc_tracking_search->RetentionDeductionClause->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_RetentionDeductionClause" id="z_RetentionDeductionClause" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->RetentionDeductionClause->cellAttributes() ?>>
			<span id="el_ipc_tracking_RetentionDeductionClause" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_RetentionDeductionClause" name="x_RetentionDeductionClause" id="x_RetentionDeductionClause" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_search->RetentionDeductionClause->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->RetentionDeductionClause->EditValue ?>"<?php echo $ipc_tracking_search->RetentionDeductionClause->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->RetentionDeducted->Visible) { // RetentionDeducted ?>
	<div id="r_RetentionDeducted" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_RetentionDeducted"><?php echo $ipc_tracking_search->RetentionDeducted->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RetentionDeducted" id="z_RetentionDeducted" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->RetentionDeducted->cellAttributes() ?>>
			<span id="el_ipc_tracking_RetentionDeducted" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->RetentionDeducted->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_RetentionDeducted" name="x_RetentionDeducted[]" id="x_RetentionDeducted[]_769073" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->RetentionDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x_RetentionDeducted[]_769073"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->LiquidatedDamagesDeducted->Visible) { // LiquidatedDamagesDeducted ?>
	<div id="r_LiquidatedDamagesDeducted" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_LiquidatedDamagesDeducted"><?php echo $ipc_tracking_search->LiquidatedDamagesDeducted->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LiquidatedDamagesDeducted" id="z_LiquidatedDamagesDeducted" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->LiquidatedDamagesDeducted->cellAttributes() ?>>
			<span id="el_ipc_tracking_LiquidatedDamagesDeducted" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->LiquidatedDamagesDeducted->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LiquidatedDamagesDeducted" name="x_LiquidatedDamagesDeducted[]" id="x_LiquidatedDamagesDeducted[]_213785" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->LiquidatedDamagesDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x_LiquidatedDamagesDeducted[]_213785"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->LiquidatedPenaltiesDeducted->Visible) { // LiquidatedPenaltiesDeducted ?>
	<div id="r_LiquidatedPenaltiesDeducted" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_LiquidatedPenaltiesDeducted"><?php echo $ipc_tracking_search->LiquidatedPenaltiesDeducted->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LiquidatedPenaltiesDeducted" id="z_LiquidatedPenaltiesDeducted" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->LiquidatedPenaltiesDeducted->cellAttributes() ?>>
			<span id="el_ipc_tracking_LiquidatedPenaltiesDeducted" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->LiquidatedPenaltiesDeducted->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LiquidatedPenaltiesDeducted" name="x_LiquidatedPenaltiesDeducted[]" id="x_LiquidatedPenaltiesDeducted[]_517575" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->LiquidatedPenaltiesDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x_LiquidatedPenaltiesDeducted[]_517575"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->AdvancedPaymentDeducted->Visible) { // AdvancedPaymentDeducted ?>
	<div id="r_AdvancedPaymentDeducted" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_AdvancedPaymentDeducted"><?php echo $ipc_tracking_search->AdvancedPaymentDeducted->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AdvancedPaymentDeducted" id="z_AdvancedPaymentDeducted" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->AdvancedPaymentDeducted->cellAttributes() ?>>
			<span id="el_ipc_tracking_AdvancedPaymentDeducted" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->AdvancedPaymentDeducted->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_AdvancedPaymentDeducted" name="x_AdvancedPaymentDeducted[]" id="x_AdvancedPaymentDeducted[]_965947" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->AdvancedPaymentDeducted->editAttributes() ?>>
	<label class="custom-control-label" for="x_AdvancedPaymentDeducted[]_965947"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->CurrentProgressReportAttached->Visible) { // CurrentProgressReportAttached ?>
	<div id="r_CurrentProgressReportAttached" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_CurrentProgressReportAttached"><?php echo $ipc_tracking_search->CurrentProgressReportAttached->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CurrentProgressReportAttached" id="z_CurrentProgressReportAttached" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->CurrentProgressReportAttached->cellAttributes() ?>>
			<span id="el_ipc_tracking_CurrentProgressReportAttached" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->CurrentProgressReportAttached->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_CurrentProgressReportAttached" name="x_CurrentProgressReportAttached[]" id="x_CurrentProgressReportAttached[]_163858" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->CurrentProgressReportAttached->editAttributes() ?>>
	<label class="custom-control-label" for="x_CurrentProgressReportAttached[]_163858"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->DateOfSiteInspection->Visible) { // DateOfSiteInspection ?>
	<div id="r_DateOfSiteInspection" class="form-group row">
		<label for="x_DateOfSiteInspection" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_DateOfSiteInspection"><?php echo $ipc_tracking_search->DateOfSiteInspection->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfSiteInspection" id="z_DateOfSiteInspection" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->DateOfSiteInspection->cellAttributes() ?>>
			<span id="el_ipc_tracking_DateOfSiteInspection" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_DateOfSiteInspection" name="x_DateOfSiteInspection" id="x_DateOfSiteInspection" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_search->DateOfSiteInspection->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->DateOfSiteInspection->EditValue ?>"<?php echo $ipc_tracking_search->DateOfSiteInspection->editAttributes() ?>>
<?php if (!$ipc_tracking_search->DateOfSiteInspection->ReadOnly && !$ipc_tracking_search->DateOfSiteInspection->Disabled && !isset($ipc_tracking_search->DateOfSiteInspection->EditAttrs["readonly"]) && !isset($ipc_tracking_search->DateOfSiteInspection->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingsearch", "x_DateOfSiteInspection", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->TimeExtensionAuthorized->Visible) { // TimeExtensionAuthorized ?>
	<div id="r_TimeExtensionAuthorized" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_TimeExtensionAuthorized"><?php echo $ipc_tracking_search->TimeExtensionAuthorized->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TimeExtensionAuthorized" id="z_TimeExtensionAuthorized" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->TimeExtensionAuthorized->cellAttributes() ?>>
			<span id="el_ipc_tracking_TimeExtensionAuthorized" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->TimeExtensionAuthorized->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_TimeExtensionAuthorized" name="x_TimeExtensionAuthorized[]" id="x_TimeExtensionAuthorized[]_251614" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->TimeExtensionAuthorized->editAttributes() ?>>
	<label class="custom-control-label" for="x_TimeExtensionAuthorized[]_251614"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->LabResultsChecked->Visible) { // LabResultsChecked ?>
	<div id="r_LabResultsChecked" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_LabResultsChecked"><?php echo $ipc_tracking_search->LabResultsChecked->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LabResultsChecked" id="z_LabResultsChecked" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->LabResultsChecked->cellAttributes() ?>>
			<span id="el_ipc_tracking_LabResultsChecked" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->LabResultsChecked->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_LabResultsChecked" name="x_LabResultsChecked[]" id="x_LabResultsChecked[]_860147" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->LabResultsChecked->editAttributes() ?>>
	<label class="custom-control-label" for="x_LabResultsChecked[]_860147"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->TerminationNoticeGiven->Visible) { // TerminationNoticeGiven ?>
	<div id="r_TerminationNoticeGiven" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_TerminationNoticeGiven"><?php echo $ipc_tracking_search->TerminationNoticeGiven->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_TerminationNoticeGiven" id="z_TerminationNoticeGiven" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->TerminationNoticeGiven->cellAttributes() ?>>
			<span id="el_ipc_tracking_TerminationNoticeGiven" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->TerminationNoticeGiven->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_TerminationNoticeGiven" name="x_TerminationNoticeGiven[]" id="x_TerminationNoticeGiven[]_655183" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->TerminationNoticeGiven->editAttributes() ?>>
	<label class="custom-control-label" for="x_TerminationNoticeGiven[]_655183"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->CopiesEmailedToMLG->Visible) { // CopiesEmailedToMLG ?>
	<div id="r_CopiesEmailedToMLG" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_CopiesEmailedToMLG"><?php echo $ipc_tracking_search->CopiesEmailedToMLG->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CopiesEmailedToMLG" id="z_CopiesEmailedToMLG" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->CopiesEmailedToMLG->cellAttributes() ?>>
			<span id="el_ipc_tracking_CopiesEmailedToMLG" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->CopiesEmailedToMLG->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_CopiesEmailedToMLG" name="x_CopiesEmailedToMLG[]" id="x_CopiesEmailedToMLG[]_592432" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->CopiesEmailedToMLG->editAttributes() ?>>
	<label class="custom-control-label" for="x_CopiesEmailedToMLG[]_592432"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->ContractStillValid->Visible) { // ContractStillValid ?>
	<div id="r_ContractStillValid" class="form-group row">
		<label class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_ContractStillValid"><?php echo $ipc_tracking_search->ContractStillValid->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ContractStillValid" id="z_ContractStillValid" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->ContractStillValid->cellAttributes() ?>>
			<span id="el_ipc_tracking_ContractStillValid" class="ew-search-field">
<?php
$selwrk = ConvertToBool($ipc_tracking_search->ContractStillValid->AdvancedSearch->SearchValue) ? " checked" : "";
?>
<div class="custom-control custom-checkbox d-inline-block">
	<input type="checkbox" class="custom-control-input" data-table="ipc_tracking" data-field="x_ContractStillValid" name="x_ContractStillValid[]" id="x_ContractStillValid[]_658188" value="1"<?php echo $selwrk ?><?php echo $ipc_tracking_search->ContractStillValid->editAttributes() ?>>
	<label class="custom-control-label" for="x_ContractStillValid[]_658188"></label>
</div>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->DeskOfficer->Visible) { // DeskOfficer ?>
	<div id="r_DeskOfficer" class="form-group row">
		<label for="x_DeskOfficer" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_DeskOfficer"><?php echo $ipc_tracking_search->DeskOfficer->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_DeskOfficer" id="z_DeskOfficer" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->DeskOfficer->cellAttributes() ?>>
			<span id="el_ipc_tracking_DeskOfficer" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_DeskOfficer" name="x_DeskOfficer" id="x_DeskOfficer" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_search->DeskOfficer->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->DeskOfficer->EditValue ?>"<?php echo $ipc_tracking_search->DeskOfficer->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->DeskOfficerDate->Visible) { // DeskOfficerDate ?>
	<div id="r_DeskOfficerDate" class="form-group row">
		<label for="x_DeskOfficerDate" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_DeskOfficerDate"><?php echo $ipc_tracking_search->DeskOfficerDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DeskOfficerDate" id="z_DeskOfficerDate" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->DeskOfficerDate->cellAttributes() ?>>
			<span id="el_ipc_tracking_DeskOfficerDate" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_DeskOfficerDate" name="x_DeskOfficerDate" id="x_DeskOfficerDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_search->DeskOfficerDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->DeskOfficerDate->EditValue ?>"<?php echo $ipc_tracking_search->DeskOfficerDate->editAttributes() ?>>
<?php if (!$ipc_tracking_search->DeskOfficerDate->ReadOnly && !$ipc_tracking_search->DeskOfficerDate->Disabled && !isset($ipc_tracking_search->DeskOfficerDate->EditAttrs["readonly"]) && !isset($ipc_tracking_search->DeskOfficerDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingsearch", "x_DeskOfficerDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->SupervisingEngineer->Visible) { // SupervisingEngineer ?>
	<div id="r_SupervisingEngineer" class="form-group row">
		<label for="x_SupervisingEngineer" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_SupervisingEngineer"><?php echo $ipc_tracking_search->SupervisingEngineer->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SupervisingEngineer" id="z_SupervisingEngineer" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->SupervisingEngineer->cellAttributes() ?>>
			<span id="el_ipc_tracking_SupervisingEngineer" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_SupervisingEngineer" name="x_SupervisingEngineer" id="x_SupervisingEngineer" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_search->SupervisingEngineer->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->SupervisingEngineer->EditValue ?>"<?php echo $ipc_tracking_search->SupervisingEngineer->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->EngineerDate->Visible) { // EngineerDate ?>
	<div id="r_EngineerDate" class="form-group row">
		<label for="x_EngineerDate" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_EngineerDate"><?php echo $ipc_tracking_search->EngineerDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EngineerDate" id="z_EngineerDate" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->EngineerDate->cellAttributes() ?>>
			<span id="el_ipc_tracking_EngineerDate" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_EngineerDate" name="x_EngineerDate" id="x_EngineerDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_search->EngineerDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->EngineerDate->EditValue ?>"<?php echo $ipc_tracking_search->EngineerDate->editAttributes() ?>>
<?php if (!$ipc_tracking_search->EngineerDate->ReadOnly && !$ipc_tracking_search->EngineerDate->Disabled && !isset($ipc_tracking_search->EngineerDate->EditAttrs["readonly"]) && !isset($ipc_tracking_search->EngineerDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingsearch", "x_EngineerDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->CouncilSecretary->Visible) { // CouncilSecretary ?>
	<div id="r_CouncilSecretary" class="form-group row">
		<label for="x_CouncilSecretary" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_CouncilSecretary"><?php echo $ipc_tracking_search->CouncilSecretary->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_CouncilSecretary" id="z_CouncilSecretary" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->CouncilSecretary->cellAttributes() ?>>
			<span id="el_ipc_tracking_CouncilSecretary" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_CouncilSecretary" name="x_CouncilSecretary" id="x_CouncilSecretary" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ipc_tracking_search->CouncilSecretary->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->CouncilSecretary->EditValue ?>"<?php echo $ipc_tracking_search->CouncilSecretary->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->CSDate->Visible) { // CSDate ?>
	<div id="r_CSDate" class="form-group row">
		<label for="x_CSDate" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_CSDate"><?php echo $ipc_tracking_search->CSDate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CSDate" id="z_CSDate" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->CSDate->cellAttributes() ?>>
			<span id="el_ipc_tracking_CSDate" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_CSDate" name="x_CSDate" id="x_CSDate" maxlength="10" placeholder="<?php echo HtmlEncode($ipc_tracking_search->CSDate->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->CSDate->EditValue ?>"<?php echo $ipc_tracking_search->CSDate->editAttributes() ?>>
<?php if (!$ipc_tracking_search->CSDate->ReadOnly && !$ipc_tracking_search->CSDate->Disabled && !isset($ipc_tracking_search->CSDate->EditAttrs["readonly"]) && !isset($ipc_tracking_search->CSDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fipc_trackingsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fipc_trackingsearch", "x_CSDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->MLGComments->Visible) { // MLGComments ?>
	<div id="r_MLGComments" class="form-group row">
		<label for="x_MLGComments" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_MLGComments"><?php echo $ipc_tracking_search->MLGComments->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MLGComments" id="z_MLGComments" value="LIKE">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->MLGComments->cellAttributes() ?>>
			<span id="el_ipc_tracking_MLGComments" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_MLGComments" name="x_MLGComments" id="x_MLGComments" size="35" maxlength="65535" placeholder="<?php echo HtmlEncode($ipc_tracking_search->MLGComments->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->MLGComments->EditValue ?>"<?php echo $ipc_tracking_search->MLGComments->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($ipc_tracking_search->ContractType->Visible) { // ContractType ?>
	<div id="r_ContractType" class="form-group row">
		<label for="x_ContractType" class="<?php echo $ipc_tracking_search->LeftColumnClass ?>"><span id="elh_ipc_tracking_ContractType"><?php echo $ipc_tracking_search->ContractType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ContractType" id="z_ContractType" value="=">
</span>
		</label>
		<div class="<?php echo $ipc_tracking_search->RightColumnClass ?>"><div <?php echo $ipc_tracking_search->ContractType->cellAttributes() ?>>
			<span id="el_ipc_tracking_ContractType" class="ew-search-field">
<input type="text" data-table="ipc_tracking" data-field="x_ContractType" name="x_ContractType" id="x_ContractType" size="30" maxlength="3" placeholder="<?php echo HtmlEncode($ipc_tracking_search->ContractType->getPlaceHolder()) ?>" value="<?php echo $ipc_tracking_search->ContractType->EditValue ?>"<?php echo $ipc_tracking_search->ContractType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ipc_tracking_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ipc_tracking_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ipc_tracking_search->showPageFooter();
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
$ipc_tracking_search->terminate();
?>