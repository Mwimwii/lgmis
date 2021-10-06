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
$leave_applications_edit = new leave_applications_edit();

// Run the page
$leave_applications_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_applications_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_applicationsedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fleave_applicationsedit = currentForm = new ew.Form("fleave_applicationsedit", "edit");

	// Validate form
	fleave_applicationsedit.validate = function() {
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
			<?php if ($leave_applications_edit->LeaveApplicationID->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveApplicationID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_edit->LeaveApplicationID->caption(), $leave_applications_edit->LeaveApplicationID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_applications_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_edit->EmployeeID->caption(), $leave_applications_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_applications_edit->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_edit->StartDate->caption(), $leave_applications_edit->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_applications_edit->StartDate->errorMessage()) ?>");
			<?php if ($leave_applications_edit->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_edit->EndDate->caption(), $leave_applications_edit->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_applications_edit->EndDate->errorMessage()) ?>");
			<?php if ($leave_applications_edit->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_edit->LeaveTypeCode->caption(), $leave_applications_edit->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_applications_edit->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_edit->Location->caption(), $leave_applications_edit->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_applications_edit->Status->Required) { ?>
				elm = this.getElements("x" + infix + "_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_edit->Status->caption(), $leave_applications_edit->Status->RequiredErrorMessage)) ?>");
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
	fleave_applicationsedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_applicationsedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fleave_applicationsedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_applications_edit->showPageHeader(); ?>
<?php
$leave_applications_edit->showMessage();
?>
<?php if (!$leave_applications_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_applications_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fleave_applicationsedit" id="fleave_applicationsedit" class="<?php echo $leave_applications_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_applications">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$leave_applications_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($leave_applications_edit->LeaveApplicationID->Visible) { // LeaveApplicationID ?>
	<div id="r_LeaveApplicationID" class="form-group row">
		<label id="elh_leave_applications_LeaveApplicationID" class="<?php echo $leave_applications_edit->LeftColumnClass ?>"><?php echo $leave_applications_edit->LeaveApplicationID->caption() ?><?php echo $leave_applications_edit->LeaveApplicationID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_edit->RightColumnClass ?>"><div <?php echo $leave_applications_edit->LeaveApplicationID->cellAttributes() ?>>
<span id="el_leave_applications_LeaveApplicationID">
<span<?php echo $leave_applications_edit->LeaveApplicationID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_applications_edit->LeaveApplicationID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_applications" data-field="x_LeaveApplicationID" name="x_LeaveApplicationID" id="x_LeaveApplicationID" value="<?php echo HtmlEncode($leave_applications_edit->LeaveApplicationID->CurrentValue) ?>">
<?php echo $leave_applications_edit->LeaveApplicationID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_applications_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_leave_applications_EmployeeID" for="x_EmployeeID" class="<?php echo $leave_applications_edit->LeftColumnClass ?>"><?php echo $leave_applications_edit->EmployeeID->caption() ?><?php echo $leave_applications_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_edit->RightColumnClass ?>"><div <?php echo $leave_applications_edit->EmployeeID->cellAttributes() ?>>
<span id="el_leave_applications_EmployeeID">
<input type="text" data-table="leave_applications" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($leave_applications_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_applications_edit->EmployeeID->EditValue ?>"<?php echo $leave_applications_edit->EmployeeID->editAttributes() ?>>
</span>
<?php echo $leave_applications_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_applications_edit->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_leave_applications_StartDate" for="x_StartDate" class="<?php echo $leave_applications_edit->LeftColumnClass ?>"><?php echo $leave_applications_edit->StartDate->caption() ?><?php echo $leave_applications_edit->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_edit->RightColumnClass ?>"><div <?php echo $leave_applications_edit->StartDate->cellAttributes() ?>>
<span id="el_leave_applications_StartDate">
<input type="text" data-table="leave_applications" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" maxlength="10" placeholder="<?php echo HtmlEncode($leave_applications_edit->StartDate->getPlaceHolder()) ?>" value="<?php echo $leave_applications_edit->StartDate->EditValue ?>"<?php echo $leave_applications_edit->StartDate->editAttributes() ?>>
<?php if (!$leave_applications_edit->StartDate->ReadOnly && !$leave_applications_edit->StartDate->Disabled && !isset($leave_applications_edit->StartDate->EditAttrs["readonly"]) && !isset($leave_applications_edit->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_applicationsedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_applicationsedit", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $leave_applications_edit->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_applications_edit->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_leave_applications_EndDate" for="x_EndDate" class="<?php echo $leave_applications_edit->LeftColumnClass ?>"><?php echo $leave_applications_edit->EndDate->caption() ?><?php echo $leave_applications_edit->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_edit->RightColumnClass ?>"><div <?php echo $leave_applications_edit->EndDate->cellAttributes() ?>>
<span id="el_leave_applications_EndDate">
<input type="text" data-table="leave_applications" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" maxlength="10" placeholder="<?php echo HtmlEncode($leave_applications_edit->EndDate->getPlaceHolder()) ?>" value="<?php echo $leave_applications_edit->EndDate->EditValue ?>"<?php echo $leave_applications_edit->EndDate->editAttributes() ?>>
<?php if (!$leave_applications_edit->EndDate->ReadOnly && !$leave_applications_edit->EndDate->Disabled && !isset($leave_applications_edit->EndDate->EditAttrs["readonly"]) && !isset($leave_applications_edit->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_applicationsedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_applicationsedit", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $leave_applications_edit->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_applications_edit->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label id="elh_leave_applications_LeaveTypeCode" for="x_LeaveTypeCode" class="<?php echo $leave_applications_edit->LeftColumnClass ?>"><?php echo $leave_applications_edit->LeaveTypeCode->caption() ?><?php echo $leave_applications_edit->LeaveTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_edit->RightColumnClass ?>"><div <?php echo $leave_applications_edit->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_applications_LeaveTypeCode">
<input type="text" data-table="leave_applications" data-field="x_LeaveTypeCode" name="x_LeaveTypeCode" id="x_LeaveTypeCode" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($leave_applications_edit->LeaveTypeCode->getPlaceHolder()) ?>" value="<?php echo $leave_applications_edit->LeaveTypeCode->EditValue ?>"<?php echo $leave_applications_edit->LeaveTypeCode->editAttributes() ?>>
</span>
<?php echo $leave_applications_edit->LeaveTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_applications_edit->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_leave_applications_Location" for="x_Location" class="<?php echo $leave_applications_edit->LeftColumnClass ?>"><?php echo $leave_applications_edit->Location->caption() ?><?php echo $leave_applications_edit->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_edit->RightColumnClass ?>"><div <?php echo $leave_applications_edit->Location->cellAttributes() ?>>
<span id="el_leave_applications_Location">
<input type="text" data-table="leave_applications" data-field="x_Location" name="x_Location" id="x_Location" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($leave_applications_edit->Location->getPlaceHolder()) ?>" value="<?php echo $leave_applications_edit->Location->EditValue ?>"<?php echo $leave_applications_edit->Location->editAttributes() ?>>
</span>
<?php echo $leave_applications_edit->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_applications_edit->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group row">
		<label id="elh_leave_applications_Status" for="x_Status" class="<?php echo $leave_applications_edit->LeftColumnClass ?>"><?php echo $leave_applications_edit->Status->caption() ?><?php echo $leave_applications_edit->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_edit->RightColumnClass ?>"><div <?php echo $leave_applications_edit->Status->cellAttributes() ?>>
<span id="el_leave_applications_Status">
<input type="text" data-table="leave_applications" data-field="x_Status" name="x_Status" id="x_Status" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($leave_applications_edit->Status->getPlaceHolder()) ?>" value="<?php echo $leave_applications_edit->Status->EditValue ?>"<?php echo $leave_applications_edit->Status->editAttributes() ?>>
</span>
<?php echo $leave_applications_edit->Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_applications_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_applications_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_applications_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$leave_applications_edit->IsModal) { ?>
<?php echo $leave_applications_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$leave_applications_edit->showPageFooter();
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
$leave_applications_edit->terminate();
?>