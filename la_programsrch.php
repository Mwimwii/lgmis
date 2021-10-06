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
$la_program_search = new la_program_search();

// Run the page
$la_program_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_program_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fla_programsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($la_program_search->IsModal) { ?>
	fla_programsearch = currentAdvancedSearchForm = new ew.Form("fla_programsearch", "search");
	<?php } else { ?>
	fla_programsearch = currentForm = new ew.Form("fla_programsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fla_programsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ProgramCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($la_program_search->ProgramCode->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fla_programsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fla_programsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fla_programsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $la_program_search->showPageHeader(); ?>
<?php
$la_program_search->showMessage();
?>
<form name="fla_programsearch" id="fla_programsearch" class="<?php echo $la_program_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_program">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$la_program_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($la_program_search->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label for="x_ProgramCode" class="<?php echo $la_program_search->LeftColumnClass ?>"><span id="elh_la_program_ProgramCode"><?php echo $la_program_search->ProgramCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProgramCode" id="z_ProgramCode" value="=">
</span>
		</label>
		<div class="<?php echo $la_program_search->RightColumnClass ?>"><div <?php echo $la_program_search->ProgramCode->cellAttributes() ?>>
			<span id="el_la_program_ProgramCode" class="ew-search-field">
<input type="text" data-table="la_program" data-field="x_ProgramCode" name="x_ProgramCode" id="x_ProgramCode" size="30" placeholder="<?php echo HtmlEncode($la_program_search->ProgramCode->getPlaceHolder()) ?>" value="<?php echo $la_program_search->ProgramCode->EditValue ?>"<?php echo $la_program_search->ProgramCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($la_program_search->ProgramName->Visible) { // ProgramName ?>
	<div id="r_ProgramName" class="form-group row">
		<label for="x_ProgramName" class="<?php echo $la_program_search->LeftColumnClass ?>"><span id="elh_la_program_ProgramName"><?php echo $la_program_search->ProgramName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProgramName" id="z_ProgramName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $la_program_search->RightColumnClass ?>"><div <?php echo $la_program_search->ProgramName->cellAttributes() ?>>
			<span id="el_la_program_ProgramName" class="ew-search-field">
<input type="text" data-table="la_program" data-field="x_ProgramName" name="x_ProgramName" id="x_ProgramName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_program_search->ProgramName->getPlaceHolder()) ?>" value="<?php echo $la_program_search->ProgramName->EditValue ?>"<?php echo $la_program_search->ProgramName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($la_program_search->ProgramPurpose->Visible) { // ProgramPurpose ?>
	<div id="r_ProgramPurpose" class="form-group row">
		<label for="x_ProgramPurpose" class="<?php echo $la_program_search->LeftColumnClass ?>"><span id="elh_la_program_ProgramPurpose"><?php echo $la_program_search->ProgramPurpose->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ProgramPurpose" id="z_ProgramPurpose" value="LIKE">
</span>
		</label>
		<div class="<?php echo $la_program_search->RightColumnClass ?>"><div <?php echo $la_program_search->ProgramPurpose->cellAttributes() ?>>
			<span id="el_la_program_ProgramPurpose" class="ew-search-field">
<input type="text" data-table="la_program" data-field="x_ProgramPurpose" name="x_ProgramPurpose" id="x_ProgramPurpose" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($la_program_search->ProgramPurpose->getPlaceHolder()) ?>" value="<?php echo $la_program_search->ProgramPurpose->EditValue ?>"<?php echo $la_program_search->ProgramPurpose->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$la_program_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $la_program_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$la_program_search->showPageFooter();
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
$la_program_search->terminate();
?>