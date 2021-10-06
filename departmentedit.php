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
$department_edit = new department_edit();

// Run the page
$department_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$department_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdepartmentedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdepartmentedit = currentForm = new ew.Form("fdepartmentedit", "edit");

	// Validate form
	fdepartmentedit.validate = function() {
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
			<?php if ($department_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_edit->DepartmentCode->caption(), $department_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_edit->DepartmentName->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_edit->DepartmentName->caption(), $department_edit->DepartmentName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_edit->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_edit->Telephone->caption(), $department_edit->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_edit->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_edit->_Email->caption(), $department_edit->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($department_edit->_Email->errorMessage()) ?>");
			<?php if ($department_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_edit->LACode->caption(), $department_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_edit->ProvinceCode->caption(), $department_edit->ProvinceCode->RequiredErrorMessage)) ?>");
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
	fdepartmentedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdepartmentedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdepartmentedit.lists["x_LACode"] = <?php echo $department_edit->LACode->Lookup->toClientList($department_edit) ?>;
	fdepartmentedit.lists["x_LACode"].options = <?php echo JsonEncode($department_edit->LACode->lookupOptions()) ?>;
	fdepartmentedit.lists["x_ProvinceCode"] = <?php echo $department_edit->ProvinceCode->Lookup->toClientList($department_edit) ?>;
	fdepartmentedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($department_edit->ProvinceCode->lookupOptions()) ?>;
	loadjs.done("fdepartmentedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $department_edit->showPageHeader(); ?>
<?php
$department_edit->showMessage();
?>
<?php if (!$department_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $department_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fdepartmentedit" id="fdepartmentedit" class="<?php echo $department_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="department">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$department_edit->IsModal ?>">
<?php if ($department->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($department_edit->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($department_edit->ProvinceCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($department_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_department_DepartmentCode" class="<?php echo $department_edit->LeftColumnClass ?>"><?php echo $department_edit->DepartmentCode->caption() ?><?php echo $department_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_edit->RightColumnClass ?>"><div <?php echo $department_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_department_DepartmentCode">
<span<?php echo $department_edit->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_edit->DepartmentCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="department" data-field="x_DepartmentCode" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo HtmlEncode($department_edit->DepartmentCode->CurrentValue) ?>">
<?php echo $department_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($department_edit->DepartmentName->Visible) { // DepartmentName ?>
	<div id="r_DepartmentName" class="form-group row">
		<label id="elh_department_DepartmentName" for="x_DepartmentName" class="<?php echo $department_edit->LeftColumnClass ?>"><?php echo $department_edit->DepartmentName->caption() ?><?php echo $department_edit->DepartmentName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_edit->RightColumnClass ?>"><div <?php echo $department_edit->DepartmentName->cellAttributes() ?>>
<span id="el_department_DepartmentName">
<input type="text" data-table="department" data-field="x_DepartmentName" name="x_DepartmentName" id="x_DepartmentName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($department_edit->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $department_edit->DepartmentName->EditValue ?>"<?php echo $department_edit->DepartmentName->editAttributes() ?>>
</span>
<?php echo $department_edit->DepartmentName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($department_edit->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_department_Telephone" for="x_Telephone" class="<?php echo $department_edit->LeftColumnClass ?>"><?php echo $department_edit->Telephone->caption() ?><?php echo $department_edit->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_edit->RightColumnClass ?>"><div <?php echo $department_edit->Telephone->cellAttributes() ?>>
<span id="el_department_Telephone">
<input type="text" data-table="department" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($department_edit->Telephone->getPlaceHolder()) ?>" value="<?php echo $department_edit->Telephone->EditValue ?>"<?php echo $department_edit->Telephone->editAttributes() ?>>
</span>
<?php echo $department_edit->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($department_edit->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_department__Email" for="x__Email" class="<?php echo $department_edit->LeftColumnClass ?>"><?php echo $department_edit->_Email->caption() ?><?php echo $department_edit->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_edit->RightColumnClass ?>"><div <?php echo $department_edit->_Email->cellAttributes() ?>>
<span id="el_department__Email">
<input type="text" data-table="department" data-field="x__Email" name="x__Email" id="x__Email" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($department_edit->_Email->getPlaceHolder()) ?>" value="<?php echo $department_edit->_Email->EditValue ?>"<?php echo $department_edit->_Email->editAttributes() ?>>
</span>
<?php echo $department_edit->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($department_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_department_LACode" for="x_LACode" class="<?php echo $department_edit->LeftColumnClass ?>"><?php echo $department_edit->LACode->caption() ?><?php echo $department_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_edit->RightColumnClass ?>"><div <?php echo $department_edit->LACode->cellAttributes() ?>>
<?php if ($department_edit->LACode->getSessionValue() != "") { ?>
<span id="el_department_LACode">
<span<?php echo $department_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($department_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_department_LACode">
<?php $department_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="department" data-field="x_LACode" data-value-separator="<?php echo $department_edit->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $department_edit->LACode->editAttributes() ?>>
			<?php echo $department_edit->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $department_edit->LACode->Lookup->getParamTag($department_edit, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $department_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($department_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_department_ProvinceCode" for="x_ProvinceCode" class="<?php echo $department_edit->LeftColumnClass ?>"><?php echo $department_edit->ProvinceCode->caption() ?><?php echo $department_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_edit->RightColumnClass ?>"><div <?php echo $department_edit->ProvinceCode->cellAttributes() ?>>
<?php if ($department_edit->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_department_ProvinceCode">
<span<?php echo $department_edit->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_edit->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($department_edit->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_department_ProvinceCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="department" data-field="x_ProvinceCode" data-value-separator="<?php echo $department_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $department_edit->ProvinceCode->editAttributes() ?>>
			<?php echo $department_edit->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $department_edit->ProvinceCode->Lookup->getParamTag($department_edit, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $department_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("dept_section", explode(",", $department->getCurrentDetailTable())) && $dept_section->DetailEdit) {
?>
<?php if ($department->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("dept_section", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "dept_sectiongrid.php" ?>
<?php } ?>
<?php if (!$department_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $department_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $department_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$department_edit->IsModal) { ?>
<?php echo $department_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$department_edit->showPageFooter();
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
$department_edit->terminate();
?>