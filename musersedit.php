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
$musers_edit = new musers_edit();

// Run the page
$musers_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$musers_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmusersedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fmusersedit = currentForm = new ew.Form("fmusersedit", "edit");

	// Validate form
	fmusersedit.validate = function() {
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
			<?php if ($musers_edit->UserCode->Required) { ?>
				elm = this.getElements("x" + infix + "_UserCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->UserCode->caption(), $musers_edit->UserCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->UserName->Required) { ?>
				elm = this.getElements("x" + infix + "_UserName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->UserName->caption(), $musers_edit->UserName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->Password->Required) { ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->Password->caption(), $musers_edit->Password->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Password");
				if (elm && $(elm).hasClass("ew-password-strength") && !$(elm).data("validated"))
					return this.onError(elm, ew.language.phrase("PasswordTooSimple"));
			<?php if ($musers_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->EmployeeID->caption(), $musers_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($musers_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($musers_edit->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->FirstName->caption(), $musers_edit->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->LastName->Required) { ?>
				elm = this.getElements("x" + infix + "_LastName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->LastName->caption(), $musers_edit->LastName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->ProvinceCode->caption(), $musers_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->LACode->caption(), $musers_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->Level->Required) { ?>
				elm = this.getElements("x" + infix + "_Level");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->Level->caption(), $musers_edit->Level->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->Role->Required) { ?>
				elm = this.getElements("x" + infix + "_Role");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->Role->caption(), $musers_edit->Role->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->Clearance->Required) { ?>
				elm = this.getElements("x" + infix + "_Clearance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->Clearance->caption(), $musers_edit->Clearance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->OrganisationLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_OrganisationLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->OrganisationLevel->caption(), $musers_edit->OrganisationLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_OrganisationLevel");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($musers_edit->OrganisationLevel->errorMessage()) ?>");
			<?php if ($musers_edit->Active->Required) { ?>
				elm = this.getElements("x" + infix + "_Active");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->Active->caption(), $musers_edit->Active->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->_Email->caption(), $musers_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->Telephone->caption(), $musers_edit->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->Mobile->caption(), $musers_edit->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->Position->Required) { ?>
				elm = this.getElements("x" + infix + "_Position");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->Position->caption(), $musers_edit->Position->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($musers_edit->ReportsTo->Required) { ?>
				elm = this.getElements("x" + infix + "_ReportsTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->ReportsTo->caption(), $musers_edit->ReportsTo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReportsTo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($musers_edit->ReportsTo->errorMessage()) ?>");
			<?php if ($musers_edit->Profile->Required) { ?>
				elm = this.getElements("x" + infix + "_Profile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $musers_edit->Profile->caption(), $musers_edit->Profile->RequiredErrorMessage)) ?>");
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
	fmusersedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmusersedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmusersedit.lists["x_ProvinceCode"] = <?php echo $musers_edit->ProvinceCode->Lookup->toClientList($musers_edit) ?>;
	fmusersedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($musers_edit->ProvinceCode->lookupOptions()) ?>;
	fmusersedit.lists["x_LACode"] = <?php echo $musers_edit->LACode->Lookup->toClientList($musers_edit) ?>;
	fmusersedit.lists["x_LACode"].options = <?php echo JsonEncode($musers_edit->LACode->lookupOptions()) ?>;
	fmusersedit.lists["x_Level"] = <?php echo $musers_edit->Level->Lookup->toClientList($musers_edit) ?>;
	fmusersedit.lists["x_Level"].options = <?php echo JsonEncode($musers_edit->Level->lookupOptions()) ?>;
	fmusersedit.lists["x_Role"] = <?php echo $musers_edit->Role->Lookup->toClientList($musers_edit) ?>;
	fmusersedit.lists["x_Role"].options = <?php echo JsonEncode($musers_edit->Role->lookupOptions()) ?>;
	fmusersedit.lists["x_Clearance"] = <?php echo $musers_edit->Clearance->Lookup->toClientList($musers_edit) ?>;
	fmusersedit.lists["x_Clearance"].options = <?php echo JsonEncode($musers_edit->Clearance->lookupOptions()) ?>;
	fmusersedit.lists["x_Active"] = <?php echo $musers_edit->Active->Lookup->toClientList($musers_edit) ?>;
	fmusersedit.lists["x_Active"].options = <?php echo JsonEncode($musers_edit->Active->lookupOptions()) ?>;
	loadjs.done("fmusersedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $musers_edit->showPageHeader(); ?>
<?php
$musers_edit->showMessage();
?>
<?php if (!$musers_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $musers_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fmusersedit" id="fmusersedit" class="<?php echo $musers_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="musers">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$musers_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($musers_edit->UserCode->Visible) { // UserCode ?>
	<div id="r_UserCode" class="form-group row">
		<label id="elh_musers_UserCode" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->UserCode->caption() ?><?php echo $musers_edit->UserCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->UserCode->cellAttributes() ?>>
<span id="el_musers_UserCode">
<input type="text" data-table="musers" data-field="x_UserCode" name="x_UserCode" id="x_UserCode" placeholder="<?php echo HtmlEncode($musers_edit->UserCode->getPlaceHolder()) ?>" value="<?php echo $musers_edit->UserCode->EditValue ?>"<?php echo $musers_edit->UserCode->editAttributes() ?>>
</span>
<?php echo $musers_edit->UserCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->UserName->Visible) { // UserName ?>
	<div id="r_UserName" class="form-group row">
		<label id="elh_musers_UserName" for="x_UserName" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->UserName->caption() ?><?php echo $musers_edit->UserName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->UserName->cellAttributes() ?>>
<input type="text" data-table="musers" data-field="x_UserName" name="x_UserName" id="x_UserName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_edit->UserName->getPlaceHolder()) ?>" value="<?php echo $musers_edit->UserName->EditValue ?>"<?php echo $musers_edit->UserName->editAttributes() ?>>
<input type="hidden" data-table="musers" data-field="x_UserName" name="o_UserName" id="o_UserName" value="<?php echo HtmlEncode($musers_edit->UserName->OldValue != null ? $musers_edit->UserName->OldValue : $musers_edit->UserName->CurrentValue) ?>">
<?php echo $musers_edit->UserName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->Password->Visible) { // Password ?>
	<div id="r_Password" class="form-group row">
		<label id="elh_musers_Password" for="x_Password" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->Password->caption() ?><?php echo $musers_edit->Password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->Password->cellAttributes() ?>>
<span id="el_musers_Password">
<div class="input-group" id="ig_Password">
<input type="password" autocomplete="new-password" data-password-strength="pst_Password" data-table="musers" data-field="x_Password" name="x_Password" id="x_Password" value="<?php echo $musers_edit->Password->EditValue ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_edit->Password->getPlaceHolder()) ?>"<?php echo $musers_edit->Password->editAttributes() ?>>
<div class="input-group-append">
	<button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
	<button type="button" class="btn btn-default ew-password-generator" title="<?php echo HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x_Password" data-password-confirm="c_Password" data-password-strength="pst_Password"><?php echo $Language->phrase("GeneratePassword") ?></button>
</div>
</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst_Password">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<?php echo $musers_edit->Password->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_musers_EmployeeID" for="x_EmployeeID" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->EmployeeID->caption() ?><?php echo $musers_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->EmployeeID->cellAttributes() ?>>
<span id="el_musers_EmployeeID">
<input type="text" data-table="musers" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($musers_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $musers_edit->EmployeeID->EditValue ?>"<?php echo $musers_edit->EmployeeID->editAttributes() ?>>
</span>
<?php echo $musers_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_musers_FirstName" for="x_FirstName" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->FirstName->caption() ?><?php echo $musers_edit->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->FirstName->cellAttributes() ?>>
<span id="el_musers_FirstName">
<input type="text" data-table="musers" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_edit->FirstName->getPlaceHolder()) ?>" value="<?php echo $musers_edit->FirstName->EditValue ?>"<?php echo $musers_edit->FirstName->editAttributes() ?>>
</span>
<?php echo $musers_edit->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->LastName->Visible) { // LastName ?>
	<div id="r_LastName" class="form-group row">
		<label id="elh_musers_LastName" for="x_LastName" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->LastName->caption() ?><?php echo $musers_edit->LastName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->LastName->cellAttributes() ?>>
<span id="el_musers_LastName">
<input type="text" data-table="musers" data-field="x_LastName" name="x_LastName" id="x_LastName" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_edit->LastName->getPlaceHolder()) ?>" value="<?php echo $musers_edit->LastName->EditValue ?>"<?php echo $musers_edit->LastName->editAttributes() ?>>
</span>
<?php echo $musers_edit->LastName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_musers_ProvinceCode" for="x_ProvinceCode" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->ProvinceCode->caption() ?><?php echo $musers_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->ProvinceCode->cellAttributes() ?>>
<span id="el_musers_ProvinceCode">
<?php $musers_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProvinceCode"><?php echo EmptyValue(strval($musers_edit->ProvinceCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $musers_edit->ProvinceCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($musers_edit->ProvinceCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($musers_edit->ProvinceCode->ReadOnly || $musers_edit->ProvinceCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProvinceCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $musers_edit->ProvinceCode->Lookup->getParamTag($musers_edit, "p_x_ProvinceCode") ?>
<input type="hidden" data-table="musers" data-field="x_ProvinceCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $musers_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" name="x_ProvinceCode" id="x_ProvinceCode" value="<?php echo $musers_edit->ProvinceCode->CurrentValue ?>"<?php echo $musers_edit->ProvinceCode->editAttributes() ?>>
</span>
<?php echo $musers_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_musers_LACode" for="x_LACode" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->LACode->caption() ?><?php echo $musers_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->LACode->cellAttributes() ?>>
<span id="el_musers_LACode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($musers_edit->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $musers_edit->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($musers_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($musers_edit->LACode->ReadOnly || $musers_edit->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $musers_edit->LACode->Lookup->getParamTag($musers_edit, "p_x_LACode") ?>
<input type="hidden" data-table="musers" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $musers_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $musers_edit->LACode->CurrentValue ?>"<?php echo $musers_edit->LACode->editAttributes() ?>>
</span>
<?php echo $musers_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->Level->Visible) { // Level ?>
	<div id="r_Level" class="form-group row">
		<label id="elh_musers_Level" for="x_Level" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->Level->caption() ?><?php echo $musers_edit->Level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->Level->cellAttributes() ?>>
<span id="el_musers_Level">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Level" data-value-separator="<?php echo $musers_edit->Level->displayValueSeparatorAttribute() ?>" id="x_Level" name="x_Level"<?php echo $musers_edit->Level->editAttributes() ?>>
			<?php echo $musers_edit->Level->selectOptionListHtml("x_Level") ?>
		</select>
</div>
<?php echo $musers_edit->Level->Lookup->getParamTag($musers_edit, "p_x_Level") ?>
</span>
<?php echo $musers_edit->Level->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->Role->Visible) { // Role ?>
	<div id="r_Role" class="form-group row">
		<label id="elh_musers_Role" for="x_Role" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->Role->caption() ?><?php echo $musers_edit->Role->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->Role->cellAttributes() ?>>
<span id="el_musers_Role">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Role" data-value-separator="<?php echo $musers_edit->Role->displayValueSeparatorAttribute() ?>" id="x_Role" name="x_Role"<?php echo $musers_edit->Role->editAttributes() ?>>
			<?php echo $musers_edit->Role->selectOptionListHtml("x_Role") ?>
		</select>
</div>
<?php echo $musers_edit->Role->Lookup->getParamTag($musers_edit, "p_x_Role") ?>
</span>
<?php echo $musers_edit->Role->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->Clearance->Visible) { // Clearance ?>
	<div id="r_Clearance" class="form-group row">
		<label id="elh_musers_Clearance" for="x_Clearance" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->Clearance->caption() ?><?php echo $musers_edit->Clearance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->Clearance->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_musers_Clearance">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($musers_edit->Clearance->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_musers_Clearance">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="musers" data-field="x_Clearance" data-value-separator="<?php echo $musers_edit->Clearance->displayValueSeparatorAttribute() ?>" id="x_Clearance" name="x_Clearance"<?php echo $musers_edit->Clearance->editAttributes() ?>>
			<?php echo $musers_edit->Clearance->selectOptionListHtml("x_Clearance") ?>
		</select>
</div>
<?php echo $musers_edit->Clearance->Lookup->getParamTag($musers_edit, "p_x_Clearance") ?>
</span>
<?php } ?>
<?php echo $musers_edit->Clearance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->OrganisationLevel->Visible) { // OrganisationLevel ?>
	<div id="r_OrganisationLevel" class="form-group row">
		<label id="elh_musers_OrganisationLevel" for="x_OrganisationLevel" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->OrganisationLevel->caption() ?><?php echo $musers_edit->OrganisationLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->OrganisationLevel->cellAttributes() ?>>
<span id="el_musers_OrganisationLevel">
<input type="text" data-table="musers" data-field="x_OrganisationLevel" name="x_OrganisationLevel" id="x_OrganisationLevel" size="30" placeholder="<?php echo HtmlEncode($musers_edit->OrganisationLevel->getPlaceHolder()) ?>" value="<?php echo $musers_edit->OrganisationLevel->EditValue ?>"<?php echo $musers_edit->OrganisationLevel->editAttributes() ?>>
</span>
<?php echo $musers_edit->OrganisationLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->Active->Visible) { // Active ?>
	<div id="r_Active" class="form-group row">
		<label id="elh_musers_Active" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->Active->caption() ?><?php echo $musers_edit->Active->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->Active->cellAttributes() ?>>
<span id="el_musers_Active">
<div id="tp_x_Active" class="ew-template"><input type="radio" class="custom-control-input" data-table="musers" data-field="x_Active" data-value-separator="<?php echo $musers_edit->Active->displayValueSeparatorAttribute() ?>" name="x_Active" id="x_Active" value="{value}"<?php echo $musers_edit->Active->editAttributes() ?>></div>
<div id="dsl_x_Active" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $musers_edit->Active->radioButtonListHtml(FALSE, "x_Active") ?>
</div></div>
<?php echo $musers_edit->Active->Lookup->getParamTag($musers_edit, "p_x_Active") ?>
</span>
<?php echo $musers_edit->Active->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_musers__Email" for="x__Email" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->_Email->caption() ?><?php echo $musers_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->_Email->cellAttributes() ?>>
<span id="el_musers__Email">
<input type="text" data-table="musers" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $musers_edit->_Email->EditValue ?>"<?php echo $musers_edit->_Email->editAttributes() ?>>
</span>
<?php echo $musers_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_musers_Telephone" for="x_Telephone" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->Telephone->caption() ?><?php echo $musers_edit->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->Telephone->cellAttributes() ?>>
<span id="el_musers_Telephone">
<input type="text" data-table="musers" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($musers_edit->Telephone->getPlaceHolder()) ?>" value="<?php echo $musers_edit->Telephone->EditValue ?>"<?php echo $musers_edit->Telephone->editAttributes() ?>>
</span>
<?php echo $musers_edit->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_musers_Mobile" for="x_Mobile" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->Mobile->caption() ?><?php echo $musers_edit->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->Mobile->cellAttributes() ?>>
<span id="el_musers_Mobile">
<input type="text" data-table="musers" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($musers_edit->Mobile->getPlaceHolder()) ?>" value="<?php echo $musers_edit->Mobile->EditValue ?>"<?php echo $musers_edit->Mobile->editAttributes() ?>>
</span>
<?php echo $musers_edit->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->Position->Visible) { // Position ?>
	<div id="r_Position" class="form-group row">
		<label id="elh_musers_Position" for="x_Position" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->Position->caption() ?><?php echo $musers_edit->Position->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->Position->cellAttributes() ?>>
<span id="el_musers_Position">
<input type="text" data-table="musers" data-field="x_Position" name="x_Position" id="x_Position" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($musers_edit->Position->getPlaceHolder()) ?>" value="<?php echo $musers_edit->Position->EditValue ?>"<?php echo $musers_edit->Position->editAttributes() ?>>
</span>
<?php echo $musers_edit->Position->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->ReportsTo->Visible) { // ReportsTo ?>
	<div id="r_ReportsTo" class="form-group row">
		<label id="elh_musers_ReportsTo" for="x_ReportsTo" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->ReportsTo->caption() ?><?php echo $musers_edit->ReportsTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->ReportsTo->cellAttributes() ?>>
<span id="el_musers_ReportsTo">
<input type="text" data-table="musers" data-field="x_ReportsTo" name="x_ReportsTo" id="x_ReportsTo" size="30" placeholder="<?php echo HtmlEncode($musers_edit->ReportsTo->getPlaceHolder()) ?>" value="<?php echo $musers_edit->ReportsTo->EditValue ?>"<?php echo $musers_edit->ReportsTo->editAttributes() ?>>
</span>
<?php echo $musers_edit->ReportsTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($musers_edit->Profile->Visible) { // Profile ?>
	<div id="r_Profile" class="form-group row">
		<label id="elh_musers_Profile" for="x_Profile" class="<?php echo $musers_edit->LeftColumnClass ?>"><?php echo $musers_edit->Profile->caption() ?><?php echo $musers_edit->Profile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $musers_edit->RightColumnClass ?>"><div <?php echo $musers_edit->Profile->cellAttributes() ?>>
<span id="el_musers_Profile">
<textarea data-table="musers" data-field="x_Profile" name="x_Profile" id="x_Profile" cols="35" rows="4" placeholder="<?php echo HtmlEncode($musers_edit->Profile->getPlaceHolder()) ?>"<?php echo $musers_edit->Profile->editAttributes() ?>><?php echo $musers_edit->Profile->EditValue ?></textarea>
</span>
<?php echo $musers_edit->Profile->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("security_matrix", explode(",", $musers->getCurrentDetailTable())) && $security_matrix->DetailEdit) {
?>
<?php if ($musers->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("security_matrix", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "security_matrixgrid.php" ?>
<?php } ?>
<?php if (!$musers_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $musers_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $musers_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$musers_edit->IsModal) { ?>
<?php echo $musers_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$musers_edit->showPageFooter();
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
$musers_edit->terminate();
?>