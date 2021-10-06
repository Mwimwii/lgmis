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
$client_search = new client_search();

// Run the page
$client_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclientsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($client_search->IsModal) { ?>
	fclientsearch = currentAdvancedSearchForm = new ew.Form("fclientsearch", "search");
	<?php } else { ?>
	fclientsearch = currentForm = new ew.Form("fclientsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fclientsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ClientSerNo");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($client_search->ClientSerNo->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_PrivilegeCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($client_search->PrivilegeCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_DateOfBirth");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($client_search->DateOfBirth->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fclientsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fclientsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fclientsearch.lists["x_ClientType"] = <?php echo $client_search->ClientType->Lookup->toClientList($client_search) ?>;
	fclientsearch.lists["x_ClientType"].options = <?php echo JsonEncode($client_search->ClientType->lookupOptions()) ?>;
	fclientsearch.lists["x_IdentityType"] = <?php echo $client_search->IdentityType->Lookup->toClientList($client_search) ?>;
	fclientsearch.lists["x_IdentityType"].options = <?php echo JsonEncode($client_search->IdentityType->lookupOptions()) ?>;
	fclientsearch.lists["x_Title"] = <?php echo $client_search->Title->Lookup->toClientList($client_search) ?>;
	fclientsearch.lists["x_Title"].options = <?php echo JsonEncode($client_search->Title->lookupOptions()) ?>;
	fclientsearch.lists["x_Sex"] = <?php echo $client_search->Sex->Lookup->toClientList($client_search) ?>;
	fclientsearch.lists["x_Sex"].options = <?php echo JsonEncode($client_search->Sex->lookupOptions()) ?>;
	fclientsearch.lists["x_MaritalStatus"] = <?php echo $client_search->MaritalStatus->Lookup->toClientList($client_search) ?>;
	fclientsearch.lists["x_MaritalStatus"].options = <?php echo JsonEncode($client_search->MaritalStatus->lookupOptions()) ?>;
	fclientsearch.lists["x_RelationshipCode"] = <?php echo $client_search->RelationshipCode->Lookup->toClientList($client_search) ?>;
	fclientsearch.lists["x_RelationshipCode"].options = <?php echo JsonEncode($client_search->RelationshipCode->lookupOptions()) ?>;
	loadjs.done("fclientsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $client_search->showPageHeader(); ?>
<?php
$client_search->showMessage();
?>
<form name="fclientsearch" id="fclientsearch" class="<?php echo $client_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$client_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($client_search->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label for="x_ClientSerNo" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_ClientSerNo"><?php echo $client_search->ClientSerNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientSerNo" id="z_ClientSerNo" value="=">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->ClientSerNo->cellAttributes() ?>>
			<span id="el_client_ClientSerNo" class="ew-search-field">
<input type="text" data-table="client" data-field="x_ClientSerNo" name="x_ClientSerNo" id="x_ClientSerNo" placeholder="<?php echo HtmlEncode($client_search->ClientSerNo->getPlaceHolder()) ?>" value="<?php echo $client_search->ClientSerNo->EditValue ?>"<?php echo $client_search->ClientSerNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label for="x_ClientID" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_ClientID"><?php echo $client_search->ClientID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientID" id="z_ClientID" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->ClientID->cellAttributes() ?>>
			<span id="el_client_ClientID" class="ew-search-field">
<input type="text" data-table="client" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($client_search->ClientID->getPlaceHolder()) ?>" value="<?php echo $client_search->ClientID->EditValue ?>"<?php echo $client_search->ClientID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->ClientType->Visible) { // ClientType ?>
	<div id="r_ClientType" class="form-group row">
		<label for="x_ClientType" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_ClientType"><?php echo $client_search->ClientType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ClientType" id="z_ClientType" value="=">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->ClientType->cellAttributes() ?>>
			<span id="el_client_ClientType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_ClientType" data-value-separator="<?php echo $client_search->ClientType->displayValueSeparatorAttribute() ?>" id="x_ClientType" name="x_ClientType"<?php echo $client_search->ClientType->editAttributes() ?>>
			<?php echo $client_search->ClientType->selectOptionListHtml("x_ClientType") ?>
		</select>
</div>
<?php echo $client_search->ClientType->Lookup->getParamTag($client_search, "p_x_ClientType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->IdentityType->Visible) { // IdentityType ?>
	<div id="r_IdentityType" class="form-group row">
		<label for="x_IdentityType" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_IdentityType"><?php echo $client_search->IdentityType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_IdentityType" id="z_IdentityType" value="=">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->IdentityType->cellAttributes() ?>>
			<span id="el_client_IdentityType" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_IdentityType" data-value-separator="<?php echo $client_search->IdentityType->displayValueSeparatorAttribute() ?>" id="x_IdentityType" name="x_IdentityType"<?php echo $client_search->IdentityType->editAttributes() ?>>
			<?php echo $client_search->IdentityType->selectOptionListHtml("x_IdentityType") ?>
		</select>
</div>
<?php echo $client_search->IdentityType->Lookup->getParamTag($client_search, "p_x_IdentityType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->PrivilegeCode->Visible) { // PrivilegeCode ?>
	<div id="r_PrivilegeCode" class="form-group row">
		<label for="x_PrivilegeCode" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_PrivilegeCode"><?php echo $client_search->PrivilegeCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_PrivilegeCode" id="z_PrivilegeCode" value="=">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->PrivilegeCode->cellAttributes() ?>>
			<span id="el_client_PrivilegeCode" class="ew-search-field">
<input type="text" data-table="client" data-field="x_PrivilegeCode" name="x_PrivilegeCode" id="x_PrivilegeCode" size="30" placeholder="<?php echo HtmlEncode($client_search->PrivilegeCode->getPlaceHolder()) ?>" value="<?php echo $client_search->PrivilegeCode->EditValue ?>"<?php echo $client_search->PrivilegeCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->ClientName->Visible) { // ClientName ?>
	<div id="r_ClientName" class="form-group row">
		<label for="x_ClientName" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_ClientName"><?php echo $client_search->ClientName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ClientName" id="z_ClientName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->ClientName->cellAttributes() ?>>
			<span id="el_client_ClientName" class="ew-search-field">
<input type="text" data-table="client" data-field="x_ClientName" name="x_ClientName" id="x_ClientName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_search->ClientName->getPlaceHolder()) ?>" value="<?php echo $client_search->ClientName->EditValue ?>"<?php echo $client_search->ClientName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label for="x_Title" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_Title"><?php echo $client_search->Title->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Title" id="z_Title" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->Title->cellAttributes() ?>>
			<span id="el_client_Title" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_Title" data-value-separator="<?php echo $client_search->Title->displayValueSeparatorAttribute() ?>" id="x_Title" name="x_Title"<?php echo $client_search->Title->editAttributes() ?>>
			<?php echo $client_search->Title->selectOptionListHtml("x_Title") ?>
		</select>
</div>
<?php echo $client_search->Title->Lookup->getParamTag($client_search, "p_x_Title") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label for="x_Surname" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_Surname"><?php echo $client_search->Surname->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Surname" id="z_Surname" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->Surname->cellAttributes() ?>>
			<span id="el_client_Surname" class="ew-search-field">
<input type="text" data-table="client" data-field="x_Surname" name="x_Surname" id="x_Surname" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_search->Surname->getPlaceHolder()) ?>" value="<?php echo $client_search->Surname->EditValue ?>"<?php echo $client_search->Surname->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label for="x_FirstName" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_FirstName"><?php echo $client_search->FirstName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_FirstName" id="z_FirstName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->FirstName->cellAttributes() ?>>
			<span id="el_client_FirstName" class="ew-search-field">
<input type="text" data-table="client" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_search->FirstName->getPlaceHolder()) ?>" value="<?php echo $client_search->FirstName->EditValue ?>"<?php echo $client_search->FirstName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label for="x_MiddleName" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_MiddleName"><?php echo $client_search->MiddleName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_MiddleName" id="z_MiddleName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->MiddleName->cellAttributes() ?>>
			<span id="el_client_MiddleName" class="ew-search-field">
<input type="text" data-table="client" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($client_search->MiddleName->getPlaceHolder()) ?>" value="<?php echo $client_search->MiddleName->EditValue ?>"<?php echo $client_search->MiddleName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->Sex->Visible) { // Sex ?>
	<div id="r_Sex" class="form-group row">
		<label for="x_Sex" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_Sex"><?php echo $client_search->Sex->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Sex" id="z_Sex" value="=">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->Sex->cellAttributes() ?>>
			<span id="el_client_Sex" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_Sex" data-value-separator="<?php echo $client_search->Sex->displayValueSeparatorAttribute() ?>" id="x_Sex" name="x_Sex"<?php echo $client_search->Sex->editAttributes() ?>>
			<?php echo $client_search->Sex->selectOptionListHtml("x_Sex") ?>
		</select>
</div>
<?php echo $client_search->Sex->Lookup->getParamTag($client_search, "p_x_Sex") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->MaritalStatus->Visible) { // MaritalStatus ?>
	<div id="r_MaritalStatus" class="form-group row">
		<label for="x_MaritalStatus" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_MaritalStatus"><?php echo $client_search->MaritalStatus->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_MaritalStatus" id="z_MaritalStatus" value="=">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->MaritalStatus->cellAttributes() ?>>
			<span id="el_client_MaritalStatus" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_MaritalStatus" data-value-separator="<?php echo $client_search->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x_MaritalStatus" name="x_MaritalStatus"<?php echo $client_search->MaritalStatus->editAttributes() ?>>
			<?php echo $client_search->MaritalStatus->selectOptionListHtml("x_MaritalStatus") ?>
		</select>
</div>
<?php echo $client_search->MaritalStatus->Lookup->getParamTag($client_search, "p_x_MaritalStatus") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label for="x_DateOfBirth" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_DateOfBirth"><?php echo $client_search->DateOfBirth->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_DateOfBirth" id="z_DateOfBirth" value="=">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->DateOfBirth->cellAttributes() ?>>
			<span id="el_client_DateOfBirth" class="ew-search-field">
<input type="text" data-table="client" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" placeholder="<?php echo HtmlEncode($client_search->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $client_search->DateOfBirth->EditValue ?>"<?php echo $client_search->DateOfBirth->editAttributes() ?>>
<?php if (!$client_search->DateOfBirth->ReadOnly && !$client_search->DateOfBirth->Disabled && !isset($client_search->DateOfBirth->EditAttrs["readonly"]) && !isset($client_search->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclientsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fclientsearch", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label for="x_PostalAddress" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_PostalAddress"><?php echo $client_search->PostalAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PostalAddress" id="z_PostalAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->PostalAddress->cellAttributes() ?>>
			<span id="el_client_PostalAddress" class="ew-search-field">
<input type="text" data-table="client" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($client_search->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $client_search->PostalAddress->EditValue ?>"<?php echo $client_search->PostalAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label for="x_PhysicalAddress" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_PhysicalAddress"><?php echo $client_search->PhysicalAddress->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_PhysicalAddress" id="z_PhysicalAddress" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->PhysicalAddress->cellAttributes() ?>>
			<span id="el_client_PhysicalAddress" class="ew-search-field">
<input type="text" data-table="client" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($client_search->PhysicalAddress->getPlaceHolder()) ?>" value="<?php echo $client_search->PhysicalAddress->EditValue ?>"<?php echo $client_search->PhysicalAddress->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label for="x_TownOrVillage" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_TownOrVillage"><?php echo $client_search->TownOrVillage->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_TownOrVillage" id="z_TownOrVillage" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->TownOrVillage->cellAttributes() ?>>
			<span id="el_client_TownOrVillage" class="ew-search-field">
<input type="text" data-table="client" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_search->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $client_search->TownOrVillage->EditValue ?>"<?php echo $client_search->TownOrVillage->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label for="x_Telephone" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_Telephone"><?php echo $client_search->Telephone->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Telephone" id="z_Telephone" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->Telephone->cellAttributes() ?>>
			<span id="el_client_Telephone" class="ew-search-field">
<input type="text" data-table="client" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_search->Telephone->getPlaceHolder()) ?>" value="<?php echo $client_search->Telephone->EditValue ?>"<?php echo $client_search->Telephone->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label for="x_Mobile" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_Mobile"><?php echo $client_search->Mobile->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Mobile" id="z_Mobile" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->Mobile->cellAttributes() ?>>
			<span id="el_client_Mobile" class="ew-search-field">
<input type="text" data-table="client" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_search->Mobile->getPlaceHolder()) ?>" value="<?php echo $client_search->Mobile->EditValue ?>"<?php echo $client_search->Mobile->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label for="x_Fax" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_Fax"><?php echo $client_search->Fax->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Fax" id="z_Fax" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->Fax->cellAttributes() ?>>
			<span id="el_client_Fax" class="ew-search-field">
<input type="text" data-table="client" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($client_search->Fax->getPlaceHolder()) ?>" value="<?php echo $client_search->Fax->EditValue ?>"<?php echo $client_search->Fax->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label for="x__Email" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client__Email"><?php echo $client_search->_Email->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z__Email" id="z__Email" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->_Email->cellAttributes() ?>>
			<span id="el_client__Email" class="ew-search-field">
<input type="text" data-table="client" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_search->_Email->getPlaceHolder()) ?>" value="<?php echo $client_search->_Email->EditValue ?>"<?php echo $client_search->_Email->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->NextOfKin->Visible) { // NextOfKin ?>
	<div id="r_NextOfKin" class="form-group row">
		<label for="x_NextOfKin" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_NextOfKin"><?php echo $client_search->NextOfKin->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NextOfKin" id="z_NextOfKin" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->NextOfKin->cellAttributes() ?>>
			<span id="el_client_NextOfKin" class="ew-search-field">
<input type="text" data-table="client" data-field="x_NextOfKin" name="x_NextOfKin" id="x_NextOfKin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_search->NextOfKin->getPlaceHolder()) ?>" value="<?php echo $client_search->NextOfKin->EditValue ?>"<?php echo $client_search->NextOfKin->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->RelationshipCode->Visible) { // RelationshipCode ?>
	<div id="r_RelationshipCode" class="form-group row">
		<label for="x_RelationshipCode" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_RelationshipCode"><?php echo $client_search->RelationshipCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_RelationshipCode" id="z_RelationshipCode" value="=">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->RelationshipCode->cellAttributes() ?>>
			<span id="el_client_RelationshipCode" class="ew-search-field">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_RelationshipCode" data-value-separator="<?php echo $client_search->RelationshipCode->displayValueSeparatorAttribute() ?>" id="x_RelationshipCode" name="x_RelationshipCode"<?php echo $client_search->RelationshipCode->editAttributes() ?>>
			<?php echo $client_search->RelationshipCode->selectOptionListHtml("x_RelationshipCode") ?>
		</select>
</div>
<?php echo $client_search->RelationshipCode->Lookup->getParamTag($client_search, "p_x_RelationshipCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<div id="r_NextOfKinMobile" class="form-group row">
		<label for="x_NextOfKinMobile" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_NextOfKinMobile"><?php echo $client_search->NextOfKinMobile->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NextOfKinMobile" id="z_NextOfKinMobile" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->NextOfKinMobile->cellAttributes() ?>>
			<span id="el_client_NextOfKinMobile" class="ew-search-field">
<input type="text" data-table="client" data-field="x_NextOfKinMobile" name="x_NextOfKinMobile" id="x_NextOfKinMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_search->NextOfKinMobile->getPlaceHolder()) ?>" value="<?php echo $client_search->NextOfKinMobile->EditValue ?>"<?php echo $client_search->NextOfKinMobile->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<div id="r_NextOfKinEmail" class="form-group row">
		<label for="x_NextOfKinEmail" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_NextOfKinEmail"><?php echo $client_search->NextOfKinEmail->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_NextOfKinEmail" id="z_NextOfKinEmail" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->NextOfKinEmail->cellAttributes() ?>>
			<span id="el_client_NextOfKinEmail" class="ew-search-field">
<input type="text" data-table="client" data-field="x_NextOfKinEmail" name="x_NextOfKinEmail" id="x_NextOfKinEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_search->NextOfKinEmail->getPlaceHolder()) ?>" value="<?php echo $client_search->NextOfKinEmail->EditValue ?>"<?php echo $client_search->NextOfKinEmail->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($client_search->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<div id="r_AdditionalInformation" class="form-group row">
		<label for="x_AdditionalInformation" class="<?php echo $client_search->LeftColumnClass ?>"><span id="elh_client_AdditionalInformation"><?php echo $client_search->AdditionalInformation->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AdditionalInformation" id="z_AdditionalInformation" value="LIKE">
</span>
		</label>
		<div class="<?php echo $client_search->RightColumnClass ?>"><div <?php echo $client_search->AdditionalInformation->cellAttributes() ?>>
			<span id="el_client_AdditionalInformation" class="ew-search-field">
<input type="text" data-table="client" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" size="35" placeholder="<?php echo HtmlEncode($client_search->AdditionalInformation->getPlaceHolder()) ?>" value="<?php echo $client_search->AdditionalInformation->EditValue ?>"<?php echo $client_search->AdditionalInformation->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$client_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $client_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$client_search->showPageFooter();
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
$client_search->terminate();
?>