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
$pillars_search = new pillars_search();

// Run the page
$pillars_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pillars_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpillarssearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($pillars_search->IsModal) { ?>
	fpillarssearch = currentAdvancedSearchForm = new ew.Form("fpillarssearch", "search");
	<?php } else { ?>
	fpillarssearch = currentForm = new ew.Form("fpillarssearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fpillarssearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_NDP");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($pillars_search->NDP->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PillarNo");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($pillars_search->PillarNo->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fpillarssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpillarssearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpillarssearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pillars_search->showPageHeader(); ?>
<?php
$pillars_search->showMessage();
?>
<form name="fpillarssearch" id="fpillarssearch" class="<?php echo $pillars_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pillars">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$pillars_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($pillars_search->NDP->Visible) { // NDP ?>
	<div id="r_NDP" class="form-group row">
		<label for="x_NDP" class="<?php echo $pillars_search->LeftColumnClass ?>"><span id="elh_pillars_NDP"><?php echo $pillars_search->NDP->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_NDP" id="z_NDP" value="=">
</span>
		</label>
		<div class="<?php echo $pillars_search->RightColumnClass ?>"><div <?php echo $pillars_search->NDP->cellAttributes() ?>>
			<span id="el_pillars_NDP" class="ew-search-field">
<input type="text" data-table="pillars" data-field="x_NDP" name="x_NDP" id="x_NDP" size="30" placeholder="<?php echo HtmlEncode($pillars_search->NDP->getPlaceHolder()) ?>" value="<?php echo $pillars_search->NDP->EditValue ?>"<?php echo $pillars_search->NDP->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pillars_search->PillarNo->Visible) { // PillarNo ?>
	<div id="r_PillarNo" class="form-group row">
		<label for="x_PillarNo" class="<?php echo $pillars_search->LeftColumnClass ?>"><span id="elh_pillars_PillarNo"><?php echo $pillars_search->PillarNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PillarNo" id="z_PillarNo" value="=">
</span>
		</label>
		<div class="<?php echo $pillars_search->RightColumnClass ?>"><div <?php echo $pillars_search->PillarNo->cellAttributes() ?>>
			<span id="el_pillars_PillarNo" class="ew-search-field">
<input type="text" data-table="pillars" data-field="x_PillarNo" name="x_PillarNo" id="x_PillarNo" size="30" placeholder="<?php echo HtmlEncode($pillars_search->PillarNo->getPlaceHolder()) ?>" value="<?php echo $pillars_search->PillarNo->EditValue ?>"<?php echo $pillars_search->PillarNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pillars_search->PillarName->Visible) { // PillarName ?>
	<div id="r_PillarName" class="form-group row">
		<label for="x_PillarName" class="<?php echo $pillars_search->LeftColumnClass ?>"><span id="elh_pillars_PillarName"><?php echo $pillars_search->PillarName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PillarName" id="z_PillarName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $pillars_search->RightColumnClass ?>"><div <?php echo $pillars_search->PillarName->cellAttributes() ?>>
			<span id="el_pillars_PillarName" class="ew-search-field">
<input type="text" data-table="pillars" data-field="x_PillarName" name="x_PillarName" id="x_PillarName" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($pillars_search->PillarName->getPlaceHolder()) ?>" value="<?php echo $pillars_search->PillarName->EditValue ?>"<?php echo $pillars_search->PillarName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($pillars_search->PillarObjective->Visible) { // PillarObjective ?>
	<div id="r_PillarObjective" class="form-group row">
		<label for="x_PillarObjective" class="<?php echo $pillars_search->LeftColumnClass ?>"><span id="elh_pillars_PillarObjective"><?php echo $pillars_search->PillarObjective->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PillarObjective" id="z_PillarObjective" value="LIKE">
</span>
		</label>
		<div class="<?php echo $pillars_search->RightColumnClass ?>"><div <?php echo $pillars_search->PillarObjective->cellAttributes() ?>>
			<span id="el_pillars_PillarObjective" class="ew-search-field">
<input type="text" data-table="pillars" data-field="x_PillarObjective" name="x_PillarObjective" id="x_PillarObjective" size="35" maxlength="400" placeholder="<?php echo HtmlEncode($pillars_search->PillarObjective->getPlaceHolder()) ?>" value="<?php echo $pillars_search->PillarObjective->EditValue ?>"<?php echo $pillars_search->PillarObjective->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pillars_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pillars_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pillars_search->showPageFooter();
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
$pillars_search->terminate();
?>