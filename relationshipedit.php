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
$relationship_edit = new relationship_edit();

// Run the page
$relationship_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$relationship_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var frelationshipedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	frelationshipedit = currentForm = new ew.Form("frelationshipedit", "edit");

	// Validate form
	frelationshipedit.validate = function() {
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
			<?php if ($relationship_edit->RelationshipCode->Required) { ?>
				elm = this.getElements("x" + infix + "_RelationshipCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $relationship_edit->RelationshipCode->caption(), $relationship_edit->RelationshipCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($relationship_edit->Relationship->Required) { ?>
				elm = this.getElements("x" + infix + "_Relationship");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $relationship_edit->Relationship->caption(), $relationship_edit->Relationship->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($relationship_edit->Comment->Required) { ?>
				elm = this.getElements("x" + infix + "_Comment");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $relationship_edit->Comment->caption(), $relationship_edit->Comment->RequiredErrorMessage)) ?>");
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
	frelationshipedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	frelationshipedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("frelationshipedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $relationship_edit->showPageHeader(); ?>
<?php
$relationship_edit->showMessage();
?>
<?php if (!$relationship_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $relationship_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="frelationshipedit" id="frelationshipedit" class="<?php echo $relationship_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="relationship">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$relationship_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($relationship_edit->RelationshipCode->Visible) { // RelationshipCode ?>
	<div id="r_RelationshipCode" class="form-group row">
		<label id="elh_relationship_RelationshipCode" class="<?php echo $relationship_edit->LeftColumnClass ?>"><?php echo $relationship_edit->RelationshipCode->caption() ?><?php echo $relationship_edit->RelationshipCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $relationship_edit->RightColumnClass ?>"><div <?php echo $relationship_edit->RelationshipCode->cellAttributes() ?>>
<span id="el_relationship_RelationshipCode">
<span<?php echo $relationship_edit->RelationshipCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($relationship_edit->RelationshipCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="relationship" data-field="x_RelationshipCode" name="x_RelationshipCode" id="x_RelationshipCode" value="<?php echo HtmlEncode($relationship_edit->RelationshipCode->CurrentValue) ?>">
<?php echo $relationship_edit->RelationshipCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($relationship_edit->Relationship->Visible) { // Relationship ?>
	<div id="r_Relationship" class="form-group row">
		<label id="elh_relationship_Relationship" for="x_Relationship" class="<?php echo $relationship_edit->LeftColumnClass ?>"><?php echo $relationship_edit->Relationship->caption() ?><?php echo $relationship_edit->Relationship->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $relationship_edit->RightColumnClass ?>"><div <?php echo $relationship_edit->Relationship->cellAttributes() ?>>
<span id="el_relationship_Relationship">
<input type="text" data-table="relationship" data-field="x_Relationship" name="x_Relationship" id="x_Relationship" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($relationship_edit->Relationship->getPlaceHolder()) ?>" value="<?php echo $relationship_edit->Relationship->EditValue ?>"<?php echo $relationship_edit->Relationship->editAttributes() ?>>
</span>
<?php echo $relationship_edit->Relationship->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($relationship_edit->Comment->Visible) { // Comment ?>
	<div id="r_Comment" class="form-group row">
		<label id="elh_relationship_Comment" for="x_Comment" class="<?php echo $relationship_edit->LeftColumnClass ?>"><?php echo $relationship_edit->Comment->caption() ?><?php echo $relationship_edit->Comment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $relationship_edit->RightColumnClass ?>"><div <?php echo $relationship_edit->Comment->cellAttributes() ?>>
<span id="el_relationship_Comment">
<input type="text" data-table="relationship" data-field="x_Comment" name="x_Comment" id="x_Comment" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($relationship_edit->Comment->getPlaceHolder()) ?>" value="<?php echo $relationship_edit->Comment->EditValue ?>"<?php echo $relationship_edit->Comment->editAttributes() ?>>
</span>
<?php echo $relationship_edit->Comment->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$relationship_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $relationship_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $relationship_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$relationship_edit->IsModal) { ?>
<?php echo $relationship_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$relationship_edit->showPageFooter();
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
$relationship_edit->terminate();
?>