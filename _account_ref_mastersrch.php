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
$_account_ref_master_search = new _account_ref_master_search();

// Run the page
$_account_ref_master_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_account_ref_master_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var f_account_ref_mastersearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($_account_ref_master_search->IsModal) { ?>
	f_account_ref_mastersearch = currentAdvancedSearchForm = new ew.Form("f_account_ref_mastersearch", "search");
	<?php } else { ?>
	f_account_ref_mastersearch = currentForm = new ew.Form("f_account_ref_mastersearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	f_account_ref_mastersearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_AccountGroupCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_account_ref_master_search->AccountGroupCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Amount");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_account_ref_master_search->Amount->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AccountType");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_account_ref_master_search->AccountType->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AccountSubGroupCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($_account_ref_master_search->AccountSubGroupCode->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	f_account_ref_mastersearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	f_account_ref_mastersearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	f_account_ref_mastersearch.lists["x_AccountGroupCode"] = <?php echo $_account_ref_master_search->AccountGroupCode->Lookup->toClientList($_account_ref_master_search) ?>;
	f_account_ref_mastersearch.lists["x_AccountGroupCode"].options = <?php echo JsonEncode($_account_ref_master_search->AccountGroupCode->lookupOptions()) ?>;
	f_account_ref_mastersearch.autoSuggests["x_AccountGroupCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_account_ref_mastersearch.lists["x_AccountType"] = <?php echo $_account_ref_master_search->AccountType->Lookup->toClientList($_account_ref_master_search) ?>;
	f_account_ref_mastersearch.lists["x_AccountType"].options = <?php echo JsonEncode($_account_ref_master_search->AccountType->lookupOptions()) ?>;
	f_account_ref_mastersearch.autoSuggests["x_AccountType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	f_account_ref_mastersearch.lists["x_AccountSubGroupCode"] = <?php echo $_account_ref_master_search->AccountSubGroupCode->Lookup->toClientList($_account_ref_master_search) ?>;
	f_account_ref_mastersearch.lists["x_AccountSubGroupCode"].options = <?php echo JsonEncode($_account_ref_master_search->AccountSubGroupCode->lookupOptions()) ?>;
	f_account_ref_mastersearch.autoSuggests["x_AccountSubGroupCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("f_account_ref_mastersearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $_account_ref_master_search->showPageHeader(); ?>
<?php
$_account_ref_master_search->showMessage();
?>
<form name="f_account_ref_mastersearch" id="f_account_ref_mastersearch" class="<?php echo $_account_ref_master_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_account_ref_master">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$_account_ref_master_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($_account_ref_master_search->AccountCode->Visible) { // AccountCode ?>
	<div id="r_AccountCode" class="form-group row">
		<label for="x_AccountCode" class="<?php echo $_account_ref_master_search->LeftColumnClass ?>"><span id="elh__account_ref_master_AccountCode"><?php echo $_account_ref_master_search->AccountCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AccountCode" id="z_AccountCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_account_ref_master_search->RightColumnClass ?>"><div <?php echo $_account_ref_master_search->AccountCode->cellAttributes() ?>>
			<span id="el__account_ref_master_AccountCode" class="ew-search-field">
<input type="text" data-table="_account_ref_master" data-field="x_AccountCode" name="x_AccountCode" id="x_AccountCode" size="30" maxlength="25" placeholder="<?php echo HtmlEncode($_account_ref_master_search->AccountCode->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_search->AccountCode->EditValue ?>"<?php echo $_account_ref_master_search->AccountCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_account_ref_master_search->AccountName->Visible) { // AccountName ?>
	<div id="r_AccountName" class="form-group row">
		<label for="x_AccountName" class="<?php echo $_account_ref_master_search->LeftColumnClass ?>"><span id="elh__account_ref_master_AccountName"><?php echo $_account_ref_master_search->AccountName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AccountName" id="z_AccountName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_account_ref_master_search->RightColumnClass ?>"><div <?php echo $_account_ref_master_search->AccountName->cellAttributes() ?>>
			<span id="el__account_ref_master_AccountName" class="ew-search-field">
<input type="text" data-table="_account_ref_master" data-field="x_AccountName" name="x_AccountName" id="x_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_search->AccountName->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_search->AccountName->EditValue ?>"<?php echo $_account_ref_master_search->AccountName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_account_ref_master_search->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<div id="r_AccountGroupCode" class="form-group row">
		<label class="<?php echo $_account_ref_master_search->LeftColumnClass ?>"><span id="elh__account_ref_master_AccountGroupCode"><?php echo $_account_ref_master_search->AccountGroupCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AccountGroupCode" id="z_AccountGroupCode" value="=">
</span>
		</label>
		<div class="<?php echo $_account_ref_master_search->RightColumnClass ?>"><div <?php echo $_account_ref_master_search->AccountGroupCode->cellAttributes() ?>>
			<span id="el__account_ref_master_AccountGroupCode" class="ew-search-field">
<?php
$onchange = $_account_ref_master_search->AccountGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_search->AccountGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_AccountGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_AccountGroupCode" id="sv_x_AccountGroupCode" value="<?php echo RemoveHtml($_account_ref_master_search->AccountGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_search->AccountGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_search->AccountGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_search->AccountGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_search->AccountGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_AccountGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_search->AccountGroupCode->ReadOnly || $_account_ref_master_search->AccountGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_search->AccountGroupCode->displayValueSeparatorAttribute() ?>" name="x_AccountGroupCode" id="x_AccountGroupCode" value="<?php echo HtmlEncode($_account_ref_master_search->AccountGroupCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_mastersearch"], function() {
	f_account_ref_mastersearch.createAutoSuggest({"id":"x_AccountGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_search->AccountGroupCode->Lookup->getParamTag($_account_ref_master_search, "p_x_AccountGroupCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_account_ref_master_search->AccountDesc->Visible) { // AccountDesc ?>
	<div id="r_AccountDesc" class="form-group row">
		<label for="x_AccountDesc" class="<?php echo $_account_ref_master_search->LeftColumnClass ?>"><span id="elh__account_ref_master_AccountDesc"><?php echo $_account_ref_master_search->AccountDesc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AccountDesc" id="z_AccountDesc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $_account_ref_master_search->RightColumnClass ?>"><div <?php echo $_account_ref_master_search->AccountDesc->cellAttributes() ?>>
			<span id="el__account_ref_master_AccountDesc" class="ew-search-field">
<input type="text" data-table="_account_ref_master" data-field="x_AccountDesc" name="x_AccountDesc" id="x_AccountDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($_account_ref_master_search->AccountDesc->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_search->AccountDesc->EditValue ?>"<?php echo $_account_ref_master_search->AccountDesc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_account_ref_master_search->Amount->Visible) { // Amount ?>
	<div id="r_Amount" class="form-group row">
		<label for="x_Amount" class="<?php echo $_account_ref_master_search->LeftColumnClass ?>"><span id="elh__account_ref_master_Amount"><?php echo $_account_ref_master_search->Amount->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Amount" id="z_Amount" value="=">
</span>
		</label>
		<div class="<?php echo $_account_ref_master_search->RightColumnClass ?>"><div <?php echo $_account_ref_master_search->Amount->cellAttributes() ?>>
			<span id="el__account_ref_master_Amount" class="ew-search-field">
<input type="text" data-table="_account_ref_master" data-field="x_Amount" name="x_Amount" id="x_Amount" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_search->Amount->getPlaceHolder()) ?>" value="<?php echo $_account_ref_master_search->Amount->EditValue ?>"<?php echo $_account_ref_master_search->Amount->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_account_ref_master_search->AccountType->Visible) { // AccountType ?>
	<div id="r_AccountType" class="form-group row">
		<label class="<?php echo $_account_ref_master_search->LeftColumnClass ?>"><span id="elh__account_ref_master_AccountType"><?php echo $_account_ref_master_search->AccountType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AccountType" id="z_AccountType" value="=">
</span>
		</label>
		<div class="<?php echo $_account_ref_master_search->RightColumnClass ?>"><div <?php echo $_account_ref_master_search->AccountType->cellAttributes() ?>>
			<span id="el__account_ref_master_AccountType" class="ew-search-field">
<?php
$onchange = $_account_ref_master_search->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_search->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_AccountType" id="sv_x_AccountType" value="<?php echo RemoveHtml($_account_ref_master_search->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_search->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_search->AccountType->getPlaceHolder()) ?>"<?php echo $_account_ref_master_search->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_search->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_search->AccountType->ReadOnly || $_account_ref_master_search->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_search->AccountType->displayValueSeparatorAttribute() ?>" name="x_AccountType" id="x_AccountType" value="<?php echo HtmlEncode($_account_ref_master_search->AccountType->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_mastersearch"], function() {
	f_account_ref_mastersearch.createAutoSuggest({"id":"x_AccountType","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_search->AccountType->Lookup->getParamTag($_account_ref_master_search, "p_x_AccountType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($_account_ref_master_search->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
	<div id="r_AccountSubGroupCode" class="form-group row">
		<label class="<?php echo $_account_ref_master_search->LeftColumnClass ?>"><span id="elh__account_ref_master_AccountSubGroupCode"><?php echo $_account_ref_master_search->AccountSubGroupCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AccountSubGroupCode" id="z_AccountSubGroupCode" value="=">
</span>
		</label>
		<div class="<?php echo $_account_ref_master_search->RightColumnClass ?>"><div <?php echo $_account_ref_master_search->AccountSubGroupCode->cellAttributes() ?>>
			<span id="el__account_ref_master_AccountSubGroupCode" class="ew-search-field">
<?php
$onchange = $_account_ref_master_search->AccountSubGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$_account_ref_master_search->AccountSubGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_AccountSubGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_AccountSubGroupCode" id="sv_x_AccountSubGroupCode" value="<?php echo RemoveHtml($_account_ref_master_search->AccountSubGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($_account_ref_master_search->AccountSubGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($_account_ref_master_search->AccountSubGroupCode->getPlaceHolder()) ?>"<?php echo $_account_ref_master_search->AccountSubGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($_account_ref_master_search->AccountSubGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_AccountSubGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($_account_ref_master_search->AccountSubGroupCode->ReadOnly || $_account_ref_master_search->AccountSubGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="_account_ref_master" data-field="x_AccountSubGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $_account_ref_master_search->AccountSubGroupCode->displayValueSeparatorAttribute() ?>" name="x_AccountSubGroupCode" id="x_AccountSubGroupCode" value="<?php echo HtmlEncode($_account_ref_master_search->AccountSubGroupCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["f_account_ref_mastersearch"], function() {
	f_account_ref_mastersearch.createAutoSuggest({"id":"x_AccountSubGroupCode","forceSelect":false});
});
</script>
<?php echo $_account_ref_master_search->AccountSubGroupCode->Lookup->getParamTag($_account_ref_master_search, "p_x_AccountSubGroupCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$_account_ref_master_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $_account_ref_master_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$_account_ref_master_search->showPageFooter();
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
$_account_ref_master_search->terminate();
?>