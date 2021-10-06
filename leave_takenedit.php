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
$leave_taken_edit = new leave_taken_edit();

// Run the page
$leave_taken_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_taken_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_takenedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fleave_takenedit = currentForm = new ew.Form("fleave_takenedit", "edit");

	// Validate form
	fleave_takenedit.validate = function() {
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
			<?php if ($leave_taken_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_edit->EmployeeID->caption(), $leave_taken_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($leave_taken_edit->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_edit->LeaveTypeCode->caption(), $leave_taken_edit->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_taken_edit->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_edit->StartDate->caption(), $leave_taken_edit->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_edit->StartDate->errorMessage()) ?>");
			<?php if ($leave_taken_edit->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_edit->EndDate->caption(), $leave_taken_edit->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_edit->EndDate->errorMessage()) ?>");
			<?php if ($leave_taken_edit->Commuted->Required) { ?>
				elm = this.getElements("x" + infix + "_Commuted");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_edit->Commuted->caption(), $leave_taken_edit->Commuted->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Commuted");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_edit->Commuted->errorMessage()) ?>");
			<?php if ($leave_taken_edit->LeaveDays->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveDays");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_edit->LeaveDays->caption(), $leave_taken_edit->LeaveDays->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveDays");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_edit->LeaveDays->errorMessage()) ?>");
			<?php if ($leave_taken_edit->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_edit->Location->caption(), $leave_taken_edit->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_taken_edit->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_edit->Remarks->caption(), $leave_taken_edit->Remarks->RequiredErrorMessage)) ?>");
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
	fleave_takenedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_takenedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_takenedit.lists["x_LeaveTypeCode"] = <?php echo $leave_taken_edit->LeaveTypeCode->Lookup->toClientList($leave_taken_edit) ?>;
	fleave_takenedit.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_taken_edit->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_takenedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_taken_edit->showPageHeader(); ?>
<?php
$leave_taken_edit->showMessage();
?>
<?php if (!$leave_taken_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_taken_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fleave_takenedit" id="fleave_takenedit" class="<?php echo $leave_taken_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_taken">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$leave_taken_edit->IsModal ?>">
<?php if ($leave_taken->getCurrentMasterTable() == "employment") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="employment">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($leave_taken_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($leave_taken_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_leave_taken_EmployeeID" for="x_EmployeeID" class="<?php echo $leave_taken_edit->LeftColumnClass ?>"><?php echo $leave_taken_edit->EmployeeID->caption() ?><?php echo $leave_taken_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_edit->RightColumnClass ?>"><div <?php echo $leave_taken_edit->EmployeeID->cellAttributes() ?>>
<?php if ($leave_taken_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_leave_taken_EmployeeID">
<span<?php echo $leave_taken_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($leave_taken_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="leave_taken" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_taken_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_taken_edit->EmployeeID->EditValue ?>"<?php echo $leave_taken_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="leave_taken" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($leave_taken_edit->EmployeeID->OldValue != null ? $leave_taken_edit->EmployeeID->OldValue : $leave_taken_edit->EmployeeID->CurrentValue) ?>">
<?php echo $leave_taken_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_edit->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label id="elh_leave_taken_LeaveTypeCode" for="x_LeaveTypeCode" class="<?php echo $leave_taken_edit->LeftColumnClass ?>"><?php echo $leave_taken_edit->LeaveTypeCode->caption() ?><?php echo $leave_taken_edit->LeaveTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_edit->RightColumnClass ?>"><div <?php echo $leave_taken_edit->LeaveTypeCode->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_taken" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_taken_edit->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x_LeaveTypeCode" name="x_LeaveTypeCode"<?php echo $leave_taken_edit->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_taken_edit->LeaveTypeCode->selectOptionListHtml("x_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_taken_edit->LeaveTypeCode->Lookup->getParamTag($leave_taken_edit, "p_x_LeaveTypeCode") ?>
<input type="hidden" data-table="leave_taken" data-field="x_LeaveTypeCode" name="o_LeaveTypeCode" id="o_LeaveTypeCode" value="<?php echo HtmlEncode($leave_taken_edit->LeaveTypeCode->OldValue != null ? $leave_taken_edit->LeaveTypeCode->OldValue : $leave_taken_edit->LeaveTypeCode->CurrentValue) ?>">
<?php echo $leave_taken_edit->LeaveTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_edit->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_leave_taken_StartDate" for="x_StartDate" class="<?php echo $leave_taken_edit->LeftColumnClass ?>"><?php echo $leave_taken_edit->StartDate->caption() ?><?php echo $leave_taken_edit->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_edit->RightColumnClass ?>"><div <?php echo $leave_taken_edit->StartDate->cellAttributes() ?>>
<input type="text" data-table="leave_taken" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($leave_taken_edit->StartDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_edit->StartDate->EditValue ?>"<?php echo $leave_taken_edit->StartDate->editAttributes() ?>>
<?php if (!$leave_taken_edit->StartDate->ReadOnly && !$leave_taken_edit->StartDate->Disabled && !isset($leave_taken_edit->StartDate->EditAttrs["readonly"]) && !isset($leave_taken_edit->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takenedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takenedit", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
<input type="hidden" data-table="leave_taken" data-field="x_StartDate" name="o_StartDate" id="o_StartDate" value="<?php echo HtmlEncode($leave_taken_edit->StartDate->OldValue != null ? $leave_taken_edit->StartDate->OldValue : $leave_taken_edit->StartDate->CurrentValue) ?>">
<?php echo $leave_taken_edit->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_edit->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_leave_taken_EndDate" for="x_EndDate" class="<?php echo $leave_taken_edit->LeftColumnClass ?>"><?php echo $leave_taken_edit->EndDate->caption() ?><?php echo $leave_taken_edit->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_edit->RightColumnClass ?>"><div <?php echo $leave_taken_edit->EndDate->cellAttributes() ?>>
<span id="el_leave_taken_EndDate">
<input type="text" data-table="leave_taken" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($leave_taken_edit->EndDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_edit->EndDate->EditValue ?>"<?php echo $leave_taken_edit->EndDate->editAttributes() ?>>
<?php if (!$leave_taken_edit->EndDate->ReadOnly && !$leave_taken_edit->EndDate->Disabled && !isset($leave_taken_edit->EndDate->EditAttrs["readonly"]) && !isset($leave_taken_edit->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takenedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takenedit", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $leave_taken_edit->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_edit->Commuted->Visible) { // Commuted ?>
	<div id="r_Commuted" class="form-group row">
		<label id="elh_leave_taken_Commuted" for="x_Commuted" class="<?php echo $leave_taken_edit->LeftColumnClass ?>"><?php echo $leave_taken_edit->Commuted->caption() ?><?php echo $leave_taken_edit->Commuted->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_edit->RightColumnClass ?>"><div <?php echo $leave_taken_edit->Commuted->cellAttributes() ?>>
<span id="el_leave_taken_Commuted">
<input type="text" data-table="leave_taken" data-field="x_Commuted" name="x_Commuted" id="x_Commuted" size="30" placeholder="<?php echo HtmlEncode($leave_taken_edit->Commuted->getPlaceHolder()) ?>" value="<?php echo $leave_taken_edit->Commuted->EditValue ?>"<?php echo $leave_taken_edit->Commuted->editAttributes() ?>>
</span>
<?php echo $leave_taken_edit->Commuted->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_edit->LeaveDays->Visible) { // LeaveDays ?>
	<div id="r_LeaveDays" class="form-group row">
		<label id="elh_leave_taken_LeaveDays" for="x_LeaveDays" class="<?php echo $leave_taken_edit->LeftColumnClass ?>"><?php echo $leave_taken_edit->LeaveDays->caption() ?><?php echo $leave_taken_edit->LeaveDays->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_edit->RightColumnClass ?>"><div <?php echo $leave_taken_edit->LeaveDays->cellAttributes() ?>>
<span id="el_leave_taken_LeaveDays">
<input type="text" data-table="leave_taken" data-field="x_LeaveDays" name="x_LeaveDays" id="x_LeaveDays" size="30" placeholder="<?php echo HtmlEncode($leave_taken_edit->LeaveDays->getPlaceHolder()) ?>" value="<?php echo $leave_taken_edit->LeaveDays->EditValue ?>"<?php echo $leave_taken_edit->LeaveDays->editAttributes() ?>>
</span>
<?php echo $leave_taken_edit->LeaveDays->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_edit->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_leave_taken_Location" for="x_Location" class="<?php echo $leave_taken_edit->LeftColumnClass ?>"><?php echo $leave_taken_edit->Location->caption() ?><?php echo $leave_taken_edit->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_edit->RightColumnClass ?>"><div <?php echo $leave_taken_edit->Location->cellAttributes() ?>>
<span id="el_leave_taken_Location">
<input type="text" data-table="leave_taken" data-field="x_Location" name="x_Location" id="x_Location" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_edit->Location->getPlaceHolder()) ?>" value="<?php echo $leave_taken_edit->Location->EditValue ?>"<?php echo $leave_taken_edit->Location->editAttributes() ?>>
</span>
<?php echo $leave_taken_edit->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_edit->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label id="elh_leave_taken_Remarks" for="x_Remarks" class="<?php echo $leave_taken_edit->LeftColumnClass ?>"><?php echo $leave_taken_edit->Remarks->caption() ?><?php echo $leave_taken_edit->Remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_edit->RightColumnClass ?>"><div <?php echo $leave_taken_edit->Remarks->cellAttributes() ?>>
<span id="el_leave_taken_Remarks">
<input type="text" data-table="leave_taken" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_edit->Remarks->getPlaceHolder()) ?>" value="<?php echo $leave_taken_edit->Remarks->EditValue ?>"<?php echo $leave_taken_edit->Remarks->editAttributes() ?>>
</span>
<?php echo $leave_taken_edit->Remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_taken_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_taken_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_taken_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$leave_taken_edit->IsModal) { ?>
<?php echo $leave_taken_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$leave_taken_edit->showPageFooter();
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
$leave_taken_edit->terminate();
?>