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
$leave_record_edit = new leave_record_edit();

// Run the page
$leave_record_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_record_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_recordedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fleave_recordedit = currentForm = new ew.Form("fleave_recordedit", "edit");

	// Validate form
	fleave_recordedit.validate = function() {
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
			<?php if ($leave_record_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_edit->EmployeeID->caption(), $leave_record_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($leave_record_edit->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_edit->LeaveTypeCode->caption(), $leave_record_edit->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_record_edit->EffectiveDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EffectiveDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_edit->EffectiveDate->caption(), $leave_record_edit->EffectiveDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EffectiveDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_edit->EffectiveDate->errorMessage()) ?>");
			<?php if ($leave_record_edit->LeaveAccrued->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveAccrued");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_edit->LeaveAccrued->caption(), $leave_record_edit->LeaveAccrued->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveAccrued");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_edit->LeaveAccrued->errorMessage()) ?>");
			<?php if ($leave_record_edit->LastAccrualDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastAccrualDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_record_edit->LastAccrualDate->caption(), $leave_record_edit->LastAccrualDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastAccrualDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_record_edit->LastAccrualDate->errorMessage()) ?>");

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
	fleave_recordedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_recordedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_recordedit.lists["x_LeaveTypeCode"] = <?php echo $leave_record_edit->LeaveTypeCode->Lookup->toClientList($leave_record_edit) ?>;
	fleave_recordedit.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_record_edit->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_recordedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_record_edit->showPageHeader(); ?>
<?php
$leave_record_edit->showMessage();
?>
<?php if (!$leave_record_edit->IsModal) { ?>
<?php if (!$leave_record->isConfirm()) { // Confirm page ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_record_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fleave_recordedit" id="fleave_recordedit" class="<?php echo $leave_record_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_record">
<?php if ($leave_record->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$leave_record_edit->IsModal ?>">
<?php if ($leave_record->getCurrentMasterTable() == "employment") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="employment">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($leave_record_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($leave_record_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_leave_record_EmployeeID" for="x_EmployeeID" class="<?php echo $leave_record_edit->LeftColumnClass ?>"><?php echo $leave_record_edit->EmployeeID->caption() ?><?php echo $leave_record_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_record_edit->RightColumnClass ?>"><div <?php echo $leave_record_edit->EmployeeID->cellAttributes() ?>>
<?php if (!$leave_record->isConfirm()) { ?>
<?php if ($leave_record_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_leave_record_EmployeeID">
<span<?php echo $leave_record_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($leave_record_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="leave_record" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_record_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_record_edit->EmployeeID->EditValue ?>"<?php echo $leave_record_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($leave_record_edit->EmployeeID->OldValue != null ? $leave_record_edit->EmployeeID->OldValue : $leave_record_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_leave_record_EmployeeID">
<span<?php echo $leave_record_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_edit->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" value="<?php echo HtmlEncode($leave_record_edit->EmployeeID->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($leave_record_edit->EmployeeID->OldValue != null ? $leave_record_edit->EmployeeID->OldValue : $leave_record_edit->EmployeeID->CurrentValue) ?>">
<?php } ?>
<?php echo $leave_record_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_record_edit->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label id="elh_leave_record_LeaveTypeCode" for="x_LeaveTypeCode" class="<?php echo $leave_record_edit->LeftColumnClass ?>"><?php echo $leave_record_edit->LeaveTypeCode->caption() ?><?php echo $leave_record_edit->LeaveTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_record_edit->RightColumnClass ?>"><div <?php echo $leave_record_edit->LeaveTypeCode->cellAttributes() ?>>
<?php if (!$leave_record->isConfirm()) { ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_record" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_record_edit->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x_LeaveTypeCode" name="x_LeaveTypeCode"<?php echo $leave_record_edit->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_record_edit->LeaveTypeCode->selectOptionListHtml("x_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_record_edit->LeaveTypeCode->Lookup->getParamTag($leave_record_edit, "p_x_LeaveTypeCode") ?>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="o_LeaveTypeCode" id="o_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_edit->LeaveTypeCode->OldValue != null ? $leave_record_edit->LeaveTypeCode->OldValue : $leave_record_edit->LeaveTypeCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_leave_record_LeaveTypeCode">
<span<?php echo $leave_record_edit->LeaveTypeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_edit->LeaveTypeCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="x_LeaveTypeCode" id="x_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_edit->LeaveTypeCode->FormValue) ?>">
<input type="hidden" data-table="leave_record" data-field="x_LeaveTypeCode" name="o_LeaveTypeCode" id="o_LeaveTypeCode" value="<?php echo HtmlEncode($leave_record_edit->LeaveTypeCode->OldValue != null ? $leave_record_edit->LeaveTypeCode->OldValue : $leave_record_edit->LeaveTypeCode->CurrentValue) ?>">
<?php } ?>
<?php echo $leave_record_edit->LeaveTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_record_edit->EffectiveDate->Visible) { // EffectiveDate ?>
	<div id="r_EffectiveDate" class="form-group row">
		<label id="elh_leave_record_EffectiveDate" for="x_EffectiveDate" class="<?php echo $leave_record_edit->LeftColumnClass ?>"><?php echo $leave_record_edit->EffectiveDate->caption() ?><?php echo $leave_record_edit->EffectiveDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_record_edit->RightColumnClass ?>"><div <?php echo $leave_record_edit->EffectiveDate->cellAttributes() ?>>
<?php if (!$leave_record->isConfirm()) { ?>
<span id="el_leave_record_EffectiveDate">
<input type="text" data-table="leave_record" data-field="x_EffectiveDate" name="x_EffectiveDate" id="x_EffectiveDate" placeholder="<?php echo HtmlEncode($leave_record_edit->EffectiveDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_edit->EffectiveDate->EditValue ?>"<?php echo $leave_record_edit->EffectiveDate->editAttributes() ?>>
<?php if (!$leave_record_edit->EffectiveDate->ReadOnly && !$leave_record_edit->EffectiveDate->Disabled && !isset($leave_record_edit->EffectiveDate->EditAttrs["readonly"]) && !isset($leave_record_edit->EffectiveDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordedit", "x_EffectiveDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_leave_record_EffectiveDate">
<span<?php echo $leave_record_edit->EffectiveDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_edit->EffectiveDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_EffectiveDate" name="x_EffectiveDate" id="x_EffectiveDate" value="<?php echo HtmlEncode($leave_record_edit->EffectiveDate->FormValue) ?>">
<?php } ?>
<?php echo $leave_record_edit->EffectiveDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_record_edit->LeaveAccrued->Visible) { // LeaveAccrued ?>
	<div id="r_LeaveAccrued" class="form-group row">
		<label id="elh_leave_record_LeaveAccrued" for="x_LeaveAccrued" class="<?php echo $leave_record_edit->LeftColumnClass ?>"><?php echo $leave_record_edit->LeaveAccrued->caption() ?><?php echo $leave_record_edit->LeaveAccrued->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_record_edit->RightColumnClass ?>"><div <?php echo $leave_record_edit->LeaveAccrued->cellAttributes() ?>>
<?php if (!$leave_record->isConfirm()) { ?>
<span id="el_leave_record_LeaveAccrued">
<input type="text" data-table="leave_record" data-field="x_LeaveAccrued" name="x_LeaveAccrued" id="x_LeaveAccrued" size="30" placeholder="<?php echo HtmlEncode($leave_record_edit->LeaveAccrued->getPlaceHolder()) ?>" value="<?php echo $leave_record_edit->LeaveAccrued->EditValue ?>"<?php echo $leave_record_edit->LeaveAccrued->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_leave_record_LeaveAccrued">
<span<?php echo $leave_record_edit->LeaveAccrued->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_edit->LeaveAccrued->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LeaveAccrued" name="x_LeaveAccrued" id="x_LeaveAccrued" value="<?php echo HtmlEncode($leave_record_edit->LeaveAccrued->FormValue) ?>">
<?php } ?>
<?php echo $leave_record_edit->LeaveAccrued->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_record_edit->LastAccrualDate->Visible) { // LastAccrualDate ?>
	<div id="r_LastAccrualDate" class="form-group row">
		<label id="elh_leave_record_LastAccrualDate" for="x_LastAccrualDate" class="<?php echo $leave_record_edit->LeftColumnClass ?>"><?php echo $leave_record_edit->LastAccrualDate->caption() ?><?php echo $leave_record_edit->LastAccrualDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_record_edit->RightColumnClass ?>"><div <?php echo $leave_record_edit->LastAccrualDate->cellAttributes() ?>>
<?php if (!$leave_record->isConfirm()) { ?>
<span id="el_leave_record_LastAccrualDate">
<input type="text" data-table="leave_record" data-field="x_LastAccrualDate" name="x_LastAccrualDate" id="x_LastAccrualDate" placeholder="<?php echo HtmlEncode($leave_record_edit->LastAccrualDate->getPlaceHolder()) ?>" value="<?php echo $leave_record_edit->LastAccrualDate->EditValue ?>"<?php echo $leave_record_edit->LastAccrualDate->editAttributes() ?>>
<?php if (!$leave_record_edit->LastAccrualDate->ReadOnly && !$leave_record_edit->LastAccrualDate->Disabled && !isset($leave_record_edit->LastAccrualDate->EditAttrs["readonly"]) && !isset($leave_record_edit->LastAccrualDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_recordedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_recordedit", "x_LastAccrualDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_leave_record_LastAccrualDate">
<span<?php echo $leave_record_edit->LastAccrualDate->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_record_edit->LastAccrualDate->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_record" data-field="x_LastAccrualDate" name="x_LastAccrualDate" id="x_LastAccrualDate" value="<?php echo HtmlEncode($leave_record_edit->LastAccrualDate->FormValue) ?>">
<?php } ?>
<?php echo $leave_record_edit->LastAccrualDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_record_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_record_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$leave_record->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_record_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$leave_record_edit->IsModal) { ?>
<?php if (!$leave_record->isConfirm()) { // Confirm page ?>
<?php echo $leave_record_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$leave_record_edit->showPageFooter();
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
$leave_record_edit->terminate();
?>