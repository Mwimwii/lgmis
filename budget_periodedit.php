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
$budget_period_edit = new budget_period_edit();

// Run the page
$budget_period_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$budget_period_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbudget_periodedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbudget_periodedit = currentForm = new ew.Form("fbudget_periodedit", "edit");

	// Validate form
	fbudget_periodedit.validate = function() {
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
			<?php if ($budget_period_edit->FiscalYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FiscalYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_period_edit->FiscalYear->caption(), $budget_period_edit->FiscalYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FiscalYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_period_edit->FiscalYear->errorMessage()) ?>");
			<?php if ($budget_period_edit->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_period_edit->StartDate->caption(), $budget_period_edit->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_period_edit->StartDate->errorMessage()) ?>");
			<?php if ($budget_period_edit->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_period_edit->EndDate->caption(), $budget_period_edit->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($budget_period_edit->EndDate->errorMessage()) ?>");
			<?php if ($budget_period_edit->CurrentPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_period_edit->CurrentPeriod->caption(), $budget_period_edit->CurrentPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($budget_period_edit->PeriodDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $budget_period_edit->PeriodDescription->caption(), $budget_period_edit->PeriodDescription->RequiredErrorMessage)) ?>");
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
	fbudget_periodedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbudget_periodedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbudget_periodedit.lists["x_CurrentPeriod"] = <?php echo $budget_period_edit->CurrentPeriod->Lookup->toClientList($budget_period_edit) ?>;
	fbudget_periodedit.lists["x_CurrentPeriod"].options = <?php echo JsonEncode($budget_period_edit->CurrentPeriod->lookupOptions()) ?>;
	loadjs.done("fbudget_periodedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $budget_period_edit->showPageHeader(); ?>
<?php
$budget_period_edit->showMessage();
?>
<?php if (!$budget_period_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $budget_period_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fbudget_periodedit" id="fbudget_periodedit" class="<?php echo $budget_period_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="budget_period">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$budget_period_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($budget_period_edit->FiscalYear->Visible) { // FiscalYear ?>
	<div id="r_FiscalYear" class="form-group row">
		<label id="elh_budget_period_FiscalYear" for="x_FiscalYear" class="<?php echo $budget_period_edit->LeftColumnClass ?>"><?php echo $budget_period_edit->FiscalYear->caption() ?><?php echo $budget_period_edit->FiscalYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_period_edit->RightColumnClass ?>"><div <?php echo $budget_period_edit->FiscalYear->cellAttributes() ?>>
<input type="text" data-table="budget_period" data-field="x_FiscalYear" name="x_FiscalYear" id="x_FiscalYear" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($budget_period_edit->FiscalYear->getPlaceHolder()) ?>" value="<?php echo $budget_period_edit->FiscalYear->EditValue ?>"<?php echo $budget_period_edit->FiscalYear->editAttributes() ?>>
<input type="hidden" data-table="budget_period" data-field="x_FiscalYear" name="o_FiscalYear" id="o_FiscalYear" value="<?php echo HtmlEncode($budget_period_edit->FiscalYear->OldValue != null ? $budget_period_edit->FiscalYear->OldValue : $budget_period_edit->FiscalYear->CurrentValue) ?>">
<?php echo $budget_period_edit->FiscalYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_period_edit->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_budget_period_StartDate" for="x_StartDate" class="<?php echo $budget_period_edit->LeftColumnClass ?>"><?php echo $budget_period_edit->StartDate->caption() ?><?php echo $budget_period_edit->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_period_edit->RightColumnClass ?>"><div <?php echo $budget_period_edit->StartDate->cellAttributes() ?>>
<span id="el_budget_period_StartDate">
<input type="text" data-table="budget_period" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" maxlength="10" placeholder="<?php echo HtmlEncode($budget_period_edit->StartDate->getPlaceHolder()) ?>" value="<?php echo $budget_period_edit->StartDate->EditValue ?>"<?php echo $budget_period_edit->StartDate->editAttributes() ?>>
<?php if (!$budget_period_edit->StartDate->ReadOnly && !$budget_period_edit->StartDate->Disabled && !isset($budget_period_edit->StartDate->EditAttrs["readonly"]) && !isset($budget_period_edit->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbudget_periodedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbudget_periodedit", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $budget_period_edit->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_period_edit->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_budget_period_EndDate" for="x_EndDate" class="<?php echo $budget_period_edit->LeftColumnClass ?>"><?php echo $budget_period_edit->EndDate->caption() ?><?php echo $budget_period_edit->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_period_edit->RightColumnClass ?>"><div <?php echo $budget_period_edit->EndDate->cellAttributes() ?>>
<span id="el_budget_period_EndDate">
<input type="text" data-table="budget_period" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" maxlength="10" placeholder="<?php echo HtmlEncode($budget_period_edit->EndDate->getPlaceHolder()) ?>" value="<?php echo $budget_period_edit->EndDate->EditValue ?>"<?php echo $budget_period_edit->EndDate->editAttributes() ?>>
<?php if (!$budget_period_edit->EndDate->ReadOnly && !$budget_period_edit->EndDate->Disabled && !isset($budget_period_edit->EndDate->EditAttrs["readonly"]) && !isset($budget_period_edit->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbudget_periodedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbudget_periodedit", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $budget_period_edit->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_period_edit->CurrentPeriod->Visible) { // CurrentPeriod ?>
	<div id="r_CurrentPeriod" class="form-group row">
		<label id="elh_budget_period_CurrentPeriod" for="x_CurrentPeriod" class="<?php echo $budget_period_edit->LeftColumnClass ?>"><?php echo $budget_period_edit->CurrentPeriod->caption() ?><?php echo $budget_period_edit->CurrentPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_period_edit->RightColumnClass ?>"><div <?php echo $budget_period_edit->CurrentPeriod->cellAttributes() ?>>
<span id="el_budget_period_CurrentPeriod">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="budget_period" data-field="x_CurrentPeriod" data-value-separator="<?php echo $budget_period_edit->CurrentPeriod->displayValueSeparatorAttribute() ?>" id="x_CurrentPeriod" name="x_CurrentPeriod"<?php echo $budget_period_edit->CurrentPeriod->editAttributes() ?>>
			<?php echo $budget_period_edit->CurrentPeriod->selectOptionListHtml("x_CurrentPeriod") ?>
		</select>
</div>
<?php echo $budget_period_edit->CurrentPeriod->Lookup->getParamTag($budget_period_edit, "p_x_CurrentPeriod") ?>
</span>
<?php echo $budget_period_edit->CurrentPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($budget_period_edit->PeriodDescription->Visible) { // PeriodDescription ?>
	<div id="r_PeriodDescription" class="form-group row">
		<label id="elh_budget_period_PeriodDescription" for="x_PeriodDescription" class="<?php echo $budget_period_edit->LeftColumnClass ?>"><?php echo $budget_period_edit->PeriodDescription->caption() ?><?php echo $budget_period_edit->PeriodDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $budget_period_edit->RightColumnClass ?>"><div <?php echo $budget_period_edit->PeriodDescription->cellAttributes() ?>>
<span id="el_budget_period_PeriodDescription">
<input type="text" data-table="budget_period" data-field="x_PeriodDescription" name="x_PeriodDescription" id="x_PeriodDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($budget_period_edit->PeriodDescription->getPlaceHolder()) ?>" value="<?php echo $budget_period_edit->PeriodDescription->EditValue ?>"<?php echo $budget_period_edit->PeriodDescription->editAttributes() ?>>
</span>
<?php echo $budget_period_edit->PeriodDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$budget_period_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $budget_period_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $budget_period_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$budget_period_edit->IsModal) { ?>
<?php echo $budget_period_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$budget_period_edit->showPageFooter();
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
$budget_period_edit->terminate();
?>