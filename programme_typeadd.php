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
$programme_type_add = new programme_type_add();

// Run the page
$programme_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$programme_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprogramme_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fprogramme_typeadd = currentForm = new ew.Form("fprogramme_typeadd", "add");

	// Validate form
	fprogramme_typeadd.validate = function() {
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
			<?php if ($programme_type_add->ProgrammeType->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_type_add->ProgrammeType->caption(), $programme_type_add->ProgrammeType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgrammeType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($programme_type_add->ProgrammeType->errorMessage()) ?>");
			<?php if ($programme_type_add->ProgrammeTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgrammeTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $programme_type_add->ProgrammeTypeDesc->caption(), $programme_type_add->ProgrammeTypeDesc->RequiredErrorMessage)) ?>");
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
	fprogramme_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprogramme_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fprogramme_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $programme_type_add->showPageHeader(); ?>
<?php
$programme_type_add->showMessage();
?>
<form name="fprogramme_typeadd" id="fprogramme_typeadd" class="<?php echo $programme_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="programme_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$programme_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($programme_type_add->ProgrammeType->Visible) { // ProgrammeType ?>
	<div id="r_ProgrammeType" class="form-group row">
		<label id="elh_programme_type_ProgrammeType" for="x_ProgrammeType" class="<?php echo $programme_type_add->LeftColumnClass ?>"><?php echo $programme_type_add->ProgrammeType->caption() ?><?php echo $programme_type_add->ProgrammeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_type_add->RightColumnClass ?>"><div <?php echo $programme_type_add->ProgrammeType->cellAttributes() ?>>
<span id="el_programme_type_ProgrammeType">
<input type="text" data-table="programme_type" data-field="x_ProgrammeType" name="x_ProgrammeType" id="x_ProgrammeType" placeholder="<?php echo HtmlEncode($programme_type_add->ProgrammeType->getPlaceHolder()) ?>" value="<?php echo $programme_type_add->ProgrammeType->EditValue ?>"<?php echo $programme_type_add->ProgrammeType->editAttributes() ?>>
</span>
<?php echo $programme_type_add->ProgrammeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($programme_type_add->ProgrammeTypeDesc->Visible) { // ProgrammeTypeDesc ?>
	<div id="r_ProgrammeTypeDesc" class="form-group row">
		<label id="elh_programme_type_ProgrammeTypeDesc" for="x_ProgrammeTypeDesc" class="<?php echo $programme_type_add->LeftColumnClass ?>"><?php echo $programme_type_add->ProgrammeTypeDesc->caption() ?><?php echo $programme_type_add->ProgrammeTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $programme_type_add->RightColumnClass ?>"><div <?php echo $programme_type_add->ProgrammeTypeDesc->cellAttributes() ?>>
<span id="el_programme_type_ProgrammeTypeDesc">
<input type="text" data-table="programme_type" data-field="x_ProgrammeTypeDesc" name="x_ProgrammeTypeDesc" id="x_ProgrammeTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($programme_type_add->ProgrammeTypeDesc->getPlaceHolder()) ?>" value="<?php echo $programme_type_add->ProgrammeTypeDesc->EditValue ?>"<?php echo $programme_type_add->ProgrammeTypeDesc->editAttributes() ?>>
</span>
<?php echo $programme_type_add->ProgrammeTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$programme_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $programme_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $programme_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$programme_type_add->showPageFooter();
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
$programme_type_add->terminate();
?>