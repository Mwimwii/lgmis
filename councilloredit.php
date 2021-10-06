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
$councillor_edit = new councillor_edit();

// Run the page
$councillor_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncilloredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcouncilloredit = currentForm = new ew.Form("fcouncilloredit", "edit");

	// Validate form
	fcouncilloredit.validate = function() {
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
			<?php if ($councillor_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->EmployeeID->caption(), $councillor_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->LACode->caption(), $councillor_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->NRC->Required) { ?>
				elm = this.getElements("x" + infix + "_NRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->NRC->caption(), $councillor_edit->NRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->Sex->caption(), $councillor_edit->Sex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->Title->Required) { ?>
				elm = this.getElements("x" + infix + "_Title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->Title->caption(), $councillor_edit->Title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->Surname->caption(), $councillor_edit->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->FirstName->caption(), $councillor_edit->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->MiddleName->caption(), $councillor_edit->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->MaritalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MaritalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->MaritalStatus->caption(), $councillor_edit->MaritalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->DateOfBirth->caption(), $councillor_edit->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_edit->DateOfBirth->errorMessage()) ?>");
			<?php if ($councillor_edit->CouncillorPhoto->Required) { ?>
				felm = this.getElements("x" + infix + "_CouncillorPhoto");
				elm = this.getElements("fn_x" + infix + "_CouncillorPhoto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->CouncillorPhoto->caption(), $councillor_edit->CouncillorPhoto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->AcademicQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_AcademicQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->AcademicQualification->caption(), $councillor_edit->AcademicQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->ProfessionalQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->ProfessionalQualification->caption(), $councillor_edit->ProfessionalQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->PostalAddress->caption(), $councillor_edit->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->TownOrVillage->Required) { ?>
				elm = this.getElements("x" + infix + "_TownOrVillage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->TownOrVillage->caption(), $councillor_edit->TownOrVillage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->Telephone->caption(), $councillor_edit->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->Mobile->caption(), $councillor_edit->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->Fax->caption(), $councillor_edit->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_edit->_Email->caption(), $councillor_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_edit->_Email->errorMessage()) ?>");

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
	fcouncilloredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncilloredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncilloredit.lists["x_LACode"] = <?php echo $councillor_edit->LACode->Lookup->toClientList($councillor_edit) ?>;
	fcouncilloredit.lists["x_LACode"].options = <?php echo JsonEncode($councillor_edit->LACode->lookupOptions()) ?>;
	fcouncilloredit.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncilloredit.lists["x_Sex"] = <?php echo $councillor_edit->Sex->Lookup->toClientList($councillor_edit) ?>;
	fcouncilloredit.lists["x_Sex"].options = <?php echo JsonEncode($councillor_edit->Sex->lookupOptions()) ?>;
	fcouncilloredit.lists["x_Title"] = <?php echo $councillor_edit->Title->Lookup->toClientList($councillor_edit) ?>;
	fcouncilloredit.lists["x_Title"].options = <?php echo JsonEncode($councillor_edit->Title->lookupOptions()) ?>;
	fcouncilloredit.lists["x_MaritalStatus"] = <?php echo $councillor_edit->MaritalStatus->Lookup->toClientList($councillor_edit) ?>;
	fcouncilloredit.lists["x_MaritalStatus"].options = <?php echo JsonEncode($councillor_edit->MaritalStatus->lookupOptions()) ?>;
	fcouncilloredit.lists["x_AcademicQualification"] = <?php echo $councillor_edit->AcademicQualification->Lookup->toClientList($councillor_edit) ?>;
	fcouncilloredit.lists["x_AcademicQualification"].options = <?php echo JsonEncode($councillor_edit->AcademicQualification->lookupOptions()) ?>;
	fcouncilloredit.lists["x_ProfessionalQualification"] = <?php echo $councillor_edit->ProfessionalQualification->Lookup->toClientList($councillor_edit) ?>;
	fcouncilloredit.lists["x_ProfessionalQualification"].options = <?php echo JsonEncode($councillor_edit->ProfessionalQualification->lookupOptions()) ?>;
	loadjs.done("fcouncilloredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillor_edit->showPageHeader(); ?>
<?php
$councillor_edit->showMessage();
?>
<?php if (!$councillor_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillor_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcouncilloredit" id="fcouncilloredit" class="<?php echo $councillor_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$councillor_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($councillor_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_councillor_EmployeeID" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->EmployeeID->caption() ?><?php echo $councillor_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->EmployeeID->cellAttributes() ?>>
<span id="el_councillor_EmployeeID">
<span<?php echo $councillor_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillor_edit->EmployeeID->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="councillor" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" value="<?php echo HtmlEncode($councillor_edit->EmployeeID->CurrentValue) ?>">
<?php echo $councillor_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_councillor_LACode" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->LACode->caption() ?><?php echo $councillor_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->LACode->cellAttributes() ?>>
<span id="el_councillor_LACode">
<?php
$onchange = $councillor_edit->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillor_edit->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($councillor_edit->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillor_edit->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillor_edit->LACode->getPlaceHolder()) ?>"<?php echo $councillor_edit->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_LACode" data-value-separator="<?php echo $councillor_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($councillor_edit->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncilloredit"], function() {
	fcouncilloredit.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $councillor_edit->LACode->Lookup->getParamTag($councillor_edit, "p_x_LACode") ?>
</span>
<?php echo $councillor_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->NRC->Visible) { // NRC ?>
	<div id="r_NRC" class="form-group row">
		<label id="elh_councillor_NRC" for="x_NRC" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->NRC->caption() ?><?php echo $councillor_edit->NRC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->NRC->cellAttributes() ?>>
<span id="el_councillor_NRC">
<input type="text" data-table="councillor" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($councillor_edit->NRC->getPlaceHolder()) ?>" value="<?php echo $councillor_edit->NRC->EditValue ?>"<?php echo $councillor_edit->NRC->editAttributes() ?>>
</span>
<?php echo $councillor_edit->NRC->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->Sex->Visible) { // Sex ?>
	<div id="r_Sex" class="form-group row">
		<label id="elh_councillor_Sex" for="x_Sex" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->Sex->caption() ?><?php echo $councillor_edit->Sex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->Sex->cellAttributes() ?>>
<span id="el_councillor_Sex">
<?php $councillor_edit->Sex->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_Sex" data-value-separator="<?php echo $councillor_edit->Sex->displayValueSeparatorAttribute() ?>" id="x_Sex" name="x_Sex"<?php echo $councillor_edit->Sex->editAttributes() ?>>
			<?php echo $councillor_edit->Sex->selectOptionListHtml("x_Sex") ?>
		</select>
</div>
<?php echo $councillor_edit->Sex->Lookup->getParamTag($councillor_edit, "p_x_Sex") ?>
</span>
<?php echo $councillor_edit->Sex->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label id="elh_councillor_Title" for="x_Title" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->Title->caption() ?><?php echo $councillor_edit->Title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->Title->cellAttributes() ?>>
<span id="el_councillor_Title">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_Title" data-value-separator="<?php echo $councillor_edit->Title->displayValueSeparatorAttribute() ?>" id="x_Title" name="x_Title"<?php echo $councillor_edit->Title->editAttributes() ?>>
			<?php echo $councillor_edit->Title->selectOptionListHtml("x_Title") ?>
		</select>
</div>
<?php echo $councillor_edit->Title->Lookup->getParamTag($councillor_edit, "p_x_Title") ?>
</span>
<?php echo $councillor_edit->Title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label id="elh_councillor_Surname" for="x_Surname" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->Surname->caption() ?><?php echo $councillor_edit->Surname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->Surname->cellAttributes() ?>>
<span id="el_councillor_Surname">
<input type="text" data-table="councillor" data-field="x_Surname" name="x_Surname" id="x_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_edit->Surname->getPlaceHolder()) ?>" value="<?php echo $councillor_edit->Surname->EditValue ?>"<?php echo $councillor_edit->Surname->editAttributes() ?>>
</span>
<?php echo $councillor_edit->Surname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_councillor_FirstName" for="x_FirstName" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->FirstName->caption() ?><?php echo $councillor_edit->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->FirstName->cellAttributes() ?>>
<span id="el_councillor_FirstName">
<input type="text" data-table="councillor" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_edit->FirstName->getPlaceHolder()) ?>" value="<?php echo $councillor_edit->FirstName->EditValue ?>"<?php echo $councillor_edit->FirstName->editAttributes() ?>>
</span>
<?php echo $councillor_edit->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label id="elh_councillor_MiddleName" for="x_MiddleName" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->MiddleName->caption() ?><?php echo $councillor_edit->MiddleName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->MiddleName->cellAttributes() ?>>
<span id="el_councillor_MiddleName">
<input type="text" data-table="councillor" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_edit->MiddleName->getPlaceHolder()) ?>" value="<?php echo $councillor_edit->MiddleName->EditValue ?>"<?php echo $councillor_edit->MiddleName->editAttributes() ?>>
</span>
<?php echo $councillor_edit->MiddleName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->MaritalStatus->Visible) { // MaritalStatus ?>
	<div id="r_MaritalStatus" class="form-group row">
		<label id="elh_councillor_MaritalStatus" for="x_MaritalStatus" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->MaritalStatus->caption() ?><?php echo $councillor_edit->MaritalStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->MaritalStatus->cellAttributes() ?>>
<span id="el_councillor_MaritalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_MaritalStatus" data-value-separator="<?php echo $councillor_edit->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x_MaritalStatus" name="x_MaritalStatus"<?php echo $councillor_edit->MaritalStatus->editAttributes() ?>>
			<?php echo $councillor_edit->MaritalStatus->selectOptionListHtml("x_MaritalStatus") ?>
		</select>
</div>
<?php echo $councillor_edit->MaritalStatus->Lookup->getParamTag($councillor_edit, "p_x_MaritalStatus") ?>
</span>
<?php echo $councillor_edit->MaritalStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label id="elh_councillor_DateOfBirth" for="x_DateOfBirth" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->DateOfBirth->caption() ?><?php echo $councillor_edit->DateOfBirth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->DateOfBirth->cellAttributes() ?>>
<span id="el_councillor_DateOfBirth">
<input type="text" data-table="councillor" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" placeholder="<?php echo HtmlEncode($councillor_edit->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $councillor_edit->DateOfBirth->EditValue ?>"<?php echo $councillor_edit->DateOfBirth->editAttributes() ?>>
<?php if (!$councillor_edit->DateOfBirth->ReadOnly && !$councillor_edit->DateOfBirth->Disabled && !isset($councillor_edit->DateOfBirth->EditAttrs["readonly"]) && !isset($councillor_edit->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncilloredit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncilloredit", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $councillor_edit->DateOfBirth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->CouncillorPhoto->Visible) { // CouncillorPhoto ?>
	<div id="r_CouncillorPhoto" class="form-group row">
		<label id="elh_councillor_CouncillorPhoto" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->CouncillorPhoto->caption() ?><?php echo $councillor_edit->CouncillorPhoto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->CouncillorPhoto->cellAttributes() ?>>
<span id="el_councillor_CouncillorPhoto">
<div id="fd_x_CouncillorPhoto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $councillor_edit->CouncillorPhoto->title() ?>" data-table="councillor" data-field="x_CouncillorPhoto" name="x_CouncillorPhoto" id="x_CouncillorPhoto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $councillor_edit->CouncillorPhoto->editAttributes() ?><?php if ($councillor_edit->CouncillorPhoto->ReadOnly || $councillor_edit->CouncillorPhoto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_CouncillorPhoto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_CouncillorPhoto" id= "fn_x_CouncillorPhoto" value="<?php echo $councillor_edit->CouncillorPhoto->Upload->FileName ?>">
<input type="hidden" name="fa_x_CouncillorPhoto" id= "fa_x_CouncillorPhoto" value="<?php echo (Post("fa_x_CouncillorPhoto") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_CouncillorPhoto" id= "fs_x_CouncillorPhoto" value="0">
<input type="hidden" name="fx_x_CouncillorPhoto" id= "fx_x_CouncillorPhoto" value="<?php echo $councillor_edit->CouncillorPhoto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_CouncillorPhoto" id= "fm_x_CouncillorPhoto" value="<?php echo $councillor_edit->CouncillorPhoto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_CouncillorPhoto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $councillor_edit->CouncillorPhoto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->AcademicQualification->Visible) { // AcademicQualification ?>
	<div id="r_AcademicQualification" class="form-group row">
		<label id="elh_councillor_AcademicQualification" for="x_AcademicQualification" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->AcademicQualification->caption() ?><?php echo $councillor_edit->AcademicQualification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->AcademicQualification->cellAttributes() ?>>
<span id="el_councillor_AcademicQualification">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_AcademicQualification" data-value-separator="<?php echo $councillor_edit->AcademicQualification->displayValueSeparatorAttribute() ?>" id="x_AcademicQualification" name="x_AcademicQualification"<?php echo $councillor_edit->AcademicQualification->editAttributes() ?>>
			<?php echo $councillor_edit->AcademicQualification->selectOptionListHtml("x_AcademicQualification") ?>
		</select>
</div>
<?php echo $councillor_edit->AcademicQualification->Lookup->getParamTag($councillor_edit, "p_x_AcademicQualification") ?>
</span>
<?php echo $councillor_edit->AcademicQualification->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
	<div id="r_ProfessionalQualification" class="form-group row">
		<label id="elh_councillor_ProfessionalQualification" for="x_ProfessionalQualification" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->ProfessionalQualification->caption() ?><?php echo $councillor_edit->ProfessionalQualification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->ProfessionalQualification->cellAttributes() ?>>
<span id="el_councillor_ProfessionalQualification">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_ProfessionalQualification" data-value-separator="<?php echo $councillor_edit->ProfessionalQualification->displayValueSeparatorAttribute() ?>" id="x_ProfessionalQualification" name="x_ProfessionalQualification"<?php echo $councillor_edit->ProfessionalQualification->editAttributes() ?>>
			<?php echo $councillor_edit->ProfessionalQualification->selectOptionListHtml("x_ProfessionalQualification") ?>
		</select>
</div>
<?php echo $councillor_edit->ProfessionalQualification->Lookup->getParamTag($councillor_edit, "p_x_ProfessionalQualification") ?>
</span>
<?php echo $councillor_edit->ProfessionalQualification->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label id="elh_councillor_PostalAddress" for="x_PostalAddress" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->PostalAddress->caption() ?><?php echo $councillor_edit->PostalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->PostalAddress->cellAttributes() ?>>
<span id="el_councillor_PostalAddress">
<input type="text" data-table="councillor" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_edit->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $councillor_edit->PostalAddress->EditValue ?>"<?php echo $councillor_edit->PostalAddress->editAttributes() ?>>
</span>
<?php echo $councillor_edit->PostalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label id="elh_councillor_TownOrVillage" for="x_TownOrVillage" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->TownOrVillage->caption() ?><?php echo $councillor_edit->TownOrVillage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->TownOrVillage->cellAttributes() ?>>
<span id="el_councillor_TownOrVillage">
<input type="text" data-table="councillor" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_edit->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $councillor_edit->TownOrVillage->EditValue ?>"<?php echo $councillor_edit->TownOrVillage->editAttributes() ?>>
</span>
<?php echo $councillor_edit->TownOrVillage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_councillor_Telephone" for="x_Telephone" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->Telephone->caption() ?><?php echo $councillor_edit->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->Telephone->cellAttributes() ?>>
<span id="el_councillor_Telephone">
<input type="text" data-table="councillor" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_edit->Telephone->getPlaceHolder()) ?>" value="<?php echo $councillor_edit->Telephone->EditValue ?>"<?php echo $councillor_edit->Telephone->editAttributes() ?>>
</span>
<?php echo $councillor_edit->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_councillor_Mobile" for="x_Mobile" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->Mobile->caption() ?><?php echo $councillor_edit->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->Mobile->cellAttributes() ?>>
<span id="el_councillor_Mobile">
<input type="text" data-table="councillor" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_edit->Mobile->getPlaceHolder()) ?>" value="<?php echo $councillor_edit->Mobile->EditValue ?>"<?php echo $councillor_edit->Mobile->editAttributes() ?>>
</span>
<?php echo $councillor_edit->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_councillor_Fax" for="x_Fax" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->Fax->caption() ?><?php echo $councillor_edit->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->Fax->cellAttributes() ?>>
<span id="el_councillor_Fax">
<input type="text" data-table="councillor" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($councillor_edit->Fax->getPlaceHolder()) ?>" value="<?php echo $councillor_edit->Fax->EditValue ?>"<?php echo $councillor_edit->Fax->editAttributes() ?>>
</span>
<?php echo $councillor_edit->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_councillor__Email" for="x__Email" class="<?php echo $councillor_edit->LeftColumnClass ?>"><?php echo $councillor_edit->_Email->caption() ?><?php echo $councillor_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_edit->RightColumnClass ?>"><div <?php echo $councillor_edit->_Email->cellAttributes() ?>>
<span id="el_councillor__Email">
<input type="text" data-table="councillor" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $councillor_edit->_Email->EditValue ?>"<?php echo $councillor_edit->_Email->editAttributes() ?>>
</span>
<?php echo $councillor_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("councillorship", explode(",", $councillor->getCurrentDetailTable())) && $councillorship->DetailEdit) {
?>
<?php if ($councillor->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("councillorship", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "councillorshipgrid.php" ?>
<?php } ?>
<?php if (!$councillor_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillor_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillor_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$councillor_edit->IsModal) { ?>
<?php echo $councillor_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$councillor_edit->showPageFooter();
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
$councillor_edit->terminate();
?>