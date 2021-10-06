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
$ward_edit = new ward_edit();

// Run the page
$ward_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ward_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fwardedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fwardedit = currentForm = new ew.Form("fwardedit", "edit");

	// Validate form
	fwardedit.validate = function() {
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
			<?php if ($ward_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ward_edit->LACode->caption(), $ward_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ward_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ward_edit->ProvinceCode->caption(), $ward_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ward_edit->ProvinceCode->errorMessage()) ?>");
			<?php if ($ward_edit->WardCode->Required) { ?>
				elm = this.getElements("x" + infix + "_WardCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ward_edit->WardCode->caption(), $ward_edit->WardCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ward_edit->WardName->Required) { ?>
				elm = this.getElements("x" + infix + "_WardName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ward_edit->WardName->caption(), $ward_edit->WardName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ward_edit->Population->Required) { ?>
				elm = this.getElements("x" + infix + "_Population");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ward_edit->Population->caption(), $ward_edit->Population->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Population");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ward_edit->Population->errorMessage()) ?>");
			<?php if ($ward_edit->Areas->Required) { ?>
				elm = this.getElements("x" + infix + "_Areas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ward_edit->Areas->caption(), $ward_edit->Areas->RequiredErrorMessage)) ?>");
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
	fwardedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fwardedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fwardedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ward_edit->showPageHeader(); ?>
<?php
$ward_edit->showMessage();
?>
<?php if (!$ward_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ward_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fwardedit" id="fwardedit" class="<?php echo $ward_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ward">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ward_edit->IsModal ?>">
<?php if ($ward->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($ward_edit->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($ward_edit->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($ward_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_ward_LACode" for="x_LACode" class="<?php echo $ward_edit->LeftColumnClass ?>"><?php echo $ward_edit->LACode->caption() ?><?php echo $ward_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ward_edit->RightColumnClass ?>"><div <?php echo $ward_edit->LACode->cellAttributes() ?>>
<?php if ($ward_edit->LACode->getSessionValue() != "") { ?>
<span id="el_ward_LACode">
<span<?php echo $ward_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($ward_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ward_LACode">
<input type="text" data-table="ward" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($ward_edit->LACode->getPlaceHolder()) ?>" value="<?php echo $ward_edit->LACode->EditValue ?>"<?php echo $ward_edit->LACode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $ward_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ward_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_ward_ProvinceCode" for="x_ProvinceCode" class="<?php echo $ward_edit->LeftColumnClass ?>"><?php echo $ward_edit->ProvinceCode->caption() ?><?php echo $ward_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ward_edit->RightColumnClass ?>"><div <?php echo $ward_edit->ProvinceCode->cellAttributes() ?>>
<?php if ($ward_edit->ProvinceCode->getSessionValue() != "") { ?>
<span id="el_ward_ProvinceCode">
<span<?php echo $ward_edit->ProvinceCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_edit->ProvinceCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProvinceCode" name="x_ProvinceCode" value="<?php echo HtmlEncode($ward_edit->ProvinceCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ward_ProvinceCode">
<input type="text" data-table="ward" data-field="x_ProvinceCode" name="x_ProvinceCode" id="x_ProvinceCode" size="30" placeholder="<?php echo HtmlEncode($ward_edit->ProvinceCode->getPlaceHolder()) ?>" value="<?php echo $ward_edit->ProvinceCode->EditValue ?>"<?php echo $ward_edit->ProvinceCode->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $ward_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ward_edit->WardCode->Visible) { // WardCode ?>
	<div id="r_WardCode" class="form-group row">
		<label id="elh_ward_WardCode" class="<?php echo $ward_edit->LeftColumnClass ?>"><?php echo $ward_edit->WardCode->caption() ?><?php echo $ward_edit->WardCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ward_edit->RightColumnClass ?>"><div <?php echo $ward_edit->WardCode->cellAttributes() ?>>
<span id="el_ward_WardCode">
<span<?php echo $ward_edit->WardCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ward_edit->WardCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ward" data-field="x_WardCode" name="x_WardCode" id="x_WardCode" value="<?php echo HtmlEncode($ward_edit->WardCode->CurrentValue) ?>">
<?php echo $ward_edit->WardCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ward_edit->WardName->Visible) { // WardName ?>
	<div id="r_WardName" class="form-group row">
		<label id="elh_ward_WardName" for="x_WardName" class="<?php echo $ward_edit->LeftColumnClass ?>"><?php echo $ward_edit->WardName->caption() ?><?php echo $ward_edit->WardName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ward_edit->RightColumnClass ?>"><div <?php echo $ward_edit->WardName->cellAttributes() ?>>
<span id="el_ward_WardName">
<input type="text" data-table="ward" data-field="x_WardName" name="x_WardName" id="x_WardName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ward_edit->WardName->getPlaceHolder()) ?>" value="<?php echo $ward_edit->WardName->EditValue ?>"<?php echo $ward_edit->WardName->editAttributes() ?>>
</span>
<?php echo $ward_edit->WardName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ward_edit->Population->Visible) { // Population ?>
	<div id="r_Population" class="form-group row">
		<label id="elh_ward_Population" for="x_Population" class="<?php echo $ward_edit->LeftColumnClass ?>"><?php echo $ward_edit->Population->caption() ?><?php echo $ward_edit->Population->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ward_edit->RightColumnClass ?>"><div <?php echo $ward_edit->Population->cellAttributes() ?>>
<span id="el_ward_Population">
<input type="text" data-table="ward" data-field="x_Population" name="x_Population" id="x_Population" size="30" placeholder="<?php echo HtmlEncode($ward_edit->Population->getPlaceHolder()) ?>" value="<?php echo $ward_edit->Population->EditValue ?>"<?php echo $ward_edit->Population->editAttributes() ?>>
</span>
<?php echo $ward_edit->Population->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ward_edit->Areas->Visible) { // Areas ?>
	<div id="r_Areas" class="form-group row">
		<label id="elh_ward_Areas" for="x_Areas" class="<?php echo $ward_edit->LeftColumnClass ?>"><?php echo $ward_edit->Areas->caption() ?><?php echo $ward_edit->Areas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ward_edit->RightColumnClass ?>"><div <?php echo $ward_edit->Areas->cellAttributes() ?>>
<span id="el_ward_Areas">
<input type="text" data-table="ward" data-field="x_Areas" name="x_Areas" id="x_Areas" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ward_edit->Areas->getPlaceHolder()) ?>" value="<?php echo $ward_edit->Areas->EditValue ?>"<?php echo $ward_edit->Areas->editAttributes() ?>>
</span>
<?php echo $ward_edit->Areas->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ward_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ward_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ward_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ward_edit->IsModal) { ?>
<?php echo $ward_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$ward_edit->showPageFooter();
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
$ward_edit->terminate();
?>