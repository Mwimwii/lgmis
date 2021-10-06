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
$disciplinary_action_ref_add = new disciplinary_action_ref_add();

// Run the page
$disciplinary_action_ref_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$disciplinary_action_ref_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdisciplinary_action_refadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdisciplinary_action_refadd = currentForm = new ew.Form("fdisciplinary_action_refadd", "add");

	// Validate form
	fdisciplinary_action_refadd.validate = function() {
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
			<?php if ($disciplinary_action_ref_add->ActionDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ActionDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $disciplinary_action_ref_add->ActionDesc->caption(), $disciplinary_action_ref_add->ActionDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($disciplinary_action_ref_add->Authority->Required) { ?>
				elm = this.getElements("x" + infix + "_Authority");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $disciplinary_action_ref_add->Authority->caption(), $disciplinary_action_ref_add->Authority->RequiredErrorMessage)) ?>");
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
	fdisciplinary_action_refadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdisciplinary_action_refadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdisciplinary_action_refadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $disciplinary_action_ref_add->showPageHeader(); ?>
<?php
$disciplinary_action_ref_add->showMessage();
?>
<form name="fdisciplinary_action_refadd" id="fdisciplinary_action_refadd" class="<?php echo $disciplinary_action_ref_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="disciplinary_action_ref">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$disciplinary_action_ref_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($disciplinary_action_ref_add->ActionDesc->Visible) { // ActionDesc ?>
	<div id="r_ActionDesc" class="form-group row">
		<label id="elh_disciplinary_action_ref_ActionDesc" for="x_ActionDesc" class="<?php echo $disciplinary_action_ref_add->LeftColumnClass ?>"><?php echo $disciplinary_action_ref_add->ActionDesc->caption() ?><?php echo $disciplinary_action_ref_add->ActionDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $disciplinary_action_ref_add->RightColumnClass ?>"><div <?php echo $disciplinary_action_ref_add->ActionDesc->cellAttributes() ?>>
<span id="el_disciplinary_action_ref_ActionDesc">
<input type="text" data-table="disciplinary_action_ref" data-field="x_ActionDesc" name="x_ActionDesc" id="x_ActionDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($disciplinary_action_ref_add->ActionDesc->getPlaceHolder()) ?>" value="<?php echo $disciplinary_action_ref_add->ActionDesc->EditValue ?>"<?php echo $disciplinary_action_ref_add->ActionDesc->editAttributes() ?>>
</span>
<?php echo $disciplinary_action_ref_add->ActionDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($disciplinary_action_ref_add->Authority->Visible) { // Authority ?>
	<div id="r_Authority" class="form-group row">
		<label id="elh_disciplinary_action_ref_Authority" for="x_Authority" class="<?php echo $disciplinary_action_ref_add->LeftColumnClass ?>"><?php echo $disciplinary_action_ref_add->Authority->caption() ?><?php echo $disciplinary_action_ref_add->Authority->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $disciplinary_action_ref_add->RightColumnClass ?>"><div <?php echo $disciplinary_action_ref_add->Authority->cellAttributes() ?>>
<span id="el_disciplinary_action_ref_Authority">
<input type="text" data-table="disciplinary_action_ref" data-field="x_Authority" name="x_Authority" id="x_Authority" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($disciplinary_action_ref_add->Authority->getPlaceHolder()) ?>" value="<?php echo $disciplinary_action_ref_add->Authority->EditValue ?>"<?php echo $disciplinary_action_ref_add->Authority->editAttributes() ?>>
</span>
<?php echo $disciplinary_action_ref_add->Authority->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$disciplinary_action_ref_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $disciplinary_action_ref_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $disciplinary_action_ref_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$disciplinary_action_ref_add->showPageFooter();
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
$disciplinary_action_ref_add->terminate();
?>