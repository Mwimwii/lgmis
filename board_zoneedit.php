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
$board_zone_edit = new board_zone_edit();

// Run the page
$board_zone_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$board_zone_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fboard_zoneedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fboard_zoneedit = currentForm = new ew.Form("fboard_zoneedit", "edit");

	// Validate form
	fboard_zoneedit.validate = function() {
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
			<?php if ($board_zone_edit->BoardZone->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardZone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_zone_edit->BoardZone->caption(), $board_zone_edit->BoardZone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($board_zone_edit->BoardZoneDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardZoneDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_zone_edit->BoardZoneDesc->caption(), $board_zone_edit->BoardZoneDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($board_zone_edit->IndividualCharge->Required) { ?>
				elm = this.getElements("x" + infix + "_IndividualCharge");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_zone_edit->IndividualCharge->caption(), $board_zone_edit->IndividualCharge->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IndividualCharge");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($board_zone_edit->IndividualCharge->errorMessage()) ?>");
			<?php if ($board_zone_edit->AgentCharge->Required) { ?>
				elm = this.getElements("x" + infix + "_AgentCharge");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_zone_edit->AgentCharge->caption(), $board_zone_edit->AgentCharge->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AgentCharge");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($board_zone_edit->AgentCharge->errorMessage()) ?>");
			<?php if ($board_zone_edit->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_zone_edit->PeriodType->caption(), $board_zone_edit->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($board_zone_edit->BoardType->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $board_zone_edit->BoardType->caption(), $board_zone_edit->BoardType->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardType");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($board_zone_edit->BoardType->errorMessage()) ?>");

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
	fboard_zoneedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fboard_zoneedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fboard_zoneedit.lists["x_PeriodType"] = <?php echo $board_zone_edit->PeriodType->Lookup->toClientList($board_zone_edit) ?>;
	fboard_zoneedit.lists["x_PeriodType"].options = <?php echo JsonEncode($board_zone_edit->PeriodType->lookupOptions()) ?>;
	loadjs.done("fboard_zoneedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $board_zone_edit->showPageHeader(); ?>
<?php
$board_zone_edit->showMessage();
?>
<?php if (!$board_zone_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $board_zone_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fboard_zoneedit" id="fboard_zoneedit" class="<?php echo $board_zone_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="board_zone">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$board_zone_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($board_zone_edit->BoardZone->Visible) { // BoardZone ?>
	<div id="r_BoardZone" class="form-group row">
		<label id="elh_board_zone_BoardZone" class="<?php echo $board_zone_edit->LeftColumnClass ?>"><?php echo $board_zone_edit->BoardZone->caption() ?><?php echo $board_zone_edit->BoardZone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_zone_edit->RightColumnClass ?>"><div <?php echo $board_zone_edit->BoardZone->cellAttributes() ?>>
<span id="el_board_zone_BoardZone">
<span<?php echo $board_zone_edit->BoardZone->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($board_zone_edit->BoardZone->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="board_zone" data-field="x_BoardZone" name="x_BoardZone" id="x_BoardZone" value="<?php echo HtmlEncode($board_zone_edit->BoardZone->CurrentValue) ?>">
<?php echo $board_zone_edit->BoardZone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($board_zone_edit->BoardZoneDesc->Visible) { // BoardZoneDesc ?>
	<div id="r_BoardZoneDesc" class="form-group row">
		<label id="elh_board_zone_BoardZoneDesc" for="x_BoardZoneDesc" class="<?php echo $board_zone_edit->LeftColumnClass ?>"><?php echo $board_zone_edit->BoardZoneDesc->caption() ?><?php echo $board_zone_edit->BoardZoneDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_zone_edit->RightColumnClass ?>"><div <?php echo $board_zone_edit->BoardZoneDesc->cellAttributes() ?>>
<span id="el_board_zone_BoardZoneDesc">
<input type="text" data-table="board_zone" data-field="x_BoardZoneDesc" name="x_BoardZoneDesc" id="x_BoardZoneDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($board_zone_edit->BoardZoneDesc->getPlaceHolder()) ?>" value="<?php echo $board_zone_edit->BoardZoneDesc->EditValue ?>"<?php echo $board_zone_edit->BoardZoneDesc->editAttributes() ?>>
</span>
<?php echo $board_zone_edit->BoardZoneDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($board_zone_edit->IndividualCharge->Visible) { // IndividualCharge ?>
	<div id="r_IndividualCharge" class="form-group row">
		<label id="elh_board_zone_IndividualCharge" for="x_IndividualCharge" class="<?php echo $board_zone_edit->LeftColumnClass ?>"><?php echo $board_zone_edit->IndividualCharge->caption() ?><?php echo $board_zone_edit->IndividualCharge->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_zone_edit->RightColumnClass ?>"><div <?php echo $board_zone_edit->IndividualCharge->cellAttributes() ?>>
<span id="el_board_zone_IndividualCharge">
<input type="text" data-table="board_zone" data-field="x_IndividualCharge" name="x_IndividualCharge" id="x_IndividualCharge" size="30" placeholder="<?php echo HtmlEncode($board_zone_edit->IndividualCharge->getPlaceHolder()) ?>" value="<?php echo $board_zone_edit->IndividualCharge->EditValue ?>"<?php echo $board_zone_edit->IndividualCharge->editAttributes() ?>>
</span>
<?php echo $board_zone_edit->IndividualCharge->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($board_zone_edit->AgentCharge->Visible) { // AgentCharge ?>
	<div id="r_AgentCharge" class="form-group row">
		<label id="elh_board_zone_AgentCharge" for="x_AgentCharge" class="<?php echo $board_zone_edit->LeftColumnClass ?>"><?php echo $board_zone_edit->AgentCharge->caption() ?><?php echo $board_zone_edit->AgentCharge->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_zone_edit->RightColumnClass ?>"><div <?php echo $board_zone_edit->AgentCharge->cellAttributes() ?>>
<span id="el_board_zone_AgentCharge">
<input type="text" data-table="board_zone" data-field="x_AgentCharge" name="x_AgentCharge" id="x_AgentCharge" size="30" placeholder="<?php echo HtmlEncode($board_zone_edit->AgentCharge->getPlaceHolder()) ?>" value="<?php echo $board_zone_edit->AgentCharge->EditValue ?>"<?php echo $board_zone_edit->AgentCharge->editAttributes() ?>>
</span>
<?php echo $board_zone_edit->AgentCharge->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($board_zone_edit->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_board_zone_PeriodType" for="x_PeriodType" class="<?php echo $board_zone_edit->LeftColumnClass ?>"><?php echo $board_zone_edit->PeriodType->caption() ?><?php echo $board_zone_edit->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_zone_edit->RightColumnClass ?>"><div <?php echo $board_zone_edit->PeriodType->cellAttributes() ?>>
<span id="el_board_zone_PeriodType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="board_zone" data-field="x_PeriodType" data-value-separator="<?php echo $board_zone_edit->PeriodType->displayValueSeparatorAttribute() ?>" id="x_PeriodType" name="x_PeriodType"<?php echo $board_zone_edit->PeriodType->editAttributes() ?>>
			<?php echo $board_zone_edit->PeriodType->selectOptionListHtml("x_PeriodType") ?>
		</select>
</div>
<?php echo $board_zone_edit->PeriodType->Lookup->getParamTag($board_zone_edit, "p_x_PeriodType") ?>
</span>
<?php echo $board_zone_edit->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($board_zone_edit->BoardType->Visible) { // BoardType ?>
	<div id="r_BoardType" class="form-group row">
		<label id="elh_board_zone_BoardType" for="x_BoardType" class="<?php echo $board_zone_edit->LeftColumnClass ?>"><?php echo $board_zone_edit->BoardType->caption() ?><?php echo $board_zone_edit->BoardType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $board_zone_edit->RightColumnClass ?>"><div <?php echo $board_zone_edit->BoardType->cellAttributes() ?>>
<span id="el_board_zone_BoardType">
<input type="text" data-table="board_zone" data-field="x_BoardType" name="x_BoardType" id="x_BoardType" size="30" placeholder="<?php echo HtmlEncode($board_zone_edit->BoardType->getPlaceHolder()) ?>" value="<?php echo $board_zone_edit->BoardType->EditValue ?>"<?php echo $board_zone_edit->BoardType->editAttributes() ?>>
</span>
<?php echo $board_zone_edit->BoardType->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$board_zone_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $board_zone_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $board_zone_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$board_zone_edit->IsModal) { ?>
<?php echo $board_zone_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$board_zone_edit->showPageFooter();
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
$board_zone_edit->terminate();
?>