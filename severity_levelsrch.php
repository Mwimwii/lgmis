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
$severity_level_search = new severity_level_search();

// Run the page
$severity_level_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$severity_level_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fseverity_levelsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($severity_level_search->IsModal) { ?>
	fseverity_levelsearch = currentAdvancedSearchForm = new ew.Form("fseverity_levelsearch", "search");
	<?php } else { ?>
	fseverity_levelsearch = currentForm = new ew.Form("fseverity_levelsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fseverity_levelsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_SeverityLevelCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($severity_level_search->SeverityLevelCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ResponseTime");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($severity_level_search->ResponseTime->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fseverity_levelsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fseverity_levelsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fseverity_levelsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $severity_level_search->showPageHeader(); ?>
<?php
$severity_level_search->showMessage();
?>
<form name="fseverity_levelsearch" id="fseverity_levelsearch" class="<?php echo $severity_level_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="severity_level">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$severity_level_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($severity_level_search->SeverityLevelCode->Visible) { // SeverityLevelCode ?>
	<div id="r_SeverityLevelCode" class="form-group row">
		<label for="x_SeverityLevelCode" class="<?php echo $severity_level_search->LeftColumnClass ?>"><span id="elh_severity_level_SeverityLevelCode"><?php echo $severity_level_search->SeverityLevelCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SeverityLevelCode" id="z_SeverityLevelCode" value="=">
</span>
		</label>
		<div class="<?php echo $severity_level_search->RightColumnClass ?>"><div <?php echo $severity_level_search->SeverityLevelCode->cellAttributes() ?>>
			<span id="el_severity_level_SeverityLevelCode" class="ew-search-field">
<input type="text" data-table="severity_level" data-field="x_SeverityLevelCode" name="x_SeverityLevelCode" id="x_SeverityLevelCode" placeholder="<?php echo HtmlEncode($severity_level_search->SeverityLevelCode->getPlaceHolder()) ?>" value="<?php echo $severity_level_search->SeverityLevelCode->EditValue ?>"<?php echo $severity_level_search->SeverityLevelCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($severity_level_search->SeverityLevel->Visible) { // SeverityLevel ?>
	<div id="r_SeverityLevel" class="form-group row">
		<label for="x_SeverityLevel" class="<?php echo $severity_level_search->LeftColumnClass ?>"><span id="elh_severity_level_SeverityLevel"><?php echo $severity_level_search->SeverityLevel->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SeverityLevel" id="z_SeverityLevel" value="LIKE">
</span>
		</label>
		<div class="<?php echo $severity_level_search->RightColumnClass ?>"><div <?php echo $severity_level_search->SeverityLevel->cellAttributes() ?>>
			<span id="el_severity_level_SeverityLevel" class="ew-search-field">
<input type="text" data-table="severity_level" data-field="x_SeverityLevel" name="x_SeverityLevel" id="x_SeverityLevel" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($severity_level_search->SeverityLevel->getPlaceHolder()) ?>" value="<?php echo $severity_level_search->SeverityLevel->EditValue ?>"<?php echo $severity_level_search->SeverityLevel->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($severity_level_search->SeverityDescription->Visible) { // SeverityDescription ?>
	<div id="r_SeverityDescription" class="form-group row">
		<label for="x_SeverityDescription" class="<?php echo $severity_level_search->LeftColumnClass ?>"><span id="elh_severity_level_SeverityDescription"><?php echo $severity_level_search->SeverityDescription->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SeverityDescription" id="z_SeverityDescription" value="LIKE">
</span>
		</label>
		<div class="<?php echo $severity_level_search->RightColumnClass ?>"><div <?php echo $severity_level_search->SeverityDescription->cellAttributes() ?>>
			<span id="el_severity_level_SeverityDescription" class="ew-search-field">
<input type="text" data-table="severity_level" data-field="x_SeverityDescription" name="x_SeverityDescription" id="x_SeverityDescription" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($severity_level_search->SeverityDescription->getPlaceHolder()) ?>" value="<?php echo $severity_level_search->SeverityDescription->EditValue ?>"<?php echo $severity_level_search->SeverityDescription->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($severity_level_search->ResponseTime->Visible) { // ResponseTime ?>
	<div id="r_ResponseTime" class="form-group row">
		<label for="x_ResponseTime" class="<?php echo $severity_level_search->LeftColumnClass ?>"><span id="elh_severity_level_ResponseTime"><?php echo $severity_level_search->ResponseTime->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ResponseTime" id="z_ResponseTime" value="=">
</span>
		</label>
		<div class="<?php echo $severity_level_search->RightColumnClass ?>"><div <?php echo $severity_level_search->ResponseTime->cellAttributes() ?>>
			<span id="el_severity_level_ResponseTime" class="ew-search-field">
<input type="text" data-table="severity_level" data-field="x_ResponseTime" name="x_ResponseTime" id="x_ResponseTime" size="30" placeholder="<?php echo HtmlEncode($severity_level_search->ResponseTime->getPlaceHolder()) ?>" value="<?php echo $severity_level_search->ResponseTime->EditValue ?>"<?php echo $severity_level_search->ResponseTime->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$severity_level_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $severity_level_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$severity_level_search->showPageFooter();
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
$severity_level_search->terminate();
?>