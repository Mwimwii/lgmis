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
$staffqualifications_prof_edit = new staffqualifications_prof_edit();

// Run the page
$staffqualifications_prof_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffqualifications_prof_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffqualifications_profedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fstaffqualifications_profedit = currentForm = new ew.Form("fstaffqualifications_profedit", "edit");

	// Validate form
	fstaffqualifications_profedit.validate = function() {
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
			<?php if ($staffqualifications_prof_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_edit->EmployeeID->caption(), $staffqualifications_prof_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_prof_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($staffqualifications_prof_edit->ProfQualificationLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_ProfQualificationLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_edit->ProfQualificationLevel->caption(), $staffqualifications_prof_edit->ProfQualificationLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_prof_edit->QualificationCode->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_edit->QualificationCode->caption(), $staffqualifications_prof_edit->QualificationCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_prof_edit->QualificationRemarks->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationRemarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_edit->QualificationRemarks->caption(), $staffqualifications_prof_edit->QualificationRemarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_prof_edit->AwardingInstitution->Required) { ?>
				elm = this.getElements("x" + infix + "_AwardingInstitution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_edit->AwardingInstitution->caption(), $staffqualifications_prof_edit->AwardingInstitution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_prof_edit->FromYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_edit->FromYear->caption(), $staffqualifications_prof_edit->FromYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_prof_edit->FromYear->errorMessage()) ?>");
			<?php if ($staffqualifications_prof_edit->YearObtained->Required) { ?>
				elm = this.getElements("x" + infix + "_YearObtained");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_edit->YearObtained->caption(), $staffqualifications_prof_edit->YearObtained->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_YearObtained");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_prof_edit->YearObtained->errorMessage()) ?>");
			<?php if ($staffqualifications_prof_edit->ProfessionalCertificate->Required) { ?>
				felm = this.getElements("x" + infix + "_ProfessionalCertificate");
				elm = this.getElements("fn_x" + infix + "_ProfessionalCertificate");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_prof_edit->ProfessionalCertificate->caption(), $staffqualifications_prof_edit->ProfessionalCertificate->RequiredErrorMessage)) ?>");
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
	fstaffqualifications_profedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffqualifications_profedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffqualifications_profedit.lists["x_ProfQualificationLevel"] = <?php echo $staffqualifications_prof_edit->ProfQualificationLevel->Lookup->toClientList($staffqualifications_prof_edit) ?>;
	fstaffqualifications_profedit.lists["x_ProfQualificationLevel"].options = <?php echo JsonEncode($staffqualifications_prof_edit->ProfQualificationLevel->lookupOptions()) ?>;
	fstaffqualifications_profedit.lists["x_QualificationCode"] = <?php echo $staffqualifications_prof_edit->QualificationCode->Lookup->toClientList($staffqualifications_prof_edit) ?>;
	fstaffqualifications_profedit.lists["x_QualificationCode"].options = <?php echo JsonEncode($staffqualifications_prof_edit->QualificationCode->lookupOptions()) ?>;
	loadjs.done("fstaffqualifications_profedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffqualifications_prof_edit->showPageHeader(); ?>
<?php
$staffqualifications_prof_edit->showMessage();
?>
<?php if (!$staffqualifications_prof_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffqualifications_prof_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fstaffqualifications_profedit" id="fstaffqualifications_profedit" class="<?php echo $staffqualifications_prof_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffqualifications_prof">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$staffqualifications_prof_edit->IsModal ?>">
<?php if ($staffqualifications_prof->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_prof_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($staffqualifications_prof_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffqualifications_prof_EmployeeID" for="x_EmployeeID" class="<?php echo $staffqualifications_prof_edit->LeftColumnClass ?>"><?php echo $staffqualifications_prof_edit->EmployeeID->caption() ?><?php echo $staffqualifications_prof_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_prof_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_edit->EmployeeID->cellAttributes() ?>>
<?php if ($staffqualifications_prof_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_staffqualifications_prof_EmployeeID">
<span<?php echo $staffqualifications_prof_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_prof_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_prof_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="staffqualifications_prof" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_prof_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_edit->EmployeeID->EditValue ?>"<?php echo $staffqualifications_prof_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="staffqualifications_prof" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_prof_edit->EmployeeID->OldValue != null ? $staffqualifications_prof_edit->EmployeeID->OldValue : $staffqualifications_prof_edit->EmployeeID->CurrentValue) ?>">
<?php echo $staffqualifications_prof_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_edit->ProfQualificationLevel->Visible) { // ProfQualificationLevel ?>
	<div id="r_ProfQualificationLevel" class="form-group row">
		<label id="elh_staffqualifications_prof_ProfQualificationLevel" for="x_ProfQualificationLevel" class="<?php echo $staffqualifications_prof_edit->LeftColumnClass ?>"><?php echo $staffqualifications_prof_edit->ProfQualificationLevel->caption() ?><?php echo $staffqualifications_prof_edit->ProfQualificationLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_prof_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_edit->ProfQualificationLevel->cellAttributes() ?>>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ProfQualificationLevel"><?php echo EmptyValue(strval($staffqualifications_prof_edit->ProfQualificationLevel->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_prof_edit->ProfQualificationLevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_prof_edit->ProfQualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_prof_edit->ProfQualificationLevel->ReadOnly || $staffqualifications_prof_edit->ProfQualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ProfQualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_prof_edit->ProfQualificationLevel->Lookup->getParamTag($staffqualifications_prof_edit, "p_x_ProfQualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_prof_edit->ProfQualificationLevel->displayValueSeparatorAttribute() ?>" name="x_ProfQualificationLevel" id="x_ProfQualificationLevel" value="<?php echo $staffqualifications_prof_edit->ProfQualificationLevel->CurrentValue ?>"<?php echo $staffqualifications_prof_edit->ProfQualificationLevel->editAttributes() ?>>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_ProfQualificationLevel" name="o_ProfQualificationLevel" id="o_ProfQualificationLevel" value="<?php echo HtmlEncode($staffqualifications_prof_edit->ProfQualificationLevel->OldValue != null ? $staffqualifications_prof_edit->ProfQualificationLevel->OldValue : $staffqualifications_prof_edit->ProfQualificationLevel->CurrentValue) ?>">
<?php echo $staffqualifications_prof_edit->ProfQualificationLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_edit->QualificationCode->Visible) { // QualificationCode ?>
	<div id="r_QualificationCode" class="form-group row">
		<label id="elh_staffqualifications_prof_QualificationCode" for="x_QualificationCode" class="<?php echo $staffqualifications_prof_edit->LeftColumnClass ?>"><?php echo $staffqualifications_prof_edit->QualificationCode->caption() ?><?php echo $staffqualifications_prof_edit->QualificationCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_prof_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_edit->QualificationCode->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffqualifications_prof" data-field="x_QualificationCode" data-value-separator="<?php echo $staffqualifications_prof_edit->QualificationCode->displayValueSeparatorAttribute() ?>" id="x_QualificationCode" name="x_QualificationCode"<?php echo $staffqualifications_prof_edit->QualificationCode->editAttributes() ?>>
			<?php echo $staffqualifications_prof_edit->QualificationCode->selectOptionListHtml("x_QualificationCode") ?>
		</select>
</div>
<?php echo $staffqualifications_prof_edit->QualificationCode->Lookup->getParamTag($staffqualifications_prof_edit, "p_x_QualificationCode") ?>
<input type="hidden" data-table="staffqualifications_prof" data-field="x_QualificationCode" name="o_QualificationCode" id="o_QualificationCode" value="<?php echo HtmlEncode($staffqualifications_prof_edit->QualificationCode->OldValue != null ? $staffqualifications_prof_edit->QualificationCode->OldValue : $staffqualifications_prof_edit->QualificationCode->CurrentValue) ?>">
<?php echo $staffqualifications_prof_edit->QualificationCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_edit->QualificationRemarks->Visible) { // QualificationRemarks ?>
	<div id="r_QualificationRemarks" class="form-group row">
		<label id="elh_staffqualifications_prof_QualificationRemarks" for="x_QualificationRemarks" class="<?php echo $staffqualifications_prof_edit->LeftColumnClass ?>"><?php echo $staffqualifications_prof_edit->QualificationRemarks->caption() ?><?php echo $staffqualifications_prof_edit->QualificationRemarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_prof_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_edit->QualificationRemarks->cellAttributes() ?>>
<span id="el_staffqualifications_prof_QualificationRemarks">
<input type="text" data-table="staffqualifications_prof" data-field="x_QualificationRemarks" name="x_QualificationRemarks" id="x_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_prof_edit->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_edit->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_prof_edit->QualificationRemarks->editAttributes() ?>>
</span>
<?php echo $staffqualifications_prof_edit->QualificationRemarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_edit->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<div id="r_AwardingInstitution" class="form-group row">
		<label id="elh_staffqualifications_prof_AwardingInstitution" for="x_AwardingInstitution" class="<?php echo $staffqualifications_prof_edit->LeftColumnClass ?>"><?php echo $staffqualifications_prof_edit->AwardingInstitution->caption() ?><?php echo $staffqualifications_prof_edit->AwardingInstitution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_prof_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_edit->AwardingInstitution->cellAttributes() ?>>
<span id="el_staffqualifications_prof_AwardingInstitution">
<input type="text" data-table="staffqualifications_prof" data-field="x_AwardingInstitution" name="x_AwardingInstitution" id="x_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_prof_edit->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_edit->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_prof_edit->AwardingInstitution->editAttributes() ?>>
</span>
<?php echo $staffqualifications_prof_edit->AwardingInstitution->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_edit->FromYear->Visible) { // FromYear ?>
	<div id="r_FromYear" class="form-group row">
		<label id="elh_staffqualifications_prof_FromYear" for="x_FromYear" class="<?php echo $staffqualifications_prof_edit->LeftColumnClass ?>"><?php echo $staffqualifications_prof_edit->FromYear->caption() ?><?php echo $staffqualifications_prof_edit->FromYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_prof_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_edit->FromYear->cellAttributes() ?>>
<span id="el_staffqualifications_prof_FromYear">
<input type="text" data-table="staffqualifications_prof" data-field="x_FromYear" name="x_FromYear" id="x_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_prof_edit->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_edit->FromYear->EditValue ?>"<?php echo $staffqualifications_prof_edit->FromYear->editAttributes() ?>>
</span>
<?php echo $staffqualifications_prof_edit->FromYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_edit->YearObtained->Visible) { // YearObtained ?>
	<div id="r_YearObtained" class="form-group row">
		<label id="elh_staffqualifications_prof_YearObtained" for="x_YearObtained" class="<?php echo $staffqualifications_prof_edit->LeftColumnClass ?>"><?php echo $staffqualifications_prof_edit->YearObtained->caption() ?><?php echo $staffqualifications_prof_edit->YearObtained->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_prof_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_edit->YearObtained->cellAttributes() ?>>
<span id="el_staffqualifications_prof_YearObtained">
<input type="text" data-table="staffqualifications_prof" data-field="x_YearObtained" name="x_YearObtained" id="x_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_prof_edit->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_prof_edit->YearObtained->EditValue ?>"<?php echo $staffqualifications_prof_edit->YearObtained->editAttributes() ?>>
</span>
<?php echo $staffqualifications_prof_edit->YearObtained->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_prof_edit->ProfessionalCertificate->Visible) { // ProfessionalCertificate ?>
	<div id="r_ProfessionalCertificate" class="form-group row">
		<label id="elh_staffqualifications_prof_ProfessionalCertificate" class="<?php echo $staffqualifications_prof_edit->LeftColumnClass ?>"><?php echo $staffqualifications_prof_edit->ProfessionalCertificate->caption() ?><?php echo $staffqualifications_prof_edit->ProfessionalCertificate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_prof_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_prof_edit->ProfessionalCertificate->cellAttributes() ?>>
<span id="el_staffqualifications_prof_ProfessionalCertificate">
<div id="fd_x_ProfessionalCertificate">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $staffqualifications_prof_edit->ProfessionalCertificate->title() ?>" data-table="staffqualifications_prof" data-field="x_ProfessionalCertificate" name="x_ProfessionalCertificate" id="x_ProfessionalCertificate" lang="<?php echo CurrentLanguageID() ?>"<?php echo $staffqualifications_prof_edit->ProfessionalCertificate->editAttributes() ?><?php if ($staffqualifications_prof_edit->ProfessionalCertificate->ReadOnly || $staffqualifications_prof_edit->ProfessionalCertificate->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_ProfessionalCertificate"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_ProfessionalCertificate" id= "fn_x_ProfessionalCertificate" value="<?php echo $staffqualifications_prof_edit->ProfessionalCertificate->Upload->FileName ?>">
<input type="hidden" name="fa_x_ProfessionalCertificate" id= "fa_x_ProfessionalCertificate" value="<?php echo (Post("fa_x_ProfessionalCertificate") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_ProfessionalCertificate" id= "fs_x_ProfessionalCertificate" value="0">
<input type="hidden" name="fx_x_ProfessionalCertificate" id= "fx_x_ProfessionalCertificate" value="<?php echo $staffqualifications_prof_edit->ProfessionalCertificate->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_ProfessionalCertificate" id= "fm_x_ProfessionalCertificate" value="<?php echo $staffqualifications_prof_edit->ProfessionalCertificate->UploadMaxFileSize ?>">
</div>
<table id="ft_x_ProfessionalCertificate" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $staffqualifications_prof_edit->ProfessionalCertificate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffqualifications_prof_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffqualifications_prof_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffqualifications_prof_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$staffqualifications_prof_edit->IsModal) { ?>
<?php echo $staffqualifications_prof_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$staffqualifications_prof_edit->showPageFooter();
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
$staffqualifications_prof_edit->terminate();
?>