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
$service_provider_edit = new service_provider_edit();

// Run the page
$service_provider_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$service_provider_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fservice_provideredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fservice_provideredit = currentForm = new ew.Form("fservice_provideredit", "edit");

	// Validate form
	fservice_provideredit.validate = function() {
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
			<?php if ($service_provider_edit->ServiceProviderID->Required) { ?>
				elm = this.getElements("x" + infix + "_ServiceProviderID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $service_provider_edit->ServiceProviderID->caption(), $service_provider_edit->ServiceProviderID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ServiceProviderID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($service_provider_edit->ServiceProviderID->errorMessage()) ?>");
			<?php if ($service_provider_edit->SPName->Required) { ?>
				elm = this.getElements("x" + infix + "_SPName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $service_provider_edit->SPName->caption(), $service_provider_edit->SPName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($service_provider_edit->SPType->Required) { ?>
				elm = this.getElements("x" + infix + "_SPType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $service_provider_edit->SPType->caption(), $service_provider_edit->SPType->RequiredErrorMessage)) ?>");
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
	fservice_provideredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fservice_provideredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fservice_provideredit.lists["x_SPType"] = <?php echo $service_provider_edit->SPType->Lookup->toClientList($service_provider_edit) ?>;
	fservice_provideredit.lists["x_SPType"].options = <?php echo JsonEncode($service_provider_edit->SPType->lookupOptions()) ?>;
	loadjs.done("fservice_provideredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $service_provider_edit->showPageHeader(); ?>
<?php
$service_provider_edit->showMessage();
?>
<?php if (!$service_provider_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $service_provider_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fservice_provideredit" id="fservice_provideredit" class="<?php echo $service_provider_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="service_provider">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$service_provider_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($service_provider_edit->ServiceProviderID->Visible) { // ServiceProviderID ?>
	<div id="r_ServiceProviderID" class="form-group row">
		<label id="elh_service_provider_ServiceProviderID" for="x_ServiceProviderID" class="<?php echo $service_provider_edit->LeftColumnClass ?>"><?php echo $service_provider_edit->ServiceProviderID->caption() ?><?php echo $service_provider_edit->ServiceProviderID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $service_provider_edit->RightColumnClass ?>"><div <?php echo $service_provider_edit->ServiceProviderID->cellAttributes() ?>>
<input type="text" data-table="service_provider" data-field="x_ServiceProviderID" name="x_ServiceProviderID" id="x_ServiceProviderID" size="30" placeholder="<?php echo HtmlEncode($service_provider_edit->ServiceProviderID->getPlaceHolder()) ?>" value="<?php echo $service_provider_edit->ServiceProviderID->EditValue ?>"<?php echo $service_provider_edit->ServiceProviderID->editAttributes() ?>>
<input type="hidden" data-table="service_provider" data-field="x_ServiceProviderID" name="o_ServiceProviderID" id="o_ServiceProviderID" value="<?php echo HtmlEncode($service_provider_edit->ServiceProviderID->OldValue != null ? $service_provider_edit->ServiceProviderID->OldValue : $service_provider_edit->ServiceProviderID->CurrentValue) ?>">
<?php echo $service_provider_edit->ServiceProviderID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($service_provider_edit->SPName->Visible) { // SPName ?>
	<div id="r_SPName" class="form-group row">
		<label id="elh_service_provider_SPName" for="x_SPName" class="<?php echo $service_provider_edit->LeftColumnClass ?>"><?php echo $service_provider_edit->SPName->caption() ?><?php echo $service_provider_edit->SPName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $service_provider_edit->RightColumnClass ?>"><div <?php echo $service_provider_edit->SPName->cellAttributes() ?>>
<span id="el_service_provider_SPName">
<input type="text" data-table="service_provider" data-field="x_SPName" name="x_SPName" id="x_SPName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($service_provider_edit->SPName->getPlaceHolder()) ?>" value="<?php echo $service_provider_edit->SPName->EditValue ?>"<?php echo $service_provider_edit->SPName->editAttributes() ?>>
</span>
<?php echo $service_provider_edit->SPName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($service_provider_edit->SPType->Visible) { // SPType ?>
	<div id="r_SPType" class="form-group row">
		<label id="elh_service_provider_SPType" for="x_SPType" class="<?php echo $service_provider_edit->LeftColumnClass ?>"><?php echo $service_provider_edit->SPType->caption() ?><?php echo $service_provider_edit->SPType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $service_provider_edit->RightColumnClass ?>"><div <?php echo $service_provider_edit->SPType->cellAttributes() ?>>
<span id="el_service_provider_SPType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="service_provider" data-field="x_SPType" data-value-separator="<?php echo $service_provider_edit->SPType->displayValueSeparatorAttribute() ?>" id="x_SPType" name="x_SPType"<?php echo $service_provider_edit->SPType->editAttributes() ?>>
			<?php echo $service_provider_edit->SPType->selectOptionListHtml("x_SPType") ?>
		</select>
</div>
<?php echo $service_provider_edit->SPType->Lookup->getParamTag($service_provider_edit, "p_x_SPType") ?>
</span>
<?php echo $service_provider_edit->SPType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$service_provider_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $service_provider_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $service_provider_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$service_provider_edit->IsModal) { ?>
<?php echo $service_provider_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$service_provider_edit->showPageFooter();
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
$service_provider_edit->terminate();
?>