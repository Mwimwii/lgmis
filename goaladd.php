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
$goal_add = new goal_add();

// Run the page
$goal_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$goal_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgoaladd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fgoaladd = currentForm = new ew.Form("fgoaladd", "add");

	// Validate form
	fgoaladd.validate = function() {
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
			<?php if ($goal_add->StrategicObjectiveCode->Required) { ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $goal_add->StrategicObjectiveCode->caption(), $goal_add->StrategicObjectiveCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StrategicObjectiveCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($goal_add->StrategicObjectiveCode->errorMessage()) ?>");
			<?php if ($goal_add->GoalNo->Required) { ?>
				elm = this.getElements("x" + infix + "_GoalNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $goal_add->GoalNo->caption(), $goal_add->GoalNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_GoalNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($goal_add->GoalNo->errorMessage()) ?>");
			<?php if ($goal_add->GoalName->Required) { ?>
				elm = this.getElements("x" + infix + "_GoalName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $goal_add->GoalName->caption(), $goal_add->GoalName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($goal_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $goal_add->LACode->caption(), $goal_add->LACode->RequiredErrorMessage)) ?>");
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
	fgoaladd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgoaladd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgoaladd.lists["x_LACode"] = <?php echo $goal_add->LACode->Lookup->toClientList($goal_add) ?>;
	fgoaladd.lists["x_LACode"].options = <?php echo JsonEncode($goal_add->LACode->lookupOptions()) ?>;
	fgoaladd.autoSuggests["x_LACode"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgoaladd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $goal_add->showPageHeader(); ?>
<?php
$goal_add->showMessage();
?>
<form name="fgoaladd" id="fgoaladd" class="<?php echo $goal_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="goal">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$goal_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($goal_add->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<div id="r_StrategicObjectiveCode" class="form-group row">
		<label id="elh_goal_StrategicObjectiveCode" for="x_StrategicObjectiveCode" class="<?php echo $goal_add->LeftColumnClass ?>"><?php echo $goal_add->StrategicObjectiveCode->caption() ?><?php echo $goal_add->StrategicObjectiveCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $goal_add->RightColumnClass ?>"><div <?php echo $goal_add->StrategicObjectiveCode->cellAttributes() ?>>
<span id="el_goal_StrategicObjectiveCode">
<input type="text" data-table="goal" data-field="x_StrategicObjectiveCode" name="x_StrategicObjectiveCode" id="x_StrategicObjectiveCode" size="30" placeholder="<?php echo HtmlEncode($goal_add->StrategicObjectiveCode->getPlaceHolder()) ?>" value="<?php echo $goal_add->StrategicObjectiveCode->EditValue ?>"<?php echo $goal_add->StrategicObjectiveCode->editAttributes() ?>>
</span>
<?php echo $goal_add->StrategicObjectiveCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($goal_add->GoalNo->Visible) { // GoalNo ?>
	<div id="r_GoalNo" class="form-group row">
		<label id="elh_goal_GoalNo" for="x_GoalNo" class="<?php echo $goal_add->LeftColumnClass ?>"><?php echo $goal_add->GoalNo->caption() ?><?php echo $goal_add->GoalNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $goal_add->RightColumnClass ?>"><div <?php echo $goal_add->GoalNo->cellAttributes() ?>>
<span id="el_goal_GoalNo">
<input type="text" data-table="goal" data-field="x_GoalNo" name="x_GoalNo" id="x_GoalNo" placeholder="<?php echo HtmlEncode($goal_add->GoalNo->getPlaceHolder()) ?>" value="<?php echo $goal_add->GoalNo->EditValue ?>"<?php echo $goal_add->GoalNo->editAttributes() ?>>
</span>
<?php echo $goal_add->GoalNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($goal_add->GoalName->Visible) { // GoalName ?>
	<div id="r_GoalName" class="form-group row">
		<label id="elh_goal_GoalName" for="x_GoalName" class="<?php echo $goal_add->LeftColumnClass ?>"><?php echo $goal_add->GoalName->caption() ?><?php echo $goal_add->GoalName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $goal_add->RightColumnClass ?>"><div <?php echo $goal_add->GoalName->cellAttributes() ?>>
<span id="el_goal_GoalName">
<input type="text" data-table="goal" data-field="x_GoalName" name="x_GoalName" id="x_GoalName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($goal_add->GoalName->getPlaceHolder()) ?>" value="<?php echo $goal_add->GoalName->EditValue ?>"<?php echo $goal_add->GoalName->editAttributes() ?>>
</span>
<?php echo $goal_add->GoalName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($goal_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_goal_LACode" class="<?php echo $goal_add->LeftColumnClass ?>"><?php echo $goal_add->LACode->caption() ?><?php echo $goal_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $goal_add->RightColumnClass ?>"><div <?php echo $goal_add->LACode->cellAttributes() ?>>
<span id="el_goal_LACode">
<?php
$onchange = $goal_add->LACode->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$goal_add->LACode->EditAttrs["onchange"] = "";
?>
<span id="as_x_LACode">
	<input type="text" class="form-control" name="sv_x_LACode" id="sv_x_LACode" value="<?php echo RemoveHtml($goal_add->LACode->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($goal_add->LACode->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($goal_add->LACode->getPlaceHolder()) ?>"<?php echo $goal_add->LACode->editAttributes() ?>>
</span>
<input type="hidden" data-table="goal" data-field="x_LACode" data-value-separator="<?php echo $goal_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo HtmlEncode($goal_add->LACode->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgoaladd"], function() {
	fgoaladd.createAutoSuggest({"id":"x_LACode","forceSelect":false});
});
</script>
<?php echo $goal_add->LACode->Lookup->getParamTag($goal_add, "p_x_LACode") ?>
</span>
<?php echo $goal_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$goal_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $goal_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $goal_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$goal_add->showPageFooter();
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
$goal_add->terminate();
?>