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
$severity_level_edit = new severity_level_edit();

// Run the page
$severity_level_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$severity_level_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fseverity_leveledit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fseverity_leveledit = currentForm = new ew.Form("fseverity_leveledit", "edit");

	// Validate form
	fseverity_leveledit.validate = function() {
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
			<?php if ($severity_level_edit->SeverityLevelCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SeverityLevelCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $severity_level_edit->SeverityLevelCode->caption(), $severity_level_edit->SeverityLevelCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($severity_level_edit->SeverityLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_SeverityLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $severity_level_edit->SeverityLevel->caption(), $severity_level_edit->SeverityLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($severity_level_edit->SeverityDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_SeverityDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $severity_level_edit->SeverityDescription->caption(), $severity_level_edit->SeverityDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($severity_level_edit->ResponseTime->Required) { ?>
				elm = this.getElements("x" + infix + "_ResponseTime");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $severity_level_edit->ResponseTime->caption(), $severity_level_edit->ResponseTime->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ResponseTime");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($severity_level_edit->ResponseTime->errorMessage()) ?>");

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
	fseverity_leveledit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fseverity_leveledit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fseverity_leveledit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $severity_level_edit->showPageHeader(); ?>
<?php
$severity_level_edit->showMessage();
?>
<?php if (!$severity_level_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $severity_level_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fseverity_leveledit" id="fseverity_leveledit" class="<?php echo $severity_level_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="severity_level">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$severity_level_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($severity_level_edit->SeverityLevelCode->Visible) { // SeverityLevelCode ?>
	<div id="r_SeverityLevelCode" class="form-group row">
		<label id="elh_severity_level_SeverityLevelCode" class="<?php echo $severity_level_edit->LeftColumnClass ?>"><?php echo $severity_level_edit->SeverityLevelCode->caption() ?><?php echo $severity_level_edit->SeverityLevelCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $severity_level_edit->RightColumnClass ?>"><div <?php echo $severity_level_edit->SeverityLevelCode->cellAttributes() ?>>
<span id="el_severity_level_SeverityLevelCode">
<span<?php echo $severity_level_edit->SeverityLevelCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($severity_level_edit->SeverityLevelCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="severity_level" data-field="x_SeverityLevelCode" name="x_SeverityLevelCode" id="x_SeverityLevelCode" value="<?php echo HtmlEncode($severity_level_edit->SeverityLevelCode->CurrentValue) ?>">
<?php echo $severity_level_edit->SeverityLevelCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($severity_level_edit->SeverityLevel->Visible) { // SeverityLevel ?>
	<div id="r_SeverityLevel" class="form-group row">
		<label id="elh_severity_level_SeverityLevel" for="x_SeverityLevel" class="<?php echo $severity_level_edit->LeftColumnClass ?>"><?php echo $severity_level_edit->SeverityLevel->caption() ?><?php echo $severity_level_edit->SeverityLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $severity_level_edit->RightColumnClass ?>"><div <?php echo $severity_level_edit->SeverityLevel->cellAttributes() ?>>
<span id="el_severity_level_SeverityLevel">
<input type="text" data-table="severity_level" data-field="x_SeverityLevel" name="x_SeverityLevel" id="x_SeverityLevel" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($severity_level_edit->SeverityLevel->getPlaceHolder()) ?>" value="<?php echo $severity_level_edit->SeverityLevel->EditValue ?>"<?php echo $severity_level_edit->SeverityLevel->editAttributes() ?>>
</span>
<?php echo $severity_level_edit->SeverityLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($severity_level_edit->SeverityDescription->Visible) { // SeverityDescription ?>
	<div id="r_SeverityDescription" class="form-group row">
		<label id="elh_severity_level_SeverityDescription" for="x_SeverityDescription" class="<?php echo $severity_level_edit->LeftColumnClass ?>"><?php echo $severity_level_edit->SeverityDescription->caption() ?><?php echo $severity_level_edit->SeverityDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $severity_level_edit->RightColumnClass ?>"><div <?php echo $severity_level_edit->SeverityDescription->cellAttributes() ?>>
<span id="el_severity_level_SeverityDescription">
<input type="text" data-table="severity_level" data-field="x_SeverityDescription" name="x_SeverityDescription" id="x_SeverityDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($severity_level_edit->SeverityDescription->getPlaceHolder()) ?>" value="<?php echo $severity_level_edit->SeverityDescription->EditValue ?>"<?php echo $severity_level_edit->SeverityDescription->editAttributes() ?>>
</span>
<?php echo $severity_level_edit->SeverityDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($severity_level_edit->ResponseTime->Visible) { // ResponseTime ?>
	<div id="r_ResponseTime" class="form-group row">
		<label id="elh_severity_level_ResponseTime" for="x_ResponseTime" class="<?php echo $severity_level_edit->LeftColumnClass ?>"><?php echo $severity_level_edit->ResponseTime->caption() ?><?php echo $severity_level_edit->ResponseTime->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $severity_level_edit->RightColumnClass ?>"><div <?php echo $severity_level_edit->ResponseTime->cellAttributes() ?>>
<span id="el_severity_level_ResponseTime">
<input type="text" data-table="severity_level" data-field="x_ResponseTime" name="x_ResponseTime" id="x_ResponseTime" size="30" placeholder="<?php echo HtmlEncode($severity_level_edit->ResponseTime->getPlaceHolder()) ?>" value="<?php echo $severity_level_edit->ResponseTime->EditValue ?>"<?php echo $severity_level_edit->ResponseTime->editAttributes() ?>>
</span>
<?php echo $severity_level_edit->ResponseTime->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$severity_level_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $severity_level_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $severity_level_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$severity_level_edit->IsModal) { ?>
<?php echo $severity_level_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$severity_level_edit->showPageFooter();
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
$severity_level_edit->terminate();
?>