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
$accountgroup_add = new accountgroup_add();

// Run the page
$accountgroup_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$accountgroup_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var faccountgroupadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	faccountgroupadd = currentForm = new ew.Form("faccountgroupadd", "add");

	// Validate form
	faccountgroupadd.validate = function() {
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
			<?php if ($accountgroup_add->AccountGroupCode->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountGroupCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accountgroup_add->AccountGroupCode->caption(), $accountgroup_add->AccountGroupCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountGroupCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accountgroup_add->AccountGroupCode->errorMessage()) ?>");
			<?php if ($accountgroup_add->AccountGroupName->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountGroupName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accountgroup_add->AccountGroupName->caption(), $accountgroup_add->AccountGroupName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($accountgroup_add->AccountType->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $accountgroup_add->AccountType->caption(), $accountgroup_add->AccountType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AccountType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($accountgroup_add->AccountType->errorMessage()) ?>");

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
	faccountgroupadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	faccountgroupadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	faccountgroupadd.lists["x_AccountType"] = <?php echo $accountgroup_add->AccountType->Lookup->toClientList($accountgroup_add) ?>;
	faccountgroupadd.lists["x_AccountType"].options = <?php echo JsonEncode($accountgroup_add->AccountType->lookupOptions()) ?>;
	faccountgroupadd.autoSuggests["x_AccountType"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("faccountgroupadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $accountgroup_add->showPageHeader(); ?>
<?php
$accountgroup_add->showMessage();
?>
<form name="faccountgroupadd" id="faccountgroupadd" class="<?php echo $accountgroup_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="accountgroup">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$accountgroup_add->IsModal ?>">
<?php if ($accountgroup->getCurrentMasterTable() == "account_type") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="account_type">
<input type="hidden" name="fk_AccountTypeCode" value="<?php echo HtmlEncode($accountgroup_add->AccountType->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($accountgroup_add->AccountGroupCode->Visible) { // AccountGroupCode ?>
	<div id="r_AccountGroupCode" class="form-group row">
		<label id="elh_accountgroup_AccountGroupCode" for="x_AccountGroupCode" class="<?php echo $accountgroup_add->LeftColumnClass ?>"><?php echo $accountgroup_add->AccountGroupCode->caption() ?><?php echo $accountgroup_add->AccountGroupCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accountgroup_add->RightColumnClass ?>"><div <?php echo $accountgroup_add->AccountGroupCode->cellAttributes() ?>>
<span id="el_accountgroup_AccountGroupCode">
<input type="text" data-table="accountgroup" data-field="x_AccountGroupCode" name="x_AccountGroupCode" id="x_AccountGroupCode" size="30" placeholder="<?php echo HtmlEncode($accountgroup_add->AccountGroupCode->getPlaceHolder()) ?>" value="<?php echo $accountgroup_add->AccountGroupCode->EditValue ?>"<?php echo $accountgroup_add->AccountGroupCode->editAttributes() ?>>
</span>
<?php echo $accountgroup_add->AccountGroupCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accountgroup_add->AccountGroupName->Visible) { // AccountGroupName ?>
	<div id="r_AccountGroupName" class="form-group row">
		<label id="elh_accountgroup_AccountGroupName" for="x_AccountGroupName" class="<?php echo $accountgroup_add->LeftColumnClass ?>"><?php echo $accountgroup_add->AccountGroupName->caption() ?><?php echo $accountgroup_add->AccountGroupName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accountgroup_add->RightColumnClass ?>"><div <?php echo $accountgroup_add->AccountGroupName->cellAttributes() ?>>
<span id="el_accountgroup_AccountGroupName">
<input type="text" data-table="accountgroup" data-field="x_AccountGroupName" name="x_AccountGroupName" id="x_AccountGroupName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($accountgroup_add->AccountGroupName->getPlaceHolder()) ?>" value="<?php echo $accountgroup_add->AccountGroupName->EditValue ?>"<?php echo $accountgroup_add->AccountGroupName->editAttributes() ?>>
</span>
<?php echo $accountgroup_add->AccountGroupName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($accountgroup_add->AccountType->Visible) { // AccountType ?>
	<div id="r_AccountType" class="form-group row">
		<label id="elh_accountgroup_AccountType" class="<?php echo $accountgroup_add->LeftColumnClass ?>"><?php echo $accountgroup_add->AccountType->caption() ?><?php echo $accountgroup_add->AccountType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $accountgroup_add->RightColumnClass ?>"><div <?php echo $accountgroup_add->AccountType->cellAttributes() ?>>
<?php if ($accountgroup_add->AccountType->getSessionValue() != "") { ?>
<span id="el_accountgroup_AccountType">
<span<?php echo $accountgroup_add->AccountType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($accountgroup_add->AccountType->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_AccountType" name="x_AccountType" value="<?php echo HtmlEncode($accountgroup_add->AccountType->CurrentValue) ?>">
<?php } else { ?>
<span id="el_accountgroup_AccountType">
<?php
$onchange = $accountgroup_add->AccountType->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$accountgroup_add->AccountType->EditAttrs["onchange"] = "";
?>
<span id="as_x_AccountType">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_AccountType" id="sv_x_AccountType" value="<?php echo RemoveHtml($accountgroup_add->AccountType->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($accountgroup_add->AccountType->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($accountgroup_add->AccountType->getPlaceHolder()) ?>"<?php echo $accountgroup_add->AccountType->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($accountgroup_add->AccountType->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_AccountType',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($accountgroup_add->AccountType->ReadOnly || $accountgroup_add->AccountType->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="accountgroup" data-field="x_AccountType" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $accountgroup_add->AccountType->displayValueSeparatorAttribute() ?>" name="x_AccountType" id="x_AccountType" value="<?php echo HtmlEncode($accountgroup_add->AccountType->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["faccountgroupadd"], function() {
	faccountgroupadd.createAutoSuggest({"id":"x_AccountType","forceSelect":false});
});
</script>
<?php echo $accountgroup_add->AccountType->Lookup->getParamTag($accountgroup_add, "p_x_AccountType") ?>
</span>
<?php } ?>
<?php echo $accountgroup_add->AccountType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$accountgroup_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $accountgroup_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $accountgroup_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$accountgroup_add->showPageFooter();
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
$accountgroup_add->terminate();
?>