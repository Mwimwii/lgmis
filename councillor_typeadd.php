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
$councillor_type_add = new councillor_type_add();

// Run the page
$councillor_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillor_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcouncillor_typeadd = currentForm = new ew.Form("fcouncillor_typeadd", "add");

	// Validate form
	fcouncillor_typeadd.validate = function() {
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
			<?php if ($councillor_type_add->CouncillorType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_type_add->CouncillorType->caption(), $councillor_type_add->CouncillorType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CouncillorType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_type_add->CouncillorType->errorMessage()) ?>");
			<?php if ($councillor_type_add->CouncillorTYpeName->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncillorTYpeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_type_add->CouncillorTYpeName->caption(), $councillor_type_add->CouncillorTYpeName->RequiredErrorMessage)) ?>");
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
	fcouncillor_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillor_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcouncillor_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillor_type_add->showPageHeader(); ?>
<?php
$councillor_type_add->showMessage();
?>
<form name="fcouncillor_typeadd" id="fcouncillor_typeadd" class="<?php echo $councillor_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$councillor_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($councillor_type_add->CouncillorType->Visible) { // CouncillorType ?>
	<div id="r_CouncillorType" class="form-group row">
		<label id="elh_councillor_type_CouncillorType" for="x_CouncillorType" class="<?php echo $councillor_type_add->LeftColumnClass ?>"><?php echo $councillor_type_add->CouncillorType->caption() ?><?php echo $councillor_type_add->CouncillorType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_type_add->RightColumnClass ?>"><div <?php echo $councillor_type_add->CouncillorType->cellAttributes() ?>>
<span id="el_councillor_type_CouncillorType">
<input type="text" data-table="councillor_type" data-field="x_CouncillorType" name="x_CouncillorType" id="x_CouncillorType" size="30" placeholder="<?php echo HtmlEncode($councillor_type_add->CouncillorType->getPlaceHolder()) ?>" value="<?php echo $councillor_type_add->CouncillorType->EditValue ?>"<?php echo $councillor_type_add->CouncillorType->editAttributes() ?>>
</span>
<?php echo $councillor_type_add->CouncillorType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_type_add->CouncillorTYpeName->Visible) { // CouncillorTYpeName ?>
	<div id="r_CouncillorTYpeName" class="form-group row">
		<label id="elh_councillor_type_CouncillorTYpeName" for="x_CouncillorTYpeName" class="<?php echo $councillor_type_add->LeftColumnClass ?>"><?php echo $councillor_type_add->CouncillorTYpeName->caption() ?><?php echo $councillor_type_add->CouncillorTYpeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_type_add->RightColumnClass ?>"><div <?php echo $councillor_type_add->CouncillorTYpeName->cellAttributes() ?>>
<span id="el_councillor_type_CouncillorTYpeName">
<input type="text" data-table="councillor_type" data-field="x_CouncillorTYpeName" name="x_CouncillorTYpeName" id="x_CouncillorTYpeName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($councillor_type_add->CouncillorTYpeName->getPlaceHolder()) ?>" value="<?php echo $councillor_type_add->CouncillorTYpeName->EditValue ?>"<?php echo $councillor_type_add->CouncillorTYpeName->editAttributes() ?>>
</span>
<?php echo $councillor_type_add->CouncillorTYpeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$councillor_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillor_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillor_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$councillor_type_add->showPageFooter();
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
$councillor_type_add->terminate();
?>