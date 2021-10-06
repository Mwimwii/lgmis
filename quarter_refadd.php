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
$quarter_ref_add = new quarter_ref_add();

// Run the page
$quarter_ref_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$quarter_ref_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fquarter_refadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fquarter_refadd = currentForm = new ew.Form("fquarter_refadd", "add");

	// Validate form
	fquarter_refadd.validate = function() {
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
			<?php if ($quarter_ref_add->Quarter->Required) { ?>
				elm = this.getElements("x" + infix + "_Quarter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quarter_ref_add->Quarter->caption(), $quarter_ref_add->Quarter->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quarter");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quarter_ref_add->Quarter->errorMessage()) ?>");
			<?php if ($quarter_ref_add->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quarter_ref_add->BillYear->caption(), $quarter_ref_add->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quarter_ref_add->BillYear->errorMessage()) ?>");
			<?php if ($quarter_ref_add->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quarter_ref_add->StartDate->caption(), $quarter_ref_add->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quarter_ref_add->StartDate->errorMessage()) ?>");
			<?php if ($quarter_ref_add->Enddate->Required) { ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quarter_ref_add->Enddate->caption(), $quarter_ref_add->Enddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quarter_ref_add->Enddate->errorMessage()) ?>");

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
	fquarter_refadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fquarter_refadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fquarter_refadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $quarter_ref_add->showPageHeader(); ?>
<?php
$quarter_ref_add->showMessage();
?>
<form name="fquarter_refadd" id="fquarter_refadd" class="<?php echo $quarter_ref_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="quarter_ref">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$quarter_ref_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($quarter_ref_add->Quarter->Visible) { // Quarter ?>
	<div id="r_Quarter" class="form-group row">
		<label id="elh_quarter_ref_Quarter" for="x_Quarter" class="<?php echo $quarter_ref_add->LeftColumnClass ?>"><?php echo $quarter_ref_add->Quarter->caption() ?><?php echo $quarter_ref_add->Quarter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quarter_ref_add->RightColumnClass ?>"><div <?php echo $quarter_ref_add->Quarter->cellAttributes() ?>>
<span id="el_quarter_ref_Quarter">
<input type="text" data-table="quarter_ref" data-field="x_Quarter" name="x_Quarter" id="x_Quarter" size="30" placeholder="<?php echo HtmlEncode($quarter_ref_add->Quarter->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_add->Quarter->EditValue ?>"<?php echo $quarter_ref_add->Quarter->editAttributes() ?>>
</span>
<?php echo $quarter_ref_add->Quarter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quarter_ref_add->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_quarter_ref_BillYear" for="x_BillYear" class="<?php echo $quarter_ref_add->LeftColumnClass ?>"><?php echo $quarter_ref_add->BillYear->caption() ?><?php echo $quarter_ref_add->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quarter_ref_add->RightColumnClass ?>"><div <?php echo $quarter_ref_add->BillYear->cellAttributes() ?>>
<span id="el_quarter_ref_BillYear">
<input type="text" data-table="quarter_ref" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($quarter_ref_add->BillYear->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_add->BillYear->EditValue ?>"<?php echo $quarter_ref_add->BillYear->editAttributes() ?>>
</span>
<?php echo $quarter_ref_add->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quarter_ref_add->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_quarter_ref_StartDate" for="x_StartDate" class="<?php echo $quarter_ref_add->LeftColumnClass ?>"><?php echo $quarter_ref_add->StartDate->caption() ?><?php echo $quarter_ref_add->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quarter_ref_add->RightColumnClass ?>"><div <?php echo $quarter_ref_add->StartDate->cellAttributes() ?>>
<span id="el_quarter_ref_StartDate">
<input type="text" data-table="quarter_ref" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($quarter_ref_add->StartDate->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_add->StartDate->EditValue ?>"<?php echo $quarter_ref_add->StartDate->editAttributes() ?>>
<?php if (!$quarter_ref_add->StartDate->ReadOnly && !$quarter_ref_add->StartDate->Disabled && !isset($quarter_ref_add->StartDate->EditAttrs["readonly"]) && !isset($quarter_ref_add->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fquarter_refadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fquarter_refadd", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $quarter_ref_add->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quarter_ref_add->Enddate->Visible) { // Enddate ?>
	<div id="r_Enddate" class="form-group row">
		<label id="elh_quarter_ref_Enddate" for="x_Enddate" class="<?php echo $quarter_ref_add->LeftColumnClass ?>"><?php echo $quarter_ref_add->Enddate->caption() ?><?php echo $quarter_ref_add->Enddate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quarter_ref_add->RightColumnClass ?>"><div <?php echo $quarter_ref_add->Enddate->cellAttributes() ?>>
<span id="el_quarter_ref_Enddate">
<input type="text" data-table="quarter_ref" data-field="x_Enddate" name="x_Enddate" id="x_Enddate" placeholder="<?php echo HtmlEncode($quarter_ref_add->Enddate->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_add->Enddate->EditValue ?>"<?php echo $quarter_ref_add->Enddate->editAttributes() ?>>
<?php if (!$quarter_ref_add->Enddate->ReadOnly && !$quarter_ref_add->Enddate->Disabled && !isset($quarter_ref_add->Enddate->EditAttrs["readonly"]) && !isset($quarter_ref_add->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fquarter_refadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fquarter_refadd", "x_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $quarter_ref_add->Enddate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$quarter_ref_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $quarter_ref_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $quarter_ref_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$quarter_ref_add->showPageFooter();
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
$quarter_ref_add->terminate();
?>