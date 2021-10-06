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
$musers_add = new musers_add();

// Run the page
$musers_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$musers_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmusersadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmusersadd = currentForm = new ew.Form("fmusersadd", "add");

	// Validate form
	fmusersadd.validate = function() {
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
			<?php if ($musers_add->UserName->Required) { ?>
				elm = this.getElements("x" + infix + "_UserName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->UserName->caption(), $musers_add->UserName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->Password->caption(), $musers_add->Password->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && $(elm).hasClass("ew-password-strength") && !$(elm).data("validated"))
					return this.onError(elm, ew.language.phrase("PasswordTooSimple"));
			<?php if ($musers_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->EmployeeID->caption(), $musers_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($musers_add->EmployeeID->errorMessage()) ?>");
			<?php if ($musers_add->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->FirstName->caption(), $musers_add->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->LastName->Required) { ?>
				elm = this.getElements("x" + infix + "_LastName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->LastName->caption(), $musers_add->LastName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->ProvinceCode->caption(), $musers_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->LACode->caption(), $musers_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->Level->Required) { ?>
				elm = this.getElements("x" + infix + "_Level");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->Level->caption(), $musers_add->Level->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->Role->Required) { ?>
				elm = this.getElements("x" + infix + "_Role");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->Role->caption(), $musers_add->Role->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->Clearance->Required) { ?>
				elm = this.getElements("x" + infix + "_Clearance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->Clearance->caption(), $musers_add->Clearance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->OrganisationLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_OrganisationLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->OrganisationLevel->caption(), $musers_add->OrganisationLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OrganisationLevel");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($musers_add->OrganisationLevel->errorMessage()) ?>");
			<?php if ($musers_add->Active->Required) { ?>
				elm = this.getElements("x" + infix + "_Active");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->Active->caption(), $musers_add->Active->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->_Email->caption(), $musers_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->Telephone->caption(), $musers_add->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->Mobile->caption(), $musers_add->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->Position->Required) { ?>
				elm = this.getElements("x" + infix + "_Position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->Position->caption(), $musers_add->Position->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_add->ReportsTo->Required) { ?>
				elm = this.getElements("x" + infix + "_ReportsTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->ReportsTo->caption(), $musers_add->ReportsTo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReportsTo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($musers_add->ReportsTo->errorMessage()) ?>");
			<?php if ($musers_add->Profile->Required) { ?>
				elm = this.getElements("x" + infix + "_Profile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_add->Profile->caption(), $musers_add->Profile->RequiredErrorMessage)) ?>");
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
	fmusersadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmusersadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmusersadd.lists["x_ProvinceCode"] = <?php echo $musers_add->ProvinceCode->Lookup->toClientList($musers_add) ?>;
	fmusersadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($musers_add->ProvinceCode->lookupOptions()) ?>;
	fmusersadd.lists["x_LACode"] = <?php echo $musers_add->LACode->Lookup->toClientList($musers_add) ?>;
	fmusersadd.lists["x_LACode"].options = <?php echo JsonEncode($musers_add->LACode->lookupOptions()) ?>;
	fmusersadd.lists["x_Level"] = <?php echo $musers_add->Level->Lookup->toClientList($musers_add) ?>;
	fmusersadd.lists["x_Level"].options = <?php echo JsonEncode($musers_add->Level->lookupOptions()) ?>;
	fmusersadd.lists["x_Role"] = <?php echo $musers_add->Role->Lookup->toClientList($musers_add) ?>;
	fmusersadd.lists["x_Role"].options = <?php echo JsonEncode($musers_add->Role->lookupOptions()) ?>;
	fmusersadd.lists["x_Clearance"] = <?php echo $musers_add->Clearance->Lookup->toClientList($musers_add) ?>;
	fmusersadd.lists["x_Clearance"].options = <?php echo JsonEncode($musers_add->Clearance->lookupOptions()) ?>;
	fmusersadd.lists["x_Active"] = <?php echo $musers_add->Active->Lookup->toClientList($musers_add) ?>;
	fmusersadd.lists["x_Active"].options = <?php echo JsonEncode($musers_add->Active->lookupOptions()) ?>;
	loadjs.done("fmusersadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $musers_add->showPageHeader(); ?>
<?php
$musers_add->showMessage();
?>
<form name="fmusersadd" id="fmusersadd" class="<?php echo $musers_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="musers">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$musers_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($musers_add->UserName->Visible) { // UserName ?>
	<div id="r_UserName" class="form-group row">
		<label id="elh_musers_UserName" for="x_UserName" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->UserName->caption() ?><?php echo $musers_add->UserName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->UserName->cellAttributes() ?>>
<span id="el_musers_UserName">
<input type="text" data-table="musers" data-field="x_UserName" name="x_UserName" id="x_UserName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_add->UserName->getPlaceHolder()) ?>" value="<?php echo $musers_add->UserName->EditValue ?>"<?php echo $musers_add->UserName->editAttributes() ?>>
</span>
<?php echo $musers_add->UserName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_musers_Password" for="x_Password" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->Password->caption() ?><?php echo $musers_add->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->Password->cellAttributes() ?>>
<span id="el_musers_Password">
<div class="input-group" id="ig_Password">
<input type="password" autocomplete="new-password" data-password-strength="pst_Password" data-table="musers" data-field="x_Password" name="x_Password" id="x_Password" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_add->Password->getPlaceHolder()) ?>"<?php echo $musers_add->Password->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x_Password" data-password-confirm="c_Password" data-password-strength="pst_Password"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst_Password">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<?php echo $musers_add->Password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_musers_EmployeeID" for="x_EmployeeID" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->EmployeeID->caption() ?><?php echo $musers_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->EmployeeID->cellAttributes() ?>>
<span id="el_musers_EmployeeID">
<input type="text" data-table="musers" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($musers_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $musers_add->EmployeeID->EditValue ?>"<?php echo $musers_add->EmployeeID->editAttributes() ?>>
</span>
<?php echo $musers_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_musers_FirstName" for="x_FirstName" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->FirstName->caption() ?><?php echo $musers_add->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->FirstName->cellAttributes() ?>>
<span id="el_musers_FirstName">
<input type="text" data-table="musers" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_add->FirstName->getPlaceHolder()) ?>" value="<?php echo $musers_add->FirstName->EditValue ?>"<?php echo $musers_add->FirstName->editAttributes() ?>>
</span>
<?php echo $musers_add->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->LastName->Visible) { // LastName ?>
	<div id="r_LastName" class="form-group row">
		<label id="elh_musers_LastName" for="x_LastName" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->LastName->caption() ?><?php echo $musers_add->LastName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->LastName->cellAttributes() ?>>
<span id="el_musers_LastName">
<input type="text" data-table="musers" data-field="x_LastName" name="x_LastName" id="x_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_add->LastName->getPlaceHolder()) ?>" value="<?php echo $musers_add->LastName->EditValue ?>"<?php echo $musers_add->LastName->editAttributes() ?>>
</span>
<?php echo $musers_add->LastName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_musers_ProvinceCode" for="x_ProvinceCode" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->ProvinceCode->caption() ?><?php echo $musers_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->ProvinceCode->cellAttributes() ?>>
<span id="el_musers_ProvinceCode">
<?php $musers_add->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProvinceCode"><?php echo EmptyValue(strval($musers_add->ProvinceCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $musers_add->ProvinceCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($musers_add->ProvinceCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($musers_add->ProvinceCode->ReadOnly || $musers_add->ProvinceCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProvinceCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $musers_add->ProvinceCode->Lookup->getParamTag($musers_add, "p_x_ProvinceCode") ?>
<input type="hidden" data-table="musers" data-field="x_ProvinceCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $musers_add->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo $musers_add->ProvinceCode->CurrentValue ?>"<?php echo $musers_add->ProvinceCode->editAttributes() ?>>
</span>
<?php echo $musers_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_musers_LACode" for="x_LACode" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->LACode->caption() ?><?php echo $musers_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->LACode->cellAttributes() ?>>
<span id="el_musers_LACode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($musers_add->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $musers_add->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($musers_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($musers_add->LACode->ReadOnly || $musers_add->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $musers_add->LACode->Lookup->getParamTag($musers_add, "p_x_LACode") ?>
<input type="hidden" data-table="musers" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $musers_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $musers_add->LACode->CurrentValue ?>"<?php echo $musers_add->LACode->editAttributes() ?>>
</span>
<?php echo $musers_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->Level->Visible) { // Level ?>
	<div id="r_Level" class="form-group row">
		<label id="elh_musers_Level" for="x_Level" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->Level->caption() ?><?php echo $musers_add->Level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->Level->cellAttributes() ?>>
<span id="el_musers_Level">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Level" data-value-separator="<?php echo $musers_add->Level->displayValueSeparatorAttribute() ?>" id="x_Level" name="x_Level"<?php echo $musers_add->Level->editAttributes() ?>>
			<?php echo $musers_add->Level->selectOptionListHtml("x_Level") ?>
		</select>
</div>
<?php echo $musers_add->Level->Lookup->getParamTag($musers_add, "p_x_Level") ?>
</span>
<?php echo $musers_add->Level->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->Role->Visible) { // Role ?>
	<div id="r_Role" class="form-group row">
		<label id="elh_musers_Role" for="x_Role" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->Role->caption() ?><?php echo $musers_add->Role->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->Role->cellAttributes() ?>>
<span id="el_musers_Role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Role" data-value-separator="<?php echo $musers_add->Role->displayValueSeparatorAttribute() ?>" id="x_Role" name="x_Role"<?php echo $musers_add->Role->editAttributes() ?>>
			<?php echo $musers_add->Role->selectOptionListHtml("x_Role") ?>
		</select>
</div>
<?php echo $musers_add->Role->Lookup->getParamTag($musers_add, "p_x_Role") ?>
</span>
<?php echo $musers_add->Role->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->Clearance->Visible) { // Clearance ?>
	<div id="r_Clearance" class="form-group row">
		<label id="elh_musers_Clearance" for="x_Clearance" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->Clearance->caption() ?><?php echo $musers_add->Clearance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->Clearance->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_musers_Clearance">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($musers_add->Clearance->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_musers_Clearance">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Clearance" data-value-separator="<?php echo $musers_add->Clearance->displayValueSeparatorAttribute() ?>" id="x_Clearance" name="x_Clearance"<?php echo $musers_add->Clearance->editAttributes() ?>>
			<?php echo $musers_add->Clearance->selectOptionListHtml("x_Clearance") ?>
		</select>
</div>
<?php echo $musers_add->Clearance->Lookup->getParamTag($musers_add, "p_x_Clearance") ?>
</span>
<?php } ?>
<?php echo $musers_add->Clearance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->OrganisationLevel->Visible) { // OrganisationLevel ?>
	<div id="r_OrganisationLevel" class="form-group row">
		<label id="elh_musers_OrganisationLevel" for="x_OrganisationLevel" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->OrganisationLevel->caption() ?><?php echo $musers_add->OrganisationLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->OrganisationLevel->cellAttributes() ?>>
<span id="el_musers_OrganisationLevel">
<input type="text" data-table="musers" data-field="x_OrganisationLevel" name="x_OrganisationLevel" id="x_OrganisationLevel" size="30" placeholder="<?php echo HtmlEncode($musers_add->OrganisationLevel->getPlaceHolder()) ?>" value="<?php echo $musers_add->OrganisationLevel->EditValue ?>"<?php echo $musers_add->OrganisationLevel->editAttributes() ?>>
</span>
<?php echo $musers_add->OrganisationLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->Active->Visible) { // Active ?>
	<div id="r_Active" class="form-group row">
		<label id="elh_musers_Active" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->Active->caption() ?><?php echo $musers_add->Active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->Active->cellAttributes() ?>>
<span id="el_musers_Active">
<div id="tp_x_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="musers" data-field="x_Active" data-value-separator="<?php echo $musers_add->Active->displayValueSeparatorAttribute() ?>" name="x_Active" id="x_Active" value="{value}"<?php echo $musers_add->Active->editAttributes() ?>></div>
<div id="dsl_x_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $musers_add->Active->radioButtonListHtml(FALSE, "x_Active") ?>
</div></div>
<?php echo $musers_add->Active->Lookup->getParamTag($musers_add, "p_x_Active") ?>
</span>
<?php echo $musers_add->Active->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_musers__Email" for="x__Email" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->_Email->caption() ?><?php echo $musers_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->_Email->cellAttributes() ?>>
<span id="el_musers__Email">
<input type="text" data-table="musers" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_add->_Email->getPlaceHolder()) ?>" value="<?php echo $musers_add->_Email->EditValue ?>"<?php echo $musers_add->_Email->editAttributes() ?>>
</span>
<?php echo $musers_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_musers_Telephone" for="x_Telephone" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->Telephone->caption() ?><?php echo $musers_add->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->Telephone->cellAttributes() ?>>
<span id="el_musers_Telephone">
<input type="text" data-table="musers" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_add->Telephone->getPlaceHolder()) ?>" value="<?php echo $musers_add->Telephone->EditValue ?>"<?php echo $musers_add->Telephone->editAttributes() ?>>
</span>
<?php echo $musers_add->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_musers_Mobile" for="x_Mobile" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->Mobile->caption() ?><?php echo $musers_add->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->Mobile->cellAttributes() ?>>
<span id="el_musers_Mobile">
<input type="text" data-table="musers" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($musers_add->Mobile->getPlaceHolder()) ?>" value="<?php echo $musers_add->Mobile->EditValue ?>"<?php echo $musers_add->Mobile->editAttributes() ?>>
</span>
<?php echo $musers_add->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->Position->Visible) { // Position ?>
	<div id="r_Position" class="form-group row">
		<label id="elh_musers_Position" for="x_Position" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->Position->caption() ?><?php echo $musers_add->Position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->Position->cellAttributes() ?>>
<span id="el_musers_Position">
<input type="text" data-table="musers" data-field="x_Position" name="x_Position" id="x_Position" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($musers_add->Position->getPlaceHolder()) ?>" value="<?php echo $musers_add->Position->EditValue ?>"<?php echo $musers_add->Position->editAttributes() ?>>
</span>
<?php echo $musers_add->Position->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->ReportsTo->Visible) { // ReportsTo ?>
	<div id="r_ReportsTo" class="form-group row">
		<label id="elh_musers_ReportsTo" for="x_ReportsTo" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->ReportsTo->caption() ?><?php echo $musers_add->ReportsTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->ReportsTo->cellAttributes() ?>>
<span id="el_musers_ReportsTo">
<input type="text" data-table="musers" data-field="x_ReportsTo" name="x_ReportsTo" id="x_ReportsTo" size="30" placeholder="<?php echo HtmlEncode($musers_add->ReportsTo->getPlaceHolder()) ?>" value="<?php echo $musers_add->ReportsTo->EditValue ?>"<?php echo $musers_add->ReportsTo->editAttributes() ?>>
</span>
<?php echo $musers_add->ReportsTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_add->Profile->Visible) { // Profile ?>
	<div id="r_Profile" class="form-group row">
		<label id="elh_musers_Profile" for="x_Profile" class="<?php echo $musers_add->LeftColumnClass ?>"><?php echo $musers_add->Profile->caption() ?><?php echo $musers_add->Profile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_add->RightColumnClass ?>"><div <?php echo $musers_add->Profile->cellAttributes() ?>>
<span id="el_musers_Profile">
<textarea data-table="musers" data-field="x_Profile" name="x_Profile" id="x_Profile" cols="35" rows="4" placeholder="<?php echo HtmlEncode($musers_add->Profile->getPlaceHolder()) ?>"<?php echo $musers_add->Profile->editAttributes() ?>><?php echo $musers_add->Profile->EditValue ?></textarea>
</span>
<?php echo $musers_add->Profile->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("security_matrix", explode(",", $musers->getCurrentDetailTable())) && $security_matrix->DetailAdd) {
?>
<?php if ($musers->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("security_matrix", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "security_matrixgrid.php" ?>
<?php } ?>
<?php if (!$musers_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $musers_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $musers_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$musers_add->showPageFooter();
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
$musers_add->terminate();
?>