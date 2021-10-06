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
$lacct_search = new lacct_search();

// Run the page
$lacct_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lacct_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flacctsearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($lacct_search->IsModal) { ?>
	flacctsearch = currentAdvancedSearchForm = new ew.Form("flacctsearch", "search");
	<?php } else { ?>
	flacctsearch = currentForm = new ew.Form("flacctsearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	flacctsearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_LACode");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($lacct_search->LACode->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Code");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($lacct_search->Code->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Approved_Budget");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($lacct_search->Approved_Budget->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Budget");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($lacct_search->Budget->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Q1");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($lacct_search->Q1->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Q2");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($lacct_search->Q2->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Q3");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($lacct_search->Q3->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Q4");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($lacct_search->Q4->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Q1_Q4");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($lacct_search->Q1_Q4->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Percent");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($lacct_search->Percent->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_Balance");
		if (elm && !ew.checkNumber(elm.value))
			return this.onError(elm, "<?php echo JsEncode($lacct_search->Balance->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	flacctsearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	flacctsearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("flacctsearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $lacct_search->showPageHeader(); ?>
<?php
$lacct_search->showMessage();
?>
<form name="flacctsearch" id="flacctsearch" class="<?php echo $lacct_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lacct">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$lacct_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($lacct_search->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label for="x_LACode" class="<?php echo $lacct_search->LeftColumnClass ?>"><span id="elh_lacct_LACode"><?php echo $lacct_search->LACode->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_LACode" id="z_LACode" value="=">
</span>
		</label>
		<div class="<?php echo $lacct_search->RightColumnClass ?>"><div <?php echo $lacct_search->LACode->cellAttributes() ?>>
			<span id="el_lacct_LACode" class="ew-search-field">
<input type="text" data-table="lacct" data-field="x_LACode" name="x_LACode" id="x_LACode" size="30" placeholder="<?php echo HtmlEncode($lacct_search->LACode->getPlaceHolder()) ?>" value="<?php echo $lacct_search->LACode->EditValue ?>"<?php echo $lacct_search->LACode->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($lacct_search->Code->Visible) { // Code ?>
	<div id="r_Code" class="form-group row">
		<label for="x_Code" class="<?php echo $lacct_search->LeftColumnClass ?>"><span id="elh_lacct_Code"><?php echo $lacct_search->Code->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Code" id="z_Code" value="=">
</span>
		</label>
		<div class="<?php echo $lacct_search->RightColumnClass ?>"><div <?php echo $lacct_search->Code->cellAttributes() ?>>
			<span id="el_lacct_Code" class="ew-search-field">
<input type="text" data-table="lacct" data-field="x_Code" name="x_Code" id="x_Code" size="30" placeholder="<?php echo HtmlEncode($lacct_search->Code->getPlaceHolder()) ?>" value="<?php echo $lacct_search->Code->EditValue ?>"<?php echo $lacct_search->Code->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($lacct_search->Details->Visible) { // Details ?>
	<div id="r_Details" class="form-group row">
		<label for="x_Details" class="<?php echo $lacct_search->LeftColumnClass ?>"><span id="elh_lacct_Details"><?php echo $lacct_search->Details->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_Details" id="z_Details" value="LIKE">
</span>
		</label>
		<div class="<?php echo $lacct_search->RightColumnClass ?>"><div <?php echo $lacct_search->Details->cellAttributes() ?>>
			<span id="el_lacct_Details" class="ew-search-field">
<input type="text" data-table="lacct" data-field="x_Details" name="x_Details" id="x_Details" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($lacct_search->Details->getPlaceHolder()) ?>" value="<?php echo $lacct_search->Details->EditValue ?>"<?php echo $lacct_search->Details->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($lacct_search->Approved_Budget->Visible) { // Approved Budget ?>
	<div id="r_Approved_Budget" class="form-group row">
		<label for="x_Approved_Budget" class="<?php echo $lacct_search->LeftColumnClass ?>"><span id="elh_lacct_Approved_Budget"><?php echo $lacct_search->Approved_Budget->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Approved_Budget" id="z_Approved_Budget" value="=">
</span>
		</label>
		<div class="<?php echo $lacct_search->RightColumnClass ?>"><div <?php echo $lacct_search->Approved_Budget->cellAttributes() ?>>
			<span id="el_lacct_Approved_Budget" class="ew-search-field">
<input type="text" data-table="lacct" data-field="x_Approved_Budget" name="x_Approved_Budget" id="x_Approved_Budget" size="30" placeholder="<?php echo HtmlEncode($lacct_search->Approved_Budget->getPlaceHolder()) ?>" value="<?php echo $lacct_search->Approved_Budget->EditValue ?>"<?php echo $lacct_search->Approved_Budget->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($lacct_search->Budget->Visible) { // Budget ?>
	<div id="r_Budget" class="form-group row">
		<label for="x_Budget" class="<?php echo $lacct_search->LeftColumnClass ?>"><span id="elh_lacct_Budget"><?php echo $lacct_search->Budget->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Budget" id="z_Budget" value="=">
</span>
		</label>
		<div class="<?php echo $lacct_search->RightColumnClass ?>"><div <?php echo $lacct_search->Budget->cellAttributes() ?>>
			<span id="el_lacct_Budget" class="ew-search-field">
<input type="text" data-table="lacct" data-field="x_Budget" name="x_Budget" id="x_Budget" size="30" placeholder="<?php echo HtmlEncode($lacct_search->Budget->getPlaceHolder()) ?>" value="<?php echo $lacct_search->Budget->EditValue ?>"<?php echo $lacct_search->Budget->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($lacct_search->Q1->Visible) { // Q1 ?>
	<div id="r_Q1" class="form-group row">
		<label for="x_Q1" class="<?php echo $lacct_search->LeftColumnClass ?>"><span id="elh_lacct_Q1"><?php echo $lacct_search->Q1->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Q1" id="z_Q1" value="=">
</span>
		</label>
		<div class="<?php echo $lacct_search->RightColumnClass ?>"><div <?php echo $lacct_search->Q1->cellAttributes() ?>>
			<span id="el_lacct_Q1" class="ew-search-field">
<input type="text" data-table="lacct" data-field="x_Q1" name="x_Q1" id="x_Q1" size="30" placeholder="<?php echo HtmlEncode($lacct_search->Q1->getPlaceHolder()) ?>" value="<?php echo $lacct_search->Q1->EditValue ?>"<?php echo $lacct_search->Q1->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($lacct_search->Q2->Visible) { // Q2 ?>
	<div id="r_Q2" class="form-group row">
		<label for="x_Q2" class="<?php echo $lacct_search->LeftColumnClass ?>"><span id="elh_lacct_Q2"><?php echo $lacct_search->Q2->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Q2" id="z_Q2" value="=">
</span>
		</label>
		<div class="<?php echo $lacct_search->RightColumnClass ?>"><div <?php echo $lacct_search->Q2->cellAttributes() ?>>
			<span id="el_lacct_Q2" class="ew-search-field">
<input type="text" data-table="lacct" data-field="x_Q2" name="x_Q2" id="x_Q2" size="30" placeholder="<?php echo HtmlEncode($lacct_search->Q2->getPlaceHolder()) ?>" value="<?php echo $lacct_search->Q2->EditValue ?>"<?php echo $lacct_search->Q2->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($lacct_search->Q3->Visible) { // Q3 ?>
	<div id="r_Q3" class="form-group row">
		<label for="x_Q3" class="<?php echo $lacct_search->LeftColumnClass ?>"><span id="elh_lacct_Q3"><?php echo $lacct_search->Q3->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Q3" id="z_Q3" value="=">
</span>
		</label>
		<div class="<?php echo $lacct_search->RightColumnClass ?>"><div <?php echo $lacct_search->Q3->cellAttributes() ?>>
			<span id="el_lacct_Q3" class="ew-search-field">
<input type="text" data-table="lacct" data-field="x_Q3" name="x_Q3" id="x_Q3" size="30" placeholder="<?php echo HtmlEncode($lacct_search->Q3->getPlaceHolder()) ?>" value="<?php echo $lacct_search->Q3->EditValue ?>"<?php echo $lacct_search->Q3->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($lacct_search->Q4->Visible) { // Q4 ?>
	<div id="r_Q4" class="form-group row">
		<label for="x_Q4" class="<?php echo $lacct_search->LeftColumnClass ?>"><span id="elh_lacct_Q4"><?php echo $lacct_search->Q4->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Q4" id="z_Q4" value="=">
</span>
		</label>
		<div class="<?php echo $lacct_search->RightColumnClass ?>"><div <?php echo $lacct_search->Q4->cellAttributes() ?>>
			<span id="el_lacct_Q4" class="ew-search-field">
<input type="text" data-table="lacct" data-field="x_Q4" name="x_Q4" id="x_Q4" size="30" placeholder="<?php echo HtmlEncode($lacct_search->Q4->getPlaceHolder()) ?>" value="<?php echo $lacct_search->Q4->EditValue ?>"<?php echo $lacct_search->Q4->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($lacct_search->Q1_Q4->Visible) { // Q1-Q4 ?>
	<div id="r_Q1_Q4" class="form-group row">
		<label for="x_Q1_Q4" class="<?php echo $lacct_search->LeftColumnClass ?>"><span id="elh_lacct_Q1_Q4"><?php echo $lacct_search->Q1_Q4->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Q1_Q4" id="z_Q1_Q4" value="=">
</span>
		</label>
		<div class="<?php echo $lacct_search->RightColumnClass ?>"><div <?php echo $lacct_search->Q1_Q4->cellAttributes() ?>>
			<span id="el_lacct_Q1_Q4" class="ew-search-field">
<input type="text" data-table="lacct" data-field="x_Q1_Q4" name="x_Q1_Q4" id="x_Q1_Q4" size="30" placeholder="<?php echo HtmlEncode($lacct_search->Q1_Q4->getPlaceHolder()) ?>" value="<?php echo $lacct_search->Q1_Q4->EditValue ?>"<?php echo $lacct_search->Q1_Q4->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($lacct_search->Percent->Visible) { // Percent ?>
	<div id="r_Percent" class="form-group row">
		<label for="x_Percent" class="<?php echo $lacct_search->LeftColumnClass ?>"><span id="elh_lacct_Percent"><?php echo $lacct_search->Percent->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Percent" id="z_Percent" value="=">
</span>
		</label>
		<div class="<?php echo $lacct_search->RightColumnClass ?>"><div <?php echo $lacct_search->Percent->cellAttributes() ?>>
			<span id="el_lacct_Percent" class="ew-search-field">
<input type="text" data-table="lacct" data-field="x_Percent" name="x_Percent" id="x_Percent" size="30" placeholder="<?php echo HtmlEncode($lacct_search->Percent->getPlaceHolder()) ?>" value="<?php echo $lacct_search->Percent->EditValue ?>"<?php echo $lacct_search->Percent->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($lacct_search->Balance->Visible) { // Balance ?>
	<div id="r_Balance" class="form-group row">
		<label for="x_Balance" class="<?php echo $lacct_search->LeftColumnClass ?>"><span id="elh_lacct_Balance"><?php echo $lacct_search->Balance->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_Balance" id="z_Balance" value="=">
</span>
		</label>
		<div class="<?php echo $lacct_search->RightColumnClass ?>"><div <?php echo $lacct_search->Balance->cellAttributes() ?>>
			<span id="el_lacct_Balance" class="ew-search-field">
<input type="text" data-table="lacct" data-field="x_Balance" name="x_Balance" id="x_Balance" size="30" placeholder="<?php echo HtmlEncode($lacct_search->Balance->getPlaceHolder()) ?>" value="<?php echo $lacct_search->Balance->EditValue ?>"<?php echo $lacct_search->Balance->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$lacct_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $lacct_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$lacct_search->showPageFooter();
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
$lacct_search->terminate();
?>