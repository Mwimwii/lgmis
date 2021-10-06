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
$quarter_ref_edit = new quarter_ref_edit();

// Run the page
$quarter_ref_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$quarter_ref_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fquarter_refedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fquarter_refedit = currentForm = new ew.Form("fquarter_refedit", "edit");

	// Validate form
	fquarter_refedit.validate = function() {
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
			<?php if ($quarter_ref_edit->Quarter->Required) { ?>
				elm = this.getElements("x" + infix + "_Quarter");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quarter_ref_edit->Quarter->caption(), $quarter_ref_edit->Quarter->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Quarter");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quarter_ref_edit->Quarter->errorMessage()) ?>");
			<?php if ($quarter_ref_edit->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quarter_ref_edit->BillYear->caption(), $quarter_ref_edit->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quarter_ref_edit->BillYear->errorMessage()) ?>");
			<?php if ($quarter_ref_edit->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quarter_ref_edit->StartDate->caption(), $quarter_ref_edit->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quarter_ref_edit->StartDate->errorMessage()) ?>");
			<?php if ($quarter_ref_edit->Enddate->Required) { ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $quarter_ref_edit->Enddate->caption(), $quarter_ref_edit->Enddate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Enddate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($quarter_ref_edit->Enddate->errorMessage()) ?>");

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
	fquarter_refedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fquarter_refedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fquarter_refedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $quarter_ref_edit->showPageHeader(); ?>
<?php
$quarter_ref_edit->showMessage();
?>
<?php if (!$quarter_ref_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $quarter_ref_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fquarter_refedit" id="fquarter_refedit" class="<?php echo $quarter_ref_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="quarter_ref">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$quarter_ref_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($quarter_ref_edit->Quarter->Visible) { // Quarter ?>
	<div id="r_Quarter" class="form-group row">
		<label id="elh_quarter_ref_Quarter" for="x_Quarter" class="<?php echo $quarter_ref_edit->LeftColumnClass ?>"><?php echo $quarter_ref_edit->Quarter->caption() ?><?php echo $quarter_ref_edit->Quarter->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quarter_ref_edit->RightColumnClass ?>"><div <?php echo $quarter_ref_edit->Quarter->cellAttributes() ?>>
<input type="text" data-table="quarter_ref" data-field="x_Quarter" name="x_Quarter" id="x_Quarter" size="30" placeholder="<?php echo HtmlEncode($quarter_ref_edit->Quarter->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_edit->Quarter->EditValue ?>"<?php echo $quarter_ref_edit->Quarter->editAttributes() ?>>
<input type="hidden" data-table="quarter_ref" data-field="x_Quarter" name="o_Quarter" id="o_Quarter" value="<?php echo HtmlEncode($quarter_ref_edit->Quarter->OldValue != null ? $quarter_ref_edit->Quarter->OldValue : $quarter_ref_edit->Quarter->CurrentValue) ?>">
<?php echo $quarter_ref_edit->Quarter->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quarter_ref_edit->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_quarter_ref_BillYear" for="x_BillYear" class="<?php echo $quarter_ref_edit->LeftColumnClass ?>"><?php echo $quarter_ref_edit->BillYear->caption() ?><?php echo $quarter_ref_edit->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quarter_ref_edit->RightColumnClass ?>"><div <?php echo $quarter_ref_edit->BillYear->cellAttributes() ?>>
<span id="el_quarter_ref_BillYear">
<input type="text" data-table="quarter_ref" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($quarter_ref_edit->BillYear->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_edit->BillYear->EditValue ?>"<?php echo $quarter_ref_edit->BillYear->editAttributes() ?>>
</span>
<?php echo $quarter_ref_edit->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quarter_ref_edit->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_quarter_ref_StartDate" for="x_StartDate" class="<?php echo $quarter_ref_edit->LeftColumnClass ?>"><?php echo $quarter_ref_edit->StartDate->caption() ?><?php echo $quarter_ref_edit->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quarter_ref_edit->RightColumnClass ?>"><div <?php echo $quarter_ref_edit->StartDate->cellAttributes() ?>>
<span id="el_quarter_ref_StartDate">
<input type="text" data-table="quarter_ref" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($quarter_ref_edit->StartDate->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_edit->StartDate->EditValue ?>"<?php echo $quarter_ref_edit->StartDate->editAttributes() ?>>
<?php if (!$quarter_ref_edit->StartDate->ReadOnly && !$quarter_ref_edit->StartDate->Disabled && !isset($quarter_ref_edit->StartDate->EditAttrs["readonly"]) && !isset($quarter_ref_edit->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fquarter_refedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fquarter_refedit", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $quarter_ref_edit->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($quarter_ref_edit->Enddate->Visible) { // Enddate ?>
	<div id="r_Enddate" class="form-group row">
		<label id="elh_quarter_ref_Enddate" for="x_Enddate" class="<?php echo $quarter_ref_edit->LeftColumnClass ?>"><?php echo $quarter_ref_edit->Enddate->caption() ?><?php echo $quarter_ref_edit->Enddate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $quarter_ref_edit->RightColumnClass ?>"><div <?php echo $quarter_ref_edit->Enddate->cellAttributes() ?>>
<span id="el_quarter_ref_Enddate">
<input type="text" data-table="quarter_ref" data-field="x_Enddate" name="x_Enddate" id="x_Enddate" placeholder="<?php echo HtmlEncode($quarter_ref_edit->Enddate->getPlaceHolder()) ?>" value="<?php echo $quarter_ref_edit->Enddate->EditValue ?>"<?php echo $quarter_ref_edit->Enddate->editAttributes() ?>>
<?php if (!$quarter_ref_edit->Enddate->ReadOnly && !$quarter_ref_edit->Enddate->Disabled && !isset($quarter_ref_edit->Enddate->EditAttrs["readonly"]) && !isset($quarter_ref_edit->Enddate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fquarter_refedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fquarter_refedit", "x_Enddate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $quarter_ref_edit->Enddate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$quarter_ref_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $quarter_ref_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $quarter_ref_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$quarter_ref_edit->IsModal) { ?>
<?php echo $quarter_ref_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$quarter_ref_edit->showPageFooter();
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
$quarter_ref_edit->terminate();
?>