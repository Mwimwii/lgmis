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
$la_bank_account_search = new la_bank_account_search();

// Run the page
$la_bank_account_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_bank_account_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fla_bank_accountsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($la_bank_account_search->IsModal) { ?>
	fla_bank_accountsearch = currentAdvancedSearchForm = new ew.Form("fla_bank_accountsearch", "search");
	<?php } else { ?>
	fla_bank_accountsearch = currentForm = new ew.Form("fla_bank_accountsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fla_bank_accountsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fla_bank_accountsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fla_bank_accountsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fla_bank_accountsearch.lists["x_BankCode"] = <?php echo $la_bank_account_search->BankCode->Lookup->toClientList($la_bank_account_search) ?>;
	fla_bank_accountsearch.lists["x_BankCode"].options = <?php echo JsonEncode($la_bank_account_search->BankCode->lookupOptions()) ?>;
	fla_bank_accountsearch.autoSuggests["x_BankCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fla_bank_accountsearch.lists["x_BranchCode"] = <?php echo $la_bank_account_search->BranchCode->Lookup->toClientList($la_bank_account_search) ?>;
	fla_bank_accountsearch.lists["x_BranchCode"].options = <?php echo JsonEncode($la_bank_account_search->BranchCode->lookupOptions()) ?>;
	fla_bank_accountsearch.lists["x_LACode"] = <?php echo $la_bank_account_search->LACode->Lookup->toClientList($la_bank_account_search) ?>;
	fla_bank_accountsearch.lists["x_LACode"].options = <?php echo JsonEncode($la_bank_account_search->LACode->lookupOptions()) ?>;
	fla_bank_accountsearch.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fla_bank_accountsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $la_bank_account_search->showPageHeader(); ?>
<?php
$la_bank_account_search->showMessage();
?>
<form name="fla_bank_accountsearch" id="fla_bank_accountsearch" class="<?php echo $la_bank_account_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_bank_account">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$la_bank_account_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($la_bank_account_search->BankCode->Visible) { // BankCode ?>
	<div id="r_BankCode" class="form-group row">
		<label class="<?php echo $la_bank_account_search->LeftColumnClass ?>"><span id="elh_la_bank_account_BankCode"><?php echo $la_bank_account_search->BankCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BankCode" id="z_BankCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $la_bank_account_search->RightColumnClass ?>"><div <?php echo $la_bank_account_search->BankCode->cellAttributes() ?>>
			<span id="el_la_bank_account_BankCode" class="ew-search-field">
<?php
$onchange = $la_bank_account_search->BankCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_search->BankCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_BankCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_BankCode" id="sv_x_BankCode" value="<?php echo RemoveHtml($la_bank_account_search->BankCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($la_bank_account_search->BankCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_search->BankCode->getPlaceHolder()) ?>"<?php echo $la_bank_account_search->BankCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_search->BankCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_BankCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_search->BankCode->ReadOnly || $la_bank_account_search->BankCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_search->BankCode->displayValueSeparatorAttribute() ?>" name="x_BankCode" id="x_BankCode" value="<?php echo HtmlEncode($la_bank_account_search->BankCode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountsearch"], function() {
	fla_bank_accountsearch.createAutoSuggest({"id":"x_BankCode","forceSelect":true});
});
</script>
<?php echo $la_bank_account_search->BankCode->Lookup->getParamTag($la_bank_account_search, "p_x_BankCode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($la_bank_account_search->BranchCode->Visible) { // BranchCode ?>
	<div id="r_BranchCode" class="form-group row">
		<label for="x_BranchCode" class="<?php echo $la_bank_account_search->LeftColumnClass ?>"><span id="elh_la_bank_account_BranchCode"><?php echo $la_bank_account_search->BranchCode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BranchCode" id="z_BranchCode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $la_bank_account_search->RightColumnClass ?>"><div <?php echo $la_bank_account_search->BranchCode->cellAttributes() ?>>
			<span id="el_la_bank_account_BranchCode" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BranchCode"><?php echo EmptyValue(strval($la_bank_account_search->BranchCode->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $la_bank_account_search->BranchCode->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_search->BranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_search->BranchCode->ReadOnly || $la_bank_account_search->BranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $la_bank_account_search->BranchCode->Lookup->getParamTag($la_bank_account_search, "p_x_BranchCode") ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_search->BranchCode->displayValueSeparatorAttribute() ?>" name="x_BranchCode" id="x_BranchCode" value="<?php echo $la_bank_account_search->BranchCode->AdvancedSearch->SearchValue ?>"<?php echo $la_bank_account_search->BranchCode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($la_bank_account_search->AccountName->Visible) { // AccountName ?>
	<div id="r_AccountName" class="form-group row">
		<label for="x_AccountName" class="<?php echo $la_bank_account_search->LeftColumnClass ?>"><span id="elh_la_bank_account_AccountName"><?php echo $la_bank_account_search->AccountName->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_AccountName" id="z_AccountName" value="LIKE">
</span>
		</label>
		<div class="<?php echo $la_bank_account_search->RightColumnClass ?>"><div <?php echo $la_bank_account_search->AccountName->cellAttributes() ?>>
			<span id="el_la_bank_account_AccountName" class="ew-search-field">
<input type="text" data-table="la_bank_account" data-field="x_AccountName" name="x_AccountName" id="x_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_bank_account_search->AccountName->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_search->AccountName->EditValue ?>"<?php echo $la_bank_account_search->AccountName->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($la_bank_account_search->BankAccountNo->Visible) { // BankAccountNo ?>
	<div id="r_BankAccountNo" class="form-group row">
		<label for="x_BankAccountNo" class="<?php echo $la_bank_account_search->LeftColumnClass ?>"><span id="elh_la_bank_account_BankAccountNo"><?php echo $la_bank_account_search->BankAccountNo->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_BankAccountNo" id="z_BankAccountNo" value="LIKE">
</span>
		</label>
		<div class="<?php echo $la_bank_account_search->RightColumnClass ?>"><div <?php echo $la_bank_account_search->BankAccountNo->cellAttributes() ?>>
			<span id="el_la_bank_account_BankAccountNo" class="ew-search-field">
<input type="text" data-table="la_bank_account" data-field="x_BankAccountNo" name="x_BankAccountNo" id="x_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($la_bank_account_search->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_search->BankAccountNo->EditValue ?>"<?php echo $la_bank_account_search->BankAccountNo->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($la_bank_account_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label class="<?php echo $la_bank_account_search->LeftColumnClass ?>"><span id="elh_la_bank_account_LACode"><?php echo $la_bank_account_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="LIKE">
</span>
		</label>
		<div class="<?php echo $la_bank_account_search->RightColumnClass ?>"><div <?php echo $la_bank_account_search->LACode->cellAttributes() ?>>
			<span id="el_la_bank_account_LACode" class="ew-search-field">
<?php
$onchange = $la_bank_account_search->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_search->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($la_bank_account_search->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($la_bank_account_search->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_search->LACode->getPlaceHolder()) ?>"<?php echo $la_bank_account_search->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" data-value-separator="<?php echo $la_bank_account_search->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($la_bank_account_search->LACode->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountsearch"], function() {
	fla_bank_accountsearch.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $la_bank_account_search->LACode->Lookup->getParamTag($la_bank_account_search, "p_x_LACode") ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$la_bank_account_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $la_bank_account_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$la_bank_account_search->showPageFooter();
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
$la_bank_account_search->terminate();
?>