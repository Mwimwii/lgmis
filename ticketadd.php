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
$ticket_add = new ticket_add();

// Run the page
$ticket_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticketadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fticketadd = currentForm = new ew.Form("fticketadd", "add");

	// Validate form
	fticketadd.validate = function() {
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
			<?php if ($ticket_add->Subject->Required) { ?>
				elm = this.getElements("x" + infix + "_Subject");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->Subject->caption(), $ticket_add->Subject->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->TicketReportDate->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketReportDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->TicketReportDate->caption(), $ticket_add->TicketReportDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TicketReportDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_add->TicketReportDate->errorMessage()) ?>");
			<?php if ($ticket_add->IncidentDate->Required) { ?>
				elm = this.getElements("x" + infix + "_IncidentDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->IncidentDate->caption(), $ticket_add->IncidentDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IncidentDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_add->IncidentDate->errorMessage()) ?>");
			<?php if ($ticket_add->IncidentTime->Required) { ?>
				elm = this.getElements("x" + infix + "_IncidentTime");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->IncidentTime->caption(), $ticket_add->IncidentTime->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IncidentTime");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_add->IncidentTime->errorMessage()) ?>");
			<?php if ($ticket_add->TicketDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->TicketDescription->caption(), $ticket_add->TicketDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->TicketCategory->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketCategory");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->TicketCategory->caption(), $ticket_add->TicketCategory->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TicketCategory");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_add->TicketCategory->errorMessage()) ?>");
			<?php if ($ticket_add->TicketType->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->TicketType->caption(), $ticket_add->TicketType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->ReportedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_ReportedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->ReportedBy->caption(), $ticket_add->ReportedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->TicketStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->TicketStatus->caption(), $ticket_add->TicketStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->ReporterEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_ReporterEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->ReporterEmail->caption(), $ticket_add->ReporterEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReporterEmail");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_add->ReporterEmail->errorMessage()) ?>");
			<?php if ($ticket_add->ReporterMobile->Required) { ?>
				elm = this.getElements("x" + infix + "_ReporterMobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->ReporterMobile->caption(), $ticket_add->ReporterMobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->ProvinceCode->caption(), $ticket_add->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->LACode->caption(), $ticket_add->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->DepartmentCode->caption(), $ticket_add->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->DeptSection->Required) { ?>
				elm = this.getElements("x" + infix + "_DeptSection");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->DeptSection->caption(), $ticket_add->DeptSection->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->TicketLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->TicketLevel->caption(), $ticket_add->TicketLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TicketLevel");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_add->TicketLevel->errorMessage()) ?>");
			<?php if ($ticket_add->AllocatedTo->Required) { ?>
				elm = this.getElements("x" + infix + "_AllocatedTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->AllocatedTo->caption(), $ticket_add->AllocatedTo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->EscalatedTo->Required) { ?>
				elm = this.getElements("x" + infix + "_EscalatedTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->EscalatedTo->caption(), $ticket_add->EscalatedTo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->TicketSolution->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketSolution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->TicketSolution->caption(), $ticket_add->TicketSolution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->Evidence->Required) { ?>
				felm = this.getElements("x" + infix + "_Evidence");
				elm = this.getElements("fn_x" + infix + "_Evidence");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $ticket_add->Evidence->caption(), $ticket_add->Evidence->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->SeverityLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_SeverityLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->SeverityLevel->caption(), $ticket_add->SeverityLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_add->Days->Required) { ?>
				elm = this.getElements("x" + infix + "_Days");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->Days->caption(), $ticket_add->Days->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Days");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_add->Days->errorMessage()) ?>");
			<?php if ($ticket_add->DataLastUpdated->Required) { ?>
				elm = this.getElements("x" + infix + "_DataLastUpdated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_add->DataLastUpdated->caption(), $ticket_add->DataLastUpdated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DataLastUpdated");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_add->DataLastUpdated->errorMessage()) ?>");

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
	fticketadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fticketadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fticketadd.lists["x_TicketCategory"] = <?php echo $ticket_add->TicketCategory->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_TicketCategory"].options = <?php echo JsonEncode($ticket_add->TicketCategory->lookupOptions()) ?>;
	fticketadd.autoSuggests["x_TicketCategory"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fticketadd.lists["x_TicketType"] = <?php echo $ticket_add->TicketType->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_TicketType"].options = <?php echo JsonEncode($ticket_add->TicketType->lookupOptions()) ?>;
	fticketadd.lists["x_ReportedBy"] = <?php echo $ticket_add->ReportedBy->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_ReportedBy"].options = <?php echo JsonEncode($ticket_add->ReportedBy->lookupOptions()) ?>;
	fticketadd.lists["x_TicketStatus"] = <?php echo $ticket_add->TicketStatus->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_TicketStatus"].options = <?php echo JsonEncode($ticket_add->TicketStatus->lookupOptions()) ?>;
	fticketadd.lists["x_ProvinceCode"] = <?php echo $ticket_add->ProvinceCode->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_ProvinceCode"].options = <?php echo JsonEncode($ticket_add->ProvinceCode->lookupOptions()) ?>;
	fticketadd.lists["x_LACode"] = <?php echo $ticket_add->LACode->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_LACode"].options = <?php echo JsonEncode($ticket_add->LACode->lookupOptions()) ?>;
	fticketadd.lists["x_DepartmentCode"] = <?php echo $ticket_add->DepartmentCode->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_DepartmentCode"].options = <?php echo JsonEncode($ticket_add->DepartmentCode->lookupOptions()) ?>;
	fticketadd.lists["x_AllocatedTo"] = <?php echo $ticket_add->AllocatedTo->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_AllocatedTo"].options = <?php echo JsonEncode($ticket_add->AllocatedTo->lookupOptions()) ?>;
	fticketadd.lists["x_EscalatedTo"] = <?php echo $ticket_add->EscalatedTo->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_EscalatedTo"].options = <?php echo JsonEncode($ticket_add->EscalatedTo->lookupOptions()) ?>;
	fticketadd.lists["x_SeverityLevel"] = <?php echo $ticket_add->SeverityLevel->Lookup->toClientList($ticket_add) ?>;
	fticketadd.lists["x_SeverityLevel"].options = <?php echo JsonEncode($ticket_add->SeverityLevel->lookupOptions()) ?>;
	loadjs.done("fticketadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_add->showPageHeader(); ?>
<?php
$ticket_add->showMessage();
?>
<form name="fticketadd" id="fticketadd" class="<?php echo $ticket_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($ticket_add->Subject->Visible) { // Subject ?>
	<div id="r_Subject" class="form-group row">
		<label id="elh_ticket_Subject" for="x_Subject" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->Subject->caption() ?><?php echo $ticket_add->Subject->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->Subject->cellAttributes() ?>>
<span id="el_ticket_Subject">
<input type="text" data-table="ticket" data-field="x_Subject" name="x_Subject" id="x_Subject" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_add->Subject->getPlaceHolder()) ?>" value="<?php echo $ticket_add->Subject->EditValue ?>"<?php echo $ticket_add->Subject->editAttributes() ?>>
</span>
<?php echo $ticket_add->Subject->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->TicketReportDate->Visible) { // TicketReportDate ?>
	<div id="r_TicketReportDate" class="form-group row">
		<label id="elh_ticket_TicketReportDate" for="x_TicketReportDate" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->TicketReportDate->caption() ?><?php echo $ticket_add->TicketReportDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->TicketReportDate->cellAttributes() ?>>
<span id="el_ticket_TicketReportDate">
<input type="text" data-table="ticket" data-field="x_TicketReportDate" name="x_TicketReportDate" id="x_TicketReportDate" placeholder="<?php echo HtmlEncode($ticket_add->TicketReportDate->getPlaceHolder()) ?>" value="<?php echo $ticket_add->TicketReportDate->EditValue ?>"<?php echo $ticket_add->TicketReportDate->editAttributes() ?>>
<?php if (!$ticket_add->TicketReportDate->ReadOnly && !$ticket_add->TicketReportDate->Disabled && !isset($ticket_add->TicketReportDate->EditAttrs["readonly"]) && !isset($ticket_add->TicketReportDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fticketadd", "x_TicketReportDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ticket_add->TicketReportDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->IncidentDate->Visible) { // IncidentDate ?>
	<div id="r_IncidentDate" class="form-group row">
		<label id="elh_ticket_IncidentDate" for="x_IncidentDate" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->IncidentDate->caption() ?><?php echo $ticket_add->IncidentDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->IncidentDate->cellAttributes() ?>>
<span id="el_ticket_IncidentDate">
<input type="text" data-table="ticket" data-field="x_IncidentDate" name="x_IncidentDate" id="x_IncidentDate" placeholder="<?php echo HtmlEncode($ticket_add->IncidentDate->getPlaceHolder()) ?>" value="<?php echo $ticket_add->IncidentDate->EditValue ?>"<?php echo $ticket_add->IncidentDate->editAttributes() ?>>
<?php if (!$ticket_add->IncidentDate->ReadOnly && !$ticket_add->IncidentDate->Disabled && !isset($ticket_add->IncidentDate->EditAttrs["readonly"]) && !isset($ticket_add->IncidentDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fticketadd", "x_IncidentDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ticket_add->IncidentDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->IncidentTime->Visible) { // IncidentTime ?>
	<div id="r_IncidentTime" class="form-group row">
		<label id="elh_ticket_IncidentTime" for="x_IncidentTime" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->IncidentTime->caption() ?><?php echo $ticket_add->IncidentTime->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->IncidentTime->cellAttributes() ?>>
<span id="el_ticket_IncidentTime">
<input type="text" data-table="ticket" data-field="x_IncidentTime" name="x_IncidentTime" id="x_IncidentTime" placeholder="<?php echo HtmlEncode($ticket_add->IncidentTime->getPlaceHolder()) ?>" value="<?php echo $ticket_add->IncidentTime->EditValue ?>"<?php echo $ticket_add->IncidentTime->editAttributes() ?>>
<?php if (!$ticket_add->IncidentTime->ReadOnly && !$ticket_add->IncidentTime->Disabled && !isset($ticket_add->IncidentTime->EditAttrs["readonly"]) && !isset($ticket_add->IncidentTime->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketadd", "timepicker"], function() {
	ew.createTimePicker("fticketadd", "x_IncidentTime", {"timeFormat":"H:i:s","step":15});
});
</script>
<?php } ?>
</span>
<?php echo $ticket_add->IncidentTime->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->TicketDescription->Visible) { // TicketDescription ?>
	<div id="r_TicketDescription" class="form-group row">
		<label id="elh_ticket_TicketDescription" for="x_TicketDescription" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->TicketDescription->caption() ?><?php echo $ticket_add->TicketDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->TicketDescription->cellAttributes() ?>>
<span id="el_ticket_TicketDescription">
<textarea data-table="ticket" data-field="x_TicketDescription" name="x_TicketDescription" id="x_TicketDescription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ticket_add->TicketDescription->getPlaceHolder()) ?>"<?php echo $ticket_add->TicketDescription->editAttributes() ?>><?php echo $ticket_add->TicketDescription->EditValue ?></textarea>
</span>
<?php echo $ticket_add->TicketDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->TicketCategory->Visible) { // TicketCategory ?>
	<div id="r_TicketCategory" class="form-group row">
		<label id="elh_ticket_TicketCategory" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->TicketCategory->caption() ?><?php echo $ticket_add->TicketCategory->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->TicketCategory->cellAttributes() ?>>
<span id="el_ticket_TicketCategory">
<?php
$onchange = $ticket_add->TicketCategory->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ticket_add->TicketCategory->EditAttrs["onchange"] = "";
?>
<span id="as_x_TicketCategory">
	<input type="text" class="form-control" name="sv_x_TicketCategory" id="sv_x_TicketCategory" value="<?php echo RemoveHtml($ticket_add->TicketCategory->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($ticket_add->TicketCategory->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ticket_add->TicketCategory->getPlaceHolder()) ?>"<?php echo $ticket_add->TicketCategory->editAttributes() ?>>
</span>
<input type="hidden" data-table="ticket" data-field="x_TicketCategory" data-value-separator="<?php echo $ticket_add->TicketCategory->displayValueSeparatorAttribute() ?>" name="x_TicketCategory" id="x_TicketCategory" value="<?php echo HtmlEncode($ticket_add->TicketCategory->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fticketadd"], function() {
	fticketadd.createAutoSuggest({"id":"x_TicketCategory","forceSelect":false});
});
</script>
<?php echo $ticket_add->TicketCategory->Lookup->getParamTag($ticket_add, "p_x_TicketCategory") ?>
</span>
<?php echo $ticket_add->TicketCategory->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->TicketType->Visible) { // TicketType ?>
	<div id="r_TicketType" class="form-group row">
		<label id="elh_ticket_TicketType" for="x_TicketType" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->TicketType->caption() ?><?php echo $ticket_add->TicketType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->TicketType->cellAttributes() ?>>
<span id="el_ticket_TicketType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_TicketType" data-value-separator="<?php echo $ticket_add->TicketType->displayValueSeparatorAttribute() ?>" id="x_TicketType" name="x_TicketType"<?php echo $ticket_add->TicketType->editAttributes() ?>>
			<?php echo $ticket_add->TicketType->selectOptionListHtml("x_TicketType") ?>
		</select>
</div>
<?php echo $ticket_add->TicketType->Lookup->getParamTag($ticket_add, "p_x_TicketType") ?>
</span>
<?php echo $ticket_add->TicketType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->ReportedBy->Visible) { // ReportedBy ?>
	<div id="r_ReportedBy" class="form-group row">
		<label id="elh_ticket_ReportedBy" for="x_ReportedBy" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->ReportedBy->caption() ?><?php echo $ticket_add->ReportedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->ReportedBy->cellAttributes() ?>>
<span id="el_ticket_ReportedBy">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ReportedBy"><?php echo EmptyValue(strval($ticket_add->ReportedBy->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_add->ReportedBy->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_add->ReportedBy->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_add->ReportedBy->ReadOnly || $ticket_add->ReportedBy->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ReportedBy',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_add->ReportedBy->Lookup->getParamTag($ticket_add, "p_x_ReportedBy") ?>
<input type="hidden" data-table="ticket" data-field="x_ReportedBy" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_add->ReportedBy->displayValueSeparatorAttribute() ?>" name="x_ReportedBy" id="x_ReportedBy" value="<?php echo $ticket_add->ReportedBy->CurrentValue ?>"<?php echo $ticket_add->ReportedBy->editAttributes() ?>>
</span>
<?php echo $ticket_add->ReportedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->TicketStatus->Visible) { // TicketStatus ?>
	<div id="r_TicketStatus" class="form-group row">
		<label id="elh_ticket_TicketStatus" for="x_TicketStatus" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->TicketStatus->caption() ?><?php echo $ticket_add->TicketStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->TicketStatus->cellAttributes() ?>>
<span id="el_ticket_TicketStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_TicketStatus" data-value-separator="<?php echo $ticket_add->TicketStatus->displayValueSeparatorAttribute() ?>" id="x_TicketStatus" name="x_TicketStatus"<?php echo $ticket_add->TicketStatus->editAttributes() ?>>
			<?php echo $ticket_add->TicketStatus->selectOptionListHtml("x_TicketStatus") ?>
		</select>
</div>
<?php echo $ticket_add->TicketStatus->Lookup->getParamTag($ticket_add, "p_x_TicketStatus") ?>
</span>
<?php echo $ticket_add->TicketStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->ReporterEmail->Visible) { // ReporterEmail ?>
	<div id="r_ReporterEmail" class="form-group row">
		<label id="elh_ticket_ReporterEmail" for="x_ReporterEmail" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->ReporterEmail->caption() ?><?php echo $ticket_add->ReporterEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->ReporterEmail->cellAttributes() ?>>
<span id="el_ticket_ReporterEmail">
<input type="text" data-table="ticket" data-field="x_ReporterEmail" name="x_ReporterEmail" id="x_ReporterEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_add->ReporterEmail->getPlaceHolder()) ?>" value="<?php echo $ticket_add->ReporterEmail->EditValue ?>"<?php echo $ticket_add->ReporterEmail->editAttributes() ?>>
</span>
<?php echo $ticket_add->ReporterEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->ReporterMobile->Visible) { // ReporterMobile ?>
	<div id="r_ReporterMobile" class="form-group row">
		<label id="elh_ticket_ReporterMobile" for="x_ReporterMobile" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->ReporterMobile->caption() ?><?php echo $ticket_add->ReporterMobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->ReporterMobile->cellAttributes() ?>>
<span id="el_ticket_ReporterMobile">
<input type="text" data-table="ticket" data-field="x_ReporterMobile" name="x_ReporterMobile" id="x_ReporterMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_add->ReporterMobile->getPlaceHolder()) ?>" value="<?php echo $ticket_add->ReporterMobile->EditValue ?>"<?php echo $ticket_add->ReporterMobile->editAttributes() ?>>
</span>
<?php echo $ticket_add->ReporterMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_ticket_ProvinceCode" for="x_ProvinceCode" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->ProvinceCode->caption() ?><?php echo $ticket_add->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->ProvinceCode->cellAttributes() ?>>
<span id="el_ticket_ProvinceCode">
<?php $ticket_add->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_ProvinceCode" data-value-separator="<?php echo $ticket_add->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $ticket_add->ProvinceCode->editAttributes() ?>>
			<?php echo $ticket_add->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $ticket_add->ProvinceCode->Lookup->getParamTag($ticket_add, "p_x_ProvinceCode") ?>
</span>
<?php echo $ticket_add->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_ticket_LACode" for="x_LACode" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->LACode->caption() ?><?php echo $ticket_add->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->LACode->cellAttributes() ?>>
<span id="el_ticket_LACode">
<?php $ticket_add->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($ticket_add->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_add->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_add->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_add->LACode->ReadOnly || $ticket_add->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_add->LACode->Lookup->getParamTag($ticket_add, "p_x_LACode") ?>
<input type="hidden" data-table="ticket" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_add->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $ticket_add->LACode->CurrentValue ?>"<?php echo $ticket_add->LACode->editAttributes() ?>>
</span>
<?php echo $ticket_add->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_ticket_DepartmentCode" for="x_DepartmentCode" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->DepartmentCode->caption() ?><?php echo $ticket_add->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->DepartmentCode->cellAttributes() ?>>
<span id="el_ticket_DepartmentCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($ticket_add->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_add->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_add->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_add->DepartmentCode->ReadOnly || $ticket_add->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_add->DepartmentCode->Lookup->getParamTag($ticket_add, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="ticket" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_add->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $ticket_add->DepartmentCode->CurrentValue ?>"<?php echo $ticket_add->DepartmentCode->editAttributes() ?>>
</span>
<?php echo $ticket_add->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->DeptSection->Visible) { // DeptSection ?>
	<div id="r_DeptSection" class="form-group row">
		<label id="elh_ticket_DeptSection" for="x_DeptSection" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->DeptSection->caption() ?><?php echo $ticket_add->DeptSection->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->DeptSection->cellAttributes() ?>>
<span id="el_ticket_DeptSection">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_DeptSection" data-value-separator="<?php echo $ticket_add->DeptSection->displayValueSeparatorAttribute() ?>" id="x_DeptSection" name="x_DeptSection"<?php echo $ticket_add->DeptSection->editAttributes() ?>>
			<?php echo $ticket_add->DeptSection->selectOptionListHtml("x_DeptSection") ?>
		</select>
</div>
</span>
<?php echo $ticket_add->DeptSection->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->TicketLevel->Visible) { // TicketLevel ?>
	<div id="r_TicketLevel" class="form-group row">
		<label id="elh_ticket_TicketLevel" for="x_TicketLevel" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->TicketLevel->caption() ?><?php echo $ticket_add->TicketLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->TicketLevel->cellAttributes() ?>>
<span id="el_ticket_TicketLevel">
<input type="text" data-table="ticket" data-field="x_TicketLevel" name="x_TicketLevel" id="x_TicketLevel" size="30" placeholder="<?php echo HtmlEncode($ticket_add->TicketLevel->getPlaceHolder()) ?>" value="<?php echo $ticket_add->TicketLevel->EditValue ?>"<?php echo $ticket_add->TicketLevel->editAttributes() ?>>
</span>
<?php echo $ticket_add->TicketLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->AllocatedTo->Visible) { // AllocatedTo ?>
	<div id="r_AllocatedTo" class="form-group row">
		<label id="elh_ticket_AllocatedTo" for="x_AllocatedTo" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->AllocatedTo->caption() ?><?php echo $ticket_add->AllocatedTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->AllocatedTo->cellAttributes() ?>>
<span id="el_ticket_AllocatedTo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AllocatedTo"><?php echo EmptyValue(strval($ticket_add->AllocatedTo->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_add->AllocatedTo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_add->AllocatedTo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_add->AllocatedTo->ReadOnly || $ticket_add->AllocatedTo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AllocatedTo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_add->AllocatedTo->Lookup->getParamTag($ticket_add, "p_x_AllocatedTo") ?>
<input type="hidden" data-table="ticket" data-field="x_AllocatedTo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_add->AllocatedTo->displayValueSeparatorAttribute() ?>" name="x_AllocatedTo" id="x_AllocatedTo" value="<?php echo $ticket_add->AllocatedTo->CurrentValue ?>"<?php echo $ticket_add->AllocatedTo->editAttributes() ?>>
</span>
<?php echo $ticket_add->AllocatedTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->EscalatedTo->Visible) { // EscalatedTo ?>
	<div id="r_EscalatedTo" class="form-group row">
		<label id="elh_ticket_EscalatedTo" for="x_EscalatedTo" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->EscalatedTo->caption() ?><?php echo $ticket_add->EscalatedTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->EscalatedTo->cellAttributes() ?>>
<span id="el_ticket_EscalatedTo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_EscalatedTo"><?php echo EmptyValue(strval($ticket_add->EscalatedTo->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_add->EscalatedTo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_add->EscalatedTo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_add->EscalatedTo->ReadOnly || $ticket_add->EscalatedTo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_EscalatedTo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_add->EscalatedTo->Lookup->getParamTag($ticket_add, "p_x_EscalatedTo") ?>
<input type="hidden" data-table="ticket" data-field="x_EscalatedTo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_add->EscalatedTo->displayValueSeparatorAttribute() ?>" name="x_EscalatedTo" id="x_EscalatedTo" value="<?php echo $ticket_add->EscalatedTo->CurrentValue ?>"<?php echo $ticket_add->EscalatedTo->editAttributes() ?>>
</span>
<?php echo $ticket_add->EscalatedTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->TicketSolution->Visible) { // TicketSolution ?>
	<div id="r_TicketSolution" class="form-group row">
		<label id="elh_ticket_TicketSolution" for="x_TicketSolution" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->TicketSolution->caption() ?><?php echo $ticket_add->TicketSolution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->TicketSolution->cellAttributes() ?>>
<span id="el_ticket_TicketSolution">
<textarea data-table="ticket" data-field="x_TicketSolution" name="x_TicketSolution" id="x_TicketSolution" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ticket_add->TicketSolution->getPlaceHolder()) ?>"<?php echo $ticket_add->TicketSolution->editAttributes() ?>><?php echo $ticket_add->TicketSolution->EditValue ?></textarea>
</span>
<?php echo $ticket_add->TicketSolution->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->Evidence->Visible) { // Evidence ?>
	<div id="r_Evidence" class="form-group row">
		<label id="elh_ticket_Evidence" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->Evidence->caption() ?><?php echo $ticket_add->Evidence->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->Evidence->cellAttributes() ?>>
<span id="el_ticket_Evidence">
<div id="fd_x_Evidence">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $ticket_add->Evidence->title() ?>" data-table="ticket" data-field="x_Evidence" name="x_Evidence" id="x_Evidence" lang="<?php echo CurrentLanguageID() ?>"<?php echo $ticket_add->Evidence->editAttributes() ?><?php if ($ticket_add->Evidence->ReadOnly || $ticket_add->Evidence->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Evidence"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Evidence" id= "fn_x_Evidence" value="<?php echo $ticket_add->Evidence->Upload->FileName ?>">
<input type="hidden" name="fa_x_Evidence" id= "fa_x_Evidence" value="0">
<input type="hidden" name="fs_x_Evidence" id= "fs_x_Evidence" value="0">
<input type="hidden" name="fx_x_Evidence" id= "fx_x_Evidence" value="<?php echo $ticket_add->Evidence->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Evidence" id= "fm_x_Evidence" value="<?php echo $ticket_add->Evidence->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Evidence" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $ticket_add->Evidence->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->SeverityLevel->Visible) { // SeverityLevel ?>
	<div id="r_SeverityLevel" class="form-group row">
		<label id="elh_ticket_SeverityLevel" for="x_SeverityLevel" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->SeverityLevel->caption() ?><?php echo $ticket_add->SeverityLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->SeverityLevel->cellAttributes() ?>>
<span id="el_ticket_SeverityLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_SeverityLevel" data-value-separator="<?php echo $ticket_add->SeverityLevel->displayValueSeparatorAttribute() ?>" id="x_SeverityLevel" name="x_SeverityLevel"<?php echo $ticket_add->SeverityLevel->editAttributes() ?>>
			<?php echo $ticket_add->SeverityLevel->selectOptionListHtml("x_SeverityLevel") ?>
		</select>
</div>
<?php echo $ticket_add->SeverityLevel->Lookup->getParamTag($ticket_add, "p_x_SeverityLevel") ?>
</span>
<?php echo $ticket_add->SeverityLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->Days->Visible) { // Days ?>
	<div id="r_Days" class="form-group row">
		<label id="elh_ticket_Days" for="x_Days" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->Days->caption() ?><?php echo $ticket_add->Days->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->Days->cellAttributes() ?>>
<span id="el_ticket_Days">
<input type="text" data-table="ticket" data-field="x_Days" name="x_Days" id="x_Days" size="30" placeholder="<?php echo HtmlEncode($ticket_add->Days->getPlaceHolder()) ?>" value="<?php echo $ticket_add->Days->EditValue ?>"<?php echo $ticket_add->Days->editAttributes() ?>>
</span>
<?php echo $ticket_add->Days->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_add->DataLastUpdated->Visible) { // DataLastUpdated ?>
	<div id="r_DataLastUpdated" class="form-group row">
		<label id="elh_ticket_DataLastUpdated" for="x_DataLastUpdated" class="<?php echo $ticket_add->LeftColumnClass ?>"><?php echo $ticket_add->DataLastUpdated->caption() ?><?php echo $ticket_add->DataLastUpdated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_add->RightColumnClass ?>"><div <?php echo $ticket_add->DataLastUpdated->cellAttributes() ?>>
<span id="el_ticket_DataLastUpdated">
<input type="text" data-table="ticket" data-field="x_DataLastUpdated" name="x_DataLastUpdated" id="x_DataLastUpdated" placeholder="<?php echo HtmlEncode($ticket_add->DataLastUpdated->getPlaceHolder()) ?>" value="<?php echo $ticket_add->DataLastUpdated->EditValue ?>"<?php echo $ticket_add->DataLastUpdated->editAttributes() ?>>
</span>
<?php echo $ticket_add->DataLastUpdated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("ticketmessage", explode(",", $ticket->getCurrentDetailTable())) && $ticketmessage->DetailAdd) {
?>
<?php if ($ticket->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ticketmessage", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ticketmessagegrid.php" ?>
<?php } ?>
<?php if (!$ticket_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ticket_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticket_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ticket_add->showPageFooter();
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
$ticket_add->terminate();
?>