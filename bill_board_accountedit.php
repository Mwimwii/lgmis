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
$bill_board_account_edit = new bill_board_account_edit();

// Run the page
$bill_board_account_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_account_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fbill_board_accountedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fbill_board_accountedit = currentForm = new ew.Form("fbill_board_accountedit", "edit");

	// Validate form
	fbill_board_accountedit.validate = function() {
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
			<?php if ($bill_board_account_edit->AccountNo->Required) { ?>
				elm = this.getElements("x" + infix + "_AccountNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->AccountNo->caption(), $bill_board_account_edit->AccountNo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_account_edit->BillBoardNo->Required) { ?>
				elm = this.getElements("x" + infix + "_BillBoardNo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->BillBoardNo->caption(), $bill_board_account_edit->BillBoardNo->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillBoardNo");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_edit->BillBoardNo->errorMessage()) ?>");
			<?php if ($bill_board_account_edit->ClientID->Required) { ?>
				elm = this.getElements("x" + infix + "_ClientID");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->ClientID->caption(), $bill_board_account_edit->ClientID->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_account_edit->BalanceBF->Required) { ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->BalanceBF->caption(), $bill_board_account_edit->BalanceBF->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BalanceBF");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_edit->BalanceBF->errorMessage()) ?>");
			<?php if ($bill_board_account_edit->CurrentDemand->Required) { ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->CurrentDemand->caption(), $bill_board_account_edit->CurrentDemand->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_CurrentDemand");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_edit->CurrentDemand->errorMessage()) ?>");
			<?php if ($bill_board_account_edit->VAT->Required) { ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->VAT->caption(), $bill_board_account_edit->VAT->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_VAT");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_edit->VAT->errorMessage()) ?>");
			<?php if ($bill_board_account_edit->AmountPaid->Required) { ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->AmountPaid->caption(), $bill_board_account_edit->AmountPaid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_AmountPaid");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_edit->AmountPaid->errorMessage()) ?>");
			<?php if ($bill_board_account_edit->BillPeriod->Required) { ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->BillPeriod->caption(), $bill_board_account_edit->BillPeriod->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillPeriod");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_edit->BillPeriod->errorMessage()) ?>");
			<?php if ($bill_board_account_edit->PeriodType->Required) { ?>
				elm = this.getElements("x" + infix + "_PeriodType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->PeriodType->caption(), $bill_board_account_edit->PeriodType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($bill_board_account_edit->BillYear->Required) { ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->BillYear->caption(), $bill_board_account_edit->BillYear->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_BillYear");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_edit->BillYear->errorMessage()) ?>");
			<?php if ($bill_board_account_edit->StartDate->Required) { ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->StartDate->caption(), $bill_board_account_edit->StartDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_StartDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_edit->StartDate->errorMessage()) ?>");
			<?php if ($bill_board_account_edit->EndDate->Required) { ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->EndDate->caption(), $bill_board_account_edit->EndDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_EndDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($bill_board_account_edit->EndDate->errorMessage()) ?>");
			<?php if ($bill_board_account_edit->LastUpdatedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_LastUpdatedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $bill_board_account_edit->LastUpdatedBy->caption(), $bill_board_account_edit->LastUpdatedBy->RequiredErrorMessage)) ?>");
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
	fbill_board_accountedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fbill_board_accountedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fbill_board_accountedit.lists["x_PeriodType"] = <?php echo $bill_board_account_edit->PeriodType->Lookup->toClientList($bill_board_account_edit) ?>;
	fbill_board_accountedit.lists["x_PeriodType"].options = <?php echo JsonEncode($bill_board_account_edit->PeriodType->lookupOptions()) ?>;
	loadjs.done("fbill_board_accountedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $bill_board_account_edit->showPageHeader(); ?>
<?php
$bill_board_account_edit->showMessage();
?>
<?php if (!$bill_board_account_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bill_board_account_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fbill_board_accountedit" id="fbill_board_accountedit" class="<?php echo $bill_board_account_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill_board_account">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$bill_board_account_edit->IsModal ?>">
<?php if ($bill_board_account->getCurrentMasterTable() == "bill_board") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="bill_board">
<input type="hidden" name="fk_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_edit->BillBoardNo->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($bill_board_account_edit->AccountNo->Visible) { // AccountNo ?>
	<div id="r_AccountNo" class="form-group row">
		<label id="elh_bill_board_account_AccountNo" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->AccountNo->caption() ?><?php echo $bill_board_account_edit->AccountNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->AccountNo->cellAttributes() ?>>
<span id="el_bill_board_account_AccountNo">
<span<?php echo $bill_board_account_edit->AccountNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_edit->AccountNo->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="bill_board_account" data-field="x_AccountNo" name="x_AccountNo" id="x_AccountNo" value="<?php echo HtmlEncode($bill_board_account_edit->AccountNo->CurrentValue) ?>">
<?php echo $bill_board_account_edit->AccountNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_edit->BillBoardNo->Visible) { // BillBoardNo ?>
	<div id="r_BillBoardNo" class="form-group row">
		<label id="elh_bill_board_account_BillBoardNo" for="x_BillBoardNo" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->BillBoardNo->caption() ?><?php echo $bill_board_account_edit->BillBoardNo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->BillBoardNo->cellAttributes() ?>>
<?php if ($bill_board_account_edit->BillBoardNo->getSessionValue() != "") { ?>
<span id="el_bill_board_account_BillBoardNo">
<span<?php echo $bill_board_account_edit->BillBoardNo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($bill_board_account_edit->BillBoardNo->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_BillBoardNo" name="x_BillBoardNo" value="<?php echo HtmlEncode($bill_board_account_edit->BillBoardNo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_bill_board_account_BillBoardNo">
<input type="text" data-table="bill_board_account" data-field="x_BillBoardNo" name="x_BillBoardNo" id="x_BillBoardNo" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_edit->BillBoardNo->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_edit->BillBoardNo->EditValue ?>"<?php echo $bill_board_account_edit->BillBoardNo->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $bill_board_account_edit->BillBoardNo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_edit->ClientID->Visible) { // ClientID ?>
	<div id="r_ClientID" class="form-group row">
		<label id="elh_bill_board_account_ClientID" for="x_ClientID" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->ClientID->caption() ?><?php echo $bill_board_account_edit->ClientID->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->ClientID->cellAttributes() ?>>
<span id="el_bill_board_account_ClientID">
<input type="text" data-table="bill_board_account" data-field="x_ClientID" name="x_ClientID" id="x_ClientID" size="30" maxlength="13" placeholder="<?php echo HtmlEncode($bill_board_account_edit->ClientID->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_edit->ClientID->EditValue ?>"<?php echo $bill_board_account_edit->ClientID->editAttributes() ?>>
</span>
<?php echo $bill_board_account_edit->ClientID->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_edit->BalanceBF->Visible) { // BalanceBF ?>
	<div id="r_BalanceBF" class="form-group row">
		<label id="elh_bill_board_account_BalanceBF" for="x_BalanceBF" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->BalanceBF->caption() ?><?php echo $bill_board_account_edit->BalanceBF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->BalanceBF->cellAttributes() ?>>
<span id="el_bill_board_account_BalanceBF">
<input type="text" data-table="bill_board_account" data-field="x_BalanceBF" name="x_BalanceBF" id="x_BalanceBF" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_edit->BalanceBF->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_edit->BalanceBF->EditValue ?>"<?php echo $bill_board_account_edit->BalanceBF->editAttributes() ?>>
</span>
<?php echo $bill_board_account_edit->BalanceBF->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_edit->CurrentDemand->Visible) { // CurrentDemand ?>
	<div id="r_CurrentDemand" class="form-group row">
		<label id="elh_bill_board_account_CurrentDemand" for="x_CurrentDemand" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->CurrentDemand->caption() ?><?php echo $bill_board_account_edit->CurrentDemand->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->CurrentDemand->cellAttributes() ?>>
<span id="el_bill_board_account_CurrentDemand">
<input type="text" data-table="bill_board_account" data-field="x_CurrentDemand" name="x_CurrentDemand" id="x_CurrentDemand" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_edit->CurrentDemand->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_edit->CurrentDemand->EditValue ?>"<?php echo $bill_board_account_edit->CurrentDemand->editAttributes() ?>>
</span>
<?php echo $bill_board_account_edit->CurrentDemand->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_edit->VAT->Visible) { // VAT ?>
	<div id="r_VAT" class="form-group row">
		<label id="elh_bill_board_account_VAT" for="x_VAT" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->VAT->caption() ?><?php echo $bill_board_account_edit->VAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->VAT->cellAttributes() ?>>
<span id="el_bill_board_account_VAT">
<input type="text" data-table="bill_board_account" data-field="x_VAT" name="x_VAT" id="x_VAT" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_edit->VAT->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_edit->VAT->EditValue ?>"<?php echo $bill_board_account_edit->VAT->editAttributes() ?>>
</span>
<?php echo $bill_board_account_edit->VAT->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_edit->AmountPaid->Visible) { // AmountPaid ?>
	<div id="r_AmountPaid" class="form-group row">
		<label id="elh_bill_board_account_AmountPaid" for="x_AmountPaid" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->AmountPaid->caption() ?><?php echo $bill_board_account_edit->AmountPaid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->AmountPaid->cellAttributes() ?>>
<span id="el_bill_board_account_AmountPaid">
<input type="text" data-table="bill_board_account" data-field="x_AmountPaid" name="x_AmountPaid" id="x_AmountPaid" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_edit->AmountPaid->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_edit->AmountPaid->EditValue ?>"<?php echo $bill_board_account_edit->AmountPaid->editAttributes() ?>>
</span>
<?php echo $bill_board_account_edit->AmountPaid->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_edit->BillPeriod->Visible) { // BillPeriod ?>
	<div id="r_BillPeriod" class="form-group row">
		<label id="elh_bill_board_account_BillPeriod" for="x_BillPeriod" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->BillPeriod->caption() ?><?php echo $bill_board_account_edit->BillPeriod->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->BillPeriod->cellAttributes() ?>>
<span id="el_bill_board_account_BillPeriod">
<input type="text" data-table="bill_board_account" data-field="x_BillPeriod" name="x_BillPeriod" id="x_BillPeriod" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_edit->BillPeriod->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_edit->BillPeriod->EditValue ?>"<?php echo $bill_board_account_edit->BillPeriod->editAttributes() ?>>
</span>
<?php echo $bill_board_account_edit->BillPeriod->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_edit->PeriodType->Visible) { // PeriodType ?>
	<div id="r_PeriodType" class="form-group row">
		<label id="elh_bill_board_account_PeriodType" for="x_PeriodType" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->PeriodType->caption() ?><?php echo $bill_board_account_edit->PeriodType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->PeriodType->cellAttributes() ?>>
<span id="el_bill_board_account_PeriodType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="bill_board_account" data-field="x_PeriodType" data-value-separator="<?php echo $bill_board_account_edit->PeriodType->displayValueSeparatorAttribute() ?>" id="x_PeriodType" name="x_PeriodType"<?php echo $bill_board_account_edit->PeriodType->editAttributes() ?>>
			<?php echo $bill_board_account_edit->PeriodType->selectOptionListHtml("x_PeriodType") ?>
		</select>
</div>
<?php echo $bill_board_account_edit->PeriodType->Lookup->getParamTag($bill_board_account_edit, "p_x_PeriodType") ?>
</span>
<?php echo $bill_board_account_edit->PeriodType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_edit->BillYear->Visible) { // BillYear ?>
	<div id="r_BillYear" class="form-group row">
		<label id="elh_bill_board_account_BillYear" for="x_BillYear" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->BillYear->caption() ?><?php echo $bill_board_account_edit->BillYear->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->BillYear->cellAttributes() ?>>
<span id="el_bill_board_account_BillYear">
<input type="text" data-table="bill_board_account" data-field="x_BillYear" name="x_BillYear" id="x_BillYear" size="30" placeholder="<?php echo HtmlEncode($bill_board_account_edit->BillYear->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_edit->BillYear->EditValue ?>"<?php echo $bill_board_account_edit->BillYear->editAttributes() ?>>
</span>
<?php echo $bill_board_account_edit->BillYear->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_edit->StartDate->Visible) { // StartDate ?>
	<div id="r_StartDate" class="form-group row">
		<label id="elh_bill_board_account_StartDate" for="x_StartDate" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->StartDate->caption() ?><?php echo $bill_board_account_edit->StartDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->StartDate->cellAttributes() ?>>
<span id="el_bill_board_account_StartDate">
<input type="text" data-table="bill_board_account" data-field="x_StartDate" name="x_StartDate" id="x_StartDate" placeholder="<?php echo HtmlEncode($bill_board_account_edit->StartDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_edit->StartDate->EditValue ?>"<?php echo $bill_board_account_edit->StartDate->editAttributes() ?>>
<?php if (!$bill_board_account_edit->StartDate->ReadOnly && !$bill_board_account_edit->StartDate->Disabled && !isset($bill_board_account_edit->StartDate->EditAttrs["readonly"]) && !isset($bill_board_account_edit->StartDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_board_accountedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_board_accountedit", "x_StartDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $bill_board_account_edit->StartDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_edit->EndDate->Visible) { // EndDate ?>
	<div id="r_EndDate" class="form-group row">
		<label id="elh_bill_board_account_EndDate" for="x_EndDate" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->EndDate->caption() ?><?php echo $bill_board_account_edit->EndDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->EndDate->cellAttributes() ?>>
<span id="el_bill_board_account_EndDate">
<input type="text" data-table="bill_board_account" data-field="x_EndDate" name="x_EndDate" id="x_EndDate" placeholder="<?php echo HtmlEncode($bill_board_account_edit->EndDate->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_edit->EndDate->EditValue ?>"<?php echo $bill_board_account_edit->EndDate->editAttributes() ?>>
<?php if (!$bill_board_account_edit->EndDate->ReadOnly && !$bill_board_account_edit->EndDate->Disabled && !isset($bill_board_account_edit->EndDate->EditAttrs["readonly"]) && !isset($bill_board_account_edit->EndDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbill_board_accountedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fbill_board_accountedit", "x_EndDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $bill_board_account_edit->EndDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($bill_board_account_edit->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<div id="r_LastUpdatedBy" class="form-group row">
		<label id="elh_bill_board_account_LastUpdatedBy" for="x_LastUpdatedBy" class="<?php echo $bill_board_account_edit->LeftColumnClass ?>"><?php echo $bill_board_account_edit->LastUpdatedBy->caption() ?><?php echo $bill_board_account_edit->LastUpdatedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $bill_board_account_edit->RightColumnClass ?>"><div <?php echo $bill_board_account_edit->LastUpdatedBy->cellAttributes() ?>>
<span id="el_bill_board_account_LastUpdatedBy">
<input type="text" data-table="bill_board_account" data-field="x_LastUpdatedBy" name="x_LastUpdatedBy" id="x_LastUpdatedBy" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($bill_board_account_edit->LastUpdatedBy->getPlaceHolder()) ?>" value="<?php echo $bill_board_account_edit->LastUpdatedBy->EditValue ?>"<?php echo $bill_board_account_edit->LastUpdatedBy->editAttributes() ?>>
</span>
<?php echo $bill_board_account_edit->LastUpdatedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$bill_board_account_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $bill_board_account_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $bill_board_account_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$bill_board_account_edit->IsModal) { ?>
<?php echo $bill_board_account_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$bill_board_account_edit->showPageFooter();
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
$bill_board_account_edit->terminate();
?>