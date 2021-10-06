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
$serviceprovidertype_add = new serviceprovidertype_add();

// Run the page
$serviceprovidertype_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$serviceprovidertype_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fserviceprovidertypeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fserviceprovidertypeadd = currentForm = new ew.Form("fserviceprovidertypeadd", "add");

	// Validate form
	fserviceprovidertypeadd.validate = function() {
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
			<?php if ($serviceprovidertype_add->SPTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_SPTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $serviceprovidertype_add->SPTypeDesc->caption(), $serviceprovidertype_add->SPTypeDesc->RequiredErrorMessage)) ?>");
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
	fserviceprovidertypeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fserviceprovidertypeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fserviceprovidertypeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $serviceprovidertype_add->showPageHeader(); ?>
<?php
$serviceprovidertype_add->showMessage();
?>
<form name="fserviceprovidertypeadd" id="fserviceprovidertypeadd" class="<?php echo $serviceprovidertype_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="serviceprovidertype">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$serviceprovidertype_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($serviceprovidertype_add->SPTypeDesc->Visible) { // SPTypeDesc ?>
	<div id="r_SPTypeDesc" class="form-group row">
		<label id="elh_serviceprovidertype_SPTypeDesc" for="x_SPTypeDesc" class="<?php echo $serviceprovidertype_add->LeftColumnClass ?>"><?php echo $serviceprovidertype_add->SPTypeDesc->caption() ?><?php echo $serviceprovidertype_add->SPTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $serviceprovidertype_add->RightColumnClass ?>"><div <?php echo $serviceprovidertype_add->SPTypeDesc->cellAttributes() ?>>
<span id="el_serviceprovidertype_SPTypeDesc">
<input type="text" data-table="serviceprovidertype" data-field="x_SPTypeDesc" name="x_SPTypeDesc" id="x_SPTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($serviceprovidertype_add->SPTypeDesc->getPlaceHolder()) ?>" value="<?php echo $serviceprovidertype_add->SPTypeDesc->EditValue ?>"<?php echo $serviceprovidertype_add->SPTypeDesc->editAttributes() ?>>
</span>
<?php echo $serviceprovidertype_add->SPTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$serviceprovidertype_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $serviceprovidertype_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $serviceprovidertype_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$serviceprovidertype_add->showPageFooter();
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
$serviceprovidertype_add->terminate();
?>