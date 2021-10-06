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
$ticket_category_ref_add = new ticket_category_ref_add();

// Run the page
$ticket_category_ref_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_category_ref_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fticket_category_refadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fticket_category_refadd = currentForm = new ew.Form("fticket_category_refadd", "add");

	// Validate form
	fticket_category_refadd.validate = function() {
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
			<?php if ($ticket_category_ref_add->TicketCategoryName->Required) { ?>
				elm = this.getElements("x" + infix + "_TicketCategoryName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $ticket_category_ref_add->TicketCategoryName->caption(), $ticket_category_ref_add->TicketCategoryName->RequiredErrorMessage)) ?>");
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
	fticket_category_refadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fticket_category_refadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fticket_category_refadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ticket_category_ref_add->showPageHeader(); ?>
<?php
$ticket_category_ref_add->showMessage();
?>
<form name="fticket_category_refadd" id="fticket_category_refadd" class="<?php echo $ticket_category_ref_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_category_ref">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$ticket_category_ref_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($ticket_category_ref_add->TicketCategoryName->Visible) { // TicketCategoryName ?>
	<div id="r_TicketCategoryName" class="form-group row">
		<label id="elh_ticket_category_ref_TicketCategoryName" for="x_TicketCategoryName" class="<?php echo $ticket_category_ref_add->LeftColumnClass ?>"><?php echo $ticket_category_ref_add->TicketCategoryName->caption() ?><?php echo $ticket_category_ref_add->TicketCategoryName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $ticket_category_ref_add->RightColumnClass ?>"><div <?php echo $ticket_category_ref_add->TicketCategoryName->cellAttributes() ?>>
<span id="el_ticket_category_ref_TicketCategoryName">
<input type="text" data-table="ticket_category_ref" data-field="x_TicketCategoryName" name="x_TicketCategoryName" id="x_TicketCategoryName" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($ticket_category_ref_add->TicketCategoryName->getPlaceHolder()) ?>" value="<?php echo $ticket_category_ref_add->TicketCategoryName->EditValue ?>"<?php echo $ticket_category_ref_add->TicketCategoryName->editAttributes() ?>>
</span>
<?php echo $ticket_category_ref_add->TicketCategoryName->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$ticket_category_ref_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $ticket_category_ref_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ticket_category_ref_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$ticket_category_ref_add->showPageFooter();
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
$ticket_category_ref_add->terminate();
?>