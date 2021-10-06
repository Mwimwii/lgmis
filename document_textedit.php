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
$document_text_edit = new document_text_edit();

// Run the page
$document_text_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_text_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdocument_textedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdocument_textedit = currentForm = new ew.Form("fdocument_textedit", "edit");

	// Validate form
	fdocument_textedit.validate = function() {
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
			<?php if ($document_text_edit->TextBody->Required) { ?>
				elm = this.getElements("x" + infix + "_TextBody");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_text_edit->TextBody->caption(), $document_text_edit->TextBody->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($document_text_edit->ID->Required) { ?>
				elm = this.getElements("x" + infix + "_ID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_text_edit->ID->caption(), $document_text_edit->ID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($document_text_edit->Ref->Required) { ?>
				elm = this.getElements("x" + infix + "_Ref");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $document_text_edit->Ref->caption(), $document_text_edit->Ref->RequiredErrorMessage)) ?>");
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
	fdocument_textedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdocument_textedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fdocument_textedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $document_text_edit->showPageHeader(); ?>
<?php
$document_text_edit->showMessage();
?>
<?php if (!$document_text_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $document_text_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fdocument_textedit" id="fdocument_textedit" class="<?php echo $document_text_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_text">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$document_text_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($document_text_edit->TextBody->Visible) { // TextBody ?>
	<div id="r_TextBody" class="form-group row">
		<label id="elh_document_text_TextBody" class="<?php echo $document_text_edit->LeftColumnClass ?>"><?php echo $document_text_edit->TextBody->caption() ?><?php echo $document_text_edit->TextBody->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_text_edit->RightColumnClass ?>"><div <?php echo $document_text_edit->TextBody->cellAttributes() ?>>
<span id="el_document_text_TextBody">
<?php $document_text_edit->TextBody->EditAttrs->appendClass("editor"); ?>
<textarea data-table="document_text" data-field="x_TextBody" name="x_TextBody" id="x_TextBody" cols="80" rows="4" placeholder="<?php echo HtmlEncode($document_text_edit->TextBody->getPlaceHolder()) ?>"<?php echo $document_text_edit->TextBody->editAttributes() ?>><?php echo $document_text_edit->TextBody->EditValue ?></textarea>
<script>
loadjs.ready(["fdocument_textedit", "editor"], function() {
	ew.createEditor("fdocument_textedit", "x_TextBody", 80, 4, <?php echo $document_text_edit->TextBody->ReadOnly || FALSE ? "true" : "false" ?>);
});
</script>
</span>
<?php echo $document_text_edit->TextBody->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($document_text_edit->ID->Visible) { // ID ?>
	<div id="r_ID" class="form-group row">
		<label id="elh_document_text_ID" class="<?php echo $document_text_edit->LeftColumnClass ?>"><?php echo $document_text_edit->ID->caption() ?><?php echo $document_text_edit->ID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_text_edit->RightColumnClass ?>"><div <?php echo $document_text_edit->ID->cellAttributes() ?>>
<span id="el_document_text_ID">
<span<?php echo $document_text_edit->ID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($document_text_edit->ID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="document_text" data-field="x_ID" name="x_ID" id="x_ID" value="<?php echo HtmlEncode($document_text_edit->ID->CurrentValue) ?>">
<?php echo $document_text_edit->ID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($document_text_edit->Ref->Visible) { // Ref ?>
	<div id="r_Ref" class="form-group row">
		<label id="elh_document_text_Ref" for="x_Ref" class="<?php echo $document_text_edit->LeftColumnClass ?>"><?php echo $document_text_edit->Ref->caption() ?><?php echo $document_text_edit->Ref->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $document_text_edit->RightColumnClass ?>"><div <?php echo $document_text_edit->Ref->cellAttributes() ?>>
<span id="el_document_text_Ref">
<input type="text" data-table="document_text" data-field="x_Ref" name="x_Ref" id="x_Ref" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($document_text_edit->Ref->getPlaceHolder()) ?>" value="<?php echo $document_text_edit->Ref->EditValue ?>"<?php echo $document_text_edit->Ref->editAttributes() ?>>
</span>
<?php echo $document_text_edit->Ref->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$document_text_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $document_text_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $document_text_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$document_text_edit->IsModal) { ?>
<?php echo $document_text_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$document_text_edit->showPageFooter();
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
$document_text_edit->terminate();
?>