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
$period_type_add = new period_type_add();

// Run the page
$period_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$period_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fperiod_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fperiod_typeadd = currentForm = new ew.Form("fperiod_typeadd", "add");

	// Validate form
	fperiod_typeadd.validate = function() {
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
			<?php if ($period_type_add->Period_Type->Required) { ?>
				elm = this.getElements("x" + infix + "_Period_Type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $period_type_add->Period_Type->caption(), $period_type_add->Period_Type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($period_type_add->PeriodTypeName->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodTypeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $period_type_add->PeriodTypeName->caption(), $period_type_add->PeriodTypeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($period_type_add->PeriodLength->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodLength");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $period_type_add->PeriodLength->caption(), $period_type_add->PeriodLength->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PeriodLength");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($period_type_add->PeriodLength->errorMessage()) ?>");
			<?php if ($period_type_add->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $period_type_add->UnitOfMeasure->caption(), $period_type_add->UnitOfMeasure->RequiredErrorMessage)) ?>");
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
	fperiod_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fperiod_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fperiod_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $period_type_add->showPageHeader(); ?>
<?php
$period_type_add->showMessage();
?>
<form name="fperiod_typeadd" id="fperiod_typeadd" class="<?php echo $period_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="period_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$period_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($period_type_add->Period_Type->Visible) { // Period_Type ?>
	<div id="r_Period_Type" class="form-group row">
		<label id="elh_period_type_Period_Type" for="x_Period_Type" class="<?php echo $period_type_add->LeftColumnClass ?>"><?php echo $period_type_add->Period_Type->caption() ?><?php echo $period_type_add->Period_Type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $period_type_add->RightColumnClass ?>"><div <?php echo $period_type_add->Period_Type->cellAttributes() ?>>
<span id="el_period_type_Period_Type">
<input type="text" data-table="period_type" data-field="x_Period_Type" name="x_Period_Type" id="x_Period_Type" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($period_type_add->Period_Type->getPlaceHolder()) ?>" value="<?php echo $period_type_add->Period_Type->EditValue ?>"<?php echo $period_type_add->Period_Type->editAttributes() ?>>
</span>
<?php echo $period_type_add->Period_Type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($period_type_add->PeriodTypeName->Visible) { // PeriodTypeName ?>
	<div id="r_PeriodTypeName" class="form-group row">
		<label id="elh_period_type_PeriodTypeName" for="x_PeriodTypeName" class="<?php echo $period_type_add->LeftColumnClass ?>"><?php echo $period_type_add->PeriodTypeName->caption() ?><?php echo $period_type_add->PeriodTypeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $period_type_add->RightColumnClass ?>"><div <?php echo $period_type_add->PeriodTypeName->cellAttributes() ?>>
<span id="el_period_type_PeriodTypeName">
<input type="text" data-table="period_type" data-field="x_PeriodTypeName" name="x_PeriodTypeName" id="x_PeriodTypeName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($period_type_add->PeriodTypeName->getPlaceHolder()) ?>" value="<?php echo $period_type_add->PeriodTypeName->EditValue ?>"<?php echo $period_type_add->PeriodTypeName->editAttributes() ?>>
</span>
<?php echo $period_type_add->PeriodTypeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($period_type_add->PeriodLength->Visible) { // PeriodLength ?>
	<div id="r_PeriodLength" class="form-group row">
		<label id="elh_period_type_PeriodLength" for="x_PeriodLength" class="<?php echo $period_type_add->LeftColumnClass ?>"><?php echo $period_type_add->PeriodLength->caption() ?><?php echo $period_type_add->PeriodLength->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $period_type_add->RightColumnClass ?>"><div <?php echo $period_type_add->PeriodLength->cellAttributes() ?>>
<span id="el_period_type_PeriodLength">
<input type="text" data-table="period_type" data-field="x_PeriodLength" name="x_PeriodLength" id="x_PeriodLength" size="30" placeholder="<?php echo HtmlEncode($period_type_add->PeriodLength->getPlaceHolder()) ?>" value="<?php echo $period_type_add->PeriodLength->EditValue ?>"<?php echo $period_type_add->PeriodLength->editAttributes() ?>>
</span>
<?php echo $period_type_add->PeriodLength->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($period_type_add->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_period_type_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $period_type_add->LeftColumnClass ?>"><?php echo $period_type_add->UnitOfMeasure->caption() ?><?php echo $period_type_add->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $period_type_add->RightColumnClass ?>"><div <?php echo $period_type_add->UnitOfMeasure->cellAttributes() ?>>
<span id="el_period_type_UnitOfMeasure">
<input type="text" data-table="period_type" data-field="x_UnitOfMeasure" name="x_UnitOfMeasure" id="x_UnitOfMeasure" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($period_type_add->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $period_type_add->UnitOfMeasure->EditValue ?>"<?php echo $period_type_add->UnitOfMeasure->editAttributes() ?>>
</span>
<?php echo $period_type_add->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$period_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $period_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $period_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$period_type_add->showPageFooter();
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
$period_type_add->terminate();
?>