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
$month_ref_add = new month_ref_add();

// Run the page
$month_ref_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$month_ref_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmonth_refadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmonth_refadd = currentForm = new ew.Form("fmonth_refadd", "add");

	// Validate form
	fmonth_refadd.validate = function() {
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
			<?php if ($month_ref_add->MonthCode->Required) { ?>
				elm = this.getElements("x" + infix + "_MonthCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $month_ref_add->MonthCode->caption(), $month_ref_add->MonthCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MonthCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($month_ref_add->MonthCode->errorMessage()) ?>");
			<?php if ($month_ref_add->MonthName->Required) { ?>
				elm = this.getElements("x" + infix + "_MonthName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $month_ref_add->MonthName->caption(), $month_ref_add->MonthName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($month_ref_add->MonthShort->Required) { ?>
				elm = this.getElements("x" + infix + "_MonthShort");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $month_ref_add->MonthShort->caption(), $month_ref_add->MonthShort->RequiredErrorMessage)) ?>");
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
	fmonth_refadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmonth_refadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmonth_refadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $month_ref_add->showPageHeader(); ?>
<?php
$month_ref_add->showMessage();
?>
<form name="fmonth_refadd" id="fmonth_refadd" class="<?php echo $month_ref_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="month_ref">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$month_ref_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($month_ref_add->MonthCode->Visible) { // MonthCode ?>
	<div id="r_MonthCode" class="form-group row">
		<label id="elh_month_ref_MonthCode" for="x_MonthCode" class="<?php echo $month_ref_add->LeftColumnClass ?>"><?php echo $month_ref_add->MonthCode->caption() ?><?php echo $month_ref_add->MonthCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $month_ref_add->RightColumnClass ?>"><div <?php echo $month_ref_add->MonthCode->cellAttributes() ?>>
<span id="el_month_ref_MonthCode">
<input type="text" data-table="month_ref" data-field="x_MonthCode" name="x_MonthCode" id="x_MonthCode" size="30" placeholder="<?php echo HtmlEncode($month_ref_add->MonthCode->getPlaceHolder()) ?>" value="<?php echo $month_ref_add->MonthCode->EditValue ?>"<?php echo $month_ref_add->MonthCode->editAttributes() ?>>
</span>
<?php echo $month_ref_add->MonthCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($month_ref_add->MonthName->Visible) { // MonthName ?>
	<div id="r_MonthName" class="form-group row">
		<label id="elh_month_ref_MonthName" for="x_MonthName" class="<?php echo $month_ref_add->LeftColumnClass ?>"><?php echo $month_ref_add->MonthName->caption() ?><?php echo $month_ref_add->MonthName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $month_ref_add->RightColumnClass ?>"><div <?php echo $month_ref_add->MonthName->cellAttributes() ?>>
<span id="el_month_ref_MonthName">
<input type="text" data-table="month_ref" data-field="x_MonthName" name="x_MonthName" id="x_MonthName" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($month_ref_add->MonthName->getPlaceHolder()) ?>" value="<?php echo $month_ref_add->MonthName->EditValue ?>"<?php echo $month_ref_add->MonthName->editAttributes() ?>>
</span>
<?php echo $month_ref_add->MonthName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($month_ref_add->MonthShort->Visible) { // MonthShort ?>
	<div id="r_MonthShort" class="form-group row">
		<label id="elh_month_ref_MonthShort" for="x_MonthShort" class="<?php echo $month_ref_add->LeftColumnClass ?>"><?php echo $month_ref_add->MonthShort->caption() ?><?php echo $month_ref_add->MonthShort->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $month_ref_add->RightColumnClass ?>"><div <?php echo $month_ref_add->MonthShort->cellAttributes() ?>>
<span id="el_month_ref_MonthShort">
<input type="text" data-table="month_ref" data-field="x_MonthShort" name="x_MonthShort" id="x_MonthShort" size="30" maxlength="4" placeholder="<?php echo HtmlEncode($month_ref_add->MonthShort->getPlaceHolder()) ?>" value="<?php echo $month_ref_add->MonthShort->EditValue ?>"<?php echo $month_ref_add->MonthShort->editAttributes() ?>>
</span>
<?php echo $month_ref_add->MonthShort->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$month_ref_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $month_ref_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $month_ref_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$month_ref_add->showPageFooter();
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
$month_ref_add->terminate();
?>