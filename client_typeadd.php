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
$client_type_add = new client_type_add();

// Run the page
$client_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclient_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fclient_typeadd = currentForm = new ew.Form("fclient_typeadd", "add");

	// Validate form
	fclient_typeadd.validate = function() {
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
			<?php if ($client_type_add->ClientTypeTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientTypeTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_type_add->ClientTypeTypeDesc->caption(), $client_type_add->ClientTypeTypeDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_type_add->IDType->Required) { ?>
				elm = this.getElements("x" + infix + "_IDType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_type_add->IDType->caption(), $client_type_add->IDType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($client_type_add->PrivilegeType->Required) { ?>
				elm = this.getElements("x" + infix + "_PrivilegeType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $client_type_add->PrivilegeType->caption(), $client_type_add->PrivilegeType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_PrivilegeType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($client_type_add->PrivilegeType->errorMessage()) ?>");

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
	fclient_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fclient_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fclient_typeadd.lists["x_IDType"] = <?php echo $client_type_add->IDType->Lookup->toClientList($client_type_add) ?>;
	fclient_typeadd.lists["x_IDType"].options = <?php echo JsonEncode($client_type_add->IDType->lookupOptions()) ?>;
	loadjs.done("fclient_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $client_type_add->showPageHeader(); ?>
<?php
$client_type_add->showMessage();
?>
<form name="fclient_typeadd" id="fclient_typeadd" class="<?php echo $client_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$client_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($client_type_add->ClientTypeTypeDesc->Visible) { // ClientTypeTypeDesc ?>
	<div id="r_ClientTypeTypeDesc" class="form-group row">
		<label id="elh_client_type_ClientTypeTypeDesc" for="x_ClientTypeTypeDesc" class="<?php echo $client_type_add->LeftColumnClass ?>"><?php echo $client_type_add->ClientTypeTypeDesc->caption() ?><?php echo $client_type_add->ClientTypeTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_type_add->RightColumnClass ?>"><div <?php echo $client_type_add->ClientTypeTypeDesc->cellAttributes() ?>>
<span id="el_client_type_ClientTypeTypeDesc">
<input type="text" data-table="client_type" data-field="x_ClientTypeTypeDesc" name="x_ClientTypeTypeDesc" id="x_ClientTypeTypeDesc" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($client_type_add->ClientTypeTypeDesc->getPlaceHolder()) ?>" value="<?php echo $client_type_add->ClientTypeTypeDesc->EditValue ?>"<?php echo $client_type_add->ClientTypeTypeDesc->editAttributes() ?>>
</span>
<?php echo $client_type_add->ClientTypeTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_type_add->IDType->Visible) { // IDType ?>
	<div id="r_IDType" class="form-group row">
		<label id="elh_client_type_IDType" for="x_IDType" class="<?php echo $client_type_add->LeftColumnClass ?>"><?php echo $client_type_add->IDType->caption() ?><?php echo $client_type_add->IDType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_type_add->RightColumnClass ?>"><div <?php echo $client_type_add->IDType->cellAttributes() ?>>
<span id="el_client_type_IDType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="client_type" data-field="x_IDType" data-value-separator="<?php echo $client_type_add->IDType->displayValueSeparatorAttribute() ?>" id="x_IDType" name="x_IDType"<?php echo $client_type_add->IDType->editAttributes() ?>>
			<?php echo $client_type_add->IDType->selectOptionListHtml("x_IDType") ?>
		</select>
</div>
<?php echo $client_type_add->IDType->Lookup->getParamTag($client_type_add, "p_x_IDType") ?>
</span>
<?php echo $client_type_add->IDType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($client_type_add->PrivilegeType->Visible) { // PrivilegeType ?>
	<div id="r_PrivilegeType" class="form-group row">
		<label id="elh_client_type_PrivilegeType" for="x_PrivilegeType" class="<?php echo $client_type_add->LeftColumnClass ?>"><?php echo $client_type_add->PrivilegeType->caption() ?><?php echo $client_type_add->PrivilegeType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $client_type_add->RightColumnClass ?>"><div <?php echo $client_type_add->PrivilegeType->cellAttributes() ?>>
<span id="el_client_type_PrivilegeType">
<input type="text" data-table="client_type" data-field="x_PrivilegeType" name="x_PrivilegeType" id="x_PrivilegeType" size="30" placeholder="<?php echo HtmlEncode($client_type_add->PrivilegeType->getPlaceHolder()) ?>" value="<?php echo $client_type_add->PrivilegeType->EditValue ?>"<?php echo $client_type_add->PrivilegeType->editAttributes() ?>>
</span>
<?php echo $client_type_add->PrivilegeType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$client_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $client_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $client_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$client_type_add->showPageFooter();
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
$client_type_add->terminate();
?>