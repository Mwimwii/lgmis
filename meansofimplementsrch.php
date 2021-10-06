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
$meansofimplement_search = new meansofimplement_search();

// Run the page
$meansofimplement_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$meansofimplement_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmeansofimplementsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($meansofimplement_search->IsModal) { ?>
	fmeansofimplementsearch = currentAdvancedSearchForm = new ew.Form("fmeansofimplementsearch", "search");
	<?php } else { ?>
	fmeansofimplementsearch = currentForm = new ew.Form("fmeansofimplementsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fmeansofimplementsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_moimp_code");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($meansofimplement_search->moimp_code->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fmeansofimplementsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmeansofimplementsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmeansofimplementsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $meansofimplement_search->showPageHeader(); ?>
<?php
$meansofimplement_search->showMessage();
?>
<form name="fmeansofimplementsearch" id="fmeansofimplementsearch" class="<?php echo $meansofimplement_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="meansofimplement">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$meansofimplement_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($meansofimplement_search->moimp_code->Visible) { // moimp_code ?>
	<div id="r_moimp_code" class="form-group row">
		<label for="x_moimp_code" class="<?php echo $meansofimplement_search->LeftColumnClass ?>"><span id="elh_meansofimplement_moimp_code"><?php echo $meansofimplement_search->moimp_code->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_moimp_code" id="z_moimp_code" value="=">
</span>
		</label>
		<div class="<?php echo $meansofimplement_search->RightColumnClass ?>"><div <?php echo $meansofimplement_search->moimp_code->cellAttributes() ?>>
			<span id="el_meansofimplement_moimp_code" class="ew-search-field">
<input type="text" data-table="meansofimplement" data-field="x_moimp_code" name="x_moimp_code" id="x_moimp_code" placeholder="<?php echo HtmlEncode($meansofimplement_search->moimp_code->getPlaceHolder()) ?>" value="<?php echo $meansofimplement_search->moimp_code->EditValue ?>"<?php echo $meansofimplement_search->moimp_code->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($meansofimplement_search->moimp_desc->Visible) { // moimp_desc ?>
	<div id="r_moimp_desc" class="form-group row">
		<label for="x_moimp_desc" class="<?php echo $meansofimplement_search->LeftColumnClass ?>"><span id="elh_meansofimplement_moimp_desc"><?php echo $meansofimplement_search->moimp_desc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_moimp_desc" id="z_moimp_desc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $meansofimplement_search->RightColumnClass ?>"><div <?php echo $meansofimplement_search->moimp_desc->cellAttributes() ?>>
			<span id="el_meansofimplement_moimp_desc" class="ew-search-field">
<input type="text" data-table="meansofimplement" data-field="x_moimp_desc" name="x_moimp_desc" id="x_moimp_desc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($meansofimplement_search->moimp_desc->getPlaceHolder()) ?>" value="<?php echo $meansofimplement_search->moimp_desc->EditValue ?>"<?php echo $meansofimplement_search->moimp_desc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$meansofimplement_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $meansofimplement_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$meansofimplement_search->showPageFooter();
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
$meansofimplement_search->terminate();
?>