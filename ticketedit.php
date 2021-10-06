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
$ticket_edit = new ticket_edit();

// Run the page
$ticket_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticketedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fticketedit = currentForm = new ew.Form("fticketedit", "edit");

	// Validate form
	fticketedit.validate = function() {
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
			<?php if ($ticket_edit->Subject->Required) { ?>
				elm = this.getElements("x" + infix + "_Subject");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->Subject->caption(), $ticket_edit->Subject->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->TicketReportDate->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketReportDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->TicketReportDate->caption(), $ticket_edit->TicketReportDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TicketReportDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_edit->TicketReportDate->errorMessage()) ?>");
			<?php if ($ticket_edit->IncidentDate->Required) { ?>
				elm = this.getElements("x" + infix + "_IncidentDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->IncidentDate->caption(), $ticket_edit->IncidentDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IncidentDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_edit->IncidentDate->errorMessage()) ?>");
			<?php if ($ticket_edit->IncidentTime->Required) { ?>
				elm = this.getElements("x" + infix + "_IncidentTime");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->IncidentTime->caption(), $ticket_edit->IncidentTime->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_IncidentTime");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_edit->IncidentTime->errorMessage()) ?>");
			<?php if ($ticket_edit->TicketDescription->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketDescription");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->TicketDescription->caption(), $ticket_edit->TicketDescription->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->TicketCategory->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketCategory");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->TicketCategory->caption(), $ticket_edit->TicketCategory->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TicketCategory");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_edit->TicketCategory->errorMessage()) ?>");
			<?php if ($ticket_edit->TicketType->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketType");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->TicketType->caption(), $ticket_edit->TicketType->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->ReportedBy->Required) { ?>
				elm = this.getElements("x" + infix + "_ReportedBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->ReportedBy->caption(), $ticket_edit->ReportedBy->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->TicketStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->TicketStatus->caption(), $ticket_edit->TicketStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->TicketNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->TicketNumber->caption(), $ticket_edit->TicketNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->ReporterEmail->Required) { ?>
				elm = this.getElements("x" + infix + "_ReporterEmail");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->ReporterEmail->caption(), $ticket_edit->ReporterEmail->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ReporterEmail");
				if (elm && !ew.checkEmail(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_edit->ReporterEmail->errorMessage()) ?>");
			<?php if ($ticket_edit->ReporterMobile->Required) { ?>
				elm = this.getElements("x" + infix + "_ReporterMobile");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->ReporterMobile->caption(), $ticket_edit->ReporterMobile->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->ProvinceCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ProvinceCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->ProvinceCode->caption(), $ticket_edit->ProvinceCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->LACode->Required) { ?>
				elm = this.getElements("x" + infix + "_LACode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->LACode->caption(), $ticket_edit->LACode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->DepartmentCode->Required) { ?>
				elm = this.getElements("x" + infix + "_DepartmentCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->DepartmentCode->caption(), $ticket_edit->DepartmentCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->DeptSection->Required) { ?>
				elm = this.getElements("x" + infix + "_DeptSection");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->DeptSection->caption(), $ticket_edit->DeptSection->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->TicketLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->TicketLevel->caption(), $ticket_edit->TicketLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TicketLevel");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_edit->TicketLevel->errorMessage()) ?>");
			<?php if ($ticket_edit->AllocatedTo->Required) { ?>
				elm = this.getElements("x" + infix + "_AllocatedTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->AllocatedTo->caption(), $ticket_edit->AllocatedTo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->EscalatedTo->Required) { ?>
				elm = this.getElements("x" + infix + "_EscalatedTo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->EscalatedTo->caption(), $ticket_edit->EscalatedTo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->TicketSolution->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketSolution");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->TicketSolution->caption(), $ticket_edit->TicketSolution->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->Evidence->Required) { ?>
				felm = this.getElements("x" + infix + "_Evidence");
				elm = this.getElements("fn_x" + infix + "_Evidence");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->Evidence->caption(), $ticket_edit->Evidence->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->SeverityLevel->Required) { ?>
				elm = this.getElements("x" + infix + "_SeverityLevel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->SeverityLevel->caption(), $ticket_edit->SeverityLevel->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_edit->Days->Required) { ?>
				elm = this.getElements("x" + infix + "_Days");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->Days->caption(), $ticket_edit->Days->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_Days");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_edit->Days->errorMessage()) ?>");
			<?php if ($ticket_edit->DataLastUpdated->Required) { ?>
				elm = this.getElements("x" + infix + "_DataLastUpdated");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_edit->DataLastUpdated->caption(), $ticket_edit->DataLastUpdated->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_DataLastUpdated");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticket_edit->DataLastUpdated->errorMessage()) ?>");

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
	fticketedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fticketedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fticketedit.lists["x_TicketCategory"] = <?php echo $ticket_edit->TicketCategory->Lookup->toClientList($ticket_edit) ?>;
	fticketedit.lists["x_TicketCategory"].options = <?php echo JsonEncode($ticket_edit->TicketCategory->lookupOptions()) ?>;
	fticketedit.autoSuggests["x_TicketCategory"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fticketedit.lists["x_TicketType"] = <?php echo $ticket_edit->TicketType->Lookup->toClientList($ticket_edit) ?>;
	fticketedit.lists["x_TicketType"].options = <?php echo JsonEncode($ticket_edit->TicketType->lookupOptions()) ?>;
	fticketedit.lists["x_ReportedBy"] = <?php echo $ticket_edit->ReportedBy->Lookup->toClientList($ticket_edit) ?>;
	fticketedit.lists["x_ReportedBy"].options = <?php echo JsonEncode($ticket_edit->ReportedBy->lookupOptions()) ?>;
	fticketedit.lists["x_TicketStatus"] = <?php echo $ticket_edit->TicketStatus->Lookup->toClientList($ticket_edit) ?>;
	fticketedit.lists["x_TicketStatus"].options = <?php echo JsonEncode($ticket_edit->TicketStatus->lookupOptions()) ?>;
	fticketedit.lists["x_ProvinceCode"] = <?php echo $ticket_edit->ProvinceCode->Lookup->toClientList($ticket_edit) ?>;
	fticketedit.lists["x_ProvinceCode"].options = <?php echo JsonEncode($ticket_edit->ProvinceCode->lookupOptions()) ?>;
	fticketedit.lists["x_LACode"] = <?php echo $ticket_edit->LACode->Lookup->toClientList($ticket_edit) ?>;
	fticketedit.lists["x_LACode"].options = <?php echo JsonEncode($ticket_edit->LACode->lookupOptions()) ?>;
	fticketedit.lists["x_DepartmentCode"] = <?php echo $ticket_edit->DepartmentCode->Lookup->toClientList($ticket_edit) ?>;
	fticketedit.lists["x_DepartmentCode"].options = <?php echo JsonEncode($ticket_edit->DepartmentCode->lookupOptions()) ?>;
	fticketedit.lists["x_AllocatedTo"] = <?php echo $ticket_edit->AllocatedTo->Lookup->toClientList($ticket_edit) ?>;
	fticketedit.lists["x_AllocatedTo"].options = <?php echo JsonEncode($ticket_edit->AllocatedTo->lookupOptions()) ?>;
	fticketedit.lists["x_EscalatedTo"] = <?php echo $ticket_edit->EscalatedTo->Lookup->toClientList($ticket_edit) ?>;
	fticketedit.lists["x_EscalatedTo"].options = <?php echo JsonEncode($ticket_edit->EscalatedTo->lookupOptions()) ?>;
	fticketedit.lists["x_SeverityLevel"] = <?php echo $ticket_edit->SeverityLevel->Lookup->toClientList($ticket_edit) ?>;
	fticketedit.lists["x_SeverityLevel"].options = <?php echo JsonEncode($ticket_edit->SeverityLevel->lookupOptions()) ?>;
	loadjs.done("fticketedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_edit->showPageHeader(); ?>
<?php
$ticket_edit->showMessage();
?>
<?php if (!$ticket_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fticketedit" id="fticketedit" class="<?php echo $ticket_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($ticket_edit->Subject->Visible) { // Subject ?>
	<div id="r_Subject" class="form-group row">
		<label id="elh_ticket_Subject" for="x_Subject" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->Subject->caption() ?><?php echo $ticket_edit->Subject->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->Subject->cellAttributes() ?>>
<span id="el_ticket_Subject">
<input type="text" data-table="ticket" data-field="x_Subject" name="x_Subject" id="x_Subject" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_edit->Subject->getPlaceHolder()) ?>" value="<?php echo $ticket_edit->Subject->EditValue ?>"<?php echo $ticket_edit->Subject->editAttributes() ?>>
</span>
<?php echo $ticket_edit->Subject->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->TicketReportDate->Visible) { // TicketReportDate ?>
	<div id="r_TicketReportDate" class="form-group row">
		<label id="elh_ticket_TicketReportDate" for="x_TicketReportDate" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->TicketReportDate->caption() ?><?php echo $ticket_edit->TicketReportDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->TicketReportDate->cellAttributes() ?>>
<span id="el_ticket_TicketReportDate">
<input type="text" data-table="ticket" data-field="x_TicketReportDate" name="x_TicketReportDate" id="x_TicketReportDate" placeholder="<?php echo HtmlEncode($ticket_edit->TicketReportDate->getPlaceHolder()) ?>" value="<?php echo $ticket_edit->TicketReportDate->EditValue ?>"<?php echo $ticket_edit->TicketReportDate->editAttributes() ?>>
<?php if (!$ticket_edit->TicketReportDate->ReadOnly && !$ticket_edit->TicketReportDate->Disabled && !isset($ticket_edit->TicketReportDate->EditAttrs["readonly"]) && !isset($ticket_edit->TicketReportDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fticketedit", "x_TicketReportDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ticket_edit->TicketReportDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->IncidentDate->Visible) { // IncidentDate ?>
	<div id="r_IncidentDate" class="form-group row">
		<label id="elh_ticket_IncidentDate" for="x_IncidentDate" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->IncidentDate->caption() ?><?php echo $ticket_edit->IncidentDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->IncidentDate->cellAttributes() ?>>
<span id="el_ticket_IncidentDate">
<input type="text" data-table="ticket" data-field="x_IncidentDate" name="x_IncidentDate" id="x_IncidentDate" placeholder="<?php echo HtmlEncode($ticket_edit->IncidentDate->getPlaceHolder()) ?>" value="<?php echo $ticket_edit->IncidentDate->EditValue ?>"<?php echo $ticket_edit->IncidentDate->editAttributes() ?>>
<?php if (!$ticket_edit->IncidentDate->ReadOnly && !$ticket_edit->IncidentDate->Disabled && !isset($ticket_edit->IncidentDate->EditAttrs["readonly"]) && !isset($ticket_edit->IncidentDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fticketedit", "x_IncidentDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ticket_edit->IncidentDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->IncidentTime->Visible) { // IncidentTime ?>
	<div id="r_IncidentTime" class="form-group row">
		<label id="elh_ticket_IncidentTime" for="x_IncidentTime" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->IncidentTime->caption() ?><?php echo $ticket_edit->IncidentTime->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->IncidentTime->cellAttributes() ?>>
<span id="el_ticket_IncidentTime">
<input type="text" data-table="ticket" data-field="x_IncidentTime" name="x_IncidentTime" id="x_IncidentTime" placeholder="<?php echo HtmlEncode($ticket_edit->IncidentTime->getPlaceHolder()) ?>" value="<?php echo $ticket_edit->IncidentTime->EditValue ?>"<?php echo $ticket_edit->IncidentTime->editAttributes() ?>>
<?php if (!$ticket_edit->IncidentTime->ReadOnly && !$ticket_edit->IncidentTime->Disabled && !isset($ticket_edit->IncidentTime->EditAttrs["readonly"]) && !isset($ticket_edit->IncidentTime->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketedit", "timepicker"], function() {
	ew.createTimePicker("fticketedit", "x_IncidentTime", {"timeFormat":"H:i:s","step":15});
});
</script>
<?php } ?>
</span>
<?php echo $ticket_edit->IncidentTime->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->TicketDescription->Visible) { // TicketDescription ?>
	<div id="r_TicketDescription" class="form-group row">
		<label id="elh_ticket_TicketDescription" for="x_TicketDescription" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->TicketDescription->caption() ?><?php echo $ticket_edit->TicketDescription->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->TicketDescription->cellAttributes() ?>>
<span id="el_ticket_TicketDescription">
<textarea data-table="ticket" data-field="x_TicketDescription" name="x_TicketDescription" id="x_TicketDescription" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ticket_edit->TicketDescription->getPlaceHolder()) ?>"<?php echo $ticket_edit->TicketDescription->editAttributes() ?>><?php echo $ticket_edit->TicketDescription->EditValue ?></textarea>
</span>
<?php echo $ticket_edit->TicketDescription->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->TicketCategory->Visible) { // TicketCategory ?>
	<div id="r_TicketCategory" class="form-group row">
		<label id="elh_ticket_TicketCategory" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->TicketCategory->caption() ?><?php echo $ticket_edit->TicketCategory->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->TicketCategory->cellAttributes() ?>>
<span id="el_ticket_TicketCategory">
<?php
$onchange = $ticket_edit->TicketCategory->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$ticket_edit->TicketCategory->EditAttrs["onchange"] = "";
?>
<span id="as_x_TicketCategory">
	<input type="text" class="form-control" name="sv_x_TicketCategory" id="sv_x_TicketCategory" value="<?php echo RemoveHtml($ticket_edit->TicketCategory->EditValue) ?>" size="30" placeholder="<?php echo HtmlEncode($ticket_edit->TicketCategory->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($ticket_edit->TicketCategory->getPlaceHolder()) ?>"<?php echo $ticket_edit->TicketCategory->editAttributes() ?>>
</span>
<input type="hidden" data-table="ticket" data-field="x_TicketCategory" data-value-separator="<?php echo $ticket_edit->TicketCategory->displayValueSeparatorAttribute() ?>" name="x_TicketCategory" id="x_TicketCategory" value="<?php echo HtmlEncode($ticket_edit->TicketCategory->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fticketedit"], function() {
	fticketedit.createAutoSuggest({"id":"x_TicketCategory","forceSelect":false});
});
</script>
<?php echo $ticket_edit->TicketCategory->Lookup->getParamTag($ticket_edit, "p_x_TicketCategory") ?>
</span>
<?php echo $ticket_edit->TicketCategory->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->TicketType->Visible) { // TicketType ?>
	<div id="r_TicketType" class="form-group row">
		<label id="elh_ticket_TicketType" for="x_TicketType" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->TicketType->caption() ?><?php echo $ticket_edit->TicketType->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->TicketType->cellAttributes() ?>>
<span id="el_ticket_TicketType">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_TicketType" data-value-separator="<?php echo $ticket_edit->TicketType->displayValueSeparatorAttribute() ?>" id="x_TicketType" name="x_TicketType"<?php echo $ticket_edit->TicketType->editAttributes() ?>>
			<?php echo $ticket_edit->TicketType->selectOptionListHtml("x_TicketType") ?>
		</select>
</div>
<?php echo $ticket_edit->TicketType->Lookup->getParamTag($ticket_edit, "p_x_TicketType") ?>
</span>
<?php echo $ticket_edit->TicketType->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->ReportedBy->Visible) { // ReportedBy ?>
	<div id="r_ReportedBy" class="form-group row">
		<label id="elh_ticket_ReportedBy" for="x_ReportedBy" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->ReportedBy->caption() ?><?php echo $ticket_edit->ReportedBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->ReportedBy->cellAttributes() ?>>
<span id="el_ticket_ReportedBy">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_ReportedBy"><?php echo EmptyValue(strval($ticket_edit->ReportedBy->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_edit->ReportedBy->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_edit->ReportedBy->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_edit->ReportedBy->ReadOnly || $ticket_edit->ReportedBy->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_ReportedBy',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_edit->ReportedBy->Lookup->getParamTag($ticket_edit, "p_x_ReportedBy") ?>
<input type="hidden" data-table="ticket" data-field="x_ReportedBy" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_edit->ReportedBy->displayValueSeparatorAttribute() ?>" name="x_ReportedBy" id="x_ReportedBy" value="<?php echo $ticket_edit->ReportedBy->CurrentValue ?>"<?php echo $ticket_edit->ReportedBy->editAttributes() ?>>
</span>
<?php echo $ticket_edit->ReportedBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->TicketStatus->Visible) { // TicketStatus ?>
	<div id="r_TicketStatus" class="form-group row">
		<label id="elh_ticket_TicketStatus" for="x_TicketStatus" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->TicketStatus->caption() ?><?php echo $ticket_edit->TicketStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->TicketStatus->cellAttributes() ?>>
<span id="el_ticket_TicketStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_TicketStatus" data-value-separator="<?php echo $ticket_edit->TicketStatus->displayValueSeparatorAttribute() ?>" id="x_TicketStatus" name="x_TicketStatus"<?php echo $ticket_edit->TicketStatus->editAttributes() ?>>
			<?php echo $ticket_edit->TicketStatus->selectOptionListHtml("x_TicketStatus") ?>
		</select>
</div>
<?php echo $ticket_edit->TicketStatus->Lookup->getParamTag($ticket_edit, "p_x_TicketStatus") ?>
</span>
<?php echo $ticket_edit->TicketStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->TicketNumber->Visible) { // TicketNumber ?>
	<div id="r_TicketNumber" class="form-group row">
		<label id="elh_ticket_TicketNumber" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->TicketNumber->caption() ?><?php echo $ticket_edit->TicketNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->TicketNumber->cellAttributes() ?>>
<span id="el_ticket_TicketNumber">
<span<?php echo $ticket_edit->TicketNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticket_edit->TicketNumber->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ticket" data-field="x_TicketNumber" name="x_TicketNumber" id="x_TicketNumber" value="<?php echo HtmlEncode($ticket_edit->TicketNumber->CurrentValue) ?>">
<?php echo $ticket_edit->TicketNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->ReporterEmail->Visible) { // ReporterEmail ?>
	<div id="r_ReporterEmail" class="form-group row">
		<label id="elh_ticket_ReporterEmail" for="x_ReporterEmail" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->ReporterEmail->caption() ?><?php echo $ticket_edit->ReporterEmail->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->ReporterEmail->cellAttributes() ?>>
<span id="el_ticket_ReporterEmail">
<input type="text" data-table="ticket" data-field="x_ReporterEmail" name="x_ReporterEmail" id="x_ReporterEmail" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_edit->ReporterEmail->getPlaceHolder()) ?>" value="<?php echo $ticket_edit->ReporterEmail->EditValue ?>"<?php echo $ticket_edit->ReporterEmail->editAttributes() ?>>
</span>
<?php echo $ticket_edit->ReporterEmail->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->ReporterMobile->Visible) { // ReporterMobile ?>
	<div id="r_ReporterMobile" class="form-group row">
		<label id="elh_ticket_ReporterMobile" for="x_ReporterMobile" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->ReporterMobile->caption() ?><?php echo $ticket_edit->ReporterMobile->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->ReporterMobile->cellAttributes() ?>>
<span id="el_ticket_ReporterMobile">
<input type="text" data-table="ticket" data-field="x_ReporterMobile" name="x_ReporterMobile" id="x_ReporterMobile" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_edit->ReporterMobile->getPlaceHolder()) ?>" value="<?php echo $ticket_edit->ReporterMobile->EditValue ?>"<?php echo $ticket_edit->ReporterMobile->editAttributes() ?>>
</span>
<?php echo $ticket_edit->ReporterMobile->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->ProvinceCode->Visible) { // ProvinceCode ?>
	<div id="r_ProvinceCode" class="form-group row">
		<label id="elh_ticket_ProvinceCode" for="x_ProvinceCode" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->ProvinceCode->caption() ?><?php echo $ticket_edit->ProvinceCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->ProvinceCode->cellAttributes() ?>>
<span id="el_ticket_ProvinceCode">
<?php $ticket_edit->ProvinceCode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_ProvinceCode" data-value-separator="<?php echo $ticket_edit->ProvinceCode->displayValueSeparatorAttribute() ?>" id="x_ProvinceCode" name="x_ProvinceCode"<?php echo $ticket_edit->ProvinceCode->editAttributes() ?>>
			<?php echo $ticket_edit->ProvinceCode->selectOptionListHtml("x_ProvinceCode") ?>
		</select>
</div>
<?php echo $ticket_edit->ProvinceCode->Lookup->getParamTag($ticket_edit, "p_x_ProvinceCode") ?>
</span>
<?php echo $ticket_edit->ProvinceCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->LACode->Visible) { // LACode ?>
	<div id="r_LACode" class="form-group row">
		<label id="elh_ticket_LACode" for="x_LACode" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->LACode->caption() ?><?php echo $ticket_edit->LACode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->LACode->cellAttributes() ?>>
<span id="el_ticket_LACode">
<?php $ticket_edit->LACode->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_LACode"><?php echo EmptyValue(strval($ticket_edit->LACode->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_edit->LACode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_edit->LACode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_edit->LACode->ReadOnly || $ticket_edit->LACode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_LACode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_edit->LACode->Lookup->getParamTag($ticket_edit, "p_x_LACode") ?>
<input type="hidden" data-table="ticket" data-field="x_LACode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_edit->LACode->displayValueSeparatorAttribute() ?>" name="x_LACode" id="x_LACode" value="<?php echo $ticket_edit->LACode->CurrentValue ?>"<?php echo $ticket_edit->LACode->editAttributes() ?>>
</span>
<?php echo $ticket_edit->LACode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->DepartmentCode->Visible) { // DepartmentCode ?>
	<div id="r_DepartmentCode" class="form-group row">
		<label id="elh_ticket_DepartmentCode" for="x_DepartmentCode" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->DepartmentCode->caption() ?><?php echo $ticket_edit->DepartmentCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->DepartmentCode->cellAttributes() ?>>
<span id="el_ticket_DepartmentCode">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_DepartmentCode"><?php echo EmptyValue(strval($ticket_edit->DepartmentCode->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_edit->DepartmentCode->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_edit->DepartmentCode->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_edit->DepartmentCode->ReadOnly || $ticket_edit->DepartmentCode->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_DepartmentCode',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_edit->DepartmentCode->Lookup->getParamTag($ticket_edit, "p_x_DepartmentCode") ?>
<input type="hidden" data-table="ticket" data-field="x_DepartmentCode" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_edit->DepartmentCode->displayValueSeparatorAttribute() ?>" name="x_DepartmentCode" id="x_DepartmentCode" value="<?php echo $ticket_edit->DepartmentCode->CurrentValue ?>"<?php echo $ticket_edit->DepartmentCode->editAttributes() ?>>
</span>
<?php echo $ticket_edit->DepartmentCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->DeptSection->Visible) { // DeptSection ?>
	<div id="r_DeptSection" class="form-group row">
		<label id="elh_ticket_DeptSection" for="x_DeptSection" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->DeptSection->caption() ?><?php echo $ticket_edit->DeptSection->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->DeptSection->cellAttributes() ?>>
<span id="el_ticket_DeptSection">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_DeptSection" data-value-separator="<?php echo $ticket_edit->DeptSection->displayValueSeparatorAttribute() ?>" id="x_DeptSection" name="x_DeptSection"<?php echo $ticket_edit->DeptSection->editAttributes() ?>>
			<?php echo $ticket_edit->DeptSection->selectOptionListHtml("x_DeptSection") ?>
		</select>
</div>
</span>
<?php echo $ticket_edit->DeptSection->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->TicketLevel->Visible) { // TicketLevel ?>
	<div id="r_TicketLevel" class="form-group row">
		<label id="elh_ticket_TicketLevel" for="x_TicketLevel" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->TicketLevel->caption() ?><?php echo $ticket_edit->TicketLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->TicketLevel->cellAttributes() ?>>
<span id="el_ticket_TicketLevel">
<input type="text" data-table="ticket" data-field="x_TicketLevel" name="x_TicketLevel" id="x_TicketLevel" size="30" placeholder="<?php echo HtmlEncode($ticket_edit->TicketLevel->getPlaceHolder()) ?>" value="<?php echo $ticket_edit->TicketLevel->EditValue ?>"<?php echo $ticket_edit->TicketLevel->editAttributes() ?>>
</span>
<?php echo $ticket_edit->TicketLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->AllocatedTo->Visible) { // AllocatedTo ?>
	<div id="r_AllocatedTo" class="form-group row">
		<label id="elh_ticket_AllocatedTo" for="x_AllocatedTo" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->AllocatedTo->caption() ?><?php echo $ticket_edit->AllocatedTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->AllocatedTo->cellAttributes() ?>>
<span id="el_ticket_AllocatedTo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_AllocatedTo"><?php echo EmptyValue(strval($ticket_edit->AllocatedTo->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_edit->AllocatedTo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_edit->AllocatedTo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_edit->AllocatedTo->ReadOnly || $ticket_edit->AllocatedTo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_AllocatedTo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_edit->AllocatedTo->Lookup->getParamTag($ticket_edit, "p_x_AllocatedTo") ?>
<input type="hidden" data-table="ticket" data-field="x_AllocatedTo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_edit->AllocatedTo->displayValueSeparatorAttribute() ?>" name="x_AllocatedTo" id="x_AllocatedTo" value="<?php echo $ticket_edit->AllocatedTo->CurrentValue ?>"<?php echo $ticket_edit->AllocatedTo->editAttributes() ?>>
</span>
<?php echo $ticket_edit->AllocatedTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->EscalatedTo->Visible) { // EscalatedTo ?>
	<div id="r_EscalatedTo" class="form-group row">
		<label id="elh_ticket_EscalatedTo" for="x_EscalatedTo" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->EscalatedTo->caption() ?><?php echo $ticket_edit->EscalatedTo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->EscalatedTo->cellAttributes() ?>>
<span id="el_ticket_EscalatedTo">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_EscalatedTo"><?php echo EmptyValue(strval($ticket_edit->EscalatedTo->ViewValue)) ? $Language->phrase("PleaseSelect") : $ticket_edit->EscalatedTo->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($ticket_edit->EscalatedTo->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($ticket_edit->EscalatedTo->ReadOnly || $ticket_edit->EscalatedTo->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_EscalatedTo',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $ticket_edit->EscalatedTo->Lookup->getParamTag($ticket_edit, "p_x_EscalatedTo") ?>
<input type="hidden" data-table="ticket" data-field="x_EscalatedTo" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $ticket_edit->EscalatedTo->displayValueSeparatorAttribute() ?>" name="x_EscalatedTo" id="x_EscalatedTo" value="<?php echo $ticket_edit->EscalatedTo->CurrentValue ?>"<?php echo $ticket_edit->EscalatedTo->editAttributes() ?>>
</span>
<?php echo $ticket_edit->EscalatedTo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->TicketSolution->Visible) { // TicketSolution ?>
	<div id="r_TicketSolution" class="form-group row">
		<label id="elh_ticket_TicketSolution" for="x_TicketSolution" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->TicketSolution->caption() ?><?php echo $ticket_edit->TicketSolution->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->TicketSolution->cellAttributes() ?>>
<span id="el_ticket_TicketSolution">
<textarea data-table="ticket" data-field="x_TicketSolution" name="x_TicketSolution" id="x_TicketSolution" cols="35" rows="4" placeholder="<?php echo HtmlEncode($ticket_edit->TicketSolution->getPlaceHolder()) ?>"<?php echo $ticket_edit->TicketSolution->editAttributes() ?>><?php echo $ticket_edit->TicketSolution->EditValue ?></textarea>
</span>
<?php echo $ticket_edit->TicketSolution->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->Evidence->Visible) { // Evidence ?>
	<div id="r_Evidence" class="form-group row">
		<label id="elh_ticket_Evidence" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->Evidence->caption() ?><?php echo $ticket_edit->Evidence->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->Evidence->cellAttributes() ?>>
<span id="el_ticket_Evidence">
<div id="fd_x_Evidence">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $ticket_edit->Evidence->title() ?>" data-table="ticket" data-field="x_Evidence" name="x_Evidence" id="x_Evidence" lang="<?php echo CurrentLanguageID() ?>"<?php echo $ticket_edit->Evidence->editAttributes() ?><?php if ($ticket_edit->Evidence->ReadOnly || $ticket_edit->Evidence->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Evidence"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Evidence" id= "fn_x_Evidence" value="<?php echo $ticket_edit->Evidence->Upload->FileName ?>">
<input type="hidden" name="fa_x_Evidence" id= "fa_x_Evidence" value="<?php echo (Post("fa_x_Evidence") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Evidence" id= "fs_x_Evidence" value="0">
<input type="hidden" name="fx_x_Evidence" id= "fx_x_Evidence" value="<?php echo $ticket_edit->Evidence->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Evidence" id= "fm_x_Evidence" value="<?php echo $ticket_edit->Evidence->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Evidence" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $ticket_edit->Evidence->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->SeverityLevel->Visible) { // SeverityLevel ?>
	<div id="r_SeverityLevel" class="form-group row">
		<label id="elh_ticket_SeverityLevel" for="x_SeverityLevel" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->SeverityLevel->caption() ?><?php echo $ticket_edit->SeverityLevel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->SeverityLevel->cellAttributes() ?>>
<span id="el_ticket_SeverityLevel">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket" data-field="x_SeverityLevel" data-value-separator="<?php echo $ticket_edit->SeverityLevel->displayValueSeparatorAttribute() ?>" id="x_SeverityLevel" name="x_SeverityLevel"<?php echo $ticket_edit->SeverityLevel->editAttributes() ?>>
			<?php echo $ticket_edit->SeverityLevel->selectOptionListHtml("x_SeverityLevel") ?>
		</select>
</div>
<?php echo $ticket_edit->SeverityLevel->Lookup->getParamTag($ticket_edit, "p_x_SeverityLevel") ?>
</span>
<?php echo $ticket_edit->SeverityLevel->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->Days->Visible) { // Days ?>
	<div id="r_Days" class="form-group row">
		<label id="elh_ticket_Days" for="x_Days" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->Days->caption() ?><?php echo $ticket_edit->Days->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->Days->cellAttributes() ?>>
<span id="el_ticket_Days">
<input type="text" data-table="ticket" data-field="x_Days" name="x_Days" id="x_Days" size="30" placeholder="<?php echo HtmlEncode($ticket_edit->Days->getPlaceHolder()) ?>" value="<?php echo $ticket_edit->Days->EditValue ?>"<?php echo $ticket_edit->Days->editAttributes() ?>>
</span>
<?php echo $ticket_edit->Days->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_edit->DataLastUpdated->Visible) { // DataLastUpdated ?>
	<div id="r_DataLastUpdated" class="form-group row">
		<label id="elh_ticket_DataLastUpdated" for="x_DataLastUpdated" class="<?php echo $ticket_edit->LeftColumnClass ?>"><?php echo $ticket_edit->DataLastUpdated->caption() ?><?php echo $ticket_edit->DataLastUpdated->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_edit->RightColumnClass ?>"><div <?php echo $ticket_edit->DataLastUpdated->cellAttributes() ?>>
<span id="el_ticket_DataLastUpdated">
<input type="text" data-table="ticket" data-field="x_DataLastUpdated" name="x_DataLastUpdated" id="x_DataLastUpdated" placeholder="<?php echo HtmlEncode($ticket_edit->DataLastUpdated->getPlaceHolder()) ?>" value="<?php echo $ticket_edit->DataLastUpdated->EditValue ?>"<?php echo $ticket_edit->DataLastUpdated->editAttributes() ?>>
</span>
<?php echo $ticket_edit->DataLastUpdated->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php
	if (in_array("ticketmessage", explode(",", $ticket->getCurrentDetailTable())) && $ticketmessage->DetailEdit) {
?>
<?php if ($ticket->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("ticketmessage", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "ticketmessagegrid.php" ?>
<?php } ?>
<?php if (!$ticket_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ticket_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticket_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ticket_edit->IsModal) { ?>
<?php echo $ticket_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$ticket_edit->showPageFooter();
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
$ticket_edit->terminate();
?>