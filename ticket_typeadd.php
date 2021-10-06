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
$ticket_type_add = new ticket_type_add();

// Run the page
$ticket_type_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_type_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticket_typeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fticket_typeadd = currentForm = new ew.Form("fticket_typeadd", "add");

	// Validate form
	fticket_typeadd.validate = function() {
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
			<?php if ($ticket_type_add->TicketTypeDesc->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketTypeDesc");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_type_add->TicketTypeDesc->caption(), $ticket_type_add->TicketTypeDesc->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($ticket_type_add->TicketCategory->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketCategory");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_type_add->TicketCategory->caption(), $ticket_type_add->TicketCategory->RequiredErrorMessage)) ?>");
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
	fticket_typeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fticket_typeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fticket_typeadd.lists["x_TicketCategory"] = <?php echo $ticket_type_add->TicketCategory->Lookup->toClientList($ticket_type_add) ?>;
	fticket_typeadd.lists["x_TicketCategory"].options = <?php echo JsonEncode($ticket_type_add->TicketCategory->lookupOptions()) ?>;
	loadjs.done("fticket_typeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_type_add->showPageHeader(); ?>
<?php
$ticket_type_add->showMessage();
?>
<form name="fticket_typeadd" id="fticket_typeadd" class="<?php echo $ticket_type_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_type">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_type_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($ticket_type_add->TicketTypeDesc->Visible) { // TicketTypeDesc ?>
	<div id="r_TicketTypeDesc" class="form-group row">
		<label id="elh_ticket_type_TicketTypeDesc" for="x_TicketTypeDesc" class="<?php echo $ticket_type_add->LeftColumnClass ?>"><?php echo $ticket_type_add->TicketTypeDesc->caption() ?><?php echo $ticket_type_add->TicketTypeDesc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_type_add->RightColumnClass ?>"><div <?php echo $ticket_type_add->TicketTypeDesc->cellAttributes() ?>>
<span id="el_ticket_type_TicketTypeDesc">
<input type="text" data-table="ticket_type" data-field="x_TicketTypeDesc" name="x_TicketTypeDesc" id="x_TicketTypeDesc" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_type_add->TicketTypeDesc->getPlaceHolder()) ?>" value="<?php echo $ticket_type_add->TicketTypeDesc->EditValue ?>"<?php echo $ticket_type_add->TicketTypeDesc->editAttributes() ?>>
</span>
<?php echo $ticket_type_add->TicketTypeDesc->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($ticket_type_add->TicketCategory->Visible) { // TicketCategory ?>
	<div id="r_TicketCategory" class="form-group row">
		<label id="elh_ticket_type_TicketCategory" for="x_TicketCategory" class="<?php echo $ticket_type_add->LeftColumnClass ?>"><?php echo $ticket_type_add->TicketCategory->caption() ?><?php echo $ticket_type_add->TicketCategory->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_type_add->RightColumnClass ?>"><div <?php echo $ticket_type_add->TicketCategory->cellAttributes() ?>>
<span id="el_ticket_type_TicketCategory">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="ticket_type" data-field="x_TicketCategory" data-value-separator="<?php echo $ticket_type_add->TicketCategory->displayValueSeparatorAttribute() ?>" id="x_TicketCategory" name="x_TicketCategory"<?php echo $ticket_type_add->TicketCategory->editAttributes() ?>>
			<?php echo $ticket_type_add->TicketCategory->selectOptionListHtml("x_TicketCategory") ?>
		</select>
</div>
<?php echo $ticket_type_add->TicketCategory->Lookup->getParamTag($ticket_type_add, "p_x_TicketCategory") ?>
</span>
<?php echo $ticket_type_add->TicketCategory->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ticket_type_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ticket_type_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticket_type_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ticket_type_add->showPageFooter();
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
$ticket_type_add->terminate();
?>