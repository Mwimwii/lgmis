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
$self_registration_edit = new self_registration_edit();

// Run the page
$self_registration_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$self_registration_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fself_registrationedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fself_registrationedit = currentForm = new ew.Form("fself_registrationedit", "edit");

	// Validate form
	fself_registrationedit.validate = function() {
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
			<?php if ($self_registration_edit->SelfRegistrationID->Required) { ?>
				elm = this.getElements("x" + infix + "_SelfRegistrationID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $self_registration_edit->SelfRegistrationID->caption(), $self_registration_edit->SelfRegistrationID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($self_registration_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $self_registration_edit->EmployeeID->caption(), $self_registration_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($self_registration_edit->NRC->Required) { ?>
				elm = this.getElements("x" + infix + "_NRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $self_registration_edit->NRC->caption(), $self_registration_edit->NRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($self_registration_edit->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $self_registration_edit->Password->caption(), $self_registration_edit->Password->RequiredErrorMessage)) ?>");
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
	fself_registrationedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fself_registrationedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fself_registrationedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $self_registration_edit->showPageHeader(); ?>
<?php
$self_registration_edit->showMessage();
?>
<?php if (!$self_registration_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $self_registration_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fself_registrationedit" id="fself_registrationedit" class="<?php echo $self_registration_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="self_registration">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$self_registration_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($self_registration_edit->SelfRegistrationID->Visible) { // SelfRegistrationID ?>
	<div id="r_SelfRegistrationID" class="form-group row">
		<label id="elh_self_registration_SelfRegistrationID" class="<?php echo $self_registration_edit->LeftColumnClass ?>"><?php echo $self_registration_edit->SelfRegistrationID->caption() ?><?php echo $self_registration_edit->SelfRegistrationID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $self_registration_edit->RightColumnClass ?>"><div <?php echo $self_registration_edit->SelfRegistrationID->cellAttributes() ?>>
<span id="el_self_registration_SelfRegistrationID">
<span<?php echo $self_registration_edit->SelfRegistrationID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($self_registration_edit->SelfRegistrationID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="self_registration" data-field="x_SelfRegistrationID" name="x_SelfRegistrationID" id="x_SelfRegistrationID" value="<?php echo HtmlEncode($self_registration_edit->SelfRegistrationID->CurrentValue) ?>">
<?php echo $self_registration_edit->SelfRegistrationID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($self_registration_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_self_registration_EmployeeID" for="x_EmployeeID" class="<?php echo $self_registration_edit->LeftColumnClass ?>"><?php echo $self_registration_edit->EmployeeID->caption() ?><?php echo $self_registration_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $self_registration_edit->RightColumnClass ?>"><div <?php echo $self_registration_edit->EmployeeID->cellAttributes() ?>>
<span id="el_self_registration_EmployeeID">
<input type="text" data-table="self_registration" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($self_registration_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $self_registration_edit->EmployeeID->EditValue ?>"<?php echo $self_registration_edit->EmployeeID->editAttributes() ?>>
</span>
<?php echo $self_registration_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($self_registration_edit->NRC->Visible) { // NRC ?>
	<div id="r_NRC" class="form-group row">
		<label id="elh_self_registration_NRC" for="x_NRC" class="<?php echo $self_registration_edit->LeftColumnClass ?>"><?php echo $self_registration_edit->NRC->caption() ?><?php echo $self_registration_edit->NRC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $self_registration_edit->RightColumnClass ?>"><div <?php echo $self_registration_edit->NRC->cellAttributes() ?>>
<span id="el_self_registration_NRC">
<input type="text" data-table="self_registration" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($self_registration_edit->NRC->getPlaceHolder()) ?>" value="<?php echo $self_registration_edit->NRC->EditValue ?>"<?php echo $self_registration_edit->NRC->editAttributes() ?>>
</span>
<?php echo $self_registration_edit->NRC->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($self_registration_edit->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_self_registration_Password" for="x_Password" class="<?php echo $self_registration_edit->LeftColumnClass ?>"><?php echo $self_registration_edit->Password->caption() ?><?php echo $self_registration_edit->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $self_registration_edit->RightColumnClass ?>"><div <?php echo $self_registration_edit->Password->cellAttributes() ?>>
<span id="el_self_registration_Password">
<textarea data-table="self_registration" data-field="x_Password" name="x_Password" id="x_Password" cols="35" rows="4" placeholder="<?php echo HtmlEncode($self_registration_edit->Password->getPlaceHolder()) ?>"<?php echo $self_registration_edit->Password->editAttributes() ?>><?php echo $self_registration_edit->Password->EditValue ?></textarea>
</span>
<?php echo $self_registration_edit->Password->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$self_registration_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $self_registration_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $self_registration_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$self_registration_edit->IsModal) { ?>
<?php echo $self_registration_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$self_registration_edit->showPageFooter();
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
$self_registration_edit->terminate();
?>