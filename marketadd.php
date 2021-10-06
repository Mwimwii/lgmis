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
$market_add = new market_add();

// Run the page
$market_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$market_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmarketadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmarketadd = currentForm = new ew.Form("fmarketadd", "add");

	// Validate form
	fmarketadd.validate = function() {
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
			<?php if ($market_add->MarketName->Required) { ?>
				elm = this.getElements("x" + infix + "_MarketName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_add->MarketName->caption(), $market_add->MarketName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_add->MarketDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_MarketDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_add->MarketDesc->caption(), $market_add->MarketDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_add->MarketMaster->Required) { ?>
				elm = this.getElements("x" + infix + "_MarketMaster");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_add->MarketMaster->caption(), $market_add->MarketMaster->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_add->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_add->LastUpdatedBy->caption(), $market_add->LastUpdatedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($market_add->LastUpdateDate->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $market_add->LastUpdateDate->caption(), $market_add->LastUpdateDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_LastUpdateDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($market_add->LastUpdateDate->errorMessage()) ?>");

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
	fmarketadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmarketadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fmarketadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $market_add->showPageHeader(); ?>
<?php
$market_add->showMessage();
?>
<form name="fmarketadd" id="fmarketadd" class="<?php echo $market_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="market">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$market_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($market_add->MarketName->Visible) { // MarketName ?>
	<div id="r_MarketName" class="form-group row">
		<label id="elh_market_MarketName" for="x_MarketName" class="<?php echo $market_add->LeftColumnClass ?>"><?php echo $market_add->MarketName->caption() ?><?php echo $market_add->MarketName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_add->RightColumnClass ?>"><div <?php echo $market_add->MarketName->cellAttributes() ?>>
<span id="el_market_MarketName">
<input type="text" data-table="market" data-field="x_MarketName" name="x_MarketName" id="x_MarketName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($market_add->MarketName->getPlaceHolder()) ?>" value="<?php echo $market_add->MarketName->EditValue ?>"<?php echo $market_add->MarketName->editAttributes() ?>>
</span>
<?php echo $market_add->MarketName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_add->MarketDesc->Visible) { // MarketDesc ?>
	<div id="r_MarketDesc" class="form-group row">
		<label id="elh_market_MarketDesc" for="x_MarketDesc" class="<?php echo $market_add->LeftColumnClass ?>"><?php echo $market_add->MarketDesc->caption() ?><?php echo $market_add->MarketDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_add->RightColumnClass ?>"><div <?php echo $market_add->MarketDesc->cellAttributes() ?>>
<span id="el_market_MarketDesc">
<input type="text" data-table="market" data-field="x_MarketDesc" name="x_MarketDesc" id="x_MarketDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($market_add->MarketDesc->getPlaceHolder()) ?>" value="<?php echo $market_add->MarketDesc->EditValue ?>"<?php echo $market_add->MarketDesc->editAttributes() ?>>
</span>
<?php echo $market_add->MarketDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_add->MarketMaster->Visible) { // MarketMaster ?>
	<div id="r_MarketMaster" class="form-group row">
		<label id="elh_market_MarketMaster" for="x_MarketMaster" class="<?php echo $market_add->LeftColumnClass ?>"><?php echo $market_add->MarketMaster->caption() ?><?php echo $market_add->MarketMaster->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_add->RightColumnClass ?>"><div <?php echo $market_add->MarketMaster->cellAttributes() ?>>
<span id="el_market_MarketMaster">
<input type="text" data-table="market" data-field="x_MarketMaster" name="x_MarketMaster" id="x_MarketMaster" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($market_add->MarketMaster->getPlaceHolder()) ?>" value="<?php echo $market_add->MarketMaster->EditValue ?>"<?php echo $market_add->MarketMaster->editAttributes() ?>>
</span>
<?php echo $market_add->MarketMaster->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_add->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_market_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $market_add->LeftColumnClass ?>"><?php echo $market_add->LastUpdatedBy->caption() ?><?php echo $market_add->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_add->RightColumnClass ?>"><div <?php echo $market_add->LastUpdatedBy->cellAttributes() ?>>
<span id="el_market_LastUpdatedBy">
<input type="text" data-table="market" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($market_add->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $market_add->LastUpdatedBy->EditValue ?>"<?php echo $market_add->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $market_add->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($market_add->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<div id="r_LastUpdateDate" class="form-group row">
		<label id="elh_market_LastUpdateDate" for="x_LastUpdateDate" class="<?php echo $market_add->LeftColumnClass ?>"><?php echo $market_add->LastUpdateDate->caption() ?><?php echo $market_add->LastUpdateDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $market_add->RightColumnClass ?>"><div <?php echo $market_add->LastUpdateDate->cellAttributes() ?>>
<span id="el_market_LastUpdateDate">
<input type="text" data-table="market" data-field="x_LastUpdateDate" name="x_LastUpdateDate" id="x_LastUpdateDate" placeholder="<?php echo HtmlEncode($market_add->LastUpdateDate->getPlaceHolder()) ?>" value="<?php echo $market_add->LastUpdateDate->EditValue ?>"<?php echo $market_add->LastUpdateDate->editAttributes() ?>>
</span>
<?php echo $market_add->LastUpdateDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("market_property", explode(",", $market->getCurrentDetailTable())) && $market_property->DetailAdd) {
?>
<?php if ($market->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("market_property", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "market_propertygrid.php" ?>
<?php } ?>
<?php if (!$market_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $market_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $market_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$market_add->showPageFooter();
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
$market_add->terminate();
?>