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
$user_role_add = new user_role_add();

// Run the page
$user_role_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$user_role_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuser_roleadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fuser_roleadd = currentForm = new ew.Form("fuser_roleadd", "add");

	// Validate form
	fuser_roleadd.validate = function() {
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
			<?php if ($user_role_add->Role->Required) { ?>
				elm = this.getElements("x" + infix + "_Role");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_role_add->Role->caption(), $user_role_add->Role->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($user_role_add->RoleDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_RoleDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $user_role_add->RoleDescription->caption(), $user_role_add->RoleDescription->RequiredErrorMessage)) ?>");
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
	fuser_roleadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fuser_roleadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fuser_roleadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $user_role_add->showPageHeader(); ?>
<?php
$user_role_add->showMessage();
?>
<form name="fuser_roleadd" id="fuser_roleadd" class="<?php echo $user_role_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="user_role">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$user_role_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($user_role_add->Role->Visible) { // Role ?>
	<div id="r_Role" class="form-group row">
		<label id="elh_user_role_Role" for="x_Role" class="<?php echo $user_role_add->LeftColumnClass ?>"><?php echo $user_role_add->Role->caption() ?><?php echo $user_role_add->Role->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_role_add->RightColumnClass ?>"><div <?php echo $user_role_add->Role->cellAttributes() ?>>
<span id="el_user_role_Role">
<input type="text" data-table="user_role" data-field="x_Role" name="x_Role" id="x_Role" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($user_role_add->Role->getPlaceHolder()) ?>" value="<?php echo $user_role_add->Role->EditValue ?>"<?php echo $user_role_add->Role->editAttributes() ?>>
</span>
<?php echo $user_role_add->Role->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($user_role_add->RoleDescription->Visible) { // RoleDescription ?>
	<div id="r_RoleDescription" class="form-group row">
		<label id="elh_user_role_RoleDescription" for="x_RoleDescription" class="<?php echo $user_role_add->LeftColumnClass ?>"><?php echo $user_role_add->RoleDescription->caption() ?><?php echo $user_role_add->RoleDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $user_role_add->RightColumnClass ?>"><div <?php echo $user_role_add->RoleDescription->cellAttributes() ?>>
<span id="el_user_role_RoleDescription">
<input type="text" data-table="user_role" data-field="x_RoleDescription" name="x_RoleDescription" id="x_RoleDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($user_role_add->RoleDescription->getPlaceHolder()) ?>" value="<?php echo $user_role_add->RoleDescription->EditValue ?>"<?php echo $user_role_add->RoleDescription->editAttributes() ?>>
</span>
<?php echo $user_role_add->RoleDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$user_role_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $user_role_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $user_role_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$user_role_add->showPageFooter();
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
$user_role_add->terminate();
?>