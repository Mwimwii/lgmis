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
$means_of_application_search = new means_of_application_search();

// Run the page
$means_of_application_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$means_of_application_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmeans_of_applicationsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($means_of_application_search->IsModal) { ?>
	fmeans_of_applicationsearch = currentAdvancedSearchForm = new ew.Form("fmeans_of_applicationsearch", "search");
	<?php } else { ?>
	fmeans_of_applicationsearch = currentForm = new ew.Form("fmeans_of_applicationsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fmeans_of_applicationsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ChoiceCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($means_of_application_search->ChoiceCode->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fmeans_of_applicationsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmeans_of_applicationsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmeans_of_applicationsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $means_of_application_search->showPageHeader(); ?>
<?php
$means_of_application_search->showMessage();
?>
<form name="fmeans_of_applicationsearch" id="fmeans_of_applicationsearch" class="<?php echo $means_of_application_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="means_of_application">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$means_of_application_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($means_of_application_search->ChoiceCode->Visible) { // ChoiceCode ?>
	<div id="r_ChoiceCode" class="form-group row">
		<label for="x_ChoiceCode" class="<?php echo $means_of_application_search->LeftColumnClass ?>"><span id="elh_means_of_application_ChoiceCode"><?php echo $means_of_application_search->ChoiceCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ChoiceCode" id="z_ChoiceCode" value="=">
</span>
		</label>
		<div class="<?php echo $means_of_application_search->RightColumnClass ?>"><div <?php echo $means_of_application_search->ChoiceCode->cellAttributes() ?>>
			<span id="el_means_of_application_ChoiceCode" class="ew-search-field">
<input type="text" data-table="means_of_application" data-field="x_ChoiceCode" name="x_ChoiceCode" id="x_ChoiceCode" size="30" placeholder="<?php echo HtmlEncode($means_of_application_search->ChoiceCode->getPlaceHolder()) ?>" value="<?php echo $means_of_application_search->ChoiceCode->EditValue ?>"<?php echo $means_of_application_search->ChoiceCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($means_of_application_search->Application->Visible) { // Application ?>
	<div id="r_Application" class="form-group row">
		<label for="x_Application" class="<?php echo $means_of_application_search->LeftColumnClass ?>"><span id="elh_means_of_application_Application"><?php echo $means_of_application_search->Application->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Application" id="z_Application" value="LIKE">
</span>
		</label>
		<div class="<?php echo $means_of_application_search->RightColumnClass ?>"><div <?php echo $means_of_application_search->Application->cellAttributes() ?>>
			<span id="el_means_of_application_Application" class="ew-search-field">
<input type="text" data-table="means_of_application" data-field="x_Application" name="x_Application" id="x_Application" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($means_of_application_search->Application->getPlaceHolder()) ?>" value="<?php echo $means_of_application_search->Application->EditValue ?>"<?php echo $means_of_application_search->Application->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$means_of_application_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $means_of_application_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$means_of_application_search->showPageFooter();
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
$means_of_application_search->terminate();
?>