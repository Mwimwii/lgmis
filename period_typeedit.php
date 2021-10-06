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
$period_type_edit = new period_type_edit();

// Run the page
$period_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$period_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fperiod_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fperiod_typeedit = currentForm = new ew.Form("fperiod_typeedit", "edit");

	// Validate form
	fperiod_typeedit.validate = function() {
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
			<?php if ($period_type_edit->Period_Type->Required) { ?>
				elm = this.getElements("x" + infix + "_Period_Type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $period_type_edit->Period_Type->caption(), $period_type_edit->Period_Type->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($period_type_edit->PeriodTypeName->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodTypeName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $period_type_edit->PeriodTypeName->caption(), $period_type_edit->PeriodTypeName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($period_type_edit->PeriodLength->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodLength");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $period_type_edit->PeriodLength->caption(), $period_type_edit->PeriodLength->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PeriodLength");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($period_type_edit->PeriodLength->errorMessage()) ?>");
			<?php if ($period_type_edit->UnitOfMeasure->Required) { ?>
				elm = this.getElements("x" + infix + "_UnitOfMeasure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $period_type_edit->UnitOfMeasure->caption(), $period_type_edit->UnitOfMeasure->RequiredErrorMessage)) ?>");
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
	fperiod_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fperiod_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fperiod_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $period_type_edit->showPageHeader(); ?>
<?php
$period_type_edit->showMessage();
?>
<?php if (!$period_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $period_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fperiod_typeedit" id="fperiod_typeedit" class="<?php echo $period_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="period_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$period_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($period_type_edit->Period_Type->Visible) { // Period_Type ?>
	<div id="r_Period_Type" class="form-group row">
		<label id="elh_period_type_Period_Type" for="x_Period_Type" class="<?php echo $period_type_edit->LeftColumnClass ?>"><?php echo $period_type_edit->Period_Type->caption() ?><?php echo $period_type_edit->Period_Type->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $period_type_edit->RightColumnClass ?>"><div <?php echo $period_type_edit->Period_Type->cellAttributes() ?>>
<input type="text" data-table="period_type" data-field="x_Period_Type" name="x_Period_Type" id="x_Period_Type" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($period_type_edit->Period_Type->getPlaceHolder()) ?>" value="<?php echo $period_type_edit->Period_Type->EditValue ?>"<?php echo $period_type_edit->Period_Type->editAttributes() ?>>
<input type="hidden" data-table="period_type" data-field="x_Period_Type" name="o_Period_Type" id="o_Period_Type" value="<?php echo HtmlEncode($period_type_edit->Period_Type->OldValue != null ? $period_type_edit->Period_Type->OldValue : $period_type_edit->Period_Type->CurrentValue) ?>">
<?php echo $period_type_edit->Period_Type->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($period_type_edit->PeriodTypeName->Visible) { // PeriodTypeName ?>
	<div id="r_PeriodTypeName" class="form-group row">
		<label id="elh_period_type_PeriodTypeName" for="x_PeriodTypeName" class="<?php echo $period_type_edit->LeftColumnClass ?>"><?php echo $period_type_edit->PeriodTypeName->caption() ?><?php echo $period_type_edit->PeriodTypeName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $period_type_edit->RightColumnClass ?>"><div <?php echo $period_type_edit->PeriodTypeName->cellAttributes() ?>>
<span id="el_period_type_PeriodTypeName">
<input type="text" data-table="period_type" data-field="x_PeriodTypeName" name="x_PeriodTypeName" id="x_PeriodTypeName" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($period_type_edit->PeriodTypeName->getPlaceHolder()) ?>" value="<?php echo $period_type_edit->PeriodTypeName->EditValue ?>"<?php echo $period_type_edit->PeriodTypeName->editAttributes() ?>>
</span>
<?php echo $period_type_edit->PeriodTypeName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($period_type_edit->PeriodLength->Visible) { // PeriodLength ?>
	<div id="r_PeriodLength" class="form-group row">
		<label id="elh_period_type_PeriodLength" for="x_PeriodLength" class="<?php echo $period_type_edit->LeftColumnClass ?>"><?php echo $period_type_edit->PeriodLength->caption() ?><?php echo $period_type_edit->PeriodLength->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $period_type_edit->RightColumnClass ?>"><div <?php echo $period_type_edit->PeriodLength->cellAttributes() ?>>
<span id="el_period_type_PeriodLength">
<input type="text" data-table="period_type" data-field="x_PeriodLength" name="x_PeriodLength" id="x_PeriodLength" size="30" placeholder="<?php echo HtmlEncode($period_type_edit->PeriodLength->getPlaceHolder()) ?>" value="<?php echo $period_type_edit->PeriodLength->EditValue ?>"<?php echo $period_type_edit->PeriodLength->editAttributes() ?>>
</span>
<?php echo $period_type_edit->PeriodLength->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($period_type_edit->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<div id="r_UnitOfMeasure" class="form-group row">
		<label id="elh_period_type_UnitOfMeasure" for="x_UnitOfMeasure" class="<?php echo $period_type_edit->LeftColumnClass ?>"><?php echo $period_type_edit->UnitOfMeasure->caption() ?><?php echo $period_type_edit->UnitOfMeasure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $period_type_edit->RightColumnClass ?>"><div <?php echo $period_type_edit->UnitOfMeasure->cellAttributes() ?>>
<span id="el_period_type_UnitOfMeasure">
<input type="text" data-table="period_type" data-field="x_UnitOfMeasure" name="x_UnitOfMeasure" id="x_UnitOfMeasure" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($period_type_edit->UnitOfMeasure->getPlaceHolder()) ?>" value="<?php echo $period_type_edit->UnitOfMeasure->EditValue ?>"<?php echo $period_type_edit->UnitOfMeasure->editAttributes() ?>>
</span>
<?php echo $period_type_edit->UnitOfMeasure->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$period_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $period_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $period_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$period_type_edit->IsModal) { ?>
<?php echo $period_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$period_type_edit->showPageFooter();
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
$period_type_edit->terminate();
?>