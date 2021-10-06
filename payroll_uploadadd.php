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
$payroll_upload_add = new payroll_upload_add();

// Run the page
$payroll_upload_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_upload_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpayroll_uploadadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fpayroll_uploadadd = currentForm = new ew.Form("fpayroll_uploadadd", "add");

	// Validate form
	fpayroll_uploadadd.validate = function() {
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
			<?php if ($payroll_upload_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_upload_add->LACode->caption(), $payroll_upload_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_upload_add->Filename->Required) { ?>
				felm = this.getElements("x" + infix + "_Filename");
				elm = this.getElements("fn_x" + infix + "_Filename");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $payroll_upload_add->Filename->caption(), $payroll_upload_add->Filename->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_upload_add->Filetype->Required) { ?>
				elm = this.getElements("x" + infix + "_Filetype");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_upload_add->Filetype->caption(), $payroll_upload_add->Filetype->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($payroll_upload_add->Filesize->Required) { ?>
				elm = this.getElements("x" + infix + "_Filesize");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_upload_add->Filesize->caption(), $payroll_upload_add->Filesize->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Filesize");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($payroll_upload_add->Filesize->errorMessage()) ?>");
			<?php if ($payroll_upload_add->Uploadfolder->Required) { ?>
				elm = this.getElements("x" + infix + "_Uploadfolder");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $payroll_upload_add->Uploadfolder->caption(), $payroll_upload_add->Uploadfolder->RequiredErrorMessage)) ?>");
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
	fpayroll_uploadadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpayroll_uploadadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fpayroll_uploadadd.lists["x_LACode"] = <?php echo $payroll_upload_add->LACode->Lookup->toClientList($payroll_upload_add) ?>;
	fpayroll_uploadadd.lists["x_LACode"].options = <?php echo JsonEncode($payroll_upload_add->LACode->lookupOptions()) ?>;
	fpayroll_uploadadd.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fpayroll_uploadadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $payroll_upload_add->showPageHeader(); ?>
<?php
$payroll_upload_add->showMessage();
?>
<form name="fpayroll_uploadadd" id="fpayroll_uploadadd" class="<?php echo $payroll_upload_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_upload">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$payroll_upload_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($payroll_upload_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_payroll_upload_LACode" class="<?php echo $payroll_upload_add->LeftColumnClass ?>"><?php echo $payroll_upload_add->LACode->caption() ?><?php echo $payroll_upload_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_upload_add->RightColumnClass ?>"><div <?php echo $payroll_upload_add->LACode->cellAttributes() ?>>
<span id="el_payroll_upload_LACode">
<?php
$onchange = $payroll_upload_add->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$payroll_upload_add->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($payroll_upload_add->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($payroll_upload_add->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($payroll_upload_add->LACode->getPlaceHolder()) ?>"<?php echo $payroll_upload_add->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="payroll_upload" data-field="x_LACode" data-value-separator="<?php echo $payroll_upload_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($payroll_upload_add->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fpayroll_uploadadd"], function() {
	fpayroll_uploadadd.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $payroll_upload_add->LACode->Lookup->getParamTag($payroll_upload_add, "p_x_LACode") ?>
</span>
<?php echo $payroll_upload_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_upload_add->Filename->Visible) { // Filename ?>
	<div id="r_Filename" class="form-group row">
		<label id="elh_payroll_upload_Filename" class="<?php echo $payroll_upload_add->LeftColumnClass ?>"><?php echo $payroll_upload_add->Filename->caption() ?><?php echo $payroll_upload_add->Filename->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_upload_add->RightColumnClass ?>"><div <?php echo $payroll_upload_add->Filename->cellAttributes() ?>>
<span id="el_payroll_upload_Filename">
<div id="fd_x_Filename">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $payroll_upload_add->Filename->title() ?>" data-table="payroll_upload" data-field="x_Filename" name="x_Filename" id="x_Filename" lang="<?php echo CurrentLanguageID() ?>"<?php echo $payroll_upload_add->Filename->editAttributes() ?><?php if ($payroll_upload_add->Filename->ReadOnly || $payroll_upload_add->Filename->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Filename"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Filename" id= "fn_x_Filename" value="<?php echo $payroll_upload_add->Filename->Upload->FileName ?>">
<input type="hidden" name="fa_x_Filename" id= "fa_x_Filename" value="0">
<input type="hidden" name="fs_x_Filename" id= "fs_x_Filename" value="50">
<input type="hidden" name="fx_x_Filename" id= "fx_x_Filename" value="<?php echo $payroll_upload_add->Filename->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Filename" id= "fm_x_Filename" value="<?php echo $payroll_upload_add->Filename->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Filename" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $payroll_upload_add->Filename->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_upload_add->Filetype->Visible) { // Filetype ?>
	<div id="r_Filetype" class="form-group row">
		<label id="elh_payroll_upload_Filetype" for="x_Filetype" class="<?php echo $payroll_upload_add->LeftColumnClass ?>"><?php echo $payroll_upload_add->Filetype->caption() ?><?php echo $payroll_upload_add->Filetype->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_upload_add->RightColumnClass ?>"><div <?php echo $payroll_upload_add->Filetype->cellAttributes() ?>>
<span id="el_payroll_upload_Filetype">
<input type="text" data-table="payroll_upload" data-field="x_Filetype" name="x_Filetype" id="x_Filetype" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($payroll_upload_add->Filetype->getPlaceHolder()) ?>" value="<?php echo $payroll_upload_add->Filetype->EditValue ?>"<?php echo $payroll_upload_add->Filetype->editAttributes() ?>>
</span>
<?php echo $payroll_upload_add->Filetype->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_upload_add->Filesize->Visible) { // Filesize ?>
	<div id="r_Filesize" class="form-group row">
		<label id="elh_payroll_upload_Filesize" for="x_Filesize" class="<?php echo $payroll_upload_add->LeftColumnClass ?>"><?php echo $payroll_upload_add->Filesize->caption() ?><?php echo $payroll_upload_add->Filesize->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_upload_add->RightColumnClass ?>"><div <?php echo $payroll_upload_add->Filesize->cellAttributes() ?>>
<span id="el_payroll_upload_Filesize">
<input type="text" data-table="payroll_upload" data-field="x_Filesize" name="x_Filesize" id="x_Filesize" size="30" placeholder="<?php echo HtmlEncode($payroll_upload_add->Filesize->getPlaceHolder()) ?>" value="<?php echo $payroll_upload_add->Filesize->EditValue ?>"<?php echo $payroll_upload_add->Filesize->editAttributes() ?>>
</span>
<?php echo $payroll_upload_add->Filesize->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($payroll_upload_add->Uploadfolder->Visible) { // Uploadfolder ?>
	<div id="r_Uploadfolder" class="form-group row">
		<label id="elh_payroll_upload_Uploadfolder" for="x_Uploadfolder" class="<?php echo $payroll_upload_add->LeftColumnClass ?>"><?php echo $payroll_upload_add->Uploadfolder->caption() ?><?php echo $payroll_upload_add->Uploadfolder->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $payroll_upload_add->RightColumnClass ?>"><div <?php echo $payroll_upload_add->Uploadfolder->cellAttributes() ?>>
<span id="el_payroll_upload_Uploadfolder">
<input type="text" data-table="payroll_upload" data-field="x_Uploadfolder" name="x_Uploadfolder" id="x_Uploadfolder" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($payroll_upload_add->Uploadfolder->getPlaceHolder()) ?>" value="<?php echo $payroll_upload_add->Uploadfolder->EditValue ?>"<?php echo $payroll_upload_add->Uploadfolder->editAttributes() ?>>
</span>
<?php echo $payroll_upload_add->Uploadfolder->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$payroll_upload_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $payroll_upload_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $payroll_upload_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$payroll_upload_add->showPageFooter();
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
$payroll_upload_add->terminate();
?>