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
$halfyear_ref_add = new halfyear_ref_add();

// Run the page
$halfyear_ref_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$halfyear_ref_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fhalfyear_refadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fhalfyear_refadd = currentForm = new ew.Form("fhalfyear_refadd", "add");

	// Validate form
	fhalfyear_refadd.validate = function() {
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
			<?php if ($halfyear_ref_add->HalfYear->Required) { ?>
				elm = this.getElements("x" + infix + "_HalfYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_add->HalfYear->caption(), $halfyear_ref_add->HalfYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($halfyear_ref_add->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_add->BillYear->caption(), $halfyear_ref_add->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($halfyear_ref_add->PropertyGroup->Required) { ?>
				elm = this.getElements("x" + infix + "_PropertyGroup");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_add->PropertyGroup->caption(), $halfyear_ref_add->PropertyGroup->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($halfyear_ref_add->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_add->StartDate->caption(), $halfyear_ref_add->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($halfyear_ref_add->StartDate->errorMessage()) ?>");
			<?php if ($halfyear_ref_add->Enddate->Required) { ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $halfyear_ref_add->Enddate->caption(), $halfyear_ref_add->Enddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($halfyear_ref_add->Enddate->errorMessage()) ?>");

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
	fhalfyear_refadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fhalfyear_refadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fhalfyear_refadd.lists["x_HalfYear"] = <?php echo $halfyear_ref_add->HalfYear->Lookup->toClientList($halfyear_ref_add) ?>;
	fhalfyear_refadd.lists["x_HalfYear"].options = <?php echo JsonEncode($halfyear_ref_add->HalfYear->options(FALSE, TRUE)) ?>;
	fhalfyear_refadd.lists["x_BillYear"] = <?php echo $halfyear_ref_add->BillYear->Lookup->toClientList($halfyear_ref_add) ?>;
	fhalfyear_refadd.lists["x_BillYear"].options = <?php echo JsonEncode($halfyear_ref_add->BillYear->lookupOptions()) ?>;
	fhalfyear_refadd.lists["x_PropertyGroup"] = <?php echo $halfyear_ref_add->PropertyGroup->Lookup->toClientList($halfyear_ref_add) ?>;
	fhalfyear_refadd.lists["x_PropertyGroup"].options = <?php echo JsonEncode($halfyear_ref_add->PropertyGroup->lookupOptions()) ?>;
	loadjs.done("fhalfyear_refadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $halfyear_ref_add->showPageHeader(); ?>
<?php
$halfyear_ref_add->showMessage();
?>
<form name="fhalfyear_refadd" id="fhalfyear_refadd" class="<?php echo $halfyear_ref_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="halfyear_ref">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$halfyear_ref_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($halfyear_ref_add->HalfYear->Visible) { // HalfYear ?>
	<div id="r_HalfYear" class="form-group row">
		<label id="elh_halfyear_ref_HalfYear" for="x_HalfYear" class="<?php echo $halfyear_ref_add->LeftColumnClass ?>"><?php echo $halfyear_ref_add->HalfYear->caption() ?><?php echo $halfyear_ref_add->HalfYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $halfyear_ref_add->RightColumnClass ?>"><div <?php echo $halfyear_ref_add->HalfYear->cellAttributes() ?>>
<span id="el_halfyear_ref_HalfYear">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="halfyear_ref" data-field="x_HalfYear" data-value-separator="<?php echo $halfyear_ref_add->HalfYear->displayValueSeparatorAttribute() ?>" id="x_HalfYear" name="x_HalfYear"<?php echo $halfyear_ref_add->HalfYear->editAttributes() ?>>
			<?php echo $halfyear_ref_add->HalfYear->selectOptionListHtml("x_HalfYear") ?>
		</select>
</div>
</span>
<?php echo $halfyear_ref_add->HalfYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($halfyear_ref_add->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_halfyear_ref_BillYear" for="x_BillYear" class="<?php echo $halfyear_ref_add->LeftColumnClass ?>"><?php echo $halfyear_ref_add->BillYear->caption() ?><?php echo $halfyear_ref_add->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $halfyear_ref_add->RightColumnClass ?>"><div <?php echo $halfyear_ref_add->BillYear->cellAttributes() ?>>
<span id="el_halfyear_ref_BillYear">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="halfyear_ref" data-field="x_BillYear" data-value-separator="<?php echo $halfyear_ref_add->BillYear->displayValueSeparatorAttribute() ?>" id="x_BillYear" name="x_BillYear"<?php echo $halfyear_ref_add->BillYear->editAttributes() ?>>
			<?php echo $halfyear_ref_add->BillYear->selectOptionListHtml("x_BillYear") ?>
		</select>
</div>
<?php echo $halfyear_ref_add->BillYear->Lookup->getParamTag($halfyear_ref_add, "p_x_BillYear") ?>
</span>
<?php echo $halfyear_ref_add->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($halfyear_ref_add->PropertyGroup->Visible) { // PropertyGroup ?>
	<div id="r_PropertyGroup" class="form-group row">
		<label id="elh_halfyear_ref_PropertyGroup" for="x_PropertyGroup" class="<?php echo $halfyear_ref_add->LeftColumnClass ?>"><?php echo $halfyear_ref_add->PropertyGroup->caption() ?><?php echo $halfyear_ref_add->PropertyGroup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $halfyear_ref_add->RightColumnClass ?>"><div <?php echo $halfyear_ref_add->PropertyGroup->cellAttributes() ?>>
<span id="el_halfyear_ref_PropertyGroup">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_PropertyGroup"><?php echo EmptyValue(strval($halfyear_ref_add->PropertyGroup->ViewValue)) ? $Language->phrase("PleaseSelect") : $halfyear_ref_add->PropertyGroup->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($halfyear_ref_add->PropertyGroup->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($halfyear_ref_add->PropertyGroup->ReadOnly || $halfyear_ref_add->PropertyGroup->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_PropertyGroup',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $halfyear_ref_add->PropertyGroup->Lookup->getParamTag($halfyear_ref_add, "p_x_PropertyGroup") ?>
<input type="hidden" data-table="halfyear_ref" data-field="x_PropertyGroup" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $halfyear_ref_add->PropertyGroup->displayValueSeparatorAttribute() ?>" name="x_PropertyGroup" id="x_PropertyGroup" value="<?php echo $halfyear_ref_add->PropertyGroup->CurrentValue ?>"<?php echo $halfyear_ref_add->PropertyGroup->editAttributes() ?>>
</span>
<?php echo $halfyear_ref_add->PropertyGroup->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($halfyear_ref_add->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_halfyear_ref_StartDate" for="x_StartDate" class="<?php echo $halfyear_ref_add->LeftColumnClass ?>"><?php echo $halfyear_ref_add->StartDate->caption() ?><?php echo $halfyear_ref_add->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $halfyear_ref_add->RightColumnClass ?>"><div <?php echo $halfyear_ref_add->StartDate->cellAttributes() ?>>
<span id="el_halfyear_ref_StartDate">
<input type="text" data-table="halfyear_ref" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($halfyear_ref_add->StartDate->getPlaceHolder()) ?>" value="<?php echo $halfyear_ref_add->StartDate->EditValue ?>"<?php echo $halfyear_ref_add->StartDate->editAttributes() ?>>
<?php if (!$halfyear_ref_add->StartDate->ReadOnly && !$halfyear_ref_add->StartDate->Disabled && !isset($halfyear_ref_add->StartDate->EditAttrs["readonly"]) && !isset($halfyear_ref_add->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhalfyear_refadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fhalfyear_refadd", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $halfyear_ref_add->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($halfyear_ref_add->Enddate->Visible) { // Enddate ?>
	<div id="r_Enddate" class="form-group row">
		<label id="elh_halfyear_ref_Enddate" for="x_Enddate" class="<?php echo $halfyear_ref_add->LeftColumnClass ?>"><?php echo $halfyear_ref_add->Enddate->caption() ?><?php echo $halfyear_ref_add->Enddate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $halfyear_ref_add->RightColumnClass ?>"><div <?php echo $halfyear_ref_add->Enddate->cellAttributes() ?>>
<span id="el_halfyear_ref_Enddate">
<input type="text" data-table="halfyear_ref" data-field="x_Enddate" name="x_Enddate" id="x_Enddate" placeholder="<?php echo HtmlEncode($halfyear_ref_add->Enddate->getPlaceHolder()) ?>" value="<?php echo $halfyear_ref_add->Enddate->EditValue ?>"<?php echo $halfyear_ref_add->Enddate->editAttributes() ?>>
<?php if (!$halfyear_ref_add->Enddate->ReadOnly && !$halfyear_ref_add->Enddate->Disabled && !isset($halfyear_ref_add->Enddate->EditAttrs["readonly"]) && !isset($halfyear_ref_add->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fhalfyear_refadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fhalfyear_refadd", "x_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $halfyear_ref_add->Enddate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$halfyear_ref_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $halfyear_ref_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $halfyear_ref_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$halfyear_ref_add->showPageFooter();
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
$halfyear_ref_add->terminate();
?>