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
$la_sub_program_edit = new la_sub_program_edit();

// Run the page
$la_sub_program_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_sub_program_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fla_sub_programedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fla_sub_programedit = currentForm = new ew.Form("fla_sub_programedit", "edit");

	// Validate form
	fla_sub_programedit.validate = function() {
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
			<?php if ($la_sub_program_edit->ProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_sub_program_edit->ProgramCode->caption(), $la_sub_program_edit->ProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ProgramCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($la_sub_program_edit->ProgramCode->errorMessage()) ?>");
			<?php if ($la_sub_program_edit->SubProgramCode->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_sub_program_edit->SubProgramCode->caption(), $la_sub_program_edit->SubProgramCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_sub_program_edit->SubProgramName->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_sub_program_edit->SubProgramName->caption(), $la_sub_program_edit->SubProgramName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_sub_program_edit->SubProgramPurpose->Required) { ?>
				elm = this.getElements("x" + infix + "_SubProgramPurpose");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_sub_program_edit->SubProgramPurpose->caption(), $la_sub_program_edit->SubProgramPurpose->RequiredErrorMessage)) ?>");
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
	fla_sub_programedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fla_sub_programedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fla_sub_programedit.lists["x_ProgramCode"] = <?php echo $la_sub_program_edit->ProgramCode->Lookup->toClientList($la_sub_program_edit) ?>;
	fla_sub_programedit.lists["x_ProgramCode"].options = <?php echo JsonEncode($la_sub_program_edit->ProgramCode->lookupOptions()) ?>;
	fla_sub_programedit.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fla_sub_programedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $la_sub_program_edit->showPageHeader(); ?>
<?php
$la_sub_program_edit->showMessage();
?>
<?php if (!$la_sub_program_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $la_sub_program_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fla_sub_programedit" id="fla_sub_programedit" class="<?php echo $la_sub_program_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_sub_program">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$la_sub_program_edit->IsModal ?>">
<?php if ($la_sub_program->getCurrentMasterTable() == "la_program") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="la_program">
<input type="hidden" name="fk_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_edit->ProgramCode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($la_sub_program_edit->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label id="elh_la_sub_program_ProgramCode" class="<?php echo $la_sub_program_edit->LeftColumnClass ?>"><?php echo $la_sub_program_edit->ProgramCode->caption() ?><?php echo $la_sub_program_edit->ProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_sub_program_edit->RightColumnClass ?>"><div <?php echo $la_sub_program_edit->ProgramCode->cellAttributes() ?>>
<?php if ($la_sub_program_edit->ProgramCode->getSessionValue() != "") { ?>
<span id="el_la_sub_program_ProgramCode">
<span<?php echo $la_sub_program_edit->ProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_sub_program_edit->ProgramCode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ProgramCode" name="x_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_edit->ProgramCode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_la_sub_program_ProgramCode">
<?php
$onchange = $la_sub_program_edit->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_sub_program_edit->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProgramCode" id="sv_x_ProgramCode" value="<?php echo RemoveHtml($la_sub_program_edit->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($la_sub_program_edit->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_sub_program_edit->ProgramCode->getPlaceHolder()) ?>"<?php echo $la_sub_program_edit->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_sub_program_edit->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_sub_program_edit->ProgramCode->ReadOnly || $la_sub_program_edit->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_sub_program_edit->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_edit->ProgramCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_sub_programedit"], function() {
	fla_sub_programedit.createAutoSuggest({"id":"x_ProgramCode","forceSelect":true});
});
</script>
<?php echo $la_sub_program_edit->ProgramCode->Lookup->getParamTag($la_sub_program_edit, "p_x_ProgramCode") ?>
</span>
<?php } ?>
<?php echo $la_sub_program_edit->ProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_sub_program_edit->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label id="elh_la_sub_program_SubProgramCode" class="<?php echo $la_sub_program_edit->LeftColumnClass ?>"><?php echo $la_sub_program_edit->SubProgramCode->caption() ?><?php echo $la_sub_program_edit->SubProgramCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_sub_program_edit->RightColumnClass ?>"><div <?php echo $la_sub_program_edit->SubProgramCode->cellAttributes() ?>>
<span id="el_la_sub_program_SubProgramCode">
<span<?php echo $la_sub_program_edit->SubProgramCode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_sub_program_edit->SubProgramCode->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_SubProgramCode" name="x_SubProgramCode" id="x_SubProgramCode" value="<?php echo HtmlEncode($la_sub_program_edit->SubProgramCode->CurrentValue) ?>">
<?php echo $la_sub_program_edit->SubProgramCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_sub_program_edit->SubProgramName->Visible) { // SubProgramName ?>
	<div id="r_SubProgramName" class="form-group row">
		<label id="elh_la_sub_program_SubProgramName" for="x_SubProgramName" class="<?php echo $la_sub_program_edit->LeftColumnClass ?>"><?php echo $la_sub_program_edit->SubProgramName->caption() ?><?php echo $la_sub_program_edit->SubProgramName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_sub_program_edit->RightColumnClass ?>"><div <?php echo $la_sub_program_edit->SubProgramName->cellAttributes() ?>>
<span id="el_la_sub_program_SubProgramName">
<input type="text" data-table="la_sub_program" data-field="x_SubProgramName" name="x_SubProgramName" id="x_SubProgramName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_sub_program_edit->SubProgramName->getPlaceHolder()) ?>" value="<?php echo $la_sub_program_edit->SubProgramName->EditValue ?>"<?php echo $la_sub_program_edit->SubProgramName->editAttributes() ?>>
</span>
<?php echo $la_sub_program_edit->SubProgramName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_sub_program_edit->SubProgramPurpose->Visible) { // SubProgramPurpose ?>
	<div id="r_SubProgramPurpose" class="form-group row">
		<label id="elh_la_sub_program_SubProgramPurpose" for="x_SubProgramPurpose" class="<?php echo $la_sub_program_edit->LeftColumnClass ?>"><?php echo $la_sub_program_edit->SubProgramPurpose->caption() ?><?php echo $la_sub_program_edit->SubProgramPurpose->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_sub_program_edit->RightColumnClass ?>"><div <?php echo $la_sub_program_edit->SubProgramPurpose->cellAttributes() ?>>
<span id="el_la_sub_program_SubProgramPurpose">
<textarea data-table="la_sub_program" data-field="x_SubProgramPurpose" name="x_SubProgramPurpose" id="x_SubProgramPurpose" cols="35" rows="4" placeholder="<?php echo HtmlEncode($la_sub_program_edit->SubProgramPurpose->getPlaceHolder()) ?>"<?php echo $la_sub_program_edit->SubProgramPurpose->editAttributes() ?>><?php echo $la_sub_program_edit->SubProgramPurpose->EditValue ?></textarea>
</span>
<?php echo $la_sub_program_edit->SubProgramPurpose->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$la_sub_program_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $la_sub_program_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $la_sub_program_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$la_sub_program_edit->IsModal) { ?>
<?php echo $la_sub_program_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$la_sub_program_edit->showPageFooter();
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
$la_sub_program_edit->terminate();
?>