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
$dept_section_add = new dept_section_add();

// Run the page
$dept_section_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dept_section_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdept_sectionadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdept_sectionadd = currentForm = new ew.Form("fdept_sectionadd", "add");

	// Validate form
	fdept_sectionadd.validate = function() {
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
			<?php if ($dept_section_add->SectionName->Required) { ?>
				elm = this.getElements("x" + infix + "_SectionName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_add->SectionName->caption(), $dept_section_add->SectionName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_add->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_add->Telephone->caption(), $dept_section_add->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_add->_Email->caption(), $dept_section_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_add->ProvinceCode->caption(), $dept_section_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_add->LACode->caption(), $dept_section_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($dept_section_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $dept_section_add->DepartmentCode->caption(), $dept_section_add->DepartmentCode->RequiredErrorMessage)) ?>");
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
	fdept_sectionadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdept_sectionadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdept_sectionadd.lists["x_ProvinceCode"] = <?php echo $dept_section_add->ProvinceCode->Lookup->toClientList($dept_section_add) ?>;
	fdept_sectionadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($dept_section_add->ProvinceCode->lookupOptions()) ?>;
	fdept_sectionadd.lists["x_LACode"] = <?php echo $dept_section_add->LACode->Lookup->toClientList($dept_section_add) ?>;
	fdept_sectionadd.lists["x_LACode"].options = <?php echo JsonEncode($dept_section_add->LACode->lookupOptions()) ?>;
	fdept_sectionadd.lists["x_DepartmentCode"] = <?php echo $dept_section_add->DepartmentCode->Lookup->toClientList($dept_section_add) ?>;
	fdept_sectionadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($dept_section_add->DepartmentCode->lookupOptions()) ?>;
	loadjs.done("fdept_sectionadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dept_section_add->showPageHeader(); ?>
<?php
$dept_section_add->showMessage();
?>
<form name="fdept_sectionadd" id="fdept_sectionadd" class="<?php echo $dept_section_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dept_section">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$dept_section_add->IsModal ?>">
<?php if ($dept_section->getCurrentMasterTable() == "department") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="department">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($dept_section_add->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($dept_section_add->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($dept_section_add->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($dept_section_add->SectionName->Visible) { // SectionName ?>
	<div id="r_SectionName" class="form-group row">
		<label id="elh_dept_section_SectionName" for="x_SectionName" class="<?php echo $dept_section_add->LeftColumnClass ?>"><?php echo $dept_section_add->SectionName->caption() ?><?php echo $dept_section_add->SectionName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_add->RightColumnClass ?>"><div <?php echo $dept_section_add->SectionName->cellAttributes() ?>>
<span id="el_dept_section_SectionName">
<input type="text" data-table="dept_section" data-field="x_SectionName" name="x_SectionName" id="x_SectionName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($dept_section_add->SectionName->getPlaceHolder()) ?>" value="<?php echo $dept_section_add->SectionName->EditValue ?>"<?php echo $dept_section_add->SectionName->editAttributes() ?>>
</span>
<?php echo $dept_section_add->SectionName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dept_section_add->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_dept_section_Telephone" for="x_Telephone" class="<?php echo $dept_section_add->LeftColumnClass ?>"><?php echo $dept_section_add->Telephone->caption() ?><?php echo $dept_section_add->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_add->RightColumnClass ?>"><div <?php echo $dept_section_add->Telephone->cellAttributes() ?>>
<span id="el_dept_section_Telephone">
<input type="text" data-table="dept_section" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_add->Telephone->getPlaceHolder()) ?>" value="<?php echo $dept_section_add->Telephone->EditValue ?>"<?php echo $dept_section_add->Telephone->editAttributes() ?>>
</span>
<?php echo $dept_section_add->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dept_section_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_dept_section__Email" for="x__Email" class="<?php echo $dept_section_add->LeftColumnClass ?>"><?php echo $dept_section_add->_Email->caption() ?><?php echo $dept_section_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_add->RightColumnClass ?>"><div <?php echo $dept_section_add->_Email->cellAttributes() ?>>
<span id="el_dept_section__Email">
<input type="text" data-table="dept_section" data-field="x__Email" name="x__Email" id="x__Email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($dept_section_add->_Email->getPlaceHolder()) ?>" value="<?php echo $dept_section_add->_Email->EditValue ?>"<?php echo $dept_section_add->_Email->editAttributes() ?>>
</span>
<?php echo $dept_section_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dept_section_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_dept_section_ProvinceCode" for="x_ProvinceCode" class="<?php echo $dept_section_add->LeftColumnClass ?>"><?php echo $dept_section_add->ProvinceCode->caption() ?><?php echo $dept_section_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_add->RightColumnClass ?>"><div <?php echo $dept_section_add->ProvinceCode->cellAttributes() ?>>
<?php if ($dept_section_add->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_dept_section_ProvinceCode">
<span<?php echo $dept_section_add->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_add->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($dept_section_add->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_dept_section_ProvinceCode">
<?php $dept_section_add->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_ProvinceCode" data-value-separator="<?php echo $dept_section_add->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $dept_section_add->ProvinceCode->editAttributes() ?>>
			<?php echo $dept_section_add->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $dept_section_add->ProvinceCode->Lookup->getParamTag($dept_section_add, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $dept_section_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dept_section_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_dept_section_LACode" for="x_LACode" class="<?php echo $dept_section_add->LeftColumnClass ?>"><?php echo $dept_section_add->LACode->caption() ?><?php echo $dept_section_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_add->RightColumnClass ?>"><div <?php echo $dept_section_add->LACode->cellAttributes() ?>>
<?php if ($dept_section_add->LACode->getSessionValue() != "") { ?>
<span id="el_dept_section_LACode">
<span<?php echo $dept_section_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($dept_section_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_dept_section_LACode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_LACode" data-value-separator="<?php echo $dept_section_add->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $dept_section_add->LACode->editAttributes() ?>>
			<?php echo $dept_section_add->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $dept_section_add->LACode->Lookup->getParamTag($dept_section_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $dept_section_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($dept_section_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_dept_section_DepartmentCode" for="x_DepartmentCode" class="<?php echo $dept_section_add->LeftColumnClass ?>"><?php echo $dept_section_add->DepartmentCode->caption() ?><?php echo $dept_section_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $dept_section_add->RightColumnClass ?>"><div <?php echo $dept_section_add->DepartmentCode->cellAttributes() ?>>
<?php if ($dept_section_add->DepartmentCode->getSessionValue() != "") { ?>
<span id="el_dept_section_DepartmentCode">
<span<?php echo $dept_section_add->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($dept_section_add->DepartmentCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_DepartmentCode" name="x_DepartmentCode" value="<?php echo HtmlEncode($dept_section_add->DepartmentCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_dept_section_DepartmentCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="dept_section" data-field="x_DepartmentCode" data-value-separator="<?php echo $dept_section_add->DepartmentCode->displayValueSeparatorAttribute() ?>" id="x_DepartmentCode" name="x_DepartmentCode"<?php echo $dept_section_add->DepartmentCode->editAttributes() ?>>
			<?php echo $dept_section_add->DepartmentCode->selectOptionListHtml("x_DepartmentCode") ?>
		</select>
</div>
<?php echo $dept_section_add->DepartmentCode->Lookup->getParamTag($dept_section_add, "p_x_DepartmentCode") ?>
</span>
<?php } ?>
<?php echo $dept_section_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("position_ref", explode(",", $dept_section->getCurrentDetailTable())) && $position_ref->DetailAdd) {
?>
<?php if ($dept_section->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("position_ref", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "position_refgrid.php" ?>
<?php } ?>
<?php
	if (in_array("programme", explode(",", $dept_section->getCurrentDetailTable())) && $programme->DetailAdd) {
?>
<?php if ($dept_section->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("programme", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "programmegrid.php" ?>
<?php } ?>
<?php if (!$dept_section_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $dept_section_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dept_section_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$dept_section_add->showPageFooter();
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
$dept_section_add->terminate();
?>