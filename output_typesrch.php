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
$output_type_search = new output_type_search();

// Run the page
$output_type_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$output_type_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var foutput_typesearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($output_type_search->IsModal) { ?>
	foutput_typesearch = currentAdvancedSearchForm = new ew.Form("foutput_typesearch", "search");
	<?php } else { ?>
	foutput_typesearch = currentForm = new ew.Form("foutput_typesearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	foutput_typesearch.validate = function(fobj) {
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
	foutput_typesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	foutput_typesearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("foutput_typesearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $output_type_search->showPageHeader(); ?>
<?php
$output_type_search->showMessage();
?>
<form name="foutput_typesearch" id="foutput_typesearch" class="<?php echo $output_type_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="output_type">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$output_type_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($output_type_search->OutputType->Visible) { // OutputType ?>
	<div id="r_OutputType" class="form-group row">
		<label for="x_OutputType" class="<?php echo $output_type_search->LeftColumnClass ?>"><span id="elh_output_type_OutputType"><?php echo $output_type_search->OutputType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_OutputType" id="z_OutputType" value="LIKE">
</span>
		</label>
		<div class="<?php echo $output_type_search->RightColumnClass ?>"><div <?php echo $output_type_search->OutputType->cellAttributes() ?>>
			<span id="el_output_type_OutputType" class="ew-search-field">
<input type="text" data-table="output_type" data-field="x_OutputType" name="x_OutputType" id="x_OutputType" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($output_type_search->OutputType->getPlaceHolder()) ?>" value="<?php echo $output_type_search->OutputType->EditValue ?>"<?php echo $output_type_search->OutputType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$output_type_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $output_type_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$output_type_search->showPageFooter();
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
$output_type_search->terminate();
?>