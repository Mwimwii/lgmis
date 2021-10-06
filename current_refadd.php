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
$current_ref_add = new current_ref_add();

// Run the page
$current_ref_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$current_ref_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcurrent_refadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcurrent_refadd = currentForm = new ew.Form("fcurrent_refadd", "add");

	// Validate form
	fcurrent_refadd.validate = function() {
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
			<?php if ($current_ref_add->PlanYear->Required) { ?>
				elm = this.getElements("x" + infix + "_PlanYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $current_ref_add->PlanYear->caption(), $current_ref_add->PlanYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlanYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($current_ref_add->PlanYear->errorMessage()) ?>");
			<?php if ($current_ref_add->DaysAfterMonthEnd->Required) { ?>
				elm = this.getElements("x" + infix + "_DaysAfterMonthEnd");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $current_ref_add->DaysAfterMonthEnd->caption(), $current_ref_add->DaysAfterMonthEnd->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DaysAfterMonthEnd");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($current_ref_add->DaysAfterMonthEnd->errorMessage()) ?>");
			<?php if ($current_ref_add->PlanClosingDate->Required) { ?>
				elm = this.getElements("x" + infix + "_PlanClosingDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $current_ref_add->PlanClosingDate->caption(), $current_ref_add->PlanClosingDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PlanClosingDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($current_ref_add->PlanClosingDate->errorMessage()) ?>");
			<?php if ($current_ref_add->CurrentMonthClosingDate->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentMonthClosingDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $current_ref_add->CurrentMonthClosingDate->caption(), $current_ref_add->CurrentMonthClosingDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentMonthClosingDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($current_ref_add->CurrentMonthClosingDate->errorMessage()) ?>");

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
	fcurrent_refadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcurrent_refadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fcurrent_refadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $current_ref_add->showPageHeader(); ?>
<?php
$current_ref_add->showMessage();
?>
<form name="fcurrent_refadd" id="fcurrent_refadd" class="<?php echo $current_ref_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="current_ref">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$current_ref_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($current_ref_add->PlanYear->Visible) { // PlanYear ?>
	<div id="r_PlanYear" class="form-group row">
		<label id="elh_current_ref_PlanYear" for="x_PlanYear" class="<?php echo $current_ref_add->LeftColumnClass ?>"><?php echo $current_ref_add->PlanYear->caption() ?><?php echo $current_ref_add->PlanYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $current_ref_add->RightColumnClass ?>"><div <?php echo $current_ref_add->PlanYear->cellAttributes() ?>>
<span id="el_current_ref_PlanYear">
<input type="text" data-table="current_ref" data-field="x_PlanYear" name="x_PlanYear" id="x_PlanYear" size="30" placeholder="<?php echo HtmlEncode($current_ref_add->PlanYear->getPlaceHolder()) ?>" value="<?php echo $current_ref_add->PlanYear->EditValue ?>"<?php echo $current_ref_add->PlanYear->editAttributes() ?>>
</span>
<?php echo $current_ref_add->PlanYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($current_ref_add->DaysAfterMonthEnd->Visible) { // DaysAfterMonthEnd ?>
	<div id="r_DaysAfterMonthEnd" class="form-group row">
		<label id="elh_current_ref_DaysAfterMonthEnd" for="x_DaysAfterMonthEnd" class="<?php echo $current_ref_add->LeftColumnClass ?>"><?php echo $current_ref_add->DaysAfterMonthEnd->caption() ?><?php echo $current_ref_add->DaysAfterMonthEnd->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $current_ref_add->RightColumnClass ?>"><div <?php echo $current_ref_add->DaysAfterMonthEnd->cellAttributes() ?>>
<span id="el_current_ref_DaysAfterMonthEnd">
<input type="text" data-table="current_ref" data-field="x_DaysAfterMonthEnd" name="x_DaysAfterMonthEnd" id="x_DaysAfterMonthEnd" size="30" placeholder="<?php echo HtmlEncode($current_ref_add->DaysAfterMonthEnd->getPlaceHolder()) ?>" value="<?php echo $current_ref_add->DaysAfterMonthEnd->EditValue ?>"<?php echo $current_ref_add->DaysAfterMonthEnd->editAttributes() ?>>
</span>
<?php echo $current_ref_add->DaysAfterMonthEnd->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($current_ref_add->PlanClosingDate->Visible) { // PlanClosingDate ?>
	<div id="r_PlanClosingDate" class="form-group row">
		<label id="elh_current_ref_PlanClosingDate" for="x_PlanClosingDate" class="<?php echo $current_ref_add->LeftColumnClass ?>"><?php echo $current_ref_add->PlanClosingDate->caption() ?><?php echo $current_ref_add->PlanClosingDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $current_ref_add->RightColumnClass ?>"><div <?php echo $current_ref_add->PlanClosingDate->cellAttributes() ?>>
<span id="el_current_ref_PlanClosingDate">
<input type="text" data-table="current_ref" data-field="x_PlanClosingDate" name="x_PlanClosingDate" id="x_PlanClosingDate" placeholder="<?php echo HtmlEncode($current_ref_add->PlanClosingDate->getPlaceHolder()) ?>" value="<?php echo $current_ref_add->PlanClosingDate->EditValue ?>"<?php echo $current_ref_add->PlanClosingDate->editAttributes() ?>>
</span>
<?php echo $current_ref_add->PlanClosingDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($current_ref_add->CurrentMonthClosingDate->Visible) { // CurrentMonthClosingDate ?>
	<div id="r_CurrentMonthClosingDate" class="form-group row">
		<label id="elh_current_ref_CurrentMonthClosingDate" for="x_CurrentMonthClosingDate" class="<?php echo $current_ref_add->LeftColumnClass ?>"><?php echo $current_ref_add->CurrentMonthClosingDate->caption() ?><?php echo $current_ref_add->CurrentMonthClosingDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $current_ref_add->RightColumnClass ?>"><div <?php echo $current_ref_add->CurrentMonthClosingDate->cellAttributes() ?>>
<span id="el_current_ref_CurrentMonthClosingDate">
<input type="text" data-table="current_ref" data-field="x_CurrentMonthClosingDate" name="x_CurrentMonthClosingDate" id="x_CurrentMonthClosingDate" placeholder="<?php echo HtmlEncode($current_ref_add->CurrentMonthClosingDate->getPlaceHolder()) ?>" value="<?php echo $current_ref_add->CurrentMonthClosingDate->EditValue ?>"<?php echo $current_ref_add->CurrentMonthClosingDate->editAttributes() ?>>
</span>
<?php echo $current_ref_add->CurrentMonthClosingDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$current_ref_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $current_ref_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $current_ref_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$current_ref_add->showPageFooter();
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
$current_ref_add->terminate();
?>