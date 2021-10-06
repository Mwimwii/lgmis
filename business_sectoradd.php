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
$business_sector_add = new business_sector_add();

// Run the page
$business_sector_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_sector_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusiness_sectoradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbusiness_sectoradd = currentForm = new ew.Form("fbusiness_sectoradd", "add");

	// Validate form
	fbusiness_sectoradd.validate = function() {
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
			<?php if ($business_sector_add->business_sector_name->Required) { ?>
				elm = this.getElements("x" + infix + "_business_sector_name");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_sector_add->business_sector_name->caption(), $business_sector_add->business_sector_name->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($business_sector_add->business_sector_desc->Required) { ?>
				elm = this.getElements("x" + infix + "_business_sector_desc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $business_sector_add->business_sector_desc->caption(), $business_sector_add->business_sector_desc->RequiredErrorMessage)) ?>");
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
	fbusiness_sectoradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbusiness_sectoradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbusiness_sectoradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_sector_add->showPageHeader(); ?>
<?php
$business_sector_add->showMessage();
?>
<form name="fbusiness_sectoradd" id="fbusiness_sectoradd" class="<?php echo $business_sector_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_sector">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$business_sector_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($business_sector_add->business_sector_name->Visible) { // business_sector_name ?>
	<div id="r_business_sector_name" class="form-group row">
		<label id="elh_business_sector_business_sector_name" for="x_business_sector_name" class="<?php echo $business_sector_add->LeftColumnClass ?>"><?php echo $business_sector_add->business_sector_name->caption() ?><?php echo $business_sector_add->business_sector_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_sector_add->RightColumnClass ?>"><div <?php echo $business_sector_add->business_sector_name->cellAttributes() ?>>
<span id="el_business_sector_business_sector_name">
<input type="text" data-table="business_sector" data-field="x_business_sector_name" name="x_business_sector_name" id="x_business_sector_name" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($business_sector_add->business_sector_name->getPlaceHolder()) ?>" value="<?php echo $business_sector_add->business_sector_name->EditValue ?>"<?php echo $business_sector_add->business_sector_name->editAttributes() ?>>
</span>
<?php echo $business_sector_add->business_sector_name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($business_sector_add->business_sector_desc->Visible) { // business_sector_desc ?>
	<div id="r_business_sector_desc" class="form-group row">
		<label id="elh_business_sector_business_sector_desc" for="x_business_sector_desc" class="<?php echo $business_sector_add->LeftColumnClass ?>"><?php echo $business_sector_add->business_sector_desc->caption() ?><?php echo $business_sector_add->business_sector_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $business_sector_add->RightColumnClass ?>"><div <?php echo $business_sector_add->business_sector_desc->cellAttributes() ?>>
<span id="el_business_sector_business_sector_desc">
<input type="text" data-table="business_sector" data-field="x_business_sector_desc" name="x_business_sector_desc" id="x_business_sector_desc" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($business_sector_add->business_sector_desc->getPlaceHolder()) ?>" value="<?php echo $business_sector_add->business_sector_desc->EditValue ?>"<?php echo $business_sector_add->business_sector_desc->editAttributes() ?>>
</span>
<?php echo $business_sector_add->business_sector_desc->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$business_sector_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $business_sector_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $business_sector_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$business_sector_add->showPageFooter();
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
$business_sector_add->terminate();
?>