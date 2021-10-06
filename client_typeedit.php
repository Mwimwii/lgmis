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
$client_type_edit = new client_type_edit();

// Run the page
$client_type_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_type_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclient_typeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fclient_typeedit = currentForm = new ew.Form("fclient_typeedit", "edit");

	// Validate form
	fclient_typeedit.validate = function() {
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
			<?php if ($client_type_edit->ClientType->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_type_edit->ClientType->caption(), $client_type_edit->ClientType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_type_edit->ClientTypeTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientTypeTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_type_edit->ClientTypeTypeDesc->caption(), $client_type_edit->ClientTypeTypeDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_type_edit->IDType->Required) { ?>
				elm = this.getElements("x" + infix + "_IDType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_type_edit->IDType->caption(), $client_type_edit->IDType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_type_edit->PrivilegeType->Required) { ?>
				elm = this.getElements("x" + infix + "_PrivilegeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_type_edit->PrivilegeType->caption(), $client_type_edit->PrivilegeType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PrivilegeType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_type_edit->PrivilegeType->errorMessage()) ?>");

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
	fclient_typeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fclient_typeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fclient_typeedit.lists["x_IDType"] = <?php echo $client_type_edit->IDType->Lookup->toClientList($client_type_edit) ?>;
	fclient_typeedit.lists["x_IDType"].options = <?php echo JsonEncode($client_type_edit->IDType->lookupOptions()) ?>;
	loadjs.done("fclient_typeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $client_type_edit->showPageHeader(); ?>
<?php
$client_type_edit->showMessage();
?>
<?php if (!$client_type_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_type_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fclient_typeedit" id="fclient_typeedit" class="<?php echo $client_type_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client_type">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$client_type_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($client_type_edit->ClientType->Visible) { // ClientType ?>
	<div id="r_ClientType" class="form-group row">
		<label id="elh_client_type_ClientType" class="<?php echo $client_type_edit->LeftColumnClass ?>"><?php echo $client_type_edit->ClientType->caption() ?><?php echo $client_type_edit->ClientType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_type_edit->RightColumnClass ?>"><div <?php echo $client_type_edit->ClientType->cellAttributes() ?>>
<span id="el_client_type_ClientType">
<span<?php echo $client_type_edit->ClientType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($client_type_edit->ClientType->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="client_type" data-field="x_ClientType" name="x_ClientType" id="x_ClientType" value="<?php echo HtmlEncode($client_type_edit->ClientType->CurrentValue) ?>">
<?php echo $client_type_edit->ClientType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_type_edit->ClientTypeTypeDesc->Visible) { // ClientTypeTypeDesc ?>
	<div id="r_ClientTypeTypeDesc" class="form-group row">
		<label id="elh_client_type_ClientTypeTypeDesc" for="x_ClientTypeTypeDesc" class="<?php echo $client_type_edit->LeftColumnClass ?>"><?php echo $client_type_edit->ClientTypeTypeDesc->caption() ?><?php echo $client_type_edit->ClientTypeTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_type_edit->RightColumnClass ?>"><div <?php echo $client_type_edit->ClientTypeTypeDesc->cellAttributes() ?>>
<span id="el_client_type_ClientTypeTypeDesc">
<input type="text" data-table="client_type" data-field="x_ClientTypeTypeDesc" name="x_ClientTypeTypeDesc" id="x_ClientTypeTypeDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_type_edit->ClientTypeTypeDesc->getPlaceHolder()) ?>" value="<?php echo $client_type_edit->ClientTypeTypeDesc->EditValue ?>"<?php echo $client_type_edit->ClientTypeTypeDesc->editAttributes() ?>>
</span>
<?php echo $client_type_edit->ClientTypeTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_type_edit->IDType->Visible) { // IDType ?>
	<div id="r_IDType" class="form-group row">
		<label id="elh_client_type_IDType" for="x_IDType" class="<?php echo $client_type_edit->LeftColumnClass ?>"><?php echo $client_type_edit->IDType->caption() ?><?php echo $client_type_edit->IDType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_type_edit->RightColumnClass ?>"><div <?php echo $client_type_edit->IDType->cellAttributes() ?>>
<span id="el_client_type_IDType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client_type" data-field="x_IDType" data-value-separator="<?php echo $client_type_edit->IDType->displayValueSeparatorAttribute() ?>" id="x_IDType" name="x_IDType"<?php echo $client_type_edit->IDType->editAttributes() ?>>
			<?php echo $client_type_edit->IDType->selectOptionListHtml("x_IDType") ?>
		</select>
</div>
<?php echo $client_type_edit->IDType->Lookup->getParamTag($client_type_edit, "p_x_IDType") ?>
</span>
<?php echo $client_type_edit->IDType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_type_edit->PrivilegeType->Visible) { // PrivilegeType ?>
	<div id="r_PrivilegeType" class="form-group row">
		<label id="elh_client_type_PrivilegeType" for="x_PrivilegeType" class="<?php echo $client_type_edit->LeftColumnClass ?>"><?php echo $client_type_edit->PrivilegeType->caption() ?><?php echo $client_type_edit->PrivilegeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_type_edit->RightColumnClass ?>"><div <?php echo $client_type_edit->PrivilegeType->cellAttributes() ?>>
<span id="el_client_type_PrivilegeType">
<input type="text" data-table="client_type" data-field="x_PrivilegeType" name="x_PrivilegeType" id="x_PrivilegeType" size="30" placeholder="<?php echo HtmlEncode($client_type_edit->PrivilegeType->getPlaceHolder()) ?>" value="<?php echo $client_type_edit->PrivilegeType->EditValue ?>"<?php echo $client_type_edit->PrivilegeType->editAttributes() ?>>
</span>
<?php echo $client_type_edit->PrivilegeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$client_type_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $client_type_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $client_type_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$client_type_edit->IsModal) { ?>
<?php echo $client_type_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$client_type_edit->showPageFooter();
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
$client_type_edit->terminate();
?>