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
$staffqualifications_academic_edit = new staffqualifications_academic_edit();

// Run the page
$staffqualifications_academic_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffqualifications_academic_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffqualifications_academicedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fstaffqualifications_academicedit = currentForm = new ew.Form("fstaffqualifications_academicedit", "edit");

	// Validate form
	fstaffqualifications_academicedit.validate = function() {
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
			<?php if ($staffqualifications_academic_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_edit->EmployeeID->caption(), $staffqualifications_academic_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_academic_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($staffqualifications_academic_edit->QualificationLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_edit->QualificationLevel->caption(), $staffqualifications_academic_edit->QualificationLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_academic_edit->QualificationRemarks->Required) { ?>
				elm = this.getElements("x" + infix + "_QualificationRemarks");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_edit->QualificationRemarks->caption(), $staffqualifications_academic_edit->QualificationRemarks->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_academic_edit->AwardingInstitution->Required) { ?>
				elm = this.getElements("x" + infix + "_AwardingInstitution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_edit->AwardingInstitution->caption(), $staffqualifications_academic_edit->AwardingInstitution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffqualifications_academic_edit->FromYear->Required) { ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_edit->FromYear->caption(), $staffqualifications_academic_edit->FromYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_FromYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_academic_edit->FromYear->errorMessage()) ?>");
			<?php if ($staffqualifications_academic_edit->YearObtained->Required) { ?>
				elm = this.getElements("x" + infix + "_YearObtained");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_edit->YearObtained->caption(), $staffqualifications_academic_edit->YearObtained->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_YearObtained");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffqualifications_academic_edit->YearObtained->errorMessage()) ?>");
			<?php if ($staffqualifications_academic_edit->AcademicCertificate->Required) { ?>
				felm = this.getElements("x" + infix + "_AcademicCertificate");
				elm = this.getElements("fn_x" + infix + "_AcademicCertificate");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $staffqualifications_academic_edit->AcademicCertificate->caption(), $staffqualifications_academic_edit->AcademicCertificate->RequiredErrorMessage)) ?>");
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
	fstaffqualifications_academicedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffqualifications_academicedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffqualifications_academicedit.lists["x_QualificationLevel"] = <?php echo $staffqualifications_academic_edit->QualificationLevel->Lookup->toClientList($staffqualifications_academic_edit) ?>;
	fstaffqualifications_academicedit.lists["x_QualificationLevel"].options = <?php echo JsonEncode($staffqualifications_academic_edit->QualificationLevel->lookupOptions()) ?>;
	loadjs.done("fstaffqualifications_academicedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffqualifications_academic_edit->showPageHeader(); ?>
<?php
$staffqualifications_academic_edit->showMessage();
?>
<?php if (!$staffqualifications_academic_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffqualifications_academic_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fstaffqualifications_academicedit" id="fstaffqualifications_academicedit" class="<?php echo $staffqualifications_academic_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffqualifications_academic">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$staffqualifications_academic_edit->IsModal ?>">
<?php if ($staffqualifications_academic->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_academic_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($staffqualifications_academic_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffqualifications_academic_EmployeeID" for="x_EmployeeID" class="<?php echo $staffqualifications_academic_edit->LeftColumnClass ?>"><?php echo $staffqualifications_academic_edit->EmployeeID->caption() ?><?php echo $staffqualifications_academic_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_edit->EmployeeID->cellAttributes() ?>>
<?php if ($staffqualifications_academic_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_staffqualifications_academic_EmployeeID">
<span<?php echo $staffqualifications_academic_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffqualifications_academic_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_academic_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="staffqualifications_academic" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_edit->EmployeeID->EditValue ?>"<?php echo $staffqualifications_academic_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="staffqualifications_academic" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($staffqualifications_academic_edit->EmployeeID->OldValue != null ? $staffqualifications_academic_edit->EmployeeID->OldValue : $staffqualifications_academic_edit->EmployeeID->CurrentValue) ?>">
<?php echo $staffqualifications_academic_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_academic_edit->QualificationLevel->Visible) { // QualificationLevel ?>
	<div id="r_QualificationLevel" class="form-group row">
		<label id="elh_staffqualifications_academic_QualificationLevel" for="x_QualificationLevel" class="<?php echo $staffqualifications_academic_edit->LeftColumnClass ?>"><?php echo $staffqualifications_academic_edit->QualificationLevel->caption() ?><?php echo $staffqualifications_academic_edit->QualificationLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_edit->QualificationLevel->cellAttributes() ?>>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_QualificationLevel"><?php echo EmptyValue(strval($staffqualifications_academic_edit->QualificationLevel->ViewValue)) ? $Language->phrase("PleaseSelect") : $staffqualifications_academic_edit->QualificationLevel->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($staffqualifications_academic_edit->QualificationLevel->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($staffqualifications_academic_edit->QualificationLevel->ReadOnly || $staffqualifications_academic_edit->QualificationLevel->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_QualificationLevel',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $staffqualifications_academic_edit->QualificationLevel->Lookup->getParamTag($staffqualifications_academic_edit, "p_x_QualificationLevel") ?>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $staffqualifications_academic_edit->QualificationLevel->displayValueSeparatorAttribute() ?>" name="x_QualificationLevel" id="x_QualificationLevel" value="<?php echo $staffqualifications_academic_edit->QualificationLevel->CurrentValue ?>"<?php echo $staffqualifications_academic_edit->QualificationLevel->editAttributes() ?>>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_QualificationLevel" name="o_QualificationLevel" id="o_QualificationLevel" value="<?php echo HtmlEncode($staffqualifications_academic_edit->QualificationLevel->OldValue != null ? $staffqualifications_academic_edit->QualificationLevel->OldValue : $staffqualifications_academic_edit->QualificationLevel->CurrentValue) ?>">
<?php echo $staffqualifications_academic_edit->QualificationLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_academic_edit->QualificationRemarks->Visible) { // QualificationRemarks ?>
	<div id="r_QualificationRemarks" class="form-group row">
		<label id="elh_staffqualifications_academic_QualificationRemarks" for="x_QualificationRemarks" class="<?php echo $staffqualifications_academic_edit->LeftColumnClass ?>"><?php echo $staffqualifications_academic_edit->QualificationRemarks->caption() ?><?php echo $staffqualifications_academic_edit->QualificationRemarks->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_edit->QualificationRemarks->cellAttributes() ?>>
<span id="el_staffqualifications_academic_QualificationRemarks">
<input type="text" data-table="staffqualifications_academic" data-field="x_QualificationRemarks" name="x_QualificationRemarks" id="x_QualificationRemarks" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_edit->QualificationRemarks->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_edit->QualificationRemarks->EditValue ?>"<?php echo $staffqualifications_academic_edit->QualificationRemarks->editAttributes() ?>>
</span>
<?php echo $staffqualifications_academic_edit->QualificationRemarks->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_academic_edit->AwardingInstitution->Visible) { // AwardingInstitution ?>
	<div id="r_AwardingInstitution" class="form-group row">
		<label id="elh_staffqualifications_academic_AwardingInstitution" for="x_AwardingInstitution" class="<?php echo $staffqualifications_academic_edit->LeftColumnClass ?>"><?php echo $staffqualifications_academic_edit->AwardingInstitution->caption() ?><?php echo $staffqualifications_academic_edit->AwardingInstitution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_edit->AwardingInstitution->cellAttributes() ?>>
<span id="el_staffqualifications_academic_AwardingInstitution">
<input type="text" data-table="staffqualifications_academic" data-field="x_AwardingInstitution" name="x_AwardingInstitution" id="x_AwardingInstitution" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($staffqualifications_academic_edit->AwardingInstitution->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_edit->AwardingInstitution->EditValue ?>"<?php echo $staffqualifications_academic_edit->AwardingInstitution->editAttributes() ?>>
</span>
<?php echo $staffqualifications_academic_edit->AwardingInstitution->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_academic_edit->FromYear->Visible) { // FromYear ?>
	<div id="r_FromYear" class="form-group row">
		<label id="elh_staffqualifications_academic_FromYear" for="x_FromYear" class="<?php echo $staffqualifications_academic_edit->LeftColumnClass ?>"><?php echo $staffqualifications_academic_edit->FromYear->caption() ?><?php echo $staffqualifications_academic_edit->FromYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_edit->FromYear->cellAttributes() ?>>
<span id="el_staffqualifications_academic_FromYear">
<input type="text" data-table="staffqualifications_academic" data-field="x_FromYear" name="x_FromYear" id="x_FromYear" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_edit->FromYear->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_edit->FromYear->EditValue ?>"<?php echo $staffqualifications_academic_edit->FromYear->editAttributes() ?>>
</span>
<?php echo $staffqualifications_academic_edit->FromYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_academic_edit->YearObtained->Visible) { // YearObtained ?>
	<div id="r_YearObtained" class="form-group row">
		<label id="elh_staffqualifications_academic_YearObtained" for="x_YearObtained" class="<?php echo $staffqualifications_academic_edit->LeftColumnClass ?>"><?php echo $staffqualifications_academic_edit->YearObtained->caption() ?><?php echo $staffqualifications_academic_edit->YearObtained->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_edit->YearObtained->cellAttributes() ?>>
<input type="text" data-table="staffqualifications_academic" data-field="x_YearObtained" name="x_YearObtained" id="x_YearObtained" size="30" placeholder="<?php echo HtmlEncode($staffqualifications_academic_edit->YearObtained->getPlaceHolder()) ?>" value="<?php echo $staffqualifications_academic_edit->YearObtained->EditValue ?>"<?php echo $staffqualifications_academic_edit->YearObtained->editAttributes() ?>>
<input type="hidden" data-table="staffqualifications_academic" data-field="x_YearObtained" name="o_YearObtained" id="o_YearObtained" value="<?php echo HtmlEncode($staffqualifications_academic_edit->YearObtained->OldValue != null ? $staffqualifications_academic_edit->YearObtained->OldValue : $staffqualifications_academic_edit->YearObtained->CurrentValue) ?>">
<?php echo $staffqualifications_academic_edit->YearObtained->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffqualifications_academic_edit->AcademicCertificate->Visible) { // AcademicCertificate ?>
	<div id="r_AcademicCertificate" class="form-group row">
		<label id="elh_staffqualifications_academic_AcademicCertificate" class="<?php echo $staffqualifications_academic_edit->LeftColumnClass ?>"><?php echo $staffqualifications_academic_edit->AcademicCertificate->caption() ?><?php echo $staffqualifications_academic_edit->AcademicCertificate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffqualifications_academic_edit->RightColumnClass ?>"><div <?php echo $staffqualifications_academic_edit->AcademicCertificate->cellAttributes() ?>>
<span id="el_staffqualifications_academic_AcademicCertificate">
<div id="fd_x_AcademicCertificate">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $staffqualifications_academic_edit->AcademicCertificate->title() ?>" data-table="staffqualifications_academic" data-field="x_AcademicCertificate" name="x_AcademicCertificate" id="x_AcademicCertificate" lang="<?php echo CurrentLanguageID() ?>"<?php echo $staffqualifications_academic_edit->AcademicCertificate->editAttributes() ?><?php if ($staffqualifications_academic_edit->AcademicCertificate->ReadOnly || $staffqualifications_academic_edit->AcademicCertificate->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_AcademicCertificate"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_AcademicCertificate" id= "fn_x_AcademicCertificate" value="<?php echo $staffqualifications_academic_edit->AcademicCertificate->Upload->FileName ?>">
<input type="hidden" name="fa_x_AcademicCertificate" id= "fa_x_AcademicCertificate" value="<?php echo (Post("fa_x_AcademicCertificate") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_AcademicCertificate" id= "fs_x_AcademicCertificate" value="0">
<input type="hidden" name="fx_x_AcademicCertificate" id= "fx_x_AcademicCertificate" value="<?php echo $staffqualifications_academic_edit->AcademicCertificate->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_AcademicCertificate" id= "fm_x_AcademicCertificate" value="<?php echo $staffqualifications_academic_edit->AcademicCertificate->UploadMaxFileSize ?>">
</div>
<table id="ft_x_AcademicCertificate" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $staffqualifications_academic_edit->AcademicCertificate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffqualifications_academic_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffqualifications_academic_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffqualifications_academic_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$staffqualifications_academic_edit->IsModal) { ?>
<?php echo $staffqualifications_academic_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$staffqualifications_academic_edit->showPageFooter();
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
$staffqualifications_academic_edit->terminate();
?>