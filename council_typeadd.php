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
$council_type_add = new council_type_add();

// Run the page
$council_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncil_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcouncil_typeadd = currentForm = new ew.Form("fcouncil_typeadd", "add");

	// Validate form
	fcouncil_typeadd.validate = function() {
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
			<?php if ($council_type_add->CouncilType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_type_add->CouncilType->caption(), $council_type_add->CouncilType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CouncilType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($council_type_add->CouncilType->errorMessage()) ?>");
			<?php if ($council_type_add->CouncilTYpeName->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilTYpeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $council_type_add->CouncilTYpeName->caption(), $council_type_add->CouncilTYpeName->RequiredErrorMessage)) ?>");
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
	fcouncil_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncil_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcouncil_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $council_type_add->showPageHeader(); ?>
<?php
$council_type_add->showMessage();
?>
<form name="fcouncil_typeadd" id="fcouncil_typeadd" class="<?php echo $council_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$council_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($council_type_add->CouncilType->Visible) { // CouncilType ?>
	<div id="r_CouncilType" class="form-group row">
		<label id="elh_council_type_CouncilType" for="x_CouncilType" class="<?php echo $council_type_add->LeftColumnClass ?>"><?php echo $council_type_add->CouncilType->caption() ?><?php echo $council_type_add->CouncilType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_type_add->RightColumnClass ?>"><div <?php echo $council_type_add->CouncilType->cellAttributes() ?>>
<span id="el_council_type_CouncilType">
<input type="text" data-table="council_type" data-field="x_CouncilType" name="x_CouncilType" id="x_CouncilType" size="30" placeholder="<?php echo HtmlEncode($council_type_add->CouncilType->getPlaceHolder()) ?>" value="<?php echo $council_type_add->CouncilType->EditValue ?>"<?php echo $council_type_add->CouncilType->editAttributes() ?>>
</span>
<?php echo $council_type_add->CouncilType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($council_type_add->CouncilTYpeName->Visible) { // CouncilTYpeName ?>
	<div id="r_CouncilTYpeName" class="form-group row">
		<label id="elh_council_type_CouncilTYpeName" for="x_CouncilTYpeName" class="<?php echo $council_type_add->LeftColumnClass ?>"><?php echo $council_type_add->CouncilTYpeName->caption() ?><?php echo $council_type_add->CouncilTYpeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $council_type_add->RightColumnClass ?>"><div <?php echo $council_type_add->CouncilTYpeName->cellAttributes() ?>>
<span id="el_council_type_CouncilTYpeName">
<input type="text" data-table="council_type" data-field="x_CouncilTYpeName" name="x_CouncilTYpeName" id="x_CouncilTYpeName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($council_type_add->CouncilTYpeName->getPlaceHolder()) ?>" value="<?php echo $council_type_add->CouncilTYpeName->EditValue ?>"<?php echo $council_type_add->CouncilTYpeName->editAttributes() ?>>
</span>
<?php echo $council_type_add->CouncilTYpeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$council_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $council_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $council_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$council_type_add->showPageFooter();
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
$council_type_add->terminate();
?>