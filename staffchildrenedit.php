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
$staffchildren_edit = new staffchildren_edit();

// Run the page
$staffchildren_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffchildren_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffchildrenedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fstaffchildrenedit = currentForm = new ew.Form("fstaffchildrenedit", "edit");

	// Validate form
	fstaffchildrenedit.validate = function() {
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
			<?php if ($staffchildren_edit->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_edit->EmployeeID->caption(), $staffchildren_edit->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffchildren_edit->EmployeeID->errorMessage()) ?>");
			<?php if ($staffchildren_edit->ChildNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ChildNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_edit->ChildNo->caption(), $staffchildren_edit->ChildNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ChildNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffchildren_edit->ChildNo->errorMessage()) ?>");
			<?php if ($staffchildren_edit->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_edit->FirstName->caption(), $staffchildren_edit->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffchildren_edit->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_edit->MiddleName->caption(), $staffchildren_edit->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffchildren_edit->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_edit->Surname->caption(), $staffchildren_edit->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffchildren_edit->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_edit->DateOfBirth->caption(), $staffchildren_edit->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffchildren_edit->DateOfBirth->errorMessage()) ?>");
			<?php if ($staffchildren_edit->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_edit->Sex->caption(), $staffchildren_edit->Sex->RequiredErrorMessage)) ?>");
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
	fstaffchildrenedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffchildrenedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffchildrenedit.lists["x_Sex"] = <?php echo $staffchildren_edit->Sex->Lookup->toClientList($staffchildren_edit) ?>;
	fstaffchildrenedit.lists["x_Sex"].options = <?php echo JsonEncode($staffchildren_edit->Sex->lookupOptions()) ?>;
	loadjs.done("fstaffchildrenedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffchildren_edit->showPageHeader(); ?>
<?php
$staffchildren_edit->showMessage();
?>
<?php if (!$staffchildren_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $staffchildren_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fstaffchildrenedit" id="fstaffchildrenedit" class="<?php echo $staffchildren_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffchildren">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$staffchildren_edit->IsModal ?>">
<?php if ($staffchildren->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffchildren_edit->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($staffchildren_edit->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffchildren_EmployeeID" for="x_EmployeeID" class="<?php echo $staffchildren_edit->LeftColumnClass ?>"><?php echo $staffchildren_edit->EmployeeID->caption() ?><?php echo $staffchildren_edit->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_edit->RightColumnClass ?>"><div <?php echo $staffchildren_edit->EmployeeID->cellAttributes() ?>>
<?php if ($staffchildren_edit->EmployeeID->getSessionValue() != "") { ?>

<span id="el_staffchildren_EmployeeID">
<span<?php echo $staffchildren_edit->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffchildren_edit->EmployeeID->EditValue)) ?>"></span>
</span>

<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffchildren_edit->EmployeeID->CurrentValue) ?>">
<?php } else { ?>

<input type="text" data-table="staffchildren" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffchildren_edit->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffchildren_edit->EmployeeID->EditValue ?>"<?php echo $staffchildren_edit->EmployeeID->editAttributes() ?>>

<?php } ?>

<input type="hidden" data-table="staffchildren" data-field="x_EmployeeID" name="o_EmployeeID" id="o_EmployeeID" value="<?php echo HtmlEncode($staffchildren_edit->EmployeeID->OldValue != null ? $staffchildren_edit->EmployeeID->OldValue : $staffchildren_edit->EmployeeID->CurrentValue) ?>">
<?php echo $staffchildren_edit->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffchildren_edit->ChildNo->Visible) { // ChildNo ?>
	<div id="r_ChildNo" class="form-group row">
		<label id="elh_staffchildren_ChildNo" for="x_ChildNo" class="<?php echo $staffchildren_edit->LeftColumnClass ?>"><?php echo $staffchildren_edit->ChildNo->caption() ?><?php echo $staffchildren_edit->ChildNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_edit->RightColumnClass ?>"><div <?php echo $staffchildren_edit->ChildNo->cellAttributes() ?>>
<span id="el_staffchildren_ChildNo">
<span<?php echo $staffchildren_edit->ChildNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffchildren_edit->ChildNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="staffchildren" data-field="x_ChildNo" name="x_ChildNo" id="x_ChildNo" value="<?php echo HtmlEncode($staffchildren_edit->ChildNo->CurrentValue) ?>">
<?php echo $staffchildren_edit->ChildNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffchildren_edit->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_staffchildren_FirstName" for="x_FirstName" class="<?php echo $staffchildren_edit->LeftColumnClass ?>"><?php echo $staffchildren_edit->FirstName->caption() ?><?php echo $staffchildren_edit->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_edit->RightColumnClass ?>"><div <?php echo $staffchildren_edit->FirstName->cellAttributes() ?>>
<span id="el_staffchildren_FirstName">
<input type="text" data-table="staffchildren" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_edit->FirstName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_edit->FirstName->EditValue ?>"<?php echo $staffchildren_edit->FirstName->editAttributes() ?>>
</span>
<?php echo $staffchildren_edit->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffchildren_edit->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label id="elh_staffchildren_MiddleName" for="x_MiddleName" class="<?php echo $staffchildren_edit->LeftColumnClass ?>"><?php echo $staffchildren_edit->MiddleName->caption() ?><?php echo $staffchildren_edit->MiddleName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_edit->RightColumnClass ?>"><div <?php echo $staffchildren_edit->MiddleName->cellAttributes() ?>>
<span id="el_staffchildren_MiddleName">
<input type="text" data-table="staffchildren" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_edit->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_edit->MiddleName->EditValue ?>"<?php echo $staffchildren_edit->MiddleName->editAttributes() ?>>
</span>
<?php echo $staffchildren_edit->MiddleName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffchildren_edit->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label id="elh_staffchildren_Surname" for="x_Surname" class="<?php echo $staffchildren_edit->LeftColumnClass ?>"><?php echo $staffchildren_edit->Surname->caption() ?><?php echo $staffchildren_edit->Surname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_edit->RightColumnClass ?>"><div <?php echo $staffchildren_edit->Surname->cellAttributes() ?>>
<span id="el_staffchildren_Surname">
<input type="text" data-table="staffchildren" data-field="x_Surname" name="x_Surname" id="x_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_edit->Surname->getPlaceHolder()) ?>" value="<?php echo $staffchildren_edit->Surname->EditValue ?>"<?php echo $staffchildren_edit->Surname->editAttributes() ?>>
</span>
<?php echo $staffchildren_edit->Surname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffchildren_edit->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label id="elh_staffchildren_DateOfBirth" for="x_DateOfBirth" class="<?php echo $staffchildren_edit->LeftColumnClass ?>"><?php echo $staffchildren_edit->DateOfBirth->caption() ?><?php echo $staffchildren_edit->DateOfBirth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_edit->RightColumnClass ?>"><div <?php echo $staffchildren_edit->DateOfBirth->cellAttributes() ?>>
<span id="el_staffchildren_DateOfBirth">
<input type="text" data-table="staffchildren" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" placeholder="<?php echo HtmlEncode($staffchildren_edit->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staffchildren_edit->DateOfBirth->EditValue ?>"<?php echo $staffchildren_edit->DateOfBirth->editAttributes() ?>>
<?php if (!$staffchildren_edit->DateOfBirth->ReadOnly && !$staffchildren_edit->DateOfBirth->Disabled && !isset($staffchildren_edit->DateOfBirth->EditAttrs["readonly"]) && !isset($staffchildren_edit->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffchildrenedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffchildrenedit", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffchildren_edit->DateOfBirth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffchildren_edit->Sex->Visible) { // Sex ?>
	<div id="r_Sex" class="form-group row">
		<label id="elh_staffchildren_Sex" for="x_Sex" class="<?php echo $staffchildren_edit->LeftColumnClass ?>"><?php echo $staffchildren_edit->Sex->caption() ?><?php echo $staffchildren_edit->Sex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_edit->RightColumnClass ?>"><div <?php echo $staffchildren_edit->Sex->cellAttributes() ?>>
<span id="el_staffchildren_Sex">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffchildren" data-field="x_Sex" data-value-separator="<?php echo $staffchildren_edit->Sex->displayValueSeparatorAttribute() ?>" id="x_Sex" name="x_Sex"<?php echo $staffchildren_edit->Sex->editAttributes() ?>>
			<?php echo $staffchildren_edit->Sex->selectOptionListHtml("x_Sex") ?>
		</select>
</div>
<?php echo $staffchildren_edit->Sex->Lookup->getParamTag($staffchildren_edit, "p_x_Sex") ?>
</span>
<?php echo $staffchildren_edit->Sex->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffchildren_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffchildren_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffchildren_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$staffchildren_edit->IsModal) { ?>
<?php echo $staffchildren_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$staffchildren_edit->showPageFooter();
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
$staffchildren_edit->terminate();
?>