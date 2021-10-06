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
$time_measure_add = new time_measure_add();

// Run the page
$time_measure_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$time_measure_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var ftime_measureadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	ftime_measureadd = currentForm = new ew.Form("ftime_measureadd", "add");

	// Validate form
	ftime_measureadd.validate = function() {
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
			<?php if ($time_measure_add->Unit_of_measure->Required) { ?>
				elm = this.getElements("x" + infix + "_Unit_of_measure");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $time_measure_add->Unit_of_measure->caption(), $time_measure_add->Unit_of_measure->RequiredErrorMessage)) ?>");
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
	ftime_measureadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	ftime_measureadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("ftime_measureadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $time_measure_add->showPageHeader(); ?>
<?php
$time_measure_add->showMessage();
?>
<form name="ftime_measureadd" id="ftime_measureadd" class="<?php echo $time_measure_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="time_measure">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$time_measure_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($time_measure_add->Unit_of_measure->Visible) { // Unit_of_measure ?>
	<div id="r_Unit_of_measure" class="form-group row">
		<label id="elh_time_measure_Unit_of_measure" for="x_Unit_of_measure" class="<?php echo $time_measure_add->LeftColumnClass ?>"><?php echo $time_measure_add->Unit_of_measure->caption() ?><?php echo $time_measure_add->Unit_of_measure->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $time_measure_add->RightColumnClass ?>"><div <?php echo $time_measure_add->Unit_of_measure->cellAttributes() ?>>
<span id="el_time_measure_Unit_of_measure">
<input type="text" data-table="time_measure" data-field="x_Unit_of_measure" name="x_Unit_of_measure" id="x_Unit_of_measure" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($time_measure_add->Unit_of_measure->getPlaceHolder()) ?>" value="<?php echo $time_measure_add->Unit_of_measure->EditValue ?>"<?php echo $time_measure_add->Unit_of_measure->editAttributes() ?>>
</span>
<?php echo $time_measure_add->Unit_of_measure->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$time_measure_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $time_measure_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $time_measure_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$time_measure_add->showPageFooter();
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
$time_measure_add->terminate();
?>