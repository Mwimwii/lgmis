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
$programme_ref_edit = new programme_ref_edit();

// Run the page
$programme_ref_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$programme_ref_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprogramme_refedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fprogramme_refedit = currentForm = new ew.Form("fprogramme_refedit", "edit");

	// Validate form
	fprogramme_refedit.validate = function() {
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
			<?php if ($programme_ref_edit->ProgRefCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgRefCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_ref_edit->ProgRefCode->caption(), $programme_ref_edit->ProgRefCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_ref_edit->FunctionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_FunctionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_ref_edit->FunctionCode->caption(), $programme_ref_edit->FunctionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_ref_edit->ProgrammeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_ref_edit->ProgrammeCode->caption(), $programme_ref_edit->ProgrammeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($programme_ref_edit->ProgrammeName->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_ref_edit->ProgrammeName->caption(), $programme_ref_edit->ProgrammeName->RequiredErrorMessage)) ?>");
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
	fprogramme_refedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprogramme_refedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fprogramme_refedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $programme_ref_edit->showPageHeader(); ?>
<?php
$programme_ref_edit->showMessage();
?>
<?php if (!$programme_ref_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $programme_ref_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fprogramme_refedit" id="fprogramme_refedit" class="<?php echo $programme_ref_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="programme_ref">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$programme_ref_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($programme_ref_edit->ProgRefCode->Visible) { // ProgRefCode ?>
	<div id="r_ProgRefCode" class="form-group row">
		<label id="elh_programme_ref_ProgRefCode" for="x_ProgRefCode" class="<?php echo $programme_ref_edit->LeftColumnClass ?>"><?php echo $programme_ref_edit->ProgRefCode->caption() ?><?php echo $programme_ref_edit->ProgRefCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_ref_edit->RightColumnClass ?>"><div <?php echo $programme_ref_edit->ProgRefCode->cellAttributes() ?>>
<input type="text" data-table="programme_ref" data-field="x_ProgRefCode" name="x_ProgRefCode" id="x_ProgRefCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($programme_ref_edit->ProgRefCode->getPlaceHolder()) ?>" value="<?php echo $programme_ref_edit->ProgRefCode->EditValue ?>"<?php echo $programme_ref_edit->ProgRefCode->editAttributes() ?>>
<input type="hidden" data-table="programme_ref" data-field="x_ProgRefCode" name="o_ProgRefCode" id="o_ProgRefCode" value="<?php echo HtmlEncode($programme_ref_edit->ProgRefCode->OldValue != null ? $programme_ref_edit->ProgRefCode->OldValue : $programme_ref_edit->ProgRefCode->CurrentValue) ?>">
<?php echo $programme_ref_edit->ProgRefCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($programme_ref_edit->FunctionCode->Visible) { // FunctionCode ?>
	<div id="r_FunctionCode" class="form-group row">
		<label id="elh_programme_ref_FunctionCode" for="x_FunctionCode" class="<?php echo $programme_ref_edit->LeftColumnClass ?>"><?php echo $programme_ref_edit->FunctionCode->caption() ?><?php echo $programme_ref_edit->FunctionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_ref_edit->RightColumnClass ?>"><div <?php echo $programme_ref_edit->FunctionCode->cellAttributes() ?>>
<span id="el_programme_ref_FunctionCode">
<input type="text" data-table="programme_ref" data-field="x_FunctionCode" name="x_FunctionCode" id="x_FunctionCode" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($programme_ref_edit->FunctionCode->getPlaceHolder()) ?>" value="<?php echo $programme_ref_edit->FunctionCode->EditValue ?>"<?php echo $programme_ref_edit->FunctionCode->editAttributes() ?>>
</span>
<?php echo $programme_ref_edit->FunctionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($programme_ref_edit->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<div id="r_ProgrammeCode" class="form-group row">
		<label id="elh_programme_ref_ProgrammeCode" for="x_ProgrammeCode" class="<?php echo $programme_ref_edit->LeftColumnClass ?>"><?php echo $programme_ref_edit->ProgrammeCode->caption() ?><?php echo $programme_ref_edit->ProgrammeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_ref_edit->RightColumnClass ?>"><div <?php echo $programme_ref_edit->ProgrammeCode->cellAttributes() ?>>
<span id="el_programme_ref_ProgrammeCode">
<input type="text" data-table="programme_ref" data-field="x_ProgrammeCode" name="x_ProgrammeCode" id="x_ProgrammeCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($programme_ref_edit->ProgrammeCode->getPlaceHolder()) ?>" value="<?php echo $programme_ref_edit->ProgrammeCode->EditValue ?>"<?php echo $programme_ref_edit->ProgrammeCode->editAttributes() ?>>
</span>
<?php echo $programme_ref_edit->ProgrammeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($programme_ref_edit->ProgrammeName->Visible) { // ProgrammeName ?>
	<div id="r_ProgrammeName" class="form-group row">
		<label id="elh_programme_ref_ProgrammeName" for="x_ProgrammeName" class="<?php echo $programme_ref_edit->LeftColumnClass ?>"><?php echo $programme_ref_edit->ProgrammeName->caption() ?><?php echo $programme_ref_edit->ProgrammeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_ref_edit->RightColumnClass ?>"><div <?php echo $programme_ref_edit->ProgrammeName->cellAttributes() ?>>
<span id="el_programme_ref_ProgrammeName">
<input type="text" data-table="programme_ref" data-field="x_ProgrammeName" name="x_ProgrammeName" id="x_ProgrammeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($programme_ref_edit->ProgrammeName->getPlaceHolder()) ?>" value="<?php echo $programme_ref_edit->ProgrammeName->EditValue ?>"<?php echo $programme_ref_edit->ProgrammeName->editAttributes() ?>>
</span>
<?php echo $programme_ref_edit->ProgrammeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$programme_ref_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $programme_ref_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $programme_ref_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$programme_ref_edit->IsModal) { ?>
<?php echo $programme_ref_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$programme_ref_edit->showPageFooter();
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
$programme_ref_edit->terminate();
?>