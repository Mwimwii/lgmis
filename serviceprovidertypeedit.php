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
$serviceprovidertype_edit = new serviceprovidertype_edit();

// Run the page
$serviceprovidertype_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$serviceprovidertype_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fserviceprovidertypeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fserviceprovidertypeedit = currentForm = new ew.Form("fserviceprovidertypeedit", "edit");

	// Validate form
	fserviceprovidertypeedit.validate = function() {
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
			<?php if ($serviceprovidertype_edit->ServiceProviderType->Required) { ?>
				elm = this.getElements("x" + infix + "_ServiceProviderType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $serviceprovidertype_edit->ServiceProviderType->caption(), $serviceprovidertype_edit->ServiceProviderType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($serviceprovidertype_edit->SPTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_SPTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $serviceprovidertype_edit->SPTypeDesc->caption(), $serviceprovidertype_edit->SPTypeDesc->RequiredErrorMessage)) ?>");
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
	fserviceprovidertypeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fserviceprovidertypeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fserviceprovidertypeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $serviceprovidertype_edit->showPageHeader(); ?>
<?php
$serviceprovidertype_edit->showMessage();
?>
<?php if (!$serviceprovidertype_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $serviceprovidertype_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fserviceprovidertypeedit" id="fserviceprovidertypeedit" class="<?php echo $serviceprovidertype_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="serviceprovidertype">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$serviceprovidertype_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($serviceprovidertype_edit->ServiceProviderType->Visible) { // ServiceProviderType ?>
	<div id="r_ServiceProviderType" class="form-group row">
		<label id="elh_serviceprovidertype_ServiceProviderType" class="<?php echo $serviceprovidertype_edit->LeftColumnClass ?>"><?php echo $serviceprovidertype_edit->ServiceProviderType->caption() ?><?php echo $serviceprovidertype_edit->ServiceProviderType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $serviceprovidertype_edit->RightColumnClass ?>"><div <?php echo $serviceprovidertype_edit->ServiceProviderType->cellAttributes() ?>>
<span id="el_serviceprovidertype_ServiceProviderType">
<span<?php echo $serviceprovidertype_edit->ServiceProviderType->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($serviceprovidertype_edit->ServiceProviderType->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="serviceprovidertype" data-field="x_ServiceProviderType" name="x_ServiceProviderType" id="x_ServiceProviderType" value="<?php echo HtmlEncode($serviceprovidertype_edit->ServiceProviderType->CurrentValue) ?>">
<?php echo $serviceprovidertype_edit->ServiceProviderType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($serviceprovidertype_edit->SPTypeDesc->Visible) { // SPTypeDesc ?>
	<div id="r_SPTypeDesc" class="form-group row">
		<label id="elh_serviceprovidertype_SPTypeDesc" for="x_SPTypeDesc" class="<?php echo $serviceprovidertype_edit->LeftColumnClass ?>"><?php echo $serviceprovidertype_edit->SPTypeDesc->caption() ?><?php echo $serviceprovidertype_edit->SPTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $serviceprovidertype_edit->RightColumnClass ?>"><div <?php echo $serviceprovidertype_edit->SPTypeDesc->cellAttributes() ?>>
<span id="el_serviceprovidertype_SPTypeDesc">
<input type="text" data-table="serviceprovidertype" data-field="x_SPTypeDesc" name="x_SPTypeDesc" id="x_SPTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($serviceprovidertype_edit->SPTypeDesc->getPlaceHolder()) ?>" value="<?php echo $serviceprovidertype_edit->SPTypeDesc->EditValue ?>"<?php echo $serviceprovidertype_edit->SPTypeDesc->editAttributes() ?>>
</span>
<?php echo $serviceprovidertype_edit->SPTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$serviceprovidertype_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $serviceprovidertype_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $serviceprovidertype_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$serviceprovidertype_edit->IsModal) { ?>
<?php echo $serviceprovidertype_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$serviceprovidertype_edit->showPageFooter();
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
$serviceprovidertype_edit->terminate();
?>