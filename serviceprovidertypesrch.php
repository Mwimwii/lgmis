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
$serviceprovidertype_search = new serviceprovidertype_search();

// Run the page
$serviceprovidertype_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$serviceprovidertype_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fserviceprovidertypesearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($serviceprovidertype_search->IsModal) { ?>
	fserviceprovidertypesearch = currentAdvancedSearchForm = new ew.Form("fserviceprovidertypesearch", "search");
	<?php } else { ?>
	fserviceprovidertypesearch = currentForm = new ew.Form("fserviceprovidertypesearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fserviceprovidertypesearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ServiceProviderType");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($serviceprovidertype_search->ServiceProviderType->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fserviceprovidertypesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fserviceprovidertypesearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fserviceprovidertypesearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $serviceprovidertype_search->showPageHeader(); ?>
<?php
$serviceprovidertype_search->showMessage();
?>
<form name="fserviceprovidertypesearch" id="fserviceprovidertypesearch" class="<?php echo $serviceprovidertype_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="serviceprovidertype">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$serviceprovidertype_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($serviceprovidertype_search->ServiceProviderType->Visible) { // ServiceProviderType ?>
	<div id="r_ServiceProviderType" class="form-group row">
		<label for="x_ServiceProviderType" class="<?php echo $serviceprovidertype_search->LeftColumnClass ?>"><span id="elh_serviceprovidertype_ServiceProviderType"><?php echo $serviceprovidertype_search->ServiceProviderType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ServiceProviderType" id="z_ServiceProviderType" value="=">
</span>
		</label>
		<div class="<?php echo $serviceprovidertype_search->RightColumnClass ?>"><div <?php echo $serviceprovidertype_search->ServiceProviderType->cellAttributes() ?>>
			<span id="el_serviceprovidertype_ServiceProviderType" class="ew-search-field">
<input type="text" data-table="serviceprovidertype" data-field="x_ServiceProviderType" name="x_ServiceProviderType" id="x_ServiceProviderType" placeholder="<?php echo HtmlEncode($serviceprovidertype_search->ServiceProviderType->getPlaceHolder()) ?>" value="<?php echo $serviceprovidertype_search->ServiceProviderType->EditValue ?>"<?php echo $serviceprovidertype_search->ServiceProviderType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($serviceprovidertype_search->SPTypeDesc->Visible) { // SPTypeDesc ?>
	<div id="r_SPTypeDesc" class="form-group row">
		<label for="x_SPTypeDesc" class="<?php echo $serviceprovidertype_search->LeftColumnClass ?>"><span id="elh_serviceprovidertype_SPTypeDesc"><?php echo $serviceprovidertype_search->SPTypeDesc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SPTypeDesc" id="z_SPTypeDesc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $serviceprovidertype_search->RightColumnClass ?>"><div <?php echo $serviceprovidertype_search->SPTypeDesc->cellAttributes() ?>>
			<span id="el_serviceprovidertype_SPTypeDesc" class="ew-search-field">
<input type="text" data-table="serviceprovidertype" data-field="x_SPTypeDesc" name="x_SPTypeDesc" id="x_SPTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($serviceprovidertype_search->SPTypeDesc->getPlaceHolder()) ?>" value="<?php echo $serviceprovidertype_search->SPTypeDesc->EditValue ?>"<?php echo $serviceprovidertype_search->SPTypeDesc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$serviceprovidertype_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $serviceprovidertype_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$serviceprovidertype_search->showPageFooter();
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
$serviceprovidertype_search->terminate();
?>