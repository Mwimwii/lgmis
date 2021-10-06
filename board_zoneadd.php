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
$board_zone_add = new board_zone_add();

// Run the page
$board_zone_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$board_zone_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fboard_zoneadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fboard_zoneadd = currentForm = new ew.Form("fboard_zoneadd", "add");

	// Validate form
	fboard_zoneadd.validate = function() {
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
			<?php if ($board_zone_add->BoardZoneDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardZoneDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_zone_add->BoardZoneDesc->caption(), $board_zone_add->BoardZoneDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($board_zone_add->IndividualCharge->Required) { ?>
				elm = this.getElements("x" + infix + "_IndividualCharge");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_zone_add->IndividualCharge->caption(), $board_zone_add->IndividualCharge->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IndividualCharge");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($board_zone_add->IndividualCharge->errorMessage()) ?>");
			<?php if ($board_zone_add->AgentCharge->Required) { ?>
				elm = this.getElements("x" + infix + "_AgentCharge");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_zone_add->AgentCharge->caption(), $board_zone_add->AgentCharge->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AgentCharge");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($board_zone_add->AgentCharge->errorMessage()) ?>");
			<?php if ($board_zone_add->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_zone_add->PeriodType->caption(), $board_zone_add->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($board_zone_add->BoardType->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_zone_add->BoardType->caption(), $board_zone_add->BoardType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($board_zone_add->BoardType->errorMessage()) ?>");

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
	fboard_zoneadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fboard_zoneadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fboard_zoneadd.lists["x_PeriodType"] = <?php echo $board_zone_add->PeriodType->Lookup->toClientList($board_zone_add) ?>;
	fboard_zoneadd.lists["x_PeriodType"].options = <?php echo JsonEncode($board_zone_add->PeriodType->lookupOptions()) ?>;
	loadjs.done("fboard_zoneadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $board_zone_add->showPageHeader(); ?>
<?php
$board_zone_add->showMessage();
?>
<form name="fboard_zoneadd" id="fboard_zoneadd" class="<?php echo $board_zone_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="board_zone">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$board_zone_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($board_zone_add->BoardZoneDesc->Visible) { // BoardZoneDesc ?>
	<div id="r_BoardZoneDesc" class="form-group row">
		<label id="elh_board_zone_BoardZoneDesc" for="x_BoardZoneDesc" class="<?php echo $board_zone_add->LeftColumnClass ?>"><?php echo $board_zone_add->BoardZoneDesc->caption() ?><?php echo $board_zone_add->BoardZoneDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_zone_add->RightColumnClass ?>"><div <?php echo $board_zone_add->BoardZoneDesc->cellAttributes() ?>>
<span id="el_board_zone_BoardZoneDesc">
<input type="text" data-table="board_zone" data-field="x_BoardZoneDesc" name="x_BoardZoneDesc" id="x_BoardZoneDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($board_zone_add->BoardZoneDesc->getPlaceHolder()) ?>" value="<?php echo $board_zone_add->BoardZoneDesc->EditValue ?>"<?php echo $board_zone_add->BoardZoneDesc->editAttributes() ?>>
</span>
<?php echo $board_zone_add->BoardZoneDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($board_zone_add->IndividualCharge->Visible) { // IndividualCharge ?>
	<div id="r_IndividualCharge" class="form-group row">
		<label id="elh_board_zone_IndividualCharge" for="x_IndividualCharge" class="<?php echo $board_zone_add->LeftColumnClass ?>"><?php echo $board_zone_add->IndividualCharge->caption() ?><?php echo $board_zone_add->IndividualCharge->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_zone_add->RightColumnClass ?>"><div <?php echo $board_zone_add->IndividualCharge->cellAttributes() ?>>
<span id="el_board_zone_IndividualCharge">
<input type="text" data-table="board_zone" data-field="x_IndividualCharge" name="x_IndividualCharge" id="x_IndividualCharge" size="30" placeholder="<?php echo HtmlEncode($board_zone_add->IndividualCharge->getPlaceHolder()) ?>" value="<?php echo $board_zone_add->IndividualCharge->EditValue ?>"<?php echo $board_zone_add->IndividualCharge->editAttributes() ?>>
</span>
<?php echo $board_zone_add->IndividualCharge->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($board_zone_add->AgentCharge->Visible) { // AgentCharge ?>
	<div id="r_AgentCharge" class="form-group row">
		<label id="elh_board_zone_AgentCharge" for="x_AgentCharge" class="<?php echo $board_zone_add->LeftColumnClass ?>"><?php echo $board_zone_add->AgentCharge->caption() ?><?php echo $board_zone_add->AgentCharge->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_zone_add->RightColumnClass ?>"><div <?php echo $board_zone_add->AgentCharge->cellAttributes() ?>>
<span id="el_board_zone_AgentCharge">
<input type="text" data-table="board_zone" data-field="x_AgentCharge" name="x_AgentCharge" id="x_AgentCharge" size="30" placeholder="<?php echo HtmlEncode($board_zone_add->AgentCharge->getPlaceHolder()) ?>" value="<?php echo $board_zone_add->AgentCharge->EditValue ?>"<?php echo $board_zone_add->AgentCharge->editAttributes() ?>>
</span>
<?php echo $board_zone_add->AgentCharge->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($board_zone_add->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_board_zone_PeriodType" for="x_PeriodType" class="<?php echo $board_zone_add->LeftColumnClass ?>"><?php echo $board_zone_add->PeriodType->caption() ?><?php echo $board_zone_add->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_zone_add->RightColumnClass ?>"><div <?php echo $board_zone_add->PeriodType->cellAttributes() ?>>
<span id="el_board_zone_PeriodType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="board_zone" data-field="x_PeriodType" data-value-separator="<?php echo $board_zone_add->PeriodType->displayValueSeparatorAttribute() ?>" id="x_PeriodType" name="x_PeriodType"<?php echo $board_zone_add->PeriodType->editAttributes() ?>>
			<?php echo $board_zone_add->PeriodType->selectOptionListHtml("x_PeriodType") ?>
		</select>
</div>
<?php echo $board_zone_add->PeriodType->Lookup->getParamTag($board_zone_add, "p_x_PeriodType") ?>
</span>
<?php echo $board_zone_add->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($board_zone_add->BoardType->Visible) { // BoardType ?>
	<div id="r_BoardType" class="form-group row">
		<label id="elh_board_zone_BoardType" for="x_BoardType" class="<?php echo $board_zone_add->LeftColumnClass ?>"><?php echo $board_zone_add->BoardType->caption() ?><?php echo $board_zone_add->BoardType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_zone_add->RightColumnClass ?>"><div <?php echo $board_zone_add->BoardType->cellAttributes() ?>>
<span id="el_board_zone_BoardType">
<input type="text" data-table="board_zone" data-field="x_BoardType" name="x_BoardType" id="x_BoardType" size="30" placeholder="<?php echo HtmlEncode($board_zone_add->BoardType->getPlaceHolder()) ?>" value="<?php echo $board_zone_add->BoardType->EditValue ?>"<?php echo $board_zone_add->BoardType->editAttributes() ?>>
</span>
<?php echo $board_zone_add->BoardType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$board_zone_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $board_zone_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $board_zone_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$board_zone_add->showPageFooter();
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
$board_zone_add->terminate();
?>