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
$result_area_edit = new result_area_edit();

// Run the page
$result_area_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$result_area_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fresult_areaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fresult_areaedit = currentForm = new ew.Form("fresult_areaedit", "edit");

	// Validate form
	fresult_areaedit.validate = function() {
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
			<?php if ($result_area_edit->ResultAreaCode->Required) { ?>
				elm = this.getElements("x" + infix + "_ResultAreaCode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $result_area_edit->ResultAreaCode->caption(), $result_area_edit->ResultAreaCode->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($result_area_edit->ResultAreaName->Required) { ?>
				elm = this.getElements("x" + infix + "_ResultAreaName");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $result_area_edit->ResultAreaName->caption(), $result_area_edit->ResultAreaName->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($result_area_edit->ResultAreaStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ResultAreaStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $result_area_edit->ResultAreaStatus->caption(), $result_area_edit->ResultAreaStatus->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($result_area_edit->ProgressStatus->Required) { ?>
				elm = this.getElements("x" + infix + "_ProgressStatus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $result_area_edit->ProgressStatus->caption(), $result_area_edit->ProgressStatus->RequiredErrorMessage)) ?>");
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
	fresult_areaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fresult_areaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fresult_areaedit.lists["x_ResultAreaCode"] = <?php echo $result_area_edit->ResultAreaCode->Lookup->toClientList($result_area_edit) ?>;
	fresult_areaedit.lists["x_ResultAreaCode"].options = <?php echo JsonEncode($result_area_edit->ResultAreaCode->lookupOptions()) ?>;
	fresult_areaedit.lists["x_ProgressStatus"] = <?php echo $result_area_edit->ProgressStatus->Lookup->toClientList($result_area_edit) ?>;
	fresult_areaedit.lists["x_ProgressStatus"].options = <?php echo JsonEncode($result_area_edit->ProgressStatus->lookupOptions()) ?>;
	loadjs.done("fresult_areaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $result_area_edit->showPageHeader(); ?>
<?php
$result_area_edit->showMessage();
?>
<?php if (!$result_area_edit->IsModal) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $result_area_edit->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<form name="fresult_areaedit" id="fresult_areaedit" class="<?php echo $result_area_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="result_area">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$result_area_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($result_area_edit->ResultAreaCode->Visible) { // ResultAreaCode ?>
	<div id="r_ResultAreaCode" class="form-group row">
		<label id="elh_result_area_ResultAreaCode" for="x_ResultAreaCode" class="<?php echo $result_area_edit->LeftColumnClass ?>"><?php echo $result_area_edit->ResultAreaCode->caption() ?><?php echo $result_area_edit->ResultAreaCode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $result_area_edit->RightColumnClass ?>"><div <?php echo $result_area_edit->ResultAreaCode->cellAttributes() ?>>
<div class="btn-group ew-dropdown-list" role="group">
	<div class="btn-group" role="group">
		<button type="button" class="btn form-control dropdown-toggle ew-dropdown-toggle" aria-haspopup="true" aria-expanded="false"<?php if ($result_area_edit->ResultAreaCode->ReadOnly) { ?> readonly<?php } else { ?>data-toggle="dropdown"<?php } ?>><?php echo $result_area_edit->ResultAreaCode->ViewValue ?></button>
		<div id="dsl_x_ResultAreaCode" data-repeatcolumn="1" class="dropdown-menu">
			<div class="ew-items" style="overflow-x: hidden;">
<?php echo $result_area_edit->ResultAreaCode->radioButtonListHtml(TRUE, "x_ResultAreaCode") ?>
			</div><!-- /.ew-items -->
		</div><!-- /.dropdown-menu -->
		<div id="tp_x_ResultAreaCode" class="ew-template"><input type="radio" class="custom-control-input" data-table="result_area" data-field="x_ResultAreaCode" data-value-separator="<?php echo $result_area_edit->ResultAreaCode->displayValueSeparatorAttribute() ?>" name="x_ResultAreaCode" id="x_ResultAreaCode" value="{value}"<?php echo $result_area_edit->ResultAreaCode->editAttributes() ?>></div>
	</div><!-- /.btn-group -->
	<?php if (!$result_area_edit->ResultAreaCode->ReadOnly) { ?>
	<button type="button" class="btn btn-default ew-dropdown-clear" disabled>
		<i class="fas fa-times ew-icon"></i>
	</button>
	<?php } ?>
</div><!-- /.ew-dropdown-list -->
<?php echo $result_area_edit->ResultAreaCode->Lookup->getParamTag($result_area_edit, "p_x_ResultAreaCode") ?>
<input type="hidden" data-table="result_area" data-field="x_ResultAreaCode" name="o_ResultAreaCode" id="o_ResultAreaCode" value="<?php echo HtmlEncode($result_area_edit->ResultAreaCode->OldValue != null ? $result_area_edit->ResultAreaCode->OldValue : $result_area_edit->ResultAreaCode->CurrentValue) ?>">
<?php echo $result_area_edit->ResultAreaCode->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($result_area_edit->ResultAreaName->Visible) { // ResultAreaName ?>
	<div id="r_ResultAreaName" class="form-group row">
		<label id="elh_result_area_ResultAreaName" for="x_ResultAreaName" class="<?php echo $result_area_edit->LeftColumnClass ?>"><?php echo $result_area_edit->ResultAreaName->caption() ?><?php echo $result_area_edit->ResultAreaName->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $result_area_edit->RightColumnClass ?>"><div <?php echo $result_area_edit->ResultAreaName->cellAttributes() ?>>
<span id="el_result_area_ResultAreaName">
<input type="text" data-table="result_area" data-field="x_ResultAreaName" name="x_ResultAreaName" id="x_ResultAreaName" size="50" maxlength="255" placeholder="<?php echo HtmlEncode($result_area_edit->ResultAreaName->getPlaceHolder()) ?>" value="<?php echo $result_area_edit->ResultAreaName->EditValue ?>"<?php echo $result_area_edit->ResultAreaName->editAttributes() ?>>
</span>
<?php echo $result_area_edit->ResultAreaName->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($result_area_edit->ResultAreaStatus->Visible) { // ResultAreaStatus ?>
	<div id="r_ResultAreaStatus" class="form-group row">
		<label id="elh_result_area_ResultAreaStatus" for="x_ResultAreaStatus" class="<?php echo $result_area_edit->LeftColumnClass ?>"><?php echo $result_area_edit->ResultAreaStatus->caption() ?><?php echo $result_area_edit->ResultAreaStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $result_area_edit->RightColumnClass ?>"><div <?php echo $result_area_edit->ResultAreaStatus->cellAttributes() ?>>
<span id="el_result_area_ResultAreaStatus">
<input type="text" data-table="result_area" data-field="x_ResultAreaStatus" name="x_ResultAreaStatus" id="x_ResultAreaStatus" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($result_area_edit->ResultAreaStatus->getPlaceHolder()) ?>" value="<?php echo $result_area_edit->ResultAreaStatus->EditValue ?>"<?php echo $result_area_edit->ResultAreaStatus->editAttributes() ?>>
</span>
<?php echo $result_area_edit->ResultAreaStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($result_area_edit->ProgressStatus->Visible) { // ProgressStatus ?>
	<div id="r_ProgressStatus" class="form-group row">
		<label id="elh_result_area_ProgressStatus" for="x_ProgressStatus" class="<?php echo $result_area_edit->LeftColumnClass ?>"><?php echo $result_area_edit->ProgressStatus->caption() ?><?php echo $result_area_edit->ProgressStatus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $result_area_edit->RightColumnClass ?>"><div <?php echo $result_area_edit->ProgressStatus->cellAttributes() ?>>
<span id="el_result_area_ProgressStatus">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="result_area" data-field="x_ProgressStatus" data-value-separator="<?php echo $result_area_edit->ProgressStatus->displayValueSeparatorAttribute() ?>" id="x_ProgressStatus" name="x_ProgressStatus"<?php echo $result_area_edit->ProgressStatus->editAttributes() ?>>
			<?php echo $result_area_edit->ProgressStatus->selectOptionListHtml("x_ProgressStatus") ?>
		</select>
</div>
<?php echo $result_area_edit->ProgressStatus->Lookup->getParamTag($result_area_edit, "p_x_ProgressStatus") ?>
</span>
<?php echo $result_area_edit->ProgressStatus->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$result_area_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $result_area_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $result_area_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$result_area_edit->IsModal) { ?>
<?php echo $result_area_edit->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
</form>
<?php
$result_area_edit->showPageFooter();
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
$result_area_edit->terminate();
?>