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
$dept_section_edit = new dept_section_edit();

// Run the page
$dept_section_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dept_section_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdept_sectionedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdept_sectionedit = currentForm = new ew.Form("fdept_sectionedit", "edit");

	// Validate form
	fdept_sectionedit.validate = function() {
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
			<?php if ($dept_section_edit->SectionName->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_edit->SectionName->caption(), $dept_section_edit->SectionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_edit->SectionCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_edit->SectionCode->caption(), $dept_section_edit->SectionCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_edit->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_edit->Telephone->caption(), $dept_section_edit->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_edit->_Email->caption(), $dept_section_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_edit->ProvinceCode->caption(), $dept_section_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_edit->LACode->caption(), $dept_section_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_edit->DepartmentCode->caption(), $dept_section_edit->DepartmentCode->RequiredErrorMessage)) ?>");
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
	fdept_sectionedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdept_sectionedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdept_sectionedit.lists["x_ProvinceCode"] = <?php echo $dept_section_edit->ProvinceCode->Lookup->toClientList($dept_section_edit) ?>;
	fdept_sectionedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($dept_section_edit->ProvinceCode->lookupOptions()) ?>;
	fdept_sectionedit.lists["x_LACode"] = <?php echo $dept_section_edit->LACode->Lookup->toClientList($dept_section_edit) ?>;
	fdept_sectionedit.lists["x_LACode"].options = <?php echo JsonEncode($dept_section_edit->LACode->lookupOptions()) ?>;
	fdept_sectionedit.lists["x_DepartmentCode"] = <?php echo $dept_section_edit->DepartmentCode->Lookup->toClientList($dept_section_edit) ?>;
	fdept_sectionedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($dept_section_edit->DepartmentCode->lookupOptions()) ?>;
	loadjs.done("fdept_sectionedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dept_section_edit->showPageHeader(); ?>
<?php
$dept_section_edit->showMessage();
?>
<?php if (!$dept_section_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $dept_section_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fdept_sectionedit" id="fdept_sectionedit" class="<?php echo $dept_section_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dept_section">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$dept_section_edit->IsModal ?>">
<?php if ($dept_section->getCurrentMasterTable() == "department") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="department">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($dept_section_edit->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($dept_section_edit->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($dept_section_edit->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($dept_section_edit->SectionName->Visible) { // SectionName ?>
	<div id="r_SectionName" class="form-group row">
		<label id="elh_dept_section_SectionName" for="x_SectionName" class="<?php echo $dept_section_edit->LeftColumnClass ?>"><?php echo $dept_section_edit->SectionName->caption() ?><?php echo $dept_section_edit->SectionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_edit->RightColumnClass ?>"><div <?php echo $dept_section_edit->SectionName->cellAttributes() ?>>
<span id="el_dept_section_SectionName">
<input type="text" data-table="dept_section" data-field="x_SectionName" name="x_SectionName" id="x_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dept_section_edit->SectionName->getPlaceHolder()) ?>" value="<?php echo $dept_section_edit->SectionName->EditValue ?>"<?php echo $dept_section_edit->SectionName->editAttributes() ?>>
</span>
<?php echo $dept_section_edit->SectionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dept_section_edit->SectionCode->Visible) { // SectionCode ?>
	<div id="r_SectionCode" class="form-group row">
		<label id="elh_dept_section_SectionCode" for="x_SectionCode" class="<?php echo $dept_section_edit->LeftColumnClass ?>"><?php echo $dept_section_edit->SectionCode->caption() ?><?php echo $dept_section_edit->SectionCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_edit->RightColumnClass ?>"><div <?php echo $dept_section_edit->SectionCode->cellAttributes() ?>>
<span id="el_dept_section_SectionCode">
<span<?php echo $dept_section_edit->SectionCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_edit->SectionCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="dept_section" data-field="x_SectionCode" name="x_SectionCode" id="x_SectionCode" value="<?php echo HtmlEncode($dept_section_edit->SectionCode->CurrentValue) ?>">
<?php echo $dept_section_edit->SectionCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dept_section_edit->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_dept_section_Telephone" for="x_Telephone" class="<?php echo $dept_section_edit->LeftColumnClass ?>"><?php echo $dept_section_edit->Telephone->caption() ?><?php echo $dept_section_edit->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_edit->RightColumnClass ?>"><div <?php echo $dept_section_edit->Telephone->cellAttributes() ?>>
<span id="el_dept_section_Telephone">
<input type="text" data-table="dept_section" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_edit->Telephone->getPlaceHolder()) ?>" value="<?php echo $dept_section_edit->Telephone->EditValue ?>"<?php echo $dept_section_edit->Telephone->editAttributes() ?>>
</span>
<?php echo $dept_section_edit->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dept_section_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_dept_section__Email" for="x__Email" class="<?php echo $dept_section_edit->LeftColumnClass ?>"><?php echo $dept_section_edit->_Email->caption() ?><?php echo $dept_section_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_edit->RightColumnClass ?>"><div <?php echo $dept_section_edit->_Email->cellAttributes() ?>>
<span id="el_dept_section__Email">
<input type="text" data-table="dept_section" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $dept_section_edit->_Email->EditValue ?>"<?php echo $dept_section_edit->_Email->editAttributes() ?>>
</span>
<?php echo $dept_section_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dept_section_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_dept_section_ProvinceCode" for="x_ProvinceCode" class="<?php echo $dept_section_edit->LeftColumnClass ?>"><?php echo $dept_section_edit->ProvinceCode->caption() ?><?php echo $dept_section_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_edit->RightColumnClass ?>"><div <?php echo $dept_section_edit->ProvinceCode->cellAttributes() ?>>
<?php if ($dept_section_edit->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_dept_section_ProvinceCode">
<span<?php echo $dept_section_edit->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_edit->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($dept_section_edit->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_dept_section_ProvinceCode">
<?php $dept_section_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_ProvinceCode" data-value-separator="<?php echo $dept_section_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $dept_section_edit->ProvinceCode->editAttributes() ?>>
			<?php echo $dept_section_edit->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $dept_section_edit->ProvinceCode->Lookup->getParamTag($dept_section_edit, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $dept_section_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dept_section_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_dept_section_LACode" for="x_LACode" class="<?php echo $dept_section_edit->LeftColumnClass ?>"><?php echo $dept_section_edit->LACode->caption() ?><?php echo $dept_section_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_edit->RightColumnClass ?>"><div <?php echo $dept_section_edit->LACode->cellAttributes() ?>>
<?php if ($dept_section_edit->LACode->getSessionValue() != "") { ?>
<span id="el_dept_section_LACode">
<span<?php echo $dept_section_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($dept_section_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_dept_section_LACode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_LACode" data-value-separator="<?php echo $dept_section_edit->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $dept_section_edit->LACode->editAttributes() ?>>
			<?php echo $dept_section_edit->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $dept_section_edit->LACode->Lookup->getParamTag($dept_section_edit, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $dept_section_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dept_section_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_dept_section_DepartmentCode" for="x_DepartmentCode" class="<?php echo $dept_section_edit->LeftColumnClass ?>"><?php echo $dept_section_edit->DepartmentCode->caption() ?><?php echo $dept_section_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_edit->RightColumnClass ?>"><div <?php echo $dept_section_edit->DepartmentCode->cellAttributes() ?>>
<?php if ($dept_section_edit->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_dept_section_DepartmentCode">
<span<?php echo $dept_section_edit->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_edit->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($dept_section_edit->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_dept_section_DepartmentCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_DepartmentCode" data-value-separator="<?php echo $dept_section_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $dept_section_edit->DepartmentCode->editAttributes() ?>>
			<?php echo $dept_section_edit->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $dept_section_edit->DepartmentCode->Lookup->getParamTag($dept_section_edit, "p_x_DepartmentCode") ?>
</span>
<?php } ?>
<?php echo $dept_section_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("position_ref", explode(",", $dept_section->getCurrentDetailTable())) && $position_ref->DetailEdit) {
?>
<?php if ($dept_section->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("position_ref", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "position_refgrid.php" ?>
<?php } ?>
<?php
	if (in_array("programme", explode(",", $dept_section->getCurrentDetailTable())) && $programme->DetailEdit) {
?>
<?php if ($dept_section->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("programme", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "programmegrid.php" ?>
<?php } ?>
<?php if (!$dept_section_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $dept_section_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dept_section_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$dept_section_edit->IsModal) { ?>
<?php echo $dept_section_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$dept_section_edit->showPageFooter();
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
$dept_section_edit->terminate();
?>