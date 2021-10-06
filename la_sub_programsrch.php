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
$la_sub_program_search = new la_sub_program_search();

// Run the page
$la_sub_program_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_sub_program_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fla_sub_programsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($la_sub_program_search->IsModal) { ?>
	fla_sub_programsearch = currentAdvancedSearchForm = new ew.Form("fla_sub_programsearch", "search");
	<?php } else { ?>
	fla_sub_programsearch = currentForm = new ew.Form("fla_sub_programsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fla_sub_programsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_ProgramCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($la_sub_program_search->ProgramCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SubProgramCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($la_sub_program_search->SubProgramCode->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fla_sub_programsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fla_sub_programsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fla_sub_programsearch.lists["x_ProgramCode"] = <?php echo $la_sub_program_search->ProgramCode->Lookup->toClientList($la_sub_program_search) ?>;
	fla_sub_programsearch.lists["x_ProgramCode"].options = <?php echo JsonEncode($la_sub_program_search->ProgramCode->lookupOptions()) ?>;
	fla_sub_programsearch.autoSuggests["x_ProgramCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fla_sub_programsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $la_sub_program_search->showPageHeader(); ?>
<?php
$la_sub_program_search->showMessage();
?>
<form name="fla_sub_programsearch" id="fla_sub_programsearch" class="<?php echo $la_sub_program_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_sub_program">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$la_sub_program_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($la_sub_program_search->ProgramCode->Visible) { // ProgramCode ?>
	<div id="r_ProgramCode" class="form-group row">
		<label class="<?php echo $la_sub_program_search->LeftColumnClass ?>"><span id="elh_la_sub_program_ProgramCode"><?php echo $la_sub_program_search->ProgramCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_ProgramCode" id="z_ProgramCode" value="=">
</span>
		</label>
		<div class="<?php echo $la_sub_program_search->RightColumnClass ?>"><div <?php echo $la_sub_program_search->ProgramCode->cellAttributes() ?>>
			<span id="el_la_sub_program_ProgramCode" class="ew-search-field">
<?php
$onchange = $la_sub_program_search->ProgramCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_sub_program_search->ProgramCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_ProgramCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ProgramCode" id="sv_x_ProgramCode" value="<?php echo RemoveHtml($la_sub_program_search->ProgramCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($la_sub_program_search->ProgramCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_sub_program_search->ProgramCode->getPlaceHolder()) ?>"<?php echo $la_sub_program_search->ProgramCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_sub_program_search->ProgramCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ProgramCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_sub_program_search->ProgramCode->ReadOnly || $la_sub_program_search->ProgramCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_sub_program" data-field="x_ProgramCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_sub_program_search->ProgramCode->displayValueSeparatorAttribute() ?>" name="x_ProgramCode" id="x_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_search->ProgramCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_sub_programsearch"], function() {
	fla_sub_programsearch.createAutoSuggest({"id":"x_ProgramCode","forceSelect":true});
});
</script>
<?php echo $la_sub_program_search->ProgramCode->Lookup->getParamTag($la_sub_program_search, "p_x_ProgramCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($la_sub_program_search->SubProgramCode->Visible) { // SubProgramCode ?>
	<div id="r_SubProgramCode" class="form-group row">
		<label for="x_SubProgramCode" class="<?php echo $la_sub_program_search->LeftColumnClass ?>"><span id="elh_la_sub_program_SubProgramCode"><?php echo $la_sub_program_search->SubProgramCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SubProgramCode" id="z_SubProgramCode" value="=">
</span>
		</label>
		<div class="<?php echo $la_sub_program_search->RightColumnClass ?>"><div <?php echo $la_sub_program_search->SubProgramCode->cellAttributes() ?>>
			<span id="el_la_sub_program_SubProgramCode" class="ew-search-field">
<input type="text" data-table="la_sub_program" data-field="x_SubProgramCode" name="x_SubProgramCode" id="x_SubProgramCode" placeholder="<?php echo HtmlEncode($la_sub_program_search->SubProgramCode->getPlaceHolder()) ?>" value="<?php echo $la_sub_program_search->SubProgramCode->EditValue ?>"<?php echo $la_sub_program_search->SubProgramCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($la_sub_program_search->SubProgramName->Visible) { // SubProgramName ?>
	<div id="r_SubProgramName" class="form-group row">
		<label for="x_SubProgramName" class="<?php echo $la_sub_program_search->LeftColumnClass ?>"><span id="elh_la_sub_program_SubProgramName"><?php echo $la_sub_program_search->SubProgramName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SubProgramName" id="z_SubProgramName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $la_sub_program_search->RightColumnClass ?>"><div <?php echo $la_sub_program_search->SubProgramName->cellAttributes() ?>>
			<span id="el_la_sub_program_SubProgramName" class="ew-search-field">
<input type="text" data-table="la_sub_program" data-field="x_SubProgramName" name="x_SubProgramName" id="x_SubProgramName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_sub_program_search->SubProgramName->getPlaceHolder()) ?>" value="<?php echo $la_sub_program_search->SubProgramName->EditValue ?>"<?php echo $la_sub_program_search->SubProgramName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($la_sub_program_search->SubProgramPurpose->Visible) { // SubProgramPurpose ?>
	<div id="r_SubProgramPurpose" class="form-group row">
		<label for="x_SubProgramPurpose" class="<?php echo $la_sub_program_search->LeftColumnClass ?>"><span id="elh_la_sub_program_SubProgramPurpose"><?php echo $la_sub_program_search->SubProgramPurpose->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_SubProgramPurpose" id="z_SubProgramPurpose" value="LIKE">
</span>
		</label>
		<div class="<?php echo $la_sub_program_search->RightColumnClass ?>"><div <?php echo $la_sub_program_search->SubProgramPurpose->cellAttributes() ?>>
			<span id="el_la_sub_program_SubProgramPurpose" class="ew-search-field">
<input type="text" data-table="la_sub_program" data-field="x_SubProgramPurpose" name="x_SubProgramPurpose" id="x_SubProgramPurpose" size="35" maxlength="255" placeholder="<?php echo HtmlEncode($la_sub_program_search->SubProgramPurpose->getPlaceHolder()) ?>" value="<?php echo $la_sub_program_search->SubProgramPurpose->EditValue ?>"<?php echo $la_sub_program_search->SubProgramPurpose->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$la_sub_program_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $la_sub_program_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$la_sub_program_search->showPageFooter();
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
$la_sub_program_search->terminate();
?>