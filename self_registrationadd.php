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
$self_registration_add = new self_registration_add();

// Run the page
$self_registration_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$self_registration_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fself_registrationadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fself_registrationadd = currentForm = new ew.Form("fself_registrationadd", "add");

	// Validate form
	fself_registrationadd.validate = function() {
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
			<?php if ($self_registration_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $self_registration_add->EmployeeID->caption(), $self_registration_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($self_registration_add->NRC->Required) { ?>
				elm = this.getElements("x" + infix + "_NRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $self_registration_add->NRC->caption(), $self_registration_add->NRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($self_registration_add->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $self_registration_add->Password->caption(), $self_registration_add->Password->RequiredErrorMessage)) ?>");
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
	fself_registrationadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fself_registrationadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fself_registrationadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $self_registration_add->showPageHeader(); ?>
<?php
$self_registration_add->showMessage();
?>
<form name="fself_registrationadd" id="fself_registrationadd" class="<?php echo $self_registration_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="self_registration">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$self_registration_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($self_registration_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_self_registration_EmployeeID" for="x_EmployeeID" class="<?php echo $self_registration_add->LeftColumnClass ?>"><?php echo $self_registration_add->EmployeeID->caption() ?><?php echo $self_registration_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $self_registration_add->RightColumnClass ?>"><div <?php echo $self_registration_add->EmployeeID->cellAttributes() ?>>
<span id="el_self_registration_EmployeeID">
<input type="text" data-table="self_registration" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($self_registration_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $self_registration_add->EmployeeID->EditValue ?>"<?php echo $self_registration_add->EmployeeID->editAttributes() ?>>
</span>
<?php echo $self_registration_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($self_registration_add->NRC->Visible) { // NRC ?>
	<div id="r_NRC" class="form-group row">
		<label id="elh_self_registration_NRC" for="x_NRC" class="<?php echo $self_registration_add->LeftColumnClass ?>"><?php echo $self_registration_add->NRC->caption() ?><?php echo $self_registration_add->NRC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $self_registration_add->RightColumnClass ?>"><div <?php echo $self_registration_add->NRC->cellAttributes() ?>>
<span id="el_self_registration_NRC">
<input type="text" data-table="self_registration" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($self_registration_add->NRC->getPlaceHolder()) ?>" value="<?php echo $self_registration_add->NRC->EditValue ?>"<?php echo $self_registration_add->NRC->editAttributes() ?>>
</span>
<?php echo $self_registration_add->NRC->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($self_registration_add->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_self_registration_Password" for="x_Password" class="<?php echo $self_registration_add->LeftColumnClass ?>"><?php echo $self_registration_add->Password->caption() ?><?php echo $self_registration_add->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $self_registration_add->RightColumnClass ?>"><div <?php echo $self_registration_add->Password->cellAttributes() ?>>
<span id="el_self_registration_Password">
<textarea data-table="self_registration" data-field="x_Password" name="x_Password" id="x_Password" cols="35" rows="4" placeholder="<?php echo HtmlEncode($self_registration_add->Password->getPlaceHolder()) ?>"<?php echo $self_registration_add->Password->editAttributes() ?>><?php echo $self_registration_add->Password->EditValue ?></textarea>
</span>
<?php echo $self_registration_add->Password->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$self_registration_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $self_registration_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $self_registration_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$self_registration_add->showPageFooter();
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
$self_registration_add->terminate();
?>