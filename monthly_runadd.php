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
$monthly_run_add = new monthly_run_add();

// Run the page
$monthly_run_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$monthly_run_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmonthly_runadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmonthly_runadd = currentForm = new ew.Form("fmonthly_runadd", "add");

	// Validate form
	fmonthly_runadd.validate = function() {
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
			<?php if ($monthly_run_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_add->LACode->caption(), $monthly_run_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($monthly_run_add->PeriodCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_add->PeriodCode->caption(), $monthly_run_add->PeriodCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($monthly_run_add->RunDate->Required) { ?>
				elm = this.getElements("x" + infix + "_RunDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_add->RunDate->caption(), $monthly_run_add->RunDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RunDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($monthly_run_add->RunDate->errorMessage()) ?>");
			<?php if ($monthly_run_add->Description->Required) { ?>
				elm = this.getElements("x" + infix + "_Description");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_add->Description->caption(), $monthly_run_add->Description->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($monthly_run_add->Year->Required) { ?>
				elm = this.getElements("x" + infix + "_Year");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_add->Year->caption(), $monthly_run_add->Year->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($monthly_run_add->RunMonth->Required) { ?>
				elm = this.getElements("x" + infix + "_RunMonth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_add->RunMonth->caption(), $monthly_run_add->RunMonth->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($monthly_run_add->PayrollCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PayrollCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $monthly_run_add->PayrollCode->caption(), $monthly_run_add->PayrollCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PayrollCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($monthly_run_add->PayrollCode->errorMessage()) ?>");

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
	fmonthly_runadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmonthly_runadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmonthly_runadd.lists["x_LACode"] = <?php echo $monthly_run_add->LACode->Lookup->toClientList($monthly_run_add) ?>;
	fmonthly_runadd.lists["x_LACode"].options = <?php echo JsonEncode($monthly_run_add->LACode->lookupOptions()) ?>;
	fmonthly_runadd.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fmonthly_runadd.lists["x_PeriodCode"] = <?php echo $monthly_run_add->PeriodCode->Lookup->toClientList($monthly_run_add) ?>;
	fmonthly_runadd.lists["x_PeriodCode"].options = <?php echo JsonEncode($monthly_run_add->PeriodCode->lookupOptions()) ?>;
	fmonthly_runadd.lists["x_Year"] = <?php echo $monthly_run_add->Year->Lookup->toClientList($monthly_run_add) ?>;
	fmonthly_runadd.lists["x_Year"].options = <?php echo JsonEncode($monthly_run_add->Year->lookupOptions()) ?>;
	fmonthly_runadd.lists["x_RunMonth"] = <?php echo $monthly_run_add->RunMonth->Lookup->toClientList($monthly_run_add) ?>;
	fmonthly_runadd.lists["x_RunMonth"].options = <?php echo JsonEncode($monthly_run_add->RunMonth->lookupOptions()) ?>;
	loadjs.done("fmonthly_runadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $monthly_run_add->showPageHeader(); ?>
<?php
$monthly_run_add->showMessage();
?>
<form name="fmonthly_runadd" id="fmonthly_runadd" class="<?php echo $monthly_run_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="monthly_run">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$monthly_run_add->IsModal ?>">
<?php if ($monthly_run->getCurrentMasterTable() == "payroll_period") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="payroll_period">
<input type="hidden" name="fk_PeriodCode" value="<?php echo HtmlEncode($monthly_run_add->PeriodCode->getSessionValue()) ?>">
<input type="hidden" name="fk_FiscalYear" value="<?php echo HtmlEncode($monthly_run_add->Year->getSessionValue()) ?>">
<input type="hidden" name="fk_RunMonth" value="<?php echo HtmlEncode($monthly_run_add->RunMonth->getSessionValue()) ?>">
<?php } ?>
<?php if ($monthly_run->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($monthly_run_add->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($monthly_run_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_monthly_run_LACode" class="<?php echo $monthly_run_add->LeftColumnClass ?>"><?php echo $monthly_run_add->LACode->caption() ?><?php echo $monthly_run_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $monthly_run_add->RightColumnClass ?>"><div <?php echo $monthly_run_add->LACode->cellAttributes() ?>>
<?php if ($monthly_run_add->LACode->getSessionValue() != "") { ?>
<span id="el_monthly_run_LACode">
<span<?php echo $monthly_run_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($monthly_run_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_monthly_run_LACode">
<?php
$onchange = $monthly_run_add->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$monthly_run_add->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($monthly_run_add->LACode->EditValue) ?>" size="50" maxlength="50" placeholder="<?php echo HtmlEncode($monthly_run_add->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($monthly_run_add->LACode->getPlaceHolder()) ?>"<?php echo $monthly_run_add->LACode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($monthly_run_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($monthly_run_add->LACode->ReadOnly || $monthly_run_add->LACode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="monthly_run" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $monthly_run_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($monthly_run_add->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fmonthly_runadd"], function() {
	fmonthly_runadd.createAutoSuggest({"id":"x_LACode","forceSelect":true});
});
</script>
<?php echo $monthly_run_add->LACode->Lookup->getParamTag($monthly_run_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $monthly_run_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_add->PeriodCode->Visible) { // PeriodCode ?>
	<div id="r_PeriodCode" class="form-group row">
		<label id="elh_monthly_run_PeriodCode" for="x_PeriodCode" class="<?php echo $monthly_run_add->LeftColumnClass ?>"><?php echo $monthly_run_add->PeriodCode->caption() ?><?php echo $monthly_run_add->PeriodCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $monthly_run_add->RightColumnClass ?>"><div <?php echo $monthly_run_add->PeriodCode->cellAttributes() ?>>
<?php if ($monthly_run_add->PeriodCode->getSessionValue() != "") { ?>
<span id="el_monthly_run_PeriodCode">
<span<?php echo $monthly_run_add->PeriodCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_add->PeriodCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_PeriodCode" name="x_PeriodCode" value="<?php echo HtmlEncode($monthly_run_add->PeriodCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_monthly_run_PeriodCode">
<?php $monthly_run_add->PeriodCode->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_PeriodCode" data-value-separator="<?php echo $monthly_run_add->PeriodCode->displayValueSeparatorAttribute() ?>" id="x_PeriodCode" name="x_PeriodCode"<?php echo $monthly_run_add->PeriodCode->editAttributes() ?>>
			<?php echo $monthly_run_add->PeriodCode->selectOptionListHtml("x_PeriodCode") ?>
		</select>
</div>
<?php echo $monthly_run_add->PeriodCode->Lookup->getParamTag($monthly_run_add, "p_x_PeriodCode") ?>
</span>
<?php } ?>
<?php echo $monthly_run_add->PeriodCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_add->RunDate->Visible) { // RunDate ?>
	<div id="r_RunDate" class="form-group row">
		<label id="elh_monthly_run_RunDate" for="x_RunDate" class="<?php echo $monthly_run_add->LeftColumnClass ?>"><?php echo $monthly_run_add->RunDate->caption() ?><?php echo $monthly_run_add->RunDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $monthly_run_add->RightColumnClass ?>"><div <?php echo $monthly_run_add->RunDate->cellAttributes() ?>>
<span id="el_monthly_run_RunDate">
<input type="text" data-table="monthly_run" data-field="x_RunDate" name="x_RunDate" id="x_RunDate" placeholder="<?php echo HtmlEncode($monthly_run_add->RunDate->getPlaceHolder()) ?>" value="<?php echo $monthly_run_add->RunDate->EditValue ?>"<?php echo $monthly_run_add->RunDate->editAttributes() ?>>
<?php if (!$monthly_run_add->RunDate->ReadOnly && !$monthly_run_add->RunDate->Disabled && !isset($monthly_run_add->RunDate->EditAttrs["readonly"]) && !isset($monthly_run_add->RunDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmonthly_runadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fmonthly_runadd", "x_RunDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $monthly_run_add->RunDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_add->Description->Visible) { // Description ?>
	<div id="r_Description" class="form-group row">
		<label id="elh_monthly_run_Description" for="x_Description" class="<?php echo $monthly_run_add->LeftColumnClass ?>"><?php echo $monthly_run_add->Description->caption() ?><?php echo $monthly_run_add->Description->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $monthly_run_add->RightColumnClass ?>"><div <?php echo $monthly_run_add->Description->cellAttributes() ?>>
<span id="el_monthly_run_Description">
<input type="text" data-table="monthly_run" data-field="x_Description" name="x_Description" id="x_Description" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($monthly_run_add->Description->getPlaceHolder()) ?>" value="<?php echo $monthly_run_add->Description->EditValue ?>"<?php echo $monthly_run_add->Description->editAttributes() ?>>
</span>
<?php echo $monthly_run_add->Description->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_add->Year->Visible) { // Year ?>
	<div id="r_Year" class="form-group row">
		<label id="elh_monthly_run_Year" for="x_Year" class="<?php echo $monthly_run_add->LeftColumnClass ?>"><?php echo $monthly_run_add->Year->caption() ?><?php echo $monthly_run_add->Year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $monthly_run_add->RightColumnClass ?>"><div <?php echo $monthly_run_add->Year->cellAttributes() ?>>
<?php if ($monthly_run_add->Year->getSessionValue() != "") { ?>
<span id="el_monthly_run_Year">
<span<?php echo $monthly_run_add->Year->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_add->Year->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_Year" name="x_Year" value="<?php echo HtmlEncode($monthly_run_add->Year->CurrentValue) ?>">
<?php } else { ?>
<span id="el_monthly_run_Year">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_Year" data-value-separator="<?php echo $monthly_run_add->Year->displayValueSeparatorAttribute() ?>" id="x_Year" name="x_Year"<?php echo $monthly_run_add->Year->editAttributes() ?>>
			<?php echo $monthly_run_add->Year->selectOptionListHtml("x_Year") ?>
		</select>
</div>
<?php echo $monthly_run_add->Year->Lookup->getParamTag($monthly_run_add, "p_x_Year") ?>
</span>
<?php } ?>
<?php echo $monthly_run_add->Year->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_add->RunMonth->Visible) { // RunMonth ?>
	<div id="r_RunMonth" class="form-group row">
		<label id="elh_monthly_run_RunMonth" for="x_RunMonth" class="<?php echo $monthly_run_add->LeftColumnClass ?>"><?php echo $monthly_run_add->RunMonth->caption() ?><?php echo $monthly_run_add->RunMonth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $monthly_run_add->RightColumnClass ?>"><div <?php echo $monthly_run_add->RunMonth->cellAttributes() ?>>
<?php if ($monthly_run_add->RunMonth->getSessionValue() != "") { ?>
<span id="el_monthly_run_RunMonth">
<span<?php echo $monthly_run_add->RunMonth->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($monthly_run_add->RunMonth->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_RunMonth" name="x_RunMonth" value="<?php echo HtmlEncode($monthly_run_add->RunMonth->CurrentValue) ?>">
<?php } else { ?>
<span id="el_monthly_run_RunMonth">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="monthly_run" data-field="x_RunMonth" data-value-separator="<?php echo $monthly_run_add->RunMonth->displayValueSeparatorAttribute() ?>" id="x_RunMonth" name="x_RunMonth"<?php echo $monthly_run_add->RunMonth->editAttributes() ?>>
			<?php echo $monthly_run_add->RunMonth->selectOptionListHtml("x_RunMonth") ?>
		</select>
</div>
<?php echo $monthly_run_add->RunMonth->Lookup->getParamTag($monthly_run_add, "p_x_RunMonth") ?>
</span>
<?php } ?>
<?php echo $monthly_run_add->RunMonth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($monthly_run_add->PayrollCode->Visible) { // PayrollCode ?>
	<div id="r_PayrollCode" class="form-group row">
		<label id="elh_monthly_run_PayrollCode" for="x_PayrollCode" class="<?php echo $monthly_run_add->LeftColumnClass ?>"><?php echo $monthly_run_add->PayrollCode->caption() ?><?php echo $monthly_run_add->PayrollCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $monthly_run_add->RightColumnClass ?>"><div <?php echo $monthly_run_add->PayrollCode->cellAttributes() ?>>
<span id="el_monthly_run_PayrollCode">
<input type="text" data-table="monthly_run" data-field="x_PayrollCode" name="x_PayrollCode" id="x_PayrollCode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($monthly_run_add->PayrollCode->getPlaceHolder()) ?>" value="<?php echo $monthly_run_add->PayrollCode->EditValue ?>"<?php echo $monthly_run_add->PayrollCode->editAttributes() ?>>
</span>
<?php echo $monthly_run_add->PayrollCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$monthly_run_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $monthly_run_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $monthly_run_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$monthly_run_add->showPageFooter();
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
$monthly_run_add->terminate();
?>