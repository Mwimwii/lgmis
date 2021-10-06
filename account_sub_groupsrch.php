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
$account_sub_group_search = new account_sub_group_search();

// Run the page
$account_sub_group_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$account_sub_group_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var faccount_sub_groupsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($account_sub_group_search->IsModal) { ?>
	faccount_sub_groupsearch = currentAdvancedSearchForm = new ew.Form("faccount_sub_groupsearch", "search");
	<?php } else { ?>
	faccount_sub_groupsearch = currentForm = new ew.Form("faccount_sub_groupsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	faccount_sub_groupsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_AccountType");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($account_sub_group_search->AccountType->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AccountGroupCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($account_sub_group_search->AccountGroupCode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_AccountSubGroupCode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($account_sub_group_search->AccountSubGroupCode->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	faccount_sub_groupsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	faccount_sub_groupsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	faccount_sub_groupsearch.lists["x_AccountType"] = <?php echo $account_sub_group_search->AccountType->Lookup->toClientList($account_sub_group_search) ?>;
	faccount_sub_groupsearch.lists["x_AccountType"].options = <?php echo JsonEncode($account_sub_group_search->AccountType->lookupOptions()) ?>;
	faccount_sub_groupsearch.autoSuggests["x_AccountType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	faccount_sub_groupsearch.lists["x_AccountGroupCode"] = <?php echo $account_sub_group_search->AccountGroupCode->Lookup->toClientList($account_sub_group_search) ?>;
	faccount_sub_groupsearch.lists["x_AccountGroupCode"].options = <?php echo JsonEncode($account_sub_group_search->AccountGroupCode->lookupOptions()) ?>;
	faccount_sub_groupsearch.autoSuggests["x_AccountGroupCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	faccount_sub_groupsearch.lists["x_AccountSubGroupCode"] = <?php echo $account_sub_group_search->AccountSubGroupCode->Lookup->toClientList($account_sub_group_search) ?>;
	faccount_sub_groupsearch.lists["x_AccountSubGroupCode"].options = <?php echo JsonEncode($account_sub_group_search->AccountSubGroupCode->lookupOptions()) ?>;
	faccount_sub_groupsearch.autoSuggests["x_AccountSubGroupCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("faccount_sub_groupsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $account_sub_group_search->showPageHeader(); ?>
<?php
$account_sub_group_search->showMessage();
?>
<form name="faccount_sub_groupsearch" id="faccount_sub_groupsearch" class="<?php echo $account_sub_group_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="account_sub_group">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$account_sub_group_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($account_sub_group_search->AccountType->Visible) { // AccountType ?>
	<div id="r_AccountType" class="form-group row">
		<label class="<?php echo $account_sub_group_search->LeftColumnClass ?>"><span id="elh_account_sub_group_AccountType"><?php echo $account_sub_group_search->AccountType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AccountType" id="z_AccountType" value="=">
</span>
		</label>
		<div class="<?php echo $account_sub_group_search->RightColumnClass ?>"><div <?php echo $account_sub_group_search->AccountType->cellAttributes() ?>>
			<span id="el_account_sub_group_AccountType" class="ew-search-field">
<?php
$onchange = $account_sub_group_search->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$account_sub_group_search->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_AccountType" id="sv_x_AccountType" value="<?php echo RemoveHtml($account_sub_group_search->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($account_sub_group_search->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($account_sub_group_search->AccountType->getPlaceHolder()) ?>"<?php echo $account_sub_group_search->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($account_sub_group_search->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($account_sub_group_search->AccountType->ReadOnly || $account_sub_group_search->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $account_sub_group_search->AccountType->displayValueSeparatorAttribute() ?>" name="x_AccountType" id="x_AccountType" value="<?php echo HtmlEncode($account_sub_group_search->AccountType->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccount_sub_groupsearch"], function() {
	faccount_sub_groupsearch.createAutoSuggest({"id":"x_AccountType","forceSelect":false});
});
</script>
<?php echo $account_sub_group_search->AccountType->Lookup->getParamTag($account_sub_group_search, "p_x_AccountType") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($account_sub_group_search->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<div id="r_AccountGroupCode" class="form-group row">
		<label class="<?php echo $account_sub_group_search->LeftColumnClass ?>"><span id="elh_account_sub_group_AccountGroupCode"><?php echo $account_sub_group_search->AccountGroupCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AccountGroupCode" id="z_AccountGroupCode" value="=">
</span>
		</label>
		<div class="<?php echo $account_sub_group_search->RightColumnClass ?>"><div <?php echo $account_sub_group_search->AccountGroupCode->cellAttributes() ?>>
			<span id="el_account_sub_group_AccountGroupCode" class="ew-search-field">
<?php
$onchange = $account_sub_group_search->AccountGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$account_sub_group_search->AccountGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_AccountGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_AccountGroupCode" id="sv_x_AccountGroupCode" value="<?php echo RemoveHtml($account_sub_group_search->AccountGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($account_sub_group_search->AccountGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($account_sub_group_search->AccountGroupCode->getPlaceHolder()) ?>"<?php echo $account_sub_group_search->AccountGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($account_sub_group_search->AccountGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_AccountGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($account_sub_group_search->AccountGroupCode->ReadOnly || $account_sub_group_search->AccountGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $account_sub_group_search->AccountGroupCode->displayValueSeparatorAttribute() ?>" name="x_AccountGroupCode" id="x_AccountGroupCode" value="<?php echo HtmlEncode($account_sub_group_search->AccountGroupCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccount_sub_groupsearch"], function() {
	faccount_sub_groupsearch.createAutoSuggest({"id":"x_AccountGroupCode","forceSelect":false});
});
</script>
<?php echo $account_sub_group_search->AccountGroupCode->Lookup->getParamTag($account_sub_group_search, "p_x_AccountGroupCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($account_sub_group_search->AccountSubGroupCode->Visible) { // AccountSubGroupCode ?>
	<div id="r_AccountSubGroupCode" class="form-group row">
		<label class="<?php echo $account_sub_group_search->LeftColumnClass ?>"><span id="elh_account_sub_group_AccountSubGroupCode"><?php echo $account_sub_group_search->AccountSubGroupCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_AccountSubGroupCode" id="z_AccountSubGroupCode" value="=">
</span>
		</label>
		<div class="<?php echo $account_sub_group_search->RightColumnClass ?>"><div <?php echo $account_sub_group_search->AccountSubGroupCode->cellAttributes() ?>>
			<span id="el_account_sub_group_AccountSubGroupCode" class="ew-search-field">
<?php
$onchange = $account_sub_group_search->AccountSubGroupCode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$account_sub_group_search->AccountSubGroupCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_AccountSubGroupCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_AccountSubGroupCode" id="sv_x_AccountSubGroupCode" value="<?php echo RemoveHtml($account_sub_group_search->AccountSubGroupCode->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($account_sub_group_search->AccountSubGroupCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($account_sub_group_search->AccountSubGroupCode->getPlaceHolder()) ?>"<?php echo $account_sub_group_search->AccountSubGroupCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($account_sub_group_search->AccountSubGroupCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_AccountSubGroupCode',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($account_sub_group_search->AccountSubGroupCode->ReadOnly || $account_sub_group_search->AccountSubGroupCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="account_sub_group" data-field="x_AccountSubGroupCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $account_sub_group_search->AccountSubGroupCode->displayValueSeparatorAttribute() ?>" name="x_AccountSubGroupCode" id="x_AccountSubGroupCode" value="<?php echo HtmlEncode($account_sub_group_search->AccountSubGroupCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccount_sub_groupsearch"], function() {
	faccount_sub_groupsearch.createAutoSuggest({"id":"x_AccountSubGroupCode","forceSelect":false});
});
</script>
<?php echo $account_sub_group_search->AccountSubGroupCode->Lookup->getParamTag($account_sub_group_search, "p_x_AccountSubGroupCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($account_sub_group_search->AccountSubGroupName->Visible) { // AccountSubGroupName ?>
	<div id="r_AccountSubGroupName" class="form-group row">
		<label for="x_AccountSubGroupName" class="<?php echo $account_sub_group_search->LeftColumnClass ?>"><span id="elh_account_sub_group_AccountSubGroupName"><?php echo $account_sub_group_search->AccountSubGroupName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AccountSubGroupName" id="z_AccountSubGroupName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $account_sub_group_search->RightColumnClass ?>"><div <?php echo $account_sub_group_search->AccountSubGroupName->cellAttributes() ?>>
			<span id="el_account_sub_group_AccountSubGroupName" class="ew-search-field">
<input type="text" data-table="account_sub_group" data-field="x_AccountSubGroupName" name="x_AccountSubGroupName" id="x_AccountSubGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($account_sub_group_search->AccountSubGroupName->getPlaceHolder()) ?>" value="<?php echo $account_sub_group_search->AccountSubGroupName->EditValue ?>"<?php echo $account_sub_group_search->AccountSubGroupName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$account_sub_group_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $account_sub_group_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$account_sub_group_search->showPageFooter();
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
$account_sub_group_search->terminate();
?>