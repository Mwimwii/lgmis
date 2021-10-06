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
$councillor_allowance_edit = new councillor_allowance_edit();

// Run the page
$councillor_allowance_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_allowance_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcouncillor_allowanceedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcouncillor_allowanceedit = currentForm = new ew.Form("fcouncillor_allowanceedit", "edit");

	// Validate form
	fcouncillor_allowanceedit.validate = function() {
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
			<?php if ($councillor_allowance_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_allowance_edit->EmployeeID->caption(), $councillor_allowance_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_allowance_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($councillor_allowance_edit->AllowanceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AllowanceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_allowance_edit->AllowanceCode->caption(), $councillor_allowance_edit->AllowanceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($councillor_allowance_edit->AllowanceAmount->Required) { ?>
				elm = this.getElements("x" + infix + "_AllowanceAmount");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $councillor_allowance_edit->AllowanceAmount->caption(), $councillor_allowance_edit->AllowanceAmount->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AllowanceAmount");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($councillor_allowance_edit->AllowanceAmount->errorMessage()) ?>");

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
	fcouncillor_allowanceedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcouncillor_allowanceedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcouncillor_allowanceedit.lists["x_AllowanceCode"] = <?php echo $councillor_allowance_edit->AllowanceCode->Lookup->toClientList($councillor_allowance_edit) ?>;
	fcouncillor_allowanceedit.lists["x_AllowanceCode"].options = <?php echo JsonEncode($councillor_allowance_edit->AllowanceCode->lookupOptions()) ?>;
	loadjs.done("fcouncillor_allowanceedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $councillor_allowance_edit->showPageHeader(); ?>
<?php
$councillor_allowance_edit->showMessage();
?>
<?php if (!$councillor_allowance_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillor_allowance_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fcouncillor_allowanceedit" id="fcouncillor_allowanceedit" class="<?php echo $councillor_allowance_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor_allowance">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$councillor_allowance_edit->IsModal ?>">
<?php if ($councillor_allowance->getCurrentMasterTable() == "councillorship") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="councillorship">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($councillor_allowance_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_councillor_allowance_EmployeeID" for="x_EmployeeID" class="<?php echo $councillor_allowance_edit->LeftColumnClass ?>"><?php echo $councillor_allowance_edit->EmployeeID->caption() ?><?php echo $councillor_allowance_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_allowance_edit->RightColumnClass ?>"><div <?php echo $councillor_allowance_edit->EmployeeID->cellAttributes() ?>>
<?php if ($councillor_allowance_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_councillor_allowance_EmployeeID">
<span<?php echo $councillor_allowance_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($councillor_allowance_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="councillor_allowance" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($councillor_allowance_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $councillor_allowance_edit->EmployeeID->EditValue ?>"<?php echo $councillor_allowance_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="councillor_allowance" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($councillor_allowance_edit->EmployeeID->OldValue != null ? $councillor_allowance_edit->EmployeeID->OldValue : $councillor_allowance_edit->EmployeeID->CurrentValue) ?>">
<?php echo $councillor_allowance_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_allowance_edit->AllowanceCode->Visible) { // AllowanceCode ?>
	<div id="r_AllowanceCode" class="form-group row">
		<label id="elh_councillor_allowance_AllowanceCode" for="x_AllowanceCode" class="<?php echo $councillor_allowance_edit->LeftColumnClass ?>"><?php echo $councillor_allowance_edit->AllowanceCode->caption() ?><?php echo $councillor_allowance_edit->AllowanceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_allowance_edit->RightColumnClass ?>"><div <?php echo $councillor_allowance_edit->AllowanceCode->cellAttributes() ?>>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="councillor_allowance" data-field="x_AllowanceCode" data-value-separator="<?php echo $councillor_allowance_edit->AllowanceCode->displayValueSeparatorAttribute() ?>" id="x_AllowanceCode" name="x_AllowanceCode"<?php echo $councillor_allowance_edit->AllowanceCode->editAttributes() ?>>
			<?php echo $councillor_allowance_edit->AllowanceCode->selectOptionListHtml("x_AllowanceCode") ?>
		</select>
</div>
<?php echo $councillor_allowance_edit->AllowanceCode->Lookup->getParamTag($councillor_allowance_edit, "p_x_AllowanceCode") ?>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceCode" name="o_AllowanceCode" id="o_AllowanceCode" value="<?php echo HtmlEncode($councillor_allowance_edit->AllowanceCode->OldValue != null ? $councillor_allowance_edit->AllowanceCode->OldValue : $councillor_allowance_edit->AllowanceCode->CurrentValue) ?>">
<?php echo $councillor_allowance_edit->AllowanceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($councillor_allowance_edit->AllowanceAmount->Visible) { // AllowanceAmount ?>
	<div id="r_AllowanceAmount" class="form-group row">
		<label id="elh_councillor_allowance_AllowanceAmount" for="x_AllowanceAmount" class="<?php echo $councillor_allowance_edit->LeftColumnClass ?>"><?php echo $councillor_allowance_edit->AllowanceAmount->caption() ?><?php echo $councillor_allowance_edit->AllowanceAmount->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $councillor_allowance_edit->RightColumnClass ?>"><div <?php echo $councillor_allowance_edit->AllowanceAmount->cellAttributes() ?>>
<input type="text" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="x_AllowanceAmount" id="x_AllowanceAmount" size="30" placeholder="<?php echo HtmlEncode($councillor_allowance_edit->AllowanceAmount->getPlaceHolder()) ?>" value="<?php echo $councillor_allowance_edit->AllowanceAmount->EditValue ?>"<?php echo $councillor_allowance_edit->AllowanceAmount->editAttributes() ?>>
<input type="hidden" data-table="councillor_allowance" data-field="x_AllowanceAmount" name="o_AllowanceAmount" id="o_AllowanceAmount" value="<?php echo HtmlEncode($councillor_allowance_edit->AllowanceAmount->OldValue != null ? $councillor_allowance_edit->AllowanceAmount->OldValue : $councillor_allowance_edit->AllowanceAmount->CurrentValue) ?>">
<?php echo $councillor_allowance_edit->AllowanceAmount->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$councillor_allowance_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $councillor_allowance_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $councillor_allowance_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$councillor_allowance_edit->IsModal) { ?>
<?php echo $councillor_allowance_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$councillor_allowance_edit->showPageFooter();
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
$councillor_allowance_edit->terminate();
?>