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
$la_program_edit = new la_program_edit();

// Run the page
$la_program_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_program_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fla_programedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fla_programedit = currentForm = new ew.Form("fla_programedit", "edit");

	// Validate form
	fla_programedit.validate = function() {
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
			<?php if ($la_program_edit->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_program_edit->ProgramCode->caption(), $la_program_edit->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($la_program_edit->ProgramCode->errorMessage()) ?>");
			<?php if ($la_program_edit->ProgramName->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_program_edit->ProgramName->caption(), $la_program_edit->ProgramName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_program_edit->ProgramPurpose->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramPurpose");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_program_edit->ProgramPurpose->caption(), $la_program_edit->ProgramPurpose->RequiredErrorMessage)) ?>");
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
	fla_programedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fla_programedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fla_programedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $la_program_edit->showPageHeader(); ?>
<?php
$la_program_edit->showMessage();
?>
<?php if (!$la_program_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $la_program_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fla_programedit" id="fla_programedit" class="<?php echo $la_program_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_program">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$la_program_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($la_program_edit->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh_la_program_ProgramCode" for="x_ProgramCode" class="<?php echo $la_program_edit->LeftColumnClass ?>"><?php echo $la_program_edit->ProgramCode->caption() ?><?php echo $la_program_edit->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_program_edit->RightColumnClass ?>"><div <?php echo $la_program_edit->ProgramCode->cellAttributes() ?>>
<input type="text" data-table="la_program" data-field="x_ProgramCode" name="x_ProgramCode" id="x_ProgramCode" size="30" placeholder="<?php echo HtmlEncode($la_program_edit->ProgramCode->getPlaceHolder()) ?>" value="<?php echo $la_program_edit->ProgramCode->EditValue ?>"<?php echo $la_program_edit->ProgramCode->editAttributes() ?>>
<input type="hidden" data-table="la_program" data-field="x_ProgramCode" name="o_ProgramCode" id="o_ProgramCode" value="<?php echo HtmlEncode($la_program_edit->ProgramCode->OldValue != null ? $la_program_edit->ProgramCode->OldValue : $la_program_edit->ProgramCode->CurrentValue) ?>">
<?php echo $la_program_edit->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_program_edit->ProgramName->Visible) { // ProgramName ?>
	<div id="r_ProgramName" class="form-group row">
		<label id="elh_la_program_ProgramName" for="x_ProgramName" class="<?php echo $la_program_edit->LeftColumnClass ?>"><?php echo $la_program_edit->ProgramName->caption() ?><?php echo $la_program_edit->ProgramName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_program_edit->RightColumnClass ?>"><div <?php echo $la_program_edit->ProgramName->cellAttributes() ?>>
<span id="el_la_program_ProgramName">
<input type="text" data-table="la_program" data-field="x_ProgramName" name="x_ProgramName" id="x_ProgramName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_program_edit->ProgramName->getPlaceHolder()) ?>" value="<?php echo $la_program_edit->ProgramName->EditValue ?>"<?php echo $la_program_edit->ProgramName->editAttributes() ?>>
</span>
<?php echo $la_program_edit->ProgramName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_program_edit->ProgramPurpose->Visible) { // ProgramPurpose ?>
	<div id="r_ProgramPurpose" class="form-group row">
		<label id="elh_la_program_ProgramPurpose" for="x_ProgramPurpose" class="<?php echo $la_program_edit->LeftColumnClass ?>"><?php echo $la_program_edit->ProgramPurpose->caption() ?><?php echo $la_program_edit->ProgramPurpose->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_program_edit->RightColumnClass ?>"><div <?php echo $la_program_edit->ProgramPurpose->cellAttributes() ?>>
<span id="el_la_program_ProgramPurpose">
<textarea data-table="la_program" data-field="x_ProgramPurpose" name="x_ProgramPurpose" id="x_ProgramPurpose" cols="35" rows="4" placeholder="<?php echo HtmlEncode($la_program_edit->ProgramPurpose->getPlaceHolder()) ?>"<?php echo $la_program_edit->ProgramPurpose->editAttributes() ?>><?php echo $la_program_edit->ProgramPurpose->EditValue ?></textarea>
</span>
<?php echo $la_program_edit->ProgramPurpose->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("la_sub_program", explode(",", $la_program->getCurrentDetailTable())) && $la_sub_program->DetailEdit) {
?>
<?php if ($la_program->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("la_sub_program", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "la_sub_programgrid.php" ?>
<?php } ?>
<?php if (!$la_program_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $la_program_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $la_program_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$la_program_edit->IsModal) { ?>
<?php echo $la_program_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$la_program_edit->showPageFooter();
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
$la_program_edit->terminate();
?>