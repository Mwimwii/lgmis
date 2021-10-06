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
$paye_rates_edit = new paye_rates_edit();

// Run the page
$paye_rates_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paye_rates_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpaye_ratesedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fpaye_ratesedit = currentForm = new ew.Form("fpaye_ratesedit", "edit");

	// Validate form
	fpaye_ratesedit.validate = function() {
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
			<?php if ($paye_rates_edit->band->Required) { ?>
				elm = this.getElements("x" + infix + "_band");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paye_rates_edit->band->caption(), $paye_rates_edit->band->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_band");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($paye_rates_edit->band->errorMessage()) ?>");
			<?php if ($paye_rates_edit->MinimumIncome->Required) { ?>
				elm = this.getElements("x" + infix + "_MinimumIncome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paye_rates_edit->MinimumIncome->caption(), $paye_rates_edit->MinimumIncome->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MinimumIncome");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($paye_rates_edit->MinimumIncome->errorMessage()) ?>");
			<?php if ($paye_rates_edit->MaximumIncome->Required) { ?>
				elm = this.getElements("x" + infix + "_MaximumIncome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paye_rates_edit->MaximumIncome->caption(), $paye_rates_edit->MaximumIncome->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MaximumIncome");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($paye_rates_edit->MaximumIncome->errorMessage()) ?>");
			<?php if ($paye_rates_edit->PAYERate->Required) { ?>
				elm = this.getElements("x" + infix + "_PAYERate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $paye_rates_edit->PAYERate->caption(), $paye_rates_edit->PAYERate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PAYERate");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($paye_rates_edit->PAYERate->errorMessage()) ?>");

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
	fpaye_ratesedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpaye_ratesedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpaye_ratesedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $paye_rates_edit->showPageHeader(); ?>
<?php
$paye_rates_edit->showMessage();
?>
<?php if (!$paye_rates_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_rates_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fpaye_ratesedit" id="fpaye_ratesedit" class="<?php echo $paye_rates_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paye_rates">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$paye_rates_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($paye_rates_edit->band->Visible) { // band ?>
	<div id="r_band" class="form-group row">
		<label id="elh_paye_rates_band" for="x_band" class="<?php echo $paye_rates_edit->LeftColumnClass ?>"><?php echo $paye_rates_edit->band->caption() ?><?php echo $paye_rates_edit->band->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $paye_rates_edit->RightColumnClass ?>"><div <?php echo $paye_rates_edit->band->cellAttributes() ?>>
<input type="text" data-table="paye_rates" data-field="x_band" name="x_band" id="x_band" size="30" placeholder="<?php echo HtmlEncode($paye_rates_edit->band->getPlaceHolder()) ?>" value="<?php echo $paye_rates_edit->band->EditValue ?>"<?php echo $paye_rates_edit->band->editAttributes() ?>>
<input type="hidden" data-table="paye_rates" data-field="x_band" name="o_band" id="o_band" value="<?php echo HtmlEncode($paye_rates_edit->band->OldValue != null ? $paye_rates_edit->band->OldValue : $paye_rates_edit->band->CurrentValue) ?>">
<?php echo $paye_rates_edit->band->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($paye_rates_edit->MinimumIncome->Visible) { // MinimumIncome ?>
	<div id="r_MinimumIncome" class="form-group row">
		<label id="elh_paye_rates_MinimumIncome" for="x_MinimumIncome" class="<?php echo $paye_rates_edit->LeftColumnClass ?>"><?php echo $paye_rates_edit->MinimumIncome->caption() ?><?php echo $paye_rates_edit->MinimumIncome->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $paye_rates_edit->RightColumnClass ?>"><div <?php echo $paye_rates_edit->MinimumIncome->cellAttributes() ?>>
<span id="el_paye_rates_MinimumIncome">
<input type="text" data-table="paye_rates" data-field="x_MinimumIncome" name="x_MinimumIncome" id="x_MinimumIncome" size="30" placeholder="<?php echo HtmlEncode($paye_rates_edit->MinimumIncome->getPlaceHolder()) ?>" value="<?php echo $paye_rates_edit->MinimumIncome->EditValue ?>"<?php echo $paye_rates_edit->MinimumIncome->editAttributes() ?>>
</span>
<?php echo $paye_rates_edit->MinimumIncome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($paye_rates_edit->MaximumIncome->Visible) { // MaximumIncome ?>
	<div id="r_MaximumIncome" class="form-group row">
		<label id="elh_paye_rates_MaximumIncome" for="x_MaximumIncome" class="<?php echo $paye_rates_edit->LeftColumnClass ?>"><?php echo $paye_rates_edit->MaximumIncome->caption() ?><?php echo $paye_rates_edit->MaximumIncome->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $paye_rates_edit->RightColumnClass ?>"><div <?php echo $paye_rates_edit->MaximumIncome->cellAttributes() ?>>
<span id="el_paye_rates_MaximumIncome">
<input type="text" data-table="paye_rates" data-field="x_MaximumIncome" name="x_MaximumIncome" id="x_MaximumIncome" size="30" placeholder="<?php echo HtmlEncode($paye_rates_edit->MaximumIncome->getPlaceHolder()) ?>" value="<?php echo $paye_rates_edit->MaximumIncome->EditValue ?>"<?php echo $paye_rates_edit->MaximumIncome->editAttributes() ?>>
</span>
<?php echo $paye_rates_edit->MaximumIncome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($paye_rates_edit->PAYERate->Visible) { // PAYERate ?>
	<div id="r_PAYERate" class="form-group row">
		<label id="elh_paye_rates_PAYERate" for="x_PAYERate" class="<?php echo $paye_rates_edit->LeftColumnClass ?>"><?php echo $paye_rates_edit->PAYERate->caption() ?><?php echo $paye_rates_edit->PAYERate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $paye_rates_edit->RightColumnClass ?>"><div <?php echo $paye_rates_edit->PAYERate->cellAttributes() ?>>
<span id="el_paye_rates_PAYERate">
<input type="text" data-table="paye_rates" data-field="x_PAYERate" name="x_PAYERate" id="x_PAYERate" size="30" placeholder="<?php echo HtmlEncode($paye_rates_edit->PAYERate->getPlaceHolder()) ?>" value="<?php echo $paye_rates_edit->PAYERate->EditValue ?>"<?php echo $paye_rates_edit->PAYERate->editAttributes() ?>>
</span>
<?php echo $paye_rates_edit->PAYERate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$paye_rates_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $paye_rates_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $paye_rates_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$paye_rates_edit->IsModal) { ?>
<?php echo $paye_rates_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$paye_rates_edit->showPageFooter();
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
$paye_rates_edit->terminate();
?>