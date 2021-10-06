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
$department_type_add = new department_type_add();

// Run the page
$department_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$department_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdepartment_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fdepartment_typeadd = currentForm = new ew.Form("fdepartment_typeadd", "add");

	// Validate form
	fdepartment_typeadd.validate = function() {
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
			<?php if ($department_type_add->DepartmentName->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_type_add->DepartmentName->caption(), $department_type_add->DepartmentName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($department_type_add->CouncilType->Required) { ?>
				elm = this.getElements("x" + infix + "_CouncilType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $department_type_add->CouncilType->caption(), $department_type_add->CouncilType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CouncilType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($department_type_add->CouncilType->errorMessage()) ?>");

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
	fdepartment_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fdepartment_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fdepartment_typeadd.lists["x_CouncilType"] = <?php echo $department_type_add->CouncilType->Lookup->toClientList($department_type_add) ?>;
	fdepartment_typeadd.lists["x_CouncilType"].options = <?php echo JsonEncode($department_type_add->CouncilType->lookupOptions()) ?>;
	fdepartment_typeadd.autoSuggests["x_CouncilType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fdepartment_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $department_type_add->showPageHeader(); ?>
<?php
$department_type_add->showMessage();
?>
<form name="fdepartment_typeadd" id="fdepartment_typeadd" class="<?php echo $department_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="department_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$department_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($department_type_add->DepartmentName->Visible) { // DepartmentName ?>
	<div id="r_DepartmentName" class="form-group row">
		<label id="elh_department_type_DepartmentName" for="x_DepartmentName" class="<?php echo $department_type_add->LeftColumnClass ?>"><?php echo $department_type_add->DepartmentName->caption() ?><?php echo $department_type_add->DepartmentName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_type_add->RightColumnClass ?>"><div <?php echo $department_type_add->DepartmentName->cellAttributes() ?>>
<span id="el_department_type_DepartmentName">
<input type="text" data-table="department_type" data-field="x_DepartmentName" name="x_DepartmentName" id="x_DepartmentName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($department_type_add->DepartmentName->getPlaceHolder()) ?>" value="<?php echo $department_type_add->DepartmentName->EditValue ?>"<?php echo $department_type_add->DepartmentName->editAttributes() ?>>
</span>
<?php echo $department_type_add->DepartmentName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($department_type_add->CouncilType->Visible) { // CouncilType ?>
	<div id="r_CouncilType" class="form-group row">
		<label id="elh_department_type_CouncilType" class="<?php echo $department_type_add->LeftColumnClass ?>"><?php echo $department_type_add->CouncilType->caption() ?><?php echo $department_type_add->CouncilType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $department_type_add->RightColumnClass ?>"><div <?php echo $department_type_add->CouncilType->cellAttributes() ?>>
<span id="el_department_type_CouncilType">
<?php
$onchange = $department_type_add->CouncilType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$department_type_add->CouncilType->EditAttrs["onchange"] = "";
?>
<span id="as_x_CouncilType">
	<input type="text" class="form-control" name="sv_x_CouncilType" id="sv_x_CouncilType" value="<?php echo RemoveHtml($department_type_add->CouncilType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($department_type_add->CouncilType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($department_type_add->CouncilType->getPlaceHolder()) ?>"<?php echo $department_type_add->CouncilType->editAttributes() ?>>
</span>
<input type="hidden" data-table="department_type" data-field="x_CouncilType" data-value-separator="<?php echo $department_type_add->CouncilType->displayValueSeparatorAttribute() ?>" name="x_CouncilType" id="x_CouncilType" value="<?php echo HtmlEncode($department_type_add->CouncilType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fdepartment_typeadd"], function() {
	fdepartment_typeadd.createAutoSuggest({"id":"x_CouncilType","forceSelect":false});
});
</script>
<?php echo $department_type_add->CouncilType->Lookup->getParamTag($department_type_add, "p_x_CouncilType") ?>
</span>
<?php echo $department_type_add->CouncilType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$department_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $department_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $department_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$department_type_add->showPageFooter();
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
$department_type_add->terminate();
?>