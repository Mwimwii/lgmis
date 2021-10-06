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
$leave_applications_add = new leave_applications_add();

// Run the page
$leave_applications_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_applications_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_applicationsadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fleave_applicationsadd = currentForm = new ew.Form("fleave_applicationsadd", "add");

	// Validate form
	fleave_applicationsadd.validate = function() {
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
			<?php if ($leave_applications_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_add->EmployeeID->caption(), $leave_applications_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_applications_add->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_add->StartDate->caption(), $leave_applications_add->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_applications_add->StartDate->errorMessage()) ?>");
			<?php if ($leave_applications_add->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_add->EndDate->caption(), $leave_applications_add->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_applications_add->EndDate->errorMessage()) ?>");
			<?php if ($leave_applications_add->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_add->LeaveTypeCode->caption(), $leave_applications_add->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_applications_add->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_add->Location->caption(), $leave_applications_add->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_applications_add->Status->Required) { ?>
				elm = this.getElements("x" + infix + "_Status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_applications_add->Status->caption(), $leave_applications_add->Status->RequiredErrorMessage)) ?>");
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
	fleave_applicationsadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_applicationsadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fleave_applicationsadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_applications_add->showPageHeader(); ?>
<?php
$leave_applications_add->showMessage();
?>
<form name="fleave_applicationsadd" id="fleave_applicationsadd" class="<?php echo $leave_applications_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_applications">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$leave_applications_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($leave_applications_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_leave_applications_EmployeeID" for="x_EmployeeID" class="<?php echo $leave_applications_add->LeftColumnClass ?>"><?php echo $leave_applications_add->EmployeeID->caption() ?><?php echo $leave_applications_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_add->RightColumnClass ?>"><div <?php echo $leave_applications_add->EmployeeID->cellAttributes() ?>>
<span id="el_leave_applications_EmployeeID">
<input type="text" data-table="leave_applications" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($leave_applications_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_applications_add->EmployeeID->EditValue ?>"<?php echo $leave_applications_add->EmployeeID->editAttributes() ?>>
</span>
<?php echo $leave_applications_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_applications_add->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_leave_applications_StartDate" for="x_StartDate" class="<?php echo $leave_applications_add->LeftColumnClass ?>"><?php echo $leave_applications_add->StartDate->caption() ?><?php echo $leave_applications_add->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_add->RightColumnClass ?>"><div <?php echo $leave_applications_add->StartDate->cellAttributes() ?>>
<span id="el_leave_applications_StartDate">
<input type="text" data-table="leave_applications" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" maxlength="10" placeholder="<?php echo HtmlEncode($leave_applications_add->StartDate->getPlaceHolder()) ?>" value="<?php echo $leave_applications_add->StartDate->EditValue ?>"<?php echo $leave_applications_add->StartDate->editAttributes() ?>>
<?php if (!$leave_applications_add->StartDate->ReadOnly && !$leave_applications_add->StartDate->Disabled && !isset($leave_applications_add->StartDate->EditAttrs["readonly"]) && !isset($leave_applications_add->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_applicationsadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_applicationsadd", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $leave_applications_add->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_applications_add->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_leave_applications_EndDate" for="x_EndDate" class="<?php echo $leave_applications_add->LeftColumnClass ?>"><?php echo $leave_applications_add->EndDate->caption() ?><?php echo $leave_applications_add->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_add->RightColumnClass ?>"><div <?php echo $leave_applications_add->EndDate->cellAttributes() ?>>
<span id="el_leave_applications_EndDate">
<input type="text" data-table="leave_applications" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" maxlength="10" placeholder="<?php echo HtmlEncode($leave_applications_add->EndDate->getPlaceHolder()) ?>" value="<?php echo $leave_applications_add->EndDate->EditValue ?>"<?php echo $leave_applications_add->EndDate->editAttributes() ?>>
<?php if (!$leave_applications_add->EndDate->ReadOnly && !$leave_applications_add->EndDate->Disabled && !isset($leave_applications_add->EndDate->EditAttrs["readonly"]) && !isset($leave_applications_add->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_applicationsadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_applicationsadd", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $leave_applications_add->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_applications_add->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label id="elh_leave_applications_LeaveTypeCode" for="x_LeaveTypeCode" class="<?php echo $leave_applications_add->LeftColumnClass ?>"><?php echo $leave_applications_add->LeaveTypeCode->caption() ?><?php echo $leave_applications_add->LeaveTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_add->RightColumnClass ?>"><div <?php echo $leave_applications_add->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_applications_LeaveTypeCode">
<input type="text" data-table="leave_applications" data-field="x_LeaveTypeCode" name="x_LeaveTypeCode" id="x_LeaveTypeCode" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($leave_applications_add->LeaveTypeCode->getPlaceHolder()) ?>" value="<?php echo $leave_applications_add->LeaveTypeCode->EditValue ?>"<?php echo $leave_applications_add->LeaveTypeCode->editAttributes() ?>>
</span>
<?php echo $leave_applications_add->LeaveTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_applications_add->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_leave_applications_Location" for="x_Location" class="<?php echo $leave_applications_add->LeftColumnClass ?>"><?php echo $leave_applications_add->Location->caption() ?><?php echo $leave_applications_add->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_add->RightColumnClass ?>"><div <?php echo $leave_applications_add->Location->cellAttributes() ?>>
<span id="el_leave_applications_Location">
<input type="text" data-table="leave_applications" data-field="x_Location" name="x_Location" id="x_Location" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($leave_applications_add->Location->getPlaceHolder()) ?>" value="<?php echo $leave_applications_add->Location->EditValue ?>"<?php echo $leave_applications_add->Location->editAttributes() ?>>
</span>
<?php echo $leave_applications_add->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_applications_add->Status->Visible) { // Status ?>
	<div id="r_Status" class="form-group row">
		<label id="elh_leave_applications_Status" for="x_Status" class="<?php echo $leave_applications_add->LeftColumnClass ?>"><?php echo $leave_applications_add->Status->caption() ?><?php echo $leave_applications_add->Status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_applications_add->RightColumnClass ?>"><div <?php echo $leave_applications_add->Status->cellAttributes() ?>>
<span id="el_leave_applications_Status">
<input type="text" data-table="leave_applications" data-field="x_Status" name="x_Status" id="x_Status" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($leave_applications_add->Status->getPlaceHolder()) ?>" value="<?php echo $leave_applications_add->Status->EditValue ?>"<?php echo $leave_applications_add->Status->editAttributes() ?>>
</span>
<?php echo $leave_applications_add->Status->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_applications_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_applications_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_applications_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$leave_applications_add->showPageFooter();
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
$leave_applications_add->terminate();
?>