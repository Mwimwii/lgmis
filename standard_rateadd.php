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
$standard_rate_add = new standard_rate_add();

// Run the page
$standard_rate_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$standard_rate_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstandard_rateadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fstandard_rateadd = currentForm = new ew.Form("fstandard_rateadd", "add");

	// Validate form
	fstandard_rateadd.validate = function() {
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
			<?php if ($standard_rate_add->account_id->Required) { ?>
				elm = this.getElements("x" + infix + "_account_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $standard_rate_add->account_id->caption(), $standard_rate_add->account_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_account_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($standard_rate_add->account_id->errorMessage()) ?>");
			<?php if ($standard_rate_add->moimp_code->Required) { ?>
				elm = this.getElements("x" + infix + "_moimp_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $standard_rate_add->moimp_code->caption(), $standard_rate_add->moimp_code->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_moimp_code");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($standard_rate_add->moimp_code->errorMessage()) ?>");
			<?php if ($standard_rate_add->account_code->Required) { ?>
				elm = this.getElements("x" + infix + "_account_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $standard_rate_add->account_code->caption(), $standard_rate_add->account_code->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($standard_rate_add->period_code->Required) { ?>
				elm = this.getElements("x" + infix + "_period_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $standard_rate_add->period_code->caption(), $standard_rate_add->period_code->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_period_code");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($standard_rate_add->period_code->errorMessage()) ?>");
			<?php if ($standard_rate_add->level_code->Required) { ?>
				elm = this.getElements("x" + infix + "_level_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $standard_rate_add->level_code->caption(), $standard_rate_add->level_code->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_level_code");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($standard_rate_add->level_code->errorMessage()) ?>");
			<?php if ($standard_rate_add->destination_code->Required) { ?>
				elm = this.getElements("x" + infix + "_destination_code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $standard_rate_add->destination_code->caption(), $standard_rate_add->destination_code->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_destination_code");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($standard_rate_add->destination_code->errorMessage()) ?>");
			<?php if ($standard_rate_add->amount->Required) { ?>
				elm = this.getElements("x" + infix + "_amount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $standard_rate_add->amount->caption(), $standard_rate_add->amount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_amount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($standard_rate_add->amount->errorMessage()) ?>");
			<?php if ($standard_rate_add->currency_Code->Required) { ?>
				elm = this.getElements("x" + infix + "_currency_Code");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $standard_rate_add->currency_Code->caption(), $standard_rate_add->currency_Code->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($standard_rate_add->last_user->Required) { ?>
				elm = this.getElements("x" + infix + "_last_user");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $standard_rate_add->last_user->caption(), $standard_rate_add->last_user->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($standard_rate_add->last_update->Required) { ?>
				elm = this.getElements("x" + infix + "_last_update");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $standard_rate_add->last_update->caption(), $standard_rate_add->last_update->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_last_update");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($standard_rate_add->last_update->errorMessage()) ?>");

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
	fstandard_rateadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstandard_rateadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fstandard_rateadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $standard_rate_add->showPageHeader(); ?>
<?php
$standard_rate_add->showMessage();
?>
<form name="fstandard_rateadd" id="fstandard_rateadd" class="<?php echo $standard_rate_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="standard_rate">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$standard_rate_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($standard_rate_add->account_id->Visible) { // account_id ?>
	<div id="r_account_id" class="form-group row">
		<label id="elh_standard_rate_account_id" for="x_account_id" class="<?php echo $standard_rate_add->LeftColumnClass ?>"><?php echo $standard_rate_add->account_id->caption() ?><?php echo $standard_rate_add->account_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $standard_rate_add->RightColumnClass ?>"><div <?php echo $standard_rate_add->account_id->cellAttributes() ?>>
<span id="el_standard_rate_account_id">
<input type="text" data-table="standard_rate" data-field="x_account_id" name="x_account_id" id="x_account_id" placeholder="<?php echo HtmlEncode($standard_rate_add->account_id->getPlaceHolder()) ?>" value="<?php echo $standard_rate_add->account_id->EditValue ?>"<?php echo $standard_rate_add->account_id->editAttributes() ?>>
</span>
<?php echo $standard_rate_add->account_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($standard_rate_add->moimp_code->Visible) { // moimp_code ?>
	<div id="r_moimp_code" class="form-group row">
		<label id="elh_standard_rate_moimp_code" for="x_moimp_code" class="<?php echo $standard_rate_add->LeftColumnClass ?>"><?php echo $standard_rate_add->moimp_code->caption() ?><?php echo $standard_rate_add->moimp_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $standard_rate_add->RightColumnClass ?>"><div <?php echo $standard_rate_add->moimp_code->cellAttributes() ?>>
<span id="el_standard_rate_moimp_code">
<input type="text" data-table="standard_rate" data-field="x_moimp_code" name="x_moimp_code" id="x_moimp_code" size="30" placeholder="<?php echo HtmlEncode($standard_rate_add->moimp_code->getPlaceHolder()) ?>" value="<?php echo $standard_rate_add->moimp_code->EditValue ?>"<?php echo $standard_rate_add->moimp_code->editAttributes() ?>>
</span>
<?php echo $standard_rate_add->moimp_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($standard_rate_add->account_code->Visible) { // account_code ?>
	<div id="r_account_code" class="form-group row">
		<label id="elh_standard_rate_account_code" for="x_account_code" class="<?php echo $standard_rate_add->LeftColumnClass ?>"><?php echo $standard_rate_add->account_code->caption() ?><?php echo $standard_rate_add->account_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $standard_rate_add->RightColumnClass ?>"><div <?php echo $standard_rate_add->account_code->cellAttributes() ?>>
<span id="el_standard_rate_account_code">
<input type="text" data-table="standard_rate" data-field="x_account_code" name="x_account_code" id="x_account_code" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($standard_rate_add->account_code->getPlaceHolder()) ?>" value="<?php echo $standard_rate_add->account_code->EditValue ?>"<?php echo $standard_rate_add->account_code->editAttributes() ?>>
</span>
<?php echo $standard_rate_add->account_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($standard_rate_add->period_code->Visible) { // period_code ?>
	<div id="r_period_code" class="form-group row">
		<label id="elh_standard_rate_period_code" for="x_period_code" class="<?php echo $standard_rate_add->LeftColumnClass ?>"><?php echo $standard_rate_add->period_code->caption() ?><?php echo $standard_rate_add->period_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $standard_rate_add->RightColumnClass ?>"><div <?php echo $standard_rate_add->period_code->cellAttributes() ?>>
<span id="el_standard_rate_period_code">
<input type="text" data-table="standard_rate" data-field="x_period_code" name="x_period_code" id="x_period_code" size="30" placeholder="<?php echo HtmlEncode($standard_rate_add->period_code->getPlaceHolder()) ?>" value="<?php echo $standard_rate_add->period_code->EditValue ?>"<?php echo $standard_rate_add->period_code->editAttributes() ?>>
</span>
<?php echo $standard_rate_add->period_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($standard_rate_add->level_code->Visible) { // level_code ?>
	<div id="r_level_code" class="form-group row">
		<label id="elh_standard_rate_level_code" for="x_level_code" class="<?php echo $standard_rate_add->LeftColumnClass ?>"><?php echo $standard_rate_add->level_code->caption() ?><?php echo $standard_rate_add->level_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $standard_rate_add->RightColumnClass ?>"><div <?php echo $standard_rate_add->level_code->cellAttributes() ?>>
<span id="el_standard_rate_level_code">
<input type="text" data-table="standard_rate" data-field="x_level_code" name="x_level_code" id="x_level_code" size="30" placeholder="<?php echo HtmlEncode($standard_rate_add->level_code->getPlaceHolder()) ?>" value="<?php echo $standard_rate_add->level_code->EditValue ?>"<?php echo $standard_rate_add->level_code->editAttributes() ?>>
</span>
<?php echo $standard_rate_add->level_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($standard_rate_add->destination_code->Visible) { // destination_code ?>
	<div id="r_destination_code" class="form-group row">
		<label id="elh_standard_rate_destination_code" for="x_destination_code" class="<?php echo $standard_rate_add->LeftColumnClass ?>"><?php echo $standard_rate_add->destination_code->caption() ?><?php echo $standard_rate_add->destination_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $standard_rate_add->RightColumnClass ?>"><div <?php echo $standard_rate_add->destination_code->cellAttributes() ?>>
<span id="el_standard_rate_destination_code">
<input type="text" data-table="standard_rate" data-field="x_destination_code" name="x_destination_code" id="x_destination_code" size="30" placeholder="<?php echo HtmlEncode($standard_rate_add->destination_code->getPlaceHolder()) ?>" value="<?php echo $standard_rate_add->destination_code->EditValue ?>"<?php echo $standard_rate_add->destination_code->editAttributes() ?>>
</span>
<?php echo $standard_rate_add->destination_code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($standard_rate_add->amount->Visible) { // amount ?>
	<div id="r_amount" class="form-group row">
		<label id="elh_standard_rate_amount" for="x_amount" class="<?php echo $standard_rate_add->LeftColumnClass ?>"><?php echo $standard_rate_add->amount->caption() ?><?php echo $standard_rate_add->amount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $standard_rate_add->RightColumnClass ?>"><div <?php echo $standard_rate_add->amount->cellAttributes() ?>>
<span id="el_standard_rate_amount">
<input type="text" data-table="standard_rate" data-field="x_amount" name="x_amount" id="x_amount" size="30" placeholder="<?php echo HtmlEncode($standard_rate_add->amount->getPlaceHolder()) ?>" value="<?php echo $standard_rate_add->amount->EditValue ?>"<?php echo $standard_rate_add->amount->editAttributes() ?>>
</span>
<?php echo $standard_rate_add->amount->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($standard_rate_add->currency_Code->Visible) { // currency_Code ?>
	<div id="r_currency_Code" class="form-group row">
		<label id="elh_standard_rate_currency_Code" for="x_currency_Code" class="<?php echo $standard_rate_add->LeftColumnClass ?>"><?php echo $standard_rate_add->currency_Code->caption() ?><?php echo $standard_rate_add->currency_Code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $standard_rate_add->RightColumnClass ?>"><div <?php echo $standard_rate_add->currency_Code->cellAttributes() ?>>
<span id="el_standard_rate_currency_Code">
<input type="text" data-table="standard_rate" data-field="x_currency_Code" name="x_currency_Code" id="x_currency_Code" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($standard_rate_add->currency_Code->getPlaceHolder()) ?>" value="<?php echo $standard_rate_add->currency_Code->EditValue ?>"<?php echo $standard_rate_add->currency_Code->editAttributes() ?>>
</span>
<?php echo $standard_rate_add->currency_Code->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($standard_rate_add->last_user->Visible) { // last_user ?>
	<div id="r_last_user" class="form-group row">
		<label id="elh_standard_rate_last_user" for="x_last_user" class="<?php echo $standard_rate_add->LeftColumnClass ?>"><?php echo $standard_rate_add->last_user->caption() ?><?php echo $standard_rate_add->last_user->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $standard_rate_add->RightColumnClass ?>"><div <?php echo $standard_rate_add->last_user->cellAttributes() ?>>
<span id="el_standard_rate_last_user">
<input type="text" data-table="standard_rate" data-field="x_last_user" name="x_last_user" id="x_last_user" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($standard_rate_add->last_user->getPlaceHolder()) ?>" value="<?php echo $standard_rate_add->last_user->EditValue ?>"<?php echo $standard_rate_add->last_user->editAttributes() ?>>
</span>
<?php echo $standard_rate_add->last_user->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($standard_rate_add->last_update->Visible) { // last_update ?>
	<div id="r_last_update" class="form-group row">
		<label id="elh_standard_rate_last_update" for="x_last_update" class="<?php echo $standard_rate_add->LeftColumnClass ?>"><?php echo $standard_rate_add->last_update->caption() ?><?php echo $standard_rate_add->last_update->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $standard_rate_add->RightColumnClass ?>"><div <?php echo $standard_rate_add->last_update->cellAttributes() ?>>
<span id="el_standard_rate_last_update">
<input type="text" data-table="standard_rate" data-field="x_last_update" name="x_last_update" id="x_last_update" placeholder="<?php echo HtmlEncode($standard_rate_add->last_update->getPlaceHolder()) ?>" value="<?php echo $standard_rate_add->last_update->EditValue ?>"<?php echo $standard_rate_add->last_update->editAttributes() ?>>
</span>
<?php echo $standard_rate_add->last_update->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$standard_rate_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $standard_rate_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $standard_rate_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$standard_rate_add->showPageFooter();
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
$standard_rate_add->terminate();
?>