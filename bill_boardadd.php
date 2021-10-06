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
$bill_board_add = new bill_board_add();

// Run the page
$bill_board_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbill_boardadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbill_boardadd = currentForm = new ew.Form("fbill_boardadd", "add");

	// Validate form
	fbill_boardadd.validate = function() {
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
			<?php if ($bill_board_add->BoardStandNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardStandNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->BoardStandNo->caption(), $bill_board_add->BoardStandNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_add->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->ClientSerNo->caption(), $bill_board_add->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_add->ClientSerNo->errorMessage()) ?>");
			<?php if ($bill_board_add->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->ClientID->caption(), $bill_board_add->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_add->BoardLength->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardLength");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->BoardLength->caption(), $bill_board_add->BoardLength->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardLength");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_add->BoardLength->errorMessage()) ?>");
			<?php if ($bill_board_add->BoardWidth->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardWidth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->BoardWidth->caption(), $bill_board_add->BoardWidth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardWidth");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_add->BoardWidth->errorMessage()) ?>");
			<?php if ($bill_board_add->BoardSize->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardSize");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->BoardSize->caption(), $bill_board_add->BoardSize->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardSize");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_add->BoardSize->errorMessage()) ?>");
			<?php if ($bill_board_add->BoardType->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->BoardType->caption(), $bill_board_add->BoardType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_add->BoardLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->BoardLocation->caption(), $bill_board_add->BoardLocation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_add->BoardStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->BoardStatus->caption(), $bill_board_add->BoardStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_add->BoardStatus->errorMessage()) ?>");
			<?php if ($bill_board_add->ExemptCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->ExemptCode->caption(), $bill_board_add->ExemptCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_add->ExemptCode->errorMessage()) ?>");
			<?php if ($bill_board_add->StreetAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_StreetAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->StreetAddress->caption(), $bill_board_add->StreetAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_add->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->Longitude->caption(), $bill_board_add->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_add->Longitude->errorMessage()) ?>");
			<?php if ($bill_board_add->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->Latitude->caption(), $bill_board_add->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_add->Latitude->errorMessage()) ?>");
			<?php if ($bill_board_add->Incumberance->Required) { ?>
				elm = this.getElements("x" + infix + "_Incumberance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->Incumberance->caption(), $bill_board_add->Incumberance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_add->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->StartDate->caption(), $bill_board_add->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_add->StartDate->errorMessage()) ?>");
			<?php if ($bill_board_add->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_add->EndDate->caption(), $bill_board_add->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_add->EndDate->errorMessage()) ?>");

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
	fbill_boardadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbill_boardadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbill_boardadd.lists["x_ClientSerNo"] = <?php echo $bill_board_add->ClientSerNo->Lookup->toClientList($bill_board_add) ?>;
	fbill_boardadd.lists["x_ClientSerNo"].options = <?php echo JsonEncode($bill_board_add->ClientSerNo->lookupOptions()) ?>;
	fbill_boardadd.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbill_boardadd.lists["x_BoardType"] = <?php echo $bill_board_add->BoardType->Lookup->toClientList($bill_board_add) ?>;
	fbill_boardadd.lists["x_BoardType"].options = <?php echo JsonEncode($bill_board_add->BoardType->lookupOptions()) ?>;
	loadjs.done("fbill_boardadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bill_board_add->showPageHeader(); ?>
<?php
$bill_board_add->showMessage();
?>
<form name="fbill_boardadd" id="fbill_boardadd" class="<?php echo $bill_board_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill_board">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$bill_board_add->IsModal ?>">
<?php if ($bill_board->getCurrentMasterTable() == "client") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="client">
<input type="hidden" name="fk_ClientSerNo" value="<?php echo HtmlEncode($bill_board_add->ClientSerNo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($bill_board_add->BoardStandNo->Visible) { // BoardStandNo ?>
	<div id="r_BoardStandNo" class="form-group row">
		<label id="elh_bill_board_BoardStandNo" for="x_BoardStandNo" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->BoardStandNo->caption() ?><?php echo $bill_board_add->BoardStandNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->BoardStandNo->cellAttributes() ?>>
<span id="el_bill_board_BoardStandNo">
<input type="text" data-table="bill_board" data-field="x_BoardStandNo" name="x_BoardStandNo" id="x_BoardStandNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_add->BoardStandNo->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->BoardStandNo->EditValue ?>"<?php echo $bill_board_add->BoardStandNo->editAttributes() ?>>
</span>
<?php echo $bill_board_add->BoardStandNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label id="elh_bill_board_ClientSerNo" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->ClientSerNo->caption() ?><?php echo $bill_board_add->ClientSerNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->ClientSerNo->cellAttributes() ?>>
<?php if ($bill_board_add->ClientSerNo->getSessionValue() != "") { ?>
<span id="el_bill_board_ClientSerNo">
<span<?php echo $bill_board_add->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_add->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ClientSerNo" name="x_ClientSerNo" value="<?php echo HtmlEncode($bill_board_add->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_bill_board_ClientSerNo">
<?php
$onchange = $bill_board_add->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_board_add->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($bill_board_add->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_board_add->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_board_add->ClientSerNo->getPlaceHolder()) ?>"<?php echo $bill_board_add->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_board_add->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientSerNo',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_board_add->ClientSerNo->ReadOnly || $bill_board_add->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill_board" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_board_add->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($bill_board_add->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbill_boardadd"], function() {
	fbill_boardadd.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":false});
});
</script>
<?php echo $bill_board_add->ClientSerNo->Lookup->getParamTag($bill_board_add, "p_x_ClientSerNo") ?>
</span>
<?php } ?>
<?php echo $bill_board_add->ClientSerNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_bill_board_ClientID" for="x_ClientID" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->ClientID->caption() ?><?php echo $bill_board_add->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->ClientID->cellAttributes() ?>>
<span id="el_bill_board_ClientID">
<input type="text" data-table="bill_board" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bill_board_add->ClientID->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->ClientID->EditValue ?>"<?php echo $bill_board_add->ClientID->editAttributes() ?>>
</span>
<?php echo $bill_board_add->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->BoardLength->Visible) { // BoardLength ?>
	<div id="r_BoardLength" class="form-group row">
		<label id="elh_bill_board_BoardLength" for="x_BoardLength" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->BoardLength->caption() ?><?php echo $bill_board_add->BoardLength->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->BoardLength->cellAttributes() ?>>
<span id="el_bill_board_BoardLength">
<input type="text" data-table="bill_board" data-field="x_BoardLength" name="x_BoardLength" id="x_BoardLength" size="30" placeholder="<?php echo HtmlEncode($bill_board_add->BoardLength->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->BoardLength->EditValue ?>"<?php echo $bill_board_add->BoardLength->editAttributes() ?>>
</span>
<?php echo $bill_board_add->BoardLength->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->BoardWidth->Visible) { // BoardWidth ?>
	<div id="r_BoardWidth" class="form-group row">
		<label id="elh_bill_board_BoardWidth" for="x_BoardWidth" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->BoardWidth->caption() ?><?php echo $bill_board_add->BoardWidth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->BoardWidth->cellAttributes() ?>>
<span id="el_bill_board_BoardWidth">
<input type="text" data-table="bill_board" data-field="x_BoardWidth" name="x_BoardWidth" id="x_BoardWidth" size="30" placeholder="<?php echo HtmlEncode($bill_board_add->BoardWidth->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->BoardWidth->EditValue ?>"<?php echo $bill_board_add->BoardWidth->editAttributes() ?>>
</span>
<?php echo $bill_board_add->BoardWidth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->BoardSize->Visible) { // BoardSize ?>
	<div id="r_BoardSize" class="form-group row">
		<label id="elh_bill_board_BoardSize" for="x_BoardSize" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->BoardSize->caption() ?><?php echo $bill_board_add->BoardSize->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->BoardSize->cellAttributes() ?>>
<span id="el_bill_board_BoardSize">
<input type="text" data-table="bill_board" data-field="x_BoardSize" name="x_BoardSize" id="x_BoardSize" size="30" placeholder="<?php echo HtmlEncode($bill_board_add->BoardSize->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->BoardSize->EditValue ?>"<?php echo $bill_board_add->BoardSize->editAttributes() ?>>
</span>
<?php echo $bill_board_add->BoardSize->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->BoardType->Visible) { // BoardType ?>
	<div id="r_BoardType" class="form-group row">
		<label id="elh_bill_board_BoardType" for="x_BoardType" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->BoardType->caption() ?><?php echo $bill_board_add->BoardType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->BoardType->cellAttributes() ?>>
<span id="el_bill_board_BoardType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="bill_board" data-field="x_BoardType" data-value-separator="<?php echo $bill_board_add->BoardType->displayValueSeparatorAttribute() ?>" id="x_BoardType" name="x_BoardType"<?php echo $bill_board_add->BoardType->editAttributes() ?>>
			<?php echo $bill_board_add->BoardType->selectOptionListHtml("x_BoardType") ?>
		</select>
</div>
<?php echo $bill_board_add->BoardType->Lookup->getParamTag($bill_board_add, "p_x_BoardType") ?>
</span>
<?php echo $bill_board_add->BoardType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->BoardLocation->Visible) { // BoardLocation ?>
	<div id="r_BoardLocation" class="form-group row">
		<label id="elh_bill_board_BoardLocation" for="x_BoardLocation" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->BoardLocation->caption() ?><?php echo $bill_board_add->BoardLocation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->BoardLocation->cellAttributes() ?>>
<span id="el_bill_board_BoardLocation">
<input type="text" data-table="bill_board" data-field="x_BoardLocation" name="x_BoardLocation" id="x_BoardLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_add->BoardLocation->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->BoardLocation->EditValue ?>"<?php echo $bill_board_add->BoardLocation->editAttributes() ?>>
</span>
<?php echo $bill_board_add->BoardLocation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->BoardStatus->Visible) { // BoardStatus ?>
	<div id="r_BoardStatus" class="form-group row">
		<label id="elh_bill_board_BoardStatus" for="x_BoardStatus" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->BoardStatus->caption() ?><?php echo $bill_board_add->BoardStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->BoardStatus->cellAttributes() ?>>
<span id="el_bill_board_BoardStatus">
<input type="text" data-table="bill_board" data-field="x_BoardStatus" name="x_BoardStatus" id="x_BoardStatus" size="30" placeholder="<?php echo HtmlEncode($bill_board_add->BoardStatus->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->BoardStatus->EditValue ?>"<?php echo $bill_board_add->BoardStatus->editAttributes() ?>>
</span>
<?php echo $bill_board_add->BoardStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->ExemptCode->Visible) { // ExemptCode ?>
	<div id="r_ExemptCode" class="form-group row">
		<label id="elh_bill_board_ExemptCode" for="x_ExemptCode" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->ExemptCode->caption() ?><?php echo $bill_board_add->ExemptCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->ExemptCode->cellAttributes() ?>>
<span id="el_bill_board_ExemptCode">
<input type="text" data-table="bill_board" data-field="x_ExemptCode" name="x_ExemptCode" id="x_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($bill_board_add->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->ExemptCode->EditValue ?>"<?php echo $bill_board_add->ExemptCode->editAttributes() ?>>
</span>
<?php echo $bill_board_add->ExemptCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->StreetAddress->Visible) { // StreetAddress ?>
	<div id="r_StreetAddress" class="form-group row">
		<label id="elh_bill_board_StreetAddress" for="x_StreetAddress" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->StreetAddress->caption() ?><?php echo $bill_board_add->StreetAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->StreetAddress->cellAttributes() ?>>
<span id="el_bill_board_StreetAddress">
<input type="text" data-table="bill_board" data-field="x_StreetAddress" name="x_StreetAddress" id="x_StreetAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_add->StreetAddress->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->StreetAddress->EditValue ?>"<?php echo $bill_board_add->StreetAddress->editAttributes() ?>>
</span>
<?php echo $bill_board_add->StreetAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->Longitude->Visible) { // Longitude ?>
	<div id="r_Longitude" class="form-group row">
		<label id="elh_bill_board_Longitude" for="x_Longitude" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->Longitude->caption() ?><?php echo $bill_board_add->Longitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->Longitude->cellAttributes() ?>>
<span id="el_bill_board_Longitude">
<input type="text" data-table="bill_board" data-field="x_Longitude" name="x_Longitude" id="x_Longitude" size="30" placeholder="<?php echo HtmlEncode($bill_board_add->Longitude->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->Longitude->EditValue ?>"<?php echo $bill_board_add->Longitude->editAttributes() ?>>
</span>
<?php echo $bill_board_add->Longitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->Latitude->Visible) { // Latitude ?>
	<div id="r_Latitude" class="form-group row">
		<label id="elh_bill_board_Latitude" for="x_Latitude" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->Latitude->caption() ?><?php echo $bill_board_add->Latitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->Latitude->cellAttributes() ?>>
<span id="el_bill_board_Latitude">
<input type="text" data-table="bill_board" data-field="x_Latitude" name="x_Latitude" id="x_Latitude" size="30" placeholder="<?php echo HtmlEncode($bill_board_add->Latitude->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->Latitude->EditValue ?>"<?php echo $bill_board_add->Latitude->editAttributes() ?>>
</span>
<?php echo $bill_board_add->Latitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->Incumberance->Visible) { // Incumberance ?>
	<div id="r_Incumberance" class="form-group row">
		<label id="elh_bill_board_Incumberance" for="x_Incumberance" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->Incumberance->caption() ?><?php echo $bill_board_add->Incumberance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->Incumberance->cellAttributes() ?>>
<span id="el_bill_board_Incumberance">
<input type="text" data-table="bill_board" data-field="x_Incumberance" name="x_Incumberance" id="x_Incumberance" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($bill_board_add->Incumberance->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->Incumberance->EditValue ?>"<?php echo $bill_board_add->Incumberance->editAttributes() ?>>
</span>
<?php echo $bill_board_add->Incumberance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_bill_board_StartDate" for="x_StartDate" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->StartDate->caption() ?><?php echo $bill_board_add->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->StartDate->cellAttributes() ?>>
<span id="el_bill_board_StartDate">
<input type="text" data-table="bill_board" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($bill_board_add->StartDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->StartDate->EditValue ?>"<?php echo $bill_board_add->StartDate->editAttributes() ?>>
<?php if (!$bill_board_add->StartDate->ReadOnly && !$bill_board_add->StartDate->Disabled && !isset($bill_board_add->StartDate->EditAttrs["readonly"]) && !isset($bill_board_add->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_boardadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_boardadd", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $bill_board_add->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_add->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_bill_board_EndDate" for="x_EndDate" class="<?php echo $bill_board_add->LeftColumnClass ?>"><?php echo $bill_board_add->EndDate->caption() ?><?php echo $bill_board_add->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_add->RightColumnClass ?>"><div <?php echo $bill_board_add->EndDate->cellAttributes() ?>>
<span id="el_bill_board_EndDate">
<input type="text" data-table="bill_board" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($bill_board_add->EndDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_add->EndDate->EditValue ?>"<?php echo $bill_board_add->EndDate->editAttributes() ?>>
<?php if (!$bill_board_add->EndDate->ReadOnly && !$bill_board_add->EndDate->Disabled && !isset($bill_board_add->EndDate->EditAttrs["readonly"]) && !isset($bill_board_add->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_boardadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_boardadd", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $bill_board_add->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("bill_board_account", explode(",", $bill_board->getCurrentDetailTable())) && $bill_board_account->DetailAdd) {
?>
<?php if ($bill_board->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("bill_board_account", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "bill_board_accountgrid.php" ?>
<?php } ?>
<?php if (!$bill_board_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bill_board_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bill_board_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$bill_board_add->showPageFooter();
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
$bill_board_add->terminate();
?>