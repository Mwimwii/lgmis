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
$programme_ref_search = new programme_ref_search();

// Run the page
$programme_ref_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$programme_ref_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprogramme_refsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($programme_ref_search->IsModal) { ?>
	fprogramme_refsearch = currentAdvancedSearchForm = new ew.Form("fprogramme_refsearch", "search");
	<?php } else { ?>
	fprogramme_refsearch = currentForm = new ew.Form("fprogramme_refsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fprogramme_refsearch.validate = function(fobj) {
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
	fprogramme_refsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprogramme_refsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fprogramme_refsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $programme_ref_search->showPageHeader(); ?>
<?php
$programme_ref_search->showMessage();
?>
<form name="fprogramme_refsearch" id="fprogramme_refsearch" class="<?php echo $programme_ref_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="programme_ref">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$programme_ref_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($programme_ref_search->ProgRefCode->Visible) { // ProgRefCode ?>
	<div id="r_ProgRefCode" class="form-group row">
		<label for="x_ProgRefCode" class="<?php echo $programme_ref_search->LeftColumnClass ?>"><span id="elh_programme_ref_ProgRefCode"><?php echo $programme_ref_search->ProgRefCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProgRefCode" id="z_ProgRefCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $programme_ref_search->RightColumnClass ?>"><div <?php echo $programme_ref_search->ProgRefCode->cellAttributes() ?>>
			<span id="el_programme_ref_ProgRefCode" class="ew-search-field">
<input type="text" data-table="programme_ref" data-field="x_ProgRefCode" name="x_ProgRefCode" id="x_ProgRefCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($programme_ref_search->ProgRefCode->getPlaceHolder()) ?>" value="<?php echo $programme_ref_search->ProgRefCode->EditValue ?>"<?php echo $programme_ref_search->ProgRefCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($programme_ref_search->FunctionCode->Visible) { // FunctionCode ?>
	<div id="r_FunctionCode" class="form-group row">
		<label for="x_FunctionCode" class="<?php echo $programme_ref_search->LeftColumnClass ?>"><span id="elh_programme_ref_FunctionCode"><?php echo $programme_ref_search->FunctionCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FunctionCode" id="z_FunctionCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $programme_ref_search->RightColumnClass ?>"><div <?php echo $programme_ref_search->FunctionCode->cellAttributes() ?>>
			<span id="el_programme_ref_FunctionCode" class="ew-search-field">
<input type="text" data-table="programme_ref" data-field="x_FunctionCode" name="x_FunctionCode" id="x_FunctionCode" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($programme_ref_search->FunctionCode->getPlaceHolder()) ?>" value="<?php echo $programme_ref_search->FunctionCode->EditValue ?>"<?php echo $programme_ref_search->FunctionCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($programme_ref_search->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<div id="r_ProgrammeCode" class="form-group row">
		<label for="x_ProgrammeCode" class="<?php echo $programme_ref_search->LeftColumnClass ?>"><span id="elh_programme_ref_ProgrammeCode"><?php echo $programme_ref_search->ProgrammeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProgrammeCode" id="z_ProgrammeCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $programme_ref_search->RightColumnClass ?>"><div <?php echo $programme_ref_search->ProgrammeCode->cellAttributes() ?>>
			<span id="el_programme_ref_ProgrammeCode" class="ew-search-field">
<input type="text" data-table="programme_ref" data-field="x_ProgrammeCode" name="x_ProgrammeCode" id="x_ProgrammeCode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($programme_ref_search->ProgrammeCode->getPlaceHolder()) ?>" value="<?php echo $programme_ref_search->ProgrammeCode->EditValue ?>"<?php echo $programme_ref_search->ProgrammeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($programme_ref_search->ProgrammeName->Visible) { // ProgrammeName ?>
	<div id="r_ProgrammeName" class="form-group row">
		<label for="x_ProgrammeName" class="<?php echo $programme_ref_search->LeftColumnClass ?>"><span id="elh_programme_ref_ProgrammeName"><?php echo $programme_ref_search->ProgrammeName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProgrammeName" id="z_ProgrammeName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $programme_ref_search->RightColumnClass ?>"><div <?php echo $programme_ref_search->ProgrammeName->cellAttributes() ?>>
			<span id="el_programme_ref_ProgrammeName" class="ew-search-field">
<input type="text" data-table="programme_ref" data-field="x_ProgrammeName" name="x_ProgrammeName" id="x_ProgrammeName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($programme_ref_search->ProgrammeName->getPlaceHolder()) ?>" value="<?php echo $programme_ref_search->ProgrammeName->EditValue ?>"<?php echo $programme_ref_search->ProgrammeName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$programme_ref_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $programme_ref_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$programme_ref_search->showPageFooter();
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
$programme_ref_search->terminate();
?>