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
$staffqualifications_academic_add = new staffqualifications_academic_add();

// Run the page
$staffqualifications_academic_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffqualifications_academic_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffqualifications_academicadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fstaffqualifications_academicadd = currentForm = new ew.Form("fstaffqualifications_academicadd", "add");

	// Validate form
	fstaffqualifications_academicadd.validate = function() {
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
			<?php if ($staffqualifications_academic_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_add->EmployeeID->caption(), $staffqualifications_academic_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_academic_add->EmployeeID->errorMessage()) ?>");
			<?php if ($staffqualifications_academic_add->QualificationLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_add->QualificationLevel->caption(), $staffqualifications_academic_add->QualificationLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_academic_add->QualificationRemarks->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationRemarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_add->QualificationRemarks->caption(), $staffqualifications_academic_add->QualificationRemarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_academic_add->AwardingInstitution->Required) { ?>
				elm = this.getElements("x" + infix + "_AwardingInstitution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_add->AwardingInstitution->caption(), $staffqualifications_academic_add->AwardingInstitution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_academic_add->FromYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_add->FromYear->caption(), $staffqualifications_academic_add->FromYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_academic_add->FromYear->errorMessage()) ?>");
			<?php if ($staffqualifications_academic_add->YearObtained->Required) { ?>
				elm = this.getElements("x" + infix + "_YearObtained");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_add->YearObtained->caption(), $staffqualifications_academic_add->YearObtained->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_YearObtained");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_academic_add->YearObtained->errorMessage()) ?>");
			<?php if ($staffqualifications_academic_add->AcademicCertificate->Required) { ?>
				felm = this.getElements("x" + infix + "_AcademicCertificate");
				elm = this.getElements("fn_x" + infix + "_AcademicCertificate");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_add->AcademicCertificate->caption(), $staffqualifications_academic_add->AcademicCertificate->RequiredErrorMessage)) ?>");
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
	fstaffqualifications_academicadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffqualifications_academicadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffqualifications_academicadd.lists["x_QualificationLevel"] = <?php echo $staffqualifications_academic_add->QualificationLevel->Lookup->toClientList($staffqualifications_academic_add) ?>;
	fstaffqualifications_academicadd.lists["x_QualificationLevel"].options = <?php echo JsonEncode($staffqualifications_academic_add->QualificationLevel->lookupOptions()) ?>;
	loadjs.done("fstaffqualifications_academicadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffqualifications_academic_add->showPageHeader(); ?>
<?php
$staffqualifications_academic_add->showMessage();
?>
<form name="fstaffqualifications_academicadd" id="fstaffqualifications_academicadd" class="<?php echo $staffqualifications_academic_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffqualifications_academic">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$staffqualifications_academic_add->IsModal ?>">
<?php if ($staffqualifications_academic->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_academic_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($staffqualifications_academic_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffqualifications_academic_EmployeeID" for="x_EmployeeID" class="<?php echo $staffqualifications_academic_add->LeftColumnClass ?>"><?php echo $staffqualifications_academic_add->EmployeeID->caption() ?><?php echo $staffqualifications_academic_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_add->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_add->EmployeeID->cellAttributes() ?>>
<?php if ($staffqualifications_academic_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_staffqualifications_academic_EmployeeID">
<span<?php echo $staffqualifications_academic_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_academic_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_academic_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_staffqualifications_academic_EmployeeID">
<input type="text" data-table="staffqualifications_academic" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_add->EmployeeID->EditValue ?>"<?php echo $staffqualifications_academic_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $staffqualifications_academic_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_academic_add->QualificationLevel->Visible) { // QualificationLevel ?>
	<div id="r_QualificationLevel" class="form-group row">
		<label id="elh_staffqualifications_academic_QualificationLevel" for="x_QualificationLevel" class="<?php echo $staffqualifications_academic_add->LeftColumnClass ?>"><?php echo $staffqualifications_academic_add->QualificationLevel->caption() ?><?php echo $staffqualifications_academic_add->QualificationLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_add->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_add->QualificationLevel->cellAttributes() ?>>
<span id="el_staffqualifications_academic_QualificationLevel">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_QualificationLevel"><?php echo EmptyValue(strval($staffqualifications_academic_add->QualificationLevel->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_academic_add->QualificationLevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_academic_add->QualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_academic_add->QualificationLevel->ReadOnly || $staffqualifications_academic_add->QualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_QualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_academic_add->QualificationLevel->Lookup->getParamTag($staffqualifications_academic_add, "p_x_QualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_academic_add->QualificationLevel->displayValueSeparatorAttribute() ?>" name="x_QualificationLevel" id="x_QualificationLevel" value="<?php echo $staffqualifications_academic_add->QualificationLevel->CurrentValue ?>"<?php echo $staffqualifications_academic_add->QualificationLevel->editAttributes() ?>>
</span>
<?php echo $staffqualifications_academic_add->QualificationLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_academic_add->QualificationRemarks->Visible) { // QualificationRemarks ?>
	<div id="r_QualificationRemarks" class="form-group row">
		<label id="elh_staffqualifications_academic_QualificationRemarks" for="x_QualificationRemarks" class="<?php echo $staffqualifications_academic_add->LeftColumnClass ?>"><?php echo $staffqualifications_academic_add->QualificationRemarks->caption() ?><?php echo $staffqualifications_academic_add->QualificationRemarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_add->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_add->QualificationRemarks->cellAttributes() ?>>
<span id="el_staffqualifications_academic_QualificationRemarks">
<input type="text" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="x_QualificationRemarks" id="x_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_add->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_add->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_academic_add->QualificationRemarks->editAttributes() ?>>
</span>
<?php echo $staffqualifications_academic_add->QualificationRemarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_academic_add->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<div id="r_AwardingInstitution" class="form-group row">
		<label id="elh_staffqualifications_academic_AwardingInstitution" for="x_AwardingInstitution" class="<?php echo $staffqualifications_academic_add->LeftColumnClass ?>"><?php echo $staffqualifications_academic_add->AwardingInstitution->caption() ?><?php echo $staffqualifications_academic_add->AwardingInstitution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_add->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_add->AwardingInstitution->cellAttributes() ?>>
<span id="el_staffqualifications_academic_AwardingInstitution">
<input type="text" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="x_AwardingInstitution" id="x_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_add->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_add->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_academic_add->AwardingInstitution->editAttributes() ?>>
</span>
<?php echo $staffqualifications_academic_add->AwardingInstitution->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_academic_add->FromYear->Visible) { // FromYear ?>
	<div id="r_FromYear" class="form-group row">
		<label id="elh_staffqualifications_academic_FromYear" for="x_FromYear" class="<?php echo $staffqualifications_academic_add->LeftColumnClass ?>"><?php echo $staffqualifications_academic_add->FromYear->caption() ?><?php echo $staffqualifications_academic_add->FromYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_add->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_add->FromYear->cellAttributes() ?>>
<span id="el_staffqualifications_academic_FromYear">
<input type="text" data-table="staffqualifications_academic" data-field="x_FromYear" name="x_FromYear" id="x_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_add->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_add->FromYear->EditValue ?>"<?php echo $staffqualifications_academic_add->FromYear->editAttributes() ?>>
</span>
<?php echo $staffqualifications_academic_add->FromYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_academic_add->YearObtained->Visible) { // YearObtained ?>
	<div id="r_YearObtained" class="form-group row">
		<label id="elh_staffqualifications_academic_YearObtained" for="x_YearObtained" class="<?php echo $staffqualifications_academic_add->LeftColumnClass ?>"><?php echo $staffqualifications_academic_add->YearObtained->caption() ?><?php echo $staffqualifications_academic_add->YearObtained->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_add->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_add->YearObtained->cellAttributes() ?>>
<span id="el_staffqualifications_academic_YearObtained">
<input type="text" data-table="staffqualifications_academic" data-field="x_YearObtained" name="x_YearObtained" id="x_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_add->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_add->YearObtained->EditValue ?>"<?php echo $staffqualifications_academic_add->YearObtained->editAttributes() ?>>
</span>
<?php echo $staffqualifications_academic_add->YearObtained->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_academic_add->AcademicCertificate->Visible) { // AcademicCertificate ?>
	<div id="r_AcademicCertificate" class="form-group row">
		<label id="elh_staffqualifications_academic_AcademicCertificate" class="<?php echo $staffqualifications_academic_add->LeftColumnClass ?>"><?php echo $staffqualifications_academic_add->AcademicCertificate->caption() ?><?php echo $staffqualifications_academic_add->AcademicCertificate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_add->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_add->AcademicCertificate->cellAttributes() ?>>
<span id="el_staffqualifications_academic_AcademicCertificate">
<div id="fd_x_AcademicCertificate">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $staffqualifications_academic_add->AcademicCertificate->title() ?>" data-table="staffqualifications_academic" data-field="x_AcademicCertificate" name="x_AcademicCertificate" id="x_AcademicCertificate" lang="<?php echo CurrentLanguageID() ?>"<?php echo $staffqualifications_academic_add->AcademicCertificate->editAttributes() ?><?php if ($staffqualifications_academic_add->AcademicCertificate->ReadOnly || $staffqualifications_academic_add->AcademicCertificate->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_AcademicCertificate"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_AcademicCertificate" id= "fn_x_AcademicCertificate" value="<?php echo $staffqualifications_academic_add->AcademicCertificate->Upload->FileName ?>">
<input type="hidden" name="fa_x_AcademicCertificate" id= "fa_x_AcademicCertificate" value="0">
<input type="hidden" name="fs_x_AcademicCertificate" id= "fs_x_AcademicCertificate" value="0">
<input type="hidden" name="fx_x_AcademicCertificate" id= "fx_x_AcademicCertificate" value="<?php echo $staffqualifications_academic_add->AcademicCertificate->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_AcademicCertificate" id= "fm_x_AcademicCertificate" value="<?php echo $staffqualifications_academic_add->AcademicCertificate->UploadMaxFileSize ?>">
</div>
<table id="ft_x_AcademicCertificate" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $staffqualifications_academic_add->AcademicCertificate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffqualifications_academic_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffqualifications_academic_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffqualifications_academic_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staffqualifications_academic_add->showPageFooter();
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
$staffqualifications_academic_add->terminate();
?>