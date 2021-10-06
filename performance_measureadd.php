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
$performance_measure_add = new performance_measure_add();

// Run the page
$performance_measure_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$performance_measure_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fperformance_measureadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fperformance_measureadd = currentForm = new ew.Form("fperformance_measureadd", "add");

	// Validate form
	fperformance_measureadd.validate = function() {
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
			<?php if ($performance_measure_add->PefromanceRef->Required) { ?>
				elm = this.getElements("x" + infix + "_PefromanceRef");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->PefromanceRef->caption(), $performance_measure_add->PefromanceRef->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PefromanceRef");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($performance_measure_add->PefromanceRef->errorMessage()) ?>");
			<?php if ($performance_measure_add->IndicatorCode->Required) { ?>
				elm = this.getElements("x" + infix + "_IndicatorCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->IndicatorCode->caption(), $performance_measure_add->IndicatorCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IndicatorCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($performance_measure_add->IndicatorCode->errorMessage()) ?>");
			<?php if ($performance_measure_add->Category->Required) { ?>
				elm = this.getElements("x" + infix + "_Category");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->Category->caption(), $performance_measure_add->Category->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($performance_measure_add->TargetDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_TargetDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->TargetDesc->caption(), $performance_measure_add->TargetDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($performance_measure_add->Target->Required) { ?>
				elm = this.getElements("x" + infix + "_Target");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->Target->caption(), $performance_measure_add->Target->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Target");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($performance_measure_add->Target->errorMessage()) ?>");
			<?php if ($performance_measure_add->ValueDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ValueDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->ValueDesc->caption(), $performance_measure_add->ValueDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($performance_measure_add->Value->Required) { ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->Value->caption(), $performance_measure_add->Value->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Value");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($performance_measure_add->Value->errorMessage()) ?>");
			<?php if ($performance_measure_add->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->UnitOfMeasure->caption(), $performance_measure_add->UnitOfMeasure->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($performance_measure_add->Deviation->Required) { ?>
				elm = this.getElements("x" + infix + "_Deviation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->Deviation->caption(), $performance_measure_add->Deviation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($performance_measure_add->Recommendation->Required) { ?>
				elm = this.getElements("x" + infix + "_Recommendation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->Recommendation->caption(), $performance_measure_add->Recommendation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($performance_measure_add->Remedies->Required) { ?>
				elm = this.getElements("x" + infix + "_Remedies");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->Remedies->caption(), $performance_measure_add->Remedies->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($performance_measure_add->PMonth->Required) { ?>
				elm = this.getElements("x" + infix + "_PMonth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->PMonth->caption(), $performance_measure_add->PMonth->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($performance_measure_add->PYear->Required) { ?>
				elm = this.getElements("x" + infix + "_PYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $performance_measure_add->PYear->caption(), $performance_measure_add->PYear->RequiredErrorMessage)) ?>");
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
	fperformance_measureadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fperformance_measureadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fperformance_measureadd.lists["x_Category"] = <?php echo $performance_measure_add->Category->Lookup->toClientList($performance_measure_add) ?>;
	fperformance_measureadd.lists["x_Category"].options = <?php echo JsonEncode($performance_measure_add->Category->lookupOptions()) ?>;
	fperformance_measureadd.lists["x_UnitOfMeasure"] = <?php echo $performance_measure_add->UnitOfMeasure->Lookup->toClientList($performance_measure_add) ?>;
	fperformance_measureadd.lists["x_UnitOfMeasure"].options = <?php echo JsonEncode($performance_measure_add->UnitOfMeasure->lookupOptions()) ?>;
	fperformance_measureadd.lists["x_PMonth"] = <?php echo $performance_measure_add->PMonth->Lookup->toClientList($performance_measure_add) ?>;
	fperformance_measureadd.lists["x_PMonth"].options = <?php echo JsonEncode($performance_measure_add->PMonth->lookupOptions()) ?>;
	fperformance_measureadd.lists["x_PYear"] = <?php echo $performance_measure_add->PYear->Lookup->toClientList($performance_measure_add) ?>;
	fperformance_measureadd.lists["x_PYear"].options = <?php echo JsonEncode($performance_measure_add->PYear->lookupOptions()) ?>;
	loadjs.done("fperformance_measureadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $performance_measure_add->showPageHeader(); ?>
<?php
$performance_measure_add->showMessage();
?>
<form name="fperformance_measureadd" id="fperformance_measureadd" class="<?php echo $performance_measure_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="performance_measure">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$performance_measure_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($performance_measure_add->PefromanceRef->Visible) { // PefromanceRef ?>
	<div id="r_PefromanceRef" class="form-group row">
		<label id="elh_performance_measure_PefromanceRef" for="x_PefromanceRef" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->PefromanceRef->caption() ?><?php echo $performance_measure_add->PefromanceRef->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->PefromanceRef->cellAttributes() ?>>
<span id="el_performance_measure_PefromanceRef">
<input type="text" data-table="performance_measure" data-field="x_PefromanceRef" name="x_PefromanceRef" id="x_PefromanceRef" placeholder="<?php echo HtmlEncode($performance_measure_add->PefromanceRef->getPlaceHolder()) ?>" value="<?php echo $performance_measure_add->PefromanceRef->EditValue ?>"<?php echo $performance_measure_add->PefromanceRef->editAttributes() ?>>
</span>
<?php echo $performance_measure_add->PefromanceRef->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($performance_measure_add->IndicatorCode->Visible) { // IndicatorCode ?>
	<div id="r_IndicatorCode" class="form-group row">
		<label id="elh_performance_measure_IndicatorCode" for="x_IndicatorCode" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->IndicatorCode->caption() ?><?php echo $performance_measure_add->IndicatorCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->IndicatorCode->cellAttributes() ?>>
<span id="el_performance_measure_IndicatorCode">
<input type="text" data-table="performance_measure" data-field="x_IndicatorCode" name="x_IndicatorCode" id="x_IndicatorCode" size="30" placeholder="<?php echo HtmlEncode($performance_measure_add->IndicatorCode->getPlaceHolder()) ?>" value="<?php echo $performance_measure_add->IndicatorCode->EditValue ?>"<?php echo $performance_measure_add->IndicatorCode->editAttributes() ?>>
</span>
<?php echo $performance_measure_add->IndicatorCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($performance_measure_add->Category->Visible) { // Category ?>
	<div id="r_Category" class="form-group row">
		<label id="elh_performance_measure_Category" for="x_Category" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->Category->caption() ?><?php echo $performance_measure_add->Category->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->Category->cellAttributes() ?>>
<span id="el_performance_measure_Category">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="performance_measure" data-field="x_Category" data-value-separator="<?php echo $performance_measure_add->Category->displayValueSeparatorAttribute() ?>" id="x_Category" name="x_Category"<?php echo $performance_measure_add->Category->editAttributes() ?>>
			<?php echo $performance_measure_add->Category->selectOptionListHtml("x_Category") ?>
		</select>
</div>
<?php echo $performance_measure_add->Category->Lookup->getParamTag($performance_measure_add, "p_x_Category") ?>
</span>
<?php echo $performance_measure_add->Category->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($performance_measure_add->TargetDesc->Visible) { // TargetDesc ?>
	<div id="r_TargetDesc" class="form-group row">
		<label id="elh_performance_measure_TargetDesc" for="x_TargetDesc" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->TargetDesc->caption() ?><?php echo $performance_measure_add->TargetDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->TargetDesc->cellAttributes() ?>>
<span id="el_performance_measure_TargetDesc">
<input type="text" data-table="performance_measure" data-field="x_TargetDesc" name="x_TargetDesc" id="x_TargetDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($performance_measure_add->TargetDesc->getPlaceHolder()) ?>" value="<?php echo $performance_measure_add->TargetDesc->EditValue ?>"<?php echo $performance_measure_add->TargetDesc->editAttributes() ?>>
</span>
<?php echo $performance_measure_add->TargetDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($performance_measure_add->Target->Visible) { // Target ?>
	<div id="r_Target" class="form-group row">
		<label id="elh_performance_measure_Target" for="x_Target" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->Target->caption() ?><?php echo $performance_measure_add->Target->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->Target->cellAttributes() ?>>
<span id="el_performance_measure_Target">
<input type="text" data-table="performance_measure" data-field="x_Target" name="x_Target" id="x_Target" size="30" placeholder="<?php echo HtmlEncode($performance_measure_add->Target->getPlaceHolder()) ?>" value="<?php echo $performance_measure_add->Target->EditValue ?>"<?php echo $performance_measure_add->Target->editAttributes() ?>>
</span>
<?php echo $performance_measure_add->Target->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($performance_measure_add->ValueDesc->Visible) { // ValueDesc ?>
	<div id="r_ValueDesc" class="form-group row">
		<label id="elh_performance_measure_ValueDesc" for="x_ValueDesc" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->ValueDesc->caption() ?><?php echo $performance_measure_add->ValueDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->ValueDesc->cellAttributes() ?>>
<span id="el_performance_measure_ValueDesc">
<input type="text" data-table="performance_measure" data-field="x_ValueDesc" name="x_ValueDesc" id="x_ValueDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($performance_measure_add->ValueDesc->getPlaceHolder()) ?>" value="<?php echo $performance_measure_add->ValueDesc->EditValue ?>"<?php echo $performance_measure_add->ValueDesc->editAttributes() ?>>
</span>
<?php echo $performance_measure_add->ValueDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($performance_measure_add->Value->Visible) { // Value ?>
	<div id="r_Value" class="form-group row">
		<label id="elh_performance_measure_Value" for="x_Value" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->Value->caption() ?><?php echo $performance_measure_add->Value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->Value->cellAttributes() ?>>
<span id="el_performance_measure_Value">
<input type="text" data-table="performance_measure" data-field="x_Value" name="x_Value" id="x_Value" size="30" placeholder="<?php echo HtmlEncode($performance_measure_add->Value->getPlaceHolder()) ?>" value="<?php echo $performance_measure_add->Value->EditValue ?>"<?php echo $performance_measure_add->Value->editAttributes() ?>>
</span>
<?php echo $performance_measure_add->Value->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($performance_measure_add->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_performance_measure_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->UnitOfMeasure->caption() ?><?php echo $performance_measure_add->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->UnitOfMeasure->cellAttributes() ?>>
<span id="el_performance_measure_UnitOfMeasure">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="performance_measure" data-field="x_UnitOfMeasure" data-value-separator="<?php echo $performance_measure_add->UnitOfMeasure->displayValueSeparatorAttribute() ?>" id="x_UnitOfMeasure" name="x_UnitOfMeasure"<?php echo $performance_measure_add->UnitOfMeasure->editAttributes() ?>>
			<?php echo $performance_measure_add->UnitOfMeasure->selectOptionListHtml("x_UnitOfMeasure") ?>
		</select>
</div>
<?php echo $performance_measure_add->UnitOfMeasure->Lookup->getParamTag($performance_measure_add, "p_x_UnitOfMeasure") ?>
</span>
<?php echo $performance_measure_add->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($performance_measure_add->Deviation->Visible) { // Deviation ?>
	<div id="r_Deviation" class="form-group row">
		<label id="elh_performance_measure_Deviation" for="x_Deviation" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->Deviation->caption() ?><?php echo $performance_measure_add->Deviation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->Deviation->cellAttributes() ?>>
<span id="el_performance_measure_Deviation">
<input type="text" data-table="performance_measure" data-field="x_Deviation" name="x_Deviation" id="x_Deviation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($performance_measure_add->Deviation->getPlaceHolder()) ?>" value="<?php echo $performance_measure_add->Deviation->EditValue ?>"<?php echo $performance_measure_add->Deviation->editAttributes() ?>>
</span>
<?php echo $performance_measure_add->Deviation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($performance_measure_add->Recommendation->Visible) { // Recommendation ?>
	<div id="r_Recommendation" class="form-group row">
		<label id="elh_performance_measure_Recommendation" for="x_Recommendation" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->Recommendation->caption() ?><?php echo $performance_measure_add->Recommendation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->Recommendation->cellAttributes() ?>>
<span id="el_performance_measure_Recommendation">
<textarea data-table="performance_measure" data-field="x_Recommendation" name="x_Recommendation" id="x_Recommendation" cols="50" rows="2" placeholder="<?php echo HtmlEncode($performance_measure_add->Recommendation->getPlaceHolder()) ?>"<?php echo $performance_measure_add->Recommendation->editAttributes() ?>><?php echo $performance_measure_add->Recommendation->EditValue ?></textarea>
</span>
<?php echo $performance_measure_add->Recommendation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($performance_measure_add->Remedies->Visible) { // Remedies ?>
	<div id="r_Remedies" class="form-group row">
		<label id="elh_performance_measure_Remedies" for="x_Remedies" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->Remedies->caption() ?><?php echo $performance_measure_add->Remedies->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->Remedies->cellAttributes() ?>>
<span id="el_performance_measure_Remedies">
<textarea data-table="performance_measure" data-field="x_Remedies" name="x_Remedies" id="x_Remedies" cols="50" rows="2" placeholder="<?php echo HtmlEncode($performance_measure_add->Remedies->getPlaceHolder()) ?>"<?php echo $performance_measure_add->Remedies->editAttributes() ?>><?php echo $performance_measure_add->Remedies->EditValue ?></textarea>
</span>
<?php echo $performance_measure_add->Remedies->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($performance_measure_add->PMonth->Visible) { // PMonth ?>
	<div id="r_PMonth" class="form-group row">
		<label id="elh_performance_measure_PMonth" for="x_PMonth" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->PMonth->caption() ?><?php echo $performance_measure_add->PMonth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->PMonth->cellAttributes() ?>>
<span id="el_performance_measure_PMonth">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="performance_measure" data-field="x_PMonth" data-value-separator="<?php echo $performance_measure_add->PMonth->displayValueSeparatorAttribute() ?>" id="x_PMonth" name="x_PMonth"<?php echo $performance_measure_add->PMonth->editAttributes() ?>>
			<?php echo $performance_measure_add->PMonth->selectOptionListHtml("x_PMonth") ?>
		</select>
</div>
<?php echo $performance_measure_add->PMonth->Lookup->getParamTag($performance_measure_add, "p_x_PMonth") ?>
</span>
<?php echo $performance_measure_add->PMonth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($performance_measure_add->PYear->Visible) { // PYear ?>
	<div id="r_PYear" class="form-group row">
		<label id="elh_performance_measure_PYear" for="x_PYear" class="<?php echo $performance_measure_add->LeftColumnClass ?>"><?php echo $performance_measure_add->PYear->caption() ?><?php echo $performance_measure_add->PYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $performance_measure_add->RightColumnClass ?>"><div <?php echo $performance_measure_add->PYear->cellAttributes() ?>>
<span id="el_performance_measure_PYear">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="performance_measure" data-field="x_PYear" data-value-separator="<?php echo $performance_measure_add->PYear->displayValueSeparatorAttribute() ?>" id="x_PYear" name="x_PYear"<?php echo $performance_measure_add->PYear->editAttributes() ?>>
			<?php echo $performance_measure_add->PYear->selectOptionListHtml("x_PYear") ?>
		</select>
</div>
<?php echo $performance_measure_add->PYear->Lookup->getParamTag($performance_measure_add, "p_x_PYear") ?>
</span>
<?php echo $performance_measure_add->PYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$performance_measure_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $performance_measure_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $performance_measure_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$performance_measure_add->showPageFooter();
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
$performance_measure_add->terminate();
?>