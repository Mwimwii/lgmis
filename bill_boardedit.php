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
$bill_board_edit = new bill_board_edit();

// Run the page
$bill_board_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbill_boardedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbill_boardedit = currentForm = new ew.Form("fbill_boardedit", "edit");

	// Validate form
	fbill_boardedit.validate = function() {
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
			<?php if ($bill_board_edit->BillBoardNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BillBoardNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->BillBoardNo->caption(), $bill_board_edit->BillBoardNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_edit->BoardStandNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardStandNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->BoardStandNo->caption(), $bill_board_edit->BoardStandNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_edit->ClientSerNo->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->ClientSerNo->caption(), $bill_board_edit->ClientSerNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ClientSerNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_edit->ClientSerNo->errorMessage()) ?>");
			<?php if ($bill_board_edit->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->ClientID->caption(), $bill_board_edit->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_edit->BoardLength->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardLength");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->BoardLength->caption(), $bill_board_edit->BoardLength->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardLength");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_edit->BoardLength->errorMessage()) ?>");
			<?php if ($bill_board_edit->BoardWidth->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardWidth");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->BoardWidth->caption(), $bill_board_edit->BoardWidth->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardWidth");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_edit->BoardWidth->errorMessage()) ?>");
			<?php if ($bill_board_edit->BoardSize->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardSize");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->BoardSize->caption(), $bill_board_edit->BoardSize->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardSize");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_edit->BoardSize->errorMessage()) ?>");
			<?php if ($bill_board_edit->BoardType->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->BoardType->caption(), $bill_board_edit->BoardType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_edit->BoardLocation->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardLocation");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->BoardLocation->caption(), $bill_board_edit->BoardLocation->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_edit->BoardStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_BoardStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->BoardStatus->caption(), $bill_board_edit->BoardStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BoardStatus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_edit->BoardStatus->errorMessage()) ?>");
			<?php if ($bill_board_edit->ExemptCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->ExemptCode->caption(), $bill_board_edit->ExemptCode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ExemptCode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_edit->ExemptCode->errorMessage()) ?>");
			<?php if ($bill_board_edit->StreetAddress->Required) { ?>
				elm = this.getElements("x" + infix + "_StreetAddress");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->StreetAddress->caption(), $bill_board_edit->StreetAddress->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_edit->Longitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->Longitude->caption(), $bill_board_edit->Longitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Longitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_edit->Longitude->errorMessage()) ?>");
			<?php if ($bill_board_edit->Latitude->Required) { ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->Latitude->caption(), $bill_board_edit->Latitude->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Latitude");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_edit->Latitude->errorMessage()) ?>");
			<?php if ($bill_board_edit->Incumberance->Required) { ?>
				elm = this.getElements("x" + infix + "_Incumberance");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->Incumberance->caption(), $bill_board_edit->Incumberance->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_edit->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->StartDate->caption(), $bill_board_edit->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_edit->StartDate->errorMessage()) ?>");
			<?php if ($bill_board_edit->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_edit->EndDate->caption(), $bill_board_edit->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_edit->EndDate->errorMessage()) ?>");

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
	fbill_boardedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbill_boardedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbill_boardedit.lists["x_ClientSerNo"] = <?php echo $bill_board_edit->ClientSerNo->Lookup->toClientList($bill_board_edit) ?>;
	fbill_boardedit.lists["x_ClientSerNo"].options = <?php echo JsonEncode($bill_board_edit->ClientSerNo->lookupOptions()) ?>;
	fbill_boardedit.autoSuggests["x_ClientSerNo"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fbill_boardedit.lists["x_BoardType"] = <?php echo $bill_board_edit->BoardType->Lookup->toClientList($bill_board_edit) ?>;
	fbill_boardedit.lists["x_BoardType"].options = <?php echo JsonEncode($bill_board_edit->BoardType->lookupOptions()) ?>;
	loadjs.done("fbill_boardedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bill_board_edit->showPageHeader(); ?>
<?php
$bill_board_edit->showMessage();
?>
<?php if (!$bill_board_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bill_board_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fbill_boardedit" id="fbill_boardedit" class="<?php echo $bill_board_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill_board">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$bill_board_edit->IsModal ?>">
<?php if ($bill_board->getCurrentMasterTable() == "client") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="client">
<input type="hidden" name="fk_ClientSerNo" value="<?php echo HtmlEncode($bill_board_edit->ClientSerNo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($bill_board_edit->BillBoardNo->Visible) { // BillBoardNo ?>
	<div id="r_BillBoardNo" class="form-group row">
		<label id="elh_bill_board_BillBoardNo" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->BillBoardNo->caption() ?><?php echo $bill_board_edit->BillBoardNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->BillBoardNo->cellAttributes() ?>>
<span id="el_bill_board_BillBoardNo">
<span<?php echo $bill_board_edit->BillBoardNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_edit->BillBoardNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board" data-field="x_BillBoardNo" name="x_BillBoardNo" id="x_BillBoardNo" value="<?php echo HtmlEncode($bill_board_edit->BillBoardNo->CurrentValue) ?>">
<?php echo $bill_board_edit->BillBoardNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->BoardStandNo->Visible) { // BoardStandNo ?>
	<div id="r_BoardStandNo" class="form-group row">
		<label id="elh_bill_board_BoardStandNo" for="x_BoardStandNo" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->BoardStandNo->caption() ?><?php echo $bill_board_edit->BoardStandNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->BoardStandNo->cellAttributes() ?>>
<span id="el_bill_board_BoardStandNo">
<input type="text" data-table="bill_board" data-field="x_BoardStandNo" name="x_BoardStandNo" id="x_BoardStandNo" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_edit->BoardStandNo->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->BoardStandNo->EditValue ?>"<?php echo $bill_board_edit->BoardStandNo->editAttributes() ?>>
</span>
<?php echo $bill_board_edit->BoardStandNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->ClientSerNo->Visible) { // ClientSerNo ?>
	<div id="r_ClientSerNo" class="form-group row">
		<label id="elh_bill_board_ClientSerNo" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->ClientSerNo->caption() ?><?php echo $bill_board_edit->ClientSerNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->ClientSerNo->cellAttributes() ?>>
<?php if ($bill_board_edit->ClientSerNo->getSessionValue() != "") { ?>
<span id="el_bill_board_ClientSerNo">
<span<?php echo $bill_board_edit->ClientSerNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_edit->ClientSerNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_ClientSerNo" name="x_ClientSerNo" value="<?php echo HtmlEncode($bill_board_edit->ClientSerNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_bill_board_ClientSerNo">
<?php
$onchange = $bill_board_edit->ClientSerNo->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$bill_board_edit->ClientSerNo->EditAttrs["onchange"] = "";
?>
<span id="as_x_ClientSerNo">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_ClientSerNo" id="sv_x_ClientSerNo" value="<?php echo RemoveHtml($bill_board_edit->ClientSerNo->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($bill_board_edit->ClientSerNo->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($bill_board_edit->ClientSerNo->getPlaceHolder()) ?>"<?php echo $bill_board_edit->ClientSerNo->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($bill_board_edit->ClientSerNo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_ClientSerNo',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($bill_board_edit->ClientSerNo->ReadOnly || $bill_board_edit->ClientSerNo->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="bill_board" data-field="x_ClientSerNo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $bill_board_edit->ClientSerNo->displayValueSeparatorAttribute() ?>" name="x_ClientSerNo" id="x_ClientSerNo" value="<?php echo HtmlEncode($bill_board_edit->ClientSerNo->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fbill_boardedit"], function() {
	fbill_boardedit.createAutoSuggest({"id":"x_ClientSerNo","forceSelect":false});
});
</script>
<?php echo $bill_board_edit->ClientSerNo->Lookup->getParamTag($bill_board_edit, "p_x_ClientSerNo") ?>
</span>
<?php } ?>
<?php echo $bill_board_edit->ClientSerNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_bill_board_ClientID" for="x_ClientID" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->ClientID->caption() ?><?php echo $bill_board_edit->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->ClientID->cellAttributes() ?>>
<span id="el_bill_board_ClientID">
<input type="text" data-table="bill_board" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bill_board_edit->ClientID->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->ClientID->EditValue ?>"<?php echo $bill_board_edit->ClientID->editAttributes() ?>>
</span>
<?php echo $bill_board_edit->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->BoardLength->Visible) { // BoardLength ?>
	<div id="r_BoardLength" class="form-group row">
		<label id="elh_bill_board_BoardLength" for="x_BoardLength" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->BoardLength->caption() ?><?php echo $bill_board_edit->BoardLength->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->BoardLength->cellAttributes() ?>>
<span id="el_bill_board_BoardLength">
<input type="text" data-table="bill_board" data-field="x_BoardLength" name="x_BoardLength" id="x_BoardLength" size="30" placeholder="<?php echo HtmlEncode($bill_board_edit->BoardLength->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->BoardLength->EditValue ?>"<?php echo $bill_board_edit->BoardLength->editAttributes() ?>>
</span>
<?php echo $bill_board_edit->BoardLength->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->BoardWidth->Visible) { // BoardWidth ?>
	<div id="r_BoardWidth" class="form-group row">
		<label id="elh_bill_board_BoardWidth" for="x_BoardWidth" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->BoardWidth->caption() ?><?php echo $bill_board_edit->BoardWidth->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->BoardWidth->cellAttributes() ?>>
<span id="el_bill_board_BoardWidth">
<input type="text" data-table="bill_board" data-field="x_BoardWidth" name="x_BoardWidth" id="x_BoardWidth" size="30" placeholder="<?php echo HtmlEncode($bill_board_edit->BoardWidth->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->BoardWidth->EditValue ?>"<?php echo $bill_board_edit->BoardWidth->editAttributes() ?>>
</span>
<?php echo $bill_board_edit->BoardWidth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->BoardSize->Visible) { // BoardSize ?>
	<div id="r_BoardSize" class="form-group row">
		<label id="elh_bill_board_BoardSize" for="x_BoardSize" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->BoardSize->caption() ?><?php echo $bill_board_edit->BoardSize->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->BoardSize->cellAttributes() ?>>
<span id="el_bill_board_BoardSize">
<input type="text" data-table="bill_board" data-field="x_BoardSize" name="x_BoardSize" id="x_BoardSize" size="30" placeholder="<?php echo HtmlEncode($bill_board_edit->BoardSize->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->BoardSize->EditValue ?>"<?php echo $bill_board_edit->BoardSize->editAttributes() ?>>
</span>
<?php echo $bill_board_edit->BoardSize->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->BoardType->Visible) { // BoardType ?>
	<div id="r_BoardType" class="form-group row">
		<label id="elh_bill_board_BoardType" for="x_BoardType" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->BoardType->caption() ?><?php echo $bill_board_edit->BoardType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->BoardType->cellAttributes() ?>>
<span id="el_bill_board_BoardType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="bill_board" data-field="x_BoardType" data-value-separator="<?php echo $bill_board_edit->BoardType->displayValueSeparatorAttribute() ?>" id="x_BoardType" name="x_BoardType"<?php echo $bill_board_edit->BoardType->editAttributes() ?>>
			<?php echo $bill_board_edit->BoardType->selectOptionListHtml("x_BoardType") ?>
		</select>
</div>
<?php echo $bill_board_edit->BoardType->Lookup->getParamTag($bill_board_edit, "p_x_BoardType") ?>
</span>
<?php echo $bill_board_edit->BoardType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->BoardLocation->Visible) { // BoardLocation ?>
	<div id="r_BoardLocation" class="form-group row">
		<label id="elh_bill_board_BoardLocation" for="x_BoardLocation" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->BoardLocation->caption() ?><?php echo $bill_board_edit->BoardLocation->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->BoardLocation->cellAttributes() ?>>
<span id="el_bill_board_BoardLocation">
<input type="text" data-table="bill_board" data-field="x_BoardLocation" name="x_BoardLocation" id="x_BoardLocation" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_edit->BoardLocation->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->BoardLocation->EditValue ?>"<?php echo $bill_board_edit->BoardLocation->editAttributes() ?>>
</span>
<?php echo $bill_board_edit->BoardLocation->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->BoardStatus->Visible) { // BoardStatus ?>
	<div id="r_BoardStatus" class="form-group row">
		<label id="elh_bill_board_BoardStatus" for="x_BoardStatus" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->BoardStatus->caption() ?><?php echo $bill_board_edit->BoardStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->BoardStatus->cellAttributes() ?>>
<span id="el_bill_board_BoardStatus">
<input type="text" data-table="bill_board" data-field="x_BoardStatus" name="x_BoardStatus" id="x_BoardStatus" size="30" placeholder="<?php echo HtmlEncode($bill_board_edit->BoardStatus->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->BoardStatus->EditValue ?>"<?php echo $bill_board_edit->BoardStatus->editAttributes() ?>>
</span>
<?php echo $bill_board_edit->BoardStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->ExemptCode->Visible) { // ExemptCode ?>
	<div id="r_ExemptCode" class="form-group row">
		<label id="elh_bill_board_ExemptCode" for="x_ExemptCode" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->ExemptCode->caption() ?><?php echo $bill_board_edit->ExemptCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->ExemptCode->cellAttributes() ?>>
<span id="el_bill_board_ExemptCode">
<input type="text" data-table="bill_board" data-field="x_ExemptCode" name="x_ExemptCode" id="x_ExemptCode" size="30" placeholder="<?php echo HtmlEncode($bill_board_edit->ExemptCode->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->ExemptCode->EditValue ?>"<?php echo $bill_board_edit->ExemptCode->editAttributes() ?>>
</span>
<?php echo $bill_board_edit->ExemptCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->StreetAddress->Visible) { // StreetAddress ?>
	<div id="r_StreetAddress" class="form-group row">
		<label id="elh_bill_board_StreetAddress" for="x_StreetAddress" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->StreetAddress->caption() ?><?php echo $bill_board_edit->StreetAddress->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->StreetAddress->cellAttributes() ?>>
<span id="el_bill_board_StreetAddress">
<input type="text" data-table="bill_board" data-field="x_StreetAddress" name="x_StreetAddress" id="x_StreetAddress" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($bill_board_edit->StreetAddress->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->StreetAddress->EditValue ?>"<?php echo $bill_board_edit->StreetAddress->editAttributes() ?>>
</span>
<?php echo $bill_board_edit->StreetAddress->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->Longitude->Visible) { // Longitude ?>
	<div id="r_Longitude" class="form-group row">
		<label id="elh_bill_board_Longitude" for="x_Longitude" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->Longitude->caption() ?><?php echo $bill_board_edit->Longitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->Longitude->cellAttributes() ?>>
<span id="el_bill_board_Longitude">
<input type="text" data-table="bill_board" data-field="x_Longitude" name="x_Longitude" id="x_Longitude" size="30" placeholder="<?php echo HtmlEncode($bill_board_edit->Longitude->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->Longitude->EditValue ?>"<?php echo $bill_board_edit->Longitude->editAttributes() ?>>
</span>
<?php echo $bill_board_edit->Longitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->Latitude->Visible) { // Latitude ?>
	<div id="r_Latitude" class="form-group row">
		<label id="elh_bill_board_Latitude" for="x_Latitude" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->Latitude->caption() ?><?php echo $bill_board_edit->Latitude->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->Latitude->cellAttributes() ?>>
<span id="el_bill_board_Latitude">
<input type="text" data-table="bill_board" data-field="x_Latitude" name="x_Latitude" id="x_Latitude" size="30" placeholder="<?php echo HtmlEncode($bill_board_edit->Latitude->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->Latitude->EditValue ?>"<?php echo $bill_board_edit->Latitude->editAttributes() ?>>
</span>
<?php echo $bill_board_edit->Latitude->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->Incumberance->Visible) { // Incumberance ?>
	<div id="r_Incumberance" class="form-group row">
		<label id="elh_bill_board_Incumberance" for="x_Incumberance" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->Incumberance->caption() ?><?php echo $bill_board_edit->Incumberance->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->Incumberance->cellAttributes() ?>>
<span id="el_bill_board_Incumberance">
<input type="text" data-table="bill_board" data-field="x_Incumberance" name="x_Incumberance" id="x_Incumberance" size="30" maxlength="1" placeholder="<?php echo HtmlEncode($bill_board_edit->Incumberance->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->Incumberance->EditValue ?>"<?php echo $bill_board_edit->Incumberance->editAttributes() ?>>
</span>
<?php echo $bill_board_edit->Incumberance->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_bill_board_StartDate" for="x_StartDate" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->StartDate->caption() ?><?php echo $bill_board_edit->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->StartDate->cellAttributes() ?>>
<span id="el_bill_board_StartDate">
<input type="text" data-table="bill_board" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($bill_board_edit->StartDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->StartDate->EditValue ?>"<?php echo $bill_board_edit->StartDate->editAttributes() ?>>
<?php if (!$bill_board_edit->StartDate->ReadOnly && !$bill_board_edit->StartDate->Disabled && !isset($bill_board_edit->StartDate->EditAttrs["readonly"]) && !isset($bill_board_edit->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_boardedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_boardedit", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $bill_board_edit->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_edit->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_bill_board_EndDate" for="x_EndDate" class="<?php echo $bill_board_edit->LeftColumnClass ?>"><?php echo $bill_board_edit->EndDate->caption() ?><?php echo $bill_board_edit->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_edit->RightColumnClass ?>"><div <?php echo $bill_board_edit->EndDate->cellAttributes() ?>>
<span id="el_bill_board_EndDate">
<input type="text" data-table="bill_board" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($bill_board_edit->EndDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_edit->EndDate->EditValue ?>"<?php echo $bill_board_edit->EndDate->editAttributes() ?>>
<?php if (!$bill_board_edit->EndDate->ReadOnly && !$bill_board_edit->EndDate->Disabled && !isset($bill_board_edit->EndDate->EditAttrs["readonly"]) && !isset($bill_board_edit->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_boardedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_boardedit", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $bill_board_edit->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("bill_board_account", explode(",", $bill_board->getCurrentDetailTable())) && $bill_board_account->DetailEdit) {
?>
<?php if ($bill_board->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("bill_board_account", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "bill_board_accountgrid.php" ?>
<?php } ?>
<?php if (!$bill_board_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bill_board_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bill_board_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$bill_board_edit->IsModal) { ?>
<?php echo $bill_board_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$bill_board_edit->showPageFooter();
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
$bill_board_edit->terminate();
?>