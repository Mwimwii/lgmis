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
$la_bank_account_add = new la_bank_account_add();

// Run the page
$la_bank_account_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_bank_account_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fla_bank_accountadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fla_bank_accountadd = currentForm = new ew.Form("fla_bank_accountadd", "add");

	// Validate form
	fla_bank_accountadd.validate = function() {
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
			<?php if ($la_bank_account_add->BankCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_add->BankCode->caption(), $la_bank_account_add->BankCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_add->BranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_add->BranchCode->caption(), $la_bank_account_add->BranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_add->AccountName->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_add->AccountName->caption(), $la_bank_account_add->AccountName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_add->BankAccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BankAccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_add->BankAccountNo->caption(), $la_bank_account_add->BankAccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_add->LACode->caption(), $la_bank_account_add->LACode->RequiredErrorMessage)) ?>");
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
	fla_bank_accountadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fla_bank_accountadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fla_bank_accountadd.lists["x_BankCode"] = <?php echo $la_bank_account_add->BankCode->Lookup->toClientList($la_bank_account_add) ?>;
	fla_bank_accountadd.lists["x_BankCode"].options = <?php echo JsonEncode($la_bank_account_add->BankCode->lookupOptions()) ?>;
	fla_bank_accountadd.autoSuggests["x_BankCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fla_bank_accountadd.lists["x_BranchCode"] = <?php echo $la_bank_account_add->BranchCode->Lookup->toClientList($la_bank_account_add) ?>;
	fla_bank_accountadd.lists["x_BranchCode"].options = <?php echo JsonEncode($la_bank_account_add->BranchCode->lookupOptions()) ?>;
	fla_bank_accountadd.lists["x_LACode"] = <?php echo $la_bank_account_add->LACode->Lookup->toClientList($la_bank_account_add) ?>;
	fla_bank_accountadd.lists["x_LACode"].options = <?php echo JsonEncode($la_bank_account_add->LACode->lookupOptions()) ?>;
	fla_bank_accountadd.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fla_bank_accountadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $la_bank_account_add->showPageHeader(); ?>
<?php
$la_bank_account_add->showMessage();
?>
<form name="fla_bank_accountadd" id="fla_bank_accountadd" class="<?php echo $la_bank_account_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_bank_account">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$la_bank_account_add->IsModal ?>">
<?php if ($la_bank_account->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($la_bank_account_add->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($la_bank_account_add->BankCode->Visible) { // BankCode ?>
	<div id="r_BankCode" class="form-group row">
		<label id="elh_la_bank_account_BankCode" class="<?php echo $la_bank_account_add->LeftColumnClass ?>"><?php echo $la_bank_account_add->BankCode->caption() ?><?php echo $la_bank_account_add->BankCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_bank_account_add->RightColumnClass ?>"><div <?php echo $la_bank_account_add->BankCode->cellAttributes() ?>>
<span id="el_la_bank_account_BankCode">
<?php
$onchange = $la_bank_account_add->BankCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_add->BankCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_BankCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_BankCode" id="sv_x_BankCode" value="<?php echo RemoveHtml($la_bank_account_add->BankCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($la_bank_account_add->BankCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_add->BankCode->getPlaceHolder()) ?>"<?php echo $la_bank_account_add->BankCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_add->BankCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_BankCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_add->BankCode->ReadOnly || $la_bank_account_add->BankCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_add->BankCode->displayValueSeparatorAttribute() ?>" name="x_BankCode" id="x_BankCode" value="<?php echo HtmlEncode($la_bank_account_add->BankCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountadd"], function() {
	fla_bank_accountadd.createAutoSuggest({"id":"x_BankCode","forceSelect":true});
});
</script>
<?php echo $la_bank_account_add->BankCode->Lookup->getParamTag($la_bank_account_add, "p_x_BankCode") ?>
</span>
<?php echo $la_bank_account_add->BankCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_bank_account_add->BranchCode->Visible) { // BranchCode ?>
	<div id="r_BranchCode" class="form-group row">
		<label id="elh_la_bank_account_BranchCode" for="x_BranchCode" class="<?php echo $la_bank_account_add->LeftColumnClass ?>"><?php echo $la_bank_account_add->BranchCode->caption() ?><?php echo $la_bank_account_add->BranchCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_bank_account_add->RightColumnClass ?>"><div <?php echo $la_bank_account_add->BranchCode->cellAttributes() ?>>
<span id="el_la_bank_account_BranchCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BranchCode"><?php echo EmptyValue(strval($la_bank_account_add->BranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $la_bank_account_add->BranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_add->BranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_add->BranchCode->ReadOnly || $la_bank_account_add->BranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $la_bank_account_add->BranchCode->Lookup->getParamTag($la_bank_account_add, "p_x_BranchCode") ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_add->BranchCode->displayValueSeparatorAttribute() ?>" name="x_BranchCode" id="x_BranchCode" value="<?php echo $la_bank_account_add->BranchCode->CurrentValue ?>"<?php echo $la_bank_account_add->BranchCode->editAttributes() ?>>
</span>
<?php echo $la_bank_account_add->BranchCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_bank_account_add->AccountName->Visible) { // AccountName ?>
	<div id="r_AccountName" class="form-group row">
		<label id="elh_la_bank_account_AccountName" for="x_AccountName" class="<?php echo $la_bank_account_add->LeftColumnClass ?>"><?php echo $la_bank_account_add->AccountName->caption() ?><?php echo $la_bank_account_add->AccountName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_bank_account_add->RightColumnClass ?>"><div <?php echo $la_bank_account_add->AccountName->cellAttributes() ?>>
<span id="el_la_bank_account_AccountName">
<input type="text" data-table="la_bank_account" data-field="x_AccountName" name="x_AccountName" id="x_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_bank_account_add->AccountName->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_add->AccountName->EditValue ?>"<?php echo $la_bank_account_add->AccountName->editAttributes() ?>>
</span>
<?php echo $la_bank_account_add->AccountName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_bank_account_add->BankAccountNo->Visible) { // BankAccountNo ?>
	<div id="r_BankAccountNo" class="form-group row">
		<label id="elh_la_bank_account_BankAccountNo" for="x_BankAccountNo" class="<?php echo $la_bank_account_add->LeftColumnClass ?>"><?php echo $la_bank_account_add->BankAccountNo->caption() ?><?php echo $la_bank_account_add->BankAccountNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_bank_account_add->RightColumnClass ?>"><div <?php echo $la_bank_account_add->BankAccountNo->cellAttributes() ?>>
<span id="el_la_bank_account_BankAccountNo">
<input type="text" data-table="la_bank_account" data-field="x_BankAccountNo" name="x_BankAccountNo" id="x_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($la_bank_account_add->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_add->BankAccountNo->EditValue ?>"<?php echo $la_bank_account_add->BankAccountNo->editAttributes() ?>>
</span>
<?php echo $la_bank_account_add->BankAccountNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_bank_account_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_la_bank_account_LACode" class="<?php echo $la_bank_account_add->LeftColumnClass ?>"><?php echo $la_bank_account_add->LACode->caption() ?><?php echo $la_bank_account_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_bank_account_add->RightColumnClass ?>"><div <?php echo $la_bank_account_add->LACode->cellAttributes() ?>>
<?php if ($la_bank_account_add->LACode->getSessionValue() != "") { ?>
<span id="el_la_bank_account_LACode">
<span<?php echo $la_bank_account_add->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_add->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($la_bank_account_add->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_la_bank_account_LACode">
<?php
$onchange = $la_bank_account_add->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_add->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($la_bank_account_add->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($la_bank_account_add->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_add->LACode->getPlaceHolder()) ?>"<?php echo $la_bank_account_add->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" data-value-separator="<?php echo $la_bank_account_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($la_bank_account_add->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountadd"], function() {
	fla_bank_accountadd.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $la_bank_account_add->LACode->Lookup->getParamTag($la_bank_account_add, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $la_bank_account_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$la_bank_account_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $la_bank_account_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $la_bank_account_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$la_bank_account_add->showPageFooter();
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
$la_bank_account_add->terminate();
?>