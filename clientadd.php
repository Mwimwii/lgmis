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
$client_add = new client_add();

// Run the page
$client_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclientadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fclientadd = currentForm = new ew.Form("fclientadd", "add");

	// Validate form
	fclientadd.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($client_add->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->ClientID->caption(), $client_add->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->ClientType->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->ClientType->caption(), $client_add->ClientType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->IdentityType->Required) { ?>
				elm = this.getElements("x" + infix + "_IdentityType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->IdentityType->caption(), $client_add->IdentityType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->PrivilegeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PrivilegeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->PrivilegeCode->caption(), $client_add->PrivilegeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PrivilegeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_add->PrivilegeCode->errorMessage()) ?>");
			<?php if ($client_add->ClientName->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->ClientName->caption(), $client_add->ClientName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->Title->Required) { ?>
				elm = this.getElements("x" + infix + "_Title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->Title->caption(), $client_add->Title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->Surname->caption(), $client_add->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->FirstName->caption(), $client_add->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->MiddleName->caption(), $client_add->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->Sex->caption(), $client_add->Sex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->MaritalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MaritalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->MaritalStatus->caption(), $client_add->MaritalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->DateOfBirth->caption(), $client_add->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_add->DateOfBirth->errorMessage()) ?>");
			<?php if ($client_add->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->PostalAddress->caption(), $client_add->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->PhysicalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->PhysicalAddress->caption(), $client_add->PhysicalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->TownOrVillage->Required) { ?>
				elm = this.getElements("x" + infix + "_TownOrVillage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->TownOrVillage->caption(), $client_add->TownOrVillage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->Telephone->caption(), $client_add->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->Mobile->caption(), $client_add->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->Fax->caption(), $client_add->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->_Email->caption(), $client_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_add->_Email->errorMessage()) ?>");
			<?php if ($client_add->NextOfKin->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->NextOfKin->caption(), $client_add->NextOfKin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->RelationshipCode->Required) { ?>
				elm = this.getElements("x" + infix + "_RelationshipCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->RelationshipCode->caption(), $client_add->RelationshipCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->NextOfKinMobile->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinMobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->NextOfKinMobile->caption(), $client_add->NextOfKinMobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_add->NextOfKinEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->NextOfKinEmail->caption(), $client_add->NextOfKinEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NextOfKinEmail");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_add->NextOfKinEmail->errorMessage()) ?>");
			<?php if ($client_add->AdditionalInformation->Required) { ?>
				elm = this.getElements("x" + infix + "_AdditionalInformation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_add->AdditionalInformation->caption(), $client_add->AdditionalInformation->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fclientadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fclientadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fclientadd.lists["x_ClientType"] = <?php echo $client_add->ClientType->Lookup->toClientList($client_add) ?>;
	fclientadd.lists["x_ClientType"].options = <?php echo JsonEncode($client_add->ClientType->lookupOptions()) ?>;
	fclientadd.lists["x_IdentityType"] = <?php echo $client_add->IdentityType->Lookup->toClientList($client_add) ?>;
	fclientadd.lists["x_IdentityType"].options = <?php echo JsonEncode($client_add->IdentityType->lookupOptions()) ?>;
	fclientadd.lists["x_Title"] = <?php echo $client_add->Title->Lookup->toClientList($client_add) ?>;
	fclientadd.lists["x_Title"].options = <?php echo JsonEncode($client_add->Title->lookupOptions()) ?>;
	fclientadd.lists["x_Sex"] = <?php echo $client_add->Sex->Lookup->toClientList($client_add) ?>;
	fclientadd.lists["x_Sex"].options = <?php echo JsonEncode($client_add->Sex->lookupOptions()) ?>;
	fclientadd.lists["x_MaritalStatus"] = <?php echo $client_add->MaritalStatus->Lookup->toClientList($client_add) ?>;
	fclientadd.lists["x_MaritalStatus"].options = <?php echo JsonEncode($client_add->MaritalStatus->lookupOptions()) ?>;
	fclientadd.lists["x_RelationshipCode"] = <?php echo $client_add->RelationshipCode->Lookup->toClientList($client_add) ?>;
	fclientadd.lists["x_RelationshipCode"].options = <?php echo JsonEncode($client_add->RelationshipCode->lookupOptions()) ?>;
	loadjs.done("fclientadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $client_add->showPageHeader(); ?>
<?php
$client_add->showMessage();
?>
<form name="fclientadd" id="fclientadd" class="<?php echo $client_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$client_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($client_add->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_client_ClientID" for="x_ClientID" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->ClientID->caption() ?><?php echo $client_add->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->ClientID->cellAttributes() ?>>
<span id="el_client_ClientID">
<input type="text" data-table="client" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($client_add->ClientID->getPlaceHolder()) ?>" value="<?php echo $client_add->ClientID->EditValue ?>"<?php echo $client_add->ClientID->editAttributes() ?>>
</span>
<?php echo $client_add->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->ClientType->Visible) { // ClientType ?>
	<div id="r_ClientType" class="form-group row">
		<label id="elh_client_ClientType" for="x_ClientType" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->ClientType->caption() ?><?php echo $client_add->ClientType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->ClientType->cellAttributes() ?>>
<span id="el_client_ClientType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_ClientType" data-value-separator="<?php echo $client_add->ClientType->displayValueSeparatorAttribute() ?>" id="x_ClientType" name="x_ClientType"<?php echo $client_add->ClientType->editAttributes() ?>>
			<?php echo $client_add->ClientType->selectOptionListHtml("x_ClientType") ?>
		</select>
</div>
<?php echo $client_add->ClientType->Lookup->getParamTag($client_add, "p_x_ClientType") ?>
</span>
<?php echo $client_add->ClientType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->IdentityType->Visible) { // IdentityType ?>
	<div id="r_IdentityType" class="form-group row">
		<label id="elh_client_IdentityType" for="x_IdentityType" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->IdentityType->caption() ?><?php echo $client_add->IdentityType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->IdentityType->cellAttributes() ?>>
<span id="el_client_IdentityType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_IdentityType" data-value-separator="<?php echo $client_add->IdentityType->displayValueSeparatorAttribute() ?>" id="x_IdentityType" name="x_IdentityType"<?php echo $client_add->IdentityType->editAttributes() ?>>
			<?php echo $client_add->IdentityType->selectOptionListHtml("x_IdentityType") ?>
		</select>
</div>
<?php echo $client_add->IdentityType->Lookup->getParamTag($client_add, "p_x_IdentityType") ?>
</span>
<?php echo $client_add->IdentityType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->PrivilegeCode->Visible) { // PrivilegeCode ?>
	<div id="r_PrivilegeCode" class="form-group row">
		<label id="elh_client_PrivilegeCode" for="x_PrivilegeCode" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->PrivilegeCode->caption() ?><?php echo $client_add->PrivilegeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->PrivilegeCode->cellAttributes() ?>>
<span id="el_client_PrivilegeCode">
<input type="text" data-table="client" data-field="x_PrivilegeCode" name="x_PrivilegeCode" id="x_PrivilegeCode" size="30" placeholder="<?php echo HtmlEncode($client_add->PrivilegeCode->getPlaceHolder()) ?>" value="<?php echo $client_add->PrivilegeCode->EditValue ?>"<?php echo $client_add->PrivilegeCode->editAttributes() ?>>
</span>
<?php echo $client_add->PrivilegeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->ClientName->Visible) { // ClientName ?>
	<div id="r_ClientName" class="form-group row">
		<label id="elh_client_ClientName" for="x_ClientName" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->ClientName->caption() ?><?php echo $client_add->ClientName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->ClientName->cellAttributes() ?>>
<span id="el_client_ClientName">
<input type="text" data-table="client" data-field="x_ClientName" name="x_ClientName" id="x_ClientName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->ClientName->getPlaceHolder()) ?>" value="<?php echo $client_add->ClientName->EditValue ?>"<?php echo $client_add->ClientName->editAttributes() ?>>
</span>
<?php echo $client_add->ClientName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label id="elh_client_Title" for="x_Title" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->Title->caption() ?><?php echo $client_add->Title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->Title->cellAttributes() ?>>
<span id="el_client_Title">
<?php $client_add->Title->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_Title" data-value-separator="<?php echo $client_add->Title->displayValueSeparatorAttribute() ?>" id="x_Title" name="x_Title"<?php echo $client_add->Title->editAttributes() ?>>
			<?php echo $client_add->Title->selectOptionListHtml("x_Title") ?>
		</select>
</div>
<?php echo $client_add->Title->Lookup->getParamTag($client_add, "p_x_Title") ?>
</span>
<?php echo $client_add->Title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label id="elh_client_Surname" for="x_Surname" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->Surname->caption() ?><?php echo $client_add->Surname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->Surname->cellAttributes() ?>>
<span id="el_client_Surname">
<input type="text" data-table="client" data-field="x_Surname" name="x_Surname" id="x_Surname" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->Surname->getPlaceHolder()) ?>" value="<?php echo $client_add->Surname->EditValue ?>"<?php echo $client_add->Surname->editAttributes() ?>>
</span>
<?php echo $client_add->Surname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_client_FirstName" for="x_FirstName" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->FirstName->caption() ?><?php echo $client_add->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->FirstName->cellAttributes() ?>>
<span id="el_client_FirstName">
<input type="text" data-table="client" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->FirstName->getPlaceHolder()) ?>" value="<?php echo $client_add->FirstName->EditValue ?>"<?php echo $client_add->FirstName->editAttributes() ?>>
</span>
<?php echo $client_add->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label id="elh_client_MiddleName" for="x_MiddleName" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->MiddleName->caption() ?><?php echo $client_add->MiddleName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->MiddleName->cellAttributes() ?>>
<span id="el_client_MiddleName">
<input type="text" data-table="client" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($client_add->MiddleName->getPlaceHolder()) ?>" value="<?php echo $client_add->MiddleName->EditValue ?>"<?php echo $client_add->MiddleName->editAttributes() ?>>
</span>
<?php echo $client_add->MiddleName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->Sex->Visible) { // Sex ?>
	<div id="r_Sex" class="form-group row">
		<label id="elh_client_Sex" for="x_Sex" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->Sex->caption() ?><?php echo $client_add->Sex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->Sex->cellAttributes() ?>>
<span id="el_client_Sex">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_Sex" data-value-separator="<?php echo $client_add->Sex->displayValueSeparatorAttribute() ?>" id="x_Sex" name="x_Sex"<?php echo $client_add->Sex->editAttributes() ?>>
			<?php echo $client_add->Sex->selectOptionListHtml("x_Sex") ?>
		</select>
</div>
<?php echo $client_add->Sex->Lookup->getParamTag($client_add, "p_x_Sex") ?>
</span>
<?php echo $client_add->Sex->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->MaritalStatus->Visible) { // MaritalStatus ?>
	<div id="r_MaritalStatus" class="form-group row">
		<label id="elh_client_MaritalStatus" for="x_MaritalStatus" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->MaritalStatus->caption() ?><?php echo $client_add->MaritalStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->MaritalStatus->cellAttributes() ?>>
<span id="el_client_MaritalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_MaritalStatus" data-value-separator="<?php echo $client_add->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x_MaritalStatus" name="x_MaritalStatus"<?php echo $client_add->MaritalStatus->editAttributes() ?>>
			<?php echo $client_add->MaritalStatus->selectOptionListHtml("x_MaritalStatus") ?>
		</select>
</div>
<?php echo $client_add->MaritalStatus->Lookup->getParamTag($client_add, "p_x_MaritalStatus") ?>
</span>
<?php echo $client_add->MaritalStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label id="elh_client_DateOfBirth" for="x_DateOfBirth" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->DateOfBirth->caption() ?><?php echo $client_add->DateOfBirth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->DateOfBirth->cellAttributes() ?>>
<span id="el_client_DateOfBirth">
<input type="text" data-table="client" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" placeholder="<?php echo HtmlEncode($client_add->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $client_add->DateOfBirth->EditValue ?>"<?php echo $client_add->DateOfBirth->editAttributes() ?>>
<?php if (!$client_add->DateOfBirth->ReadOnly && !$client_add->DateOfBirth->Disabled && !isset($client_add->DateOfBirth->EditAttrs["readonly"]) && !isset($client_add->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclientadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fclientadd", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $client_add->DateOfBirth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label id="elh_client_PostalAddress" for="x_PostalAddress" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->PostalAddress->caption() ?><?php echo $client_add->PostalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->PostalAddress->cellAttributes() ?>>
<span id="el_client_PostalAddress">
<textarea data-table="client" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" cols="35" rows="4" placeholder="<?php echo HtmlEncode($client_add->PostalAddress->getPlaceHolder()) ?>"<?php echo $client_add->PostalAddress->editAttributes() ?>><?php echo $client_add->PostalAddress->EditValue ?></textarea>
</span>
<?php echo $client_add->PostalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label id="elh_client_PhysicalAddress" for="x_PhysicalAddress" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->PhysicalAddress->caption() ?><?php echo $client_add->PhysicalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->PhysicalAddress->cellAttributes() ?>>
<span id="el_client_PhysicalAddress">
<textarea data-table="client" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" cols="35" rows="4" placeholder="<?php echo HtmlEncode($client_add->PhysicalAddress->getPlaceHolder()) ?>"<?php echo $client_add->PhysicalAddress->editAttributes() ?>><?php echo $client_add->PhysicalAddress->EditValue ?></textarea>
</span>
<?php echo $client_add->PhysicalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label id="elh_client_TownOrVillage" for="x_TownOrVillage" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->TownOrVillage->caption() ?><?php echo $client_add->TownOrVillage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->TownOrVillage->cellAttributes() ?>>
<span id="el_client_TownOrVillage">
<input type="text" data-table="client" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $client_add->TownOrVillage->EditValue ?>"<?php echo $client_add->TownOrVillage->editAttributes() ?>>
</span>
<?php echo $client_add->TownOrVillage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_client_Telephone" for="x_Telephone" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->Telephone->caption() ?><?php echo $client_add->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->Telephone->cellAttributes() ?>>
<span id="el_client_Telephone">
<input type="text" data-table="client" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->Telephone->getPlaceHolder()) ?>" value="<?php echo $client_add->Telephone->EditValue ?>"<?php echo $client_add->Telephone->editAttributes() ?>>
</span>
<?php echo $client_add->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_client_Mobile" for="x_Mobile" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->Mobile->caption() ?><?php echo $client_add->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->Mobile->cellAttributes() ?>>
<span id="el_client_Mobile">
<input type="text" data-table="client" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->Mobile->getPlaceHolder()) ?>" value="<?php echo $client_add->Mobile->EditValue ?>"<?php echo $client_add->Mobile->editAttributes() ?>>
</span>
<?php echo $client_add->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_client_Fax" for="x_Fax" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->Fax->caption() ?><?php echo $client_add->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->Fax->cellAttributes() ?>>
<span id="el_client_Fax">
<input type="text" data-table="client" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($client_add->Fax->getPlaceHolder()) ?>" value="<?php echo $client_add->Fax->EditValue ?>"<?php echo $client_add->Fax->editAttributes() ?>>
</span>
<?php echo $client_add->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_client__Email" for="x__Email" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->_Email->caption() ?><?php echo $client_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->_Email->cellAttributes() ?>>
<span id="el_client__Email">
<input type="text" data-table="client" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->_Email->getPlaceHolder()) ?>" value="<?php echo $client_add->_Email->EditValue ?>"<?php echo $client_add->_Email->editAttributes() ?>>
</span>
<?php echo $client_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->NextOfKin->Visible) { // NextOfKin ?>
	<div id="r_NextOfKin" class="form-group row">
		<label id="elh_client_NextOfKin" for="x_NextOfKin" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->NextOfKin->caption() ?><?php echo $client_add->NextOfKin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->NextOfKin->cellAttributes() ?>>
<span id="el_client_NextOfKin">
<input type="text" data-table="client" data-field="x_NextOfKin" name="x_NextOfKin" id="x_NextOfKin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->NextOfKin->getPlaceHolder()) ?>" value="<?php echo $client_add->NextOfKin->EditValue ?>"<?php echo $client_add->NextOfKin->editAttributes() ?>>
</span>
<?php echo $client_add->NextOfKin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->RelationshipCode->Visible) { // RelationshipCode ?>
	<div id="r_RelationshipCode" class="form-group row">
		<label id="elh_client_RelationshipCode" for="x_RelationshipCode" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->RelationshipCode->caption() ?><?php echo $client_add->RelationshipCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->RelationshipCode->cellAttributes() ?>>
<span id="el_client_RelationshipCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_RelationshipCode" data-value-separator="<?php echo $client_add->RelationshipCode->displayValueSeparatorAttribute() ?>" id="x_RelationshipCode" name="x_RelationshipCode"<?php echo $client_add->RelationshipCode->editAttributes() ?>>
			<?php echo $client_add->RelationshipCode->selectOptionListHtml("x_RelationshipCode") ?>
		</select>
</div>
<?php echo $client_add->RelationshipCode->Lookup->getParamTag($client_add, "p_x_RelationshipCode") ?>
</span>
<?php echo $client_add->RelationshipCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<div id="r_NextOfKinMobile" class="form-group row">
		<label id="elh_client_NextOfKinMobile" for="x_NextOfKinMobile" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->NextOfKinMobile->caption() ?><?php echo $client_add->NextOfKinMobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->NextOfKinMobile->cellAttributes() ?>>
<span id="el_client_NextOfKinMobile">
<input type="text" data-table="client" data-field="x_NextOfKinMobile" name="x_NextOfKinMobile" id="x_NextOfKinMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->NextOfKinMobile->getPlaceHolder()) ?>" value="<?php echo $client_add->NextOfKinMobile->EditValue ?>"<?php echo $client_add->NextOfKinMobile->editAttributes() ?>>
</span>
<?php echo $client_add->NextOfKinMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<div id="r_NextOfKinEmail" class="form-group row">
		<label id="elh_client_NextOfKinEmail" for="x_NextOfKinEmail" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->NextOfKinEmail->caption() ?><?php echo $client_add->NextOfKinEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->NextOfKinEmail->cellAttributes() ?>>
<span id="el_client_NextOfKinEmail">
<input type="text" data-table="client" data-field="x_NextOfKinEmail" name="x_NextOfKinEmail" id="x_NextOfKinEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_add->NextOfKinEmail->getPlaceHolder()) ?>" value="<?php echo $client_add->NextOfKinEmail->EditValue ?>"<?php echo $client_add->NextOfKinEmail->editAttributes() ?>>
</span>
<?php echo $client_add->NextOfKinEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_add->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<div id="r_AdditionalInformation" class="form-group row">
		<label id="elh_client_AdditionalInformation" for="x_AdditionalInformation" class="<?php echo $client_add->LeftColumnClass ?>"><?php echo $client_add->AdditionalInformation->caption() ?><?php echo $client_add->AdditionalInformation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_add->RightColumnClass ?>"><div <?php echo $client_add->AdditionalInformation->cellAttributes() ?>>
<span id="el_client_AdditionalInformation">
<textarea data-table="client" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" cols="35" rows="4" placeholder="<?php echo HtmlEncode($client_add->AdditionalInformation->getPlaceHolder()) ?>"<?php echo $client_add->AdditionalInformation->editAttributes() ?>><?php echo $client_add->AdditionalInformation->EditValue ?></textarea>
</span>
<?php echo $client_add->AdditionalInformation->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($client->getCurrentDetailTable() != "") { ?>
<?php
	$client_add->DetailPages->ValidKeys = explode(",", $client->getCurrentDetailTable());
	$firstActiveDetailTable = $client_add->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="client_add_details"><!-- tabs -->
	<ul class="<?php echo $client_add->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("property", explode(",", $client->getCurrentDetailTable())) && $property->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property") {
			$firstActiveDetailTable = "property";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $client_add->DetailPages->pageStyle("property") ?>" href="#tab_property" data-toggle="tab"><?php echo $Language->tablePhrase("property", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("bill_board", explode(",", $client->getCurrentDetailTable())) && $bill_board->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "bill_board") {
			$firstActiveDetailTable = "bill_board";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $client_add->DetailPages->pageStyle("bill_board") ?>" href="#tab_bill_board" data-toggle="tab"><?php echo $Language->tablePhrase("bill_board", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("property_lookup_view", explode(",", $client->getCurrentDetailTable())) && $property_lookup_view->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property_lookup_view") {
			$firstActiveDetailTable = "property_lookup_view";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $client_add->DetailPages->pageStyle("property_lookup_view") ?>" href="#tab_property_lookup_view" data-toggle="tab"><?php echo $Language->tablePhrase("property_lookup_view", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("property", explode(",", $client->getCurrentDetailTable())) && $property->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property")
			$firstActiveDetailTable = "property";
?>
		<div class="tab-pane <?php echo $client_add->DetailPages->pageStyle("property") ?>" id="tab_property"><!-- page* -->
<?php include_once "propertygrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("bill_board", explode(",", $client->getCurrentDetailTable())) && $bill_board->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "bill_board")
			$firstActiveDetailTable = "bill_board";
?>
		<div class="tab-pane <?php echo $client_add->DetailPages->pageStyle("bill_board") ?>" id="tab_bill_board"><!-- page* -->
<?php include_once "bill_boardgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("property_lookup_view", explode(",", $client->getCurrentDetailTable())) && $property_lookup_view->DetailAdd) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property_lookup_view")
			$firstActiveDetailTable = "property_lookup_view";
?>
		<div class="tab-pane <?php echo $client_add->DetailPages->pageStyle("property_lookup_view") ?>" id="tab_property_lookup_view"><!-- page* -->
<?php include_once "property_lookup_viewgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$client_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $client_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $client_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$client_add->showPageFooter();
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
$client_add->terminate();
?>