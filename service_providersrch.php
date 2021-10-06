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
$service_provider_search = new service_provider_search();

// Run the page
$service_provider_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$service_provider_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fservice_providersearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($service_provider_search->IsModal) { ?>
	fservice_providersearch = currentAdvancedSearchForm = new ew.Form("fservice_providersearch", "search");
	<?php } else { ?>
	fservice_providersearch = currentForm = new ew.Form("fservice_providersearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fservice_providersearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ServiceProviderID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($service_provider_search->ServiceProviderID->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fservice_providersearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fservice_providersearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fservice_providersearch.lists["x_SPType"] = <?php echo $service_provider_search->SPType->Lookup->toClientList($service_provider_search) ?>;
	fservice_providersearch.lists["x_SPType"].options = <?php echo JsonEncode($service_provider_search->SPType->lookupOptions()) ?>;
	loadjs.done("fservice_providersearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $service_provider_search->showPageHeader(); ?>
<?php
$service_provider_search->showMessage();
?>
<form name="fservice_providersearch" id="fservice_providersearch" class="<?php echo $service_provider_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="service_provider">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$service_provider_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($service_provider_search->ServiceProviderID->Visible) { // ServiceProviderID ?>
	<div id="r_ServiceProviderID" class="form-group row">
		<label for="x_ServiceProviderID" class="<?php echo $service_provider_search->LeftColumnClass ?>"><span id="elh_service_provider_ServiceProviderID"><?php echo $service_provider_search->ServiceProviderID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ServiceProviderID" id="z_ServiceProviderID" value="=">
</span>
		</label>
		<div class="<?php echo $service_provider_search->RightColumnClass ?>"><div <?php echo $service_provider_search->ServiceProviderID->cellAttributes() ?>>
			<span id="el_service_provider_ServiceProviderID" class="ew-search-field">
<input type="text" data-table="service_provider" data-field="x_ServiceProviderID" name="x_ServiceProviderID" id="x_ServiceProviderID" size="30" placeholder="<?php echo HtmlEncode($service_provider_search->ServiceProviderID->getPlaceHolder()) ?>" value="<?php echo $service_provider_search->ServiceProviderID->EditValue ?>"<?php echo $service_provider_search->ServiceProviderID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($service_provider_search->SPName->Visible) { // SPName ?>
	<div id="r_SPName" class="form-group row">
		<label for="x_SPName" class="<?php echo $service_provider_search->LeftColumnClass ?>"><span id="elh_service_provider_SPName"><?php echo $service_provider_search->SPName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SPName" id="z_SPName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $service_provider_search->RightColumnClass ?>"><div <?php echo $service_provider_search->SPName->cellAttributes() ?>>
			<span id="el_service_provider_SPName" class="ew-search-field">
<input type="text" data-table="service_provider" data-field="x_SPName" name="x_SPName" id="x_SPName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($service_provider_search->SPName->getPlaceHolder()) ?>" value="<?php echo $service_provider_search->SPName->EditValue ?>"<?php echo $service_provider_search->SPName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($service_provider_search->SPType->Visible) { // SPType ?>
	<div id="r_SPType" class="form-group row">
		<label for="x_SPType" class="<?php echo $service_provider_search->LeftColumnClass ?>"><span id="elh_service_provider_SPType"><?php echo $service_provider_search->SPType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SPType" id="z_SPType" value="=">
</span>
		</label>
		<div class="<?php echo $service_provider_search->RightColumnClass ?>"><div <?php echo $service_provider_search->SPType->cellAttributes() ?>>
			<span id="el_service_provider_SPType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="service_provider" data-field="x_SPType" data-value-separator="<?php echo $service_provider_search->SPType->displayValueSeparatorAttribute() ?>" id="x_SPType" name="x_SPType"<?php echo $service_provider_search->SPType->editAttributes() ?>>
			<?php echo $service_provider_search->SPType->selectOptionListHtml("x_SPType") ?>
		</select>
</div>
<?php echo $service_provider_search->SPType->Lookup->getParamTag($service_provider_search, "p_x_SPType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$service_provider_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $service_provider_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$service_provider_search->showPageFooter();
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
$service_provider_search->terminate();
?>