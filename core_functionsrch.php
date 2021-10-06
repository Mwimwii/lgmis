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
$core_function_search = new core_function_search();

// Run the page
$core_function_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$core_function_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcore_functionsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($core_function_search->IsModal) { ?>
	fcore_functionsearch = currentAdvancedSearchForm = new ew.Form("fcore_functionsearch", "search");
	<?php } else { ?>
	fcore_functionsearch = currentForm = new ew.Form("fcore_functionsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fcore_functionsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fcore_functionsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcore_functionsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcore_functionsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $core_function_search->showPageHeader(); ?>
<?php
$core_function_search->showMessage();
?>
<form name="fcore_functionsearch" id="fcore_functionsearch" class="<?php echo $core_function_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="core_function">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$core_function_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($core_function_search->functioncode->Visible) { // functioncode ?>
	<div id="r_functioncode" class="form-group row">
		<label for="x_functioncode" class="<?php echo $core_function_search->LeftColumnClass ?>"><span id="elh_core_function_functioncode"><?php echo $core_function_search->functioncode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_functioncode" id="z_functioncode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $core_function_search->RightColumnClass ?>"><div <?php echo $core_function_search->functioncode->cellAttributes() ?>>
			<span id="el_core_function_functioncode" class="ew-search-field">
<input type="text" data-table="core_function" data-field="x_functioncode" name="x_functioncode" id="x_functioncode" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($core_function_search->functioncode->getPlaceHolder()) ?>" value="<?php echo $core_function_search->functioncode->EditValue ?>"<?php echo $core_function_search->functioncode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($core_function_search->FunctionName->Visible) { // FunctionName ?>
	<div id="r_FunctionName" class="form-group row">
		<label for="x_FunctionName" class="<?php echo $core_function_search->LeftColumnClass ?>"><span id="elh_core_function_FunctionName"><?php echo $core_function_search->FunctionName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FunctionName" id="z_FunctionName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $core_function_search->RightColumnClass ?>"><div <?php echo $core_function_search->FunctionName->cellAttributes() ?>>
			<span id="el_core_function_FunctionName" class="ew-search-field">
<input type="text" data-table="core_function" data-field="x_FunctionName" name="x_FunctionName" id="x_FunctionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($core_function_search->FunctionName->getPlaceHolder()) ?>" value="<?php echo $core_function_search->FunctionName->EditValue ?>"<?php echo $core_function_search->FunctionName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$core_function_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $core_function_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$core_function_search->showPageFooter();
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
$core_function_search->terminate();
?>