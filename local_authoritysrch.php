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
$local_authority_search = new local_authority_search();

// Run the page
$local_authority_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$local_authority_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flocal_authoritysearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($local_authority_search->IsModal) { ?>
	flocal_authoritysearch = currentAdvancedSearchForm = new ew.Form("flocal_authoritysearch", "search");
	<?php } else { ?>
	flocal_authoritysearch = currentForm = new ew.Form("flocal_authoritysearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	flocal_authoritysearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_LACode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($local_authority_search->LACode->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	flocal_authoritysearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flocal_authoritysearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	flocal_authoritysearch.lists["x_CouncilType"] = <?php echo $local_authority_search->CouncilType->Lookup->toClientList($local_authority_search) ?>;
	flocal_authoritysearch.lists["x_CouncilType"].options = <?php echo JsonEncode($local_authority_search->CouncilType->lookupOptions()) ?>;
	flocal_authoritysearch.lists["x_ProvinceCode"] = <?php echo $local_authority_search->ProvinceCode->Lookup->toClientList($local_authority_search) ?>;
	flocal_authoritysearch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($local_authority_search->ProvinceCode->lookupOptions()) ?>;
	loadjs.done("flocal_authoritysearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $local_authority_search->showPageHeader(); ?>
<?php
$local_authority_search->showMessage();
?>
<form name="flocal_authoritysearch" id="flocal_authoritysearch" class="<?php echo $local_authority_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="local_authority">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$local_authority_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($local_authority_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $local_authority_search->LeftColumnClass ?>"><span id="elh_local_authority_LACode"><?php echo $local_authority_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="=">
</span>
		</label>
		<div class="<?php echo $local_authority_search->RightColumnClass ?>"><div <?php echo $local_authority_search->LACode->cellAttributes() ?>>
			<span id="el_local_authority_LACode" class="ew-search-field">
<input type="text" data-table="local_authority" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" placeholder="<?php echo HtmlEncode($local_authority_search->LACode->getPlaceHolder()) ?>" value="<?php echo $local_authority_search->LACode->EditValue ?>"<?php echo $local_authority_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($local_authority_search->LAName->Visible) { // LAName ?>
	<div id="r_LAName" class="form-group row">
		<label for="x_LAName" class="<?php echo $local_authority_search->LeftColumnClass ?>"><span id="elh_local_authority_LAName"><?php echo $local_authority_search->LAName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LAName" id="z_LAName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $local_authority_search->RightColumnClass ?>"><div <?php echo $local_authority_search->LAName->cellAttributes() ?>>
			<span id="el_local_authority_LAName" class="ew-search-field">
<input type="text" data-table="local_authority" data-field="x_LAName" name="x_LAName" id="x_LAName" size="40" maxlength="40" placeholder="<?php echo HtmlEncode($local_authority_search->LAName->getPlaceHolder()) ?>" value="<?php echo $local_authority_search->LAName->EditValue ?>"<?php echo $local_authority_search->LAName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($local_authority_search->CouncilType->Visible) { // CouncilType ?>
	<div id="r_CouncilType" class="form-group row">
		<label for="x_CouncilType" class="<?php echo $local_authority_search->LeftColumnClass ?>"><span id="elh_local_authority_CouncilType"><?php echo $local_authority_search->CouncilType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_CouncilType" id="z_CouncilType" value="=">
</span>
		</label>
		<div class="<?php echo $local_authority_search->RightColumnClass ?>"><div <?php echo $local_authority_search->CouncilType->cellAttributes() ?>>
			<span id="el_local_authority_CouncilType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="local_authority" data-field="x_CouncilType" data-value-separator="<?php echo $local_authority_search->CouncilType->displayValueSeparatorAttribute() ?>" id="x_CouncilType" name="x_CouncilType"<?php echo $local_authority_search->CouncilType->editAttributes() ?>>
			<?php echo $local_authority_search->CouncilType->selectOptionListHtml("x_CouncilType") ?>
		</select>
</div>
<?php echo $local_authority_search->CouncilType->Lookup->getParamTag($local_authority_search, "p_x_CouncilType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($local_authority_search->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label for="x_ProvinceCode" class="<?php echo $local_authority_search->LeftColumnClass ?>"><span id="elh_local_authority_ProvinceCode"><?php echo $local_authority_search->ProvinceCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		</label>
		<div class="<?php echo $local_authority_search->RightColumnClass ?>"><div <?php echo $local_authority_search->ProvinceCode->cellAttributes() ?>>
			<span id="el_local_authority_ProvinceCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="local_authority" data-field="x_ProvinceCode" data-value-separator="<?php echo $local_authority_search->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $local_authority_search->ProvinceCode->editAttributes() ?>>
			<?php echo $local_authority_search->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $local_authority_search->ProvinceCode->Lookup->getParamTag($local_authority_search, "p_x_ProvinceCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($local_authority_search->Mandate->Visible) { // Mandate ?>
	<div id="r_Mandate" class="form-group row">
		<label for="x_Mandate" class="<?php echo $local_authority_search->LeftColumnClass ?>"><span id="elh_local_authority_Mandate"><?php echo $local_authority_search->Mandate->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Mandate" id="z_Mandate" value="LIKE">
</span>
		</label>
		<div class="<?php echo $local_authority_search->RightColumnClass ?>"><div <?php echo $local_authority_search->Mandate->cellAttributes() ?>>
			<span id="el_local_authority_Mandate" class="ew-search-field">
<input type="text" data-table="local_authority" data-field="x_Mandate" name="x_Mandate" id="x_Mandate" size="35" placeholder="<?php echo HtmlEncode($local_authority_search->Mandate->getPlaceHolder()) ?>" value="<?php echo $local_authority_search->Mandate->EditValue ?>"<?php echo $local_authority_search->Mandate->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($local_authority_search->Strategy->Visible) { // Strategy ?>
	<div id="r_Strategy" class="form-group row">
		<label for="x_Strategy" class="<?php echo $local_authority_search->LeftColumnClass ?>"><span id="elh_local_authority_Strategy"><?php echo $local_authority_search->Strategy->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Strategy" id="z_Strategy" value="LIKE">
</span>
		</label>
		<div class="<?php echo $local_authority_search->RightColumnClass ?>"><div <?php echo $local_authority_search->Strategy->cellAttributes() ?>>
			<span id="el_local_authority_Strategy" class="ew-search-field">
<input type="text" data-table="local_authority" data-field="x_Strategy" name="x_Strategy" id="x_Strategy" size="35" maxlength="65535" placeholder="<?php echo HtmlEncode($local_authority_search->Strategy->getPlaceHolder()) ?>" value="<?php echo $local_authority_search->Strategy->EditValue ?>"<?php echo $local_authority_search->Strategy->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($local_authority_search->Clients->Visible) { // Clients ?>
	<div id="r_Clients" class="form-group row">
		<label for="x_Clients" class="<?php echo $local_authority_search->LeftColumnClass ?>"><span id="elh_local_authority_Clients"><?php echo $local_authority_search->Clients->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Clients" id="z_Clients" value="LIKE">
</span>
		</label>
		<div class="<?php echo $local_authority_search->RightColumnClass ?>"><div <?php echo $local_authority_search->Clients->cellAttributes() ?>>
			<span id="el_local_authority_Clients" class="ew-search-field">
<input type="text" data-table="local_authority" data-field="x_Clients" name="x_Clients" id="x_Clients" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_search->Clients->getPlaceHolder()) ?>" value="<?php echo $local_authority_search->Clients->EditValue ?>"<?php echo $local_authority_search->Clients->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($local_authority_search->Beneficiaries->Visible) { // Beneficiaries ?>
	<div id="r_Beneficiaries" class="form-group row">
		<label for="x_Beneficiaries" class="<?php echo $local_authority_search->LeftColumnClass ?>"><span id="elh_local_authority_Beneficiaries"><?php echo $local_authority_search->Beneficiaries->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Beneficiaries" id="z_Beneficiaries" value="LIKE">
</span>
		</label>
		<div class="<?php echo $local_authority_search->RightColumnClass ?>"><div <?php echo $local_authority_search->Beneficiaries->cellAttributes() ?>>
			<span id="el_local_authority_Beneficiaries" class="ew-search-field">
<input type="text" data-table="local_authority" data-field="x_Beneficiaries" name="x_Beneficiaries" id="x_Beneficiaries" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_search->Beneficiaries->getPlaceHolder()) ?>" value="<?php echo $local_authority_search->Beneficiaries->EditValue ?>"<?php echo $local_authority_search->Beneficiaries->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($local_authority_search->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
	<div id="r_ExecutiveAuthority" class="form-group row">
		<label for="x_ExecutiveAuthority" class="<?php echo $local_authority_search->LeftColumnClass ?>"><span id="elh_local_authority_ExecutiveAuthority"><?php echo $local_authority_search->ExecutiveAuthority->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ExecutiveAuthority" id="z_ExecutiveAuthority" value="LIKE">
</span>
		</label>
		<div class="<?php echo $local_authority_search->RightColumnClass ?>"><div <?php echo $local_authority_search->ExecutiveAuthority->cellAttributes() ?>>
			<span id="el_local_authority_ExecutiveAuthority" class="ew-search-field">
<input type="text" data-table="local_authority" data-field="x_ExecutiveAuthority" name="x_ExecutiveAuthority" id="x_ExecutiveAuthority" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_search->ExecutiveAuthority->getPlaceHolder()) ?>" value="<?php echo $local_authority_search->ExecutiveAuthority->EditValue ?>"<?php echo $local_authority_search->ExecutiveAuthority->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($local_authority_search->ControllingOfficer->Visible) { // ControllingOfficer ?>
	<div id="r_ControllingOfficer" class="form-group row">
		<label for="x_ControllingOfficer" class="<?php echo $local_authority_search->LeftColumnClass ?>"><span id="elh_local_authority_ControllingOfficer"><?php echo $local_authority_search->ControllingOfficer->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ControllingOfficer" id="z_ControllingOfficer" value="LIKE">
</span>
		</label>
		<div class="<?php echo $local_authority_search->RightColumnClass ?>"><div <?php echo $local_authority_search->ControllingOfficer->cellAttributes() ?>>
			<span id="el_local_authority_ControllingOfficer" class="ew-search-field">
<input type="text" data-table="local_authority" data-field="x_ControllingOfficer" name="x_ControllingOfficer" id="x_ControllingOfficer" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_search->ControllingOfficer->getPlaceHolder()) ?>" value="<?php echo $local_authority_search->ControllingOfficer->EditValue ?>"<?php echo $local_authority_search->ControllingOfficer->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($local_authority_search->Comment->Visible) { // Comment ?>
	<div id="r_Comment" class="form-group row">
		<label for="x_Comment" class="<?php echo $local_authority_search->LeftColumnClass ?>"><span id="elh_local_authority_Comment"><?php echo $local_authority_search->Comment->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Comment" id="z_Comment" value="LIKE">
</span>
		</label>
		<div class="<?php echo $local_authority_search->RightColumnClass ?>"><div <?php echo $local_authority_search->Comment->cellAttributes() ?>>
			<span id="el_local_authority_Comment" class="ew-search-field">
<input type="text" data-table="local_authority" data-field="x_Comment" name="x_Comment" id="x_Comment" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($local_authority_search->Comment->getPlaceHolder()) ?>" value="<?php echo $local_authority_search->Comment->EditValue ?>"<?php echo $local_authority_search->Comment->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$local_authority_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $local_authority_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$local_authority_search->showPageFooter();
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
$local_authority_search->terminate();
?>