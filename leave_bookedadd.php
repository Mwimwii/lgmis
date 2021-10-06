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
$leave_booked_add = new leave_booked_add();

// Run the page
$leave_booked_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_booked_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_bookedadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fleave_bookedadd = currentForm = new ew.Form("fleave_bookedadd", "add");

	// Validate form
	fleave_bookedadd.validate = function() {
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
			<?php if ($leave_booked_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_booked_add->EmployeeID->caption(), $leave_booked_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_booked_add->EmployeeID->errorMessage()) ?>");
			<?php if ($leave_booked_add->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_booked_add->LeaveTypeCode->caption(), $leave_booked_add->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_booked_add->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_booked_add->StartDate->caption(), $leave_booked_add->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_booked_add->StartDate->errorMessage()) ?>");
			<?php if ($leave_booked_add->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_booked_add->EndDate->caption(), $leave_booked_add->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_booked_add->EndDate->errorMessage()) ?>");
			<?php if ($leave_booked_add->Location->Required) { ?>
				elm = this.getElements("x" + infix + "_Location");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_booked_add->Location->caption(), $leave_booked_add->Location->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_booked_add->Remarks->Required) { ?>
				elm = this.getElements("x" + infix + "_Remarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_booked_add->Remarks->caption(), $leave_booked_add->Remarks->RequiredErrorMessage)) ?>");
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
	fleave_bookedadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_bookedadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_bookedadd.lists["x_LeaveTypeCode"] = <?php echo $leave_booked_add->LeaveTypeCode->Lookup->toClientList($leave_booked_add) ?>;
	fleave_bookedadd.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_booked_add->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_bookedadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_booked_add->showPageHeader(); ?>
<?php
$leave_booked_add->showMessage();
?>
<form name="fleave_bookedadd" id="fleave_bookedadd" class="<?php echo $leave_booked_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_booked">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$leave_booked_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($leave_booked_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_leave_booked_EmployeeID" for="x_EmployeeID" class="<?php echo $leave_booked_add->LeftColumnClass ?>"><?php echo $leave_booked_add->EmployeeID->caption() ?><?php echo $leave_booked_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_booked_add->RightColumnClass ?>"><div <?php echo $leave_booked_add->EmployeeID->cellAttributes() ?>>
<span id="el_leave_booked_EmployeeID">
<input type="text" data-table="leave_booked" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_booked_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_booked_add->EmployeeID->EditValue ?>"<?php echo $leave_booked_add->EmployeeID->editAttributes() ?>>
</span>
<?php echo $leave_booked_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_booked_add->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label id="elh_leave_booked_LeaveTypeCode" for="x_LeaveTypeCode" class="<?php echo $leave_booked_add->LeftColumnClass ?>"><?php echo $leave_booked_add->LeaveTypeCode->caption() ?><?php echo $leave_booked_add->LeaveTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_booked_add->RightColumnClass ?>"><div <?php echo $leave_booked_add->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_booked_LeaveTypeCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_booked" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_booked_add->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x_LeaveTypeCode" name="x_LeaveTypeCode"<?php echo $leave_booked_add->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_booked_add->LeaveTypeCode->selectOptionListHtml("x_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_booked_add->LeaveTypeCode->Lookup->getParamTag($leave_booked_add, "p_x_LeaveTypeCode") ?>
</span>
<?php echo $leave_booked_add->LeaveTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_booked_add->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_leave_booked_StartDate" for="x_StartDate" class="<?php echo $leave_booked_add->LeftColumnClass ?>"><?php echo $leave_booked_add->StartDate->caption() ?><?php echo $leave_booked_add->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_booked_add->RightColumnClass ?>"><div <?php echo $leave_booked_add->StartDate->cellAttributes() ?>>
<span id="el_leave_booked_StartDate">
<input type="text" data-table="leave_booked" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($leave_booked_add->StartDate->getPlaceHolder()) ?>" value="<?php echo $leave_booked_add->StartDate->EditValue ?>"<?php echo $leave_booked_add->StartDate->editAttributes() ?>>
<?php if (!$leave_booked_add->StartDate->ReadOnly && !$leave_booked_add->StartDate->Disabled && !isset($leave_booked_add->StartDate->EditAttrs["readonly"]) && !isset($leave_booked_add->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_bookedadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_bookedadd", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $leave_booked_add->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_booked_add->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_leave_booked_EndDate" for="x_EndDate" class="<?php echo $leave_booked_add->LeftColumnClass ?>"><?php echo $leave_booked_add->EndDate->caption() ?><?php echo $leave_booked_add->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_booked_add->RightColumnClass ?>"><div <?php echo $leave_booked_add->EndDate->cellAttributes() ?>>
<span id="el_leave_booked_EndDate">
<input type="text" data-table="leave_booked" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($leave_booked_add->EndDate->getPlaceHolder()) ?>" value="<?php echo $leave_booked_add->EndDate->EditValue ?>"<?php echo $leave_booked_add->EndDate->editAttributes() ?>>
<?php if (!$leave_booked_add->EndDate->ReadOnly && !$leave_booked_add->EndDate->Disabled && !isset($leave_booked_add->EndDate->EditAttrs["readonly"]) && !isset($leave_booked_add->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fleave_bookedadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fleave_bookedadd", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $leave_booked_add->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_booked_add->Location->Visible) { // Location ?>
	<div id="r_Location" class="form-group row">
		<label id="elh_leave_booked_Location" for="x_Location" class="<?php echo $leave_booked_add->LeftColumnClass ?>"><?php echo $leave_booked_add->Location->caption() ?><?php echo $leave_booked_add->Location->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_booked_add->RightColumnClass ?>"><div <?php echo $leave_booked_add->Location->cellAttributes() ?>>
<span id="el_leave_booked_Location">
<input type="text" data-table="leave_booked" data-field="x_Location" name="x_Location" id="x_Location" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_booked_add->Location->getPlaceHolder()) ?>" value="<?php echo $leave_booked_add->Location->EditValue ?>"<?php echo $leave_booked_add->Location->editAttributes() ?>>
</span>
<?php echo $leave_booked_add->Location->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_booked_add->Remarks->Visible) { // Remarks ?>
	<div id="r_Remarks" class="form-group row">
		<label id="elh_leave_booked_Remarks" for="x_Remarks" class="<?php echo $leave_booked_add->LeftColumnClass ?>"><?php echo $leave_booked_add->Remarks->caption() ?><?php echo $leave_booked_add->Remarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_booked_add->RightColumnClass ?>"><div <?php echo $leave_booked_add->Remarks->cellAttributes() ?>>
<span id="el_leave_booked_Remarks">
<input type="text" data-table="leave_booked" data-field="x_Remarks" name="x_Remarks" id="x_Remarks" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($leave_booked_add->Remarks->getPlaceHolder()) ?>" value="<?php echo $leave_booked_add->Remarks->EditValue ?>"<?php echo $leave_booked_add->Remarks->editAttributes() ?>>
</span>
<?php echo $leave_booked_add->Remarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_booked_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_booked_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_booked_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$leave_booked_add->showPageFooter();
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
$leave_booked_add->terminate();
?>