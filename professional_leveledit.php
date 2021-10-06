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
$professional_level_edit = new professional_level_edit();

// Run the page
$professional_level_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professional_level_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprofessional_leveledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fprofessional_leveledit = currentForm = new ew.Form("fprofessional_leveledit", "edit");

	// Validate form
	fprofessional_leveledit.validate = function() {
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
			<?php if ($professional_level_edit->ProfessionalLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professional_level_edit->ProfessionalLevel->caption(), $professional_level_edit->ProfessionalLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professional_level_edit->ProfessionalName->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professional_level_edit->ProfessionalName->caption(), $professional_level_edit->ProfessionalName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professional_level_edit->ProfessionalDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professional_level_edit->ProfessionalDesc->caption(), $professional_level_edit->ProfessionalDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professional_level_edit->LastUserID->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUserID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professional_level_edit->LastUserID->caption(), $professional_level_edit->LastUserID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professional_level_edit->LastUpdated->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professional_level_edit->LastUpdated->caption(), $professional_level_edit->LastUpdated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdated");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($professional_level_edit->LastUpdated->errorMessage()) ?>");

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
	fprofessional_leveledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprofessional_leveledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fprofessional_leveledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $professional_level_edit->showPageHeader(); ?>
<?php
$professional_level_edit->showMessage();
?>
<?php if (!$professional_level_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $professional_level_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fprofessional_leveledit" id="fprofessional_leveledit" class="<?php echo $professional_level_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professional_level">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$professional_level_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($professional_level_edit->ProfessionalLevel->Visible) { // ProfessionalLevel ?>
	<div id="r_ProfessionalLevel" class="form-group row">
		<label id="elh_professional_level_ProfessionalLevel" class="<?php echo $professional_level_edit->LeftColumnClass ?>"><?php echo $professional_level_edit->ProfessionalLevel->caption() ?><?php echo $professional_level_edit->ProfessionalLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professional_level_edit->RightColumnClass ?>"><div <?php echo $professional_level_edit->ProfessionalLevel->cellAttributes() ?>>
<span id="el_professional_level_ProfessionalLevel">
<span<?php echo $professional_level_edit->ProfessionalLevel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($professional_level_edit->ProfessionalLevel->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="professional_level" data-field="x_ProfessionalLevel" name="x_ProfessionalLevel" id="x_ProfessionalLevel" value="<?php echo HtmlEncode($professional_level_edit->ProfessionalLevel->CurrentValue) ?>">
<?php echo $professional_level_edit->ProfessionalLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professional_level_edit->ProfessionalName->Visible) { // ProfessionalName ?>
	<div id="r_ProfessionalName" class="form-group row">
		<label id="elh_professional_level_ProfessionalName" for="x_ProfessionalName" class="<?php echo $professional_level_edit->LeftColumnClass ?>"><?php echo $professional_level_edit->ProfessionalName->caption() ?><?php echo $professional_level_edit->ProfessionalName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professional_level_edit->RightColumnClass ?>"><div <?php echo $professional_level_edit->ProfessionalName->cellAttributes() ?>>
<span id="el_professional_level_ProfessionalName">
<input type="text" data-table="professional_level" data-field="x_ProfessionalName" name="x_ProfessionalName" id="x_ProfessionalName" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($professional_level_edit->ProfessionalName->getPlaceHolder()) ?>" value="<?php echo $professional_level_edit->ProfessionalName->EditValue ?>"<?php echo $professional_level_edit->ProfessionalName->editAttributes() ?>>
</span>
<?php echo $professional_level_edit->ProfessionalName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professional_level_edit->ProfessionalDesc->Visible) { // ProfessionalDesc ?>
	<div id="r_ProfessionalDesc" class="form-group row">
		<label id="elh_professional_level_ProfessionalDesc" for="x_ProfessionalDesc" class="<?php echo $professional_level_edit->LeftColumnClass ?>"><?php echo $professional_level_edit->ProfessionalDesc->caption() ?><?php echo $professional_level_edit->ProfessionalDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professional_level_edit->RightColumnClass ?>"><div <?php echo $professional_level_edit->ProfessionalDesc->cellAttributes() ?>>
<span id="el_professional_level_ProfessionalDesc">
<input type="text" data-table="professional_level" data-field="x_ProfessionalDesc" name="x_ProfessionalDesc" id="x_ProfessionalDesc" size="30" maxlength="60" placeholder="<?php echo HtmlEncode($professional_level_edit->ProfessionalDesc->getPlaceHolder()) ?>" value="<?php echo $professional_level_edit->ProfessionalDesc->EditValue ?>"<?php echo $professional_level_edit->ProfessionalDesc->editAttributes() ?>>
</span>
<?php echo $professional_level_edit->ProfessionalDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professional_level_edit->LastUserID->Visible) { // LastUserID ?>
	<div id="r_LastUserID" class="form-group row">
		<label id="elh_professional_level_LastUserID" for="x_LastUserID" class="<?php echo $professional_level_edit->LeftColumnClass ?>"><?php echo $professional_level_edit->LastUserID->caption() ?><?php echo $professional_level_edit->LastUserID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professional_level_edit->RightColumnClass ?>"><div <?php echo $professional_level_edit->LastUserID->cellAttributes() ?>>
<span id="el_professional_level_LastUserID">
<input type="text" data-table="professional_level" data-field="x_LastUserID" name="x_LastUserID" id="x_LastUserID" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($professional_level_edit->LastUserID->getPlaceHolder()) ?>" value="<?php echo $professional_level_edit->LastUserID->EditValue ?>"<?php echo $professional_level_edit->LastUserID->editAttributes() ?>>
</span>
<?php echo $professional_level_edit->LastUserID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professional_level_edit->LastUpdated->Visible) { // LastUpdated ?>
	<div id="r_LastUpdated" class="form-group row">
		<label id="elh_professional_level_LastUpdated" for="x_LastUpdated" class="<?php echo $professional_level_edit->LeftColumnClass ?>"><?php echo $professional_level_edit->LastUpdated->caption() ?><?php echo $professional_level_edit->LastUpdated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professional_level_edit->RightColumnClass ?>"><div <?php echo $professional_level_edit->LastUpdated->cellAttributes() ?>>
<span id="el_professional_level_LastUpdated">
<input type="text" data-table="professional_level" data-field="x_LastUpdated" name="x_LastUpdated" id="x_LastUpdated" placeholder="<?php echo HtmlEncode($professional_level_edit->LastUpdated->getPlaceHolder()) ?>" value="<?php echo $professional_level_edit->LastUpdated->EditValue ?>"<?php echo $professional_level_edit->LastUpdated->editAttributes() ?>>
</span>
<?php echo $professional_level_edit->LastUpdated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$professional_level_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $professional_level_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $professional_level_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$professional_level_edit->IsModal) { ?>
<?php echo $professional_level_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$professional_level_edit->showPageFooter();
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
$professional_level_edit->terminate();
?>