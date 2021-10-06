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
$payroll_period_add = new payroll_period_add();

// Run the page
$payroll_period_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_period_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayroll_periodadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpayroll_periodadd = currentForm = new ew.Form("fpayroll_periodadd", "add");

	// Validate form
	fpayroll_periodadd.validate = function() {
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
			<?php if ($payroll_period_add->FiscalYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FiscalYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_add->FiscalYear->caption(), $payroll_period_add->FiscalYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FiscalYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payroll_period_add->FiscalYear->errorMessage()) ?>");
			<?php if ($payroll_period_add->RunMonth->Required) { ?>
				elm = this.getElements("x" + infix + "_RunMonth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_add->RunMonth->caption(), $payroll_period_add->RunMonth->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_period_add->RunDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_RunDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_add->RunDescription->caption(), $payroll_period_add->RunDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_period_add->CurrentPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_period_add->CurrentPeriod->caption(), $payroll_period_add->CurrentPeriod->RequiredErrorMessage)) ?>");
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
	fpayroll_periodadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayroll_periodadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpayroll_periodadd.lists["x_FiscalYear"] = <?php echo $payroll_period_add->FiscalYear->Lookup->toClientList($payroll_period_add) ?>;
	fpayroll_periodadd.lists["x_FiscalYear"].options = <?php echo JsonEncode($payroll_period_add->FiscalYear->lookupOptions()) ?>;
	fpayroll_periodadd.autoSuggests["x_FiscalYear"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fpayroll_periodadd.lists["x_RunMonth"] = <?php echo $payroll_period_add->RunMonth->Lookup->toClientList($payroll_period_add) ?>;
	fpayroll_periodadd.lists["x_RunMonth"].options = <?php echo JsonEncode($payroll_period_add->RunMonth->lookupOptions()) ?>;
	fpayroll_periodadd.lists["x_CurrentPeriod"] = <?php echo $payroll_period_add->CurrentPeriod->Lookup->toClientList($payroll_period_add) ?>;
	fpayroll_periodadd.lists["x_CurrentPeriod"].options = <?php echo JsonEncode($payroll_period_add->CurrentPeriod->lookupOptions()) ?>;
	loadjs.done("fpayroll_periodadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payroll_period_add->showPageHeader(); ?>
<?php
$payroll_period_add->showMessage();
?>
<form name="fpayroll_periodadd" id="fpayroll_periodadd" class="<?php echo $payroll_period_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_period">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$payroll_period_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($payroll_period_add->FiscalYear->Visible) { // FiscalYear ?>
	<div id="r_FiscalYear" class="form-group row">
		<label id="elh_payroll_period_FiscalYear" class="<?php echo $payroll_period_add->LeftColumnClass ?>"><?php echo $payroll_period_add->FiscalYear->caption() ?><?php echo $payroll_period_add->FiscalYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_period_add->RightColumnClass ?>"><div <?php echo $payroll_period_add->FiscalYear->cellAttributes() ?>>
<span id="el_payroll_period_FiscalYear">
<?php
$onchange = $payroll_period_add->FiscalYear->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$payroll_period_add->FiscalYear->EditAttrs["onchange"] = "";
?>
<span id="as_x_FiscalYear">
	<input type="text" class="form-control" name="sv_x_FiscalYear" id="sv_x_FiscalYear" value="<?php echo RemoveHtml($payroll_period_add->FiscalYear->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($payroll_period_add->FiscalYear->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($payroll_period_add->FiscalYear->getPlaceHolder()) ?>"<?php echo $payroll_period_add->FiscalYear->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_period" data-field="x_FiscalYear" data-value-separator="<?php echo $payroll_period_add->FiscalYear->displayValueSeparatorAttribute() ?>" name="x_FiscalYear" id="x_FiscalYear" value="<?php echo HtmlEncode($payroll_period_add->FiscalYear->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpayroll_periodadd"], function() {
	fpayroll_periodadd.createAutoSuggest({"id":"x_FiscalYear","forceSelect":false});
});
</script>
<?php echo $payroll_period_add->FiscalYear->Lookup->getParamTag($payroll_period_add, "p_x_FiscalYear") ?>
</span>
<?php echo $payroll_period_add->FiscalYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_period_add->RunMonth->Visible) { // RunMonth ?>
	<div id="r_RunMonth" class="form-group row">
		<label id="elh_payroll_period_RunMonth" for="x_RunMonth" class="<?php echo $payroll_period_add->LeftColumnClass ?>"><?php echo $payroll_period_add->RunMonth->caption() ?><?php echo $payroll_period_add->RunMonth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_period_add->RightColumnClass ?>"><div <?php echo $payroll_period_add->RunMonth->cellAttributes() ?>>
<span id="el_payroll_period_RunMonth">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="payroll_period" data-field="x_RunMonth" data-value-separator="<?php echo $payroll_period_add->RunMonth->displayValueSeparatorAttribute() ?>" id="x_RunMonth" name="x_RunMonth"<?php echo $payroll_period_add->RunMonth->editAttributes() ?>>
			<?php echo $payroll_period_add->RunMonth->selectOptionListHtml("x_RunMonth") ?>
		</select>
</div>
<?php echo $payroll_period_add->RunMonth->Lookup->getParamTag($payroll_period_add, "p_x_RunMonth") ?>
</span>
<?php echo $payroll_period_add->RunMonth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_period_add->RunDescription->Visible) { // RunDescription ?>
	<div id="r_RunDescription" class="form-group row">
		<label id="elh_payroll_period_RunDescription" for="x_RunDescription" class="<?php echo $payroll_period_add->LeftColumnClass ?>"><?php echo $payroll_period_add->RunDescription->caption() ?><?php echo $payroll_period_add->RunDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_period_add->RightColumnClass ?>"><div <?php echo $payroll_period_add->RunDescription->cellAttributes() ?>>
<span id="el_payroll_period_RunDescription">
<textarea data-table="payroll_period" data-field="x_RunDescription" name="x_RunDescription" id="x_RunDescription" cols="35" rows="2" placeholder="<?php echo HtmlEncode($payroll_period_add->RunDescription->getPlaceHolder()) ?>"<?php echo $payroll_period_add->RunDescription->editAttributes() ?>><?php echo $payroll_period_add->RunDescription->EditValue ?></textarea>
</span>
<?php echo $payroll_period_add->RunDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_period_add->CurrentPeriod->Visible) { // CurrentPeriod ?>
	<div id="r_CurrentPeriod" class="form-group row">
		<label id="elh_payroll_period_CurrentPeriod" class="<?php echo $payroll_period_add->LeftColumnClass ?>"><?php echo $payroll_period_add->CurrentPeriod->caption() ?><?php echo $payroll_period_add->CurrentPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_period_add->RightColumnClass ?>"><div <?php echo $payroll_period_add->CurrentPeriod->cellAttributes() ?>>
<span id="el_payroll_period_CurrentPeriod">
<div id="tp_x_CurrentPeriod" class="ew-template"><input type="radio" class="custom-control-input" data-table="payroll_period" data-field="x_CurrentPeriod" data-value-separator="<?php echo $payroll_period_add->CurrentPeriod->displayValueSeparatorAttribute() ?>" name="x_CurrentPeriod" id="x_CurrentPeriod" value="{value}"<?php echo $payroll_period_add->CurrentPeriod->editAttributes() ?>></div>
<div id="dsl_x_CurrentPeriod" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $payroll_period_add->CurrentPeriod->radioButtonListHtml(FALSE, "x_CurrentPeriod") ?>
</div></div>
<?php echo $payroll_period_add->CurrentPeriod->Lookup->getParamTag($payroll_period_add, "p_x_CurrentPeriod") ?>
</span>
<?php echo $payroll_period_add->CurrentPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("employee_employer_schedule_view", explode(",", $payroll_period->getCurrentDetailTable())) && $employee_employer_schedule_view->DetailAdd) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("employee_employer_schedule_view", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "employee_employer_schedule_viewgrid.php" ?>
<?php } ?>
<?php
	if (in_array("obligation_schedule_view", explode(",", $payroll_period->getCurrentDetailTable())) && $obligation_schedule_view->DetailAdd) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("obligation_schedule_view", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "obligation_schedule_viewgrid.php" ?>
<?php } ?>
<?php
	if (in_array("deduction_schedule_view", explode(",", $payroll_period->getCurrentDetailTable())) && $deduction_schedule_view->DetailAdd) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("deduction_schedule_view", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "deduction_schedule_viewgrid.php" ?>
<?php } ?>
<?php
	if (in_array("income_schedule_view", explode(",", $payroll_period->getCurrentDetailTable())) && $income_schedule_view->DetailAdd) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("income_schedule_view", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "income_schedule_viewgrid.php" ?>
<?php } ?>
<?php
	if (in_array("monthly_run", explode(",", $payroll_period->getCurrentDetailTable())) && $monthly_run->DetailAdd) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("monthly_run", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "monthly_rungrid.php" ?>
<?php } ?>
<?php
	if (in_array("payroll_summary_view", explode(",", $payroll_period->getCurrentDetailTable())) && $payroll_summary_view->DetailAdd) {
?>
<?php if ($payroll_period->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("payroll_summary_view", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "payroll_summary_viewgrid.php" ?>
<?php } ?>
<?php if (!$payroll_period_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payroll_period_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payroll_period_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$payroll_period_add->showPageFooter();
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
$payroll_period_add->terminate();
?>