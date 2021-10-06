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
$councillor_allowance_add = new councillor_allowance_add();

// Run the page
$councillor_allowance_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_allowance_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillor_allowanceadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fcouncillor_allowanceadd = currentForm = new ew.Form("fcouncillor_allowanceadd", "add");

	// Validate form
	fcouncillor_allowanceadd.validate = function() {
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
			<?php if ($councillor_allowance_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_allowance_add->EmployeeID->caption(), $councillor_allowance_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_allowance_add->EmployeeID->errorMessage()) ?>");
			<?php if ($councillor_allowance_add->AllowanceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AllowanceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_allowance_add->AllowanceCode->caption(), $councillor_allowance_add->AllowanceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_allowance_add->AllowanceAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_AllowanceAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_allowance_add->AllowanceAmount->caption(), $councillor_allowance_add->AllowanceAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AllowanceAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_allowance_add->AllowanceAmount->errorMessage()) ?>");

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
	fcouncillor_allowanceadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillor_allowanceadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncillor_allowanceadd.lists["x_AllowanceCode"] = <?php echo $councillor_allowance_add->AllowanceCode->Lookup->toClientList($councillor_allowance_add) ?>;
	fcouncillor_allowanceadd.lists["x_AllowanceCode"].options = <?php echo JsonEncode($councillor_allowance_add->AllowanceCode->lookupOptions()) ?>;
	loadjs.done("fcouncillor_allowanceadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillor_allowance_add->showPageHeader(); ?>
<?php
$councillor_allowance_add->showMessage();
?>
<form name="fcouncillor_allowanceadd" id="fcouncillor_allowanceadd" class="<?php echo $councillor_allowance_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor_allowance">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$councillor_allowance_add->IsModal ?>">
<?php if ($councillor_allowance->getCurrentMasterTable() == "councillorship") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="councillorship">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($councillor_allowance_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_councillor_allowance_EmployeeID" for="x_EmployeeID" class="<?php echo $councillor_allowance_add->LeftColumnClass ?>"><?php echo $councillor_allowance_add->EmployeeID->caption() ?><?php echo $councillor_allowance_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_allowance_add->RightColumnClass ?>"><div <?php echo $councillor_allowance_add->EmployeeID->cellAttributes() ?>>
<?php if ($councillor_allowance_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_councillor_allowance_EmployeeID">
<span<?php echo $councillor_allowance_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillor_allowance_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_councillor_allowance_EmployeeID">
<input type="text" data-table="councillor_allowance" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($councillor_allowance_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $councillor_allowance_add->EmployeeID->EditValue ?>"<?php echo $councillor_allowance_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $councillor_allowance_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_allowance_add->AllowanceCode->Visible) { // AllowanceCode ?>
	<div id="r_AllowanceCode" class="form-group row">
		<label id="elh_councillor_allowance_AllowanceCode" for="x_AllowanceCode" class="<?php echo $councillor_allowance_add->LeftColumnClass ?>"><?php echo $councillor_allowance_add->AllowanceCode->caption() ?><?php echo $councillor_allowance_add->AllowanceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_allowance_add->RightColumnClass ?>"><div <?php echo $councillor_allowance_add->AllowanceCode->cellAttributes() ?>>
<span id="el_councillor_allowance_AllowanceCode">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor_allowance" data-field="x_AllowanceCode" data-value-separator="<?php echo $councillor_allowance_add->AllowanceCode->displayValueSeparatorAttribute() ?>" id="x_AllowanceCode" name="x_AllowanceCode"<?php echo $councillor_allowance_add->AllowanceCode->editAttributes() ?>>
			<?php echo $councillor_allowance_add->AllowanceCode->selectOptionListHtml("x_AllowanceCode") ?>
		</select>
</div>
<?php echo $councillor_allowance_add->AllowanceCode->Lookup->getParamTag($councillor_allowance_add, "p_x_AllowanceCode") ?>
</span>
<?php echo $councillor_allowance_add->AllowanceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_allowance_add->AllowanceAmount->Visible) { // AllowanceAmount ?>
	<div id="r_AllowanceAmount" class="form-group row">
		<label id="elh_councillor_allowance_AllowanceAmount" for="x_AllowanceAmount" class="<?php echo $councillor_allowance_add->LeftColumnClass ?>"><?php echo $councillor_allowance_add->AllowanceAmount->caption() ?><?php echo $councillor_allowance_add->AllowanceAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_allowance_add->RightColumnClass ?>"><div <?php echo $councillor_allowance_add->AllowanceAmount->cellAttributes() ?>>
<span id="el_councillor_allowance_AllowanceAmount">
<input type="text" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="x_AllowanceAmount" id="x_AllowanceAmount" size="30" placeholder="<?php echo HtmlEncode($councillor_allowance_add->AllowanceAmount->getPlaceHolder()) ?>" value="<?php echo $councillor_allowance_add->AllowanceAmount->EditValue ?>"<?php echo $councillor_allowance_add->AllowanceAmount->editAttributes() ?>>
</span>
<?php echo $councillor_allowance_add->AllowanceAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$councillor_allowance_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillor_allowance_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillor_allowance_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$councillor_allowance_add->showPageFooter();
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
$councillor_allowance_add->terminate();
?>