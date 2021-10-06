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
$ticketmessage_edit = new ticketmessage_edit();

// Run the page
$ticketmessage_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticketmessage_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticketmessageedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fticketmessageedit = currentForm = new ew.Form("fticketmessageedit", "edit");

	// Validate form
	fticketmessageedit.validate = function() {
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
			<?php if ($ticketmessage_edit->TicketNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_edit->TicketNumber->caption(), $ticketmessage_edit->TicketNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_TicketNumber");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticketmessage_edit->TicketNumber->errorMessage()) ?>");
			<?php if ($ticketmessage_edit->MessageNumber->Required) { ?>
				elm = this.getElements("x" + infix + "_MessageNumber");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_edit->MessageNumber->caption(), $ticketmessage_edit->MessageNumber->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticketmessage_edit->MessageBy->Required) { ?>
				elm = this.getElements("x" + infix + "_MessageBy");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_edit->MessageBy->caption(), $ticketmessage_edit->MessageBy->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MessageBy");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticketmessage_edit->MessageBy->errorMessage()) ?>");
			<?php if ($ticketmessage_edit->Subject->Required) { ?>
				elm = this.getElements("x" + infix + "_Subject");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_edit->Subject->caption(), $ticketmessage_edit->Subject->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticketmessage_edit->Message->Required) { ?>
				elm = this.getElements("x" + infix + "_Message");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_edit->Message->caption(), $ticketmessage_edit->Message->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticketmessage_edit->MessageDate->Required) { ?>
				elm = this.getElements("x" + infix + "_MessageDate");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_edit->MessageDate->caption(), $ticketmessage_edit->MessageDate->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_MessageDate");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($ticketmessage_edit->MessageDate->errorMessage()) ?>");
			<?php if ($ticketmessage_edit->Attachment->Required) { ?>
				felm = this.getElements("x" + infix + "_Attachment");
				elm = this.getElements("fn_x" + infix + "_Attachment");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $ticketmessage_edit->Attachment->caption(), $ticketmessage_edit->Attachment->RequiredErrorMessage)) ?>");
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
	fticketmessageedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fticketmessageedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fticketmessageedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticketmessage_edit->showPageHeader(); ?>
<?php
$ticketmessage_edit->showMessage();
?>
<?php if (!$ticketmessage_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticketmessage_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fticketmessageedit" id="fticketmessageedit" class="<?php echo $ticketmessage_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticketmessage">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$ticketmessage_edit->IsModal ?>">
<?php if ($ticketmessage->getCurrentMasterTable() == "ticket") { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ticket">
<input type="hidden" name="fk_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_edit->TicketNumber->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($ticketmessage_edit->TicketNumber->Visible) { // TicketNumber ?>
	<div id="r_TicketNumber" class="form-group row">
		<label id="elh_ticketmessage_TicketNumber" for="x_TicketNumber" class="<?php echo $ticketmessage_edit->LeftColumnClass ?>"><?php echo $ticketmessage_edit->TicketNumber->caption() ?><?php echo $ticketmessage_edit->TicketNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_edit->RightColumnClass ?>"><div <?php echo $ticketmessage_edit->TicketNumber->cellAttributes() ?>>
<?php if ($ticketmessage_edit->TicketNumber->getSessionValue() != "") { ?>
<span id="el_ticketmessage_TicketNumber">
<span<?php echo $ticketmessage_edit->TicketNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_edit->TicketNumber->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x_TicketNumber" name="x_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_edit->TicketNumber->CurrentValue) ?>">
<?php } else { ?>
<span id="el_ticketmessage_TicketNumber">
<input type="text" data-table="ticketmessage" data-field="x_TicketNumber" name="x_TicketNumber" id="x_TicketNumber" size="30" placeholder="<?php echo HtmlEncode($ticketmessage_edit->TicketNumber->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_edit->TicketNumber->EditValue ?>"<?php echo $ticketmessage_edit->TicketNumber->editAttributes() ?>>
</span>
<?php } ?>
<?php echo $ticketmessage_edit->TicketNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticketmessage_edit->MessageNumber->Visible) { // MessageNumber ?>
	<div id="r_MessageNumber" class="form-group row">
		<label id="elh_ticketmessage_MessageNumber" class="<?php echo $ticketmessage_edit->LeftColumnClass ?>"><?php echo $ticketmessage_edit->MessageNumber->caption() ?><?php echo $ticketmessage_edit->MessageNumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_edit->RightColumnClass ?>"><div <?php echo $ticketmessage_edit->MessageNumber->cellAttributes() ?>>
<span id="el_ticketmessage_MessageNumber">
<span<?php echo $ticketmessage_edit->MessageNumber->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($ticketmessage_edit->MessageNumber->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="ticketmessage" data-field="x_MessageNumber" name="x_MessageNumber" id="x_MessageNumber" value="<?php echo HtmlEncode($ticketmessage_edit->MessageNumber->CurrentValue) ?>">
<?php echo $ticketmessage_edit->MessageNumber->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticketmessage_edit->MessageBy->Visible) { // MessageBy ?>
	<div id="r_MessageBy" class="form-group row">
		<label id="elh_ticketmessage_MessageBy" for="x_MessageBy" class="<?php echo $ticketmessage_edit->LeftColumnClass ?>"><?php echo $ticketmessage_edit->MessageBy->caption() ?><?php echo $ticketmessage_edit->MessageBy->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_edit->RightColumnClass ?>"><div <?php echo $ticketmessage_edit->MessageBy->cellAttributes() ?>>
<span id="el_ticketmessage_MessageBy">
<input type="text" data-table="ticketmessage" data-field="x_MessageBy" name="x_MessageBy" id="x_MessageBy" size="30" placeholder="<?php echo HtmlEncode($ticketmessage_edit->MessageBy->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_edit->MessageBy->EditValue ?>"<?php echo $ticketmessage_edit->MessageBy->editAttributes() ?>>
</span>
<?php echo $ticketmessage_edit->MessageBy->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticketmessage_edit->Subject->Visible) { // Subject ?>
	<div id="r_Subject" class="form-group row">
		<label id="elh_ticketmessage_Subject" for="x_Subject" class="<?php echo $ticketmessage_edit->LeftColumnClass ?>"><?php echo $ticketmessage_edit->Subject->caption() ?><?php echo $ticketmessage_edit->Subject->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_edit->RightColumnClass ?>"><div <?php echo $ticketmessage_edit->Subject->cellAttributes() ?>>
<span id="el_ticketmessage_Subject">
<input type="text" data-table="ticketmessage" data-field="x_Subject" name="x_Subject" id="x_Subject" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticketmessage_edit->Subject->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_edit->Subject->EditValue ?>"<?php echo $ticketmessage_edit->Subject->editAttributes() ?>>
</span>
<?php echo $ticketmessage_edit->Subject->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticketmessage_edit->Message->Visible) { // Message ?>
	<div id="r_Message" class="form-group row">
		<label id="elh_ticketmessage_Message" for="x_Message" class="<?php echo $ticketmessage_edit->LeftColumnClass ?>"><?php echo $ticketmessage_edit->Message->caption() ?><?php echo $ticketmessage_edit->Message->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_edit->RightColumnClass ?>"><div <?php echo $ticketmessage_edit->Message->cellAttributes() ?>>
<span id="el_ticketmessage_Message">
<input type="text" data-table="ticketmessage" data-field="x_Message" name="x_Message" id="x_Message" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticketmessage_edit->Message->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_edit->Message->EditValue ?>"<?php echo $ticketmessage_edit->Message->editAttributes() ?>>
</span>
<?php echo $ticketmessage_edit->Message->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticketmessage_edit->MessageDate->Visible) { // MessageDate ?>
	<div id="r_MessageDate" class="form-group row">
		<label id="elh_ticketmessage_MessageDate" for="x_MessageDate" class="<?php echo $ticketmessage_edit->LeftColumnClass ?>"><?php echo $ticketmessage_edit->MessageDate->caption() ?><?php echo $ticketmessage_edit->MessageDate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_edit->RightColumnClass ?>"><div <?php echo $ticketmessage_edit->MessageDate->cellAttributes() ?>>
<span id="el_ticketmessage_MessageDate">
<input type="text" data-table="ticketmessage" data-field="x_MessageDate" name="x_MessageDate" id="x_MessageDate" placeholder="<?php echo HtmlEncode($ticketmessage_edit->MessageDate->getPlaceHolder()) ?>" value="<?php echo $ticketmessage_edit->MessageDate->EditValue ?>"<?php echo $ticketmessage_edit->MessageDate->editAttributes() ?>>
<?php if (!$ticketmessage_edit->MessageDate->ReadOnly && !$ticketmessage_edit->MessageDate->Disabled && !isset($ticketmessage_edit->MessageDate->EditAttrs["readonly"]) && !isset($ticketmessage_edit->MessageDate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fticketmessageedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fticketmessageedit", "x_MessageDate", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $ticketmessage_edit->MessageDate->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticketmessage_edit->Attachment->Visible) { // Attachment ?>
	<div id="r_Attachment" class="form-group row">
		<label id="elh_ticketmessage_Attachment" class="<?php echo $ticketmessage_edit->LeftColumnClass ?>"><?php echo $ticketmessage_edit->Attachment->caption() ?><?php echo $ticketmessage_edit->Attachment->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticketmessage_edit->RightColumnClass ?>"><div <?php echo $ticketmessage_edit->Attachment->cellAttributes() ?>>
<span id="el_ticketmessage_Attachment">
<div id="fd_x_Attachment">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $ticketmessage_edit->Attachment->title() ?>" data-table="ticketmessage" data-field="x_Attachment" name="x_Attachment" id="x_Attachment" lang="<?php echo CurrentLanguageID() ?>"<?php echo $ticketmessage_edit->Attachment->editAttributes() ?><?php if ($ticketmessage_edit->Attachment->ReadOnly || $ticketmessage_edit->Attachment->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_Attachment"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_Attachment" id= "fn_x_Attachment" value="<?php echo $ticketmessage_edit->Attachment->Upload->FileName ?>">
<input type="hidden" name="fa_x_Attachment" id= "fa_x_Attachment" value="<?php echo (Post("fa_x_Attachment") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_Attachment" id= "fs_x_Attachment" value="0">
<input type="hidden" name="fx_x_Attachment" id= "fx_x_Attachment" value="<?php echo $ticketmessage_edit->Attachment->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_Attachment" id= "fm_x_Attachment" value="<?php echo $ticketmessage_edit->Attachment->UploadMaxFileSize ?>">
</div>
<table id="ft_x_Attachment" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $ticketmessage_edit->Attachment->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ticketmessage_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ticketmessage_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticketmessage_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$ticketmessage_edit->IsModal) { ?>
<?php echo $ticketmessage_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$ticketmessage_edit->showPageFooter();
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
$ticketmessage_edit->terminate();
?>