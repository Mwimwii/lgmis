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
$severity_level_add = new severity_level_add();

// Run the page
$severity_level_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$severity_level_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fseverity_leveladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fseverity_leveladd = currentForm = new ew.Form("fseverity_leveladd", "add");

	// Validate form
	fseverity_leveladd.validate = function() {
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
			<?php if ($severity_level_add->SeverityLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_SeverityLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $severity_level_add->SeverityLevel->caption(), $severity_level_add->SeverityLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($severity_level_add->SeverityDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_SeverityDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $severity_level_add->SeverityDescription->caption(), $severity_level_add->SeverityDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($severity_level_add->ResponseTime->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponseTime");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $severity_level_add->ResponseTime->caption(), $severity_level_add->ResponseTime->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ResponseTime");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($severity_level_add->ResponseTime->errorMessage()) ?>");

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
	fseverity_leveladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fseverity_leveladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fseverity_leveladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $severity_level_add->showPageHeader(); ?>
<?php
$severity_level_add->showMessage();
?>
<form name="fseverity_leveladd" id="fseverity_leveladd" class="<?php echo $severity_level_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="severity_level">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$severity_level_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($severity_level_add->SeverityLevel->Visible) { // SeverityLevel ?>
	<div id="r_SeverityLevel" class="form-group row">
		<label id="elh_severity_level_SeverityLevel" for="x_SeverityLevel" class="<?php echo $severity_level_add->LeftColumnClass ?>"><?php echo $severity_level_add->SeverityLevel->caption() ?><?php echo $severity_level_add->SeverityLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $severity_level_add->RightColumnClass ?>"><div <?php echo $severity_level_add->SeverityLevel->cellAttributes() ?>>
<span id="el_severity_level_SeverityLevel">
<input type="text" data-table="severity_level" data-field="x_SeverityLevel" name="x_SeverityLevel" id="x_SeverityLevel" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($severity_level_add->SeverityLevel->getPlaceHolder()) ?>" value="<?php echo $severity_level_add->SeverityLevel->EditValue ?>"<?php echo $severity_level_add->SeverityLevel->editAttributes() ?>>
</span>
<?php echo $severity_level_add->SeverityLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($severity_level_add->SeverityDescription->Visible) { // SeverityDescription ?>
	<div id="r_SeverityDescription" class="form-group row">
		<label id="elh_severity_level_SeverityDescription" for="x_SeverityDescription" class="<?php echo $severity_level_add->LeftColumnClass ?>"><?php echo $severity_level_add->SeverityDescription->caption() ?><?php echo $severity_level_add->SeverityDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $severity_level_add->RightColumnClass ?>"><div <?php echo $severity_level_add->SeverityDescription->cellAttributes() ?>>
<span id="el_severity_level_SeverityDescription">
<input type="text" data-table="severity_level" data-field="x_SeverityDescription" name="x_SeverityDescription" id="x_SeverityDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($severity_level_add->SeverityDescription->getPlaceHolder()) ?>" value="<?php echo $severity_level_add->SeverityDescription->EditValue ?>"<?php echo $severity_level_add->SeverityDescription->editAttributes() ?>>
</span>
<?php echo $severity_level_add->SeverityDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($severity_level_add->ResponseTime->Visible) { // ResponseTime ?>
	<div id="r_ResponseTime" class="form-group row">
		<label id="elh_severity_level_ResponseTime" for="x_ResponseTime" class="<?php echo $severity_level_add->LeftColumnClass ?>"><?php echo $severity_level_add->ResponseTime->caption() ?><?php echo $severity_level_add->ResponseTime->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $severity_level_add->RightColumnClass ?>"><div <?php echo $severity_level_add->ResponseTime->cellAttributes() ?>>
<span id="el_severity_level_ResponseTime">
<input type="text" data-table="severity_level" data-field="x_ResponseTime" name="x_ResponseTime" id="x_ResponseTime" size="30" placeholder="<?php echo HtmlEncode($severity_level_add->ResponseTime->getPlaceHolder()) ?>" value="<?php echo $severity_level_add->ResponseTime->EditValue ?>"<?php echo $severity_level_add->ResponseTime->editAttributes() ?>>
</span>
<?php echo $severity_level_add->ResponseTime->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$severity_level_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $severity_level_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $severity_level_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$severity_level_add->showPageFooter();
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
$severity_level_add->terminate();
?>