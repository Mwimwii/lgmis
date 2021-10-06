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
$musers_search = new musers_search();

// Run the page
$musers_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$musers_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmuserssearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($musers_search->IsModal) { ?>
	fmuserssearch = currentAdvancedSearchForm = new ew.Form("fmuserssearch", "search");
	<?php } else { ?>
	fmuserssearch = currentForm = new ew.Form("fmuserssearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fmuserssearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_UserCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($musers_search->UserCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_EmployeeID");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($musers_search->EmployeeID->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_OrganisationLevel");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($musers_search->OrganisationLevel->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_ReportsTo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($musers_search->ReportsTo->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fmuserssearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmuserssearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmuserssearch.lists["x_ProvinceCode"] = <?php echo $musers_search->ProvinceCode->Lookup->toClientList($musers_search) ?>;
	fmuserssearch.lists["x_ProvinceCode"].options = <?php echo JsonEncode($musers_search->ProvinceCode->lookupOptions()) ?>;
	fmuserssearch.lists["x_LACode"] = <?php echo $musers_search->LACode->Lookup->toClientList($musers_search) ?>;
	fmuserssearch.lists["x_LACode"].options = <?php echo JsonEncode($musers_search->LACode->lookupOptions()) ?>;
	fmuserssearch.lists["x_Level"] = <?php echo $musers_search->Level->Lookup->toClientList($musers_search) ?>;
	fmuserssearch.lists["x_Level"].options = <?php echo JsonEncode($musers_search->Level->lookupOptions()) ?>;
	fmuserssearch.lists["x_Role"] = <?php echo $musers_search->Role->Lookup->toClientList($musers_search) ?>;
	fmuserssearch.lists["x_Role"].options = <?php echo JsonEncode($musers_search->Role->lookupOptions()) ?>;
	fmuserssearch.lists["x_Clearance"] = <?php echo $musers_search->Clearance->Lookup->toClientList($musers_search) ?>;
	fmuserssearch.lists["x_Clearance"].options = <?php echo JsonEncode($musers_search->Clearance->lookupOptions()) ?>;
	fmuserssearch.lists["x_Active"] = <?php echo $musers_search->Active->Lookup->toClientList($musers_search) ?>;
	fmuserssearch.lists["x_Active"].options = <?php echo JsonEncode($musers_search->Active->lookupOptions()) ?>;
	loadjs.done("fmuserssearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $musers_search->showPageHeader(); ?>
<?php
$musers_search->showMessage();
?>
<form name="fmuserssearch" id="fmuserssearch" class="<?php echo $musers_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="musers">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$musers_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($musers_search->UserCode->Visible) { // UserCode ?>
	<div id="r_UserCode" class="form-group row">
		<label for="x_UserCode" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_UserCode"><?php echo $musers_search->UserCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_UserCode" id="z_UserCode" value="=">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->UserCode->cellAttributes() ?>>
			<span id="el_musers_UserCode" class="ew-search-field">
<input type="text" data-table="musers" data-field="x_UserCode" name="x_UserCode" id="x_UserCode" placeholder="<?php echo HtmlEncode($musers_search->UserCode->getPlaceHolder()) ?>" value="<?php echo $musers_search->UserCode->EditValue ?>"<?php echo $musers_search->UserCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->UserName->Visible) { // UserName ?>
	<div id="r_UserName" class="form-group row">
		<label for="x_UserName" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_UserName"><?php echo $musers_search->UserName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_UserName" id="z_UserName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->UserName->cellAttributes() ?>>
			<span id="el_musers_UserName" class="ew-search-field">
<input type="text" data-table="musers" data-field="x_UserName" name="x_UserName" id="x_UserName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_search->UserName->getPlaceHolder()) ?>" value="<?php echo $musers_search->UserName->EditValue ?>"<?php echo $musers_search->UserName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label for="x_Password" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_Password"><?php echo $musers_search->Password->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Password" id="z_Password" value="LIKE">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->Password->cellAttributes() ?>>
			<span id="el_musers_Password" class="ew-search-field">
<input type="text" data-table="musers" data-field="x_Password" name="x_Password" id="x_Password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_search->Password->getPlaceHolder()) ?>" value="<?php echo $musers_search->Password->EditValue ?>"<?php echo $musers_search->Password->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label for="x_EmployeeID" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_EmployeeID"><?php echo $musers_search->EmployeeID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_EmployeeID" id="z_EmployeeID" value="=">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->EmployeeID->cellAttributes() ?>>
			<span id="el_musers_EmployeeID" class="ew-search-field">
<input type="text" data-table="musers" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($musers_search->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $musers_search->EmployeeID->EditValue ?>"<?php echo $musers_search->EmployeeID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label for="x_FirstName" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_FirstName"><?php echo $musers_search->FirstName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->FirstName->cellAttributes() ?>>
			<span id="el_musers_FirstName" class="ew-search-field">
<input type="text" data-table="musers" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_search->FirstName->getPlaceHolder()) ?>" value="<?php echo $musers_search->FirstName->EditValue ?>"<?php echo $musers_search->FirstName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->LastName->Visible) { // LastName ?>
	<div id="r_LastName" class="form-group row">
		<label for="x_LastName" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_LastName"><?php echo $musers_search->LastName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LastName" id="z_LastName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->LastName->cellAttributes() ?>>
			<span id="el_musers_LastName" class="ew-search-field">
<input type="text" data-table="musers" data-field="x_LastName" name="x_LastName" id="x_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_search->LastName->getPlaceHolder()) ?>" value="<?php echo $musers_search->LastName->EditValue ?>"<?php echo $musers_search->LastName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label for="x_ProvinceCode" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_ProvinceCode"><?php echo $musers_search->ProvinceCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProvinceCode" id="z_ProvinceCode" value="=">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->ProvinceCode->cellAttributes() ?>>
			<span id="el_musers_ProvinceCode" class="ew-search-field">
<?php $musers_search->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProvinceCode"><?php echo EmptyValue(strval($musers_search->ProvinceCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $musers_search->ProvinceCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($musers_search->ProvinceCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($musers_search->ProvinceCode->ReadOnly || $musers_search->ProvinceCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProvinceCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $musers_search->ProvinceCode->Lookup->getParamTag($musers_search, "p_x_ProvinceCode") ?>
<input type="hidden" data-table="musers" data-field="x_ProvinceCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $musers_search->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo $musers_search->ProvinceCode->AdvancedSearch->SearchValue ?>"<?php echo $musers_search->ProvinceCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_LACode"><?php echo $musers_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->LACode->cellAttributes() ?>>
			<span id="el_musers_LACode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($musers_search->LACode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $musers_search->LACode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($musers_search->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($musers_search->LACode->ReadOnly || $musers_search->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $musers_search->LACode->Lookup->getParamTag($musers_search, "p_x_LACode") ?>
<input type="hidden" data-table="musers" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $musers_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $musers_search->LACode->AdvancedSearch->SearchValue ?>"<?php echo $musers_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->Level->Visible) { // Level ?>
	<div id="r_Level" class="form-group row">
		<label for="x_Level" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_Level"><?php echo $musers_search->Level->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Level" id="z_Level" value="=">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->Level->cellAttributes() ?>>
			<span id="el_musers_Level" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Level" data-value-separator="<?php echo $musers_search->Level->displayValueSeparatorAttribute() ?>" id="x_Level" name="x_Level"<?php echo $musers_search->Level->editAttributes() ?>>
			<?php echo $musers_search->Level->selectOptionListHtml("x_Level") ?>
		</select>
</div>
<?php echo $musers_search->Level->Lookup->getParamTag($musers_search, "p_x_Level") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->Role->Visible) { // Role ?>
	<div id="r_Role" class="form-group row">
		<label for="x_Role" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_Role"><?php echo $musers_search->Role->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Role" id="z_Role" value="LIKE">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->Role->cellAttributes() ?>>
			<span id="el_musers_Role" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Role" data-value-separator="<?php echo $musers_search->Role->displayValueSeparatorAttribute() ?>" id="x_Role" name="x_Role"<?php echo $musers_search->Role->editAttributes() ?>>
			<?php echo $musers_search->Role->selectOptionListHtml("x_Role") ?>
		</select>
</div>
<?php echo $musers_search->Role->Lookup->getParamTag($musers_search, "p_x_Role") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->Clearance->Visible) { // Clearance ?>
	<div id="r_Clearance" class="form-group row">
		<label for="x_Clearance" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_Clearance"><?php echo $musers_search->Clearance->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Clearance" id="z_Clearance" value="=">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->Clearance->cellAttributes() ?>>
			<span id="el_musers_Clearance" class="ew-search-field">
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($musers_search->Clearance->EditValue)) ?>">
<?php } else { ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Clearance" data-value-separator="<?php echo $musers_search->Clearance->displayValueSeparatorAttribute() ?>" id="x_Clearance" name="x_Clearance"<?php echo $musers_search->Clearance->editAttributes() ?>>
			<?php echo $musers_search->Clearance->selectOptionListHtml("x_Clearance") ?>
		</select>
</div>
<?php echo $musers_search->Clearance->Lookup->getParamTag($musers_search, "p_x_Clearance") ?>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->OrganisationLevel->Visible) { // OrganisationLevel ?>
	<div id="r_OrganisationLevel" class="form-group row">
		<label for="x_OrganisationLevel" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_OrganisationLevel"><?php echo $musers_search->OrganisationLevel->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_OrganisationLevel" id="z_OrganisationLevel" value="=">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->OrganisationLevel->cellAttributes() ?>>
			<span id="el_musers_OrganisationLevel" class="ew-search-field">
<input type="text" data-table="musers" data-field="x_OrganisationLevel" name="x_OrganisationLevel" id="x_OrganisationLevel" size="30" placeholder="<?php echo HtmlEncode($musers_search->OrganisationLevel->getPlaceHolder()) ?>" value="<?php echo $musers_search->OrganisationLevel->EditValue ?>"<?php echo $musers_search->OrganisationLevel->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->Active->Visible) { // Active ?>
	<div id="r_Active" class="form-group row">
		<label class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_Active"><?php echo $musers_search->Active->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Active" id="z_Active" value="=">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->Active->cellAttributes() ?>>
			<span id="el_musers_Active" class="ew-search-field">
<div id="tp_x_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="musers" data-field="x_Active" data-value-separator="<?php echo $musers_search->Active->displayValueSeparatorAttribute() ?>" name="x_Active" id="x_Active" value="{value}"<?php echo $musers_search->Active->editAttributes() ?>></div>
<div id="dsl_x_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $musers_search->Active->radioButtonListHtml(FALSE, "x_Active") ?>
</div></div>
<?php echo $musers_search->Active->Lookup->getParamTag($musers_search, "p_x_Active") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label for="x__Email" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers__Email"><?php echo $musers_search->_Email->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z__Email" id="z__Email" value="LIKE">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->_Email->cellAttributes() ?>>
			<span id="el_musers__Email" class="ew-search-field">
<input type="text" data-table="musers" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_search->_Email->getPlaceHolder()) ?>" value="<?php echo $musers_search->_Email->EditValue ?>"<?php echo $musers_search->_Email->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label for="x_Telephone" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_Telephone"><?php echo $musers_search->Telephone->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Telephone" id="z_Telephone" value="LIKE">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->Telephone->cellAttributes() ?>>
			<span id="el_musers_Telephone" class="ew-search-field">
<input type="text" data-table="musers" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_search->Telephone->getPlaceHolder()) ?>" value="<?php echo $musers_search->Telephone->EditValue ?>"<?php echo $musers_search->Telephone->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label for="x_Mobile" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_Mobile"><?php echo $musers_search->Mobile->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Mobile" id="z_Mobile" value="LIKE">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->Mobile->cellAttributes() ?>>
			<span id="el_musers_Mobile" class="ew-search-field">
<input type="text" data-table="musers" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($musers_search->Mobile->getPlaceHolder()) ?>" value="<?php echo $musers_search->Mobile->EditValue ?>"<?php echo $musers_search->Mobile->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->Position->Visible) { // Position ?>
	<div id="r_Position" class="form-group row">
		<label for="x_Position" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_Position"><?php echo $musers_search->Position->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Position" id="z_Position" value="LIKE">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->Position->cellAttributes() ?>>
			<span id="el_musers_Position" class="ew-search-field">
<input type="text" data-table="musers" data-field="x_Position" name="x_Position" id="x_Position" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($musers_search->Position->getPlaceHolder()) ?>" value="<?php echo $musers_search->Position->EditValue ?>"<?php echo $musers_search->Position->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->ReportsTo->Visible) { // ReportsTo ?>
	<div id="r_ReportsTo" class="form-group row">
		<label for="x_ReportsTo" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_ReportsTo"><?php echo $musers_search->ReportsTo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ReportsTo" id="z_ReportsTo" value="=">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->ReportsTo->cellAttributes() ?>>
			<span id="el_musers_ReportsTo" class="ew-search-field">
<input type="text" data-table="musers" data-field="x_ReportsTo" name="x_ReportsTo" id="x_ReportsTo" size="30" placeholder="<?php echo HtmlEncode($musers_search->ReportsTo->getPlaceHolder()) ?>" value="<?php echo $musers_search->ReportsTo->EditValue ?>"<?php echo $musers_search->ReportsTo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($musers_search->Profile->Visible) { // Profile ?>
	<div id="r_Profile" class="form-group row">
		<label for="x_Profile" class="<?php echo $musers_search->LeftColumnClass ?>"><span id="elh_musers_Profile"><?php echo $musers_search->Profile->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Profile" id="z_Profile" value="LIKE">
</span>
		</label>
		<div class="<?php echo $musers_search->RightColumnClass ?>"><div <?php echo $musers_search->Profile->cellAttributes() ?>>
			<span id="el_musers_Profile" class="ew-search-field">
<input type="text" data-table="musers" data-field="x_Profile" name="x_Profile" id="x_Profile" size="35" placeholder="<?php echo HtmlEncode($musers_search->Profile->getPlaceHolder()) ?>" value="<?php echo $musers_search->Profile->EditValue ?>"<?php echo $musers_search->Profile->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$musers_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $musers_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$musers_search->showPageFooter();
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
$musers_search->terminate();
?>