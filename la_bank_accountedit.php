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
$la_bank_account_edit = new la_bank_account_edit();

// Run the page
$la_bank_account_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_bank_account_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fla_bank_accountedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fla_bank_accountedit = currentForm = new ew.Form("fla_bank_accountedit", "edit");

	// Validate form
	fla_bank_accountedit.validate = function() {
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
			<?php if ($la_bank_account_edit->BankCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BankCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_edit->BankCode->caption(), $la_bank_account_edit->BankCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_edit->BranchCode->Required) { ?>
				elm = this.getElements("x" + infix + "_BranchCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_edit->BranchCode->caption(), $la_bank_account_edit->BranchCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_edit->AccountName->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_edit->AccountName->caption(), $la_bank_account_edit->AccountName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_edit->BankAccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BankAccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_edit->BankAccountNo->caption(), $la_bank_account_edit->BankAccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($la_bank_account_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $la_bank_account_edit->LACode->caption(), $la_bank_account_edit->LACode->RequiredErrorMessage)) ?>");
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
	fla_bank_accountedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fla_bank_accountedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fla_bank_accountedit.lists["x_BankCode"] = <?php echo $la_bank_account_edit->BankCode->Lookup->toClientList($la_bank_account_edit) ?>;
	fla_bank_accountedit.lists["x_BankCode"].options = <?php echo JsonEncode($la_bank_account_edit->BankCode->lookupOptions()) ?>;
	fla_bank_accountedit.autoSuggests["x_BankCode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fla_bank_accountedit.lists["x_BranchCode"] = <?php echo $la_bank_account_edit->BranchCode->Lookup->toClientList($la_bank_account_edit) ?>;
	fla_bank_accountedit.lists["x_BranchCode"].options = <?php echo JsonEncode($la_bank_account_edit->BranchCode->lookupOptions()) ?>;
	fla_bank_accountedit.lists["x_LACode"] = <?php echo $la_bank_account_edit->LACode->Lookup->toClientList($la_bank_account_edit) ?>;
	fla_bank_accountedit.lists["x_LACode"].options = <?php echo JsonEncode($la_bank_account_edit->LACode->lookupOptions()) ?>;
	fla_bank_accountedit.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fla_bank_accountedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $la_bank_account_edit->showPageHeader(); ?>
<?php
$la_bank_account_edit->showMessage();
?>
<?php if (!$la_bank_account_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $la_bank_account_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fla_bank_accountedit" id="fla_bank_accountedit" class="<?php echo $la_bank_account_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_bank_account">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$la_bank_account_edit->IsModal ?>">
<?php if ($la_bank_account->getCurrentMasterTable() == "local_authority") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($la_bank_account_edit->LACode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($la_bank_account_edit->BankCode->Visible) { // BankCode ?>
	<div id="r_BankCode" class="form-group row">
		<label id="elh_la_bank_account_BankCode" class="<?php echo $la_bank_account_edit->LeftColumnClass ?>"><?php echo $la_bank_account_edit->BankCode->caption() ?><?php echo $la_bank_account_edit->BankCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_bank_account_edit->RightColumnClass ?>"><div <?php echo $la_bank_account_edit->BankCode->cellAttributes() ?>>
<span id="el_la_bank_account_BankCode">
<?php
$onchange = $la_bank_account_edit->BankCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_edit->BankCode->EditAttrs["onchange"] = "";
?>
<span id="as_x_BankCode">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_BankCode" id="sv_x_BankCode" value="<?php echo RemoveHtml($la_bank_account_edit->BankCode->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($la_bank_account_edit->BankCode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_edit->BankCode->getPlaceHolder()) ?>"<?php echo $la_bank_account_edit->BankCode->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_edit->BankCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_BankCode',m:0,n:10,srch:false});" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_edit->BankCode->ReadOnly || $la_bank_account_edit->BankCode->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_BankCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_edit->BankCode->displayValueSeparatorAttribute() ?>" name="x_BankCode" id="x_BankCode" value="<?php echo HtmlEncode($la_bank_account_edit->BankCode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountedit"], function() {
	fla_bank_accountedit.createAutoSuggest({"id":"x_BankCode","forceSelect":true});
});
</script>
<?php echo $la_bank_account_edit->BankCode->Lookup->getParamTag($la_bank_account_edit, "p_x_BankCode") ?>
</span>
<?php echo $la_bank_account_edit->BankCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_bank_account_edit->BranchCode->Visible) { // BranchCode ?>
	<div id="r_BranchCode" class="form-group row">
		<label id="elh_la_bank_account_BranchCode" for="x_BranchCode" class="<?php echo $la_bank_account_edit->LeftColumnClass ?>"><?php echo $la_bank_account_edit->BranchCode->caption() ?><?php echo $la_bank_account_edit->BranchCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_bank_account_edit->RightColumnClass ?>"><div <?php echo $la_bank_account_edit->BranchCode->cellAttributes() ?>>
<span id="el_la_bank_account_BranchCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_BranchCode"><?php echo EmptyValue(strval($la_bank_account_edit->BranchCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $la_bank_account_edit->BranchCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($la_bank_account_edit->BranchCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($la_bank_account_edit->BranchCode->ReadOnly || $la_bank_account_edit->BranchCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_BranchCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $la_bank_account_edit->BranchCode->Lookup->getParamTag($la_bank_account_edit, "p_x_BranchCode") ?>
<input type="hidden" data-table="la_bank_account" data-field="x_BranchCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $la_bank_account_edit->BranchCode->displayValueSeparatorAttribute() ?>" name="x_BranchCode" id="x_BranchCode" value="<?php echo $la_bank_account_edit->BranchCode->CurrentValue ?>"<?php echo $la_bank_account_edit->BranchCode->editAttributes() ?>>
</span>
<?php echo $la_bank_account_edit->BranchCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_bank_account_edit->AccountName->Visible) { // AccountName ?>
	<div id="r_AccountName" class="form-group row">
		<label id="elh_la_bank_account_AccountName" for="x_AccountName" class="<?php echo $la_bank_account_edit->LeftColumnClass ?>"><?php echo $la_bank_account_edit->AccountName->caption() ?><?php echo $la_bank_account_edit->AccountName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_bank_account_edit->RightColumnClass ?>"><div <?php echo $la_bank_account_edit->AccountName->cellAttributes() ?>>
<span id="el_la_bank_account_AccountName">
<input type="text" data-table="la_bank_account" data-field="x_AccountName" name="x_AccountName" id="x_AccountName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($la_bank_account_edit->AccountName->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_edit->AccountName->EditValue ?>"<?php echo $la_bank_account_edit->AccountName->editAttributes() ?>>
</span>
<?php echo $la_bank_account_edit->AccountName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_bank_account_edit->BankAccountNo->Visible) { // BankAccountNo ?>
	<div id="r_BankAccountNo" class="form-group row">
		<label id="elh_la_bank_account_BankAccountNo" for="x_BankAccountNo" class="<?php echo $la_bank_account_edit->LeftColumnClass ?>"><?php echo $la_bank_account_edit->BankAccountNo->caption() ?><?php echo $la_bank_account_edit->BankAccountNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_bank_account_edit->RightColumnClass ?>"><div <?php echo $la_bank_account_edit->BankAccountNo->cellAttributes() ?>>
<input type="text" data-table="la_bank_account" data-field="x_BankAccountNo" name="x_BankAccountNo" id="x_BankAccountNo" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($la_bank_account_edit->BankAccountNo->getPlaceHolder()) ?>" value="<?php echo $la_bank_account_edit->BankAccountNo->EditValue ?>"<?php echo $la_bank_account_edit->BankAccountNo->editAttributes() ?>>
<input type="hidden" data-table="la_bank_account" data-field="x_BankAccountNo" name="o_BankAccountNo" id="o_BankAccountNo" value="<?php echo HtmlEncode($la_bank_account_edit->BankAccountNo->OldValue != null ? $la_bank_account_edit->BankAccountNo->OldValue : $la_bank_account_edit->BankAccountNo->CurrentValue) ?>">
<?php echo $la_bank_account_edit->BankAccountNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($la_bank_account_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_la_bank_account_LACode" class="<?php echo $la_bank_account_edit->LeftColumnClass ?>"><?php echo $la_bank_account_edit->LACode->caption() ?><?php echo $la_bank_account_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $la_bank_account_edit->RightColumnClass ?>"><div <?php echo $la_bank_account_edit->LACode->cellAttributes() ?>>
<?php if ($la_bank_account_edit->LACode->getSessionValue() != "") { ?>
<span id="el_la_bank_account_LACode">
<span<?php echo $la_bank_account_edit->LACode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($la_bank_account_edit->LACode->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_LACode" name="x_LACode" value="<?php echo HtmlEncode($la_bank_account_edit->LACode->CurrentValue) ?>">
<?php } else { ?>
<span id="el_la_bank_account_LACode">
<?php
$onchange = $la_bank_account_edit->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$la_bank_account_edit->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($la_bank_account_edit->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($la_bank_account_edit->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($la_bank_account_edit->LACode->getPlaceHolder()) ?>"<?php echo $la_bank_account_edit->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="la_bank_account" data-field="x_LACode" data-value-separator="<?php echo $la_bank_account_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($la_bank_account_edit->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fla_bank_accountedit"], function() {
	fla_bank_accountedit.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $la_bank_account_edit->LACode->Lookup->getParamTag($la_bank_account_edit, "p_x_LACode") ?>
</span>
<?php } ?>
<?php echo $la_bank_account_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$la_bank_account_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $la_bank_account_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $la_bank_account_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$la_bank_account_edit->IsModal) { ?>
<?php echo $la_bank_account_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$la_bank_account_edit->showPageFooter();
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
$la_bank_account_edit->terminate();
?>