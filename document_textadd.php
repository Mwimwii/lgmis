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
$document_text_add = new document_text_add();

// Run the page
$document_text_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_text_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdocument_textadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdocument_textadd = currentForm = new ew.Form("fdocument_textadd", "add");

	// Validate form
	fdocument_textadd.validate = function() {
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
			<?php if ($document_text_add->TextBody->Required) { ?>
				elm = this.getElements("x" + infix + "_TextBody");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_text_add->TextBody->caption(), $document_text_add->TextBody->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($document_text_add->Ref->Required) { ?>
				elm = this.getElements("x" + infix + "_Ref");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_text_add->Ref->caption(), $document_text_add->Ref->RequiredErrorMessage)) ?>");
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
	fdocument_textadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdocument_textadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdocument_textadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $document_text_add->showPageHeader(); ?>
<?php
$document_text_add->showMessage();
?>
<form name="fdocument_textadd" id="fdocument_textadd" class="<?php echo $document_text_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_text">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$document_text_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($document_text_add->TextBody->Visible) { // TextBody ?>
	<div id="r_TextBody" class="form-group row">
		<label id="elh_document_text_TextBody" class="<?php echo $document_text_add->LeftColumnClass ?>"><?php echo $document_text_add->TextBody->caption() ?><?php echo $document_text_add->TextBody->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_text_add->RightColumnClass ?>"><div <?php echo $document_text_add->TextBody->cellAttributes() ?>>
<span id="el_document_text_TextBody">
<?php $document_text_add->TextBody->EditAttrs->appendClass("editor"); ?>
<textarea data-table="document_text" data-field="x_TextBody" name="x_TextBody" id="x_TextBody" cols="80" rows="4" placeholder="<?php echo HtmlEncode($document_text_add->TextBody->getPlaceHolder()) ?>"<?php echo $document_text_add->TextBody->editAttributes() ?>><?php echo $document_text_add->TextBody->EditValue ?></textarea>
<script>
loadjs.ready(["fdocument_textadd", "editor"], function() {
	ew.createEditor("fdocument_textadd", "x_TextBody", 80, 4, <?php echo $document_text_add->TextBody->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $document_text_add->TextBody->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($document_text_add->Ref->Visible) { // Ref ?>
	<div id="r_Ref" class="form-group row">
		<label id="elh_document_text_Ref" for="x_Ref" class="<?php echo $document_text_add->LeftColumnClass ?>"><?php echo $document_text_add->Ref->caption() ?><?php echo $document_text_add->Ref->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_text_add->RightColumnClass ?>"><div <?php echo $document_text_add->Ref->cellAttributes() ?>>
<span id="el_document_text_Ref">
<input type="text" data-table="document_text" data-field="x_Ref" name="x_Ref" id="x_Ref" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($document_text_add->Ref->getPlaceHolder()) ?>" value="<?php echo $document_text_add->Ref->EditValue ?>"<?php echo $document_text_add->Ref->editAttributes() ?>>
</span>
<?php echo $document_text_add->Ref->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$document_text_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $document_text_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_text_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$document_text_add->showPageFooter();
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
$document_text_add->terminate();
?>