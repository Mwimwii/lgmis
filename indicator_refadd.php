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
$indicator_ref_add = new indicator_ref_add();

// Run the page
$indicator_ref_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$indicator_ref_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var findicator_refadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	findicator_refadd = currentForm = new ew.Form("findicator_refadd", "add");

	// Validate form
	findicator_refadd.validate = function() {
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
			<?php if ($indicator_ref_add->indicator_code->Required) { ?>
				elm = this.getElements("x" + infix + "_indicator_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_ref_add->indicator_code->caption(), $indicator_ref_add->indicator_code->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_indicator_code");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($indicator_ref_add->indicator_code->errorMessage()) ?>");
			<?php if ($indicator_ref_add->indicator_name->Required) { ?>
				elm = this.getElements("x" + infix + "_indicator_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_ref_add->indicator_name->caption(), $indicator_ref_add->indicator_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($indicator_ref_add->indicator_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_indicator_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_ref_add->indicator_desc->caption(), $indicator_ref_add->indicator_desc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($indicator_ref_add->formula_ref->Required) { ?>
				elm = this.getElements("x" + infix + "_formula_ref");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_ref_add->formula_ref->caption(), $indicator_ref_add->formula_ref->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($indicator_ref_add->direction->Required) { ?>
				elm = this.getElements("x" + infix + "_direction");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_ref_add->direction->caption(), $indicator_ref_add->direction->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($indicator_ref_add->target->Required) { ?>
				elm = this.getElements("x" + infix + "_target");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_ref_add->target->caption(), $indicator_ref_add->target->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_target");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($indicator_ref_add->target->errorMessage()) ?>");
			<?php if ($indicator_ref_add->indicator_measure->Required) { ?>
				elm = this.getElements("x" + infix + "_indicator_measure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_ref_add->indicator_measure->caption(), $indicator_ref_add->indicator_measure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($indicator_ref_add->indicator_frequency->Required) { ?>
				elm = this.getElements("x" + infix + "_indicator_frequency");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $indicator_ref_add->indicator_frequency->caption(), $indicator_ref_add->indicator_frequency->RequiredErrorMessage)) ?>");
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
	findicator_refadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	findicator_refadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	findicator_refadd.lists["x_direction"] = <?php echo $indicator_ref_add->direction->Lookup->toClientList($indicator_ref_add) ?>;
	findicator_refadd.lists["x_direction"].options = <?php echo JsonEncode($indicator_ref_add->direction->lookupOptions()) ?>;
	findicator_refadd.lists["x_indicator_measure"] = <?php echo $indicator_ref_add->indicator_measure->Lookup->toClientList($indicator_ref_add) ?>;
	findicator_refadd.lists["x_indicator_measure"].options = <?php echo JsonEncode($indicator_ref_add->indicator_measure->lookupOptions()) ?>;
	findicator_refadd.lists["x_indicator_frequency"] = <?php echo $indicator_ref_add->indicator_frequency->Lookup->toClientList($indicator_ref_add) ?>;
	findicator_refadd.lists["x_indicator_frequency"].options = <?php echo JsonEncode($indicator_ref_add->indicator_frequency->lookupOptions()) ?>;
	loadjs.done("findicator_refadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $indicator_ref_add->showPageHeader(); ?>
<?php
$indicator_ref_add->showMessage();
?>
<form name="findicator_refadd" id="findicator_refadd" class="<?php echo $indicator_ref_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="indicator_ref">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$indicator_ref_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($indicator_ref_add->indicator_code->Visible) { // indicator_code ?>
	<div id="r_indicator_code" class="form-group row">
		<label id="elh_indicator_ref_indicator_code" for="x_indicator_code" class="<?php echo $indicator_ref_add->LeftColumnClass ?>"><?php echo $indicator_ref_add->indicator_code->caption() ?><?php echo $indicator_ref_add->indicator_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_ref_add->RightColumnClass ?>"><div <?php echo $indicator_ref_add->indicator_code->cellAttributes() ?>>
<span id="el_indicator_ref_indicator_code">
<input type="text" data-table="indicator_ref" data-field="x_indicator_code" name="x_indicator_code" id="x_indicator_code" placeholder="<?php echo HtmlEncode($indicator_ref_add->indicator_code->getPlaceHolder()) ?>" value="<?php echo $indicator_ref_add->indicator_code->EditValue ?>"<?php echo $indicator_ref_add->indicator_code->editAttributes() ?>>
</span>
<?php echo $indicator_ref_add->indicator_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($indicator_ref_add->indicator_name->Visible) { // indicator_name ?>
	<div id="r_indicator_name" class="form-group row">
		<label id="elh_indicator_ref_indicator_name" for="x_indicator_name" class="<?php echo $indicator_ref_add->LeftColumnClass ?>"><?php echo $indicator_ref_add->indicator_name->caption() ?><?php echo $indicator_ref_add->indicator_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_ref_add->RightColumnClass ?>"><div <?php echo $indicator_ref_add->indicator_name->cellAttributes() ?>>
<span id="el_indicator_ref_indicator_name">
<input type="text" data-table="indicator_ref" data-field="x_indicator_name" name="x_indicator_name" id="x_indicator_name" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($indicator_ref_add->indicator_name->getPlaceHolder()) ?>" value="<?php echo $indicator_ref_add->indicator_name->EditValue ?>"<?php echo $indicator_ref_add->indicator_name->editAttributes() ?>>
</span>
<?php echo $indicator_ref_add->indicator_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($indicator_ref_add->indicator_desc->Visible) { // indicator_desc ?>
	<div id="r_indicator_desc" class="form-group row">
		<label id="elh_indicator_ref_indicator_desc" for="x_indicator_desc" class="<?php echo $indicator_ref_add->LeftColumnClass ?>"><?php echo $indicator_ref_add->indicator_desc->caption() ?><?php echo $indicator_ref_add->indicator_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_ref_add->RightColumnClass ?>"><div <?php echo $indicator_ref_add->indicator_desc->cellAttributes() ?>>
<span id="el_indicator_ref_indicator_desc">
<input type="text" data-table="indicator_ref" data-field="x_indicator_desc" name="x_indicator_desc" id="x_indicator_desc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($indicator_ref_add->indicator_desc->getPlaceHolder()) ?>" value="<?php echo $indicator_ref_add->indicator_desc->EditValue ?>"<?php echo $indicator_ref_add->indicator_desc->editAttributes() ?>>
</span>
<?php echo $indicator_ref_add->indicator_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($indicator_ref_add->formula_ref->Visible) { // formula_ref ?>
	<div id="r_formula_ref" class="form-group row">
		<label id="elh_indicator_ref_formula_ref" for="x_formula_ref" class="<?php echo $indicator_ref_add->LeftColumnClass ?>"><?php echo $indicator_ref_add->formula_ref->caption() ?><?php echo $indicator_ref_add->formula_ref->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_ref_add->RightColumnClass ?>"><div <?php echo $indicator_ref_add->formula_ref->cellAttributes() ?>>
<span id="el_indicator_ref_formula_ref">
<input type="text" data-table="indicator_ref" data-field="x_formula_ref" name="x_formula_ref" id="x_formula_ref" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($indicator_ref_add->formula_ref->getPlaceHolder()) ?>" value="<?php echo $indicator_ref_add->formula_ref->EditValue ?>"<?php echo $indicator_ref_add->formula_ref->editAttributes() ?>>
</span>
<?php echo $indicator_ref_add->formula_ref->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($indicator_ref_add->direction->Visible) { // direction ?>
	<div id="r_direction" class="form-group row">
		<label id="elh_indicator_ref_direction" for="x_direction" class="<?php echo $indicator_ref_add->LeftColumnClass ?>"><?php echo $indicator_ref_add->direction->caption() ?><?php echo $indicator_ref_add->direction->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_ref_add->RightColumnClass ?>"><div <?php echo $indicator_ref_add->direction->cellAttributes() ?>>
<span id="el_indicator_ref_direction">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="indicator_ref" data-field="x_direction" data-value-separator="<?php echo $indicator_ref_add->direction->displayValueSeparatorAttribute() ?>" id="x_direction" name="x_direction"<?php echo $indicator_ref_add->direction->editAttributes() ?>>
			<?php echo $indicator_ref_add->direction->selectOptionListHtml("x_direction") ?>
		</select>
</div>
<?php echo $indicator_ref_add->direction->Lookup->getParamTag($indicator_ref_add, "p_x_direction") ?>
</span>
<?php echo $indicator_ref_add->direction->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($indicator_ref_add->target->Visible) { // target ?>
	<div id="r_target" class="form-group row">
		<label id="elh_indicator_ref_target" for="x_target" class="<?php echo $indicator_ref_add->LeftColumnClass ?>"><?php echo $indicator_ref_add->target->caption() ?><?php echo $indicator_ref_add->target->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_ref_add->RightColumnClass ?>"><div <?php echo $indicator_ref_add->target->cellAttributes() ?>>
<span id="el_indicator_ref_target">
<input type="text" data-table="indicator_ref" data-field="x_target" name="x_target" id="x_target" size="30" placeholder="<?php echo HtmlEncode($indicator_ref_add->target->getPlaceHolder()) ?>" value="<?php echo $indicator_ref_add->target->EditValue ?>"<?php echo $indicator_ref_add->target->editAttributes() ?>>
</span>
<?php echo $indicator_ref_add->target->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($indicator_ref_add->indicator_measure->Visible) { // indicator_measure ?>
	<div id="r_indicator_measure" class="form-group row">
		<label id="elh_indicator_ref_indicator_measure" for="x_indicator_measure" class="<?php echo $indicator_ref_add->LeftColumnClass ?>"><?php echo $indicator_ref_add->indicator_measure->caption() ?><?php echo $indicator_ref_add->indicator_measure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_ref_add->RightColumnClass ?>"><div <?php echo $indicator_ref_add->indicator_measure->cellAttributes() ?>>
<span id="el_indicator_ref_indicator_measure">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="indicator_ref" data-field="x_indicator_measure" data-value-separator="<?php echo $indicator_ref_add->indicator_measure->displayValueSeparatorAttribute() ?>" id="x_indicator_measure" name="x_indicator_measure"<?php echo $indicator_ref_add->indicator_measure->editAttributes() ?>>
			<?php echo $indicator_ref_add->indicator_measure->selectOptionListHtml("x_indicator_measure") ?>
		</select>
</div>
<?php echo $indicator_ref_add->indicator_measure->Lookup->getParamTag($indicator_ref_add, "p_x_indicator_measure") ?>
</span>
<?php echo $indicator_ref_add->indicator_measure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($indicator_ref_add->indicator_frequency->Visible) { // indicator_frequency ?>
	<div id="r_indicator_frequency" class="form-group row">
		<label id="elh_indicator_ref_indicator_frequency" for="x_indicator_frequency" class="<?php echo $indicator_ref_add->LeftColumnClass ?>"><?php echo $indicator_ref_add->indicator_frequency->caption() ?><?php echo $indicator_ref_add->indicator_frequency->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $indicator_ref_add->RightColumnClass ?>"><div <?php echo $indicator_ref_add->indicator_frequency->cellAttributes() ?>>
<span id="el_indicator_ref_indicator_frequency">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="indicator_ref" data-field="x_indicator_frequency" data-value-separator="<?php echo $indicator_ref_add->indicator_frequency->displayValueSeparatorAttribute() ?>" id="x_indicator_frequency" name="x_indicator_frequency"<?php echo $indicator_ref_add->indicator_frequency->editAttributes() ?>>
			<?php echo $indicator_ref_add->indicator_frequency->selectOptionListHtml("x_indicator_frequency") ?>
		</select>
</div>
<?php echo $indicator_ref_add->indicator_frequency->Lookup->getParamTag($indicator_ref_add, "p_x_indicator_frequency") ?>
</span>
<?php echo $indicator_ref_add->indicator_frequency->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$indicator_ref_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $indicator_ref_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $indicator_ref_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$indicator_ref_add->showPageFooter();
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
$indicator_ref_add->terminate();
?>