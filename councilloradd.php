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
$councillor_add = new councillor_add();

// Run the page
$councillor_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncilloradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcouncilloradd = currentForm = new ew.Form("fcouncilloradd", "add");

	// Validate form
	fcouncilloradd.validate = function() {
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
			<?php if ($councillor_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->LACode->caption(), $councillor_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->NRC->Required) { ?>
				elm = this.getElements("x" + infix + "_NRC");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->NRC->caption(), $councillor_add->NRC->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->Sex->caption(), $councillor_add->Sex->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->Title->Required) { ?>
				elm = this.getElements("x" + infix + "_Title");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->Title->caption(), $councillor_add->Title->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->Surname->caption(), $councillor_add->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->FirstName->caption(), $councillor_add->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->MiddleName->caption(), $councillor_add->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->MaritalStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_MaritalStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->MaritalStatus->caption(), $councillor_add->MaritalStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->DateOfBirth->caption(), $councillor_add->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_add->DateOfBirth->errorMessage()) ?>");
			<?php if ($councillor_add->CouncillorPhoto->Required) { ?>
				felm = this.getElements("x" + infix + "_CouncillorPhoto");
				elm = this.getElements("fn_x" + infix + "_CouncillorPhoto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $councillor_add->CouncillorPhoto->caption(), $councillor_add->CouncillorPhoto->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->AcademicQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_AcademicQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->AcademicQualification->caption(), $councillor_add->AcademicQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->ProfessionalQualification->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfessionalQualification");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->ProfessionalQualification->caption(), $councillor_add->ProfessionalQualification->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->PostalAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_PostalAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->PostalAddress->caption(), $councillor_add->PostalAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->TownOrVillage->Required) { ?>
				elm = this.getElements("x" + infix + "_TownOrVillage");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->TownOrVillage->caption(), $councillor_add->TownOrVillage->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->Telephone->caption(), $councillor_add->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->Mobile->Required) { ?>
				elm = this.getElements("x" + infix + "_Mobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->Mobile->caption(), $councillor_add->Mobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->Fax->Required) { ?>
				elm = this.getElements("x" + infix + "_Fax");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->Fax->caption(), $councillor_add->Fax->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_add->_Email->caption(), $councillor_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_add->_Email->errorMessage()) ?>");

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
	fcouncilloradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncilloradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncilloradd.lists["x_LACode"] = <?php echo $councillor_add->LACode->Lookup->toClientList($councillor_add) ?>;
	fcouncilloradd.lists["x_LACode"].options = <?php echo JsonEncode($councillor_add->LACode->lookupOptions()) ?>;
	fcouncilloradd.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fcouncilloradd.lists["x_Sex"] = <?php echo $councillor_add->Sex->Lookup->toClientList($councillor_add) ?>;
	fcouncilloradd.lists["x_Sex"].options = <?php echo JsonEncode($councillor_add->Sex->lookupOptions()) ?>;
	fcouncilloradd.lists["x_Title"] = <?php echo $councillor_add->Title->Lookup->toClientList($councillor_add) ?>;
	fcouncilloradd.lists["x_Title"].options = <?php echo JsonEncode($councillor_add->Title->lookupOptions()) ?>;
	fcouncilloradd.lists["x_MaritalStatus"] = <?php echo $councillor_add->MaritalStatus->Lookup->toClientList($councillor_add) ?>;
	fcouncilloradd.lists["x_MaritalStatus"].options = <?php echo JsonEncode($councillor_add->MaritalStatus->lookupOptions()) ?>;
	fcouncilloradd.lists["x_AcademicQualification"] = <?php echo $councillor_add->AcademicQualification->Lookup->toClientList($councillor_add) ?>;
	fcouncilloradd.lists["x_AcademicQualification"].options = <?php echo JsonEncode($councillor_add->AcademicQualification->lookupOptions()) ?>;
	fcouncilloradd.lists["x_ProfessionalQualification"] = <?php echo $councillor_add->ProfessionalQualification->Lookup->toClientList($councillor_add) ?>;
	fcouncilloradd.lists["x_ProfessionalQualification"].options = <?php echo JsonEncode($councillor_add->ProfessionalQualification->lookupOptions()) ?>;
	loadjs.done("fcouncilloradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillor_add->showPageHeader(); ?>
<?php
$councillor_add->showMessage();
?>
<form name="fcouncilloradd" id="fcouncilloradd" class="<?php echo $councillor_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$councillor_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($councillor_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_councillor_LACode" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->LACode->caption() ?><?php echo $councillor_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->LACode->cellAttributes() ?>>
<span id="el_councillor_LACode">
<?php
$onchange = $councillor_add->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$councillor_add->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($councillor_add->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($councillor_add->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($councillor_add->LACode->getPlaceHolder()) ?>"<?php echo $councillor_add->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="councillor" data-field="x_LACode" data-value-separator="<?php echo $councillor_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($councillor_add->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fcouncilloradd"], function() {
	fcouncilloradd.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $councillor_add->LACode->Lookup->getParamTag($councillor_add, "p_x_LACode") ?>
</span>
<?php echo $councillor_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->NRC->Visible) { // NRC ?>
	<div id="r_NRC" class="form-group row">
		<label id="elh_councillor_NRC" for="x_NRC" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->NRC->caption() ?><?php echo $councillor_add->NRC->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->NRC->cellAttributes() ?>>
<span id="el_councillor_NRC">
<input type="text" data-table="councillor" data-field="x_NRC" name="x_NRC" id="x_NRC" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($councillor_add->NRC->getPlaceHolder()) ?>" value="<?php echo $councillor_add->NRC->EditValue ?>"<?php echo $councillor_add->NRC->editAttributes() ?>>
</span>
<?php echo $councillor_add->NRC->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->Sex->Visible) { // Sex ?>
	<div id="r_Sex" class="form-group row">
		<label id="elh_councillor_Sex" for="x_Sex" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->Sex->caption() ?><?php echo $councillor_add->Sex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->Sex->cellAttributes() ?>>
<span id="el_councillor_Sex">
<?php $councillor_add->Sex->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_Sex" data-value-separator="<?php echo $councillor_add->Sex->displayValueSeparatorAttribute() ?>" id="x_Sex" name="x_Sex"<?php echo $councillor_add->Sex->editAttributes() ?>>
			<?php echo $councillor_add->Sex->selectOptionListHtml("x_Sex") ?>
		</select>
</div>
<?php echo $councillor_add->Sex->Lookup->getParamTag($councillor_add, "p_x_Sex") ?>
</span>
<?php echo $councillor_add->Sex->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->Title->Visible) { // Title ?>
	<div id="r_Title" class="form-group row">
		<label id="elh_councillor_Title" for="x_Title" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->Title->caption() ?><?php echo $councillor_add->Title->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->Title->cellAttributes() ?>>
<span id="el_councillor_Title">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_Title" data-value-separator="<?php echo $councillor_add->Title->displayValueSeparatorAttribute() ?>" id="x_Title" name="x_Title"<?php echo $councillor_add->Title->editAttributes() ?>>
			<?php echo $councillor_add->Title->selectOptionListHtml("x_Title") ?>
		</select>
</div>
<?php echo $councillor_add->Title->Lookup->getParamTag($councillor_add, "p_x_Title") ?>
</span>
<?php echo $councillor_add->Title->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label id="elh_councillor_Surname" for="x_Surname" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->Surname->caption() ?><?php echo $councillor_add->Surname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->Surname->cellAttributes() ?>>
<span id="el_councillor_Surname">
<input type="text" data-table="councillor" data-field="x_Surname" name="x_Surname" id="x_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_add->Surname->getPlaceHolder()) ?>" value="<?php echo $councillor_add->Surname->EditValue ?>"<?php echo $councillor_add->Surname->editAttributes() ?>>
</span>
<?php echo $councillor_add->Surname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_councillor_FirstName" for="x_FirstName" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->FirstName->caption() ?><?php echo $councillor_add->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->FirstName->cellAttributes() ?>>
<span id="el_councillor_FirstName">
<input type="text" data-table="councillor" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_add->FirstName->getPlaceHolder()) ?>" value="<?php echo $councillor_add->FirstName->EditValue ?>"<?php echo $councillor_add->FirstName->editAttributes() ?>>
</span>
<?php echo $councillor_add->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label id="elh_councillor_MiddleName" for="x_MiddleName" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->MiddleName->caption() ?><?php echo $councillor_add->MiddleName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->MiddleName->cellAttributes() ?>>
<span id="el_councillor_MiddleName">
<input type="text" data-table="councillor" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($councillor_add->MiddleName->getPlaceHolder()) ?>" value="<?php echo $councillor_add->MiddleName->EditValue ?>"<?php echo $councillor_add->MiddleName->editAttributes() ?>>
</span>
<?php echo $councillor_add->MiddleName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->MaritalStatus->Visible) { // MaritalStatus ?>
	<div id="r_MaritalStatus" class="form-group row">
		<label id="elh_councillor_MaritalStatus" for="x_MaritalStatus" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->MaritalStatus->caption() ?><?php echo $councillor_add->MaritalStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->MaritalStatus->cellAttributes() ?>>
<span id="el_councillor_MaritalStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_MaritalStatus" data-value-separator="<?php echo $councillor_add->MaritalStatus->displayValueSeparatorAttribute() ?>" id="x_MaritalStatus" name="x_MaritalStatus"<?php echo $councillor_add->MaritalStatus->editAttributes() ?>>
			<?php echo $councillor_add->MaritalStatus->selectOptionListHtml("x_MaritalStatus") ?>
		</select>
</div>
<?php echo $councillor_add->MaritalStatus->Lookup->getParamTag($councillor_add, "p_x_MaritalStatus") ?>
</span>
<?php echo $councillor_add->MaritalStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label id="elh_councillor_DateOfBirth" for="x_DateOfBirth" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->DateOfBirth->caption() ?><?php echo $councillor_add->DateOfBirth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->DateOfBirth->cellAttributes() ?>>
<span id="el_councillor_DateOfBirth">
<input type="text" data-table="councillor" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" placeholder="<?php echo HtmlEncode($councillor_add->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $councillor_add->DateOfBirth->EditValue ?>"<?php echo $councillor_add->DateOfBirth->editAttributes() ?>>
<?php if (!$councillor_add->DateOfBirth->ReadOnly && !$councillor_add->DateOfBirth->Disabled && !isset($councillor_add->DateOfBirth->EditAttrs["readonly"]) && !isset($councillor_add->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcouncilloradd", "datetimepicker"], function() {
	ew.createDateTimePicker("fcouncilloradd", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $councillor_add->DateOfBirth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->CouncillorPhoto->Visible) { // CouncillorPhoto ?>
	<div id="r_CouncillorPhoto" class="form-group row">
		<label id="elh_councillor_CouncillorPhoto" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->CouncillorPhoto->caption() ?><?php echo $councillor_add->CouncillorPhoto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->CouncillorPhoto->cellAttributes() ?>>
<span id="el_councillor_CouncillorPhoto">
<div id="fd_x_CouncillorPhoto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $councillor_add->CouncillorPhoto->title() ?>" data-table="councillor" data-field="x_CouncillorPhoto" name="x_CouncillorPhoto" id="x_CouncillorPhoto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $councillor_add->CouncillorPhoto->editAttributes() ?><?php if ($councillor_add->CouncillorPhoto->ReadOnly || $councillor_add->CouncillorPhoto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_CouncillorPhoto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_CouncillorPhoto" id= "fn_x_CouncillorPhoto" value="<?php echo $councillor_add->CouncillorPhoto->Upload->FileName ?>">
<input type="hidden" name="fa_x_CouncillorPhoto" id= "fa_x_CouncillorPhoto" value="0">
<input type="hidden" name="fs_x_CouncillorPhoto" id= "fs_x_CouncillorPhoto" value="0">
<input type="hidden" name="fx_x_CouncillorPhoto" id= "fx_x_CouncillorPhoto" value="<?php echo $councillor_add->CouncillorPhoto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_CouncillorPhoto" id= "fm_x_CouncillorPhoto" value="<?php echo $councillor_add->CouncillorPhoto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_CouncillorPhoto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $councillor_add->CouncillorPhoto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->AcademicQualification->Visible) { // AcademicQualification ?>
	<div id="r_AcademicQualification" class="form-group row">
		<label id="elh_councillor_AcademicQualification" for="x_AcademicQualification" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->AcademicQualification->caption() ?><?php echo $councillor_add->AcademicQualification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->AcademicQualification->cellAttributes() ?>>
<span id="el_councillor_AcademicQualification">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_AcademicQualification" data-value-separator="<?php echo $councillor_add->AcademicQualification->displayValueSeparatorAttribute() ?>" id="x_AcademicQualification" name="x_AcademicQualification"<?php echo $councillor_add->AcademicQualification->editAttributes() ?>>
			<?php echo $councillor_add->AcademicQualification->selectOptionListHtml("x_AcademicQualification") ?>
		</select>
</div>
<?php echo $councillor_add->AcademicQualification->Lookup->getParamTag($councillor_add, "p_x_AcademicQualification") ?>
</span>
<?php echo $councillor_add->AcademicQualification->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->ProfessionalQualification->Visible) { // ProfessionalQualification ?>
	<div id="r_ProfessionalQualification" class="form-group row">
		<label id="elh_councillor_ProfessionalQualification" for="x_ProfessionalQualification" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->ProfessionalQualification->caption() ?><?php echo $councillor_add->ProfessionalQualification->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->ProfessionalQualification->cellAttributes() ?>>
<span id="el_councillor_ProfessionalQualification">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor" data-field="x_ProfessionalQualification" data-value-separator="<?php echo $councillor_add->ProfessionalQualification->displayValueSeparatorAttribute() ?>" id="x_ProfessionalQualification" name="x_ProfessionalQualification"<?php echo $councillor_add->ProfessionalQualification->editAttributes() ?>>
			<?php echo $councillor_add->ProfessionalQualification->selectOptionListHtml("x_ProfessionalQualification") ?>
		</select>
</div>
<?php echo $councillor_add->ProfessionalQualification->Lookup->getParamTag($councillor_add, "p_x_ProfessionalQualification") ?>
</span>
<?php echo $councillor_add->ProfessionalQualification->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->PostalAddress->Visible) { // PostalAddress ?>
	<div id="r_PostalAddress" class="form-group row">
		<label id="elh_councillor_PostalAddress" for="x_PostalAddress" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->PostalAddress->caption() ?><?php echo $councillor_add->PostalAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->PostalAddress->cellAttributes() ?>>
<span id="el_councillor_PostalAddress">
<input type="text" data-table="councillor" data-field="x_PostalAddress" name="x_PostalAddress" id="x_PostalAddress" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_add->PostalAddress->getPlaceHolder()) ?>" value="<?php echo $councillor_add->PostalAddress->EditValue ?>"<?php echo $councillor_add->PostalAddress->editAttributes() ?>>
</span>
<?php echo $councillor_add->PostalAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->TownOrVillage->Visible) { // TownOrVillage ?>
	<div id="r_TownOrVillage" class="form-group row">
		<label id="elh_councillor_TownOrVillage" for="x_TownOrVillage" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->TownOrVillage->caption() ?><?php echo $councillor_add->TownOrVillage->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->TownOrVillage->cellAttributes() ?>>
<span id="el_councillor_TownOrVillage">
<input type="text" data-table="councillor" data-field="x_TownOrVillage" name="x_TownOrVillage" id="x_TownOrVillage" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_add->TownOrVillage->getPlaceHolder()) ?>" value="<?php echo $councillor_add->TownOrVillage->EditValue ?>"<?php echo $councillor_add->TownOrVillage->editAttributes() ?>>
</span>
<?php echo $councillor_add->TownOrVillage->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_councillor_Telephone" for="x_Telephone" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->Telephone->caption() ?><?php echo $councillor_add->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->Telephone->cellAttributes() ?>>
<span id="el_councillor_Telephone">
<input type="text" data-table="councillor" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_add->Telephone->getPlaceHolder()) ?>" value="<?php echo $councillor_add->Telephone->EditValue ?>"<?php echo $councillor_add->Telephone->editAttributes() ?>>
</span>
<?php echo $councillor_add->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->Mobile->Visible) { // Mobile ?>
	<div id="r_Mobile" class="form-group row">
		<label id="elh_councillor_Mobile" for="x_Mobile" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->Mobile->caption() ?><?php echo $councillor_add->Mobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->Mobile->cellAttributes() ?>>
<span id="el_councillor_Mobile">
<input type="text" data-table="councillor" data-field="x_Mobile" name="x_Mobile" id="x_Mobile" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_add->Mobile->getPlaceHolder()) ?>" value="<?php echo $councillor_add->Mobile->EditValue ?>"<?php echo $councillor_add->Mobile->editAttributes() ?>>
</span>
<?php echo $councillor_add->Mobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->Fax->Visible) { // Fax ?>
	<div id="r_Fax" class="form-group row">
		<label id="elh_councillor_Fax" for="x_Fax" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->Fax->caption() ?><?php echo $councillor_add->Fax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->Fax->cellAttributes() ?>>
<span id="el_councillor_Fax">
<input type="text" data-table="councillor" data-field="x_Fax" name="x_Fax" id="x_Fax" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($councillor_add->Fax->getPlaceHolder()) ?>" value="<?php echo $councillor_add->Fax->EditValue ?>"<?php echo $councillor_add->Fax->editAttributes() ?>>
</span>
<?php echo $councillor_add->Fax->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_councillor__Email" for="x__Email" class="<?php echo $councillor_add->LeftColumnClass ?>"><?php echo $councillor_add->_Email->caption() ?><?php echo $councillor_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_add->RightColumnClass ?>"><div <?php echo $councillor_add->_Email->cellAttributes() ?>>
<span id="el_councillor__Email">
<input type="text" data-table="councillor" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($councillor_add->_Email->getPlaceHolder()) ?>" value="<?php echo $councillor_add->_Email->EditValue ?>"<?php echo $councillor_add->_Email->editAttributes() ?>>
</span>
<?php echo $councillor_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("councillorship", explode(",", $councillor->getCurrentDetailTable())) && $councillorship->DetailAdd) {
?>
<?php if ($councillor->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("councillorship", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "councillorshipgrid.php" ?>
<?php } ?>
<?php if (!$councillor_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillor_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillor_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$councillor_add->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	$(document).ready(function(){$("#x_NRC").mask("999999/99/9")});
});
</script>
<?php include_once "footer.php"; ?>
<?php
$councillor_add->terminate();
?>