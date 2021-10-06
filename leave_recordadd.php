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
$leave_record_add = new leave_record_add();

// Run the page
$leave_record_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_record_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_recordadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fleave_recordadd = currentForm = new ew.Form("fleave_recordadd", "add");

	// Validate form
	fleave_recordadd.validate = function() {
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
			<?php if ($leave_record_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_add->EmployeeID->caption(), $leave_record_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_add->EmployeeID->errorMessage()) ?>");
			<?php if ($leave_record_add->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_add->LeaveTypeCode->caption(), $leave_record_add->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_record_add->EffectiveDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EffectiveDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_add->EffectiveDate->caption(), $leave_record_add->EffectiveDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EffectiveDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_add->EffectiveDate->errorMessage()) ?>");
			<?php if ($leave_record_add->OpeningBalance->Required) { ?>
				elm = this.getElements("x" + infix + "_OpeningBalance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_add->OpeningBalance->caption(), $leave_record_add->OpeningBalance->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OpeningBalance");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_add->OpeningBalance->errorMessage()) ?>");
			<?php if ($leave_record_add->LeaveAccrued->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveAccrued");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_add->LeaveAccrued->caption(), $leave_record_add->LeaveAccrued->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveAccrued");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_add->LeaveAccrued->errorMessage()) ?>");
			<?php if ($leave_record_add->LastAccrualDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastAccrualDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_add->LastAccrualDate->caption(), $leave_record_add->LastAccrualDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastAccrualDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_add->LastAccrualDate->errorMessage()) ?>");

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
	fleave_recordadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_recordadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_recordadd.lists["x_LeaveTypeCode"] = <?php echo $leave_record_add->LeaveTypeCode->Lookup->toClientList($leave_record_add) ?>;
	fleave_recordadd.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_record_add->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_recordadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_record_add->showPageHeader(); ?>
<?php
$leave_record_add->showMessage();
?>
<form name="fleave_recordadd" id="fleave_recordadd" class="<?php echo $leave_record_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_record">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$leave_record_add->IsModal ?>">
<?php if ($leave_record->getCurrentMasterTable() == "employment") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="employment">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($leave_record_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($leave_record_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_leave_record_EmployeeID" for="x_EmployeeID" class="<?php echo $leave_record_add->LeftColumnClass ?>"><?php echo $leave_record_add->EmployeeID->caption() ?><?php echo $leave_record_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_record_add->RightColumnClass ?>"><div <?php echo $leave_record_add->EmployeeID->cellAttributes() ?>>
<?php if ($leave_record_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_leave_record_EmployeeID">
<span<?php echo $leave_record_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($leave_record_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_leave_record_EmployeeID">
<input type="text" data-table="leave_record" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_record_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_record_add->EmployeeID->EditValue ?>"<?php echo $leave_record_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $leave_record_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_record_add->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label id="elh_leave_record_LeaveTypeCode" for="x_LeaveTypeCode" class="<?php echo $leave_record_add->LeftColumnClass ?>"><?php echo $leave_record_add->LeaveTypeCode->caption() ?><?php echo $leave_record_add->LeaveTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_record_add->RightColumnClass ?>"><div <?php echo $leave_record_add->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_record_LeaveTypeCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_record" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_record_add->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x_LeaveTypeCode" name="x_LeaveTypeCode"<?php echo $leave_record_add->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_record_add->LeaveTypeCode->selectOptionListHtml("x_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_record_add->LeaveTypeCode->Lookup->getParamTag($leave_record_add, "p_x_LeaveTypeCode") ?>
</span>
<?php echo $leave_record_add->LeaveTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_record_add->EffectiveDate->Visible) { // EffectiveDate ?>
	<div id="r_EffectiveDate" class="form-group row">
		<label id="elh_leave_record_EffectiveDate" for="x_EffectiveDate" class="<?php echo $leave_record_add->LeftColumnClass ?>"><?php echo $leave_record_add->EffectiveDate->caption() ?><?php echo $leave_record_add->EffectiveDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_record_add->RightColumnClass ?>"><div <?php echo $leave_record_add->EffectiveDate->cellAttributes() ?>>
<span id="el_leave_record_EffectiveDate">
<input type="text" data-table="leave_record" data-field="x_EffectiveDate" name="x_EffectiveDate" id="x_EffectiveDate" placeholder="<?php echo HtmlEncode($leave_record_add->EffectiveDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_add->EffectiveDate->EditValue ?>"<?php echo $leave_record_add->EffectiveDate->editAttributes() ?>>
<?php if (!$leave_record_add->EffectiveDate->ReadOnly && !$leave_record_add->EffectiveDate->Disabled && !isset($leave_record_add->EffectiveDate->EditAttrs["readonly"]) && !isset($leave_record_add->EffectiveDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordadd", "x_EffectiveDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $leave_record_add->EffectiveDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_record_add->OpeningBalance->Visible) { // OpeningBalance ?>
	<div id="r_OpeningBalance" class="form-group row">
		<label id="elh_leave_record_OpeningBalance" for="x_OpeningBalance" class="<?php echo $leave_record_add->LeftColumnClass ?>"><?php echo $leave_record_add->OpeningBalance->caption() ?><?php echo $leave_record_add->OpeningBalance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_record_add->RightColumnClass ?>"><div <?php echo $leave_record_add->OpeningBalance->cellAttributes() ?>>
<span id="el_leave_record_OpeningBalance">
<input type="text" data-table="leave_record" data-field="x_OpeningBalance" name="x_OpeningBalance" id="x_OpeningBalance" size="30" placeholder="<?php echo HtmlEncode($leave_record_add->OpeningBalance->getPlaceHolder()) ?>" value="<?php echo $leave_record_add->OpeningBalance->EditValue ?>"<?php echo $leave_record_add->OpeningBalance->editAttributes() ?>>
</span>
<?php echo $leave_record_add->OpeningBalance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_record_add->LeaveAccrued->Visible) { // LeaveAccrued ?>
	<div id="r_LeaveAccrued" class="form-group row">
		<label id="elh_leave_record_LeaveAccrued" for="x_LeaveAccrued" class="<?php echo $leave_record_add->LeftColumnClass ?>"><?php echo $leave_record_add->LeaveAccrued->caption() ?><?php echo $leave_record_add->LeaveAccrued->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_record_add->RightColumnClass ?>"><div <?php echo $leave_record_add->LeaveAccrued->cellAttributes() ?>>
<span id="el_leave_record_LeaveAccrued">
<input type="text" data-table="leave_record" data-field="x_LeaveAccrued" name="x_LeaveAccrued" id="x_LeaveAccrued" size="30" placeholder="<?php echo HtmlEncode($leave_record_add->LeaveAccrued->getPlaceHolder()) ?>" value="<?php echo $leave_record_add->LeaveAccrued->EditValue ?>"<?php echo $leave_record_add->LeaveAccrued->editAttributes() ?>>
</span>
<?php echo $leave_record_add->LeaveAccrued->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_record_add->LastAccrualDate->Visible) { // LastAccrualDate ?>
	<div id="r_LastAccrualDate" class="form-group row">
		<label id="elh_leave_record_LastAccrualDate" for="x_LastAccrualDate" class="<?php echo $leave_record_add->LeftColumnClass ?>"><?php echo $leave_record_add->LastAccrualDate->caption() ?><?php echo $leave_record_add->LastAccrualDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_record_add->RightColumnClass ?>"><div <?php echo $leave_record_add->LastAccrualDate->cellAttributes() ?>>
<span id="el_leave_record_LastAccrualDate">
<input type="text" data-table="leave_record" data-field="x_LastAccrualDate" name="x_LastAccrualDate" id="x_LastAccrualDate" placeholder="<?php echo HtmlEncode($leave_record_add->LastAccrualDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_add->LastAccrualDate->EditValue ?>"<?php echo $leave_record_add->LastAccrualDate->editAttributes() ?>>
<?php if (!$leave_record_add->LastAccrualDate->ReadOnly && !$leave_record_add->LastAccrualDate->Disabled && !isset($leave_record_add->LastAccrualDate->EditAttrs["readonly"]) && !isset($leave_record_add->LastAccrualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordadd", "x_LastAccrualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $leave_record_add->LastAccrualDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_record_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_record_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_record_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$leave_record_add->showPageFooter();
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
$leave_record_add->terminate();
?>