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
$leave_accrual_ref_edit = new leave_accrual_ref_edit();

// Run the page
$leave_accrual_ref_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_accrual_ref_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_accrual_refedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fleave_accrual_refedit = currentForm = new ew.Form("fleave_accrual_refedit", "edit");

	// Validate form
	fleave_accrual_refedit.validate = function() {
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
			<?php if ($leave_accrual_ref_edit->Division->Required) { ?>
				elm = this.getElements("x" + infix + "_Division");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrual_ref_edit->Division->caption(), $leave_accrual_ref_edit->Division->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_accrual_ref_edit->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrual_ref_edit->LeaveTypeCode->caption(), $leave_accrual_ref_edit->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_accrual_ref_edit->AnnualEntitled->Required) { ?>
				elm = this.getElements("x" + infix + "_AnnualEntitled");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrual_ref_edit->AnnualEntitled->caption(), $leave_accrual_ref_edit->AnnualEntitled->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AnnualEntitled");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrual_ref_edit->AnnualEntitled->errorMessage()) ?>");
			<?php if ($leave_accrual_ref_edit->AnnualCarryover->Required) { ?>
				elm = this.getElements("x" + infix + "_AnnualCarryover");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrual_ref_edit->AnnualCarryover->caption(), $leave_accrual_ref_edit->AnnualCarryover->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AnnualCarryover");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrual_ref_edit->AnnualCarryover->errorMessage()) ?>");
			<?php if ($leave_accrual_ref_edit->MaxLeaveTaken->Required) { ?>
				elm = this.getElements("x" + infix + "_MaxLeaveTaken");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_accrual_ref_edit->MaxLeaveTaken->caption(), $leave_accrual_ref_edit->MaxLeaveTaken->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MaxLeaveTaken");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($leave_accrual_ref_edit->MaxLeaveTaken->errorMessage()) ?>");

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
	fleave_accrual_refedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_accrual_refedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_accrual_refedit.lists["x_Division"] = <?php echo $leave_accrual_ref_edit->Division->Lookup->toClientList($leave_accrual_ref_edit) ?>;
	fleave_accrual_refedit.lists["x_Division"].options = <?php echo JsonEncode($leave_accrual_ref_edit->Division->lookupOptions()) ?>;
	fleave_accrual_refedit.lists["x_LeaveTypeCode"] = <?php echo $leave_accrual_ref_edit->LeaveTypeCode->Lookup->toClientList($leave_accrual_ref_edit) ?>;
	fleave_accrual_refedit.lists["x_LeaveTypeCode"].options = <?php echo JsonEncode($leave_accrual_ref_edit->LeaveTypeCode->lookupOptions()) ?>;
	loadjs.done("fleave_accrual_refedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_accrual_ref_edit->showPageHeader(); ?>
<?php
$leave_accrual_ref_edit->showMessage();
?>
<?php if (!$leave_accrual_ref_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_accrual_ref_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fleave_accrual_refedit" id="fleave_accrual_refedit" class="<?php echo $leave_accrual_ref_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_accrual_ref">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$leave_accrual_ref_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($leave_accrual_ref_edit->Division->Visible) { // Division ?>
	<div id="r_Division" class="form-group row">
		<label id="elh_leave_accrual_ref_Division" for="x_Division" class="<?php echo $leave_accrual_ref_edit->LeftColumnClass ?>"><?php echo $leave_accrual_ref_edit->Division->caption() ?><?php echo $leave_accrual_ref_edit->Division->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrual_ref_edit->RightColumnClass ?>"><div <?php echo $leave_accrual_ref_edit->Division->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_accrual_ref" data-field="x_Division" data-value-separator="<?php echo $leave_accrual_ref_edit->Division->displayValueSeparatorAttribute() ?>" id="x_Division" name="x_Division"<?php echo $leave_accrual_ref_edit->Division->editAttributes() ?>>
			<?php echo $leave_accrual_ref_edit->Division->selectOptionListHtml("x_Division") ?>
		</select>
</div>
<?php echo $leave_accrual_ref_edit->Division->Lookup->getParamTag($leave_accrual_ref_edit, "p_x_Division") ?>
<input type="hidden" data-table="leave_accrual_ref" data-field="x_Division" name="o_Division" id="o_Division" value="<?php echo HtmlEncode($leave_accrual_ref_edit->Division->OldValue != null ? $leave_accrual_ref_edit->Division->OldValue : $leave_accrual_ref_edit->Division->CurrentValue) ?>">
<?php echo $leave_accrual_ref_edit->Division->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrual_ref_edit->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label id="elh_leave_accrual_ref_LeaveTypeCode" for="x_LeaveTypeCode" class="<?php echo $leave_accrual_ref_edit->LeftColumnClass ?>"><?php echo $leave_accrual_ref_edit->LeaveTypeCode->caption() ?><?php echo $leave_accrual_ref_edit->LeaveTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrual_ref_edit->RightColumnClass ?>"><div <?php echo $leave_accrual_ref_edit->LeaveTypeCode->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="leave_accrual_ref" data-field="x_LeaveTypeCode" data-value-separator="<?php echo $leave_accrual_ref_edit->LeaveTypeCode->displayValueSeparatorAttribute() ?>" id="x_LeaveTypeCode" name="x_LeaveTypeCode"<?php echo $leave_accrual_ref_edit->LeaveTypeCode->editAttributes() ?>>
			<?php echo $leave_accrual_ref_edit->LeaveTypeCode->selectOptionListHtml("x_LeaveTypeCode") ?>
		</select>
</div>
<?php echo $leave_accrual_ref_edit->LeaveTypeCode->Lookup->getParamTag($leave_accrual_ref_edit, "p_x_LeaveTypeCode") ?>
<input type="hidden" data-table="leave_accrual_ref" data-field="x_LeaveTypeCode" name="o_LeaveTypeCode" id="o_LeaveTypeCode" value="<?php echo HtmlEncode($leave_accrual_ref_edit->LeaveTypeCode->OldValue != null ? $leave_accrual_ref_edit->LeaveTypeCode->OldValue : $leave_accrual_ref_edit->LeaveTypeCode->CurrentValue) ?>">
<?php echo $leave_accrual_ref_edit->LeaveTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrual_ref_edit->AnnualEntitled->Visible) { // AnnualEntitled ?>
	<div id="r_AnnualEntitled" class="form-group row">
		<label id="elh_leave_accrual_ref_AnnualEntitled" for="x_AnnualEntitled" class="<?php echo $leave_accrual_ref_edit->LeftColumnClass ?>"><?php echo $leave_accrual_ref_edit->AnnualEntitled->caption() ?><?php echo $leave_accrual_ref_edit->AnnualEntitled->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrual_ref_edit->RightColumnClass ?>"><div <?php echo $leave_accrual_ref_edit->AnnualEntitled->cellAttributes() ?>>
<span id="el_leave_accrual_ref_AnnualEntitled">
<input type="text" data-table="leave_accrual_ref" data-field="x_AnnualEntitled" name="x_AnnualEntitled" id="x_AnnualEntitled" size="30" placeholder="<?php echo HtmlEncode($leave_accrual_ref_edit->AnnualEntitled->getPlaceHolder()) ?>" value="<?php echo $leave_accrual_ref_edit->AnnualEntitled->EditValue ?>"<?php echo $leave_accrual_ref_edit->AnnualEntitled->editAttributes() ?>>
</span>
<?php echo $leave_accrual_ref_edit->AnnualEntitled->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrual_ref_edit->AnnualCarryover->Visible) { // AnnualCarryover ?>
	<div id="r_AnnualCarryover" class="form-group row">
		<label id="elh_leave_accrual_ref_AnnualCarryover" for="x_AnnualCarryover" class="<?php echo $leave_accrual_ref_edit->LeftColumnClass ?>"><?php echo $leave_accrual_ref_edit->AnnualCarryover->caption() ?><?php echo $leave_accrual_ref_edit->AnnualCarryover->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrual_ref_edit->RightColumnClass ?>"><div <?php echo $leave_accrual_ref_edit->AnnualCarryover->cellAttributes() ?>>
<span id="el_leave_accrual_ref_AnnualCarryover">
<input type="text" data-table="leave_accrual_ref" data-field="x_AnnualCarryover" name="x_AnnualCarryover" id="x_AnnualCarryover" size="30" placeholder="<?php echo HtmlEncode($leave_accrual_ref_edit->AnnualCarryover->getPlaceHolder()) ?>" value="<?php echo $leave_accrual_ref_edit->AnnualCarryover->EditValue ?>"<?php echo $leave_accrual_ref_edit->AnnualCarryover->editAttributes() ?>>
</span>
<?php echo $leave_accrual_ref_edit->AnnualCarryover->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_accrual_ref_edit->MaxLeaveTaken->Visible) { // MaxLeaveTaken ?>
	<div id="r_MaxLeaveTaken" class="form-group row">
		<label id="elh_leave_accrual_ref_MaxLeaveTaken" for="x_MaxLeaveTaken" class="<?php echo $leave_accrual_ref_edit->LeftColumnClass ?>"><?php echo $leave_accrual_ref_edit->MaxLeaveTaken->caption() ?><?php echo $leave_accrual_ref_edit->MaxLeaveTaken->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_accrual_ref_edit->RightColumnClass ?>"><div <?php echo $leave_accrual_ref_edit->MaxLeaveTaken->cellAttributes() ?>>
<span id="el_leave_accrual_ref_MaxLeaveTaken">
<input type="text" data-table="leave_accrual_ref" data-field="x_MaxLeaveTaken" name="x_MaxLeaveTaken" id="x_MaxLeaveTaken" size="30" placeholder="<?php echo HtmlEncode($leave_accrual_ref_edit->MaxLeaveTaken->getPlaceHolder()) ?>" value="<?php echo $leave_accrual_ref_edit->MaxLeaveTaken->EditValue ?>"<?php echo $leave_accrual_ref_edit->MaxLeaveTaken->editAttributes() ?>>
</span>
<?php echo $leave_accrual_ref_edit->MaxLeaveTaken->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_accrual_ref_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_accrual_ref_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_accrual_ref_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$leave_accrual_ref_edit->IsModal) { ?>
<?php echo $leave_accrual_ref_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$leave_accrual_ref_edit->showPageFooter();
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
$leave_accrual_ref_edit->terminate();
?>