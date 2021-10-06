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
$la_program_add = new la_program_add();

// Run the page
$la_program_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_program_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fla_programadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fla_programadd = currentForm = new ew.Form("fla_programadd", "add");

	// Validate form
	fla_programadd.validate = function() {
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
			<?php if ($la_program_add->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_program_add->ProgramCode->caption(), $la_program_add->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($la_program_add->ProgramCode->errorMessage()) ?>");
			<?php if ($la_program_add->ProgramName->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_program_add->ProgramName->caption(), $la_program_add->ProgramName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_program_add->ProgramPurpose->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramPurpose");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_program_add->ProgramPurpose->caption(), $la_program_add->ProgramPurpose->RequiredErrorMessage)) ?>");
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
	fla_programadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fla_programadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fla_programadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $la_program_add->showPageHeader(); ?>
<?php
$la_program_add->showMessage();
?>
<form name="fla_programadd" id="fla_programadd" class="<?php echo $la_program_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_program">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$la_program_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($la_program_add->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh_la_program_ProgramCode" for="x_ProgramCode" class="<?php echo $la_program_add->LeftColumnClass ?>"><?php echo $la_program_add->ProgramCode->caption() ?><?php echo $la_program_add->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_program_add->RightColumnClass ?>"><div <?php echo $la_program_add->ProgramCode->cellAttributes() ?>>
<span id="el_la_program_ProgramCode">
<input type="text" data-table="la_program" data-field="x_ProgramCode" name="x_ProgramCode" id="x_ProgramCode" size="30" placeholder="<?php echo HtmlEncode($la_program_add->ProgramCode->getPlaceHolder()) ?>" value="<?php echo $la_program_add->ProgramCode->EditValue ?>"<?php echo $la_program_add->ProgramCode->editAttributes() ?>>
</span>
<?php echo $la_program_add->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_program_add->ProgramName->Visible) { // ProgramName ?>
	<div id="r_ProgramName" class="form-group row">
		<label id="elh_la_program_ProgramName" for="x_ProgramName" class="<?php echo $la_program_add->LeftColumnClass ?>"><?php echo $la_program_add->ProgramName->caption() ?><?php echo $la_program_add->ProgramName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_program_add->RightColumnClass ?>"><div <?php echo $la_program_add->ProgramName->cellAttributes() ?>>
<span id="el_la_program_ProgramName">
<input type="text" data-table="la_program" data-field="x_ProgramName" name="x_ProgramName" id="x_ProgramName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_program_add->ProgramName->getPlaceHolder()) ?>" value="<?php echo $la_program_add->ProgramName->EditValue ?>"<?php echo $la_program_add->ProgramName->editAttributes() ?>>
</span>
<?php echo $la_program_add->ProgramName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_program_add->ProgramPurpose->Visible) { // ProgramPurpose ?>
	<div id="r_ProgramPurpose" class="form-group row">
		<label id="elh_la_program_ProgramPurpose" for="x_ProgramPurpose" class="<?php echo $la_program_add->LeftColumnClass ?>"><?php echo $la_program_add->ProgramPurpose->caption() ?><?php echo $la_program_add->ProgramPurpose->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_program_add->RightColumnClass ?>"><div <?php echo $la_program_add->ProgramPurpose->cellAttributes() ?>>
<span id="el_la_program_ProgramPurpose">
<textarea data-table="la_program" data-field="x_ProgramPurpose" name="x_ProgramPurpose" id="x_ProgramPurpose" cols="35" rows="4" placeholder="<?php echo HtmlEncode($la_program_add->ProgramPurpose->getPlaceHolder()) ?>"<?php echo $la_program_add->ProgramPurpose->editAttributes() ?>><?php echo $la_program_add->ProgramPurpose->EditValue ?></textarea>
</span>
<?php echo $la_program_add->ProgramPurpose->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("la_sub_program", explode(",", $la_program->getCurrentDetailTable())) && $la_sub_program->DetailAdd) {
?>
<?php if ($la_program->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("la_sub_program", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "la_sub_programgrid.php" ?>
<?php } ?>
<?php if (!$la_program_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $la_program_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $la_program_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$la_program_add->showPageFooter();
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
$la_program_add->terminate();
?>