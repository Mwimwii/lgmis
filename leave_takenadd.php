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
$leave_taken_add = new leave_taken_add();

// Run the page
$leave_taken_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_taken_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_takenadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fleave_takenadd = currentForm = new ew.Form("fleave_takenadd", "add");

	// Validate form
	fleave_takenadd.validate = function() {
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
			<?php if ($leave_taken_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_add->EmployeeID->caption(), $leave_taken_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_add->EmployeeID->errorMessage()) ?>");
			<?php if ($leave_taken_add->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_add->LeaveTypeCode->caption(), $leave_taken_add->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_taken_add->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_add->StartDate->caption(), $leave_taken_add->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_add->StartDate->errorMessage()) ?>");
			<?php if ($leave_taken_add->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_add->EndDate->caption(), $leave_taken_add->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_add->EndDate->errorMessage()) ?>");
			<?php if ($leave_taken_add->Commuted->Required) { ?>
				elm = this.getElements("x" + infix + "_Commuted");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_add->Commuted->caption(), $leave_taken_add->Commuted->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Commuted");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_add->Commuted->errorMessage()) ?>");
			<?php if ($leave_taken_add->LeaveDays->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveDays");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_add->LeaveDays->caption(), $leave_taken_add->LeaveDays->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveDays");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_taken_add->LeaveDays->errorMessage()) ?>");
			<?php if ($leave_taken_add->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_add->Location->caption(), $leave_taken_add->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_taken_add->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_taken_add->Remarks->caption(), $leave_taken_add->Remarks->RequiredErrorMessage)) ?>");
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
	fleave_takenadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_takenadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_takenadd.lists["x_LeaveTypeCode"] = <?php echo $leave_taken_add->LeaveTypeCode->Lookup->toClientList($leave_taken_add) ?>;
	fleave_takenadd.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_taken_add->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_takenadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_taken_add->showPageHeader(); ?>
<?php
$leave_taken_add->showMessage();
?>
<form name="fleave_takenadd" id="fleave_takenadd" class="<?php echo $leave_taken_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_taken">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$leave_taken_add->IsModal ?>">
<?php if ($leave_taken->getCurrentMasterTable() == "employment") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="employment">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($leave_taken_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($leave_taken_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_leave_taken_EmployeeID" for="x_EmployeeID" class="<?php echo $leave_taken_add->LeftColumnClass ?>"><?php echo $leave_taken_add->EmployeeID->caption() ?><?php echo $leave_taken_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_add->RightColumnClass ?>"><div <?php echo $leave_taken_add->EmployeeID->cellAttributes() ?>>
<?php if ($leave_taken_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_leave_taken_EmployeeID">
<span<?php echo $leave_taken_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_taken_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($leave_taken_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_leave_taken_EmployeeID">
<input type="text" data-table="leave_taken" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_taken_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_taken_add->EmployeeID->EditValue ?>"<?php echo $leave_taken_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $leave_taken_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_add->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label id="elh_leave_taken_LeaveTypeCode" for="x_LeaveTypeCode" class="<?php echo $leave_taken_add->LeftColumnClass ?>"><?php echo $leave_taken_add->LeaveTypeCode->caption() ?><?php echo $leave_taken_add->LeaveTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_add->RightColumnClass ?>"><div <?php echo $leave_taken_add->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_taken_LeaveTypeCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_taken" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_taken_add->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x_LeaveTypeCode" name="x_LeaveTypeCode"<?php echo $leave_taken_add->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_taken_add->LeaveTypeCode->selectOptionListHtml("x_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_taken_add->LeaveTypeCode->Lookup->getParamTag($leave_taken_add, "p_x_LeaveTypeCode") ?>
</span>
<?php echo $leave_taken_add->LeaveTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_add->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_leave_taken_StartDate" for="x_StartDate" class="<?php echo $leave_taken_add->LeftColumnClass ?>"><?php echo $leave_taken_add->StartDate->caption() ?><?php echo $leave_taken_add->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_add->RightColumnClass ?>"><div <?php echo $leave_taken_add->StartDate->cellAttributes() ?>>
<span id="el_leave_taken_StartDate">
<input type="text" data-table="leave_taken" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($leave_taken_add->StartDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_add->StartDate->EditValue ?>"<?php echo $leave_taken_add->StartDate->editAttributes() ?>>
<?php if (!$leave_taken_add->StartDate->ReadOnly && !$leave_taken_add->StartDate->Disabled && !isset($leave_taken_add->StartDate->EditAttrs["readonly"]) && !isset($leave_taken_add->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takenadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takenadd", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $leave_taken_add->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_add->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_leave_taken_EndDate" for="x_EndDate" class="<?php echo $leave_taken_add->LeftColumnClass ?>"><?php echo $leave_taken_add->EndDate->caption() ?><?php echo $leave_taken_add->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_add->RightColumnClass ?>"><div <?php echo $leave_taken_add->EndDate->cellAttributes() ?>>
<span id="el_leave_taken_EndDate">
<input type="text" data-table="leave_taken" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($leave_taken_add->EndDate->getPlaceHolder()) ?>" value="<?php echo $leave_taken_add->EndDate->EditValue ?>"<?php echo $leave_taken_add->EndDate->editAttributes() ?>>
<?php if (!$leave_taken_add->EndDate->ReadOnly && !$leave_taken_add->EndDate->Disabled && !isset($leave_taken_add->EndDate->EditAttrs["readonly"]) && !isset($leave_taken_add->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_takenadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_takenadd", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $leave_taken_add->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_add->Commuted->Visible) { // Commuted ?>
	<div id="r_Commuted" class="form-group row">
		<label id="elh_leave_taken_Commuted" for="x_Commuted" class="<?php echo $leave_taken_add->LeftColumnClass ?>"><?php echo $leave_taken_add->Commuted->caption() ?><?php echo $leave_taken_add->Commuted->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_add->RightColumnClass ?>"><div <?php echo $leave_taken_add->Commuted->cellAttributes() ?>>
<span id="el_leave_taken_Commuted">
<input type="text" data-table="leave_taken" data-field="x_Commuted" name="x_Commuted" id="x_Commuted" size="30" placeholder="<?php echo HtmlEncode($leave_taken_add->Commuted->getPlaceHolder()) ?>" value="<?php echo $leave_taken_add->Commuted->EditValue ?>"<?php echo $leave_taken_add->Commuted->editAttributes() ?>>
</span>
<?php echo $leave_taken_add->Commuted->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_add->LeaveDays->Visible) { // LeaveDays ?>
	<div id="r_LeaveDays" class="form-group row">
		<label id="elh_leave_taken_LeaveDays" for="x_LeaveDays" class="<?php echo $leave_taken_add->LeftColumnClass ?>"><?php echo $leave_taken_add->LeaveDays->caption() ?><?php echo $leave_taken_add->LeaveDays->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_add->RightColumnClass ?>"><div <?php echo $leave_taken_add->LeaveDays->cellAttributes() ?>>
<span id="el_leave_taken_LeaveDays">
<input type="text" data-table="leave_taken" data-field="x_LeaveDays" name="x_LeaveDays" id="x_LeaveDays" size="30" placeholder="<?php echo HtmlEncode($leave_taken_add->LeaveDays->getPlaceHolder()) ?>" value="<?php echo $leave_taken_add->LeaveDays->EditValue ?>"<?php echo $leave_taken_add->LeaveDays->editAttributes() ?>>
</span>
<?php echo $leave_taken_add->LeaveDays->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_add->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_leave_taken_Location" for="x_Location" class="<?php echo $leave_taken_add->LeftColumnClass ?>"><?php echo $leave_taken_add->Location->caption() ?><?php echo $leave_taken_add->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_add->RightColumnClass ?>"><div <?php echo $leave_taken_add->Location->cellAttributes() ?>>
<span id="el_leave_taken_Location">
<input type="text" data-table="leave_taken" data-field="x_Location" name="x_Location" id="x_Location" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_add->Location->getPlaceHolder()) ?>" value="<?php echo $leave_taken_add->Location->EditValue ?>"<?php echo $leave_taken_add->Location->editAttributes() ?>>
</span>
<?php echo $leave_taken_add->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_taken_add->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label id="elh_leave_taken_Remarks" for="x_Remarks" class="<?php echo $leave_taken_add->LeftColumnClass ?>"><?php echo $leave_taken_add->Remarks->caption() ?><?php echo $leave_taken_add->Remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_taken_add->RightColumnClass ?>"><div <?php echo $leave_taken_add->Remarks->cellAttributes() ?>>
<span id="el_leave_taken_Remarks">
<input type="text" data-table="leave_taken" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_taken_add->Remarks->getPlaceHolder()) ?>" value="<?php echo $leave_taken_add->Remarks->EditValue ?>"<?php echo $leave_taken_add->Remarks->editAttributes() ?>>
</span>
<?php echo $leave_taken_add->Remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_taken_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_taken_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_taken_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$leave_taken_add->showPageFooter();
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
$leave_taken_add->terminate();
?>