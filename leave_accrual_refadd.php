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
$leave_accrual_ref_add = new leave_accrual_ref_add();

// Run the page
$leave_accrual_ref_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_accrual_ref_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_accrual_refadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fleave_accrual_refadd = currentForm = new ew.Form("fleave_accrual_refadd", "add");

	// Validate form
	fleave_accrual_refadd.validate = function() {
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
			<?php if ($leave_accrual_ref_add->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrual_ref_add->Division->caption(), $leave_accrual_ref_add->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_accrual_ref_add->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrual_ref_add->LeaveTypeCode->caption(), $leave_accrual_ref_add->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_accrual_ref_add->AnnualEntitled->Required) { ?>
				elm = this.getElements("x" + infix + "_AnnualEntitled");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrual_ref_add->AnnualEntitled->caption(), $leave_accrual_ref_add->AnnualEntitled->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AnnualEntitled");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrual_ref_add->AnnualEntitled->errorMessage()) ?>");
			<?php if ($leave_accrual_ref_add->AnnualCarryover->Required) { ?>
				elm = this.getElements("x" + infix + "_AnnualCarryover");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrual_ref_add->AnnualCarryover->caption(), $leave_accrual_ref_add->AnnualCarryover->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AnnualCarryover");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrual_ref_add->AnnualCarryover->errorMessage()) ?>");
			<?php if ($leave_accrual_ref_add->MaxLeaveTaken->Required) { ?>
				elm = this.getElements("x" + infix + "_MaxLeaveTaken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrual_ref_add->MaxLeaveTaken->caption(), $leave_accrual_ref_add->MaxLeaveTaken->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MaxLeaveTaken");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrual_ref_add->MaxLeaveTaken->errorMessage()) ?>");

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
	fleave_accrual_refadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_accrual_refadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_accrual_refadd.lists["x_Division"] = <?php echo $leave_accrual_ref_add->Division->Lookup->toClientList($leave_accrual_ref_add) ?>;
	fleave_accrual_refadd.lists["x_Division"].options = <?php echo JsonEncode($leave_accrual_ref_add->Division->lookupOptions()) ?>;
	fleave_accrual_refadd.lists["x_LeaveTypeCode"] = <?php echo $leave_accrual_ref_add->LeaveTypeCode->Lookup->toClientList($leave_accrual_ref_add) ?>;
	fleave_accrual_refadd.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_accrual_ref_add->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_accrual_refadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_accrual_ref_add->showPageHeader(); ?>
<?php
$leave_accrual_ref_add->showMessage();
?>
<form name="fleave_accrual_refadd" id="fleave_accrual_refadd" class="<?php echo $leave_accrual_ref_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_accrual_ref">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$leave_accrual_ref_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($leave_accrual_ref_add->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label id="elh_leave_accrual_ref_Division" for="x_Division" class="<?php echo $leave_accrual_ref_add->LeftColumnClass ?>"><?php echo $leave_accrual_ref_add->Division->caption() ?><?php echo $leave_accrual_ref_add->Division->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrual_ref_add->RightColumnClass ?>"><div <?php echo $leave_accrual_ref_add->Division->cellAttributes() ?>>
<span id="el_leave_accrual_ref_Division">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_accrual_ref" data-field="x_Division" data-value-separator="<?php echo $leave_accrual_ref_add->Division->displayValueSeparatorAttribute() ?>" id="x_Division" name="x_Division"<?php echo $leave_accrual_ref_add->Division->editAttributes() ?>>
			<?php echo $leave_accrual_ref_add->Division->selectOptionListHtml("x_Division") ?>
		</select>
</div>
<?php echo $leave_accrual_ref_add->Division->Lookup->getParamTag($leave_accrual_ref_add, "p_x_Division") ?>
</span>
<?php echo $leave_accrual_ref_add->Division->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrual_ref_add->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label id="elh_leave_accrual_ref_LeaveTypeCode" for="x_LeaveTypeCode" class="<?php echo $leave_accrual_ref_add->LeftColumnClass ?>"><?php echo $leave_accrual_ref_add->LeaveTypeCode->caption() ?><?php echo $leave_accrual_ref_add->LeaveTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrual_ref_add->RightColumnClass ?>"><div <?php echo $leave_accrual_ref_add->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_accrual_ref_LeaveTypeCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_accrual_ref" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_accrual_ref_add->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x_LeaveTypeCode" name="x_LeaveTypeCode"<?php echo $leave_accrual_ref_add->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_accrual_ref_add->LeaveTypeCode->selectOptionListHtml("x_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_accrual_ref_add->LeaveTypeCode->Lookup->getParamTag($leave_accrual_ref_add, "p_x_LeaveTypeCode") ?>
</span>
<?php echo $leave_accrual_ref_add->LeaveTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrual_ref_add->AnnualEntitled->Visible) { // AnnualEntitled ?>
	<div id="r_AnnualEntitled" class="form-group row">
		<label id="elh_leave_accrual_ref_AnnualEntitled" for="x_AnnualEntitled" class="<?php echo $leave_accrual_ref_add->LeftColumnClass ?>"><?php echo $leave_accrual_ref_add->AnnualEntitled->caption() ?><?php echo $leave_accrual_ref_add->AnnualEntitled->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrual_ref_add->RightColumnClass ?>"><div <?php echo $leave_accrual_ref_add->AnnualEntitled->cellAttributes() ?>>
<span id="el_leave_accrual_ref_AnnualEntitled">
<input type="text" data-table="leave_accrual_ref" data-field="x_AnnualEntitled" name="x_AnnualEntitled" id="x_AnnualEntitled" size="30" placeholder="<?php echo HtmlEncode($leave_accrual_ref_add->AnnualEntitled->getPlaceHolder()) ?>" value="<?php echo $leave_accrual_ref_add->AnnualEntitled->EditValue ?>"<?php echo $leave_accrual_ref_add->AnnualEntitled->editAttributes() ?>>
</span>
<?php echo $leave_accrual_ref_add->AnnualEntitled->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrual_ref_add->AnnualCarryover->Visible) { // AnnualCarryover ?>
	<div id="r_AnnualCarryover" class="form-group row">
		<label id="elh_leave_accrual_ref_AnnualCarryover" for="x_AnnualCarryover" class="<?php echo $leave_accrual_ref_add->LeftColumnClass ?>"><?php echo $leave_accrual_ref_add->AnnualCarryover->caption() ?><?php echo $leave_accrual_ref_add->AnnualCarryover->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrual_ref_add->RightColumnClass ?>"><div <?php echo $leave_accrual_ref_add->AnnualCarryover->cellAttributes() ?>>
<span id="el_leave_accrual_ref_AnnualCarryover">
<input type="text" data-table="leave_accrual_ref" data-field="x_AnnualCarryover" name="x_AnnualCarryover" id="x_AnnualCarryover" size="30" placeholder="<?php echo HtmlEncode($leave_accrual_ref_add->AnnualCarryover->getPlaceHolder()) ?>" value="<?php echo $leave_accrual_ref_add->AnnualCarryover->EditValue ?>"<?php echo $leave_accrual_ref_add->AnnualCarryover->editAttributes() ?>>
</span>
<?php echo $leave_accrual_ref_add->AnnualCarryover->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrual_ref_add->MaxLeaveTaken->Visible) { // MaxLeaveTaken ?>
	<div id="r_MaxLeaveTaken" class="form-group row">
		<label id="elh_leave_accrual_ref_MaxLeaveTaken" for="x_MaxLeaveTaken" class="<?php echo $leave_accrual_ref_add->LeftColumnClass ?>"><?php echo $leave_accrual_ref_add->MaxLeaveTaken->caption() ?><?php echo $leave_accrual_ref_add->MaxLeaveTaken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrual_ref_add->RightColumnClass ?>"><div <?php echo $leave_accrual_ref_add->MaxLeaveTaken->cellAttributes() ?>>
<span id="el_leave_accrual_ref_MaxLeaveTaken">
<input type="text" data-table="leave_accrual_ref" data-field="x_MaxLeaveTaken" name="x_MaxLeaveTaken" id="x_MaxLeaveTaken" size="30" placeholder="<?php echo HtmlEncode($leave_accrual_ref_add->MaxLeaveTaken->getPlaceHolder()) ?>" value="<?php echo $leave_accrual_ref_add->MaxLeaveTaken->EditValue ?>"<?php echo $leave_accrual_ref_add->MaxLeaveTaken->editAttributes() ?>>
</span>
<?php echo $leave_accrual_ref_add->MaxLeaveTaken->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_accrual_ref_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_accrual_ref_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_accrual_ref_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$leave_accrual_ref_add->showPageFooter();
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
$leave_accrual_ref_add->terminate();
?>