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
$department_type_edit = new department_type_edit();

// Run the page
$department_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$department_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdepartment_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fdepartment_typeedit = currentForm = new ew.Form("fdepartment_typeedit", "edit");

	// Validate form
	fdepartment_typeedit.validate = function() {
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
			<?php if ($department_type_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_type_edit->DepartmentCode->caption(), $department_type_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_type_edit->DepartmentName->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_type_edit->DepartmentName->caption(), $department_type_edit->DepartmentName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_type_edit->CouncilType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_type_edit->CouncilType->caption(), $department_type_edit->CouncilType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CouncilType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($department_type_edit->CouncilType->errorMessage()) ?>");

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
	fdepartment_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdepartment_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdepartment_typeedit.lists["x_CouncilType"] = <?php echo $department_type_edit->CouncilType->Lookup->toClientList($department_type_edit) ?>;
	fdepartment_typeedit.lists["x_CouncilType"].options = <?php echo JsonEncode($department_type_edit->CouncilType->lookupOptions()) ?>;
	fdepartment_typeedit.autoSuggests["x_CouncilType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdepartment_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $department_type_edit->showPageHeader(); ?>
<?php
$department_type_edit->showMessage();
?>
<?php if (!$department_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $department_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fdepartment_typeedit" id="fdepartment_typeedit" class="<?php echo $department_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="department_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$department_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($department_type_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_department_type_DepartmentCode" class="<?php echo $department_type_edit->LeftColumnClass ?>"><?php echo $department_type_edit->DepartmentCode->caption() ?><?php echo $department_type_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_type_edit->RightColumnClass ?>"><div <?php echo $department_type_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_department_type_DepartmentCode">
<span<?php echo $department_type_edit->DepartmentCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($department_type_edit->DepartmentCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="department_type" data-field="x_DepartmentCode" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo HtmlEncode($department_type_edit->DepartmentCode->CurrentValue) ?>">
<?php echo $department_type_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($department_type_edit->DepartmentName->Visible) { // DepartmentName ?>
	<div id="r_DepartmentName" class="form-group row">
		<label id="elh_department_type_DepartmentName" for="x_DepartmentName" class="<?php echo $department_type_edit->LeftColumnClass ?>"><?php echo $department_type_edit->DepartmentName->caption() ?><?php echo $department_type_edit->DepartmentName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_type_edit->RightColumnClass ?>"><div <?php echo $department_type_edit->DepartmentName->cellAttributes() ?>>
<span id="el_department_type_DepartmentName">
<input type="text" data-table="department_type" data-field="x_DepartmentName" name="x_DepartmentName" id="x_DepartmentName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($department_type_edit->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $department_type_edit->DepartmentName->EditValue ?>"<?php echo $department_type_edit->DepartmentName->editAttributes() ?>>
</span>
<?php echo $department_type_edit->DepartmentName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($department_type_edit->CouncilType->Visible) { // CouncilType ?>
	<div id="r_CouncilType" class="form-group row">
		<label id="elh_department_type_CouncilType" class="<?php echo $department_type_edit->LeftColumnClass ?>"><?php echo $department_type_edit->CouncilType->caption() ?><?php echo $department_type_edit->CouncilType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_type_edit->RightColumnClass ?>"><div <?php echo $department_type_edit->CouncilType->cellAttributes() ?>>
<span id="el_department_type_CouncilType">
<?php
$onchange = $department_type_edit->CouncilType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$department_type_edit->CouncilType->EditAttrs["onchange"] = "";
?>
<span id="as_x_CouncilType">
	<input type="text" class="form-control" name="sv_x_CouncilType" id="sv_x_CouncilType" value="<?php echo RemoveHtml($department_type_edit->CouncilType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($department_type_edit->CouncilType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($department_type_edit->CouncilType->getPlaceHolder()) ?>"<?php echo $department_type_edit->CouncilType->editAttributes() ?>>
</span>
<input type="hidden" data-table="department_type" data-field="x_CouncilType" data-value-separator="<?php echo $department_type_edit->CouncilType->displayValueSeparatorAttribute() ?>" name="x_CouncilType" id="x_CouncilType" value="<?php echo HtmlEncode($department_type_edit->CouncilType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdepartment_typeedit"], function() {
	fdepartment_typeedit.createAutoSuggest({"id":"x_CouncilType","forceSelect":false});
});
</script>
<?php echo $department_type_edit->CouncilType->Lookup->getParamTag($department_type_edit, "p_x_CouncilType") ?>
</span>
<?php echo $department_type_edit->CouncilType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$department_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $department_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $department_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$department_type_edit->IsModal) { ?>
<?php echo $department_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$department_type_edit->showPageFooter();
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
$department_type_edit->terminate();
?>