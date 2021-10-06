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
$bill_board_account_add = new bill_board_account_add();

// Run the page
$bill_board_account_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_account_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbill_board_accountadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fbill_board_accountadd = currentForm = new ew.Form("fbill_board_accountadd", "add");

	// Validate form
	fbill_board_accountadd.validate = function() {
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
			<?php if ($bill_board_account_add->BillBoardNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BillBoardNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_add->BillBoardNo->caption(), $bill_board_account_add->BillBoardNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillBoardNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_add->BillBoardNo->errorMessage()) ?>");
			<?php if ($bill_board_account_add->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_add->ClientID->caption(), $bill_board_account_add->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_account_add->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_add->BalanceBF->caption(), $bill_board_account_add->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_add->BalanceBF->errorMessage()) ?>");
			<?php if ($bill_board_account_add->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_add->CurrentDemand->caption(), $bill_board_account_add->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_add->CurrentDemand->errorMessage()) ?>");
			<?php if ($bill_board_account_add->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_add->VAT->caption(), $bill_board_account_add->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_add->VAT->errorMessage()) ?>");
			<?php if ($bill_board_account_add->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_add->AmountPaid->caption(), $bill_board_account_add->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_add->AmountPaid->errorMessage()) ?>");
			<?php if ($bill_board_account_add->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_add->BillPeriod->caption(), $bill_board_account_add->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_add->BillPeriod->errorMessage()) ?>");
			<?php if ($bill_board_account_add->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_add->PeriodType->caption(), $bill_board_account_add->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_account_add->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_add->BillYear->caption(), $bill_board_account_add->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_add->BillYear->errorMessage()) ?>");
			<?php if ($bill_board_account_add->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_add->StartDate->caption(), $bill_board_account_add->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_add->StartDate->errorMessage()) ?>");
			<?php if ($bill_board_account_add->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_add->EndDate->caption(), $bill_board_account_add->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_add->EndDate->errorMessage()) ?>");
			<?php if ($bill_board_account_add->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_add->LastUpdatedBy->caption(), $bill_board_account_add->LastUpdatedBy->RequiredErrorMessage)) ?>");
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
	fbill_board_accountadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbill_board_accountadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbill_board_accountadd.lists["x_PeriodType"] = <?php echo $bill_board_account_add->PeriodType->Lookup->toClientList($bill_board_account_add) ?>;
	fbill_board_accountadd.lists["x_PeriodType"].options = <?php echo JsonEncode($bill_board_account_add->PeriodType->lookupOptions()) ?>;
	loadjs.done("fbill_board_accountadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bill_board_account_add->showPageHeader(); ?>
<?php
$bill_board_account_add->showMessage();
?>
<form name="fbill_board_accountadd" id="fbill_board_accountadd" class="<?php echo $bill_board_account_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill_board_account">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$bill_board_account_add->IsModal ?>">
<?php if ($bill_board_account->getCurrentMasterTable() == "bill_board") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="bill_board">
<input type="hidden" name="fk_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_add->BillBoardNo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($bill_board_account_add->BillBoardNo->Visible) { // BillBoardNo ?>
	<div id="r_BillBoardNo" class="form-group row">
		<label id="elh_bill_board_account_BillBoardNo" for="x_BillBoardNo" class="<?php echo $bill_board_account_add->LeftColumnClass ?>"><?php echo $bill_board_account_add->BillBoardNo->caption() ?><?php echo $bill_board_account_add->BillBoardNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_add->RightColumnClass ?>"><div <?php echo $bill_board_account_add->BillBoardNo->cellAttributes() ?>>
<?php if ($bill_board_account_add->BillBoardNo->getSessionValue() != "") { ?>
<span id="el_bill_board_account_BillBoardNo">
<span<?php echo $bill_board_account_add->BillBoardNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_add->BillBoardNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_BillBoardNo" name="x_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_add->BillBoardNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_bill_board_account_BillBoardNo">
<input type="text" data-table="bill_board_account" data-field="x_BillBoardNo" name="x_BillBoardNo" id="x_BillBoardNo" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_add->BillBoardNo->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_add->BillBoardNo->EditValue ?>"<?php echo $bill_board_account_add->BillBoardNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $bill_board_account_add->BillBoardNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_add->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_bill_board_account_ClientID" for="x_ClientID" class="<?php echo $bill_board_account_add->LeftColumnClass ?>"><?php echo $bill_board_account_add->ClientID->caption() ?><?php echo $bill_board_account_add->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_add->RightColumnClass ?>"><div <?php echo $bill_board_account_add->ClientID->cellAttributes() ?>>
<span id="el_bill_board_account_ClientID">
<input type="text" data-table="bill_board_account" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bill_board_account_add->ClientID->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_add->ClientID->EditValue ?>"<?php echo $bill_board_account_add->ClientID->editAttributes() ?>>
</span>
<?php echo $bill_board_account_add->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_add->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label id="elh_bill_board_account_BalanceBF" for="x_BalanceBF" class="<?php echo $bill_board_account_add->LeftColumnClass ?>"><?php echo $bill_board_account_add->BalanceBF->caption() ?><?php echo $bill_board_account_add->BalanceBF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_add->RightColumnClass ?>"><div <?php echo $bill_board_account_add->BalanceBF->cellAttributes() ?>>
<span id="el_bill_board_account_BalanceBF">
<input type="text" data-table="bill_board_account" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_add->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_add->BalanceBF->EditValue ?>"<?php echo $bill_board_account_add->BalanceBF->editAttributes() ?>>
</span>
<?php echo $bill_board_account_add->BalanceBF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_add->CurrentDemand->Visible) { // CurrentDemand ?>
	<div id="r_CurrentDemand" class="form-group row">
		<label id="elh_bill_board_account_CurrentDemand" for="x_CurrentDemand" class="<?php echo $bill_board_account_add->LeftColumnClass ?>"><?php echo $bill_board_account_add->CurrentDemand->caption() ?><?php echo $bill_board_account_add->CurrentDemand->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_add->RightColumnClass ?>"><div <?php echo $bill_board_account_add->CurrentDemand->cellAttributes() ?>>
<span id="el_bill_board_account_CurrentDemand">
<input type="text" data-table="bill_board_account" data-field="x_CurrentDemand" name="x_CurrentDemand" id="x_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_add->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_add->CurrentDemand->EditValue ?>"<?php echo $bill_board_account_add->CurrentDemand->editAttributes() ?>>
</span>
<?php echo $bill_board_account_add->CurrentDemand->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_add->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label id="elh_bill_board_account_VAT" for="x_VAT" class="<?php echo $bill_board_account_add->LeftColumnClass ?>"><?php echo $bill_board_account_add->VAT->caption() ?><?php echo $bill_board_account_add->VAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_add->RightColumnClass ?>"><div <?php echo $bill_board_account_add->VAT->cellAttributes() ?>>
<span id="el_bill_board_account_VAT">
<input type="text" data-table="bill_board_account" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_add->VAT->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_add->VAT->EditValue ?>"<?php echo $bill_board_account_add->VAT->editAttributes() ?>>
</span>
<?php echo $bill_board_account_add->VAT->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_add->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_bill_board_account_AmountPaid" for="x_AmountPaid" class="<?php echo $bill_board_account_add->LeftColumnClass ?>"><?php echo $bill_board_account_add->AmountPaid->caption() ?><?php echo $bill_board_account_add->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_add->RightColumnClass ?>"><div <?php echo $bill_board_account_add->AmountPaid->cellAttributes() ?>>
<span id="el_bill_board_account_AmountPaid">
<input type="text" data-table="bill_board_account" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_add->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_add->AmountPaid->EditValue ?>"<?php echo $bill_board_account_add->AmountPaid->editAttributes() ?>>
</span>
<?php echo $bill_board_account_add->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_add->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label id="elh_bill_board_account_BillPeriod" for="x_BillPeriod" class="<?php echo $bill_board_account_add->LeftColumnClass ?>"><?php echo $bill_board_account_add->BillPeriod->caption() ?><?php echo $bill_board_account_add->BillPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_add->RightColumnClass ?>"><div <?php echo $bill_board_account_add->BillPeriod->cellAttributes() ?>>
<span id="el_bill_board_account_BillPeriod">
<input type="text" data-table="bill_board_account" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_add->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_add->BillPeriod->EditValue ?>"<?php echo $bill_board_account_add->BillPeriod->editAttributes() ?>>
</span>
<?php echo $bill_board_account_add->BillPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_add->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_bill_board_account_PeriodType" for="x_PeriodType" class="<?php echo $bill_board_account_add->LeftColumnClass ?>"><?php echo $bill_board_account_add->PeriodType->caption() ?><?php echo $bill_board_account_add->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_add->RightColumnClass ?>"><div <?php echo $bill_board_account_add->PeriodType->cellAttributes() ?>>
<span id="el_bill_board_account_PeriodType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="bill_board_account" data-field="x_PeriodType" data-value-separator="<?php echo $bill_board_account_add->PeriodType->displayValueSeparatorAttribute() ?>" id="x_PeriodType" name="x_PeriodType"<?php echo $bill_board_account_add->PeriodType->editAttributes() ?>>
			<?php echo $bill_board_account_add->PeriodType->selectOptionListHtml("x_PeriodType") ?>
		</select>
</div>
<?php echo $bill_board_account_add->PeriodType->Lookup->getParamTag($bill_board_account_add, "p_x_PeriodType") ?>
</span>
<?php echo $bill_board_account_add->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_add->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_bill_board_account_BillYear" for="x_BillYear" class="<?php echo $bill_board_account_add->LeftColumnClass ?>"><?php echo $bill_board_account_add->BillYear->caption() ?><?php echo $bill_board_account_add->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_add->RightColumnClass ?>"><div <?php echo $bill_board_account_add->BillYear->cellAttributes() ?>>
<span id="el_bill_board_account_BillYear">
<input type="text" data-table="bill_board_account" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_add->BillYear->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_add->BillYear->EditValue ?>"<?php echo $bill_board_account_add->BillYear->editAttributes() ?>>
</span>
<?php echo $bill_board_account_add->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_add->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_bill_board_account_StartDate" for="x_StartDate" class="<?php echo $bill_board_account_add->LeftColumnClass ?>"><?php echo $bill_board_account_add->StartDate->caption() ?><?php echo $bill_board_account_add->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_add->RightColumnClass ?>"><div <?php echo $bill_board_account_add->StartDate->cellAttributes() ?>>
<span id="el_bill_board_account_StartDate">
<input type="text" data-table="bill_board_account" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($bill_board_account_add->StartDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_add->StartDate->EditValue ?>"<?php echo $bill_board_account_add->StartDate->editAttributes() ?>>
<?php if (!$bill_board_account_add->StartDate->ReadOnly && !$bill_board_account_add->StartDate->Disabled && !isset($bill_board_account_add->StartDate->EditAttrs["readonly"]) && !isset($bill_board_account_add->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_board_accountadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_board_accountadd", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $bill_board_account_add->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_add->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_bill_board_account_EndDate" for="x_EndDate" class="<?php echo $bill_board_account_add->LeftColumnClass ?>"><?php echo $bill_board_account_add->EndDate->caption() ?><?php echo $bill_board_account_add->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_add->RightColumnClass ?>"><div <?php echo $bill_board_account_add->EndDate->cellAttributes() ?>>
<span id="el_bill_board_account_EndDate">
<input type="text" data-table="bill_board_account" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($bill_board_account_add->EndDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_add->EndDate->EditValue ?>"<?php echo $bill_board_account_add->EndDate->editAttributes() ?>>
<?php if (!$bill_board_account_add->EndDate->ReadOnly && !$bill_board_account_add->EndDate->Disabled && !isset($bill_board_account_add->EndDate->EditAttrs["readonly"]) && !isset($bill_board_account_add->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_board_accountadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_board_accountadd", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $bill_board_account_add->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_add->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_bill_board_account_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $bill_board_account_add->LeftColumnClass ?>"><?php echo $bill_board_account_add->LastUpdatedBy->caption() ?><?php echo $bill_board_account_add->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_add->RightColumnClass ?>"><div <?php echo $bill_board_account_add->LastUpdatedBy->cellAttributes() ?>>
<span id="el_bill_board_account_LastUpdatedBy">
<input type="text" data-table="bill_board_account" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bill_board_account_add->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_add->LastUpdatedBy->EditValue ?>"<?php echo $bill_board_account_add->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $bill_board_account_add->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$bill_board_account_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bill_board_account_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bill_board_account_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$bill_board_account_add->showPageFooter();
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
$bill_board_account_add->terminate();
?>