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
$action_type_search = new action_type_search();

// Run the page
$action_type_search->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$action_type_search->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var faction_typesearch, currentPageID;
loadjs.ready("head", function() {

	// Form object for search
	<?php if ($action_type_search->IsModal) { ?>
	faction_typesearch = currentAdvancedSearchForm = new ew.Form("faction_typesearch", "search");
	<?php } else { ?>
	faction_typesearch = currentForm = new ew.Form("faction_typesearch", "search");
	<?php } ?>
	currentPageID = ew.PAGE_ID = "search";

	// Validate function for search
	faction_typesearch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	faction_typesearch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	faction_typesearch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("faction_typesearch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $action_type_search->showPageHeader(); ?>
<?php
$action_type_search->showMessage();
?>
<form name="faction_typesearch" id="faction_typesearch" class="<?php echo $action_type_search->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="action_type">
<input type="hidden" name="action" id="action" value="search">
<input type="hidden" name="modal" value="<?php echo (int)$action_type_search->IsModal ?>">
<div class="ew-search-div"><!-- page* -->
<?php if ($action_type_search->ActionType->Visible) { // ActionType ?>
	<div id="r_ActionType" class="form-group row">
		<label for="x_ActionType" class="<?php echo $action_type_search->LeftColumnClass ?>"><span id="elh_action_type_ActionType"><?php echo $action_type_search->ActionType->caption() ?></span>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_ActionType" id="z_ActionType" value="LIKE">
</span>
		</label>
		<div class="<?php echo $action_type_search->RightColumnClass ?>"><div <?php echo $action_type_search->ActionType->cellAttributes() ?>>
			<span id="el_action_type_ActionType" class="ew-search-field">
<input type="text" data-table="action_type" data-field="x_ActionType" name="x_ActionType" id="x_ActionType" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($action_type_search->ActionType->getPlaceHolder()) ?>" value="<?php echo $action_type_search->ActionType->EditValue ?>"<?php echo $action_type_search->ActionType->editAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$action_type_search->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $action_type_search->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("Search") ?></button>
<button class="btn btn-default ew-btn" name="btn-reset" id="btn-reset" type="button" onclick="ew.clearForm(this.form);"><?php echo $Language->phrase("Reset") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$action_type_search->showPageFooter();
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
$action_type_search->terminate();
?>