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
$client_edit = new client_edit();

// Run the page
$client_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclientedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fclientedit = currentForm = new ew.Form("fclientedit", "edit");

	// Validate form
	fclientedit.validate = function() {
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
			<?php if ($client_edit->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->ClientSerNo->caption(), $client_edit->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->ClientID->caption(), $client_edit->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->ClientType->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->ClientType->caption(), $client_edit->ClientType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->IdentityType->Required) { ?>
				elm = this.getElements("x" + infix + "_IdentityType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->IdentityType->caption(), $client_edit->IdentityType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->PrivilegeCode->Required) { ?>
				elm = this.getElements("x" + infix + "_PrivilegeCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->PrivilegeCode->caption(), $client_edit->PrivilegeCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PrivilegeCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_edit->PrivilegeCode->errorMessage()) ?>");
			<?php if ($client_edit->ClientName->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->ClientName->caption(), $client_edit->ClientName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->Title->Required) { ?>
				elm = this.getElements("x" + infix + "_Title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->Title->caption(), $client_edit->Title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->Surname->caption(), $client_edit->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->FirstName->caption(), $client_edit->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->MiddleName->caption(), $client_edit->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->Sex->caption(), $client_edit->Sex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->MaritalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MaritalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->MaritalStatus->caption(), $client_edit->MaritalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->DateOfBirth->caption(), $client_edit->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_edit->DateOfBirth->errorMessage()) ?>");
			<?php if ($client_edit->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->PostalAddress->caption(), $client_edit->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->PhysicalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PhysicalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->PhysicalAddress->caption(), $client_edit->PhysicalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->TownOrVillage->Required) { ?>
				elm = this.getElements("x" + infix + "_TownOrVillage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->TownOrVillage->caption(), $client_edit->TownOrVillage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->Telephone->caption(), $client_edit->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->Mobile->caption(), $client_edit->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->Fax->caption(), $client_edit->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->_Email->caption(), $client_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_edit->_Email->errorMessage()) ?>");
			<?php if ($client_edit->NextOfKin->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->NextOfKin->caption(), $client_edit->NextOfKin->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->RelationshipCode->Required) { ?>
				elm = this.getElements("x" + infix + "_RelationshipCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->RelationshipCode->caption(), $client_edit->RelationshipCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->NextOfKinMobile->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinMobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->NextOfKinMobile->caption(), $client_edit->NextOfKinMobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_edit->NextOfKinEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_NextOfKinEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->NextOfKinEmail->caption(), $client_edit->NextOfKinEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_NextOfKinEmail");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_edit->NextOfKinEmail->errorMessage()) ?>");
			<?php if ($client_edit->AdditionalInformation->Required) { ?>
				elm = this.getElements("x" + infix + "_AdditionalInformation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_edit->AdditionalInformation->caption(), $client_edit->AdditionalInformation->RequiredErrorMessage)) ?>");
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
	fclientedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fclientedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fclientedit.lists["x_ClientType"] = <?php echo $client_edit->ClientType->Lookup->toClientList($client_edit) ?>;
	fclientedit.lists["x_ClientType"].options = <?php echo JsonEncode($client_edit->ClientType->lookupOptions()) ?>;
	fclientedit.lists["x_IdentityType"] = <?php echo $client_edit->IdentityType->Lookup->toClientList($client_edit) ?>;
	fclientedit.lists["x_IdentityType"].options = <?php echo JsonEncode($client_edit->IdentityType->lookupOptions()) ?>;
	fclientedit.lists["x_Title"] = <?php echo $client_edit->Title->Lookup->toClientList($client_edit) ?>;
	fclientedit.lists["x_Title"].options = <?php echo JsonEncode($client_edit->Title->lookupOptions()) ?>;
	fclientedit.lists["x_Sex"] = <?php echo $client_edit->Sex->Lookup->toClientList($client_edit) ?>;
	fclientedit.lists["x_Sex"].options = <?php echo JsonEncode($client_edit->Sex->lookupOptions()) ?>;
	fclientedit.lists["x_MaritalStatus"] = <?php echo $client_edit->MaritalStatus->Lookup->toClientList($client_edit) ?>;
	fclientedit.lists["x_MaritalStatus"].options = <?php echo JsonEncode($client_edit->MaritalStatus->lookupOptions()) ?>;
	fclientedit.lists["x_RelationshipCode"] = <?php echo $client_edit->RelationshipCode->Lookup->toClientList($client_edit) ?>;
	fclientedit.lists["x_RelationshipCode"].options = <?php echo JsonEncode($client_edit->RelationshipCode->lookupOptions()) ?>;
	loadjs.done("fclientedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $client_edit->showPageHeader(); ?>
<?php
$client_edit->showMessage();
?>
<?php if (!$client_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fclientedit" id="fclientedit" class="<?php echo $client_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$client_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($client_edit->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label id="elh_client_ClientSerNo" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->ClientSerNo->caption() ?><?php echo $client_edit->ClientSerNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->ClientSerNo->cellAttributes() ?>>
<span id="el_client_ClientSerNo">
<span<?php echo $client_edit->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_edit->ClientSerNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="client" data-field="x_ClientSerNo" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($client_edit->ClientSerNo->CurrentValue) ?>">
<?php echo $client_edit->ClientSerNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_client_ClientID" for="x_ClientID" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->ClientID->caption() ?><?php echo $client_edit->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->ClientID->cellAttributes() ?>>
<span id="el_client_ClientID">
<input type="text" data-table="client" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($client_edit->ClientID->getPlaceHolder()) ?>" value="<?php echo $client_edit->ClientID->EditValue ?>"<?php echo $client_edit->ClientID->editAttributes() ?>>
</span>
<?php echo $client_edit->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->ClientType->Visible) { // ClientType ?>
	<div id="r_ClientType" class="form-group row">
		<label id="elh_client_ClientType" for="x_ClientType" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->ClientType->caption() ?><?php echo $client_edit->ClientType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->ClientType->cellAttributes() ?>>
<span id="el_client_ClientType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_ClientType" data-value-separator="<?php echo $client_edit->ClientType->displayValueSeparatorAttribute() ?>" id="x_ClientType" name="x_ClientType"<?php echo $client_edit->ClientType->editAttributes() ?>>
			<?php echo $client_edit->ClientType->selectOptionListHtml("x_ClientType") ?>
		</select>
</div>
<?php echo $client_edit->ClientType->Lookup->getParamTag($client_edit, "p_x_ClientType") ?>
</span>
<?php echo $client_edit->ClientType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->IdentityType->Visible) { // IdentityType ?>
	<div id="r_IdentityType" class="form-group row">
		<label id="elh_client_IdentityType" for="x_IdentityType" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->IdentityType->caption() ?><?php echo $client_edit->IdentityType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->IdentityType->cellAttributes() ?>>
<span id="el_client_IdentityType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_IdentityType" data-value-separator="<?php echo $client_edit->IdentityType->displayValueSeparatorAttribute() ?>" id="x_IdentityType" name="x_IdentityType"<?php echo $client_edit->IdentityType->editAttributes() ?>>
			<?php echo $client_edit->IdentityType->selectOptionListHtml("x_IdentityType") ?>
		</select>
</div>
<?php echo $client_edit->IdentityType->Lookup->getParamTag($client_edit, "p_x_IdentityType") ?>
</span>
<?php echo $client_edit->IdentityType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->PrivilegeCode->Visible) { // PrivilegeCode ?>
	<div id="r_PrivilegeCode" class="form-group row">
		<label id="elh_client_PrivilegeCode" for="x_PrivilegeCode" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->PrivilegeCode->caption() ?><?php echo $client_edit->PrivilegeCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->PrivilegeCode->cellAttributes() ?>>
<span id="el_client_PrivilegeCode">
<input type="text" data-table="client" data-field="x_PrivilegeCode" name="x_PrivilegeCode" id="x_PrivilegeCode" size="30" placeholder="<?php echo HtmlEncode($client_edit->PrivilegeCode->getPlaceHolder()) ?>" value="<?php echo $client_edit->PrivilegeCode->EditValue ?>"<?php echo $client_edit->PrivilegeCode->editAttributes() ?>>
</span>
<?php echo $client_edit->PrivilegeCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->ClientName->Visible) { // ClientName ?>
	<div id="r_ClientName" class="form-group row">
		<label id="elh_client_ClientName" for="x_ClientName" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->ClientName->caption() ?><?php echo $client_edit->ClientName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->ClientName->cellAttributes() ?>>
<span id="el_client_ClientName">
<input type="text" data-table="client" data-field="x_ClientName" name="x_ClientName" id="x_ClientName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->ClientName->getPlaceHolder()) ?>" value="<?php echo $client_edit->ClientName->EditValue ?>"<?php echo $client_edit->ClientName->editAttributes() ?>>
</span>
<?php echo $client_edit->ClientName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label id="elh_client_Title" for="x_Title" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->Title->caption() ?><?php echo $client_edit->Title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->Title->cellAttributes() ?>>
<span id="el_client_Title">
<?php $client_edit->Title->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_Title" data-value-separator="<?php echo $client_edit->Title->displayValueSeparatorAttribute() ?>" id="x_Title" name="x_Title"<?php echo $client_edit->Title->editAttributes() ?>>
			<?php echo $client_edit->Title->selectOptionListHtml("x_Title") ?>
		</select>
</div>
<?php echo $client_edit->Title->Lookup->getParamTag($client_edit, "p_x_Title") ?>
</span>
<?php echo $client_edit->Title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label id="elh_client_Surname" for="x_Surname" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->Surname->caption() ?><?php echo $client_edit->Surname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->Surname->cellAttributes() ?>>
<span id="el_client_Surname">
<input type="text" data-table="client" data-field="x_Surname" name="x_Surname" id="x_Surname" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->Surname->getPlaceHolder()) ?>" value="<?php echo $client_edit->Surname->EditValue ?>"<?php echo $client_edit->Surname->editAttributes() ?>>
</span>
<?php echo $client_edit->Surname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_client_FirstName" for="x_FirstName" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->FirstName->caption() ?><?php echo $client_edit->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->FirstName->cellAttributes() ?>>
<span id="el_client_FirstName">
<input type="text" data-table="client" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->FirstName->getPlaceHolder()) ?>" value="<?php echo $client_edit->FirstName->EditValue ?>"<?php echo $client_edit->FirstName->editAttributes() ?>>
</span>
<?php echo $client_edit->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label id="elh_client_MiddleName" for="x_MiddleName" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->MiddleName->caption() ?><?php echo $client_edit->MiddleName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->MiddleName->cellAttributes() ?>>
<span id="el_client_MiddleName">
<input type="text" data-table="client" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($client_edit->MiddleName->getPlaceHolder()) ?>" value="<?php echo $client_edit->MiddleName->EditValue ?>"<?php echo $client_edit->MiddleName->editAttributes() ?>>
</span>
<?php echo $client_edit->MiddleName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->Sex->Visible) { // Sex ?>
	<div id="r_Sex" class="form-group row">
		<label id="elh_client_Sex" for="x_Sex" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->Sex->caption() ?><?php echo $client_edit->Sex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->Sex->cellAttributes() ?>>
<span id="el_client_Sex">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_Sex" data-value-separator="<?php echo $client_edit->Sex->displayValueSeparatorAttribute() ?>" id="x_Sex" name="x_Sex"<?php echo $client_edit->Sex->editAttributes() ?>>
			<?php echo $client_edit->Sex->selectOptionListHtml("x_Sex") ?>
		</select>
</div>
<?php echo $client_edit->Sex->Lookup->getParamTag($client_edit, "p_x_Sex") ?>
</span>
<?php echo $client_edit->Sex->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->MaritalStatus->Visible) { // MaritalStatus ?>
	<div id="r_MaritalStatus" class="form-group row">
		<label id="elh_client_MaritalStatus" for="x_MaritalStatus" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->MaritalStatus->caption() ?><?php echo $client_edit->MaritalStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->MaritalStatus->cellAttributes() ?>>
<span id="el_client_MaritalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_MaritalStatus" data-value-separator="<?php echo $client_edit->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x_MaritalStatus" name="x_MaritalStatus"<?php echo $client_edit->MaritalStatus->editAttributes() ?>>
			<?php echo $client_edit->MaritalStatus->selectOptionListHtml("x_MaritalStatus") ?>
		</select>
</div>
<?php echo $client_edit->MaritalStatus->Lookup->getParamTag($client_edit, "p_x_MaritalStatus") ?>
</span>
<?php echo $client_edit->MaritalStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label id="elh_client_DateOfBirth" for="x_DateOfBirth" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->DateOfBirth->caption() ?><?php echo $client_edit->DateOfBirth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->DateOfBirth->cellAttributes() ?>>
<span id="el_client_DateOfBirth">
<input type="text" data-table="client" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" placeholder="<?php echo HtmlEncode($client_edit->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $client_edit->DateOfBirth->EditValue ?>"<?php echo $client_edit->DateOfBirth->editAttributes() ?>>
<?php if (!$client_edit->DateOfBirth->ReadOnly && !$client_edit->DateOfBirth->Disabled && !isset($client_edit->DateOfBirth->EditAttrs["readonly"]) && !isset($client_edit->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclientedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fclientedit", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $client_edit->DateOfBirth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label id="elh_client_PostalAddress" for="x_PostalAddress" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->PostalAddress->caption() ?><?php echo $client_edit->PostalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->PostalAddress->cellAttributes() ?>>
<span id="el_client_PostalAddress">
<textarea data-table="client" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" cols="35" rows="4" placeholder="<?php echo HtmlEncode($client_edit->PostalAddress->getPlaceHolder()) ?>"<?php echo $client_edit->PostalAddress->editAttributes() ?>><?php echo $client_edit->PostalAddress->EditValue ?></textarea>
</span>
<?php echo $client_edit->PostalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<div id="r_PhysicalAddress" class="form-group row">
		<label id="elh_client_PhysicalAddress" for="x_PhysicalAddress" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->PhysicalAddress->caption() ?><?php echo $client_edit->PhysicalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->PhysicalAddress->cellAttributes() ?>>
<span id="el_client_PhysicalAddress">
<textarea data-table="client" data-field="x_PhysicalAddress" name="x_PhysicalAddress" id="x_PhysicalAddress" cols="35" rows="4" placeholder="<?php echo HtmlEncode($client_edit->PhysicalAddress->getPlaceHolder()) ?>"<?php echo $client_edit->PhysicalAddress->editAttributes() ?>><?php echo $client_edit->PhysicalAddress->EditValue ?></textarea>
</span>
<?php echo $client_edit->PhysicalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label id="elh_client_TownOrVillage" for="x_TownOrVillage" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->TownOrVillage->caption() ?><?php echo $client_edit->TownOrVillage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->TownOrVillage->cellAttributes() ?>>
<span id="el_client_TownOrVillage">
<input type="text" data-table="client" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $client_edit->TownOrVillage->EditValue ?>"<?php echo $client_edit->TownOrVillage->editAttributes() ?>>
</span>
<?php echo $client_edit->TownOrVillage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_client_Telephone" for="x_Telephone" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->Telephone->caption() ?><?php echo $client_edit->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->Telephone->cellAttributes() ?>>
<span id="el_client_Telephone">
<input type="text" data-table="client" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->Telephone->getPlaceHolder()) ?>" value="<?php echo $client_edit->Telephone->EditValue ?>"<?php echo $client_edit->Telephone->editAttributes() ?>>
</span>
<?php echo $client_edit->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_client_Mobile" for="x_Mobile" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->Mobile->caption() ?><?php echo $client_edit->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->Mobile->cellAttributes() ?>>
<span id="el_client_Mobile">
<input type="text" data-table="client" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->Mobile->getPlaceHolder()) ?>" value="<?php echo $client_edit->Mobile->EditValue ?>"<?php echo $client_edit->Mobile->editAttributes() ?>>
</span>
<?php echo $client_edit->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_client_Fax" for="x_Fax" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->Fax->caption() ?><?php echo $client_edit->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->Fax->cellAttributes() ?>>
<span id="el_client_Fax">
<input type="text" data-table="client" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($client_edit->Fax->getPlaceHolder()) ?>" value="<?php echo $client_edit->Fax->EditValue ?>"<?php echo $client_edit->Fax->editAttributes() ?>>
</span>
<?php echo $client_edit->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_client__Email" for="x__Email" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->_Email->caption() ?><?php echo $client_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->_Email->cellAttributes() ?>>
<span id="el_client__Email">
<input type="text" data-table="client" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $client_edit->_Email->EditValue ?>"<?php echo $client_edit->_Email->editAttributes() ?>>
</span>
<?php echo $client_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->NextOfKin->Visible) { // NextOfKin ?>
	<div id="r_NextOfKin" class="form-group row">
		<label id="elh_client_NextOfKin" for="x_NextOfKin" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->NextOfKin->caption() ?><?php echo $client_edit->NextOfKin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->NextOfKin->cellAttributes() ?>>
<span id="el_client_NextOfKin">
<input type="text" data-table="client" data-field="x_NextOfKin" name="x_NextOfKin" id="x_NextOfKin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->NextOfKin->getPlaceHolder()) ?>" value="<?php echo $client_edit->NextOfKin->EditValue ?>"<?php echo $client_edit->NextOfKin->editAttributes() ?>>
</span>
<?php echo $client_edit->NextOfKin->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->RelationshipCode->Visible) { // RelationshipCode ?>
	<div id="r_RelationshipCode" class="form-group row">
		<label id="elh_client_RelationshipCode" for="x_RelationshipCode" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->RelationshipCode->caption() ?><?php echo $client_edit->RelationshipCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->RelationshipCode->cellAttributes() ?>>
<span id="el_client_RelationshipCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client" data-field="x_RelationshipCode" data-value-separator="<?php echo $client_edit->RelationshipCode->displayValueSeparatorAttribute() ?>" id="x_RelationshipCode" name="x_RelationshipCode"<?php echo $client_edit->RelationshipCode->editAttributes() ?>>
			<?php echo $client_edit->RelationshipCode->selectOptionListHtml("x_RelationshipCode") ?>
		</select>
</div>
<?php echo $client_edit->RelationshipCode->Lookup->getParamTag($client_edit, "p_x_RelationshipCode") ?>
</span>
<?php echo $client_edit->RelationshipCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->NextOfKinMobile->Visible) { // NextOfKinMobile ?>
	<div id="r_NextOfKinMobile" class="form-group row">
		<label id="elh_client_NextOfKinMobile" for="x_NextOfKinMobile" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->NextOfKinMobile->caption() ?><?php echo $client_edit->NextOfKinMobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->NextOfKinMobile->cellAttributes() ?>>
<span id="el_client_NextOfKinMobile">
<input type="text" data-table="client" data-field="x_NextOfKinMobile" name="x_NextOfKinMobile" id="x_NextOfKinMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->NextOfKinMobile->getPlaceHolder()) ?>" value="<?php echo $client_edit->NextOfKinMobile->EditValue ?>"<?php echo $client_edit->NextOfKinMobile->editAttributes() ?>>
</span>
<?php echo $client_edit->NextOfKinMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->NextOfKinEmail->Visible) { // NextOfKinEmail ?>
	<div id="r_NextOfKinEmail" class="form-group row">
		<label id="elh_client_NextOfKinEmail" for="x_NextOfKinEmail" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->NextOfKinEmail->caption() ?><?php echo $client_edit->NextOfKinEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->NextOfKinEmail->cellAttributes() ?>>
<span id="el_client_NextOfKinEmail">
<input type="text" data-table="client" data-field="x_NextOfKinEmail" name="x_NextOfKinEmail" id="x_NextOfKinEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($client_edit->NextOfKinEmail->getPlaceHolder()) ?>" value="<?php echo $client_edit->NextOfKinEmail->EditValue ?>"<?php echo $client_edit->NextOfKinEmail->editAttributes() ?>>
</span>
<?php echo $client_edit->NextOfKinEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_edit->AdditionalInformation->Visible) { // AdditionalInformation ?>
	<div id="r_AdditionalInformation" class="form-group row">
		<label id="elh_client_AdditionalInformation" for="x_AdditionalInformation" class="<?php echo $client_edit->LeftColumnClass ?>"><?php echo $client_edit->AdditionalInformation->caption() ?><?php echo $client_edit->AdditionalInformation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_edit->RightColumnClass ?>"><div <?php echo $client_edit->AdditionalInformation->cellAttributes() ?>>
<span id="el_client_AdditionalInformation">
<textarea data-table="client" data-field="x_AdditionalInformation" name="x_AdditionalInformation" id="x_AdditionalInformation" cols="35" rows="4" placeholder="<?php echo HtmlEncode($client_edit->AdditionalInformation->getPlaceHolder()) ?>"<?php echo $client_edit->AdditionalInformation->editAttributes() ?>><?php echo $client_edit->AdditionalInformation->EditValue ?></textarea>
</span>
<?php echo $client_edit->AdditionalInformation->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if ($client->getCurrentDetailTable() != "") { ?>
<?php
	$client_edit->DetailPages->ValidKeys = explode(",", $client->getCurrentDetailTable());
	$firstActiveDetailTable = $client_edit->DetailPages->activePageIndex();
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav-tabs" id="client_edit_details"><!-- tabs -->
	<ul class="<?php echo $client_edit->DetailPages->navStyle() ?>"><!-- .nav -->
<?php
	if (in_array("property", explode(",", $client->getCurrentDetailTable())) && $property->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property") {
			$firstActiveDetailTable = "property";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $client_edit->DetailPages->pageStyle("property") ?>" href="#tab_property" data-toggle="tab"><?php echo $Language->tablePhrase("property", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("bill_board", explode(",", $client->getCurrentDetailTable())) && $bill_board->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "bill_board") {
			$firstActiveDetailTable = "bill_board";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $client_edit->DetailPages->pageStyle("bill_board") ?>" href="#tab_bill_board" data-toggle="tab"><?php echo $Language->tablePhrase("bill_board", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("property_lookup_view", explode(",", $client->getCurrentDetailTable())) && $property_lookup_view->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property_lookup_view") {
			$firstActiveDetailTable = "property_lookup_view";
		}
?>
		<li class="nav-item"><a class="nav-link <?php echo $client_edit->DetailPages->pageStyle("property_lookup_view") ?>" href="#tab_property_lookup_view" data-toggle="tab"><?php echo $Language->tablePhrase("property_lookup_view", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("property", explode(",", $client->getCurrentDetailTable())) && $property->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property")
			$firstActiveDetailTable = "property";
?>
		<div class="tab-pane <?php echo $client_edit->DetailPages->pageStyle("property") ?>" id="tab_property"><!-- page* -->
<?php include_once "propertygrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("bill_board", explode(",", $client->getCurrentDetailTable())) && $bill_board->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "bill_board")
			$firstActiveDetailTable = "bill_board";
?>
		<div class="tab-pane <?php echo $client_edit->DetailPages->pageStyle("bill_board") ?>" id="tab_bill_board"><!-- page* -->
<?php include_once "bill_boardgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("property_lookup_view", explode(",", $client->getCurrentDetailTable())) && $property_lookup_view->DetailEdit) {
		if ($firstActiveDetailTable == "" || $firstActiveDetailTable == "property_lookup_view")
			$firstActiveDetailTable = "property_lookup_view";
?>
		<div class="tab-pane <?php echo $client_edit->DetailPages->pageStyle("property_lookup_view") ?>" id="tab_property_lookup_view"><!-- page* -->
<?php include_once "property_lookup_viewgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$client_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $client_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $client_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$client_edit->IsModal) { ?>
<?php echo $client_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$client_edit->showPageFooter();
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
$client_edit->terminate();
?>