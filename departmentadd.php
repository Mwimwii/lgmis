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
$department_add = new department_add();

// Run the page
$department_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$department_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdepartmentadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdepartmentadd = currentForm = new ew.Form("fdepartmentadd", "add");

	// Validate form
	fdepartmentadd.validate = function() {
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
			<?php if ($department_add->DepartmentName->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_add->DepartmentName->caption(), $department_add->DepartmentName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_add->Telephone->Required) { ?>
				elm = this.getElements("x" + infix + "_Telephone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_add->Telephone->caption(), $department_add->Telephone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_add->_Email->Required) { ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_add->_Email->caption(), $department_add->_Email->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "__Email");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($department_add->_Email->errorMessage()) ?>");
			<?php if ($department_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_add->LACode->caption(), $department_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_add->ProvinceCode->caption(), $department_add->ProvinceCode->RequiredErrorMessage)) ?>");
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
	fdepartmentadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdepartmentadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdepartmentadd.lists["x_LACode"] = <?php echo $department_add->LACode->Lookup->toClientList($department_add) ?>;
	fdepartmentadd.lists["x_LACode"].options = <?php echo JsonEncode($department_add->LACode->lookupOptions()) ?>;
	fdepartmentadd.lists["x_ProvinceCode"] = <?php echo $department_add->ProvinceCode->Lookup->toClientList($department_add) ?>;
	fdepartmentadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($department_add->ProvinceCode->lookupOptions()) ?>;
	loadjs.done("fdepartmentadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $department_add->showPageHeader(); ?>
<?php
$department_add->showMessage();
?>
<form name="fdepartmentadd" id="fdepartmentadd" class="<?php echo $department_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="department">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$department_add->IsModal ?>">
<?php if ($department->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($department_add->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($department_add->ProvinceCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($department_add->DepartmentName->Visible) { // DepartmentName ?>
	<div id="r_DepartmentName" class="form-group row">
		<label id="elh_department_DepartmentName" for="x_DepartmentName" class="<?php echo $department_add->LeftColumnClass ?>"><?php echo $department_add->DepartmentName->caption() ?><?php echo $department_add->DepartmentName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_add->RightColumnClass ?>"><div <?php echo $department_add->DepartmentName->cellAttributes() ?>>
<span id="el_department_DepartmentName">
<input type="text" data-table="department" data-field="x_DepartmentName" name="x_DepartmentName" id="x_DepartmentName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($department_add->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $department_add->DepartmentName->EditValue ?>"<?php echo $department_add->DepartmentName->editAttributes() ?>>
</span>
<?php echo $department_add->DepartmentName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($department_add->Telephone->Visible) { // Telephone ?>
	<div id="r_Telephone" class="form-group row">
		<label id="elh_department_Telephone" for="x_Telephone" class="<?php echo $department_add->LeftColumnClass ?>"><?php echo $department_add->Telephone->caption() ?><?php echo $department_add->Telephone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_add->RightColumnClass ?>"><div <?php echo $department_add->Telephone->cellAttributes() ?>>
<span id="el_department_Telephone">
<input type="text" data-table="department" data-field="x_Telephone" name="x_Telephone" id="x_Telephone" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($department_add->Telephone->getPlaceHolder()) ?>" value="<?php echo $department_add->Telephone->EditValue ?>"<?php echo $department_add->Telephone->editAttributes() ?>>
</span>
<?php echo $department_add->Telephone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($department_add->_Email->Visible) { // Email ?>
	<div id="r__Email" class="form-group row">
		<label id="elh_department__Email" for="x__Email" class="<?php echo $department_add->LeftColumnClass ?>"><?php echo $department_add->_Email->caption() ?><?php echo $department_add->_Email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_add->RightColumnClass ?>"><div <?php echo $department_add->_Email->cellAttributes() ?>>
<span id="el_department__Email">
<input type="text" data-table="department" data-field="x__Email" name="x__Email" id="x__Email" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($department_add->_Email->getPlaceHolder()) ?>" value="<?php echo $department_add->_Email->EditValue ?>"<?php echo $department_add->_Email->editAttributes() ?>>
</span>
<?php echo $department_add->_Email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($department_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_department_LACode" for="x_LACode" class="<?php echo $department_add->LeftColumnClass ?>"><?php echo $department_add->LACode->caption() ?><?php echo $department_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_add->RightColumnClass ?>"><div <?php echo $department_add->LACode->cellAttributes() ?>>
<?php if ($department_add->LACode->getSessionValue() != "") { ?>
<span id="el_department_LACode">
<span<?php echo $department_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($department_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_department_LACode">
<?php $department_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="department" data-field="x_LACode" data-value-separator="<?php echo $department_add->LACode->displayValueSeparatorAttribute() ?>" id="x_LACode" name="x_LACode"<?php echo $department_add->LACode->editAttributes() ?>>
			<?php echo $department_add->LACode->selectOptionListHtml("x_LACode") ?>
		</select>
</div>
<?php echo $department_add->LACode->Lookup->getParamTag($department_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $department_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($department_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_department_ProvinceCode" for="x_ProvinceCode" class="<?php echo $department_add->LeftColumnClass ?>"><?php echo $department_add->ProvinceCode->caption() ?><?php echo $department_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_add->RightColumnClass ?>"><div <?php echo $department_add->ProvinceCode->cellAttributes() ?>>
<?php if ($department_add->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_department_ProvinceCode">
<span<?php echo $department_add->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_add->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($department_add->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_department_ProvinceCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="department" data-field="x_ProvinceCode" data-value-separator="<?php echo $department_add->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $department_add->ProvinceCode->editAttributes() ?>>
			<?php echo $department_add->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $department_add->ProvinceCode->Lookup->getParamTag($department_add, "p_x_ProvinceCode") ?>
</span>
<?php } ?>
<?php echo $department_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("dept_section", explode(",", $department->getCurrentDetailTable())) && $dept_section->DetailAdd) {
?>
<?php if ($department->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("dept_section", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "dept_sectiongrid.php" ?>
<?php } ?>
<?php if (!$department_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $department_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $department_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$department_add->showPageFooter();
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
$department_add->terminate();
?>