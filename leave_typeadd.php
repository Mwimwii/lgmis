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
$leave_type_add = new leave_type_add();

// Run the page
$leave_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fleave_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fleave_typeadd = currentForm = new ew.Form("fleave_typeadd", "add");

	// Validate form
	fleave_typeadd.validate = function() {
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
			<?php if ($leave_type_add->LeaveTypeName->Required) { ?>
				elm = this.getElements("x" + infix + "_LeaveTypeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_type_add->LeaveTypeName->caption(), $leave_type_add->LeaveTypeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($leave_type_add->Accrued->Required) { ?>
				elm = this.getElements("x" + infix + "_Accrued");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $leave_type_add->Accrued->caption(), $leave_type_add->Accrued->RequiredErrorMessage)) ?>");
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
	fleave_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fleave_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fleave_typeadd.lists["x_Accrued"] = <?php echo $leave_type_add->Accrued->Lookup->toClientList($leave_type_add) ?>;
	fleave_typeadd.lists["x_Accrued"].options = <?php echo JsonEncode($leave_type_add->Accrued->lookupOptions()) ?>;
	loadjs.done("fleave_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $leave_type_add->showPageHeader(); ?>
<?php
$leave_type_add->showMessage();
?>
<form name="fleave_typeadd" id="fleave_typeadd" class="<?php echo $leave_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$leave_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($leave_type_add->LeaveTypeName->Visible) { // LeaveTypeName ?>
	<div id="r_LeaveTypeName" class="form-group row">
		<label id="elh_leave_type_LeaveTypeName" for="x_LeaveTypeName" class="<?php echo $leave_type_add->LeftColumnClass ?>"><?php echo $leave_type_add->LeaveTypeName->caption() ?><?php echo $leave_type_add->LeaveTypeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_type_add->RightColumnClass ?>"><div <?php echo $leave_type_add->LeaveTypeName->cellAttributes() ?>>
<span id="el_leave_type_LeaveTypeName">
<input type="text" data-table="leave_type" data-field="x_LeaveTypeName" name="x_LeaveTypeName" id="x_LeaveTypeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($leave_type_add->LeaveTypeName->getPlaceHolder()) ?>" value="<?php echo $leave_type_add->LeaveTypeName->EditValue ?>"<?php echo $leave_type_add->LeaveTypeName->editAttributes() ?>>
</span>
<?php echo $leave_type_add->LeaveTypeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($leave_type_add->Accrued->Visible) { // Accrued ?>
	<div id="r_Accrued" class="form-group row">
		<label id="elh_leave_type_Accrued" class="<?php echo $leave_type_add->LeftColumnClass ?>"><?php echo $leave_type_add->Accrued->caption() ?><?php echo $leave_type_add->Accrued->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $leave_type_add->RightColumnClass ?>"><div <?php echo $leave_type_add->Accrued->cellAttributes() ?>>
<span id="el_leave_type_Accrued">
<div id="tp_x_Accrued" class="ew-template"><input type="radio" class="custom-control-input" data-table="leave_type" data-field="x_Accrued" data-value-separator="<?php echo $leave_type_add->Accrued->displayValueSeparatorAttribute() ?>" name="x_Accrued" id="x_Accrued" value="{value}"<?php echo $leave_type_add->Accrued->editAttributes() ?>></div>
<div id="dsl_x_Accrued" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $leave_type_add->Accrued->radioButtonListHtml(FALSE, "x_Accrued") ?>
</div></div>
<?php echo $leave_type_add->Accrued->Lookup->getParamTag($leave_type_add, "p_x_Accrued") ?>
</span>
<?php echo $leave_type_add->Accrued->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$leave_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $leave_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $leave_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$leave_type_add->showPageFooter();
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
$leave_type_add->terminate();
?>