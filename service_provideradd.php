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
$service_provider_add = new service_provider_add();

// Run the page
$service_provider_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$service_provider_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fservice_provideradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fservice_provideradd = currentForm = new ew.Form("fservice_provideradd", "add");

	// Validate form
	fservice_provideradd.validate = function() {
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
			<?php if ($service_provider_add->ServiceProviderID->Required) { ?>
				elm = this.getElements("x" + infix + "_ServiceProviderID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $service_provider_add->ServiceProviderID->caption(), $service_provider_add->ServiceProviderID->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ServiceProviderID");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($service_provider_add->ServiceProviderID->errorMessage()) ?>");
			<?php if ($service_provider_add->SPName->Required) { ?>
				elm = this.getElements("x" + infix + "_SPName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $service_provider_add->SPName->caption(), $service_provider_add->SPName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($service_provider_add->SPType->Required) { ?>
				elm = this.getElements("x" + infix + "_SPType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $service_provider_add->SPType->caption(), $service_provider_add->SPType->RequiredErrorMessage)) ?>");
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
	fservice_provideradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fservice_provideradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fservice_provideradd.lists["x_SPType"] = <?php echo $service_provider_add->SPType->Lookup->toClientList($service_provider_add) ?>;
	fservice_provideradd.lists["x_SPType"].options = <?php echo JsonEncode($service_provider_add->SPType->lookupOptions()) ?>;
	loadjs.done("fservice_provideradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $service_provider_add->showPageHeader(); ?>
<?php
$service_provider_add->showMessage();
?>
<form name="fservice_provideradd" id="fservice_provideradd" class="<?php echo $service_provider_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="service_provider">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$service_provider_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($service_provider_add->ServiceProviderID->Visible) { // ServiceProviderID ?>
	<div id="r_ServiceProviderID" class="form-group row">
		<label id="elh_service_provider_ServiceProviderID" for="x_ServiceProviderID" class="<?php echo $service_provider_add->LeftColumnClass ?>"><?php echo $service_provider_add->ServiceProviderID->caption() ?><?php echo $service_provider_add->ServiceProviderID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $service_provider_add->RightColumnClass ?>"><div <?php echo $service_provider_add->ServiceProviderID->cellAttributes() ?>>
<span id="el_service_provider_ServiceProviderID">
<input type="text" data-table="service_provider" data-field="x_ServiceProviderID" name="x_ServiceProviderID" id="x_ServiceProviderID" size="30" placeholder="<?php echo HtmlEncode($service_provider_add->ServiceProviderID->getPlaceHolder()) ?>" value="<?php echo $service_provider_add->ServiceProviderID->EditValue ?>"<?php echo $service_provider_add->ServiceProviderID->editAttributes() ?>>
</span>
<?php echo $service_provider_add->ServiceProviderID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($service_provider_add->SPName->Visible) { // SPName ?>
	<div id="r_SPName" class="form-group row">
		<label id="elh_service_provider_SPName" for="x_SPName" class="<?php echo $service_provider_add->LeftColumnClass ?>"><?php echo $service_provider_add->SPName->caption() ?><?php echo $service_provider_add->SPName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $service_provider_add->RightColumnClass ?>"><div <?php echo $service_provider_add->SPName->cellAttributes() ?>>
<span id="el_service_provider_SPName">
<input type="text" data-table="service_provider" data-field="x_SPName" name="x_SPName" id="x_SPName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($service_provider_add->SPName->getPlaceHolder()) ?>" value="<?php echo $service_provider_add->SPName->EditValue ?>"<?php echo $service_provider_add->SPName->editAttributes() ?>>
</span>
<?php echo $service_provider_add->SPName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($service_provider_add->SPType->Visible) { // SPType ?>
	<div id="r_SPType" class="form-group row">
		<label id="elh_service_provider_SPType" for="x_SPType" class="<?php echo $service_provider_add->LeftColumnClass ?>"><?php echo $service_provider_add->SPType->caption() ?><?php echo $service_provider_add->SPType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $service_provider_add->RightColumnClass ?>"><div <?php echo $service_provider_add->SPType->cellAttributes() ?>>
<span id="el_service_provider_SPType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="service_provider" data-field="x_SPType" data-value-separator="<?php echo $service_provider_add->SPType->displayValueSeparatorAttribute() ?>" id="x_SPType" name="x_SPType"<?php echo $service_provider_add->SPType->editAttributes() ?>>
			<?php echo $service_provider_add->SPType->selectOptionListHtml("x_SPType") ?>
		</select>
</div>
<?php echo $service_provider_add->SPType->Lookup->getParamTag($service_provider_add, "p_x_SPType") ?>
</span>
<?php echo $service_provider_add->SPType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$service_provider_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $service_provider_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $service_provider_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$service_provider_add->showPageFooter();
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
$service_provider_add->terminate();
?>