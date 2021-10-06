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
$business_sector_search = new business_sector_search();

// Run the page
$business_sector_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_sector_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbusiness_sectorsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($business_sector_search->IsModal) { ?>
	fbusiness_sectorsearch = currentAdvancedSearchForm = new ew.Form("fbusiness_sectorsearch", "search");
	<?php } else { ?>
	fbusiness_sectorsearch = currentForm = new ew.Form("fbusiness_sectorsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	fbusiness_sectorsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_business_sector_code");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($business_sector_search->business_sector_code->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_SYSTEM_DATE");
		if (elm && !ew.checkDateDef(elm.value))
			return this.onError(elm, "<?php echo JsEncode($business_sector_search->SYSTEM_DATE->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fbusiness_sectorsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbusiness_sectorsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fbusiness_sectorsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $business_sector_search->showPageHeader(); ?>
<?php
$business_sector_search->showMessage();
?>
<form name="fbusiness_sectorsearch" id="fbusiness_sectorsearch" class="<?php echo $business_sector_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_sector">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$business_sector_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($business_sector_search->business_sector_code->Visible) { // business_sector_code ?>
	<div id="r_business_sector_code" class="form-group row">
		<label for="x_business_sector_code" class="<?php echo $business_sector_search->LeftColumnClass ?>"><span id="elh_business_sector_business_sector_code"><?php echo $business_sector_search->business_sector_code->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_business_sector_code" id="z_business_sector_code" value="=">
</span>
		</label>
		<div class="<?php echo $business_sector_search->RightColumnClass ?>"><div <?php echo $business_sector_search->business_sector_code->cellAttributes() ?>>
			<span id="el_business_sector_business_sector_code" class="ew-search-field">
<input type="text" data-table="business_sector" data-field="x_business_sector_code" name="x_business_sector_code" id="x_business_sector_code" maxlength="5" placeholder="<?php echo HtmlEncode($business_sector_search->business_sector_code->getPlaceHolder()) ?>" value="<?php echo $business_sector_search->business_sector_code->EditValue ?>"<?php echo $business_sector_search->business_sector_code->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($business_sector_search->business_sector_name->Visible) { // business_sector_name ?>
	<div id="r_business_sector_name" class="form-group row">
		<label for="x_business_sector_name" class="<?php echo $business_sector_search->LeftColumnClass ?>"><span id="elh_business_sector_business_sector_name"><?php echo $business_sector_search->business_sector_name->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_business_sector_name" id="z_business_sector_name" value="LIKE">
</span>
		</label>
		<div class="<?php echo $business_sector_search->RightColumnClass ?>"><div <?php echo $business_sector_search->business_sector_name->cellAttributes() ?>>
			<span id="el_business_sector_business_sector_name" class="ew-search-field">
<input type="text" data-table="business_sector" data-field="x_business_sector_name" name="x_business_sector_name" id="x_business_sector_name" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($business_sector_search->business_sector_name->getPlaceHolder()) ?>" value="<?php echo $business_sector_search->business_sector_name->EditValue ?>"<?php echo $business_sector_search->business_sector_name->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($business_sector_search->business_sector_desc->Visible) { // business_sector_desc ?>
	<div id="r_business_sector_desc" class="form-group row">
		<label for="x_business_sector_desc" class="<?php echo $business_sector_search->LeftColumnClass ?>"><span id="elh_business_sector_business_sector_desc"><?php echo $business_sector_search->business_sector_desc->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_business_sector_desc" id="z_business_sector_desc" value="LIKE">
</span>
		</label>
		<div class="<?php echo $business_sector_search->RightColumnClass ?>"><div <?php echo $business_sector_search->business_sector_desc->cellAttributes() ?>>
			<span id="el_business_sector_business_sector_desc" class="ew-search-field">
<input type="text" data-table="business_sector" data-field="x_business_sector_desc" name="x_business_sector_desc" id="x_business_sector_desc" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($business_sector_search->business_sector_desc->getPlaceHolder()) ?>" value="<?php echo $business_sector_search->business_sector_desc->EditValue ?>"<?php echo $business_sector_search->business_sector_desc->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($business_sector_search->_USERID->Visible) { // USERID ?>
	<div id="r__USERID" class="form-group row">
		<label for="x__USERID" class="<?php echo $business_sector_search->LeftColumnClass ?>"><span id="elh_business_sector__USERID"><?php echo $business_sector_search->_USERID->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z__USERID" id="z__USERID" value="LIKE">
</span>
		</label>
		<div class="<?php echo $business_sector_search->RightColumnClass ?>"><div <?php echo $business_sector_search->_USERID->cellAttributes() ?>>
			<span id="el_business_sector__USERID" class="ew-search-field">
<input type="text" data-table="business_sector" data-field="x__USERID" name="x__USERID" id="x__USERID" size="30" maxlength="40" placeholder="<?php echo HtmlEncode($business_sector_search->_USERID->getPlaceHolder()) ?>" value="<?php echo $business_sector_search->_USERID->EditValue ?>"<?php echo $business_sector_search->_USERID->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($business_sector_search->SYSTEM_DATE->Visible) { // SYSTEM_DATE ?>
	<div id="r_SYSTEM_DATE" class="form-group row">
		<label for="x_SYSTEM_DATE" class="<?php echo $business_sector_search->LeftColumnClass ?>"><span id="elh_business_sector_SYSTEM_DATE"><?php echo $business_sector_search->SYSTEM_DATE->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_SYSTEM_DATE" id="z_SYSTEM_DATE" value="=">
</span>
		</label>
		<div class="<?php echo $business_sector_search->RightColumnClass ?>"><div <?php echo $business_sector_search->SYSTEM_DATE->cellAttributes() ?>>
			<span id="el_business_sector_SYSTEM_DATE" class="ew-search-field">
<input type="text" data-table="business_sector" data-field="x_SYSTEM_DATE" name="x_SYSTEM_DATE" id="x_SYSTEM_DATE" maxlength="19" placeholder="<?php echo HtmlEncode($business_sector_search->SYSTEM_DATE->getPlaceHolder()) ?>" value="<?php echo $business_sector_search->SYSTEM_DATE->EditValue ?>"<?php echo $business_sector_search->SYSTEM_DATE->editAttributes() ?>>
<?php if (!$business_sector_search->SYSTEM_DATE->ReadOnly && !$business_sector_search->SYSTEM_DATE->Disabled && !isset($business_sector_search->SYSTEM_DATE->EditAttrs["readonly"]) && !isset($business_sector_search->SYSTEM_DATE->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbusiness_sectorsearch", "datetimepicker"], function() {
	ew.createDateTimePicker("fbusiness_sectorsearch", "x_SYSTEM_DATE", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$business_sector_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $business_sector_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$business_sector_search->showPageFooter();
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
$business_sector_search->terminate();
?>