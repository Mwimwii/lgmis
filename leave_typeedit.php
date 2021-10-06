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
$leave_type_edit = new leave_type_edit();

// Run the page
$leave_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fleave_typeedit = currentForm = new ew.Form("fleave_typeedit", "edit");

	// Validate form
	fleave_typeedit.validate = function() {
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
			<?php if ($leave_type_edit->LeaveTypeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_type_edit->LeaveTypeCode->caption(), $leave_type_edit->LeaveTypeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_type_edit->LeaveTypeName->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_type_edit->LeaveTypeName->caption(), $leave_type_edit->LeaveTypeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_type_edit->Accrued->Required) { ?>
				elm = this.getElements("x" + infix + "_Accrued");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_type_edit->Accrued->caption(), $leave_type_edit->Accrued->RequiredErrorMessage)) ?>");
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
	fleave_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_typeedit.lists["x_Accrued"] = <?php echo $leave_type_edit->Accrued->Lookup->toClientList($leave_type_edit) ?>;
	fleave_typeedit.lists["x_Accrued"].options = <?php echo JsonEncode($leave_type_edit->Accrued->lookupOptions()) ?>;
	loadjs.done("fleave_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_type_edit->showPageHeader(); ?>
<?php
$leave_type_edit->showMessage();
?>
<?php if (!$leave_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fleave_typeedit" id="fleave_typeedit" class="<?php echo $leave_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$leave_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($leave_type_edit->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<div id="r_LeaveTypeCode" class="form-group row">
		<label id="elh_leave_type_LeaveTypeCode" class="<?php echo $leave_type_edit->LeftColumnClass ?>"><?php echo $leave_type_edit->LeaveTypeCode->caption() ?><?php echo $leave_type_edit->LeaveTypeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_type_edit->RightColumnClass ?>"><div <?php echo $leave_type_edit->LeaveTypeCode->cellAttributes() ?>>
<span id="el_leave_type_LeaveTypeCode">
<span<?php echo $leave_type_edit->LeaveTypeCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($leave_type_edit->LeaveTypeCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="leave_type" data-field="x_LeaveTypeCode" name="x_LeaveTypeCode" id="x_LeaveTypeCode" value="<?php echo HtmlEncode($leave_type_edit->LeaveTypeCode->CurrentValue) ?>">
<?php echo $leave_type_edit->LeaveTypeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_type_edit->LeaveTypeName->Visible) { // LeaveTypeName ?>
	<div id="r_LeaveTypeName" class="form-group row">
		<label id="elh_leave_type_LeaveTypeName" for="x_LeaveTypeName" class="<?php echo $leave_type_edit->LeftColumnClass ?>"><?php echo $leave_type_edit->LeaveTypeName->caption() ?><?php echo $leave_type_edit->LeaveTypeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_type_edit->RightColumnClass ?>"><div <?php echo $leave_type_edit->LeaveTypeName->cellAttributes() ?>>
<span id="el_leave_type_LeaveTypeName">
<input type="text" data-table="leave_type" data-field="x_LeaveTypeName" name="x_LeaveTypeName" id="x_LeaveTypeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($leave_type_edit->LeaveTypeName->getPlaceHolder()) ?>" value="<?php echo $leave_type_edit->LeaveTypeName->EditValue ?>"<?php echo $leave_type_edit->LeaveTypeName->editAttributes() ?>>
</span>
<?php echo $leave_type_edit->LeaveTypeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_type_edit->Accrued->Visible) { // Accrued ?>
	<div id="r_Accrued" class="form-group row">
		<label id="elh_leave_type_Accrued" class="<?php echo $leave_type_edit->LeftColumnClass ?>"><?php echo $leave_type_edit->Accrued->caption() ?><?php echo $leave_type_edit->Accrued->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_type_edit->RightColumnClass ?>"><div <?php echo $leave_type_edit->Accrued->cellAttributes() ?>>
<span id="el_leave_type_Accrued">
<div id="tp_x_Accrued" class="ew-template"><input type="radio" class="custom-control-input" data-table="leave_type" data-field="x_Accrued" data-value-separator="<?php echo $leave_type_edit->Accrued->displayValueSeparatorAttribute() ?>" name="x_Accrued" id="x_Accrued" value="{value}"<?php echo $leave_type_edit->Accrued->editAttributes() ?>></div>
<div id="dsl_x_Accrued" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $leave_type_edit->Accrued->radioButtonListHtml(FALSE, "x_Accrued") ?>
</div></div>
<?php echo $leave_type_edit->Accrued->Lookup->getParamTag($leave_type_edit, "p_x_Accrued") ?>
</span>
<?php echo $leave_type_edit->Accrued->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$leave_type_edit->IsModal) { ?>
<?php echo $leave_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$leave_type_edit->showPageFooter();
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
$leave_type_edit->terminate();
?>