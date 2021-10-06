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
$staffchildren_add = new staffchildren_add();

// Run the page
$staffchildren_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$staffchildren_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fstaffchildrenadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fstaffchildrenadd = currentForm = new ew.Form("fstaffchildrenadd", "add");

	// Validate form
	fstaffchildrenadd.validate = function() {
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
			<?php if ($staffchildren_add->EmployeeID->Required) { ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_add->EmployeeID->caption(), $staffchildren_add->EmployeeID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EmployeeID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffchildren_add->EmployeeID->errorMessage()) ?>");
			<?php if ($staffchildren_add->FirstName->Required) { ?>
				elm = this.getElements("x" + infix + "_FirstName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_add->FirstName->caption(), $staffchildren_add->FirstName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffchildren_add->MiddleName->Required) { ?>
				elm = this.getElements("x" + infix + "_MiddleName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_add->MiddleName->caption(), $staffchildren_add->MiddleName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffchildren_add->Surname->Required) { ?>
				elm = this.getElements("x" + infix + "_Surname");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_add->Surname->caption(), $staffchildren_add->Surname->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($staffchildren_add->DateOfBirth->Required) { ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_add->DateOfBirth->caption(), $staffchildren_add->DateOfBirth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DateOfBirth");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($staffchildren_add->DateOfBirth->errorMessage()) ?>");
			<?php if ($staffchildren_add->Sex->Required) { ?>
				elm = this.getElements("x" + infix + "_Sex");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $staffchildren_add->Sex->caption(), $staffchildren_add->Sex->RequiredErrorMessage)) ?>");
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
	fstaffchildrenadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fstaffchildrenadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fstaffchildrenadd.lists["x_Sex"] = <?php echo $staffchildren_add->Sex->Lookup->toClientList($staffchildren_add) ?>;
	fstaffchildrenadd.lists["x_Sex"].options = <?php echo JsonEncode($staffchildren_add->Sex->lookupOptions()) ?>;
	loadjs.done("fstaffchildrenadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $staffchildren_add->showPageHeader(); ?>
<?php
$staffchildren_add->showMessage();
?>
<form name="fstaffchildrenadd" id="fstaffchildrenadd" class="<?php echo $staffchildren_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="staffchildren">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$staffchildren_add->IsModal ?>">
<?php if ($staffchildren->getCurrentMasterTable() == "staff") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="staff">
<input type="hidden" name="fk_EmployeeID" value="<?php echo HtmlEncode($staffchildren_add->EmployeeID->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($staffchildren_add->EmployeeID->Visible) { // EmployeeID ?>
	<div id="r_EmployeeID" class="form-group row">
		<label id="elh_staffchildren_EmployeeID" for="x_EmployeeID" class="<?php echo $staffchildren_add->LeftColumnClass ?>"><?php echo $staffchildren_add->EmployeeID->caption() ?><?php echo $staffchildren_add->EmployeeID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_add->RightColumnClass ?>"><div <?php echo $staffchildren_add->EmployeeID->cellAttributes() ?>>
<?php if ($staffchildren_add->EmployeeID->getSessionValue() != "") { ?>
<span id="el_staffchildren_EmployeeID">
<span<?php echo $staffchildren_add->EmployeeID->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($staffchildren_add->EmployeeID->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_EmployeeID" name="x_EmployeeID" value="<?php echo HtmlEncode($staffchildren_add->EmployeeID->CurrentValue) ?>">
<?php } else { ?>
<span id="el_staffchildren_EmployeeID">
<input type="text" data-table="staffchildren" data-field="x_EmployeeID" name="x_EmployeeID" id="x_EmployeeID" size="30" placeholder="<?php echo HtmlEncode($staffchildren_add->EmployeeID->getPlaceHolder()) ?>" value="<?php echo $staffchildren_add->EmployeeID->EditValue ?>"<?php echo $staffchildren_add->EmployeeID->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $staffchildren_add->EmployeeID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffchildren_add->FirstName->Visible) { // FirstName ?>
	<div id="r_FirstName" class="form-group row">
		<label id="elh_staffchildren_FirstName" for="x_FirstName" class="<?php echo $staffchildren_add->LeftColumnClass ?>"><?php echo $staffchildren_add->FirstName->caption() ?><?php echo $staffchildren_add->FirstName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_add->RightColumnClass ?>"><div <?php echo $staffchildren_add->FirstName->cellAttributes() ?>>
<span id="el_staffchildren_FirstName">
<input type="text" data-table="staffchildren" data-field="x_FirstName" name="x_FirstName" id="x_FirstName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_add->FirstName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_add->FirstName->EditValue ?>"<?php echo $staffchildren_add->FirstName->editAttributes() ?>>
</span>
<?php echo $staffchildren_add->FirstName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffchildren_add->MiddleName->Visible) { // MiddleName ?>
	<div id="r_MiddleName" class="form-group row">
		<label id="elh_staffchildren_MiddleName" for="x_MiddleName" class="<?php echo $staffchildren_add->LeftColumnClass ?>"><?php echo $staffchildren_add->MiddleName->caption() ?><?php echo $staffchildren_add->MiddleName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_add->RightColumnClass ?>"><div <?php echo $staffchildren_add->MiddleName->cellAttributes() ?>>
<span id="el_staffchildren_MiddleName">
<input type="text" data-table="staffchildren" data-field="x_MiddleName" name="x_MiddleName" id="x_MiddleName" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_add->MiddleName->getPlaceHolder()) ?>" value="<?php echo $staffchildren_add->MiddleName->EditValue ?>"<?php echo $staffchildren_add->MiddleName->editAttributes() ?>>
</span>
<?php echo $staffchildren_add->MiddleName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffchildren_add->Surname->Visible) { // Surname ?>
	<div id="r_Surname" class="form-group row">
		<label id="elh_staffchildren_Surname" for="x_Surname" class="<?php echo $staffchildren_add->LeftColumnClass ?>"><?php echo $staffchildren_add->Surname->caption() ?><?php echo $staffchildren_add->Surname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_add->RightColumnClass ?>"><div <?php echo $staffchildren_add->Surname->cellAttributes() ?>>
<span id="el_staffchildren_Surname">
<input type="text" data-table="staffchildren" data-field="x_Surname" name="x_Surname" id="x_Surname" size="50" maxlength="100" placeholder="<?php echo HtmlEncode($staffchildren_add->Surname->getPlaceHolder()) ?>" value="<?php echo $staffchildren_add->Surname->EditValue ?>"<?php echo $staffchildren_add->Surname->editAttributes() ?>>
</span>
<?php echo $staffchildren_add->Surname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffchildren_add->DateOfBirth->Visible) { // DateOfBirth ?>
	<div id="r_DateOfBirth" class="form-group row">
		<label id="elh_staffchildren_DateOfBirth" for="x_DateOfBirth" class="<?php echo $staffchildren_add->LeftColumnClass ?>"><?php echo $staffchildren_add->DateOfBirth->caption() ?><?php echo $staffchildren_add->DateOfBirth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_add->RightColumnClass ?>"><div <?php echo $staffchildren_add->DateOfBirth->cellAttributes() ?>>
<span id="el_staffchildren_DateOfBirth">
<input type="text" data-table="staffchildren" data-field="x_DateOfBirth" name="x_DateOfBirth" id="x_DateOfBirth" placeholder="<?php echo HtmlEncode($staffchildren_add->DateOfBirth->getPlaceHolder()) ?>" value="<?php echo $staffchildren_add->DateOfBirth->EditValue ?>"<?php echo $staffchildren_add->DateOfBirth->editAttributes() ?>>
<?php if (!$staffchildren_add->DateOfBirth->ReadOnly && !$staffchildren_add->DateOfBirth->Disabled && !isset($staffchildren_add->DateOfBirth->EditAttrs["readonly"]) && !isset($staffchildren_add->DateOfBirth->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fstaffchildrenadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fstaffchildrenadd", "x_DateOfBirth", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $staffchildren_add->DateOfBirth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($staffchildren_add->Sex->Visible) { // Sex ?>
	<div id="r_Sex" class="form-group row">
		<label id="elh_staffchildren_Sex" for="x_Sex" class="<?php echo $staffchildren_add->LeftColumnClass ?>"><?php echo $staffchildren_add->Sex->caption() ?><?php echo $staffchildren_add->Sex->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $staffchildren_add->RightColumnClass ?>"><div <?php echo $staffchildren_add->Sex->cellAttributes() ?>>
<span id="el_staffchildren_Sex">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="staffchildren" data-field="x_Sex" data-value-separator="<?php echo $staffchildren_add->Sex->displayValueSeparatorAttribute() ?>" id="x_Sex" name="x_Sex"<?php echo $staffchildren_add->Sex->editAttributes() ?>>
			<?php echo $staffchildren_add->Sex->selectOptionListHtml("x_Sex") ?>
		</select>
</div>
<?php echo $staffchildren_add->Sex->Lookup->getParamTag($staffchildren_add, "p_x_Sex") ?>
</span>
<?php echo $staffchildren_add->Sex->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$staffchildren_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $staffchildren_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $staffchildren_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$staffchildren_add->showPageFooter();
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
$staffchildren_add->terminate();
?>