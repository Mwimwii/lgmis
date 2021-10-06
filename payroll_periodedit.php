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
$payroll_period_edit = new payroll_period_edit();

// Run the page
$payroll_period_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_period_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayroll_periodedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpayroll_periodedit = currentForm = new ew.Form("fpayroll_periodedit", "edit");

	// Validate form
	fpayroll_periodedit.validate = function() {
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
			<?php if ($payroll_period_edit->PeriodCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_edit->PeriodCode->caption(), $payroll_period_edit->PeriodCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_period_edit->FiscalYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FiscalYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_edit->FiscalYear->caption(), $payroll_period_edit->FiscalYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FiscalYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payroll_period_edit->FiscalYear->errorMessage()) ?>");
			<?php if ($payroll_period_edit->RunMonth->Required) { ?>
				elm = this.getElements("x" + infix + "_RunMonth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_edit->RunMonth->caption(), $payroll_period_edit->RunMonth->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_period_edit->RunDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_RunDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_edit->RunDescription->caption(), $payroll_period_edit->RunDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_period_edit->CurrentPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_edit->CurrentPeriod->caption(), $payroll_period_edit->CurrentPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>

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
	fpayroll_periodedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayroll_periodedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpayroll_periodedit.lists["x_FiscalYear"] = <?php echo $payroll_period_edit->FiscalYear->Lookup->toClientList($payroll_period_edit) ?>;
	fpayroll_periodedit.lists["x_FiscalYear"].options = <?php echo JsonEncode($payroll_period_edit->FiscalYear->lookupOptions()) ?>;
	fpayroll_periodedit.autoSuggests["x_FiscalYear"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpayroll_periodedit.lists["x_RunMonth"] = <?php echo $payroll_period_edit->RunMonth->Lookup->toClientList($payroll_period_edit) ?>;
	fpayroll_periodedit.lists["x_RunMonth"].options = <?php echo JsonEncode($payroll_period_edit->RunMonth->lookupOptions()) ?>;
	fpayroll_periodedit.lists["x_CurrentPeriod"] = <?php echo $payroll_period_edit->CurrentPeriod->Lookup->toClientList($payroll_period_edit) ?>;
	fpayroll_periodedit.lists["x_CurrentPeriod"].options = <?php echo JsonEncode($payroll_period_edit->CurrentPeriod->lookupOptions()) ?>;
	loadjs.done("fpayroll_periodedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payroll_period_edit->showPageHeader(); ?>
<?php
$payroll_period_edit->showMessage();
?>
<?php if (!$payroll_period_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_period_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fpayroll_periodedit" id="fpayroll_periodedit" class="<?php echo $payroll_period_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_period">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$payroll_period_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($payroll_period_edit->PeriodCode->Visible) { // PeriodCode ?>
	<div id="r_PeriodCode" class="form-group row">
		<label id="elh_payroll_period_PeriodCode" class="<?php echo $payroll_period_edit->LeftColumnClass ?>"><?php echo $payroll_period_edit->PeriodCode->caption() ?><?php echo $payroll_period_edit->PeriodCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_period_edit->RightColumnClass ?>"><div <?php echo $payroll_period_edit->PeriodCode->cellAttributes() ?>>
<span id="el_payroll_period_PeriodCode">
<span<?php echo $payroll_period_edit->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($payroll_period_edit->PeriodCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="payroll_period" data-field="x_PeriodCode" name="x_PeriodCode" id="x_PeriodCode" value="<?php echo HtmlEncode($payroll_period_edit->PeriodCode->CurrentValue) ?>">
<?php echo $payroll_period_edit->PeriodCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_period_edit->FiscalYear->Visible) { // FiscalYear ?>
	<div id="r_FiscalYear" class="form-group row">
		<label id="elh_payroll_period_FiscalYear" class="<?php echo $payroll_period_edit->LeftColumnClass ?>"><?php echo $payroll_period_edit->FiscalYear->caption() ?><?php echo $payroll_period_edit->FiscalYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_period_edit->RightColumnClass ?>"><div <?php echo $payroll_period_edit->FiscalYear->cellAttributes() ?>>
<span id="el_payroll_period_FiscalYear">
<?php
$onchange = $payroll_period_edit->FiscalYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$payroll_period_edit->FiscalYear->EditAttrs["onchange"] = "";
?>
<span id="as_x_FiscalYear">
	<input type="text" class="form-control" name="sv_x_FiscalYear" id="sv_x_FiscalYear" value="<?php echo RemoveHtml($payroll_period_edit->FiscalYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($payroll_period_edit->FiscalYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($payroll_period_edit->FiscalYear->getPlaceHolder()) ?>"<?php echo $payroll_period_edit->FiscalYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_period" data-field="x_FiscalYear" data-value-separator="<?php echo $payroll_period_edit->FiscalYear->displayValueSeparatorAttribute() ?>" name="x_FiscalYear" id="x_FiscalYear" value="<?php echo HtmlEncode($payroll_period_edit->FiscalYear->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpayroll_periodedit"], function() {
	fpayroll_periodedit.createAutoSuggest({"id":"x_FiscalYear","forceSelect":false});
});
</script>
<?php echo $payroll_period_edit->FiscalYear->Lookup->getParamTag($payroll_period_edit, "p_x_FiscalYear") ?>
</span>
<?php echo $payroll_period_edit->FiscalYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_period_edit->RunMonth->Visible) { // RunMonth ?>
	<div id="r_RunMonth" class="form-group row">
		<label id="elh_payroll_period_RunMonth" for="x_RunMonth" class="<?php echo $payroll_period_edit->LeftColumnClass ?>"><?php echo $payroll_period_edit->RunMonth->caption() ?><?php echo $payroll_period_edit->RunMonth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_period_edit->RightColumnClass ?>"><div <?php echo $payroll_period_edit->RunMonth->cellAttributes() ?>>
<span id="el_payroll_period_RunMonth">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="payroll_period" data-field="x_RunMonth" data-value-separator="<?php echo $payroll_period_edit->RunMonth->displayValueSeparatorAttribute() ?>" id="x_RunMonth" name="x_RunMonth"<?php echo $payroll_period_edit->RunMonth->editAttributes() ?>>
			<?php echo $payroll_period_edit->RunMonth->selectOptionListHtml("x_RunMonth") ?>
		</select>
</div>
<?php echo $payroll_period_edit->RunMonth->Lookup->getParamTag($payroll_period_edit, "p_x_RunMonth") ?>
</span>
<?php echo $payroll_period_edit->RunMonth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_period_edit->RunDescription->Visible) { // RunDescription ?>
	<div id="r_RunDescription" class="form-group row">
		<label id="elh_payroll_period_RunDescription" for="x_RunDescription" class="<?php echo $payroll_period_edit->LeftColumnClass ?>"><?php echo $payroll_period_edit->RunDescription->caption() ?><?php echo $payroll_period_edit->RunDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_period_edit->RightColumnClass ?>"><div <?php echo $payroll_period_edit->RunDescription->cellAttributes() ?>>
<span id="el_payroll_period_RunDescription">
<textarea data-table="payroll_period" data-field="x_RunDescription" name="x_RunDescription" id="x_RunDescription" cols="35" rows="2" placeholder="<?php echo HtmlEncode($payroll_period_edit->RunDescription->getPlaceHolder()) ?>"<?php echo $payroll_period_edit->RunDescription->editAttributes() ?>><?php echo $payroll_period_edit->RunDescription->EditValue ?></textarea>
</span>
<?php echo $payroll_period_edit->RunDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_period_edit->CurrentPeriod->Visible) { // CurrentPeriod ?>
	<div id="r_CurrentPeriod" class="form-group row">
		<label id="elh_payroll_period_CurrentPeriod" class="<?php echo $payroll_period_edit->LeftColumnClass ?>"><?php echo $payroll_period_edit->CurrentPeriod->caption() ?><?php echo $payroll_period_edit->CurrentPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_period_edit->RightColumnClass ?>"><div <?php echo $payroll_period_edit->CurrentPeriod->cellAttributes() ?>>
<span id="el_payroll_period_CurrentPeriod">
<div id="tp_x_CurrentPeriod" class="ew-template"><input type="radio" class="custom-control-input" data-table="payroll_period" data-field="x_CurrentPeriod" data-value-separator="<?php echo $payroll_period_edit->CurrentPeriod->displayValueSeparatorAttribute() ?>" name="x_CurrentPeriod" id="x_CurrentPeriod" value="{value}"<?php echo $payroll_period_edit->CurrentPeriod->editAttributes() ?>></div>
<div id="dsl_x_CurrentPeriod" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $payroll_period_edit->CurrentPeriod->radioButtonListHtml(FALSE, "x_CurrentPeriod") ?>
</div></div>
<?php echo $payroll_period_edit->CurrentPeriod->Lookup->getParamTag($payroll_period_edit, "p_x_CurrentPeriod") ?>
</span>
<?php echo $payroll_period_edit->CurrentPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("employee_employer_schedule_view", explode(",", $payroll_period->getCurrentDetailTable())) && $employee_employer_schedule_view->DetailEdit) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("employee_employer_schedule_view", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "employee_employer_schedule_viewgrid.php" ?>
<?php } ?>
<?php
	if (in_array("obligation_schedule_view", explode(",", $payroll_period->getCurrentDetailTable())) && $obligation_schedule_view->DetailEdit) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("obligation_schedule_view", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "obligation_schedule_viewgrid.php" ?>
<?php } ?>
<?php
	if (in_array("deduction_schedule_view", explode(",", $payroll_period->getCurrentDetailTable())) && $deduction_schedule_view->DetailEdit) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("deduction_schedule_view", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "deduction_schedule_viewgrid.php" ?>
<?php } ?>
<?php
	if (in_array("income_schedule_view", explode(",", $payroll_period->getCurrentDetailTable())) && $income_schedule_view->DetailEdit) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("income_schedule_view", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "income_schedule_viewgrid.php" ?>
<?php } ?>
<?php
	if (in_array("monthly_run", explode(",", $payroll_period->getCurrentDetailTable())) && $monthly_run->DetailEdit) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("monthly_run", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "monthly_rungrid.php" ?>
<?php } ?>
<?php
	if (in_array("payroll_summary_view", explode(",", $payroll_period->getCurrentDetailTable())) && $payroll_summary_view->DetailEdit) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("payroll_summary_view", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "payroll_summary_viewgrid.php" ?>
<?php } ?>
<?php if (!$payroll_period_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payroll_period_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payroll_period_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$payroll_period_edit->IsModal) { ?>
<?php echo $payroll_period_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$payroll_period_edit->showPageFooter();
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
$payroll_period_edit->terminate();
?>