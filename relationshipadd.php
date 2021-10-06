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
$relationship_add = new relationship_add();

// Run the page
$relationship_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$relationship_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frelationshipadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	frelationshipadd = currentForm = new ew.Form("frelationshipadd", "add");

	// Validate form
	frelationshipadd.validate = function() {
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
			<?php if ($relationship_add->Relationship->Required) { ?>
				elm = this.getElements("x" + infix + "_Relationship");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $relationship_add->Relationship->caption(), $relationship_add->Relationship->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($relationship_add->Comment->Required) { ?>
				elm = this.getElements("x" + infix + "_Comment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $relationship_add->Comment->caption(), $relationship_add->Comment->RequiredErrorMessage)) ?>");
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
	frelationshipadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frelationshipadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("frelationshipadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $relationship_add->showPageHeader(); ?>
<?php
$relationship_add->showMessage();
?>
<form name="frelationshipadd" id="frelationshipadd" class="<?php echo $relationship_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="relationship">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$relationship_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($relationship_add->Relationship->Visible) { // Relationship ?>
	<div id="r_Relationship" class="form-group row">
		<label id="elh_relationship_Relationship" for="x_Relationship" class="<?php echo $relationship_add->LeftColumnClass ?>"><?php echo $relationship_add->Relationship->caption() ?><?php echo $relationship_add->Relationship->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $relationship_add->RightColumnClass ?>"><div <?php echo $relationship_add->Relationship->cellAttributes() ?>>
<span id="el_relationship_Relationship">
<input type="text" data-table="relationship" data-field="x_Relationship" name="x_Relationship" id="x_Relationship" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($relationship_add->Relationship->getPlaceHolder()) ?>" value="<?php echo $relationship_add->Relationship->EditValue ?>"<?php echo $relationship_add->Relationship->editAttributes() ?>>
</span>
<?php echo $relationship_add->Relationship->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($relationship_add->Comment->Visible) { // Comment ?>
	<div id="r_Comment" class="form-group row">
		<label id="elh_relationship_Comment" for="x_Comment" class="<?php echo $relationship_add->LeftColumnClass ?>"><?php echo $relationship_add->Comment->caption() ?><?php echo $relationship_add->Comment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $relationship_add->RightColumnClass ?>"><div <?php echo $relationship_add->Comment->cellAttributes() ?>>
<span id="el_relationship_Comment">
<input type="text" data-table="relationship" data-field="x_Comment" name="x_Comment" id="x_Comment" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($relationship_add->Comment->getPlaceHolder()) ?>" value="<?php echo $relationship_add->Comment->EditValue ?>"<?php echo $relationship_add->Comment->editAttributes() ?>>
</span>
<?php echo $relationship_add->Comment->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$relationship_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $relationship_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $relationship_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$relationship_add->showPageFooter();
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
$relationship_add->terminate();
?>