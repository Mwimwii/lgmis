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
$leave_accrued_trans_add = new leave_accrued_trans_add();

// Run the page
$leave_accrued_trans_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_accrued_trans_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_accrued_transadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fleave_accrued_transadd = currentForm = new ew.Form("fleave_accrued_transadd", "add");

	// Validate form
	fleave_accrued_transadd.validate = function() {
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
			<?php if ($leave_accrued_trans_add->Year->Required) { ?>
				elm = this.getElements("x" + infix + "_Year");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrued_trans_add->Year->caption(), $leave_accrued_trans_add->Year->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Year");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrued_trans_add->Year->errorMessage()) ?>");
			<?php if ($leave_accrued_trans_add->RunMonth->Required) { ?>
				elm = this.getElements("x" + infix + "_RunMonth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrued_trans_add->RunMonth->caption(), $leave_accrued_trans_add->RunMonth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_RunMonth");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrued_trans_add->RunMonth->errorMessage()) ?>");
			<?php if ($leave_accrued_trans_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrued_trans_add->EmployeeID->caption(), $leave_accrued_trans_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrued_trans_add->EmployeeID->errorMessage()) ?>");
			<?php if ($leave_accrued_trans_add->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrued_trans_add->LeaveTypeCode->caption(), $leave_accrued_trans_add->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrued_trans_add->LeaveTypeCode->errorMessage()) ?>");
			<?php if ($leave_accrued_trans_add->LeaveAccrued->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveAccrued");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrued_trans_add->LeaveAccrued->caption(), $leave_accrued_trans_add->LeaveAccrued->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveAccrued");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrued_trans_add->LeaveAccrued->errorMessage()) ?>");
			<?php if ($leave_accrued_trans_add->LastAccrualDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastAccrualDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrued_trans_add->LastAccrualDate->caption(), $leave_accrued_trans_add->LastAccrualDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastAccrualDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrued_trans_add->LastAccrualDate->errorMessage()) ?>");
			<?php if ($leave_accrued_trans_add->LeaveLost->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveLost");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrued_trans_add->LeaveLost->caption(), $leave_accrued_trans_add->LeaveLost->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LeaveLost");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrued_trans_add->LeaveLost->errorMessage()) ?>");
			<?php if ($leave_accrued_trans_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrued_trans_add->LACode->caption(), $leave_accrued_trans_add->LACode->RequiredErrorMessage)) ?>");
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
	fleave_accrued_transadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_accrued_transadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fleave_accrued_transadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_accrued_trans_add->showPageHeader(); ?>
<?php
$leave_accrued_trans_add->showMessage();
?>
<form name="fleave_accrued_transadd" id="fleave_accrued_transadd" class="<?php echo $leave_accrued_trans_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_accrued_trans">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$leave_accrued_trans_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($leave_accrued_trans_add->Year->Visible) { // Year ?>
	<div id="r_Year" class="form-group row">
		<label id="elh_leave_accrued_trans_Year" for="x_Year" class="<?php echo $leave_accrued_trans_add->LeftColumnClass ?>"><?php echo $leave_accrued_trans_add->Year->caption() ?><?php echo $leave_accrued_trans_add->Year->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrued_trans_add->RightColumnClass ?>"><div <?php echo $leave_accrued_trans_add->Year->cellAttributes() ?>>
<span id="el_leave_accrued_trans_Year">
<input type="text" data-table="leave_accrued_trans" data-field="x_Year" name="x_Year" id="x_Year" size="30" placeholder="<?php echo HtmlEncode($leave_accrued_trans_add->Year->getPlaceHolder()) ?>" value="<?php echo $leave_accrued_trans_add->Year->EditValue ?>"<?php echo $leave_accrued_trans_add->Year->editAttributes() ?>>
</span>
<?php echo $leave_accrued_trans_add->Year->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrued_trans_add->RunMonth->Visible) { // RunMonth ?>
	<div id="r_RunMonth" class="form-group row">
		<label id="elh_leave_accrued_trans_RunMonth" for="x_RunMonth" class="<?php echo $leave_accrued_trans_add->LeftColumnClass ?>"><?php echo $leave_accrued_trans_add->RunMonth->caption() ?><?php echo $leave_accrued_trans_add->RunMonth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrued_trans_add->RightColumnClass ?>"><div <?php echo $leave_accrued_trans_add->RunMonth->cellAttributes() ?>>
<span id="el_leave_accrued_trans_RunMonth">
<input type="text" data-table="leave_accrued_trans" data-field="x_RunMonth" name="x_RunMonth" id="x_RunMonth" size="30" placeholder="<?php echo HtmlEncode($leave_accrued_trans_add->RunMonth->getPlaceHolder()) ?>" value="<?php echo $leave_accrued_trans_add->RunMonth->EditValue ?>"<?php echo $leave_accrued_trans_add->RunMonth->editAttributes() ?>>
</span>
<?php echo $leave_accrued_trans_add->RunMonth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrued_trans_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_leave_accrued_trans_EmployeeID" for="x_EmployeeID" class="<?php echo $leave_accrued_trans_add->LeftColumnClass ?>"><?php echo $leave_accrued_trans_add->EmployeeID->caption() ?><?php echo $leave_accrued_trans_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrued_trans_add->RightColumnClass ?>"><div <?php echo $leave_accrued_trans_add->EmployeeID->cellAttributes() ?>>
<span id="el_leave_accrued_trans_EmployeeID">
<input type="text" data-table="leave_accrued_trans" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($leave_accrued_trans_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $leave_accrued_trans_add->EmployeeID->EditValue ?>"<?php echo $leave_accrued_trans_add->EmployeeID->editAttributes() ?>>
</span>
<?php echo $leave_accrued_trans_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrued_trans_add->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label id="elh_leave_accrued_trans_LeaveTypeCode" for="x_LeaveTypeCode" class="<?php echo $leave_accrued_trans_add->LeftColumnClass ?>"><?php echo $leave_accrued_trans_add->LeaveTypeCode->caption() ?><?php echo $leave_accrued_trans_add->LeaveTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrued_trans_add->RightColumnClass ?>"><div <?php echo $leave_accrued_trans_add->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_accrued_trans_LeaveTypeCode">
<input type="text" data-table="leave_accrued_trans" data-field="x_LeaveTypeCode" name="x_LeaveTypeCode" id="x_LeaveTypeCode" size="30" placeholder="<?php echo HtmlEncode($leave_accrued_trans_add->LeaveTypeCode->getPlaceHolder()) ?>" value="<?php echo $leave_accrued_trans_add->LeaveTypeCode->EditValue ?>"<?php echo $leave_accrued_trans_add->LeaveTypeCode->editAttributes() ?>>
</span>
<?php echo $leave_accrued_trans_add->LeaveTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrued_trans_add->LeaveAccrued->Visible) { // LeaveAccrued ?>
	<div id="r_LeaveAccrued" class="form-group row">
		<label id="elh_leave_accrued_trans_LeaveAccrued" for="x_LeaveAccrued" class="<?php echo $leave_accrued_trans_add->LeftColumnClass ?>"><?php echo $leave_accrued_trans_add->LeaveAccrued->caption() ?><?php echo $leave_accrued_trans_add->LeaveAccrued->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrued_trans_add->RightColumnClass ?>"><div <?php echo $leave_accrued_trans_add->LeaveAccrued->cellAttributes() ?>>
<span id="el_leave_accrued_trans_LeaveAccrued">
<input type="text" data-table="leave_accrued_trans" data-field="x_LeaveAccrued" name="x_LeaveAccrued" id="x_LeaveAccrued" size="30" placeholder="<?php echo HtmlEncode($leave_accrued_trans_add->LeaveAccrued->getPlaceHolder()) ?>" value="<?php echo $leave_accrued_trans_add->LeaveAccrued->EditValue ?>"<?php echo $leave_accrued_trans_add->LeaveAccrued->editAttributes() ?>>
</span>
<?php echo $leave_accrued_trans_add->LeaveAccrued->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrued_trans_add->LastAccrualDate->Visible) { // LastAccrualDate ?>
	<div id="r_LastAccrualDate" class="form-group row">
		<label id="elh_leave_accrued_trans_LastAccrualDate" for="x_LastAccrualDate" class="<?php echo $leave_accrued_trans_add->LeftColumnClass ?>"><?php echo $leave_accrued_trans_add->LastAccrualDate->caption() ?><?php echo $leave_accrued_trans_add->LastAccrualDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrued_trans_add->RightColumnClass ?>"><div <?php echo $leave_accrued_trans_add->LastAccrualDate->cellAttributes() ?>>
<span id="el_leave_accrued_trans_LastAccrualDate">
<input type="text" data-table="leave_accrued_trans" data-field="x_LastAccrualDate" name="x_LastAccrualDate" id="x_LastAccrualDate" placeholder="<?php echo HtmlEncode($leave_accrued_trans_add->LastAccrualDate->getPlaceHolder()) ?>" value="<?php echo $leave_accrued_trans_add->LastAccrualDate->EditValue ?>"<?php echo $leave_accrued_trans_add->LastAccrualDate->editAttributes() ?>>
</span>
<?php echo $leave_accrued_trans_add->LastAccrualDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrued_trans_add->LeaveLost->Visible) { // LeaveLost ?>
	<div id="r_LeaveLost" class="form-group row">
		<label id="elh_leave_accrued_trans_LeaveLost" for="x_LeaveLost" class="<?php echo $leave_accrued_trans_add->LeftColumnClass ?>"><?php echo $leave_accrued_trans_add->LeaveLost->caption() ?><?php echo $leave_accrued_trans_add->LeaveLost->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrued_trans_add->RightColumnClass ?>"><div <?php echo $leave_accrued_trans_add->LeaveLost->cellAttributes() ?>>
<span id="el_leave_accrued_trans_LeaveLost">
<input type="text" data-table="leave_accrued_trans" data-field="x_LeaveLost" name="x_LeaveLost" id="x_LeaveLost" size="30" placeholder="<?php echo HtmlEncode($leave_accrued_trans_add->LeaveLost->getPlaceHolder()) ?>" value="<?php echo $leave_accrued_trans_add->LeaveLost->EditValue ?>"<?php echo $leave_accrued_trans_add->LeaveLost->editAttributes() ?>>
</span>
<?php echo $leave_accrued_trans_add->LeaveLost->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrued_trans_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_leave_accrued_trans_LACode" for="x_LACode" class="<?php echo $leave_accrued_trans_add->LeftColumnClass ?>"><?php echo $leave_accrued_trans_add->LACode->caption() ?><?php echo $leave_accrued_trans_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrued_trans_add->RightColumnClass ?>"><div <?php echo $leave_accrued_trans_add->LACode->cellAttributes() ?>>
<span id="el_leave_accrued_trans_LACode">
<input type="text" data-table="leave_accrued_trans" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($leave_accrued_trans_add->LACode->getPlaceHolder()) ?>" value="<?php echo $leave_accrued_trans_add->LACode->EditValue ?>"<?php echo $leave_accrued_trans_add->LACode->editAttributes() ?>>
</span>
<?php echo $leave_accrued_trans_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_accrued_trans_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_accrued_trans_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_accrued_trans_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$leave_accrued_trans_add->showPageFooter();
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
$leave_accrued_trans_add->terminate();
?>